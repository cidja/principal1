<!DOCTYPE html>
<html>
    <head>
        <title>Expérimentation pour l'envoi d'un fichier</title>
        <meta charset='utf8'/>
    </head>
    <body>
        Ceci est un test pour l'envoi d'une image dans le dossier :
        <br/> /var/www/public/private/git/labo/img/
        <br/>
        Voici  le formulaire a remplir :
        <br/>
        <form action='upload_solo.php' method='post' enctype="multipart/form-data">
            <label for='fichier' name='tabfichier'>
                Choisissez le fichier image a envoyer : </label>
                    <input type='file' name='tabfichier'/>
            <input type='submit' value='envoyer'/>
        </form>
    </body>
</html>