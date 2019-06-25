<?php
/*on se connecte d'abord à la base de données*/
include ('connexion.php'); // Connexion à la base de données
    
    
/*if(isset($_POST['titre']) AND isset ($_POST['scenario']) AND isset ($_POST['album_numero']) AND isset($_POST['debut']) AND isset($_POST['fin']))
    {
    echo $_POST['titre'];
    }
else
    {
    echo "il faut tout remplir j'ai dit !!!";
    }
MIS EN DORMANCE POUR AVANCER A REVENIR DESSUS POUR SECURISER LES ENVOIS DE DONNEES
*/
$serie          = htmlspecialchars($_POST['serie']);
$titre          = htmlspecialchars($_POST['titre']); /*je transforme les requêtes $_POST en variables plus simple à travailler*/
$scenario       = htmlspecialchars($_POST['scenario']);/*CE LIT DE DROITE A GAUCHE*/
$dessin         = htmlspecialchars($_POST['dessin']);
$genre          = htmlspecialchars($_POST['genre']);
$album_numero   = htmlspecialchars($_POST['album_numero']);   
$remarques      = htmlspecialchars($_POST['remarques']);
$img_couv       = htmlspecialchars($_POST['img_couv']);

//on ajoute une requête préparée
$req = $bdd->prepare('INSERT INTO bd(serie, titre, scenario, dessin, album_numero, genre, remarques, img_couv, date_ajout)
                      VALUES (:serie, :titre, :scenario, :dessin, :album_numero, :genre, :remarques, :img_couv, now())'); //Bien vérifier si idem dans les bound_variables surtout la syntaxe
$req->execute(array(
    'serie'         => $serie,
    'titre'         => $titre,
    'scenario'      => $scenario,
    'dessin'        => $dessin,
    'album_numero'  => $album_numero,
    'genre'         => $genre,
    'remarques'     => $remarques,
    'img_couv'      => $img_couv
));
$req->closeCursor(); //on ferme le curseur pour si une autre requête se prépare ensuite

header('Location:http://127.0.0.1/private/git/tp_livre_lus/accueil_bd.php'); //pour la redirection vers l'accueil directement le client ne verra pas ça
?>
<!--<br/>Pour retourner à l'accueil <a href='//accueil.php'>Cliquer ici</a>  !-->

