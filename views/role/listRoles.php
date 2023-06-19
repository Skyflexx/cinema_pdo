<?php 
    ob_start(); //demarre la temporisation de sortie. dans la memoire tampon.
?>

<h2>Liste de tous les rôles <a class='btn btn-outline-info btn-sm' href='index.php?action=btnAddRole'>Ajouter un rôle</a> </h2>

<?php 
    while ($role = $roles->fetch()){ // Affichera une liste non ordonnée des genres qui seront cliquables   

        echo "<li class ='list-group-item'><a class='text-decoration-none' href='index.php?action=actorsPerRole&id=".$role['id_role']."'>".$role['nom_role']."</a></li>";
    }

    $title = "Rôles enregistrés";
    $content = ob_get_clean(); // récupère et affiche le fichier puis vide la mémoire tampon
    require "views/template.php";
?>