CREATE DATABASE website;

USE website;

CREATE TABLE `account` (
  `user-id` int(11) NOT NULL auto_increment,
  `email` text NOT NULL,
  `password-hash` text NOT NULL,
  PRIMARY KEY  (`user-id`)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8mb4 DEFAULT COLLATE utf8mb4_unicode_ci AUTO_INCREMENT = 1;

CREATE TABLE `product` (
  `product-id` int(11) NOT NULL auto_increment,
  `name` text NOT NULL,
  `image` text NOT NULL,
  `description` text NOT NULL,
  `price` float NOT NULL,
  PRIMARY KEY (`product-id`)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8mb4 DEFAULT COLLATE utf8mb4_unicode_ci AUTO_INCREMENT = 1;

CREATE TABLE `basket-item` (
  `user-id` int(11) NOT NULL,
  `product-id` int(11) NOT NULL,
  `quantity` int NOT NULL,
  PRIMARY KEY (`user-id`),
  FOREIGN KEY (`user-id`) REFERENCES `account` (`user-id`),
  FOREIGN KEY (`product-id`) REFERENCES `product` (`product-id`)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8mb4 DEFAULT COLLATE utf8mb4_unicode_ci;
