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

class Membre
{
    private $pseudo;
    private $email;

    public function __construct($newPseudo, $newEmail)
    {
        // On se sert de ce echo juste pour se rendre compte que notre constructeur fonctionne
        echo "Instanciation, nous avons reçu les informations suivantes : $newPseudo et $newEmail<hr>";
        // Ici je fais déjà appel à mes setter pour appliquer mes contrôles
        $this->setPseudo($newPseudo);
        $this->setEmail($newEmail);
    }

    public function setPseudo($newPseudo)
    {
        if (is_string($newPseudo)) {
            if (iconv_strlen($newPseudo) <= 30 && iconv_strlen($newPseudo) > 0) {
                $this->pseudo = $newPseudo;
            } else trigger_error("Attention, le pseudo doit être un string de max de 30 caracs", E_USER_ERROR);
        } else trigger_error("Attention, le pseudo doit être un string de max 30 caracs", E_USER_ERROR);
    }

    public function getPseudo()
    {
        return $this->pseudo;
    }

    public function setEmail($newEmail)
    {
        if (filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
            $this->email = $newEmail;
        } else trigger_error("Attention, le format d'email n'est pas correct", E_USER_ERROR);
    }

    public function getEmail()
    {
        return $this->email;
    }
}



// Sans constructeur
// $membre1 = new Membre;
// $membre1->setPseudo("Pieral");
// $membre1->setEmail('pierra@mail.com');



// Avec constructeur
$membre1 = new Membre('Pieral', "pierra@mail.com");
var_dump($membre1);

$membre1->setPseudo("Pierro");
$membre1->setEmail('lol@iu.fr');
echo 'Pseudo : ' . $membre1->getPseudo() . '<br>';
echo 'Email : ' . $membre1->getEmail() . '<br>';