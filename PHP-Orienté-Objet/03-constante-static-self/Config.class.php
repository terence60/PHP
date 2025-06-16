<?php 

// Ici on se sert d'éléments static pour définir des éléments de configuration de notre site web 

class Config {
    public const BASE_URL = "https://www.monsite.com/";
    public const UPLOAD_PATH = "c:/wamp/var/qqchoz";
    public const DB_NAME = "eshop";
    public const DB_LOGIN = "root";
    public const DB_PASSWORD = "password";
}

// Utilisation
echo "Base URL : " . Config::BASE_URL;