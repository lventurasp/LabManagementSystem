-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 03-03-2023 a las 10:04:10
-- Versión del servidor: 8.0.32-0ubuntu0.22.04.2
-- Versión de PHP: 8.1.2-1ubuntu2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mydb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Partition type`
--

CREATE TABLE `Partition type` (
  `idPartition type` varchar(45) NOT NULL,
  `Shelves` int DEFAULT NULL,
  `Box` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Placement`
--

CREATE TABLE `Placement` (
  `idPlacement` varchar(45) NOT NULL,
  `Type` enum('Fridge','Freezer','Shelf') DEFAULT NULL,
  `Number` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `Placement`
--

INSERT INTO `Placement` (`idPlacement`, `Type`, `Number`) VALUES
('1234', 'Fridge', 1),
('Nevera1', NULL, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Placement_has_Partition type`
--

CREATE TABLE `Placement_has_Partition type` (
  `Placement_idPlacement` varchar(45) NOT NULL,
  `Partition type_idPartition type` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Priviledge`
--

CREATE TABLE `Priviledge` (
  `Priviledge` varchar(45) NOT NULL,
  `Priviledge_type` enum('read and write reagents','read reagents','build placements') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `Priviledge`
--

INSERT INTO `Priviledge` (`Priviledge`, `Priviledge_type`) VALUES
('BP', 'build placements'),
('R', 'read reagents'),
('WR', 'read and write reagents');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Reagents`
--

CREATE TABLE `Reagents` (
  `idReagents` varchar(45) NOT NULL,
  `Name` varchar(45) DEFAULT NULL,
  `Label` varchar(45) DEFAULT NULL,
  `Reference` varchar(45) DEFAULT NULL,
  `Stock` int DEFAULT NULL,
  `Shelf` int DEFAULT NULL,
  `Box` int DEFAULT NULL,
  `Link` varchar(45) DEFAULT NULL,
  `User_Email` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT 'example@gmail.com',
  `Placement_idPlacement` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '1234'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `Reagents`
--

INSERT INTO `Reagents` (`idReagents`, `Name`, `Label`, `Reference`, `Stock`, `Shelf`, `Box`, `Link`, `User_Email`, `Placement_idPlacement`) VALUES
('3K16Brw4', 'ssd', 'holiwis', 'jjjaaa', 14, 0, 0, 'sdsds', 'example@gmail.com', '1234'),
('9i69i1OB', 'dfdf', 'dfdf', 'fdfd', 22, 0, 0, 'fdfdffd', 'example@gmail.com', '1234'),
('WKeI2jza', 'A', 'B', 'C', 45, 0, 0, 'DDDD', 'example@gmail.com', '1234');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `User`
--

CREATE TABLE `User` (
  `Email` varchar(45) NOT NULL,
  `Password` varchar(45) DEFAULT NULL,
  `Name` varchar(45) DEFAULT NULL,
  `Surname` varchar(45) DEFAULT NULL,
  `Lastlogin` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `User`
--

INSERT INTO `User` (`Email`, `Password`, `Name`, `Surname`, `Lastlogin`) VALUES
('Example2@gmail.com', 'example2', 'Juan', 'Antonio Rodríguez', '2023-02-07 08:18:12'),
('example@gmail.com', 'example1', 'Pochita', 'Pichito', '2023-02-06 19:54:56'),
('patillotas2@gmail.com', 'poposito', 'uggiygviyg', 'gygyukgil', NULL),
('patillotas@gmail.com', 'poposito', 'Patis', 'Potis', NULL),
('Pulsi@gmail.com', 'Pulsio', 'Marti', 'Pubill', '2023-02-06 20:41:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `User_has_Priviledge`
--

CREATE TABLE `User_has_Priviledge` (
  `User_Email` varchar(45) NOT NULL,
  `Priviledge_Priviledge` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `User_has_Priviledge`
--

INSERT INTO `User_has_Priviledge` (`User_Email`, `Priviledge_Priviledge`) VALUES
('Pulsi@gmail.com', 'BP'),
('Example2@gmail.com', 'R'),
('patillotas2@gmail.com', 'R'),
('patillotas@gmail.com', 'R'),
('example@gmail.com', 'WR');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Partition type`
--
ALTER TABLE `Partition type`
  ADD PRIMARY KEY (`idPartition type`);

--
-- Indices de la tabla `Placement`
--
ALTER TABLE `Placement`
  ADD PRIMARY KEY (`idPlacement`);

--
-- Indices de la tabla `Placement_has_Partition type`
--
ALTER TABLE `Placement_has_Partition type`
  ADD PRIMARY KEY (`Placement_idPlacement`,`Partition type_idPartition type`),
  ADD KEY `fk_Placement_has_Partition type_Partition type1_idx` (`Partition type_idPartition type`),
  ADD KEY `fk_Placement_has_Partition type_Placement1_idx` (`Placement_idPlacement`);

--
-- Indices de la tabla `Priviledge`
--
ALTER TABLE `Priviledge`
  ADD PRIMARY KEY (`Priviledge`);

--
-- Indices de la tabla `Reagents`
--
ALTER TABLE `Reagents`
  ADD PRIMARY KEY (`idReagents`,`User_Email`,`Placement_idPlacement`),
  ADD KEY `fk_Reagents_User1_idx` (`User_Email`),
  ADD KEY `fk_Reagents_Placement1_idx` (`Placement_idPlacement`),
  ADD KEY `User_Email` (`User_Email`) USING BTREE;

--
-- Indices de la tabla `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`Email`);

--
-- Indices de la tabla `User_has_Priviledge`
--
ALTER TABLE `User_has_Priviledge`
  ADD PRIMARY KEY (`User_Email`,`Priviledge_Priviledge`),
  ADD KEY `fk_User_has_Priviledge_Priviledge1_idx` (`Priviledge_Priviledge`),
  ADD KEY `fk_User_has_Priviledge_User1_idx` (`User_Email`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Placement_has_Partition type`
--
ALTER TABLE `Placement_has_Partition type`
  ADD CONSTRAINT `fk_Placement_has_Partition type_Partition type1` FOREIGN KEY (`Partition type_idPartition type`) REFERENCES `Partition type` (`idPartition type`),
  ADD CONSTRAINT `fk_Placement_has_Partition type_Placement1` FOREIGN KEY (`Placement_idPlacement`) REFERENCES `Placement` (`idPlacement`);

--
-- Filtros para la tabla `Reagents`
--
ALTER TABLE `Reagents`
  ADD CONSTRAINT `fk_Reagents_Placement1` FOREIGN KEY (`Placement_idPlacement`) REFERENCES `Placement` (`idPlacement`),
  ADD CONSTRAINT `fk_Reagents_User1` FOREIGN KEY (`User_Email`) REFERENCES `User` (`Email`);

--
-- Filtros para la tabla `User_has_Priviledge`
--
ALTER TABLE `User_has_Priviledge`
  ADD CONSTRAINT `fk_User_has_Priviledge_Priviledge1` FOREIGN KEY (`Priviledge_Priviledge`) REFERENCES `Priviledge` (`Priviledge`),
  ADD CONSTRAINT `fk_User_has_Priviledge_User1` FOREIGN KEY (`User_Email`) REFERENCES `User` (`Email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
