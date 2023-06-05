<!-- Intercepte la requête. Je vais voir si le controlleur existe et si la méthode existe. Pour afficher le home ce sera le homecontroller.

-->

<?php

    // On peut utiliser pour tout ça un autoloader également.
    require_once "controllers/HomeController.php";
    // ou le include. Permet de chercher des fichiers physiques.
    // les 2 font le même travail. Mais la diff se fait en cas d'absence de fichier. Include sortira un warning et require une fatal error.

    require_once "controllers/PersonController.php";
    require_once "controllers/MovieController.php";
    require_once "controllers/GenreController.php";

    // Création des instances des controllers

    $homeCtrl = new HomeController();
    $personCtrl = new PersonController();
    $filmCtrl = new MovieController();
    $genreCtrl = new GenreController();

    // L'index va intercepter la request HTTP. Va orienter vers le bon controleur et la bonne méthode.
    // ex : index.php?ctrl=movieCtrl&action=listFilms

    // Version simplifiée pour l'instant : index.php?action=listFilms

        if(isset($_GET['action'])){
            switch($_GET['action']){
                case 'listFilms': $filmCtrl->findAllFilms(); break;
                case 'listActors': $personCtrl->findAllActors(); break;
                case 'listGenres': $genreCtrl->findAllGenres(); break;

                //case 'homePage' : $homeCtrl->homePage(); break;
                default : $homeCtrl->homePage(); // autre façon de faire par rapport au case d'au dessus.
            }
        } else {
            $homeCtrl->homePage(); // Retour à la page d'accueil par la methode homePage()
        }

?>