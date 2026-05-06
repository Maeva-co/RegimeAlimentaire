-- Permet l’historique → graphes d’évolution.

CREATE TABLE UserHealth (
    id INT PRIMARY KEY AUTO_INCREMENT,
    idUser INT,
    taille_cm DECIMAL(5,2),
    poids_kg DECIMAL(5,2),
    imc DECIMAL(5,2),
    date_enregistrement DATETIME,
    FOREIGN KEY (idUser) REFERENCES User(id)
);


-- Regime – CRUD régimes
-- variation_poids_grammes = +150 (prise) ou -100 (perte).
CREATE TABLE Regime (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100),
    prix_par_jour DECIMAL(10,2),
    duree_jours INT,
    variation_poids_grammes INT
);

-- RegimeComposition – % viande/poisson/volaille
CREATE TABLE RegimeComposition (
    id INT PRIMARY KEY AUTO_INCREMENT,
    idRegime INT,
    type_viande VARCHAR(50), -- 'viande', 'poisson', 'volaille'
    pourcentage DECIMAL(5,2),
    FOREIGN KEY (idRegime) REFERENCES Regime(id)
);
