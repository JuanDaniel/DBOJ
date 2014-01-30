SET check_function_bodies = false;

SET search_path = public, pg_catalog;
CREATE TABLE public.megas (
    idmegas integer DEFAULT nextval(('"public"."megas_idmegas_seq"'::text)::regclass) NOT NULL,
    cantidad integer
) WITHOUT OIDS;

CREATE TABLE public.dpto (
    iddpto integer DEFAULT nextval(('"public"."dpto_iddpto_seq"'::text)::regclass) NOT NULL,
    nomb_dpto character varying(100),
    asignaturas character varying(255)
) WITHOUT OIDS;

CREATE TABLE public.rol (
    idrol integer DEFAULT nextval(('"public"."rol_idrol_seq"'::text)::regclass) NOT NULL,
    idmegas integer NOT NULL,
    nombre character varying(50)
) WITHOUT OIDS;

CREATE TABLE public.persona (
    ci character varying(11) NOT NULL,
    idrol integer,
    nombre_completo character varying(100) NOT NULL,
    edad integer
) WITHOUT OIDS;

CREATE TABLE public.estudiante (
    ci character varying(11) NOT NULL,
    promedio double precision
) WITHOUT OIDS;

CREATE TABLE public.descarga (
    iddescarga integer DEFAULT nextval(('"public"."descarga_iddescarga_seq"'::text)::regclass) NOT NULL,
    cipersona character varying(11) NOT NULL,
    fecha date,
    nombre_archivo character varying(100),
    dirurl character varying(500),
    megas_nec integer
) WITHOUT OIDS;

CREATE TABLE public.profesor (
    ci character varying(11) NOT NULL,
    dpto integer NOT NULL,
    titulo character varying(100)
) WITHOUT OIDS;

CREATE SEQUENCE public.megas_idmegas_seq
    INCREMENT BY 1
    MAXVALUE 2147483647
    NO MINVALUE
    CACHE 1;

CREATE SEQUENCE public.dpto_iddpto_seq
    INCREMENT BY 1
    MAXVALUE 2147483647
    NO MINVALUE
    CACHE 1;

CREATE SEQUENCE public.descarga_iddescarga_seq
    INCREMENT BY 1
    MAXVALUE 2147483647
    NO MINVALUE
    CACHE 1;

CREATE SEQUENCE public.rol_idrol_seq
    INCREMENT BY 1
    MAXVALUE 2147483647
    NO MINVALUE
    CACHE 1;

INSERT INTO megas (idmegas, cantidad)
VALUES (1, 50);

INSERT INTO megas (idmegas, cantidad)
VALUES (2, 100);

INSERT INTO megas (idmegas, cantidad)
VALUES (3, 150);

INSERT INTO megas (idmegas, cantidad)
VALUES (4, 200);

INSERT INTO megas (idmegas, cantidad)
VALUES (5, 300);

INSERT INTO megas (idmegas, cantidad)
VALUES (6, 500);

INSERT INTO megas (idmegas, cantidad)
VALUES (7, 1000);

INSERT INTO dpto (iddpto, nomb_dpto, asignaturas)
VALUES (1, 'Programación', 'Programación 1, Programación 2, Introducción a la Programación, Programación 3, Gráfico por computadoras');

INSERT INTO dpto (iddpto, nomb_dpto, asignaturas)
VALUES (2, 'Matemáticas', 'Cálculo 1, Cálculo2, Álgebra, Investigación de operaciones');

INSERT INTO dpto (iddpto, nomb_dpto, asignaturas)
VALUES (3, 'Ingeniería y Gestión de SW', 'Ingeniería de SW 1, Ingeniería de SW 2, Sistema de Bases de Datos, Práctica profesional');

INSERT INTO rol (idrol, idmegas, nombre)
VALUES (1, 1, 'Novato');

INSERT INTO rol (idrol, idmegas, nombre)
VALUES (2, 2, 'Programador');

INSERT INTO rol (idrol, idmegas, nombre)
VALUES (3, 2, 'Diseñador de BD');

INSERT INTO rol (idrol, idmegas, nombre)
VALUES (4, 2, 'Documentador');

INSERT INTO rol (idrol, idmegas, nombre)
VALUES (5, 3, 'Diseñador');

INSERT INTO rol (idrol, idmegas, nombre)
VALUES (6, 2, 'Probador de Calidad');

INSERT INTO rol (idrol, idmegas, nombre)
VALUES (7, 3, 'Diseñador de casos de prueba');

INSERT INTO rol (idrol, idmegas, nombre)
VALUES (8, 4, 'Administrador de BD');

INSERT INTO rol (idrol, idmegas, nombre)
VALUES (9, 4, 'Arquitecto de datos');

INSERT INTO rol (idrol, idmegas, nombre)
VALUES (10, 5, 'Administrador de la Calidad');

INSERT INTO rol (idrol, idmegas, nombre)
VALUES (11, 5, 'Analista de software');

INSERT INTO rol (idrol, idmegas, nombre)
VALUES (12, 5, 'Arquitecto de software');

INSERT INTO rol (idrol, idmegas, nombre)
VALUES (13, 6, 'Planificador de software');

INSERT INTO rol (idrol, idmegas, nombre)
VALUES (14, 6, 'Líder de Proyecto');

INSERT INTO persona (ci, idrol, nombre_completo, edad)
VALUES ('66123154786', 14, 'Ramiro Vázquez Cobas', 43);

INSERT INTO persona (ci, idrol, nombre_completo, edad)
VALUES ('82023154786', 13, 'Adonis González Hondal', 28);

INSERT INTO persona (ci, idrol, nombre_completo, edad)
VALUES ('77103154786', 11, 'Adriam Lorenzo Alea', 32);

INSERT INTO persona (ci, idrol, nombre_completo, edad)
VALUES ('71060624457', 10, 'Pepa Fernández Montero', 38);

INSERT INTO persona (ci, idrol, nombre_completo, edad)
VALUES ('72060634457', 14, 'Danelys Cid Morejón', 37);

INSERT INTO persona (ci, idrol, nombre_completo, edad)
VALUES ('75080624457', 5, 'Raydel Tong Alonso', 35);

INSERT INTO persona (ci, idrol, nombre_completo, edad)
VALUES ('88060624457', 3, 'Dania Zamora Leyva', 22);

INSERT INTO persona (ci, idrol, nombre_completo, edad)
VALUES ('88012224457', 1, 'Ramón Almarales Vitier', 22);

INSERT INTO persona (ci, idrol, nombre_completo, edad)
VALUES ('90060624457', 2, 'Ivette Rodríguez Piñeiero', 20);

INSERT INTO persona (ci, idrol, nombre_completo, edad)
VALUES ('91012224457', 14, 'Ivonne Catalá Benítez', 19);

INSERT INTO persona (ci, idrol, nombre_completo, edad)
VALUES ('90015624457', 6, 'Alfredo Mabardi Marchante', 20);

INSERT INTO persona (ci, idrol, nombre_completo, edad)
VALUES ('89012004457', 9, 'Jesús Matienzo González', 21);

INSERT INTO persona (ci, idrol, nombre_completo, edad)
VALUES ('90112224457', 8, 'Rainer Villar Bega', 19);

INSERT INTO persona (ci, idrol, nombre_completo, edad)
VALUES ('92012224457', 1, 'Orestes Rodríguez Farray', 18);

INSERT INTO persona (ci, idrol, nombre_completo, edad)
VALUES ('92100624457', 1, 'Orlando Lago Luaces', 17);

INSERT INTO persona (ci, idrol, nombre_completo, edad)
VALUES ('92051824457', 5, 'Orisel Pérez Arias', 18);

INSERT INTO persona (ci, idrol, nombre_completo, edad)
VALUES ('93051824457', 6, 'Osmel Sosa Figueredo', 17);

INSERT INTO persona (ci, idrol, nombre_completo, edad)
VALUES ('93030524457', 1, 'Osvaldo Roberto Ramírez Martínez', 17);

INSERT INTO persona (ci, idrol, nombre_completo, edad)
VALUES ('83030524457', 13, 'Onelio Capote Alvarado', 27);

INSERT INTO persona (ci, idrol, nombre_completo, edad)
VALUES ('83042324457', 14, 'Luis Domínguez Sosa', 27);

INSERT INTO persona (ci, idrol, nombre_completo, edad)
VALUES ('84030524457', 14, 'Berta Federica Nuñez', 28);

INSERT INTO persona (ci, idrol, nombre_completo, edad)
VALUES ('77123154786', 1, 'Abel Rojas Quintana', 32);

INSERT INTO estudiante (ci, promedio)
VALUES ('88060624457', 4.75);

INSERT INTO estudiante (ci, promedio)
VALUES ('88012224457', 3.56);

INSERT INTO estudiante (ci, promedio)
VALUES ('90060624457', 5);

INSERT INTO estudiante (ci, promedio)
VALUES ('90015624457', 4.35);

INSERT INTO estudiante (ci, promedio)
VALUES ('91012224457', 4.83);

INSERT INTO estudiante (ci, promedio)
VALUES ('89012004457', 4.4);

INSERT INTO estudiante (ci, promedio)
VALUES ('93030524457', 3.95);

INSERT INTO estudiante (ci, promedio)
VALUES ('93051824457', 3.86);

INSERT INTO estudiante (ci, promedio)
VALUES ('92051824457', 4.55);

INSERT INTO estudiante (ci, promedio)
VALUES ('92100624457', 4.67);

INSERT INTO estudiante (ci, promedio)
VALUES ('90112224457', 5.02);

INSERT INTO estudiante (ci, promedio)
VALUES ('92012224457', 4.57);

INSERT INTO descarga (iddescarga, cipersona, fecha, nombre_archivo, dirurl, megas_nec)
VALUES (4, '66123154786', '2010-05-05', 'open_office.exe', 'http://www.descargas_online.com/programas/open_office.html', 750);

INSERT INTO descarga (iddescarga, cipersona, fecha, nombre_archivo, dirurl, megas_nec)
VALUES (10, '88060624457', '2010-05-22', 'documento.doc', 'http://www.descargas_online.com/manuales/carpinteria.html', 100);

INSERT INTO descarga (iddescarga, cipersona, fecha, nombre_archivo, dirurl, megas_nec)
VALUES (11, '88012224457', '2010-05-16', 'imagenes.zip', 'http://www.fotos_famosas.com/animales/tigres.html', 50);

INSERT INTO descarga (iddescarga, cipersona, fecha, nombre_archivo, dirurl, megas_nec)
VALUES (14, '83030524457', '2010-05-03', 'analisis_software.pdf', 'http://www.descargas_online.com/manuales/analisis_software.html', 60);

INSERT INTO descarga (iddescarga, cipersona, fecha, nombre_archivo, dirurl, megas_nec)
VALUES (15, '83030524457', '2010-05-20', 'juegos_carta.exe', 'http://www.descargas_online.com/juegos/cartas.html', 100);

INSERT INTO descarga (iddescarga, cipersona, fecha, nombre_archivo, dirurl, megas_nec)
VALUES (16, '84030524457', '2010-05-22', 'papeles.doc', 'http://www.aulafacil.com/dibujo/clase1.html', 10);

INSERT INTO descarga (iddescarga, cipersona, fecha, nombre_archivo, dirurl, megas_nec)
VALUES (17, '84030524457', '2010-05-01', 'usuarios.png', 'http://www.uci.cu/usuarios_correo.html', 2);

INSERT INTO descarga (iddescarga, cipersona, fecha, nombre_archivo, dirurl, megas_nec)
VALUES (18, '91012224457', '2010-05-14', 'fichero.exe', 'http://www.descargas_online.com/ficherosejecutables/fichero.html', 254);

INSERT INTO descarga (iddescarga, cipersona, fecha, nombre_archivo, dirurl, megas_nec)
VALUES (5, '82023154786', '2010-05-02', 'apache.zip', 'http://www.descargas_online.com/programas/apache.html', 5);

INSERT INTO descarga (iddescarga, cipersona, fecha, nombre_archivo, dirurl, megas_nec)
VALUES (7, '82023154786', '2010-05-20', 'articulo.zip', 'http://www.gmail.com/cuenta01452/25.html', 3);

INSERT INTO descarga (iddescarga, cipersona, fecha, nombre_archivo, dirurl, megas_nec)
VALUES (19, '82023154786', '2010-05-16', 'fotos.zip', 'http://intranet.uci.cu/imagen.html', 0);

INSERT INTO descarga (iddescarga, cipersona, fecha, nombre_archivo, dirurl, megas_nec)
VALUES (21, '82023154786', '2010-05-16', 'fotos.zip', 'http://intranet.uci.cu/imagen.html', 5);

INSERT INTO descarga (iddescarga, cipersona, fecha, nombre_archivo, dirurl, megas_nec)
VALUES (6, '82023154786', '2010-05-24', 'fichero.doc', 'http://www.aulafacil.com/inglés/gramática.html', 5);

INSERT INTO descarga (iddescarga, cipersona, fecha, nombre_archivo, dirurl, megas_nec)
VALUES (22, '82023154786', '2010-05-16', 'fotos.zip', 'http://intranet.uci.cu/imagen.html', 5);

INSERT INTO descarga (iddescarga, cipersona, fecha, nombre_archivo, dirurl, megas_nec)
VALUES (8, '77103154786', '2010-05-04', 'fotos.rar', 'http://www.yahoo.es/558df6fdge/jud.html', 15);

INSERT INTO descarga (iddescarga, cipersona, fecha, nombre_archivo, dirurl, megas_nec)
VALUES (9, '77103154786', '2010-05-07', 'recetas_dulces.zip', 'http://www.descargas_online.com/manuales/analisis_software.html', 50);

INSERT INTO profesor (ci, dpto, titulo)
VALUES ('77123154786', 1, 'Ingeniero en Ciencias Informáticas');

INSERT INTO profesor (ci, dpto, titulo)
VALUES ('66123154786', 2, 'Ingeniero Industrial');

INSERT INTO profesor (ci, dpto, titulo)
VALUES ('82023154786', 3, 'Ingeniero en Ciencias Informáticas');

INSERT INTO profesor (ci, dpto, titulo)
VALUES ('77103154786', 1, 'Telecomunicaciones');

INSERT INTO profesor (ci, dpto, titulo)
VALUES ('71060624457', 1, 'Automática');

INSERT INTO profesor (ci, dpto, titulo)
VALUES ('72060634457', 3, 'Ingeniero en Ciencias Informáticas');

INSERT INTO profesor (ci, dpto, titulo)
VALUES ('75080624457', 3, 'Ingeniero en Ciencias Informáticas');

INSERT INTO profesor (ci, dpto, titulo)
VALUES ('83030524457', 3, 'Ingeniero en Ciencias Informáticas');

INSERT INTO profesor (ci, dpto, titulo)
VALUES ('83042324457', 2, 'Ingeniero Industrial');

INSERT INTO profesor (ci, dpto, titulo)
VALUES ('84030524457', 3, 'Ingeniero en Ciencias Informáticas');

CREATE INDEX rol_fkindex1 ON rol USING btree (idmegas);

CREATE INDEX ifk_rel_02 ON rol USING btree (idmegas);

CREATE INDEX persona_fkindex1 ON persona USING btree (idrol);

CREATE INDEX ifk_rel_01 ON persona USING btree (idrol);

CREATE INDEX estudiante_fkindex1 ON estudiante USING btree (ci);

CREATE INDEX ifk_rel_04 ON estudiante USING btree (ci);

CREATE INDEX descarga_fkindex1 ON descarga USING btree (cipersona);

CREATE INDEX ifk_rel_03 ON descarga USING btree (cipersona);

CREATE INDEX profesor_fkindex1 ON profesor USING btree (ci);

CREATE INDEX profesor_fkindex2 ON profesor USING btree (dpto);

CREATE INDEX ifk_rel_05 ON profesor USING btree (ci);

CREATE INDEX ifk_rel_07 ON profesor USING btree (dpto);

ALTER TABLE ONLY persona
    ADD CONSTRAINT persona_pkey PRIMARY KEY (ci);

ALTER TABLE ONLY estudiante
    ADD CONSTRAINT estudiante_pkey PRIMARY KEY (ci);

ALTER TABLE ONLY estudiante
    ADD CONSTRAINT estudiante_ci_fkey FOREIGN KEY (ci) REFERENCES persona(ci);

ALTER TABLE ONLY descarga
    ADD CONSTRAINT descarga_persona_fkey FOREIGN KEY (cipersona) REFERENCES persona(ci);

ALTER TABLE ONLY profesor
    ADD CONSTRAINT profesor_pkey PRIMARY KEY (ci);

ALTER TABLE ONLY profesor
    ADD CONSTRAINT profesor_ci_fkey FOREIGN KEY (ci) REFERENCES persona(ci);

ALTER TABLE ONLY megas
    ADD CONSTRAINT megas_pkey PRIMARY KEY (idmegas);

ALTER TABLE ONLY rol
    ADD CONSTRAINT rol_idmegas_fkey FOREIGN KEY (idmegas) REFERENCES megas(idmegas);

ALTER TABLE ONLY dpto
    ADD CONSTRAINT dpto_pkey PRIMARY KEY (iddpto);

ALTER TABLE ONLY profesor
    ADD CONSTRAINT profesor_dpto_fkey FOREIGN KEY (dpto) REFERENCES dpto(iddpto);

ALTER TABLE ONLY descarga
    ADD CONSTRAINT descarga_pkey PRIMARY KEY (iddescarga, cipersona);

ALTER TABLE ONLY descarga
    ADD CONSTRAINT descarga_iddescarga_key UNIQUE (iddescarga);

ALTER TABLE ONLY rol
    ADD CONSTRAINT rol_pkey PRIMARY KEY (idrol);

ALTER TABLE ONLY persona
    ADD CONSTRAINT persona_idrol_fkey FOREIGN KEY (idrol) REFERENCES rol(idrol);

SELECT pg_catalog.setval('megas_idmegas_seq', 7, true);

SELECT pg_catalog.setval('dpto_iddpto_seq', 3, true);

SELECT pg_catalog.setval('descarga_iddescarga_seq', 22, true);

SELECT pg_catalog.setval('rol_idrol_seq', 14, true);

COMMENT ON SCHEMA public IS 'standard public schema';
