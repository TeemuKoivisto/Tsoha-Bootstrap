-- Lisää INSERT INTO lauseet tähän tiedostoon

INSERT INTO Opiskelija(nimi, password) VALUES ('Pena', 'asdf');

INSERT INTO Opiskelija(nimi, password) VALUES ('Repe', '123');

INSERT INTO Opiskelija(nimi, password) VALUES ('Asdf', ' ');

INSERT INTO Admin(opiskelija_id) VALUES (1);

INSERT INTO Kategoria(nimi) VALUES ('Lääkkeet');

INSERT INTO Kategoria(nimi) VALUES ('Ruoka');

INSERT INTO Kategoria(nimi) VALUES ('Muu');

INSERT INTO Tilitapahtuma(opiskelija_id, pvm, maara, kuvaus) VALUES (1, '2015-1-03', -6, 'bisse');

INSERT INTO Tilitapahtuma(opiskelija_id, pvm, maara, kuvaus) VALUES (2, NOW(), -2.6 , 'unicafe');

INSERT INTO Tilitapahtuma(opiskelija_id, pvm, maara, kuvaus) VALUES (3, NOW(), 666 , 'luciferilta sain kahvirahat');
