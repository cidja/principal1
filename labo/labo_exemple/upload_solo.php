<?php

$uploaddir = "/var/www/public/private/git/labo/img/";
$uploadfile = $uploaddir . basename($_FILES['tabfichier']['name']);


echo '<pre>'; //pour afficher les saut de ligne des prochains echo
if(move_uploaded_file($_FILES['tabfichier']['tmp_name'],$uploadfile))
{
    echo 'Le fichier est valide, voici quelques informations a propos de ce fichier :
         - sa taille : ', $_FILES['tabfichier']['size'] ,
         '- son type : ' , $_FILES['tabfichier']['type'] ,
         ' - son nom : ' , $_FILES['tabfichier']['name'];
}
else{
    echo 'le fichier n\'nest pas valide';
}

echo 'voici quelques informations de débogage : <br/>';
print_r($_FILES);
echo '</pre>';
?>

