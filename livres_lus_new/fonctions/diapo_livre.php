<?php
include_once('/var/www/public/private/git/livres_lus_new/fonctions/connexion.php'); //inclusion du fichier connexion pour la base de données
include_once('/var/www/public/private/git/livres_lus_new/fonctions/debug.php'); //inclusion du fichier debug avec les fonctions utiles pour debuger
echo 'test';
function ficheLivre($bdd){ 
    //j'ai mis argument $bdd sinon ça ne fonctionnait pas 
    //mais je ne comprends pas pourquoi ça ne fonctionnait pas
    $req = $bdd->query('SELECT id,titre,auteur,tome,nb_pages,debut,fin,remarques,img,
    DATE_FORMAT(date_ajout, "%d-%m-%Y  à %Hh%i:%ssec") as date_fr FROM livres_lus');
    foreach($req as $key => $value)
    {
        ?>
        <!--J'ai mis des div pour classer ensuite dans une grille css!-->
        <!--Il y a 2 classes div par ligne un avec l'intitulé et l'autre avec la réponse de while pour les séparer dans le tableau css!-->
            
            <div class='tableau_livres'>
                <div class='titre'> Titre  : </div>
                  <div class='titre_reponse'><?php echo $value['titre']; ?></div>
                <div class='auteur'> Auteur  : </div>
                  <div class='auteur_reponse'><?php echo $value['auteur'];?></div>
                <div class='nb_tomes'> Nombre de tomes : </div>
                  <div class='nb_tomes_reponse'>
                  <?php
                  if ($value['tome'] <= 1)
                  {
                    echo 'Un seul ouvrage.';
                  }
                    else
                  {
                    echo $value['tome']; 
                  }?>
                   </div>
                <div class='nb_pages'> Nombre de pages : </div>
                  <div class='nb_pages_reponse'>
                  <?php
                    if(empty($value['nb_pages'])) //condition if si pas de nb_pages renseigné affiche 'non renseigné'
                     {
                     echo 'non renseigné';
                     }        //sinon affiche $value['nb_pages']
                    else
                     {
                     echo $value['nb_pages'], ' pages';
                     }?>
                  </div>
                  
                <div class='debut'> Début de la lecture : </div>
                  <div class='debut_reponse'>
                  <?php
                   $date_debut = date_create($value['debut']);
                                 echo date_format($date_debut, 'd/m/Y');
                  ?>
                  </div>
                  
                <div class='fin'> Fin de la lecture : </div>
                  <div class='fin_reponse'>
                  <?php
                    if(empty($value['fin']))
                     {
                      echo "<div style = color : red >pas fini</div>";
                     } //Condition if else pour rajouter du texte si vide !
                    else
                     {
                     $date = date_create($value['fin']); //création variable $date pour fonction date_create
                     echo date_format($date, 'd/m/Y');
                     }?>
                  </div> <!--fonction date_format qui permet de formater $date en php comme je le souhaite en sortie!-->
                  
                <div class='decompte_lecture'>Il a été lu en : </div>
                <div class='decompte_lecture_reponse'> <!--condition if pour afficher pas terminé si $value['fin'] pas rentrée !-->
                <?php
                  if(empty($value['fin'])) //vérification si $value['fin'] vide ou non si vide affiche pas terminé
                 {
                 echo 'Pas terminé';
                 }
                 else {
                   $debut = date_create($value['debut']); //on classe le résultat dans une variable pour l'utiliser plus facilement ensuite
                   $fin = date_create($value['fin']);
                   $interval = date_diff($debut, $fin); //fonction qui va faire la différence entre la date de début et de fin
                   $res_interval = $interval->format ('%a jours');
                   echo $res_interval; //affichage des $res_interval pour le résultat
                      }?>
               </div>
                
                <div class='remarques'> Remarques  : </div>
                <div class='remarques_reponse'>
                <?php
                  if(empty($value['remarques']))
                   {
                    echo 'Rien de particulier à dire';
                   }
                  else
                   {
                   echo $value['remarques'];
                   }?>
                </div> <!--Condition if else pour rajouter du texte si vide !-->
                <div class='date_ajout'> Date d'ajout  : </div>
                <div class='date_ajout_reponse'>
                <?php
                  if($value['date_fr'] == '00-00-0000  à 00h00:00sec')
                   {
                   echo "pas de date d'ajout inscrite reste un mystère";
                   }
                  else
                   {
                   echo 'Le : ' . $value['date_fr'] .' ajouté il y a ' . $jour . ' jours, ou en mois, il y a : ' . $mois . 'mois';
                   }?>
                </div> <!--Condition if else qui inscrit un message si date ajout correspond à 0 !-->

                <?php
                // J'inclus le fichier du décompte du nombre de page de lecture plus aisément modifiable directement dans un seul fichier
                include ('C:\wamp64\www\private\git\mon_site_web\tp_livre_lus\php\decompte_temps_lecture.php'); 
                ?>

                <div class='img_couv'>
                 <img class='img_couv_livre' src="<?php echo $value['img'];?>"/>
                </div> <!--affichage de la couverture du livre qui est dans un dossier img en local et uniquement le chemin d'accès dans la bdd !-->
               
                <?php include('C:\wamp64\www\private\git\mon_site_web\tp_livre_lus\php\boutons_modif_suppr_livre.php'); //fichier inclusion pour les deux boutons supprimer et modifeier au moins pas de galère si je dois revenir dessus//
      
        //Pour voir les jours, ans etc... en dessous
        //  echo 'ajouté il y a : ' .  $annee.' ans / '.$mois.' mois / '.$jour.' jours / '.$heure.' heures / '.$minute.' minutes / '.$seconde.' secondes <br />';                
        $reponse ->closeCursor(); /*on ferme le curseur de requête pour le laisser libre pour la prochaine requête*/

        echo '<br/>' . $value['titre'] . '<br/>' . $value['auteur']; 
        }
    }
   

 ficheLivre($bdd);
?>
