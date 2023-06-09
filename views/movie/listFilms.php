<?php 
    ob_start(); //demarre la temporisation de sortie. dans la memoire tampon.
?>

<h2 class='mt-3'>Liste des films</h2>

<!-- <?= $films->rowCount()?> par une fonction native de php on peut compter le nombre de lignes -->

<?php 

    echo "<div class='container p-5'>
            <div class ='row'>";

    while ($film = $films->fetch()){ // Tant que je peux Fetch dans mon tableau de film, cad tant que je peux recuperer un resultat

        // echo $film["titre_film"]; // si undefined array key, ça veut dire qu'on lui demande une info dont la requête SQL est fausse. sachant que le select * ne doit pas être utilisé.

        echo "<div class ='col'>
            <div class='card my-1' style='width: 15rem;'>        
                <img class='card-img-top' src='".$film['affiche']."' alt='Card image cap'>                
                    <div class='card-body'>
                        <h6 class='card-title'>".$film['titre_film']."</h5>
                        <p>".$film['note']." <img src='public//images/etoile.png'></p>                    
                        <a class='btn btn-outline-info btn-sm' href='index.php?action=detailFilm&id=".$film['id_film']."'>En savoir plus</a>
                        <a href='index.php?action=currMovieEditing&id=".$film['id_film']."'> <div id='edit-btn'><i class='bi bi-gear-fill'></i></div></a>                   
                    </div>
                </div>
            </div>";  
    }
?>

<?php
    echo "</div>
            </div>";

    $title = "Liste de nos films";
    $content = ob_get_clean(); // récupère et affiche le fichier puis vide la mémoire tampon
    require "views/template.php";
?>