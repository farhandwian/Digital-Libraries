-- MySQL dump 10.13  Distrib 8.0.29, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: lms_7_1
-- ------------------------------------------------------
-- Server version	8.0.29

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `anggota`
--

DROP TABLE IF EXISTS `anggota`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `anggota` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nim` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_hp` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jurusan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_kelamin` enum('pria','wanita') COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `anggota_user_id_foreign` (`user_id`),
  CONSTRAINT `anggota_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `anggota`
--

LOCK TABLES `anggota` WRITE;
/*!40000 ALTER TABLE `anggota` DISABLE KEYS */;
INSERT INTO `anggota` VALUES (2,'Riska Miraldamar','0234578','081234567','1997-02-11','Teknik Elektro','wanita',13,'2022-06-09 04:35:08','2022-06-10 22:18:31'),(4,'Miyawaki Sakura','2002969','08123456','2022-06-14','seni budaya','wanita',9,'2022-06-10 22:29:28','2022-06-24 12:13:46'),(6,'Nakamura Kazuha','2005823','081642983','2003-08-09','drama','wanita',15,'2022-06-23 21:45:46','2022-06-23 21:45:46'),(7,'farhan dwian','2008132','081234512','2022-06-25','ilmu komputer','pria',16,'2022-06-24 12:20:30','2022-06-24 12:20:30'),(8,'reyvan adryan','2001542','0127332','2006-01-24','seni','pria',17,'2022-06-24 12:41:30','2022-06-24 12:41:30');
/*!40000 ALTER TABLE `anggota` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `biblio`
--

DROP TABLE IF EXISTS `biblio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `biblio` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isbn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penulis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penerbit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_terbit` int NOT NULL,
  `tipe_koleksi` enum('fiction','reference','textbook','non-fiction') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jumlah_buku` int DEFAULT '0',
  `stok` int DEFAULT '0',
  `total_dipinjam` int DEFAULT '0',
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rating` double(8,2) NOT NULL DEFAULT '0.00',
  `total_reviewer` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `biblio`
--

LOCK TABLES `biblio` WRITE;
/*!40000 ALTER TABLE `biblio` DISABLE KEYS */;
INSERT INTO `biblio` VALUES (6,'berpikir bodo amat','123412','J MASON','jabar',2017,'reference',2,2,0,'Buku yang berjudul Sebuah Seni untuk Bersikap Bodo Amat, merupakan buku pengembangan diri yang ditulis oleh Mark Manson. Buku ini memiliki banyak pesan moral di dalamnya, yang terkait dengan kehidupan tentang sebuah kepeduliaan terhadap suatu hal yang penting','gambar-buku/6Al1apujFWy9zCAKdnX0xT66gNQCCM98si2NjhtJ.jpg',3.67,3,'2022-06-10 21:00:45','2022-06-24 11:09:33'),(7,'blink','123422','malcolm gladwell','jamaika',2015,'reference',6,6,7,'Buku yang berjudul blink, merupakan buku pengembangan diri yang ditulis oleh Mark Manson. Buku ini memiliki banyak pesan moral di dalamnya, yang terkait dengan kehidupan tentang sebuah kepeduliaan terhadap suatu hal yang penting','gambar-buku/QGZEXolyOIgAOeE9hjPSZr8pUXcKVvvJv3jOrB2L.jpg',3.33,3,'2022-06-10 21:29:57','2022-06-24 12:46:44'),(8,'harapan palsu','123122','hakimi','mandala',2003,'fiction',0,0,0,'Buku yang berjudul Sebuah harapan palsu, merupakan buku pengembangan diri yang ditulis oleh Mark Manson. Buku ini memiliki banyak pesan moral di dalamnya, yang terkait dengan kehidupan tentang sebuah kepeduliaan terhadap suatu hal yang penting','gambar-buku/iVp53shDM9mGlJ6JkSwPQPwHQK8RMIbTv4PE2FyA.jpg',0.00,0,'2022-06-17 05:56:58','2022-06-23 20:08:01'),(9,'teduh','123341','arifin ali','raif city',2006,'textbook',0,0,0,'Buku yang berjudul Teduh, merupakan buku pengembangan diri yang ditulis oleh Mark Manson. Buku ini memiliki banyak pesan moral di dalamnya, yang terkait dengan kehidupan tentang sebuah kepeduliaan terhadap suatu hal yang penting','gambar-buku/n7JBJrgIe8mTHMRFpxKpLyfTC1KReo4zhIoYFV4A.jpg',0.00,0,'2022-06-17 05:58:23','2022-06-23 20:12:32'),(10,'langit biru','342123','sutan sali','erlangga',2020,'reference',0,0,0,'Buku yang berjudul Langit, merupakan buku pengembangan diri yang ditulis oleh Mark Manson. Buku ini memiliki banyak pesan moral di dalamnya, yang terkait dengan kehidupan tentang sebuah kepeduliaan terhadap suatu hal yang penting','gambar-buku/o99aJWhhHwlZMHsZVriZosDkJIVydHXHhvb2Ncf1.jpg',0.00,0,'2022-06-17 05:58:45','2022-06-23 20:10:51'),(11,'pulang','123622','Tere Liye','jambi tv',2019,'fiction',0,0,0,'Pulang yang kali ini bukanlah pulang dengan perjalanan seperti pada umumnya. Sebab pulang kali ini adalah petualangan yang sangat berkesan melewati pertarungan demi pertarungan, yang tidak akan pernah terbayangkan oleh si tokoh utama di buku ini','gambar-buku/qe3ooGaRXHZD3yNvhKRxkcJsLDVi9PjYF3ZMq50N.jpg',0.00,0,'2022-06-17 18:51:39','2022-06-17 18:51:39'),(12,'pergi','236722','Tere Liye','sunda tv',2017,'fiction',0,0,0,'Pergi yang kali ini bukanlah pulang dengan perjalanan seperti pada umumnya. Sebab pulang kali ini adalah petualangan yang sangat berkesan melewati pertarungan demi pertarungan, yang tidak akan pernah terbayangkan oleh si tokoh utama di buku ini','gambar-buku/yDiqjjwiL9tVExG1FfzfDWjIyhES2xAuSFmEzvXC.jpg',5.00,1,'2022-06-17 18:52:24','2022-06-18 06:59:53'),(13,'perahu','693522','ahmad syarif','kalapa tara',2020,'fiction',0,0,0,'Buku yang berjudul Perahu, merupakan buku pengembangan diri yang ditulis oleh Mark Manson. Buku ini memiliki banyak pesan moral di dalamnya, yang terkait dengan kehidupan tentang sebuah kepeduliaan terhadap suatu hal yang penting','gambar-buku/eSRcq4apaUn7HeXCXMnwRcLxE2H2zi66b4OWn3r2.jpg',0.00,0,'2022-06-17 18:53:31','2022-06-17 18:53:31'),(14,'stphen hawking','567823','stephen hawking','ramayana',2020,'non-fiction',0,0,0,'Buku yang berjudul Hawking, merupakan buku pengembangan diri yang ditulis oleh Mark Manson. Buku ini memiliki banyak pesan moral di dalamnya, yang terkait dengan kehidupan tentang sebuah kepeduliaan terhadap suatu hal yang penting','gambar-buku/XCSW4IbWnuOBQ9qbqNcgVfoS8hzMvkHNNELTcwIj.jpg',0.00,0,'2022-06-17 18:54:13','2022-06-17 18:54:13'),(15,'harry potter','126382','jk rowling','maranatha',2011,'fiction',0,0,0,'Buku yang berjudul harry poter, merupakan buku pengembangan diri yang ditulis oleh Mark Manson. Buku ini memiliki banyak pesan moral di dalamnya, yang terkait dengan kehidupan tentang sebuah kepeduliaan terhadap suatu hal yang penting','gambar-buku/ThXm93JrGsKibyMdEardZTszhBF3urcdDcB0fzP8.jpg',0.00,0,'2022-06-18 15:11:31','2022-06-18 15:11:31'),(16,'the lord of the ring','123543','kakashi','mandarin',2020,'fiction',2,2,3,'Buku yang berjudul the lord of the ring, merupakan buku pengembangan diri yang ditulis oleh Mark Manson. Buku ini memiliki banyak pesan moral di dalamnya, yang terkait dengan kehidupan tentang sebuah kepeduliaan terhadap suatu hal yang penting','gambar-buku/g3zulWhwNK8GQxM5MQK2OZRQMtBrhAruaGzmURtm.jpg',3.50,2,'2022-06-18 15:12:22','2022-06-24 11:16:43');
/*!40000 ALTER TABLE `biblio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `buku`
--

DROP TABLE IF EXISTS `buku`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `buku` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isbn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `penulis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penerbit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_terbit` int NOT NULL,
  `jumlah_buku` int NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `lokasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `buku`
--

LOCK TABLES `buku` WRITE;
/*!40000 ALTER TABLE `buku` DISABLE KEYS */;
INSERT INTO `buku` VALUES (1,'One Piece','9983723423','Eichiiro Oda','Gramedia',1994,10,NULL,'rak2','onepiece.jpg','2022-06-21 19:43:14',NULL),(4,'One Piece','9983723423','Eichiiro Oda','Gramedia',1994,10,NULL,'rak2','onepiece.jpg','2022-06-21 19:51:50',NULL),(7,'One Piece','9983723423','Eichiiro Oda','Gramedia',1994,10,NULL,'rak2','onepiece.jpg','2022-06-21 19:54:42',NULL),(10,'One Piece','9983723423','Eichiiro Oda','Gramedia',1994,10,NULL,'rak2','onepiece.jpg','2022-06-21 19:55:17',NULL),(11,'Naruto Shippuden','9983742831','Masashi Kisimoto','Shonen Jump',1995,8,NULL,'rak1','naruto.jpg','2022-06-21 19:55:17',NULL),(12,'Naruto Shippuden','99837428331','Masashi Kisimoto','Shonen Jump',1995,8,NULL,'rak1','naruto.jpg','2022-06-21 19:55:17',NULL);
/*!40000 ALTER TABLE `buku` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `denda`
--

DROP TABLE IF EXISTS `denda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `denda` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `transaksi_id` bigint unsigned DEFAULT NULL,
  `jumlah_denda` int NOT NULL,
  `status` enum('lunas','hutang') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `denda_transaksi_id_foreign` (`transaksi_id`),
  CONSTRAINT `denda_transaksi_id_foreign` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `denda`
--

LOCK TABLES `denda` WRITE;
/*!40000 ALTER TABLE `denda` DISABLE KEYS */;
INSERT INTO `denda` VALUES (7,25,10000,'lunas','2022-06-23 09:58:12','2022-06-23 09:58:12'),(8,28,10000,'lunas','2022-06-24 11:16:25','2022-06-24 11:16:25'),(9,27,5000,'lunas','2022-06-24 11:16:43','2022-06-24 11:16:43');
/*!40000 ALTER TABLE `denda` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `koleksi`
--

DROP TABLE IF EXISTS `koleksi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `koleksi` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `biblio_id` bigint unsigned NOT NULL,
  `kode_eksemplar` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_reg` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('tersedia','dipesan','dipinjam','hilang') COLLATE utf8mb4_unicode_ci NOT NULL,
  `kondisi` enum('sangat bagus','bagus','cukup bagus') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kode_eksemplar_UNIQUE` (`kode_eksemplar`),
  KEY `koleksi_biblio_id_foreign` (`biblio_id`),
  CONSTRAINT `koleksi_biblio_id_foreign` FOREIGN KEY (`biblio_id`) REFERENCES `biblio` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `koleksi`
--

LOCK TABLES `koleksi` WRITE;
/*!40000 ALTER TABLE `koleksi` DISABLE KEYS */;
INSERT INTO `koleksi` VALUES (9,6,'p123','REG-024','RAK-01','tersedia','cukup bagus','2022-06-10 21:25:57','2022-06-23 08:06:42'),(10,6,'p124','REG-023','RAK-01','tersedia','bagus','2022-06-10 21:28:21','2022-06-24 11:09:33'),(12,7,'p125','REG-245','RAK-01','tersedia','bagus','2022-06-10 21:44:05','2022-06-24 12:25:57'),(13,7,'p126','REG-027','RAK02','tersedia','sangat bagus','2022-06-10 21:45:54','2022-06-24 12:44:40'),(14,7,'p127','REG-012','RAK-05','tersedia','sangat bagus','2022-06-10 21:45:56','2022-06-24 12:25:52'),(15,7,'p128','REG-013','RAK-05','tersedia','sangat bagus','2022-06-10 21:45:56','2022-06-24 12:28:06'),(16,7,'p129','REG-014','RAK-05','tersedia','bagus','2022-06-10 21:45:56','2022-06-10 21:45:57'),(17,7,'p130','REG-015','RAK-05','tersedia','bagus','2022-06-10 21:45:56','2022-06-10 21:45:57'),(18,16,'p131','REG-016','RAK-05','hilang','bagus','2022-06-10 21:45:56','2022-06-24 11:16:43'),(19,16,'p132','REG-017','RAK-05','tersedia','bagus','2022-06-10 21:45:56','2022-06-24 11:16:25'),(20,16,'p133','REG-018','RAK-05','tersedia','bagus','2022-06-10 21:45:56','2022-06-24 10:53:37');
/*!40000 ALTER TABLE `koleksi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `laporans`
--

DROP TABLE IF EXISTS `laporans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `laporans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `laporans`
--

LOCK TABLES `laporans` WRITE;
/*!40000 ALTER TABLE `laporans` DISABLE KEYS */;
/*!40000 ALTER TABLE `laporans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2021_11_07_145624_create_bukus_table',1),(5,'2021_11_07_232210_create_anggotas_table',1),(6,'2021_11_12_051341_create_laporans_table',1),(7,'2022_05_20_234900_create_biblios_tabel',1),(8,'2022_05_20_234909_create_koleksis_tabel',1),(9,'2022_05_21_023900_create_transaksis_table',1),(10,'2022_06_10_181553_create_denda_table',2),(12,'2022_06_18_094947_create_review_table',3);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `review`
--

DROP TABLE IF EXISTS `review`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `review` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `anggota_id` bigint unsigned DEFAULT NULL,
  `biblio_id` bigint unsigned NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `review_anggota_id_foreign` (`anggota_id`),
  KEY `review_biblio_id_foreign` (`biblio_id`),
  CONSTRAINT `review_anggota_id_foreign` FOREIGN KEY (`anggota_id`) REFERENCES `anggota` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `review_biblio_id_foreign` FOREIGN KEY (`biblio_id`) REFERENCES `biblio` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `review`
--

LOCK TABLES `review` WRITE;
/*!40000 ALTER TABLE `review` DISABLE KEYS */;
INSERT INTO `review` VALUES (1,2,12,'bukunya bagus',5,'2022-06-18 06:59:53','2022-06-18 06:59:53'),(2,4,6,'bukunya bagus banget,menjelaskan hal yang bermanfaat',4,'2022-06-18 08:08:21','2022-06-18 08:08:21'),(3,4,6,'buku nya cukup bagus,menjelaskan cara meningkatkan mental',4,'2022-06-18 12:26:53','2022-06-18 12:26:53'),(4,4,7,'wow bukunya bagus sekali',5,'2022-06-18 12:28:18','2022-06-18 12:28:18'),(5,2,7,'bagus bukunya',3,'2022-06-18 14:00:54','2022-06-18 14:00:54'),(6,4,16,'Bukunya sangat bagus dan memuaskan',5,'2022-06-23 20:22:36','2022-06-23 20:22:36'),(7,2,16,'Kurang bagus bukunya',2,'2022-06-23 20:23:34','2022-06-23 20:23:34'),(8,6,6,'Buku nya cukup bagus,cuman terlalu sulit untuk dibaca anak dibawah umur',3,'2022-06-24 11:08:02','2022-06-24 11:08:02'),(9,8,7,'bukunya jelek',2,'2022-06-24 12:46:44','2022-06-24 12:46:44');
/*!40000 ALTER TABLE `review` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaksi`
--

DROP TABLE IF EXISTS `transaksi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transaksi` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kode_transaksi` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `anggota_id` bigint unsigned DEFAULT NULL,
  `koleksi_id` bigint unsigned DEFAULT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `status` enum('pending','ditolak','pinjam','kembali','terlambat','hilang') COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_anggota` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `judul_buku` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kode_transaksi_UNIQUE` (`kode_transaksi`),
  KEY `transaksi_anggota_id_foreign` (`anggota_id`),
  KEY `transaksi_koleksi_id_foreign` (`koleksi_id`),
  CONSTRAINT `transaksi_anggota_id_foreign` FOREIGN KEY (`anggota_id`) REFERENCES `anggota` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `transaksi_koleksi_id_foreign` FOREIGN KEY (`koleksi_id`) REFERENCES `koleksi` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaksi`
--

LOCK TABLES `transaksi` WRITE;
/*!40000 ALTER TABLE `transaksi` DISABLE KEYS */;
INSERT INTO `transaksi` VALUES (22,'yE8uDx',4,10,'2022-06-23','2022-06-24','ditolak','Miyawaki Sakura',NULL,'','2022-06-23 08:48:58','2022-06-23 08:50:22','2022-06-23 08:50:22'),(23,'yuZw3J',4,13,'2022-06-23','2022-06-24','ditolak','Miyawaki Sakura',NULL,'','2022-06-23 09:01:46','2022-06-23 09:04:17','2022-06-23 09:04:17'),(24,'ImiQfH',4,13,'2022-06-23','2022-06-27','kembali','Miyawaki Sakura',NULL,'','2022-06-23 09:05:11','2022-06-23 09:10:03',NULL),(25,'tG6Ily',4,13,'2022-06-23','2022-06-26','terlambat','Miyawaki Sakura',NULL,'','2022-06-23 09:10:55','2022-06-23 09:58:12',NULL),(26,'RNhISi',4,13,'2022-06-23','2022-06-24','kembali','Miyawaki Sakura',NULL,'','2022-06-23 10:00:47','2022-06-24 11:16:51',NULL),(27,'ANkI24',4,18,'2022-06-23','2022-06-25','hilang','Miyawaki Sakura',NULL,NULL,'2022-06-23 10:02:46','2022-06-24 11:16:43',NULL),(28,'ietlAi',4,19,'2022-06-23','2022-06-25','terlambat','Miyawaki Sakura',NULL,'','2022-06-23 10:04:36','2022-06-24 11:16:25',NULL),(29,'BZE7Cd',4,20,'2022-06-23','2022-06-25','kembali','Miyawaki Sakura',NULL,'','2022-06-23 10:04:49','2022-06-24 10:53:37',NULL),(30,'ojD22P',2,14,'2022-06-23','2022-06-25','kembali','Riska Miraldamar',NULL,NULL,'2022-06-23 10:17:01','2022-06-24 11:17:21',NULL),(31,'RU8ucN',2,15,'2022-06-24','2022-06-30','kembali','Riska Miraldamar',NULL,NULL,'2022-06-23 10:17:15','2022-06-24 11:17:16',NULL),(32,'sewRWu',6,10,'2022-06-24','2022-06-26','ditolak','Nakamura Kazuha',NULL,'','2022-06-24 11:08:22','2022-06-24 11:09:33','2022-06-24 11:09:33'),(33,'cJMGJB',4,13,'2022-06-24','2022-06-26','kembali','Miyawaki Sakura',NULL,NULL,'2022-06-24 11:38:57','2022-06-24 12:26:01',NULL),(34,'obzucU',4,14,'2022-06-24','2022-06-27','ditolak','Miyawaki Sakura',NULL,NULL,'2022-06-24 11:39:26','2022-06-24 12:25:52','2022-06-24 12:25:52'),(35,'gmHWlI',4,15,'2022-06-24','2022-06-25','ditolak','Miyawaki Sakura',NULL,'','2022-06-24 12:04:24','2022-06-24 12:25:46','2022-06-24 12:25:46'),(36,'1NwYCN',4,15,'2022-06-24','2022-06-25','ditolak','Miyawaki Sakura',NULL,'','2022-06-24 12:04:24','2022-06-24 12:25:50','2022-06-24 12:25:50'),(37,'jIQgoh',7,12,'2022-06-24','2022-06-26','kembali','farhan dwian',NULL,'','2022-06-24 12:21:33','2022-06-24 12:25:57',NULL),(38,'SimIbI',8,13,'2022-06-25','2022-06-28','kembali','reyvan adryan',NULL,NULL,'2022-06-24 12:42:14','2022-06-24 12:44:40',NULL);
/*!40000 ALTER TABLE `transaksi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (9,'sakura','sakura@gmail.com',NULL,'$2y$10$J9sWiIIJAfEWRqs.13BDsu0yvMkwtezNrGOZ6GJ4ifZtlnLvBJRoC','user',NULL,'2022-06-18 12:06:58','2022-06-18 12:06:58'),(12,'admin','admin@gmail.com',NULL,'$2y$10$wdtKvAq94csueMsziYQ7T.LGiJxu64VG5HymEAkw2DgQEobpsLrL2','admin',NULL,NULL,NULL),(13,'user','user@gmail.com',NULL,'$2y$10$JCoes2BIMANIuPpFHOUkiutLv2.ZuvcX8Px70uGl0jOxhuAtv2AIi','user',NULL,NULL,NULL),(14,'farhandwian','dwyanfarhan@gmail.com',NULL,'$2y$10$bWgBx.3ugTIkn.4N8xEChOWAPqxUTyzDigJ5NMHhZNlPyke9NVLg2','user',NULL,'2022-06-18 15:57:42','2022-06-18 15:57:42'),(15,'Kazuha','kazuha@gmail.com',NULL,'$2y$10$4lC/nBjpmSO13N9sP9Bs9.iPG./YBvvG8QWk6v30JfRKBHSVoH2PC','user',NULL,'2022-06-23 20:27:23','2022-06-23 20:27:23'),(16,'farhan dwian','farhan@gmail.com',NULL,'$2y$10$dIPOVIrGlPm5mpz0z.V1ael2Z8ndQc6HVYCVaezUz3nqfc67208ny','user',NULL,'2022-06-24 12:18:57','2022-06-24 12:18:57'),(17,'reyvan','reyvan@gmail.com',NULL,'$2y$10$9WLKkAto3n7eOq.SJJGpuekglsiFlQaVcbIB/YOD2afvDkLap8fGO','user',NULL,'2022-06-24 12:33:29','2022-06-24 12:33:29');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-06-24 20:01:45
