<?php 

// Si je veux gérer les namespace dans mon autoload, alors il vaut mieux que je respecte la norme dites "PSR4"
// Cette norme veut que les noms des namespaces de mes classes, correspondent aux noms des dossier de mon projet


function inclusionAuto($class) {

    // Model\UserModel;
    // Ici je remplace les antislash par des slash normaux pour avoir un chemin d'accès plus propre
    // Certains serveurs n'accepteront pas les antislash dans un chemin d'accès
    $class = str_replace('\\', '/', $class);
    // Model/UserModel

    // Model/UserModel.class.php
    $file = $class . ".class.php";

    // require_once "Model/UserModel.class.php"
    require_once $file;

}


spl_autoload_register("inclusionAuto");