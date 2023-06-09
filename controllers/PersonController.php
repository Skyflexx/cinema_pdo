<?php 

    require_once "bdd/DAO.php"; // Permet la connexion à la BDD via DAO.

    class PersonController{

        public function findAllActors(){

            $dao = new DAO(); // On instancie le DAO pour se connecter à la BDD.

            $sql = "SELECT p.prenom, p.nom, DATE_FORMAT(p.date_naissance, '%Y') AS age, p.id_personne
                    FROM personne p
                    INNER JOIN acteur a
                    ON p.id_personne = a.id_personne
                    ";
                    
            $actors = $dao->executerRequete($sql);

            require "views/actor/listActors.php"; // Le fichier du buffer qui contiendra le contenu de la requête SQL
        }

        public function showRealFilmography($id){

            $dao = new DAO();

            $sql = "SELECT p.prenom, p.nom, p.image,f.id_film, f.titre_film, DATE_FORMAT(f.annee_sortie, '%Y') AS annee_sortie            
                    FROM film f
                    INNER JOIN realisateur r
                    ON f.id_realisateur = r.id_realisateur
                    INNER JOIN personne p
                    ON r.id_personne = p.id_personne            
                    WHERE r.id_realisateur =  $id
                    ORDER BY annee_sortie ASC";
            
            $filmList = $dao->executerRequete($sql);

            require "views/realisator/realFilmography.php"; // Le fichier du buffer qui contiendra le contenu de la requête SQL

        }

        public function showActorFilmography($id){

            $dao = new DAO();

            $sql = "SELECT f.id_film, f.titre_film, DATE_FORMAT(f.annee_sortie, '%Y') AS annee_sortie, p.nom, p.prenom, p.image, p.sexe, p.date_naissance, r.nom_role, p.id_personne
                    FROM film f
                    INNER JOIN casting c
                    ON f.id_film = c.id_film
                    INNER JOIN acteur a
                    ON c.id_acteur = a.id_acteur
                    INNER JOIN personne p
                    ON a.id_personne = p.id_personne
                    INNER JOIN role r
                    ON c.id_role = r.id_role
                    WHERE p.id_personne = $id
                    ORDER BY annee_sortie ASC";
            
            $filmList = $dao->executerRequete($sql);

            require "views/actor/actorFilmography.php"; // Le fichier du buffer qui contiendra le contenu de la requête SQL

        }

        public function currPersonEditing($id){ // Personne en cours d'édition. Afficheant les détails actuels.

            $dao = new DAO();            

            $sql = "SELECT p.prenom, p.nom, p.sexe, p.date_naissance, p.image, p.id_personne
                    FROM personne p
                    
                    WHERE p.id_personne = $id";

            $detailsPerson = $dao->executerRequete($sql);

             require "views/person/currPersonEditing.php";

        }

        public function editPerson($id, $nom, $prenom, $birthDate, $gender){

            // récupération des infos de $post puis injection SQL            

            $dao = new DAO();

            $sql="UPDATE personne p
                    SET p.nom = '$nom',
                        p.prenom = '$prenom',
                        p.date_naissance = '$birthDate',
                        p.sexe = '$gender'
                    WHERE p.id_personne = '$id';";                      
                
            $editPerson = $dao->executerRequete($sql);

            $this->showActorFilmography($id); // Permet de repasser au détail de la personne en question ce qui fait une maj instantannée.

        }
        
    }

?>