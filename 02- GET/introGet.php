<?php

/* 

Le protocole GET fait partie du protocole HTTP (le système de communication des serveurs web).
GET est utilisé pour récupérer des informations depuis un serveur via son URL.
C'est à dire que lorsque l'on regarde une adresse d'une page sur un site web, alors, on remarquera des éléments transmits au GET.

Ces informations sont reçues de la forme suivante : 

        http://www.monsite.com?key=value&key2=value2 etc.... 

        On considère que jusqu'au point d'interrogation, c'est l'adresse de la page (ici on arrive sur l'index de monsite.com), dès que l'on rencontre ce point d'interrogation, alors on passe sur la transmission de paramètres sous forme de clé=valeur car, on va récupérer ça sous forme de tableau array.


    Pour manipuler ces valeurs là en PHP, on utilise une "superglobale", ici $_GET 
    $_GET va récupérer les informations transmises dans l'URL pour que je puisse les manipuler 

    On considère que l'on transmet des informations $_GET, via des liens, donc généralement, des boutons, des icones, des actions de "clic" sur le site.

*/

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boutique en ligne</title>
</head>

<body>

    <?php

    // Ici on crée un tableau array $categories qui représente ce que pourrait être une retour d'une liste de catégorie venant d'une base de données, on insère ici 3 catégorie
    // Chacune a un "code" qui permet de modeliser le lien vers l'autre page
    // Et aussi un nom, pour afficher ce nom dans le lien
    $categories = array();
    $categories[] = array("code" => "info", "nom" => "Informatique");
    $categories[] = array("code" => "vet", "nom" => "Vêtements");
    $categories[] = array("code" => "pap", "nom" => "Papeterie");

    var_dump($categories);
    ?>

    <ul>
        <h3>Liste de catégories de produits</h3>
        <!-- Ici je fais une boucle each pour parcourir toutes les catégories récupérées, pour créer un lien pour chacune
         Les params transmits dans le GET s'adaptent ainsi que le nom du lien -->
        <?php foreach ($categories as $categorie) : ?>
            <li><a href="listeProduits.php?categorie=<?= $categorie["code"] ?>"><?= $categorie["nom"] ?></a></li>
        <?php endforeach; ?>
    </ul>

</body>

</html>