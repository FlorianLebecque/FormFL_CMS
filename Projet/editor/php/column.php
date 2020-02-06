<?php

    $req = " SELECT MAX(`id`) as 'nbr' FROM liens";   
    $LastIdLien = mysqli_fetch_array(mysqli_query($BDD,$req),MYSQLI_ASSOC);
    $req = " SELECT MAX(`id`) as 'nbr' FROM textes";
    $LastIdText = mysqli_fetch_array(mysqli_query($BDD,$req),MYSQLI_ASSOC);
    $req = " SELECT MAX(`id`) as 'nbr' FROM colums";            
    $LastIdCol = mysqli_fetch_array(mysqli_query($BDD,$req),MYSQLI_ASSOC);
    $req = " SELECT MIN(`id`) as 'nbr' FROM images";
    $FirstIdImage = mysqli_fetch_array(mysqli_query($BDD,$req),MYSQLI_ASSOC);

    if($LastIdText["nbr"] == ""){
        $LastIdText["nbr"] = 0;
    }
    if($LastIdLien["nbr"] == ""){
        $LastIdLien["nbr"] = 0;
    }
    if($LastIdCol["nbr"] == ""){
        $LastIdCol["nbr"] = 0;
    }
    if($FirstIdImage["nbr"] == ""){
        $FirstIdImage["nbr"] = 0;
    }


?>
<script>
    let lastTextID = <?php echo $LastIdText["nbr"]; ?>;
    let lastColID = <?php echo $LastIdCol["nbr"]?>;
    let LastLienID = <?php echo $LastIdLien["nbr"]?>;
    let FirstImageID = <?php echo $FirstIdImage["nbr"]?>;

        //supprime le text
    function del_text(ID_col,ID_text,ID_HTML){
        let req1 = "UPDATE `colums` SET `type`='-' WHERE `id` = '"+ID_col+"'";
        let req2 = "DELETE FROM `colum_texte` WHERE `id_text` = '"+ID_text+"' AND `id_colum` = '"+ID_col+"'";

        req.push(req1);
        req.push(req2);

        console.log("Mise a jour column : "+ID_col);
        console.log("Suppréssion text : "+ID_text);
        let column = document.getElementById("col_"+ID_HTML);
        column.innerHTML = "<button class=\"webLink EditBtnVBig \" onclick=\"add_text('"+ID_HTML+"','"+ID_col+"')\" >Ajouter un text</button><button class=\"webLink EditBtnVBig \" onclick=\"add_image('"+ID_HTML+"','"+ID_col+"')\" >Ajouter une image</button><button class=\"webLink EditBtnVBig \" onclick=\"add_lien('"+ID_HTML+"','"+ID_col+"')\" >Ajouter un lien</button>";

    }
           //supprime l'image
    function del_image(ID_col,ID_img,ID_HTML){
        let req1 = "UPDATE `colums` SET `type`='-' WHERE `id` = '"+ID_col+"'";
        let req2 = "DELETE FROM `colum_img` WHERE `id_image` = '"+ID_img+"' AND `id_colum` = '"+ID_col+"'";

        req.push(req1);
        req.push(req2);

        console.log("Mise à jour column : "+ID_col);
        console.log("Suppréssion image : "+ID_img);
        let column = document.getElementById("col_"+ID_HTML);
        column.innerHTML = "<button class=\"webLink EditBtnVBig \" onclick=\"add_text('"+ID_HTML+"','"+ID_col+"')\" >Ajouter un text</button><button class=\"webLink EditBtnVBig \" onclick=\"add_image('"+ID_HTML+"','"+ID_col+"')\" >Ajouter une image</button><button class=\"webLink EditBtnVBig \" onclick=\"add_lien('"+ID_HTML+"','"+ID_col+"')\" >Ajouter un lien</button>";

    }
        //supprime un lien
    function del_link(ID_col,ID_lien,ID_HTML){
        let req1 = "UPDATE `colums` SET `type`='-' WHERE `id` = '"+ID_col+"'";
        let req2 = "DELETE FROM `colum_lien` WHERE `id_lien` = '"+ID_lien+"' AND `id_colum` = '"+ID_col+"'";

        req.push(req1);
        req.push(req2);

        let column = document.getElementById("col_"+ID_HTML);
        column.innerHTML = "<button class=\"webLink EditBtnVBig \" onclick=\"add_text('"+ID_HTML+"','"+ID_col+"')\" >Ajouter un text</button><button class=\"webLink EditBtnVBig \" onclick=\"add_image('"+ID_HTML+"','"+ID_col+"')\" >Ajouter une image</button><button class=\"webLink EditBtnVBig \" onclick=\"add_lien('"+ID_HTML+"','"+ID_col+"')\" >Ajouter un lien</button>";

    }
        //modifier un lien
    function set_link(ID_lien,ID_HTML){
        let l_name = document.getElementById("l_name"+ID_HTML).value;
        let l_link = document.getElementById("l_link"+ID_HTML).value;
        let req1 = "UPDATE `liens` SET `nom`='"+l_name+"',`lien`='"+l_link+"' WHERE `id`='"+ID_lien+"'";
        req.push(req1);
        console.log("lien mis à jour");
    }
        //modifie le texte
    function mod_text(ID_text,ID_HTML){
        let text = CKEditor["text_"+ID_HTML].getData();
        let req1 = "UPDATE `textes` SET `texte`='"+text+"' WHERE `id`='"+ID_text+"'";
        req.push(req1);
        console.log("texte mis à jour id : " + ID_text);
    }
          //modifie le texte
    function mod_img(ID_col,ID_HTML){
        let Image_sel = document.getElementById("ImgSel_"+ID_HTML).value;
        let req1 = "UPDATE `colum_image` SET `id_image`= '"+Image_sel+"' WHERE `id_colum` = '"+ID_col+"'";
        req.push(req1);
        console.log("Image mis à jour id : " + ID_col +" : "+ Image_sel);
        
        let img = document.getElementById("img_"+ID_HTML);
        img.setAttribute("src","image/"+ImageArray[Image_sel]);

    }
        //modifie le titre d'une column
    function Set_title(ID_col,ID_HTML){
        let titre = document.getElementById("titre_"+ID_HTML);
        let req1 = "UPDATE `colums` SET `titre`= '"+titre.value+"' WHERE `id` = '"+ID_col+"'";
        req.push(req1);
        console.log("titre mis à jour");
    }
        //ajoute un texte
    function add_text(ID_HTML,ID_col){

        lastTextID++;

        let col = document.getElementById("col_"+ID_HTML);

            //met le html dans un tableau
        col.innerHTML = "";
        let ligne = Array();
        ligne.push("<div class='col-md-12'>");
        ligne.push("    <div class='row'>");
        ligne.push("        <div class='col-md-8 col-sm-8'>");
        ligne.push("            <input class='webLink EditBtnVBig EditField' type='text' id='titre_"+ID_HTML+"' name='col_title' value='Titre'>");
        ligne.push("            <button class='webLink EditBtn' onclick='Set_title(\""+ID_col+"\",\""+ID_HTML+"\")'>Ok</button>");
        ligne.push("        </div>");
        ligne.push('        <div class="col-md-4 col-sm-4 text-right">');
        ligne.push("            <button class='webLink EditBtn' onclick='del_text(\""+ID_col+"\",\""+lastTextID+"\",\""+ID_HTML+"\")'>X</button>");
        ligne.push("        </div>");
        ligne.push("    </div>");
        ligne.push("</div>");
        ligne.push("<br><br><br>");
        ligne.push("<div class='col-md-12'>");
        ligne.push("    <textarea name='texte' id='text_"+ID_HTML+"'></textarea>");
        ligne.push("    <button class='webLink' onclick='mod_text(\""+lastTextID+"\",\""+ID_HTML+"\")' >Sauvegarder</button>");
        ligne.push("</div>");

        let temp="";
        for(let i =0; i< ligne.length;i++){
            temp += ligne[i];
        }
            //applique le html
        col.innerHTML += temp;
            //applique le Ckeditor
        add_CKeditor(ID_HTML);

                //requete mysql
            //creer le texte
        let req1 = "INSERT INTO `textes`(`id`, `texte`) VALUES ("+lastTextID+",'')";
        req.push(req1);
            //lie le texte a la column;
        let req2 = "INSERT INTO `colum_texte`(`id_colum`, `id_text`) VALUES ('"+ID_col+"','"+lastTextID+"')";
        req.push(req2);
            //change le type de la column
        let req3 = "UPDATE `colums` SET `type`='t' WHERE `id` = '"+ID_col+"'";
        req.push(req3);

    }
        //ajoute une image
    function add_image(ID_HTML,ID_col){
        if(FirstImageID != 0){
            let col = document.getElementById("col_"+ID_HTML);

                //met le html dans un tableau
            col.innerHTML = "";
            let ligne = Array();
            ligne.push("<div class='col-md-12'>");
            ligne.push("    <div class='row'>");
            ligne.push("        <div class='col-md-5 col-sm-5'>");
            ligne.push("            <input class='webLink EditBtnVBig EditField' type='text' id='titre_"+ID_HTML+"' name='col_title' value='Titre'>");
            ligne.push("            <button class='webLink EditBtn' onclick='Set_title(\""+ID_col+"\",\""+ID_HTML+"\")'>Ok</button>");
            ligne.push("        </div>");
            ligne.push("        <div class='col-md-5 col-sm-5'>");
            ligne.push("            <select class='webLink EditBtnVBig' name='image_selector' id='ImgSel_"+ID_HTML+"'>");
            for(let img in ImageArray){
                ligne.push("            <option value='"+img+"'>"+DispImageArray[img]+"</option>");
            }
            ligne.push("            </select>");
            ligne.push("            <button class='webLink EditBtn' onclick='mod_img(\""+ID_col+"\",\""+ID_HTML+"\")' >Ok</button>");
            ligne.push("        </div>");
            ligne.push('        <div class="col-md-2 col-sm-2 text-right">');
            ligne.push("            <button class='webLink EditBtn' onclick='del_image(\""+ID_col+"\",\""+FirstImageID+"\",\""+ID_HTML+"\")'>X</button>");
            ligne.push("        </div>");
            ligne.push("    </div>");
            ligne.push("</div>");
            ligne.push("<br><br><br>");
            ligne.push("<div class='col-md-12'>");
            ligne.push("    <img class='img' id='img_"+ID_HTML+"' src='image/"+ImageArray[FirstImageID]+"'>");
            ligne.push("</div>");

            let temp="";
            for(let i =0; i< ligne.length;i++){
                temp += ligne[i];
            }
                //applique le html
            col.innerHTML += temp;

                    //requete mysql
                //lie l'image a la column;
            let req2 = "INSERT INTO `colum_image`(`id_colum`, `id_image`) VALUES ('"+ID_col+"','"+FirstImageID+"')";
            req.push(req2);
                //change le type de la column
            let req3 = "UPDATE `colums` SET `type`='i' WHERE `id` = '"+ID_col+"'";
            req.push(req3);

            console.log(ID_HTML+" - "+ ID_col);
        }else{
            let col = document.getElementById("col_"+ID_HTML);
            col.innerHTML = "";
            let ligne = Array();
            ligne.push("<button class=\"webLink EditBtnVBig \" onclick=\"add_text('"+ID_HTML+"','"+ID_col+"')\" >Ajouter un text</button><button class=\"webLink EditBtnVBig \" onclick=\"add_image('"+ID_HTML+"','"+ID_col+"')\" >Ajouter une image</button><button class=\"webLink EditBtnVBig \" onclick=\"add_lien('"+ID_HTML+"','"+ID_col+"')\" >Ajouter un lien</button>")
            ligne.push("<?php msg("E12")?>");
            let temp="";
            for(let i =0; i< ligne.length;i++){
                temp += ligne[i];
            }
                //applique le html
            col.innerHTML += temp;

        }
        
    }
        //ajoute un lien
    function add_lien(ID_HTML,ID_col){
        
        LastLienID++;

        let col = document.getElementById("col_"+ID_HTML);

            //met le html dans un tableau
        col.innerHTML = "";
        let ligne = Array();
        ligne.push("<div class='col-md-12'>");
        ligne.push("    <div class='row'>");
        ligne.push("        <div class='col-md-8 col-sm-8'>");
        ligne.push("            <input class='webLink EditBtnVBig EditField' type='text' id='titre_"+ID_HTML+"' name='col_title' value='Titre'>");
        ligne.push("            <button class='webLink EditBtn' onclick='Set_title(\""+ID_col+"\",\""+ID_HTML+"\")'>Ok</button>");
        ligne.push("        </div>");
        ligne.push('        <div class="col-md-4 col-sm-4 text-right">');
        ligne.push("            <button class='webLink EditBtn' onclick='del_link(\""+ID_col+"\",\""+LastLienID+"\",\""+ID_HTML+"\")'>X</button>");
        ligne.push("        </div>");
        ligne.push("    </div>");
        ligne.push("</div>");
        ligne.push("<br><br><br>");
        ligne.push("<div class='col-md-12'>");
        ligne.push("    <input class='webLink' id='l_name"+ID_HTML+"' value='un lien'>");
        ligne.push("    <input class='webLink' id='l_link"+ID_HTML+"' value='index.php?p=1'>");
        ligne.push("    <button class='webLink' onclick='set_link(\""+LastLienID+"\",\""+ID_HTML+"\")' >Valider</button>");
        ligne.push("</div>");

        let temp="";
        for(let i =0; i< ligne.length;i++){
            temp += ligne[i];
        }
            //applique le html
        col.innerHTML += temp;

                //requete mysql
            //creer le texte
        let req1 = "INSERT INTO `liens`(`id`, `nom`,`lien`) VALUES ("+LastLienID+",'un lien','index.php?p=1')";
        req.push(req1);
            //lie le texte a la column;
        let req2 = "INSERT INTO `colum_lien`(`id_colum`, `id_lien`) VALUES ('"+ID_col+"','"+LastLienID+"')";
        req.push(req2);
            //change le type de la column
        let req3 = "UPDATE `colums` SET `type`='l' WHERE `id` = '"+ID_col+"'";
        req.push(req3);
    }
        //applique le ckeditor
    function add_CKeditor(ID_HTML){
        //mise en place du CKeditor
        ClassicEditor
            .create( document.querySelector( '#text_'+ID_HTML ) )
            .then( editor => {
                console.log( 'Editor was initialized', editor );
                CKEditor["text_"+ID_HTML] = editor;
            } )
            .catch( error => {
                console.error( error );
            } );
    }

    

</script>