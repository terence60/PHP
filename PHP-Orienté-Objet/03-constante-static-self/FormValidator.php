<?php

// Utilisation de static dans une classe qui valide des formulaires
// On peut vouloir réutiliser ces validations dans divers projets, donc je la sépare dans une classe spécifique

// En gros, cette classe me permet de centraliser toutes mes méthodes de vérification des champs de mes formulaires, cela m'évite d'avoir des gros blocs de code à l'intérieur de mes pages pour faire mes vérifications.

// Cela rend le code plus lisible et plus efficace

class FormValidator {
    public static function isEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public static function isRequired($value) {
        return !empty($value);
    }
}

// Utilisation 
$email = "test@mail.com";

if (FormValidator::isEmail($email)) {
    echo "Email valide";
} else {
    echo "Email invalide";
}