-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 20-07-2024 a las 05:25:15
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
-- Base de datos: `blaspascal`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE `administradores` (
  `idadm` int(11) NOT NULL,
  `nombres` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `dni` varchar(15) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `clave` varchar(60) NOT NULL,
  `rol` varchar(30) NOT NULL,
  `estado` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`idadm`, `nombres`, `apellidos`, `dni`, `telefono`, `clave`, `rol`, `estado`) VALUES
(1, 'Claret Ursula', 'Prince Medina', '01234567', '993253000', '$2y$10$mOrb9Wy9ZXO89uleiEhG3ulQJuN4G0s8xb5DqWcJtWwdXBSOvHg4G', 'Coordinador', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `idalum` int(11) NOT NULL,
  `nombres` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `dni` varchar(15) NOT NULL,
  `genero` varchar(5) NOT NULL,
  `fecnacimiento` varchar(20) NOT NULL,
  `direccion` varchar(150) NOT NULL,
  `clave` varchar(60) NOT NULL,
  `aula` int(11) NOT NULL,
  `telefonoapod` varchar(15) NOT NULL,
  `nombresapod` varchar(100) NOT NULL,
  `dniapod` varchar(15) NOT NULL,
  `telefonopa` varchar(15) NOT NULL,
  `nombrespa` varchar(100) NOT NULL,
  `dnipa` varchar(15) NOT NULL,
  `telefonoma` varchar(15) NOT NULL,
  `nombresma` varchar(100) NOT NULL,
  `dnima` varchar(15) NOT NULL,
  `estado` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`idalum`, `nombres`, `apellidos`, `dni`, `genero`, `fecnacimiento`, `direccion`, `clave`, `aula`, `telefonoapod`, `nombresapod`, `dniapod`, `telefonopa`, `nombrespa`, `dnipa`, `telefonoma`, `nombresma`, `dnima`, `estado`) VALUES
(1, 'Gary Gerardo', 'Aguilar Campos', '73829104', 'M', '2010-03-17', 'Serrán', '$2y$10$conrC5wAEUqSHMrrU.KYn.pxe0qGmmiIXVwxzS.ELcU4Vtz68mtem', 1, '', '', '', '', '', '', '', '', '', 'Activo'),
(2, 'Yamile', 'Alegrea Guirre', '13158402', 'F', '2011-11-13', 'San Juan', '$2y$10$PXfOhRdYnMtIo0dReFnNreA2j0p0Xu.aQUwOOFh4sg2Noob7Kor.S', 1, '', '', '', '', '', '', '', '', '', 'Activo'),
(3, 'Antoanella', 'Allende Vega', '58291740', 'F', '2011-11-13', '', '', 1, '', '', '', '', '', '', '', '', '', 'Activo'),
(4, 'Alejandro', 'Basaldua Cueva', '49172630', 'M', '2010-11-13', '', '', 1, '', '', '', '', '', '', '', '', '', 'Activo'),
(5, 'Dylan', 'Bazan Huerta', '01287465', 'M', '2010-11-13', '', '', 1, '', '', '', '', '', '', '', '', '', 'Activo'),
(6, 'Christopher', 'Becerra Piña', '78526349', 'M', '2011-11-13', '', '', 1, '', '', '', '', '', '', '', '', '', 'Activo'),
(7, 'Misael', 'Carrera Rivera', '68249153', 'M', '2011-11-13', '', '', 1, '', '', '', '', '', '', '', '', '', 'Activo'),
(8, 'Mikeila', 'Curotto Anampa', '93827104', 'F', '2010-11-13', '', '', 1, '', '', '', '', '', '', '', '', '', 'Activo'),
(9, 'Naidith', 'Gonzales Davalos', '84726195', 'F', '2011-11-13', '', '', 1, '', '', '', '', '', '', '', '', '', 'Activo'),
(10, 'Jordan', 'Graus Menacho', '23487519', 'M', '2011-11-13', '', '', 1, '', '', '', '', '', '', '', '', '', 'Activo'),
(11, 'Camila Joyci', 'Hernandez Samáme', '39528174', 'M', '2011-11-13', '', '', 1, '', '', '', '', '', '', '', '', '', 'Activo'),
(12, 'Flavio Alesandro', 'Loayza Atarama', '49572813', 'M', '2011-11-13', '', '', 1, '', '', '', '', '', '', '', '', '', 'Activo'),
(13, 'Thiago Andre', 'Muñoz Baños', '52749163', 'M', '2011-11-13', 'Serrán', '$2y$10$j9SraTG9fKqMHtLbm4a84.TgvgDSFQQuvrHbGD9.VO3aBiYYXgBf6', 1, '', '', '', '', '', '', '', '', '', 'Activo'),
(14, 'Sebastian', 'Ojeda Diestra', '61948257', 'M', '2011-11-13', '', '', 1, '', '', '', '', '', '', '', '', '', 'Activo'),
(15, 'Angelo', 'Rafael Zambrano', '73840192', 'M', '2011-11-13', '', '', 1, '', '', '', '', '', '', '', '', '', 'Activo'),
(16, 'Felix', 'Ramirez Mendoza', '84926351', 'M', '2011-11-13', '', '', 1, '', '', '', '', '', '', '', '', '', 'Activo'),
(17, 'Camila', 'Ramos Rafael', '95170234', 'F', '2011-11-13', '', '', 1, '', '', '', '', '', '', '', '', '', 'Activo'),
(18, 'Leonardo', 'Remigio Córdova', '06384912', 'M', '2011-11-13', '', '', 1, '', '', '', '', '', '', '', '', '', 'Activo'),
(19, 'Stefano Andree', 'Saenz Diaz', '18570349', 'M', '2011-11-13', '', '', 1, '', '', '', '', '', '', '', '', '', 'Activo'),
(20, 'Dylan Smith', 'Salvador Espinoza', '49158230', 'M', '2011-11-13', '', '', 1, '', '', '', '', '', '', '', '', '', 'Activo'),
(21, 'Ian Gael', 'Saucedo Escalante', '11028828', 'M', '2011-11-13', 'Serrán', '$2y$10$8Ny64Ji6/kdfOlyVwVfgruNDeV5m2tOmigcyoO1Te8JuHXxAMrakO', 1, '', '', '', '', '', '', '', '', '', 'Activo'),
(22, 'Bruno', 'Urrutio Layme', '29384710', 'M', '2011-11-13', 'San Juan', '$2y$10$u4uHrySUnVSCjWGBZRSd8.iga/Jqvi7AamRdUc7qyfgrwS4oH5gOS', 1, '', '', '', '', '', '', '', '', '', 'Activo'),
(23, 'Jonatan', 'Chaquila Correa', '58239164', 'M', '2010-11-13', '', '', 2, '', '', '', '', '', '', '', '', '', 'Activo'),
(24, 'Lorena', 'Carrión Santos', '02993482', 'F', '2010-11-13', '', '', 2, '', '', '', '', '', '', '', '', '', 'Activo'),
(25, 'Rubela', 'Carrión Manrique', '61749523', 'F', '2010-11-13', '', '', 2, '', '', '', '', '', '', '', '', '', 'Activo'),
(26, 'Luis Miguel', 'Chinchay Rodriguez', '73826491', 'M', '2010-11-13', '', '', 2, '', '', '', '', '', '', '', '', '', 'Activo'),
(27, 'Anayely', 'Correa Vasquez', '83924157', 'F', '2010-11-13', '', '', 2, '', '', '', '', '', '', '', '', '', 'Activo'),
(28, 'Kiara', 'Cruz Huancas', '17392458', 'F', '2010-11-13', '', '', 2, '', '', '', '', '', '', '', '', '', 'Activo'),
(29, 'Ángel', 'Dinaya Carrión', '70849023', 'M', '2010-11-13', '', '', 2, '', '', '', '', '', '', '', '', '', 'Activo'),
(30, 'Allinson', 'Flores Rueda', '03478519', 'F', '2010-11-13', '', '', 2, '', '', '', '', '', '', '', '', '', 'Activo'),
(31, 'Cinthia Analí', 'García Torres', '25749163', 'F', '2010-11-13', '', '', 2, '', '', '', '', '', '', '', '', '', 'Activo'),
(32, 'Daniela', 'Huancas Chinchay', '07221923', 'F', '2010-11-13', '', '', 2, '', '', '', '', '', '', '', '', '', 'Activo'),
(33, 'Diana', 'Huancas Miranda', '95170832', 'F', '2010-11-13', '', '', 2, '', '', '', '', '', '', '', '', '', 'Activo'),
(34, 'Héctor', 'Ibañez Flores', '69182034', 'M', '2010-11-13', '', '', 2, '', '', '', '', '', '', '', '', '', 'Activo'),
(35, 'Anguinette Lindsay', 'Infante Pizarro', '51192041', 'F', '2010-11-13', '', '', 2, '', '', '', '', '', '', '', '', '', 'Activo'),
(36, 'Emerson', 'Lopez Jimenez', '46829153', 'M', '2010-11-13', '', '', 2, '', '', '', '', '', '', '', '', '', 'Activo'),
(37, 'Antony', 'Manchay Perez', '57491123', 'M', '2010-11-13', '', '', 2, '', '', '', '', '', '', '', '', '', 'Activo'),
(38, 'Adriana', 'Mezones Ibañez', '05248137', 'F', '2010-11-13', '', '', 2, '', '', '', '', '', '', '', '', '', 'Activo'),
(39, 'José', 'Peña Chingua', '37592841', 'M', '2010-11-13', '', '', 2, '', '', '', '', '', '', '', '', '', 'Activo'),
(40, 'Alexandra', 'Salvador Tineo', '14837269', 'F', '2010-11-13', '', '', 2, '', '', '', '', '', '', '', '', '', 'Activo'),
(41, 'Carlos', 'Tavara Garces', '71068290', 'M', '2010-11-13', '', '', 2, '', '', '', '', '', '', '', '', '', 'Activo'),
(42, 'Antonio', 'Ticlihuanca Tineo', '17834175', 'M', '2010-11-13', '', '', 2, '', '', '', '', '', '', '', '', '', 'Activo'),
(43, 'Dorian', 'Tineo Balcazar', '16384710', 'F', '2010-11-13', '', '', 2, '', '', '', '', '', '', '', '', '', 'Activo'),
(44, 'Angelo', 'Ugarte Perez', '08793293', 'M', '2010-11-13', '', '', 2, '', '', '', '', '', '', '', '', '', 'Activo'),
(45, 'Yamiled', 'Vasquez Tineo', '36174829', 'F', '2010-11-13', '', '', 2, '', '', '', '', '', '', '', '', '', 'Activo'),
(46, 'Anayeli', 'Villegas Machero', '29481736', 'F', '2010-11-13', '', '', 2, '', '', '', '', '', '', '', '', '', 'Activo'),
(47, 'Dayana Yhisu', 'Davila Llatas', '72829882', 'F', '2009-02-12', '', '', 3, '', '', '', '', '', '', '', '', '', 'Activo'),
(48, 'Josúe', 'Goméz Fernandéz', '81722403', 'M', '2009-03-03', '', '', 3, '', '', '', '', '', '', '', '', '', 'Activo'),
(49, 'Sebastián', 'Zuloeta Arbieto', '99103557', 'M', '2009-03-12', '', '', 3, '', '', '', '', '', '', '', '', '', 'Activo'),
(50, 'Shantal', 'Barboza Sanchez', '62834715', 'F', '2009-03-16', '', '', 3, '', '', '', '', '', '', '', '', '', 'Activo'),
(51, 'Nicole', 'Tey Rojas', '19384657', 'F', '2009-05-04', '', '', 3, '', '', '', '', '', '', '', '', '', 'Activo'),
(52, 'Pholl', 'Suarez Velasco', '92034817', 'M', '2009-05-13', '', '', 3, '', '', '', '', '', '', '', '', '', 'Activo'),
(53, 'Raúl', 'Veliz Girio', '82439167', 'M', '2009-08-22', '', '', 3, '', '', '', '', '', '', '', '', '', 'Activo'),
(54, 'Junior', 'Loayza Clemente', '54918237', 'M', '2010-08-22', '', '', 3, '', '', '', '', '', '', '', '', '', 'Activo'),
(55, 'Jefeerson', 'Povis Amaru', '04839217', 'M', '2009-08-30', '', '', 3, '', '', '', '', '', '', '', '', '', 'Activo'),
(56, 'Joel Alexander', 'Espinoza Santos', '33938529', 'M', '2009-10-09', 'Palo Blanco Alto', '$2y$10$VYL7dBEkIbBShlTfIh2obeLzc1.KUVhfcCDX4Qgs./85IE91poHlC', 3, '', '', '', '902035399', 'Joel Espinoza Peña', '', '', '', '', 'Activo'),
(57, 'Mathias', 'Castro Arce', '84739251', 'M', '2009-10-12', '', '', 3, '', '', '', '', '', '', '', '', '', 'Activo'),
(58, 'Celeste', 'Gordon Moreno', '02190583', 'F', '2009-10-22', '', '', 3, '', '', '', '', '', '', '', '', '', 'Activo'),
(59, 'Jane Fernanda', 'Palacios Espinoza', '61860567', 'F', '2009-10-25', 'Palo Blanco Alto', '$2y$10$abPIfXAlO35Mfcj.gjep3uewOVC.yhtd4/HlXlXh2ItGh2Rw8XBq6', 3, '', '', '', '935450001', 'Rodolfo Palacios Rodriguez', '09342762', '932020113', 'Jané Apolonia Espinoza Peña', '08342272', 'Activo'),
(60, 'Luis Angel', 'Cataño Urcia', '04918375', 'M', '2009-11-19', 'San Juan', '$2y$10$1HdPYXFRcWljrs0aMhepXOJFTL361pKfgIiNRcsbyi7PAes2PDyIy', 3, '', '', '', '', '', '', '', '', '', 'Activo'),
(61, 'Xander', 'Huerta Maceda', '59281734', 'M', '2009-12-10', 'Serrán', '$2y$10$0bkJ9AVJA4qrYuqu7nOjhuWkaqS.YYEAOTmb0jizeK8bLDq/W5Wry', 3, '', '', '', '', '', '', '', '', '', 'Activo'),
(62, 'Oscar', 'Tejada Tinajeros', '06993202', 'M', '2009-12-23', 'San Juan', '$2y$10$8yyuzsbDFPHwvSzxEd3haO./vewmP794fCYWS0CLfKAEG741Ca0jy', 3, '', '', '', '', '', '', '', '', '', 'Activo'),
(63, 'Jenssy Antuanette', 'Allende Vega', '68423917', 'F', '2008-02-12', '', '', 4, '', '', '', '', '', '', '', '', '', 'Activo'),
(64, 'Bayron Alexander', 'Bermuez Cornejo', '93019281', 'M', '2008-05-20', '', '', 4, '', '', '', '', '', '', '', '', '', 'Activo'),
(65, 'Megumi', 'Carrasco Aguirre', '83920775', 'F', '2008-03-21', '', '', 4, '', '', '', '', '', '', '', '', '', 'Activo'),
(66, 'Santiago', 'Curotto Anampa', '42173901', 'M', '2008-04-18', '', '', 4, '', '', '', '', '', '', '', '', '', 'Activo'),
(67, 'Ángel Daniel', 'Elera Larrea', '92745318', 'M', '2008-10-19', '', '', 4, '', '', '', '', '', '', '', '', '', 'Activo'),
(68, 'Valeria Adriana', 'Guerrero Chavez', '91889102', 'F', '2008-10-15', '', '', 4, '', '', '', '', '', '', '', '', '', 'Activo'),
(69, 'Allison', 'Mego Morales', '31964457', 'F', '2008-07-23', '', '', 4, '', '', '', '', '', '', '', '', '', 'Activo'),
(70, 'Piero', 'Severino Mascucan', '39481620', 'M', '2008-12-09', '', '', 4, '', '', '', '', '', '', '', '', '', 'Activo'),
(71, 'Danilo', 'Ugaz Morante', '04418325', 'M', '2008-10-12', '', '', 4, '', '', '', '', '', '', '', '', '', 'Activo'),
(72, 'Miguel Ángel Moroni', 'Urrutia Huamán', '99201663', 'M', '2008-01-21', '', '', 4, '', '', '', '', '', '', '', '', '', 'Activo'),
(73, 'Danna', 'Velasquez Fernandez', '18293741', 'F', '2008-06-18', '', '', 4, '', '', '', '', '', '', '', '', '', 'Activo'),
(74, 'Josue Alexander', 'Velita Bueno', '20738451', 'M', '2008-01-20', '', '', 4, '', '', '', '', '', '', '', '', '', 'Activo'),
(75, 'Dayana Esther', 'Aguirre Peña', '57281934', 'F', '2006-03-14', '', '', 5, '', '', '', '', '', '', '', '', '', 'Activo'),
(76, 'Jashimy Nahomi', 'Ballesteros Guerrero', '88320449', 'F', '2007-07-23', '', '', 5, '', '', '', '', '', '', '', '', '', 'Activo'),
(77, 'Melani Nahomi', 'Ballesteros Guerrero', '77169322', 'F', '2006-08-10', '', '', 5, '', '', '', '', '', '', '', '', '', 'Activo'),
(78, 'Brian Xavier', 'Carrasco Zapata', '03189192', 'M', '2007-01-18', '', '', 5, '', '', '', '', '', '', '', '', '', 'Activo'),
(79, 'Treysi Dayana', 'Carrion Manrrique', '01531179', 'F', '2006-12-30', 'La Tranca', '', 5, '', '', '', '', '', '', '', '', '', 'Activo'),
(80, 'Segundo Rosendo', 'Chumacero Rodriguez', '82173954', 'M', '2007-09-05', '', '', 5, '', '', '', '', '', '', '', '', '', 'Activo'),
(81, 'Keller Adrian', 'Chumacero Sanchez', '02139485', 'M', '2006-04-21', '', '', 5, '', '', '', '', '', '', '', '', '', 'Activo'),
(82, 'Ronald Adrian', 'Cornejo Aguirre', '10394821', 'M', '2007-10-16', 'Serrán', '$2y$10$BeP3NQ5TtmUWc/pmacnpweaDTtzuYt7EhptGfLZsevy7SRnCU4lCy', 5, '', '', '', '', '', '', '', '', '', 'Activo'),
(83, 'Yadira Alondra', 'Cuzcue Agurto', '83948275', 'F', '2006-06-09', '', '', 5, '', '', '', '', '', '', '', '', '', 'Activo'),
(84, 'Shamanta Beatriz', 'Deza Garces', '29347185', 'F', '2007-05-27', '', '', 5, '', '', '', '', '', '', '', '', '', 'Activo'),
(85, 'Jorge Samuel', 'Gomez Farfan', '03291192', 'M', '2006-11-12', 'La Tranca', '', 5, '', '', '', '', '', '', '', '', '', 'Activo'),
(86, 'Maurita Misshell', 'Huancas Tineo', '21473985', 'F', '2007-07-01', '', '', 5, '', '', '', '', '', '', '', '', '', 'Activo'),
(87, 'Jimmy Harlyn', 'Jimenez Alvarez', '10394752', 'M', '2006-02-20', 'La Tranca', '', 5, '', '', '', '', '', '', '', '', '', 'Activo'),
(88, 'Cinthia Andy', 'Leon Huancas', '73918425', 'F', '2007-08-30', 'Serrán', '', 5, '', '', '', '', '', '', '', '', '', 'Activo'),
(89, 'Nayely Ysabel', 'Marchena Gutierrez', '31482795', 'F', '2006-05-15', 'Serrán', '', 5, '', '', '', '', '', '', '', '', '', 'Activo'),
(90, 'Josue Emanuel', 'Marchena Lazoriga', '71829345', 'M', '2007-11-03', 'Serrán', '', 5, '', '', '', '', '', '', '', '', '', 'Activo'),
(91, 'Kevin Aaron', 'Monje Ruiz', '69182734', 'M', '2006-03-25', 'La Tranca', '', 5, '', '', '', '', '', '', '', '', '', 'Activo'),
(92, 'Bayronn Saul', 'More Ocaña', '97829109', 'M', '2007-09-19', 'Serrán', '', 5, '', '', '', '', '', '', '', '', '', 'Activo'),
(93, 'Juanita Emilia', 'Ocaña Verde', '10915225', 'F', '2006-12-08', 'Serrán', '', 5, '', '', '', '', '', '', '', '', '', 'Activo'),
(94, 'Florcita Marianet', 'Odar Flores', '58713942', 'F', '2007-04-11', 'Serrán', '', 5, '', '', '', '', '', '', '', '', '', 'Activo'),
(95, 'Jorge Henyely', 'Pacherrez Carrasco', '04437885', 'M', '2006-10-22', 'San Juan', '', 5, '', '', '', '', '', '', '', '', '', 'Activo'),
(96, 'Jimena Katherine', 'Vinces Quiñones', '83809216', 'F', '2007-06-17', 'San Juan', '', 5, '', '', '', '', '', '', '', '', '', 'Activo'),
(97, 'Naghelly Margot', 'Reyes Flores', '92837415', 'F', '2006-09-28', 'Serrán', '', 5, '', '', '', '', '', '', '', '', '', 'Activo'),
(98, 'Luis Fernando', 'Reyes Marchena', '40028817', 'M', '2007-07-14', 'Serrán', '$2y$10$8w6NflX2M0Jw/tJ/UntGhOwLOrqrS4egVVYIdjiHU7xAx7GjftN1G', 5, '', '', '', '', '', '', '', '', '', 'Activo'),
(99, 'Carlos Wilfredo', 'Salcedo Tineo', '77329817', 'M', '2006-02-05', 'La Tranca', '', 5, '', '', '', '', '', '', '', '', '', 'Activo'),
(100, 'Jose Reinaldo', 'Santos Huancas', '03234213', 'M', '2007-03-22', 'Palo Blanco Alto', '$2y$10$QXbZhYId3jbfebXw/xdToO4SbFS06ViSDyCeUXV.GGF/Ho4Ab6Shy', 5, '', '', '', '', '', '', '', '', '', 'Activo'),
(101, 'Fabrizio Aldair', 'Tineo Huancas', '23145532', 'M', '2006-08-13', 'Palo Blanco Alto', '$2y$10$Pd6R7G/ooFys.J7Y/kXIKu3Fb/dyWXxn82f3z3WfwzFksdQouC/Ni', 5, '', '', '', '', '', '', '', '', '', 'Activo'),
(102, 'Staysy Yamileth', 'Tineo Silva', '82321373', 'F', '2007-11-29', 'Palo Blanco Alto', '', 5, '', '', '', '', '', '', '', '', '', 'Activo'),
(103, 'Eleyda Julissa', 'Tineo Tineo', '45902092', 'F', '2006-01-24', 'Serrán', '', 5, '', '', '', '', '', '', '', '', '', 'Activo'),
(104, 'Edinson Enrique', 'Tineo Viera', '02342331', 'M', '2007-12-21', 'Serrán', '$2y$10$CQC6vnXlG0GV8RFBJa2tSuMsMXslK0PR4ubYt/fPZc3ILHfmeXbTu', 5, '', '', '', '', '', '', '', '', '', 'Activo'),
(105, 'Olenka Nicoll', 'Ubillus Yovera', '89045332', 'F', '2006-05-30', 'Serrán', '$2y$10$0Hu97jPC7XohId.byftoz.//nqJ/pTXOqljkKzliqSQ0btKPQ0XkO', 5, '', '', '', '', '', '', '', '', '', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anuncios`
--

CREATE TABLE `anuncios` (
  `idanun` int(11) NOT NULL,
  `docente` int(11) NOT NULL,
  `asignaturaaula` int(11) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `fecpublicacion` varchar(35) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `descripcion` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `anuncios`
--

INSERT INTO `anuncios` (`idanun`, `docente`, `asignaturaaula`, `titulo`, `fecpublicacion`, `imagen`, `descripcion`) VALUES
(1, 1, 41, 'IMPORTANTE', '2024-07-10T12:57', 'important.png', '<h5 style=\"font-style:italic;\"><em><strong>&iexcl;No olvidar traer su tarea realizada para ma&ntilde;ana!</strong></em></h5>\r\n'),
(2, 2, 16, 'Exposición Importante', '2024-07-10T13:06', '', '<p>Buenos d&iacute;as</p>\r\n\r\n<p>No olvidar que ma&ntilde;ana tienen exposici&oacute;n, <strong>traigan sus materiales y lleguen puntuales.</strong></p>\r\n'),
(3, 3, 11, 'IMPORTANTE', '2024-07-18T10:05', '', '<h2 style=\"font-style:italic;\"><strong>Ma&ntilde;ana traer su biblia</strong>, habr&aacute; un trabajo grupal</h2>\r\n');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area_curricular`
--

CREATE TABLE `area_curricular` (
  `idarea` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `descripcion` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `area_curricular`
--

INSERT INTO `area_curricular` (`idarea`, `nombre`, `descripcion`) VALUES
(1, 'Matemática', 'Razonamiento y demostración, interpretación de gráficos y exp. simbólica, resolución de problemas.'),
(2, 'Comunicación', 'Expresión y comprensión oral, comprensión lectora y producción de textos.'),
(3, 'Idioma Extranjero', 'Comprensión y producción de textos.'),
(4, 'Ciencias Sociales', 'Comprensión de información, indagación y experimentos, juicio crítico. '),
(5, 'D.P.C.C.', 'Autonomía, relaciones interpersonales, derechos humanos y civismo.'),
(6, 'Ciencia y Tecnología', 'Comprensión de información, indagación y experimentos, juicio crítico.'),
(7, 'Computación', 'Aplicación de la tecnología (TICS).'),
(8, 'Ed. Religiosa', 'Comprensión doctrinal cristiana, discernimiento de la fe.'),
(9, 'Ed. Física', 'Exp. orgánico - motriz, exp. corporal y perc. motriz.'),
(10, 'Tutoría', 'Tutoría');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignar_docente_asignatura`
--

CREATE TABLE `asignar_docente_asignatura` (
  `idreldoc` int(11) NOT NULL,
  `docente` int(11) NOT NULL,
  `asignatura` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `asignar_docente_asignatura`
--

INSERT INTO `asignar_docente_asignatura` (`idreldoc`, `docente`, `asignatura`) VALUES
(41, 1, 1),
(46, 1, 2),
(42, 1, 21),
(47, 1, 22),
(43, 1, 41),
(48, 1, 42),
(44, 1, 61),
(49, 1, 62),
(45, 1, 81),
(50, 1, 82),
(16, 2, 6),
(21, 2, 7),
(26, 2, 8),
(17, 2, 26),
(22, 2, 27),
(27, 2, 28),
(18, 2, 46),
(23, 2, 47),
(28, 2, 48),
(19, 2, 66),
(24, 2, 67),
(29, 2, 68),
(20, 2, 86),
(25, 2, 87),
(30, 2, 88),
(11, 3, 19),
(12, 3, 39),
(13, 3, 59),
(14, 3, 79),
(15, 3, 99),
(51, 4, 3),
(56, 4, 4),
(52, 4, 23),
(57, 4, 24),
(53, 4, 43),
(58, 4, 44),
(54, 4, 63),
(59, 4, 64),
(55, 4, 83),
(60, 4, 84),
(31, 5, 18),
(32, 5, 38),
(33, 5, 58),
(34, 5, 78),
(35, 5, 98),
(9, 6, 9),
(10, 6, 29),
(6, 7, 49),
(7, 7, 69),
(8, 7, 89),
(1, 8, 5),
(2, 8, 25),
(3, 8, 45),
(4, 8, 65),
(5, 8, 85),
(36, 9, 17),
(37, 9, 37),
(38, 9, 57),
(61, 9, 77),
(40, 9, 97),
(62, 10, 13),
(67, 10, 14),
(72, 10, 15),
(63, 10, 33),
(68, 10, 34),
(73, 10, 35),
(64, 10, 53),
(69, 10, 54),
(74, 10, 55),
(65, 10, 73),
(70, 10, 74),
(75, 10, 75),
(66, 10, 93),
(71, 10, 94),
(76, 10, 95),
(77, 11, 10),
(81, 11, 11),
(78, 11, 30),
(82, 11, 31),
(79, 11, 50),
(83, 11, 51),
(80, 11, 70),
(84, 11, 71),
(85, 11, 90),
(88, 12, 12),
(92, 12, 16),
(89, 12, 32),
(93, 12, 36),
(90, 12, 52),
(94, 12, 56),
(91, 12, 72),
(95, 12, 76),
(86, 12, 91),
(87, 12, 92),
(96, 12, 96);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignar_grado_asignatura`
--

CREATE TABLE `asignar_grado_asignatura` (
  `idrelgrado` int(11) NOT NULL,
  `aula` int(11) NOT NULL,
  `asignatura` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `asignar_grado_asignatura`
--

INSERT INTO `asignar_grado_asignatura` (`idrelgrado`, `aula`, `asignatura`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 1, 8),
(9, 1, 10),
(10, 1, 11),
(11, 1, 12),
(12, 1, 16),
(13, 1, 17),
(14, 1, 18),
(15, 1, 19),
(16, 1, 20),
(17, 1, 21),
(18, 1, 22),
(19, 1, 23),
(21, 2, 1),
(22, 2, 2),
(23, 2, 3),
(24, 2, 4),
(25, 2, 5),
(26, 2, 6),
(27, 2, 7),
(28, 2, 8),
(29, 2, 10),
(30, 2, 11),
(31, 2, 12),
(32, 2, 16),
(33, 2, 17),
(34, 2, 18),
(35, 2, 19),
(36, 2, 20),
(37, 2, 21),
(38, 2, 22),
(39, 2, 23),
(41, 3, 1),
(42, 3, 2),
(43, 3, 3),
(44, 3, 4),
(45, 3, 5),
(46, 3, 6),
(47, 3, 7),
(48, 3, 8),
(49, 3, 10),
(50, 3, 11),
(51, 3, 12),
(52, 3, 16),
(53, 3, 17),
(54, 3, 18),
(55, 3, 19),
(56, 3, 20),
(57, 3, 21),
(58, 3, 22),
(59, 3, 23),
(61, 4, 1),
(62, 4, 2),
(63, 4, 3),
(64, 4, 4),
(65, 4, 5),
(66, 4, 6),
(67, 4, 7),
(68, 4, 8),
(69, 4, 10),
(70, 4, 11),
(71, 4, 12),
(72, 4, 16),
(73, 4, 17),
(74, 4, 18),
(75, 4, 19),
(76, 4, 20),
(77, 4, 21),
(78, 4, 22),
(79, 4, 23),
(81, 5, 1),
(82, 5, 2),
(83, 5, 3),
(84, 5, 4),
(85, 5, 5),
(86, 5, 6),
(87, 5, 7),
(88, 5, 8),
(89, 5, 10),
(90, 5, 13),
(91, 5, 14),
(92, 5, 15),
(93, 5, 17),
(94, 5, 18),
(95, 5, 19),
(96, 5, 20),
(97, 5, 21),
(98, 5, 22),
(99, 5, 23);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignaturas`
--

CREATE TABLE `asignaturas` (
  `idasig` int(11) NOT NULL,
  `areacurricular` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `estado` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `asignaturas`
--

INSERT INTO `asignaturas` (`idasig`, `areacurricular`, `nombre`, `estado`) VALUES
(1, 1, 'Aritmética', 'Activo'),
(2, 1, 'Álgebra', 'Activo'),
(3, 1, 'Geometría', 'Activo'),
(4, 1, 'Trigonometría', 'Activo'),
(5, 1, 'Raz. Matemático', 'Activo'),
(6, 2, 'Lenguaje', 'Activo'),
(7, 2, 'Literatura', 'Activo'),
(8, 2, 'Raz. Verbal', 'Activo'),
(9, 2, 'Ortografía', 'Activo'),
(10, 3, 'Inglés', 'Activo'),
(11, 4, 'Historia', 'Activo'),
(12, 4, 'Geografía', 'Activo'),
(13, 4, 'Economía', 'Activo'),
(14, 5, 'Filosofía', 'Activo'),
(15, 5, 'Psicología', 'Activo'),
(16, 5, 'D.P.C.C.', 'Activo'),
(17, 6, 'Biología', 'Activo'),
(18, 6, 'Química', 'Activo'),
(19, 6, 'Física', 'Activo'),
(20, 6, 'Inv. Científica', 'Activo'),
(21, 7, 'Computación', 'Activo'),
(22, 9, 'Ed. Física', 'Activo'),
(23, 8, 'Religión', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aulas`
--

CREATE TABLE `aulas` (
  `idaula` int(11) NOT NULL,
  `grado` int(11) NOT NULL,
  `seccion` varchar(10) NOT NULL,
  `aforo` int(11) NOT NULL,
  `yearacad` int(11) NOT NULL,
  `tutor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `aulas`
--

INSERT INTO `aulas` (`idaula`, `grado`, `seccion`, `aforo`, `yearacad`, `tutor`) VALUES
(1, 11, 'A', 22, 2024, 3),
(2, 12, 'A', 30, 2024, 6),
(3, 13, 'A', 20, 2024, 7),
(4, 14, 'A', 20, 2024, 1),
(5, 15, 'A', 30, 2024, 2),
(6, 5, 'A', 30, 2024, 1),
(7, 6, 'A', 20, 2024, 1),
(8, 7, 'A', 20, 2024, 1),
(9, 8, 'A', 15, 2024, 1),
(10, 9, 'A', 22, 2024, 1),
(11, 10, 'A', 30, 2024, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bimestres`
--

CREATE TABLE `bimestres` (
  `idbime` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `abrev` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `bimestres`
--

INSERT INTO `bimestres` (`idbime`, `nombre`, `abrev`) VALUES
(1, 'I Bimestre', 'I'),
(2, 'II Bimestre', 'II'),
(3, 'III Bimestre', 'III'),
(4, 'IV Bimestre', 'IV');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `boletanotas`
--

CREATE TABLE `boletanotas` (
  `idbol` int(11) NOT NULL,
  `bimestre` int(11) NOT NULL,
  `alumno` int(11) NOT NULL,
  `promedioarea` decimal(5,2) NOT NULL,
  `comportamiento` decimal(5,2) NOT NULL,
  `promediogeneral` decimal(5,2) NOT NULL,
  `promedioalfabetico` varchar(10) NOT NULL DEFAULT 'A',
  `apreciacion` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `boletanotas`
--

INSERT INTO `boletanotas` (`idbol`, `bimestre`, `alumno`, `promedioarea`, `comportamiento`, `promediogeneral`, `promedioalfabetico`, `apreciacion`) VALUES
(1, 1, 2, 15.73, 19.00, 16.06, 'A', 'Puedes mejorar tus calificaciones, sigue esforzándote.'),
(2, 2, 2, 12.06, 11.06, 12.54, 'A', 'Todo bien'),
(3, 3, 2, 2.00, 12.00, 20.00, 'A', 'sw'),
(4, 1, 1, 20.00, 11.00, 15.00, 'A', 'hola'),
(5, 1, 3, 17.50, 10.50, 15.30, 'A', 'apreciación 3'),
(6, 1, 4, 18.20, 12.00, 16.50, 'A', 'apreciación 4'),
(7, 1, 5, 15.60, 11.25, 17.10, 'A', 'apreciación 5'),
(8, 1, 6, 19.70, 13.50, 14.20, 'A', 'apreciación 6'),
(9, 1, 7, 14.80, 10.75, 15.80, 'A', 'apreciación 7'),
(10, 1, 8, 16.90, 12.50, 18.00, 'A', 'apreciación 8'),
(11, 1, 9, 19.40, 14.00, 19.25, 'A', 'apreciación 9'),
(12, 1, 10, 13.50, 13.00, 14.75, 'A', 'apreciación 10'),
(13, 1, 11, 17.30, 11.75, 13.25, 'A', 'apreciación 11'),
(14, 1, 12, 16.60, 12.25, 14.50, 'A', 'apreciación 12'),
(15, 1, 13, 18.10, 10.90, 15.60, 'A', 'apreciación 13'),
(16, 1, 14, 15.40, 13.10, 14.10, 'A', 'apreciación 14'),
(17, 1, 15, 19.60, 12.90, 15.90, 'A', 'apreciación 15'),
(18, 1, 16, 14.90, 11.60, 17.50, 'A', 'apreciación 16'),
(19, 1, 17, 16.70, 13.70, 14.00, 'A', 'apreciación 17'),
(20, 1, 18, 18.50, 10.30, 15.20, 'A', 'apreciación 18'),
(21, 1, 19, 15.80, 12.40, 17.30, 'A', 'apreciación 19'),
(22, 1, 20, 19.90, 13.50, 19.00, 'A', 'apreciación 20'),
(23, 1, 21, 16.10, 11.00, 16.80, 'A', 'apreciación 21'),
(24, 1, 22, 18.80, 12.30, 18.50, 'A', 'apreciación 22'),
(35, 2, 1, 11.00, 12.00, 20.00, 'A', 'DESEFRGT'),
(39, 2, 6, 11.00, 14.00, 20.00, 'A', 'E3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita`
--

CREATE TABLE `cita` (
  `idcita` int(11) NOT NULL,
  `alumno` int(11) NOT NULL,
  `docente` int(11) NOT NULL,
  `reunion` varchar(50) NOT NULL,
  `fecha` date NOT NULL,
  `horai` time NOT NULL,
  `horaf` time NOT NULL,
  `nomfamiliar` varchar(70) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `link` varchar(200) NOT NULL DEFAULT 'https://utpvirtual.zoom.us/j/84755291743',
  `estado` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cita`
--

INSERT INTO `cita` (`idcita`, `alumno`, `docente`, `reunion`, `fecha`, `horai`, `horaf`, `nomfamiliar`, `descripcion`, `link`, `estado`) VALUES
(2, 2, 8, 'Presencial', '2024-07-15', '16:00:00', '17:00:00', 'Maria', 'Sobre rendimiento académico del alumno', 'https://utpvirtual.zoom.us/j/84755291743', 'Reservado'),
(3, 22, 3, 'Virtual', '2024-07-29', '18:00:00', '18:40:00', 'Maria Elena', 'Soy la mamá de Bruno quisiera saber sobre su rendimiento académico de este bimestre', 'https://utpvirtual.zoom.us/j/84755291743', 'Reservado'),
(4, 21, 3, 'Virtual', '2024-07-30', '16:00:00', '16:30:00', 'Juliana', 'Tengo una consulta sobre las olimpiadas de este año', 'https://utpvirtual.zoom.us/j/84755291743', 'Reservado'),
(5, 21, 3, 'Virtual', '2024-07-30', '17:30:00', '17:50:00', 'Yamile ', 'Sobre mi hijo', 'https://utpvirtual.zoom.us/j/84755291743', 'Reservado'),
(6, 2, 3, 'Virtual', '2024-08-05', '14:30:00', '16:00:00', 'Marcos', 'R. A. ', 'https://utpvirtual.zoom.us/j/84755291743', 'Reservado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comportamiento`
--

CREATE TABLE `comportamiento` (
  `idcomp` int(11) NOT NULL,
  `alumno` int(11) NOT NULL,
  `bimestre` int(11) NOT NULL,
  `inasistenciajust` int(11) NOT NULL,
  `inasistenciainjust` int(11) NOT NULL,
  `tardanzajust` int(11) NOT NULL,
  `tardanzainjust` int(11) NOT NULL,
  `puntualidad` int(11) NOT NULL,
  `respeto` int(11) NOT NULL,
  `responsabilidad` int(11) NOT NULL,
  `aseo` int(11) NOT NULL,
  `yearacad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comportamiento`
--

INSERT INTO `comportamiento` (`idcomp`, `alumno`, `bimestre`, `inasistenciajust`, `inasistenciainjust`, `tardanzajust`, `tardanzainjust`, `puntualidad`, `respeto`, `responsabilidad`, `aseo`, `yearacad`) VALUES
(1, 2, 1, 0, 0, 0, 0, 20, 19, 19, 18, 2024),
(2, 1, 1, 0, 0, 0, 1, 18, 18, 19, 17, 2024),
(3, 3, 1, 0, 0, 0, 0, 20, 17, 17, 18, 2024),
(4, 4, 1, 0, 0, 0, 1, 19, 18, 18, 17, 2024),
(5, 5, 1, 0, 0, 0, 0, 20, 18, 17, 16, 2024);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docentes`
--

CREATE TABLE `docentes` (
  `iddoc` int(11) NOT NULL,
  `nombres` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `dni` int(15) NOT NULL,
  `fecnacimiento` varchar(20) NOT NULL,
  `direccion` varchar(150) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `clave` varchar(60) NOT NULL,
  `estado` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `docentes`
--

INSERT INTO `docentes` (`iddoc`, `nombres`, `apellidos`, `dni`, `fecnacimiento`, `direccion`, `telefono`, `clave`, `estado`) VALUES
(1, 'Maricielo', 'Muñoz Flores', 72730993, '1990-07-26', 'Sol de Oro 309 - Los Olivos', '902395221', '$2y$10$jh7x9F7aVS41y4e6MkZOLuxyHp1yhvoKJkG529SDUu.oz2JgRLZI.', 'Activo'),
(2, 'Sandra', 'Vásquez', 98765437, '1991-12-07', 'Villa Hermosa', '928503700', '$2y$10$FYf2APK0OyKjXsZsKIUbD.uZEZ2HCn7UqgNj.QcZnC0SpeWUapM4O', 'Activo'),
(3, 'Nila', 'Tomasto', 23394052, '1966-11-04', 'Lima Sur', '923001542', '$2y$10$pilghpeU47Qq2Uc.p4Ew/OC6AIhOebFAj7DFIxLiJFVoFUGyGrS4a', 'Activo'),
(4, 'Julio Alejandro', 'Salazar Durand', 29309934, '1980-03-14', 'Lima Sur', '920392882', '$2y$10$se2sY5PUv5X/ZHonNcqy7uysfM60utRAOv/jbAb3O/fHk.qEp6gdu', 'Activo'),
(5, 'Gabriel', 'Tenorio Lopez', 29321192, '1989-03-09', 'Lima Sur', '929009194', '$2y$10$LMYVzAZjAsGE27d6RtJv0u/mp/dZcCvxU0Q.oIBnxWy4rp/iL61ZK', 'Activo'),
(6, 'Maura', 'Fernández', 32413327, '1967-12-10', 'Independencia', '921882310', '$2y$10$FteohopMZF/h9dC7/FQY5ubnkoouZuwoVPVxmhsT6oPZ.gK8jpFGS', 'Activo'),
(7, 'Yanina', ' Yanina Yanina', 39218821, '1987-07-04', 'Serrán', '932019110', '$2y$10$B//.RE65fvlLuK5AGgV72.R.bKKWbqRXPf4yh0qSp5La/Ry.BTyCC', 'Activo'),
(8, 'Renzo', 'Chananáme', 56693811, '1967-08-18', 'Salitral', '907498222', '$2y$10$wvm8EZtxlJJmGD70VWmIRu7eDQ9GLvd32O/cx8.9RyVonJZZdUnT6', 'Activo'),
(9, 'Viviana', 'Martínez', 39219082, '1992-09-02', 'Serrán', '900484282', '$2y$10$SN9UdG5wwLLm73fFV1CaVuMV461AE18/w9XBUm38EBUmDKUfB4/zi', 'Activo'),
(10, 'Sergio Valentín', 'Livias Barrios', 23218826, '1972-10-13', 'Serrán', '978067449', '$2y$10$GEv1kt5CrSIHsUuzof77ZeqAchcSPsNqWsjxSKQ5T//uE7fXQVSWa', 'Activo'),
(11, 'Renzo Luis', 'Obregón Chavez', 89796484, '1964-07-01', 'Serrán', '903556829', '$2y$10$09hZ9PFDwhdrDtnWOEUp5.Ektetd1o6PDcArdXiRP4oEGkM/QDx4i', 'Activo'),
(12, 'Hilda Alejandra', 'Nuñez Zapata', 77048118, '1963-03-14', 'Serrán', '901334629', '$2y$10$32xbM6Kh2gX.rdaIt5ttlOoC.vJTRNFzZgDQJ8v2iAE8Nxy1GLmEG', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluaciones`
--

CREATE TABLE `evaluaciones` (
  `ideva` int(11) NOT NULL,
  `idasig` int(11) NOT NULL,
  `bimestre` int(11) NOT NULL,
  `evaluacion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `evaluaciones`
--

INSERT INTO `evaluaciones` (`ideva`, `idasig`, `bimestre`, `evaluacion`) VALUES
(1, 1, 1, 'Pc1'),
(2, 1, 1, 'Examen Mensual'),
(3, 1, 1, 'Pc2'),
(4, 1, 1, 'Examen Bimestral'),
(5, 23, 1, 'Examen Mensual'),
(6, 23, 1, 'Examen Bimestral'),
(7, 2, 1, 'Pc1'),
(8, 2, 1, 'Examen Mensual'),
(9, 2, 1, 'Pc2'),
(10, 2, 1, 'Examen Bimestral'),
(11, 3, 1, 'Pc1'),
(12, 3, 1, 'Examen Mensual'),
(13, 3, 1, 'Pc2'),
(14, 3, 1, 'Examen Bimestral'),
(15, 4, 1, 'Pc1'),
(16, 4, 1, 'Examen Mensual'),
(17, 4, 1, 'Pc2'),
(18, 4, 1, 'Examen Bimestral'),
(19, 5, 1, 'Pc1'),
(20, 5, 1, 'Examen Mensual'),
(21, 5, 1, 'Pc2'),
(22, 5, 1, 'Examen Bimestral'),
(23, 6, 1, 'Pc1'),
(24, 6, 1, 'Examen Mensual'),
(25, 6, 1, 'Pc2'),
(26, 6, 1, 'Examen Bimestral'),
(27, 7, 1, 'Pc1'),
(28, 7, 1, 'Examen Mensual'),
(29, 7, 1, 'Pc2'),
(30, 7, 1, 'Examen Bimestral'),
(31, 22, 1, 'Pc1'),
(32, 22, 1, 'Examen Mensual'),
(33, 22, 1, 'Examen Bimestral'),
(34, 8, 1, 'Pc1'),
(35, 8, 1, 'Examen Mensual'),
(36, 8, 1, 'Pc2'),
(37, 8, 1, 'Examen Bimestral'),
(38, 10, 1, 'Pc1'),
(39, 10, 1, 'Examen Mensual'),
(40, 10, 1, 'Pc2'),
(41, 10, 1, 'Examen Bimestral'),
(42, 11, 1, 'Pc1'),
(43, 11, 1, 'Examen Mensual'),
(44, 11, 1, 'Pc2'),
(45, 11, 1, 'Examen Bimestral'),
(46, 12, 1, 'Pc1'),
(47, 12, 1, 'Examen Mensual'),
(48, 12, 1, 'Pc2'),
(49, 12, 1, 'Examen Bimestral'),
(50, 13, 1, 'Pc1'),
(51, 13, 1, 'Examen Mensual'),
(52, 13, 1, 'Pc2'),
(53, 13, 1, 'Examen Bimestral'),
(54, 16, 1, 'Pc1'),
(55, 16, 1, 'Examen Mensual'),
(56, 16, 1, 'Pc2'),
(57, 16, 1, 'Examen Bimestral'),
(58, 17, 1, 'Pc1'),
(59, 17, 1, 'Examen Mensual'),
(60, 17, 1, 'Pc2'),
(61, 17, 1, 'Examen Bimestral'),
(62, 18, 1, 'Pc1'),
(63, 18, 1, 'Examen Mensual'),
(64, 18, 1, 'Pc2'),
(65, 18, 1, 'Examen Bimestral'),
(66, 19, 1, 'Pc1'),
(67, 19, 1, 'Examen Mensual'),
(68, 19, 1, 'Pc2'),
(69, 19, 1, 'Examen Bimestral'),
(70, 20, 1, 'Pc1'),
(71, 20, 1, 'Examen Mensual'),
(72, 20, 1, 'Pc2'),
(73, 20, 1, 'Examen Bimestral'),
(74, 21, 1, 'Pc1'),
(75, 21, 1, 'Examen Mensual'),
(76, 21, 1, 'Examen Bimestral');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluacionnotas`
--

CREATE TABLE `evaluacionnotas` (
  `idnota` int(11) NOT NULL,
  `iddoc` int(11) NOT NULL,
  `idaula` int(11) NOT NULL,
  `idalumn` int(11) NOT NULL,
  `evalua` int(11) NOT NULL,
  `nota` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `evaluacionnotas`
--

INSERT INTO `evaluacionnotas` (`idnota`, `iddoc`, `idaula`, `idalumn`, `evalua`, `nota`) VALUES
(1, 1, 1, 1, 3, 15),
(2, 1, 1, 1, 2, 18),
(3, 1, 1, 1, 1, 19),
(4, 1, 1, 1, 4, 20),
(5, 1, 1, 2, 1, 20),
(6, 1, 1, 2, 2, 15),
(7, 1, 1, 2, 3, 17),
(8, 1, 1, 2, 4, 19),
(9, 1, 1, 2, 10, 16),
(10, 1, 1, 2, 9, 12),
(11, 1, 1, 2, 8, 15),
(12, 1, 1, 2, 7, 12),
(13, 8, 1, 2, 19, 8),
(14, 8, 1, 2, 20, 15),
(15, 8, 1, 2, 21, 17),
(16, 8, 1, 2, 22, 5),
(17, 2, 1, 1, 23, 14),
(18, 2, 1, 1, 24, 13),
(19, 2, 1, 1, 25, 12),
(20, 2, 1, 1, 26, 20),
(21, 2, 1, 1, 27, 15),
(22, 2, 1, 1, 28, 17),
(23, 2, 1, 1, 29, 20),
(24, 2, 1, 1, 30, 16),
(25, 2, 1, 2, 27, 18),
(26, 2, 1, 2, 28, 13),
(27, 2, 1, 2, 29, 12),
(28, 2, 1, 2, 30, 19),
(29, 2, 1, 2, 23, 20),
(30, 2, 1, 2, 24, 13),
(31, 2, 1, 2, 25, 16),
(32, 2, 1, 2, 26, 10),
(33, 5, 1, 2, 31, 15),
(34, 5, 1, 2, 32, 17),
(35, 5, 1, 2, 33, 20),
(36, 4, 1, 2, 11, 15),
(37, 4, 1, 2, 12, 19),
(38, 4, 1, 2, 13, 17),
(39, 4, 1, 2, 14, 12),
(40, 4, 1, 2, 15, 20),
(41, 4, 1, 2, 16, 14),
(42, 4, 1, 2, 17, 11),
(43, 4, 1, 2, 18, 5),
(44, 3, 1, 2, 5, 20),
(45, 3, 1, 2, 6, 17),
(46, 6, 1, 2, 38, 20),
(47, 6, 1, 2, 39, 15),
(48, 6, 1, 2, 40, 16),
(49, 6, 1, 2, 41, 18),
(50, 12, 1, 2, 54, 17),
(51, 12, 1, 2, 55, 15),
(52, 12, 1, 2, 56, 17),
(53, 12, 1, 2, 57, 18),
(54, 12, 1, 2, 73, 17),
(55, 12, 1, 2, 72, 14),
(56, 12, 1, 2, 71, 17),
(57, 12, 1, 2, 70, 19),
(58, 11, 1, 2, 42, 20),
(59, 11, 1, 2, 43, 17),
(60, 11, 1, 2, 44, 16),
(61, 11, 1, 2, 45, 11),
(62, 11, 1, 2, 46, 12),
(63, 11, 1, 2, 47, 16),
(64, 11, 1, 2, 48, 17),
(65, 11, 1, 2, 49, 12),
(66, 10, 1, 2, 58, 19),
(67, 10, 1, 2, 59, 20),
(68, 10, 1, 2, 60, 18),
(69, 10, 1, 2, 61, 15),
(70, 10, 1, 2, 62, 18),
(71, 10, 1, 2, 63, 11),
(72, 10, 1, 2, 64, 16),
(73, 10, 1, 2, 65, 18),
(74, 10, 1, 2, 67, 12),
(75, 10, 1, 2, 66, 18),
(76, 10, 1, 2, 68, 13),
(77, 10, 1, 2, 69, 16),
(78, 10, 1, 1, 62, 20),
(79, 10, 1, 1, 63, 12),
(80, 10, 1, 1, 64, 13),
(81, 10, 1, 1, 65, 5),
(82, 10, 1, 1, 66, 19),
(83, 10, 1, 1, 67, 12),
(84, 10, 1, 1, 68, 10),
(85, 10, 1, 1, 69, 14),
(86, 9, 1, 2, 74, 15),
(87, 9, 1, 2, 75, 15),
(88, 9, 1, 2, 76, 16),
(89, 9, 1, 1, 74, 12),
(90, 9, 1, 1, 75, 11),
(91, 9, 1, 1, 76, 20),
(92, 4, 1, 1, 11, 18),
(93, 4, 1, 1, 12, 20),
(94, 4, 1, 1, 13, 19),
(95, 4, 1, 1, 14, 18),
(96, 5, 1, 3, 31, 20),
(97, 5, 1, 3, 32, 20),
(98, 5, 1, 3, 33, 18),
(99, 5, 1, 4, 33, 17),
(100, 5, 1, 4, 32, 20),
(101, 5, 1, 4, 31, 17),
(102, 2, 1, 2, 34, 20),
(103, 2, 1, 2, 35, 15),
(104, 2, 1, 2, 36, 16),
(105, 2, 1, 2, 37, 17),
(106, 3, 1, 1, 5, 20),
(107, 3, 1, 1, 6, 14),
(108, 3, 1, 3, 5, 14),
(109, 3, 1, 3, 6, 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grados`
--

CREATE TABLE `grados` (
  `idgrado` int(11) NOT NULL,
  `nivel` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `grados`
--

INSERT INTO `grados` (`idgrado`, `nivel`, `nombre`) VALUES
(1, 1, '2 años'),
(2, 1, '3 años'),
(3, 1, '4 años'),
(4, 1, '5 años'),
(5, 2, '1ro'),
(6, 2, '2do'),
(7, 2, '3ro'),
(8, 2, '4to'),
(9, 2, '5to'),
(10, 2, '6to'),
(11, 3, '1ro'),
(12, 3, '2do'),
(13, 3, '3ro'),
(14, 3, '4to'),
(15, 3, '5to');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario`
--

CREATE TABLE `horario` (
  `id` int(11) NOT NULL,
  `iddocen` int(11) NOT NULL,
  `reunion` varchar(50) NOT NULL,
  `dia` date NOT NULL,
  `horai` time NOT NULL,
  `horaf` time NOT NULL,
  `estado` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `horario`
--

INSERT INTO `horario` (`id`, `iddocen`, `reunion`, `dia`, `horai`, `horaf`, `estado`) VALUES
(1, 8, 'Presencial', '2024-07-15', '16:00:00', '17:00:00', 'Inactivo'),
(2, 8, 'Presencial', '2024-07-15', '16:00:00', '17:00:00', 'Activo'),
(3, 6, 'Presencial', '2024-07-15', '15:30:00', '16:30:00', 'Activo'),
(4, 6, 'Presencial', '2024-07-17', '15:30:00', '16:30:00', 'Activo'),
(5, 3, 'Presencial', '2024-07-22', '15:30:00', '16:00:00', 'Activo'),
(6, 3, '', '2024-07-30', '16:00:00', '16:30:00', 'Inactivo'),
(7, 3, 'Virtual', '2024-07-29', '18:00:00', '18:40:00', 'Inactivo'),
(8, 3, 'Virtual', '2024-07-30', '17:30:00', '17:50:00', 'Inactivo'),
(9, 3, 'Virtual', '2024-08-05', '14:30:00', '16:00:00', 'Inactivo'),
(10, 8, 'Virtual', '2024-07-22', '06:00:00', '06:15:00', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `institucion`
--

CREATE TABLE `institucion` (
  `idinst` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `ubicacion` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `horario` varchar(20) NOT NULL,
  `codmodular` varchar(15) NOT NULL,
  `ugel` varchar(10) NOT NULL,
  `dre` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `institucion`
--

INSERT INTO `institucion` (`idinst`, `nombre`, `ubicacion`, `correo`, `telefono`, `horario`, `codmodular`, `ugel`, `dre`) VALUES
(1, 'Blas Pascal', 'Oquendo, Callao, Peru, 31', 'cblaspascal@gmail.com', ' 975041141', '7:00am - 6:00pm', '1928803', '02', 'Callao');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `niveles`
--

CREATE TABLE `niveles` (
  `idniv` int(11) NOT NULL,
  `nombre` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `niveles`
--

INSERT INTO `niveles` (`idniv`, `nombre`) VALUES
(1, 'Inicial'),
(2, 'Primaria'),
(3, 'Polidocencia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promedios`
--

CREATE TABLE `promedios` (
  `idpromedio` int(11) NOT NULL,
  `iddoc` int(11) NOT NULL,
  `idalumn` int(11) NOT NULL,
  `idasig` int(11) NOT NULL,
  `idbime` int(11) NOT NULL,
  `promedio` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `promedios`
--

INSERT INTO `promedios` (`idpromedio`, `iddoc`, `idalumn`, `idasig`, `idbime`, `promedio`) VALUES
(1, 1, 1, 1, 1, 18.00),
(2, 1, 2, 1, 1, 17.75),
(3, 1, 2, 2, 1, 13.75),
(4, 8, 2, 5, 1, 11.25),
(5, 2, 1, 6, 1, 14.75),
(6, 2, 1, 7, 1, 17.00),
(7, 2, 2, 7, 1, 15.50),
(8, 2, 2, 6, 1, 14.75),
(9, 5, 2, 22, 1, 17.33),
(10, 4, 2, 3, 1, 15.75),
(11, 4, 2, 4, 1, 12.50),
(12, 3, 2, 23, 1, 18.50),
(13, 6, 2, 10, 1, 17.25),
(14, 12, 2, 16, 1, 16.75),
(15, 12, 2, 20, 1, 16.75),
(16, 11, 2, 11, 1, 16.00),
(17, 11, 2, 12, 1, 14.25),
(18, 10, 2, 17, 1, 18.00),
(19, 10, 2, 18, 1, 15.75),
(20, 10, 2, 19, 1, 14.75),
(21, 10, 1, 18, 1, 12.50),
(22, 10, 1, 19, 1, 13.75),
(23, 9, 2, 21, 1, 15.33),
(24, 9, 1, 21, 1, 14.33),
(25, 4, 1, 3, 1, 18.75),
(26, 5, 3, 22, 1, 19.33),
(27, 5, 4, 22, 1, 18.00),
(28, 2, 2, 8, 1, 17.00),
(29, 3, 1, 23, 1, 17.00),
(30, 3, 3, 23, 1, 14.50),
(31, 3, 4, 23, 1, 17.90),
(32, 3, 5, 23, 1, 15.60),
(33, 3, 6, 23, 1, 13.40),
(34, 3, 7, 23, 1, 17.80),
(35, 3, 8, 23, 1, 12.10),
(36, 3, 9, 23, 1, 18.50),
(37, 3, 10, 23, 1, 11.70),
(38, 3, 11, 23, 1, 16.90),
(39, 3, 12, 23, 1, 14.20),
(40, 3, 13, 23, 1, 19.30),
(41, 3, 14, 23, 1, 10.80),
(42, 3, 15, 23, 1, 13.60),
(43, 3, 16, 23, 1, 17.40),
(44, 3, 17, 23, 1, 15.20),
(45, 3, 18, 23, 1, 11.70),
(46, 3, 19, 23, 1, 12.90),
(47, 3, 20, 23, 1, 11.30),
(48, 3, 21, 23, 1, 16.50),
(49, 3, 22, 23, 1, 14.60);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`idadm`);

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`idalum`),
  ADD KEY `aula` (`aula`);

--
-- Indices de la tabla `anuncios`
--
ALTER TABLE `anuncios`
  ADD PRIMARY KEY (`idanun`),
  ADD KEY `docente` (`docente`),
  ADD KEY `asignaturaaula` (`asignaturaaula`);

--
-- Indices de la tabla `area_curricular`
--
ALTER TABLE `area_curricular`
  ADD PRIMARY KEY (`idarea`);

--
-- Indices de la tabla `asignar_docente_asignatura`
--
ALTER TABLE `asignar_docente_asignatura`
  ADD PRIMARY KEY (`idreldoc`),
  ADD KEY `docente` (`docente`,`asignatura`),
  ADD KEY `asignatura` (`asignatura`);

--
-- Indices de la tabla `asignar_grado_asignatura`
--
ALTER TABLE `asignar_grado_asignatura`
  ADD PRIMARY KEY (`idrelgrado`),
  ADD KEY `asignatura` (`asignatura`),
  ADD KEY `aula` (`aula`);

--
-- Indices de la tabla `asignaturas`
--
ALTER TABLE `asignaturas`
  ADD PRIMARY KEY (`idasig`),
  ADD KEY `areacurricular` (`areacurricular`);

--
-- Indices de la tabla `aulas`
--
ALTER TABLE `aulas`
  ADD PRIMARY KEY (`idaula`),
  ADD KEY `grado` (`grado`),
  ADD KEY `tutor` (`tutor`);

--
-- Indices de la tabla `bimestres`
--
ALTER TABLE `bimestres`
  ADD PRIMARY KEY (`idbime`);

--
-- Indices de la tabla `boletanotas`
--
ALTER TABLE `boletanotas`
  ADD PRIMARY KEY (`idbol`),
  ADD KEY `alumno` (`alumno`),
  ADD KEY `bimestre` (`bimestre`);

--
-- Indices de la tabla `cita`
--
ALTER TABLE `cita`
  ADD PRIMARY KEY (`idcita`),
  ADD KEY `alumno` (`alumno`) USING BTREE,
  ADD KEY `docente` (`docente`) USING BTREE;

--
-- Indices de la tabla `comportamiento`
--
ALTER TABLE `comportamiento`
  ADD PRIMARY KEY (`idcomp`),
  ADD KEY `alumno` (`alumno`,`bimestre`),
  ADD KEY `bimestre` (`bimestre`);

--
-- Indices de la tabla `docentes`
--
ALTER TABLE `docentes`
  ADD PRIMARY KEY (`iddoc`);

--
-- Indices de la tabla `evaluaciones`
--
ALTER TABLE `evaluaciones`
  ADD PRIMARY KEY (`ideva`),
  ADD KEY `idasig` (`idasig`) USING BTREE,
  ADD KEY `bimestre` (`bimestre`) USING BTREE;

--
-- Indices de la tabla `evaluacionnotas`
--
ALTER TABLE `evaluacionnotas`
  ADD PRIMARY KEY (`idnota`),
  ADD KEY `iddoc` (`iddoc`) USING BTREE,
  ADD KEY `idaula` (`idaula`) USING BTREE,
  ADD KEY `idalumn` (`idalumn`) USING BTREE,
  ADD KEY `evalua` (`evalua`) USING BTREE;

--
-- Indices de la tabla `grados`
--
ALTER TABLE `grados`
  ADD PRIMARY KEY (`idgrado`),
  ADD KEY `grados_ibfk_1` (`nivel`);

--
-- Indices de la tabla `horario`
--
ALTER TABLE `horario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `horario_ibfk_1` (`iddocen`);

--
-- Indices de la tabla `institucion`
--
ALTER TABLE `institucion`
  ADD PRIMARY KEY (`idinst`);

--
-- Indices de la tabla `niveles`
--
ALTER TABLE `niveles`
  ADD PRIMARY KEY (`idniv`);

--
-- Indices de la tabla `promedios`
--
ALTER TABLE `promedios`
  ADD PRIMARY KEY (`idpromedio`),
  ADD KEY `idalumn` (`idalumn`) USING BTREE,
  ADD KEY `idasig` (`idasig`) USING BTREE,
  ADD KEY `idbime` (`idbime`) USING BTREE,
  ADD KEY `iddoc` (`iddoc`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administradores`
--
ALTER TABLE `administradores`
  MODIFY `idadm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `idalum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT de la tabla `anuncios`
--
ALTER TABLE `anuncios`
  MODIFY `idanun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `area_curricular`
--
ALTER TABLE `area_curricular`
  MODIFY `idarea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `asignar_docente_asignatura`
--
ALTER TABLE `asignar_docente_asignatura`
  MODIFY `idreldoc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT de la tabla `asignar_grado_asignatura`
--
ALTER TABLE `asignar_grado_asignatura`
  MODIFY `idrelgrado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT de la tabla `asignaturas`
--
ALTER TABLE `asignaturas`
  MODIFY `idasig` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `aulas`
--
ALTER TABLE `aulas`
  MODIFY `idaula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `bimestres`
--
ALTER TABLE `bimestres`
  MODIFY `idbime` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `boletanotas`
--
ALTER TABLE `boletanotas`
  MODIFY `idbol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `cita`
--
ALTER TABLE `cita`
  MODIFY `idcita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `comportamiento`
--
ALTER TABLE `comportamiento`
  MODIFY `idcomp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `docentes`
--
ALTER TABLE `docentes`
  MODIFY `iddoc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `evaluaciones`
--
ALTER TABLE `evaluaciones`
  MODIFY `ideva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT de la tabla `evaluacionnotas`
--
ALTER TABLE `evaluacionnotas`
  MODIFY `idnota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT de la tabla `grados`
--
ALTER TABLE `grados`
  MODIFY `idgrado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `horario`
--
ALTER TABLE `horario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `institucion`
--
ALTER TABLE `institucion`
  MODIFY `idinst` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `niveles`
--
ALTER TABLE `niveles`
  MODIFY `idniv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `promedios`
--
ALTER TABLE `promedios`
  MODIFY `idpromedio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD CONSTRAINT `alumnos_ibfk_1` FOREIGN KEY (`aula`) REFERENCES `aulas` (`idaula`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `anuncios`
--
ALTER TABLE `anuncios`
  ADD CONSTRAINT `anuncios_ibfk_1` FOREIGN KEY (`asignaturaaula`) REFERENCES `asignar_docente_asignatura` (`idreldoc`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `asignar_docente_asignatura`
--
ALTER TABLE `asignar_docente_asignatura`
  ADD CONSTRAINT `asignar_docente_asignatura_ibfk_2` FOREIGN KEY (`asignatura`) REFERENCES `asignar_grado_asignatura` (`idrelgrado`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `asignar_docente_asignatura_ibfk_3` FOREIGN KEY (`docente`) REFERENCES `docentes` (`iddoc`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `asignar_grado_asignatura`
--
ALTER TABLE `asignar_grado_asignatura`
  ADD CONSTRAINT `asignar_grado_asignatura_ibfk_2` FOREIGN KEY (`asignatura`) REFERENCES `asignaturas` (`idasig`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `asignar_grado_asignatura_ibfk_3` FOREIGN KEY (`aula`) REFERENCES `aulas` (`idaula`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `asignaturas`
--
ALTER TABLE `asignaturas`
  ADD CONSTRAINT `asignaturas_ibfk_1` FOREIGN KEY (`areacurricular`) REFERENCES `area_curricular` (`idarea`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `aulas`
--
ALTER TABLE `aulas`
  ADD CONSTRAINT `aulas_ibfk_1` FOREIGN KEY (`grado`) REFERENCES `grados` (`idgrado`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `aulas_ibfk_2` FOREIGN KEY (`tutor`) REFERENCES `docentes` (`iddoc`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `boletanotas`
--
ALTER TABLE `boletanotas`
  ADD CONSTRAINT `boletanotas_ibfk_1` FOREIGN KEY (`alumno`) REFERENCES `alumnos` (`idalum`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `boletanotas_ibfk_2` FOREIGN KEY (`bimestre`) REFERENCES `bimestres` (`idbime`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cita`
--
ALTER TABLE `cita`
  ADD CONSTRAINT `cita_ibfk_1` FOREIGN KEY (`alumno`) REFERENCES `alumnos` (`idalum`);

--
-- Filtros para la tabla `comportamiento`
--
ALTER TABLE `comportamiento`
  ADD CONSTRAINT `comportamiento_ibfk_1` FOREIGN KEY (`bimestre`) REFERENCES `bimestres` (`idbime`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comportamiento_ibfk_2` FOREIGN KEY (`alumno`) REFERENCES `alumnos` (`idalum`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `evaluaciones`
--
ALTER TABLE `evaluaciones`
  ADD CONSTRAINT `evaluaciones_ibfk_1` FOREIGN KEY (`idasig`) REFERENCES `asignaturas` (`idasig`),
  ADD CONSTRAINT `evaluaciones_ibfk_2` FOREIGN KEY (`bimestre`) REFERENCES `bimestres` (`idbime`);

--
-- Filtros para la tabla `evaluacionnotas`
--
ALTER TABLE `evaluacionnotas`
  ADD CONSTRAINT `evaluacionnotas_ibfk_1` FOREIGN KEY (`evalua`) REFERENCES `evaluaciones` (`ideva`),
  ADD CONSTRAINT `evaluacionnotas_ibfk_2` FOREIGN KEY (`idalumn`) REFERENCES `alumnos` (`idalum`),
  ADD CONSTRAINT `evaluacionnotas_ibfk_3` FOREIGN KEY (`iddoc`) REFERENCES `docentes` (`iddoc`);

--
-- Filtros para la tabla `grados`
--
ALTER TABLE `grados`
  ADD CONSTRAINT `grados_ibfk_1` FOREIGN KEY (`nivel`) REFERENCES `niveles` (`idniv`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `horario`
--
ALTER TABLE `horario`
  ADD CONSTRAINT `horario_ibfk_1` FOREIGN KEY (`iddocen`) REFERENCES `docentes` (`iddoc`);

--
-- Filtros para la tabla `promedios`
--
ALTER TABLE `promedios`
  ADD CONSTRAINT `promedios_ibfk_1` FOREIGN KEY (`idbime`) REFERENCES `bimestres` (`idbime`),
  ADD CONSTRAINT `promedios_ibfk_2` FOREIGN KEY (`idasig`) REFERENCES `asignaturas` (`idasig`),
  ADD CONSTRAINT `promedios_ibfk_3` FOREIGN KEY (`idalumn`) REFERENCES `alumnos` (`idalum`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
