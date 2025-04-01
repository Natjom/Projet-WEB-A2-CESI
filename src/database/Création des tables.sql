DROP DATABASE IF EXISTS projetweb;
CREATE DATABASE projetweb;
USE projetweb;


 CREATE TABLE Secteur_activite(
      IdSec INT AUTO_INCREMENT,
      Secteur_Act VARCHAR(200),
      PRIMARY KEY(IdSec)
   );

   CREATE TABLE promotion(
      IDProm INT AUTO_INCREMENT,
      Promotion VARCHAR(50),
      PRIMARY KEY(IDProm)
   );

   CREATE TABLE region(
      ID_reg INT AUTO_INCREMENT,
      reg VARCHAR(50),
      PRIMARY KEY(ID_reg)
   );

   CREATE TABLE types_promotions(
      IDT INT AUTO_INCREMENT,
      Nom_du_Type VARCHAR(50),
      PRIMARY KEY(IDT)
   );

   CREATE TABLE Competences(
      IDComp SMALLINT NOT NULL AUTO_INCREMENT,
      Comp VARCHAR(50) NOT NULL,
      PRIMARY KEY(IDComp)
   );

   CREATE TABLE ville(
      idv INT AUTO_INCREMENT,
      Code_Post INT NOT NULL,
      ville VARCHAR(50),
      ID_reg INT NOT NULL,
      PRIMARY KEY(idv),
      FOREIGN KEY(ID_reg) REFERENCES region(ID_reg)
   );

   CREATE TABLE adresse(
      ID_adresse INT AUTO_INCREMENT,
      adresseA VARCHAR(50),
      complementA VARCHAR(50),
      idv INT NOT NULL,
      PRIMARY KEY(ID_adresse),
      FOREIGN KEY(idv) REFERENCES ville(idv)
   );

   CREATE TABLE Users(
      IDu INT AUTO_INCREMENT,
      MdpU VARCHAR(100) NOT NULL,
      NomU VARCHAR(50),
      PrenomU VARCHAR(50),
      Date_NaisU DATE,
      MailU VARCHAR(50) NOT NULL,
      Role VARCHAR(14) NOT NULL,
      ID_adresse INT NOT NULL,
      PRIMARY KEY(IDu),
      UNIQUE(MailU),
      FOREIGN KEY(ID_adresse) REFERENCES adresse(ID_adresse)
   );

   CREATE TABLE Entreprise(
      IDE INT AUTO_INCREMENT,
      NomE VARCHAR(50),
      descr VARCHAR(1000),
      MailE VARCHAR(50),
      TelE INT,
      Site VARCHAR(200),
      Moyenne DECIMAL(3,2),
      N_siret VARCHAR(14) NOT NULL,
      IdSec INT NOT NULL,
      ID_adresse INT NOT NULL,
      PRIMARY KEY(IDE),
      FOREIGN KEY(IdSec) REFERENCES Secteur_activite(IdSec),
      FOREIGN KEY(ID_adresse) REFERENCES adresse(ID_adresse)
   );

   CREATE TABLE Offre(
      IDoffre INT AUTO_INCREMENT,
      Poste VARCHAR(200),
      remune SMALLINT,
      Date_finO DATE,
      Date_debutO DATE,
      Nb_place SMALLINT,
      Descr VARCHAR(1000),
      IDE INT,
      PRIMARY KEY(IDoffre),
      FOREIGN KEY(IDE) REFERENCES Entreprise(IDE)
   );

   CREATE TABLE Admin(
      IDu INT,
      PRIMARY KEY(IDu),
      FOREIGN KEY(IDu) REFERENCES Users(IDu)
   );

   CREATE TABLE pilote(
      IDu INT,
      PRIMARY KEY(IDu),
      FOREIGN KEY(IDu) REFERENCES Users(IDu)
   );

   CREATE TABLE Classe(
      IDClasse SMALLINT NOT NULL AUTO_INCREMENT,
      idv INT NOT NULL,
      IDT INT NOT NULL,
      IDProm INT NOT NULL,
      IDu INT ,
      PRIMARY KEY(IDClasse),
      FOREIGN KEY(idv) REFERENCES ville(idv),
      FOREIGN KEY(IDT) REFERENCES types_promotions(IDT),
      FOREIGN KEY(IDProm) REFERENCES promotion(IDProm),
      FOREIGN KEY(IDu) REFERENCES pilote(IDu)
   );

   CREATE TABLE etudiant(
      IDu INT,
      IDClasse SMALLINT NOT NULL,
      PRIMARY KEY(IDu),
      FOREIGN KEY(IDu) REFERENCES Users(IDu),
      FOREIGN KEY(IDClasse) REFERENCES Classe(IDClasse)
   );

   CREATE TABLE souhaite(
      IDoffre INT,
      IDu INT,
      Date_ajout DATE,
      PRIMARY KEY(IDoffre, IDu),
      FOREIGN KEY(IDoffre) REFERENCES Offre(IDoffre),
      FOREIGN KEY(IDu) REFERENCES etudiant(IDu)
   );

   CREATE TABLE Candidature(
      IDoffre INT,
      IDu INT,
      Date_candidature DATE,
      lettre_motivation VARCHAR(255),
      CV VARCHAR(255),
      PRIMARY KEY(IDoffre, IDu),
      FOREIGN KEY(IDoffre) REFERENCES Offre(IDoffre),
      FOREIGN KEY(IDu) REFERENCES etudiant(IDu)
   );

   CREATE TABLE Viser(
      IDoffre INT,
      IDT INT,
      PRIMARY KEY(IDoffre, IDT),
      FOREIGN KEY(IDoffre) REFERENCES Offre(IDoffre),
      FOREIGN KEY(IDT) REFERENCES types_promotions(IDT)
   );

   CREATE TABLE Modifier(
      IDoffre INT,
      IDu INT,
      PRIMARY KEY(IDoffre, IDu),
      FOREIGN KEY(IDoffre) REFERENCES Offre(IDoffre),
      FOREIGN KEY(IDu) REFERENCES Admin(IDu)
   );


   CREATE TABLE Evalue(
      IDu INT,
      IDE INT,
      Note SMALLINT,
      PRIMARY KEY(IDu, IDE),
      FOREIGN KEY(IDu) REFERENCES Users(IDu),
      FOREIGN KEY(IDE) REFERENCES Entreprise(IDE)
   );

   CREATE TABLE Posseder (
      IDoffre INT,
      IDComp SMALLINT,
      PRIMARY KEY(IDoffre, IDComp),
      FOREIGN KEY(IDoffre) REFERENCES Offre(IDoffre),
      FOREIGN KEY(IDComp) REFERENCES Competences(IDComp)
   );

 -- Création de l'utilisateur pilote
CREATE USER IF NOT EXISTS 'pilote'@'localhost' IDENTIFIED BY 'Pilote@123';
GRANT SELECT ON projetweb.* TO 'pilote'@'localhost';

GRANT UPDATE, DELETE, INSERT ON projetweb.Users TO 'pilote'@'localhost';
GRANT UPDATE, DELETE, INSERT ON projetweb.adresse TO 'pilote'@'localhost';
GRANT UPDATE, DELETE, INSERT ON projetweb.ville TO 'pilote'@'localhost';
GRANT UPDATE, DELETE, INSERT ON projetweb.region TO 'pilote'@'localhost';
GRANT UPDATE, DELETE, INSERT ON projetweb.Entreprise TO 'pilote'@'localhost';
GRANT UPDATE, DELETE, INSERT ON projetweb.Secteur_activite TO 'pilote'@'localhost';
GRANT UPDATE, DELETE, INSERT ON projetweb.Offre TO 'pilote'@'localhost';
GRANT UPDATE, DELETE, INSERT ON projetweb.Competences TO 'pilote'@'localhost';
GRANT UPDATE, DELETE, INSERT ON projetweb.Posseder TO 'pilote'@'localhost';
GRANT UPDATE, DELETE, INSERT ON projetweb.promotion TO 'pilote'@'localhost';
GRANT UPDATE, DELETE, INSERT ON projetweb.types_promotions TO 'pilote'@'localhost';
GRANT UPDATE, DELETE, INSERT ON projetweb.Viser TO 'pilote'@'localhost';
GRANT UPDATE, DELETE, INSERT ON projetweb.Classe TO 'pilote'@'localhost';
GRANT UPDATE, DELETE, INSERT ON projetweb.Evalue TO 'pilote'@'localhost';

-- Création de l'utilisateur étudiant
CREATE USER IF NOT EXISTS 'etudiant'@'localhost' IDENTIFIED BY 'Etudiant@123';
GRANT SELECT ON projetweb.* TO 'etudiant'@'localhost';
GRANT INSERT, UPDATE, DELETE ON projetweb.Evalue TO 'etudiant'@'localhost';
GRANT INSERT, UPDATE, DELETE ON projetweb.souhaite TO 'etudiant'@'localhost';
GRANT INSERT, UPDATE, DELETE ON projetweb.Candidature TO 'etudiant'@'localhost';
