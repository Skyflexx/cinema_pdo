<?php 
    ob_start(); //demarre la temporisation de sortie. dans la memoire tampon.
?>

<h2 class='my-4'>Filmographie</h2>

<?php 

    $nomReal = "";

    echo "<ul class='list-group mx-5 my-3'>";

    while ($film = $filmList->fetch()){
        
        $nomActor = $film['prenom']." ".$film['nom']; 
        $imgActor = $film['image'];
        echo "<li class ='list-group-item'><a class='text-decoration-none' href='index.php?action=detailFilm&id=".$film['id_film']."'>".$film['titre_film']." sorti en  ".$film['annee_sortie']." - (".$film['nom_role'].")</a></li>";
        
    }

    echo "</ul>";  

    echo "<div class ='col mx-auto'>
    <div class='card my-3' style='width: 10rem;'>
        <img class='card-img-top' src='".$imgActor."' alt='Card image cap'>
            <div class='card-body'>
                <h6 class='card-title'>".$nomActor."</h5>                
            </div>
        </div>
    </div>";    

    $title = "Filmographie";
    $content = ob_get_clean(); // récupère et affiche le fichier puis vide la mémoire tampon
    require "views/template.php";
?>

