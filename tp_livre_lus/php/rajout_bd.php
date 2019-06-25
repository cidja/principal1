<!DOCTYPE html>
    <html>
        <head>
            <title>rajout d'une BD</title>
            <meta charset='utf-8'/>
            <link rel='stylesheet' href='../css/style_form_bd.css'/>
        </head>
        <body>
        <?php
          /*include du fichier menu.html pour l'affichage du menu dans toutes les pages c'est plus simple pour la gestion */
           include ('../menu.html'); 
          ?> 
            <h3>Pour rajouter une BD c'est par ici ! En dessous</h3>
            <form method='post' action='rajout_validation_bd.php'enctype='multipart/form-data'> <!--On va envoyer le formulaire sur le fichier rajout_validation.php!-->
            
                <label for='serie'>Série :</label><input type='text' name='serie' id='serie' placeholder='exemple : Leonard, Boule et bill, Titeuf...'/>
                    <br>
                <label for='titre'>Titre de l'ouvrage : </label><input type='text' name='titre' id='titre'/>
                    <br/><!--<br/> rajouté pour sauter une ligne c'est plus classe!-->
                <div class='form_tableau'>
                <label for='scenario' id='scenario_form'>Scénario : </label><input type='text' name='scenario' id='scenario'/>
                    <br/>
                <label for='dessin' id='dessin_form'>Dessin : </label><input type='text' name='dessin' id='dessin'/>
                    <br/>
                
                <label for='album_numero' id='album_numero_form'>Numéro de l'album :</label><input type='number' name='album_numero' id='album_numero'/>
                    <br/>
                <label for='genre' id='genre_form'> Genre : </label><input type='text' name='genre' id='genre' placeholder='humour,thriller,...'/>
                    <br/>
                <label for='remarques' id='remarques_form'>Tes remarques et impressions</label><input type='text' name='remarques' id='remarques'/>
                    <br/>
                <label for='img_couv' id='img_couv_form'>Une image de la couverture ça fait toujours plaisir aux yeux : (copier coller le lien url de l'image) </label>
                                    <input type='text' name='img_couv' id='img_couv'/>
                    <br/>
                </div>
                <!--pour l'upload du chemin de l'image de couverture mis en commentaire car pour le moment passe par le formulaire rajout_couv.php 
                <label for='img'>Envoi image de couverture : </label><input type='file' name='img' id='img'/>
                <input type='hidden' name='max_file_size' id='max_file_size' value='250000'/> pour éviter les fichiers trop volumineux !-->
                
                
                
                
                <input type='submit' value='valider'/>
            
        </body>
    </html>