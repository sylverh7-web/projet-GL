<?php
/**
 * API : Supprimer un étudiant
 * Méthode : GET (avec paramètre ?id=...)
 * URL : delete_student.php?id=ET2024001
 */

// Activer les erreurs pour le développement
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Headers pour CORS et JSON
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Methods: GET, DELETE');

// Inclure la configuration de la base de données
require_once 'config.php';

// Récupérer l'ID de l'étudiant à supprimer
$id = isset($_GET['id']) ? trim($_GET['id']) : '';

// Valider que l'ID est fourni
if (empty($id)) {
    http_response_code(400);
    echo json_encode([
        'error' => true,
        'message' => 'L\'ID de l\'étudiant est obligatoire'
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

try {
    // Connexion à la base de données
    $pdo = getDBConnection();
    
    // Vérifier que l'étudiant existe
    $checkSQL = "SELECT id, nom, prenom FROM etudiants WHERE id = ?";
    $checkStmt = $pdo->prepare($checkSQL);
    $checkStmt->execute([$id]);
    $student = $checkStmt->fetch();
    
    if (!$student) {
        http_response_code(404);
        echo json_encode([
            'error' => true,
            'message' => 'Étudiant non trouvé'
        ], JSON_UNESCAPED_UNICODE);
        exit;
    }
    
    // Supprimer l'étudiant
    $sql = "DELETE FROM etudiants WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    
    // Vérifier que la suppression a réussi
    if ($stmt->rowCount() > 0) {
        echo json_encode([
            'success' => true,
            'message' => 'Étudiant supprimé avec succès',
            'id' => $id,
            'nom' => $student['nom'],
            'prenom' => $student['prenom']
        ], JSON_UNESCAPED_UNICODE);
    } else {
        http_response_code(500);
        echo json_encode([
            'error' => true,
            'message' => 'Erreur lors de la suppression'
        ], JSON_UNESCAPED_UNICODE);
    }
    
} catch (Exception $e) {
    // En cas d'erreur
    http_response_code(500);
    echo json_encode([
        'error' => true,
        'message' => 'Erreur lors de la suppression',
        'details' => $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
}
?>
