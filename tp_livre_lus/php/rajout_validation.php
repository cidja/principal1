<?php
/*on se connecte d'abord à la base de données*/
include ('connexion.php'); // Connexion à la base de données
    
    
/*if(isset($_POST['titre']) AND isset ($_POST['auteur']) AND isset ($_POST['tome']) AND isset($_POST['debut']) AND isset($_POST['fin']))
    {
    echo $_POST['titre'];
    }
else
    {
    echo "il faut tout remplir j'ai dit !!!";
    }
MIS EN DORMANCE POUR AVANCER A REVENIR DESSUS POUR SECURISER LES ENVOIS DE DONNEES
*/


$titre      = htmlspecialchars($_POST['titre']); /*je transforme les requêtes $_POST en variables plus simple à travailler*/
$auteur     = htmlspecialchars($_POST['auteur']);/*CE LIT DE DROITE A GAUCHE*/
$tome       = htmlspecialchars($_POST['tome']);
$nb_pages   = htmlspecialchars($_POST['nb_pages']);
$debut      = htmlspecialchars($_POST['debut']); 
$fin        = htmlspecialchars($_POST['fin']);
$remarques  = htmlspecialchars($_POST['remarques']);
$img        = htmlspecialchars($_POST['img']);

//on ajoute une requête préparée
$req = $bdd->prepare('INSERT INTO livres_lus(titre, auteur, tome, nb_pages, debut, fin, remarques,img, date_ajout)
                      VALUES (:titre, :auteur, :tome, :nb_pages, :debut, :fin, :remarques, :img, now())'); //Bien vérifier si idem dans les bound_variables surtout la syntaxe
$req->execute(array(
    'titre'     => $titre,
    'auteur'    => $auteur,
    'tome'      => $tome,
    'nb_pages'  => $nb_pages,
    'debut'     => $debut,
    'fin'       => $fin,
    'remarques' => $remarques,
    'img'       => $img
));
$req->closeCursor(); //on ferme le curseur pour si une autre requête se prépare ensuite

header('Location:\private\git\mon_site_web\tp_livre_lus\accueil_caroussel_livre.php'); //pour la redirection vers l'accueil directement le client ne verra pas ça
?>
<!--<br/>Pour retourner à l'accueil <a href='//accueil.php'>Cliquer ici</a>  !-->

