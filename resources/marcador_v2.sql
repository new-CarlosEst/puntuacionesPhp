CREATE DATABASE IF NOT EXISTS marcador;
USE marcador;
-- Tablas
CREATE TABLE IF NOT EXISTS topten (
pos int primary key,				-- Posicion en el marcador
nick varchar(3),					-- Nick del jugador ( 3 letras )						
score  int							-- Puntuación >=0
);

-- Datos 
-- Cambio un poco el sql y me hago un insert ingnore para que si ya esta esa posicion (Esa primary key) no me hago el insert
INSERT IGNORE INTO topten values (1,'ZOO', 9991);
INSERT IGNORE INTO topten values (2,'JAR', 8523);
INSERT IGNORE INTO topten values (3,'ZIP', 3389);
INSERT IGNORE INTO topten values (4,'TAR', 1564);
INSERT IGNORE INTO topten values (5,'BZ7', 792);
INSERT IGNORE INTO topten values (6,'RAR', 666);
INSERT IGNORE INTO topten values (7,'---', 0);
INSERT IGNORE INTO topten values (8,'---', 0);
INSERT IGNORE INTO topten values (9,'---', 0);
INSERT IGNORE INTO topten values (10,'---', 0);

-- select * from topten;