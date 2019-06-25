<?php
try{
    $bdd = new PDO('mysql: host=localhost;dbname=livre;charset=utf8','sudo','boby06');

}
catch(Exception $e)
{
    die('erreur :' .$e->getMessage());
}
?>