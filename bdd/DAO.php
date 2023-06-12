<!-- Définitions à faire :

DAO : 

DAO est un design pattern càd un patron de conception. Comme un modèle à suivre pour la conception d'un projet. On peut dire que c'est un ensemble de bonnes pratiques destinées à aider
les devs pour concevoir la meilleure solution (le design pattern aura fait ses preuves) face à un problème logiciel. Histoire de ne pas réinventer la roue.

DAO, Data Access Object, ou objet d'accès aux données. en tant que design pattern, sera la meilleure solution pour accéder à des données dans une BDD SQL. L'approche la plus propre en POO.


PDO : 

Pour pouvoir travailler avec une bdd en PhP, il faut d'abord s'y connecter. Il faut que php s'authentifie, qu'il créé une connexion avec MySqL. 

C'est là que PDO fait son entrée car c'est une extension PhP. (PHP Data Objects).

Plus bas on voit "new PDO" C'est par ce biais là qu'on se connecte à la BDD.


QUERY en PHP PDO : 

Query() permet via PDO de préparer et exectuer une requête SQL. 



PREPARE PHP PDO :

prepare() permet de préparer une requête SQL à être executée par la méthode Execute(). Permet un gain de performances pour les requêtes qui doivent être executées plusieurs fois mais avec des params différents.

Le fait de préparer une requête avant son execution aide à prévenir les attaques par injection SQL en éliminant le besoin de protéger les paramètres manuellement.

D'après PHP, si on utilise que prepare dans une appli, alors il n'y a aucune injection SQL possilble.
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
            $resultat = $this->bdd->query($sql); // execute directement la request demandée
        }else{
            $resultat = $this->bdd->prepare($sql);
            $resultat->execute($params);
        }
        return $resultat;
    }
}