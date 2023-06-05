<?php
    require_once "bdd/DAO.php";

    class MovieController {

        public function findAllFilms(){

            $dao = new DAO(); // On instancie un DAO. On se connecte à la BDD.

            $sql = "SELECT f.id_film, f.titre_film, f.synopsis FROM film f";

            $films = $dao->executerRequete($sql);

            require "views/movie/listFilms.php";
        }

    }

?>