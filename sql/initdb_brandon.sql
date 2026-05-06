-- =====================================================
-- BASE DE DONNÉES POUR LE PROJET RÉGIME (BACK OFFICE)
-- =====================================================

CREATE DATABASE IF NOT EXISTS regime;
USE regime;

-- =====================================================
-- TABLE : User (utilisateurs)
-- =====================================================
CREATE TABLE User (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    genre VARCHAR(20),
    taille DECIMAL(5,2),
    poids DECIMAL(5,2),
    IMC DECIMAL(5,2),
    balance DECIMAL(10,2) DEFAULT 0,
    role ENUM('user', 'admin') DEFAULT 'user',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- =====================================================
-- TABLE : Regime (régimes alimentaires)
-- =====================================================
CREATE TABLE Regime (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    description TEXT,
    prix_par_jour DECIMAL(10,2) NOT NULL,
    duree_jours INT NOT NULL,
    variation_poids_grammes INT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- =====================================================
-- TABLE : RegimeComposition (composition % viande/poisson/volaille)
-- =====================================================
CREATE TABLE RegimeComposition (
    id INT PRIMARY KEY AUTO_INCREMENT,
    idRegime INT NOT NULL,
    type_viande ENUM('viande', 'poisson', 'volaille') NOT NULL,
    pourcentage DECIMAL(5,2) NOT NULL,
    FOREIGN KEY (idRegime) REFERENCES Regime(id) ON DELETE CASCADE,
    UNIQUE KEY unique_regime_type (idRegime, type_viande)
);

-- =====================================================
-- TABLE : Sport (activités sportives)
-- =====================================================
CREATE TABLE Sport (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    description TEXT,
    variation_poids_grammes INT NOT NULL,
    calories_par_heure INT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- =====================================================
-- TABLE : Code (codes recharge porte-monnaie)
-- =====================================================
CREATE TABLE Code (
    id INT PRIMARY KEY AUTO_INCREMENT,
    code VARCHAR(50) UNIQUE NOT NULL,
    valeur DECIMAL(10,2) NOT NULL,
    utilise TINYINT DEFAULT 0,
    expire_le DATE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- =====================================================
-- TABLE : Parametre (paramètres généraux)
-- =====================================================
CREATE TABLE Parametre (
    id INT PRIMARY KEY AUTO_INCREMENT,
    cle VARCHAR(100) UNIQUE NOT NULL,
    valeur VARCHAR(255) NOT NULL,
    description TEXT
);

-- =====================================================
-- TABLE : Option (option Gold)
-- =====================================================
CREATE TABLE `Option` (
    id INT PRIMARY KEY AUTO_INCREMENT,
    label VARCHAR(100) NOT NULL,
    prix DECIMAL(10,2) NOT NULL,
    reduction DECIMAL(5,2) DEFAULT 0
);

-- =====================================================
-- TABLE : OptionUser (liaison utilisateurs - options)
-- =====================================================
CREATE TABLE OptionUser (
    id INT PRIMARY KEY AUTO_INCREMENT,
    idUser INT NOT NULL,
    idOption INT NOT NULL,
    date_achat DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (idUser) REFERENCES User(id),
    FOREIGN KEY (idOption) REFERENCES `Option`(id)
);

-- =====================================================
-- TABLE : UserHealth (historique santé pour graphiques)
-- =====================================================
CREATE TABLE UserHealth (
    id INT PRIMARY KEY AUTO_INCREMENT,
    idUser INT NOT NULL,
    taille_cm DECIMAL(5,2),
    poids_kg DECIMAL(5,2),
    imc DECIMAL(5,2),
    date_enregistrement DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (idUser) REFERENCES User(id)
);

-- =====================================================
-- DONNÉES MINIMALES (5 users, 15 codes, 5 régimes, 5 sports)
-- MOTS DE PASSE SIMPLES : '1234' pour tous
-- =====================================================

-- Admin par défaut (mdp = 1234)
INSERT INTO User (nom, email, password, genre, role, balance) VALUES
('Administrateur', 'admin@regime.com', '1234', 'Homme', 'admin', 0);

-- 4 utilisateurs normaux (mdp = 1234 pour tous)
INSERT INTO User (nom, email, password, genre, taille, poids, role, balance) VALUES
('Jean Dupont', 'jean@email.com', '2345', 'Homme', 180, 85, 'user', 50),
('Marie Martin', 'marie@email.com', '3456', 'Femme', 165, 65, 'user', 30),
('Pierre Bernard', 'pierre@email.com', '4567', 'Homme', 175, 78, 'user', 100),
('Sophie Petit', 'sophie@email.com', '5678', 'Femme', 170, 70, 'user', 20);

-- 5 régimes
INSERT INTO Regime (nom, description, prix_par_jour, duree_jours, variation_poids_grammes) VALUES
('Régime Protéiné', 'Riche en protéines pour la prise de muscle', 12.99, 30, 150),
('Régime Détox', 'Élimination des toxines et perte de poids rapide', 9.99, 14, -200),
('Régime Équilibré', 'Pour atteindre son IMC idéal', 8.99, 21, 50),
('Régime Keto', 'Low carb, high fat pour une perte de poids', 15.99, 30, -100),
('Régime Végétarien', 'Sans viande, riche en légumes', 10.99, 28, -50);

-- Compositions des régimes (somme = 100% pour chacun)
INSERT INTO RegimeComposition (idRegime, type_viande, pourcentage) VALUES
(1, 'viande', 40), (1, 'poisson', 30), (1, 'volaille', 30),
(2, 'viande', 10), (2, 'poisson', 40), (2, 'volaille', 50),
(3, 'viande', 30), (3, 'poisson', 30), (3, 'volaille', 40),
(4, 'viande', 50), (4, 'poisson', 25), (4, 'volaille', 25),
(5, 'viande', 0), (5, 'poisson', 30), (5, 'volaille', 70);

-- 5 activités sportives
INSERT INTO Sport (nom, description, variation_poids_grammes, calories_par_heure) VALUES
('Course à pied', 'Cardio intense pour brûler les graisses', -150, 600),
('Natation', 'Sport complet sans impact', -120, 500),
('Musculation', 'Prise de muscle et renforcement', 100, 300),
('Yoga', 'Bien-être et souplesse', -50, 200),
('Vélo', 'Endurance cardio-vasculaire', -130, 550);

-- 15 codes de recharge
INSERT INTO Code (code, valeur, utilise) VALUES
('BIENVENUE10', 10.00, 0),
('PROMO20', 20.00, 0),
('GOLD50', 50.00, 0),
('REGIME15', 15.00, 0),
('SPORT5', 5.00, 0),
('CODE100', 100.00, 0),
('FREE25', 25.00, 0),
('BONUS30', 30.00, 0),
('REDUC40', 40.00, 0),
('COACH60', 60.00, 0),
('PROTEINE12', 12.00, 0),
('DETOX8', 8.00, 0),
('KETO18', 18.00, 0),
('VEGGIE9', 9.00, 0),
('MUSCLE22', 22.00, 0);

-- Paramètres
INSERT INTO Parametre (cle, valeur, description) VALUES
('gold_prix', '49.99', 'Prix de l\'option Gold'),
('gold_reduction', '15', 'Pourcentage de réduction Gold'),
('site_name', 'Regime Expert', 'Nom du site'),
('contact_email', 'contact@regime.com', 'Email de contact');

-- Option Gold
INSERT INTO `Option` (label, prix, reduction) VALUES
('Gold Premium', 49.99, 15);