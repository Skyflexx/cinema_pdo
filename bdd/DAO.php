<!-- Définitions à faire :

DAO : Data Access Object
PDO : Classe native PhP

-->

<?php

class DAO{ // Permettra de construire un objet pour me connecter grace à PDO à la BDD.
    
    private $bdd;

    public function __construct(){
        $this->bdd = new PDO('mysql:host=localhost;dbname=cinema;charset=utf8', 'root', '');
    } // dbname c'est le nom de la BDD. 'root' et " " vide c'est le nom et le password.

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