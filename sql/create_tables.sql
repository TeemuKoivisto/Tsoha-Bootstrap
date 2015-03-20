-- Lisää CREATE TABLE lauseet tähän tiedostoon

CREATE TABLE Opiskelija(
  id SERIAL PRIMARY KEY,
  nimi varchar(50) NOT NULL,
  password varchar(50) NOT NULL
);

CREATE TABLE Tilitapahtuma(
  id SERIAL PRIMARY KEY,
  opiskelija_id INTEGER REFERENCES Opiskelija(id),
  pvm DATE,
  maara DECIMAL,
  kuvaus VARCHAR(200)
);
