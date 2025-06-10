<?php
session_start();

if (isset($_GET['id'])) {
    // Si un id est présent dans l'url
    $id = $_GET['id'];

    // Je boucle, pour trouver le produit cliqué !
    foreach ($_SESSION['produits'] as $produit) {
        if ($produit['id'] == $id) {
            // ici $produitSelectionne correspond au produit cliqué !
            $produitSelectionne = $produit;
            break;
        }
    }

    // Si j'avais déjà une base de données, je lancerai une requête basée sur l'id reçu dans le get
    // SELECT * FROM products WHERE id_product = $id;
    // à partir de là je récupère directement le bon produit   $produit

}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détail du produit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container my-5">
        <div class="row">
            <!-- Si un produit a été trouvé, alors $produitSelectionne est défini et je rentre dans le if et j'affiche le produit ! -->
            <?php if (isset($produitSelectionne)) : ?>
                <div class="col-8 w-50 mx-auto">
                    <div class="card mb-3">
                        <img src="<?php echo $produitSelectionne['image']; ?>" class="card-img-top" alt="<?php echo $produitSelectionne['nom']; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $produitSelectionne['nom']; ?></h5>
                            <p class="card-text"><?php echo $produitSelectionne['description']; ?></p>
                            <p class="card-text"><small class="text-muted">Catégorie : <?php echo $produitSelectionne['categorie']; ?></small></p>
                        </div>
                    </div>
                </div>
                <!-- Si pas de produit trouvé avec l'id demandé, j'affiche ce message d'erreur -->
            <?php else : ?>
                <div class="alert alert-danger">Produit introuvable.</div>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>