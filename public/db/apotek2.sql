/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.1.34-MariaDB : Database - apotek2
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`apotek2` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `apotek2`;

/*Table structure for table `detail_obat_keluar` */

DROP TABLE IF EXISTS `detail_obat_keluar`;

CREATE TABLE `detail_obat_keluar` (
  `kode_detail` varchar(50) NOT NULL,
  `kd_obat_keluar` varchar(50) NOT NULL,
  `kode_obat` varchar(50) NOT NULL,
  `jumlah_keluar` int(11) NOT NULL,
  PRIMARY KEY (`kode_detail`),
  KEY `Kd_obat_keluar` (`kd_obat_keluar`),
  CONSTRAINT `detail_obat_keluar_ibfk_1` FOREIGN KEY (`kd_obat_keluar`) REFERENCES `obat_keluar` (`kd_obat_keluar`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `detail_obat_keluar` */

insert  into `detail_obat_keluar`(`kode_detail`,`kd_obat_keluar`,`kode_obat`,`jumlah_keluar`) values ('DK-031120-12-55-37','TK-031120-000001','B-031120-000002',3),('DK-051120-02-12-42','TK-051120-000002','B-031120-000005',10),('DK-051120-02-13-11','TK-051120-000003','B-031120-000004',2),('DK-051120-07-49-25','TK-051120-000004','B-031120-000005',5),('DK-061120-11-53-01','TK-061120-000005','B-031120-000003',19),('DK-071120-11-45-05','TK-071120-000006','B-031120-000005',19),('DK-071120-11-45-20','TK-071120-000006','B-061120-000006',19),('DK-131120-09-34-03','TK-131120-000007','B-091120-000007',5),('DK-131120-09-34-43','TK-131120-000007','B-131120-000008',5);

/*Table structure for table `detail_obat_masuk` */

DROP TABLE IF EXISTS `detail_obat_masuk`;

CREATE TABLE `detail_obat_masuk` (
  `kode_detail` varchar(50) NOT NULL,
  `kd_obat_masuk` varchar(50) NOT NULL,
  `kode_obat` varchar(50) NOT NULL,
  `jumlah_masuk` int(11) NOT NULL,
  `expired` date NOT NULL,
  PRIMARY KEY (`kode_detail`),
  KEY `kd_obat_masuk` (`kd_obat_masuk`),
  CONSTRAINT `detail_obat_masuk_ibfk_1` FOREIGN KEY (`kd_obat_masuk`) REFERENCES `obat_masuk` (`kd_obat_masuk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `detail_obat_masuk` */

insert  into `detail_obat_masuk`(`kode_detail`,`kd_obat_masuk`,`kode_obat`,`jumlah_masuk`,`expired`) values ('DM-031120-12-07-56','TM-031120-000001','B-031120-000001',10,'2020-11-03'),('DM-031120-12-09-27','TM-031120-000002','B-031120-000001',10,'2020-11-01'),('DM-031120-12-09-41','TM-031120-000002','B-031120-000002',3,'2020-11-03'),('DM-031120-12-39-57','TM-031120-000003','B-031120-000003',33,'2020-11-28'),('DM-031120-12-47-26','TM-031120-000004','B-031120-000004',33,'2020-11-18'),('DM-031120-12-52-53','TM-031120-000005','B-031120-000005',40,'2020-11-22'),('DM-051120-01-53-55','TM-051120-000006','B-031120-000005',10,'2020-11-05'),('DM-051120-07-48-41','TM-051120-000007','B-031120-000005',10,'2020-11-05'),('DM-061120-08-28-52','TM-061120-000008','B-031120-000005',11,'2020-11-10'),('DM-061120-09-15-09','TM-061120-000009','B-031120-000004',100,'2020-11-06'),('DM-061120-10-26-14','TM-061120-000010','B-031120-000005',2,'2020-11-09'),('DM-061120-11-51-11','TM-061120-000011','B-031120-000003',10,'2020-11-06'),('DM-071120-10-40-46','TM-071120-000015','B-071120-000005',20,'2020-11-08'),('DM-071120-10-43-41','TM-071120-000016','B-071120-000006',5,'2020-11-08'),('DM-071120-11-14-16','TM-071120-000012','B-031120-000003',30,'2020-11-07'),('DM-071120-11-20-13','TM-071120-000013','B-061120-000006',20,'2020-11-07'),('DM-071120-11-43-52','TM-071120-000014','B-031120-000002',20,'2020-11-07'),('DM-131120-09-30-45','TM-131120-000018','B-091120-000007',10,'2020-11-14'),('DM-131120-09-31-09','TM-131120-000018','B-131120-000008',20,'2020-11-14'),('DM-131120-10-03-14','TM-131120-000019','B-091120-000007',10,'2020-11-14'),('DM-151120-11-19-10','TM-151120-000020','B-031120-000003',2,'2020-11-16'),('DM-161120-01-00-19','TM-161120-000021','B-031120-000002',2,'2020-11-25'),('DM-161120-01-05-35','TM-161120-000022','B-031120-000002',2,'2020-11-20'),('DM-161120-02-55-06','TM-161120-000023','B-161120-000010',2,'2020-11-17');

/*Table structure for table `dump_obkeluar` */

DROP TABLE IF EXISTS `dump_obkeluar`;

CREATE TABLE `dump_obkeluar` (
  `kode_detail` varchar(255) DEFAULT NULL,
  `kd_obat_keluar` varchar(255) DEFAULT NULL,
  `kode_obat` varchar(255) DEFAULT NULL,
  `jumlah_keluar` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `dump_obkeluar` */

/*Table structure for table `dump_obmasuk` */

DROP TABLE IF EXISTS `dump_obmasuk`;

CREATE TABLE `dump_obmasuk` (
  `kode_detail` varchar(100) DEFAULT NULL,
  `kd_obat_masuk` varchar(100) DEFAULT NULL,
  `kode_obat` varchar(100) DEFAULT NULL,
  `jumlah_masuk` int(15) DEFAULT NULL,
  `expired` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `dump_obmasuk` */

/*Table structure for table `is_obat` */

DROP TABLE IF EXISTS `is_obat`;

CREATE TABLE `is_obat` (
  `kode_obat` varchar(50) NOT NULL,
  `nama_obat` varchar(50) NOT NULL,
  `jenis_obat` varchar(50) NOT NULL,
  `satuan` varchar(30) NOT NULL,
  `komposisi` varchar(100) NOT NULL,
  `penyimpanan` varchar(100) NOT NULL,
  `deskripsi_obat` text NOT NULL,
  `stok` int(11) NOT NULL,
  `expired` date DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`kode_obat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `is_obat` */

insert  into `is_obat`(`kode_obat`,`nama_obat`,`jenis_obat`,`satuan`,`komposisi`,`penyimpanan`,`deskripsi_obat`,`stok`,`expired`,`foto`,`created_at`,`updated_at`) values ('B-031120-000003','zz','dd','Kotak','dd','dd','dd',32,'2020-11-28','default.png','2020-11-02 23:38:39','2020-11-02 23:38:39'),('B-071120-000005','er','e','Kotak','eth','eth','eth',20,'2020-11-08','default.png','2020-11-07 09:38:37','2020-11-07 09:38:37'),('B-081120-000006','f','ef','Kotak','ef','wef','wef',44,'2020-11-25','2iXEuP.jpg','2020-11-08 08:47:23','2020-11-08 08:47:23'),('B-091120-000007','d','df','Kotak','fsd','sdf','dsf',15,'2020-11-26','default.png','2020-11-08 11:28:34','2020-11-08 11:28:34'),('B-131120-000008','aa','aa','Box','ss','','aa',31,'2020-11-19','22.png','2020-11-13 08:17:48','2020-11-13 08:17:48'),('B-171120-000009','dfh','dgh','Botol','gh','dgh','dgh',0,'0000-00-00','default.png','2020-11-17 12:13:49','2020-11-17 12:13:49');

/*Table structure for table `is_users` */

DROP TABLE IF EXISTS `is_users`;

CREATE TABLE `is_users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(30) DEFAULT NULL,
  `telepon` varchar(13) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `hak_akses` enum('Super Admin','Manajer','Gudang','Admin','APA','APING') NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  KEY `level` (`hak_akses`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `is_users` */

insert  into `is_users`(`id_user`,`username`,`alamat`,`password`,`email`,`telepon`,`foto`,`hak_akses`,`created_at`,`updated_at`) values (9,'arif','pacitan','21232f297a57a5a743894a0e4a801fc3','arif@22','22','5170311045.jpg','APA','2020-11-17 15:27:18','2020-11-17 15:27:18'),(10,'indah','jogja','202cb962ac59075b964b07152d234b70','indah@22','1234','indah_2.jpeg','APING','2020-11-17 15:39:49','2020-11-17 15:39:49');

/*Table structure for table `obat_keluar` */

DROP TABLE IF EXISTS `obat_keluar`;

CREATE TABLE `obat_keluar` (
  `kd_obat_keluar` varchar(50) NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `id_user` varchar(50) NOT NULL,
  PRIMARY KEY (`kd_obat_keluar`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `obat_keluar` */

insert  into `obat_keluar`(`kd_obat_keluar`,`tanggal_keluar`,`id_user`) values ('TK-031120-000001','2020-11-03','2'),('TK-051120-000002','2020-11-05','2'),('TK-051120-000003','2020-11-05','2'),('TK-051120-000004','2020-11-05','2'),('TK-061120-000005','2020-11-06','2'),('TK-071120-000006','2020-11-07','2'),('TK-131120-000007','2020-11-13','');

/*Table structure for table `obat_masuk` */

DROP TABLE IF EXISTS `obat_masuk`;

CREATE TABLE `obat_masuk` (
  `kd_obat_masuk` varchar(50) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `id_user` varchar(50) NOT NULL,
  `id_supplier` varchar(50) NOT NULL,
  `faktur` varchar(50) NOT NULL,
  PRIMARY KEY (`kd_obat_masuk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `obat_masuk` */

insert  into `obat_masuk`(`kd_obat_masuk`,`tanggal_masuk`,`id_user`,`id_supplier`,`faktur`) values ('TM-031120-000001','2020-11-03','2','1','sd'),('TM-031120-000002','2020-11-03','2','3','g3g'),('TM-031120-000003','2020-11-03','2','2','fw'),('TM-031120-000004','2020-11-03','2','3','ewf'),('TM-031120-000005','2020-11-03','2','3','dfg'),('TM-051120-000006','2020-11-05','2','3','rg'),('TM-051120-000007','2020-11-05','2','2','ye'),('TM-061120-000008','2020-11-06','3','3','fytrh'),('TM-061120-000009','2020-11-06','2','1','5y53'),('TM-061120-000010','2020-11-06','3','3','rg'),('TM-061120-000011','2020-11-06','2','2','rty'),('TM-071120-000012','2020-11-07','2','3','ef'),('TM-071120-000013','2020-11-07','2','2','gf'),('TM-071120-000014','2020-11-07','2','2','DFB'),('TM-071120-000015','2020-11-07','2','3','tg'),('TM-071120-000016','2020-11-07','2','2','rth'),('TM-131120-000018','2020-11-13','','2','ef'),('TM-131120-000019','2020-11-13','','2','grg'),('TM-151120-000020','2020-11-15','4','17','DSF'),('TM-161120-000021','2020-11-16','2','19','22222221212121'),('TM-161120-000022','2020-11-16','2','17','32f'),('TM-161120-000023','2020-11-16','2','15','tg');

/*Table structure for table `supplier` */

DROP TABLE IF EXISTS `supplier`;

CREATE TABLE `supplier` (
  `id_supplier` int(11) NOT NULL AUTO_INCREMENT,
  `nama_supplier` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `kota` varchar(50) DEFAULT NULL,
  `telepon` varchar(15) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_supplier`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `supplier` */

insert  into `supplier`(`id_supplier`,`nama_supplier`,`alamat`,`kota`,`telepon`,`created_at`,`updated_at`) values (1,'jono','solo','solo','12345','2020-10-23 11:27:54','2020-10-23 11:27:54'),(2,'df','f','ff','33','2020-10-27 11:54:07','2020-10-27 11:54:07'),(3,'tt','tt','tt','44','2020-10-30 09:00:41','2020-10-30 09:00:41'),(4,'ssssssssssssssssssssssssssssssssssssssssssssssssss','ssssssssssssssssssssssssssssssssssssssssssssssssss','ssssssssssssssssssssssssssssssssssssssssssssssssss','1111111111111','2020-11-01 23:48:01','2020-11-01 23:48:01'),(6,'d','dd','dd','22','2020-11-13 09:19:32','2020-11-13 09:19:32'),(7,'ss','ss','ss','2','2020-11-13 09:20:13','2020-11-13 09:20:13');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
