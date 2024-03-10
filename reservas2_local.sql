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
-- Name: hstore; Type: EXTENSION; Schema: -; Owner: -
--

CREATE EXTENSION IF NOT EXISTS hstore WITH SCHEMA public;


--
-- Name: EXTENSION hstore; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION hstore IS 'data type for storing sets of (key, value) pairs';


SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: cli_categoria_clientes; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cli_categoria_clientes (
    id bigint NOT NULL,
    categoria character varying(50) NOT NULL,
    monto integer NOT NULL,
    deleted_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.cli_categoria_clientes OWNER TO postgres;

--
-- Name: cli_categoria_clientes_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.cli_categoria_clientes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cli_categoria_clientes_id_seq OWNER TO postgres;

--
-- Name: cli_categoria_clientes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.cli_categoria_clientes_id_seq OWNED BY public.cli_categoria_clientes.id;


--
-- Name: cli_cliente_categoria; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cli_cliente_categoria (
    id bigint NOT NULL,
    categoria_id integer NOT NULL,
    cliente_id integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone
);


ALTER TABLE public.cli_cliente_categoria OWNER TO postgres;

--
-- Name: cli_cliente_categoria_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.cli_cliente_categoria_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cli_cliente_categoria_id_seq OWNER TO postgres;

--
-- Name: cli_cliente_categoria_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.cli_cliente_categoria_id_seq OWNED BY public.cli_cliente_categoria.id;


--
-- Name: cli_comunas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cli_comunas (
    id bigint NOT NULL,
    comuna character varying(50) NOT NULL,
    deleted_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.cli_comunas OWNER TO postgres;

--
-- Name: cli_comunas_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.cli_comunas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cli_comunas_id_seq OWNER TO postgres;

--
-- Name: cli_comunas_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.cli_comunas_id_seq OWNED BY public.cli_comunas.id;


--
-- Name: cli_premios; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cli_premios (
    id bigint NOT NULL,
    categoria_id integer NOT NULL,
    premio character varying(75) NOT NULL,
    usuario_id integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone
);


ALTER TABLE public.cli_premios OWNER TO postgres;

--
-- Name: cli_premios_clientes; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cli_premios_clientes (
    id bigint NOT NULL,
    cliente_id integer NOT NULL,
    categoria_id integer NOT NULL,
    premio_id integer NOT NULL,
    estado_entrega smallint NOT NULL,
    usuario_id integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone
);


ALTER TABLE public.cli_premios_clientes OWNER TO postgres;

--
-- Name: cli_premios_clientes_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.cli_premios_clientes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cli_premios_clientes_id_seq OWNER TO postgres;

--
-- Name: cli_premios_clientes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.cli_premios_clientes_id_seq OWNED BY public.cli_premios_clientes.id;


--
-- Name: cli_premios_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.cli_premios_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cli_premios_id_seq OWNER TO postgres;

--
-- Name: cli_premios_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.cli_premios_id_seq OWNED BY public.cli_premios.id;


--
-- Name: cli_tipos_clientes; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cli_tipos_clientes (
    id bigint NOT NULL,
    tipo character varying(50) NOT NULL,
    deleted_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.cli_tipos_clientes OWNER TO postgres;

--
-- Name: cli_tipos_clientes_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.cli_tipos_clientes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cli_tipos_clientes_id_seq OWNER TO postgres;

--
-- Name: cli_tipos_clientes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.cli_tipos_clientes_id_seq OWNED BY public.cli_tipos_clientes.id;


--
-- Name: clientes; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.clientes (
    id bigint NOT NULL,
    nombre character varying(100) NOT NULL,
    rut character varying(12),
    fecha_nacimiento date,
    telefono character varying(30) NOT NULL,
    "dirección" text,
    comuna_id integer,
    categoria_id integer,
    numero_tarjeta character varying(8),
    email character varying(50) NOT NULL,
    empresa character varying(50),
    hotel character varying(50),
    vino_favorito_1 character varying(50),
    vino_favorito_2 character varying(50),
    vino_favorito_3 character varying(50),
    foto character varying(150),
    referencia text,
    info_vina smallint,
    club smallint,
    deleted_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone DEFAULT now(),
    updated_at timestamp(0) without time zone,
    tipo_id integer
);


ALTER TABLE public.clientes OWNER TO postgres;

--
-- Name: clientes_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.clientes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.clientes_id_seq OWNER TO postgres;

--
-- Name: clientes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.clientes_id_seq OWNED BY public.clientes.id;


--
-- Name: estados_reservas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.estados_reservas (
    id integer NOT NULL,
    estado character varying(50) NOT NULL,
    deleted_at timestamp(0) without time zone
);


ALTER TABLE public.estados_reservas OWNER TO postgres;

--
-- Name: estados_reservas_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.estados_reservas_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.estados_reservas_id_seq OWNER TO postgres;

--
-- Name: estados_reservas_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.estados_reservas_id_seq OWNED BY public.estados_reservas.id;


--
-- Name: failed_jobs; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.failed_jobs (
    id bigint NOT NULL,
    uuid character varying(191) NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);


ALTER TABLE public.failed_jobs OWNER TO postgres;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.failed_jobs_id_seq OWNER TO postgres;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;


--
-- Name: migrations; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(191) NOT NULL,
    batch integer NOT NULL
);


ALTER TABLE public.migrations OWNER TO postgres;

--
-- Name: migrations_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.migrations_id_seq OWNER TO postgres;

--
-- Name: migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;


--
-- Name: password_resets; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.password_resets (
    email character varying(191) NOT NULL,
    token character varying(191) NOT NULL,
    created_at timestamp(0) without time zone
);


ALTER TABLE public.password_resets OWNER TO postgres;

--
-- Name: personal_access_tokens; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.personal_access_tokens (
    id bigint NOT NULL,
    tokenable_type character varying(191) NOT NULL,
    tokenable_id bigint NOT NULL,
    name character varying(191) NOT NULL,
    token character varying(64) NOT NULL,
    abilities text,
    last_used_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.personal_access_tokens OWNER TO postgres;

--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.personal_access_tokens_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.personal_access_tokens_id_seq OWNER TO postgres;

--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.personal_access_tokens_id_seq OWNED BY public.personal_access_tokens.id;


--
-- Name: res_estados_reservas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.res_estados_reservas (
    id bigint NOT NULL,
    estado character varying(50) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone
);


ALTER TABLE public.res_estados_reservas OWNER TO postgres;

--
-- Name: res_estados_reservas_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.res_estados_reservas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.res_estados_reservas_id_seq OWNER TO postgres;

--
-- Name: res_estados_reservas_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.res_estados_reservas_id_seq OWNED BY public.res_estados_reservas.id;


--
-- Name: res_mesas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.res_mesas (
    id bigint NOT NULL,
    mesa integer NOT NULL,
    sucursal_id integer NOT NULL,
    salon_id integer NOT NULL,
    capacidad integer NOT NULL,
    deleted_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.res_mesas OWNER TO postgres;

--
-- Name: res_mesas_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.res_mesas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.res_mesas_id_seq OWNER TO postgres;

--
-- Name: res_mesas_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.res_mesas_id_seq OWNED BY public.res_mesas.id;


--
-- Name: res_salones; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.res_salones (
    id bigint NOT NULL,
    salon character varying(150) NOT NULL,
    sucursal_id integer NOT NULL,
    deleted_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.res_salones OWNER TO postgres;

--
-- Name: res_salones_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.res_salones_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.res_salones_id_seq OWNER TO postgres;

--
-- Name: res_salones_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.res_salones_id_seq OWNED BY public.res_salones.id;


--
-- Name: res_sucursales; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.res_sucursales (
    id bigint NOT NULL,
    sucursal character varying(150) NOT NULL,
    calendario integer NOT NULL,
    fecha_inicio_calendario date NOT NULL,
    fecha_fin_calendario date NOT NULL,
    deleted_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.res_sucursales OWNER TO postgres;

--
-- Name: res_sucursales_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.res_sucursales_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.res_sucursales_id_seq OWNER TO postgres;

--
-- Name: res_sucursales_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.res_sucursales_id_seq OWNED BY public.res_sucursales.id;


--
-- Name: res_tipo_reservas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.res_tipo_reservas (
    id bigint NOT NULL,
    tipo character varying(50) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone
);


ALTER TABLE public.res_tipo_reservas OWNER TO postgres;

--
-- Name: res_tipo_reservas_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.res_tipo_reservas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.res_tipo_reservas_id_seq OWNER TO postgres;

--
-- Name: res_tipo_reservas_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.res_tipo_reservas_id_seq OWNED BY public.res_tipo_reservas.id;


--
-- Name: reservas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.reservas (
    id integer NOT NULL,
    fecha_reserva date NOT NULL,
    razon_cancelacion integer,
    observacion_cancelacion text,
    hora_reserva time without time zone NOT NULL,
    nombre_cliente character varying(100) NOT NULL,
    nombre_empresa character varying(100),
    fecha_ultima_modificacion timestamp without time zone,
    usuario_ultima_modificacion integer,
    nombre_hotel character varying(100),
    cantidad_pasajeros integer NOT NULL,
    telefono_cliente character varying(50),
    tipo_reserva integer NOT NULL,
    email_cliente character varying(150),
    salon integer,
    mesa integer NOT NULL,
    estado integer NOT NULL,
    observaciones text,
    usuario_registro integer NOT NULL,
    clave_usuario character varying(10) NOT NULL,
    sucursal integer NOT NULL,
    dianoche smallint DEFAULT 1 NOT NULL,
    archivo_1 character varying(150),
    archivo_2 character varying(150),
    archivo_3 character varying(150),
    archivo_4 character varying(150),
    archivo_5 character varying(150),
    cliente_id integer,
    evento_nombre_adicional character varying(50),
    evento_pax character varying(20),
    evento_valor_menu character varying(20),
    evento_total_sin_propina character varying(20),
    evento_total_propina character varying(20),
    evento_email_contacto character varying(150),
    evento_telefono_contacto character varying(50),
    evento_anticipo character varying(20),
    evento_paga_en_local smallint,
    evento_audio smallint,
    evento_video smallint,
    evento_video_audio smallint,
    evento_restriccion_alimenticia smallint,
    evento_ubicacion character varying(250),
    evento_monta character varying(250),
    evento_detalle_restriccion text,
    ambiente character varying(150),
    usuario_confirmacion integer,
    usuario_rechazo integer,
    fecha_confirmacion timestamp without time zone,
    fecha_rechazo timestamp without time zone,
    razon_rechazo text,
    evento_comentarios text,
    evento_nombre_contacto character varying(100),
    evento_idioma character varying(50),
    evento_cristaleria character varying(50),
    evento_decoracion text,
    evento_mesa_soporte_adicional smallint,
    evento_extra_permitido smallint,
    evento_menu_impreso smallint,
    evento_table_tent smallint,
    evento_logo character varying(150),
    created_at timestamp without time zone,
    updated_at timestamp without time zone,
    deleted_at timestamp without time zone
);


ALTER TABLE public.reservas OWNER TO postgres;

--
-- Name: reservas_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.reservas_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.reservas_id_seq OWNER TO postgres;

--
-- Name: reservas_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.reservas_id_seq OWNED BY public.reservas.id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    id bigint NOT NULL,
    name character varying(191) NOT NULL,
    email character varying(191) NOT NULL,
    email_verified_at timestamp(0) without time zone,
    password character varying(191) NOT NULL,
    avatar text NOT NULL,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.users OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.users_id_seq OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- Name: vclientes; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.vclientes AS
 SELECT a.id,
    a.nombre,
    a.rut,
    a.fecha_nacimiento,
    a.telefono,
    a."dirección" AS direccion,
    a.comuna_id,
    b.comuna,
    a.categoria_id,
    c.categoria,
    a.tipo_id,
    d.tipo,
    a.numero_tarjeta,
    a.email,
    a.empresa,
    a.hotel,
    a.vino_favorito_1,
    a.vino_favorito_2,
    a.vino_favorito_3,
    a.foto,
    a.referencia,
    a.info_vina,
    a.club,
    a.created_at,
    a.updated_at
   FROM (((public.clientes a
     LEFT JOIN public.cli_comunas b ON ((b.id = a.comuna_id)))
     LEFT JOIN public.cli_categoria_clientes c ON ((c.id = a.categoria_id)))
     LEFT JOIN public.cli_tipos_clientes d ON ((d.id = a.tipo_id)))
  WHERE (a.deleted_at IS NULL)
  ORDER BY a.id;


ALTER TABLE public.vclientes OWNER TO postgres;

--
-- Name: vclientes_todos; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.vclientes_todos AS
 SELECT a.id,
    a.nombre,
    a.rut,
    a.fecha_nacimiento,
    a.telefono,
    a."dirección" AS direccion,
    a.comuna_id,
    b.comuna,
    a.categoria_id,
    c.categoria,
    a.tipo_id,
    d.tipo,
    a.numero_tarjeta,
    a.email,
    a.empresa,
    a.hotel,
    a.vino_favorito_1,
    a.vino_favorito_2,
    a.vino_favorito_3,
    a.foto,
    a.referencia,
    a.info_vina,
    a.club,
        CASE
            WHEN (a.deleted_at IS NULL) THEN 0
            ELSE 1
        END AS id_eliminado,
        CASE
            WHEN (a.deleted_at IS NULL) THEN 'NO'::text
            ELSE 'SI'::text
        END AS eliminado,
    a.deleted_at,
    a.created_at,
    a.updated_at
   FROM (((public.clientes a
     LEFT JOIN public.cli_comunas b ON ((b.id = a.comuna_id)))
     LEFT JOIN public.cli_categoria_clientes c ON ((c.id = a.categoria_id)))
     LEFT JOIN public.cli_tipos_clientes d ON ((d.id = a.tipo_id)))
  ORDER BY a.id;


ALTER TABLE public.vclientes_todos OWNER TO postgres;

--
-- Name: vmesas; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.vmesas AS
 SELECT b.id AS sucursal_id,
    b.sucursal,
    c.id AS salon_id,
    c.salon,
    a.id AS mesa_id,
    a.mesa,
    a.capacidad
   FROM ((public.res_mesas a
     LEFT JOIN public.res_sucursales b ON ((b.id = a.sucursal_id)))
     LEFT JOIN public.res_salones c ON (((b.id = a.sucursal_id) AND (c.id = a.salon_id))))
  WHERE (a.deleted_at IS NULL)
  ORDER BY b.sucursal, c.salon, a.mesa;


ALTER TABLE public.vmesas OWNER TO postgres;

--
-- Name: vmesas_todas; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.vmesas_todas AS
 SELECT b.id AS sucursal_id,
    b.sucursal,
    c.id AS salon_id,
    c.salon,
    a.id AS mesa_id,
    a.mesa,
    a.capacidad
   FROM ((public.res_mesas a
     LEFT JOIN public.res_sucursales b ON ((b.id = a.sucursal_id)))
     LEFT JOIN public.res_salones c ON (((b.id = a.sucursal_id) AND (c.id = a.salon_id))))
  ORDER BY b.sucursal, c.salon, a.mesa;


ALTER TABLE public.vmesas_todas OWNER TO postgres;

--
-- Name: vres_salones; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.vres_salones AS
 SELECT a.id,
    b.sucursal,
    a.salon
   FROM (public.res_salones a
     LEFT JOIN public.res_sucursales b ON ((b.id = a.sucursal_id)))
  WHERE (a.deleted_at IS NULL)
  ORDER BY a.id;


ALTER TABLE public.vres_salones OWNER TO postgres;

--
-- Name: vreservas; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.vreservas AS
 SELECT a.nombre_cliente,
    a.sucursal,
    b.sucursal AS tsucursal,
    a.salon,
    c.salon AS tsalon,
    d.mesa,
    d.mesa AS tmesa,
    a.estado,
    e.estado AS testado,
    a.fecha_reserva,
    a.hora_reserva,
    a.cantidad_pasajeros,
    a.nombre_empresa,
    a.nombre_hotel,
    a.telefono_cliente,
    a.email_cliente,
    a.tipo_reserva,
    f.tipo AS ttipo,
    a.observaciones,
    a.ambiente,
    a.razon_cancelacion,
    a.observacion_cancelacion,
    a.fecha_ultima_modificacion,
    a.usuario_ultima_modificacion,
    a.usuario_registro,
    a.clave_usuario,
    a.dianoche,
    a.archivo_1,
    a.archivo_2,
    a.archivo_3,
    a.archivo_4,
    a.archivo_5,
    a.cliente_id,
    a.evento_nombre_adicional,
    a.evento_pax,
    a.evento_valor_menu,
    a.evento_total_sin_propina,
    a.evento_total_propina,
    a.evento_email_contacto,
    a.evento_telefono_contacto,
    a.evento_anticipo,
    a.evento_paga_en_local,
        CASE
            WHEN (a.evento_paga_en_local = 1) THEN 'SI'::text
            ELSE 'NO'::text
        END AS tevento_paga_en_local,
    a.evento_audio,
        CASE
            WHEN (a.evento_audio = 1) THEN 'SI'::text
            ELSE 'NO'::text
        END AS tevento_audio,
    a.evento_video,
        CASE
            WHEN (a.evento_video = 1) THEN 'SI'::text
            ELSE 'NO'::text
        END AS tevento_video,
    a.evento_video_audio,
        CASE
            WHEN (a.evento_video_audio = 1) THEN 'SI'::text
            ELSE 'NO'::text
        END AS tevento_video_audio,
    a.evento_restriccion_alimenticia,
        CASE
            WHEN (a.evento_restriccion_alimenticia = 1) THEN 'SI'::text
            ELSE 'NO'::text
        END AS tevento_restriccion_alimenticia,
    a.evento_ubicacion,
    a.evento_monta,
    a.evento_detalle_restriccion,
    a.usuario_confirmacion,
    a.usuario_rechazo,
    a.fecha_confirmacion,
    a.fecha_rechazo,
    a.razon_rechazo,
    a.evento_comentarios,
    a.evento_nombre_contacto,
    a.evento_idioma,
    a.evento_cristaleria,
    a.evento_decoracion,
    a.evento_mesa_soporte_adicional,
    a.evento_extra_permitido,
    a.evento_menu_impreso,
    a.evento_table_tent
   FROM (((((public.reservas a
     LEFT JOIN public.res_sucursales b ON ((b.id = a.sucursal)))
     LEFT JOIN public.res_salones c ON ((c.id = a.salon)))
     LEFT JOIN public.res_mesas d ON ((d.id = a.mesa)))
     LEFT JOIN public.res_estados_reservas e ON ((e.id = a.estado)))
     LEFT JOIN public.res_tipo_reservas f ON ((f.id = a.tipo_reserva)));


ALTER TABLE public.vreservas OWNER TO postgres;

--
-- Name: vsalones; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.vsalones AS
 SELECT a.id,
    b.id AS sucursal_id,
    b.sucursal,
    a.salon
   FROM (public.res_salones a
     LEFT JOIN public.res_sucursales b ON ((b.id = a.sucursal_id)))
  WHERE (a.deleted_at IS NULL)
  ORDER BY a.id;


ALTER TABLE public.vsalones OWNER TO postgres;

--
-- Name: vsalones_todos; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.vsalones_todos AS
 SELECT a.id,
    b.id AS sucursal_id,
    b.sucursal,
    a.salon
   FROM (public.res_salones a
     LEFT JOIN public.res_sucursales b ON ((b.id = a.sucursal_id)))
  ORDER BY a.id;


ALTER TABLE public.vsalones_todos OWNER TO postgres;

--
-- Name: cli_categoria_clientes id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cli_categoria_clientes ALTER COLUMN id SET DEFAULT nextval('public.cli_categoria_clientes_id_seq'::regclass);


--
-- Name: cli_cliente_categoria id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cli_cliente_categoria ALTER COLUMN id SET DEFAULT nextval('public.cli_cliente_categoria_id_seq'::regclass);


--
-- Name: cli_comunas id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cli_comunas ALTER COLUMN id SET DEFAULT nextval('public.cli_comunas_id_seq'::regclass);


--
-- Name: cli_premios id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cli_premios ALTER COLUMN id SET DEFAULT nextval('public.cli_premios_id_seq'::regclass);


--
-- Name: cli_premios_clientes id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cli_premios_clientes ALTER COLUMN id SET DEFAULT nextval('public.cli_premios_clientes_id_seq'::regclass);


--
-- Name: cli_tipos_clientes id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cli_tipos_clientes ALTER COLUMN id SET DEFAULT nextval('public.cli_tipos_clientes_id_seq'::regclass);


--
-- Name: clientes id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.clientes ALTER COLUMN id SET DEFAULT nextval('public.clientes_id_seq'::regclass);


--
-- Name: estados_reservas id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.estados_reservas ALTER COLUMN id SET DEFAULT nextval('public.estados_reservas_id_seq'::regclass);


--
-- Name: failed_jobs id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);


--
-- Name: migrations id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);


--
-- Name: personal_access_tokens id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.personal_access_tokens ALTER COLUMN id SET DEFAULT nextval('public.personal_access_tokens_id_seq'::regclass);


--
-- Name: res_estados_reservas id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.res_estados_reservas ALTER COLUMN id SET DEFAULT nextval('public.res_estados_reservas_id_seq'::regclass);


--
-- Name: res_mesas id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.res_mesas ALTER COLUMN id SET DEFAULT nextval('public.res_mesas_id_seq'::regclass);


--
-- Name: res_salones id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.res_salones ALTER COLUMN id SET DEFAULT nextval('public.res_salones_id_seq'::regclass);


--
-- Name: res_sucursales id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.res_sucursales ALTER COLUMN id SET DEFAULT nextval('public.res_sucursales_id_seq'::regclass);


--
-- Name: res_tipo_reservas id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.res_tipo_reservas ALTER COLUMN id SET DEFAULT nextval('public.res_tipo_reservas_id_seq'::regclass);


--
-- Name: reservas id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.reservas ALTER COLUMN id SET DEFAULT nextval('public.reservas_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- Data for Name: cli_categoria_clientes; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.cli_categoria_clientes (id, categoria, monto, deleted_at, created_at, updated_at) FROM stdin;
3	ICONO	800000	\N	\N	\N
1	RESERVA	250001	\N	\N	2023-03-19 18:27:26
2	GRAN RESERVA	500000	\N	\N	\N
4	GSFGSDFG	465465	\N	2023-03-19 19:00:01	2023-03-19 19:00:01
5	SDFDF	54646456	\N	2023-03-20 01:03:35	2023-03-20 01:03:35
6	CUALQUIER COSAS	75001	\N	2023-03-20 20:10:56	2023-03-20 20:11:28
\.


--
-- Data for Name: cli_cliente_categoria; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.cli_cliente_categoria (id, categoria_id, cliente_id, created_at, updated_at, deleted_at) FROM stdin;
\.


--
-- Data for Name: cli_comunas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.cli_comunas (id, comuna, deleted_at, created_at, updated_at) FROM stdin;
1	Santiago	\N	\N	\N
2	Cerrillos	\N	\N	\N
3	Cerro Navia	\N	\N	\N
4	Conchalí	\N	\N	\N
5	El Bosque	\N	\N	\N
6	Estación Central	\N	\N	\N
7	Huechuraba	\N	\N	\N
8	Independencia	\N	\N	\N
9	La Cisterna	\N	\N	\N
10	La Florida	\N	\N	\N
11	La Granja	\N	\N	\N
12	La Pintana	\N	\N	\N
13	La Reina	\N	\N	\N
14	Las Condes	\N	\N	\N
15	Lo Barnechea	\N	\N	\N
16	Lo Espejo	\N	\N	\N
17	Lo Prado	\N	\N	\N
18	Macul	\N	\N	\N
19	Maipú	\N	\N	\N
20	Ñuñoa	\N	\N	\N
21	Pedro Aguirre Cerda	\N	\N	\N
22	Peñalolén	\N	\N	\N
23	Providencia	\N	\N	\N
24	Pudahuel	\N	\N	\N
25	Quilicura	\N	\N	\N
26	Quinta Normal	\N	\N	\N
27	Recoleta	\N	\N	\N
28	Renca	\N	\N	\N
29	San Joaquín	\N	\N	\N
30	San Miguel	\N	\N	\N
31	San Ramón	\N	\N	\N
32	Vitacura	\N	\N	\N
33	Puente Alto	\N	\N	\N
34	Pirque	\N	\N	\N
35	San José de Maipo	\N	\N	\N
36	Colina	\N	\N	\N
37	Lampa	\N	\N	\N
38	Til til	\N	\N	\N
39	San Bernardo	\N	\N	\N
40	Buin	\N	\N	\N
41	Calera de Tango	\N	\N	\N
42	Paine	\N	\N	\N
43	Melipilla	\N	\N	\N
44	Alhué	\N	\N	\N
45	Curacaví	\N	\N	\N
46	María Pinto	\N	\N	\N
47	San Pedro	\N	\N	\N
48	Talagante	\N	\N	\N
49	El Monte	\N	\N	\N
50	Isla de Maipo	\N	\N	\N
51	Padre Hurtado	\N	\N	\N
52	Peñaflor	\N	\N	\N
54	CUALQUIER INSTANCIA	2023-03-20 20:07:26	2023-03-20 20:05:51	2023-03-20 20:07:02
53	NUEVA COMUNA	2023-03-24 02:26:06	2023-03-20 03:11:22	2023-03-20 03:17:21
55	NUEVA COMUNA	2023-03-24 17:30:01	2023-03-24 17:29:29	2023-03-24 17:29:46
56	NUEVA COMUNA	2023-03-24 18:22:46	2023-03-24 18:20:48	2023-03-24 18:22:05
\.


--
-- Data for Name: cli_premios; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.cli_premios (id, categoria_id, premio, usuario_id, created_at, updated_at, deleted_at) FROM stdin;
\.


--
-- Data for Name: cli_premios_clientes; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.cli_premios_clientes (id, cliente_id, categoria_id, premio_id, estado_entrega, usuario_id, created_at, updated_at, deleted_at) FROM stdin;
\.


--
-- Data for Name: cli_tipos_clientes; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.cli_tipos_clientes (id, tipo, deleted_at, created_at, updated_at) FROM stdin;
2	CENA MARIDAJE	\N	2023-03-15 14:06:48	2023-03-15 14:06:48
19	NUEVO TIPO	2023-03-24 17:31:53	2023-03-24 17:31:19	2023-03-24 17:31:31
4	EVENTO	\N	\N	\N
6	SDASD	\N	\N	\N
7	DFGDFGDFG	\N	\N	\N
8	SDFSDFSDFSDF	\N	\N	\N
9	EWWEQE	\N	\N	\N
10	GDFGDFG	\N	\N	\N
11	SFDFDFDFD	\N	\N	\N
12	ñLKñJLJ	\N	\N	\N
15	PEPE	\N	2023-03-19 14:18:15	2023-03-19 14:18:28
14	GHJGHJJ	2023-03-19 14:18:33	2023-03-19 14:13:45	2023-03-19 14:13:45
16	BBBBBBBB	2023-03-19 14:20:20	2023-03-19 14:20:04	2023-03-19 14:20:12
17	CCCDDDDD	2023-03-19 14:21:39	2023-03-19 14:21:24	2023-03-19 14:21:33
3	AAABB	\N	\N	2023-03-20 03:27:39
18	EWRR	2023-03-20 03:27:58	2023-03-20 03:18:53	2023-03-20 03:18:53
1	REGULAR	\N	\N	2023-03-20 20:09:52
5	FFF	2023-03-20 20:10:05	\N	\N
13	ERRWERWER	2023-03-24 13:50:05	\N	\N
\.


--
-- Data for Name: clientes; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.clientes (id, nombre, rut, fecha_nacimiento, telefono, "dirección", comuna_id, categoria_id, numero_tarjeta, email, empresa, hotel, vino_favorito_1, vino_favorito_2, vino_favorito_3, foto, referencia, info_vina, club, deleted_at, created_at, updated_at, tipo_id) FROM stdin;
7	Marti Gaytán Chavarría	87813037	1994-06-22	+58 241 3247975	Av. Carmen, Hab. 53, Limón de Mata Edo. Carabobo	1	5	7890	irenteria@beltran.net	Vera de Correa S.R.L.	Lomeli de Ramón	Nisi dolore.	Ut autem.	Autem soluta unde.	12.jpg	Ut voluptatibus et eos sint molestiae quibusdam.	5	4	\N	2023-03-23 19:27:39	\N	13
8	Valentina Blanco Hijo	75477022	1988-12-25	+58 474-638-1704	Av. Mohamed, Apto 73, Bétancourt del Valle Edo. Monagas, 7120	42	2	6413	vera69@armijo.net	Sevilla y Casárez	Jáquez y Collazo	Corrupti ut quasi.	Illo hic.	Rem nulla harum.	5.jpg	Consectetur aliquid praesentium iure nobis.	2	2	\N	2023-03-23 19:27:39	\N	3
9	Rafael Nieto Hijo	10068665	1977-03-12	200 690 2744	Callejón Becerra, 15, Casa 97, Puerto Jaimede Asis Edo. Lara, 2025	3	4	7664	abril94@live.com	Lucio y Llamas R.L.	Águilar de Vélez	Omnis nam qui.	Neque dolor.	In quia quam.	10.jpg	Dolores et voluptas aut cum numquam quia.	3	6	\N	2023-03-23 19:27:39	\N	7
10	Ing. Ismael Llorente Hijo	84227384	1982-11-27	+58 4126338679	Cl. Hector Sánchez, Piso 0, Valle Francisco Javier Edo. Bolívar	48	4	6369	jaime84@latinmail.com	Gurule de Casado	Cooperativa Luque y Munguía	Voluptate sed et.	Accusantium debitis voluptatum.	Amet ea.	1.jpg	Quis nobis voluptatibus enim aspernatur amet cumque fuga.	4	7	\N	2023-03-23 19:27:39	\N	3
11	Luna Caraballo Torres	62114179	2010-08-23	+58 435-857-9234	Cl. Armijo, Piso 1, Silva de Mata Edo. Barinas	7	3	1713	daniel.dominguez@ponce.net	Rosa de Rosas	Corporación Barajas y Tórrez	Quis aspernatur.	Quo commodi.	Dolor voluptates nam.	4.jpg	Ut in et incidunt autem maiores ipsam.	2	7	\N	2023-03-23 19:27:39	\N	2
12	Sra. Africa Juárez	76257251	2000-07-04	+58 225 915 6011	Cl. Rodrigo Aguado, 447, Nro 34, Sancho de Mata Edo. Anzoátegui, 9647	24	2	2028	daniela.molina@sanabria.com.ve	Empresa Sanz y Hernando	Zaragoza de Covarrubias	Laboriosam culpa dolores.	Quasi aliquam ut.	Quo et.	4.jpg	Et quibusdam quidem consectetur distinctio.	1	1	\N	2023-03-23 19:27:39	\N	11
13	Ing. Alonso Cortez	57405061	2018-05-10	+58 2023634522	Vereda Pedro, Casa 30, Montes del Valle Edo. Monagas	2	5	4259	pvera@posada.org	Empresa Delgado y Canales	Calderón de Lucas	Culpa non.	Occaecati voluptatem.	Nulla qui in.	8.jpg	Aut maxime numquam laboriosam aliquam odio qui pariatur.	2	6	\N	2023-03-23 19:27:39	\N	17
5	Gabriela Garrido	54210954	2001-08-02	412 3968906	Cl. Verdugo, 419, Piso 1, Pedro de Altagracia Edo. Miranda	13	6	2982	noelia.angulo@badillo.web.ve	Viajes Montes S.A.	Empresa Colunga etc	Voluptatem corrupti.	Error est et.	Dolore amet aut.	10.jpg	Non sint nam consequatur.	5	3	2023-03-23 19:33:00	2023-03-23 19:27:39	\N	3
14	sdfsdf	sdfds	2023-03-15	sdfsdf	sdfsdfsdf	\N	\N	\N	sdfsdf	sdfsdfsd	sdfsdf	\N	\N	\N	\N	\N	\N	\N	\N	2023-03-24 05:15:57	2023-03-24 05:15:57	\N
15	sdfsdf	sdfds	2023-03-15	sdfsdf	sdfsdfsdf	\N	\N	\N	sdfsdf	sdfsdfsd	sdfsdf	\N	\N	\N	\N	\N	\N	\N	\N	2023-03-24 05:18:16	2023-03-24 05:18:16	\N
16	kkkkkkkkkk	sdfds	2023-03-15	sdfsdf	sdfsdfsdf	\N	\N	\N	sdfsdf	sdfsdfsd	sdfsdf	\N	\N	\N	\N	\N	\N	\N	\N	2023-03-24 05:24:18	2023-03-24 05:24:18	\N
18	Dn. Ivan Montoya	43305265	2017-06-15	+58 480-6836028	Vereda Guajardo, Hab. 0, Villa Hugodel Valle Edo. Anzoátegui, 9182	20	1	4691	plaza.noa@anaya.com	Saldaña de Cervantes	Rosales y Villalobos etc	Accusamus explicabo qui.	Voluptas error.	Ad ut non.	7.jpg	Molestias facere qui et dolorem veritatis vel facere nemo.	5	3	\N	2023-03-24 01:39:47	\N	16
17	bbbbbb	aaaaaaa	2023-03-07	ccccccccc	eeeeeeeeeeeee	1	2	46464	dddddddddd	ffffffffff	ggggg	gjgjh	jhkjhkjh	khkjhjkh	9.jpg	hhhhhhhhhh	1	1	\N	2023-03-24 05:34:36	\N	15
6	Andrea Rangel Delao	33577955	2013-04-05	427-8601550	Carretera Olivia Loera, Casa 38, Puerto Onadel Valle Edo. Sucre	23	1	4103	barrientos.juan@guevara.org	Centro Miramontes y Ayala	Global Gaytán	Ea dolores explicabo.	Delectus nam eum.	Occaecati esse.	5.jpg	Maxime quibusdam sint necessitatibus ut officiis inventore non.	2	7	2023-03-24 06:48:55	2023-03-23 19:27:39	\N	14
20	asdasd	adsds	2023-03-08	asdasd	adasda	\N	\N	\N	asdasd	\N	\N	\N	\N	\N	\N	\N	\N	\N	2023-03-24 06:50:52	2023-03-24 05:44:24	2023-03-24 05:44:24	\N
19	BBBBBBBBBB	AAAAAAAA	2023-03-14	CCCCCCCCC	EEEEEEEEEEEEE	\N	\N	\N	DDDDDDDDD	FFFFFFFFFF	GGGGGGGGG	\N	\N	\N	\N	HHHHH	\N	\N	2023-03-24 06:51:32	2023-03-24 05:42:00	2023-03-24 05:42:00	\N
21	oooooooooooo	AAAAAA	2023-03-21	iiiiiiiii	\N	\N	\N	\N	uuuuuuuuuuuu	tttttttttttttt	rrrrrrrrrrrrrr	\N	\N	\N	\N	eeeeeeeeeeeee	\N	\N	\N	2023-03-24 09:06:52	2023-03-24 09:26:22	\N
22	nombre	233131	\N	4646465	\N	\N	\N	\N	correo@correo.com	\N	\N	\N	\N	\N	\N	\N	0	0	\N	2023-03-24 17:35:51	2023-03-24 17:35:51	\N
40	Arturo Deutsh	4565646	\N	54646	\N	\N	\N	\N	correo@correo.com	Dataloggers	Hotel	\N	\N	\N	\N	\N	\N	\N	\N	2023-03-31 19:16:57	2023-03-31 19:16:57	2
41	Arturo Deutsh	4565646	\N	54646	\N	\N	\N	\N	correo@correo.com	Dataloggers	Hotel	\N	\N	\N	\N	\N	\N	\N	\N	2023-03-31 19:16:57	2023-03-31 19:16:57	2
42	Pedro Perez	kkjkl	\N	456465465	\N	\N	\N	\N	correo1@correo.com	SUEMPRESA	SUHOTEL	\N	\N	\N	\N	\N	\N	\N	\N	2023-03-31 19:23:17	2023-03-31 19:23:17	2
43	Pedro Perez	kkjkl	\N	456465465	\N	\N	\N	\N	correo1@correo.com	SUEMPRESA	SUHOTEL	\N	\N	\N	\N	\N	\N	\N	\N	2023-03-31 19:23:17	2023-03-31 19:23:17	2
45	pepe trueno	\N	\N	04125545728	\N	\N	\N	\N	correo@correo.com	empresa	hotel	\N	\N	\N	\N	\N	\N	\N	\N	2023-04-03 13:05:30	2023-04-03 13:05:30	4
62	tiroloco	\N	\N	56464564	\N	\N	\N	\N	kjhk@jhjk.hj	emperesa1	hotel1	\N	\N	\N	\N	\N	\N	\N	\N	2023-04-03 14:22:14	2023-04-03 14:22:14	4
\.


--
-- Data for Name: estados_reservas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.estados_reservas (id, estado, deleted_at) FROM stdin;
\.


--
-- Data for Name: failed_jobs; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.failed_jobs (id, uuid, connection, queue, payload, exception, failed_at) FROM stdin;
\.


--
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.migrations (id, migration, batch) FROM stdin;
1	2014_10_12_000000_create_users_table	1
2	2014_10_12_100000_create_password_resets_table	1
3	2019_08_19_000000_create_failed_jobs_table	1
4	2019_12_14_000001_create_personal_access_tokens_table	1
5	2023_03_14_001411_create_cli_tipos_clientes_table	2
6	2023_03_14_001717_create_cli_categoria_clientes_table	2
7	2023_03_14_002523_create_comunas_table	3
8	2023_03_14_012902_create_clientes_table	4
9	2023_03_14_013332_create_cli_comunas_table	5
10	2023_03_14_013501_create_clientes_table	5
11	2023_03_20_180545_add_tipo_id_to_clientes_table	6
12	2023_03_20_184316_create_tabla_premios	7
13	2023_03_20_185857_create_cli_premios	8
14	2023_03_20_191541_create_cli_premios_clientes	9
15	2023_03_20_192907_create_cli_cliente_categoria	9
16	2023_03_23_233904_create_view_clientes_todos	10
17	2023_03_24_000211_create_view_clientes	11
18	2023_03_24_050657_change_client_table_column_nullable	12
19	2023_03_24_093624_create_res_sucursales_table	13
20	2023_03_24_093630_create_res_salones_table	13
24	2023_03_24_093634_create_res_mesas_table	14
33	2023_03_28_232416_create_view_vmesas	15
34	2023_03_28_233136_create_view_vmesas_todas	15
35	2023_03_28_233204_create_view_vsalones	15
36	2023_03_28_233225_create_view_vsalones_todos	15
37	2023_04_03_121815_make_rut_nulleable_on_clientes_table	16
38	2023_04_06_214622_create_table_prueba	17
39	2023_04_07_162233_create_reservas_table	0
44	2023_04_07_164533_create_estados_reservas_table	18
45	2023_04_07_171157_create_res_estados_reservas_table	18
46	2023_04_07_180005_create_res_tipo_reservas_table	18
\.


--
-- Data for Name: password_resets; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.password_resets (email, token, created_at) FROM stdin;
\.


--
-- Data for Name: personal_access_tokens; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.personal_access_tokens (id, tokenable_type, tokenable_id, name, token, abilities, last_used_at, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: res_estados_reservas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.res_estados_reservas (id, estado, created_at, updated_at, deleted_at) FROM stdin;
1	Pendiente	\N	\N	\N
2	Confirmada	\N	\N	\N
3	Realizada	\N	\N	\N
4	Cancelada	\N	\N	\N
5	Sentada	\N	\N	\N
6	Pagada	\N	\N	\N
7	No Show	\N	\N	\N
8	Rechazada	\N	\N	\N
9	Solicitud_Web	\N	\N	\N
10	Por Despachar	\N	\N	\N
11	Despachada	\N	\N	\N
\.


--
-- Data for Name: res_mesas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.res_mesas (id, mesa, sucursal_id, salon_id, capacidad, deleted_at, created_at, updated_at) FROM stdin;
2	2	1	1	15	\N	2023-03-29 03:25:07	\N
1	1	1	1	10	\N	2023-03-28 23:11:01	\N
\.


--
-- Data for Name: res_salones; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.res_salones (id, salon, sucursal_id, deleted_at, created_at, updated_at) FROM stdin;
1	salon 1	1	\N	2023-03-24 16:16:23	2023-03-24 17:04:46
2	salón 2	2	\N	2023-03-24 16:17:10	2023-03-29 01:30:20
3	SALON 3	1	\N	2023-03-31 19:31:31	2023-03-31 19:32:11
\.


--
-- Data for Name: res_sucursales; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.res_sucursales (id, sucursal, calendario, fecha_inicio_calendario, fecha_fin_calendario, deleted_at, created_at, updated_at) FROM stdin;
1	VIVO	1	2023-01-10	2023-03-15	\N	2023-03-24 13:33:05	2023-03-24 15:12:07
2	patio	1	2023-02-01	2023-03-31	\N	2023-03-24 13:44:38	\N
\.


--
-- Data for Name: res_tipo_reservas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.res_tipo_reservas (id, tipo, created_at, updated_at, deleted_at) FROM stdin;
1	REGULAR	\N	\N	\N
2	EVENTO	\N	\N	\N
3	CORTESIA	\N	\N	\N
4	RESTORANDO	\N	\N	\N
5	FERIA	\N	\N	\N
6	PRESENTADOR	\N	\N	\N
7	DELIVERY	\N	\N	\N
\.


--
-- Data for Name: reservas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.reservas (id, fecha_reserva, razon_cancelacion, observacion_cancelacion, hora_reserva, nombre_cliente, nombre_empresa, fecha_ultima_modificacion, usuario_ultima_modificacion, nombre_hotel, cantidad_pasajeros, telefono_cliente, tipo_reserva, email_cliente, salon, mesa, estado, observaciones, usuario_registro, clave_usuario, sucursal, dianoche, archivo_1, archivo_2, archivo_3, archivo_4, archivo_5, cliente_id, evento_nombre_adicional, evento_pax, evento_valor_menu, evento_total_sin_propina, evento_total_propina, evento_email_contacto, evento_telefono_contacto, evento_anticipo, evento_paga_en_local, evento_audio, evento_video, evento_video_audio, evento_restriccion_alimenticia, evento_ubicacion, evento_monta, evento_detalle_restriccion, ambiente, usuario_confirmacion, usuario_rechazo, fecha_confirmacion, fecha_rechazo, razon_rechazo, evento_comentarios, evento_nombre_contacto, evento_idioma, evento_cristaleria, evento_decoracion, evento_mesa_soporte_adicional, evento_extra_permitido, evento_menu_impreso, evento_table_tent, evento_logo, created_at, updated_at, deleted_at) FROM stdin;
4	2023-04-04	\N	\N	21:13:00	Rafael Nieto Hijo	empresa	\N	\N	Cooperativa Luque y Munguía	343	04169367850	2	correo1@correo.com	1	2	1	jjkjjjkljjllkjlj	1	abc	1	1	\N	\N	\N	\N	\N	9	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	2023-04-04 02:56:16	2023-04-04 02:56:16	\N
5	2023-04-06	\N	\N	21:48:00	pepe trueno	emperesa1	\N	\N	hotel	25	04127087228	2	daniel.dominguez@ponce.net	1	2	1	Observaciones	1	abc	1	1	\N	\N	\N	\N	\N	45	Adiocional	25	250	6250	7000	\N	132131332	25000	1	\N	\N	\N	1	\N	sfsdsdf	No camarones	Terraza	\N	\N	\N	\N	\N	Comentario evento	Pee trueno	\N	SOlo copas de cristal	Tema marítimo	\N	\N	1	\N	\N	2023-04-06 14:05:13	2023-04-06 14:05:13	\N
6	2023-04-06	\N	\N	21:48:00	pepe trueno	emperesa1	\N	\N	hotel	25	04127087228	2	daniel.dominguez@ponce.net	1	2	1	Observaciones	1	abc	1	1	\N	\N	\N	\N	\N	45	Adiocional	25	250	6250	7000	correo@correo.com	132131332	25000	1	\N	\N	\N	1	\N	sfsdsdf	No camarones	Terraza	\N	\N	\N	\N	\N	Comentario evento	Pee trueno	\N	SOlo copas de cristal	Tema marítimo	\N	\N	1	\N	\N	2023-04-06 14:07:09	2023-04-06 14:07:09	\N
7	2023-04-06	\N	\N	21:48:00	pepe trueno	emperesa1	\N	\N	hotel	25	04127087228	2	daniel.dominguez@ponce.net	1	2	1	Observaciones	1	abc	1	1	\N	\N	\N	\N	\N	45	Adiocional	25	250	6250	7000	correo@correo.com	132131332	25000	1	\N	\N	\N	1	\N	sfsdsdf	No camarones	Terraza	\N	\N	\N	\N	\N	Comentario evento	Pee trueno	\N	SOlo copas de cristal	Tema marítimo	\N	\N	1	\N	\N	2023-04-06 14:13:26	2023-04-06 14:13:26	\N
8	2023-04-06	\N	\N	23:21:00	Marti Gaytán Chavarría	emperesa1	\N	\N	hotel1	25	04127087228	2	correo@correo.com	1	2	1	Observaciones	1	abc	1	1	\N	\N	\N	\N	\N	7	Adiocional	25	250	6250	7000	correo@correo.com	132131332	25000	1	1	1	1	1	1	sfsdsdf	No camarones	Terraza	\N	\N	\N	\N	\N	Comentario evento	Pee trueno	\N	Sólo copas de cristal	Tema marítimo	1	1	1	\N	\N	2023-04-06 14:21:49	2023-04-06 14:21:49	\N
9	2023-04-06	\N	\N	23:21:00	Marti Gaytán Chavarría	emperesa1	\N	\N	hotel1	25	04127087228	2	correo@correo.com	1	2	1	Observaciones	1	abc	1	1	\N	\N	\N	\N	\N	7	Adiocional	25	250	6250	7000	correo@correo.com	132131332	25000	1	1	1	1	1	1	sfsdsdf	No camarones	Terraza	\N	\N	\N	\N	\N	Comentario evento	Pee trueno	\N	Sólo copas de cristal	Tema marítimo	1	1	1	\N	\N	2023-04-06 14:23:32	2023-04-06 14:23:32	\N
10	2023-04-06	\N	\N	23:26:00	Ing. Ismael Llorente Hijo	Empresa Delgado y Canales	\N	\N	Corporación Barajas y Tórrez	25	+58 2023634522	2	daniel.dominguez@ponce.net	1	2	1	Obs	1	abc	1	1	\N	\N	\N	\N	\N	10	NOmbre adic	25	250	6250	6500	correo@correo.com	56456132	1000	1	1	1	1	1	1	dfsdf	Veganos	Piso superior	\N	\N	\N	\N	\N	Eveneto	Pedro Pérez	\N	Copas de cuello alto	Tema amrítimo	1	1	1	1	\N	2023-04-06 14:29:44	2023-04-06 14:29:44	\N
11	2023-04-06	\N	\N	23:48:00	Sra. Africa Juárez	Empresa Delgado y Canales	\N	\N	Cooperativa Luque y Munguía	36	+58 2023634522	2	daniela.molina@sanabria.com.ve	1	2	1	Prueba de creación de reservas	1	abc	1	1	\N	\N	\N	\N	\N	12	Evento de Prueba	36	150	5400	5600	rperez@correo.com	4125879654	1500	1	1	1	1	1	1	kjhkjhkj	Vegetariono	Terraza superior	\N	\N	\N	\N	\N	Comentario del eveneto Prueba	Richard Perez	\N	\N	Tema Navideño	1	1	1	1	\N	2023-04-06 14:51:46	2023-04-06 14:51:46	\N
12	2023-04-06	\N	\N	13:43:00	Marti Gaytán Chavarría	empresa	\N	\N	Corporación Barajas y Tórrez	25	04127087228	2	correo1@correo.com	1	2	1	Comentario	1	abc	1	1	\N	\N	\N	\N	\N	7	gdfg	25	25	500	15000	dfgd	dfgdf	250	1	1	1	1	1	1	sdfsdf	sfsf	sdfsdf	\N	\N	\N	\N	\N	sdfsdfs	dfgf	\N	dfgdf	sdfsdf	1	1	1	1	\N	2023-04-06 17:59:47	2023-04-06 17:59:47	\N
13	2023-04-20	\N	\N	15:08:00	Luna Caraballo Torres	Empresa Delgado y Canales	\N	\N	Corporación Barajas y Tórrez	10	04169367850	2	daniel.dominguez@ponce.net	1	2	1	dsfsdfsdfsd	1	abc	1	1	\N	\N	\N	\N	\N	11	lkhlh	10	1	250	25000	sdf	sdfsdf	25	1	1	1	1	1	1	WEW	sDSDSD	QEEW	\N	\N	\N	\N	\N	FGHFG	dfsdf	\N	dfsf	EWQEQ	1	1	1	1	\N	2023-04-06 18:09:20	2023-04-06 18:09:20	\N
14	2023-04-07	\N	\N	16:22:00	Ing. Ismael Llorente Hijo	Empresa Delgado y Canales	\N	\N	Cooperativa Luque y Munguía	25	04127087228	2	correo1@correo.com	1	2	1	OBSERVACIONES	1	abc	1	1	\N	\N	\N	\N	\N	10	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	2023-04-07 19:21:50	2023-04-07 19:21:50	\N
15	2023-04-13	\N	\N	15:30:00	Luna Caraballo Torres	Empresa Delgado y Canales	\N	\N	Cooperativa Luque y Munguía	50	04169367850	4	daniela.molina@sanabria.com.ve	1	2	1	OBSERVACIONES EVENTO	1	abc	1	1	\N	\N	\N	\N	\N	11	EVENTO 1	50	5000	5100	5200	pperez@correo.com	412589632	2500	1	1	1	1	1	1	Monta	Sólo comida vegana	Terraza	\N	\N	\N	\N	\N	Comentarios eventos	PEDRO PÉREZ	\N	La crsistaleria que soliciten	Tema marino	1	1	1	1	\N	2023-04-07 19:25:29	2023-04-07 19:25:29	\N
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.users (id, name, email, email_verified_at, password, avatar, remember_token, created_at, updated_at) FROM stdin;
1	admin	admin@themesbrand.com	\N	$2y$10$Yh1XFJ2xTTXux.0c.DqsfOh9Hbd0LsWYWNJzigtxEhIOVAVS8TZ1O	avatar-1.jpg	\N	2023-03-09 18:17:24	2023-03-09 18:17:24
\.


--
-- Name: cli_categoria_clientes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.cli_categoria_clientes_id_seq', 6, true);


--
-- Name: cli_cliente_categoria_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.cli_cliente_categoria_id_seq', 1, false);


--
-- Name: cli_comunas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.cli_comunas_id_seq', 56, true);


--
-- Name: cli_premios_clientes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.cli_premios_clientes_id_seq', 1, false);


--
-- Name: cli_premios_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.cli_premios_id_seq', 1, false);


--
-- Name: cli_tipos_clientes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.cli_tipos_clientes_id_seq', 19, true);


--
-- Name: clientes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.clientes_id_seq', 70, true);


--
-- Name: estados_reservas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.estados_reservas_id_seq', 1, false);


--
-- Name: failed_jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.failed_jobs_id_seq', 1, false);


--
-- Name: migrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.migrations_id_seq', 48, true);


--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.personal_access_tokens_id_seq', 1, false);


--
-- Name: res_estados_reservas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.res_estados_reservas_id_seq', 11, true);


--
-- Name: res_mesas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.res_mesas_id_seq', 2, true);


--
-- Name: res_salones_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.res_salones_id_seq', 3, true);


--
-- Name: res_sucursales_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.res_sucursales_id_seq', 2, true);


--
-- Name: res_tipo_reservas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.res_tipo_reservas_id_seq', 7, true);


--
-- Name: reservas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.reservas_id_seq', 15, true);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.users_id_seq', 2, true);


--
-- Name: cli_categoria_clientes cli_categoria_clientes_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cli_categoria_clientes
    ADD CONSTRAINT cli_categoria_clientes_pkey PRIMARY KEY (id);


--
-- Name: cli_cliente_categoria cli_cliente_categoria_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cli_cliente_categoria
    ADD CONSTRAINT cli_cliente_categoria_pkey PRIMARY KEY (id);


--
-- Name: cli_comunas cli_comunas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cli_comunas
    ADD CONSTRAINT cli_comunas_pkey PRIMARY KEY (id);


--
-- Name: cli_premios_clientes cli_premios_clientes_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cli_premios_clientes
    ADD CONSTRAINT cli_premios_clientes_pkey PRIMARY KEY (id);


--
-- Name: cli_premios cli_premios_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cli_premios
    ADD CONSTRAINT cli_premios_pkey PRIMARY KEY (id);


--
-- Name: cli_tipos_clientes cli_tipos_clientes_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cli_tipos_clientes
    ADD CONSTRAINT cli_tipos_clientes_pkey PRIMARY KEY (id);


--
-- Name: clientes clientes_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.clientes
    ADD CONSTRAINT clientes_pkey PRIMARY KEY (id);


--
-- Name: estados_reservas estados_reservas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.estados_reservas
    ADD CONSTRAINT estados_reservas_pkey PRIMARY KEY (id);


--
-- Name: failed_jobs failed_jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);


--
-- Name: failed_jobs failed_jobs_uuid_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);


--
-- Name: migrations migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);


--
-- Name: personal_access_tokens personal_access_tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_pkey PRIMARY KEY (id);


--
-- Name: personal_access_tokens personal_access_tokens_token_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_token_unique UNIQUE (token);


--
-- Name: res_estados_reservas res_estados_reservas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.res_estados_reservas
    ADD CONSTRAINT res_estados_reservas_pkey PRIMARY KEY (id);


--
-- Name: res_mesas res_mesas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.res_mesas
    ADD CONSTRAINT res_mesas_pkey PRIMARY KEY (id);


--
-- Name: res_salones res_salones_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.res_salones
    ADD CONSTRAINT res_salones_pkey PRIMARY KEY (id);


--
-- Name: res_sucursales res_sucursales_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.res_sucursales
    ADD CONSTRAINT res_sucursales_pkey PRIMARY KEY (id);


--
-- Name: res_tipo_reservas res_tipo_reservas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.res_tipo_reservas
    ADD CONSTRAINT res_tipo_reservas_pkey PRIMARY KEY (id);


--
-- Name: reservas reservas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.reservas
    ADD CONSTRAINT reservas_pkey PRIMARY KEY (id);


--
-- Name: users users_email_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: password_resets_email_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX password_resets_email_index ON public.password_resets USING btree (email);


--
-- Name: personal_access_tokens_tokenable_type_tokenable_id_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX personal_access_tokens_tokenable_type_tokenable_id_index ON public.personal_access_tokens USING btree (tokenable_type, tokenable_id);


--
-- Name: cli_cliente_categoria cli_cliente_categoria_categoria_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cli_cliente_categoria
    ADD CONSTRAINT cli_cliente_categoria_categoria_id_foreign FOREIGN KEY (categoria_id) REFERENCES public.cli_categoria_clientes(id);


--
-- Name: cli_cliente_categoria cli_cliente_categoria_cliente_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cli_cliente_categoria
    ADD CONSTRAINT cli_cliente_categoria_cliente_id_foreign FOREIGN KEY (cliente_id) REFERENCES public.clientes(id);


--
-- Name: cli_premios cli_premios_categoria_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cli_premios
    ADD CONSTRAINT cli_premios_categoria_id_foreign FOREIGN KEY (categoria_id) REFERENCES public.cli_categoria_clientes(id);


--
-- Name: cli_premios_clientes cli_premios_clientes_categoria_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cli_premios_clientes
    ADD CONSTRAINT cli_premios_clientes_categoria_id_foreign FOREIGN KEY (categoria_id) REFERENCES public.cli_categoria_clientes(id);


--
-- Name: cli_premios_clientes cli_premios_clientes_cliente_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cli_premios_clientes
    ADD CONSTRAINT cli_premios_clientes_cliente_id_foreign FOREIGN KEY (cliente_id) REFERENCES public.clientes(id);


--
-- Name: cli_premios_clientes cli_premios_clientes_premio_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cli_premios_clientes
    ADD CONSTRAINT cli_premios_clientes_premio_id_foreign FOREIGN KEY (premio_id) REFERENCES public.cli_premios(id);


--
-- Name: cli_premios_clientes cli_premios_clientes_usuario_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cli_premios_clientes
    ADD CONSTRAINT cli_premios_clientes_usuario_id_foreign FOREIGN KEY (usuario_id) REFERENCES public.users(id);


--
-- Name: cli_premios cli_premios_usuario_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cli_premios
    ADD CONSTRAINT cli_premios_usuario_id_foreign FOREIGN KEY (usuario_id) REFERENCES public.users(id);


--
-- Name: clientes clientes_categoria_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.clientes
    ADD CONSTRAINT clientes_categoria_id_foreign FOREIGN KEY (categoria_id) REFERENCES public.cli_categoria_clientes(id);


--
-- Name: clientes clientes_comuna_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.clientes
    ADD CONSTRAINT clientes_comuna_id_foreign FOREIGN KEY (comuna_id) REFERENCES public.cli_comunas(id);


--
-- Name: clientes clientes_tipo_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.clientes
    ADD CONSTRAINT clientes_tipo_id_foreign FOREIGN KEY (tipo_id) REFERENCES public.cli_tipos_clientes(id);


--
-- Name: res_mesas res_mesas_salon_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.res_mesas
    ADD CONSTRAINT res_mesas_salon_id_foreign FOREIGN KEY (salon_id) REFERENCES public.res_salones(id);


--
-- Name: res_mesas res_mesas_sucursal_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.res_mesas
    ADD CONSTRAINT res_mesas_sucursal_id_foreign FOREIGN KEY (sucursal_id) REFERENCES public.res_sucursales(id);


--
-- Name: res_salones res_salones_sucursal_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.res_salones
    ADD CONSTRAINT res_salones_sucursal_id_foreign FOREIGN KEY (sucursal_id) REFERENCES public.res_sucursales(id);


--
-- PostgreSQL database dump complete
--

