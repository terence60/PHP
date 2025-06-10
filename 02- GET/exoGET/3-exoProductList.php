<?php
session_start();

/* 

    EXERCICE GET : 
        Créer une page d'accueil de site ecommerce avec une liste de produit et page produit

            Etapes : 
                1 - Lancer l'instruction session_start(), cela vous donne accès à une superglobale nommée $_SESSION (c'est un array) qui peut stocker les données de votre choix et les transporter tout au long de la navigation 
                2 - Dans cette superglobale, à un indice [produits], insérer des données fictives dde produits, par exemple, id, nom, description, categorie, image (utilisez picsum pour générer des photos aléatoires) (cet array va représenter le retour d'une requête de selection en base de données)
                /////////////////////// 1 et 2 déjà fait //////////////////////////////



                3 - Créer une base de page html pour créer un affichage de liste des produits représentant les produits présents dans votre array session
                4 - Rajouter un menu de votre choix permettant de choisir la catégorie de produits
                5 - Créer une communication de votre choix par GET via ce menu ou filtre pour n'afficher que les produits d'une certaine catégorie
                6 - Sur chaque affichage produit, créer un bouton qui amènera sur la fiche produit (autre page) pour n'avoir que ce produit là d'affiché (utilisation de GET ici aussi)
                7 - Une fois l'exercice terminé, lancer l'instruction session_destroy();


*/



// Initialisation du tableau de produits
// if (!isset($_SESSION['produits'])) {

// images par lorem picsum
// Considérez votre liste de produits dans $_SESSION["produits"]
    $_SESSION['produits'] = [
        ['id' => 1, 'nom' => 'Laptop', 'description' => 'Un puissant laptop.', 'categorie' => 'Electronique', 'image' => 'https://picsum.photos/300/200?nature'],
        ['id' => 2, 'nom' => 'T-shirt', 'description' => 'T-shirt en coton bio.', 'categorie' => 'Vêtements', 'image' => 'https://picsum.photos/300/200?dog'],
        ['id' => 3, 'nom' => 'Tablette', 'description' => 'Tablette légère et rapide.', 'categorie' => 'Electronique', 'image' => 'https://picsum.photos/300/200?computer'],
        ['id' => 4, 'nom' => 'Jeans', 'description' => 'Jean slim stretch.', 'categorie' => 'Vêtements', 'image' => 'https://picsum.photos/300/200?tv'],
    ];
   
// }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des produits</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Produits</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Catégories
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <!-- Ici mes liens contenant un param get nommé categorie pour m'en servir afin d'affiner l'affichage sur telle ou telle catégorie -->
                            <li><a class="dropdown-item" href="?categorie=Electronique">Electronique</a></li>
                            <li><a class="dropdown-item" href="?categorie=Vêtements">Vêtements</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <?php 
        //  var_dump($_SESSION);
        // Si l'indice categorie existe dans GET
        if (isset($_GET['categorie'])) : ?>
            <h2 class="mb-4">Produits dans la catégorie : <?php echo $_GET['categorie']; ?></h2>
            <div class="row">
                <?php
                // Je parcours chaque produit dans $_SESSION["produits']
                // Si la catégorie du produit parcouru ($produit) correspond à la catégorie cliquée, je l'affiche ! Sinon non
                foreach ($_SESSION['produits'] as $produit) {
                    if ($produit['categorie'] === $_GET['categorie']) {
                        // var_dump($produit);
                        echo '
                            <div class="col-md-4 mb-4">
                                <div class="card h-100">
                                    <img src="' . $produit['image'] . '" class="card-img-top" alt="' . $produit['nom'] . '">
                                    <div class="card-body">
                                        <h5 class="card-title">' . $produit['nom'] . '</h5>
                                        <p class="card-text">' . $produit['description'] . '</p>
                                        <a href="3-exoProductDetails.php?id=' . $produit['id'] . '" class="btn btn-primary">Voir le produit</a>
                                    </div>
                                </div>
                            </div>';
                    }
                }
                ?>
            </div>
        <?php else : ?>
            <p class="text-muted">Sélectionnez une catégorie dans le menu pour afficher les produits correspondants.</p>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>