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

// Attendre que MySQL soit prêt (max 60 tentatives = 120 secondes)
$maxAttempts = 60;
$attempt = 0;
$connected = false;

echo "⏳ Attente de la disponibilité de MySQL...\n";

while ($attempt < $maxAttempts && !$connected) {
    try {
        $conn = new mysqli($host, $user, $password, $database);
        if ($conn->connect_error) {
            $attempt++;
            if ($attempt % 5 == 0) {
                echo "   Tentative $attempt/$maxAttempts...\n";
            }
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

// Fonction pour vérifier si une table existe
function tableExists($conn, $tableName) {
    $result = $conn->query("SHOW TABLES LIKE '$tableName'");
    return $result && $result->num_rows > 0;
}

// Fonction pour compter les enregistrements dans une table (retourne 0 si la table n'existe pas)
function countRecords($conn, $tableName) {
    if (!tableExists($conn, $tableName)) {
        return 0;
    }
    $result = $conn->query("SELECT COUNT(*) as count FROM `$tableName`");
    if ($result) {
        $row = $result->fetch_assoc();
        return (int)$row['count'];
    }
    return 0;
}

// Fonction pour exécuter un fichier SQL
function executeSQLFile($conn, $filePath) {
    if (!file_exists($filePath)) {
        echo "⚠️  Fichier introuvable: $filePath\n";
        return false;
    }
    
    $sql = file_get_contents($filePath);
    if (empty(trim($sql))) {
        echo "⚠️  Le fichier est vide: $filePath\n";
        return false;
    }
    
    // Pour les fichiers avec DELIMITER (procédures stockées), utiliser multi_query
    // Sinon, diviser par point-virgule et exécuter chaque requête séparément
    if (strpos($sql, 'DELIMITER') !== false) {
        // Fichier avec procédures stockées - utiliser multi_query
        if ($conn->multi_query($sql)) {
            do {
                if ($result = $conn->store_result()) {
                    $result->free();
                }
            } while ($conn->next_result());
            
            if ($conn->errno) {
                echo "⚠️  Erreur SQL: " . $conn->error . " (Code: " . $conn->errno . ")\n";
                return false;
            }
            return true;
        } else {
            echo "⚠️  Erreur lors de l'exécution: " . $conn->error . " (Code: " . $conn->errno . ")\n";
            return false;
        }
    } else {
        // Fichier simple - diviser par point-virgule
        $queries = array_filter(array_map('trim', explode(';', $sql)), function($q) {
            return !empty($q) && !preg_match('/^--/', $q) && !preg_match('/^\/\*/', $q);
        });
        
        foreach ($queries as $query) {
            if (!empty(trim($query))) {
                if (!$conn->query($query)) {
                    echo "⚠️  Erreur SQL: " . $conn->error . " (Code: " . $conn->errno . ")\n";
                    echo "   Requête: " . substr($query, 0, 100) . "...\n";
                    return false;
                }
            }
        }
        return true;
    }
}

// Liste des tables principales à vérifier
$mainTables = ['users', 'messages', 'sites', 'affiches', 'identites', 'shootings'];

// Vérifier si les tables principales existent
$tablesExist = true;
foreach ($mainTables as $table) {
    if (!tableExists($conn, $table)) {
        $tablesExist = false;
        echo "⚠️  Table '$table' n'existe pas\n";
        break;
    }
}

// Si les tables n'existent pas, exécuter init.sql d'abord
if (!$tablesExist) {
    echo "📋 Les tables n'existent pas, exécution de init.sql...\n";
    $initFile = __DIR__ . '/init.sql';
    
    if (executeSQLFile($conn, $initFile)) {
        echo "✅ Tables créées avec succès\n";
    } else {
        echo "❌ Erreur lors de la création des tables\n";
        $conn->close();
        exit(1);
    }
}

// Vérifier si l'utilisateur admin existe, sinon le créer
$adminExists = false;
if (tableExists($conn, 'users')) {
    $result = $conn->query("SELECT COUNT(*) as count FROM users WHERE username = 'admin'");
    if ($result) {
        $row = $result->fetch_assoc();
        $adminExists = (int)$row['count'] > 0;
    }
    
    if (!$adminExists) {
        echo "👤 Création de l'utilisateur admin...\n";
        // Hash bcrypt pour "admin123"
        $adminPassword = '$2y$10$v5HqkpgEPTXDi2rD0deKCu880i3dEGqq9nJd0j4K4AOF1JODroQv6';
        $stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
        if ($stmt) {
            $username = 'admin';
            $email = 'admin@orume.com';
            $role = 'admin';
            $stmt->bind_param("ssss", $username, $email, $adminPassword, $role);
            if ($stmt->execute()) {
                echo "✅ Utilisateur admin créé avec succès\n";
                echo "   Username: admin\n";
                echo "   Password: admin123\n";
            } else {
                echo "⚠️  Erreur lors de la création de l'admin: " . $stmt->error . "\n";
            }
            $stmt->close();
        }
    } else {
        echo "✅ Utilisateur admin existe déjà\n";
    }
}

// Liste des tables de données à vérifier (sans users car l'admin peut déjà exister)
$dataTables = ['messages', 'sites', 'affiches', 'identites', 'shootings'];

// Vérifier si les tables de données sont vides
$totalData = 0;
$hasData = false;
foreach ($dataTables as $table) {
    $count = countRecords($conn, $table);
    if ($count > 0) {
        $hasData = true;
        echo "   Table '$table': $count enregistrement(s)\n";
    }
    $totalData += $count;
}

// Vérifier aussi la table clients (optionnelle)
$clientsCount = countRecords($conn, 'clients');
if ($clientsCount > 0) {
    echo "   Table 'clients': $clientsCount enregistrement(s)\n";
    $totalData += $clientsCount;
}

if (!$hasData || $totalData === 0) {
    echo "📦 Les tables de données sont vides, exécution du seeder...\n";
    
    // Exécuter le fichier seed.sql
    $seedFile = __DIR__ . '/seed.sql';
    
    if (executeSQLFile($conn, $seedFile)) {
        echo "✅ Seeder exécuté avec succès\n";
        
        // Afficher le nombre d'enregistrements après le seed
        $newTotal = 0;
        foreach ($dataTables as $table) {
            $count = countRecords($conn, $table);
            $newTotal += $count;
            if ($count > 0) {
                echo "   ✓ Table '$table': $count enregistrement(s)\n";
            }
        }
        
        $clientsCountAfter = countRecords($conn, 'clients');
        if ($clientsCountAfter > 0) {
            echo "   ✓ Table 'clients': $clientsCountAfter enregistrement(s)\n";
            $newTotal += $clientsCountAfter;
        }
        
        echo "📊 Total d'enregistrements après seed: $newTotal\n";
    } else {
        echo "❌ Erreur lors de l'exécution du seeder\n";
        $conn->close();
        exit(1);
    }
} else {
    echo "ℹ️  Les tables de données contiennent déjà des données ($totalData enregistrements), le seeder ne sera pas exécuté\n";
}

$conn->close();

