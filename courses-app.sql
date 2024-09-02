-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 02 sep. 2024 à 18:19
-- Version du serveur : 8.2.0
-- Version de PHP : 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `courses-app`
--

-- --------------------------------------------------------

--
-- Structure de la table `courses`
--

DROP TABLE IF EXISTS `courses`;
CREATE TABLE IF NOT EXISTS `courses` (
                                         `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
                                         `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `description` longtext COLLATE utf8mb4_unicode_ci,
    `price` decimal(15,2) DEFAULT NULL,
    `book` text COLLATE utf8mb4_unicode_ci,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    `deleted_at` timestamp NULL DEFAULT NULL,
    `institution_id` int UNSIGNED NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `courses_name_unique` (`name`),
    KEY `institution_fk_538844` (`institution_id`)
    ) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `courses`
--

INSERT INTO `courses` (`id`, `name`, `description`, `price`, `book`, `created_at`, `updated_at`, `deleted_at`, `institution_id`) VALUES
                                                                                                                                     (1, 'Web Development', 'Autem et debitis autem quas eveniet tenetur eum. Laudantium qui repudiandae molestiae et. Vel officiis et voluptas fugit quis omnis architecto.', NULL, NULL, '2024-08-23 22:14:40', '2024-08-28 22:22:51', '2024-08-28 22:22:51', 1),
                                                                                                                                     (2, 'UX/UI Design', NULL, NULL, NULL, '2024-08-23 22:14:40', '2024-08-28 15:19:40', NULL, 2),
                                                                                                                                     (3, 'Wordpress Development', 'WordPress is a powerful content management system.', NULL, NULL, '2024-08-23 22:14:41', '2024-08-28 16:51:37', NULL, 3),
                                                                                                                                     (4, 'test', 'test', NULL, NULL, '2024-08-23 22:32:46', '2024-08-28 15:08:15', '2024-08-28 15:08:15', 3),
                                                                                                                                     (5, 'tttt2', 'ffffff', NULL, NULL, '2024-08-23 23:13:34', '2024-08-28 15:08:15', '2024-08-28 15:08:15', 1),
                                                                                                                                     (6, 'aaaaa', 'aaaaa', NULL, NULL, '2024-08-24 11:26:33', '2024-08-28 15:08:15', '2024-08-28 15:08:15', 1),
                                                                                                                                     (7, 'firebase', 'tes tes tsqdqsdqsd', NULL, NULL, '2024-08-28 16:54:37', '2024-08-28 16:54:37', NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `course_discipline`
--

DROP TABLE IF EXISTS `course_discipline`;
CREATE TABLE IF NOT EXISTS `course_discipline` (
                                                   `course_id` int UNSIGNED NOT NULL,
                                                   `discipline_id` int UNSIGNED NOT NULL,
                                                   KEY `course_id_fk_538846` (`course_id`),
    KEY `discipline_id_fk_538846` (`discipline_id`)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `course_discipline`
--

INSERT INTO `course_discipline` (`course_id`, `discipline_id`) VALUES
                                                                   (1, 1),
                                                                   (2, 2),
                                                                   (3, 3),
                                                                   (4, 2),
                                                                   (5, 1),
                                                                   (6, 3),
                                                                   (7, 2);

-- --------------------------------------------------------

--
-- Structure de la table `disciplines`
--

DROP TABLE IF EXISTS `disciplines`;
CREATE TABLE IF NOT EXISTS `disciplines` (
                                             `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
                                             `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    `deleted_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `disciplines_name_unique` (`name`)
    ) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `disciplines`
--

INSERT INTO `disciplines` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
                                                                                       (1, 'Web Development', '2024-08-23 22:14:39', '2024-08-23 22:14:39', NULL),
                                                                                       (2, 'Design', '2024-08-23 22:14:39', '2024-08-23 22:14:39', NULL),
                                                                                       (3, 'Wordpress', '2024-08-23 22:14:39', '2024-08-23 22:14:39', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `enrollments`
--

DROP TABLE IF EXISTS `enrollments`;
CREATE TABLE IF NOT EXISTS `enrollments` (
                                             `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
                                             `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'awaiting',
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    `deleted_at` timestamp NULL DEFAULT NULL,
    `user_id` int UNSIGNED NOT NULL,
    `course_id` int UNSIGNED NOT NULL,
    PRIMARY KEY (`id`),
    KEY `user_fk_538851` (`user_id`),
    KEY `course_fk_538852` (`course_id`)
    ) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `enrollments`
--

INSERT INTO `enrollments` (`id`, `status`, `created_at`, `updated_at`, `deleted_at`, `user_id`, `course_id`) VALUES
                                                                                                                 (1, 'rejected', '2024-08-23 22:14:41', '2024-08-23 22:14:41', NULL, 1, 1),
                                                                                                                 (2, 'rejected', '2024-08-23 22:14:41', '2024-08-23 22:14:41', NULL, 1, 2),
                                                                                                                 (3, 'accepted', '2024-08-23 22:14:41', '2024-08-23 22:14:41', NULL, 1, 3),
                                                                                                                 (4, 'awaiting', '2024-08-23 22:25:20', '2024-08-23 22:25:20', NULL, 1, 1),
                                                                                                                 (5, 'accepted', '2024-08-23 22:55:53', '2024-08-24 09:38:50', '2024-08-24 09:38:50', 3, 2),
                                                                                                                 (6, 'awaiting', '2024-08-23 23:01:04', '2024-08-24 09:38:50', '2024-08-24 09:38:50', 3, 2),
                                                                                                                 (7, 'awaiting', '2024-08-24 09:38:21', '2024-08-24 09:38:50', '2024-08-24 09:38:50', 3, 1),
                                                                                                                 (8, 'awaiting', '2024-08-24 09:44:12', '2024-08-24 09:44:12', NULL, 3, 3),
                                                                                                                 (9, 'awaiting', '2024-08-24 09:53:52', '2024-08-24 09:54:15', '2024-08-24 09:54:15', 3, 3),
                                                                                                                 (10, 'awaiting', '2024-08-24 09:57:34', '2024-08-24 09:57:34', NULL, 3, 4),
                                                                                                                 (11, 'accepted', '2024-08-24 11:58:46', '2024-08-24 12:09:15', NULL, 3, 6),
                                                                                                                 (12, 'accepted', '2024-08-28 16:47:21', '2024-08-28 16:49:37', NULL, 4, 3),
                                                                                                                 (13, 'accepted', '2024-08-28 16:55:09', '2024-08-28 16:55:18', NULL, 4, 7),
                                                                                                                 (14, 'accepted', '2024-08-28 17:03:52', '2024-08-28 17:04:00', NULL, 5, 7);

-- --------------------------------------------------------

--
-- Structure de la table `institutions`
--

DROP TABLE IF EXISTS `institutions`;
CREATE TABLE IF NOT EXISTS `institutions` (
                                              `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
                                              `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `description` longtext COLLATE utf8mb4_unicode_ci,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    `deleted_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `institutions_name_unique` (`name`)
    ) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `institutions`
--

INSERT INTO `institutions` (`id`, `name`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
                                                                                                       (1, 'loay', 'online institue', '2024-08-23 22:14:39', '2024-08-24 09:42:34', NULL),
                                                                                                       (2, 'Esprit', 'ESPRIT propose un cycle ingénieur en informatique agréé par l\'état la seule école en tunisie associé à CGE, CDIO, AUF et UNESCO et acrédité EUR-ACE', '2024-08-23 22:14:39', '2024-08-24 09:42:02', NULL),
(3, 'Collage la salle', 'Formation professionnelle — Programmes sur 2 ans, avec ou sans Bac, donnant droit à des Diplômes Reconnus & Homologués. Campus au cœur de Tunis', '2024-08-23 22:14:40', '2024-08-24 09:41:12', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `media`
--

DROP TABLE IF EXISTS `media`;
CREATE TABLE IF NOT EXISTS `media` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `collection_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disk` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `conversions_disk` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` bigint UNSIGNED NOT NULL,
  `manipulations` json NOT NULL,
  `custom_properties` json NOT NULL,
  `responsive_images` json NOT NULL,
  `order_column` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `media_model_type_model_id_index` (`model_type`,`model_id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `media`
--

INSERT INTO `media` (`id`, `model_type`, `model_id`, `uuid`, `collection_name`, `name`, `file_name`, `mime_type`, `disk`, `conversions_disk`, `size`, `manipulations`, `custom_properties`, `responsive_images`, `order_column`, `created_at`, `updated_at`) VALUES
(1, 'App\\Institution', 1, '2bbaff08-72d3-478a-a1dd-f809a4f59df0', 'logo', 'institution_1', 'institution_1.png', 'image/png', 'public', 'public', 312924, '[]', '{\"generated_conversions\": {\"thumb\": true}}', '[]', 1, '2024-08-23 22:14:39', '2024-08-23 22:14:39'),
(2, 'App\\Institution', 2, '74c88ac6-2431-42dd-b14e-b7dc3ba0be55', 'logo', 'institution_2', 'institution_2.png', 'image/png', 'public', 'public', 292915, '[]', '{\"generated_conversions\": {\"thumb\": true}}', '[]', 2, '2024-08-23 22:14:39', '2024-08-23 22:14:40'),
                                                                                                        (3, 'App\\Institution', 3, 'ba3f6b56-87b2-4f77-84b8-0c48970294d5', 'logo', 'institution_3', 'institution_3.png', 'image/png', 'public', 'public', 432873, '[]', '{\"generated_conversions\": {\"thumb\": true}}', '[]', 3, '2024-08-23 22:14:40', '2024-08-23 22:14:40'),
                                                                                                        (4, 'App\\Course', 1, 'b7646071-ea3e-4b2e-8a4d-c2a9fe463880', 'photo', 'course_1', 'course_1.png', 'image/png', 'public', 'public', 211604, '[]', '{\"generated_conversions\": {\"thumb\": true}}', '[]', 4, '2024-08-23 22:14:40', '2024-08-23 22:14:40'),
                                                                                                        (5, 'App\\Course', 2, '18848111-bb20-4626-847d-57e553a80fc9', 'photo', 'course_2', 'course_2.png', 'image/png', 'public', 'public', 183012, '[]', '{\"generated_conversions\": {\"thumb\": true}}', '[]', 5, '2024-08-23 22:14:40', '2024-08-23 22:14:41'),
                                                                                                        (6, 'App\\Course', 3, '64376969-f228-4607-acb4-8001e7fd48d2', 'photo', 'course_3', 'course_3.png', 'image/png', 'public', 'public', 218909, '[]', '{\"generated_conversions\": {\"thumb\": true}}', '[]', 6, '2024-08-23 22:14:41', '2024-08-23 22:14:41'),
                                                                                                        (7, 'App\\Course', 4, '8d4467b5-0986-4ff0-92e3-ba60f33cb1d8', 'photo', '66c91bdee8206_1', '66c91bdee8206_1.jpg', 'image/jpeg', 'public', 'public', 52962, '[]', '{\"generated_conversions\": {\"thumb\": true}}', '[]', 7, '2024-08-23 22:32:46', '2024-08-23 22:32:46'),
                                                                                                        (8, 'App\\Course', 5, '55ab4260-7acc-4bab-8a56-220b616b2a32', 'photo', '66c9259611998_1', '66c9259611998_1.jpg', 'image/jpeg', 'public', 'public', 52962, '[]', '{\"generated_conversions\": {\"thumb\": true}}', '[]', 8, '2024-08-23 23:13:35', '2024-08-23 23:13:37'),
                                                                                                        (19, 'App\\Course', 7, 'f2e3caaa-53c2-4db4-ab56-5f661cb67f79', 'books', '66cf65d248e56_books', '66cf65d248e56_books.pdf', 'application/pdf', 'public', 'public', 708933, '[]', '[]', '[]', 19, '2024-08-28 17:00:52', '2024-08-28 17:00:52'),
                                                                                                        (10, 'App\\Institution', 3, '9d6edbf0-86db-4cd7-9d9e-4159afa9c2f7', 'logo', '66c9b8c8238b2_150px-Collège_La_Salle', '66c9b8c8238b2_150px-Collège_La_Salle.png', 'image/png', 'public', 'public', 400068, '[]', '{\"generated_conversions\": {\"thumb\": true}}', '[]', 10, '2024-08-24 09:41:13', '2024-08-24 09:41:15'),
                                                                                                        (11, 'App\\Institution', 2, '60b7d9e3-5e2a-482c-9881-9d338f4d69e5', 'logo', '66c9b8f9c6b74_esprit', '66c9b8f9c6b74_esprit.png', 'image/png', 'public', 'public', 4022, '[]', '{\"generated_conversions\": {\"thumb\": true}}', '[]', 11, '2024-08-24 09:42:02', '2024-08-24 09:42:03'),
                                                                                                        (12, 'App\\Course', 6, '3d943c63-4776-4df2-b288-c7e8537309f6', 'photo', '66c9d169a6c8c_Physical architecture', '66c9d169a6c8c_Physical-architecture.png', 'image/png', 'public', 'public', 175355, '[]', '{\"generated_conversions\": {\"thumb\": true}}', '[]', 12, '2024-08-24 11:26:33', '2024-08-24 11:26:33'),
                                                                                                        (14, 'App\\Institution', 2, 'fa1391d5-b12e-4d7e-a726-db0c3df211d8', 'logo', '66cf4b482bac6_esprit', '66cf4b482bac6_esprit.jpeg', 'image/jpeg', 'public', 'public', 8094, '[]', '{\"generated_conversions\": {\"thumb\": true}}', '[]', 14, '2024-08-28 15:07:38', '2024-08-28 15:07:39'),
                                                                                                        (15, 'App\\Course', 3, '8aa71e04-bd2e-42fc-b652-43a4cce659a9', 'photo', '66cf4bc27e0fd_wordpress', '66cf4bc27e0fd_wordpress.jpg', 'image/jpeg', 'public', 'public', 30450, '[]', '{\"generated_conversions\": {\"thumb\": true}}', '[]', 15, '2024-08-28 15:09:40', '2024-08-28 15:09:41'),
                                                                                                        (16, 'App\\Course', 2, '4e01789a-ec61-4e4e-b873-d8accc3f76d9', 'photo', '66cf4d2fe0b76_UXUI', '66cf4d2fe0b76_UXUI.jpg', 'image/jpeg', 'public', 'public', 29656, '[]', '{\"generated_conversions\": {\"thumb\": true}}', '[]', 16, '2024-08-28 15:19:40', '2024-08-28 15:19:40'),
                                                                                                        (17, 'App\\Course', 2, 'df1477d8-f81e-452a-af26-a1f92c12c254', 'photo', '66cf4e8793055_esprit', '66cf4e8793055_esprit.jpeg', 'image/jpeg', 'public', 'public', 8094, '[]', '{\"generated_conversions\": {\"thumb\": true}}', '[]', 17, '2024-08-28 15:21:33', '2024-08-28 15:21:34'),
                                                                                                        (18, 'App\\Course', 7, '35f43fcb-427e-43a3-9dd0-a4ad59c19b13', 'photo', '66cf645430f77_hotel', '66cf645430f77_hotel.jpeg', 'image/jpeg', 'public', 'public', 12153, '[]', '{\"generated_conversions\": {\"thumb\": true}}', '[]', 18, '2024-08-28 16:54:38', '2024-08-28 16:54:40');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
                                            `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
                                            `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `batch` int NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
                                                          (1, '2014_10_12_100000_create_password_resets_table', 1),
                                                          (2, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
                                                          (3, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
                                                          (4, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
                                                          (5, '2016_06_01_000004_create_oauth_clients_table', 1),
                                                          (6, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
                                                          (7, '2019_10_30_000001_create_media_table', 1),
                                                          (8, '2019_10_30_000002_create_permissions_table', 1),
                                                          (9, '2019_10_30_000003_create_roles_table', 1),
                                                          (10, '2019_10_30_000004_create_users_table', 1),
                                                          (11, '2019_10_30_000005_create_disciplines_table', 1),
                                                          (12, '2019_10_30_000006_create_institutions_table', 1),
                                                          (13, '2019_10_30_000007_create_courses_table', 1),
                                                          (14, '2019_10_30_000008_create_enrollments_table', 1),
                                                          (15, '2019_10_30_000009_create_permission_role_pivot_table', 1),
                                                          (16, '2019_10_30_000010_create_role_user_pivot_table', 1),
                                                          (17, '2019_10_30_000011_create_course_discipline_pivot_table', 1),
                                                          (18, '2019_10_30_000012_add_relationship_fields_to_users_table', 1),
                                                          (19, '2019_10_30_000013_add_relationship_fields_to_courses_table', 1),
                                                          (20, '2019_10_30_000014_add_relationship_fields_to_enrollments_table', 1);

-- --------------------------------------------------------

--
-- Structure de la table `oauth_access_tokens`
--

DROP TABLE IF EXISTS `oauth_access_tokens`;
CREATE TABLE IF NOT EXISTS `oauth_access_tokens` (
                                                     `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
    `user_id` bigint UNSIGNED DEFAULT NULL,
    `client_id` bigint UNSIGNED NOT NULL,
    `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `scopes` text COLLATE utf8mb4_unicode_ci,
    `revoked` tinyint(1) NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    `expires_at` datetime DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `oauth_access_tokens_user_id_index` (`user_id`)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `oauth_auth_codes`
--

DROP TABLE IF EXISTS `oauth_auth_codes`;
CREATE TABLE IF NOT EXISTS `oauth_auth_codes` (
                                                  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
    `user_id` bigint UNSIGNED NOT NULL,
    `client_id` bigint UNSIGNED NOT NULL,
    `scopes` text COLLATE utf8mb4_unicode_ci,
    `revoked` tinyint(1) NOT NULL,
    `expires_at` datetime DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `oauth_auth_codes_user_id_index` (`user_id`)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `oauth_clients`
--

DROP TABLE IF EXISTS `oauth_clients`;
CREATE TABLE IF NOT EXISTS `oauth_clients` (
                                               `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
                                               `user_id` bigint UNSIGNED DEFAULT NULL,
                                               `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `provider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
    `personal_access_client` tinyint(1) NOT NULL,
    `password_client` tinyint(1) NOT NULL,
    `revoked` tinyint(1) NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `oauth_clients_user_id_index` (`user_id`)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `oauth_personal_access_clients`
--

DROP TABLE IF EXISTS `oauth_personal_access_clients`;
CREATE TABLE IF NOT EXISTS `oauth_personal_access_clients` (
                                                               `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
                                                               `client_id` bigint UNSIGNED NOT NULL,
                                                               `created_at` timestamp NULL DEFAULT NULL,
                                                               `updated_at` timestamp NULL DEFAULT NULL,
                                                               PRIMARY KEY (`id`)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `oauth_refresh_tokens`
--

DROP TABLE IF EXISTS `oauth_refresh_tokens`;
CREATE TABLE IF NOT EXISTS `oauth_refresh_tokens` (
                                                      `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
    `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
    `revoked` tinyint(1) NOT NULL,
    `expires_at` datetime DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
                                                 `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    KEY `password_resets_email_index` (`email`)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
                                             `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
                                             `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    `deleted_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `permissions`
--

INSERT INTO `permissions` (`id`, `title`, `created_at`, `updated_at`, `deleted_at`) VALUES
                                                                                        (1, 'user_management_access', NULL, NULL, NULL),
                                                                                        (2, 'permission_create', NULL, NULL, NULL),
                                                                                        (3, 'permission_edit', NULL, NULL, NULL),
                                                                                        (4, 'permission_show', NULL, NULL, NULL),
                                                                                        (5, 'permission_delete', NULL, NULL, NULL),
                                                                                        (6, 'permission_access', NULL, NULL, NULL),
                                                                                        (7, 'role_create', NULL, NULL, NULL),
                                                                                        (8, 'role_edit', NULL, NULL, NULL),
                                                                                        (9, 'role_show', NULL, NULL, NULL),
                                                                                        (10, 'role_delete', NULL, NULL, NULL),
                                                                                        (11, 'role_access', NULL, NULL, NULL),
                                                                                        (12, 'user_create', NULL, NULL, NULL),
                                                                                        (13, 'user_edit', NULL, NULL, NULL),
                                                                                        (14, 'user_show', NULL, NULL, NULL),
                                                                                        (15, 'user_delete', NULL, NULL, NULL),
                                                                                        (16, 'user_access', NULL, NULL, NULL),
                                                                                        (17, 'discipline_create', NULL, NULL, NULL),
                                                                                        (18, 'discipline_edit', NULL, NULL, NULL),
                                                                                        (19, 'discipline_show', NULL, NULL, NULL),
                                                                                        (20, 'discipline_delete', NULL, NULL, NULL),
                                                                                        (21, 'discipline_access', NULL, NULL, NULL),
                                                                                        (22, 'institution_create', NULL, NULL, NULL),
                                                                                        (23, 'institution_edit', NULL, NULL, NULL),
                                                                                        (24, 'institution_show', NULL, NULL, NULL),
                                                                                        (25, 'institution_delete', NULL, NULL, NULL),
                                                                                        (26, 'institution_access', NULL, NULL, NULL),
                                                                                        (27, 'course_create', NULL, NULL, NULL),
                                                                                        (28, 'course_edit', NULL, NULL, NULL),
                                                                                        (29, 'course_show', NULL, NULL, NULL),
                                                                                        (30, 'course_delete', NULL, NULL, NULL),
                                                                                        (31, 'course_access', NULL, NULL, NULL),
                                                                                        (32, 'enrollment_create', NULL, NULL, NULL),
                                                                                        (33, 'enrollment_edit', NULL, NULL, NULL),
                                                                                        (34, 'enrollment_show', NULL, NULL, NULL),
                                                                                        (35, 'enrollment_delete', NULL, NULL, NULL),
                                                                                        (36, 'enrollment_access', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
CREATE TABLE IF NOT EXISTS `permission_role` (
                                                 `role_id` int UNSIGNED NOT NULL,
                                                 `permission_id` int UNSIGNED NOT NULL,
                                                 KEY `role_id_fk_538787` (`role_id`),
    KEY `permission_id_fk_538787` (`permission_id`)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `permission_role`
--

INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES
                                                               (1, 1),
                                                               (1, 2),
                                                               (1, 3),
                                                               (1, 4),
                                                               (1, 5),
                                                               (1, 6),
                                                               (1, 7),
                                                               (1, 8),
                                                               (1, 9),
                                                               (1, 10),
                                                               (1, 11),
                                                               (1, 12),
                                                               (1, 13),
                                                               (1, 14),
                                                               (1, 15),
                                                               (1, 16),
                                                               (1, 17),
                                                               (1, 18),
                                                               (1, 19),
                                                               (1, 20),
                                                               (1, 21),
                                                               (1, 22),
                                                               (1, 23),
                                                               (1, 24),
                                                               (1, 25),
                                                               (1, 26),
                                                               (1, 27),
                                                               (1, 28),
                                                               (1, 29),
                                                               (1, 30),
                                                               (1, 31),
                                                               (1, 32),
                                                               (1, 33),
                                                               (1, 34),
                                                               (1, 35),
                                                               (1, 36),
                                                               (2, 27),
                                                               (2, 28),
                                                               (2, 29),
                                                               (2, 30),
                                                               (2, 31),
                                                               (2, 33),
                                                               (2, 34),
                                                               (2, 35),
                                                               (2, 36),
                                                               (3, 31),
                                                               (3, 29);

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
                                       `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
                                       `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    `deleted_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `title`, `created_at`, `updated_at`, `deleted_at`) VALUES
                                                                                  (1, 'Admin', NULL, NULL, NULL),
                                                                                  (2, 'Institution', NULL, NULL, NULL),
                                                                                  (3, 'Student', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
CREATE TABLE IF NOT EXISTS `role_user` (
                                           `user_id` int UNSIGNED NOT NULL,
                                           `role_id` int UNSIGNED NOT NULL,
                                           KEY `user_id_fk_538796` (`user_id`),
    KEY `role_id_fk_538796` (`role_id`)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
                                                   (1, 1),
                                                   (2, 2),
                                                   (3, 3);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
                                       `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
                                       `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `email_verified_at` datetime DEFAULT NULL,
    `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `remember_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    `deleted_at` timestamp NULL DEFAULT NULL,
    `institution_id` int UNSIGNED DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `users_email_unique` (`email`),
    KEY `institution_fk_538818` (`institution_id`)
    ) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`, `institution_id`) VALUES
                                                                                                                                                               (1, 'Admin', 'admin@gmail.com', NULL, '$2y$10$xrsPLYaYoSrvak108tqKouwl9I/3VZMJ5h/I96pOCqwg.c0Dl4ILy', NULL, NULL, NULL, NULL, NULL),
                                                                                                                                                               (2, 'Institution', 'institution@institution.com', NULL, '$2y$10$xrsPLYaYoSrvak108tqKouwl9I/3VZMJ5h/I96pOCqwg.c0Dl4ILy', NULL, NULL, '2024-08-23 22:14:40', NULL, 1),
                                                                                                                                                               (3, 'student', 'student@gmail.com', NULL, '$2y$10$bRWQbSccJwdLeK.zqXUrI.2oKogqUHNnegatIFd5L/msrS7cj.9g.', NULL, '2024-08-23 22:47:53', '2024-08-23 22:47:53', NULL, NULL),
                                                                                                                                                               (4, 'loay', 'louay@gmail.com', NULL, '$2y$10$vGO4ppzsFQEpfMt9FQhAyefBjMosdgqjx0nOV/q4jZgCcsdXPNCMe', NULL, '2024-08-28 16:47:21', '2024-08-28 16:47:21', NULL, NULL),
                                                                                                                                                               (5, 'hazem', 'hazemgdaraa@gmail.com', NULL, '$2y$10$r72rJxHdI19U5lcemRXbQuGK/to159FHY8njqqYIV9Fiy/CwwhdGa', NULL, '2024-08-28 17:03:52', '2024-08-28 17:03:52', NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
