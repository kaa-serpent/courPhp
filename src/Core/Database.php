<?php
namespace App\Core;

use PDO;

class Database
{
    public function connect():\PDO
    {
        // Création d'un objet PDO
        $connection = new PDO(
            "mysql:host={$_ENV['DB_HOST']}; dbname={$_ENV['DB_NAME']}; charset=UTF8; port=3306;",
            $_ENV['DB_USER'],
            $_ENV['DB_PASSWORD'],

            // Désactivé le mode silencieux des erreurs
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],
        );
        return $connection;
    }
}
?>