<?php

// Ici je manipule des classes avec des namespaces donc je peux les "importer" avec use, ce qui m'évite de fournir le FQN à l'instanciation
use Controller\UserController;
use Model\UserModel;


// Ajout de l'autoload
require_once("autoloadNamespace.php");


// A ces deux instanciations, qui sont des classes ayant des namespaces, l'autoload de comprendre les namespace, qui, nommés aux mêmes noms que mes dossiers, me permet d'importer les fichiers suivants : 
    //     /Controller/UserController.class.php
    //     /Model/UserModel.class.php
$userModel = new UserModel;
$userController = new UserController;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2>Je suis sur la page 2 pour tester mon autoload avec namespace</h2>

    <?php

    echo $userModel->getData();

    echo $userController->getUser();

    ?>
</body>

</html>