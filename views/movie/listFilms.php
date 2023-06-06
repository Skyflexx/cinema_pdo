<?php 
    ob_start(); //demarre la temporisation de sortie. dans la memoire tampon.
?>

<h2>Liste des films</h2>

<!-- <?= $films->rowCount()?> par une fonction native de php on peut compter le nombre de lignes -->



<?php 

echo "<div class='container-fluid'>";

while ($film = $films->fetch()){ // Tant que je peux Fetch dans mon tableau de film, cad tant que je peux recuperer un resultat

   
    // echo $film["id_film"];

    // echo $film["titre_film"]; // si undefined array key, ça veut dire qu'on lui demande une info dont la requête SQL est fausse. sachant que le select * ne doit pas être utilisé.


    echo "<div class='card' style='width: 18rem;'>
        <img class='card-img-top' src='".$film['affiche']."' alt='Card image cap'>
        <div class='card-body'>
        <h5 class='card-title'>".$film['titre_film']."</h5>

        <a class='btn btn-primary' href='index.php?action=detailFilm&id=".$film['id_film']."'>Detail film </a>

        
       
        </div>
        
        "

?>

<!-- <a href="index.php?action=detailFilm&id=<?$film?>['id_film']">Detail film </a> -->

<?php
}
echo "</div>";

$title = "Liste de nos films";
$content = ob_get_clean(); // récupère et affiche le fichier puis vide la mémoire tampon
require "views/template.php";
?>