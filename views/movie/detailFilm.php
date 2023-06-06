<?php 
    ob_start();
?>



<?php

while ($detail = $detailFilm->fetch()){

    echo "<div class ='bg-image' style = 'background-image : url(".$detail['wallpaper']."); width: 100%; height: 100vh;'>

            <div class ='card'><h2>".$detail['titre_film']."</h2>",
             
             "<div class='card-body'>".$detail['synopsis'].
             
        "</div></div></div>";

    
}


$title = "Détail du film";
$content = ob_get_clean();
require "views/template.php";
?>

