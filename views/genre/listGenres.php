<?php 
    ob_start(); //demarre la temporisation de sortie. dans la memoire tampon.
?>

<h2>Les genres de films</h2>



<?php 



while ($genre = $genres->fetch()){    

    echo "<li class ='list-group-item'><a class='text-decoration-none' href='index.php?action=filmsPerGenre&id=".$genre['id_genre']."'>".$genre['nom_genre']."</a></li>";

}

$title = "Nos genres de films";
$content = ob_get_clean(); // récupère et affiche le fichier puis vide la mémoire tampon
require "views/template.php";
?>