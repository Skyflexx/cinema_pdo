<?php 
    ob_start();
?>

<?php 

 while ($detail = $detailFilm->fetch()){ // récupération de toutes les données du film pour l'afficher.
   

    $title = $detail['titre_film'];
    $releaseDate = $detail['annee_sortie'];
    $synopsis = $detail['synopsis'];
    $rating = $detail['note'];
    $duration = $detail['duree_film'];
    $id = $detail['id_film']; // sera récupéré puis mis dans un input pour l'envoyer dans un POST.
    
}

?>

<h2 class="text-center text-primary"><?= $title?></h2>

<form action = 'index.php' method='post'>
        <div class="form-group my-1">
            <label for="title">Titre</label>
            <textarea class="form-control" aria-label="With textarea" name="title"><?= $title ?></textarea>
                    
        </div>

        <div class="form-group my-2">
            <label for="synopsis">Résumé</label>        
            <textarea class="form-control" aria-label="With textarea" name="synopsis"><?= $synopsis ?></textarea> 
        </div>

        <div class="form-group my-2">
            <label for="releaseDate">Date de sortie</label>
            <input type="date" class="form-control" name="releaseDate" value=<?= $releaseDate ?>>
        </div>

        <!-- RATING -->

        <p>Modifier la note : </p>

        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="rating" value="1">
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
            <input type="text" class="form-control" id="duration" name="duration" value="<?= $duration ?>">
        </div>   
        
        <input type="hidden" name="id" value="<?= $id ?>"> <!-- stockage dans $post de l'id du film par le biais d'un input hidden -->        
        
        <button type="submit" class="btn btn-primary my-3" name="editMovie" >Valider</button>

    </form>

<?php

   
echo "<div class ='mx-5 row'>";

    while ($acteur = $acteursFilm->fetch()){ // Affichage de tous les acteurs pour pouvoir les delete ou les modif par la suite/

      
        echo "<div class ='col-sm-3'><a class='text-decoration-none' href='index.php?action=actorfilmographie&id=".$acteur['id_personne']."'>
        <div class='card my-3' style='width: 10rem;'>
            <img class='card-img-top' src='".$acteur['image']."' alt='Card image cap'>
                <div class='card-body'>
                    <h6 class='card-title'>".$acteur['prenom']." ".$acteur['nom']."</h5>
                    <p>Né(e) le : ".$acteur['date_naissance']."</p>  
                    <p>Rôle : ".$acteur['nom_role']." </p>       
                </div>
            </div>
            </a></div>";
    }

echo "</div>";



$title = "Détail du film";
$content = ob_get_clean();
require "views/template.php";
?>

