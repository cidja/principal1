<?php
function get_all(){
    global $bdd;
    $req="select * from user ";
    $tab_resultat = $bdd->getAll($req);
    return $tab_resultat;
}

function get_ligne($iduser){
    global $bdd;
    $req="select * from user where iduser=:iduser";
    $param=array('iduser'=>$iduser);
    $tab_resultat = $bdd->getRow($req,$param);
    return $tab_resultat;
}

function get_valeur($colonne,$iduser){
    global $bdd;
    $req="select ".$colonne." from user where iduser=:iduser";
    $param=array('iduser'=>$iduser);
    $tab_resultat = $bdd->getOne($req,$param);
    return $tab_resultat;
}

?>
