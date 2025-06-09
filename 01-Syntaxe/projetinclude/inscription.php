<?php
require_once("partials/_config.php");
require_once("partials/_functions.php");



/////////////////////////////////////
// Le code PHP propre à chaque page
////////////////////////////////////

// Récupération des informations du formulaire
// Controle des saisies (longueur de pseudo, format d'email, longueur du mot de passe)
// Vérification que le compte utilisateur n'existe pas déjà
// Chiffrement des données
// Insertion en base de données
// Redirection vers la page de connexion


$erreur = "";

// if (iconv_strlen($pseudo) < 4) {
//     $erreur .= '<div class="alert alert-danger" role="alert">
//   Le pseudo est trop court ! Au moins 4 caractères !
// </div>';
// }

// dump($erreur);


require_once("partials/_header.php"); // Début des affichages
require_once("partials/_nav.php"); // Certaines fonctions PHP ne vont plus fonctionner convenablement
?>
<!-- Begin page content -->
<main class="flex-shrink-0">
    <div class="container">
        <h1 class="mt-5">Inscrivez vous</h1>

        <form>
            <?= $erreur ?>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Pseudo</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nom</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Acceptez les conditions</label>
            </div>
            <button type="submit" class="btn btn-primary">S'inscrire</button>
        </form>
    </div>
    </div>
</main>

<?php
require_once("partials/_footer.php");
