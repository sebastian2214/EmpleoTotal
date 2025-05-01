-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-12-2024 a las 17:09:14
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
(17, 'sebastiancamilo5612@gmail.com', 'b6bc5c0d99694e9ef78a79f1baaedc2ce25c1bba45c6e08ea9f4255990ed47f035a151dc47677346a95a9ec12683d647a8fe'),
(18, 'sebastiancamilo5612@gmail.com', '9e4c19f7a94bb2db6d3d6b5ab22685bc2eec6595081342fac461c91dfd2289593ed0d5b70c0af55e74a0651f8b5972164641'),
(19, 'sebastiancamilo5612@gmail.com', 'f3a1335de8c4acc08c95c4ccbce86a219a1a02fe9f6d0a85906eeaccbd117036da146b8a8dfe3601b452c9b7d4b0891989ff'),
(20, 'sebastiancamilo5612@gmail.com', 'd36228f2e5a7a1f19c2702d06e6da55b4f9d648757ede0c4fa3f072bc3898f18ef59febd47a00c96ea943718bb2e8819683c'),
(21, 'sebastiancamilo5612@gmail.com', 'd0961bf81b52b25e8cd13dd1444ecaa9fcc09aa51f9d49fef5bc40cb9431d4493a246ef281f7c8c90468f192bc76eb32f2f1'),
(22, 'sebastiancamilo5612@gmail.com', 'fc87ebfb220bd84cb7d4c9d6ff3242bd450700a7cd7d9de1f84561c4798841f6f16440c46ee205a45465e4efba9956ced7b4'),
(23, 'sebastiancamilo5612@gmail.com', 'a4e408d866ff4a852161c25b1e8c88fe819c0f03ec556b3814df83f77817ae45c8e1dfa80e0cedab5aab883662d043221f37');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `recuperar_contra`
--
ALTER TABLE `recuperar_contra`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `recuperar_contra`
--
ALTER TABLE `recuperar_contra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
