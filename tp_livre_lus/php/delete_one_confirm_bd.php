<?php

include ('/var/www/public/private/git/tp_livre_lus/include/config.inc.php'); /*J'inclus le fichier connexion.php situé dans le dosssier php
            *pour éviter de surcharger le code accueil et pour une meilleure
            *lisibilité du code*/

$mdp   = $_POST['mdp']; //on récupére la superglobale $_POST qu'on transforme en variable c'est plus simple à travailler
$id    = $_POST['id'];  //on récupére la superglobale $_POST qu'on transforme en variable c'est plus simple à travailler

if($mdp == 'secret')
    {
        $req_delete = $bdd->prepare('DELETE FROM bd WHERE id=:id'); //préparation de la requête avec l'id transmis par le formulaire delete_one.php
        $req_delete->execute(array(
            'id'    => $id
        ));
        $req_delete->closeCursor(); //On ferme le pointeur php pour une autre requête
        ?>
        <div class='msg_confirm_delete'>L'album a bien était supprimé. Pour revenir à l'accueil <a href='../accueil_bd.php'>Cliquer ici</a></div>
        <?php
    }
else
    {
        ?> Mauvais mot de passe <a href='../accueil_bd.php'>réessayer</a>
        <?php
    }
    ?>


