/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.1.34-MariaDB : Database - inventori
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`inventori` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `inventori`;

/*Table structure for table `customer` */

DROP TABLE IF EXISTS `customer`;

CREATE TABLE `customer` (
  `id_customer` int(11) NOT NULL AUTO_INCREMENT,
  `nama_customer` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  PRIMARY KEY (`id_customer`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `customer` */

insert  into `customer`(`id_customer`,`nama_customer`,`alamat`,`telepon`) values 
(2,'Umum','-','-'),
(3,'arif','pacitan','087758952103'),
(4,'indah','yogyakarta','087758989898'),
(5,'sari','yogyakarta','087758123321');

/*Table structure for table `detail_obat_keluar` */

DROP TABLE IF EXISTS `detail_obat_keluar`;

CREATE TABLE `detail_obat_keluar` (
  `kode_detail` varchar(50) NOT NULL,
  `kd_obat_keluar` varchar(50) NOT NULL,
  `kode_obat` varchar(50) NOT NULL,
  `harga_jual` int(13) NOT NULL,
  `jumlah_keluar` int(11) NOT NULL,
  `total` int(13) NOT NULL,
  PRIMARY KEY (`kode_detail`),
  KEY `Kd_obat_keluar` (`kd_obat_keluar`),
  KEY `detail_obat_keluar_ibfk_2` (`kode_obat`),
  CONSTRAINT `detail_obat_keluar_ibfk_1` FOREIGN KEY (`kd_obat_keluar`) REFERENCES `obat_keluar` (`kd_obat_keluar`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `detail_obat_keluar_ibfk_2` FOREIGN KEY (`kode_obat`) REFERENCES `is_obat` (`kode_obat`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `detail_obat_keluar` */

insert  into `detail_obat_keluar`(`kode_detail`,`kd_obat_keluar`,`kode_obat`,`harga_jual`,`jumlah_keluar`,`total`) values 
('DK-250521-03-56-27','TK-250521-000001','B-240121-000001',12000,10,120000),
('DK-250521-03-58-15','TK-250521-000002','B-240121-000001',12000,15,180000),
('DK-250521-03-58-23','TK-250521-000002','B-240121-000003',14000,10,140000),
('DK-250521-03-58-42','TK-250521-000002','B-240121-000002',13000,10,130000),
('DK-260521-08-27-50','TK-260521-000003','B-240121-000001',12000,35,420000),
('DK-260521-08-56-19','TK-260521-000004','B-240121-000001',12000,5,60000),
('DK-260521-08-56-37','TK-260521-000004','B-240121-000002',13000,2,26000),
('DK-260521-08-56-50','TK-260521-000004','B-240121-000003',14000,12,168000);

/*Table structure for table `detail_obat_masuk` */

DROP TABLE IF EXISTS `detail_obat_masuk`;

CREATE TABLE `detail_obat_masuk` (
  `kode_detail` varchar(50) NOT NULL,
  `kd_obat_masuk` varchar(50) NOT NULL,
  `kode_obat` varchar(50) NOT NULL,
  `harga` int(13) NOT NULL,
  `jumlah_masuk` int(11) NOT NULL,
  `diskon` int(13) NOT NULL,
  `total` int(13) NOT NULL,
  `expired` date NOT NULL,
  `keluar` int(13) DEFAULT NULL,
  `sisa` int(13) DEFAULT NULL,
  PRIMARY KEY (`kode_detail`),
  KEY `kd_obat_masuk` (`kd_obat_masuk`),
  KEY `detail_obat_masuk_ibfk_2` (`kode_obat`),
  CONSTRAINT `detail_obat_masuk_ibfk_1` FOREIGN KEY (`kd_obat_masuk`) REFERENCES `obat_masuk` (`kd_obat_masuk`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `detail_obat_masuk_ibfk_2` FOREIGN KEY (`kode_obat`) REFERENCES `is_obat` (`kode_obat`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `detail_obat_masuk` */

insert  into `detail_obat_masuk`(`kode_detail`,`kd_obat_masuk`,`kode_obat`,`harga`,`jumlah_masuk`,`diskon`,`total`,`expired`,`keluar`,`sisa`) values 
('DM-250521-03-53-19','TM-250521-000001','B-240121-000001',10000,20,0,200000,'2021-08-26',20,0),
('DM-250521-03-54-13','TM-250521-000002','B-240121-000001',10000,30,0,300000,'2021-09-26',30,0),
('DM-250521-03-54-46','TM-250521-000003','B-240121-000002',11000,20,0,220000,'2021-08-26',12,8),
('DM-250521-03-55-05','TM-250521-000003','B-240121-000003',12000,30,0,360000,'2021-08-27',22,8),
('DM-260521-08-15-13','TM-260521-000004','B-240121-000001',10000,20,0,200000,'2021-08-29',15,5),
('DM-260521-08-58-38','TM-260521-000005','B-240121-000015',13000,100,0,1300000,'2021-08-27',0,100);

/*Table structure for table `detail_returjual` */

DROP TABLE IF EXISTS `detail_returjual`;

CREATE TABLE `detail_returjual` (
  `det_kd_returjual` varchar(50) NOT NULL,
  `kd_returjual` varchar(50) NOT NULL,
  `kode_obat` varchar(50) NOT NULL,
  `harga` int(13) NOT NULL,
  `jumlah_rj` int(13) NOT NULL,
  `sub_total` int(13) NOT NULL,
  `keterangan` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`det_kd_returjual`),
  KEY `kd_returjual` (`kd_returjual`),
  KEY `kd_obat` (`kode_obat`),
  CONSTRAINT `detail_returjual_ibfk_1` FOREIGN KEY (`kd_returjual`) REFERENCES `retur_jual` (`kd_returjual`),
  CONSTRAINT `detail_returjual_ibfk_2` FOREIGN KEY (`kode_obat`) REFERENCES `is_obat` (`kode_obat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `detail_returjual` */

insert  into `detail_returjual`(`det_kd_returjual`,`kd_returjual`,`kode_obat`,`harga`,`jumlah_rj`,`sub_total`,`keterangan`) values 
('DRJ-240521-11-14-19','RJ-240521-000001','B-240121-000001',12000,5,60000,'obat rusak'),
('DRJ-260521-08-01-39','RJ-260521-000002','B-240121-000001',12000,10,120000,'-'),
('DRJ-260521-08-02-49','RJ-260521-000002','B-240121-000003',14000,5,70000,'');

/*Table structure for table `detail_so` */

DROP TABLE IF EXISTS `detail_so`;

CREATE TABLE `detail_so` (
  `det_kd_so` varchar(50) NOT NULL,
  `kd_so` varchar(50) NOT NULL,
  `kode_obat` varchar(50) NOT NULL,
  `jumlah_sistem` int(13) NOT NULL,
  `jumlah_rill` int(13) NOT NULL,
  `status` varchar(20) NOT NULL,
  `selisih` int(13) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  PRIMARY KEY (`det_kd_so`),
  KEY `kd_so` (`kd_so`),
  KEY `kode_obat` (`kode_obat`),
  CONSTRAINT `detail_so_ibfk_1` FOREIGN KEY (`kd_so`) REFERENCES `stok_opname` (`kd_so`),
  CONSTRAINT `detail_so_ibfk_2` FOREIGN KEY (`kode_obat`) REFERENCES `is_obat` (`kode_obat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `detail_so` */

insert  into `detail_so`(`det_kd_so`,`kd_so`,`kode_obat`,`jumlah_sistem`,`jumlah_rill`,`status`,`selisih`,`keterangan`) values 
('DSO-240521-11-14-57','SO-240521-000001','B-240121-000001',25,45,'Kurang',-20,'sudah');

/*Table structure for table `dump_obkeluar` */

DROP TABLE IF EXISTS `dump_obkeluar`;

CREATE TABLE `dump_obkeluar` (
  `kode_detail` varchar(150) NOT NULL,
  `kd_obat_keluar` varchar(150) NOT NULL,
  `kode_obat` varchar(150) NOT NULL,
  `harga_jual` int(13) NOT NULL,
  `jumlah_keluar` int(11) NOT NULL,
  `total` int(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `dump_obkeluar` */

/*Table structure for table `dump_obmasuk` */

DROP TABLE IF EXISTS `dump_obmasuk`;

CREATE TABLE `dump_obmasuk` (
  `kode_detail` varchar(100) NOT NULL,
  `kd_obat_masuk` varchar(100) NOT NULL,
  `kode_obat` varchar(100) NOT NULL,
  `harga` int(15) NOT NULL,
  `jumlah_masuk` int(15) NOT NULL,
  `diskon` float DEFAULT NULL,
  `total` int(25) NOT NULL,
  `expired` date NOT NULL,
  `keluar` int(13) NOT NULL,
  `sisa` int(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `dump_obmasuk` */

/*Table structure for table `dump_penyesuaian` */

DROP TABLE IF EXISTS `dump_penyesuaian`;

CREATE TABLE `dump_penyesuaian` (
  `kd_penyesuaian` varchar(50) DEFAULT NULL,
  `det_kd_so` varchar(50) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `tindakan` varchar(50) DEFAULT NULL,
  `jumlah` int(13) DEFAULT NULL,
  `keterangan` varchar(200) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `dump_penyesuaian` */

/*Table structure for table `dump_returjual` */

DROP TABLE IF EXISTS `dump_returjual`;

CREATE TABLE `dump_returjual` (
  `det_kd_returjual` varchar(50) NOT NULL,
  `kd_returjual` varchar(50) NOT NULL,
  `kode_obat` varchar(50) NOT NULL,
  `harga` int(13) NOT NULL,
  `jumlah_rj` int(13) NOT NULL,
  `sub_total` int(13) NOT NULL,
  `keterangan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `dump_returjual` */

/*Table structure for table `dump_so` */

DROP TABLE IF EXISTS `dump_so`;

CREATE TABLE `dump_so` (
  `det_kd_so` varchar(50) NOT NULL,
  `kd_so` varchar(50) NOT NULL,
  `kode_obat` varchar(50) NOT NULL,
  `jumlah_sistem` int(13) NOT NULL,
  `jumlah_rill` int(13) NOT NULL,
  `status` varchar(20) NOT NULL,
  `selisih` int(13) NOT NULL,
  `keterangan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `dump_so` */

/*Table structure for table `golongan` */

DROP TABLE IF EXISTS `golongan`;

CREATE TABLE `golongan` (
  `id_golongan` int(13) NOT NULL AUTO_INCREMENT,
  `nama_golongan` varchar(50) NOT NULL,
  PRIMARY KEY (`id_golongan`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `golongan` */

insert  into `golongan`(`id_golongan`,`nama_golongan`) values 
(1,'Obat Bebas'),
(2,'Obat Keras'),
(3,'Obat Bebas Terbatas'),
(4,'Obat Jamu');

/*Table structure for table `is_obat` */

DROP TABLE IF EXISTS `is_obat`;

CREATE TABLE `is_obat` (
  `kode_obat` varchar(50) NOT NULL,
  `nama_obat` varchar(50) NOT NULL,
  `id_golongan` int(11) NOT NULL,
  `id_satuan` int(11) NOT NULL,
  `komposisi` varchar(200) NOT NULL,
  `penyimpanan` varchar(200) NOT NULL,
  `harga_beli` int(13) NOT NULL,
  `harga_jual` int(13) NOT NULL,
  `deskripsi_obat` text NOT NULL,
  `stok` int(11) NOT NULL,
  `expired` date DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`kode_obat`),
  KEY `id_golongan` (`id_golongan`),
  KEY `id_satuan` (`id_satuan`),
  CONSTRAINT `is_obat_ibfk_1` FOREIGN KEY (`id_golongan`) REFERENCES `golongan` (`id_golongan`),
  CONSTRAINT `is_obat_ibfk_2` FOREIGN KEY (`id_satuan`) REFERENCES `satuan` (`id_satuan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `is_obat` */

insert  into `is_obat`(`kode_obat`,`nama_obat`,`id_golongan`,`id_satuan`,`komposisi`,`penyimpanan`,`harga_beli`,`harga_jual`,`deskripsi_obat`,`stok`,`expired`,`foto`) values 
('B-240121-000001','BISOLVON EXT 60ML',3,2,'bromhexine Hcl 4mg, guaifenesin 100mg','simpan di tempat sejuk dan kering, terhindar dari paparan sinar matahari langsung',10000,12000,'Untuk mengobati batu berdahak, batuk karena flu, batuk karena asma, bronkitis akut atau kronis',15,'2021-08-26','BISOLVON EXT 60ML.jpg'),
('B-240121-000002','CENDO LYTEERS 15ML',1,2,'sodium chloride 4.4mg, kalium chlorid 0.8mg','-',11000,13000,'melumasi dan menyejukkan pada mata kering akibat kekurangan sekresi mata, iritasi, penggunaan contact lens, gangguan penglihatan',8,'2021-08-26','cendo lyters 15ml.jpg'),
('B-240121-000003','CALLUSOL',1,2,'asam salicilat 0.2gram, asam laktat 0.05gram, polidocanol 0.02gram','Simpan pada suhu kamar',12000,14000,'obat untuk mata ikan, kapalan, kutil',13,'2021-08-27','callusol liq fah.jpg'),
('B-240121-000004','DEXAMETHASONE KF 0.5MG',2,7,'dexamethasone 0,5mg','-',13000,15000,'Dexamethason produksi PT. Kimia Farma telah terdaftar pada BPOM. Pada setiap tabletnya mengandung 0,5mg dexamethasone. Dexamethasone merupakan glukokortikoid sintetis yang bekerja mengurangi peradangan dengan menghambat migrasi leukosit dan pembalikan permeabilitas kapiler yang meningkat. Dexamethason efektif digunakan untuk terapi terhadap inflamasi, alergi dan penyakit lain yang responsif terhadap glukokortikoid.',0,'0000-00-00','DEXAMETASON 0.5MG.jpg'),
('B-240121-000006','FLUNARIZINE HCL GUARDIAN 5 MG',2,7,'Flunarizin Dihidroklorida 5mg','Simpan pada tempat sejuk dan kering, serta terlindung dari cahaya',15000,17000,'Digunakan untuk pencegahan migrain, pencegahan gangguan vestibular seperti pusing, tinitus, vertigo, kurang konsentrasi dan bingung, gangguan tidur, dan memori serta iritabilitas, kram otot, parestesia, ekstrimitas dingin dan gangguan tropik.',0,'0000-00-00','flunarizine 5mg.jpg'),
('B-240121-000007','INCIDAL-OD 10MG CAP',1,7,'cetirizine 10 mg','Simpan pada tempat sejuk dan kering, serta terlindung dari cahaya',16000,18000,'Digunakan untuk terapi rinitis alergi musiman dan tahunan, urtikaria kronik.',0,'0000-00-00','incidal od.jfif'),
('B-240121-000008','PREDNISON PHAPROS 5MG',2,7,'Prednison 5 mg','Simpan di tempat yang kering dan terlindung dari cahaya',17000,19000,'Prednison digunakan sebagai anti alergi, imunosupresan, dan anti inflamasi. Prednison bekerja dengan mencegah pelepasan substansi dalam tubuh yang menyebabkan inflamasi. Prednison meniru efek kortisol, hormon yang dilepaskan oleh kelenjar adrenal (terletak di atas ginjal) yang mengontrol metabolisme dan stres.',0,'0000-00-00','prednison.jpg'),
('B-240121-000009','SOLINFEC 200MG TAB 50S',2,7,'Ketoconazole.','Simpan pada tempat sejuk dan kering, serta terlindung dari cahaya',18000,20000,'Solinfec merupakan obat yang digunakan untuk mengatasi infeksi sistemik (kurap di kaki, badan, atau lipat paha, dermatitis seboroik, serta ketombe) yang tidak efektif diberikan dengan antijamur topikal atau nystatin/griseofulvin.',0,'2021-10-25','solinfec.jpg'),
('B-240121-000010','SUCRALFATE',2,2,'Per 5 ml suspensi mengandung Sukralfat 500 mg','Simpan di tempat sejuk dan kering, terhindar dari sinar matahari langsung',19000,21000,'Mengobati gastritis kronik, serta tukak lambung dan usus',0,'0000-00-00','sucralfat.jpg'),
('B-240121-000011','CALADINE LOT 60ML',3,2,'calamin, zinc oxide, diphendramine Hcl','Simpan ditempat yang kering, wadah tertutup rapat',20000,22000,'lotion untuk mengobati biang keringat, udara panas, dll',0,'0000-00-00','caladine.jpg'),
('B-240121-000012','HOT IN CREAM TUBE 60G',1,4,'menthol crystal 6%, gandapura oil 3,5% , Eucaliptus oil, sereh oil, piine oil','Simpan di tempat sejuk dan kering, serta terhindar dari sinar matahari langsung',10000,12000,'Sumbawa Hot in Cream merupakan cream antinyeri yang sangat tepat untuk mengatasi capek, pegal-pegal dan nyeri otot yang mengganggu aktivitas harian. Diformulasikan dalam basis cream, nyaman dipakai, panasnya pas, mudah meresap, tidak lengket dikulit, dan tidak mengotori baju.',0,'2021-12-15','hot in cream.jpg'),
('B-240121-000013','KANNA 15G CR',1,10,'Lesitin, petrolatum, cetearil alkohol, ceteareth-33, PEG 100, stearate gliseril stearat, natrium bik','Simpan di tempat yang kering',11000,13000,'Kanna CR merupakan krim lembut yang digunakan untuk melembabkan tumit yang kering, serta dapat menghaluskan kembali tumit yang kasar dan pecah-pecah.',0,'0000-00-00','kana.jfif'),
('B-240121-000014','MY TELON  MY BABY 8 JAM',4,2,'oleum citronellae, oleum chamomillae, oleum anisi, oleum cajuputi compositum dan oleum cocos','simpan di tempat sejuk dan kering, terhindar dari paparan sinar matahari langsung',12000,14000,'My baby minyak telon plus mengandung minyak sereh, minyak kayu putih, oleum cocos, oleum chamomillae, dan oleum anisi. My baby minyak telon plus dapat membantu bayi terhindar dari gigitan serangga dan nyamuk, serta menghangatkan tubuh bayi.',0,'2021-09-24','my telon.jpg'),
('B-240121-000015','SAFE CARE 10ML',1,2,'mentol 20%, camphor 4%, olive virgin oil 19%, essential oil 5%, base ad 100%','Disimpan pada tempat yang kering dan terhindar dari cahaya matahari langsung, dalam tempat tertutup ',13000,15000,'Minyak aromatherapy untuk meringankan sakit kepala, mual, mabuk perjalanan, dan meringankan gatal karena gigitan serangga',100,'2021-08-27','safe care.jfif'),
('B-240121-000016','PROMAG SUSPENSI 7 ML',1,5,'Hydrotalcite 200mg, Mg(OH)2 150mg, Simethicone 50mg','simpan di tempat yang sejuk dan kering, serta terlindung dari panas dan sinar matahari langsung',14000,16000,'Untuk mengurangi gejala yang berhubungan dengan kelebihan asam lambung, gastritis, tukak lambung, dan tukak usus 12 jari dengan gejala mual, kembung, nyeri lambung, nyeri ulu hati, dan rasa penuh pada lambung',0,'2021-08-25','promagsuspensi7.jpg'),
('B-240121-000017','SAKATONIK ABC ANTARIKSA',1,4,'vit A, B Komplek, C, D, E, Nikotinamid, Kalsium Pantotenat  ','Simpan di tempat kering san sejuk, serta terhindar dari panas sinar matahari langsung  ',15000,17000,'SAKATONIK ABC ANTARIKSA 30S BTL merupakan tablet hisap multivitamin untuk anak-anak  ',0,'2021-09-12','sakatonik.jpg'),
('B-250121-000018','PARACETAMOL 500 MG',1,6,'Paracetamol 500 mg','Simpan di tempat kering dan sejuk, serta terhindar dari panas sinar matahari langsung',16000,18000,'Digunakan untuk meringankan rasa sakit seperti sakit gigi, sakit kepala, dan menurunkan demam',0,'2021-10-12','paracetamol 500g_1.jpg');

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
  `hak_akses` enum('APA','APING') NOT NULL,
  PRIMARY KEY (`id_user`),
  KEY `level` (`hak_akses`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `is_users` */

insert  into `is_users`(`id_user`,`username`,`alamat`,`password`,`email`,`telepon`,`foto`,`hak_akses`) values 
(1,'arif22','pacitan','202cb962ac59075b964b07152d234b70','arif@22','123456','5170311045.jpg','APA'),
(3,'Aping','solo','202cb962ac59075b964b07152d234b70','aping@22','1234567890','default.png','APING');

/*Table structure for table `obat_keluar` */

DROP TABLE IF EXISTS `obat_keluar`;

CREATE TABLE `obat_keluar` (
  `kd_obat_keluar` varchar(50) NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `total` int(13) NOT NULL,
  PRIMARY KEY (`kd_obat_keluar`),
  KEY `obat_keluar_ibfk_1` (`id_user`),
  KEY `id_customer` (`id_customer`),
  CONSTRAINT `obat_keluar_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `is_users` (`id_user`) ON DELETE NO ACTION,
  CONSTRAINT `obat_keluar_ibfk_2` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id_customer`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `obat_keluar` */

insert  into `obat_keluar`(`kd_obat_keluar`,`tanggal_keluar`,`id_user`,`id_customer`,`total`) values 
('TK-250521-000001','2021-05-25',1,3,120000),
('TK-250521-000002','2021-05-25',1,3,450000),
('TK-260521-000003','2021-05-26',1,3,420000),
('TK-260521-000004','2021-05-26',1,4,254000);

/*Table structure for table `obat_masuk` */

DROP TABLE IF EXISTS `obat_masuk`;

CREATE TABLE `obat_masuk` (
  `kd_obat_masuk` varchar(50) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `faktur` varchar(50) NOT NULL,
  PRIMARY KEY (`kd_obat_masuk`),
  KEY `obat_masuk_ibfk_1` (`id_user`),
  KEY `obat_masuk_ibfk_2` (`id_supplier`),
  CONSTRAINT `obat_masuk_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `is_users` (`id_user`) ON DELETE NO ACTION,
  CONSTRAINT `obat_masuk_ibfk_2` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`) ON DELETE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `obat_masuk` */

insert  into `obat_masuk`(`kd_obat_masuk`,`tanggal_masuk`,`id_user`,`id_supplier`,`faktur`) values 
('TM-250521-000001','2021-05-25',1,1,'fk001'),
('TM-250521-000002','2021-05-25',1,1,'fk002'),
('TM-250521-000003','2021-05-25',1,1,'fk003'),
('TM-260521-000004','2021-05-26',1,3,'dfg'),
('TM-260521-000005','2021-05-26',1,3,'xdfhg');

/*Table structure for table `penyesuaian` */

DROP TABLE IF EXISTS `penyesuaian`;

CREATE TABLE `penyesuaian` (
  `kd_penyesuaian` varchar(50) NOT NULL,
  `det_kd_so` varchar(50) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tindakan` varchar(50) NOT NULL,
  `jumlah` int(13) NOT NULL,
  `keterangan` varchar(200) DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`kd_penyesuaian`),
  KEY `det_kd_so` (`det_kd_so`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `penyesuaian_ibfk_1` FOREIGN KEY (`det_kd_so`) REFERENCES `detail_so` (`det_kd_so`),
  CONSTRAINT `penyesuaian_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `is_users` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `penyesuaian` */

insert  into `penyesuaian`(`kd_penyesuaian`,`det_kd_so`,`id_user`,`tindakan`,`jumlah`,`keterangan`,`status`) values 
('PNY-240521-11-15-50','DSO-240521-11-14-57',1,'Tambah',20,'-','Disetujui-tambah');

/*Table structure for table `retur_jual` */

DROP TABLE IF EXISTS `retur_jual`;

CREATE TABLE `retur_jual` (
  `kd_returjual` varchar(50) NOT NULL,
  `tanggal_retur` date NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  PRIMARY KEY (`kd_returjual`),
  KEY `id_user` (`id_user`),
  KEY `id_customer` (`id_customer`),
  CONSTRAINT `retur_jual_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `is_users` (`id_user`),
  CONSTRAINT `retur_jual_ibfk_2` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id_customer`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `retur_jual` */

insert  into `retur_jual`(`kd_returjual`,`tanggal_retur`,`id_user`,`id_customer`) values 
('RJ-240521-000001','2021-05-24',1,3),
('RJ-260521-000002','2021-05-26',1,3);

/*Table structure for table `satuan` */

DROP TABLE IF EXISTS `satuan`;

CREATE TABLE `satuan` (
  `id_satuan` int(13) NOT NULL AUTO_INCREMENT,
  `nama_satuan` varchar(50) NOT NULL,
  PRIMARY KEY (`id_satuan`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `satuan` */

insert  into `satuan`(`id_satuan`,`nama_satuan`) values 
(2,'Botol'),
(4,'Pcs'),
(5,'Saset'),
(6,'Strip'),
(7,'Tablet'),
(10,'Tube'),
(11,'Kotak'),
(12,'Box');

/*Table structure for table `stok_opname` */

DROP TABLE IF EXISTS `stok_opname`;

CREATE TABLE `stok_opname` (
  `kd_so` varchar(50) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `status` varchar(20) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  PRIMARY KEY (`kd_so`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `stok_opname_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `is_users` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `stok_opname` */

insert  into `stok_opname`(`kd_so`,`id_user`,`tanggal`,`status`,`keterangan`) values 
('SO-240521-000001',1,'2021-05-24','disesuaikan','disetujui');

/*Table structure for table `supplier` */

DROP TABLE IF EXISTS `supplier`;

CREATE TABLE `supplier` (
  `id_supplier` int(11) NOT NULL AUTO_INCREMENT,
  `nama_supplier` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `kota` varchar(50) DEFAULT NULL,
  `telepon` varchar(15) NOT NULL,
  PRIMARY KEY (`id_supplier`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `supplier` */

insert  into `supplier`(`id_supplier`,`nama_supplier`,`alamat`,`kota`,`telepon`) values 
(1,'PT. Sehat Bersama Sentosa','Jl.Hasyim Asari Rt.01/Rw.06 Srago Baru  Kec.Klaten','klaten','0272322132'),
(2,'PT. Gayamindo Kerta','Kembaran Rt.03, Kasihan Bantul','Yogyakarta','0274411199'),
(3,'PT. Salsa Barokah Farma','Madumurti No.6A Rt.23 Rw.004 Patangpuluh Wirobangu','Yogyakarta','02744287727'),
(4,'PT. Mulya Wibawa','Jl.Panembahan No.03 Yogyakarta','yogyakarta','087758952123');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
