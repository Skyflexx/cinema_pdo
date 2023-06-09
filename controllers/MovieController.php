<?php
    session_start();
    require_once "bdd/DAO.php";

    class MovieController {

        public function currMovieEditing($id){

            $dao = new DAO();

            $sqlActual = "SELECT f.id_film, f.titre_film, f.synopsis, f.affiche, f.wallpaper, f.annee_sortie, p.nom, p.prenom, f.id_realisateur, f.note, f.duree_film
                    FROM film f  
                    INNER JOIN realisateur r
                        ON f.id_realisateur = r.id_realisateur
                    INNER JOIN personne p
                        ON r.id_personne = p.id_personne
                    WHERE f.id_film = $id";           

            $detailFilm = $dao->executerRequete($sqlActual);

            $sql2 = "SELECT p.prenom, p.nom, p.sexe, p.date_naissance, p.image, r.nom_role, p.id_personne
                    FROM personne p
                    INNER JOIN acteur a
                        ON p.id_personne = a.id_personne
                    INNER JOIN casting c
                        ON a.id_acteur = c.id_acteur 
                    INNER JOIN role r
                        ON c.id_role = r.id_role
                    WHERE c.id_film = $id";

            $acteursFilm = $dao->executerRequete($sql2);


             require "views/movie/currMovieEditing.php";

        }

        public function editMovie($id, $title, $synopsis, $releaseDate, $duration, $rating){

            // récupération des infos de $post puis injection SQL            

            $dao = new DAO();

            $sql="UPDATE film f
                    SET f.titre_film = '$title',
                        f.annee_sortie = '$releaseDate',
                        f.duree_film = '$duration',
                        f.synopsis = '$synopsis',
                        f.note = '$rating'
                    WHERE f.id_film = '$id';";   
                
            $editFilm = $dao->executerRequete($sql);

            $this->showFilmDetails($id);

        }

        public function findAllFilms(){

            $dao = new DAO(); // On instancie un DAO. On se connecte à la BDD.

            $sql = "SELECT f.id_film, f.titre_film, f.synopsis, f.affiche, f.note FROM film f";

            $films = $dao->executerRequete($sql);

            require "views/movie/listFilms.php";
        }

        public function showFilmDetails($id){

            $dao = new DAO(); // connexion bdd

            $sql = "SELECT f.id_film, f.titre_film, f.synopsis, f.affiche, f.wallpaper, date_format(f.annee_sortie,'%d-%m-%Y') AS annee_sortie, f.note, f.duree_film, p.nom, p.prenom, f.id_realisateur
                    FROM film f  
                    INNER JOIN realisateur r
                        ON f.id_realisateur = r.id_realisateur
                    INNER JOIN personne p
                        ON r.id_personne = p.id_personne
                    WHERE f.id_film = $id";

            $detailFilm = $dao->executerRequete($sql);

            $sql2 = "SELECT p.prenom, p.nom, p.sexe, p.date_naissance, p.image, r.nom_role, p.id_personne
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

        // public function showActors($id){

        //     $dao = new DAO();

        //     $sql2 = "SELECT p.prenom, p.nom, p.sexe, p.date_naissance 
        //             FROM personne p
        //             INNER JOIN acteur a
        //                 ON p.id_personne = a.id_personne
        //             INNER JOIN casting c
        //                 ON a.id_acteur = c.id_acteur 
        //             WHERE c.id_film = $id";

        //     $acteursFilm = $dao->executerRequete($sql2);
            
        //     require "views/movie/detailFilm.php";
        // }

    }

?>