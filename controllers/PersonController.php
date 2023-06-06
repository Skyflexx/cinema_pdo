<?php 

    require_once "bdd/DAO.php"; // Permet la connexion à la BDD via DAO.

    class PersonController{

        public function findAllActors(){

            $dao = new DAO(); // On instancie le DAO pour se connecter à la BDD.

            $sql = "SELECT p.prenom, p.nom, DATE_FORMAT(p.date_naissance, '%Y') AS age 
                    FROM personne p
                    INNER JOIN acteur a
                    ON p.id_personne = a.id_personne
                    ";
                    
            $actors = $dao->executerRequete($sql);



            require "views/actor/listActors.php"; // Le fichier du buffer qui contiendra le contenu de la requête SQL
        }

        
    }

?>