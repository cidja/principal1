<?Php
include('/var/www/public/private/git/tp_livre_lus/include/fonction.inc.php');
include_once('/var/www/public/private/git/tp_livre_lus/include/config.inc.php');
include('/var/www/public/private/git/tp_livre_lus/include/db_new.php');
include('/var/www/public/private/git/tp_livre_lus/include/debug.php');

//$tab = get_all($tab_resultat);
//echo $tab;
//dd($tab);

$ligne = getOne($bdd, 5);
echo $ligne;
?>