<script>
        //supprimer un conteneur
    function del_cont(ID_CONT,ID_HTML){       
        req.push("DELETE FROM `colums`  WHERE `id` in (SELECT `id_colum` FROM conteneur_colum WHERE `id_conteneur` = '"+ID_CONT+"')");//supprime tout les columns associer au conteneur
        req.push("DELETE FROM `conteneurs` WHERE `id` = '"+ID_CONT+"'");    //supprime le conteneur

        let cont = document.getElementById("cont_"+ID_HTML).remove();
        console.log("Conteneur supprimer");
    }
    function set_cont_title(ID_CONT,ID_HTML){
        let text = document.getElementById("text_"+ID_HTML).value;
        let req1 = "UPDATE `conteneurs` SET `titre`='"+text+"' WHERE `id` = '"+ID_CONT+"'";
        req.push(req1);
        console.log("Titre mis à jour");
    }
</script>