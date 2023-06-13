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
    
    // la ligne ci dessous : si dans le GET, çàd si il y a un url qui est envoyé (via action 'index.php?action=editMovie' par exemple)

    // on aurait pu mettre un autre mot que action. C'est le = qui importe et ce qu'il y a après. selon le cas on lance l'une ou l'autre fonction.
      
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
            case 'btnAddFilm' : $filmCtrl->formAddMovie(); break;
            case 'addMovie': $filmCtrl->addMovie($_POST); break;
            case 'deleteMovie' : $filmCtrl->deleteMovie($id); break; // delete d'un film avec son ID récupéré dans le href du btn dans currMovieEditing.
            case 'btnAddGenre' : $genreCtrl->formAddGenre(); break;
            case 'addGenre' : $genreCtrl->addGenre($_POST); break;
            case 'deleteGenre' : $genreCtrl->deleteGenre($id); break;
            case 'editPerson' : $personCtrl->editPerson($_POST); break;
            case 'editMovie' : $filmCtrl->editMovie($_POST); break;
            case 'deleteActorInCast' : $filmCtrl->deleteActorInCast($_GET); break;
            
            // case 'addFilm' : $filmCtrl->addMovie(); break;    A AJOUTER APRES
            //case 'homePage' : $homeCtrl->homePage(); break; // Voir ligne du dessous
            default : $homeCtrl->homePage(); // autre façon de faire par rapport au case d'au dessus.
        }
    } else {
            $homeCtrl->homePage(); // Retour à la page d'accueil par la methode homePage() // Retrait car s'affichait en trop après une modif

            // Obligatoire au lancement.
    }

?>