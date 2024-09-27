-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 27, 2024 at 10:49 AM
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
-- Database: `support_ticket_system_db`
--

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
(336, '2014_10_12_000000_create_users_table', 1),
(337, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(338, '2019_08_19_000000_create_failed_jobs_table', 1),
(339, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(340, '2024_09_24_170937_create_roles_table', 1),
(341, '2024_09_24_175844_create_tickets_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
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
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '0 => inactive, 1 => active',
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `is_active`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 1, 'Admin', 'admin', '2024-09-27 08:48:44', '2024-09-27 08:48:44'),
(2, 1, 'Customer', 'customer', '2024-09-27 08:48:44', '2024-09-27 08:48:44');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ticket_no` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1 => open, 2 => closed',
  `agent_id` int(11) NOT NULL,
  `comment` text DEFAULT NULL,
  `closed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `ticket_no`, `user_id`, `title`, `description`, `status`, `agent_id`, `comment`, `closed_at`, `created_at`, `updated_at`) VALUES
(1, '324092738', 3, 'sint', 'Sint quisquam rerum facilis ex veritatis voluptatibus. Sequi laborum optio ducimus architecto aperiam ut quia. Quas asperiores hic sed aperiam error inventore veniam impedit.', 2, 1, 'Cumque error recusandae et iusto et occaecati.', '2024-08-29 19:20:53', '2024-09-27 08:48:45', '2024-09-27 08:48:45'),
(2, '224092788', 2, 'possimus', 'Labore culpa quisquam debitis consequuntur eligendi. Laborum dolorem distinctio ea. Non tenetur nihil et qui et quo. Quisquam et rerum neque at dolorum et vel. Fuga fugiat dolorum cumque consequatur illum occaecati itaque.', 2, 1, 'Fugit quibusdam consequatur doloribus.', '2024-09-27 04:15:14', '2024-09-27 08:48:45', '2024-09-27 08:48:45'),
(3, '124092727', 1, 'quasi', 'Accusantium tenetur et autem aut sapiente in beatae. Aut quidem molestiae voluptates soluta. Debitis omnis omnis voluptas itaque minima molestiae. Necessitatibus eaque voluptas perspiciatis quaerat.', 2, 1, 'Quo fugit vel exercitationem nihil excepturi et.', '2024-09-14 22:17:08', '2024-09-27 08:48:45', '2024-09-27 08:48:45'),
(4, '324092744', 3, 'possimus', 'Rerum ex molestias omnis distinctio quis et. Harum nesciunt ratione iusto voluptas consequuntur. Tempore doloremque libero aut sapiente.', 1, 1, NULL, NULL, '2024-09-27 08:48:45', '2024-09-27 08:48:45'),
(5, '324092755', 3, 'minus', 'Aliquid est quos consequatur illum blanditiis natus quia. Consequatur id nostrum veritatis consequatur. Quo minima nam quo odio aut eius debitis. Quae esse debitis aut impedit. Nam aliquid aut et aut autem voluptatem nihil.', 1, 1, NULL, NULL, '2024-09-27 08:48:45', '2024-09-27 08:48:45'),
(6, '124092796', 1, 'voluptatem', 'Facere voluptas et quia quasi. Enim omnis doloremque molestiae dolor dolorum atque sit. Aspernatur sequi reprehenderit autem ratione unde.', 1, 1, NULL, NULL, '2024-09-27 08:48:45', '2024-09-27 08:48:45'),
(7, '324092776', 3, 'incidunt', 'Consequatur et facilis dolores ratione itaque optio nihil. Consequatur consectetur veritatis architecto cupiditate soluta earum. Sint molestias eius asperiores eius. Blanditiis aliquam dolorem aut assumenda quo vero.', 1, 1, NULL, NULL, '2024-09-27 08:48:45', '2024-09-27 08:48:45'),
(8, '224092722', 2, 'officia', 'Saepe perspiciatis sequi inventore eos cum repudiandae. Eos rerum dolorem est atque eos.', 1, 1, NULL, NULL, '2024-09-27 08:48:45', '2024-09-27 08:48:45');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '0 => inactive, 1 => active',
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `role_id` tinyint(4) NOT NULL DEFAULT 2 COMMENT '1 => admin, 2 => customer',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `is_active`, `name`, `email`, `phone`, `role_id`, `email_verified_at`, `password`, `remember_token`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Admin', 'admin@test.com', '1234567890', 1, NULL, '$2y$12$jpM8kHqgfcvlzqHJHprh1eda3uYRTfjxpFhKM5fxo9OmOFN4MQNRa', NULL, NULL, NULL, NULL, '2024-09-27 08:48:44', '2024-09-27 08:48:44', NULL),
(2, 1, 'Test Customer-1', 'customer1@test.com', '9876543211', 2, NULL, '$2y$12$qoRwiu/7rQhfNx1Vl/UZGeE7.sRbwuesB426S5ttTIypn.RgEcYGC', NULL, NULL, NULL, NULL, '2024-09-27 08:48:44', '2024-09-27 08:48:44', NULL),
(3, 1, 'Test Customer-2', 'customer2@test.com', '5678901234', 2, NULL, '$2y$12$oyDayTcznZa8zH5wrB6XoeKpNSTEhro3xf9fRyX92ivCOSddS4fxW', NULL, NULL, NULL, NULL, '2024-09-27 08:48:44', '2024-09-27 08:48:44', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_slug_unique` (`slug`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tickets_ticket_no_unique` (`ticket_no`);

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=342;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
