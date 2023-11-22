-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 22-11-2023 a las 18:34:51
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `medicinventory`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--
-- Creación: 22-11-2023 a las 17:19:39
--

CREATE TABLE `categoria` (
  `idCATEGORIA` int(11) NOT NULL,
  `DescripcionCate` varchar(255) NOT NULL,
  `nombreCat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idCATEGORIA`, `DescripcionCate`, `nombreCat`) VALUES
(1, 'Los analgésicos son medicinas que reducen o alivian los dolores de cabeza, musculares, artríticos o muchos otros achaques y dolores.', 'ANALGÉSICOS'),
(5, 'los mess asda', 'MESS'),
(6, 'fff', 'ddd'),
(7, 'prueba devo', 'pruebadevo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `devoluciones`
--
-- Creación: 22-11-2023 a las 17:19:39
--

CREATE TABLE `devoluciones` (
  `idDevoluciones` int(11) NOT NULL,
  `cantidadD` int(11) NOT NULL,
  `nombreProducto` varchar(45) NOT NULL,
  `estadoD` varchar(45) NOT NULL,
  `motivoD` varchar(45) NOT NULL,
  `cantidadUD` int(11) DEFAULT NULL,
  `PEDIDO_idPEDIDO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `devoluciones`
--

INSERT INTO `devoluciones` (`idDevoluciones`, `cantidadD`, `nombreProducto`, `estadoD`, `motivoD`, `cantidadUD`, `PEDIDO_idPEDIDO`) VALUES
(34, 0, '33', 'Aprobada', 'dañados', 22, 29);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `distribuidor`
--
-- Creación: 22-11-2023 a las 17:19:39
--

CREATE TABLE `distribuidor` (
  `idDISTRIBUIDOR` int(11) NOT NULL,
  `NIT_distribuidor` int(255) NOT NULL,
  `nombreDistri` varchar(255) NOT NULL,
  `direccionDistri` varchar(255) NOT NULL,
  `celularDistri` int(255) NOT NULL,
  `telefonoDistri` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `distribuidor`
--

INSERT INTO `distribuidor` (`idDISTRIBUIDOR`, `NIT_distribuidor`, `nombreDistri`, `direccionDistri`, `celularDistri`, `telefonoDistri`) VALUES
(4, 12312312, 'RONALDO BARRAGAN', 'calle 45', 2147483647, 3123123);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formulamedica`
--
-- Creación: 22-11-2023 a las 17:19:39
--

CREATE TABLE `formulamedica` (
  `idFORMULA` int(11) NOT NULL,
  `Referenciaformula` int(200) DEFAULT NULL,
  `estadoFormula` varchar(255) NOT NULL,
  `fechaFormula` date NOT NULL,
  `observacionesFormula` varchar(255) NOT NULL,
  `pagoFormula` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `formulamedica`
--

INSERT INTO `formulamedica` (`idFORMULA`, `Referenciaformula`, `estadoFormula`, `fechaFormula`, `observacionesFormula`, `pagoFormula`) VALUES
(1, 33322333, 'pendiente', '2023-10-28', 'pago pendeiente', 2580),
(3, 33322233, 'Incompleto', '2023-11-10', 'EL SR PAGO EL 12/12/2020ADSAD', 223132),
(5, 3312122, 'Completo', '2023-11-16', 'pruebadevo', 45000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicamento`
--
-- Creación: 22-11-2023 a las 17:19:39
--

CREATE TABLE `medicamento` (
  `idMEDICAMENTO` int(200) NOT NULL,
  `descripcionMedica` varchar(255) NOT NULL,
  `fechaVencimientoMedica` date NOT NULL,
  `cantidadCajas` int(255) NOT NULL,
  `noLoteMedica` int(255) NOT NULL,
  `valorUnitMedica` int(255) NOT NULL,
  `fechaFabricacionMedica` date NOT NULL,
  `nombreMedica` varchar(255) NOT NULL,
  `cantidadUnidades` int(255) NOT NULL,
  `Persona_idPersona` int(11) NOT NULL,
  `Persona_ROL_idRol` int(11) NOT NULL,
  `SUBCATEGORIA_idSUBCATEGORIA` int(11) NOT NULL,
  `SUBCATEGORIA_CATEGORIA_idCATEGORIA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `medicamento`
--

INSERT INTO `medicamento` (`idMEDICAMENTO`, `descripcionMedica`, `fechaVencimientoMedica`, `cantidadCajas`, `noLoteMedica`, `valorUnitMedica`, `fechaFabricacionMedica`, `nombreMedica`, `cantidadUnidades`, `Persona_idPersona`, `Persona_ROL_idRol`, `SUBCATEGORIA_idSUBCATEGORIA`, `SUBCATEGORIA_CATEGORIA_idCATEGORIA`) VALUES
(21, 'sdad', '2023-11-24', 23, 1111, 123456, '2023-11-10', 'parace', 345, 12, 1, 3, 1),
(23, 'qqqqqq', '2023-12-05', 1, 2222, 22222, '2023-11-12', 'dddddd', 9, 12, 1, 3, 1),
(24, 'dddd', '2023-12-06', 3, 32, 22222, '2023-11-29', 'dddd', 60, 12, 1, 3, 1),
(25, 'ddddd', '2023-11-16', 2, 323, 0, '2023-11-08', 'fffffff', 10, 12, 1, 3, 1),
(26, 'pruebaparadevolvermedica', '2023-11-15', 25, 1010, 4500, '2023-11-14', 'pruebadevolucion', 301, 21, 1, 7, 7),
(27, 'dev', '2023-11-18', 500, 1, 25000, '2023-11-16', 'devo', 128, 23, 1, 7, 7),
(33, 'prueba', '2023-11-23', 100, 100, 1000, '2023-11-16', 'PruebaDevolucion', 120, 22, 1, 7, 7),
(34, '500 ML', '2023-11-22', 0, 333, 22222, '2023-11-22', 'PRUEBA CREACION', 40, 12, 1, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--
-- Creación: 22-11-2023 a las 17:19:39
--

CREATE TABLE `pago` (
  `idPAGO` int(11) NOT NULL,
  `ReferenciaPago` int(30) NOT NULL,
  `estadoPago` varchar(255) NOT NULL,
  `fechaPago` date NOT NULL,
  `hechoPor` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pago`
--

INSERT INTO `pago` (`idPAGO`, `ReferenciaPago`, `estadoPago`, `fechaPago`, `hechoPor`) VALUES
(1, 33223, 'Completo', '2023-10-29', 'juana'),
(4, 22233, 'Completo', '2023-11-16', 'pruebadevo'),
(5, 423245, 'Completo', '2023-11-16', 'raul '),
(15, 413322, 'Incompleto', '2023-11-21', 'pepito');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--
-- Creación: 22-11-2023 a las 17:19:39
--

CREATE TABLE `pedido` (
  `idPEDIDO` int(11) NOT NULL,
  `Tipo_pedido` varchar(50) NOT NULL,
  `fechaPedido` date NOT NULL,
  `costoPedido` int(255) NOT NULL,
  `Nombre_Producto` varchar(255) NOT NULL,
  `cantidadP` int(255) NOT NULL,
  `Fecha_entrega` date NOT NULL,
  `Fecha_envio` date NOT NULL,
  `EstadoP` varchar(255) NOT NULL,
  `SUCURSALIPS_idSUCURSALIPS` int(11) NOT NULL,
  `DISTRIBUIDOR_idDISTRIBUIDOR` int(11) NOT NULL,
  `PAGO_idPAGO` int(11) NOT NULL,
  `MEDICAMENTO_idMEDICAMENTO` int(11) NOT NULL,
  `MEDICAMENTO_Persona_idPersona` int(11) NOT NULL,
  `MEDICAMENTO_PERSONA_ROL_idRol` int(11) NOT NULL,
  `MEDICAMENTO_SUBCATEGORIA_idSUBCATEGORIA` int(11) NOT NULL,
  `MEDICAMENTO_SUBCATEGORIA_CATEGORIA_idCATEGORIA` int(11) NOT NULL,
  `FORMULAMEDICA_idFORMULA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`idPEDIDO`, `Tipo_pedido`, `fechaPedido`, `costoPedido`, `Nombre_Producto`, `cantidadP`, `Fecha_entrega`, `Fecha_envio`, `EstadoP`, `SUCURSALIPS_idSUCURSALIPS`, `DISTRIBUIDOR_idDISTRIBUIDOR`, `PAGO_idPAGO`, `MEDICAMENTO_idMEDICAMENTO`, `MEDICAMENTO_Persona_idPersona`, `MEDICAMENTO_PERSONA_ROL_idRol`, `MEDICAMENTO_SUBCATEGORIA_idSUBCATEGORIA`, `MEDICAMENTO_SUBCATEGORIA_CATEGORIA_idCATEGORIA`, `FORMULAMEDICA_idFORMULA`) VALUES
(19, 'Entrada', '2023-11-21', 45000, 'pruebadevolucion', 201, '2023-11-16', '2023-11-15', 'En Reparto', 6, 4, 1, 26, 21, 1, 7, 7, 1),
(25, 'Entrada', '2023-11-21', 22222, 'pruebadevolucion', 200, '2023-11-14', '2023-11-14', 'En Reparto', 6, 4, 1, 26, 12, 1, 7, 7, 1),
(27, 'Salida', '2023-11-16', 25000, 'devo', 200, '2023-11-20', '2023-11-18', 'En Reparto', 6, 4, 4, 27, 23, 1, 7, 7, 1),
(29, 'Salida', '2023-11-20', 161, '33', 50, '2023-12-01', '2023-11-23', 'Salida', 8, 4, 1, 33, 25, 1, 7, 7, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--
-- Creación: 22-11-2023 a las 17:19:39
--

CREATE TABLE `persona` (
  `idPersona` int(11) NOT NULL,
  `cedulaP` int(10) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `numeroP` int(10) NOT NULL,
  `telefonoP` int(10) NOT NULL,
  `nombreP` varchar(255) NOT NULL,
  `apellidosP` varchar(255) NOT NULL,
  `contrasena` varchar(255) DEFAULT NULL,
  `ROL_idRol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`idPersona`, `cedulaP`, `correo`, `numeroP`, `telefonoP`, `nombreP`, `apellidosP`, `contrasena`, `ROL_idRol`) VALUES
(12, 12312312, 'ronaldolachupa123@gmail.com', 123, 1231, 'Ronaldo  el mas gay', 'insano', 'mama huevo', 1),
(17, 2232133, 'ronaldolachupa123@gmail.com', 223344, 2233444, 'ronaldo', 'mama huevo', 'mama huevo', 1),
(20, 171, 'ui@ai', 123123, 123123, 'aaaaaaaaaaa', 'aaaaaaaaaaaaa', 'we', 1),
(21, 101, 'facil@g', 121, 1212, 'lol', 'lol', 'lol', 1),
(22, 1233690107, 'benicolas11@hotmail.com', 2147483647, 2147483647, 'Jose Nicolas', 'Riaño Abril', '54321', 1),
(23, 3232, 'pruebaderoles@gmail.com', 123, 1234, 'rolesprueba', 'us', 'pruebarol', 3),
(24, 123123, 'a@a', 2414, 213123, 'a', 'aa', 'aaa', 27),
(25, 12333, 'asistente@gmail.com', 32324, 23234, 'asistente', 'asistente', '1234', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--
-- Creación: 22-11-2023 a las 17:19:39
--

CREATE TABLE `proveedor` (
  `idPROVEEDOR` int(11) NOT NULL,
  `NITproveedores` int(11) NOT NULL,
  `nombreProve` varchar(45) NOT NULL,
  `direccionProve` varchar(45) NOT NULL,
  `telefonoProve` int(11) NOT NULL,
  `celularProve` int(11) NOT NULL,
  `SUCURSALIPS_idSUCURSALIPS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`idPROVEEDOR`, `NITproveedores`, `nombreProve`, `direccionProve`, `telefonoProve`, `celularProve`, `SUCURSALIPS_idSUCURSALIPS`) VALUES
(6, 123131231, 'ronaldo', 'adsdasd', 321313213, 312321312, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--
-- Creación: 22-11-2023 a las 17:19:39
--

CREATE TABLE `rol` (
  `idRol` int(11) NOT NULL,
  `nombreRol` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idRol`, `nombreRol`) VALUES
(1, 'Administrador'),
(2, 'Asistente'),
(3, 'Lector'),
(26, 'Asistente'),
(27, 'Lector'),
(28, 'prueba2'),
(29, 'Sua');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategoria`
--
-- Creación: 22-11-2023 a las 17:19:39
--

CREATE TABLE `subcategoria` (
  `idSUBCATEGORIA` int(11) NOT NULL,
  `descripcionSubcat` varchar(255) NOT NULL,
  `nombreSubcat` varchar(255) NOT NULL,
  `CATEGORIA_idCATEGORIA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `subcategoria`
--

INSERT INTO `subcategoria` (`idSUBCATEGORIA`, `descripcionSubcat`, `nombreSubcat`, `CATEGORIA_idCATEGORIA`) VALUES
(3, 'pastillas', 'vitaminasa', 1),
(4, 'xxxxx', 'asdadas', 1),
(5, 'dddddd', 'ssssss', 5),
(6, 'dddddaaaaa', 'aaaaadd', 6),
(7, 'pruebadevolu', 'pruebadevolu', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursalips`
--
-- Creación: 22-11-2023 a las 17:19:39
--

CREATE TABLE `sucursalips` (
  `idSUCURSAL` int(11) NOT NULL,
  `direccionSucur` varchar(255) NOT NULL,
  `nombreIps` varchar(255) NOT NULL,
  `nivelSucursal` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sucursalips`
--

INSERT INTO `sucursalips` (`idSUCURSAL`, `direccionSucur`, `nombreIps`, `nivelSucursal`) VALUES
(6, 'calle 34', 'ronaldo  el re mrk', '1'),
(8, 'dwadad', 'ronaldo el gei', '1');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idCATEGORIA`);

--
-- Indices de la tabla `devoluciones`
--
ALTER TABLE `devoluciones`
  ADD PRIMARY KEY (`idDevoluciones`),
  ADD KEY `PEDIDO_idPEDIDO` (`PEDIDO_idPEDIDO`);

--
-- Indices de la tabla `distribuidor`
--
ALTER TABLE `distribuidor`
  ADD PRIMARY KEY (`idDISTRIBUIDOR`);

--
-- Indices de la tabla `formulamedica`
--
ALTER TABLE `formulamedica`
  ADD PRIMARY KEY (`idFORMULA`);

--
-- Indices de la tabla `medicamento`
--
ALTER TABLE `medicamento`
  ADD PRIMARY KEY (`idMEDICAMENTO`),
  ADD KEY `Persona_idPersona` (`Persona_idPersona`),
  ADD KEY `SUBCATEGORIA_idSUBCATEGORIA` (`SUBCATEGORIA_idSUBCATEGORIA`),
  ADD KEY `SUBCATEGORIA_CATEGORIA_idCATEGORIA` (`SUBCATEGORIA_CATEGORIA_idCATEGORIA`),
  ADD KEY `FK_Persona_ROL_idRol` (`Persona_ROL_idRol`);

--
-- Indices de la tabla `pago`
--
ALTER TABLE `pago`
  ADD PRIMARY KEY (`idPAGO`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`idPEDIDO`),
  ADD KEY `SUCURSALIPS_idSUCURSALIPS` (`SUCURSALIPS_idSUCURSALIPS`),
  ADD KEY `DISTRIBUIDOR_idDISTRIBUIDOR` (`DISTRIBUIDOR_idDISTRIBUIDOR`),
  ADD KEY `PAGO_idPAGO` (`PAGO_idPAGO`),
  ADD KEY `MEDICAMENTO_idMEDICAMENTO` (`MEDICAMENTO_idMEDICAMENTO`),
  ADD KEY `MEDICAMENTO_Persona_idPersona` (`MEDICAMENTO_Persona_idPersona`),
  ADD KEY `MEDICAMENTO_PERSONA_ROL_idRol` (`MEDICAMENTO_PERSONA_ROL_idRol`),
  ADD KEY `MEDICAMENTO_SUBCATEGORIA_idSUBCATEGORIA` (`MEDICAMENTO_SUBCATEGORIA_idSUBCATEGORIA`),
  ADD KEY `MEDICAMENTO_SUBCATEGORIA_CATEGORIA_idCATEGORIA` (`MEDICAMENTO_SUBCATEGORIA_CATEGORIA_idCATEGORIA`),
  ADD KEY `FORMULAMEDICA_idFORMULA` (`FORMULAMEDICA_idFORMULA`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`idPersona`),
  ADD KEY `ROL_idRol` (`ROL_idRol`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`idPROVEEDOR`),
  ADD KEY `SUCURSALIPS_idSUCURSALIPS` (`SUCURSALIPS_idSUCURSALIPS`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idRol`);

--
-- Indices de la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
  ADD PRIMARY KEY (`idSUBCATEGORIA`),
  ADD KEY `CATEGORIA_idCATEGORIA` (`CATEGORIA_idCATEGORIA`);

--
-- Indices de la tabla `sucursalips`
--
ALTER TABLE `sucursalips`
  ADD PRIMARY KEY (`idSUCURSAL`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idCATEGORIA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `devoluciones`
--
ALTER TABLE `devoluciones`
  MODIFY `idDevoluciones` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `distribuidor`
--
ALTER TABLE `distribuidor`
  MODIFY `idDISTRIBUIDOR` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `formulamedica`
--
ALTER TABLE `formulamedica`
  MODIFY `idFORMULA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `medicamento`
--
ALTER TABLE `medicamento`
  MODIFY `idMEDICAMENTO` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `pago`
--
ALTER TABLE `pago`
  MODIFY `idPAGO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `idPEDIDO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `idPersona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `idPROVEEDOR` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idRol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
  MODIFY `idSUBCATEGORIA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `sucursalips`
--
ALTER TABLE `sucursalips`
  MODIFY `idSUCURSAL` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `devoluciones`
--
ALTER TABLE `devoluciones`
  ADD CONSTRAINT `devoluciones_ibfk_1` FOREIGN KEY (`PEDIDO_idPEDIDO`) REFERENCES `pedido` (`idPEDIDO`);

--
-- Filtros para la tabla `medicamento`
--
ALTER TABLE `medicamento`
  ADD CONSTRAINT `FK_MEDICAMENTO_CATEGORIA_idCAT` FOREIGN KEY (`SUBCATEGORIA_CATEGORIA_idCATEGORIA`) REFERENCES `categoria` (`idCATEGORIA`),
  ADD CONSTRAINT `FK_Persona_ROL_idRol` FOREIGN KEY (`Persona_ROL_idRol`) REFERENCES `rol` (`idRol`),
  ADD CONSTRAINT `medicamento_ibfk_1` FOREIGN KEY (`SUBCATEGORIA_idSUBCATEGORIA`) REFERENCES `subcategoria` (`idSUBCATEGORIA`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `medicamento_ibfk_2` FOREIGN KEY (`Persona_idPersona`) REFERENCES `persona` (`idPersona`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `FK_idCATEGORIA_idPEDIDO` FOREIGN KEY (`MEDICAMENTO_SUBCATEGORIA_CATEGORIA_idCATEGORIA`) REFERENCES `categoria` (`idCATEGORIA`),
  ADD CONSTRAINT `FK_idPersona_idPEDIDO` FOREIGN KEY (`MEDICAMENTO_Persona_idPersona`) REFERENCES `persona` (`idPersona`),
  ADD CONSTRAINT `FK_idROL_idPEDIDO` FOREIGN KEY (`MEDICAMENTO_PERSONA_ROL_idRol`) REFERENCES `rol` (`idRol`),
  ADD CONSTRAINT `FK_idSUBCATEGORIA_idPEDIDO` FOREIGN KEY (`MEDICAMENTO_SUBCATEGORIA_idSUBCATEGORIA`) REFERENCES `subcategoria` (`idSUBCATEGORIA`),
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`SUCURSALIPS_idSUCURSALIPS`) REFERENCES `sucursalips` (`idSUCURSAL`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pedido_ibfk_2` FOREIGN KEY (`DISTRIBUIDOR_idDISTRIBUIDOR`) REFERENCES `distribuidor` (`idDISTRIBUIDOR`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pedido_ibfk_3` FOREIGN KEY (`PAGO_idPAGO`) REFERENCES `pago` (`idPAGO`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pedido_ibfk_4` FOREIGN KEY (`MEDICAMENTO_idMEDICAMENTO`) REFERENCES `medicamento` (`idMEDICAMENTO`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pedido_ibfk_5` FOREIGN KEY (`FORMULAMEDICA_idFORMULA`) REFERENCES `formulamedica` (`idFORMULA`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `persona_ibfk_1` FOREIGN KEY (`ROL_idRol`) REFERENCES `rol` (`idRol`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD CONSTRAINT `proveedor_ibfk_1` FOREIGN KEY (`SUCURSALIPS_idSUCURSALIPS`) REFERENCES `sucursalips` (`idSUCURSAL`);

--
-- Filtros para la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
  ADD CONSTRAINT `subcategoria_ibfk_2` FOREIGN KEY (`CATEGORIA_idCATEGORIA`) REFERENCES `categoria` (`idCATEGORIA`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
