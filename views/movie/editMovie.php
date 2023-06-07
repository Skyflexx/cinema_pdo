<?php 
    ob_start();
?>

<?php 

 while ($detail = $detailFilm->fetch()){
   

    $title = $detail['titre_film'];
    $releaseDate = $detail['annee_sortie'];
    $synopsis = $detail['synopsis'];
    $rating = $detail['note'];
    $duration = $detail['duree_film'];
    
}

?>

<h2 class="text-center text-primary"><?= $title?></h2>

<form>


        <div class="form-group my-1">
            <label for="title">Titre</label>
            <textarea class="form-control" aria-label="With textarea"><?= $title ?></textarea>
                    
        </div>

        <div class="form-group my-2">
            <label for="synopsis">Résumé</label>        
            <textarea class="form-control" aria-label="With textarea"><?= $synopsis ?></textarea>
        </div>

        <div class="form-group my-2">
            <label for="releaseDate">Date de sortie (actuelle : <?= $releaseDate ?>)</label>
            <input type="date" class="form-control" id="releaseDate" placeholder="<?= $releaseDate ?>">
        </div>

        <!-- RATING -->

        <p>Modifier la note : </p>

        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
            <label class="form-check-label" for="inlineRadio1">1</label>
        </div>
            
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
            <label class="form-check-label" for="inlineRadio2">2</label>
            
        </div>
            
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3">
            <label class="form-check-label" for="inlineRadio3">3</label>
        </div>

        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio4" value="option4">
            <label class="form-check-label" for="inlineRadio3">4</label>
        </div>

        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio5" value="option5">
            <label class="form-check-label" for="inlineRadio3">5</label>
        </div>

        <!-- // Rating -->

        <div class="form-group my-2">
            <label for="duration">Durée en minutes</label>
            <input type="text" class="form-control" id="duration" placeholder="<?= $duration ?>">
        </div>        
        
        <button type="submit" class="btn btn-primary my-3">Valider</button>
        
    </form>

<?php

   
echo "<div class ='mx-5 row'>";

    while ($acteur = $acteursFilm->fetch()){

      
        echo "<div class ='col-sm-3'><a class='text-decoration-none' href='index.php?action=actorfilmographie&id=".$acteur['id_personne']."'>
        <div class='card my-3' style='width: 10rem;'>
            <img class='card-img-top' src='".$acteur['image']."' alt='Card image cap'>
                <div class='card-body'>
                    <h6 class='card-title'>".$acteur['prenom']." ".$acteur['nom']."</h5>
                    <p>Né(e) le : ".$acteur['date_naissance']."</p>  
                    <p>Rôle : ".$acteur['nom_role']." </p>       
                </div>
            </div>
            </a></div>  ";
    }

echo "</div>";



$title = "Détail du film";
$content = ob_get_clean();
require "views/template.php";
?>

