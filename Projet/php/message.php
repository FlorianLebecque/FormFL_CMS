<?php

    function msg($code){
        $type = substr($code,0,1);
        $msg_code = substr($code,1);

        if($type=="M"){
            echo "<p class='good'>".Show_msg($msg_code)."</p>";
        }else if($type=="E"){
            echo "<p class='error'>".Show_error($msg_code)."</p>";
        }

    }

    function Show_error($msg_code){
        $msg = "";
        switch($msg_code){
            case 1: $msg = "Mot de passe erroné";
                break;
            case 2: $msg = "Les deux mots de passe ne corresponde pas";
                break;
            case 3: $msg = "Mot de passe non comforme";
                break;
            case 4: $msg = "L'e-mail est invalide";
                break;
            case 5: $msg = "Le mot de passe ou l'utilisateur est erroné";
                break;
            case 6: $msg = "E-mail déjà utilisé";
                break;
            case 7: $msg = "Le champ pseudo ne peut pas être vide";
                break;
            case 8: $msg = "Le pseudo est déjà utilisé";
                break;
            case 9: $msg = "Le texte est introuvable dans la base de données";
                break;
            case 10: $msg = "Extension non supportée";
                break;
            case 11: $msg = "Erreur avec l'image";
                break;
            case 12: $msg = "Il faut au moins une image d'uploader sur le site";
                break;
            case 13: $msg = "La page est réserver aux utilisateurs connectés";
                break;
        }
        return $msg;
    }

    function Show_msg($msg_code){
        $msg = "";
        switch($msg_code){
            case 1: $msg = "Mot de passe mis à jour";
                break;
            case 2: $msg = "Titre mis à jour";
                break;
            case 3: $msg = "Page supprimer";
                break;
        }
        return $msg;
    }

?>