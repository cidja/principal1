<!DOCTYPE html>
    <html>
        <head>
            <title>Modification du contenu</title>
            <meta charset='utf8'/>
            <link rel='stylesheet' href='../css/style_form.css'/>
        </head>
        <body>
            
            
            <?php
            include ('/var/www/public/private/git/tp_livre_lus/include/config.inc.php'); /*J'inclus le fichier connexion.php situé dans le dosssier php
            *pour éviter de surcharger le code accueil et pour une meilleure
            *lisibilité du code*/

            $id_accueil = $_GET['id']; //On récupére la superglobale du form accueil_grille_test.php qu'on transforme en variable c'est plus simple pour travailler
                //fonction qui récupére toutes les données avec une requête préparée
            $sql = $bdd->prepare('SELECT id,titre,auteur,tome,nb_pages,debut,fin,remarques,img FROM livres_lus WHERE id= :id_accueil'); //on prépare la requête on a enlevé date dans les paramétres car inutile sur cette requête
            $sql->bindValue(':id_accueil', $id_accueil, PDO::PARAM_INT); /*bindValue associe une valeur a un paramétre ici c'est :id_accueil dans la requête d'avant que l'on veut remplacer, PDO::PARAM_INT signifie que c'est un
                                                                         *entier sur lequel on travail source: https://secure.php.net/manual/fr/pdostatement.bindvalue.php */
            $sql ->execute();                                           //Pour finir on execute la requête
            $reponse = $sql->fetch();   //Avec fetch on parcourt le tableau un par un */
            ?>
            
            <p>Bienvenue dans l'endroit pour modifier les informations de l'ouvrage : <?php echo $reponse['titre'];?><p>
            
            <form method='post' action='form_modif_validation.php'/>
            <input type='hidden' name='id' id='id' value='<?php echo $reponse['id'];?>'/> <!--Je crée ce champ en hidden qui récupére la variable $id_accueil pour pouvoir le récupérer dans ma requête de validation ensuite pour WHERE !-->
            
            <div class='form_tableau'>
            <label for='auteur' id='auteur_form'>Auteur : </label>
                <input type='text' class='auteur_form_reponse' name='auteur' id='auteur' value = '<?php echo $reponse['auteur']; ?>'/> <!--on récupére l'ID POUR GRID AREA EN CSS ET PAS LE CLASS pour toucher plus facilement au style pour le font-size du document en entier !-->
            <br/>
            <label for='tome' id='tome_form'>Nombre de tomes : </label>
                <input type='number' class='tome_form_reponse' name='tome' id='tome' value = '<?php echo $reponse['tome']; ?>'/>
            <br/>
            <label for='nb_pages' id='nb_pages_form'>Nombre de pages : </label>
                <input type='number' class='nb_pages_form_reponse' name='nb_pages' id='nb_pages' value ='<?php echo $reponse['nb_pages']; ?>'/>
            <br/>
            <label for='debut' id='debut_form'>Date de début de lecture : </label>
                <input type='date' min='2017-01-01' max='2025-01-01' class='debut_form_reponse' name='debut' id='debut' value = '<?php echo $reponse['debut']?>'/> <!--min et max servent à bloquer le calendrier dans le navigateur!-->
            <br/>
            <label for='fin' id='fin_form'>Date de fin de lecture : </label>
                <input type='date' min='2017-01-01' max='2025-01-01' class='fin_form_reponse' name='fin' id='fin' value = '<?php echo $reponse['fin']?>'/>
            <br/>
            <label for='remarques' id='remarques_form'> Remarques particulières concernant le livre ? : </label>
                <input type='text' class='remarques_form_reponse' name='remarques' id='remarques' value='<?php echo $reponse['remarques']?>'/>
            <br/>
            <label for='img' id='img_form'> image de couverture (copier l'adresse du lien de l'image de couverture trouvée sur internet) </label>
                <input type='text' class='img_form_reponse' name='img' id='img' value = '<?php echo $reponse['img']?>'/>
            <br/>
            <div class='text_img'> Image de couverture actuelle : </div> <br/>
                <?php
                    if(empty($reponse['img']))
                     {
                        echo 'il n\'y a pas d\'image de couverture actuellement c\'est le moment d\'en mettre une lancez-vous ! ';
                     }
                    else
                     {
                       ?>
                       <img  class='couv_presente' src='<?php echo $reponse['img'];?>'/>
                       <?php
                     }
                ?>
            </div> <!-- fin du div  pour la grille pour les choix des boutons !-->
            <input type='submit' value='valider'/>
            
            <br/><br/><br/>
            
            
        </body>
    </html>
