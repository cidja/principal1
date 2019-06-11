<?php
include_once('/var/www/public/private/git/labo/fonctions/connexion.php');
$uploaddir = "/var/www/public/private/git/labo/img/";
$uploadfile = $uploaddir . basename($_FILES['tabfichier']['name']);

//via la fonction substr qui coupe les string comme l'on souhaite je découple $uploadfile pour ne garder que 
// /private/git/labo/img/ pour que les images soit bien retrouvé dans le dossier du serveur par php
$uploadfile_bdd = substr($uploadfile, 15, 100);  
$ext_type = array('gif','jpg','jpe','jpeg','png','image/jpeg');

echo '<pre>'; //pour afficher les saut de ligne des prochains echo

//pour vérifier si l'extension du fichier est autorisée


if(in_array($_FILES['tabfichier']['type'], $ext_type)){
    if(move_uploaded_file($_FILES['tabfichier']['tmp_name'],$uploadfile))
{
    echo 'Le fichier est valide, voici quelques informations a propos de ce fichier :
         - sa taille : ', $_FILES['tabfichier']['size'] ,
         '- son type : ' , $_FILES['tabfichier']['type'] ,
         ' - son nom : ' , $_FILES['tabfichier']['name'];

         //requête sql utilisé pour rentrer directement dans la base de données labo1 le lien 
         //pour afficher l'image sur le site (image stocké dans /var/www/public/private/git/labo/img/)
         //source:  http://www.lephpfacile.com/manuel-php/pdostatement.execute.php
         
    $req = $bdd->prepare('INSERT INTO labo1(img) VALUES (?)');
    $req->execute(array( //j'exécute la requête préparée avec comme argument $uploadfile
        $uploadfile_bdd
    ));
       
}
}

else{
    echo 'le fichier n\'nest pas valide';
}

 echo '<br/> voici quelques informations de débogage : <br/>';
print_r($_FILES);
echo '</pre>';


echo $uploadfile . '<br/>';
$

echo $uploadfile_bdd;


?>
