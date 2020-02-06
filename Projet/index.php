<?php
    session_start();
    include("php/propertiesReader.php");

    if(isset($_GET["c"])){  //recupération de commande dans l'url
        if($_GET["c"]=="deconnection"){
            session_destroy();
            echo "<script>document.location.href='index.php';</script>";

        }
    }

?>
<!DOCTYPE html>
<html>

    <?php
        include("php/BDD.php");
        include("php/function.php");
        include("php/message.php");  
    ?>

    <?php include("html/head.html");  ?>

    <script>
        var html = document.getElementsByTagName('html')[0];
        //set style color from file
        html.style.setProperty("--backColor","<?php echo $props["backColor"] ?>");
        html.style.setProperty("--ContainerColor","<?php echo $props["ConteneurColor"] ?>");
        html.style.setProperty("--HeadAndFooter","<?php echo $props["HeadFooterColor"] ?>");
        html.style.setProperty("--Decoration","<?php echo $props["OverLigneColor"] ?>");
        html.style.setProperty("--texteColor","<?php echo $props["TextColor"] ?>");
        html.style.setProperty("--errorColor","<?php echo $props["ErrorColor"] ?>");
        html.style.setProperty("--goodColor","<?php echo $props["GoodColor"] ?>");
        html.style.setProperty("--avertColor","<?php echo $props["WarningColor"] ?>");
    </script>

    <header>
        <?php include("header.php");?>
    </header>

    <body style="background-color:var(--backColor);">
        <?php
            $page = ["editor","pagemanager","textemanager","imagemanager","usermanager","NavBarEdit","lienmanager","TextWritter","properties","login","inscription","user","recover","passchange"];
            $user_page = ["login","inscription","user","recover","passchange"];
            
            if(isset($_GET["p"])){
            
                $nbr = htmlspecialchars($_GET["p"]); 

                if(($nbr != "")&&(!in_array($nbr,$page))){   //si non dans le page$pageleau
                    loadPage($nbr,$BDD);
                      
                }else if(in_array($nbr,$page)){  //si page spécial
                    
                        //si on veux login ou inscription
                    if(in_array($nbr,$user_page)){
                        include($nbr.".php");
                    }else if(isset($_SESSION["user"])){   //si connecter
                        //il faut le rank 9 pour entré dans l'éditeur
                        if($_SESSION["rank"]==9){
                            include("editor/".$nbr.".php");
                        }else{
                            echo "<center><p class='error'>Vous n'êtes pas autorisé à entrer dans la page</p></center>";
                        }
                    }else{
                        echo "<script>document.location.href='index.php?p=login&n=".$nbr."';</script>";
                    }

                }
            }else{
                loadPage(1,$BDD);
            }
        
        ?>
    </body>

    <footer>
        <?php include("footer.php"); ?>
    </footer>

</html>