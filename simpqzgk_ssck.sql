-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 04, 2023 at 04:12 AM
-- Server version: 10.5.20-MariaDB-cll-lve
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simpqzgk_ssck`
--

-- --------------------------------------------------------

--
-- Table structure for table `addtocart`
--

CREATE TABLE `addtocart` (
  `id` int(11) NOT NULL,
  `menu_ID` varchar(100) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `barangay`
--

CREATE TABLE `barangay` (
  `id` int(11) NOT NULL,
  `municipal_ID` int(11) NOT NULL,
  `barangay` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `barangay`
--

INSERT INTO `barangay` (`id`, `municipal_ID`, `barangay`) VALUES
(4, 1, 'Banker'),
(5, 1, 'Bolo Batallion'),
(8, 1, 'Buayan'),
(9, 1, 'Cainglet'),
(10, 1, 'Calapan'),
(11, 1, 'Calubihan'),
(12, 1, 'Concepcion'),
(13, 1, 'Diampak'),
(14, 1, 'Dipala'),
(15, 1, 'Gacbusan'),
(16, 1, 'Goodyear'),
(17, 1, 'Lacnapan'),
(18, 1, 'Little Baguio'),
(19, 1, 'Lumbayao'),
(20, 1, 'Nazareth'),
(21, 1, 'Palinta'),
(22, 1, 'Peñaranda'),
(23, 1, 'Poblacion'),
(24, 1, 'Riverside'),
(25, 1, 'Sanghanan'),
(26, 1, 'Santa Cruz'),
(27, 1, 'Sayao'),
(28, 1, 'Shiolan'),
(29, 1, 'Simbol'),
(30, 1, 'Sininan'),
(31, 1, 'Tamin'),
(32, 1, 'Tampilisan'),
(33, 1, 'Tigbangagan'),
(34, 1, 'Timuay Danda'),
(35, 2, 'Aguinaldo'),
(36, 2, 'Baga'),
(39, 2, 'Baluno'),
(40, 2, 'Bangkaw-bangkaw'),
(41, 2, 'Cabong'),
(42, 2, 'Crossing Santa Clara'),
(43, 2, 'Gubawang'),
(44, 2, 'Guintoloan'),
(45, 2, 'Kaliantana'),
(46, 2, 'La Paz'),
(47, 2, 'Lower Sulitan'),
(48, 2, 'Mamagon'),
(49, 2, 'Marsolo'),
(50, 2, 'Poblacion'),
(51, 2, 'San Isidro'),
(52, 2, 'Sandayong'),
(53, 2, 'Santa Clara'),
(54, 2, 'Sulo'),
(55, 2, 'Tambanan'),
(56, 2, 'Taytay Manubo'),
(57, 2, 'Tilubog'),
(58, 2, 'Tipan'),
(59, 2, 'Upper Sulitan'),
(60, 3, 'Ali Alsree'),
(61, 3, 'Balansag'),
(64, 3, 'Calula'),
(65, 3, 'Casacon'),
(66, 3, 'Don Perfecto'),
(67, 3, 'Gango'),
(68, 3, 'Katipunan'),
(69, 3, 'Kulambugan'),
(70, 3, 'Mabini'),
(71, 3, 'Magsaysay'),
(72, 3, 'Malubal'),
(73, 3, 'New Antique'),
(74, 3, 'New Sagay'),
(75, 3, 'Palmera'),
(76, 3, 'Pres. Roxas'),
(77, 3, 'Remedios'),
(78, 3, 'San Antonio'),
(79, 3, 'San Fernandino'),
(80, 3, 'San Jose'),
(81, 3, 'Santo Rosario'),
(82, 3, 'Siawang'),
(83, 3, 'Silingan'),
(84, 3, 'Surabay'),
(85, 3, 'Taruc'),
(86, 3, 'Tilasan'),
(87, 3, 'Tupilac'),
(88, 4, 'Bagong Silang'),
(89, 4, 'Balagon'),
(92, 4, 'Balingasan'),
(93, 4, 'Balucanan'),
(94, 4, 'Bataan'),
(95, 4, 'Batu'),
(96, 4, 'Buyogan'),
(97, 4, 'Camanga'),
(98, 4, 'Coloran'),
(99, 4, 'Kimos'),
(100, 4, 'Labasan'),
(101, 4, 'Lagting'),
(102, 4, 'Laih'),
(103, 4, 'Logpond'),
(104, 4, 'Magsaysay'),
(105, 4, 'Mahayahay'),
(106, 4, 'Maligaya'),
(107, 4, 'Maniha'),
(108, 4, 'Minsulao'),
(109, 4, 'Mirangan'),
(110, 4, 'Monching'),
(111, 4, 'Paruk'),
(112, 4, 'Poblacion'),
(113, 4, 'Princesa Sumama'),
(114, 4, 'Salinding'),
(115, 4, 'San Isidro'),
(116, 4, 'Sibuguey'),
(117, 4, 'Siloh'),
(118, 4, 'Villagracia'),
(119, 5, 'Achasol'),
(120, 5, 'Azusano'),
(123, 5, 'Bangco'),
(124, 5, 'Camanga'),
(125, 5, 'Culasian'),
(126, 5, 'Dalangin'),
(127, 5, 'Dalangin Muslim'),
(128, 5, 'Dalisay'),
(129, 5, 'Gomotoc'),
(130, 5, 'Imelda'),
(131, 5, 'Kipit'),
(132, 5, 'Kitabog'),
(133, 5, 'La Libertad'),
(134, 5, 'Longilog'),
(135, 5, 'Mabini'),
(136, 5, 'Malagandis'),
(137, 5, 'Mate'),
(138, 5, 'Moalboal'),
(139, 5, 'Namnama'),
(140, 5, 'New Canaan'),
(141, 5, 'Palomoc'),
(142, 5, 'Poblacion'),
(143, 5, 'Poblacion Muslim'),
(144, 5, 'Pulidan'),
(145, 5, 'San Antonio'),
(146, 5, 'San Isidro'),
(147, 5, 'Santa Fe'),
(148, 5, 'Supit'),
(149, 5, 'Tugop'),
(150, 5, 'Tugop Muslim'),
(151, 6, 'Baluran'),
(152, 6, 'Batungan'),
(155, 6, 'Cayamcam'),
(156, 6, 'Datu Tumanggong'),
(157, 6, 'Gaycon'),
(158, 6, 'Langon'),
(159, 6, 'Libertad'),
(160, 6, 'Linguisan'),
(161, 6, 'Little Margos'),
(162, 6, 'Loboc'),
(163, 6, 'Looc-labuan'),
(164, 6, 'Lower Tungawan'),
(165, 6, 'Malungon'),
(166, 6, 'Masao'),
(167, 6, 'San Isidro'),
(168, 6, 'San Pedro'),
(169, 6, 'San Vicente'),
(170, 6, 'Santo Niño'),
(171, 6, 'Sisay'),
(172, 6, 'Taglibas'),
(173, 6, 'Tigbanuang'),
(174, 6, 'Tigbucay'),
(175, 6, 'Tigpalay'),
(176, 6, 'Timbabauan'),
(177, 6, 'Upper Tungawan');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category` varchar(100) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category`, `image`) VALUES
(1, 'Cake', 'banner-03.jpg'),
(2, 'Kakanin', 'banner-02.jpg'),
(3, 'Mixed', 'banner-01.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `checker`
--

CREATE TABLE `checker` (
  `id` int(11) NOT NULL,
  `customer_ID` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `checker`
--

INSERT INTO `checker` (`id`, `customer_ID`) VALUES
(21, 'CID-996');

-- --------------------------------------------------------

--
-- Table structure for table `counter_table`
--

CREATE TABLE `counter_table` (
  `id` int(11) NOT NULL,
  `id_address` text NOT NULL,
  `visit_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `seq` int(11) NOT NULL,
  `customer_ID` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `middleName` varchar(100) NOT NULL,
  `mobile` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `sex` text NOT NULL,
  `birthday` text NOT NULL,
  `password` varchar(100) NOT NULL,
  `code` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `identification` text NOT NULL,
  `address` text NOT NULL,
  `image` varchar(100) NOT NULL,
  `terms_condition` tinyint(1) NOT NULL,
  `date_entry` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `seq`, `customer_ID`, `lastName`, `firstName`, `middleName`, `mobile`, `email`, `sex`, `birthday`, `password`, `code`, `status`, `identification`, `address`, `image`, `terms_condition`, `date_entry`) VALUES
(45, 1, 'CID20231126-1', 'Mendoza', 'Jaymark', 'Fernandez', '9550162688', 'jaymarkmendoza2k@gmail.com', '', '2000-09-14', '8940af002ca6768bd4d9dd8317c3e800', '', 1, '1', '1', 'IMG-6564900853aae8.22151380.jpg', 1, '2023-11-26'),
(47, 3, 'CID20231126-3', 'Mendoza', 'Marcus', 'Fernandez', '9353204718', 'mjaymark222@gmail.com', '1', '', '8940af002ca6768bd4d9dd8317c3e800', '', 1, '1', '1', '', 1, '2023-11-26'),
(49, 4, 'CID20231126-4', 'Chad', 'Giga', '', '9058772618', 'reap02886@gmail.com', '', '1978-09-05', '8940af002ca6768bd4d9dd8317c3e800', '', 1, '1', '1', '', 1, '2023-11-26'),
(50, 5, 'CID20231126-5', 'Cabrera', 'Cassey', '', '9555265783', 'jelz2205@gmail.com', '', '1990-02-22', 'ebd787bdccbe6928a2f65913a5bf6882', '', 1, '1', '1', 'IMG-656335f56996c3.10549670.jpg', 1, '2023-11-26'),
(51, 6, 'CID20231126-6', 'Villaruel', 'Jemuel', 'Tanduyan', '9959544341', 'iamjemuelvillaruel99@gmail.com', '', '1999-04-12', '093cb24ae68201cbed0dc934f413b7bb', '', 1, '1', '1', 'IMG-65632b3ab6f3e6.33311283.png', 1, '2023-11-26'),
(52, 7, 'CID20231127-7', 'Saburani', 'Hasim', 'Yang', '9977223878', 'saburanihasim@gmail.com', '', '1980-04-20', 'fcbf7261ab24dc5f518480f3f73ae868', '', 1, '1', '1', '', 1, '2023-11-27'),
(54, 9, 'CID20231127-9', 'Dionglay', 'Juliet', 'Gregorio', '9977500518', 'dionglayjuliet25@gmail.com', '', '1994-06-01', 'e5b550a2fd6d4308974bf4d3b660f324', '', 1, '1', '1', '', 1, '2023-11-27'),
(55, 10, 'CID20231127-10', 'Bulan', 'Elvie', 'Omlan', '9555742610', '19elviebulan98@gmail.com', '', '1998-09-13', '3e8169cf23e0533646faf0dff6f3cc15', '', 1, '1', '1', '', 1, '2023-11-27'),
(56, 11, 'CID20231127-11', 'Latasan', 'Agnes', 'Borces', '9650428498', 'agneslatasan91@gmail.com', '', '1991-10-19', '5d98f816f0e05e90bff7834261f87e1b', '', 1, '1', '1', '', 1, '2023-11-27'),
(58, 13, 'CID20231127-13', 'Sumalinog', 'Joevian', 'Albor', '9353869807', 'joeviansumalinog88@gmail.com', '', '1988-07-14', '7234aa0e33472cc4f2a292a781f4aef3', '', 1, '1', '1', '', 1, '2023-11-27'),
(60, 15, 'CID20231127-15', 'Panuelo', 'Mercy', 'Moleta', '9977534377', 'mercypanuelo1959@gmail.com', '', '1959-10-29', '1834115e3cc921891f029ab9eed01f1b', '', 1, '1', '1', '', 1, '2023-11-27'),
(61, 16, 'CID20231127-16', 'Montigo', 'Lea Vanessa', 'Abuan', '9277116308', 'leavanessamontigo00@gmail.com', '', '2000-09-01', 'a55bb2f7b82a9835efecabea23f7e4cd', '', 1, '1', '1', '', 1, '2023-11-27'),
(62, 17, 'CID20231127-17', 'Iturralde', 'Joshua Rommel', 'Dandoy', '9078468109', 'joshuaiturralde92@gmail.com', '', '1992-07-13', '2c037185869d843b81ab42e4f12ebc35', '', 1, '1', '1', '', 1, '2023-11-27'),
(64, 19, 'CID20231127-19', 'Quioco', 'Baltazar', 'Omas-as', '9656791530', 'baltazarquioco4@gmail.com', '', '1998-03-03', 'e523134efef7a58fe8201eb0e98b8f74', '', 0, '', '', '', 1, '2023-11-27'),
(65, 20, 'CID20231127-20', 'Edombingo', 'Kimmer', 'Guilingan', '9678022760', 'kimoythegoodboy@gmail.com', '', '2000-03-03', 'fd1e1cefa21a0675833166c4d3b8beb3', '', 1, '1', '1', '', 1, '2023-11-27'),
(66, 21, 'CID20231127-21', 'Sombreno', 'Leizel', 'Belano', '+639055840120', 'leizelsombreno@gmail.com', '2', '08/14/1968', 'b5b73fae0d87d8b4e2573105f8fbe7bc', '', 1, '', '', 'IMG-6564911b81c6e9.58202157.jpg', 0, '2023-11-27'),
(67, 22, 'CID20231127-22', 'Bulawan', 'Nesrine', 'vasquez', '+630926952376', 'nesrinevasqueza@gmail.com', '2', '06/26/1997', 'b5b73fae0d87d8b4e2573105f8fbe7bc', '', 1, '', '', 'IMG-656491ce171f04.05476882.jpg', 0, '2023-11-27'),
(68, 23, 'CID20231127-23', 'Taring', 'Renela', 'Sombreno', '+639672782936', 'renelataring@gmail.com', '2', '08/16/1992', 'b5b73fae0d87d8b4e2573105f8fbe7bc', '', 1, '', '', 'IMG-65649604de73d8.37487105.jpg', 0, '2023-11-27'),
(69, 24, 'CID20231127-24', 'Beter', 'Renezel', 'Sombreno', '+639750370150', 'renezel@gmail.com', '2', '10/25/1990', 'b5b73fae0d87d8b4e2573105f8fbe7bc', '', 1, '', '', 'IMG-65649686163a53.22581389.jpg', 0, '2023-11-27'),
(70, 25, 'CID20231127-25', 'Sabandal', 'Lorelyn', 'Balendres', '+639709487305', 'lorelynsabandal@gmail.com', '2', '10/24/1982', 'b5b73fae0d87d8b4e2573105f8fbe7bc', '', 1, '', '', 'IMG-656496ee732557.71810311.jpg', 0, '2023-11-27'),
(71, 26, 'CID20231128-26', 'Bulquirin', 'Roldan', '', '+639551938867', 'roldanbulquirin01@gmail.com', '1', '09/15/2000', 'b5b73fae0d87d8b4e2573105f8fbe7bc', '', 1, '', '', 'IMG-6564e1faa9faf0.83247179.jpg', 0, '2023-11-28'),
(72, 27, 'CID20231128-27', 'Cabaljog', 'Kyzel', '', '+639555775129', 'kyzelcabaljog01@gmail.com', '2', '12/06/2001', 'b5b73fae0d87d8b4e2573105f8fbe7bc', '', 1, '', '', 'IMG-6564e2bac59ea9.87749702.jpg', 0, '2023-11-28'),
(73, 28, 'CID20231128-28', 'Gumanta', 'Ronian', 'Dela Cruz', '+639709928062', 'roniangumanta@gmail.com', '1', '10/26/2004', 'b5b73fae0d87d8b4e2573105f8fbe7bc', '', 1, '', '', 'IMG-6564e3a9eb1cd3.04752605.jpg', 0, '2023-11-28'),
(74, 29, 'CID20231128-29', 'Jamjali', 'Saniya', 'Mallari', '+63967026583', '20saniyajamjali00@gmail.com', '2', '04/08/2000', 'b5b73fae0d87d8b4e2573105f8fbe7bc', '', 1, '', '', 'IMG-6564e6afa6bbf0.32449811.jpg', 0, '2023-11-28'),
(75, 30, 'CID20231128-30', 'Magalso', 'Joseph Anthony John', '', '+639354465203', 'josepmagalso86@gmail.com', '1', '10/16/1986', 'b5b73fae0d87d8b4e2573105f8fbe7bc', '', 1, '', '', 'IMG-6564e7cc613906.32384495.jpg', 0, '2023-11-28'),
(76, 31, 'CID20231128-31', 'Sumalpong', 'Manilyn', 'Magante', '+639531795793', 'manilynsumalpong92@gmail.com', '2', '08/02/1992', 'b5b73fae0d87d8b4e2573105f8fbe7bc', '', 1, '', '', 'IMG-6564e898463089.67454961.jpg', 0, '2023-11-28'),
(77, 32, 'CID20231128-32', 'Mendoza', 'Ruth', 'Fernandez', '9058772618', '19mendozaruth78@gmail.com', '', '1978-09-05', 'c4bd8d33b69d254d0caba2059f77880c', 'f5a40a0d46e7a4083cc115ca297fb8e9', 0, '', '', '', 1, '2023-11-28'),
(78, 33, 'CID20231128-33', 'Mendoza', 'Domciana', 'Alfonso', '+639552216445', 'domicianaalmendoza@gmail.com', '2', '12/29/1960', 'b5b73fae0d87d8b4e2573105f8fbe7bc', '', 1, '', '', 'IMG-6564ed66511a78.52595722.jpg', 0, '2023-11-28'),
(79, 34, 'CID20231128-34', 'SEGOVIA', 'RENALD', 'QUIROS', '9615471220', 'segoviarenald4@gmail.com', '', '2000-11-26', 'd6a166c72e6a14f1b254182cc1a959b5', '', 0, '', '1', 'IMG-656504732c76c0.91464341.jpg', 1, '2023-11-28'),
(80, 35, 'CID20231128-35', 'Canillo', 'Analiza', 'N/A', '9353868607', 'canilloanaliza@gmail.com', '', '2000-03-13', 'd1659f8a4945d81e506e5fee09867042', '', 0, '', '1', '', 1, '2023-11-28'),
(81, 36, 'CID20231128-36', 'Sibala', 'Jeaneline', 'Cuyos', '9708852020', 'sibalajeaneline@gmail.com', '', '2002-07-13', 'c836b2abf7af389d4c4932623c0ed225', '', 0, '', '1', 'IMG-656516e7ba9ef6.87910922.jpg', 1, '2023-11-28'),
(82, 37, 'CID20231128-37', 'Zayas', 'Ivan Kyle', 'Edrosos', '9366849463', 'kyleivanzayas@gmail.com', '', '1999-08-26', '5f45cf968687b129da20ddab79be1e5c', '', 1, '1', '1', '', 1, '2023-11-28'),
(83, 38, 'CID20231128-38', 'Gorre', 'Anna Jane', 'Ojano', '9678028906', 'annajanegorre2017@gmail.com', '', '2000-02-17', 'bd9547a161011e82259f4e52bfd113d8', '', 0, '', '', '', 1, '2023-11-28'),
(84, 39, 'CID20231128-39', 'Lodivice ', 'Bryan ', 'Dela Cruz ', '9977682373', 'blodivice@gmail.com', '', '2000-07-08', '0cfba607002d8a454f0a7d668b75b61a', '580179caeadf75e545ee7ddd390fa147', 0, '', '', '', 1, '2023-11-28'),
(85, 40, 'CID20231128-40', 'Duhig', 'Eula Nathanielle', 'Cuid', '9155091671', 'enathanielleduhig@gmail.com', '', '2001-12-25', '5fa0a459304e1f7874b0e24fcb2b753e', 'f972f1f462e13fd19662aff248a2ca7f', 0, '', '', '', 1, '2023-11-28'),
(86, 41, 'CID20231128-41', 'M', 'O', '', '0999999999', 'donbytes@yahoo.com', '', '1995-11-02', 'b156525afdb610b9d6830a1e9d0a1024', 'cd8a137fcfefa3e1e36c387ffd5a3893', 0, '', '', '', 1, '2023-11-28'),
(87, 42, 'CID20231128-42', 'Mendoza', 'Jaime', 'Alfonso', '9171333612', 'jaimendo.tungawan@gmail.com', '', '1979-12-05', '4b8c0e461584da396e0cb5926d065d13', '', 1, '1', '1', '', 1, '2023-11-28'),
(88, 43, 'CID20231128-43', 'BENTILACION', 'SEAN PHILIP', 'D', '9971202479', 'bentilacionseanphilip@gmail.com', '', '2001-07-09', 'd005d9955dda7effc1b10135bda68561', '', 0, '', '', '', 1, '2023-11-28'),
(89, 44, 'CID20231130-44', 'TEst', 'TEst', 'TEst', '1231231212', 'test@yahoo.com', '', '1990-09-11', '662af1cd1976f09a9f8cecc868ccc0a2', 'fe0977c29addfd6b02ed24db3dabb112', 0, '', '', '', 1, '2023-11-30'),
(90, 45, 'CID20231202-45', 'Samosa', 'Benj', 'Alvarado', '9653541498', 'benjaminsamosa2003@gmail.com', '', '2003-12-25', 'fd08ca4bf139770f8b9fd5d7c485324a', '', 0, '', '', '', 1, '2023-12-02');

-- --------------------------------------------------------

--
-- Table structure for table `customer_address`
--

CREATE TABLE `customer_address` (
  `id` int(11) NOT NULL,
  `customer_ID` varchar(100) NOT NULL,
  `province_ID` int(11) NOT NULL,
  `municipal_ID` int(11) NOT NULL,
  `barangay_ID` int(11) NOT NULL,
  `zipcode` text NOT NULL,
  `sitio` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customer_address`
--

INSERT INTO `customer_address` (`id`, `customer_ID`, `province_ID`, `municipal_ID`, `barangay_ID`, `zipcode`, `sitio`) VALUES
(18, 'CID20231126-1', 1, 6, 168, '7018', 'Purok Santan'),
(19, 'CID20231126-3', 1, 6, 168, '7018', 'Purok Santan'),
(20, 'CID20231126-4', 1, 6, 168, '7018', 'Purok Santan'),
(21, 'CID20231126-5', 1, 6, 159, '7018', 'WMSU Street'),
(22, 'CID20231126-6', 1, 6, 173, '7018', 'Tigbanuang'),
(23, 'CID20231127-7', 1, 6, 159, '7018', 'Purok 1'),
(24, 'CID20231127-10', 1, 6, 152, '7018', 'Purok 2'),
(25, 'CID20231127-9', 1, 6, 164, '7018', 'Purok Malipayon'),
(26, 'CID20231127-11', 1, 6, 159, '7018', 'Purok Orchids'),
(27, 'CID20231127-13', 1, 6, 159, '7018', 'Sitio DK'),
(28, 'CID20231127-15', 1, 6, 159, '7018', 'Purok Izamcee'),
(29, 'CID20231127-16', 1, 6, 159, '7018', 'Sitio DK'),
(30, 'CID20231127-17', 1, 6, 159, '7018', 'Sitio DK'),
(31, 'CID20231127-20', 1, 6, 159, '7018', 'Purok Ilzamcee'),
(32, 'CID20231128-34', 1, 6, 151, '7018', 'Purok Little Paradise'),
(33, 'CID20231128-35', 1, 6, 168, '7000', 'San Pedro'),
(34, 'CID20231128-36', 1, 3, 66, '7001', '1098'),
(35, 'CID20231128-37', 1, 3, 72, '7001', 'Purok Golden Shower, Malubal, R.T. Lim, Zamboanga Sibugay '),
(36, 'CID20231128-42', 1, 6, 161, '7018', 'purok1');

-- --------------------------------------------------------

--
-- Table structure for table `customer_identification`
--

CREATE TABLE `customer_identification` (
  `id` int(11) NOT NULL,
  `customer_ID` varchar(100) NOT NULL,
  `type_id` varchar(100) NOT NULL,
  `id_number` varchar(100) NOT NULL,
  `image_id` text NOT NULL,
  `selfie` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `expiry_date` date NOT NULL,
  `date_entry` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customer_identification`
--

INSERT INTO `customer_identification` (`id`, `customer_ID`, `type_id`, `id_number`, `image_id`, `selfie`, `status`, `expiry_date`, `date_entry`) VALUES
(18, 'CID20231126-1', '1', '1234568', '3392-id-sample.jpg', '', 1, '2024-01-01', '2023-11-26'),
(19, 'CID20231126-3', '1', '1234568', '47899-id-sample.jpg', '', 1, '2023-12-31', '2023-11-26'),
(20, 'CID20231126-4', '1', '1234568', '96682-id-sample.jpg', '', 1, '2024-01-12', '2023-11-26'),
(21, 'CID20231126-5', '1', '12345678', '95376-love-philippines_2023-07-01_17-24-22.jpg', '', 1, '2023-12-31', '2023-11-26'),
(22, 'CID20231126-6', '6', '123423456534', '20593-bg.jpg', '', 1, '2030-01-01', '2023-11-26'),
(23, 'CID20231127-7', '6', '070119-0056', '14702-hasim-id.jpg', '', 1, '2024-01-05', '2023-11-27'),
(24, 'CID20231127-10', '6', '2953-2478-1397-1634', '58624-elvie-id.jpg', '', 1, '2023-12-30', '2023-11-27'),
(25, 'CID20231127-9', '3', '0701220169', '73387-juliet-id.jpg', '', 1, '2025-06-30', '2023-11-27'),
(26, 'CID20231127-11', '2', '1234568', '37964-agnes.jpg', '', 1, '2024-02-16', '2023-11-27'),
(27, 'CID20231127-13', '3', '070122-0036', '88409-joevian-id.jpg', '', 1, '2024-01-26', '2023-11-27'),
(28, 'CID20231127-15', '3', '070119-0030', '75274-mercy-id.jpg', '', 1, '2024-01-20', '2023-11-27'),
(29, 'CID20231127-16', '11', '0199552', '95539-lea-vanesa-id.jpg', '', 1, '2026-07-08', '2023-11-28'),
(30, 'CID20231127-17', '6', '5165-2134-6831-5098', '92111-joshua-id.jpg', '', 1, '2024-12-28', '2023-11-28'),
(31, 'CID20231127-20', '9', 'N26220632650', '34472-khimmer-id.jpg', '', 1, '2025-10-17', '2023-11-28'),
(32, 'CID20231128-37', '6', '4571284701798630', '97795-img_20231128_064453.jpg', '', 1, '2045-11-28', '2023-11-28'),
(33, 'CID20231128-42', '1', '12345566', '63845-gcash-sample.jpg', '', 1, '2024-02-04', '2023-11-28');

-- --------------------------------------------------------

--
-- Table structure for table `delinquent_customer`
--

CREATE TABLE `delinquent_customer` (
  `id` int(11) NOT NULL,
  `customer_ID` varchar(100) NOT NULL,
  `duedate` date NOT NULL,
  `date_entry` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `delinquent_customer`
--

INSERT INTO `delinquent_customer` (`id`, `customer_ID`, `duedate`, `date_entry`) VALUES
(295, 'CID20231126-5', '2023-11-27', '2023-11-28'),
(296, 'CID20231126-5', '2023-11-27', '2023-11-28'),
(297, 'CID20231126-5', '2023-11-27', '2023-11-28'),
(298, 'CID20231126-5', '2023-11-27', '2023-11-28'),
(299, 'CID20231126-5', '2023-11-27', '2023-11-28'),
(300, 'CID20231126-5', '2023-11-27', '2023-11-28'),
(301, 'CID20231126-5', '2023-11-27', '2023-11-28');

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

CREATE TABLE `gender` (
  `id` int(11) NOT NULL,
  `gender` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `gender`
--

INSERT INTO `gender` (`id`, `gender`) VALUES
(1, 'Male'),
(2, 'Female');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `seq` int(11) NOT NULL,
  `menu_ID` varchar(100) NOT NULL,
  `menu` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL,
  `price` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_entry` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `seq`, `menu_ID`, `menu`, `description`, `category`, `price`, `image`, `status`, `date_entry`) VALUES
(1, 1, 'MID-20230508-1', ' Vanilla Cake', '3 Layered Vanilla Cake', '1', '1000', 'product-02.jpg', 1, '2023-05-08'),
(2, 2, 'MID-20230508-2', 'Kutsinta', 'Delecious 24 pcs of Kutsinta with cheese toppings', '2', '300', 'product-05.jpg', 1, '2023-05-08'),
(3, 3, 'MID-20230508-3', 'Kutsinta', 'Delecious 24 pcs of plain kutsinta', '2', '250', 'product-04.jpg', 1, '2023-05-08'),
(4, 4, 'MID-20230725-4', 'Kutsinta ', 'Delicious 24 pcs of Kutsinta ', '2', '250', 'product-06.jpg', 1, '2023-07-25'),
(5, 5, 'MID-20230827-5', 'Cherry Cake', 'Layers of moistened chocolate cake, brimming with maraschino cherries and cream, rich chocolate shavings and chocolate curls.', '1', '750', 'IMG-64eb019987ec93.59196394.jpg', 1, '2023-08-27'),
(6, 6, 'MID20231111-6', 'Minecraft cake', 'Moist cake coated with vanilla icing', '1', '700', 'IMG-654ee1d80dc646.85327624.jpg', 1, '2023-11-11'),
(10, 9, 'MID20231127-9', 'Pandan Cake', 'Rounded moist cake coated with pandan icing', '1', '650', 'IMG-6564a5112da8c4.60934017.jpg', 1, '2023-11-27'),
(11, 10, 'MID20231127-10', 'Ube Cake', 'Rounded Cake with Ube Coated icing.', '1', '600', 'IMG-6564a616288200.69325030.jpg', 1, '2023-11-27'),
(12, 11, 'MID20231128-11', '4 in 1', '15pcs Buchi,  26 pcs kutsinta,  12 pcs Puto and 8 pcs of Casava Kakanin', '3', '350', 'IMG-6564f8fad6e782.43332228.jpg', 1, '2023-11-28'),
(13, 12, 'MID20231128-12', 'Puto ', '50 pcs of Puto with cheese on top', '2', '300', 'IMG-656500194a7948.95261168.jpg', 1, '2023-11-28');

-- --------------------------------------------------------

--
-- Table structure for table `menu_ratings`
--

CREATE TABLE `menu_ratings` (
  `id` int(11) NOT NULL,
  `menu_ID` varchar(100) NOT NULL,
  `ratings` int(11) NOT NULL,
  `date_entry` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `municipality`
--

CREATE TABLE `municipality` (
  `id` int(11) NOT NULL,
  `province_ID` int(11) NOT NULL,
  `municipality` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `municipality`
--

INSERT INTO `municipality` (`id`, `province_ID`, `municipality`) VALUES
(1, 1, 'Kabasalan'),
(2, 1, 'Naga'),
(3, 1, 'R.T.Lim'),
(4, 1, 'Siay'),
(5, 1, 'Titay'),
(6, 1, 'Tungawan');

-- --------------------------------------------------------

--
-- Table structure for table `mycart`
--

CREATE TABLE `mycart` (
  `id` int(11) NOT NULL,
  `orderNo` varchar(100) NOT NULL,
  `menu_ID` varchar(100) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `buyer_ID` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `menu_iden` text NOT NULL,
  `date_pickup` date NOT NULL,
  `time` time NOT NULL,
  `date_entry` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `mycart`
--

INSERT INTO `mycart` (`id`, `orderNo`, `menu_ID`, `qty`, `price`, `buyer_ID`, `status`, `menu_iden`, `date_pickup`, `time`, `date_entry`) VALUES
(52, '798433583002023-11-27ZS50', 'MID-20230827-5', 1, 750, '50', 0, 'g', '0000-00-00', '00:00:00', '2023-11-27'),
(60, '679106405002023-11-28ZS88', 'MID-20230725-4', 1, 250, '88', 0, 'g', '0000-00-00', '00:00:00', '2023-11-28'),
(61, '54638296002023-12-02ZS90', 'MID-20230508-2', 1, 300, '90', 0, 'g', '0000-00-00', '00:00:00', '2023-12-02');

-- --------------------------------------------------------

--
-- Table structure for table `notif`
--

CREATE TABLE `notif` (
  `id` int(11) NOT NULL,
  `customer_ID` varchar(100) NOT NULL,
  `seen_status` tinyint(1) NOT NULL,
  `description` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `notif`
--

INSERT INTO `notif` (`id`, `customer_ID`, `seen_status`, `description`, `date`, `time`) VALUES
(1047, 'CID20231126-1', 0, 'This is a reminder that your paluwagan payments is due in 3 days.', '2023-11-28', '00:00:00'),
(1048, 'CID20231126-3', 0, 'This is a reminder that your paluwagan payments is due in 3 days.', '2023-11-28', '00:00:00'),
(1049, 'CID20231126-4', 0, 'This is a reminder that your paluwagan payments is due in 3 days.', '2023-11-28', '00:00:00'),
(1050, 'CID20231126-5', 0, 'This is a reminder that your paluwagan payments is due in 3 days.', '2023-11-28', '00:00:00'),
(1051, 'CID20231126-6', 0, 'This is a reminder that your paluwagan payments is due in 3 days.', '2023-11-28', '00:00:00'),
(1052, 'CID20231126-1', 0, 'Reminders! You have an order/s to pick-up to day.', '2023-11-28', '00:00:00'),
(1053, 'CID20231126-5', 0, 'Reminders! You have an order/s to pick-up to day.', '2023-11-28', '00:00:00'),
(1054, 'CID20231127-7', 0, 'Reminders! You have an order/s to pick-up to day.', '2023-11-28', '00:00:00'),
(1055, 'CID20231126-1', 0, 'This is a reminder that your paluwagan payments is due in 3 days.', '2023-11-28', '00:00:00'),
(1056, 'CID20231126-3', 0, 'This is a reminder that your paluwagan payments is due in 3 days.', '2023-11-28', '00:00:00'),
(1057, 'CID20231126-4', 0, 'This is a reminder that your paluwagan payments is due in 3 days.', '2023-11-28', '00:00:00'),
(1058, 'CID20231126-5', 0, 'This is a reminder that your paluwagan payments is due in 3 days.', '2023-11-28', '00:00:00'),
(1059, 'CID20231126-6', 0, 'This is a reminder that your paluwagan payments is due in 3 days.', '2023-11-28', '00:00:00'),
(1060, 'CID20231126-1', 0, 'Reminders! You have an order/s to pick-up to day.', '2023-11-28', '00:00:00'),
(1061, 'CID20231126-5', 0, 'Reminders! You have an order/s to pick-up to day.', '2023-11-28', '00:00:00'),
(1062, 'CID20231127-7', 0, 'Reminders! You have an order/s to pick-up to day.', '2023-11-28', '00:00:00'),
(1063, 'CID20231126-1', 0, 'This is a reminder that your paluwagan payments is due in 3 days.', '2023-11-28', '00:00:00'),
(1064, 'CID20231126-3', 0, 'This is a reminder that your paluwagan payments is due in 3 days.', '2023-11-28', '00:00:00'),
(1065, 'CID20231126-4', 0, 'This is a reminder that your paluwagan payments is due in 3 days.', '2023-11-28', '00:00:00'),
(1066, 'CID20231126-5', 0, 'This is a reminder that your paluwagan payments is due in 3 days.', '2023-11-28', '00:00:00'),
(1067, 'CID20231126-6', 0, 'This is a reminder that your paluwagan payments is due in 3 days.', '2023-11-28', '00:00:00'),
(1068, 'CID20231126-1', 0, 'Reminders! You have an order/s to pick-up to day.', '2023-11-28', '00:00:00'),
(1069, 'CID20231126-5', 0, 'Reminders! You have an order/s to pick-up to day.', '2023-11-28', '00:00:00'),
(1070, 'CID20231127-7', 0, 'Reminders! You have an order/s to pick-up to day.', '2023-11-28', '00:00:00'),
(1071, 'CID20231126-1', 0, 'Your order request has been approved', '2023-11-28', '10:21:38'),
(1072, 'CID20231126-1', 0, 'This is a reminder that your paluwagan payments is due in 3 days.', '2023-11-28', '00:00:00'),
(1073, 'CID20231126-3', 0, 'This is a reminder that your paluwagan payments is due in 3 days.', '2023-11-28', '00:00:00'),
(1074, 'CID20231126-4', 0, 'This is a reminder that your paluwagan payments is due in 3 days.', '2023-11-28', '00:00:00'),
(1075, 'CID20231126-5', 0, 'This is a reminder that your paluwagan payments is due in 3 days.', '2023-11-28', '00:00:00'),
(1076, 'CID20231126-6', 0, 'This is a reminder that your paluwagan payments is due in 3 days.', '2023-11-28', '00:00:00'),
(1077, 'CID20231126-1', 0, 'Reminders! You have an order/s to pick-up to day.', '2023-11-28', '00:00:00'),
(1078, 'CID20231126-5', 0, 'Reminders! You have an order/s to pick-up to day.', '2023-11-28', '00:00:00'),
(1079, 'CID20231127-7', 0, 'Reminders! You have an order/s to pick-up to day.', '2023-11-28', '00:00:00'),
(1080, 'CID20231128-42', 0, 'Your ID request has been approved', '2023-11-28', '10:53:32'),
(1081, 'CID20231128-42', 0, 'Your ID request has been approved', '2023-11-28', '10:55:17'),
(1082, 'CID20231128-42', 0, 'Your ID request has been approved', '2023-11-28', '10:55:28'),
(1083, 'CID20231128-42', 0, 'Your paluwagan request has been approved', '2023-11-28', '00:00:00'),
(1084, 'CID20231128-42', 0, 'Your paluwagan request has been approved', '2023-11-28', '00:00:00'),
(1085, 'CID20231126-3', 0, 'Your paluwagan has been already started.', '2023-11-28', '00:00:00'),
(1086, 'CID20231126-4', 0, 'Your paluwagan has been already started.', '2023-11-28', '00:00:00'),
(1087, 'CID20231126-5', 0, 'Your paluwagan has been already started.', '2023-11-28', '00:00:00'),
(1088, 'CID20231126-6', 0, 'Your paluwagan has been already started.', '2023-11-28', '00:00:00'),
(1089, 'CID20231128-42', 0, 'Your paluwagan has been already started.', '2023-11-28', '00:00:00'),
(1090, 'CID20231126-3', 0, 'This is a reminder that your paluwagan payments is due in 3 days.', '2023-11-28', '00:00:00'),
(1091, 'CID20231126-4', 0, 'This is a reminder that your paluwagan payments is due in 3 days.', '2023-11-28', '00:00:00'),
(1092, 'CID20231126-5', 0, 'This is a reminder that your paluwagan payments is due in 3 days.', '2023-11-28', '00:00:00'),
(1093, 'CID20231126-6', 0, 'This is a reminder that your paluwagan payments is due in 3 days.', '2023-11-28', '00:00:00'),
(1094, 'CID20231128-42', 0, 'This is a reminder that your paluwagan payments is due in 3 days.', '2023-11-28', '00:00:00'),
(1095, 'CID20231126-1', 0, 'Reminders! You have an order/s to pick-up to day.', '2023-11-28', '00:00:00'),
(1096, 'CID20231126-5', 0, 'Reminders! You have an order/s to pick-up to day.', '2023-11-28', '00:00:00'),
(1097, 'CID20231127-7', 0, 'Reminders! You have an order/s to pick-up to day.', '2023-11-28', '00:00:00'),
(1098, 'CID20231128-42', 0, 'Your payment request has been approved', '2023-11-28', '00:00:00'),
(1099, 'CID20231127-17', 0, 'Your paluwagan request has been approved', '2023-11-28', '00:00:00'),
(1100, 'CID20231128-42', 0, 'Your payment request has been approved', '2023-11-28', '00:00:00'),
(1101, 'CID20231127-7', 0, 'Your paluwagan has been already started.', '2023-11-28', '00:00:00'),
(1102, 'CID20231127-9', 0, 'Your paluwagan has been already started.', '2023-11-28', '00:00:00'),
(1103, 'CID20231127-10', 0, 'Your paluwagan has been already started.', '2023-11-28', '00:00:00'),
(1104, 'CID20231127-11', 0, 'Your paluwagan has been already started.', '2023-11-28', '00:00:00'),
(1105, 'CID20231127-17', 0, 'Your paluwagan has been already started.', '2023-11-28', '00:00:00'),
(1106, 'CID20231126-3', 0, 'This is a reminder that your paluwagan payments is due in 3 days.', '2023-11-28', '00:00:00'),
(1107, 'CID20231126-4', 0, 'This is a reminder that your paluwagan payments is due in 3 days.', '2023-11-28', '00:00:00'),
(1108, 'CID20231126-5', 0, 'This is a reminder that your paluwagan payments is due in 3 days.', '2023-11-28', '00:00:00'),
(1109, 'CID20231126-6', 0, 'This is a reminder that your paluwagan payments is due in 3 days.', '2023-11-28', '00:00:00'),
(1110, 'CID20231127-10', 0, 'This is a reminder that your paluwagan payments is due in 3 days.', '2023-11-28', '00:00:00'),
(1111, 'CID20231127-11', 0, 'This is a reminder that your paluwagan payments is due in 3 days.', '2023-11-28', '00:00:00'),
(1112, 'CID20231127-17', 0, 'This is a reminder that your paluwagan payments is due in 3 days.', '2023-11-28', '00:00:00'),
(1113, 'CID20231127-7', 0, 'This is a reminder that your paluwagan payments is due in 3 days.', '2023-11-28', '00:00:00'),
(1114, 'CID20231127-9', 0, 'This is a reminder that your paluwagan payments is due in 3 days.', '2023-11-28', '00:00:00'),
(1115, 'CID20231126-1', 0, 'Reminders! You have an order/s to pick-up to day.', '2023-11-28', '00:00:00'),
(1116, 'CID20231126-5', 0, 'Reminders! You have an order/s to pick-up to day.', '2023-11-28', '00:00:00'),
(1117, 'CID20231127-7', 0, 'Reminders! You have an order/s to pick-up to day.', '2023-11-28', '00:00:00'),
(1118, 'CID20231126-3', 0, 'This is a reminder that your paluwagan payments is due in 3 days.', '2023-11-28', '00:00:00'),
(1119, 'CID20231126-4', 0, 'This is a reminder that your paluwagan payments is due in 3 days.', '2023-11-28', '00:00:00'),
(1120, 'CID20231126-5', 0, 'This is a reminder that your paluwagan payments is due in 3 days.', '2023-11-28', '00:00:00'),
(1121, 'CID20231126-6', 0, 'This is a reminder that your paluwagan payments is due in 3 days.', '2023-11-28', '00:00:00'),
(1122, 'CID20231127-10', 0, 'This is a reminder that your paluwagan payments is due in 3 days.', '2023-11-28', '00:00:00'),
(1123, 'CID20231127-11', 0, 'This is a reminder that your paluwagan payments is due in 3 days.', '2023-11-28', '00:00:00'),
(1124, 'CID20231127-17', 0, 'This is a reminder that your paluwagan payments is due in 3 days.', '2023-11-28', '00:00:00'),
(1125, 'CID20231127-7', 0, 'This is a reminder that your paluwagan payments is due in 3 days.', '2023-11-28', '00:00:00'),
(1126, 'CID20231127-9', 0, 'This is a reminder that your paluwagan payments is due in 3 days.', '2023-11-28', '00:00:00'),
(1127, 'CID20231126-1', 0, 'Reminders! You have an order/s to pick-up to day.', '2023-11-28', '00:00:00'),
(1128, 'CID20231126-5', 0, 'Reminders! You have an order/s to pick-up to day.', '2023-11-28', '00:00:00'),
(1129, 'CID20231127-7', 0, 'Reminders! You have an order/s to pick-up to day.', '2023-11-28', '00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_ID` varchar(100) NOT NULL,
  `customer_ID` varchar(100) NOT NULL,
  `menu_ID` varchar(100) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` text NOT NULL,
  `total_price` text NOT NULL,
  `date_pickup` date NOT NULL,
  `time_pickup` time NOT NULL,
  `dedication` text NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0=pending, 1=approved, 2=canceled, 3=completed',
  `terms_condition` tinyint(1) NOT NULL,
  `date_entry` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_ID`, `customer_ID`, `menu_ID`, `qty`, `price`, `total_price`, `date_pickup`, `time_pickup`, `dedication`, `status`, `terms_condition`, `date_entry`) VALUES
(59, '2991490002023-11-26ZS45', 'CID20231126-1', 'MID-20230827-5', 1, '750', '750', '2023-11-28', '08:34:00', '', 1, 1, '2023-11-26'),
(60, '1453213180002023-11-26ZS45', 'CID20231126-1', 'MID-20230508-2', 1, '300', '300', '2023-11-27', '08:35:00', '', 3, 1, '2023-11-26'),
(61, '1175795038002023-11-26ZS45', 'CID20231126-1', 'MID-20230508-2', 1, '300', '300', '2023-11-26', '17:39:00', '', 3, 1, '2023-11-26'),
(62, '1352780476002023-11-26ZS50', 'CID20231126-5', 'MID20231111-6', 1, '250', '250', '2023-11-28', '09:06:00', '', 1, 1, '2023-11-26'),
(63, '67372006002023-11-27ZS52', 'CID20231127-7', 'MID-20230725-4', 1, '250', '250', '2023-11-28', '15:00:00', '', 1, 1, '2023-11-27'),
(64, '67372006002023-11-27ZS52', 'CID20231127-7', 'MID-20230508-2', 1, '300', '300', '2023-11-28', '15:00:00', '', 1, 1, '2023-11-27'),
(65, '633118916002023-11-27ZS55', 'CID20231127-10', 'MID-20230508-3', 1, '250', '250', '2023-11-27', '15:15:00', '', 3, 1, '2023-11-27'),
(66, '1708655653002023-11-27ZS54', 'CID20231127-9', 'MID-20230508-1', 1, '250', '250', '2023-11-28', '17:56:00', '', 3, 1, '2023-11-27'),
(67, '863019497002023-11-28ZS82', 'CID20231128-37', 'MID20231111-6', 1, '700', '700', '2023-11-28', '07:53:00', '', 0, 1, '2023-11-28'),
(68, '1547868071002023-11-28ZS45', 'CID20231126-1', 'MID-20230827-5', 1, '750', '750', '2023-11-28', '13:00:00', '', 3, 1, '2023-11-28'),
(69, '1467179213002023-11-28ZS87', 'CID20231128-42', 'MID20231128-12', 1, '300', '300', '2023-11-29', '08:44:00', '', 0, 1, '2023-11-28');

-- --------------------------------------------------------

--
-- Table structure for table `paluwagan`
--

CREATE TABLE `paluwagan` (
  `id` int(11) NOT NULL,
  `seq` int(11) NOT NULL,
  `paluwagan_ID` varchar(100) NOT NULL,
  `paluwagan` text NOT NULL,
  `description` text NOT NULL,
  `price` text NOT NULL,
  `monthly` int(11) NOT NULL,
  `number_months` int(11) NOT NULL,
  `number_members` int(11) NOT NULL,
  `penalty` text NOT NULL,
  `image` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0=pending, 1=approved, 2=canceled, 3=started, 4=completed',
  `date_entry` date NOT NULL,
  `date_started` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `paluwagan`
--

INSERT INTO `paluwagan` (`id`, `seq`, `paluwagan_ID`, `paluwagan`, `description`, `price`, `monthly`, `number_months`, `number_members`, `penalty`, `image`, `status`, `date_entry`, `date_started`) VALUES
(14, 2, 'PLID-20231124-2', 'Paluwagan 2', '2 Rounded Cake (Choco and Vanilla Flavor),  1 Bilao of Spaguetti, 12 pcs Buttered Chicken,  12 pcs Lumpiang Shanghai,  12 pcs Fried Chicken, 2 Bilao of mixed kakanin (puto cheese , and kutsinta), and 1 Bilao of Puto.', '5000', 1000, 5, 5, '100', 'IMG-655fb23e2fd119.87390519.jpg', 1, '2023-11-24', '0000-00-00'),
(15, 3, 'PLID-20231124-3', 'Paluwagan 1', '1 Rounded Cake, 1 Kakanin, 1 Mixed Kakanin w/ Buchi, 15 pieces Puto,12 pieces Fried Chicken, 12 pieces Buttered Chicken, 15 pieces Lumpiang Shanghai, 1 Bilao Pansit Bihon and 1 Bilao of spaquetti.', '4000', 800, 5, 5, '80', 'IMG-655fb472d485f1.21313448.jpg', 1, '2023-11-24', '0000-00-00'),
(16, 4, 'PLID-20231124-4', 'Paluwagan 3', '1 Rounded Cake, 1 Kakanin, 1 Mixed Kakanin w/ Buchi, 15 pieces Puto,12 pieces Fried Chicken, 12 pieces Buttered Chicken,24 pieces Lumpiang Shanghai, 1 Bilao Pansit Bihon and 1 Bilao Spaguetti.', '5000', 1000, 5, 5, '100', 'IMG-655fb4cc33f366.81983016.jpg', 3, '2023-11-24', '2023-11-28'),
(17, 5, 'PLID-20231124-5', 'Paluwagan 4', '2 Rounded Cake (Choco and Vanilla Flavor),  1 Bilao of Spaguetti, 12 pcs Buttered Chicken,  12 pcs Lumpiang Shanghai,  12 pcs Fried Chicken, 2 Bilao of mixed kakanin (puto cheese , and kutsinta), and 1 Bilao of Puto.', '6000', 1200, 5, 5, '120', 'IMG-655fbe47101bd2.55797301.jpg', 3, '2023-11-24', '2023-11-28');

-- --------------------------------------------------------

--
-- Table structure for table `paluwagan_member`
--

CREATE TABLE `paluwagan_member` (
  `id` int(11) NOT NULL,
  `seq` int(11) NOT NULL,
  `paluwagan_member_ID` varchar(100) NOT NULL,
  `paluwagan_ID` varchar(100) NOT NULL,
  `customer_ID` varchar(100) NOT NULL,
  `date_pickup` text NOT NULL,
  `month` text NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0=pending, 1=approved',
  `balance` text NOT NULL,
  `terms_condition` tinyint(1) NOT NULL,
  `date_entry` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `paluwagan_member`
--

INSERT INTO `paluwagan_member` (`id`, `seq`, `paluwagan_member_ID`, `paluwagan_ID`, `customer_ID`, `date_pickup`, `month`, `status`, `balance`, `terms_condition`, `date_entry`) VALUES
(26, 2, 'PMID20231126-2', 'PLID-20231124-5', 'CID20231126-3', '2023-12-25', '12-2023', 1, '6000', 1, '2023-11-26'),
(27, 3, 'PMID20231126-3', 'PLID-20231124-5', 'CID20231126-4', '2024-01-06', '01-2024', 1, '6000', 1, '2023-11-26'),
(28, 4, 'PMID20231126-4', 'PLID-20231124-5', 'CID20231126-5', '2024-02-22', '02-2024', 1, '4800', 1, '2023-11-26'),
(29, 5, 'PMID20231126-5', 'PLID-20231124-5', 'CID20231126-6', '2024-04-12', '04-2024', 1, '6000', 1, '2023-11-26'),
(30, 6, 'PMID20231128-6', 'PLID-20231124-4', 'CID20231127-7', '2023-11-29', '11-2023', 1, '5000', 1, '2023-11-28'),
(31, 7, 'PMID20231128-7', 'PLID-20231124-4', 'CID20231127-9', '2024-01-01', '01-2024', 1, '5000', 1, '2023-11-28'),
(32, 8, 'PMID20231128-8', 'PLID-20231124-4', 'CID20231127-10', '2024-02-28', '02-2024', 1, '5000', 1, '2023-11-28'),
(33, 9, 'PMID20231128-9', 'PLID-20231124-4', 'CID20231127-11', '2024-03-28', '03-2024', 1, '5000', 1, '2023-11-28'),
(34, 10, 'PMID20231128-10', 'PLID-20231124-3', 'CID20231127-13', '2023-11-29', '11-2023', 1, '4000', 1, '2023-11-28'),
(35, 11, 'PMID20231128-11', 'PLID-20231124-3', 'CID20231127-16', '2024-01-01', '01-2024', 1, '4000', 1, '2023-11-28'),
(36, 12, 'PMID20231128-12', 'PLID-20231124-3', 'CID20231127-15', '2024-02-07', '02-2024', 1, '4000', 1, '2023-11-28'),
(37, 13, 'PMID20231128-13', 'PLID-20231124-4', 'CID20231127-17', '2023-12-07', '12-2023', 1, '5000', 1, '2023-11-28'),
(38, 14, 'PMID20231128-14', 'PLID-20231124-5', 'CID20231128-42', '2024-03-04', '03-2024', 1, '0', 1, '2023-11-28');

-- --------------------------------------------------------

--
-- Table structure for table `paluwagan_schedule`
--

CREATE TABLE `paluwagan_schedule` (
  `id` int(11) NOT NULL,
  `paluwagan_ID` varchar(100) NOT NULL,
  `customer_ID` varchar(100) NOT NULL,
  `paid` tinyint(1) NOT NULL,
  `duedate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `paluwagan_schedule`
--

INSERT INTO `paluwagan_schedule` (`id`, `paluwagan_ID`, `customer_ID`, `paid`, `duedate`) VALUES
(1136, 'PLID-20231124-5', 'CID20231126-3', 0, '2023-12-28'),
(1137, 'PLID-20231124-5', 'CID20231126-3', 0, '2024-01-28'),
(1138, 'PLID-20231124-5', 'CID20231126-3', 0, '2024-02-28'),
(1139, 'PLID-20231124-5', 'CID20231126-3', 0, '2024-03-28'),
(1140, 'PLID-20231124-5', 'CID20231126-3', 0, '2024-04-28'),
(1141, 'PLID-20231124-5', 'CID20231126-4', 0, '2023-12-28'),
(1142, 'PLID-20231124-5', 'CID20231126-4', 0, '2024-01-28'),
(1143, 'PLID-20231124-5', 'CID20231126-4', 0, '2024-02-28'),
(1144, 'PLID-20231124-5', 'CID20231126-4', 0, '2024-03-28'),
(1145, 'PLID-20231124-5', 'CID20231126-4', 0, '2024-04-28'),
(1146, 'PLID-20231124-5', 'CID20231126-5', 0, '2023-12-28'),
(1147, 'PLID-20231124-5', 'CID20231126-5', 0, '2024-01-28'),
(1148, 'PLID-20231124-5', 'CID20231126-5', 0, '2024-02-28'),
(1149, 'PLID-20231124-5', 'CID20231126-5', 0, '2024-03-28'),
(1150, 'PLID-20231124-5', 'CID20231126-5', 0, '2024-04-28'),
(1151, 'PLID-20231124-5', 'CID20231126-6', 0, '2023-12-28'),
(1152, 'PLID-20231124-5', 'CID20231126-6', 0, '2024-01-28'),
(1153, 'PLID-20231124-5', 'CID20231126-6', 0, '2024-02-28'),
(1154, 'PLID-20231124-5', 'CID20231126-6', 0, '2024-03-28'),
(1155, 'PLID-20231124-5', 'CID20231126-6', 0, '2024-04-28'),
(1156, 'PLID-20231124-5', 'CID20231128-42', 1, '2023-12-28'),
(1157, 'PLID-20231124-5', 'CID20231128-42', 1, '2024-01-28'),
(1158, 'PLID-20231124-5', 'CID20231128-42', 1, '2024-02-28'),
(1159, 'PLID-20231124-5', 'CID20231128-42', 1, '2024-03-28'),
(1160, 'PLID-20231124-5', 'CID20231128-42', 1, '2024-04-28'),
(1161, 'PLID-20231124-4', 'CID20231127-7', 0, '2023-12-28'),
(1162, 'PLID-20231124-4', 'CID20231127-7', 0, '2024-01-28'),
(1163, 'PLID-20231124-4', 'CID20231127-7', 0, '2024-02-28'),
(1164, 'PLID-20231124-4', 'CID20231127-7', 0, '2024-03-28'),
(1165, 'PLID-20231124-4', 'CID20231127-7', 0, '2024-04-28'),
(1166, 'PLID-20231124-4', 'CID20231127-9', 0, '2023-12-28'),
(1167, 'PLID-20231124-4', 'CID20231127-9', 0, '2024-01-28'),
(1168, 'PLID-20231124-4', 'CID20231127-9', 0, '2024-02-28'),
(1169, 'PLID-20231124-4', 'CID20231127-9', 0, '2024-03-28'),
(1170, 'PLID-20231124-4', 'CID20231127-9', 0, '2024-04-28'),
(1171, 'PLID-20231124-4', 'CID20231127-10', 0, '2023-12-28'),
(1172, 'PLID-20231124-4', 'CID20231127-10', 0, '2024-01-28'),
(1173, 'PLID-20231124-4', 'CID20231127-10', 0, '2024-02-28'),
(1174, 'PLID-20231124-4', 'CID20231127-10', 0, '2024-03-28'),
(1175, 'PLID-20231124-4', 'CID20231127-10', 0, '2024-04-28'),
(1176, 'PLID-20231124-4', 'CID20231127-11', 0, '2023-12-28'),
(1177, 'PLID-20231124-4', 'CID20231127-11', 0, '2024-01-28'),
(1178, 'PLID-20231124-4', 'CID20231127-11', 0, '2024-02-28'),
(1179, 'PLID-20231124-4', 'CID20231127-11', 0, '2024-03-28'),
(1180, 'PLID-20231124-4', 'CID20231127-11', 0, '2024-04-28'),
(1181, 'PLID-20231124-4', 'CID20231127-17', 0, '2023-12-28'),
(1182, 'PLID-20231124-4', 'CID20231127-17', 0, '2024-01-28'),
(1183, 'PLID-20231124-4', 'CID20231127-17', 0, '2024-02-28'),
(1184, 'PLID-20231124-4', 'CID20231127-17', 0, '2024-03-28'),
(1185, 'PLID-20231124-4', 'CID20231127-17', 0, '2024-04-28');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `seq` int(11) NOT NULL,
  `payment_ID` varchar(100) NOT NULL,
  `paluwagan_ID` varchar(100) NOT NULL,
  `customer_ID` varchar(100) NOT NULL,
  `amount` text NOT NULL,
  `monthly` text NOT NULL,
  `penalty` text NOT NULL,
  `duedate` date NOT NULL,
  `mop` varchar(100) NOT NULL,
  `date_entry` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `seq`, `payment_ID`, `paluwagan_ID`, `customer_ID`, `amount`, `monthly`, `penalty`, `duedate`, `mop`, `date_entry`) VALUES
(24, 1, 'PID20231127-1', 'PLID-20231124-5', 'CID20231126-5', '1200', '1200', '0', '0000-00-00', 'w', '2023-11-27'),
(25, 2, 'PID20231128-2', 'PLID-20231124-5', 'CID20231128-42', '3600', '1200', '0', '2023-12-28', 'o', '2023-11-28'),
(26, 3, 'PID20231128-3', 'PLID-20231124-5', 'CID20231128-42', '2400', '1200', '0', '2023-12-28', 'o', '2023-11-28');

-- --------------------------------------------------------

--
-- Table structure for table `payment_request`
--

CREATE TABLE `payment_request` (
  `id` int(11) NOT NULL,
  `seq` int(11) NOT NULL,
  `payment_ID` varchar(100) NOT NULL,
  `paluwagan_ID` varchar(100) NOT NULL,
  `customer_ID` varchar(100) NOT NULL,
  `subTotal` text NOT NULL,
  `amount` text NOT NULL,
  `monthly` text NOT NULL,
  `penalty` text NOT NULL,
  `nom` int(11) NOT NULL COMMENT 'Number of Month',
  `duedate` date NOT NULL,
  `image` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0=pending, 1=approved, 2=cancel, 3=completed',
  `date_entry` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `payment_request`
--

INSERT INTO `payment_request` (`id`, `seq`, `payment_ID`, `paluwagan_ID`, `customer_ID`, `subTotal`, `amount`, `monthly`, `penalty`, `nom`, `duedate`, `image`, `status`, `date_entry`) VALUES
(27, 2, 'PID20231128-2', 'PLID-20231124-5', 'CID20231128-42', '3600', '3600', '1200', '0', 3, '2023-12-28', '5936-gcash-sample.jpg', 1, '2023-11-28'),
(28, 3, 'PID20231128-3', 'PLID-20231124-5', 'CID20231128-42', '2400', '2400', '1200', '0', 2, '2023-12-28', '7281-gcash-sample.jpg', 1, '2023-11-28');

-- --------------------------------------------------------

--
-- Table structure for table `province`
--

CREATE TABLE `province` (
  `id` int(11) NOT NULL,
  `province` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `province`
--

INSERT INTO `province` (`id`, `province`) VALUES
(1, 'Zamboanga Sibugay');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `seq` int(11) NOT NULL,
  `order_number` int(11) NOT NULL,
  `payment_ID` varchar(100) NOT NULL,
  `customer_ID` varchar(100) NOT NULL,
  `product` varchar(100) NOT NULL,
  `price` text NOT NULL,
  `qty` int(11) NOT NULL,
  `amount` text NOT NULL,
  `mop` text NOT NULL,
  `sales_cat` text NOT NULL,
  `date_entry` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `seq`, `order_number`, `payment_ID`, `customer_ID`, `product`, `price`, `qty`, `amount`, `mop`, `sales_cat`, `date_entry`) VALUES
(44, 1, 0, 'PID20231126-1', 'CID20231126-1', 'MID-20230508-2', '300', 1, '300', 'o', 'o', '2023-11-26'),
(45, 1, 0, 'PID20231127-1', 'CID20231127-10', 'MID-20230508-3', '250', 1, '250', 'o', 'o', '2023-11-27'),
(46, 1, 0, 'PID20231127-1', 'CID20231126-1', 'MID-20230508-2', '300', 1, '300', 'o', 'o', '2023-11-27'),
(47, 0, 0, 'PID20231127-1', '', 'PLID-20231124-5', '1200', 1, '1200', 'w', 'p', '2023-11-27'),
(48, 2, 0, 'PID20231128-2', 'CID20231127-9', 'MID-20230508-1', '250', 1, '250', 'o', 'o', '2023-11-28'),
(49, 2, 0, 'PID20231128-2', 'CID20231126-1', 'MID-20230827-5', '750', 1, '750', 'o', 'o', '2023-11-28'),
(50, 2, 0, 'PID20231128-2', '', 'PLID-20231124-5', '1200', 3, '3600', 'o', 'p', '2023-11-28'),
(51, 3, 0, 'PID20231128-3', '', 'PLID-20231124-5', '1200', 2, '2400', 'o', 'p', '2023-11-28');

-- --------------------------------------------------------

--
-- Table structure for table `slider_image`
--

CREATE TABLE `slider_image` (
  `id` int(11) NOT NULL,
  `iname` text NOT NULL,
  `image` text NOT NULL,
  `date_entry` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `slider_image`
--

INSERT INTO `slider_image` (`id`, `iname`, `image`, `date_entry`) VALUES
(1, 'image1', 'slide1.jpg', '2023-07-26'),
(2, 'image2', 'slide2.jpg', '0000-00-00'),
(3, 'image3', 'slide3.jpg', '2023-07-26'),
(4, 'puto', 'puto.pmg', '2023-07-26');

-- --------------------------------------------------------

--
-- Table structure for table `terms_condition`
--

CREATE TABLE `terms_condition` (
  `id` int(11) NOT NULL,
  `type` text NOT NULL,
  `terms_condition` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_entry` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `terms_condition`
--

INSERT INTO `terms_condition` (`id`, `type`, `terms_condition`, `status`, `date_entry`) VALUES
(7, 'Ordering', 'Ordering terms and conditions.pdf', 1, '2023-11-10'),
(8, 'Paluwagan', 'Paluwagan terms and conditions.pdf', 1, '2023-11-10'),
(9, 'Registration', 'terms-and-conditions-Registration.pdf', 1, '2023-11-28');

-- --------------------------------------------------------

--
-- Table structure for table `type_id`
--

CREATE TABLE `type_id` (
  `id` int(11) NOT NULL,
  `type_id` text NOT NULL,
  `type` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `type_id`
--

INSERT INTO `type_id` (`id`, `type_id`, `type`) VALUES
(1, 'Driver\'s Lincense', 1),
(2, 'PhilHealth', 0),
(3, 'UMID', 0),
(4, 'TIN ID', 0),
(5, 'Senior Citizen', 0),
(6, 'National ID', 0),
(7, 'PWD', 0),
(8, 'Passport', 1),
(9, 'Postal ID', 1),
(10, 'NBI Clearance', 1),
(11, 'PRC ID', 1),
(12, 'OWWA OFW e-Card', 1);

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

CREATE TABLE `userinfo` (
  `id` int(11) NOT NULL,
  `fullName` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `userinfo`
--

INSERT INTO `userinfo` (`id`, `fullName`, `username`, `password`) VALUES
(1, 'Administrator', 'admin1', 'admin1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addtocart`
--
ALTER TABLE `addtocart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barangay`
--
ALTER TABLE `barangay`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `checker`
--
ALTER TABLE `checker`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `counter_table`
--
ALTER TABLE `counter_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_identification`
--
ALTER TABLE `customer_identification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delinquent_customer`
--
ALTER TABLE `delinquent_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gender`
--
ALTER TABLE `gender`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_ratings`
--
ALTER TABLE `menu_ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `municipality`
--
ALTER TABLE `municipality`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mycart`
--
ALTER TABLE `mycart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notif`
--
ALTER TABLE `notif`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paluwagan`
--
ALTER TABLE `paluwagan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paluwagan_member`
--
ALTER TABLE `paluwagan_member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paluwagan_schedule`
--
ALTER TABLE `paluwagan_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_request`
--
ALTER TABLE `payment_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `province`
--
ALTER TABLE `province`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider_image`
--
ALTER TABLE `slider_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terms_condition`
--
ALTER TABLE `terms_condition`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type_id`
--
ALTER TABLE `type_id`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userinfo`
--
ALTER TABLE `userinfo`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addtocart`
--
ALTER TABLE `addtocart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `barangay`
--
ALTER TABLE `barangay`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=178;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `checker`
--
ALTER TABLE `checker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `counter_table`
--
ALTER TABLE `counter_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `customer_address`
--
ALTER TABLE `customer_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `customer_identification`
--
ALTER TABLE `customer_identification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `delinquent_customer`
--
ALTER TABLE `delinquent_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=302;

--
-- AUTO_INCREMENT for table `gender`
--
ALTER TABLE `gender`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `menu_ratings`
--
ALTER TABLE `menu_ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `municipality`
--
ALTER TABLE `municipality`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mycart`
--
ALTER TABLE `mycart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `notif`
--
ALTER TABLE `notif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1130;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `paluwagan`
--
ALTER TABLE `paluwagan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `paluwagan_member`
--
ALTER TABLE `paluwagan_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `paluwagan_schedule`
--
ALTER TABLE `paluwagan_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1186;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `payment_request`
--
ALTER TABLE `payment_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `province`
--
ALTER TABLE `province`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `slider_image`
--
ALTER TABLE `slider_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `terms_condition`
--
ALTER TABLE `terms_condition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `type_id`
--
ALTER TABLE `type_id`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `userinfo`
--
ALTER TABLE `userinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
