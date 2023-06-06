<?php
    require_once "bdd/DAO.php";

    class MovieController {

        public function findAllFilms(){

            $dao = new DAO(); // On instancie un DAO. On se connecte à la BDD.

            $sql = "SELECT f.id_film, f.titre_film, f.synopsis, f.affiche FROM film f";

            $films = $dao->executerRequete($sql);

            require "views/movie/listFilms.php";
        }

        public function showFilmDetails($id){

            $dao = new DAO(); // connexion bdd

            $sql = "SELECT f.id_film, f.titre_film, f.synopsis, f.affiche, f.wallpaper FROM film f WHERE f.id_film = $id ";

            $detailFilm = $dao->executerRequete($sql);

            require "views/movie/detailFilm.php";

        }

    }

?>