<?php

    class RoleController{

         // CREATE

         public function formAddRole(){ // Formulaire d'ajout d'un rôle

            $dao = new DAO();           

            require "views/genre/formAddRole.php"; 
        }

        public function addRole($array){ // Ajout du rôle. array contient le contenu de $_POST

            $dao = new DAO();

            $role = filter_input(INPUT_POST, "nom_role", FILTER_SANITIZE_FULL_SPECIAL_CHARS); 

            $sql = "INSERT INTO role (nom_role)
                     VALUES (:nom_role);";  

            $addRole = $dao->executerRequete($sql, [':nom_role' => $nom_role]);
                        
            $this->findAllRoles();
        }

         // READ

         public function findAllRoles(){ // Permet de lister tous les roles

            $dao = new DAO(); // Instanciation du DAO pour se connecter à la BDD

            $sql = "SELECT id_role, nom_role FROM role";

            $genres = $dao->executerRequete($sql); // méthode exetuteRequete dans la classe DAO qui permet de faire une request SQL à la BDD.

            //$genres contiendra un tableau avec des rows qui contiendra chaque genre.

            require "views/genre/listRoles.php";
        }     
        
        public function showActorsPerRole($id_role){ // Permet de lister les films pour un genre donné en paramètres.

            $dao = new DAO();

            $sql = "SELECT p.id_personne, p.nom, p.prenom
                    FROM personne p
                    INNER JOIN acteur a
                    ON p.id_personne = a.id_personne
                    INNER JOIN casting c
                    ON a.id_acteur = c.id_acteur
                    INNER JOIN role r
                    ON c.id_role = r.id_role
                    WHERE r.id_role = :id_role";           

            $actorsListPerRole = $dao->executerRequete($sql, [':id_role' => $id_role]);            

            require "views/genre/listActorsPerRole.php";
        }






















    }

?>