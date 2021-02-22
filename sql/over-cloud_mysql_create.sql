CREATE TABLE `Utilisateur` (
	`id_utilisateur` INT(20) NOT NULL AUTO_INCREMENT,
	`nom` varchar(50) NOT NULL,
	`password` varchar(50) NOT NULL,
	`Email` varchar(50) NOT NULL UNIQUE,
	PRIMARY KEY (`id_utilisateur`)
);

CREATE TABLE `Galerie` (
	`id_galerie` INT(20) NOT NULL AUTO_INCREMENT,
	`nom` varchar(50) NOT NULL,
	`Individuel` BOOLEAN NOT NULL,
	PRIMARY KEY (`id_galerie`)
);

CREATE TABLE `Utilisateur-Galerie` (
	`fk_id_utilisateur` INT(20) NOT NULL,
	`fk_id_galerie` INT(20) NOT NULL,
	`fk_id_type_utilisateur` INT(3) NOT NULL DEFAULT '0'
);

CREATE TABLE `Photo` (
	`id_photo` INT(20) NOT NULL AUTO_INCREMENT,
	`photo` blob NOT NULL,
	`date` DATE NOT NULL,
	PRIMARY KEY (`id_photo`)
);

CREATE TABLE `Album` (
	`id_album` INT(20) NOT NULL AUTO_INCREMENT,
	`nom` varchar(50) NOT NULL,
	`publique` BOOLEAN NOT NULL DEFAULT '0',
	PRIMARY KEY (`id_album`)
);

CREATE TABLE `Photo-Album` (
	`fk_id_Photo` INT(20) NOT NULL,
	`fk_id_Album` INT(20) NOT NULL
);

CREATE TABLE `Galerie-Album` (
	`fk_id_galerie` INT(20) NOT NULL,
	`fk_id_Album` INT(20) NOT NULL,
	`personnel` BOOLEAN NOT NULL DEFAULT true
);

CREATE TABLE `Commentaire` (
	`id_commentaire` INT(20) NOT NULL AUTO_INCREMENT,
	`fk_id_auteur` INT(20) NOT NULL,
	`fk_id_photo` INT(20) NOT NULL,
	`Texte` varchar(50) NOT NULL,
	PRIMARY KEY (`id_commentaire`)
);

CREATE TABLE `Type_utilisateur` (
	`id_type_utilisateur` INT(3) NOT NULL AUTO_INCREMENT,
	`nom` varchar(15) NOT NULL UNIQUE,
	PRIMARY KEY (`id_type_utilisateur`)
);

ALTER TABLE `Utilisateur-Galerie` ADD CONSTRAINT `Utilisateur-Galerie_fk0` FOREIGN KEY (`fk_id_utilisateur`) REFERENCES `Utilisateur`(`id_utilisateur`);

ALTER TABLE `Utilisateur-Galerie` ADD CONSTRAINT `Utilisateur-Galerie_fk1` FOREIGN KEY (`fk_id_galerie`) REFERENCES `Galerie`(`id_galerie`);

ALTER TABLE `Utilisateur-Galerie` ADD CONSTRAINT `Utilisateur-Galerie_fk2` FOREIGN KEY (`fk_id_type_utilisateur`) REFERENCES `Type_utilisateur`(`id_type_utilisateur`);

ALTER TABLE `Photo-Album` ADD CONSTRAINT `Photo-Album_fk0` FOREIGN KEY (`fk_id_Photo`) REFERENCES `Photo`(`id_photo`);

ALTER TABLE `Photo-Album` ADD CONSTRAINT `Photo-Album_fk1` FOREIGN KEY (`fk_id_Album`) REFERENCES `Album`(`id_album`);

ALTER TABLE `Galerie-Album` ADD CONSTRAINT `Galerie-Album_fk0` FOREIGN KEY (`fk_id_galerie`) REFERENCES `Galerie`(`id_galerie`);

ALTER TABLE `Galerie-Album` ADD CONSTRAINT `Galerie-Album_fk1` FOREIGN KEY (`fk_id_Album`) REFERENCES `Album`(`id_album`);

ALTER TABLE `Commentaire` ADD CONSTRAINT `Commentaire_fk0` FOREIGN KEY (`fk_id_auteur`) REFERENCES `Utilisateur`(`id_utilisateur`);

ALTER TABLE `Commentaire` ADD CONSTRAINT `Commentaire_fk1` FOREIGN KEY (`fk_id_photo`) REFERENCES `Photo`(`id_photo`);

