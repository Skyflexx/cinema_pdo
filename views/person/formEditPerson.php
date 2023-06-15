<?php 
    ob_start();
?>

<?php 

    $isCheckF = ""; // Déclartion de ces deux variables qui permettront de pré cocher un btn radio en fct du sexe dans la BDD. Voir après le while.
    $isCheckM = "";

    while ($person = $detailsPerson->fetch()){ // récupération de toutes les données du film pour l'afficher.   
        $prenom = $person['prenom'];
        $nom = $person['nom'];
        $birthDate = $person['date_naissance'];
        $gender = $person['sexe'];
        $id_person = $person['id_personne'];      
    }

    switch($gender){
        case 'F' : $isCheckF = "checked"; break;
        case 'M' : $isCheckM = "checked"; break;
    }
       // Ce petit bout de code permet de rajouter le mot "checked" à la balise de la radio pour cocher le sexe déjà présent dans la BDD.
?>

<h2 class="text-center text-primary"><?=$prenom." ".$nom?></h2>

<form action = 'index.php?action=editPerson' method='post'>

    <div class="form-group my-1">
        <label for="title">Nom</label>
        <textarea class="form-control" aria-label="With textarea" name="nom" required><?= $nom ?></textarea>                    
    </div>

    <div class="form-group my-1">
        <label for="title">Prenom</label>
        <textarea class="form-control" aria-label="With textarea" name="prenom" required><?= $prenom ?></textarea>                    
    </div>        

    <div class="form-group my-2">
        <label for="releaseDate">Date de naissance</label>
        <input type="date" class="form-control" name="birthDate" value=<?= $birthDate ?> required>
    </div>

    <p>Modifier le sexe : </p>

    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="gender" value="F" <?= $isCheckF ?>>
        <label class="form-check-label" for="inlineRadio1">Feminin</label>
    </div>
        
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="gender" value="M" <?= $isCheckM ?>>
        <label class="form-check-label" for="inlineRadio2">Masculin</label>            
    </div>
    
    <input type="hidden" name="id" value="<?= $id_person ?>"> <!-- stockage dans $post de l'id de la personne par le biais d'un input hidden -->      
            
    <button type="submit" class="btn btn-primary my-3" name="editPerson">Valider</button>

</form>

<?php
    $title = "Détail du film";
    $content = ob_get_clean();
    require "views/template.php";
?>

