USE projetweb;

INSERT INTO region (reg)
VALUES 
('Auvergne-Rhône-Alpes'),
('Bourgogne-Franche-Comté'),
('Bretagne'),
('Centre-Val de Loire'),
('Corse'),
('Grand Est'),
('Hauts-de-France'),
('Île-de-France'),
('Normandie'),
('Nouvelle-Aquitaine'),
('Occitanie'),
('Pays de la Loire'),
('Provence-Alpes-Côte d\'Azur');

INSERT INTO types_promotions (Nom_du_Type) 
VALUES 
('Informatique'),
('Generaliste'),
('Prépa');

INSERT INTO ville (Code_Post, ville, ID_reg) 
VALUES 
(75001, 'Paris', 1), -- Île-de-France
(69001, 'Lyon', 2), -- Auvergne-Rhône-Alpes
(21000, 'Dijon', 3), -- Bourgogne-Franche-Comté
(35000, 'Rennes', 4), -- Bretagne
(45000, 'Orléans', 5), -- Centre-Val de Loire
(20200, 'Bastia', 6), -- Corse
(67000, 'Strasbourg', 7), -- Grand Est
(59000, 'Lille', 8), -- Hauts-de-France
(14000, 'Caen', 9), -- Normandie
(33000, 'Bordeaux', 10), -- Nouvelle-Aquitaine
(31000, 'Toulouse', 11), -- Occitanie
(44000, 'Nantes', 12), -- Pays de la Loire
(13001, 'Marseille', 13); -- Provence-Alpes-Côte d'Azur




INSERT INTO adresse (adresseA, complementA, idv) 
VALUES 
('12 Rue de la Liberté', NULL, 1),
('8 Avenue des Roses', 'Appartement 3', 2),
('45 Boulevard de la Santé', NULL, 3),
('30 Rue du Commerce', NULL, 4),
('3 Avenue de Gaulle', NULL, 3),
('7 Rue Henry Lafaillette', NULL, 5),
('2 Rue Jean Laffaillette', NULL, 4),
('6 Avenue du Boureau', NULL, 6),
('3 Boulevard des Pyrénées', NULL, 5),
('1 Boulevard des Aînées', NULL, 5),
('1 Rue de la Vallée', NULL, 4),
('2 Avenue de la Volaille', NULL, 6),
('2 Rue de la Vallée', NULL, 4),
('1 Avenue des Amoureux', NULL, 5),
('7 Boulevard du Centre', NULL, 1);

INSERT INTO Users (IDu, MdpU, NomU, PrenomU, Date_NaisU, MailU, role, ID_adresse) VALUES
(1, '12345a', 'Do1e', 'John', '1990-05-15', 'john.doe@gmail.com', 'Etudiant', 1),
(2, '12345b', 'Smith', 'Alice', '1985-09-21', 'alice.smith@gmail.com', 'Administrateur', 2),
(3, '12345c', 'Johnson', 'Michael', '1982-03-10', 'michael.johnson@gmail.com', 'Etudiant', 3),
(4, '12345e', 'Davis', 'Emma', '1995-07-12', 'emma.davis@gmail.com', 'Etudiant', 4),
(5, '12345f', 'Brown', 'Liam', '1993-11-30', 'liam.brown@gmail.com', 'Etudiant', 5),
(6, '12345d', 'Jones', 'David', '1979-11-18', 'david.jones@gmail.com', 'Pilote', 6);


INSERT INTO promotion (Promotion) 
VALUES 
('A1'),
('A2'),
('A3'),
('A4'),
('A5');

INSERT INTO pilote(IDu)
VALUES
(6);

INSERT INTO Admin(IDu)
VALUES 
(2);

INSERT INTO Classe(idv, IDT, IDProm,IDu)
VALUES
(5,1,2,6),
(5,2,1,6);

INSERT INTO etudiant (IDu, IDClasse) 
VALUES  
(1, 1),  -- John Doe (Etudiant)
(3, 2),  -- Michael Johnson (Etudiant)
(4, 2),  -- Emma Davis (Etudiant)
(5, 1);  -- Liam Brown (Etudiant)



INSERT INTO Secteur_activite (Secteur_Act) VALUES
('Marketing'),
('Informatique'),
('Finance'),
('Medecine');


INSERT INTO Entreprise (NomE, descr, MailE, TelE, `Site`, Moyenne, N_Siret, IdSec, ID_adresse) 
VALUES 
('Tech Solutions', 'Société spécialisée dans le développement logiciel.', 'contact@techsolutions.com', 1234567890, 'https://www.techsolutions.com', 4.5, "55546744350650", 2, 1),
('Finance Corp', 'Firme de conseil financier offrant des services de gestion de patrimoine.', 'info@financecorp.com', 987654321, 'https://www.financecorp.com', 4.2, "97524575421984", 3, 2),
('HealthCare Innovations', 'Entreprise travaillant sur des solutions technologiques pour le domaine de la santé.', 'info@healthcareinnovations.com', 654321987, 'https://www.healthcareinnovations.com', 4.8, "75483295574856", 4, 3),
('Marketing Experts', 'Agence de marketing offrant des services de stratégie et de publicité.', 'contact@marketingexperts.com', 789456123, 'https://www.marketingexperts.com', 4.0, "89654887875432", 1, 4);


INSERT INTO Competences(Comp)
VALUES
('HTML'),
('CSS'),
('JS'),
('React'),
('Node.JS'),
('Analyse financière'),
('Modelisation'),
('Reporting'),
('Biologie moleculaire'),
('Genie genetique'),
('Microbiologie'),
('Stratégie de contenu'),
('Réseaux sociaux'),
('Analyse de données');

INSERT INTO Offre (Poste, remune, Date_debutO, Date_finO, Nb_place, Descr, IDE)  
VALUES  
('Développeur Full-stack', 800, '2024-04-15', '2024-07-15', 5, 'Développeur Full-stack pour projet e-commerce.', 1),  
('Analyste financier junior', 1200, '2024-05-20', '2024-11-20', 3, "Recherche d'un analyste financier junior pour notre équipe.", 2),  
('Ingénieur en biotechnologie', 1000, '2024-06-10', '2024-12-10', 2, "Poste d'ingénieur en biotechnologie pour développement de nouveaux médicaments.", 3),  
('Chargé de marketing digital', 900, '2024-07-01', '2024-10-01', 4, 'Chargé de marketing digital pour campagnes publicitaires innovantes.', 4),  
('Front-end DEV', 650, '2024-06-10', '2024-09-10', 2, 'Développeur Front-end pour un site web.', 1);  


INSERT INTO Posseder(IDoffre, IDComp)
VALUES 
(1,1),
(1,2),
(1,3),
(1,4),
(1,5),
(2,6),
(2,7),
(2,8),
(3,9),
(3,10),
(3,11),
(4,12),
(4,13),
(4,14),
(5,1),
(5,2),
(5,4);

INSERT INTO Viser (IDoffre, IDT) 
VALUES 
(1, 1),
(2, 2),
(3, 2),
(4, 1);

INSERT INTO Evalue (IDu, Note, IDE) VALUES
(2, 4, 1),  -- Alice Smith (Administrateur)
(2, 5, 2),  -- Alice Smith (Administrateur) 
(2, 3, 3),  -- Alice Smith (Administrateur) 
(6, 2, 1),  -- David Jones (Pilote) 
(6, 4, 3),  -- David Jones (Pilote) 
(6, 3, 2);  -- David Jones (Pilote) 




INSERT INTO Candidature(IDu,IDoffre)
VALUES 
(1,1),
(3,2),
(4,3),
(5,4);

INSERT INTO souhaite(IDu,IDoffre)
VALUES
(1,1);