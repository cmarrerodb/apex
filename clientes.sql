--
-- PostgreSQL database dump
--

-- Dumped from database version 12.5
-- Dumped by pg_dump version 12.5

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Data for Name: clientes; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.clientes (id, nombre, rut, fecha_nacimiento, telefono, direccion, comuna_id, categoria_id, numero_tarjeta, email, empresa, hotel, vino_favorito_1, vino_favorito_2, vino_favorito_3, foto, referencia, info_vina, club, deleted_at, created_at, updated_at, tipo_id) VALUES (6, 'Andrea Rangel Delao', '33577955', '2013-04-05', '427-8601550', 'Carretera Olivia Loera, Casa 38, Puerto Onadel Valle Edo. Sucre', 23, 1, '4103', 'barrientos.juan@guevara.org', 'Centro Miramontes y Ayala', 'Global Gayt├ín', 'Ea dolores explicabo.', 'Delectus nam eum.', 'Occaecati esse.', '5.jpg', 'Maxime quibusdam sint necessitatibus ut officiis inventore non.', 2, 7, NULL, '2023-03-23 19:27:39', NULL, 14);
INSERT INTO public.clientes (id, nombre, rut, fecha_nacimiento, telefono, direccion, comuna_id, categoria_id, numero_tarjeta, email, empresa, hotel, vino_favorito_1, vino_favorito_2, vino_favorito_3, foto, referencia, info_vina, club, deleted_at, created_at, updated_at, tipo_id) VALUES (7, 'Marti Gayt├ín Chavarr├¡a', '87813037', '1994-06-22', '+58 241 3247975', 'Av. Carmen, Hab. 53, Lim├│n de Mata Edo. Carabobo', 1, 5, '7890', 'irenteria@beltran.net', 'Vera de Correa S.R.L.', 'Lomeli de Ram├│n', 'Nisi dolore.', 'Ut autem.', 'Autem soluta unde.', '12.jpg', 'Ut voluptatibus et eos sint molestiae quibusdam.', 5, 4, NULL, '2023-03-23 19:27:39', NULL, 13);
INSERT INTO public.clientes (id, nombre, rut, fecha_nacimiento, telefono, direccion, comuna_id, categoria_id, numero_tarjeta, email, empresa, hotel, vino_favorito_1, vino_favorito_2, vino_favorito_3, foto, referencia, info_vina, club, deleted_at, created_at, updated_at, tipo_id) VALUES (8, 'Valentina Blanco Hijo', '75477022', '1988-12-25', '+58 474-638-1704', 'Av. Mohamed, Apto 73, B├®tancourt del Valle Edo. Monagas, 7120', 42, 2, '6413', 'vera69@armijo.net', 'Sevilla y Cas├írez', 'J├íquez y Collazo', 'Corrupti ut quasi.', 'Illo hic.', 'Rem nulla harum.', '5.jpg', 'Consectetur aliquid praesentium iure nobis.', 2, 2, NULL, '2023-03-23 19:27:39', NULL, 3);
INSERT INTO public.clientes (id, nombre, rut, fecha_nacimiento, telefono, direccion, comuna_id, categoria_id, numero_tarjeta, email, empresa, hotel, vino_favorito_1, vino_favorito_2, vino_favorito_3, foto, referencia, info_vina, club, deleted_at, created_at, updated_at, tipo_id) VALUES (9, 'Rafael Nieto Hijo', '10068665', '1977-03-12', '200 690 2744', 'Callej├│n Becerra, 15, Casa 97, Puerto Jaimede Asis Edo. Lara, 2025', 3, 4, '7664', 'abril94@live.com', 'Lucio y Llamas R.L.', '├üguilar de V├®lez', 'Omnis nam qui.', 'Neque dolor.', 'In quia quam.', '10.jpg', 'Dolores et voluptas aut cum numquam quia.', 3, 6, NULL, '2023-03-23 19:27:39', NULL, 7);
INSERT INTO public.clientes (id, nombre, rut, fecha_nacimiento, telefono, direccion, comuna_id, categoria_id, numero_tarjeta, email, empresa, hotel, vino_favorito_1, vino_favorito_2, vino_favorito_3, foto, referencia, info_vina, club, deleted_at, created_at, updated_at, tipo_id) VALUES (10, 'Ing. Ismael Llorente Hijo', '84227384', '1982-11-27', '+58 4126338679', 'Cl. Hector S├ínchez, Piso 0, Valle Francisco Javier Edo. Bol├¡var', 48, 4, '6369', 'jaime84@latinmail.com', 'Gurule de Casado', 'Cooperativa Luque y Mungu├¡a', 'Voluptate sed et.', 'Accusantium debitis voluptatum.', 'Amet ea.', '1.jpg', 'Quis nobis voluptatibus enim aspernatur amet cumque fuga.', 4, 7, NULL, '2023-03-23 19:27:39', NULL, 3);
INSERT INTO public.clientes (id, nombre, rut, fecha_nacimiento, telefono, direccion, comuna_id, categoria_id, numero_tarjeta, email, empresa, hotel, vino_favorito_1, vino_favorito_2, vino_favorito_3, foto, referencia, info_vina, club, deleted_at, created_at, updated_at, tipo_id) VALUES (11, 'Luna Caraballo Torres', '62114179', '2010-08-23', '+58 435-857-9234', 'Cl. Armijo, Piso 1, Silva de Mata Edo. Barinas', 7, 3, '1713', 'daniel.dominguez@ponce.net', 'Rosa de Rosas', 'Corporaci├│n Barajas y T├│rrez', 'Quis aspernatur.', 'Quo commodi.', 'Dolor voluptates nam.', '4.jpg', 'Ut in et incidunt autem maiores ipsam.', 2, 7, NULL, '2023-03-23 19:27:39', NULL, 2);
INSERT INTO public.clientes (id, nombre, rut, fecha_nacimiento, telefono, direccion, comuna_id, categoria_id, numero_tarjeta, email, empresa, hotel, vino_favorito_1, vino_favorito_2, vino_favorito_3, foto, referencia, info_vina, club, deleted_at, created_at, updated_at, tipo_id) VALUES (12, 'Sra. Africa Ju├írez', '76257251', '2000-07-04', '+58 225 915 6011', 'Cl. Rodrigo Aguado, 447, Nro 34, Sancho de Mata Edo. Anzo├ítegui, 9647', 24, 2, '2028', 'daniela.molina@sanabria.com.ve', 'Empresa Sanz y Hernando', 'Zaragoza de Covarrubias', 'Laboriosam culpa dolores.', 'Quasi aliquam ut.', 'Quo et.', '4.jpg', 'Et quibusdam quidem consectetur distinctio.', 1, 1, NULL, '2023-03-23 19:27:39', NULL, 11);
INSERT INTO public.clientes (id, nombre, rut, fecha_nacimiento, telefono, direccion, comuna_id, categoria_id, numero_tarjeta, email, empresa, hotel, vino_favorito_1, vino_favorito_2, vino_favorito_3, foto, referencia, info_vina, club, deleted_at, created_at, updated_at, tipo_id) VALUES (13, 'Ing. Alonso Cortez', '57405061', '2018-05-10', '+58 2023634522', 'Vereda Pedro, Casa 30, Montes del Valle Edo. Monagas', 2, 5, '4259', 'pvera@posada.org', 'Empresa Delgado y Canales', 'Calder├│n de Lucas', 'Culpa non.', 'Occaecati voluptatem.', 'Nulla qui in.', '8.jpg', 'Aut maxime numquam laboriosam aliquam odio qui pariatur.', 2, 6, NULL, '2023-03-23 19:27:39', NULL, 17);
INSERT INTO public.clientes (id, nombre, rut, fecha_nacimiento, telefono, direccion, comuna_id, categoria_id, numero_tarjeta, email, empresa, hotel, vino_favorito_1, vino_favorito_2, vino_favorito_3, foto, referencia, info_vina, club, deleted_at, created_at, updated_at, tipo_id) VALUES (5, 'Gabriela Garrido', '54210954', '2001-08-02', '412 3968906', 'Cl. Verdugo, 419, Piso 1, Pedro de Altagracia Edo. Miranda', 13, 6, '2982', 'noelia.angulo@badillo.web.ve', 'Viajes Montes S.A.', 'Empresa Colunga etc', 'Voluptatem corrupti.', 'Error est et.', 'Dolore amet aut.', '10.jpg', 'Non sint nam consequatur.', 5, 3, '2023-03-23 19:33:00', '2023-03-23 19:27:39', NULL, 3);
INSERT INTO public.clientes (id, nombre, rut, fecha_nacimiento, telefono, direccion, comuna_id, categoria_id, numero_tarjeta, email, empresa, hotel, vino_favorito_1, vino_favorito_2, vino_favorito_3, foto, referencia, info_vina, club, deleted_at, created_at, updated_at, tipo_id) VALUES (14, 'sdfsdf', 'sdfds', '2023-03-15', 'sdfsdf', 'sdfsdfsdf', NULL, NULL, NULL, 'sdfsdf', 'sdfsdfsd', 'sdfsdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-24 05:15:57', '2023-03-24 05:15:57', NULL);
INSERT INTO public.clientes (id, nombre, rut, fecha_nacimiento, telefono, direccion, comuna_id, categoria_id, numero_tarjeta, email, empresa, hotel, vino_favorito_1, vino_favorito_2, vino_favorito_3, foto, referencia, info_vina, club, deleted_at, created_at, updated_at, tipo_id) VALUES (15, 'sdfsdf', 'sdfds', '2023-03-15', 'sdfsdf', 'sdfsdfsdf', NULL, NULL, NULL, 'sdfsdf', 'sdfsdfsd', 'sdfsdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-24 05:18:16', '2023-03-24 05:18:16', NULL);
INSERT INTO public.clientes (id, nombre, rut, fecha_nacimiento, telefono, direccion, comuna_id, categoria_id, numero_tarjeta, email, empresa, hotel, vino_favorito_1, vino_favorito_2, vino_favorito_3, foto, referencia, info_vina, club, deleted_at, created_at, updated_at, tipo_id) VALUES (16, 'kkkkkkkkkk', 'sdfds', '2023-03-15', 'sdfsdf', 'sdfsdfsdf', NULL, NULL, NULL, 'sdfsdf', 'sdfsdfsd', 'sdfsdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-24 05:24:18', '2023-03-24 05:24:18', NULL);


--
-- Name: clientes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.clientes_id_seq', 16, true);


--
-- PostgreSQL database dump complete
--

