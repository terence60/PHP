<?php

var_dump($_GET);

$categorie = "";

// AVANT TOUTE CHOSE, avant de commencer n'importe quel traitement
// Je m'assure de toujours "posséder" les éléments que je vais manipuler
// Ici j'ai besoin de manipuler l'indice "categorie" dans le get : $_GET["categorie"]
// isset() me permet de me retourner true, s'il existe et false s'il n'existe pas
// Ce qui m'évite de commencer le traitement si jamais cet indice n'existe pas dans le GET
if (isset($_GET["categorie"])) {

    $cat = $_GET["categorie"];

    if ($cat == "info") {
        $categorie = "Informatique";
    } elseif ($cat == "vet") {
        $categorie = "Vetements";
    } elseif ($cat == "pap") {
        $categorie = "Papeterie";
    }
} else {
    // Si jamais le isset echoue, alors je redirige l'utilisateur sur l'autre page !
    // On redirige avec l'instruction header("location: unePage.php");
    header("location: introGET.php");
    // exit; me permet de stopper totalement l'exécution du code (nécessaire pour raison de sécurité après une redirection)
    exit;
    die;
}




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des produits</title>
</head>

<body>
    <h3>Catégorie : <?= $categorie ?></h3>


    <p>Liste des produits de la catégorie <?= $categorie ?>:</p>
</body>

</html>