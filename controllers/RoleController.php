<?php

    class RoleController{

         // CREATE

         public function formAddRole(){ // Formulaire d'ajout d'un rôle

            $dao = new DAO();           

            require "views/role/formAddRole.php"; 
        }

        public function addRole($array){ // Ajout du rôle. array contient le contenu de $_POST

            $dao = new DAO();

            $nom_role = filter_input(INPUT_POST, "nom_role", FILTER_SANITIZE_FULL_SPECIAL_CHARS); 

            $sql = "INSERT INTO role (nom_role)
                     VALUES (:nom_role);";  

            $addRole = $dao->executerRequete($sql, [':nom_role' => $nom_role]);
                        
            $this->findAllRoles();
        }

         // READ

         public function findAllRoles(){ // Permet de lister tous les roles

            $dao = new DAO(); // Instanciation du DAO pour se connecter à la BDD

            $sql = "SELECT id_role, nom_role FROM role";

            $roles = $dao->executerRequete($sql); // méthode exetuteRequete dans la classe DAO qui permet de faire une request SQL à la BDD.

            //$genres contiendra un tableau avec des rows qui contiendra chaque genre.

            require "views/role/listRoles.php";
        }     
        
        public function showActorsPerRole($id_role){ // Permet de lister les films pour un genre donné en paramètres.

            $dao = new DAO();

            $sql = "SELECT p.id_personne, p.nom, p.prenom, f.titre_film, DATE_FORMAT(f.annee_sortie, '%Y') as annee_sortie, r.id_role
                    FROM personne p
                    INNER JOIN acteur a
                    ON p.id_personne = a.id_personne
                    INNER JOIN casting c
                    ON a.id_acteur = c.id_acteur
                    INNER JOIN role r
                    ON c.id_role = r.id_role
                    INNER JOIN film f
                    ON c.id_film = f.id_film
                    WHERE r.id_role = :id_role";     

            $actorsListPerRole = $dao->executerRequete($sql, [':id_role' => $id_role]);            

            require "views/role/listActorsPerRole.php";
        }

        // UPDATE 

        public function formEditRole($id){
        $dao = new DAO();

            $sql = "SELECT r.id_role, r.nom_role
                    FROM role r
                    WHERE r.id_role = :id_role";

            $currentRole = $dao->executerRequete($sql, [':id_role' => $id]);

            require "views/role/formEditRole.php";            
        }

        public function editRole($post){

            $id_role= filter_input(INPUT_POST, "id_role", FILTER_SANITIZE_NUMBER_INT); 
            $nom_role = filter_input(INPUT_POST, "nom_role", FILTER_SANITIZE_FULL_SPECIAL_CHARS);  

            $dao = new DAO();

            $sql = "UPDATE role r
                    SET r.nom_role = :nom_role
                    WHERE r.id_role = :id_role";
            
            $editrole = $dao->executerRequete($sql, [':id_role' => $id_role, ':nom_role' => $nom_role]);

            $this->showActorsPerRole($id_role);
        }

        // DELETE

        // PROBLEME : Si on delete un genre, il n'y a plus rien dans la table appartenir et donc ça créé des erreurs SQL à l'édition d'un film.

        public function deleteRole($id){
            
            $dao = new DAO();

            $sql1 = "DELETE FROM Role g
                    WHERE id_role = $id;
                    
                    DELETE FROM appartenir a
                    WHERE id_role = $id;";

            $deleteMovie = $dao->executerRequete($sql1); 

            $this->findAllRoles(); // Appelle la fonction findAllFilms pour retourner à la liste des films
        }























    }

?>