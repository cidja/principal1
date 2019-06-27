<?php

function get_all(){
    global $bdd;
    $req="select * from livre ";
    $tab_resultat = $bdd->getAll($req);
    return $tab_resultat;
}

function get_ligne($iduser){
    global $bdd;
    $req="select * from livre where id=:iduser";
    $param=array('iduser'=>$iduser);
    $tab_resultat = $bdd->getRow($req,$param);
    return $tab_resultat;
}

function get_valeur($colonne,$iduser){
    global $bdd;
    $req="select ".$colonne." from livre where id=:iduser";
    $param=array('iduser'=>$iduser);
    $tab_resultat = $bdd->getOne($req,$param);
    return $tab_resultat;
}

function downloadCouvlivre($id){
    ?> <form action='upload_solo_livre.php' method='post' enctype="multipart/form-data">
    <label for='fichier' name='tabfichier'>
        Choisissez le fichier image a envoyer : </label>
            <input type='file' name='tabfichier'/>
            <input type='hidden' name='id' value='<?php echo $id;?>'/>
    <input type='submit' value='envoyer'/>
</form>
<?php
}
?>

?>
