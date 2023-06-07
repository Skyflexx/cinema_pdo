<?php
// On peut appeler ce fichier Layout.php aussi.
// Le template c'est la page qui sera affichée et la seule qui sera chargée. Le contenu sera injecté.




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="public/css/style.css">
    <title><?= $title ?></title>
</head>
<body class='border border-dark mx-5'>

    <header class ='bg-dark text-warning'>        
    <img id = "frog" src="public/images/frog.png" > 
        <h1>SkyCine</h1>        

    </header>

    <nav class="navbar navbar-expand border-bottom border-dark d-flex justify-content-center">
        <figure>      
                   
        </figure>
            <ul class = "navbar-nav mr-auto">
                <li class="nav-item active"><a class="btn btn-dark mx-1" href="index.php?action=homePage">Accueil</a></li>
                <li class="nav-item active"><a class="btn btn-dark mx-1" href="index.php?action=listFilms">Films</a></li>
                <li class="nav-item active"><a class="btn btn-dark mx-1" href="index.php?action=listActors">Acteurs</a></li>
                <li class="nav-item active"><a class="btn btn-dark mx-1" href="index.php?action=listGenres">Genres</a></li>
                <!-- <li class="nav-item active"><a class="nav-link active" href="#">Home</a></li> -->
            </ul>
        </nav>

    <main>
        <?=$content ?>
        <!-- La balise ci dessus avec le =, c'est pour faire un echo de façon raccourcie -->
    </main>

    <!-- <form>
        <div class="form-group">
            <label for="exampleInputEmail1">Titre</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Titre">
            
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Résumé</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="résumé">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Date de sortie</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="date">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Note</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="note">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">durée</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="en minutes">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Réalisateur</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="réalisateur">
        </div>
        
        <button type="submit" class="btn btn-primary">Valider</button>

    </form> -->

    <footer class ='bg-dark text-warning text-center'>

        <span>2023 Sky Production</span>

    </footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>   
</body>
</html>