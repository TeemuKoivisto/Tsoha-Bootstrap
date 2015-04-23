-- Lisää INSERT INTO lauseet tähän tiedostoon

INSERT INTO Opiskelija(nimi, password, yllapitaja) VALUES ('Pena', 'asdf', true);

INSERT INTO Opiskelija(nimi, password, yllapitaja) VALUES ('Repe', '123', false);

INSERT INTO Opiskelija(nimi, password, yllapitaja) VALUES ('asdf', ' ', true);

INSERT INTO Kategoria(nimi) VALUES ('Lääkkeet');

INSERT INTO Kategoria(nimi) VALUES ('Ruoka');

INSERT INTO Kategoria(nimi) VALUES ('Muu');

INSERT INTO Tilitapahtuma(opiskelija_id, pvm, maara, kuvaus) VALUES (1, '2015-1-03', -6, 'bisse');

INSERT INTO Tilitapahtuma(opiskelija_id, pvm, maara, kuvaus) VALUES (2, NOW(), -2.6 , 'unicafe');

INSERT INTO Tilitapahtuma(opiskelija_id, pvm, maara, kuvaus) VALUES (3, NOW(), 666 , 'luciferilta sain kahvirahat');

INSERT INTO Tilitapahtuma(opiskelija_id, pvm, maara, kuvaus) VALUES (1, '2013-1-2', -5000 , 'huumevelat rapsahti');

INSERT INTO Tilitapahtuma(opiskelija_id, pvm, maara, kuvaus) VALUES (2, '2014-11-24', 3423854.35 , 'pankkiryöstö');

INSERT INTO Tapahtumakategoria(kategoria, tilitapahtuma) VALUES (1, 1);

INSERT INTO Tapahtumakategoria(kategoria, tilitapahtuma) VALUES (2, 2);

INSERT INTO Tapahtumakategoria(kategoria, tilitapahtuma) VALUES (3, 3);

INSERT INTO Tapahtumakategoria(kategoria, tilitapahtuma) VALUES (3, 4);

INSERT INTO Tapahtumakategoria(kategoria, tilitapahtuma) VALUES (1, 4);

INSERT INTO Tapahtumakategoria(kategoria, tilitapahtuma) VALUES (3, 5);