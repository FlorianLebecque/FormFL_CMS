<?php
    if(isset($_POST["ChangeRank"])){
        $nbr = $_POST["UserRank"];
            //test si le rank sort des limites
        if(($nbr < 0)||($nbr>9)){
            $nbr = 0;
        }


        $req = "UPDATE `utilisateur` SET `rank`='".$nbr."' WHERE `utilisateur` = '".$_POST["userID"]."'";
        mysqli_query($BDD,$req);
    }

    if(isset($_POST["Deluser"])){
        $req="SELECT  `rank` FROM `utilisateur` WHERE `utilisateur` ='".$_POST["userID"]."'";
        $rank = mysqli_fetch_array(mysqli_query($BDD,$req),MYSQLI_ASSOC);
            //on verifie que l'on ne puissent pas supprimer un utilisateur supprérieur
        if($rank["rank"]<$_SESSION["rank"]){
            $req="DELETE FROM `utilisateur` WHERE `utilisateur` = '".$_POST["userID"]."'";
            mysqli_query($BDD,$req);
        }
    }

?>

<title>Gestionnaire d'utilisateurs</title>
<?php include("editor/php/EditorHeader.php") ?>
<div class="EditContainer">

    <div class="row Pageaff">
        <div class="col-md-12 webContener">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">utilisateur</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">rank (9 = admin)</th>
                    <th scope="col">Newsletter</th>
                    <th scope="col">Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $req = "SELECT `utilisateur`,`email`, `rank`, `mail` FROM `utilisateur`";
                        $res = mysqli_query($BDD,$req);
                        while($user = mysqli_fetch_array($res,MYSQLI_ASSOC)){
                            echo "<tr>";
                            echo "<td>".$user["utilisateur"]."</td>";
                            echo "<td>".$user["email"]."</td>";
                            echo '<td><form method="post">';
                            echo '<input hidden name="userID" value="'.$user["utilisateur"].'">';
                            echo '<input class="webLink EditBtn" type="number" name="UserRank"  min="0" max="9" value="'.$user["rank"].'">';
                            echo '<input class="webLink EditBtn" name="ChangeRank" type="submit" value="Valider">';
                            echo '</form></td>';
                            echo "<td>".TrueOrFalse($user["mail"])."</td>";
                            echo '<td><form method="post">';
                            echo '<input hidden name="userID" value="'.$user["utilisateur"].'">';
                            echo '<input class="webLink EditBtn" name="Deluser" type="submit" value="X">';
                            echo "</form></td>";
                            echo "</tr>";
                        }
                    
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<?php
    function TrueOrFalse($test){
        if($test == 0){
            return "Non";
        }else{
            return "Oui";
        }
    }

?>