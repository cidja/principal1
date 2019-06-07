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
/*foreach ($tabparcours as $key => $value) {
    
    echo 'la clé est :' , $key, '<br/> et la valeur de $value est : ' ,$value, '<br/>';
}

*/

//Avec cet exemple dessous nous avons trois tableau imbriqué le 1 imbrique le 2 qui imbrique le 3

$tab3 = array(
    1 => 'premier tab3',
    2 => 'second  tab 3',
);
$tab2 = array(
    'premier de tableau 2',
    $tab3,
);

$tab1 = array(
    "un" => 1,
    "deux" => 2,
    "trois" => 6,
    
  );


echo '<pre>';
print_r($tab1);
echo '</pre>-----------------------<br/><br/><br/><br/>';

//Pour afficher les données du tab2 
echo'ceci est la clé 3 qui a pour valeur : ', $tab1['trois'];

$tab1['trois'] = 6+2;
echo 'ceci est la nouvelle valeur de clé 3 : ', $tab1['trois'];

foreach($tab1 as $key => $value) {
 echo '\$tab1[$key]=>$value.\n';   
}
    /*if(is_array($tab1))
    {
       foreach ($tab2 as $key2 => $value2) { 
           //on sélectionne le tableau 2 car trouvé dans tab1
           echo $tab2['value2'];
       }
    }
    
}



?>