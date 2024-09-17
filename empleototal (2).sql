-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-09-2024 a las 17:33:31
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

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
(13, 'asdsada'),
(14, 'sad');

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
(16, 'fdsdafsdf', 'dsfsdf', 'sdfsdfsdf', 0, 'fsdfsd@a', 'sdfsdf', '2024-09-03', 'sdfsdf', 'sdffsdf', 'sdfsd', 'fsdfsdf', 'sdfsdff', 'fsdf', 'sdfsf', 'sdf', 'sdf', 93);

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

--
-- Volcado de datos para la tabla `mensajes`
--

INSERT INTO `mensajes` (`id_mensajes`, `id_receptor`, `id_interceptor`, `contenido`, `fecha_envio`, `visto`) VALUES
(1, 93, 94, 'dfsda', '2024-09-14 00:00:00', 1),
(2, 93, 94, 'asdssad', '2024-09-14 00:00:00', 1),
(3, 95, 94, 'hola juanito', '2024-09-14 00:00:00', 1),
(4, 95, 94, 'que mas juanito \r\n', '2024-09-14 00:00:00', 1),
(5, 94, 95, 'que quiere catre ijueputa', '2024-09-14 00:00:00', 1),
(7, 93, 94, 'hola', '2024-09-14 00:00:00', 1),
(8, 95, 94, 'ha', '2024-09-14 00:00:00', 1),
(9, 95, 94, 'hola', '2024-09-14 00:00:00', 1),
(10, 95, 94, 'kaiaiaka', '2024-09-14 00:00:00', 1),
(11, 95, 94, 'jiji', '2024-09-14 00:00:00', 1),
(12, 95, 94, 'que mas viejo\r\n', '2024-09-14 00:00:00', 1),
(13, 95, 94, 'nada', '2024-09-14 00:00:00', 1),
(14, 95, 94, 'nada', '2024-09-14 00:00:00', 1),
(15, 94, 94, 'vxc', '2024-09-14 00:00:00', 1),
(16, 95, 94, 'cv', '2024-09-14 00:00:00', 1),
(17, 93, 94, 'xcv', '2024-09-14 00:00:00', 1),
(18, 93, 94, 'xcv', '2024-09-14 00:00:00', 1),
(19, 93, 94, 'v', '2024-09-14 00:00:00', 1),
(20, 93, 94, 'cvcxv', '2024-09-14 00:00:00', 1),
(21, 95, 94, 'HOLA JUENITO', '2024-09-14 00:00:00', 1),
(22, 94, 95, 'jaja que ', '2024-09-14 17:51:18', 1),
(23, 95, 94, 'nada cacorro ', '2024-09-14 17:51:39', 1),
(24, 94, 95, 'a bueno cacoroo jajajajaja\r\n', '2024-09-14 17:52:06', 1),
(25, 94, 95, 'hola', '2024-09-14 17:54:52', 1),
(26, 95, 94, 'ccaa\r\n', '2024-09-16 15:43:29', 0);

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
  `titulo_emp` varchar(45) DEFAULT NULL,
  `descripcion` varchar(500) DEFAULT NULL,
  `requisitos` varchar(500) DEFAULT NULL,
  `ubicacion` varchar(45) DEFAULT NULL,
  `salario` double DEFAULT NULL,
  `oferta_empleocol` blob DEFAULT NULL,
  `telefono` int(11) NOT NULL,
  `correo` varchar(250) NOT NULL,
  `sub_cat_id_sub_cat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `oferta_empleo`
--

INSERT INTO `oferta_empleo` (`id_oferta_empleo`, `titulo_emp`, `descripcion`, `requisitos`, `ubicacion`, `salario`, `oferta_empleocol`, `telefono`, `correo`, `sub_cat_id_sub_cat`) VALUES
(22, 'sdfsdfsdf', 'sdfsdfsdfffsfsdf', 'sdfsdf', 'sdfsdfsdf', 2131, 0x89504e470d0a1a0a0000000d49484452000000da0000006d0806000000c7d27f16000000017352474200aece1ce90000000467414d410000b18f0bfc6105000000097048597300000ec300000ec301c76fa86400002d7449444154785eed9d0bfcd7d3fdc7cfcfcc30b7ae56f217a94493cb981a4ac4cabdb92c4a525b359a31a31a3365c384665269b1424b0f6c4318b98c42cca50b8a468dc648cc2431fbfccff3fdfbbd3ebd7fdf7d7fbafd7ebfbebfcfeff3aaf7ef9ccfb95fdeef73de9ff339e77ccb92889023472dc2b39cecc5dc40a1ff6aaf24fec3f0ee724b6de621b762fe695ea9619ee526cf6bf42f77adf8efec154f66242117b41c2581d582b49a1dcb79b4b27bb921368e580bff7227efbf3a449a5f79a02ff42f0f52e15ee0af6055f96742d0fefbdfff5a85cacacaec19f3fdf7df37fb76db6d67feb86db2c92669c505c501de5e6aa0dc8575cc2ad447beaf8abbd95f63e9a48207d270913629db24f6fde7e52cefe2d176e56e8a8dbdc256f1a7d03fcdd7dc565bd6d67f13fb5bc741c3214408d4e79f7f6e26183e7c7878e49147c2a79f7e1abef4a52f999f67509ed38ea1a1d558250ccaa88125aba08fd4a790b757768be1788e020570df74d34dcbc34437fc69ab4dbfb4a9f53f94a661fe45ec31ce9afd2355e16fe529e29fa9190d5227e1b662c58ad0b3674f7b1e3f7e7cd879e79dcdae2acb541c048f8e2a45a86e85f6fa06f51958dd8ff0c0e715f6f2b6f9ec3fff095f8e7d396bd6acd0b87193d0baf5ae95fc958ccd3866af987b5c9a6656f857f816f7c75ced50ee56e09fa9198d114be079abadb60a37dd749309dd41071d142ebae8a2f0fcf3cf87952b575ac310266da08852153250ce1c49f84f6420c897bb3e817610d17f653673ac7efeecb3cf4c837968c68cd0a3478f70c4114784134ef84e78e9a597cc7f3511be3c4ed554dcbf7cd672e467af6271b234a3d1d0afbffe7a78e38d3742c78e1d4d6870a37abcaf0d1e3c383cf0c003e1a38f3eb238cd9a350bbbedb65b68dab469e8debd7bd877df7d4383060dec9d6ef3cd37b73085202dd2f42874537316862b44b1b4be084a57261da8348ae559cc2dcba0befffef7bfc3a2458bacaf9f79e61973a79de08fedb7df3edc7df7dda143870ed626e219b593fdadf8536e54b817f8179fd914a7b2bfdc4026048d518c06c51c356a54f8ea57bf1a7ef8c31fda0cc7e88f891f8278e9a59786dffffef7160f5511e08f606eb3cd3661cb2db7b4ced8638f3d42972e5d429b366d42cb962d2d5cdae8d1a493d45172a70c02f9169b217d73fbce262e76b95336bd53901626843bfef8a91c8a8f09e1a7b481ccba08b503f502d445fde6ebcebbf8d9679f1d5e79e515eb6bdcbffce52f9b5de1787540956440258e4fb7dc48c5440e05fe2e447430db5afa676a46038c6afdfbf70ffbedb79f353c8d0dc4a430ed3df7dc13aeb8e28ab078f1e2f0de7bef993f5087406256b933d3218898f8356fde3ceafdad4d083d21a82a4b5550ba3e0f403c8872aabc988032c95f76e2e22f535d297fb961afaba06ed4c1b703a04eab56adb2bebcfefaebc3cc993353951a3f48f6264d9a84810307867efdfa85162d5a546a13994069db5fd953d38c4a82546e5498157fea85a061c2bc34fae9a79f1ece3cf3ccf0831ffc206cb6d966d62084618443f814075572e1c28561eedcb9e1e1871f0eafbdf65af8e73fff19962f5f6e7ec4232cb3131d495c4c801fcf08849a1161430099551b366c686e1ee4f9e1871f5a1af21713910eef8f0873a74e9d6c36dd628b2d8c00ef1e1f7ffcb195f7c1071fb4ba6cbdf5d656beaf7ce52bf15de4048b471e80b6a8ebf0ec891dfae4934fc2b3cf3e1b7ef2939f98497dfde044bd09c76bc1c9279f1c468e1c6903a0fa5ced4218b595f2b1bfabffac76af705b17ff72a3dc9f80751eb10193c8b849643c3363632777dc7147121b3a99316386f903dcb143848504ef1667c5240a5bf2c20b2f24175f7c711267c724aa9249646a5a2da5d8b149eca824769c997a969f0f2b923fe4e315861145014ae24c6a1405cee2f87ce20060c4f3d7bef6b524be87a66d20aaeba03e7190b1bafcf9cf7f4edab76f6fed1007b9b49d680bb523ed3462c488246a2b161752bf7b1ec0ddc3871129be78e3d34fa14f8d5641ab561945e1375ab9125a997c2cfaf8e36445a44ccc68c5aa800a79fef9e787f9f3e787a953a79aaa173bc4c27a537680193bab527af8c7064f671d6615d44dd267d67bebadb7ec79c99225a68a322342cb962db31114900676a5ad7c495776b9fb3885f0e553197d38ecd473f4e8d1f65983f4fd7ba2f2282514b68b7f561d69731632c68e1d6bef583cab3fd45e3cb3e03168d0a0d0bb776f7b1ff3f0698362ed57088501b2a7a6fb536e7cb17f2604ad1034280dc8cad329a79c624bbc575d7595a990f84975a84ea6a319217528821867c4307bf66c5bc5dc76db6d4d2d440dc49ff70bca8390a266ca5d6980a54b97da2a2a26828b2acbb741e2f2e902b59174593d6501073516c1c2fdb8e38e4b5528315729a118dbc94d7d848a8d4a2f159181a3b03eb4559cc943af5ebd6c60e57d8cf8f2abae3ef6e595ddfeca5e68dadf88f85c112e7b880d9d4efdf11dcd5489891327da337ea800d8ab134a4f6a0a79f86708a85c902f87c20bbe0ed851555043de7df7dde4fdf7df37c24daa8dd223ac5775947fa9c1d70ff87a0254fe56ad5a257130fa1f955ccf71004baeb8e28ae4830f3eb0f8d4159086d2ab299032e98b5417f5c767d607e5fdf069a44cce68aa12e6134f3c618b04cc1aa81f6ddbb6b5d132364eb58ef4e4459a4023296e32658780c202cdb0b81586c704982aafd2109416feb2fbfc44a586c89869b9b043ac225e77dd75e1c9279fb4bae046bd547f9e518f595166a163871d76b0f840f5549bd566bd7d3f7913983dfec924349233f247358a5a27975e7aa9b96926a84e902e042233a4a39bec7257be0a2f7fc5951ba646664cf92b4de0e301d519c8cffb7b7b294075a18f58c439f0c003ad9f58e488838fd9a1282c368bfddffffd5f12d5485be4a02e6a17d21001991bb3bee4edcb965941f38d3e6cd830ebbcaf7ffdebc982050bd2cae7a83988d120d427b5b9dc14061571d75d77b59553840942b8301130fa2d6a23c92f7ff9cbe45ffffa57a5c1a4ae80f296de5b723520d6ad920ab1d75e7bd922c1cb2fbf1ca64c99927ed8cc5133888c65ed0b61f77d1185cd1673a64d9b16ba76ed1a8e3cf2485ba5c55d71501101dbe4468c18115e7cf1c570c10517d802506da982d5092b73ac58e6e0473c46d1f9f3e727db6ebbad8d921d3b76b44505dc73d40c685b6631a019084245bcf7de7b936f7ef39ba93a88e989194c2ae2871f7e68f1a46262d6c5190d6472468b1d566951a071e3c6a155ab56e6c672f99b6fbe697e396a066a7f3407401fdc7efbed21aaeee1e8a38fb6cf2e8461e6121186dd1b975c72897dfb648b1c9f45708708a345a3ba884c0a9a4007d1a17ca3623b93becdcc9b37cffc72d41c686bbe254e9830211c78e081f61199ef815e45949dad52575e79a5a98843870e3581c39def821248041737ec7511997e47a323e9183a6ca79d76b2cee2a3f19c3973cc3fc7ba833614d1ce3245b4397b453907c87125f69b3ef5d453e97bb1040733aa88f6319a198ce57a9e01422a815278c511d535647646a353590081115041d89e4367c577071b39196d73ac3b6843da54ccceb3848c3645f5636335bbe55f7df5550bcb8667407f108e6f9a975d7699f50326bb5b4827cbc864edc40474aac0474e54123a140660eb538e7583048af6c54488204e2f734a82337c9cf7d3ec0508cb2a23407de7480be1cf3bef3c53e9959efa2cabc8b4eae8edec87637918c640b5e1b8498ef5838487fd879c663ee08003c2c48913ed1d0c3fa9ecd899c538bd3e6edc385b0461a6a32f248820ebb319c8ec8c2601936ac36653cd68cc662c8ae45837a85d172c5860d73ff00ec662078316ee5e7840bb76ed6c2b15ef6803060cb0190c2104bc87911e031f288c9b35647628d1284967429cac6546a343516d38de52ac737183193c03f8656a314ad6a07a526fd511bb9e3935c071a3430f3d34ecb3cf3ee1b1c71eb3304002c8ecc589044e4ccc9831c3f69912167f8563614acbf43c130748f014366bc8fe9c5d015d4300432084557d4b83b1e8744cc262c20c2ca208b86711d45bed23bcf3ce3be1b6db6e0b9d3b770ea79e7aaa9d5e476d4420082be168d4a8916dde46006fb9e59670f0c107dba24756db6a5d516f040db0c42f26fac73ffe616631c01c08979fbd144f236fd6a0810530b3214c63c68c09bbeebaaba97d5cd34718a0ab21206628ae8d60e09a346952a5198c369340d677d41b41a3b335a34155099a9804a6e2eab2934e3a29f4e9d3c7aeac239ed4c8ac41f5e694f8b061c3ec30e939e79c6302a77b3035e3d1061c4fe1302d1fff794f03081ded06911e2683959f21eb2d62c3d50bc44eb7438254193ae28823ec8e07dc3d2263d85ec83ffef18fc9eebbef9eeec9ebd7af5f1285330d5318af94a1b27ad313c74de28c959c77de79491c8cac7d546fcc2860e93ec43df7dc33b9ecb2cb9265cb96a5f1d51e5100cd541e72afeef6aa2aad62eede0dbb0850aeda42bd1134f0dbdffe36153436b6befdf6dbe6ee1904fbd5575f6d277b090793c170d8e34bbe09a1ef3c50f85c4aa06cd449758c3394b9f30ca3fdfdef7f4f7af4e8618224e1527d798e2ab499cd9a35b30b8f888360121f90e6c6aa3ff9521ed54fc0cea6660da43aa6e3cb2ab7da42bd12341845ccd4b66ddb64eedcb929c3612e5fbe3ce9ddbb77b2e5965ba68ce7198e2b112ebcf042635675b23aae9441393d51e6c71e7b2c39fcf0c3edac17f56340915041b411834df7eeddede629ce8221608a0fd166b2d726c88f72c80e542e99944d7dcba9811b6eb82189ef91f6eca9b650af04edc1071f346141789a376f9e3cfcf0c369e7bcf4d24b76ad9c180dc6d36cd6b871e3a465cb9666273e8715057574a942f5030c104f3ef964d2ab572fab87ea87e905ac41830649cf9e3d93871e7ac8e232fa938e0837cc8d25684065f065c10ebdf5d65ba6fa1f7ffcf1497cd7b47aa1f676ead42979f5d557ad1d14b6b6506f048d8e98356b56d2a44913133498e94f7ffa9375d22bafbc62e7d4b8431146c31f8201e34bbf31e799679e691d86fbe0c183d3d1bd2e80722e5ebcd884c7d74df5a1ced899c1508f19f9016d83fa257ba16091ae7fae2d14e62b35f16f7ffb5bd2a74f1fab07b3b3ea263b75de7befbd4dd05497da42bd5a0ce142d45d76d9251de16ebef9e6e4b5d75eb3bb2ac478623a08d58aab0f88cb6d5af8415dba74b10b5671d7485a9b9d2690a7841d5376950b70e815e1d100a3ba79da6aabad921ffff8c7c6a8528b615e41e916a23aea4c1aaa872fb7d2967fb1300c76d46fc08001b670459f5247117daa3e93b06176e8d0c16e13537ab5817a2568a887eddab533e6a2d17ff4a31f553aed2b6244a4f3de79e79db433befffdef5b1cc2eafd0e3ff9d756877978c613f3e1867ddebc79764a995544311a65f7030ac277da69a7252fbef862ba38e0a9a64139c9873ac8543bfa3ac94e1866dbfbefbf3ff9f9cf7f6e77c0a84f300b893ae2277fb5032a25332069d656bfd52bd591d989e569353cd76c63aa3318116144d40fc2ebdd040c1c38300dd7a64d1b9b1dc51cb5d9611e7ef58fb2301bb168c1323df5d008afd11c4683783f3be9a4939237de78232d3b8c471a10f0335a4d41c2ad36e45926ee5cadbd62c50afbac3266cc1853fb687feae6eb5515291c2644f8a38e3acaf2261fe55d1ba8578b21bc8ba136d0f8121aec1af9b03373e91b119d01f302ff8e86a0f1dd494c5a9b1de62166a18c4b962cb132324bc154c5eac685a3a89173e6ccb1cf14082a501d04d2ad0d902724a196a0a1c2feea57bf4aba76ed6a6d4db9a9830406bb060dd9a99f27d559e1595dbdfcf2cb938f3efa28cd17ca05ad9a41832e5cb830d96bafbdac03e81c7502c428cf4769af2e4a9000ef68ea3c3a1f66c5cf536d833c61ca8b2ebac8be73513e319dec10ef60a84bacb252372de4887c3d65af8dfa9017028f1a7ed34d3759fbf30ead7e91ba4b7d347be959fda73ae2564884e5350081bdebaebb2c3feaabbcb1d756bfd53b4143755427d04198102fd37c6fa90adffbdef7d24e6eddbab5cd681ed5dd619ee125107a66e4e71251ee3a64a416437a86e31926db7ffffd93679e79268daf74d7072a8bec4a0f929b4cd9155e754045e57be5b3cf3e9b0c19322469d4a891955765577ff8ba48f0508551f7f9d442bd247cf8637a6124ec8e3bee983cfae8a395caa772d536ea95ea88a0a1e7d31974a488657d3e68aa430a41e74c9e3c39ed7016439e7bee399b19f013135727288bd21593921ff7cc3383edb4d34eff33f253173d1f72c821c9134f3c61ef384a0b90de8694d5974926e5d27b95d2971feea86bf7dd775f72c6196758fb235c2aab04c3cf4e5e60b0b3fa3b76ec58bbcdf83bdff94ed2a2458bb40f556fc5c79d4f357c0364b6a40c1050b93606ead58cc652303397ef24881764967babea041815a6dd79e79d2d2e1f4199d10a19abba20e6908060c2b053a64cb13b0fc55498aa0bc480d1ad5bb7e4ce3bef3401a34cc4553a1a1836a4acbe6c4069034ccac9b62e76e1fce217bf488e3cf2489b7555460915e586b0ab1f10aa860d1b26871d765872eeb9e72677df7db7bd2fd3d67c7e6036f369887023eea1871e9a4c9b36cd048c72504fcaa476d8d0ba6f08ea8da0c1646c25d245aa74321d867ac54e0f3a843055810ed2d5e2bca33dfdf4d3e65e531da8590220342c0e20489459c2851d37980c95987a88f1454a033b7e12b6f5056990a618199359166de1da6bafb57760ca2601a08cbecc1230d9312106100689134f3cd1666ceacc374e3e3f68f5d42f8a60526fdce88fc71f7fdcea08542ecaea9f3137a4ee1b827a236874c21ffef007eb34dff17dfbf6b54e8501d55185a093f063a484095838993a756aa58eadce0e242dd2c6647146bb1dc4b4befc08182a956ef51543115f69149ad0fa823458769f39736672f6d967dbb63576cf4818209591f27953e586242c72f3267545781814ab0a8b1b2a25bb7d78ef2bac33a441b0d07d63a05ea98eec7fa3a3d459fc14ed534f3d95760a9d510cea2475180cc6beb95b6fbd35fd142006d788aff0f253fa3c17023f4fca876f75bc6b89b13cc3b2fff2faebafb79f0126ace21642f9a93c02cf107164579842e23bd6f4e9d36df1855fe629dc6542b9f48cdd971392a010c6fbf3ccac84bf1726116ef82b2c263f6fcc7bda238f3cb251b652ad2fead562080b1e74983aedd8638f4d67325131d09952b9b44569e8d0a1b66c8eeac6cb37b30e6a0e0ca9f723d2c3243e7609602194af980693977984c933a098921fe86380201e61996154c662f079aa4c9e7c394983154dbe39327beb975ea8a76f3b991065f2c286e985093b6198a9488bf73076acd07ebc77a13632e8290d8557fa106179dfa35c9453ed895955bd4b09f56a46e31d4b1d47878e1a35aad2a80815838451e13051233948ca911a18c3bf471c7df4d1b6b842383103040af3e059fed8119a6baeb9c698510c2ca6237d6638de5d14474c463d94472170f7428e09a97cd825586c49932aa8b6a20cbedd44f2c3eec38870933b0b49975c7249f2d7bffed5164b30f9788e80292fea09919eea8e9ace2602be17aa1f5467f5472e682586134e3821650c46d65b6eb9c53a4b4c2b46f410f37a81219cdc172d5a642b642c594bd8c883977a7ffec933b587d282d8a88c5a0a7315322a02ccb73c0eab1256e521beaf4321f017291cc2cc620edb9a481321200f4802a4fcc5f49ef9652aacecd41f3b84b022480c66acf692e7cb2fbf6c0b262c7a3040f9f81076d2563a083d7b3629bb061291af1366a9a3de081adf72f6d9671feb5c8863327cdb5187c1b85031a8337dc77ae656c7b36999cdaeac10b24871f2c927a73f9e471840386f2a3eb3140c08b3890131613ccacaf501a4a3b4540ea52bb310844315641661d5f5d4534f4df7784a80c4e4d83d49081446ee0a8f293baa25bb53faf7ef6fb315f932d33078b01acad5118453bc6276ca83491e4d9b36b50517d515d03faa3ff0f52f7564f237ac055fb5d9b367db7568bacf318ee2e1d65b6f0d71d44c6f6ac25c5f4406b0cb6b648fef69a16fdfbe76fd75972e5d4214bcd0b3674ffb713d2132995d60c3c53ffc201f65c40d52d9b9979ef85cf576cc31c7a457e101ca0bf18c7b643abbfffe85175eb0b49e7ffef9b070e142bb30f6830f3eb08b4e09a378bece32e51f6715bb620f3b6963a72c471d755458be7cb9fd9e01cfdcfa4c1b7ef7bbdfb5df37d87aebad2d9d28d4e137bff98d9581fad126a445fa4075c40d53f58d9a868539ebacb3c2e8d1a3cd8db0751d99fdb178913a945f3719326448f8e4934fac73b9c6fa8e3beeb0eba9ab0362509fe7b265cb4254cdc2f4e9d3ed197fee3f8421b93519c20de1e7c62dd2503841cfa409733340b469d3c60477b3cd360b71a6b69babe23b4c88b39631becae2e1d3c52ee6959062e20fc5d929b46fdfdeae9ae38a3e0861225ffc24d44a873894e3f1c71fb78b53f9517e7ec51377c208b2130741e65632ee8de499fc951e6df4d0430fd94dc74abfce23562e93881d97aa672c5cb0af8ef732aa0ca1d6456649c329ecfa82f87a59c7aed5495456164778c752de917152b5a9f059f6c8cc66e24fb9e52fbb9e9526a467efaeb0aabbe2c9241f5603599460ffe0b871e34cd5549dd42e98bebdf87645bbf2a19a4521b645f16ea5fc0af381589a67570d7dc10548ac2492bfca859d5d24d75d775dbac0a1fceb3a322d683006c4475fde99c4bc10ef511e1bdaa1ca0b06297ca7e0633277557067c9a04183ec632ccc2d46e4fd460c898950c8ee85c58781a9254c10eeb22b9caf2fcf9ef8181cd53dfbf0ce2205ef529457ed06b07b8687a80f8b3c2cdab08882f07861216d6fe2c73be6cf7ef6335bd9e49df5aaabaeb2051fc59380b24012d5cd4a03169405645a758c9d67cf5c53dda3470fbb0854e01da25bb76e154fe571147e7d51d8943c47864bd3c68c8c63aa17ef70a87aa88ca890b8f16b2bd75c738dbd53f14e445cc21317d33f83264d9a982a871a46dd780f531d952f44daa863871d765838fcf0c3c337bef18dd0ba75ebf4de7ba5e7c363ca9d3c510defbdf75e530b31f9911085573899801f15a4cd6963eeeb8f3395bd238e1a35ca7edd13155e713179dfc3ef8c33ceb067ca9f256456d0e8c0382ada333f8ec70fdef18c3b0b120f3cf040d87df7ddcd7f6303a182e929b704915f6c61210193dfe0e67d8cdf1fe3bd8677a63823581c092075c3ce0f4b30b0c0b8c4e14666aee9e6d75f481752db104fc2a136c3c48fb411da254b96585bd1862cb4a80d7d784cc26fb3cd36f63bd5fcca27bf55cd0020ff389385a81286112346a4b73d6be0a07efc6e1a8b4584853287d8109945ec44bb7aac73e7cea96a03718cff8bce9ed5262823844a06e9dd4ec08e2aa53091d18d50f33081d43bdca4fe090a4b5cdc450a27bbd2262dbe79f18d91232da8985120528a0295b6232a1f6e7186b47da44b972e4dcb405a4a9bf4fc551051d853d5927743ce8cf938594466058d8ea3d3d8122566a1835994e06c138c550a1033c2649ec4f812104cef86897b3153a470de0f53f9f97c59d860db17d721b0254a42544c38202e39622709874a191cb4b1d7e749fadc4bc2c77be2a80f64e71d8f53dfaa1bf1a12c22b382a64e63d78698038289589880114a012a27e591dd0b829e059e81fc08079302f9298edc5557e58109317bb1b03169d2a424aaa5691b2104680098b2e3ceb6b0830e3ac8ae05d04e0de509fcee0d565b393fc76968e24bc024b05c59c075100021555a3ebd2c21d382c6ce7a96ace95c31ce31c71c63a37716401d35838841a57ae2266154384c092d07593966c2d6310981040293194d02b6fdf6db27bffef5af6dfb97d458a5a3b405ec1cd4e45c9a5656210930263b741070e2d6176452d0d4819cf295da4807d3f1ecefc31f46acebf075c02ee1c284e125681204ee6f64999d4f1d08126d222113d156b8711486f72ab66d3130f9f49417901d42c038dfa76f861256deeb942ea7d9d91f4a7ab9a065007cafe18e0a310fa62ed58129b2d0c9627a312d84ddbb71960c6161af218c0fb3ebfd0b014010b063f21d8b858dd1a347db02864f07bb279f3f8b20ecf1d45503a4ab9991670815926f64a44b9a12dafa82cc0a1ac72a5079e864848c4ee7c71de86490854ea60e2200d36347bd63b595db9639f7e5570ac5f8b24bc0b84e8f8fd61c24250d2f545ad5c4ae191393b69c3061826d26e6a33b69292fd246d8701f3e7cb8adf2124f694b80eb0b322968a83a6cf34155148341ec82a073d5d95980ea03e3f24eca162a7eef8ced4daa7731e162ab13efab9c124728894f9b880adb498281c9e20517e7f09b055eb0bc4023601c844583f0696b2613d5176442d0d48962067e701046f2232cab6acc720a23062a45880929a3ec7a16014c0615989913df9cc816a3435ec020061eb67f9d75d659f69ea4f4d5264ad3e7e905033b67cb386a437a5eb0686b4c048c0528b69b154bbfbe223382464732d272510d870e6130180b06408539fffcf3edfd0088794a1dd40b5056c8333d0276e38d37a6fb26b5f020c1c2ae8186fa73851b873d597687f121e0eda44f9e120c4fa8953a944abaca8fb4c98f7cd9d3c80c493f709d4361f9eb3332216862107ec78ccb4dc5703271d3495d75becc5284ca8929a6e7997afee52f7fb1a3fdfa6144313975c5ae67a87dfbf6c995575e69b390da089270a90d94bedc7c386e156603360b497e81c3e7c5bbf0c89123d3257be2fa4141549f919977b4d9b367a73fe30343c0008cbaa8538cb2621ee0eda50898d2333d3f22f8bbdffdceae76f3ea9a6613313c7e2c4cb084ce3b94d210a3f38c0060f28c9fcf476e84e1c401b786f1a320b4a3f2230f88fc780fe4462a8eca280da50df945149eeb333221687c1f428542c8fc880b43e80a0075b467b25206ccce0e1684865541eae3672dd513937aa22eb302c8ea9e840978b318b36be69130400c5adce84cba3e2f3fa31d70c00195def3f4219b67484246fa0a539f51d2820673d04962063dd38998bc078c1f3fdef6cc49b8201802e6e41a69bfac5cdb205fa07243623cefee1994bb43b84a9b7b23f9f0ab3a7986d733bb3ab85c8785076e0b2e264c4a1777e5532c5fca8580f1ab339c31f3f9f87c39b8c9d62abe532a4d28c717a3e467342f646224048d2ba0f9391e465d31028490c1a0bcb8b360001369b4ad6d505e8dec6268ca21534207d3b2a1f7f4d34f37754caa1975d1c765981c77fc59d5e3f0245ba2d41e42b17aaa0d9537d060c5962d2e6ae5bd8f7c684b0918f92b5f7e99e5e28b2fb6c514d2515f88727c314a5ad024209e395057d8d88a308901c51c3cb302c70a6321436d0c66205f0846f7a04caccc415cc7a68b52b592e7eb831d77eac525adbc0f919e766ea85e9ef13de4469e02cfc4e5ca027e938cb6949a28226f885546062dbed1110760921f2896678eff45490b1a1d4887d2b1bc87b18f8e3d7862404ccf1ceccc67273a2ff28523eec66006e54bf9c59c3037cbf27c54f6fb303111364cd9617e36fe4e9c38d1544ad2527bc8ee9f4585c01f283c5ba6ce39e71c5b38f1f9d2a69ac510308eccd0eeca4333b0d2d373b13c735406275cd30e52030a6ac0756d48a5a34e2816bf58da856ea87edc11c8f6206df1d168ef09e163d4d5e5a24079ebd9e75313282c3b5019b8b598f728eaa11b888bd5458cce95df6c9fa2ee5eed03b27b01c3acaa9e0a8bc9f23b8b439481fc102e9f3f82cd7e45ce8ff13944e9fb34bca9f473ac191c4d2fda905235f0d7bbceda34aa3a5ce9e859ea12902a851fc47b824647e2f161b577efdea6526984976a236614a374efdedd7ebf592a22f195674d82ba5166e5a767f901189bad6030afd442caad0fe9945f42873b2b7d9c38d07b90d2955908b599f7a31d20dc685740bbb3358bc513b5a1dacfb727bf21c04a67613d726c38b8073059b06081310cc42203b72201319167a63541e139bfc495cebc68d371c4c55da6d283d81ac54a1b2ff9a8539e09c41830036e3cc3a8a8917ca086a97cfaa40bd506547ef2a30ce4afa3282c7f6b6183328b3c7363e7a4321f7b59f193802120aa8bda0c2a06d55de590491ab40da7c9391643de2a0ba6840bf3dbdffeb6eda891807aca513de0a2145b3c601701bf5a0ff3b2774e3f9a0ed101eac4358170a429c6230e26a4f42066217e9d91fb3b781f9010a9f34530a5fc189109cff179a5e9f350deb501d5837a3250b0e4cdec4a5d28ab06091175a03ecc6cecb26011423f3d443a407551da40cfc5da1e3791ea8f9da57e7ef5930396be0cbe2ca8e2cc60b7df7ebb9541e9d0d7a42501ce513db0c5101a956f4e526f18f1f836851ae11b7d6d1a5e6134d3001840028090f4ecd9331d5535ba8b092458b811866f3acc5eccb430046a2c206dd254ba85cc5993204feac74f27b183dd975f75c0cd0f1eb42d61752f3de5d70006a81bc0ddd783b055b53d7e84251d40db3050b24386bc7d5baa8cb8a1922388c4f5ed875de50035dd8ef5096534666c64bbf28c2bd9b82f9dfb0163c784a8fa84ce9d3bdbbd7c7126b1abac418c63fec48b9d67c4f5d7513043549decaa33c2c44eb6305c79cd3568dc09cff5658a47184cc2c5b218916e64c870da69a7854e9d3ad9d56a71f4ad740599d21688277f6f5f5b288ecae3edf8a97c9109edda6beeec9f3973a6ddcb48bbe10f110728fee69b6f6e6dc7bdf95ca91d07afa2e5537dbc1f6da43aaa1c82c2612a5feea9bcfaeaabad9d57ae5c99bafb30bbedb65b88da4b38fef8e3ad8f544e4ca587e9f3c8513db07b1d69d4389ad9dd7cdc857ee38d3786db6ebb2dc49132bcfbeebbe98f1a70177b8b162d4c00098750e0cfbdef84250d407aea3c3a19a629843a918e8ea37d68dbb66de8dab56be8d3a74fd87befbd2b31594d81bc01795066816731609c25427c670df7df7fbfb5093f5aa13a51ffc234b82894bb0db93cb457af5ea155ab56d62ebe3ed01781f0a42da86ce4e5dde33b5d78fae9a76d8044f01908c847e5271ecf083817930e1c38303468d060adca90a39a113b235551505bb0b34a853a829d5d0bfcda7dec30533bbc7a89897becb44a6a92fcb02bbc88709159cc8f772eeea5e01b9154264ca0fc6b12e4a7ba7bc28d0fc22c6a5046d5456da07a60aa2ebcf3f06d8ac525959df4b163fafcd6048507ea17a58909b178c1428aca429b530e951562d188d3cd7c5704c417e5a85dd88c163bd646bfd839e948173bc34c66b9d8b13672de75d75d61dab46976fb6d6400f3273c716367a7a328719a366d6ab314ea26e9cb9f1b6bf7df7f7f1bf1b996ba61c386699e84f365f0f69a80f20398948f7a8e1d3bd67ecd240a4dda0e826f27d42f660a7ecaa843870e36d35377c208be6d30c19aeae4e32b1e6ea8e7e3c78f0f53a74eb51b8c059f07e0a793060f1e1cfaf5eb1776d965974a6552d835952147f5c2048d0ea2e1e9049940a63a5ac4bb09d74ed3a1302bbf7f8560c5d1dfee5cdf71c71d2d9c3a5fea8ee22b3da1989b18a1261942f9a1fece9a352b4c9c38313cfae8a3a62ee2e7db0460327074ecd8d17eab8cdf5be3fdd133aeea4b3c486de0ebe1edc5a07201e2ce9b37cf7e626adcb871762f3f200d85537a3becb0835dfd7deeb9e7da20e6413abe3fd654861cd58cd8599944642853c1a40aca4d843bcbe0fcd42b278323e3fdcf4a21cd23778ee14c9e3c3955e194e6ba42f164520e08e04699315117f9bec94f3e510eca00a93ca88a10aa39e5e7a79374825c58df32e6a87e6452d0605620c6d5bb270453b3c4ce065df6fac1ac62649818411313f3c199ad502c996bff249030ac0f88abf82aa7848d72f2d1fae69b6fb68dd3e42f61a75c2aa706033e1770e73d1b7e95cefa962b47cd2293bf26032213a7ea152a13ea2def5d93264db25f47890c69e1547d858350bb8e3df658fbb54e3e2f900e208eec98b2af0ba230d92a6b140a53e148933cdf7cf34dfb65d01b6eb821cc9f3fdfca0f7cde84e7279e0e39e4102b1b3fc11407042b3be164ae4fb972d43062e764167c7c65d5945f9064232dd56546c0d47e43482a58142afb90ab998bd901029a895891f5eeeb0ae2e9a3306a28ab943ffde94fd3439e948719cb9795673edc732f253bef95bf666a40d9e49ea3f490494183d9384879dc71c725cd9b374f552f4c919e61703e31b0cb4337371523d294b9210c2d1571d6ac59563e1dfbf16543c044949f9b83f509847ca5227abbcae651f89c63e3a1cea98e2aaeccc8984691a9ec9925f93163c6d88fdef1ab94f81156a6e2f15139327ae8dbb76f68d9b2659a0eb426f8f430c95bf1e4e6edca931ff2437d6575f3befbee4be34641337fd95107f7dd775ffb787fe28927da6aaed2cc51471199a04e81515a2b7f7e0510758c335ffc6839334164cc7456a09acc1aa88b6c9e66232d2a20b38157139931d6167ea6d333f135ebe8999540cec9b12aa8c50dca2252f9203e7ab308c2e20bf1a91f589772e5284dd4b9192d327185ad1c3c2f5ebc385c78e185e19e7bee497f1b99992132ab2d20f0ad8b8fb7a79c724ad873cf3ded19e0e7671cc55b137c78a03464922f659a3c79b2fdde33fb3bd9c606489f300a0f581c19306040e8dfbfbffddcaf16380065040a9ba36ea2ce091a4c0c28367bfda64c99122ebffcf2b074e9527397208aa1bff5ad6f85e1c387db0fa5c3c002e12454b2137e6d040d4888898b10b09177eedcb9f6c19b1f54e787dfe36c5949402488807cb4ba8990b1834365571c99b84be072d451c48eaf53884c676a22b7ef72b83232a0a98991718d64e75754385fc7d111e240a86390d28104b9af2d88cb37afd75f7fdd7eb2a869d3a64890e5af32f02c53eefc26003fd2c7dd26d48374505f953f76a98a32d7b56c394a0f252d6830a1de79047eef8babd1f4830e12343137c432388208237be12a04e9ea3d8f30ca0766f77e32e5ced9b8418306d955e3badc947c31f95420bb8877430e85f2719943a2bcb7292d2847f651d2aa63647e539f208a1999d256132fb8e002fbf00be487c979ab61c386d9792b8ef508f845e6af785a0dd2c75d4d4038dc50d370933be7f3d80b895ac8c66adebf08872a8a097c39309b356b66e7ea38fac3fe438e17c91f2a8c9323e3881d5df288cc6cb3ca73cf3d673f32ae598cd903935985abd1f8113dc242cc84dafb57d5ac21d50c1046f9108f9bab58fde337beb85c877c203e6c2b7f9a0f93678823355dba7449a64f9f6ee900a9879a9965077ace917d94fc8ca61987850f4e79b37d8a192732a885d96fbffdc2b5d75e6bdfc598c5708fcc6f447cc212bfd88c4658dc991dd902c5e9640e78b2a8c191140eb79286b64c096a324c8eca502e4e51b362c8c14aad1a2a1ca03c803c55264865cd916d94b4a08919a13973e6d8b9afb7df7e3b65cce6cd9bdbaa232b8b72c3f40226e0ce337b1e172d5a14162e5c68c74fb87a0193554b1f1ebbd2c42ee146303967a72b1e500db7db6ebb34ac401cc8aba6a0305c8efa81921734a0d98bab04860c1962dfa46058ce5d0d1d3a34152220c646d898a9888b50cd9831c3eed540a898713443118ef83e0d090371b1733d0167efba75eb66f9f32d4e82c76c473cc5c991a3184a5ad0c4e832a13befbcd34e35af58b1c26612a98b02d541d87043d0f880cd414ea5839f5028208a87f0706f497cdfb21df21ca8e4602bc2461cc220acc4456065cf91a32a94c511bd64050d26966078a19831e3a1306ad495f64eb56ad52af32b141aec0884669e62fe10a7c1dbb56b67ef57a8847becb187d9b7d9669b349e0450f1b103ff2ee60538478e4294b12a56612f39c0c0a87652f5c4d0104c3f61c2843072e4c8e8c7a209aa1fb312028650956f6d625643d856aefc246cb1c516a151e346619fbdf70907773ed8ee2d69dca891a5eddfc1489bbc80ec7ac65f76a99d8a9323475528637743853d0266e1b1d014369e3fcc5d56c6ac01d3479fe885f9def2f7c2e7158256557c040fa1d8628bcdc3565b6d6d0258399c503cbef2abca7f3572ffdcbfb87fd9071ffc2b7270c5736ee6666ed68859f6eeb2655873e4c85183287bebed7fe6829623470da3ecef6fbc990b5a8e1c358cb2d75e5f5cbe441795c9b2f8af7cd1219aee39f7cffd73ff0df32f5bf8eaa284605521068bc1ab46ee9ffbe7fe55a3dc3f84ff07f21dd18089a186300000000049454e44ae426082, 12312, 'asdsadf', 9);

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
(9, 'sdfsdf', 13);

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
(93, 'fa', 'fa@gmail.com', '$2y$10$ZTDW5QhlX05/2LzQE4XCwuX7KQqxcr92EfLxTj6wLyu4k.x2N/b/G', 3),
(94, 'fab', 'fabian@g', '$2y$10$WV7fMYyeTNi3uMyQaQD6reMe9MDTS5XbD0vgYUWyLn.JMnNxJMsSa', 3),
(95, 'juanito', 'feo@s', '$2y$10$ACcYFqamY5SrPwfxOV42RePGP7ixajXEzeNTuTAHT4jK0yjYp0Evy', 3),
(96, 'sdfcsfsdf', 'sdfsdf', 'sdff', 3);

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
  ADD KEY `fk_usuario_rol1_idx` (`rol_id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  MODIFY `idcalificaciones` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categora` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `estudios`
--
ALTER TABLE `estudios`
  MODIFY `idEstudios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `experiencia_laboral`
--
ALTER TABLE `experiencia_laboral`
  MODIFY `idexperiencia_laboral` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `hojade_de_vida`
--
ALTER TABLE `hojade_de_vida`
  MODIFY `id_hojade_de_vida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `id_mensajes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `idnotificaciones` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `oferta_empleo`
--
ALTER TABLE `oferta_empleo`
  MODIFY `id_oferta_empleo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `sub_cat`
--
ALTER TABLE `sub_cat`
  MODIFY `id_sub_cat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

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
