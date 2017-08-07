-- FIRST OF ALL CREATE A DATABASE in this case blog_samples

CREATE DATABASE blog_samples;

-- create a items table
CREATE TABLE IF NOT EXISTS `tblproduct` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `price` double(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,  
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_code` (`code`)
)
-- insert items in table
INSERT INTO `tblproduct` (`id`, `name`, `code`, `image`, `price`,`quantity`) VALUES
(1, 'Harry Potter and the Philosophers Stone', 'PhilosophersStone', 'product-images/book1.jpg', 10.00, 50),
(2, 'Harry Potter and the Chamber of Secrets', 'ChamberOfSecrets', 'product-images/book2.jpg', 9.00, 50),
(3, 'Harry Potter and the Prisoner of Azkaban', 'PrisonerOfAzkaban', 'product-images/book3.jpg', 11.00, 50),
(4, 'Harry Potter and the Goblet of Fire', 'GobletOfFire', 'product-images/book4.jpg', 12.00, 50),
(5, 'Harry Potter and the Order of the Phoenix', 'OrderOfThePhoenix', 'product-images/book5.jpg', 8.00, 50),
(6, 'Harry Potter and the Half-Blood Prince', 'HalfBloodPrince', 'product-images/book6.jpg', 11.00, 50),
(7, 'Harry Potter and the Deathly Hallows', 'DeathlyHallows', 'product-images/book7.jpg', 15.00, 50),
(8, 'Harry Potter and the Cursed Child', 'CursedChild', 'product-images/book8.jpg', 17.00, 20),

-- create user table
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
)

-- insert a single user in table ACTIVE = 1 is admin. ACTIVE = 0 is user
INSERT INTO `user` (`id`, `username`, `email`, `password`, `active`) VALUES
(1000, 'test1', 'test1@test.com', '1234', 1)


-- create a report table
CREATE TABLE `sellReport` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `doc_number` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `costumer_email` varchar(255) NOT NULL,
  `item` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` double(10,2) NOT NULL,
  `total_amount` double(10,2) NOT NULL,
  `date` date,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
)