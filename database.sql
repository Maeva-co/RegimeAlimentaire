CREATE DATABASE students;

use students;

CREATE TABLE student (
    nom VARCHAR(50),
    prenom VARCHAR(50),
    date_naissance DATE,
    adresse VARCHAR(50)
);

INSERT INTO student(nom, prenom, date_naissance, adresse) VALUES ('Warner', 'Aaron', '2004-02-20', 'Los Angeles');