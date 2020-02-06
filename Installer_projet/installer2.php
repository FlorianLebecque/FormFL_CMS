<?php
    $erreur = 0;
    if(
        (isset($_POST["AdminName"]))&&
        (isset($_POST["Mdp1"]))&&
        (isset($_POST["Mdp2"]))&&
        (isset($_POST["BDDSer"]))&&
        (isset($_POST["BDDuse"]))&&
        (isset($_POST["BDDnam"]))
    ){  

        if(($_POST["Mdp1"]==$_POST["Mdp2"])&&($_POST["Mdp1"]!="")){

            if(($_POST["BDDSer"]!="")&&($_POST["BDDuse"]!="")&&($_POST["BDDnam"]!="")){

                    //supprimer les dossiers
                if(file_exists("backup")){rmdir ("backup");}
                if(file_exists("css")){rmdir ("css");}
                if(file_exists("editor/image")){rmdir ("editor/image");}
                if(file_exists("editor/php")){rmdir ("editor/php");}
                if(file_exists("editor")){rmdir ("editor");}
                if(file_exists("html")){rmdir ("html");}
                if(file_exists("image")){rmdir ("image");}
                if(file_exists("php")){rmdir ("php");}

                    //Creation des dossiers
                if(!file_exists("css")){mkdir("css",0775,true);}
                if(!file_exists("editor/php")){mkdir("editor/php",0775,true);}
                if(!file_exists("editor/image")){mkdir("editor/image",0775,true);}
                if(!file_exists("html")){mkdir("html",0775,true);}
                if(!file_exists("image")){mkdir("image",0775,true);}
                if(!file_exists("php")){mkdir("php",0775,true);}
                if(!file_exists("backup")){mkdir("php",0775,true);}

                $dir=array();

                    //chemin locale des fichiers
                $dir[0]=array(
					"index.php",
					"header.php",
                    "footer.php",
                    "inscription.php",
                    "login.php",
                    "properties.prop",
                    "passchange.php",
                    "recover.php",
                    "user.php",
                    "php/email.php",
                    "php/function.php",
                    "php/message.php",
					"php/propertiesReader.php",
					"html/404.html",
					"html/head.html",
                    "editor/DatabaseStructure.sql",
					"editor/Defaultprops.prop",
					"editor/editor.php",
                    "editor/imagemanager.php",
                    "editor/lienmanager.php",
                    "editor/NavBarEdit.php",
					"editor/pagemanager.php",
					"editor/properties.php",
					"editor/textemanager.php",
                    "editor/TextWritter.php",
                    "editor/usermanager.php",
                    "editor/php/column.php",
					"editor/php/conteneur.php",
					"editor/php/EditorHeader.php",
					"editor/php/FormConteneur.php",
					"editor/php/function_edit.php",
					"editor/php/ImageEditor.php",
					"editor/php/LinkEditor.php",
					"editor/php/TextEditor.php",
                    "css/editorStyle.css",
					"css/style.css"
					);
					
                    //chemin sur pastbin des fichiers
                $dir[1]=array(
                    "https://pastebin.com/raw/auyhafvm",//index
                    "https://pastebin.com/raw/Af94C0pV",//header
                    "https://pastebin.com/raw/s6cfPmUc",//footer
                    "https://pastebin.com/raw/zPtsUuqV",//inscription
                    "https://pastebin.com/raw/9U5KCFUj",//login
                    "https://pastebin.com/raw/HZiKuNtX",//properties.prop
                    "https://pastebin.com/raw/CMbzzjmh",//passchange
                    "https://pastebin.com/raw/TYyAqtDS",//recover
                    "https://pastebin.com/raw/4iSMkra8",//user
                    "https://pastebin.com/raw/cPmB0nGm",//php - email
                    "https://pastebin.com/raw/vBjVKEZL",//php - function
                    "https://pastebin.com/raw/iEgNWgiq",//php - message
                    "https://pastebin.com/raw/SVggHa1c",//php - propertiesReader
                    "https://pastebin.com/raw/BQwvqvGz",//html - 404
                    "https://pastebin.com/raw/VjrfgEcS",//html - head
                    "https://pastebin.com/raw/rHiDTmf3",    //editor
                    "https://pastebin.com/raw/5m4JtQzV",
                    "https://pastebin.com/raw/tfR1ZJuT",
                    "https://pastebin.com/raw/6cRX6ftX",
                    "https://pastebin.com/raw/Y3c98pVw",
                    "https://pastebin.com/raw/Lqi0KWMR",
                    "https://pastebin.com/raw/Bn4ejM1r",
                    "https://pastebin.com/raw/eh7LcZ2V",
                    "https://pastebin.com/raw/N2xTngd5",
                    "https://pastebin.com/raw/girBFgNN",
                    "https://pastebin.com/raw/EYK6tAz1",
                    "https://pastebin.com/raw/pVXCRhP3",   //editor - php
                    "https://pastebin.com/raw/u8DbnEkU",
                    "https://pastebin.com/raw/6w55gmST",
                    "https://pastebin.com/raw/R30zb39m",
                    "https://pastebin.com/raw/S6C4D9i2",
                    "https://pastebin.com/raw/Rg1KYdTs",
                    "https://pastebin.com/raw/nPcfM6xR",
                    "https://pastebin.com/raw/R3v2JNYD",
                    "https://pastebin.com/raw/4edPyvzL",  //css
                    "https://pastebin.com/raw/7sdzr6W9"

                );

                $dirImg=array();

                    //nom des images de l'éditeur
                $dirImg[0]=array(
                    "editor/image/3_3_3_3.png",
                    "editor/image/3_3_6.png",
                    "editor/image/3_6_3.png",
                    "editor/image/3_9.png",
                    "editor/image/4_4_4.png",
                    "editor/image/4_8.png",
                    "editor/image/6_3_3.png",
                    "editor/image/6_6.png",
                    "editor/image/8_4.png",
                    "editor/image/9_3.png",
                    "editor/image/12.png"
                );
                $dirImg[1]=array(
                    "1b0y8XqLPPvE1cSQEOnElfRqK4jkXNOUJ",
                    "1zsoQUq0lVgOASZLxVYeY8PHiNdoPawOH",
                    "1mogPilaoj0-yMlUVRssJPoB3UjkajfxH",
                    "1wgH8ZgYYRPMErVF-YxmJi5PtdBtbYVKh",
                    "1gNEY3bu6w-b_jhF-XcQ_rJia16LPEQYh",
                    "1szOx6OKrpYzwc7c937AvImNwsjNrEFVk",
                    "1t1jlR8JNB24kTRpojTbBdknTa77uCSWa",
                    "1o-rn1iaPastvKRx8qb6vBSKwXvTj5XV_",
                    "1xyY9bd0vu27xBDQjl85cq1-RaOtcG6ZQ",
                    "1WNSI4EaXeKJ4fDhh5lnAAfacClRYxmn1",
                    "1Z8cQtdo-GPx0uBmCsZ1wfEaVHl8fO8-1"
                );

                    //telecharge les fichiers images
                for($i = 0 ; $i < count($dirImg[0]);$i++){
                    file_put_contents($dirImg[0][$i], fopen("https://drive.google.com/uc?id=".$dirImg[1][$i], 'r'));
                }
                
                //telecharge les fichiers
                for($i = 0 ; $i < count($dir[0]);$i++){
                    file_put_contents($dir[0][$i], fopen($dir[1][$i], 'r'));
                }

                //creation du fichier de connection a la base de donnée
                $BDD_file = fopen("php/BDD.php","w");
    
                fputs($BDD_file,"<?php \n");
                fputs($BDD_file,'   $server="'.$_POST["BDDSer"].'";'."\n");
                fputs($BDD_file,'   $user="'.$_POST["BDDuse"].'";'."\n");
                fputs($BDD_file,'   $base="'.$_POST["BDDnam"].'";'."\n");
                fputs($BDD_file,'   $password="'.$_POST["BDDpas"].'";'."\n");
                fputs($BDD_file,'   $BDD= mysqli_connect($server,$user,$password,$base);'."\n");
                fputs($BDD_file,"   if(mysqli_connect_error()){"."\n");
                fputs($BDD_file,'       printf("Echec à la connection : %s\n",mysqli_connect_error()); '."\n");
                fputs($BDD_file,"       echo 'Erreur de connection à la base de donnée';"."\n");
                fputs($BDD_file,"       exit();"."\n");
                fputs($BDD_file,"   }"."\n");
                fputs($BDD_file,"?>"."\n");
    
                fclose($BDD_file);
                    //test si la connection a fonctionner
                $test = mysqli_connect($_POST["BDDSer"],$_POST["BDDuse"],$_POST["BDDpas"],$_POST["BDDnam"]);
                if(mysqli_connect_error()){
                    unlink("php/BDD.php");
                    $erreur = 2;
                }
    
                if($erreur != 2){
                    include("php/BDD.php");

                        //https://stackoverflow.com/questions/19751354/how-to-import-sql-file-in-mysql-database-using-php
                    //creation des tables dans la base de donnée
                    $lines = file("editor/DatabaseStructure.sql");
                    $op_data = "";
                    foreach ($lines as $line)
                    {
                        if (substr($line, 0, 2) == '--' || $line == '')//Supprime les commentaires
                        {
                            continue;
                        }
                        $op_data .= $line;
                        if (substr(trim($line), -1, 1) == ';')//casse la ligne ';'
                        {
                            mysqli_query($BDD,$op_data);
                            $op_data = '';
                        }
                    }

                        //ajout de l'admin dans la bdd
                    $req = "INSERT INTO `utilisateur`(`utilisateur`, `mdp`, `email`, `rank`) VALUES ('".$_POST["AdminName"]."','".md5($_POST["Mdp1"])."','notneeded',9)";
                    mysqli_query($BDD,$req);

                    echo "<script>document.location.href='index.php?p=pagemanager';</script>";
                }
                
            }
            $erreur= 4;
        }
        $erreur = 3;
        
    }
   
?>

<html>
    <head>
            <!-- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
        <meta charset="UTF-8">
        <style>
            html {

                --backColor:#262c33;
                --ContainerColor:#47475e;
                --HeadAndFooter:rgb(124, 180, 149);
                --Decoration:rgb(164, 163, 179);
                --texteColor:white;
                --errorColor:firebrick;
                --goodColor : rgb(0, 104, 0);
                --avertColor : rgb(255, 123, 0);
            }

            body { 
                position: relative;
                background-color:var(--backColor);
                color:var(--texteColor);;
            }

            .row{
                overflow-x: hidden;
                margin: 0em;
                padding-left: 0em;
                padding-right: -50px;
            }

            h1{
                border-bottom-color: var(--Decoration);
                border-bottom-style: solid;
                color:var(--texteColor);;
            }

            .cont{
                min-height: 1.5em;
                background-color: var(--ContainerColor);
                color:var(--texteColor);
                padding-top: 1em;
                padding-bottom: 1em;
                margin-top : 13em;
            }

            .webLink { /*Style des button*/
                width: 100%;
                color:var(--texteColor);
                font-family: Arial;
                font-size: 1em;
                background:var(--Decoration);
                padding-top: 1em;
                padding-bottom: 1em;
                text-decoration: none;
                text-align: center;
                border: solid var(--Decoration) 2px;
            }
            
            .webLink:hover {
                background:var(--Decoration);
                border: solid var(--HeadAndFooter) 2px;
                text-decoration: none;
                color:var(--texteColor);
                cursor: pointer;
            }

            .EditBtnVBig{
                width: 12em;
                margin-right: 1em;
            }
            .EditField{
                background-color: var(--ContainerColor);
                color:var(--texteColor);
            }
            .table td,.table th{
                border:none;
            }
            .error{
                color:var(--errorColor);
            }
        </style>
        <title>Installeur</title>
    </head> 

    <body>
        <div class="container cont">
        <h1>Premier lancement</h1>
        <p class="error">
            <?php
                switch ($erreur){
                    case 0:
                        echo "";
                        break;
                    case 1:  
                        echo "Erreur, il faut remplir tous les champs";
                        break;
                    case 2:  
                        echo "Erreur, impossible de se connecter à la base de donnée";
                        break;
                    case 3:  
                        echo "Erreur, les deux mots de passes ne correspondent pas";
                        break;
                    case 4:  
                        echo "Erreur, Tous les champs de la base de donnée ne sont pas remplis";
                        break;
                    default :
                        echo "";
                }

            ?>
        </p>
        <form method="post">
                
                <table class="table">
                    <tbody>
                    <tr>
                        <td>Nom admin</td>
                        <td><input class="webLink EditField" name="AdminName" type="text" value="Admin"></td> 
                    </tr>
                    <tr>
                        <td>Mot de passe</td>
                        <td><input class="webLink EditField" name="Mdp1" type="password" value=""></td>   
                    </tr>
                    <tr>
                        <td>Mot de passe</td>
                        <td><input class="webLink EditField" name="Mdp2" type="password" value=""></td>
                    </tr>
                    <tr>
                        <td>Serveur de la base de donner</td>
                        <td><input class="webLink EditField" name="BDDSer" type="text" value="localhost"></td>
                    </tr>
                    <tr>
                        <td>Utilisateur de la base de donnée</td>
                        <td><input class="webLink EditField" name="BDDuse" type="text" value="root"></td>
                    </tr>
                    <tr>
                        <td>Nom de la base de donnée</td>
                        <td><input class="webLink EditField" name="BDDnam" type="text" value=""></td>
                    </tr>
                    <tr>
                        <td>Mot de passe de la base de donnée</td>
                        <td><input class="webLink EditField" name="BDDpas" type="password" value=""></td>
                    </tr>
                    </tbody>
                </table>
                <br><br>
                <input type="submit" class="webLink EditBtnVBig" value="Sauvegarder">
            </form>
        </div>
    </body>
</html>