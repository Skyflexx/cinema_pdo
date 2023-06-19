<form action = "index.php?action=editGenre" method='post'>

<!-- Fetch -->

<?php 

while ($genre = $currentGenre->fetch()){ // récupération des informations du Genre déjà enregistré en BDD pour faciliter la modification.
    $id_genre = $genre['id_genre'];
    $nom_genre = $genre ['nom_genre'];
}

?>

    <div class="form-group my-1">
        <label for="title" class="mb-3">Renommer le genre</label>
        <textarea class="form-control" aria-label="With textarea" name="nom_genre" required><?= $nom_genre ?></textarea>                    
    </div>  

    <input type="hidden" name="id_genre" value="<?= $id_genre ?>"> <!-- stockage dans $post de l'id du genre par le biais d'un input hidden -->   

    <button type="submit" href='index.php?action=editGenre' class="btn btn-primary my-3" name="EditGenre">Valider</button>

</form>

<?php 
    $title = "Modifier un Genre";
    $content = ob_get_clean();
    require "views/template.php";
?>