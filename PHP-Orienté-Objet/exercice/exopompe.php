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

 class Vehicule {


private $litresReservoir;

public function setlitresReservoir($newReservoir) {
if (is_numeric($newReservoir) && $newReservoir >= 0 && $newReservoir <= 50) {
    $this->litresReservoir = $newReservoir;
}
}

public function getlitresReservoir() {
return $this->litresReservoir;

}


 }


 class Pompe {

private $litresStock;

    public function setlitresStock($newStock) {
        if (is_numeric($newStock) && $newStock >= 0) {
    $this->litresReservoir = $newStock;
    }

    public function getlitresStock () {
    return $this->litresStock;
    }

    public function donnerEssence () {


    }

}
}

$vhc = new Vehicule;

 
 

 
 
   








