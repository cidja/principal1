<!DOCTYPE html>
  <title>
    <head>Delete</head>
    <meta charset='utf-8'/>
  </title>
  <html>
    <body>
      
      <form method ='post' action='delete_one_confirm.php' name='valide_suppression'>
        <input type='hidden' name='id' id='id' value='<?php echo $_POST['id']; ?>'/> <!--on récupère l'id pour la requête !-->
        <label for='mdp'>Entrez le mot de passe pour supprimer le titre : <?php echo $_POST['titre_delete']; ?><br/>  </label>
        <input type='password' name='mdp' id='mdp' autofocus/>
        <input type='submit' value='valider'/>
      </form>
      
      <?php
      /*  Je vais le faire en deux pages pour tester si tout fonctionne j'essaie ensuite de le faire en une fois
include('connexion.php');


$password = $_POST['mdp'];

if(empty($password == 'mdp'))
  {
  ?>
    <form method='post' action='delete_one.php'/>
      <label for='mdp'/>  Merci de rentrer le mot de passe admin pour confirmer la suppression : <input type='password' name='mdp' id='mdp'/>
      <input type='submit' value='valider'/>
    <form/>
    <?php
  }
  elseif($password == 'mdp')
  {
    $delete = $bdd->execute('DELETE FROM livres_lus WHERE id=:id');
    $delete->execute(array(
      'id'    => $_POST['id']
    ));
   
  }  
else {
  echo 'Mauvais mot de passe pour confirmer la suppression';
}
*/

?>

    </body>
  </html>

