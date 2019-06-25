<!DOCTYPE html>
    <html>
        <head>
            <title>rajout d'un livre</title>
            <meta charset=utf-8'/>
            <link rel='stylesheet' href='../css/style_form.css'/>
            <link href="https://fonts.googleapis.com/css?family=Fredoka+One|Orbitron" rel="stylesheet">  <!--rajout police google !-->
        </head>
        <body>
        <?php
          /*include du fichier menu.html pour l'affichage du menu dans toutes les pages c'est plus simple pour la gestion */
           include ('../menu.html'); 
          ?> 
       
            <h3>Pour rajouter un ouvrage c'est par ici !</h3>
            <form method='post' action='rajout_validation.php' enctype='multipart/form-data'> <!--On va envoyer le formulaire sur le fichier rajout_validation.php!-->
                <label for="titre">Titre de l'ouvrage</label><input type='text' name='titre' id='titre'/>
                <div class='form_tableau'>
                    
                <label for="auteur" id='auteur_form'>Auteur</label><input type='text' name='auteur' id='auteur'/>
                    
                <label for='tome' id='tome_form'>Nombre de tomes (mettre 1 si un seul ouvrage)</label><input type='number' name='tome' id='tome'/>
                    
                <label for='nb_pages' id='nb_pages_form'>Nombre de pages : </label><input type='number' name='nb_pages' id='nb_pages'/>
             
                <label for='debut' id='debut_form'>Date de début de lecture :</label><input type='date' min='2017-01-01' max='2025-01-01' name='debut' id='debut'/>
                
                <label for='fin' id='fin_form'>Date de fin de la lecture :</label><input type='date' min='2017-01-01' max='2025-01-01' name='fin' id='fin'/>
                    
                <label for='remarques' id='remarques_form'>Tes remarques et impressions</label><input type='text' name='remarques' id='remarques'/>
                    
                <label for='img' id='img_form'>Une image de la couverture ça fait toujours plaisir aux yeux : (copier coller le lien url de l'image </label>
                                    <input type='text' name='img' id='img'/>
                </div>
                    <br/>
                <!--pour l'upload du chemin de l'image de couverture mis en commentaire car pour le moment passe par le formulaire rajout_couv.php 
                <label for='img'>Envoi image de couverture : </label><input type='file' name='img' id='img'/>
                <input type='hidden' name='max_file_size' id='max_file_size' value='250000'/> <!-- pour éviter les fichiers trop volumineux !-->
                
                <input type='submit' value='valider'/>
        </body>
    </html>