<?php

// ------------------------------------------------------------------------------
// ------------------------------------------------------------------------------
// ---------- PDO : PHP DATA OBJECT ---------------------------------------------
// ------------------------------------------------------------------------------
// ------------------------------------------------------------------------------

// PDO est une classe prédéfinie de PHP, elle représente une connexion à un serveur de BDD
// On va la manipuler avec MySQL mais on peut la manipuler avec d'autres SGBD 

// En quelques sortes, on peut considérer que PDO est une "porte" vers notre BDD 

echo "<h2>01 - Connexion à la BDD</h2>";

// Pour créer une connexion à la BDD nous avons besoin des informations suivantes : 
// - Host et nom de BDD
// - Login de connexion à la BDD (par défaut root)
// - Password de connexion pour ce login (sur mamp par défaut root)
// - Eventuellement des options (sous forme d'array)

$host = "mysql:host=localhost;dbname=entreprise";
$login = "root";
$password = "root"; // ici "root" pour mamp
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
);

// Création de l'objet PDO
try {
    $pdo = new PDO($host, $login, $password, $options);
} catch (PDOException $e) {
    echo "Erreur de BDD";
    exit;
}

var_dump($pdo);
    // object(PDO)[1] // Si je vois l'objet PDO, alors ça y est, je suis bien connecté à ma BDD

echo "<h2>02 - Requêtes de type action (INSERT / UPDATE / DELETE)</h2>";

// On va utiliser pendant ce chapitre la méthode "query" qui lance une rquête directement vers le serveur (un peu comme on les lance dans la console)
// ATTENTION !!!!!!!!!!!!!!! La méthode query nous rend vulnérable aux injections SQL !
// On utilisera plus bas dans le chapitre, la methode prepare() qui sera préférée pour lancer nos requêtes


// Enregistrement d'un nouvel employé dans la BDD 

// Je lance la méthode query qui me permet de lancer la requête de mon choix, ici un INSERT INTO la table employes
// $stmt = $pdo->query("INSERT INTO employes (prenom, nom, salaire, sexe, date_embauche, service) VALUES ('Pierral', 'Lacaze', 12000, 'm', CURDATE(), 'Web')");

// A chaque fois que je lance une requête sur un objet PDO, je récupère un résultat de type PDOStatement, c'est un objet qui représente un "jeu de résultats" SQL
// Sur ce PDOStatement, on a accès à diverses méthodes en rapport avec le jeu de résultat.
// Par exemple la méthode rowCount() qui me permet de savoir combien de lignes j'ai reçu dans le résultat ou combien de lignes sont impactées par ma requête
// Ici dans le cas d'une requête action insertion, une seule ligne
// echo "Nombres de lignes impactées par la requête : " . $stmt->rowCount() . "<hr>";


echo "<h2>03 - Requêtes de sélection pour une seule ligne de résultat</h2>";

$stmt = $pdo->query("SELECT * FROM employes WHERE id_employes = 994");
// le PDOStatement, représente le jeu de résultat ci dessous
// +-------------+---------+--------+------+---------+---------------+---------+
// | id_employes | prenom  | nom    | sexe | service | date_embauche | salaire |
// +-------------+---------+--------+------+---------+---------------+---------+
// |         994 | Pierral | Lacaze | m    | Web     | 2025-06-16    |   12000 |
// +-------------+---------+--------+------+---------+---------------+---------+
// 1 row in set (0.00 sec)

var_dump($stmt);
// Actuellement, je ne peux pas exploiter la réponse de la BDD, je n'ai accès à aucune information dans le PDOStatement sauf la requête qui est envoyée
// Pour la rendre exploitable, il faut "extraire" le résultat grâce à la méthode fetch()

// Plusieurs mode de fonctionnement pour fetch()
// La plus utilisée : FETCH_ASSOC : Pour récupérer un tableau associatif ! (nom des colonnes du résultat comme keys du array)
$data = $stmt->fetch(PDO::FETCH_ASSOC);
var_dump($data);
// array (size=7)
//   'id_employes' => int 994
//   'prenom' => string 'Pierral' (length=7)
//   'nom' => string 'Lacaze' (length=6)
//   'sexe' => string 'm' (length=1)
//   'service' => string 'Web' (length=3)
//   'date_embauche' => string '2025-06-16' (length=10)
//   'salaire' => float 12000

// FETCH_NUM : Pour récupérer un array indexé numériquement 
// $data = $stmt->fetch(PDO::FETCH_NUM);
// var_dump($data);
// array (size=7)
//   0 => int 994
//   1 => string 'Pierral' (length=7)
//   2 => string 'Lacaze' (length=6)
//   3 => string 'm' (length=1)
//   4 => string 'Web' (length=3)
//   5 => string '2025-06-16' (length=10)
//   6 => float 12000

// FETCH_BOTH : Pour récupérer à la fois les données en associatif et les données en numérique
// $data = $stmt->fetch(PDO::FETCH_BOTH);
// var_dump($data);

// FETCH_OBJ : Pour récupérer non pas un array mais un objet
// $data = $stmt->fetch(PDO::FETCH_OBJ);
// var_dump($data);

// Pour afficher Pierral
// Avec FETCH_ASSOC
echo "Prenom de l'employé : " . $data["prenom"];
// Avec FETCH_NUM
// echo "Prenom de l'employé : " . $data[1];
// Avec FETCH_OBJ
// echo "Prenom de l'employé : " . $data->prenom;


// RECAP 
    // TOUJOURS 3 étapes pour manipuler la base de données 
        // 1 ère étape : Création de l'objet PDO, il représente le lien d'accès vers ma base de données 
        // 2 ème étape : Lancement d'une requête sur l'objet PDO, je récupère un PDOStatement qui représente le jeu de résultat (non exploitable)
        // 3 ème étape : Je lance la méthode fetch() sur PDOStatement, je récupère un array(ou un objet) que je peux exploiter en PHP 

// Une ligne traitée avec fetch, n'existe plus dans la réponse, c'est pour ça que je ne peux pas refaire fetch plusieurs fois à la suite sur ce résultat à une seule ligne

echo "<h2>04 - Requêtes de sélection pour plusieurs lignes de résultat</h2>";

$stmt = $pdo->query("SELECT * FROM employes");

echo "Nombre d'employés : " . $stmt->rowCount() . "<hr>";

// fetch() ne traite qu'une seule ligne à la fois ! 
// A chaque fois que je l'appelle, il traite une ligne de plus et une autre et une autre, une par une ! 
// Pour traiter un résultat à plusieurs lignes avec fetch je peux faire une boucle ! 
// L'utilisation de la boucle while est judicieuse car elle tourne tant qu'il y a des résultats dans le stmt 
// fetch() me renvoie false lorsqu'il n'y a plus de résultats, donc la boucle s'arrête d'elle même

// $data = $stmt->fetch(PDO::FETCH_ASSOC);
// var_dump($data);
// echo "<hr>";
// $data = $stmt->fetch(PDO::FETCH_ASSOC);
// var_dump($data);
// echo "<hr>";
// $data = $stmt->fetch(PDO::FETCH_ASSOC);
// var_dump($data);
// echo "<hr>";
// $data = $stmt->fetch(PDO::FETCH_ASSOC);
// var_dump($data);
// echo "<hr>";
// $data = $stmt->fetch(PDO::FETCH_ASSOC);
// var_dump($data);
// echo "<hr>";
// $data = $stmt->fetch(PDO::FETCH_ASSOC);
// var_dump($data);
// echo "<hr>";

while($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
    var_dump($data);
    echo "<hr>";
}





    
       