-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2024 at 04:53 PM
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
(1, 'Dren', 1, '1', NULL, NULL, NULL, '2024-04-09 12:50:20', '2024-04-09 12:50:20');

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
(1, 1, 'S_1_1', 'R_1_1_1', 1, NULL, NULL, NULL, NULL, NULL, '2024-04-09 12:50:20', '2024-04-09 12:50:20');

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
(1, 1, 'S_1_1', 1, NULL, NULL, NULL, NULL);

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
(26, '2024_04_03_074528_create_orders_table', 1);

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
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `region_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`region_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Zambezi', NULL, NULL),
(2, 'Kavango', NULL, NULL),
(3, 'Kunene', NULL, NULL),
(4, 'Omusati', NULL, NULL),
(5, 'Ohangwena', NULL, NULL),
(6, 'Oshana', NULL, NULL),
(7, 'Oshikoto', NULL, NULL),
(8, 'Omaheke', NULL, NULL),
(9, 'Otjozondjupa', NULL, NULL),
(10, 'Erongo', NULL, NULL),
(11, 'Khomas', NULL, NULL),
(12, 'Hardap', NULL, NULL),
(13, 'Karas', NULL, NULL);

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
(1, 1, 'S_1_1', 'R_1_1_1', 1, 1, NULL, NULL);

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
(3, 3, 'Rundu', NULL, NULL),
(4, 4, 'Khorixas', NULL, NULL),
(5, 4, 'Opuwo', NULL, NULL),
(6, 5, 'Okahao', NULL, NULL),
(7, 5, 'Oshikuku', NULL, NULL),
(8, 5, 'Outapi', NULL, NULL),
(9, 5, 'Ruacana', NULL, NULL),
(10, 6, 'Eenhana', NULL, NULL),
(11, 6, 'Helao Nafidi', NULL, NULL),
(12, 7, 'Oshakati', NULL, NULL),
(13, 7, 'Ondangwa', NULL, NULL),
(14, 7, 'Ongwediva', NULL, NULL),
(15, 8, 'Omuthiya', NULL, NULL),
(16, 8, 'Oniipa', NULL, NULL),
(17, 9, 'Gobabis', NULL, NULL),
(18, 10, 'Otavi', NULL, NULL),
(19, 10, 'Okakarara', NULL, NULL),
(20, 11, 'Arandis', NULL, NULL),
(21, 11, 'Karibib', NULL, NULL),
(22, 11, 'Usakos', NULL, NULL),
(23, 12, 'Windhoek', NULL, NULL),
(24, 13, 'Aranos', NULL, NULL),
(25, 13, 'Rehoboth', NULL, NULL);

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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Tobbu', 'imajnr@gmail.com', NULL, '$2y$10$iuYNyIkkot2caZiZvowUBOeUtAS0IoEE16OmMvNWpE7H1qHiW7vg6', NULL, '2024-04-09 12:49:25', '2024-04-09 12:49:25');

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
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`region_id`);

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
  MODIFY `CemeteryID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grave`
--
ALTER TABLE `grave`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `grave_sections`
--
ALTER TABLE `grave_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `region_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `rows`
--
ALTER TABLE `rows`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service_providers`
--
ALTER TABLE `service_providers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `towns`
--
ALTER TABLE `towns`
  MODIFY `town_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_cemeteryid_foreign` FOREIGN KEY (`CemeteryID`) REFERENCES `cemetery` (`CemeteryID`) ON DELETE CASCADE;

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
