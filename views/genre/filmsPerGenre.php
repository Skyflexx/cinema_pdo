<?php 
    ob_start(); //demarre la temporisation de sortie. dans la memoire tampon.

   while($genre = $nomGenre->fetch()){ // premier fetch qui contient le genre ainsi que son id réutilisé plus bas pour la suppression.
    $nom = $genre['nom_genre'];
    $id = $genre['id_genre'];
   };
?>

<h2 class="mt-3">Liste des films du genre <span class='text-info'><?= $nom ?></span> <a class='btn btn-warning btn-sm' href='index.php?action=formEditGenre&id=<?= $id?>'>Modifier le genre</a> 

<a class='btn btn-danger btn-sm' href='index.php?action=deleteGenre&id=<?= $id?>'>Supprimer le genre</a> 

</h2>

<?php 
    echo "<div class='container p-5'>
            <div class ='row'>";

        while ($film = $listeFilmsGenre->fetch()){   // Affiches les films dans des cards pour un genre donné  
            
            $affiche = $film['affiche'];
            $titre = $film['titre_film'];
            $note = $film['note'];
            $id_film = $film['id_film'];        

            echo "<div class ='col'>
                <div class='card my-1' style='width: 15rem;'>
                    <img class='card-img-top' src='".$affiche."' alt='Card image cap'>
                        <div class='card-body'>
                            <h6 class='card-title'>".$titre."</h5>
                            <p>".$note." <img src='public//images/etoile.png'></p>                    
                            <a class='btn btn-outline-info btn-sm' href='index.php?action=detailFilm&id=".$id_film."'>En savoir plus</a>
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