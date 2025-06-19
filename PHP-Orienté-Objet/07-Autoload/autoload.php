<?php 

// Concept de base d'un autoload :

// Le concept d'un autoload est de pouvoir charger nos fichiers de classes automatiquement

// Si je n'ai pas d'autoload et que j'utilise par exemple une classe User
// Alors, première chose à faire require("User.php");
// Et je devrais faire ça pour chacune des classes que je souhaite manipuler sur mon fichier

// Grâce à l'autoload, je n'ai plus besoin de me soucier de ces require, il va être capable de les gérer automatiquement
// Il me suffit simplement d'instancier mes objets quand j'en ai besoin, l'autoload rajoutera le require en rapport avec cette classe à ce moment là


// En PHP l'autoload est activé grâce à une fonction prédéfinie s'appellant spl_autoload_register() 
// Cette fonction permet de choisir un comportement à lancer lors d'une instanciation d'objet et sera capable de transmettre des informations sur l'objet en train d'être instancié



// Ici je développe la fonction qui est censée se lancer par l'autoload
function inclusionAuto($class) {
// On récupère dans le param $class, le nom de la classe qui est en train d'être instanciée

// Je fais une concaténation pour modéliser le nom du fichier
    // UneClasse.class.php
    $file = $class . ".class.php";

    // Je termine par un require_once du fichier en question
    // require_once("UneClasse.class.php"")
    require_once $file;

}


// spl_autoload_register reste en sommeil jusqu'à voir une instanciation, dans ce cas, elle va se lancer et exécuter la fonction que je lui ai dit de lancer "inclusionAuto"
// En même temps, elle enverra en paramètre le nom de la classe et du namespace de l'objet en train d'être instancié
spl_autoload_register("inclusionAuto");

//     inclusionAuto("UneClasse");


// $uneClasse = new UneClasse;


// function direBonjour($qui) {
//     echo "Bonjour $qui";
// }

// direBonjour("Pierra");