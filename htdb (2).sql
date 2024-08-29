-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 29, 2024 at 09:15 AM
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
-- Database: `htdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `cemetery`
--

CREATE TABLE `cemetery` (
  `CemeteryID` int(10) UNSIGNED NOT NULL,
  `CemeteryName` varchar(255) DEFAULT NULL,
  `Town` int(10) UNSIGNED DEFAULT NULL,
  `NumberOfSections` varchar(255) DEFAULT NULL,
  `TotalGraves` varchar(255) DEFAULT NULL,
  `AvailableGraves` varchar(255) DEFAULT NULL,
  `SvgMap` blob DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cemetery`
--

INSERT INTO `cemetery` (`CemeteryID`, `CemeteryName`, `Town`, `NumberOfSections`, `TotalGraves`, `AvailableGraves`, `SvgMap`, `created_at`, `updated_at`) VALUES
(2, 'Katima Mulilo Cemetary ', 1, '3', NULL, NULL, 0x433a5c55736572735c63687269735c417070446174615c4c6f63616c5c54656d705c706870373630302e746d70, '2024-07-05 09:06:59', '2024-07-05 09:06:59'),
(3, 'Opongonda Cemetary ', 23, '4', NULL, NULL, NULL, '2024-07-08 07:39:17', '2024-07-08 07:39:17');

-- --------------------------------------------------------

--
-- Table structure for table `decor_companies`
--

CREATE TABLE `decor_companies` (
  `id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `contact_email` varchar(255) NOT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `portfolio_images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`portfolio_images`)),
  `company_logo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `decor_companies`
--

INSERT INTO `decor_companies` (`id`, `company_name`, `description`, `contact_email`, `contact_number`, `portfolio_images`, `company_logo`, `created_at`) VALUES
(1, 'Elegant Decor', 'We provide elegant decor services for various events.', 'contact@elegantdecor.com', '+1234567890', '[\"https://www.shutterstock.com/image-photo/scene-coffin-decorated-flowers-2467901643\"]', NULL, '2024-07-26 08:32:01'),
(2, 'BRADecor', 'We provide elegant decor services for Funeral events.', 'contact@egmboility.com', '+1234567890', '[\"https://www.shutterstock.com/image-photo/kharkiv-ukraine-june-13-2024-aleya-2476302965\"]', 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fstock.adobe.com%2Fsearch%2Fimages%3Fk%3Dhome%2Bdecor%2Blogo&psig=AOvVaw1kfHM-PwoKhftD_M2sLgRL&ust=1722069975312000&source=images&cd=vfe&opi=89978449&ved=0CBEQjRxqFwoTCIDdi8KqxIcDFQAAAAAdAAAAABAE', '2024-07-26 08:57:06');

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE `emails` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `grave`
--

CREATE TABLE `grave` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `CemeteryID` int(10) UNSIGNED NOT NULL,
  `SectionCode` varchar(255) NOT NULL,
  `RowID` varchar(255) NOT NULL,
  `GraveNum` int(10) UNSIGNED NOT NULL,
  `GraveStatus` tinyint(4) DEFAULT NULL,
  `BuriedPersonsName` varchar(255) DEFAULT NULL,
  `DateOfBirth` date DEFAULT NULL,
  `DateOfDeath` date DEFAULT NULL,
  `DeathCode` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `grave`
--

INSERT INTO `grave` (`id`, `CemeteryID`, `SectionCode`, `RowID`, `GraveNum`, `GraveStatus`, `BuriedPersonsName`, `DateOfBirth`, `DateOfDeath`, `DeathCode`, `created_at`, `updated_at`) VALUES
(2, 2, 'S_2_1', 'R_2_1_1', 1, NULL, NULL, NULL, NULL, NULL, '2024-07-05 09:06:59', '2024-07-05 09:06:59'),
(3, 2, 'S_2_1', 'R_2_1_1', 2, NULL, NULL, NULL, NULL, NULL, '2024-07-05 09:06:59', '2024-07-05 09:06:59'),
(4, 2, 'S_2_1', 'R_2_1_1', 3, NULL, NULL, NULL, NULL, NULL, '2024-07-05 09:06:59', '2024-07-05 09:06:59'),
(5, 2, 'S_2_1', 'R_2_1_1', 4, NULL, NULL, NULL, NULL, NULL, '2024-07-05 09:06:59', '2024-07-05 09:06:59'),
(6, 2, 'S_2_1', 'R_2_1_2', 1, NULL, NULL, NULL, NULL, NULL, '2024-07-05 09:06:59', '2024-07-05 09:06:59'),
(7, 2, 'S_2_1', 'R_2_1_2', 2, NULL, NULL, NULL, NULL, NULL, '2024-07-05 09:06:59', '2024-07-05 09:06:59'),
(8, 2, 'S_2_1', 'R_2_1_2', 3, NULL, NULL, NULL, NULL, NULL, '2024-07-05 09:06:59', '2024-07-05 09:06:59'),
(9, 2, 'S_2_1', 'R_2_1_3', 1, NULL, NULL, NULL, NULL, NULL, '2024-07-05 09:06:59', '2024-07-05 09:06:59'),
(10, 2, 'S_2_1', 'R_2_1_3', 2, NULL, NULL, NULL, NULL, NULL, '2024-07-05 09:06:59', '2024-07-05 09:06:59'),
(11, 2, 'S_2_1', 'R_2_1_4', 1, NULL, NULL, NULL, NULL, NULL, '2024-07-05 09:06:59', '2024-07-05 09:06:59'),
(12, 2, 'S_2_1', 'R_2_1_4', 2, NULL, NULL, NULL, NULL, NULL, '2024-07-05 09:06:59', '2024-07-05 09:06:59'),
(13, 2, 'S_2_1', 'R_2_1_4', 3, NULL, NULL, NULL, NULL, NULL, '2024-07-05 09:06:59', '2024-07-05 09:06:59'),
(14, 2, 'S_2_1', 'R_2_1_4', 4, NULL, NULL, NULL, NULL, NULL, '2024-07-05 09:06:59', '2024-07-05 09:06:59'),
(15, 2, 'S_2_1', 'R_2_1_5', 1, NULL, NULL, NULL, NULL, NULL, '2024-07-05 09:06:59', '2024-07-05 09:06:59'),
(16, 2, 'S_2_1', 'R_2_1_5', 2, NULL, NULL, NULL, NULL, NULL, '2024-07-05 09:06:59', '2024-07-05 09:06:59'),
(17, 2, 'S_2_1', 'R_2_1_5', 3, NULL, NULL, NULL, NULL, NULL, '2024-07-05 09:06:59', '2024-07-05 09:06:59'),
(18, 2, 'S_2_1', 'R_2_1_5', 4, NULL, NULL, NULL, NULL, NULL, '2024-07-05 09:06:59', '2024-07-05 09:06:59'),
(19, 2, 'S_2_2', 'R_2_2_1', 1, NULL, NULL, NULL, NULL, NULL, '2024-07-05 09:06:59', '2024-07-05 09:06:59'),
(20, 2, 'S_2_2', 'R_2_2_1', 2, NULL, NULL, NULL, NULL, NULL, '2024-07-05 09:06:59', '2024-07-05 09:06:59'),
(21, 2, 'S_2_2', 'R_2_2_1', 3, NULL, NULL, NULL, NULL, NULL, '2024-07-05 09:06:59', '2024-07-05 09:06:59'),
(22, 2, 'S_2_2', 'R_2_2_2', 1, NULL, NULL, NULL, NULL, NULL, '2024-07-05 09:06:59', '2024-07-05 09:06:59'),
(23, 2, 'S_2_2', 'R_2_2_2', 2, NULL, NULL, NULL, NULL, NULL, '2024-07-05 09:06:59', '2024-07-05 09:06:59'),
(24, 2, 'S_2_2', 'R_2_2_2', 3, NULL, NULL, NULL, NULL, NULL, '2024-07-05 09:06:59', '2024-07-05 09:06:59'),
(25, 2, 'S_2_3', 'R_2_3_1', 1, NULL, NULL, NULL, NULL, NULL, '2024-07-05 09:06:59', '2024-07-05 09:06:59'),
(26, 2, 'S_2_3', 'R_2_3_1', 2, NULL, NULL, NULL, NULL, NULL, '2024-07-05 09:06:59', '2024-07-05 09:06:59'),
(27, 2, 'S_2_3', 'R_2_3_1', 3, NULL, NULL, NULL, NULL, NULL, '2024-07-05 09:06:59', '2024-07-05 09:06:59'),
(28, 2, 'S_2_3', 'R_2_3_2', 1, NULL, NULL, NULL, NULL, NULL, '2024-07-05 09:06:59', '2024-07-05 09:06:59'),
(29, 2, 'S_2_3', 'R_2_3_2', 2, NULL, NULL, NULL, NULL, NULL, '2024-07-05 09:06:59', '2024-07-05 09:06:59'),
(30, 2, 'S_2_3', 'R_2_3_2', 3, NULL, NULL, NULL, NULL, NULL, '2024-07-05 09:06:59', '2024-07-05 09:06:59'),
(31, 2, 'S_2_3', 'R_2_3_2', 4, NULL, NULL, NULL, NULL, NULL, '2024-07-05 09:06:59', '2024-07-05 09:06:59'),
(32, 2, 'S_2_3', 'R_2_3_2', 5, NULL, NULL, NULL, NULL, NULL, '2024-07-05 09:06:59', '2024-07-05 09:06:59'),
(33, 2, 'S_2_3', 'R_2_3_3', 1, NULL, NULL, NULL, NULL, NULL, '2024-07-05 09:06:59', '2024-07-05 09:06:59'),
(34, 2, 'S_2_3', 'R_2_3_3', 2, NULL, NULL, NULL, NULL, NULL, '2024-07-05 09:06:59', '2024-07-05 09:06:59'),
(35, 2, 'S_2_3', 'R_2_3_3', 3, NULL, NULL, NULL, NULL, NULL, '2024-07-05 09:06:59', '2024-07-05 09:06:59'),
(36, 2, 'S_2_3', 'R_2_3_3', 4, NULL, NULL, NULL, NULL, NULL, '2024-07-05 09:06:59', '2024-07-05 09:06:59'),
(37, 2, 'S_2_3', 'R_2_3_3', 5, NULL, NULL, NULL, NULL, NULL, '2024-07-05 09:06:59', '2024-07-05 09:06:59'),
(38, 3, 'S_3_1', 'R_3_1_1', 1, 0, NULL, NULL, NULL, NULL, '2024-07-08 07:39:17', '2024-07-08 07:39:17'),
(39, 3, 'S_3_1', 'R_3_1_1', 2, NULL, NULL, NULL, NULL, NULL, '2024-07-08 07:39:17', '2024-07-08 07:39:17'),
(40, 3, 'S_3_1', 'R_3_1_1', 3, NULL, NULL, NULL, NULL, NULL, '2024-07-08 07:39:17', '2024-07-08 07:39:17'),
(41, 3, 'S_3_1', 'R_3_1_1', 4, NULL, NULL, NULL, NULL, NULL, '2024-07-08 07:39:17', '2024-07-08 07:39:17'),
(42, 3, 'S_3_1', 'R_3_1_2', 1, NULL, NULL, NULL, NULL, NULL, '2024-07-08 07:39:17', '2024-07-08 07:39:17'),
(43, 3, 'S_3_1', 'R_3_1_2', 2, 0, NULL, NULL, NULL, NULL, '2024-07-08 07:39:17', '2024-07-08 07:39:17'),
(44, 3, 'S_3_1', 'R_3_1_2', 3, NULL, NULL, NULL, NULL, NULL, '2024-07-08 07:39:17', '2024-07-08 07:39:17'),
(45, 3, 'S_3_1', 'R_3_1_2', 4, NULL, NULL, NULL, NULL, NULL, '2024-07-08 07:39:17', '2024-07-08 07:39:17'),
(46, 3, 'S_3_1', 'R_3_1_3', 1, NULL, NULL, NULL, NULL, NULL, '2024-07-08 07:39:17', '2024-07-08 07:39:17'),
(47, 3, 'S_3_1', 'R_3_1_3', 2, NULL, NULL, NULL, NULL, NULL, '2024-07-08 07:39:17', '2024-07-08 07:39:17'),
(48, 3, 'S_3_1', 'R_3_1_3', 3, NULL, NULL, NULL, NULL, NULL, '2024-07-08 07:39:17', '2024-07-08 07:39:17'),
(49, 3, 'S_3_1', 'R_3_1_3', 4, NULL, NULL, NULL, NULL, NULL, '2024-07-08 07:39:17', '2024-07-08 07:39:17'),
(50, 3, 'S_3_1', 'R_3_1_4', 1, NULL, NULL, NULL, NULL, NULL, '2024-07-08 07:39:17', '2024-07-08 07:39:17'),
(51, 3, 'S_3_1', 'R_3_1_4', 2, NULL, NULL, NULL, NULL, NULL, '2024-07-08 07:39:17', '2024-07-08 07:39:17'),
(52, 3, 'S_3_1', 'R_3_1_4', 3, NULL, NULL, NULL, NULL, NULL, '2024-07-08 07:39:17', '2024-07-08 07:39:17'),
(53, 3, 'S_3_1', 'R_3_1_4', 4, NULL, NULL, NULL, NULL, NULL, '2024-07-08 07:39:17', '2024-07-08 07:39:17'),
(54, 3, 'S_3_2', 'R_3_2_1', 1, 0, NULL, NULL, NULL, NULL, '2024-07-08 07:39:17', '2024-07-08 07:39:17'),
(55, 3, 'S_3_2', 'R_3_2_1', 2, NULL, NULL, NULL, NULL, NULL, '2024-07-08 07:39:17', '2024-07-08 07:39:17'),
(56, 3, 'S_3_2', 'R_3_2_1', 3, NULL, NULL, NULL, NULL, NULL, '2024-07-08 07:39:17', '2024-07-08 07:39:17'),
(57, 3, 'S_3_2', 'R_3_2_1', 4, NULL, NULL, NULL, NULL, NULL, '2024-07-08 07:39:17', '2024-07-08 07:39:17'),
(58, 3, 'S_3_2', 'R_3_2_2', 1, NULL, NULL, NULL, NULL, NULL, '2024-07-08 07:39:17', '2024-07-08 07:39:17'),
(59, 3, 'S_3_2', 'R_3_2_2', 2, NULL, NULL, NULL, NULL, NULL, '2024-07-08 07:39:17', '2024-07-08 07:39:17'),
(60, 3, 'S_3_2', 'R_3_2_2', 3, NULL, NULL, NULL, NULL, NULL, '2024-07-08 07:39:17', '2024-07-08 07:39:17'),
(61, 3, 'S_3_2', 'R_3_2_2', 4, NULL, NULL, NULL, NULL, NULL, '2024-07-08 07:39:17', '2024-07-08 07:39:17'),
(62, 3, 'S_3_2', 'R_3_2_3', 1, NULL, NULL, NULL, NULL, NULL, '2024-07-08 07:39:17', '2024-07-08 07:39:17'),
(63, 3, 'S_3_2', 'R_3_2_3', 2, NULL, NULL, NULL, NULL, NULL, '2024-07-08 07:39:17', '2024-07-08 07:39:17'),
(64, 3, 'S_3_2', 'R_3_2_3', 3, NULL, NULL, NULL, NULL, NULL, '2024-07-08 07:39:17', '2024-07-08 07:39:17'),
(65, 3, 'S_3_2', 'R_3_2_3', 4, NULL, NULL, NULL, NULL, NULL, '2024-07-08 07:39:17', '2024-07-08 07:39:17'),
(66, 3, 'S_3_2', 'R_3_2_4', 1, NULL, NULL, NULL, NULL, NULL, '2024-07-08 07:39:17', '2024-07-08 07:39:17'),
(67, 3, 'S_3_2', 'R_3_2_4', 2, NULL, NULL, NULL, NULL, NULL, '2024-07-08 07:39:17', '2024-07-08 07:39:17'),
(68, 3, 'S_3_2', 'R_3_2_4', 3, NULL, NULL, NULL, NULL, NULL, '2024-07-08 07:39:17', '2024-07-08 07:39:17'),
(69, 3, 'S_3_2', 'R_3_2_4', 4, NULL, NULL, NULL, NULL, NULL, '2024-07-08 07:39:17', '2024-07-08 07:39:17'),
(70, 3, 'S_3_3', 'R_3_3_1', 1, NULL, NULL, NULL, NULL, NULL, '2024-07-08 07:39:17', '2024-07-08 07:39:17'),
(71, 3, 'S_3_3', 'R_3_3_1', 2, NULL, NULL, NULL, NULL, NULL, '2024-07-08 07:39:17', '2024-07-08 07:39:17'),
(72, 3, 'S_3_3', 'R_3_3_1', 3, NULL, NULL, NULL, NULL, NULL, '2024-07-08 07:39:17', '2024-07-08 07:39:17'),
(73, 3, 'S_3_3', 'R_3_3_1', 4, NULL, NULL, NULL, NULL, NULL, '2024-07-08 07:39:17', '2024-07-08 07:39:17'),
(74, 3, 'S_3_3', 'R_3_3_2', 1, NULL, NULL, NULL, NULL, NULL, '2024-07-08 07:39:17', '2024-07-08 07:39:17'),
(75, 3, 'S_3_3', 'R_3_3_2', 2, NULL, NULL, NULL, NULL, NULL, '2024-07-08 07:39:17', '2024-07-08 07:39:17'),
(76, 3, 'S_3_3', 'R_3_3_2', 3, NULL, NULL, NULL, NULL, NULL, '2024-07-08 07:39:17', '2024-07-08 07:39:17'),
(77, 3, 'S_3_3', 'R_3_3_2', 4, NULL, NULL, NULL, NULL, NULL, '2024-07-08 07:39:17', '2024-07-08 07:39:17'),
(78, 3, 'S_3_3', 'R_3_3_3', 1, NULL, NULL, NULL, NULL, NULL, '2024-07-08 07:39:17', '2024-07-08 07:39:17'),
(79, 3, 'S_3_3', 'R_3_3_3', 2, NULL, NULL, NULL, NULL, NULL, '2024-07-08 07:39:17', '2024-07-08 07:39:17'),
(80, 3, 'S_3_3', 'R_3_3_3', 3, NULL, NULL, NULL, NULL, NULL, '2024-07-08 07:39:17', '2024-07-08 07:39:17'),
(81, 3, 'S_3_3', 'R_3_3_3', 4, NULL, NULL, NULL, NULL, NULL, '2024-07-08 07:39:17', '2024-07-08 07:39:17'),
(82, 3, 'S_3_3', 'R_3_3_4', 1, NULL, NULL, NULL, NULL, NULL, '2024-07-08 07:39:17', '2024-07-08 07:39:17'),
(83, 3, 'S_3_3', 'R_3_3_4', 2, NULL, NULL, NULL, NULL, NULL, '2024-07-08 07:39:17', '2024-07-08 07:39:17'),
(84, 3, 'S_3_3', 'R_3_3_4', 3, NULL, NULL, NULL, NULL, NULL, '2024-07-08 07:39:17', '2024-07-08 07:39:17'),
(85, 3, 'S_3_3', 'R_3_3_4', 4, NULL, NULL, NULL, NULL, NULL, '2024-07-08 07:39:17', '2024-07-08 07:39:17'),
(86, 3, 'S_3_4', 'R_3_4_1', 1, NULL, NULL, NULL, NULL, NULL, '2024-07-08 07:39:17', '2024-07-08 07:39:17'),
(87, 3, 'S_3_4', 'R_3_4_1', 2, NULL, NULL, NULL, NULL, NULL, '2024-07-08 07:39:17', '2024-07-08 07:39:17'),
(88, 3, 'S_3_4', 'R_3_4_1', 3, NULL, NULL, NULL, NULL, NULL, '2024-07-08 07:39:17', '2024-07-08 07:39:17'),
(89, 3, 'S_3_4', 'R_3_4_1', 4, NULL, NULL, NULL, NULL, NULL, '2024-07-08 07:39:17', '2024-07-08 07:39:17'),
(90, 3, 'S_3_4', 'R_3_4_2', 1, NULL, NULL, NULL, NULL, NULL, '2024-07-08 07:39:17', '2024-07-08 07:39:17'),
(91, 3, 'S_3_4', 'R_3_4_2', 2, NULL, NULL, NULL, NULL, NULL, '2024-07-08 07:39:17', '2024-07-08 07:39:17'),
(92, 3, 'S_3_4', 'R_3_4_2', 3, NULL, NULL, NULL, NULL, NULL, '2024-07-08 07:39:17', '2024-07-08 07:39:17'),
(93, 3, 'S_3_4', 'R_3_4_2', 4, NULL, NULL, NULL, NULL, NULL, '2024-07-08 07:39:17', '2024-07-08 07:39:17'),
(94, 3, 'S_3_4', 'R_3_4_3', 1, NULL, NULL, NULL, NULL, NULL, '2024-07-08 07:39:17', '2024-07-08 07:39:17'),
(95, 3, 'S_3_4', 'R_3_4_3', 2, NULL, NULL, NULL, NULL, NULL, '2024-07-08 07:39:17', '2024-07-08 07:39:17'),
(96, 3, 'S_3_4', 'R_3_4_3', 3, NULL, NULL, NULL, NULL, NULL, '2024-07-08 07:39:17', '2024-07-08 07:39:17'),
(97, 3, 'S_3_4', 'R_3_4_3', 4, NULL, NULL, NULL, NULL, NULL, '2024-07-08 07:39:17', '2024-07-08 07:39:17'),
(98, 3, 'S_3_4', 'R_3_4_4', 1, NULL, NULL, NULL, NULL, NULL, '2024-07-08 07:39:17', '2024-07-08 07:39:17'),
(99, 3, 'S_3_4', 'R_3_4_4', 2, NULL, NULL, NULL, NULL, NULL, '2024-07-08 07:39:17', '2024-07-08 07:39:17'),
(100, 3, 'S_3_4', 'R_3_4_4', 3, NULL, NULL, NULL, NULL, NULL, '2024-07-08 07:39:17', '2024-07-08 07:39:17'),
(101, 3, 'S_3_4', 'R_3_4_4', 4, NULL, NULL, NULL, NULL, NULL, '2024-07-08 07:39:17', '2024-07-08 07:39:17');

-- --------------------------------------------------------

--
-- Table structure for table `grave_sections`
--

CREATE TABLE `grave_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `CemeteryID` int(10) UNSIGNED NOT NULL,
  `SectionCode` varchar(255) NOT NULL,
  `Rows` int(10) UNSIGNED NOT NULL,
  `SectionType` varchar(255) DEFAULT NULL,
  `SectionSvg` blob DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `grave_sections`
--

INSERT INTO `grave_sections` (`id`, `CemeteryID`, `SectionCode`, `Rows`, `SectionType`, `SectionSvg`, `created_at`, `updated_at`) VALUES
(2, 2, 'S_2_1', 5, NULL, NULL, NULL, NULL),
(3, 2, 'S_2_2', 2, NULL, NULL, NULL, NULL),
(4, 2, 'S_2_3', 3, NULL, NULL, NULL, NULL),
(5, 3, 'S_3_1', 4, NULL, NULL, NULL, NULL),
(6, 3, 'S_3_2', 4, NULL, NULL, NULL, NULL),
(7, 3, 'S_3_3', 4, NULL, NULL, NULL, NULL),
(8, 3, 'S_3_4', 4, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(14, '2014_10_12_000000_create_users_table', 1),
(15, '2014_10_12_100000_create_password_resets_table', 1),
(16, '2019_08_19_000000_create_failed_jobs_table', 1),
(17, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(18, '2023_02_17_180517_create_regions_table', 1),
(19, '2023_02_18_094123_create_towns_table', 1),
(20, '2023_10_18_061837_create_cemetery_table', 1),
(21, '2023_10_18_063356_create_grave_sections_table', 1),
(22, '2024_02_17_173009_create_grave_table', 1),
(23, '2024_03_21_204121_create_rows_table', 1),
(24, '2024_04_02_140436_create_service_providers_table', 1),
(25, '2024_04_02_141150_create_services_table', 1),
(26, '2024_04_03_074528_create_orders_table', 1),
(27, '2024_04_18_193912_create_ordered_services_table', 2),
(28, '2024_05_14_105618_create_reviews_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `ordered_services`
--

CREATE TABLE `ordered_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `UserId` varchar(255) DEFAULT NULL,
  `ServiceId` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `UserId` varchar(255) DEFAULT NULL,
  `CemeteryID` int(10) UNSIGNED NOT NULL,
  `SectionCode` varchar(255) NOT NULL,
  `RowID` varchar(255) NOT NULL,
  `GraveNum` int(10) UNSIGNED NOT NULL,
  `BuyerName` varchar(255) NOT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `IdNumber` int(10) UNSIGNED NOT NULL,
  `PhoneNumber` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `UserId`, `CemeteryID`, `SectionCode`, `RowID`, `GraveNum`, `BuyerName`, `Email`, `IdNumber`, `PhoneNumber`, `created_at`, `updated_at`) VALUES
(1, '5tk3mfhjjoh7k162lb7itbdjlu', 3, 'S_3_1', 'R_3_1_1', 1, '', '', 0, 0, '2024-07-19 10:34:53', '2024-07-19 10:34:53'),
(2, '5tk3mfhjjoh7k162lb7itbdjlu', 3, 'S_3_2', 'R_3_2_1', 1, 'Christy Diamonds', 'christydiamonds10@gmail.com', 3062200598, 817723680, '2024-07-19 14:19:38', '2024-07-19 14:19:38'),
(3, '8ov7ig6upc776osd8j8441gs5v', 3, 'S_3_1', 'R_3_1_2', 2, 'Christy Diamonds', 'christydiamonds10@gmail.com', 3062200598, 817723680, '2024-07-23 10:45:26', '2024-07-23 10:45:26');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quotations`
--

CREATE TABLE `quotations` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `grave_num` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `card_number` varchar(16) NOT NULL,
  `card_cvc` varchar(3) NOT NULL,
  `exp_month` varchar(2) NOT NULL,
  `exp_year` varchar(4) NOT NULL,
  `quotation_id` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `region` varchar(255) DEFAULT NULL,
  `town` varchar(255) DEFAULT NULL,
  `cemetery` varchar(255) DEFAULT NULL,
  `section` varchar(255) DEFAULT NULL,
  `row` varchar(255) DEFAULT NULL,
  `name_of_deceased` varchar(255) DEFAULT NULL,
  `receipt_number` varchar(255) DEFAULT NULL,
  `burial_date` date DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `approval_token` varchar(32) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `region_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `iframe_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`region_id`, `name`, `created_at`, `updated_at`, `iframe_url`) VALUES
(1, 'Zambezi', NULL, NULL, 'https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d243496.44551956045!2d24.5543446!3d-17.52507365!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sZambezi%20region%20cemeteries!5e0!3m2!1sen!2sna!4v1721642130603!5m2!1sen!2sna'),
(2, 'Kavango', NULL, NULL, 'https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d121488.35338131072!2d19.916089749999998!3d-17.90830275!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sKavango%20region%20cemeteries!5e0!3m2!1sen!2sna!4v1721641861353!5m2!1sen!2sna'),
(3, 'Kunene', NULL, NULL, 'https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d3713310.458426726!2d15.364215365528008!3d-24.64849751483451!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1skunene%20region%20cemeteries!5e0!3m2!1sen!2sna!4v1721640768346!5m2!1sen!2sna'),
(4, 'Omusati', NULL, NULL, 'https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d486719.79501009744!2d15.304583850000002!3d-17.62653835!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sOmusati%20region%20cemeteries!5e0!3m2!1sen!2sna!4v1721641572663!5m2!1sen!2sna'),
(5, 'Ohangwena', NULL, NULL, 'https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d486587.82436251605!2d15.935072099999998!3d-17.6753679!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sOhangwena%20region%20cemeteries!5e0!3m2!1sen!2sna!4v1721641751551!5m2!1sen!2sna'),
(6, 'Oshana', NULL, NULL, 'https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d486477.99652566627!2d15.7642455!3d-17.7159052!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sOshana%20region%20cemeteries!5e0!3m2!1sen!2sna!4v1721641673093!5m2!1sen!2sna'),
(7, 'Oshikoto', NULL, NULL, 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3766.8855922417556!2d17.697349149999997!3d-19.24381725!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1bf2383c66040d23%3A0x42496c180fd46ae7!2sNomtsoub%20Cemetery%2C%20Tsumeb!5e0!3m2!1sen!2sna!4v17'),
(8, 'Omaheke', NULL, NULL, 'https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d1881566.620138259!2d19.071290849999997!3d-22.9157754!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sOmaheke%20region%20cemeteries!5e0!3m2!1sen!2sna!4v1721641036504!5m2!1sen!2sna'),
(9, 'Otjozondjupa', NULL, NULL, 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d11480.953810628585!2d17.328495420407666!3d-19.635969837097225!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1bf3a9bf03cf944f%3A0x4878f33508b9ac4e!2sBETESDA%20PARISH!5e0!3m2!1sen!2sna!4v1721641146'),
(10, 'Erongo', NULL, NULL, 'https://www.google.com/maps/embed?pb=!1m12!1m8!1m3!1d1851664.6845402562!2d15.249149220172418!3d-23.34281235232149!3m2!1i1024!2i768!4f13.1!2m1!1serongo%20region%20cemeteries!5e0!3m2!1sen!2sna!4v1721719829225!5m2!1sen!2sna'),
(11, 'Khomas', NULL, NULL, 'https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d58956.01472627581!2d17.029500431885058!3d-22.55100145357109!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sKhomas%20region%20cemeteries!5e0!3m2!1sen!2sna!4v1721636832201!5m2!1sen!2sna'),
(12, 'Hardap', NULL, NULL, 'https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d376908.1400948842!2d17.743642054734625!3d-24.647449580393275!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1shardap%20region%20cemeteries!5e0!3m2!1sen!2sna!4v1721640590810!5m2!1sen!2sna'),
(13, 'Karas', NULL, NULL, 'https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d3748421.68451195!2d15.217982492790185!3d-23.439965793464633!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1skaras%20region%20cemeteries!5e0!3m2!1sen!2sna!4v1721640228907!5m2!1sen!2sna');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Review` varchar(255) NOT NULL,
  `ProviderId` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rows`
--

CREATE TABLE `rows` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `CemeteryID` int(10) UNSIGNED NOT NULL,
  `SectionCode` varchar(255) NOT NULL,
  `RowID` varchar(255) NOT NULL,
  `TotalGraves` int(10) UNSIGNED NOT NULL,
  `AvailableGraves` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rows`
--

INSERT INTO `rows` (`id`, `CemeteryID`, `SectionCode`, `RowID`, `TotalGraves`, `AvailableGraves`, `created_at`, `updated_at`) VALUES
(2, 2, 'S_2_1', 'R_2_1_1', 4, 4, NULL, NULL),
(3, 2, 'S_2_1', 'R_2_1_2', 3, 3, NULL, NULL),
(4, 2, 'S_2_1', 'R_2_1_3', 2, 2, NULL, NULL),
(5, 2, 'S_2_1', 'R_2_1_4', 4, 4, NULL, NULL),
(6, 2, 'S_2_1', 'R_2_1_5', 4, 4, NULL, NULL),
(7, 2, 'S_2_2', 'R_2_2_1', 3, 3, NULL, NULL),
(8, 2, 'S_2_2', 'R_2_2_2', 3, 3, NULL, NULL),
(9, 2, 'S_2_3', 'R_2_3_1', 3, 3, NULL, NULL),
(10, 2, 'S_2_3', 'R_2_3_2', 5, 5, NULL, NULL),
(11, 2, 'S_2_3', 'R_2_3_3', 5, 5, NULL, NULL),
(12, 3, 'S_3_1', 'R_3_1_1', 4, 4, NULL, NULL),
(13, 3, 'S_3_1', 'R_3_1_2', 4, 4, NULL, NULL),
(14, 3, 'S_3_1', 'R_3_1_3', 4, 4, NULL, NULL),
(15, 3, 'S_3_1', 'R_3_1_4', 4, 4, NULL, NULL),
(16, 3, 'S_3_2', 'R_3_2_1', 4, 4, NULL, NULL),
(17, 3, 'S_3_2', 'R_3_2_2', 4, 4, NULL, NULL),
(18, 3, 'S_3_2', 'R_3_2_3', 4, 4, NULL, NULL),
(19, 3, 'S_3_2', 'R_3_2_4', 4, 4, NULL, NULL),
(20, 3, 'S_3_3', 'R_3_3_1', 4, 4, NULL, NULL),
(21, 3, 'S_3_3', 'R_3_3_2', 4, 4, NULL, NULL),
(22, 3, 'S_3_3', 'R_3_3_3', 4, 4, NULL, NULL),
(23, 3, 'S_3_3', 'R_3_3_4', 4, 4, NULL, NULL),
(24, 3, 'S_3_4', 'R_3_4_1', 4, 4, NULL, NULL),
(25, 3, 'S_3_4', 'R_3_4_2', 4, 4, NULL, NULL),
(26, 3, 'S_3_4', 'R_3_4_3', 4, 4, NULL, NULL),
(27, 3, 'S_3_4', 'R_3_4_4', 4, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ServiceName` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Price` decimal(10,2) NOT NULL,
  `ProviderId` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service_providers`
--

CREATE TABLE `service_providers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Motto` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `ContactNumber` int(10) UNSIGNED NOT NULL,
  `TotalBurials` int(10) UNSIGNED NOT NULL,
  `SuccessfulBurials` int(10) UNSIGNED NOT NULL,
  `UnsuccessfulBurials` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_providers`
--

INSERT INTO `service_providers` (`id`, `Name`, `Motto`, `Email`, `ContactNumber`, `TotalBurials`, `SuccessfulBurials`, `UnsuccessfulBurials`, `created_at`, `updated_at`) VALUES
(1, 'Namibian Burial Service', 'Providing Dignified Rest', 'info@namibianburials.com', 4294967295, 1000, 800, 200, '2024-07-15 12:24:50', '2024-07-15 12:24:50'),
(2, 'AVBOB', 'Providing comfort', 'Avbob@namibianburials.com', 4294967295, 1000, 950, 50, '2024-07-15 12:47:22', '2024-07-15 12:47:22');

-- --------------------------------------------------------

--
-- Table structure for table `towns`
--

CREATE TABLE `towns` (
  `town_id` int(10) UNSIGNED NOT NULL,
  `region_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `towns`
--

INSERT INTO `towns` (`town_id`, `region_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Katima Mulilo', NULL, NULL),
(2, 2, 'Nkurenkuru', NULL, NULL),
(3, 2, 'Rundu', NULL, NULL),
(4, 3, 'Khorixas', NULL, NULL),
(5, 3, 'Opuwo', NULL, NULL),
(6, 4, 'Okahao', NULL, NULL),
(7, 4, 'Oshikuku', NULL, NULL),
(8, 4, 'Outapi', NULL, NULL),
(9, 4, 'Ruacana', NULL, NULL),
(10, 5, 'Eenhana', NULL, NULL),
(11, 5, 'Helao Nafidi', NULL, NULL),
(12, 6, 'Oshakati', NULL, NULL),
(13, 6, 'Ondangwa', NULL, NULL),
(14, 6, 'Ongwediva', NULL, NULL),
(15, 7, 'Omuthiya', NULL, NULL),
(16, 7, 'Oniipa', NULL, NULL),
(17, 8, 'Gobabis', NULL, NULL),
(18, 9, 'Otavi', NULL, NULL),
(19, 9, 'Okakarara', NULL, NULL),
(20, 10, 'Arandis', NULL, NULL),
(21, 10, 'Karibib', NULL, NULL),
(22, 10, 'Usakos', NULL, NULL),
(23, 11, 'Windhoek', NULL, NULL),
(24, 12, 'Aranos', NULL, NULL),
(25, 12, 'Rehoboth', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_type` varchar(255) DEFAULT NULL,
  `services` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `motto` text DEFAULT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `company_email` varchar(255) DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL,
  `constituency` varchar(255) DEFAULT NULL,
  `classification` enum('Municipality','Town','Village') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `user_type`, `services`, `description`, `motto`, `contact_number`, `company_email`, `region`, `constituency`, `classification`) VALUES
(1, 'Tobbu', 'imajnr@gmail.com', NULL, '$2y$10$iuYNyIkkot2caZiZvowUBOeUtAS0IoEE16OmMvNWpE7H1qHiW7vg6', NULL, '2024-04-09 12:49:25', '2024-04-09 12:49:25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'Christy Diamonds', 'christydiamonds10@gmail.com', NULL, '$2y$10$JzafLpucyMDKTpuecb6yveatYjWRX9PWsao1oJW5sC..2fdVTMFSa', NULL, '2024-07-05 08:39:12', '2024-07-05 08:39:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'ester ndana', 'esterndana@gmail.com', NULL, '$2y$10$AXBW2VQrPvvcUDfZUWAcU.RsbRdR30tVmC.TcL/tPE0VdEYNcc33O', NULL, NULL, NULL, 'service_provider', 'Burial', 'dignified rest and affordable', 'JUST DO IT', '0817723680', 'esterndana@gmail.com', NULL, NULL, NULL),
(5, 'john doe', 'johndoe@gmail.com', NULL, '$2y$10$IgQX0oHmPl6mARIM4npE3.ZQMDG7y7G0mFkY5SzPtt5sUwFPZiOsq', NULL, NULL, NULL, 'service_provider', 'Burial', 'dignified rest and affordable', 'JUST DO IT', '0817723680', 'johndoe@gmail.com', NULL, NULL, NULL),
(6, 'jane doe', 'janedoe@gmail.com', NULL, '$2y$10$eeqQ2g/ihlcvNNe9Y78cROCIXT2JxkUwsLAUhxtjU0NxizlreoOCC', NULL, NULL, NULL, 'service_provider', 'Burial', 'dignified rest and affordable', 'JUST DO IT', '0817723680', 'janedoe@gmail.com', NULL, NULL, NULL),
(7, 'Vatiraije Ujava', 'ujavavatiraije74@gmail.com', NULL, '$2y$10$Sfe0ZGd8Q00SFPEsQXnt/eY9.cVqshTV1.fsn5Zr5Oyv1vF9ieDyi', NULL, '2024-07-24 14:42:49', '2024-07-24 14:42:49', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'Christy Diamonds', 'test01@gmail.com', NULL, '$2y$10$7UsHAWK2oLhJzBKoVXtAHeFlwqtT/fwjN/YsipA2u.5jGyhma3Co2', NULL, NULL, NULL, 'local_authority', NULL, NULL, NULL, '0817723680', NULL, 'Khomas', 'rural', 'Municipality'),
(9, 'Christy Diamonds', 'christydiamonds101@gmail.com', NULL, '$2y$10$iwciDcfbGaGNpMDr4nEa0OB2EE.suqyM.krV7UDBoSCuWTAX4Ntia', NULL, NULL, NULL, 'service_provider', '', '', '', '', '', NULL, NULL, NULL),
(10, 'Christy Diamonds', 'christydiamonds10111@gmail.com', NULL, '$2y$10$togbCInMmY5NleE6mUe9pOUZOaGMeVBHhoxs.U5gIxeqd8UhMgrBK', NULL, NULL, NULL, 'service_provider', 'Burial', 'dignified rest and affordable', 'JUST DO IT', '0817723680', 'christydiamonds101@gmail.com', NULL, NULL, NULL),
(11, 'Christy Diamonds', 'christydiamonds1011123@gmail.com', NULL, '$2y$10$rs05sYysbLJM8r1l6xJGoelk2olcyDYHBvZUpto9diG2WTUod4JtK', NULL, NULL, NULL, 'service_provider', 'Burial', 'dignified rest and affordable', 'JUST DO IT', '0817723680', 'christydiamonds10@gmail.com', NULL, NULL, NULL),
(12, 'Christy Diamonds', 'christydiamonds12345@gmail.com', NULL, '$2y$10$uOZLVdJ.gI76SsO/uMt2Y.c6cRanOhYNhkSC93NbzoLBDel16TrR6', NULL, '2024-08-26 09:31:16', '2024-08-26 09:31:16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cemetery`
--
ALTER TABLE `cemetery`
  ADD PRIMARY KEY (`CemeteryID`),
  ADD KEY `cemetery_town_foreign` (`Town`);

--
-- Indexes for table `decor_companies`
--
ALTER TABLE `decor_companies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `contact_email` (`contact_email`);

--
-- Indexes for table `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `grave`
--
ALTER TABLE `grave`
  ADD PRIMARY KEY (`id`),
  ADD KEY `grave_cemeteryid_foreign` (`CemeteryID`);

--
-- Indexes for table `grave_sections`
--
ALTER TABLE `grave_sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `grave_sections_cemeteryid_foreign` (`CemeteryID`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ordered_services`
--
ALTER TABLE `ordered_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ordered_services_serviceid_foreign` (`ServiceId`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_cemeteryid_foreign` (`CemeteryID`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `quotations`
--
ALTER TABLE `quotations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `quotation_id` (`quotation_id`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`region_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_providerid_foreign` (`ProviderId`);

--
-- Indexes for table `rows`
--
ALTER TABLE `rows`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rows_cemeteryid_foreign` (`CemeteryID`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `services_providerid_foreign` (`ProviderId`);

--
-- Indexes for table `service_providers`
--
ALTER TABLE `service_providers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `towns`
--
ALTER TABLE `towns`
  ADD PRIMARY KEY (`town_id`),
  ADD KEY `towns_region_id_index` (`region_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cemetery`
--
ALTER TABLE `cemetery`
  MODIFY `CemeteryID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `decor_companies`
--
ALTER TABLE `decor_companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grave`
--
ALTER TABLE `grave`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `grave_sections`
--
ALTER TABLE `grave_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `ordered_services`
--
ALTER TABLE `ordered_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quotations`
--
ALTER TABLE `quotations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `region_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rows`
--
ALTER TABLE `rows`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service_providers`
--
ALTER TABLE `service_providers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `towns`
--
ALTER TABLE `towns`
  MODIFY `town_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cemetery`
--
ALTER TABLE `cemetery`
  ADD CONSTRAINT `cemetery_town_foreign` FOREIGN KEY (`Town`) REFERENCES `towns` (`town_id`) ON DELETE CASCADE;

--
-- Constraints for table `grave`
--
ALTER TABLE `grave`
  ADD CONSTRAINT `grave_cemeteryid_foreign` FOREIGN KEY (`CemeteryID`) REFERENCES `cemetery` (`CemeteryID`) ON DELETE CASCADE;

--
-- Constraints for table `grave_sections`
--
ALTER TABLE `grave_sections`
  ADD CONSTRAINT `grave_sections_cemeteryid_foreign` FOREIGN KEY (`CemeteryID`) REFERENCES `cemetery` (`CemeteryID`) ON DELETE CASCADE;

--
-- Constraints for table `ordered_services`
--
ALTER TABLE `ordered_services`
  ADD CONSTRAINT `ordered_services_serviceid_foreign` FOREIGN KEY (`ServiceId`) REFERENCES `services` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_cemeteryid_foreign` FOREIGN KEY (`CemeteryID`) REFERENCES `cemetery` (`CemeteryID`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_providerid_foreign` FOREIGN KEY (`ProviderId`) REFERENCES `service_providers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rows`
--
ALTER TABLE `rows`
  ADD CONSTRAINT `rows_cemeteryid_foreign` FOREIGN KEY (`CemeteryID`) REFERENCES `cemetery` (`CemeteryID`) ON DELETE CASCADE;

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_providerid_foreign` FOREIGN KEY (`ProviderId`) REFERENCES `service_providers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `towns`
--
ALTER TABLE `towns`
  ADD CONSTRAINT `towns_region_id_foreign` FOREIGN KEY (`region_id`) REFERENCES `regions` (`region_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
