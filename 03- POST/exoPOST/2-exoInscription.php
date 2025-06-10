<?php

/*

    EXERCICE POST :
            Formulaire inscription utilisateur : 

                Etapes : 
                    - 1 Initialiser la session en lançant l'instruction session_start()
                    ////////////////// étape 1 faites //////////////////////////


                    - 2 Créer un formulaire POST pour une inscription utilisateur (pseudo, email, password, confirm password)
                    - 3 Controler ces informations reçues dans POST (taille pseudo, format email, longueur password et correspondance avec le confirm, vérifier si le pseudo n'est pas déjà pris)
                    - 4 Si tout est ok, hasher le mot de passe avec password_hash et insérer le user dans $_SESSION['users'] puis afficher un message de confirmation d'inscription
                    - 5 Si pas ok, afficher des messages d'erreur en rapport avec les problèmes de saisies

*/

session_start();
// session_destroy();

// Simulation de la "base de données" en tableau dans $_SESSION
if (!isset($_SESSION['users'])) {
    $_SESSION['users'] = [];
}

var_dump($_POST);

$errors = [];
$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["pseudo"], $_POST["email"], $_POST["password"], $_POST['password_confirm'])) {
    $pseudo = trim($_POST['pseudo']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $passwordConfirm = trim($_POST['password_confirm']);

    // Contrôles de validation
    if (empty($pseudo)) {
        $errors["pseudo"] = "Le pseudo est requis.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "L'email n'est pas valide.";
    }

    if (iconv_strlen($password) < 6) {
        $errors["password"] = "Le mot de passe doit faire au moins 6 caractères.";
    }

    if ($password !== $passwordConfirm) {
        $errors["passwordConfirm"] = "Les mots de passe ne correspondent pas.";
    }

    // Vérifier si l'utilisateur existe déjà
    foreach ($_SESSION['users'] as $user) {
        if ($user['pseudo'] === $pseudo) {
            $errors[] = "Le pseudo est déjà pris.";
            break;
        }
    }

    // Si pas d'erreurs, on enregistre l'utilisateur
    if (empty($errors)) {
        $hashedPassword = password_hash($password, PASSWORD_ARGON2ID);
        $_SESSION['users'][] = ['pseudo' => $pseudo, 'email' => $email, 'password' => $hashedPassword];
        $success = "Inscription réussie ! Vous pouvez maintenant vous connecter.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <h1>Inscription</h1>

                <!-- <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?> -->

                <?php if ($success): ?>
                    <div class="alert alert-success">
                        <?= $success ?>
                    </div>
                <?php endif; ?>

                <form action="" method="post">
                    <div class="mb-3">
                        <label for="pseudo" class="form-label">Pseudo</label>
                        <?php
                        if (isset($errors["pseudo"])) {
                            echo "<div class='alert alert-danger'>" . $errors["pseudo"] . "</div>";
                        }
                        ?>
                        <input type="text" class="form-control" id="pseudo" name="pseudo">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <?php
                        if (isset($errors["email"])) {
                            echo "<div class='alert alert-danger'>" . $errors["email"] . "</div>";
                        }
                        ?>
                        <input type="text" class="form-control" id="email" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <?php
                        if (isset($errors["password"])) {
                            echo "<div class='alert alert-danger'>" . $errors["password"] . "</div>";
                        }
                        ?>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="mb-3">
                        <label for="password_confirm" class="form-label">Confirmer le mot de passe</label>
                        <?php
                        if (isset($errors["passwordConfirm"])) {
                            echo "<div class='alert alert-danger'>" . $errors["passwordConfirm"] . "</div>";
                        }
                        ?>
                        <input type="password" class="form-control" id="password_confirm" name="password_confirm">
                    </div>
                    <button type="submit" class="btn btn-primary">S'inscrire</button>
                </form>
            </div>
        </div>
        <?php
        echo "<pre>";
        print_r($_SESSION["users"]);
        echo "</pre>";
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>