<?php
/**
 * Script de test de connexion MySQL
 * Ce fichier vérifie que tout est bien configuré
 * Accès : http://localhost/portail/test.php
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<html><head>";
echo "<meta charset='UTF-8'>";
echo "<title>Test de Connexion MySQL</title>";
echo "<style>
    body { font-family: Arial, sans-serif; background: #f5f5f5; padding: 20px; }
    .container { max-width: 800px; margin: 0 auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
    h1 { color: #007A33; border-bottom: 3px solid #FCC419; padding-bottom: 10px; }
    .test { margin: 20px 0; padding: 15px; border-radius: 5px; border-left: 5px solid; }
    .success { background: #e8f5e9; border-color: #4caf50; }
    .error { background: #ffebee; border-color: #f44336; }
    .warning { background: #fff3e0; border-color: #ff9800; }
    .info { background: #e3f2fd; border-color: #2196f3; }
    .label { font-weight: bold; color: #333; }
    .value { color: #666; font-family: monospace; }
    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    th, td { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; }
    th { background: #007A33; color: white; }
    .code { background: #f5f5f5; padding: 10px; border-radius: 5px; font-family: monospace; overflow-x: auto; }
</style>
</head><body>";

echo "<div class='container'>";
echo "<h1>🔧 Test de Configuration MySQL</h1>";
echo "<p>Date : " . date('d/m/Y H:i:s') . "</p>";

// Test 1 : Fichier config.php existe
echo "<div class='test " . (file_exists('config.php') ? 'success' : 'error') . "'>";
echo "<strong>Test 1 : Fichier config.php</strong><br>";
if (file_exists('config.php')) {
    echo "✅ Le fichier config.php existe";
    require_once 'config.php';
} else {
    echo "❌ Le fichier config.php est introuvable";
    echo "</div></div></body></html>";
    exit;
}
echo "</div>";

// Test 2 : Constantes définies
echo "<div class='test " . (defined('DB_HOST') ? 'success' : 'error') . "'>";
echo "<strong>Test 2 : Configuration</strong><br>";
if (defined('DB_HOST')) {
    echo "✅ Configuration chargée<br>";
    echo "<span class='label'>Hôte :</span> <span class='value'>" . DB_HOST . "</span><br>";
    echo "<span class='label'>Base :</span> <span class='value'>" . DB_NAME . "</span><br>";
    echo "<span class='label'>Utilisateur :</span> <span class='value'>" . DB_USER . "</span><br>";
    echo "<span class='label'>Mot de passe :</span> <span class='value'>" . (empty(DB_PASS) ? '(vide)' : '***') . "</span>";
} else {
    echo "❌ Configuration non définie";
}
echo "</div>";

// Test 3 : Connexion MySQL
echo "<div class='test ";
try {
    $pdo = getDBConnection();
    echo "success'>";
    echo "<strong>Test 3 : Connexion MySQL</strong><br>";
    echo "✅ Connexion réussie à MySQL<br>";
    
    // Version MySQL
    $version = $pdo->query('SELECT VERSION()')->fetchColumn();
    echo "<span class='label'>Version MySQL :</span> <span class='value'>$version</span>";
    
} catch (Exception $e) {
    echo "error'>";
    echo "<strong>Test 3 : Connexion MySQL</strong><br>";
    echo "❌ Erreur de connexion<br>";
    echo "<span class='value'>" . htmlspecialchars($e->getMessage()) . "</span><br><br>";
    echo "<strong>Solutions possibles :</strong><br>";
    echo "1. Vérifiez que MySQL est démarré dans XAMPP<br>";
    echo "2. Vérifiez le mot de passe dans config.php<br>";
    echo "3. Vérifiez que le port 3306 n'est pas bloqué";
    echo "</div></div></body></html>";
    exit;
}
echo "</div>";

// Test 4 : Base de données existe
echo "<div class='test ";
try {
    $stmt = $pdo->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    if (count($tables) > 0) {
        echo "success'>";
        echo "<strong>Test 4 : Base de données</strong><br>";
        echo "✅ Base de données 'universite_yassa' trouvée<br>";
        echo "<span class='label'>Tables :</span> <span class='value'>" . implode(', ', $tables) . "</span>";
    } else {
        echo "warning'>";
        echo "<strong>Test 4 : Base de données</strong><br>";
        echo "⚠️ La base existe mais aucune table trouvée<br>";
        echo "Exécutez le fichier database.sql dans phpMyAdmin";
    }
    
} catch (Exception $e) {
    echo "error'>";
    echo "<strong>Test 4 : Base de données</strong><br>";
    echo "❌ La base 'universite_yassa' n'existe pas<br>";
    echo "<br><strong>Solution :</strong><br>";
    echo "1. Allez sur http://localhost/phpmyadmin<br>";
    echo "2. Cliquez sur 'SQL'<br>";
    echo "3. Copiez le contenu de database.sql<br>";
    echo "4. Cliquez 'Exécuter'";
}
echo "</div>";

// Test 5 : Table etudiants
echo "<div class='test ";
try {
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM etudiants");
    $count = $stmt->fetch()['total'];
    
    if ($count > 0) {
        echo "success'>";
        echo "<strong>Test 5 : Table étudiants</strong><br>";
        echo "✅ Table 'etudiants' trouvée avec $count étudiant(s)";
    } else {
        echo "warning'>";
        echo "<strong>Test 5 : Table étudiants</strong><br>";
        echo "⚠️ Table existe mais vide<br>";
        echo "Exécutez les INSERT du fichier database.sql";
    }
    
} catch (Exception $e) {
    echo "error'>";
    echo "<strong>Test 5 : Table étudiants</strong><br>";
    echo "❌ Table 'etudiants' introuvable<br>";
    echo "Exécutez database.sql dans phpMyAdmin";
}
echo "</div>";

// Test 6 : Afficher les étudiants
try {
    $stmt = $pdo->query("SELECT id, nom, prenom, classe FROM etudiants LIMIT 10");
    $students = $stmt->fetchAll();
    
    if (count($students) > 0) {
        echo "<div class='test success'>";
        echo "<strong>Test 6 : Données de test</strong><br>";
        echo "✅ Étudiants trouvés dans la base<br><br>";
        
        echo "<table>";
        echo "<tr><th>ID</th><th>Nom</th><th>Prénom</th><th>Classe</th></tr>";
        foreach ($students as $student) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($student['id']) . "</td>";
            echo "<td>" . htmlspecialchars($student['nom']) . "</td>";
            echo "<td>" . htmlspecialchars($student['prenom']) . "</td>";
            echo "<td>" . htmlspecialchars($student['classe']) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "</div>";
    }
} catch (Exception $e) {
    // Déjà géré dans Test 5
}

// Test 7 : Fichiers API
echo "<div class='test ";
$apiFiles = ['get_students.php', 'add_student.php', 'delete_student.php'];
$allExist = true;
foreach ($apiFiles as $file) {
    if (!file_exists($file)) {
        $allExist = false;
        break;
    }
}

if ($allExist) {
    echo "success'>";
    echo "<strong>Test 7 : Fichiers API</strong><br>";
    echo "✅ Tous les fichiers API sont présents<br>";
    echo "<ul style='margin-top: 10px;'>";
    foreach ($apiFiles as $file) {
        echo "<li><a href='$file' target='_blank'>$file</a></li>";
    }
    echo "</ul>";
} else {
    echo "warning'>";
    echo "<strong>Test 7 : Fichiers API</strong><br>";
    echo "⚠️ Certains fichiers API sont manquants<br>";
    echo "Vérifiez que vous avez bien copié tous les fichiers";
}
echo "</div>";

// Résumé final
echo "<div class='test info'>";
echo "<strong>📊 Résumé</strong><br><br>";

$phpVersion = phpversion();
$mysqlVersion = $version ?? 'N/A';
$studentsCount = $count ?? 0;

echo "<span class='label'>Version PHP :</span> <span class='value'>$phpVersion</span><br>";
echo "<span class='label'>Version MySQL :</span> <span class='value'>$mysqlVersion</span><br>";
echo "<span class='label'>Étudiants en base :</span> <span class='value'>$studentsCount</span><br><br>";

if ($allExist && isset($pdo) && $count > 0) {
    echo "<div style='background: #e8f5e9; padding: 20px; border-radius: 5px; border-left: 5px solid #4caf50; margin-top: 20px;'>";
    echo "<h2 style='color: #4caf50; margin-top: 0;'>🎉 Installation Réussie !</h2>";
    echo "<p>Tout fonctionne correctement. Vous pouvez maintenant :</p>";
    echo "<ul>";
    echo "<li><strong><a href='index.html'>Accéder au portail</a></strong></li>";
    echo "<li><strong><a href='get_students.php'>Tester l'API</a></strong></li>";
    echo "<li><strong><a href='http://localhost/phpmyadmin'>Ouvrir phpMyAdmin</a></strong></li>";
    echo "</ul>";
    echo "<p style='margin-bottom: 0;'><strong>Identifiants admin :</strong> admin / admin123</p>";
    echo "</div>";
} else {
    echo "<div style='background: #ffebee; padding: 20px; border-radius: 5px; border-left: 5px solid #f44336; margin-top: 20px;'>";
    echo "<h2 style='color: #f44336; margin-top: 0;'>⚠️ Configuration Incomplète</h2>";
    echo "<p>Consultez les tests ci-dessus et corrigez les erreurs.</p>";
    echo "<p><strong>Besoin d'aide ?</strong> Consultez le fichier README.md</p>";
    echo "</div>";
}

echo "</div>";

echo "</div>"; // fin container
echo "</body></html>";
?>
