<?php
    $err=0;
    if(isset($_GET["u"])){
        $req="SELECT * ,'ok' FROM `utilisateur` WHERE concat(MD5(`email`),MD5(`utilisateur`))='".$_GET["u"]."'";
        $res = mysqli_fetch_array(mysqli_query($BDD,$req),MYSQLI_ASSOC);

        if(isset($res["ok"])){
            $user = $res["utilisateur"];
        }else{
            $err = "";
        }
    }

    if(isset($_POST["pass"])){

        if($_POST["pass"]==$_POST["pass2"]){
            $reg1 = "#[a-z]{3,}#";  //au moin trois lettre minuscule
            $reg2 = "#[A-Z]+#";     //au moin une majuscule
            $reg3 = "#[0-9]+#";     //au moin 1 chiffre

            $test1 = preg_match($reg1,$_POST["pass"]);
            $test2 = preg_match($reg2,$_POST["pass"]);
            $test3 = preg_match($reg3,$_POST["pass"]);

            if(($test1)&&($test2)&&($test3)){
                $req="UPDATE `utilisateur` SET`mdp`='".md5($_POST["pass"])."' WHERE `utilisateur` = '".$user."'";
                mysqli_query($BDD,$req);
                $err="M1";
            }else{
                $err="E3";
            }
        }else{
            $err="E2";
        }
    }

?>

<center>
    <link rel="stylesheet" type="text/css" href="css\editorStyle.css">
    <title>Changement de mot de passe</title>
    <div class="col-md-5 cont login">
        <h1>Changement de mot de passe</h1>
        <?php 
            msg($err);
        ?>
        <form method="post">
            <br>
            <input type="password" class="webLink EditField" placeholder="Nouveau mot de passe" name="pass">
            <input type="password" class="webLink EditField" placeholder="Réinsérer le nouveau mot de passe" name="pass2">
            <br><br><hr>
            <input type="submit" class="webLink EditBtnVBig" value="Changer">
        </form>
    </div>
</center>