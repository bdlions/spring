SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varbinary(16) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

--
-- Dumping data for table `login_attempts`
--


-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `account_status` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6;   
INSERT INTO `account_status` (`id`, `description`) VALUES
(1, 'Active'),
(2, 'Inactive'),
(3, 'Suspended'),
(4, 'Deactivated'),
(5, 'Blocked');
-- -----------------------------------------------------------
--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varbinary(16) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(80) NOT NULL,
  `salt` varchar(40) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `account_status_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_laccount_status1` FOREIGN KEY (`account_status_id`) REFERENCES `account_status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `account_status_id`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '', 'administrator', '59beecdf7fc966e2f17fd8f65a4a9aeb09d4a3d4', '9462e8eee0', 'admin@admin.com', '', NULL, NULL, NULL, 1268889823, 1373438882, 1, 'Admin', 'istrator', 'ADMIN', '0');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2;
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_groups`
--



CREATE TABLE IF NOT EXISTS `logo_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3;
INSERT INTO `logo_types` (`id`, `title`) VALUES
(1, 'Header'),
(2, 'Footer');
CREATE TABLE IF NOT EXISTS `logos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `img` varchar(500) NOT NULL,
  `type_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_logos_logo_types1_idx` (`type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4;
ALTER TABLE `logos`
  ADD CONSTRAINT `fk_logos_logo_types1` FOREIGN KEY (`type_id`) REFERENCES `logo_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
INSERT INTO `logos` (`id`, `img`, `type_id`) VALUES
(1, 'logo.png', 1),
(2, 'bdlions.png', 2),
(3, '2nd_logo.png', 2);

CREATE TABLE IF NOT EXISTS `gallery_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `img` varchar(500) NOT NULL,
  `order` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4;
INSERT INTO `gallery_images` (`id`, `img`, `order`) VALUES
(1, 'slide1.jpg', 1),
(2, 'slide2.jpg', 2),
(3, 'slide3.jpg', 3);

CREATE TABLE IF NOT EXISTS `home_page_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gallery_image_text` text,
  `title` varchar(500) NOT NULL,
  `description` text,
  `links_title` text,
  `footer_message` text,
  `copy_right` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2;
INSERT INTO `home_page_info` (`id`, `gallery_image_text`, `title`, `description`, `links_title`) VALUES
(1, 'Welcome to Cadogan Mcqueen', 'Real State Building Surveyors', 'BUILDING SURVEYS', 'Our main services fall under the following headings:');

CREATE TABLE IF NOT EXISTS `links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `img` varchar(500) NOT NULL,
  `title` varchar(1000) NOT NULL,
  `summary` varchar(1000) NOT NULL,
  `link` text,
  `order` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5;
INSERT INTO `links` (`id`, `img`, `title`, `summary`, `link`, `order`) VALUES
(1, 'building_servey.png', 'BUILDING SURVEYS', 'For puchase and building defects', '1', 1),
(2, 'development_legis.png', 'DEVELOPMENT & LEGISLATION', 'Party walls and building legislation', '2', 2),
(3, 'design_construc.png', 'DESIGN & CONSTRUCTION', 'Refurbishment, planning & extensions', '3', 3),
(4, 'professional_consult.png', 'PROFESSIONAL CONSULTANCY', 'Dilapidation and Expert Witness', '4', 4);

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(500) NOT NULL,
  `img` varchar(500) DEFAULT '',
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `page_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` int(11) NOT NULL,
  `img` varchar(500) NOT NULL,
  `order` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
ALTER TABLE `page_images`
  ADD CONSTRAINT `fk_page_images_pages1` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
  
CREATE TABLE IF NOT EXISTS `page_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `display_name` varchar(500) DEFAULT '',
  `order` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
ALTER TABLE `page_files`
  ADD CONSTRAINT `fk_page_files_pages1` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

CREATE TABLE IF NOT EXISTS `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(500) NOT NULL,
  `page_id` int(11) DEFAULT NULL,
  `order` int(11) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `fk_menus_pages1_idx` (`page_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
ALTER TABLE `menus`
  ADD CONSTRAINT `fk_menus_pages1` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
INSERT INTO `menus` (`id`, `title`, `order`) VALUES
(1, 'Products & Services', 1),
(2, 'Concerns', 2),
(3, 'Sustainability', 3),
(4, 'Development Partners', 4),
(5, 'Career', 5),
(6, 'About Us', 6);

CREATE TABLE IF NOT EXISTS `submenus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,  
  `title` varchar(500) NOT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `page_id` int(11) DEFAULT NULL,
  `order` int(11) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `fk_submenus_menus1_idx` (`menu_id`),
  KEY `fk_submenus_pages1_idx` (`page_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
ALTER TABLE `submenus`
  ADD CONSTRAINT `fk_submenus_menus1` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_submenus_pages1` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
INSERT INTO `submenus` (`id`, `title`,`menu_id`, `order`) VALUES
(1, 'Spinning', 1, 1),
(2, 'Knitting', 1, 2),
(3, 'Dyeing and Washing', 1, 3),
(4, 'Printing', 1, 4),
(5, 'Apparels', 1, 5),
(6, 'Packaging', 1, 6),
(7, 'Distribution', 1, 7),
(8, 'Ceramics', 1, 8),
(9, 'ICT & Telecommunications', 1, 9),
(10, 'Career at DBL', 5, 1),
(11, 'Current Vacancies', 5, 2),
(12, 'About DBL Group', 6, 1),
(13, 'Core Values', 6, 2),
(14, 'Major Buyers', 6, 3),
(15, 'Board of Directors', 6, 4),
(16, 'Export Destinations', 6, 5),
(17, 'Awards and Achievements', 6, 6),
(18, 'Newsletter', 6, 7);


CREATE TABLE IF NOT EXISTS `addresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(500) NOT NULL,
  `street` varchar(500) NOT NULL,
  `city` varchar(500) NOT NULL,
  `post_code` varchar(500) NOT NULL,
  `telephone` varchar(500) NOT NULL,
  `fax` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2;
INSERT INTO `addresses` (`id`, `title`,`street`, `city`, `post_code`, `telephone`, `fax`, `email`) VALUES
(1, 'Essex Office', 'Former HMS Essex 135 Ness Road', 'Shoeburyness, Essex', 'SS3 9ES', '+44 (0)1702 293 413', '+44 (0)1702 304 277', 'info@johnsongillies.co.uk');

CREATE TABLE IF NOT EXISTS `feedbacks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL,
  `company` varchar(500) NOT NULL,
  `address` varchar(1000) NOT NULL,
  `phone` varchar(500) DEFAULT '',
  `email` varchar(500) NOT NULL,  
  `subject` varchar(500) DEFAULT '',
  `enquiry` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
CREATE TABLE IF NOT EXISTS `replies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `feedback_id` int(11) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  KEY `fk_replies_feedbacks1_idx` (`feedback_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
ALTER TABLE `replies`
  ADD CONSTRAINT `fk_replies_feedbacks1` FOREIGN KEY (`feedback_id`) REFERENCES `feedbacks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
  
