-- Table des Utilisateurs
CREATE TABLE utilisateur (
    id_utilisateur INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(50),
    prenom VARCHAR(50)
);

-- Table des Départements
CREATE TABLE departement (
    id_departement INT PRIMARY KEY AUTO_INCREMENT,
    nom_departement VARCHAR(100) UNIQUE
);

-- Table des Filières
CREATE TABLE filiere (
    id_filiere INT PRIMARY KEY AUTO_INCREMENT,
    nom_filiere VARCHAR(100) UNIQUE,
    id_departement INT,
    FOREIGN KEY (id_departement) REFERENCES departement(id_departement)
);

-- Table des Administrateurs
CREATE TABLE admin (
    id_admin INT PRIMARY KEY AUTO_INCREMENT,
    id_user INT,
    email VARCHAR(100) UNIQUE,
    mot_de_passe VARCHAR(255),
    FOREIGN KEY (id_user) REFERENCES utilisateur(id_utilisateur)
);

-- Table des Professeurs
CREATE TABLE professeur (
    id_professeur INT PRIMARY KEY AUTO_INCREMENT,
    id_user INT,
    email VARCHAR(100) UNIQUE,
    specialite VARCHAR(100),
    mot_de_passe VARCHAR(255),
    FOREIGN KEY (id_user) REFERENCES utilisateur(id_utilisateur)
);

-- Table des Coordinateurs
CREATE TABLE coordinateur (
    id_coordinateur INT PRIMARY KEY AUTO_INCREMENT,
    id_professeur INT,
    id_filiere INT,
    FOREIGN KEY (id_professeur) REFERENCES professeur(id_professeur),
    FOREIGN KEY (id_filiere) REFERENCES filiere(id_filiere)
);

-- Table des Chefs de Département
CREATE TABLE chef_departement (
    id_chef INT PRIMARY KEY AUTO_INCREMENT,
    id_professeur INT,
    id_departement INT,
    FOREIGN KEY (id_professeur) REFERENCES professeur(id_professeur),
    FOREIGN KEY (id_departement) REFERENCES departement(id_departement)
);

-- Table des Vacataires
CREATE TABLE vacataire (
    id_vacataire INT PRIMARY KEY AUTO_INCREMENT,
    id_user INT,
    email VARCHAR(100) UNIQUE,
    mot_de_passe VARCHAR(255),
    specialite VARCHAR(100),
    FOREIGN KEY (id_user) REFERENCES utilisateur(id_utilisateur)
);

-- Table des Unités d'Enseignement (UE)
CREATE TABLE unite_enseignement (
    id_ue INT PRIMARY KEY AUTO_INCREMENT,
    nom_ue VARCHAR(100) UNIQUE,
    id_filiere INT,
    FOREIGN KEY (id_filiere) REFERENCES filiere(id_filiere)
);

-- Table d'Affectation UE
CREATE TABLE affectation (
    id_affectation INT PRIMARY KEY AUTO_INCREMENT,
    id_ue INT,
    id_professeur INT NULL,
    id_vacataire INT NULL,
    FOREIGN KEY (id_ue) REFERENCES unite_enseignement(id_ue),
    FOREIGN KEY (id_professeur) REFERENCES professeur(id_professeur),
    FOREIGN KEY (id_vacataire) REFERENCES vacataire(id_vacataire),
    CHECK (
        (id_professeur IS NOT NULL AND id_vacataire IS NULL) OR 
        (id_professeur IS NULL AND id_vacataire IS NOT NULL)
    )
);

-- Table des Années Scolaires (Historique)
CREATE TABLE annee_scolaire (
    id_annee INT PRIMARY KEY AUTO_INCREMENT,
    annee VARCHAR(9) UNIQUE -- ex: '2024-2025'
);

-- Table des Notes
CREATE TABLE note (
    id_note INT PRIMARY KEY AUTO_INCREMENT,
    id_utilisateur INT,
    id_ue INT,
    id_annee INT,
    note FLOAT CHECK (note >= 0 AND note <= 20),
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id_utilisateur),
    FOREIGN KEY (id_ue) REFERENCES unite_enseignement(id_ue),
    FOREIGN KEY (id_annee) REFERENCES annee_scolaire(id_annee)
);