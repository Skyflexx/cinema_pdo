<?php
    require_once "bdd/DAO.php";

    class MovieController {

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

        public function addMovie($title, $releaseDate, $duration, $synopsis, $rating, $id_genre, $id_realisateur){

            $dao = new DAO();

            $sql1 = "INSERT INTO film (titre_film, annee_sortie, duree_film, synopsis, note, id_realisateur)
                     VALUES (:titre_film, :annee_sortie, :duree_film, :synopsis, :note, :id_realisateur);";        

            $sql2 = "INSERT INTO appartenir (id_film, id_genre)
                    VALUES (:id_film, :id_genre);";

            // $sql1-> execute(array(':titre_film' => $title, ':annee_sortie' => $releaseDate, ':duree_film' => $duration, ':synopsis' => $synopsis, ':note' => $rating, ':id_realisateur' => $id_realisateur ));

            // $sql2-> execute(array(':id_film' => $id_film, ':id_genre' => $id_genre));

            $addMovie = $dao->executerRequete($sql1, [':titre_film' => $title, ':annee_sortie' => $releaseDate, ':duree_film' => $duration, ':synopsis' => $synopsis, ':note' => $rating, ':id_realisateur' => $id_realisateur]);

            $id_new_film = $dao->getBDD()->lastInsertId();
            
            $addIntoGenre = $dao->executerRequete($sql2, [':id_film' => $id_new_film, ':id_genre' => $id_genre]);

            

            $this->showFilmDetails($id_new_film);

            

        }

        public function currMovieEditing($id){ // fonction "Film en cours d'édition". qui sortira tous les éléments nécessaires à la modification d'un film.

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

            require "views/movie/currMovieEditing.php"; // on appelle currMovieEditing.php qui affiche tous les formulaires nécessaires à la modif d'un film.

        }

        public function editMovie($id, $title, $synopsis, $releaseDate, $duration, $rating){ // Fonction qui est appelée en appuyant sur "ok" depuis la fonction currMovieEditing. Elle permettra la maj SQL.

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

            $this->showFilmDetails($id); // Permet de repasser au détail du film en question ce qui fait une maj instantannée.

        }

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
        
    }

?>