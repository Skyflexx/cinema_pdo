<?php

    class GenreController{

        public function findAllGenres(){

            $dao = new DAO(); // Instanciation du DAO pour se connecter à la BDD

            $sql = "SELECT id_genre, nom_genre FROM genre";

            $genres = $dao->executerRequete($sql); // méthode exetuteRequete dans la classe DAO qui permet de faire une request SQL à la BDD.

            //$genres contiendra un tableau avec des rows qui contiendra chaque genre.

            require "views/genre/listGenres.php";
        }

    }

?>