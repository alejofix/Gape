-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-01-2016 a las 20:30:23
-- Versión del servidor: 5.6.26
-- Versión de PHP: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gape`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_base_equipo`
--

CREATE TABLE IF NOT EXISTS `tbl_base_equipo` (
  `Id` bigint(20) NOT NULL,
  `Marca` varchar(100) DEFAULT NULL,
  `Modelo` varchar(100) DEFAULT NULL,
  `Estado` varchar(8) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_base_equipo`
--

INSERT INTO `tbl_base_equipo` (`Id`, `Marca`, `Modelo`, `Estado`) VALUES
(1, 'UBEE', 'DVW2110', 'ACTIVO'),
(2, 'UBEE', 'DVW2100', 'ACTIVO'),
(3, 'UBEE', 'DDW2608', 'ACTIVO'),
(4, 'THOMSON', 'DWG849', 'ACTIVO'),
(5, 'THOMSON', 'DCW725', 'ACTIVO'),
(6, 'TECHNICOLOR', 'TC7110.02', 'ACTIVO'),
(7, 'CISCO', 'DPC2425', 'ACTIVO'),
(8, 'CISCO', 'DPC2420', 'ACTIVO'),
(9, 'CISCO', 'DPC2420R2', 'ACTIVO'),
(10, 'MOTOROLA', 'SBG900', 'ACTIVO'),
(11, 'MOTOROLA', 'SBG901', 'ACTIVO'),
(12, 'MOTOROLA', 'SBV5120', 'ACTIVO'),
(13, 'SCIENTIFIC ATLANTA', 'SA1', 'ACTIVO'),
(14, 'SCIENTIFIC ATLANTA', 'SA2', 'ACTIVO'),
(15, 'ARRIS', '501', 'ACTIVO'),
(16, 'ARRIS', '502', 'ACTIVO'),
(17, 'ARRIS', 'TG862A', 'ACTIVO'),
(18, 'CISCO', 'DPC2434-X', 'ACTIVO'),
(19, 'CISCO', 'DPC3925', 'ACTIVO'),
(20, 'MOTOROLA', 'SBG940', 'ACTIVO'),
(21, 'MOTOROLA', 'SVG1202', 'ACTIVO'),
(22, 'TECHNICOLOR', 'TC7300', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_base_firmware`
--

CREATE TABLE IF NOT EXISTS `tbl_base_firmware` (
  `Id` bigint(20) NOT NULL,
  `Marca` varchar(100) DEFAULT NULL,
  `Firmware` varchar(255) DEFAULT NULL,
  `Estado` varchar(8) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_base_firmware`
--

INSERT INTO `tbl_base_firmware` (`Id`, `Marca`, `Firmware`, `Estado`) VALUES
(1, 'UBEE', '6.28.3000', 'ACTIVO'),
(2, 'UBEE', '6.28.2011', 'ACTIVO'),
(3, 'UBEE', '6.28.1020', 'ACTIVO'),
(4, 'UBEE', '5.117.1007', 'ACTIVO'),
(5, 'THOMSON', 'STC0.01.11', 'ACTIVO'),
(6, 'THOMSON', 'ST5A.31.13', 'ACTIVO'),
(7, 'THOMSON', 'STC0.01.07', 'ACTIVO'),
(8, 'TECHNICOLOR', 'STD3.31.02', 'ACTIVO'),
(9, 'TECHNICOLOR', 'STD3.31.11', 'ACTIVO'),
(10, 'CISCO', '111014AS', 'ACTIVO'),
(11, 'CISCO', '120514AS-V6', 'ACTIVO'),
(12, 'CISCO', '130311AS-V6', 'ACTIVO'),
(13, 'CISCO', '120120AS-V6', 'ACTIVO'),
(14, 'MOTOROLA', 'SBG940-2.1.18.0-SCM00-NOSH', 'ACTIVO'),
(15, 'MOTOROLA', 'SBG900-2.1.18.0-SCM00-NOSH', 'ACTIVO'),
(16, 'SCIENTIFIC ATLANTA', 'NO EXISTE', 'ACTIVO'),
(17, 'ARRIS', 'NO EXISTE', 'ACTIVO'),
(18, 'UBEE', '6.28.4002', 'ACTIVO'),
(19, 'UBEE', '6.28.4003', 'ACTIVO'),
(20, 'THOMSON', 'STC0.01.16', 'ACTIVO'),
(21, 'ARRIS', '7.5.125B', 'ACTIVO'),
(22, 'CISCO', '120921AS', 'ACTIVO'),
(23, 'CISCO', '140106AS-V6', 'ACTIVO'),
(24, 'CISCO', '110128AS', 'ACTIVO'),
(25, 'CISCO', '131025A', 'ACTIVO'),
(26, 'MOTOROLA', 'SBG901-2.8.5.0-GA-03-501-NOSH', 'ACTIVO'),
(27, 'MOTOROLA', 'SVG1202-2.12.2.0-GA-05-741-LTSH', 'ACTIVO'),
(28, 'TECHNICOLOR', 'STD3.31.19', 'ACTIVO'),
(29, 'TECHNICOLOR', 'STF3.31.02', 'ACTIVO'),
(30, 'THOMSON', 'ST5A.31.13', 'ACTIVO'),
(31, 'UBEE', '6.36.1005', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_base_general`
--

CREATE TABLE IF NOT EXISTS `tbl_base_general` (
  `Id` bigint(20) NOT NULL,
  `Fecha` date NOT NULL,
  `Hora` time NOT NULL,
  `Asesor` varchar(100) DEFAULT NULL,
  `Usuario` varchar(100) DEFAULT NULL,
  `Tipo_Reporte` varchar(100) DEFAULT NULL,
  `Cuenta` int(10) DEFAULT NULL,
  `MAC` varchar(100) DEFAULT NULL,
  `Marca` varchar(100) DEFAULT NULL,
  `Modelo` varchar(100) DEFAULT NULL,
  `Firmware` varchar(100) DEFAULT NULL,
  `Sintoma` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `Observaciones` text CHARACTER SET latin1 COLLATE latin1_general_ci,
  `Seguimiento` varchar(11) DEFAULT NULL,
  `Softswitch` varchar(50) DEFAULT NULL,
  `Nodo` varchar(8) DEFAULT NULL,
  `Paquete` varchar(100) DEFAULT NULL,
  `Aviso` bigint(20) DEFAULT '0',
  `CMTS` varchar(100) DEFAULT NULL COMMENT 'CMTS',
  `IIMS_Paso` int(2) NOT NULL DEFAULT '0' COMMENT 'Numero de Paso de IIMS'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_base_paquete_tv`
--

CREATE TABLE IF NOT EXISTS `tbl_base_paquete_tv` (
  `Id` bigint(20) NOT NULL,
  `Paquete` varchar(255) NOT NULL,
  `Modelo` varchar(100) NOT NULL,
  `Estado` varchar(8) NOT NULL DEFAULT 'inactivo' COMMENT 'Estado'
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_base_paquete_tv`
--

INSERT INTO `tbl_base_paquete_tv` (`Id`, `Paquete`, `Modelo`, `Estado`) VALUES
(1, 'TV BASICA', 'NO EXISTE', 'ACTIVO'),
(2, 'HD', 'NO EXISTE', 'ACTIVO'),
(3, 'HBO', 'NO EXISTE', 'ACTIVO'),
(4, 'MOVIE CITY', 'NO EXISTE', 'ACTIVO'),
(5, 'TV DIGITAL AVANZADA', 'DBV CSH', 'ACTIVO'),
(6, 'TV DIGITAL AVANZADA', 'DBV WHI', 'ACTIVO'),
(7, 'TV DIGITAL AVANZADA', 'DBV SKY', 'ACTIVO'),
(8, 'TV DIGITAL AVANZADA', 'HBV CHD', 'ACTIVO'),
(9, 'TV DIGITAL AVANZADA', 'NO EXISTE', 'ACTIVO'),
(10, 'TV DIGITAL BASICA', 'DBV CSH', 'ACTIVO'),
(11, 'TV DIGITAL BASICA', 'DBV WHI', 'ACTIVO'),
(12, 'TV DIGITAL BASICA', 'DBV SKY', 'ACTIVO'),
(13, 'TV DIGITAL BASICA', 'HBV CHD', 'ACTIVO'),
(14, 'TV DIGITAL BASICA', 'NO EXISTE', 'ACTIVO'),
(15, 'TV AVANZADA', 'DDG DC7', 'ACTIVO'),
(16, 'TV AVANZADA', 'DDG DCI', 'ACTIVO'),
(17, 'TV AVANZADA', 'DDG DX4', 'ACTIVO'),
(18, 'TV AVANZADA', 'DDG DX7', 'ACTIVO'),
(19, 'TV AVANZADA', 'DDG DX2', 'ACTIVO'),
(20, 'TV AVANZADA', 'DDG DCX', 'ACTIVO'),
(21, 'TV AVANZADA', 'NO EXISTE', 'ACTIVO'),
(22, 'DTH', 'GENERAL', 'ACTIVO'),
(23, 'DTH_ARION', 'ARI', 'ACTIVO'),
(24, 'DTH_ARION', 'AF-5012S', 'ACTIVO'),
(25, 'DTH_ARION', 'AF-5210VHD', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_base_sintoma`
--

CREATE TABLE IF NOT EXISTS `tbl_base_sintoma` (
  `Id` bigint(20) NOT NULL,
  `Tipo_Reporte` varchar(100) DEFAULT NULL,
  `Sintoma` varchar(255) DEFAULT NULL,
  `Estado` varchar(8) DEFAULT NULL,
  `Fecha` date NOT NULL COMMENT 'Fecha',
  `Hora` time NOT NULL COMMENT 'Hora'
) ENGINE=InnoDB AUTO_INCREMENT=159 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_base_sintoma`
--

INSERT INTO `tbl_base_sintoma` (`Id`, `Tipo_Reporte`, `Sintoma`, `Estado`, `Fecha`, `Hora`) VALUES
(1, 'Internet', 'NO NAVEGA', 'ACTIVO', '0000-00-00', '00:00:00'),
(2, 'Internet', 'SIN IP EN LA WAN', 'ACTIVO', '0000-00-00', '00:00:00'),
(3, 'Internet', 'NO PERMITE CLAVE WEP', 'ACTIVO', '0000-00-00', '00:00:00'),
(4, 'Internet', 'POTENCIA GANANCIA', 'ACTIVO', '0000-00-00', '00:00:00'),
(5, 'Internet', 'LEASES TIME', 'ACTIVO', '0000-00-00', '00:00:00'),
(6, 'Internet', 'ACCESOS LAN', 'ACTIVO', '0000-00-00', '00:00:00'),
(7, 'Internet', 'CISCO SE REINICIA AL INGRESAR LLAMADA', 'ACTIVO', '0000-00-00', '00:00:00'),
(8, 'Internet', 'NECESARIO REINICIAR MODEM PARA NAVEGAR', 'ACTIVO', '0000-00-00', '00:00:00'),
(9, 'Internet', 'FALLAS CON LOS DNS', 'ACTIVO', '0000-00-00', '00:00:00'),
(10, 'Internet', 'MODEMS CON FIREWALL ACTIVOS', 'ACTIVO', '0000-00-00', '00:00:00'),
(11, 'Internet', 'CONGELAMIENTO DE IMAGEN EN YOUTUBE', 'ACTIVO', '0000-00-00', '00:00:00'),
(12, 'Internet', 'NO TOMA IP EN LA WAN', 'ACTIVO', '0000-00-00', '00:00:00'),
(13, 'Internet', 'LENTITUD', 'ACTIVO', '0000-00-00', '00:00:00'),
(14, 'Internet', 'FALLA DNS TODO BIEN Y NO NAVEGA POR WLAN', 'INACTIVO', '0000-00-00', '00:00:00'),
(15, 'Internet', 'NO INGRESA AL ADMIN', 'ACTIVO', '0000-00-00', '00:00:00'),
(16, 'Internet', 'LENTITUD NO PERMITE INGRESAR EL DOMINIO', 'ACTIVO', '0000-00-00', '00:00:00'),
(17, 'Internet', 'NO APARECE LA RED WIFI', 'ACTIVO', '0000-00-00', '00:00:00'),
(18, 'Internet', 'CISCO SE REINICIA CUANDO CONECTA A WIFI', 'ACTIVO', '0000-00-00', '00:00:00'),
(19, 'Internet', 'NO APARECE OPCION WIFI EN ADMIN', 'ACTIVO', '0000-00-00', '00:00:00'),
(20, 'Internet', 'POR WLAN TODO BIEN Y NO NAVEGA', 'ACTIVO', '0000-00-00', '00:00:00'),
(21, 'Internet', 'SISTEMA OPERATIVO NO PUEDE CONECTARSE A WLAN', 'INACTIVO', '0000-00-00', '00:00:00'),
(22, 'Internet', 'NAVEGA SIN CLAVE WIFI', 'ACTIVO', '0000-00-00', '00:00:00'),
(23, 'Internet', 'DNS FIJOS SOBRE EL MODEM NO NAVEGA', 'ACTIVO', '0000-00-00', '00:00:00'),
(24, 'Internet', 'NAVEGA Y SE REINCIA MODEM UBEE', 'INACTIVO', '0000-00-00', '00:00:00'),
(25, 'Internet', 'CISCO SIN 20 ACCESOS', 'ACTIVO', '0000-00-00', '00:00:00'),
(26, 'Internet', 'MODEM PIERDE CONFIGURACION', 'ACTIVO', '0000-00-00', '00:00:00'),
(27, 'Internet', 'SISTEMA OPERATIVO NO PUEDE CONECTARSE A LAN', 'INACTIVO', '0000-00-00', '00:00:00'),
(28, 'Internet', 'LENTITUD DE APROVISIONAMIENTO', 'ACTIVO', '0000-00-00', '00:00:00'),
(29, 'Telefonia', 'ERROR INTEGRITY', 'ACTIVO', '0000-00-00', '00:00:00'),
(30, 'Telefonia', 'SOFTPHONE SIN FUNCIONALIDADES', 'ACTIVO', '0000-00-00', '00:00:00'),
(31, 'Telefonia', 'APROVISIONAMIENTO', 'ACTIVO', '0000-00-00', '00:00:00'),
(32, 'Telefonia', 'DEXON', 'ACTIVO', '0000-00-00', '00:00:00'),
(33, 'Telefonia', 'CIRCUITOS OCUPADOS', 'ACTIVO', '0000-00-00', '00:00:00'),
(34, 'Telefonia', 'DEXON POR DUPLICIDAD', 'ACTIVO', '0000-00-00', '00:00:00'),
(35, 'Telefonia', 'NO DIRECCIONA A VOICE MAIL', 'ACTIVO', '0000-00-00', '00:00:00'),
(36, 'Telefonia', 'FALLA CARGAR CONFIGURACION DESDE EL SERVIDOR', 'ACTIVO', '0000-00-00', '00:00:00'),
(37, 'Telefonia', 'ERROR 403', 'ACTIVO', '0000-00-00', '00:00:00'),
(38, 'Telefonia', 'FALLA EN SALIDA DE LLAMADAS', 'ACTIVO', '0000-00-00', '00:00:00'),
(39, 'Telefonia', 'OTRO ERROR', 'ACTIVO', '0000-00-00', '00:00:00'),
(40, 'Television', 'PROBLEMAS DE RETORNO RED ATSC', 'ACTIVO', '0000-00-00', '00:00:00'),
(41, 'Television', 'CANAL V+TV SENAL/AUDIO INTERMITENTE', 'ACTIVO', '0000-00-00', '00:00:00'),
(42, 'Television', 'ADAPTADORES CORRIENTE CON VARIACION VOLTAJE', 'ACTIVO', '0000-00-00', '00:00:00'),
(43, 'Television', 'DVB HD ERROR DPG', 'ACTIVO', '0000-00-00', '00:00:00'),
(44, 'Television', 'GUIA NO CONCUERDA', 'ACTIVO', '0000-00-00', '00:00:00'),
(45, 'Television', 'NO APARECEN ALGUNOS CANALES', 'ACTIVO', '0000-00-00', '00:00:00'),
(46, 'Television', 'DECO SE QUEDA CARGANDO', 'ACTIVO', '0000-00-00', '00:00:00'),
(47, 'Television', 'DECO CON RUIDO', 'ACTIVO', '0000-00-00', '00:00:00'),
(48, 'Television', 'OTRO ERROR', 'ACTIVO', '0000-00-00', '00:00:00'),
(50, 'Miclaro', 'ERROR 500', 'ACTIVO', '0000-00-00', '00:00:00'),
(51, 'Miclaro', 'DESCARGA DE MCAFEE', 'ACTIVO', '0000-00-00', '00:00:00'),
(52, 'Miclaro', 'DESCARGA TELEFONO VIRTUAL', 'ACTIVO', '0000-00-00', '00:00:00'),
(53, 'Miclaro', 'REGISTRO DE MI CLARO', 'ACTIVO', '0000-00-00', '00:00:00'),
(54, 'Miclaro', 'REGISTRO DE CLARO VIDEO', 'ACTIVO', '0000-00-00', '00:00:00'),
(55, 'Miclaro', 'SOLO SE VE LA SINOPSIS DE LA PELICULA', 'ACTIVO', '0000-00-00', '00:00:00'),
(56, 'Miclaro', 'NO CARGA LA OPCION DE SERVICIOS', 'ACTIVO', '0000-00-00', '00:00:00'),
(57, 'Miclaro', 'CONSULTAR BUZON VIRTUAL', 'ACTIVO', '0000-00-00', '00:00:00'),
(58, 'Miclaro', 'ELIMINAR REGISTRO DE MI CLARO', 'ACTIVO', '0000-00-00', '00:00:00'),
(59, 'Miclaro', 'ELIMINAR REGISTRO DE CLARO VIDEO', 'ACTIVO', '0000-00-00', '00:00:00'),
(60, 'Miclaro', 'NO CARGA PAGINA DE CLARO', 'ACTIVO', '0000-00-00', '00:00:00'),
(61, 'Miclaro', 'OTRO ERROR', 'ACTIVO', '0000-00-00', '00:00:00'),
(63, 'Masivos', 'INTERNET', 'INACTIVO', '0000-00-00', '00:00:00'),
(64, 'Masivos', 'TELEFONIA', 'INACTIVO', '0000-00-00', '00:00:00'),
(65, 'Masivos', 'TELEVISION', 'INACTIVO', '0000-00-00', '00:00:00'),
(66, 'Masivos', 'INTERNET Y TELEFONIA', 'INACTIVO', '0000-00-00', '00:00:00'),
(67, 'Masivos', 'INTERNET Y TELEVISION', 'INACTIVO', '0000-00-00', '00:00:00'),
(68, 'Masivos', 'TELEFONIA Y TELEVISION', 'INACTIVO', '0000-00-00', '00:00:00'),
(69, 'Lls', 'SIN SENAL', 'ACTIVO', '0000-00-00', '00:00:00'),
(70, 'Lls', 'INTERMITENCIA', 'ACTIVO', '0000-00-00', '00:00:00'),
(71, 'Lls', 'POTENCIA GANANCIA', 'ACTIVO', '0000-00-00', '00:00:00'),
(72, 'Lls', 'MODEM NO ENCIENDE', 'ACTIVO', '0000-00-00', '00:00:00'),
(73, 'Lls', 'NO LE APARECE LA WLAN', 'ACTIVO', '0000-00-00', '00:00:00'),
(74, 'Lls', 'NO APARECE OPCION WIFI EN ADMIN', 'ACTIVO', '0000-00-00', '00:00:00'),
(75, 'Lls', 'WINDOWS NO PUEDE CONECTARSE A LAN', 'ACTIVO', '0000-00-00', '00:00:00'),
(76, 'Lls', 'FALLA DERIVACION', 'ACTIVO', '0000-00-00', '00:00:00'),
(77, 'Lls', 'DECOS PVR CON MAL OLOR', 'ACTIVO', '0000-00-00', '00:00:00'),
(78, 'Lls', 'PROBLEMAS DE RETORNO RED ATSC', 'ACTIVO', '0000-00-00', '00:00:00'),
(79, 'Lls', 'NO LE APARECEN ALGUNOS CANALES', 'ACTIVO', '0000-00-00', '00:00:00'),
(80, 'Lls', 'DECO NO ENCIENDE', 'ACTIVO', '0000-00-00', '00:00:00'),
(81, 'Lls', 'DECO SE QUEDA CARGANDO', 'ACTIVO', '0000-00-00', '00:00:00'),
(82, 'Lls', 'DECO CON RUIDO', 'ACTIVO', '0000-00-00', '00:00:00'),
(83, 'Lls', 'OTRO ERROR', 'ACTIVO', '0000-00-00', '00:00:00'),
(84, 'Telefonia', 'SOPORTE/ DERIVACIONES  CONEXIONES', 'ACTIVO', '0000-00-00', '00:00:00'),
(85, 'Telefonia', 'SOPORTE/ FUNCIONALIDADES', 'ACTIVO', '0000-00-00', '00:00:00'),
(86, 'Television', 'SOPORTE/ CONEXIONES', 'ACTIVO', '0000-00-00', '00:00:00'),
(87, 'Television', 'SOPORTE/ CONTROL', 'ACTIVO', '0000-00-00', '00:00:00'),
(88, 'Television', 'SOPORTE/ DECODIFICADOR TARJETA', 'ACTIVO', '0000-00-00', '00:00:00'),
(89, 'Internet', 'SOPORTE/ BASICO', 'ACTIVO', '0000-00-00', '00:00:00'),
(90, 'Internet', 'SOPORTE/ SOBRE IP FIJA', 'INACTIVO', '0000-00-00', '00:00:00'),
(91, 'Internet', 'SOPORTE/ AVANZADO APERTURA PUERTOS', 'ACTIVO', '0000-00-00', '00:00:00'),
(92, 'Internet', 'SOPORTE/ AVANZADO OTROS EQUIPOS', 'ACTIVO', '0000-00-00', '00:00:00'),
(93, 'TipoAviso', 'MATRIZ', 'ACTIVO', '0000-00-00', '00:00:00'),
(94, 'TipoAviso', 'TELEVISION', 'ACTIVO', '0000-00-00', '00:00:00'),
(95, 'TipoAviso', 'INTERNET', 'ACTIVO', '0000-00-00', '00:00:00'),
(96, 'TipoAviso', 'TELEFONIA', 'ACTIVO', '0000-00-00', '00:00:00'),
(97, 'TipoAviso', 'CORREO', 'ACTIVO', '0000-00-00', '00:00:00'),
(98, 'TipoAviso', 'DECOS', 'ACTIVO', '0000-00-00', '00:00:00'),
(106, 'Lls', 'GARANTIAS', 'ACTIVO', '0000-00-00', '00:00:00'),
(107, 'Lls', 'VERIFICACION ACOMETIDA', 'ACTIVO', '0000-00-00', '00:00:00'),
(108, 'Lls', 'EQUIPOS DANADOS', 'ACTIVO', '0000-00-00', '00:00:00'),
(109, 'Lls', 'ALCANZABILIDAD WIFI', 'ACTIVO', '0000-00-00', '00:00:00'),
(110, 'Lls', 'VERIFICIACION INVENTARIO', 'ACTIVO', '0000-00-00', '00:00:00'),
(111, 'Lls', 'SOLICITUD CLIENTE', 'ACTIVO', '0000-00-00', '00:00:00'),
(112, 'Lls', 'NIVELES DESFASADOS', 'ACTIVO', '0000-00-00', '00:00:00'),
(113, 'Lls_sa', 'TRIPLE PLAY', 'ACTIVO', '0000-00-00', '00:00:00'),
(114, 'Lls_sa', 'TELEVISION', 'ACTIVO', '0000-00-00', '00:00:00'),
(115, 'Lls_sa', 'TELEFONIA', 'ACTIVO', '0000-00-00', '00:00:00'),
(116, 'Lls_sa', 'INTERNET Y TELEFONIA', 'ACTIVO', '0000-00-00', '00:00:00'),
(117, 'Lls_sa', 'INTERNET Y TELEVISION', 'ACTIVO', '0000-00-00', '00:00:00'),
(118, 'Lls_sa', 'TELEFONIA Y TELEVISION', 'ACTIVO', '0000-00-00', '00:00:00'),
(119, 'Lls_sa', 'INTERNET', 'ACTIVO', '0000-00-00', '00:00:00'),
(121, 'Iims', 'LENTITUD EN INTERNET', 'ACTIVO', '0000-00-00', '00:00:00'),
(122, 'Iims', 'CONFIRMACION DE CLAVE WIFI', 'ACTIVO', '0000-00-00', '00:00:00'),
(123, 'Iims', 'INTERNET Y TELEFONIA', 'ACTIVO', '0000-00-00', '00:00:00'),
(124, 'Iims', 'CORREO', 'ACTIVO', '0000-00-00', '00:00:00'),
(125, 'Iims', 'TELEVISION', 'ACTIVO', '0000-00-00', '00:00:00'),
(126, 'Iims', 'VISITAS', 'ACTIVO', '0000-00-00', '00:00:00'),
(127, 'Iims', 'MI CLARO', 'ACTIVO', '0000-00-00', '00:00:00'),
(128, 'Iims', 'TELEFONIA', 'ACTIVO', '0000-00-00', '00:00:00'),
(129, 'Masivos', 'TRIPLEPLAY', 'INACTIVO', '0000-00-00', '00:00:00'),
(130, 'TipoAviso', 'TRIPLEPLAY', 'ACTIVO', '0000-00-00', '00:00:00'),
(131, 'Internet', 'WINDOWS NO SE PUEDE CONECTAR A LA RED', 'ACTIVO', '0000-00-00', '00:00:00'),
(134, 'MASIVOS', 'A1 PRUEBA NO SELECCIONAR', 'INACTIVO', '2013-09-29', '18:00:12'),
(135, 'LLS_SA', 'A1 PRUEBA NO SELECCIONAR', 'INACTIVO', '2013-09-29', '18:00:35'),
(136, 'MASIVOS', 'MATRIZ', 'ACTIVO', '2013-09-29', '18:02:20'),
(137, 'MASIVOS', 'TELEVISION', 'ACTIVO', '2013-09-29', '18:02:31'),
(138, 'MASIVOS', 'INTERNET', 'ACTIVO', '2013-09-29', '18:02:37'),
(139, 'MASIVOS', 'TELEFONIA', 'ACTIVO', '2013-09-29', '18:02:43'),
(140, 'MASIVOS', 'CORREO', 'ACTIVO', '2013-09-29', '18:02:48'),
(141, 'MASIVOS', 'DECOS', 'ACTIVO', '2013-09-29', '18:02:53'),
(142, 'MASIVOS', 'TRIPLEPLAY', 'ACTIVO', '2013-09-29', '18:03:01'),
(143, 'TELEVISION', 'DECO NO ENCIENDE', 'ACTIVO', '2013-09-30', '21:47:32'),
(144, 'INTERNET', 'MODEM NO ENCIENDE', 'ACTIVO', '2013-09-30', '21:47:49'),
(145, 'INTERNET', 'CAMBIO DE RANGO DE IP NAVEGA', 'ACTIVO', '2013-09-30', '21:51:07'),
(146, 'LLS', 'MODEM DESENGANCHADO', 'ACTIVO', '2013-10-04', '17:40:35'),
(147, 'LLS', 'SIN TONO', 'ACTIVO', '2013-10-04', '18:56:40'),
(148, 'LLS', 'CALIDAD DE VOZ', 'ACTIVO', '2013-10-04', '18:56:51'),
(149, 'LLS', 'FALLA EN EL PUERTO', 'ACTIVO', '2013-10-04', '18:57:08'),
(150, 'LLS', 'VERIFICACION DERIVACION', 'ACTIVO', '2013-10-04', '18:57:19'),
(151, 'LLS', 'MODEM SE REINICIA CON REINICIO DE LLAMADAS', 'INACTIVO', '2013-10-04', '18:57:38'),
(152, 'LLS', 'MODEM SE REINICIA CON INGRESO DE LLAMADAS', 'ACTIVO', '2013-10-04', '19:16:36'),
(153, 'INTERNET', 'SIN IP EN LA WAN', 'INACTIVO', '2013-10-04', '19:52:10'),
(154, 'INTERNET', 'IP 5.X.X.X', 'ACTIVO', '2013-10-05', '09:24:42'),
(155, 'INTERNET', 'INTERMITENCIA EN LA RED WIFI', 'ACTIVO', '2013-10-05', '21:07:32'),
(156, 'TELEVISION', 'SIN ALGUNOS CANALES', 'ACTIVO', '2013-10-07', '12:05:56'),
(157, 'CORREO', 'FALLA WEBMAIL', 'ACTIVO', '2015-02-11', '18:52:23'),
(158, 'CORREO', 'FALLA CLIENTE DE CORREO', 'ACTIVO', '2015-07-07', '18:07:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_base_softswitch`
--

CREATE TABLE IF NOT EXISTS `tbl_base_softswitch` (
  `Id` bigint(20) NOT NULL,
  `Nombre` varchar(255) DEFAULT NULL,
  `Estado` varchar(8) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_base_softswitch`
--

INSERT INTO `tbl_base_softswitch` (`Id`, `Nombre`, `Estado`) VALUES
(1, 'SAFARI	BOG03', 'ACTIVO'),
(2, 'SAFARI	BOG05', 'ACTIVO'),
(3, 'SAFARI	BOG06', 'ACTIVO'),
(4, 'SAFARI	BQA01', 'ACTIVO'),
(5, 'SAFARI	BUC01', 'ACTIVO'),
(6, 'SAFARI	CAL01', 'ACTIVO'),
(7, 'SAFARI	MED01', 'ACTIVO'),
(8, 'SAFARI	PER01', 'ACTIVO'),
(9, 'SAFARI	TANDEM', 'ACTIVO'),
(10, 'IMS	BOG07', 'ACTIVO'),
(11, 'HIQ	TRIARA', 'ACTIVO'),
(12, 'HIQ	ORTEZAL', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_gestion_asesores`
--

CREATE TABLE IF NOT EXISTS `tbl_gestion_asesores` (
  `Id` bigint(20) NOT NULL,
  `Usuario` varchar(100) DEFAULT NULL,
  `Nombres` varchar(100) DEFAULT NULL,
  `Apellidos` varchar(100) DEFAULT NULL,
  `Cedula` varchar(50) DEFAULT NULL,
  `Estado` varchar(8) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_gestion_asesores`
--

INSERT INTO `tbl_gestion_asesores` (`Id`, `Usuario`, `Nombres`, `Apellidos`, `Cedula`, `Estado`) VALUES
(1, 'Nuevo', 'Usuario', 'Nuevo', '123456789', 'ACTIVO'),
(2, 'EKZ2381A', 'GERSON IVAN', 'PRIETO ORTEGA', '1012362381', 'ACTIVO'),
(3, 'EKZ1146A', 'SANDRA MARCELA', 'AVENDAÑO CASTELLANOS', '53031146', 'ACTIVO'),
(4, 'EKZ0342B', 'LEIDY BIBIANA', 'CASTRO SALGADO', '1014210342', 'ACTIVO'),
(5, 'EKZ5324A', 'NORMA CONSTANZA', 'GUTIERREZ TURRIAGO', '1022945324', 'ACTIVO'),
(6, 'EKZ0162A', 'JAIRO ALONSO', 'PINZON DELGADO', '1077860162', 'ACTIVO'),
(7, 'EKZ1074B', 'YESSIKA CONSTANZA', 'MACHADO ROBAYO', '1069731074', 'ACTIVO'),
(8, 'EKZ9337A', 'LINA PAOLA', 'RODRIGUEZ VIDALES', '1030639337', 'ACTIVO'),
(9, 'EKZ3423A', 'CAMILO ANDRÉS', 'CERQUERA SALINAS', '1018443423', 'ACTIVO'),
(10, 'EKZ8610B', 'NATALIA TORRES', 'TIQUE', '1104708610', 'ACTIVO'),
(11, 'EKZ0314A', 'JESSICA LORENA', 'NIETO RIAÑO', '1030670314', 'ACTIVO'),
(12, 'EKZ3949A', 'ANGIE VANESA', 'MOLINA MONTAÑA', '1012433949', 'ACTIVO'),
(13, 'EKZ8075A', 'MANUELA VANESSA', 'ARIAS MUNEVAR', '97080608075', 'ACTIVO'),
(14, 'EKZ4869A', 'YURANI DAMIRA', 'TORRES RODRIGUEZ', '1033794869', 'ACTIVO'),
(15, 'EKZ5149A', 'SARAY ALEJANDRA', 'SANDINO ABRIL', '1033795149', 'ACTIVO'),
(16, 'EKZ1339A', 'ISIS MARIANA', 'CUBILLOS MONROY', '97061311339', 'ACTIVO'),
(17, 'EKZ3776A', 'DEINA JINNETH', 'SANCHEZ GRASS', '1014283776', 'ACTIVO'),
(18, 'EKZ4636A', 'YERALDIN QUIROGA', 'ROJAS', '1026584636', 'ACTIVO'),
(19, 'EKZ5771A', 'DIANA CAROLINA', 'RODRIGUEZ ZAMBRANO', '1073505771', 'ACTIVO'),
(20, 'EKZ4438A', 'LINDA MARYSOL', 'REINA GAITAN', '1015414438', 'ACTIVO'),
(21, 'EKZ2025A', 'JUAN CAMILO', 'MORALES SEGURA', '1033782025', 'ACTIVO'),
(22, 'EKZ1643A', 'JOHANN SEBASTIAN', 'CRUZ RENTERIA', '1015441643', 'ACTIVO'),
(23, 'EKZ3731A', 'LEONEL DAVID', 'ESGUERRA NEUTA', '1024563731', 'ACTIVO'),
(24, 'EKZ9087A', 'MATEO FELIPE', 'GARCIA MONTENEGRO', '1014259087', 'ACTIVO'),
(25, 'EKZ9836A', 'JOHANNA LOPEZ', 'VALBUENA', '1016019836', 'ACTIVO'),
(26, 'EKZ8740A', 'RAFAEL GREGORIO', 'DIAZ BUITRAGO', '1019048740', 'ACTIVO'),
(27, 'EKZ1707A', 'BRYAN JESUS', 'CUBILLOS BARRERA', '1015421707', 'ACTIVO'),
(28, 'EKZ9141A', 'JESSICA LISETH', 'NIETO RUEDA', '1013659141', 'ACTIVO'),
(29, 'EKZ2168A', 'YHOTSWHA JHEDERITH', 'QUITIAN DIAZ', '1005342168', 'ACTIVO'),
(30, 'EKZ7006A', 'KAREN YERALDIN', 'VELASQUEZ AVILA', '1022407006', 'ACTIVO'),
(31, 'EKZ6936A', 'HAROL MAURICIO', 'SOLER CARDONA', '1104706936', 'ACTIVO'),
(32, 'EKZ1529A', 'JOSEPH HUMPHREY', 'VELASQUEZ JIMENEZ', '1026281529', 'ACTIVO'),
(33, 'EKZ2860A', 'EDWIN ALEJANDRO', 'CASTILLO RODRIGUEZ', '1013622860', 'ACTIVO'),
(34, 'EKZ6121A', 'JEFERSON ANDREY', 'ROMERO GUAJE', '1023916121', 'ACTIVO'),
(35, 'EKZ9380A', 'JUAN CAMILO', 'SUAREZ MARTINEZ', '1032479380', 'ACTIVO'),
(36, 'EKZ9914A', 'FRANCISCO ANDRES', 'TORRES RIOS', '1022339914', 'ACTIVO'),
(37, 'EKZ5806A', 'KEVIN ANDRES', 'MARTINEZ RAMOS', '1032475806', 'ACTIVO'),
(38, 'EKZ8793A', 'CARLO ANDRES', 'BALDION GONZALEZ', '80178793', 'ACTIVO'),
(39, 'EKZ4309A', 'ANGEL ENRIQUE', 'BARRAGAN VARGAS', '1069584309', 'ACTIVO'),
(40, 'EKZ3564A', 'JESUS ALBERTO', 'CORREA VERNAZA', '1090443564', 'ACTIVO'),
(41, 'EKZ4900A', 'ESNEYDER LIBARDO', 'VELASCO QUILINDO', '1081414900', 'ACTIVO'),
(42, 'EKZ8399A', 'JUAN CARLOS', 'DIAZ BOBADILLA', '1072618399', 'ACTIVO'),
(43, 'EKZ8949A', 'MARIA FERNANDA', 'MONTAÑA DUARTE', '1057598949', 'ACTIVO'),
(44, 'EKZ3549A', 'GEIMN ALBERTO', 'PALACIOS MURILLO', '82363549', 'ACTIVO'),
(45, 'EKZ6831A', 'ANGIE ROSANA', 'ORTIZ QUINAYAS', '53116831', 'ACTIVO'),
(46, 'EKZ9430A', 'JULIAN ALEJANDRO', 'ORTIZ MEDINA', '1032439430', 'ACTIVO'),
(47, 'EKZ2031A', 'JUAN DAVID', 'TURGA SUAREZ', '1024572031', 'ACTIVO'),
(48, 'EKZ7583A', 'JAIME', 'MOLINA', '80747583', 'ACTIVO'),
(49, 'EKZ0586A', 'SERGIO ANDRES', 'MARTINEZ DIAZ', '1010230586', 'ACTIVO'),
(50, 'EKZ4119A', 'BRANDON MANUEL', 'VANEGAS PINEDA', '1023014119', 'ACTIVO'),
(51, 'EKZ1795A', 'JOSE CLEMENTE', 'LARA ACOSTA', '1073151795', 'ACTIVO'),
(52, 'EKZ1367A', 'HECTOR GIOVANNY', 'CAMACHO GUEVARA', '80181367', 'ACTIVO'),
(53, 'EKZ6433A', 'JHON EDISSON', 'RAMÍREZ GARCÍA', '1071986433', 'ACTIVO'),
(54, 'EKZ7267A', 'ALFONSO NARVAEZ', 'RADA', '1022367267', 'ACTIVO'),
(55, 'EKZ9211A', 'ANDRES CAMILO', 'CHAPARRO RODRIGUEZ', '1015419211', 'ACTIVO'),
(56, 'EKZ5629A', 'CARLOS FELIPE', 'ACEVEDO MONTIEL', '1020785629', 'ACTIVO'),
(57, 'EKZ9367A', 'CESAR AUGUSTO', 'SALAZAR BARBOSA', '80829367', 'ACTIVO'),
(58, 'EKZ5841A', 'JINETH KATHERIN', 'CORTEZ AREVALO', '1033765841', 'ACTIVO'),
(59, 'EKZ9750A', 'JHONATAN STIVEN', 'SALAZAR AGUDELO', '1030619750', 'ACTIVO'),
(60, 'EKZ8569A', 'OSCAR ORLANDO', 'LEON ALVARDO', '1013588569', 'ACTIVO'),
(61, 'EKZ1090A', 'JEISSON DAVID', 'CASTIBLANCO MOLANO', '1023901090', 'ACTIVO'),
(62, 'EKZ9657A', 'JORGE ANDRES', 'CUEVAS GUTIERREZ', '1052389657', 'ACTIVO'),
(63, 'EKZ7579A', 'DIANA MARCELA', 'SANCHEZ LUIS', '1015437579', 'ACTIVO'),
(64, 'EKZ6171A', 'MARYI KATERINE', 'ORTEGA FLORIAN', '1030546171', 'ACTIVO'),
(65, 'EKZ5421A', 'ANGIE LORENA', 'VALDERRAMA PEREZ', '1026285421', 'ACTIVO'),
(66, 'EKZ6756A', 'ADRIANA MILENA', 'MERA CABRERA', '52216756', 'ACTIVO'),
(67, 'EKZ4053A', 'JUAN SEBASTIAN', 'CORTES PUENTES', '1016084053', 'ACTIVO'),
(68, 'EKZ7261A', 'DAVID FELIPE', 'CASALLAS MENDEZ', '1014237261', 'ACTIVO'),
(69, 'EKZ6853A', 'OMAR ALEXIS', 'ENCISO SALINAS', '1072466853', 'ACTIVO'),
(70, 'EKZ3585A', 'CARLOS MARIO', 'JAMAICA BARBUDO', '1022373585', 'ACTIVO'),
(71, 'EKZ9760A', 'EDWARD CAMILO', 'JUYO MORALES', '1018469760', 'ACTIVO'),
(72, 'EKZ4697A', 'JOSE FERNANDO', 'GRANADA LARROTA', '1013624697', 'ACTIVO'),
(73, 'EKZ1588A', 'DANIEL FERNANDO', 'GUTIERREZ VARGAS', '1023941588', 'ACTIVO'),
(74, 'EKZ0561A', 'NIDIA CONSTANZA', 'PUENTES', '39750561', 'ACTIVO'),
(75, 'EKZ6231A', 'HECTOR FABIAN', 'MANJARREZ VARGAS', '1010176231', 'ACTIVO'),
(76, 'EKZ5374A', 'MIRYAM BELTRAN', 'ZARATE', '1071165374', 'ACTIVO'),
(77, 'EKZ3312A', 'HIMELDA RAMIREZ', 'MASMELA', '1056553312', 'ACTIVO'),
(78, 'EKZ6373A', 'CRISTIAN JULIAN', 'GUERRERO MARTINEZ', '1032416373', 'ACTIVO'),
(79, 'EKZ6994A', 'RUTH NELLY', 'MONROY CASTRO', '52106994', 'ACTIVO'),
(80, 'EKZ3203A', 'WILSON ANDRES', 'RODRUIGUEZ', '1073233203', 'ACTIVO'),
(81, 'EKZ9899A', 'CRISTHIAN CAMILO', 'CAÑON RAMOS', '1073699899', 'ACTIVO'),
(82, 'EKZ8587A', 'DAVID SEBASTIAN', 'CORREA MERA', '1016068587', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_gestion_asesor_asignado`
--

CREATE TABLE IF NOT EXISTS `tbl_gestion_asesor_asignado` (
  `Id` bigint(20) NOT NULL,
  `Asesor` varchar(100) NOT NULL,
  `Usuario` varchar(100) NOT NULL,
  `Estado` varchar(8) DEFAULT 'INACTIVO',
  `Ubicacion` varchar(100) NOT NULL DEFAULT 'HALL' COMMENT 'Ubicación Usuario'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_gestion_asesor_asignado`
--

INSERT INTO `tbl_gestion_asesor_asignado` (`Id`, `Asesor`, `Usuario`, `Estado`, `Ubicacion`) VALUES
(1, 'Nuevo', 'fix', 'INACTIVO', 'HALL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_gestion_seguimiento`
--

CREATE TABLE IF NOT EXISTS `tbl_gestion_seguimiento` (
  `Id` bigint(20) NOT NULL,
  `Fecha_Inicio` datetime NOT NULL,
  `Fecha_Fin` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Registro` bigint(20) DEFAULT NULL,
  `Observaciones` text,
  `Usuario` varchar(100) NOT NULL COMMENT 'Usuario',
  `TipoReporte` varchar(50) NOT NULL COMMENT 'Tipo de Reporte',
  `Estado` varchar(8) NOT NULL DEFAULT 'INACTIVO' COMMENT 'Estado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_gestion_seguimiento_notas`
--

CREATE TABLE IF NOT EXISTS `tbl_gestion_seguimiento_notas` (
  `Id` bigint(20) NOT NULL COMMENT 'Id de Registro',
  `Registro` bigint(20) NOT NULL COMMENT 'Registro',
  `Notas` text NOT NULL COMMENT 'Notas de Observacion',
  `Fecha` date NOT NULL COMMENT 'Fecha',
  `Hora` time NOT NULL COMMENT 'Hora',
  `Usuario` varchar(50) NOT NULL COMMENT 'Usuario'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_sistema_permisos`
--

CREATE TABLE IF NOT EXISTS `tbl_sistema_permisos` (
  `Id` bigint(20) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Error` varchar(100) DEFAULT 'true',
  `Central` varchar(5) NOT NULL DEFAULT 'false' COMMENT 'Sitio Central',
  `AsignacionAsesores` varchar(5) NOT NULL DEFAULT 'false' COMMENT 'Asignación de Asesores',
  `Ajax_AsignacionAsesores` varchar(5) NOT NULL DEFAULT 'false' COMMENT 'Ajax Asignacion de Asesores',
  `BaseGestion` varchar(5) NOT NULL DEFAULT 'false' COMMENT 'Base de Gestion',
  `Widgets` varchar(5) NOT NULL DEFAULT 'false' COMMENT 'Widgets de Aplicación',
  `Ajax` varchar(5) NOT NULL DEFAULT 'false' COMMENT 'Procesos Ajax',
  `Ajax_AdminUsuarios` varchar(5) NOT NULL DEFAULT 'false' COMMENT 'Procedimiento Ajax de Administrador de Usuarios',
  `Ajax_BaseGestion` varchar(5) NOT NULL DEFAULT 'false' COMMENT 'Ajax Base de Gestión',
  `Ajax_Consultas` varchar(5) NOT NULL DEFAULT 'false' COMMENT 'Procedimiento Ajax de Consultas',
  `Seguimiento` varchar(5) NOT NULL DEFAULT 'false' COMMENT 'Observar Seguimiento Usuario',
  `Consultas` varchar(5) NOT NULL DEFAULT 'false' COMMENT 'Busqueda y Consultas de Registros',
  `AdminUsuarios` varchar(5) NOT NULL DEFAULT 'false' COMMENT 'Administracion de Usuarios',
  `ChangePass` varchar(5) CHARACTER SET utf8mb4 NOT NULL DEFAULT 'false' COMMENT 'Cambio Password',
  `Ajax_ChangePass` varchar(5) NOT NULL DEFAULT 'false' COMMENT 'ajax cambio de pass',
  `Descargas` varchar(5) NOT NULL DEFAULT 'false' COMMENT 'Descargas Excel',
  `Informes` varchar(5) NOT NULL DEFAULT 'false' COMMENT 'informes',
  `Ajax_Informes` varchar(5) NOT NULL DEFAULT 'false' COMMENT 'ajax informes',
  `AdminContenido` varchar(5) NOT NULL DEFAULT 'false' COMMENT 'Cambio Contenido',
  `Ajax_AdminContenido` varchar(5) NOT NULL DEFAULT 'false' COMMENT 'Ajax Admon Contenido'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_sistema_permisos`
--

INSERT INTO `tbl_sistema_permisos` (`Id`, `Nombre`, `Error`, `Central`, `AsignacionAsesores`, `Ajax_AsignacionAsesores`, `BaseGestion`, `Widgets`, `Ajax`, `Ajax_AdminUsuarios`, `Ajax_BaseGestion`, `Ajax_Consultas`, `Seguimiento`, `Consultas`, `AdminUsuarios`, `ChangePass`, `Ajax_ChangePass`, `Descargas`, `Informes`, `Ajax_Informes`, `AdminContenido`, `Ajax_AdminContenido`) VALUES
(1, 'RootAgent', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true'),
(2, 'Administrador', 'true', 'true', 'false', 'false', 'false', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true'),
(3, 'Experto', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'false', 'true', 'true', 'true', 'true', 'false', 'true', 'true', 'false', 'false', 'false', 'false', 'false'),
(4, 'Consulta', 'true', 'true', 'false', 'false', 'false', 'true', 'true', 'false', 'false', 'true', 'false', 'true', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_sistema_usuarios`
--

CREATE TABLE IF NOT EXISTS `tbl_sistema_usuarios` (
  `Id` bigint(20) NOT NULL,
  `Usuario` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Nombres` varchar(255) DEFAULT NULL,
  `Apellidos` varchar(255) DEFAULT NULL,
  `Cedula` varchar(255) NOT NULL COMMENT 'Cedula',
  `Cargo` varchar(50) DEFAULT NULL,
  `Permisos` int(2) DEFAULT NULL,
  `Estado` varchar(8) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_sistema_usuarios`
--

INSERT INTO `tbl_sistema_usuarios` (`Id`, `Usuario`, `Password`, `Nombres`, `Apellidos`, `Cedula`, `Cargo`, `Permisos`, `Estado`) VALUES
(1, 'fix', 'cb40dd606cfa58af70d3cef46feb91e38b9c78ba', 'Alejandro', 'Montenegro Trujillo', '79696444', 'Desarrollador', 1, 'ACTIVO'),
(2, 'Consulta', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'Usuario', 'Consulta', '123456789', 'Asesor Consulta', 4, 'ACTIVO'),
(3, 'EKZ3611A', '4c567e6021f81a11659d28cbe712db813a176fa8', 'MIGUEL ANGEL', 'SUAREZ BELTRAN', '1022983611', 'EXPERTO', 3, 'ACTIVO'),
(4, 'JSCAMELOR', '4c56426fe0ddb82958d3c26732596cecd6925d2c', 'JHONATAN SEBASTIAN', 'CAMELO RIOS', '1013622945', 'EXPERTO', 3, 'ACTIVO'),
(6, 'EKZ6008A', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'John Henrry', 'Rincon Gutierrez', '1023916008', 'Experto', 3, 'ACTIVO'),
(7, 'CEMOGOLLON', '039c1d97aca535db4541e70fdc21a06f31073a60', 'Carlos Eduardo', 'Mogollon Hernandez', '1070596217', 'EXPERTO', 3, 'ACTIVO'),
(8, 'HVECINO', '3c7695858a8537f401b7259654a6c5ec228dbf41', 'Mauricio', 'Vecino Ramirez', '80156062', 'Mejoramiento', 2, 'ACTIVO'),
(9, 'Jenny.rangel', '9d2f0888128a8a7d1637e7ed1625a638b51f15c3', 'Marcela', 'Rangel', '53014847', 'Supervisor', 2, 'ACTIVO'),
(10, 'ACHAVES1', 'c9d1ac6e4f7494f5ce8cdfb6e51a08a2a0409218', 'Andres Julian', 'Chaves Mosuca', '80851973', 'Supervisor', 2, 'ACTIVO'),
(11, 'EKZ8060A', '736c0c8dd76a240423fff9d3038de6c6088284a1', 'YIRLEY TATIANA', 'BEJARANO RAMO', '1010218060', 'Experto', 3, 'ACTIVO'),
(12, 'EKZ2592A', '61472a8bcf61326107ab5e598247f7bd1beeda1d', 'OSCAR FABIAN', 'RUBIO FRANCO', '1026282592', 'Experto', 3, 'ACTIVO'),
(13, 'Yolanda', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Myriam Yolanda', 'Chacon Gomez', '123', 'Jefe', 1, 'ACTIVO');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_base_equipo`
--
ALTER TABLE `tbl_base_equipo`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `tbl_base_firmware`
--
ALTER TABLE `tbl_base_firmware`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `tbl_base_general`
--
ALTER TABLE `tbl_base_general`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `IIMS_Paso` (`IIMS_Paso`);

--
-- Indices de la tabla `tbl_base_paquete_tv`
--
ALTER TABLE `tbl_base_paquete_tv`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Estado` (`Estado`);

--
-- Indices de la tabla `tbl_base_sintoma`
--
ALTER TABLE `tbl_base_sintoma`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Fecha` (`Fecha`,`Hora`);

--
-- Indices de la tabla `tbl_base_softswitch`
--
ALTER TABLE `tbl_base_softswitch`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `tbl_gestion_asesores`
--
ALTER TABLE `tbl_gestion_asesores`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `tbl_gestion_asesor_asignado`
--
ALTER TABLE `tbl_gestion_asesor_asignado`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `tbl_gestion_seguimiento`
--
ALTER TABLE `tbl_gestion_seguimiento`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Usuario` (`Usuario`),
  ADD KEY `TipoReporte` (`TipoReporte`);

--
-- Indices de la tabla `tbl_gestion_seguimiento_notas`
--
ALTER TABLE `tbl_gestion_seguimiento_notas`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Registro` (`Registro`),
  ADD KEY `Fecha` (`Fecha`,`Hora`),
  ADD KEY `Usuario` (`Usuario`);

--
-- Indices de la tabla `tbl_sistema_permisos`
--
ALTER TABLE `tbl_sistema_permisos`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Consultas` (`Consultas`),
  ADD KEY `Ajax_Consultas` (`Ajax_Consultas`),
  ADD KEY `AdminUsuarios` (`AdminUsuarios`),
  ADD KEY `Ajax_AdminUsuarios` (`Ajax_AdminUsuarios`),
  ADD KEY `ChangePass` (`ChangePass`),
  ADD KEY `Descargas` (`Descargas`),
  ADD KEY `Ajax_BaseGestion` (`Ajax_BaseGestion`),
  ADD KEY `Ajax_ChangePass` (`Ajax_ChangePass`),
  ADD KEY `Ajax_AsignacionAsesores` (`Ajax_AsignacionAsesores`);

--
-- Indices de la tabla `tbl_sistema_usuarios`
--
ALTER TABLE `tbl_sistema_usuarios`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Cedula` (`Cedula`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_base_equipo`
--
ALTER TABLE `tbl_base_equipo`
  MODIFY `Id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT de la tabla `tbl_base_firmware`
--
ALTER TABLE `tbl_base_firmware`
  MODIFY `Id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT de la tabla `tbl_base_general`
--
ALTER TABLE `tbl_base_general`
  MODIFY `Id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_base_paquete_tv`
--
ALTER TABLE `tbl_base_paquete_tv`
  MODIFY `Id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT de la tabla `tbl_base_sintoma`
--
ALTER TABLE `tbl_base_sintoma`
  MODIFY `Id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=159;
--
-- AUTO_INCREMENT de la tabla `tbl_base_softswitch`
--
ALTER TABLE `tbl_base_softswitch`
  MODIFY `Id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `tbl_gestion_asesores`
--
ALTER TABLE `tbl_gestion_asesores`
  MODIFY `Id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=83;
--
-- AUTO_INCREMENT de la tabla `tbl_gestion_asesor_asignado`
--
ALTER TABLE `tbl_gestion_asesor_asignado`
  MODIFY `Id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `tbl_gestion_seguimiento`
--
ALTER TABLE `tbl_gestion_seguimiento`
  MODIFY `Id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_gestion_seguimiento_notas`
--
ALTER TABLE `tbl_gestion_seguimiento_notas`
  MODIFY `Id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'Id de Registro';
--
-- AUTO_INCREMENT de la tabla `tbl_sistema_permisos`
--
ALTER TABLE `tbl_sistema_permisos`
  MODIFY `Id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `tbl_sistema_usuarios`
--
ALTER TABLE `tbl_sistema_usuarios`
  MODIFY `Id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
