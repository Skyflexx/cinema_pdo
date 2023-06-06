<?php 
    ob_start();
?>



<?php

while ($detail = $detailFilm->fetch()){

    echo "<div class ='bg-image' style = 'background-image : url(".$detail['wallpaper']."); width: 100%; height: 100vh;'>
            <div class='container p-5'> <div class ='card'><h2>".$detail['titre_film']."</h2>",             
                "<div class='card-body'>".$detail['synopsis']."</div>       
                <div class ='card-body'>Date de sortie : ".$detail['annee_sortie']."</div>
                <div class ='card-body'>Realisateur : ".$detail['prenom']." ".$detail['nom']." </div>                          
             </div>";

    
}


$title = "Détail du film";
$content = ob_get_clean();
require "views/template.php";
?>

