<div class='temps_lecture'>
                         Pour lire cet ouvrage en 30 jours, il faut :
                        <?php
                          if(empty($donnees['nb_pages']))
                           { //condition if si pas de pages rentrée poru calculer
                            echo ' d\'abord rentrer le nombre de pages pour que je puisse caluler. ';
                           }
                            else
                           {
                            $decompte_lecture = $donnees['nb_pages'] / 30; //qui sert à afficher le nombre de pages qu'il faut lire pour le lire en 30 jours
                            $decompte_lecture += 1; //je rajoute 1 à la variable pour que si le résultat est un entier à virgule ça arrondisse toujorus au dessus afin de prendre une grande fourchette haute
                            echo 'lire ', round($decompte_lecture, 0, PHP_ROUND_HALF_UP) ,' pages par jours.'; // avec round j'arrondis à l'entier au dessus fonction round 
                           }
                           ?> 


                           <br/><br/> <!--ajout des <br/> pour aérer le texte !-->


                         Pour lire cet ouvrage en 15 jours, il faut : (2 fois moins de temps bien sûr :)) donc : 
                         <?php
                         if(empty($donnees['nb_pages']))
                         { //condition if si pas de pages rentrée poru calculer
                          echo ' d\'abord rentrer le nombre de pages pour que je puisse caluler. ';
                         }
                          else
                         {
                          $decompte_lecture = $donnees['nb_pages'] / 15; //qui sert à afficher le nombre de pages qu'il faut lire pour le lire en 30 jours
                          $decompte_lecture += 1; //je rajoute 1 à la variable pour que si le résultat est un entier à virgule ça arrondisse toujorus au dessus afin de prendre une grande fourchette haute
                          echo round($decompte_lecture, 0, PHP_ROUND_HALF_UP) ,' pages par jours.'; // avec round j'arrondis à l'entier au dessus fonction round 
                         }?>
                        </div>
                        