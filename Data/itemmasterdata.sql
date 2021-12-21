/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100406
 Source Host           : localhost:3306
 Source Schema         : dbpos

 Target Server Type    : MySQL
 Target Server Version : 100406
 File Encoding         : 65001

 Date: 16/11/2020 17:42:45
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for itemmasterdata
-- ----------------------------
DROP TABLE IF EXISTS `itemmasterdata`;
CREATE TABLE `itemmasterdata`  (
  `ItemCode` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `KodeItemLama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ItemName` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `A_Warna` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `A_Motif` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `A_Size` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `A_Sex` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `DefaultPrice` decimal(10, 2) NOT NULL,
  `EcomPrice` decimal(16, 2) NOT NULL,
  `ItemGroup` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL COMMENT '1: Penjualan,2:Pembelian,3:ATK',
  `Satuan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Createdby` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Createdon` datetime(0) NOT NULL,
  `LastUpdatedby` varchar(0) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `LastUpdatedon` datetime(0) NULL DEFAULT NULL,
  `isActive` int(1) NOT NULL,
  `BeratStandar` double(16, 2) NULL DEFAULT NULL,
  `Hpp` decimal(16, 2) NULL DEFAULT 0,
  PRIMARY KEY (`ItemCode`) USING BTREE,
  INDEX `Article`(`A_Warna`, `A_Motif`, `A_Size`, `A_Sex`) USING BTREE,
  INDEX `A_Motif`(`A_Motif`) USING BTREE,
  INDEX `F_Size`(`A_Size`) USING BTREE,
  INDEX `F_Sex`(`A_Sex`) USING BTREE,
  CONSTRAINT `F_Motif` FOREIGN KEY (`A_Motif`) REFERENCES `articlemotif` (`ArticleCode`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `F_Sex` FOREIGN KEY (`A_Sex`) REFERENCES `articlesex` (`ArticleCode`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `F_Size` FOREIGN KEY (`A_Size`) REFERENCES `articlesize` (`ArticleCode`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `F_Warna` FOREIGN KEY (`A_Warna`) REFERENCES `articlewarna` (`ArticleCode`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of itemmasterdata
-- ----------------------------
INSERT INTO `itemmasterdata` VALUES ('101.0001', 'CVT6-20-10-03', 'AMALFI HIJAU-T', '1008', '2001', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 13027.72);
INSERT INTO `itemmasterdata` VALUES ('101.0002', 'BTK146', 'ANIMAL FACE-K', '1013', '2002', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 14000.00);
INSERT INTO `itemmasterdata` VALUES ('101.0003', 'PBK76', 'BABY PANDA-K', '1006', '2003', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 13532.98);
INSERT INTO `itemmasterdata` VALUES ('101.0004', 'PBK77', 'BABY PANDA-K', '1021', '2003', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 13532.98);
INSERT INTO `itemmasterdata` VALUES ('101.0005', 'CVT12-20-10-04', 'BANANA LEAVES NAVY-T', '1013', '2004', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 13177.72);
INSERT INTO `itemmasterdata` VALUES ('101.0006', 'PBK74', 'BATMAN BOOM-K', '1006', '2005', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 9430.88);
INSERT INTO `itemmasterdata` VALUES ('101.0007', 'PBK75', 'BATMAN BOOM-K', '1013', '2005', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 9431.19);
INSERT INTO `itemmasterdata` VALUES ('101.0008', 'BTK159', 'BEAR CARTOON-K', '1020', '2006', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 13000.00);
INSERT INTO `itemmasterdata` VALUES ('101.0009', 'BSK14', 'BEAR FACE-K', '1013', '2007', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 10000.00);
INSERT INTO `itemmasterdata` VALUES ('101.0010', 'PBK70', 'BEAR FACE-K', '1007', '2007', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 9435.63);
INSERT INTO `itemmasterdata` VALUES ('101.0011', 'PBK79-20-10-01', 'BOLA BASKET-K', '1013', '2008', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 8177.06);
INSERT INTO `itemmasterdata` VALUES ('101.0012', 'PBK82-20-10-01', 'BOLA BASKET-K', '1009', '2008', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 8170.80);
INSERT INTO `itemmasterdata` VALUES ('101.0013', 'PMA11-20-10-04', 'BULAN BINTANG HIJAU-AB', '1008', '2009', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 9277.72);
INSERT INTO `itemmasterdata` VALUES ('101.0014', 'PBA18', 'BULAN SABIT-AB', '1021', '2010', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 7853.84);
INSERT INTO `itemmasterdata` VALUES ('101.0015', 'BTK184', 'CARS CHAMPION-K', '1013', '2011', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 13532.98);
INSERT INTO `itemmasterdata` VALUES ('101.0016', 'PMT1-20-10-04', 'DAUN DANAR BIRU-T', '1003', '2012', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 9277.72);
INSERT INTO `itemmasterdata` VALUES ('101.0017', 'PMT3-20-10-04', 'DAUN DANAR HITAM-T', '1009', '2013', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 9277.72);
INSERT INTO `itemmasterdata` VALUES ('101.0018', 'PMT2-20-10-04', 'DAUN DANAR MAROON-T', '1011', '2014', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 9277.72);
INSERT INTO `itemmasterdata` VALUES ('101.0019', 'CVT17-20-10-04', 'DAUN SHERRY HIJAU-T', '1008', '2015', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 13027.72);
INSERT INTO `itemmasterdata` VALUES ('101.0020', 'PBK22', 'DORAEMON CATUR-K', '1006', '2016', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 10000.00);
INSERT INTO `itemmasterdata` VALUES ('101.0021', 'BSK37', 'DORAEMON EARTH-K', '1017', '2017', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 10000.00);
INSERT INTO `itemmasterdata` VALUES ('101.0022', 'BTK65', 'DORAEMON EARTH-K', '1017', '2017', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 14000.00);
INSERT INTO `itemmasterdata` VALUES ('101.0023', 'PBK59', 'DORAEMON WHITE-K', '1013', '2018', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 10000.00);
INSERT INTO `itemmasterdata` VALUES ('101.0024', 'CVA8-20-10-04', 'DUO JASS ORANYE-AB', '1014', '2019', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 13027.72);
INSERT INTO `itemmasterdata` VALUES ('101.0025', 'PBK69', 'ELMO FACE-K', '1017', '2020', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 10000.00);
INSERT INTO `itemmasterdata` VALUES ('101.0026', 'BTK165', 'ELMO FACE-K', '1004', '2020', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 9443.55);
INSERT INTO `itemmasterdata` VALUES ('101.0027', 'BTK166', 'ELMO FACE-K', '1006', '2020', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 9585.61);
INSERT INTO `itemmasterdata` VALUES ('101.0028', 'BTK172', 'FLAMINGGO SUMMER-K', '1021', '2021', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 13532.98);
INSERT INTO `itemmasterdata` VALUES ('101.0029', 'BTK173', 'FLAMINGGO SUMMER-K', '1015', '2021', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 13532.98);
INSERT INTO `itemmasterdata` VALUES ('101.0030', 'PMK16-20-10-04', 'FLAMINGGO TOSCA-K', '1018', '2022', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 9277.72);
INSERT INTO `itemmasterdata` VALUES ('101.0031', 'PBK73', 'FLAMINGGO TROPICAL-K', '1018', '2023', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 8166.85);
INSERT INTO `itemmasterdata` VALUES ('101.0032', 'PBK81-20-10-01', 'HELIKOPTER-K', '1009', '2024', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 8469.74);
INSERT INTO `itemmasterdata` VALUES ('101.0033', 'PBK67', 'HELLO KITTY-K', '1005', '2025', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 10000.00);
INSERT INTO `itemmasterdata` VALUES ('101.0034', 'CVT10-20-10-04', 'KANAYA HITAM-T', '1009', '2026', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 13177.72);
INSERT INTO `itemmasterdata` VALUES ('101.0035', 'CVT4-20-10-03', 'KEITARO ABU-AB', '1001', '2027', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 13177.72);
INSERT INTO `itemmasterdata` VALUES ('101.0036', 'PMK11-20-10-03', 'KEPALA BEAR NAVY-K', '1013', '2028', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 9277.72);
INSERT INTO `itemmasterdata` VALUES ('101.0037', 'PBK5', 'KITTY-K', '1013', '2029', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 10000.00);
INSERT INTO `itemmasterdata` VALUES ('101.0038', 'PBK62', 'KITTY-K', '1017', '2029', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 10000.00);
INSERT INTO `itemmasterdata` VALUES ('101.0039', 'PMA8-20-10-04', 'KOTAK MERAH-AB', '1012', '2030', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 9427.72);
INSERT INTO `itemmasterdata` VALUES ('101.0040', 'PBT9', 'LEAF-T', '1002', '2031', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 13690.88);
INSERT INTO `itemmasterdata` VALUES ('101.0041', 'PJK5', 'LEOPARD-K', '1019', '2032', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 10000.00);
INSERT INTO `itemmasterdata` VALUES ('101.0042', 'BTK157', 'MICKEY FLASH-K', '1020', '2033', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 14000.00);
INSERT INTO `itemmasterdata` VALUES ('101.0043', 'BSK72', 'MICKEY MOUSE-K', '1013', '2034', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 10000.00);
INSERT INTO `itemmasterdata` VALUES ('101.0044', 'PBK71', 'MICKEY MOUSE-K', '1013', '2034', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 9585.61);
INSERT INTO `itemmasterdata` VALUES ('101.0045', 'PBK72', 'MICKEY MOUSE-K', '1021', '2034', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 9585.61);
INSERT INTO `itemmasterdata` VALUES ('101.0046', 'PBK68', 'MINION-K', '1006', '2035', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 8963.75);
INSERT INTO `itemmasterdata` VALUES ('101.0047', 'CVT15-20-10-04', 'MONSTERA NEW HITAM-T', '1009', '2036', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 13177.72);
INSERT INTO `itemmasterdata` VALUES ('101.0048', 'JKK4', 'OWL-K', '1017', '2037', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 13000.00);
INSERT INTO `itemmasterdata` VALUES ('101.0049', 'JKK5', 'OWL-K', '1013', '2037', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 13000.00);
INSERT INTO `itemmasterdata` VALUES ('101.0050', 'CVA7-20-10-04', 'OZAKA NAVY-AB', '1013', '2038', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 13177.72);
INSERT INTO `itemmasterdata` VALUES ('101.0051', 'CVA6-20-10-04', 'OZAKA PUTIH-AB', '1016', '2039', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 13177.72);
INSERT INTO `itemmasterdata` VALUES ('101.0052', 'CVT16-20-10-04', 'PALMA HIJAU-T', '1008', '2040', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 13177.72);
INSERT INTO `itemmasterdata` VALUES ('101.0053', 'CVT7-20-10-03', 'PALMA PUTIH-T', '1016', '2041', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 13177.72);
INSERT INTO `itemmasterdata` VALUES ('101.0054', 'PBK80-20-10-01', 'PANDA-K', '1009', '2042', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 8177.06);
INSERT INTO `itemmasterdata` VALUES ('101.0055', 'CVT11-20-10-04', 'PAULINI PUTIH-T', '1016', '2043', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 13177.72);
INSERT INTO `itemmasterdata` VALUES ('101.0056', 'BTK147', 'PIKACHU-K', '1013', '2044', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 14000.00);
INSERT INTO `itemmasterdata` VALUES ('101.0057', 'BTK149', 'POOH AND FRIENDS-K', '1021', '2045', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 13000.00);
INSERT INTO `itemmasterdata` VALUES ('101.0058', 'PMK3-20-10-02', 'POOH NAVY-K', '1013', '2046', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 9277.72);
INSERT INTO `itemmasterdata` VALUES ('101.0059', 'PMK9-20-10-03', 'POOH NAVY-AB', '1013', '2046', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 9277.72);
INSERT INTO `itemmasterdata` VALUES ('101.0060', 'BTK155', 'POWER PUFF GIRL-K', '1018', '2047', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 14000.00);
INSERT INTO `itemmasterdata` VALUES ('101.0061', 'BTK168', 'RABBIT MINI-K', '1021', '2048', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 9585.61);
INSERT INTO `itemmasterdata` VALUES ('101.0062', 'BTK169', 'RABBIT MINI-K', '1015', '2048', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 9585.61);
INSERT INTO `itemmasterdata` VALUES ('101.0063', 'PMK15-20-10-04', 'ROCKET CRAYON ABU-K', '1001', '2049', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 9277.72);
INSERT INTO `itemmasterdata` VALUES ('101.0064', 'PMK13-20-10-04', 'ROCKET CRAYON HITAM-K', '1009', '2050', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 9277.72);
INSERT INTO `itemmasterdata` VALUES ('101.0065', 'PMK14-20-10-04', 'ROCKET CRAYON NAVY-K', '1013', '2051', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 9277.72);
INSERT INTO `itemmasterdata` VALUES ('101.0066', 'PBT7', 'ROSE STRIPE-T', '1020', '2052', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 10000.00);
INSERT INTO `itemmasterdata` VALUES ('101.0067', 'BTK177', 'SHEEP-K', '1006', '2053', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 13296.14);
INSERT INTO `itemmasterdata` VALUES ('101.0068', 'PBK78-20-10-01', 'SPONGEBOB-K', '1013', '2054', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 8167.68);
INSERT INTO `itemmasterdata` VALUES ('101.0069', 'PMK12-20-10-04', 'SPONGEBOB KUNING-K', '1010', '2055', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 9427.72);
INSERT INTO `itemmasterdata` VALUES ('101.0070', 'BSK87', 'STITCH-K', '1013', '2056', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 10000.00);
INSERT INTO `itemmasterdata` VALUES ('101.0071', 'PBK35', 'STITCH-K', '1013', '2056', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 9430.88);
INSERT INTO `itemmasterdata` VALUES ('101.0072', 'PBK63', 'STITCH-K', '1017', '2056', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 10000.00);
INSERT INTO `itemmasterdata` VALUES ('101.0073', 'PMA12-20-10-04', 'STRIPE HITAM-AB', '1009', '2057', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 9277.72);
INSERT INTO `itemmasterdata` VALUES ('101.0074', 'PBA3', 'STRIPE LITTLE-AB', '1013', '2058', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 13532.98);
INSERT INTO `itemmasterdata` VALUES ('101.0075', 'PMA10-20-10-04', 'STRIPE MAROON-AB', '1011', '2059', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 9277.72);
INSERT INTO `itemmasterdata` VALUES ('101.0076', 'PMA9-20-10-04', 'STRIPE NAVY-AB', '1013', '2060', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 9277.72);
INSERT INTO `itemmasterdata` VALUES ('101.0077', 'CVA11-20-10-04', 'TRIBAL PINK-AB', '1015', '2061', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 13177.72);
INSERT INTO `itemmasterdata` VALUES ('101.0078', 'CVT13-20-10-04', 'TROPICAL PALM BIRU-T', '1003', '2062', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 13177.72);
INSERT INTO `itemmasterdata` VALUES ('101.0079', 'CVT14-20-10-04', 'TROPICAL PALM PUTIH-T', '1016', '2063', '3006', '4003', 18000.00, 21000.00, '1', 'pcs', 'MNL', '2020-11-16 17:26:07', '', '2020-11-16 17:26:07', 1, 0.00, 13177.72);

SET FOREIGN_KEY_CHECKS = 1;