<?php 
    ob_start();
?>



<?php

    while ($detail = $detailFilm->fetch()){

        $idFilm = $detail['id_film'];

        echo "<div class ='bg-image' style ='background-image : url(".$detail['wallpaper']."); width: auto; height: 100%; background-repeat: no-repeat; background-position: center;'>
                <div class='container p-5'> <div class ='card'><h2>".$detail['titre_film']." <a class='btn btn-outline-info btn-sm' href='index.php?action=editFilm&id=".$idFilm."'>Modifier</a></h2>",             
                    "<div class='card-body'><strong>Résumé du film :</strong> ".$detail['synopsis']."</div>       
                        <div class ='card-body'><strong>Date de sortie :</strong> ".$detail['annee_sortie']."</div>
                        <div class ='card-body'><strong>Realisateur :</strong> ".$detail['prenom']." ".$detail['nom']." 
                    <a class='btn btn-outline-info btn-sm' href='index.php?action=filmographie&id=".$detail['id_realisateur']."'>Voir la filmographie</a></div>                          
                </div>";    
    }

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

echo "</div> ";





$title = "Détail du film";
$content = ob_get_clean();
require "views/template.php";
?>

