-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Giu 17, 2021 alle 10:35
-- Versione del server: 10.4.17-MariaDB
-- Versione PHP: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `granda_evento_snc`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `aree`
--

CREATE TABLE `aree` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `aree`
--

INSERT INTO `aree` (`id`, `nome`) VALUES
(1, 'accesso1'),
(4, 'accesso2'),
(6, 'accesso3'),
(10, 'sala da ballo 1');

-- --------------------------------------------------------

--
-- Struttura della tabella `areeineventi`
--

CREATE TABLE `areeineventi` (
  `id` int(11) NOT NULL,
  `idArea` int(11) NOT NULL,
  `idEvento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `areeineventi`
--

INSERT INTO `areeineventi` (`id`, `idArea`, `idEvento`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 4),
(17, 1, 7),
(10, 4, 1),
(18, 4, 8),
(12, 6, 1),
(16, 10, 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `citta`
--

CREATE TABLE `citta` (
  `id` int(11) NOT NULL,
  `cap` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ;

--
-- Dump dei dati per la tabella `citta`
--

INSERT INTO `citta` (`id`, `cap`, `nome`) VALUES
(1, 12011, 'Borgo San Dalmazzo'),
(2, 20121, 'Milano'),
(5, 20149, 'Milano'),
(6, 30100, 'Venezia'),
(7, 10121, 'Torino'),
(9, 90121, 'Palermo');

-- --------------------------------------------------------

--
-- Struttura della tabella `eventi`
--

CREATE TABLE `eventi` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `numGiorni` int(11) NOT NULL CHECK (`numGiorni` > 0),
  `dataInizio` date NOT NULL,
  `budget` double NOT NULL CHECK (`budget` > 0),
  `hPerG` int(11) NOT NULL CHECK (`hPerG` > 0),
  `idLuogo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `eventi`
--

INSERT INTO `eventi` (`id`, `nome`, `numGiorni`, `dataInizio`, `budget`, `hPerG`, `idLuogo`) VALUES
(1, 'Fiera Fredda', 13, '2021-05-17', 600.23, 5, 1),
(2, 'Daniel Harding concerto', 1, '2021-05-16', 700.39, 4, 2),
(3, 'Milan-Juve', 1, '2021-06-02', 500, 4, 3),
(4, 'Festival del cinema di Venezia', 5, '2021-05-21', 4500, 8, 4),
(5, 'Carnevale Venezia', 13, '2021-07-07', 4530, 7, 5),
(6, 'Incontro boxe Torino', 1, '2021-07-05', 800, 5, 8),
(7, 'Fiera enorme Venezia', 26, '2021-06-03', 12900, 4, 5),
(8, 'Museo del Cinema', 30, '2021-06-16', 12000, 8, 9);

-- --------------------------------------------------------

--
-- Struttura della tabella `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `idSensore` int(11) NOT NULL,
  `data` date NOT NULL,
  `ora` time NOT NULL,
  `dato` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `log`
--

INSERT INTO `log` (`id`, `idSensore`, `data`, `ora`, `dato`) VALUES
(1, 1, '2021-05-12', '22:03:22', '0'),
(2, 2, '2021-05-17', '13:12:36', '36.8'),
(3, 2, '2021-05-17', '13:13:29', '37.0'),
(4, 2, '2021-05-16', '21:20:59', '36.7'),
(6, 3, '2021-05-22', '11:26:47', '36.8'),
(7, 4, '2021-05-22', '11:28:02', '0'),
(11, 4, '2021-05-22', '11:29:04', '0'),
(12, 3, '2021-05-22', '11:36:46', '36.28'),
(13, 4, '2021-05-22', '11:36:46', '0'),
(14, 3, '2021-05-22', '11:36:50', '36.71'),
(15, 4, '2021-05-22', '11:36:50', '0'),
(16, 3, '2021-05-22', '11:37:01', '36.86'),
(17, 4, '2021-05-22', '11:37:01', '0'),
(18, 3, '2021-05-22', '12:02:09', '37.60'),
(19, 4, '2021-05-22', '12:02:09', '0'),
(20, 3, '2021-05-22', '12:02:19', '36.3'),
(21, 4, '2021-05-22', '12:02:19', '0'),
(22, 3, '2021-05-22', '12:02:25', '36.16'),
(23, 4, '2021-05-22', '12:02:25', '0'),
(24, 3, '2021-05-22', '12:05:49', '37.07'),
(25, 4, '2021-05-22', '12:05:49', '0'),
(26, 3, '2021-05-22', '12:05:55', '36.5'),
(27, 4, '2021-05-22', '12:05:55', '0'),
(28, 3, '2021-05-22', '12:33:50', '36.73'),
(29, 4, '2021-05-22', '12:33:50', '0'),
(30, 3, '2021-05-22', '12:34:16', '37.28'),
(31, 4, '2021-05-22', '12:34:16', '0'),
(32, 3, '2021-05-22', '12:34:22', '37.47'),
(33, 4, '2021-05-22', '12:34:22', '0'),
(34, 3, '2021-05-22', '13:04:14', '36.81'),
(35, 4, '2021-05-22', '13:04:14', '0'),
(36, 3, '2021-05-22', '13:04:29', '36.93'),
(37, 4, '2021-05-22', '13:04:29', '0'),
(38, 3, '2021-05-22', '13:04:32', '37.08'),
(39, 4, '2021-05-22', '13:04:32', '0'),
(40, 3, '2021-05-22', '13:04:38', '37.45'),
(41, 4, '2021-05-22', '13:04:38', '0'),
(42, 3, '2021-05-22', '13:04:49', '36.22'),
(43, 4, '2021-05-22', '13:04:49', '0'),
(44, 3, '2021-05-22', '13:05:03', '36.58'),
(45, 4, '2021-05-22', '13:05:03', '0'),
(46, 3, '2021-05-22', '13:05:39', '36.95'),
(47, 4, '2021-05-22', '13:05:39', '0'),
(48, 3, '2021-05-22', '13:05:40', '36.37'),
(49, 4, '2021-05-22', '13:05:40', '0'),
(50, 3, '2021-05-22', '13:05:49', '36.14'),
(51, 4, '2021-05-22', '13:05:49', '0'),
(52, 3, '2021-05-22', '13:05:52', '36.06'),
(53, 4, '2021-05-22', '13:05:52', '0'),
(54, 3, '2021-05-22', '13:05:53', '37.26'),
(55, 4, '2021-05-22', '13:05:53', '0'),
(56, 3, '2021-05-22', '13:06:17', '36.56'),
(57, 4, '2021-05-22', '13:06:17', '0'),
(58, 3, '2021-05-22', '13:06:21', '37.79'),
(59, 4, '2021-05-22', '13:06:21', '0'),
(60, 3, '2021-05-22', '13:06:43', '36.8'),
(61, 4, '2021-05-22', '13:06:43', '1'),
(62, 3, '2021-05-22', '13:07:18', '36.51'),
(63, 4, '2021-05-22', '13:07:18', '0'),
(64, 3, '2021-05-22', '13:07:22', '37.37'),
(65, 4, '2021-05-22', '13:07:22', '0'),
(66, 3, '2021-05-22', '13:07:35', '36.73'),
(67, 4, '2021-05-22', '13:07:35', '0'),
(68, 3, '2021-05-22', '13:07:47', '36.21'),
(69, 4, '2021-05-22', '13:07:47', '0'),
(70, 3, '2021-05-22', '13:08:02', '36.1'),
(71, 4, '2021-05-22', '13:08:02', '0'),
(72, 3, '2021-05-22', '13:08:06', '37.15'),
(73, 4, '2021-05-22', '13:08:06', '0'),
(74, 3, '2021-05-22', '13:08:12', '36.19'),
(75, 4, '2021-05-22', '13:08:12', '0'),
(76, 3, '2021-05-22', '13:08:18', '36.96'),
(77, 4, '2021-05-22', '13:08:18', '0'),
(78, 3, '2021-05-22', '13:08:23', '36.23'),
(79, 4, '2021-05-22', '13:08:23', '0'),
(80, 3, '2021-05-22', '13:08:41', '36.14'),
(81, 4, '2021-05-22', '13:08:42', '0'),
(82, 3, '2021-05-22', '13:08:45', '36.9'),
(83, 4, '2021-05-22', '13:08:45', '0'),
(84, 3, '2021-05-22', '13:08:52', '36.13'),
(85, 4, '2021-05-22', '13:08:52', '0'),
(86, 3, '2021-05-22', '13:08:58', '37.3'),
(87, 4, '2021-05-22', '13:08:58', '0'),
(88, 3, '2021-05-22', '13:09:03', '36.65'),
(89, 4, '2021-05-22', '13:09:03', '1'),
(90, 3, '2021-05-22', '13:09:11', '36.44'),
(91, 4, '2021-05-22', '13:09:11', '0'),
(92, 3, '2021-05-22', '13:09:39', '37.32'),
(93, 4, '2021-05-22', '13:09:39', '0'),
(94, 3, '2021-05-22', '13:09:39', '37.02'),
(95, 4, '2021-05-22', '13:09:39', '0'),
(96, 3, '2021-05-22', '13:09:58', '37.16'),
(97, 4, '2021-05-22', '13:09:58', '0'),
(98, 3, '2021-05-22', '13:10:00', '37.97'),
(99, 4, '2021-05-22', '13:10:00', '0'),
(100, 3, '2021-05-22', '13:10:28', '36.87'),
(101, 4, '2021-05-22', '13:10:28', '0'),
(102, 3, '2021-05-22', '13:10:37', '36.65'),
(103, 4, '2021-05-22', '13:10:37', '0'),
(104, 3, '2021-05-22', '13:10:41', '36.71'),
(105, 4, '2021-05-22', '13:10:41', '0'),
(106, 3, '2021-05-22', '13:10:45', '37.27'),
(107, 4, '2021-05-22', '13:10:45', '0'),
(108, 3, '2021-05-22', '13:10:54', '36.94'),
(109, 4, '2021-05-22', '13:10:54', '0'),
(110, 3, '2021-05-22', '13:11:05', '36.99'),
(111, 4, '2021-05-22', '13:11:05', '0'),
(112, 3, '2021-05-22', '13:11:37', '36.76'),
(113, 4, '2021-05-22', '13:11:37', '0'),
(114, 3, '2021-05-22', '13:11:41', '37.55'),
(115, 4, '2021-05-22', '13:11:41', '0'),
(116, 3, '2021-05-22', '13:11:49', '36.58'),
(117, 4, '2021-05-22', '13:11:49', '0'),
(118, 3, '2021-05-22', '13:11:54', '36.15'),
(119, 4, '2021-05-22', '13:11:54', '0'),
(120, 3, '2021-05-22', '13:11:57', '36.45'),
(121, 4, '2021-05-22', '13:11:57', '0'),
(122, 3, '2021-05-22', '13:12:05', '37.0'),
(123, 4, '2021-05-22', '13:12:05', '0'),
(124, 3, '2021-05-22', '13:12:13', '36.87'),
(125, 4, '2021-05-22', '13:12:13', '0'),
(126, 3, '2021-05-22', '13:12:17', '37.23'),
(127, 4, '2021-05-22', '13:12:17', '0'),
(128, 3, '2021-05-22', '13:12:24', '36.08'),
(129, 4, '2021-05-22', '13:12:24', '0'),
(130, 3, '2021-05-22', '13:12:40', '37.48'),
(131, 4, '2021-05-22', '13:12:40', '1'),
(132, 3, '2021-05-22', '13:12:40', '37.01'),
(133, 4, '2021-05-22', '13:12:40', '0'),
(134, 3, '2021-05-22', '13:12:44', '36.94'),
(135, 4, '2021-05-22', '13:12:44', '0'),
(136, 3, '2021-05-22', '13:12:50', '36.7'),
(137, 4, '2021-05-22', '13:12:50', '0'),
(138, 3, '2021-05-23', '11:06:53', '36.85'),
(139, 4, '2021-05-23', '11:06:53', '0'),
(140, 3, '2021-05-23', '11:07:09', '36.49'),
(141, 4, '2021-05-23', '11:07:09', '0'),
(142, 3, '2021-05-23', '11:09:03', '37.19'),
(143, 4, '2021-05-23', '11:09:03', '0'),
(144, 3, '2021-05-23', '11:09:15', '36.24'),
(145, 4, '2021-05-23', '11:09:15', '0'),
(146, 3, '2021-05-23', '11:09:29', '36.97'),
(147, 4, '2021-05-23', '11:09:29', '0'),
(148, 3, '2021-05-23', '11:09:42', '37.45'),
(149, 4, '2021-05-23', '11:09:42', '0'),
(150, 3, '2021-05-23', '11:09:47', '36.68'),
(151, 4, '2021-05-23', '11:09:47', '0'),
(152, 3, '2021-05-23', '11:10:15', '36.72'),
(153, 4, '2021-05-23', '11:10:15', '0'),
(154, 3, '2021-05-23', '11:10:18', '36.27'),
(155, 4, '2021-05-23', '11:10:18', '0'),
(156, 3, '2021-05-23', '11:10:26', '36.45'),
(157, 4, '2021-05-23', '11:10:27', '0'),
(158, 3, '2021-05-23', '11:10:38', '36.18'),
(159, 4, '2021-05-23', '11:10:38', '0'),
(160, 3, '2021-05-23', '11:10:56', '37.87'),
(161, 4, '2021-05-23', '11:10:56', '0'),
(162, 3, '2021-05-23', '11:11:03', '36.87'),
(163, 4, '2021-05-23', '11:11:03', '0'),
(164, 3, '2021-05-23', '11:11:09', '36.26'),
(165, 4, '2021-05-23', '11:11:09', '0'),
(166, 3, '2021-05-23', '11:11:14', '36.8'),
(167, 4, '2021-05-23', '11:11:14', '0'),
(168, 3, '2021-05-23', '11:11:21', '37.25'),
(169, 4, '2021-05-23', '11:11:21', '1'),
(170, 3, '2021-05-23', '11:11:35', '36.7'),
(171, 4, '2021-05-23', '11:11:35', '0'),
(172, 3, '2021-05-23', '11:11:48', '37.25'),
(173, 4, '2021-05-23', '11:11:48', '0'),
(174, 3, '2021-05-23', '11:12:03', '36.64'),
(175, 4, '2021-05-23', '11:12:03', '0'),
(176, 3, '2021-05-23', '11:12:13', '36.24'),
(177, 4, '2021-05-23', '11:12:13', '0'),
(178, 3, '2021-05-23', '11:12:20', '37.84'),
(179, 4, '2021-05-23', '11:12:20', '0'),
(180, 3, '2021-05-23', '11:12:30', '36.72'),
(181, 4, '2021-05-23', '11:12:30', '0'),
(182, 3, '2021-05-23', '11:12:38', '36.83'),
(183, 4, '2021-05-23', '11:12:38', '0'),
(184, 3, '2021-05-23', '11:13:19', '37.48'),
(185, 4, '2021-05-23', '11:13:19', '0'),
(186, 3, '2021-05-23', '11:13:20', '36.98'),
(187, 4, '2021-05-23', '11:13:20', '0'),
(188, 3, '2021-05-23', '11:13:33', '36.94'),
(189, 4, '2021-05-23', '11:13:33', '0'),
(190, 3, '2021-05-23', '11:13:56', '37.2'),
(191, 4, '2021-05-23', '11:13:57', '0'),
(192, 3, '2021-05-23', '11:14:01', '37.02'),
(193, 4, '2021-05-23', '11:14:01', '0'),
(194, 3, '2021-05-23', '11:14:05', '36.09'),
(195, 4, '2021-05-23', '11:14:05', '0'),
(196, 3, '2021-05-23', '11:14:11', '37.32'),
(197, 4, '2021-05-23', '11:14:11', '0'),
(198, 3, '2021-05-23', '11:14:12', '37.22'),
(199, 4, '2021-05-23', '11:14:12', '0'),
(200, 3, '2021-05-23', '11:14:13', '36.72'),
(201, 4, '2021-05-23', '11:14:13', '1'),
(202, 3, '2021-05-23', '11:14:14', '36.89'),
(203, 4, '2021-05-23', '11:14:14', '0'),
(204, 3, '2021-05-23', '11:14:39', '36.49'),
(205, 4, '2021-05-23', '11:14:39', '0'),
(206, 3, '2021-05-23', '11:14:39', '37.44'),
(207, 4, '2021-05-23', '11:14:39', '0'),
(208, 3, '2021-05-23', '11:14:42', '36.01'),
(209, 4, '2021-05-23', '11:14:42', '0'),
(210, 3, '2021-05-23', '11:14:44', '36.65'),
(211, 4, '2021-05-23', '11:14:44', '0'),
(212, 3, '2021-05-23', '11:14:54', '37.7'),
(213, 4, '2021-05-23', '11:14:54', '0'),
(214, 3, '2021-05-23', '11:14:59', '36.46'),
(215, 4, '2021-05-23', '11:14:59', '0'),
(216, 3, '2021-05-23', '11:15:14', '36.19'),
(217, 4, '2021-05-23', '11:15:14', '0'),
(218, 3, '2021-05-23', '11:15:24', '36.93'),
(219, 4, '2021-05-23', '11:15:24', '0'),
(220, 3, '2021-05-23', '11:15:33', '36.41'),
(221, 4, '2021-05-23', '11:15:33', '0'),
(222, 3, '2021-05-23', '11:16:06', '37.25'),
(223, 4, '2021-05-23', '11:16:06', '0'),
(224, 3, '2021-05-25', '13:03:17', '37.08'),
(225, 4, '2021-05-25', '13:03:17', '0'),
(226, 3, '2021-05-25', '13:03:23', '36.75'),
(227, 4, '2021-05-25', '13:03:23', '0'),
(228, 3, '2021-05-25', '13:03:36', '37.33'),
(229, 4, '2021-05-25', '13:03:36', '0'),
(230, 3, '2021-05-25', '13:03:37', '36.41'),
(231, 4, '2021-05-25', '13:03:37', '0'),
(232, 3, '2021-05-25', '13:03:42', '37.5'),
(233, 4, '2021-05-25', '13:03:42', '0'),
(234, 3, '2021-05-25', '13:03:45', '36.8'),
(235, 4, '2021-05-25', '13:03:45', '0'),
(236, 3, '2021-05-25', '13:03:55', '37.18'),
(237, 4, '2021-05-25', '13:03:55', '0'),
(238, 3, '2021-05-25', '13:03:58', '36.19'),
(239, 4, '2021-05-25', '13:03:58', '0'),
(240, 3, '2021-05-25', '13:03:58', '37.43'),
(241, 4, '2021-05-25', '13:03:58', '0'),
(242, 3, '2021-05-25', '13:04:03', '36.33'),
(243, 4, '2021-05-25', '13:04:03', '0'),
(244, 2, '2021-05-28', '08:49:03', '36.79'),
(245, 1, '2021-05-28', '08:49:03', '0'),
(246, 2, '2021-05-28', '08:50:14', '36.05'),
(247, 1, '2021-05-28', '08:50:14', '0'),
(248, 2, '2021-05-28', '08:50:43', '36.16'),
(249, 1, '2021-05-28', '08:50:43', '0'),
(250, 2, '2021-05-28', '08:50:56', '37.15'),
(251, 1, '2021-05-28', '08:50:56', '0'),
(252, 2, '2021-05-28', '08:51:16', '36.31'),
(253, 1, '2021-05-28', '08:51:16', '0'),
(254, 2, '2021-05-28', '08:51:42', '37.23'),
(255, 1, '2021-05-28', '08:51:42', '0'),
(256, 2, '2021-05-30', '12:52:49', '36.49'),
(257, 1, '2021-05-30', '12:52:49', '0'),
(258, 2, '2021-05-30', '13:03:14', '37.11'),
(259, 1, '2021-05-30', '13:03:14', '0'),
(260, 2, '2021-05-30', '13:28:32', '37.12'),
(261, 1, '2021-05-30', '13:28:32', '0'),
(262, 2, '2021-06-17', '09:43:43', '36.53'),
(263, 1, '2021-06-17', '09:43:43', '0'),
(264, 2, '2021-06-17', '09:44:01', '36.39'),
(265, 1, '2021-06-17', '09:44:01', '0'),
(266, 2, '2021-06-17', '09:49:35', '36.36'),
(267, 1, '2021-06-17', '09:49:36', '0'),
(268, 2, '2021-06-17', '09:49:47', '37.34'),
(269, 1, '2021-06-17', '09:49:47', '0'),
(270, 2, '2021-06-17', '09:49:58', '36.82'),
(271, 1, '2021-06-17', '09:49:58', '0'),
(272, 2, '2021-06-17', '09:51:05', '36.63'),
(273, 1, '2021-06-17', '09:51:05', '0'),
(274, 2, '2021-06-17', '09:51:10', '36.01'),
(275, 1, '2021-06-17', '09:51:10', '0'),
(276, 3, '2021-06-17', '10:20:56', '36.96'),
(277, 4, '2021-06-17', '10:20:56', '0'),
(278, 2, '2021-06-17', '10:21:12', '36.78'),
(279, 1, '2021-06-17', '10:21:12', '0'),
(280, 3, '2021-06-17', '10:21:14', '37.3'),
(281, 4, '2021-06-17', '10:21:14', '0'),
(282, 3, '2021-06-17', '10:21:15', '36.99'),
(283, 4, '2021-06-17', '10:21:15', '0'),
(284, 3, '2021-06-17', '10:21:25', '36.69'),
(285, 4, '2021-06-17', '10:21:25', '0'),
(286, 3, '2021-06-17', '10:21:29', '37.64'),
(287, 4, '2021-06-17', '10:21:29', '0'),
(288, 3, '2021-06-17', '10:22:21', '36.58'),
(289, 4, '2021-06-17', '10:22:21', '0'),
(290, 3, '2021-06-17', '10:22:22', '37.43'),
(291, 4, '2021-06-17', '10:22:22', '0'),
(292, 3, '2021-06-17', '10:22:33', '36.73'),
(293, 4, '2021-06-17', '10:22:33', '0'),
(294, 3, '2021-06-17', '10:22:39', '36.12'),
(295, 4, '2021-06-17', '10:22:39', '0'),
(296, 3, '2021-06-17', '10:22:42', '37.5'),
(297, 4, '2021-06-17', '10:22:42', '0'),
(298, 2, '2021-06-17', '10:25:23', '37.46'),
(299, 1, '2021-06-17', '10:25:23', '0'),
(300, 2, '2021-06-17', '10:25:36', '36.66'),
(301, 1, '2021-06-17', '10:25:36', '0');

-- --------------------------------------------------------

--
-- Struttura della tabella `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `pw` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `login`
--

INSERT INTO `login` (`id`, `user`, `pw`) VALUES
(1, 'ges', '5177a16362e1eb6be14cc727376c3187');

-- --------------------------------------------------------

--
-- Struttura della tabella `luoghi`
--

CREATE TABLE `luoghi` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `idCitta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `luoghi`
--

INSERT INTO `luoghi` (`id`, `nome`, `idCitta`) VALUES
(1, 'Palazzo Bertello', 1),
(2, 'Teatro alla Scala', 2),
(3, 'Stadio San Siro', 5),
(4, 'Palazzo del cinema', 6),
(5, 'Piazza San Marco', 6),
(7, 'Palazzo Reale', 7),
(8, 'Thai Boxe Torino', 7),
(9, 'Mole Antoneliana', 7);

-- --------------------------------------------------------

--
-- Struttura della tabella `mansioni`
--

CREATE TABLE `mansioni` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `retrOraria` double NOT NULL
) ;

--
-- Dump dei dati per la tabella `mansioni`
--

INSERT INTO `mansioni` (`id`, `nome`, `retrOraria`) VALUES
(1, 'buttafuori', 15.93),
(2, 'primo soccorso', 10),
(4, 'operatore monitor', 10.45);

-- --------------------------------------------------------

--
-- Struttura della tabella `mansioniineventi`
--

CREATE TABLE `mansioniineventi` (
  `id` int(11) NOT NULL,
  `idEvento` int(11) NOT NULL,
  `idMansione` int(11) NOT NULL,
  `numPersone` int(11) NOT NULL DEFAULT 0
) ;

--
-- Dump dei dati per la tabella `mansioniineventi`
--

INSERT INTO `mansioniineventi` (`id`, `idEvento`, `idMansione`, `numPersone`) VALUES
(1, 1, 1, 2),
(2, 3, 1, 2),
(3, 3, 2, 1),
(4, 1, 2, 1),
(5, 2, 4, 1),
(12, 2, 1, 4),
(13, 2, 2, 1),
(21, 4, 1, 1),
(22, 4, 2, 2),
(23, 4, 4, 1),
(24, 6, 1, 3),
(25, 5, 2, 3);

-- --------------------------------------------------------

--
-- Struttura della tabella `mansionipersonale`
--

CREATE TABLE `mansionipersonale` (
  `id` int(11) NOT NULL,
  `idMansione` int(11) NOT NULL,
  `idPersona` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `mansionipersonale`
--

INSERT INTO `mansionipersonale` (`id`, `idMansione`, `idPersona`) VALUES
(3, 1, 1),
(1, 1, 2),
(5, 2, 1),
(2, 2, 2),
(6, 4, 3);

-- --------------------------------------------------------

--
-- Struttura della tabella `personale`
--

CREATE TABLE `personale` (
  `id` int(11) NOT NULL,
  `email` text NOT NULL CHECK (`email` like '%@%.%'),
  `nome` text NOT NULL,
  `cognome` text NOT NULL,
  `nascita` date NOT NULL CHECK (`nascita` < '2005-05-31'),
  `cf` varchar(255) DEFAULT NULL CHECK (`cf` like '________________')
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `personale`
--

INSERT INTO `personale` (`id`, `email`, `nome`, `cognome`, `nascita`, `cf`) VALUES
(1, 'mariorossi@gmail.com', 'Mario', 'Rossi', '2000-01-01', 'RSSMRA00A01F205F'),
(2, 'gianluca.392@yahoo.it', 'Gianluca', 'Brodo', '1996-03-16', 'BRDGLC96C16L219S'),
(3, 'luca329@gmail.com', 'Luca', 'Ballo', '1995-11-08', 'BLLLCU95S08D969D'),
(4, 'mario.verdi@yahoo.it', 'Mario', 'Verdi', '1978-09-09', 'VRDMRA78P09A662Z'),
(9, 'andre.cuni02@gmail.com', 'Andrea', 'Cuniberti', '2002-05-14', 'CBNBBB1267GO09PU');

-- --------------------------------------------------------

--
-- Struttura della tabella `personaleineventi`
--

CREATE TABLE `personaleineventi` (
  `id` int(11) NOT NULL,
  `idMansionePersona` int(11) NOT NULL,
  `idEvento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `personaleineventi`
--

INSERT INTO `personaleineventi` (`id`, `idMansionePersona`, `idEvento`) VALUES
(1, 1, 1),
(2, 1, 3),
(7, 1, 6),
(3, 2, 3),
(4, 3, 1),
(8, 3, 6),
(5, 5, 1),
(9, 5, 5),
(6, 6, 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `sensori`
--

CREATE TABLE `sensori` (
  `id` int(11) NOT NULL,
  `idTipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `sensori`
--

INSERT INTO `sensori` (`id`, `idTipo`) VALUES
(1, 1),
(4, 1),
(2, 3),
(3, 3);

-- --------------------------------------------------------

--
-- Struttura della tabella `sensoriineventi`
--

CREATE TABLE `sensoriineventi` (
  `id` int(11) NOT NULL,
  `idSensore` int(11) NOT NULL,
  `idAreaInEvento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `sensoriineventi`
--

INSERT INTO `sensoriineventi` (`id`, `idSensore`, `idAreaInEvento`) VALUES
(1, 1, 1),
(6, 1, 17),
(2, 2, 1),
(7, 2, 17),
(4, 3, 3),
(8, 3, 18),
(5, 4, 3),
(9, 4, 18);

-- --------------------------------------------------------

--
-- Struttura della tabella `telefoni`
--

CREATE TABLE `telefoni` (
  `id` int(11) NOT NULL,
  `num` varchar(255) NOT NULL,
  `idPersona` int(11) NOT NULL
) ;

--
-- Dump dei dati per la tabella `telefoni`
--

INSERT INTO `telefoni` (`id`, `num`, `idPersona`) VALUES
(1, '3838298465', 1),
(3, '3337637866', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `tipi`
--

CREATE TABLE `tipi` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `tipi`
--

INSERT INTO `tipi` (`id`, `nome`) VALUES
(3, 'ip camera'),
(1, 'metal detector'),
(2, 'smoke detector');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `aree`
--
ALTER TABLE `aree`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `aree_name` (`nome`);

--
-- Indici per le tabelle `areeineventi`
--
ALTER TABLE `areeineventi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idArea` (`idArea`,`idEvento`),
  ADD KEY `idEvento` (`idEvento`);

--
-- Indici per le tabelle `citta`
--
ALTER TABLE `citta`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cap` (`cap`);

--
-- Indici per le tabelle `eventi`
--
ALTER TABLE `eventi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`),
  ADD KEY `idLuogo` (`idLuogo`);

--
-- Indici per le tabelle `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idSensore` (`idSensore`);

--
-- Indici per le tabelle `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user` (`user`);

--
-- Indici per le tabelle `luoghi`
--
ALTER TABLE `luoghi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idCitta` (`idCitta`);

--
-- Indici per le tabelle `mansioni`
--
ALTER TABLE `mansioni`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`);

--
-- Indici per le tabelle `mansioniineventi`
--
ALTER TABLE `mansioniineventi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idEvento` (`idEvento`,`idMansione`),
  ADD KEY `idMansione` (`idMansione`);

--
-- Indici per le tabelle `mansionipersonale`
--
ALTER TABLE `mansionipersonale`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idMansione` (`idMansione`,`idPersona`),
  ADD KEY `idPersona` (`idPersona`);

--
-- Indici per le tabelle `personale`
--
ALTER TABLE `personale`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cf` (`cf`),
  ADD UNIQUE KEY `email` (`email`) USING HASH;

--
-- Indici per le tabelle `personaleineventi`
--
ALTER TABLE `personaleineventi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idMansionePersona` (`idMansionePersona`,`idEvento`),
  ADD KEY `idEvento` (`idEvento`);

--
-- Indici per le tabelle `sensori`
--
ALTER TABLE `sensori`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idTipo` (`idTipo`);

--
-- Indici per le tabelle `sensoriineventi`
--
ALTER TABLE `sensoriineventi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idSensore` (`idSensore`,`idAreaInEvento`),
  ADD KEY `idAreaInEvento` (`idAreaInEvento`);

--
-- Indici per le tabelle `telefoni`
--
ALTER TABLE `telefoni`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `num` (`num`),
  ADD KEY `idPersona` (`idPersona`);

--
-- Indici per le tabelle `tipi`
--
ALTER TABLE `tipi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `aree`
--
ALTER TABLE `aree`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT per la tabella `areeineventi`
--
ALTER TABLE `areeineventi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT per la tabella `citta`
--
ALTER TABLE `citta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `eventi`
--
ALTER TABLE `eventi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT per la tabella `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=302;

--
-- AUTO_INCREMENT per la tabella `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT per la tabella `luoghi`
--
ALTER TABLE `luoghi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT per la tabella `mansioni`
--
ALTER TABLE `mansioni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `mansioniineventi`
--
ALTER TABLE `mansioniineventi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `mansionipersonale`
--
ALTER TABLE `mansionipersonale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT per la tabella `personale`
--
ALTER TABLE `personale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT per la tabella `personaleineventi`
--
ALTER TABLE `personaleineventi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT per la tabella `sensori`
--
ALTER TABLE `sensori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `sensoriineventi`
--
ALTER TABLE `sensoriineventi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT per la tabella `telefoni`
--
ALTER TABLE `telefoni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `tipi`
--
ALTER TABLE `tipi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `areeineventi`
--
ALTER TABLE `areeineventi`
  ADD CONSTRAINT `areeineventi_ibfk_1` FOREIGN KEY (`idArea`) REFERENCES `aree` (`id`),
  ADD CONSTRAINT `areeineventi_ibfk_2` FOREIGN KEY (`idEvento`) REFERENCES `eventi` (`id`);

--
-- Limiti per la tabella `eventi`
--
ALTER TABLE `eventi`
  ADD CONSTRAINT `eventi_ibfk_1` FOREIGN KEY (`idLuogo`) REFERENCES `luoghi` (`id`);

--
-- Limiti per la tabella `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `log_ibfk_1` FOREIGN KEY (`idSensore`) REFERENCES `sensori` (`id`);

--
-- Limiti per la tabella `luoghi`
--
ALTER TABLE `luoghi`
  ADD CONSTRAINT `luoghi_ibfk_1` FOREIGN KEY (`idCitta`) REFERENCES `citta` (`id`);

--
-- Limiti per la tabella `mansioniineventi`
--
ALTER TABLE `mansioniineventi`
  ADD CONSTRAINT `mansioniineventi_ibfk_1` FOREIGN KEY (`idEvento`) REFERENCES `eventi` (`id`),
  ADD CONSTRAINT `mansioniineventi_ibfk_2` FOREIGN KEY (`idMansione`) REFERENCES `mansioni` (`id`);

--
-- Limiti per la tabella `mansionipersonale`
--
ALTER TABLE `mansionipersonale`
  ADD CONSTRAINT `mansionipersonale_ibfk_1` FOREIGN KEY (`idMansione`) REFERENCES `mansioni` (`id`),
  ADD CONSTRAINT `mansionipersonale_ibfk_2` FOREIGN KEY (`idPersona`) REFERENCES `personale` (`id`);

--
-- Limiti per la tabella `personaleineventi`
--
ALTER TABLE `personaleineventi`
  ADD CONSTRAINT `personaleineventi_ibfk_1` FOREIGN KEY (`idMansionePersona`) REFERENCES `mansionipersonale` (`id`),
  ADD CONSTRAINT `personaleineventi_ibfk_2` FOREIGN KEY (`idEvento`) REFERENCES `eventi` (`id`);

--
-- Limiti per la tabella `sensori`
--
ALTER TABLE `sensori`
  ADD CONSTRAINT `sensori_ibfk_1` FOREIGN KEY (`idTipo`) REFERENCES `tipi` (`id`);

--
-- Limiti per la tabella `sensoriineventi`
--
ALTER TABLE `sensoriineventi`
  ADD CONSTRAINT `sensoriineventi_ibfk_1` FOREIGN KEY (`idSensore`) REFERENCES `sensori` (`id`),
  ADD CONSTRAINT `sensoriineventi_ibfk_2` FOREIGN KEY (`idAreaInEvento`) REFERENCES `areeineventi` (`id`);

--
-- Limiti per la tabella `telefoni`
--
ALTER TABLE `telefoni`
  ADD CONSTRAINT `telefoni_ibfk_1` FOREIGN KEY (`idPersona`) REFERENCES `personale` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
