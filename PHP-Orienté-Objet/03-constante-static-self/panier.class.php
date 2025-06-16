<?php 

/*

----------------- Les éléments static : 
Les éléments static (propriétés ou des méthodes), appartiennent à la classe elle-même, et non pas aux objets comme vu jusqu'à présent.
Cela signifie que l'on peut accéder aux éléments static sans créer d'instance de la classe

Pour déclarer un élément comme static il suffit de le spécifier dans sa déclaration

----------------- Les constantes : 
Ici, on ne parle pas de constantes globale (définie par la fonction define()) mais de constante de classe. Le concept est le même sauf que ces constantes sont rattachées à une classe. Egalement, on considère les constantes de classe comme étant des éléments static, donc appartenant à la classe et pas aux objets
On défini une constante de classe par le mot clé const

*/

class Panier {

    public static $nbrProduits = 0; // Propriété statique, elle appartient à la classe ET NON PAS AUX OBJETS
    public const TVA = 20; // Constante de classe (ce n'est pas une constante globale, elle appartient à la classe ET NON PAS AUX OBJETS)
    public $prixTotal = 0;

    public static function afficherTotal() { // Ici une méthode static aussi, elle appartient à la classe et NON PAS AUX OBJETS
        // Ici on utilise le mot clé self, c'est la même chose que $this, mais dans un contexte "static", il fait référence à la classe actuelle
        return "Il y a : " . self::$nbrProduits . " produits dans notre panier<hr>";
    }

    public function ajouterProduit() { // Ici une méthode normale, rattachée à un objet
        self::$nbrProduits++;
    }
}

// $panier = new Panier();

// var_dump($panier); // Je ne vois rien dans le var_dump ? Pas de propriété, pas de constante

// echo $panier->nbrProduits; // Erreur Notice, cette prop n'appartient pas à l'objet ! 
// echo $panier->TVA; // Erreur, undefined property, ce n'est pas une propriété, c'est une constante, elle appartient à la classe !


// Voici comment appeler des éléments static
echo Panier::$nbrProduits;
echo Panier::TVA;

echo "<hr>";
Panier::$nbrProduits = 3;
echo Panier::$nbrProduits;
// Panier::TVA = 15; // Une constante ne peut pas changer de valeur
echo "<hr>";

echo Panier::afficherTotal();

$panier = new Panier();

$panier->ajouterProduit();
$panier->ajouterProduit();
echo "Nombre de produits dans le panier : " . Panier::$nbrProduits;

// Test de syntaxe en PHP 
// ATTENTION le PHP est un langage à la base, non orienté objet, également c'est un langage dit "flexible" donc certaines syntaxes "exotiques" vont fonctionner alors que cela peut paraitre aberrant dans d'autres langages de programmation


// echo Panier::$prixTotal; // Ici normal, erreur, j'appelle comme un static, une propriété justement PAS static
// Panier::ajouterProduit(); // Erreur ici aussi j'appelle comme un static, une méthode PAS static
// Panier->prixTotal; // Ne marche pas, pense que Panier est une constante 
echo "<hr>";
echo $panier::TVA; // Etonnament ici ça fonctionne
echo "<hr>";
echo $panier::$nbrProduits; // Ici aussi ça fonctionne 
// ATTENTION PHP est flexible sur certaines syntaxe, on utilisera JAMAIS cette syntaxe ci dessus, elle sera probablement refusée sur d'autres langages de programmation
// il faut bien s'habituer à appeler les éléments dans le contexte prévu, si j'appelle un élément static, c'est toujours sur sa classe et non pas sur l'objet ! 