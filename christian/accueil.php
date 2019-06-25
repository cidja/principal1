<?php

include_once("./include/config.inc.php");
include_once("./include/fonction.inc.php");




$toutes_infos_de_tous_users=get_all();
$toutes_infos_de_un_user=get_ligne(1);
$une_info_de_un_user=get_valeur("prenom",1);

if (isset($_GET['print']) && $_GET['print'] != "") {
    echo '<pre>';
    print_r(${$_GET['print']});
    echo '</pre>';
    die();
}
?>