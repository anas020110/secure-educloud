<?php

namespace App;

use PDO;

class Utils
{
    private static $pdo;

    public static function database()
    {
        if (!self::$pdo) {
            $host = 'localhost';
            $db = 'educloud'; // Correct DB name from your screenshot
            $user = 'root';
            $pass = ''; // Update if your MySQL password is set
            $charset = 'utf8mb4';

            $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];

            try {
                self::$pdo = new PDO($dsn, $user, $pass, $options);
            } catch (\PDOException $e) {
                die("Database connection failed: " . $e->getMessage());
            }
        }

        return self::$pdo;
    }
}
