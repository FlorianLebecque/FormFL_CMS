<?php  
    $err=false;
    if((isset($_POST["user"]))&&(isset($_POST["pass"]))){
        $req = "SELECT * FROM `utilisateur` WHERE `utilisateur` like BINARY '".$_POST["user"]."'";
        if($resultat =mysqli_query($BDD,$req)){
            $resultat = mysqli_fetch_array($resultat,MYSQLI_ASSOC);

            if(md5($_POST["pass"])==$resultat["mdp"]){
                $_SESSION["user"] = $_POST["user"];
                $_SESSION["rank"] = $resultat["rank"];

                if(isset($_GET["n"])){  //si page objectif
                    echo "<script>document.location.href='index.php?p=".$_GET["n"]."';</script>";
                }else{  //si aucune page objectif
                    echo "<script>document.location.href='index.php';</script>";
                }
                
            }else{
                $err="E5";
            }

        }else{
            $err = "E5";
        }
    }

?>

<center>
    <link rel="stylesheet" type="text/css" href="css\editorStyle.css">
    <title>Connection</title>
    <div class="col-md-5 cont login">
        <h1>Connection</h1>
        <?php 
           msg($err);
        ?>
        <form method="post">
            <br>
            <input type="text" class="webLink EditField" placeholder="Utilisateur" name="user">
            <input type="password" class="webLink EditField" placeholder="Mot de passe" name="pass">
            <br><br><hr>
            <input type="submit" class="webLink EditBtnVBig" value="Connection">
        </form>
        <a href="index.php?p=recover">Mot de passe perdu ?<a>
    </div>
</center>