-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-10-2024 a las 05:54:04
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

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

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizar_calificacion` (IN `p_idcalificaciones` INT, IN `p_calificacion` INT, IN `p_comentario` VARCHAR(400), IN `p_fecha` DATE, IN `p_oferta_empleo_id` INT, IN `p_usuario_id` INT)   BEGIN
    UPDATE calificaciones
    SET calificacion = p_calificacion, comentario = p_comentario, fecha = p_fecha, 
        oferta_empleo_id_oferta_empleo = p_oferta_empleo_id, usuario_id_usuario = p_usuario_id
    WHERE idcalificaciones = p_idcalificaciones;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizar_categoria` (IN `p_id_categoria` INT, IN `p_nombre_cat` VARCHAR(45))   BEGIN
    UPDATE categoria
    SET nombre_cat = p_nombre_cat
    WHERE id_categora = p_id_categoria;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizar_empresa` (IN `p_id_empresa` INT, IN `p_nombre_emp` VARCHAR(45), IN `p_industria` VARCHAR(500), IN `p_ubicacion` VARCHAR(45), IN `p_tamano_emp` VARCHAR(45), IN `p_descripcion_emp` VARCHAR(45), IN `p_contacto` VARCHAR(100), IN `p_correo` VARCHAR(45), IN `p_sitio_web_of` VARCHAR(45), IN `p_antecedentes` VARCHAR(500), IN `p_mision` VARCHAR(100), IN `p_vision` VARCHAR(100), IN `p_regionales` VARCHAR(500), IN `p_hitos_significativos` VARCHAR(100), IN `p_innovaciones_recientes` VARCHAR(100), IN `p_beneficios_empleados` VARCHAR(500), IN `p_usuario_id_usuario` INT)   BEGIN
    UPDATE empresas
    SET nombre_emp = p_nombre_emp, industria = p_industria, ubicacion = p_ubicacion, 
        tamano_emp = p_tamano_emp, descripcion_emp = p_descripcion_emp, contacto = p_contacto, 
        correo = p_correo, sitio_web_of = p_sitio_web_of, antecedentes = p_antecedentes, 
        mision = p_mision, vision = p_vision, regionales = p_regionales, 
        hitos_significativos = p_hitos_significativos, innovaciones_recientes = p_innovaciones_recientes, 
        beneficios_empleados = p_beneficios_empleados, usuario_id_usuario = p_usuario_id_usuario
    WHERE id_empresa = p_id_empresa;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizar_estudio` (IN `p_id_estudios` INT, IN `p_institucion` VARCHAR(45), IN `p_titulo` VARCHAR(45), IN `p_fecha_inicio` DATE, IN `p_fecha_fin` DATE, IN `p_hojade_de_vida_id` INT)   BEGIN
    UPDATE estudios
    SET intitucion = p_institucion, titulo = p_titulo, fecha_inicio = p_fecha_inicio, fecha_fin = p_fecha_fin, 
        hojade_de_vida_id_hojade_de_vida = p_hojade_de_vida_id
    WHERE idEstudios = p_id_estudios;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizar_experiencia` (IN `p_id_experiencia` INT, IN `p_empresa` VARCHAR(50), IN `p_cargo` VARCHAR(45), IN `p_ubicacion_empleo` VARCHAR(45), IN `p_descripcion_labor` VARCHAR(45), IN `p_fecha_inicio` DATE, IN `p_fecha_fin` DATE, IN `p_hojade_de_vida_id` INT)   BEGIN
    UPDATE experiencia_laboral
    SET empresa = p_empresa, cargo = p_cargo, ubicacion_empleo = p_ubicacion_empleo, 
        descripcion_labor = p_descripcion_labor, fecha_inicio = p_fecha_inicio, fecha_fin = p_fecha_fin, 
        hojade_de_vida_id_hojade_de_vida = p_hojade_de_vida_id
    WHERE idexperiencia_laboral = p_id_experiencia;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizar_hojade_de_vida` (IN `p_id_hojade_de_vida` INT, IN `p_nombre` VARCHAR(50), IN `p_apellido` VARCHAR(50), IN `p_direccion` VARCHAR(45), IN `p_telefono` DECIMAL(10,0), IN `p_correo` VARCHAR(1000), IN `p_estado_civil` VARCHAR(45), IN `p_fecha_nacimiento` DATE, IN `p_nacionalidad` VARCHAR(45), IN `p_descripcion_sobre_ti` VARCHAR(500), IN `p_objetivo_profecional` VARCHAR(500), IN `p_idiomas` VARCHAR(45), IN `p_referencias` VARCHAR(45), IN `p_parentezco` VARCHAR(45), IN `p_numero_referencia` VARCHAR(45), IN `p_intereses_personales` VARCHAR(500), IN `p_disponibilidad_trabajo` VARCHAR(45), IN `p_usuario_id_usuario` INT)   BEGIN
    UPDATE hojade_de_vida
    SET nombre = p_nombre, apellido = p_apellido, direccion = p_direccion, telefono = p_telefono, 
        correo = p_correo, estado_civil = p_estado_civil, fecha_nacimiento = p_fecha_nacimiento, 
        nacionalidad = p_nacionalidad, descripcion_sobre_ti = p_descripcion_sobre_ti, 
        objetivo_profecional = p_objetivo_profecional, idiomas = p_idiomas, referencias = p_referencias, 
        parentezco = p_parentezco, numero_referencia = p_numero_referencia, 
        intereses_personales = p_intereses_personales, disponibilidad_trabajo = p_disponibilidad_trabajo, 
        usuario_id_usuario = p_usuario_id_usuario
    WHERE id_hojade_de_vida = p_id_hojade_de_vida;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizar_mensaje` (IN `p_id_mensajes` INT, IN `p_id_receptor` INT, IN `p_id_interceptor` INT, IN `p_contenido` VARCHAR(500), IN `p_fecha_envio` DATETIME, IN `p_visto` TINYINT(1))   BEGIN
    UPDATE mensajes
    SET id_receptor = p_id_receptor, id_interceptor = p_id_interceptor, 
        contenido = p_contenido, fecha_envio = p_fecha_envio, visto = p_visto
    WHERE id_mensajes = p_id_mensajes;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizar_notificacion` (IN `p_id_notificaciones` INT, IN `p_contenido` VARCHAR(200), IN `p_fecha_envio` DATE, IN `p_usuario_id` INT)   BEGIN
    UPDATE notificaciones
    SET contenido = p_contenido, fecha_envio = p_fecha_envio, usuario_id_usuario = p_usuario_id
    WHERE idnotificaciones = p_id_notificaciones;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizar_oferta_empleo` (IN `p_id_oferta_empleo` INT, IN `p_titulo_emp` VARCHAR(45), IN `p_descripcion` VARCHAR(500), IN `p_requisitos` VARCHAR(500), IN `p_ubicacion` VARCHAR(45), IN `p_salario` DOUBLE, IN `p_oferta_empleocol` VARCHAR(250), IN `p_telefono` INT, IN `p_correo` VARCHAR(250), IN `p_sub_cat_id_sub_cat` INT)   BEGIN
    UPDATE oferta_empleo
    SET titulo_emp = p_titulo_emp, descripcion = p_descripcion, requisitos = p_requisitos, 
        ubicacion = p_ubicacion, salario = p_salario, oferta_empleocol = p_oferta_empleocol, 
        telefono = p_telefono, correo = p_correo, sub_cat_id_sub_cat = p_sub_cat_id_sub_cat
    WHERE id_oferta_empleo = p_id_oferta_empleo;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizar_rol` (IN `p_id_rol` INT, IN `p_nombre_rol` VARCHAR(50))   BEGIN
    UPDATE rol
    SET nombre_rol = p_nombre_rol
    WHERE id_rol = p_id_rol;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizar_sub_cat` (IN `p_id_sub_cat` INT, IN `p_nombre_sub_cat` VARCHAR(45), IN `p_categoria_id_categora` INT)   BEGIN
    UPDATE sub_cat
    SET nombre_sub_cat = p_nombre_sub_cat, categoria_id_categora = p_categoria_id_categora
    WHERE id_sub_cat = p_id_sub_cat;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizar_usuario` (IN `p_id_usuario` INT, IN `p_usuario` VARCHAR(45), IN `p_correo` VARCHAR(45), IN `p_contrasena` VARCHAR(250), IN `p_rol_id_rol` INT)   BEGIN
    UPDATE usuario
    SET usuario = p_usuario, correo = p_correo, contrasena = p_contrasena, rol_id_rol = p_rol_id_rol
    WHERE id_usuario = p_id_usuario;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminar_calificacion` (IN `p_idcalificaciones` INT)   BEGIN
    DELETE FROM calificaciones WHERE idcalificaciones = p_idcalificaciones;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminar_categoria` (IN `p_id_categoria` INT)   BEGIN
    DELETE FROM categoria WHERE id_categora = p_id_categoria;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminar_empresa` (IN `p_id_empresa` INT)   BEGIN
    DELETE FROM empresas WHERE id_empresa = p_id_empresa;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminar_estudio` (IN `p_id_estudios` INT)   BEGIN
    DELETE FROM estudios WHERE idEstudios = p_id_estudios;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminar_experiencia` (IN `p_id_experiencia` INT)   BEGIN
    DELETE FROM experiencia_laboral WHERE idexperiencia_laboral = p_id_experiencia;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminar_hojade_de_vida` (IN `p_id_hojade_de_vida` INT)   BEGIN
    DELETE FROM hojade_de_vida WHERE id_hojade_de_vida = p_id_hojade_de_vida;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminar_mensaje` (IN `p_id_mensajes` INT)   BEGIN
    DELETE FROM mensajes WHERE id_mensajes = p_id_mensajes;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminar_notificacion` (IN `p_id_notificaciones` INT)   BEGIN
    DELETE FROM notificaciones WHERE idnotificaciones = p_id_notificaciones;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminar_oferta_empleo` (IN `p_id_oferta_empleo` INT)   BEGIN
    DELETE FROM oferta_empleo WHERE id_oferta_empleo = p_id_oferta_empleo;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminar_rol` (IN `p_id_rol` INT)   BEGIN
    DELETE FROM rol WHERE id_rol = p_id_rol;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminar_sub_cat` (IN `p_id_sub_cat` INT)   BEGIN
    DELETE FROM sub_cat WHERE id_sub_cat = p_id_sub_cat;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminar_usuario` (IN `p_id_usuario` INT)   BEGIN
    DELETE FROM usuario WHERE id_usuario = p_id_usuario;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertar_calificacion` (IN `p_calificacion` INT, IN `p_comentario` VARCHAR(400), IN `p_fecha` DATE, IN `p_oferta_empleo_id` INT, IN `p_usuario_id` INT)   BEGIN
    INSERT INTO calificaciones (calificacion, comentario, fecha, oferta_empleo_id_oferta_empleo, usuario_id_usuario)
    VALUES (p_calificacion, p_comentario, p_fecha, p_oferta_empleo_id, p_usuario_id);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertar_categoria` (IN `p_nombre_cat` VARCHAR(45))   BEGIN
    INSERT INTO categoria (nombre_cat) VALUES (p_nombre_cat);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertar_empresa` (IN `p_nombre_emp` VARCHAR(45), IN `p_industria` VARCHAR(500), IN `p_ubicacion` VARCHAR(45), IN `p_tamano_emp` VARCHAR(45), IN `p_descripcion_emp` VARCHAR(45), IN `p_contacto` VARCHAR(100), IN `p_correo` VARCHAR(45), IN `p_sitio_web_of` VARCHAR(45), IN `p_antecedentes` VARCHAR(500), IN `p_mision` VARCHAR(100), IN `p_vision` VARCHAR(100), IN `p_regionales` VARCHAR(500), IN `p_hitos_significativos` VARCHAR(100), IN `p_innovaciones_recientes` VARCHAR(100), IN `p_beneficios_empleados` VARCHAR(500), IN `p_usuario_id_usuario` INT)   BEGIN
    INSERT INTO empresas (nombre_emp, industria, ubicacion, tamano_emp, descripcion_emp, contacto, correo, sitio_web_of, antecedentes, mision, vision, regionales, hitos_significativos, innovaciones_recientes, beneficios_empleados, usuario_id_usuario)
    VALUES (p_nombre_emp, p_industria, p_ubicacion, p_tamano_emp, p_descripcion_emp, p_contacto, p_correo, p_sitio_web_of, p_antecedentes, p_mision, p_vision, p_regionales, p_hitos_significativos, p_innovaciones_recientes, p_beneficios_empleados, p_usuario_id_usuario);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertar_estudio` (IN `p_institucion` VARCHAR(45), IN `p_titulo` VARCHAR(45), IN `p_fecha_inicio` DATE, IN `p_fecha_fin` DATE, IN `p_hojade_de_vida_id` INT)   BEGIN
    INSERT INTO estudios (intitucion, titulo, fecha_inicio, fecha_fin, hojade_de_vida_id_hojade_de_vida)
    VALUES (p_institucion, p_titulo, p_fecha_inicio, p_fecha_fin, p_hojade_de_vida_id);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertar_experiencia` (IN `p_empresa` VARCHAR(50), IN `p_cargo` VARCHAR(45), IN `p_ubicacion_empleo` VARCHAR(45), IN `p_descripcion_labor` VARCHAR(45), IN `p_fecha_inicio` DATE, IN `p_fecha_fin` DATE, IN `p_hojade_de_vida_id` INT)   BEGIN
    INSERT INTO experiencia_laboral (empresa, cargo, ubicacion_empleo, descripcion_labor, fecha_inicio, fecha_fin, hojade_de_vida_id_hojade_de_vida)
    VALUES (p_empresa, p_cargo, p_ubicacion_empleo, p_descripcion_labor, p_fecha_inicio, p_fecha_fin, p_hojade_de_vida_id);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertar_hojade_de_vida` (IN `p_nombre` VARCHAR(50), IN `p_apellido` VARCHAR(50), IN `p_direccion` VARCHAR(45), IN `p_telefono` DECIMAL(10,0), IN `p_correo` VARCHAR(1000), IN `p_estado_civil` VARCHAR(45), IN `p_fecha_nacimiento` DATE, IN `p_nacionalidad` VARCHAR(45), IN `p_descripcion_sobre_ti` VARCHAR(500), IN `p_objetivo_profecional` VARCHAR(500), IN `p_idiomas` VARCHAR(45), IN `p_referencias` VARCHAR(45), IN `p_parentezco` VARCHAR(45), IN `p_numero_referencia` VARCHAR(45), IN `p_intereses_personales` VARCHAR(500), IN `p_disponibilidad_trabajo` VARCHAR(45), IN `p_usuario_id_usuario` INT)   BEGIN
    INSERT INTO hojade_de_vida (nombre, apellido, direccion, telefono, correo, estado_civil, fecha_nacimiento, nacionalidad, descripcion_sobre_ti, objetivo_profecional, idiomas, referencias, parentezco, numero_referencia, intereses_personales, disponibilidad_trabajo, usuario_id_usuario)
    VALUES (p_nombre, p_apellido, p_direccion, p_telefono, p_correo, p_estado_civil, p_fecha_nacimiento, p_nacionalidad, p_descripcion_sobre_ti, p_objetivo_profecional, p_idiomas, p_referencias, p_parentezco, p_numero_referencia, p_intereses_personales, p_disponibilidad_trabajo, p_usuario_id_usuario);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertar_mensaje` (IN `p_id_receptor` INT, IN `p_id_interceptor` INT, IN `p_contenido` VARCHAR(500), IN `p_fecha_envio` DATETIME, IN `p_visto` TINYINT(1))   BEGIN
    INSERT INTO mensajes (id_receptor, id_interceptor, contenido, fecha_envio, visto)
    VALUES (p_id_receptor, p_id_interceptor, p_contenido, p_fecha_envio, p_visto);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertar_notificacion` (IN `p_contenido` VARCHAR(200), IN `p_fecha_envio` DATE, IN `p_usuario_id` INT)   BEGIN
    INSERT INTO notificaciones (contenido, fecha_envio, usuario_id_usuario)
    VALUES (p_contenido, p_fecha_envio, p_usuario_id);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertar_oferta_empleo` (IN `p_titulo_emp` VARCHAR(45), IN `p_descripcion` VARCHAR(500), IN `p_requisitos` VARCHAR(500), IN `p_ubicacion` VARCHAR(45), IN `p_salario` DOUBLE, IN `p_oferta_empleocol` VARCHAR(250), IN `p_telefono` INT, IN `p_correo` VARCHAR(250), IN `p_sub_cat_id_sub_cat` INT)   BEGIN
    INSERT INTO oferta_empleo (titulo_emp, descripcion, requisitos, ubicacion, salario, oferta_empleocol, telefono, correo, sub_cat_id_sub_cat)
    VALUES (p_titulo_emp, p_descripcion, p_requisitos, p_ubicacion, p_salario, p_oferta_empleocol, p_telefono, p_correo, p_sub_cat_id_sub_cat);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertar_rol` (IN `p_nombre_rol` VARCHAR(50))   BEGIN
    INSERT INTO rol (nombre_rol)
    VALUES (p_nombre_rol);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertar_sub_cat` (IN `p_nombre_sub_cat` VARCHAR(45), IN `p_categoria_id_categora` INT)   BEGIN
    INSERT INTO sub_cat (nombre_sub_cat, categoria_id_categora)
    VALUES (p_nombre_sub_cat, p_categoria_id_categora);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertar_usuario` (IN `p_usuario` VARCHAR(45), IN `p_correo` VARCHAR(45), IN `p_contrasena` VARCHAR(250), IN `p_rol_id_rol` INT)   BEGIN
    INSERT INTO usuario (usuario, correo, contrasena, rol_id_rol)
    VALUES (p_usuario, p_correo, p_contrasena, p_rol_id_rol);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `obtener_calificaciones` ()   BEGIN
    SELECT * FROM calificaciones;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `obtener_categorias` ()   BEGIN
    SELECT * FROM categoria;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `obtener_empresas` ()   BEGIN
    SELECT * FROM empresas;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `obtener_estudios` ()   BEGIN
    SELECT * FROM estudios;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `obtener_experiencias` ()   BEGIN
    SELECT * FROM experiencia_laboral;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `obtener_hojas_de_vida` ()   BEGIN
    SELECT * FROM hojade_de_vida;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `obtener_mensajes` ()   BEGIN
    SELECT * FROM mensajes;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `obtener_notificaciones` ()   BEGIN
    SELECT * FROM notificaciones;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `obtener_oferta_empleo` ()   BEGIN
    SELECT * FROM oferta_empleo;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `obtener_rol` ()   BEGIN
    SELECT * FROM rol;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `obtener_sub_cat` ()   BEGIN
    SELECT * FROM sub_cat;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `obtener_usuario` ()   BEGIN
    SELECT * FROM usuario;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificaciones`
--

CREATE TABLE `calificaciones` (
  `idcalificaciones` int(11) NOT NULL,
  `calificacion` int(11) NOT NULL,
  `comentario` varchar(400) NOT NULL,
  `fecha` date NOT NULL,
  `oferta_empleo_id_oferta_empleo` int(11) NOT NULL,
  `usuario_id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `calificaciones`
--

INSERT INTO `calificaciones` (`idcalificaciones`, `calificacion`, `comentario`, `fecha`, `oferta_empleo_id_oferta_empleo`, `usuario_id_usuario`) VALUES
(1, 3, 'Podría Mejorar', '2024-09-01', 1, 6),
(2, 4, 'Excelente', '2024-09-05', 2, 8),
(3, 2, 'Desagradable', '2024-09-10', 3, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categora` int(11) NOT NULL,
  `nombre_cat` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categora`, `nombre_cat`) VALUES
(15, 'Desarrollo de Software'),
(16, 'Atención al Cliente'),
(17, 'Marketing'),
(18, 'Recursos Humanos'),
(19, 'Ventas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE `empresas` (
  `id_empresa` int(11) NOT NULL,
  `nombre_emp` varchar(45) DEFAULT NULL,
  `industria` varchar(500) DEFAULT NULL,
  `ubicacion` varchar(45) DEFAULT NULL,
  `tamano_emp` varchar(45) DEFAULT NULL,
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
  `beneficios_empleados` varchar(500) DEFAULT NULL,
  `usuario_id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `empresas`
--

INSERT INTO `empresas` (`id_empresa`, `nombre_emp`, `industria`, `ubicacion`, `tamano_emp`, `descripcion_emp`, `contacto`, `correo`, `sitio_web_of`, `antecedentes`, `mision`, `vision`, `regionales`, `hitos_significativos`, `innovaciones_recientes`, `beneficios_empleados`, `usuario_id_usuario`) VALUES
(1, 'Tech Solutions', 'Software', 'Ciudad A', '100-500', 'Empresa enfocada en soluciones tecnológicas', 'Marlon Gutierrez', 'contacto@techsolutions.com', 'www.techsolutions.com', 'Fundada en 2000', 'Ser líderes en innovación', 'Consolidarnos en el mercado', 'Región Norte', 'Primer software patentado en 2010', 'Desarrollo de IA', 'Salario competitivo', 2),
(2, 'FinCorp', 'Servicios Financieros', 'Ciudad B', '50-200', 'Servicios de asesoría financiera', 'Sofia Mendoza', 'contacto@fincorp.com', 'www.fincorp.com', 'Fundada en 1995', 'Excelencia en servicios financieros', 'Ser reconocidos globalmente', 'Región Sur', 'Apertura de oficinas internacionales en 2015', 'Integración de blockchain', 'Planes de pensiones', 4),
(3, 'HealthLife', 'Salud', 'Ciudad C', '200-1000', 'Servicios médicos integrales', 'Carlos Díaz', 'contacto@healthlife.com', 'www.healthlife.com', 'Fundada en 2010', 'Cuidar la salud de las personas', 'Crecimiento regional', 'Región Este', 'Primer centro especializado en salud digital en 2018', 'Nuevas tecnologías en telemedicina', 'Bonos por rendimiento', 7);

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
(1, 'Universidad A', 'Ingeniería de Sistemas', '2020-01-01', '2024-01-01', 1),
(2, 'Universidad B', 'Administración de Empresas', '2018-01-01', '2022-01-01', 2),
(3, 'Universidad C', 'Psicología', '2019-01-01', '2023-01-01', 3);

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
(1, 'Juan', 'Pérez', 'Calle A', 1234567890, 'juan.perez@example.com', 'Soltero', '1990-01-01', 'Mexicana', 'Desarrollador con experiencia', 'Crecimiento profesional', 'Español, Inglés', 'María López', 'Amiga', '9876543210', 'Tecnología, Videojuegos', 'Inmediata', 6),
(2, 'Ana', 'Gómez', 'Calle B', 2345678901, 'ana.gomez@example.com', 'Divorciado', '1992-02-02', 'Colombiana', 'Especialista en finanzas', 'Desarrollo en finanzas internacionales', 'Español, Francés', 'Carlos Méndez', 'Compañero de trabajo', '8765432109', 'Finanzas, Viajes', 'Inmediata', 8),
(3, 'Marcos', 'Perez', 'Calle C', 3456789012, 'carlos.diaz@example.com', 'Unión libre', '1985-03-03', 'Argentina', 'Médico especializado', 'Aportar en el área de salud digital', 'Español, Inglés', 'Lucía Torres', 'Prima', '7654321098', 'Salud, Deportes', 'Inmediata', 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hojade_de_vida_has_oferta_empleo`
--

CREATE TABLE `hojade_de_vida_has_oferta_empleo` (
  `hojade_de_vida_id_hojade_de_vida` int(11) NOT NULL,
  `oferta_empleo_id_oferta_empleo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `id_mensajes` int(11) NOT NULL,
  `id_receptor` int(11) NOT NULL,
  `id_interceptor` int(11) NOT NULL,
  `contenido` varchar(500) DEFAULT NULL,
  `fecha_envio` datetime DEFAULT NULL,
  `visto` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `idnotificaciones` int(11) NOT NULL,
  `contenido` varchar(200) NOT NULL,
  `fecha_envio` date DEFAULT NULL,
  `usuario_id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `notificaciones`
--

INSERT INTO `notificaciones` (`idnotificaciones`, `contenido`, `fecha_envio`, `usuario_id_usuario`) VALUES
(1, 'Tienes una nueva oferta de empleo', '2024-09-01', 6),
(2, 'Tu perfil ha sido actualizado', '2024-09-02', 8),
(3, 'Has recibido un mensaje', '2024-09-03', 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oferta_empleo`
--

CREATE TABLE `oferta_empleo` (
  `id_oferta_empleo` int(11) NOT NULL,
  `titulo_emp` varchar(45) DEFAULT NULL,
  `descripcion` varchar(500) DEFAULT NULL,
  `requisitos` varchar(500) DEFAULT NULL,
  `ubicacion` varchar(45) DEFAULT NULL,
  `salario` double DEFAULT NULL,
  `oferta_empleocol` varchar(250) DEFAULT NULL,
  `telefono` int(11) NOT NULL,
  `correo` varchar(250) NOT NULL,
  `sub_cat_id_sub_cat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `oferta_empleo`
--

INSERT INTO `oferta_empleo` (`id_oferta_empleo`, `titulo_emp`, `descripcion`, `requisitos`, `ubicacion`, `salario`, `oferta_empleocol`, `telefono`, `correo`, `sub_cat_id_sub_cat`) VALUES
(1, 'Tech Solutions', 'Descripción A', 'Requisitos A', 'Ciudad A', 7000000, 'uploads/66fb70efee7b2_oferta.png', 123456789, 'contacto@techsolutions.com', 41),
(2, 'FinCorp', 'Descripción B', 'Requisitos B', 'Ciudad B', 8500000, 'uploads/66fb70f4f3129_analizar_oferta2.png', 852369741, 'contacto@fincorp.com', 51),
(3, 'HealthLife', 'Descripción C', 'Requisitos C', 'Ciudad C', 6000000, 'uploads/66fb70f98588c_images.jpeg', 753912648, 'contacto@healthlife.com', 47);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `nombre_rol` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `nombre_rol`) VALUES
(1, 'admin'),
(2, 'empresa'),
(3, 'usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sub_cat`
--

CREATE TABLE `sub_cat` (
  `id_sub_cat` int(11) NOT NULL,
  `nombre_sub_cat` varchar(45) DEFAULT NULL,
  `categoria_id_categora` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `sub_cat`
--

INSERT INTO `sub_cat` (`id_sub_cat`, `nombre_sub_cat`, `categoria_id_categora`) VALUES
(35, 'Frontend Developer', 15),
(36, 'Backend Developer', 15),
(37, 'Full Stack Developer', 15),
(38, 'Desarrollador de Aplicaciones Móviles', 15),
(39, 'Desarrollador de Juegos', 15),
(40, 'Soporte Técnico', 16),
(41, 'Asistente Virtual', 16),
(42, 'Servicio al Cliente por Chat/Email', 16),
(43, 'Representante de Call Center', 16),
(44, 'Coordinador de Atención al Cliente', 16),
(45, 'Especialista en SEO/SEM', 17),
(46, 'Community Manager', 17),
(47, 'Especialista en Marketing Digital', 17),
(48, 'Copywriter', 17),
(49, 'Analista de Marketing', 17),
(50, 'Reclutador', 18),
(51, 'Especialista en Nómina', 18),
(52, 'Generalista de Recursos Humanos', 18),
(53, 'Coordinador de Capacitación y Desarrollo', 18),
(54, 'Especialista en Compensaciones y Beneficios', 18),
(55, 'Ejecutivo de Ventas', 19),
(56, 'Representante de Ventas Internacionales', 19),
(57, 'Coordinador de Ventas', 19),
(58, 'Vendedor Minorista', 19),
(59, 'Asesor Comercial', 19);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `usuario` varchar(45) DEFAULT NULL,
  `correo` varchar(45) DEFAULT NULL,
  `contrasena` varchar(250) DEFAULT NULL,
  `rol_id_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `usuario`, `correo`, `contrasena`, `rol_id_rol`) VALUES
(1, 'Steven', 'steven@steven.com', '$2y$10$7EyHM8Hpqp6f4uNwZ1Xeo.F1qcfbT2f/9c0e0VfFZD2eDP2l54C5u', 1),
(2, 'Tech_Solutions', 'contacto@techsolutions.com', '$2y$10$XSS1m9o2SZigEsFgplmNKO6ys1YazBw323yJ7m7PHGK6Q4pB.795q', 2),
(3, 'Sebastian', 'sebastian@sebastian.com', '$2y$10$O9IOI7IL5sZ1SdmQX1INOuu/5kqLJ24..1H1KUWC0XAxHu3PvI7vK', 1),
(4, 'FinCorp', 'contacto@fincorp.com', '$2y$10$wvpUlgfZriJ7T4v/JUA1g.XfL9tN6wYkLf/Fe5ajbLGsSTU.asTJ.', 2),
(5, 'Fabian', 'fabian@fabian.com', '$2y$10$nxN90gry1aWW.ir8UApNVumMpyc.qjovg8eBAnwXm9LzeNdFlrFsi', 1),
(6, 'Juan Peréz', 'juan@perez.com', '$2y$10$0edlAhX84OMt/4A7ExCBCeqDX255KC1LTBmRSCEleUFedgLyiVxrO', 3),
(7, 'HealthLife', 'contacto@healthlife.com', '$2y$10$0xWWSa8N.Hmp66R.O16vlu761wVV1gSCXiGCrgdW8JfqsIPJzpYwG', 2),
(8, 'Ana 	Gómez', 'ana@gomez.com', '$2y$10$zaTiPCHNrgzqb.MLwXTz2OlgDuRR6AzuMD7ay85.iuLqnjpvdm/Fe', 3),
(9, 'Marcos Pérez', 'marcos@perez.com', '$2y$10$FUQpHnIKKPC68YRdfZR8jenD.yOiNS5xjpdpPsnalxPS.WbzEMwly', 3),
(10, 'Jonatan', 'jonatan@jonatan.com', '$2y$10$0X58rgemmkZOcGQlgqVjru6068hpZHOGmAPlaZB/T79p75aaI3dAC', 1);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_calificaciones`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_calificaciones` (
`idcalificaciones` int(11)
,`calificacion` int(11)
,`comentario` varchar(400)
,`fecha` date
,`oferta_empleo` varchar(45)
,`usuario` varchar(45)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_categoria`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_categoria` (
`id_categora` int(11)
,`nombre_cat` varchar(45)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_empresas`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_empresas` (
`id_empresa` int(11)
,`nombre_emp` varchar(45)
,`industria` varchar(500)
,`ubicacion` varchar(45)
,`tamano_emp` varchar(45)
,`descripcion_emp` varchar(45)
,`usuario` varchar(45)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_estudios`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_estudios` (
`idEstudios` int(11)
,`intitucion` varchar(45)
,`titulo` varchar(45)
,`fecha_inicio` date
,`fecha_fin` date
,`nombre` varchar(50)
,`apellido` varchar(50)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_experiencia_laboral`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_experiencia_laboral` (
`idexperiencia_laboral` int(11)
,`empresa` varchar(50)
,`cargo` varchar(45)
,`ubicacion_empleo` varchar(45)
,`descripcion_labor` varchar(45)
,`fecha_inicio` date
,`fecha_fin` date
,`hojade_de_vida_id_hojade_de_vida` int(11)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_hojade_de_vida`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_hojade_de_vida` (
`id_hojade_de_vida` int(11)
,`nombre` varchar(50)
,`apellido` varchar(50)
,`direccion` varchar(45)
,`telefono` decimal(10,0)
,`correo` varchar(1000)
,`estado_civil` varchar(45)
,`fecha_nacimiento` date
,`nacionalidad` varchar(45)
,`descripcion_sobre_ti` varchar(500)
,`objetivo_profecional` varchar(500)
,`idiomas` varchar(45)
,`referencias` varchar(45)
,`parentezco` varchar(45)
,`numero_referencia` varchar(45)
,`intereses_personales` varchar(500)
,`disponibilidad_trabajo` varchar(45)
,`usuario_id_usuario` int(11)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_mensajes`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_mensajes` (
`id_mensajes` int(11)
,`id_receptor` int(11)
,`id_interceptor` int(11)
,`contenido` varchar(500)
,`fecha_envio` datetime
,`visto` tinyint(1)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_notificaciones`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_notificaciones` (
`idnotificaciones` int(11)
,`contenido` varchar(200)
,`fecha_envio` date
,`usuario_id_usuario` int(11)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_oferta_empleo`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_oferta_empleo` (
`id_oferta_empleo` int(11)
,`titulo_emp` varchar(45)
,`descripcion` varchar(500)
,`requisitos` varchar(500)
,`ubicacion` varchar(45)
,`salario` double
,`oferta_empleocol` varchar(250)
,`telefono` int(11)
,`correo` varchar(250)
,`sub_cat_id_sub_cat` int(11)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_rol`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_rol` (
`id_rol` int(11)
,`nombre_rol` varchar(50)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_sub_cat`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_sub_cat` (
`id_sub_cat` int(11)
,`nombre_sub_cat` varchar(45)
,`categoria_id_categora` int(11)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_usuario`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_usuario` (
`id_usuario` int(11)
,`usuario` varchar(45)
,`correo` varchar(45)
,`contrasena` varchar(250)
,`rol_id_rol` int(11)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_calificaciones`
--
DROP TABLE IF EXISTS `vista_calificaciones`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_calificaciones`  AS SELECT `c`.`idcalificaciones` AS `idcalificaciones`, `c`.`calificacion` AS `calificacion`, `c`.`comentario` AS `comentario`, `c`.`fecha` AS `fecha`, `o`.`titulo_emp` AS `oferta_empleo`, `u`.`usuario` AS `usuario` FROM ((`calificaciones` `c` join `oferta_empleo` `o` on(`c`.`oferta_empleo_id_oferta_empleo` = `o`.`id_oferta_empleo`)) join `usuario` `u` on(`c`.`usuario_id_usuario` = `u`.`id_usuario`)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_categoria`
--
DROP TABLE IF EXISTS `vista_categoria`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_categoria`  AS SELECT `categoria`.`id_categora` AS `id_categora`, `categoria`.`nombre_cat` AS `nombre_cat` FROM `categoria` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_empresas`
--
DROP TABLE IF EXISTS `vista_empresas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_empresas`  AS SELECT `e`.`id_empresa` AS `id_empresa`, `e`.`nombre_emp` AS `nombre_emp`, `e`.`industria` AS `industria`, `e`.`ubicacion` AS `ubicacion`, `e`.`tamano_emp` AS `tamano_emp`, `e`.`descripcion_emp` AS `descripcion_emp`, `u`.`usuario` AS `usuario` FROM (`empresas` `e` join `usuario` `u` on(`e`.`usuario_id_usuario` = `u`.`id_usuario`)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_estudios`
--
DROP TABLE IF EXISTS `vista_estudios`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_estudios`  AS SELECT `e`.`idEstudios` AS `idEstudios`, `e`.`intitucion` AS `intitucion`, `e`.`titulo` AS `titulo`, `e`.`fecha_inicio` AS `fecha_inicio`, `e`.`fecha_fin` AS `fecha_fin`, `h`.`nombre` AS `nombre`, `h`.`apellido` AS `apellido` FROM (`estudios` `e` join `hojade_de_vida` `h` on(`e`.`hojade_de_vida_id_hojade_de_vida` = `h`.`id_hojade_de_vida`)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_experiencia_laboral`
--
DROP TABLE IF EXISTS `vista_experiencia_laboral`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_experiencia_laboral`  AS SELECT `experiencia_laboral`.`idexperiencia_laboral` AS `idexperiencia_laboral`, `experiencia_laboral`.`empresa` AS `empresa`, `experiencia_laboral`.`cargo` AS `cargo`, `experiencia_laboral`.`ubicacion_empleo` AS `ubicacion_empleo`, `experiencia_laboral`.`descripcion_labor` AS `descripcion_labor`, `experiencia_laboral`.`fecha_inicio` AS `fecha_inicio`, `experiencia_laboral`.`fecha_fin` AS `fecha_fin`, `experiencia_laboral`.`hojade_de_vida_id_hojade_de_vida` AS `hojade_de_vida_id_hojade_de_vida` FROM `experiencia_laboral` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_hojade_de_vida`
--
DROP TABLE IF EXISTS `vista_hojade_de_vida`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_hojade_de_vida`  AS SELECT `hojade_de_vida`.`id_hojade_de_vida` AS `id_hojade_de_vida`, `hojade_de_vida`.`nombre` AS `nombre`, `hojade_de_vida`.`apellido` AS `apellido`, `hojade_de_vida`.`direccion` AS `direccion`, `hojade_de_vida`.`telefono` AS `telefono`, `hojade_de_vida`.`correo` AS `correo`, `hojade_de_vida`.`estado_civil` AS `estado_civil`, `hojade_de_vida`.`fecha_nacimiento` AS `fecha_nacimiento`, `hojade_de_vida`.`nacionalidad` AS `nacionalidad`, `hojade_de_vida`.`descripcion_sobre_ti` AS `descripcion_sobre_ti`, `hojade_de_vida`.`objetivo_profecional` AS `objetivo_profecional`, `hojade_de_vida`.`idiomas` AS `idiomas`, `hojade_de_vida`.`referencias` AS `referencias`, `hojade_de_vida`.`parentezco` AS `parentezco`, `hojade_de_vida`.`numero_referencia` AS `numero_referencia`, `hojade_de_vida`.`intereses_personales` AS `intereses_personales`, `hojade_de_vida`.`disponibilidad_trabajo` AS `disponibilidad_trabajo`, `hojade_de_vida`.`usuario_id_usuario` AS `usuario_id_usuario` FROM `hojade_de_vida` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_mensajes`
--
DROP TABLE IF EXISTS `vista_mensajes`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_mensajes`  AS SELECT `mensajes`.`id_mensajes` AS `id_mensajes`, `mensajes`.`id_receptor` AS `id_receptor`, `mensajes`.`id_interceptor` AS `id_interceptor`, `mensajes`.`contenido` AS `contenido`, `mensajes`.`fecha_envio` AS `fecha_envio`, `mensajes`.`visto` AS `visto` FROM `mensajes` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_notificaciones`
--
DROP TABLE IF EXISTS `vista_notificaciones`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_notificaciones`  AS SELECT `notificaciones`.`idnotificaciones` AS `idnotificaciones`, `notificaciones`.`contenido` AS `contenido`, `notificaciones`.`fecha_envio` AS `fecha_envio`, `notificaciones`.`usuario_id_usuario` AS `usuario_id_usuario` FROM `notificaciones` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_oferta_empleo`
--
DROP TABLE IF EXISTS `vista_oferta_empleo`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_oferta_empleo`  AS SELECT `oferta_empleo`.`id_oferta_empleo` AS `id_oferta_empleo`, `oferta_empleo`.`titulo_emp` AS `titulo_emp`, `oferta_empleo`.`descripcion` AS `descripcion`, `oferta_empleo`.`requisitos` AS `requisitos`, `oferta_empleo`.`ubicacion` AS `ubicacion`, `oferta_empleo`.`salario` AS `salario`, `oferta_empleo`.`oferta_empleocol` AS `oferta_empleocol`, `oferta_empleo`.`telefono` AS `telefono`, `oferta_empleo`.`correo` AS `correo`, `oferta_empleo`.`sub_cat_id_sub_cat` AS `sub_cat_id_sub_cat` FROM `oferta_empleo` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_rol`
--
DROP TABLE IF EXISTS `vista_rol`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_rol`  AS SELECT `rol`.`id_rol` AS `id_rol`, `rol`.`nombre_rol` AS `nombre_rol` FROM `rol` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_sub_cat`
--
DROP TABLE IF EXISTS `vista_sub_cat`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_sub_cat`  AS SELECT `sub_cat`.`id_sub_cat` AS `id_sub_cat`, `sub_cat`.`nombre_sub_cat` AS `nombre_sub_cat`, `sub_cat`.`categoria_id_categora` AS `categoria_id_categora` FROM `sub_cat` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_usuario`
--
DROP TABLE IF EXISTS `vista_usuario`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_usuario`  AS SELECT `usuario`.`id_usuario` AS `id_usuario`, `usuario`.`usuario` AS `usuario`, `usuario`.`correo` AS `correo`, `usuario`.`contrasena` AS `contrasena`, `usuario`.`rol_id_rol` AS `rol_id_rol` FROM `usuario` ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  ADD PRIMARY KEY (`idcalificaciones`,`oferta_empleo_id_oferta_empleo`,`usuario_id_usuario`),
  ADD KEY `fk_calificaciones_oferta_empleo1_idx` (`oferta_empleo_id_oferta_empleo`),
  ADD KEY `fk_calificaciones_oferta_empleo1` (`oferta_empleo_id_oferta_empleo`),
  ADD KEY `fk_calificaciones_usuario1_idx` (`usuario_id_usuario`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categora`);

--
-- Indices de la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id_empresa`) USING BTREE,
  ADD KEY `fk_empresa_usuario1_idx` (`usuario_id_usuario`);

--
-- Indices de la tabla `estudios`
--
ALTER TABLE `estudios`
  ADD PRIMARY KEY (`idEstudios`),
  ADD KEY `fk_estudios_hojade_de_vida1_idx` (`hojade_de_vida_id_hojade_de_vida`);

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
  ADD PRIMARY KEY (`hojade_de_vida_id_hojade_de_vida`,`oferta_empleo_id_oferta_empleo`),
  ADD KEY `fk_hojade_de_vida_has_oferta_empleo_oferta_empleo1_idx` (`oferta_empleo_id_oferta_empleo`),
  ADD KEY `fk_hojade_de_vida_has_oferta_empleo_hojade_de_vida1_idx` (`hojade_de_vida_id_hojade_de_vida`);

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`id_mensajes`,`id_receptor`,`id_interceptor`),
  ADD KEY `fk_mensajes_usuario1_idx` (`id_receptor`),
  ADD KEY `fk_mensajes_usuario2_idx` (`id_interceptor`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`idnotificaciones`,`usuario_id_usuario`) USING BTREE,
  ADD KEY `fk_notificaciones_usuario1_idx` (`usuario_id_usuario`);

--
-- Indices de la tabla `oferta_empleo`
--
ALTER TABLE `oferta_empleo`
  ADD PRIMARY KEY (`id_oferta_empleo`,`sub_cat_id_sub_cat`),
  ADD KEY `fk_oferta_empleo_sub_cat1_idx` (`sub_cat_id_sub_cat`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `sub_cat`
--
ALTER TABLE `sub_cat`
  ADD PRIMARY KEY (`id_sub_cat`,`categoria_id_categora`),
  ADD KEY `fk_sub_cat_categoria1_idx` (`categoria_id_categora`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`,`rol_id_rol`),
  ADD UNIQUE KEY `usuario_unique` (`usuario`),
  ADD UNIQUE KEY `correo_unique` (`correo`),
  ADD KEY `fk_usuario_rol1_idx` (`rol_id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  MODIFY `idcalificaciones` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categora` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT de la tabla `estudios`
--
ALTER TABLE `estudios`
  MODIFY `idEstudios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `experiencia_laboral`
--
ALTER TABLE `experiencia_laboral`
  MODIFY `idexperiencia_laboral` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `hojade_de_vida`
--
ALTER TABLE `hojade_de_vida`
  MODIFY `id_hojade_de_vida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `id_mensajes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `idnotificaciones` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `oferta_empleo`
--
ALTER TABLE `oferta_empleo`
  MODIFY `id_oferta_empleo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `sub_cat`
--
ALTER TABLE `sub_cat`
  MODIFY `id_sub_cat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  ADD CONSTRAINT `fk_calificaciones_oferta_empleo1` FOREIGN KEY (`oferta_empleo_id_oferta_empleo`) REFERENCES `oferta_empleo` (`id_oferta_empleo`),
  ADD CONSTRAINT `fk_calificaciones_usuario1` FOREIGN KEY (`usuario_id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `estudios`
--
ALTER TABLE `estudios`
  ADD CONSTRAINT `fk_estudios_hojade_de_vida1` FOREIGN KEY (`hojade_de_vida_id_hojade_de_vida`) REFERENCES `hojade_de_vida` (`id_hojade_de_vida`);

--
-- Filtros para la tabla `experiencia_laboral`
--
ALTER TABLE `experiencia_laboral`
  ADD CONSTRAINT `fk_experiencia_laboral_hojade_de_vida1` FOREIGN KEY (`hojade_de_vida_id_hojade_de_vida`) REFERENCES `hojade_de_vida` (`id_hojade_de_vida`);

--
-- Filtros para la tabla `hojade_de_vida`
--
ALTER TABLE `hojade_de_vida`
  ADD CONSTRAINT `fk_hojade_de_vida_usuario1` FOREIGN KEY (`usuario_id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `hojade_de_vida_has_oferta_empleo`
--
ALTER TABLE `hojade_de_vida_has_oferta_empleo`
  ADD CONSTRAINT `fk_hojade_de_vida_has_oferta_empleo_hojade_de_vida1` FOREIGN KEY (`hojade_de_vida_id_hojade_de_vida`) REFERENCES `hojade_de_vida` (`id_hojade_de_vida`),
  ADD CONSTRAINT `fk_hojade_de_vida_has_oferta_empleo_oferta_empleo1` FOREIGN KEY (`oferta_empleo_id_oferta_empleo`) REFERENCES `oferta_empleo` (`id_oferta_empleo`);

--
-- Filtros para la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD CONSTRAINT `fk_mensajes_usuario1` FOREIGN KEY (`id_receptor`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_mensajes_usuario2` FOREIGN KEY (`id_interceptor`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD CONSTRAINT `fk_notificaciones_usuario1` FOREIGN KEY (`usuario_id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `oferta_empleo`
--
ALTER TABLE `oferta_empleo`
  ADD CONSTRAINT `fk_oferta_empleo_sub_cat1` FOREIGN KEY (`sub_cat_id_sub_cat`) REFERENCES `sub_cat` (`id_sub_cat`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sub_cat`
--
ALTER TABLE `sub_cat`
  ADD CONSTRAINT `fk_sub_cat_categoria1` FOREIGN KEY (`categoria_id_categora`) REFERENCES `categoria` (`id_categora`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_rol1` FOREIGN KEY (`rol_id_rol`) REFERENCES `rol` (`id_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
