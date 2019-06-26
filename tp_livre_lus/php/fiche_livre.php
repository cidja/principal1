<!DOCTYPE html>
    
    <html>
        <head>
            <title>Mes livres lus</title>
            <meta charset='utf-8'/> <!--on choisi utf-8 comme encodage car affiche tous bien accents y compris!-->
            <link rel='stylesheet' href='/private/git/tp_livre_lus/css/style.css'/>
            <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet"> <!--On ajoute une font google!-->
            <link href="https://fonts.googleapis.com/css?family=Fredoka+One|Orbitron" rel="stylesheet">  
        </head>
        <body>
        <?php
          /*include du fichier menu.html pour l'affichage du menu dans toutes les pages c'est plus simple pour la gestion 
           include ('menu.html');  
           PAS JUGER UTILE POUR LE MOMENT (5.5.19)*/
          ?> 
          <h2><a href='../accueil_caroussel_livre.php'>Retour au carroussel des livres</a></h2>
          <?php
           require_once ('/var/www/public/private/git/tp_livre_lus/include/config.inc.php'); /*J'inclus le fichier connexion.php situé dans le dosssier php
           *pour éviter de surcharger le code accueil et pour une meilleure
           *lisibilité du code*/
 // $_SERVER['DOCUMENT_ROOT']; //Si l'on veut connaitre la racine du serveur web pour un affichage en chemin absolu comme indiqué au dessus
            /*pour créer un compteur depuis quand l'ajout du livre a était fait */




            $reponse = $bdd->prepare('SELECT id,titre,auteur,tome,nb_pages,debut,fin,remarques,img,
            DATE_FORMAT(date_ajout, "%d-%m-%Y  à %Hh%i:%ssec") as date_fr FROM livres_lus WHERE id=?');
            if ($reponse->execute(array($_GET['id']))){
                while($donnees = $reponse->fetch()){
                    /*j'ai organisé cette boucle afin d'avoir à chaque fois un saut à la ligne pour afficher les
                    *résultats cela fait plus joli je trouve*/
                //echo 'id : ' . $donnees['id'] . ' <br/>  c'était pour les tests pour voir l'ID pas utile lors de la production
                
                
                
                date_default_timezone_set('Europe/Paris'); // sélection du fuseau horaire par défaut (très utile si serveur pas sur le même fuseau horaire que le pays accessible via le site)
                //POUR AVOIR LE DECOMPTE DEPUIS LA DATE DAJOUT 
                //var_dump($donnees['date_fr']);  // 09-02-2019  à 21h48:01sec
                $heure = substr($donnees['date_fr'], -11, 2); //récupération des heure avec substr qui coupe une chaine string idem pour celle en dessous
                //var_dump($heure);
                $minute = substr($donnees['date_fr'], -8,2); //récupération des minutes avec substr qui coupe une chaine string
                //var_dump($minute);
                $seconde = substr($donnees['date_fr'], -5, 2); //récupération des secondes avec substr qui coupe une chaine string
                //var_dump($seconde);
                $jour = substr($donnees['date_fr'], 0, 2); //récupération des jour avec substr qui coupe une chaine string
                //var_dump($jour);
                $mois = substr($donnees['date_fr'], 3, 2);//récupération des mois avec substr qui coupe une chaine string
                //var_dump($mois);
                $annee = substr($donnees['date_fr'], 6, 4); //récupération des annee avec substr qui coupe une chaine string
                //var_dump($annee);
                $timestamp = mktime($heure,$minute,$seconde, $mois, $jour, $annee); //création timestamp avec nos variables au dessus
                $time = time() - $timestamp; //soustraction avec le time actuel
                $seconde = floor($time);
                $minute = floor($seconde/60);
                $heure = floor($minute/60);
                $jour = floor($heure/24);
                $mois = floor($jour/31);
                $annee = floor($jour/365.25);
                
                //pour savoir en combien de temps a était lu le livre c'est un date_diff qui calcul la différence de temps entre la date de fin et celle de début pour en déduire un résultat
                
                
                ?>
                <!--J'ai mis des div pour classer ensuite dans une grille css!-->
                <!--Il y a 2 classes div par ligne un avec l'intitulé et l'autre avec la réponse de while pour les séparer dans le tableau css!-->
                    
                    <div class='tableau_livres'>
                        <div class='titre'> Titre  : </div>
                          <div class='titre_reponse'><?php echo $donnees['titre']; ?></div>
                        <div class='auteur'> Auteur  : </div>
                          <div class='auteur_reponse'><?php echo $donnees['auteur'];?></div>
                        <div class='nb_tomes'> Nombre de tomes : </div>
                          <div class='nb_tomes_reponse'>
                          <?php
                          if ($donnees['tome'] <= 1)
                          {
                            echo 'Un seul ouvrage.';
                          }
                            else
                          {
                            echo $donnees['tome']; 
                          }?>
                           </div>
                        <div class='nb_pages'> Nombre de pages : </div>
                          <div class='nb_pages_reponse'>
                          <?php
                            if(empty($donnees['nb_pages'])) //condition if si pas de nb_pages renseigné affiche 'non renseigné'
                             {
                             echo 'non renseigné';
                             }        //sinon affiche $donnees['nb_pages']
                            else
                             {
                             echo $donnees['nb_pages'], ' pages';
                             }?>
                          </div>
                          
                        <div class='debut'> Début de la lecture : </div>
                          <div class='debut_reponse'>
                          <?php
                           $date_debut = date_create($donnees['debut']);
                                         echo date_format($date_debut, 'd/m/Y');
                          ?>
                          </div>
                          
                        <div class='fin'> Fin de la lecture : </div>
                          <div class='fin_reponse'>
                          <?php
                            if(empty($donnees['fin']))
                             {
                              echo "<div style = color : red >pas fini</div>";
                             } //Condition if else pour rajouter du texte si vide !
                            else
                             {
                             $date = date_create($donnees['fin']); //création variable $date pour fonction date_create
                             echo date_format($date, 'd/m/Y');
                             }?>
                          </div> <!--fonction date_format qui permet de formater $date en php comme je le souhaite en sortie!-->
                          
                        <div class='decompte_lecture'>Il a été lu en : </div>
                        <div class='decompte_lecture_reponse'> <!--condition if pour afficher pas terminé si $donnees['fin'] pas rentrée !-->
                        <?php
                          if(empty($donnees['fin'])) //vérification si $donnees['fin'] vide ou non si vide affiche pas terminé
                         {
                         echo 'Pas terminé';
                         }
                         else {
                           $debut = date_create($donnees['debut']); //on classe le résultat dans une variable pour l'utiliser plus facilement ensuite
                           $fin = date_create($donnees['fin']);
                           $interval = date_diff($debut, $fin); //fonction qui va faire la différence entre la date de début et de fin
                           $res_interval = $interval->format ('%a jours');
                           echo $res_interval; //affichage des $res_interval pour le résultat
                              }?>
                       </div>
                        
                        <div class='remarques'> Remarques  : </div>
                        <div class='remarques_reponse'>
                        <?php
                          if(empty($donnees['remarques']))
                           {
                            echo 'Rien de particulier à dire';
                           }
                          else
                           {
                           echo $donnees['remarques'];
                           }?>
                        </div> <!--Condition if else pour rajouter du texte si vide !-->
                        <div class='date_ajout'> Date d'ajout  : </div>
                        <div class='date_ajout_reponse'>
                        <?php
                          if($donnees['date_fr'] == '00-00-0000  à 00h00:00sec')
                           {
                           echo "pas de date d'ajout inscrite reste un mystère";
                           }
                          else
                           {
                           echo 'Le : ' . $donnees['date_fr'] .' ajouté il y a ' . $jour . ' jours, ou en mois, il y a : ' . $mois . 'mois';
                           }?>
                        </div> <!--Condition if else qui inscrit un message si date ajout correspond à 0 !-->

                        <?php
                        // J'inclus le fichier du décompte du nombre de page de lecture plus aisément modifiable directement dans un seul fichier
                        include ('/var/www/public/private/git/tp_livre_lus/php/decompte_temps_lecture.php'); 
                        ?>

                        <div class='img_couv'>
                         <img class='img_couv_livre' src="<?php echo $donnees['img'];?>"/>
                        </div> <!--affichage de la couverture du livre qui est dans un dossier img en local et uniquement le chemin d'accès dans la bdd !-->
                       
                        <?php include('/var/www/public/private/git/tp_livre_lus/php/boutons_modif_suppr_livre.php'); //fichier inclusion pour les deux boutons supprimer et modifeier au moins pas de galère si je dois revenir dessus//
              
                //Pour voir les jours, ans etc... en dessous
                //  echo 'ajouté il y a : ' .  $annee.' ans / '.$mois.' mois / '.$jour.' jours / '.$heure.' heures / '.$minute.' minutes / '.$seconde.' secondes <br />';                
                }
            }
            
$reponse ->closeCursor(); /*on ferme le curseur de requête pour le laisser libre pour la prochaine requête*/

?>

           
        </body>
    </html>