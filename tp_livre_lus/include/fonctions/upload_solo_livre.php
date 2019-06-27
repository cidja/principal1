<?php
require_once ('/var/www/public/private/git/tp_livre_lus/include/config.inc.php'); /*J'inclus le fichier connexion.php situé dans le dosssier php
*pour éviter de surcharger le code accueil et pour une meilleure
*lisibilité du code*/
$uploaddir = "/var/www/public/private/git/tp_livre_lus/img/couv_livres";
$uploadfile = $uploaddir . basename($_FILES['tabfichier']['name']);

//via la fonction substr qui coupe les string comme l'on souhaite je découple $uploadfile pour ne garder que 
// /private/git/labo/img/ pour que les images soit bien retrouvé dans le dossier du serveur par php
$uploadfile_bdd = substr($uploadfile, 15, 100);  



//array qui va être comparé au type de ['tabfichier']['type']
//si présent dans le array alors  fichier valide sinon invalide

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
    
         $id = $_POST['id'];
    $req = $bdd->prepare('INSERT INTO livre(img) VALUES (?) WHERE id=:id');
    $req->execute(array( //j'exécute la requête préparée avec comme argument $uploadfile
        $uploadfile_bdd
    ));
       
}
}

else{
    ?> le fichier n'nest pas valide <a href='televerse_img_livre.php'>cliquer ici pour réessayer</a>' <!--si pas valide on renvoi le visiteur sur la page d'upload!-->
    <?php
}

 echo '<br/> voici quelques informations de débogage : <br/>';
print_r($_FILES);
echo '</pre>';


echo $uploadfile . '<br/>';

echo $uploadfile_bdd;


?>
