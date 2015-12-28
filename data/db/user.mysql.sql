SET FOREIGN_KEY_CHECKS=0;

START TRANSACTION;

DROP TABLE IF EXISTS `user`;

CREATE TABLE IF NOT EXISTS `user` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('member','admin') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'member',
  `first_name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=3 ;

INSERT INTO `user` (`id`, `date`, `email`, `password`, `role`, `first_name`, `last_name`) VALUES
(1, '2015-12-28 08:13:47', 'member@pin-your-pizza.de', '$2y$10$LgI03AFI.lu5lB1t4Rfpy.ipppiAE79Xz1Dk6pi1RVIAW2./5at2.', 'member', 'Michael', 'Mitglied'),
(2, '2015-12-28 08:17:02', 'admin@pin-your-pizza.de', '$2y$10$MNLzqwHkE4HNbjWIiF7i3e8aKvrBsPm8CRUF3aFbT9f1nAMeOmPDO', 'admin', 'Adonis', 'Admin');

SET FOREIGN_KEY_CHECKS=1;

COMMIT;
