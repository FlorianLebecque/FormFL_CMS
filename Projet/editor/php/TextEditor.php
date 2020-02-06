<?php

//id = id de la column,     parentID = id du conteneur
function loadText_edit($id,$BDD){
        $rnd = rand();
            //recupere les valeurs
        $req = "SELECT T.`texte`,T.`id` FROM `textes` T INNER JOIN `colum_texte` ct ON T.`id` = ct.`id_text`  WHERE ct.`id_colum` = ' " . $id . " ' ";
        $resultat = mysqli_query($BDD,$req);
        $resultat = mysqli_fetch_array($resultat,MYSQLI_ASSOC);
            
?>

    <div class="row" id="col_<?php echo $rnd?>">
       
        <div class="col-md-12">
            
            <div class="row">
                <div class="col-md-8 col-sm-8">
                        <!--Mettre un titre a la column-->
                    <input class="webLink EditBtnVBig EditField" type="text" id="titre_<?php echo $rnd?>" name="col_title" value="<?php echo GetTitle($id,$BDD); ?>">
                    <button class="webLink EditBtn" onclick="Set_title('<?php echo $id ?>','<?php echo $rnd ?>')" >Ok</button>
                </div>
                
                <div class="col-md-4 col-sm-4 text-right">           
                        <!--suppression du lien d'un module et d'une column-->
                    <button class="webLink EditBtn" onclick="del_text('<?php echo $id?>','<?php echo $resultat["id"] ?>','<?php echo $rnd ?>')" >X</button>
                </div>
            </div>
        </div>
        <br><br><br>
        <!--Editeur de text-->
        <div class='col-md-12'>
            <textarea name='texte' id="text_<?php echo $rnd ?>"><?php echo $resultat["texte"];?></textarea>
            <button class="webLink" onclick="mod_text('<?php echo $resultat["id"] ?>','<?php echo $rnd ?>')" >Sauvegarder</button>
        </div>
    </div>

    <script>
            //mise en place du CKeditor
        ClassicEditor
            .create( document.querySelector( '#text_<?php echo $rnd ?>' ) )
            .then( editor => {
                console.log( 'Editor was initialized', editor );
                CKEditor["text_<?php echo $rnd ?>"] = editor;
            } )
            .catch( error => {
                console.error( error );
            } );
    </script>
<?php
    }
?>