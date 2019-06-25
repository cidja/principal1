<?php
//script pour afficher la date actuelle
$day=Array('dimanche','lundi','mardi','mercredi','jeudi','vendredi','samedi');
echo $day[date('w')];
$month= Array('Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre');
echo $month[date('n')];

echo 'Aujourd\'hui nous sommes le : ' , $day[date('w')] ,' ', date('d'), ' ', $month[date('n')];
?>
