-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.5.45 - MySQL Community Server (GPL)
-- ОС Сервера:                   Win32
-- HeidiSQL Версия:              9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп структуры базы данных BitrixShop
CREATE DATABASE IF NOT EXISTS `bitrixshop` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `BitrixShop`;


-- Дамп структуры для таблица BitrixShop.Artikul
CREATE TABLE IF NOT EXISTS `Artikul` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `tovar_id` int(11) NOT NULL,
  `artikul` int(11) NOT NULL,
  `price` double NOT NULL,
  `mass` varchar(20) NOT NULL,
  `s1` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы BitrixShop.Artikul: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `Artikul` DISABLE KEYS */;
/*!40000 ALTER TABLE `Artikul` ENABLE KEYS */;


-- Дамп структуры для таблица BitrixShop.Catalog
CREATE TABLE IF NOT EXISTS `Catalog` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_cat` int(11) NOT NULL,
  `s1` varchar(150) NOT NULL,
  `s2` varchar(150) NOT NULL,
  `s3` varchar(150) NOT NULL,
  `s4` varchar(150) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=284 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы BitrixShop.Catalog: ~283 rows (приблизительно)
/*!40000 ALTER TABLE `Catalog` DISABLE KEYS */;
INSERT INTO `Catalog` (`id`, `id_cat`, `s1`, `s2`, `s3`, `s4`) VALUES
	(1, 1, 'Товары для собак', 'Сухие корма', 'http://www.petshop.ru/catalog/dogs/syxoi/', ''),
	(2, 1, 'Товары для собак', 'Сухие корма', 'http://www.petshop.ru/catalog/dogs/syxoi/?page=2', ''),
	(3, 1, 'Товары для собак', 'Сухие корма', 'http://www.petshop.ru/catalog/dogs/syxoi/?page=3', ''),
	(4, 1, 'Товары для собак', 'Сухие корма', 'http://www.petshop.ru/catalog/dogs/syxoi/?page=4', ''),
	(5, 1, 'Товары для собак', 'Сухие корма', 'http://www.petshop.ru/catalog/dogs/syxoi/?page=5', ''),
	(6, 1, 'Товары для собак', 'Сухие корма', 'http://www.petshop.ru/catalog/dogs/syxoi/?page=6', ''),
	(7, 1, 'Товары для собак', 'Сухие корма', 'http://www.petshop.ru/catalog/dogs/syxoi/?page=7', ''),
	(8, 1, 'Товары для собак', 'Сухие корма', 'http://www.petshop.ru/catalog/dogs/syxoi/?page=8', ''),
	(9, 1, 'Товары для собак', 'Сухие корма', 'http://www.petshop.ru/catalog/dogs/syxoi/?page=9', ''),
	(10, 1, 'Товары для собак', 'Сухие корма', 'http://www.petshop.ru/catalog/dogs/syxoi/?page=10', ''),
	(11, 1, 'Товары для собак', 'Сухие корма', 'http://www.petshop.ru/catalog/dogs/syxoi/?page=11', ''),
	(12, 1, 'Товары для собак', 'Сухие корма', 'http://www.petshop.ru/catalog/dogs/syxoi/?page=12', ''),
	(13, 1, 'Товары для собак', 'Сухие корма', 'http://www.petshop.ru/catalog/dogs/syxoi/?page=13', ''),
	(14, 1, 'Товары для собак', 'Сухие корма', 'http://www.petshop.ru/catalog/dogs/syxoi/?page=14', ''),
	(15, 1, 'Товары для собак', 'Сухие корма', 'http://www.petshop.ru/catalog/dogs/syxoi/?page=15', ''),
	(16, 1, 'Товары для собак', 'Сухие корма', 'http://www.petshop.ru/catalog/dogs/syxoi/?page=16', ''),
	(17, 1, 'Товары для собак', 'Сухие корма', 'http://www.petshop.ru/catalog/dogs/syxoi/?page=17', ''),
	(18, 1, 'Товары для собак', 'Сухие корма', 'http://www.petshop.ru/catalog/dogs/syxoi/?page=18', ''),
	(19, 1, 'Товары для собак', 'Сухие корма', 'http://www.petshop.ru/catalog/dogs/syxoi/?page=19', ''),
	(20, 1, 'Товары для собак', 'Сухие корма', 'http://www.petshop.ru/catalog/dogs/syxoi/?page=20', ''),
	(21, 1, 'Товары для собак', 'Сухие корма', 'http://www.petshop.ru/catalog/dogs/syxoi/?page=21', ''),
	(22, 1, 'Товары для собак', 'Сухие корма', 'http://www.petshop.ru/catalog/dogs/syxoi/?page=22', ''),
	(23, 1, 'Товары для собак', 'Сухие корма', 'http://www.petshop.ru/catalog/dogs/syxoi/?page=23', ''),
	(24, 1, 'Товары для собак', 'Сухие корма', 'http://www.petshop.ru/catalog/dogs/syxoi/?page=24', ''),
	(25, 2, 'Товары для собак', 'Консервы', 'http://www.petshop.ru/catalog/dogs/konsevvi/', ''),
	(26, 2, 'Товары для собак', 'Консервы', 'http://www.petshop.ru/catalog/dogs/konsevvi/?page=2', ''),
	(27, 2, 'Товары для собак', 'Консервы', 'http://www.petshop.ru/catalog/dogs/konsevvi/?page=3', ''),
	(28, 2, 'Товары для собак', 'Консервы', 'http://www.petshop.ru/catalog/dogs/konsevvi/?page=4', ''),
	(29, 2, 'Товары для собак', 'Консервы', 'http://www.petshop.ru/catalog/dogs/konsevvi/?page=5', ''),
	(30, 2, 'Товары для собак', 'Консервы', 'http://www.petshop.ru/catalog/dogs/konsevvi/?page=6', ''),
	(31, 2, 'Товары для собак', 'Консервы', 'http://www.petshop.ru/catalog/dogs/konsevvi/?page=7', ''),
	(32, 2, 'Товары для собак', 'Консервы', 'http://www.petshop.ru/catalog/dogs/konsevvi/?page=8', ''),
	(33, 2, 'Товары для собак', 'Консервы', 'http://www.petshop.ru/catalog/dogs/konsevvi/?page=9', ''),
	(34, 2, 'Товары для собак', 'Консервы', 'http://www.petshop.ru/catalog/dogs/konsevvi/?page=10', ''),
	(35, 2, 'Товары для собак', 'Консервы', 'http://www.petshop.ru/catalog/dogs/konsevvi/?page=11', ''),
	(36, 2, 'Товары для собак', 'Консервы', 'http://www.petshop.ru/catalog/dogs/konsevvi/?page=12', ''),
	(37, 2, 'Товары для собак', 'Консервы', 'http://www.petshop.ru/catalog/dogs/konsevvi/?page=13', ''),
	(38, 2, 'Товары для собак', 'Консервы', 'http://www.petshop.ru/catalog/dogs/konsevvi/?page=14', ''),
	(39, 2, 'Товары для собак', 'Консервы', 'http://www.petshop.ru/catalog/dogs/konsevvi/?page=15', ''),
	(40, 2, 'Товары для собак', 'Консервы', 'http://www.petshop.ru/catalog/dogs/konsevvi/?page=16', ''),
	(41, 2, 'Товары для собак', 'Консервы', 'http://www.petshop.ru/catalog/dogs/konsevvi/?page=17', ''),
	(42, 3, 'Товары для собак', 'Лакомства', 'http://www.petshop.ru/catalog/dogs/kosti/', ''),
	(43, 3, 'Товары для собак', 'Лакомства', 'http://www.petshop.ru/catalog/dogs/kosti/?page=2', ''),
	(44, 3, 'Товары для собак', 'Лакомства', 'http://www.petshop.ru/catalog/dogs/kosti/?page=3', ''),
	(45, 3, 'Товары для собак', 'Лакомства', 'http://www.petshop.ru/catalog/dogs/kosti/?page=4', ''),
	(46, 3, 'Товары для собак', 'Лакомства', 'http://www.petshop.ru/catalog/dogs/kosti/?page=5', ''),
	(47, 3, 'Товары для собак', 'Лакомства', 'http://www.petshop.ru/catalog/dogs/kosti/?page=6', ''),
	(48, 3, 'Товары для собак', 'Лакомства', 'http://www.petshop.ru/catalog/dogs/kosti/?page=7', ''),
	(49, 3, 'Товары для собак', 'Лакомства', 'http://www.petshop.ru/catalog/dogs/kosti/?page=8', ''),
	(50, 3, 'Товары для собак', 'Лакомства', 'http://www.petshop.ru/catalog/dogs/kosti/?page=9', ''),
	(51, 3, 'Товары для собак', 'Лакомства', 'http://www.petshop.ru/catalog/dogs/kosti/?page=10', ''),
	(52, 3, 'Товары для собак', 'Лакомства', 'http://www.petshop.ru/catalog/dogs/kosti/?page=11', ''),
	(53, 3, 'Товары для собак', 'Лакомства', 'http://www.petshop.ru/catalog/dogs/kosti/?page=12', ''),
	(54, 3, 'Товары для собак', 'Лакомства', 'http://www.petshop.ru/catalog/dogs/kosti/?page=13', ''),
	(55, 3, 'Товары для собак', 'Лакомства', 'http://www.petshop.ru/catalog/dogs/kosti/?page=14', ''),
	(56, 3, 'Товары для собак', 'Лакомства', 'http://www.petshop.ru/catalog/dogs/kosti/?page=15', ''),
	(57, 4, 'Товары для собак', 'Ветеринарная аптека', 'http://www.petshop.ru/catalog/dogs/vet/', ''),
	(58, 4, 'Товары для собак', 'Ветеринарная аптека', 'http://www.petshop.ru/catalog/dogs/vet/?page=2', ''),
	(59, 4, 'Товары для собак', 'Ветеринарная аптека', 'http://www.petshop.ru/catalog/dogs/vet/?page=3', ''),
	(60, 4, 'Товары для собак', 'Ветеринарная аптека', 'http://www.petshop.ru/catalog/dogs/vet/?page=4', ''),
	(61, 4, 'Товары для собак', 'Ветеринарная аптека', 'http://www.petshop.ru/catalog/dogs/vet/?page=5', ''),
	(62, 4, 'Товары для собак', 'Ветеринарная аптека', 'http://www.petshop.ru/catalog/dogs/vet/?page=6', ''),
	(63, 4, 'Товары для собак', 'Ветеринарная аптека', 'http://www.petshop.ru/catalog/dogs/vet/?page=7', ''),
	(64, 4, 'Товары для собак', 'Ветеринарная аптека', 'http://www.petshop.ru/catalog/dogs/vet/?page=8', ''),
	(65, 4, 'Товары для собак', 'Ветеринарная аптека', 'http://www.petshop.ru/catalog/dogs/vet/?page=9', ''),
	(66, 4, 'Товары для собак', 'Ветеринарная аптека', 'http://www.petshop.ru/catalog/dogs/vet/?page=10', ''),
	(67, 4, 'Товары для собак', 'Ветеринарная аптека', 'http://www.petshop.ru/catalog/dogs/vet/?page=11', ''),
	(68, 4, 'Товары для собак', 'Ветеринарная аптека', 'http://www.petshop.ru/catalog/dogs/vet/?page=12', ''),
	(69, 5, 'Товары для собак', 'Витамины, пищ. добавки', 'http://www.petshop.ru/catalog/dogs/vitamins/', ''),
	(70, 5, 'Товары для собак', 'Витамины, пищ. добавки', 'http://www.petshop.ru/catalog/dogs/vitamins/?page=2', ''),
	(71, 5, 'Товары для собак', 'Витамины, пищ. добавки', 'http://www.petshop.ru/catalog/dogs/vitamins/?page=3', ''),
	(72, 5, 'Товары для собак', 'Витамины, пищ. добавки', 'http://www.petshop.ru/catalog/dogs/vitamins/?page=4', ''),
	(73, 6, 'Товары для собак', 'Гигиена, пеленки', 'http://www.petshop.ru/catalog/dogs/parazdog/', ''),
	(74, 6, 'Товары для собак', 'Гигиена, пеленки', 'http://www.petshop.ru/catalog/dogs/parazdog/?page=2', ''),
	(75, 6, 'Товары для собак', 'Гигиена, пеленки', 'http://www.petshop.ru/catalog/dogs/parazdog/?page=3', ''),
	(76, 6, 'Товары для собак', 'Гигиена, пеленки', 'http://www.petshop.ru/catalog/dogs/parazdog/?page=4', ''),
	(77, 6, 'Товары для собак', 'Гигиена, пеленки', 'http://www.petshop.ru/catalog/dogs/parazdog/?page=5', ''),
	(78, 7, 'Товары для собак', 'Груминг, Косметика', 'http://www.petshop.ru/catalog/dogs/tovzd/', ''),
	(79, 7, 'Товары для собак', 'Груминг, Косметика', 'http://www.petshop.ru/catalog/dogs/tovzd/?page=2', ''),
	(80, 7, 'Товары для собак', 'Груминг, Косметика', 'http://www.petshop.ru/catalog/dogs/tovzd/?page=3', ''),
	(81, 7, 'Товары для собак', 'Груминг, Косметика', 'http://www.petshop.ru/catalog/dogs/tovzd/?page=4', ''),
	(82, 7, 'Товары для собак', 'Груминг, Косметика', 'http://www.petshop.ru/catalog/dogs/tovzd/?page=5', ''),
	(83, 7, 'Товары для собак', 'Груминг, Косметика', 'http://www.petshop.ru/catalog/dogs/tovzd/?page=6', ''),
	(84, 7, 'Товары для собак', 'Груминг, Косметика', 'http://www.petshop.ru/catalog/dogs/tovzd/?page=7', ''),
	(85, 7, 'Товары для собак', 'Груминг, Косметика', 'http://www.petshop.ru/catalog/dogs/tovzd/?page=8', ''),
	(86, 7, 'Товары для собак', 'Груминг, Косметика', 'http://www.petshop.ru/catalog/dogs/tovzd/?page=9', ''),
	(87, 7, 'Товары для собак', 'Груминг, Косметика', 'http://www.petshop.ru/catalog/dogs/tovzd/?page=10', ''),
	(88, 7, 'Товары для собак', 'Груминг, Косметика', 'http://www.petshop.ru/catalog/dogs/tovzd/?page=11', ''),
	(89, 7, 'Товары для собак', 'Груминг, Косметика', 'http://www.petshop.ru/catalog/dogs/tovzd/?page=12', ''),
	(90, 7, 'Товары для собак', 'Груминг, Косметика', 'http://www.petshop.ru/catalog/dogs/tovzd/?page=13', ''),
	(91, 7, 'Товары для собак', 'Груминг, Косметика', 'http://www.petshop.ru/catalog/dogs/tovzd/?page=14', ''),
	(92, 7, 'Товары для собак', 'Груминг, Косметика', 'http://www.petshop.ru/catalog/dogs/tovzd/?page=15', ''),
	(93, 7, 'Товары для собак', 'Груминг, Косметика', 'http://www.petshop.ru/catalog/dogs/tovzd/?page=16', ''),
	(94, 8, 'Товары для собак', 'Игрушки', 'http://www.petshop.ru/catalog/dogs/games/', ''),
	(95, 8, 'Товары для собак', 'Игрушки', 'http://www.petshop.ru/catalog/dogs/games/?page=2', ''),
	(96, 8, 'Товары для собак', 'Игрушки', 'http://www.petshop.ru/catalog/dogs/games/?page=3', ''),
	(97, 8, 'Товары для собак', 'Игрушки', 'http://www.petshop.ru/catalog/dogs/games/?page=4', ''),
	(98, 8, 'Товары для собак', 'Игрушки', 'http://www.petshop.ru/catalog/dogs/games/?page=5', ''),
	(99, 8, 'Товары для собак', 'Игрушки', 'http://www.petshop.ru/catalog/dogs/games/?page=6', ''),
	(100, 8, 'Товары для собак', 'Игрушки', 'http://www.petshop.ru/catalog/dogs/games/?page=7', ''),
	(101, 8, 'Товары для собак', 'Игрушки', 'http://www.petshop.ru/catalog/dogs/games/?page=8', ''),
	(102, 8, 'Товары для собак', 'Игрушки', 'http://www.petshop.ru/catalog/dogs/games/?page=9', ''),
	(103, 8, 'Товары для собак', 'Игрушки', 'http://www.petshop.ru/catalog/dogs/games/?page=10', ''),
	(104, 8, 'Товары для собак', 'Игрушки', 'http://www.petshop.ru/catalog/dogs/games/?page=11', ''),
	(105, 8, 'Товары для собак', 'Игрушки', 'http://www.petshop.ru/catalog/dogs/games/?page=12', ''),
	(106, 8, 'Товары для собак', 'Игрушки', 'http://www.petshop.ru/catalog/dogs/games/?page=13', ''),
	(107, 8, 'Товары для собак', 'Игрушки', 'http://www.petshop.ru/catalog/dogs/games/?page=14', ''),
	(108, 8, 'Товары для собак', 'Игрушки', 'http://www.petshop.ru/catalog/dogs/games/?page=15', ''),
	(109, 8, 'Товары для собак', 'Игрушки', 'http://www.petshop.ru/catalog/dogs/games/?page=16', ''),
	(110, 8, 'Товары для собак', 'Игрушки', 'http://www.petshop.ru/catalog/dogs/games/?page=17', ''),
	(111, 9, 'Товары для собак', 'Транспортировка, переноски', 'http://www.petshop.ru/catalog/dogs/trainsportdogs/', ''),
	(112, 9, 'Товары для собак', 'Транспортировка, переноски', 'http://www.petshop.ru/catalog/dogs/trainsportdogs/?page=2', ''),
	(113, 9, 'Товары для собак', 'Транспортировка, переноски', 'http://www.petshop.ru/catalog/dogs/trainsportdogs/?page=3', ''),
	(114, 9, 'Товары для собак', 'Транспортировка, переноски', 'http://www.petshop.ru/catalog/dogs/trainsportdogs/?page=4', ''),
	(115, 9, 'Товары для собак', 'Транспортировка, переноски', 'http://www.petshop.ru/catalog/dogs/trainsportdogs/?page=5', ''),
	(116, 10, 'Товары для собак', 'Лежаки', 'http://www.petshop.ru/catalog/dogs/lezaki/', ''),
	(117, 10, 'Товары для собак', 'Лежаки', 'http://www.petshop.ru/catalog/dogs/lezaki/?page=2', ''),
	(118, 10, 'Товары для собак', 'Лежаки', 'http://www.petshop.ru/catalog/dogs/lezaki/?page=3', ''),
	(119, 10, 'Товары для собак', 'Лежаки', 'http://www.petshop.ru/catalog/dogs/lezaki/?page=4', ''),
	(120, 10, 'Товары для собак', 'Лежаки', 'http://www.petshop.ru/catalog/dogs/lezaki/?page=5', ''),
	(121, 10, 'Товары для собак', 'Лежаки', 'http://www.petshop.ru/catalog/dogs/lezaki/?page=6', ''),
	(122, 10, 'Товары для собак', 'Лежаки', 'http://www.petshop.ru/catalog/dogs/lezaki/?page=7', ''),
	(123, 10, 'Товары для собак', 'Лежаки', 'http://www.petshop.ru/catalog/dogs/lezaki/?page=8', ''),
	(124, 10, 'Товары для собак', 'Лежаки', 'http://www.petshop.ru/catalog/dogs/lezaki/?page=9', ''),
	(125, 11, 'Товары для кошек', 'Сухой корм', 'http://www.petshop.ru/catalog/cats/syxkor/', ''),
	(126, 11, 'Товары для кошек', 'Сухой корм', 'http://www.petshop.ru/catalog/cats/syxkor/?page=2', ''),
	(127, 11, 'Товары для кошек', 'Сухой корм', 'http://www.petshop.ru/catalog/cats/syxkor/?page=3', ''),
	(128, 11, 'Товары для кошек', 'Сухой корм', 'http://www.petshop.ru/catalog/cats/syxkor/?page=4', ''),
	(129, 11, 'Товары для кошек', 'Сухой корм', 'http://www.petshop.ru/catalog/cats/syxkor/?page=5', ''),
	(130, 11, 'Товары для кошек', 'Сухой корм', 'http://www.petshop.ru/catalog/cats/syxkor/?page=6', ''),
	(131, 11, 'Товары для кошек', 'Сухой корм', 'http://www.petshop.ru/catalog/cats/syxkor/?page=7', ''),
	(132, 11, 'Товары для кошек', 'Сухой корм', 'http://www.petshop.ru/catalog/cats/syxkor/?page=8', ''),
	(133, 11, 'Товары для кошек', 'Сухой корм', 'http://www.petshop.ru/catalog/cats/syxkor/?page=9', ''),
	(134, 11, 'Товары для кошек', 'Сухой корм', 'http://www.petshop.ru/catalog/cats/syxkor/?page=10', ''),
	(135, 11, 'Товары для кошек', 'Сухой корм', 'http://www.petshop.ru/catalog/cats/syxkor/?page=11', ''),
	(136, 11, 'Товары для кошек', 'Сухой корм', 'http://www.petshop.ru/catalog/cats/syxkor/?page=12', ''),
	(137, 11, 'Товары для кошек', 'Сухой корм', 'http://www.petshop.ru/catalog/cats/syxkor/?page=13', ''),
	(138, 11, 'Товары для кошек', 'Сухой корм', 'http://www.petshop.ru/catalog/cats/syxkor/?page=14', ''),
	(139, 11, 'Товары для кошек', 'Сухой корм', 'http://www.petshop.ru/catalog/cats/syxkor/?page=15', ''),
	(140, 12, 'Товары для кошек', 'Консервы', 'http://www.petshop.ru/catalog/cats/cat-tinned/', ''),
	(141, 12, 'Товары для кошек', 'Консервы', 'http://www.petshop.ru/catalog/cats/cat-tinned/?page=2', ''),
	(142, 12, 'Товары для кошек', 'Консервы', 'http://www.petshop.ru/catalog/cats/cat-tinned/?page=3', ''),
	(143, 12, 'Товары для кошек', 'Консервы', 'http://www.petshop.ru/catalog/cats/cat-tinned/?page=4', ''),
	(144, 12, 'Товары для кошек', 'Консервы', 'http://www.petshop.ru/catalog/cats/cat-tinned/?page=5', ''),
	(145, 12, 'Товары для кошек', 'Консервы', 'http://www.petshop.ru/catalog/cats/cat-tinned/?page=6', ''),
	(146, 12, 'Товары для кошек', 'Консервы', 'http://www.petshop.ru/catalog/cats/cat-tinned/?page=7', ''),
	(147, 12, 'Товары для кошек', 'Консервы', 'http://www.petshop.ru/catalog/cats/cat-tinned/?page=8', ''),
	(148, 12, 'Товары для кошек', 'Консервы', 'http://www.petshop.ru/catalog/cats/cat-tinned/?page=9', ''),
	(149, 12, 'Товары для кошек', 'Консервы', 'http://www.petshop.ru/catalog/cats/cat-tinned/?page=10', ''),
	(150, 12, 'Товары для кошек', 'Консервы', 'http://www.petshop.ru/catalog/cats/cat-tinned/?page=11', ''),
	(151, 12, 'Товары для кошек', 'Консервы', 'http://www.petshop.ru/catalog/cats/cat-tinned/?page=12', ''),
	(152, 12, 'Товары для кошек', 'Консервы', 'http://www.petshop.ru/catalog/cats/cat-tinned/?page=13', ''),
	(153, 12, 'Товары для кошек', 'Консервы', 'http://www.petshop.ru/catalog/cats/cat-tinned/?page=14', ''),
	(154, 12, 'Товары для кошек', 'Консервы', 'http://www.petshop.ru/catalog/cats/cat-tinned/?page=15', ''),
	(155, 12, 'Товары для кошек', 'Консервы', 'http://www.petshop.ru/catalog/cats/cat-tinned/?page=16', ''),
	(156, 12, 'Товары для кошек', 'Консервы', 'http://www.petshop.ru/catalog/cats/cat-tinned/?page=17', ''),
	(157, 12, 'Товары для кошек', 'Консервы', 'http://www.petshop.ru/catalog/cats/cat-tinned/?page=18', ''),
	(158, 12, 'Товары для кошек', 'Консервы', 'http://www.petshop.ru/catalog/cats/cat-tinned/?page=19', ''),
	(159, 12, 'Товары для кошек', 'Консервы', 'http://www.petshop.ru/catalog/cats/cat-tinned/?page=20', ''),
	(160, 12, 'Товары для кошек', 'Консервы', 'http://www.petshop.ru/catalog/cats/cat-tinned/?page=21', ''),
	(161, 12, 'Товары для кошек', 'Консервы', 'http://www.petshop.ru/catalog/cats/cat-tinned/?page=22', ''),
	(162, 12, 'Товары для кошек', 'Консервы', 'http://www.petshop.ru/catalog/cats/cat-tinned/?page=23', ''),
	(163, 12, 'Товары для кошек', 'Консервы', 'http://www.petshop.ru/catalog/cats/cat-tinned/?page=24', ''),
	(164, 12, 'Товары для кошек', 'Консервы', 'http://www.petshop.ru/catalog/cats/cat-tinned/?page=25', ''),
	(165, 12, 'Товары для кошек', 'Консервы', 'http://www.petshop.ru/catalog/cats/cat-tinned/?page=26', ''),
	(166, 12, 'Товары для кошек', 'Консервы', 'http://www.petshop.ru/catalog/cats/cat-tinned/?page=27', ''),
	(167, 12, 'Товары для кошек', 'Консервы', 'http://www.petshop.ru/catalog/cats/cat-tinned/?page=28', ''),
	(168, 12, 'Товары для кошек', 'Консервы', 'http://www.petshop.ru/catalog/cats/cat-tinned/?page=29', ''),
	(169, 12, 'Товары для кошек', 'Консервы', 'http://www.petshop.ru/catalog/cats/cat-tinned/?page=30', ''),
	(170, 12, 'Товары для кошек', 'Консервы', 'http://www.petshop.ru/catalog/cats/cat-tinned/?page=31', ''),
	(171, 12, 'Товары для кошек', 'Консервы', 'http://www.petshop.ru/catalog/cats/cat-tinned/?page=32', ''),
	(172, 12, 'Товары для кошек', 'Консервы', 'http://www.petshop.ru/catalog/cats/cat-tinned/?page=33', ''),
	(173, 12, 'Товары для кошек', 'Консервы', 'http://www.petshop.ru/catalog/cats/cat-tinned/?page=34', ''),
	(174, 12, 'Товары для кошек', 'Консервы', 'http://www.petshop.ru/catalog/cats/cat-tinned/?page=35', ''),
	(175, 13, 'Товары для кошек', 'Наполнители', 'http://www.petshop.ru/catalog/cats/tualety/', ''),
	(176, 13, 'Товары для кошек', 'Наполнители', 'http://www.petshop.ru/catalog/cats/tualety/?page=2', ''),
	(177, 13, 'Товары для кошек', 'Наполнители', 'http://www.petshop.ru/catalog/cats/tualety/?page=3', ''),
	(178, 13, 'Товары для кошек', 'Наполнители', 'http://www.petshop.ru/catalog/cats/tualety/?page=4', ''),
	(179, 13, 'Товары для кошек', 'Наполнители', 'http://www.petshop.ru/catalog/cats/tualety/?page=5', ''),
	(180, 13, 'Товары для кошек', 'Наполнители', 'http://www.petshop.ru/catalog/cats/tualety/?page=6', ''),
	(181, 13, 'Товары для кошек', 'Наполнители', 'http://www.petshop.ru/catalog/cats/tualety/?page=7', ''),
	(182, 14, 'Товары для кошек', 'Ветеринарная аптека', 'http://www.petshop.ru/catalog/cats/vet/', ''),
	(183, 14, 'Товары для кошек', 'Ветеринарная аптека', 'http://www.petshop.ru/catalog/cats/vet/?page=2', ''),
	(184, 14, 'Товары для кошек', 'Ветеринарная аптека', 'http://www.petshop.ru/catalog/cats/vet/?page=3', ''),
	(185, 14, 'Товары для кошек', 'Ветеринарная аптека', 'http://www.petshop.ru/catalog/cats/vet/?page=4', ''),
	(186, 14, 'Товары для кошек', 'Ветеринарная аптека', 'http://www.petshop.ru/catalog/cats/vet/?page=5', ''),
	(187, 14, 'Товары для кошек', 'Ветеринарная аптека', 'http://www.petshop.ru/catalog/cats/vet/?page=6', ''),
	(188, 14, 'Товары для кошек', 'Ветеринарная аптека', 'http://www.petshop.ru/catalog/cats/vet/?page=7', ''),
	(189, 14, 'Товары для кошек', 'Ветеринарная аптека', 'http://www.petshop.ru/catalog/cats/vet/?page=8', ''),
	(190, 14, 'Товары для кошек', 'Ветеринарная аптека', 'http://www.petshop.ru/catalog/cats/vet/?page=9', ''),
	(191, 15, 'Товары для кошек', 'Витамины, лакомства', 'http://www.petshop.ru/catalog/cats/Vitaminss/', ''),
	(192, 15, 'Товары для кошек', 'Витамины, лакомства', 'http://www.petshop.ru/catalog/cats/Vitaminss/?page=2', ''),
	(193, 15, 'Товары для кошек', 'Витамины, лакомства', 'http://www.petshop.ru/catalog/cats/Vitaminss/?page=3', ''),
	(194, 15, 'Товары для кошек', 'Витамины, лакомства', 'http://www.petshop.ru/catalog/cats/Vitaminss/?page=4', ''),
	(195, 15, 'Товары для кошек', 'Витамины, лакомства', 'http://www.petshop.ru/catalog/cats/Vitaminss/?page=5', ''),
	(196, 15, 'Товары для кошек', 'Витамины, лакомства', 'http://www.petshop.ru/catalog/cats/Vitaminss/?page=6', ''),
	(197, 15, 'Товары для кошек', 'Витамины, лакомства', 'http://www.petshop.ru/catalog/cats/Vitaminss/?page=7', ''),
	(198, 16, 'Товары для кошек', 'Гигиена', 'http://www.petshop.ru/catalog/cats/gigienacat/', ''),
	(199, 16, 'Товары для кошек', 'Гигиена', 'http://www.petshop.ru/catalog/cats/gigienacat/?page=2', ''),
	(200, 17, 'Товары для кошек', 'Груминг, Косметика', 'http://www.petshop.ru/catalog/cats/sherst/', ''),
	(201, 17, 'Товары для кошек', 'Груминг, Косметика', 'http://www.petshop.ru/catalog/cats/sherst/?page=2', ''),
	(202, 17, 'Товары для кошек', 'Груминг, Косметика', 'http://www.petshop.ru/catalog/cats/sherst/?page=3', ''),
	(203, 17, 'Товары для кошек', 'Груминг, Косметика', 'http://www.petshop.ru/catalog/cats/sherst/?page=4', ''),
	(204, 17, 'Товары для кошек', 'Груминг, Косметика', 'http://www.petshop.ru/catalog/cats/sherst/?page=5', ''),
	(205, 17, 'Товары для кошек', 'Груминг, Косметика', 'http://www.petshop.ru/catalog/cats/sherst/?page=6', ''),
	(206, 17, 'Товары для кошек', 'Груминг, Косметика', 'http://www.petshop.ru/catalog/cats/sherst/?page=7', ''),
	(207, 17, 'Товары для кошек', 'Груминг, Косметика', 'http://www.petshop.ru/catalog/cats/sherst/?page=8', ''),
	(208, 17, 'Товары для кошек', 'Груминг, Косметика', 'http://www.petshop.ru/catalog/cats/sherst/?page=9', ''),
	(209, 17, 'Товары для кошек', 'Груминг, Косметика', 'http://www.petshop.ru/catalog/cats/sherst/?page=10', ''),
	(210, 17, 'Товары для кошек', 'Груминг, Косметика', 'http://www.petshop.ru/catalog/cats/sherst/?page=11', ''),
	(211, 17, 'Товары для кошек', 'Груминг, Косметика', 'http://www.petshop.ru/catalog/cats/sherst/?page=12', ''),
	(212, 17, 'Товары для кошек', 'Груминг, Косметика', 'http://www.petshop.ru/catalog/cats/sherst/?page=13', ''),
	(213, 17, 'Товары для кошек', 'Груминг, Косметика', 'http://www.petshop.ru/catalog/cats/sherst/?page=14', ''),
	(214, 17, 'Товары для кошек', 'Груминг, Косметика', 'http://www.petshop.ru/catalog/cats/sherst/?page=15', ''),
	(215, 18, 'Товары для кошек', 'Игрушки', 'http://www.petshop.ru/catalog/cats/toys/', ''),
	(216, 18, 'Товары для кошек', 'Игрушки', 'http://www.petshop.ru/catalog/cats/toys/?page=2', ''),
	(217, 18, 'Товары для кошек', 'Игрушки', 'http://www.petshop.ru/catalog/cats/toys/?page=3', ''),
	(218, 18, 'Товары для кошек', 'Игрушки', 'http://www.petshop.ru/catalog/cats/toys/?page=4', ''),
	(219, 18, 'Товары для кошек', 'Игрушки', 'http://www.petshop.ru/catalog/cats/toys/?page=5', ''),
	(220, 18, 'Товары для кошек', 'Игрушки', 'http://www.petshop.ru/catalog/cats/toys/?page=6', ''),
	(221, 18, 'Товары для кошек', 'Игрушки', 'http://www.petshop.ru/catalog/cats/toys/?page=7', ''),
	(222, 19, 'Товары для кошек', 'Транспортировка, переноски', 'http://www.petshop.ru/catalog/cats/trainsportcats/', ''),
	(223, 19, 'Товары для кошек', 'Транспортировка, переноски', 'http://www.petshop.ru/catalog/cats/trainsportcats/?page=2', ''),
	(224, 19, 'Товары для кошек', 'Транспортировка, переноски', 'http://www.petshop.ru/catalog/cats/trainsportcats/?page=3', ''),
	(225, 19, 'Товары для кошек', 'Транспортировка, переноски', 'http://www.petshop.ru/catalog/cats/trainsportcats/?page=4', ''),
	(226, 20, 'Товары для кошек', 'Когтеточки, домики', 'http://www.petshop.ru/catalog/cats/kogti/', ''),
	(227, 20, 'Товары для кошек', 'Когтеточки, домики', 'http://www.petshop.ru/catalog/cats/kogti/?page=2', ''),
	(228, 20, 'Товары для кошек', 'Когтеточки, домики', 'http://www.petshop.ru/catalog/cats/kogti/?page=3', ''),
	(229, 20, 'Товары для кошек', 'Когтеточки, домики', 'http://www.petshop.ru/catalog/cats/kogti/?page=4', ''),
	(230, 20, 'Товары для кошек', 'Когтеточки, домики', 'http://www.petshop.ru/catalog/cats/kogti/?page=5', ''),
	(231, 20, 'Товары для кошек', 'Когтеточки, домики', 'http://www.petshop.ru/catalog/cats/kogti/?page=6', ''),
	(232, 20, 'Товары для кошек', 'Когтеточки, домики', 'http://www.petshop.ru/catalog/cats/kogti/?page=7', ''),
	(233, 21, 'Для грызунов и хорьков', 'Сухой корм', 'http://www.petshop.ru/catalog/rodents/syxkor/', ''),
	(234, 21, 'Для грызунов и хорьков', 'Сухой корм', 'http://www.petshop.ru/catalog/rodents/syxkor/?page=2', ''),
	(235, 21, 'Для грызунов и хорьков', 'Сухой корм', 'http://www.petshop.ru/catalog/rodents/syxkor/?page=3', ''),
	(236, 21, 'Для грызунов и хорьков', 'Сухой корм', 'http://www.petshop.ru/catalog/rodents/syxkor/?page=4', ''),
	(237, 22, 'Для грызунов и хорьков', 'Гигиена, косметика', 'http://www.petshop.ru/catalog/rodents/health/', ''),
	(238, 23, 'Для грызунов и хорьков', 'Лакомства', 'http://www.petshop.ru/catalog/rodents/lak/', ''),
	(239, 23, 'Для грызунов и хорьков', 'Лакомства', 'http://www.petshop.ru/catalog/rodents/lak/?page=2', ''),
	(240, 23, 'Для грызунов и хорьков', 'Лакомства', 'http://www.petshop.ru/catalog/rodents/lak/?page=3', ''),
	(241, 23, 'Для грызунов и хорьков', 'Лакомства', 'http://www.petshop.ru/catalog/rodents/lak/?page=4', ''),
	(242, 23, 'Для грызунов и хорьков', 'Лакомства', 'http://www.petshop.ru/catalog/rodents/lak/?page=5', ''),
	(243, 24, 'Для грызунов и хорьков', 'Клетки, переноски, кормушки', 'http://www.petshop.ru/catalog/rodents/kletki/', ''),
	(244, 24, 'Для грызунов и хорьков', 'Клетки, переноски, кормушки', 'http://www.petshop.ru/catalog/rodents/kletki/?page=2', ''),
	(245, 24, 'Для грызунов и хорьков', 'Клетки, переноски, кормушки', 'http://www.petshop.ru/catalog/rodents/kletki/?page=3', ''),
	(246, 24, 'Для грызунов и хорьков', 'Клетки, переноски, кормушки', 'http://www.petshop.ru/catalog/rodents/kletki/?page=4', ''),
	(247, 25, 'Для грызунов и хорьков', 'Наполнители, сено, опилки', 'http://www.petshop.ru/catalog/rodents/napoln/', ''),
	(248, 25, 'Для грызунов и хорьков', 'Наполнители, сено, опилки', 'http://www.petshop.ru/catalog/rodents/napoln/?page=2', ''),
	(249, 26, 'Для грызунов и хорьков', 'Игрушки', 'http://www.petshop.ru/catalog/rodents/toys/', ''),
	(250, 27, 'Товары для рыб', 'Корм', 'http://www.petshop.ru/catalog/fish/korm/', ''),
	(251, 27, 'Товары для рыб', 'Корм', 'http://www.petshop.ru/catalog/fish/korm/?page=2', ''),
	(252, 27, 'Товары для рыб', 'Корм', 'http://www.petshop.ru/catalog/fish/korm/?page=3', ''),
	(253, 28, 'Товары для рыб', 'Аксессуары', 'http://www.petshop.ru/catalog/fish/accesorios/', ''),
	(254, 29, 'Товары для рыб', 'Аквариумы', 'http://www.petshop.ru/catalog/fish/akvarium/', ''),
	(255, 30, 'Товары для рыб', 'Препараты', 'http://www.petshop.ru/catalog/fish/preparaty/', ''),
	(256, 31, 'Товары для рыб', 'Декорация', 'http://www.petshop.ru/catalog/fish/decoration/', ''),
	(257, 31, 'Товары для рыб', 'Декорация', 'http://www.petshop.ru/catalog/fish/decoration/?page=2', ''),
	(258, 31, 'Товары для рыб', 'Декорация', 'http://www.petshop.ru/catalog/fish/decoration/?page=3', ''),
	(259, 31, 'Товары для рыб', 'Декорация', 'http://www.petshop.ru/catalog/fish/decoration/?page=4', ''),
	(260, 32, 'Товары для птиц', 'Сухой корм', 'http://www.petshop.ru/catalog/birds/dry/', ''),
	(261, 32, 'Товары для птиц', 'Сухой корм', 'http://www.petshop.ru/catalog/birds/dry/?page=2', ''),
	(262, 32, 'Товары для птиц', 'Сухой корм', 'http://www.petshop.ru/catalog/birds/dry/?page=3', ''),
	(263, 32, 'Товары для птиц', 'Сухой корм', 'http://www.petshop.ru/catalog/birds/dry/?page=4', ''),
	(264, 32, 'Товары для птиц', 'Сухой корм', 'http://www.petshop.ru/catalog/birds/dry/?page=5', ''),
	(265, 33, 'Товары для птиц', 'Лакомства', 'http://www.petshop.ru/catalog/birds/lak/', ''),
	(266, 33, 'Товары для птиц', 'Лакомства', 'http://www.petshop.ru/catalog/birds/lak/?page=2', ''),
	(267, 33, 'Товары для птиц', 'Лакомства', 'http://www.petshop.ru/catalog/birds/lak/?page=3', ''),
	(268, 33, 'Товары для птиц', 'Лакомства', 'http://www.petshop.ru/catalog/birds/lak/?page=4', ''),
	(269, 34, 'Товары для птиц', 'Витамины', 'http://www.petshop.ru/catalog/birds/vitamins/', ''),
	(270, 35, 'Товары для птиц', 'Гигиена', 'http://www.petshop.ru/catalog/birds/hygiene/', ''),
	(271, 36, 'Товары для птиц', 'Клетки', 'http://www.petshop.ru/catalog/birds/kletki/', ''),
	(272, 36, 'Товары для птиц', 'Клетки', 'http://www.petshop.ru/catalog/birds/kletki/?page=2', ''),
	(273, 36, 'Товары для птиц', 'Клетки', 'http://www.petshop.ru/catalog/birds/kletki/?page=3', ''),
	(274, 36, 'Товары для птиц', 'Клетки', 'http://www.petshop.ru/catalog/birds/kletki/?page=4', ''),
	(275, 36, 'Товары для птиц', 'Клетки', 'http://www.petshop.ru/catalog/birds/kletki/?page=5', ''),
	(276, 36, 'Товары для птиц', 'Клетки', 'http://www.petshop.ru/catalog/birds/kletki/?page=6', ''),
	(277, 36, 'Товары для птиц', 'Клетки', 'http://www.petshop.ru/catalog/birds/kletki/?page=7', ''),
	(278, 36, 'Товары для птиц', 'Клетки', 'http://www.petshop.ru/catalog/birds/kletki/?page=8', ''),
	(279, 36, 'Товары для птиц', 'Клетки', 'http://www.petshop.ru/catalog/birds/kletki/?page=9', ''),
	(280, 36, 'Товары для птиц', 'Клетки', 'http://www.petshop.ru/catalog/birds/kletki/?page=10', ''),
	(281, 36, 'Товары для птиц', 'Клетки', 'http://www.petshop.ru/catalog/birds/kletki/?page=11', ''),
	(282, 37, 'Товары для птиц', 'Игрушки', 'http://www.petshop.ru/catalog/birds/toys/', ''),
	(283, 37, 'Товары для птиц', 'Игрушки', 'http://www.petshop.ru/catalog/birds/toys/?page=2', '');
/*!40000 ALTER TABLE `Catalog` ENABLE KEYS */;


-- Дамп структуры для таблица BitrixShop.Compare
CREATE TABLE IF NOT EXISTS `Compare` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tovar_id` int(11) NOT NULL DEFAULT '0',
  `catalog` int(11) NOT NULL DEFAULT '0',
  `link` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы BitrixShop.Compare: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `Compare` DISABLE KEYS */;
/*!40000 ALTER TABLE `Compare` ENABLE KEYS */;


-- Дамп структуры для таблица BitrixShop.Tovar
CREATE TABLE IF NOT EXISTS `Tovar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tovar_id` int(11) NOT NULL DEFAULT '0',
  `catalog` varchar(150) NOT NULL,
  `name` varchar(250) NOT NULL,
  `brand` varchar(150) NOT NULL,
  `memo1` text NOT NULL,
  `memo2` text NOT NULL,
  `memo3` text NOT NULL,
  `memo4` text NOT NULL,
  `img_main` varchar(1024) NOT NULL,
  `img_big` varchar(1024) NOT NULL,
  `img_med` varchar(1024) NOT NULL,
  `img_small` varchar(1024) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы BitrixShop.Tovar: ~1 rows (приблизительно)
/*!40000 ALTER TABLE `Tovar` DISABLE KEYS */;
INSERT INTO `Tovar` (`id`, `tovar_id`, `catalog`, `name`, `brand`, `memo1`, `memo2`, `memo3`, `memo4`, `img_main`, `img_big`, `img_med`, `img_small`) VALUES
	(1, 219088, '', '', '', '', '', '', '', '', '', '', '');
/*!40000 ALTER TABLE `Tovar` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
