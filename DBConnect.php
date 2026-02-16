<?php

require_once '_config.php';

class DBConnect
{
    private $pdo;

    public function __construct()
    {
        try {
            // Construction du DSN (Data Source Name)
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8";
            
            // Options pour activer les erreurs PDO et le mode de récupération par défaut
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ];

            $this->pdo = new PDO($dsn, DB_USER, DB_PASSWORD, $options);
            
        } catch (PDOException $e) {
            throw new Exception("Erreur de connexion à la base de données.");
        }
    }

    public function getPDO()
    {
        return $this->pdo;
    }
}