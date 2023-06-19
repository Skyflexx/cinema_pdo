<?php

    class GenreController{

        // CREATE

        public function formAddGenre(){ // Formulaire d'ajout de genre

            $dao = new DAO();           

            require "views/genre/formAddGenre.php"; 
        }

        public function addGenre($array){ // Ajout du genre. array contient le contenu de $_POST

            $dao = new DAO();

            $genre = filter_input(INPUT_POST, "genre", FILTER_SANITIZE_FULL_SPECIAL_CHARS); 

            $sql = "INSERT INTO genre (nom_genre)
                     VALUES (:nom_genre);";  

            $addGenre = $dao->executerRequete($sql, [':nom_genre' => $genre]);
                        
            $this->findAllGenres();
        }

        // READ

        public function findAllGenres(){ // Permet de lister tous les genres

            $dao = new DAO(); // Instanciation du DAO pour se connecter à la BDD

            $sql = "SELECT id_genre, nom_genre FROM genre";

            $genres = $dao->executerRequete($sql); // méthode exetuteRequete dans la classe DAO qui permet de faire une request SQL à la BDD.

            //$genres contiendra un tableau avec des rows qui contiendra chaque genre.

            require "views/genre/listGenres.php";
        }      
        
        public function showFilmsPerGenre($id){ // Permet de lister les films pour un genre donné en paramètres.

            $dao = new DAO();

            $sql = "SELECT f.id_film, f.titre_film, f.affiche, f.note, g.nom_genre
                    FROM film f
                    INNER JOIN appartenir a
                    ON f.id_film = a.id_film
                    INNER JOIN genre g
                    ON a.id_genre = g.id_genre
                    WHERE g.id_genre = $id";

            $sql2 = "SELECT g.id_genre, g.nom_genre
                     FROM genre g
                     WHERE g.id_genre = $id";

            $listeFilmsGenre = $dao->executerRequete($sql);

            $nomGenre = $dao->executerRequete($sql2);

            require "views/genre/filmsPerGenre.php";
        }

        // UPDATE

        public function formEditGenre($id){
            $dao = new DAO();

            $sql = "SELECT g.id_genre, g.nom_genre
                    FROM genre g
                    WHERE g.id_genre = :id_genre";

            $currentGenre = $dao->executerRequete($sql, [':id_genre' => $id]);

            require "views/genre/formEditGenre.php";            
        }

        public function editGenre($post){

            $id_genre= filter_input(INPUT_POST, "id_genre", FILTER_SANITIZE_NUMBER_INT); 
            $nom_genre = filter_input(INPUT_POST, "nom_genre", FILTER_SANITIZE_FULL_SPECIAL_CHARS);  

            $dao = new DAO();

            $sql = "UPDATE genre g
                    SET g.nom_genre = :nom_genre
                    WHERE g.id_genre = :id_genre";
            
            $editGenre = $dao->executerRequete($sql, [':id_genre' => $id_genre, ':nom_genre' => $nom_genre]);

            $this->showFilmsPerGenre($id_genre);
        }
        
        // DELETE

        // PROBLEME : Si on delete un genre, il n'y a plus rien dans la table appartenir et donc ça créé des erreurs SQL à l'édition d'un film.

        public function deleteGenre($id){
            
            $dao = new DAO();

            $sql1 = "DELETE FROM genre g
                    WHERE id_genre = $id;
                    
                    DELETE FROM appartenir a
                    WHERE id_genre = $id;";

            $deleteMovie = $dao->executerRequete($sql1); 

            $this->findAllGenres(); // Appelle la fonction findAllFilms pour retourner à la liste des films
        }
    }
?>