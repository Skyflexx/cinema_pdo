<?php 
    ob_start();
?>

<?php 

    while ($detail = $detailFilm->fetch()){ // récupération de toutes les données du film qu'on stocke dans des variables pour les utiliser plus bas
    
        $title = $detail['titre_film'];
        $releaseDate = $detail['annee_sortie'];
        $synopsis = $detail['synopsis'];
        $rating = $detail['note'];
        $duration = $detail['duree_film'];
        $id = $detail['id_film']; // sera récupéré puis mis dans un input pour l'envoyer dans un POST.        
    }

    // Les lignes de codes ci-dessous permettent de rajouter le mot "checked" à la balise radio pour pré-cocher la bonne en fct du contenu de la BDD

    $checkRating1 = ""; // Vide par défaut car la variable est dans la balise html. 
    $checkRating2 = "";
    $checkRating3 = "";
    $checkRating4 = "";
    $checkRating5 = "";

    switch ($rating) {
        case 1: $checkRating1 = "checked"; break; // Via le fetch, $rating = $detail['note']; je récupère la note. Par exemple 1. Dans le cas où la note est 1 on remplit la variable $checkrating1 avec checked.
        case 2: $checkRating2 = "checked"; break;
        case 3 : $checkRating3 = "checked"; break;
        case 4 : $checkRating4 = "checked"; break;
        case 5 : $checkRating5 = "checked"; break;
    }

?>

<h2 class="text-center text-primary"><?= $title?> <a class='btn btn-danger btn-sm' href='index.php?action=deleteMovie&id=<?= $id?>'>Supprimer</a> </h2>

<!-- On ajoute un btn delete. En action on appelera la fct deleteMovie avec en paramètres l'id du film-->

<!-- Différents formulaires en méthode post pour la modif d'un film -->

<form action = 'index.php?action=editMovie' method='post'> 
    <div class="form-group my-1">
        <label for="title">Titre</label>
        <textarea class="form-control" aria-label="With textarea" name="title" required><?= $title ?></textarea>                    
    </div>

    <div class="form-group my-2">
        <label for="synopsis">Résumé</label>        
        <textarea class="form-control" aria-label="With textarea" name="synopsis" required><?= $synopsis ?></textarea> 
    </div>

    <div class="form-group my-2">
        <label for="releaseDate">Date de sortie</label>
        <input type="date" class="form-control" name="releaseDate" value=<?= $releaseDate ?> required>
    </div>

    <!-- RATING -->

    <p>Modifier la note : </p>

    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="rating" value="1" <?=$checkRating1?>>
        <label class="form-check-label" for="inlineRadio1">1</label>
    </div>
        
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="rating" value="2" <?=$checkRating2?>>
        <label class="form-check-label" for="inlineRadio2">2</label>            
    </div>
        
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="rating" value="3" <?=$checkRating3?>>
        <label class="form-check-label" for="inlineRadio3">3</label>
    </div>

    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="rating" value="4" <?=$checkRating4?>>
        <label class="form-check-label" for="inlineRadio3">4</label>
    </div>

    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="rating" value="5" <?=$checkRating5?>>
        <label class="form-check-label" for="inlineRadio3">5</label>
    </div>

    <!-- // Rating -->

    <div class="form-group my-2">
        <label for="duration">Durée en minutes</label>
        <input type="text" class="form-control" id="duration" name="duration" value="<?= $duration ?>" required>
    </div>   
    
    <input type="hidden" name="id" value="<?= $id ?>"> <!-- stockage dans $post de l'id du film par le biais d'un input hidden -->      
       
    <button type="submit" class="btn btn-primary my-3" name="editMovie">Valider</button>
    
    <a class='btn btn-info' href='index.php?action=formEditCasting&id=<?=$id?>'>Modifier le casting</a> <!-- Avec l'ID du film -->
    
<?php   

    echo "<div class ='mx-5 row'>";    

    while ($acteur = $acteursFilm->fetch()){ // Affichage de tous les acteurs pour pouvoir les delete ou les modif par la suite/
      
        echo "<div class ='col-sm-3'><a class='text-decoration-none' href='index.php?action=actorfilmographie&id=".$acteur['id_personne']."'>        
                <div class='card my-3' style='width: 10rem;'>
                    <a href='index.php?action=formEditPerson&id=".$acteur['id_personne']."'><div id='edit-btn'><i class='bi bi-gear-fill'></i></div></a>
                        <img class='card-img-top' src='".$acteur['image']."' alt='Card image cap'>
                            <div class='card-body'>
                                <h6 class='card-title'>".$acteur['prenom']." ".$acteur['nom']."</h5>
                                <p>Né(e) le : ".$acteur['date_naissance']."</p>  
                                <p>Rôle : ".$acteur['nom_role']." </p>                                      
                            </div>
                        </div>
                    </a>
                </div>";
    }

    echo "</div>";
?>

        
<?php   
    $title = "Détail du film";
    $content = ob_get_clean();
    require "views/template.php";
?>
