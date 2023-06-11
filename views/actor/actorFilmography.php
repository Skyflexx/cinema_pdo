<?php 
    ob_start(); //demarre la temporisation de sortie. dans la memoire tampon.
?>

<h2 class='my-4'>Filmographie</h2>

<?php 

    $nomReal = "";

    echo "<ul class='list-group mx-5 my-3'>"; // affichera une liste non ordonnée.

    while ($detail = $filmList->fetch()){ 
        
        $idPerson = $detail['id_personne']; // Variable qu'on récupère dans la requête qui sort toute la filmographie d'un acteur.
        $nomActor = $detail['prenom']." ".$detail['nom']; 
        $imgActor = $detail['image'];
        $genderActor = $detail['sexe'];
        $birthDate = $detail['date_naissance'];
        echo "<li class ='list-group-item'><a class='text-decoration-none' href='index.php?action=detailFilm&id=".$detail['id_film']."'>".$detail['titre_film']." sorti en  ".$detail['annee_sortie']." - (".$detail['nom_role'].")</a></li>";
    }

    echo "</ul>";  

    // Carte Bootstrap qui affichera la fiche de l'acteur et le bouton pour pouvoir la modifier
    echo "<div class ='col mx-auto'>
    <div class='card my-3' style='width: 10rem;'>
    <a href='index.php?action=currPersonEditing&id=".$idPerson."'> <div id='edit-btn'><i class='bi bi-gear-fill'></i></div></a>
        <img class='card-img-top' src='".$imgActor."' alt='Card image cap'>
            <div class='card-body'>
                <h6 class='card-title'>".$nomActor."</h5> 
                <p>Sexe : ".$genderActor."</p>     
                <p>Date de naissance : ".$birthDate."</p>          
            </div>
        </div>
    </div>";    

    $title = "Filmographie"; // titre de l'onglet dont la variable est dans le template
    $content = ob_get_clean(); // récupère et affiche le fichier puis vide la mémoire tampon
    require "views/template.php";
?>

