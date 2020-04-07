USE DB_SI_SERVICE_BIBLIOTHEQUE;

INSERT INTO Service
(NomService,Localisation)
VALUES
("Developpement Web","Salle Pacman"),
("Developpement 99% de C 1% de ++","Salle Sonic"),
("Traduction Langue Asiatique","Salle QBert"),
("Design et Gestion de Projet","Salle Cloud");

INSERT INTO Employe
(NomEmploye,Adresse,NumeroTelephone,NomService)
VALUES
("Jean LOUIS","7 rue des champs","0612345678","Developpement 99% de C 1% de ++"),
("Louis PHILIPPE","8 rue des prés","0790123456","Traduction Langue Asiatique"),
("Phille ROBERT","9 rue des abeilles","0678901234","Design et Gestion de Projet"),
("Robert VIDE","10 rue des moutons","0756789012","Developpement Web");

INSERT INTO Auteur
(Pseudo, NomAuteur)
VALUES
("Meraili","Amélie Poulain"),
("Caex","Jeanne Net"),
("Irthir","Edwin Philippe"),
("Iejir","Godefroy Montbard");

INSERT INTO Ouvrage
(ISBN,Titre,Pseudo)
VALUES
("9780843610727","Traité sur la Magie","Meraili"),
("9780843610728","La Plus est moins forte que l'Epée","Caex"),
("9780843610729","Pomme Informatique","Irthir"),
("9780843610730","Sang pour Sang","Iejir");

INSERT INTO Exemplaire
(IDExemplaire,Prix,DateAchat,ISBN)
VALUES
("Livre 1",50,STR_TO_DATE("07/04/2019","%d/%m/%Y"),"9780843610727"),
("Livre 2",20,STR_TO_DATE("07/05/2019","%d/%m/%Y"),"9780843610728"),
("Livre 3",40,STR_TO_DATE("07/06/2019","%d/%m/%Y"),"9780843610729"),
("Livre 4",30,STR_TO_DATE("07/07/2019","%d/%m/%Y"),"9780843610730");

INSERT INTO Emprunt
(DateDebut,DateFin,NomEmploye,IDExemplaire)
VALUES
(STR_TO_DATE("06/04/2018","%d/%m/%Y"),STR_TO_DATE("06/04/2019","%d/%m/%Y"),"Jean LOUIS","Livre 2"),
(STR_TO_DATE("07/04/2019","%d/%m/%Y"),STR_TO_DATE("07/05/2019","%d/%m/%Y"),"Louis PHILIPPE","Livre 4"),
(STR_TO_DATE("05/03/2020","%d/%m/%Y"),STR_TO_DATE("05/04/2020","%d/%m/%Y"),"Phille ROBERT","Livre 3"),
(STR_TO_DATE("06/04/2020","%d/%m/%Y"),NULL,"Robert VIDE","Livre 3");