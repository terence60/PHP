<?php

/* 

EXERCICE : 
            Création d'une classe CompteBancaire selon la modélisation suivante 

    ----------------------
    |   CompteBancaire   |
    ----------------------
    | -titulaire:string  |
    | -solde:float       |
    ----------------------
    | +__construct()     |
    | +getTitulaire()    |
    | +setTitulaire()    |
    | +getSolde()        |
    | +setSolde()        |
    | +afficherSolde()   |
    | +retirer()         |
    | +deposer()         |
    ----------------------

*/
 class CompteBancaire {
private $titulaire;
private $solde;
public function __construct($titulaire, $solde )
{
    echo "Instanciation de l'objet CompteBancaire";
    $this->titulaire = $titulaire;
    $this->solde = $solde;
}
public function getTitulaire():string
{
    return $this->titulaire;
}
public function setTitulaire(string $titulaire) 
{
    if (iconv_strlen($titulaire) > 0) {
        $this->titulaire = $titulaire;
    } else {
        trigger_error("le titulaire ne peut pas etre vide", E_USER_ERROR);
    }
}
public function getSolde(): float 
{
    return $this->solde;
}
public function setSolde(float $solde)
{
    if (is_numeric($solde) && $solde >= 0) {
        $this->solde = $solde;
    } else {
        trigger_error("le solde doit etre un nombre positif", E_USER_ERROR);
 }
}
public function afficherSolde() : string {
    return "Le solde du compte de " . $this->titulaire . " est de " . $this->solde . " euros.<hr>";
}
public function deposer ($montant) {
$this->solde += $montant;
  return "Le solde du compte de " . $this->titulaire . " est maintenant de " . $this->solde . " euros aprés avoir ajouté $montant euros <hr>";
    
}
public function retirer ($montant) {
$this->solde -= $montant;
  return "Le solde du compte de " . $this->titulaire . " est maintenant de " . $this->solde . " euros aprés avoir retiré $montant euros <hr>";
}
 }

 $compte = new CompteBancaire("terence", 500);

echo $compte->afficherSolde(); 
echo $compte->deposer(100);
echo $compte->retirer(20);










 
























