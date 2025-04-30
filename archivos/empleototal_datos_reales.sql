-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-04-2025 a las 06:59:08
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
(1, 'Tecnología'),
(2, 'Salud'),
(3, 'Servicios Legales'),
(4, 'Veterinaria'),
(5, 'Contabilidad'),
(6, 'Recursos Humanos');

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
  `descripcion_emp` varchar(1000) DEFAULT NULL,
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
(1, 'TechCorp', 'Tecnología', 'Ciudad Tech, Estado Tech', 'Grande', 'Empresa líder en soluciones tecnológicas innovadoras, especializada en software y hardware para empresas.', 'Juan Pérez', 'contacto@techcorp.com', 'https://www.techcorp.com', 'Fundada en 2010 con un enfoque en soluciones informáticas avanzadas.', 'Desarrollar tecnología que revolucione el sector empresarial.', 'Ser la empresa líder en innovación tecnológica.', 'Presencia en América y Europa', 'Lanzamiento de la plataforma de inteligencia artificial en 2023.', 'Innovación en el desarrollo de software con inteligencia artificial.', 'Beneficios de salud, seguro de vida, horarios flexibles, oportunidades de crecimiento profesional.', 5),
(2, 'HealthCarePlus', 'Salud', 'Ciudad Salud, Estado Health', 'Mediana', 'Proveedora de servicios médicos y de bienestar, incluyendo atención primaria y especializada.', 'María López', 'info@healthcareplus.com', 'https://www.healthcareplus.com', 'Fundada en 2015, enfocada en la atención médica integral a través de tecnología de punta.', 'Brindar acceso a la mejor atención médica para todos.', 'Ser la red de salud más confiable y accesible del país.', 'Presencia nacional', 'Creación de un sistema de telemedicina para consultas a distancia en 2022.', 'Implementación de tecnología en salud para mejorar la eficiencia de los tratamientos.', 'Beneficios médicos, programas de bienestar, formación continua para empleados.', 6),
(3, 'LegalAdvice', 'Servicios legales', 'Ciudad Legal, Estado Legal', 'Pequeña', 'Firma de abogados especializada en asesoría legal para empresas y particulares.', 'Carlos Gómez', 'servicios@legaladvice.com', 'https://www.legaladvice.com', 'Fundada en 2018, ofrece consultoría legal a empresas y casos individuales.', 'Proveer la mejor asesoría legal en cualquier área del derecho.', 'Ser la firma de abogados preferida para clientes corporativos.', 'Servicios nacionales con alcance internacional', 'Asesoramiento exitoso en más de 100 casos de alta complejidad.', 'Desarrollo de herramientas digitales para facilitar la consulta legal remota.', 'Beneficios legales, acceso a formación en leyes, ambiente colaborativo.', 7),
(4, 'VetClinic', 'Veterinaria', 'Ciudad Vet, Estado Vet', 'Pequeña', 'Clínica veterinaria especializada en el cuidado de mascotas y animales exóticos.', 'Ana Martínez', 'contacto@vetclinic.com', 'https://www.vetclinic.com', 'Fundada en 2016, dedicada al cuidado y bienestar de los animales.', 'Brindar servicios veterinarios de calidad para todos los animales.', 'Ser la clínica de referencia para el cuidado animal en la región.', 'Presencia nacional', 'Implementación de cirugía veterinaria de mínima invasión en 2021.', 'Desarrollo de una app para seguimiento médico de mascotas.', 'Beneficios de salud para empleados, programas de bienestar animal, formación continua.', 8),
(5, 'FinCo', 'Contabilidad', 'Ciudad Finance, Estado Finance', 'Mediana', 'Empresa dedicada a la consultoría y auditoría financiera para empresas de todos los tamaños.', 'Sofía González', 'admin@finco.com', 'https://www.finco.com', 'Fundada en 2012, brinda servicios financieros especializados a empresas.', 'Ofrecer soluciones financieras que optimicen los recursos de las empresas.', 'Ser el líder en asesoría financiera para pequeñas y medianas empresas.', 'Presencia internacional', 'Creación de un software de contabilidad en la nube para pymes en 2020.', 'Innovación en el análisis financiero mediante inteligencia artificial.', 'Beneficios de salud, seguro dental, oportunidades de crecimiento profesional.', 9),
(6, 'HRPartners', 'Recursos Humanos', 'Ciudad HR, Estado HR', 'Grande', 'Consultora de recursos humanos especializada en la gestión del talento y desarrollo organizacional.', 'Laura Sánchez', 'recursos@hrpartners.com', 'https://www.hrpartners.com', 'Fundada en 2010, ayuda a empresas a encontrar y gestionar el mejor talento.', 'Brindar soluciones de recursos humanos personalizadas para empresas.', 'Ser la empresa líder en el desarrollo del talento humano.', 'Presencia global', 'Implementación de una plataforma de evaluación de desempeño automatizada en 2022.', 'Desarrollo de herramientas digitales para la gestión del talento y la cultura organizacional.', 'Beneficios de salud, programas de bienestar, formación y desarrollo profesional.', 10);

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
(1, 'Universidad Nacional de Colombia', 'Ingeniero de Sistemas', '2008-01-01', '2012-12-31', 1),
(2, 'Universidad Autónoma de México', 'Médico Cirujano', '2006-01-01', '2012-12-31', 2),
(3, 'Universidad de Buenos Aires', 'Abogado', '2003-01-01', '2008-12-31', 3),
(4, 'Universidad Nacional Mayor de San Marcos', 'Veterinario', '2010-01-01', '2015-12-31', 4),
(14, 'Universidad Nacional', 'Ingeniería de Sistemas', '2021-02-02', '2023-07-04', 41);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `experiencia_laboral`
--

CREATE TABLE `experiencia_laboral` (
  `idexperiencia_laboral` int(11) NOT NULL,
  `empresa` varchar(50) DEFAULT NULL,
  `cargo` varchar(45) DEFAULT NULL,
  `ubicacion_empleo` varchar(45) DEFAULT NULL,
  `descripcion_labor` varchar(1000) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `hojade_de_vida_id_hojade_de_vida` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `experiencia_laboral`
--

INSERT INTO `experiencia_laboral` (`idexperiencia_laboral`, `empresa`, `cargo`, `ubicacion_empleo`, `descripcion_labor`, `fecha_inicio`, `fecha_fin`, `hojade_de_vida_id_hojade_de_vida`) VALUES
(7, 'Innovatech Solutions', 'Desarrollador de Software', 'Ciudad Tech', 'Diseño y desarrollo de plataformas SaaS para empresas tecnológicas.', '2015-02-01', '2020-07-30', 1),
(8, 'Wellness Health', 'Coordinador de Salud', 'Ciudad Salud', 'Supervisión y optimización de servicios médicos en clínicas privadas.', '2011-06-01', '2019-01-15', 2),
(9, 'Corporate Shield', 'Consultor Legal', 'Ciudad Legal', 'Asesoría en contratos y cumplimiento normativo para grandes corporaciones.', '2013-04-01', '2022-08-15', 3),
(10, 'ExoticCare Vets', 'Especialista Veterinario', 'Ciudad Vet', 'Cuidado médico especializado en fauna exótica y animales domésticos.', '2019-03-01', '2023-11-30', 4),
(11, 'HealthCarePlus', 'sdsdaasd', 'calee b', 'sssssssssssssssssssssssssssssssssss', '2019-01-30', '2024-12-03', 41);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hojade_de_vida`
--

CREATE TABLE `hojade_de_vida` (
  `id_hojade_de_vida` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido` varchar(50) DEFAULT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
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
(1, 'Sebastian', 'Molina', 'Calle Ficticia 123, Ciudad Tech', '3142800305', 'sebastiancamilo5612@gmail.com', 'Soltero', '1990-05-12', 'Colombiana', 'Soy una persona proactiva, con pasión por la tecnología y el desarrollo de software.', 'Mi objetivo es desarrollar soluciones tecnológicas innovadoras que impacten positivamente a las empresas.', 'Español (nativo), Inglés (avanzado)', 'Carlos López - jefedepartamento@techcorp.com', 'Amigo', '555-4321', 'Me gusta la lectura, el deporte y la programación en mis tiempos libres.', 'Disponible para jornada completa', 1),
(2, 'Steven', 'Torres', 'Avenida Central 456, Ciudad Salud', '3015832249', 'steventhorta@gmail.com', 'Casado', '1988-08-22', 'Venezolana', 'Soy un profesional con amplia experiencia en el sector salud, comprometido con el bienestar de los pacientes.', 'Busco mejorar el acceso a servicios médicos de calidad y continuar desarrollándome en el ámbito de la salud.', 'Español (nativo), Inglés (intermedio)', 'Marta Ruiz - jefe@healthcareplus.com', 'Hermana', '555-8765', 'Me apasiona el ejercicio físico, el voluntariado y la medicina.', 'Disponible para jornada completa', 2),
(3, 'Fabian', 'Cristancho', 'Calle Real 789, Ciudad Legal', '3024768372', 'fabian2006cristancho@gmail.com', 'Soltero', '1985-03-15', 'Argentina', 'Soy un abogado con enfoque en derecho corporativo, buscando siempre soluciones legales eficientes.', 'Mi objetivo es proporcionar asesoría legal integral a empresas, apoyándolas en sus necesidades legales cotidianas.', 'Español (nativo), Inglés (avanzado)', 'Roberto Martínez - abogado@legaladvice.com', 'Amigo', '555-9876', 'Me interesa el fútbol, el cine y el desarrollo de proyectos legales innovadores.', 'Disponible para jornada completa', 3),
(4, 'Jonatan', 'Montealegre', 'Calle Secundaria 101, Ciudad Vet', '3123098607', 'montealegrejonatan20@gmail.com', 'Casado', '1992-12-05', 'Peruana', 'Soy veterinario con una gran pasión por los animales y la medicina veterinaria, enfocado en el cuidado de mascotas y animales exóticos.', 'Mi objetivo es mejorar la calidad de vida de los animales a través de una atención médica avanzada.', 'Español (nativo), Inglés (intermedio)', 'Juliana Rodríguez - jefa@vetclinic.com', 'Hermana', '555-2233', 'Me gusta viajar, cuidar animales y leer sobre nuevas técnicas veterinarias.', 'Disponible para jornada completa', 4),
(41, 'jose', 'parra', 'Calle C', '2147483647', 'josetorres@gmail.com', 'Soltero', '2006-01-31', 'Argentina', 'wwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww', 'sdadsasdads', 'colombiana', 'sebastianM', 'Padre', '9876543210', 'sdadsasda', '20', 180);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hojade_de_vida_has_oferta_empleo`
--

CREATE TABLE `hojade_de_vida_has_oferta_empleo` (
  `hojade_de_vida_id_hojade_de_vida` int(11) NOT NULL,
  `oferta_empleo_id_oferta_empleo` int(11) NOT NULL,
  `estado` enum('pendiente','aceptado','rechazado','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `hojade_de_vida_has_oferta_empleo`
--

INSERT INTO `hojade_de_vida_has_oferta_empleo` (`hojade_de_vida_id_hojade_de_vida`, `oferta_empleo_id_oferta_empleo`, `estado`) VALUES
(41, 63, 'pendiente');

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oferta_empleo`
--

CREATE TABLE `oferta_empleo` (
  `id_oferta_empleo` int(11) NOT NULL,
  `titulo_emp` varchar(250) NOT NULL,
  `empresas_id` int(11) NOT NULL,
  `descripcion` varchar(500) DEFAULT NULL,
  `requisitos` varchar(500) DEFAULT NULL,
  `ubicacion` varchar(45) DEFAULT NULL,
  `salario` double DEFAULT NULL,
  `oferta_empleocol` varchar(250) DEFAULT NULL,
  `telefono` int(11) NOT NULL,
  `correo` varchar(250) NOT NULL,
  `link_test` varchar(1000) NOT NULL,
  `sub_cat_id_sub_cat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `oferta_empleo`
--

INSERT INTO `oferta_empleo` (`id_oferta_empleo`, `titulo_emp`, `empresas_id`, `descripcion`, `requisitos`, `ubicacion`, `salario`, `oferta_empleocol`, `telefono`, `correo`, `link_test`, `sub_cat_id_sub_cat`) VALUES
(61, 'Médico Cirujano', 2, 'Se necesita médico cirujano con experiencia para brindar atención médica de calidad en nuestra clínica.', 'Título de Médico Cirujano, experiencia mínima de 2 años en el área, disponibilidad para turnos rotativos.', 'Avenida Central 456, Ciudad Salud', 5000, 'uploads/medico.jpeg', 2147483647, 'empleo@healthcareplus.com', 'https://docs.google.com/forms/d/e/1FAIpQLSdWx0DFIwTrQBhloChrWETIviVfqGwK_V4--gl0PHR6xZeoyA/viewform?usp=header', 3),
(62, 'Abogado Corporativo', 3, 'Buscamos un abogado corporativo para asesorar a empresas en cuestiones legales y contractuales.', 'Licenciatura en Derecho, experiencia en el área corporativa, habilidades de negociación y redacción de contratos', 'Calle Real 789, Ciudad Legal', 3500, 'uploads/abogado-corporativo.jpg', 2147483647, 'empleo@legaladvice.com', 'https://docs.google.com/forms/d/e/1FAIpQLSd5TcOce_LZjoRpjySUlP89YpwNppnvp56yG16gTnJZFvmCCg/viewform?usp=header', 6),
(63, 'Veterinario para Clínica', 4, 'Se requiere veterinario para atender mascotas y animales exóticos en nuestra clínica veterinaria.', 'Título en Veterinaria, experiencia en atención de mascotas y animales exóticos, capacidad para trabajar en equipo.', 'Calle Secundaria 101, Ciudad Vet', 3000, 'uploads/vt.jpeg', 2147483647, 'empleo@vetclinic.com', 'https://docs.google.com/forms/d/e/1FAIpQLSdkgWEr2Kdd0CI-zfc7KOzHWq4aNfnabW9Ccnf2ichIP29XdQ/viewform?usp=header', 7),
(64, 'Contador Senior', 5, 'Se busca contador para llevar la contabilidad y auditoría de nuestra empresa.\'', 'Título de contador, experiencia en contabilidad fiscal, conocimiento de herramientas de contabilidad como Excel y QuickBooks.', 'Calle Comercial 234, Ciudad Financiera', 4500, 'uploads/contadora.jpg', 2147483647, 'empleo@finco.com', 'https://docs.google.com/forms/d/e/1FAIpQLSd5TcOce_LZjoRpjySUlP89YpwNppnvp56yG16gTnJZFvmCCg/viewform?usp=header', 10),
(65, 'Especialista en Reclutamiento', 6, 'Se busca especialista en recursos humanos para gestionar el reclutamiento de personal.', 'Experiencia en reclutamiento de personal, manejo de entrevistas y selección de candidatos.', 'Avenida del Trabajo 321, Ciudad RH', 3800, 'uploads/reclu.jpeg', 2147483647, 'empleo@hrpartners.com', 'https://docs.google.com/forms/d/e/1FAIpQLSdy1968qPhuDAC92_r-jStkEOI7Vc-d9NMC77brd_HUEPKtHA/viewform?usp=header', 11),
(66, 'Desarrollador de Software', 1, 'Se busca desarrollador de software para trabajar en proyectos innovadores de tecnología.', 'Experiencia en desarrollo de software, manejo de bases de datos, conocimiento en lenguajes como Java, Python o C++.', 'Calle Ficticia 123, Ciudad Tech', 8000, 'uploads/6758960e0f168_Desarrollo-de-Software.webp', 2147483647, 'empleo@techcorp.com', 'https://docs.google.com/forms/d/e/1FAIpQLSc-NbOhM5IjAqp97JeMdQ1vlMQACQ27pSB4kEz_jgiFYy-9gw/viewform?usp=header', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recuperar_contra`
--

CREATE TABLE `recuperar_contra` (
  `id` int(11) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `recuperar_contra`
--

INSERT INTO `recuperar_contra` (`id`, `correo`, `token`) VALUES
(26, 'sebastiancamilo1256@gmail.com', '21b109cffeaf6fd820a6f7380714123effe20e6ab8313b8fa4e1573078f45d0336446db9becf9adbf9a86d8392bb3d1e9b92'),
(27, 'sebastiancamilo5612@gmail.com', '7c0f37adf697c99ab3a753a353482240ce6f33a995a7506b4dea6f8f18429f75e02c8596b7c26a15acd3d739f4144c0e2ec9'),
(28, 'sebastiancamilo1256@gmail.com', 'da9a80a3251e4b1c3210d1f7a994707cfe0cc468c6d4d736f562e6d6852ed34ac75fa20badac71e4aa258314b5b9dcca0b54');

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
(1, 'Admin'),
(2, 'Empresa'),
(3, 'Usuario');

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
(1, 'Software', 1),
(2, 'Hardware', 1),
(3, 'Atención Primaria', 2),
(4, 'Cirugía Especializada', 2),
(5, 'Consultoría Empresarial', 3),
(6, 'Defensa de Derechos', 3),
(7, 'Atención de Mascotas', 4),
(8, 'Atención Exótica', 4),
(9, 'Auditoría Financiera', 5),
(10, 'Consultoría Fiscal', 5),
(11, 'Reclutamiento de Personal', 6),
(12, 'Desarrollo Organizacional', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `test_oferta`
--

CREATE TABLE `test_oferta` (
  `id_test` int(11) NOT NULL,
  `resultado` varchar(45) DEFAULT NULL,
  `imagen_test` varchar(200) DEFAULT NULL,
  `usuario_id` int(11) NOT NULL,
  `oferta_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, 'Sebastian', 'sebastiancamilo5612@gmail.com', '$2y$10$LiItcLvpiw2MwL4ZbSwSauPWuAxjj8j5rODF96ZJ0B2SG/tNtSvye', 3),
(2, 'Steven', 'steventhorta@gmail.com', '$2y$10$lL3yN2zRXubmwBDZPDMqWOD/Fj4XOnUttDsuj73K4/ClkGYhE8qq6', 3),
(3, 'Fabian', 'fabian2006cristancho@gmail.com', '$2y$10$y9hP1AdSxktjoBdFzWk6Nuaj7tSdif.Gx2n5owRFekviupKbCGqlG', 3),
(4, 'Jonatan', 'montealegrejonatan20@gmail.com', '$2y$10$jZXhz42Z6DzqlACLgkdcxOB8mPDGz5ZsuCCW2qAGxWbdd6E5Ec9va', 3),
(5, 'TechCorp', 'sebastiancamilo1256@gmail.com', '$2y$10$Yc7APCSEqDm1nAgmZn1hdOp8Ks.XQg3mcyxW.xCEEpCc9RDMz22CS', 2),
(6, 'HealthCarePlus', 'info@healthcareplus.com', '$2y$10$s/NISvcUdqv5.ht1bIXLSua5cxn4.HEoGj5lOs.Mc1wxcnrm7GX7C', 2),
(7, 'LegalAdvice', 'servicios@legaladvice.com', '$2y$10$7pBRuzKX.v.YZ8Ob10aRxO4U93YSzeXHvoMbhJl/t6UCILnqe93DW', 2),
(8, 'VetClinic', 'contacto@vetclinic.com', '$2y$10$RwJh1uASCWOXH9lZLjV7yeDQLiY28gOeqKpmeyYJbxebWKTYTGDYm', 2),
(9, 'FinCo', 'admin@finco.com', '$2y$10$dyg3udhL6xhHmzv6OadFM.Tu6yM05GEVau6tnX3zWwAI.YttwkFTG', 2),
(10, 'HRPartners', 'recursos@hrpartners.com', '$2y$10$Ggk/Xkmqv9/E6TYyL9YH4.0f0I0kXkVEwD9PZxALMj8D/qZtGlD7y', 2),
(11, 'Admin', 'admin@gmail.com', '$2y$10$F.pBgsraIVLJO8/by5Ck3eNOLQt2JRULyU8dWm3amCMZMUMPqA4CG', 1),
(180, 'Luis ', 'josetorres@gmail.com', '$2y$10$pdWdCFTrAp3dGgjCUIz4DO5YZQ3K6jvGntqBhkQXWJo5i2HrMStQe', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vista_empresas`
--

CREATE TABLE `vista_empresas` (
  `id_empresa` int(11) DEFAULT NULL,
  `nombre_emp` int(11) DEFAULT NULL,
  `industria` int(11) DEFAULT NULL,
  `ubicacion` int(11) DEFAULT NULL,
  `tamano_emp` int(11) DEFAULT NULL,
  `descripcion_emp` int(11) DEFAULT NULL,
  `usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vista_estudios`
--

CREATE TABLE `vista_estudios` (
  `idEstudios` int(11) DEFAULT NULL,
  `intitucion` int(11) DEFAULT NULL,
  `titulo` int(11) DEFAULT NULL,
  `fecha_inicio` int(11) DEFAULT NULL,
  `fecha_fin` int(11) DEFAULT NULL,
  `nombre` int(11) DEFAULT NULL,
  `apellido` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vista_experiencia_laboral`
--

CREATE TABLE `vista_experiencia_laboral` (
  `idexperiencia_laboral` int(11) DEFAULT NULL,
  `empresa` int(11) DEFAULT NULL,
  `cargo` int(11) DEFAULT NULL,
  `ubicacion_empleo` int(11) DEFAULT NULL,
  `descripcion_labor` int(11) DEFAULT NULL,
  `fecha_inicio` int(11) DEFAULT NULL,
  `fecha_fin` int(11) DEFAULT NULL,
  `hojade_de_vida_id_hojade_de_vida` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vista_hojade_de_vida`
--

CREATE TABLE `vista_hojade_de_vida` (
  `id_hojade_de_vida` int(11) DEFAULT NULL,
  `nombre` int(11) DEFAULT NULL,
  `apellido` int(11) DEFAULT NULL,
  `direccion` int(11) DEFAULT NULL,
  `telefono` int(11) DEFAULT NULL,
  `correo` int(11) DEFAULT NULL,
  `estado_civil` int(11) DEFAULT NULL,
  `fecha_nacimiento` int(11) DEFAULT NULL,
  `nacionalidad` int(11) DEFAULT NULL,
  `descripcion_sobre_ti` int(11) DEFAULT NULL,
  `objetivo_profecional` int(11) DEFAULT NULL,
  `idiomas` int(11) DEFAULT NULL,
  `referencias` int(11) DEFAULT NULL,
  `parentezco` int(11) DEFAULT NULL,
  `numero_referencia` int(11) DEFAULT NULL,
  `intereses_personales` int(11) DEFAULT NULL,
  `disponibilidad_trabajo` int(11) DEFAULT NULL,
  `usuario_id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vista_mensajes`
--

CREATE TABLE `vista_mensajes` (
  `id_mensajes` int(11) DEFAULT NULL,
  `id_receptor` int(11) DEFAULT NULL,
  `id_interceptor` int(11) DEFAULT NULL,
  `contenido` int(11) DEFAULT NULL,
  `fecha_envio` int(11) DEFAULT NULL,
  `visto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vista_notificaciones`
--

CREATE TABLE `vista_notificaciones` (
  `idnotificaciones` int(11) DEFAULT NULL,
  `contenido` int(11) DEFAULT NULL,
  `fecha_envio` int(11) DEFAULT NULL,
  `usuario_id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vista_oferta_empleo`
--

CREATE TABLE `vista_oferta_empleo` (
  `id_oferta_empleo` int(11) DEFAULT NULL,
  `titulo_emp` int(11) DEFAULT NULL,
  `descripcion` int(11) DEFAULT NULL,
  `requisitos` int(11) DEFAULT NULL,
  `ubicacion` int(11) DEFAULT NULL,
  `salario` int(11) DEFAULT NULL,
  `oferta_empleocol` int(11) DEFAULT NULL,
  `telefono` int(11) DEFAULT NULL,
  `correo` int(11) DEFAULT NULL,
  `sub_cat_id_sub_cat` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vista_rol`
--

CREATE TABLE `vista_rol` (
  `id_rol` int(11) DEFAULT NULL,
  `nombre_rol` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vista_sub_cat`
--

CREATE TABLE `vista_sub_cat` (
  `id_sub_cat` int(11) DEFAULT NULL,
  `nombre_sub_cat` int(11) DEFAULT NULL,
  `categoria_id_categora` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vista_usuario`
--

CREATE TABLE `vista_usuario` (
  `id_usuario` int(11) DEFAULT NULL,
  `usuario` int(11) DEFAULT NULL,
  `correo` int(11) DEFAULT NULL,
  `contrasena` int(11) DEFAULT NULL,
  `rol_id_rol` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  ADD PRIMARY KEY (`id_oferta_empleo`,`empresas_id`,`sub_cat_id_sub_cat`),
  ADD KEY `fk_oferta_empleo_sub_cat1_idx` (`sub_cat_id_sub_cat`),
  ADD KEY `fk_oferta_empleo_empresas1_idx` (`empresas_id`);

--
-- Indices de la tabla `recuperar_contra`
--
ALTER TABLE `recuperar_contra`
  ADD PRIMARY KEY (`id`);

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
-- Indices de la tabla `test_oferta`
--
ALTER TABLE `test_oferta`
  ADD PRIMARY KEY (`id_test`,`usuario_id`,`oferta_id`),
  ADD KEY `fk_test_oferta_usuario1_idx` (`usuario_id`),
  ADD KEY `fk_test_oferta_oferta_empleo1_idx` (`oferta_id`);

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
  MODIFY `idcalificaciones` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categora` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT de la tabla `estudios`
--
ALTER TABLE `estudios`
  MODIFY `idEstudios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `experiencia_laboral`
--
ALTER TABLE `experiencia_laboral`
  MODIFY `idexperiencia_laboral` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `hojade_de_vida`
--
ALTER TABLE `hojade_de_vida`
  MODIFY `id_hojade_de_vida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `id_mensajes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `idnotificaciones` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `oferta_empleo`
--
ALTER TABLE `oferta_empleo`
  MODIFY `id_oferta_empleo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT de la tabla `recuperar_contra`
--
ALTER TABLE `recuperar_contra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `sub_cat`
--
ALTER TABLE `sub_cat`
  MODIFY `id_sub_cat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT de la tabla `test_oferta`
--
ALTER TABLE `test_oferta`
  MODIFY `id_test` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=188;

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
  ADD CONSTRAINT `fk_oferta_empleo_empresas1` FOREIGN KEY (`empresas_id`) REFERENCES `empresas` (`id_empresa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_oferta_empleo_sub_cat1` FOREIGN KEY (`sub_cat_id_sub_cat`) REFERENCES `sub_cat` (`id_sub_cat`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sub_cat`
--
ALTER TABLE `sub_cat`
  ADD CONSTRAINT `fk_sub_cat_categoria1` FOREIGN KEY (`categoria_id_categora`) REFERENCES `categoria` (`id_categora`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `test_oferta`
--
ALTER TABLE `test_oferta`
  ADD CONSTRAINT `fk_test_oferta_oferta_empleo1` FOREIGN KEY (`oferta_id`) REFERENCES `oferta_empleo` (`id_oferta_empleo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_test_oferta_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_rol1` FOREIGN KEY (`rol_id_rol`) REFERENCES `rol` (`id_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
