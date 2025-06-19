<?php

// Ici grâce à l'autoload, on s'évite le fait de require TOUTES les classes que l'on manipulerait sur ce fichier

// Plus bas, j'utilise la classe UneClasse, l'autoload le comprend et rajoute le fichier UneClasse.class.php sur la page1.php 
require("autoload.php");






?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php
    // Avec l'instanciation de cette classe, l'autoload comprends qu'il doit s'activer et va ajouter sur cette page, page1.php le fichier UneClasse.class.php
    $uneClass = new UneClasse;
    ?>

</body>

</html>