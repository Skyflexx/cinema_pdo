<?php 
    ob_start(); //demarre la temporisation de sortie. dans la memoire tampon.
?>

<h2>Les genres de films</h2>

<?= $genres->rowCount(); ?>

<?php 

while ($genre = $genres->fetch()){
    echo $genre["id_genre"];
    echo $genre ["nom_genre"];
}

$title = "Nos genres de films";
$content = ob_get_clean(); // récupère et affiche le fichier puis vide la mémoire tampon
require "views/template.php";
?>