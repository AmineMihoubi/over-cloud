INSERT INTO utilisateur(nom,prenom,mdp,courriel) VALUES ('Al-Ansary','Nahwa','password123','nahwalansary@gmail.com');
INSERT INTO galerie(nom,type,status) VALUES ('Voyages',0,1);
INSERT INTO utilisateur_galerie(fk_id_utilisateur, fk_id_galerie,fk_id_type_utilisateur) VALUES ((SELECT id_utilisateur from utilisateur order by id_utilisateur desc limit 1),(SELECT id_galerie from galerie order by id_galerie desc limit 1),0);
INSERT INTO album(nom,fk_id_galerie,date) VALUES ('Album 1', LAST_INSERT_ID(),CURDATE());
INSERT INTO utilisateur(nom,prenom,mdp,courriel) VALUES ('Amenas','Assim','password123','assimamenas@gmail.com');
INSERT INTO utilisateur_galerie(fk_id_utilisateur, fk_id_galerie,fk_id_type_utilisateur) VALUES ((SELECT id_utilisateur from utilisateur order by id_utilisateur desc limit 1),(SELECT id_galerie from galerie order by id_galerie desc limit 1),1);
INSERT INTO utilisateur(nom,prenom,mdp,courriel) VALUES ('Eid','Luigi','password123','luigieid@gmail.com');
INSERT INTO administrateur(utilisateur,mdp) VALUES ('admin','123456');
INSERT INTO utilisateur_galerie(fk_id_utilisateur, fk_id_galerie,fk_id_type_utilisateur) VALUES ((SELECT id_utilisateur from utilisateur order by id_utilisateur desc limit 1),(SELECT id_galerie from galerie order by id_galerie desc limit 1),1);
