<?php
/*

Getter, Setter, Construct, This

Dans la programmation orientée objet (POO) en PHP, les concepts de getter, setter, constructeur (__construct), et $this sont des mécanismes essentiels qui permettent d’organiser et de structurer les classes, tout en contrôlant la manipulation des propriétés des objets.

--- Le Constructeur (__construct)
Le constructeur est une méthode spéciale dans une classe qui est automatiquement appelée lors de la création d'un objet à partir de cette classe. Il permet d'initialiser les propriétés de l'objet dès sa création.

--- Le mot-clé $this 
En PHP, le mot-clé $this fait référence à l'objet courant dans lequel il est utilisé. Il permet d'accéder aux propriétés et méthodes de cet objet depuis l'intérieur de la classe.

--- Les Getters 
Un getter est une méthode publique qui permet d'accéder aux propriétés d'une classe, tout en gardant les propriétés elles-mêmes protégées ou privées. Cela permet de mieux contrôler et sécuriser l'accès aux données.

--- Les Setters
Un setter est une méthode publique qui permet de modifier la valeur d'une propriété privée ou protégée. Comme pour les getters, cela permet de valider et contrôler les changements sur les propriétés.


--- On peut considérer que pour toutes props d'un objet, on mettra TOUJOURS TOUJOURS un getter et un setter, même si nous ne mettons pas tout de suite en place quelconques contrôles, on veut que notre système soit évolutif, donc si je l'ai prévu en amont, je pourrais toujours le rajouter plus tard sans problèmes

*/
class Utilisateur
{

    private $nom;
    private $email;

    // Constructeur pour initialiser les propriétés
    // Ici __construct() se lance dès que j'instancie un objet, il récupère les params fournis à l'instanciation et me permet de les répercuter dans les props de l'objet
    // __construct() est une méthode magique, il a son comportement de lancement prédéfini, ensuite, à moi d'écrire le code que je souhaite qu'il exectue
    // Si mon construct a des paramètres comme ici $nom et $email, cela devient des paramètres obligatoires à fournir dès l'instanciation (voir lignes plus bas)
    // Le constructeur me permet d'initialiser l'objet avec des valeurs dès sa création, sans avoir besoin d'appeller manuellement les props/méthodes associées
    // $this représente ici l'objet "en train" d'être utilisé (ici d'être instancié)
    public function __construct($nom, $email)
    {
        echo "Instanciation de l'objet Utilisateur";
        $this->nom = $nom;
        $this->email = $email;
    }

    public function saluer()
    {
        return "Bonjour, je m'appelle " . $this->nom . "<hr>";
    }

    public function setNom(string $newNom) {
        if(iconv_strlen($newNom >= 1)) {
            $this->nom = $newNom;
        } else {
            trigger_error("Le nom ne peut pas être vide", E_USER_ERROR);
        }
    }

    public function getNom() {
        return $this->nom;
    }

    public function setEmail(string $newEmail) {
        $this->email = $newEmail;
    }

    public function getEmail() {
        return $this->email;
    }
}

// Ici du fait du constructeur, je suis obligé de donner les valeurs attendus en param, à savoir le nom et l'email
$user = new Utilisateur("Pierra", "pierra@mail.com");
// $user2 = new Utilisateur("Wassim", "wass@mail.com");

var_dump($user);

// Si je veux modifier les valeurs des props, je ne peux pas elles sont private...
// $user->nom = "Alex";
// $user->email = "alex@mail.com"; // Fatal error cannot acces private property

// Pour rémédier à ça, on va devoir utiliser des méthodes nous permettant de manipuler ces propriétés
    // Il nous faudra une méthode pour modifier la prop, une autre pour récupérer la valeur de la prop (pour l'afficher ou autre)
    // C'est ce qu'on appelle les setters et les getters 

$user->setNom("Alex");
$user->setEmail("alex@mail.com");

echo "Email du user 1 : " . $user->getEmail() . "<hr>"; 

var_dump($user);

echo $user->saluer();

$user->setNom("");