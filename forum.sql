-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Server version:               5.6.17 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Версия:              9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table forum.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table forum.categories: ~4 rows (approximately)
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`, `category_name`) VALUES
	(1, 'Спорт'),
	(2, 'Технологии'),
	(3, 'Автомобили'),
	(4, 'Компютри');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;


-- Dumping structure for table forum.comments
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_comment` text NOT NULL,
  `comment_date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- Dumping data for table forum.comments: ~13 rows (approximately)
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` (`id`, `user_id`, `post_id`, `user_comment`, `comment_date`) VALUES
	(1, 1, 7, 'dasdasdas', '2016-05-18 18:35:51'),
	(2, 14, 7, 'as', '2016-05-18 19:39:16'),
	(3, 14, 7, 'asdsa', '2016-05-18 19:39:20'),
	(4, 14, 7, 'dasdasfgasgadfg', '2016-05-18 19:39:24'),
	(5, 14, 7, 'ret', '2016-05-18 19:40:48'),
	(6, 14, 7, 'qweqwfrqefqw', '2016-05-18 19:41:16'),
	(7, 14, 7, 'asd', '2016-05-18 19:41:42'),
	(8, 14, 7, 'a', '2016-05-18 19:41:45'),
	(9, 14, 7, 'dasf', '2016-05-18 19:41:48'),
	(10, 14, 7, 'dqw', '2016-05-18 19:47:15'),
	(11, 14, 8, 'haha', '2016-05-19 12:22:43'),
	(12, 1, 7, 'as', '2016-05-19 12:28:41'),
	(13, 14, 7, '213213232', '2016-05-19 12:37:19'),
	(14, 2, 7, '12', '2016-05-19 12:40:46');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;


-- Dumping structure for function forum.levenshtein
DELIMITER //
CREATE DEFINER=`root`@`localhost` FUNCTION `LEVENSHTEIN`( s1 VARCHAR(255), s2 VARCHAR(255) ) RETURNS int(11)
    DETERMINISTIC
BEGIN
DECLARE s1_len, s2_len, i, j, c, c_temp, cost INT;
DECLARE s1_char CHAR;
-- max strlen=255
DECLARE cv0, cv1 VARBINARY(256);
SET s1_len = CHAR_LENGTH(s1), s2_len = CHAR_LENGTH(s2), cv1 = 0x00, j = 1, i = 1, c = 0;
IF s1 = s2 THEN
RETURN 0;
ELSEIF s1_len = 0 THEN
RETURN s2_len;
ELSEIF s2_len = 0 THEN
RETURN s1_len;
ELSE
WHILE j <= s2_len DO
SET cv1 = CONCAT(cv1, UNHEX(HEX(j))), j = j + 1;
END WHILE;
WHILE i <= s1_len DO
SET s1_char = SUBSTRING(s1, i, 1), c = i, cv0 = UNHEX(HEX(i)), j = 1;
WHILE j <= s2_len DO
SET c = c + 1;
IF s1_char = SUBSTRING(s2, j, 1) THEN
SET cost = 0; ELSE SET cost = 1;
END IF;
SET c_temp = CONV(HEX(SUBSTRING(cv1, j, 1)), 16, 10) + cost;
IF c > c_temp THEN SET c = c_temp; END IF;
SET c_temp = CONV(HEX(SUBSTRING(cv1, j+1, 1)), 16, 10) + 1;
IF c > c_temp THEN
SET c = c_temp;
END IF;
SET cv0 = CONCAT(cv0, UNHEX(HEX(c))), j = j + 1;
END WHILE;
SET cv1 = cv0, i = i + 1;
END WHILE;
END IF;
RETURN c;
END//
DELIMITER ;


-- Dumping structure for table forum.posts
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_name` varchar(60) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `date_created` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FULLTEXT KEY `post_name` (`post_name`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

-- Dumping data for table forum.posts: ~21 rows (approximately)
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` (`id`, `post_name`, `user_id`, `category_id`, `date_created`) VALUES
	(1, 'БМВ', 1, 1, '2016-05-17 19:41:33'),
	(2, 'sc', 14, 1, '2016-05-18 15:01:10'),
	(3, 'xasd', 14, 1, '2016-05-18 15:02:20'),
	(4, 'asd', 14, 3, '2016-05-18 16:11:51'),
	(5, 'a', 14, 1, '2016-05-18 16:29:11'),
	(6, 's', 14, 1, '2016-05-18 16:29:14'),
	(7, 'd', 14, 1, '2016-05-18 16:29:16'),
	(8, 'neshto', 14, 4, '2016-05-19 12:03:50'),
	(9, 'koli', 14, 3, '2016-05-19 15:45:36'),
	(10, 'asdasd', 14, 2, '2016-05-19 17:27:50'),
	(11, 'asdasd', 14, 1, '2016-05-19 17:33:23'),
	(12, 'asawdwq2312312', 14, 2, '2016-05-19 17:35:35'),
	(13, '12', 14, 2, '2016-05-19 17:36:27'),
	(14, 'asdasd', 14, 1, '2016-05-19 17:38:55'),
	(15, '12', 14, 1, '2016-05-19 17:40:53'),
	(16, 'x', 14, 3, '2016-05-19 17:41:23'),
	(17, 'l', 14, 3, '2016-05-19 18:09:06'),
	(18, 'haha', 14, 1, '2016-05-25 14:46:37'),
	(19, 'hahi', 14, 1, '2016-05-25 14:47:08'),
	(20, 'kola', 14, 1, '2016-05-25 14:49:08'),
	(21, 'bul. Pliska 2', 14, 1, '2016-05-25 15:30:58'),
	(22, 'ul. Petyr Enchev 20', 14, 1, '2016-05-25 15:31:13'),
	(23, 'cool car', 14, 3, '2016-05-26 19:53:54'),
	(24, 'sky', 14, 1, '2016-05-26 19:58:16'),
	(25, 'sky', 14, 1, '2016-05-26 19:59:47'),
	(26, 'sky', 14, 2, '2016-05-26 20:01:12'),
	(27, 'asdasdvasfadgbsafdbsdf', 14, 1, '2016-05-26 20:07:04');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;


-- Dumping structure for table forum.replies
CREATE TABLE IF NOT EXISTS `replies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reply_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comments` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- Dumping data for table forum.replies: ~12 rows (approximately)
/*!40000 ALTER TABLE `replies` DISABLE KEYS */;
INSERT INTO `replies` (`id`, `comment_id`, `user_id`, `reply_date`, `comments`) VALUES
	(1, 0, 14, '2016-05-23 17:45:14', 'ас'),
	(2, 0, 14, '2016-05-23 17:54:57', 'асд'),
	(3, 0, 14, '2016-05-23 17:56:27', 'а'),
	(4, 14, 14, '2016-05-23 17:56:55', 'а'),
	(5, 14, 14, '2016-05-23 18:25:53', 'as'),
	(6, 12, 14, '2016-05-23 18:28:15', 'asd'),
	(7, 14, 14, '2016-05-23 21:41:40', 'fds'),
	(8, 12, 14, '2016-05-23 21:41:56', '12'),
	(9, 14, 14, '2016-05-24 01:35:02', 'dasd'),
	(10, 10, 14, '2016-05-25 11:42:23', 'sdf'),
	(11, 10, 14, '2016-05-25 11:42:39', 'asdsadsafc'),
	(12, 9, 14, '2016-05-25 11:42:54', '12');
/*!40000 ALTER TABLE `replies` ENABLE KEYS */;


-- Dumping structure for table forum.testing
CREATE TABLE IF NOT EXISTS `testing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_name` varchar(60) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `date_created` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FULLTEXT KEY `post_name` (`post_name`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- Dumping data for table forum.testing: 22 rows
/*!40000 ALTER TABLE `testing` DISABLE KEYS */;
INSERT INTO `testing` (`id`, `post_name`, `user_id`, `category_id`, `date_created`) VALUES
	(1, 'БМВ', 1, 1, '2016-05-17 19:41:33'),
	(2, 'sc', 14, 1, '2016-05-18 15:01:10'),
	(3, 'xasd', 14, 1, '2016-05-18 15:02:20'),
	(4, 'asd', 14, 3, '2016-05-18 16:11:51'),
	(5, 'a', 14, 1, '2016-05-18 16:29:11'),
	(6, 's', 14, 1, '2016-05-18 16:29:14'),
	(7, 'd', 14, 1, '2016-05-18 16:29:16'),
	(8, 'neshto', 14, 4, '2016-05-19 12:03:50'),
	(9, 'koli', 14, 3, '2016-05-19 15:45:36'),
	(10, 'asdasd', 14, 2, '2016-05-19 17:27:50'),
	(11, 'asdasd', 14, 1, '2016-05-19 17:33:23'),
	(12, 'asawdwq2312312', 14, 2, '2016-05-19 17:35:35'),
	(13, '12', 14, 2, '2016-05-19 17:36:27'),
	(14, 'asdasd', 14, 1, '2016-05-19 17:38:55'),
	(15, '12', 14, 1, '2016-05-19 17:40:53'),
	(16, 'x', 14, 3, '2016-05-19 17:41:23'),
	(17, 'l', 14, 3, '2016-05-19 18:09:06'),
	(18, 'haha', 14, 1, '2016-05-25 14:46:37'),
	(19, 'hahi', 14, 1, '2016-05-25 14:47:08'),
	(20, 'kola', 14, 1, '2016-05-25 14:49:08'),
	(21, 'bul. Pliska 2', 14, 1, '2016-05-25 15:30:58'),
	(22, 'ul. Petyr Enchev 20', 14, 1, '2016-05-25 15:31:13');
/*!40000 ALTER TABLE `testing` ENABLE KEYS */;


-- Dumping structure for table forum.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(60) NOT NULL,
  `user_password` varchar(60) NOT NULL,
  `last_online` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- Dumping data for table forum.users: ~12 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `user_name`, `user_password`, `last_online`) VALUES
	(1, 'qwer', 'asdf', NULL),
	(2, 'asdf', '912ec803b2ce49e4a541068d495ab570', NULL),
	(3, 'asdf', '912ec803b2ce49e4a541068d495ab570', NULL),
	(4, 'vbn', '8bbc2b904d0f41c51ae92c2268935b03', NULL),
	(5, 'vbn', '8bbc2b904d0f41c51ae92c2268935b03', NULL),
	(6, 'sadvsdb', '81dc9bdb52d04dc20036dbd8313ed055', NULL),
	(7, 'sadvsdb', '81dc9bdb52d04dc20036dbd8313ed055', NULL),
	(8, 'mistic12', '962012d09b8170d912f0669f6d7d9d07', NULL),
	(9, 'mistic12', '962012d09b8170d912f0669f6d7d9d07', NULL),
	(10, 'mistic12', '962012d09b8170d912f0669f6d7d9d07', NULL),
	(11, 'mistic12', '912ec803b2ce49e4a541068d495ab570', NULL),
	(12, 'q', '7694f4a66316e53c8cdd9d9954bd611d', NULL),
	(13, 'x', '9dd4e461268c8034f5c8564e155c67a6', '2016-05-17 15:32:47'),
	(14, 'c', '4a8a08f09d37b73795649038408b5f33', '2016-05-17 15:33:17');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
