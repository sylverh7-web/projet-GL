# 🎯 INSTALLATION RAPIDE - 5 MINUTES

## Version MySQL du Portail Étudiant

---

## ✅ CE DONT VOUS AVEZ BESOIN

**XAMPP** (contient Apache + MySQL + PHP tout-en-un)
- 👉 Télécharger : https://www.apachefriends.org/
- 📦 Taille : ~150 MB
- ⏱️ Installation : 5 minutes

---

## 🚀 INSTALLATION EN 4 ÉTAPES

### 📥 ÉTAPE 1 : Installer XAMPP (si pas déjà fait)

1. Téléchargez XAMPP
2. Lancez l'installateur
3. Cliquez **Next → Next → Next → Finish**
4. Lancez **XAMPP Control Panel**

### ▶️ ÉTAPE 2 : Démarrer les services

Dans XAMPP Control Panel :

```
┌────────────────────────────────────┐
│  Module    │  Actions              │
├────────────┼───────────────────────┤
│  Apache    │  [Start] ← CLIQUEZ    │
│  MySQL     │  [Start] ← CLIQUEZ    │
└────────────┴───────────────────────┘
```

✅ Les deux doivent afficher "Running" en vert

### 📂 ÉTAPE 3 : Copier les fichiers

1. **Extrayez** le fichier `portail-mysql.zip`

2. **Ouvrez** le dossier XAMPP :
   - Windows : `C:\xampp\htdocs\`
   - Mac : `/Applications/XAMPP/htdocs/`

3. **Créez** un dossier nommé `portail`

4. **Copiez** tous les fichiers de `mysql-version/` dans `htdocs/portail/`

**Résultat final :**
```
C:\xampp\htdocs\portail\
├── index.html
├── config.php
├── database.sql
├── get_students.php
├── add_student.php
├── delete_student.php
├── test.php
└── README.md
```

### 🗄️ ÉTAPE 4 : Créer la base de données

**Méthode Super Simple :**

1. Ouvrez votre navigateur

2. Allez sur : **http://localhost/phpmyadmin**

3. Cliquez sur l'onglet **"SQL"** (en haut)

4. Ouvrez le fichier **`database.sql`** avec Bloc-notes

5. **Sélectionnez TOUT** (Ctrl+A) et **Copiez** (Ctrl+C)

6. **Collez** dans phpMyAdmin (Ctrl+V)

7. Cliquez le gros bouton **"Exécuter"** en bas à droite

✅ Vous devez voir : **4 lignes insérées**

---

## 🎉 C'EST FAIT !

### ✅ Vérification

Ouvrez : **http://localhost/portail/test.php**

Vous devriez voir tous les tests en **vert** ✅

### 🌐 Accès à l'application

**Interface Publique :**
👉 http://localhost/portail/

**Interface Admin :**
- Cliquez sur "Admin"
- Username : `admin`
- Password : `admin123`

### 🎓 Étudiants de test

Dans la recherche, tapez :
- `ET2024001` → BRAYAN DEUS
- `ET2024002` → PRINCESS KAMDEM
- `ET2024003` → LAURE RÉBECCA
- `ET2024004` → SYLVERE KAMTO

---

## ❓ PROBLÈME ?

### Apache ne démarre pas

**Cause :** Port 80 occupé (Skype, IIS...)

**Solution :**
1. Fermez Skype
2. OU dans XAMPP, cliquez **Config** (à côté d'Apache)
3. Changez `Listen 80` en `Listen 8080`
4. Accès : http://localhost:8080/portail/

### Page blanche ou erreur

**Solution :**
1. Vérifiez que MySQL est démarré (vert dans XAMPP)
2. Ouvrez : http://localhost/portail/test.php
3. Lisez les messages d'erreur

### "Table doesn't exist"

**Solution :**
1. Retournez à l'ÉTAPE 4
2. Réexécutez le fichier `database.sql` dans phpMyAdmin

---

## 📖 DOCUMENTATION COMPLÈTE

Consultez **README.md** pour :
- Configuration avancée
- Sécurité en production
- Dépannage détaillé
- Sauvegarde de la base

---

## 🎯 DIFFÉRENCE AVEC L'ANCIENNE VERSION

### AVANT (localStorage)
```
❌ Données perdues si vous videz le cache
❌ Une seule personne à la fois
❌ Lent avec beaucoup d'étudiants
❌ Pas de sauvegarde automatique
```

### MAINTENANT (MySQL)
```
✅ Données PERMANENTES
✅ Multi-utilisateurs simultanés
✅ Rapide même avec 10 000+ étudiants
✅ Sauvegarde facile (export SQL)
✅ Professionnel et évolutif
```

---

## 📞 BESOIN D'AIDE ?

**Test rapide :**
- http://localhost/portail/test.php ← Diagnostic complet
- http://localhost/phpmyadmin ← Accès direct à MySQL
- http://localhost/portail/get_students.php ← Test API

**Vérification fichiers :**
```
C:\xampp\htdocs\portail\  ← Tout doit être ici
```

---

🇨🇲 **Université de Yassa** - Excellence, Innovation, Leadership

**Version :** MySQL 1.0  
**Date :** Février 2026
