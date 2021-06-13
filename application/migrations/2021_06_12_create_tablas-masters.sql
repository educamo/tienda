/*
 Navicat Premium Data Transfer

 Source Server         : local - PC
 Source Server Type    : MySQL
 Source Server Version : 100138
 Source Host           : localhost:3306
 Source Schema         : tienda

 Target Server Type    : MySQL
 Target Server Version : 100138
 File Encoding         : 65001

 Date: 12/06/2021 02:07:59
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for nu_configuracion
-- ----------------------------
DROP TABLE IF EXISTS `nu_configuracion`;
CREATE TABLE `nu_configuracion`  (
  `idConfig` int(255) NOT NULL AUTO_INCREMENT,
  `nombreConfig` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `valorConfig` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`idConfig`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of nu_configuracion
-- ----------------------------
INSERT INTO `nu_configuracion` VALUES (1, 'logo', 'logo.png');

-- ----------------------------
-- Table structure for nu_modulos
-- ----------------------------
DROP TABLE IF EXISTS `nu_modulos`;
CREATE TABLE `nu_modulos`  (
  `idMod` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Modulo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tipo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `icon` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `activo` int(1) NULL DEFAULT 1,
  PRIMARY KEY (`idMod`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of nu_modulos
-- ----------------------------
INSERT INTO `nu_modulos` VALUES ('config', 'configuracion', 'configuracion', 'modulo', 'administracion/configuracion', ' fa-cogs', 1);
INSERT INTO `nu_modulos` VALUES ('meguser', 'usuarios', 'Cuentas-Usuarios', 'submodulo', NULL, NULL, 1);
INSERT INTO `nu_modulos` VALUES ('peruser', 'usuarios', 'Permisos', 'submodulo', NULL, NULL, 1);
INSERT INTO `nu_modulos` VALUES ('user', 'usuarios', 'usuarios', 'modulo', 'administracion/usuarios', 'fa-group', 1);

-- ----------------------------
-- Table structure for nu_permisosusuarios
-- ----------------------------
DROP TABLE IF EXISTS `nu_permisosusuarios`;
CREATE TABLE `nu_permisosusuarios`  (
  `idPermiso` int(255) NOT NULL AUTO_INCREMENT,
  `idUser` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `idRelacion` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tipoRelacion` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`idPermiso`) USING BTREE,
  INDEX `idUser`(`idUser`) USING BTREE,
  INDEX `idRelacion`(`idRelacion`) USING BTREE,
  CONSTRAINT `idRelacion` FOREIGN KEY (`idRelacion`) REFERENCES `nu_modulos` (`idMod`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `idUser` FOREIGN KEY (`idUser`) REFERENCES `nu_users` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of nu_permisosusuarios
-- ----------------------------
INSERT INTO `nu_permisosusuarios` VALUES (1, '16153887', 'config', 'modulo');
INSERT INTO `nu_permisosusuarios` VALUES (2, '16153887', 'user', 'modulo');
INSERT INTO `nu_permisosusuarios` VALUES (3, '16153887', 'meguser', 'submodulo');
INSERT INTO `nu_permisosusuarios` VALUES (9, '16153887', 'peruser', 'submodulo');

-- ----------------------------
-- Table structure for nu_users
-- ----------------------------
DROP TABLE IF EXISTS `nu_users`;
CREATE TABLE `nu_users`  (
  `idUser` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nombresUsuario` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `apellidosUsuario` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `diereccion` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tlf` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `cel` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `imagenUsuario` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `administrador` int(1) NULL DEFAULT 0,
  `activo` int(1) NULL DEFAULT 0,
  `delete` int(1) NULL DEFAULT 0,
  PRIMARY KEY (`idUser`) USING BTREE,
  UNIQUE INDEX `email`(`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of nu_users
-- ----------------------------
INSERT INTO `nu_users` VALUES ('16153887', 'Cesar', 'Carrasco', NULL, 'educamo@gmail.com', NULL, NULL, 'admin.jpg', 'educamo', '202cb962ac59075b964b07152d234b70', 1, 1, 0);

SET FOREIGN_KEY_CHECKS = 1;
