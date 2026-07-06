-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 06-07-2026 a las 21:39:01
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
-- Base de datos: `db_isolde_maren`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `piezas`
--

CREATE TABLE `piezas` (
  `id` int(11) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `descripcion` text NOT NULL,
  `anio` year(4) NOT NULL,
  `materiales` varchar(255) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `estado` enum('disponible','vendida','museo','exposicion') NOT NULL DEFAULT 'disponible',
  `ubicacion` varchar(255) DEFAULT NULL,
  `id_serie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `piezas`
--

INSERT INTO `piezas` (`id`, `titulo`, `descripcion`, `anio`, `materiales`, `imagen`, `estado`, `ubicacion`, `id_serie`) VALUES
(10, 'Raíz Suspendida', 'Forma ramificada que cuelga en equilibrio inestable.', '2019', 'Bronce patinado', '', 'museo', 'Museo de Arte Moderno, Buenos Aires', 1),
(11, 'Pulso', 'Superficie ondulante que simula el movimiento de un latido.', '2021', 'Bronce y acero inoxidable', '', 'disponible', NULL, 1),
(12, 'Cápsula Orgánica', 'Esfera irregular con interior excavado a mano.', '2022', 'Bronce fundido', '', 'vendida', NULL, 1),
(13, 'Umbral I', 'Arco de mármol de escala humana, superficie pulida al espejo.', '2020', 'Mármol blanco de Carrara', '', 'exposicion', 'Galería Nordart, Hamburgo', 2),
(14, 'Umbral II', 'Variación fragmentada del arco, con fisuras intencionales.', '2020', 'Mármol blanco de Carrara', '', 'disponible', NULL, 2),
(15, 'Pasaje Silencioso', 'Dos bloques enfrentados que definen un espacio de tránsito.', '2023', 'Mármol y granito negro', '', 'disponible', NULL, 2),
(16, 'Estrato I', 'Capas horizontales de arcilla cocida que imitan sedimentos.', '2018', 'Cerámica de alta cocción', '', 'museo', 'MALBA, Buenos Aires', 3),
(17, 'Huella', 'Impresión de suelo natural en cerámica, enmarcada en acero.', '2021', 'Cerámica y acero corten', '', 'vendida', NULL, 3),
(18, 'Depósito', 'Masa informe de tierra y resina que parece recién extraída del suelo.', '2023', 'Tierra, resina y alambre', '', 'disponible', NULL, 3),
(19, 'Cristalización ', 'Estructura porosa formada por la interacción entre cera de abeja fundida y cristales de sal marina, suspendida en bastidor de acero negro.', '2026', 'Cera de Abeja, Sal Marina ', NULL, 'disponible', NULL, 1),
(20, 'Pieza API', 'Creada via API', '2024', 'Bronce', NULL, 'disponible', NULL, 1),
(21, 'Pieza API Editada', 'Creada via API', '2024', 'Bronce y acero', NULL, 'disponible', NULL, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `series`
--

CREATE TABLE `series` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` text NOT NULL,
  `imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `series`
--

INSERT INTO `series` (`id`, `nombre`, `descripcion`, `imagen`) VALUES
(1, 'Materia Viva', 'Esculturas en bronce que exploran la tensión entre lo orgánico y lo inerte.', ''),
(2, 'Umbrales', 'Formas en mármol blanco que evocan transiciones, límites y pasajes.', ''),
(3, 'Memoria del Suelo', 'Piezas en cerámica y tierra cruda inspiradas en topografías y paisajes olvidados.', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `password`) VALUES
(1, 'webadmin', '$2y$10$wSo7bCetVA9OjTjzQ5/qiO8LKYdWKvO4w3FzflVCfX05XEE1T.A6W');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `piezas`
--
ALTER TABLE `piezas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_serie` (`id_serie`);

--
-- Indices de la tabla `series`
--
ALTER TABLE `series`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `piezas`
--
ALTER TABLE `piezas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `series`
--
ALTER TABLE `series`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `piezas`
--
ALTER TABLE `piezas`
  ADD CONSTRAINT `piezas_ibfk_1` FOREIGN KEY (`id_serie`) REFERENCES `series` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
