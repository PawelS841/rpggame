-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2024 at 10:22 AM
-- Wersja serwera: 10.4.28-MariaDB
-- Wersja PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rpg`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `enemies`
--

CREATE TABLE `enemies` (
  `ID` int(11) NOT NULL,
  `name` text NOT NULL,
  `image` text NOT NULL,
  `lvl` int(11) NOT NULL,
  `region` int(11) NOT NULL,
  `hp` int(11) NOT NULL,
  `xp` int(11) NOT NULL DEFAULT 0,
  `A_s` float NOT NULL DEFAULT 1,
  `P_dmg` int(11) NOT NULL DEFAULT 0,
  `S_dmg` int(11) NOT NULL DEFAULT 0,
  `B_dmg` int(11) NOT NULL DEFAULT 0,
  `F_dmg` int(11) NOT NULL DEFAULT 0,
  `I_dmg` int(11) NOT NULL DEFAULT 0,
  `E_dmg` int(11) NOT NULL DEFAULT 0,
  `P_def` int(11) NOT NULL DEFAULT 0,
  `S_def` int(11) NOT NULL DEFAULT 0,
  `B_def` int(11) NOT NULL DEFAULT 0,
  `F_def` int(11) NOT NULL DEFAULT 0,
  `I_def` int(11) NOT NULL DEFAULT 0,
  `E_def` int(11) NOT NULL DEFAULT 0,
  `drop_1` int(11) NOT NULL,
  `drop_chance_1` int(11) NOT NULL,
  `drop_2` int(11) NOT NULL,
  `drop_chance_2` int(11) NOT NULL,
  `drop_3` int(11) NOT NULL,
  `drop_chance_3` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enemies`
--

INSERT INTO `enemies` (`ID`, `name`, `image`, `lvl`, `region`, `hp`, `xp`, `A_s`, `P_dmg`, `S_dmg`, `B_dmg`, `F_dmg`, `I_dmg`, `E_dmg`, `P_def`, `S_def`, `B_def`, `F_def`, `I_def`, `E_def`, `drop_1`, `drop_chance_1`, `drop_2`, `drop_chance_2`, `drop_3`, `drop_chance_3`) VALUES
(1, 'Slime', 'slime.png', 1, 1, 7, 30, 1, 0, 0, 5, 0, 2, 0, 2, 2, 2, 0, 2, 2, 12, 100, 2, 24, 3, 10),
(2, 'Duży slime', 'great_slime.png', 5, 1, 25, 0, 1, 0, 0, 8, 0, 4, 0, 3, 3, 3, 0, 3, 3, 0, 0, 0, 0, 0, 0),
(3, 'Wilk', '', 10, 2, 40, 0, 0, 10, 5, 0, 0, 0, 0, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(4, 'Bandyta', '', 20, 3, 100, 0, 0.1, 0, 0, 25, 0, 0, 0, 10, 10, 10, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5, 'Goblin', '', 15, 4, 60, 0, 0, 5, 5, 15, 0, 0, 0, 7, 7, 7, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `equipment`
--

CREATE TABLE `equipment` (
  `ID` int(11) NOT NULL,
  `helmet` int(11) NOT NULL DEFAULT 0,
  `chestplate` int(11) NOT NULL DEFAULT 0,
  `leggins` int(11) NOT NULL DEFAULT 0,
  `weapon` int(11) NOT NULL DEFAULT 0,
  `potion` int(11) NOT NULL DEFAULT 0,
  `food` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `equipment`
--

INSERT INTO `equipment` (`ID`, `helmet`, `chestplate`, `leggins`, `weapon`, `potion`, `food`) VALUES
(1, 2, 3, 0, 1, 8, 6),
(2, 0, 0, 0, 0, 0, 0),
(3, 0, 0, 0, 7, 0, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `fish`
--

CREATE TABLE `fish` (
  `ID` int(11) NOT NULL,
  `Item_ID` int(11) NOT NULL,
  `name` text NOT NULL,
  `lvl` int(11) NOT NULL,
  `drop_chance` int(11) NOT NULL,
  `speed` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fish`
--

INSERT INTO `fish` (`ID`, `Item_ID`, `name`, `lvl`, `drop_chance`, `speed`) VALUES
(1, 10, 'zwykła rzeka', 1, 75, 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `inventory`
--

CREATE TABLE `inventory` (
  `SID` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `Item_ID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`SID`, `user_ID`, `Item_ID`, `quantity`) VALUES
(1, 1, 8, 1),
(2, 1, 8, 283),
(3, 1, 3, 34),
(4, 1, 1, 371),
(5, 1, 9, 93),
(6, 2, 0, 0),
(7, 2, 0, 0),
(8, 2, 0, 0),
(9, 2, 0, 0),
(10, 2, 0, 0),
(11, 1, 2, 38),
(12, 1, 10, 6),
(13, 1, 0, 0),
(14, 1, 0, 0),
(15, 1, 0, 0),
(16, 1, 0, 0),
(17, 1, 0, 0),
(18, 1, 0, 0),
(19, 1, 0, 0),
(20, 1, 0, 0),
(21, 1, 0, 0),
(22, 1, 0, 0),
(23, 1, 0, 0),
(24, 1, 0, 0),
(25, 1, 0, 0),
(26, 1, 0, 0),
(27, 1, 0, 0),
(28, 1, 0, 0),
(29, 1, 0, 0),
(30, 1, 0, 0),
(31, 1, 0, 0),
(32, 1, 0, 0),
(33, 1, 0, 0),
(34, 1, 0, 0),
(35, 1, 0, 0),
(36, 1, 0, 0),
(37, 1, 0, 0),
(38, 1, 0, 0),
(39, 1, 0, 0),
(40, 1, 0, 0),
(41, 1, 0, 0),
(42, 1, 0, 0),
(43, 1, 0, 0),
(44, 1, 0, 0),
(45, 1, 0, 0),
(46, 1, 0, 0),
(47, 1, 0, 0),
(48, 1, 0, 0),
(49, 1, 0, 0),
(50, 1, 0, 0),
(51, 1, 0, 0),
(52, 1, 0, 0),
(53, 1, 0, 0),
(54, 1, 0, 0),
(55, 1, 0, 0),
(56, 1, 0, 0),
(57, 1, 0, 0),
(58, 1, 0, 0),
(59, 1, 0, 0),
(60, 1, 0, 0),
(61, 1, 0, 0),
(62, 1, 0, 0),
(63, 1, 0, 0),
(64, 1, 0, 0),
(65, 1, 0, 0),
(66, 1, 0, 0),
(67, 1, 0, 0),
(68, 1, 0, 0),
(69, 1, 0, 0),
(70, 1, 0, 0),
(71, 1, 0, 0),
(72, 1, 0, 0),
(73, 1, 0, 0),
(74, 1, 0, 0),
(75, 1, 0, 0),
(76, 1, 0, 0),
(77, 1, 0, 0),
(78, 1, 0, 0),
(79, 1, 0, 0),
(80, 1, 0, 0),
(81, 1, 0, 0),
(82, 1, 0, 0),
(83, 1, 0, 0),
(84, 1, 0, 0),
(85, 1, 0, 0),
(86, 1, 0, 0),
(87, 1, 0, 0),
(88, 1, 0, 0),
(89, 1, 0, 0),
(90, 1, 0, 0),
(91, 1, 0, 0),
(92, 1, 0, 0),
(93, 1, 0, 0),
(94, 1, 0, 0),
(95, 1, 0, 0),
(96, 1, 0, 0),
(97, 1, 0, 0),
(98, 1, 0, 0),
(99, 1, 0, 0),
(100, 1, 0, 0),
(101, 1, 0, 0),
(102, 1, 0, 0),
(103, 1, 0, 0),
(104, 1, 0, 0),
(105, 1, 0, 0),
(106, 1, 0, 0),
(107, 1, 0, 0),
(108, 1, 0, 0),
(109, 1, 0, 0),
(110, 1, 0, 0),
(111, 1, 0, 0),
(112, 1, 0, 0),
(113, 1, 0, 0),
(114, 1, 0, 0),
(115, 1, 0, 0),
(116, 1, 0, 0),
(117, 1, 0, 0),
(118, 1, 0, 0),
(119, 1, 0, 0),
(120, 1, 0, 0),
(121, 1, 0, 0),
(122, 1, 0, 0),
(123, 1, 0, 0),
(124, 1, 0, 0),
(125, 1, 0, 0),
(126, 1, 0, 0),
(127, 1, 0, 0),
(128, 1, 0, 0),
(129, 1, 0, 0),
(130, 1, 0, 0),
(131, 1, 0, 0),
(132, 1, 0, 0),
(133, 1, 0, 0),
(134, 1, 0, 0),
(135, 1, 0, 0),
(136, 1, 0, 0),
(137, 1, 0, 0),
(138, 1, 0, 0),
(139, 1, 0, 0),
(140, 1, 0, 0),
(141, 1, 0, 0),
(142, 1, 0, 0),
(143, 1, 0, 0),
(144, 1, 0, 0),
(145, 1, 0, 0),
(146, 1, 0, 0),
(147, 1, 0, 0),
(148, 1, 0, 0),
(149, 1, 0, 0),
(150, 1, 0, 0),
(151, 1, 0, 0),
(152, 1, 0, 0),
(153, 1, 0, 0),
(154, 1, 0, 0),
(155, 1, 0, 0),
(156, 1, 0, 0),
(157, 1, 0, 0),
(158, 1, 0, 0),
(159, 1, 0, 0),
(160, 1, 0, 0),
(161, 1, 0, 0),
(162, 1, 0, 0),
(163, 1, 0, 0),
(164, 1, 0, 0),
(165, 1, 0, 0),
(166, 1, 0, 0),
(167, 1, 0, 0),
(168, 1, 0, 0),
(169, 1, 0, 0),
(170, 1, 0, 0),
(171, 1, 0, 0),
(172, 1, 0, 0),
(173, 1, 0, 0),
(174, 1, 0, 0),
(175, 1, 0, 0),
(176, 1, 0, 0),
(177, 1, 0, 0),
(178, 1, 0, 0),
(179, 1, 0, 0),
(180, 1, 0, 0),
(181, 1, 0, 0),
(182, 1, 0, 0),
(183, 1, 0, 0),
(184, 1, 0, 0),
(185, 1, 0, 0),
(186, 1, 0, 0),
(187, 1, 0, 0),
(188, 1, 0, 0),
(189, 1, 0, 0),
(190, 1, 0, 0),
(191, 1, 0, 0),
(192, 1, 0, 0),
(193, 3, 9, 9),
(194, 3, 1, 11),
(195, 3, 8, 8),
(196, 3, 12, 33),
(197, 3, 10, 12),
(198, 3, 7, 1),
(199, 3, 0, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `items`
--

CREATE TABLE `items` (
  `ID` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `P_dmg` int(11) NOT NULL DEFAULT 0,
  `S_dmg` int(11) NOT NULL DEFAULT 0,
  `B_dmg` int(11) NOT NULL DEFAULT 0,
  `A_s` int(11) NOT NULL DEFAULT 0,
  `F_dmg` int(11) NOT NULL DEFAULT 0,
  `I_dmg` int(11) NOT NULL DEFAULT 0,
  `E_dmg` int(11) NOT NULL DEFAULT 0,
  `P_def` int(11) NOT NULL DEFAULT 0,
  `S_def` int(11) NOT NULL DEFAULT 0,
  `B_def` int(11) NOT NULL DEFAULT 0,
  `F_def` int(11) NOT NULL DEFAULT 0,
  `I_def` int(11) NOT NULL DEFAULT 0,
  `E_def` int(11) NOT NULL DEFAULT 0,
  `ADD_def` int(11) NOT NULL DEFAULT 0,
  `ADD_atk` int(11) NOT NULL DEFAULT 0,
  `ADD_hp` int(11) NOT NULL DEFAULT 0,
  `weapon_type` text NOT NULL DEFAULT 'none',
  `equipable` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`ID`, `type`, `name`, `description`, `image`, `price`, `P_dmg`, `S_dmg`, `B_dmg`, `A_s`, `F_dmg`, `I_dmg`, `E_dmg`, `P_def`, `S_def`, `B_def`, `F_def`, `I_def`, `E_def`, `ADD_def`, `ADD_atk`, `ADD_hp`, `weapon_type`, `equipable`) VALUES
(1, 'weapon', 'Drewniany miecz', 'Drewniany miecz został wykonany z hebanowego drewna w wichrowym zagajniku', 'wooden_sword.png', 10, 0, 10, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'SWORD', 1),
(2, 'helmet', 'Skórzany hełm', 'Skórzany hełm wykonany z zwierzęcej skóry', 'leather_helmet.png', 10, 0, 0, 0, 0, 0, 0, 0, 5, 5, 5, 0, 0, 0, 0, 0, 0, 'not_weapon', 1),
(3, 'chestplate', 'Skórzany napierśnik', 'Skórzany napierśnik wykonany ze zwierzęcej skóry', 'leather_chestplate.png', 15, 0, 0, 0, 0, 0, 0, 0, 7, 7, 7, 0, 0, 0, 0, 0, 0, 'not_weapon', 1),
(4, 'leggins', 'Skórzane spodnie', 'Skórzane spodnie wykonane ze zwierzęcej skóry', 'leather_leggins.png', 12, 0, 0, 0, 0, 0, 0, 0, 6, 6, 6, 0, 0, 0, 0, 0, 0, 'not_weapon', 1),
(5, 'helmet', 'Hełm gladiatora', 'Hełm gladiatora wykonany z żelaza', 'gladiator_helmet.png', 30, 0, 0, 0, 0, 0, 0, 0, 10, 10, 10, 0, 0, 0, 0, 0, 0, 'not_weapon', 0),
(6, 'food', 'talerz jedzenia', 'test', 'plate_of_food.png', 23, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 23, 'not_weapon', 0),
(7, 'weapon', 'Magiczny drewniany miecz', 'drewniany miecz pokryty dziwny śluzem', 'magic_wooden_sword.png', 123, 12, 21, 12, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'SWORD', 0),
(8, 'potion', 'mikstura obrony', '', 'defence_potion.png', 23, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 14, 12, 'not_weapon', 0),
(9, 'material', 'ruda miedzi', 'surowa miedz być może da się ją przetworzyć w coś porzytecznego', 'copper_ore.svg', 5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'none', 0),
(10, 'food', 'karp', 'zwykły karp może można go ugotować', 'carp.png', 7, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 'none', 0),
(11, 'food', 'Upieczony karp', 'karp który został upieczony na ognisku', 'carp_baked.png', 8, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 'none', 0),
(12, 'material', 'slime', 'zielony glut było ciężko go zdobyć', 'slime.png', 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'none', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `market`
--

CREATE TABLE `market` (
  `ID` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `Item_ID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `market`
--

INSERT INTO `market` (`ID`, `user_ID`, `Item_ID`, `quantity`, `price`) VALUES
(10, 1, 1, 1, 23),
(11, 1, 6, 2, 12),
(28, 2, 1, 1, 2),
(29, 2, 1, 1, 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `mine`
--

CREATE TABLE `mine` (
  `ID` int(11) NOT NULL,
  `name` text NOT NULL,
  `Item_ID` int(11) NOT NULL,
  `drop_chance` int(11) NOT NULL,
  `lvl` int(11) NOT NULL,
  `speed` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mine`
--

INSERT INTO `mine` (`ID`, `name`, `Item_ID`, `drop_chance`, `lvl`, `speed`) VALUES
(1, 'złoże miedzi', 9, 75, 1, 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `recipes`
--

CREATE TABLE `recipes` (
  `RID` int(11) NOT NULL,
  `type` text NOT NULL,
  `Item_ID` int(11) NOT NULL,
  `lvl` int(11) NOT NULL,
  `ingredient_1` int(11) NOT NULL DEFAULT 0,
  `ingredient_1a` int(11) NOT NULL DEFAULT 0,
  `ingredient_2` int(11) NOT NULL DEFAULT 0,
  `ingredient_2a` int(11) NOT NULL DEFAULT 0,
  `ingredient_3` int(11) NOT NULL DEFAULT 0,
  `ingredient_3a` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`RID`, `type`, `Item_ID`, `lvl`, `ingredient_1`, `ingredient_1a`, `ingredient_2`, `ingredient_2a`, `ingredient_3`, `ingredient_3a`) VALUES
(1, 'SMITHING', 5, 1, 9, 2, 2, 1, 0, 0),
(2, 'SMITHING', 1, 1, 9, 3, 0, 0, 0, 0),
(3, 'COOKING', 11, 1, 10, 1, 0, 0, 0, 0),
(4, 'ALCHEMY', 8, 1, 12, 3, 0, 0, 0, 0),
(5, 'ENCHANTING', 7, 1, 1, 1, 12, 5, 0, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `regions`
--

CREATE TABLE `regions` (
  `ID` int(11) NOT NULL,
  `name` text NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`ID`, `name`, `image`) VALUES
(1, 'Dolina Łowców', 'hunter_valley.png'),
(2, 'Gęsty las', ''),
(3, 'Mroczny Las', ''),
(4, 'Wioska goblinów\r\n', '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `skill`
--

CREATE TABLE `skill` (
  `ID` int(11) NOT NULL,
  `SWORD` int(11) NOT NULL DEFAULT 1,
  `HAMMER` int(11) NOT NULL DEFAULT 1,
  `DAGGER` int(11) NOT NULL DEFAULT 1,
  `BOW` int(11) NOT NULL DEFAULT 1,
  `MAGIC` int(11) NOT NULL DEFAULT 1,
  `FISHING` int(11) NOT NULL DEFAULT 1,
  `SNEAKING` int(11) NOT NULL DEFAULT 1,
  `SMITHING` int(11) NOT NULL DEFAULT 1,
  `ENCHANTING` int(11) NOT NULL DEFAULT 1,
  `ALCHEMY` int(11) NOT NULL DEFAULT 1,
  `COOKING` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `skill`
--

INSERT INTO `skill` (`ID`, `SWORD`, `HAMMER`, `DAGGER`, `BOW`, `MAGIC`, `FISHING`, `SNEAKING`, `SMITHING`, `ENCHANTING`, `ALCHEMY`, `COOKING`) VALUES
(1, 3, 12, 100, 1, 1, 1, 1, 4, 1, 1, 1),
(2, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(3, 1, 1, 1, 1, 1, 1, 1, 1, 2, 3, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `skill_xp`
--

CREATE TABLE `skill_xp` (
  `ID` int(11) NOT NULL,
  `SWORD_XP` int(11) NOT NULL DEFAULT 0,
  `HAMMER_XP` int(11) NOT NULL DEFAULT 0,
  `DAGGER_XP` int(11) NOT NULL DEFAULT 0,
  `BOW_XP` int(11) NOT NULL DEFAULT 0,
  `MAGIC_XP` int(11) NOT NULL DEFAULT 0,
  `FISHING_XP` int(11) NOT NULL DEFAULT 0,
  `SNEAKING_XP` int(11) NOT NULL DEFAULT 0,
  `SMITHING_XP` int(11) NOT NULL DEFAULT 0,
  `ENCHANTING_XP` int(11) NOT NULL DEFAULT 0,
  `ALCHEMY_XP` int(11) NOT NULL DEFAULT 0,
  `COOKING_XP` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `skill_xp`
--

INSERT INTO `skill_xp` (`ID`, `SWORD_XP`, `HAMMER_XP`, `DAGGER_XP`, `BOW_XP`, `MAGIC_XP`, `FISHING_XP`, `SNEAKING_XP`, `SMITHING_XP`, `ENCHANTING_XP`, `ALCHEMY_XP`, `COOKING_XP`) VALUES
(1, 30, 23, 0, 0, 0, 70, 31, 20, 0, 0, 8),
(2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(3, 89, 0, 0, 0, 0, 0, 0, 10, 146, 95, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `statistic`
--

CREATE TABLE `statistic` (
  `ID` int(255) NOT NULL,
  `STR` int(255) NOT NULL DEFAULT 10,
  `DEX` int(255) NOT NULL DEFAULT 10,
  `INT` int(255) NOT NULL DEFAULT 10,
  `VIT` int(255) NOT NULL DEFAULT 10,
  `END` int(255) NOT NULL DEFAULT 10,
  `LUCK` int(255) NOT NULL DEFAULT 10,
  `LVL` int(255) NOT NULL DEFAULT 1,
  `XP` int(255) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `statistic`
--

INSERT INTO `statistic` (`ID`, `STR`, `DEX`, `INT`, `VIT`, `END`, `LUCK`, `LVL`, `XP`) VALUES
(1, 40, 23, 13, 40, 40, 164, 27, 2447335),
(2, 10, 10, 10, 10, 10, 10, 1, 0),
(3, 10, 20, 10, 10, 10, 10, 4, 95);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `theft`
--

CREATE TABLE `theft` (
  `ID` int(11) NOT NULL,
  `name` text NOT NULL,
  `lvl` int(11) NOT NULL,
  `speed` int(11) NOT NULL,
  `chance` int(11) NOT NULL,
  `min_amount` int(11) NOT NULL,
  `max_amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `theft`
--

INSERT INTO `theft` (`ID`, `name`, `lvl`, `speed`, `chance`, `min_amount`, `max_amount`) VALUES
(1, 'Okradnij Staruszka', 1, 9, 50, 5, 15),
(2, 'Okradnij Kupca', 1, 25, 30, 5000, 15000);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `Login` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `money` int(11) NOT NULL DEFAULT 0,
  `b_upgrade` int(11) NOT NULL DEFAULT 0,
  `m_upgrade` int(11) NOT NULL DEFAULT 0,
  `t_upgrade` int(11) NOT NULL DEFAULT 0,
  `f_upgrade` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `Login`, `Email`, `Password`, `money`, `b_upgrade`, `m_upgrade`, `t_upgrade`, `f_upgrade`) VALUES
(1, 'pawel841', 'pawelstanislawczyk841@gmail.com', '9bfd43dde0aa7de26a1d62246800fb85ad510a8e28af8258f0370df4ef486b8d', 269, 37, 1, 0, 0),
(2, 'pawel8412341', 'pawelsta1nislawczyk841@gmail.com', '9bfd43dde0aa7de26a1d62246800fb85ad510a8e28af8258f0370df4ef486b8d', 18, 0, 0, 0, 0),
(3, 'test1234', 'test@podam.pl', '9bfd43dde0aa7de26a1d62246800fb85ad510a8e28af8258f0370df4ef486b8d', 44, 1, 0, 0, 0);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `enemies`
--
ALTER TABLE `enemies`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `fish`
--
ALTER TABLE `fish`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`SID`);

--
-- Indeksy dla tabeli `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `market`
--
ALTER TABLE `market`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `mine`
--
ALTER TABLE `mine`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`RID`);

--
-- Indeksy dla tabeli `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `skill`
--
ALTER TABLE `skill`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `skill_xp`
--
ALTER TABLE `skill_xp`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `statistic`
--
ALTER TABLE `statistic`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `theft`
--
ALTER TABLE `theft`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `enemies`
--
ALTER TABLE `enemies`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `equipment`
--
ALTER TABLE `equipment`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `fish`
--
ALTER TABLE `fish`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `SID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `market`
--
ALTER TABLE `market`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `mine`
--
ALTER TABLE `mine`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `RID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `skill`
--
ALTER TABLE `skill`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `skill_xp`
--
ALTER TABLE `skill_xp`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `statistic`
--
ALTER TABLE `statistic`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `theft`
--
ALTER TABLE `theft`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
