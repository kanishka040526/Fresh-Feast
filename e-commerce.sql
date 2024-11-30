-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2024 at 01:35 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-commerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `address_details`
--

CREATE TABLE `address_details` (
  `id` int(20) NOT NULL,
  `user_id` int(225) NOT NULL,
  `first_name` varchar(225) NOT NULL,
  `last_name` varchar(225) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(225) NOT NULL,
  `state` varchar(225) NOT NULL,
  `country` varchar(225) NOT NULL,
  `pin_code` int(20) NOT NULL,
  `email` varchar(225) NOT NULL,
  `tel` int(225) NOT NULL,
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `address_details`
--

INSERT INTO `address_details` (`id`, `user_id`, `first_name`, `last_name`, `address`, `city`, `state`, `country`, `pin_code`, `email`, `tel`, `note`) VALUES
(32, 3, 'Kanishka', 'Kumawat', '148,aanadvihar', 'Asian', 'Rajasthan', 'India', 302013, 'kanishkakumawat1002@gmail.com', 2147483647, ''),
(33, 3, 'Kanishka', 'Kumawat', '148,aanadvihar', 'Asian', 'Rajasthan', 'India', 302013, 'kanishka.kumawat@s.amity.edu', 2147483647, ''),
(34, 3, 'Kanishka', 'Kumawat', '148,aanadvihar', 'jaipur', 'Rajasthan', 'India', 302013, 'admin24@gmail.com', 2147483647, ''),
(35, 4, 'Kanishka', 'Kumawat', '148,aanadvihar', 'jaipur', 'Rajasthan', 'India', 302013, 'admin24@gmail.com', 2147483647, ''),
(36, 4, 'Kanishka', 'Kumawat', '148,aanadvihar', 'Asian', 'Rajasthan', 'India', 302013, 'kanishkakumawat2@gmail.com', 2147483647, ''),
(37, 4, 'Kanishka', 'Kumawat', '148,aanadvihar', 'Asian', 'Rajasthan', 'India', 302013, 'kanishkakumawat2@gmail.com', 2147483647, ''),
(38, 4, 'Kanishka', 'Kumawat', '148,aanadvihar', 'Asian', 'Rajasthan', 'India', 302013, 'kanishkakumawat2@gmail.com', 2147483647, ''),
(39, 4, 'Kanishka', 'Kumawat', '148,aanadvihar', 'Asian', 'Rajasthan', 'India', 302013, 'kanishkakumawat2@gmail.com', 2147483647, ''),
(40, 4, 'Kanishka', 'Kumawat', '148,aanadvihar', 'Asian', 'Rajasthan', 'India', 302013, 'kanishkakumawat2@gmail.com', 2147483647, ''),
(41, 4, 'Kanishka', 'Kumawat', '148,aanadvihar', 'Asian', 'Rajasthan', 'India', 302013, 'kanishkakumawat2@gmail.com', 2147483647, ''),
(42, 4, 'Kanishka', 'Kumawat', '148,aanadvihar', 'Asian', 'Rajasthan', 'India', 302013, 'kanishkakumawat2@gmail.com', 2147483647, ''),
(43, 4, 'Kanishka', 'Kumawat', '148,aanadvihar', 'Asian', 'Rajasthan', 'India', 302013, 'kanishkakumawat2@gmail.com', 2147483647, ''),
(44, 4, 'Kanishka', 'Kumawat', '148,aanadvihar', 'Asian', 'Rajasthan', 'India', 302013, 'kanishkakumawat2@gmail.com', 2147483647, ''),
(45, 4, 'Kanishka', 'Kumawat', '148,aanadvihar', 'Asian', 'Rajasthan', 'India', 302013, 'kanishkakumawat2@gmail.com', 2147483647, ''),
(46, 4, 'Kanishka', 'Kumawat', '148,aanadvihar', 'Asian', 'Rajasthan', 'India', 302013, 'kanishkakumawat2@gmail.com', 2147483647, '');

-- --------------------------------------------------------

--
-- Table structure for table `admin_detail`
--

CREATE TABLE `admin_detail` (
  `id` int(20) NOT NULL,
  `userName` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_detail`
--

INSERT INTO `admin_detail` (`id`, `userName`, `email`, `password`) VALUES
(1, 'kanishka kumawat', 'kanishkakumawat1002@gmail.com', '260504'),
(2, 'Kanishka Kumawat', 'kanishka.kumawat@s.amity.edu', '081105');

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(20) NOT NULL,
  `brand_name` varchar(225) NOT NULL,
  `date` varchar(225) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `brand_name`, `date`) VALUES
(1, 'agro Farm', '2147483647'),
(2, 'kim Farm', '2147483647'),
(3, 'fru farm', '2147483647');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(20) NOT NULL,
  `product_id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `quantity` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `product_id`, `user_id`, `quantity`) VALUES
(62, 29, 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(20) NOT NULL,
  `image` varchar(225) NOT NULL,
  `c_name` varchar(225) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `image`, `c_name`, `description`) VALUES
(6, 'hero-img-2.jpg', 'Vegetables', 'All the vegetables are  produced without the use of pesticides, chemical fertilizers, radiation, or chemical additives.'),
(7, 'hero-img-1.png', 'Fruits', ' All the Fruits are produced without the use of pesticides, chemical fertilizers, radiation, or chemical additives.'),
(8, 'grains.jpeg', 'Grains', 'All the grains are produced without the use of pesticides, chemical fertilizers, radiation, or chemical additives.'),
(9, 'milk products.jpeg', 'milk products', 'All the products are organic without using any kind of chemicals');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(20) NOT NULL,
  `userName` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `userName`, `email`, `message`) VALUES
(1, 'kanishka kumawat', 'kanishkakumawat1002@gmail.com', 'Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt'),
(2, 'kanishka kumawat', 'kanishkakumawat1002@gmail.com', 'Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt'),
(3, 'kanishka kumawat', 'kanishkakumawat1002@gmail.com', 'Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt'),
(4, 'kanishka kumawat', 'admin@themeposh.xyz', 'Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt'),
(5, 'kanishka kumawat', 'kanishkakumawat1002@gmail.com', 'http://localhost/programs/E-commerce/frontend/contact.php'),
(6, 'kanishka kumawat', 'kanishkakumawat1002@gmail.com', 'http://localhost/programs/E-commerce/frontend/contact.php'),
(7, 'kanishka kumawat', 'kanishkakumawat1002@gmail.com', 'vdsvdegwrdgsv'),
(8, 'kanishka kumawat', 'kanishkkumawat25@gmail.com', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus ullam dolorem reprehenderit qui similique necessitatibus neque non quis ea optio ad facilis sint voluptatum cupiditate omnis libero numquam, repudiandae odio!'),
(9, 'kanishka kumawat', 'admin@themeposh.xyz', 'consectetur adipisicing elit. Voluptatibus ullam dolorem reprehenderit qui similique necessitatibus n'),
(10, 'kanishka kumawat', 'kanishkakumawat1002@gmail.com', 'consectetur adipisicing elit. Voluptatibus ullam dolorem reprehenderit qui similique necessitatibus n'),
(11, 'Kanishka Kumawat', 'kanishkakumawat1002@gmail.com', 'bdfbrsfbfxb'),
(12, 'Kanishka Kumawat', 'kanishkakumawat1002@gmail.com', 'fbfbfbfbzdfbfbz'),
(13, 'Kanishka Kumawat', 'kanishkakumawat1002@gmail.com', 'fbfbfbfbzdfbfbz'),
(14, 'Kanishka Kumawat', 'kanishkakumawat1002@gmail.com', 'fbfbfbfbzdfbfbz'),
(15, 'Kanishka Kumawat', 'kanishkakumawat1002@gmail.com', 'fbfbdfbdfbvfbfdcvcvdfvdsbfvbf'),
(16, 'Kanishka Kumawat', 'admin24@gmail.com', 'fbfbdfbdfbvfbfdcvcvdfvdsbfvbf'),
(17, 'hello', 'hello@gmail.com', 'hello hello hellooo hellllllllooooo heloooooooooooooo'),
(18, 'hello', 'hello@gmail.com', 'hellooooooooooooo'),
(19, 'kanishka kumawat', 'kanishkakumawat1002@gmail.com', 'hello everyone how are you'),
(20, 'kanishka kumawat', 'kanishkakumawat1002@gmail.com', 'hello everyone how are you'),
(21, 'kanishka kumawat', 'admin@themeposh.xyz', 'hello everyone how are you guyzzzzzz'),
(22, 'kanishka kumawat', 'prash30@gmail.com', 'hello everyone how are you  prashansa'),
(23, 'PRASH', 'admin@themeposh.xyz', 'HELLO EVERYONE '),
(24, 'kanishka kumawat', 'kanishkakumawat1002@gmail.com', 'DXCVDVDZSVD'),
(25, 'VDSV', 'admin@themeposh.xyz', ' BFXBDVDS'),
(26, 'FDBFBF', 'kanishkakumawat1002@gmail.com', 'BFSHTENGHC'),
(27, 'kanishka kumawat', 'admin@themeposh.xyz', 'DBFDBDFBDGFBNFD'),
(28, 'hello', 'hello@gmail.com', 'hello'),
(29, 'hello', 'hello@gmail.com', 'hello'),
(30, 'hello', 'hello@gmail.com', 'hello'),
(31, 'hello', 'hello@gmail.com', 'hello'),
(32, 'hello', 'hello@gmail.com', 'vbfbfbf'),
(33, 'hello', 'hello@gmail.com', 'bfdbfdbvdfs'),
(34, 'Kanishka Kumawat', 'kanishka.kumawat@amity.edu', 'bdfbf'),
(35, 'Kanishka Kumawat', 'kanishkakumawat1002@gmail.com', 'fdbdsbfdb'),
(36, 'apple', 'admin24@gmail.com', 'kanishka this side'),
(37, 'apple', 'admin24@gmail.com', 'vfdvfxcvcvfvvdsv'),
(38, 'kanishka ', 'kanishkakumawat@gmail.com', 'kanishka this side'),
(39, 'kanishka', 'kanishkakunawat@gmail.com', 'kanishka'),
(40, 'kanishka', 'kanishkakunawat@gmail.com', 'hello hello'),
(41, 'kanishka', 'kanishkakunawat@gmail.com', 'my javascript code is not running'),
(42, 'kanishka', 'kanishkakunawat@gmail.com', 'my javascript code is not running'),
(43, 'kanishka', 'kanishkakunawat@gmail.com', 'my javascript code is not running'),
(44, 'Kanishka Kumawat', 'admin24@gmail.com', 'still not running'),
(45, 'Kanishka Kumawat', 'admin24@gmail.com', 'bfbxc '),
(46, 'Kanishka Kumawat', 'admin24@gmail.com', 'bfbxc '),
(47, 'Kanishka Kumawat', 'admin24@gmail.com', 'bfbxc '),
(48, 'Kanishka Kumawat', 'admin24@gmail.com', 'bfbxc '),
(49, 'Kanishka Kumawat', 'admin24@gmail.com', 'bfbxc '),
(50, 'Kanishka Kumawat', 'admin24@gmail.com', 'bfbxc '),
(51, 'Kanishka Kumawat', 'admin24@gmail.com', 'bfbxc '),
(52, 'Kanishka Kumawat', 'admin24@gmail.com', 'bfbxc '),
(53, 'Kanishka Kumawat', 'admin24@gmail.com', 'bfbxc '),
(54, 'Kanishka Kumawat', 'admin24@gmail.com', 'bfbxc '),
(55, 'Kanishka Kumawat', 'admin24@gmail.com', 'bfbxc '),
(56, 'Kanishka Kumawat', 'admin24@gmail.com', 'bfbxc '),
(57, 'Kanishka Kumawat', 'admin24@gmail.com', 'bfbxc '),
(58, 'Kanishka Kumawat', 'admin24@gmail.com', 'bfbxc '),
(59, 'Kanishka Kumawat', 'admin24@gmail.com', 'bfbxc '),
(60, 'Kanishka Kumawat', 'kanishkkumawat25@gmail.com', 'hdfxbfd'),
(61, 'Kanishka Kumawat', 'kanishkkumawat25@gmail.com', 'grfdhbdfd'),
(62, 'Kanishka Kumawat', 'kanishkkumawat25@gmail.com', 'grfdhbdfd'),
(63, 'Kanishka Kumawat', 'kanishkkumawat25@gmail.com', 'grfdhbdfd'),
(64, 'Kanishka Kumawat', 'kanishkkumawat25@gmail.com', 'bfdhrfghrs');

-- --------------------------------------------------------

--
-- Table structure for table `content_page`
--

CREATE TABLE `content_page` (
  `id` int(20) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `content_page`
--

INSERT INTO `content_page` (`id`, `content`) VALUES
(2, '<p>Type here and show console to see editor&#39;s heightLorem ipsum dolor sit amet consectetur adipisicing elit. Facilis reiciendis impedit tempore at fuga, omnis voluptas quidem dolores cupiditate delectus commodi molestiae ullam temporibus nostrum saepe, id repellendus? Corporis, quibusdam distinctio. Sunt iure sequi voluptate aut dolores! Veniam omnis itaque qui veritatis autem architecto provident modi eum, facilis non voluptatem tempore ut ad voluptas ex dolor eligendi quo perferendis vitae et ullam nemo recusandae. Repellat reiciendis facilis ea quas vero non et eveniet voluptatem. Similique asperiores aliquam dicta natus quae, eius, soluta distinctio nisi itaque quis cumque voluptates. Aperiam adipisci autem quia mollitia a, eum consectetur expedita assumenda. Dolorem debitis commodi, adipisci perspiciatis accusantium ullam sequi? Laboriosam, quis. Veritatis dolor, ducimus aut ipsam consequuntur illum numquam repellendus sit tenetur laboriosam eos aliquid dolore ipsa aliquam dolores fugiat, corrupti impedit sapiente, inventore sed quaerat laudantium facere exercitationem vitae? Veniam, porro. Aperiam dignissimos, rerum fugiat, deleniti odit, nostrum blanditiis nobis exercitationem velit accusantium sint eos inventore iure? Minus debitis suscipit nemo mollitia sed veniam, possimus nobis id et facilis odio quaerat autem necessitatibus molestias? Nostrum minus impedit quidem eaque aut sunt alias ab voluptates enim veniam, dolor laudantium accusantium optio quae ipsam aliquam at fugit repudiandae accusamus, sequi nesciunt sit ullam. Enim!</p>\r\n'),
(3, '<p><img alt=\"\" src=\"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSKlvdxbnKWN6NZyzlCflmLUKTt5lhzm049XQ&amp;s\" style=\"float:left; height:200px; margin:20px 120px; width:220px\" /><img alt=\"\" src=\"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSKlvdxbnKWN6NZyzlCflmLUKTt5lhzm049XQ&amp;s\" style=\"border-style:solid; border-width:2px; float:left; height:200px; margin:20px 100px; width:220px\" /><img alt=\"\" src=\"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSKlvdxbnKWN6NZyzlCflmLUKTt5lhzm049XQ&amp;s\" style=\"border-style:solid; border-width:1px; float:left; height:200px; margin:20px 120px; width:220px\" />&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>\n\n<h1><a href=\"http://localhost/programs/E-commerce/frontend/aboutus.php#\">Fruitables</a></h1>\n\n<p>Type here and show console to see editor&#39;s heightLorem ipsum dolor sit amet consectetur adipisicing elit. Facilis reiciendis impedit tempore at fuga, omnis voluptas quidem dolores cupiditate delectus commodi molestiae ullam temporibus nostrum saepe, id repellendus? Corporis, quibusdam distinctio. Sunt iure sequi voluptate aut dolores! Veniam omnis itaque qui veritatis autem architecto provident modi eum, facilis non voluptatem tempore ut ad voluptas ex dolor eligendi quo perferendis vitae et ullam nemo recusandae. Repellat reiciendis facilis ea quas vero non et eveniet voluptatem. Similique asperiores aliquam dicta natus quae, eius, soluta distinctio nisi itaque quis cumque voluptates. Aperiam adipisci autem quia mollitia a, eum consectetur expedita assumenda. Dolorem debitis commodi, adipisci perspiciatis accusantium ullam sequi? Laboriosam, quis.</p>\n\n<p>&nbsp;</p>\n\n<p>Veritatis dolor, ducimus aut ipsam consequuntur illum numquam repellendus sit tenetur laboriosam eos aliquid dolore ipsa aliquam dolores fugiat, corrupti impedit sapiente, inventore sed quaerat laudantium facere exercitationem vitae? Veniam, porro. Aperiam dignissimos, rerum fugiat, deleniti odit, nostrum blanditiis nobis exercitationem velit accusantium sint eos inventore iure? Minus debitis suscipit nemo mollitia sed veniam, possimus nobis id et facilis odio quaerat autem necessitatibus molestias? Nostrum minus impedit quidem eaque aut sunt alias ab voluptates enim veniam, dolor laudantium accusantium optio quae ipsam aliquam at fugit repudiandae accusamus, sequi nesciunt sit ullam. Enim!</p>\n\n<h1>&nbsp;</h1>\n'),
(4, '<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quae, a consectetur! Ducimus optio ab neque distinctio dolore ad deleniti esse illum dolores. Eaque veniam cum natus. Delectus temporibus beatae facilis possimus? Obcaecati facere mollitia iusto aspernatur earum totam incidunt ducimus itaque ex architecto quod illo sed vero voluptas officia tempora nesciunt laborum, reprehenderit asperiores eligendi voluptates quam? Non at architecto, atque excepturi similique esse facilis nemo sapiente exercitationem consectetur soluta voluptates asperiores. Quis sunt odio autem quaerat, repellendus rerum voluptates modi nisi, blanditiis sed cupiditate, ea quam obcaecati deleniti iusto aliquid nam. Quasi suscipit atque dolorem optio, laborum at corporis a dolor, sed, ipsa quaerat neque tempora. Quasi tenetur soluta placeat rerum ipsum sed odit suscipit velit impedit aut possimus, voluptatem fugiat esse quibusdam eaque culpa unde minima corporis? Similique provident odio, nisi dolores quae amet incidunt doloribus deserunt reprehenderit architecto repudiandae quam aspernatur iure tempore repellat eos itaque pariatur dolore dicta iste corporis ullam minus! Animi natus laudantium officiis molestias repellat facilis cupiditate accusamus, eius a voluptatem, voluptatum commodi nostrum rerum, nulla eveniet blanditiis ratione debitis aliquam repudiandaxconsectetur expedita assumenda. Dolorem debitis commodi, adipisci perspiciatis accusantium ullam sequi? Laboriosam, quis. Veritatis dolor, ducimus aut ipsam consequuntur illum numquam repellendus sit tenetur laboriosam eos aliquid dolore ipsa aliquam dolores fugiat, corrupti impedit sapiente, inventore sed quaerat laudantium facere exercitationem vitae? Veniam, porro. Aperiam dignissimos, rerum fugiat, deleniti odit, nostrum blanditiis nobis exercitationem velit accusantium sint eos inventore iure? Minus debitis suscipit nemo mollitia sed veniam, possimus nobis id et facilis odio quaerat autem necessitatibus molestias? Nostrum minus impedit quidem eaque aut sunt alias ab voluptates enim veniam, dolor laudantium accusantium optio quae ipsam aliquam at fugit repudiandae accusamus, sequi nesciunt sit ullam. Enim!</p>\n\n<p>&nbsp;</p>\n\n<p>&nbsp;perferendis? Cupiditate est exercitationem optio sunt accusantium expedita magni deserunt eaque corrupti. Officiis, optio mollitia? Beatae eos consequuntur aliquid tempore officia.<br />\nType here and show console to see editor&#39;s heightLorem ipsum dolor sit amet consectetur adipisicing elit. Facilis reiciendis impedit tempore at fuga, omnis voluptas quidem dolores cupiditate delectus commodi molestiae ullam temporibus nostrum saepe, id repellendus? Corporis, quibusdam distinctio. Sunt iure sequi voluptate aut dolores! Veniam omnis itaque qui veritatis autem architecto provident modi eum, facilis non voluptatem tempore ut ad voluptas ex dolor eligendi quo perferendis vitae et ullam nemo recusandae. Repellat reiciendis facilis ea quas vero non et eveniet voluptatem. Similique asperiores aliquam dicta natus quae, eius, soluta distinctio nisi itaque quis cumque voluptates. Aperiam adipisci autem quia mollitia a, eum</p>\n\n<span><img alt=\"\" src=\"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSKlvdxbnKWN6NZyzlCflmLUKTt5lhzm049XQ&amp;s\"</span> \n<span><img alt=\"\" src=\"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSKlvdxbnKWN6NZyzlCflmLUKTt5lhzm049XQ&amp;s\"</span>\n');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `discount_type` enum('percentage','fixed') NOT NULL,
  `discount_value` decimal(10,2) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `usage_limit` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `used_count` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `code`, `discount_type`, `discount_value`, `start_date`, `end_date`, `usage_limit`, `created_at`, `used_count`) VALUES
(1, '76', 'percentage', 20.00, '2024-07-18', '2024-07-31', 30, '2024-07-18 11:23:58', 5),
(3, '16541651651', 'percentage', 32.00, '2024-07-17', '2024-08-08', 23, '2024-07-18 11:25:59', 1),
(5, '165426', 'fixed', 56.00, '2024-07-17', '2024-07-25', 50, '2024-07-18 11:27:33', 12),
(7, '154116354', 'fixed', 56.00, '2024-07-19', '2024-08-15', 56, '2024-07-18 11:28:22', 0),
(8, '0', 'percentage', 44.00, '2024-07-19', '2024-07-09', 44, '2024-07-24 09:53:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `details`
--

CREATE TABLE `details` (
  `id` int(20) NOT NULL,
  `product_id` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `weight` varchar(225) NOT NULL,
  `origin` varchar(225) NOT NULL,
  `quality` varchar(225) NOT NULL,
  `min_weight` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `details`
--

INSERT INTO `details` (`id`, `product_id`, `description`, `weight`, `origin`, `quality`, `min_weight`) VALUES
(1, '29', 'The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic words etc. Susp endisse ultricies nisi vel quam suscipit\r\n\r\nSabertooth peacock flounder; chain pickerel hatchetfish, pencilfish snailfish filefish Antarctic icefish goldeye aholehole trumpetfish pilot fish airbreathing catfish, electric ray sweeper.\r\n\r\n', '500 gm', 'Agro Farm', 'Organic', '250 gm'),
(2, '31', 'The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic words etc. Susp endisse ultricies nisi vel quam suscipit\r\n\r\nSabertooth peacock flounder; chain pickerel hatchetfish, pencilfish snailfish filefish Antarctic icefish goldeye aholehole trumpetfish pilot fish airbreathing catfish, electric ray sweeper.\r\n\r\n', '500 gm', 'Agro Farm', 'Organic', '250 gm'),
(3, '30', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptatem dolorum, sed natus obcaecati assumenda repellendus dolorem libero accusamus nihil unde ducimus? Magnam exercitationem, nihil, aliquam, in maxime voluptatem ullam rem dolores aliquid optio temporibus suscipit assumenda odit molestias voluptas. Nesciunt!', '1 kg', 'Agro Farm', 'Organic', '200gm'),
(4, '32', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptatem dolorum, sed natus obcaecati assumenda repellendus dolorem libero accusamus nihil unde ducimus? Magnam exercitationem, nihil, aliquam, in maxime voluptatem ullam rem dolores aliquid optio temporibus suscipit assumenda odit molestias voluptas. Nesciunt!', '500 gm', 'Fru Farm', 'Organic', '250 gm'),
(5, '33', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptatem dolorum, sed natus obcaecati assumenda repellendus dolorem libero accusamus nihil unde ducimus? Magnam exercitationem, nihil, aliquam, in maxime voluptatem ullam rem dolores aliquid optio temporibus suscipit assumenda odit molestias voluptas. Nesciunt!', '1 kg', 'Kim Farm', 'Organic', '250 gm'),
(6, '34', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptatem dolorum, sed natus obcaecati assumenda repellendus dolorem libero accusamus nihil unde ducimus? Magnam exercitationem, nihil, aliquam, in maxime voluptatem ullam rem dolores aliquid optio temporibus suscipit assumenda odit molestias voluptas. Nesciunt!', '500 gm', 'Agro Farm', 'Organic', '250 gm'),
(7, '35', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptatem dolorum, sed natus obcaecati assumenda repellendus dolorem libero accusamus nihil unde ducimus? Magnam exercitationem, nihil, aliquam, in maxime voluptatem ullam rem dolores aliquid optio temporibus suscipit assumenda odit molestias voluptas. Nesciunt!', '1 kg', 'Fru Faram', 'Organic', '250 gm'),
(8, '36', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptatem dolorum, sed natus obcaecati assumenda repellendus dolorem libero accusamus nihil unde ducimus? Magnam exercitationem, nihil, aliquam, in maxime voluptatem ullam rem dolores aliquid optio temporibus suscipit assumenda odit molestias voluptas. Nesciunt!', '1 kg', 'Kim Farm', 'Organic', '250 gm'),
(9, '38', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptatem dolorum, sed natus obcaecati assumenda repellendus dolorem libero accusamus nihil unde ducimus? Magnam exercitationem, nihil, aliquam, in maxime voluptatem ullam rem dolores aliquid optio temporibus suscipit assumenda odit molestias voluptas. Nesciunt!', '500 gm', 'Agro Farm', 'Organic', '250 gm'),
(10, '40', 'The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic words etc. Susp endisse ultricies nisi vel quam suscipit\r\n\r\nSabertooth peacock flounder; chain pickerel hatchetfish, pencilfish snailfish filefish Antarctic icefish goldeye aholehole trumpetfish pilot fish airbreathing catfish, electric ray sweeper.', '500 gm', 'agro Farm', 'Organic', '250 gm'),
(11, '41', 'The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic words etc. Susp endisse ultricies nisi vel quam suscipit\r\n\r\nSabertooth peacock flounder; chain pickerel hatchetfish, pencilfish snailfish filefish Antarctic icefish goldeye aholehole trumpetfish pilot fish airbreathing catfish, electric ray sweeper.', '500 gm', 'Kim Farm', 'Organic', '250 gm'),
(12, '42', 'The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic words etc. Susp endisse ultricies nisi vel quam suscipit\r\n\r\nSabertooth peacock flounder; chain pickerel hatchetfish, pencilfish snailfish filefish Antarctic icefish goldeye aholehole trumpetfish pilot fish airbreathing catfish, electric ray sweeper.', '500 gm', 'agro Farm', 'Organic', '250 gm'),
(13, '43', 'The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic words etc. Susp endisse ultricies nisi vel quam suscipit\r\n\r\nSabertooth peacock flounder; chain pickerel hatchetfish, pencilfish snailfish filefish Antarctic icefish goldeye aholehole trumpetfish pilot fish airbreathing catfish, electric ray sweeper.', '500 gm', 'agro Farm', 'Organic', '250 gm'),
(14, '44', 'The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic words etc. Susp endisse ultricies nisi vel quam suscipit\r\n\r\nSabertooth peacock flounder; chain pickerel hatchetfish, pencilfish snailfish filefish Antarctic icefish goldeye aholehole trumpetfish pilot fish airbreathing catfish, electric ray sweeper.', '500 gm', 'agro Farm', 'Organic', '250 gm'),
(15, '45', 'The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic words etc. Susp endisse ultricies nisi vel quam suscipit\r\n\r\nSabertooth peacock flounder; chain pickerel hatchetfish, pencilfish snailfish filefish Antarctic icefish goldeye aholehole trumpetfish pilot fish airbreathing catfish, electric ray sweeper.', '500 gm', 'agro Farm', 'Organic', '250 gm'),
(16, '39', 'The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic words etc. Susp endisse ultricies nisi vel quam suscipit\r\n\r\nSabertooth peacock flounder; chain pickerel hatchetfish, pencilfish snailfish filefish Antarctic icefish goldeye aholehole trumpetfish pilot fish airbreathing catfish, electric ray sweeper.', '500 gm', 'agro Farm', 'Organic', '250 gm'),
(17, '46', 'The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic words etc. Susp endisse ultricies nisi vel quam suscipit\r\n\r\nSabertooth peacock flounder; chain pickerel hatchetfish, pencilfish snailfish filefish Antarctic icefish goldeye aholehole trumpetfish pilot fish airbreathing catfish, electric ray sweeper.', '500 gm', 'agro Farm', 'Organic', '250 gm'),
(18, '47', 'The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic words etc. Susp endisse ultricies nisi vel quam suscipit\r\n\r\nSabertooth peacock flounder; chain pickerel hatchetfish, pencilfish snailfish filefish Antarctic icefish goldeye aholehole trumpetfish pilot fish airbreathing catfish, electric ray sweeper.', '500 gm', 'agro Farm', 'Organic', '250 gm'),
(19, '48', 'The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic words etc. Susp endisse ultricies nisi vel quam suscipit\r\n\r\nSabertooth peacock flounder; chain pickerel hatchetfish, pencilfish snailfish filefish Antarctic icefish goldeye aholehole trumpetfish pilot fish airbreathing catfish, electric ray sweeper.', '500 gm', 'agro Farm', 'Organic', '250 gm'),
(20, '49', 'The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic words etc. Susp endisse ultricies nisi vel quam suscipit\r\n\r\nSabertooth peacock flounder; chain pickerel hatchetfish, pencilfish snailfish filefish Antarctic icefish goldeye aholehole trumpetfish pilot fish airbreathing catfish, electric ray sweeper.', '500 gm', 'agro Farm', 'Organic', '250 gm'),
(21, '50', 'The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic words etc. Susp endisse ultricies nisi vel quam suscipit\r\n\r\nSabertooth peacock flounder; chain pickerel hatchetfish, pencilfish snailfish filefish Antarctic icefish goldeye aholehole trumpetfish pilot fish airbreathing catfish, electric ray sweeper.', '500 gm', 'agro Farm', 'Organic', '250 gm'),
(22, '51', 'The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic words etc. Susp endisse ultricies nisi vel quam suscipit\r\n\r\nSabertooth peacock flounder; chain pickerel hatchetfish, pencilfish snailfish filefish Antarctic icefish goldeye aholehole trumpetfish pilot fish airbreathing catfish, electric ray sweeper.', '500 gm', 'agro Farm', 'Organic', '250 gm'),
(23, '52', 'The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic words etc. Susp endisse ultricies nisi vel quam suscipit\r\n\r\nSabertooth peacock flounder; chain pickerel hatchetfish, pencilfish snailfish filefish Antarctic icefish goldeye aholehole trumpetfish pilot fish airbreathing catfish, electric ray sweeper.', '500 gm', 'agro Farm', 'Organic', '250 gm'),
(24, '53', 'The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic words etc. Susp endisse ultricies nisi vel quam suscipit\r\n\r\nSabertooth peacock flounder; chain pickerel hatchetfish, pencilfish snailfish filefish Antarctic icefish goldeye aholehole trumpetfish pilot fish airbreathing catfish, electric ray sweeper.', '500 gm', 'agro Farm', 'Organics', '250 gm'),
(26, '29', 'sdgs', 'dssfgfdsgs', 'dstsg', '3', 'sfd');

-- --------------------------------------------------------

--
-- Table structure for table `help`
--

CREATE TABLE `help` (
  `id` int(20) NOT NULL,
  `content` text NOT NULL,
  `date` int(225) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `help`
--

INSERT INTO `help` (`id`, `content`, `date`) VALUES
(1, '<h2>Top Queries</h2>\r\n\r\n<p>Why are there different prices for the same product? Is it legal?</p>\r\n\r\n<p>I saw the product at Rs. 1000 but post clicking on the product, there are multiple prices and the size which I want is being sold for Rs. 1600. Why is there a change in price in the product description page?</p>\r\n\r\n<p>How will I detect fraudulent emails/calls seeking sensitive personal and confidential information?</p>\r\n\r\n<p>How will I identify a genuine appointment letter?</p>\r\n\r\n<p>Why will &#39;My Cashback&#39; not be available on Myntra?</p>\r\n\r\n<p>How do I cancel the order, I have placed?</p>\r\n\r\n<p>How do I create a Return Request?</p>\r\n\r\n<p>I have created a Return request. When will the product be picked up?</p>\r\n\r\n<p>I have created a Return request. When will I get the refund?</p>\r\n\r\n<p>Where should I self-ship the Returns?</p>\r\n\r\n<p>I have accumulated Myntra Points in my account. How can I redeem them?</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Social Carnival Event</h2>\r\n\r\n<p>What is Myntra Social Carnival?</p>\r\n\r\n<p>What is Myntra Studio, and how can I shop through Myntra Studio ?</p>\r\n\r\n<p>What is Myntra Live, and how do I shop through Myntra Live?</p>\r\n\r\n<p>How can you sign up to be an influencer on Myntra Studio or Myntra Live?</p>\r\n\r\n<p>How do I redeem the MLive Coupons which I saw Influencers calling out in live streaming?</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Shipping, Order Tracking &amp; Delivery</h2>\r\n\r\n<p>What is Myntra&#39;s Platform Fee?</p>\r\n\r\n<p>Refund of Platform Fee</p>\r\n\r\n<p>What is Myntra&#39;s Shipping Fee?</p>\r\n\r\n<p>Refund of Shipping Fee</p>\r\n\r\n<p>What is Myntra&rsquo;s Fair Usage Policy?</p>\r\n\r\n<p>I am an Insider. Why am I seeing the shipping fee?</p>\r\n\r\n<p>How do I check the status of my order?</p>\r\n\r\n<p>How can I check if Myntra delivers to my PIN Code?</p>\r\n\r\n<p>How are orders placed on Myntra delivered to me?</p>\r\n\r\n<p>Does Myntra deliver products outside India?</p>\r\n\r\n<p>How can I get my order delivered faster?</p>\r\n\r\n<p>I have received a partial item/partial order or an Untenanted/Void packet?</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Cancellations and Modifications</h2>\r\n\r\n<p>What is Myntra&#39;s Cancellation Policy?</p>\r\n\r\n<p>Can I modify the shipping address of my order after it has been placed?</p>\r\n\r\n<p>How do I cancel my Order?</p>\r\n\r\n<p>I just cancelled my order. When will I receive my refund?</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Returns and Exchang</h2>\r\n\r\n<p>What is Myntra&#39;s Return and Exchange Policy? How does it work?</p>\r\n\r\n<p>To return a product to Myntra, please follow these steps:</p>\r\n\r\n<p>How do I place an exchange request on Myntra?</p>\r\n\r\n<p>What is No Questions Asked Returns?</p>\r\n\r\n<p>Why has my return been put on hold despite No Questions Asked Returns Policy?</p>\r\n\r\n<p>What is Instant Refunds?</p>\r\n\r\n<p>Why have I not received my Refund despite Instant Refunds policy?</p>\r\n\r\n<p>How long would it take me to receive the refund of the returned product?</p>\r\n\r\n<p>How do I return multiple products from a single order?</p>\r\n\r\n<p>Does Myntra pick up the product I want to return from my location?</p>\r\n\r\n<p>How can I Self-Ship the product to Myntra?</p>\r\n\r\n<p>Where should I self-ship the Returns?</p>\r\n\r\n<p>Why has my return request been declined?</p>\r\n\r\n<p>Why did the pick up of my product fail?</p>\r\n\r\n<p>Why is my returned product re-shipped?</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n', 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(20) NOT NULL,
  `address_id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `product_id` int(20) NOT NULL,
  `image` varchar(225) NOT NULL,
  `p_name` varchar(225) NOT NULL,
  `price` varchar(225) NOT NULL,
  `quantity` int(20) NOT NULL,
  `payment_status` varchar(225) NOT NULL,
  `date` varchar(225) NOT NULL DEFAULT current_timestamp(),
  `sale_price` int(11) DEFAULT NULL,
  `payment_id` varchar(20) NOT NULL,
  `status` varchar(255) DEFAULT 'pending',
  `cancellation_reason` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `address_id`, `user_id`, `product_id`, `image`, `p_name`, `price`, `quantity`, `payment_status`, `date`, `sale_price`, `payment_id`, `status`, `cancellation_reason`) VALUES
(24, 32, 3, 32, 'images4.jpeg', 'strawberry', '150', 1, 'Completed', '2024-07-10 ', NULL, '', 'completed', ''),
(25, 32, 3, 35, 'maize.jpeg', 'Maize', '100', 2, 'Completed', '2024-07-10 ', NULL, '', 'completed', ''),
(26, 32, 3, 36, 'cheese.webp', 'Cheese', '149', 1, 'Completed', '2024-07-10 ', NULL, '', 'pending', ''),
(27, 32, 3, 38, 'cheese.webp', 'Cheese', '299', 1, 'Completed', '2024-07-10 ', NULL, '', 'pending', ''),
(28, 34, 3, 32, 'images4.jpeg', 'strawberry', '150', 2, 'Pending', '2024-07-10 ', NULL, '', 'pending', ''),
(36, 32, 3, 49, 'best-product-5.jpg', 'Grapes', '149', 1, 'Pending', '2024-07-12', NULL, '', 'pending', ''),
(37, 32, 3, 32, 'images4.jpeg', 'strawberry', '150', 1, 'Pending', '2024-07-12 ', NULL, '', 'pending', ''),
(38, 32, 3, 32, 'images4.jpeg', 'strawberry', '150', 1, 'Pending', '2024-07-12 ', NULL, '', 'pending', ''),
(39, 32, 3, 57, 'maize.jpeg', 'Maize', '200', 1, 'Pending', '2024-07-12 ', NULL, '', 'pending', ''),
(40, 32, 3, 58, 'ice cream.jpeg', 'Ice Cream', '200', 1, 'Pending', '2024-07-12', NULL, '', 'pending', ''),
(41, 35, 4, 52, 'cherry.jpg', 'Cherry', '200', 1, 'Pending', '2024-07-12', NULL, '', 'pending', ''),
(42, 35, 4, 33, 'images3.jpeg', 'Mango', '99', 2, 'Pending', '2024-07-12 ', NULL, '', 'pending', ''),
(43, 35, 4, 35, 'maize.jpeg', 'Maize', '100', 4, 'Pending', '2024-07-18 22:18:18', NULL, '', 'pending', ''),
(44, 35, 4, 35, 'maize.jpeg', 'Maize', '100', 4, 'Pending', '2024-07-18 22:55:29', NULL, '', 'pending', ''),
(45, 35, 4, 35, 'maize.jpeg', 'Maize', '100', 4, 'Pending', '2024-07-18 23:30:23', NULL, '', 'pending', ''),
(46, 35, 4, 35, 'maize.jpeg', 'Maize', '100', 4, 'Pending', '2024-07-18 23:31:32', NULL, '', 'pending', ''),
(47, 35, 4, 35, 'maize.jpeg', 'Maize', '100', 4, 'Pending', '2024-07-18 23:41:54', NULL, '', 'pending', ''),
(48, 35, 4, 35, 'maize.jpeg', 'Maize', '100', 4, 'Pending', '2024-07-18 23:47:21', NULL, '', 'pending', ''),
(49, 35, 4, 35, 'maize.jpeg', 'Maize', '100', 4, 'Pending', '2024-07-19 00:00:38', NULL, '', 'pending', ''),
(50, 35, 4, 29, 'tomato.jpeg', 'Tomato', '50', 1, 'Pending', '2024-07-19 00:00:38', NULL, '', 'pending', ''),
(51, 35, 4, 30, 'carrot.jpeg', 'Carrot', '70', 1, 'Pending', '2024-07-19 00:03:26', NULL, '', 'pending', ''),
(52, 35, 4, 30, 'carrot.jpeg', 'Carrot', '70', 1, 'Pending', '2024-07-19 00:03:40', NULL, '', 'pending', ''),
(53, 35, 4, 30, 'carrot.jpeg', 'Carrot', '70', 1, 'Pending', '2024-07-19 00:04:20', NULL, '', 'pending', ''),
(54, 35, 4, 30, 'carrot.jpeg', 'Carrot', '70', 1, 'Pending', '2024-07-19 00:18:35', NULL, '', 'pending', ''),
(55, 35, 4, 30, 'carrot.jpeg', 'Carrot', '70', 1, 'Pending', '2024-07-19 14:47:22', 0, '', 'pending', ''),
(56, 35, 4, 30, 'carrot.jpeg', 'Carrot', '70', 1, 'Pending', '2024-07-19 14:47:33', 0, '', 'pending', ''),
(57, 35, 4, 40, 'carrot.jpeg', 'Carrot', '99', 1, 'Pending', '2024-07-19 14:47:33', 0, '', 'pending', ''),
(58, 35, 4, 33, 'images3.jpeg', 'Mango', '99', 1, 'Pending', '2024-07-19 14:47:33', 0, '', 'pending', ''),
(59, 35, 4, 30, 'carrot.jpeg', 'Carrot', '70', 1, 'Pending', '2024-07-19 14:49:55', 0, '', 'pending', ''),
(60, 35, 4, 30, 'carrot.jpeg', 'Carrot', '70', 1, 'Pending', '2024-07-19 14:51:34', 0, '', 'pending', ''),
(61, 35, 4, 30, 'carrot.jpeg', 'Carrot', '70', 1, 'Pending', '2024-07-19 14:51:47', 0, '', 'pending', ''),
(62, 35, 4, 30, 'carrot.jpeg', 'Carrot', '70', 1, 'Pending', '2024-07-19 14:52:06', 0, '', 'pending', ''),
(63, 35, 4, 30, 'carrot.jpeg', 'Carrot', '70', 1, 'Pending', '2024-07-19 14:52:58', 0, '', 'pending', ''),
(64, 35, 4, 30, 'carrot.jpeg', 'Carrot', '70', 1, 'Pending', '2024-07-19 14:53:18', 0, '', 'pending', ''),
(65, 35, 4, 30, 'carrot.jpeg', 'Carrot', '70', 1, 'Pending', '2024-07-19 14:53:31', 0, '', 'pending', ''),
(66, 35, 4, 40, 'carrot.jpeg', 'Carrot', '99', 1, 'Pending', '2024-07-19 14:53:31', 0, '', 'pending', ''),
(67, 35, 4, 33, 'images3.jpeg', 'Mango', '99', 1, 'Pending', '2024-07-19 14:53:31', 0, '', 'pending', ''),
(68, 35, 4, 30, 'carrot.jpeg', 'Carrot', '70', 1, 'Pending', '2024-07-19 14:55:06', 0, '', 'pending', ''),
(69, 35, 4, 30, 'carrot.jpeg', 'Carrot', '70', 1, 'Pending', '2024-07-19 14:57:16', 0, '', 'pending', ''),
(70, 35, 4, 40, 'carrot.jpeg', 'Carrot', '99', 1, 'Pending', '2024-07-19 14:57:16', 0, '', 'pending', ''),
(71, 35, 4, 33, 'images3.jpeg', 'Mango', '99', 1, 'Pending', '2024-07-19 14:57:16', 0, '', 'pending', ''),
(72, 35, 4, 30, 'carrot.jpeg', 'Carrot', '70', 1, 'Pending', '2024-07-19 14:57:20', 0, '', 'pending', ''),
(73, 35, 4, 40, 'carrot.jpeg', 'Carrot', '99', 1, 'Pending', '2024-07-19 14:57:20', 0, '', 'pending', ''),
(74, 35, 4, 33, 'images3.jpeg', 'Mango', '99', 1, 'Pending', '2024-07-19 14:57:20', 0, '', 'pending', ''),
(81, 35, 4, 30, 'carrot.jpeg', 'Carrot', '70', 1, 'Pending', '2024-07-19 15:04:08', 0, '', 'pending', ''),
(82, 35, 4, 30, 'carrot.jpeg', 'Carrot', '70', 1, 'Pending', '2024-07-19 15:04:26', 0, '', 'pending', ''),
(83, 35, 4, 30, 'carrot.jpeg', 'Carrot', '70', 1, 'Pending', '2024-07-19 15:05:08', 0, '', 'pending', ''),
(84, 35, 4, 30, 'carrot.jpeg', 'Carrot', '70', 1, 'Pending', '2024-07-19 15:05:33', 0, '', 'pending', ''),
(85, 35, 4, 30, 'carrot.jpeg', 'Carrot', '70', 1, 'Pending', '2024-07-19 15:08:12', 0, '', 'pending', ''),
(86, 35, 4, 30, 'carrot.jpeg', 'Carrot', '70', 1, 'Payment Initiated', '2024-07-20 00:06:48', 0, '', 'pending', ''),
(87, 35, 4, 30, 'carrot.jpeg', 'Carrot', '70', 1, 'Payment Initiated', '2024-07-20 00:27:22', 0, '', 'pending', ''),
(88, 35, 4, 30, 'carrot.jpeg', 'Carrot', '70', 1, 'Payment Initiated', '2024-07-20 01:09:28', 0, '', 'pending', ''),
(89, 35, 4, 30, 'carrot.jpeg', 'Carrot', '70', 1, 'Payment Initiated', '2024-07-20 09:51:32', 0, '', 'pending', ''),
(90, 35, 4, 30, 'carrot.jpeg', 'Carrot', '70', 1, 'Payment Initiated', '2024-07-20 09:52:25', 0, '', 'pending', ''),
(91, 35, 4, 30, 'carrot.jpeg', 'Carrot', '70', 1, 'Payment Initiated', '2024-07-20 10:04:15', 0, '', 'pending', ''),
(92, 35, 4, 30, 'carrot.jpeg', 'Carrot', '70', 1, 'Pending', '2024-07-20 10:04:21', 0, '', 'pending', ''),
(93, 35, 4, 49, 'best-product-5.jpg', 'Grapes', '149', 1, 'Pending', '2024-07-20 11:07:21', 0, '', 'pending', ''),
(94, 35, 4, 50, 'cherry.jpg', 'Cherry', '249', 1, 'Pending', '2024-07-20 11:07:21', 230, '', 'pending', ''),
(95, 35, 4, 31, 'image5.jpeg', 'lichi', '200', 1, 'Pending', '2024-07-20 11:08:39', 0, '', 'pending', ''),
(96, 35, 4, 30, 'carrot.jpeg', 'Carrot', '70', 1, 'Pending', '2024-07-20 11:08:39', 0, '', 'pending', ''),
(97, 35, 4, 59, 'cheese.webp', 'Cheese', '100', 1, 'Pending', '2024-07-20 11:18:39', 0, '', 'pending', ''),
(98, 35, 4, 60, 'ice cream.jpeg', 'Ice Cream', '400', 1, 'Pending', '2024-07-20 11:18:39', 369, '', 'pending', ''),
(99, 35, 4, 45, 'wheat.jpeg', 'Wheat', '300', 1, 'Pending', '2024-07-20 11:27:50', 0, '', 'pending', ''),
(100, 35, 4, 46, 'millet.jpeg', 'millet', '500', 1, 'Pending', '2024-07-20 11:27:50', 489, '', 'pending', ''),
(101, 35, 4, 39, 'broccoli.jpg', 'Broccoli', '449', 1, 'Pending', '2024-07-20 11:28:51', 429, '', 'pending', ''),
(102, 35, 4, 32, 'images4.jpeg', 'strawberry', '150', 1, 'Pending', '2024-07-20 11:30:56', 0, '', 'pending', ''),
(103, 32, 3, 57, 'maize.jpeg', 'Maize', '200', 1, 'payment Initiated', '2024-07-20 12:28:46', 179, '', 'pending', ''),
(104, 32, 3, 30, 'carrot.jpeg', 'Carrot', '70', 1, 'payment Initiated', '2024-07-20 12:28:46', 0, '', 'pending', ''),
(105, 32, 3, 53, 'ice cream.jpeg', 'Ice cream', '100', 1, 'Pending', '2024-07-20 13:32:13', 0, '', 'pending', ''),
(106, 32, 3, 31, 'image5.jpeg', 'lichi', '200', 1, 'completed', '2024-07-20 14:42:51', 0, 'pay_OapgTsDmu4hzqR', 'pending', ''),
(107, 32, 3, 30, 'carrot.jpeg', 'Carrot', '70', 1, 'completed', '2024-07-20 14:46:31', 0, 'pay_OapkM4tohaln24', 'pending', ''),
(108, 32, 3, 39, 'broccoli.jpg', 'Broccoli', '449', 1, 'completed', '2024-07-20 14:52:40', 429, 'pay_OapqXRI98oDFbS', 'pending', ''),
(109, 32, 3, 30, 'carrot.jpeg', 'Carrot', '70', 1, 'completed', '2024-07-20 14:57:14', 0, 'pay_Oapvc0B0KeYdCT', 'pending', ''),
(110, 32, 3, 57, 'maize.jpeg', 'Maize', '200', 1, 'completed', '2024-07-23 ', 179, 'pay_ObySyzRyryFNVX', 'pending', ''),
(111, 32, 3, 29, 'tomato.jpeg', 'Tomato', '50', 1, 'Pending', '2024-07-23 12:50:48', 47, '', 'pending', ''),
(112, 32, 3, 30, 'carrot.jpeg', 'Carrot', '70', 1, 'Pending', '2024-07-23 12:53:45', 0, '', 'pending', ''),
(113, 32, 3, 30, 'carrot.jpeg', 'Carrot', '70', 1, 'Pending', '2024-07-23 13:01:48', 0, '', 'pending', ''),
(114, 35, 4, 52, 'cherry.jpg', 'Cherry', '200', 1, 'Pending', '2024-07-24 16:35:03', 0, '', 'pending', ''),
(115, 35, 4, 30, 'carrot.jpeg', 'Carrot', '70', 3, 'Pending', '2024-07-24 17:05:09', 0, '', 'pending', ''),
(116, 35, 4, 31, 'image5.jpeg', 'lichi', '200', 1, 'Pending', '2024-07-24 17:06:55', 0, '', 'pending', ''),
(117, 36, 4, 31, 'image5.jpeg', 'lichi', '200', 1, 'Pending', '2024-07-26 16:27:25', 0, '', 'pending', ''),
(118, 36, 4, 29, 'tomato.jpeg', 'Tomato', '50', 1, 'Pending', '2024-07-26 16:27:25', 47, '', 'pending', ''),
(119, 46, 4, 31, 'image5.jpeg', 'lichi', '200', 1, 'Pending', '2024-07-26 16:32:26', 0, '', 'pending', '');

-- --------------------------------------------------------

--
-- Table structure for table `privacy_policy`
--

CREATE TABLE `privacy_policy` (
  `id` int(20) NOT NULL,
  `content` text NOT NULL,
  `date` varchar(225) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `privacy_policy`
--

INSERT INTO `privacy_policy` (`id`, `content`, `date`) VALUES
(1, '<p>Disclaimer: In the event of any discrepancy or conflict, the English version will prevail over the translation.</p>\r\n\r\n<p>Introduction</p>\r\n\r\n<p>We value the trust you place in us and recognize the importance of secure transactions and information privacy. This Privacy Policy describes how Myntra Designs Private Limited and its affiliates (collectively &quot;Myntra, we, our, us&quot;) collect, use, share, protect or otherwise process your personal data through Myntra website&nbsp;<a href=\"https://www.myntra.com),%20its%20mobile%20application,%20and%20m-site%20(hereinafter%20individually%20referred%20to%20as%20the/\">https://www.myntra.com</a>. While you may be able to browse certain sections of the Platform without registering with us, however, please note we do not offer any product/service under this Platform outside India and your personal data will primarily be stored and processed in India. By visiting this Platform, providing your information or availing any product/service offered on the Platform, you expressly agree to be bound by the terms and conditions of this Privacy Policy, the&nbsp;<a href=\"https://www.myntra.com/termsofuse\">Terms of Use</a>&nbsp;and the applicable service/product terms and conditions, and agree to be governed by the laws of India including but not limited to the laws applicable to data protection and privacy. If you do not agree please do not use or access our Platform.</p>\r\n\r\n<p>Collection</p>\r\n\r\n<p>We collect your personal data relating to your identity, demographics when you use our Platform, services or otherwise interact with us during the course of our relationship and related information provided from time to time. Some of the information that we may collect includes but is not limited to Information provided to us during sign-up/registering or using our Platform such as name, date of birth, address, telephone/mobile number, email ID and any such information shared as proof of identity or address. Some of the sensitive personal data may be collected with your concent, such as your bank account or credit or debit card or other payment instrument information or biometric information such as your facial features or physiological information (in order to enable use of certain features when opted for, available on the Platform to assist you with your shopping experience) etc all of the above being in accordance with applicable law. Some of the information such as your shopping behaviour, preferences, call data records, device location, voice, your browsing history, and other information that you may provide to us from time to time. Our primary goal in doing so is to provide you a safe, efficient, smooth, and customised experience. This allows us to provide services and features that most likely meet your needs, and to customise our Platform to make your experience safer and easier. In general, you can browse the Platform without telling us who you are or revealing any personal data about yourself. Once you give us your personal data, you are not anonymous to us. Where possible, we indicate which fields are required and which fields are optional. You always have the option to not provide information, by choosing not to use a particular service or feature on the Platform. We may track your buying behaviour, preferences, and other information that you choose to provide on our Platform. We use this information to do research on our users&#39; demographics, interests, and behaviour to better understand and serve our users. This information is compiled and analysed on an aggregated basis. This information may include the URL that you just came from (whether this URL is on our Platform or not), which URL you next go to (whether this URL is on our Platform or not), your computer browser information, and your IP address. If you enrol into our loyalty program or participate in third party loyalty program offered by us, we will collect and store your personal data such as name, contact number, email address, communication address, date of birth, gender, zip code, lifestyle information, demographic and work details which is provided by you to us or a third-party business partner that operates platforms where you can earn loyalty points for purchase of goods and services, and/or also redeem them. We will also collect your information related to your transactions on Platform and such third-party business partner platforms. When such a third-party business partner collects your personal data directly from you, you will be governed by their privacy policies. We shall not be responsible for the third-party business partner&rsquo;s privacy practices or the content of their privacy policies, and we request you to read their privacy policies prior to disclosing any information. If you set up an account or transact with us, we may seek some additional information, such as billing address, and/ or other payment instrument details and tracking information from cheques or money orders to provide services, enable transactions or to refund for cancelled transactions. If you choose to post messages on our message boards, personalised messages, images, photos, gift card message box, chat rooms or other message areas or leave feedback/product review or if you use voice commands to shop on the Platform, we will collect that information you provide to us.Furthermore we may use the images shared by you. Please note such messages posted by you will be in public domain and can be read by others as well, please exercise caution while posting such messages, personal details, photos and reviews. We retain this information as necessary to resolve disputes, provide customer support, internal research and troubleshoot problems as permitted by law. If you send us personal correspondence, such as emails or letters, or if other users or third parties send us correspondence about your activities or postings on the Platform, we may collect such information into a file specific to you. While you can browse some sections of our Platform without being a registered member, certain activities (such as placing an order or consuming our online content or services or participating in any event) requires registration. We may use your contact information to send you offers based on your previous orders or preferences and your interests. If you receive an email, a call from a person/association claiming to be from Myntra seeking any personal data like debit/credit card PIN, net-banking or mobile banking password, we request you to never provide such information. We at Myntra or our affiliate logistics partner do not at any time connect with you requesting for such information. If you have already revealed such information, report it immediately to an appropriate law enforcement agency.</p>\r\n\r\n<p>Use</p>\r\n\r\n<p>We use personal data to provide the services you request. To the extent we use your personal data to market to you, we will provide you the ability to opt-out of such uses. We use your personal data to assist sellers and business partners in handling and fulfilling orders; enhancing customer experience; to resolve disputes; troubleshoot problems; help promote a safe service; collect money; measure consumer interest in our products and services, inform you about online and offline offers, products, services, and updates; customise your experience; detect and protect us against error, fraud and other criminal activity; enforce our terms and conditions; conduct marketing research, analysis and surveys; and as otherwise described to you at the time of collection of information. We will ask for your permission to allow us access to your text messages (SMS), instant messages, contacts in your directory, camera, photo gallery, location and device information: (i) to send commercial communication regarding your orders or other products and services (ii) enhance your experience on the platform and provide you access to the products and services offered on the Platform by sellers, affiliates, partners or lending partners. You understand that your access to these products/services may be affected in the event permission is not provided to us. In our efforts to continually improve our product and service offerings, we collect and analyse demographic and profile data about users&#39; activity on our Platform. We identify and use your IP address to help diagnose problems with our server, and to administer our Platform. Your IP address is also used to help identify you and to gather broad demographic information. We will occasionally ask you to complete surveys conducted either by us or through a third- party market research agency. These surveys may ask you for personal data, contact information, gender, date of birth, demographic information (like pin code, age or income level) attributes such as your interests, household or lifestyle information, your purchasing behaviour or history preference and other such information that you may choose to provide. The survey may involve collection of voice data or video recordings. Participation in these surveys are purely voluntary in nature. We use this data to tailor your experience at our Platform, providing you with content that we think you might be interested in and to display content according to your preferences.</p>\r\n\r\n<p>Cookies</p>\r\n\r\n<p>We use data collection devices such as &quot;cookies&quot; on certain pages of the Platform to help analyse our web page flow, measure promotional effectiveness, and promote trust and safety. &quot;Cookies&quot; are small files placed on your hard drive that assist us in providing our services. Cookies do not contain any of your personal data. We offer certain features that are only available through the use of a &quot;cookie&quot;. We also use cookies to allow you to enter your password less frequently during a session. Cookies can also help us provide information that is targeted to your interests. Most cookies are &quot;session cookies,&quot; meaning that they are automatically deleted from your hard drive at the end of a session. You are always free to decline/delete our cookies if your browser permits, although in that case you may not be able to use certain features on the Platform and you may be required to re-enter your password more frequently during a session. Additionally, you may encounter &quot;cookies&quot; or other similar devices on certain pages of the Platform that are placed by third parties. We do not control the use of cookies by third parties. We use cookies from third-party partners such as Google Analytics for marketing and analytical purposes. Google Analytics helps us understand how our customers use the site. You can read more about how Google uses your Personal data&nbsp;<a href=\"https://www.google.com/intl/en/policies/privacy/\">here</a>. You can also opt-out of Google Analytics&nbsp;<a href=\"https://tools.google.com/dlpage/gaoptout\">here</a></p>\r\n\r\n<p>Sharing</p>\r\n\r\n<p>We may share your personal data internally within Flipkart Group entities, our other corporate entities, and affiliates to provide you access to the services and products offered by them, including Flipkart Advanz Private Limited, Scapic Innovations Private Limited, and other Flipkart affiliates, related companies and third parties, including Credit Bureaus and business partners (such as UPI platform), for purposes of providing products and services offered by them, such as, personal loans offered by Scapic Innovations Private Limited through its lending partners, insurance, the deferred payment options, Flipkart Pay Later offered by Flipkart Advanz Private Limited through its lending partners. These entities and affiliates may market to you as a result of such sharing unless you explicitly opt-out. We may disclose personal data to third parties such as prepaid payment instrument issuers, third-party reward programs and other payment opted by you. These disclosure may be required for us to provide you access to our services and products offered to you, to comply with our legal obligations, to enforce our user agreement, to facilitate our marketing and advertising activities, to prevent, detect, mitigate, and investigate fraudulent or illegal activities related to our services. We may disclose personal and sensitive personal data to government agencies or other authorised law enforcement agencies if required to do so by law or in the good faith belief that such disclosure is reasonably necessary to respond to subpoenas, court orders, or other legal process. We may disclose personal data to law enforcement offices, third party rights owners, or others in the good faith belief that such disclosure is reasonably necessary to: enforce our Terms or Privacy Policy; respond to claims that an advertisement, posting or other content violates the rights of a third party; or protect the rights, property or personal safety of our users or the general public. We and our affiliates will share / sell some or all of your personal data with another business entity should we (or our assets) plan to merge with, or be acquired by that business entity, or reorganisation, amalgamation, restructuring of business. Should such a transaction occur, that other business entity (or the new combined entity) will be required to follow this privacy policy with respect to your personal data.</p>\r\n\r\n<p>Links to Other Sites</p>\r\n\r\n<p>Our Platform links to other websites that may collect personal data about you. Myntra is not responsible for the privacy practices or the content of those linked websites.</p>\r\n\r\n<p>Security Precautions</p>\r\n\r\n<p>To protect your personal data from unauthorised access or disclosure, loss or misuse we adopt reasonable security practices and procedures, in line with international standards ISO/IEC 27001:2013 which is recognised as one of the highest information security standards. Whenever you access your account information, we offer the use of a secure server. The transmission of information is not completely secure for reasons beyond our control. We adopt industry standard security measures and keep updating our systems from time to time to protect your personal data against any hacking or virus dissemination. However, by using the Platform, the users accept the security implications of data transmission over the internet and the World Wide Web which cannot always be guaranteed as completely secure, and therefore, there would always remain certain inherent risks regarding use of the Platform. Users are responsible for ensuring the protection of login and password records for their account.</p>\r\n\r\n<p>Choice/Opt-Out</p>\r\n\r\n<p>We provide all users with the opportunity to opt-out of receiving non-essential (promotional, marketing-related) communications from us after setting up an account. If you do not wish to receive promotional communications from us, then please unsubscribe by clicking on the unsubscribe link in the email or visit our Help Center at&nbsp;<a href=\"https://www.myntra.com/contactus/generic?query=manage-your-account&amp;details=unsubscribe-from-promotions\">here</a>&nbsp;to unsubscribe/opt-out.</p>\r\n\r\n<p>Advertisements</p>\r\n\r\n<p>We use third-party advertising companies to serve ads when you visit our Platform. These companies may use information (not including your name, address, email address, or telephone number) about your visits to this Platform and other websites in order to provide advertisements about goods and services of interest to you. You have an option to opt-out from tracking of personalised advertising using the &ldquo;Opt out of Ads Personalization&rdquo; settings using your device&rsquo;s settings application. Myntra will have no access to your GAID once you select this feature.</p>\r\n\r\n<p>Use of Children Information</p>\r\n\r\n<p>Use of our Platform is available only to persons who can form a legally binding contract under the Indian Contract Act, 1872. We do not knowingly solicit or collect personal data from children under the age of 18 years. If you have shared any personal data of children under the age of 18 years, you represent that you have the authority to do so and permit us to use the information in accordance with this Privacy Policy.</p>\r\n\r\n<p>Data Deletion and Retention</p>\r\n\r\n<p>You have an option to delete your account by visiting your Profile and Settings on your mobile application, this action would result in you losing all information related to your account. You can also write to us at the contact information provided below to assist you with these requests. By deleting your account, you will not be able to access your order history, your preferences, details of any pending orders, exchanges, return or refunds, coupons or benefits from loyalty programs. We may in event of any pending grievance, claims, pending shipments or any other services we may refuse or delay deletion of the account. Please note, that deletion of account will not be retroactive and will be in accordance with the terms of this Privacy Policy, related Terms of Use and applicable laws. Once the account is deleted, you will lose access to the account., however you may To access the Platform again you would need to register as a new user on our Platform. We retain your personal data information for a period no longer than is required for the purpose for which it was collected or as required under any applicable law. However, we may retain data related to you if we believe it may be necessary to prevent fraud or future abuse; to enable Myntra to exercise its legal rights and/or defend against legal claims; or for other legitimate purposes. We may continue to retain your data in anonymised form for analytical and research purposes.</p>\r\n\r\n<p>Your Rights</p>\r\n\r\n<p>We take every reasonable step to ensure that your personal data we process is accurate and, where necessary, kept up to date. If any of your personal data we process is inaccurate (having regard to the purposes for which they are processed) will either be erased or rectified. You may access, rectify, and update your personal data directly through the functionalities provided on the Platform. You have an option to withdraw your consent that you have already provided by writing to us at the contact information provided below. Please mention &ldquo;for withdrawal of consent&rdquo; in the subject line of your communication. We may verify such requests before acting upon your request. Please note, however, that withdrawal of consent will not be retroactive and will be in accordance with the terms of this Privacy Policy, related Terms of Use and applicable laws. Your withdrawal of consent may hamper your access to the Platform or restrict certain provision of our services to you for which we consider that information to be necessary.</p>\r\n\r\n<p>Consent</p>\r\n\r\n<p>By visiting our Platform or by providing your information, you consent to the collection, use, storage, disclosure and otherwise processing of your information on the Platform in accordance with this Privacy Policy. If you disclose to us any personal data relating to other people, you represent that you have the authority to do so and permit us to use the information in accordance with this Privacy Policy. You, while providing your personal data over the Platform or any partner platforms or establishments, consent to us (including our other corporate entities, affiliates, lending partners, technology partners, marketing channels, business partners and other third parties) to contact you through SMS, instant messaging apps, call and/or e-mail for the purposes specified in this Privacy Policy. You have an option to withdraw your consent that you have already provided by writing to the Grievance Officer at the contact information provided below. Please mention &ldquo;Withdrawal of consent for processing personal data&rdquo; in your subject line of your communication. We will verify such requests before acting on our request. Please note, however, that withdrawal of consent will not be retroactive and will be in accordance with the terms of this Privacy Policy, related terms of use and applicable laws. In the event you withdraw consent given to us under this Privacy Policy, we reserve the right to restrict or deny the provision of our services for which we consider such information to be necessary.</p>\r\n\r\n<p>Changes to this Privacy Policy</p>\r\n\r\n<p>Please check our Privacy Policy periodically for changes. We may update this Privacy Policy to reflect changes to our information practices. We will alert you to significant changes by posting the date our Privacy Policy got last updated, placing a notice on our Platform, or by sending you an email when we are required to do so by applicable law.</p>\r\n\r\n<p>Grievance Officer</p>\r\n\r\n<p>Mr. Arshwaal Singh</p>\r\n\r\n<p>Designation: Manager - CC - Social Media</p>\r\n\r\n<p>Myntra Designs Pvt Ltd ,</p>\r\n\r\n<p>Alyssa, Begonia and Clover situated in Embassy Tech Village,</p>\r\n\r\n<p>Outer Ring Road, Devarabeesanahalli Village, Varthur Hobli, Bengaluru, Karnataka-: 560103, India</p>\r\n\r\n<p>Contact us: customergrievance@myntra.com</p>\r\n\r\n<p>Phone: 080-61561999</p>\r\n\r\n<p>Time: Monday - Friday(9:00 - 18:00)</p>\r\n\r\n<p>Customer Support: You can reach our customer support team to address any of your queries or complaints by clicking the link:&nbsp;<a href=\"https://www.myntra.com/contactus\">here</a></p>\r\n\r\n<p>Queries</p>\r\n\r\n<p>If you have a query, concern, or complaint in relation to collection or usage of your personal data under this Privacy Policy, please contact us at the contact information provided above.</p>\r\n', '2024-07-17 13:09:39');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(20) NOT NULL,
  `image` varchar(225) NOT NULL,
  `p_name` varchar(225) NOT NULL,
  `description` text NOT NULL,
  `price` varchar(225) NOT NULL,
  `brand_id` int(20) NOT NULL,
  `category_id` int(11) NOT NULL,
  `stock_level` int(20) DEFAULT NULL,
  `sale_price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `image`, `p_name`, `description`, `price`, `brand_id`, `category_id`, `stock_level`, `sale_price`) VALUES
(29, 'tomato.jpeg', 'Tomato', 'Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt', '50', 1, 6, 10, 47.00),
(30, 'carrot.jpeg', 'Carrot', 'Lorem ipsum dolor sit amet consectetur adipisicing eli\'t sed do eiusmod te incididunt\r\nLorem ipsum dolor sit amet consectetur adipisicing eli\'t sed do eiusmod te incididunt		', '70', 1, 6, 1, NULL),
(31, 'image5.jpeg', 'lichi', 'these Litchis are produced without the use of pesticides, chemical fertilizers, radiation, or chemical additives.	', '200', 1, 7, 4, NULL),
(32, 'images4.jpeg', 'strawberry', 'Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt', '150', 3, 7, 10, NULL),
(33, 'images3.jpeg', 'Mango', 'Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt', '99', 2, 7, 7, NULL),
(34, 'wheat.jpeg', 'Wheat', 'Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt', '400', 1, 8, 0, 380.00),
(35, 'maize.jpeg', 'Maize', 'Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt', '100', 2, 8, 20, NULL),
(36, 'cheese.webp', 'Cheese', 'Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt', '149', 3, 9, 24, 139.00),
(38, 'cheese.webp', 'Cheese', 'Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt', '299', 1, 9, 15, NULL),
(39, 'broccoli.jpg', 'Broccoli', 'Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt		', '449', 2, 6, 17, 429.00),
(40, 'carrot.jpeg', 'Carrot', 'Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt		', '99', 3, 6, 19, NULL),
(41, 'tomato.jpeg', 'Tomato', 'Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt		', '49', 1, 6, 20, NULL),
(42, 'images4.jpeg', 'strawberry', 'Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt		', '600', 2, 7, 20, NULL),
(43, 'cherry.jpg', 'lichiiiiii', 'bfbx', '45', 3, 7, 33, 63.00),
(44, 'maize.jpeg', 'Maize', 'Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt		', '550', 1, 8, 20, 500.00),
(45, 'wheat.jpeg', 'Wheat', 'Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt		', '300', 2, 8, 19, NULL),
(46, 'millet.jpeg', 'millet', 'Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt', '500', 3, 8, 17, 489.00),
(47, 'brown rice.jpeg', 'Brown Rice', 'these brown Rices are produced without the use of pesticides, chemical fertilizers, radiation, or chemical additives.		', '200 ', 1, 8, 18, NULL),
(48, 'best-product-6.jpg', 'Apple', 'these apples are produced without the use of pesticides, chemical fertilizers, radiation, or chemical additives.		', '99', 2, 7, 20, NULL),
(49, 'best-product-5.jpg', 'Grapes', 'these grapes are produced without the use of pesticides, chemical fertilizers, radiation, or chemical additives.		', '149', 3, 7, 13, NULL),
(50, 'cherry.jpg', 'Cherry', 'these cherries are produced without the use of pesticides, chemical fertilizers, radiation, or chemical additives.		', '249', 1, 7, 17, 230.00),
(51, 'best-product-6.jpg', 'Apple', 'these Litchis are produced without the use of pesticides, chemical fertilizers, radiation, or chemical additives.		', '99', 1, 7, 20, NULL),
(52, 'cherry.jpg', 'Cherry', 'these cherries are produced without the use of pesticides, chemical fertilizers, radiation, or chemical additives.		', '200', 2, 7, 16, NULL),
(53, 'ice cream.jpeg', 'Ice cream', 'This ice cream is produced by pure milk and organic fruits, this is good for health and made with sugar free', '100', 3, 9, 14, NULL),
(56, 'broccoli.jpg', 'Broccoli', 'these Litchis are produced without the use of pesticides, chemical fertilizers, radiation, or chemical additives.', '200', 1, 6, 19, NULL),
(57, 'maize.jpeg', 'Maize', 'this product is produced without the use of pesticides, chemical fertilizers, radiation, or chemical additives.', '200', 1, 8, 18, 179.00),
(58, 'ice cream.jpeg', 'Ice Cream', 'these Litchis are produced without the use of pesticides, chemical fertilizers, radiation, or chemical additives.', '200', 2, 9, 19, 185.00),
(59, 'cheese.webp', 'Cheese', 'these Litchis are produced without the use of pesticides, chemical fertilizers, radiation, or chemical additives.', '100', 3, 9, 19, NULL),
(60, 'ice cream.jpeg', 'Ice Cream', 'these Litchis are produced without the use of pesticides, chemical fertilizers, radiation, or chemical additives.', '400', 1, 9, 19, 369.00);

-- --------------------------------------------------------

--
-- Table structure for table `return_policy`
--

CREATE TABLE `return_policy` (
  `id` int(20) NOT NULL,
  `content` text NOT NULL,
  `date` int(225) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `return_policy`
--

INSERT INTO `return_policy` (`id`, `content`, `date`) VALUES
(1, '<p>Returns is a scheme provided by respective sellers directly under this policy in terms of which the option of exchange, replacement and/ or refund is offered by the respective sellers to you. All products listed under a particular category may not have the same returns policy. For all products, the returns/replacement policy provided on the product page shall prevail over the general returns policy. Do refer the respective item&#39;s applicable return/replacement policy on the product page for any exceptions to this returns policy and the table below</p>\r\n\r\n<p>The return policy is divided into three parts; Do read all sections carefully to understand the conditions and cases under which returns will be accepted.</p>\r\n', 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `review_table`
--

CREATE TABLE `review_table` (
  `id` int(20) NOT NULL,
  `product_id` int(20) NOT NULL,
  `userName` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `review` text NOT NULL,
  `rating` int(225) NOT NULL,
  `date` varchar(255) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review_table`
--

INSERT INTO `review_table` (`id`, `product_id`, `userName`, `email`, `review`, `rating`, `date`) VALUES
(1, 29, 'kanishka kumawat', 'kanishkakumawat1002@gmail.com', 'The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic words etc. Susp endisse ultricies nisi vel quam suscipit\r\n\r\n', 4, '2024-07-05 23:37:30'),
(2, 30, 'kanishka kumawat', 'kanishkakumawat1002@gmail.com', 'The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic words etc. Susp endisse ultricies nisi vel quam suscipit\r\n\r\n', 3, '2024-07-05 23:48:21'),
(4, 53, 'Kanishka Kumawat', 'kanishka.kumawat@s.amity.edu', 'This ice cream is produced by pure milk and organic fruits, this is good for health and made with sugar free', 4, '2024-07-06 16:16:48'),
(5, 33, 'kanishka kumawat', 'kanishkakumawat1002@gmail.com', 'Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt and this is Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt', 5, '2024-07-07 18:40:56'),
(6, 29, 'kanishka kumawat', 'kanishkakumawat1002@gmail.com', 'Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt\r\n\r\n', 3, '2024-07-08 10:07:14'),
(8, 33, 'Kanishka Kumawat', 'admin24@gmail.com', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptatem dolorum, sed natus obcaecati assumenda repellendus dolorem libero accusamus nihil unde ducimus?', 4, '2024-07-22 14:52:46');

-- --------------------------------------------------------

--
-- Table structure for table `social_media`
--

CREATE TABLE `social_media` (
  `id` int(11) NOT NULL,
  `platform` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `icon` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `social_media`
--

INSERT INTO `social_media` (`id`, `platform`, `url`, `icon`) VALUES
(1, 'youtube', 'https://www.youtube.com', 'fab fa-youtube'),
(2, 'Facebook', 'https://www.facebook.com', 'fab fa-facebook-f'),
(3, 'twitter', 'https://www.twitter.com', 'fab fa-twitter'),
(4, 'linked In', 'https://www.linkedin.com', 'fab fa-linkedin-in');

-- --------------------------------------------------------

--
-- Table structure for table `terms_and_condition`
--

CREATE TABLE `terms_and_condition` (
  `id` int(20) NOT NULL,
  `content` text NOT NULL,
  `date` int(225) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `terms_and_condition`
--

INSERT INTO `terms_and_condition` (`id`, `content`, `date`) VALUES
(1, '<p><strong>This document is an electronic record in terms of Information Technology&nbsp;Act, 2000 and rules there under as applicable and the amended provisions&nbsp;pertaining to electronic records in various statutes as amended by the&nbsp;Information Technology Act, 2000. This electronic record is generated&nbsp;by a computer system and does not require any physical or digital&nbsp;signatures.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>This document is published in accordance with the provisions of Rule 3&nbsp;(1) of the Information Technology (Intermediaries guidelines) Rules,&nbsp;2011 that require publishing the rules and regulations, privacy policy and&nbsp;Terms of Use for access or usage of www.flipkart.com website.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The domain name www.flipkart.com (hereinafter referred to as &quot;Website&quot;) is&nbsp;owned by Flipkart Internet Private Limited a company incorporated under the&nbsp;Companies Act, 1956 with its registered office at Vaishnavi Summit, Ground&nbsp;Floor, 7th Main, 80 feet Road, 3rd Block, Koramangala Industrial Layout, Next&nbsp;to Wipro office, Corporation Ward No. 68, Koramangala, Bangalore - 560 034,&nbsp;Karnataka, India (hereinafter referred to as &quot;Flipkart&quot;).</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Your use of the Website and services and tools are governed by the following&nbsp;terms and conditions (<strong>&quot;Terms of Use&quot;</strong>) as applicable to the Website including&nbsp;the applicable policies which are incorporated herein by way of reference. If You&nbsp;transact on the Website, You shall be subject to the policies that are applicable&nbsp;to the Website for such transaction. By mere use of the Website, You shall be&nbsp;contracting with Flipkart Internet Private Limited and these terms and conditions&nbsp;including the policies constitute Your binding obligations, with Flipkart.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>For the purpose of these Terms of Use, wherever the context so requires<strong>&nbsp;&quot;You&quot;</strong>&nbsp;or&nbsp;<strong>&quot;User&quot;</strong>&nbsp;shall mean any natural or legal person who has agreed to become a buyer&nbsp;on the Website by providing Registration Data while registering on the Website as&nbsp;Registered User using the computer systems. Flipkart allows the User to surf the&nbsp;Website or making purchases without registering on the Website. The term&nbsp;<strong>&quot;We&quot;</strong>,<strong>&nbsp;</strong><strong>&quot;Us&quot;</strong>,<strong>&nbsp;&quot;Our&quot;</strong>&nbsp;shall mean Flipkart Internet Private Limited.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>When You use any of the services provided by Us through the Website, including&nbsp;but not limited to, (e.g. Product Reviews, Seller Reviews), You will be subject to&nbsp;the rules, guidelines, policies, terms, and conditions applicable to such service,&nbsp;and they shall be deemed to be incorporated into this Terms of Use and shall be&nbsp;considered as part and parcel of this Terms of Use. We reserve the right, at Our&nbsp;sole discretion, to change, modify, add or remove portions of these Terms of Use,&nbsp;at any time without any prior written notice to You. It is Your responsibility to&nbsp;review these Terms of Use periodically for updates / changes. Your continued use&nbsp;of the Website following the posting of changes will mean that You accept and&nbsp;agree to the revisions. As long as You comply with these Terms of Use, We grant&nbsp;You a personal, non-exclusive, non-transferable, limited privilege to enter and&nbsp;use the Website.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>ACCESSING, BROWSING OR OTHERWISE USING THE SITE INDICATES&nbsp;YOUR AGREEMENT TO ALL THE TERMS AND CONDITIONS UNDER THESE&nbsp;TERMS OF USE, SO PLEASE READ THE TERMS OF USE CAREFULLY BEFORE&nbsp;</strong><strong>PROCEEDING.</strong>&nbsp;By impliedly or expressly accepting these Terms of Use, You also&nbsp;accept and agree to be bound by Flipkart Policies ((including but not limited to&nbsp;Privacy Policy available on /s/privacypolicy) as amended&nbsp;from time to time.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><br />\r\n<a name=\"membership-eligibility \"></a></p>\r\n\r\n<h2>Membership Eligibility</h2>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Use of the Website is available only to persons who can form legally binding&nbsp;contracts under Indian Contract Act, 1872. Persons who are &quot;incompetent to&nbsp;contract&quot; within the meaning of the Indian Contract Act, 1872 including minors,&nbsp;un-discharged insolvents etc. are not eligible to use the Website. If you are&nbsp;a minor i.e. under the age of 18 years, you shall not register as a User of the&nbsp;Flipkart website and shall not transact on or use the website. As a minor if you&nbsp;wish to use or transact on website, such use or transaction may be made by your&nbsp;legal guardian or parents on the Website. Flipkart reserves the right to terminate&nbsp;your membership and / or refuse to provide you with access to the Website if it is&nbsp;brought to Flipkart&#39;s notice or if it is discovered that you are under the age of 18&nbsp;years.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ul>\r\n</ul>\r\n\r\n<p><br />\r\n<a name=\"your-account-and-registration-obligations \"></a></p>\r\n\r\n<h2>Your Account and Registration Obligations</h2>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>If You use the Website, You shall be responsible for maintaining the&nbsp;confidentiality of your Display Name and Password and You shall be responsible&nbsp;for all activities that occur under your Display Name and Password. You agree&nbsp;that if You provide any information that is untrue, inaccurate, not current or&nbsp;incomplete or We have reasonable grounds to suspect that such information is&nbsp;untrue, inaccurate, not current or incomplete, or not in accordance with the this&nbsp;Terms of Use, We shall have the right to indefinitely suspend or terminate or&nbsp;block access of your membership on the Website and refuse to provide You with&nbsp;access to the Website.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><br />\r\n<a name=\"communications \"></a></p>\r\n\r\n<h2>Communications</h2>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>When You use the Website or send emails or other data, information or&nbsp;communication to us, You agree and understand that You are communicating&nbsp;with Us through electronic records and You consent to receive communications&nbsp;via electronic records from Us periodically and as and when required. We may&nbsp;communicate with you by email or by such other mode of communication,&nbsp;electronic or otherwise.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><br />\r\n<a name=\"platform-for-transaction-and-communication \"></a></p>\r\n\r\n<h2>Platform for Transaction and Communication</h2>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The Website is a platform that Users utilize to meet and interact with one another&nbsp;for their transactions. Flipkart is not and cannot be a party to or control in any&nbsp;manner any transaction between the Website&#39;s Users.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Henceforward:</p>\r\n\r\n<p>1. All commercial/contractual terms are offered by and agreed to between Buyers&nbsp;and Sellers alone. The commercial/contractual terms include without limitation&nbsp;price, shipping costs, payment methods, payment terms, date, period and mode&nbsp;of delivery, warranties related to products and services and after sales services&nbsp;related to products and services. Flipkart does not have any control or does not&nbsp;determine or advise or in any way involve itself in the offering or acceptance of&nbsp;such commercial/contractual terms between the Buyers and Sellers.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>2. Flipkart does not make any representation or Warranty as to specifics (such&nbsp;as quality, value, salability, etc) of the products or services proposed to be sold&nbsp;or offered to be sold or purchased on the Website. Flipkart does not implicitly or&nbsp;explicitly support or endorse the sale or purchase of any products or services on&nbsp;the Website. Flipkart accepts no liability for any errors or omissions, whether on&nbsp;behalf of itself or third parties.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>3. Flipkart is not responsible for any non-performance or breach of any contract&nbsp;entered into between Buyers and Sellers. Flipkart cannot and does not guarantee&nbsp;that the concerned Buyers and/or Sellers will perform any transaction concluded&nbsp;on the Website. Flipkart shall not and is not required to mediate or resolve any&nbsp;dispute or disagreement between Buyers and Sellers.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>4. Flipkart does not make any representation or warranty as to the item-specifics&nbsp;(such as legal title, creditworthiness, identity, etc) of any of its Users. You are&nbsp;advised to independently verify the bona fides of any particular User that You&nbsp;choose to deal with on the Website and use Your best judgment in that behalf.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>5. Flipkart does not at any point of time during any transaction between Buyer&nbsp;and Seller on the Website come into or take possession of any of the products or&nbsp;services offered by Seller nor does it at any point gain title to or have any rights&nbsp;or claims over the products or services offered by Seller to Buyer.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>6. At no time shall Flipkart hold any right, title or interest over the products nor&nbsp;shall Flipkart have any obligations or liabilities in respect of such contract entered&nbsp;into between Buyers and Sellers. Flipkart is not responsible for unsatisfactory or&nbsp;delayed performance of services or damages or delays as a result of products&nbsp;which are out of stock, unavailable or back ordered.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>7. The Website is only a platform that can be utilized by Users to reach a larger&nbsp;base to buy and sell products or services. Flipkart is only providing a platform for&nbsp;communication and it is agreed that the contract for sale of any of the products&nbsp;or services shall be a strictly bipartite contract between the Seller and the Buyer.</p>\r\n\r\n<p>At no time shall Flipkart hold any any right, title or interest over the products&nbsp;nor shall Flipkart have any obligations or liabilities in respect of such contract.</p>\r\n\r\n<p>Flipkart is not responsible for unsatisfactory or delayed performance of services&nbsp;or damages or delays as a result of products which are out of stock, unavailable&nbsp;or back ordered.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>8. You shall independently agree upon the manner and terms and conditions of&nbsp;delivery, payment, insurance etc. with the seller(s) that You transact with.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Disclaimer:</strong>&nbsp;Pricing on any product(s) as is reflected on the Website may due&nbsp;to some technical issue, typographical error or product information published by&nbsp;seller may be incorrectly reflected and in such an event seller may cancel such&nbsp;your order(s).</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>9. You release and indemnify Flipkart and/or any of its officers and&nbsp;representatives from any cost, damage, liability or other consequence of any of&nbsp;the actions of the Users of the Website and specifically waive any claims that you&nbsp;may have in this behalf under any applicable law. Notwithstanding its reasonable&nbsp;efforts in that behalf, Flipkart cannot take responsibility or control the information&nbsp;provided by other Users which is made available on the Website. You may find&nbsp;other User&#39;s information to be offensive, harmful, inconsistent, inaccurate, or&nbsp;deceptive. Please use caution and practice safe trading when using the Website.</p>\r\n\r\n<p>Please note that there could be risks in dealing with underage persons or people&nbsp;acting under false pretence.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><br />\r\n<a name=\"charges \"></a></p>\r\n\r\n<h2>Charges</h2>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Membership on the Website is free for buyers. Flipkart does not charge any fee for browsing and buying on the Website. Flipkart reserves the right to change its Fee Policy from time to time. In particular, Flipkart may at its sole discretion introduce new services and modify some or all of the existing services offered on the Website. In such an event Flipkart reserves the right to introduce fees for the new services offered or amend/introduce fees for existing services, as the case may be. Changes to the Fee Policy shall be posted on the Website and such changes shall automatically become effective immediately after they are posted on the Website. Unless otherwise stated, all fees shall be quoted in Indian Rupees. You shall be solely responsible for compliance of all applicable laws including those in India for making payments to Flipkart Internet Private Limited.</p>\r\n\r\n<p><br />\r\n<a name=\"use-of-the-website \"></a></p>\r\n\r\n<h2>Use of the Website</h2>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>You agree, undertake and confirm that Your use of Website shall be strictly&nbsp;governed by the following binding principles:</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>1. You shall not host, display, upload, modify, publish, transmit, update or share&nbsp;any information which:</p>\r\n\r\n<p>(a) belongs to another person and to which You does not have any right to;</p>\r\n\r\n<p>(b) is grossly harmful, harassing, blasphemous, defamatory, obscene,&nbsp;pornographic, paedophilic, libellous, invasive of another&#39;s privacy, hateful, or&nbsp;racially, ethnically objectionable, disparaging, relating or encouraging money&nbsp;laundering or gambling, or otherwise unlawful in any manner whatever;&nbsp;or unlawfully threatening or unlawfully harassing including but not limited&nbsp;to &quot;indecent representation of women&quot; within the meaning of the Indecent&nbsp;Representation of Women (Prohibition) Act, 1986;</p>\r\n\r\n<p>(c) is misleading in any way;</p>\r\n\r\n<p>(d) is patently offensive to the online community, such as sexually explicit&nbsp;content, or content that promotes obscenity, paedophilia, racism, bigotry, hatred&nbsp;or physical harm of any kind against any group or individual;</p>\r\n\r\n<p>(e) harasses or advocates harassment of another person;</p>\r\n\r\n<p>(f) involves the transmission of &quot;junk mail&quot;, &quot;chain letters&quot;, or unsolicited mass&nbsp;mailing or &quot;spamming&quot;;</p>\r\n\r\n<p>(g) promotes illegal activities or conduct that is abusive, threatening, obscene,&nbsp;defamatory or libellous;</p>\r\n\r\n<p>(h) infringes upon or violates any third party&#39;s rights [including, but not limited&nbsp;to, intellectual property rights, rights of privacy (including without limitation&nbsp;unauthorized disclosure of a person&#39;s name, email address, physical address or&nbsp;phone number) or rights of publicity];</p>\r\n\r\n<p>(i) promotes an illegal or unauthorized copy of another person&#39;s copyrighted work&nbsp;(see &quot;Copyright complaint&quot; below for instructions on how to lodge a complaint&nbsp;about uploaded copyrighted material), such as providing pirated computer&nbsp;programs or links to them, providing information to circumvent manufacture-installed copy-protect devices, or providing pirated music or links to pirated music&nbsp;files;</p>\r\n\r\n<p>(j) contains restricted or password-only access pages, or hidden pages or images&nbsp;(those not linked to or from another accessible page);</p>\r\n\r\n<p>(k) provides material that exploits people in a sexual, violent or otherwise&nbsp;inappropriate manner or solicits personal information from anyone;</p>\r\n\r\n<p>(l) provides instructional information about illegal activities such as making or&nbsp;buying illegal weapons, violating someone&#39;s privacy, or providing or creating&nbsp;computer viruses;</p>\r\n\r\n<p>(m) contains video, photographs, or images of another person (with a minor or&nbsp;an adult).</p>\r\n\r\n<p>(n) tries to gain unauthorized access or exceeds the scope of authorized access&nbsp;to the Website or to profiles, blogs, communities, account information, bulletins,&nbsp;friend request, or other areas of the Website or solicits passwords or personal&nbsp;identifying information for commercial or unlawful purposes from other users;</p>\r\n\r\n<p>(o) engages in commercial activities and/or sales without Our prior written&nbsp;consent such as contests, sweepstakes, barter, advertising and pyramid schemes,&nbsp;or the buying or selling of &quot;virtual&quot; products related to the Website. Throughout&nbsp;this Terms of Use, Flipkart&#39;s prior written consent means a communication&nbsp;coming from Flipkart&#39;s Legal Department, specifically in response to Your&nbsp;request, and specifically addressing the activity or conduct for which You seek&nbsp;authorization;</p>\r\n\r\n<p>(p) solicits gambling or engages in any gambling activity which We, in Our sole&nbsp;discretion, believes is or could be construed as being illegal;</p>\r\n\r\n<p>(q) interferes with another USER&#39;s use and enjoyment of the Website or any&nbsp;other individual&#39;s User and enjoyment of similar services;</p>\r\n\r\n<p>(r) refers to any website or URL that, in Our sole discretion, contains material&nbsp;that is inappropriate for the Website or any other website, contains content that&nbsp;would be prohibited or violates the letter or spirit of these Terms of Use.</p>\r\n\r\n<p>(s) harm minors in any way;</p>\r\n\r\n<p>(t) infringes any patent, trademark, copyright or other proprietary rights or third&nbsp;party&#39;s trade secrets or rights of publicity or privacy or shall not be fraudulent or&nbsp;involve the sale of counterfeit or stolen products;</p>\r\n\r\n<p>(u) violates any law for the time being in force;</p>\r\n\r\n<p>(v) deceives or misleads the addressee/ users about the origin of such messages&nbsp;or communicates any information which is grossly offensive or menacing in&nbsp;nature;</p>\r\n\r\n<p>(w) impersonate another person;</p>\r\n\r\n<p>(x) contains software viruses or any other computer code, files or programs&nbsp;designed to interrupt, destroy or limit the functionality of any computer resource;&nbsp;or contains any trojan horses, worms, time bombs, cancelbots, easter eggs or&nbsp;other computer programming routines that may damage, detrimentally interfere&nbsp;with, diminish value of, surreptitiously intercept or expropriate any system, data&nbsp;or personal information;</p>\r\n\r\n<p>(y) threatens the unity, integrity, defence, security or sovereignty of India,&nbsp;friendly relations with foreign states, or public order or causes incitement to the&nbsp;commission of any cognizable offence or prevents investigation of any offence or&nbsp;is insulting any other nation.</p>\r\n\r\n<p>(z) shall not be false, inaccurate or misleading;</p>\r\n\r\n<p>(aa) shall not, directly or indirectly, offer, attempt to offer, trade or attempt to&nbsp;trade in any item, the dealing of which is prohibited or restricted in any manner&nbsp;under the provisions of any applicable law, rule, regulation or guideline for the&nbsp;time being in force.</p>\r\n\r\n<p>(ab) shall not create liability for Us or cause Us to lose (in whole or in part) the&nbsp;services of Our internet service provider (&quot;ISPs&quot;) or other suppliers;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>2. You shall not use any &quot;deep-link&quot;, &quot;page-scrape&quot;, &quot;robot&quot;, &quot;spider&quot; or other&nbsp;automatic device, program, algorithm or methodology, or any similar or&nbsp;equivalent manual process, to access, acquire, copy or monitor any portion of the&nbsp;Website or any Content, or in any way reproduce or circumvent the navigational&nbsp;structure or presentation of the Website or any Content, to obtain or attempt to&nbsp;obtain any materials, documents or information through any means not purposely&nbsp;made available through the Website. We reserve Our right to bar any such&nbsp;activity.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>3. You shall not attempt to gain unauthorized access to any portion or feature of&nbsp;the Website, or any other systems or networks connected to the Website or to&nbsp;any server, computer, network, or to any of the services offered on or through&nbsp;the Website, by hacking, password &quot;mining&quot; or any other illegitimate means.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>4. You shall not probe, scan or test the vulnerability of the Website or any&nbsp;network connected to the Website nor breach the security or authentication&nbsp;measures on the Website or any network connected to the Website. You may&nbsp;not reverse look-up, trace or seek to trace any information on any other User&nbsp;of or visitor to Website, or any other customer, including any account on the&nbsp;Website not owned by You, to its source, or exploit the Website or any service&nbsp;or information made available or offered by or through the Website, in any&nbsp;way where the purpose is to reveal any information, including but not limited&nbsp;to personal identification or information, other than Your own information, as&nbsp;provided for by the Website.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>5. You shall not make any negative, denigrating or defamatory statement(s) or&nbsp;comment(s) about Us or the brand name or domain name used by Us including&nbsp;the terms Flipkart, Flyte, Digiflip, Flipcart, flipkart.com, or otherwise engage in&nbsp;any conduct or action that might tarnish the image or reputation, of Flipkart or&nbsp;sellers on platform or otherwise tarnish or dilute any Flipkart&#39;s trade or service&nbsp;marks, trade name and/or goodwill associated with such trade or service marks,&nbsp;trade name as may be owned or used by us. You agree that You will not take&nbsp;any action that imposes an unreasonable or disproportionately large load on the&nbsp;infrastructure of the Website or Flipkart&#39;s systems or networks, or any systems or&nbsp;networks connected to Flipkart.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>6. You agree not to use any device, software or routine to interfere or attempt&nbsp;to interfere with the proper working of the Website or any transaction being&nbsp;conducted on the Website, or with any other person&#39;s use of the Website.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>7. You may not forge headers or otherwise manipulate identifiers in order to&nbsp;disguise the origin of any message or transmittal You send to Us on or through&nbsp;the Website or any service offered on or through the Website. You may not&nbsp;pretend that You are, or that You represent, someone else, or impersonate any&nbsp;other individual or entity.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>8. You may not use the Website or any content for any purpose that is unlawful&nbsp;or prohibited by these Terms of Use, or to solicit the performance of any illegal&nbsp;activity or other activity which infringes the rights of Flipkart and / or others.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>9. You shall at all times ensure full compliance with the applicable provisions&nbsp;of the Information Technology Act, 2000 and rules thereunder as applicable&nbsp;and as amended from time to time and also all applicable Domestic laws, rules&nbsp;and regulations (including the provisions of any applicable Exchange Control&nbsp;Laws or Regulations in Force) and International Laws, Foreign Exchange Laws,&nbsp;Statutes, Ordinances and Regulations (including, but not limited to Sales Tax/VAT, Income Tax, Octroi, Service Tax, Central Excise, Custom Duty, Local Levies)&nbsp;regarding Your use of Our service and Your listing, purchase, solicitation of&nbsp;offers to purchase, and sale of products or services. You shall not engage in any&nbsp;transaction in an item or service, which is prohibited by the provisions of any&nbsp;applicable law including exchange control laws or regulations for the time being in&nbsp;force.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>10. Solely to enable Us to use the information You supply Us with, so that we are&nbsp;not violating any rights You might have in Your Information, You agree to grant&nbsp;Us a non-exclusive, worldwide, perpetual, irrevocable, royalty-free, sub-licensable&nbsp;(through multiple tiers) right to exercise the copyright, publicity, database rights&nbsp;or any other rights You have in Your Information, in any media now known or&nbsp;not currently known, with respect to Your Information. We will only use Your&nbsp;information in accordance with the Terms of Use and Privacy Policy applicable to&nbsp;use of the Website.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>11. From time to time, You shall be responsible for providing information relating&nbsp;to the products or services proposed to be sold by You. In this connection, You&nbsp;undertake that all such information shall be accurate in all respects. You shall not&nbsp;exaggerate or over emphasize the attributes of such products or services so as to&nbsp;mislead other Users in any manner.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>12. You shall not engage in advertising to, or solicitation of, other Users of the&nbsp;Website to buy or sell any products or services, including, but not limited to,&nbsp;products or services related to that being displayed on the Website or related to&nbsp;us. You may not transmit any chain letters or unsolicited commercial or junk&nbsp;email to other Users via the Website. It shall be a violation of these Terms of Use&nbsp;to use any information obtained from the Website in order to harass, abuse, or&nbsp;harm another person, or in order to contact, advertise to, solicit, or sell to&nbsp;another person other than Us without Our prior explicit consent. In order to&nbsp;protect Our Users from such advertising or solicitation, We reserve the right to&nbsp;restrict the number of messages or emails which a user may send to other Users&nbsp;in any 24-hour period which We deems appropriate in its sole discretion. You&nbsp;understand that We have the right at all times to disclose any information&nbsp;(including the identity of the persons providing information or materials on the&nbsp;Website) as necessary to satisfy any law, regulation or valid governmental&nbsp;request. This may include, without limitation, disclosure of the information in&nbsp;connection with investigation of alleged illegal activity or solicitation of illegal&nbsp;activity or in response to a lawful court order or subpoena. In addition, We can&nbsp;(and You hereby expressly authorize Us to) disclose any information about You to&nbsp;law enforcement or other government officials, as we, in Our sole discretion,&nbsp;believe necessary or appropriate in connection with the investigation and/or&nbsp;resolution of possible crimes, especially those that may involve personal injury.</p>\r\n\r\n<p>We reserve the right, but has no obligation, to monitor the materials posted on&nbsp;the Website. Flipkart shall have the right to remove or edit any content that in its&nbsp;sole discretion violates, or is alleged to violate, any applicable law or either the&nbsp;spirit or letter of these Terms of Use. Notwithstanding this right, YOU REMAIN&nbsp;SOLELY RESPONSIBLE FOR THE CONTENT OF THE MATERIALS YOU POST ON&nbsp;THE WEBSITE AND IN YOUR PRIVATE MESSAGES. Please be advised that such&nbsp;Content posted does not necessarily reflect Flipkart views. In no event shall&nbsp;Flipkart assume or have any responsibility or liability for any Content posted&nbsp;or for any claims, damages or losses resulting from use of Content and/or&nbsp;appearance of Content on the Website. You hereby represent and warrant that&nbsp;You have all necessary rights in and to all Content which You provide and all&nbsp;information it contains and that such Content shall not infringe any proprietary&nbsp;or other rights of third parties or contain any libellous, tortious, or otherwise&nbsp;unlawful information.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>13. Your correspondence or business dealings with, or participation in promotions&nbsp;of, advertisers found on or through the Website, including payment and delivery&nbsp;of related products or services, and any other terms, conditions, warranties or&nbsp;representations associated with such dealings, are solely between You and such&nbsp;advertiser. We shall not be responsible or liable for any loss or damage of any&nbsp;sort incurred as the result of any such dealings or as the result of the presence of&nbsp;such advertisers on the Website.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>14. It is possible that other users (including unauthorized users or &quot;hackers&quot;)&nbsp;may post or transmit offensive or obscene materials on the Website and that&nbsp;You may be involuntarily exposed to such offensive and obscene materials. It&nbsp;also is possible for others to obtain personal information about You due to your&nbsp;use of the Website, and that the recipient may use such information to harass&nbsp;or injure You. We does not approve of such unauthorized uses, but by using the&nbsp;Website You acknowledge and agree that We are not responsible for the use of&nbsp;any personal information that You publicly disclose or share with others on the&nbsp;Website. Please carefully select the type of information that You publicly disclose&nbsp;or share with others on the Website.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>15. Flipkart shall have all the rights to take necessary action and claim damages&nbsp;that may occur due to your involvement/participation in any way on your own&nbsp;or through group/s of people, intentionally or unintentionally in DoS/DDoS&nbsp;(Distributed Denial of Services).</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><br />\r\n<a name=\"contents-posted-on-site \"></a></p>\r\n\r\n<h2>Contents Posted on Site</h2>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>All text, graphics, user interfaces, visual interfaces, photographs, trademarks,&nbsp;logos, sounds, music and artwork (collectively, &quot;Content&quot;), is a third party&nbsp;user generated content and Flipkart has no control over such third party user&nbsp;generated content as Flipkart is merely an intermediary for the purposes of this&nbsp;Terms of Use.</p>\r\n\r\n<p>Except as expressly provided in these Terms of Use, no part of the Website&nbsp;and no Content may be copied, reproduced, republished, uploaded, posted,&nbsp;publicly displayed, encoded, translated, transmitted or distributed in any way&nbsp;(including &quot;mirroring&quot;) to any other computer, server, Website or other medium&nbsp;for publication or distribution or for any commercial enterprise, without Flipkart&#39;s&nbsp;express prior written consent.</p>\r\n\r\n<p>You may use information on the products and services purposely made available&nbsp;on the Website for downloading, provided that You (1) do not remove any&nbsp;proprietary notice language in all copies of such documents, (2) use such&nbsp;information only for your personal, non-commercial informational purpose and&nbsp;do not copy or post such information on any networked computer or broadcast it&nbsp;in any media, (3) make no modifications to any such information, and (4) do not&nbsp;make any additional representations or warranties relating to such documents.</p>\r\n\r\n<p>You shall be responsible for any notes, messages, emails, billboard postings,&nbsp;photos, drawings, profiles, opinions, ideas, images, videos, audio files&nbsp;or other materials or information posted or transmitted to the Website&nbsp;(collectively, &quot;Content&quot;). Such Content will become Our property and You grant&nbsp;Us the worldwide, perpetual and transferable rights in such Content. We shall&nbsp;be entitled to, consistent with Our Privacy Policy as adopted in accordance&nbsp;with applicable law, use the Content or any of its elements for any type of use&nbsp;forever, including but not limited to promotional and advertising purposes and&nbsp;in any media whether now known or hereafter devised, including the creation of&nbsp;derivative works that may include the Content You provide. You agree that any&nbsp;Content You post may be used by us, consistent with Our Privacy Policy and Rules&nbsp;of Conduct on Site as mentioned herein, and You are not entitled to any payment&nbsp;or other compensation for such use.</p>\r\n\r\n<p>&nbsp;</p>\r\n', 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `terms_of_use`
--

CREATE TABLE `terms_of_use` (
  `id` int(20) NOT NULL,
  `content` text NOT NULL,
  `date` varchar(225) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `terms_of_use`
--

INSERT INTO `terms_of_use` (`id`, `content`, `date`) VALUES
(1, '<h3>Introduction</h3>\r\n\r\n<p>The introductory clause of your terms of use agreement sets the expectations for your users by defining what the agreement is for and who it covers.</p>\r\n\r\n<p>In the sample terms of use introductio', '2024-07-22 12:14:58'),
(3, '<p>A Terms of Use agreement is a legal agreement that lets you protect your company&#39;s legal interests, control the use of your website or app, and promote your business as a professional and trustworthy organization.</p>\r\n\r\n<p><strong>In this article</strong>, we&#39;re going to walk you through&nbsp;<strong>everything you need to include in your Terms of Use agreement</strong>&nbsp;to make sure it&#39;s an effective, useful, and professional-looking legal agreement, and then display it to the public.</p>\r\n\r\n<p>We&#39;ve also put together a&nbsp;<strong>Sample Terms of Use Template</strong>&nbsp;that you can use to help write your own.</p>\r\n', '2024-07-22 12:24:44'),
(4, '<p>A Terms of Use agreement is a legal agreement that lets you protect your company&#39;s legal interests, control the use of your website or app, and promote your business as a professional and trustworthy organization.</p>\r\n\r\n<p><strong>In this article</strong>, we&#39;re going to walk you through&nbsp;<strong>everything you need to include in your Terms of Use agreement</strong>&nbsp;to make sure it&#39;s an effective, useful, and professional-looking legal agreement, and then display it to the public.</p>\r\n\r\n<p>We&#39;ve also put together a&nbsp;<strong>Sample Terms of Use Template</strong>&nbsp;that you can use to help write your own.&nbsp;</p>\r\n\r\n<p>A Terms of Use agreement is a legal agreement that lets you protect your company&#39;s legal interests, control the use of your website or app, and promote your business as a professional and trustworthy organization.</p>\r\n\r\n<p><strong>In this article</strong>, we&#39;re going to walk you through&nbsp;<strong>everything you need to include in your Terms of Use agreement</strong>&nbsp;to make sure it&#39;s an effective, useful, and professional-looking legal agreement, and then display it to the public.</p>\r\n\r\n<p>We&#39;ve also put together a&nbsp;<strong>Sample Terms of Use Template</strong>&nbsp;that you can use to help write your own.</p>\r\n\r\n<p>&nbsp;</p>\r\n', '2024-07-22 12:25:40');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(20) NOT NULL,
  `userName` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `tel` varchar(225) NOT NULL,
  `date` varchar(20) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `userName`, `email`, `password`, `tel`, `date`) VALUES
(2, 'Kanishka Kumawat', 'kanishkkumawat25@gmail.com', '081105', '9314301313', '2024-07-18 '),
(3, 'Kanishka Kumawat', 'kanishka.kumawat@s.amity.edu', '456456', '4564564564', '2024-07-18 '),
(4, 'Kanishka Kumawat', 'kanishkakumawat1002@gmail.com', '260504', '9828601313', '2024-07-18 ');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(20) NOT NULL,
  `product_id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `p_name` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `product_id`, `user_id`, `p_name`) VALUES
(21, 34, 4, 'Wheat'),
(22, 38, 4, 'Cheese'),
(24, 30, 3, 'Carrot'),
(25, 29, 4, 'Tomato'),
(26, 30, 4, 'Carrot'),
(27, 41, 4, 'Tomato'),
(28, 40, 4, 'Carrot'),
(29, 32, 3, 'strawberry'),
(30, 29, 3, 'Tomato'),
(31, 33, 3, 'Mango');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address_details`
--
ALTER TABLE `address_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_detail`
--
ALTER TABLE `admin_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `content_page`
--
ALTER TABLE `content_page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `details`
--
ALTER TABLE `details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `help`
--
ALTER TABLE `help`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `privacy_policy`
--
ALTER TABLE `privacy_policy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `return_policy`
--
ALTER TABLE `return_policy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `review_table`
--
ALTER TABLE `review_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_media`
--
ALTER TABLE `social_media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terms_and_condition`
--
ALTER TABLE `terms_and_condition`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terms_of_use`
--
ALTER TABLE `terms_of_use`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address_details`
--
ALTER TABLE `address_details`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `admin_detail`
--
ALTER TABLE `admin_detail`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `content_page`
--
ALTER TABLE `content_page`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `details`
--
ALTER TABLE `details`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `help`
--
ALTER TABLE `help`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `privacy_policy`
--
ALTER TABLE `privacy_policy`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `return_policy`
--
ALTER TABLE `return_policy`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `review_table`
--
ALTER TABLE `review_table`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `social_media`
--
ALTER TABLE `social_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `terms_and_condition`
--
ALTER TABLE `terms_and_condition`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `terms_of_use`
--
ALTER TABLE `terms_of_use`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
