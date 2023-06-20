<?php 
    ob_start(); //demarre la temporisation de sortie. dans la memoire tampon.
?>

<h2>Liste des Acteurs</h2>

<?php 
    echo "<ul class='list-group mx-5 my-3'>";

    while ($actor = $actors->fetch()){    // Affiche l'acteur dans une liste non ordonnée

        echo "<li class ='list-group-item'><a class='text-decoration-none' href='index.php?action=actorfilmographie&id=".$actor['id_personne']."'>".$actor['prenom']." ".$actor['nom']."</a></li>";
    }

    echo "</ul>";  

    $title = "Liste des acteurs";
    $content = ob_get_clean(); // récupère et affiche le contenu préchargé puis vide la mémoire tampon
    require "views/template.php";
?>