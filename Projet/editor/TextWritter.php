<?php
    if(isset($_GET["text"])){
        if(isset($_POST["texte"])){
            $req = "UPDATE `textes` SET `texte`= '".$_POST["texte"]."' WHERE `id`='".$_GET["text"]."'";
            mysqli_query($BDD,$req);
        }

        $req = "SELECT * FROM `textes` WHERE `id` ='".$_GET["text"]."'";
        $text = mysqli_fetch_array(mysqli_query($BDD,$req),MYSQLI_ASSOC);
    }
?>

<link rel="stylesheet" type="text/css" href="css\editorstyle.css">
<title>Editor</title>
<?php include("editor/php/EditorHeader.php");

if((isset($_GET["text"]))&&($text != null)){
?>
<div class='EditContainer'>
    <div class="row">
        <div class="col-md-12 cont">
            <form method="post">
                <textarea name="texte" id="edit"><?php echo $text["texte"] ?></textarea>
                <input type="submit" class="webLink " value="Sauvegarder">
            </form>
        </div>
    </div>
</div>
<?php }else{
    msg("E9");
} ?>

<script>
    var CKEditor = new Object();
            //mise en place du CKeditor
    ClassicEditor
        .create( document.querySelector( '#edit' ) )
        .then( editor => {
            console.log( 'Editor was initialized', editor );
            CKEditor["edit"] = editor;
        } )
        .catch( error => {
            console.error( error );
        } );
</script>