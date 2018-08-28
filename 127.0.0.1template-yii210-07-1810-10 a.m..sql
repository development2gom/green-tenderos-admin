# ************************************************************
# Sequel Pro SQL dump
# Versión 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.6.38)
# Base de datos: template-yii2
# Tiempo de Generación: 2018-07-10 3:10:22 p.m. +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Volcado de tabla auth_assignment
# ------------------------------------------------------------

DROP TABLE IF EXISTS `auth_assignment`;

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `auth_assignment_user_id_idx` (`user_id`),
  CONSTRAINT `FK_auth_assignment_mod_usuarios_ent_usuarios` FOREIGN KEY (`user_id`) REFERENCES `mod_usuarios_ent_usuarios` (`id_usuario`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `auth_assignment` WRITE;
/*!40000 ALTER TABLE `auth_assignment` DISABLE KEYS */;

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`)
VALUES
	('super-admin',1,NULL);

/*!40000 ALTER TABLE `auth_assignment` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla auth_item
# ------------------------------------------------------------

DROP TABLE IF EXISTS `auth_item`;

CREATE TABLE `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `auth_item` WRITE;
/*!40000 ALTER TABLE `auth_item` DISABLE KEYS */;

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`)
VALUES
	('admin',1,'Administrador del sistema',NULL,NULL,NULL,NULL),
	('super-admin',1,'Super administrador del sistema',NULL,NULL,NULL,NULL),
	('usuario-normal',1,'Usuario normal',NULL,NULL,NULL,NULL);

/*!40000 ALTER TABLE `auth_item` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla auth_item_child
# ------------------------------------------------------------

DROP TABLE IF EXISTS `auth_item_child`;

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `auth_item_child` WRITE;
/*!40000 ALTER TABLE `auth_item_child` DISABLE KEYS */;

INSERT INTO `auth_item_child` (`parent`, `child`)
VALUES
	('super-admin','admin');

/*!40000 ALTER TABLE `auth_item_child` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla auth_rule
# ------------------------------------------------------------

DROP TABLE IF EXISTS `auth_rule`;

CREATE TABLE `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Volcado de tabla mod_usuarios_cat_status_sesiones
# ------------------------------------------------------------

DROP TABLE IF EXISTS `mod_usuarios_cat_status_sesiones`;

CREATE TABLE `mod_usuarios_cat_status_sesiones` (
  `id_status` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `txt_nombre` varchar(50) NOT NULL COMMENT 'Estatus de la sesión',
  `txt_descripcion` varchar(500) DEFAULT NULL COMMENT 'Descripción del elemento',
  `b_habilitado` int(10) unsigned NOT NULL DEFAULT '1' COMMENT 'Booleano para saber si el registro esta habilitado',
  PRIMARY KEY (`id_status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Volcado de tabla mod_usuarios_cat_status_usuarios
# ------------------------------------------------------------

DROP TABLE IF EXISTS `mod_usuarios_cat_status_usuarios`;

CREATE TABLE `mod_usuarios_cat_status_usuarios` (
  `id_status` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `txt_nombre` varchar(50) NOT NULL COMMENT 'Estatus del usuario',
  `txt_descripcion` varchar(500) DEFAULT NULL COMMENT 'Descripción del elemento',
  `b_habilitado` int(10) unsigned NOT NULL DEFAULT '1' COMMENT 'Booleano para saber si el registro esta habilitado',
  PRIMARY KEY (`id_status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `mod_usuarios_cat_status_usuarios` WRITE;
/*!40000 ALTER TABLE `mod_usuarios_cat_status_usuarios` DISABLE KEYS */;

INSERT INTO `mod_usuarios_cat_status_usuarios` (`id_status`, `txt_nombre`, `txt_descripcion`, `b_habilitado`)
VALUES
	(1,'Pendiente',NULL,1),
	(2,'Activo',NULL,1),
	(3,'Bloqueado',NULL,1);

/*!40000 ALTER TABLE `mod_usuarios_cat_status_usuarios` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla mod_usuarios_cat_tipos_usuarios
# ------------------------------------------------------------

DROP TABLE IF EXISTS `mod_usuarios_cat_tipos_usuarios`;

CREATE TABLE `mod_usuarios_cat_tipos_usuarios` (
  `id_tipo_usuario` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `txt_nombre` varchar(100) NOT NULL,
  `txt_descripcion` varchar(500) NOT NULL,
  `b_habiliado` int(10) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_tipo_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Volcado de tabla mod_usuarios_ent_sesiones
# ------------------------------------------------------------

DROP TABLE IF EXISTS `mod_usuarios_ent_sesiones`;

CREATE TABLE `mod_usuarios_ent_sesiones` (
  `id_sesion` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_usuario` int(10) unsigned NOT NULL COMMENT 'Id del usuario que inicio sesión',
  `id_status` int(10) unsigned NOT NULL DEFAULT '1' COMMENT 'Status de la sesión',
  `fch_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en la que el usuario inicio sesión',
  `fch_logout` timestamp NULL DEFAULT NULL COMMENT 'Fecha en la que el usuario finalizo la sesión',
  `num_minutos_sesion` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Minutos que duraro la sesión del usuario',
  `txt_ip` varchar(32) NOT NULL COMMENT 'Ip de donde se conecto el usuario',
  `txt_ip_logout` varchar(32) DEFAULT NULL COMMENT 'Ip de donde el usuario se desconecto',
  PRIMARY KEY (`id_sesion`),
  KEY `FK_ent_sesiones_cat_status_sesiones` (`id_status`),
  KEY `FK_ent_sesiones_ent_usuarios` (`id_usuario`),
  CONSTRAINT `FK_ent_sesiones_cat_status_sesiones` FOREIGN KEY (`id_status`) REFERENCES `mod_usuarios_cat_status_sesiones` (`id_status`),
  CONSTRAINT `FK_ent_sesiones_ent_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `mod_usuarios_ent_usuarios` (`id_usuario`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Volcado de tabla mod_usuarios_ent_usuarios
# ------------------------------------------------------------

DROP TABLE IF EXISTS `mod_usuarios_ent_usuarios`;

CREATE TABLE `mod_usuarios_ent_usuarios` (
  `id_usuario` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_codigo` int(11) DEFAULT NULL,
  `txt_auth_item` varchar(64) NOT NULL,
  `txt_token` varchar(100) NOT NULL DEFAULT '0',
  `txt_imagen` varchar(200) DEFAULT NULL,
  `txt_username` varchar(255) NOT NULL,
  `txt_apellido_paterno` varchar(30) DEFAULT NULL,
  `txt_apellido_materno` varchar(30) DEFAULT NULL,
  `txt_auth_key` varchar(32) NOT NULL,
  `txt_password_hash` varchar(255) NOT NULL,
  `txt_password_reset_token` varchar(255) DEFAULT NULL,
  `txt_email` varchar(255) NOT NULL,
  `fch_creacion` timestamp NULL DEFAULT NULL,
  `fch_actualizacion` datetime DEFAULT NULL,
  `id_status` int(10) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `txt_token` (`txt_token`),
  UNIQUE KEY `password_reset_token` (`txt_password_reset_token`),
  KEY `FK_ent_usuarios_cat_status_usuarios` (`id_status`),
  KEY `FK_mod_usuarios_ent_usuarios_auth_item` (`txt_auth_item`),
  CONSTRAINT `FK_ent_usuarios_cat_status_usuarios` FOREIGN KEY (`id_status`) REFERENCES `mod_usuarios_cat_status_usuarios` (`id_status`) ON DELETE CASCADE,
  CONSTRAINT `FK_mod_usuarios_ent_usuarios_auth_item` FOREIGN KEY (`txt_auth_item`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `mod_usuarios_ent_usuarios` WRITE;
/*!40000 ALTER TABLE `mod_usuarios_ent_usuarios` DISABLE KEYS */;

INSERT INTO `mod_usuarios_ent_usuarios` (`id_usuario`, `id_codigo`, `txt_auth_item`, `txt_token`, `txt_imagen`, `txt_username`, `txt_apellido_paterno`, `txt_apellido_materno`, `txt_auth_key`, `txt_password_hash`, `txt_password_reset_token`, `txt_email`, `fch_creacion`, `fch_actualizacion`, `id_status`)
VALUES
	(1,NULL,'super-admin','usr7ca3eac6636e602cf7fdf8f65b89446c5a00b2c16e211',NULL,'Admin','-','','aOa5yucU8iyhmiqY2S7ezOr4D8_HE9T0','$2y$13$kVe8cvZ2Px.0SWVWr1PJuucVuw4gWpTHAxjbShvTWNfO4.x3riFf6',NULL,'development@2gom.com.mx','2017-11-07 22:06:42',NULL,2);

/*!40000 ALTER TABLE `mod_usuarios_ent_usuarios` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla mod_usuarios_ent_usuarios_activacion
# ------------------------------------------------------------

DROP TABLE IF EXISTS `mod_usuarios_ent_usuarios_activacion`;

CREATE TABLE `mod_usuarios_ent_usuarios_activacion` (
  `id_usuario_activacion` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_usuario` int(10) unsigned NOT NULL,
  `txt_token` varchar(60) NOT NULL,
  `txt_ip_activacion` varchar(60) DEFAULT NULL,
  `fch_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fch_activacion` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_usuario_activacion`),
  UNIQUE KEY `txt_token` (`txt_token`),
  KEY `FK_ent_usuarios_activacion_ent_usuarios` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `mod_usuarios_ent_usuarios_activacion` WRITE;
/*!40000 ALTER TABLE `mod_usuarios_ent_usuarios_activacion` DISABLE KEYS */;

INSERT INTO `mod_usuarios_ent_usuarios_activacion` (`id_usuario_activacion`, `id_usuario`, `txt_token`, `txt_ip_activacion`, `fch_creacion`, `fch_activacion`)
VALUES
	(1,7,'actf3a153330f3d2c02b06de0c8d89268905a9b3486a19af',NULL,'2018-03-04 00:49:26',NULL),
	(2,8,'actf3c89630b4d9e05e2b0212c1a666cd315a9b39c531975',NULL,'2018-03-04 01:11:49',NULL),
	(3,9,'act44b58ae1e5baf9b2f354487c2ed637195a9b3a0697f42',NULL,'2018-03-04 01:12:54',NULL),
	(4,10,'act19445cbfbe7239942c13c9b6e300b6c05a9b3a34a9282','::1','2018-03-04 01:13:40','2018-03-04 01:14:01'),
	(5,12,'actc59ccb791fba001b08fe6ad47b4f53515a9b45610d8b5',NULL,'2018-03-04 02:01:21',NULL);

/*!40000 ALTER TABLE `mod_usuarios_ent_usuarios_activacion` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla mod_usuarios_ent_usuarios_cambio_pass
# ------------------------------------------------------------

DROP TABLE IF EXISTS `mod_usuarios_ent_usuarios_cambio_pass`;

CREATE TABLE `mod_usuarios_ent_usuarios_cambio_pass` (
  `id_usuario_cambio_pass` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_usuario` int(10) unsigned NOT NULL,
  `txt_token` varchar(60) NOT NULL COMMENT 'Token del registro',
  `txt_ip` varchar(20) NOT NULL COMMENT 'Ip del usuario donde pidio el cambio de pass',
  `txt_ip_cambio` varchar(20) DEFAULT NULL COMMENT 'Ip del usuario donde cambio el pass',
  `fch_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha de creacion de registro',
  `fch_finalizacion` timestamp NULL DEFAULT NULL COMMENT 'Fecha de expiracion de la solicitud de cambio de pass',
  `fch_peticion_usada` timestamp NULL DEFAULT NULL COMMENT 'Fecha en la cual se utilizo la peticion',
  `b_usado` int(1) unsigned NOT NULL DEFAULT '0' COMMENT 'Booleano para saber si el usuario ha usado la peticion',
  PRIMARY KEY (`id_usuario_cambio_pass`),
  KEY `FK_ent_usuarios_cambio_pass_ent_usuarios` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Volcado de tabla mod_usuarios_ent_usuarios_facebook
# ------------------------------------------------------------

DROP TABLE IF EXISTS `mod_usuarios_ent_usuarios_facebook`;

CREATE TABLE `mod_usuarios_ent_usuarios_facebook` (
  `id_usuario_facebook` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_usuario` int(10) unsigned NOT NULL,
  `id_facebook` bigint(20) NOT NULL,
  `txt_url_photo` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id_usuario_facebook`),
  UNIQUE KEY `id_usuario` (`id_usuario`),
  UNIQUE KEY `id_facebook` (`id_facebook`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
