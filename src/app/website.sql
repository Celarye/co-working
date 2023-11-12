CREATE DATABASE website;

USE website;

CREATE TABLE `account` (
  `account-id` int(11) NOT NULL auto_increment,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created-on` timestamp NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY  (`account-id`)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8mb4 DEFAULT COLLATE utf8mb4_unicode_ci auto_increment = 1;

CREATE TABLE `product` (
  `product-id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` float NOT NULL,
  PRIMARY KEY (`product-id`)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8mb4 DEFAULT COLLATE utf8mb4_unicode_ci auto_increment = 1;

CREATE TABLE `basket-item` (
  `account-id` int(11) NOT NULL,
  `product-id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`account-id`),
  FOREIGN KEY (`account-id`) REFERENCES `account` (`account-id`),
  FOREIGN KEY (`product-id`) REFERENCES `product` (`product-id`)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8mb4 DEFAULT COLLATE utf8mb4_unicode_ci auto_increment = 1;

CREATE TABLE `message` (
  `message-id` int(11) NOT NULL auto_increment,
  `account-id` int(11) NOT NULL,
  `messager` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created-on` datetime NOT NULL,
  PRIMARY KEY  (`message-id`),
  FOREIGN KEY (`account-id`) REFERENCES `account` (`account-id`)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8mb4 DEFAULT COLLATE utf8mb4_unicode_ci auto_increment = 1;
