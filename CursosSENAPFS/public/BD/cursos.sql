-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-08-2018 a las 22:44:40
-- Versión del servidor: 10.1.29-MariaDB
-- Versión de PHP: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cursos`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `cambiarEstado` ()  NO SQL
BEGIN
DECLARE hoy date;
SET hoy=(SELECT curdate());
update cursos c  SET c.estadoCurso =  'Cursando' where c.fechaInicio<=hoy && c.fechaFin>=hoy; 
update cursos c SET C.estadoCurso =  'Finalizado' WHERE c.fechaInicio<=hoy && c.fechaFin<=hoy; 
update cursos c SET C.estadoCurso =  'Activo' WHERE c.fechaInicio>=hoy && c.cupos>0;
update cursos c SET C.estadoCurso =  'Sin cupos' WHERE c.fechaInicio>=hoy && c.cupos=0;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminarCurso` (IN `cod_persona` INT, IN `idCursos` INT)  NO SQL
BEGIN
DELETE FROM cursos_has_personas where personas_codPersona =cod_persona and Cursos_idCursos=idCursos;
UPDATE CURSOS SET CUPOS= CUPOS +1 WHERE idCursos=idCursos;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_cursos`
--

CREATE TABLE `categoria_cursos` (
  `idCategoria_Cursos` int(11) NOT NULL,
  `nombreCategoria` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categoria_cursos`
--

INSERT INTO `categoria_cursos` (`idCategoria_Cursos`, `nombreCategoria`) VALUES
(1, 'Farmacéutica'),
(16, 'Seguridad laboral'),
(17, 'Gastronomía'),
(18, 'Domótica'),
(19, 'hola');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `idCursos` int(11) NOT NULL,
  `nombreCurso` varchar(45) NOT NULL,
  `cantidadHoras` varchar(45) NOT NULL,
  `encargadoCurso` varchar(45) NOT NULL,
  `fechaInicio` date NOT NULL,
  `fechaFin` date NOT NULL,
  `cupos` int(11) NOT NULL,
  `categoria` int(11) NOT NULL,
  `img` varchar(250) DEFAULT NULL,
  `estadoCurso` varchar(10) NOT NULL DEFAULT 'Activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`idCursos`, `nombreCurso`, `cantidadHoras`, `encargadoCurso`, `fechaInicio`, `fechaFin`, `cupos`, `categoria`, `img`, `estadoCurso`) VALUES
(12, 'mas', '30', 'a', '2018-08-13', '2018-08-31', 14, 1, 'Captura de pantalla (3).png', 'Finalizado'),
(13, 'canto', '30', 'Vahos', '2018-08-24', '2018-08-31', 22, 17, '', 'Finalizado'),
(21, 'Software', '20', 'juanse', '2018-08-16', '2018-08-31', 4, 18, 'Captura de pantalla (82).png', 'Finalizado'),
(22, 'szs', '20', 'asdas', '2018-08-27', '2018-08-29', 4, 16, 'Captura de pantalla (12).png', 'Finalizado'),
(23, 'canto', '30', 'a', '2018-08-27', '2018-08-16', 3, 16, 'Captura de pantalla (3).png', 'Finalizado'),
(24, 'Software', '20', 'asdas', '2018-08-27', '2018-08-31', 3, 16, 'Captura de pantalla (6).png', 'Finalizado'),
(25, 'Softwaret', '20', 'asdas', '2018-09-07', '2018-11-09', 8, 16, '', 'Activo'),
(26, 'Mi curso', '42', 'Juliana', '2018-09-02', '2018-09-29', 13, 17, 'Captura de pantalla (14).png', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos_has_personas`
--

CREATE TABLE `cursos_has_personas` (
  `id_has` int(11) NOT NULL,
  `Cursos_idCursos` int(11) NOT NULL,
  `Personas_codPersona` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cursos_has_personas`
--

INSERT INTO `cursos_has_personas` (`id_has`, `Cursos_idCursos`, `Personas_codPersona`) VALUES
(4, 12, 3),
(6, 26, 3),
(8, 25, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `cod_personas` int(11) NOT NULL,
  `documentoPersona` int(11) DEFAULT NULL,
  `tipoDocumento` int(11) DEFAULT NULL,
  `nombrePersona` varchar(45) NOT NULL,
  `apellidoPersona` varchar(45) NOT NULL,
  `telefonoPersona` varchar(45) DEFAULT NULL,
  `direccionPersona` varchar(45) DEFAULT NULL,
  `correoPersona` varchar(45) DEFAULT NULL,
  `rol` int(11) NOT NULL,
  `estado_persona` varchar(10) NOT NULL DEFAULT 'Activo',
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`cod_personas`, `documentoPersona`, `tipoDocumento`, `nombrePersona`, `apellidoPersona`, `telefonoPersona`, `direccionPersona`, `correoPersona`, `rol`, `estado_persona`, `password`) VALUES
(3, 214748387, 1, 'Sebastian', 'Corrales', '87258256', 'San Cristóbal', 'sebasscan@gmail.com', 2, 'Activo', '$2y$10$hQk2mDvwMlFqEdHz2TxcceEwoUXlQUp/uCNGXzeWrczpXYulepJRW'),
(60, 1035438464, 1, 'Alexis', 'Goéz  González', '3122854888', 'Copacabana', 'wagoez4@misena.edu.co', 1, 'Activo', '$2y$10$fJ9EO1SmTPZVH6yFNBXnKe7bP740o/NrwkWkSQnEueAdiUftv17ae'),
(61, 1023458575, 3, 'Brayan  Voxuz', 'Valdes', NULL, NULL, 'mas@mas.com', 2, 'Activo', '$2y$10$ye1OlAaTpy02JeWC5xlF/uh2g1KzPPuVHMTysaRO59.tr/4o8jux.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `idPregunta` int(11) NOT NULL,
  `descripcionPregunta` text NOT NULL,
  `respuestaPregunta` text NOT NULL,
  `idUser` int(11) NOT NULL,
  `Estado` varchar(10) NOT NULL DEFAULT 'Activo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`idPregunta`, `descripcionPregunta`, `respuestaPregunta`, `idUser`, `Estado`) VALUES
(2, 'dfsgdgsdg', 'gsdfgdfgsd', 60, 'Activo'),
(3, 'dfhsdgh', 'sdryhdhystrd', 60, 'Inactivo'),
(4, 'hola', 'Qué más\n', 3, 'Activo'),
(5, 'porque el gordo habla tanto???', 'poruqe si', 3, 'Activo'),
(6, 'szs', '', 3, 'Activo'),
(7, 'jajajajaj', 'ewgwqerhjuw', 61, 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicaciones`
--

CREATE TABLE `publicaciones` (
  `idPublicacion` int(11) NOT NULL,
  `tituloPublicacion` varchar(100) NOT NULL,
  `descripcionPublicacion` varchar(240) NOT NULL,
  `fechaPublicacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idCurso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `publicaciones`
--

INSERT INTO `publicaciones` (`idPublicacion`, `tituloPublicacion`, `descripcionPublicacion`, `fechaPublicacion`, `idCurso`) VALUES
(2, 'jft', 'tydetydr', '2018-08-22 20:00:18', 12),
(9, 'regtsdrs', 'sdfsdgdf', '2018-08-24 15:37:38', 12),
(10, 'gordo', 'yukgyhkfghjdjdfgkghghkfgk', '2018-08-24 16:02:37', 13),
(30, 'esafs', 'ewtrasgfa', '2018-08-30 21:41:51', 25),
(31, 'esafs', 'ewtrasgfa', '2018-08-30 21:43:01', 25),
(32, 'esafs', 'ewtrasgfa', '2018-08-30 21:43:26', 25),
(45, 'sdfad', 'gsdfgr', '2018-08-31 15:18:43', 25);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `nombreRol` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombreRol`) VALUES
(1, 'Admin'),
(2, 'Aprendiz');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipodocumento`
--

CREATE TABLE `tipodocumento` (
  `idtipoDocumento` int(11) NOT NULL,
  `nombreTipoDocumento` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipodocumento`
--

INSERT INTO `tipodocumento` (`idtipoDocumento`, `nombreTipoDocumento`) VALUES
(1, 'Cédula de Ciudadanía'),
(2, 'Tarjeta de Identidad'),
(3, 'SISBÉN');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria_cursos`
--
ALTER TABLE `categoria_cursos`
  ADD PRIMARY KEY (`idCategoria_Cursos`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`idCursos`),
  ADD KEY `fk_CategoriaCurso_idx` (`categoria`);

--
-- Indices de la tabla `cursos_has_personas`
--
ALTER TABLE `cursos_has_personas`
  ADD PRIMARY KEY (`id_has`),
  ADD KEY `fk_Cursos_has_Personas_Personas1_idx` (`Personas_codPersona`),
  ADD KEY `fk_Cursos_has_Personas_Cursos1_idx` (`Cursos_idCursos`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`cod_personas`) USING BTREE,
  ADD UNIQUE KEY `documentoPersona` (`documentoPersona`),
  ADD KEY `fk_tipoDoc_idx` (`tipoDocumento`),
  ADD KEY `fk_rolPersona` (`rol`);

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`idPregunta`),
  ADD KEY `idUser` (`idUser`);

--
-- Indices de la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  ADD PRIMARY KEY (`idPublicacion`),
  ADD KEY `fk_Curso` (`idCurso`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipodocumento`
--
ALTER TABLE `tipodocumento`
  ADD PRIMARY KEY (`idtipoDocumento`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria_cursos`
--
ALTER TABLE `categoria_cursos`
  MODIFY `idCategoria_Cursos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `idCursos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `cursos_has_personas`
--
ALTER TABLE `cursos_has_personas`
  MODIFY `id_has` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `cod_personas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `idPregunta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  MODIFY `idPublicacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipodocumento`
--
ALTER TABLE `tipodocumento`
  MODIFY `idtipoDocumento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD CONSTRAINT `fk_CategoriaCurso` FOREIGN KEY (`categoria`) REFERENCES `categoria_cursos` (`idCategoria_Cursos`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cursos_has_personas`
--
ALTER TABLE `cursos_has_personas`
  ADD CONSTRAINT `fk_Cursos_has_Personas_Cursos1` FOREIGN KEY (`Cursos_idCursos`) REFERENCES `cursos` (`idCursos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_personas_cursos` FOREIGN KEY (`Personas_codPersona`) REFERENCES `personas` (`cod_personas`);

--
-- Filtros para la tabla `personas`
--
ALTER TABLE `personas`
  ADD CONSTRAINT `fk_rolPersona` FOREIGN KEY (`rol`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `personas_ibfk_1` FOREIGN KEY (`tipoDocumento`) REFERENCES `tipodocumento` (`idtipoDocumento`);

--
-- Filtros para la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD CONSTRAINT `preguntas_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `personas` (`cod_personas`);

--
-- Filtros para la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  ADD CONSTRAINT `fk_Curso` FOREIGN KEY (`idCurso`) REFERENCES `cursos` (`idCursos`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
