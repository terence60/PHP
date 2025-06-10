<?php 


// Les cookies sont des petits fichiers de données que les serveurs Web stockent sur l'ordinateur d'un utilisateur via le navigateur. Ils permettent aux applications web de conserver des informations d'une session à une autre, telles que les préférences d'un utilisateur ou les informations de session, même après la fermeture du navigateur ou la déconnexion de l'utilisateur. En PHP, les cookies sont gérés via la superglobale $_COOKIE.

// Syntaxe et manipulation des cookies en PHP
// 1. Création d'un cookie :
// Pour créer un cookie en PHP, on utilise la fonction setcookie(). Elle doit être appelée avant tout contenu HTML, car les cookies sont envoyés dans l'en-tête HTTP.

// // setcookie(name, value, expire, path, domain, secure, httponly);

// name : Nom du cookie (obligatoire).
// value : Valeur du cookie (obligatoire).
// expire : Timestamp de la date d'expiration. Par défaut, un cookie expire à la fermeture du navigateur, mais tu peux le rendre persistant.
// path : Chemin sur le serveur où le cookie sera accessible. Par défaut, il est accessible sur toute l'application.
// domain : Domaine pour lequel le cookie est valable. Par exemple, .mon-site.com rendrait le cookie accessible sur tous les sous-domaines.
// secure : Si défini à true, le cookie sera envoyé uniquement via HTTPS.
// httponly : Si défini à true, le cookie ne sera pas accessible via JavaScript (protection contre les attaques XSS).

// La lecture d'un cookie 
    // On appelle les cookies via la superglobale $_COOKIE
    // Comme GET et POST, c'est un array ! Qui contient des informations sur tous les cookies rattaché à notre serveur.

// Contexte d'utilisation des cookies

//     Connexion automatique : Les cookies peuvent mémoriser les informations de connexion d'un utilisateur pour qu'il n'ait pas à se reconnecter à chaque visite.
//     Personnalisation : Les préférences de langue, de thème ou de paramètres sont souvent stockées dans des cookies pour que le site s'adapte automatiquement à l'utilisateur.
//     Suivi des utilisateurs : Les cookies sont utilisés pour suivre les sessions utilisateurs ou les habitudes de navigation (souvent pour la publicité ciblée).

// Création d'un cookie qui dure 7 jours, avec le thème par défaut "clair"
if (!isset($_COOKIE['theme'])) {
    setcookie("theme", "clair", time() + (7 * 24 * 60 * 60));
}

var_dump($_COOKIE);

// Modifier la valeur du cookie en fonction du thème sélectionné via les liens
if (isset($_GET['theme'])) {
    $selectedTheme = $_GET['theme'];
    setcookie("theme", $selectedTheme, time() + (7 * 24 * 60 * 60));
    // Rechargement de la page pour appliquer immédiatement le changement de thème
    header("Location: introCOOKIE.php");
    exit;
}

// Lecture du cookie et application du thème
// $theme = $_COOKIE['theme'] ?? 'clair';
if (isset($_COOKIE["theme"])) {
    $theme = $_COOKIE["theme"];
    setcookie("theme", $theme, time() + (7 * 24 * 60 * 60));
} else {
    $theme = 'clair';
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exemple de gestion de thème avec cookie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: <?= $theme === 'sombre' ? '#333' : '#fff'; ?>; color: <?= $theme === 'sombre' ? '#fff' : '#000'; ?>;">
    <div class="container mt-5">
        <h1>Choisir un thème</h1>
        <p>
            <a href="?theme=clair" class="btn btn-light <?= $theme === 'clair' ? 'disabled' : ''; ?>">Thème Clair</a>
            <a href="?theme=sombre" class="btn btn-dark <?= $theme === 'sombre' ? 'disabled' : ''; ?>">Thème Sombre</a>
        </p>
        <p>Thème actuel : <strong><?= ucfirst($theme) ?></strong></p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>