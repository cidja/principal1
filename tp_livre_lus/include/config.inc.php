<?php
ini_set('display_errors', 'on');
date_default_timezone_set('Europe/Paris'); //validation de la date par défaut ici paris
setlocale(LC_MONETARY, 'fr_FR'); // Modifie les informations de localisation source: https://www.php.net/manual/fr/function.setlocale.php
//ce fichier est utilisé pour crée toutes les initialisation de config 

DEFINE('SQL_HOST', 'localhost');  //C'est une constante qui ne peut pas changer source: https://www.php.net/manual/fr/function.define.php
DEFINE('SQL_BDD', 'livre'); 
DEFINE('SQL_USER', 'sudo');
DEFINE('SQL_PASSWORD', 'boby06');



    try{


        //!!!!!
    //$bbd = Database::getInstance(SQL_BDD, array('host' => SQL_HOST, 'user'=>SQL_USER, 'pass'=> SQL_PASSWORD, 'name'=> SQL_BDD));
    //$bdd->execute("SET NAMES 'UTF8', lc_time_name='fr_FR'");

        //!!!!


     $bdd = new PDO('mysql: host=localhost;dbname=livre;charset=utf8','sudo','boby06'); //Ceci est ma méthode  pour me connecter
}
catch(PDOException $e)
{
    die('erreur :' .$e->getMessage());
}



$GLOBALS['today'] = date('Y-m-d');
?>