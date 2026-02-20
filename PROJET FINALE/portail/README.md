# 📘 GUIDE D'INSTALLATION COMPLET - VERSION MySQL
## Portail de Gestion Académique - Université de Yassa

---

## 🎯 CE QUE VOUS ALLEZ FAIRE

Transformer votre portail qui utilisait **localStorage** (stockage navigateur) vers **MySQL** (base de données professionnelle).

**Durée totale : 15-20 minutes**

---

## 📋 PRÉREQUIS (À INSTALLER AVANT)

### ✅ XAMPP (Recommandé - Tout-en-un)

**Windows / Mac / Linux :**
1. Téléchargez XAMPP : https://www.apachefriends.org/
2. Installez (Next → Next → Next)
3. Lancez XAMPP Control Panel
4. Démarrez **Apache** et **MySQL** (cliquez sur "Start")

**OU**

### ✅ Installation séparée

- **PHP 7.4+** : https://www.php.net/downloads
- **MySQL 5.7+** : https://dev.mysql.com/downloads/mysql/
- **Apache** : https://httpd.apache.org/download.cgi

---

## 🚀 INSTALLATION EN 6 ÉTAPES

### ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
### ÉTAPE 1 : Extraire les fichiers
### ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

1. Extrayez le fichier ZIP que vous avez reçu
2. Vous obtenez un dossier `mysql-version/` avec ces fichiers :

```
mysql-version/
├── index.html           ← Interface web (votre code modifié)
├── config.php           ← Configuration MySQL
├── database.sql         ← Script de création de la base
├── get_students.php     ← API : Lire les étudiants
├── add_student.php      ← API : Ajouter/Modifier
├── delete_student.php   ← API : Supprimer
└── README.md            ← Ce fichier
```

### ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
### ÉTAPE 2 : Copier les fichiers vers le serveur
### ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

**Si vous utilisez XAMPP :**

1. Ouvrez le dossier d'installation de XAMPP
   - **Windows** : `C:\xampp\htdocs\`
   - **Mac** : `/Applications/XAMPP/htdocs/`
   - **Linux** : `/opt/lampp/htdocs/`

2. Créez un dossier `portail` dans `htdocs`

3. Copiez TOUS les fichiers de `mysql-version/` dans `htdocs/portail/`

**Résultat :**
```
C:\xampp\htdocs\portail\
├── index.html
├── config.php
├── database.sql
├── get_students.php
├── add_student.php
└── delete_student.php
```

### ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
### ÉTAPE 3 : Créer la base de données MySQL
### ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

**Méthode 1 : Via phpMyAdmin (Plus simple)**

1. Ouvrez votre navigateur
2. Allez sur : http://localhost/phpmyadmin
3. Cliquez sur l'onglet **"SQL"** en haut
4. Ouvrez le fichier `database.sql` avec Bloc-notes
5. **Copiez TOUT le contenu**
6. **Collez** dans la fenêtre SQL de phpMyAdmin
7. Cliquez sur **"Exécuter"** en bas à droite

✅ Vous devriez voir : `4 lignes insérées`

**Méthode 2 : Via ligne de commande**

```bash
# Ouvrir un terminal/invite de commandes

# Se connecter à MySQL
mysql -u root -p

# Entrer le mot de passe (vide par défaut sur XAMPP)

# Copier-coller le contenu de database.sql
# OU importer directement :
source C:\xampp\htdocs\portail\database.sql

# Vérifier
USE universite_yassa;
SELECT * FROM etudiants;

# Vous devriez voir 4 étudiants
```

### ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
### ÉTAPE 4 : Configurer la connexion MySQL
### ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

1. Ouvrez le fichier **`config.php`** avec un éditeur de texte

2. Modifiez ces lignes selon votre configuration :

```php
define('DB_HOST', 'localhost');        // Ne pas changer (sauf cas spécial)
define('DB_NAME', 'universite_yassa'); // Nom de la base (ne pas changer)
define('DB_USER', 'root');             // Utilisateur MySQL
define('DB_PASS', '');                 // Mot de passe (vide sur XAMPP par défaut)
```

**⚠️ IMPORTANT :**
- Sur XAMPP, le mot de passe est **VIDE** par défaut
- Si vous avez configuré un mot de passe, mettez-le dans `DB_PASS`

3. **Sauvegardez** le fichier

### ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
### ÉTAPE 5 : Tester l'installation
### ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

1. **Assurez-vous que Apache et MySQL sont démarrés dans XAMPP**

2. Ouvrez votre navigateur

3. Testez chaque URL :

**Test 1 - Interface principale :**
```
http://localhost/portail/
```
✅ Vous devez voir : L'interface du portail

**Test 2 - API Lecture :**
```
http://localhost/portail/get_students.php
```
✅ Vous devez voir : JSON avec 4 étudiants

**Test 3 - Recherche d'un étudiant :**
Dans l'interface, tapez : `ET2024001` et cliquez Rechercher
✅ Vous devez voir : La fiche de BRAYAN DEUS

**Test 4 - Connexion Admin :**
- Cliquez sur **"Admin"**
- Username : `admin`
- Password : `admin123`
✅ Vous devez voir : Le panneau d'administration

### ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
### ÉTAPE 6 : Utiliser l'application
### ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

**Interface Publique :**
- Recherchez un étudiant par numéro (ET2024001) ou nom (DEUS)
- Consultez les notes, moyennes, absences

**Interface Admin :**
1. Connectez-vous (admin / admin123)
2. Ajoutez un nouvel étudiant
3. Modifiez les notes (la moyenne se calcule automatiquement !)
4. Supprimez un étudiant

---

## 🎊 FÉLICITATIONS !

Votre portail fonctionne maintenant avec MySQL !

**Avantages par rapport à localStorage :**
- ✅ Données **permanentes** (ne se perdent jamais)
- ✅ **Multi-utilisateurs** (plusieurs admins en même temps)
- ✅ **Rapide** avec des milliers d'étudiants
- ✅ **Professionnel** et évolutif
- ✅ Facile à **sauvegarder** (export SQL)

---

## 🔧 DÉPANNAGE (PROBLÈMES COURANTS)

### ❌ Erreur : "XAMPP Apache déjà utilisé"
**Cause** : Le port 80 est occupé (Skype, IIS, autre serveur)
**Solution** :
1. Fermez Skype ou autre logiciel utilisant le port 80
2. OU changez le port Apache dans XAMPP :
   - Config → httpd.conf
   - Remplacez `Listen 80` par `Listen 8080`
   - Redémarrez Apache
   - Accédez via : http://localhost:8080/portail/

### ❌ Erreur : "Access denied for user 'root'"
**Cause** : Mot de passe MySQL incorrect
**Solution** :
1. Ouvrez `config.php`
2. Vérifiez `DB_PASS`
3. Sur XAMPP par défaut : `DB_PASS` doit être **vide** (`''`)

### ❌ Erreur : "Table 'universite_yassa.etudiants' doesn't exist"
**Cause** : La base de données n'a pas été créée
**Solution** :
1. Allez sur http://localhost/phpmyadmin
2. Vérifiez que la base `universite_yassa` existe
3. Si non, retournez à l'ÉTAPE 3

### ❌ Page blanche ou erreur 500
**Cause** : Erreur PHP
**Solution** :
1. Ouvrez `config.php`
2. Vérifiez que la ligne `error_reporting(E_ALL);` est présente
3. Rechargez la page pour voir l'erreur exacte
4. Vérifiez les logs : `C:\xampp\apache\logs\error.log`

### ❌ "No data" ou tableau vide
**Cause** : Pas de données dans la base
**Solution** :
1. Allez sur http://localhost/phpmyadmin
2. Cliquez sur `universite_yassa` → `etudiants`
3. Vérifiez qu'il y a 4 lignes
4. Si vide, réexécutez les INSERT du fichier `database.sql`

---

## 📊 STRUCTURE DE LA BASE DE DONNÉES

```sql
TABLE : etudiants
├── id (VARCHAR)              # ET2024001
├── nom (VARCHAR)             # DEUS
├── prenom (VARCHAR)          # BRAYAN
├── classe (VARCHAR)          # BTS GÉNIE LOGICIEL 1
├── dateNaissance (DATE)      # 2001-05-15
├── lieuNaissance (VARCHAR)   # Yaoundé, Cameroun
├── data (TEXT/JSON)          # {notes, scolarité, absences...}
├── created_at (TIMESTAMP)    # Date de création
└── updated_at (TIMESTAMP)    # Date de modification
```

**Le champ `data` contient en JSON :**
- statut (semestre1, semestre2)
- scolarite (tranche1, tranche2, tranche3)
- absences (justifiées, injustifiées, total)
- notesSem1 (array de {matière, note, coefficient})
- notesSem2 (array de {matière, note, coefficient})
- hideGrades (boolean)
- hideValidation (boolean)

---

## 🔐 SÉCURITÉ EN PRODUCTION

**⚠️ AVANT DE METTRE EN LIGNE :**

1. **Changez les credentials admin** dans le code JavaScript
2. **Définissez un mot de passe MySQL** :
   ```sql
   ALTER USER 'root'@'localhost' IDENTIFIED BY 'VotreMotDePasseSecurisé';
   ```
3. **Mettez à jour config.php** avec le nouveau mot de passe
4. **Activez HTTPS** (certificat SSL)
5. **Désactivez les erreurs PHP** en production :
   ```php
   error_reporting(0);
   ini_set('display_errors', 0);
   ```

---

## 📞 BESOIN D'AIDE ?

### Test de diagnostic rapide

```bash
# Test 1 : PHP fonctionne ?
http://localhost/portail/config.php

# Test 2 : MySQL fonctionne ?
http://localhost/phpmyadmin

# Test 3 : API fonctionne ?
http://localhost/portail/get_students.php
```

### Vérification MySQL directe

```bash
mysql -u root -p
USE universite_yassa;
SELECT COUNT(*) FROM etudiants;  # Doit retourner 4
SELECT * FROM etudiants WHERE id = 'ET2024001';
```

---

## 📁 SAUVEGARDE DE LA BASE DE DONNÉES

**Méthode 1 : Via phpMyAdmin**
1. http://localhost/phpmyadmin
2. Cliquez sur `universite_yassa`
3. Onglet **"Exporter"**
4. Cliquez **"Exécuter"**
5. Un fichier `.sql` se télécharge

**Méthode 2 : Via ligne de commande**
```bash
mysqldump -u root -p universite_yassa > sauvegarde.sql

# Restaurer :
mysql -u root -p universite_yassa < sauvegarde.sql
```

---

## 🎓 ÉTUDIANTS DE TEST

```
ID: ET2024001  |  Nom: BRAYAN DEUS
ID: ET2024002  |  Nom: PRINCESS KAMDEM
ID: ET2024003  |  Nom: LAURE RÉBECCA
ID: ET2024004  |  Nom: SYLVERE KAMTO
```

**Credentials Admin :**
- Username : `admin`
- Password : `admin123`

---

## 📈 PROCHAINES ÉTAPES (OPTIONNEL)

1. **Export PDF** des relevés de notes
2. **Import Excel** pour saisie massive
3. **Statistiques** (moyennes de classe, taux de réussite)
4. **Notifications email**
5. **Gestion multi-filières**
6. **Historique des modifications**

---

🇨🇲 **Université de Yassa** - Excellence, Innovation, Leadership
