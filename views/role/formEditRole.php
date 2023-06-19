<form action = "index.php?action=editRole" method='post'>

<!-- Fetch -->

<?php 

while ($role = $currentRole->fetch()){ // récupération des informations du Genre déjà enregistré en BDD pour faciliter la modification.
    $id_role = $role['id_role'];
    $nom_role = $role ['nom_role'];
}

?>

    <div class="form-group my-1">
        <label for="title" class="mb-3">Edition du rôle</label>
        <textarea class="form-control" aria-label="With textarea" name="nom_role" required><?= $nom_role ?></textarea>                    
    </div>  

    <input type="hidden" name="id_role" value="<?= $id_role ?>"> <!-- stockage dans $post de l'id du genre par le biais d'un input hidden -->   

    <button type="submit" href='index.php?action=editRole' class="btn btn-primary my-3" name="EditRole">Valider</button>

</form>

<?php 
    $title = "Modifier un rôle";
    $content = ob_get_clean();
    require "views/template.php";
?>