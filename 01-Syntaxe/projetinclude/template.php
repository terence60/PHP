<?php
require_once("partials/_config.php"); // pas d'affichage ici !!!
require_once("partials/_functions.php"); // Ici non plus !!! 
// ATTENTION ne pas mettre de saut de ligne avant l'ouverture de la balise PHP, ni d'espace, ni dans les fichiers _config et _functions ! 
// Cela va initialiser la page et générer des problèmes



/////////////////////////////////////
// Le code PHP propre à chaque page
////////////////////////////////////


require_once("partials/_header.php"); // Début des affichages
require_once("partials/_nav.php"); // Certaines fonctions PHP ne vont plus fonctionner convenablement
?>
<!-- Begin page content -->
<main class="flex-shrink-0">
    <div class="container">
        <h1 class="mt-5">Page Template</h1>
    </div>
</main>

<?php
require_once("partials/_footer.php");