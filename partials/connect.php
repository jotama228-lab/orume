<?php
/**
 * ============================================
 * FICHIER DE CONNEXION À LA BASE DE DONNÉES
 * ============================================
 * 
 * ⚠️ DÉPRÉCIÉ : Ce fichier est conservé pour la compatibilité
 * avec l'ancien code. Utilisez plutôt la classe Database via
 * le système d'autoloading.
 * 
 * Pour utiliser la nouvelle structure :
 * require_once __DIR__ . '/../../bootstrap.php';
 * $db = \Orüme\Core\Database::getInstance();
 * $connect = $db->getConnection();
 * 
 * @package Orüme
 * @deprecated Utiliser Database::getInstance() à la place
 * @version 1.0.0
 */

// Charger le bootstrap si disponible
if (file_exists(__DIR__ . '/../bootstrap.php')) {
    require_once __DIR__ . '/../bootstrap.php';
    
    // Utiliser la nouvelle classe Database
    $db = \Orüme\Core\Database::getInstance();
    $connect = $db->getConnection();
} else {
    // Fallback vers l'ancienne méthode pour compatibilité
    $host = getenv('DB_HOST') ?: 'localhost';
    $user = getenv('DB_USER') ?: 'root';
    $pass = getenv('DB_PASS') ?: '';
    $dbname = getenv('DB_NAME') ?: 'orume';

    // Connexion
    $connect = mysqli_connect($host, $user, $pass, $dbname);

    // Vérification
    if ($connect) {
        mysqli_set_charset($connect, "utf8mb4");
    } else {
        // En production, logger l'erreur au lieu de l'afficher
        error_log("Échec de connexion à la base de données : " . mysqli_connect_error());
    }
}
