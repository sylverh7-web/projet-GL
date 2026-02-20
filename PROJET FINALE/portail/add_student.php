<?php
/**
 * API : Ajouter ou modifier un étudiant
 * Méthode : POST
 * URL : add_student.php
 */

// Activer les erreurs pour le développement
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Headers pour CORS et JSON
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Inclure la configuration de la base de données
require_once 'config.php';

// Lire les données JSON envoyées
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, true);

// Vérifier que les données sont valides
if (!$input) {
    http_response_code(400);
    echo json_encode([
        'error' => true,
        'message' => 'Données JSON invalides'
    ]);
    exit;
}

// Valider les champs obligatoires
$required = ['id', 'nom', 'prenom', 'classe'];
foreach ($required as $field) {
    if (empty($input[$field])) {
        http_response_code(400);
        echo json_encode([
            'error' => true,
            'message' => "Le champ '$field' est obligatoire"
        ]);
        exit;
    }
}

try {
    // Connexion à la base de données
    $pdo = getDBConnection();
    
    // Extraire les champs de base
    $id = $input['id'];
    $nom = $input['nom'];
    $prenom = $input['prenom'];
    $classe = $input['classe'];
    $dateNaissance = isset($input['dateNaissance']) ? $input['dateNaissance'] : null;
    $lieuNaissance = isset($input['lieuNaissance']) ? $input['lieuNaissance'] : null;
    
    // Préparer les données JSON (tout le reste)
    $dataFields = [
        'statut', 'scolarite', 'absences', 
        'notesSem1', 'notesSem2', 
        'hideGrades', 'hideValidation'
    ];
    
    $data = [];
    foreach ($dataFields as $field) {
        if (isset($input[$field])) {
            $data[$field] = $input[$field];
        }
    }
    
    // Convertir en JSON
    $dataJSON = json_encode($data, JSON_UNESCAPED_UNICODE);
    
    // Vérifier si l'étudiant existe déjà
    $checkSQL = "SELECT id FROM etudiants WHERE id = ?";
    $checkStmt = $pdo->prepare($checkSQL);
    $checkStmt->execute([$id]);
    $exists = $checkStmt->fetch();
    
    if ($exists) {
        // UPDATE : Modifier l'étudiant existant
        $sql = "UPDATE etudiants 
                SET nom = ?, 
                    prenom = ?, 
                    classe = ?, 
                    dateNaissance = ?, 
                    lieuNaissance = ?, 
                    data = ?
                WHERE id = ?";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $nom, 
            $prenom, 
            $classe, 
            $dateNaissance, 
            $lieuNaissance, 
            $dataJSON,
            $id
        ]);
        
        echo json_encode([
            'success' => true,
            'message' => 'Étudiant modifié avec succès',
            'action' => 'update',
            'id' => $id
        ], JSON_UNESCAPED_UNICODE);
        
    } else {
        // INSERT : Ajouter un nouvel étudiant
        $sql = "INSERT INTO etudiants 
                (id, nom, prenom, classe, dateNaissance, lieuNaissance, data) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $id, 
            $nom, 
            $prenom, 
            $classe, 
            $dateNaissance, 
            $lieuNaissance, 
            $dataJSON
        ]);
        
        echo json_encode([
            'success' => true,
            'message' => 'Étudiant ajouté avec succès',
            'action' => 'insert',
            'id' => $id
        ], JSON_UNESCAPED_UNICODE);
    }
    
} catch (Exception $e) {
    // En cas d'erreur
    http_response_code(500);
    echo json_encode([
        'error' => true,
        'message' => 'Erreur lors de l\'enregistrement',
        'details' => $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
}
?>
