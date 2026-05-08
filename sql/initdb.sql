create database regime;
use regime;

-- =========================
-- TABLE : User
-- =========================
CREATE TABLE User (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100),
    email VARCHAR(150) UNIQUE,
    genre VARCHAR(20),
    taille DECIMAL(5,2),      -- en  m
    poids DECIMAL(5,2),       -- en kg
    IMC DECIMAL(5,2),
    balance DECIMAL(8,2)
);

-- =========================
-- TABLE : Diet
-- =========================
CREATE TABLE Diet (
    id INT PRIMARY KEY AUTO_INCREMENT,
    prix DECIMAL(10,2),
    var_poids_jour INT        -- variation en grammes (+150, -100, etc.)
);

-- =========================
-- TABLE : DietMeatPercentage
-- =========================
CREATE TABLE DietMeatPercentage (
    id INT PRIMARY KEY AUTO_INCREMENT,
    idDiet INT,
    label_meat VARCHAR(100),
    prct DECIMAL(5,2),

    FOREIGN KEY (idDiet)
        REFERENCES Diet(id)
);

-- =========================
-- TABLE : Sport
-- =========================
CREATE TABLE Sport (
    id INT PRIMARY KEY AUTO_INCREMENT,
    label VARCHAR(100)
);

-- =========================
-- TABLE : SportEffect
-- =========================
CREATE TABLE SportEffect (
    id INT PRIMARY KEY AUTO_INCREMENT,
    idSport INT,
    var_poids_jour INT,       -- variation en grammes

    FOREIGN KEY (idSport)
        REFERENCES Sport(id)
);

-- =========================
-- TABLE : Code
-- =========================
CREATE TABLE Code (
    id INT PRIMARY KEY AUTO_INCREMENT,
    code VARCHAR(50),
    valeur DECIMAL(10,2)
);

-- =========================
-- TABLE : Option
-- =========================
CREATE TABLE `Option` (
    id INT PRIMARY KEY AUTO_INCREMENT,
    label VARCHAR(100),
    prix DECIMAL(10,2),
    reduction DECIMAL(5,2)
);

-- =========================
-- TABLE : OptionUser
-- =========================
CREATE TABLE OptionUser (
    id INT PRIMARY KEY AUTO_INCREMENT,
    idUser INT,
    idOption INT,

    FOREIGN KEY (idUser)
        REFERENCES User(id),

    FOREIGN KEY (idOption)
        REFERENCES `Option`(id)
);