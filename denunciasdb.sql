-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-12-2024 a las 10:16:22
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
-- Base de datos: `denunciasdb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cantones`
--

CREATE TABLE `cantones` (
  `idCanton` int(11) NOT NULL,
  `idProvincia` int(11) NOT NULL,
  `NombreCanton` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cantones`
--

INSERT INTO `cantones` (`idCanton`, `idProvincia`, `NombreCanton`) VALUES
(1, 1, 'Escazu'),
(2, 1, 'Desamparados'),
(3, 1, 'Tibas'),
(4, 2, 'Orotina'),
(5, 2, 'San Carlos'),
(6, 2, 'Palmares'),
(7, 3, 'Paraiso'),
(8, 3, 'Oreamuno'),
(9, 3, 'Tres Rios'),
(10, 4, 'Barva'),
(11, 4, 'Belen'),
(12, 4, 'Sarapiqui'),
(13, 5, 'Nicoya'),
(14, 5, 'Liberia'),
(15, 5, 'Santa Cruz'),
(16, 6, 'Golfito'),
(17, 6, 'Garabito'),
(18, 6, 'Esparza'),
(19, 7, 'Matina'),
(20, 7, 'Talamanca'),
(21, 7, 'Siquirres');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `denuncias`
--

CREATE TABLE `denuncias` (
  `idDenuncias` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idProvincia` int(11) NOT NULL,
  `idCanton` int(11) NOT NULL,
  `idTipoDenuncia` int(11) NOT NULL,
  `idEstadoDenuncia` int(11) NOT NULL,
  `DescripcionDenuncia` varchar(500) DEFAULT NULL,
  `Fecha` datetime NOT NULL,
  `DetalleUbicacion` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `denuncias`
--

INSERT INTO `denuncias` (`idDenuncias`, `idUsuario`, `idProvincia`, `idCanton`, `idTipoDenuncia`, `idEstadoDenuncia`, `DescripcionDenuncia`, `Fecha`, `DetalleUbicacion`) VALUES
(1, 1, 1, 1, 1, 1, 'huecos por todos lados', '2024-12-17 11:00:00', 'Lado norte de la iglesia del pueblo'),
(2, 1, 3, 9, 1, 1, 'La carretera esta muy mal', '2024-12-18 13:16:00', 'Por la Soda El Milagro'),
(4, 1, 6, 18, 12, 2, 'Hay gente fumando frente a la tienda', '2024-12-20 21:39:00', 'en la tienda'),
(5, 7, 1, 2, 13, 1, 'Hay demasiada presa', '2024-12-21 01:31:00', 'Por el Walmart'),
(6, 7, 6, 18, 9, 1, 'AAAA', '2024-12-07 01:37:00', 'Frente al mall'),
(7, 8, 2, 4, 4, 1, 'Frente al supermercado x hay mucha basura', '2024-12-21 02:40:00', 'Frente al supermercado x en Orotina');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados_denuncias`
--

CREATE TABLE `estados_denuncias` (
  `idEstadoDenuncia` int(11) NOT NULL,
  `NombreDenuncia` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estados_denuncias`
--

INSERT INTO `estados_denuncias` (`idEstadoDenuncia`, `NombreDenuncia`) VALUES
(1, 'Abierta'),
(2, 'En Proceso'),
(3, 'Cerrada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincias`
--

CREATE TABLE `provincias` (
  `idProvincia` int(11) NOT NULL,
  `NombreProvincia` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `provincias`
--

INSERT INTO `provincias` (`idProvincia`, `NombreProvincia`) VALUES
(1, 'San Jose'),
(2, 'Alajuela'),
(3, 'Cartago'),
(4, 'Heredia'),
(5, 'Guanacaste'),
(6, 'Puntarenas'),
(7, 'Limon');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_denuncias`
--

CREATE TABLE `tipos_denuncias` (
  `idTipoDenuncia` int(11) NOT NULL,
  `NombreDenuncia` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipos_denuncias`
--

INSERT INTO `tipos_denuncias` (`idTipoDenuncia`, `NombreDenuncia`) VALUES
(1, 'Calles en Mal Estado'),
(2, 'Averías en el Alumbrado Público'),
(3, 'Robo y Vandalismo'),
(4, 'Basura en la Vía Pública'),
(5, 'Animales Callejeros o Abandonados'),
(6, 'Ruido Excesivo y Contaminación Acústica'),
(7, 'Obstrucción de la Vía Pública'),
(8, 'Problemas en Servicios Públicos'),
(9, 'Plagas o Problemas de Salud Pública'),
(10, 'Actos Sospechosos o Violación de Seguridad'),
(11, 'Problemas en Infraestructura de Parques y Espacios Públicos'),
(12, 'Consumo de Drogas o Alcohol en Zonas Públicas'),
(13, 'Tráfico y Problemas Vehiculares'),
(14, 'Edificaciones o Construcciones Irregulares'),
(15, 'Inundaciones o Problemas con Drenajes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `idProvincia` int(11) NOT NULL,
  `idCanton` int(11) NOT NULL,
  `Nombre` varchar(255) NOT NULL,
  `Apellido` varchar(255) NOT NULL,
  `Correo` varchar(255) NOT NULL,
  `Telefono` varchar(25) DEFAULT NULL,
  `Cedula` varchar(50) DEFAULT NULL,
  `Password` varchar(255) NOT NULL,
  `isAdmin` binary(1) NOT NULL DEFAULT '0',
  `DetalleDireccion` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `idProvincia`, `idCanton`, `Nombre`, `Apellido`, `Correo`, `Telefono`, `Cedula`, `Password`, `isAdmin`, `DetalleDireccion`) VALUES
(1, 1, 1, 'Danilo', 'Retana', 'danir@gmail.com', '12345678', '123456789', 'abc123', 0x30, 'detras de la iglesia'),
(3, 1, 1, 'Sebastián', 'Sandino', 'lolsebasxd@gmail.com', '87516789', '123456789', '$2y$10$Av0TnHZ0SAPupAbfpCxbHeLzwk19MIBXFJ2kd.Q9A46x7SNRRBVdi', 0x31, 'Sabanilla, cerca del Mas x Menos 123'),
(6, 1, 1, 'ADMIN', 'ADMIN', 'admin@gmail.com', '', '', '$2y$10$wHk0Da5NQzSCNgXx6ostouyKidkpBy5DgQWfHQdTshfON2KVWvMBi', 0x31, ''),
(7, 1, 1, 'Francisco ', 'Jimenez', 'francisco@gmail.com', '55555555', '333444555', '$2y$10$rZwIfCefBsqxmq.Os05H6ewOhJ3FSb1vzzx5x2KrF8xCd5JIK4rX.', 0x30, 'Residencial Buena Vista'),
(8, 2, 4, 'Antonio', 'Flores', 'antonio@gmail.com', '55556666', '999888777', '$2y$10$f3FCsPTcPn7D2Bx5b3DRqOk/ARTTmm3I14jHQkw8.uL9bdEYTuHIG', 0x30, 'Del supermercado X, 500 metros al norte');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cantones`
--
ALTER TABLE `cantones`
  ADD PRIMARY KEY (`idCanton`),
  ADD KEY `idProvincia` (`idProvincia`);

--
-- Indices de la tabla `denuncias`
--
ALTER TABLE `denuncias`
  ADD PRIMARY KEY (`idDenuncias`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idProvincia` (`idProvincia`),
  ADD KEY `idCanton` (`idCanton`),
  ADD KEY `idTipoDenuncia` (`idTipoDenuncia`),
  ADD KEY `idEstadoDenuncia` (`idEstadoDenuncia`);

--
-- Indices de la tabla `estados_denuncias`
--
ALTER TABLE `estados_denuncias`
  ADD PRIMARY KEY (`idEstadoDenuncia`);

--
-- Indices de la tabla `provincias`
--
ALTER TABLE `provincias`
  ADD PRIMARY KEY (`idProvincia`);

--
-- Indices de la tabla `tipos_denuncias`
--
ALTER TABLE `tipos_denuncias`
  ADD PRIMARY KEY (`idTipoDenuncia`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `idProvincia` (`idProvincia`),
  ADD KEY `idCanton` (`idCanton`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cantones`
--
ALTER TABLE `cantones`
  MODIFY `idCanton` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `denuncias`
--
ALTER TABLE `denuncias`
  MODIFY `idDenuncias` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `estados_denuncias`
--
ALTER TABLE `estados_denuncias`
  MODIFY `idEstadoDenuncia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `provincias`
--
ALTER TABLE `provincias`
  MODIFY `idProvincia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tipos_denuncias`
--
ALTER TABLE `tipos_denuncias`
  MODIFY `idTipoDenuncia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cantones`
--
ALTER TABLE `cantones`
  ADD CONSTRAINT `cantones_ibfk_1` FOREIGN KEY (`idProvincia`) REFERENCES `provincias` (`idProvincia`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `denuncias`
--
ALTER TABLE `denuncias`
  ADD CONSTRAINT `denuncias_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `denuncias_ibfk_2` FOREIGN KEY (`idProvincia`) REFERENCES `provincias` (`idProvincia`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `denuncias_ibfk_3` FOREIGN KEY (`idCanton`) REFERENCES `cantones` (`idCanton`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `denuncias_ibfk_4` FOREIGN KEY (`idTipoDenuncia`) REFERENCES `tipos_denuncias` (`idTipoDenuncia`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `denuncias_ibfk_5` FOREIGN KEY (`idEstadoDenuncia`) REFERENCES `estados_denuncias` (`idEstadoDenuncia`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`idProvincia`) REFERENCES `provincias` (`idProvincia`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`idCanton`) REFERENCES `cantones` (`idCanton`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
