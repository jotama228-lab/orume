<?php
/**
 * Script PHP pour vérifier si la base de données est vide
 * et exécuter automatiquement le seeder
 */

// Configuration de la base de données
$host = getenv('DB_HOST') ?: 'db';
$user = getenv('DB_USER') ?: 'orume_user';
$password = getenv('DB_PASS') ?: 'orume_password';
$database = getenv('DB_NAME') ?: 'orume';

// Attendre que MySQL soit prêt (max 30 tentatives = 60 secondes)
$maxAttempts = 30;
$attempt = 0;
$connected = false;

while ($attempt < $maxAttempts && !$connected) {
    try {
        $conn = new mysqli($host, $user, $password, $database);
        if ($conn->connect_error) {
            $attempt++;
            sleep(2);
        } else {
            $connected = true;
        }
    } catch (Exception $e) {
        $attempt++;
        sleep(2);
    }
}

if (!$connected) {
    echo "❌ Impossible de se connecter à MySQL après $maxAttempts tentatives\n";
    exit(1);
}

echo "✅ Connexion à MySQL établie\n";

// Vérifier si la base de données est vide
$query = "
    SELECT 
        (SELECT COUNT(*) FROM users) +
        (SELECT COUNT(*) FROM messages) +
        (SELECT COUNT(*) FROM sites) +
        (SELECT COUNT(*) FROM affiches) +
        (SELECT COUNT(*) FROM identites) +
        (SELECT COUNT(*) FROM shootings) +
        (SELECT COUNT(*) FROM clients)
    AS total;
";

$result = $conn->query($query);
$row = $result->fetch_assoc();
$total = (int)$row['total'];

if ($total === 0) {
    echo "📦 La base de données est vide, exécution du seeder...\n";
    
    // Lire et exécuter le fichier seed.sql
    $seedFile = __DIR__ . '/seed.sql';
    
    if (file_exists($seedFile)) {
        // Lire le fichier seed.sql
        $seedSQL = file_get_contents($seedFile);
        
        // Exécuter le fichier SQL complet (nécessaire pour les procédures stockées)
        if ($conn->multi_query($seedSQL)) {
            do {
                // Consommer les résultats
                if ($result = $conn->store_result()) {
                    $result->free();
                }
            } while ($conn->next_result());
            
            echo "✅ Seeder exécuté avec succès\n";
        } else {
            echo "⚠️  Erreur lors de l'exécution du seeder: " . $conn->error . "\n";
        }
    } else {
        echo "⚠️  Fichier seed.sql introuvable: $seedFile\n";
    }
} else {
    echo "ℹ️  La base de données contient déjà des données ($total enregistrements), le seeder ne sera pas exécuté\n";
}

$conn->close();

