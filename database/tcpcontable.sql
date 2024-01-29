-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.0.30 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.3.0.6589
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Volcando estructura para tabla tcpcontable.acnt_accounts
CREATE TABLE IF NOT EXISTS `acnt_accounts` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `code_parent` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `code` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `desc` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- Volcando datos para la tabla tcpcontable.acnt_accounts: ~13 rows (aproximadamente)
INSERT INTO `acnt_accounts` (`id`, `code_parent`, `code`, `desc`) VALUES
	(1, '10.1', '100', 'Efectivo en Caja'),
	(2, '10.1', '110', 'Efectivo en Banco'),
	(3, '10.2', '200', 'Activos Fijos Tangibles'),
	(4, '10.3', '300', 'Depreciación de AFT'),
	(5, '20.1', '470', 'Préstamos Bancarios a Corto Plazo'),
	(6, '20.2', '520', 'Préstamos Bancarios a Largo Plazo'),
	(7, '30', '600', 'Patrimonio del TCP'),
	(8, '30', '610', 'Utilidad Retenida'),
	(9, '30', '620', 'Pérdida'),
	(10, '40.1', '800', 'Gastos de Operación'),
	(11, '40.1', '810', 'Impuestos y Tasas'),
	(12, '40.2', '900', 'Ventas'),
	(13, '50', '999', 'Resultado');

-- Volcando estructura para tabla tcpcontable.acnt_groups
CREATE TABLE IF NOT EXISTS `acnt_groups` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `desc` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- Volcando datos para la tabla tcpcontable.acnt_groups: ~5 rows (aproximadamente)
INSERT INTO `acnt_groups` (`id`, `code`, `desc`) VALUES
	(1, '10', 'Activos'),
	(2, '20', 'Pasivos'),
	(3, '30', 'Patrimonio'),
	(4, '40', 'Nominales'),
	(5, '50', 'Cierre');

-- Volcando estructura para tabla tcpcontable.acnt_subcounts
CREATE TABLE IF NOT EXISTS `acnt_subcounts` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `id_account` int unsigned NOT NULL,
  `code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `desc` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- Volcando datos para la tabla tcpcontable.acnt_subcounts: ~15 rows (aproximadamente)
INSERT INTO `acnt_subcounts` (`id`, `id_account`, `code`, `desc`) VALUES
	(1, 7, '10', 'Saldo al inicio del ejercicio'),
	(2, 7, '20', 'Incrementos de aportes del TCP en el ejercicio contable'),
	(3, 7, '30', 'Erogaciones efectuadas por el TCP en el ejercicio contable'),
	(4, 7, '40', 'Pagos de Cuotas del Impuesto sobre Ingresos Personales'),
	(5, 7, '50', 'Contribución a la Seguridad Social'),
	(6, 10, '11000', 'Materias Primas y Materiales'),
	(7, 10, '30000', 'Combustible'),
	(8, 10, '40000', 'Energía Eléctrica'),
	(9, 10, '50000', 'Remuneraciones al Personal Contratado'),
	(10, 10, '70000', 'Depreciación de AFT'),
	(11, 10, '80000', 'Otros Gastos Monetarios y Financieros'),
	(12, 11, '10', 'Impuesto sobre las Ventas'),
	(13, 11, '20', 'Impuesto sobre los Servicios Públicos'),
	(14, 11, '30', 'Impuesto por la Utilización de la Fuerza de Trabajo'),
	(15, 11, '40', 'Otros Impuestos y Tasas');

-- Volcando estructura para tabla tcpcontable.acnt_subgroups
CREATE TABLE IF NOT EXISTS `acnt_subgroups` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `id_group` int unsigned NOT NULL,
  `code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `desc` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- Volcando datos para la tabla tcpcontable.acnt_subgroups: ~7 rows (aproximadamente)
INSERT INTO `acnt_subgroups` (`id`, `id_group`, `code`, `desc`) VALUES
	(1, 1, '10.1', 'Activo Circulante'),
	(2, 1, '10.2', 'Activos Fijos'),
	(3, 1, '10.3', 'Reguladoras de Activos'),
	(4, 2, '20.1', 'Pasivos Circulantes'),
	(5, 2, '20.2', 'Pasivos a Largo Plazo'),
	(6, 4, '40.1', 'Deudoras'),
	(7, 4, '40.2', 'Acreedoras');

-- Volcando estructura para tabla tcpcontable.aft_groups
CREATE TABLE IF NOT EXISTS `aft_groups` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `desc` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- Volcando datos para la tabla tcpcontable.aft_groups: ~3 rows (aproximadamente)
INSERT INTO `aft_groups` (`id`, `code`, `desc`) VALUES
	(1, '001', 'Edificaciones'),
	(2, '002', 'Muebles'),
	(3, '003', 'Equipos');

-- Volcando estructura para tabla tcpcontable.aft_products
CREATE TABLE IF NOT EXISTS `aft_products` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `id_tcp` int unsigned NOT NULL,
  `id_group` int unsigned NOT NULL,
  `product` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `um` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ctdad` int DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `import` decimal(10,2) DEFAULT NULL,
  `pay_date` date DEFAULT NULL,
  `live_year` decimal(10,2) DEFAULT NULL,
  `dep_year` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `dep_month` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- Volcando datos para la tabla tcpcontable.aft_products: ~7 rows (aproximadamente)
INSERT INTO `aft_products` (`id`, `id_tcp`, `id_group`, `product`, `um`, `ctdad`, `price`, `import`, `pay_date`, `live_year`, `dep_year`, `dep_month`) VALUES
	(1, 1, 1, 'Ranchón', 'U', 1, 15000.00, 15000.00, '2019-01-01', 16.60, '900.00', '75.00'),
	(2, 1, 1, 'Baño', 'U', 1, 11000.00, 11000.00, '2019-01-01', 33.30, '330.00', '27.50'),
	(3, 1, 2, 'Banquetas', 'U', 2, 150.00, 300.00, '2019-01-01', 10.00, '30.00', '2.50'),
	(4, 1, 3, 'Batidora', 'U', 1, 600.00, 600.00, '2019-12-11', 10.00, '60.00', '5.00'),
	(5, 1, 2, 'Barra Sala', 'U', 1, 500.00, 500.00, '2019-12-11', 10.00, '50.00', '4.17'),
	(6, 2, 3, 'Camión', 'U', 1, 180000.00, 180000.00, '2010-04-07', 10.00, '18000.00', '1500.00'),
	(7, 1, 3, 'Computadora', 'U', 1, 10000.00, 10000.00, '2021-01-01', 10.00, '1000.00', '83.33');

-- Volcando estructura para tabla tcpcontable.aft_product_subgroup
CREATE TABLE IF NOT EXISTS `aft_product_subgroup` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `id_product` int unsigned NOT NULL,
  `id_subgroup` int unsigned NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- Volcando datos para la tabla tcpcontable.aft_product_subgroup: ~2 rows (aproximadamente)
INSERT INTO `aft_product_subgroup` (`id`, `id_product`, `id_subgroup`) VALUES
	(1, 1, 1),
	(3, 2, 2);

-- Volcando estructura para tabla tcpcontable.aft_subgroups
CREATE TABLE IF NOT EXISTS `aft_subgroups` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `id_group` int unsigned NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- Volcando datos para la tabla tcpcontable.aft_subgroups: ~2 rows (aproximadamente)
INSERT INTO `aft_subgroups` (`id`, `id_group`, `name`) VALUES
	(1, 1, 'Madera/Plástico'),
	(2, 1, 'Hormigón/Hierro');

-- Volcando estructura para tabla tcpcontable.cash_bank
CREATE TABLE IF NOT EXISTS `cash_bank` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `id_tcp` int unsigned NOT NULL,
  `date` date NOT NULL,
  `desc` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `debit` decimal(10,2) DEFAULT NULL,
  `credit` decimal(10,2) DEFAULT NULL,
  `sald` decimal(10,2) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- Volcando datos para la tabla tcpcontable.cash_bank: ~8 rows (aproximadamente)
INSERT INTO `cash_bank` (`id`, `id_tcp`, `date`, `desc`, `debit`, `credit`, `sald`, `created_at`, `updated_at`) VALUES
	(1, 1, '2020-01-01', 'Saldo al Inicio del Mes', 0.00, 0.00, 1225.97, '2020-02-22 23:06:53', '2020-02-22 23:06:53'),
	(2, 1, '2020-01-20', 'Depósito en Cuenta', 13756.00, 0.00, NULL, '2020-02-22 23:07:14', '2020-02-22 23:07:55'),
	(3, 1, '2020-01-20', 'Aporte al presupuesto', 0.00, 2116.30, NULL, '2020-02-22 23:08:06', '2020-02-22 23:08:33'),
	(4, 1, '2020-01-20', 'Aporte al presupuesto', 0.00, 650.00, NULL, '2020-02-22 23:08:40', '2020-02-22 23:08:54'),
	(5, 1, '2020-01-20', 'Aporte al presupuesto', 0.00, 114.45, NULL, '2020-02-22 23:09:02', '2020-02-22 23:09:16'),
	(8, 1, '2020-01-20', 'Aporte al presupuesto', 0.00, 87.50, NULL, '2020-02-23 11:29:03', '2020-02-23 11:29:22'),
	(9, 1, '2020-01-20', 'Extracción para pagos en efectivo', 0.00, 10007.75, NULL, '2020-02-23 11:31:21', '2020-02-23 11:31:50'),
	(10, 1, '2020-01-01', 'Compra de Materias Primas y Materiales de Enero', 0.00, 1.00, NULL, '2022-01-31 19:59:07', '2022-01-31 19:59:07');

-- Volcando estructura para tabla tcpcontable.cities
CREATE TABLE IF NOT EXISTS `cities` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `id_province` int unsigned NOT NULL,
  `city` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=169 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- Volcando datos para la tabla tcpcontable.cities: ~168 rows (aproximadamente)
INSERT INTO `cities` (`id`, `id_province`, `city`) VALUES
	(1, 1, 'Consolación del Sur'),
	(2, 1, 'Guane'),
	(3, 1, 'La Palma'),
	(4, 1, 'Los Palacios'),
	(5, 1, 'Mantua'),
	(6, 1, 'Minas de Matahambre'),
	(7, 1, 'Pinar del Río'),
	(8, 1, 'San Juan y Martínez'),
	(9, 1, 'San Luis'),
	(10, 1, 'Sandino'),
	(11, 1, 'Viñales'),
	(12, 2, 'Alquízar'),
	(13, 2, 'Artemisa'),
	(14, 2, 'Bahía Honda'),
	(15, 2, 'Bauta'),
	(16, 2, 'Caimito'),
	(17, 2, 'Candelaria'),
	(18, 2, 'Guanajay'),
	(19, 2, 'Guira de Melena'),
	(20, 2, 'Mariel'),
	(21, 2, 'San Antonio de los Baños'),
	(22, 2, 'San Cristobal'),
	(23, 3, 'Arroyo Naranjo'),
	(24, 3, 'Boyeros'),
	(25, 3, 'Centro Habana'),
	(26, 3, 'Cerro'),
	(27, 3, 'Cotorro'),
	(28, 3, 'Diez de Octubre'),
	(29, 3, 'Guanabacoa'),
	(30, 3, 'Habana del Este'),
	(31, 3, 'La Habana Vieja'),
	(32, 3, 'La Lisa'),
	(33, 3, 'Marianao'),
	(34, 3, 'Playa'),
	(35, 3, 'Plaza de la Revolución'),
	(36, 3, 'Regla'),
	(37, 3, 'San Miguel del Padrón'),
	(38, 4, 'Batabanó'),
	(39, 4, 'Bejucal'),
	(40, 4, 'Guines'),
	(41, 4, 'Jaruco'),
	(42, 4, 'Madruga'),
	(43, 4, 'Melena del Sur'),
	(44, 4, 'Nueva Paz'),
	(45, 4, 'Quivicán'),
	(46, 4, 'San José de las Lajas'),
	(47, 4, 'San Nicolás'),
	(48, 4, 'Santa Cruz del Norte'),
	(49, 5, 'Calimete'),
	(50, 5, 'Cárdenas'),
	(51, 5, 'Ciénaga de Zapata'),
	(52, 5, 'Colón'),
	(53, 5, 'Jaguey Grande'),
	(54, 5, 'Jovellanos'),
	(55, 5, 'Limonar'),
	(56, 5, 'Los Arabos'),
	(57, 5, 'Martí'),
	(58, 5, 'Matanzas'),
	(59, 5, 'Pedro Betancourt'),
	(60, 5, 'Perico'),
	(61, 5, 'Unión de Reyes'),
	(62, 6, 'Abreus'),
	(63, 6, 'Aguada de Pasajeros'),
	(64, 6, 'Cienfuegos'),
	(65, 6, 'Cruces'),
	(66, 6, 'Cumanayagua'),
	(67, 6, 'Lajas'),
	(68, 6, 'Palmiras'),
	(69, 6, 'Rodas'),
	(70, 7, 'Caibarién'),
	(71, 7, 'Camajuaní'),
	(72, 7, 'Cifuentes'),
	(73, 7, 'Corralillo'),
	(74, 7, 'Encrucijada'),
	(75, 7, 'Manicaragua'),
	(76, 7, 'Placetas'),
	(77, 7, 'Quemado de Guines'),
	(78, 7, 'Ranchuelo'),
	(79, 7, 'San Juan de los Remedios'),
	(80, 7, 'Sagua la Grande'),
	(81, 7, 'Santa Clara'),
	(82, 7, 'Santo Domingo'),
	(83, 8, 'Cabaiguán'),
	(84, 8, 'Fomento'),
	(85, 8, 'Jatibonico'),
	(86, 8, 'La Sierpe'),
	(87, 8, 'Santi Spíritus'),
	(88, 8, 'Taguasco'),
	(89, 8, 'Trinidad'),
	(90, 8, 'Yaguajay'),
	(91, 9, 'Baraguá'),
	(92, 9, 'Bolivia'),
	(93, 9, 'Chambas'),
	(94, 9, 'Ciego de Avila'),
	(95, 9, 'Ciro Redondo'),
	(96, 9, 'Florencia'),
	(97, 9, 'Majagua'),
	(98, 9, 'Morón'),
	(99, 9, 'Primero de Enero'),
	(100, 9, 'Venezuela'),
	(101, 10, 'Camaguey'),
	(102, 10, 'Carlos M. de Céspedes'),
	(103, 10, 'Esmeralda'),
	(104, 10, 'Florida'),
	(105, 10, 'Guáimaro'),
	(106, 10, 'Jimaguayú'),
	(107, 10, 'Minas'),
	(108, 10, 'Najasa'),
	(109, 10, 'Nuevitas'),
	(110, 10, 'Santa Cruz del Sur'),
	(111, 10, 'Sibanicú'),
	(112, 10, 'Sierra de Cubitas'),
	(113, 10, 'Vertientes'),
	(114, 11, 'Amancio'),
	(115, 11, 'Colombia'),
	(116, 11, 'Jesús Menéndez'),
	(117, 11, 'Jobabo'),
	(118, 11, 'Las Tunas'),
	(119, 11, 'Majibacoa'),
	(120, 11, 'Manatí'),
	(121, 11, 'Puerto Padre'),
	(122, 12, 'Antilla'),
	(123, 12, 'Baguanos'),
	(124, 12, 'Banes'),
	(125, 12, 'Cacocún'),
	(126, 12, 'Calixto García'),
	(127, 12, 'Cueto'),
	(128, 12, 'Frank País'),
	(129, 12, 'Jibara'),
	(130, 12, 'Holguín'),
	(131, 12, 'Mayarí'),
	(132, 12, 'Moa'),
	(133, 12, 'Rafael Freire'),
	(134, 12, 'Sagua de Tánamo'),
	(135, 12, 'Urbano Noris'),
	(136, 13, 'Bartolomé Masó'),
	(137, 13, 'Bayamo'),
	(138, 13, 'Buey Arriba'),
	(139, 13, 'Campechuela'),
	(140, 13, 'Cauto Cristo'),
	(141, 13, 'Guisa'),
	(142, 13, 'Jiguaní'),
	(143, 13, 'Manzanillo'),
	(144, 13, 'Media Luna'),
	(145, 13, 'Niquero'),
	(146, 13, 'Pilón'),
	(147, 13, 'Río Cauto'),
	(148, 13, 'Yara'),
	(149, 14, 'Contramaestre'),
	(150, 14, 'Guamá'),
	(151, 14, 'Mella'),
	(152, 14, 'Palma Soriano'),
	(153, 14, 'San Luis'),
	(154, 14, 'Santiago de Cuba'),
	(155, 14, 'Segundo Frente'),
	(156, 14, 'Songo-La Maya'),
	(157, 14, 'Tercer Frente'),
	(158, 15, 'Baracoa'),
	(159, 15, 'Caimanera'),
	(160, 15, 'El Salvador'),
	(161, 15, 'Guantánamo'),
	(162, 15, 'Imías'),
	(163, 15, 'Maisí'),
	(164, 15, 'Manuel Tames'),
	(165, 15, 'Niceto Pérez'),
	(166, 15, 'San Antonio del Sur'),
	(167, 15, 'Yateras'),
	(168, 16, 'Nueva Gerona');

-- Volcando estructura para tabla tcpcontable.entries
CREATE TABLE IF NOT EXISTS `entries` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `id_tcp` int unsigned DEFAULT NULL,
  `date` date DEFAULT NULL,
  `cash_box` decimal(10,2) DEFAULT NULL,
  `cash_ncei` decimal(10,2) DEFAULT NULL,
  `detail` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- Volcando datos para la tabla tcpcontable.entries: ~27 rows (aproximadamente)
INSERT INTO `entries` (`id`, `id_tcp`, `date`, `cash_box`, `cash_ncei`, `detail`, `created_at`, `updated_at`) VALUES
	(5, 1, '2019-12-01', 3200.00, 0.00, 'Esto es un test', '2019-12-16 19:12:40', '2019-12-17 00:12:40'),
	(9, 1, '2019-12-03', 4000.00, 0.00, NULL, '2019-12-16 19:20:36', '2019-12-17 00:20:36'),
	(12, 1, '2019-12-04', 1000.00, 0.00, NULL, '2019-12-16 19:38:32', '2019-12-17 00:38:32'),
	(13, 1, '2019-11-01', 5000.00, 0.00, NULL, '2019-12-17 04:05:42', '2019-12-17 04:05:42'),
	(14, 1, '2019-12-02', 1000.00, 0.00, NULL, '2019-12-17 04:32:59', '2019-12-17 04:32:59'),
	(20, 1, '2019-12-05', 2000.00, 0.00, NULL, '2019-12-21 14:08:53', '2019-12-21 14:08:53'),
	(21, 1, '2019-12-06', 1000.00, 0.00, NULL, '2019-12-21 15:36:01', '2019-12-21 15:36:01'),
	(22, 1, '2019-01-01', 1000.00, 0.00, NULL, '2020-01-06 14:02:06', '2020-01-06 14:02:06'),
	(23, 1, '2020-01-01', 4224.00, 0.00, NULL, '2022-01-30 16:28:36', '2022-01-30 21:28:36'),
	(24, 1, '2020-01-02', 1000.00, 0.00, NULL, '2020-01-13 20:41:34', '2020-01-13 20:41:34'),
	(25, 1, '2020-01-03', 1500.00, 0.00, NULL, '2020-01-20 23:51:04', '2020-01-20 23:51:04'),
	(26, 1, '2020-02-01', 1000.00, 0.00, NULL, '2020-02-18 01:34:42', '2020-02-18 01:34:42'),
	(27, 1, '2020-01-04', 1000.00, 0.00, NULL, '2020-03-01 16:13:13', '2020-03-01 16:13:13'),
	(28, 1, '2020-01-05', 900.00, 0.00, NULL, '2020-03-01 16:13:18', '2020-03-01 16:13:18'),
	(29, 1, '2020-01-06', 1200.00, 0.00, NULL, '2020-03-01 16:13:25', '2020-03-01 16:13:25'),
	(30, 1, '2020-01-07', 1050.00, 0.00, NULL, '2020-03-01 16:13:35', '2020-03-01 16:13:35'),
	(31, 1, '2020-01-08', 2000.00, 0.00, NULL, '2020-03-01 16:13:44', '2020-03-01 16:13:44'),
	(32, 1, '2020-01-09', 1800.00, 0.00, NULL, '2020-03-01 16:13:53', '2020-03-01 16:13:53'),
	(33, 1, '2020-01-10', 1450.00, 0.00, NULL, '2022-01-30 14:05:25', '2022-01-30 19:05:25'),
	(34, 1, '2022-01-02', 345.00, 0.00, NULL, '2022-02-01 00:50:01', '2022-02-01 00:50:01'),
	(35, 2, '2023-06-01', 1000.00, 150.00, NULL, '2023-06-08 01:18:54', '2023-06-08 05:18:54'),
	(36, 2, '2023-07-01', 12000.00, 0.00, NULL, '2023-07-09 17:39:06', '2023-07-09 21:39:06'),
	(37, 1, '2023-07-01', 3435.00, 0.00, NULL, '2023-07-23 02:21:44', '2023-07-23 02:21:44'),
	(38, 3, '2023-08-01', 200000.00, 500.00, NULL, '2023-08-12 14:27:05', '2023-08-12 18:27:05'),
	(39, 3, '2023-08-02', 175350.00, 500.00, NULL, '2023-08-12 14:26:48', '2023-08-12 18:26:48'),
	(40, 3, '2023-08-03', 210000.00, 500.00, NULL, '2023-08-12 14:27:12', '2023-08-12 18:27:12'),
	(41, 3, '2023-08-04', 150865.00, 400.00, NULL, '2023-08-12 14:27:27', '2023-08-12 18:27:27'),
	(42, 3, '2023-08-05', 201460.00, 0.00, NULL, '2023-08-12 18:26:20', '2023-08-12 18:26:20'),
	(44, 2, '2023-11-01', 10000.00, 0.00, NULL, '2023-11-27 14:28:13', '2023-11-27 19:28:13');

-- Volcando estructura para tabla tcpcontable.expenses
CREATE TABLE IF NOT EXISTS `expenses` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `id_tcp` int unsigned NOT NULL,
  `date` date NOT NULL,
  `mp_materials` decimal(10,2) DEFAULT NULL,
  `goods` decimal(10,2) DEFAULT NULL,
  `fuel` decimal(10,2) DEFAULT NULL,
  `power` decimal(10,2) DEFAULT NULL,
  `salary` decimal(10,2) DEFAULT NULL,
  `col7` decimal(10,2) DEFAULT NULL,
  `col8` decimal(10,2) DEFAULT NULL,
  `col9` decimal(10,2) DEFAULT NULL,
  `col10` decimal(10,2) DEFAULT NULL,
  `col11` decimal(10,2) DEFAULT NULL,
  `col12` decimal(10,2) DEFAULT NULL,
  `others` decimal(10,2) DEFAULT NULL,
  `lease_state` decimal(10,2) DEFAULT NULL,
  `col17` decimal(10,2) DEFAULT NULL,
  `col18` decimal(10,2) DEFAULT NULL,
  `col19` decimal(10,2) DEFAULT NULL,
  `expenses_ncei` decimal(10,2) DEFAULT NULL,
  `cash_box` decimal(10,2) DEFAULT NULL,
  `cash_bank` decimal(10,2) DEFAULT NULL,
  `detail` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- Volcando datos para la tabla tcpcontable.expenses: ~8 rows (aproximadamente)
INSERT INTO `expenses` (`id`, `id_tcp`, `date`, `mp_materials`, `goods`, `fuel`, `power`, `salary`, `col7`, `col8`, `col9`, `col10`, `col11`, `col12`, `others`, `lease_state`, `col17`, `col18`, `col19`, `expenses_ncei`, `cash_box`, `cash_bank`, `detail`, `created_at`, `updated_at`) VALUES
	(1, 1, '2019-12-01', 2000.00, NULL, NULL, NULL, 100.00, 10.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2110.00, NULL, NULL, '2019-12-21 14:20:51', '2020-02-13 03:28:44'),
	(2, 1, '2019-12-02', 1000.00, NULL, NULL, NULL, 100.00, 10.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-12-21 14:25:54', '2020-02-12 16:35:14'),
	(4, 1, '2019-12-03', 2500.50, NULL, NULL, NULL, 100.00, 10.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-12-21 17:19:21', '2020-02-12 16:35:19'),
	(5, 1, '2019-12-04', 3000.00, NULL, NULL, 50.00, 100.00, 10.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-12-21 20:16:14', '2020-02-12 16:35:24'),
	(6, 1, '2020-01-01', 1.00, 2.00, 3.00, 4.00, 5.00, 34234.00, 500.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 34249.00, NULL, NULL, '2020-01-13 15:55:37', '2022-01-31 19:53:33'),
	(7, 1, '2020-12-01', 500.00, NULL, NULL, NULL, 60.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL, NULL, '2020-01-22 03:46:47', '2020-01-22 03:49:37'),
	(8, 1, '2020-01-02', 6.00, 5.00, 8.00, 9.00, 10.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 38.00, NULL, NULL, '2020-01-25 17:39:09', '2022-01-30 16:29:15'),
	(9, 1, '2019-01-01', NULL, NULL, NULL, NULL, NULL, 242444.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2020-02-01 20:56:43', '2020-02-01 20:59:15'),
	(10, 2, '2023-07-01', NULL, NULL, NULL, NULL, 10000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-09 17:43:03', '2023-07-09 17:43:03'),
	(11, 2, '2023-11-01', 200.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-11-27 14:37:23', '2023-11-27 14:37:23');

-- Volcando estructura para tabla tcpcontable.expenses_columns
CREATE TABLE IF NOT EXISTS `expenses_columns` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `id_tcp` int unsigned NOT NULL,
  `col7` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '',
  `col8` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '',
  `col9` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '',
  `col10` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '',
  `col11` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '',
  `col12` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '',
  `col17` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '',
  `col18` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '',
  `col19` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- Volcando datos para la tabla tcpcontable.expenses_columns: ~0 rows (aproximadamente)
INSERT INTO `expenses_columns` (`id`, `id_tcp`, `col7`, `col8`, `col9`, `col10`, `col11`, `col12`, `col17`, `col18`, `col19`) VALUES
	(1, 1, 'Renta', 'Alquiler de local', '', '', '', '', '', '', '');

-- Volcando estructura para tabla tcpcontable.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Volcando datos para la tabla tcpcontable.migrations: ~0 rows (aproximadamente)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1);

-- Volcando estructura para tabla tcpcontable.model_options
CREATE TABLE IF NOT EXISTS `model_options` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `id_tcp` int unsigned NOT NULL,
  `date` date DEFAULT NULL,
  `year` int DEFAULT NULL,
  `model` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `key` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `value` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- Volcando datos para la tabla tcpcontable.model_options: ~18 rows (aproximadamente)
INSERT INTO `model_options` (`id`, `id_tcp`, `date`, `year`, `model`, `key`, `value`, `created_at`, `updated_at`) VALUES
	(1, 1, NULL, 2020, 'states', 'tax_entries', 10400.56, '2020-01-30 01:55:26', '2020-01-30 06:55:26'),
	(2, 1, NULL, 2019, 'states', 'tax_entries', 110.00, '2020-01-10 10:09:50', '2020-01-10 15:09:50'),
	(3, 1, NULL, 2020, 'states', 'cash_bank', 10.00, '2020-01-22 02:35:07', '2020-01-22 02:35:07'),
	(4, 1, NULL, 2020, 'states', 'acc_receiv', 8.00, '2020-01-22 02:47:06', '2020-01-22 02:47:06'),
	(5, 1, NULL, 2020, 'states', 'bank_oblig_short', 4.00, '2020-01-22 02:47:31', '2020-01-22 02:47:31'),
	(6, 1, NULL, 2020, 'states', 'bank_oblig_long', 7.00, '2020-01-22 02:47:37', '2020-01-22 02:47:37'),
	(7, 1, '2020-01-02', NULL, 'regcash', 'bank_deposit', 5.00, '2020-01-31 09:59:20', '2020-01-31 14:59:20'),
	(8, 1, '2020-01-01', NULL, 'regcash', 'bank_deposit', 14.56, '2020-01-27 04:07:21', '2020-01-27 04:07:21'),
	(9, 1, '2020-01-03', NULL, 'regcash', 'bank_deposit', 25.32, '2020-01-27 04:21:50', '2020-01-27 04:21:50'),
	(10, 1, '2020-01-04', NULL, 'regcash', 'bank_deposit', 0.00, '2020-01-31 23:56:28', '2020-02-01 04:56:28'),
	(11, 1, '2020-01-11', NULL, 'regcash', 'bank_deposit', 0.00, '2020-01-28 07:01:27', '2020-01-28 07:01:27'),
	(12, 1, '2019-02-01', NULL, 'regcash', 'bank_deposit', 5.00, '2020-02-01 20:22:19', '2020-02-01 20:22:19'),
	(13, 1, '2019-12-02', NULL, 'regcash', 'bank_deposit', 4500.00, '2020-02-10 08:50:02', '2020-02-10 08:50:02'),
	(14, 1, NULL, 2020, 'states', 'plus_contribution', 0.00, '2020-02-04 07:22:16', '2020-02-04 07:22:16'),
	(15, 1, '2020-02-01', NULL, 'regcash', 'bank_deposit', 0.00, '2020-02-10 13:50:36', '2020-02-10 13:50:36'),
	(16, 1, NULL, 2019, 'states', 'plus_contribution', 20.00, '2020-02-13 19:10:25', '2020-02-14 00:10:25'),
	(17, 1, NULL, 2019, 'states', 'other_expenses', 125.50, '2020-02-12 08:04:53', '2020-02-12 08:04:53'),
	(18, 1, NULL, 2020, 'states', 'other_expenses', 0.00, '2020-02-13 21:08:53', '2020-02-13 21:08:53'),
	(19, 1, NULL, 2023, 'states', 'cash_bank', 0.00, '2023-07-10 01:02:15', '2023-07-10 01:02:15');

-- Volcando estructura para tabla tcpcontable.obligations
CREATE TABLE IF NOT EXISTS `obligations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `obligation` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- Volcando datos para la tabla tcpcontable.obligations: ~9 rows (aproximadamente)
INSERT INTO `obligations` (`id`, `obligation`, `code`) VALUES
	(1, 'Impuesto Sobre Las Ventas', '011402-2'),
	(2, 'Impuesto Sobre Los Servicios', '020102-2'),
	(3, 'Tcp', '051012-2'),
	(4, 'Regimen Simplificado', '051052-2'),
	(5, 'Tasa Por Radicacion De Anuncio Y Propoganda Comercial', '090012-2'),
	(6, 'Contribucion Especial De Los Trabajadores A La Seguridad Social', '082013-2'),
	(7, 'Impuesto Por La Utilizacion De Fuerza De Trabajo', '061032-2'),
	(8, 'Impuesto Sobre El Transporte Terrestre', '071062-2'),
	(9, 'Impuesto Sobre Ingresos Personales. Liquidacion Adicional', '053022-2');

-- Volcando estructura para tabla tcpcontable.provinces
CREATE TABLE IF NOT EXISTS `provinces` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `province` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- Volcando datos para la tabla tcpcontable.provinces: ~16 rows (aproximadamente)
INSERT INTO `provinces` (`id`, `province`) VALUES
	(1, 'Pinar del Río'),
	(2, 'Artemisa'),
	(3, 'La Habana'),
	(4, 'Mayabeque'),
	(5, 'Matanzas'),
	(6, 'Cienfuegos'),
	(7, 'Villa Clara'),
	(8, 'Santi Spíritus'),
	(9, 'Ciego de Avila'),
	(10, 'Camaguey'),
	(11, 'Las Tunas'),
	(12, 'Holguín'),
	(13, 'Granma'),
	(14, 'Santiago de Cuba'),
	(15, 'Guantánamo'),
	(16, 'Isla de la Juventud');

-- Volcando estructura para tabla tcpcontable.tax
CREATE TABLE IF NOT EXISTS `tax` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `id_tcp` int unsigned NOT NULL,
  `month` int NOT NULL,
  `year` int NOT NULL,
  `workforce` decimal(10,2) DEFAULT NULL,
  `documents` decimal(10,2) DEFAULT NULL,
  `commercial_ads` decimal(10,2) DEFAULT NULL,
  `social_security` decimal(10,2) DEFAULT NULL,
  `others` decimal(10,2) DEFAULT NULL,
  `restoration_repair` decimal(10,2) DEFAULT NULL,
  `monthly_fee` decimal(10,2) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- Volcando datos para la tabla tcpcontable.tax: ~6 rows (aproximadamente)
INSERT INTO `tax` (`id`, `id_tcp`, `month`, `year`, `workforce`, `documents`, `commercial_ads`, `social_security`, `others`, `restoration_repair`, `monthly_fee`, `created_at`, `updated_at`) VALUES
	(1, 1, 7, 2019, 555.00, NULL, NULL, NULL, NULL, NULL, NULL, '2019-12-21 20:55:29', '2019-12-21 20:55:29'),
	(2, 1, 4, 2019, 2343.00, NULL, NULL, NULL, NULL, NULL, NULL, '2019-12-21 20:55:43', '2019-12-21 21:09:45'),
	(3, 1, 12, 2019, 1000.00, NULL, NULL, 87.50, NULL, NULL, 80.00, '2019-12-21 20:58:27', '2020-02-12 16:17:43'),
	(4, 1, 1, 2019, NULL, NULL, NULL, NULL, NULL, NULL, 100.00, '2019-12-26 20:17:47', '2020-01-10 10:00:56'),
	(5, 1, 11, 2019, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-12-26 20:21:32', '2019-12-26 20:21:32'),
	(6, 1, 1, 2020, NULL, NULL, NULL, 87.50, NULL, NULL, NULL, '2020-01-13 15:54:51', '2020-01-13 15:54:51');

-- Volcando estructura para tabla tcpcontable.tcp
CREATE TABLE IF NOT EXISTS `tcp` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `company` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `last_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ci` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nit` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `act_code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `act_desc` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `workers` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address_company` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `province_company` int unsigned DEFAULT NULL,
  `city_company` int unsigned DEFAULT NULL,
  `province` int DEFAULT NULL,
  `city` int DEFAULT NULL,
  `telephone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- Volcando datos para la tabla tcpcontable.tcp: ~3 rows (aproximadamente)
INSERT INTO `tcp` (`id`, `company`, `name`, `last_name`, `ci`, `nit`, `act_code`, `act_desc`, `workers`, `address`, `address_company`, `province_company`, `city_company`, `province`, `city`, `telephone`, `email`, `created_at`, `updated_at`) VALUES
	(1, 'Camión Eduardo Semidey', 'Eduardo', 'Semidey Domínguez', '45012808869', '45012808869', '804', 'Transporte de Pasajeros y Carga. Camión', '1', 'Paya Juan Vicente # 74, Mayarí', 'Moncada, No. 34', 12, 131, 12, 131, '53187776', NULL, '2019-12-18 13:45:45', '2019-12-18 13:45:45'),
	(2, 'Camión Rey Díaz', 'Rey', 'Díaz Rodríguez', '59011908687', '59011908687', '804', 'Transporte de Pasajeros y Carga. Camión', '1', 'Calle 4ta #36 Paso de la Bola, Mayarí', 'Dirección Fiscal', 3, 24, 3, 24, NULL, NULL, '2023-06-08 01:25:08', '2023-06-08 05:25:08');

-- Volcando estructura para tabla tcpcontable.tcp_obligations
CREATE TABLE IF NOT EXISTS `tcp_obligations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `id_tcp` int unsigned NOT NULL,
  `id_obligation` int unsigned NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- Volcando datos para la tabla tcpcontable.tcp_obligations: ~10 rows (aproximadamente)
INSERT INTO `tcp_obligations` (`id`, `id_tcp`, `id_obligation`) VALUES
	(26, 1, 2),
	(27, 1, 9),
	(28, 1, 7),
	(29, 1, 8),
	(30, 1, 3),
	(85, 2, 2),
	(86, 2, 3),
	(87, 2, 7),
	(88, 2, 8),
	(89, 2, 9);

-- Volcando estructura para tabla tcpcontable.tcp_startsald_cashbox
CREATE TABLE IF NOT EXISTS `tcp_startsald_cashbox` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `id_tcp` int unsigned NOT NULL,
  `date_start` date NOT NULL,
  `sald` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- Volcando datos para la tabla tcpcontable.tcp_startsald_cashbox: ~0 rows (aproximadamente)
INSERT INTO `tcp_startsald_cashbox` (`id`, `id_tcp`, `date_start`, `sald`) VALUES
	(1, 1, '2020-01-01', 3000.00),
	(2, 2, '2023-08-01', 23.00);

-- Volcando estructura para tabla tcpcontable.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rol` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Volcando datos para la tabla tcpcontable.users: ~0 rows (aproximadamente)
INSERT INTO `users` (`id`, `name`, `last_name`, `user`, `password`, `rol`, `created_at`, `updated_at`) VALUES
	(1, 'Tony', 'Machado García', 'admin', '$2y$10$KTF5ZqaBgnQ5l7bCYljq0uk8qFkHBy/rVlzCpFbzTzfGgnbjRwzaO', 'Superadmin', '2019-11-23 11:44:51', '2019-11-23 11:44:51');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
