<?php

/**
 * Database abstraction and query result classes
 * Requires PHP 5.3
 *
 * Events:
 *  - on_commit - Dispatched when the transaction is successfully committed to the DB
 *  - on_rollback - Dispatched when the transaction is rolled back in the DB
 */

class Database extends PDO {


    private $stmt;
    private $good_trans = null;
    private $nested_transactions = 0; //Keeps track of virtual transaction nesting level
    private $callbacks = array();
    
    
    private $debug;
    private static $connections = array(); //Keeps track of opened connections

    /**
     * Returns a database instance using lazy instantiation
     * @param string $name a database connection name
     * @param array $config database config details for a new connection
     */
    static function getInstance($name, $config=array()){
		
        //Attempt to return an existing connection
        if(array_key_exists($name, self::$connections)):
            return self::$connections[$name];
        endif;

        //Attempt to create a new connection
		$host = ";host=" . $config['host'].";port=".$config['port'];
        $db = new Database($config['driver'].":dbname=".$config['name'].$host, $config['user'], $config['pass']);

        //Save to connection pool
        self::$connections[$name] = $db;
	

        return $db;

    }

    /**
     * Registers a callback to be run when the given event is invoked
     * @param string $event Event name
     * @param callable $callable
     */
    public function register_listener($event, $callable){

        if(!array_key_exists($event, $this->callbacks)):
            $this->callbacks[$event] = array($callable);
        else:
            $this->callbacks[$event][] = $callable;
        endif;

    }

    /**
     * Invokes callbacks for the given event type
     * @param string $event Event name
     * @param boolean $stop_on_false Stops bubbling this event if one of the handlers returns false
     */
    protected function dispatch_event($event, $stop_on_false = true){

        if(!array_key_exists($event, $this->callbacks)) return;

        foreach($this->callbacks[$event] as $callable):

            $res = call_user_func($callable, $this, $event);
            if($stop_on_false && $res === false) return false;

        endforeach;

        return true;

    }

    /**
     * PDO Constructor
     * @param $dsn
     * @param $username
     * @param $password
     */
    function __construct($dsn, $username, $password) {
        parent::__construct($dsn, $username, $password);
    }

    /**
	* @param string $statement 
	* @param array $driver_options [optional] 
	* @return PDOStatement 
	*/
    public function prepare($statement, $driver_options = array()) {
        $stmt = parent::prepare($statement, array(PDO::ATTR_STATEMENT_CLASS => array(__NAMESPACE__.'\DatabaseStatement')));
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt;

    }
    /**
     * Prepares an executes an SQL statement with the parameters provided
     * @param string $sql
     * @param array $params
     */
    function execute($sql, $params = array()) {
        if($this->debug):
            var_dump("Statement:\n".$sql."\nParams: ".$this->fmt($params));
        endif;

        try {
            $stmt = $this->prepare($sql);
            $val = $stmt->execute((array) $params);
            if($stmt->errorCode() != '00000') error_log($this->errormsg());
            if($this->debug && $stmt->errorCode() != '00000'){
                var_dump($stmt->errorInfo());
                // Errors::add("Database error: ".$this->errormsg(), E_USER_ERROR);
            }
            if(!$val) return false;
        } catch (PDOException $e){
            if($this->debug) var_dump($stmt->errorInfo());
            if($this->nested_transactions) $this->failTrans();
            else throw $e;
        }

        $this->stmt = $stmt;

        return $stmt;

    }  

//RECUPERER LAST INSERT ID
    function insert($sql, $params = array()) {
        if($this->debug):
            var_dump("Statement:\n".$sql."\nParams: ".$this->fmt($params));
        endif;

        try {
            self::beginTransaction();
            self::execute($sql,$params);
            $lastId = self::getLastInsertId();
            self::commit();
        } catch (PDOException $e){
            if($this->debug) var_dump($stmt->errorInfo());
            if($this->nested_transactions) $this->failTrans();
            else throw $e;
        }
        return $lastId;

    } 	
    
    public function getSql($query, $params = array()) {
        $keys = array();
        # build a regular expression for each parameter
        foreach ($params as $key => $value) {
            if (is_string($key)) {
                $keys[] = '/:' . $key . '/';
            } else {
                $keys[] = '/[?]/';
            }
            $values[$key] = "'" . $value . "'";
            if (is_bool($value))
                $values[$key] = $value;
            
            elseif (ctype_digit($value))
                $values[$key] = (int)$value;
            
            elseif (is_array($value))
                $values[$key] = "'" . implode("','", $value) . "'";

            elseif (is_null($value))
                $values[$key] = 'NULL';
        }
        $query = preg_replace($keys, $values, $query, 1, $count);

        #trigger_error('replaced '.$count.' keys');

        return $query;
    }

    /**
     * Returns the value of the first column of the first row
     * of the database result.
     * @param $sql
     * @param $params
     */
    function getOne($sql, $params = array()){
        $stmt = $this->execute($sql, $params);
        return $stmt ? $stmt->getOne() : false;
    }

    /**
     * Fetches a single column (the first column) of a result set
     * @param $sql
     * @param $params
     */
    function getCol($sql, $params = array()){
        $stmt = $this->execute($sql, $params);
        return $stmt ? $stmt->getCol() : false;
    }

    /**
     * Fetches rows in associative array format
     * @param $sql
     * @param $params
     */
    function getAssoc($sql, $params = array()){
        $stmt = $this->execute($sql, $params);
        return $stmt ? $stmt->getAssoc() : false;
    }

    /**
     * Fetches rows in array format with columns
     * indexed by ordinal position
     * @param $sql
     * @param $params
     */
    function getArray($sql, $params = array()){
        $stmt = $this->execute($sql, $params);
        return $stmt ? $stmt->getArray() : false;
    }

    /**
     * Fetches all rows in associative array format
     * @param $sql
     * @param $params
     */
    function getAll($sql, $params = array()){
        return $this->getAssoc($sql, $params);
    }

    /**
     * Fetches rows in array format where the first column
     * is the key name and all other columns are values
     * @param $sql
     * @param $params
     */
    function getKeyPair($sql, $params = array()){
        $stmt = $this->execute($sql, $params);
        return $stmt ? $stmt->getKeyPair() : false;
    }

    /**
     * Fetches rows in multi-dimensional format where the first
     * column is the key name and all other colums are grouped
     * into associative arrays for each row
     * @param $sql
     * @param $params
     */
    function getGroup($sql, $params = array()){
        $stmt = $this->execute($sql, $params);
        return $stmt ? $stmt->getGroup() : false;
    }

    /**
     * Fetches only the first row and returns it as an
     * associative array
     * @param $sql
     * @param $params
     */
    function getRow($sql, $params = array()){
        $stmt = $this->execute($sql, $params);
        return $stmt ? $stmt->getRow() : false;
    }
	
	/**
     * Fetches the ID of the last inserted element by the previous statement
     * /!\ Better being used in a Transaction /!\
     * @param void
     */
    function getLastInsertId(){
        return $this->lastInsertId();
    }

    /**
     * Internal function used for formatting parameters in debug output
     * @param unknown_type $params
     */
    private function fmt($params){
        $arr = array();
        foreach((array) $params as $k=>$v){
            if(is_null($v)) $v = "NULL";
            elseif(is_bool($v)) $v = $v ? "TRUE" : "FALSE";
            $arr[] = "[".$k."] => ".$v;
        }
        return "Array(".join(", ", $arr).")";
    }

    /**
     * Returns the number of affected rows from an executed statement
     */
    function affected_rows(){
        return $this->stmt ? $this->stmt->rowcount() : false;
    }

    /**
     * Automated statement processing
     *
     * Params array takes the following fields:
     *
     *  - table         The name of the table to run the query on
     *
     *  - data          A key-value paired array of table data
     *
     *  - mode          INSERT, UPDATE, REPLACE, or NEW
     *
     *  - where         Can be a string or key-value set. Not used on INSERTs
     *                  If key-value set and numerically indexed, uses values from data
     *                  If key-value and keys are named, uses its own values
     *
     *  - params        An array of param values for the where clause
     *
     *  - returning     Optional string defining what to return from query.
     *                  Uses PostgreSQL's RETURNING construct
     *
     *  This method will return either a boolean indicating success, an array
     *  containing the data requested by returning, or a boolean FALSE indicating
     *  a failed query.
     *
     */
    function autoExecute($table, $params, $data){

        $fields = array(); //Temp array for field names
        $values = array(); //Temp array for field values
        $set = array(); //Temp array for update sets
        $ins = array(); //Insert value arguments

        $params['table'] = $table;
        $params['data'] = $data;

        $params['params'] = (array) $params['params'];

        //Parse the data set and prepare it for different query types
        foreach((array) $params['data'] as $field => $val):

            $fields[] = $field;
            $values[] = $val;
            $ins[] = "?";
            $set[] = $field . " = ?";

        endforeach;

        //Check for and convert the array/object version of the where clause param
        if(is_object($params['where']) || is_array($params['where'])):

            $clause = array();
            $params['params'] = array(); //Reset the parameters list

            foreach($params['where'] as $key => $val):

                if(is_numeric($key)):
                    //Numerically indexed elements use their values as field names
                    //and values from the data array as param values
                    $field = $val;
                    $params['params'][] = $params['data'][$val];
                else:
                    //Named elements use their own names and values
                    $field = $key;
                    $params['params'][] = $val;
                endif;

                $clause[] = $field . " = ?";

            endforeach;

            $params['where'] = join(" AND ", $clause);

        endif;

        //Figure out what type of query we want to run
        $mode = strtoupper($params['mode']);
        switch($mode):
            case 'NEW':
            case 'INSERT':

                //Build the insert query
                if(count($fields)):
                    $sql =  "INSERT INTO " . $params['table']
                            . " (" . join(", ", $fields) . ")"
                            . " SELECT " . join(", ", $ins);
                else:
                    $sql =  "INSERT INTO " . $params['table']
                            . " DEFAULT VALUES";
                endif;

                //Do we need to add a conditional check?
                if($mode == "NEW" && count($fields)):
                    $sql .= " WHERE NOT EXISTS ("
                            . " SELECT 1 FROM " . $params['table']
                            . " WHERE " . $params['where']
                            . " )";
                    //Add in where clause params
                    $values = array_merge($values, $params['params']);
                endif;

                //Do we need to add a returning clause?
                if($params['returning']):
                    $sql .= " RETURNING " . $params['returning'];
                endif;

                //Execute our query
                $result = $this->getRow($sql, $values);

                //Return our result
                if($params['returning']):
                    return $result;
                else:
                    return $result !== false;
                endif;

                break;
            case 'UPDATE':

                if(!count($fields)) return false;

                //Build the update query
                $sql =  "UPDATE " . $params['table']
                        . " SET " . join(", ", $set)
                        . " WHERE " . $params['where'];

                //Do we need to add a returning clause?
                if($params['returning']):
                    $sql .= " RETURNING " . $params['returning'];
                endif;

                //Add in where clause params
                $values = array_merge($values, $params['params']);

                //Execute our query
                $result = $this->getRow($sql, $values);

                //Return our result
                if($params['returning']):
                    return $result;
                else:
                    return $result !== false;
                endif;

                break;
            case 'REPLACE': //UPDATE or INSERT

                //Attempt an UPDATE
                $params['mode'] = "UPDATE";
                $result = $this->autoExecute($params['table'], $params, $params['data']);

                //Attempt an INSERT if UPDATE didn't match anything
                if($this->affected_rows() === 0):
                    $params['mode'] = "INSERT";
                    $result = $this->autoExecute($params['table'], $params, $params['data']);
                endif;

                return $result;

                break;
            case 'DELETE':

                //Don't run if we don't have a where clause
                if(!$params['where']) return false;

                //Build the delete query
                $sql =  "DELETE FROM " . $params['table']
                        . " WHERE " . $params['where'];

                //Do we need to add a returning clause?
                if($params['returning']):
                    $sql .= " RETURNING " . $params['returning'];
                endif;

                //Execute our query
                $result = $this->getRow($sql, $params['params']);

                //Return our result
                if($params['returning']):
                    return $result;
                else:
                    return $result !== false;
                endif;

                break;
            default:
                user_error('AutoExecute called incorrectly', E_USER_ERROR);
                break;
        endswitch;

    }

    /**
     * @see $this->startTrans()
     */
    function beginTransaction(){
        $this->startTrans();
    }

    /**
     * Starts a smart transaction handler. Transaction nesting is emulated
     * by this class.
     */
    function startTrans(){

        $this->nested_transactions++;
        if($this->debug) var_dump("Starting transaction. Nesting level: " . $this->nested_transactions);

        //Do we need to begin an actual transaction?
        if($this->nested_transactions === 1):
            parent::beginTransaction();
            $this->good_trans = true;
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        endif;

    }

    /**
     * Returns TRUE if the transaction will attempt to commit, and
     * FALSE if the transaction will be rolled back upon completion.
     */
    function isGoodTrans(){
        return $this->good_trans;
    }

    /**
     * Marks a transaction as a failure. Transaction will be rolled back
     * upon completion.
     */
    function failTrans(){
        if($this->nested_transactions) $this->good_trans = false;
        if($this->debug):
            Errors::add("Database transaction failed: ".$this->errorMsg());
        endif;
        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
    }

    /**
     * @see $this->rollbackTrans()
     */
    function rollback(){
        $this->rollbackTrans();
    }

    /**
     * Rolls back the entire transaction and completes the current nested
     * transaction. If there are no more nested transactions, an actual
     * rollback is issued to the database.
     */
    function rollbackTrans(){
        if($this->nested_transactions):
            $this->nested_transactions--;
            if($this->debug) var_dump("Rollback requested. New nesting level: " . $this->nested_transactions);
            $this->good_trans = false;
            if($this->nested_transactions === 0):
                $this->good_trans = null;
                $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
                if($this->debug) var_dump("Transaction rolled back.");
                parent::rollback();
                $this->dispatch_event('on_rollback');
            endif;
        endif;
    }

    /**
     * Clears the nested transactions stack and issues a rollback to the database.
     */
    function fullRollback(){
        while($this->nested_transactions) $this->rollbackTrans();
    }

    /**
     * Returns the number of nested transactions:
     * 0 - There is no transaction in progress
     * 1 - There is one transaction pending
     * >1 - There are nested transactions in progress
     */
    function pending_trans(){
        return $this->nested_transactions;
    }

    /**
     * @see $this->completeTrans()
     */
    function commit($fail_on_user_errors = false){
        return $this->completeTrans($fail_on_user_errors);
    }

    /**
     * Completes the current transaction and issues a commit or rollback to the database
     * if there are no more nested transactions. If $fail_on_user_errors is set, the
     * transaction will automatically fail if any errors are queued in the Errors class.
     * @param boolean $fail_on_user_errors
     */
    function completeTrans($fail_on_user_errors = false){

        if(!$this->nested_transactions) return;

        //Fail the transaction if we have user errors in the queue
        if($fail_on_user_errors && Errors::exist()) $this->good_trans = false;

        //Do we actually need to attempt to commit the transaction?
        if($this->nested_transactions === 1):

            if(!$this->good_trans || !parent::commit()){
                if($this->debug) var_dump("Transaction failed: " . $this->errormsg());
                $this->rollbackTrans();
                return false;
            }

            //Transaction was good
            $this->nested_transactions--;
            $this->good_trans = null;
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
            if($this->debug) var_dump("Transaction committed.");
            $this->dispatch_event('on_commit', false);
            return true;
        else:
            //Don't take action just yet as we are still nested
            $this->nested_transactions--;
            if($this->debug) var_dump("Virtual commit. New nesting level: " . $this->nested_transactions);
        endif;

        return $this->good_trans;

    }

    /**
     * Returns the text of the most recently encountered error
     */
    function errormsg(){
        $msg = $this->errorInfo();
        return $msg[2];
    }

}

class DatabaseStatement extends \PDOStatement implements \Countable {

    /**
     * Binds passed parameters according to their PHP type and executes
     * the prepared statement
     */
    function execute($params = array()) {
        $i = 1;
        foreach($params as $k => $v):
            $mode = PDO::PARAM_STR;
            if(is_null($v)) $mode = PDO::PARAM_NULL;
            elseif(is_bool($v)) $mode = PDO::PARAM_BOOL;
            elseif(is_resource($v)) $mode = PDO::PARAM_LOB;
            elseif(is_integer($v)) $mode = PDO::PARAM_INT;
//            echo "value=".$v."==>mode=".$mode."<br>";
            $this->bindParam($k, $params[$k], $mode);
            $i++;
        endforeach;
        $ok = parent::execute();
        return $ok ? $this : false;
    }


    /**
     * Returns the value of the first column of the first row
     */
    function getOne() {
        return $this->fetchColumn(0);
    }

    /**
     * Returns an array of values of the column found at $index
     * position.
     * @param $index
     */
    function getCol($index=0) {
        return $this->fetchAll(PDO::FETCH_COLUMN, $index);
    }

    /**
     * Returns all rows in numeric array format
     */
    function getArray(){
        return $this->fetchAll(PDO::FETCH_NUM);
    }

    /*
     * Returns all rows in associative array format
     */
    function getAll(){
        return $this->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Returns all rows in associative array format
     */
    function getAssoc() {
        return $this->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Returns rows in multi-dimensional format where the first
     * column is the key name and all other colums are grouped
     * into associative arrays for each row
     */
    function getGroup() {
        return $this->fetchAll(PDO::FETCH_GROUP);
    }

    /**
     * Returns a single row in associative format
     */
    function getRow(){
        return $this->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Fetches rows in array format where the first column
     * is the key name and all other columns are values
     */
    function getKeyPair(){
        //Emulate it
        $tmp = $this->fetchAll(PDO::FETCH_ASSOC);
        $arr = array();
        for($i = 0; $i < count($tmp); $i++){
            $arr[array_shift($tmp[$i])] = count($tmp[$i]) > 1 ? $tmp[$i] : array_shift($tmp[$i]);
        }
        return $arr;
    }

    /**
     * Returns the number of rows returned by this statement
     */
    function recordCount(){

        return $this->rowCount();

    }

    /**
     * Returns the number of rows returned by this statement
     */
    function count(){

        return $this->rowCount();

    }
}