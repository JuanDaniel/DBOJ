CREATE TABLE canciones (
    idcancion integer DEFAULT 0 NOT NULL,
    nombre_cancion character varying(30) DEFAULT ''::character varying NOT NULL,
    genero character varying(10) DEFAULT ''::character varying NOT NULL,
    autor character varying(35) DEFAULT ''::character varying NOT NULL
) WITHOUT OIDS;

CREATE TABLE canciones_conciertos (
    idcancion integer DEFAULT 0 NOT NULL,
    idconcierto integer DEFAULT 0 NOT NULL,
    duracion integer DEFAULT 0 NOT NULL,
    doblada character(1) DEFAULT ''::bpchar NOT NULL
) WITHOUT OIDS;

CREATE TABLE conciertos (
    idconcierto integer DEFAULT 0 NOT NULL,
    nombre_concierto character varying(35) DEFAULT ''::character varying NOT NULL,
    lugar_presentacion character varying(35) DEFAULT ''::character varying NOT NULL,
    fecha timestamp without time zone NOT NULL,
    cantidad_publico integer DEFAULT 0 NOT NULL,
    pago double precision DEFAULT 0::double precision NOT NULL
) WITHOUT OIDS;

INSERT INTO canciones (idcancion, nombre_cancion, genero, autor) VALUES (1, 'El Cachumbambé', 'Salsa', 'Paulo FG');
INSERT INTO canciones (idcancion, nombre_cancion, genero, autor) VALUES (2, 'Fue un error', 'Romántico', 'Saul Delgado');
INSERT INTO canciones (idcancion, nombre_cancion, genero, autor) VALUES (3, 'Hay algo en ti', 'Salsa', 'Pablo Ruiz');
INSERT INTO canciones (idcancion, nombre_cancion, genero, autor) VALUES (4, 'Hay algo en ti', 'Bolero', 'Pablo Ruiz');
INSERT INTO canciones (idcancion, nombre_cancion, genero, autor) VALUES (5, 'Preguntele a ella', 'Salsa', 'Pablo Ruiz');
INSERT INTO canciones (idcancion, nombre_cancion, genero, autor) VALUES (6, 'Cleopatra', 'Salsa', 'Esther Saez');
INSERT INTO canciones (idcancion, nombre_cancion, genero, autor) VALUES (7, 'El bote', 'Salsa', 'PauloFG');
INSERT INTO canciones (idcancion, nombre_cancion, genero, autor) VALUES (8, 'Te deseo Suerte', 'Romántico', 'Oscar Leiva');
INSERT INTO canciones (idcancion, nombre_cancion, genero, autor) VALUES (9, 'Te Desearé', 'Romántico', 'Oscar Leiva');
INSERT INTO canciones (idcancion, nombre_cancion, genero, autor) VALUES (10, 'Me gusta tanto', 'Salsa', 'PabloFG');
INSERT INTO canciones (idcancion, nombre_cancion, genero, autor) VALUES (11, 'A mi tiempo', 'Salsa', 'César López');
INSERT INTO canciones (idcancion, nombre_cancion, genero, autor) VALUES (12, 'El tumbao de Lola', 'Salsa', 'César López');
INSERT INTO canciones (idcancion, nombre_cancion, genero, autor) VALUES (13, 'El más buscado', 'Salsa', 'Ricardo Montes');
INSERT INTO canciones (idcancion, nombre_cancion, genero, autor) VALUES (14, 'Qué manda', 'Salsa', 'Ricardo Montes');
INSERT INTO canciones (idcancion, nombre_cancion, genero, autor) VALUES (15, 'Esa amiga', 'Romántico', 'Paulo FG');
INSERT INTO canciones (idcancion, nombre_cancion, genero, autor) VALUES (16, 'Jura', 'Bolero', 'Ricardo Montes');

INSERT INTO canciones_conciertos (idcancion, idconcierto, duracion, doblada) VALUES (1, 2, 5, 'N');
INSERT INTO canciones_conciertos (idcancion, idconcierto, duracion, doblada) VALUES (2, 5, 5, 'N');
INSERT INTO canciones_conciertos (idcancion, idconcierto, duracion, doblada) VALUES (3, 3, 4, 'N');
INSERT INTO canciones_conciertos (idcancion, idconcierto, duracion, doblada) VALUES (4, 1, 8, 'N');
INSERT INTO canciones_conciertos (idcancion, idconcierto, duracion, doblada) VALUES (4, 4, 8, 'S');
INSERT INTO canciones_conciertos (idcancion, idconcierto, duracion, doblada) VALUES (5, 5, 5, 'S');
INSERT INTO canciones_conciertos (idcancion, idconcierto, duracion, doblada) VALUES (5, 9, 7, 'N');
INSERT INTO canciones_conciertos (idcancion, idconcierto, duracion, doblada) VALUES (5, 11, 7, 'S');
INSERT INTO canciones_conciertos (idcancion, idconcierto, duracion, doblada) VALUES (6, 1, 5, 'S');
INSERT INTO canciones_conciertos (idcancion, idconcierto, duracion, doblada) VALUES (6, 6, 6, 'S');
INSERT INTO canciones_conciertos (idcancion, idconcierto, duracion, doblada) VALUES (7, 10, 4, 'S');
INSERT INTO canciones_conciertos (idcancion, idconcierto, duracion, doblada) VALUES (7, 12, 7, 'N');
INSERT INTO canciones_conciertos (idcancion, idconcierto, duracion, doblada) VALUES (8, 7, 6, 'N');
INSERT INTO canciones_conciertos (idcancion, idconcierto, duracion, doblada) VALUES (8, 8, 8, 'N');
INSERT INTO canciones_conciertos (idcancion, idconcierto, duracion, doblada) VALUES (8, 11, 7, 'S');
INSERT INTO canciones_conciertos (idcancion, idconcierto, duracion, doblada) VALUES (9, 9, 9, 'N');
INSERT INTO canciones_conciertos (idcancion, idconcierto, duracion, doblada) VALUES (10, 2, 8, 'S');
INSERT INTO canciones_conciertos (idcancion, idconcierto, duracion, doblada) VALUES (10, 6, 8, 'S');
INSERT INTO canciones_conciertos (idcancion, idconcierto, duracion, doblada) VALUES (11, 1, 8, 'S');
INSERT INTO canciones_conciertos (idcancion, idconcierto, duracion, doblada) VALUES (11, 10, 8, 'S');
INSERT INTO canciones_conciertos (idcancion, idconcierto, duracion, doblada) VALUES (12, 1, 7, 'N');
INSERT INTO canciones_conciertos (idcancion, idconcierto, duracion, doblada) VALUES (12, 7, 7, 'N');
INSERT INTO canciones_conciertos (idcancion, idconcierto, duracion, doblada) VALUES (12, 9, 8, 'N');
INSERT INTO canciones_conciertos (idcancion, idconcierto, duracion, doblada) VALUES (13, 7, 6, 'N');
INSERT INTO canciones_conciertos (idcancion, idconcierto, duracion, doblada) VALUES (14, 1, 7, 'N');
INSERT INTO canciones_conciertos (idcancion, idconcierto, duracion, doblada) VALUES (15, 4, 8, 'S');
INSERT INTO canciones_conciertos (idcancion, idconcierto, duracion, doblada) VALUES (16, 12, 8, 'S');

INSERT INTO conciertos (idconcierto, nombre_concierto, lugar_presentacion, fecha, cantidad_publico, pago) VALUES (1, 'Ese soy yo ', 'Teatro Nacional', '2005-04-02 00:00:00', 350, 950);
INSERT INTO conciertos (idconcierto, nombre_concierto, lugar_presentacion, fecha, cantidad_publico, pago) VALUES (2, 'Concierto Amistad', 'Tribuna Antimperialista', '2006-04-04 00:00:00', 9000, 0);
INSERT INTO conciertos (idconcierto, nombre_concierto, lugar_presentacion, fecha, cantidad_publico, pago) VALUES (3, 'Concierto Fin de Año', 'La Plaza Roja de la Víbora', '2006-01-01 00:00:00', 3000, 900);
INSERT INTO conciertos (idconcierto, nombre_concierto, lugar_presentacion, fecha, cantidad_publico, pago) VALUES (4, 'Descarga de la casa ', 'Casa de la Música de Miramar', '2005-06-03 00:00:00', 500, 1000);
INSERT INTO conciertos (idconcierto, nombre_concierto, lugar_presentacion, fecha, cantidad_publico, pago) VALUES (5, 'Concierto Infantil', 'Teatro América', '2005-08-03 00:00:00', 300, 800);
INSERT INTO conciertos (idconcierto, nombre_concierto, lugar_presentacion, fecha, cantidad_publico, pago) VALUES (6, 'Salseros en mi Habana', 'Casa de la Música de Prado', '2006-06-05 00:00:00', 100, 1200);
INSERT INTO conciertos (idconcierto, nombre_concierto, lugar_presentacion, fecha, cantidad_publico, pago) VALUES (7, 'De gira por Cuba', 'Teatro Sausto de Matanzas', '2005-11-11 00:00:00', 350, 680);
INSERT INTO conciertos (idconcierto, nombre_concierto, lugar_presentacion, fecha, cantidad_publico, pago) VALUES (8, 'De gira por Cuba', 'Plaza Principal de Santiago de Cuba', '2005-11-13 00:00:00', 5000, 1300);
INSERT INTO conciertos (idconcierto, nombre_concierto, lugar_presentacion, fecha, cantidad_publico, pago) VALUES (9, 'Concierto Homenaje a Puerto Rico', 'Varadero', '2005-10-01 00:00:00', 1000, 1250);
INSERT INTO conciertos (idconcierto, nombre_concierto, lugar_presentacion, fecha, cantidad_publico, pago) VALUES (10, 'Cumpleaños de la EGREM', 'Café Habana Teatro Nacional', '2005-07-07 00:00:00', 150, 850);
INSERT INTO conciertos (idconcierto, nombre_concierto, lugar_presentacion, fecha, cantidad_publico, pago) VALUES (11, 'Peña de María', 'Patio de María Habana Vieja', '2006-03-03 00:00:00', 150, 800);
INSERT INTO conciertos (idconcierto, nombre_concierto, lugar_presentacion, fecha, cantidad_publico, pago) VALUES (12, 'Fiesta de Salseros', 'Sal�ón Rosado de la Tropical', '2005-11-25 00:00:00', 600, 1100);
INSERT INTO conciertos (idconcierto, nombre_concierto, lugar_presentacion, fecha, cantidad_publico, pago) VALUES (13, 'Fiesta VII Congreso', 'UCI', '2006-06-10 00:00:00', 8000, 1400);
INSERT INTO conciertos (idconcierto, nombre_concierto, lugar_presentacion, fecha, cantidad_publico, pago) VALUES (14, 'Romerías de Mayo', 'Holguín', '2006-05-13 00:00:00', 5000, 1000);
INSERT INTO conciertos (idconcierto, nombre_concierto, lugar_presentacion, fecha, cantidad_publico, pago) VALUES (15, 'Festival del Fuego', 'Santiago de Cuba', '2005-08-01 00:00:00', 10000, 1350);
INSERT INTO conciertos (idconcierto, nombre_concierto, lugar_presentacion, fecha, cantidad_publico, pago) VALUES (16, 'Lucha por la Paz', 'Tribuna Antimperialista', '2005-05-05 00:00:00', 11000, 0);

CREATE INDEX "canciones_conciertos_RefConciertos5" ON canciones_conciertos USING btree (idconcierto);

ALTER TABLE ONLY canciones
    ADD CONSTRAINT canciones_pkey PRIMARY KEY (idcancion);

ALTER TABLE ONLY canciones_conciertos
    ADD CONSTRAINT canciones_conciertos_pkey PRIMARY KEY (idcancion, idconcierto);

ALTER TABLE ONLY conciertos
    ADD CONSTRAINT conciertos_pkey PRIMARY KEY (idconcierto);

ALTER TABLE ONLY canciones_conciertos
    ADD CONSTRAINT canciones_conciertos_fk FOREIGN KEY (idconcierto) REFERENCES conciertos(idconcierto) ON UPDATE RESTRICT ON DELETE RESTRICT;

COMMENT ON SCHEMA public IS 'Standard public schema';
