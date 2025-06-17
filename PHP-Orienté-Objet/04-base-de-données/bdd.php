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
$password = ""; // ici "root" pour mamp
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
);

// Création de l'objet PDO
try {
    $pdo = new PDO($host, $login, $password, $options);
} catch (Exception $e) {
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

// while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
//     var_dump($data);
//     echo "<hr>";
// }

// Libre à nous d'interpréter les données comme on le souhaite ! 
// On oublie pas que la BDD relie le côté front et back du site, mais on manipule toujours la même donnée
// Je peux faire un affichage en petite carte côté front, et je peux faire un affichage type tableau de gestion en backoffice
// Deux affichages différents, deux manipulations différentes, mais on parle toujours de la même table employes


// Petites cartes employés

echo '<div style="display:flex; flex-wrap: wrap; justify-content: space-between">';

// | id_employes | prenom  | nom    | sexe | service | date_embauche | salaire |

// Chaque tour de boucle while me permet de récupérer les informations d'un employé, dans $data
while ($data = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
    <div style="margin-top: 20px; padding: 1%; width: 20%; background-color: steelblue; color:white">
        ID : <?= $data["id_employes"] ?> <br>
        Prenom : <?= $data["prenom"] ?> <br>
        Nom : <?= $data["nom"] ?> <br>
        Sexe : <?= $data["sexe"] ?> <br>
        Service : <?= $data["service"] ?> <br>
        Date d'embauche : <?= $data["date_embauche"] ?> <br>
        Salaire : <?= $data["salaire"] ?> <br>
    </div>
<?php endwhile;
echo '</div><br><br>';

$stmt = $pdo->query("SELECT * FROM employes");

// Ici on va afficher sous forme de tableau type interface de gestion
?>
<style>
    th,
    td {
        padding: 10px;
    }
</style>
<table border="1" style="border-collapse: collapse; width:100%">
    <tr>
        <th>Id employés</th>
        <th>Prénom</th>
        <th>Nom</th>
        <th>Sexe</th>
        <th>Service</th>
        <th>Date d'embauche</th>
        <th>Salaire</th>
        <th>Actions</th>
    </tr>
    <?php

    while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        foreach ($data as $valeur) {
            echo "<td>$valeur</td>";
        }
        echo "<td>Voir - Modifier - Supprimer</td>";
        echo "</tr>";
    }
    ?>
</table>
<?php


// Maintenant dans un tableau html qui s'adapte à la taille de notre requête (notre de colonne dynamique)
$stmt = $pdo->query("SELECT * FROM employes");
// Il existe de nombreuses methodes à PDO Statement
// Par exemple : rowCount() c'est le nombre de lignes
// Mais aussi columnCount() c'est le nombre de colonnes de ma requête
echo "Nombre de colonnes dans ma requête : " . $stmt->columnCount() . "<hr>";
// Il existe aussi une méthode getColumnMeta() qui prends en param un int correspondant à un chiffre de colonne, par exemple la première colonne du résultat porte le chiffre 0 (comme un array)
// Et cette méthode nous renvoie un array contenant des informations sur la colonne en cours
// Dans ce array est contenu un indice "name" qui indique le nom de la colonne
var_dump($stmt->getColumnMeta(0));
?>
<table border="1" style="border-collapse: collapse; width:100%">
    <tr>
        <?php
        // Chaque tour de boucle permet de récupérer une colonne dans le résultat et de créer un <th>
        for ($i = 0; $i < $stmt->columnCount(); $i++) {
            $infoColonne = $stmt->getColumnMeta($i);
            echo "<th>" . $infoColonne["name"] . "</th>";
        }
        ?>
    </tr>

    <?php
    // while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
    //     echo "<tr>";
    //     foreach ($data as $valeur) {
    //         echo "<td>$valeur</td>";
    //     }
    //     echo "</tr>";
    // }
    ?>
</table>
<?php

echo "<h2>05 - Requêtes de sélection pour plusieurs lignes de résultat avec fetchAll()</h2>";

// fetch() permet de traiter une seule ligne à la fois, j'ai donc la nécessité de faire une boucle pour avancer dans le résultat
// fetchAll() traite toutes les lignes en une seule fois sauf que l'on obtient un array à deux niveaux, premier niveau indexé numériquement, chaque indice correspond à un employé, lui même un array, cette fois ci associatif

$stmt = $pdo->query("SELECT * FROM employes");

$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

var_dump($data);
// Ci dessous une portion du résultat
// array (size=24)
//   0 => 
//     array (size=7)
//       'id_employes' => int 350
//       'prenom' => string 'Jean-pierre' (length=11)
//       'nom' => string 'Laborde' (length=7)
//       'sexe' => string 'm' (length=1)
//       'service' => string 'direction' (length=9)
//       'date_embauche' => string '2010-12-09' (length=10)
//       'salaire' => float 5000
//   1 => 
//     array (size=7)
//       'id_employes' => int 388
//       'prenom' => string 'Clement' (length=7)
//       'nom' => string 'Gallet' (length=6)
//       'sexe' => string 'm' (length=1)
//       'service' => string 'commercial' (length=10)
//       'date_embauche' => string '2010-12-15' (length=10)
//       'salaire' => float 2300


// Comment afficher Jean-Pierre ?
echo $data[0]["prenom"];




    
       