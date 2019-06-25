<!--formulaire pour les boutons modifier et supprimer !-->
                        
<form method='get' action='\private\git\mon_site_web\tp_livre_lus\php\form_modif.php' name='modification'>
                              <input type='hidden' name='id' id='id' value="<?php echo $donnees['id'];?>"/>
                              <input type='submit' value='modifier' class='bouton_supprimer'/></form> <!-- class donnée pour mettre dans la grille css!-->
                            <form method='post' action='\private\git\mon_site_web\tp_livre_lus\php\delete_one.php' name='delete'>
                              <input type='hidden' name='id' id='id' value='<?php echo $donnees['id'];?>'/> <!--on récupére l'id actuel du tableau pour le transférer sur delete_one !-->
                              <input type='hidden' name='titre_delete' id='titre_delete' value='<?php echo $donnees['titre']; ?>'/> <!--on récupére le titre actuel du tableau pour le transférer sur delete_one !-->
                                <input type='submit' value='supprimer' class='bouton_supprimer'/> <!-- class donnée pour mettre dans la grille css!-->
                            </form>

                    </div><br/><br/> <!--on break pour laisser de l'espace entre chaque tableaux !-->