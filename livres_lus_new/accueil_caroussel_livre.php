<?php
include_once('/var/www/public/private/git/livres_lus_new/fonctions/connexion.php'); //on intégre le fichier connexion pour la bdd livre en chemin absolu 
include_once('/var/www/public/private/git/livres_lus_new/fonctions/debug.php'); //inclusion du fichier pour le débogage 
?>



affichage du tableau de la base de données :

<?php
$req = $bdd->query('SELECT * FROM livres_lus limit 50');
//while($donnees = $req->fetch())
foreach($req as $key => $value)

{
    echo 'voici le titre des livres que j\'ai lu : '. $value['titre']. '<br/>';
    
}

?>
