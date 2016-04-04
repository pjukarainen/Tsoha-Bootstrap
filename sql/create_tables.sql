-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Protour(
id SERIAL PRIMARY KEY,
tournaments text[],
players text[]
);

CREATE TABLE Player(
id SERIAL PRIMARY KEY,
protour_id INTEGER REFERENCES Protour(id),
handle varchar(100),
name varchar(100),
sponsor varchar(100),
country varchar(100),
characters text[],
tournaments text[],
points INTEGER,
description varchar(500)
);

CREATE TABLE Tournament(
id SERIAL PRIMARY KEY,
protour_id INTEGER REFERENCES Protour(id),
name varchar(100),
held varchar(100),
location varchar(100),
status varchar(50),
region varchar(50),
description varchar(50),
standings text[]
);



CREATE TABLE Tournamentplayer(
player_id INTEGER REFERENCES Player(id),
tournament_id INTEGER REFERENCES Tournament(id)
);

