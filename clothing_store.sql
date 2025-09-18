-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 14, 2024 at 05:50 PM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clothing_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL,
  `reply` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `user_id`, `name`, `email`, `number`, `message`, `reply`) VALUES
(10, 34, 'Luke Dumphy', 'luke@gmail.com', '0879865478', 'hi, i want to know how i can start selling.', NULL),
(12, 35, 'Zoey Johnson', 'zoeyjohnson@gmail.com', '0614567865', 'hi how long does it take to deliver?', '10-15 days');

-- --------------------------------------------------------

--
-- Table structure for table `tblcart`
--

DROP TABLE IF EXISTS `tblcart`;
CREATE TABLE IF NOT EXISTS `tblcart` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `pid` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int NOT NULL,
  `quantity` int NOT NULL,
  `image` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblcategories`
--

DROP TABLE IF EXISTS `tblcategories`;
CREATE TABLE IF NOT EXISTS `tblcategories` (
  `category_id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  `category_description` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tblcategories`
--

INSERT INTO `tblcategories` (`category_id`, `category_name`, `category_description`, `created_at`) VALUES
(1, 'women', 'The Women\'s category features a wide range of stylish and trendy clothing, including dresses, tops, skirts, trousers, outerwear, and more. Whether you\'re looking for casual wear, office attire, or something special for an evening out, this category offers a diverse selection to suit every taste and occasion. Find high-quality, fashionable pieces from popular brands in various sizes and styles.', '2024-11-12 13:45:51'),
(2, 'men', 'The Men\'s category offers a curated collection of clothing designed for comfort and style, this category has everything a modern man needs to stay stylish and confident. Browse through a variety of fabrics, fits, and designs from well-known brands, perfect for any occasion.', '2024-11-12 13:46:26'),
(3, 'kids', 'The Kids category is packed with fun, playful, and durable clothing for boys and girls of all ages. This collection ensures your little ones are always dressed in style. Enjoy high-quality, comfortable clothing that can withstand the active lifestyles of children.', '2024-11-12 13:46:53'),
(4, 'accessories', 'The Accessories category is your go-to destination for finishing touches that elevate any outfit. Whether you\'re looking for a statement piece or something more subtle, find the perfect accessories to enhance your personal style.', '2024-11-12 13:47:20'),
(5, 'shoes', 'The Shoes category features a vast array of footwear for every occasion and style. From sneakers, sandals, and boots to formal shoes and high heels, this category offers footwear that combines comfort, durability, and trendiness. Browse through a selection of well-known brands and find the perfect pair of shoes to complete your outfit, no matter the season or event.', '2024-11-12 13:47:41');

-- --------------------------------------------------------

--
-- Table structure for table `tblorders`
--

DROP TABLE IF EXISTS `tblorders`;
CREATE TABLE IF NOT EXISTS `tblorders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int NOT NULL,
  `placed_on` varchar(50) NOT NULL,
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tblorders`
--

INSERT INTO `tblorders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(13, 31, 'Lwandle Chauke', '0829897986', 'lwandle@gmail.com', 'cash on delivery', 'flat no. 16 Albertina Sisulu Street Albertina Sisulu Street Sandton Gauteng South Africa - 1742', 'Oversized Blazer ( 1 ), Sun Dress ( 2 ), Pleated Dress ( 2 )', 7400, '12-Nov-2024', 'completed'),
(15, 33, 'Sarah Langa', '09865865', 'sarah@gmail.com', 'paytm', 'flat no. 16  Sisulu Street Waterfall Sandton Gauteng South Africa - 1234', 'Louis Vuitton Shirt ( 1 ), Summer 2-Piece ( 3 )', 5550, '13-Nov-2024', 'pending'),
(16, 34, 'Luke Dumphy', '0873562981', 'luke@gmail.com', 'cash on delivery', 'flat no. 16 Palomino Street Waterfall Corner Johannesburg Gauteng South Africa - 1234', 'Trench Coat ( 2 )', 2200, '13-Nov-2024', 'completed'),
(17, 35, 'Zoey Johnson', '0634527182', 'zoeyjohnson@gmail.com', 'paypal', 'flat no. 7 Water Street Diepkloof zone 6 Johannesburg Gauteng South Africa - 1236', 'Early 2000s Fit ( 2 ), Beige Bodycon Dress ( 3 )', 7100, '14-Nov-2024', 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `tblproducts`
--

DROP TABLE IF EXISTS `tblproducts`;
CREATE TABLE IF NOT EXISTS `tblproducts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `category` varchar(20) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `size` varchar(20) NOT NULL,
  `condition` varchar(50) NOT NULL,
  `details` varchar(1000) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `category_id` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tblproducts`
--

INSERT INTO `tblproducts` (`id`, `name`, `category`, `brand`, `size`, `condition`, `details`, `price`, `image`, `category_id`) VALUES
(3, 'Bodycon Dress', 'Women', 'H&M', 'XS', 'like new', 'This sleek, figure-hugging bodycon dress from H&M is perfect for nights out or formal events. Designed for an extra-small fit, the dress accentuates curves while offering a simple yet elegant look.', 499.99, 'women\\pexels-lokmansevim-18731384.jpg', 1),
(4, 'Red Leather Dress', 'Women', 'Forever 21', 'M', 'slightly worn', 'A striking red leather dress from Forever 21, ideal for bold fashion statements. This dress has a slightly worn look, adding character without compromising on its edgy appeal.', 899.99, 'women\\Women_RedDress.jpg', 1),
(5, 'Jeep T-Shirt', 'Women', 'Jeep', 'S', 'like new', 'A casual, versatile Jeep-branded T-shirt in “Like New” condition. Perfect for everyday wear, this tee is made of soft, durable fabric, providing comfort and a relaxed fit for a size Small. It’s simple yet iconic, ideal for pairing with jeans or shorts.', 299.99, 'women\\Women_JeepShirt.jpg', 1),
(6, 'Sun Dress', 'Women', 'H&M', 'M', 'new', 'This stylish dress offers a perfect blend of comfort and luxury. Ideal for casual wear.', 749.99, 'women\\Category_Women.jpg', 1),
(7, 'Beige Bodycon Dress', 'Women', 'H&M', 'S', 'like new', 'This stylish dress offers a perfect blend of comfort and luxury. Ideal for casual wear.', 799.99, 'women\\pexels-jame_9bkk-128711811-13890805.jpg', 1),
(8, 'Pleated Dress', 'Women', 'Christian Dior', 'S', 'new', 'Long flowing maxi pleated dress.', 2599.99, 'women\\pexels-frendsmans-4690496.jpg', 1),
(9, 'Early 2000s Fit', 'Men', 'Factorie', 'M', 'like new', 'This complete outfit from Factorie combines style and comfort, making it ideal for any casual occasion.', 2349.99, 'men\\Mens_Clothing.jpg', 2),
(10, 'Summer 2-Piece', 'Men', 'Zara', 'M', 'slightly worn', 'Stay stylish during warmer months with this trendy summer 2-piece set from Zara, featuring a fashionable design suitable for various occasions.', 1499.99, 'men\\Mens_2Piece.jpg', 2),
(11, 'Louis Vuitton Jacket', 'Men', 'Louis Vuitton', 'S', 'gently used', 'This classic Louis Vuitton jacket in a chic design is perfect for layering during cooler months.', 2849.99, 'men\\Mens_LVJacket.jpg', 2),
(12, 'Men’s Trench Coats', 'Men', 'H&M', 'M', 'like new', 'These stylish trench coats offer a perfect blend of comfort and luxury. Ideal for casual wear.', 2899.99, 'men\\Category_Men.jpg', 2),
(13, 'Green Suit', 'Men', 'Ted Baker', 'S', 'gently used', 'Elevate your wardrobe with this sophisticated green suit from Ted Baker. Designed for a modern look, it offers a tailored fit that is perfect for both formal and semi-formal occasions.', 2500.00, 'men\\Mens_Suit.jpg', 2),
(14, 'Track Suit', 'Men', 'Louis Vuitton', 'S', 'like new', 'A luxurious and stylish Louis Vuitton track suit, perfect for casual outings or lounging. Made from high-quality materials, it features the brand’s signature design and logo, ensuring you stay fashionable while being comfortable.', 2099.99, 'men\\Mens_LV_Tracksuit.jpg', 2),
(15, 'Beige Suit', 'Men', 'Ted Baker', 'M', 'gently used', 'This stylish suit offers a perfect blend of comfort and luxury. Ideal for casual wear.', 3099.99, 'men\\Beige_Suits.jpg', 2),
(16, 'Jersey', 'Men', 'Gucci', 'M', 'fairly new', 'This stylish Gucci jersey offers a perfect blend of comfort and luxury. Ideal for casual wear.', 2299.99, 'men\\Mens_Clothing2.jpg', 2),
(17, 'Dungaree', 'Kids', 'Zara', '5-6 years', 'like new', 'These adorable dungarees from Zara are perfect for your little one’s playful adventures.', 599.99, 'kids\\Kids_Dungare.jpg', 3),
(18, 'Louis Vuitton Shirt', 'Kids', 'Louis Vuitton', '9-10 years', 'new', 'Elevate your child’s wardrobe with this stylish Louis Vuitton shirt, tailored for ages 9-10 years. Crafted with attention to detail, this brand new shirt adds a touch of luxury to any outfit.', 1050.00, 'kids\\Kids_LV.jpg', 3),
(19, 'Suit Dress', 'Kids', 'Zara', '5-6 years', 'like new', 'This striking red suit-dress from Zara is designed for kids aged 5-6 years, combining elegance with playfulness.', 1299.99, 'kids\\Kids_Suit.jpg', 3),
(20, 'Olive Green Half Jersey', 'Kids', 'Old Khaki', '2-3 years', 'gently used', 'This trendy olive green half jacket from Old Khaki is perfect for keeping your little one warm and stylish during cooler days.', 499.99, 'kids\\Kids_OliveGreenHalfJacket.jpg', 3),
(21, 'Prada T-Shirt', 'Kids', 'Prada', '2-3 years', 'slightly worn', 'Let your child express their style with this chic Prada t-shirt, suitable for ages 2-3 years.', 299.99, 'kids\\Kids_PradaShirt.jpg', 3),
(22, 'Louis Vuitton Tracksuit', 'Kids', 'Louis Vuitton', '11-12 years', 'like new', 'Keep your child comfortable and stylish with this Louis Vuitton tracksuit, perfect for kids aged 11-12 years.', 3019.99, 'kids\\Kids_TrackSuit.jpg', 3),
(23, 'Balenciaga Pink Handbag', 'Accessories', 'Balenciaga', 'one size', 'like new', 'This vibrant Balenciaga pink handbag is perfect for adding a pop of color to any outfit. Made from premium leather, it’s in pristine condition with minimal signs of wear.', 2050.00, 'accessories\\Balenciaga_Bags.jpg', 4),
(24, 'Birkin Handbags', 'Accessories', 'Birkin', 'one size', 'new', 'Iconic and luxurious, this Birkin bag is a timeless investment piece. Made from the finest materials, these bags are brand new and waiting to be your go-to accessory for high-fashion moments.', 4499.99, 'accessories\\Birkin_Bags_2.jpg', 4),
(25, 'Cartier Bracelet Set', 'Accessories', 'Cartier', 'one size', 'new', 'This exquisite Cartier bracelet set is perfect for adding a touch of elegance to any outfit.', 2999.99, 'accessories\\Cartier_Bracelet.jpg', 4),
(26, 'Headband', 'Accessories', 'Christian Dior', 'one size', 'like new', 'This stunning headband is perfect for adding a touch of glamour to any look.', 749.99, 'accessories\\Christian_Dior_Headband.jpg', 4),
(27, 'Durag', 'Accessories', 'Balenciaga', 'one size', 'new', 'This stylish Balenciaga durag features the signature logo and is crafted from smooth fabric.', 149.99, 'accessories\\Balenciaga_Durag.jpg', 4),
(28, 'Sunglasses', 'Accessories', 'Versace', 'one size', 'new', 'Protect your eyes in style with these trendy Versace sunglasses.', 2399.99, 'accessories\\Versace_Sunglasses.jpg', 4),
(29, 'Rolex Watch', 'Accessories', 'Rolex', 'one size', 'like new', 'Elevate your wrist game with this luxurious Rolex watch, in pristine condition with minimal signs of wear.', 12999.99, 'accessories\\Rolex_Watch.jpg', 4),
(30, 'Louis Vuitton Sneakers', 'Shoes', 'Louis Vuitton', '8', 'new', 'These Louis Vuitton sneakers are a must-have for any fashion enthusiast. Brand new, they offer a combination of comfort, style, and high-end craftsmanship that make them perfect for everyday wear or special occasions. Don’t miss out on these exclusive sneakers from one of the world’s most renowned luxury brands.', 8999.99, 'shoes\\Men_Shoes_LV-Nike.jpg', 5),
(31, 'Jimmy Choo Heels', 'Shoes', 'Jimmy Choo', 'UK6', 'like new', 'These elegant heels by Jimmy Choo are the epitome of luxury. ', 2599.99, 'shoes\\Women_Shoes_JimmyChoo.jpg', 5),
(32, 'Christian Dior Slides', 'Shoes', 'Christian Dior', 'UK4', 'like new', 'Sleek and stylish, these Christian Dior slides are perfect for casual luxury. ', 1599.99, 'shoes\\Women_Shoes_DiorSlides.jpg', 5),
(33, 'Prada Boots', 'Shoes', 'Prada', 'UK5', 'new', 'These chic, high-end Prada boots are brand new and offer both fashion and function. Perfect for colder weather, the boots are crafted from premium materials and designed for comfort and durability. ', 3599.99, 'shoes\\Women_Shoes_PradaBoots.jpg', 5),
(34, 'Steve Madden Formal Shoes', 'Shoes', 'Steve Madden', 'UK10', 'new', 'These sleek and stylish Steve Madden men’s shoes are perfect for formal or semi-formal occasions. ', 2599.99, 'shoes\\Men_Shoes_Formal.jpg', 5),
(35, 'Chanel Heels', 'Shoes', 'Chanel', 'UK4', 'like new', 'These stylish heels offer a perfect blend of comfort and luxury. Ideal for casual wear.', 2800.00, 'shoes\\Chanel_Heels.jpg', 5),
(37, 'Trench Coat', 'women', '', '', '', 'a beautiful black long coat.', 2000.00, 'Women_TrenchCoat.jpg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

DROP TABLE IF EXISTS `tblusers`;
CREATE TABLE IF NOT EXISTS `tblusers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user',
  `image` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`id`, `name`, `email`, `password`, `user_type`, `image`) VALUES
(31, 'Lwandle Chauke', 'lwandle@gmail.com', 'dc647eb65e6711e155375218212b3964', 'user', 'pic-2.png'),
(32, 'Admin1', 'admin1@gmail.com', 'dc647eb65e6711e155375218212b3964', 'admin', 'pic-1.png'),
(35, 'Zoey Johnson', 'zoeyjohnson@gmail.com', 'dc647eb65e6711e155375218212b3964', 'user', 'pic-2.png');

-- --------------------------------------------------------

--
-- Table structure for table `tblwishlist`
--

DROP TABLE IF EXISTS `tblwishlist`;
CREATE TABLE IF NOT EXISTS `tblwishlist` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `pid` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int NOT NULL,
  `image` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tblwishlist`
--

INSERT INTO `tblwishlist` (`id`, `user_id`, `pid`, `name`, `price`, `image`) VALUES
(53, 34, 9, 'Early 2000s Fit', 2350, 'men\\Mens_Clothing.jpg'),
(55, 35, 5, 'Jeep T-Shirt', 300, 'women\\Women_JeepShirt.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
