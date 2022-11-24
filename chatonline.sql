-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-11-2022 a las 11:06:22
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `chatonline`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contain`
--

CREATE TABLE `contain` (
  `id` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `idroom` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `iduser` int(11) NOT NULL,
  `idroom` int(11) NOT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT 1,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `message`
--

INSERT INTO `message` (`id`, `content`, `iduser`, `idroom`, `activated`, `date`) VALUES
(9, 'HOLA', 14, 1, 1, '2022-11-23 20:25:00'),
(10, 'HOLA JUANMI', 5, 1, 1, '2022-11-23 20:25:08'),
(11, 'Adios JUanmi', 5, 1, 1, '2022-11-23 20:26:47'),
(42, 'hola', 5, 2, 1, '2022-11-24 00:51:20'),
(43, 'adios Juanmi', 5, 1, 1, '2022-11-24 00:51:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `room`
--

CREATE TABLE `room` (
  `id` int(11) NOT NULL,
  `privated` tinyint(1) NOT NULL DEFAULT 0,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `room`
--

INSERT INTO `room` (`id`, `privated`, `name`) VALUES
(1, 0, 'Sala 1 Jiji'),
(2, 1, 'Saluski 2 Super OmegaChetada Cambiada de nombre'),
(3, 0, 'Sala 3 creada a traves de la web ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `rol` tinyint(1) NOT NULL DEFAULT 0,
  `activated` tinyint(1) NOT NULL DEFAULT 1,
  `vip` tinyint(1) NOT NULL DEFAULT 0,
  `birthday` date NOT NULL,
  `img` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`, `rol`, `activated`, `vip`, `birthday`, `img`, `status`) VALUES
(5, 'ivan', '2c42e5cf1cdbafea04ed267018ef1511', 'ivan@gmail.com', 1, 1, 0, '2022-11-12', 'Vani.jpg', 1),
(14, 'juanmi', 'bd91949d7028b7570eb283a0829557d4', 'juanmi@gmail.com', 0, 1, 0, '2003-09-15', 'minion.png', 1),
(19, 'pepe', '926e27eecdbc7a18858b3798ba99bddd', 'pepe@pepe.com', 0, 0, 0, '3212-02-12', 'minion.png', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `contain`
--
ALTER TABLE `contain`
  ADD PRIMARY KEY (`id`),
  ADD KEY `iduser` (`iduser`,`idroom`),
  ADD KEY `idroom` (`idroom`);

--
-- Indices de la tabla `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `iduser` (`iduser`),
  ADD KEY `idroom` (`idroom`);

--
-- Indices de la tabla `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `contain`
--
ALTER TABLE `contain`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `room`
--
ALTER TABLE `room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `contain`
--
ALTER TABLE `contain`
  ADD CONSTRAINT `contain_ibfk_1` FOREIGN KEY (`iduser`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `contain_ibfk_2` FOREIGN KEY (`idroom`) REFERENCES `room` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`iduser`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`idroom`) REFERENCES `room` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
