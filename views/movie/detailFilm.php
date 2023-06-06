<?php 
    ob_start();
?>



<?php

    while ($detail = $detailFilm->fetch()){

        echo "<div class ='bg-image' style ='background-image : url(".$detail['wallpaper']."); width: 100%; height: 100%; background-repeat: no-repeat;'>
                <div class='container p-5'> <div class ='card'><h2>".$detail['titre_film']."</h2>",             
                    "<div class='card-body'><strong>Résumé du film :</strong> ".$detail['synopsis']."</div>       
                        <div class ='card-body'><strong>Date de sortie :</strong> ".$detail['annee_sortie']."</div>
                        <div class ='card-body'><strong>Realisateur :</strong> ".$detail['prenom']." ".$detail['nom']." 
                    <a class='btn btn-primary' href='index.php?action=filmographie&id=".$detail['id_realisateur']."'>Voir la filmographie</a></div>                          
                </div>";    
    }

echo "<div class ='row'>";

    while ($acteur = $acteursFilm->fetch()){
        echo "<div class ='col-sm-3'>
        <div class='card my-3' style='width: 10rem;'>
            <img class='card-img-top' src='".$acteur['image']."' alt='Card image cap'>
                <div class='card-body'>
                    <h6 class='card-title'>".$acteur['prenom']." ".$acteur['nom']."</h5>
                    <p>Né(e) le : ".$acteur['date_naissance']."</p>  
                    <p>Rôle : ".$acteur['nom_role']." </p>       
                </div>
            </div>
        </div>";
    }

echo "</div>";



$title = "Détail du film";
$content = ob_get_clean();
require "views/template.php";
?>

