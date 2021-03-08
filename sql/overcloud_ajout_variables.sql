INSERT INTO utilisateur(nom,prenom,mdp,courriel) VALUES ('Al-Ansary','Nahwa','password123','nahwalansary@gmail.com');
INSERT INTO galerie(nom,prive) VALUES ('Marriage',0);
INSERT INTO utilisateur_galerie(fk_id_utilisateur, fk_id_galerie,fk_id_type_utilisateur) VALUES ((SELECT id_utilisateur from utilisateur order by id_utilisateur desc limit 1),(SELECT id_galerie from galerie order by id_galerie desc limit 1),1);
INSERT INTO album(nom,fk_id_galerie) VALUES ('Album 1', LAST_INSERT_ID());
--INSERT INTO photo(photo,date,fk_id_album) VALUES (LOAD_FILE('C:/wamp64/www/over-cloud/image/demo/img1.jpeg'),CURRENT_DATE,(SELECT id_album from album order by id_album desc limit 1));
--INSERT INTO photo(photo,date,fk_id_album) VALUES (LOAD_FILE('C:/wamp64/www/over-cloud/image/demo/img2.jpeg'),CURRENT_DATE,(SELECT id_album from album order by id_album desc limit 1));

INSERT INTO utilisateur(nom,prenom,mdp,courriel) VALUES ('Amenas','Assim','password123','assimamenas@gmail.com');
INSERT INTO utilisateur_galerie(fk_id_utilisateur, fk_id_galerie,fk_id_type_utilisateur) VALUES ((SELECT id_utilisateur from utilisateur order by id_utilisateur desc limit 1),(SELECT id_galerie from galerie order by id_galerie desc limit 1),2);
