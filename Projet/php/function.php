<?php
    
    function LoadPage($nbr,$BDD){
        
            //charge le titre de la page;
        $req = 'SELECT *, count(*) as "nbr" FROM `pages` WHERE `id` = " ' .$nbr. ' " ';
        $res = mysqli_query($BDD,$req);
        $res = mysqli_fetch_array($res,MYSQLI_ASSOC);

            //si il y a pas de resultat
        if($res["nbr"] == 0){
            include("html/404.html");
            return 0;
        }
            //test si la page est réserver au utilisateur connecté
        if(($res["online"]==1)&&(!isset($_SESSION["user"]))){
            echo "<div class='container cont'><h1>";
            msg("E13");
            echo "</h1>";
            echo "<button class='webLink' onclick='document.location.href=\"index.php?p=login\"'>Se connecter</button>";
            echo "</div>";
            return 0;
        }

        echo "<title>".$res["titre"]."</title>";
        echo "<div class='container cont'>";

            //charge les conteneur
        $req = 'SELECT * FROM `page_conteneurs` WHERE `id_page` = " ' .$nbr. ' "  ORDER BY `id` ASC ';
        
        $res = mysqli_query($BDD,$req);
        
            //pour chaque conteneur
        while($conteneur =mysqli_fetch_array($res,MYSQLI_ASSOC) ){
                //charge relation conteneur-column
            $req = "SELECT * FROM `conteneur_colum` WHERE `id_conteneur` = '".$conteneur["id_conteneur"]."' ORDER BY `id` ASC";
            $res2 = mysqli_query($BDD,$req);

            echo "<div class='row'>";

                //pour chaque conteneur-column, on recupere chaque column
            while($comID = mysqli_fetch_array($res2,MYSQLI_ASSOC)){
                $req = "SELECT * FROM `colums` WHERE `id` = ' " . $comID["id_colum"] . " ' ";
                $res3 = mysqli_query($BDD,$req);
                $res3 = mysqli_fetch_array($res3,MYSQLI_ASSOC);

                $taille = $comID["taille"];

                    //en fontion du type de column
                switch($res3["type"]){
                    case "t" :  //text
                        loadText($res3["id"],$taille,$BDD);
                        break;
                    case "i" :  //image
                        loadImage($res3["id"],$taille,$BDD);
                        break;
                    case "l" :  //lien
                        loadLink($res3["id"],$taille,$BDD);
                        break;
                    case "-":
                        loadDefault($taille);
                        break;

                }

            }
            echo "</div>";
            mysqli_free_result($res2);
        }
        echo "</div>";
        mysqli_free_result($res);
    }
    
    function loadText($id,$taille,$BDD){
        $req = "SELECT T.`texte` FROM `textes` T INNER JOIN `colum_texte` ct ON T.`id` = ct.`id_text`  WHERE ct.`id_colum` = ' " . $id . " ' ";
        $resultat = mysqli_query($BDD,$req);
        $resultat = mysqli_fetch_array($resultat,MYSQLI_ASSOC);

        echo "<div class='col-md-".$taille."'><p>" . $resultat["texte"] . "</p></div>";

    }

    function loadLink($id,$taille,$BDD){
        $req = "SELECT L.`nom`, L.`lien` FROM `liens` L INNER JOIN `colum_lien` cl ON L.`id` = cl.`id_lien`  WHERE cl.`id_colum` = ' " . $id . " ' ";
        $resultat = mysqli_query($BDD,$req);
        $resultat = mysqli_fetch_array($resultat,MYSQLI_ASSOC);

        echo "<div class='col-md-".$taille."'><button class='webLink EditBtnBig' onclick='window.location.href=\"".$resultat["lien"]."\"'>".$resultat["nom"]."</button></div>";

    }

    function loadImage($id,$taille,$BDD){
        $req = "SELECT I.`nom`, I.`ext`  FROM `images` I INNER JOIN `colum_image` ci ON I.`id` = ci.`id_image`  WHERE ci.`id_colum` = ' " . $id . " ' ";
        $resultat = mysqli_query($BDD,$req);
        $resultat = mysqli_fetch_array($resultat,MYSQLI_ASSOC);

        echo "<div class='col-md-".$taille."'><img class='img' src='image/" . $resultat["nom"] . $resultat["ext"] . " ' ></div>";

    }

    function loadDefault($taille){
        echo "<div class='col-md-".$taille."'></div>";
    }

?>