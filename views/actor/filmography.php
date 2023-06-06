<?php 
    ob_start(); //demarre la temporisation de sortie. dans la memoire tampon.
?>

<h2>Liste des Films de ce réalisateur</h2>


<?php 

    $nomReal = "";

    echo "<ul class='list-group'>";

    while ($film = $filmList->fetch()){

        
        $nomReal = $film['prenom']." ".$film['nom']; 
        $imgReal = $film['image'];

    echo "<li class ='list-group-item'>".$film['titre_film']." sorti en  ".$film['annee_sortie']."</li>";
        
    }

    echo "</ul>";

    echo "<div class ='col-sm-3'>
    <div class='card my-3' style='width: 10rem;'>
        <img class='card-img-top' src='".$imgReal."' alt='Card image cap'>
            <div class='card-body'>
                <h6 class='card-title'>".$nomReal."</h5>                
            </div>
        </div>
    </div>";

    echo $nomReal;

    $title = "Filmographie";
    $content = ob_get_clean(); // récupère et affiche le fichier puis vide la mémoire tampon
    require "views/template.php";
?>