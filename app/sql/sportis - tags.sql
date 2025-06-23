-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2025 at 05:24 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

DROP SCHEMA sportis;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sportis`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `creator_id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL,
  `max_participants` int(11) NOT NULL,
  `event_time_start` datetime NOT NULL,
  `event_time_end` datetime DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `creator_id`, `field_id`, `max_participants`, `event_time_start`, `event_time_end`, `description`) VALUES
(1, 'Meci demonstrativ', 9, 134, 100, '2025-06-25 10:01:00', '2025-06-25 14:30:00', 'Eveniment caritabil. Meci de tenis demonstrativ. '),
(2, 'Meci de fotbal U22', 9, 275, 12, '2025-06-22 20:00:00', '2025-06-22 23:00:00', 'Meci de fotbal');

-- --------------------------------------------------------

--
-- Table structure for table `event_participants`
--

CREATE TABLE `event_participants` (
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `join_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_participants`
--

INSERT INTO `event_participants` (`event_id`, `user_id`, `join_date`) VALUES
(1, 9, '2025-06-22 06:09:22'),
(11, 9, '2025-06-22 03:03:49'),
(12, 9, '2025-06-22 04:13:59'),
(32, 9, '2025-06-22 05:30:22');

-- --------------------------------------------------------

--
-- Table structure for table `event_tags`
--

CREATE TABLE `event_tags` (
  `event_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_tags`
--

INSERT INTO `event_tags` (`event_id`, `tag_id`) VALUES
(1, 3),
(1, 20),
(1, 26),
(1, 59),
(1, 63),
(1, 80),
(1, 85),
(1, 86),
(2, 1),
(2, 18),
(2, 25),
(2, 60),
(2, 62),
(2, 63),
(2, 73),
(11, 2),
(11, 3),
(11, 4),
(11, 5),
(11, 6),
(12, 7),
(17, 4),
(17, 7),
(23, 10),
(32, 3),
(32, 4),
(32, 7);

-- --------------------------------------------------------

--
-- Table structure for table `friendships`
--

CREATE TABLE `friendships` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL,
  `status` enum('pending','accepted','rejected') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `friendships`
--

INSERT INTO `friendships` (`id`, `user_id`, `friend_id`, `status`, `created_at`) VALUES
(15, 9, 1, 'accepted', '2025-06-21 01:50:22'),
(25, 8, 9, 'accepted', '2025-06-21 19:08:49');

-- --------------------------------------------------------

--
-- Table structure for table `sports_fields`
--

CREATE TABLE `sports_fields` (
  `id` int(11) NOT NULL,
  `osm_id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `lat` decimal(9,6) DEFAULT NULL,
  `lon` decimal(9,6) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `sport` varchar(255) DEFAULT NULL,
  `surface` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sports_fields`
--

INSERT INTO `sports_fields` (`id`, `osm_id`, `type`, `lat`, `lon`, `name`, `sport`, `surface`) VALUES
(1, 30343034, 'way', 47.151208, 27.589399, NULL, NULL, NULL),
(2, 30726812, 'way', 47.153750, 27.586420, 'Parcul Regina Maria a României', NULL, NULL),
(3, 32534143, 'way', 47.099762, 26.920877, 'Parcul dendrologic al Castelului Sturdza', NULL, NULL),
(4, 35829588, 'way', 47.142447, 27.579969, 'Esplanada Nicolina 1', NULL, NULL),
(5, 41825992, 'way', 47.209338, 27.013687, 'Parc Inginer Dan Dumitrachi', NULL, NULL),
(6, 42509704, 'way', 47.146290, 27.593142, NULL, NULL, NULL),
(7, 42725587, 'way', 47.158065, 27.612731, 'Esplanada Oancea', NULL, NULL),
(8, 42725588, 'way', 47.158309, 27.611761, NULL, NULL, NULL),
(9, 43623888, 'way', 47.155441, 27.611569, NULL, 'soccer', NULL),
(10, 43624000, 'way', 47.155192, 27.611475, NULL, 'soccer', NULL),
(11, 43624001, 'way', 47.154068, 27.608762, NULL, 'soccer', NULL),
(12, 43624160, 'way', 47.154777, 27.617391, 'Parcul Ciurchi', NULL, NULL),
(13, 43995982, 'way', 47.191946, 27.559151, NULL, 'tennis', NULL),
(14, 43995983, 'way', 47.192403, 27.559153, NULL, 'multi', NULL),
(15, 43995984, 'way', 47.192695, 27.558542, NULL, 'multi', NULL),
(16, 43995994, 'way', 47.191712, 27.560296, 'Gorun Sandu-Ville', 'rugby', 'grass'),
(17, 44367869, 'way', 47.155451, 27.610240, NULL, NULL, NULL),
(18, 44840912, 'way', 47.153577, 27.611157, NULL, 'soccer', NULL),
(19, 45357950, 'way', 47.159402, 27.614256, NULL, 'basketball', NULL),
(20, 46036165, 'way', 47.190312, 27.558497, NULL, NULL, NULL),
(21, 46036242, 'way', 47.190803, 27.559309, NULL, NULL, NULL),
(22, 46036310, 'way', 47.187921, 27.561600, NULL, NULL, NULL),
(23, 46039231, 'way', 47.185756, 27.562109, NULL, NULL, NULL),
(24, 46039246, 'way', 47.185067, 27.562702, NULL, NULL, NULL),
(25, 46039262, 'way', 47.185956, 27.563008, NULL, NULL, NULL),
(26, 46039263, 'way', 47.184068, 27.563501, NULL, NULL, NULL),
(27, 46096212, 'way', 47.160910, 27.592725, 'Parcul Anastasie Panu', NULL, NULL),
(28, 46244999, 'way', 47.180431, 27.569383, NULL, 'multi', 'artificial_turf'),
(29, 46248141, 'way', 47.142532, 27.580804, 'Esplanada Nicolina 2', NULL, NULL),
(30, 47451647, 'way', 47.171054, 27.561683, 'Parcul Octav Băncilă', NULL, NULL),
(31, 48247275, 'way', 47.165236, 27.578557, 'Parcul Junimea', NULL, NULL),
(32, 48994455, 'way', 47.163527, 27.591464, 'Parcul Woodrow Wilson', NULL, NULL),
(33, 49038830, 'way', 47.169770, 27.575687, NULL, NULL, NULL),
(34, 49039760, 'way', 47.175884, 27.571060, 'Parcul Titu Maiorescu', NULL, NULL),
(35, 50720070, 'way', 47.168689, 27.549729, NULL, NULL, NULL),
(36, 53774858, 'way', 47.195855, 27.410669, NULL, NULL, NULL),
(37, 59642183, 'way', 47.185684, 27.559353, 'Zonă agrement copii', 'skateboard', NULL),
(38, 61750051, 'way', 47.177821, 27.569511, 'Parcul Copou', NULL, NULL),
(39, 62102724, 'way', 47.153401, 27.611900, 'Grădinari', 'skating', NULL),
(40, 63063206, 'way', 47.155530, 27.610786, NULL, 'basketball', NULL),
(41, 70807144, 'way', 46.909123, 27.334683, 'Parc dendrologic', NULL, NULL),
(42, 75079698, 'way', 47.165163, 27.601846, 'Parc Sfintii Voievozi-Rosca', NULL, NULL),
(43, 78389946, 'way', 47.161761, 27.605749, 'MCH Tenis Pro', 'tennis', NULL),
(44, 91902791, 'way', 47.128145, 27.619115, NULL, NULL, NULL),
(45, 103674847, 'way', 47.186046, 27.562462, 'Parcul Expoziției', NULL, NULL),
(46, 105044933, 'way', 47.289210, 27.677434, NULL, NULL, NULL),
(47, 107303314, 'way', 47.145333, 27.581279, NULL, NULL, NULL),
(48, 112654325, 'way', 47.154289, 27.610908, NULL, 'tennis', NULL),
(49, 114285096, 'way', 47.212498, 27.598009, NULL, 'shooting', NULL),
(50, 114310072, 'way', 47.215208, 27.594484, 'Baza Nautică Dorobanț', 'canoe', NULL),
(51, 120386351, 'way', 47.149922, 27.596004, NULL, 'tennis', NULL),
(52, 138713564, 'way', 47.127316, 27.566898, NULL, NULL, NULL),
(53, 167900155, 'way', 47.106780, 27.715696, NULL, NULL, NULL),
(54, 173498886, 'way', 47.175131, 27.572163, 'Piata Universității', NULL, NULL),
(55, 175017449, 'way', 47.169070, 27.580437, 'Piața Independenței', NULL, NULL),
(56, 176853488, 'way', 47.160436, 27.483947, NULL, 'soccer', NULL),
(57, 184735908, 'way', 47.220615, 27.636983, NULL, NULL, NULL),
(58, 184938708, 'way', 47.182483, 27.598059, NULL, 'soccer', NULL),
(59, 184938709, 'way', 47.181439, 27.598435, NULL, 'tennis', 'clay'),
(60, 184946632, 'way', 47.181567, 27.600462, 'cățărare în copaci', NULL, NULL),
(61, 184946638, 'way', 47.183003, 27.598772, 'paintball', NULL, NULL),
(62, 184951551, 'way', 47.181630, 27.599105, 'cățărare pe zid (in constr)', 'climbing', NULL),
(63, 202238051, 'way', 47.170220, 27.576238, 'Parcul Voievozilor', NULL, NULL),
(64, 204728805, 'way', 47.166572, 27.546138, 'Parc Dacia', NULL, NULL),
(65, 205032682, 'way', 47.163340, 27.560540, 'Piața Voievozilor', NULL, NULL),
(66, 205241925, 'way', 47.163677, 27.599005, NULL, 'tennis', NULL),
(67, 205377668, 'way', 47.177025, 27.598254, NULL, NULL, NULL),
(68, 205687202, 'way', 47.160247, 27.624843, NULL, NULL, NULL),
(69, 205833414, 'way', 47.187769, 27.599784, NULL, NULL, NULL),
(70, 205835062, 'way', 47.185053, 27.602864, NULL, NULL, NULL),
(71, 206249236, 'way', 47.135293, 27.591020, NULL, NULL, NULL),
(72, 206522706, 'way', 47.171819, 27.576234, 'Parcul Casei Pogor', NULL, NULL),
(73, 206525147, 'way', 47.173737, 27.573299, NULL, NULL, NULL),
(74, 206564399, 'way', 47.159866, 27.594373, NULL, 'soccer', NULL),
(75, 206570418, 'way', 47.160061, 27.594227, 'Parcul Grigore Ghica Vodă', NULL, NULL),
(76, 206579642, 'way', 47.183828, 27.568190, NULL, 'swimming', NULL),
(77, 206650202, 'way', 47.190782, 27.558709, 'Rond Agronomie', NULL, NULL),
(78, 206701713, 'way', 47.184184, 27.558383, NULL, 'soccer', NULL),
(79, 206701716, 'way', 47.184155, 27.556837, NULL, 'soccer', NULL),
(80, 206701723, 'way', 47.183503, 27.557387, NULL, 'soccer', NULL),
(81, 206748711, 'way', 47.180700, 27.559580, NULL, 'tennis', NULL),
(82, 206748717, 'way', 47.180280, 27.556920, NULL, 'soccer', NULL),
(83, 206764975, 'way', 47.183145, 27.559267, NULL, 'tennis', NULL),
(84, 206832639, 'way', 47.174193, 27.569764, 'Teren handbal Liceul Negruzzi', 'handball', NULL),
(85, 206832641, 'way', 47.173945, 27.569102, 'Teren fotbal Liceul Negruzzi', 'soccer', NULL),
(86, 206834092, 'way', 47.174216, 27.568886, 'Teren baschetbal Liceul Negruzzi', 'basketball', NULL),
(87, 206908864, 'way', 47.210163, 27.529643, NULL, NULL, NULL),
(88, 206982672, 'way', 47.198005, 27.554316, NULL, 'tennis', NULL),
(89, 206994507, 'way', 47.202509, 27.538361, NULL, 'tennis', NULL),
(90, 207084755, 'way', 47.180877, 27.570443, 'Baza sportiva a Universitatii de ARTE GEORGE ENESCU', 'tennis', NULL),
(91, 207114610, 'way', 47.173689, 27.582061, NULL, 'tennis', NULL),
(92, 207114611, 'way', 47.173754, 27.581510, NULL, 'handball', NULL),
(93, 207114613, 'way', 47.173386, 27.581994, NULL, NULL, NULL),
(94, 207223200, 'way', 47.167394, 27.588298, 'Terenul de sport al Liceului Economic nr. 1', NULL, 'asphalt'),
(95, 207226102, 'way', 47.201568, 27.540489, NULL, NULL, NULL),
(96, 207794110, 'way', 47.167795, 27.559987, NULL, 'soccer', NULL),
(97, 208127325, 'way', 47.137799, 27.594165, NULL, 'soccer', NULL),
(98, 208216041, 'way', 47.095905, 27.563331, NULL, 'soccer', NULL),
(99, 208260694, 'way', 47.135332, 27.613415, NULL, 'tennis', NULL),
(100, 208485743, 'way', 47.165982, 27.583539, NULL, 'tennis', NULL),
(101, 208490731, 'way', 47.131948, 27.608033, NULL, NULL, NULL),
(102, 208582503, 'way', 47.128469, 27.611986, NULL, 'tennis', NULL),
(103, 208606985, 'way', 47.140574, 27.601876, NULL, 'soccer', NULL),
(104, 208607005, 'way', 47.140219, 27.602405, NULL, 'soccer', NULL),
(105, 208768069, 'way', 47.118504, 27.632573, NULL, 'tennis', NULL),
(106, 208768071, 'way', 47.118318, 27.632148, NULL, 'tennis', NULL),
(107, 208976758, 'way', 47.121151, 27.623322, NULL, 'tennis', NULL),
(108, 208989311, 'way', 47.121994, 27.620949, NULL, 'tennis', NULL),
(109, 209075268, 'way', 47.113979, 27.620340, NULL, 'tennis', NULL),
(110, 209105582, 'way', 47.111778, 27.617311, NULL, NULL, NULL),
(111, 209248950, 'way', 47.113646, 27.624813, NULL, 'tennis', NULL),
(112, 209253247, 'way', 47.111005, 27.632778, NULL, 'tennis', NULL),
(113, 209258998, 'way', 47.110497, 27.634098, NULL, 'tennis', NULL),
(114, 209430029, 'way', 47.135675, 27.591952, NULL, NULL, NULL),
(115, 209999072, 'way', 47.176200, 27.578918, NULL, NULL, 'grass'),
(116, 210094012, 'way', 47.168276, 27.592851, NULL, 'tennis', NULL),
(117, 210215929, 'way', 47.183356, 27.570923, NULL, 'tennis', NULL),
(118, 210247153, 'way', 47.187370, 27.575924, NULL, 'table_tennis', NULL),
(119, 210255591, 'way', 47.203432, 27.549835, NULL, 'tennis', NULL),
(120, 210669153, 'way', 47.165303, 27.586323, NULL, 'soccer', 'asphalt'),
(121, 211047306, 'way', 47.169498, 27.575350, NULL, 'tennis', NULL),
(122, 211151182, 'way', 47.165216, 27.577511, NULL, NULL, NULL),
(123, 211203015, 'way', 47.171219, 27.569053, NULL, 'tennis', NULL),
(124, 211285026, 'way', 47.165982, 27.570238, NULL, NULL, NULL),
(125, 211359369, 'way', 47.173507, 27.561739, 'Terenul de fotbal', NULL, 'asphalt'),
(126, 211366363, 'way', 47.166764, 27.577644, NULL, 'basketball', NULL),
(127, 211367581, 'way', 47.162303, 27.609076, NULL, 'handball', NULL),
(128, 211367582, 'way', 47.162214, 27.610130, NULL, 'basketball', NULL),
(129, 211367583, 'way', 47.161674, 27.608928, NULL, NULL, NULL),
(130, 211367584, 'way', 47.162413, 27.609628, NULL, NULL, NULL),
(131, 212101436, 'way', 47.159479, 27.579085, NULL, 'tennis', NULL),
(132, 212101453, 'way', 47.159741, 27.579133, NULL, 'tennis', NULL),
(133, 212503393, 'way', 47.166566, 27.598150, NULL, NULL, NULL),
(134, 212785114, 'way', 47.175960, 27.563134, NULL, 'tennis', NULL),
(135, 212792569, 'way', 47.175816, 27.534587, NULL, 'tennis', NULL),
(136, 212792570, 'way', 47.175757, 27.535451, NULL, 'tennis', NULL),
(137, 212792571, 'way', 47.176099, 27.535288, NULL, 'tennis', NULL),
(138, 212792573, 'way', 47.176079, 27.535053, NULL, NULL, NULL),
(139, 212792574, 'way', 47.175440, 27.535536, NULL, 'tennis', NULL),
(140, 212792575, 'way', 47.175412, 27.535306, NULL, 'tennis', NULL),
(141, 212792576, 'way', 47.175732, 27.535219, NULL, NULL, NULL),
(142, 212797941, 'way', 47.176317, 27.530698, NULL, 'basketball', NULL),
(143, 212797962, 'way', 47.176137, 27.530691, NULL, 'soccer', NULL),
(144, 213126904, 'way', 47.169188, 27.510383, NULL, 'soccer', NULL),
(145, 213172452, 'way', 47.176789, 27.489327, NULL, 'tennis', NULL),
(146, 213172458, 'way', 47.174442, 27.498838, NULL, 'soccer', NULL),
(147, 213190990, 'way', 47.184593, 27.449127, NULL, NULL, NULL),
(148, 213570832, 'way', 47.143891, 27.598851, NULL, NULL, NULL),
(149, 213570836, 'way', 47.142145, 27.596824, NULL, 'tennis', NULL),
(150, 213570843, 'way', 47.142599, 27.596491, NULL, 'soccer', NULL),
(151, 213570844, 'way', 47.144049, 27.598226, NULL, 'soccer', NULL),
(152, 213906307, 'way', 47.177130, 27.521643, NULL, 'tennis', NULL),
(153, 214247460, 'way', 47.186354, 27.511747, NULL, 'tennis', NULL),
(154, 214809887, 'way', 47.154694, 27.600456, NULL, NULL, 'grass'),
(155, 215088503, 'way', 47.194907, 27.416356, NULL, NULL, NULL),
(156, 216227323, 'way', 47.212558, 27.272495, NULL, NULL, NULL),
(157, 216482268, 'way', 47.214650, 27.267820, NULL, 'tennis', NULL),
(158, 216504470, 'way', 47.149059, 27.628593, NULL, NULL, NULL),
(159, 216525814, 'way', 47.096662, 27.674040, NULL, 'soccer', 'rubber'),
(160, 217304150, 'way', 47.287630, 27.509150, NULL, 'soccer', NULL),
(161, 218149537, 'way', 47.080631, 27.883398, NULL, NULL, NULL),
(162, 219224548, 'way', 47.159812, 27.560128, NULL, 'tennis', NULL),
(163, 219224551, 'way', 47.159815, 27.559899, NULL, 'tennis', NULL),
(164, 219224553, 'way', 47.159489, 27.559902, NULL, 'tennis', NULL),
(165, 219224559, 'way', 47.159488, 27.560132, NULL, 'tennis', NULL),
(166, 219238148, 'way', 47.160771, 27.557484, 'Poligon tir cu arcul', 'archery', NULL),
(167, 219238156, 'way', 47.156333, 27.563608, NULL, 'tennis', NULL),
(168, 219376378, 'way', 47.308283, 27.086151, NULL, NULL, NULL),
(169, 219429352, 'way', 47.171969, 27.571905, 'Teren Facultatea de Educație Fizică UAIC', 'soccer', NULL),
(170, 219429373, 'way', 47.172113, 27.571543, 'Teren tenis UAIC', 'tennis', NULL),
(171, 219429416, 'way', 47.172605, 27.572434, 'Teren tenis UAIC', 'tennis', NULL),
(172, 219429579, 'way', 47.171942, 27.571834, 'Teren volei UAIC', 'volleyball', NULL),
(173, 219430058, 'way', 47.171958, 27.572103, 'Teren handbal UAIC', 'handball', NULL),
(174, 219430301, 'way', 47.171998, 27.572642, 'Teren baschetbal UAIC', 'basketball', NULL),
(175, 219434422, 'way', 47.480793, 26.861611, 'teren fotbal', 'soccer', NULL),
(176, 219434426, 'way', 47.491995, 26.850920, 'Parc Poieni', NULL, NULL),
(177, 220171860, 'way', 47.297704, 27.592355, NULL, NULL, NULL),
(178, 225097871, 'way', 47.076922, 27.419539, NULL, NULL, NULL),
(179, 227375466, 'way', 47.175857, 27.339816, NULL, 'soccer', NULL),
(180, 227757561, 'way', 47.209247, 27.013019, 'Parc Asirys', NULL, NULL),
(181, 227971815, 'way', 47.108556, 27.507988, NULL, NULL, NULL),
(182, 229845305, 'way', 46.936972, 27.819810, NULL, 'soccer', NULL),
(183, 232519355, 'way', 47.301899, 27.595274, NULL, 'soccer', NULL),
(184, 232541276, 'way', 47.197083, 27.392671, NULL, 'soccer', NULL),
(185, 240104985, 'way', 47.463455, 27.098314, 'Parcul Central', NULL, NULL),
(186, 240135991, 'way', 47.463212, 27.099041, 'Teren de fotbal', 'soccer', 'grass'),
(187, 242579129, 'way', 47.242647, 26.844767, 'Palatul Domnesc Al.I.Cuza', NULL, NULL),
(188, 243371396, 'way', 47.166597, 27.578745, NULL, 'basketball', NULL),
(189, 243628474, 'way', 47.114114, 27.558281, NULL, 'soccer', NULL),
(190, 243628475, 'way', 47.113934, 27.558491, NULL, 'soccer', NULL),
(191, 243628476, 'way', 47.114078, 27.558231, NULL, 'soccer', NULL),
(192, 246668280, 'way', 47.167390, 27.579515, 'Parcul Mitocul Maicilor', NULL, NULL),
(193, 249157072, 'way', 47.115012, 27.485560, NULL, 'tennis', NULL),
(194, 251306973, 'way', 47.210992, 27.061470, NULL, 'soccer', NULL),
(195, 261042026, 'way', 47.192599, 27.143646, NULL, 'soccer', NULL),
(196, 261826151, 'way', 47.072078, 27.431544, NULL, 'soccer', NULL),
(197, 284813252, 'way', 47.154037, 27.588442, NULL, 'soccer', NULL),
(198, 285191975, 'way', 47.166350, 27.581240, 'Parcul Stării Civile', NULL, NULL),
(199, 285191979, 'way', 47.167376, 27.574550, NULL, NULL, NULL),
(200, 285191997, 'way', 47.158535, 27.586404, NULL, NULL, NULL),
(201, 285192009, 'way', 47.162867, 27.580557, NULL, NULL, NULL),
(202, 288474045, 'way', 47.203319, 27.588077, NULL, NULL, NULL),
(203, 288474046, 'way', 47.203446, 27.587379, NULL, 'soccer', NULL),
(204, 289345111, 'way', 47.176116, 27.542467, NULL, 'soccer', NULL),
(205, 292028317, 'way', 47.150403, 27.581890, NULL, NULL, 'asphalt'),
(206, 292028360, 'way', 47.150247, 27.580976, NULL, NULL, 'asphalt'),
(207, 300653616, 'way', 47.165697, 27.595796, NULL, NULL, NULL),
(208, 302723956, 'way', 47.166063, 27.594370, NULL, NULL, NULL),
(209, 303523228, 'way', 47.150830, 27.583916, NULL, 'basketball', 'asphalt'),
(210, 303523230, 'way', 47.151045, 27.583803, NULL, NULL, 'asphalt'),
(211, 303523231, 'way', 47.151123, 27.583563, NULL, NULL, 'asphalt'),
(212, 303523598, 'way', 47.153144, 27.577995, NULL, NULL, 'asphalt'),
(213, 335340924, 'way', 47.149485, 27.587756, NULL, NULL, 'asphalt'),
(214, 343669499, 'way', 47.521009, 27.446607, NULL, NULL, NULL),
(215, 359377706, 'way', 47.427728, 26.898130, NULL, NULL, NULL),
(216, 436080479, 'way', 47.164940, 27.613264, NULL, 'rugby_union', 'grass'),
(217, 442737263, 'way', 47.144982, 27.622204, NULL, NULL, 'asphalt'),
(218, 487692996, 'way', 47.174729, 27.549816, NULL, NULL, NULL),
(219, 534447985, 'way', 47.110650, 27.631813, NULL, NULL, NULL),
(220, 534469492, 'way', 47.173368, 27.548422, NULL, NULL, NULL),
(221, 534469494, 'way', 47.172089, 27.548866, NULL, NULL, NULL),
(222, 534469496, 'way', 47.172089, 27.548866, NULL, NULL, NULL),
(223, 534471530, 'way', 47.173667, 27.544317, NULL, NULL, NULL),
(224, 537800969, 'way', 47.167667, 27.569550, NULL, 'soccer', 'asphalt'),
(225, 544108486, 'way', 47.105124, 27.539245, NULL, NULL, NULL),
(226, 544114505, 'way', 47.107960, 27.550952, NULL, NULL, NULL),
(227, 550410432, 'way', 47.158019, 26.906030, NULL, 'soccer', 'asphalt'),
(228, 585429454, 'way', 47.158419, 27.588162, 'Grădina Publică Palas', NULL, NULL),
(229, 587535394, 'way', 47.135509, 27.572409, NULL, NULL, NULL),
(230, 587711308, 'way', 47.135988, 27.575616, NULL, NULL, NULL),
(231, 587711321, 'way', 47.151041, 27.586154, NULL, NULL, NULL),
(232, 587711322, 'way', 47.158349, 27.589094, NULL, NULL, NULL),
(233, 587853976, 'way', 47.459475, 26.877634, 'Parc Deleni', NULL, NULL),
(234, 589193297, 'way', 47.430090, 26.900205, 'Parc Primăria Hârlău', NULL, NULL),
(235, 597921151, 'way', 47.142206, 27.574636, NULL, 'tennis', NULL),
(236, 622305991, 'way', 47.094773, 27.795994, NULL, NULL, NULL),
(237, 651555778, 'way', 47.180568, 27.525348, 'Cubic Village Park', NULL, NULL),
(238, 654308449, 'way', 46.962430, 27.921963, 'Teren de Fotbal Astra Răducaneni', 'soccer', 'grass'),
(239, 654313174, 'way', 46.956211, 27.946986, 'Parcul Dendrologic Răducăneni', NULL, NULL),
(240, 654313175, 'way', 46.960008, 27.937653, 'Teren de basket', 'basketball', 'concrete'),
(241, 654313176, 'way', 46.960241, 27.937855, 'Teren voley;Teren Voley', 'volleyball', 'concrete'),
(242, 654313177, 'way', 46.960137, 27.937766, 'teren tenis;Teren tenis', 'tennis', NULL),
(243, 654313178, 'way', 46.959843, 27.937502, 'Teren Handball', 'handball', 'concrete'),
(244, 654313179, 'way', 46.960448, 27.937298, 'Teren fotbal', 'soccer', 'grass'),
(245, 685622028, 'way', 47.149721, 27.578584, NULL, NULL, NULL),
(246, 691252194, 'way', 47.281243, 26.743530, NULL, NULL, NULL),
(247, 693753088, 'way', 47.256218, 26.702629, NULL, NULL, NULL),
(248, 693753089, 'way', 47.256588, 26.703811, NULL, NULL, NULL),
(249, 693753090, 'way', 47.256765, 26.703174, NULL, NULL, NULL),
(250, 696684243, 'way', 47.154264, 27.587345, NULL, NULL, NULL),
(251, 696684244, 'way', 47.153995, 27.587504, NULL, NULL, NULL),
(252, 706732627, 'way', 47.167538, 27.559680, NULL, 'soccer', NULL),
(253, 706732628, 'way', 47.167743, 27.560764, 'Teren Fotbal MAGIC Alexandru', 'soccer', NULL),
(254, 707072736, 'way', 47.169089, 27.556354, NULL, NULL, NULL),
(255, 723123240, 'way', 47.174579, 27.576887, NULL, NULL, NULL),
(256, 736378597, 'way', 47.086670, 27.654522, NULL, 'soccer', NULL),
(257, 736380307, 'way', 46.965373, 27.723208, NULL, NULL, NULL),
(258, 744363516, 'way', 47.377672, 27.505472, NULL, 'soccer', NULL),
(259, 770264774, 'way', 47.173167, 27.577912, NULL, NULL, NULL),
(260, 770264775, 'way', 47.169276, 27.576331, NULL, NULL, NULL),
(261, 771566253, 'way', 47.170290, 27.575012, 'Parcul BCU', NULL, NULL),
(262, 851883771, 'way', 47.170972, 27.337505, NULL, NULL, NULL),
(263, 866783848, 'way', 47.154270, 27.571399, NULL, NULL, NULL),
(264, 899096770, 'way', 47.148319, 27.595327, NULL, NULL, NULL),
(265, 927900705, 'way', 47.168876, 27.547375, NULL, NULL, NULL),
(266, 927900706, 'way', 47.167426, 27.548471, NULL, NULL, NULL),
(267, 930574897, 'way', 47.147024, 27.576491, NULL, NULL, NULL),
(268, 953643770, 'way', 47.247583, 26.725075, 'Parcul Peștișorul', NULL, NULL),
(269, 962096240, 'way', 47.188666, 27.513683, 'Tennis Club Smash', 'tennis', 'clay'),
(270, 966117009, 'way', 46.971394, 27.540360, NULL, 'tennis', NULL),
(271, 1000880844, 'way', 47.142416, 27.525259, NULL, 'soccer', NULL),
(272, 1009969808, 'way', 47.145590, 27.583045, NULL, NULL, NULL),
(273, 1027361122, 'way', 47.176865, 27.495132, NULL, 'soccer', NULL),
(274, 1036212342, 'way', 47.245496, 26.722707, NULL, NULL, NULL),
(275, 1065776465, 'way', 47.158054, 27.631934, NULL, 'soccer', 'grass'),
(276, 1066962096, 'way', 47.145383, 27.575648, NULL, NULL, NULL),
(277, 1068401943, 'way', 47.207162, 27.013908, NULL, NULL, NULL),
(278, 1068401944, 'way', 47.207338, 27.013784, NULL, NULL, NULL),
(279, 1068404785, 'way', 47.218984, 27.005362, NULL, 'soccer', NULL),
(280, 1069563168, 'way', 47.145817, 27.577881, NULL, NULL, NULL),
(281, 1130989616, 'way', 47.181631, 27.515284, NULL, NULL, NULL),
(282, 1131202546, 'way', 47.122220, 27.554999, NULL, NULL, NULL),
(283, 1131202548, 'way', 47.122450, 27.555381, NULL, NULL, NULL),
(284, 1136736708, 'way', 47.125579, 27.567544, NULL, NULL, NULL),
(285, 1146510031, 'way', 47.144075, 27.576781, NULL, NULL, NULL),
(286, 1154799036, 'way', 47.142879, 27.525945, NULL, NULL, NULL),
(287, 1154799037, 'way', 47.142538, 27.526246, NULL, NULL, NULL),
(288, 1154799079, 'way', 47.141948, 27.540285, NULL, NULL, NULL),
(289, 1154799080, 'way', 47.144030, 27.540496, NULL, NULL, NULL),
(290, 1173791813, 'way', 47.156118, 27.605164, 'Parcul Phoenix', NULL, NULL),
(291, 1204445966, 'way', 47.148154, 27.592428, NULL, NULL, NULL),
(292, 1216942109, 'way', 46.987801, 27.691968, NULL, NULL, NULL),
(293, 1220258118, 'way', 47.150804, 27.617039, 'terenuri tenis', 'tennis;soccer', NULL),
(294, 1220703563, 'way', 47.147841, 27.591871, NULL, NULL, NULL),
(295, 1232723314, 'way', 47.249980, 26.708232, NULL, 'soccer', NULL),
(296, 1236954593, 'way', 47.174073, 27.544645, 'Pumas Arena', 'soccer', 'artificial_turf'),
(297, 1239845733, 'way', 47.185041, 27.561594, NULL, 'soccer', NULL),
(298, 1250240436, 'way', 47.188867, 27.513495, NULL, 'skateboard', NULL),
(299, 1274593863, 'way', 47.168974, 27.510750, NULL, NULL, NULL),
(300, 1274593864, 'way', 47.168974, 27.510750, NULL, 'tennis', NULL),
(301, 1274593865, 'way', 47.168652, 27.510815, NULL, NULL, NULL),
(302, 1286051696, 'way', 47.159791, 27.484913, NULL, 'soccer', NULL),
(303, 1286051697, 'way', 47.161597, 27.484641, NULL, 'soccer', NULL),
(304, 1303427758, 'way', 47.182732, 27.515389, NULL, NULL, NULL),
(305, 1303433660, 'way', 47.180442, 27.569399, NULL, NULL, 'asphalt'),
(306, 1307023338, 'way', 47.165060, 27.612017, NULL, 'soccer;basketball', NULL),
(307, 1307088823, 'way', 47.164385, 27.612746, NULL, NULL, NULL),
(308, 1307237905, 'way', 47.170099, 27.546460, NULL, NULL, NULL),
(309, 1307237930, 'way', 47.152440, 27.624817, NULL, NULL, 'asphalt'),
(310, 1312830238, 'way', 47.181458, 27.598694, NULL, 'tennis', 'clay'),
(311, 1312830239, 'way', 47.181104, 27.598476, NULL, 'tennis', 'clay'),
(312, 1312830240, 'way', 47.181122, 27.598737, NULL, 'tennis', 'clay'),
(313, 1312830241, 'way', 47.180776, 27.598520, NULL, 'tennis', 'clay'),
(314, 1312830242, 'way', 47.180792, 27.598778, NULL, 'tennis', 'clay'),
(315, 1312830243, 'way', 47.181894, 27.598220, NULL, 'soccer', NULL),
(316, 1312830244, 'way', 47.182176, 27.598156, NULL, 'tennis', 'clay'),
(317, 1315015929, 'way', 47.175916, 27.534561, NULL, 'tennis', NULL),
(318, 1332937643, 'way', 47.151246, 27.600530, NULL, 'soccer', NULL),
(319, 1341478387, 'way', 47.152813, 27.655938, NULL, 'soccer', 'artificial_turf'),
(320, 1341478388, 'way', 47.152815, 27.655921, NULL, NULL, 'asphalt'),
(321, 1341478389, 'way', 47.154032, 27.657316, NULL, NULL, NULL),
(322, 1346367285, 'way', 47.269447, 26.670755, 'Teren fotbal Topile', 'soccer', 'grass'),
(323, 1346871432, 'way', 47.249657, 26.719050, NULL, NULL, NULL),
(324, 1349190825, 'way', 47.253956, 26.722709, NULL, NULL, NULL),
(325, 1361419310, 'way', 47.145465, 27.577756, NULL, NULL, NULL),
(326, 1368032811, 'way', 47.133578, 26.747396, 'Teren de fotbal', 'soccer', NULL),
(327, 1370691290, 'way', 47.093355, 26.811345, NULL, 'soccer', NULL),
(328, 1373864585, 'way', 47.135035, 27.687594, NULL, NULL, NULL),
(329, 1376664907, 'way', 47.213519, 27.287311, NULL, 'soccer', 'grass'),
(330, 1384963034, 'way', 47.250523, 26.710761, NULL, 'soccer', NULL),
(331, 1384963036, 'way', 47.204955, 27.516600, NULL, NULL, NULL),
(332, 1384963039, 'way', 47.202386, 27.517508, NULL, 'tennis', 'clay'),
(333, 1384963040, 'way', 47.202468, 27.517843, NULL, 'tennis', 'clay'),
(334, 1384963041, 'way', 47.202141, 27.517988, NULL, 'tennis', 'clay'),
(335, 1384963042, 'way', 47.202063, 27.517666, NULL, 'tennis', 'clay'),
(336, 1384963043, 'way', 47.201761, 27.517814, NULL, 'tennis', 'clay'),
(337, 1384963044, 'way', 47.201441, 27.517939, NULL, 'tennis', 'clay'),
(338, 1384963045, 'way', 47.201133, 27.518086, NULL, 'tennis', 'clay'),
(339, 1384963046, 'way', 47.201840, 27.518121, NULL, 'tennis', 'clay'),
(340, 1384963047, 'way', 47.201535, 27.518271, NULL, 'tennis', 'clay'),
(341, 1389539486, 'way', 47.151093, 27.636939, NULL, NULL, NULL),
(342, 1389540364, 'way', 47.149207, 27.628649, NULL, NULL, NULL),
(343, 1391838927, 'way', 47.262251, 26.676913, 'Parc \"La Leagăne\"', NULL, NULL),
(344, 1392339139, 'way', 47.245901, 26.728554, NULL, 'basketball', 'asphalt'),
(345, 1392339140, 'way', 47.246148, 26.728367, NULL, 'soccer;tennis;futnet', 'asphalt'),
(346, 1392353514, 'way', 47.250300, 26.718590, 'Teren Tenis Primarie', 'tennis', 'concrete'),
(347, 1392353516, 'way', 47.250644, 26.714861, NULL, NULL, NULL),
(348, 1392353517, 'way', 47.251314, 26.712470, NULL, NULL, NULL),
(349, 1392365458, 'way', 47.256981, 26.718389, NULL, 'rugby_union', NULL),
(350, 1392365459, 'way', 47.260845, 26.720095, 'Teren fotbal PABO', 'soccer', NULL),
(351, 1392774730, 'way', 47.413818, 27.326741, NULL, NULL, NULL),
(352, 7846323, 'relation', NULL, NULL, 'Parc Clopotari', NULL, 'grass');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`) VALUES
(32, 'accesibil_pentru_bicicleta'),
(59, 'acces_persoane_dizabilitati'),
(72, 'activitate_de_iarna'),
(81, 'activitati_secundare'),
(13, 'ad-hoc'),
(65, 'adulti'),
(21, 'afterwork'),
(7, 'alergare'),
(14, 'antrenament'),
(50, 'apa_gratuita'),
(79, 'apa_la_dispozitie'),
(42, 'avansat'),
(6, 'badminton'),
(2, 'baschet'),
(77, 'cafea_gratuita'),
(10, 'ciclism'),
(68, 'copii'),
(84, 'curatenie_inainte_dupa'),
(86, 'cu_donatii'),
(75, 'cu_premii'),
(73, 'cu_taxa'),
(71, 'doar_baieti'),
(70, 'doar_fete'),
(60, 'dusuri_disponibile'),
(48, 'echipament_asigurat'),
(82, 'eco_friendly'),
(85, 'eveniment_caritabil'),
(19, 'eveniment_privat'),
(18, 'eveniment_public'),
(17, 'eveniment_recurent'),
(54, 'family_friendly'),
(83, 'fara_plastic'),
(9, 'fitness'),
(76, 'food_truck'),
(1, 'fotbal'),
(74, 'gratuit'),
(47, 'grup_mare'),
(46, 'grup_mic'),
(40, 'incepator'),
(41, 'intermediar'),
(38, 'in_durata_de_1h'),
(69, 'mix_generatii'),
(49, 'muzica'),
(57, 'networking_sportiv'),
(43, 'open_to_all'),
(23, 'parc'),
(58, 'parcare_disponibila'),
(12, 'parkour'),
(53, 'pet_friendly'),
(5, 'ping-pong'),
(39, 'rapid_game'),
(67, 'seniori'),
(11, 'skateboarding'),
(20, 'socializare'),
(80, 'standuri_parteneri'),
(3, 'tenis'),
(25, 'teren_artificial'),
(64, 'teren_cu_gazon'),
(63, 'teren_cu_tribuna'),
(62, 'teren_iluminat_noaptea'),
(51, 'teren_liber'),
(26, 'teren_natural'),
(52, 'teren_ocupat_partial'),
(24, 'teren_sportiv'),
(66, 'tineri'),
(61, 'toalete_publice'),
(4, 'volei'),
(37, 'weekend'),
(8, 'yoga'),
(78, 'zona_picnic');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `registration_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `registration_date`) VALUES
(1, 'admin@admin', 'admin', '$2y$10$hzjCFNKdLSao42Za1ViaX.qv9Va3cUFuWZ1QmwWJpeBYVUegrxWM2', '2025-06-20 15:48:15'),
(2, 'incognito@sportis', 'incognito', '$2y$10$PcrEICy0sNd0yZEdLsvwEu1QiIBDs3wxcC7lgpLeSo3cUFmZ2pwAW', '2025-06-20 15:48:15'),
(6, 'student@student', 'student', '$2y$10$zMwB/fhkMfkrBxma3fzR9Ogrq4FcK91VGFW9OKj5Fa2Hl541kPf5O', '2025-06-20 15:04:40'),
(7, 'user@user', 'user1', '$2y$10$RZCBvCoBLhzyzBxvEzrLe.BPh6E2fN/nVCoAdEaRnn7Pqci5PpgbO', '2025-06-21 02:33:56'),
(8, 'user2@user', 'user2', '$2y$10$fUdbtObH43AVbgSZ8/tJPOtlvQEd1WisH1uE.GZiXrCzQpR31DHG.', '2025-06-21 02:34:14'),
(9, 'user3@user', 'user3', '$2y$10$HyAzBHVcKsAKeJokFR3gieV8wEWQCQVFoQwz3gZpJBceHrIm9rBSq', '2025-06-21 02:34:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `creator_id` (`creator_id`),
  ADD KEY `field_id` (`field_id`);

--
-- Indexes for table `event_participants`
--
ALTER TABLE `event_participants`
  ADD PRIMARY KEY (`event_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `event_tags`
--
ALTER TABLE `event_tags`
  ADD PRIMARY KEY (`event_id`,`tag_id`),
  ADD KEY `tag_id` (`tag_id`);

--
-- Indexes for table `friendships`
--
ALTER TABLE `friendships`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `friend_id` (`friend_id`);

--
-- Indexes for table `sports_fields`
--
ALTER TABLE `sports_fields`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `friendships`
--
ALTER TABLE `friendships`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `sports_fields`
--
ALTER TABLE `sports_fields`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=353;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`creator_id`) REFERENCES `users` (`ID`),
  ADD CONSTRAINT `events_ibfk_2` FOREIGN KEY (`field_id`) REFERENCES `sports_fields` (`id`);

--
-- Constraints for table `event_participants`
--
ALTER TABLE `event_participants`
  ADD CONSTRAINT `event_participants_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `event_participants_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`ID`) ON DELETE CASCADE;

--
-- Constraints for table `event_tags`
--
ALTER TABLE `event_tags`
  ADD CONSTRAINT `event_tags_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `event_tags_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `friendships`
--
ALTER TABLE `friendships`
  ADD CONSTRAINT `friendships_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `friendships_ibfk_2` FOREIGN KEY (`friend_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
