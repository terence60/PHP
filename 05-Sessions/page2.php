<?php

// Ici je reconnecte la session
session_start();

// Je remarque bien avec le var_dump que les informations insérées dans la page introSESSION.php sont bien présente
var_dump($_SESSION);


// Je peux donc gérer des conditions sur le contenu de $_SESSION
if ($_SESSION["connected_user"]["role"] == "admin") {
    echo $_SESSION["connected_user"]["pseudo"] . "est admin";
} else {
    echo $_SESSION["pseudo"] . "n'est PAS admin";
}