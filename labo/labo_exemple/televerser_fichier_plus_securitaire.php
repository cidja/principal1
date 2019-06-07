//téléverser des fichiers plus sécuritaire

<html>
    <head>
    <title>Formulaire de téléversement en PHP</title>
    </head>
        <body>
            <form method="post" action="upload.php" enctype="multipart/form-data">
            Selectionnez un type de fichier  JPG, GIF, PNG ou TIF:
            <input type="file" name="nomfichier" size="10">
            <input type= "submit" value="Déposer">
            </form>

<?Php
if ( $_FILES)
{
    $nom = $_FILES['nomfichier']['name'];
    
    switch($_FILES['nomfichier']['type'])
    {
        case 'image/jpeg':  $ext = 'jpg'; break;
        case 'image/gif' :  $ext = 'gif'; break;
        case 'image/png' :  $ext = 'png'; break;
        case 'image/tiff' : $ext = 'tif'; break;
        default:            $ext = ''; break;
    }
if ($ext)
{
    $n = "image.$ext";
    move_uploaded_file($_FILES['nomfichier']['tmp_name'], $n);
    echo "image téléchargée : '$nom' de type '$n' :<br>";
    "<img src='$n'>";
}
else echo "'$nom' n'est pas accepté comme fichier image";
}
else echo "Aucune image chargée";

?>
</body>
</html>