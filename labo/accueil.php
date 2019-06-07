 <!DOCTYPE html>
 <html>
     <head>
         <title>Accueil du labo</title>
         <meta charset='utf8'/>
         <link rel='stylesheet' href='style_lab.css'/>
     </head>
     <body>
         <h1>Bienvenue dans le labo </h1>


         <img src='/private/git/labo/img/bateau.jpeg'/>


         <br/>

         <?php 
         $temp = tempnam(sys_get_temp_dir(), 'Tux');
         echo $temp, '<br/><br/>';

         $text = fopen('/var/www/public/private/git/labo/labo_exemple/testw.txt','w');
         fwrite($text, '1');
         echo 'ceci est un extrait du texte' ,$text , '<br/><br/>';

         include(dirname(__FILE__) . '/fonctions/connexion.php');
         $array = array('premier' =>'1','second' =>'2'
         ,'trois' => '3');
         foreach($array as $key => $reponse){
             echo "C'est élément à pour clé : " , $key,
             'et comme valeur : ' ,$reponse, '<br/>';
         }
         $req = $bdd->query('SELECT ID,lien_img FROM labo1');

         foreach($req as $donnees)
         { 
             ?>
             ceci est un id : <?php echo $donnees['ID'];?><br/>
             <img src='<?php echo $donnees['lien_img']?>'/>;
         <?php    
         }
         ?>
         
     </body>
 </html>
