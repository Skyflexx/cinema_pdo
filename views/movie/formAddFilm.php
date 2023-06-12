<?php 
    ob_start();
?>

<!-- Différents formulaires en méthode post pour les formulaires de création d'un film -->

<form action = 'index.php' method='post'>
    <div class="form-group my-1">
        <label for="title">Titre</label>
        <textarea class="form-control" aria-label="With textarea" name="title">Titre</textarea>                    
    </div>

    <div class="form-group my-2">
        <label for="synopsis">Résumé</label>        
        <textarea class="form-control" aria-label="With textarea" name="synopsis">Synopsis</textarea> 
    </div>

    <div class="form-group my-2">
        <label for="releaseDate">Date de sortie</label>
        <input type="date" class="form-control" name="releaseDate" value='date'>
    </div>

    <select class="form-select" aria-label="Default select example"> <!-- selection des réalisateurs -->

    <option selected>Realisateur</option>

    <?php while ($realisateur = $realisators->fetch()){ // Utilisatuion d'un fetch pour que les real soient dans la liste

        echo "<option> value = ".$realisateur['prenom']."".$realisateur['nom']."</option>";

    }
    ?>
   
    </select>

    <!-- RATING -->

    <p>Noter le film : </p>

    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="rating" value="1" checked>
        <label class="form-check-label" for="inlineRadio1">1</label>
    </div>
        
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="rating" value="2">
        <label class="form-check-label" for="inlineRadio2">2</label>            
    </div>
        
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="rating" value="3">
        <label class="form-check-label" for="inlineRadio3">3</label>
    </div>

    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="rating" value="4">
        <label class="form-check-label" for="inlineRadio3">4</label>
    </div>

    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="rating" value="5">
        <label class="form-check-label" for="inlineRadio3">5</label>
    </div>

    <!-- // Rating -->

    <div class="form-group my-2">
        <label for="duration">Durée en minutes</label>
        <input type="text" class="form-control" id="duration" name="duration" value="durée en minutes">
    </div>      
           
    <button type="submit" class="btn btn-primary my-3" name="addMovie">Valider</button>

    </form>