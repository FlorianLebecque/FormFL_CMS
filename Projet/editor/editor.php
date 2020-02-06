<?php
    if(isset($_POST["query"])){
        $query = preg_split("/[\|]+/", $_POST["query"]);

        for($i=0;$i<count($query)-1;$i++){
            mysqli_query($BDD,$query[$i]);
        }
    }



?>
<title>Editeur de pages</title>

<script>
    var CKEditor = new Object();
    var req = Array();
</script>

<?php include("editor/php/EditorHeader.php") ?>

<div class='EditContainer'>
    
    <div class="row">
        
        <!--Paneau des pages-->
        <div class="col-lg-1 col-md-12 webContener">
            <?php
                $req="SELECT * FROM `pages`";
                $res = mysqli_query($BDD,$req);

                while($page = mysqli_fetch_array($res,MYSQLI_ASSOC)){
                    echo "<button class='webLink' onclick='window.location.href=\"index.php?p=editor&page=".$page["id"]."\"'>".$page["titre"]." - ".$page["id"]."</button>";
                }

                mysqli_free_result($res);

            ?>
        </div>
        <!--Paneau principale-->
        <div class="col-lg-11 webContener">
            <!--Editeur-->
            <div class="row">
                <div class="col-md-12" id="builder">
                    <?php
                        if(isset($_GET["page"])){
                            if($_GET["page"]!= ""){
                                $_GET["page"] = htmlspecialchars($_GET["page"]);

                                $req = "SELECT count(*) as 'nbr' FROM `pages` WHERE `id` = '".$_GET["page"]."'";
                                $res = mysqli_fetch_array(mysqli_query($BDD,$req),MYSQLI_ASSOC);

                                if($res["nbr"]!= 0){
                                        //editeur
                                    echo "<h1>Edition page : ".$_GET["page"]."</h1><br>";
                                    $nbr = $_GET["page"];
                                    include("editor/php/function_edit.php");
                                        //id du dernier conteneur
                                    $req = "SELECT max(`id`) as 'nbr' FROM `conteneurs` WHERE 1";
                                    $LastInsertCont = mysqli_fetch_array(mysqli_query($BDD,$req),MYSQLI_ASSOC);
                                        //dernier lien insérer
                                    $req="SELECT MAX(`id`) as 'nbr' FROM `page_conteneurs` WHERE 1";
                                    $LastInsertCP = mysqli_fetch_array(mysqli_query($BDD,$req),MYSQLI_ASSOC);
                                        //derniere colonne ajouter
                                    $req="SELECT MAX(`id`) as 'nbr' FROM `colums` WHERE 1";
                                    $LastInsertColumn = mysqli_fetch_array(mysqli_query($BDD,$req),MYSQLI_ASSOC);
                                    
                                    if($LastInsertCont["nbr"] == ""){
                                        $LastInsertCont["nbr"] = 0;
                                    }
                                    if($LastInsertCP["nbr"] == ""){
                                        $LastInsertCP["nbr"] = 0;
                                    }
                                    if($LastInsertColumn["nbr"] == ""){
                                        $LastInsertColumn["nbr"] = 0;
                                    }
                                    $none = false;
                                }else{
                                    include("html/404.html");
                                }
                            }else{
                                include("html/404.html");
                            }
                        }else{
                            $_GET["page"] = -1;
                            $LastInsertCont["nbr"] = 0;
                            $LastInsertCP["nbr"] = 0;
                            $LastInsertColumn["nbr"] = 0;
                            echo "<h1>Aucune page sélectionnée</h1>";

                            $none = true;
                        }

                    ?>
 
                </div>

            </div>
            <?php
                if(!$none){
            ?>
            <!--Button ajouter et sauvgarder-->
            <div class="row">
                <div class="col-sm-8">                                      
                    <button class="webLink EditBtnBig" id="myBtn">Ajouter</button>        
                </div>
                <div class="col-sm-4 text-right">                                      
                    <button class="webLink EditBtnBig" onclick="Send_query()">Valider</button>        
                </div>
            </div>
            <?php
                }
            ?>
            
        </div>
    </div>
</div>


<div hidden>
    <form method="post" id="s">
        <textarea name="query" id="query_area"></textarea>
        <input type="submit" id ="query_form">
    </form>
</div>

<!-- The Modal -->
<div id="myModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <div><span class="close">&times;</span></div>
        <h1>Sélectionner votre layout</h1>
        <hr>
        <div class="row">
            <button class="webLink EditBtnVBig" onclick="addrow('12')" class="col-md-2"><img src="editor/image/12.png"></button>
            <button class="webLink EditBtnVBig" onclick="addrow('6/6')" class="col-md-2"><img src="editor/image/6_6.png"></button>
            <button class="webLink EditBtnVBig" onclick="addrow('3/3/3/3')" class="col-md-2"><img src="editor/image/3_3_3_3.png"></button>
            <button class="webLink EditBtnVBig" onclick="addrow('3/9')" class="col-md-2"><img src="editor/image/3_9.png"></button>
            <button class="webLink EditBtnVBig" onclick="addrow('9/3')" class="col-md-2"><img src="editor/image/9_3.png"></button>
            <button class="webLink EditBtnVBig" onclick="addrow('3/6/3')" class="col-md-2"><img src="editor/image/3_6_3.png"></button>
            <button class="webLink EditBtnVBig" onclick="addrow('3/3/6')" class="col-md-2"><img src="editor/image/3_3_6.png"></button>
            <button class="webLink EditBtnVBig" onclick="addrow('6/3/3')" class="col-md-2"><img src="editor/image/6_3_3.png"></button>
            <button class="webLink EditBtnVBig" onclick="addrow('4/4/4')" class="col-md-2"><img src="editor/image/4_4_4.png"></button>
            <button class="webLink EditBtnVBig" onclick="addrow('8/4')" class="col-md-2"><img src="editor/image/8_4.png"></button>
            <button class="webLink EditBtnVBig" onclick="addrow('4/8')" class="col-md-2"><img src="editor/image/4_8.png"></button>
        </div><br><br><br>
        <div class="row">
            <p class="col-md-12">Format du layout : nombre de colonne/nombre de colonne/nombre de colonne...</p>
            <input id="customLayout" class="webLink EditBtnVBig EditField" value="4/4/4">
            <button class="webLink EditBtnVBig" onclick="addrow('custom')" class="col-md-2">Layout Custom</button>
        </div>
    </div>
</div>

<script>

    var pageID = <?php echo $_GET["page"] ?>;
    var build = document.getElementById("builder");
    var cont_id = <?php echo $LastInsertCont["nbr"]?>;
    var cont_page_id =<?php echo $LastInsertCP["nbr"] ?> ;
    var column_id = <?php echo $LastInsertColumn["nbr"]?>;
    
        //tableau associatif des images
    var ImageArray = new Object();
    var DispImageArray = new Object();
    <?php
        $req = "SELECT * FROM `images`";
        $imgs = mysqli_query($BDD,$req);
            //on rempli le tableau avec le nom et la source des images
        while($img = mysqli_fetch_array($imgs,MYSQLI_ASSOC)){
            echo "ImageArray[".$img["id"]."] = '".$img["nom"].$img["ext"]."';";
            echo "DispImageArray[".$img["id"]."] = '".$img["nom"]."';";
        }
        mysqli_free_result($imgs);
    ?>
        //fonction pour ajouter une ligne dans la page
    function addrow(layout){
        modal.style.display = "none";

        cont_id+=1;
        cont_page_id+=1;

            //crée le conteneur dans la base de donnée
        req1="INSERT INTO `conteneurs`(`id`,`titre`) VALUES ('"+cont_id+"','Conteneur "+cont_id+"')";
        req.push(req1);
        let req2 = "INSERT INTO `page_conteneurs`(`id`,`id_page`, `id_conteneur`) VALUES ("+cont_page_id+","+pageID+","+cont_id+")";
        req.push(req2);
        
        let rnd = Math.floor(Math.random()*100000); //permet d'avoir un code d'identification pour les id HTML
        let lay
        if(layout == "custom"){
            let CustomLayout = document.getElementById("customLayout").value;
            lay = CustomLayout.split("/");
        }else{
            lay =  layout.split("/");    //connaitre la taille des colonnes
        }
         
        let ligne = Array();    //tableau dans lequel on ecrira chaque ligne html

        ligne.push("<div class='cont_edit' id='cont_"+rnd+"'>");
        ligne.push("<div class='row'>");
        ligne.push("<div class=\"col-md-8 col-sm-8\">");
        ligne.push("<input class=\"webLink EditBtnVBig EditField\" type=\"text\" id=\"text_"+rnd+"\" value=\"Conteneur\">");
        ligne.push("<button class=\"webLink EditBtn\" onclick=\"set_cont_title('"+cont_id+"','"+rnd+"')\" >Valider</button>");
        ligne.push("</div>");
        ligne.push("<div class=\"col-md-4 col-sm-4 text-right\">");
        ligne.push("<button class=\"webLink EditBtn\" onclick=\"del_cont('"+cont_page_id+"','"+rnd+"')\" >X</button>");
        ligne.push("</div>");
        ligne.push("</div>");
        ligne.push("<hr>");
        ligne.push("<div class='row'>");
        for(let i = 0; i< lay.length;i++){
            let HtRnd = Math.floor(Math.random()*100000);
            column_id = column_id+1;
                //requete pour les colonnes
            req.push("INSERT INTO `colums`(`id`, `type`, `titre`) VALUES ('"+column_id+"','-','une colonne');");
            req.push("INSERT INTO `conteneur_colum`(`id_conteneur`, `id_colum`, `taille`) VALUES ('"+cont_id+"','"+column_id+"','"+lay[i]+"')");
                //html pour les colonnes
            ligne.push("<div class='cont_edit col-md-"+lay[i]+"'>");
                ligne.push("<div clas='row' id='col_"+HtRnd+"'>");
                    ligne.push("<button class=\"webLink EditBtnVBig \" onclick=\"add_text('"+HtRnd+"','"+column_id+"')\" >Ajouter un text</button>");
                    ligne.push("<button class=\"webLink EditBtnVBig \" onclick=\"add_image('"+HtRnd+"','"+column_id+"')\" >Ajouter une image</button>");
                    ligne.push("<button class=\"webLink EditBtnVBig \" onclick=\"add_lien('"+HtRnd+"','"+column_id+"')\" >Ajouter un lien</button>");
                ligne.push("</div>");
            ligne.push("</div>");
        }
        ligne.push("</div>");
        ligne.push("</div>");     

        let temp="";
        for(let i =0; i< ligne.length;i++){
            temp += ligne[i];
        }

        build.innerHTML += temp;    //application du HTML

    }
        //recupération des queries dans le tableau req, pour les mettres dans un textArea
    function Send_query(){
        let query = document.getElementById("query_area");
        let form = document.getElementById("query_form");
        for(let i=0;i < req.length;i++){
            query.value += req[i] + "|";
            console.log(req[i]);
        }
        form.click();
    }

</script>
<script>
        // Get the modal
        var modal = document.getElementById('myModal');
            // Get the button that opens the modal
        var btn = document.getElementById("myBtn");
            // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];
    
         // When the user clicks on the button, open the modal 
         btn.onclick = function() {
            modal.style.display = "block";
        }
    
        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }
    
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    
    </script>