<?php

    class GenreController{

        public function formAddGenre(){

            $dao = new DAO();

            // $sql2 = "SELECT f.id_film, f.titre_film
            // FROM film f"; // Permet de selectionner la liste de tous les films.

            // $films = $dao->executerRequete($sql2);

            require "views/genre/formAddGenre.php"; 
        }

        public function addGenre($array){ // array contient le contenu de $_POST

            $dao = new DAO();

            $genre = filter_input(INPUT_POST, "genre", FILTER_SANITIZE_FULL_SPECIAL_CHARS); 

            $sql = "INSERT INTO genre (nom_genre)
                     VALUES (:nom_genre);";  

            $addGenre = $dao->executerRequete($sql, [':nom_genre' => $genre]);
                        
            $this->findAllGenres();

        }

        public function deleteGenre($id){
            
            $dao = new DAO();

            $sql1 = "
            DELETE FROM genre g
            WHERE id_genre = $id;
            
            DELETE FROM appartenir a
            WHERE id_genre = $id;";

            $deleteMovie = $dao->executerRequete($sql1); 

            $this->findAllGenres(); // Appelle la fonction findAllFilms pour retourner à la liste des films

        }

        // public function addMovieIntoGenre($id){ //$id c'est l'id du genre en question

        //     $dao = new DAO();

        //     $sql = "INSERT INTO appartenir (id_film, id_genre)
        //             VALUES (:id_film, :id_genre)";

        //     $MovieIntoGenre = $dao->executerRequete($sql, [':id_film' => $id_film, ':id_genre' => $id_genre])

        //     $this->showFilmsPerGenre($id); // on réaffiche la liste des films pour ce genre.

        // }

        // public function deleteMovieFromGenre(){

        // }

      
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

    }

?>