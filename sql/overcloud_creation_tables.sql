CREATE TABLE `utilisateur` (
	`id_utilisateur` INT(20) NOT NULL AUTO_INCREMENT,
	`nom` varchar(50) NOT NULL,
	`prenom` varchar(50) NOT NULL,
	`mdp` varchar(50) NOT NULL,
	`courriel` varchar(50) NOT NULL UNIQUE,
	PRIMARY KEY (`id_utilisateur`)
);

CREATE TABLE `galerie` (
	`id_galerie` INT(20) NOT NULL AUTO_INCREMENT,
	`nom` varchar(50) NOT NULL,
	`prive` BOOLEAN NOT NULL,
	PRIMARY KEY (`id_galerie`)
);

CREATE TABLE `utilisateur_galerie` (
	`fk_id_utilisateur` INT(20) NOT NULL,
	`fk_id_galerie` INT(20) NOT NULL,
	`fk_id_type_utilisateur` INT(1) NOT NULL
);

CREATE TABLE `photo` (
	`id_photo` INT(20) NOT NULL AUTO_INCREMENT,
	`photo` blob NOT NULL,
	`date` DATE NOT NULL,
	`fk_id_album` INT(20) NOT NULL,
	PRIMARY KEY (`id_photo`)
);

CREATE TABLE `album` (
	`id_album` INT(20) NOT NULL AUTO_INCREMENT,
	`nom` varchar(50) NOT NULL,
	`fk_id_galerie` INT(20) NOT NULL,
	PRIMARY KEY (`id_album`)
);


CREATE TABLE `commentaire` (
	`id_commentaire` INT(20) NOT NULL AUTO_INCREMENT,
	`fk_id_auteur` INT(20) NOT NULL,
	`fk_id_photo` INT(20) NOT NULL,
	`message` varchar(50) NOT NULL,
	PRIMARY KEY (`id_commentaire`)
);

CREATE TABLE `type_utilisateur` (
	`id_type_utilisateur` INT(3) NOT NULL AUTO_INCREMENT,
	`nom` varchar(15) NOT NULL UNIQUE,
	PRIMARY KEY (`id_type_utilisateur`)
);

INSERT INTO `type_utilisateur` (`id_type_utilisateur`, `nom`) VALUES ('1', 'artiste');

INSERT INTO `type_utilisateur` (`id_type_utilisateur`, `nom`) VALUES ('2', 'spectateur');

ALTER TABLE `utilisateur_galerie` ADD CONSTRAINT `utilisateur_galerie_fk0` FOREIGN KEY (`fk_id_utilisateur`) REFERENCES `utilisateur`(`id_utilisateur`);

ALTER TABLE `utilisateur_galerie` ADD CONSTRAINT `utilisateur_galerie_fk1` FOREIGN KEY (`fk_id_galerie`) REFERENCES `galerie`(`id_galerie`);

ALTER TABLE `utilisateur_galerie` ADD CONSTRAINT `utilisateur_galerie_fk2` FOREIGN KEY (`fk_id_type_utilisateur`) REFERENCES `type_utilisateur`(`id_type_utilisateur`);

ALTER TABLE `photo` ADD CONSTRAINT `fk_id_album` FOREIGN KEY (`fk_id_album`) REFERENCES `album`(`id_album`);

ALTER TABLE `album` ADD CONSTRAINT `fk_id_galerie` FOREIGN KEY (`fk_id_galerie`) REFERENCES `galerie`(`id_galerie`);

ALTER TABLE `commentaire` ADD CONSTRAINT `fk_id_auteur` FOREIGN KEY (`fk_id_auteur`) REFERENCES `utilisateur`(`id_utilisateur`);

ALTER TABLE `commentaire` ADD CONSTRAINT `fk_id_photo` FOREIGN KEY (`fk_id_photo`) REFERENCES `photo`(`id_photo`);

