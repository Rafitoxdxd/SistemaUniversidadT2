-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-06-2025 a las 05:51:24
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
CREATE DATABASE IF NOT EXISTS `sistema_psicologia` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `sistema_psicologia`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita`
--

CREATE TABLE `cita` (
  `id_cita` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `idpsicologo` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `descripcion` text NOT NULL,
  `color` varchar(50) NOT NULL,
  `textColor` varchar(50) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cita`
--

INSERT INTO `cita` (`id_cita`, `id_paciente`, `idpsicologo`, `title`, `descripcion`, `color`, `textColor`, `start`, `end`) VALUES
(1, 2, 0, 'qweq', 'eqwqwe', '#6610f2', '#0d6efd', '2025-06-05 12:10:00', '2025-06-05 12:10:00'),
(2, 2, 0, 'sdaasd', 'saddsa', '#6610f2', '#0d6efd', '2025-06-05 12:23:00', '2025-06-05 13:23:00'),
(3, 9, 0, 'Mi casa', 'Galletas', '#6610f2', '#0d6efd', '2025-06-06 12:36:00', '2025-06-06 13:37:00'),
(4, 5, 0, 'Sin contrato', 'pasarla bien ', '#5e4587', '#48505b', '2025-06-05 12:41:00', '2025-06-06 12:41:00'),
(5, 5, 0, 'Sin contrato', 'pasarla bien ', '#5e4587', '#48505b', '2025-06-05 12:41:00', '2025-06-06 12:41:00'),
(6, 5, 0, 'Sin contrato', 'pasarla bien ', '#5e4587', '#48505b', '2025-06-05 12:41:00', '2025-06-06 12:41:00'),
(7, 7, 0, 'asd', 'asdasd', '#050505', '#0d6efd', '2025-06-06 12:46:00', '2025-06-13 12:46:00'),
(8, 7, 0, 'asd', 'asdasd', '#050505', '#0d6efd', '2025-06-06 12:46:00', '2025-06-13 12:46:00'),
(9, 7, 0, 'asd', 'asdasd', '#050505', '#0d6efd', '2025-06-06 12:46:00', '2025-06-13 12:46:00'),
(10, 7, 0, 'asd', 'asdasd', '#050505', '#0d6efd', '2025-06-06 12:46:00', '2025-06-13 12:46:00'),
(11, 7, 0, 'asd', 'asdasd', '#050505', '#0d6efd', '2025-06-06 12:46:00', '2025-06-13 12:46:00'),
(12, 7, 0, 'asd', 'asdasd', '#050505', '#0d6efd', '2025-06-06 12:46:00', '2025-06-13 12:46:00'),
(13, 7, 0, 'asd', 'asdasd', '#050505', '#0d6efd', '2025-06-06 12:46:00', '2025-06-13 12:46:00');

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
(3, '{\"nombre\":\"Juanito\",\"apellidos\":\"Perez\",\"cedula\":\"123123123123\",\"Edad\":\"1\",\"fecha_nacimiento\":\"\",\"Localidad\":\"\",\"telefono\":\"\",\"email\":\"\",\"estado_civil\":\"\",\"profesion\":\"\",\"estudios\":\"\",\"otros__sintoma\":\"\",\"convivencia\":\"\",\"relacion_mejorar\":\"\",\"area_conflictiva\":\"\",\"frecuencia_alcohol\":\"\",\"frecuencia_fumar\":\"\",\"frecuencia_sustancia\":\"\",\"rutina_sueno\":\"\",\"tratamiento_recibido\":\"\",\"finalizado_tratamiento\":\"\",\"personas_significativas\":\"\",\"ayuda_terapia\":\"\",\"espera_terapia\":\"\",\"compromiso_terapia\":\"\",\"duracion_terapia\":\"\",\"importante_reflejar\":\"sdsd\"}', NULL, 33),
(10, '{\"nombre\":\"Yahir\",\"apellidos\":\"Rivero\",\"cedula\":\"31574454\",\"Edad\":\"18\",\"fecha_nacimiento\":\"2025-05-23\",\"Localidad\":\"barquisimeto\",\"telefono\":\"\",\"email\":\"\",\"estado_civil\":\"\",\"profesion\":\"\",\"estudios\":\"\",\"otros__sintoma\":\"\",\"convivencia\":\"\",\"relacion_mejorar\":\"\",\"area_conflictiva\":\"\",\"frecuencia_alcohol\":\"\",\"frecuencia_fumar\":\"\",\"frecuencia_sustancia\":\"\",\"rutina_sueno\":\"\",\"tratamiento_recibido\":\"\",\"finalizado_tratamiento\":\"\",\"personas_significativas\":\"\",\"ayuda_terapia\":\"\",\"espera_terapia\":\"\",\"compromiso_terapia\":\"\",\"duracion_terapia\":\"\",\"importante_reflejar\":\"\"}', NULL, 36);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE `paciente` (
  `id_paciente` int(11) NOT NULL,
  `nombre` varchar(15) NOT NULL,
  `apellido` varchar(15) NOT NULL,
  `cedula` varchar(15) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `genero` varchar(25) NOT NULL,
  `direccion` varchar(30) NOT NULL,
  `ciudad` varchar(15) NOT NULL,
  `pais` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `paciente`
--

INSERT INTO `paciente` (`id_paciente`, `nombre`, `apellido`, `cedula`, `telefono`, `fecha_nacimiento`, `genero`, `direccion`, `ciudad`, `pais`, `email`, `password`) VALUES
(1, 'Beatriz', 'Pacheco', '123452341', '04266525038', '2011-12-08', 'masculino', 'Mi casa', 'Venezuela', 'Estados unidos ', '', ''),
(2, 'Shikamaru', 'shaixhsaiu', '121212', '04266525038', '2025-05-23', 'femenino', 'carrera 4 entre calles 4 y 4', 'barquisimeto', 'dinamarca', '', ''),
(3, 'Yahir', 'Rivero', '31574451', '2189219', '2025-05-23', 'masculino', 'hihsad', 'Caracas', 'Colombia', '', ''),
(4, 'Gaara', 'Uzumaki', '30880792', '03030303', '2011-12-01', 'masculino', 'carrera 4 entre calles 4 y 4', 'Caracas', 'Colombia', '', ''),
(5, 'lenny', 'Lopez', '31574454', '04145113673', '2025-05-12', 'masculino', 'carrera 4 entre calles 4 y 4', 'barquisimeto', 'salkdhsal', 'mama@gmail.com', '$2y$10$ib1x.zRf'),
(6, 'Maribel', 'Duran ', 'dfggggg', '04165678', '2025-04-29', 'femenino', 'ijjajjaa', 'barquisimeto', 'venezuela', '', ''),
(7, 'Lenny', 'Rivero', '31574454', '04149510472', '1992-07-23', 'masculino', 'Hola yo vivo en bequito', 'Barquisimeto', 'Venezuela', 'perrocall@gmail.com', '$2y$10$Bn67J3N5'),
(8, 'Camila', 'Toro', '30827652', '04266525038', '2011-12-16', 'masculino', 'Avenida libertador', 'Venezuela', 'Estados unidos ', 'yahir@gmail.com', '$2y$10$lS7FpW7c'),
(9, 'Tobirama', 'Uchiha', '12249177', '0414567897', '2011-12-08', 'masculino', 'Carrera  entre calles  y ', 'Caracas', 'Venezuela', '', ''),
(10, 'Jezuha', 'Palmera', '32066861', '04146587451', '2011-12-01', 'femenino', 'Carrera  entre calles  y ', 'Caracas', 'Colombia', 'jezuhaja@gmail.com', '$2y$10$/7KUrdkO'),
(11, 'Subaru', 'Natski', '32065636', '04266525036', '2006-11-04', 'masculino', 'Carrera  entre calles  y ', 'Caracas', 'Colombia', 'wizzard790@gmail.com', '$2y$10$u6oVEIAL'),
(12, 'Satoru', 'Gojo', '20144541', '0414660543', '2011-12-02', 'masculino', 'Carrera  entre calles  y ', 'Caracas', 'Colombia', 'yahirmosq0606@gmail.com', '$2y$10$z0D2M4Wx');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `test`
--

CREATE TABLE `test` (
  `id` int(11) NOT NULL,
  `idpaciente` int(11) NOT NULL,
  `nombre_competencia` varchar(100) NOT NULL,
  `ubicacion_competencia` varchar(100) NOT NULL,
  `fecha_competencia` varchar(100) NOT NULL,
  `preparado_competencia` varchar(100) NOT NULL,
  `entrenado_previo` varchar(100) NOT NULL,
  `estrategia_previa` varchar(100) NOT NULL,
  `descripcion_nervios` varchar(100) NOT NULL,
  `antes_competir` varchar(100) NOT NULL,
  `experiencia_pasada` varchar(100) NOT NULL,
  `motivacion_competencia` varchar(100) NOT NULL,
  `esperar_competicion` varchar(100) NOT NULL,
  `lograr_competencia` varchar(100) NOT NULL,
  `rutina_mental` varchar(100) NOT NULL,
  `pensamiento_positivo` varchar(100) NOT NULL,
  `reparacion_mental` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `test_confianza`
--

CREATE TABLE `test_confianza` (
  `id` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `respuestas` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`respuestas`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `test_confianza`
--

INSERT INTO `test_confianza` (`id`, `id_paciente`, `fecha`, `respuestas`) VALUES
(1, 1, '2025-05-16', '{\r\n  \"1\": 2, \"2\": 2, \"3\": 1, \"4\": 2, \"5\": 3, \"6\": 2, \"7\": 1, \"8\": 2, \"9\": 1, \"10\": 2\r\n}'),
(6, 6, '2025-06-08', '{\"1\":\"1\",\"2\":\"1\",\"3\":\"1\",\"4\":\"1\",\"5\":\"1\",\"6\":\"1\",\"7\":\"1\",\"8\":\"1\",\"9\":\"1\",\"10\":\"3\"}'),
(8, 12, '2025-06-09', '{\"1\":\"1\",\"2\":\"1\",\"3\":\"1\",\"4\":\"1\",\"5\":\"1\",\"6\":\"1\",\"7\":\"1\",\"8\":\"1\",\"9\":\"3\",\"10\":\"3\"}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `test_importancia`
--

CREATE TABLE `test_importancia` (
  `id` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `parte1` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`parte1`)),
  `parte2` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`parte2`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `test_importancia`
--

INSERT INTO `test_importancia` (`id`, `id_paciente`, `fecha`, `parte1`, `parte2`) VALUES
(1, 1, '2025-05-17', '{\r\n  \"1\": 5, \"2\": 4, \"3\": 6, \"4\": 5, \"5\": 4, \"6\": 5, \"7\": 6, \"8\": 4, \"9\": 5, \"10\": 4,\r\n  \"11\": 6, \"12\": 5, \"13\": 4, \"14\": 6, \"15\": 5, \"16\": 4, \"17\": 5\r\n}', '{\r\n  \"18\": 6, \"19\": 5, \"20\": 4, \"21\": 6, \"22\": 5, \"23\": 6, \"24\": 5, \"25\": 4, \"26\": 5,\r\n  \"27\": 6, \"28\": 5, \"29\": 4, \"30\": 6, \"31\": 5, \"32\": 6, \"33\": 5, \"34\": 4\r\n}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `test_poms`
--

CREATE TABLE `test_poms` (
  `id` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `deporte` varchar(100) DEFAULT NULL,
  `edad` int(11) DEFAULT NULL,
  `respuestas` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`respuestas`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `test_poms`
--

INSERT INTO `test_poms` (`id`, `id_paciente`, `fecha`, `deporte`, `edad`, `respuestas`) VALUES
(1, 1, '2025-05-15', 'Fútbol', 22, '{\r\n  \"1\": 2, \"2\": 1, \"3\": 0, \"4\": 3, \"5\": 1, \"6\": 2, \"7\": 3, \"8\": 1, \"9\": 0, \"10\": 0,\r\n  \"11\": 1, \"12\": 2, \"13\": 3, \"14\": 1, \"15\": 2, \"16\": 1, \"17\": 0, \"18\": 1, \"19\": 3, \"20\": 0,\r\n  \"21\": 1, \"22\": 2, \"23\": 1, \"24\": 0, \"25\": 1, \"26\": 2, \"27\": 1, \"28\": 2, \"29\": 3, \"30\": 2,\r\n  \"31\": 1, \"32\": 2, \"33\": 0, \"34\": 1, \"35\": 0, \"36\": 1, \"37\": 0, \"38\": 3, \"39\": 1, \"40\": 2,\r\n  \"41\": 1, \"42\": 2, \"43\": 3, \"44\": 1, \"45\": 0, \"46\": 1, \"47\": 0, \"48\": 1, \"49\": 2, \"50\": 1,\r\n  \"51\": 2, \"52\": 0, \"53\": 1, \"54\": 2, \"55\": 3, \"56\": 2, \"57\": 1, \"58\": 0, \"59\": 1, \"60\": 2,\r\n  \"61\": 0, \"62\": 1, \"63\": 2, \"64\": 1, \"65\": 0\r\n}'),
(3, 8, '2025-06-07', 'Feles', 23, '{\"1\":\"0\",\"2\":\"0\",\"3\":\"0\",\"4\":\"0\",\"5\":\"0\",\"6\":\"0\",\"7\":\"0\",\"8\":\"0\",\"9\":\"0\",\"10\":\"0\",\"11\":\"0\",\"12\":\"0\",\"13\":\"0\",\"14\":\"0\",\"15\":\"0\",\"16\":\"0\",\"17\":\"0\",\"18\":\"0\",\"19\":\"0\",\"20\":\"0\",\"21\":\"0\",\"22\":\"0\",\"23\":\"0\",\"24\":\"0\",\"25\":\"0\",\"26\":\"0\",\"27\":\"0\",\"28\":\"0\",\"29\":\"0\",\"30\":\"0\",\"31\":\"0\",\"32\":\"0\",\"33\":\"0\",\"34\":\"0\",\"35\":\"0\",\"36\":\"0\",\"37\":\"0\",\"38\":\"0\",\"39\":\"0\",\"40\":\"0\",\"41\":\"0\",\"42\":\"0\",\"43\":\"0\",\"44\":\"0\",\"45\":\"0\",\"46\":\"0\",\"47\":\"0\",\"48\":\"0\",\"49\":\"0\",\"50\":\"0\",\"51\":\"0\",\"52\":\"0\",\"53\":\"0\",\"54\":\"0\",\"55\":\"0\",\"56\":\"0\",\"57\":\"0\",\"58\":\"0\",\"59\":\"0\",\"60\":\"0\",\"61\":\"0\",\"62\":\"0\",\"63\":\"0\",\"64\":\"0\",\"65\":\"0\"}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tratamientos`
--

CREATE TABLE `tratamientos` (
  `id_tratamiento` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `fecha_creacion` date NOT NULL,
  `diagnostico_descripcion` varchar(100) NOT NULL,
  `tratamiento_tipo` varchar(100) NOT NULL,
  `estado_actual` varchar(20) NOT NULL,
  `observaciones` varchar(150) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tratamientos`
--

INSERT INTO `tratamientos` (`id_tratamiento`, `id_paciente`, `fecha_creacion`, `diagnostico_descripcion`, `tratamiento_tipo`, `estado_actual`, `observaciones`, `created_at`, `updated_at`) VALUES
(3, 4, '2025-06-20', 'ssssa', 'ssss', 'finalizado', 'sss', '2025-06-04 19:55:23', '2025-06-04 19:55:23'),
(10, 1, '2025-06-12', 'ds', 'hkjhk', 'inicial', 'PATOs', '2025-06-08 18:14:49', '2025-06-08 18:14:49'),
(12, 1, '2025-06-09', 'e', 'e', 'inicial', 'e', '2025-06-09 00:19:35', '2025-06-09 00:19:35'),
(35, 1, '2025-06-09', 'as', 's', 'inicial', 'as', '2025-06-09 03:37:37', '2025-06-09 03:37:37'),
(36, 12, '2025-06-09', 's', 's', 'inicial', 's', '2025-06-09 03:37:46', '2025-06-09 03:37:46');

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
(33, 12345678, 'Juan', 'Gomez', 'juangomez@gmail.com', '$2y$10$mW/AIWfDk.kDt5ahS5SOYu.wqLdOL/rFWSubkyyLTi67v/ZzNZgKi', '1111-11-11', 'm', 'p'),
(34, 3880792, 'maria', 'paulina', 'jura12@gmail.com', '$2y$10$oHuKuZ7hm.ntvqUgc1WOqen/RqXQh3p8cvkoAJZfECueS95KYFZnG', '2025-01-09', 'f', 'c'),
(35, 12249177, 'carlos', 'prince', 'juraaaa@gmail.com', '$2y$10$4KC2jguGslTJ2VzmUe37TuiE.LMVqjMJktWNIspApQJT3u99RHsdW', '2008-01-09', 'm', 'p'),
(36, 30894896, 'jesus', 'delgado', 'jur1a@gmail.com', '$2y$10$qsj6zjS3CzwKjcmqTrZnk.RjBjzrwBYXqC878gk9IEUfWFcjJ7iDy', '2025-04-10', 'm', 'p'),
(37, 13188691, 'Ellery', 'Lopez', 'ealopezu@gmail.com', '$2y$10$6Rzj3mmACnN8mE3TsHlkYOhXCojoLvGp4O1ztpPuaebKH1ohTbU/C', '2025-04-11', 'm', 'p'),
(38, 31574454, 'Yahir', 'Rivero', 'yahirmos@gmail.com', '$2y$10$jH715aEP/3Q5XlQD8lr6YenoMDLzGKjfzkLTOYq/DjoS.GMt6i33O', '2006-06-06', 'm', 'p'),
(39, 1029384756, 'rafa', 'sample', 'qweq@gmail.com', '$2y$10$ZgugyNCtvsyYulIk0M2gnOyYfXsuej.vcwWecxOt98yf6WgK//wLK', '6767-06-07', 'm', 'p');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cita`
--
ALTER TABLE `cita`
  ADD PRIMARY KEY (`id_cita`),
  ADD KEY `id_paciente` (`id_paciente`);

--
-- Indices de la tabla `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`id_paciente`);

--
-- Indices de la tabla `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `test_confianza`
--
ALTER TABLE `test_confianza`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_paciente` (`id_paciente`);

--
-- Indices de la tabla `test_importancia`
--
ALTER TABLE `test_importancia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_paciente` (`id_paciente`);

--
-- Indices de la tabla `test_poms`
--
ALTER TABLE `test_poms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_paciente` (`id_paciente`);

--
-- Indices de la tabla `tratamientos`
--
ALTER TABLE `tratamientos`
  ADD PRIMARY KEY (`id_tratamiento`),
  ADD KEY `fk_tratamiento_paciente` (`id_paciente`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cita`
--
ALTER TABLE `cita`
  MODIFY `id_cita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `history`
--
ALTER TABLE `history`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `paciente`
--
ALTER TABLE `paciente`
  MODIFY `id_paciente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `test_confianza`
--
ALTER TABLE `test_confianza`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `test_importancia`
--
ALTER TABLE `test_importancia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `test_poms`
--
ALTER TABLE `test_poms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tratamientos`
--
ALTER TABLE `tratamientos`
  MODIFY `id_tratamiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cita`
--
ALTER TABLE `cita`
  ADD CONSTRAINT `cita_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`id_paciente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `test_confianza`
--
ALTER TABLE `test_confianza`
  ADD CONSTRAINT `test_confianza_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`id_paciente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `test_importancia`
--
ALTER TABLE `test_importancia`
  ADD CONSTRAINT `test_importancia_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`id_paciente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `test_poms`
--
ALTER TABLE `test_poms`
  ADD CONSTRAINT `test_poms_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`id_paciente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tratamientos`
--
ALTER TABLE `tratamientos`
  ADD CONSTRAINT `fk_tratamiento_paciente` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`id_paciente`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
