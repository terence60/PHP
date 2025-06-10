<?php

/*
// Le but ici étant de faire communiquer les inscrits de l'exercice 2 avec la connexion de cet exercice 3 


    EXERCICE POST :
            Formulaire connexion utilisateur : 

                Etapes : 
                    - 1 Initialiser la session en lançant l'instruction session_start()
                    ///////////////////////// Etape 1 OK ////////////////////////////


                    - 2 Créer un formulaire POST pour une connexion utilisateur (pseudo, password)
                    - 3 Controler ces informations reçues dans POST pour un contexte de connexion, c'est à dire de vérifier si l'utilisateur existe bien, et dans un second temps de vérifier la correspondance du mot de passe saisi avec le mot de passe crypté via la fonction password_verify()
                    - 4 Si tout est ok, afficher un message à l'utilisateur et stocker dans $_SESSION['connected_user']  les informations de l'utilisateur actuellement connecté
                    - 5 Si pas ok, afficher un message d'erreur indiquant que la saisie est incorrecte

*/

session_start();


$loginError = "";
$loginSuccess = ""; // Message de connexion réussie

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["pseudo"], $_POST["password"])) {

    $pseudo = trim($_POST['pseudo']);
    $password = trim($_POST['password']);

    // Vérification des informations d'identification
    foreach ($_SESSION['users'] as $user) {
        // Si je tombe dans le if ci dessous c'est que le user existe (la saisie du form correspond à un user dans mon array)
        if ($user['pseudo'] === $pseudo) {

            // La ligne ci dessous permet de vérifier le $password du formulaire avec le $user["password"] du array, renvoie true si les deux se correspondent
            // password_verify est capable de comparer un password "clair" avec un password hashé
            if (password_verify($password, $user['password'])) {

                // Si on tombe ici alors on considère l'utilisateur comme "identifié"
                // Dans ce cas, on stocke dans la session $_SESSION toutes les informations de l'utilisateur, comme ça nous pourrons nous en resservir plus tard
                // On aura son pseudo/nom/prenom ou autre pour de l'auto complétion
                // Si on gère des "roles" admin, member, modérateur ou autre, on sera capable aussi de les vérifier à ce niveau là

                $_SESSION['connected_user'] = $user; // On stocke les infos de l'utilisateur dans la session
                $loginSuccess = "Connexion réussie. Bienvenue, $pseudo !";
                break;
            }
        }
    }

    if (empty($loginSuccess)) {
        $loginError = "Pseudo ou mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <h1>Connexion</h1>
                <h3>Bonjour <?= $_SESSION["connected_user"]["pseudo"] ?></h3>

                <?php if ($loginError): ?>
                    <div class="alert alert-danger"><?= $loginError ?></div>
                <?php endif; ?>

                <?php if ($loginSuccess): ?>
                    <div class="alert alert-success"><?= $loginSuccess ?></div>
                <?php endif; ?>

                <form action="" method="post">
                    <div class="mb-3">
                        <label for="pseudo" class="form-label">Pseudo</label>
                        <input type="text" class="form-control" id="pseudo" name="pseudo" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Se connecter</button>
                </form>
            </div>
        </div>
        <?php var_dump($_SESSION); ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
