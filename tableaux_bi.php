<?php
$tabfruit = array(
    'jaune'     => 'banane',
    'rouge'     => 'fraise',
    'violet'    => 'myrtille'
);
$tabpays = array(
    'afrique'   => 'maroc',
    'europe'    => 'Suède',
    'asie'      => 'Japon',
    'tab2'      => $tabfruit,
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

function dd($variable){ //ceci est une fonction de débugage vu sur : https://www.youtube.com/watch?v=6SGanAA42tc
    echo '<pre>'; //pour afficher les sauts de ligne
    var_dump($variable); //pour avoir des infos sur la variable en question
    echo '</pre>';
    die();
}
//pour afficher le tableau 
echo '<pre>';
print_r($tabpays);      
echo '</pre>';


    if(is_array($tabpays['tab2']))
    {
        echo 'tab enfant  : <br/>';
        foreach($tabfruit as $couleur => $fruit) 
        {
            echo '<br/> la ' ,$fruit, ' et de couleur : ', $couleur , '<br/>';
        }
    }
     else
    {
       
        
        foreach($tabpays as $key => $value){
  
            echo $value . ' ce trouve sur le continent '. $key . ' <br/>';
        }
       
        die();
    }




?>