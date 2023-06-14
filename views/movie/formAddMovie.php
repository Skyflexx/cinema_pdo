<?php 
    ob_start();
?>

<!-- Différents formulaires en méthode post pour les formulaires de création d'un film -->

<!-- Tout est en required comme ça pas de risque d'erreur dans la bdd-->

<form action = "index.php?action=addMovie" method='post'>
    <div class="form-group my-1">
        <label for="title">Titre</label>
        <textarea class="form-control" aria-label="With textarea" name="title" placeholder="Titre du film" required></textarea>                    
    </div>

    <div class="form-group my-2">
        <label for="synopsis">Résumé</label>        
        <textarea class="form-control" aria-label="With textarea" name="synopsis" placeholder="Résumé du film" required></textarea> 
    </div>

    <div class="form-group my-2 mb-3">
        <label for="releaseDate">Date de sortie</label>
        <input type="date" class="form-control" name="releaseDate" value='date' required>
    </div>


    <label for="id_realisateur">Choix du realisateur</label>
    <select class="form-select mb-3" name = id_realisateur aria-label="Default select example" required> <!-- selection des réalisateurs -->

        <option selected value="">Realisateur</option> <!-- au dessus, required indique qu'il faut une option avec une value non nulle (ici elle est nulle donc non prise en compte) -->

        <?php while ($realisateur = $realisators->fetch()){ // Utilisatuion d'un fetch pour que les real soient dans la liste
        echo "<option value = ".$realisateur['id_realisateur'].">".$realisateur['prenom']." ".$realisateur['nom']."</option>"; // La value récup l'id real.
            }
        ?>
   
    </select>

    <label for="id_genre">Choix du genre</label>
    <select class="form-select" name = "id_genre[]" multiple aria-label="Default select example" required> <!-- selection des réalisateurs -->

            <?php while ($genre = $genres->fetch()){ // Utilisation d'un fetch pour que les real soient dans la liste

            echo "<option value =".$genre['id_genre'].">".$genre['nom_genre']."</option>"; // La value permet de récupérer l'ID du genre.

            // $id_genre = $genre['id_genre'];
            }        
        ?>
    </select>

   

    <!-- RATING -->

    <p>Noter le film : </p>

    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="rating" value="1">
        <label class="form-check-label" for="inlineRadio1">1</label>
    </div>
        
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="rating" value="2">
        <label class="form-check-label" for="inlineRadio2">2</label>            
    </div>
        
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="rating" value="3" checked>
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
        <input type="text" class="form-control" id="duration" name="duration" placeholder="Durée en minutes" required>
    </div>      
           
    <button type="submit" class="btn btn-primary my-3" name="addMovie">Valider</button>

    </form>
    
<?php 
    $title = "Ajouter un film";
    $content = ob_get_clean();
    require "views/template.php";
?>