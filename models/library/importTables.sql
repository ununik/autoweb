CREATE TABLE IF NOT EXISTS `webSettings_autoweb` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `author` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `mail` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `meta_description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `be_users_autoweb` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `password` text COLLATE utf8_czech_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `root_admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `header_autoweb` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `header_mainTitle` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `header_subTitle` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `header_text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `footer_autoweb` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `footer_class` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `footer_order` INT(20) NOT NULL,
  `footer_text` text NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0', 
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `pages_autoweb` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `headline` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `parent` INT(20) NOT NULL DEFAULT '0',
  `order` INT(20) NOT NULL,
  `meta_description` text NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0', 
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `content_autoweb` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `class` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `pid` int(15) COLLATE utf8_czech_ci NOT NULL,
  `parent` INT(20) NOT NULL DEFAULT '0',
  `order` INT(20) NOT NULL,
  `text` text NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0', 
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=1;
