<?php 
    ob_start(); //demarre la temporisation de sortie. dans la memoire tampon.
    $showResult = "";

    while ($actor = $actorsListPerRole->fetch()){ 
        
        $idPerson = $actor['id_personne']; // Variable qu'on récupère dans la requête qui sort toute la filmographie d'un acteur.
        $nomActor = $actor['prenom']." ".$actor['nom'];  
        $titre_film = $actor['titre_film']; // Pour un rôle on sort le casting et donc la liste des films de ce rôle.
        $annee_sortie = $actor['annee_sortie'];

        $showResult .= "<li class ='list-group-item'><a class='text-decoration-none' href='index.php?action=actorfilmographie&id=".$idPerson."'>$nomActor - ($titre_film - $annee_sortie)</a></li>";
        $id_role = $actor['id_role']; // on récupère l'id role pour les boutons delete et modifier.
    }

  
?>

<h2 class='my-4'>Acteur(s) ayant(s) interprêté ce rôle <a class='btn btn-warning btn-sm' href='index.php?action=formEditRole&id=<?= $id_role?>'>Modifier le rôle</a> 

<a class='btn btn-danger btn-sm' href='index.php?action=deleteRole&id=<?= $id_role?>'>Supprimer le rôle</a> </h2>

<?php     

    echo "<ul class='list-group mx-5 my-3'>"; // affichera une liste non ordonnée.

    echo $showResult; // affichage du contenu du fetch par le biais de cette variable.

    echo "</ul>";  

    $title = "Acteurs dans ce rôle"; // titre de l'onglet dont la variable est dans le template
    $content = ob_get_clean(); // récupère et affiche le fichier puis vide la mémoire tampon
    require "views/template.php";
?>

