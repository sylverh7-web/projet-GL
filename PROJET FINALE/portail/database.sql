-- ============================================================
-- SCRIPT DE CRÉATION DE LA BASE DE DONNÉES
-- Portail de Gestion Académique - Université de Yassa
-- ============================================================

-- Créer la base de données si elle n'existe pas
CREATE DATABASE IF NOT EXISTS universite_yassa 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;

-- Utiliser la base de données
USE universite_yassa;

-- ============================================================
-- TABLE : etudiants
-- Stocke toutes les informations des étudiants
-- ============================================================
CREATE TABLE IF NOT EXISTS etudiants (
    id VARCHAR(20) PRIMARY KEY COMMENT 'Numéro étudiant (ex: ET2024001)',
    nom VARCHAR(100) NOT NULL COMMENT 'Nom de famille',
    prenom VARCHAR(100) NOT NULL COMMENT 'Prénom(s)',
    classe VARCHAR(100) NOT NULL COMMENT 'Classe/Filière',
    dateNaissance DATE DEFAULT NULL COMMENT 'Date de naissance',
    lieuNaissance VARCHAR(200) DEFAULT NULL COMMENT 'Lieu de naissance',
    data TEXT NOT NULL COMMENT 'Données JSON (notes, scolarité, absences)',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT 'Date de création',
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Date de modification'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- INDEX pour améliorer les performances de recherche
-- ============================================================
CREATE INDEX idx_nom ON etudiants(nom);
CREATE INDEX idx_prenom ON etudiants(prenom);
CREATE INDEX idx_classe ON etudiants(classe);

-- ============================================================
-- DONNÉES DE TEST (4 étudiants)
-- ============================================================

INSERT INTO etudiants (id, nom, prenom, classe, dateNaissance, lieuNaissance, data) VALUES
('ET2024001', 'DEUS', 'BRAYAN', 'BTS GÉNIE LOGICIEL 1', '2001-05-15', 'Yaoundé, Cameroun', '{
    "statut": {
        "semestre1": "valide",
        "semestre2": "valide"
    },
    "scolarite": {
        "tranche1": "payee",
        "tranche2": "payee",
        "tranche3": "non-payee"
    },
    "absences": {
        "justifiees": 2,
        "injustifiees": 1,
        "total": 3
    },
    "notesSem1": [
        {"matiere": "Maths", "note": 14.5, "coefficient": 3, "semestre": 1},
        {"matiere": "Anglais", "note": 15.0, "coefficient": 2, "semestre": 1},
        {"matiere": "Français", "note": 13.5, "coefficient": 2, "semestre": 1}
    ],
    "notesSem2": [
        {"matiere": "Introduction Génie Logiciel", "note": 15.5, "coefficient": 3, "semestre": 2},
        {"matiere": "Algèbre De Boole", "note": 14.0, "coefficient": 2, "semestre": 2},
        {"matiere": "Infographie", "note": 16.5, "coefficient": 3, "semestre": 2},
        {"matiere": "Algorithme De Base", "note": 15.0, "coefficient": 2, "semestre": 2}
    ],
    "hideGrades": false,
    "hideValidation": false
}'),

('ET2024002', 'KAMDEM', 'PRINCESS', 'BTS GÉNIE LOGICIEL 1', '2000-12-20', 'Douala, Cameroun', '{
    "statut": {
        "semestre1": "valide",
        "semestre2": "valide"
    },
    "scolarite": {
        "tranche1": "payee",
        "tranche2": "payee",
        "tranche3": "payee"
    },
    "absences": {
        "justifiees": 1,
        "injustifiees": 0,
        "total": 1
    },
    "notesSem1": [
        {"matiere": "Maths", "note": 16.5, "coefficient": 3, "semestre": 1},
        {"matiere": "Anglais", "note": 17.0, "coefficient": 2, "semestre": 1},
        {"matiere": "Français", "note": 16.0, "coefficient": 2, "semestre": 1}
    ],
    "notesSem2": [
        {"matiere": "Introduction Génie Logiciel", "note": 17.0, "coefficient": 3, "semestre": 2},
        {"matiere": "Algèbre De Boole", "note": 16.5, "coefficient": 2, "semestre": 2},
        {"matiere": "Infographie", "note": 18.0, "coefficient": 3, "semestre": 2},
        {"matiere": "Algorithme De Base", "note": 17.5, "coefficient": 2, "semestre": 2}
    ],
    "hideGrades": false,
    "hideValidation": false
}'),

('ET2024003', 'RÉBECCA', 'LAURE', 'BTS GÉNIE LOGICIEL 1', '2001-08-10', 'Bafoussam, Cameroun', '{
    "statut": {
        "semestre1": "valide",
        "semestre2": "valide"
    },
    "scolarite": {
        "tranche1": "payee",
        "tranche2": "non-payee",
        "tranche3": "non-payee"
    },
    "absences": {
        "justifiees": 3,
        "injustifiees": 2,
        "total": 5
    },
    "notesSem1": [
        {"matiere": "Maths", "note": 13.5, "coefficient": 3, "semestre": 1},
        {"matiere": "Anglais", "note": 14.0, "coefficient": 2, "semestre": 1},
        {"matiere": "Français", "note": 12.5, "coefficient": 2, "semestre": 1}
    ],
    "notesSem2": [
        {"matiere": "Introduction Génie Logiciel", "note": 14.5, "coefficient": 3, "semestre": 2},
        {"matiere": "Algèbre De Boole", "note": 13.0, "coefficient": 2, "semestre": 2},
        {"matiere": "Infographie", "note": 15.5, "coefficient": 3, "semestre": 2},
        {"matiere": "Algorithme De Base", "note": 14.0, "coefficient": 2, "semestre": 2}
    ],
    "hideGrades": false,
    "hideValidation": false
}'),

('ET2024004', 'KAMTO', 'SYLVERE', 'BTS GÉNIE LOGICIEL 1', '2002-03-25', 'Yaoundé, Cameroun', '{
    "statut": {
        "semestre1": "valide",
        "semestre2": "valide"
    },
    "scolarite": {
        "tranche1": "payee",
        "tranche2": "payee",
        "tranche3": "non-payee"
    },
    "absences": {
        "justifiees": 4,
        "injustifiees": 5,
        "total": 9
    },
    "notesSem1": [
        {"matiere": "Maths", "note": 11.5, "coefficient": 3, "semestre": 1},
        {"matiere": "Anglais", "note": 12.0, "coefficient": 2, "semestre": 1},
        {"matiere": "Français", "note": 10.5, "coefficient": 2, "semestre": 1}
    ],
    "notesSem2": [
        {"matiere": "Introduction Génie Logiciel", "note": 12.5, "coefficient": 3, "semestre": 2},
        {"matiere": "Algèbre De Boole", "note": 11.0, "coefficient": 2, "semestre": 2},
        {"matiere": "Infographie", "note": 13.5, "coefficient": 3, "semestre": 2},
        {"matiere": "Algorithme De Base", "note": 12.0, "coefficient": 2, "semestre": 2}
    ],
    "hideGrades": false,
    "hideValidation": false
}');

-- ============================================================
-- VÉRIFICATION : Afficher le nombre d'étudiants insérés
-- ============================================================
SELECT COUNT(*) as 'Nombre d''étudiants' FROM etudiants;

-- ============================================================
-- FIN DU SCRIPT
-- ============================================================
