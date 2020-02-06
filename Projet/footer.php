<div class="container">
    <div class="row">
        <div class="col-md-2">
            <div class="row">
                <?php
                    if(isset($_SESSION["rank"])){   //lien pour l'éditeur si connecter avec un rank 9
                        if($_SESSION["rank"]==9){
                ?>
                            <button class="webLink" onclick="document.location.href='index.php?p=editor'">Editeur</button>
                <?php
                        }
                    }
                ?>
            </div>
        </div>
        <div class="col-md-10">
            <div class="row justify-content-end">
                <?php
                    if(!isset($_SESSION["user"])){ // si non connecter
                ?>
                    <button class="webLink col-md-2" onclick="document.location.href='index.php?p=login'">Connexion</button>
                    <button class="webLink col-md-2" onclick="document.location.href='index.php?p=inscription'">Inscription</button>

                <?php
                    }else{ //si connecter
                ?>      
                    <button class="webLink col-md-2" onclick="document.location.href='index.php?p=user'"><?php echo $_SESSION["user"]; ?></button>
                    <button class="webLink col-md-2" onclick="document.location.href='index.php?c=deconnection'">Déconnection</button>
                <?php
                    }
                ?>
            </div>
        </div>
    </div>
</div>