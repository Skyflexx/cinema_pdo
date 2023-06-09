<!-- Définitions à faire :

DAO : Data Access Object
PDO : Classe native PhP
query() : fct native php
prepare()

-->

<?php

class DAO{ // Permettra de construire un objet pour me connecter grace à PDO à la BDD.
    
    private $bdd;

    public function __construct(){
        $this->bdd = new PDO('mysql:host=localhost;dbname=cinema;charset=utf8', 'root', ''); // Localisation de la BDD avec le nom d'utilisateur et le password si il y en a un.
    } 

    function getBDD(){
        return $this->bdd;
    }

    public function executerRequete($sql, $params = NULL){
        if ($params == NULL){
            $resultat = $this->bdd->query($sql);
        }else{
            $resultat = $this->bdd->prepare($sql);
            $resultat->execute($params);
        }
        return $resultat;
    }
}