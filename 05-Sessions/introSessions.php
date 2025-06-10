<?php

/*

    Le système de session en PHP est un mécanisme qui permet de maintenir des informations entre le serveur et le client tout au long de sa navigation, peu importe qu'il change de page ou pas.
    En PHP on a à nouveau une superglobale associée à ce système de session, $_SESSION, encore une fois, c'est un array !!! 
    C'est un array qui est vide par défaut et dans lequel je peux stocker toutes les informations que je souhaite.
    Ces informations pourront m'aider à réinterpréter certains éléments sur mon site web, tout au long de la navigation de l'utilisateur 



    Fonctionnement des sessions

    Démarrage d'une session : Une session commence quand on appelle session_start(). Cela génère un identifiant unique de session côté serveur et place cet identifiant dans un cookie sur l'ordinateur de l'utilisateur.

    Stockage de données dans $_SESSION : Les données sont stockées dans $_SESSION, qui agit comme un tableau associatif. On peut y ajouter, modifier ou supprimer des informations.

    Persistance entre pages : Tant que la session est active (jusqu'à ce qu'elle soit détruite ou que l'utilisateur ferme le navigateur), ces informations seront accessibles sur toutes les pages.

*/


// Les principales fonctions de gestion de session

// session_start() : Démarre une nouvelle session ou reprend une session existante. Elle doit être appelée au tout début de chaque script utilisant une session.

session_start();
// A partir de là, j'ai accès à ma superglobale $_SESSION
// Tout comme les autres superglobales, c'est un tableau array ! Mais cette fois ci, VIDE !!! Il me sert à transporter les informations de mon choix d'une page à une autre (par exemple les info d'un user qui vient de se connecter)

// session_destroy() : Détruit toutes les données de la session sur le serveur. Cependant, cela ne supprime pas automatiquement le cookie de session côté client. On doit aussi supprimer le cookie manuellement si nécessaire. (deconnexion)
// session_destroy();

// session_unset() : Supprime toutes les variables de session sans détruire la session elle-même.
// session_unset();

// session_regenerate_id() : Change l'ID de session pour renforcer la sécurité, particulièrement utile après une connexion réussie, pour éviter la fixation de session.
// session_regenerate_id(true);



// Etendre la durée de vie de la session pour maintenir la connexion  
// Attention il faut lancer ces instructions de durée de vie des cookie et fichier id serveur avant l'initialisation de la session
// ini_set("session.cookie_lifetime", 30 * 24 * 60 * 60); // Augmente la durée de vie du cookie session 
// ini_set("session.gc_maxlifetime", 30 * 24 * 60 * 60); // Augmente la durée de vie du fichier de session serveur 
// session_start(); 

// Ici j'insère des informations dans la SESSION
// Je serai capable de les récupérer sur la page2.php
$_SESSION["test"] = "Coucou";
$_SESSION["connected_user"]["pseudo"] = "Pierra";
$_SESSION["connected_user"]["email"] = "Pierra@mail.com";
$_SESSION["connected_user"]["role"] = "admin";

var_dump($_SESSION);


/*  

Cas d'usage typiques de $_SESSION

    Connexion utilisateur : Conserver des informations utilisateur pendant toute la durée de leur navigation (nom, rôle, etc.).
    Panier d'achat : Sauvegarder temporairement des articles sélectionnés par l'utilisateur avant un achat.
    Stockage de message "flash" : Des messages temporaires que l'on souhaite afficher sur une prochaine page, dès l'affichage, on les supprime de la session
*/