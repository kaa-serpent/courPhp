DROP DATABASE IF EXISTS amazonne;

CREATE DATABASE amazonne;

CREATE TABLE amazonne.produit(
id TINYINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
nomProduit VARCHAR(50) NOT NULL,
typeProduit VARCHAR(100) NOT NULL,
stockProduit INT,
prixProduit INT NOT NULL
);
