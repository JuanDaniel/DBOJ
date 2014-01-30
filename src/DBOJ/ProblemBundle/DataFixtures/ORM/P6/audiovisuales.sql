SET check_function_bodies = false;

SET search_path = public, pg_catalog;
CREATE SEQUENCE public.sequence_id_cliente
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;

CREATE SEQUENCE public.sequence_id_recurso
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;

CREATE SEQUENCE public.sequence_id_editor
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;

CREATE TABLE public.solicitud (
    id_cliente integer NOT NULL,
    id_recurso integer NOT NULL,
    descripcion_material character varying(255),
    fecha_entrega date NOT NULL,
    id_editor integer
) WITHOUT OIDS;

CREATE TABLE public.audiovisual (
    id_media integer DEFAULT nextval(('"public"."audiovisual_id_media_seq"'::text)::regclass) NOT NULL,
    titulo character varying(255),
    fecha_creacion date,
    id_editor integer NOT NULL,
    duracion_min integer,
    "esVideo" boolean
) WITHOUT OIDS;

CREATE TABLE public.editor (
    id_editor integer DEFAULT nextval('sequence_id_editor'::regclass) NOT NULL,
    nombre_e character varying(255),
    apellido_e character varying(255),
    annos_experiencia integer
) WITHOUT OIDS;

CREATE TABLE public.recurso (
    id_recurso integer DEFAULT nextval('sequence_id_recurso'::regclass) NOT NULL,
    descripcion character varying(255)
) WITHOUT OIDS;

CREATE TABLE public.cliente (
    ci_cliente integer DEFAULT nextval('sequence_id_cliente'::regclass) NOT NULL,
    nombre_c character varying(255),
    apellido_c character varying(255),
    provincia_procedencia character varying(255)
) WITHOUT OIDS;

CREATE SEQUENCE public.audiovisual_id_media_seq
    START WITH 1
    INCREMENT BY 1
    MAXVALUE 2147483647
    NO MINVALUE
    CACHE 1;

INSERT INTO solicitud (id_cliente, id_recurso, descripcion_material, fecha_entrega, id_editor)
VALUES (17, 3, 'Noticiero deportivo', '2007-08-04', 1);

INSERT INTO solicitud (id_cliente, id_recurso, descripcion_material, fecha_entrega, id_editor)
VALUES (5, 4, 'Resumen de los efectos del alcohol', '2009-10-08', 4);

INSERT INTO solicitud (id_cliente, id_recurso, descripcion_material, fecha_entrega, id_editor)
VALUES (2, 1, 'Noticiero del mediodía', '2010-05-21', 3);

INSERT INTO solicitud (id_cliente, id_recurso, descripcion_material, fecha_entrega, id_editor)
VALUES (17, 2, 'Material para el dia 26 de julio', '2009-07-19', 3);

INSERT INTO solicitud (id_cliente, id_recurso, descripcion_material, fecha_entrega, id_editor)
VALUES (13, 1, 'Felicidades por el cumpleaños 81 del Comandante', '2010-07-31', 1);

INSERT INTO solicitud (id_cliente, id_recurso, descripcion_material, fecha_entrega, id_editor)
VALUES (6, 2, 'Feria de productos informáticos', '2010-03-10', 2);

INSERT INTO solicitud (id_cliente, id_recurso, descripcion_material, fecha_entrega, id_editor)
VALUES (1, 6, 'Material sobre droga', '2010-05-13', 5);

INSERT INTO solicitud (id_cliente, id_recurso, descripcion_material, fecha_entrega, id_editor)
VALUES (4, 3, 'Material para tesis de maestría', '2009-06-24', 1);

INSERT INTO solicitud (id_cliente, id_recurso, descripcion_material, fecha_entrega, id_editor)
VALUES (4, 1, 'Día mundial contra el SIDA', '2007-09-15', 1);

INSERT INTO solicitud (id_cliente, id_recurso, descripcion_material, fecha_entrega, id_editor)
VALUES (7, 2, 'Material del 1ro de mayo', '2008-05-19', 1);

INSERT INTO solicitud (id_cliente, id_recurso, descripcion_material, fecha_entrega, id_editor)
VALUES (9, 1, 'Resumen noticioso semanal', '2008-08-02', 1);

INSERT INTO solicitud (id_cliente, id_recurso, descripcion_material, fecha_entrega, id_editor)
VALUES (18, 1, 'Visita del presidente chino', '2009-10-07', 3);

INSERT INTO solicitud (id_cliente, id_recurso, descripcion_material, fecha_entrega, id_editor)
VALUES (18, 6, 'Material de apoyo a la lucha contra el SIDA', '2010-05-31', 3);

INSERT INTO solicitud (id_cliente, id_recurso, descripcion_material, fecha_entrega, id_editor)
VALUES (18, 4, 'Conferencia de BD', '2008-05-29', 3);

INSERT INTO solicitud (id_cliente, id_recurso, descripcion_material, fecha_entrega, id_editor)
VALUES (18, 5, 'Reunión de la UJC', '2009-08-02', 1);

INSERT INTO audiovisual (id_media, titulo, fecha_creacion, id_editor, duracion_min, "esVideo")
VALUES (5, 'Cese el genocidio contra Cuba', '2009-04-18', 1, 14, false);

INSERT INTO audiovisual (id_media, titulo, fecha_creacion, id_editor, duracion_min, "esVideo")
VALUES (2, 'Liberen a los 5', '2009-02-03', 2, 10, false);

INSERT INTO audiovisual (id_media, titulo, fecha_creacion, id_editor, duracion_min, "esVideo")
VALUES (1, 'Primicia plataforma de televisión informativa', '2010-05-14', 1, 3, true);

INSERT INTO audiovisual (id_media, titulo, fecha_creacion, id_editor, duracion_min, "esVideo")
VALUES (3, 'Revolución', '2010-05-14', 1, 20, true);

INSERT INTO audiovisual (id_media, titulo, fecha_creacion, id_editor, duracion_min, "esVideo")
VALUES (4, 'La conquista del paraíso ', '2010-05-16', 1, 5, false);

INSERT INTO audiovisual (id_media, titulo, fecha_creacion, id_editor, duracion_min, "esVideo")
VALUES (6, 'Girón', '2009-04-03', 2, 15, false);

INSERT INTO audiovisual (id_media, titulo, fecha_creacion, id_editor, duracion_min, "esVideo")
VALUES (7, 'Ahora sí', '2009-01-08', 1, 23, true);

INSERT INTO audiovisual (id_media, titulo, fecha_creacion, id_editor, duracion_min, "esVideo")
VALUES (8, 'Somatón de proyectos Fac 9', '2009-09-24', 4, 65, true);

INSERT INTO audiovisual (id_media, titulo, fecha_creacion, id_editor, duracion_min, "esVideo")
VALUES (9, 'Somatón de proyectos Fac 7', '2010-05-19', 4, 57, true);

INSERT INTO audiovisual (id_media, titulo, fecha_creacion, id_editor, duracion_min, "esVideo")
VALUES (11, 'Conferencia de Matemática 3, 1ra parte', '2009-07-16', 4, 35, true);

INSERT INTO audiovisual (id_media, titulo, fecha_creacion, id_editor, duracion_min, "esVideo")
VALUES (12, 'Conferencia de Matemática 3, 2da parte', '2010-10-01', 4, 32, true);

INSERT INTO audiovisual (id_media, titulo, fecha_creacion, id_editor, duracion_min, "esVideo")
VALUES (10, 'VideoWeb, un nuevo inter-nos', '2010-05-30', 4, 3, true);

INSERT INTO editor (id_editor, nombre_e, apellido_e, annos_experiencia)
VALUES (4, 'Ariadna', 'Portal', 1);

INSERT INTO editor (id_editor, nombre_e, apellido_e, annos_experiencia)
VALUES (2, 'Julian', 'Águila', 5);

INSERT INTO editor (id_editor, nombre_e, apellido_e, annos_experiencia)
VALUES (3, 'Yunior', 'Véliz', 3);

INSERT INTO editor (id_editor, nombre_e, apellido_e, annos_experiencia)
VALUES (5, 'Débora', 'Santos', 3);

INSERT INTO editor (id_editor, nombre_e, apellido_e, annos_experiencia)
VALUES (6, 'Yamilé', 'Gómez', 3);

INSERT INTO editor (id_editor, nombre_e, apellido_e, annos_experiencia)
VALUES (1, 'Katia', 'Yero', 23);

INSERT INTO recurso (id_recurso, descripcion)
VALUES (1, 'Guión');

INSERT INTO recurso (id_recurso, descripcion)
VALUES (2, 'Spot');

INSERT INTO recurso (id_recurso, descripcion)
VALUES (3, 'Documental');

INSERT INTO recurso (id_recurso, descripcion)
VALUES (4, 'Página_web');

INSERT INTO recurso (id_recurso, descripcion)
VALUES (5, 'Artículo');

INSERT INTO recurso (id_recurso, descripcion)
VALUES (6, 'Llibro');

INSERT INTO recurso (id_recurso, descripcion)
VALUES (7, 'Foto');

INSERT INTO cliente (ci_cliente, nombre_c, apellido_c, provincia_procedencia)
VALUES (3, 'Gilberto', 'Scull', 'VC');

INSERT INTO cliente (ci_cliente, nombre_c, apellido_c, provincia_procedencia)
VALUES (4, 'Roberto', 'Batista', 'CH');

INSERT INTO cliente (ci_cliente, nombre_c, apellido_c, provincia_procedencia)
VALUES (8, 'Joan', 'Cruz', 'VC');

INSERT INTO cliente (ci_cliente, nombre_c, apellido_c, provincia_procedencia)
VALUES (9, 'Gisell', 'Marrero', 'CH');

INSERT INTO cliente (ci_cliente, nombre_c, apellido_c, provincia_procedencia)
VALUES (18, 'Juan', 'Quevedo', 'MTZ');

INSERT INTO cliente (ci_cliente, nombre_c, apellido_c, provincia_procedencia)
VALUES (20, 'Yoania', 'Figueroa', 'SS');

INSERT INTO cliente (ci_cliente, nombre_c, apellido_c, provincia_procedencia)
VALUES (17, 'Silverio', 'Espinosa', 'CH');

INSERT INTO cliente (ci_cliente, nombre_c, apellido_c, provincia_procedencia)
VALUES (1, 'Julio', 'Menéndez', 'HOL');

INSERT INTO cliente (ci_cliente, nombre_c, apellido_c, provincia_procedencia)
VALUES (2, 'Norberto', 'Pérez', 'HOL');

INSERT INTO cliente (ci_cliente, nombre_c, apellido_c, provincia_procedencia)
VALUES (5, 'Alexander', 'Báez', 'HAB');

INSERT INTO cliente (ci_cliente, nombre_c, apellido_c, provincia_procedencia)
VALUES (6, 'Juan', 'Díaz', 'CH');

INSERT INTO cliente (ci_cliente, nombre_c, apellido_c, provincia_procedencia)
VALUES (7, 'Evelio', 'Díaz', 'CMG');

INSERT INTO cliente (ci_cliente, nombre_c, apellido_c, provincia_procedencia)
VALUES (10, 'Claudia', 'Morán', 'CMG');

INSERT INTO cliente (ci_cliente, nombre_c, apellido_c, provincia_procedencia)
VALUES (11, 'José', 'Martínez', 'CFG');

INSERT INTO cliente (ci_cliente, nombre_c, apellido_c, provincia_procedencia)
VALUES (12, 'María', 'Gutiérrez', 'CFG');

INSERT INTO cliente (ci_cliente, nombre_c, apellido_c, provincia_procedencia)
VALUES (13, 'José', 'Núñez', 'STG');

INSERT INTO cliente (ci_cliente, nombre_c, apellido_c, provincia_procedencia)
VALUES (14, 'Orestes', 'Hernández', 'CH');

INSERT INTO cliente (ci_cliente, nombre_c, apellido_c, provincia_procedencia)
VALUES (15, 'Julio', 'Pérez', 'PR');

INSERT INTO cliente (ci_cliente, nombre_c, apellido_c, provincia_procedencia)
VALUES (16, 'Rogelio', 'Suárez', 'PR');

INSERT INTO cliente (ci_cliente, nombre_c, apellido_c, provincia_procedencia)
VALUES (19, 'Kirenia', 'Sánchez', 'LTU');

ALTER TABLE ONLY solicitud
    ADD CONSTRAINT solicitud_pkey PRIMARY KEY (id_cliente, id_recurso);

ALTER TABLE ONLY editor
    ADD CONSTRAINT editor_pkey PRIMARY KEY (id_editor);

ALTER TABLE ONLY recurso
    ADD CONSTRAINT recurso_pkey PRIMARY KEY (id_recurso);

ALTER TABLE ONLY cliente
    ADD CONSTRAINT cliente_pkey PRIMARY KEY (ci_cliente);

ALTER TABLE ONLY audiovisual
    ADD CONSTRAINT fkmedia891497 FOREIGN KEY (id_editor) REFERENCES editor(id_editor);

ALTER TABLE ONLY solicitud
    ADD CONSTRAINT fksolicitud108842 FOREIGN KEY (id_editor) REFERENCES editor(id_editor);

ALTER TABLE ONLY solicitud
    ADD CONSTRAINT fksolicitud588302 FOREIGN KEY (id_cliente) REFERENCES cliente(ci_cliente);

ALTER TABLE ONLY solicitud
    ADD CONSTRAINT fksolicitud680101 FOREIGN KEY (id_recurso) REFERENCES recurso(id_recurso);

ALTER TABLE ONLY audiovisual
    ADD CONSTRAINT media_pkey PRIMARY KEY (id_media);

SELECT pg_catalog.setval('sequence_id_cliente', 20, true);

SELECT pg_catalog.setval('sequence_id_recurso', 10, true);

SELECT pg_catalog.setval('sequence_id_editor', 8, true);

SELECT pg_catalog.setval('audiovisual_id_media_seq', 1, false);

COMMENT ON SCHEMA public IS 'Standard public schema';
