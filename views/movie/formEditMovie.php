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
       
        $affiche = $detail['affiche']; // affiche du film

        // Sort les infos du real récupérés via la requête SQL de détail du film.
        $id_real = $detail['id_realisateur'];
        $nom_real = $detail['nom']; 
        $prenom_real = $detail ['prenom'];    
    }
   
    $id_genre = array(""); // défini par défaut car si on delete un genre, un film n'ayant plus de genre causera des erreurs car id_genre ne sera pas défini dans le fetch qui est null.

    while ($currGenre = $currGenres->fetch()){

        $id_genre[] =  $currGenre['id_genre']; // Pourra être utilisé par la suite en cas de pré selection de genre (pas encore actif)
        $nom_genre[] = $currGenre['nom_genre']; 

    }

  
    // Les lignes de codes ci-dessous permettent de rajouter le mot "checked" à la balise radio pour pré-cocher la bonne en fct du contenu de la BDD*
    // On pourra par la suite factoriser ce code via du ternaire plutôt

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

<form action = 'index.php?action=editMovie' method='post' enctype="multipart/form-data"> 
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

    <label for="id_realisateur">Choix du realisateur</label>
    <select class="form-select mb-3" name = id_realisateur aria-label="Default select example" required> <!-- selection des réalisateurs -->

        <option selected value='<?= $id_real ?>'><?= $prenom_real." ".$nom_real ?></option> <!-- au dessus, required indique qu'il faut une option avec une value non nulle (ici elle est nulle donc non prise en compte) -->

        <?php while ($realisateur = $realisators->fetch()){ // Utilisatuion d'un fetch pour que les real soient dans la liste

            if ($realisateur['id_realisateur'] != $id_real) // On compare ce fetch avec celui du réalisateur déjà selectionné à la base afin d'afficher que les autres car le réal actuel est affiché juste au dessus
                echo "<option value = ".$realisateur['id_realisateur'].">".$realisateur['prenom']." ".$realisateur['nom']."</option>"; // La value récup l'id real.
            }
        ?>   
    </select>

    <p>Choix du genre</p>
    <!-- selection du ou des genres -->

        <?php
        // foreach ($nom_genre as $index => $genre){                
            
        //     // Foreach qui va parcourir la liste fetch des genres déjà sélectionnés dans le film 
        //     // (et vu que le fetch id_genre et nom_genre sont liés et donc égaux en terme d'écriture,
        //     // je peux parcourir l'array des id_genre[] avec l'index de l'array nom_genre[] )

        //     echo "<option selected value =".$id_genre[$index].">".$genre."</option>"; // Ainsi, les genres déjà sélectionnés seront pré remplis
            
        // }          
            
            while ($genre = $genres->fetch()){ // permet de lister tous les genres existants

                // echo "<option value =".$genre['id_genre'].">".$genre['nom_genre']."</option>"; // La value permet de récupérer l'ID du genre.

                // <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">

                // operateur ternaire : A etudier !
                echo "<input class ='form-check-input mx-3' name = 'id_genre[]' type ='checkbox' " . (
                    in_array($genre['id_genre'], $id_genre) // 20 correspond au genre "non défini" Coché par défaut.
                    ? "checked "
                    : ""
                ) . "value =".$genre['id_genre'].">".$genre['nom_genre']."";

                // echo "<input class ='form-check-input' type ='checkbox' value =".$genre['id_genre'].">".$genre['nom_genre']."</input>";
            }
                    
        ?>           
    
    <!-- https://fr.web.img6.acsta.net/c_310_420/commons/v9/common/empty/empty_portrait.png -->
    
    <!-- (empty($affiche) ? "https://fr.web.img6.acsta.net/c_310_420/commons/v9/common/empty/empty_portrait.png" : "$affiche") -->    
    
    <div class="form-group border my-2">
        <label for="imgUrl">Modifier l'affiche de film</label>
        <input type="text" class="form-control mb-3" id="imgUrl" name="imgUrl" aria-describedby="Add an image by Url" value= <?= $affiche ?>> <!-- Faille ici à cause de la visibilité de l'arborescence des fichiers lors d'un upload-->

        <p>Ou chargez une affiche depuis votre ordinateur :</p>
        <label for="imgUpload">Selectionner une image:</label>
        <input type="file" class ="pb-3" name="imgToUpload" id="imgToUpload">          
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

</form>
    
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

