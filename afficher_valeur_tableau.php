<?php

//Pour afficher une valeur dans un tableau 

$tab = array(
    'premier',
    'second',
    'troisiéme',
    'quatrieme',
);

echo $tab[0];

//on rentre le nom du tableau et sa clé 
//dans l'exemple ci dessus nous n'avons pas rentré de clé donc php insère des clés automatiquement
//en partant de 0, si print_r($tab) ça donne :
/* Array
(
    [0] => premier
    [1] => second
    [2] => troisiéme
    [3] => quatrieme
)
On voit bien que premier est associé à la clé 0
*/

//pour un tableau nominatif 
$tabnom = array(
    'banane'    => 'jaune',
    'fraise'    => 'rouge',
    'raisin'    => 'blanc',
);

echo $tabnom['banane'];
//résultat  jaune
// c'est le même principe sauf que les champs sont nommés
?>