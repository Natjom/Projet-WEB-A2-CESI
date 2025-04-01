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

INSERT INTO Utilisateur (IDu, MdpU, NomU, PrenomU, Date_NaisU, MailU, role, ID_adresse) VALUES
(1, '12345a', 'Do1e', 'John', '1990-05-15', 'john.doe@gmail.com', 'Etudiant',1),
(2, '12345b', 'Smith', 'Alice', '1985-09-21', 'alice.smith@gmail.com', 'Administrateur',2),
(3, '12345c', 'Johnson', 'Michael', '1982-03-10', 'michael.johnson@gmail.com', 'Etudiant',3),
(6, '12345d', 'Jones', 'David', '1979-11-18', 'david.jones@gmail.com', 'Pilote',6);

INSERT INTO promotion (Promotion) 
VALUES 
('A1'),
('A2'),
('A3'),
('A4'),
('A5');

INSERT INTO pilote(IDu)
VALUES
(6),
(13);

INSERT INTO Admin(IDu)
VALUES 
(2);

INSERT INTO Classe(idv, IDT, IDProm,IDu)
VALUES
(5,1,2,6),
(1,2,3,13),
(5,2,1,6),
(2,1,1,13);

INSERT INTO etudiant (IDu, IDClasse) 
VALUES 
(4, 1),
(1, 1),
(3, 2),
(5, 1),
(7, 2),
(8, 3),
(9, 3),
(10, 3),
(11, 2),
(12, 4),
(14, 4),
(15, 2);

INSERT INTO Secteur_Activite (Secteur_Act) VALUES
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

INSERT INTO Offre (Duree, Poste, remune, Date_Stage, Nb_place, Descr, IDE) 
VALUES 
(3, 'Développeur Full-stack', 800, '2024-04-15', 5, 'Développeur Full-stack pour projet e-commerce.', 1),
(6, 'Analyste financier junior', 1200, '2024-05-20', 3, "Recherche d'un analyste financier junior pour notre équipe.", 2),
(4, 'Ingénieur en biotechnologie', 1000, '2024-06-10', 2, "Poste d'ingénieur en biotechnologie pour développement de nouveaux médicaments.", 3),
(5, 'Chargé de marketing digital', 900, '2024-07-01', 4, 'Chargé de marketing digital pour campagnes publicitaires innovantes.', 4),
(3, 'Front-end DEV', 650, '2024-06-10', 2, 'Déceloppeur Front-end pour un site web', 1);

INSERT INTO necessite(IDoffre, IDComp)
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

INSERT INTO note(IDu, NoteU, IDE)
VALUES
(11, 3, 1),
(12, 3, 1),
(14, 5, 3),
(15, 2, 4);

INSERT INTO postuler(IDu,IDoffre)
VALUES 
(11,1),
(12,2);

INSERT INTO interesser(IDu,IDoffre)
VALUES
(11,1);
