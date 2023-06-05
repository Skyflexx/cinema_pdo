<?php 
    ob_start(); //demarre la temporisation de sortie. dans la memoire tampon.
?>

<h2>Liste des films</h2>

<?= $films->rowCount()?>



<?php 

while ($film = $films->fetch()){ // Tant que je peux Fetch dans mon tableau de film, cad tant que je peux recuperer un resultat
   
    echo $film["id_film"];

    echo $film["titre_film"]; // si undefined array key, ça veut dire qu'on lui demande une info dont la requête SQL est fausse. sachant que le select * ne doit pas être utilisé.

?>
<a href="index.php?action=detailFilm&id=<?$film?>['id_film']">Detail film </a>
<?php
}

$title = "Liste de nos films";
$content = ob_get_clean(); // récupère et affiche le fichier puis vide la mémoire tampon
require "views/template.php";
?>