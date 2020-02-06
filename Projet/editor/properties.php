<?php

        //sauvegarde des propriétées
    if(isset($_POST["WebTitle"])){
        unlink("properties.prop");
        $props = fopen("properties.prop", "w"); //on réécrit le fichier des propriétés
        fputs($props, $_POST["WebTitle"]."\n");
        fputs($props, $_POST["Bcolor"]."\n");
        fputs($props, $_POST["Ccolor"]."\n");
        fputs($props, $_POST["Hcolor"]."\n");
        fputs($props, $_POST["Ocolor"]."\n");
        fputs($props, $_POST["Tcolor"]."\n");
        fputs($props, $_POST["Ecolor"]."\n");
        fputs($props, $_POST["Gcolor"]."\n");
        fputs($props, $_POST["Zcolor"]."\n");
        
        fclose($props);

        include("php/propertiesReader.php");    //on relit les propriétés
    }
    
        //remise des paramètre par default
    if(isset($_POST["GetBack"])){

        $properties = fopen("editor/Defaultprops.prop","r");

        $propertiesName=["title","backColor","ConteneurColor","HeadFooterColor","OverLigneColor","TextColor","ErrorColor","GoodColor","WarningColor"];

        $Back = array();

        $i = 0;     //on lit les propriétés par defaut stocker dans le fichier $properties
        while($ligne = fgets($properties)){
            
            $ligne = str_replace("\n","",$ligne); 
            $ligne = str_replace("\r","",$ligne); 
            $ligne = str_replace("\t","",$ligne); 
            $Back[$propertiesName[$i]] = $ligne;
            $i++;
        }

        fclose($properties);
            //on ecrit dans le ficher des propriétés les nouvelles propriété
        $props = fopen("properties.prop", "w");
        fputs($props, $Back["title"]."\n");
        fputs($props, $Back["backColor"]."\n");
        fputs($props, $Back["ConteneurColor"]."\n");
        fputs($props, $Back["HeadFooterColor"]."\n");
        fputs($props, $Back["OverLigneColor"]."\n");
        fputs($props, $Back["TextColor"]."\n");
        fputs($props, $Back["ErrorColor"]."\n");
        fputs($props, $Back["GoodColor"]."\n");
        fputs($props, $Back["WarningColor"]."\n");
        
        fclose($props);

        include("php/propertiesReader.php");

    }

        //envoie d'un email a tout les utilisateur abonner
    if(isset($_POST["messageMail"])){
        include("php/email.php");
        $req = "SELECT  `email` FROM `utilisateur` WHERE `mail` = 1";
        $res = mysqli_query($BDD,$req);
            //on selectionne tout les utilisateurs abonner à la newsletters
        while($mail = mysqli_fetch_array($res,MYSQLI_ASSOC)){
            SendMail($mail["email"],$_POST["messageMail"],$_POST["ObjMail"]);
        }
        mysqli_free_result($res);
    }

        //exportation du fichier
    if(isset($_POST["GetSite"])){

            //recupere toute les tables
        $req = "SHOW TABLES";
        $res = mysqli_query($BDD,$req);

        $tableName = array();
        while($table = mysqli_fetch_array($res,MYSQLI_ASSOC)){
            array_push($tableName,$table["Tables_in_".$base]);
        }

            //fichier de sauvegarde
        $file = "backup/backup_".date("Y-m-d-G-i-s").".sql";
        $Mybackup = fopen($file, "w");
        
            //on ecrit chaque table dans le fichier
        for($i=0;$i<count($tableName);$i++){
            
            $req = "SELECT * FROM ".$tableName[$i];
            $res = mysqli_query($BDD,$req);

                //on efface la table avant
            $req = "TRUNCATE `".$tableName[$i]."`;";
            fputs($Mybackup,$req."\n");
            
                //on récupère les champs de chaque table
            $fields = array();
            while($field = mysqli_fetch_field($res)){
                array_push($fields,$field->name);
            }


            while($ligne = mysqli_fetch_array($res,MYSQLI_ASSOC)){
                $nbrChamp = mysqli_num_fields($res);
                $out = "INSERT INTO ".$tableName[$i]."(";

                    //on rajoute chaque champs
                for($j=0;$j < $nbrChamp ;$j++){
                    if($j>0){
                        $out = $out.",";
                    }
                    $out = $out.$fields[$j];
                }

                $out= $out.") VALUES (";
                    //on rajoute les valeurs
                for($j=0;$j < $nbrChamp ;$j++){
                    if($j>0){
                        $out = $out.",";
                    }
                    $out = $out. "'".$ligne[$fields[$j]]."'";
                }

                $out = $out. ");";

                fputs($Mybackup,$out."\n");

            }

        }
            //lance le téléchargement du backup
        echo "<script> window.location.href='".$file."'</script>";

    }

        //importation du fichier
    if(isset($_POST["LoadSite"])){
        
        if(($_FILES["backUp"]["error"]==0)){
                //on vide toutes les tables
            mysqli_query($BDD,"SET FOREIGN_KEY_CHECKS = 0");
            $req = "SHOW TABLES";
            $res = mysqli_query($BDD,$req);
            while($table = mysqli_fetch_array($res,MYSQLI_ASSOC)){
                if($table["Tables_in_".$base]!="utilisateur"){
                    $req ="TRUNCATE ".$table["Tables_in_".$base];   //$base se trouve dans BDD.php
                    mysqli_query($BDD,$req);
                } 
            }
            
                //execute les requetes dans la base de donnée
            $backup = fopen($_FILES["backUp"]["tmp_name"],"rb");
            while($query = fgets($backup)){
                mysqli_query($BDD,$query);
            }

            mysqli_query($BDD,"SET FOREIGN_KEY_CHECKS = 1");
        }
    }
?>

<link rel="stylesheet" type="text/css" href="css\editorstyle.css">
<title>Gestionnaire de pages</title>
<?php include("editor/php/EditorHeader.php") ?>
<div class="container">
    
    <div class="col-md-12 webContener">
        <h1>Propriétés du site</h1><br>
        <br><br>
        <!--modifier les propriétés du site-->
        <form method="post">
            <table class="table">
                <tbody>
                    <tr>
                        <td>Titre</td>
                        <td><input type="text" class="webLink EditField" name="WebTitle" placeholder="titre du site" value="<?php echo $props["title"] ?>"></td>
                    </tr>
                    <tr>
                        <td>Couleur de fond</td>
                        <td><input class="webLink EditColor" name="Bcolor" type="color" value="<?php echo $props["backColor"] ?>"></td> 
                    </tr>
                    <tr>
                        <td>Couleur des conteneur</td>
                        <td><input class="webLink EditColor" name="Ccolor" type="color" value="<?php print $props["ConteneurColor"] ?>"></td>   
                    </tr>
                    <tr>
                        <td>Couleur de tête et pied de page</td>
                        <td><input class="webLink EditColor" name="Hcolor" type="color" value="<?php print $props["HeadFooterColor"] ?>"></td>
                    </tr>
                    <tr>
                        <td>Couleur de surlignage</td>
                        <td><input class="webLink EditColor" name="Ocolor" type="color" value="<?php print $props["OverLigneColor"] ?>"></td>
                    </tr>
                    <tr>
                        <td>Couleur de texte</td>
                        <td><input class="webLink EditColor" name="Tcolor" type="color" value="<?php print $props["TextColor"] ?>"></td>
                    </tr>
                    <tr>
                        <td>Couleur erreur</td>
                        <td><input class="webLink EditColor" name="Ecolor" type="color" value="<?php print $props["ErrorColor"] ?>"></td>
                    </tr>
                    <tr>
                        <td>Couleur bien</td>
                        <td><input class="webLink EditColor" name="Gcolor" type="color" value="<?php print $props["GoodColor"] ?>"></td>
                    </tr>
                    <tr>
                        <td>Couleur avertissement</td>
                        <td><input class="webLink EditColor" name="Zcolor" type="color" value="<?php print $props["WarningColor"] ?>"></td>
                    </tr>
                </tbody>
            </table>
            <input type="submit" class="webLink EditBtnVBig" value="Sauvegarder">
        </form>
        <!--remettre les valeurs par defaut des propriétés-->
        <form method="post">
            <input hidden name="GetBack" value="1">
            <input type="submit" class="webLink EditBtnVBig" value="Remettre à l'origine">
        </form>
        <!--sauvegarde et restauration du site-->
        <h1>Sauvegarde du site</h1>
        <div class="row">
            <div class="col-md-6">
                <form method="post">
                    <input hidden name="GetSite" value="1">
                    <input type="submit" class="webLink EditBtnVBig" value="Exporter">
                </form>
            </div>
            <div class="col-md-6">
                <form method="post" enctype="multipart/form-data">
                    <input hidden name="LoadSite" value="1">
                    <input type="file" class="webLink EditBtnVBig" name="backUp" accept=".sql">
                    <input type="submit" class="webLink EditBtnVBig" value="Importer">
                </form>
            </div>
        </div>

        <hr>
        <h1>Envoyer un e-mail</h1><br>
        <form method="post">
            <div class="col-md-12">
                <input type="text" class="webLink EditField" placeholder="Objet" name="ObjMail">
            </div><br>
            <div class="col-md-12">
                <input type="text" id="edit" name="messageMail" placeholder="Message">
            </div><br>
            <center><input type="submit" class="webLink EditBtnVBig" value="Envoyer"></center>
        </form>

    </div>
</div>



<script>
    var CKEditor = new Object();
            //mise en place du CKeditor
    ClassicEditor
        .create( document.querySelector( '#edit' ) )
        .then( editor => {
            console.log( 'Editor was initialized', editor );
            CKEditor["edit"] = editor;
        } )
        .catch( error => {
            console.error( error );
        } );
</script>