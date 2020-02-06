<?php
    $rnd = rand();
?>
<div class='cont_edit' id="cont_<?php echo $rnd ?>">
    <div class='row'>
            <!--titre du conteneur-->
        <div class="col-md-8  col-sm-8">
            <input class="webLink EditBtnVBig  EditField" type="text" id="text_<?php echo $rnd; ?>" value="<?php echo $conteneur["titre"] ?>">
            <button class="webLink EditBtn" onclick="set_cont_title('<?php echo $conteneur["id"] ?>','<?php echo $rnd ?>')" >Valider</button>
        </div>
            <!--suppression du lien d'un conteneur et de la page-->
        <div class="col-md-4 col-sm-4 text-right">
            <button class="webLink EditBtn" onclick="del_cont('<?php echo $conteneur["link"] ?>','<?php echo $rnd ?>')" >X</button>
        </div>
    </div>
    <hr>