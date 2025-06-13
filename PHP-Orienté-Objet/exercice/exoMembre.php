<?php

/************************************
   
    EXERCICE :
        Création d'une classe Membre avec cette modélisation 

    ----------------------
    |   Membre           |
    ----------------------
    |  - pseudo :string  |
    |  - email :string   |
    ----------------------
    | + __construct()    |
    | + getPseudo()      |
    | + setPseudo()      |
    | + getEmail()       |
    | + setEmail()       |
    ----------------------

            // S'assurer du bon fonctionnement de la classe à l'instanciation, à l'appel de ses props/méthodes
            // Appliquer des contrôles sur les setters et gérer les cas d'erreurs d'une façon ou d'une autre 

   
************************** */
class Membre {

public $psuedo;
public $email;

public function __construct(string $psuedo,string $email)
{
    $this->psuedo = $psuedo;
    $this->email = $email; 
}
public function getPseudo(): string
{
    return $this->psuedo;
}
public function getEmail(): string
{
    return $this->email;
}

public function setPseudo(string $newPseudo) : void
{
    if(iconv_strlen(($newPseudo))) {
        $this->psuedo = $newPseudo;
    } else {
        trigger_error("le pseudo ne peut pas etre vide", E_USER_ERROR);
    }
    }
public function setEmail (string $newEmail) : void
{ if (iconv_strlen(($newEmail))) 
{ 
    $this->email = $newEmail;
} else {
    trigger_error("l'email ne peut pas etre vide", E_USER_ERROR);
}
}   
}

$membre = new Membre ("Terence", "terence@gmail.com");
var_dump($membre);
