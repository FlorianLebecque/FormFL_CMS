<?php
        //compte le nombre de page
        $req ="SELECT count(*) as 'nbr' FROM `pages`";
        $res = mysqli_fetch_array(mysqli_query($BDD,$req),MYSQLI_ASSOC);
    
        //crée une page
    if(isset($_POST["addPage"])){
        if($_POST["addPage"]==1){
            $req = "INSERT INTO `pages`(`id`, `titre`) VALUES ('".($res["nbr"]+1)."','page ".($res["nbr"]+1)."')";
            mysqli_query($BDD,$req);
        }
    }

        //change les propriété de la page
    if((isset($_POST["pID"]))&&(isset($_POST["pageTitre"]))){

        $online = 0;
        if(isset($_POST["onlinePage"])){ $online = 1;}

        if($_POST["pID"]==1){$online = 0;}  //la page une ne peut pas être interdite

        $_POST["pageTitre"] = htmlspecialchars($_POST["pageTitre"]);
        $req = "UPDATE `pages` SET `titre`= '".$_POST["pageTitre"]."' , `online` = '".$online."'  WHERE `id` = '".$_POST["pID"]."'";
        mysqli_query($BDD,$req);
    }

        //supprime la page
    if(isset($_POST["delPage"])){
        if($_POST["delPage"]!= 1){
            $req = "DELETE FROM `pages` WHERE `id` = '".$_POST["delPage"]."'";
            mysqli_query($BDD,$req);
            msg("M3");
        }
    }

        //compte le nombre de page
    $req ="SELECT count(*) as 'nbr' FROM `pages`";
    $res = mysqli_fetch_array(mysqli_query($BDD,$req),MYSQLI_ASSOC);
?>
<title>Gestionnaire de pages</title>
<?php include("editor/php/EditorHeader.php") ?>
<div class="container">
    
    <div class="row Pageaff">

        <?php
                //test si il y a des pages
            if($res["nbr"] != 0){

                $req = "SELECT * FROM `pages`";
                $res = mysqli_query($BDD,$req);

                while($page = mysqli_fetch_array($res,MYSQLI_ASSOC)){
        ?>

            <div class="col-sm-12 col-md-4">
                <div class="vignet">  
                    <h2>Page numéro <?php echo $page["id"] ?></h2>
                    <div class="row">
                        <form method="post">
                            <input hidden name="pID" value="<?php echo $page["id"] ?>">
                            <input class="webLink EditBtnVBig EditField" name="pageTitre"  type="text" value="<?php echo $page["titre"] ?>" >
                            <input type="submit" class="webLink EditBtn" value="Ok"><br><br>
                            <p><input type="checkbox" name="onlinePage" <?php IsChecked($page["online"]); ?> >Page réservé</p>
                        </form>
                    </div>
                    <br>
                    <div class="row">
                            <!--suppréssion de la page-->
                        <form method="post" onSubmit="if(!confirm('Etes-vous certain de vouloir supprimer la page ?')){return false;}">
                            <input hidden value = "<?php echo $page["id"] ?>" name="delPage">
                            <input class="webLink EditBtnBig" type="submit" value="Supprimer">
                        </form>
                        <a href="index.php?p=<?php echo $page["id"]?>" class="webLink EditBtn">Voir</a><!--voir-->
                        <a href="index.php?p=editor&page=<?php echo $page["id"]?>" class="webLink EditBtn">Editer</a><!--editer-->
                    </div>
                </div>
            </div>

        <?php
                }
            }
        ?>

    </div>
        <!--Ajouter une page-->
    <div class="toBottom">
        <div class="container">
            <div class="col-md-3">
                <form method="post">
                    <input hidden name="addPage" value="1">
                    <input class="webLink" type="submit" value="Ajouter une page">
                </form>
            </div>  
        </div>
    </div>
</div>

<?php
    function IsChecked($oln){

        echo $oln == 0 ? "" : "CHECKED";
    }

?>