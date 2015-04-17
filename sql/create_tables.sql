-- Lisää CREATE TABLE lauseet tähän tiedostoon

CREATE TABLE Opiskelija(
  id SERIAL PRIMARY KEY,
  nimi varchar(50) NOT NULL,
  password varchar(50) NOT NULL
);

CREATE TABLE Admin(
  id SERIAL PRIMARY KEY,
  opiskelija_id INTEGER REFERENCES Opiskelija(id)
);

CREATE TABLE Tilitapahtuma(
  id SERIAL PRIMARY KEY,
  opiskelija_id INTEGER REFERENCES Opiskelija(id),
  pvm DATE,
  maara DECIMAL,
  kuvaus VARCHAR(200)
);

CREATE TABLE Kategoria(
  id SERIAL PRIMARY KEY,
  nimi varchar(50) NOT NULL
);

CREATE TABLE Tapahtumakategoria(
  id SERIAL PRIMARY KEY,
  kategoria INTEGER REFERENCES Kategoria(id) ON DELETE CASCADE,
  tilitapahtuma INTEGER REFERENCES Tilitapahtuma(id) ON DELETE CASCADE
);