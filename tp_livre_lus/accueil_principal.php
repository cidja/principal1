<!DOCTYPE html>
    <html>
        <head>
            <title>Mes livres lus</title>
            
            <meta charset='utf-8'/> <!--on choisi utf-8 comme encodage car affiche tous bien accents y compris!-->
            <meta name='viewport' content='width=device-width , initial-scale=1.0'/> <!--utilisation de cette fonction
            pour redimensionner les boutons en fonction de la taille de la fenêtre (source: https://www.pierre-giraud.com/html-css/cours-complet/viewport-html.php) !-->
            <link rel='stylesheet' href='css/style_accueil.css'/>
        </head>
        <body>
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