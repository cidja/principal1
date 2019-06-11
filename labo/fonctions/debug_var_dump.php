<?php
function dd($variable){ //ceci est une fonction de débugage vu sur : https://www.youtube.com/watch?v=6SGanAA42tc
    echo '<pre>'; //pour afficher les sauts de ligne
    var_dump($variable); //pour avoir des infos sur la variable en question
    echo '</pre>';
    die();
}