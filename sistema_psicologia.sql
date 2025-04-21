-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-04-2025 a las 07:42:48
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
-- Base de datos: `sistema_psicologia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consultations`
--

CREATE TABLE `consultations` (
  `id` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idPsychologist` int(11) NOT NULL,
  `consulDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `history`
--

CREATE TABLE `history` (
  `ID` int(11) NOT NULL,
  `datos` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`datos`)),
  `idPaciente` int(11) DEFAULT NULL,
  `idPsicologo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `history`
--

INSERT INTO `history` (`ID`, `datos`, `idPaciente`, `idPsicologo`) VALUES
(2, '{\"nombre\":\"Rafael\",\"apellidos\":\"Figueroa\",\"cedula\":\"30145757\",\"Edad\":\"22\",\"fecha_nacimiento\":\"2002-11-28\",\"Localidad\":\"Barrio Uni\\u00f3n\",\"telefono\":\"04245540984\",\"email\":\"rafaelantonio28112002@gmail.com\",\"estado_civil\":\"soltero\",\"profesion\":\"Desarrollador de Videojuegos\",\"estudios\":\"UPTAEB\",\"conocido\":\"Instagram\",\"sintoma\":[\"Fracaso\",\"Ansiedad\",\"Flojedad\",\"Culpa\",\"Desconfianza\",\"Cansancio\",\"Sue\\u00f1o\"],\"otros__sintoma\":\"\",\"convivencia\":\"Con mi nucleo familiar\",\"relacion_mejorar\":\"absolutamente nada, ta todo bien como est\\u00e1\",\"area_conflictiva\":\"nou\",\"alcohol\":\"si\",\"frecuencia_alcohol\":\"poca\",\"fumar\":\"no\",\"frecuencia_fumar\":\"\",\"sustancia\":\"no\",\"frecuencia_sustancia\":\"\",\"rutina_sueno\":\"malarda rutina de sue\\u00f1o, que paja explicar\",\"acudido\":\"psic\\u00f3logo\",\"tratamiento_recibido\":\"no me acuerdo\",\"finalizado_tratamiento\":\"no, que paja explica\",\"personas_significativas\":\"quien sabe\",\"ayuda_terapia\":\"quien sabe\",\"espera_terapia\":\"quien sabe\",\"compromiso_terapia\":\"5\",\"duracion_terapia\":\"un chingo\",\"importante_reflejar\":\"nada\"}', NULL, 33),
(3, '{\"nombre\":\"Juanito\",\"apellidos\":\"Perez\",\"cedula\":\"123123123123\",\"Edad\":\"1\",\"fecha_nacimiento\":\"\",\"Localidad\":\"\",\"telefono\":\"\",\"email\":\"\",\"estado_civil\":\"\",\"profesion\":\"\",\"estudios\":\"\",\"otros__sintoma\":\"\",\"convivencia\":\"\",\"relacion_mejorar\":\"\",\"area_conflictiva\":\"\",\"frecuencia_alcohol\":\"\",\"frecuencia_fumar\":\"\",\"frecuencia_sustancia\":\"\",\"rutina_sueno\":\"\",\"tratamiento_recibido\":\"\",\"finalizado_tratamiento\":\"\",\"personas_significativas\":\"\",\"ayuda_terapia\":\"\",\"espera_terapia\":\"\",\"compromiso_terapia\":\"\",\"duracion_terapia\":\"\",\"importante_reflejar\":\"sdsd\"}', NULL, 33),
(4, '{\"nombre\":\"Pibe de prueba\",\"apellidos\":\"sin apellido\",\"cedula\":\"98765432\",\"Edad\":\"54\",\"fecha_nacimiento\":\"2551-12-11\",\"Localidad\":\"Cabuyork\",\"telefono\":\"0454545445\",\"email\":\"asdasdasd@tal.com\",\"estado_civil\":\"divorciado\",\"profesion\":\"Comerciante\",\"estudios\":\"UNEFA (me compadezco de el)\",\"conocido\":\"Amigos\\/familia\",\"sintoma\":[\"tensi\\u00f3n\",\"Ansiedad\",\"Celos\",\"Flojedad\",\"Sudor\",\"Culpa\",\"Cansancio\",\"Sue\\u00f1o\",\"Nerviosismo\"],\"Irritabilidad\":\"Irritabilidad\",\"otros__sintoma\":\"y los que faltan\",\"convivencia\":\"copiando y pegando texto pa rellenar los formularios\",\"relacion_mejorar\":\"copiando y pegando texto pa rellenar los formularios\",\"area_conflictiva\":\"copiando y pegando texto pa rellenar los formularios\",\"alcohol\":\"si\",\"frecuencia_alcohol\":\"copiando y pegando texto pa rellenar los formularios\",\"fumar\":\"no\",\"frecuencia_fumar\":\"copiando y pegando texto pa rellenar los formularios\",\"sustancia\":\"si\",\"frecuencia_sustancia\":\"copiando y pegando texto pa rellenar los formularios\",\"rutina_sueno\":\"copiando y pegando texto pa rellenar los formularios\",\"acudido\":\"otro\",\"tratamiento_recibido\":\"copiando y pegando texto pa rellenar los formularios\",\"finalizado_tratamiento\":\"copiando y pegando texto pa rellenar los formularios\",\"personas_significativas\":\"copiando y pegando texto pa rellenar los formularios\",\"ayuda_terapia\":\"copiando y pegando texto pa rellenar los formularios\",\"espera_terapia\":\"copiando y pegando texto pa rellenar los formularios\",\"compromiso_terapia\":\"10\",\"duracion_terapia\":\"copiando y pegando texto pa rellenar los formularios\",\"importante_reflejar\":\"copiando y pegando texto pa rellenar los formularios\"}', NULL, 33);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `cedula` int(9) NOT NULL,
  `name` varchar(32) NOT NULL,
  `lastName` varchar(32) NOT NULL,
  `mail` varchar(80) NOT NULL,
  `password` varchar(80) NOT NULL,
  `birthDate` date DEFAULT NULL,
  `gender` char(1) DEFAULT NULL,
  `role` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `cedula`, `name`, `lastName`, `mail`, `password`, `birthDate`, `gender`, `role`) VALUES
(32, 30145757, 'Rafael', 'Figueroa', 'rafaelantonio28112002@gmail.com', '$2y$10$8MZTOzgYNfwnpC.N1FDAj.yosIfpuwJgWJzpULJR0qPgE8aurN6OW', '2002-11-28', 'm', 'c'),
(33, 12345678, 'Juan', 'Gomez', 'juangomez@gmail.com', '$2y$10$mW/AIWfDk.kDt5ahS5SOYu.wqLdOL/rFWSubkyyLTi67v/ZzNZgKi', '1111-11-11', 'm', 'p');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `consultations`
--
ALTER TABLE `consultations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `consultations`
--
ALTER TABLE `consultations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `history`
--
ALTER TABLE `history`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
