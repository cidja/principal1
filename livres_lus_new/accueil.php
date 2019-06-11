<!DOCTYPE html>
<html>
    <head>
        <title>Mes livres lus</title>
        <meta charset='utf8'/>
        <link rel='stylesheet' href='/css/style_accueil.css'/>
    </head>
    <body>
        <?php include_once('/var/www/public/private/git/livres_lus_new/fonctions/connexion.php'); //on intégre le fichier en chemin absolu ?>
        <h1 id='titre_accueil_choix'>Liste des livres lus par Christian GEORGES</h1>
            <br/>
                <div class='choix_livres'>
                    <a href='accueil_caroussel_livre.php' id='a_choix_livres'> <!--Ecriture du href en chemin relatif (donc à partir du répertoire actuel)!-->
                    Romans
                        <br/><br/>
                        <img src='img/ji.jpg' class='img_ji'/>
                    </a>
                </div> 
            
                <div class='choix_bd'>
                    <a  href='accueil_caroussel.php' id='a_choix_bd'>
                        BD
                        <br/><br/>
                        <img src='img/les_profs.jpg'/>
                    </a>
                </div> 
                        
         
        </body>
    </html>