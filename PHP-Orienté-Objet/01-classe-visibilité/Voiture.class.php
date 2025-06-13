<?php 

/*

La programmation orientée objet (POO) en PHP repose sur quelques concepts clés comme les classes, les objets et les instances. Elle inclut également des notions de visibilité qui contrôlent l'accès aux propriétés et aux méthodes.


*/


// Déclaration d'une classe
// Une classe en PHP est un modèle qui définit des propriétés (variables), et des méthodes (fonctions) qui seront partagées par les objets créés à partir de cette classe

class Voiture {
    // Propriétés 
    public $marque;
    public $couleur;
    protected $km = 0;
    private $carburant;

    // Methodes 
    public function demarrer() {
        return "La voiture demarre.";
    }

    public function ajouterKm(int $ajoutKm): string {
        // $voiture1->km += 75;
        $this->km += $ajoutKm;
        return "J'ai ajouté $ajoutKm kms, il y a maintenant " . $this->km . "kms au compteur<hr>";
    }

    private function changementCarburant() {
        return "Je change le carburant";
    }

}

// Instanciation d'une classe
// Pour utiliser une classe, on doit créer un objet à partir de celle-ci. C'est ce qu'on appelle l'instanciation

// Instanciation d'un objet de la classe Voiture
// Ici le mot clé new me permet de "créer" un objet de la classe Voiture
// Je ne suis pas limité, je peux en créer autant que nécessaire, chaque objet est indépendant des autres
$voiture1 = new Voiture();
$voiture2 = new Voiture();
$voiture3 = new Voiture();

// Ici le var_dump me montre bien que $voiture1 est un type object, et surtout un object de type Voiture
// Je peux visualiser les props de l'objet via le var_dump mais pas les méthodes !
var_dump($voiture1);

// Pour voir les méthodes je peux utiliser une fonction get_class_methods
var_dump(get_class_methods($voiture1));


// Si voiture 1 était un array
// $voiture1["marque"] = "Toyota";

// Assignation de valeurs aux propriétés
// Pour un objet, on a une syntaxe spécifique pour pointer sur une prop ou une méthode, c'est la flèche "->"

// J'indique ici que j'assigne une valeur dans la prop marque, puis la prop couleur de l'objet $voiture1
$voiture1->marque = "Toyota";
$voiture1->couleur = "Rouge";

$voiture2->marque = "Peugeot";
$voiture2->couleur = "Bleue";

var_dump($voiture1);
var_dump($voiture2);

echo "La voiture 1 utilise la méthode démarrer : " . $voiture1->demarrer() . "<hr>";
echo "La voiture 2 utilise la méthode démarrer : " . $voiture2->demarrer();

// J'ajoute des kms à ma voiture1 
// Malheureusement ici ces deux props sont protected et private donc je n'y ai pas accès depuis le scope global ! 
// Donc j'ai besoin de développer de méthodes qui me permettent d'intéragir avec les propriétés (on l'a modifié sur ajoutKm)
// $voiture1->km = 1000; // Fatal error : Cannot access protected property Voiture::$km
// $voiture1->carburant = "essence"; // Fatal error : Cannot access private property Voiture::$carburant

// Idem pour les méthodes, pas possible de les appeler si elles sont protected et private
// $voiture1->ajouterKm();
// $voiture1->changementCarburant();

var_dump($voiture1);

// Ici j'ai redéfini ajouterKm en public pour pouvoir l'appeler depuis le global, et pour me permettre de manipuler la prop km qui elle est protected !
echo $voiture1->ajouterKm(75);

var_dump($voiture1);

echo $voiture1->ajouterKm(75);
echo $voiture1->ajouterKm(75);
echo $voiture1->ajouterKm(75);

echo $voiture2->ajouterKm(50);


// Exemple de stockage de valeur dans des var --- Pour comparaison avec la syntaxe orienté objet
// $variable = 10;
// $variable2 = 20;
// Ici dans un array
// $tab = array(10,20);
// echo $variable;
// echo $tab[0];


//  Visibilité : public, protected, private
// La visibilité en POO définit le niveau d'accès aux propriétés et méthodes d'une classe.

    // Public : Les propriétés/méthodes publiques sont accessibles depuis n'importe où, y compris depuis l'extérieur de la classe. (dans le scope global en gros)

    // Protected : Les propriétés/méthodes protégées sont accessibles uniquement à l'intérieur de la classe (scope local) et de ses classes dérivées (héritage), les éléments protected que ce soit méthode ou props seront récupérés par héritage.

    // Private : Les propriétés/méthodes privées sont accessibles uniquement à l'intérieur de la classe où elles ont été définies, et pas par les classes dérivées car elles ne sont pas héritées.

