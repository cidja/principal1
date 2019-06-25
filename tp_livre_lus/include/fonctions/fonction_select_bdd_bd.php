<?php
function select_bdd_bd() {
    $reponse = $bdd->query('SELECT id,serie,titre,scenario,dessin,album_numero,genre,remarques,img_couv,
    DATE_FORMAT(date_ajout, "%d-%m-%Y  à %Hh%i:%ssec") as date_fr FROM bd  ORDER BY id DESC');
}