CREATE DATABASE website;

USE website;

CREATE TABLE `account` (
  `accountId` int(11) NOT NULL auto_increment,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `createdOn` timestamp NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY  (`accountId`)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8mb4 DEFAULT COLLATE utf8mb4_unicode_ci auto_increment = 1;

CREATE TABLE `product` (
  `productId` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` float NOT NULL,
  PRIMARY KEY (`productId`)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8mb4 DEFAULT COLLATE utf8mb4_unicode_ci auto_increment = 1;

CREATE TABLE `basketItem` (
  `AID` int(11) NOT NULL,
  `PID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`AID`, `PID`),
  FOREIGN KEY (`AID`) REFERENCES `account` (`accountId`),
  FOREIGN KEY (`PID`) REFERENCES `product` (`productId`)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8mb4 DEFAULT COLLATE utf8mb4_unicode_ci;

CREATE TABLE `message` (
  `messageId` int(11) NOT NULL auto_increment,
  `AID` int(11) NOT NULL,
  `message` text NOT NULL,
  `createdOn` datetime NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY  (`messageId`),
  FOREIGN KEY (`AID`) REFERENCES `account` (`accountId`)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8mb4 DEFAULT COLLATE utf8mb4_unicode_ci auto_increment = 1;

INSERT INTO `product`( `name`, `image`, `description`, `price`) VALUES ('Hwayo 53 Soju','../../includes/south-korea.jpg','Hwayo 53 is a premium Korean soju known for its exceptional quality and smooth taste. Distilled from 100% Korean rice, it boasts a 53% alcohol content, which is higher than traditional soju, offering a refined and clean flavor profile with subtle sweetness and a hint of floral notes. Enjoyed both straight and in cocktails.','83.5');

INSERT INTO `product`( `name`, `image`, `description`, `price`) VALUES ('Jamazakura blended whiskey','../../includes/japan.jpg','Jamazakura Blended Whiskey is a harmonious fusion of Japanese and Scottish whisky traditions. Crafted with precision, it combines malt and grain whiskies, resulting in a balanced and smooth profile. Its delicate cherry blossom aroma and hints of peat create a unique, enjoyable drinking experience, capturing the essence of both cultures.','62');

INSERT INTO `product`( `name`, `image`, `description`, `price`) VALUES ('Ming River Sichuan Baijiu','../../includes/china.jpg',"Ming River Sichuan Baijiu is a premium Chinese spirit renowned for its rich heritage and bold flavor. Crafted in Sichuan province, it's made from sorghum, wheat, barley, and water from the region. This Baijiu boasts complex, spicy, and fruity notes, making it a cherished cultural tradition and a unique taste experience.",'40');

INSERT INTO `product`( `name`, `image`, `description`, `price`) VALUES ('Sang Som Special rum','../../includes/thailand.jpg',"Sang Som Special Rum is a renowned Thai spirit known for its rich and smooth flavor profile. Distilled from sugarcane, it features a harmonious blend of caramel, vanilla, and tropical fruit notes, with a subtle, warming finish. This award-winning rum is a beloved choice for cocktails and sipping alike.",'30');

INSERT INTO `product`( `name`, `image`, `description`, `price`) VALUES ('KingFisher beer','../../includes/India.jpeg',"Kingfisher Beer is a renowned Indian lager known for its refreshing taste and crisp, golden appearance. Brewed by United Breweries Group, it offers a balanced blend of malt and hops, delivering a clean, satisfying experience with a touch of citrus notes. It's a popular choice for beer enthusiasts worldwide.",'48');

INSERT INTO `product`( `name`, `image`, `description`, `price`) VALUES ('Bia Hoi Saigon Beer','../../includes/vietnam.png',"Bia Hoi Saigon is a popular Vietnamese beer known for its refreshing and light character. Brewed daily, it's a unique street-side experience in Saigon. This low-alcohol lager has a crisp taste with a slight sweetness, making it a perfect choice for quenching your thirst on a hot day in the bustling city.",'36');

INSERT INTO `product`( `name`, `image`, `description`, `price`) VALUES ('Ceylon Arrack','../../includes/indonesia.jpg',"Ceylon Arrack Indonesia is a unique distilled spirit originating from Indonesia, traditionally made from the sap of coconut flowers. This alcoholic beverage boasts a rich history and cultural significance in the region. It is celebrated for its distinctive flavor profile and is a popular choice for both traditional and contemporary cocktails.",'44');

INSERT INTO `product`( `name`, `image`, `description`, `price`) VALUES ('Kakheti Bedoba','../../includes/mongolia.jpg',"Kakheti Bedoba is a renowned Georgian wine, hailing from the Kakheti region. This exceptional wine boasts a rich history and is celebrated for its deep, complex flavors. Made using traditional winemaking methods and indigenous grape varieties, it offers a unique sensory experience, with notes of dark fruits, earthiness, and a hint of spice.",'17');

INSERT INTO `product`( `name`, `image`, `description`, `price`) VALUES ('San Miguel Beer','../../includes/filipijnen.png',"San Miguel Beer is a renowned Filipino brand known for its crisp and refreshing lagers. Brewed since 1890, it boasts a rich heritage and a smooth, balanced taste that appeals to beer enthusiasts worldwide. It offers a wide range of beer styles, making it a popular choice for those seeking quality and flavor.",'35');
