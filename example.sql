-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.26-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for projectwd
CREATE DATABASE IF NOT EXISTS `projectwd` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `projectwd`;

-- Dumping structure for table projectwd.books
CREATE TABLE IF NOT EXISTS `books` (
  `books_id` int(11) NOT NULL AUTO_INCREMENT,
  `isbn` varchar(10) NOT NULL DEFAULT '0',
  `title` varchar(50) NOT NULL DEFAULT '0',
  `author` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`books_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table projectwd.books: ~5 rows (approximately)
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
INSERT INTO `books` (`books_id`, `isbn`, `title`, `author`) VALUES
	(1, '0349108390', 'Generation X', 'Douglas Coupland'),
	(2, '0321687299', 'Introducing HTML5', 'Remy Sharp'),
	(3, '0321643380', 'Handcrafted CSS', 'Dan Cederholm'),
	(4, '0321509021', 'Bulletproof Web Design', 'Dan Cederholm'),
	(5, '0349113467', 'The Tipping Point', 'Malcolm Gladwell');
/*!40000 ALTER TABLE `books` ENABLE KEYS */;

-- Dumping structure for table projectwd.out_books
CREATE TABLE IF NOT EXISTS `out_books` (
  `books_id` int(11) DEFAULT NULL,
  `books_title` varchar(50) NOT NULL DEFAULT '0',
  `users_id` int(250) NOT NULL DEFAULT '0',
  `studentname` varchar(50) NOT NULL DEFAULT '0',
  `startdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `duedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table projectwd.out_books: ~4 rows (approximately)
/*!40000 ALTER TABLE `out_books` DISABLE KEYS */;
INSERT INTO `out_books` (`books_id`, `books_title`, `users_id`, `studentname`, `startdate`, `duedate`) VALUES
	(3, 'Handcrafted CSS', 1, 'vilma', '2017-12-02 14:55:16', '2017-12-02 15:08:10'),
	(1, 'Gneration X', 4, 'john', '2017-12-02 15:11:23', '2017-12-02 15:12:04'),
	(5, 'The Tipping Point', 5, 'erick', '2017-12-02 15:13:23', '2017-12-02 15:13:55'),
	(4, 'Bulletproof Web Design', 1, 'vilma', '2017-12-02 15:17:13', '2017-12-02 15:17:45');
/*!40000 ALTER TABLE `out_books` ENABLE KEYS */;

-- Dumping structure for table projectwd.users
CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `users_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`users_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- Dumping data for table projectwd.users: ~6 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`username`, `password`, `users_id`, `type`) VALUES
	('vilma', '1', 1, 'student'),
	('marika', '123', 2, 'admin'),
	('dale', '1', 3, 'student'),
	('john', '1', 4, 'student'),
	('erick', '1', 5, 'student'),
	('marius', '1', 13, '0');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
