-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-09-2024 a las 21:21:16
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `empleototal`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificaciones`
--

CREATE TABLE `calificaciones` (
  `idcalificaciones` int(11) NOT NULL,
  `calificacion` int(5) NOT NULL,
  `comentario` varchar(400) NOT NULL,
  `fecha` date NOT NULL,
  `usuario_id_usuario` int(11) NOT NULL,
  `empresa_id_empresa` int(11) NOT NULL,
  `empresa_rol_id_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `calificaciones`
--

INSERT INTO `calificaciones` (`idcalificaciones`, `calificacion`, `comentario`, `fecha`, `usuario_id_usuario`, `empresa_id_empresa`, `empresa_rol_id_rol`) VALUES
(1, 5, 'Excelente servicio', '2024-08-13', 1, 1, 1),
(2, 4, 'Muy buena experiencia', '2024-08-13', 2, 2, 2),
(3, 3, 'Satisfactorio', '2024-08-13', 3, 3, 3),
(4, 2, 'Necesita mejoras', '2024-08-13', 4, 4, 4),
(5, 1, 'Poco recomendable', '2024-08-13', 5, 5, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categora` int(11) NOT NULL,
  `nombre_cat` varchar(45) DEFAULT NULL,
  `oferta_empleo_id_oferta_empleo` int(11) NOT NULL,
  `oferta_empleo_hojade_de_vida_id_hojade_de_vida` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categora`, `nombre_cat`, `oferta_empleo_id_oferta_empleo`, `oferta_empleo_hojade_de_vida_id_hojade_de_vida`) VALUES
(1, 'Tecnología', 1, 1),
(2, 'Creatividad', 2, 2),
(3, 'Data Science', 3, 3),
(4, 'Gestión', 4, 4),
(5, 'Marketing', 5, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `usuario_id_usuario` int(11) NOT NULL,
  `nombre_emp` varchar(45) DEFAULT NULL,
  `industria` varchar(500) DEFAULT NULL,
  `ubicacion` varchar(45) DEFAULT NULL,
  `tamaño_emp` varchar(45) DEFAULT NULL,
  `descripcion_emp` varchar(45) DEFAULT NULL,
  `contacto` varchar(100) DEFAULT NULL,
  `correo` varchar(45) DEFAULT NULL,
  `sitio_web_of` varchar(45) DEFAULT NULL,
  `antecedentes` varchar(500) DEFAULT NULL,
  `mision` varchar(100) DEFAULT NULL,
  `vision` varchar(100) DEFAULT NULL,
  `regionales` varchar(500) DEFAULT NULL,
  `hitos_significativos` varchar(100) DEFAULT NULL,
  `innovaciones_recientes` varchar(100) DEFAULT NULL,
  `beneficios_empleados` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`usuario_id_usuario`, `nombre_emp`, `industria`, `ubicacion`, `tamaño_emp`, `descripcion_emp`, `contacto`, `correo`, `sitio_web_of`, `antecedentes`, `mision`, `vision`, `regionales`, `hitos_significativos`, `innovaciones_recientes`, `beneficios_empleados`) VALUES
(1, 'Tech Solutions', 'Tecnología', 'Ciudad Z', 'Mediana', 'Empresa de tecnología', 'contacto@techsolutions.com', 'contacto@techsolutions.com', 'www.techsolutions.com', 'Lider en tecnología', 'Innovar en soluciones tecnológicas', 'Ser líderes en innovación', 'Oficinas en toda América', 'Premio a la mejor tecnología', 'Última tecnología en IA', 'Seguro médico'),
(2, 'Creative Minds', 'Diseño', 'Ciudad B', 'Pequeña', 'Agencia de diseño gráfico', 'info@creativeminds.com', 'info@creativeminds.com', 'www.creativeminds.com', 'Creatividad sin límites', 'Diseño innovador', 'Inspirar creatividad', 'Proyectos en Europa y Asia', 'Premios de diseño', 'Últimos avances en diseño gráfico', 'Bonos creativos'),
(3, 'Data Insights', 'Análisis', 'Ciudad C', 'Grande', 'Consultoría de datos', 'contacto@datainsights.com', 'contacto@datainsights.com', 'www.datainsights.com', 'Liderazgo en análisis de datos', 'Excelencia en interpretación de datos', 'Convertir datos en estrategias', 'Sucursales globales', 'Publicaciones en revistas científicas', 'Nuevas herramientas analíticas', 'Capacitación continua'),
(4, 'Project Masters', 'Gestión', 'Ciudad D', 'Mediana', 'Gestión de proyectos', 'contacto@projectmasters.com', 'contacto@projectmasters.com', 'www.projectmasters.com', 'Experiencia en gestión de proyectos', 'Liderar proyectos exitosos', 'Ser el referente en gestión de proyectos', 'Oficinas en América y Europa', 'Proyectos exitosos en diversas industrias', 'Métodos ágiles de gestión', 'Flexibilidad laboral'),
(5, 'Market Leaders', 'Marketing', 'Ciudad E', 'Pequeña', 'Agencia de marketing digital', 'info@marketleaders.com', 'info@marketleaders.com', 'www.marketleaders.com', 'Expertos en marketing digital', 'Maximizar el impacto en redes sociales', 'Liderar campañas de marketing', 'Clientes en toda América', 'Campañas exitosas', 'Nuevas estrategias de marketing digital', 'Comisiones por rendimiento'),
(7, 'empleototal', 'ss', 'aca', 'ss', 'ass', 'sass', 'empleototal@123', 'gddgs', 'ss', 'ss', 'ss', 'ss', 'ss', 'ss', 's');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudios`
--

CREATE TABLE `estudios` (
  `idEstudios` int(11) NOT NULL,
  `intitucion` varchar(45) DEFAULT NULL,
  `titulo` varchar(45) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `hojade_de_vida_id_hojade_de_vida` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `estudios`
--

INSERT INTO `estudios` (`idEstudios`, `intitucion`, `titulo`, `fecha_inicio`, `fecha_fin`, `hojade_de_vida_id_hojade_de_vida`) VALUES
(1, 'Universidad A', 'Ingeniería de Software', '2010-01-01', '2014-12-31', 1),
(2, 'Universidad B', 'Diseño Gráfico', '2011-01-01', '2015-12-31', 2),
(3, 'Universidad C', 'Data Science', '2012-01-01', '2016-12-31', 3),
(4, 'Universidad D', 'Gestión de Proyectos', '2013-01-01', '2017-12-31', 4),
(5, 'Universidad E', 'Marketing Digital', '2014-01-01', '2018-12-31', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `experiencia_laboral`
--

CREATE TABLE `experiencia_laboral` (
  `idexperiencia_laboral` int(11) NOT NULL,
  `empresa` varchar(50) DEFAULT NULL,
  `cargo` varchar(45) DEFAULT NULL,
  `ubicacion_empleo` varchar(45) DEFAULT NULL,
  `descripcion_labor` varchar(45) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `hojade_de_vida_id_hojade_de_vida` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `experiencia_laboral`
--

INSERT INTO `experiencia_laboral` (`idexperiencia_laboral`, `empresa`, `cargo`, `ubicacion_empleo`, `descripcion_labor`, `fecha_inicio`, `fecha_fin`, `hojade_de_vida_id_hojade_de_vida`) VALUES
(1, 'Empresa A', 'Desarrollador', 'Ciudad A', 'Desarrollo de aplicaciones web', '2015-01-01', '2018-12-31', 1),
(2, 'Empresa B', 'Diseñador', 'Ciudad B', 'Diseño de interfaces', '2016-01-01', '2019-12-31', 2),
(3, 'Empresa C', 'Analista', 'Ciudad C', 'Análisis de datos', '2017-01-01', '2020-12-31', 3),
(4, 'Empresa D', 'Gerente', 'Ciudad D', 'Gestión de proyectos', '2018-01-01', '2021-12-31', 4),
(5, 'Empresa E', 'Especialista en Marketing', 'Ciudad E', 'Gestión de campañas digitales', '2019-01-01', '2022-12-31', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hojade_de_vida`
--

CREATE TABLE `hojade_de_vida` (
  `id_hojade_de_vida` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido` varchar(50) DEFAULT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  `telefono` decimal(10,0) DEFAULT NULL,
  `correo` varchar(1000) DEFAULT NULL,
  `estado_civil` varchar(45) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `nacionalidad` varchar(45) DEFAULT NULL,
  `descripcion_sobre_ti` varchar(500) DEFAULT NULL,
  `objetivo_profecional` varchar(500) DEFAULT NULL,
  `idiomas` varchar(45) DEFAULT NULL,
  `referencias` varchar(45) DEFAULT NULL,
  `parentezco` varchar(45) DEFAULT NULL,
  `numero_referencia` varchar(45) DEFAULT NULL,
  `intereses_personales` varchar(500) DEFAULT NULL,
  `disponibilidad_trabajo` varchar(45) DEFAULT NULL,
  `usuario_id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `hojade_de_vida`
--

INSERT INTO `hojade_de_vida` (`id_hojade_de_vida`, `nombre`, `apellido`, `direccion`, `telefono`, `correo`, `estado_civil`, `fecha_nacimiento`, `nacionalidad`, `descripcion_sobre_ti`, `objetivo_profecional`, `idiomas`, `referencias`, `parentezco`, `numero_referencia`, `intereses_personales`, `disponibilidad_trabajo`, `usuario_id_usuario`) VALUES
(1, 'Juan', 'Pérez', 'Calle 1', 1234567890, 'juan.perez@example.com', 'Soltero', '1990-01-01', 'Española', 'Descripción Juan', 'Objetivo Juan', 'Español, Inglés', 'Referencia 1', 'Amigo', '123456789', 'Deportes', 'Inmediata', 1),
(2, 'Ana', 'Gómez', 'Calle 2', 1234567891, 'ana.gomez@example.com', 'Casada', '1992-02-02', 'Mexicana', 'Descripción Ana', 'Objetivo Ana', 'Español', 'Referencia 2', 'Colega', '987654321', 'Lectura', 'En 1 mes', 2),
(3, 'Luis', 'Martínez', 'Calle 3', 1234567892, 'luis.martinez@example.com', 'Soltero', '1991-03-03', 'Colombiana', 'Descripción Luis', 'Objetivo Luis', 'Español', 'Referencia 3', 'Familiar', '456789123', 'Música', 'En 2 semanas', 3),
(4, 'Marta', 'Fernández', 'Calle 4', 1234567893, 'marta.fernandez@example.com', 'Divorciada', '1990-04-04', 'Argentina', 'Descripción Marta', 'Objetivo Marta', 'Español, Inglés', 'Referencia 4', 'Ex jefe', '321654987', 'Viajes', 'En 3 semanas', 4),
(5, 'Carlos', 'Ruiz', 'Calle 5', 1234567894, 'carlos.ruiz@example.com', 'Soltero', '1993-05-05', 'Chileno', 'Descripción Carlos', 'Objetivo Carlos', 'Español', 'Referencia 5', 'Amigo', '789456123', 'Tecnología', 'Inmediata', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hojade_de_vida_has_oferta_empleo`
--

CREATE TABLE `hojade_de_vida_has_oferta_empleo` (
  `hojade_de_vida_id_hojade_de_vida` int(11) NOT NULL,
  `oferta_empleo_id_oferta_empleo` int(11) NOT NULL,
  `oferta_empleo_hojade_de_vida_id_hojade_de_vida` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `hojade_de_vida_has_oferta_empleo`
--

INSERT INTO `hojade_de_vida_has_oferta_empleo` (`hojade_de_vida_id_hojade_de_vida`, `oferta_empleo_id_oferta_empleo`, `oferta_empleo_hojade_de_vida_id_hojade_de_vida`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 4),
(5, 5, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `id_mensajes` int(11) NOT NULL,
  `id_receptor` int(11) DEFAULT NULL,
  `id_interceptor` int(11) DEFAULT NULL,
  `fecha_envio` date DEFAULT NULL,
  `contenido` varchar(1000) DEFAULT NULL,
  `usuario_id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `mensajes`
--

INSERT INTO `mensajes` (`id_mensajes`, `id_receptor`, `id_interceptor`, `fecha_envio`, `contenido`, `usuario_id_usuario`) VALUES
(1, 2, 1, '2024-08-13', 'Mensaje de prueba 1', 1),
(2, 3, 2, '2024-08-13', 'Mensaje de prueba 2', 2),
(3, 4, 3, '2024-08-13', 'Mensaje de prueba 3', 3),
(4, 5, 4, '2024-08-13', 'Mensaje de prueba 4', 4),
(5, 1, 5, '2024-08-13', 'Mensaje de prueba 5', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `idnotificaciones` int(11) NOT NULL,
  `contenido` varchar(200) NOT NULL,
  `fecha_envio` date DEFAULT NULL,
  `usuario_id_usuario` int(11) NOT NULL,
  `tipo notificacion_idTip notificacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `notificaciones`
--

INSERT INTO `notificaciones` (`idnotificaciones`, `contenido`, `fecha_envio`, `usuario_id_usuario`, `tipo notificacion_idTip notificacion`) VALUES
(1, 'Notificación de prueba 1', '2024-08-13', 1, 1),
(2, 'Notificación de prueba 2', '2024-08-13', 2, 2),
(3, 'Notificación de prueba 3', '2024-08-13', 3, 3),
(4, 'Notificación de prueba 4', '2024-08-13', 4, 4),
(5, 'Notificación de prueba 5', '2024-08-13', 5, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oferta_empleo`
--

CREATE TABLE `oferta_empleo` (
  `id_oferta_empleo` int(11) NOT NULL,
  `titulo_emp` varchar(45) DEFAULT NULL,
  `descripción` varchar(500) DEFAULT NULL,
  `requisitos` varchar(500) DEFAULT NULL,
  `ubicacion` varchar(45) DEFAULT NULL,
  `salario` int(11) DEFAULT NULL,
  `oferta_empleocol` varchar(45) DEFAULT NULL,
  `hojade_de_vida_id_hojade_de_vida` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `oferta_empleo`
--

INSERT INTO `oferta_empleo` (`id_oferta_empleo`, `titulo_emp`, `descripción`, `requisitos`, `ubicacion`, `salario`, `oferta_empleocol`, `hojade_de_vida_id_hojade_de_vida`) VALUES
(1, 'Desarrollador Web', 'Desarrollador con experiencia en PHP', 'Conocimiento en PHP y MySQL', 'Ciudad A', 50000, 'Desarrollo', 1),
(2, 'Diseñador UI/UX', 'Diseñador con habilidades en diseño gráfico', 'Experiencia en Adobe XD', 'Ciudad B', 45000, 'Diseño', 2),
(3, 'Analista de Datos', 'Analista con experiencia en SQL', 'Conocimiento en SQL y Python', 'Ciudad C', 60000, 'Análisis', 3),
(4, 'Gerente de Proyecto', 'Gerente con experiencia en gestión de proyectos', 'Certificación PMP', 'Ciudad D', 70000, 'Gestión', 4),
(5, 'Marketing Digital', 'Especialista en marketing en redes sociales', 'Experiencia en Facebook Ads', 'Ciudad E', 40000, 'Marketing', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oferta_empleo_has_sub_cat`
--

CREATE TABLE `oferta_empleo_has_sub_cat` (
  `oferta_empleo_id_oferta_empleo` int(11) NOT NULL,
  `oferta_empleo_hojade_de_vida_id_hojade_de_vida` int(11) NOT NULL,
  `sub_cat_id_sub_cat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `oferta_empleo_has_sub_cat`
--

INSERT INTO `oferta_empleo_has_sub_cat` (`oferta_empleo_id_oferta_empleo`, `oferta_empleo_hojade_de_vida_id_hojade_de_vida`, `sub_cat_id_sub_cat`) VALUES
(1, 1, 1),
(2, 2, 4),
(3, 3, 2),
(4, 4, 3),
(5, 5, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `nombre_rol` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `nombre_rol`) VALUES
(1, 'Administrador'),
(2, 'Usuario'),
(3, 'Supervisor'),
(4, 'Gerente'),
(5, 'Invitado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_has_usuario`
--

CREATE TABLE `rol_has_usuario` (
  `rol_id_rol` int(11) NOT NULL,
  `usuario_id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `rol_has_usuario`
--

INSERT INTO `rol_has_usuario` (`rol_id_rol`, `usuario_id_usuario`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sub_cat`
--

CREATE TABLE `sub_cat` (
  `id_sub_cat` int(11) NOT NULL,
  `nombre_sub_cat` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `sub_cat`
--

INSERT INTO `sub_cat` (`id_sub_cat`, `nombre_sub_cat`) VALUES
(1, 'Frontend'),
(2, 'Backend'),
(3, 'Full Stack'),
(4, 'UX Design'),
(5, 'Social Media');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo notificacion`
--

CREATE TABLE `tipo notificacion` (
  `idTip notificacion` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `tipo notificacioncol` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tipo notificacion`
--

INSERT INTO `tipo notificacion` (`idTip notificacion`, `nombre`, `descripcion`, `tipo notificacioncol`) VALUES
(1, 'Alerta', 'Notificación de alerta', 'Alerta'),
(2, 'Recordatorio', 'Notificación de recordatorio', 'Recordatorio'),
(3, 'Mensaje', 'Notificación de mensaje', 'Mensaje'),
(4, 'Actualización', 'Notificación de actualización', 'Actualización'),
(5, 'Notificación General', 'Notificación general', 'General');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `usuario` varchar(45) DEFAULT NULL,
  `correo` varchar(45) DEFAULT NULL,
  `contraseña` varchar(45) DEFAULT NULL,
  `rol` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `usuario`, `correo`, `contraseña`, `rol`) VALUES
(2, 'kevin', 'asmith@example.com', 'password2', '2'),
(3, 'bwhite', 'bwhite@example.com', 'password3', '3'),
(4, 'cjohnson', 'cjohnson@example.com', 'password4', '4'),
(5, 'dgreen', 'dgreen@example.com', 'password5', '5'),
(6, 'ss', 'ss@s', 'ss', 'ss');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  ADD PRIMARY KEY (`idcalificaciones`,`usuario_id_usuario`,`empresa_id_empresa`,`empresa_rol_id_rol`),
  ADD KEY `fk_calificaciones_usuario1_idx` (`usuario_id_usuario`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categora`,`oferta_empleo_id_oferta_empleo`,`oferta_empleo_hojade_de_vida_id_hojade_de_vida`),
  ADD KEY `fk_categora_oferta_empleo1_idx` (`oferta_empleo_id_oferta_empleo`,`oferta_empleo_hojade_de_vida_id_hojade_de_vida`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`usuario_id_usuario`);

--
-- Indices de la tabla `estudios`
--
ALTER TABLE `estudios`
  ADD PRIMARY KEY (`idEstudios`),
  ADD KEY `fk_Estudios_hojade_de_vida1_idx` (`hojade_de_vida_id_hojade_de_vida`);

--
-- Indices de la tabla `experiencia_laboral`
--
ALTER TABLE `experiencia_laboral`
  ADD PRIMARY KEY (`idexperiencia_laboral`),
  ADD KEY `fk_experiencia_laboral_hojade_de_vida1_idx` (`hojade_de_vida_id_hojade_de_vida`);

--
-- Indices de la tabla `hojade_de_vida`
--
ALTER TABLE `hojade_de_vida`
  ADD PRIMARY KEY (`id_hojade_de_vida`,`usuario_id_usuario`),
  ADD KEY `fk_hojade_de_vida_usuario1_idx` (`usuario_id_usuario`);

--
-- Indices de la tabla `hojade_de_vida_has_oferta_empleo`
--
ALTER TABLE `hojade_de_vida_has_oferta_empleo`
  ADD PRIMARY KEY (`hojade_de_vida_id_hojade_de_vida`,`oferta_empleo_id_oferta_empleo`,`oferta_empleo_hojade_de_vida_id_hojade_de_vida`),
  ADD KEY `fk_hojade_de_vida_has_oferta_empleo_oferta_empleo1_idx` (`oferta_empleo_id_oferta_empleo`,`oferta_empleo_hojade_de_vida_id_hojade_de_vida`),
  ADD KEY `fk_hojade_de_vida_has_oferta_empleo_hojade_de_vida1_idx` (`hojade_de_vida_id_hojade_de_vida`);

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`id_mensajes`,`usuario_id_usuario`),
  ADD KEY `fk_mensajes_usuario1_idx` (`usuario_id_usuario`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`idnotificaciones`,`usuario_id_usuario`,`tipo notificacion_idTip notificacion`),
  ADD KEY `fk_notificaciones_usuario1_idx` (`usuario_id_usuario`),
  ADD KEY `fk_notificaciones_tipo notificacion1_idx` (`tipo notificacion_idTip notificacion`);

--
-- Indices de la tabla `oferta_empleo`
--
ALTER TABLE `oferta_empleo`
  ADD PRIMARY KEY (`id_oferta_empleo`,`hojade_de_vida_id_hojade_de_vida`);

--
-- Indices de la tabla `oferta_empleo_has_sub_cat`
--
ALTER TABLE `oferta_empleo_has_sub_cat`
  ADD PRIMARY KEY (`oferta_empleo_id_oferta_empleo`,`oferta_empleo_hojade_de_vida_id_hojade_de_vida`,`sub_cat_id_sub_cat`),
  ADD KEY `fk_oferta_empleo_has_sub_cat_sub_cat1_idx` (`sub_cat_id_sub_cat`),
  ADD KEY `fk_oferta_empleo_has_sub_cat_oferta_empleo1_idx` (`oferta_empleo_id_oferta_empleo`,`oferta_empleo_hojade_de_vida_id_hojade_de_vida`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `rol_has_usuario`
--
ALTER TABLE `rol_has_usuario`
  ADD PRIMARY KEY (`rol_id_rol`,`usuario_id_usuario`),
  ADD KEY `fk_rol_has_usuario_usuario1_idx` (`usuario_id_usuario`),
  ADD KEY `fk_rol_has_usuario_rol1_idx` (`rol_id_rol`);

--
-- Indices de la tabla `sub_cat`
--
ALTER TABLE `sub_cat`
  ADD PRIMARY KEY (`id_sub_cat`);

--
-- Indices de la tabla `tipo notificacion`
--
ALTER TABLE `tipo notificacion`
  ADD PRIMARY KEY (`idTip notificacion`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  MODIFY `idcalificaciones` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `usuario_id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `estudios`
--
ALTER TABLE `estudios`
  MODIFY `idEstudios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `experiencia_laboral`
--
ALTER TABLE `experiencia_laboral`
  MODIFY `idexperiencia_laboral` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `idnotificaciones` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tipo notificacion`
--
ALTER TABLE `tipo notificacion`
  MODIFY `idTip notificacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  ADD CONSTRAINT `fk_calificaciones_usuario1` FOREIGN KEY (`usuario_id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD CONSTRAINT `fk_categora_oferta_empleo1` FOREIGN KEY (`oferta_empleo_id_oferta_empleo`,`oferta_empleo_hojade_de_vida_id_hojade_de_vida`) REFERENCES `oferta_empleo` (`id_oferta_empleo`, `hojade_de_vida_id_hojade_de_vida`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD CONSTRAINT `fk_empresa_usuario1` FOREIGN KEY (`usuario_id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `estudios`
--
ALTER TABLE `estudios`
  ADD CONSTRAINT `fk_Estudios_hojade_de_vida1` FOREIGN KEY (`hojade_de_vida_id_hojade_de_vida`) REFERENCES `hojade_de_vida` (`id_hojade_de_vida`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `experiencia_laboral`
--
ALTER TABLE `experiencia_laboral`
  ADD CONSTRAINT `fk_experiencia_laboral_hojade_de_vida1` FOREIGN KEY (`hojade_de_vida_id_hojade_de_vida`) REFERENCES `hojade_de_vida` (`id_hojade_de_vida`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `hojade_de_vida`
--
ALTER TABLE `hojade_de_vida`
  ADD CONSTRAINT `fk_hojade_de_vida_usuario1` FOREIGN KEY (`usuario_id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `hojade_de_vida_has_oferta_empleo`
--
ALTER TABLE `hojade_de_vida_has_oferta_empleo`
  ADD CONSTRAINT `fk_hojade_de_vida_has_oferta_empleo_hojade_de_vida1` FOREIGN KEY (`hojade_de_vida_id_hojade_de_vida`) REFERENCES `hojade_de_vida` (`id_hojade_de_vida`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_hojade_de_vida_has_oferta_empleo_oferta_empleo1` FOREIGN KEY (`oferta_empleo_id_oferta_empleo`,`oferta_empleo_hojade_de_vida_id_hojade_de_vida`) REFERENCES `oferta_empleo` (`id_oferta_empleo`, `hojade_de_vida_id_hojade_de_vida`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD CONSTRAINT `fk_mensajes_usuario1` FOREIGN KEY (`usuario_id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD CONSTRAINT `fk_notificaciones_tipo notificacion1` FOREIGN KEY (`tipo notificacion_idTip notificacion`) REFERENCES `tipo notificacion` (`idTip notificacion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_notificaciones_usuario1` FOREIGN KEY (`usuario_id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `oferta_empleo_has_sub_cat`
--
ALTER TABLE `oferta_empleo_has_sub_cat`
  ADD CONSTRAINT `fk_oferta_empleo_has_sub_cat_oferta_empleo1` FOREIGN KEY (`oferta_empleo_id_oferta_empleo`,`oferta_empleo_hojade_de_vida_id_hojade_de_vida`) REFERENCES `oferta_empleo` (`id_oferta_empleo`, `hojade_de_vida_id_hojade_de_vida`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_oferta_empleo_has_sub_cat_sub_cat1` FOREIGN KEY (`sub_cat_id_sub_cat`) REFERENCES `sub_cat` (`id_sub_cat`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `rol_has_usuario`
--
ALTER TABLE `rol_has_usuario`
  ADD CONSTRAINT `fk_rol_has_usuario_rol1` FOREIGN KEY (`rol_id_rol`) REFERENCES `rol` (`id_rol`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_rol_has_usuario_usuario1` FOREIGN KEY (`usuario_id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
