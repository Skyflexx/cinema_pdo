<?php 
    ob_start(); //demarre la temporisation de sortie. dans la memoire tampon.
?>

<h2 class='my-4'>Filmographie</h2>

<?php     
    echo "<ul class='list-group mx-5 my-3'>";

    while ($film = $filmList->fetch()){ // Récupération des infos de chaque film pour l'affichage en liste. On récup également le nom du real et son affiche pour la carte plus bas.       
        $nomReal = $film['prenom']." ".$film['nom']; 
        $imgReal = $film['image'];
        echo "<li class ='list-group-item'><a class='text-decoration-none' href='index.php?action=detailFilm&id=".
        $film['id_film']."'> ".$film['titre_film']." sorti en  ".$film['annee_sortie']."</a></li>";
    }

    echo "</ul>";

    // Carte Bootstrap pour l'affiche du réalisateur
    echo "<div class ='col mx-auto'>
    <div class='card my-3' style='width: 10rem;'>
        <img class='card-img-top' src='".$imgReal."' alt='Card image cap'>
            <div class='card-body'>
                <h6 class='card-title'>".$nomReal."</h5>                
            </div>
        </div>
    </div>";    

    $title = "Filmographie";
    $content = ob_get_clean(); // récupère et affiche le fichier puis vide la mémoire tampon
    require "views/template.php";
?>