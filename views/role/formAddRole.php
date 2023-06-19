<form action = "index.php?action=addRole" method='post'>

    <div class="form-group my-1">
        <label for="title">Nom du rôle</label>
        <textarea class="form-control" aria-label="With textarea" name="nom_role" placeholder="Ajouter un nom" required></textarea>                    
    </div>  

    <button type="submit" class="btn btn-primary my-3" name="addRole">Valider</button>

</form>

<?php 
    $title = "Ajouter un role";
    $content = ob_get_clean();
    require "views/template.php";
?>