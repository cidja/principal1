<!DOCTYPE html>
<?php /*on inclu directement le fichier php comme cela on peut travailler tranquillement sur les requêtes ensuite ça évite les erreurs */
           include_once ('/var/www/public/private/tp_livre_lus/php/connexion.php'); /*J'inclus le fichier connexion.php situé dans le dosssier php
           *pour éviter de surcharger le code accueil et pour une meilleure
           *lisibilité du code*/
  $_SERVER['DOCUMENT_ROOT']; //Si l'on veut connaitre la racine du serveur web pour un affichage en chemin absolu comme indiqué au dessus
            /*pour créer un compteur depuis quand l'ajout du livre a était fait */
            ?>
    <html>
        <head>
            <title>Mes Bandes dessinées lus</title>
            <meta charset='utf-8'/> <!--on choisi utf-8 comme encodage car affiche tous bien accents y compris!-->
            <link rel='stylesheet' href='/private/tp_livre_lus/css/style_bd.css'/> <!--chemin absolu plus pratique pour le retrouver si je modifie l'emplacement de ce fichier php !-->
            <link href="https://fonts.googleapis.com/css?family=Satisfy" rel="stylesheet">  <!--On ajoute une font google!-->
            <link href="https://fonts.googleapis.com/css?family=Fredoka+One|Orbitron" rel="stylesheet">  <!--une autre font google !-->
        </head>
        <body>
        <?php
          /*include du fichier menu.html pour l'affichage du menu dans toutes les pages c'est plus simple pour la gestion */
           include ('../../menu.html'); 
          ?> 
                        
            <h1 id='titre_principal_haut_page'>
                Liste des BD lus par Christian GEORGES
                <br/>
                Classée par genre(aventure, humour, histoire, ...)
            </h1>
               
            <?php
    $comptage = $bdd->query('SELECT COUNT(id) FROM bd'); //utilisé pour lire le nombre d'entrée dans un tableau, ici le nombre de livres via les titres
    ?>
    
    <div id='compteur_total'>Compteur de BD lus : <?php echo $comptage->fetchColumn(); ?></div>
            <?php
            /*requete d'affichage à la base de données des 15 derniers résultats avec la fonction ORDER BY ... DESC */
            $reponse = $bdd->query('SELECT id,serie,titre,scenario,dessin,album_numero,genre,remarques,img_couv,DATE_FORMAT(date_ajout, "%d-%m-%Y  à %Hh%i:%ssec") as date_fr FROM bd  ORDER BY genre LIMIT 25');
                //Requête pour le classement par genre avec ORDER BY dans la requete
            
                                    //fonction date_format permet de mettre la date au format que je souhaite ici ex: date d'ajout : 20-01-2019 à 20h40:24sec
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
                ?>
                <!--J'ai mis des div pour classer ensuite dans une grille css!-->
                <!--Il y a 2 classes div par ligne un avec l'intitulé et l'autre avec la réponse de while pour les séparer dans le tableau css!-->
                    <div class='tableau_bd'>
                        <div class='serie'> Série  : </div>
                          <div class='serie_reponse'><?php echo $donnees['serie']; ?></div>
                        <div class='titre'> Titre de l'album :</div>
                          <div class='titre_reponse'><?php echo $donnees['titre']; ?></div>
                        <div class='scenario'> Scénariste  :</div>
                          <div class='scenario_reponse'><?php echo $donnees['scenario'];?></div>
                        <div class='dessin'> Dessinateur :</div>
                          <div class='dessin_reponse'><?php echo $donnees['dessin'];?></div>
                        <div class='album_numero'> Album numero : </div>
                          <div class='album_numero_reponse'><?php echo $donnees['album_numero']; ?></div>
                        <div class='genre'> Genre :</div>
                          <div class='genre_reponse'><?php echo $donnees['genre'];?></div>
                        <div class='remarques'> Remarques  : </div>
                          <div class='remarques_reponse'>
                          <?php if(empty($donnees['remarques']))
                                {
                                 echo 'Rien de particulier à dire';
                                }
                                else
                                {
                                 echo $donnees['remarques'];
                                }?>
                          </div> <!--Condition if else pour rajouter du texte si vide !-->
                          
                        <div class='date_ajout'> Date d'ajout  : </div>
                          <div class="date_ajout_reponse">
                          <?php if($donnees['date_fr'] == '00-00-0000 à 00h00:00sec')
                                 {
                                  echo "pas de date d'ajout inscrite reste un mystère";
                                 }
                                 else
                                 {
                                  echo 'Le : ' , $donnees['date_fr'] ,' ajouté il y a ' , $jour , ' jours';
                                  }?>
                          </div> <!--Condition if else qui inscrit un message si date ajout correspond à 0 !-->
                          
                        <div class='img_couv'><img class='img_couv_bd' src="<?php echo $donnees['img_couv'];?>"/></div> <!--affichage de la couverture du livre qui est dans un dossier img en local et uniquement le chemin d'accès dans la bdd !-->
                        <?php
                        include('/var/www/public/private/tp_livre_lus/php/boutons_modif_suppr_bd.php'); ?>

                    </div><br/><br/> <!--on break pour laisser de l'espace entre chaque tableaux !-->
                <?php //je réouvre balises php pour clôturer la requête
                }

$reponse ->closeCursor(); /*on ferme le curseur de requête pour le laisser libre pour la prochaine requête*/
?>


        </body>
    </html>