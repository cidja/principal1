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
         
         
         //affichage des éléments de la base de données labo1
         $req = $bdd->query('SELECT * FROM labo1');

         foreach($req as $key => $value)
         { 
             ?>
             ceci est un id : 
             <?php 
             echo $value['ID'];?><br/>
             <!--affichage de l'image !-->
             <img style = 'max-height :480px; max-width : 640px'; 
              src='<?php echo $value['img']?>'/>;
         <?php    
         }
         
         ?>
         
     </body>
 </html>
