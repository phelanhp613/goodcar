-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2023 at 10:51 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `goodcar2`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `address` text DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `phone`, `email`, `status`, `address`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Nguyễn Văn Thành', '0909010010', 'thanh@gmail.com', 1, '12333 khu phố abc', '2023-11-17 06:40:56', NULL, '2023-11-17 06:40:56'),
(4, 'Nguyễn Văn Bình', '0914567892', 'binh@gmail.com', 1, '178 Hưng Lợi', '2023-11-17 06:40:58', '2023-11-16 09:00:59', '2023-11-17 06:40:58'),
(5, 'Nguyễn Văn Bình', '0912345678', 'datb1906646@student.ctu.edu.vn', 1, '20', '2023-11-17 06:41:00', '2023-11-17 02:45:59', '2023-11-17 06:41:00');

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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `position` varchar(255) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `slug`, `position`, `content`, `created_at`, `updated_at`) VALUES
(1, 'Menu', 'menu-default', '', '[]', '2020-10-15 16:30:41', '2020-10-20 15:17:19');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2021_10_01_143840_create_customers_table', 1),
(6, '2021_10_01_143840_create_roles_table', 1),
(7, '2021_10_04_150144_create_permissions_table', 1),
(8, '2021_10_04_150234_create_permission_role_table', 1),
(9, '2021_10_07_074646_create_settings_table', 1),
(10, '2023_02_22_090728_create_jobs_table', 1),
(11, '2023_02_27_041720_create_product_categories_table', 1),
(12, '2023_02_28_030957_create_slugs_table', 1),
(13, '2023_02_28_050857_create_tags_tables', 1),
(14, '2023_02_28_072042_create_products_table', 1),
(15, '2023_02_28_094203_create_product_attributes_table', 1),
(16, '2023_03_01_070602_product_variants_table', 1),
(17, '2023_03_11_074646_create_menus_table', 1),
(18, '2023_03_17_094403_create_orders_table', 1),
(19, '2023_03_17_094840_create_order_details_table', 1),
(20, '2023_03_19_104403_update_orders_table', 1),
(21, '2023_03_19_204403_update_orders_table', 1),
(22, '2023_03_25_103120_update_order_detais_table', 1),
(23, '2023_03_30_211507_update_order_details_table', 1),
(24, '2023_03_31_211507_update_orders_table', 1),
(25, '2023_04_11_100943_update_products_table', 1),
(26, '2023_05_11_070602_update_product_variants_table', 1),
(27, '2023_05_13_100943_update_product_variants_table', 1),
(28, '2023_05_14_100943_update_product_variants_table', 1),
(29, '2023_05_14_211507_update_orders_table', 1),
(30, '2023_06_02_100943_update_products_table', 1),
(31, '2023_07_14_211507_update_orders_table', 1),
(32, '2023_08_16_211507_update_orders_table', 1),
(33, '2023_08_25_100943_update_product_categories_table', 1),
(34, '2023_08_26_100943_update_product_categories_table', 1),
(35, '2023_11_14_100943_update_product_variants_table', 1),
(36, '2023_11_15_100943_update_product_values_table', 1),
(37, '2021_10_01_143840_create_post_table', 2),
(38, '2023_11_14_211507_update_orders_table', 3),
(39, '2023_11_10_041720_create_post_categories_table', 4),
(40, '2021_10_10_143840_create_post_table', 5),
(41, '2021_10_11_143840_create_post_table', 6),
(42, '2021_10_12_143840_create_post_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL DEFAULT 'cOOe4q88',
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` longtext DEFAULT NULL,
  `note` longtext DEFAULT NULL,
  `total_price` double NOT NULL DEFAULT 0,
  `payment_method` varchar(255) DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 2,
  `invoice_info` varchar(255) DEFAULT NULL,
  `otp_code` varchar(255) DEFAULT NULL,
  `voucher_code` varchar(255) DEFAULT NULL,
  `voucher_price` double NOT NULL DEFAULT 0,
  `customer_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `code`, `name`, `phone`, `email`, `address`, `note`, `total_price`, `payment_method`, `updated_by`, `deleted_at`, `created_at`, `updated_at`, `status`, `invoice_info`, `otp_code`, `voucher_code`, `voucher_price`, `customer_id`) VALUES
(1, '01', 'Nguyễn Tiến Đạt', '0912456456', 'tiendat06012001@gmail.com', '123 đường 123', '', 599000000, 'bank', NULL, '2023-11-10 08:25:05', '2023-11-10 08:23:51', '2023-11-10 08:25:05', 1, NULL, 'IVXTGU', NULL, 0, 0),
(2, '02', 'qwe', '4325323423', 'dasjfals@gmail.com', '2498oisad', '', 640000000, 'bank', NULL, '2023-11-17 02:52:25', '2023-11-13 00:37:06', '2023-11-17 02:52:25', 1, NULL, 'DRYUPV', NULL, 0, 0),
(3, '03', 'Nguyễn Văn Bình', '0914567892', 'binh@gmail.com', '178 Hưng Lợi', '', 969000000, 'bank', NULL, NULL, '2023-11-16 09:00:59', '2023-11-16 09:01:12', 1, NULL, 'SBJ9UD', NULL, 0, 4),
(4, '04', 'Nguyễn Văn Bình', '0912345678', 'datb1906646@student.ctu.edu.vn', '20', '', 479000000, 'bank_20', NULL, NULL, '2023-11-17 02:45:59', '2023-11-17 02:46:50', 1, NULL, 'CRUQ3H', NULL, 0, 5);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_variant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_attributes` longtext DEFAULT NULL,
  `price` double DEFAULT NULL,
  `discount` double DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `sku` varchar(255) DEFAULT NULL,
  `total_price` double NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `product_name`, `product_id`, `product_variant_id`, `product_attributes`, `price`, `discount`, `quantity`, `order_id`, `deleted_at`, `created_at`, `updated_at`, `sku`, `total_price`) VALUES
(1, 'Hyundai Elantra - Trắng 1.6AT Tiêu Chuẩn', 4, 97, '{\"4\":{\"name\":\"M\\u00e0u s\\u1eafc\",\"value\":\"Tr\\u1eafng\"},\"56\":{\"name\":\"Phi\\u00ean B\\u1ea3n - Elantra\",\"value\":\"1.6AT Ti\\u00eau Chu\\u1ea9n\"}}', 599000000, 0, 1, 1, NULL, '2023-11-09 17:00:00', '2023-11-09 17:00:00', 'Hy-ela-2023', 599000000),
(2, 'Hyundai Creta - Tiêu Chuẩn Trắng', 1, 7, '{\"3\":{\"name\":\"Phi\\u00ean B\\u1ea3n - Creta\",\"value\":\"Ti\\u00eau Chu\\u1ea9n\"},\"4\":{\"name\":\"M\\u00e0u s\\u1eafc\",\"value\":\"Tr\\u1eafng\"}}', 640000000, 0, 1, 2, NULL, '2023-11-12 17:00:00', '2023-11-12 17:00:00', 'Hy-cre-2022', 640000000),
(3, 'Hyundai Santafe - Trắng Xăng 2.4 Thường', 2, 55, '{\"4\":{\"name\":\"M\\u00e0u s\\u1eafc\",\"value\":\"Tr\\u1eafng\"},\"24\":{\"name\":\"Phi\\u00ean B\\u1ea3n - Santafe\",\"value\":\"X\\u0103ng 2.4 Th\\u01b0\\u1eddng\"}}', 969000000, 0, 1, 3, NULL, '2023-11-15 17:00:00', '2023-11-15 17:00:00', 'Hy-san-2021', 969000000),
(4, 'Toyota Vios - Trắng 1.5E-MT', 3, 79, '{\"4\":{\"name\":\"M\\u00e0u s\\u1eafc\",\"value\":\"Tr\\u1eafng\"},\"39\":{\"name\":\"Phi\\u00ean B\\u1ea3n - Vios\",\"value\":\"1.5E-MT\"}}', 479000000, 0, 1, 4, NULL, '2023-11-16 17:00:00', '2023-11-16 17:00:00', 'To-vio-2023', 479000000);

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `display_name` varchar(255) DEFAULT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 'order', 'Order', 0, '2023-11-09 02:27:41', '2023-11-09 02:27:41'),
(2, 'order-update', 'Update Order', 1, '2023-11-09 02:27:41', '2023-11-09 02:27:41'),
(3, 'order-delete', 'Delete Order', 1, '2023-11-09 02:27:41', '2023-11-09 02:27:41'),
(4, 'permission', 'Permission', 0, '2023-11-09 02:27:42', '2023-11-09 02:27:42'),
(5, 'permission-update', 'Update Access Control', 4, '2023-11-09 02:27:43', '2023-11-09 02:27:43'),
(6, 'product', 'Product', 0, '2023-11-09 02:27:43', '2023-11-09 02:27:43'),
(7, 'product-create', 'Create Product', 6, '2023-11-09 02:27:43', '2023-11-09 02:27:43'),
(8, 'product-update', 'Update Product', 6, '2023-11-09 02:27:43', '2023-11-09 02:27:43'),
(9, 'product-delete', 'Delete Product', 6, '2023-11-09 02:27:44', '2023-11-09 02:27:44'),
(10, 'product-category', 'Product Category', 0, '2023-11-09 02:27:44', '2023-11-09 02:27:44'),
(11, 'product-category-create', 'Delete Product Category', 10, '2023-11-09 02:27:44', '2023-11-09 02:27:44'),
(12, 'product-category-update', 'Delete Product Category', 10, '2023-11-09 02:27:44', '2023-11-09 02:27:44'),
(13, 'product-category-delete', 'Delete Product Category', 10, '2023-11-09 02:27:44', '2023-11-09 02:27:44'),
(14, 'product-attribute', 'Product Attribute', 0, '2023-11-09 02:27:44', '2023-11-09 02:27:44'),
(15, 'product-attribute-create', 'Delete Product Attribute', 14, '2023-11-09 02:27:44', '2023-11-09 02:27:44'),
(16, 'product-attribute-update', 'Delete Product Attribute', 14, '2023-11-09 02:27:45', '2023-11-09 02:27:45'),
(17, 'product-attribute-delete', 'Delete Product Attribute', 14, '2023-11-09 02:27:45', '2023-11-09 02:27:45'),
(18, 'role', 'Role', 0, '2023-11-09 02:27:45', '2023-11-09 02:27:45'),
(19, 'role-create', 'Create Role', 18, '2023-11-09 02:27:45', '2023-11-09 02:27:45'),
(20, 'role-update', 'Update Role', 18, '2023-11-09 02:27:45', '2023-11-09 02:27:45'),
(21, 'role-delete', 'Delete Role', 18, '2023-11-09 02:27:45', '2023-11-09 02:27:45'),
(22, 'setting', 'Setting', 0, '2023-11-09 02:27:46', '2023-11-09 02:27:46'),
(23, 'tag', 'Tag', 0, '2023-11-09 02:27:46', '2023-11-09 02:27:46'),
(24, 'tag-create', 'Create Tag', 23, '2023-11-09 02:27:46', '2023-11-09 02:27:46'),
(25, 'tag-update', 'Update Tag', 23, '2023-11-09 02:27:46', '2023-11-09 02:27:46'),
(26, 'tag-delete', 'Delete Tag', 23, '2023-11-09 02:27:46', '2023-11-09 02:27:46'),
(27, 'user', 'User', 0, '2023-11-09 02:27:46', '2023-11-09 02:27:46'),
(28, 'user-create', 'Create User', 27, '2023-11-09 02:27:46', '2023-11-09 02:27:46'),
(29, 'user-update', 'Update User', 27, '2023-11-09 02:27:46', '2023-11-09 02:27:46'),
(30, 'user-delete', 'Delete User', 27, '2023-11-09 02:27:46', '2023-11-09 02:27:46'),
(31, 'update-user-role', 'Update User Role', 27, '2023-11-09 02:27:46', '2023-11-09 02:27:46'),
(32, 'customer', 'Customer', 0, '2023-11-09 02:27:46', '2023-11-09 02:27:46'),
(33, 'customer-create', 'Create Customer', 32, '2023-11-09 02:27:46', '2023-11-09 02:27:46'),
(34, 'customer-update', 'Update Customer', 32, '2023-11-09 02:27:46', '2023-11-09 02:27:46'),
(35, 'customer-delete', 'Delete Customer', 32, '2023-11-09 02:27:46', '2023-11-09 02:27:46'),
(36, 'post', 'Post', 0, '2023-11-13 07:49:15', '2023-11-13 07:49:15'),
(37, 'post-create', 'Create Post', 36, '2023-11-13 07:49:15', '2023-11-13 07:49:15'),
(38, 'post-update', 'Update Post', 36, '2023-11-13 07:49:15', '2023-11-13 07:49:15'),
(39, 'post-delete', 'Delete Post', 36, '2023-11-13 07:49:15', '2023-11-13 07:49:15');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(32, 4),
(33, 4),
(34, 4),
(35, 4),
(1, 4),
(2, 4),
(3, 4),
(6, 4),
(7, 4),
(8, 4),
(9, 4),
(14, 4),
(15, 4),
(16, 4),
(17, 4),
(10, 4),
(11, 4),
(12, 4),
(13, 4),
(22, 4),
(23, 4),
(24, 4),
(25, 4),
(26, 4),
(27, 4),
(28, 4),
(29, 4),
(30, 4),
(31, 4),
(1, 3),
(2, 3),
(3, 3),
(2, 2),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(36, 4),
(37, 4),
(38, 4),
(39, 4);

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
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `post_category` longtext DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `images` longtext DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `name`, `slug`, `description`, `post_category`, `content`, `images`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'đasa', '', 'đâsd', 'Review', '[]', '/storage/logo-toyota.jpg', 1, '2023-11-18 00:13:24', '2023-11-18 00:08:54', '2023-11-18 00:13:24'),
(2, 'đâs', '', 'dsadsads', 'Review', '[]', '/storage/logo-toyota.jpg', 1, '2023-11-18 00:13:22', '2023-11-18 00:11:19', '2023-11-18 00:13:22'),
(3, 'đasa', '', 'dsadsad', 'Đánh giá sản phẩm', '[{\"label\":\"\\u0111asa\",\"label_hidden\":\"\\u0111asa\",\"url\":\"dasa\",\"content\":\"<p>\\u0111asa<\\/p>\"}]', '/storage/logo-hyundai.png', 1, NULL, '2023-11-18 00:22:28', '2023-11-18 00:22:38'),
(4, 'đâs', 'das', 'đasa', 'Khuyến Mãi', '[{\"label\":\"dsadsa\",\"label_hidden\":\"dsadsa\",\"url\":\"dsadsa\",\"content\":\"<p>\\u0111asadsa<\\/p>\"}]', '/storage/logo.png', 1, NULL, '2023-11-18 00:26:50', '2023-11-18 00:26:50'),
(5, 'đâs', 'das', 'đasa', 'Khuyến Mãi', '[{\"label\":\"dsadsa\",\"label_hidden\":\"dsadsa\",\"url\":\"dsadsa\",\"content\":\"<p>\\u0111asadsa<\\/p>\"}]', '/storage/logo.png', 1, NULL, '2023-11-18 00:27:30', '2023-11-18 00:27:30'),
(6, 'Bài viết', 'bai-viet', '44324', 'Đánh giá sản phẩm', '[{\"label\":\"sdsa\",\"label_hidden\":\"sdsa\",\"url\":\"sdsa\",\"content\":\"<p>dsaD<\\/p>\"}]', '/storage/logo.png', 1, NULL, '2023-11-18 00:28:18', '2023-11-18 00:28:18');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `sku` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `promotion` longtext DEFAULT NULL,
  `images` longtext DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `has_variant` tinyint(1) NOT NULL DEFAULT 0,
  `product_category_id` bigint(20) UNSIGNED NOT NULL,
  `product_category_ids` longtext NOT NULL,
  `attribute_ids` longtext DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` longtext DEFAULT NULL,
  `meta_keyword` longtext DEFAULT NULL,
  `canonical` longtext DEFAULT NULL,
  `seo_preview` longtext DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `flash_sale_quantity` int(11) NOT NULL DEFAULT 12
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `sku`, `description`, `content`, `promotion`, `images`, `status`, `has_variant`, `product_category_id`, `product_category_ids`, `attribute_ids`, `meta_title`, `meta_description`, `meta_keyword`, `canonical`, `seo_preview`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`, `featured`, `flash_sale_quantity`) VALUES
(1, 'Hyundai Creta', 'hyundai-creta', 'Hy-cre-2022', '', '[{\"label\":\"N\\u1ed9i dung\",\"label_hidden\":\"N\\u1ed9i dung\",\"url\":\"noi-dung\",\"content\":\"<section data-element_type=\\\"section\\\" data-id=\\\"135538c\\\" id=\\\"tongquan\\\">\\r\\n<h2>T\\u1ed4NG QUAN HYUNDAI CRETA<\\/h2>\\r\\n\\r\\n<p>Chi\\u1ec1u 15\\/3, Hyundai Motor Ch&acirc;u &Aacute; &ndash; Th&aacute;i B&igrave;nh D\\u01b0\\u01a1ng ra m\\u1eaft tr\\u1ef1c tuy\\u1ebfn&nbsp;m\\u1eabu xe Hyundai Creta 2022 t\\u1ea1i th\\u1ecb tr\\u01b0\\u1eddng Th&aacute;i Lan, Trung \\u0110&ocirc;ng v&agrave; Vi\\u1ec7t Nam.&nbsp;V\\u1edbi th\\u1ecb tr\\u01b0\\u1eddng Vi\\u1ec7t Nam, xe c&oacute; 3 phi&ecirc;n b\\u1ea3n. T&acirc;n binh ph&acirc;n kh&uacute;c B-SUV s\\u1ebd v\\u1ec1 \\u0111\\u1ea1i l&yacute; v&agrave;i ng&agrave;y t\\u1edbi.<\\/p>\\r\\n\\r\\n<p>Hyundai Creta \\u0111\\u01b0\\u1ee3c \\u0111&aacute;nh gi&aacute; l&agrave; m\\u1ed9t trong s\\u1ed1 nh\\u1eefng \\u0111\\u1ed1i th\\u1ee7 n\\u1eb7ng k&yacute; nh\\u1ea5t so v\\u1edbi c&aacute;c d&ograve;ng xe kh&aacute;c c&ugrave;ng ph&acirc;n kh&uacute;c. L&agrave; m\\u1ed9t d&ograve;ng xe SUV c\\u1ee1 nh\\u1ecf m\\u1edbi ra m\\u1eaft, Hyundai Creta mang \\u0111\\u1ebfn nh\\u1eefng \\u01b0u \\u0111i\\u1ec3m v\\u01b0\\u1ee3t tr\\u1ed9i nh\\u01b0: m\\u1ea1nh m\\u1ebd, b\\u1ec1n b\\u1ec9 v&agrave; ti\\u1ebft ki\\u1ec7m nhi&ecirc;n li\\u1ec7u, thu h&uacute;t kh&aacute;ch h&agrave;ng ngay t\\u1eeb nh\\u1eefng &aacute;nh nh&igrave;n \\u0111\\u1ea7u ti&ecirc;n.<\\/p>\\r\\n\\r\\n<p><img alt=\\\"Hyundai Creta 1\\\" height=\\\"819\\\" loading=\\\"lazy\\\" src=\\\"https:\\/\\/hyundai-cantho.com\\/wp-content\\/uploads\\/2022\\/03\\/hyundai-cret.jpg\\\" title=\\\"Hyundai Creta 13\\\" width=\\\"1200\\\" \\/><\\/p>\\r\\n\\r\\n<p>T\\u1ea1i Vi\\u1ec7t Nam, Hyundai Creta \\u0111\\u01b0\\u1ee3c Hyundai Th&agrave;nh C&ocirc;ng nh\\u1eadp kh\\u1ea9u nguy&ecirc;n chi\\u1ebfc t\\u1eeb Indonesia v&agrave; ph&acirc;n ph\\u1ed1i v\\u1edbi 3 phi&ecirc;n b\\u1ea3n ch&iacute;nh th\\u1ee9c : Ti&ecirc;u chu\\u1ea9n, \\u0110\\u1eb7c bi\\u1ec7t v&agrave; Cao c\\u1ea5p. C&ugrave;ng 6 m&agrave;u t&ugrave;y ch\\u1ecdn: Tr\\u1eafng &ndash; \\u0110\\u1ecf &ndash; \\u0110en &ndash; B\\u1ea1c &ndash; X&aacute;m kim lo\\u1ea1i &ndash; Xanh d\\u01b0\\u01a1ng.<\\/p>\\r\\n\\r\\n<p>Ri&ecirc;ng phi&ecirc;n b\\u1ea3n Cao c\\u1ea5p c&oacute; th&ecirc;m l\\u1ef1a ch\\u1ecdn 2 m&agrave;u ngo\\u1ea1i th\\u1ea5t (2 tone) : \\u0110\\u1ecf ( mui \\u0111en ), Tr\\u1eafng ( mui \\u0111en ) t\\u1ea1o \\u0111i\\u1ec3m nh\\u1ea5n ri&ecirc;ng bi\\u1ec7t so v\\u1edbi c&aacute;c phi&ecirc;n b\\u1ea3n c&ograve;n l\\u1ea1i, m\\u1ee9c gi&aacute; ch\\u1ec9 c\\u1ed9ng th&ecirc;m 5 tri\\u1ec7u \\u0111\\u1ed3ng.<\\/p>\\r\\n\\r\\n<p><em><strong>Ch&iacute;nh s&aacute;ch b\\u1ea3o h&agrave;nh xe nh\\u1eadp kh\\u1ea9u<\\/strong><\\/em><\\/p>\\r\\n\\r\\n<p>Do l&agrave; Hyundai Creta \\u0111\\u01b0\\u1ee3c nh\\u1eadp kh\\u1ea9u t\\u1ea1i th\\u1ecb tr\\u01b0\\u1eddng n\\u01b0\\u1edbc ngo&agrave;i n&ecirc;n \\u0111\\u01b0\\u1ee3c b\\u1ea3o h&agrave;nh l&ecirc;n \\u0111\\u1ebfn&nbsp;<em>5 n\\u0103m ho\\u1eb7c<\\/em>&nbsp;<em>100.000km ( tu\\u1ef3 theo \\u0111i\\u1ec1u ki\\u1ec7n n&agrave;o \\u0111\\u1ebfn tr\\u01b0\\u1edbc ).<\\/em><\\/p>\\r\\n\\r\\n<p>Hyundai Creta \\u0111\\u01b0\\u1ee3c gi\\u1edbi thi\\u1ec7u l&agrave; th\\u1ebf h\\u1ec7 th\\u1ee9 2 v&agrave; \\u0111\\u01b0\\u1ee3c thi\\u1ebft k\\u1ebf tinh ch\\u1ec9nh d&agrave;nh ri&ecirc;ng cho th\\u1ecb tr\\u01b0\\u1eddng \\u0110&ocirc;ng Nam &Aacute; v&agrave; Trung \\u0110&ocirc;ng v\\u1edbi nh\\u1eefng \\u0111\\u1eb7c \\u0111i\\u1ec3m, k\\u1ef9 thu\\u1eadt ph&ugrave; h\\u1ee3p.<\\/p>\\r\\n\\r\\n<p>\\u0110\\u01b0\\u1ee3c bi\\u1ebft s\\u1ebd s\\u1edbm \\u0111\\u01b0\\u1ee3c s\\u1ea3n xu\\u1ea5t l\\u1eafp r&aacute;p t\\u1ea1i Vi\\u1ec7t Nam n\\u0103m 2023 sau khi nh&agrave; m&aacute;y Hyundai Th&agrave;nh C&ocirc;ng s\\u1ed1 2 ho&agrave;n thi\\u1ec7n v&agrave; \\u0111i v&agrave;o ho\\u1ea1t \\u0111\\u1ed9ng.<\\/p>\\r\\n\\r\\n<h3>M\\u1ee9c gi&aacute; \\u0111\\u01b0\\u1ee3c nh&agrave; m&aacute;y khuy\\u1ebfn nghi cho t\\u1eebng phi&ecirc;n b\\u1ea3n Hyundai Creta :<\\/h3>\\r\\n\\r\\n<ul>\\r\\n\\t<li>1.5 Ti&ecirc;u Chu\\u1ea9n: 640 tri\\u1ec7u VN\\u0110<\\/li>\\r\\n\\t<li>1.5 \\u0110\\u1eb7c Bi\\u1ec7t: 690 tri\\u1ec7u VN\\u0110<\\/li>\\r\\n\\t<li>1.5 Cao C\\u1ea5p: 740 tri\\u1ec7u VN\\u0110<\\/li>\\r\\n<\\/ul>\\r\\n<\\/section>\\r\\n\\r\\n<section data-element_type=\\\"section\\\" data-id=\\\"5e15c57\\\" id=\\\"ngoaithat\\\">\\r\\n<h2>NGO\\u1ea0I TH\\u1ea4T HYUNDAI CRETA<\\/h2>\\r\\n\\r\\n<p><img alt=\\\"\\\" height=\\\"838\\\" src=\\\"https:\\/\\/hyundai-cantho.com\\/wp-content\\/uploads\\/2022\\/03\\/ngoai-that-creta.jpg\\\" width=\\\"1200\\\" \\/><img alt=\\\"\\\" height=\\\"1013\\\" src=\\\"https:\\/\\/hyundai-cantho.com\\/wp-content\\/uploads\\/2022\\/03\\/hyundai-creta-3.jpg\\\" width=\\\"1520\\\" \\/>Hyundai Creta c&oacute; k&iacute;ch th\\u01b0\\u1edbc D&agrave;i ( 4.315 mm ), R\\u1ed9ng (1.790 mm ), Cao (1.660 mm ) c&ugrave;ng kho\\u1ea3ng s&aacute;ng g\\u1ea7m xe g\\u1ea7n nh\\u01b0 cao nh\\u1ea5t ph&acirc;n kh&uacute;c&nbsp; 200 (mm), \\u0111\\u01b0\\u1ee3c coi l&agrave; &ldquo;ti\\u1ec3u Tucson&rdquo; v\\u1edbi l\\u01b0\\u1edbi t\\u1ea3n nhi\\u1ec7t m&agrave;u \\u0111en v&agrave; \\u0111&egrave;n \\u0111\\u1ecbnh v\\u1ecb LED n\\u1ed1i li\\u1ec1n b\\u1eaft k\\u1ecbp xu h\\u01b0\\u1edbng hi\\u1ec7n nay c\\u1ee7a c&aacute;c m\\u1eabu xe h\\u1ea1ng sang.<\\/p>\\r\\n\\r\\n<p><img alt=\\\"\\\" height=\\\"1032\\\" src=\\\"https:\\/\\/hyundai-cantho.com\\/wp-content\\/uploads\\/2022\\/03\\/hyundai-creta-6.jpg\\\" width=\\\"1520\\\" \\/>C\\u1ee5m \\u0111&egrave;n chi\\u1ebfu s&aacute;ng ti\\u1ebfp t\\u1ee5c \\u0111\\u01b0\\u1ee3c \\u0111\\u1eb7t th\\u1ea5p, trong khi ph&iacute;a sau v\\u1eabn l&agrave; s\\u1ef1 xu\\u1ea5t hi\\u1ec7n c\\u1ee7a c\\u1ee5m \\u0111&egrave;n \\u0111a gi&aacute;c \\u0111\\u1eb7c tr\\u01b0ng.<img alt=\\\"\\\" height=\\\"1333\\\" src=\\\"https:\\/\\/hyundai-cantho.com\\/wp-content\\/uploads\\/2022\\/03\\/hyundai-creta-10.jpg\\\" width=\\\"2000\\\" \\/><\\/p>\\r\\n\\r\\n<p>Ngo&agrave;i ra xe c&ograve;n trang b\\u1ecb n\\u1eafp capo m\\u1edbi, b\\u1ed9 m&acirc;m xe h\\u1ee3p kim 5 ch\\u1ea5u k&iacute;ch th\\u01b0\\u1edbc 17 inch ( t\\u1ea5t c\\u1ea3 phi&ecirc;n b\\u1ea3n ) hai t&ocirc;ng m&agrave;u th\\u1ec3 thao, k\\u1ebft h\\u1ee3p c&ugrave;ng v&ograve;m b&aacute;nh xe c\\u01a1 b\\u1eafp, c&aacute;nh gi&oacute; g\\u1eafn tr&ecirc;n n&oacute;c xe v&agrave; \\u0103ng-ten v&acirc;y c&aacute; m\\u1eadp.<img alt=\\\"\\\" height=\\\"992\\\" src=\\\"https:\\/\\/hyundai-cantho.com\\/wp-content\\/uploads\\/2022\\/03\\/hyundai-creta-5.jpg\\\" width=\\\"1520\\\" \\/><\\/p>\\r\\n\\r\\n<p>C&ugrave;ng v\\u1edbi \\u0111&oacute; l&agrave; h\\u1ec7 th\\u1ed1ng \\u0111&egrave;n chi\\u1ebfu s&aacute;ng full LED, \\u0111&egrave;n phanh tr&ecirc;n cao d\\u1ea1ng LED, tay n\\u1eafm c\\u1eeda m\\u1ea1 Crom, g\\u01b0\\u01a1ng chi\\u1ebfu h\\u1eadu t&iacute;ch h\\u1ee3p xi-nhan \\u0111i\\u1ec1u ch\\u1ec9nh \\u0111i\\u1ec7n h\\u1ed7 tr\\u1ee3 s\\u1ea5y&hellip;<\\/p>\\r\\n<\\/section>\\r\\n\\r\\n<section data-element_type=\\\"section\\\" data-id=\\\"f6feb29\\\" id=\\\"noithat\\\">\\r\\n<h2>N\\u1ed8I TH\\u1ea4T HYUNDAI CRETA<\\/h2>\\r\\n\\r\\n<p><img alt=\\\"\\\" height=\\\"932\\\" src=\\\"https:\\/\\/hyundai-cantho.com\\/wp-content\\/uploads\\/2022\\/03\\/noi-that-hyundai-creta.jpg\\\" width=\\\"1520\\\" \\/>Hyundai Creta 2022 \\u0111\\u01b0\\u1ee3c trang b\\u1ecb gh\\u1ebf ng\\u1ed3i b\\u1ecdc da cao c\\u1ea5p, c&aacute;c chi ti\\u1ebft da c\\u0169ng xu\\u1ea5t hi\\u1ec7n k\\u1ebft h\\u1ee3p c&ugrave;ng ch\\u1ea5t li\\u1ec7u nh\\u1ef1a cao c\\u1ea5p trong cabin xe gi&uacute;p t\\u0103ng th&ecirc;m ph\\u1ea7n l\\u1ecbch l&atilde;m sang tr\\u1ecdng.<img alt=\\\"\\\" height=\\\"1013\\\" src=\\\"https:\\/\\/hyundai-cantho.com\\/wp-content\\/uploads\\/2022\\/03\\/hyundai-creta-13.jpg\\\" width=\\\"1520\\\" \\/><\\/p>\\r\\n\\r\\n<p>B\\u1ea3ng taplo xe n\\u1ed5i b\\u1eadt v\\u1edbi m&agrave;n h&igrave;nh \\u0111a th&ocirc;ng tin v&agrave; m&agrave;n h&igrave;nh gi\\u1ea3i tr&iacute; c\\u1ea3m \\u1ee9ng 10.25 inch ( gi\\u1ed1ng v\\u1edbi \\u0111&agrave;n anh Tucson ) \\u0111i\\u1ec1u khi\\u1ec3n \\u0111a ch\\u1ee9c n\\u0103ng n\\u1eb1m \\u1edf v\\u1ecb tr&iacute; trung t&acirc;m, t&iacute;ch h\\u1ee3p camera l&ugrave;i.<img alt=\\\"\\\" height=\\\"1333\\\" src=\\\"https:\\/\\/hyundai-cantho.com\\/wp-content\\/uploads\\/2022\\/03\\/hyundai-creta-17.jpg\\\" width=\\\"2000\\\" \\/><\\/p>\\r\\n\\r\\n<p>H\\u1ec7 th\\u1ed1ng gi\\u1ea3i tr&iacute; c\\u1ee7a xe h\\u1ed7 tr\\u1ee3 \\u0111\\u1ea7y \\u0111\\u1ee7 Mp3\\/USB\\/Aux\\/Bluetooth, Android Auto, Apple Carplay v\\u1edbi 8 loa Bose c&ugrave;ng amply r\\u1eddi ch\\u1ea5t l\\u01b0\\u1ee3ng cao.<\\/p>\\r\\n\\r\\n<p><img alt=\\\"\\\" height=\\\"900\\\" src=\\\"https:\\/\\/hyundai-cantho.com\\/wp-content\\/uploads\\/2022\\/03\\/noi-that-hyundai-creta2.jpg\\\" width=\\\"1520\\\" \\/>Hyundai Creta \\u0111\\u01b0\\u01a1c trang b\\u1ecb n&uacute;t b\\u1ea5m kh\\u1edfi \\u0111\\u1ed9ng Start\\/Stop Engine c&ugrave;ng ch&igrave;a kh&oacute;a th&ocirc;ng minh ( t&iacute;ch h\\u1ee3p \\u0111\\u1ec3 n\\u1ed5 t\\u1eeb xe v&agrave; l&ecirc;n k&iacute;nh t\\u1ef1 \\u0111\\u1ed9ng ). Gh\\u1ebf l&aacute;i xe \\u0111i\\u1ec1u ch\\u1ec9nh \\u0111i\\u1ec7n 8 h\\u01b0\\u1edbng c&ugrave;ng v&ocirc; l\\u0103ng c&oacute; th\\u1ec3 \\u0111i\\u1ec1u ch\\u1ec9nh g&oacute;c cao, th\\u1ea5p 4 h\\u01b0\\u1edbng gi&uacute;p ng\\u01b0\\u1eddi l&aacute;i c&oacute; \\u0111\\u01b0\\u1ee3c t\\u01b0 th\\u1ebf ng\\u1ed3i th\\u1ecfa m&aacute;i nh\\u1ea5t.<img alt=\\\"\\\" height=\\\"1333\\\" src=\\\"https:\\/\\/hyundai-cantho.com\\/wp-content\\/uploads\\/2022\\/03\\/hyundai-creta-16.jpg\\\" width=\\\"2000\\\" \\/><\\/p>\\r\\n\\r\\n<p>Theo Hyundai, h\\u1ec7 th\\u1ed1ng \\u0111i\\u1ec1u h&ograve;a t\\u1ef1 \\u0111\\u1ed9ng tr&ecirc;n xe v\\u1edbi kh\\u1ea3 n\\u0103ng l&agrave;m m&aacute;t nhanh v&agrave; s&acirc;u t&iacute;ch h\\u1ee3p c&ocirc;ng ngh\\u1ec7 l\\u1ecdc kh\\u1eed Ion, k\\u1ebft h\\u1ee3p c&ugrave;ng c\\u1eeda gi&oacute; cho h&agrave;ng gh\\u1ebf sau \\u0111em \\u0111\\u1ebfn kh&ocirc;ng gian d\\u1ec5 ch\\u1ecbu cho c\\u1ea3 ng\\u01b0\\u1eddi l&aacute;i v&agrave; h&agrave;nh kh&aacute;ch.<img alt=\\\"\\\" height=\\\"1013\\\" src=\\\"https:\\/\\/hyundai-cantho.com\\/wp-content\\/uploads\\/2022\\/03\\/hyundai-creta-1.jpg\\\" width=\\\"1520\\\" \\/><\\/p>\\r\\n\\r\\n<p>V&ocirc; l\\u0103ng xe t&iacute;ch h\\u1ee3p c&aacute;c n&uacute;t \\u0111i\\u1ec1u khi\\u1ec3n th&ocirc;ng s\\u1ed1 c&agrave;i \\u0111\\u1eb7t, chuy\\u1ec3n nh\\u1ea1c, nh\\u1eadn cu\\u1ed9c g\\u1ecdi \\u0111\\u1ea3m b\\u1ea3o t&iacute;nh ti\\u1ec7n l\\u1ee3i v&agrave; an to&agrave;n khi v\\u1eadn h&agrave;nh.<\\/p>\\r\\n\\r\\n<p>C&aacute;c trang b\\u1ecb ti\\u1ec7n &iacute;ch kh&aacute;c tr&ecirc;n xe bao g\\u1ed3m: s\\u01b0\\u1edfi v&agrave; l&agrave;m m&aacute;t h&agrave;ng gh\\u1ebf tr\\u01b0\\u1edbc, \\u0111i\\u1ec1u khi\\u1ec3n h&agrave;nh tr&igrave;nh th&ocirc;ng minh, gi\\u1edbi h\\u1ea1n t\\u1ed1c \\u0111\\u1ed9 MSLA, phanh tay \\u0111i\\u1ec7n t\\u1eed EPB v&agrave; Autohold, c\\u1ea3m bi\\u1ebfn &aacute;p su\\u1ea5t l\\u1ed1p TPMS&hellip;<\\/p>\\r\\n<\\/section>\\r\\n\\r\\n<section data-element_type=\\\"section\\\" data-id=\\\"3a6816b\\\" id=\\\"vanhanh\\\">\\r\\n<h2>V\\u1eacN H&Agrave;NH HYUNDAI CRETA<\\/h2>\\r\\n\\r\\n<p>Hyundai Creta \\u0111\\u01b0\\u1ee3c ph&acirc;n ph\\u1ed1i t\\u1ea1i Vi\\u1ec7t Nam trang b\\u1ecb \\u0111\\u1ed9ng c\\u01a1 x\\u0103ng h&uacute;t kh&iacute; t\\u1ef1 nhi&ecirc;n 1.5L m\\u1edbi s\\u1ea3n sinh c&ocirc;ng su\\u1ea5t 115 m&atilde; l\\u1ef1c t\\u1ea1i 6.300 v&ograve;ng\\/ph&uacute;t, m&ocirc;-men xo\\u1eafn c\\u1ef1c \\u0111\\u1ea1i 144 Nm t\\u1ea1i 4.500 v&ograve;ng\\/ph&uacute;t.<img alt=\\\"\\\" height=\\\"914\\\" src=\\\"https:\\/\\/hyundai-cantho.com\\/wp-content\\/uploads\\/2022\\/03\\/van-hanh-hyundai-creta.jpg\\\" width=\\\"1200\\\" \\/><img alt=\\\"\\\" height=\\\"1206\\\" src=\\\"https:\\/\\/hyundai-cantho.com\\/wp-content\\/uploads\\/2022\\/03\\/dong-co-hyundia-creta.jpg\\\" width=\\\"1147\\\" \\/><\\/p>\\r\\n\\r\\n<p>Xe d\\u1eabn \\u0111\\u1ed9ng c\\u1ea7u tr\\u01b0\\u1edbc th&ocirc;ng qua h\\u1ed9p s\\u1ed1 iVT (h\\u1ed9p s\\u1ed1 v&ocirc; c\\u1ea5p bi\\u1ebfn thi&ecirc;n th&ocirc;ng minh) do Hyundai ph&aacute;t tri\\u1ec3n.<\\/p>\\r\\n\\r\\n<p>H\\u1ed9p s\\u1ed1 v&ocirc; c\\u1ea5p IVT \\u0111\\u01b0\\u1ee3c c\\u1ea3i ti\\u1ebfn t\\u1eeb h\\u1ed9p s\\u1ed1 v&ocirc; c\\u1ea5p CVT th&ocirc;ng th\\u01b0\\u1eddng s\\u1ebd gi&uacute;p kh\\u1eafc ph\\u1ee5c \\u0111\\u01b0\\u1ee3c c&aacute;c nh\\u01b0\\u1ee3c \\u0111i\\u1ec3m c\\u1ee7a CVT (Ph\\u1ea3n h\\u1ed3i ch\\u1eadm, ti\\u1ebfng \\u1ed3n, tr\\u01b0\\u1ee3t c\\u1ee7a \\u0111ai s\\u1eaft) v&agrave; v\\u1eabn duy tr&igrave; \\u0111\\u01b0\\u1ee3c nh\\u1eefng \\u0111\\u1eb7c t&iacute;nh t\\u1ed1t c\\u1ee7a CVT (\\u0111\\u1ed9 m\\u01b0\\u1ee3t m&agrave;, ti\\u1ebft ki\\u1ec7m nhi&ecirc;n li\\u1ec7u, lanh l\\u1eb9 trong ph\\u1ed1).<\\/p>\\r\\n\\r\\n<p>Hyundai Creta \\u0111\\u01b0\\u1ee3c trang b\\u1ecb \\u0111\\u1ea7y \\u0111\\u1ee7 nh\\u1eefng c&ocirc;ng ngh\\u1ec7 an to&agrave;n h&agrave;ng \\u0111\\u1ea7u nh\\u01b0: ch\\u1ed1ng b&oacute; c\\u1ee9ng phanh ABS, h\\u1ed7 tr\\u1ee3 phanh kh\\u1ea9n c\\u1ea5p BA, ph&acirc;n ph\\u1ed1i l\\u1ef1c phanh \\u0111i\\u1ec7n t\\u1eed EBD, c&acirc;n b\\u1eb1ng \\u0111i\\u1ec7n t\\u1eed ESC, kh\\u1edfi h&agrave;nh ngang d\\u1ed1c HAC.<img alt=\\\"\\\" height=\\\"1176\\\" src=\\\"https:\\/\\/hyundai-cantho.com\\/wp-content\\/uploads\\/2022\\/03\\/he-thong-hyundai-creta.jpg\\\" width=\\\"1045\\\" \\/><\\/p>\\r\\n\\r\\n<p>Ngo&agrave;i ra xe c&ograve;n trang b\\u1ecb 6 t&uacute;i kh&iacute; an to&agrave;n, th&acirc;n xe \\u0111\\u01b0\\u1ee3c ch\\u1ebf t\\u1ea1o b\\u1eb1ng c&ocirc;ng ngh\\u1ec7 luy\\u1ec7n th&eacute;p c\\u01b0\\u1eddng l\\u1ef1c AHSS \\u0111\\u1ed9c quy\\u1ec1n, theo Hyundai, c&ocirc;ng ngh\\u1ec7 n&agrave;y gi&uacute;p gia tang \\u0111\\u1ed9 c\\u1ee9ng v&agrave; v\\u1eefng ch\\u1eafc, t\\u1ea1o n&ecirc;n m\\u1ed9t b\\u1ed9 khung v\\u1eefng ch\\u1eafc, \\u0111\\u1ea3m b\\u1ea3o an to&agrave;n t\\u1ed1i \\u0111a cho h&agrave;nh kh&aacute;ch trong tr\\u01b0\\u1eddng h\\u1ee3p x\\u1ea3y ra va ch\\u1ea1m.<\\/p>\\r\\n\\r\\n<p>B&ecirc;n c\\u1ea1nh \\u0111&oacute;, l\\u1ea7n \\u0111\\u1ea7u ti&ecirc;n trong ph&acirc;n kh&uacute;c g&oacute;i an to&agrave;n ch\\u1ee7 \\u0111\\u1ed9ng \\u0111\\u01b0\\u1ee3c trang b\\u1ecb tr&ecirc;n m\\u1ed9t m\\u1eabu xe B-SUV, \\u0111&oacute; l&agrave; h\\u1ec7 th\\u1ed1ng SmartSense tr&ecirc;n Creta.<\\/p>\\r\\n\\r\\n<p>H\\u1ec7 th\\u1ed1ng n&agrave;y s\\u1eed d\\u1ee5ng camera ph&iacute;a tr\\u01b0\\u1edbc \\u0111\\u1ec3 nh\\u1eadn bi\\u1ebft t&igrave;nh h&igrave;nh giao th&ocirc;ng, \\u0111\\u01b0a ra s\\u1ef1 h\\u1ed7 tr\\u1ee3 k\\u1ecbp th\\u1eddi cho ng\\u01b0\\u1eddi l&aacute;i \\u0111\\u1ea3m b\\u1ea3o an to&agrave;n.<\\/p>\\r\\n\\r\\n<p>G&oacute;i an to&agrave;n SmartSense tr&ecirc;n Creta bao g\\u1ed3m: H\\u1ec7 th\\u1ed1ng h\\u1ed7 tr\\u1ee3 ph&ograve;ng tr&aacute;nh va ch\\u1ea1m tr\\u01b0\\u1edbc FCA; H\\u1ec7 th\\u1ed1ng h\\u1ed7 tr\\u1ee3 ph&ograve;ng tr&aacute;nh va ch\\u1ea1m \\u0111i\\u1ec3m m&ugrave; BCA; H\\u1ec7 th\\u1ed1ng h\\u1ed7 tr\\u1ee3 gi\\u1eef l&agrave;n \\u0111\\u01b0\\u1eddng LFA; H\\u1ec7 th\\u1ed1ng h\\u1ed7 tr\\u1ee3 ph&ograve;ng tr&aacute;nh va ch\\u1ea1m ph&iacute;a sau RCCA.<\\/p>\\r\\n<\\/section>\\r\\n\\r\\n<section data-element_type=\\\"section\\\" data-id=\\\"9dcde55\\\" id=\\\"thongso\\\">\\r\\n<h2>TH&Ocirc;NG S\\u1ed0 HYUNDAI CRETA<\\/h2>\\r\\n\\r\\n<p><img alt=\\\"\\\" height=\\\"1077\\\" src=\\\"https:\\/\\/hyundai-cantho.com\\/wp-content\\/uploads\\/2022\\/03\\/mau-xe-hyundai-creta.jpg\\\" width=\\\"769\\\" \\/><img alt=\\\"\\\" height=\\\"1520\\\" src=\\\"https:\\/\\/hyundai-cantho.com\\/wp-content\\/uploads\\/2022\\/03\\/tskt-creta.jpg\\\" width=\\\"1416\\\" \\/><\\/p>\\r\\n<\\/section>\"}]', NULL, '{\"main\":\"\\/storage\\/hyundai\\/creta\\/anh-dai-dien-creta.png\"}', 1, 1, 1, '[\"1\",\"2\",\"3\"]', '{\"3\":{\"7\":\"3-phien-ban-creta-tieu-chuan\",\"8\":\"3-phien-ban-creta-dac-biet\",\"9\":\"3-phien-ban-creta-cao-cap\"},\"4\":{\"12\":\"4-mau-sac-trang\",\"13\":\"4-mau-sac-den\",\"14\":\"4-mau-sac-do\",\"15\":\"4-mau-sac-bac\",\"17\":\"4-mau-sac-xam-titan\",\"21\":\"4-mau-sac-xanh-duong\"}}', NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, '2023-11-09 03:07:39', '2023-11-16 08:51:46', 0, 12),
(2, 'Hyundai Santafe', 'hyundai-santafe', 'Hy-san-2021', '', '[{\"label\":\"N\\u1ed9i dung\",\"label_hidden\":\"N\\u1ed9i dung\",\"url\":\"noi-dung\",\"content\":\"<h2>N\\u1ed4I B\\u1eacT<\\/h2>\\r\\n\\r\\n<p><img alt=\\\"nb1\\\" height=\\\"NaN\\\" src=\\\"https:\\/\\/hyundaitaydo.vn\\/images\\/Sampham\\/santafe2021\\/nb1.jpg\\\" width=\\\"100%\\\" \\/><\\/p>\\r\\n\\r\\n<p>&nbsp;<\\/p>\\r\\n\\r\\n<p><strong>THI\\u1ebeT K\\u1ebe M\\u1edaI LAY \\u0110\\u1ed8NG M\\u1eccI GI&Aacute;C QUAN<\\/strong><\\/p>\\r\\n\\r\\n<p>Hyundai SantaFe ho&agrave;n to&agrave;n m\\u1edbi s\\u1edf h\\u1eefu ng&ocirc;n ng\\u1eef thi\\u1ebft k\\u1ebf m\\u1edbi c&ugrave;ng h&agrave;ng lo\\u1ea1t nh\\u1eefng t&iacute;nh n\\u0103ng v\\u01b0\\u1ee3t tr\\u1ed9i.<\\/p>\\r\\n\\r\\n<h2>N\\u1ed8I TH\\u1ea4T<\\/h2>\\r\\n\\r\\n<p><strong>N\\u1ed8I TH\\u1ea4T<\\/strong><\\/p>\\r\\n\\r\\n<p>T\\u1eadn h\\u01b0\\u1edfng kh&ocirc;ng gian n\\u1ed9i th\\u1ea5t \\u0111\\u1eb3ng c\\u1ea5p trong chi\\u1ebfc SUV th\\u1ebf h\\u1ec7 ho&agrave;n to&agrave;n m\\u1edbi c\\u1ee7a Hyundai.B\\u1ea3ng \\u0111i\\u1ec1u khi\\u1ec3n m\\u1edf r\\u1ed9ng, \\u0111em t\\u1edbi kh\\u1ea3 n\\u0103ng hi\\u1ec3n th\\u1ecb t\\u1ed1i \\u0111a c&ugrave;ng H\\u1ec7 th\\u1ed1ng gi\\u1ea3i tr&iacute; v&agrave; ti\\u1ec7n &iacute;ch AVN. Kh&ocirc;ng gian n\\u1ed9i th\\u1ea5t s\\u1ebd l&agrave;m h&agrave;i l&ograve;ng nh\\u1eefng kh&aacute;ch h&agrave;ng kh&oacute; t&iacute;nh nh\\u1ea5t v\\u1edbi gh\\u1ebf da cao c\\u1ea5p.<\\/p>\\r\\n\\r\\n<p><img alt=\\\"1\\\" height=\\\"NaN\\\" src=\\\"https:\\/\\/hyundaitaydo.vn\\/images\\/Sampham\\/santafe2021\\/1.jpg\\\" width=\\\"100%\\\" \\/><\\/p>\\r\\n\\r\\n<p>&nbsp;<\\/p>\\r\\n\\r\\n<p><strong>GH\\u1ebe NG\\u1ed2I &amp; C\\u1ed0P XE<\\/strong><\\/p>\\r\\n\\r\\n<p>Cho d&ugrave; b\\u1ea1n \\u0111i d&atilde; ngo\\u1ea1i, \\u0111&aacute;nh golf hay c\\u1eafm tr\\u1ea1i c&ugrave;ng v\\u1edbi gia \\u0111&igrave;nh hay b\\u1ea1n b&egrave;, chi\\u1ebfc xe 7 ch\\u1ed7 SantaFe \\u0111\\u1ec1u linh ho\\u1ea1t \\u0111&aacute;p \\u1ee9ng \\u0111\\u01b0\\u1ee3c nhu c\\u1ea7u c\\u1ee7a b\\u1ea1n.<\\/p>\\r\\n\\r\\n<p><img alt=\\\"2\\\" height=\\\"NaN\\\" src=\\\"https:\\/\\/hyundaitaydo.vn\\/images\\/Sampham\\/santafe2021\\/2.jpg\\\" width=\\\"100%\\\" \\/><\\/p>\\r\\n\\r\\n<h2>NGO\\u1ea0I TH\\u1ea4T<\\/h2>\\r\\n\\r\\n<p><strong>Thi\\u1ebft k\\u1ebf ngo\\u1ea1i th\\u1ea5t \\u0111\\u1eb3ng c\\u1ea5p<\\/strong><\\/p>\\r\\n\\r\\n<p><strong><img alt=\\\"22\\\" height=\\\"NaN\\\" src=\\\"https:\\/\\/hyundaitaydo.vn\\/images\\/Sampham\\/santafe2021\\/22.jpg\\\" width=\\\"100%\\\" \\/><\\/strong><\\/p>\\r\\n\\r\\n<p>&nbsp;<\\/p>\\r\\n\\r\\n<table>\\r\\n\\t<tbody>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td><img alt=\\\"33\\\" height=\\\"NaN\\\" src=\\\"https:\\/\\/hyundaitaydo.vn\\/images\\/Sampham\\/santafe2021\\/33.jpg\\\" width=\\\"100%\\\" \\/>\\r\\n\\t\\t\\t<h3>L\\u01b0\\u1edbi t\\u1ea3n nhi\\u1ec7t m\\u1ea1 chrome<\\/h3>\\r\\n\\t\\t\\t<\\/td>\\r\\n\\t\\t\\t<td><img alt=\\\"44\\\" height=\\\"NaN\\\" src=\\\"https:\\/\\/hyundaitaydo.vn\\/images\\/Sampham\\/santafe2021\\/44.jpg\\\" width=\\\"100%\\\" \\/>\\r\\n\\t\\t\\t<p><strong>\\u0110&egrave;n pha LED project c&ugrave;ng \\u0111&egrave;n LED ban ng&agrave;y thi\\u1ebft k\\u1ebf h&igrave;nh ch\\u1eef T \\u0111\\u1eb7c tr\\u01b0ng<\\/strong><\\/p>\\r\\n\\t\\t\\t<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t<\\/tbody>\\r\\n<\\/table>\\r\\n\\r\\n<p>&nbsp;<\\/p>\\r\\n\\r\\n<p><strong>\\u1ed0p crom b&ecirc;n h&ocirc;ng n\\u1ed5i b\\u1eadt<\\/strong><\\/p>\\r\\n\\r\\n<p><img alt=\\\"7\\\" height=\\\"NaN\\\" src=\\\"https:\\/\\/hyundaitaydo.vn\\/images\\/Sampham\\/santafe2021\\/7.jpg\\\" width=\\\"100%\\\" \\/><\\/p>\\r\\n\\r\\n<table>\\r\\n\\t<tbody>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td>\\r\\n\\t\\t\\t<p><img alt=\\\"8\\\" height=\\\"NaN\\\" src=\\\"https:\\/\\/hyundaitaydo.vn\\/images\\/Sampham\\/santafe2021\\/8.jpg\\\" width=\\\"100%\\\" \\/><\\/p>\\r\\n\\r\\n\\t\\t\\t<p><strong>G\\u01b0\\u01a1ng chi\\u1ebfu h\\u1eadu g\\u1eadp \\u0111i\\u1ec7n, ch\\u1ec9nh \\u0111i\\u1ec7n, c&oacute; s\\u1ea5y t&iacute;ch h\\u1ee3p \\u0111&egrave;n xi nhan v&agrave; \\u0111&egrave;n ch&agrave;o<\\/strong><\\/p>\\r\\n\\t\\t\\t<\\/td>\\r\\n\\t\\t\\t<td>\\r\\n\\t\\t\\t<p><img alt=\\\"9\\\" height=\\\"NaN\\\" src=\\\"https:\\/\\/hyundaitaydo.vn\\/images\\/Sampham\\/santafe2021\\/9.jpg\\\" width=\\\"100%\\\" \\/><\\/p>\\r\\n\\r\\n\\t\\t\\t<p><strong>C\\u1eeda s\\u1ed5 tr\\u1eddi to&agrave;n c\\u1ea3nh Panorama<\\/strong><\\/p>\\r\\n\\t\\t\\t<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t<\\/tbody>\\r\\n<\\/table>\\r\\n\\r\\n<p>&nbsp;<\\/p>\\r\\n\\r\\n<p>&nbsp;<\\/p>\\r\\n\\r\\n<p>&nbsp;<\\/p>\\r\\n\\r\\n<h2>HI\\u1ec6U SU\\u1ea4T<\\/h2>\\r\\n\\r\\n<p><strong>C\\u1ea2M X&Uacute;C NG\\u1eacP TR&Agrave;N M\\u1eccI CUNG \\u0110\\u01af\\u1edcNG<\\/strong><\\/p>\\r\\n\\r\\n<p>\\u0110\\u1ec3 v\\u01b0\\u1ee3t qua m\\u1ecdi h&agrave;nh tr&igrave;nh, chi\\u1ebfc SantaFe m\\u1edbi \\u0111\\u01b0\\u1ee3c trang b\\u1ecb \\u0111\\u1ed9ng c\\u01a1 MPI phun x\\u0103ng \\u0111a \\u0111i\\u1ec3m k\\u1ebft h\\u1ee3p h\\u1ed9p s\\u1ed1 t\\u1ef1 \\u0111\\u1ed9ng 6 c\\u1ea5p m\\u1edbi v&agrave; \\u0111\\u1ed9ng c\\u01a1 D\\u1ea7u Smart Stream th\\u1ebf h\\u1ee3i m\\u1edbi c&ugrave;ng h\\u1ed9p s\\u1ed1 ly h\\u1ee3p k&eacute;p \\u01b0\\u1edbt 8 c\\u1ea5p mang l\\u1ea1i hi\\u1ec7u qu\\u1ea3 v&agrave; \\u0111\\u1ed9 b\\u1ec1n t\\u1ed1i \\u0111a cho \\u0111\\u1ed9ng c\\u01a1.<\\/p>\\r\\n\\r\\n<p><img alt=\\\"111\\\" height=\\\"NaN\\\" src=\\\"https:\\/\\/hyundaitaydo.vn\\/images\\/Sampham\\/santafe2021\\/111.jpg\\\" width=\\\"100%\\\" \\/><\\/p>\\r\\n\\r\\n<p><strong>\\u0110\\u1ed9ng c\\u01a1 x\\u0103ng SmartStream G2.5<\\/strong><\\/p>\\r\\n\\r\\n<p>C&ocirc;ng su\\u1ea5t c\\u1ef1c \\u0111\\u1ea1i 180 m&atilde; l\\u1ef1c t\\u1ea1i 6.000 v&ograve;ng\\/ph&uacute;t<br \\/>\\r\\nM&ocirc; men xo\\u1eafn c\\u1ef1c \\u0111\\u1ea1i 232Nm t\\u1ea1i 4.000 v&ograve;ng\\/ph&uacute;t<\\/p>\\r\\n\\r\\n<p><img alt=\\\"1ad\\\" height=\\\"NaN\\\" src=\\\"https:\\/\\/hyundaitaydo.vn\\/images\\/Sampham\\/santafe2021\\/1ad.png\\\" width=\\\"100%\\\" \\/><\\/p>\\r\\n\\r\\n<p><strong>\\u0110\\u1ed9ng c\\u01a1 d\\u1ea7u SmartStream D2.2<\\/strong><\\/p>\\r\\n\\r\\n<p>C&ocirc;ng su\\u1ea5t c\\u1ef1c \\u0111\\u1ea1i 202 m&atilde; l\\u1ef1c t\\u1ea1i 3.800 v&ograve;ng\\/ph&uacute;t<\\/p>\\r\\n\\r\\n<p>M&ocirc; men xo\\u1eafn c\\u1ef1c \\u0111\\u1ea1i 440Nm t\\u1ea1i 1.750 &ndash; 2.750 v&ograve;ng\\/ph&uacute;t<\\/p>\\r\\n\\r\\n<p>&nbsp;<img alt=\\\"22ad\\\" height=\\\"NaN\\\" src=\\\"https:\\/\\/hyundaitaydo.vn\\/images\\/Sampham\\/santafe2021\\/22ad.png\\\" width=\\\"100%\\\" \\/><\\/p>\\r\\n\\r\\n<p>&nbsp;<\\/p>\\r\\n\\r\\n<p><strong>HTRAC<\\/strong><\\/p>\\r\\n\\r\\n<p>HTRAC l&agrave; h\\u1ec7 th\\u1ed1ng d\\u1eabn \\u0111\\u1ed9ng 4 b&aacute;nh to&agrave;n th\\u1eddi gian th&ocirc;ng minh, s\\u1ebd \\u0111o l\\u01b0\\u1eddng t\\u1ed1c \\u0111\\u1ed9 c\\u1ee7a ph\\u01b0\\u01a1ng ti\\u1ec7n v&agrave; t&igrave;nh tr\\u1ea1ng m\\u1eb7t \\u0111\\u01b0\\u1eddng \\u0111\\u1ec3 ki\\u1ec3m so&aacute;t l\\u1ef1c phanh gi\\u1eefa b&aacute;nh tr&aacute;i v&agrave; b&aacute;nh ph\\u1ea3i nh\\u1eb1m \\u0111\\u1ea3m b\\u1ea3o an to&agrave;n khi v&agrave;o cua v&agrave; di chuy\\u1ec3n tr&ecirc;n c&aacute;c \\u0111o\\u1ea1n \\u0111\\u01b0\\u1eddng tr\\u01a1n tr\\u01b0\\u1ee3t.<\\/p>\\r\\n\\r\\n<p><img alt=\\\"4htrac\\\" height=\\\"NaN\\\" src=\\\"https:\\/\\/hyundaitaydo.vn\\/images\\/Sampham\\/santafe2021\\/4htrac.jpg\\\" width=\\\"100%\\\" \\/><\\/p>\\r\\n\\r\\n<h3>&nbsp;<\\/h3>\\r\\n\\r\\n<p><strong>4 CH\\u1ebe \\u0110\\u1ed8 L&Aacute;I<\\/strong><\\/p>\\r\\n\\r\\n<p>M&agrave;u s\\u1eafc c\\u1ee7a m&agrave;n h&igrave;nh th&ocirc;ng tin s\\u1ebd thay \\u0111\\u1ed5i theo ch\\u1ebf \\u0111\\u1ed9 l&aacute;i (Eco\\/Comfort\\/Sport\\/Smart) Ch\\u1ebf \\u0111\\u1ed9 l&aacute;i Comfort \\u0111em t\\u1edbi s\\u1ef1 nh\\u1eb9 nh&agrave;ng tho\\u1ea3i m&aacute;i. Ch\\u1ebf \\u0111\\u1ed9 Eco mang t\\u1edbi s\\u1ef1 ti\\u1ebft ki\\u1ec7m nhi&ecirc;n li\\u1ec7u, trong khi ch\\u1ebf \\u0111\\u1ed9 Sport t\\u1eadp trung v&agrave;o hi\\u1ec7u su\\u1ea5t v&agrave; c\\u1ea3m gi&aacute;c l&aacute;i ph\\u1ea5n kh&iacute;ch. Cu\\u1ed1i c&ugrave;ng ch\\u1ebf \\u0111\\u1ed9 l&aacute;i Smart \\u0111\\u01b0\\u1ee3c t\\u01b0\\u01a1ng th&iacute;ch v\\u1edbi phong c&aacute;ch l&aacute;i c\\u1ee7a ch\\u1ee7 xe<\\/p>\\r\\n\\r\\n<p><img alt=\\\"chedolai\\\" height=\\\"NaN\\\" src=\\\"https:\\/\\/hyundaitaydo.vn\\/images\\/Sampham\\/santafe2021\\/chedolai.jpg\\\" width=\\\"100%\\\" \\/><\\/p>\\r\\n\\r\\n<h3>&nbsp;<\\/h3>\\r\\n\\r\\n<p><strong>3 CH\\u1ebe \\u0110\\u1ed8 \\u0110\\u1ecaA H&Igrave;NH<\\/strong><\\/p>\\r\\n\\r\\n<p>T&iacute;nh n\\u0103ng m\\u1edbi s\\u1ebd gi&uacute;p chi\\u1ebfc xe d\\u1ec5 d&agrave;ng v\\u01b0\\u1ee3t qua c&aacute;c \\u0111\\u1ecba h&igrave;nh kh&oacute; nh\\u01b0 tuy\\u1ebft, b&ugrave;n l\\u1ea7y, c&aacute;t b\\u1eb1ng vi\\u1ec7c can thi\\u1ec7p v&agrave;o h\\u1ec7 th\\u1ed1ng truy\\u1ec1n l\\u1ef1c v&agrave; phanh c\\u1ee7a xe.<\\/p>\\r\\n\\r\\n<p><img alt=\\\"chedolai2\\\" height=\\\"NaN\\\" src=\\\"https:\\/\\/hyundaitaydo.vn\\/images\\/Sampham\\/santafe2021\\/chedolai2.jpg\\\" width=\\\"100%\\\" \\/><\\/p>\\r\\n\\r\\n<h2>AN TO&Agrave;N<\\/h2>\\r\\n\\r\\n<p><strong>AN TO&Agrave;N V\\u01af\\u1ee2T TR\\u1ed8I TRONG PH&Acirc;N KH&Uacute;C<\\/strong><\\/p>\\r\\n\\r\\n<p>C&ocirc;ng ngh\\u1ec7 an to&agrave;n trong chi\\u1ebfc SantaFe m\\u1edbi \\u0111\\u01b0\\u1ee3c t&iacute;ch h\\u1ee3p th&ecirc;m nhi\\u1ec1u t&iacute;nh n\\u0103ng v\\u01b0\\u1ee3t tr\\u1ed9i nh\\u01b0 g&oacute;i an to&agrave;n Hyundai SmartSense, H\\u1ec7 th\\u1ed1ng camera 360.<\\/p>\\r\\n\\r\\n<p><img alt=\\\"360\\\" height=\\\"NaN\\\" src=\\\"https:\\/\\/hyundaitaydo.vn\\/images\\/Sampham\\/santafe2021\\/360.jpg\\\" width=\\\"100%\\\" \\/><\\/p>\\r\\n\\r\\n<p><strong>H\\u1ec7 th\\u1ed1ng 6 t&uacute;i kh&iacute;<\\/strong><\\/p>\\r\\n\\r\\n<p><img alt=\\\"6tuikhi\\\" height=\\\"NaN\\\" src=\\\"https:\\/\\/hyundaitaydo.vn\\/images\\/Sampham\\/santafe2021\\/6tuikhi.jpg\\\" width=\\\"100%\\\" \\/><\\/p>\\r\\n\\r\\n<p>H\\u1ec7 th\\u1ed1ng 6 t&uacute;i kh&iacute; v\\u1edbi t&uacute;i kh&iacute; s\\u01b0\\u1eddn v&agrave; t&uacute;i kh&iacute; r&egrave;m b\\u1ea3o v\\u1ec7 m\\u1edf r\\u1ed9ng. T&uacute;i kh&iacute; gh\\u1ebf l&aacute;i v&agrave; gh\\u1ebf ph\\u1ee5 s\\u1ebd \\u0111\\u01b0\\u1ee3c bung ra d\\u1ef1a tr&ecirc;n c\\u1ea3m bi\\u1ebfn v\\u1ecb tr&iacute; c\\u1ee7a h&agrave;nh kh&aacute;ch, d&acirc;y an to&agrave;n v&agrave; m\\u1ee9c \\u0111\\u1ed9 nghi&ecirc;m tr\\u1ecdng c\\u1ee7a v\\u1ee5 tai n\\u1ea1n.<\\/p>\\r\\n\\r\\n<p>&nbsp;<\\/p>\\r\\n\\r\\n<p>&nbsp;<\\/p>\\r\\n\\r\\n<table>\\r\\n\\t<tbody>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td><img alt=\\\"canhbao1\\\" height=\\\"NaN\\\" src=\\\"https:\\/\\/hyundaitaydo.vn\\/images\\/Sampham\\/santafe2021\\/canhbao1.jpg\\\" width=\\\"100%\\\" \\/>\\r\\n\\t\\t\\t<h3>C\\u1ea3nh b&aacute;o ng\\u01b0\\u1eddi ng\\u1ed3i h&agrave;ng gh\\u1ebf sau (ROA)<\\/h3>\\r\\n\\r\\n\\t\\t\\t<p>Thi\\u1ebft b\\u1ecb c\\u1ea3nh b&aacute;o ng\\u01b0\\u1eddi ng\\u1ed3i h&agrave;ng gh\\u1ebf sau ph&aacute;t hi\\u1ec7n chuy\\u1ec3n \\u0111\\u1ed9ng v&agrave; c\\u1ea3nh b&aacute;o ng\\u01b0\\u1eddi l&aacute;i b\\u1eb1ng t&iacute;n hi\\u1ec7u tr&ecirc;n taplo. Trong tr\\u01b0\\u1eddng h\\u1ee3p ng\\u01b0\\u1eddi l&aacute;i ra ngo&agrave;i v&agrave; kh&oacute;a c\\u1eeda xe, thi\\u1ebft b\\u1ecb s\\u1ebd ph&aacute;t t&iacute;n hi\\u1ec7u &acirc;m thanh \\u0111\\u1ec3 c\\u1ea3nh b&aacute;o<\\/p>\\r\\n\\t\\t\\t<\\/td>\\r\\n\\t\\t\\t<td><img alt=\\\"canhbao2\\\" height=\\\"NaN\\\" src=\\\"https:\\/\\/hyundaitaydo.vn\\/images\\/Sampham\\/santafe2021\\/canhbao2.jpg\\\" width=\\\"100%\\\" \\/>\\r\\n\\t\\t\\t<h3>Theo d&otilde;i \\u0111i\\u1ec3m m&ugrave; (BVM)<\\/h3>\\r\\n\\r\\n\\t\\t\\t<p>Khi xi nhan chuy\\u1ec3n h\\u01b0\\u1edbng, h&igrave;nh \\u1ea3nh t\\u1eeb camera s\\u1ebd hi\\u1ec3n th\\u1ecb tr&ecirc;n m&agrave;n h&igrave;nh th&ocirc;ng tin gi&uacute;p cho vi\\u1ec7c chuy\\u1ec3n l&agrave;n tr\\u1edf n&ecirc;n d\\u1ec5 d&agrave;ng v&agrave; an to&agrave;n h\\u01a1n<\\/p>\\r\\n\\t\\t\\t<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t<\\/tbody>\\r\\n<\\/table>\\r\\n\\r\\n<p>&nbsp;<\\/p>\\r\\n\\r\\n<h2>TI\\u1ec6N NGHI<\\/h2>\\r\\n\\r\\n<p><strong>TI\\u1ec6N NGHI V\\u01af\\u1ee2T TR\\u1ed8I TRONG PH&Acirc;N KH&Uacute;C<\\/strong><\\/p>\\r\\n\\r\\n<p>Hi\\u1ec3n th\\u1ecb th&ocirc;ng tin tr&ecirc;n k&iacute;nh l&aacute;i cung c\\u1ea5p th&ocirc;ng tin m\\u1ed9t c&aacute;ch thu\\u1eadn l\\u1ee3i v&agrave; nhanh ch&oacute;ng nh\\u1ea5t. T&iacute;nh n\\u0103ng s\\u1ea1c kh&ocirc;ng d&acirc;y cho ph&eacute;p b\\u1ea1n s\\u1ea1c \\u0111i\\u1ec7n tho\\u1ea1i d\\u1ec5 d&agrave;ng h\\u01a1n bao gi\\u1edd h\\u1ebft, v&agrave; v\\u1edbi ch\\u1ee9c n\\u0103ng s\\u01b0\\u1edbi v&agrave; l&agrave;m m&aacute;t gh\\u1ebf s\\u1ebd gi&uacute;p b\\u1ea1n \\u0111\\u01b0\\u1ee3c th\\u01b0 gi&atilde;n, ti\\u1ec7n nghi trong m\\u1ecdi \\u0111i\\u1ec1u ki\\u1ec7n th\\u1eddi ti\\u1ebft.<\\/p>\\r\\n\\r\\n<p><img alt=\\\"tiennghi1\\\" height=\\\"NaN\\\" src=\\\"https:\\/\\/hyundaitaydo.vn\\/images\\/Sampham\\/santafe2021\\/tiennghi1.jpg\\\" width=\\\"100%\\\" \\/><\\/p>\\r\\n\\r\\n<p>&nbsp;<\\/p>\\r\\n\\r\\n<p><strong>M&Agrave;N H&Igrave;NH TH&Ocirc;NG TIN<\\/strong><\\/p>\\r\\n\\r\\n<p>M&agrave;n h&igrave;nh th&ocirc;ng tin k\\u1ef9 thu\\u1eadt s\\u1ed1 12.3 inch hi\\u1ec7n th\\u1ecb th&ocirc;ng tin quan tr\\u1ecdng cho ng\\u01b0\\u1eddi l&aacute;i: c&aacute;c tr\\u1ea1ng th&aacute;i an to&agrave;n ch\\u1ee7 \\u0111\\u1ed9ng, m\\u1ee9c ti&ecirc;u th\\u1ee5 nhi&ecirc;n li\\u1ec7u, t\\u1ed1c \\u0111\\u1ed9, \\u0111i\\u1ec3m m&ugrave; v&agrave; h\\u01a1n th\\u1ebf n\\u1eefa<\\/p>\\r\\n\\r\\n<p>&nbsp;<\\/p>\\r\\n\\r\\n<table>\\r\\n\\t<tbody>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td><img alt=\\\"hud\\\" height=\\\"NaN\\\" src=\\\"https:\\/\\/hyundaitaydo.vn\\/images\\/Sampham\\/santafe2021\\/hud.jpg\\\" width=\\\"100%\\\" \\/>\\r\\n\\t\\t\\t<p><strong>Hi\\u1ec3n th\\u1ecb th&ocirc;ng tin tr&ecirc;n k&iacute;nh l&aacute;i (HUD)<\\/strong><\\/p>\\r\\n\\r\\n\\t\\t\\t<p>V\\u1edbi kh\\u1ea3 n\\u0103ng hi\\u1ec3n th\\u1ecb tuy\\u1ec7t v\\u1eddi, t&iacute;nh n\\u0103ng HUD h\\u1ed7 tr\\u1ee3 ng\\u01b0\\u1eddi l&aacute;i b\\u1eb1ng vi\\u1ec7c hi\\u1ec3n th\\u1ecb c&aacute;c th&ocirc;ng tin quan tr\\u1ecdng nh\\u01b0 t\\u1ed1c \\u0111\\u1ed9, \\u0111i\\u1ec1u h\\u01b0\\u1edbng v&agrave; c\\u1ea3nh b&aacute;o tr\\u1ef1c ti\\u1ebfp tr&ecirc;n k&iacute;nh ch\\u1eafn gi&oacute;.<\\/p>\\r\\n\\t\\t\\t<\\/td>\\r\\n\\t\\t\\t<td><img alt=\\\"tiennghi2\\\" height=\\\"NaN\\\" src=\\\"https:\\/\\/hyundaitaydo.vn\\/images\\/Sampham\\/santafe2021\\/tiennghi2.jpg\\\" width=\\\"100%\\\" \\/>\\r\\n\\t\\t\\t<p><strong>S\\u1ea1c kh&ocirc;ng d&acirc;y chu\\u1ea9n Qi<\\/strong><\\/p>\\r\\n\\r\\n\\t\\t\\t<p>N\\u1eb1m trong khu v\\u1ef1c b\\u1ea3ng \\u0111i\\u1ec1u khi\\u1ec3n trung t&acirc;m, t&iacute;nh n\\u0103ng s\\u1ea1c kh&ocirc;ng d&acirc;y cho ph&eacute;p b\\u1ea1n s\\u1ea1c \\u0111i\\u1ec7n tho\\u1ea1i th&ocirc;ng minh t\\u01b0\\u01a1ng th&iacute;ch m\\u1ed9t c&aacute;ch d\\u1ec5 d&agrave;ng m&agrave; kh&ocirc;ng c\\u1ea7n s\\u1eed d\\u1ee5ng d&acirc;y c&aacute;p.<\\/p>\\r\\n\\r\\n\\t\\t\\t<p>&nbsp;<\\/p>\\r\\n\\t\\t\\t<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t<\\/tbody>\\r\\n<\\/table>\\r\\n\\r\\n<p>&nbsp;<\\/p>\\r\\n\\r\\n<p>&nbsp;<\\/p>\\r\\n\\r\\n<table>\\r\\n\\t<tbody>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td>\\r\\n\\t\\t\\t<p><img alt=\\\"nubam1\\\" height=\\\"NaN\\\" src=\\\"https:\\/\\/hyundaitaydo.vn\\/images\\/Sampham\\/santafe2021\\/nubam1.jpg\\\" width=\\\"100%\\\" \\/><\\/p>\\r\\n\\r\\n\\t\\t\\t<p><strong>G\\u1eadp b\\u1eb1ng m\\u1ed9t n&uacute;t \\u1ea5n<\\/strong><\\/p>\\r\\n\\r\\n\\t\\t\\t<p>T&iacute;nh n\\u0103ng n&agrave;y cho ph&eacute;p b\\u1ea1n g\\u1eadp h&agrave;ng gh\\u1ebf th\\u1ee9 2 m\\u1ed9t c&aacute;ch d\\u1ec5 d&agrave;ng ch\\u1ec9 b\\u1eb1ng m\\u1ed9t n&uacute;t nh\\u1ea5n.<\\/p>\\r\\n\\r\\n\\t\\t\\t<p>&nbsp;<\\/p>\\r\\n\\t\\t\\t<\\/td>\\r\\n\\t\\t\\t<td>\\r\\n\\t\\t\\t<p><img alt=\\\"9\\\" height=\\\"NaN\\\" src=\\\"https:\\/\\/hyundaitaydo.vn\\/images\\/Sampham\\/santafe2021\\/9.jpg\\\" width=\\\"100%\\\" \\/><\\/p>\\r\\n\\r\\n\\t\\t\\t<p><strong>C\\u1ed1p \\u0111i\\u1ec7n th&ocirc;ng minh<\\/strong><\\/p>\\r\\n\\r\\n\\t\\t\\t<p>T\\u1ea3i h&agrave;nh l&yacute; d\\u1ec5 d&agrave;ng h\\u01a1n v\\u1edbi c\\u1ed1p \\u0111i\\u1ec7n t\\u1ef1 \\u0111\\u1ed9ng m\\u1edf c\\u1ed1p trong 3 gi&acirc;y khi c\\u1ea7m ch&igrave;a kh&oacute;a th&ocirc;ng minh \\u0111\\u1ee9ng g\\u1ea7n c\\u1ed1p.<\\/p>\\r\\n\\r\\n\\t\\t\\t<p>&nbsp;<\\/p>\\r\\n\\t\\t\\t<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t<\\/tbody>\\r\\n<\\/table>\\r\\n\\r\\n<p>&nbsp;<\\/p>\\r\\n\\r\\n<h2>TH&Ocirc;NG S\\u1ed0 HYUNDAI SANTAFE<\\/h2>\\r\\n\\r\\n<figure>\\r\\n<p><a data-elementor-lightbox-slideshow=\\\"a841809\\\" data-elementor-lightbox-title=\\\"santafe21\\\" data-elementor-open-lightbox=\\\"yes\\\" href=\\\"https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2018\\/03\\/santafe21.jpg\\\"><img alt=\\\"\\\" height=\\\"1074\\\" loading=\\\"lazy\\\" sizes=\\\"(max-width: 1520px) 100vw, 1520px\\\" src=\\\"https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2018\\/03\\/santafe21.jpg\\\" srcset=\\\"https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2018\\/03\\/santafe21.jpg 1520w, https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2018\\/03\\/santafe21-300x212.jpg 300w, https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2018\\/03\\/santafe21-1024x723.jpg 1024w, https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2018\\/03\\/santafe21-768x543.jpg 768w, https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2018\\/03\\/santafe21-1536x1085.jpg 1536w, https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2018\\/03\\/santafe21-2048x1447.jpg 2048w\\\" width=\\\"1520\\\" \\/><\\/a><\\/p>\\r\\n<\\/figure>\"}]', NULL, '{\"main\":\"\\/storage\\/hyundai\\/santafe\\/santafe-icon.png\"}', 1, 1, 1, '[\"1\",\"4\",\"5\"]', '{\"4\":{\"12\":\"4-mau-sac-trang\",\"13\":\"4-mau-sac-den\",\"14\":\"4-mau-sac-do\",\"15\":\"4-mau-sac-bac\",\"16\":\"4-mau-sac-vang-cat\",\"20\":\"4-mau-sac-xanh-dai-duong\"},\"24\":{\"31\":\"24-phien-ban-santafe-xang-24-thuong\",\"32\":\"24-phien-ban-santafe-xang-24-premium\",\"33\":\"24-phien-ban-santafe-dau-22-thuong\",\"34\":\"24-phien-ban-santafe-dau-22-premium\"}}', NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, '2023-11-09 05:53:01', '2023-11-16 08:51:35', 0, 12);
INSERT INTO `products` (`id`, `name`, `slug`, `sku`, `description`, `content`, `promotion`, `images`, `status`, `has_variant`, `product_category_id`, `product_category_ids`, `attribute_ids`, `meta_title`, `meta_description`, `meta_keyword`, `canonical`, `seo_preview`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`, `featured`, `flash_sale_quantity`) VALUES
(3, 'Toyota Vios', 'toyota-vios', 'To-vio-2023', '', '[{\"label\":\"N\\u1ed9i dung\",\"label_hidden\":\"N\\u1ed9i dung\",\"url\":\"noi-dung\",\"content\":\"<h2>NGO\\u1ea0I TH\\u1ea4T<\\/h2>\\r\\n\\r\\n<p>C&aacute;c t&iacute;nh n\\u0103ng c&oacute; th\\u1ec3 kh&aacute;c nhau gi\\u1eefa c&aacute;c phi&ecirc;n b\\u1ea3n<\\/p>\\r\\n\\r\\n<p><img alt=\\\"C\\u1ee5m \\u0111\\u00e8n sau\\\" data-src=\\\"https:\\/\\/ssa-api.toyotavn.com.vn\\/Resources\\/Images\\/C980784B2E2204094EFC29D27F4346E6.png\\\" src=\\\"https:\\/\\/ssa-api.toyotavn.com.vn\\/Resources\\/Images\\/C980784B2E2204094EFC29D27F4346E6.png\\\" \\/><\\/p>\\r\\n\\r\\n<h3>C\\u1ee5m \\u0111&egrave;n sau<\\/h3>\\r\\n\\r\\n<p>C&ocirc;ng ngh\\u1ec7 LED c&ugrave;ng d\\u1ea3i \\u0111&egrave;n \\u0111\\u1ecbnh v\\u1ecb v\\u1edbi thi\\u1ebft k\\u1ebf s\\u1eafc n&eacute;t mang l\\u1ea1i c\\u1ea3m gi&aacute;c th\\u1ec3 thao nh\\u01b0ng kh&ocirc;ng k&eacute;m ph\\u1ea7n l\\u1ecbch l&atilde;m.<img alt=\\\"C\\u1ee5m \\u0111\\u00e8n tr\\u01b0\\u1edbc\\\" data-src=\\\"https:\\/\\/ssa-api.toyotavn.com.vn\\/Resources\\/Images\\/E28EDD98E6ED09FB6FDBEFD5AD3F3171.png\\\" src=\\\"https:\\/\\/ssa-api.toyotavn.com.vn\\/Resources\\/Images\\/E28EDD98E6ED09FB6FDBEFD5AD3F3171.png\\\" \\/><\\/p>\\r\\n\\r\\n<h3>C\\u1ee5m \\u0111&egrave;n tr\\u01b0\\u1edbc<\\/h3>\\r\\n\\r\\n<p>C&ocirc;ng ngh\\u1ec7 LED d\\u1ea1ng b&oacute;ng chi\\u1ebfu v\\u1edbi thi\\u1ebft k\\u1ebf b\\u1eaft m\\u1eaft cho kh\\u1ea3 n\\u0103ng chi\\u1ebfu s&aacute;ng tuy\\u1ec7t v\\u1eddi v&agrave; gi\\u1ea3m ti&ecirc;u th\\u1ee5 n\\u0103ng l\\u01b0\\u1ee3ng.<img alt=\\\"\\u0110\\u1ea7u xe\\\" data-src=\\\"https:\\/\\/ssa-api.toyotavn.com.vn\\/Resources\\/Images\\/EA8A4E51986F9C9FF23EB1A61DF3ACBD.png\\\" src=\\\"https:\\/\\/ssa-api.toyotavn.com.vn\\/Resources\\/Images\\/EA8A4E51986F9C9FF23EB1A61DF3ACBD.png\\\" \\/><\\/p>\\r\\n\\r\\n<h3>\\u0110\\u1ea7u xe<\\/h3>\\r\\n\\r\\n<p>Thi\\u1ebft k\\u1ebf g&oacute;c c\\u1ea1nh, ph&iacute;a tr&ecirc;n \\u0111\\u1ea7u xe v&agrave; hai c\\u1ea1nh b&ecirc;n l\\u1ed3ng v&agrave;o nhau t\\u1ea1o hi\\u1ec7u \\u1ee9ng 3D m\\u1ea1nh m\\u1ebd g&oacute;p ph\\u1ea7n l&agrave;m n&ecirc;n t\\u1ed5ng th\\u1ec3 h&agrave;i h&ograve;a.<img alt=\\\"Th\\u00e2n xe\\\" data-src=\\\"https:\\/\\/ssa-api.toyotavn.com.vn\\/Resources\\/Images\\/ABBBB0E19652E686AFC6027B4903ADB0.png\\\" src=\\\"https:\\/\\/ssa-api.toyotavn.com.vn\\/Resources\\/Images\\/ABBBB0E19652E686AFC6027B4903ADB0.png\\\" \\/><\\/p>\\r\\n\\r\\n<h3>Th&acirc;n xe<\\/h3>\\r\\n\\r\\n<p>Nh\\u1eefng \\u0111\\u01b0\\u1eddng d\\u1eadp n\\u1ed5i ch\\u1ea1y d\\u1ecdc th&acirc;n xe t\\u1ea1o c\\u1ea3m gi&aacute;c kh\\u1ecfe kho\\u1eafn, k\\u1ebft n\\u1ed1i t\\u1ed5ng th\\u1ec3 ho&agrave;n ch\\u1ec9nh gi\\u1eefa ph\\u1ea7n \\u0111\\u1ea7u xe v&agrave; c&aacute;c chi ti\\u1ebft \\u1edf \\u0111u&ocirc;i xe<img alt=\\\"V\\u00e0nh &amp; l\\u1ed1p xe\\\" data-src=\\\"https:\\/\\/ssa-api.toyotavn.com.vn\\/Resources\\/Images\\/99E9E33E4AF8055A575FA046CA81F25D.png\\\" src=\\\"https:\\/\\/ssa-api.toyotavn.com.vn\\/Resources\\/Images\\/99E9E33E4AF8055A575FA046CA81F25D.png\\\" \\/><\\/p>\\r\\n\\r\\n<h3>V&agrave;nh &amp; l\\u1ed1p xe<\\/h3>\\r\\n\\r\\n<p>M&acirc;m xe h\\u1ee3p kim 15&rsquo;&rsquo; thi\\u1ebft k\\u1ebf kh\\u1ecfe kho\\u1eafn c&ugrave;ng \\u0111\\u01b0\\u1eddng g&acirc;n d\\u1eadp n\\u1ed5i theo khung b&aacute;nh xe v\\u1eeba thanh l\\u1ecbch v\\u1eeba tr\\u1ebb trung.<img alt=\\\"\\u0110u\\u00f4i xe\\\" data-src=\\\"https:\\/\\/ssa-api.toyotavn.com.vn\\/Resources\\/Images\\/491BE84EE70AE66193A0CFE5687D1394.png\\\" src=\\\"https:\\/\\/ssa-api.toyotavn.com.vn\\/Resources\\/Images\\/491BE84EE70AE66193A0CFE5687D1394.png\\\" \\/><\\/p>\\r\\n\\r\\n<h3>\\u0110u&ocirc;i xe<\\/h3>\\r\\n\\r\\n<p>Thi\\u1ebft k\\u1ebf d\\u1eadp n\\u1ed5i \\u1edf hai b&ecirc;n c\\u1ea3n sau, k\\u1ebft h\\u1ee3p v\\u1edbi c\\u1ea3n d\\u01b0\\u1edbi c&ugrave;ng m&agrave;u s\\u1eafc c&aacute;ch \\u0111i\\u1ec7u t\\u1ea1o c\\u1ea3m gi&aacute;c kh\\u1ecfe kho\\u1eafn v&agrave; v\\u1eefng ch&atilde;i<\\/p>\\r\\n\\r\\n<h2>N\\u1ed8I TH\\u1ea4T<\\/h2>\\r\\n\\r\\n<p>C&aacute;c t&iacute;nh n\\u0103ng c&oacute; th\\u1ec3 kh&aacute;c nhau gi\\u1eefa c&aacute;c phi&ecirc;n b\\u1ea3n<\\/p>\\r\\n\\r\\n<p><img alt=\\\"Khoang l\\u00e1i\\\" data-src=\\\"https:\\/\\/ssa-api.toyotavn.com.vn\\/Resources\\/Images\\/A7DD9C397C832BFA5B7176971E01B547.png\\\" src=\\\"https:\\/\\/ssa-api.toyotavn.com.vn\\/Resources\\/Images\\/A7DD9C397C832BFA5B7176971E01B547.png\\\" \\/><\\/p>\\r\\n\\r\\n<h3>Khoang l&aacute;i<\\/h3>\\r\\n\\r\\n<p>N\\u1ed9i th\\u1ea5t m&agrave;u \\u0111en k\\u1ebft h\\u1ee3p c&ugrave;ng chi ti\\u1ebft \\u1ed1p cr&ocirc;m l&aacute;ng m\\u1ecbn \\u0111i\\u1ec3m xuy\\u1ebft trong khoang l&aacute;i mang l\\u1ea1i c\\u1ea3m gi&aacute;c th\\u1ec3 thao v&agrave; sang tr\\u1ecdng.<img alt=\\\"Tay l\\u00e1i\\\" data-src=\\\"https:\\/\\/ssa-api.toyotavn.com.vn\\/Resources\\/Images\\/EC60DB5AAB64F0A039C21801F26FB71E.png\\\" src=\\\"https:\\/\\/ssa-api.toyotavn.com.vn\\/Resources\\/Images\\/EC60DB5AAB64F0A039C21801F26FB71E.png\\\" \\/><\\/p>\\r\\n\\r\\n<h3>Tay l&aacute;i<\\/h3>\\r\\n\\r\\n<p>Tay l&aacute;i ba ch\\u1ea5u b\\u1ecdc da sang tr\\u1ecdng t&iacute;ch h\\u1ee3p c&aacute;c n&uacute;t \\u0111i\\u1ec1u khi\\u1ec3n h\\u1ed7 tr\\u1ee3 ng\\u01b0\\u1eddi l&aacute;i mang \\u0111\\u1ebfn s\\u1ef1 thu\\u1eadn ti\\u1ec7n cho ch\\u1ee7 s\\u1edf h\\u1eefu khi v\\u1eadn h&agrave;nh xe.<img alt=\\\"H\\u00e0ng gh\\u1ebf tr\\u01b0\\u1edbc\\\" data-src=\\\"https:\\/\\/ssa-api.toyotavn.com.vn\\/Resources\\/Images\\/0EFE25651B9BC9E89C6A6A58E07213C4.png\\\" src=\\\"https:\\/\\/ssa-api.toyotavn.com.vn\\/Resources\\/Images\\/0EFE25651B9BC9E89C6A6A58E07213C4.png\\\" \\/><\\/p>\\r\\n\\r\\n<h3>H&agrave;ng gh\\u1ebf tr\\u01b0\\u1edbc<\\/h3>\\r\\n\\r\\n<p>Ki\\u1ec3u d&aacute;ng thi\\u1ebft k\\u1ebf th\\u1ec3 thao v\\u1edbi h\\u1ecda ti\\u1ebft c&aacute;ch \\u0111i\\u1ec7u tr\\u1ebb trung c&ugrave;ng ch\\u1ea5t li\\u1ec7u da \\u0111\\u1ee5c l\\u1ed7 tho&aacute;ng kh&iacute; mang l\\u1ea1i s\\u1ef1 &ecirc;m &aacute;i, tho\\u1ea3i m&aacute;i cho chuy\\u1ebfn \\u0111i.<img alt=\\\"T\\u1ef1a tay h\\u00e0ng gh\\u1ebf sau\\\" data-src=\\\"https:\\/\\/ssa-api.toyotavn.com.vn\\/Resources\\/Images\\/1E85E3EB3F719EB2B851A64ED66B7BBE.png\\\" src=\\\"https:\\/\\/ssa-api.toyotavn.com.vn\\/Resources\\/Images\\/1E85E3EB3F719EB2B851A64ED66B7BBE.png\\\" \\/><\\/p>\\r\\n\\r\\n<h3>T\\u1ef1a tay h&agrave;ng gh\\u1ebf sau<\\/h3>\\r\\n\\r\\n<p>B\\u1ed1 tr&iacute; t\\u1ef1a tay \\u1edf h&agrave;ng gh\\u1ebf sau k&egrave;m khay \\u0111\\u1ef1ng c\\u1ed1c mang l\\u1ea1i s\\u1ef1 tho\\u1ea3i m&aacute;i, ti\\u1ec7n nghi cho h&agrave;nh kh&aacute;ch trong su\\u1ed1t chuy\\u1ebfn \\u0111i.<img alt=\\\"H\\u1ec7 th\\u1ed1ng \\u0111i\\u1ec1u h\\u00f2a\\\" data-src=\\\"https:\\/\\/ssa-api.toyotavn.com.vn\\/Resources\\/Images\\/98527D901BBE24ACB27842888C9B80F1.png\\\" src=\\\"https:\\/\\/ssa-api.toyotavn.com.vn\\/Resources\\/Images\\/98527D901BBE24ACB27842888C9B80F1.png\\\" \\/><\\/p>\\r\\n\\r\\n<h3>H\\u1ec7 th\\u1ed1ng \\u0111i\\u1ec1u h&ograve;a<\\/h3>\\r\\n\\r\\n<p>\\u0110i\\u1ec1u h&ograve;a t\\u1ef1 \\u0111\\u1ed9ng v\\u1edbi kh\\u1ea3 n\\u0103ng l&agrave;m l\\u1ea1nh nhanh v&agrave; m&aacute;t s&acirc;u mang l\\u1ea1i c\\u1ea3m gi&aacute;c d\\u1ec5 ch\\u1ecbu cho h&agrave;nh h&aacute;ch \\u1edf m\\u1ecdi v\\u1ecb tr&iacute;.<img alt=\\\"M\\u00e0n h\\u00ecnh gi\\u1ea3i tr\\u00ed \\u0111a ph\\u01b0\\u01a1ng ti\\u1ec7n\\\" data-src=\\\"https:\\/\\/ssa-api.toyotavn.com.vn\\/Resources\\/Images\\/741E55A43E84AD89C69E4ABF034088E1.png\\\" src=\\\"https:\\/\\/ssa-api.toyotavn.com.vn\\/Resources\\/Images\\/741E55A43E84AD89C69E4ABF034088E1.png\\\" \\/><\\/p>\\r\\n\\r\\n<h3>M&agrave;n h&igrave;nh gi\\u1ea3i tr&iacute; \\u0111a ph\\u01b0\\u01a1ng ti\\u1ec7n<\\/h3>\\r\\n\\r\\n<p>M&agrave;n h&igrave;nh c\\u1ea3m \\u1ee9ng \\u0111\\u01b0\\u1ee3c thi\\u1ebft k\\u1ebf n\\u1ed5i theo xu h\\u01b0\\u1edbng hi\\u1ec7n \\u0111\\u1ea1i, k\\u1ebft n\\u1ed1i \\u0111i\\u1ec7n tho\\u1ea1i th&ocirc;ng minh mang l\\u1ea1i s\\u1ef1 thu\\u1eadn ti\\u1ec7n v&agrave; tr\\u1ea3i nghi\\u1ec7m th&uacute; v\\u1ecb cho ng\\u01b0\\u1eddi s\\u1eed d\\u1ee5ng.<img alt=\\\"H\\u1ec7 th\\u1ed1ng \\u00e2m thanh\\\" data-src=\\\"https:\\/\\/ssa-api.toyotavn.com.vn\\/Resources\\/Images\\/0871F7E9E1BB172E312D36B0F6EBC108.png\\\" src=\\\"https:\\/\\/ssa-api.toyotavn.com.vn\\/Resources\\/Images\\/0871F7E9E1BB172E312D36B0F6EBC108.png\\\" \\/><\\/p>\\r\\n\\r\\n<h3>H\\u1ec7 th\\u1ed1ng &acirc;m thanh<\\/h3>\\r\\n\\r\\n<p>H\\u1ec7 th\\u1ed1ng s&aacute;u loa \\u0111\\u01b0\\u1ee3c b\\u1ed1 tr&iacute; th&ocirc;ng minh trong kh&ocirc;ng gian xe mang \\u0111\\u1ebfn tr\\u1ea3i nghi\\u1ec7m &acirc;m thanh s\\u1ed1ng \\u0111\\u1ed9ng.<img alt=\\\"H\\u00e0ng gh\\u1ebf sau\\\" data-src=\\\"https:\\/\\/ssa-api.toyotavn.com.vn\\/Resources\\/Images\\/E4A19DF98B05A49CF9920569215271DA.png\\\" src=\\\"https:\\/\\/ssa-api.toyotavn.com.vn\\/Resources\\/Images\\/E4A19DF98B05A49CF9920569215271DA.png\\\" \\/><\\/p>\\r\\n\\r\\n<h3>H&agrave;ng gh\\u1ebf sau<\\/h3>\\r\\n\\r\\n<p>Kh\\u1ea3 n\\u0103ng g\\u1eadp 60:40 linh ho\\u1ea1t t\\u1ea1o kh&ocirc;ng gian ch\\u1ee9a \\u0111\\u1ed3 r\\u1ed9ng r&atilde;i khi c\\u1ea7n thi\\u1ebft.<img alt=\\\"N\\u00fat kh\\u1edfi \\u0111\\u1ed9ng\\\" data-src=\\\"https:\\/\\/ssa-api.toyotavn.com.vn\\/Resources\\/Images\\/0A58F742ED5DE28496C08460C7C589D6.png\\\" src=\\\"https:\\/\\/ssa-api.toyotavn.com.vn\\/Resources\\/Images\\/0A58F742ED5DE28496C08460C7C589D6.png\\\" \\/><\\/p>\\r\\n\\r\\n<h3>N&uacute;t kh\\u1edfi \\u0111\\u1ed9ng<\\/h3>\\r\\n\\r\\n<p>Ch\\u1ee9c n\\u0103ng m\\u1edf khoa v&agrave; kh\\u1edfi \\u0111\\u1ed9ng th&ocirc;ng minh t\\u1ea1o s\\u1ef1 thu\\u1eadn l\\u1ee3i t\\u1ed1i \\u0111a cho ng\\u01b0\\u1eddi s\\u1eed d\\u1ee5ng khi v\\u1eadn h&agrave;nh xe.<img alt=\\\"M\\u00e0n h\\u00ecnh hi\\u1ec3n th\\u1ecb \\u0111a th\\u00f4ng tin\\\" data-src=\\\"https:\\/\\/ssa-api.toyotavn.com.vn\\/Resources\\/Images\\/357D7458830324F074F2D9D10F7559C7.png\\\" src=\\\"https:\\/\\/ssa-api.toyotavn.com.vn\\/Resources\\/Images\\/357D7458830324F074F2D9D10F7559C7.png\\\" \\/><\\/p>\\r\\n\\r\\n<h3>M&agrave;n h&igrave;nh hi\\u1ec3n th\\u1ecb \\u0111a th&ocirc;ng tin<\\/h3>\\r\\n\\r\\n<p>M&agrave;n h&igrave;nh optitron t\\u1ef1 ph&aacute;t s&aacute;ng t\\u0103ng kh\\u1ea3 n\\u0103ng hi\\u1ec3n th\\u1ecb c&aacute;c th&ocirc;ng s\\u1ed1, h\\u1ed7 tr\\u1ee3 ng\\u01b0\\u1eddi l&aacute;i v&agrave; mang l\\u1ea1i tr\\u1ea3i nghi\\u1ec7m v\\u1eadn h&agrave;nh tuy\\u1ec7t v\\u1eddi.<img alt=\\\"H\\u1ec7 th\\u1ed1ng s\\u1ea1c\\\" data-src=\\\"https:\\/\\/ssa-api.toyotavn.com.vn\\/Resources\\/Images\\/496AB08649A2A876B5D6EC91D97B9B37.png\\\" src=\\\"https:\\/\\/ssa-api.toyotavn.com.vn\\/Resources\\/Images\\/496AB08649A2A876B5D6EC91D97B9B37.png\\\" \\/><\\/p>\\r\\n\\r\\n<h3>H\\u1ec7 th\\u1ed1ng s\\u1ea1c<\\/h3>\\r\\n\\r\\n<p>B\\u1ed1 tr&iacute; c\\u1ed5ng s\\u1ea1c \\u1edf c&aacute;c v\\u1ecb tr&iacute; thu\\u1eadn ti\\u1ec7n cho m\\u1ecdi h&agrave;nh kh&aacute;ch bao g\\u1ed3m c\\u1ea3 hai c\\u1ed5ng s\\u1ea1c USB \\u1edf h&agrave;ng gh\\u1ebf sau.<\\/p>\\r\\n\\r\\n<h2>V\\u1eacN H&Agrave;NH<\\/h2>\\r\\n\\r\\n<p><img alt=\\\"V\\u1eadn h\\u00e0nh \\u00eam \\u00e1i, tho\\u1ea3i m\\u00e1i\\\" data-src=\\\"https:\\/\\/ssa-api.toyotavn.com.vn\\/Resources\\/Images\\/66D7875D2557C536086BA0AB38C55E30.png\\\" src=\\\"https:\\/\\/ssa-api.toyotavn.com.vn\\/Resources\\/Images\\/66D7875D2557C536086BA0AB38C55E30.png\\\" \\/><\\/p>\\r\\n\\r\\n<h3>V\\u1eadn h&agrave;nh &ecirc;m &aacute;i, tho\\u1ea3i m&aacute;i<\\/h3>\\r\\n\\r\\n<p>V\\u1eadn h&agrave;nh &ecirc;m &aacute;i \\u0111\\u01b0a b\\u1ea1n chinh ph\\u1ee5c nh\\u1eefng m\\u1ee5c ti&ecirc;u xa h\\u01a1n.<img alt=\\\"L\\u1eaby chuy\\u1ec3n s\\u1ed1\\\" data-src=\\\"https:\\/\\/ssa-api.toyotavn.com.vn\\/Resources\\/Images\\/1A717B0B420AB558D4B304C65DF3D49F.png\\\" src=\\\"https:\\/\\/ssa-api.toyotavn.com.vn\\/Resources\\/Images\\/1A717B0B420AB558D4B304C65DF3D49F.png\\\" \\/><\\/p>\\r\\n\\r\\n<h3>L\\u1eaby chuy\\u1ec3n s\\u1ed1<\\/h3>\\r\\n\\r\\n<p>T\\u0103ng gi\\u1ea3m s\\u1ed1 b\\u1eb1ng vi\\u1ec7c \\u0111i\\u1ec1u khi\\u1ec3n l\\u1eaby chuy\\u1ec3n s\\u1ed1 khi \\u0111i s\\u1ed1 M t\\u1ea1o c\\u1ea3m gi&aacute;c l&aacute;i th\\u1ec3 thao m&agrave; ch\\u1ec9 c&oacute; tr&ecirc;n c&aacute;c xe \\u0111ua hi\\u1ec7n \\u0111\\u1ea1i.<img alt=\\\"H\\u1ec7 th\\u1ed1ng ki\\u1ec3m so\\u00e1t h\\u00e0nh h\\u00ecnh\\\" data-src=\\\"https:\\/\\/ssa-api.toyotavn.com.vn\\/Resources\\/Images\\/6F0F9DB7C06F9463429DC4E491C5024D.png\\\" src=\\\"https:\\/\\/ssa-api.toyotavn.com.vn\\/Resources\\/Images\\/6F0F9DB7C06F9463429DC4E491C5024D.png\\\" \\/><\\/p>\\r\\n\\r\\n<h3>H\\u1ec7 th\\u1ed1ng ki\\u1ec3m so&aacute;t h&agrave;nh h&igrave;nh<\\/h3>\\r\\n\\r\\n<p>H\\u1ed7 tr\\u1ee3 ki\\u1ec3m so&aacute;t t\\u1ed1c \\u0111\\u1ed9 khi ng\\u01b0\\u1eddi \\u0111i\\u1ec1u khi\\u1ec3n xe kh&ocirc;ng c\\u1ea7n t&aacute;c \\u0111\\u1ed9ng v&agrave;o ch&acirc;n ga, gi&uacute;p ch\\u1ee7 s\\u1edf h\\u1eefu tho\\u1ea3i m&aacute;i khi c\\u1ea7m l&aacute;i \\u0111\\u1ed3ng th\\u1eddi ti\\u1ebft ki\\u1ec7m nhi&ecirc;n li\\u1ec7u cho xe, h\\u01a1n n\\u1eefa c&ograve;n h\\u1ed7 tr\\u1ee3 \\u0111i\\u1ec1u khi\\u1ec3n xe an to&agrave;n.<img alt=\\\"H\\u1ed9p s\\u1ed1 \\\" data-src=\\\"https:\\/\\/ssa-api.toyotavn.com.vn\\/Resources\\/Images\\/C3DD79C96951B69AD6CC3355421CD090.png\\\" src=\\\"https:\\/\\/ssa-api.toyotavn.com.vn\\/Resources\\/Images\\/C3DD79C96951B69AD6CC3355421CD090.png\\\" \\/><\\/p>\\r\\n\\r\\n<h3>H\\u1ed9p s\\u1ed1<\\/h3>\\r\\n\\r\\n<p>H\\u1ed9p s\\u1ed1 t\\u1ef1 \\u0111\\u1ed9ng v&ocirc; c\\u1ea5p CVT mang l\\u1ea1i tr\\u1ea3i nghi\\u1ec7m l&aacute;i m\\u01b0\\u1ee3t m&agrave;, ti\\u1ebft ki\\u1ec7m nhi&ecirc;n li\\u1ec7u.<img alt=\\\"\\u0110\\u1ed9ng c\\u01a1 Dual VVT-I\\\" data-src=\\\"https:\\/\\/ssa-api.toyotavn.com.vn\\/Resources\\/Images\\/BAB188B7DC0769A707ED8ED5233910E6.png\\\" src=\\\"https:\\/\\/ssa-api.toyotavn.com.vn\\/Resources\\/Images\\/BAB188B7DC0769A707ED8ED5233910E6.png\\\" \\/><\\/p>\\r\\n\\r\\n<h3>\\u0110\\u1ed9ng c\\u01a1 Dual VVT-I<\\/h3>\\r\\n\\r\\n<p>\\u0110\\u1ed9ng c\\u01a1 2NR-FE k\\u1ebft h\\u1ee3p v\\u1edbi h\\u1ec7 th\\u1ed1ng VVT-I 4 xy lanh th\\u1eb3ng h&agrave;ng dung t&iacute;ch 1.5 l&iacute;t, \\u0111\\u1ea1t ti&ecirc;u chu\\u1ea9n kh&iacute; th\\u1ea3i Euro 5 v\\u1eeba n&acirc;ng cao hi\\u1ec7u su\\u1ea5t v\\u1eadn h&agrave;nh v\\u1eeba gi\\u1ea3m m\\u1ee9c ti&ecirc;u th\\u1ee5 nhi&ecirc;n li\\u1ec7u<\\/p>\\r\\n\\r\\n<h2>AN TO&Agrave;N<\\/h2>\\r\\n\\r\\n<p><img alt=\\\"H\\u1ec7 th\\u1ed1ng c\\u1ea3nh b\\u00e1o l\\u1ec7ch l\\u00e0n \\u0111\\u01b0\\u1eddng (LDA)\\\" data-src=\\\"https:\\/\\/ssa-api.toyotavn.com.vn\\/Resources\\/Images\\/248F97187034E3F5A7B956F3D7EEC915.png\\\" src=\\\"https:\\/\\/ssa-api.toyotavn.com.vn\\/Resources\\/Images\\/248F97187034E3F5A7B956F3D7EEC915.png\\\" \\/><\\/p>\\r\\n\\r\\n<h3>H\\u1ec7 th\\u1ed1ng c\\u1ea3nh b&aacute;o l\\u1ec7ch l&agrave;n \\u0111\\u01b0\\u1eddng (LDA)<\\/h3>\\r\\n\\r\\n<p>L&agrave; h\\u1ec7 th\\u1ed1ng c\\u1ea3nh b&aacute;o ng\\u01b0\\u1eddi l&aacute;i b\\u1eb1ng chu&ocirc;ng b&aacute;o v&agrave; \\u0111&egrave;n c\\u1ea3nh b&aacute;o khi xe l\\u1ec7ch l&agrave;n \\u0111\\u01b0\\u1eddng m&agrave; kh&ocirc;ng c&oacute; t&iacute;n hi\\u1ec7u r\\u1ebd c\\u1ee7a ng\\u01b0\\u1eddi l&aacute;i.<img alt=\\\"H\\u1ec7 th\\u1ed1ng c\\u1ea3nh b\\u00e1o ti\\u1ec1n va ch\\u1ea1m (PCS)\\\" data-src=\\\"https:\\/\\/ssa-api.toyotavn.com.vn\\/Resources\\/Images\\/395913092585893F876CC3CAF76266F4.png\\\" src=\\\"https:\\/\\/ssa-api.toyotavn.com.vn\\/Resources\\/Images\\/395913092585893F876CC3CAF76266F4.png\\\" \\/><\\/p>\\r\\n\\r\\n<h3>H\\u1ec7 th\\u1ed1ng c\\u1ea3nh b&aacute;o ti\\u1ec1n va ch\\u1ea1m (PCS)<\\/h3>\\r\\n\\r\\n<p>L&agrave; h\\u1ec7 th\\u1ed1ng an to&agrave;n ch\\u1ee7 \\u0111\\u1ed9ng khi ph&aacute;t hi\\u1ec7n va ch\\u1ea1m c&oacute; th\\u1ec3 x\\u1ea3y ra v\\u1edbi ph\\u01b0\\u01a1ng ti\\u1ec7n ph&iacute;a tr\\u01b0\\u1edbc, h\\u1ec7 th\\u1ed1ng s\\u1ebd c\\u1ea3nh b&aacute;o ng\\u01b0\\u1eddi l&aacute;i, \\u0111\\u1ed3ng th\\u1eddi k&iacute;ch ho\\u1ea1t phanh h\\u1ed7 tr\\u1ee3 khi ng\\u01b0\\u1eddi l&aacute;i \\u0111\\u1ea1p phanh ho\\u1eb7c t\\u1ef1 \\u0111\\u1ed9ng phanh khi ng\\u01b0\\u1eddi l&aacute;i kh&ocirc;ng \\u0111\\u1ea1p phanh.<img alt=\\\"Camera h\\u1ed7 tr\\u1ee3 \\u0111\\u1ed7 xe\\\" data-src=\\\"https:\\/\\/ssa-api.toyotavn.com.vn\\/Resources\\/Images\\/003E54D4DADAC216BC4E552C883D64F2.png\\\" src=\\\"https:\\/\\/ssa-api.toyotavn.com.vn\\/Resources\\/Images\\/003E54D4DADAC216BC4E552C883D64F2.png\\\" \\/><\\/p>\\r\\n\\r\\n<h3>Camera h\\u1ed7 tr\\u1ee3 \\u0111\\u1ed7 xe<\\/h3>\\r\\n\\r\\n<p>H\\u1ed7 tr\\u1ee3 ng\\u01b0\\u1eddi l&aacute;i quan s&aacute;t v&agrave; tr&aacute;nh \\u0111\\u01b0\\u1ee3c v\\u1eadt c\\u1ea3n \\u1edf \\u0111i\\u1ec3m m&ugrave; ph&iacute;a sau xe \\u0111\\u1ea3m b\\u1ea3o s\\u1ef1 an to&agrave;n t\\u1ed1i \\u0111a tr&ecirc;n m\\u1ecdi h&agrave;nh tr&igrave;nh.<img alt=\\\"C\\u1ea3m bi\\u1ebfn\\\" data-src=\\\"https:\\/\\/ssa-api.toyotavn.com.vn\\/Resources\\/Images\\/CF4CF6458A60B42A731A8D1B26A79951.png\\\" src=\\\"https:\\/\\/ssa-api.toyotavn.com.vn\\/Resources\\/Images\\/CF4CF6458A60B42A731A8D1B26A79951.png\\\" \\/><\\/p>\\r\\n\\r\\n<h3>C\\u1ea3m bi\\u1ebfn<\\/h3>\\r\\n\\r\\n<p>C\\u1ea3m bi\\u1ebfn g&oacute;c tr\\u01b0\\u1edbc\\/sau (m\\u1ed7i lo\\u1ea1i 2 c&aacute;i) v&agrave; 2 c\\u1ea3m bi\\u1ebfn sau mang \\u0111\\u1ebfn s\\u1ef1 an t&acirc;m khi v\\u1eadn h&agrave;nh. Kh&aacute;ch h&agrave;ng ho&agrave;n to&agrave;n y&ecirc;n t&acirc;m khi v\\u1eadn h&agrave;nh d&ugrave; trong kh&ocirc;ng gian nhi\\u1ec1u ch\\u01b0\\u1edbng ng\\u1ea1i v\\u1eadt.<img alt=\\\"H\\u1ec7 th\\u1ed1ng \\u0111\\u00e8n b\\u00e1o phanh kh\\u1ea9n c\\u1ea5p (EBS)\\\" data-src=\\\"https:\\/\\/ssa-api.toyotavn.com.vn\\/Resources\\/Images\\/230B05082DDFE0E5906DE53D780A07AF.png\\\" src=\\\"https:\\/\\/ssa-api.toyotavn.com.vn\\/Resources\\/Images\\/230B05082DDFE0E5906DE53D780A07AF.png\\\" \\/><\\/p>\\r\\n\\r\\n<h3>H\\u1ec7 th\\u1ed1ng \\u0111&egrave;n b&aacute;o phanh kh\\u1ea9n c\\u1ea5p (EBS)<\\/h3>\\r\\n\\r\\n<p>T\\u1ef1 \\u0111\\u1ed9ng k&iacute;ch ho\\u1ea1t \\u0111&egrave;n c\\u1ea3nh b&aacute;o xe ph&iacute;a sau khi phanh kh\\u1ea9n c\\u1ea5p \\u0111\\u1ea3m b\\u1ea3o an to&agrave;n cho m\\u1ecdi h&agrave;nh tr&igrave;nh.<img alt=\\\"T\\u00fai kh\\u00ed\\\" data-src=\\\"https:\\/\\/ssa-api.toyotavn.com.vn\\/Resources\\/Images\\/E640FBE63E49C47C438DE70DBE15FC8B.png\\\" src=\\\"https:\\/\\/ssa-api.toyotavn.com.vn\\/Resources\\/Images\\/E640FBE63E49C47C438DE70DBE15FC8B.png\\\" \\/><\\/p>\\r\\n\\r\\n<h3>T&uacute;i kh&iacute;<\\/h3>\\r\\n\\r\\n<p>Trang b\\u1ecb l&ecirc;n t\\u1edbi 7 t&uacute;i kh&iacute;: T&uacute;i kh&iacute; ng\\u01b0\\u1eddi l&aacute;i v&agrave; h&agrave;nh kh&aacute;ch ph&iacute;a tr\\u01b0\\u1edbc, t&uacute;i kh&iacute; b\\u1ea3o v\\u1ec7 \\u0111\\u1ea7u g\\u1ed1i ng\\u01b0\\u1eddi l&aacute;i, t&uacute;i kh&iacute; b&ecirc;n h&ocirc;ng ph&iacute;a tr\\u01b0\\u1edbc, t&uacute;i kh&iacute; r&egrave;m b\\u1ea3o v\\u1ec7 t\\u1ed1i \\u0111a cho ng\\u01b0\\u1eddi l&aacute;i v&agrave; h&agrave;nh kh&aacute;ch tr&ecirc;n m\\u1ed7i cung \\u0111\\u01b0\\u1eddng.<img alt=\\\"H\\u1ec7 th\\u1ed1ng h\\u1ed7 tr\\u1ee3 kh\\u1edfi h\\u00e0nh ngang d\\u1ed1c (HAC)\\\" data-src=\\\"https:\\/\\/ssa-api.toyotavn.com.vn\\/Resources\\/Images\\/52137A460B94DC921EE1F671A04ECF65.png\\\" src=\\\"https:\\/\\/ssa-api.toyotavn.com.vn\\/Resources\\/Images\\/52137A460B94DC921EE1F671A04ECF65.png\\\" \\/><\\/p>\\r\\n\\r\\n<h3>H\\u1ec7 th\\u1ed1ng h\\u1ed7 tr\\u1ee3 kh\\u1edfi h&agrave;nh ngang d\\u1ed1c (HAC)<\\/h3>\\r\\n\\r\\n<p>T\\u1ef1 \\u0111\\u1ed9ng phanh t\\u1edbi c&aacute;c b&aacute;nh xe trong 2 gi&acirc;y gi&uacute;p xe kh&ocirc;ng b\\u1ecb tr&ocirc;i khi ng\\u01b0\\u1eddi l&aacute;i chuy\\u1ec3n t\\u1eeb ch&acirc;n ga sang ch&acirc;n phanh \\u0111\\u1ec3 kh\\u1edfi h&agrave;nh ngang d\\u1ed1c.<img alt=\\\"H\\u1ec7 th\\u1ed1ng ki\\u1ec3m so\\u00e1t l\\u1ef1c k\\u00e9o (TRC)\\\" data-src=\\\"https:\\/\\/ssa-api.toyotavn.com.vn\\/Resources\\/Images\\/20A302E69A87997BC41ED34D0B655646.png\\\" src=\\\"https:\\/\\/ssa-api.toyotavn.com.vn\\/Resources\\/Images\\/20A302E69A87997BC41ED34D0B655646.png\\\" \\/><\\/p>\\r\\n\\r\\n<h3>H\\u1ec7 th\\u1ed1ng ki\\u1ec3m so&aacute;t l\\u1ef1c k&eacute;o (TRC)<\\/h3>\\r\\n\\r\\n<p>T\\u1ef1 \\u0111\\u1ed9ng \\u0111i\\u1ec1u khi\\u1ec3n \\u0111\\u1ed9ng c\\u01a1 v&agrave; h\\u1ec7 th\\u1ed1ng phanh nh\\u1eb1m t\\u1ed1i \\u01b0u h&oacute;a l\\u1ef1c k&eacute;o gi&uacute;p xe d\\u1ec5 d&agrave;ng kh\\u1edfi h&agrave;nh v&agrave; t\\u0103ng t\\u1ed1c tr&ecirc;n \\u0111\\u01b0\\u1eddng tr\\u01a1n tr\\u01b0\\u1ee3t.<\\/p>\\r\\n\\r\\n<h2>Th&ocirc;ng s\\u1ed1&nbsp;<\\/h2>\\r\\n\\r\\n<h3>K&iacute;ch th\\u01b0\\u1edbc:<\\/h3>\\r\\n\\r\\n<table align=\\\"center\\\" border=\\\"0\\\">\\r\\n\\t<tbody>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td>Th&ocirc;ng s\\u1ed1<\\/td>\\r\\n\\t\\t\\t<td>Vios E MT<\\/td>\\r\\n\\t\\t\\t<td>Vios E CVT<\\/td>\\r\\n\\t\\t\\t<td>Vios G CVT<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td>K&iacute;ch th\\u01b0\\u1edbc t\\u1ed5ng th\\u1ec3 D x R x C (mm)<\\/td>\\r\\n\\t\\t\\t<td colspan=\\\"3\\\" rowspan=\\\"1\\\">&nbsp;4.425 x 1.730 x 1.475<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td>K&iacute;ch th\\u01b0\\u1edbc t\\u1ed5ng th\\u1ec3 b&ecirc;n trong (D x R x C) (mm)<\\/td>\\r\\n\\t\\t\\t<td colspan=\\\"3\\\" rowspan=\\\"1\\\">1.895 x 1.420 x 1.205<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td>Chi\\u1ec1u d&agrave;i c\\u01a1 s\\u1edf&nbsp;(mm)<\\/td>\\r\\n\\t\\t\\t<td colspan=\\\"3\\\" rowspan=\\\"1\\\">2.550<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td>Chi\\u1ec1u r\\u1ed9ng c\\u01a1 s\\u1edf (Tr\\u01b0\\u1edbc\\/Sau)<\\/td>\\r\\n\\t\\t\\t<td colspan=\\\"3\\\" rowspan=\\\"1\\\">&nbsp;1.475 \\/ 1.460<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td>Kho\\u1ea3ng s&aacute;ng g\\u1ea7m xe&nbsp;(mm)<\\/td>\\r\\n\\t\\t\\t<td colspan=\\\"3\\\" rowspan=\\\"1\\\">133<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td>B&aacute;n k&iacute;nh v&ograve;ng quay t\\u1ed1i thi\\u1ec3u (m)<\\/td>\\r\\n\\t\\t\\t<td colspan=\\\"3\\\" rowspan=\\\"1\\\">5.1<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td>Tr\\u1ecdng l\\u01b0\\u1ee3ng to&agrave;n t\\u1ea3i (kg)<\\/td>\\r\\n\\t\\t\\t<td colspan=\\\"3\\\" rowspan=\\\"1\\\">1.550<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td>Dung t&iacute;ch b&igrave;nh nhi&ecirc;n li\\u1ec7u (L)<\\/td>\\r\\n\\t\\t\\t<td colspan=\\\"3\\\" rowspan=\\\"1\\\">42<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t<\\/tbody>\\r\\n<\\/table>\\r\\n\\r\\n<h3>\\u0110\\u1ed9ng c\\u01a1<\\/h3>\\r\\n\\r\\n<table align=\\\"center\\\" border=\\\"0\\\">\\r\\n\\t<tbody>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td colspan=\\\"2\\\">Th&ocirc;ng s\\u1ed1<\\/td>\\r\\n\\t\\t\\t<td>Vios E MT<\\/td>\\r\\n\\t\\t\\t<td>Vios E CVT<\\/td>\\r\\n\\t\\t\\t<td>Vios G CVT<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td colspan=\\\"2\\\">Lo\\u1ea1i \\u0111\\u1ed9ng c\\u01a1<\\/td>\\r\\n\\t\\t\\t<td rowspan=\\\"1\\\">2NR-FE (1.5L)<\\/td>\\r\\n\\t\\t\\t<td rowspan=\\\"1\\\">2NR-FE (1.5L)<\\/td>\\r\\n\\t\\t\\t<td rowspan=\\\"1\\\">2NR-FE (1.5L)<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td colspan=\\\"2\\\">S\\u1ed1 xy lanh<\\/td>\\r\\n\\t\\t\\t<td rowspan=\\\"1\\\">4<\\/td>\\r\\n\\t\\t\\t<td rowspan=\\\"1\\\">4<\\/td>\\r\\n\\t\\t\\t<td rowspan=\\\"1\\\">4<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td colspan=\\\"2\\\">B\\u1ed1 tr&iacute; xy lanh<\\/td>\\r\\n\\t\\t\\t<td rowspan=\\\"1\\\">Th\\u1eb3ng h&agrave;ng<\\/td>\\r\\n\\t\\t\\t<td rowspan=\\\"1\\\">Th\\u1eb3ng h&agrave;ng<\\/td>\\r\\n\\t\\t\\t<td rowspan=\\\"1\\\">Th\\u1eb3ng h&agrave;ng<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td colspan=\\\"2\\\">Dung t&iacute;ch xy lanh<\\/td>\\r\\n\\t\\t\\t<td rowspan=\\\"1\\\">1.496<\\/td>\\r\\n\\t\\t\\t<td rowspan=\\\"1\\\">1.496<\\/td>\\r\\n\\t\\t\\t<td rowspan=\\\"1\\\">1.496<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td colspan=\\\"2\\\">T\\u1ec9 s\\u1ed1 n&eacute;n<\\/td>\\r\\n\\t\\t\\t<td rowspan=\\\"1\\\">11.5<\\/td>\\r\\n\\t\\t\\t<td rowspan=\\\"1\\\">11.5<\\/td>\\r\\n\\t\\t\\t<td rowspan=\\\"1\\\">11.5<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td colspan=\\\"2\\\">H\\u1ec7 th\\u1ed1ng nhi&ecirc;n li\\u1ec7u<\\/td>\\r\\n\\t\\t\\t<td rowspan=\\\"1\\\">Van bi\\u1ebfn thi&ecirc;n k&eacute;p\\/ Dual VVT-i<\\/td>\\r\\n\\t\\t\\t<td rowspan=\\\"1\\\">Van bi\\u1ebfn thi&ecirc;n k&eacute;p\\/ Dual VVT-i<\\/td>\\r\\n\\t\\t\\t<td rowspan=\\\"1\\\">Van bi\\u1ebfn thi&ecirc;n k&eacute;p\\/ Dual VVT-i<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td colspan=\\\"2\\\">Lo\\u1ea1i nhi&ecirc;n li\\u1ec7u<\\/td>\\r\\n\\t\\t\\t<td rowspan=\\\"1\\\">X\\u0103ng<\\/td>\\r\\n\\t\\t\\t<td rowspan=\\\"1\\\">X\\u0103ng<\\/td>\\r\\n\\t\\t\\t<td rowspan=\\\"1\\\">X\\u0103ng<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td colspan=\\\"2\\\">C&ocirc;ng su\\u1ea5t t\\u1ed1i \\u0111a (hp\\/rpm)<\\/td>\\r\\n\\t\\t\\t<td rowspan=\\\"1\\\">106\\/6.000<\\/td>\\r\\n\\t\\t\\t<td rowspan=\\\"1\\\">106\\/6.000<\\/td>\\r\\n\\t\\t\\t<td rowspan=\\\"1\\\">106\\/6.000<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td colspan=\\\"2\\\">M&ocirc; men xo\\u1eafn t\\u1ed1i \\u0111a&nbsp;(Nm@rpm)<\\/td>\\r\\n\\t\\t\\t<td rowspan=\\\"1\\\">140\\/4.200<\\/td>\\r\\n\\t\\t\\t<td rowspan=\\\"1\\\">140\\/4.200<\\/td>\\r\\n\\t\\t\\t<td rowspan=\\\"1\\\">140\\/4.200<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td colspan=\\\"2\\\">C&aacute;c ch\\u1ebf \\u0111\\u1ed9 l&aacute;i<\\/td>\\r\\n\\t\\t\\t<td rowspan=\\\"1\\\">Kh&ocirc;ng<\\/td>\\r\\n\\t\\t\\t<td rowspan=\\\"1\\\">Kh&ocirc;ng<\\/td>\\r\\n\\t\\t\\t<td rowspan=\\\"1\\\">Kh&ocirc;ng<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td colspan=\\\"2\\\">H\\u1ec7 th\\u1ed1ng truy\\u1ec1n \\u0111\\u1ed9ng<\\/td>\\r\\n\\t\\t\\t<td rowspan=\\\"1\\\">C\\u1ea7u tr\\u01b0\\u1edbc<\\/td>\\r\\n\\t\\t\\t<td rowspan=\\\"1\\\">C\\u1ea7u tr\\u01b0\\u1edbc<\\/td>\\r\\n\\t\\t\\t<td rowspan=\\\"1\\\">C\\u1ea7u tr\\u01b0\\u1edbc<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td colspan=\\\"2\\\">H\\u1ed9p s\\u1ed1<\\/td>\\r\\n\\t\\t\\t<td>MT<\\/td>\\r\\n\\t\\t\\t<td rowspan=\\\"1\\\">CVT<\\/td>\\r\\n\\t\\t\\t<td rowspan=\\\"1\\\">CVT<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td colspan=\\\"1\\\" rowspan=\\\"2\\\">H\\u1ec7 th\\u1ed1ng treo<\\/td>\\r\\n\\t\\t\\t<td>Tr\\u01b0\\u1edbc<\\/td>\\r\\n\\t\\t\\t<td rowspan=\\\"1\\\">\\u0110\\u1ed9c l\\u1eadp&nbsp;Macpherson<\\/td>\\r\\n\\t\\t\\t<td rowspan=\\\"1\\\">\\u0110\\u1ed9c l\\u1eadp&nbsp;Macpherson<\\/td>\\r\\n\\t\\t\\t<td rowspan=\\\"1\\\">\\u0110\\u1ed9c l\\u1eadp&nbsp;Macpherson<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td>Sau<\\/td>\\r\\n\\t\\t\\t<td rowspan=\\\"1\\\">D\\u1ea7m xo\\u1eafn<\\/td>\\r\\n\\t\\t\\t<td rowspan=\\\"1\\\">D\\u1ea7m xo\\u1eafn<\\/td>\\r\\n\\t\\t\\t<td rowspan=\\\"1\\\">D\\u1ea7m xo\\u1eafn<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td colspan=\\\"2\\\">Tr\\u1ee3 l\\u1ef1c tay l&aacute;i<\\/td>\\r\\n\\t\\t\\t<td rowspan=\\\"1\\\">\\u0110i\\u1ec7n<\\/td>\\r\\n\\t\\t\\t<td rowspan=\\\"1\\\">\\u0110i\\u1ec7n<\\/td>\\r\\n\\t\\t\\t<td rowspan=\\\"1\\\">\\u0110i\\u1ec7n<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td colspan=\\\"1\\\" rowspan=\\\"3\\\">V&agrave;nh &amp; l\\u1ed1p xe<\\/td>\\r\\n\\t\\t\\t<td>Lo\\u1ea1i v&agrave;nh<\\/td>\\r\\n\\t\\t\\t<td rowspan=\\\"1\\\">M&acirc;m \\u0111&uacute;c<\\/td>\\r\\n\\t\\t\\t<td rowspan=\\\"1\\\">M&acirc;m \\u0111&uacute;c<\\/td>\\r\\n\\t\\t\\t<td rowspan=\\\"1\\\">M&acirc;m \\u0111&uacute;c<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td>K&iacute;ch th\\u01b0\\u1edbc l\\u1ed1p<\\/td>\\r\\n\\t\\t\\t<td rowspan=\\\"1\\\">185\\/60R15<\\/td>\\r\\n\\t\\t\\t<td rowspan=\\\"1\\\">185\\/60R15<\\/td>\\r\\n\\t\\t\\t<td rowspan=\\\"1\\\">185\\/60R15<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td>L\\u1ed1p d\\u1ef1 ph&ograve;ng<\\/td>\\r\\n\\t\\t\\t<td rowspan=\\\"1\\\">M&acirc;m \\u0111&uacute;c<\\/td>\\r\\n\\t\\t\\t<td rowspan=\\\"1\\\">M&acirc;m \\u0111&uacute;c<\\/td>\\r\\n\\t\\t\\t<td rowspan=\\\"1\\\">M&acirc;m \\u0111&uacute;c<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td colspan=\\\"1\\\" rowspan=\\\"2\\\">Phanh<\\/td>\\r\\n\\t\\t\\t<td>Tr\\u01b0\\u1edbc<\\/td>\\r\\n\\t\\t\\t<td rowspan=\\\"1\\\">\\u0110\\u0129a th&ocirc;ng gi&oacute;<\\/td>\\r\\n\\t\\t\\t<td rowspan=\\\"1\\\">\\u0110\\u0129a th&ocirc;ng gi&oacute;<\\/td>\\r\\n\\t\\t\\t<td rowspan=\\\"1\\\">\\u0110\\u0129a th&ocirc;ng gi&oacute;<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td>Sau<\\/td>\\r\\n\\t\\t\\t<td rowspan=\\\"1\\\">\\u0110\\u0129a \\u0111\\u1eb7c<\\/td>\\r\\n\\t\\t\\t<td rowspan=\\\"1\\\">\\u0110\\u0129a \\u0111\\u1eb7c<\\/td>\\r\\n\\t\\t\\t<td rowspan=\\\"1\\\">\\u0110\\u0129a \\u0111\\u1eb7c<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td colspan=\\\"2\\\" rowspan=\\\"1\\\">Ti&ecirc;u chu\\u1ea9n kh&iacute; th\\u1ea3i&nbsp;&nbsp; &nbsp;<\\/td>\\r\\n\\t\\t\\t<td>Euro 5<\\/td>\\r\\n\\t\\t\\t<td>Euro 5<\\/td>\\r\\n\\t\\t\\t<td>Euro 5<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td colspan=\\\"1\\\" rowspan=\\\"3\\\">Ti&ecirc;u th\\u1ee5 nhi&ecirc;n li\\u1ec7u<\\/td>\\r\\n\\t\\t\\t<td>Ngo&agrave;i \\u0111&ocirc; th\\u1ecb<\\/td>\\r\\n\\t\\t\\t<td>&nbsp; &nbsp; 5,08&nbsp;&nbsp; &nbsp;<\\/td>\\r\\n\\t\\t\\t<td>4,67<\\/td>\\r\\n\\t\\t\\t<td>4,79<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td>K\\u1ebft h\\u1ee3p&nbsp;<\\/td>\\r\\n\\t\\t\\t<td>6,02<\\/td>\\r\\n\\t\\t\\t<td>5,77<\\/td>\\r\\n\\t\\t\\t<td>5,87<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td>Trong \\u0111&ocirc; th\\u1ecb &nbsp;<\\/td>\\r\\n\\t\\t\\t<td>7,62<\\/td>\\r\\n\\t\\t\\t<td>7,70<\\/td>\\r\\n\\t\\t\\t<td>7,74<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t<\\/tbody>\\r\\n<\\/table>\\r\\n\\r\\n<h3>Ngo\\u1ea1i th\\u1ea5t<\\/h3>\\r\\n\\r\\n<table align=\\\"center\\\" border=\\\"0\\\">\\r\\n\\t<tbody>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td colspan=\\\"2\\\">Th&ocirc;ng s\\u1ed1<\\/td>\\r\\n\\t\\t\\t<td>Vios E MT<\\/td>\\r\\n\\t\\t\\t<td>Vios E CVT<\\/td>\\r\\n\\t\\t\\t<td>Vios G CVT<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td colspan=\\\"1\\\" rowspan=\\\"6\\\">C\\u1ee5m \\u0111&egrave;n tr\\u01b0\\u1edbc<\\/td>\\r\\n\\t\\t\\t<td>\\u0110&egrave;n chi\\u1ebfu g\\u1ea7n<\\/td>\\r\\n\\t\\t\\t<td>Bi LED d\\u1ea1ng b&oacute;ng chi\\u1ebfu<\\/td>\\r\\n\\t\\t\\t<td>Bi LED d\\u1ea1ng b&oacute;ng chi\\u1ebfu<\\/td>\\r\\n\\t\\t\\t<td>Bi LED d\\u1ea1ng b&oacute;ng chi\\u1ebfu<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td>\\u0110&egrave;n chi\\u1ebfu xa<\\/td>\\r\\n\\t\\t\\t<td>Bi LED d\\u1ea1ng b&oacute;ng chi\\u1ebfu<\\/td>\\r\\n\\t\\t\\t<td>Bi LED d\\u1ea1ng b&oacute;ng chi\\u1ebfu<\\/td>\\r\\n\\t\\t\\t<td>Bi LED d\\u1ea1ng b&oacute;ng chi\\u1ebfu<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td>\\u0110&egrave;n chi\\u1ebfu LED s&aacute;ng ban ng&agrave;y<\\/td>\\r\\n\\t\\t\\t<td>Kh&ocirc;ng<\\/td>\\r\\n\\t\\t\\t<td>Kh&ocirc;ng<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td>T\\u1ef1 \\u0111\\u1ed9ng B\\u1eadt\\/T\\u1eaft<\\/td>\\r\\n\\t\\t\\t<td>Kh&ocirc;ng<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td>H\\u1ec7 th\\u1ed1ng nh\\u1eafc nh\\u1edf \\u0111&egrave;n s&aacute;ng<\\/td>\\r\\n\\t\\t\\t<td>-<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td>Ch\\u1ebf \\u0111\\u1ed9 \\u0111&egrave;n ch\\u1edd d\\u1eabn \\u0111\\u01b0\\u1eddng<\\/td>\\r\\n\\t\\t\\t<td>Kh&ocirc;ng<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td colspan=\\\"1\\\" rowspan=\\\"2\\\">C\\u1ee5m \\u0111&egrave;n sau<\\/td>\\r\\n\\t\\t\\t<td>\\u0110&egrave;n phanh<\\/td>\\r\\n\\t\\t\\t<td>LED<\\/td>\\r\\n\\t\\t\\t<td>LED<\\/td>\\r\\n\\t\\t\\t<td>LED<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td>\\u0110&egrave;n b&aacute;o r\\u1ebd<\\/td>\\r\\n\\t\\t\\t<td>LED<\\/td>\\r\\n\\t\\t\\t<td>LED<\\/td>\\r\\n\\t\\t\\t<td>LED<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td colspan=\\\"1\\\" rowspan=\\\"4\\\">G\\u01b0\\u01a1ng chi\\u1ebfu h\\u1eadu ngo&agrave;i<\\/td>\\r\\n\\t\\t\\t<td>\\u0110i\\u1ec1u ch\\u1ec9nh \\u0111i\\u1ec7n<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td>G\\u1eadp \\u0111i\\u1ec7n<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td>T&iacute;ch h\\u1ee3p \\u0111&egrave;n b&aacute;o r\\u1ebd<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td>M&agrave;u<\\/td>\\r\\n\\t\\t\\t<td>C&ugrave;ng m&agrave;u th&acirc;n xe<\\/td>\\r\\n\\t\\t\\t<td>C&ugrave;ng m&agrave;u th&acirc;n xe<\\/td>\\r\\n\\t\\t\\t<td>C&ugrave;ng m&agrave;u th&acirc;n xe<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td colspan=\\\"2\\\">\\u0102ng ten<\\/td>\\r\\n\\t\\t\\t<td>V&acirc;y c&aacute;<\\/td>\\r\\n\\t\\t\\t<td>V&acirc;y c&aacute;<\\/td>\\r\\n\\t\\t\\t<td>V&acirc;y c&aacute;<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td colspan=\\\"2\\\">Tay n\\u1eafm c\\u1eeda ngo&agrave;i xe<\\/td>\\r\\n\\t\\t\\t<td>C&ugrave;ng m&agrave;u th&acirc;n xe<\\/td>\\r\\n\\t\\t\\t<td>C&ugrave;ng m&agrave;u th&acirc;n xe<\\/td>\\r\\n\\t\\t\\t<td>M\\u1ea1 crom<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td colspan=\\\"2\\\">L\\u01b0\\u1edbi t\\u1ea3n nhi\\u1ec7t<\\/td>\\r\\n\\t\\t\\t<td>S\\u01a1n \\u0111en<\\/td>\\r\\n\\t\\t\\t<td>S\\u01a1n \\u0111en<\\/td>\\r\\n\\t\\t\\t<td>S\\u01a1n \\u0111en b&oacute;ng<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td colspan=\\\"2\\\">C&aacute;nh h\\u01b0\\u1edbng gi&oacute; sau<\\/td>\\r\\n\\t\\t\\t<td>Kh&ocirc;ng<\\/td>\\r\\n\\t\\t\\t<td>Kh&ocirc;ng<\\/td>\\r\\n\\t\\t\\t<td>Kh&ocirc;ng<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t<\\/tbody>\\r\\n<\\/table>\\r\\n\\r\\n<h3>Trang b\\u1ecb&nbsp;<\\/h3>\\r\\n\\r\\n<table align=\\\"center\\\" border=\\\"0\\\">\\r\\n\\t<tbody>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td colspan=\\\"2\\\">Th&ocirc;ng s\\u1ed1<\\/td>\\r\\n\\t\\t\\t<td>Vios E MT<\\/td>\\r\\n\\t\\t\\t<td>Vios E CVT<\\/td>\\r\\n\\t\\t\\t<td>Vios G CVT<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td colspan=\\\"1\\\" rowspan=\\\"4\\\">Tay l&aacute;i<\\/td>\\r\\n\\t\\t\\t<td>Lo\\u1ea1i tay l&aacute;i<\\/td>\\r\\n\\t\\t\\t<td>3 ch\\u1ea5u<\\/td>\\r\\n\\t\\t\\t<td>3 ch\\u1ea5u<\\/td>\\r\\n\\t\\t\\t<td>3 ch\\u1ea5u<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td>Ch\\u1ea5t li\\u1ec7u<\\/td>\\r\\n\\t\\t\\t<td>Urethane<\\/td>\\r\\n\\t\\t\\t<td>B\\u1ecdc da<\\/td>\\r\\n\\t\\t\\t<td>B\\u1ecdc da<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td>N&uacute;t b\\u1ea5m \\u0111i\\u1ec1u khi\\u1ec3n t&iacute;ch h\\u1ee3p<\\/td>\\r\\n\\t\\t\\t<td>\\u0110i\\u1ec1u ch\\u1ec9nh &acirc;m thanh, \\u0111&agrave;m tho\\u1ea1i r\\u1ea3nh tay<\\/td>\\r\\n\\t\\t\\t<td>\\u0110i\\u1ec1u ch\\u1ec9nh &acirc;m thanh, \\u0111&agrave;m tho\\u1ea1i r\\u1ea3nh tay<\\/td>\\r\\n\\t\\t\\t<td>\\u0110i\\u1ec1u ch\\u1ec9nh &acirc;m thanh, \\u0111&agrave;m tho\\u1ea1i r\\u1ea3nh tay, m&agrave;n h&igrave;nh hi\\u1ec3n th\\u1ecb \\u0111a th&ocirc;ng tin<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td>L\\u1eaby chuy\\u1ec3n s\\u1ed1<\\/td>\\r\\n\\t\\t\\t<td>Kh&ocirc;ng<\\/td>\\r\\n\\t\\t\\t<td>Kh&ocirc;ng<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td colspan=\\\"2\\\">G\\u01b0\\u01a1ng chi\\u1ebfu h\\u1eadu trong<\\/td>\\r\\n\\t\\t\\t<td>2 ch\\u1ebf \\u0111\\u1ed9 ng&agrave;y v&agrave; \\u0111&ecirc;m<\\/td>\\r\\n\\t\\t\\t<td>2 ch\\u1ebf \\u0111\\u1ed9 ng&agrave;y v&agrave; \\u0111&ecirc;m<\\/td>\\r\\n\\t\\t\\t<td>2 ch\\u1ebf \\u0111\\u1ed9 ng&agrave;y v&agrave; \\u0111&ecirc;m<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td colspan=\\\"2\\\">Tay n\\u1eafm c\\u1eeda trong xe<\\/td>\\r\\n\\t\\t\\t<td>C&ugrave;ng m&agrave;u n\\u1ed9i th\\u1ea5t<\\/td>\\r\\n\\t\\t\\t<td>C&ugrave;ng m&agrave;u n\\u1ed9i th\\u1ea5t<\\/td>\\r\\n\\t\\t\\t<td>M\\u1ea1 b\\u1ea1c<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td colspan=\\\"1\\\" rowspan=\\\"4\\\">C\\u1ee5m \\u0111\\u1ed3ng h\\u1ed3<\\/td>\\r\\n\\t\\t\\t<td>Lo\\u1ea1i \\u0111\\u1ed3ng h\\u1ed3<\\/td>\\r\\n\\t\\t\\t<td>Analog<\\/td>\\r\\n\\t\\t\\t<td>Optitron<\\/td>\\r\\n\\t\\t\\t<td>Optitron v\\u1edbi m&agrave;n h&igrave;nh TFT 4,2 inch<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td>\\u0110&egrave;n b&aacute;o ch\\u1ebf \\u0111\\u1ed9 Eco<\\/td>\\r\\n\\t\\t\\t<td>Kh&ocirc;ng<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td>Ch\\u1ee9c n\\u0103ng b&aacute;o l\\u01b0\\u1ee3ng ti&ecirc;u th\\u1ee5 nhi&ecirc;n li\\u1ec7u<\\/td>\\r\\n\\t\\t\\t<td>Kh&ocirc;ng<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td>Ch\\u1ee9c n\\u0103ng b&aacute;o v\\u1ecb tr&iacute; c\\u1ea7n s\\u1ed1<\\/td>\\r\\n\\t\\t\\t<td>Kh&ocirc;ng<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td colspan=\\\"2\\\">Ch\\u1ea5t li\\u1ec7u b\\u1ecdc gh\\u1ebf<\\/td>\\r\\n\\t\\t\\t<td>PU<\\/td>\\r\\n\\t\\t\\t<td>Da<\\/td>\\r\\n\\t\\t\\t<td>Da<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td colspan=\\\"1\\\" rowspan=\\\"3\\\">Gh\\u1ebf tr\\u01b0\\u1edbc<\\/td>\\r\\n\\t\\t\\t<td>Lo\\u1ea1i gh\\u1ebf<\\/td>\\r\\n\\t\\t\\t<td>Th\\u01b0\\u1eddng<\\/td>\\r\\n\\t\\t\\t<td>Th\\u1ec3 thao<\\/td>\\r\\n\\t\\t\\t<td>Th\\u1ec3 thao<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td>\\u0110i\\u1ec1u ch\\u1ec9nh gh\\u1ebf l&aacute;i<\\/td>\\r\\n\\t\\t\\t<td>Ch\\u1ec9nh tay 6 h\\u01b0\\u1edbng<\\/td>\\r\\n\\t\\t\\t<td>Ch\\u1ec9nh tay 6 h\\u01b0\\u1edbng<\\/td>\\r\\n\\t\\t\\t<td>Ch\\u1ec9nh tay 6 h\\u01b0\\u1edbng<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td>\\u0110i\\u1ec1u ch\\u1ec9nh gh\\u1ebf h&agrave;nh kh&aacute;ch<\\/td>\\r\\n\\t\\t\\t<td>Ch\\u1ec9nh tay 4 h\\u01b0\\u1edbng<\\/td>\\r\\n\\t\\t\\t<td>Ch\\u1ec9nh tay 4 h\\u01b0\\u1edbng<\\/td>\\r\\n\\t\\t\\t<td>Ch\\u1ec9nh tay 4 h\\u01b0\\u1edbng<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td colspan=\\\"1\\\" rowspan=\\\"2\\\">Gh\\u1ebf sau<\\/td>\\r\\n\\t\\t\\t<td>H&agrave;ng gh\\u1ebf th\\u1ee9 hai<\\/td>\\r\\n\\t\\t\\t<td>G\\u1eadp l\\u01b0ng gh\\u1ebf 60:40, ng\\u1ea3 l\\u01b0ng gh\\u1ebf<\\/td>\\r\\n\\t\\t\\t<td>G\\u1eadp l\\u01b0ng gh\\u1ebf 60:40, ng\\u1ea3 l\\u01b0ng gh\\u1ebf<\\/td>\\r\\n\\t\\t\\t<td>G\\u1eadp l\\u01b0ng gh\\u1ebf 60:40, ng\\u1ea3 l\\u01b0ng gh\\u1ebf<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td>T\\u1ef1a tay h&agrave;ng gh\\u1ebf sau<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td colspan=\\\"2\\\">\\u0110i\\u1ec1u h&ograve;a<\\/td>\\r\\n\\t\\t\\t<td>T\\u1ef1 \\u0111\\u1ed9ng<\\/td>\\r\\n\\t\\t\\t<td>T\\u1ef1 \\u0111\\u1ed9ng<\\/td>\\r\\n\\t\\t\\t<td>T\\u1ef1 \\u0111\\u1ed9ng<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td colspan=\\\"2\\\">M&agrave;n h&igrave;nh gi\\u1ea3i tr&iacute;&nbsp;<\\/td>\\r\\n\\t\\t\\t<td>C\\u1ea3m \\u1ee9ng 7 inch<\\/td>\\r\\n\\t\\t\\t<td>C\\u1ea3m \\u1ee9ng 7 inch<\\/td>\\r\\n\\t\\t\\t<td>C\\u1ea3m \\u1ee9ng 9 inch<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td colspan=\\\"2\\\">S\\u1ed1 loa<\\/td>\\r\\n\\t\\t\\t<td>4<\\/td>\\r\\n\\t\\t\\t<td>4<\\/td>\\r\\n\\t\\t\\t<td>6<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td colspan=\\\"2\\\">C\\u1ed5ng k\\u1ebft n\\u1ed1i USB<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td colspan=\\\"2\\\">K\\u1ebft n\\u1ed1i Bluetooth<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td colspan=\\\"2\\\">C\\u1ed5ng s\\u1ea1c USB Type C h&agrave;ng gh\\u1ebf th\\u1ee9 2<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td colspan=\\\"2\\\">H\\u1ec7 th\\u1ed1ng \\u0111&agrave;m tho\\u1ea1i r\\u1ea3nh tay<\\/td>\\r\\n\\t\\t\\t<td>Kh&ocirc;ng<\\/td>\\r\\n\\t\\t\\t<td>Kh&ocirc;ng<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td colspan=\\\"2\\\">K\\u1ebft n\\u1ed1i \\u0111i\\u1ec7n tho\\u1ea1i th&ocirc;ng minh<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td colspan=\\\"2\\\">Ch&igrave;a kh&oacute;a th&ocirc;ng minh<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td colspan=\\\"2\\\">Kh\\u1edfi \\u0111\\u1ed9ng b\\u1eb1ng n&uacute;t b\\u1ea5m<\\/td>\\r\\n\\t\\t\\t<td>Kh&ocirc;ng<\\/td>\\r\\n\\t\\t\\t<td>Kh&ocirc;ng<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td colspan=\\\"2\\\">Kh&oacute;a c\\u1eeda \\u0111i\\u1ec7n<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td colspan=\\\"2\\\">Ch\\u1ee9c n\\u0103ng kh&oacute;a c\\u1eeda t\\u1eeb xa<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td colspan=\\\"2\\\">C\\u1eeda s\\u1ed5 \\u0111i\\u1ec1u ch\\u1ec9nh \\u0111i\\u1ec7n l&ecirc;n xu\\u1ed1ng 1 ch\\u1ea1m ch\\u1ed1ng k\\u1eb9t<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td colspan=\\\"2\\\">Ga t\\u1ef1 \\u0111\\u1ed9ng<\\/td>\\r\\n\\t\\t\\t<td>Kh&ocirc;ng<\\/td>\\r\\n\\t\\t\\t<td>Kh&ocirc;ng<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t<\\/tbody>\\r\\n<\\/table>\\r\\n\\r\\n<h3>Trang b\\u1ecb an to&agrave;n<\\/h3>\\r\\n\\r\\n<table align=\\\"center\\\" border=\\\"0\\\">\\r\\n\\t<tbody>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td colspan=\\\"2\\\">Th&ocirc;ng s\\u1ed1<\\/td>\\r\\n\\t\\t\\t<td>Vios E MT<\\/td>\\r\\n\\t\\t\\t<td>Vios E CVT<\\/td>\\r\\n\\t\\t\\t<td>Vios G CVT<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td colspan=\\\"2\\\">S\\u1ed1 t&uacute;i kh&iacute;<\\/td>\\r\\n\\t\\t\\t<td>3<\\/td>\\r\\n\\t\\t\\t<td>3<\\/td>\\r\\n\\t\\t\\t<td>7<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td colspan=\\\"2\\\">H\\u1ec7 th\\u1ed1ng ch\\u1ed1ng b&oacute; c\\u1ee9ng phanh&nbsp;&nbsp; &nbsp;<\\/td>\\r\\n\\t\\t\\t<td rowspan=\\\"1\\\">C&oacute;<\\/td>\\r\\n\\t\\t\\t<td rowspan=\\\"1\\\">C&oacute;<\\/td>\\r\\n\\t\\t\\t<td rowspan=\\\"1\\\">C&oacute;<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td colspan=\\\"2\\\">H\\u1ed7 tr\\u1ee3 l\\u1ef1c phanh kh\\u1ea9n c\\u1ea5p<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t\\t<td rowspan=\\\"1\\\">C&oacute;<\\/td>\\r\\n\\t\\t\\t<td rowspan=\\\"1\\\">C&oacute;<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td colspan=\\\"2\\\">Ph&acirc;n ph\\u1ed1i l\\u1ef1c phanh \\u0111i\\u1ec7n t\\u1eed<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td colspan=\\\"2\\\">H\\u1ed7 tr\\u1ee3 kh\\u1edfi h&agrave;nh ngang d\\u1ed1c<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td colspan=\\\"2\\\">H\\u1ec7 th\\u1ed1ng c&acirc;n b\\u1eb1ng \\u0111i\\u1ec7n t\\u1eed<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td colspan=\\\"2\\\">H\\u1ec7 th\\u1ed1ng ki\\u1ec3m so&aacute;t l\\u1ef1c k&eacute;o<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td colspan=\\\"2\\\">H\\u1ed7 tr\\u1ee3 xu\\u1ed1ng d\\u1ed1c&nbsp;&nbsp; &nbsp;<\\/td>\\r\\n\\t\\t\\t<td>Kh&ocirc;ng<\\/td>\\r\\n\\t\\t\\t<td>Kh&ocirc;ng<\\/td>\\r\\n\\t\\t\\t<td>Kh&ocirc;ng<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td colspan=\\\"2\\\">C\\u1ea3nh b&aacute;o l\\u1ec7ch l&agrave;n \\u0111\\u01b0\\u1eddng&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;<\\/td>\\r\\n\\t\\t\\t<td>Kh&ocirc;ng<\\/td>\\r\\n\\t\\t\\t<td>Kh&ocirc;ng<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td colspan=\\\"2\\\">H\\u1ec7 th\\u1ed1ng \\u0111i\\u1ec1u khi\\u1ec3n h&agrave;nh tr&igrave;nh<\\/td>\\r\\n\\t\\t\\t<td>Kh&ocirc;ng<\\/td>\\r\\n\\t\\t\\t<td>Kh&ocirc;ng<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td colspan=\\\"2\\\">H\\u1ec7 th\\u1ed1ng c\\u1ea3nh b&aacute;o ti\\u1ec1n va ch\\u1ea1m<\\/td>\\r\\n\\t\\t\\t<td>Kh&ocirc;ng<\\/td>\\r\\n\\t\\t\\t<td>Kh&ocirc;ng<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td colspan=\\\"2\\\" rowspan=\\\"1\\\">C\\u1ea3m bi\\u1ebfn g&oacute;c tr\\u01b0\\u1edbc\\/sau<\\/td>\\r\\n\\t\\t\\t<td>Kh&ocirc;ng<\\/td>\\r\\n\\t\\t\\t<td>Kh&ocirc;ng<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td colspan=\\\"2\\\" rowspan=\\\"1\\\">H\\u1ec7 th\\u1ed1ng c\\u1ea3nh b&aacute;o &aacute;p su\\u1ea5t l\\u1ed1p&nbsp;&nbsp; &nbsp;<\\/td>\\r\\n\\t\\t\\t<td>Kh&ocirc;ng<\\/td>\\r\\n\\t\\t\\t<td>Kh&ocirc;ng<\\/td>\\r\\n\\t\\t\\t<td>Kh&ocirc;ng<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td colspan=\\\"2\\\">C\\u1ea3nh b&aacute;o \\u0111i\\u1ec3m m&ugrave;<\\/td>\\r\\n\\t\\t\\t<td>Kh&ocirc;ng<\\/td>\\r\\n\\t\\t\\t<td>Kh&ocirc;ng<\\/td>\\r\\n\\t\\t\\t<td>Kh&ocirc;ng<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td colspan=\\\"2\\\">H\\u1ec7 th\\u1ed1ng h\\u1ed7 tr\\u1ee3 \\u0111\\u1ed7 xe ch\\u1ee7 \\u0111\\u1ed9ng<\\/td>\\r\\n\\t\\t\\t<td>Kh&ocirc;ng<\\/td>\\r\\n\\t\\t\\t<td>Kh&ocirc;ng<\\/td>\\r\\n\\t\\t\\t<td>Kh&ocirc;ng<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td colspan=\\\"2\\\">C\\u1ea3m bi\\u1ebfn tr\\u01b0\\u1edbc<\\/td>\\r\\n\\t\\t\\t<td>Kh&ocirc;ng<\\/td>\\r\\n\\t\\t\\t<td>Kh&ocirc;ng<\\/td>\\r\\n\\t\\t\\t<td>Kh&ocirc;ng<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td colspan=\\\"2\\\">C\\u1ea3m bi\\u1ebfn sau&nbsp;&nbsp; &nbsp;<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td colspan=\\\"2\\\">Camera 360 \\u0111\\u1ed9&nbsp;&nbsp; &nbsp;<\\/td>\\r\\n\\t\\t\\t<td>Kh&ocirc;ng<\\/td>\\r\\n\\t\\t\\t<td>Kh&ocirc;ng<\\/td>\\r\\n\\t\\t\\t<td>Kh&ocirc;ng<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td colspan=\\\"2\\\">Camera l&ugrave;i&nbsp;&nbsp; &nbsp;<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td colspan=\\\"2\\\">H\\u1ec7 th\\u1ed1ng nh\\u1eafc th\\u1eaft d&acirc;y an to&agrave;n&nbsp;&nbsp;<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t\\t<td>C&oacute;<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t<\\/tbody>\\r\\n<\\/table>\"}]', NULL, '{\"main\":\"\\/storage\\/toyota\\/vios\\/vios-logo.png\"}', 1, 1, 6, '[\"3\",\"6\",\"7\"]', '{\"4\":{\"43\":\"4-mau-sac-trang\",\"44\":\"4-mau-sac-den\",\"45\":\"4-mau-sac-do\",\"46\":\"4-mau-sac-bac\",\"50\":\"4-mau-sac-trang-ngoc-trai\",\"55\":\"4-mau-sac-nau-anh-vang\"},\"39\":{\"40\":\"39-phien-ban-vios-15e-mt\",\"41\":\"39-phien-ban-vios-15e-cvt\",\"42\":\"39-phien-ban-vios-15g-cvt\"}}', NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, '2023-11-09 06:49:09', '2023-11-10 03:29:03', 0, 12);
INSERT INTO `products` (`id`, `name`, `slug`, `sku`, `description`, `content`, `promotion`, `images`, `status`, `has_variant`, `product_category_id`, `product_category_ids`, `attribute_ids`, `meta_title`, `meta_description`, `meta_keyword`, `canonical`, `seo_preview`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`, `featured`, `flash_sale_quantity`) VALUES
(4, 'Hyundai Elantra', 'hyundai-elantra', 'Hy-ela-2023', '', '[{\"label\":\"N\\u1ed9i dung\",\"label_hidden\":\"N\\u1ed9i dung\",\"url\":\"noi-dung\",\"content\":\"<section data-element_type=\\\"section\\\" data-id=\\\"78ad3283\\\" id=\\\"tongquan\\\">\\r\\n<h1>N\\u1ed4I B\\u1eacT<\\/h1>\\r\\n\\r\\n<p><strong>H&Atilde;Y KH\\u1edeI \\u0110\\u1ed8NG V&Agrave; TI\\u1ebeN V\\u1ec0 PH&Iacute;A TR\\u01af\\u1edaC<\\/strong><\\/p>\\r\\n\\r\\n<p>D&aacute;m th&aacute;ch th\\u1ee9c hi\\u1ec7n th\\u1ef1c v&agrave; t&igrave;m th\\u1ea5y l&ograve;ng d\\u0169ng c\\u1ea3m m&agrave; kh&ocirc;ng s\\u1ee3 th\\u1ea5t b\\u1ea1i. M\\u1edf ra th\\u1ebf gi\\u1edbi ng&agrave;y mai b\\u1eb1ng c&aacute;c ti&ecirc;u chu\\u1ea9n c\\u1ee7a ri&ecirc;ng b\\u1ea1n, kh&ocirc;ng ph\\u1ea3i c\\u1ee7a th\\u1ebf gi\\u1edbi. D&aacute;m l&agrave; ch&iacute;nh m&iacute;nh.<br \\/>\\r\\n<img alt=\\\"\\\" height=\\\"600\\\" loading=\\\"lazy\\\" sizes=\\\"(max-width: 1120px) 100vw, 1120px\\\" src=\\\"https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-noi-bat-1.jpg\\\" srcset=\\\"https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-noi-bat-1.jpg 1120w, https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-noi-bat-1-300x161.jpg 300w, https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-noi-bat-1-1024x549.jpg 1024w, https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-noi-bat-1-768x411.jpg 768w\\\" width=\\\"1120\\\" \\/><\\/p>\\r\\n\\r\\n<p>&nbsp;<\\/p>\\r\\n\\r\\n<p><strong>C&acirc;u tr\\u1ea3 l\\u1eddi ch&iacute;nh l&agrave; b\\u1ea1n<\\/strong><\\/p>\\r\\n\\r\\n<p>\\u0110\\u1ee9ng v\\u1eefng. C&oacute; ni\\u1ec1m tin v&agrave;o ch&iacute;nh m&igrave;nh, N\\u0103ng l\\u1ef1c th\\u1ef1c s\\u1ef1 c\\u1ee7a b\\u1ea1n s\\u1ebd \\u0111\\u01b0\\u1ee3c gi\\u1ea3i ph&oacute;ng.<\\/p>\\r\\n\\r\\n<p><img alt=\\\"\\\" height=\\\"600\\\" loading=\\\"lazy\\\" sizes=\\\"(max-width: 1120px) 100vw, 1120px\\\" src=\\\"https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-noi-bat-2.jpg\\\" srcset=\\\"https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-noi-bat-2.jpg 1120w, https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-noi-bat-2-300x161.jpg 300w, https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-noi-bat-2-1024x549.jpg 1024w, https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-noi-bat-2-768x411.jpg 768w\\\" width=\\\"1120\\\" \\/><\\/p>\\r\\n\\r\\n<p><strong>\\u0110\\u1eb7t c&acirc;u h\\u1ecfi v\\u1edbi nh\\u1eefng \\u0111\\u1ecbnh ki\\u1ebfn c\\u0169<\\/strong><\\/p>\\r\\n\\r\\n<p>Thi\\u1ebft k\\u1ebf &lsquo;Parametric Dynamics&rsquo; l&agrave;m n\\u1ed5i b\\u1eadt t&iacute;nh th\\u1ea9m m\\u1ef9 h&igrave;nh h\\u1ecdc c\\u1ee7a ph\\u1ea7n mui k&eacute;o d&agrave;i v&agrave; c&aacute;c \\u0111\\u01b0\\u1eddng n&eacute;t ki\\u1ec3u d&aacute;ng \\u0111\\u1eb9p, ho&agrave;n thi\\u1ec7n phong c&aacute;ch s&aacute;ng t\\u1ea1o v&agrave; c&oacute; t\\u1ea7m nh&igrave;n xa.<\\/p>\\r\\n\\r\\n<p>&nbsp;<\\/p>\\r\\n\\r\\n<p><strong>Mang &aacute;nh \\u0111&egrave;n s&acirc;n kh\\u1ea5u \\u0111\\u1ebfn v\\u1edbi b\\u1ea1n<\\/strong><\\/p>\\r\\n\\r\\n<p>L\\u1edbn h\\u01a1n, d&agrave;i h\\u01a1n v&agrave; th\\u1ea5p h\\u01a1n bao gi\\u1edd h\\u1ebft. V\\u1ebb ngo&agrave;i th\\u1ec3 thao v&agrave; nh\\u1eefng \\u0111\\u01b0\\u1eddng n&eacute;t trau chu\\u1ed1t c\\u1ee7a Elantra l&agrave;m n\\u1ed5i b\\u1eadt s\\u1ef1 hi\\u1ec7n di\\u1ec7n t&aacute;o b\\u1ea1o c\\u1ee7a n&oacute;.<br \\/>\\r\\n<img alt=\\\"\\\" height=\\\"600\\\" loading=\\\"lazy\\\" sizes=\\\"(max-width: 1120px) 100vw, 1120px\\\" src=\\\"https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-noi-bat-3.jpg\\\" srcset=\\\"https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-noi-bat-3.jpg 1120w, https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-noi-bat-3-300x161.jpg 300w, https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-noi-bat-3-1024x549.jpg 1024w, https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-noi-bat-3-768x411.jpg 768w\\\" width=\\\"1120\\\" \\/><\\/p>\\r\\n\\r\\n<p>&nbsp;<\\/p>\\r\\n<\\/section>\\r\\n\\r\\n<section data-element_type=\\\"section\\\" data-id=\\\"ba649f4\\\" id=\\\"ngoaithat\\\">\\r\\n<h3>NGO\\u1ea0I TH\\u1ea4T<\\/h3>\\r\\n\\r\\n<p>M\\u1eb6T TR\\u01af\\u1edaC<\\/p>\\r\\n\\r\\n<p><strong>L\\u01b0\\u1edbi t\\u1ea3n nhi\\u1ec7t &ldquo;Parametric Jewel Pattern&rdquo;<\\/strong><\\/p>\\r\\n\\r\\n<p>Thi\\u1ebft k\\u1ebf ki\\u1ec3u &ldquo;Parametric Jewel Pattern&rdquo; l&agrave;m n\\u1ed5i b\\u1eadt chi\\u1ec1u s&acirc;u c\\u1ee7a l\\u01b0\\u1edbi t\\u1ea3n nhi\\u1ec7t ph&iacute;a tr\\u01b0\\u1edbc, l&agrave;m cho n&oacute; gi\\u1ed1ng nh\\u01b0 nh\\u1eefng vi&ecirc;n \\u0111&aacute; qu&yacute; c\\u1eaft kim c\\u01b0\\u01a1ng c&ugrave;ng \\u0111&egrave;n pha ph&iacute;a tr\\u01b0\\u1edbc t&aacute;o b\\u1ea1o v&agrave; k&eacute;o d&agrave;i k\\u1ebft h\\u1ee3p v\\u1edbi nhau \\u0111\\u1ec3 mang l\\u1ea1i cho Elantra v\\u1ebb th\\u1ec3 thao.<\\/p>\\r\\n\\r\\n<p><img alt=\\\"\\\" height=\\\"600\\\" loading=\\\"lazy\\\" sizes=\\\"(max-width: 1120px) 100vw, 1120px\\\" src=\\\"https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-mat-truoc-1.jpg\\\" srcset=\\\"https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-mat-truoc-1.jpg 1120w, https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-mat-truoc-1-300x161.jpg 300w, https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-mat-truoc-1-1024x549.jpg 1024w, https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-mat-truoc-1-768x411.jpg 768w\\\" width=\\\"1120\\\" \\/><\\/p>\\r\\n\\r\\n<table>\\r\\n\\t<tbody>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td>\\r\\n\\t\\t\\t<h3><img alt=\\\"\\\" height=\\\"233\\\" loading=\\\"lazy\\\" sizes=\\\"(max-width: 352px) 100vw, 352px\\\" src=\\\"https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-mat-truoc-2.jpg\\\" srcset=\\\"https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-mat-truoc-2.jpg 352w, https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-mat-truoc-2-300x199.jpg 300w\\\" width=\\\"352\\\" \\/><\\/h3>\\r\\n\\r\\n\\t\\t\\t<h3>\\u0110&egrave;n chi\\u1ebfu s&aacute;ng Halogen Projector<\\/h3>\\r\\n\\t\\t\\t<\\/td>\\r\\n\\t\\t\\t<td>\\r\\n\\t\\t\\t<h3><img alt=\\\"\\\" height=\\\"233\\\" loading=\\\"lazy\\\" sizes=\\\"(max-width: 352px) 100vw, 352px\\\" src=\\\"https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-mat-truoc-3.jpg\\\" srcset=\\\"https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-mat-truoc-3.jpg 352w, https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-mat-truoc-3-300x199.jpg 300w\\\" width=\\\"352\\\" \\/><\\/h3>\\r\\n\\r\\n\\t\\t\\t<h3>\\u0110&egrave;n chi\\u1ebfu s&aacute;ng Led Projector<br \\/>\\r\\n\\t\\t\\t&nbsp;<\\/h3>\\r\\n\\t\\t\\t<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t<\\/tbody>\\r\\n<\\/table>\\r\\n\\r\\n<p>M\\u1eb6T B&Ecirc;N<\\/p>\\r\\n\\r\\n<p><strong>B\\u1ec1 m\\u1eb7t &ldquo;Parametric Jewel&rdquo;<\\/strong><\\/p>\\r\\n\\r\\n<p>Ba ph\\u1ea7n xu\\u1ea5t hi\\u1ec7n t\\u1eeb ba \\u0111\\u01b0\\u1eddng k\\u1ebb \\u0111\\u1eadm c\\u1eaft nhau t\\u1ea1i m\\u1ed9t \\u0111i\\u1ec3m, t\\u1ea1o ra ba m&agrave;u &aacute;nh s&aacute;ng kh&aacute;c nhau.<\\/p>\\r\\n\\r\\n<p><img alt=\\\"\\\" height=\\\"600\\\" loading=\\\"lazy\\\" sizes=\\\"(max-width: 1120px) 100vw, 1120px\\\" src=\\\"https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-mat-ben-1.jpg\\\" srcset=\\\"https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-mat-ben-1.jpg 1120w, https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-mat-ben-1-300x161.jpg 300w, https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-mat-ben-1-1024x549.jpg 1024w, https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-mat-ben-1-768x411.jpg 768w\\\" width=\\\"1120\\\" \\/><\\/p>\\r\\n\\r\\n<table>\\r\\n\\t<tbody>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td>\\r\\n\\t\\t\\t<p><img alt=\\\"\\\" height=\\\"169\\\" loading=\\\"lazy\\\" src=\\\"https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-mat-ben-3.jpg\\\" width=\\\"256\\\" \\/><\\/p>\\r\\n\\r\\n\\t\\t\\t<h3>V&agrave;nh 16 Inch<\\/h3>\\r\\n\\t\\t\\t<\\/td>\\r\\n\\t\\t\\t<td>\\r\\n\\t\\t\\t<p><img alt=\\\"\\\" height=\\\"169\\\" loading=\\\"lazy\\\" src=\\\"https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-mat-ben-4.jpg\\\" width=\\\"256\\\" \\/><\\/p>\\r\\n\\r\\n\\t\\t\\t<h3>V&agrave;nh 17 Inch<\\/h3>\\r\\n\\t\\t\\t<\\/td>\\r\\n\\t\\t\\t<td>\\r\\n\\t\\t\\t<p><img alt=\\\"\\\" height=\\\"169\\\" loading=\\\"lazy\\\" sizes=\\\"(max-width: 264px) 100vw, 264px\\\" src=\\\"https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-mat-ben-2-300x192.jpg\\\" srcset=\\\"https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-mat-ben-2-300x192.jpg 300w, https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-mat-ben-2.jpg 560w\\\" width=\\\"264\\\" \\/><\\/p>\\r\\n\\r\\n\\t\\t\\t<h3>V&agrave;nh 18 Inch (N-Line)<\\/h3>\\r\\n\\t\\t\\t<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t<\\/tbody>\\r\\n<\\/table>\\r\\n\\r\\n<p>M\\u1eb6T SAU<\\/p>\\r\\n\\r\\n<p><strong>C\\u1ee5m \\u0111&egrave;n h\\u1eadu s\\u1eafc s\\u1ea3o \\u0111\\u1eb7c tr\\u01b0ng<\\/strong><\\/p>\\r\\n\\r\\n<p>C&aacute;nh l\\u01b0\\u1edbt gi&oacute; s\\u1eafc s\\u1ea3o t\\u1ea1i \\u0111u&ocirc;i xe v&agrave; c\\u1ee5m \\u0111&egrave;n h\\u1eadu t&iacute;ch h\\u1ee3p t\\u1ea5t c\\u1ea3 trong m\\u1ed9t &ndash; \\u0111\\u1ea1i di\\u1ec7n cho Hyundai v\\u1edbi thi\\u1ebft k\\u1ebf h&igrave;nh ch\\u1eef H ri&ecirc;ng bi\\u1ec7t &ndash; gi&uacute;p t\\u1ea1o ra m\\u1ed9t di\\u1ec7n m\\u1ea1o ph&iacute;a sau c&ocirc;ng ngh\\u1ec7 cao, t\\u01b0\\u01a1ng lai.<\\/p>\\r\\n\\r\\n<p><img alt=\\\"\\\" height=\\\"600\\\" loading=\\\"lazy\\\" sizes=\\\"(max-width: 1120px) 100vw, 1120px\\\" src=\\\"https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-mat-sau-1.jpg\\\" srcset=\\\"https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-mat-sau-1.jpg 1120w, https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-mat-sau-1-300x161.jpg 300w, https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-mat-sau-1-1024x549.jpg 1024w, https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-mat-sau-1-768x411.jpg 768w\\\" width=\\\"1120\\\" \\/><\\/p>\\r\\n\\r\\n<table>\\r\\n\\t<tbody>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td>\\r\\n\\t\\t\\t<p><img alt=\\\"\\\" height=\\\"233\\\" loading=\\\"lazy\\\" sizes=\\\"(max-width: 352px) 100vw, 352px\\\" src=\\\"https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-mat-sau-3.jpg\\\" srcset=\\\"https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-mat-sau-3.jpg 544w, https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-mat-sau-3-300x199.jpg 300w\\\" width=\\\"352\\\" \\/><\\/p>\\r\\n\\r\\n\\t\\t\\t<h3>C\\u1ee5m \\u0111&egrave;n h\\u1eadu d\\u1ea1ng LED (1.6 AT)<\\/h3>\\r\\n\\t\\t\\t<\\/td>\\r\\n\\t\\t\\t<td>\\r\\n\\t\\t\\t<p><img alt=\\\"\\\" height=\\\"233\\\" loading=\\\"lazy\\\" sizes=\\\"(max-width: 352px) 100vw, 352px\\\" src=\\\"https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-mat-sau-2.jpg\\\" srcset=\\\"https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-mat-sau-2.jpg 352w, https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-mat-sau-2-300x199.jpg 300w\\\" width=\\\"352\\\" \\/><\\/p>\\r\\n\\r\\n\\t\\t\\t<h3>C\\u1ee5m \\u0111&egrave;n h\\u1eadu d\\u1ea1ng LED (2.0 AT\\/ N Line)<\\/h3>\\r\\n\\t\\t\\t<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t<\\/tbody>\\r\\n<\\/table>\\r\\n<\\/section>\\r\\n\\r\\n<section data-element_type=\\\"section\\\" data-id=\\\"5618af37\\\" id=\\\"noithat\\\">\\r\\n<h3>N\\u1ed8I TH\\u1ea4T<\\/h3>\\r\\n\\r\\n<p><strong>Khoang l&aacute;i g\\u1ee3i c\\u1ea3m<\\/strong><\\/p>\\r\\n\\r\\n<p>Khoang l&aacute;i c\\u1ee7a All New Elantra gi\\u1ed1ng nh\\u01b0 bu\\u1ed3ng l&aacute;i c\\u1ee7a phi c&ocirc;ng. Gi&uacute;p ng\\u01b0\\u1eddi l&aacute;i ki\\u1ec3m so&aacute;t t\\u1ed1t h\\u01a1n v&agrave; d\\u1ec5 d&agrave;ng h\\u01a1n<\\/p>\\r\\n\\r\\n<p><img alt=\\\"\\\" height=\\\"801\\\" loading=\\\"lazy\\\" sizes=\\\"(max-width: 1200px) 100vw, 1200px\\\" src=\\\"https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-noi-that-2.jpg\\\" srcset=\\\"https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-noi-that-2.jpg 1200w, https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-noi-that-2-300x200.jpg 300w, https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-noi-that-2-1024x684.jpg 1024w, https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-noi-that-2-768x513.jpg 768w\\\" width=\\\"1200\\\" \\/><\\/p>\\r\\n\\r\\n<p><strong>Giao di\\u1ec7n tr\\u1ef1c quan<\\/strong><\\/p>\\r\\n\\r\\n<p>M&agrave;n h&igrave;nh th&ocirc;ng tin v&agrave; m&agrave;n h&igrave;nh gi\\u1ea3i tr&iacute; c&oacute; c&ugrave;ng k&iacute;ch th\\u01b0\\u1edbc 10,25&rdquo; mang \\u0111\\u1ebfn cho kh&aacute;ch h&agrave;ng tr\\u1ea3i nghi\\u1ec7m ho&agrave;n to&agrave;n \\u0111\\u1eafm ch&igrave;m trong c&ocirc;ng ngh\\u1ec7 cao c&ugrave;ng v\\u1edbi t\\u1ea7m nh&igrave;n to&agrave;n c\\u1ea3nh t&iacute;ch h\\u1ee3p li\\u1ec1n m\\u1ea1ch. Thi\\u1ebft k\\u1ebf m&agrave;n h&igrave;nh gi\\u1ea3i tr&iacute; nghi&ecirc;ng 10 \\u0111\\u1ed9 v\\u1ec1 ph&iacute;a ng\\u01b0\\u1eddi l&aacute;i \\u0111\\u1ec3 vi\\u1ec7c \\u0111i\\u1ec1u khi\\u1ec3n d\\u1ec5 d&agrave;ng h\\u01a1n v&agrave; tr\\u1ea3i nghi\\u1ec7m c&ocirc;ng ngh\\u1ec7 \\u0111\\u01b0\\u1ee3c tr\\u1ecdn v\\u1eb9n h\\u01a1n<\\/p>\\r\\n\\r\\n<p><img alt=\\\"\\\" height=\\\"600\\\" loading=\\\"lazy\\\" sizes=\\\"(max-width: 1120px) 100vw, 1120px\\\" src=\\\"https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-noi-that-1.jpg\\\" srcset=\\\"https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-noi-that-1.jpg 1120w, https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-noi-that-1-300x161.jpg 300w, https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-noi-that-1-1024x549.jpg 1024w, https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-noi-that-1-768x411.jpg 768w\\\" width=\\\"1120\\\" \\/><\\/p>\\r\\n<\\/section>\\r\\n\\r\\n<section data-element_type=\\\"section\\\" data-id=\\\"09f2b88\\\">\\r\\n<h2>V\\u1eacN H&Agrave;NH<\\/h2>\\r\\n\\r\\n<p><strong>D&agrave;nh cho nh\\u1eefng ng\\u01b0\\u1eddi tham v\\u1ecdng, t&aacute;o b\\u1ea1o c&ugrave;ng s\\u1ef1 phi th\\u01b0\\u1eddng<\\/strong><\\/p>\\r\\n\\r\\n<p>N\\u1ec1n t\\u1ea3ng th\\u1ebf h\\u1ec7 th\\u1ee9 3 m\\u1edbi \\u0111\\u01b0\\u1ee3c ph&aacute;t tri\\u1ec3n c\\u1ee7a Elantra mang l\\u1ea1i kh\\u1ea3 n\\u0103ng x\\u1eed l&yacute; nhanh nh\\u1eb9n v&agrave; \\u1ed5n \\u0111\\u1ecbnh \\u0111\\u01b0\\u1ee3c h\\u1ed7 tr\\u1ee3 b\\u1edfi \\u0111\\u1ed9ng c\\u01a1 ti\\u1ebft ki\\u1ec7m nhi&ecirc;n li\\u1ec7u, mang \\u0111\\u1ebfn cho b\\u1ea1n hi\\u1ec7u su\\u1ea5t l&aacute;i xe t\\u1ed1i \\u01b0u m\\u1ecdi l&uacute;c m\\u1ecdi n\\u01a1i.<\\/p>\\r\\n\\r\\n<p><img alt=\\\"\\\" height=\\\"700\\\" loading=\\\"lazy\\\" sizes=\\\"(max-width: 1120px) 100vw, 1120px\\\" src=\\\"https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-van-hanh.jpg\\\" srcset=\\\"https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-van-hanh.jpg 1120w, https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-van-hanh-300x188.jpg 300w, https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-van-hanh-1024x640.jpg 1024w, https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-van-hanh-768x480.jpg 768w\\\" width=\\\"1120\\\" \\/><\\/p>\\r\\n\\r\\n<p>&nbsp;<\\/p>\\r\\n\\r\\n<p><strong>\\u0110\\u1ed9ng c\\u01a1 Gamma 1.6<\\/strong><\\/p>\\r\\n\\r\\n<p><img alt=\\\"\\\" height=\\\"574\\\" loading=\\\"lazy\\\" sizes=\\\"(max-width: 1200px) 100vw, 1200px\\\" src=\\\"https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/Dong-co-G1.6.png\\\" srcset=\\\"https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/Dong-co-G1.6.png 1200w, https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/Dong-co-G1.6-300x144.png 300w, https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/Dong-co-G1.6-1024x490.png 1024w, https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/Dong-co-G1.6-768x367.png 768w\\\" width=\\\"1200\\\" \\/><\\/p>\\r\\n\\r\\n<p><strong>\\u0110\\u1ed9ng c\\u01a1 Nu 2.0 MPI<\\/strong><\\/p>\\r\\n\\r\\n<p><img alt=\\\"\\\" height=\\\"573\\\" loading=\\\"lazy\\\" sizes=\\\"(max-width: 1200px) 100vw, 1200px\\\" src=\\\"https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/G2.0-SmartStream.png\\\" srcset=\\\"https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/G2.0-SmartStream.png 1200w, https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/G2.0-SmartStream-300x143.png 300w, https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/G2.0-SmartStream-1024x489.png 1024w, https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/G2.0-SmartStream-768x367.png 768w\\\" width=\\\"1200\\\" \\/><\\/p>\\r\\n\\r\\n<p><strong>\\u0110\\u1ed9ng c\\u01a1 Smartstream G1.6 Turbo T-GDi<\\/strong><\\/p>\\r\\n\\r\\n<p><img alt=\\\"\\\" height=\\\"575\\\" loading=\\\"lazy\\\" sizes=\\\"(max-width: 1200px) 100vw, 1200px\\\" src=\\\"https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/Turbo.png\\\" srcset=\\\"https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/Turbo.png 1200w, https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/Turbo-300x144.png 300w, https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/Turbo-1024x491.png 1024w, https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/Turbo-768x368.png 768w\\\" width=\\\"1200\\\" \\/>&nbsp;<\\/p>\\r\\n<\\/section>\\r\\n\\r\\n<section data-element_type=\\\"section\\\" data-id=\\\"5f24b16\\\">\\r\\n<h2>AN TO&Agrave;N<\\/h2>\\r\\n\\r\\n<p><strong>H\\u1ec7 th\\u1ed1ng c&acirc;n b\\u1eb1ng \\u0111i\\u1ec7n t\\u1eed ESC<\\/strong><\\/p>\\r\\n\\r\\n<p>H\\u1ec7 th\\u1ed1ng c&acirc;n b\\u1eb1ng \\u0111i\\u1ec7n t\\u1eed ESC s\\u1ebd ph&aacute;t hi\\u1ec7n t&igrave;nh tr\\u1ea1ng m\\u1ea5t ki\\u1ec3m so&aacute;t c\\u1ee7a xe khi phanh hay chuy\\u1ec3n h\\u01b0\\u1edbng, \\u0111\\u1ed3ng th\\u1eddi s\\u1ebd c&oacute; nh\\u1eefng t&aacute;c \\u0111\\u1ed9ng k\\u1ecbp th\\u1eddi l&ecirc;n h\\u1ec7 th\\u1ed1ng phanh v&agrave; truy\\u1ec1n \\u0111\\u1ed9ng gi&uacute;p chi\\u1ebfc xe nhanh ch&oacute;ng c&oacute; l\\u1ea1i \\u0111\\u01b0\\u1ee3c t&igrave;nh tr\\u1ea1ng c&acirc;n b\\u1eb1ng v&agrave; an to&agrave;n.<\\/p>\\r\\n\\r\\n<p><img alt=\\\"\\\" height=\\\"621\\\" loading=\\\"lazy\\\" sizes=\\\"(max-width: 1430px) 100vw, 1430px\\\" src=\\\"https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-esc.jpg\\\" srcset=\\\"https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-esc.jpg 1430w, https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-esc-300x130.jpg 300w, https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-esc-1024x445.jpg 1024w, https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-esc-768x334.jpg 768w\\\" width=\\\"1430\\\" \\/><\\/p>\\r\\n\\r\\n<p>&nbsp;<\\/p>\\r\\n\\r\\n<p><strong>H\\u1ec7 th\\u1ed1ng h\\u1ed7 tr\\u1ee3 kh\\u1edfi h&agrave;nh ngang d\\u1ed1c HAC<\\/strong><\\/p>\\r\\n\\r\\n<p>H\\u1ec7 th\\u1ed1ng HAC s\\u1ebd gi&uacute;p chi\\u1ebfc xe gi\\u1eef nguy&ecirc;n v\\u1ecb tr&iacute; \\u0111ang d\\u1eebng khi xe \\u0111\\u1ed7 \\u1edf ngang d\\u1ed1c, xe s\\u1ebd di chuy\\u1ec3n khi t&agrave;i x\\u1ebf chuy\\u1ec3n sang b&agrave;n \\u0111\\u1ea1p ga gi&uacute;p b\\u1ea1n d\\u1ec5 d&agrave;ng ti\\u1ebfp t\\u1ee5c cu\\u1ed9c h&agrave;nh tr&igrave;nh m&agrave; kh&ocirc;ng lo xe b\\u1ecb t\\u1ee5t d\\u1ed1c.<br \\/>\\r\\n&nbsp;<img alt=\\\"\\\" height=\\\"439\\\" loading=\\\"lazy\\\" sizes=\\\"(max-width: 1430px) 100vw, 1430px\\\" src=\\\"https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-hac.jpg\\\" srcset=\\\"https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-hac.jpg 1430w, https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-hac-300x92.jpg 300w, https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-hac-1024x314.jpg 1024w, https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-hac-768x236.jpg 768w\\\" width=\\\"1430\\\" \\/><\\/p>\\r\\n\\r\\n<p><strong>H\\u1ec7 th\\u1ed1ng ch\\u1ed1ng b&oacute; c\\u1ee9ng phanh ABS<\\/strong><\\/p>\\r\\n\\r\\n<p>H\\u1ec7 th\\u1ed1ng ch\\u1ed1ng b&oacute; c\\u1ee9ng phanh ABS bao g\\u1ed3m c&aacute;c c\\u1ea3m bi\\u1ebfn \\u0111i\\u1ec1u ti\\u1ebft l\\u1ef1c phanh c\\u1ee7a b\\u1ea1n t&aacute;c \\u0111\\u1ed9ng l&ecirc;n \\u0111\\u0129a phanh, gi&uacute;p gi\\u1ea3m t\\u1ed1c nhanh ch&oacute;ng nh\\u01b0ng v\\u1eabn \\u0111\\u1ea3m b\\u1ea3o h\\u01b0\\u1edbng \\u0111&aacute;nh l&aacute;i c\\u1ee7a v&ocirc; l\\u0103ng gi&uacute;p xe \\u0111i \\u0111&uacute;ng h\\u01b0\\u1edbng tr&aacute;nh va ch\\u1ea1m.<br \\/>\\r\\n<img alt=\\\"\\\" height=\\\"579\\\" loading=\\\"lazy\\\" sizes=\\\"(max-width: 1430px) 100vw, 1430px\\\" src=\\\"https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-abs.jpg\\\" srcset=\\\"https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-abs.jpg 1430w, https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-abs-300x121.jpg 300w, https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-abs-1024x415.jpg 1024w, https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-abs-768x311.jpg 768w\\\" width=\\\"1430\\\" \\/><\\/p>\\r\\n\\r\\n<table>\\r\\n\\t<tbody>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td>\\r\\n\\t\\t\\t<p><img alt=\\\"\\\" height=\\\"179\\\" loading=\\\"lazy\\\" sizes=\\\"(max-width: 270px) 100vw, 270px\\\" src=\\\"https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-khung-thep-cuong-luc-ahss.jpg\\\" srcset=\\\"https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-khung-thep-cuong-luc-ahss.jpg 544w, https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-khung-thep-cuong-luc-ahss-300x199.jpg 300w\\\" width=\\\"270\\\" \\/><\\/p>\\r\\n\\r\\n\\t\\t\\t<p><strong>Khung th&eacute;p c\\u01b0\\u1eddng l\\u1ef1c (AHSS)<\\/strong><\\/p>\\r\\n\\t\\t\\t<\\/td>\\r\\n\\t\\t\\t<td>\\r\\n\\t\\t\\t<p><img alt=\\\"\\\" height=\\\"179\\\" loading=\\\"lazy\\\" sizes=\\\"(max-width: 375px) 100vw, 375px\\\" src=\\\"https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-phanh-tay-dien-tu.jpg\\\" srcset=\\\"https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-phanh-tay-dien-tu.jpg 375w, https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-phanh-tay-dien-tu-300x143.jpg 300w\\\" width=\\\"375\\\" \\/><\\/p>\\r\\n\\r\\n\\t\\t\\t<p><strong>Phanh tay \\u0111i\\u1ec7n t\\u1eed<\\/strong><\\/p>\\r\\n\\t\\t\\t<\\/td>\\r\\n\\t\\t\\t<td>\\r\\n\\t\\t\\t<p><img alt=\\\"\\\" height=\\\"179\\\" loading=\\\"lazy\\\" sizes=\\\"(max-width: 288px) 100vw, 288px\\\" src=\\\"https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-camera-lui.jpg\\\" srcset=\\\"https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-camera-lui.jpg 375w, https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-camera-lui-300x186.jpg 300w\\\" width=\\\"288\\\" \\/><\\/p>\\r\\n\\r\\n\\t\\t\\t<p><strong>C\\u1ea3m bi\\u1ebfn l&ugrave;i<\\/strong><\\/p>\\r\\n\\t\\t\\t<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t<\\/tbody>\\r\\n<\\/table>\\r\\n<\\/section>\\r\\n\\r\\n<section data-element_type=\\\"section\\\" data-id=\\\"2c96fca\\\">\\r\\n<h2>TI\\u1ec6N NGHI<\\/h2>\\r\\n\\r\\n<table>\\r\\n\\t<tbody>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td>\\r\\n\\t\\t\\t<p><img alt=\\\"\\\" height=\\\"436\\\" loading=\\\"lazy\\\" sizes=\\\"(max-width: 580px) 100vw, 580px\\\" src=\\\"https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-tien-nghi-1.jpg\\\" srcset=\\\"https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-tien-nghi-1.jpg 580w, https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-tien-nghi-1-300x226.jpg 300w\\\" width=\\\"580\\\" \\/><\\/p>\\r\\n\\r\\n\\t\\t\\t<p><strong>M&agrave;n h&igrave;nh th&ocirc;ng tin Full LCD 10.25 inch<\\/strong><\\/p>\\r\\n\\t\\t\\t<\\/td>\\r\\n\\t\\t\\t<td>\\r\\n\\t\\t\\t<p><img alt=\\\"\\\" height=\\\"436\\\" loading=\\\"lazy\\\" sizes=\\\"(max-width: 580px) 100vw, 580px\\\" src=\\\"https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-tien-nghi-2.jpg\\\" srcset=\\\"https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-tien-nghi-2.jpg 580w, https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-tien-nghi-2-300x226.jpg 300w\\\" width=\\\"580\\\" \\/><\\/p>\\r\\n\\r\\n\\t\\t\\t<p><strong>M&agrave;n h&igrave;nh gi\\u1ea3i tr&iacute; 10.25 inch<\\/strong><\\/p>\\r\\n\\t\\t\\t<\\/td>\\r\\n\\t\\t\\t<td>\\r\\n\\t\\t\\t<p><img alt=\\\"\\\" height=\\\"406\\\" loading=\\\"lazy\\\" sizes=\\\"(max-width: 580px) 100vw, 580px\\\" src=\\\"https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-tien-nghi-3.jpg\\\" srcset=\\\"https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-tien-nghi-3.jpg 580w, https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-tien-nghi-3-300x210.jpg 300w\\\" width=\\\"580\\\" \\/><\\/p>\\r\\n\\r\\n\\t\\t\\t<p><strong>\\u0110i\\u1ec1u h&ograve;a t\\u1ef1 \\u0111\\u1ed9ng 2 v&ugrave;ng \\u0111\\u1ed9c l\\u1eadp<\\/strong><\\/p>\\r\\n\\t\\t\\t<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t<\\/tbody>\\r\\n<\\/table>\\r\\n\\r\\n<table>\\r\\n\\t<tbody>\\r\\n\\t\\t<tr>\\r\\n\\t\\t\\t<td>\\r\\n\\t\\t\\t<p><img alt=\\\"\\\" height=\\\"411\\\" loading=\\\"lazy\\\" sizes=\\\"(max-width: 580px) 100vw, 580px\\\" src=\\\"https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-tien-nghi-4.jpg\\\" srcset=\\\"https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-tien-nghi-4.jpg 580w, https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-tien-nghi-4-300x213.jpg 300w\\\" width=\\\"580\\\" \\/><\\/p>\\r\\n\\r\\n\\t\\t\\t<p><strong>L&agrave;m m&aacute;t v&agrave; s\\u01b0\\u1edfi h&agrave;ng gh\\u1ebf tr\\u01b0\\u1edbc<\\/strong>&nbsp;<\\/p>\\r\\n\\t\\t\\t<\\/td>\\r\\n\\t\\t\\t<td>\\r\\n\\t\\t\\t<p><img alt=\\\"\\\" height=\\\"436\\\" loading=\\\"lazy\\\" sizes=\\\"(max-width: 580px) 100vw, 580px\\\" src=\\\"https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-tien-nghi-5.jpg\\\" srcset=\\\"https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-tien-nghi-5.jpg 580w, https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra-2023-tien-nghi-5-300x226.jpg 300w\\\" width=\\\"580\\\" \\/><\\/p>\\r\\n\\r\\n\\t\\t\\t<p><strong>S\\u1ea1c kh&ocirc;ng d&acirc;y<\\/strong><\\/p>\\r\\n\\t\\t\\t<\\/td>\\r\\n\\t\\t<\\/tr>\\r\\n\\t<\\/tbody>\\r\\n<\\/table>\\r\\n\\r\\n<p>&nbsp;<\\/p>\\r\\n<\\/section>\\r\\n\\r\\n<section data-element_type=\\\"section\\\" data-id=\\\"fc6860a\\\" id=\\\"thongso\\\">\\r\\n<h3>Th&ocirc;ng S\\u1ed1 Hyundai Elantra<\\/h3>\\r\\n\\r\\n<p><img alt=\\\"\\\" height=\\\"1075\\\" loading=\\\"lazy\\\" sizes=\\\"(max-width: 1520px) 100vw, 1520px\\\" src=\\\"https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra2023.jpg\\\" srcset=\\\"https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra2023.jpg 1520w, https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra2023-300x212.jpg 300w, https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra2023-1024x724.jpg 1024w, https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra2023-768x543.jpg 768w, https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra2023-1536x1086.jpg 1536w, https:\\/\\/vn-hyundai.com\\/wp-content\\/uploads\\/2022\\/10\\/elantra2023-2048x1448.jpg 2048w\\\" width=\\\"1520\\\" \\/><\\/p>\\r\\n<\\/section>\"}]', NULL, '{\"main\":\"\\/storage\\/hyundai\\/elantra\\/logo-elantra.png\"}', 1, 1, 1, '[\"1\",\"3\",\"7\"]', '{\"4\":{\"43\":\"4-mau-sac-trang\",\"44\":\"4-mau-sac-den\",\"45\":\"4-mau-sac-do\",\"48\":\"4-mau-sac-xam-titan\",\"49\":\"4-mau-sac-vang-ghi\",\"52\":\"4-mau-sac-xanh-duong\"},\"56\":{\"60\":\"56-phien-ban-elantra-16at-tieu-chuan\",\"61\":\"56-phien-ban-elantra-16at-dac-biet\",\"62\":\"56-phien-ban-elantra-20at-cao-cap\",\"63\":\"56-phien-ban-elantra-16at-nline\"}}', NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, '2023-11-10 02:14:03', '2023-11-16 08:50:51', 0, 12);

-- --------------------------------------------------------

--
-- Table structure for table `product_attributes`
--

CREATE TABLE `product_attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `key` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_attributes`
--

INSERT INTO `product_attributes` (`id`, `name`, `key`, `description`, `parent_id`, `created_at`, `updated_at`) VALUES
(3, 'Phiên Bản - Creta', 'phien-ban-creta', '', NULL, '2023-11-09 03:05:58', '2023-11-09 03:05:58'),
(4, 'Màu sắc', 'mau-sac', '', NULL, '2023-11-09 03:06:05', '2023-11-09 03:06:05'),
(7, 'Tiêu Chuẩn', '3-phien-ban-creta-tieu-chuan', 'Tiêu Chuẩn ', 3, '2023-11-09 03:06:38', '2023-11-09 03:06:38'),
(8, 'Đặc Biệt', '3-phien-ban-creta-dac-biet', 'Đặc Biệt ', 3, '2023-11-09 03:06:38', '2023-11-09 03:06:38'),
(9, 'Cao Cấp', '3-phien-ban-creta-cao-cap', 'Cao Cấp ', 3, '2023-11-09 03:06:38', '2023-11-09 03:06:38'),
(24, 'Phiên Bản - Santafe', 'phien-ban-santafe', '', NULL, '2023-11-09 05:54:05', '2023-11-09 05:54:05'),
(25, 'Phiên Bản - Custin', 'phien-ban-custin', '', NULL, '2023-11-09 05:54:05', '2023-11-09 05:54:05'),
(26, 'Phiên Bản - Accent', 'phien-ban-accent', '', NULL, '2023-11-09 05:54:05', '2023-11-09 05:54:05'),
(35, 'Xăng 2.4 Thường', '24-phien-ban-santafe-xang-24-thuong', 'Xăng 2.4 Thường ', 24, '2023-11-09 06:08:37', '2023-11-09 06:08:37'),
(36, 'Xăng 2.4 Premium', '24-phien-ban-santafe-xang-24-premium', 'Xăng 2.4 Premium ', 24, '2023-11-09 06:08:37', '2023-11-09 06:08:37'),
(37, 'Dầu 2.2 Thường', '24-phien-ban-santafe-dau-22-thuong', 'Dầu 2.2 Thường ', 24, '2023-11-09 06:08:37', '2023-11-09 06:08:37'),
(38, 'Dầu 2.2 Premium', '24-phien-ban-santafe-dau-22-premium', 'Dầu 2.2 Premium ', 24, '2023-11-09 06:08:37', '2023-11-09 06:08:37'),
(39, 'Phiên Bản - Vios', 'phien-ban-vios', '', NULL, '2023-11-09 06:41:29', '2023-11-09 06:41:29'),
(40, '1.5E-MT', '39-phien-ban-vios-15e-mt', '1.5E-MT ', 39, '2023-11-09 06:41:51', '2023-11-09 06:41:51'),
(41, '1.5E-CVT', '39-phien-ban-vios-15e-cvt', '1.5E-CVT ', 39, '2023-11-09 06:41:51', '2023-11-09 06:41:51'),
(42, '1.5G-CVT', '39-phien-ban-vios-15g-cvt', '1.5G-CVT ', 39, '2023-11-09 06:41:51', '2023-11-09 06:41:51'),
(43, 'Trắng', '4-mau-sac-trang', 'Trắng ', 4, '2023-11-09 06:49:56', '2023-11-09 06:49:56'),
(44, 'Đen', '4-mau-sac-den', 'Đen ', 4, '2023-11-09 06:49:56', '2023-11-09 06:49:56'),
(45, 'Đỏ', '4-mau-sac-do', 'Đỏ ', 4, '2023-11-09 06:49:56', '2023-11-09 06:49:56'),
(46, 'Bạc', '4-mau-sac-bac', 'Bạc ', 4, '2023-11-09 06:49:56', '2023-11-09 06:49:56'),
(47, 'Vàng Cát', '4-mau-sac-vang-cat', 'Vàng Cát ', 4, '2023-11-09 06:49:56', '2023-11-09 06:49:56'),
(48, 'Xám Titan', '4-mau-sac-xam-titan', 'Xám Titan ', 4, '2023-11-09 06:49:56', '2023-11-09 06:49:56'),
(49, 'Vàng Ghi', '4-mau-sac-vang-ghi', 'Vàng Ghi ', 4, '2023-11-09 06:49:56', '2023-11-09 06:49:56'),
(50, 'Trắng Ngọc Trai', '4-mau-sac-trang-ngoc-trai', 'Trắng Ngọc Trai ', 4, '2023-11-09 06:49:56', '2023-11-09 06:49:56'),
(51, 'Xanh Đại Dương', '4-mau-sac-xanh-dai-duong', 'Xanh Đại Dương ', 4, '2023-11-09 06:49:56', '2023-11-09 06:49:56'),
(52, 'Xanh Dương', '4-mau-sac-xanh-duong', 'Xanh Dương ', 4, '2023-11-09 06:49:56', '2023-11-09 06:49:56'),
(53, 'Xanh Rêu', '4-mau-sac-xanh-reu', 'Xanh Rêu ', 4, '2023-11-09 06:49:56', '2023-11-09 06:49:56'),
(54, 'Xanh Ngọc', '4-mau-sac-xanh-ngoc', 'Xanh Ngọc ', 4, '2023-11-09 06:49:56', '2023-11-09 06:49:56'),
(55, 'Nâu Ánh Vàng', '4-mau-sac-nau-anh-vang', 'Nâu Ánh Vàng ', 4, '2023-11-09 06:49:56', '2023-11-09 06:49:56'),
(56, 'Phiên Bản - Elantra', 'phien-ban-elantra', '', NULL, '2023-11-10 02:14:52', '2023-11-10 02:14:52'),
(60, '1.6AT Tiêu Chuẩn', '56-phien-ban-elantra-16at-tieu-chuan', '1.6AT Tiêu Chuẩn ', 56, '2023-11-10 02:16:05', '2023-11-10 02:16:05'),
(61, '1.6AT Đặc Biệt', '56-phien-ban-elantra-16at-dac-biet', '1.6AT Đặc Biệt ', 56, '2023-11-10 02:16:05', '2023-11-10 02:16:05'),
(62, '2.0AT Cao Cấp', '56-phien-ban-elantra-20at-cao-cap', '2.0AT Cao Cấp ', 56, '2023-11-10 02:16:05', '2023-11-10 02:16:05'),
(63, '1.6AT NLine', '56-phien-ban-elantra-16at-nline', '1.6AT NLine ', 56, '2023-11-10 02:16:05', '2023-11-10 02:16:05');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `banner` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `level` int(11) NOT NULL DEFAULT 0,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` longtext DEFAULT NULL,
  `meta_keyword` longtext DEFAULT NULL,
  `canonical` longtext DEFAULT NULL,
  `seo_preview` longtext DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `home_name` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `name`, `slug`, `banner`, `description`, `content`, `image`, `status`, `level`, `meta_title`, `meta_description`, `meta_keyword`, `canonical`, `seo_preview`, `parent_id`, `deleted_at`, `created_at`, `updated_at`, `home_name`, `type`) VALUES
(1, 'Hyundai', 'hyundai', '', '', '[]', '/storage/logo-hyundai.png', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-11-09 03:04:19', '2023-11-16 08:46:17', 'Hyundai', 'Thương hiệu'),
(2, 'CUV', 'cuv', '', '', '[]', '', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-11-09 03:04:45', '2023-11-16 08:55:27', 'CUV', 'Kiểu dáng'),
(3, 'Xe 5 chỗ', 'xe-5-cho', '', '', '[]', '', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-11-09 05:23:50', '2023-11-16 08:45:26', 'Xe 5 chỗ', 'Số chỗ ngồi'),
(4, 'Xe 7 chỗ', 'xe-7-cho', '', '', '[]', '', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-11-09 05:49:23', '2023-11-16 08:45:16', 'Xe 7 chỗ', 'Số chỗ ngồi'),
(5, 'SUV', 'suv', '', '', '[]', '', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-11-09 05:49:36', '2023-11-16 08:43:59', 'SUV', 'Kiểu dáng'),
(6, 'Toyota', 'toyota', '', 'Toyota là một trong những thương hiệu ô tô hàng đầu trên toàn cầu, với lịch sử lâu dài và uy tín vững chắc trong ngành công nghiệp ô tô. Được thành lập từ những năm đầu của thế kỷ 20 tại Nhật Bản, Toyota nổi tiếng với sự cam kết với chất lượng, sáng tạo và tiên phong trong việc phát triển công nghệ ô tô.\r\n\r\nVới một loạt các mẫu xe đa dạng từ xe hơi tiết kiệm nhiên liệu đến xe thể thao, Toyota luôn chú trọng đến việc cung cấp sản phẩm an toàn, đáng tin cậy và hiệu quả. Sứ mệnh của họ không chỉ dừng lại ở việc sản xuất các dòng xe chất lượng mà còn trong việc thúc đẩy sự tiến bộ thông qua các giải pháp công nghệ và sáng tạo, từ việc sản xuất xe chạy bằng điện đến nghiên cứu về xe tự lái.\r\n\r\nVới tầm nhìn và cam kết vững chắc với môi trường, Toyota không chỉ là một thương hiệu xe hơi mà còn là một người đồng đội của cộng đồng toàn cầu, luôn nỗ lực để tạo ra một tương lai bền vững hơn cho mọi người. Điều này đã cùng nhau định hình hình ảnh của Toyota không chỉ là một doanh nghiệp hàng đầu mà còn là một đối tác xã hội có trách nhiệm.', '[]', '/storage/logo-toyota.jpg', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-11-09 06:39:43', '2023-11-16 08:43:49', 'Toyota', 'Thương hiệu'),
(7, 'Sedan', 'sedan', '', '', '[]', '', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-11-09 06:39:58', '2023-11-16 08:44:07', 'Sedan', 'Kiểu dáng'),
(8, 'MPV', 'mpv', '', '', '[]', '', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-11-09 06:40:13', '2023-11-16 08:42:32', 'MPV', 'Kiểu dáng');

-- --------------------------------------------------------

--
-- Table structure for table `product_values`
--

CREATE TABLE `product_values` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `attribute_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `value` longtext DEFAULT NULL,
  `attribute_key` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_values`
--

INSERT INTO `product_values` (`id`, `attribute_id`, `product_id`, `value`, `attribute_key`) VALUES
(13, 3, 7, 'Tiêu Chuẩn', '3-phien-ban-creta-tieu-chuan'),
(14, 4, 7, 'Trắng', '4-mau-sac-trang'),
(15, 3, 8, 'Tiêu Chuẩn', '3-phien-ban-creta-tieu-chuan'),
(16, 4, 8, 'Đen', '4-mau-sac-den'),
(17, 3, 9, 'Tiêu Chuẩn', '3-phien-ban-creta-tieu-chuan'),
(18, 4, 9, 'Đỏ', '4-mau-sac-do'),
(19, 3, 10, 'Tiêu Chuẩn', '3-phien-ban-creta-tieu-chuan'),
(20, 4, 10, 'Bạc', '4-mau-sac-bac'),
(21, 3, 11, 'Tiêu Chuẩn', '3-phien-ban-creta-tieu-chuan'),
(22, 4, 11, 'Xám Titan', '4-mau-sac-xam-titan'),
(23, 3, 12, 'Tiêu Chuẩn', '3-phien-ban-creta-tieu-chuan'),
(24, 4, 12, 'Xanh Dương', '4-mau-sac-xanh-duong'),
(25, 3, 13, 'Đặc Biệt', '3-phien-ban-creta-dac-biet'),
(26, 4, 13, 'Trắng', '4-mau-sac-trang'),
(27, 3, 14, 'Đặc Biệt', '3-phien-ban-creta-dac-biet'),
(28, 4, 14, 'Đen', '4-mau-sac-den'),
(29, 3, 15, 'Đặc Biệt', '3-phien-ban-creta-dac-biet'),
(30, 4, 15, 'Đỏ', '4-mau-sac-do'),
(31, 3, 16, 'Đặc Biệt', '3-phien-ban-creta-dac-biet'),
(32, 4, 16, 'Bạc', '4-mau-sac-bac'),
(33, 3, 17, 'Đặc Biệt', '3-phien-ban-creta-dac-biet'),
(34, 4, 17, 'Xám Titan', '4-mau-sac-xam-titan'),
(35, 3, 18, 'Đặc Biệt', '3-phien-ban-creta-dac-biet'),
(36, 4, 18, 'Xanh Dương', '4-mau-sac-xanh-duong'),
(37, 3, 19, 'Cao Cấp', '3-phien-ban-creta-cao-cap'),
(38, 4, 19, 'Trắng', '4-mau-sac-trang'),
(39, 3, 20, 'Cao Cấp', '3-phien-ban-creta-cao-cap'),
(40, 4, 20, 'Đen', '4-mau-sac-den'),
(41, 3, 21, 'Cao Cấp', '3-phien-ban-creta-cao-cap'),
(42, 4, 21, 'Đỏ', '4-mau-sac-do'),
(43, 3, 22, 'Cao Cấp', '3-phien-ban-creta-cao-cap'),
(44, 4, 22, 'Bạc', '4-mau-sac-bac'),
(45, 3, 23, 'Cao Cấp', '3-phien-ban-creta-cao-cap'),
(46, 4, 23, 'Xám Titan', '4-mau-sac-xam-titan'),
(47, 3, 24, 'Cao Cấp', '3-phien-ban-creta-cao-cap'),
(48, 4, 24, 'Xanh Dương', '4-mau-sac-xanh-duong'),
(109, 4, 55, 'Trắng', '4-mau-sac-trang'),
(110, 24, 55, 'Xăng 2.4 Thường', '24-phien-ban-santafe-xang-24-thuong'),
(111, 4, 56, 'Trắng', '4-mau-sac-trang'),
(112, 24, 56, 'Xăng 2.4 Premium', '24-phien-ban-santafe-xang-24-premium'),
(113, 4, 57, 'Trắng', '4-mau-sac-trang'),
(114, 24, 57, 'Dầu 2.2 Thường', '24-phien-ban-santafe-dau-22-thuong'),
(115, 4, 58, 'Trắng', '4-mau-sac-trang'),
(116, 24, 58, 'Dầu 2.2 Premium', '24-phien-ban-santafe-dau-22-premium'),
(117, 4, 59, 'Đen', '4-mau-sac-den'),
(118, 24, 59, 'Xăng 2.4 Thường', '24-phien-ban-santafe-xang-24-thuong'),
(119, 4, 60, 'Đen', '4-mau-sac-den'),
(120, 24, 60, 'Xăng 2.4 Premium', '24-phien-ban-santafe-xang-24-premium'),
(121, 4, 61, 'Đen', '4-mau-sac-den'),
(122, 24, 61, 'Dầu 2.2 Thường', '24-phien-ban-santafe-dau-22-thuong'),
(123, 4, 62, 'Đen', '4-mau-sac-den'),
(124, 24, 62, 'Dầu 2.2 Premium', '24-phien-ban-santafe-dau-22-premium'),
(125, 4, 63, 'Đỏ', '4-mau-sac-do'),
(126, 24, 63, 'Xăng 2.4 Thường', '24-phien-ban-santafe-xang-24-thuong'),
(127, 4, 64, 'Đỏ', '4-mau-sac-do'),
(128, 24, 64, 'Xăng 2.4 Premium', '24-phien-ban-santafe-xang-24-premium'),
(129, 4, 65, 'Đỏ', '4-mau-sac-do'),
(130, 24, 65, 'Dầu 2.2 Thường', '24-phien-ban-santafe-dau-22-thuong'),
(131, 4, 66, 'Đỏ', '4-mau-sac-do'),
(132, 24, 66, 'Dầu 2.2 Premium', '24-phien-ban-santafe-dau-22-premium'),
(133, 4, 67, 'Bạc', '4-mau-sac-bac'),
(134, 24, 67, 'Xăng 2.4 Thường', '24-phien-ban-santafe-xang-24-thuong'),
(135, 4, 68, 'Bạc', '4-mau-sac-bac'),
(136, 24, 68, 'Xăng 2.4 Premium', '24-phien-ban-santafe-xang-24-premium'),
(137, 4, 69, 'Bạc', '4-mau-sac-bac'),
(138, 24, 69, 'Dầu 2.2 Thường', '24-phien-ban-santafe-dau-22-thuong'),
(139, 4, 70, 'Bạc', '4-mau-sac-bac'),
(140, 24, 70, 'Dầu 2.2 Premium', '24-phien-ban-santafe-dau-22-premium'),
(141, 4, 71, 'Vàng Cát', '4-mau-sac-vang-cat'),
(142, 24, 71, 'Xăng 2.4 Thường', '24-phien-ban-santafe-xang-24-thuong'),
(143, 4, 72, 'Vàng Cát', '4-mau-sac-vang-cat'),
(144, 24, 72, 'Xăng 2.4 Premium', '24-phien-ban-santafe-xang-24-premium'),
(145, 4, 73, 'Vàng Cát', '4-mau-sac-vang-cat'),
(146, 24, 73, 'Dầu 2.2 Thường', '24-phien-ban-santafe-dau-22-thuong'),
(147, 4, 74, 'Vàng Cát', '4-mau-sac-vang-cat'),
(148, 24, 74, 'Dầu 2.2 Premium', '24-phien-ban-santafe-dau-22-premium'),
(149, 4, 75, 'Xanh Đại Dương', '4-mau-sac-xanh-dai-duong'),
(150, 24, 75, 'Xăng 2.4 Thường', '24-phien-ban-santafe-xang-24-thuong'),
(151, 4, 76, 'Xanh Đại Dương', '4-mau-sac-xanh-dai-duong'),
(152, 24, 76, 'Xăng 2.4 Premium', '24-phien-ban-santafe-xang-24-premium'),
(153, 4, 77, 'Xanh Đại Dương', '4-mau-sac-xanh-dai-duong'),
(154, 24, 77, 'Dầu 2.2 Thường', '24-phien-ban-santafe-dau-22-thuong'),
(155, 4, 78, 'Xanh Đại Dương', '4-mau-sac-xanh-dai-duong'),
(156, 24, 78, 'Dầu 2.2 Premium', '24-phien-ban-santafe-dau-22-premium'),
(157, 4, 79, 'Trắng', '4-mau-sac-trang'),
(158, 39, 79, '1.5E-MT', '39-phien-ban-vios-15e-mt'),
(159, 4, 80, 'Trắng', '4-mau-sac-trang'),
(160, 39, 80, '1.5E-CVT', '39-phien-ban-vios-15e-cvt'),
(161, 4, 81, 'Trắng', '4-mau-sac-trang'),
(162, 39, 81, '1.5G-CVT', '39-phien-ban-vios-15g-cvt'),
(163, 4, 82, 'Đen', '4-mau-sac-den'),
(164, 39, 82, '1.5E-MT', '39-phien-ban-vios-15e-mt'),
(165, 4, 83, 'Đen', '4-mau-sac-den'),
(166, 39, 83, '1.5E-CVT', '39-phien-ban-vios-15e-cvt'),
(167, 4, 84, 'Đen', '4-mau-sac-den'),
(168, 39, 84, '1.5G-CVT', '39-phien-ban-vios-15g-cvt'),
(169, 4, 85, 'Đỏ', '4-mau-sac-do'),
(170, 39, 85, '1.5E-MT', '39-phien-ban-vios-15e-mt'),
(171, 4, 86, 'Đỏ', '4-mau-sac-do'),
(172, 39, 86, '1.5E-CVT', '39-phien-ban-vios-15e-cvt'),
(173, 4, 87, 'Đỏ', '4-mau-sac-do'),
(174, 39, 87, '1.5G-CVT', '39-phien-ban-vios-15g-cvt'),
(175, 4, 88, 'Bạc', '4-mau-sac-bac'),
(176, 39, 88, '1.5E-MT', '39-phien-ban-vios-15e-mt'),
(177, 4, 89, 'Bạc', '4-mau-sac-bac'),
(178, 39, 89, '1.5E-CVT', '39-phien-ban-vios-15e-cvt'),
(179, 4, 90, 'Bạc', '4-mau-sac-bac'),
(180, 39, 90, '1.5G-CVT', '39-phien-ban-vios-15g-cvt'),
(181, 4, 91, 'Trắng Ngọc Trai', '4-mau-sac-trang-ngoc-trai'),
(182, 39, 91, '1.5E-MT', '39-phien-ban-vios-15e-mt'),
(183, 4, 92, 'Trắng Ngọc Trai', '4-mau-sac-trang-ngoc-trai'),
(184, 39, 92, '1.5E-CVT', '39-phien-ban-vios-15e-cvt'),
(185, 4, 93, 'Trắng Ngọc Trai', '4-mau-sac-trang-ngoc-trai'),
(186, 39, 93, '1.5G-CVT', '39-phien-ban-vios-15g-cvt'),
(187, 4, 94, 'Nâu Ánh Vàng', '4-mau-sac-nau-anh-vang'),
(188, 39, 94, '1.5E-MT', '39-phien-ban-vios-15e-mt'),
(189, 4, 95, 'Nâu Ánh Vàng', '4-mau-sac-nau-anh-vang'),
(190, 39, 95, '1.5E-CVT', '39-phien-ban-vios-15e-cvt'),
(191, 4, 96, 'Nâu Ánh Vàng', '4-mau-sac-nau-anh-vang'),
(192, 39, 96, '1.5G-CVT', '39-phien-ban-vios-15g-cvt'),
(193, 4, 97, 'Trắng', '4-mau-sac-trang'),
(194, 56, 97, '1.6AT Tiêu Chuẩn', '56-phien-ban-elantra-16at-tieu-chuan'),
(195, 4, 98, 'Trắng', '4-mau-sac-trang'),
(196, 56, 98, '1.6AT Đặc Biệt', '56-phien-ban-elantra-16at-dac-biet'),
(197, 4, 99, 'Trắng', '4-mau-sac-trang'),
(198, 56, 99, '2.0AT Cao Cấp', '56-phien-ban-elantra-20at-cao-cap'),
(199, 4, 100, 'Trắng', '4-mau-sac-trang'),
(200, 56, 100, '1.6AT NLine', '56-phien-ban-elantra-16at-nline'),
(201, 4, 101, 'Đen', '4-mau-sac-den'),
(202, 56, 101, '1.6AT Tiêu Chuẩn', '56-phien-ban-elantra-16at-tieu-chuan'),
(203, 4, 102, 'Đen', '4-mau-sac-den'),
(204, 56, 102, '1.6AT Đặc Biệt', '56-phien-ban-elantra-16at-dac-biet'),
(205, 4, 103, 'Đen', '4-mau-sac-den'),
(206, 56, 103, '2.0AT Cao Cấp', '56-phien-ban-elantra-20at-cao-cap'),
(207, 4, 104, 'Đen', '4-mau-sac-den'),
(208, 56, 104, '1.6AT NLine', '56-phien-ban-elantra-16at-nline'),
(209, 4, 105, 'Đỏ', '4-mau-sac-do'),
(210, 56, 105, '1.6AT Tiêu Chuẩn', '56-phien-ban-elantra-16at-tieu-chuan'),
(211, 4, 106, 'Đỏ', '4-mau-sac-do'),
(212, 56, 106, '1.6AT Đặc Biệt', '56-phien-ban-elantra-16at-dac-biet'),
(213, 4, 107, 'Đỏ', '4-mau-sac-do'),
(214, 56, 107, '2.0AT Cao Cấp', '56-phien-ban-elantra-20at-cao-cap'),
(215, 4, 108, 'Đỏ', '4-mau-sac-do'),
(216, 56, 108, '1.6AT NLine', '56-phien-ban-elantra-16at-nline'),
(217, 4, 109, 'Xám Titan', '4-mau-sac-xam-titan'),
(218, 56, 109, '1.6AT Tiêu Chuẩn', '56-phien-ban-elantra-16at-tieu-chuan'),
(219, 4, 110, 'Xám Titan', '4-mau-sac-xam-titan'),
(220, 56, 110, '1.6AT Đặc Biệt', '56-phien-ban-elantra-16at-dac-biet'),
(221, 4, 111, 'Xám Titan', '4-mau-sac-xam-titan'),
(222, 56, 111, '2.0AT Cao Cấp', '56-phien-ban-elantra-20at-cao-cap'),
(223, 4, 112, 'Xám Titan', '4-mau-sac-xam-titan'),
(224, 56, 112, '1.6AT NLine', '56-phien-ban-elantra-16at-nline'),
(225, 4, 113, 'Vàng Ghi', '4-mau-sac-vang-ghi'),
(226, 56, 113, '1.6AT Tiêu Chuẩn', '56-phien-ban-elantra-16at-tieu-chuan'),
(227, 4, 114, 'Vàng Ghi', '4-mau-sac-vang-ghi'),
(228, 56, 114, '1.6AT Đặc Biệt', '56-phien-ban-elantra-16at-dac-biet'),
(229, 4, 115, 'Vàng Ghi', '4-mau-sac-vang-ghi'),
(230, 56, 115, '2.0AT Cao Cấp', '56-phien-ban-elantra-20at-cao-cap'),
(231, 4, 116, 'Vàng Ghi', '4-mau-sac-vang-ghi'),
(232, 56, 116, '1.6AT NLine', '56-phien-ban-elantra-16at-nline'),
(233, 4, 117, 'Xanh Dương', '4-mau-sac-xanh-duong'),
(234, 56, 117, '1.6AT Tiêu Chuẩn', '56-phien-ban-elantra-16at-tieu-chuan'),
(235, 4, 118, 'Xanh Dương', '4-mau-sac-xanh-duong'),
(236, 56, 118, '1.6AT Đặc Biệt', '56-phien-ban-elantra-16at-dac-biet'),
(237, 4, 119, 'Xanh Dương', '4-mau-sac-xanh-duong'),
(238, 56, 119, '2.0AT Cao Cấp', '56-phien-ban-elantra-20at-cao-cap'),
(239, 4, 120, 'Xanh Dương', '4-mau-sac-xanh-duong'),
(240, 56, 120, '1.6AT NLine', '56-phien-ban-elantra-16at-nline');

-- --------------------------------------------------------

--
-- Table structure for table `product_variants`
--

CREATE TABLE `product_variants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `sku` varchar(255) DEFAULT NULL,
  `images` longtext DEFAULT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `price` double NOT NULL DEFAULT 0,
  `discount` double NOT NULL DEFAULT 0,
  `is_root` tinyint(1) NOT NULL DEFAULT 0,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `updated_by` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `quantity_sold` int(11) NOT NULL DEFAULT 0,
  `suggest_product_ids` longtext NOT NULL DEFAULT '[]',
  `engine` varchar(255) DEFAULT NULL,
  `power` varchar(255) DEFAULT NULL,
  `drive_system` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_variants`
--

INSERT INTO `product_variants` (`id`, `name`, `slug`, `sku`, `images`, `stock`, `price`, `discount`, `is_root`, `product_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `quantity_sold`, `suggest_product_ids`, `engine`, `power`, `drive_system`, `status`) VALUES
(7, 'Hyundai Creta - Tiêu Chuẩn Trắng', 'hyundai-creta-tieu-chuan-trang', 'Hy-cre-2022', '{\"main\":\"\\/storage\\/hyundai\\/creta\\/tieu-chuan\\/trang-tieu-chuan.png\"}', 0, 640000000, 0, 0, 1, 1, 1, '2023-11-09 05:29:14', '2023-11-13 00:37:46', 1, '[]', 'Xăng 1.5 AT', '115 Hp', 'Cầu trước', 1),
(8, 'Hyundai Creta - Tiêu Chuẩn Đen', 'hyundai-creta-tieu-chuan-den', 'Hy-cre-2022', '{\"main\":\"\\/storage\\/hyundai\\/creta\\/tieu-chuan\\/den-tieu-chuan.png\"}', 1, 640000000, 0, 0, 1, 1, 1, '2023-11-09 05:29:14', '2023-11-09 05:37:08', 0, '[]', 'Xăng 1.5 AT', '115 Hp', 'Cầu trước', 1),
(9, 'Hyundai Creta - Tiêu Chuẩn Đỏ', 'hyundai-creta-tieu-chuan-do', 'Hy-cre-2022', '{\"main\":\"\\/storage\\/hyundai\\/creta\\/tieu-chuan\\/do-tieu-chuan.png\"}', 1, 640000000, 0, 0, 1, 1, 1, '2023-11-09 05:29:14', '2023-11-09 05:39:10', 0, '[]', 'Xăng 1.5 AT', '115 Hp', 'Cầu trước', 1),
(10, 'Hyundai Creta - Tiêu Chuẩn Bạc', 'hyundai-creta-tieu-chuan-bac', 'Hy-cre-2022', '{\"main\":\"\\/storage\\/hyundai\\/creta\\/tieu-chuan\\/bac-tieu-chuan.png\"}', 1, 640000000, 0, 0, 1, 1, 1, '2023-11-09 05:29:14', '2023-11-09 05:39:33', 0, '[]', 'Xăng 1.5 AT', '115 Hp', 'Cầu trước', 1),
(11, 'Hyundai Creta - Tiêu Chuẩn Xám Titan', 'hyundai-creta-tieu-chuan-xam-titan', 'Hy-cre-2022', '{\"main\":\"\\/storage\\/hyundai\\/creta\\/tieu-chuan\\/xam-tieu-chuan.png\"}', 1, 640000000, 0, 0, 1, 1, 1, '2023-11-09 05:29:14', '2023-11-09 05:39:57', 0, '[]', 'Xăng 1.5 AT', '115 Hp', 'Cầu trước', 1),
(12, 'Hyundai Creta - Tiêu Chuẩn Xanh Dương', 'hyundai-creta-tieu-chuan-xanh-duong', 'Hy-cre-2022', '{\"main\":\"\\/storage\\/hyundai\\/creta\\/tieu-chuan\\/xanh-tieu-chuan.png\"}', 1, 640000000, 0, 0, 1, 1, 1, '2023-11-09 05:29:14', '2023-11-09 05:40:20', 0, '[]', 'Xăng 1.5 AT', '115 Hp', 'Cầu trước', 1),
(13, 'Hyundai Creta - Đặc Biệt Trắng', 'hyundai-creta-dac-biet-trang', 'Hy-cre-2022', '{\"main\":\"\\/storage\\/hyundai\\/creta\\/dac-biet\\/trang-dac-biet.png\"}', 1, 690000000, 0, 0, 1, 1, 1, '2023-11-09 05:29:14', '2023-11-09 05:42:17', 0, '[]', 'Xăng 1.5 AT', '115 Hp', 'Cầu trước', 1),
(14, 'Hyundai Creta - Đặc Biệt Đen', 'hyundai-creta-dac-biet-den', 'Hy-cre-2022', '{\"main\":\"\\/storage\\/hyundai\\/creta\\/dac-biet\\/den-dac-biet.png\"}', 1, 690000000, 0, 0, 1, 1, 1, '2023-11-09 05:29:14', '2023-11-09 05:42:34', 0, '[]', 'Xăng 1.5 AT', '115 Hp', '', 1),
(15, 'Hyundai Creta - Đặc Biệt Đỏ', 'hyundai-creta-dac-biet-do', 'Hy-cre-2022', '{\"main\":\"\\/storage\\/hyundai\\/creta\\/dac-biet\\/do-dac-biet.png\"}', 1, 690000000, 0, 0, 1, 1, 1, '2023-11-09 05:29:14', '2023-11-09 05:42:55', 0, '[]', 'Xăng 1.5 AT', '115 Hp', 'Cầu trước', 1),
(16, 'Hyundai Creta - Đặc Biệt Bạc', 'hyundai-creta-dac-biet-bac', 'Hy-cre-2022', '{\"main\":\"\\/storage\\/hyundai\\/creta\\/dac-biet\\/bac-dac-biet.png\"}', 1, 690000000, 0, 0, 1, 1, 1, '2023-11-09 05:29:14', '2023-11-09 05:44:02', 0, '[]', 'Xăng 1.5 AT', '115 Hp', 'Cầu trước', 1),
(17, 'Hyundai Creta - Đặc Biệt Xám Titan', 'hyundai-creta-dac-biet-xam-titan', 'Hy-cre-2022', '{\"main\":\"\\/storage\\/hyundai\\/creta\\/dac-biet\\/xam-dac-biet.png\"}', 1, 690000000, 0, 0, 1, 1, 1, '2023-11-09 05:29:14', '2023-11-09 05:44:36', 0, '[]', 'Xăng 1.5 AT', '115 Hp', 'Cầu trước', 1),
(18, 'Hyundai Creta - Đặc Biệt Xanh Dương', 'hyundai-creta-dac-biet-xanh-duong', 'Hy-cre-2022', '{\"main\":\"\\/storage\\/hyundai\\/creta\\/dac-biet\\/xanh-dac-biet.png\"}', 1, 690000000, 0, 0, 1, 1, 1, '2023-11-09 05:29:14', '2023-11-09 05:44:52', 0, '[]', 'Xăng 1.5 AT', '115 Hp', 'Cầu trước', 1),
(19, 'Hyundai Creta - Cao Cấp Trắng', 'hyundai-creta-cao-cap-trang', 'Hy-cre-2022', '{\"main\":\"\\/storage\\/hyundai\\/creta\\/cao-cap\\/trang-dac-biet.png\"}', 1, 740000000, 0, 0, 1, 1, 1, '2023-11-09 05:29:14', '2023-11-09 05:45:33', 0, '[]', 'Xăng 1.5 AT', '115 Hp', 'Cầu trước', 1),
(20, 'Hyundai Creta - Cao Cấp Đen', 'hyundai-creta-cao-cap-den', 'Hy-cre-2022', '{\"main\":\"\\/storage\\/hyundai\\/creta\\/cao-cap\\/den-dac-biet.png\"}', 1, 740000000, 0, 0, 1, 1, 1, '2023-11-09 05:29:14', '2023-11-09 05:46:28', 0, '[]', 'Xăng 1.5 AT', '115 Hp', 'Cầu trước', 1),
(21, 'Hyundai Creta - Cao Cấp Đỏ', 'hyundai-creta-cao-cap-do', 'Hy-cre-2022', '{\"main\":\"\\/storage\\/hyundai\\/creta\\/cao-cap\\/do-dac-biet.png\"}', 1, 740000000, 0, 0, 1, 1, 1, '2023-11-09 05:29:14', '2023-11-09 05:46:44', 0, '[]', 'Xăng 1.5 AT', '115 Hp', 'Cầu trước', 1),
(22, 'Hyundai Creta - Cao Cấp Bạc', 'hyundai-creta-cao-cap-bac', 'Hy-cre-2022', '{\"main\":\"\\/storage\\/hyundai\\/creta\\/cao-cap\\/bac-dac-biet.png\"}', 1, 740000000, 0, 0, 1, 1, 1, '2023-11-09 05:29:14', '2023-11-09 05:47:01', 0, '[]', 'Xăng 1.5 AT', '115 Hp', 'Cầu trước', 1),
(23, 'Hyundai Creta - Cao Cấp Xám Titan', 'hyundai-creta-cao-cap-xam-titan', 'Hy-cre-2022', '{\"main\":\"\\/storage\\/hyundai\\/creta\\/cao-cap\\/xam-dac-biet.png\"}', 1, 740000000, 0, 0, 1, 1, 1, '2023-11-09 05:29:14', '2023-11-09 05:47:23', 0, '[]', 'Xăng 1.5 AT', '115 Hp', 'Cầu trước', 1),
(24, 'Hyundai Creta - Cao Cấp Xanh Dương', 'hyundai-creta-cao-cap-xanh-duong', 'Hy-cre-2022', '{\"main\":\"\\/storage\\/hyundai\\/creta\\/cao-cap\\/xanh-dac-biet.png\"}', 1, 740000000, 0, 0, 1, 1, 1, '2023-11-09 05:29:14', '2023-11-09 05:47:39', 0, '[]', 'Xăng 1.5 AT', '115 Hp', 'Cầu trước', 1),
(55, 'Hyundai Santafe - Trắng Xăng 2.4 Thường', 'hyundai-santafe-trang-xang-24-thuong', 'Hy-san-2021', '{\"main\":\"\\/storage\\/hyundai\\/santafe\\/trang.png\"}', 0, 969000000, 0, 0, 2, 1, 1, '2023-11-09 06:08:22', '2023-11-16 09:01:12', 1, '[]', 'Xăng 2.4 AT', '180 Hp', 'FWD', 1),
(56, 'Hyundai Santafe - Trắng Xăng 2.4 Premium', 'hyundai-santafe-trang-xang-24-premium', 'Hy-san-2021', '{\"main\":\"\\/storage\\/hyundai\\/santafe\\/trang.png\"}', 1, 1150000000, 0, 0, 2, 1, 1, '2023-11-09 06:08:22', '2023-11-09 06:22:04', 0, '[]', 'Xăng 2.4 AT', '180 Hp', 'HTRAC', 1),
(57, 'Hyundai Santafe - Trắng Dầu 2.2 Thường', 'hyundai-santafe-trang-dau-22-thuong', 'Hy-san-2021', '{\"main\":\"\\/storage\\/hyundai\\/santafe\\/trang.png\"}', 1, 1050000000, 0, 0, 2, 1, 1, '2023-11-09 06:08:22', '2023-11-09 06:23:34', 0, '[]', 'Dầu 2.2 AT', '202 Hp', 'FWD', 1),
(58, 'Hyundai Santafe - Trắng Dầu 2.2 Premium', 'hyundai-santafe-trang-dau-22-premium', 'Hy-san-2021', '{\"main\":\"\\/storage\\/hyundai\\/santafe\\/trang.png\"}', 1, 1199000000, 0, 0, 2, 1, 1, '2023-11-09 06:08:22', '2023-11-09 06:23:05', 0, '[]', 'Dầu 2.2 AT', '202 Hp', 'HTRAC', 1),
(59, 'Hyundai Santafe - Đen Xăng 2.4 Thường', 'hyundai-santafe-den-xang-24-thuong', 'Hy-san-2021', '{\"main\":\"\\/storage\\/hyundai\\/santafe\\/den.png\"}', 1, 969000000, 0, 0, 2, 1, 1, '2023-11-09 06:08:22', '2023-11-09 06:25:13', 0, '[]', 'Xăng 2.4 AT', '180 Hp', 'FWD', 1),
(60, 'Hyundai Santafe - Đen Xăng 2.4 Premium', 'hyundai-santafe-den-xang-24-premium', 'Hy-san-2021', '{\"main\":\"\\/storage\\/hyundai\\/santafe\\/den.png\"}', 1, 1150000000, 0, 0, 2, 1, 1, '2023-11-09 06:08:22', '2023-11-09 06:25:38', 0, '[]', 'Xăng 2.4 AT', '180 Hp', 'HTRAC', 1),
(61, 'Hyundai Santafe - Đen Dầu 2.2 Thường', 'hyundai-santafe-den-dau-22-thuong', 'Hy-san-2021', '{\"main\":\"\\/storage\\/hyundai\\/santafe\\/den.png\"}', 1, 1050000000, 0, 0, 2, 1, 1, '2023-11-09 06:08:22', '2023-11-09 06:26:01', 0, '[]', 'Dầu 2.2 AT', '202 Hp', 'FWD', 1),
(62, 'Hyundai Santafe - Đen Dầu 2.2 Premium', 'hyundai-santafe-den-dau-22-premium', 'Hy-san-2021', '{\"main\":\"\\/storage\\/hyundai\\/santafe\\/den.png\"}', 1, 1199000000, 0, 0, 2, 1, 1, '2023-11-09 06:08:22', '2023-11-09 06:26:20', 0, '[]', 'Dầu 2.2 AT', '202 Hp', 'HTRAC', 1),
(63, 'Hyundai Santafe - Đỏ Xăng 2.4 Thường', 'hyundai-santafe-do-xang-24-thuong', 'Hy-san-2021', '{\"main\":\"\\/storage\\/hyundai\\/santafe\\/do.png\"}', 1, 969000000, 0, 0, 2, 1, 1, '2023-11-09 06:08:22', '2023-11-09 06:27:36', 0, '[]', 'Xăng 2.4 AT', '180 Hp', 'FWD', 1),
(64, 'Hyundai Santafe - Đỏ Xăng 2.4 Premium', 'hyundai-santafe-do-xang-24-premium', 'Hy-san-2021', '{\"main\":\"\\/storage\\/hyundai\\/santafe\\/do.png\"}', 1, 1150000000, 0, 0, 2, 1, 1, '2023-11-09 06:08:22', '2023-11-09 06:27:59', 0, '[]', 'Xăng 2.4 AT', '180 Hp', 'HTRAC', 1),
(65, 'Hyundai Santafe - Đỏ Dầu 2.2 Thường', 'hyundai-santafe-do-dau-22-thuong', 'Hy-san-2021', '{\"main\":\"\\/storage\\/hyundai\\/santafe\\/do.png\"}', 1, 1050000000, 0, 0, 2, 1, 1, '2023-11-09 06:08:22', '2023-11-09 06:29:03', 0, '[]', 'Dầu 2.2 AT', '202 Hp', 'FWD', 1),
(66, 'Hyundai Santafe - Đỏ Dầu 2.2 Premium', 'hyundai-santafe-do-dau-22-premium', 'Hy-san-2021', '{\"main\":\"\\/storage\\/hyundai\\/santafe\\/do.png\"}', 1, 1199000000, 0, 0, 2, 1, 1, '2023-11-09 06:08:22', '2023-11-09 06:29:20', 0, '[]', 'Dầu 2.2 AT', '202 Hp', 'HTRAC', 1),
(67, 'Hyundai Santafe - Bạc Xăng 2.4 Thường', 'hyundai-santafe-bac-xang-24-thuong', 'Hy-san-2021', '{\"main\":\"\\/storage\\/hyundai\\/santafe\\/bac.png\"}', 1, 969000000, 0, 0, 2, 1, 1, '2023-11-09 06:08:22', '2023-11-09 06:30:28', 0, '[]', 'Xăng 2.4 AT', '180 Hp', 'FWD', 1),
(68, 'Hyundai Santafe - Bạc Xăng 2.4 Premium', 'hyundai-santafe-bac-xang-24-premium', 'Hy-san-2021', '{\"main\":\"\\/storage\\/hyundai\\/santafe\\/bac.png\"}', 1, 1150000000, 0, 0, 2, 1, 1, '2023-11-09 06:08:22', '2023-11-09 06:30:46', 0, '[]', 'Xăng 2.4 AT', '180 Hp', 'HTRAC', 1),
(69, 'Hyundai Santafe - Bạc Dầu 2.2 Thường', 'hyundai-santafe-bac-dau-22-thuong', 'Hy-san-2021', '{\"main\":\"\\/storage\\/hyundai\\/santafe\\/bac.png\"}', 1, 1050000000, 0, 0, 2, 1, 1, '2023-11-09 06:08:22', '2023-11-09 06:31:10', 0, '[]', 'Dầu 2.2 AT', '202 Hp', 'FWD', 1),
(70, 'Hyundai Santafe - Bạc Dầu 2.2 Premium', 'hyundai-santafe-bac-dau-22-premium', 'Hy-san-2021', '{\"main\":\"\\/storage\\/hyundai\\/santafe\\/bac.png\"}', 1, 1199000000, 0, 0, 2, 1, 1, '2023-11-09 06:08:22', '2023-11-09 06:31:29', 0, '[]', 'Dầu 2.2 AT', '202 Hp', 'HTRAC', 1),
(71, 'Hyundai Santafe - Vàng Cát Xăng 2.4 Thường', 'hyundai-santafe-vang-cat-xang-24-thuong', 'Hy-san-2021', '{\"main\":\"\\/storage\\/hyundai\\/santafe\\/vang-cat.png\"}', 1, 969000000, 0, 0, 2, 1, 1, '2023-11-09 06:08:22', '2023-11-09 06:32:44', 0, '[]', 'Xăng 2.4 AT', '180 Hp', 'FWD', 1),
(72, 'Hyundai Santafe - Vàng Cát Xăng 2.4 Premium', 'hyundai-santafe-vang-cat-xang-24-premium', 'Hy-san-2021', '{\"main\":\"\\/storage\\/hyundai\\/santafe\\/vang-cat.png\"}', 1, 1150000000, 0, 0, 2, 1, 1, '2023-11-09 06:08:22', '2023-11-09 06:33:02', 0, '[]', 'Xăng 2.4 AT', '180 Hp', 'HTRAC', 1),
(73, 'Hyundai Santafe - Vàng Cát Dầu 2.2 Thường', 'hyundai-santafe-vang-cat-dau-22-thuong', 'Hy-san-2021', '{\"main\":\"\\/storage\\/hyundai\\/santafe\\/vang-cat.png\"}', 1, 1050000000, 0, 0, 2, 1, 1, '2023-11-09 06:08:22', '2023-11-09 06:33:21', 0, '[]', 'Dầu 2.2 AT', '202 Hp', 'FWD', 1),
(74, 'Hyundai Santafe - Vàng Cát Dầu 2.2 Premium', 'hyundai-santafe-vang-cat-dau-22-premium', 'Hy-san-2021', '{\"main\":\"\\/storage\\/hyundai\\/santafe\\/vang-cat.png\"}', 1, 1199000000, 0, 0, 2, 1, 1, '2023-11-09 06:08:22', '2023-11-09 06:33:38', 0, '[]', 'Dầu 2.2 AT', '202 Hp', 'HTRAC', 1),
(75, 'Hyundai Santafe - Xanh Đại Dương Xăng 2.4 Thường', 'hyundai-santafe-xanh-dai-duong-xang-24-thuong', 'Hy-san-2021', '{\"main\":\"\\/storage\\/hyundai\\/santafe\\/xanh-dai-duong.png\"}', 1, 969000000, 0, 0, 2, 1, 1, '2023-11-09 06:08:22', '2023-11-09 06:34:49', 0, '[]', 'Xăng 2.4 AT', '180 Hp', 'FWD', 1),
(76, 'Hyundai Santafe - Xanh Đại Dương Xăng 2.4 Premium', 'hyundai-santafe-xanh-dai-duong-xang-24-premium', 'Hy-san-2021', '{\"main\":\"\\/storage\\/hyundai\\/santafe\\/xanh-dai-duong.png\"}', 1, 1150000000, 0, 0, 2, 1, 1, '2023-11-09 06:08:22', '2023-11-09 06:35:05', 0, '[]', 'Xăng 2.4 AT', '180 Hp', 'HTRAC', 1),
(77, 'Hyundai Santafe - Xanh Đại Dương Dầu 2.2 Thường', 'hyundai-santafe-xanh-dai-duong-dau-22-thuong', 'Hy-san-2021', '{\"main\":\"\\/storage\\/hyundai\\/santafe\\/xanh-dai-duong.png\"}', 1, 1050000000, 0, 0, 2, 1, 1, '2023-11-09 06:08:22', '2023-11-09 06:35:20', 0, '[]', 'Dầu 2.2 AT', '202 Hp', 'FWD', 1),
(78, 'Hyundai Santafe - Xanh Đại Dương Dầu 2.2 Premium', 'hyundai-santafe-xanh-dai-duong-dau-22-premium', 'Hy-san-2021', '{\"main\":\"\\/storage\\/hyundai\\/santafe\\/xanh-dai-duong.png\"}', 1, 1199000000, 0, 0, 2, 1, 1, '2023-11-09 06:08:22', '2023-11-09 06:35:35', 0, '[]', 'Dầu 2.2 AT', '202 Hp', 'HTRAC', 1),
(79, 'Toyota Vios - Trắng 1.5E-MT', 'toyota-vios-trang-15e-mt', 'To-vio-2023', '{\"main\":\"\\/storage\\/toyota\\/vios\\/trang.png\"}', 0, 479000000, 0, 0, 3, 1, 1, '2023-11-09 06:50:39', '2023-11-17 02:46:50', 1, '[]', 'Xăng 1.5 MT', '106 Hp', '', 1),
(80, 'Toyota Vios - Trắng 1.5E-CVT', 'toyota-vios-trang-15e-cvt', 'To-vio-2023', '{\"main\":\"\\/storage\\/toyota\\/vios\\/trang.png\"}', 1, 528000000, 0, 0, 3, 1, 1, '2023-11-09 06:50:39', '2023-11-10 03:11:39', 0, '[]', 'Xăng 1.5 CVT', '106 Hp', '', 1),
(81, 'Toyota Vios - Trắng 1.5G-CVT', 'toyota-vios-trang-15g-cvt', 'To-vio-2023', '{\"main\":\"\\/storage\\/toyota\\/vios\\/trang.png\"}', 1, 592000000, 0, 0, 3, 1, 1, '2023-11-09 06:50:39', '2023-11-10 03:12:09', 0, '[]', 'Xăng 1.5 CVT', '106 Hp', '', 1),
(82, 'Toyota Vios - Đen 1.5E-MT', 'toyota-vios-den-15e-mt', 'To-vio-2023', '{\"main\":\"\\/storage\\/toyota\\/vios\\/den.png\"}', 1, 479000000, 0, 0, 3, 1, 1, '2023-11-09 06:50:39', '2023-11-10 03:12:57', 0, '[]', 'Xăng 1.5 MT', '106 Hp', '', 1),
(83, 'Toyota Vios - Đen 1.5E-CVT', 'toyota-vios-den-15e-cvt', 'To-vio-2023', '{\"main\":\"\\/storage\\/toyota\\/vios\\/den.png\"}', 1, 528000000, 0, 0, 3, 1, 1, '2023-11-09 06:50:39', '2023-11-10 03:13:19', 0, '[]', 'Xăng 1.5 CVT', '106 Hp', '', 1),
(84, 'Toyota Vios - Đen 1.5G-CVT', 'toyota-vios-den-15g-cvt', 'To-vio-2023', '{\"main\":\"\\/storage\\/toyota\\/vios\\/den.png\"}', 1, 592000000, 0, 0, 3, 1, 1, '2023-11-09 06:50:39', '2023-11-10 03:13:42', 0, '[]', 'Xăng 1.5 CVT', '106 Hp', '', 1),
(85, 'Toyota Vios - Đỏ 1.5E-MT', 'toyota-vios-do-15e-mt', 'To-vio-2023', '{\"main\":\"\\/storage\\/toyota\\/vios\\/do.png\"}', 1, 479000000, 0, 0, 3, 1, 1, '2023-11-09 06:50:39', '2023-11-10 03:14:16', 0, '[]', 'Xăng 1.5 MT', '106 Hp', '', 1),
(86, 'Toyota Vios - Đỏ 1.5E-CVT', 'toyota-vios-do-15e-cvt', 'To-vio-2023', '{\"main\":\"\\/storage\\/toyota\\/vios\\/do.png\"}', 1, 528000000, 0, 0, 3, 1, 1, '2023-11-09 06:50:39', '2023-11-10 03:15:10', 0, '[]', 'Xăng 1.5 CVT', '106 Hp', '', 1),
(87, 'Toyota Vios - Đỏ 1.5G-CVT', 'toyota-vios-do-15g-cvt', 'To-vio-2023', '{\"main\":\"\\/storage\\/toyota\\/vios\\/do.png\"}', 1, 592000000, 0, 0, 3, 1, 1, '2023-11-09 06:50:39', '2023-11-10 03:15:34', 0, '[]', 'Xăng 1.5 CVT', '106 Hp', '', 1),
(88, 'Toyota Vios - Bạc 1.5E-MT', 'toyota-vios-bac-15e-mt', 'To-vio-2023', '{\"main\":\"\\/storage\\/toyota\\/vios\\/bac.png\"}', 1, 479000000, 0, 0, 3, 1, 1, '2023-11-09 06:50:39', '2023-11-10 03:16:19', 0, '[]', 'Xăng 1.5 MT', '106 Hp', '', 1),
(89, 'Toyota Vios - Bạc 1.5E-CVT', 'toyota-vios-bac-15e-cvt', 'To-vio-2023', '{\"main\":\"\\/storage\\/toyota\\/vios\\/bac.png\"}', 1, 528000000, 0, 0, 3, 1, 1, '2023-11-09 06:50:39', '2023-11-10 03:16:38', 0, '[]', 'Xăng 1.5 CVT', '106 Hp', '', 1),
(90, 'Toyota Vios - Bạc 1.5G-CVT', 'toyota-vios-bac-15g-cvt', 'To-vio-2023', '{\"main\":\"\\/storage\\/toyota\\/vios\\/bac.png\"}', 1, 592000000, 0, 0, 3, 1, 1, '2023-11-09 06:50:39', '2023-11-10 03:16:58', 0, '[]', 'Xăng 1.5 CVT', '106 Hp', '', 1),
(91, 'Toyota Vios - Trắng Ngọc Trai 1.5E-MT', 'toyota-vios-trang-ngoc-trai-15e-mt', 'To-vio-2023', '{\"main\":\"\\/storage\\/toyota\\/vios\\/trang-nogc-trai.png\"}', 1, 487000000, 0, 0, 3, 1, 1, '2023-11-09 06:50:39', '2023-11-10 03:17:17', 0, '[]', 'Xăng 1.5 MT', '106 Hp', '', 1),
(92, 'Toyota Vios - Trắng Ngọc Trai 1.5E-CVT', 'toyota-vios-trang-ngoc-trai-15e-cvt', 'To-vio-2023', '{\"main\":\"\\/storage\\/toyota\\/vios\\/trang-nogc-trai.png\"}', 1, 536000000, 0, 0, 3, 1, 1, '2023-11-09 06:50:39', '2023-11-10 03:17:39', 0, '[]', 'Xăng 1.5 CVT', '106 Hp', '', 1),
(93, 'Toyota Vios - Trắng Ngọc Trai 1.5G-CVT', 'toyota-vios-trang-ngoc-trai-15g-cvt', 'To-vio-2023', '{\"main\":\"\\/storage\\/toyota\\/vios\\/trang-nogc-trai.png\"}', 1, 600000000, 0, 0, 3, 1, 1, '2023-11-09 06:50:39', '2023-11-10 03:18:20', 0, '[]', 'Xăng 1.5 CVT', '106 Hp', '', 1),
(94, 'Toyota Vios - Nâu Ánh Vàng 1.5E-MT', 'toyota-vios-nau-anh-vang-15e-mt', 'To-vio-2023', '{\"main\":\"\\/storage\\/toyota\\/vios\\/vang.png\"}', 1, 479000000, 0, 0, 3, 1, 1, '2023-11-09 06:50:39', '2023-11-10 03:18:43', 0, '[]', 'Xăng 1.5 MT', '106 Hp', '', 1),
(95, 'Toyota Vios - Nâu Ánh Vàng 1.5E-CVT', 'toyota-vios-nau-anh-vang-15e-cvt', 'To-vio-2023', '{\"main\":\"\\/storage\\/toyota\\/vios\\/vang.png\"}', 1, 528000000, 0, 0, 3, 1, 1, '2023-11-09 06:50:39', '2023-11-10 03:18:59', 0, '[]', 'Xăng 1.5 CVT', '106 Hp', '', 1),
(96, 'Toyota Vios - Nâu Ánh Vàng 1.5G-CVT', 'toyota-vios-nau-anh-vang-15g-cvt', 'To-vio-2023', '{\"main\":\"\\/storage\\/toyota\\/vios\\/vang.png\"}', 1, 592000000, 0, 0, 3, 1, 1, '2023-11-09 06:50:39', '2023-11-10 03:19:13', 0, '[]', 'Xăng 1.5 CVT', '106 Hp', '', 1),
(97, 'Hyundai Elantra - Trắng 1.6AT Tiêu Chuẩn', 'hyundai-elantra-trang-16at-tieu-chuan', 'Hy-ela-2023', '{\"main\":\"\\/storage\\/hyundai\\/elantra\\/trang.png\"}', 0, 599000000, 0, 0, 4, 1, 1, '2023-11-10 02:16:45', '2023-11-10 08:24:08', 1, '[]', 'Xăng 1.6 AT', '128 Hp', 'FWD', 1),
(98, 'Hyundai Elantra - Trắng 1.6AT Đặc Biệt', 'hyundai-elantra-trang-16at-dac-biet', 'Hy-ela-2023', '{\"main\":\"\\/storage\\/hyundai\\/elantra\\/trang.png\"}', 1, 669000000, 0, 0, 4, 1, 1, '2023-11-10 02:16:45', '2023-11-10 02:20:36', 0, '[]', 'Xăng 1.6 AT', '128 Hp', 'FWD', 1),
(99, 'Hyundai Elantra - Trắng 2.0AT Cao Cấp', 'hyundai-elantra-trang-20at-cao-cap', 'Hy-ela-2023', '{\"main\":\"\\/storage\\/hyundai\\/elantra\\/trang.png\"}', 1, 729000000, 0, 0, 4, 1, 1, '2023-11-10 02:16:45', '2023-11-10 02:24:18', 0, '[]', 'Xăng 2.0 AT', '159 Hp', 'FWD', 1),
(100, 'Hyundai Elantra - Trắng 1.6AT NLine', 'hyundai-elantra-trang-16at-nline', 'Hy-ela-2023', '{\"main\":\"\\/storage\\/hyundai\\/elantra\\/trang.png\"}', 1, 799000000, 0, 0, 4, 1, 1, '2023-11-10 02:16:45', '2023-11-10 02:22:14', 0, '[]', 'Xăng 1.6 Turbo AT', '204 Hp', 'FWD', 1),
(101, 'Hyundai Elantra - Đen 1.6AT Tiêu Chuẩn', 'hyundai-elantra-den-16at-tieu-chuan', 'Hy-ela-2023', '{\"main\":\"\\/storage\\/hyundai\\/elantra\\/den.png\"}', 1, 599000000, 0, 0, 4, 1, 1, '2023-11-10 02:16:45', '2023-11-10 02:22:56', 0, '[]', 'Xăng 1.6 AT', '128 Hp', 'FWD', 1),
(102, 'Hyundai Elantra - Đen 1.6AT Đặc Biệt', 'hyundai-elantra-den-16at-dac-biet', 'Hy-ela-2023', '{\"main\":\"\\/storage\\/hyundai\\/elantra\\/den.png\"}', 1, 669000000, 0, 0, 4, 1, 1, '2023-11-10 02:16:45', '2023-11-10 02:23:18', 0, '[]', 'Xăng 1.6 AT', '128 Hp', 'FWD', 1),
(103, 'Hyundai Elantra - Đen 2.0AT Cao Cấp', 'hyundai-elantra-den-20at-cao-cap', 'Hy-ela-2023', '{\"main\":\"\\/storage\\/hyundai\\/elantra\\/den.png\"}', 1, 729000000, 0, 0, 4, 1, 1, '2023-11-10 02:16:45', '2023-11-10 02:24:02', 0, '[]', 'Xăng 2.0 AT', '159 Hp', 'FWD', 1),
(104, 'Hyundai Elantra - Đen 1.6AT NLine', 'hyundai-elantra-den-16at-nline', 'Hy-ela-2023', '{\"main\":\"\\/storage\\/hyundai\\/elantra\\/den.png\"}', 1, 799000000, 0, 0, 4, 1, 1, '2023-11-10 02:16:45', '2023-11-10 02:24:48', 0, '[]', 'Xăng 1.6 Turbo AT', '204 Hp', 'FWD', 1),
(105, 'Hyundai Elantra - Đỏ 1.6AT Tiêu Chuẩn', 'hyundai-elantra-do-16at-tieu-chuan', 'Hy-ela-2023', '{\"main\":\"\\/storage\\/hyundai\\/elantra\\/do.png\"}', 1, 599000000, 0, 0, 4, 1, 1, '2023-11-10 02:16:45', '2023-11-10 02:26:48', 0, '[]', 'Xăng 1.6 AT', '128 Hp', 'FWD', 1),
(106, 'Hyundai Elantra - Đỏ 1.6AT Đặc Biệt', 'hyundai-elantra-do-16at-dac-biet', 'Hy-ela-2023', '{\"main\":\"\\/storage\\/hyundai\\/elantra\\/do.png\"}', 1, 669000000, 0, 0, 4, 1, 1, '2023-11-10 02:16:45', '2023-11-10 02:27:10', 0, '[]', 'Xăng 1.6 AT', '128 Hp', 'FWD', 1),
(107, 'Hyundai Elantra - Đỏ 2.0AT Cao Cấp', 'hyundai-elantra-do-20at-cao-cap', 'Hy-ela-2023', '{\"main\":\"\\/storage\\/hyundai\\/elantra\\/do.png\"}', 1, 729000000, 0, 0, 4, 1, 1, '2023-11-10 02:16:45', '2023-11-10 02:27:41', 0, '[]', 'Xăng 2.0 AT', '159 Hp', 'FWD', 1),
(108, 'Hyundai Elantra - Đỏ 1.6AT NLine', 'hyundai-elantra-do-16at-nline', 'Hy-ela-2023', '{\"main\":\"\\/storage\\/hyundai\\/elantra\\/do.png\"}', 1, 799000000, 0, 0, 4, 1, 1, '2023-11-10 02:16:45', '2023-11-10 02:28:00', 0, '[]', 'Xăng 1.6 Turbo AT', '204 Hp', 'FWD', 1),
(109, 'Hyundai Elantra - Xám Titan 1.6AT Tiêu Chuẩn', 'hyundai-elantra-xam-titan-16at-tieu-chuan', 'Hy-ela-2023', '{\"main\":\"\\/storage\\/hyundai\\/elantra\\/xam-titan.png\"}', 1, 599000000, 0, 0, 4, 1, 1, '2023-11-10 02:16:45', '2023-11-10 02:25:08', 0, '[]', 'Xăng 1.6 AT', '128 Hp', 'FWD', 1),
(110, 'Hyundai Elantra - Xám Titan 1.6AT Đặc Biệt', 'hyundai-elantra-xam-titan-16at-dac-biet', 'Hy-ela-2023', '{\"main\":\"\\/storage\\/hyundai\\/elantra\\/xam-titan.png\"}', 1, 669000000, 0, 0, 4, 1, 1, '2023-11-10 02:16:45', '2023-11-10 02:25:27', 0, '[]', 'Xăng 1.6 AT', '128 Hp', 'FWD', 1),
(111, 'Hyundai Elantra - Xám Titan 2.0AT Cao Cấp', 'hyundai-elantra-xam-titan-20at-cao-cap', 'Hy-ela-2023', '{\"main\":\"\\/storage\\/hyundai\\/elantra\\/xam-titan.png\"}', 1, 729000000, 0, 0, 4, 1, 1, '2023-11-10 02:16:45', '2023-11-10 02:26:01', 0, '[]', 'Xăng 2.0 AT', '159 Hp', 'FWD', 1),
(112, 'Hyundai Elantra - Xám Titan 1.6AT NLine', 'hyundai-elantra-xam-titan-16at-nline', 'Hy-ela-2023', '{\"main\":\"\\/storage\\/hyundai\\/elantra\\/xam-titan.png\"}', 1, 799000000, 0, 0, 4, 1, 1, '2023-11-10 02:16:45', '2023-11-10 02:26:29', 0, '[]', 'Xăng 1.6 Turbo AT', '204 Hp', 'FWD', 1),
(113, 'Hyundai Elantra - Vàng Ghi 1.6AT Tiêu Chuẩn', 'hyundai-elantra-vang-ghi-16at-tieu-chuan', 'Hy-ela-2023', '{\"main\":\"\\/storage\\/hyundai\\/elantra\\/vang.png\"}', 1, 599000000, 0, 0, 4, 1, 1, '2023-11-10 02:16:45', '2023-11-10 02:28:22', 0, '[]', 'Xăng 1.6 AT', '128 Hp', 'FWD', 1),
(114, 'Hyundai Elantra - Vàng Ghi 1.6AT Đặc Biệt', 'hyundai-elantra-vang-ghi-16at-dac-biet', 'Hy-ela-2023', '{\"main\":\"\\/storage\\/hyundai\\/elantra\\/vang.png\"}', 1, 669000000, 0, 0, 4, 1, 1, '2023-11-10 02:16:45', '2023-11-10 02:28:41', 0, '[]', 'Xăng 1.6 AT', '128 Hp', 'FWD', 1),
(115, 'Hyundai Elantra - Vàng Ghi 2.0AT Cao Cấp', 'hyundai-elantra-vang-ghi-20at-cao-cap', 'Hy-ela-2023', '{\"main\":\"\\/storage\\/hyundai\\/elantra\\/vang.png\"}', 1, 729000000, 0, 0, 4, 1, 1, '2023-11-10 02:16:45', '2023-11-10 02:28:59', 0, '[]', 'Xăng 2.0 AT', '159 Hp', 'FWD', 1),
(116, 'Hyundai Elantra - Vàng Ghi 1.6AT NLine', 'hyundai-elantra-vang-ghi-16at-nline', 'Hy-ela-2023', '{\"main\":\"\\/storage\\/hyundai\\/elantra\\/vang.png\"}', 1, 799000000, 0, 0, 4, 1, 1, '2023-11-10 02:16:45', '2023-11-10 02:29:25', 0, '[]', 'Xăng 1.6 Turbo AT', '204 Hp', 'FWD', 1),
(117, 'Hyundai Elantra - Xanh Dương 1.6AT Tiêu Chuẩn', 'hyundai-elantra-xanh-duong-16at-tieu-chuan', 'Hy-ela-2023', '{\"main\":\"\\/storage\\/hyundai\\/elantra\\/logo-elantra.png\"}', 1, 599000000, 0, 0, 4, 1, 1, '2023-11-10 02:16:45', '2023-11-10 02:29:37', 0, '[]', 'Xăng 1.6 AT', '128 Hp', 'FWD', 1),
(118, 'Hyundai Elantra - Xanh Dương 1.6AT Đặc Biệt', 'hyundai-elantra-xanh-duong-16at-dac-biet', 'Hy-ela-2023', '{\"main\":\"\\/storage\\/hyundai\\/elantra\\/logo-elantra.png\"}', 1, 669000000, 0, 0, 4, 1, 1, '2023-11-10 02:16:45', '2023-11-10 02:29:49', 0, '[]', 'Xăng 1.6 AT', '128 Hp', 'FWD', 1),
(119, 'Hyundai Elantra - Xanh Dương 2.0AT Cao Cấp', 'hyundai-elantra-xanh-duong-20at-cao-cap', 'Hy-ela-2023', '{\"main\":\"\\/storage\\/hyundai\\/elantra\\/logo-elantra.png\"}', 1, 729000000, 0, 0, 4, 1, 1, '2023-11-10 02:16:45', '2023-11-10 02:30:03', 0, '[]', 'Xăng 2.0 AT', '159 Hp', 'FWD', 1),
(120, 'Hyundai Elantra - Xanh Dương 1.6AT NLine', 'hyundai-elantra-xanh-duong-16at-nline', 'Hy-ela-2023', '{\"main\":\"\\/storage\\/hyundai\\/elantra\\/logo-elantra.png\"}', 1, 799000000, 0, 0, 4, 1, 1, '2023-11-10 02:16:45', '2023-11-10 02:30:17', 0, '[]', 'Xăng 1.6 Turbo AT', '204 Hp', 'FWD', 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `description` text DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `status`, `description`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 1, '', NULL, '2023-11-09 02:27:33', '2023-11-09 02:27:33'),
(2, 'Nhân viên giao xe', 1, 'Là nhân viên phụ trách việc bàn giao xe cho khách hàng', NULL, '2023-11-10 08:12:56', '2023-11-10 08:13:14'),
(3, 'Nhân viên xử lí đơn hàng', 1, 'Là nhân viên có trách nhiệm xử lí các vấn đề phát sinh trong quá trình thực hiện đơn hàng', NULL, '2023-11-10 08:15:35', '2023-11-10 08:15:35'),
(4, 'Nhân viên quản lí', 1, 'Là nhân viên có quyền thêm, sửa, xóa sản phẩm, danh mục sản phẩm, bài viết', NULL, '2023-11-10 08:16:27', '2023-11-10 08:16:47');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` longtext DEFAULT NULL,
  `content` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `content`) VALUES
(1, 'WEBSITE_NAME', '', NULL),
(2, 'SLOGAN', '', NULL),
(3, 'LOGO', '/storage/logo.png', NULL),
(4, 'FAVICON', '', NULL),
(5, 'BANK_NAME', 'MB Bank', NULL),
(6, 'BANK_ACCOUNT_NAME', 'Nguyen Tien Dat', NULL),
(7, 'BANK_ACCOUNT_NUMBER', '0123456789', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `slugs`
--

CREATE TABLE `slugs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) NOT NULL,
  `sluggable_id` bigint(20) UNSIGNED NOT NULL,
  `sluggable_type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `slugs`
--

INSERT INTO `slugs` (`id`, `slug`, `sluggable_id`, `sluggable_type`, `created_at`, `updated_at`) VALUES
(1, 'hyundai', 1, 'Modules\\Product\\Models\\ProductCategory', '2023-11-09 03:04:19', '2023-11-09 03:04:19'),
(2, 'cuv', 2, 'Modules\\Product\\Models\\ProductCategory', '2023-11-09 03:04:45', '2023-11-09 03:04:45'),
(3, 'hyundai-creta', 1, 'Modules\\Product\\Models\\Product', '2023-11-09 03:07:39', '2023-11-09 03:07:39'),
(10, 'xe-5-cho', 3, 'Modules\\Product\\Models\\ProductCategory', '2023-11-09 05:23:50', '2023-11-09 05:23:50'),
(11, 'hyundai-creta-hyundai-creta-tieu-chuan-trang', 7, 'Modules\\Product\\Models\\ProductVariant', '2023-11-09 05:29:14', '2023-11-09 05:29:14'),
(12, 'hyundai-creta-hyundai-creta-tieu-chuan-den', 8, 'Modules\\Product\\Models\\ProductVariant', '2023-11-09 05:29:14', '2023-11-09 05:29:14'),
(13, 'hyundai-creta-hyundai-creta-tieu-chuan-do', 9, 'Modules\\Product\\Models\\ProductVariant', '2023-11-09 05:29:14', '2023-11-09 05:29:14'),
(14, 'hyundai-creta-hyundai-creta-tieu-chuan-bac', 10, 'Modules\\Product\\Models\\ProductVariant', '2023-11-09 05:29:14', '2023-11-09 05:29:14'),
(15, 'hyundai-creta-hyundai-creta-tieu-chuan-xam-titan', 11, 'Modules\\Product\\Models\\ProductVariant', '2023-11-09 05:29:14', '2023-11-09 05:29:14'),
(16, 'hyundai-creta-hyundai-creta-tieu-chuan-xanh-duong', 12, 'Modules\\Product\\Models\\ProductVariant', '2023-11-09 05:29:14', '2023-11-09 05:29:14'),
(17, 'hyundai-creta-hyundai-creta-dac-biet-trang', 13, 'Modules\\Product\\Models\\ProductVariant', '2023-11-09 05:29:14', '2023-11-09 05:29:14'),
(18, 'hyundai-creta-hyundai-creta-dac-biet-den', 14, 'Modules\\Product\\Models\\ProductVariant', '2023-11-09 05:29:14', '2023-11-09 05:29:14'),
(19, 'hyundai-creta-hyundai-creta-dac-biet-do', 15, 'Modules\\Product\\Models\\ProductVariant', '2023-11-09 05:29:14', '2023-11-09 05:29:14'),
(20, 'hyundai-creta-hyundai-creta-dac-biet-bac', 16, 'Modules\\Product\\Models\\ProductVariant', '2023-11-09 05:29:14', '2023-11-09 05:29:14'),
(21, 'hyundai-creta-hyundai-creta-dac-biet-xam-titan', 17, 'Modules\\Product\\Models\\ProductVariant', '2023-11-09 05:29:14', '2023-11-09 05:29:14'),
(22, 'hyundai-creta-hyundai-creta-dac-biet-xanh-duong', 18, 'Modules\\Product\\Models\\ProductVariant', '2023-11-09 05:29:14', '2023-11-09 05:29:14'),
(23, 'hyundai-creta-hyundai-creta-cao-cap-trang', 19, 'Modules\\Product\\Models\\ProductVariant', '2023-11-09 05:29:14', '2023-11-09 05:29:14'),
(24, 'hyundai-creta-hyundai-creta-cao-cap-den', 20, 'Modules\\Product\\Models\\ProductVariant', '2023-11-09 05:29:14', '2023-11-09 05:29:14'),
(25, 'hyundai-creta-hyundai-creta-cao-cap-do', 21, 'Modules\\Product\\Models\\ProductVariant', '2023-11-09 05:29:14', '2023-11-09 05:29:14'),
(26, 'hyundai-creta-hyundai-creta-cao-cap-bac', 22, 'Modules\\Product\\Models\\ProductVariant', '2023-11-09 05:29:14', '2023-11-09 05:29:14'),
(27, 'hyundai-creta-hyundai-creta-cao-cap-xam-titan', 23, 'Modules\\Product\\Models\\ProductVariant', '2023-11-09 05:29:14', '2023-11-09 05:29:14'),
(28, 'hyundai-creta-hyundai-creta-cao-cap-xanh-duong', 24, 'Modules\\Product\\Models\\ProductVariant', '2023-11-09 05:29:14', '2023-11-09 05:29:14'),
(29, 'xe-7-cho', 4, 'Modules\\Product\\Models\\ProductCategory', '2023-11-09 05:49:23', '2023-11-09 05:49:23'),
(30, 'suv', 5, 'Modules\\Product\\Models\\ProductCategory', '2023-11-09 05:49:36', '2023-11-09 05:49:36'),
(31, 'hyundai-santafe', 2, 'Modules\\Product\\Models\\Product', '2023-11-09 05:53:01', '2023-11-09 05:53:01'),
(62, 'hyundai-santafe-trang-xang-24-thuong', 55, 'Modules\\Product\\Models\\ProductVariant', '2023-11-09 06:08:22', '2023-11-18 00:40:05'),
(63, 'hyundai-santafe-trang-xang-24-premium', 56, 'Modules\\Product\\Models\\ProductVariant', '2023-11-09 06:08:22', '2023-11-18 00:40:05'),
(64, 'hyundai-santafe-trang-dau-22-thuong', 57, 'Modules\\Product\\Models\\ProductVariant', '2023-11-09 06:08:22', '2023-11-18 00:40:05'),
(65, 'hyundai-santafe-trang-dau-22-premium', 58, 'Modules\\Product\\Models\\ProductVariant', '2023-11-09 06:08:22', '2023-11-18 00:40:05'),
(66, 'hyundai-santafe-den-xang-24-thuong', 59, 'Modules\\Product\\Models\\ProductVariant', '2023-11-09 06:08:22', '2023-11-18 00:40:05'),
(67, 'hyundai-santafe-den-xang-24-premium', 60, 'Modules\\Product\\Models\\ProductVariant', '2023-11-09 06:08:22', '2023-11-18 00:40:05'),
(68, 'hyundai-santafe-den-dau-22-thuong', 61, 'Modules\\Product\\Models\\ProductVariant', '2023-11-09 06:08:22', '2023-11-18 00:40:05'),
(69, 'hyundai-santafe-den-dau-22-premium', 62, 'Modules\\Product\\Models\\ProductVariant', '2023-11-09 06:08:22', '2023-11-18 00:40:05'),
(70, 'hyundai-santafe-do-xang-24-thuong', 63, 'Modules\\Product\\Models\\ProductVariant', '2023-11-09 06:08:22', '2023-11-18 00:40:05'),
(71, 'hyundai-santafe-do-xang-24-premium', 64, 'Modules\\Product\\Models\\ProductVariant', '2023-11-09 06:08:22', '2023-11-18 00:40:05'),
(72, 'hyundai-santafe-do-dau-22-thuong', 65, 'Modules\\Product\\Models\\ProductVariant', '2023-11-09 06:08:22', '2023-11-18 00:40:05'),
(73, 'hyundai-santafe-do-dau-22-premium', 66, 'Modules\\Product\\Models\\ProductVariant', '2023-11-09 06:08:22', '2023-11-18 00:40:05'),
(74, 'hyundai-santafe-bac-xang-24-thuong', 67, 'Modules\\Product\\Models\\ProductVariant', '2023-11-09 06:08:22', '2023-11-18 00:40:05'),
(75, 'hyundai-santafe-bac-xang-24-premium', 68, 'Modules\\Product\\Models\\ProductVariant', '2023-11-09 06:08:22', '2023-11-18 00:40:05'),
(76, 'hyundai-santafe-bac-dau-22-thuong', 69, 'Modules\\Product\\Models\\ProductVariant', '2023-11-09 06:08:22', '2023-11-18 00:40:05'),
(77, 'hyundai-santafe-bac-dau-22-premium', 70, 'Modules\\Product\\Models\\ProductVariant', '2023-11-09 06:08:22', '2023-11-18 00:40:05'),
(78, 'hyundai-santafe-vang-cat-xang-24-thuong', 71, 'Modules\\Product\\Models\\ProductVariant', '2023-11-09 06:08:22', '2023-11-18 00:40:05'),
(79, 'hyundai-santafe-vang-cat-xang-24-premium', 72, 'Modules\\Product\\Models\\ProductVariant', '2023-11-09 06:08:22', '2023-11-18 00:40:05'),
(80, 'hyundai-santafe-vang-cat-dau-22-thuong', 73, 'Modules\\Product\\Models\\ProductVariant', '2023-11-09 06:08:22', '2023-11-18 00:40:05'),
(81, 'hyundai-santafe-vang-cat-dau-22-premium', 74, 'Modules\\Product\\Models\\ProductVariant', '2023-11-09 06:08:22', '2023-11-18 00:40:05'),
(82, 'hyundai-santafe-xanh-dai-duong-xang-24-thuong', 75, 'Modules\\Product\\Models\\ProductVariant', '2023-11-09 06:08:22', '2023-11-18 00:40:05'),
(83, 'hyundai-santafe-xanh-dai-duong-xang-24-premium', 76, 'Modules\\Product\\Models\\ProductVariant', '2023-11-09 06:08:22', '2023-11-18 00:40:05'),
(84, 'hyundai-santafe-xanh-dai-duong-dau-22-thuong', 77, 'Modules\\Product\\Models\\ProductVariant', '2023-11-09 06:08:22', '2023-11-18 00:40:05'),
(85, 'hyundai-santafe-xanh-dai-duong-dau-22-premium', 78, 'Modules\\Product\\Models\\ProductVariant', '2023-11-09 06:08:22', '2023-11-18 00:40:05'),
(86, 'toyota', 6, 'Modules\\Product\\Models\\ProductCategory', '2023-11-09 06:39:43', '2023-11-09 06:39:43'),
(87, 'sedan', 7, 'Modules\\Product\\Models\\ProductCategory', '2023-11-09 06:39:58', '2023-11-09 06:39:58'),
(88, 'mpv', 8, 'Modules\\Product\\Models\\ProductCategory', '2023-11-09 06:40:13', '2023-11-09 06:40:13'),
(89, 'toyota-vios', 3, 'Modules\\Product\\Models\\Product', '2023-11-09 06:49:09', '2023-11-09 06:49:09'),
(90, 'toyota-vios-toyota-vios-trang-15e-mt', 79, 'Modules\\Product\\Models\\ProductVariant', '2023-11-09 06:50:39', '2023-11-09 06:50:39'),
(91, 'toyota-vios-toyota-vios-trang-15e-cvt', 80, 'Modules\\Product\\Models\\ProductVariant', '2023-11-09 06:50:39', '2023-11-09 06:50:39'),
(92, 'toyota-vios-toyota-vios-trang-15g-cvt', 81, 'Modules\\Product\\Models\\ProductVariant', '2023-11-09 06:50:39', '2023-11-09 06:50:39'),
(93, 'toyota-vios-toyota-vios-den-15e-mt', 82, 'Modules\\Product\\Models\\ProductVariant', '2023-11-09 06:50:39', '2023-11-09 06:50:39'),
(94, 'toyota-vios-toyota-vios-den-15e-cvt', 83, 'Modules\\Product\\Models\\ProductVariant', '2023-11-09 06:50:39', '2023-11-09 06:50:39'),
(95, 'toyota-vios-toyota-vios-den-15g-cvt', 84, 'Modules\\Product\\Models\\ProductVariant', '2023-11-09 06:50:39', '2023-11-09 06:50:39'),
(96, 'toyota-vios-toyota-vios-do-15e-mt', 85, 'Modules\\Product\\Models\\ProductVariant', '2023-11-09 06:50:39', '2023-11-09 06:50:39'),
(97, 'toyota-vios-toyota-vios-do-15e-cvt', 86, 'Modules\\Product\\Models\\ProductVariant', '2023-11-09 06:50:39', '2023-11-09 06:50:39'),
(98, 'toyota-vios-toyota-vios-do-15g-cvt', 87, 'Modules\\Product\\Models\\ProductVariant', '2023-11-09 06:50:39', '2023-11-09 06:50:39'),
(99, 'toyota-vios-toyota-vios-bac-15e-mt', 88, 'Modules\\Product\\Models\\ProductVariant', '2023-11-09 06:50:39', '2023-11-09 06:50:39'),
(100, 'toyota-vios-toyota-vios-bac-15e-cvt', 89, 'Modules\\Product\\Models\\ProductVariant', '2023-11-09 06:50:39', '2023-11-09 06:50:39'),
(101, 'toyota-vios-toyota-vios-bac-15g-cvt', 90, 'Modules\\Product\\Models\\ProductVariant', '2023-11-09 06:50:39', '2023-11-09 06:50:39'),
(102, 'toyota-vios-toyota-vios-trang-ngoc-trai-15e-mt', 91, 'Modules\\Product\\Models\\ProductVariant', '2023-11-09 06:50:39', '2023-11-09 06:50:39'),
(103, 'toyota-vios-toyota-vios-trang-ngoc-trai-15e-cvt', 92, 'Modules\\Product\\Models\\ProductVariant', '2023-11-09 06:50:39', '2023-11-09 06:50:39'),
(104, 'toyota-vios-toyota-vios-trang-ngoc-trai-15g-cvt', 93, 'Modules\\Product\\Models\\ProductVariant', '2023-11-09 06:50:39', '2023-11-09 06:50:39'),
(105, 'toyota-vios-toyota-vios-nau-anh-vang-15e-mt', 94, 'Modules\\Product\\Models\\ProductVariant', '2023-11-09 06:50:39', '2023-11-09 06:50:39'),
(106, 'toyota-vios-toyota-vios-nau-anh-vang-15e-cvt', 95, 'Modules\\Product\\Models\\ProductVariant', '2023-11-09 06:50:39', '2023-11-09 06:50:39'),
(107, 'toyota-vios-toyota-vios-nau-anh-vang-15g-cvt', 96, 'Modules\\Product\\Models\\ProductVariant', '2023-11-09 06:50:39', '2023-11-09 06:50:39'),
(108, 'hyundai-elantra', 4, 'Modules\\Product\\Models\\Product', '2023-11-10 02:14:03', '2023-11-10 02:14:03'),
(109, 'hyundai-elantra-hyundai-elantra-trang-16at-tieu-chuan', 97, 'Modules\\Product\\Models\\ProductVariant', '2023-11-10 02:16:45', '2023-11-10 02:16:45'),
(110, 'hyundai-elantra-hyundai-elantra-trang-16at-dac-biet', 98, 'Modules\\Product\\Models\\ProductVariant', '2023-11-10 02:16:45', '2023-11-10 02:16:45'),
(111, 'hyundai-elantra-hyundai-elantra-trang-20at-cao-cap', 99, 'Modules\\Product\\Models\\ProductVariant', '2023-11-10 02:16:45', '2023-11-10 02:16:45'),
(112, 'hyundai-elantra-hyundai-elantra-trang-16at-nline', 100, 'Modules\\Product\\Models\\ProductVariant', '2023-11-10 02:16:45', '2023-11-10 02:16:45'),
(113, 'hyundai-elantra-hyundai-elantra-den-16at-tieu-chuan', 101, 'Modules\\Product\\Models\\ProductVariant', '2023-11-10 02:16:45', '2023-11-10 02:16:45'),
(114, 'hyundai-elantra-hyundai-elantra-den-16at-dac-biet', 102, 'Modules\\Product\\Models\\ProductVariant', '2023-11-10 02:16:45', '2023-11-10 02:16:45'),
(115, 'hyundai-elantra-hyundai-elantra-den-20at-cao-cap', 103, 'Modules\\Product\\Models\\ProductVariant', '2023-11-10 02:16:45', '2023-11-10 02:16:45'),
(116, 'hyundai-elantra-hyundai-elantra-den-16at-nline', 104, 'Modules\\Product\\Models\\ProductVariant', '2023-11-10 02:16:45', '2023-11-10 02:16:45'),
(117, 'hyundai-elantra-hyundai-elantra-do-16at-tieu-chuan', 105, 'Modules\\Product\\Models\\ProductVariant', '2023-11-10 02:16:45', '2023-11-10 02:16:45'),
(118, 'hyundai-elantra-hyundai-elantra-do-16at-dac-biet', 106, 'Modules\\Product\\Models\\ProductVariant', '2023-11-10 02:16:45', '2023-11-10 02:16:45'),
(119, 'hyundai-elantra-hyundai-elantra-do-20at-cao-cap', 107, 'Modules\\Product\\Models\\ProductVariant', '2023-11-10 02:16:45', '2023-11-10 02:16:45'),
(120, 'hyundai-elantra-hyundai-elantra-do-16at-nline', 108, 'Modules\\Product\\Models\\ProductVariant', '2023-11-10 02:16:45', '2023-11-10 02:16:45'),
(121, 'hyundai-elantra-hyundai-elantra-xam-titan-16at-tieu-chuan', 109, 'Modules\\Product\\Models\\ProductVariant', '2023-11-10 02:16:45', '2023-11-10 02:16:45'),
(122, 'hyundai-elantra-hyundai-elantra-xam-titan-16at-dac-biet', 110, 'Modules\\Product\\Models\\ProductVariant', '2023-11-10 02:16:45', '2023-11-10 02:16:45'),
(123, 'hyundai-elantra-hyundai-elantra-xam-titan-20at-cao-cap', 111, 'Modules\\Product\\Models\\ProductVariant', '2023-11-10 02:16:45', '2023-11-10 02:16:45'),
(124, 'hyundai-elantra-hyundai-elantra-xam-titan-16at-nline', 112, 'Modules\\Product\\Models\\ProductVariant', '2023-11-10 02:16:45', '2023-11-10 02:16:45'),
(125, 'hyundai-elantra-hyundai-elantra-vang-ghi-16at-tieu-chuan', 113, 'Modules\\Product\\Models\\ProductVariant', '2023-11-10 02:16:45', '2023-11-10 02:16:45'),
(126, 'hyundai-elantra-hyundai-elantra-vang-ghi-16at-dac-biet', 114, 'Modules\\Product\\Models\\ProductVariant', '2023-11-10 02:16:45', '2023-11-10 02:16:45'),
(127, 'hyundai-elantra-hyundai-elantra-vang-ghi-20at-cao-cap', 115, 'Modules\\Product\\Models\\ProductVariant', '2023-11-10 02:16:45', '2023-11-10 02:16:45'),
(128, 'hyundai-elantra-hyundai-elantra-vang-ghi-16at-nline', 116, 'Modules\\Product\\Models\\ProductVariant', '2023-11-10 02:16:45', '2023-11-10 02:16:45'),
(129, 'hyundai-elantra-hyundai-elantra-xanh-duong-16at-tieu-chuan', 117, 'Modules\\Product\\Models\\ProductVariant', '2023-11-10 02:16:45', '2023-11-10 02:16:45'),
(130, 'hyundai-elantra-hyundai-elantra-xanh-duong-16at-dac-biet', 118, 'Modules\\Product\\Models\\ProductVariant', '2023-11-10 02:16:45', '2023-11-10 02:16:45'),
(131, 'hyundai-elantra-hyundai-elantra-xanh-duong-20at-cao-cap', 119, 'Modules\\Product\\Models\\ProductVariant', '2023-11-10 02:16:45', '2023-11-10 02:16:45'),
(132, 'hyundai-elantra-hyundai-elantra-xanh-duong-16at-nline', 120, 'Modules\\Product\\Models\\ProductVariant', '2023-11-10 02:16:45', '2023-11-10 02:16:45'),
(133, 'kieu-dang', 9, 'Modules\\Product\\Models\\ProductCategory', '2023-11-16 08:20:32', '2023-11-16 08:20:32'),
(134, 'so-cho-ngoi', 10, 'Modules\\Product\\Models\\ProductCategory', '2023-11-16 08:22:48', '2023-11-16 08:22:48'),
(135, 'das', 5, 'Modules\\Post\\Models\\Post', '2023-11-18 00:27:30', '2023-11-18 00:27:30'),
(136, 'bai-viet', 6, 'Modules\\Post\\Models\\Post', '2023-11-18 00:28:18', '2023-11-18 00:28:18');

-- --------------------------------------------------------

--
-- Table structure for table `taggables`
--

CREATE TABLE `taggables` (
  `tag_id` bigint(20) UNSIGNED NOT NULL,
  `taggable_id` bigint(20) UNSIGNED NOT NULL,
  `taggable_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `phone`, `email`, `password`, `status`, `role_id`, `email_verified_at`, `remember_token`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin', '9876543210', 'admin@gmail.com', '$2y$10$TPX.r0id/YJwMA9Zp8kJ8OqB.n0DkHHD1Yndhx5EBATMCuLfdEIqe', '1', 1, NULL, 'd6RxHHIaXpG7KoaabOKvyXigLX6bRhHSd1NsQLnZ2KDJhZnEPZpwc7IVBp38', NULL, '2020-10-15 16:30:41', '2023-11-09 02:42:24'),
(2, 'Nguyễn Văn A', 'Nguyễn Văn A', '0123456789', 'a@gmail.com', '$2y$10$r01IfvYwG70EdFgAzDgk6ua/4l8bo7pV9EmzOHK2zM8cHtQnTjVAW', '1', 2, NULL, NULL, NULL, '2023-11-10 08:18:02', '2023-11-10 08:18:02'),
(3, 'Nguyễn Văn B', 'Nguyễn Văn B', '0912345678', 'b@gmail.com', '$2y$10$zWuRC3Y4ga6FzkHIVsZxgu/Gdfi13ALaiHzK9j/qRbP0crE9.HPru', '1', 4, NULL, NULL, NULL, '2023-11-10 08:18:35', '2023-11-10 08:18:35'),
(4, 'Nguyễn Văn C', 'Nguyễn Văn C', '0981234567', 'c@gmail.com', '$2y$10$Yz5OCyHEKkf5lExvwLPfTuEWkz/PoYvNL/dFKx2u8f0A6ktieLDhW', '1', 2, NULL, NULL, NULL, '2023-11-10 08:19:02', '2023-11-10 08:20:17'),
(5, 'Nguyễn Văn D', 'Nguyễn Văn D', '0987123456', 'd@gmail.com', '$2y$10$Xci71FcHzZWtVpSl3EiiAOeAYebpCbq0D9MOyopwSkBs/GWEmr52C', '1', 3, NULL, NULL, NULL, '2023-11-10 08:19:38', '2023-11-10 08:19:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_attributes`
--
ALTER TABLE `product_attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_values`
--
ALTER TABLE `product_values`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slugs`
--
ALTER TABLE `slugs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_attributes`
--
ALTER TABLE `product_attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product_values`
--
ALTER TABLE `product_values`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=241;

--
-- AUTO_INCREMENT for table `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `slugs`
--
ALTER TABLE `slugs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
