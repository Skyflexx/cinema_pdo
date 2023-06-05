<?php 
    ob_start(); //demarre la temporisation de sortie. dans la memoire tampon.
?>

<h2>Liste des films</h2>

<?php 

$title = "Liste de nos films";
$content = ob_get_clean(); // récupère et affiche le fichier puis vide la mémoire tampon
require "views/template.php";
?>