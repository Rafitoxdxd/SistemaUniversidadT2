-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2025 at 02:17 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistema_psicologia`
--

-- --------------------------------------------------------

--
-- Table structure for table `cita`
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
-- Dumping data for table `cita`
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
-- Table structure for table `consulta`
--

CREATE TABLE `consulta` (
  `id_consulta` int(11) NOT NULL,
  `id_cita` int(11) NOT NULL,
  `id_tratamiento` int(11) DEFAULT NULL,
  `id_test_confianza` int(11) DEFAULT NULL,
  `id_test_importancia` int(11) DEFAULT NULL,
  `id_test_poms` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `ID` int(11) NOT NULL,
  `datos` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`datos`)),
  `idPaciente` int(11) DEFAULT NULL,
  `idPsicologo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`ID`, `datos`, `idPaciente`, `idPsicologo`) VALUES
(3, '{\"nombre\":\"Juanito\",\"apellidos\":\"Perez\",\"cedula\":\"123123123123\",\"Edad\":\"1\",\"fecha_nacimiento\":\"\",\"Localidad\":\"\",\"telefono\":\"\",\"email\":\"\",\"estado_civil\":\"\",\"profesion\":\"\",\"estudios\":\"\",\"otros__sintoma\":\"\",\"convivencia\":\"\",\"relacion_mejorar\":\"\",\"area_conflictiva\":\"\",\"frecuencia_alcohol\":\"\",\"frecuencia_fumar\":\"\",\"frecuencia_sustancia\":\"\",\"rutina_sueno\":\"\",\"tratamiento_recibido\":\"\",\"finalizado_tratamiento\":\"\",\"personas_significativas\":\"\",\"ayuda_terapia\":\"\",\"espera_terapia\":\"\",\"compromiso_terapia\":\"\",\"duracion_terapia\":\"\",\"importante_reflejar\":\"sdsd\"}', NULL, 33),
(10, '{\"nombre\":\"Yahir\",\"apellidos\":\"Rivero\",\"cedula\":\"31574454\",\"Edad\":\"18\",\"fecha_nacimiento\":\"2025-05-23\",\"Localidad\":\"barquisimeto\",\"telefono\":\"\",\"email\":\"\",\"estado_civil\":\"\",\"profesion\":\"\",\"estudios\":\"\",\"otros__sintoma\":\"\",\"convivencia\":\"\",\"relacion_mejorar\":\"\",\"area_conflictiva\":\"\",\"frecuencia_alcohol\":\"\",\"frecuencia_fumar\":\"\",\"frecuencia_sustancia\":\"\",\"rutina_sueno\":\"\",\"tratamiento_recibido\":\"\",\"finalizado_tratamiento\":\"\",\"personas_significativas\":\"\",\"ayuda_terapia\":\"\",\"espera_terapia\":\"\",\"compromiso_terapia\":\"\",\"duracion_terapia\":\"\",\"importante_reflejar\":\"\"}', NULL, 36);

-- --------------------------------------------------------

--
-- Table structure for table `paciente`
--

CREATE TABLE `paciente` (
  `id_paciente` int(11) NOT NULL,
  `nombre` varchar(15) NOT NULL,
  `apellido` varchar(15) NOT NULL,
  `cedula` varchar(15) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `genero` varchar(25) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(15) NOT NULL,
  `id_ubicacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paciente`
--

INSERT INTO `paciente` (`id_paciente`, `nombre`, `apellido`, `cedula`, `telefono`, `fecha_nacimiento`, `genero`, `email`, `password`, `id_ubicacion`) VALUES
(2, 'Shikamaru', 'Nara', '12177382', '04266525036', '2011-12-03', 'masculino', 'yahir@gmail.com', '', NULL),
(3, 'YAHIR', 'Rivero', '31574451', '2189219', '2025-05-23', 'masculino', '', '', NULL),
(4, 'Gaara', 'Uzumaki', '30880792', '03030303', '2011-12-01', 'masculino', '', '', NULL),
(5, 'lenny', 'Lopez', '31574454', '04145113673', '2025-05-12', 'masculino', 'mama@gmail.com', '$2y$10$ib1x.zRf', NULL),
(6, 'Maribel', 'Duran ', 'dfggggg', '04165678', '2025-04-29', 'femenino', '', '', NULL),
(7, 'Lenny', 'Rivero', '31574454', '04149510472', '1992-07-23', 'masculino', 'perrocall@gmail.com', '$2y$10$Bn67J3N5', NULL),
(8, 'Camila', 'Toro', '30827652', '04266525038', '2011-12-16', 'masculino', 'yahir@gmail.com', '$2y$10$lS7FpW7c', NULL),
(9, 'Tobirama', 'Uchiha', '12249177', '0414567897', '2011-12-08', 'masculino', '', '', NULL),
(10, 'Jezuha', 'Palmera', '32066861', '04146587451', '2011-12-01', 'femenino', 'jezuhaja@gmail.com', '$2y$10$/7KUrdkO', NULL),
(11, 'Subaru', 'Natski', '32065636', '04266525036', '2006-11-04', 'masculino', 'wizzard790@gmail.com', '$2y$10$u6oVEIAL', NULL),
(12, 'Satoru', 'Gojo', '20144541', '0414660543', '2011-12-02', 'masculino', 'yahirmosq0606@gmail.com', '$2y$10$z0D2M4Wx', NULL),
(13, 'Monica', 'Lopez', '12249177', '2189219', '2011-12-08', 'masculino', 'yahir@gmail.com', '$2y$10$BedScnoL', NULL),
(14, 'Lenny', 'Lopez', '12345678', '04266525038', '2011-12-01', 'masculino', 'mama@gmail.com', '$2y$10$/v2.EGHS', NULL),
(15, 'Lenny', 'Lopez', '12345678', '2189219', '2011-12-09', 'masculino', 'mama@gmail.com', '$2y$10$Hrle.RYp', NULL),
(16, 'Nada', 'Nadaaa', '12345678', '2189219', '2011-12-02', 'femenino', '', '', NULL),
(17, 'Maria', 'Brachoa', '3880792', '04145646723', '2011-12-08', 'femenino', '', '', NULL),
(18, 'Camila', 'Toro', '31567654', '04266525033', '2011-12-08', 'masculino', 'camilatoro@gmail.com', '$2y$10$DI6NnLiy', 4),
(19, 'Jenny', 'Mosquera', '12249177', '04145307016', '2011-12-02', 'femenino', 'jennymosq2211@gmail.com', '', 5);

-- --------------------------------------------------------

--
-- Table structure for table `test_confianza`
--

CREATE TABLE `test_confianza` (
  `id_test_confianza` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `respuestas` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`respuestas`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `test_confianza`
--

INSERT INTO `test_confianza` (`id_test_confianza`, `id_paciente`, `fecha`, `respuestas`) VALUES
(6, 6, '2025-06-08', '{\"1\":\"1\",\"2\":\"1\",\"3\":\"1\",\"4\":\"1\",\"5\":\"1\",\"6\":\"1\",\"7\":\"1\",\"8\":\"1\",\"9\":\"1\",\"10\":\"3\"}'),
(8, 13, '2025-06-09', '{\"1\":1,\"2\":1,\"3\":1,\"4\":1,\"5\":1,\"6\":1,\"7\":1,\"8\":1,\"9\":1,\"10\":1}');

-- --------------------------------------------------------

--
-- Table structure for table `test_importancia`
--

CREATE TABLE `test_importancia` (
  `id_test_importancia` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `parte1` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`parte1`)),
  `parte2` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`parte2`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `test_importancia`
--

INSERT INTO `test_importancia` (`id_test_importancia`, `id_paciente`, `fecha`, `parte1`, `parte2`) VALUES
(4, 11, '2025-06-09', '{\"1\":\"1\",\"2\":\"1\",\"3\":\"1\",\"4\":\"1\",\"5\":\"1\",\"6\":\"1\",\"7\":\"1\",\"8\":\"1\",\"9\":\"1\",\"10\":\"1\",\"11\":\"1\",\"12\":\"1\",\"13\":\"1\",\"14\":\"1\",\"15\":\"1\",\"16\":\"1\",\"17\":\"1\"}', '{\"18\":\"1\",\"19\":\"1\",\"20\":\"1\",\"21\":\"1\",\"22\":\"1\",\"23\":\"1\",\"24\":\"1\",\"25\":\"1\",\"26\":\"1\",\"27\":\"1\",\"28\":\"1\",\"29\":\"1\",\"30\":\"1\",\"31\":\"1\",\"32\":\"1\",\"33\":\"1\",\"34\":\"1\"}'),
(5, 3, '2025-06-09', '{\"1\":\"4\",\"2\":\"4\",\"3\":\"6\",\"4\":\"1\",\"5\":\"1\",\"6\":\"1\",\"7\":\"1\",\"8\":\"1\",\"9\":\"1\",\"10\":\"1\",\"11\":\"1\",\"12\":\"1\",\"13\":\"1\",\"14\":\"1\",\"15\":\"1\",\"16\":\"1\",\"17\":\"1\"}', '{\"18\":\"1\",\"19\":\"1\",\"20\":\"1\",\"21\":\"1\",\"22\":\"1\",\"23\":\"1\",\"24\":\"1\",\"25\":\"1\",\"26\":\"1\",\"27\":\"1\",\"28\":\"1\",\"29\":\"1\",\"30\":\"1\",\"31\":\"1\",\"32\":\"1\",\"33\":\"1\",\"34\":\"1\"}');

-- --------------------------------------------------------

--
-- Table structure for table `test_poms`
--

CREATE TABLE `test_poms` (
  `id_test_poms` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `deporte` varchar(100) DEFAULT NULL,
  `edad` int(11) DEFAULT NULL,
  `respuestas` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`respuestas`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `test_poms`
--

INSERT INTO `test_poms` (`id_test_poms`, `id_paciente`, `fecha`, `deporte`, `edad`, `respuestas`) VALUES
(3, 8, '2025-06-07', 'Feles', 23, '{\"1\":\"0\",\"2\":\"0\",\"3\":\"0\",\"4\":\"0\",\"5\":\"0\",\"6\":\"0\",\"7\":\"0\",\"8\":\"0\",\"9\":\"0\",\"10\":\"0\",\"11\":\"0\",\"12\":\"0\",\"13\":\"0\",\"14\":\"0\",\"15\":\"0\",\"16\":\"0\",\"17\":\"0\",\"18\":\"0\",\"19\":\"0\",\"20\":\"0\",\"21\":\"0\",\"22\":\"0\",\"23\":\"0\",\"24\":\"0\",\"25\":\"0\",\"26\":\"0\",\"27\":\"0\",\"28\":\"0\",\"29\":\"0\",\"30\":\"0\",\"31\":\"0\",\"32\":\"0\",\"33\":\"0\",\"34\":\"0\",\"35\":\"0\",\"36\":\"0\",\"37\":\"0\",\"38\":\"0\",\"39\":\"0\",\"40\":\"0\",\"41\":\"0\",\"42\":\"0\",\"43\":\"0\",\"44\":\"0\",\"45\":\"0\",\"46\":\"0\",\"47\":\"0\",\"48\":\"0\",\"49\":\"0\",\"50\":\"0\",\"51\":\"0\",\"52\":\"0\",\"53\":\"0\",\"54\":\"0\",\"55\":\"0\",\"56\":\"0\",\"57\":\"0\",\"58\":\"0\",\"59\":\"0\",\"60\":\"0\",\"61\":\"0\",\"62\":\"0\",\"63\":\"0\",\"64\":\"0\",\"65\":\"0\"}'),
(6, 12, '2025-06-09', 'NADA', 14, '{\"1\":\"0\",\"2\":\"0\",\"3\":\"0\",\"4\":\"0\",\"5\":\"0\",\"6\":\"0\",\"7\":\"0\",\"8\":\"0\",\"9\":\"0\",\"10\":\"0\",\"11\":\"0\",\"12\":\"0\",\"13\":\"0\",\"14\":\"0\",\"15\":\"0\",\"16\":\"0\",\"17\":\"0\",\"18\":\"0\",\"19\":\"0\",\"20\":\"0\",\"21\":\"0\",\"22\":\"0\",\"23\":\"0\",\"24\":\"0\",\"25\":\"0\",\"26\":\"0\",\"27\":\"0\",\"28\":\"0\",\"29\":\"0\",\"30\":\"0\",\"31\":\"0\",\"32\":\"0\",\"33\":\"0\",\"34\":\"0\",\"35\":\"0\",\"36\":\"0\",\"37\":\"0\",\"38\":\"0\",\"39\":\"0\",\"40\":\"0\",\"41\":\"0\",\"42\":\"0\",\"43\":\"0\",\"44\":\"0\",\"45\":\"0\",\"46\":\"0\",\"47\":\"0\",\"48\":\"0\",\"49\":\"0\",\"50\":\"0\",\"51\":\"0\",\"52\":\"0\",\"53\":\"0\",\"54\":\"0\",\"55\":\"0\",\"56\":\"0\",\"57\":\"0\",\"58\":\"0\",\"59\":\"0\",\"60\":\"0\",\"61\":\"0\",\"62\":\"0\",\"63\":\"0\",\"64\":\"0\",\"65\":\"0\"}'),
(7, 15, '2025-06-09', 'hola', 34, '{\"1\":\"0\",\"2\":\"0\",\"3\":\"0\",\"4\":\"0\",\"5\":\"0\",\"6\":\"0\",\"7\":\"0\",\"8\":\"0\",\"9\":\"0\",\"10\":\"0\",\"11\":\"0\",\"12\":\"0\",\"13\":\"0\",\"14\":\"0\",\"15\":\"0\",\"16\":\"0\",\"17\":\"0\",\"18\":\"0\",\"19\":\"0\",\"20\":\"0\",\"21\":\"0\",\"22\":\"0\",\"23\":\"0\",\"24\":\"0\",\"25\":\"0\",\"26\":\"0\",\"27\":\"0\",\"28\":\"0\",\"29\":\"0\",\"30\":\"0\",\"31\":\"0\",\"32\":\"0\",\"33\":\"0\",\"34\":\"0\",\"35\":\"0\",\"36\":\"0\",\"37\":\"0\",\"38\":\"0\",\"39\":\"0\",\"40\":\"0\",\"41\":\"0\",\"42\":\"0\",\"43\":\"0\",\"44\":\"0\",\"45\":\"0\",\"46\":\"0\",\"47\":\"0\",\"48\":\"0\",\"49\":\"0\",\"50\":\"0\",\"51\":\"0\",\"52\":\"0\",\"53\":\"0\",\"54\":\"0\",\"55\":\"0\",\"56\":\"0\",\"57\":\"0\",\"58\":\"0\",\"59\":\"0\",\"60\":\"0\",\"61\":\"0\",\"62\":\"0\",\"63\":\"0\",\"64\":\"0\",\"65\":\"0\"}');

-- --------------------------------------------------------

--
-- Table structure for table `tratamientos`
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
-- Dumping data for table `tratamientos`
--

INSERT INTO `tratamientos` (`id_tratamiento`, `id_paciente`, `fecha_creacion`, `diagnostico_descripcion`, `tratamiento_tipo`, `estado_actual`, `observaciones`, `created_at`, `updated_at`) VALUES
(1, 0, '2025-06-05', 'hola como estas ', 'malo', 'inicial', 'muy malas', '2025-06-19 18:56:38', '2025-06-19 18:56:38'),
(10, 1, '2025-06-12', 'lik', 'hkjhk', 'inicial', 'PATO', '2025-06-08 18:14:49', '2025-06-08 18:14:49'),
(29, 12, '2025-06-18', 'xddd', 'geometri', 'inicial', 'nkukkaoilqhs', '2025-06-09 11:11:46', '2025-06-09 11:11:46'),
(32, 5, '2025-06-12', 'cancer ', 'Vacunas', 'seguimiento', 'viva la vida', '2025-06-12 14:19:05', '2025-06-12 14:19:05'),
(34, 9, '2025-06-17', 'ygjbk', 'Vfhg', 'seguimiento', 'ningunax', '2025-06-12 16:03:34', '2025-06-12 16:03:34');

-- --------------------------------------------------------

--
-- Table structure for table `ubicacion`
--

CREATE TABLE `ubicacion` (
  `id_ubicacion` int(11) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `ciudad` varchar(100) NOT NULL,
  `pais` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ubicacion`
--

INSERT INTO `ubicacion` (`id_ubicacion`, `direccion`, `ciudad`, `pais`) VALUES
(1, 'Carrera  entre calles  y ', 'Barquisimeto', 'Venezuela'),
(2, 'Carrera  entre calles  y ', 'Barquisimeto', 'Venezuela'),
(3, 'Carrera  entre calles  y ', 'Barquisimeto', 'Venezuela'),
(4, 'Carrera  entre calles  y ', 'Barquisimeto', 'Venezuela'),
(5, 'Mi casa', 'Barquisimeto', 'Venezuela');

-- --------------------------------------------------------

--
-- Table structure for table `users`
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
-- Dumping data for table `users`
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
-- Indexes for dumped tables
--

--
-- Indexes for table `cita`
--
ALTER TABLE `cita`
  ADD PRIMARY KEY (`id_cita`),
  ADD KEY `id_paciente` (`id_paciente`);

--
-- Indexes for table `consulta`
--
ALTER TABLE `consulta`
  ADD PRIMARY KEY (`id_consulta`),
  ADD KEY `id_cita` (`id_cita`),
  ADD KEY `id_tratamiento` (`id_tratamiento`),
  ADD KEY `id_test_confianza` (`id_test_confianza`),
  ADD KEY `id_test_importancia` (`id_test_importancia`),
  ADD KEY `id_test_poms` (`id_test_poms`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`id_paciente`),
  ADD KEY `fk_ubicacion` (`id_ubicacion`);

--
-- Indexes for table `test_confianza`
--
ALTER TABLE `test_confianza`
  ADD PRIMARY KEY (`id_test_confianza`),
  ADD KEY `id_paciente` (`id_paciente`);

--
-- Indexes for table `test_importancia`
--
ALTER TABLE `test_importancia`
  ADD PRIMARY KEY (`id_test_importancia`),
  ADD KEY `id_paciente` (`id_paciente`);

--
-- Indexes for table `test_poms`
--
ALTER TABLE `test_poms`
  ADD PRIMARY KEY (`id_test_poms`),
  ADD KEY `id_paciente` (`id_paciente`);

--
-- Indexes for table `tratamientos`
--
ALTER TABLE `tratamientos`
  ADD PRIMARY KEY (`id_tratamiento`);

--
-- Indexes for table `ubicacion`
--
ALTER TABLE `ubicacion`
  ADD PRIMARY KEY (`id_ubicacion`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cita`
--
ALTER TABLE `cita`
  MODIFY `id_cita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `consulta`
--
ALTER TABLE `consulta`
  MODIFY `id_consulta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `paciente`
--
ALTER TABLE `paciente`
  MODIFY `id_paciente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `test_confianza`
--
ALTER TABLE `test_confianza`
  MODIFY `id_test_confianza` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `test_importancia`
--
ALTER TABLE `test_importancia`
  MODIFY `id_test_importancia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `test_poms`
--
ALTER TABLE `test_poms`
  MODIFY `id_test_poms` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tratamientos`
--
ALTER TABLE `tratamientos`
  MODIFY `id_tratamiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `ubicacion`
--
ALTER TABLE `ubicacion`
  MODIFY `id_ubicacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cita`
--
ALTER TABLE `cita`
  ADD CONSTRAINT `cita_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`id_paciente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `consulta`
--
ALTER TABLE `consulta`
  ADD CONSTRAINT `consulta_ibfk_1` FOREIGN KEY (`id_cita`) REFERENCES `cita` (`id_cita`),
  ADD CONSTRAINT `consulta_ibfk_2` FOREIGN KEY (`id_tratamiento`) REFERENCES `tratamientos` (`id_tratamiento`),
  ADD CONSTRAINT `consulta_ibfk_3` FOREIGN KEY (`id_test_confianza`) REFERENCES `test_confianza` (`id_test_confianza`),
  ADD CONSTRAINT `consulta_ibfk_4` FOREIGN KEY (`id_test_importancia`) REFERENCES `test_importancia` (`id_test_importancia`),
  ADD CONSTRAINT `consulta_ibfk_5` FOREIGN KEY (`id_test_poms`) REFERENCES `test_poms` (`id_test_poms`);

--
-- Constraints for table `paciente`
--
ALTER TABLE `paciente`
  ADD CONSTRAINT `fk_ubicacion` FOREIGN KEY (`id_ubicacion`) REFERENCES `ubicacion` (`id_ubicacion`);

--
-- Constraints for table `test_confianza`
--
ALTER TABLE `test_confianza`
  ADD CONSTRAINT `test_confianza_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`id_paciente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `test_importancia`
--
ALTER TABLE `test_importancia`
  ADD CONSTRAINT `test_importancia_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`id_paciente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `test_poms`
--
ALTER TABLE `test_poms`
  ADD CONSTRAINT `test_poms_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`id_paciente`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
