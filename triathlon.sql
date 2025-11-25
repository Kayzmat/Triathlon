-- Script SQL pour créer la base de données triathlon basée sur le MCD
-- À exécuter dans phpMyAdmin ou via la ligne de commande MySQL

CREATE DATABASE IF NOT EXISTS triathlon CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE triathlon;

-- Table Comite (départements)
CREATE TABLE Comite (
    id_comite INT PRIMARY KEY AUTO_INCREMENT,
    nom_departement VARCHAR(100) NOT NULL UNIQUE
);

-- Table Clubs
CREATE TABLE Clubs (
    id_club INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    adresse VARCHAR(255),
    ville VARCHAR(100),
    telephone VARCHAR(20),
    email VARCHAR(100),
    id_comite INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_comite) REFERENCES Comite(id_comite) ON DELETE CASCADE
);

-- Table Athlete
CREATE TABLE Athlete (
    numLicence VARCHAR(20) PRIMARY KEY,
    nom_prenom VARCHAR(100) NOT NULL,
    sexe ENUM('M', 'F') NOT NULL,
    adresse VARCHAR(255),
    date_naissance DATE NOT NULL,
    saison YEAR NOT NULL
);

-- Table Categorie
CREATE TABLE Categorie (
    code_categorie INT PRIMARY KEY AUTO_INCREMENT,
    age_debut INT NOT NULL,
    age_fin INT NOT NULL,
    libelle VARCHAR(50) NOT NULL
);

-- Table TypeTriathlon
CREATE TABLE TypeTriathlon (
    codeType VARCHAR(10) PRIMARY KEY,
    libelle VARCHAR(100) NOT NULL,
    distanceNat DECIMAL(8,2) NOT NULL,
    distanceCycle DECIMAL(8,2) NOT NULL,
    distanceCourse DECIMAL(8,2) NOT NULL
);

-- Table Triathlon
CREATE TABLE Triathlon (
    id_triathlon INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    lieu VARCHAR(100) NOT NULL,
    date_triathlon DATE NOT NULL,
    codeType VARCHAR(10) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (codeType) REFERENCES TypeTriathlon(codeType) ON DELETE RESTRICT
);

-- Table Inscription (relation entre Athlete et Triathlon)
CREATE TABLE Inscription (
    id_inscription INT PRIMARY KEY AUTO_INCREMENT,
    numLicence VARCHAR(20) NOT NULL,
    id_triathlon INT NOT NULL,
    numDossard VARCHAR(20),
    dateInscription DATE NOT NULL,
    forfait BOOLEAN DEFAULT FALSE,
    tempsNat TIME,
    tempsCycle TIME,
    tempsCourse TIME,
    classement INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unique_dossard (id_triathlon, numDossard),
    FOREIGN KEY (numLicence) REFERENCES Athlete(numLicence) ON DELETE CASCADE,
    FOREIGN KEY (id_triathlon) REFERENCES Triathlon(id_triathlon) ON DELETE CASCADE
);

-- Table Licence_Club (relation entre Athlete et Clubs)
CREATE TABLE Licence_Club (
    id_licence_club INT PRIMARY KEY AUTO_INCREMENT,
    numLicence VARCHAR(20) NOT NULL,
    id_club INT NOT NULL,
    DatePremLicence DATE NOT NULL,
    saison YEAR NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unique_licence_saison (numLicence, saison),
    FOREIGN KEY (numLicence) REFERENCES Athlete(numLicence) ON DELETE CASCADE,
    FOREIGN KEY (id_club) REFERENCES Clubs(id_club) ON DELETE CASCADE
);

-- Table des utilisateurs (admin et responsables)
CREATE TABLE Users (
    id_user INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'club_manager') NOT NULL DEFAULT 'club_manager',
    id_club INT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_club) REFERENCES Clubs(id_club) ON DELETE SET NULL
);

-- Insertion des données de test

-- Comités
INSERT INTO Comite (nom_departement) VALUES
('Loiret'),
('Indre-et-Loire'),
('Loir-et-Cher'),
('Eure-et-Loir');

-- Clubs
INSERT INTO Clubs (nom, adresse, ville, telephone, email, id_comite) VALUES
('Triathlon Club Orléans', '123 Rue de la Loire', 'Orléans', '02 38 42 00 00', 'contact@tco.fr', 1),
('AS Triathlon Tours', '456 Avenue de la République', 'Tours', '02 47 20 00 00', 'info@asttours.fr', 2),
('Triathlon Club Blois', '789 Boulevard de la Liberté', 'Blois', '02 54 78 00 00', 'club@tc-blois.fr', 3),
('US Triathlon Chartres', '321 Rue des Sports', 'Chartres', '02 37 30 00 00', 'contact@ust-chartres.fr', 4);

-- Types de triathlon
INSERT INTO TypeTriathlon (codeType, libelle, distanceNat, distanceCycle, distanceCourse) VALUES
('XS', 'Format très court', 0.4, 10.0, 2.5),
('S', 'Format court', 0.75, 20.0, 5.0),
('M', 'Format moyen', 1.5, 40.0, 10.0),
('L', 'Format long', 1.9, 90.0, 21.1),
('XL', 'Format très long', 3.8, 180.0, 42.2),
('TROP', 'Triathlon Olympique', 1.5, 40.0, 10.0);

-- Athlètes
INSERT INTO Athlete (numLicence, nom_prenom, sexe, adresse, date_naissance, saison) VALUES
('FFTRI2024001', 'Pierre Martin', 'M', '123 Rue des Sports, Orléans', '1990-05-15', 2024),
('FFTRI2024002', 'Marie Dubois', 'F', '456 Avenue de la République, Tours', '1985-08-22', 2024),
('FFTRI2024003', 'Jean Moreau', 'M', '789 Boulevard de la Liberté, Blois', '2005-03-10', 2024),
('FFTRI2024004', 'Sophie Bernard', 'F', '321 Rue des Athlètes, Chartres', '1992-11-30', 2024);

-- Catégories
INSERT INTO Categorie (age_debut, age_fin, libelle) VALUES
(16, 19, 'Junior'),
(20, 39, 'Senior'),
(40, 59, 'Vétéran'),
(60, 99, 'Super Vétéran');

-- Licences club
INSERT INTO Licence_Club (numLicence, id_club, DatePremLicence, saison) VALUES
('FFTRI2024001', 1, '2024-01-01', 2024),
('FFTRI2024002', 2, '2024-01-01', 2024),
('FFTRI2024003', 3, '2024-01-01', 2024),
('FFTRI2024004', 4, '2024-01-01', 2024);

-- Triathlons
INSERT INTO Triathlon (nom, lieu, date_triathlon, codeType) VALUES
('Triathlon d''Orléans', 'Orléans', '2024-06-26', 'TROP'),
('Triathlon de Tours', 'Tours', '2024-07-15', 'XS'),
('Triathlon du Val de Loire', 'Blois', '2024-08-05', 'S'),
('Triathlon de Chartres', 'Chartres', '2024-08-25', 'M');

-- Utilisateurs
INSERT INTO Users (nom, email, password, role, id_club) VALUES
('Admin FFTRI', 'admin@fftri.com', MD5('password'), 'admin', NULL),
('Responsable Orléans', 'resp.orleans@fftri.com', MD5('password'), 'club_manager', 1),
('Responsable Tours', 'resp.tours@fftri.com', MD5('password'), 'club_manager', 2);

-- Inscriptions
INSERT INTO Inscription (numLicence, id_triathlon, numDossard, dateInscription, forfait, tempsNat, tempsCycle, tempsCourse, classement) VALUES
('FFTRI2024001', 1, 'D001', '2024-05-01', FALSE, '00:25:30', '01:15:45', '00:45:20', 1),
('FFTRI2024002', 1, 'D002', '2024-05-02', FALSE, '00:28:15', '01:18:30', '00:48:10', 2),
('FFTRI2024003', 2, 'D101', '2024-06-01', FALSE, NULL, NULL, NULL, NULL),
('FFTRI2024004', 3, 'D201', '2024-07-01', FALSE, NULL, NULL, NULL, NULL);
