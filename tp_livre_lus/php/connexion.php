<?php
try /*On fait un appel à la base de données livre*/
    {
        $bdd = new PDO('mysql: host=localhost;dbname=livre;charset=utf8','sudo','boby06');
        //avec PDO on sélectionne le charset=utf8 pour éviter d'avoir des erreurs d'affichage (source: https://stackoverflow.com/questions/4361459/php-pdo-charset-set-names)//
    }
catch(Exception $e) /*on fait en sorte de récupérer les erreurs le cas échéant pour surtout éviter que le mot
                     *de passe de la bdd apparaisse sur la page*/
    {
       die('erreur : ' .$e->getMessage()); 
    }
?>
