<div class="headPage">
    
    <div class="d-xl-none headEditContent">
        <h1 class="title" id="headtitre"><a class="link" href="index.php?p=1"><?php echo $props["title"] ?></a></h1>
        <div class="headEditContent justify-content-end ">
            <button class="headerBtn fixedHeigthHeader BtnHam " onclick="Show()" id="btnMenu" ><div class='test'></div><div class='test2'></div><div class='test'></div><div class='test2'></div><div class='test'></div></button>
        </div>
    </div>

    <div class="container headEditContent d-none d-xl-flex rowHeader">
        <h1 class="title"><a class="link" href="index.php?p=1"><?php echo $props["title"] ?></a></h1>
        <div class="justify-content-end headEditContent ">
            <?php
                loadHeader($BDD,2);
            ?>
            
        </div>
    </div>
    
</div>

<div class="col-md-12 d-xl-none" id="HamMenu" style="visibility: hidden; height: 0px;">
    <?php loadHeader($BDD,12); ?>
</div>

<script>
    let Menu = document.getElementById("HamMenu");

    function Show(){
        if(Menu.style.visibility == "hidden"){
            Menu.style.visibility = "visible";
            Menu.style.height="100%";
        }else{
            Menu.style.visibility = "hidden";
            Menu.style.height="0px";
        }
        
    }

</script>

<script>

    btn= document.getElementById("btnMenu");

</script>


<?php

    function loadHeader($BDD,$taille){
        for($i = 1;$i < 7 ; $i++){
            $req = "SELECT * FROM `headerbutton` WHERE `emplacement` = '".$i."'";   //récupération de chaque élement dans la column spécifier
            $res = mysqli_query($BDD,$req);

            if(mysqli_num_rows($res)==1){   //si un seul button dans la column
                echo "<div class='col-md-".$taille." fixedHeigthHeader'>";

                $btn = mysqli_fetch_array($res,MYSQLI_ASSOC);

                echo "<button class='headerBtn fixedHeigthHeader' onclick='window.location.href=\"".$btn["lien"]."\"'>".$btn["titre"]."</button>";

            }else if(mysqli_num_rows($res)>1){
                echo "<div class='dropdown col-md-".$taille." fixedHeigthHeader'>";
                
                $first = true;
                while($btn = mysqli_fetch_array($res,MYSQLI_ASSOC)){
                    if($first){
                        echo "<button class='headerBtn dropdown-toggle fixedHeigthHeader' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'>".$btn["titre"]."</button>";
                        echo '<div class="dropdown-menu dropMenuHeader" aria-labelledby="dropdownMenuButton">';
                        $first = false;
                    }else{
                        echo "<button class='headerBtn fixedHeigthHeader' onclick='window.location.href=\"".$btn["lien"]."\"'>".$btn["titre"]."</button>";
                    }
                }
                echo "</div>";
                

            }else{
                echo "<div class='col-md-".$taille."'>";
            }
            mysqli_free_result($res);
            echo "</div>";
        }
    }

?>