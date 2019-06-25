
test d'une fonction pour faire un décompte du temps en jour que ça a pris pour lire un livre<br/>
<!DOCTYPE html>
    <html>
        <head>
            <title>Test</title>
            <meta charset='utf-8'/> <!--on choisi utf-8 comme encodage car affiche tous bien accents y compris!-->
            <link rel='stylesheet' href='css/style.css'/>
            <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet"> <!--On ajoute une font google!-->
        </head>
        <body>
            <a href='accueil_principal.php' class='accueil_lien'>Accueil</a>
            
            <h1 style='text-align: center; text-decoration : underline;'>Liste des livres lus par Christian GEORGES</h1><br/> <!--On centre le titre sur la page !-->
            
            
            <h3>Classé du plus récent au plus ancien (les 15 derniers)</h3>
            <?php include ('/wamp64/www/private/git/tp_livre_lus/php/connexion.php'); /*J'inclus le fichier connexion.php situé dans le dosssier php
                                            *pour éviter de surcharger le code accueil et pour une meilleure
                                            *lisibilité du code*/
 $_SERVER['DOCUMENT_ROOT']; //Si l'on veut connaitre la racine du serveur web pour un affichage en chemin absolu comme indiqué au dessus
            /*pour créer un compteur depuis quand l'ajout du livre a était fait */
            $jour = '00';
            $heure = '00';
            $timestamp_day = mktime($jour);
            $time_day = time() - $timestamp_day;
            $jour_day = floor($heure/24);


            /*requete d'affichage à la base de données des 15 derniers résultats avec la fonction ORDER BY ... DESC */
            $reponse = $bdd->query('SELECT id,titre,auteur,tome,debut,fin,
                                   remarques,img,DATE_FORMAT(date_ajout, "%d-%m-%Y  à %Hh%i:%ssec") as date_fr FROM livres_lus  ORDER BY id DESC LIMIT 15');
                                    //fonction date_format permet de mettre la date au format que je souhaite pour date_debut, date_fin_ date_ajout
            while($donnees = $reponse->fetch())
                {   /*j'ai organisé cette boucle afin d'avoir à chaque fois un saut à la ligne pour afficher les
                    *résultats cela fait plus joli je trouve*/
                //echo 'id : ' . $donnees['id'] . ' <br/>  c'était pour les tests pour voir l'ID pas utile lors de la production
                
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
                
                $debut = date_create($donnees['debut']);
                $fin = date_create($donnees['fin']);
                $interval = date_diff($debut, $fin);
                $res_interval = $interval->format ('%a');
                ?>
                <!--J'ai mis des div pour classer ensuite dans une grille css!-->
                <!--Il y a 2 classes div par ligne un avec l'intitulé et l'autre avec la réponse de while pour les séparer dans le tableau css!-->
                    <div class='tableau_livres'>
                        <div class='id'>Id unique du titre (à bien retenir pour ajouter/remplacer une couverture) : </div> <div class='id_reponse'><?php echo $donnees['id']; ?></div>
                        <div class='titre'> Titre  : </div> <div class='titre_reponse'><?php echo $donnees['titre']; ?></div>
                        <div class='auteur'> Auteur  : </div> <div class='auteur_reponse'><?php echo $donnees['auteur'];?></div>
                        <div class='nb_tomes'> Nombre de tomes : </div> <div class='nb_tomes_reponse'><?php echo $donnees['tome']; ?></div>
                        <div class='debut'> Début de la lecture : </div> <div class='debut_reponse'><?php  $date_debut = date_create($donnees['debut']); echo date_format($date_debut, 'd/m/Y'); ?></div>
                        <div class='fin'> Fin de la lecture : </div> <div class='fin_reponse'><?php if(empty($donnees['fin'])) { echo "<div style = color : red >pas fini</div>";}
                                                                                                    else { $date = date_create($donnees['fin']); echo date_format($date, 'd/m/Y'); }?></div> <!--Condition if else pour rajouter du texte si vide !-->
                                                                                                    Il a été lu en : <?php echo  $res_interval; ?> jours.
                        <div class='remarques'> Remarques  : </div> <div class='remarques_reponse'><?php if(empty($donnees['remarques'])) { echo 'Rien de particulier à dire'; }
                                                                                                    else {echo $donnees['remarques'];}?></div> <!--Condition if else pour rajouter du texte si vide !-->
                        <div class='date_ajout'> Date d'ajout  : </div> <div class='date_ajout_reponse'> <?php if($donnees['date_fr'] == '00-00-0000 à 00h00:00sec') { echo "pas de date d'ajout inscrite reste un mystère";}
                                                                              else {echo 'Le : ' . $donnees['date_fr'] .' ajouté il y a ' . $jour . ' jours, ou en mois, il y a : ' . $mois . 'mois';} ?> </div><!--Condition if else qui inscrit un message si date ajout correspond à 0 !-->
                        <div class='img_couv'><img src="<?php echo $donnees['img'];?>"/></div> <!--affichage de la couverture du livre qui est dans un dossier img en local et uniquement le chemin d'accès dans la bdd !-->
                            <form method='get' action='php/form_modif.php' name='modification'/>
                              <input type='hidden' name='id' id='id' value="<?php echo $donnees['id'];?>"/>
                              <input type='submit' value='modifier' class='bouton_supprimer'/></form> <!-- class donnée pour mettre dans la grille css!-->
                            <form method='post' action='php/delete_one.php' name='delete'/>
                              <input type='hidden' name='id' id='id' value='<?php echo $donnees['id'];?>'/> <!--on récupére l'id actuel du tableau pour le transférer sur delete_one !-->
                              <input type='hidden' name='titre_delete' id='titre_delete' value='<?php echo $donnees['titre']; ?>'/> <!--on récupére le titre actuel du tableau pour le transférer sur delete_one !-->
                                <input type='submit' value='supprimer' class='bouton_supprimer'/> <!-- class donnée pour mettre dans la grille css!-->
                            </form>

                    </div><br/><br/> <!--on break pour laisser de l'espace entre chaque tableaux !-->
                <?php //je réouvre balises php pour clôturer la requête
                //on peut utiliser la fonction date_diff
                
               
                //Pour voir les jours, ans etc... en dessous
                //  echo 'ajouté il y a : ' .  $annee.' ans / '.$mois.' mois / '.$jour.' jours / '.$heure.' heures / '.$minute.' minutes / '.$seconde.' secondes <br />';                
                }

$reponse ->closeCursor(); /*on ferme le curseur de requête pour le laisser libre pour la prochaine requête*/
?>
<p>Pour rajouter un ouvrage <a href="php/rajout.php">c'est par ici</a></p>
<!--<p>Pour ajouter une image de couverture (si ce n'est pas déjà fait) <a class='rajout_couv' href="php/rajout_couv.php">C'est par la</a></p>
Ligne du dessus annulé car j'ai mis dans le formulaire modifier la possibilité de rajouter une image de couverture directement!--> 

        </body>
    </html>

