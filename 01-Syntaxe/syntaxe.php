<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrainement - Syntaxe PHP</title>
    <style>
        h2 {
            background-color: steelblue;
            color: white;
            padding: 20px;
        }

        .container {
            width: 1000px;
            border: 1px solid;
            margin: 0 auto;
            padding: 20px;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Syntaxe PHP</h2>

        <!-- 
            Il est possible d'écrire de l'html dans un fichier.php
            En revanche, l'inverse n'est pas possible ! (un fichier .html ne transitera pas par l'interpréteur PHP)        
        -->

        <?php
        // Ouverture de la balise PHP 

        // Commentaire sur une ligne
        # Commentaire sur une ligne
        /* 
        Commentaire
        Entre les deux
        indicateurs
    */

        // La documentation officielle : 
        //  https://www.php.net/

        // Les bonnes pratiques de développement 
        //  https://phptherightway.com/


        echo "<h2>01 - Instructions d'affichage</h2>";
        // echo est une instruction du langage permettant de générer un affichage

        // ATTENTION, chaque instruction en PHP doit se terminer par un ";"

        echo "Bonjour";
        echo " à tous";
        echo "<br>";

        print "Nous sommes lundi<br>"; // Autre instruction permettant de générer un affichage
        // Dans le cadre du cours nous utiliserons toujours echo 

        echo "<h2>02 - Variables : déclaration / affectation / type</h2>";

        // Une variable est un espace nommé permettant de conserver une valeur 
        // Une variable se déclare en php avec le signe $ 
        // Caractères autorisés : a-z A-Z 0-9 _ 
        // ATTENTION PHP est sensible à la casse, c'est à dire une majuscule est différente d'une minuscule  $var  $Var sont des variables différentes 
        // Une variable ne peut pas commencer par un chiffre

        // On utilise généralement la convention camelCase pour nommer les variables 
        $uneVariableTropBien;

        // Il existe d'autres conventions de nommage 
        // le snake_case : un tiret-bas/underscore entre chaque mot
        // le PascalCase : Majuscule à chaque mot
        // le kebab-case : tiret entre chaque mot

        // gettype() est une fonction de prédéfinie (déjà inscrite au langage) permettant de nous renvoyer une chaine de caractère représentant le type d'une variable

        $a = 123; // Déclaration de la variable nommée 'a' et affectation de la valeur numérique 123
        echo $a;
        echo gettype($a); // Integer = un entier
        echo "<br>";

        $a = 1.5; // On change la valeur contenue dans la variable $a, la précédente valeur est écrasée 
        echo $a;
        echo gettype($a); // un double ou float = chiffre décimal 
        echo "<br>";

        $a = "Une chaine";
        echo $a;
        echo gettype($a); // string = une chaine de caractères 
        echo "<br>";

        $a = true;
        echo $a; // Nous renvoie 1 car true = 1 = existe, les booléens ne sont pas sensibles à la casse
        echo gettype($a); // boolean // vrai ou faux // 1 ou 0 
        echo "<br>";

        // Il reste deux autres types que l'on verra sur des chapitres spécifiques : les tableaux array et les objets 

        echo "<h2>03 - Concaténation</h3>";
        // La concaténation consiste à assembler des chaines de caractères les unes avec les autres 
        // Caractère de concaténation : le point . 
        // Il est aussi possible de concaténer avec la virgule ,  

        // Le caractère de concaténation peut toujours se traduire par "suivi de"

        $x = "Bonjour";
        $y = "tout le monde";

        // Sans concaténation 
        echo $x;
        echo " ";
        echo $y;
        echo "<br>";

        // Avec concaténation
        echo $x . " " . $y . "<br>";

        // Concaténation avec la virgule (ne fonctionne pas avec print)
        echo $x, " ", $y, "<br>";

        // Concaténation en même temps qu'une affectation (pour rajouter une valeur à une variable déjà existante)
        $prenom = "Pierre";
        $prenom = "Alexandre"; // Ici on écrase la valeur Pierre par Alexandre... 
        echo $prenom . "<br>";

        // Pour rajouter sans écraser 
        $prenom = "Pierre";
        $prenom = $prenom . "-Alexandre";
        echo $prenom . "<br>";

        // Raccourci d'écriture 
        $prenom = "Pierre";
        $prenom .= "-Alexandre"; // avec le .= on rajoute sans écraser 
        echo $prenom . "<br>";

        echo "<h2>04 - Guillemets de apostrophes</h2>";

        $x = "Bonjour";
        $y = "tout le monde";

        // Dans des guillemets, une variable est reconnue et donc, est interprétée !
        // Dans les apostrophes, une variable ne sera pas reconnue et traitée comme du simple texte

        echo "$x $y <br>";
        echo '$x $y <br>';

        echo "<h2>05 - Constantes</h2>";
        // Une constante comme une variable permet de conserver une valeur
        // Cependant, comme son nom l'indique, cette valeur restera... constante ! 
        // Par convention d'écriture, une constant s'écrit tout en majuscule 

        // déclaration d'une variable globale 
        define("URL", "http://localhost/DWWM0225/PHP/");
        echo URL . "<br>";

        // define("URL", "autre chose"); // ERREUR, la constante URL existe déjà 
        // Impossible de redéfinir une constante 

        // Constantes magiques 
        // Déjà inscrites au langage 

        echo __FILE__ . '<br>'; // le chemin absolu depuis le serveur vers ce fichier 
        echo __LINE__ . '<br>'; // le numéro de ligne
        echo __DIR__ . '<br>'; // le chemin vers le dossier contenant ce fichier 

        echo "<h2>Exercice variables</h2>";

        // Créer 3 variables et leur assigner respectivement les valeurs suivantes : bleu, blanc et rouge 
        // Une variable par couleur 
        // Ensuite il faut générer un affichage avec un seul echo pour obtenir : 
        // bleu - blanc - rouge 
        // Plusieurs façons sont possibles, le but étant de trouver la plus courte :) 

        $bleu = "bleu";
        $blanc = "blanc";
        $rouge = "rouge";

        // $drapeau = "";
        // $drapeau .= $bleu . " - ";

        echo $bleu . " - " . $blanc . " - " . $rouge . "<br>";
        echo "$bleu - $blanc - $rouge <br>";
        echo "le type de la variable \$bleu est : " . gettype($bleu);

        echo "<h2>Opérateurs arithmétiques</h2>";

        $a = 10;
        $b = 5;

        // Addition :
        echo $a + $b . "<br>"; // Affiche 15
        // Soustraction : 
        echo $a - $b . "<br>"; // Affiche 5
        // Multiplication : 
        echo $a * $b . "<br>"; // Affiche 50
        // Division : 
        echo $a / $b . "<br>"; // Affiche 2
        // Puissance : 
        echo $a ** $b . "<br>"; // Affiche 100 000
        // Modulo (%): 
        echo $a % $b . "<br>"; // Affiche 0
        // Modulo : 
        echo $a % 6 . "<br>"; // Affiche 4

        // Opération / affection
        $a += $b; // équivaut à écrire $a = $a + $b;
        $a -= $b; // équivaut à écrire $a = $a - $b;
        $a *= $b; // équivaut à écrire $a = $a * $b;
        $a /= $b; // équivaut à écrire $a = $a / $b;
        $a **= $b; // équivaut à écrire $a = $a ** $b;
        $a %= $b; // équivaut à écrire $a = $a % $b;

        echo "<h2>06 - Conditions & opérateurs de comparaison </h2>";

        // if / elseif / else 
        $x = 10;
        $y = 5;
        $z = 2;

        if ($x > $y) { // si la valeur de x est strictement supérieure à la valeur de y
            echo "Vrai, la valeur de x est bien strictement supérieure à la valeur de y<br>";
        } else {
            echo "Faux<br>";
        }

        // Plusieurs conditions obligatoires : AND => && 
        if ($x > $y && $y < $z) {
            echo "OK pour les deux conditions<br>";
        } else {
            echo "L'une ou l'autre des conditions ou les deux sont fausses<br>";
        }

        // L'une ou l'autre d'un ensemble de conditions : OR => ||
        if ($x > $y || $y < $z) {
            echo "OK pour au moins une des deux conditions<br>";
        } else {
            echo "Toutes les conditions sont fausses<br>";
        }

        // Seulement l'une ou l'autre des conditions (ou exclusif), si les deux sont bonnes la condition n'est pas remplis, si les deux sont fausses, non plus ! Il en faut une seule de bonne
        if ($x > $y xor $y > $z) {
            echo "Ok pour une seule et unique condition<br>";
        } else {
            echo "Toutes les conditions sont fausses ou sont vraies<br>";
        }

        // if / elseif / else 
        $x = 10;
        $y = 5;
        $z = 2;

        if ($x == 8) { // si x est égal à 8
            echo "Réponse A<br>";
        } elseif ($x != 10) { // si x est différent de 10
            echo "Réponse B<br>";
        } elseif ($y == $z) { // si y est égal à z
            echo "Réponse C<br>";
        } else { // sinon
            echo "Réponse D<br>";
        }
        // C'est la réponse D, aucune des conditions n'est rencontrée

        // Testons avec $x = 8
        $x = 8;
        $y = 5;
        $z = 2;

        if ($x == 8) { // si x est égal à 8
            echo "Réponse A<br>";
        } elseif ($x != 10) { // si x est différent de 10
            echo "Réponse B<br>";
        } elseif ($y == $z) { // si y est égal à z
            echo "Réponse C<br>";
        } else { // sinon
            echo "Réponse D<br>";
        }

        // C'est la réponse A, ici on peut considérer le if et ses elseif et le else comme étant un seul et même bloc
        // Dès la première condition rencontrée et valide, on sort du bloc entier ! 
        // Même si la condition de la réponse B est bonne, on sort dès la réponse A ! 

        // Comparaison stricte 
        $a1 = 1;
        echo gettype($a1);
        echo "<br>";
        $a2 = '1';
        echo gettype($a2);
        echo "<br>";


        // Comparaison des valeurs uniquement
        if ($a1 == $a2) {
            echo "OK, les deux var ont la même valeur<br>";
        } else {
            echo "Non, ces deux variables ont des valeurs différentes<br>";
        }

        // Comparaison des valeurs et des types
        if ($a1 === $a2) {
            echo "OK, les deux var ont la même valeur et le même type<br>";
        } else {
            echo "Non, ces deux variables ont des valeurs et/ou des types différents<br>";
        }

        /*
            Opérateurs de comparaison
            ------------------------------
            =       affectation (ce n'est pas un opérateur de comparaison, c'est une affectation)
            ==      est égal à
            !=      est différent de
            ===     est strictement égal à (valeur et type)
            !==     est strictement différent de (valeur et/ou type différent)
            >       strictement supérieur à
            >=      supérieur ou égal à
            <       strictement inférieur à
            <=      inférieur ou égal
        */

        // Autres possibilités de syntaxe pour les if 
        if ($a1 === $a2) {
            echo "OK, les deux var ont la même valeur et le même type<br>";
        } // Si je n'ai pas besoin de gérer de else, je peux l'omettre

        // Je peux ne pas mettre les accolades ! Par contre je suis limité à une seule instruction dans le if et une seule dans le else
        if ($a1 === $a2) echo "OK<br>";
        else echo "Non<br>";

        // Syntaxe ci dessous n'utilise pas d'accolades mais utilise ":" et le "endif"
        // On s'en sert lorsque l'on a besoin d'écrire de gros blocs HTML à l'intérieur de nos conditions PHP
        // Cela nous évite d'écrire tout dans un echo, on peut ainsi garder la colorisation de notre éditeur de code
        if ($a1 === $a2) : ?>
            OK, les deux var ont la même valeur et le même type<br>
            <h3>je suis dans le if</h3>
            <ul>
                <li>Un</li>
                <li>Deux</li>
                <li>Trois</li>
            </ul>
        <?php else : ?>
            Non, ces deux variables ont des valeurs et/ou des types différents<br>
            <h3>je suis dans le else</h3>
            <ul>
                <li>Quatre</li>
                <li>Cinq</li>
                <li>Six</li>
            </ul>
        <?php endif;

        // Ecriture ternaire
        echo ($a1 === $a2) ? "OK, les deux var ont la même valeur et le même type<br>" : "Non, ces deux variables ont des valeurs et/ou des types différents<br>";

        echo ($a1 === $a2) ? "OK <br>" : "Non <br>";
        // Le but d'un if ternaire est de réalisé un if très très court, lorsque l'action du if et du else sont les mêmes (ici un echo dans les deux cas)
        // On commence par l'action (echo pour nous), suivi de la condition entre parenthèses, puis du "?" qui indique que nous débutons un if, puis suivi du code si la condition est rencontrée, et après les ":" si on tombe dans le else 

        // Couplés aux if, on utilise deux fonctions très importantes en PHP
        // isset() et empty()


        // isset() me permet de vérifier si un élément existe (souvent une variable, basée sur un retour utilisateur, un formulaire par exemple)
        // empty() me permet de vérifier si un élément est vide ou pas (vérifier si une saisie a bien été réalisée)

        // Valeurs supposées reçues d'un formulaire, un pseudo et un password
        $pseudo = "Bob";
        $password = "soleil";

        echo $error;

        // Je rentre dans ce if, uniquement si ces deux valeurs existent bel et bien !
        // isset me renvoie "true" si la variable existe
        if (isset($pseudo) && isset($password)) {
            echo "J'ai bien reçu un pseudo et un password du formulaire<br>";

            if (empty($pseudo) || empty($password)) {
                echo "Attention vous devez bien saisir le pseudo et le password<br>";
            }
        } else {
            echo "L'une ou l'autre des variables n'existe pas... :(  <br>";
        }

        // supposons la var suivante récupérée d'un formulaire
        // $pseudoForm = "Pierra";
        $pseudo = $pseudoForm ?? "Pas de pseudo";
        // La ligne ci dessus correspond au code ci dessous, mais raccourci !
        // C'est un raccourci d'un isset
        if (isset($pseudoForm)) {
            $pseudo = $pseudoForm;
        } else {
            $pseudo = "Pas de pseudo";
        }

        echo "<h2>Conditions switch</h2>";
        // switch est un autre outil permettant de mettre en place des conditions
        // On l'utilise dans un seul et unique scénario, celui de tester des valeurs différentes d'un seul élément

        // On teste un ensemble de cas 

        $couleur = "bleu";

        switch ($couleur) {
            case "bleu":
                echo "Vous aimez le bleu<br>";
                break;
            case "rouge":
                echo "Vous aimez le rouge<br>";
                break;
            case "vert":
                echo "Vous aimez le vert<br>";
            default: // équivalent au else 
                echo "Vous n'aimez ni le bleu, ni le rouge, ni le vert<br>";
                break;
        }

        separateur();

        // EXERCICE : Refaire cette condition switch, mais en if / elseif / else 

        $couleur = "vert";

        if ($couleur == "bleu") {
            echo "Vous aimez le bleu<br>";
        } elseif ($couleur == "rouge") {
            echo "Vous aimez le rouge<br>";
        } elseif ($couleur == "vert") {
            echo "Vous aimez le vert<br>";
        } else {
            echo "Vous n'aimez ni le bleu, ni le rouge, ni le vert<br>";
        }

        if ($couleur == "bleu") echo "Vous aimez le bleu<br>";
        elseif ($couleur == "rouge") echo "Vous aimez le rouge<br>";
        elseif ($couleur == "vert") echo "Vous aimez le vert<br>";
        else echo "Vous n'aimez ni le bleu, ni le rouge, ni le vert<br>";


        echo '<h2>08 - Fonctions prédéfinies</h2>';

        // Les fonctions prédéfinies sont inscrites et font parties du langage lui même, on se contente de les exécuter
        // Pour plus d'informations sur les fonctions d'un langage, on se réfère à la documentation officielle
        // Ce qu'on a besoin de savoir pour manipuler une fonction, c'est : 
        // - Quels sont les paramètres qu'elle attend (obligatoires et facultatifs, les types)
        // - Quel est le retour de cette fonction

        // https://www.php.net/manual/en/indexes.functions.php
        // Ci dessus la liste des fonctions et méthodes de PHP 

        // Fonction date() 
        // Permet d'afficher la date selon le format souhaité

        // time() me donne le timestamp de l'instant
        echo "Notre temps de maintenant en horodatage UNIX (nombre de secondes depuis janvier 1970 : " . time() . "<hr>";
        // La fonction date se comporte avec des tokens de remplacement, (voir doc), c'est à dire que certaines lettres sont remplacées par des valeurs, à savoir, d c'est le numéro du jour sur deux chiffres, m c'est le numéro du mois sur deux chiffres, Y c'est l'année sur 4 chiffres
        echo "La date du jour : " . date("d/m/Y") . "<hr>";
        // Si je souhaite formater une date spécifique (pas forcement celle d'aujourd'hui), je peux la spécifier en second argument (facultatif), par contre, je dois lui transmettre en timestamp :(   heureusement, j'ai la fonction strtotime qui me permet de transformer une date classique en timestamp pour faire fonctionner ma fonction date)
        echo "La date du jour : " . date("d/m/Y", strtotime("2025-01-01"));
        separateur();

        // Fonctions de traitement de chaines de caractères

        // strlen() / iconv_strlen()
        // Fonction prédéfinie permettant de compter le nombre de caractères dans une chaine

        // strlen() ATTENTION me retourne le nombre d'octets d'une chaine de caractères (son poids)
        echo "Taille de la chaine : " . strlen("bônjôùr") . "<hr>";
        // iconv_strlen() : me retourne la taille réelle, le nombre de caractères de cette chaine
        echo "Taille de la chaine : " . iconv_strlen("bônjôùr") . "<hr>";

        // C'est ce qu'on utilisera pour des contrôles de taille de saisie ! 
        // Par exemple vérifier si un password est assez long ! 

        $password = "azertyzzzzz";

        // Ci après le contrôle de longueur de mot de passe 
        if (iconv_strlen($password) < 8) {
            echo "<div style='background-color:red; color:white; padding:20px;'>ATTENTION, le password doit faire au moins 8 caractères !!!</div><hr>";
        } else {
            echo "<div style='background-color:green; color:white; padding:20px;'>Password OK</div><hr>";
        }

        // Il existe plein de fonctions de vérifications
        // is_integer
        // is_numeric
        // is_string
        // is_array
        // etc etc etc  

        $numTel = 0102030405;
        $numTel = "0102030405";

        if (is_numeric($numTel)) {
            echo "Ok c'est bon le numéro de téléphone est bien numérique.<hr>";
        }

        separateur();
        // ucfirst() pour mettre le premier caractère d'une chaine en majuscule
        $nom = "wayne";
        echo ucfirst($nom);

        separateur();

        echo '<h2>09 - Fonctions utilisateur</h2>';

        // déclarées et exécutées par nous ! Le développeur

        // Déclaration de la fonction
        function separateur()
        {
            echo "<hr><hr><hr>";
        }

        // Execution : 
        separateur();

        // Fonction avec un paramètres (params/arg/argument)
        // Fonction me permettant de dire bonjour à l'utilisateur
        function direBonjour($qui)
        {
            return "Bonjour $qui, bienvenue sur notre site<hr>";
        }

        echo direBonjour("Pierra");
        echo direBonjour("Wassim");

        // Fonction permettant de calculer un prix HT en TTC
        function appliqueTVA($prix)
        {
            return "Le montant TTC pour le prix HT : $prix €, est de : " . ($prix * 1.2) . "€<hr>";
        }

        echo appliqueTVA(100);
        echo appliqueTVA(500);

        // EXERCICE : 
        // Refaire une fonction de calcul de TVA, MAIS en permettant à l'utilisateur de saisir le taux de taxe à appliquer
        // par exemple un appel comme ceci : echo appliqueTVA(100, 30); si je souhaite appliquer une tva de 30% sur le prix 100
        // Une fois, cette fonction réalisée, l'améliorer en rendant la saisie du taux facultatif ! C'est à dire, si l'utilisateur ne saisi pas de second paramètre, alors ce sera un taux à 20% qui s'applique par défaut

        function appliqueTVAtaux($prix, $taux)
        {
            if (empty($taux)) {
                return "Le montant TTC pour le prix HT : $prix €, est de : " . ($prix * 1.2) . "€<hr>";
            } else {
                return "Le montant TTC pour le prix HT : $prix €, est de : " . ($prix + ($prix * ($taux / 100))) . "€<hr>";
            }
        }

        echo appliqueTVAtaux(100, 30);
        echo appliqueTVAtaux(100, 50);
        echo appliqueTVAtaux(100, "");

        // Pour rendre un argument facultatif, il faut lui donner une valeur dans ses param dans l'exécution de la fonction
        function appliqueTVAtaux2($prix, $taux = 20)
        {
            $prixTTC = $prix * (1 + ($taux / 100));
            return "Le montant TTC pour le prix HT : $prix €, est de : " . $prixTTC . "€<hr>";
        }

        echo appliqueTVAtaux2(1000);


        // fonction pour afficher la météo 
        function meteo($saison, $temperature)
        {
            $debut = "Nous sommes en " . $saison;
            $suite = " et il fait " . $temperature . " degré(s)<hr>";

            return $debut . $suite;
        }

        separateur();


        echo meteo("printemps", 20);
        echo meteo("été", 35);
        echo meteo("automne", 10);
        echo meteo("hiver", 1);

        // EXERCICE : 

        // Amélioration de la fonction météo 
        // On veut corriger le "en" printemps, en "au" printemps
        // Et on veut aussi gérer les degrés au pluriel lorsque c'est nécessaire, sinon, au singulier 

        function meteo2($saison, $temperature)
        {

            if ($saison == "printemps") {
                $article = "au";
            } else {
                $article = "en";
            }

            if ($temperature == 1 || $temperature == -1 || $temperature == 0) {
                $degre = "degré";
            } else {
                $degre = "degrés";
            }

            return "Nous sommes $article $saison et il fait $temperature $degre <br>";
        }

        echo meteo2("printemps", 20);
        echo meteo2("été", 35);
        echo meteo2("automne", 10);
        echo meteo2("hiver", 1);

        separateur();

        function meteo3($saison, $temperature)
        {
            $article = "en";
            if ($saison == "printemps") $article = "au";

            $degre = "degrés";
            if ($temperature == 1 || $temperature == -1 || $temperature == 0) $degre = "degré";

            return "Nous sommes $article $saison et il fait $temperature $degre <br>";
        }

        echo meteo3("printemps", 20);
        echo meteo3("été", 35);
        echo meteo3("automne", 10);
        echo meteo3("hiver", 1);

        separateur();

        function meteo4($saison, $temperature)
        {
            $art = ($saison == "printemps") ? "au" : "en";
            $s = (abs($temperature) <= 1) ? "" : "s";

            return "Nous sommes $art $saison et il fait $temperature degré$s <br>";
        }

        echo meteo4("printemps", 20);
        echo meteo4("été", 35);
        echo meteo4("automne", 10);
        echo meteo4("hiver", 1);

        // ENVIRONNEMENT - SCOPE 
        // Global : Le script complet
        // Local : à l'intérieur d'une fonction (également l'intérieur d'une classe et ses méthodes)

        // L'existence d'une variable dépend de l'environnement où on la déclare
        // Une variable déclarée dans un espace local (les accolades d'une fonction), n'existe QUE dans cette fonction 

        separateur();

        $animal = "chat"; // Variable déclarée dans l'espace global
        echo $animal . "<hr>"; // chat

        function foret()
        {
            $animal = "chien"; // Variable déclarée dans l'espace local
            return $animal;
        }

        echo $animal . "<br>"; // chat
        foret() . "<br>"; // rien, pas d'echo - ici un string "chien" se perds dans le code...
        echo $animal . "<br>"; // chat
        echo foret() . "<br>"; // chien
        echo $animal . "<br>"; // chat 
        $animal = foret(); // changement de valeur de la var globale par le string retourné par la fonction
        echo $animal . "<br>"; // chien

        separateur();

        $pays = "France"; // Variable déclarée dans le scope global

        function affiche_pays()
        {
            global $pays; // Avec le mot clé global, il est possible de récupérer une variable de l'espace global pour la ramener dans la fonction ! 
            $pays = "Espagne";
        }

        echo $pays; // France 
        affiche_pays(); // Pas d'echo, rien à l'affichage mais la valeur de $pays est changée pour espagne
        echo $pays; // Espagne

        // Il est possible de typer les arguments et le return d'une fonction 
        function identite(string $nom, int $age = 38, int $cp = 75): string
        {
            return "$nom il a $age ans et habite dans le $cp";
        }
        separateur();
        // Erreur le 3eme argument $cp n'est pas du bon type 
        // echo identite("Pierra", 38, "coucou");
        // Depuis PHP 8 on peut aussi appeler les arguments par leur nom, ce qui évite de tous les citer (surtout lorsque l'on a beaucoup d'arguments facultatifs)

        // Ici j'ai pu donner une valeur au param facultatif $cp sans avoir eu besoin de citer $age
        echo identite(nom: "Bob", cp: 64);


        echo '<h2>10 - Structure itérative : Boucles</h2>';

        // Boucle for = boucle avec un compteur numérique 
        // Utilisée uniquement avec des compteurs numériques 

        // Besoin de 3 informations pour mener à bien cette boucle 
        // - Un compteur
        // - Une condition d'entrée
        // - Une incrémentation / décrémentation 

        // for(compteur;condition;incrementation) {}
        for ($i = 0; $i < 10; $i++) {
            echo "$i ";
        }

        echo "<br>";

        for ($i = 0; $i < 10; $i++) :
            echo "$i ";
        endfor;

        // Boucle while = boucle en fonction d'une condition (pas forcément numérique)
        // while = "tant que" qqchoz se passe convenablement / un traitement / une instruction - jusqu'à ce que cela nous retourne false et la boucle s'arrête 

        // On peut quand même la manipuler avec des compteurs numériques mais ce n'est pas le choix préféré
        separateur();
        $i = 0; // Compteur 
        while ($i < 10) { // Condition d'entrée
            echo "$i ";
            $i++; // Incrémentation
        }
        echo "<br>";

        while ($i < 10) :
            echo "$i ";
            $i++;
        endwhile;

        separateur();

        // Si jamais on souhaite arrêter la boucle à un moment spécifique, on peut le faire avec le mot clé "break"
        for ($i = 0; $i < 100; $i++) {
            echo "$i ";
            if ($i == 20) {
                break; // on sort de la boucle
            }
        }

        separateur();

        // Exercice 
        $i = 0;
        while ($i < 10) {
            echo "$i - ";
            $i++;
        }

        // EXERCICE : Modifier cette boucle afin de ne pas avoir le tiret à la fin 
        // Résultat actuel : 0 - 1 - 2 - 3 - 4 - 5 - 6 - 7 - 8 - 9 -
        // Résultat attendu : 0 - 1 - 2 - 3 - 4 - 5 - 6 - 7 - 8 - 9

        separateur();
        $i = 0;
        while ($i < 10) {
            if ($i < 9)
                echo "$i - ";
            else {
                echo $i;
            }
            $i++;
        }

        separateur();

        for ($i = 0; $i < 10; $i++):
            if ($i < 9) :
                echo $i . ' - ';
            else:
                echo $i;
            endif;
        endfor;

        separateur();

        // Exercice 1
        // Afficher des nombres allant de 1 à 100. 
        $i = 1;
        while ($i <= 100) {
            echo "$i . ";
            $i++;
        }
        separateur();
        // Exercice 2
        // Afficher des nombres allant de 1 à 100 avec le chiffre 50 en rouge.
        for ($i = 1; $i < 101; $i++) {
            if ($i == 50) {
                echo "<div style='color:red;'>$i </div>";
            } else {
                echo "$i ";
            }
        }
        separateur();
        for ($i = 1; $i < 101; $i++) {
            if ($i == 50) {
                echo "<span style='color:red;'>$i </span>";
            } else {
                echo "$i ";
            }
        }
        separateur();
        // Exercice 3
        // Afficher des nombres allant de 2000 à 1930.
        $i = 2000;
        while ($i >= 1930) {
            echo "$i ";
            $i--;
        }

        separateur();

        // Exercice 4
        // Afficher le titre suivant 10 fois : <h1>Titre à afficher 10 fois</h1>
        $i = 1;
        while ($i <= 10) {
            echo "<h1>Titre à afficher 10 fois</h1>";
            $i++;
        }

        separateur();

        // Exercice 5
        // Afficher le titre suivant "<h1>Je m'affiche pour la Nème fois</h1>".
        // Remplacer le N avec la valeur de $i (tour de boucle).
        // Bien gérer le "1ère" fois et non pas "1ème"
        for ($i = 1; $i <= 10; $i++) {
            if ($i == 1) {
                echo "<h1>Je m'affiche pour la $i" . "ère fois</h1>";
            } else {
                echo "<h1>Je m'affiche pour la $i" . "ème fois</h1>";
            }
        }

        separateur();

        for ($i = 1; $i <= 10; $i++) {
            $erm = ($i == 1) ? "ère" : "ème";
            echo "<h1>Je m'affiche pour la $i$erm fois</h1>";
            // if ($i == 1) {
            //     echo "<h1>Je m'affiche pour la $i" . "ère fois</h1>";
            // } else {
            //     echo "<h1>Je m'affiche pour la $i" . "ème fois</h1>";
            // }
        }

        echo '<h2>11 - Tableaux de données array</h2>';
        // Array est un nouveau type de données 
        // Une variable de type array, nous permet de conserver un ensemble de valeur
        // Un array est toujours composé de deux colonnes 
        // Une colonne représente une "clé"/"index"/"id"/"key"
        // Une colonne représente la valeur associée à cette clé 

        // Déclaration d'un tableau array 
        $tabJours = array("lundi", "mardi", "mercredi", "jeudi", "vendredi");

        // echo $tabJours;

        // Pour voir l'intégralité d'un array, on ne peut pas utiliser un simple echo ! 
        // Error, array to string conversion

        // Deux outils de controle nous permettent de vérifier le contenu des array (et aussi des objets et encore d'autres choses) : 
        // - var_dump()
        // - print_r()
        // Ces deux outils nous permettent de visualiser les clés et les valeurs

        var_dump($tabJours);

        echo "<pre>";
        print_r($tabJours);
        echo "</pre>";

        function dump($var)
        {
            echo "<pre>";
            print_r($var);
            echo "</pre>";
        }

        // Ici on comprends bien que notre tableau s'est indexé numériquement de façon automatique, les indices commençant à 0 pour lundi
        //         Array
        // (
        //     [0] => lundi
        //     [1] => mardi
        //     [2] => mercredi
        //     [3] => jeudi
        //     [4] => vendredi
        // )

        dump($tabJours);

        // Il n'est pas possible d'afficher un tableau array complet avec un echo, cependant, nous pouvons piocher dedans en appelant l'indice correspondant
        // Si je veux afficher mercredi ? C'est l'indice 2, que j'appelle entre crochets 
        // Les crochets [] sont les éléments représentatifs des tableaux array en php 
        echo $tabJours[2];

        // Pour rajouter un ou des éléments dans un tableau array : array_push()
        array_push($tabJours, "samedi", "dimanche");


        dump($tabJours);


        // Autres façons de déclarer un tableau array
        $tabMois = ["janvier", "fevrier", "mars", "avril"];

        dump($tabMois);
        // Autre syntaxe pour rajouter des éléments dans un tableau
        $tabMois[] = "mai";
        $tabMois[] = "juin";
        dump($tabMois);

        $tabFruits[] = "fraises"; // La première ligne crée le tableau
        $tabFruits[] = "pommes"; // Les lignes suivantes ajoutent des éléments 
        $tabFruits[] = "bananes";
        $tabFruits[] = "coco";

        // Pour connaitre la taille d'un tableau : 
        // count() ou sizeof() 
        echo "Taille du tableau contenant les fruits : " . count($tabFruits) . "<hr>";
        echo "Taille du tableau contenant les fruits : " . sizeof($tabFruits) . "<hr>";

        // EXERCICE : En utilisant une boucle   
        // Affichez le contenu du tabFruits dans une liste ul li 
        // Le but étant d'utiliser la valeur du compteur, pour pointer vers un élément du tableau array 
        // Et ça jusqu'à la fin du tableau

        // <ul>
        //     <li></li>
        //     <li></li>
        //     <li></li>
        // </ul>

        // Avec la boucle for
        echo "<ul>";
        for ($i = 0; $i < count($tabFruits); $i++) {
            echo "<li>" . $tabFruits[$i] . "</li>";
        }
        echo "</ul>";

        // Avec la boucle while 
        echo "<ul>";
        $i = 0;
        while ($i < count($tabFruits)) {
            echo "<li>" . $tabFruits[$i] . "</li>";
            $i++;
        }
        echo "</ul>";

        // Avec la boucle foreach
        echo "<ul>";
        foreach ($tabFruits as $fruit) {
            echo "<li>$fruit</li>";
        }
        echo "</ul>";

        separateur();

        // Il est possible en PHP d'avoir des key de array nommées par des mots ! 
        $user = array("pseudo" => "Pierra", "email" => "pierra@mail.fr", "age" => 38, "date_inscription" => "2020-05-05");

        var_dump($user);

        $user["ville"] = "Montpellier";
        $user["cp"] = 34000;

        var_dump($user);

        // Un array, avec des clés en "mots" est appelé un array associatif
        // Pour piocher un élément d'un array associatif, on spécifie le nom de la clé entre les crochets
        // Attention les clés sont des string donc entre '' ou ""
        echo $user["pseudo"];

        // Pour parcourir tous les éléments d'un tableau array, j'utilise un outil de boucle spécifique
        // La boucle foreach()
        // Cette boucle permet de parcourir tous les éléments d'un tableau ou d'un objet un par un 

        // Deux syntaxes possibles
        // L'une nous permet de récupérer que les valeurs
        // L'autre nous permet de récupérer les valeurs ainsi que les clés 

        //             array (size=6)
        //   'pseudo' => string 'Pierra' (length=6)
        //   'email' => string 'pierra@mail.fr' (length=14)
        //   'age' => int 38
        //   'date_inscription' => string '2020-05-05' (length=10)
        //   'ville' => string 'Montpellier' (length=11)
        //   'cp' => int 34000

        foreach ($user as $valeur) { // Ici une seule variable nommée après le as, me permet de récupérer à chaque tour de boucle la valeur de l'élément (d'abord Pierra, puis pierra@mail.fr, puis 38, puis 2020-05-05)
            echo "- $valeur<br>";
        }

        separateur();

        foreach ($user as $cle => $valeur) { // Ici deux variables après as, la première récupère le nom de la key ($cle recupere la key), la deuxieme récupère la valeur
            // Cela me permet eventuellement d'ajouter une condition pour amener un traitement spécifique sur une ou plusieurs key

            // Par exemple on affiche seulement les key pseudo email age
            if ($cle == "pseudo" || $cle == "email" || $cle == "age") {
                echo "- $cle : $valeur<br>";
            }

            // Si une cle image existait, il faudrait la traiter differemment, avec une balise img
            if ($cle == "image") {
                echo "<img src='$valeur'>";
            }
        }

        // Il est possible d'avoir un tableau dans un autre tableau
        // C'est ce qu'on appelle un tableau multidimensionnel
        // Je défini ici $users contenant plusieurs valeurs représentant chacun un array concernant un user
        $users = array();
        $users[] = $user;
        var_dump($users);

        $users[] = array("pseudo" => "Bob", "email" => "bob@mail.fr", "age" => 12, "date_inscription" => "2022-05-05");
        $users[] = array("pseudo" => "Jimmy", "email" => "jim@mail.fr", "age" => 40, "date_inscription" => "2022-05-05");

        var_dump($users);

        // array (size=3)
        //   0 => 
        //     array (size=6)
        //       'pseudo' => string 'Pierra' (length=6)
        //       'email' => string 'pierra@mail.fr' (length=14)
        //       'age' => int 38
        //       'date_inscription' => string '2020-05-05' (length=10)
        //       'ville' => string 'Montpellier' (length=11)
        //       'cp' => int 34000
        //   1 => 
        //     array (size=4)
        //       'pseudo' => string 'Bob' (length=3)
        //       'email' => string 'bob@mail.fr' (length=11)
        //       'age' => int 12
        //       'date_inscription' => string '2022-05-05' (length=10)
        //   2 => 
        //     array (size=4)
        //       'pseudo' => string 'Jimmy' (length=5)
        //       'email' => string 'jim@mail.fr' (length=11)
        //       'age' => int 40
        //       'date_inscription' => string '2022-05-05' (length=10)

        // Pour piocher dans un tableau array on enchaine une succession de crochets pour appeler petit à petit les indices, on rentre niveau par niveau
        echo $users[2]["pseudo"];

        // Avec un array contenant plusieurs éléments (plusieurs users, plusieurs produits, plusieurs articles ou autre)
        // On utilise la boucle foreach pour affiner le résultat et récupérer les user un à un
        // D'où le nommage de nos variables "parmis les $userS on récupère un $user"
        foreach ($users as $user) {
            var_dump($user);

            foreach ($user as $cle => $valeur) {
                echo "- $cle : $valeur<br>";
            }
            separateur();
        }

        separateur();

        foreach ($users[2] as $cle => $valeur) {
            echo "- $cle : $valeur<br>";
        }

        dump($users);


        echo '<h2>12 - Inclusion de fichier</h2>';

        // Créer un fichier nommé _exemple.php
        // ou exemple.inc.php
        // On insère un peu de contenu texte dans cet autre fichier 

        // On peut en PHP, inclure des fichiers/pages à l'intérieur d'un autre
        // Pour cela, deux outils : include et require avec leurs versions _once    include_once et require_once

        // La différence entre ces deux outils réside dans leur gestion des erreurs
        // include génèrera une erreur warning, la suite du code peut continuer de s'exécuter
        // require génèrera une erreur fatal error, l'exécution du code s'arrête immédiatement 

        echo "<b>Premier appel avec include : </b><hr>";
        // include "_exemple.php"; // Ramène tout le contenu de _exemple.php dans notre fichier syntaxe.php
        separateur();

        echo "<b>Deuxième appel avec include_once : </b><hr>";
        include_once "_exemple.php"; // ne s'affiche pas car déjà inclus par le include de la ligne précédente
        separateur();

        echo "<b>Premier appel avec require : </b><hr>";
        require "_exemple.php"; // Ramène tout le contenu de _exemple.php dans notre fichier syntaxe.php
        separateur();

        echo "<b>Deuxième appel avec require_once : </b><hr>";
        // require_once "_exemple.php"; // ne s'affiche pas car déjà inclus par le require de la ligne précédente
        separateur();




   











        // Fermeture de la balise PHP 
        ?>

    </div>

</body>

</html>