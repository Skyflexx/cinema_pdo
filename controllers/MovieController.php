<?php
    require_once "bdd/DAO.php";

    class MovieController {

        // CREATE 

        public function formAddMovie(){

            $dao = new DAO(); // On instancie le DAO pour se connecter à la BDD.

            // selection des realisateurs à afficher pour le formulaire du film

            // On fera la même chose pour afficher les genres

            $sql = "SELECT p.prenom, p.nom, p.id_personne, r.id_realisateur
                    FROM personne p
                    INNER JOIN realisateur r
                    ON p.id_personne = r.id_personne;
                    ";            
                    
            $realisators = $dao->executerRequete($sql);

            $sql2 = "SELECT g.nom_genre, id_genre
                     FROM genre g            
                     ";            
            
            $genres = $dao->executerRequete($sql2);

            require "views/movie/formAddMovie.php";

        }

        public function addMovie($array){

            $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);  
            $releaseDate= filter_input(INPUT_POST, "releaseDate", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $duration = filter_input(INPUT_POST, "duration", FILTER_VALIDATE_INT);
            $synopsis = filter_input(INPUT_POST, "synopsis", FILTER_SANITIZE_FULL_SPECIAL_CHARS);                 
            $rating = filter_input(INPUT_POST, "rating", FILTER_VALIDATE_INT);
            $id_genres = filter_var_array($array['id_genre'], FILTER_SANITIZE_FULL_SPECIAL_CHARS); // FILTER VAR ARRAY POUR LA SELECTION MULTIPLE DES GENRES id_genre deviendra un array
            $id_realisateur = filter_input(INPUT_POST, "id_realisateur", FILTER_VALIDATE_INT); // récup de l'id real pour la jonction

            // var_dump($_POST['id_genre[]']);

            $dao = new DAO();

            $sql1 = "INSERT INTO film (titre_film, annee_sortie, duree_film, synopsis, note, id_realisateur)
                     VALUES (:titre_film, :annee_sortie, :duree_film, :synopsis, :note, :id_realisateur);";  

            $sql2 = "INSERT INTO appartenir (id_film, id_genre)
                    VALUES (:id_film, :id_genre);";            

            $addMovie = $dao->executerRequete($sql1, [':titre_film' => $title, ':annee_sortie' => $releaseDate, ':duree_film' => $duration, ':synopsis' => $synopsis, ':note' => $rating, ':id_realisateur' => $id_realisateur]);

            $id_new_film = $dao->getBDD()->lastInsertId(); // récupère l'ID auto incrémenté qui s'est créé lors de l'ajout du film. On va pouvoir intéragir avec du coup.

            // FIULTER VAR ARRAY va filtrer chaque variable de l'array id_genres q
            
            foreach ($id_genres as $id_genre){

                $addIntoGenre = $dao->executerRequete($sql2, [':id_film' => $id_new_film, ':id_genre' => $id_genre]);
                
            }              
         
            $this->showFilmDetails($id_new_film);

        }

        public function addCasting($array){ // contient le $_POST 

            $dao = new DAO();   

            $id_film = filter_input(INPUT_POST,"id_film", FILTER_VALIDATE_INT);
            $id_acteur = filter_input(INPUT_POST, "acteur", FILTER_VALIDATE_INT);
            $id_role = filter_input(INPUT_POST, "role", FILTER_VALIDATE_INT);
                       
            $sql1 = "INSERT INTO casting (id_film, id_acteur, id_role)

            VALUES (:id_film, :id_acteur, :id_role)";  

            $addCasting = $dao->executerRequete($sql1, [':id_film' => $id_film, ':id_acteur' => $id_acteur, 'id_role' => $id_role]);

            $this->formEditCasting($id_film);
        }


        // READ


        public function findAllFilms(){ // Permet de sortir tous les films.

            $dao = new DAO(); // On instancie un DAO. On se connecte à la BDD.

            $sql = "SELECT f.id_film, f.titre_film, f.synopsis, f.affiche, f.note FROM film f";

            $films = $dao->executerRequete($sql);

            require "views/movie/listFilms.php";
        }

        public function showFilmDetails($id){ // Permet d'afficher tous les détails d'un film, dont la liste des acteurs.

            $dao = new DAO(); // connexion bdd

            $sql = "SELECT f.id_film, f.titre_film, f.synopsis, f.affiche, f.wallpaper, date_format(f.annee_sortie,'%d-%m-%Y') AS annee_sortie, f.note, f.duree_film, p.nom, p.prenom, f.id_realisateur
                    FROM film f  
                    INNER JOIN realisateur r
                        ON f.id_realisateur = r.id_realisateur
                    INNER JOIN personne p
                        ON r.id_personne = p.id_personne
                    WHERE f.id_film = $id";

            $detailFilm = $dao->executerRequete($sql);

            $sql2 = "SELECT p.prenom, p.nom, p.sexe, date_format(p.date_naissance,'%d-%m-%Y') AS date_naissance, p.image, r.nom_role, p.id_personne
                    FROM personne p
                    INNER JOIN acteur a
                        ON p.id_personne = a.id_personne
                    INNER JOIN casting c
                        ON a.id_acteur = c.id_acteur 
                    INNER JOIN role r
                        ON c.id_role = r.id_role
                    WHERE c.id_film = $id";

            $acteursFilm = $dao->executerRequete($sql2);

            require "views/movie/detailFilm.php";

        }


        // UPDATE


        public function formEditMovie($id){ // formulaire d'édition d'un film.

            $dao = new DAO();

            $sqlActual = "SELECT f.id_film, f.titre_film, f.synopsis, f.affiche, f.wallpaper, f.annee_sortie, p.nom, p.prenom, f.id_realisateur, f.note, f.duree_film
                    FROM film f  
                    INNER JOIN realisateur r
                        ON f.id_realisateur = r.id_realisateur
                    INNER JOIN personne p
                        ON r.id_personne = p.id_personne
                    WHERE f.id_film = $id";           

            $detailFilm = $dao->executerRequete($sqlActual);

            $sql2 = "SELECT p.prenom, p.nom, p.sexe, p.date_naissance, p.image, r.nom_role, p.id_personne, c.id_acteur
                    FROM personne p
                    INNER JOIN acteur a
                        ON p.id_personne = a.id_personne
                    INNER JOIN casting c
                        ON a.id_acteur = c.id_acteur 
                    INNER JOIN role r
                        ON c.id_role = r.id_role
                    WHERE c.id_film = $id";

            $acteursFilm = $dao->executerRequete($sql2);  
            
            $sql3 = "SELECT g.nom_genre, id_genre
                     FROM genre g            
                     ";            
   
            $genres = $dao->executerRequete($sql3);

            require "views/movie/formEditMovie.php"; // on appelle currMovieEditing.php qui affiche tous les formulaires nécessaires à la modif d'un film.
        }

        public function editMovie($array){ // Fonction qui est appelée en appuyant sur "ok" depuis la fonction currMovieEditing. Elle permettra la maj SQL.

            // récupération des infos de $post puis injection SQL 
            
            $id= filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);
            $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);  
            $synopsis = filter_input(INPUT_POST, "synopsis", FILTER_SANITIZE_FULL_SPECIAL_CHARS);   
            $releaseDate= filter_input(INPUT_POST, "releaseDate", FILTER_SANITIZE_FULL_SPECIAL_CHARS);                
            $duration = filter_input(INPUT_POST, "duration", FILTER_VALIDATE_INT);  
            $rating = filter_input(INPUT_POST, "rating", FILTER_VALIDATE_INT);
            $id_genres = filter_var_array($array['id_genre'], FILTER_SANITIZE_FULL_SPECIAL_CHARS); // FILTER VAR ARRAY POUR LA SELECTION MULTIPLE DES GENRES id_genre deviendra un array
            $id_realisateur = filter_input(INPUT_POST, "id_realisateur", FILTER_VALIDATE_INT); // récup de l'id real pour la jonction
             
            $dao = new DAO();

            $sql="UPDATE film f
                    SET f.titre_film = '$title',
                        f.annee_sortie = '$releaseDate',
                        f.duree_film = '$duration',
                        f.synopsis = '$synopsis',
                        f.note = '$rating'
                    WHERE f.id_film = '$id';";   
                
            $editFilm = $dao->executerRequete($sql);

            // faire un delete de tous les genres  puis un foreach d'ajout de genre pour faire l'update car il n'y a pas forcemnent le même nbr de genre pour un film.

            $sql2 = "DELETE FROM appartenir
                    WHERE id_film = :id_film";            

            $deleteFromAppartenir = $dao->executerRequete($sql2, [':id_film' => $id]);              
                

            $sql3 = "INSERT INTO appartenir (id_film, id_genre)
            VALUES (:id_film, :id_genre);"; 

            // FILTER VAR ARRAY va filtrer chaque variable de l'array id_genres q
            
            foreach ($id_genres as $id_genre){

                $addIntoGenre = $dao->executerRequete($sql3, [':id_film' => $id, ':id_genre' => $id_genre]);
                
            }            

            $this->showFilmDetails($id); // Permet de repasser au détail du film en question ce qui fait une maj instantannée.
        }
    
        public function formEditCasting($id){ // Formulaire d'édition de casting, affichage en temps réel des membres actuels (qu'on peut delete d'un clic)

            $dao = new DAO(); 

            // cette requête permet de sortir uniquement l'id du film afin de le réutiliser correctement dans le formulaire d'édition d'un casting.
            $sql1 = "SELECT f.id_film
                    FROM film f
                    WHERE f.id_film = $id";                    
            $idMovie = $dao->executerRequete($sql1); 

              
            // permet la selection dans une liste des acteurs
            $sql2 = "SELECT p.id_personne, p.nom, p.prenom, a.id_acteur
                    FROM personne p
                    INNER JOIN acteur a
                    ON p.id_personne = a.id_personne";
            $acteurs = $dao->executerRequete($sql2); 

            // permet la selection dans une liste des roles
            $sql3 = "SELECT r.id_role, r.nom_role
                    FROM role r
                    ";                    
            $roles = $dao->executerRequete($sql3); 

            // Affichage en temps réel du casting actuel du film
            $sql4 = "SELECT p.prenom, p.nom, p.sexe, p.date_naissance, p.image, r.nom_role, p.id_personne, c.id_acteur, c.id_film 
            FROM personne p
            INNER JOIN acteur a
                ON p.id_personne = a.id_personne
            INNER JOIN casting c
                ON a.id_acteur = c.id_acteur 
            INNER JOIN role r
                ON c.id_role = r.id_role
            WHERE c.id_film = $id"; 
            $acteursFilm = $dao->executerRequete($sql4);

            require "views/movie/formEditCasting.php";
        }

       
        // DELETE
        

        public function deleteMovie($id){ // Supprime le film ainsi que son casting et son appartenance à un genre.
            
            $dao = new DAO();

            $sql1 = "

            DELETE FROM film f

            WHERE f.id_film = $id;

            DELETE FROM casting c

            WHERE c.id_film = $id;

            DELETE FROM appartenir a

            WHERE a.id_film = $id;";

            $deleteMovie = $dao->executerRequete($sql1); 

            $this->findAllFilms(); // Appelle la fonction findAllFilms pour retourner à la liste des films
        }
      
        public function deleteActorInCast($get){ // Supprime en temps réel un membre du cast d'un film donné. on récupère le contenu du GET

            $id_film= filter_input(INPUT_GET, "id_film", FILTER_SANITIZE_NUMBER_INT);
            $id_actor = filter_input(INPUT_GET, "id_acteur", FILTER_SANITIZE_NUMBER_INT);
            
            $dao = new DAO();

            $sql="DELETE FROM casting c
                WHERE c.id_acteur = $id_actor
                AND c.id_film = $id_film;";

            $castings = $dao->executerRequete($sql);

            $this->formEditCasting($id_film); 
        }
    }
?>