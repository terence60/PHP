<?php
/* 

Le protocole POST est, avec GET, le deuxième protocole principal de communication entre un navigateur et un serveur web.
GET nous permet de récupérer des informations par les URL
POST nous permet de récupérer des informations par les formulaires.

POST est un outil plus "puissant" que GET, parcequ'il n'a pas de limite de taille d'envoie, contrairement à GET qui est limité à la taille d'une URL 
Aussi parcequ'il me permet d'envoyer des pièces jointes et aussi car il est invisible pour l'utilisateur.
POST passe par un protocole sécurisé uniquement côté serveur.

Pour faire fonctionner un formulaire en POST, il faut absolument spécifier dans la balise form, l'attribut method="POST", sinon par défaut il est en protocole GET

Egalement, il faut que chaque input/textarea/select/radio etc, possède bien l'attribut "name" sinon, cet élément ne sera pas transmit au PHP

On privilégie POST pour l'envoi de données sensibles, car les informations seront sécurisées et non visible.

Contexte d'utilisation de POST :

    - Formulaire d'inscription et de connexion : Lorsqu'un utilisateur soumet ses informations de connexion ou d'inscription, toujours préférable d'utiliser POST pour ne pas avoir le password visible dans l'url... 

    - Telechargement de fichiers 

    - Enregistrement en base données 

    - Système de paiement 

*/

var_dump($_POST);

// Ici double vérification, on s'assure que nous possédons bien toutes les valeurs attendues dans le formulaire (nom, email, message)
// Egalement, seconde vérification, on s'assure que la methode POST soit bien engagée 
// $_SERVER est une globale contenant plein d'informations, notamment si on se trouve en method POST ou GET

$erreur = "";

$carteEnvoi = "";

$nom = "";
$email = "";
$message = "";

if (isset($_POST["nom"], $_POST["email"], $_POST["message"]) && $_SERVER["REQUEST_METHOD"] === "POST") {


    // On mets dans des variables plus facile d'utilisation, les éléments venant du POST 
    // On en profite pour déjà appliquer des "controles", ici on va "trim" les données, c'est à dire qu'on va supprimer les espaces en début et en fin de chaine de caractères

    $nom = trim($_POST["nom"]);
    $email = trim($_POST["email"]);
    $message = trim($_POST["message"]);


    // Conditions d'erreurs
    // Est ce que tous les champs ont été saisis ?
    if (empty($nom) || empty($email) || empty($message)) {
        // On insère dans la variable $erreur, un message d'erreur
        $erreur .= '<div class="alert alert-danger" role="alert">
  Attention tous les champs sont obligatoires !
</div>';
    }

    // Est ce que l'email est vraiment d'un format valide ?
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreur .= '<div class="alert alert-danger" role="alert">
  Attention le format d\'email n\'est pas valide !
</div>';
    }

    // Est ce que le message n'est pas trop court ?
    if (iconv_strlen($message) < 5) {
        $erreur .= '<div class="alert alert-danger" role="alert">
  Attention le message est trop court !
</div>';
    }

    // Si $erreur est vide, c'est à dire qu'aucune erreur n'a été rencontrée
    // Dans ce cas, je peux poursuivre mon traitement (un enregistrement en bdd, un envoi d'email, un process de connexion ou autre)
    if (empty($erreur)) {
        // J'insère dans la variable $carteEnvoi, les informations reçues dans le form et mise en forme dans une "card"
        $carteEnvoi = "<div class='card'>
  <div class='card-header'>
    <h5>Informations reçues</h5>
  </div>
  <div class='card-body'>
    <p class='card-text'><strong>Nom : </strong> $nom</p>
    <p class='card-text'><strong>Email : </strong> $email</p>
    <p class='card-text'><strong>Message : </strong> $message</p>
  </div>
</div>";

        $nom = "";
        $email = "";
        $message = "";
    }
}



?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Formulaire avec POST</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1>Contactez-nous</h1>

        <form method="POST">
            <!-- Ci dessous l'affichage des erreurs s'il y en a -->
            <?= $erreur ?>
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" value="<?= $nom ?>" name="nom">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Adresse email</label>
                <input type="email" class="form-control" id="email" value="<?= $email ?>" name="email">
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <div class="form-floating">
                    <textarea class="form-control" placeholder="Leave a comment here" id="message" style="height: 100px" name="message">
                    <?= $message ?>
                </textarea>
                    <label for="floatingTextarea2">Votre message</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>

        <!-- Ici l'affichage du message si toutes les saisies sont valides -->
        <?= $carteEnvoi ?>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>

</html>