PARTIE 1

CREATE DATABASE livecoding_pdo;
USE livecoding_pdo;

CREATE TABLE article (
  `id` INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `name` VARCHAR(100) NOT NULL,
  `price` INT NOT NULL,
  `img` VARCHAR(250) NOT NULL
);

INSERT INTO `article` (`name`, `price`, `img`) VALUES
('New Balance - 720 -', 89, 'https://images-na.ssl-images-amazon.com/images/I/61lGkg%2BiQ3L._AC_UY500_.jpg'),
('Nike - Air Max 2090', 149, 'https://www.thegoodwillout.com/media/catalog/product/cache/bf41ca181e831641a2b4a7a9a89e5c7f/n/i/nike-atmos-x-air-max-2090-infrared-black-dark-sage_baroque-brown-cu9174-600-1_1.jpg'),
('Reebok - Baskets classiques en nylon', 59, 'https://cdn.laredoute.com/products/641by641/d/7/7/d772f2120d027fc11e6c6bd110955f27.jpg'),
('Nike - Classic Cortez', 189, 'https://stockx.imgix.net/Nike-Cortez-Stranger-Things-Hawkins-High-School.png?fit=fill&bg=FFFFFF&w=700&h=500&auto=format,compress&q=90&dpr=2&trim=color&updated_at=1564196786');


PARTIE 2
CREATE TABLE command (
  `id` INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(250) NOT NULL,
  `total` INT NOT NULL,
  `created_at` date NOT NULL
);