<!-- Intercepte la requête. Je vais voir si le controlleur existe et si la méthode existe. Pour afficher le home ce sera le homecontroller.

Dans l'index, on require tous les fichiers controllers qui contiennent les objets controllers dont les méthodes contiennent dans notre cas des requêtes SQL.

Ensuite, à la fin de chaque méthode, un fichier php est appelé (comme listFilms.php) dont le but est de mettre dans le buffer toutes les données qu'on veut afficher.

Dans ce fichier on stocke nos données dans des variables qui sont présentes dans template.php qui constitue la seule page réellement affichée du site dans le navigateur.
-->

<?php
   
    require_once "controllers/HomeController.php";   
    require_once "controllers/PersonController.php";
    require_once "controllers/MovieController.php";
    require_once "controllers/GenreController.php";

     // On peut utiliser pour tout ça un autoloader également.

    // On peut utiliser include qui fera le même travail que require. La diff se fait en cas d'absence de fichier. Include sortira un warning et require une error.

    // Création des instances des controllers

    $homeCtrl = new HomeController();
    $personCtrl = new PersonController();
    $filmCtrl = new MovieController();
    $genreCtrl = new GenreController();

    // L'index va intercepter la request HTTP. Va orienter vers le bon controleur et la bonne méthode.

    // ex : index.php?ctrl=movieCtrl&action=listFilms

    // On fait une Version simplifiée pour l'instant : index.php?action=listFilms

    if(isset($_POST['editPerson'])){

        $id= filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);
        $prenom = filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);  
        $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);   
        $birthDate= filter_input(INPUT_POST, "birthDate", FILTER_SANITIZE_FULL_SPECIAL_CHARS);                
        $gender = filter_input(INPUT_POST, "gender", FILTER_SANITIZE_FULL_SPECIAL_CHARS);  
        
        $personCtrl->editPerson($id, $prenom, $nom, $birthDate, $gender);  // Après vérif, on appelle la fct editPerson.     
    }

    if(isset($_POST['editMovie'])){

        $id= filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);
        $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);  
        $synopsis = filter_input(INPUT_POST, "synopsis", FILTER_SANITIZE_FULL_SPECIAL_CHARS);   
        $releaseDate= filter_input(INPUT_POST, "releaseDate", FILTER_SANITIZE_FULL_SPECIAL_CHARS);                
        $duration = filter_input(INPUT_POST, "duration", FILTER_VALIDATE_INT);  
        $rating = filter_input(INPUT_POST, "rating", FILTER_VALIDATE_INT); 

        $filmCtrl->editMovie($id, $title, $synopsis, $releaseDate, $duration, $rating);  // Si un submit au nom de editPerson on lance la fct editer après vérification.

    }

        if(isset($_GET['action'])){

            // $id= filter_input(INPUT_GET, "id", FILTER_SANITIZE_FULL_SPECIAL_CHARS); // On oublie pas de filtrer l'ID qui est rentré par l'utilisateur.
            $id= filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT); // On oublie pas de filtrer l'ID qui est rentré par l'utilisateur.
            // Récupère le contenu dans le GET, dont le nom est 'id', le filtre puis le CAST en INT avec notre filtre number int.

            // Variables à filtrer dans le GET            

            switch($_GET['action']){ // Dans le $_GET si le contenu de l'action est listFilms, listActors ou listGenres, alors on fait appel aux méthodes des objets suivants.
                case 'listFilms': $filmCtrl->findAllFilms(); break;
                case 'listActors': $personCtrl->findAllActors(); break;
                case 'listGenres': $genreCtrl->findAllGenres(); break;
                case 'detailFilm' : $filmCtrl->showFilmDetails($id); break; // $id en paramètre qu'on a filtré au dessus. 
                case 'filmographie' : $personCtrl->showRealFilmography($id); break;
                case 'actorfilmographie' : $personCtrl->showActorFilmography($id); break;
                case 'filmsPerGenre' : $genreCtrl->showFilmsPerGenre($id); break;
                case 'currMovieEditing' : $filmCtrl->currMovieEditing($id); break;  
                case 'currPersonEditing' : $personCtrl->currPersonEditing($id); break;            

                //case 'homePage' : $homeCtrl->homePage(); break; // Voir ligne du dessous
                default : $homeCtrl->homePage(); // autre façon de faire par rapport au case d'au dessus.
            }
        } else {
            // $homeCtrl->homePage(); // Retour à la page d'accueil par la methode homePage() // Retrait car s'affichait en trop après une modif
        }

?>