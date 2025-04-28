-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2025 at 06:20 AM
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
-- Database: `trendnest`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `session_id` varchar(255) DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `session_id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 5, 1, '2025-04-27 17:39:23', '2025-04-27 17:39:23'),
(2, 1, NULL, 4, 1, '2025-04-27 17:39:28', '2025-04-27 17:39:28'),
(3, 1, NULL, 3, 1, '2025-04-27 17:39:32', '2025-04-27 17:39:32'),
(4, 2, NULL, 14, 1, '2025-04-27 23:07:05', '2025-04-27 23:07:05'),
(5, 2, NULL, 8, 1, '2025-04-27 23:07:10', '2025-04-27 23:07:10'),
(6, 2, NULL, 4, 1, '2025-04-27 23:13:21', '2025-04-27 23:13:21'),
(7, 2, NULL, 6, 1, '2025-04-27 23:18:03', '2025-04-27 23:18:03'),
(8, 2, NULL, 7, 1, '2025-04-27 23:18:39', '2025-04-27 23:18:39'),
(9, 2, NULL, 18, 1, '2025-04-27 23:22:41', '2025-04-27 23:22:41');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `featured_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `image_path`, `is_featured`, `featured_order`, `created_at`, `updated_at`) VALUES
(1, 'Home Appliances', 'category-images/Y0GR9z3CLGnaaTkiKAmAV1Qy5aK6xjoncfCpF31n.jpg', 0, 0, '2025-04-27 14:02:39', '2025-04-27 18:05:56'),
(2, 'Mobile Phones and Tablets', 'category-images/LF032wGcQkfpPMbpLyIRBhtJvIkQTMXXVkFw8NEN.jpg', 0, 0, '2025-04-27 14:03:39', '2025-04-27 18:26:55'),
(3, 'Fashion', 'category-images/6ad6UjeSBN1krdwZl9pKgdg3x2AwCa1fTHg4pfVz.jpg', 1, 1, '2025-04-27 14:03:49', '2025-04-27 18:21:02'),
(4, 'Electronics', 'category-images/SPB74hA6hB4Yc5MyZL2taCcTfjBl4QpNRMXRpqm5.jpg', 1, 3, '2025-04-27 14:04:08', '2025-04-27 18:24:37'),
(5, 'Computing', 'category-images/vphFSEq8hQwsGDSwzpaf74FAlzSdgl0OyZnOGpet.jpg', 1, 0, '2025-04-27 14:04:42', '2025-04-27 18:27:10');

-- --------------------------------------------------------

--
-- Table structure for table `default_attributes`
--

CREATE TABLE `default_attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `attribute_value` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `priority` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `question`, `answer`, `category`, `priority`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'How can I track my order?', 'You can track your order by logging into your account and visiting the \"Order History\" section. There you\'ll find the tracking number and current status of your order.', NULL, 1, 1, '2025-04-28 01:07:02', '2025-04-28 01:07:02'),
(2, 'What payment methods do you accept?', 'We accept various payment methods including credit/debit cards (Visa, MasterCard, American Express), PayPal, and bank transfers.', NULL, 2, 1, '2025-04-28 01:07:02', '2025-04-28 01:07:02'),
(3, 'What is your return policy?', 'We offer a 30-day return policy for most items. Products must be unused and in their original packaging. Please visit our Returns page for detailed information.', NULL, 3, 1, '2025-04-28 01:07:02', '2025-04-28 01:07:02'),
(4, 'How long does shipping take?', 'Standard shipping typically takes 3-5 business days within the country. International shipping can take 7-14 business days depending on the destination.', NULL, 4, 1, '2025-04-28 01:07:02', '2025-04-28 01:07:02'),
(5, 'Do you ship internationally?', 'Yes, we ship to most countries worldwide. Shipping costs and delivery times vary by location. You can check shipping rates at checkout.', NULL, 5, 1, '2025-04-28 01:07:02', '2025-04-28 01:07:02'),
(6, 'How can I contact customer support?', 'You can reach our customer support team through email at support@trendnest.com, by phone at 1-800-TREND, or through this chat feature. Our support hours are Monday-Friday, 9AM-6PM EST.', NULL, 6, 1, '2025-04-28 01:07:02', '2025-04-28 01:07:02');

-- --------------------------------------------------------

--
-- Table structure for table `home_page_settings`
--

CREATE TABLE `home_page_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `discounted_product_id` bigint(20) UNSIGNED NOT NULL,
  `discount_percent` decimal(10,2) NOT NULL,
  `discount_heading` varchar(255) NOT NULL,
  `discount_subheading` varchar(255) NOT NULL,
  `featured_1_id` bigint(20) UNSIGNED DEFAULT NULL,
  `featured_2_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_04_12_201257_create_categories_table', 1),
(5, '2025_04_13_110120_create_subcategories_table', 1),
(6, '2025_04_13_141526_create_default_attributes_table', 1),
(7, '2025_04_13_165200_create_stores_table', 1),
(8, '2025_04_14_065051_create_products_table', 1),
(9, '2025_04_14_081430_create_product_images_table', 1),
(10, '2025_04_22_164939_create_home_page_settings_table', 1),
(11, '2025_04_23_000000_create_carts_table', 1),
(12, '2025_04_23_124500_modify_stock_status_in_products', 1),
(13, '2025_04_23_124900_modify_stock_status_enum_in_products', 1),
(14, '2025_04_23_152633_create_wishlists_table', 1),
(15, '2025_04_27_183016_modify_product_price_columns', 2),
(16, '2025_04_27_202734_rename_visibility_column_in_products', 3),
(17, '2025_04_27_203340_add_image_to_categories_table', 4),
(18, '2025_04_27_204715_add_image_to_categories_table', 4),
(19, '2025_04_27_211626_add_featured_to_categories_table', 5),
(20, '2025_04_28_000001_add_featured_to_categories_table', 5),
(21, '2025_04_27_215136_add_profile_picture_to_users_table', 6),
(22, 'add_profile_picture_to_users_table', 6),
(23, '2025_04_27_221025_create_personal_access_tokens_table', 7),
(24, '2025_04_27_232627_create_orders_table', 8),
(25, '2025_04_28_000001_create_payment_methods_table', 8),
(26, '2025_04_28_000002_create_referrals_table', 8),
(27, '2025_04_28_034327_create_faqs_table', 9);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `order_number` varchar(255) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `payment_status` varchar(255) NOT NULL DEFAULT 'pending',
  `payment_method` varchar(255) NOT NULL,
  `shipping_address` text NOT NULL,
  `billing_address` text NOT NULL,
  `order_status` varchar(255) NOT NULL DEFAULT 'pending',
  `shipping_method` varchar(255) NOT NULL,
  `shipping_cost` decimal(8,2) NOT NULL DEFAULT 0.00,
  `tax_amount` decimal(8,2) NOT NULL DEFAULT 0.00,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `card_number` text NOT NULL,
  `expiry` varchar(255) NOT NULL,
  `card_holder` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `sku` varchar(255) NOT NULL,
  `seller_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `subcategory_id` bigint(20) UNSIGNED DEFAULT NULL,
  `store_id` bigint(20) UNSIGNED NOT NULL,
  `regular_price` decimal(15,2) NOT NULL,
  `discounted_price` decimal(15,2) DEFAULT NULL,
  `tax_rate` decimal(5,2) NOT NULL DEFAULT 0.00,
  `stock_quantity` int(11) NOT NULL DEFAULT 0,
  `stock_status` enum('in_stock','out_of_stock') DEFAULT 'in_stock',
  `slug` varchar(255) NOT NULL,
  `visibility` tinyint(1) NOT NULL DEFAULT 0,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `status` enum('draft','published') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `description`, `sku`, `seller_id`, `category_id`, `subcategory_id`, `store_id`, `regular_price`, `discounted_price`, `tax_rate`, `stock_quantity`, `stock_status`, `slug`, `visibility`, `meta_title`, `meta_description`, `status`, `created_at`, `updated_at`) VALUES
(2, 'ADH 658 Liters Side-by-side Refrigerator With Dispenser', 'This French-door refrigerator has a total no-frost multi-air flow system, which will keep your food fresh. The salad crisper will ensure your greens stay fresh for longer. The eco-energy function and holiday function will keep your electricity bills small. The fridge has an interior light, and the freezer box has a twist-style icemaker.', 'AD945HA45OHLINAFAMZ', 1, 1, 1, 1, 3500000.00, 2837900.00, 5.00, 50, 'in_stock', 'adh-658-liters-side-by-side-refrigerator-with-dispenser', 1, 'ADH 658 Liters Side-by-side Refrigerator With Dispenser', 'This French-door refrigerator has a total no-frost multi-air flow system, which will keep your food fresh. The salad crisper will ensure your greens stay fresh...', 'published', '2025-04-27 15:06:46', '2025-04-27 17:24:49'),
(3, 'Hisense 260 Liters Deep Chest Freezer', 'Hisense chest freezers provide reliable frozen storage and feature a convenient center-located lid handle and a quiet motor. The indicator light reassures you that power is supplied to the freezer. Rapidly lowers the temperature in the freezer by activating fast freeze in order to ensure your food is frozen quickly.it also come with an adjustable temperature. It is particularly useful when freezing large amounts of food.', 'HI368HA2ZADOJNAFAMZ', 1, 1, NULL, 1, 900000.00, 816600.00, 5.00, 50, 'in_stock', 'hisense-260-liters-deep-chest-freezer', 1, 'Hisense 260 Liters Deep Chest Freezer', 'Hisense chest freezers provide reliable frozen storage and feature a convenient center-located lid handle and a quiet motor. The indicator light reassures you t...', 'published', '2025-04-27 15:39:56', '2025-04-27 17:34:37'),
(4, 'Samsung Refurbished Galaxy S10', 'NETWORK Technology\r\nGSM / CDMA / HSPA / EVDO / LTE\r\n Speed HSPA 42.2/5.76 Mbps, LTE-A (7CA) Cat20 2000/150 Mbps\r\n BODY Dimensions 149.9 x 70.4 x 7.8 mm (5.90 x 2.77 x 0.31 in)\r\n Weight 157 g (5.54 oz)\r\n Build Glass front (Gorilla Glass 6), glass back (Gorilla Glass 5), aluminum frame\r\n DISPLAY Type Dynamic AMOLED, HDR10+\r\n Size 6.1 inches, 93.2 cm2 (~88.3% screen-to-body ratio)\r\n Resolution 1440 x 3040 pixels, 19:9 ratio (~550 ppi density)', 'RE626MP4L7J8SNAFAMZ', 1, 2, NULL, 1, 750000.00, 680000.00, 5.00, 65, 'in_stock', 'samsung-refurbished-galaxy-s10', 1, 'Samsung Refurbished Galaxy S10', 'NETWORK Technology\r\nGSM / CDMA / HSPA / EVDO / LTE\r\n Speed HSPA 42.2/5.76 Mbps, LTE-A (7CA) Cat20 2000/150 Mbps\r\n BODY Dimensions 149.9 x 70.4 x 7.8 mm (5.90 x...', 'published', '2025-04-27 15:46:19', '2025-04-27 17:34:58'),
(5, 'Apple Iphone 12 Pro 128GB', 'Network    Technology    \r\nGSM / CDMA / HSPA / EVDO / LTE / 5G\r\nLaunch    Announced    2020, October 13\r\nStatus    Available. Released 2020, October 23\r\nBody    Dimensions    146.7 x 71.5 x 7.4 mm (5.78 x 2.81 x 0.29 in)\r\nWeight    164 g (5.78 oz)\r\nBuild    Glass front (Corning-made glass), glass back (Corning-made glass), aluminum frame\r\nSIM    Nano-SIM + eSIM\r\nNano-SIM + Nano-SIM (China)\r\n    IP68 dust/water resistant (up to 6m for 30 min)\r\nApple Pay (Visa, MasterCard, AMEX certified)\r\nDisplay    Type    Super Retina XDR OLED, HDR10, Dolby Vision, 625 nits (HBM), 1200 nits (peak)\r\nSize    6.1 inches, 90.2 cm2 (~86.0% screen-to-body ratio)\r\nResolution    1170 x 2532 pixels, 19.5:9 ratio (~460 ppi density)', 'AP044MP41Y2H6NAFAMZ', 1, 2, NULL, 1, 2300000.00, 1550000.00, 5.00, 67, 'in_stock', 'apple-iphone-12-pro-128gb', 1, 'Apple Iphone 12 Pro 128GB', 'Network    Technology    \r\nGSM / CDMA / HSPA / EVDO / LTE / 5G\r\nLaunch    Announced    2020, October 13\r\nStatus    Available. Released 2020, October 23\r\nBody...', 'published', '2025-04-27 15:51:06', '2025-04-27 17:35:08'),
(6, 'Mini USB Portable Electric Fruit Blender', 'You can pack your blender to any where and you can blend your smoothies and juice from any where. Just charge your blender earlier and then u are set to go.\r\nIt has 6 blades and is a very powerful juicer despite its size. Enjoy fresh smoothies and juices from any where and at any time.', 'GE779HA0ZRYJRNAFAMZ', 1, 1, NULL, 1, 60000.00, 39500.00, 3.00, 80, 'in_stock', 'mini-usb-portable-electric-fruit-blender', 1, 'Mini USB Portable Electric Fruit Blender', 'You can pack your blender to any where and you can blend your smoothies and juice from any where. Just charge your blender earlier and then u are set to go.\r\nIt...', 'published', '2025-04-27 15:54:36', '2025-04-27 17:35:17'),
(7, 'Saachi Non Stick Dry Flat Iron NL-1R-1172', 'Saachi Non Stick Dry Flat Iron NL-1R-1172 - Silver,Grey\r\n\r\nFast and efficient - guaranteed   With speed shaped sole plate. Pointed tip for ironing tricky areas. The uniquely pointed tip allows you to iron even the hardest to reach areas . Non-stick sole plate coating: Non-stick sole plate coating. The sole plate of your Saachi iron is coated with a special non-stick layer for good gliding performance on all fabrics.', 'SA127HL000CXUNAFAMZ', 1, 1, NULL, 1, 59981.00, 35000.00, 3.00, 70, 'in_stock', 'saachi-non-stick-dry-flat-iron-nl-1r-1172', 1, 'Saachi Non Stick Dry Flat Iron NL-1R-1172', 'Saachi Non Stick Dry Flat Iron NL-1R-1172 - Silver,Grey\r\n\r\nFast and efficient - guaranteed   With speed shaped sole plate. Pointed tip for ironing tricky areas....', 'published', '2025-04-27 16:00:08', '2025-04-27 17:35:27'),
(8, 'SPJ 3 Gas Burner With 1 Electric 50X50 Standing Gas Cooker', 'SPJ offers affordable‎,‎ quality‎,‎ energy‎-efficient home appliances‎.‎ The brand is well known for their high‎-quality‎,‎ top of the range products and now they are all available on Jumia Uganda‎.‎ Order from this exclusive brand online in Uganda today and let us deliver right to your doorstep‎.', 'SP667HA1QOORFNAFAMZ', 1, 1, NULL, 1, 900000.00, 407400.00, 4.00, 45, 'in_stock', 'spj-3-gas-burner-with-1-electric-50x50-standing-gas-cooker', 1, 'SPJ 3 Gas Burner With 1 Electric 50X50 Standing Gas Cooker', 'SPJ offers affordable‎,‎ quality‎,‎ energy‎-efficient home appliances‎.‎ The brand is well known for their high‎-quality‎,‎ top of the range products and now th...', 'published', '2025-04-27 16:06:30', '2025-04-27 17:35:40'),
(9, 'PJ 1.8 Liter Electric Rice Cooker With Steamer, Stainless Steel Lid, Non-Stick Aluminium Inner Pot, Automatic Keep Warm Function', 'Superior Capacity:* This electric rice cooker has a generous 1.8L capacity, making it ideal for serving larger families or gatherings.\r\n*Automatic Keep Warm Function:* With the automatic keep-warm function, your cooked rice stays warm and is ready to serve for a longer period.\r\n*Non-Stick Inner Pot:* The electric cooker features a non-stick Aluminium inner pot, making it easy to clean and ensuring evenly cooked rice.\r\n*Complete Package:* Each rice cooker comes with a serving spoon and measuring cup to enhance your cooking experience.\r\n*Aluminium Steamer:* The electric rice cooker 1.8 L also features an Aluminium steamer, perfect for steaming vegetables or dumplings.\r\n*High Power Efficiency:* With a powerful 833 watts, this electric rice cooker ensures fast and efficient cooking.\r\n*Designed for Convenience:* The rice cooker measures 31.6*26.6*29.2 cm and has a net weight of ‎2.45 kg, making it a convenient addition to your kitchen.', 'SP667HA4ESXJGNAFAMZ', 1, 1, NULL, 1, 130000.00, 94700.00, 3.00, 59, 'in_stock', 'pj-18-liter-electric-rice-cooker-with-steamer-stainless-steel-lid-non-stick-aluminium-inner-pot-automatic-keep-warm-function', 0, 'PJ 1.8 Liter Electric Rice Cooker With Steamer, Stainless Steel Lid, Non-Stick Aluminium Inner Pot, Automatic Keep Warm Function', 'Superior Capacity:* This electric rice cooker has a generous 1.8L capacity, making it ideal for serving larger families or gatherings.\r\n*Automatic Keep Warm Fun...', 'published', '2025-04-27 16:12:14', '2025-04-27 16:12:37'),
(10, 'Bebe TAB B42 Pro+ / B42 Pro Plus/ B42pro+ 128 GB ROM 4GB RAM 7\'\' Inch Display Kids Learning And Games Tablet', 'The B42pro+ Kids Tablet, specially designed to be an ultra-portable model, offers your children all the applications necessary for their full development. Its design which fits perfectly in the palm of the hand will seduce your children. Very practical, The B42prp+ Kids Tablet offers a modern design and a multitude of learning games to spend fun and educational moments.', 'BE201MP1P360ZNAFAMZ', 1, 2, 5, 1, 220000.00, 148000.00, 3.00, 80, 'in_stock', 'bebe-tab-b42-pro-b42-pro-plus-b42pro-128-gb-rom-4gb-ram-7-inch-display-kids-learning-and-games-tablet', 0, 'Bebe TAB B42 Pro+ / B42 Pro Plus/ B42pro+ 128 GB ROM 4GB RAM 7\'\' Inch Display Kids Learning And Games Tablet', 'The B42pro+ Kids Tablet, specially designed to be an ultra-portable model, offers your children all the applications necessary for their full development. Its d...', 'published', '2025-04-27 16:16:51', '2025-04-27 16:16:51'),
(11, 'Apple iPad 3 16GB Wi-Fi + Sim Card Tablet 10 Inch Retina Display - Renewed + Free Smart Cover', 'Apple iPad 3 3rd Gen (WiFi  + Sim card ) / 16GB / MC744LL/A\r\n\r\nAn original product that has been professionally restored to working properly. This means the product has been inspected, cleaned, and repaired to meet manufacturer new product specifications and is in excellent condition. No scratches and scuffs. Including seller produced accessories and package box as original. Buy now\r\n\r\nThe 16GB iPad 3 with Wi-Fi  + Cellular (3rd Gen, Verizon, Black) from Apple features an incredibly thin design and even more power than its predecessors. The improved Retina display contains 4 times more pixels than the iPad 2 for outstanding clarity and sharpness with both text and images. A newly designed dual-core A5X chip with quad-core graphics provides a great deal of processing power and speed to compensate for the increase in resolution and delivers the same responsive feeling of the former models. This increase in power and resolution all come without the cost of lessened battery life; the iPad still features up to 10 hours of power between charging.', 'AP044MP4LE9VKNAFAMZ', 1, 2, NULL, 1, 500000.00, 299000.00, 5.00, 53, 'in_stock', 'apple-ipad-3-16gb-wi-fi-sim-card-tablet-10-inch-retina-display-renewed-free-smart-cover', 0, 'Apple iPad 3 16GB Wi-Fi + Sim Card Tablet 10 Inch Retina Display - Renewed + Free Smart Cover', 'Apple iPad 3 3rd Gen (WiFi  + Sim card ) / 16GB / MC744LL/A\r\n\r\nAn original product that has been professionally restored to working properly. This means the pro...', 'published', '2025-04-27 16:22:50', '2025-04-27 16:23:23'),
(12, 'TiLECC T800 Smart Watch Ultra 8 Door Access Smartwatch Series 8', 'High-definition bluetooth fairy tale, off-screen pointer, cover hand off screen, custom picture, APP background download picture, QR code (download, connection two-in-one), find mobile phone, calendar, motion track, restart, message push , remote camera, sleep monitoring, body temperature monitoring, weather, blood pressure, voice assistant, my QR code, button definition settings, blood oxygen, breathing, dial, pedometer, timer, menu style, factory reset, settings ( Screen off time, raise wrist to turn on screen, NFC, brightness, button definition, vibration intensity, do not disturb mode, password setting, language, time and date setting, connection APP, factory reset, restart, shutdown, about), phone (contacts, Call history, dial pad, call settings, emergency call), calculator, heart rate, language selection, information about the watch, alarm clock, sports mode, Bluetooth music, Bluetooth calls, stopwatch, screen off time, vibration intensity, time and date settings, password Lock.', 'GE779EA2H1NNFNAFAMZ', 1, 2, 6, 1, 56112.00, 25999.00, 3.00, 40, 'in_stock', 'tilecc-t800-smart-watch-ultra-8-door-access-smartwatch-series-8', 0, 'TiLECC T800 Smart Watch Ultra 8 Door Access Smartwatch Series 8', 'High-definition bluetooth fairy tale, off-screen pointer, cover hand off screen, custom picture, APP background download picture, QR code (download, connection...', 'published', '2025-04-27 16:30:08', '2025-04-27 16:30:08'),
(13, '20W Super Fast Charger For All Phones Type C To Type C-White', 'Super Fast Charging Charger For All Phones Type C -White\r\nComes with Type C charger but charges all types of phones, This Charger will charge your phone battery full in a space of 45 minutes\r\nCombine the function of charging and data transfer with this Android cable. It features an excellent and portable design making it easy to carry anywhere you go. It has a high resistance to pressure, very compatible with all android phones and ensures fast charging.\r\nFAST CHARGE AND SYNC CAPACITY:\r\nCharge & Sync at the Same Time, Charge your iPhone via connecting with Laptop and Transfer Data at the same time such as Music Videos Contacts Apps from laptops to android phones Perfect for Car Chargers, Powerbanks, Bedside Table and Work Desks\r\nDURABILITY AND RELIABILITY :\r\nHigh-quality & Durable Cable Made of high-quality material, 8 pins integrated head lightning connector made to last. We are confident that you will like our product. We quality check each and every cable before it leaves our warehouse.', 'GE779HL0BLADKNAFAMZ', 1, 2, 6, 1, 55000.00, 47000.00, 3.00, 100, 'in_stock', '20w-super-fast-charger-for-all-phones-type-c-to-type-c-white', 0, '20W Super Fast Charger For All Phones Type C To Type C-White', 'Super Fast Charging Charger For All Phones Type C -White\r\nComes with Type C charger but charges all types of phones, This Charger will charge your phone battery...', 'published', '2025-04-27 16:37:52', '2025-04-27 16:37:52'),
(14, 'Women Fashion V-Neck Sexy Sleeveless Print Summer Party High Slit Maxi Dress', 'Hello there! Welcome to our store! The preferential price and the quality of the upper level are our top priority.\r\nWomen Fashion V-Neck Sexy Sleeveless Print Summer Party High Slit Maxi Dress\r\nItem Specific:\r\nFashion design,100% Brand New,high quality! Season:Summer\r\nGender:Women\r\nOccasion: Daily\r\nMaterial:Polyester\r\nPattern Type:Print\r\nStyle:Casual\r\nLength:Regular\r\nFit:Fits ture to size', 'FA298MW0CIWE6NAFAMZ', 1, 3, NULL, 1, 60000.00, NULL, 3.00, 70, 'in_stock', 'women-fashion-v-neck-sexy-sleeveless-print-summer-party-high-slit-maxi-dress', 1, 'Women Fashion V-Neck Sexy Sleeveless Print Summer Party High Slit Maxi Dress', 'Hello there! Welcome to our store! The preferential price and the quality of the upper level are our top priority.\r\nWomen Fashion V-Neck Sexy Sleeveless Print S...', 'published', '2025-04-27 16:42:21', '2025-04-27 17:36:24'),
(15, 'Mateamoda Women Shoes Boots Heels Martin Boots Ankle Boots Ladies Shoes Combat Boots', 'Upper Material: PU（Artificial leather）\r\n\r\nSole: Material：Synthetic\r\n\r\nInner Material: Polyester\r\n\r\nClosure Type：Lace up\r\n\r\nHeel Type: Chunky heel\r\n\r\nHeel Height: 7 cm\r\n\r\nStyle: Fashion\r\n\r\nFeatures: Classic; Fashion', 'FA298FS2M7DWPNAFAMZ', 1, 3, 7, 1, 68500.00, 42990.00, 3.00, 40, 'in_stock', 'mateamoda-women-shoes-boots-heels-martin-boots-ankle-boots-ladies-shoes-combat-boots', 0, 'Mateamoda Women Shoes Boots Heels Martin Boots Ankle Boots Ladies Shoes Combat Boots', 'Upper Material: PU（Artificial leather）\r\n\r\nSole: Material：Synthetic\r\n\r\nInner Material: Polyester\r\n\r\nClosure Type：Lace up\r\n\r\nHeel Type: Chunky heel\r\n\r\nHeel He...', 'published', '2025-04-27 16:46:05', '2025-04-27 16:46:05'),
(16, 'Catpapa 1-6Years Kids Boy Boyurn-Down Collor Top + Shorts', '✨ High quality cotton blend, comfortable to wear, no harm for baby\'s skin.\r\n\r\n✨ Simple yet stylish, make your child\'s life more vivid .\r\n\r\n✨ Cute clothing for a daily wear or many occasions such as school, party, birthday, park, beach and any other special festival.\r\n\r\n✨ Garment Care : Machine or hand wash , tumble dry low or hang to dry .', 'CA208MW43LZT8NAFAMZ', 1, 3, 8, 1, 55270.00, 30399.00, 3.00, 50, 'in_stock', 'catpapa-1-6years-kids-boy-boyurn-down-collor-top-shorts', 0, 'Catpapa 1-6Years Kids Boy Boyurn-Down Collor Top + Shorts', '✨ High quality cotton blend, comfortable to wear, no harm for baby\'s skin.\r\n\r\n✨ Simple yet stylish, make your child\'s life more vivid .\r\n\r\n✨ Cute clothing fo...', 'published', '2025-04-27 16:50:19', '2025-04-27 16:50:19'),
(17, 'Korean Summer Baby Children Sleeveless Dot Flower Belt Girls Dress-White', 'Material: 85% cotton\r\n\r\nSuitable age: 3~8 years old\r\n\r\nSuggested height: 95~125 cm', 'GE779MW0UHVP7NAFAMZ', 1, 3, 8, 1, 60710.00, NULL, 3.00, 30, 'in_stock', 'korean-summer-baby-children-sleeveless-dot-flower-belt-girls-dress-white', 0, 'Korean Summer Baby Children Sleeveless Dot Flower Belt Girls Dress-White', 'Material: 85% cotton\r\n\r\nSuitable age: 3~8 years old\r\n\r\nSuggested height: 95~125 cm', 'published', '2025-04-27 16:54:54', '2025-04-27 16:54:54'),
(18, 'Hisense 43 Inch FHD LED VIDAA Smart Free To Air Tv', 'Hisense 43\" Frameless Digital smart  TV - Black\r\n43\" LED DisplayThe Hisense 43 inch HD LED TV’s makes a perfect addition to contemporary rooms. When switched on, the backlit LED screen churns out images and videos with amazing contrast and details.\r\nHigh Definition TVThe Hisense 43\" HD LED display generates amazingly clear, razor sharp images with a resolution of full HD. More over, it comes with the latest DVB-T2 technology for the best & clearest digital TV signals so you can enjoy in-built free local TV channels off the box.\r\nDigital LED TechnologyWitness the entire RCG spectrum brought to life on your screen. The Hisense LED TV brings you exceptionally vibrant and true-to-life images delivered just as the director imagined.\r\nUSB Digital Media PlayerProvides you the flexibility to enjoy not only photos or music, but also HD multimedia files directly in your TV via USB. Explorer More Connectivity OptionsThe TV features 1 USB 2.0 ports, and 3 HDMI ports to which you can connect your DVD players, cameras, external hard drives, and more. Now you can enjoy all your multimedia content of these gadgets on the big screen, right from the comfort of your couch. It also features audio input.\r\nTechnical Specifications\r\nDisplay•Technology: LED•Screen Size: 43 Inches •Resolution: Full HD•Display Ratio: 16:9; UHD Ready\r\nAudio•MAX Audio Output (RMS): 6W + 6W•Dolby Digital•Sound Equalizer•Audio File Format: MP3, AAc, M4A, WAV', 'HI368EA0DZ0RFNAFAMZ', 1, 4, NULL, 1, 1200015.00, 703300.00, 5.00, 50, 'in_stock', 'hisense-43-inch-fhd-led-vidaa-smart-free-to-air-tv', 1, 'Hisense 43 Inch FHD LED VIDAA Smart Free To Air Tv', 'Hisense 43\" Frameless Digital smart  TV - Black\r\n43\" LED DisplayThe Hisense 43 inch HD LED TV’s makes a perfect addition to contemporary rooms. When switched on...', 'published', '2025-04-27 16:59:08', '2025-04-27 17:36:43'),
(19, 'Samsung 43\" Inch 4K Crystal UHD Smart TV 2023 - Black', 'Boundless designUHD quad-core Processor HDR 10+  and purcolorReal 4K (4 X 1080p)slim designApple Airplay , screen mirroringBluetooth sound connectionAffordable Durable/ longlasting Original TV brand', 'SA948EA05VO4CNAFAMZ', 1, 4, 9, 1, 2999997.00, 2269900.00, 5.00, 30, 'in_stock', 'samsung-43-inch-4k-crystal-uhd-smart-tv-2023-black', 0, 'Samsung 43\" Inch 4K Crystal UHD Smart TV 2023 - Black', 'Boundless designUHD quad-core Processor HDR 10+  and purcolorReal 4K (4 X 1080p)slim designApple Airplay , screen mirroringBluetooth sound connectionAffordable...', 'published', '2025-04-27 17:04:16', '2025-04-27 17:04:16'),
(20, '4K Digital Video Camera With Stabilizers Kit', 'Parameters:\r\n1. Impact sensor: CMOS sensor\r\n2. Sensitivity: automatic, ISO100/200/400/800/1600\r\n3. Storage media: SD/SDHC card support, maximum 128GB\r\n4. Lens: fixed lens, F/2.6 f=7.0mm\r\n5. Focusing range: normal: 1m ~ infinity\r\n6. Photo format: JPG\r\n7. Video format: MP4\r\n8. Video resolution: 4K, 2.7K, 1080P (60fps), 1080P (30fps), 720P (60fps), 720P (30fps)\r\n9. Zoom: digital zoom\r\n10. WiFi function: support\r\n11. Anti-shake function: electronic anti-shake\r\n12. Face Detection: Support\r\n13. Display screen: 3.0-inch IPS LCD display\r\n14. Fill light function: less than 1.0M range\r\n15. White balance: automatic / daylight / cloudy / hook filament lamp / fluorescent light\r\n16. Exposure compensation: -3.0EV-+3.0EV\r\n17. Self-timer: Off / 2 seconds / 5 seconds / 10 seconds\r\n18. Auto shutdown: Off / 1 minute / 2 minutes / 3 minutes / 5 minutes / 10 minutes\r\n19. Power: 1500 mAh NP-40 lithium battery\r\n20. Size: 126 (L) X 58 (W) X 59 (H) mm\r\n21. Weight: 275+/-5g', 'GE779CM4XY33CNAFAMZ', 1, 4, 10, 1, 2208552.00, 1547092.00, 5.00, 40, 'in_stock', '4k-digital-video-camera-with-stabilizers-kit', 0, '4K Digital Video Camera With Stabilizers Kit', 'Parameters:\r\n1. Impact sensor: CMOS sensor\r\n2. Sensitivity: automatic, ISO100/200/400/800/1600\r\n3. Storage media: SD/SDHC card support, maximum 128GB\r\n4. Lens:...', 'published', '2025-04-27 17:08:58', '2025-04-27 17:08:58'),
(21, 'Hp Certified Refurbished 14\" EliteBook 840 Core I5, 8GB RAM, 500GB HDD Plus Free Bag - Silver', 'The HP EliteBook 840 thin and light notebook is ultra-mobile in and out of the office. Work with confidence thanks to proven enterprise technologies, security, performance, and management features that will meet all your enterprise’s needs. Give your fast-paced business an edge with the world’s most secure and manageable PCs. This Machine is an impressive Elite 840 with an elegant thin design, there is a perfect Elite solution for your business. Portable Powerhouse Combine high performance technology and good battery life with Intel Core i processors and a massive storage, this laptop has proven to be one of the best performer by HP. Drive performance with up to DDR3 RAM memory, and dual storage options for your most demanding business applications and fast access to data. Equipped for Productivity When it comes to power of connectivity, this becomes a must have laptop. Leave dongles behind with a drop-jaw Ethernet port, VGA port, and DisplayPort for key connections to all your devices. Stay connected with co-workers and customers with HP Connection Manager', 'HP246CL18UQGWNAFAMZ', 1, 5, 11, 1, 1100000.00, 617000.00, 3.00, 40, 'in_stock', 'hp-certified-refurbished-14-elitebook-840-core-i5-8gb-ram-500gb-hdd-plus-free-bag-silver', 0, 'Hp Certified Refurbished 14\" EliteBook 840 Core I5, 8GB RAM, 500GB HDD Plus Free Bag - Silver', 'The HP EliteBook 840 thin and light notebook is ultra-mobile in and out of the office. Work with confidence thanks to proven enterprise technologies, security,...', 'published', '2025-04-27 17:12:47', '2025-04-27 17:12:47'),
(22, 'DELL Latitude 7280 Core i7 6th Generation Refurbished Laptop with 16GB RAM and 512GB SSD', 'Description: The Dell Latitude 7280 is a high-performance laptop tailored for professionals who demand speed and efficiency. Featuring a powerful 6th generation Intel Core i7 processor, this refurbished model is equipped with 16GB of RAM and a spacious 512GB SSD, ensuring seamless multitasking and ample storage for your critical files.', 'DE168CL3G6JKRNAFAMZ', 1, 5, 11, 1, 1600000.00, 899910.00, 3.00, 45, 'in_stock', 'dell-latitude-7280-core-i7-6th-generation-refurbished-laptop-with-16gb-ram-and-512gb-ssd', 0, 'DELL Latitude 7280 Core i7 6th Generation Refurbished Laptop with 16GB RAM and 512GB SSD', 'Description: The Dell Latitude 7280 is a high-performance laptop tailored for professionals who demand speed and efficiency. Featuring a powerful 6th generation...', 'published', '2025-04-27 17:16:11', '2025-04-27 17:16:11');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `img_path` varchar(255) NOT NULL,
  `is_primary` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `img_path`, `is_primary`, `created_at`, `updated_at`) VALUES
(7, 2, 'product-images/1DITQoAMKnfthtLhnQV7d9NnwzlmLG74qBUEA3xS.jpg', 0, '2025-04-27 15:06:46', '2025-04-27 15:06:46'),
(8, 2, 'product-images/opkYY6OOjwWWeiWNWEkoxGrECF4MfaHdilPiLQ4p.jpg', 0, '2025-04-27 15:06:47', '2025-04-27 15:06:47'),
(9, 2, 'product-images/PJLXTnjXJkUEvsSsPMtMjRDNVSzyqsmUrq3bTouM.jpg', 0, '2025-04-27 15:06:47', '2025-04-27 15:06:47'),
(10, 3, 'product-images/aor7LGDdwBL1w6U6OXy37E4H1xPwWJQtf3y7E5IB.jpg', 0, '2025-04-27 15:39:56', '2025-04-27 15:39:56'),
(11, 3, 'product-images/sj6E98r6unk680j16WmlXcyV14xe8zqRHHMh9uU5.jpg', 0, '2025-04-27 15:39:56', '2025-04-27 15:39:56'),
(12, 4, 'product-images/NaNZ1O3mdUXV0J8FzCuJikVL3Y22ZR2AtKPk1re3.jpg', 0, '2025-04-27 15:46:19', '2025-04-27 15:46:19'),
(13, 4, 'product-images/4mOculGuqeSIflIyrm0KvaneeKWtWTMwh6YMgREG.jpg', 0, '2025-04-27 15:46:19', '2025-04-27 15:46:19'),
(14, 5, 'product-images/eKjwrKnhgXJqVinzI5bTYaz2HRCUoMFgDkHXWy7z.jpg', 0, '2025-04-27 15:51:06', '2025-04-27 15:51:06'),
(15, 5, 'product-images/26MNuNddFbducTorbCLlxGh53Xypnu72l6XgOch1.jpg', 0, '2025-04-27 15:51:06', '2025-04-27 15:51:06'),
(16, 6, 'product-images/41kckNoPVyCuKNVFprtKTNRjQ9DqH1dZFU9DNn7v.jpg', 0, '2025-04-27 15:54:36', '2025-04-27 15:54:36'),
(17, 6, 'product-images/eG88kmw65mZPK0HEQjcwHfUDwNr3wmXsXKhVtENl.jpg', 0, '2025-04-27 15:54:36', '2025-04-27 15:54:36'),
(19, 7, 'product-images/DNmbc7kIrUNvLbJ1rfJxWLYcl10vw96grggPeFwS.jpg', 1, '2025-04-27 16:00:08', '2025-04-27 16:01:18'),
(20, 7, 'product-images/N6e92qn8GXJUmO8FbBb04bu1UtvJscLV3HNjmQiw.jpg', 0, '2025-04-27 16:01:41', '2025-04-27 16:01:41'),
(21, 8, 'product-images/BskxN6sQeahgM7anj1Xt6Yjj2XejZvKIgWFB4Esr.jpg', 0, '2025-04-27 16:06:30', '2025-04-27 16:06:30'),
(22, 8, 'product-images/G0333TMMxwqngjIbbJciHhnM4ZgShmZv1WvubeYn.jpg', 0, '2025-04-27 16:06:56', '2025-04-27 16:06:56'),
(23, 8, 'product-images/qXklxAoNi6LezI42bxjoOChHlfB5Afvu5Kq3G90a.jpg', 0, '2025-04-27 16:06:56', '2025-04-27 16:06:56'),
(24, 9, 'product-images/2LW0TghePBGQ6K50TSf9aOcww3aqMcykIUhBqqE6.jpg', 0, '2025-04-27 16:12:14', '2025-04-27 16:12:14'),
(25, 9, 'product-images/kUESdFj3D7pUPHPiG4WSyKpVezztJT6lTa2YRuZO.jpg', 0, '2025-04-27 16:12:37', '2025-04-27 16:12:37'),
(26, 9, 'product-images/2DGwQtHKPxKp69cNp1UkFjeg9gEc4DK75FKQ8k2x.jpg', 0, '2025-04-27 16:12:38', '2025-04-27 16:12:38'),
(27, 10, 'product-images/cOfZifs8YSQxq270SmqSfIA9ZRg0JJIxcDd7oNcc.jpg', 0, '2025-04-27 16:16:52', '2025-04-27 16:16:52'),
(28, 10, 'product-images/acdaKTaNVwoze5asNEw1oNjiJzawbKGd5AvflWZB.jpg', 0, '2025-04-27 16:16:52', '2025-04-27 16:16:52'),
(29, 11, 'product-images/c69yf5XeII8DuoGCoKkSeJ4sX2wNmntr3y0RVChf.jpg', 0, '2025-04-27 16:22:50', '2025-04-27 16:22:50'),
(30, 11, 'product-images/q8T4Vajx9ng2Uuc8C7WkSMeDoO0QD98hhsFZOLFJ.jpg', 0, '2025-04-27 16:23:23', '2025-04-27 16:23:23'),
(31, 11, 'product-images/cYKqzCZxH7diSRRf1j83yQuv0R7JcuIOkZXcmYIs.jpg', 0, '2025-04-27 16:23:44', '2025-04-27 16:23:44'),
(32, 12, 'product-images/hCPkjMdCxAXMwpJLBwBJw2MHQAltLZv21skZcCG9.jpg', 0, '2025-04-27 16:30:08', '2025-04-27 16:30:08'),
(33, 12, 'product-images/cU7y8PinSdMUKuIa6JORyc11p3CVFKeuNIZhlJ4E.jpg', 0, '2025-04-27 16:30:56', '2025-04-27 16:30:56'),
(34, 12, 'product-images/fk8m5FaUGDZbzPEJXnhYlcHQ33xKGJvxId19iFaX.jpg', 0, '2025-04-27 16:30:56', '2025-04-27 16:30:56'),
(35, 13, 'product-images/8Pj6nZhMES3JJTwomhIxnU3l6v7l5YrxHeXFtdPj.jpg', 0, '2025-04-27 16:37:52', '2025-04-27 16:37:52'),
(36, 13, 'product-images/SO2gz9CYE3JmHB7vjfMsT28o0tK5W3RJ2BZaRSK6.jpg', 0, '2025-04-27 16:37:52', '2025-04-27 16:37:52'),
(37, 13, 'product-images/VQU3eLbqhd3RiYxDmLZNlfALLmoE0Yqn1we3USEC.jpg', 0, '2025-04-27 16:37:52', '2025-04-27 16:37:52'),
(38, 14, 'product-images/nXhIDemY8oYo2IW9RXZ2HuCxzovXm05xh2NYs2Pl.jpg', 0, '2025-04-27 16:42:21', '2025-04-27 16:42:21'),
(39, 14, 'product-images/xpIVDywNyKvY5XeBjNeKQMBIsOxpCdRZG1XvyEUL.jpg', 0, '2025-04-27 16:42:21', '2025-04-27 16:42:21'),
(40, 14, 'product-images/OsfKJ1nPlIdn8tjCE2K6buB4if3i71JHebnyoiuI.jpg', 0, '2025-04-27 16:42:21', '2025-04-27 16:42:21'),
(41, 15, 'product-images/G1o8pOHWfKmCj1w5wfetZ8Hx1z8lJhjHW57Lf7ue.jpg', 0, '2025-04-27 16:46:05', '2025-04-27 16:46:05'),
(42, 15, 'product-images/cbjVYndD0XUqlzvj8VuqCGzvkOm4pegy6Z63OecW.jpg', 0, '2025-04-27 16:46:06', '2025-04-27 16:46:06'),
(43, 15, 'product-images/Wa6C65xmvTbRrMVbCdhG9sqJ4Bx7VdFv0EnvrgTK.jpg', 0, '2025-04-27 16:46:06', '2025-04-27 16:46:06'),
(45, 16, 'product-images/C9ArXWWQ2AB40tAGK7KRxKhaQPghbqo27uUwvTUQ.jpg', 1, '2025-04-27 16:50:20', '2025-04-27 16:50:31'),
(46, 16, 'product-images/vdFUOffwsSClBnjjgEZ1zpZm5gJ10NGksW1hTryk.jpg', 0, '2025-04-27 16:50:45', '2025-04-27 16:50:45'),
(47, 17, 'product-images/bKyq7AuUT9zaVQ14MedHcOX1TK4rm4JNsxN3CJH0.jpg', 0, '2025-04-27 16:54:54', '2025-04-27 16:54:54'),
(48, 17, 'product-images/Uwr2Zjd5AJDqImFZN0xLhb1RxyXwiXuLeJFMv6hQ.jpg', 0, '2025-04-27 16:54:54', '2025-04-27 16:54:54'),
(49, 18, 'product-images/8Z1F3EhnGrWi74ZNYkHYbN6UnKiNoZerODJHUWjx.jpg', 0, '2025-04-27 16:59:08', '2025-04-27 16:59:08'),
(50, 18, 'product-images/HdSsyiMqoURIXvbW8NfpYoKPAAtsBWjLU9j88aQm.jpg', 0, '2025-04-27 16:59:08', '2025-04-27 16:59:08'),
(51, 18, 'product-images/QnDrzdsdyvywKTzuPzwvtPjsZyAC2LhJO056sfjz.jpg', 0, '2025-04-27 16:59:08', '2025-04-27 16:59:08'),
(52, 19, 'product-images/g9dAZbsl0E8XOAZdSfw6brctAxhBPWZompBg0ufT.jpg', 0, '2025-04-27 17:04:17', '2025-04-27 17:04:17'),
(53, 19, 'product-images/muvgAIH7ofpMGKMGDCFcSRe3oeGInTtJYxmdxcgO.jpg', 0, '2025-04-27 17:04:17', '2025-04-27 17:04:17'),
(54, 19, 'product-images/lmBlumtv2u8J3XmvE0pbiDeS2fcnyXDHj3IMP6t1.jpg', 0, '2025-04-27 17:04:17', '2025-04-27 17:04:17'),
(55, 20, 'product-images/mUvkQrDWWSbxJPKTRnGHkmSIKEwmNj8YE4k8Mhun.jpg', 0, '2025-04-27 17:08:58', '2025-04-27 17:08:58'),
(56, 20, 'product-images/m3GxnBUdUlizolKjXx92kH51I7n3P3Krx5cvyned.jpg', 0, '2025-04-27 17:08:58', '2025-04-27 17:08:58'),
(57, 21, 'product-images/M4YnsTAXt4t0111nTmujevueOMD3bSt96FUoSTOf.jpg', 0, '2025-04-27 17:12:47', '2025-04-27 17:12:47'),
(58, 21, 'product-images/oks6OPJB8ftDwWRwiCW7waFykhy2gmUD5LYHHwBA.jpg', 0, '2025-04-27 17:12:47', '2025-04-27 17:12:47'),
(59, 21, 'product-images/g9b3WFlPX4BpTXnijSWsc3lswsspCx4392WWD0gm.jpg', 0, '2025-04-27 17:12:47', '2025-04-27 17:12:47'),
(60, 22, 'product-images/h4eebV32amZnHwwaSfnK7Vp5nvMOP6JCJ84npQRc.jpg', 0, '2025-04-27 17:16:11', '2025-04-27 17:16:11'),
(61, 22, 'product-images/Vqv8SGt7tvJRzcEUeWQCPr0dtWb0jnLuQ9vdDCir.jpg', 0, '2025-04-27 17:16:11', '2025-04-27 17:16:11');

-- --------------------------------------------------------

--
-- Table structure for table `referrals`
--

CREATE TABLE `referrals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `referrer_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('pending','active','completed') NOT NULL DEFAULT 'pending',
  `commission` decimal(10,2) NOT NULL DEFAULT 0.00,
  `paid` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('InCDq1JBwCGyWehmBGGtgTwxS9fEjr2hjdGBzyU0', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicFFZd2pzMHo0VFhZbnVxY2FrWEkzMXhFVGZvTVRGRzIwY0lEbXdySCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1745813451);

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `store_name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `details` longtext NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`id`, `store_name`, `slug`, `details`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Jumia', 'jumia', 'Best shoppers', 1, '2025-04-27 14:21:11', '2025-04-27 14:21:11'),
(2, 'Trend Store', 'trend-store', 'All trends', 1, '2025-04-27 17:17:35', '2025-04-27 17:17:35');

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subcategory_name` varchar(255) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `subcategory_name`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'Large Appliances', 1, '2025-04-27 14:06:12', '2025-04-27 14:06:12'),
(2, 'Small Appliances', 1, '2025-04-27 14:06:51', '2025-04-27 14:06:51'),
(3, 'Cooking Appliances', 1, '2025-04-27 14:07:26', '2025-04-27 14:07:26'),
(4, 'Mobile Phones', 2, '2025-04-27 14:08:02', '2025-04-27 14:08:02'),
(5, 'Tablets', 2, '2025-04-27 14:08:43', '2025-04-27 14:08:43'),
(6, 'Phone Accessories', 2, '2025-04-27 14:09:33', '2025-04-27 14:09:33'),
(7, 'Women\'s Collection', 3, '2025-04-27 14:10:13', '2025-04-27 14:10:13'),
(8, 'Kid\'s Collection', 3, '2025-04-27 14:15:06', '2025-04-27 14:15:06'),
(9, 'Television & Video', 4, '2025-04-27 14:15:40', '2025-04-27 14:15:40'),
(10, 'Camera & Photos', 4, '2025-04-27 14:16:12', '2025-04-27 14:16:12'),
(11, 'Laptops', 5, '2025-04-27 14:16:57', '2025-04-27 14:16:57');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `role` tinyint(4) NOT NULL DEFAULT 2,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `profile_picture`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'ssemart', 'test@example.com', 'profile-pictures/SsDhnc9vob.jpg', 0, NULL, '$2y$12$s4Zz79S2KO7nIgDST/x79unFIwndlfPU/pquHr8pHplHqs1wYjGD2', NULL, '2025-04-27 13:59:10', '2025-04-27 19:14:52'),
(2, 'User', 'test1@example.com', NULL, 2, NULL, '$2y$12$fWurHV7CgVi7091ijV7.Pey2UCOLnIN5gsz3TUwuwV.KTiKmp3RBe', NULL, '2025-04-27 14:22:13', '2025-04-27 14:22:13'),
(3, 'seller', 'test2@example.com', NULL, 1, NULL, '$2y$12$GcLTUrsALjdrE6/wWAVT3O7ad5gTA1styhoNSGmXczytoElw/3zgW', NULL, '2025-04-27 14:23:22', '2025-04-27 14:23:22');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`),
  ADD KEY `carts_product_id_foreign` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `default_attributes`
--
ALTER TABLE `default_attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_page_settings`
--
ALTER TABLE `home_page_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `home_page_settings_discounted_product_id_foreign` (`discounted_product_id`),
  ADD KEY `home_page_settings_featured_1_id_foreign` (`featured_1_id`),
  ADD KEY `home_page_settings_featured_2_id_foreign` (`featured_2_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_number_unique` (`order_number`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_methods_user_id_foreign` (`user_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_sku_unique` (`sku`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD KEY `products_seller_id_foreign` (`seller_id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_subcategory_id_foreign` (`subcategory_id`),
  ADD KEY `products_store_id_foreign` (`store_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `referrals`
--
ALTER TABLE `referrals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `referrals_referrer_id_foreign` (`referrer_id`),
  ADD KEY `referrals_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stores_user_id_foreign` (`user_id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subcategories_category_id_foreign` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `wishlists_user_id_product_id_unique` (`user_id`,`product_id`),
  ADD KEY `wishlists_product_id_foreign` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `default_attributes`
--
ALTER TABLE `default_attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `home_page_settings`
--
ALTER TABLE `home_page_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `referrals`
--
ALTER TABLE `referrals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `home_page_settings`
--
ALTER TABLE `home_page_settings`
  ADD CONSTRAINT `home_page_settings_discounted_product_id_foreign` FOREIGN KEY (`discounted_product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `home_page_settings_featured_1_id_foreign` FOREIGN KEY (`featured_1_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `home_page_settings_featured_2_id_foreign` FOREIGN KEY (`featured_2_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD CONSTRAINT `payment_methods_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_seller_id_foreign` FOREIGN KEY (`seller_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_subcategory_id_foreign` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `referrals`
--
ALTER TABLE `referrals`
  ADD CONSTRAINT `referrals_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `referrals_referrer_id_foreign` FOREIGN KEY (`referrer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stores`
--
ALTER TABLE `stores`
  ADD CONSTRAINT `stores_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `subcategories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
