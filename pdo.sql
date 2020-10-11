DROP TABLE IF EXISTS `article`;

CREATE TABLE article (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `price` int NOT NULL,
  `img` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
);

INSERT INTO `article` VALUES ('Nike - Air Max 2090',999,'https://www.thegoodwillout.com/media/catalog/product/cache/bf41ca181e831641a2b4a7a9a89e5c7f/n/i/nike-atmos-x-air-max-2090-infrared-black-dark-sage_baroque-brown-cu9174-600-1_1.jpg'),('Reebok - Baskets classiques en nylon',69,'https://cdn.laredoute.com/products/641by641/d/7/7/d772f2120d027fc11e6c6bd110955f27.jpg'),('Nike - Classic Cortez',189,'https://stockx.imgix.net/Nike-Cortez-Stranger-Things-Hawkins-High-School.png?fit=fill&bg=FFFFFF&w=700&h=500&auto=format,compress&q=90&dpr=2&trim=color&updated_at=1564196786'),('Lacoste - Polo - Red',120,'https://www.dmsports.fr/15495-thickbox_default/polo-lacoste-sport-uni-slim-fit-rouge.jpg'),('Obey - Veste',119,'https://images.stylight.net/image/upload/e_trim/t_web_product_330x440max_nobg/q_auto:eco,f_auto/uxgbdceze3yvnumvyyod.jpg');

DROP TABLE IF EXISTS `command`;

CREATE TABLE command (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `address` varchar(250) NOT NULL,
  `total` int NOT NULL,
  `created_at` date NOT NULL,
  PRIMARY KEY (`id`)
);

INSERT INTO `command` VALUES ('jenny','201 rue la fayette',540,'2020-10-11'),('test 33','201 rue la fayette',270,'2020-10-11'),('good','201 rue la fayette',1080,'2020-10-11'),('jenny232323','201 rue la fayette',540,'2020-10-11');