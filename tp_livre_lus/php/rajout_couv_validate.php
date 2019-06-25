<?php include('connexion.php'); /*On se connecte à la base de données */

$id       = htmlspecialchars($_POST['select_id']);
$img_couv = htmlspecialchars($_POST['img_couv']); /*on transforme la superglobale variable $_POST en variable plus simple
                                                   *a travailler avec toujours échappement des caractères html via la fonction htmlspecialchars*/
//on ajoute une requête préparée
$req_img = $bdd->prepare('UPDATE livres_lus SET img=:img  WHERE id=:id');
$req_img->execute(array(
        'id'    => $id,
        'img'   => $img_couv
));
$req_img->closeCursor(); //on ferme le curseur pour si une autre requête se prépare ensuite

header('Location:http://127.0.0.1/private/git/tp_livre_lus/accueil_grille_test.php'); //pour la redirection vers l'accueil directement le client ne verra pas ça

?>
<!--<br/>Pour retourner à l'accueil <a href='//accueil.php'>Cliquer ici</a>  !-->