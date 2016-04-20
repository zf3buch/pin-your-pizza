SET FOREIGN_KEY_CHECKS=0;

START TRANSACTION;

DROP TABLE IF EXISTS `comment`;

CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pizza` smallint(5) unsigned NOT NULL,
  `date` datetime NOT NULL,
  `name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pizza` (`pizza`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=35 ;

INSERT INTO `comment` (`id`, `pizza`, `date`, `name`, `text`) VALUES
(1, 1, '2015-11-25 20:26:12', 'Peter', '<p>Sehr lecker!</p>'),
(2, 1, '2015-11-25 20:26:49', 'Paul', '<p>Beste Pizza!</p>'),
(3, 2, '2015-11-25 20:27:40', 'Luigi', '<p>Könnte meine Mamma nicht besser machen!</p>'),
(4, 3, '2015-11-25 20:28:45', 'Heinzelmann', '<p>Irgendwie langweilig.</p>'),
(5, 4, '2015-11-25 20:29:19', 'Heinzelmann', '<p>Toter Fisch hat auf Pizza nichts zu suchen!</p>'),
(6, 5, '2015-11-25 20:29:45', 'Heinzelmann', '<p>Geht so!</p>'),
(7, 6, '2015-11-25 20:30:13', 'Heinzelmann', '<p>Da sind ja gar keine Peperoni darauf!</p>'),
(8, 6, '2015-11-25 20:30:32', 'Luigi', '<p>Da steht ja auch Peperone und nicht Peperoni!</p>'),
(9, 6, '2015-11-25 20:27:40', 'Heinzelmann', '<p>Witzbold! Als wenn da ein Unterschied wäre...</p>'),
(10, 6, '2015-11-25 20:30:55', 'Luigi', '<p>Peperone heißt nun mal Paprika, du Schlaumeier!</p>'),
(11, 8, '2015-11-25 20:31:22', 'Peter', '<p>Es gibt kaum etwas besseres...</p>');

DROP TABLE IF EXISTS `pizza`;

CREATE TABLE IF NOT EXISTS `pizza` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stars1` int(10) unsigned NOT NULL,
  `stars2` int(10) unsigned NOT NULL,
  `stars3` int(10) unsigned NOT NULL,
  `stars4` int(10) unsigned NOT NULL,
  `stars5` int(10) unsigned NOT NULL,
  `total` int(10) unsigned NOT NULL,
  `rate` float(6,4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=10 ;

INSERT INTO `pizza` (`id`, `name`, `image`, `stars1`, `stars2`, `stars3`, `stars4`, `stars5`, `total`, `rate`) VALUES
(1, 'Pizza Mista', '/assets/custom/pizza/001.jpg', 0, 0, 0, 1, 1, 2, 4.5000),
(2, 'Pizza Oliva', '/assets/custom/pizza/002.jpg', 0, 0, 0, 0, 2, 2, 5.0000),
(3, 'Pizza Margherita', '/assets/custom/pizza/003.jpg', 0, 2, 0, 0, 0, 2, 2.0000),
(4, 'Pizza Gambero', '/assets/custom/pizza/004.jpg', 1, 1, 0, 0, 0, 2, 1.5000),
(5, 'Pizza Verdura', '/assets/custom/pizza/005.jpg', 1, 0, 0, 1, 0, 2, 2.5000),
(6, 'Pizza Peperone', '/assets/custom/pizza/006.jpg', 0, 0, 2, 0, 0, 2, 3.0000),
(7, 'Pizza Vegetariana', '/assets/custom/pizza/007.jpg', 1, 0, 1, 0, 0, 2, 2.0000),
(8, 'Pizza Salame', '/assets/custom/pizza/008.jpg', 0, 0, 0, 0, 2, 2, 5.0000),
(9, 'Pizza Funghi e Oliva', '/assets/custom/pizza/009.jpg', 0, 1, 1, 0, 0, 2, 2.5000);

ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`pizza`) REFERENCES `pizza` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

SET FOREIGN_KEY_CHECKS=1;

COMMIT;