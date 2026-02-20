<?php
/**
 * API : Récupérer tous les étudiants
 * Méthode : GET
 * URL : get_students.php
 */

// Activer les erreurs pour le développement
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Headers pour CORS et JSON
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Methods: GET');

// Inclure la configuration de la base de données
require_once 'config.php';

try {
    // Connexion à la base de données
    $pdo = getDBConnection();
    
    // Préparer la requête SQL
    $sql = "SELECT 
                id,
                nom,
                prenom,
                classe,
                dateNaissance,
                lieuNaissance,
                data,
                created_at,
                updated_at
            FROM etudiants
            ORDER BY nom, prenom";
    
    // Exécuter la requête
    $stmt = $pdo->query($sql);
    $students = $stmt->fetchAll();
    
    // Transformer les résultats
    $result = [];
    foreach ($students as $student) {
        // Décoder le JSON stocké dans le champ 'data'
        $data = json_decode($student['data'], true);
        
        // Fusionner les données
        $result[] = array_merge([
            'id' => $student['id'],
            'nom' => $student['nom'],
            'prenom' => $student['prenom'],
            'classe' => $student['classe'],
            'dateNaissance' => $student['dateNaissance'],
            'lieuNaissance' => $student['lieuNaissance']
        ], $data);
    }
    
    // Retourner les données en JSON
    echo json_encode($result, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    
} catch (Exception $e) {
    // En cas d'erreur, retourner un message d'erreur
    http_response_code(500);
    echo json_encode([
        'error' => true,
        'message' => 'Erreur lors de la récupération des étudiants',
        'details' => $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
}
?>
