<?php 
    ob_start();
?>


<form action ='index.php?action=addCasting' method='post'>

    <select class="form-select mb-3" name = "acteur" aria-label="Default select example">

        <option selected>Nom acteur</option>

            <?php while ($acteur = $acteurs->fetch()){ // cette requête SQL permet également de sortir l'ID du film puisque lié au casting.
            
            echo "<option value = ".$acteur['id_acteur'].">".$acteur['prenom']." ".$acteur['nom']."</option>"; // La value récup l'id real.

            }?>   
    </select>
   
    <select class="form-select mb-3" name ="role" aria-label="Default select example">

    <option selected>Selectionner le rôle</option>

        <?php while ($role = $roles->fetch()){ 

        echo "<option value = ".$role['id_role'].">".$role['nom_role']."</option>"; // La value récup l'id real.

        }?>       

    </select>

    <!-- Permet la récupération de l'ID film par une requête SQL dédiée afin de l'injecter dans l'input hidden qui permettra l'ajout -->
    <?php while($currFilm = $idMovie->fetch()){

        $id_film = $currFilm['id_film'];

    }?>

    <input type="hidden" name="id_film" value="<?= $id_film?>">     

    <button type="submit" class="btn btn-primary my-3" name="addCasting">Ajouter</button>
    

</form>


<?php   

    echo "<div class ='mx-5 row'>";

    while ($acteur = $acteursFilm->fetch()){ // Affichage de tous les acteurs pour pouvoir les delete ou les modif par la suite/
      
        echo "<div class ='col-sm-3'><a class='text-decoration-none' href='index.php?action=actorfilmographie&id=".$acteur['id_personne']."'>        
                <div class='card my-3' style='width: 10rem;'>
                    <a href='index.php?action=currPersonEditing&id=".$acteur['id_personne']."'><div id='edit-btn'><i class='bi bi-gear-fill'></i></div></a>
                        <img class='card-img-top' src='".$acteur['image']."' alt='Card image cap'>
                            <div class='card-body'>
                                <h6 class='card-title'>".$acteur['prenom']." ".$acteur['nom']."</h5>
                                <p>Né(e) le : ".$acteur['date_naissance']."</p>  
                                <p>Rôle : ".$acteur['nom_role']." </p>
                                <a class='btn btn-danger btn-sm' href='index.php?action=deleteActorInCast&id_film=$id&id_acteur=".$acteur['id_acteur']."'>Supprimer</a>       
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