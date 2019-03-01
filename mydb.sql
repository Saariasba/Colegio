-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-07-2017 a las 06:51:40
-- Versión del servidor: 10.1.22-MariaDB
-- Versión de PHP: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mydb`
--

--
-- Volcado de datos para la tabla `administrativo`
--

INSERT INTO `administrativo` (`persona_identificacion`, `clave`) VALUES
('6', '6');

--
-- Volcado de datos para la tabla `anio`
--

INSERT INTO `anio` (`id_anio`) VALUES
(2015),
(2016),
(2017);

--
-- Volcado de datos para la tabla `codigoprimaria`
--

INSERT INTO `codigoprimaria` (`codigo`, `cursoprimaria_id_cursoprimaria`, `cursoprimaria_periodo_id_periodo`, `cursoprimaria_periodo_anio_id_anio`, `estudiante_persona_identificacion`) VALUES
('1', '2A', 'Primero', 2015, '3');

--
-- Volcado de datos para la tabla `cursootros`
--

INSERT INTO `cursootros` (`id_cursootros`, `periodo_id_periodo`, `periodo_anio_id_anio`, `otros_grado_nombre`, `profesor_persona_identificacion`) VALUES
('TA', 'Primero', 2015, 'TransiciÃ³n', '2'),
('TB', 'Primero', 2015, 'TransiciÃ³n', '2');

--
-- Volcado de datos para la tabla `cursoprimaria`
--

INSERT INTO `cursoprimaria` (`id_cursoprimaria`, `periodo_id_periodo`, `periodo_anio_id_anio`, `primaria_grado_nombre`, `profesor_persona_identificacion`) VALUES
('1A', 'Primero', 2015, 'Primero', '2'),
('201', 'Primero', 2015, 'Segundo', '8'),
('2A', 'Primero', 2015, 'Primero', '2'),
('Cuarto-A', 'Primero', 2015, 'Cuarto', '2');

--
-- Volcado de datos para la tabla `estudiante`
--

INSERT INTO `estudiante` (`persona_identificacion`, `clave`) VALUES
('3', '3'),
('4', '4'),
('5', '5');

--
-- Volcado de datos para la tabla `grado`
--

INSERT INTO `grado` (`nombre`) VALUES
('Cuarto'),
('Primero'),
('Quinto'),
('Segundo'),
('Tercero'),
('TransiciÃ³n');

--
-- Volcado de datos para la tabla `mes`
--

INSERT INTO `mes` (`id_mes`, `anio_id_anio`) VALUES
('Enero', 2015),
('Enero', 2017),
('Febrero', 2017),
('Marzo', 2017);

--
-- Volcado de datos para la tabla `otros`
--

INSERT INTO `otros` (`grado_nombre`) VALUES
('TransiciÃ³n');

--
-- Volcado de datos para la tabla `periodo`
--

INSERT INTO `periodo` (`id_periodo`, `anio_id_anio`) VALUES
('Primero', 2015),
('Segundo', 2015);

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`identificacion`, `nombres`, `apellidos`, `edad`, `genero`, `tipo_identificacion`) VALUES
('1', 'Santiago', 'Arias Bareño', 19, 'Masculino', 'Cedula'),
('2', 'Alejandra', 'Arias', 22, 'Femenino', 'Cedula'),
('3', 'Karen', 'Albarracin', 18, 'Femenino', 'Cedula'),
('4', 'Raul', 'Maya', 19, 'Masculino', 'Pasaporte'),
('5', 'Yonathan', 'Layton', 19, 'Masculino', 'Cedula de Extranjeria'),
('6', 'Angie', 'Guzman', 22, 'Femenino', 'Cedula'),
('7', 'Andres Felipe', 'Buitrago Perez', 44, 'Masculino', 'Cedula'),
('8', 'Pedro', 'Fernandez', 33, 'Masculino', 'Cedula');

--
-- Volcado de datos para la tabla `primaria`
--

INSERT INTO `primaria` (`grado_nombre`) VALUES
('Cuarto'),
('Primero'),
('Quinto'),
('Segundo'),
('Tercero');

--
-- Volcado de datos para la tabla `profesor`
--

INSERT INTO `profesor` (`persona_identificacion`, `clave`) VALUES
('2', 'Arias2'),
('7', '7'),
('8', '8');

--
-- Volcado de datos para la tabla `rector`
--

INSERT INTO `rector` (`persona_identificacion`, `clave`) VALUES
('1', '1');

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`persona_identificacion`, `clave`, `tipo`) VALUES
('1', '1', 'Rector'),
('2', 'Arias2', 'Profesor'),
('3', '3', 'Estudiante'),
('4', '4', 'Estudiante'),
('5', '5', 'Estudiante'),
('6', '6', 'Administrativo'),
('7', '7', 'Profesor'),
('8', '8', 'Profesor');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
