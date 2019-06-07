<?php
//téléverser des fichiers
echo <<<_END
<html>
    <head>
    <title>Formulaire de téléversement en PHP</title>
    </head>
        <body>
            <form method="post" action="upload.php" enctype="multipart/form-data">
            Selectionnez le fichier : <input type="file" name="nomfichier" size="10">
            <input type= "submit" value="déposer">
            </form>
_END;

if ( $_FILES)
{
    $nom = $_FILES['nomfichier']['name'];
    move_uploaded_file($_FILES['nomfichier']['tmp_name'], $nom);
    echo "echo image téléchargée : '$nom'<br><img src='$nom'>";
}
echo "</body></html>";
?>
