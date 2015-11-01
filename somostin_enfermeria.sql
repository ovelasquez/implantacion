-- Adminer 4.2.2 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `auditoria`;
CREATE TABLE `auditoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuarios_id` int(11) DEFAULT NULL,
  `fecha_hora` datetime NOT NULL,
  `entidad` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `entidad_id` int(11) NOT NULL,
  `accion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `query` longtext COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_AF4BB49DF01D3B25` (`usuarios_id`),
  CONSTRAINT `FK_AF4BB49DF01D3B25` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `auditoria` (`id`, `usuarios_id`, `fecha_hora`, `entidad`, `entidad_id`, `accion`, `query`, `ip`) VALUES
(1,	1,	'2015-10-31 22:10:07',	'personal',	1,	'insertar',	'',	'192.168.56.1'),
(2,	1,	'2015-10-31 22:11:12',	'especialidades',	1,	'insertar',	'',	'192.168.56.1'),
(3,	1,	'2015-10-31 22:11:49',	'especialidades',	2,	'insertar',	'',	'192.168.56.1'),
(4,	1,	'2015-10-31 22:12:13',	'especialidades',	3,	'insertar',	'',	'192.168.56.1'),
(5,	1,	'2015-10-31 22:12:53',	'especialidades',	4,	'insertar',	'',	'192.168.56.1'),
(6,	1,	'2015-10-31 22:13:31',	'especialidades',	5,	'insertar',	'',	'192.168.56.1'),
(7,	1,	'2015-10-31 22:13:47',	'especialidades',	6,	'insertar',	'',	'192.168.56.1'),
(8,	1,	'2015-10-31 22:14:20',	'especialidades',	7,	'insertar',	'',	'192.168.56.1'),
(9,	1,	'2015-10-31 22:14:40',	'especialidades',	8,	'insertar',	'',	'192.168.56.1'),
(10,	1,	'2015-10-31 22:15:02',	'especialidades',	9,	'insertar',	'',	'192.168.56.1'),
(11,	1,	'2015-10-31 22:15:23',	'especialidades',	10,	'insertar',	'',	'192.168.56.1'),
(12,	1,	'2015-10-31 22:15:42',	'especialidades',	11,	'insertar',	'',	'192.168.56.1'),
(13,	1,	'2015-10-31 22:16:00',	'especialidades',	12,	'insertar',	'',	'192.168.56.1'),
(14,	1,	'2015-10-31 22:17:04',	'personal',	2,	'insertar',	'',	'192.168.56.1'),
(15,	1,	'2015-10-31 22:17:35',	'personal',	3,	'insertar',	'',	'192.168.56.1'),
(16,	1,	'2015-10-31 22:18:10',	'personal',	4,	'insertar',	'',	'192.168.56.1'),
(17,	1,	'2015-10-31 22:18:45',	'personal',	5,	'insertar',	'',	'192.168.56.1'),
(18,	1,	'2015-10-31 22:19:57',	'pfg',	1,	'insertar',	'',	'192.168.56.1'),
(19,	1,	'2015-10-31 22:20:15',	'pfg',	2,	'insertar',	'',	'192.168.56.1'),
(20,	1,	'2015-10-31 22:20:31',	'pfg',	3,	'insertar',	'',	'192.168.56.1'),
(21,	1,	'2015-10-31 22:20:47',	'pfg',	4,	'insertar',	'',	'192.168.56.1'),
(22,	1,	'2015-10-31 22:21:04',	'pfg',	5,	'insertar',	'',	'192.168.56.1'),
(23,	1,	'2015-10-31 22:21:25',	'pfg',	6,	'insertar',	'',	'192.168.56.1'),
(24,	1,	'2015-10-31 22:21:42',	'pfg',	7,	'insertar',	'',	'192.168.56.1'),
(25,	1,	'2015-10-31 22:22:06',	'pfg',	8,	'insertar',	'',	'192.168.56.1'),
(26,	1,	'2015-10-31 22:22:22',	'pfg',	9,	'insertar',	'',	'192.168.56.1'),
(27,	1,	'2015-10-31 22:22:56',	'pfg',	10,	'insertar',	'',	'192.168.56.1'),
(28,	1,	'2015-10-31 22:23:12',	'pfg',	11,	'insertar',	'',	'192.168.56.1'),
(29,	1,	'2015-10-31 22:23:32',	'pfg',	12,	'insertar',	'',	'192.168.56.1'),
(30,	1,	'2015-10-31 22:23:48',	'pfg',	13,	'insertar',	'',	'192.168.56.1'),
(31,	1,	'2015-10-31 22:24:06',	'pfg',	14,	'insertar',	'',	'192.168.56.1'),
(32,	1,	'2015-10-31 22:24:30',	'pfg',	15,	'insertar',	'',	'192.168.56.1'),
(33,	1,	'2015-10-31 22:30:29',	'tiposmedicamentos',	1,	'insertar',	'',	'192.168.56.1'),
(34,	1,	'2015-10-31 22:31:03',	'medicamentos',	1,	'insertar',	'',	'192.168.56.1'),
(35,	1,	'2015-10-31 22:31:33',	'medicamentos',	2,	'insertar',	'',	'192.168.56.1'),
(36,	1,	'2015-10-31 22:31:48',	'tiposmedicamentos',	2,	'insertar',	'',	'192.168.56.1'),
(37,	1,	'2015-10-31 22:32:17',	'medicamentos',	3,	'insertar',	'',	'192.168.56.1'),
(38,	1,	'2015-10-31 22:32:44',	'medicamentos',	4,	'insertar',	'',	'192.168.56.1'),
(39,	1,	'2015-10-31 22:33:00',	'tiposmedicamentos',	3,	'insertar',	'',	'192.168.56.1'),
(40,	1,	'2015-10-31 22:33:35',	'medicamentos',	5,	'insertar',	'',	'192.168.56.1'),
(41,	1,	'2015-10-31 22:34:18',	'tiposmedicamentos',	4,	'insertar',	'',	'192.168.56.1'),
(42,	1,	'2015-10-31 22:34:52',	'medicamentos',	6,	'insertar',	'',	'192.168.56.1'),
(43,	1,	'2015-10-31 22:35:26',	'tiposmedicamentos',	5,	'insertar',	'',	'192.168.56.1'),
(44,	1,	'2015-10-31 22:35:51',	'medicamentos',	7,	'insertar',	'',	'192.168.56.1'),
(45,	1,	'2015-10-31 22:38:12',	'tiposinsumo',	1,	'insertar',	'',	'192.168.56.1'),
(46,	1,	'2015-10-31 22:39:01',	'insumos',	1,	'insertar',	'',	'192.168.56.1'),
(47,	1,	'2015-10-31 22:42:39',	'insumos',	2,	'insertar',	'',	'192.168.56.1'),
(48,	1,	'2015-10-31 22:43:09',	'insumos',	3,	'insertar',	'',	'192.168.56.1'),
(49,	1,	'2015-10-31 22:43:38',	'insumos',	4,	'insertar',	'',	'192.168.56.1'),
(50,	1,	'2015-10-31 22:43:56',	'insumos',	5,	'insertar',	'',	'192.168.56.1'),
(51,	1,	'2015-10-31 22:44:12',	'insumos',	6,	'insertar',	'',	'192.168.56.1'),
(52,	1,	'2015-10-31 22:44:51',	'insumos',	7,	'insertar',	'',	'192.168.56.1'),
(53,	1,	'2015-10-31 22:45:28',	'insumos',	8,	'insertar',	'',	'192.168.56.1'),
(54,	1,	'2015-10-31 22:45:50',	'insumos',	9,	'insertar',	'',	'192.168.56.1');

DROP TABLE IF EXISTS `consultas`;
CREATE TABLE `consultas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuarios_id` int(11) DEFAULT NULL,
  `paciente_id` int(11) DEFAULT NULL,
  `personal_id` int(11) DEFAULT NULL,
  `referencia` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `charla` tinyint(1) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `egreso` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7AC3CEE7F01D3B25` (`usuarios_id`),
  KEY `IDX_7AC3CEE77310DAD4` (`paciente_id`),
  KEY `IDX_7AC3CEE75D430949` (`personal_id`),
  CONSTRAINT `FK_7AC3CEE75D430949` FOREIGN KEY (`personal_id`) REFERENCES `personal` (`id`),
  CONSTRAINT `FK_7AC3CEE77310DAD4` FOREIGN KEY (`paciente_id`) REFERENCES `pacientes` (`id`),
  CONSTRAINT `FK_7AC3CEE7F01D3B25` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `datos`;
CREATE TABLE `datos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `apellidos` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cedula` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_519B2194BF396750` (`id`),
  UNIQUE KEY `UNIQ_519B21947BF39BE0` (`cedula`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `datos` (`id`, `nombres`, `apellidos`, `cedula`) VALUES
(1,	'Super',	'Administrador',	'1234567890'),
(2,	'Maria',	'Vazquez',	'15214789'),
(3,	'Pedro',	'Flores',	'7418523'),
(4,	'Marta',	'Pereira',	'74532895'),
(5,	'Deysi',	'Zambrano',	'74185477'),
(6,	'Delia',	'Azuaje',	'741223552'),
(7,	'Virgilio',	'Centeno',	'21090578'),
(8,	'Pedro',	'Fernández',	'6521452');

DROP TABLE IF EXISTS `especialidades`;
CREATE TABLE `especialidades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `especialidades` (`id`, `nombre`) VALUES
(1,	'Cardiología'),
(2,	'Gastroenterología'),
(3,	'Ginecología Y Obstetricia'),
(4,	'Medicina Interna'),
(5,	'Neumología'),
(6,	'Neurología'),
(7,	'Odontología'),
(8,	'Oftalmología'),
(9,	'Pediatría'),
(10,	'Psicología'),
(11,	'Reumatología'),
(12,	'Urología');

DROP TABLE IF EXISTS `fos_group`;
CREATE TABLE `fos_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_4B019DDB5E237E06` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `fos_group` (`id`, `name`, `roles`) VALUES
(1,	'Super Administrador',	'a:1:{i:0;s:16:\"ROLE_SUPER_ADMIN\";}');

DROP TABLE IF EXISTS `insumos`;
CREATE TABLE `insumos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_insumo_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `stock` int(11) NOT NULL,
  `disponible` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_38497D4E2C4E30D9` (`tipo_insumo_id`),
  CONSTRAINT `FK_38497D4E2C4E30D9` FOREIGN KEY (`tipo_insumo_id`) REFERENCES `tipos_insumo` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `insumos` (`id`, `tipo_insumo_id`, `nombre`, `stock`, `disponible`) VALUES
(1,	1,	'Agua Destilada',	100,	100),
(2,	1,	'Agujas Surecan',	100,	100),
(3,	1,	'Alcohol Clinico 50%',	100,	100),
(4,	1,	'Alcohol Isopropilico (puro)',	100,	100),
(5,	1,	'Algodón Dental Rollitos 1',	100,	100),
(6,	1,	'Algodón En Torundas 500gr.',	100,	100),
(7,	1,	'Algodón Hospitalario En Rollo De: 1 Libra',	100,	100),
(8,	1,	'Algodoneras Diferentes Tamaños',	100,	100),
(9,	1,	'Ampollas P/esterilizar',	100,	100);

DROP TABLE IF EXISTS `insumos_suministrados`;
CREATE TABLE `insumos_suministrados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `consulta_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `insumo_id` int(11) DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_97D1FE28E38D288B` (`consulta_id`),
  KEY `IDX_97D1FE28DB38439E` (`usuario_id`),
  KEY `IDX_97D1FE28CE208F97` (`insumo_id`),
  CONSTRAINT `FK_97D1FE28CE208F97` FOREIGN KEY (`insumo_id`) REFERENCES `insumos` (`id`),
  CONSTRAINT `FK_97D1FE28DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`),
  CONSTRAINT `FK_97D1FE28E38D288B` FOREIGN KEY (`consulta_id`) REFERENCES `consultas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `medicamentos`;
CREATE TABLE `medicamentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_medicamento_id` int(11) DEFAULT NULL,
  `principio_activo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `stock` int(11) NOT NULL,
  `disponible` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F11211E4521FF07C` (`tipo_medicamento_id`),
  CONSTRAINT `FK_F11211E4521FF07C` FOREIGN KEY (`tipo_medicamento_id`) REFERENCES `tipos_medicamento` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `medicamentos` (`id`, `tipo_medicamento_id`, `principio_activo`, `stock`, `disponible`) VALUES
(1,	1,	'Abavir',	100,	100),
(2,	1,	'Kivexa',	100,	100),
(3,	2,	'Brixilón',	10,	10),
(4,	2,	'Bronilis',	50,	50),
(5,	3,	'Bristaflam',	80,	80),
(6,	4,	'Fizoil',	85,	85),
(7,	5,	'Alivax',	50,	50);

DROP TABLE IF EXISTS `medicamentos_suministrados`;
CREATE TABLE `medicamentos_suministrados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `consulta_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `medicamento_id` int(11) DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `via_administracion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8B53CDBE38D288B` (`consulta_id`),
  KEY `IDX_8B53CDBDB38439E` (`usuario_id`),
  KEY `IDX_8B53CDBDECC3FDC` (`medicamento_id`),
  CONSTRAINT `FK_8B53CDBDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`),
  CONSTRAINT `FK_8B53CDBDECC3FDC` FOREIGN KEY (`medicamento_id`) REFERENCES `medicamentos` (`id`),
  CONSTRAINT `FK_8B53CDBE38D288B` FOREIGN KEY (`consulta_id`) REFERENCES `consultas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `observaciones_suministradas`;
CREATE TABLE `observaciones_suministradas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `consulta_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci NOT NULL,
  `tipo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4043B82DE38D288B` (`consulta_id`),
  KEY `IDX_4043B82DDB38439E` (`usuario_id`),
  CONSTRAINT `FK_4043B82DDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`),
  CONSTRAINT `FK_4043B82DE38D288B` FOREIGN KEY (`consulta_id`) REFERENCES `consultas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `pacientes`;
CREATE TABLE `pacientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datos_id` int(11) DEFAULT NULL,
  `pfg_id` int(11) DEFAULT NULL,
  `genero` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tipo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_nacimiento` date NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `procedencia` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_971B785177198A62` (`datos_id`),
  KEY `IDX_971B78519363FD17` (`pfg_id`),
  CONSTRAINT `FK_971B785177198A62` FOREIGN KEY (`datos_id`) REFERENCES `datos` (`id`),
  CONSTRAINT `FK_971B78519363FD17` FOREIGN KEY (`pfg_id`) REFERENCES `pfg` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `personal`;
CREATE TABLE `personal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datos_id` int(11) DEFAULT NULL,
  `especialidad_id` int(11) DEFAULT NULL,
  `procedencia` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tipo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sas` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_F18A6D8477198A62` (`datos_id`),
  KEY `IDX_F18A6D8416A490EC` (`especialidad_id`),
  CONSTRAINT `FK_F18A6D8416A490EC` FOREIGN KEY (`especialidad_id`) REFERENCES `especialidades` (`id`),
  CONSTRAINT `FK_F18A6D8477198A62` FOREIGN KEY (`datos_id`) REFERENCES `datos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `personal` (`id`, `datos_id`, `especialidad_id`, `procedencia`, `tipo`, `sas`) VALUES
(1,	2,	NULL,	'interno',	'enfermera',	NULL),
(2,	3,	1,	'interno',	'doctor',	'12358'),
(3,	4,	2,	'interno',	'doctor',	'8541259'),
(4,	5,	4,	'interno',	'doctor',	'748551515'),
(5,	6,	NULL,	'interno',	'enfermera',	NULL);

DROP TABLE IF EXISTS `pfg`;
CREATE TABLE `pfg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `pfg` (`id`, `nombre`) VALUES
(1,	'Agroecología'),
(2,	'Arquitectura'),
(3,	'Comunicación Social'),
(4,	'Economía Política'),
(5,	'Estudios Jurídicos'),
(6,	'Estudios Políticos Y De Gobierno'),
(7,	'Gas'),
(8,	'Gestión Ambiental'),
(9,	'Gestión En Salud Pública'),
(10,	'Gestión Social Para El Desarrollo Local'),
(11,	'Petróleo'),
(12,	'Informática Para La Gestión Social'),
(13,	'Psicología'),
(14,	'Radioterapia'),
(15,	'Refinación Y Petroquímica');

DROP TABLE IF EXISTS `signos_vitales_suministrados`;
CREATE TABLE `signos_vitales_suministrados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `consulta_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `valor` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_77AE56DBE38D288B` (`consulta_id`),
  KEY `IDX_77AE56DBDB38439E` (`usuario_id`),
  CONSTRAINT `FK_77AE56DBDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`),
  CONSTRAINT `FK_77AE56DBE38D288B` FOREIGN KEY (`consulta_id`) REFERENCES `consultas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `tipos_insumo`;
CREATE TABLE `tipos_insumo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tipos_insumo` (`id`, `nombre`) VALUES
(1,	'Generico');

DROP TABLE IF EXISTS `tipos_medicamento`;
CREATE TABLE `tipos_medicamento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tipos_medicamento` (`id`, `nombre`) VALUES
(1,	'Abacavir'),
(2,	'Acebrofilina'),
(3,	'Aceclofenaco'),
(4,	'Aceite De Pescado'),
(5,	'Acetaminofén');

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datos_id` int(11) DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_EF687F292FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_EF687F2A0D96FBF` (`email_canonical`),
  KEY `IDX_EF687F277198A62` (`datos_id`),
  CONSTRAINT `FK_EF687F277198A62` FOREIGN KEY (`datos_id`) REFERENCES `datos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `usuarios` (`id`, `datos_id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`) VALUES
(1,	1,	'admin',	'admin',	'admin@ubv.edu.ve',	'admin@ubv.edu.ve',	1,	'ds3xj3z0wlwsw0k8swwowwc484g0cco',	'$2y$13$ds3xj3z0wlwsw0k8swwowuvxwOBq/9a9wQpz2u1Rjxlxk7CMyjDam',	'2015-10-31 22:56:19',	0,	0,	NULL,	NULL,	NULL,	'a:0:{}',	0,	NULL),
(2,	7,	'vcenteno',	'vcenteno',	'centeno365.vc@gmail.com',	'centeno365.vc@gmail.com',	1,	's18jhcftfg0sgkgock00ogocgwk8w00',	'$2y$13$s18jhcftfg0sgkgock00oeKK567pi60k6xNhUZiPVkTcOGsTQ/NJa',	'2015-10-31 22:54:01',	0,	0,	NULL,	NULL,	NULL,	'a:0:{}',	0,	NULL),
(3,	8,	'pfernandez',	'pfernandez',	'pedrofernandez18@gmail.com',	'pedrofernandez18@gmail.com',	1,	'7a11ep3k99k4sooksooc4kskco4o40g',	'$2y$13$7a11ep3k99k4sooksooc4eyPGLFhDstjlf/SX1LUKMwJM2LHMWeOK',	'2015-10-31 22:56:07',	0,	0,	NULL,	NULL,	NULL,	'a:0:{}',	0,	NULL);

DROP TABLE IF EXISTS `usuarios_group`;
CREATE TABLE `usuarios_group` (
  `usuarios_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`usuarios_id`,`group_id`),
  KEY `IDX_15F718B8F01D3B25` (`usuarios_id`),
  KEY `IDX_15F718B8FE54D947` (`group_id`),
  CONSTRAINT `FK_15F718B8F01D3B25` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`),
  CONSTRAINT `FK_15F718B8FE54D947` FOREIGN KEY (`group_id`) REFERENCES `fos_group` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `usuarios_group` (`usuarios_id`, `group_id`) VALUES
(1,	1),
(2,	1),
(3,	1);

-- 2015-11-01 17:00:08
