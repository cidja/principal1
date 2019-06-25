<!DOCTYPE html>
    <head>
        <title>Rajout d'une image de couverture</title>
        <meta charset='utf8'/>
    </head>
    <body>
        <?php include('connexion.php'); /*On fait appel à la base de données avec le fichier connexion.php */ ?>
        
        <form method='post' action='rajout_couv_validate.php'/>
        <label for='select_id'>Sélectionner l'id à modifier : </label><input type='number' name='select_id' id='select_id'/> <!--Cette ligne est la pour sélectionner l'id a modifier pour que la bdd comprenne!-->
        <label for='img_couv'>Copier/coller le lien de l'adresse du lien avec l'image</label><input type='text' name='img_couv' id='img_couv'/>
        <input type='submit' value='valider'/>
    </body>