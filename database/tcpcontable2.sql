/*
 Navicat Premium Data Transfer

 Source Server         : MySQL
 Source Server Type    : MySQL
 Source Server Version : 50733
 Source Host           : localhost:3306
 Source Schema         : tcpcontable

 Target Server Type    : MySQL
 Target Server Version : 50733
 File Encoding         : 65001

 Date: 02/02/2022 14:37:58
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for acnt_accounts
-- ----------------------------
DROP TABLE IF EXISTS `acnt_accounts`;
CREATE TABLE `acnt_accounts`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code_parent` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `code` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `desc` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of acnt_accounts
-- ----------------------------
INSERT INTO `acnt_accounts` VALUES (1, '10.1', '100', 'Efectivo en Caja');
INSERT INTO `acnt_accounts` VALUES (2, '10.1', '110', 'Efectivo en Banco');
INSERT INTO `acnt_accounts` VALUES (3, '10.2', '200', 'Activos Fijos Tangibles');
INSERT INTO `acnt_accounts` VALUES (4, '10.3', '300', 'Depreciación de AFT');
INSERT INTO `acnt_accounts` VALUES (5, '20.1', '470', 'Préstamos Bancarios a Corto Plazo');
INSERT INTO `acnt_accounts` VALUES (6, '20.2', '520', 'Préstamos Bancarios a Largo Plazo');
INSERT INTO `acnt_accounts` VALUES (7, '30', '600', 'Patrimonio del TCP');
INSERT INTO `acnt_accounts` VALUES (8, '30', '610', 'Utilidad Retenida');
INSERT INTO `acnt_accounts` VALUES (9, '30', '620', 'Pérdida');
INSERT INTO `acnt_accounts` VALUES (10, '40.1', '800', 'Gastos de Operación');
INSERT INTO `acnt_accounts` VALUES (11, '40.1', '810', 'Impuestos y Tasas');
INSERT INTO `acnt_accounts` VALUES (12, '40.2', '900', 'Ventas');
INSERT INTO `acnt_accounts` VALUES (13, '50', '999', 'Resultado');

-- ----------------------------
-- Table structure for acnt_groups
-- ----------------------------
DROP TABLE IF EXISTS `acnt_groups`;
CREATE TABLE `acnt_groups`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `desc` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of acnt_groups
-- ----------------------------
INSERT INTO `acnt_groups` VALUES (1, '10', 'Activos');
INSERT INTO `acnt_groups` VALUES (2, '20', 'Pasivos');
INSERT INTO `acnt_groups` VALUES (3, '30', 'Patrimonio');
INSERT INTO `acnt_groups` VALUES (4, '40', 'Nominales');
INSERT INTO `acnt_groups` VALUES (5, '50', 'Cierre');

-- ----------------------------
-- Table structure for acnt_subcounts
-- ----------------------------
DROP TABLE IF EXISTS `acnt_subcounts`;
CREATE TABLE `acnt_subcounts`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_account` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `desc` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of acnt_subcounts
-- ----------------------------
INSERT INTO `acnt_subcounts` VALUES (1, 7, '10', 'Saldo al inicio del ejercicio');
INSERT INTO `acnt_subcounts` VALUES (2, 7, '20', 'Incrementos de aportes del TCP en el ejercicio contable');
INSERT INTO `acnt_subcounts` VALUES (3, 7, '30', 'Erogaciones efectuadas por el TCP en el ejercicio contable');
INSERT INTO `acnt_subcounts` VALUES (4, 7, '40', 'Pagos de Cuotas del Impuesto sobre Ingresos Personales');
INSERT INTO `acnt_subcounts` VALUES (5, 7, '50', 'Contribución a la Seguridad Social');
INSERT INTO `acnt_subcounts` VALUES (6, 10, '11000', 'Materias Primas y Materiales');
INSERT INTO `acnt_subcounts` VALUES (7, 10, '30000', 'Combustible');
INSERT INTO `acnt_subcounts` VALUES (8, 10, '40000', 'Energía Eléctrica');
INSERT INTO `acnt_subcounts` VALUES (9, 10, '50000', 'Remuneraciones al Personal Contratado');
INSERT INTO `acnt_subcounts` VALUES (10, 10, '70000', 'Depreciación de AFT');
INSERT INTO `acnt_subcounts` VALUES (11, 10, '80000', 'Otros Gastos Monetarios y Financieros');
INSERT INTO `acnt_subcounts` VALUES (12, 11, '10', 'Impuesto sobre las Ventas');
INSERT INTO `acnt_subcounts` VALUES (13, 11, '20', 'Impuesto sobre los Servicios Públicos');
INSERT INTO `acnt_subcounts` VALUES (14, 11, '30', 'Impuesto por la Utilización de la Fuerza de Trabajo');
INSERT INTO `acnt_subcounts` VALUES (15, 11, '40', 'Otros Impuestos y Tasas');

-- ----------------------------
-- Table structure for acnt_subgroups
-- ----------------------------
DROP TABLE IF EXISTS `acnt_subgroups`;
CREATE TABLE `acnt_subgroups`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_group` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `desc` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of acnt_subgroups
-- ----------------------------
INSERT INTO `acnt_subgroups` VALUES (1, 1, '10.1', 'Activo Circulante');
INSERT INTO `acnt_subgroups` VALUES (2, 1, '10.2', 'Activos Fijos');
INSERT INTO `acnt_subgroups` VALUES (3, 1, '10.3', 'Reguladoras de Activos');
INSERT INTO `acnt_subgroups` VALUES (4, 2, '20.1', 'Pasivos Circulantes');
INSERT INTO `acnt_subgroups` VALUES (5, 2, '20.2', 'Pasivos a Largo Plazo');
INSERT INTO `acnt_subgroups` VALUES (6, 4, '40.1', 'Deudoras');
INSERT INTO `acnt_subgroups` VALUES (7, 4, '40.2', 'Acreedoras');

-- ----------------------------
-- Table structure for aft_groups
-- ----------------------------
DROP TABLE IF EXISTS `aft_groups`;
CREATE TABLE `aft_groups`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `desc` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of aft_groups
-- ----------------------------
INSERT INTO `aft_groups` VALUES (1, '001', 'Edificaciones');
INSERT INTO `aft_groups` VALUES (2, '002', 'Muebles');
INSERT INTO `aft_groups` VALUES (3, '003', 'Equipos');

-- ----------------------------
-- Table structure for aft_product_subgroup
-- ----------------------------
DROP TABLE IF EXISTS `aft_product_subgroup`;
CREATE TABLE `aft_product_subgroup`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_product` int(10) UNSIGNED NOT NULL,
  `id_subgroup` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of aft_product_subgroup
-- ----------------------------
INSERT INTO `aft_product_subgroup` VALUES (1, 1, 1);
INSERT INTO `aft_product_subgroup` VALUES (3, 2, 2);

-- ----------------------------
-- Table structure for aft_products
-- ----------------------------
DROP TABLE IF EXISTS `aft_products`;
CREATE TABLE `aft_products`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_tcp` int(10) UNSIGNED NOT NULL,
  `id_group` int(10) UNSIGNED NOT NULL,
  `product` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `um` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `ctdad` int(10) NULL DEFAULT NULL,
  `price` decimal(10, 2) NULL DEFAULT NULL,
  `import` decimal(10, 2) NULL DEFAULT NULL,
  `pay_date` date NULL DEFAULT NULL,
  `live_year` decimal(10, 2) NULL DEFAULT NULL,
  `dep_year` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `dep_month` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of aft_products
-- ----------------------------
INSERT INTO `aft_products` VALUES (1, 1, 1, 'Ranchón', 'U', 1, 15000.00, 15000.00, '2019-01-01', 16.60, '900.00', '75.00');
INSERT INTO `aft_products` VALUES (2, 1, 1, 'Baño', 'U', 1, 11000.00, 11000.00, '2019-01-01', 33.30, '330.00', '27.50');
INSERT INTO `aft_products` VALUES (3, 1, 2, 'Banquetas', 'U', 2, 150.00, 300.00, '2019-01-01', 10.00, '30.00', '2.50');
INSERT INTO `aft_products` VALUES (4, 1, 3, 'Batidora', 'U', 1, 600.00, 600.00, '2019-12-11', 10.00, '60.00', '5.00');
INSERT INTO `aft_products` VALUES (5, 1, 2, 'Barra Sala', 'U', 1, 500.00, 500.00, '2019-12-11', 10.00, '50.00', '4.17');
INSERT INTO `aft_products` VALUES (6, 2, 3, 'Camión', 'U', 1, 180000.00, 180000.00, '2010-04-07', 10.00, '18000.00', '1500.00');
INSERT INTO `aft_products` VALUES (7, 1, 3, 'Computadora', 'U', 1, 10000.00, 10000.00, '2021-01-01', 10.00, '1000.00', '83.33');

-- ----------------------------
-- Table structure for aft_subgroups
-- ----------------------------
DROP TABLE IF EXISTS `aft_subgroups`;
CREATE TABLE `aft_subgroups`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_group` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of aft_subgroups
-- ----------------------------
INSERT INTO `aft_subgroups` VALUES (1, 1, 'Madera/Plástico');
INSERT INTO `aft_subgroups` VALUES (2, 1, 'Hormigón/Hierro');

-- ----------------------------
-- Table structure for cash_bank
-- ----------------------------
DROP TABLE IF EXISTS `cash_bank`;
CREATE TABLE `cash_bank`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_tcp` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `desc` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `debit` decimal(10, 2) NULL DEFAULT NULL,
  `credit` decimal(10, 2) NULL DEFAULT NULL,
  `sald` decimal(10, 2) NULL DEFAULT NULL,
  `created_at` datetime(0) NOT NULL,
  `updated_at` datetime(0) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cash_bank
-- ----------------------------
INSERT INTO `cash_bank` VALUES (1, 1, '2020-01-01', 'Saldo al Inicio del Mes', 0.00, 0.00, 1225.97, '2020-02-22 23:06:53', '2020-02-22 23:06:53');
INSERT INTO `cash_bank` VALUES (2, 1, '2020-01-20', 'Depósito en Cuenta', 13756.00, 0.00, NULL, '2020-02-22 23:07:14', '2020-02-22 23:07:55');
INSERT INTO `cash_bank` VALUES (3, 1, '2020-01-20', 'Aporte al presupuesto', 0.00, 2116.30, NULL, '2020-02-22 23:08:06', '2020-02-22 23:08:33');
INSERT INTO `cash_bank` VALUES (4, 1, '2020-01-20', 'Aporte al presupuesto', 0.00, 650.00, NULL, '2020-02-22 23:08:40', '2020-02-22 23:08:54');
INSERT INTO `cash_bank` VALUES (5, 1, '2020-01-20', 'Aporte al presupuesto', 0.00, 114.45, NULL, '2020-02-22 23:09:02', '2020-02-22 23:09:16');
INSERT INTO `cash_bank` VALUES (8, 1, '2020-01-20', 'Aporte al presupuesto', 0.00, 87.50, NULL, '2020-02-23 11:29:03', '2020-02-23 11:29:22');
INSERT INTO `cash_bank` VALUES (9, 1, '2020-01-20', 'Extracción para pagos en efectivo', 0.00, 10007.75, NULL, '2020-02-23 11:31:21', '2020-02-23 11:31:50');
INSERT INTO `cash_bank` VALUES (10, 1, '2020-01-01', 'Compra de Materias Primas y Materiales de Enero', 0.00, 1.00, NULL, '2022-01-31 19:59:07', '2022-01-31 19:59:07');

-- ----------------------------
-- Table structure for cities
-- ----------------------------
DROP TABLE IF EXISTS `cities`;
CREATE TABLE `cities`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_province` int(10) UNSIGNED NOT NULL,
  `city` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 169 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cities
-- ----------------------------
INSERT INTO `cities` VALUES (1, 1, 'Consolación del Sur');
INSERT INTO `cities` VALUES (2, 1, 'Guane');
INSERT INTO `cities` VALUES (3, 1, 'La Palma');
INSERT INTO `cities` VALUES (4, 1, 'Los Palacios');
INSERT INTO `cities` VALUES (5, 1, 'Mantua');
INSERT INTO `cities` VALUES (6, 1, 'Minas de Matahambre');
INSERT INTO `cities` VALUES (7, 1, 'Pinar del Río');
INSERT INTO `cities` VALUES (8, 1, 'San Juan y Martínez');
INSERT INTO `cities` VALUES (9, 1, 'San Luis');
INSERT INTO `cities` VALUES (10, 1, 'Sandino');
INSERT INTO `cities` VALUES (11, 1, 'Viñales');
INSERT INTO `cities` VALUES (12, 2, 'Alquízar');
INSERT INTO `cities` VALUES (13, 2, 'Artemisa');
INSERT INTO `cities` VALUES (14, 2, 'Bahía Honda');
INSERT INTO `cities` VALUES (15, 2, 'Bauta');
INSERT INTO `cities` VALUES (16, 2, 'Caimito');
INSERT INTO `cities` VALUES (17, 2, 'Candelaria');
INSERT INTO `cities` VALUES (18, 2, 'Guanajay');
INSERT INTO `cities` VALUES (19, 2, 'Guira de Melena');
INSERT INTO `cities` VALUES (20, 2, 'Mariel');
INSERT INTO `cities` VALUES (21, 2, 'San Antonio de los Baños');
INSERT INTO `cities` VALUES (22, 2, 'San Cristobal');
INSERT INTO `cities` VALUES (23, 3, 'Arroyo Naranjo');
INSERT INTO `cities` VALUES (24, 3, 'Boyeros');
INSERT INTO `cities` VALUES (25, 3, 'Centro Habana');
INSERT INTO `cities` VALUES (26, 3, 'Cerro');
INSERT INTO `cities` VALUES (27, 3, 'Cotorro');
INSERT INTO `cities` VALUES (28, 3, 'Diez de Octubre');
INSERT INTO `cities` VALUES (29, 3, 'Guanabacoa');
INSERT INTO `cities` VALUES (30, 3, 'Habana del Este');
INSERT INTO `cities` VALUES (31, 3, 'La Habana Vieja');
INSERT INTO `cities` VALUES (32, 3, 'La Lisa');
INSERT INTO `cities` VALUES (33, 3, 'Marianao');
INSERT INTO `cities` VALUES (34, 3, 'Playa');
INSERT INTO `cities` VALUES (35, 3, 'Plaza de la Revolución');
INSERT INTO `cities` VALUES (36, 3, 'Regla');
INSERT INTO `cities` VALUES (37, 3, 'San Miguel del Padrón');
INSERT INTO `cities` VALUES (38, 4, 'Batabanó');
INSERT INTO `cities` VALUES (39, 4, 'Bejucal');
INSERT INTO `cities` VALUES (40, 4, 'Guines');
INSERT INTO `cities` VALUES (41, 4, 'Jaruco');
INSERT INTO `cities` VALUES (42, 4, 'Madruga');
INSERT INTO `cities` VALUES (43, 4, 'Melena del Sur');
INSERT INTO `cities` VALUES (44, 4, 'Nueva Paz');
INSERT INTO `cities` VALUES (45, 4, 'Quivicán');
INSERT INTO `cities` VALUES (46, 4, 'San José de las Lajas');
INSERT INTO `cities` VALUES (47, 4, 'San Nicolás');
INSERT INTO `cities` VALUES (48, 4, 'Santa Cruz del Norte');
INSERT INTO `cities` VALUES (49, 5, 'Calimete');
INSERT INTO `cities` VALUES (50, 5, 'Cárdenas');
INSERT INTO `cities` VALUES (51, 5, 'Ciénaga de Zapata');
INSERT INTO `cities` VALUES (52, 5, 'Colón');
INSERT INTO `cities` VALUES (53, 5, 'Jaguey Grande');
INSERT INTO `cities` VALUES (54, 5, 'Jovellanos');
INSERT INTO `cities` VALUES (55, 5, 'Limonar');
INSERT INTO `cities` VALUES (56, 5, 'Los Arabos');
INSERT INTO `cities` VALUES (57, 5, 'Martí');
INSERT INTO `cities` VALUES (58, 5, 'Matanzas');
INSERT INTO `cities` VALUES (59, 5, 'Pedro Betancourt');
INSERT INTO `cities` VALUES (60, 5, 'Perico');
INSERT INTO `cities` VALUES (61, 5, 'Unión de Reyes');
INSERT INTO `cities` VALUES (62, 6, 'Abreus');
INSERT INTO `cities` VALUES (63, 6, 'Aguada de Pasajeros');
INSERT INTO `cities` VALUES (64, 6, 'Cienfuegos');
INSERT INTO `cities` VALUES (65, 6, 'Cruces');
INSERT INTO `cities` VALUES (66, 6, 'Cumanayagua');
INSERT INTO `cities` VALUES (67, 6, 'Lajas');
INSERT INTO `cities` VALUES (68, 6, 'Palmiras');
INSERT INTO `cities` VALUES (69, 6, 'Rodas');
INSERT INTO `cities` VALUES (70, 7, 'Caibarién');
INSERT INTO `cities` VALUES (71, 7, 'Camajuaní');
INSERT INTO `cities` VALUES (72, 7, 'Cifuentes');
INSERT INTO `cities` VALUES (73, 7, 'Corralillo');
INSERT INTO `cities` VALUES (74, 7, 'Encrucijada');
INSERT INTO `cities` VALUES (75, 7, 'Manicaragua');
INSERT INTO `cities` VALUES (76, 7, 'Placetas');
INSERT INTO `cities` VALUES (77, 7, 'Quemado de Guines');
INSERT INTO `cities` VALUES (78, 7, 'Ranchuelo');
INSERT INTO `cities` VALUES (79, 7, 'San Juan de los Remedios');
INSERT INTO `cities` VALUES (80, 7, 'Sagua la Grande');
INSERT INTO `cities` VALUES (81, 7, 'Santa Clara');
INSERT INTO `cities` VALUES (82, 7, 'Santo Domingo');
INSERT INTO `cities` VALUES (83, 8, 'Cabaiguán');
INSERT INTO `cities` VALUES (84, 8, 'Fomento');
INSERT INTO `cities` VALUES (85, 8, 'Jatibonico');
INSERT INTO `cities` VALUES (86, 8, 'La Sierpe');
INSERT INTO `cities` VALUES (87, 8, 'Santi Spíritus');
INSERT INTO `cities` VALUES (88, 8, 'Taguasco');
INSERT INTO `cities` VALUES (89, 8, 'Trinidad');
INSERT INTO `cities` VALUES (90, 8, 'Yaguajay');
INSERT INTO `cities` VALUES (91, 9, 'Baraguá');
INSERT INTO `cities` VALUES (92, 9, 'Bolivia');
INSERT INTO `cities` VALUES (93, 9, 'Chambas');
INSERT INTO `cities` VALUES (94, 9, 'Ciego de Avila');
INSERT INTO `cities` VALUES (95, 9, 'Ciro Redondo');
INSERT INTO `cities` VALUES (96, 9, 'Florencia');
INSERT INTO `cities` VALUES (97, 9, 'Majagua');
INSERT INTO `cities` VALUES (98, 9, 'Morón');
INSERT INTO `cities` VALUES (99, 9, 'Primero de Enero');
INSERT INTO `cities` VALUES (100, 9, 'Venezuela');
INSERT INTO `cities` VALUES (101, 10, 'Camaguey');
INSERT INTO `cities` VALUES (102, 10, 'Carlos M. de Céspedes');
INSERT INTO `cities` VALUES (103, 10, 'Esmeralda');
INSERT INTO `cities` VALUES (104, 10, 'Florida');
INSERT INTO `cities` VALUES (105, 10, 'Guáimaro');
INSERT INTO `cities` VALUES (106, 10, 'Jimaguayú');
INSERT INTO `cities` VALUES (107, 10, 'Minas');
INSERT INTO `cities` VALUES (108, 10, 'Najasa');
INSERT INTO `cities` VALUES (109, 10, 'Nuevitas');
INSERT INTO `cities` VALUES (110, 10, 'Santa Cruz del Sur');
INSERT INTO `cities` VALUES (111, 10, 'Sibanicú');
INSERT INTO `cities` VALUES (112, 10, 'Sierra de Cubitas');
INSERT INTO `cities` VALUES (113, 10, 'Vertientes');
INSERT INTO `cities` VALUES (114, 11, 'Amancio');
INSERT INTO `cities` VALUES (115, 11, 'Colombia');
INSERT INTO `cities` VALUES (116, 11, 'Jesús Menéndez');
INSERT INTO `cities` VALUES (117, 11, 'Jobabo');
INSERT INTO `cities` VALUES (118, 11, 'Las Tunas');
INSERT INTO `cities` VALUES (119, 11, 'Majibacoa');
INSERT INTO `cities` VALUES (120, 11, 'Manatí');
INSERT INTO `cities` VALUES (121, 11, 'Puerto Padre');
INSERT INTO `cities` VALUES (122, 12, 'Antilla');
INSERT INTO `cities` VALUES (123, 12, 'Baguanos');
INSERT INTO `cities` VALUES (124, 12, 'Banes');
INSERT INTO `cities` VALUES (125, 12, 'Cacocún');
INSERT INTO `cities` VALUES (126, 12, 'Calixto García');
INSERT INTO `cities` VALUES (127, 12, 'Cueto');
INSERT INTO `cities` VALUES (128, 12, 'Frank País');
INSERT INTO `cities` VALUES (129, 12, 'Jibara');
INSERT INTO `cities` VALUES (130, 12, 'Holguín');
INSERT INTO `cities` VALUES (131, 12, 'Mayarí');
INSERT INTO `cities` VALUES (132, 12, 'Moa');
INSERT INTO `cities` VALUES (133, 12, 'Rafael Freire');
INSERT INTO `cities` VALUES (134, 12, 'Sagua de Tánamo');
INSERT INTO `cities` VALUES (135, 12, 'Urbano Noris');
INSERT INTO `cities` VALUES (136, 13, 'Bartolomé Masó');
INSERT INTO `cities` VALUES (137, 13, 'Bayamo');
INSERT INTO `cities` VALUES (138, 13, 'Buey Arriba');
INSERT INTO `cities` VALUES (139, 13, 'Campechuela');
INSERT INTO `cities` VALUES (140, 13, 'Cauto Cristo');
INSERT INTO `cities` VALUES (141, 13, 'Guisa');
INSERT INTO `cities` VALUES (142, 13, 'Jiguaní');
INSERT INTO `cities` VALUES (143, 13, 'Manzanillo');
INSERT INTO `cities` VALUES (144, 13, 'Media Luna');
INSERT INTO `cities` VALUES (145, 13, 'Niquero');
INSERT INTO `cities` VALUES (146, 13, 'Pilón');
INSERT INTO `cities` VALUES (147, 13, 'Río Cauto');
INSERT INTO `cities` VALUES (148, 13, 'Yara');
INSERT INTO `cities` VALUES (149, 14, 'Contramaestre');
INSERT INTO `cities` VALUES (150, 14, 'Guamá');
INSERT INTO `cities` VALUES (151, 14, 'Mella');
INSERT INTO `cities` VALUES (152, 14, 'Palma Soriano');
INSERT INTO `cities` VALUES (153, 14, 'San Luis');
INSERT INTO `cities` VALUES (154, 14, 'Santiago de Cuba');
INSERT INTO `cities` VALUES (155, 14, 'Segundo Frente');
INSERT INTO `cities` VALUES (156, 14, 'Songo-La Maya');
INSERT INTO `cities` VALUES (157, 14, 'Tercer Frente');
INSERT INTO `cities` VALUES (158, 15, 'Baracoa');
INSERT INTO `cities` VALUES (159, 15, 'Caimanera');
INSERT INTO `cities` VALUES (160, 15, 'El Salvador');
INSERT INTO `cities` VALUES (161, 15, 'Guantánamo');
INSERT INTO `cities` VALUES (162, 15, 'Imías');
INSERT INTO `cities` VALUES (163, 15, 'Maisí');
INSERT INTO `cities` VALUES (164, 15, 'Manuel Tames');
INSERT INTO `cities` VALUES (165, 15, 'Niceto Pérez');
INSERT INTO `cities` VALUES (166, 15, 'San Antonio del Sur');
INSERT INTO `cities` VALUES (167, 15, 'Yateras');
INSERT INTO `cities` VALUES (168, 16, 'Nueva Gerona');

-- ----------------------------
-- Table structure for entries
-- ----------------------------
DROP TABLE IF EXISTS `entries`;
CREATE TABLE `entries`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_tcp` int(10) UNSIGNED NULL DEFAULT NULL,
  `date` date NULL DEFAULT NULL,
  `cash_box` decimal(10, 2) NULL DEFAULT NULL,
  `cash_ncei` decimal(10, 2) NULL DEFAULT NULL,
  `detail` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 35 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of entries
-- ----------------------------
INSERT INTO `entries` VALUES (5, 1, '2019-12-01', 3200.00, 0.00, 'Esto es un test', '2019-12-16 14:12:40', '2019-12-16 19:12:40');
INSERT INTO `entries` VALUES (9, 1, '2019-12-03', 4000.00, 0.00, NULL, '2019-12-16 14:20:36', '2019-12-16 19:20:36');
INSERT INTO `entries` VALUES (12, 1, '2019-12-04', 1000.00, 0.00, NULL, '2019-12-16 14:38:32', '2019-12-16 19:38:32');
INSERT INTO `entries` VALUES (13, 1, '2019-11-01', 5000.00, 0.00, NULL, '2019-12-16 23:05:42', '2019-12-16 23:05:42');
INSERT INTO `entries` VALUES (14, 1, '2019-12-02', 1000.00, 0.00, NULL, '2019-12-16 23:32:59', '2019-12-16 23:32:59');
INSERT INTO `entries` VALUES (20, 1, '2019-12-05', 2000.00, 0.00, NULL, '2019-12-21 09:08:53', '2019-12-21 09:08:53');
INSERT INTO `entries` VALUES (21, 1, '2019-12-06', 1000.00, 0.00, NULL, '2019-12-21 10:36:01', '2019-12-21 10:36:01');
INSERT INTO `entries` VALUES (22, 1, '2019-01-01', 1000.00, 0.00, NULL, '2020-01-06 09:02:06', '2020-01-06 09:02:06');
INSERT INTO `entries` VALUES (23, 1, '2020-01-01', 4224.00, 0.00, NULL, '2022-01-30 11:28:36', '2022-01-30 16:28:36');
INSERT INTO `entries` VALUES (24, 1, '2020-01-02', 1000.00, 0.00, NULL, '2020-01-13 15:41:34', '2020-01-13 15:41:34');
INSERT INTO `entries` VALUES (25, 1, '2020-01-03', 1500.00, 0.00, NULL, '2020-01-20 18:51:04', '2020-01-20 18:51:04');
INSERT INTO `entries` VALUES (26, 1, '2020-02-01', 1000.00, 0.00, NULL, '2020-02-17 20:34:42', '2020-02-17 20:34:42');
INSERT INTO `entries` VALUES (27, 1, '2020-01-04', 1000.00, 0.00, NULL, '2020-03-01 11:13:13', '2020-03-01 11:13:13');
INSERT INTO `entries` VALUES (28, 1, '2020-01-05', 900.00, 0.00, NULL, '2020-03-01 11:13:18', '2020-03-01 11:13:18');
INSERT INTO `entries` VALUES (29, 1, '2020-01-06', 1200.00, 0.00, NULL, '2020-03-01 11:13:25', '2020-03-01 11:13:25');
INSERT INTO `entries` VALUES (30, 1, '2020-01-07', 1050.00, 0.00, NULL, '2020-03-01 11:13:35', '2020-03-01 11:13:35');
INSERT INTO `entries` VALUES (31, 1, '2020-01-08', 2000.00, 0.00, NULL, '2020-03-01 11:13:44', '2020-03-01 11:13:44');
INSERT INTO `entries` VALUES (32, 1, '2020-01-09', 1800.00, 0.00, NULL, '2020-03-01 11:13:53', '2020-03-01 11:13:53');
INSERT INTO `entries` VALUES (33, 1, '2020-01-10', 1450.00, 0.00, NULL, '2022-01-30 09:05:25', '2022-01-30 14:05:25');
INSERT INTO `entries` VALUES (34, 1, '2022-01-02', 345.00, 0.00, NULL, '2022-01-31 19:50:01', '2022-01-31 19:50:01');

-- ----------------------------
-- Table structure for expenses
-- ----------------------------
DROP TABLE IF EXISTS `expenses`;
CREATE TABLE `expenses`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_tcp` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `mp_materials` decimal(10, 2) NULL DEFAULT NULL,
  `goods` decimal(10, 2) NULL DEFAULT NULL,
  `fuel` decimal(10, 2) NULL DEFAULT NULL,
  `power` decimal(10, 2) NULL DEFAULT NULL,
  `salary` decimal(10, 2) NULL DEFAULT NULL,
  `col7` decimal(10, 2) NULL DEFAULT NULL,
  `col8` decimal(10, 2) NULL DEFAULT NULL,
  `col9` decimal(10, 2) NULL DEFAULT NULL,
  `col10` decimal(10, 2) NULL DEFAULT NULL,
  `col11` decimal(10, 2) NULL DEFAULT NULL,
  `col12` decimal(10, 2) NULL DEFAULT NULL,
  `others` decimal(10, 2) NULL DEFAULT NULL,
  `lease_state` decimal(10, 2) NULL DEFAULT NULL,
  `col17` decimal(10, 2) NULL DEFAULT NULL,
  `col18` decimal(10, 2) NULL DEFAULT NULL,
  `col19` decimal(10, 2) NULL DEFAULT NULL,
  `expenses_ncei` decimal(10, 2) NULL DEFAULT NULL,
  `cash_box` decimal(10, 2) NULL DEFAULT NULL,
  `cash_bank` decimal(10, 2) NULL DEFAULT NULL,
  `detail` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of expenses
-- ----------------------------
INSERT INTO `expenses` VALUES (1, 1, '2019-12-01', 2000.00, NULL, NULL, NULL, 100.00, 10.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2110.00, NULL, NULL, '2019-12-21 14:20:51', '2020-02-13 03:28:44');
INSERT INTO `expenses` VALUES (2, 1, '2019-12-02', 1000.00, NULL, NULL, NULL, 100.00, 10.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-12-21 14:25:54', '2020-02-12 16:35:14');
INSERT INTO `expenses` VALUES (4, 1, '2019-12-03', 2500.50, NULL, NULL, NULL, 100.00, 10.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-12-21 17:19:21', '2020-02-12 16:35:19');
INSERT INTO `expenses` VALUES (5, 1, '2019-12-04', 3000.00, NULL, NULL, 50.00, 100.00, 10.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-12-21 20:16:14', '2020-02-12 16:35:24');
INSERT INTO `expenses` VALUES (6, 1, '2020-01-01', 1.00, 2.00, 3.00, 4.00, 5.00, 34234.00, 500.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 34249.00, NULL, NULL, '2020-01-13 15:55:37', '2022-01-31 19:53:33');
INSERT INTO `expenses` VALUES (7, 1, '2020-12-01', 500.00, NULL, NULL, NULL, 60.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL, NULL, '2020-01-22 03:46:47', '2020-01-22 03:49:37');
INSERT INTO `expenses` VALUES (8, 1, '2020-01-02', 6.00, 5.00, 8.00, 9.00, 10.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 38.00, NULL, NULL, '2020-01-25 17:39:09', '2022-01-30 16:29:15');
INSERT INTO `expenses` VALUES (9, 1, '2019-01-01', NULL, NULL, NULL, NULL, NULL, 242444.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2020-02-01 20:56:43', '2020-02-01 20:59:15');

-- ----------------------------
-- Table structure for expenses_columns
-- ----------------------------
DROP TABLE IF EXISTS `expenses_columns`;
CREATE TABLE `expenses_columns`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_tcp` int(10) UNSIGNED NOT NULL,
  `col7` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '',
  `col8` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '',
  `col9` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '',
  `col10` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '',
  `col11` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '',
  `col12` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '',
  `col17` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '',
  `col18` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '',
  `col19` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of expenses_columns
-- ----------------------------
INSERT INTO `expenses_columns` VALUES (1, 1, 'Renta', 'Alquiler de local', '', '', '', '', '', '', '');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);

-- ----------------------------
-- Table structure for model_options
-- ----------------------------
DROP TABLE IF EXISTS `model_options`;
CREATE TABLE `model_options`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_tcp` int(10) UNSIGNED NOT NULL,
  `date` date NULL DEFAULT NULL,
  `year` int(10) NULL DEFAULT NULL,
  `model` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `key` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `value` decimal(10, 2) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of model_options
-- ----------------------------
INSERT INTO `model_options` VALUES (1, 1, NULL, 2020, 'states', 'tax_entries', 10400.56, '2020-01-29 20:55:26', '2020-01-30 01:55:26');
INSERT INTO `model_options` VALUES (2, 1, NULL, 2019, 'states', 'tax_entries', 110.00, '2020-01-10 05:09:50', '2020-01-10 10:09:50');
INSERT INTO `model_options` VALUES (3, 1, NULL, 2020, 'states', 'cash_bank', 10.00, '2020-01-21 21:35:07', '2020-01-21 21:35:07');
INSERT INTO `model_options` VALUES (4, 1, NULL, 2020, 'states', 'acc_receiv', 8.00, '2020-01-21 21:47:06', '2020-01-21 21:47:06');
INSERT INTO `model_options` VALUES (5, 1, NULL, 2020, 'states', 'bank_oblig_short', 4.00, '2020-01-21 21:47:31', '2020-01-21 21:47:31');
INSERT INTO `model_options` VALUES (6, 1, NULL, 2020, 'states', 'bank_oblig_long', 7.00, '2020-01-21 21:47:37', '2020-01-21 21:47:37');
INSERT INTO `model_options` VALUES (7, 1, '2020-01-02', NULL, 'regcash', 'bank_deposit', 5.00, '2020-01-31 04:59:20', '2020-01-31 09:59:20');
INSERT INTO `model_options` VALUES (8, 1, '2020-01-01', NULL, 'regcash', 'bank_deposit', 14.56, '2020-01-26 23:07:21', '2020-01-26 23:07:21');
INSERT INTO `model_options` VALUES (9, 1, '2020-01-03', NULL, 'regcash', 'bank_deposit', 25.32, '2020-01-26 23:21:50', '2020-01-26 23:21:50');
INSERT INTO `model_options` VALUES (10, 1, '2020-01-04', NULL, 'regcash', 'bank_deposit', 0.00, '2020-01-31 18:56:28', '2020-01-31 23:56:28');
INSERT INTO `model_options` VALUES (11, 1, '2020-01-11', NULL, 'regcash', 'bank_deposit', 0.00, '2020-01-28 02:01:27', '2020-01-28 02:01:27');
INSERT INTO `model_options` VALUES (12, 1, '2019-02-01', NULL, 'regcash', 'bank_deposit', 5.00, '2020-02-01 15:22:19', '2020-02-01 15:22:19');
INSERT INTO `model_options` VALUES (13, 1, '2019-12-02', NULL, 'regcash', 'bank_deposit', 4500.00, '2020-02-10 03:50:02', '2020-02-10 03:50:02');
INSERT INTO `model_options` VALUES (14, 1, NULL, 2020, 'states', 'plus_contribution', 0.00, '2020-02-04 02:22:16', '2020-02-04 02:22:16');
INSERT INTO `model_options` VALUES (15, 1, '2020-02-01', NULL, 'regcash', 'bank_deposit', 0.00, '2020-02-10 08:50:36', '2020-02-10 08:50:36');
INSERT INTO `model_options` VALUES (16, 1, NULL, 2019, 'states', 'plus_contribution', 20.00, '2020-02-13 14:10:25', '2020-02-13 19:10:25');
INSERT INTO `model_options` VALUES (17, 1, NULL, 2019, 'states', 'other_expenses', 125.50, '2020-02-12 03:04:53', '2020-02-12 03:04:53');
INSERT INTO `model_options` VALUES (18, 1, NULL, 2020, 'states', 'other_expenses', 0.00, '2020-02-13 16:08:53', '2020-02-13 16:08:53');

-- ----------------------------
-- Table structure for obligations
-- ----------------------------
DROP TABLE IF EXISTS `obligations`;
CREATE TABLE `obligations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `obligation` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of obligations
-- ----------------------------
INSERT INTO `obligations` VALUES (1, 'Impuesto Sobre Las Ventas', '011402-2');
INSERT INTO `obligations` VALUES (2, 'Impuesto Sobre Los Servicios', '020102-2');
INSERT INTO `obligations` VALUES (3, 'Tcp', '051012-2');
INSERT INTO `obligations` VALUES (4, 'Regimen Simplificado', '051052-2');
INSERT INTO `obligations` VALUES (5, 'Tasa Por Radicacion De Anuncio Y Propoganda Comercial', '090012-2');
INSERT INTO `obligations` VALUES (6, 'Contribucion Especial De Los Trabajadores A La Seguridad Social', '082013-2');
INSERT INTO `obligations` VALUES (7, 'Impuesto Por La Utilizacion De Fuerza De Trabajo', '061032-2');
INSERT INTO `obligations` VALUES (8, 'Impuesto Sobre El Transporte Terrestre', '071062-2');
INSERT INTO `obligations` VALUES (9, 'Impuesto Sobre Ingresos Personales. Liquidacion Adicional', '053022-2');

-- ----------------------------
-- Table structure for provinces
-- ----------------------------
DROP TABLE IF EXISTS `provinces`;
CREATE TABLE `provinces`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `province` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of provinces
-- ----------------------------
INSERT INTO `provinces` VALUES (1, 'Pinar del Río');
INSERT INTO `provinces` VALUES (2, 'Artemisa');
INSERT INTO `provinces` VALUES (3, 'La Habana');
INSERT INTO `provinces` VALUES (4, 'Mayabeque');
INSERT INTO `provinces` VALUES (5, 'Matanzas');
INSERT INTO `provinces` VALUES (6, 'Cienfuegos');
INSERT INTO `provinces` VALUES (7, 'Villa Clara');
INSERT INTO `provinces` VALUES (8, 'Santi Spíritus');
INSERT INTO `provinces` VALUES (9, 'Ciego de Avila');
INSERT INTO `provinces` VALUES (10, 'Camaguey');
INSERT INTO `provinces` VALUES (11, 'Las Tunas');
INSERT INTO `provinces` VALUES (12, 'Holguín');
INSERT INTO `provinces` VALUES (13, 'Granma');
INSERT INTO `provinces` VALUES (14, 'Santiago de Cuba');
INSERT INTO `provinces` VALUES (15, 'Guantánamo');
INSERT INTO `provinces` VALUES (16, 'Isla de la Juventud');

-- ----------------------------
-- Table structure for tax
-- ----------------------------
DROP TABLE IF EXISTS `tax`;
CREATE TABLE `tax`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_tcp` int(10) UNSIGNED NOT NULL,
  `month` int(10) NOT NULL,
  `year` int(10) NOT NULL,
  `workforce` decimal(10, 2) NULL DEFAULT NULL,
  `documents` decimal(10, 2) NULL DEFAULT NULL,
  `commercial_ads` decimal(10, 2) NULL DEFAULT NULL,
  `social_security` decimal(10, 2) NULL DEFAULT NULL,
  `others` decimal(10, 2) NULL DEFAULT NULL,
  `restoration_repair` decimal(10, 2) NULL DEFAULT NULL,
  `monthly_fee` decimal(10, 2) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tax
-- ----------------------------
INSERT INTO `tax` VALUES (1, 1, 7, 2019, 555.00, NULL, NULL, NULL, NULL, NULL, NULL, '2019-12-21 20:55:29', '2019-12-21 20:55:29');
INSERT INTO `tax` VALUES (2, 1, 4, 2019, 2343.00, NULL, NULL, NULL, NULL, NULL, NULL, '2019-12-21 20:55:43', '2019-12-21 21:09:45');
INSERT INTO `tax` VALUES (3, 1, 12, 2019, 1000.00, NULL, NULL, 87.50, NULL, NULL, 80.00, '2019-12-21 20:58:27', '2020-02-12 16:17:43');
INSERT INTO `tax` VALUES (4, 1, 1, 2019, NULL, NULL, NULL, NULL, NULL, NULL, 100.00, '2019-12-26 20:17:47', '2020-01-10 10:00:56');
INSERT INTO `tax` VALUES (5, 1, 11, 2019, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-12-26 20:21:32', '2019-12-26 20:21:32');
INSERT INTO `tax` VALUES (6, 1, 1, 2020, NULL, NULL, NULL, 87.50, NULL, NULL, NULL, '2020-01-13 15:54:51', '2020-01-13 15:54:51');

-- ----------------------------
-- Table structure for tcp
-- ----------------------------
DROP TABLE IF EXISTS `tcp`;
CREATE TABLE `tcp`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `company` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `last_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ci` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nit` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `act_code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `act_desc` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `workers` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `address` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `address_company` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `province_company` int(10) UNSIGNED NULL DEFAULT NULL,
  `city_company` int(10) UNSIGNED NULL DEFAULT NULL,
  `province` int(10) NULL DEFAULT NULL,
  `city` int(10) NULL DEFAULT NULL,
  `telephone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tcp
-- ----------------------------
INSERT INTO `tcp` VALUES (1, 'Camión Eduardo Semidey', 'Eduardo', 'Semidey Domínguez', '45012808869', '45012808869', '804', 'Transporte de Pasajeros y Carga. Camión', '1', 'Paya Juan Vicente # 74, Mayarí', 'Moncada, No. 34', 12, 131, 12, 131, '53187776', NULL, '2019-12-18 08:45:45', '2019-12-18 08:45:45');
INSERT INTO `tcp` VALUES (2, 'Camión Rey Díaz', 'Rey', 'Díaz Rodríguez', '59011908687', '59011908687', '804', 'Transporte de Pasajeros y Carga. Camión', '1', 'Calle 4ta #36 Paso de la Bola, Mayarí', 'Dirección Fiscal', NULL, NULL, NULL, NULL, NULL, NULL, '2019-12-03 10:45:44', '2019-12-03 10:45:44');
INSERT INTO `tcp` VALUES (3, 'Paladar Delicias', 'Tony', 'Machado García', '84102722667', '84102722667', '123', 'Restaurant', '5', 'Moncada, Edificio 2, Apto 6', 'Leyte Vidal, #85', 12, 131, 12, 131, '55047718', 'semti@gmail.com', '2019-12-17 12:37:54', '2019-12-17 17:37:54');

-- ----------------------------
-- Table structure for tcp_obligations
-- ----------------------------
DROP TABLE IF EXISTS `tcp_obligations`;
CREATE TABLE `tcp_obligations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_tcp` int(10) UNSIGNED NOT NULL,
  `id_obligation` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 85 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tcp_obligations
-- ----------------------------
INSERT INTO `tcp_obligations` VALUES (26, 1, 2);
INSERT INTO `tcp_obligations` VALUES (27, 1, 9);
INSERT INTO `tcp_obligations` VALUES (28, 1, 7);
INSERT INTO `tcp_obligations` VALUES (29, 1, 8);
INSERT INTO `tcp_obligations` VALUES (30, 1, 3);
INSERT INTO `tcp_obligations` VALUES (31, 2, 2);
INSERT INTO `tcp_obligations` VALUES (32, 2, 3);
INSERT INTO `tcp_obligations` VALUES (33, 2, 7);
INSERT INTO `tcp_obligations` VALUES (34, 2, 8);
INSERT INTO `tcp_obligations` VALUES (35, 2, 9);
INSERT INTO `tcp_obligations` VALUES (78, 3, 3);
INSERT INTO `tcp_obligations` VALUES (79, 3, 1);
INSERT INTO `tcp_obligations` VALUES (80, 3, 2);
INSERT INTO `tcp_obligations` VALUES (81, 3, 5);
INSERT INTO `tcp_obligations` VALUES (82, 3, 6);
INSERT INTO `tcp_obligations` VALUES (83, 3, 7);
INSERT INTO `tcp_obligations` VALUES (84, 3, 9);

-- ----------------------------
-- Table structure for tcp_startsald_cashbox
-- ----------------------------
DROP TABLE IF EXISTS `tcp_startsald_cashbox`;
CREATE TABLE `tcp_startsald_cashbox`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_tcp` int(10) UNSIGNED NOT NULL,
  `date_start` date NOT NULL,
  `sald` decimal(10, 2) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tcp_startsald_cashbox
-- ----------------------------
INSERT INTO `tcp_startsald_cashbox` VALUES (1, 1, '2020-01-01', 3000.00);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rol` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Tony', 'Machado García', 'admin', '$2y$10$KTF5ZqaBgnQ5l7bCYljq0uk8qFkHBy/rVlzCpFbzTzfGgnbjRwzaO', 'Superadmin', '2019-11-23 06:44:51', '2019-11-23 06:44:51');

SET FOREIGN_KEY_CHECKS = 1;
