<?php  
    $err=0;
    if(isset($_POST["formSent"])){
        $_POST["email"] = strtolower($_POST["email"]);
        $req = "SELECT count(*) as 'nbr' FROM `utilisateur` WHERE `email` = '".$_POST["email"]."'";
        $nbr = mysqli_fetch_array(mysqli_query($BDD,$req),MYSQLI_ASSOC);
            //si l'eamil est pas deja pris
        if($nbr["nbr"]==0){
            if($_POST["user"]!=""){ //test le nom d'utilisateur
                    //different regex
                $reg1 = "#[a-z]{3,}#";  //au moin trois lettre minuscule
                $reg2 = "#[A-Z]+#";     //au moin une majuscule
                $reg3 = "#[0-9]+#";     //au moin 1 chiffre

                $test1 = preg_match($reg1,$_POST["pass1"]);
                $test2 = preg_match($reg2,$_POST["pass1"]);
                $test3 = preg_match($reg3,$_POST["pass1"]);

                if(($test1)&&($test2)&&($test3)){   //test le mdp

                    if(($_POST["pass1"])==($_POST["pass2"])){
                        
                        $regexMail="#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#";
                        if(preg_match($regexMail,$_POST["email"])){ //test l'email

                            $req= "SELECT count(*) as 'nbr' FROM `utilisateur` WHERE `utilisateur` = '".$_POST["user"]."'";
                            $nbr = mysqli_fetch_array(mysqli_query($BDD,$req),MYSQLI_ASSOC);
                                //test si nom deja pri
                            if($nbr["nbr"]==0){
                                
                                $_POST["user"] = htmlspecialchars($_POST["user"]);
                                $_POST["pass1"] = htmlspecialchars($_POST["pass1"]);
                                $_POST["email"] = htmlspecialchars($_POST["email"]);

                                $needmail = isset($_POST["needmail"]) ? 1 : 0;

                                $req = "INSERT INTO `utilisateur`(`utilisateur`, `mdp`, `email`, `rank`,`mail`) VALUES ('".$_POST["user"]."',md5('".$_POST["pass1"]."'),'".$_POST["email"]."',0,".$needmail.");";
                                mysqli_query($BDD,$req);

                                    //connecte l'utilisateur
                                $_SESSION["user"] = $_POST["user"];
                                $_SESSION["rank"] = 0;

                                    //redirection
                                echo "<script>document.location.href='index.php';</script>"; 
                            }else{
                                $err = "E8";
                            }

                        }else{
                            $err="E4";
                        }
                    }else{
                        $err="E2";
                    }
                }else{
                    $err = "E3";
                }
            }else{
                $err="E7";
            }
        }else{
            $err="E6";
        }
    }


?>

<center>
    <title>Inscription</title>
    <link rel="stylesheet" type="text/css" href="css\editorStyle.css">
    <div class="col-md-5 cont login">
        <h1>Inscription</h1>
        <?php 
            msg($err);
        ?>
        <form method="post">
            <br>
            <input type="text" class="webLink EditField" placeholder="Utilisateur" name="user">
            <hr>
            <input type="password" class="webLink EditField" title="Il faut 3 minuscules minimum, 1 majuscule minimum et au moin 1 chiffre" placeholder="Mot de passe" name="pass1">
            <input type="password" class="webLink EditField" placeholder="Réinsérez le mot de passe" name="pass2">
            <hr>
            <input type="text" class="webLink EditField" placeholder="E-mail" name="email">
            <br><br>
            <input type="checkbox" class="webKink EditField" id="checkbox" name="needmail"> <label for="checkbox">Recevoir des mails</label><br><hr>
            <input type="submit" class="webLink EditBtnVBig" value="Inscription" name="formSent">
        </form>
    </div>
</center>