<?php
/*
Sera utile plus tard pour faire un script pour lancer l'enregistrement du chemin d'accès de l'image dans la base de données
include_once('/private/git/labo/fonctions/connexion.php');

$lien_img   = $_POST['nomfichier'];


$req= $bdd->query('INSERT INTO labo1 VALUES ID,nom_img=nom,lien_img=:lien_img,extension=.jpg');

header('location:../accueil.php');
*/
$uploaddir = "/var/www/public/private/git/labo/img/";
$uploadfile = $uploaddir . basename($_FILES['nomfichier']['name']);

echo '<pre>';
if(move_uploaded_file($_FILES['nomfichier']['tmp_name'], $uploadfile)) {
    echo "le fichier est valide voici plus d'informations :\n";
}
else {
    echo "fichier invalide";
}

echo 'Voici quelques informations de débogage : ';
print_r($_FILES);

echo '</pre>';


?>


