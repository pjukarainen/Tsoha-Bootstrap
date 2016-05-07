CREATE TABLE Statuser(
id SERIAL PRIMARY KEY,
username varchar(50),
password varchar(50)
);

CREATE TABLE Player(
id SERIAL PRIMARY KEY,
handle varchar(100),
name varchar(100),
sponsor varchar(100),
country varchar(100),
characters varchar(500),
points integer,
description varchar(500)
);

CREATE TABLE Tournament(
id SERIAL PRIMARY KEY,
name varchar(100),
held date,
ends date,
location varchar(100),
status varchar(50),
region varchar(50),
description varchar(5000)
);



CREATE TABLE Tournamentplayer(
player_id INTEGER REFERENCES Player(id),
tournament_id INTEGER REFERENCES Tournament(id)
);

