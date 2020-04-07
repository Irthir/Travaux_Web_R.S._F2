DROP DATABASE IF EXISTS DB_SI_SERVICE_BIBLIOTHEQUE;
CREATE DATABASE IF NOT EXISTS DB_SI_SERVICE_BIBLIOTHEQUE;

USE DB_SI_SERVICE_BIBLIOTHEQUE;


-- Création de la table Service
DROP TABLE IF EXISTS Service;
CREATE TABLE Service
(
	NomService varchar(80), -- Le service possède un nom et une localisation.
	Localisation varchar(80),
	CONSTRAINT NomServiceUnique PRIMARY KEY(NomService) -- Son nom sert de clef primaire.
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

-- Création de la table Employé
DROP TABLE IF EXISTS Employe;
CREATE TABLE Employe
(
	NomEmploye varchar(80), -- L'employé a un nom, une adresse un numéro de téléphone et travaille dans un service.
	Adresse varchar(80),
	NumeroTelephone int (10),
	NomService varchar(80), 
	CONSTRAINT ServiceExistant FOREIGN KEY (NomService) REFERENCES Service (NomService), -- Le service doit exister pour qu'il puisse y travailler.
	CONSTRAINT NumeroTelephoneUnique UNIQUE (NumeroTelephone), -- Il ne peut pas y avoir un numéro de téléphone identique entre deux employés.
	CONSTRAINT NomEmploye PRIMARY KEY (NomEmploye) -- Le nom de l'employé sert de clef primaire.
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

-- Création de la table Auteur
DROP TABLE IF EXISTS Auteur;
CREATE TABLE Auteur
(
	Pseudo varchar(80), -- L'auteur possède un pseudo et un nom.
	NomAuteur varchar(80),
	CONSTRAINT PseudoUnique PRIMARY KEY (Pseudo) -- Le pseudo nous sert de Primary Key.
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

-- Création de la table Ouvrage
DROP TABLE IF EXISTS Ouvrage;
CREATE TABLE Ouvrage
(
	ISBN varchar(80), -- L'ouvrage possède un ISBN, un titre et une référence au Pseudo de l'auteur.
	Titre varchar(80),
	Pseudo varchar(80),
	CONSTRAINT AuteurExistant FOREIGN KEY (Pseudo) REFERENCES Auteur (Pseudo), -- L'auteur doit avoir un auteur existant
	CONSTRAINT ISBNUnique PRIMARY KEY (ISBN) -- L'ISBN nous sert de clef primaire.
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

-- Création de la table Exemplaire
DROP TABLE IF EXISTS Exemplaire;
CREATE TABLE Exemplaire -- On part du principe qu'un Exemplaire d'un ouvrage n'existe qu'une fois dans la bibliothèque de l'entreprise.
(
	IDExemplaire varchar(80), -- L'exemplaire possède un ID, un prix, une date d'achat et une référence à l'ISBN
	Prix numeric(6,2),
	DateAchat date,
	ISBN varchar(80),
	CONSTRAINT ISBNExistant FOREIGN KEY (ISBN) REFERENCES Ouvrage (ISBN), -- L'exemplaire doit provenir d'un ouvrage existant.
	CONSTRAINT IDExemplaireUnique PRIMARY KEY (IDExemplaire) -- L'IDExemplaire nous sert de clef primaire.
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs; 

-- Création de la table Emprunt
DROP TABLE IF EXISTS Emprunt;
CREATE TABLE Emprunt
(
	IDEmprunt INT NOT NULL AUTO_INCREMENT, -- Un emprunt contient un ID qui va s'auto-gérer, une date de début, une date de fin, une référence à l'employé et à l'exemplaire
	DateDebut Date,
	DateFin Date,
	NomEmploye varchar(80),
	IDExemplaire varchar(80),
	CONSTRAINT NomEmployeExistant FOREIGN KEY (NomEmploye) REFERENCES Employe (NomEmploye), -- On doit partir d'un employé qui existe.
	CONSTRAINT IDExemplaireExistant FOREIGN KEY (IDExemplaire) REFERENCES Exemplaire (IDExemplaire), -- Ainsi que d'un Exemplaire qui existe.
	CONSTRAINT IDEmpruntUnique PRIMARY KEY (IDEmprunt)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs; 