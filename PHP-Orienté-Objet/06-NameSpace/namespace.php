<?php 

// Dans le cas d'un code normal, je n'ai pas le droit de réutiliser un nom déjà pris
// Ici si je déclare une classe Utilisateur alors qu'une autre classe Utilisateur existe déjà, alors erreur !
// Les namespace me permettent d'éviter ces problèmes de conflit

// Les namespaces en PHP sont un moyen d'organiser et de structurer les classes, interfaces, fonctions et constantes de manière logique, évitant ainsi les conflits de noms, particulièrement dans les projets complexes ou lorsque des bibliothèques externes sont utilisées.

// Les namespaces permettent d'éviter les collisions de noms en séparant les espaces de noms (comme des dossiers virtuels) et en clarifiant l'origine des classes, fonctions, ou constantes utilisées.

// Sans namespace, toutes les classes et fonctions sont déclarées dans un espace global. Cela peut rapidement poser problème dans de grands projets ou lorsque plusieurs bibliothèques sont utilisées, car des conflits peuvent survenir lorsque deux classes ou fonctions portent le même nom.

// class Utilisateur {
//     public $pseudo;
// }

// class Utilisateur {
//     public $pseudo;
// }


require("UtilisateurA.php");
require("UtilisateurB.php");



// Ici une instanciation par FQN
// Full Qualified Name
// J'instancie en spécifiant le nom entier, namespace inclu !
$userA = new LibrairieA\Userr;
// $userB = new LibrairieB\Userr;


// Sinon plutôt que d'utiliser le FQN, je peux "use" la classe en question
// En quelque sorte, cela importe la classe sur ce fichier et je n'ai plus besoin de spécifier le FQN pour l'instancier, uniquement le nom de la classe
// En cas de doublon de nom de classe je peux éventuellement spécifier un autre nom 
use LibrairieA\Userr AS Usair;
use LibrairieB\Userr;

$userA = new Usair;
$userB = new Userr;
var_dump($userA);
var_dump($userB);

echo "Echo du User A : " . $userA->getNom() . "<hr>";
echo "Echo du User B : " . $userB->getNom() . "<hr>";