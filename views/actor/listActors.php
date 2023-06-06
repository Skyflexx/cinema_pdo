<?php 
    ob_start(); //demarre la temporisation de sortie. dans la memoire tampon.
?>

<h2>Liste des Acteurs</h2>

<?= $actors->rowCount(); ?>

<?php 

while ($actor = $actors->fetch()){

    echo $actor["prenom"];
    echo $actor["nom"];   

}

$title = "Liste de nos acteurs";
$content = ob_get_clean(); // récupère et affiche le fichier puis vide la mémoire tampon
require "views/template.php";
?>