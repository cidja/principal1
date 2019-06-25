<!DOCTYPE html>
    <html>
        <head>
            <title>Modification d'un ouvrage</title>
            <meta charset='utf-8'/>
            <link rel='stylesheet' href='../css/style_form_bd.css'/>
        </head>
        <body>
                 
            <?php
            include ('/var/www/public/private/git/tp_livre_lus/include/config.inc.php'); /*J'inclus le fichier connexion.php situé dans le dosssier php
            *pour éviter de surcharger le code accueil et pour une meilleure
            *lisibilité du code*/
            $id_accueil = $_GET['id']; //On récupére la superglobale du form accueil_grille_test.php qu'on transforme en variable c'est plus simple pour travailler
                //fonction qui récupére toutes les données avec une requête préparée
            $sql = $bdd->prepare('SELECT id,serie,titre,scenario,dessin,album_numero,genre,remarques,img_couv FROM bd WHERE id= :id_accueil'); //on prépare la requête on a enlevé date dans les paramétres car inutile sur cette requête
            $sql->bindValue(':id_accueil', $id_accueil, PDO::PARAM_INT); /*bindValue associe une valeur a un paramétre ici c'est :id_accueil dans la requête d'avant que l'on veut remplacer, PDO::PARAM_INT signifie que c'est un
                                                                         *entier sur lequel on travail source: https://secure.php.net/manual/fr/pdostatement.bindvalue.php */
            $sql ->execute();                                           //Pour finir on execute la requête
            $reponse = $sql->fetch();      //On parcourt le tableau un par un
            
            ?>
            <p>Bienvenue dans l'endroit pour modifier les informations de l'album : <?php echo $reponse['titre'] , ' / de la série : ' , $reponse['serie'];?><p>
            
           <form method='post' action='form_modif_validation_bd.php'/>
            <input type='hidden' name='id' id='id' value='<?php echo $reponse['id'];?>'/> <!--Je crée ce champ en hidden qui récupére la variable $id_accueil pour pouvoir le récupérer dans ma requête de validation ensuite pour WHERE !-->
            <div class='form_tableau'>
            <label for='scenario' id='scenario_form'>Scénariste : </label>
                <input type='text' name='scenario' id='scenario' value = '<?php echo $reponse['scenario'];?>'/> <!--RECUPERATION DE L'ID pour travailler sur la grid-area en css c'est plus simple que de passer par une class !-->
                
            <label for='dessin' id='dessin_form'> Dessinateur :</label>
                <input type='text' name='dessin' id='dessin' value='<?php echo $reponse['dessin'];?>'/>
                
            <label for='album_numero' id='album_numero_form'>Album numero : </label>
                <input type='number' name='album_numero' id='album_numero' value = '<?php echo $reponse['album_numero'];?>'/>
                
            <label for='genre' id='genre_form'>Genre de la BD (humour, fantasy,...) :</label>
                <input type='text' name='genre' id='genre' value='<?php echo $reponse['genre'];?>'/>
                
            <label for='remarques' id='remarques_form'> Remarques particulières concernant le livre ? : </label>
                <input type='text' name='remarques' id='remarques' value='<?php echo $reponse['remarques'];?>'/>
                
            <label for='img_couv' id='img_couv_form'> image de couverture (copier l'adresse du lien de l'image de couverture trouvée sur internet) </label>
                <input type='text'  name='img_couv' id='img_couv' value = '<?php echo $reponse['img_couv'];?>'/>
            <div class='text_img'> Image de couverture actuelle : </div> <br/>
                <?php
                    if(empty($reponse['img_couv']))
                     {
                        echo 'il n\'y a pas d\'image de couverture actuellement c\'est le moment d\'en mettre une lancez-vous ! ';
                     }
                    else
                     {
                       ?>
                       <img  class='couv_presente' src='<?php echo $reponse['img_couv'];?>'/>
                       <?php
                     }
                ?>    
            </div>
            <input type='submit' value='valider'/>
            <br/><br/><br/>
            
        </body>
    </html>