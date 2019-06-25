<!DOCTYPE html>
    <?php
           require_once ('php/connexion.php'); /*J'exige une fois (require_once) le fichier connexion.php situé dans le dosssier php
                                            *pour éviter de surcharger le code accueil et pour une meilleure
                                            *lisibilité du code surtout si les mdp viennent à changer c'est plus simple*/
   $_SERVER['DOCUMENT_ROOT']; //Si l'on veut connaitre la racine du serveur web pour un affichage en chemin absolu comme indiqué au dessus
            /*pour créer un compteur depuis quand l'ajout du livre a était fait */
            ?>
    <html>
        <head>
            <title>Mes livres lus</title>
            <meta charset='utf-8'/> <!--on choisi utf-8 comme encodage car affiche tous bien accents y compris!-->
            <link rel='stylesheet' href='/private/git/mon_site_web/tp_livre_lus/css/style.css'/>
            <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet"> <!--On ajoute une font google!-->
            <link href="https://fonts.googleapis.com/css?family=Fredoka+One|Orbitron" rel="stylesheet">  
        </head>
        <body>
        <?php
          /*include_once (car besoin qu'une seule fois) du fichier menu.html pour l'affichage du menu dans toutes les pages c'est plus simple pour la gestion */
           include_once ('menu.html'); 
          ?> 
            <h1 id='titre_principal_haut_page'>
            Liste des livres lus par Christian GEORGES
            <br/>
            Classé par date d'ajout décroissant</h1>
            
            <?php
    $comptage = $bdd->query('SELECT COUNT(tome) FROM livres_lus'); //utilisé pour lire le nombre d'entrée dans un tableau, ici le nombre de livres via les titres
    ?>
    
    <div id='compteur_total'>Compteur de livres lus : <?php echo $comptage->fetchColumn(); ?></div>
    
            <?php
           
            $jour = '00';
            $heure = '00';
            $timestamp_day = mktime($jour);
            $time_day = time() - $timestamp_day;
            $jour_day = floor($heure/24);


            /*requete d'affichage à la base de données des 15 derniers résultats avec la fonction ORDER BY ... DESC */
            $reponse = $bdd->query('SELECT id,titre,auteur,tome,nb_pages,debut,fin,remarques,img,
                                   DATE_FORMAT(date_ajout, "%d-%m-%Y  à %Hh%i:%ssec") as date_fr FROM livres_lus  ORDER BY id DESC');
                                    //fonction date_format permet de mettre la date au format que je souhaite pour date_debut, date_fin_ date_ajout
            while($donnees = $reponse->fetch())
                {   /*j'ai organisé cette boucle afin d'avoir à chaque fois un saut à la ligne pour afficher les
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
                          <div class='nb_tomes_reponse'><?php echo $donnees['tome']; ?></div>
                        <div class='nb_pages'> Nombre de pages : </div>
                          <div class='nb_pages_reponse'>
                          <?php
                            if(empty($donnees['nb_pages'])) //condition if si pas de nb_pages renseigné affiche 'non renseigné'
                             {
                             echo 'non renseigné';
                             }        //sinon affiche $donnees['nb_pages']
                            else
                             {
                             echo $donnees['nb_pages'];
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
                        
                        <?php
                        // J'inclus le fichier du décompte du nombre de page de lecture plus aisément modifiable directement dans un seul fichier
                        include ('php/decompte_temps_lecture.php'); 
                        ?>

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
                        
                        <div class='img_couv'>
                         <img class='img_couv_livre' src="<?php echo $donnees['img'];?>"/>
                        </div> <!--affichage de la couverture du livre qui est dans un dossier img en local et uniquement le chemin d'accès dans la bdd !-->
                       
                        
                <?php //je réouvre balises php pour clôturer la requête
                

                  //J'inclue le bout de code (formulaire) pour les boutons supprimer et modifier, plus simple en maintenance.
                  include ('php/boutons_modif_suppr_livre.php'); 


                //Pour voir les jours, ans etc... en dessous
                //  echo 'ajouté il y a : ' .  $annee.' ans / '.$mois.' mois / '.$jour.' jours / '.$heure.' heures / '.$minute.' minutes / '.$seconde.' secondes <br />';                
                }
                

$reponse ->closeCursor(); /*on ferme le curseur de requête pour le laisser libre pour la prochaine requête*/
?>
<!--<p>Pour ajouter une image de couverture (si ce n'est pas déjà fait) <a class='rajout_couv' href="php/rajout_couv.php">C'est par la</a></p>
Ligne du dessus annulé car j'ai mis dans le formulaire modifier la possibilité de rajouter une image de couverture directement!--> 

        </body>
    </html>
