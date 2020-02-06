<?php

    $err=0;

    if(isset($_POST["email"])){
        $_POST["email"] = strtolower($_POST["email"]);
        $regexMail="#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#";
        if(preg_match($regexMail,$_POST["email"])){
            $req="SELECT COUNT(`email`) as 'nbr',`utilisateur` as 'user' FROM `utilisateur` WHERE `email` = '".$_POST["email"]."'";
            $count = mysqli_fetch_array(mysqli_query($BDD,$req),MYSQLI_ASSOC);

            if($count["nbr"]!=0){
                
                $msg = "Voici un lien pour modifier votre mot de passe\n\n";
                $msg2 = "http://".$_SERVER["SERVER_NAME"]."/index.php?p=passchange&u=".md5($_POST["email"]).md5($count["user"]);
                
                $msg = $msg.$msg2;

                include("php/email.php");
                SendMail($_POST["email"],$msg,"Récupération de mot de passe");

            }
        }else{
            $err="E4";
        }
    }


?>

<center>
    <link rel="stylesheet" type="text/css" href="css\editorStyle.css">
    <title>Récupération</title>
    <div class="col-md-5 cont login">
        <h1>Récupération</h1>
        <?php 
            msg($err);
        ?>
        <form method="post">
            <br>
            <input type="text" class="webLink EditField" placeholder="E-mail" name="email"><hr>
            <input type="submit" class="webLink EditBtnVBig" value="Envoyer">
        </form>
    </div>
</center>