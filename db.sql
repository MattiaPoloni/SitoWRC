


DROP TABLE IF EXISTS Risultati_Gare;
DROP TABLE IF EXISTS Pilota;
DROP TABLE IF EXISTS Team;
DROP TABLE IF EXISTS Gara;
DROP TABLE IF EXISTS Pista;
DROP TABLE IF EXISTS Auto;


CREATE TABLE Auto (
id INTEGER NOT NULL PRIMARY KEY,
marca VARCHAR(20) NOT NULL,
modello VARCHAR(20) NOT NULL,
trazione VARCHAR(3)
);


CREATE TABLE Team (
id INTEGER NOT NULL PRIMARY KEY,
nome VARCHAR(100) NOT NULL,
nome_presidente VARCHAR(40) NOT NULL,
id_auto INTEGER NOT NULL,
FOREIGN KEY (id_auto) REFERENCES Auto(id)
);


CREATE TABLE Pilota (
matricola INTEGER NOT NULL PRIMARY KEY,
nome VARCHAR(20) NOT NULL,
cognome VARCHAR(20) NOT NULL,
eta INTEGER NOT NULL,
genere VARCHAR(1),
nazionalita VARCHAR(20),
id_team INTEGER NOT NULL,
FOREIGN KEY (id_team) REFERENCES Team(id)
);


CREATE TABLE Pista(
id INTEGER NOT NULL PRIMARY KEY,
nome VARCHAR(50) NOT NULL,
citta VARCHAR(30) NOT NULL,
tipo VARCHAR(20),
stato VARCHAR(30) NOT NULL
);


CREATE TABLE Gara(
id INTEGER NOT NULL PRIMARY KEY,
giorno DATE NOT NULL,
id_pista INTEGER NOT NULL,
FOREIGN KEY (id_pista) REFERENCES Pista(id)
);


CREATE TABLE Risultati_Gare(
id_gara INTEGER NOT NULL,
id_pilota INTEGER NOT NULL,
posizione_arrivo INTEGER, /*null se il pilota si è ritirato*/
punti INTEGER NOT NULL, /*GESTITO DA APPLICATIVO*/
PRIMARY KEY(id_gara, id_pilota),
FOREIGN KEY (id_gara) REFERENCES Gara(id),
FOREIGN KEY (id_pilota) REFERENCES Pilota(matricola) ON DELETE CASCADE
);


INSERT INTO Auto (id, marca, modello, trazione)
VALUES (1, "Toyota", "Yaris WRC", "AWD"),
(2, "Citroen", "C3 WRC", "AWD"),
(3, "Hyundai", "i20 WRC", "AWD"),
(4, "Ford", "Fiesta WRC", "AWD");

INSERT INTO Team (id, nome, nome_presidente, id_auto) 
VALUES (1, "Toyota Gazoo Racing WRT", "Toshio Sato", 1),
(2, "Citroen Total Abu-Dhabi WRT", "Khalid Al Qassimi", 2),
(3, "Hyundai Shell Mobis WRT", "Gyoo-Heon Choi", 3),
(4, "M-Sport Ford Word Rally Team", "Malcolm Wilson", 4);

INSERT INTO Pilota (matricola, nome, cognome, eta, genere, nazionalita, id_team) VALUES
(1001, "Sebastien", "Ogier", 31, "M", "Francia", 4),
(1002, "Elfyn", "Evans", 31, "M", "Regno Unito", 4),
(1010, "Thierry", "Neuville", 28, "M", "Belgio", 3),
(1003, "Andreas", "Mikkelsen", 32, "M", "Belgio", 3),
(1008, "Daniel", "Sordo", 33, "M", "Spagna", 3),
(1004, "Ott", "Tanak", 31,"M", "Estonia",1),
(1005, "Jari Matti", "Latvala", 31, "M", "Finlandia", 1),
(1006, "Esapekka", "Lappi", 31, "M", "Finlandia", 1),
(1007, "Kris", "Meeke", 37, "M", "Irlanda del Nord", 2),
(1009, "Craig", "Breen", 26, "M", "Irlanda", 2);


INSERT INTO Pista(id, nome, citta, tipo, stato) VALUES
(1, "Rallye Automobile Monte Carlo", "Montecarlo", "Neve-Asfalto", "Montecarlo"),
(2, "Rally Sweden", "Karlstad", "Neve", "Svezia"),
(3, "Rally Guanajuato Corona México", "Leon", "Sterrato", "Messico"),
(4, "CORSICA Linea Tour de Corse", "Bastia", "Asfalto", "Francia"),
(5, "YPF Rally Argentina", "Villa Carlos Paz", "Sterrato", "Argentina"),
(6, "Vodafone Rally de Portugal", "Matosinhos", "Sterrato", "Portogallo"),
(7, "Rally Italia Sardegna", "Alghero", "Sterrato", "Italia"),
(8, "Neste Rally Finland", "Jyvaskyla", "Sterrato", "Finlandia"),
(9, "ADAC Rallye Deutschland", "Bostalsee", "Asfalto", "Germania"),
(10, "Marmaris Rally Turkey", "Marmaris", "Sterrato", "Turchia"),
(11, "Dayinsure Wales Rally GB", "Deeside", "Sterrato", "Regno Unito"),
(12, "Rally RACC Catalunya - Rally de España", "Salou", "Asfalto - Sterrato", "Spagna"),
(13, "Kennards Hire Rally Australia", "Coffs Harbour", "Sterrato", "Australia");


INSERT INTO Gara(id, giorno, id_pista) VALUES
(1, "2018-01-25", 1),
(2, "2018-02-15", 2),
(3, "2018-03-8", 3),
(4, "2018-04-5", 4),
(5, "2018-04-26", 5),
(6, "2018-05-17", 6),
(7, "2018-06-7", 7),
(8, "2018-07-26", 8),
(9, "2018-08-16", 9),
(10, "2018-09-13", 10),
(11, "2018-10-4", 11),
(12, "2018-10-25", 12),
(13, "2018-11-15", 13);


INSERT INTO Risultati_Gare(id_Gara, id_Pilota, posizione_arrivo, punti) VALUES
(1,1001,1,25),
(2,1001,10,1),
(3,1001,1,25),
(4,1001,1,25),
(5,1001,4,12),
(6,1001,99,0),
(7,1001,2,18),
(1,1002,6,8),
(2,1002,14,0),
(3,1002,99,0),
(4,1002,5,10),
(5,1002,6,8),
(6,1002,2,18),
(7,1002,14,0),
(1,1003,13,0),
(2,1003,3,15),
(3,1003,4,12),
(4,1003,6,8),
(5,1003,5,10),
(6,1003,16,0),
(7,1003,16,0),
(1,1004,2,18),
(2,1004,9,2),
(3,1004,14,0),
(4,1004,2,18),
(5,1004,1,25),
(6,1004,99,0),
(7,1004,9,2),
(1,1005,3,15),
(2,1005,7,6),
(3,1005,8,4),
(4,1005,99,0),
(5,1005,99,0),
(6,1005,24,0),
(7,1005,7,6),
(1,1006,7,6),
(2,1006,4,12),
(3,1006,11,0),
(4,1006,6,8),
(5,1006,8,4),
(6,1006,5,10),
(7,1006,3,15),
(1,1007,4,12),
(2,1007,99,0),
(3,1007,3,15),
(4,1007,9,2),
(5,1007,7,6),
(6,1007,99,0),
(7,1007,99,0),
(1,1008,99,0),
(2,1008,99,0),
(3,1008,2,18),
(4,1008,4,12),
(5,1008,3,15),
(6,1008,4,12),
(7,1008,99,0),
(1,1009,9,2),
(2,1009,2,18),
(3,1009,99,0),
(4,1009,99,0),
(5,1009,99,0),
(6,1009,7,6),
(7,1009,6,8),
(1,1010,5,10),
(2,1010,1,25),
(3,1010,6,8),
(4,1010,3,15),
(5,1010,2,18),
(6,1010,1,25),
(7,1010,1,25);