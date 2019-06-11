<?php

//ceci est un tableau simple avec une key généné automatiquement
$tabsimple = array(
	'premier',
	'second',
	'troisieme',
	);
echo '<pre>';
	
print_r($tabsimple);

echo'</pre>';

//Ceci est un tableau avec des clés nominatif toujours un tableau simple
$tabnom = array(
	'nom' 		=> 'jean',
	'prenom' 	=> 'dupont',
	'age' 		=> 25,
	'ville'		=> 'Paris'
);

//pour l'affichage des sauts de ligne
echo '<pre>';
print_r($tabnom);
echo '</pre>';





//pour parcourir un tableau :
//il faut imaginer que l'on est dans l'arborescence comme sur le bureau de l'ordinateur
$tabparcours = array(
    'un',
    'deux',
    'trois',
);


echo'<pre>';
print_r($tabparcours);
echo '</pre>';

//exemple avec un tableau simple

$tab1 = array(
    "un" => 1,
    "deux" => 2,
    "trois" => 3,
    
  );


echo '<pre>';
print_r($tab1);
echo '</pre>-----------------------<br/><br/><br/><br/>';

//Pour afficher les données du tab2 
echo'ceci est la clé 3 qui a pour valeur : ', $tab1['trois'];

//pour modifier les values du tableau 
$tab1['trois'] = 6+2;
echo 'ceci est la nouvelle valeur de clé 3 : ', $tab1['trois'], '<br/>';


//avec cette boucle on rentre dans le tableau $tab1 qu'on parcourt avec foreach $key=(clé) et $value=(valeurs)
// pour faire l'analogie avec l'arborescence fichiers c'est comme ci on allait sur :
// c::\tab1 et qu'a l'intérieur de ce dossier il y avait des fichiers.
foreach($tab1 as $key => $value) {
 echo 'ce tableau a pour clé : ',$key ,'<br/>
 et pour valeur : ', $value, '<br/><br/><br/><br/>';
}
    

//Maintenant on a deux tableaux un imbriqué dans l'autre, pour reprendre le bureau 
// C:\\tabpays\tabfruit et on veut accéder à tabfruit

$tabfruit = array(
    'jaune'     => 'banane',
    'rouge'     => 'fraise',
    'violet'    => 'myrtille'
);
$tabpays = array(
    'afrique'   => 'maroc',
    'europe'    => 'Suède',
    'asie'      => 'Japon',
    'tab2'      => array(
        'jaune'     => 'banane',
        'rouge'     => 'fraise',
        'violet'    => 'myrtille',)
);

/*print_r($tabfruit)
Array
(
    [afrique] => maroc
    [europe] => Suède
    [asie] => Japon
    [fruit] => Array
        (
            [jaune] => banane
            [rouge] => fraise
            [violet] => myrtille
        )

)
On voit bien 2 TABLEAUX
on sélectionne le premier tableau
*/

//pour afficher le tableau 
echo '<pre>';
print_r($tabpays);
echo '</pre>';


/*foreach($tabpays as $continent => $pays){
    if(is_array($pays))
    {
        echo 'tab enfant  : <br/>';
        foreach($tabfruit as $couleur => $fruit) 
        {
            echo '<br/> la ' ,$fruit, ' et de couleur : ', $couleur , '<br/>';
        }
    }
     else
    {
        echo $pays . ' ce trouve sur le continent ' . $continent . ' <br/>';
    }
}
*/
echo $tabpays[$tabfruit]['jaune'];

?>