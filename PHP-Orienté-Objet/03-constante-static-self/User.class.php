<?php 

// Imaginons que l'on développe un système de gestion d'utilisateurs où certains rôles sont fixes comme "ADMIN", "EDITOR", "USER", plutôt que d'utiliser des chaines de caractères brute pour mes "rôles" je pourrais les définir dans des constantes 
// C'est exactement le même système dans symfony 

// Ici les const me permettent de garder des valeurs précises (les nomamges de mes rôles utilisateur), bien organisées et de les réutiliser plus facilement à travers le code sans risque d'erreur de frappe

class User {
    public const ROLE_ADMIN = "admin";
    public const ROLE_EDITOR = "editor";
    public const ROLE_USER = "user";

    private $role;

    public function __construct($role) {
        $this->role = $role;
    }

    public function getRole(){
        return $this->role;
    }

    public function isAdmin() {
        return $this->role == self::ROLE_ADMIN;
    }
}

// Utilisation
$user = new User(User::ROLE_ADMIN);

echo $user->isAdmin() ? "Cet utilisateur est un admin" : "Cet utilisateur n'est pas admin";