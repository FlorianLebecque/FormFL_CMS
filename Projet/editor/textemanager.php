<?php
        //compte le nombre de texte
    $req ="SELECT count(*) as 'nbr' FROM `textes`";
    $res = mysqli_fetch_array(mysqli_query($BDD,$req),MYSQLI_ASSOC);

    if(isset($_POST["delTexte"])){
        
            //redefinie la column
        $req ="UPDATE `colums` SET `type`='-' WHERE `id` = (SELECT `id_colum` FROM colum_texte WHERE `id_text` = '".$_POST["delTexte"]."')";
        mysqli_query($BDD,$req);
            //supprime le texte
        $req = "DELETE FROM `textes` WHERE `id` = '".$_POST["delTexte"]."'";
        mysqli_query($BDD,$req);

    }

?>

<title>Gestionnaire de textes</title>
<?php include("editor/php/EditorHeader.php") ?>
<div class="container">

    <div class="row Pageaff">

        <?php   

                //test si il y a des pages
            if($res["nbr"] != 0){
                $req = "SELECT * FROM `textes`";
                $res = mysqli_query($BDD,$req);
                    //pour chaque textes dans la base de données
                while($texte = mysqli_fetch_array($res,MYSQLI_ASSOC)){
        ?>
                    <div class="col-md-4">
                        <div class="vignet">
                            <div class="pastrop">
                                <p><?php echo $texte["texte"]?><p>
                            </div>
                            <br>
                            <div class="row">
                                <form method="post" onSubmit="if(!confirm('Etes-vous certain de vouloir supprimer le texte ?')){return false;}">
                                    <input hidden value = "<?php echo $texte["id"] ?>" name="delTexte">
                                    <input class="webLink EditBtnBig" type="submit" value="Supprimer">
                                </form>
                                <a href="index.php?p=TextWritter&text=<?php echo $texte["id"]?>" class="webLink EditBtn">Editer</a>
                            </div>
                        </div>
                    </div>
        <?php
                } 
            }
        ?>

    </div>

</div>