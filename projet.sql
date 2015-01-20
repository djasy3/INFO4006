-- Création des tables

CREATE TABLE Categorie (
  IdCat        INT UNSIGNED AUTO_INCREMENT,
  TitreCat     VARCHAR(100),
  Description  TEXT,
  DateCreation TIMESTAMP,
  DateMaj      TIMESTAMP,
  PRIMARY KEY (IdCat)
) ENGINE = InnoDB;

CREATE TABLE Item (
  IdItem       INT UNSIGNED AUTO_INCREMENT,
  IdCat        INT UNSIGNED,
  Nom          VARCHAR(100),
  Description  TEXT,
  Image        VARCHAR(100),
  Prix         FLOAT,
  Actif        BOOL,
  DateCreation TIMESTAMP,
  DateMaj      TIMESTAMP,
  PRIMARY KEY (IdItem),
  FOREIGN KEY (IdCat) REFERENCES Categorie (IdCat)
) ENGINE = InnoDB;

CREATE TABLE Appreciation (
  IdAppr       INT UNSIGNED AUTO_INCREMENT,
  IdItem       INT UNSIGNED,
  Score	       TINYINT,
  Commentaire  TEXT,
  PRIMARY KEY (IdAppr),
  FOREIGN KEY (IdItem) REFERENCES Item (IdItem)
) ENGINE = InnoDB;

-- Tuples

INSERT INTO Categorie (TitreCat, Description, DateCreation, DateMaj) VALUES
('Electronique', 'Pleins de truc électroniques', CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP()),
('Livres', 'Toutes sortes de livres', CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP()),
('Logiciels', 'En masse de logiciels', CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP());

INSERT INTO Item (IdCat, Nom, Description, Image, Prix, Actif, DateCreation, DateMaj) VALUES
(1, 'Ordinateur portable ASUS', 'asus_laptop.jpg', 'ASUS G750JZ-DB73-CA 17.3 Inch Notebook Full HD Screen with Intel Core i7, 24GB, Nvidia GTX880M, 256GB SSD , 1TB 7200 RPM, Blu-Ray Writer, Killer LAN, Black', 2169.00, True, CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP()),
(1, 'Disque dur SSD', 'KingFast 2710MCS08-256 Disque Flash SSD interne, 256 Go 7 mm, 2.5 " SATA III, cache de 256 Mo, 6 Go / s, MLC - Argent', 'disque_dur_ssd.jpg', 132.50, True, CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP()),
(1, 'Clavier sans fil', 'Logitech Wireless Touch Keyboard K400 with Built-In Multi-Touch Touchpad ', 'clavier_sans_fil.jpg', 39.99, True, CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP()),
(1, 'Webcam Logitech', 'Logitech Webcam HD Pro C920', 'webcam_logitech.jpg', 98.99, True, CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP()),
(2, 'Programmez avec C++', 'Programmez avec le langage C++ (Livre du Zéro) (French Edition)', 'programmez_avec_c++.jpg', 9.59, True, CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP()),
(2, 'Video Compression Systems', 'Video Compression Systems: From first principles to concatenated codecs (Iet Telecommuncations)', 'video_compression_systems.jpg', 51.86, True, CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP()),
(2, 'Algorithmes: Notions de base', 'Algorithmes: Notions de base', 'algorithmes_base.jpg', 32.99, True, CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP()),
(3, 'Microsoft Office Student 2010', 'Microsoft Office Home & Student 2010 Product Key Card', 'microsoft_office.jpg', 110.00, True, CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP()),
(3, 'Dragon NaturallySpeaking', 'Dragon NaturallySpeaking Premium 13 Bluetooth (Wireless)', 'dragon_naturally.jpg', 299.99, True, CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP()),
(3, 'McAfee Total Protection 2015', 'McAfee Total Protection 2015, 1PC', 'mcafee_total.jpg', 59.99, True, CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP());
