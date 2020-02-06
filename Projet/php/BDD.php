<?php 
   $server="localhost";
   $user="root";
   $base="test";
   $password="12345";
   $BDD= mysqli_connect($server,$user,$password,$base);
   if(mysqli_connect_error()){
       printf("Echec à la connection : %s\n",mysqli_connect_error()); 
       echo 'Erreur de connection à la base de donnée';
       exit();
   }
?>
