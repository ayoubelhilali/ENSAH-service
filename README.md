
# 📚 Application Web de Gestion des Affectations des Enseignements

Projet réalisé dans le cadre du module **Web 1** à l'**ENSA Al Hoceima**, filière **GI1**, année universitaire **2024/2025**.

## 🎯 Objectif du projet

Cette application web (ENSAH-service) a pour but de **centraliser et automatiser** le processus d’affectation des unités d’enseignement (UE) aux enseignants, tout en assurant une **répartition équitable** des charges horaires et une **gestion simplifiée** pour les différents intervenants (administrateurs, chefs de département, coordonnateurs, professeurs et vacataires).

---

## 🧑‍💻 Technologies utilisées

### 🖥️ Frontend
- **HTML5**
- **CSS3**
- **JavaScript**
- **Bootstrap 5**

### ⚙️ Backend
- **PHP (avec PDO pour l'accès à la base de données)**
- **PHPMailer** : utilisé pour l’envoi des emails (notification, validation, etc.)

---

## 👥 Types d'utilisateurs et fonctionnalités principales

### 🛠️ Admin
- Création de comptes utilisateurs (professeurs, chefs de département, etc.)
- Affectation des rôles

### 🧑‍🏫 Chef de département
- Gestion des unités d’enseignement liées au département
- Affectation et validation des UE aux enseignants
- Calcul et visualisation des charges horaires
- Gestion des UE vacantes
- Export/Import Excel
- Historique des affectations

### 👨‍🔬 Coordonnateur de filière
- Création du descriptif des UE de sa filière
- Définition des groupes TD/TP
- Affectation des UE aux vacataires
- Suivi et consultation des emplois du temps
- Historique et exportation des données

### 👩‍🏫 Enseignant
- Sélection des UE souhaitées
- Visualisation de sa charge horaire
- Téléversement des notes
- Consultation de l’historique

### 👨‍💼 Vacataire
- Accès aux UE affectées
- Téléversement des notes

---

## ✉️ Fonctionnalité de mail

Le système utilise **PHPMailer** pour :
- L'envoi de notifications lors des validations ou affectations
- L’envoi de mots de passe temporaires ou de confirmations

---

## 🔐 Sécurité

- Authentification par sessions PHP
- Gestion des autorisations en fonction des rôles
- Protection contre l'accès non autorisé à certaines pages

---

## 📊 Structure de la base de données (simplifiée)

- `user` (id, nom, email, rôle, spécialité)
- `unite` (id, nom, volume_cours, volume_td, volume_tp, filiere_id)
- `affectation` (id, user_id, unite_id, date, validée)
- `filiere`, `departement`, `vacataire`, etc.

---

## 🚀 Installation locale

1. Cloner le projet :
   ```bash
   git clone https://github.com/ton-utilisateur/affectation-enseignements.git
   ```

2. Configurer la base de données :
   - Importer le fichier SQL fourni (`ensah_service.sql`)
   - Modifier les informations de connexion dans `/inc/functions/connections.php`

3. Démarrer le serveur local (XAMPP, Laragon...) :
   ```bash
   php -S localhost:8000
   ```

4. Accéder à l'application :
   [http://localhost:8000](http://localhost:8000)

---

## 👨‍🎓 Auteurs

- **Ayoub Elhilali**
- **Ibrahim Elbouabdellaoui**
- Projet développé dans le cadre de la matière **Web 1** encadrée par **Pr. E. W. DADI**

---

## 📄 Licence

Ce projet est à usage académique dans le cadre de la formation à l’ENSAH. Toute utilisation externe doit faire l’objet d’une autorisation.
