<?php
/**
 * Configuration de la connexion MySQL
 * Modifiez ces valeurs selon votre configuration
 */

// Paramètres de connexion MySQL
define('DB_HOST', 'localhost');        // Hôte de la base de données
define('DB_NAME', 'universite_yassa'); // Nom de la base de données
define('DB_USER', 'root');             // Nom d'utilisateur MySQL
define('DB_PASS', '');                 // Mot de passe MySQL (vide par défaut sur XAMPP)
define('DB_CHARSET', 'utf8mb4');       // Encodage UTF-8 pour les accents

/**
 * Fonction de connexion à la base de données
 * Retourne un objet PDO ou affiche une erreur
 */
function getDBConnection() {
    try {
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        
        $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
        return $pdo;
        
    } catch (PDOException $e) {
        // En cas d'erreur, afficher un message clair
        die(json_encode([
            'error' => true,
            'message' => 'Erreur de connexion à la base de données',
            'details' => $e->getMessage()
        ]));
    }
}
?>
