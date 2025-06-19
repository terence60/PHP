<?php 

/* 

EXERCICE TP Dialogue :
----------

- Création d'un espace de dialogue / de tchat

- Etapes : 
    - 01 : Création de la BDD : dialogue 
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

echo "Espace de dialogue"; 

$host = "mysql:host=localhost;dbname=dialogue";
$login = "root";
$password = "root";
$options = array (
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
);
try {
    $pdo = new PDO ($host,$login,$password,$options);
} catch (Exception $e) {
    echo "ERREUR";
    exit;
}

var_dump($pdo);
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Espace de dialogue</title>
    <style>
        h2 {
            text-align: center;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h2>Espace de dialogue</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="nom" class="form-label">pseudo</label>
                <input type="text" class="form-control" id="pseudo" value="" name="nom">
            </div>
                <label for="message" class="form-label">votre message</label>
                <div class="form-floating">
                    <textarea class="form-control" placeholder="" id="message" style="height: 100px" name="message">
                </textarea>
                <label for="floatingTextarea2">Votre message</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">enregistrer</button>
        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>

</html>

<?php
$carteEnvoi = "";
$pseudo = "";
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $pseudo = isset($_POST['nom']) ? trim($_POST['nom']) : '';
    $texte = isset($_POST['message']) ? trim($_POST['message']) : '';

   
    if (empty($pseudo) || empty($texte)) {
        $message = '<div class="alert alert-danger">Tous les champs sont obligatoires.</div>';
    } elseif (mb_strlen($pseudo) > 300) {
        $message = '<div class="alert alert-danger">Le pseudo ne doit pas dépasser 300 caractères.</div>';
    }
   
    }



$stmt = $pdo->prepare("INSERT INTO * FROM commentaire WHERE id_commentaire");
$commentaire = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare("SELECT * FROM commentaire WHERE id_commentaire");
$commentaire = $stmt->fetchAll(PDO::FETCH_ASSOC);

