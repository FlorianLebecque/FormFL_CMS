<?php
        //compte le nombre de lien
    $req ="SELECT count(*) as 'nbr' FROM `liens`";
    $res = mysqli_fetch_array(mysqli_query($BDD,$req),MYSQLI_ASSOC);

    if(isset($_POST["delLien"])){
        
            //Mes a jour la column
        $req ="UPDATE `colums` SET `type`='-' WHERE `id` = (SELECT `id_colum` FROM colum_lien WHERE `id_lien` = '".$_POST["delLien"]."')";
        mysqli_query($BDD,$req);
            //supprime le lien
        $req = "DELETE FROM `liens` WHERE `id` = '".$_POST["delLien"]."'";
        mysqli_query($BDD,$req);

    }
        //changement de titre
    if(isset($_POST["SetTitle"])){

            //renome la column associer
        $req = "UPDATE `colums` SET `titre`= 'lien_".$_POST["lienTitre"]."'  WHERE `id` = (SELECT `id_colum` FROM colum_lien WHERE `id_lien` = '".$_POST["lID"]."')";
        mysqli_query($BDD,$req);

            //renome dans la bdd;
        $req = "UPDATE `liens` SET `nom`= '".$_POST["lienTitre"]."',`lien`= '".$_POST["lienlien"]."' WHERE `id` = '".$_POST["lID"]."'";
        mysqli_query($BDD,$req);
        msg("M2");
    }

?>

<title>Gestionnaire de liens</title>
<?php include("editor/php/EditorHeader.php") ?>
<div class="container">

    <div class="row Pageaff">

        <?php
                //test si il y a des pages
            if($res["nbr"] != 0){
                $req = "SELECT * FROM `colums` WHERE `type`='l'";
                $res = mysqli_query($BDD,$req);

                while($col = mysqli_fetch_array($res,MYSQLI_ASSOC)){
                    $req = "SELECT T.`nom`,T.`id`,T.`lien` FROM `liens` T INNER JOIN `colum_lien` ct ON T.`id` = ct.`id_lien`  WHERE ct.`id_colum` = ' " . $col["id"] . " ' ";
                    $nom = mysqli_fetch_array(mysqli_query($BDD,$req),MYSQLI_ASSOC);
          
        ?>

            <div class="col-md-4">
                <div class="vignet">
                    <div class="row">
                        <form method="post">
                            <input hidden value="<?php echo $nom["id"] ?>" name="lID">
                            <input class="webLink EditBtnVBig EditField" name="lienTitre" type="text" value="<?php echo $nom["nom"]?>">
                            <input class="webLink EditBtnVBig EditField" name="lienlien" type="text" value="<?php echo $nom["lien"]?>">
                            <input type="submit" name="SetTitle" class="webLink EditBtn" value="Ok">
                        </form>
                    </div> 
                    <br>
                    <div class="row">
                        <form method="post" onSubmit="if(!confirm('Etes-vous certain de vouloir supprimer le nom ?')){return false;}">
                            <input hidden value = "<?php echo $nom["id"] ?>" name="delLien">
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

</div>