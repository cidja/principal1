<?php
include ('connexion.php'); //on inclue le


/*on transforme la superglobale variable $_POST en variable plus
*a travailler avec toujours échappement des caractères html via la fonction htmlspecialchars*/
$id         = htmlspecialchars($_POST['id']);
$auteur     = htmlspecialchars($_POST['auteur']);
$tome       = htmlspecialchars($_POST['tome']);
$nb_pages   = htmlspecialchars($_POST['nb_pages']);
$debut      = htmlspecialchars($_POST['debut']);
$fin        = htmlspecialchars($_POST['fin']);
$remarques  = htmlspecialchars($_POST['remarques']);
$img        = htmlspecialchars($_POST['img']);

//on ajoute une requête préparée
$req_update = $bdd->prepare('UPDATE livres_lus SET auteur=:auteur, tome=:tome,nb_pages=:nb_pages, debut=:debut,
                            fin=:fin, remarques=:remarques, img=:img WHERE id=:id'); //Bien vérifier si idem dans les bound_variables surtout la syntaxe
$req_update->execute(array(
  'auteur'    => $auteur,
  'tome'      => $tome,
  'nb_pages'  => $nb_pages,
  'debut'     => $debut,
  'fin'       => $fin,
  'remarques' => $remarques,
  'img'       => $img,
  'id'        =>$id
));
$req_update->closeCursor(); //On ferme la curseur php pour le libérer pour une prochaine requête

header('Location:\private\git\mon_site_web\tp_livre_lus\accueil_caroussel_livre.php'); //pour la redirection vers l'accueil directement le client ne verra pas ça
?>
