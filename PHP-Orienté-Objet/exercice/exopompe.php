<?php

/*********************
 
    EXERCICE :

        Création de la classe Vehicule et de la classe Pompe en suivant ces modélisations

    ----------------------
    |   Vehicule         |
    ----------------------
    |-litresReservoir:int|
    ----------------------
    |+setlitresReservoir()|
    |+getlitresReservoir()|
    ----------------------

    ----------------------
    |   Pompe            |
    ----------------------
    | -litresStock:int   |
    ----------------------
    | +setlitresStock()  |
    | +getlitresStock()  |
    | +donnerEssence()   |
    ----------------------

        Spécifications : 
            - Le réservoir d'un véhicule contient maximum 50 litres
            - La méthode donnerEssence() distribue automatiquement le plein (50litres) à la voiture, si elle le peut, sinon, ce qu'il lui reste (dans la pompe)
            - Gérez les exceptions qui peuvent être rencontrées à l'appel de la méthode donnerEssence()

 */

class Vehicule
{
    private $litresReservoir;

    public function setlitresReservoir($newReservoir)
    {
        if (is_numeric($newReservoir) && $newReservoir >= 0 && $newReservoir <= 50) {
            $this->litresReservoir = $newReservoir;
        }
    }

    public function getlitresReservoir()
    {
        return $this->litresReservoir;
    }
}

class Pompe
{
    private $litresStock;

    public function setLitresStock($newStock)
    {
        if (is_numeric($newStock) && $newStock >= 0) {
            $this->litresStock = $newStock;
        }
    }

    public function getLitresStock()
    {
        return $this->litresStock;
    }

    // Je passe ici un param de type Vehicule ce qui me permet à l'intérieur de la méthode donnerEssence d'avoir accès à tout ce qui définit cet objet (dans notre cas, ses methodes set et get)
    public function donnerEssence(Vehicule $vhc)
    {
        // J'identifie ici, 3 scénarios possibles
        // 1er cas : La pompe n'a pas d'essence, rien ne se passe
        // 2eme cas : La pompe a suffisamment d'essence pour donner le plein à la voiture (la voiture se retrouve à 50 litres)
        // 3eme cas : La pompe a l'essence, mais pas suffisamment, elle va donner, la totalité de ce qu'elle possède au vehicule


        // On vient bien ici dans le var_dump, l'objet Vehicule récupéré
        echo "<h3>Ici les infos du vehicule reçu à la station essence</h3>";
        var_dump($vhc);


        $litresPompe = $this->getLitresStock(); // Cette ligne me permet de comprendre combien il reste de litres dans la pompe
        $litresVoiture = $vhc->getlitresReservoir(); // Cette ligne me permet de comprendre combien il reste de litres dans le vehicule
        // Je passe par ces variables intermédiaires pour ne pas allourdir la syntaxe en dessous

        if ($litresPompe == 0) { // 1er cas : Si la pompe est vide rien ne se passe, juste un echo
            echo "Désolé la pompe est vide<hr>";
        } elseif (($litresPompe + $litresVoiture)  >= 50) { // 2eme cas : si les litres de la pompe + les litres du vehicule font au moins 50 litres, c'est à dire que j'ai assez pour faire le plein
            $litresManquant = 50 - $litresVoiture; // Ici je comprends combien de litres sont manquant au vehicule
            $this->setLitresStock($litresPompe - $litresManquant); // Je soustrait aux litres de la pompe, les litresManquant au vehicule
            $vhc->setlitresReservoir(50); // Le vehicule récupère forcément le plein
            echo "Ok la voiture repart avec le plein de 50 litres, Elle a été remplie de $litresManquant litres et il reste " . $this->getLitresStock() . " litres dans la pompe<hr>";
        } else { // 3eme cas : La pompe a un peu d'essence, mais pas assez pour le plein
            $vhc->setlitresReservoir($litresPompe + $litresVoiture); // Je mets directement dans le vehicule les litres de la pompe
            $this->setLitresStock(0); // La pompe se retrouve à 0
            echo "Ok la voiture repart avec un peu plus d'essence qu'à l'arrivée mais pas avec le plein, il reste 0 dans la pompe, on a donné $litresPompe litres d'essence et la voiture a maintenant ". $vhc->getlitresReservoir() ."<hr>";
        }
    }
}

// Un premier vehicule
$vhc1 = new Vehicule;
$vhc1->setlitresReservoir(10);
var_dump($vhc1);

// Un deuxième vehicule
$vhc2 = new Vehicule;
$vhc2->setlitresReservoir(20);
var_dump($vhc2);

// Un troisième vehicule
$vhc3 = new Vehicule;
$vhc3->setlitresReservoir(30);
var_dump($vhc3);

// Une seule pompe
$pmp = new Pompe;
$pmp->setLitresStock(60);
var_dump($pmp);

$pmp->donnerEssence($vhc1); // Ici j'aurai assez pour faire le plein
$pmp->donnerEssence($vhc2); // Ici pas assez pour faire le plein mais je peux donner quelques litres
$pmp->donnerEssence($vhc3); // Ici la pompe est vide 