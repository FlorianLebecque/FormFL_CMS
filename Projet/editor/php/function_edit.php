<?php
        //formulaire d'editon column text
    include("editor/php/TextEditor.php");
        //formulaire d'edition image
    include("editor/php/ImageEditor.php");
        //formulaire d'edition de liens
    include("editor/php/LinkEditor.php");
        //modification du contenu
    include("editor/php/conteneur.php");
    include("editor/php/column.php");

        
    if(!isset($_POST["col_type"])){
        $_POST["col_type"]= "t";
    }

        //charge le titre de la page;
    $req = 'SELECT *, count(*) as "nbr" FROM `pages` WHERE `id` = " ' .$nbr. ' " ';
    $res = mysqli_query($BDD,$req);
    $res = mysqli_fetch_array($res,MYSQLI_ASSOC);

    echo "<title>Editor : ".$res["titre"]."</title>";

        //charge les conteneur
    $req = "SELECT C.`titre`,C.`id`, cp.`id` as 'link' FROM `conteneurs` C INNER JOIN `page_conteneurs` cp ON C.`id` = cp.`id_conteneur`  WHERE cp.`id_page` = '".$nbr."' ORDER BY cp.`id` ASC";
    $res = mysqli_query($BDD,$req);

        //pour chaque conteneur
    while($conteneur =mysqli_fetch_array($res,MYSQLI_ASSOC) ){
            //debut du container + formulaire de modification
        include("editor/php/FormConteneur.php");

            //charge relation conteneur-column
        $req = "SELECT * FROM `conteneur_colum` WHERE `id_conteneur` = '".$conteneur["id"]."' ORDER BY `id` ASC";
        $res_colCont = mysqli_query($BDD,$req);

        echo "<div class='row'>";

            //pour chaque conteneur-column, on recupere chaque column
        $colrnd = $rnd;
        while($comID = mysqli_fetch_array($res_colCont,MYSQLI_ASSOC)){
                //column
            $req = "SELECT * FROM `colums` WHERE `id` = ' " . $comID["id_colum"] . " ' ";
            $res_col = mysqli_query($BDD,$req);
            $res_col = mysqli_fetch_array($res_col,MYSQLI_ASSOC);

            $taille = $comID["taille"];

            echo "  <div class='col-md-".$taille." cont_edit'>";
            $colrnd ++;
                //en fontion du type de column
            switch($res_col["type"]){
                case "t" :  //text
                    loadText_edit($res_col["id"],$BDD);
                    break;
                case "i" :  //image
                    loadImage_edit($res_col["id"],$BDD);
                    break;
                case "l" :  //lien
                    loadLink_edit($res_col["id"],$BDD);
                    break;
                case "-":
                    loadDefault_edit($res_col["id"]);
                    break;
                default:
                    exit;

            }
            echo "</div>";
            
        }
        echo "</div>";
        echo "</div>";//fin du container
        
        mysqli_free_result($res_colCont);
    }

    mysqli_free_result($res);


    function IsSelected($val){
        if((isset($_POST["col_type"]))&&($_POST["col_type"]==$val)){
            echo "SELECTED";
        }
    }

    function SetTaille($val1,$val2){
        if($val1==$val2){
            return "SELECTED";
        }
    }

    function GetTitle($id,$BDD){
        $req = "SELECT `titre` FROM `colums` WHERE  `id`= '".$id."'";
        $titre = mysqli_fetch_array(mysqli_query($BDD,$req),MYSQLI_ASSOC);
        return $titre["titre"];
    }

    function loadDefault_edit($id){
        $htrnd = rand();
        echo "<div class='row' id='col_".$htrnd."'>";
        echo "<button class=\"webLink EditBtnVBig \" onclick=\"add_text('".$htrnd."','".$id."')\" >Ajouter un text</button>";
        echo "<button class=\"webLink EditBtnVBig \" onclick=\"add_image('".$htrnd."','".$id."')\" >Ajouter une image</button>";
        echo "<button class=\"webLink EditBtnVBig \" onclick=\"add_lien('".$htrnd."','".$id."')\" >Ajouter un lien</button>";
        echo "</div>";
    }

?>