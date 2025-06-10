<?php
session_start();

/* 

    EXERCICE GET : 
        Créer un tableau de gestion des utilisateurs back office 

            Etapes : 
                1 - Lancer l'instruction session_start(), cela vous donne accès à une superglobale nommée $_SESSION (c'est un array) qui peut stocker les données de votre choix et les transporter tout au long de la navigation 
                2 - Dans cette superglobale, à un indice [users], insérer des données fictives d'utilisateurs, par exemple, id, prenom, nom, email (cet array va représenter le retour d'une requête de selection en base de données)
                ///////////////////////// 1 et 2 déjà fait //////////////////////////


                
                3 - Créer une base de page html pour créer un tableau html représentant les utilisateurs présents dans votre array session
                4 - Rajouter une colonne "actions" dans laquelle vous insérerez des boutons de votre choix pour les actions "Voir" "Modifier" "Supprimer"
                5 - Créer une communication de votre choix par GET via ces boutons pour amener sur une ou plusieurs autres pages pour chaque bouton
                6 - Une fois l'exercice terminé, lancer l'instruction session_destroy();


*/

// Initialisation du tableau d'utilisateurs
// Considérez que vos users sont dans $_SESSION["users"]
if (!isset($_SESSION['users'])) {
    $_SESSION['users'] = [
        ['id' => 1, 'nom' => 'Dupont', 'email' => 'dupont@example.com'],
        ['id' => 2, 'nom' => 'Durand', 'email' => 'durand@example.com'],
        ['id' => 3, 'nom' => 'Martin', 'email' => 'martin@example.com'],
    ];
}

// Récupération des users dans la base de données 
// Si on avait une BDD en place, on lancerait des instructions spécifiques pour récupérer les utilisateurs
// SELECT * FROM users;
// =>   $users;
// On les récupèrerait dans une variable $users

// var_dump($_SESSION);
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des utilisateurs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container my-5">
        <h1 class="mb-4">Liste des utilisateurs</h1>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Ici je boucle sur $_SESSION["users"] représentant tous mes utilisateurs
                 A chaque tour de boucle, je crée une ligne avec dans chaque cellule du tableau, les informations du user
                 Et, dernière ligne, création des boutons/liens pour chaque action -->
                <?php foreach ($_SESSION['users'] as $user) : ?>
                    <tr>
                        <td><?php echo $user['id']; ?></td>
                        <td><?php echo $user['nom']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td>
                            <!-- Ici chaque bouton possède son propre param "action" me permettant de comprendre dans quel scénario je me trouve
                             Egalement, un param id  qui correspond à l'id de l'utilisateur en train d'être affiché -->
                            <a href="2-exoUser.php?action=voir&id=<?= $user['id']; ?>" class="btn btn-info btn-sm">Voir</a>
                            <a href="2-exoUser.php?action=modifier&id=<?= $user['id']; ?>" class="btn btn-warning btn-sm">Modifier</a>
                            <a href="2-exoUser.php?action=supprimer&id=<?= $user['id']; ?>" class="btn btn-danger btn-sm">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>