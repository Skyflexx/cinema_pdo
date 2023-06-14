<form action = "index.php?action=addGenre" method='post'>

    <div class="form-group my-1">
        <label for="title">Nom du genre</label>
        <textarea class="form-control" aria-label="With textarea" name="genre" placeholder="Nom du genre"></textarea>                    
    </div>  

    <button type="submit" class="btn btn-primary my-3" name="addGenre">Valider</button>

</form>

<?php 
    $title = "Ajouter un Genre";
    $content = ob_get_clean();
    require "views/template.php";
?>