<?php 

    require_once "bdd/DAO.php"; // Permet la connexion à la BDD via DAO.

    class PersonController{

        // READ
        
        public function findAllActors(){ // Permet de lister les acteurs.

            $dao = new DAO(); // On instancie le DAO pour se connecter à la BDD.

            $sql = "SELECT p.prenom, p.nom, DATE_FORMAT(p.date_naissance, '%Y') AS age, p.id_personne
                    FROM personne p
                    INNER JOIN acteur a
                    ON p.id_personne = a.id_personne;
                    ";
                    
            $actors = $dao->executerRequete($sql);

            require "views/actor/listActors.php"; // inclu listActors qui utilisera le resultat de la requête SQL, mettra dans le buffer et affichera dans le template.php.
        }

        public function showRealFilmography($id){ // Permet de récupérer les infos et les films d'un réalisateur.

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

        public function showActorFilmography($id){ // Permet de sortir la filmographie d'un acteur ainsi que le rôle joué.

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

            require "views/actor/actorFilmography.php"; // Le fichier appelé pour en afficher le contenu.
        }

        // UPDATE

        public function formEditPerson($id){ // Personne en cours d'édition. On récupère les données de la BDD pour pré-remplir tous les formulaires.

            $dao = new DAO();            

            $sql = "SELECT p.prenom, p.nom, p.sexe, p.date_naissance, p.image, p.id_personne
                    FROM personne p                    
                    WHERE p.id_personne = $id;";

            $detailsPerson = $dao->executerRequete($sql);

            require "views/person/formEditPerson.php"; // Appelle currPersonEditing.php qui affichera tous les formulaires et le bouton qui appellera editPerson() (voir ci dessous)
        }

        public function editPerson($array){ // Fonction qui permet l'édition dans la BDD d'une personne, puis qui rappelle la fct qui affiche le détail de la personne.

            // récupération des infos de $post puis injection SQL    $id, $nom, $prenom, $birthDate, $gender   
            
            $id= filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);
            $prenom = filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);  
            $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);   
            $birthDate= filter_input(INPUT_POST, "birthDate", FILTER_SANITIZE_FULL_SPECIAL_CHARS);                
            $gender = filter_input(INPUT_POST, "gender", FILTER_SANITIZE_FULL_SPECIAL_CHARS); 

            $dao = new DAO();

            $sql="UPDATE personne p
                    SET p.nom = '$nom',
                        p.prenom = '$prenom',
                        p.date_naissance = '$birthDate',
                        p.sexe = '$gender'
                    WHERE p.id_personne = '$id';";                      
                
            $editPerson = $dao->executerRequete($sql);

            $this->showActorFilmography($id); // Permet de repasser au détail de la personne en question ce qui fait une maj instantanée.

            // ATTENTION POUR LA SUITE IL Y AURA UN CONFLIT AVEC LA CLASSE REALISATEUR. il faudrait faire un $this->showRealFilmography en cas de réalisateur.
        }        
    }
?>