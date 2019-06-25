<!DOCTYPE html>
<html>
    <head>
        <title>Accueil livres lus</title>
        <meta charset='utf-8'/>
        <link rel='stylesheet' href='css/style_caroussel.css'/>
    
    </head>
    <body>
    <h1>Clique sur le livre qui t'intéresse pour avoir sa fiche </h1>

    <?php
    /*include_once (car besoin qu'une seule fois) du fichier menu.html pour l'affichage du menu dans toutes les pages c'est plus simple pour la gestion */
    include_once ('menu.html'); 
    
    include ('/wamp64/www/private/git/tp_livre_lus/php/connexion.php'); /*J'inclus le fichier connexion.php situé dans le dosssier php
    *pour éviter de surcharger le code accueil et pour une meilleure
    *lisibilité du code*/
    /*requete d'affichage à la base de données*/
    $reponse = $bdd->query('SELECT id,serie,titre,scenario,dessin,album_numero,genre,remarques,img_couv,
    DATE_FORMAT(date_ajout, "%d-%m-%Y  à %Hh%i:%ssec") as date_fr FROM bd  ORDER BY id DESC');
    //fonction date_format permet de mettre la date au format que je souhaite ici ex: date d'ajout : 20-01-2019 à 20h40:24sec
    while($donnees = $reponse->fetch())
    {
        ?>
             <a href='php/fiche_bd.php?id=<?php echo $donnees['id'];?>'> <!-- lien utilisé pour afficher le détail de l'image cliqué  via le _get!-->
             <img class='img_couv_bd' src="<?php echo $donnees['img_couv'];?>"/>
              </a> <!--href mis pour rendre l'image cliquable !-->
             
        <?php
    }


    ?>
    </body>

</html>