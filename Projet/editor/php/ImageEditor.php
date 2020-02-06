<?php
function loadImage_edit($id,$BDD){
    $rnd = rand();
    $req = "SELECT I.`id`, I.`nom`, I.`ext`  FROM `images` I INNER JOIN `colum_image` ci ON I.`id` = ci.`id_image`  WHERE ci.`id_colum` = ' " . $id . " ' ";
    $resultat = mysqli_query($BDD,$req);
    $resultat = mysqli_fetch_array($resultat,MYSQLI_ASSOC);
?>  
<div class="row" id="col_<?php echo $rnd?>"> 
    <div class="col-md-12">

        <div class="row">
            <div class="col-md-5 col-sm-5">
                    <!--Mettre un titre a la column-->
                <input class="webLink EditBtnVBig EditField" type="text" id="titre_<?php echo $rnd?>" name="col_title" value="<?php echo GetTitle($id,$BDD); ?>">
                <button class="webLink EditBtn" onclick="Set_title('<?php echo $id ?>','<?php echo $rnd ?>')" >Ok</button>
            </div>
            <!--Modification de l'image-->
            <div class="col-md-5 col-sm-5">
                <select class="webLink EditBtnVBig" name="image_selector" id="ImgSel_<?php echo $rnd?>">
                    <?php
                        $req = "SELECT * FROM `images`";
                        $imgs = mysqli_query($BDD,$req);

                        while($img = mysqli_fetch_array($imgs,MYSQLI_ASSOC)){
                            echo "<option value='".$img["id"]."'>".$img["nom"]."</option>";
                        }
                        mysqli_free_result($imgs);
                    ?>
                </select>
                <button class="webLink EditBtn" onclick="mod_img('<?php echo $id ?>','<?php echo $rnd ?>')" >Ok</button>
            </div>
            
            <div class="col-md-2 col-sm-2 text-right">           
                    <!--suppression du lien d'un module et d'une column-->
                <button class="webLink EditBtn" onclick="del_image('<?php echo $id?>','<?php echo $resultat["id"] ?>','<?php echo $rnd ?>')" >X</button>
            </div>
        </div>

    </div>
    <br><br><br>
    <div class=col-md-12>
        <img class='img' id="img_<?php echo $rnd?>" src='image/<?php echo $resultat["nom"].$resultat["ext"];?>' >
    </div>
</div>
<?php
}

function selected_image($curImg,$testImg){
    if($curImg==$testImg){
        return "SELECTED";
    }
}


?>