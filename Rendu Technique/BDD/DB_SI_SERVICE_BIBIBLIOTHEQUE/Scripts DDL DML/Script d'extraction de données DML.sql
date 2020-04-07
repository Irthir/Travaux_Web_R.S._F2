USE DB_SI_SERVICE_BIBLIOTHEQUE;

-- On commence par les sélections sur la totalités des tables :

SELECT * FROM Service;

SELECT * FROM Employe;

SELECT * FROM Auteur;

SELECT * FROM Ouvrage;

SELECT * FROM Exemplaire;

SELECT * FROM Emprunt;

-- On cherche tous les livres qui n'ont pas été empruntés.
SELECT DISTINCT(Titre) as TITRE_DU_LIVRE, Auteur.Pseudo as AUTEUR
FROM Ouvrage, Auteur, Exemplaire, Emprunt
WHERE Ouvrage.Pseudo = Auteur.Pseudo AND Ouvrage.ISBN = Exemplaire.ISBN
AND Exemplaire.IDExemplaire NOT IN (SELECT DISTINCT(Emprunt.IDExemplaire) FROM Emprunt);


-- On cherche les livres qui ne sont pas encore rendus et la personne qui ne les a pas rendu.
SELECT Titre as TITRE_DU_LIVRE, DateDebut as DATE_EMPRUNT, Employe.NomEmploye as EMPLOYE, Adresse as ADRESSE, NumeroTelephone as NUMTEL
FROM Employe, Emprunt, Exemplaire, Ouvrage
WHERE Employe.NomEmploye = Emprunt.NomEmploye AND Emprunt.IDExemplaire = Exemplaire.IDExemplaire AND Exemplaire.ISBN = Ouvrage.ISBN AND Emprunt.DateFin IS NULL;