<?php

include ('connexion.php'); //on se connecte à la base livres

$mdp   = $_POST['mdp']; //on récupére la superglobale $_POST qu'on transforme en variable c'est plus simple à travailler
$id    = $_POST['id'];  //on récupére la superglobale $_POST qu'on transforme en variable c'est plus simple à travailler

if($mdp == 'secret')
    {
        $req_delete = $bdd->prepare('DELETE FROM livres_lus WHERE id=:id'); //préparation de la requête avec l'id transmis par le formulaire delete_one.php
        $req_delete->execute(array(
            'id'    => $id
        ));
        $req_delete->closeCursor(); //On ferme le pointeur php pour une autre requête
        ?>
        <div class='msg_confirm_delete'>Le titre a bien était supprimé. Pour revenir à l'accueil <a href='\private\git\mon_site_web\tp_livre_lus\accueil_caroussel_livre.php'>Cliquer ici</a></div>
        <?php
    }
else
    {
        ?> Mauvais mot de passe <a href='\private\git\mon_site_web\tp_livre_lus\accueil_caroussel_livre.php'>réessayer</a>
        <?php
    }
    ?>


