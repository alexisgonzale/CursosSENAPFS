-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-09-2018 a las 22:57:01
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
-- Base de datos: `crs`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizarCursos` (IN `idCourse` INT, IN `nameCourse` VARCHAR(45), IN `quantityHours` VARCHAR(45), IN `attendant` VARCHAR(45), IN `startDate` DATE, IN `endingDate` DATE, IN `quota` INT, IN `category` INT)  NO SQL
Begin 

declare personas INT;
SET  personas= (
SELECT COUNT(CP.Personas_codPersona) from cursos_has_personas cp JOIN cursos c ON (cp.Cursos_idCursos=c.idCursos) where C.idCursos=idCourse); 
 
UPDATE cursos c SET c.nombreCurso = nameCourse, c.cantidadHoras = quantityHours, c.encargadoCurso = attendant, c.fechaInicio = startDate, c.fechaFin = endingDate, c.cupos = (quota-personas),c.cupos1=quota, c.idCategorias_has_Profesiones = category WHERE idCursos = idCourse;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `cambiarEstado` ()  NO SQL
BEGIN
DECLARE hoy date;
SET hoy=(SELECT curdate());
update cursos c  SET c.estadoCurso =  'Cursando' where c.fechaInicio<=hoy && c.fechaFin>=hoy; 
update cursos c SET C.estadoCurso =  'Finalizado' WHERE c.fechaInicio<=hoy && c.fechaFin<=hoy; 
update cursos c SET C.estadoCurso =  'Activo' WHERE c.fechaInicio>=hoy && c.cupos>0;
update cursos c SET C.estadoCurso =  'Sin cupos' WHERE c.fechaInicio>=hoy && c.cupos=0;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `cambiarEstadoPersona` (IN `_cod_personas` INT, IN `_estado_persona` VARCHAR(10))  NO SQL
BEGIN 

declare numero int;
set numero = (SELECT COUNT(*) FROM personas p where p.rol = 1 and p.estado_persona= 'Activo');

IF numero>1 THEN
UPDATE personas SET estado_persona = _estado_persona WHERE cod_personas= _cod_personas;
else 
UPDATE personas SET estado_persona = 'Activo' WHERE cod_personas= _cod_personas;
END if;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminarCurso` (IN `cod_persona` INT, IN `idCursos` INT)  NO SQL
BEGIN
DELETE FROM cursos_has_personas where personas_codPersona =cod_persona and Cursos_idCursos=idCursos;
UPDATE CURSOS SET CUPOS= CUPOS +1 WHERE idCursos=idCursos;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminarCursosss` (IN `idCourse` INT)  NO SQL
BEGIN

declare contador int;

SET contador =(SELECT COUNT(cp.Cursos_idCursos) from cursos_has_personas cp JOIN cursos c ON (cp.Cursos_idCursos= c.idCursos) WHERE c.idCursos= idCourse);
IF contador<=0 
THEN 
DELETE FROM cursos   WHERE idCursos=idCourse;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `finSancion` ()  NO SQL
BEGIN 

DECLARE fechaActual date;
SET fechaActual =(SELECT curdate());

UPDATE personas set estado_persona ='Activo' WHERE (SELECT fechaFin from sanciones where cod_personas = persona)<=fechaActual;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertarSanciones` (IN `idPersona` INT, IN `meses` INT)  NO SQL
BEGIN

DECLARE codPersona int;
DECLARE inicio date;
DECLARE fin date;
set inicio = curdate();
SET codPersona = idPersona;
set fin = DATE_ADD(inicio, INTERVAL meses MONTH);
UPDATE personas SET estado_persona='Sancionado' where cod_personas = codPersona;
INSERT INTO `sanciones`( `fechaInicio`, `fechaFin`, `persona`) VALUES (inicio,fin,codPersona);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `validarCorreo` (IN `correo` VARCHAR(50))  NO SQL
BEGIN
declare retorno int DEFAULT 0;

if ((SELECT COUNT(*) from personas p where p.correoPersona=correo)=0)
THEN 
SELECT 'Exits';
ELSE
SELECT 'Not exist' ;
end if;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `validate` (IN `idPersona` INT, IN `idCursos` INT)  NO SQL
BEGIN

DECLARE retorno boolean DEFAULT true;
if ((SELECT count(*) FROM cursos_has_personas cp WHERE cp.Cursos_idCursos =idCursos AND cp.Personas_codPersona=idPersona)<=0)
THEN 
insert INTO cursos_has_personas (`Cursos_idCursos`, `Personas_codPersona`)
VALUES (idCursos,idPersona);
SELECT retorno;
ELSE
 set retorno=false;
 SELECT retorno;
END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias_has_profesiones`
--

CREATE TABLE `categorias_has_profesiones` (
  `idCategorias_has_Profesiones` int(11) NOT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `profesion_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categorias_has_profesiones`
--

INSERT INTO `categorias_has_profesiones` (`idCategorias_has_Profesiones`, `categoria_id`, `profesion_id`) VALUES
(40, 69, 21),
(41, 69, 25),
(42, 70, 22),
(43, 71, 24),
(44, 72, 23),
(46, 72, 27),
(47, 69, 26),
(48, 73, 27),
(49, 73, 21),
(50, 73, 22),
(51, 73, 28),
(52, 73, 23),
(53, 73, 25);

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
(69, 'Salud'),
(70, '1.2'),
(71, 'Tecnología'),
(72, 'Gastronomía'),
(73, 'walter21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `idCursos` int(11) NOT NULL,
  `nombreCurso` varchar(50) NOT NULL,
  `cantidadHoras` varchar(45) NOT NULL,
  `encargadoCurso` varchar(45) NOT NULL,
  `fechaInicio` date NOT NULL,
  `fechaFin` date NOT NULL,
  `cupos` int(11) NOT NULL,
  `estadoCurso` varchar(10) NOT NULL DEFAULT 'Activo',
  `idCategorias_Has_Profesiones` int(11) DEFAULT NULL,
  `cupos1` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`idCursos`, `nombreCurso`, `cantidadHoras`, `encargadoCurso`, `fechaInicio`, `fechaFin`, `cupos`, `estadoCurso`, `idCategorias_Has_Profesiones`, `cupos1`) VALUES
(67, 'Curso de Python', '80', 'Juan David Ramírez', '2018-09-29', '2018-10-31', 99, 'Activo', NULL, 43),
(68, 'Curso de enfermería', '6.5', 'asdas', '2018-09-28', '2018-09-28', 45, 'Activo', 69, 19),
(69, 'Curso de barbería', '40', 'Walter Gonzáles', '2018-09-10', '2018-09-25', 78, 'Finalizado', 70, 18),
(70, 'canto', '60', 'asdas', '2018-09-27', '2018-09-29', 36, 'Cursando', 69, 2),
(71, 'Curso de enfermeríaCurso de enfermeríaCurso d', '20', 'Vahos', '2018-09-27', '2018-09-28', 53, 'Finalizado', 70, 20),
(72, 'Curso de enfermeríaCurso de enfermeríaCurso d', '20', 'Vahos', '2018-09-27', '2018-09-28', 53, 'Finalizado', 70, 20),
(73, 'Curso de enfermeríaCurso de enfermeríaCurso d', '60', 'asdas', '2018-09-28', '2018-09-29', 53, 'Activo', 70, 20),
(74, 'Curso de gastronomía', '90', 'Chef', '2018-09-29', '2019-01-24', 76, 'Activo', 72, 60);

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
(124, 69, 112),
(126, 68, 116),
(157, 67, 113),
(173, 68, 114),
(174, 68, 112),
(182, 67, 111),
(185, 74, 114);

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
  `rol` int(11) NOT NULL,
  `estado_persona` varchar(10) NOT NULL DEFAULT 'Activo',
  `password` varchar(250) NOT NULL,
  `profesionPersona` int(11) DEFAULT NULL,
  `LugarProfesion` varchar(45) DEFAULT NULL,
  `correoPersona` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`cod_personas`, `documentoPersona`, `tipoDocumento`, `nombrePersona`, `apellidoPersona`, `telefonoPersona`, `direccionPersona`, `rol`, `estado_persona`, `password`, `profesionPersona`, `LugarProfesion`, `correoPersona`) VALUES
(111, 1035438464, 1, 'Walter Alexis', 'Goez Gonzáles', '00004575', 'a', 1, 'Activo', '$2y$10$UfwHlCDz1HLeoc/tfpLdaO2GvP33RKpJxBl8IjP9va12nELk3jPyK', NULL, NULL, 'wagoez4@misena.edu.co'),
(112, 1152222548, 1, 'Jonathan', 'Valdes', '8774879', 'San Cristóbal', 2, 'Activo', '$2y$10$IToRWWbp4FzGOsLdqcH4suRnR.z5259gNnPMYEUrIvsiQ1pEiZ8kG', 27, 'SENA S.A', 'jonathan980812@hotmail.com'),
(113, 1001470688, 1, 'Sebastián ', 'Corrales Sepúlveda', '0515454486', 'San Cristóbal', 2, 'Sancionado', '$2y$10$Ck1OfCYs5kt7RE9/pIBkLujyQ8JhF.ogrG6cunPoK08H/hL3rB5lS', 22, 'Brooklyn', 'scorrales88@misena.edu.co'),
(114, 100167488, 1, 'Brayan', 'Valdes', '5649112', 'Copacabana', 2, 'Activo', '$2y$10$XehTI.cowMEB64W9wkt0QuRiKVl.J02Y.232CY7TPmggGv1fa2liW', 21, 'Clínica SOMA', 'bvaldesgallego@misena.edu.co'),
(115, 2147483647, 1, 'Brayan El CABO', 'Goéz González', '8774879', 'Cll 4458', 1, 'Inactivo', '$2y$10$/dH1.zNrzTy1511A/QYwnegZqB.uwsmA6CjVfRuAJjMTV5dMVVf1m', NULL, NULL, 'ho@vo.bo'),
(116, 71214638, 1, 'Oscar', 'Gonzalez', NULL, NULL, 2, 'Sancionado', '$2y$10$aAr9oEg68HAcUVvBC7GSOOIbfS09iGz02s3ciTQEV0XG8KWpTica.', 21, 'SENA S.A', 'oagonzalez@misena.edu.co'),
(117, -2147483648, 1, 'Brayan El CABO', 'Valdes', '8774879', 'Copacabana', 1, 'Activo', '$2y$10$p3oW6lwIvKhUxVGocVsdk.EXfVqgPbU3Xyi8Z//rtYU8asY1N0rzy', NULL, NULL, 'jd541@misena.edu.co'),
(120, 1001470688, 2, 'sdfassdfa', 'asdfasd', '89414516', 'adasca', 1, 'Activo', '$2y$10$lcBMuNVmohBa8NjtsEp73.q4capUtcOsef645UE9Cbk1ZiA2/zN9G', NULL, NULL, 'asdas@hot.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `idPregunta` int(11) NOT NULL,
  `descripcionPregunta` varchar(200) NOT NULL,
  `respuestaPregunta` varchar(500) NOT NULL,
  `idUser` int(11) NOT NULL,
  `Estado` varchar(10) NOT NULL DEFAULT 'Activo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`idPregunta`, `descripcionPregunta`, `respuestaPregunta`, `idUser`, `Estado`) VALUES
(27, '¿Por qué no puedo inscribirme?', 'Está sancionado.', 111, 'Activo'),
(29, '¿Cómo recuperar mi contraseña?', 'En el login, clic en olvidé mi contraseña, ingresar su correo electrónico y se le enviará una contraseña provisional en dicho email.', 111, 'Inactivo'),
(30, 'Hola, tienen Curso de toma de muestras?..Gracias', 'yes', 116, 'Inactivo'),
(34, 'fgsdfg', '', 113, 'Activo'),
(35, 'asdgsdfgsdf', '', 113, 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesiones`
--

CREATE TABLE `profesiones` (
  `idProfesion` int(11) NOT NULL,
  `nombreProfesion` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `profesiones`
--

INSERT INTO `profesiones` (`idProfesion`, `nombreProfesion`) VALUES
(21, 'Médico'),
(22, 'Barbero'),
(23, 'Cocinero'),
(24, 'Desarrollador de Software'),
(25, 'Odontologo'),
(26, 'Neurólogo'),
(27, 'Chef'),
(28, 'hola vnv');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicaciones`
--

CREATE TABLE `publicaciones` (
  `idPublicacion` int(11) NOT NULL,
  `tituloPublicacion` varchar(100) NOT NULL,
  `requisitosCurso` varchar(100) NOT NULL,
  `distribucionHoraria` varchar(100) NOT NULL,
  `descripcionPublicacion` varchar(240) NOT NULL,
  `fechaPublicacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idCurso` int(11) DEFAULT NULL,
  `img` varchar(250) DEFAULT NULL,
  `Estado` varchar(10) NOT NULL DEFAULT 'Inactivo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `publicaciones`
--

INSERT INTO `publicaciones` (`idPublicacion`, `tituloPublicacion`, `requisitosCurso`, `distribucionHoraria`, `descripcionPublicacion`, `fechaPublicacion`, `idCurso`, `img`, `Estado`) VALUES
(112, 'Curso de python de 0 a profesional', 'Tener lógica de programación.', 'Lunes y jueves de 06 a.m a 10 a.m', 'Presentarse a administración educativa.', '2018-09-26 13:53:22', 67, '', 'Activo'),
(113, 'Curso de primeros auxilios intensivos', 'Ser técnico en enfermería', 'Lunes, miércoles y viernes de 12 p.m a 3 p.m', 'Presentarse a torre sur.', '2018-09-26 13:56:58', 68, '', 'Activo'),
(115, 'Nuevo curso de cocina', 'Saber cocinar.', 'Diario', 'Jaja.', '2018-09-28 17:20:24', 74, '', 'Activo');

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
(1, 'Súper administrador'),
(2, 'Aprendiz');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sanciones`
--

CREATE TABLE `sanciones` (
  `idSanciones` int(11) NOT NULL,
  `fechaInicio` date DEFAULT NULL,
  `fechaFin` date DEFAULT NULL,
  `persona` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sanciones`
--

INSERT INTO `sanciones` (`idSanciones`, `fechaInicio`, `fechaFin`, `persona`) VALUES
(58, '2018-09-26', '2018-11-26', 114),
(59, '2018-09-26', '2018-10-26', 113),
(60, '2018-09-27', '2018-02-27', 116);

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
(3, 'Cédula de Extranjería'),
(5, 'Pasaporte'),
(6, 'Documento Nacional de Identificación'),
(7, 'NIT');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias_has_profesiones`
--
ALTER TABLE `categorias_has_profesiones`
  ADD PRIMARY KEY (`idCategorias_has_Profesiones`),
  ADD KEY `fk_categoria_id` (`categoria_id`),
  ADD KEY `fk_Profesioness` (`profesion_id`);

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
  ADD KEY `fk_categoria_profesiones` (`idCategorias_Has_Profesiones`);

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
  ADD KEY `fk_tipoDoc_idx` (`tipoDocumento`),
  ADD KEY `fk_rolPersona` (`rol`),
  ADD KEY `fk_profesionPersona` (`profesionPersona`);

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`idPregunta`),
  ADD KEY `fk_idUser` (`idUser`);

--
-- Indices de la tabla `profesiones`
--
ALTER TABLE `profesiones`
  ADD PRIMARY KEY (`idProfesion`);

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
-- Indices de la tabla `sanciones`
--
ALTER TABLE `sanciones`
  ADD PRIMARY KEY (`idSanciones`),
  ADD KEY `persona` (`persona`);

--
-- Indices de la tabla `tipodocumento`
--
ALTER TABLE `tipodocumento`
  ADD PRIMARY KEY (`idtipoDocumento`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias_has_profesiones`
--
ALTER TABLE `categorias_has_profesiones`
  MODIFY `idCategorias_has_Profesiones` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de la tabla `categoria_cursos`
--
ALTER TABLE `categoria_cursos`
  MODIFY `idCategoria_Cursos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `idCursos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT de la tabla `cursos_has_personas`
--
ALTER TABLE `cursos_has_personas`
  MODIFY `id_has` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=186;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `cod_personas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `idPregunta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `profesiones`
--
ALTER TABLE `profesiones`
  MODIFY `idProfesion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  MODIFY `idPublicacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `sanciones`
--
ALTER TABLE `sanciones`
  MODIFY `idSanciones` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `tipodocumento`
--
ALTER TABLE `tipodocumento`
  MODIFY `idtipoDocumento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `categorias_has_profesiones`
--
ALTER TABLE `categorias_has_profesiones`
  ADD CONSTRAINT `fk_Profesioness` FOREIGN KEY (`profesion_id`) REFERENCES `profesiones` (`idProfesion`),
  ADD CONSTRAINT `fk_categoria_id` FOREIGN KEY (`categoria_id`) REFERENCES `categoria_cursos` (`idCategoria_Cursos`);

--
-- Filtros para la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD CONSTRAINT `fk_categoria_profesiones` FOREIGN KEY (`idCategorias_Has_Profesiones`) REFERENCES `categorias_has_profesiones` (`categoria_id`);

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
  ADD CONSTRAINT `fk_profesionPersona` FOREIGN KEY (`profesionPersona`) REFERENCES `profesiones` (`idProfesion`),
  ADD CONSTRAINT `fk_rolPersona` FOREIGN KEY (`rol`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `personas_ibfk_1` FOREIGN KEY (`tipoDocumento`) REFERENCES `tipodocumento` (`idtipoDocumento`);

--
-- Filtros para la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD CONSTRAINT `fk_idUser` FOREIGN KEY (`idUser`) REFERENCES `personas` (`cod_personas`);

--
-- Filtros para la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  ADD CONSTRAINT `fk_Curso` FOREIGN KEY (`idCurso`) REFERENCES `cursos` (`idCursos`);

--
-- Filtros para la tabla `sanciones`
--
ALTER TABLE `sanciones`
  ADD CONSTRAINT `sanciones_ibfk_1` FOREIGN KEY (`persona`) REFERENCES `personas` (`cod_personas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
