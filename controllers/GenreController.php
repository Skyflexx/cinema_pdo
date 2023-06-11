<?php

    class GenreController{

        public function findAllGenres(){ // Permet de lister tous les genres

            $dao = new DAO(); // Instanciation du DAO pour se connecter à la BDD

            $sql = "SELECT id_genre, nom_genre FROM genre";

            $genres = $dao->executerRequete($sql); // méthode exetuteRequete dans la classe DAO qui permet de faire une request SQL à la BDD.

            //$genres contiendra un tableau avec des rows qui contiendra chaque genre.

            require "views/genre/listGenres.php";
        }      
        
        public function showFilmsPerGenre($id){ // Permet de lister les films pour un genre donné en paramètres.

            $dao = new DAO();

            $sql = "SELECT f.id_film, f.titre_film, f.affiche, f.note
                    FROM film f
                    INNER JOIN appartenir a
                    ON f.id_film = a.id_film
                    INNER JOIN genre g
                    ON a.id_genre = g.id_genre
                    WHERE g.id_genre = $id";

            $listeFilmsGenre = $dao->executerRequete($sql);

            require "views/genre/filmsPerGenre.php";
        }

    }

?>