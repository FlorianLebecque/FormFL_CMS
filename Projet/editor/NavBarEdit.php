<?php

    if(isset($_POST["query"])){
        $query = preg_split("/[\|]+/", $_POST["query"]);

        for($i=0;$i<count($query)-1;$i++){
            mysqli_query($BDD,$query[$i]);
        }
    }

    $req = "SELECT max(`id`) as 'nbr' FROM `headerbutton`";
    $LastID = mysqli_fetch_array(mysqli_query($BDD,$req),MYSQLI_ASSOC);
    
    if( $LastID["nbr"] == ""){
        echo "bite";
        $LastID["nbr"] = 0;
    }

?>
<title>Créateur de menu</title>
<?php include("editor/php/EditorHeader.php") ?>
<div class="EditContainer">
    
    <div class="col-md-12 webContener">
        <div class="col-md-12">
            <h1>Editeur de menu</h1>
        </div>
    </div>
    <br>
    <div class="col-md-12 webContener">
        <div class="row">
            <?php  
                $countArray= [];
                for($i = 1;$i<7;$i++){
                    $req = "SELECT * FROM `headerbutton` WHERE `emplacement` = '".$i."'"; //récupération de chaque élement dans la column spécifier
                    $res = mysqli_query($BDD,$req);

                    echo "<div class='col-md-2' id='column-".$i."'>";


                    $countArray[$i] = 0;
                    while($link = mysqli_fetch_array($res,MYSQLI_ASSOC)){
                        $countArray[$i] ++;
                        echo "<div class='row'>";
                        echo "  <div class='col-md-12' id='lien-".$i."-".$countArray[$i]."'>";
                        echo "      <input type='text' onchange='SetModif(".$link["id"].")' name='t-".$link["id"]."' id='".$link["id"]."' placeholder='Titre' value='".$link["titre"]."' class='webLink EditField'>";
                        echo "      <input type='text' onchange='SetModif(".$link["id"].")' name='l-".$link["id"]."' placeholder='Lien' value='".$link["lien"]."' class='webLink EditField'>";
                        echo "  <br><br></div>";
                        echo "</div>";
                    }

                    mysqli_free_result($res);
                    echo "<div class='col-md-12' id='btn_".$i."'>";
                    echo "  <div class='row'>";
                    echo '      <button class="webLink col-md-6" onclick="Remove('.$i.')">-</button>';
                    echo '      <button class="webLink col-md-6" onclick="Add('.$i.')">+</button>';
                    echo "  </div>";
                    echo "</div>";
                    echo "</div>";

                }

            ?>
        </div>
    </div>
    <br>
    <div class="col-md-12 webContener">
        <div class=" row justify-content-end">
            <div class="">                                      
                <button class="webLink EditBtnBig" onclick="MakeMenu()">Valider</button>        
            </div>
        </div>
    </div>
    
</div>

<div hidden>
    <form method="post" id="s">
        <textarea name="query" id="query_area"></textarea>
        <input type="submit" id ="query_form">
    </form>
</div>

<script>
    
    let countBtn = [];
    countBtn[1] = <?php echo $countArray[1]?>;
    countBtn[2] = <?php echo $countArray[2]?>;
    countBtn[3] = <?php echo $countArray[3]?>;
    countBtn[4] = <?php echo $countArray[4]?>;
    countBtn[5] = <?php echo $countArray[5]?>;
    countBtn[6] = <?php echo $countArray[6]?>;
    
    let lastBtnID = <?php echo $LastID["nbr"]; ?> ;


    let req_sup = [];   //requette de suppréssion
    let req_add = [];   //requette d'ajout
    let modif = [];



    function Remove(ID_COL){
        let col = document.getElementById("lien-"+ID_COL+"-"+countBtn[ID_COL]);  //recupere le div dans lequel le lien est inscrit
        let btn =col.firstElementChild.getAttribute("id");  //recupere l'id du lien

        col.parentElement.remove(col);  //supprime le div
        countBtn[ID_COL]--; //diminue le compteur
            //supprime le lien du tableau de modif, si il y ai pas, il se passe rien
        modif.pop(btn);

        req_sup.push("DELETE FROM `headerbutton` WHERE `id` = '"+btn+"'");//enregistre la requete

    }

    function Add(ID_COL){
        let rowBtn = document.getElementById("btn_"+ID_COL);
        rowBtn.parentElement.removeChild(rowBtn);

            //id du dernier button ajouter
        ID_BTN = lastBtnID + 1;
        lastBtnID++;    
        countBtn[ID_COL]++;

            //met le  lien dans le tableau des modifications
        modif.push(lastBtnID);

        let ligne = Array();
        
            //on ajoute les boite de texte pour le buton
        ligne.push("<div class='row'>");
        ligne.push("    <div class='col-md-12' id='lien-"+ID_COL+"-"+countBtn[ID_COL]+"'>");
        ligne.push("        <input type='text' onchange='SetModif("+ID_BTN+")' name='t-"+ID_BTN+"' id='"+ID_BTN+"' placeholder='Titre' value='' class='webLink EditField'>");
        ligne.push("        <input type='text' onchange='SetModif("+ID_BTN+")' name='l-"+ID_BTN+"' placeholder='Lien' value='' class='webLink EditField'>");
        ligne.push("    <br><br></div>");
        ligne.push("</div>");
            //on remet les boutons d'ajouts et suppréssion
        ligne.push("<div class='col-md-12' id='btn_"+ID_COL+"'>");
        ligne.push("    <div class='row'>");
        ligne.push("        <button class='webLink col-md-6' onclick='Remove("+ID_COL+")'>-</button>");
        ligne.push("        <button class='webLink col-md-6' onclick='Add("+ID_COL+")'>+</button>");
        ligne.push("    </div>");
        ligne.push("</div>");

        req_add.push("INSERT INTO `headerbutton`(`id`, `emplacement`, `titre`) VALUES ("+ID_BTN+","+ID_COL+",'');");
           
        let col = document.getElementById("column-"+ID_COL);
        let temp="";
        for(let i = 0;i < ligne.length;i++){
            temp += ligne[i];
        }
        col.innerHTML += temp;
    }


    function SetModif(ID_BTN){
        if(modif.indexOf(ID_BTN)==-1){
            modif.push(ID_BTN);
            console.log('yol');
        }
    }

    function MakeMenu(){

        let query = document.getElementById("query_area");
        let form = document.getElementById("query_form");

            //ajout des requettes d'ajout
        for(let i=0;i < req_add.length;i++){
            query.value += req_add[i] + "|";
        }
            //pour chaque élement qui doivent être modifier
        for(let i = 0;i < modif.length;i++){
            let input_titre = document.getElementsByName("t-"+modif[i])[0];
            let input_lien = document.getElementsByName("l-"+modif[i])[0];

            query.value += "UPDATE `headerbutton` SET `titre`='"+input_titre.value+"',`lien`='"+input_lien.value+"' WHERE `id` = '"+modif[i]+" ' " + "|";
        }
            //requette de suppressions
        for(let i=0;i < req_sup.length;i++){
            query.value += req_sup[i] + "|";
        }

        form.click();
    }


</script>