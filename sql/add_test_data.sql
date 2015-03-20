-- Lisää INSERT INTO lauseet tähän tiedostoon

INSERT INTO Opiskelija(nimi, password) VALUES ('Pena', 'qwerty');

INSERT INTO Opiskelija(nimi, password) VALUES ('Repe', '123');

INSERT INTO Admin(opiskelija_id) VALUES (1);

INSERT INTO Tilitapahtuma(pvm, maara, kuvaus) VALUES ('2015-1-03', -6, 'bisse');

INSERT INTO Tilitapahtuma(pvm, maara, kuvaus) VALUES (NOW(), -2.6 , 'unicafe');

INSERT INTO Tilitapahtuma(pvm, maara, kuvaus) VALUES (NOW(), 666 , 'luciferilta sain kahvirahat');
