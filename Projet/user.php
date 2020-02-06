<?php

    if(isset($_SESSION["user"])){
        $err=0;
        if(isset($_POST["mdp"])){
            
            $req="SELECT `mdp` FROM `utilisateur` WHERE `utilisateur` = '".$_SESSION["user"]."'";
            $mdp = mysqli_fetch_array(mysqli_query($BDD,$req),MYSQLI_ASSOC);

            if(md5($_POST["mdp"])==$mdp["mdp"]){
                if($_POST["pass1"]==$_POST["pass2"]){
                    $reg1 = "#[a-z]{3,}#";  //au moin trois lettre minuscule
                    $reg2 = "#[A-Z]+#";     //au moin une majuscule
                    $reg3 = "#[0-9]+#";     //au moin 1 chiffre

                    $test1 = preg_match($reg1,$_POST["pass1"]);
                    $test2 = preg_match($reg2,$_POST["pass1"]);
                    $test3 = preg_match($reg3,$_POST["pass1"]);

                    if(($test1)&&($test2)&&($test3)){
                        $needmail = isset($_POST["needmail"]) ? 1 : 0;
                        $req="UPDATE `utilisateur` SET`mdp`='".md5($_POST["pass1"])."' ,`mail`='".$needmail."' WHERE `utilisateur` ='".$_SESSION["user"]."'";
                        mysqli_query($BDD,$req);

                        $err="M1";//mot de passe changer
                    }else{
                        $err="E3"; //mot de passe non comforme
                    }
                }else{
                    $err="E2"; //les deux mdp ne corresponde pas
                }
            }else{
                $err="E1"; //mot de passe eroner
            }
        }


    }else{
        echo "<script>document.location.href='index.php?p=login';</script>";
    }
    
?>

<center>
    <link rel="stylesheet" type="text/css" href="css\editorStyle.css">
    <title>Utilisateur</title>
    <div class="col-md-5 cont login">
        <h1>Utilisateur</h1>
        <?php 
            msg($err);
        ?>
        <form method="post">
            <br>
            <input type="password" class="webLink EditField" placeholder="Ancien mot de passe" name="mdp">
            <input type="password" class="webLink EditField" placeholder="Nouveau mot de passe" title="Il faut 3 minuscules minimum, 1 majuscule minimum et au moin 1 chiffre" name="pass1">
            <input type="password" class="webLink EditField" placeholder="Réinsérez le mot de passe" name="pass2">
            <br><br>
            <input type="checkbox" class="webKink EditField" id="checkbox" <?php echo isChecked($BDD);?> name="needmail" > <label for="checkbox">Recevoir des mails</label>
            <br><br><hr>
            <input type="submit" class="webLink EditBtnVBig" value="Valider">
        </form>
    </div>
</center>


<?php
        //check la checkbox de mail si l'utilisateur recois des email
    function isChecked($BDD){
        $req="SELECT `mail` FROM `utilisateur` WHERE `utilisateur` = '".$_SESSION["user"]."'";
        $test = mysqli_fetch_array(mysqli_query($BDD,$req),MYSQLI_ASSOC);

        if($test["mail"] == 1){
            return "CHECKED";
        }else{
            return "";
        }
    }
?>