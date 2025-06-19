<?php

/* 

// Pour éviter les injections XSS (du code css et/ou js mis dans les commentaires)
// il est possible de modifier les carac notamment les < > qui représentent des balises.
// à l'affichage (voir en bas de page) on appelle htmlspecialchars() qui permet de transformer ces caractères problématiques en entités html
// exemple :
// <script>while(true){alert('truc');}</script>
// sera écrit dans le code source sous cette forme :
// &lt;script&gt;while(true){alert('truc');}&lt;/script&gt;

// Ci dessus une boucle infinie en JS, lançant une alert
// Ci dessous un style body display none qui ne nous permet plus d'intéragir avec le site web
// <style>body{display:none;}</style>

// Outils proche de htmlspecialchars() : htmlentities() / strip_tags()

// Pour tester les injections SQL, il faut lancer les requêtes en query
// Pour faire une injection par le champ message il faut : 
    // Saisir un pseudo valide
    // Ensuite faire bug le champ message via une quote/apostrophe '  pour clôturer le champ message
    // On termine ensuite la requête de façon classique avec la valeur NOW()); 
    // Pour ensuite lancer la requête de notre choix

    // Par exemple 
    // ', NOW()); DROP DATABASE dialogue;
    // Ci dessus la requête va supprimer notre base de données entière ! 

    // Il faudra toujours désactiver les messages d'erreurs de PDO et de PHP pour s'assurer que des informations sensibles ne transitent pas par eux par exemple nom de table, chemin physique d'accès serveur 

    // Même si les messages sont désactivés, une injection en aveugle en lançant l'instruction DO SLEEP(10) me permet de comprendre que le formulaire est sensible aux injections 

    // Si le form est sensible aux injections toute la base est compromise ! Récupération d'informations
    // En utilisant les methode SQL SELECT * INTO OUTFILE,   puis LOAD_FILE, je suis capable de stocker dans un fichier des informations récupérées d'une autre base, pour les réinsérer ailleurs sur une table sur laquelle j'ai la visibilité, idem on peut récupérer de cette manière le nom de la base de données



EXERCICE TP Dialogue :
----------

- Création d'un espace de dialogue / de tchat

- Etapes : 
    - 01 : Création de la BDD : dialogue              // A faire dans PHP My Admin
        - Table : commentaire
            - Champs de la table commentaire : 
                - id_commentaire        INT PK AI (Primary Key Auto Increment)
                - pseudo                VARCHAR 255
                - message               TEXT
                - date_enregistrement   DATETIME

    - 02 : Créer une connexion à cette base avec PDO (new PDO)
    - 03 : Création d'un formulaire html permettant de poster un message
        - Champs du formulaire : 
            - pseudo (input type="text")
            - message (textarea)
            - bouton de validation
    - 04 : Récupération des saisies du form avec contrôle (POST, contrôle sur les saisies)
    - 05 : Déclenchement d'une requête d'enregistrement pour enregistrer les saisies dans la BDD (insert)
    - 06 : Requête de récupération des messages afin de les afficher dans cette page (select)
    - 07 : Affichage des messages avec un peu de mise en forme
    - 08 : Affichage en haut des messages du nombre de messages présents dans la bdd
    - 09 : Affichage de la date en français
    - 10 : Amélioration du css
*/


// - 02 : Créer une connexion à cette base avec PDO (new PDO)
$host = "mysql:host=localhost;dbname=dialogue";
$login = "root";
$password = ""; // ici "root" pour mamp
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
);

// Création de l'objet PDO
try {
    $pdo = new PDO($host, $login, $password, $options);
    // var_dump($pdo);
} catch (Exception $e) {
    echo "Erreur de BDD";
    exit;
}

//    - 04 : Récupération des saisies du form avec contrôle (POST, contrôle sur les saisies)
// var_dump de POST pour vérifier que l'on reçoit bien les valeurs du formulaire
// Puis on enchaine sur un if SERVER REQUEST METHOD POST, et isset() sur tous les champs attendus (voir process sur introPOST.php chapitre POST)
// Ensuite on applique nos contrôles
// Par exemple, pseudo et message pas vide, pseudo pas trop court, message pas trop court

// var_dump($_POST);

$erreur = "";
$success = "";
$req = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["pseudo"], $_POST["message"])) {
    // echo "<h2>OK JE PASSE BIEN DANS LE IF DE POST</h2>";

    // Je récupère ici les valeurs du POST que je stocke dans des variables plus faciles à manipuler
    // J'applique un trim pour supprimer les espaces accidentels

    $pseudo = trim($_POST["pseudo"]);
    $message = trim($_POST["message"]);

    // Est ce que les deux champs sont bien saisis ?
    if (empty($pseudo) || empty($message)) {
        $erreur .= '<div class="alert alert-danger" role="alert">Attention tous les champs sont obligatoires !</div>';
    }

    // Est ce que le message n'est pas trop court ?
    if (iconv_strlen($message) < 5) {
        $erreur .= '<div class="alert alert-danger" role="alert">Attention le message est trop court !</div>';
    }

    // Est ce que le pseudo n'est pas trop court ?
    if (iconv_strlen($pseudo) < 3) {
        $erreur .= '<div class="alert alert-danger" role="alert">Attention le pseudo est trop court !</div>';
    }

    if (empty($erreur)) {
        // Si je rentre ici c'est que je n'ai pas d'erreurs !


        // - 05 : Déclenchement d'une requête d'enregistrement pour enregistrer les saisies dans la BDD (insert)
        // Si tous les contrôles sont bons, j'applique une dernière vérification (sur une variable $erreur ? peut être) pour savoir si j'enregistre ou pas
        // Si tout est ok, alors je peux lancer sur pdo une requête insert into des éléments reçus du formulaire
        try {

            // Si ici, je laisse ma requête s'exécuter avec query, alors je suis sensible aux injections SQL
            // C'est gravissime !!! TOUTE MA BASE EST COMPROMISE SI UN FORM EST SENSIBLE AUX INJECTIONS !
            // Le pirate peut supprimer, ma table, récupérer des données d'autres tables de ma base, même supprimer la base entière !
            // Si pas de sauvegarde de mon côté... Tout est perdu ! 

            // Toujours bon de mettre un sleep(1) (une seconde) sur tout traitement, cela évite les attaques de force brute qui risque de surcharger le serveur et sa bande passante
            sleep(1);
            $req = "INSERT INTO commentaire (pseudo, message, date_enregistrement) VALUES ('$pseudo', '$message', NOW())";
            // $stmt = $pdo->query($req);
            $stmt = $pdo->prepare("INSERT INTO commentaire (pseudo, message, date_enregistrement) VALUES (:pseudo, :message, NOW())");
            $stmt->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
            $stmt->bindParam(':message', $message, PDO::PARAM_STR);
            $stmt->execute();


            $success .= '<div class="alert alert-success" role="alert">Message enregistré !</div>';
        } catch (Exception $e) {
            $erreur .= '<div class="alert alert-danger" role="alert">Attention le pseudo est trop court !</div>';
        }
    }
}


// - 06 : Requête de récupération des messages afin de les afficher dans cette page (select)
// Il faut lancer une requête de selection de l'intégralité des messages de la table
$stmt = $pdo->query("SELECT pseudo, message, DATE_FORMAT(date_enregistrement, '%d/%m/%Y %T') AS date_fr FROM commentaire ORDER BY date_enregistrement DESC");
// On peut ensuite soit fetchAll() ici ou bien faire un while() de fetch plus bas dans l'affichage (dans le html, après le form)
$nbrMessages = $stmt->rowCount();
$commentaires = $stmt->fetchAll(PDO::FETCH_ASSOC);

// var_dump($commentaires);


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <!-- Google font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <!-- Playfair display -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&display=swap" rel="stylesheet">
    <!-- Roboto -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        * {
            font-family: 'Roboto', sans-serif;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Playfair Display', serif;
        }
    </style>

    <title>Dialogue</title>
</head>

<body class="bg-secondary">
    <div class="container bg-light g-0">
        <div class='row '>
            <div class="col-12">
                <h2 class="text-center text-dark fs-1 bg-light p-5 border-bottom"><i class="far fa-comments"></i> Espace de dialogue <i class="far fa-comments"></i></h2>

                <!-- - 03 : Création d'un formulaire html permettant de poster un message -->
                <!-- - Champs du formulaire : 
                            - pseudo (input type="text")
                            - message (textarea)
                            - bouton de validation -->
                <!-- On oublie pas l'attribut method post dans la balise form -->
                <!-- On oublie pas les name dans les input/textarea sinon PHP ne pourra pas récupérer les saisies -->

                <form method="post" class="mt-5 mx-auto w-50 border p-3 bg-white">

                    <!-- Affichage des erreurs -->
                    <?= $erreur ?>
                    <?= $success ?>
                    <?= $req ?>

                    <hr>
                    <div class="mb-3">
                        <label for="pseudo" class="form-label">Pseudo <i class="fas fa-user-alt"></i></label>
                        <input type="text" class="form-control" id="pseudo" name="pseudo">
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message <i class="fas fa-feather-alt"></i></label>
                        <textarea class="form-control" id="message" name="message"></textarea>
                    </div>
                    <div class="mb-3">
                        <hr>
                        <button type="submit" class="btn btn-secondary w-100" id="enregistrer" name="enregistrer"><i class="fas fa-keyboard"></i> Enregistrer <i class="fas fa-keyboard"></i></button>
                    </div>
                </form>

                <!-- - 07 : Affichage des messages avec un peu de mise en forme -->
                <!-- Ici affichage des messages avec soit boucle while qui lance fetch, soit boucle foreach si j'ai fais un fetchAll plus haut -->
                <p class="w-75 mx-auto mb-3">
                    Il y a : <b><?= $nbrMessages ?></b> messages.
                </p>
                <?php
                foreach ($commentaires as $commentaire) : ?>
                    <div class="card w-75 mx-auto mb-3">
                        <div class="card-header bg-dark text-white">
                            <!-- Ici htmlspecialchars me permet de me protéger de l'interprétation de code html css js, je ne souhaite pas que dans les messages et pseudo de l'utilisateur, il y est du code interprété (alert JS, style css ou autre) -->
                            <?php echo "Par : " . htmlspecialchars($commentaire["pseudo"]) . " le : " . $commentaire["date_fr"] ?>
                        </div>
                        <div class="card-body">
                            <p class="card-text"><?= htmlspecialchars($commentaire["message"]) ?></p>
                        </div>
                    </div>
                <?php endforeach;
                ?>
            </div>
        </div>
    </div>


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>