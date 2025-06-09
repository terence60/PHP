<?php
require_once("partials/_config.php");
require_once("partials/_functions.php");



/////////////////////////////////////
// Le code PHP propre à chaque page
////////////////////////////////////

// Récupération des saisies du formulaire
// Vérification de l'existence du compte utilisateur
// Vérification de la correspondance du mot de passe
// Initialisation de la session, maintenant identifiée




require_once("partials/_header.php"); // Début des affichages
require_once("partials/_nav.php"); // Certaines fonctions PHP ne vont plus fonctionner convenablement
?>
<!-- Begin page content -->
<main class="flex-shrink-0">
    <div class="container">
        <h1 class="mt-5">Connectez vous</h1>

        <form>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1">
  </div>
  <button type="submit" class="btn btn-primary">Connexion</button>
</form>

    </div>
</main>

<?php
require_once("partials/_footer.php");