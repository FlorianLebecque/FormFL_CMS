<?php
    function loadLink_edit($id,$BDD){
        $rnd = rand();
        $req = "SELECT L.`nom`, L.`lien`,L.`id` FROM `liens` L INNER JOIN `colum_lien` cl ON L.`id` = cl.`id_lien`  WHERE cl.`id_colum` = ' " . $id . " ' ";
        $resultat = mysqli_query($BDD,$req);
        $resultat = mysqli_fetch_array($resultat,MYSQLI_ASSOC);
?>
    <div class="row" id="col_<?php echo $rnd?>">
           
       <div class="col-md-12">
            
            <div class="row">
                <div class="col-md-8 col-sm-10">
                        <!--Mettre un titre a la column-->
                    <input class="webLink EditBtnVBig EditField" type="text" id="titre_<?php echo $rnd?>" name="col_title" value="<?php echo GetTitle($id,$BDD); ?>">
                    <button class="webLink EditBtn" onclick="Set_title('<?php echo $id ?>','<?php echo $rnd ?>')" >Ok</button>
                </div>
                
                <div class="col-md-4 col-sm-4 text-right">           
                        <!--suppression du lien d'un module et d'une column-->
                    <button class="webLink EditBtn" onclick="del_link('<?php echo $id?>','<?php echo $resultat["id"] ?>','<?php echo $rnd ?>')" >X</button>
                </div>
            </div>
        
       </div>
       <br><br><br>
       <!--Editeur de lien-->
       <div class='col-md-12'>

            <input class="webLink" id="l_name<?php echo $rnd ?>" value='<?php echo $resultat["nom"];?>'>
            <input class="webLink" id="l_link<?php echo $rnd ?>" value='<?php echo $resultat["lien"]?>'>
            <button class="webLink" onclick="set_link('<?php echo $resultat["id"]?>','<?php echo $rnd ?>')" >Valider</button>

       </div>
   </div>


<?php
    }

?>