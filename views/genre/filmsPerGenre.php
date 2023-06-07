<?php 
    ob_start(); //demarre la temporisation de sortie. dans la memoire tampon.
?>

<h2>Liste des films du genre</h2>



<?php 

echo "<div class='container p-5'>
        <div class ='row'>";

while ($film = $listeFilmsGenre->fetch()){       

    echo "<div class ='col'>
        <div class='card my-1' style='width: 15rem;'>
            <img class='card-img-top' src='".$film['affiche']."' alt='Card image cap'>
                <div class='card-body'>
                    <h6 class='card-title'>".$film['titre_film']."</h5>
                    <p>".$film['note']." <img src='public//images/etoile.png'></p>                    
                    <a class='btn btn-outline-info btn-sm' href='index.php?action=detailFilm&id=".$film['id_film']."'>En savoir plus</a>
                </div>
            </div>
        </div>";
    
}

echo "</div>
        </div>";

$title = "Films de ce genre";
$content = ob_get_clean(); // récupère et affiche le fichier puis vide la mémoire tampon
require "views/template.php";
?>