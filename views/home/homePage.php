<?php 
    ob_start(); //demarre la temporisation de sortie. dans la memoire tampon.

    
                                     
                 
?>




<img src="public/images/cinema.jpg">




    

<?php 

$title = "SkyCine";
$content = ob_get_clean(); // récupère et affiche le fichier puis vide la mémoire tampon
require "views/template.php";
?>