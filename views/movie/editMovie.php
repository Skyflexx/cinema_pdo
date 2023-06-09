<?php 
    ob_start();
?>

<?php

    while ($detail = $detailFilm->fetch()){

        $idFilm = $detail['id_film'];

        echo "<div class ='bg-image' style ='background-image : url(".$detail['wallpaper']."); width: auto; height: 100%; background-repeat: no-repeat; background-position: center;'>
                <div class='container p-5'> <div class ='card'><h2>".$detail['titre_film']." <a class='btn btn-outline-info btn-sm' href='index.php?action=currMovieEditing&id=".$idFilm."'>Modifier</a></h2>",             
                    "<div class='card-body'><strong>Résumé du film :</strong> ".$detail['synopsis']."</div>       
                        <div class ='card-body'><strong>Date de sortie :</strong> ".$detail['annee_sortie']."</div>
                        <div class ='card-body'><strong>Realisateur :</strong> ".$detail['prenom']." ".$detail['nom']." 
                    <a class='btn btn-outline-info btn-sm' href='index.php?action=filmographie&id=".$detail['id_realisateur']."'>Voir la filmographie</a></div>                          
                </div>";    
    }

?>