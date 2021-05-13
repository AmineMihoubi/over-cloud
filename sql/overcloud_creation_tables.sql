CREATE TABLE `Utilisateur` (
	`id_utilisateur` INT(20) NOT NULL AUTO_INCREMENT,
	`prenom` varchar(50) NOT NULL,
	`nom` varchar(50) NOT NULL,
	`mdp` varchar(50) NOT NULL,
	`courriel` varchar(50) NOT NULL UNIQUE,
	PRIMARY KEY (`id_utilisateur`)
);

CREATE TABLE `Galerie` (
	`id_galerie` INT(20) NOT NULL AUTO_INCREMENT,
	`nom` varchar(50) NOT NULL,
	`type` INT NOT NULL,
	`status` INT NOT NULL,
	PRIMARY KEY (`id_galerie`)
);

CREATE TABLE `Utilisateur_Galerie` (
	`fk_id_utilisateur` INT(20) NOT NULL,
	`fk_id_galerie` INT(20) NOT NULL,
	`fk_id_type_utilisateur` INT(1) NOT NULL DEFAULT '0'
);

CREATE TABLE `Photo` (
	`id_photo` INT(20) NOT NULL AUTO_INCREMENT,
	`fk_id_galerie` INT(20) NOT NULL,
	`photo` blob NOT NULL,
	`date` DATE NOT NULL,
	PRIMARY KEY (`id_photo`)
);

CREATE TABLE `Album` (
	`id_album` INT(20) NOT NULL AUTO_INCREMENT,
	`nom` varchar(50) NOT NULL,
	`fk_id_galerie` INT(20) NOT NULL,
	`date` DATE NOT NULL,
	PRIMARY KEY (`id_album`)
);

CREATE TABLE `Commentaire` (
	`id_commentaire` INT(20) NOT NULL AUTO_INCREMENT,
	`fk_id_auteur` INT(20) NOT NULL,
	`fk_id_photo` INT(20) NOT NULL,
	`message` varchar(50) NOT NULL,
	PRIMARY KEY (`id_commentaire`)
);

CREATE TABLE `Type_utilisateur` (
	`id_type_utilisateur` INT(3) NOT NULL AUTO_INCREMENT,
	`nom` varchar(15) NOT NULL UNIQUE,
	PRIMARY KEY (`id_type_utilisateur`)
);

CREATE TABLE `Administrateur` (
	`id_admin` INT(20) NOT NULL AUTO_INCREMENT,
	`utilisateur` varchar(200) NOT NULL UNIQUE,
	`mdp` varchar(200) NOT NULL,
	PRIMARY KEY (`id_admin`)
);

CREATE TABLE `Historique` (
	`id_historique` INT(20) NOT NULL AUTO_INCREMENT,
	`fk_id_utilisateur` INT(20) NOT NULL,
	`action` varchar(200) NOT NULL,
	`date` DATETIME NOT NULL,
	PRIMARY KEY (`id_historique`)
);

CREATE TABLE `Photo_Album`(
	`fk_id_photo` int(20) not null,
	`fk_id_album` int(20) not null
);

ALTER TABLE `Utilisateur_Galerie` ADD CONSTRAINT `Utilisateur_Galerie_fk0` FOREIGN KEY (`fk_id_utilisateur`) REFERENCES `Utilisateur`(`id_utilisateur`);

ALTER TABLE `Utilisateur_Galerie` ADD CONSTRAINT `Utilisateur_Galerie_fk1` FOREIGN KEY (`fk_id_galerie`) REFERENCES `Galerie`(`id_galerie`);

ALTER TABLE `Utilisateur_Galerie` ADD CONSTRAINT `Utilisateur_Galerie_fk2` FOREIGN KEY (`fk_id_type_utilisateur`) REFERENCES `Type_utilisateur`(`id_type_utilisateur`);

ALTER TABLE `Photo` ADD CONSTRAINT `Photo_fk0` FOREIGN KEY (`fk_id_galerie`) REFERENCES `Album`(`id_galerie`);

ALTER TABLE `Album` ADD CONSTRAINT `Album_fk1` FOREIGN KEY (`fk_id_galerie`) REFERENCES `Galerie`(`id_galerie`);

ALTER TABLE `Commentaire` ADD CONSTRAINT `Commentaire_fk0` FOREIGN KEY (`fk_id_auteur`) REFERENCES `Utilisateur`(`id_utilisateur`);

ALTER TABLE `Commentaire` ADD CONSTRAINT `Commentaire_fk1` FOREIGN KEY (`fk_id_photo`) REFERENCES `Photo`(`id_photo`);

ALTER TABLE `Historique` ADD CONSTRAINT `Historique_fk0` FOREIGN KEY (`fk_id_utilisateur`) REFERENCES `Utilisateur`(`id_utilisateur`);

ALTER TABLE `Photo_Album` ADD CONSTRAINT `Photo_Album_fk0` FOREIGN KEY (`fk_id_photo`) REFERENCES `Photo`(`id_photo`);

ALTER TABLE `Photo_Album` ADD CONSTRAINT `Photo_Album_fk1` FOREIGN KEY (`fk_id_album`) REFERENCES `Album`(`id_album`);