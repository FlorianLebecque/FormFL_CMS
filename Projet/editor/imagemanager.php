<?php
    $err=0;
        //compte le nombre de page
    $req ="SELECT count(*) as 'nbr' FROM `pages`";
    $res = mysqli_fetch_array(mysqli_query($BDD,$req),MYSQLI_ASSOC);
    
        //nouvelle image
    $exten = array(".jpg",".gif",".png",".jpeg");
    if(isset($_FILES["NewImage"])&&($_FILES["NewImage"]["error"]==0)){
        $info = pathinfo($_FILES["NewImage"]["name"]);//recupere les info
        
        $ext = ".".$info["extension"];
        $name = str_replace($ext,"",$info["basename"]);

        if(in_array($ext,$exten)){
            move_uploaded_file($_FILES['NewImage']['tmp_name'], 'image/' . basename($name.$ext));

                //ajout image dans bdd
            $req = "INSERT INTO `images`(`nom`,`ext`) VALUES ('".$name."','".$ext."')";
            mysqli_query($BDD,$req);

        }else{
            $err="E10";
        }

    }
        //renomer
    if((isset($_POST["pID"]))&&(isset($_POST["imageName"]))){
        $_POST["imageName"] = htmlspecialchars($_POST["imageName"]);
            //renome l'image
        rename("image/".$_POST["OldName"].$_POST["ImageExt"],"image/".$_POST["imageName"].$_POST["ImageExt"]);
        
            //renome la column associer
        $req = "UPDATE `colums` SET `titre`= '".$_POST["imageName"]."'  WHERE `id` = (SELECT `id_colum` FROM colum_image WHERE `id_image` = '".$_POST["pID"]."')";
        mysqli_query($BDD,$req);

            //renome dans la bdd;
        $req = "UPDATE `images` SET `nom`= '".$_POST["imageName"]."' WHERE `id` = '".$_POST["pID"]."'";
        mysqli_query($BDD,$req);
        msg("M2");
    }

        //supprimer une image
    if(isset($_POST["delImage"])){
    
            unlink("image/".$_POST["delImageName"].$_POST["delImageExt"]);
                //Mes a jour la column
            $req ="UPDATE `colums` SET `type`='-' WHERE `id` in (SELECT `id_colum` FROM colum_image WHERE `id_image` = '".$_POST["delImage"]."')";
            mysqli_query($BDD,$req);
                //supprime les liens dans la table column image
            $req = "DELETE FROM `colum_image` WHERE `id_image` = '".$_POST["delImage"]."'";
            mysqli_query($BDD,$req);
                //supprime l'image
            $req = "DELETE FROM `images` WHERE `id` = '".$_POST["delImage"]."'";
            mysqli_query($BDD,$req);
        
    }

?>

<link rel="stylesheet" type="text/css" href="css\editorstyle.css">
<title>Gestionnaire de pages</title>

<?php include("editor/php/EditorHeader.php") ?>

<div class="container">
    
    <div class="row Pageaff">

        <?php
            msg($err);
                //test si il y a des pages
            if($res["nbr"] != 0){

                $req = "SELECT * FROM `images`";
                $res = mysqli_query($BDD,$req);

                while($image = mysqli_fetch_array($res,MYSQLI_ASSOC)){
        ?>

            <div class="col-sm-12 col-md-4">
                <div class="vignet">
                    <!--Renomer l'image-->
                    <div class="row">
                        <form method="post">
                            <input hidden name="pID" value="<?php echo $image["id"] ?>">
                            <input hidden value = "<?php echo $image["ext"] ?>" name="ImageExt">
                            <input hidden value = "<?php echo $image["nom"] ?>" name="OldName">
                            <input class="webLink EditBtnVBig EditField" name="imageName"  type="text" value="<?php echo $image["nom"] ?>" >
                            <input type="submit" class="webLink EditBtn" value="Ok">
                        </form>
                    </div>
                    <hr>
                    <img src="image/<?php echo $image["nom"].$image["ext"] ?>">
                    <hr>
                    <!--Supprimer l'image-->
                    <div class="row">
                        <form method="post" onSubmit="if(!confirm('Etes-vous certain de vouloir supprimer l\'image ?')){return false;}">
                            <input hidden value = "<?php echo $image["id"] ?>" name="delImage">
                            <input hidden value = "<?php echo $image["nom"] ?>" name="delImageName">
                            <input hidden value = "<?php echo $image["ext"] ?>" name="delImageExt">
                            <input class="webLink EditBtnBig" type="submit" value="Supprimer">
                        </form>
                    </div>
                </div>
            </div>

        <?php
                }
            }
        ?>

    </div>
    <!--Ajouter une image-->
    <div class="toBottom">
        <div class="container">
            <div class="col-md-6">
                <form method="post" enctype="multipart/form-data">
                    <input class="webLink EditBtnVBig" type="file" name="NewImage" accept=".jpg, .jpeg, .png, .gif">
                    <input class="webLink EditBtnVBig" type="submit" value="Ajouter une image">
                </form>
            </div>  
        </div>
    </div>
</div>