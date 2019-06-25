<?php
include ('connexion.php'); //on se connecte à la base livres

$id             = htmlspecialchars($_POST['id']); //On récupére la superglobale du form $_POST qu'on transforme en variable c'est plus simple pour travailler
$scenario       = htmlspecialchars($_POST['scenario']);
$dessin         = htmlspecialchars($_POST['dessin']);
$album_numero   = htmlspecialchars($_POST['album_numero']);
$genre          = htmlspecialchars($_POST['genre']);
$remarques      = htmlspecialchars($_POST['remarques']);
$img_couv       = htmlspecialchars($_POST['img_couv']);

//on ajoute une requête préparée
$req_update_bd = $bdd->prepare('UPDATE bd SET scenario=:scenario, dessin=:dessin, album_numero=:album_numero,
                               genre=:genre, remarques=:remarques, img_couv=:img_couv WHERE id=:id'); //Bien vérifier si idem dans les bound_variables surtout la syntaxe
$req_update_bd->execute(array(
    'scenario'      => $scenario,
    'dessin'        => $dessin,
    'album_numero'  => $album_numero,
    'genre'         => $genre,
    'remarques'     => $remarques,
    'img_couv'      => $img_couv,
    'id'            => $id
));
$req_update_bd->closeCursor(); //on ferme le pointeur PHP pour le libérer pour la prochaine requête si besoin

header('Location:http://127.0.0.1/private/git/tp_livre_lus/accueil_bd.php')
?>
