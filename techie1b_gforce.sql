-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2023 at 12:39 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `techie1b_gforce`
--

-- --------------------------------------------------------

--
-- Table structure for table `achivement_tbl`
--

CREATE TABLE `achivement_tbl` (
  `id` int(10) NOT NULL,
  `title` varchar(250) NOT NULL,
  `image` varchar(250) NOT NULL,
  `description` longtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `achivement_tbl`
--

INSERT INTO `achivement_tbl` (`id`, `title`, `image`, `description`, `created_at`, `updated_at`) VALUES
(1, '4 Professional dance instructors', '2023051518012289790545t5t 1.png', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', '2023-05-15 09:43:40', '2023-05-17 11:14:54'),
(2, '10+ Years of experience', '2023051518011399523082uytre 1.png', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', '2023-05-15 09:45:24', '2023-05-17 11:14:22'),
(3, '3000 Happy students', '2023051518002118770762hgfds 1.png', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', '2023-05-15 09:46:55', '2023-05-17 11:14:16'),
(4, '4 Flexible program', '20230515180072440494calender.png', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', '2023-05-15 09:47:23', '2023-05-26 07:05:23');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `student_id` int(250) NOT NULL,
  `type` varchar(250) NOT NULL,
  `date` varchar(250) NOT NULL,
  `time` varchar(250) NOT NULL,
  `class_id` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `student_id`, `type`, `date`, `time`, `class_id`) VALUES
(46, 23, 'workshop', '5/26/2023', '11:35:07 AM', 17),
(47, 23, 'workshop', '5/26/2023', '12:08:05 PM', 17),
(48, 23, 'workshop', '5/26/2023', '12:22:31 PM', 17);

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `postContent` longtext NOT NULL,
  `categoryId` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `page_title` longtext DEFAULT NULL,
  `page_description` longtext DEFAULT NULL,
  `page_schema` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `userId`, `title`, `status`, `postContent`, `categoryId`, `image`, `created_at`, `updated_at`, `page_title`, `page_description`, `page_schema`) VALUES
(19, 1, 'Lorem Ipsum is simply', '1', '<div><div><div><div><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.<br /></p><br /></div><br /></div><br /></div><br /></div>', 27, '20230606110819082778921.jpg', '2023-04-14 02:34:21', '2023-06-06 05:38:27', 'Lorem Ipsum is simply', 'Lorem Ipsum is simply', 'Lorem Ipsum is simply'),
(20, 1, 'Lorem Ipsum is simply', '1', '<div><div><div><div><div><div><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.<br /></p><br /></div><br /></div><br /></div><br /></div><br /></div><br /></div>', 28, '2023060611084207498942.jpg', '2023-04-14 02:34:50', '2023-06-06 05:38:41', 'Lorem Ipsum is simply', 'Lorem Ipsum is simply', 'Lorem Ipsum is simply'),
(22, 1, 'Lorem Ipsum is simply', '1', '<div><div><p>\r\n\r\n<span style=\"color: rgb(33, 37, 41); font-family: Montserrat; font-size: 12px; background-color: rgb(255, 255, 255)\">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</span>\r\n<br /></p><br /></div><br /></div>', 27, '2023060611082102194313.jpg', '2023-04-24 04:46:49', '2023-06-06 05:38:51', 'Lorem Ipsum is simply', 'Lorem Ipsum is simply', 'Lorem Ipsum is simply'),
(23, 1, 'Praveen test', '1', '<div><p><span style=\"color: rgb(189, 193, 198); font-family: arial, sans-serif; font-size: 14px; background-color: rgb(32, 33, 36);\"></span></p>\r\nIn publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available\r\n<br />\r\nIn publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available\r\n<br />\r\nIn publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available\r\n<br />\r\nIn publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available\r\n<br />\r\nIn publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available\r\n<div><p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available<br /></p><p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available<br /></p><p><br /></p><p><br /></p></div><br /></div>', 19, '2023060611091678372903.jpg', '2023-05-15 07:23:44', '2023-06-06 05:39:08', 'test data', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available\r\nIn publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available\r\nIn publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available', ''),
(24, 1, 'Test', '1', '<div><div><div><p>\r\n\r\n<span style=\"color: rgb(33, 37, 41); font-family: Lora, serif; font-size: 16px; background-color: rgb(229, 233, 238)\">In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum<span>&nbsp;</span></span>\r\n</p><br /></div><br /></div><br /></div>', 28, '202306061109339178831.jpg', '2023-05-15 12:03:04', '2023-06-06 05:39:50', 'Test', 'Test', 'Test'),
(25, 1, 'test2', '1', '<div><p>\r\n\r\n</p>\r\nIn publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available\r\n<br />\r\n<p>In publishing and graphic design, LoreIn publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available<br /><br />In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available<br /><br />In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is availablem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available</p><br /></div>', 27, '2023060611095755615282.jpg', '2023-05-24 09:42:01', '2023-06-06 05:39:24', 'sdnfksflwkjdf', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available\r\nIn publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available\r\nIn publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available\r\nIn publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available', 'wdgfdfgsf');

-- --------------------------------------------------------

--
-- Table structure for table `blogcategory`
--

CREATE TABLE `blogcategory` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blogcategory`
--

INSERT INTO `blogcategory` (`id`, `name`, `created_at`, `updated_at`) VALUES
(19, 'G force Blog', '2023-04-06 02:40:45', '2023-04-06 02:40:45'),
(27, 'Cat-2', '2023-04-14 05:13:09', '2023-04-14 05:13:09'),
(28, 'Updated Category', '2023-05-17 05:56:08', '2023-05-17 05:56:08');

-- --------------------------------------------------------

--
-- Table structure for table `booking_tbl`
--

CREATE TABLE `booking_tbl` (
  `id` int(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `concert` varchar(255) DEFAULT NULL,
  `paymode` varchar(255) NOT NULL,
  `payid` varchar(255) NOT NULL,
  `seats` varchar(255) DEFAULT NULL,
  `status` enum('0','1') NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `type` varchar(250) DEFAULT NULL,
  `price` varchar(250) DEFAULT NULL,
  `booking_id` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `booking_tbl`
--

INSERT INTO `booking_tbl` (`id`, `name`, `email`, `phone`, `concert`, `paymode`, `payid`, `seats`, `status`, `created_at`, `updated_at`, `type`, `price`, `booking_id`) VALUES
(1, 'test test test', 'harman7b@gmail.com', '9876542310', NULL, 'Online', 'pm_1NBsMLSIJfK1r3R9HM4SC93p', NULL, '1', '2023-05-26 04:34:39', '2023-05-26 04:34:39', 'workshop', '1000', '17'),
(2, 'test test test', 'harman7b@gmail.com', '9876542310', NULL, 'Online', 'pm_1NBsNCSIJfK1r3R97rKNy53S', NULL, '1', '2023-05-26 04:35:31', '2023-05-26 04:35:31', 'openClass', '300', '5');

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `fulllocation` varchar(250) NOT NULL,
  `city` varchar(250) NOT NULL,
  `state` varchar(250) NOT NULL,
  `phone` varchar(250) NOT NULL,
  `country` varchar(250) NOT NULL,
  `des` longtext NOT NULL,
  `img` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`id`, `name`, `fulllocation`, `city`, `state`, `phone`, `country`, `des`, `img`) VALUES
(1, 'Quezon City', 'Quezon City, Metro Manila, Philippines', '$req->city', '$req->state', '9873216540', '$req->country', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an', '2023041911492100774365Untitled design (10) 1.png'),
(2, 'Cebu City', 'Cebu City, Cebu, Philippines', '$req->city', '$req->state', '7895641230', '$req->country', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an', '202304191155296699677Untitled design (10) 1.png'),
(3, 'Alabang', 'Alabang, Muntinlupa, Metro Manila, Philippines', '$req->city', '$req->state', '9781771170', '$req->country', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an', '202304191156142224124Untitled design (10) 1.png'),
(7, 'Dubai', 'Dubai - United Arab Emirates', '$req->city', '$req->state', '1234567890', '$req->country', 'This Branch is located Dubai - United Arab Emirates', '202305121343680695279logo.png'),
(8, 'Menus', 'Philippeville, Belgium', '$req->city', '$req->state', '9876542310', '$req->country', 'Test', '2023051510421427726555MENUS.png');

-- --------------------------------------------------------

--
-- Table structure for table `carrer_tbl`
--

CREATE TABLE `carrer_tbl` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `intrestedin` varchar(255) NOT NULL,
  `resume` varchar(255) DEFAULT NULL,
  `coverlatter` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carrer_tbl`
--

INSERT INTO `carrer_tbl` (`id`, `name`, `email`, `phone`, `intrestedin`, `resume`, `coverlatter`, `message`, `created_at`, `updated_at`) VALUES
(1, 'jitendra singh', 'js@gmail.com', '9876543210', 'Development', 'luca-micheli-ruWkmt3nU58-unsplash (1).jpg', 'Rectangle 36.png', 'Hello New', '2023-05-25 09:52:57', '2023-05-25 09:52:57');

-- --------------------------------------------------------

--
-- Table structure for table `cart_tbl`
--

CREATE TABLE `cart_tbl` (
  `id` int(10) NOT NULL,
  `pro_id` varchar(250) NOT NULL,
  `quantity` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `userId` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart_tbl`
--

INSERT INTO `cart_tbl` (`id`, `pro_id`, `quantity`, `created_at`, `updated_at`, `userId`) VALUES
(23, '2', '1', '2023-06-12 06:05:02', '2023-06-12 06:05:02', '2'),
(26, '6', '2', '2023-06-12 09:50:00', '2023-06-12 09:50:00', '1'),
(28, '5', '1', '2023-06-12 09:56:44', '2023-06-12 09:56:44', '1'),
(29, '6', '4', '2023-06-13 07:20:22', '2023-06-13 07:20:22', '1'),
(30, '2', '1', '2023-06-14 06:54:18', '2023-06-14 06:54:18', '1');

-- --------------------------------------------------------

--
-- Table structure for table `contact_tbl`
--

CREATE TABLE `contact_tbl` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_tbl`
--

INSERT INTO `contact_tbl` (`id`, `name`, `email`, `phone`, `message`, `created_at`, `updated_at`) VALUES
(1, 'jitendra singh', 'js@gmail.com', '9876543210', 'Hello this is just for testing purpses.', '2023-05-25 07:11:34', '2023-05-25 07:11:34'),
(3, 'Tiger Valdez', 'qadufavec@mailinator.com', '9876543210', 'Sint laboriosam vol', '2023-06-09 10:14:28', '2023-06-09 10:14:28'),
(4, 'Tiger Valdez', 'qadufavec@mailinator.com', '9876543210', 'Sint laboriosam vol', '2023-06-09 10:14:49', '2023-06-09 10:14:49'),
(5, 'Tiger Valdez', 'qadufavec@mailinator.com', '9876543210', 'Sint laboriosam vol', '2023-06-09 10:14:59', '2023-06-09 10:14:59'),
(9, 'Jitendra Singh', 'js@gmail.com', '9876543210', 'Hello, this is just for testing purposes.', '2023-06-09 10:19:37', '2023-06-09 10:19:37');

-- --------------------------------------------------------

--
-- Table structure for table `credit_store`
--

CREATE TABLE `credit_store` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `credits` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customize`
--

CREATE TABLE `customize` (
  `id` int(11) NOT NULL,
  `footer_desc` longtext NOT NULL,
  `dance_desc` longtext NOT NULL,
  `c_number` varchar(250) NOT NULL,
  `w_number` varchar(250) NOT NULL,
  `ameneties` longtext DEFAULT NULL,
  `header_code` longtext DEFAULT NULL,
  `footer_code` longtext DEFAULT NULL,
  `cUsEmail` varchar(250) DEFAULT NULL,
  `creersEmail` varchar(250) DEFAULT NULL,
  `page_title` longtext DEFAULT NULL,
  `page_description` longtext DEFAULT NULL,
  `page_schema` longtext DEFAULT NULL,
  `abt_title` varchar(250) NOT NULL,
  `abt_sub_title` varchar(250) NOT NULL,
  `abt_description` longtext NOT NULL,
  `abt_image` varchar(250) NOT NULL,
  `banner_image` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customize`
--

INSERT INTO `customize` (`id`, `footer_desc`, `dance_desc`, `c_number`, `w_number`, `ameneties`, `header_code`, `footer_code`, `cUsEmail`, `creersEmail`, `page_title`, `page_description`, `page_schema`, `abt_title`, `abt_sub_title`, `abt_description`, `abt_image`, `banner_image`) VALUES
(1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book', '+97143739500', 'Miles Wig Making LLC, 26th St.,Al-Quoz industrial Area2, P.O. Box:\r\n29878, Dubai, United Arab Emirates.', '[{\"id\":1,\"icon\":\"fab fa-facebook\",\"text\":\"https://www.facebook.com/GForceOfficial/\",\"img\":\"202305181217413379520Rectangle 39.png\"},{\"id\":2,\"icon\":\"fab fa-instagram\",\"text\":\"https://www.instagram.com/gforce_official/\",\"img\":\"202305181217807853064Rectangle 38.png\"},{\"id\":3,\"icon\":\"fab fa-tiktok\",\"text\":\"https://www.tiktok.com/@gforce_official\",\"img\":\"2023051812182139398587Rectangle 37.png\"},{\"id\":4,\"icon\":\"fab fa-twitter\",\"text\":\"https://twitter.com/gforce_official\",\"img\":\"2023051812181594443087Rectangle 36.png\"}]', '<!-- Meta Pixel Code -->\r\n  <script>\r\n\r\n    !(function (f, b, e, v, n, t, s) {\r\n      if (f.fbq) return;\r\n      n = f.fbq = function () {\r\n        n.callMethod\r\n          ? n.callMethod.apply(n, arguments)\r\n          : n.queue.push(arguments);\r\n      };\r\n      if (!f._fbq) f._fbq = n;\r\n      n.push = n;\r\n      n.loaded = !0;\r\n      n.version = \"2.0\";\r\n      n.queue = [];\r\n      t = b.createElement(e);\r\n      t.async = !0;\r\n      t.src = v;\r\n      s = b.getElementsByTagName(e)[0];\r\n      s.parentNode.insertBefore(t, s);\r\n    })(\r\n      window,\r\n      document,\r\n      \"script\",\r\n      \"https://connect.facebook.net/en_US/fbevents.js\"\r\n    );\r\n    fbq(\"init\", \"498730972354209\");\r\n    fbq(\"track\", \"PageView\");\r\n  </script>\r\n  <noscript\r\n    ><img\r\n      height=\"1\"\r\n      width=\"1\"\r\n      style=\"display: none\"\r\n      src=\"https://www.facebook.com/tr?id=498730972354209&ev=PageView&noscript=1\"\r\n  /></noscript>\r\n  <!-- End Meta Pixel Code -->\r\n  <!-- Google tag (gtag.js) -->\r\n  <script\r\n    async\r\n    src=\"https://www.googletagmanager.com/gtag/js?id=G-BHXR0NYFFE\"\r\n  ></script>\r\n  <script>\r\n    window.dataLayer = window.dataLayer || [];\r\n    function gtag() {\r\n      dataLayer.push(arguments);\r\n    }\r\n    gtag(\"js\", new Date());\r\n    gtag(\"config\", \"G-BHXR0NYFFE\");\r\n  </script>\r\n  <script type=\"text/javascript\" id=\"zsiqchat\">\r\n    var $zoho = $zoho || {};\r\n    $zoho.salesiq = $zoho.salesiq || {\r\n      widgetcode:\r\n        \"1210e83a9fdf8bb9e34d335cc2a17ddbbdf9767d453855d468b71dd1a16e9c5f\",\r\n      values: {},\r\n      ready: function () {},\r\n    };\r\n    var d = document;\r\n    s = d.createElement(\"script\");\r\n    s.type = \"text/javascript\";\r\n    s.id = \"zsiqscript\";\r\n    s.defer = true;\r\n    s.src = \"https://salesiq.zoho.com/widget?plugin_source=wordpress\";\r\n    t = d.getElementsByTagName(\"script\")[0];\r\n    t.parentNode.insertBefore(s, t);\r\n  </script>', '<!-- Meta Pixel Code -->\r\n  <script>\r\n\r\n    !(function (f, b, e, v, n, t, s) {\r\n      if (f.fbq) return;\r\n      n = f.fbq = function () {\r\n        n.callMethod\r\n          ? n.callMethod.apply(n, arguments)\r\n          : n.queue.push(arguments);\r\n      };\r\n      if (!f._fbq) f._fbq = n;\r\n      n.push = n;\r\n      n.loaded = !0;\r\n      n.version = \"2.0\";\r\n      n.queue = [];\r\n      t = b.createElement(e);\r\n      t.async = !0;\r\n      t.src = v;\r\n      s = b.getElementsByTagName(e)[0];\r\n      s.parentNode.insertBefore(t, s);\r\n    })(\r\n      window,\r\n      document,\r\n      \"script\",\r\n      \"https://connect.facebook.net/en_US/fbevents.js\"\r\n    );\r\n    fbq(\"init\", \"498730972354209\");\r\n    fbq(\"track\", \"PageView\");\r\n  </script>\r\n  <noscript\r\n    ><img\r\n      height=\"1\"\r\n      width=\"1\"\r\n      style=\"display: none\"\r\n      src=\"https://www.facebook.com/tr?id=498730972354209&ev=PageView&noscript=1\"\r\n  /></noscript>\r\n  <!-- End Meta Pixel Code -->\r\n  <!-- Google tag (gtag.js) -->\r\n  <script\r\n    async\r\n    src=\"https://www.googletagmanager.com/gtag/js?id=G-BHXR0NYFFE\"\r\n  ></script>\r\n  <script>\r\n    window.dataLayer = window.dataLayer || [];\r\n    function gtag() {\r\n      dataLayer.push(arguments);\r\n    }\r\n    gtag(\"js\", new Date());\r\n    gtag(\"config\", \"G-BHXR0NYFFE\");\r\n  </script>\r\n  <script type=\"text/javascript\" id=\"zsiqchat\">\r\n    var $zoho = $zoho || {};\r\n    $zoho.salesiq = $zoho.salesiq || {\r\n      widgetcode:\r\n        \"1210e83a9fdf8bb9e34d335cc2a17ddbbdf9767d453855d468b71dd1a16e9c5f\",\r\n      values: {},\r\n      ready: function () {},\r\n    };\r\n    var d = document;\r\n    s = d.createElement(\"script\");\r\n    s.type = \"text/javascript\";\r\n    s.id = \"zsiqscript\";\r\n    s.defer = true;\r\n    s.src = \"https://salesiq.zoho.com/widget?plugin_source=wordpress\";\r\n    t = d.getElementsByTagName(\"script\")[0];\r\n    t.parentNode.insertBefore(s, t);\r\n  </script>', 'contact@demo.com', 'contact@demo.com', 'G force Official', 'G force Official', 'G force Official', 'ABOUT CHRIST', 'LOREM IPSUM IS SIMPLY DUMMY', 'There are many variations of passages of Lorem Ipsum available, majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly kn je believable There are manations of passages of Lorem Ipsum available, but the majority ahave suffered ami tar cholnay vulbo na alte ration. majority have suffered alteration in\r\n\r\nThere are many variations of passages of Lorem Ipsum available, majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly kn je believable There are manations of passages of Lorem Ipsum available, but the majority ahave suffered ami tar cholnay vulbo na alte ration. majority have suffered alteration in', '2023060910551434785672 (1).jpg', '2023060910556634267321 (1).jpg');

-- --------------------------------------------------------

--
-- Table structure for table `enroll_class_tbl`
--

CREATE TABLE `enroll_class_tbl` (
  `id` int(10) NOT NULL,
  `student_id` varchar(250) NOT NULL,
  `class_id` varchar(250) NOT NULL,
  `a_price` varchar(250) DEFAULT NULL,
  `discout` varchar(250) DEFAULT NULL,
  `scheduledate` varchar(250) NOT NULL,
  `scheduletime` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enroll_class_tbl`
--

INSERT INTO `enroll_class_tbl` (`id`, `student_id`, `class_id`, `a_price`, `discout`, `scheduledate`, `scheduletime`, `created_at`, `updated_at`) VALUES
(1, '33', '12', '500', '5', '2023-05-23', '17:17:30', '2023-05-23 11:47:30', '2023-05-23 11:47:30'),
(4, '23', '12', '500', '5', '2023-05-23', '17:25:17', '2023-05-23 11:55:17', '2023-05-23 11:55:17'),
(5, '33', '10', '1000', '20', '2023-05-24', '10:16:15', '2023-05-24 04:46:15', '2023-05-24 04:46:15');

-- --------------------------------------------------------

--
-- Table structure for table `forgetpass`
--

CREATE TABLE `forgetpass` (
  `id` int(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `uniqcode` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `forgetpass`
--

INSERT INTO `forgetpass` (`id`, `email`, `uniqcode`, `created_at`, `updated_at`) VALUES
(37, 'kitty@yopmail.com', '8566443', '2022-12-21 11:46:29', '2022-12-21 11:46:29'),
(39, 'lilo@yopmail.com', '8694382', '2022-12-21 11:50:44', '2022-12-21 11:50:44'),
(40, 'lilo@yopmail.com', '7563067', '2022-12-21 11:53:40', '2022-12-21 11:53:40');

-- --------------------------------------------------------

--
-- Table structure for table `forgotpassword`
--

CREATE TABLE `forgotpassword` (
  `id` int(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `otp` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `forgotpassword`
--

INSERT INTO `forgotpassword` (`id`, `email`, `otp`) VALUES
(19, 'harmanpreet.techie@gmail.com', '543932654'),
(20, 'harmanpreet.techie@gmail.com', '2009960972'),
(21, 'harmanpreet.techie@gmail.com', '767061771'),
(22, 'simran@yopmail.com', '1477959814'),
(23, 'harmanpreet.techie@gmail.com', '1752064275'),
(24, 'smartpraveenrai@gmail.com', '1720150205'),
(25, 'harmanpreet.techie@gmail.com', '1007751103'),
(26, 'harman7b@gmail.com', '1685196523');

-- --------------------------------------------------------

--
-- Table structure for table `jobpositioncategory_tbl`
--

CREATE TABLE `jobpositioncategory_tbl` (
  `id` int(10) NOT NULL,
  `name` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobpositioncategory_tbl`
--

INSERT INTO `jobpositioncategory_tbl` (`id`, `name`, `created_at`, `updated_at`) VALUES
(3, 'again', '2023-04-20 22:54:51', '2023-05-16 11:19:38'),
(4, 'G force Category', '2023-04-20 22:55:53', '2023-04-20 22:55:53'),
(5, 'menu', '2023-05-24 06:48:07', '2023-05-24 06:48:07');

-- --------------------------------------------------------

--
-- Table structure for table `jobposition_tbl`
--

CREATE TABLE `jobposition_tbl` (
  `id` int(10) NOT NULL,
  `name` varchar(250) NOT NULL,
  `description` longtext NOT NULL,
  `cat_id` varchar(20) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `page_title` longtext DEFAULT NULL,
  `page_description` longtext DEFAULT NULL,
  `page_schema` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobposition_tbl`
--

INSERT INTO `jobposition_tbl` (`id`, `name`, `description`, `cat_id`, `status`, `updated_at`, `created_at`, `page_title`, `page_description`, `page_schema`) VALUES
(2, 'Zumba Dance', '<div><div><strong style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify; background-color: rgb(255, 255, 255)\">Lorem Ipsum</strong><span>&nbsp;</span><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify; background-color: rgb(255, 255, 255)\"><span>&nbsp;</span>is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</span><br /></div>\r\n<p><br />\r\n</p><br /></div>', '4', '1', '2023-05-24 09:35:46', '2023-04-20 06:51:39', 'Zumba Dancer', 'Zumba Dancer', 'Zumba Dancer'),
(3, 'Hip Hop Dancer', '<div><div><div><div><strong style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify; background-color: rgb(255, 255, 255)\">Lorem Ipsum</strong><span>&nbsp;</span><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify; background-color: rgb(255, 255, 255)\"><span>&nbsp;</span>is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</span><br /></div>\r\n<p><br />\r\n</p><br /></div><br /></div><br /></div>', '5', '1', '2023-05-24 09:36:02', '2023-04-20 06:52:17', 'Hip Hop Dancer', 'Hip Hop Dancer', 'Hip Hop Dancer');

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
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2023_04_11_040610_create_trainer_tbl', 1),
(3, '2023_04_11_041731_create_trainer_tbl', 2);

-- --------------------------------------------------------

--
-- Table structure for table `newsletter_tbl`
--

CREATE TABLE `newsletter_tbl` (
  `id` int(10) NOT NULL,
  `email` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `newsletter_tbl`
--

INSERT INTO `newsletter_tbl` (`id`, `email`, `created_at`, `updated_at`) VALUES
(1, 'demo@gmail.com', '2023-05-25 04:59:10', '2023-05-25 04:59:10'),
(3, 'js@gmail.com', '2023-05-25 09:31:42', '2023-05-25 09:31:42'),
(4, 'simrantest@gmail.com', '2023-05-26 04:14:07', '2023-05-26 04:14:07'),
(5, 'sharan@yopmail.com', '2023-05-29 03:57:52', '2023-05-29 03:57:52');

-- --------------------------------------------------------

--
-- Table structure for table `online_school_tbl`
--

CREATE TABLE `online_school_tbl` (
  `id` int(10) NOT NULL,
  `page_title` varchar(250) NOT NULL,
  `page_description` longtext NOT NULL,
  `page_schema` longtext NOT NULL,
  `title` varchar(250) NOT NULL,
  `description` longtext NOT NULL,
  `image` varchar(250) NOT NULL,
  `banner_image` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `online_school_tbl`
--

INSERT INTO `online_school_tbl` (`id`, `page_title`, `page_description`, `page_schema`, `title`, `description`, `image`, `banner_image`, `created_at`, `updated_at`) VALUES
(1, 'The School', 'The School', 'The School', 'The School', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2023051815021335046956Group 244 1.png', '202305181502348088680Rectangle13411.png', '2023-05-18 09:24:50', '2023-05-26 09:10:56');

-- --------------------------------------------------------

--
-- Table structure for table `open_class_tbl`
--

CREATE TABLE `open_class_tbl` (
  `id` int(10) NOT NULL,
  `classname` varchar(255) NOT NULL,
  `branchname` varchar(255) NOT NULL,
  `trainer_id` varchar(250) NOT NULL,
  `scheduledate` varchar(250) NOT NULL,
  `scheduletime` varchar(255) NOT NULL,
  `facetofaceslot` varchar(255) DEFAULT NULL,
  `zoomlink` varchar(250) DEFAULT NULL,
  `regularrate` varchar(255) NOT NULL,
  `advancepayment` varchar(255) NOT NULL,
  `packagethumbmail` varchar(255) NOT NULL,
  `checkoutthumbmail` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `status` enum('1','0') NOT NULL,
  `page_title` longtext DEFAULT NULL,
  `page_description` longtext DEFAULT NULL,
  `page_schema` longtext DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `open_class_tbl`
--

INSERT INTO `open_class_tbl` (`id`, `classname`, `branchname`, `trainer_id`, `scheduledate`, `scheduletime`, `facetofaceslot`, `zoomlink`, `regularrate`, `advancepayment`, `packagethumbmail`, `checkoutthumbmail`, `description`, `status`, `page_title`, `page_description`, `page_schema`, `created_at`, `updated_at`) VALUES
(4, 'K-Pop', '2', '10', '5/20/2023', '21:03', '92', '31', '1000', '500', '2023050412332060946227demo2.png', '202305121318528096397benjamin-voros-phIFdC6lA4E-unsplash.jpg', '<div><div><div><div><div><div><div><div><div><div><div><p>K-Pop with Myka</p><br /></div><br /></div><br /></div><br /></div><br /></div><br /></div><br /></div><br /></div><br /></div><br /></div><br /></div>', '1', 'K-Pop with Myka', 'K-Pop with Myka', 'K-Pop with Myka', '2023-04-11 05:56:02', '2023-05-26 08:12:49'),
(5, 'Street Pop with Gelai', '1', '9', '5/10/2023', '11:44', '18', '17', '500', '300', '2023050412331911293325demo3.png', '2023042010301645246296student.png', '<div><div><div><div><div><div><div><div><p>Street Pop with Gelai</p><br /></div><br /></div><br /></div><br /></div><br /></div><br /></div><br /></div><br /></div>', '1', 'Street Pop with Gelai', 'Street Pop with Gelai', 'Street Pop with Gelai', '2023-04-20 05:00:05', '2023-05-26 08:12:49'),
(6, 'Hip Hop', '3', '11', '5/9/2023', '19:02', '2', NULL, '200', '60', '202305041233525043085demo2.png', '2023042711531618454266sea-water-ocean-wave-surfing-surface-colorful-vibrant-sunset-barrel-shape-124362369.jpg', '<div><div><div><div><div><div><div><div><div><p>Testing</p><br /></div><br /></div><br /></div><br /></div><br /></div><br /></div><br /></div><br /></div><br /></div>', '1', 'Hip hop classics', 'aa', 'ss', '2023-04-27 06:23:16', '2023-05-26 08:12:48'),
(7, 'Pop Dance', '8', '12', '5/19/2023', '17:15', NULL, NULL, '500', '500', '2023051512148528361202304191156142224124Untitled design (10) 1.png', '2023051512141493424177checkout.jpg', '<p>Test</p>', '1', 'ghuyti;[', 'cjhgdkju', 'vbcjhdgs', '2023-05-15 06:44:16', '2023-05-26 08:12:47');

-- --------------------------------------------------------

--
-- Table structure for table `organization_calender`
--

CREATE TABLE `organization_calender` (
  `id` int(10) NOT NULL,
  `access` longtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `organization_calender`
--

INSERT INTO `organization_calender` (`id`, `access`, `created_at`, `updated_at`) VALUES
(1, '{\"d1\":true,\"d2\":true,\"d3\":true,\"d4\":true,\"d5\":true,\"d6\":false,\"d7\":false}', '2023-01-20 10:57:09', '2023-05-15 04:46:22');

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE `package` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `price` varchar(250) NOT NULL,
  `credit` varchar(250) NOT NULL,
  `expire` varchar(250) NOT NULL,
  `branch` varchar(250) NOT NULL,
  `class_id` varchar(250) NOT NULL,
  `image` varchar(250) NOT NULL,
  `description` longtext NOT NULL,
  `package_limit` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`id`, `name`, `price`, `credit`, `expire`, `branch`, `class_id`, `image`, `description`, `package_limit`) VALUES
(4, '5 Classes', '1350.00', '5', '14', '3', '12', '20230421070516788540222023033110571193698788delicious-popcorn_144627-12668.jpg', 'Valid for 14 days', '50'),
(5, 'Premier Package 2', '28,000.00', '10', '15', '2', '10', '202305040511167396947card12.png', 'no', '50'),
(6, '3 Classes', '1275.00', '3', '7', '8', '16', '2023042107036347171722023040508001919478818hot-green-tea-glass-teapot-cup.jpg', 'Valid for 7 days', '50'),
(10, 'Charles Bender', '976', 'Praesentium aut adip', 'Mollitia est id sol', '8', '6', '20230605152714297806351.jpg', 'Sint explicabo Vita', 'Adipisicing doloribu');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `student_id` int(250) NOT NULL,
  `booking_id` int(250) NOT NULL,
  `payment_id` varchar(250) NOT NULL,
  `payment_intent_id` varchar(250) NOT NULL,
  `type` varchar(250) NOT NULL,
  `price` varchar(250) NOT NULL,
  `updated_at` varchar(250) DEFAULT NULL,
  `created_at` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `student_id`, `booking_id`, `payment_id`, `payment_intent_id`, `type`, `price`, `updated_at`, `created_at`) VALUES
(1, 23, 17, 'pm_1NBsMLSIJfK1r3R9HM4SC93p', 'pi_3NBsMLSIJfK1r3R91VNfNU5a', 'workshop', '1000', '2023-05-26 10:04:39', '2023-05-26 10:04:39');

-- --------------------------------------------------------

--
-- Table structure for table `payment_tbl_new`
--

CREATE TABLE `payment_tbl_new` (
  `id` int(10) NOT NULL,
  `userId` varchar(250) NOT NULL,
  `payment_id` varchar(250) NOT NULL,
  `payment_intent_id` varchar(250) NOT NULL,
  `price` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_tbl_new`
--

INSERT INTO `payment_tbl_new` (`id`, `userId`, `payment_id`, `payment_intent_id`, `price`, `created_at`, `updated_at`) VALUES
(1, '1', 'pm_1NImWmSBqQ3Slb1ttPvAUBEm', 'pi_3NImWlSBqQ3Slb1t0g8FqleQ', '1850', '2023-06-14 05:45:58', '2023-06-14 05:45:58'),
(2, '1', 'pm_1NImwjSBqQ3Slb1tG5hJwZNt', 'pi_3NImwiSBqQ3Slb1t1lcj8Rvs', '1850', '2023-06-14 06:12:47', '2023-06-14 06:12:47'),
(3, '1', 'pm_1NIna9SBqQ3Slb1tYgbqWCt5', 'pi_3NIna8SBqQ3Slb1t1XLKbMEH', '1850', '2023-06-14 06:53:32', '2023-06-14 06:53:32'),
(4, '1', 'pm_1NInbiSBqQ3Slb1tyyFTZfFT', 'pi_3NInbiSBqQ3Slb1t1gN8IUxZ', '2300', '2023-06-14 06:55:08', '2023-06-14 06:55:08'),
(5, '2', 'pm_1NInczSBqQ3Slb1tgNcZ6eKg', 'pi_3NIncxSBqQ3Slb1t0WveS3ve', '450', '2023-06-14 06:56:27', '2023-06-14 06:56:27');

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `privacy`
--

CREATE TABLE `privacy` (
  `id` int(10) NOT NULL,
  `privacy` longtext NOT NULL,
  `term_condetion` longtext NOT NULL,
  `who_we_are` longtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `privacy`
--

INSERT INTO `privacy` (`id`, `privacy`, `term_condetion`, `who_we_are`, `created_at`, `updated_at`) VALUES
(1, '<div><div><div><div><div class=\"col-12 ft-line\" style=\" margin-top: var(--bs-gutter-y); padding-right: calc(var(--bs-gutter-x) * .5); padding-left: calc(var(--bs-gutter-x) * .5); flex: 0 0 auto; width: 1140px; max-width: 100%; color: rgb(33, 37, 41); font-family: Roboto, sans-serif; font-size: 14px; letter-spacing: 0.25px; background-color: rgb(255, 255, 255)\"><h1 style=\" margin: 0px 0px 30px; font-weight: 700; line-height: 29px; color: var(--bs-heading-color,inherit); font-size: 24px; font-family: Montserrat; text-align: center\"><br /></h1></div>\r\n<div class=\"col-12 sd-line\" style=\" margin-top: var(--bs-gutter-y); padding-right: calc(var(--bs-gutter-x) * .5); padding-left: calc(var(--bs-gutter-x) * .5); flex: 0 0 auto; width: 1140px; max-width: 100%; color: rgb(33, 37, 41); font-family: Roboto, sans-serif; font-size: 14px; letter-spacing: 0.25px; background-color: rgb(255, 255, 255)\"><h3 style=\" margin: 0px 0px 16px; padding: 10px 0px; font-weight: 500; line-height: 25px; color: var(--bs-heading-color,inherit); font-size: 16px; font-family: Montserrat; letter-spacing: 0.009375em; background-color: rgb(230, 232, 236)\">Defined Terms:</h3><p style=\" margin: 0px 0px 12px; font-size: 14px; font-family: Montserrat; line-height: 20px\">Company provides a number of internet-based services through its platform and shall include:</p><div class=\"terms-list1\"><ul style=\" margin: 0px 0px 1rem; padding: 0px 0px 0px 2rem\"><li style=\" font-size: 14px; font-family: Montserrat; line-height: 26px\">Posting User profile or listing for the purpose of sale/rental of property, and related property services etc.</li><li style=\" font-size: 14px; font-family: Montserrat; line-height: 26px\">Find a property through ace capital and its internet links.</li><li style=\" font-size: 14px; font-family: Montserrat; line-height: 26px\">Posting User profile or listing for the purpose of sale/rental of property, and related property services etc.</li><li style=\" font-size: 14px; font-family: Montserrat; line-height: 26px\">Post advertisements on ace capital.</li><li style=\" font-size: 14px; font-family: Montserrat; line-height: 26px\">Send advertisements <span style=\"color: rgb(255, 0, 0);\">and promotional messages through emails and messages.</span></li></ul></div></div>\r\n<div class=\"col-12 th-line\" style=\" margin-top: var(--bs-gutter-y); padding-right: calc(var(--bs-gutter-x) * .5); padding-left: calc(var(--bs-gutter-x) * .5); flex: 0 0 auto; width: 1140px; max-width: 100%; color: rgb(33, 37, 41); font-family: Roboto, sans-serif; font-size: 14px; letter-spacing: 0.25px; background-color: rgb(255, 255, 255)\"><h3 style=\" margin: 30px 0px 16px; padding: 10px 0px; font-weight: 500; line-height: 25px; color: var(--bs-heading-color,inherit); font-size: 16px; font-family: Montserrat; letter-spacing: 0.009375em; background-color: rgb(230, 232, 236)\">Defined Terms:</h3><p style=\" margin: 0px 0px 12px; font-size: 14px; font-family: Montserrat; line-height: 20px\">Company provides a number of internet-based services through its platform and shall include:</p><div class=\"terms-list2\"><ul style=\" margin: 0px 0px 1rem; padding: 0px 0px 0px 2rem\"><li style=\" font-size: 14px; font-family: Montserrat; line-height: 26px\">Posting User profile or listing for the purpose of sale/rental of property, and related property services etc.</li><li style=\" font-size: 14px; font-family: Montserrat; line-height: 26px\">Find a property through ace capital and its internet links.</li><li style=\" font-size: 14px; font-family: Montserrat; line-height: 26px\">Posting User profile or listing for the purpose of sale/rental of property, and related property services etc.</li><li style=\" font-size: 14px; font-family: Montserrat; line-height: 26px\">Post advertisements on ace capital.</li><li style=\" font-size: 14px; font-family: Montserrat; line-height: 26px\">Send advertisements and promotional messages through emails and messages.</li></ul></div></div></div></div><br /></div><br /></div>', '<div><div><div><div><div><div><div><div><div><div><div><div><div><div><div><div><div class=\"row\" style=\" font-family: Optima, sans-serif; --bs-gutter-x:1.5rem; --bs-gutter-y:0; display: flex; flex-wrap: wrap; margin-top: calc(var(--bs-gutter-y) * -1); margin-right: calc(var(--bs-gutter-x) * -0.5); margin-left: calc(var(--bs-gutter-x) * -0.5); color: rgb(33, 37, 41); font-size: 16px; background-color: rgb(255, 255, 255)\"><div class=\"col-md-12 col-lg-12 tc-head\" style=\" font-family: Optima, sans-serif; flex: 0 0 auto; width: 1140px; max-width: 100%; padding-right: calc(var(--bs-gutter-x) * 0.5); padding-left: calc(var(--bs-gutter-x) * 0.5); margin-top: var(--bs-gutter-y)\"></div></div></div></div></div></div></div></div></div></div></div></div></div>\r\n\r\n\r\n\r\n</div></div>\r\n\r\n\r\n\r\n<div><div><div class=\"col-12 sd-line\" style=\"margin-top: var(--bs-gutter-y); padding-right: calc(var(--bs-gutter-x) * .5); padding-left: calc(var(--bs-gutter-x) * .5); flex: 0 0 auto; width: 1140px; max-width: 100%; color: rgb(33, 37, 41); font-family: Roboto, sans-serif; font-size: 14px; letter-spacing: 0.25px; background-color: rgb(255, 255, 255)\"><h3 style=\"margin: 0px 0px 16px; padding: 10px 0px; font-weight: 500; line-height: 25px; color: var(--bs-heading-color,inherit); font-size: 16px; font-family: Montserrat; letter-spacing: 0.009375em; background-color: rgb(230, 232, 236)\"><br class=\"Apple-interchange-newline\" />Defined Terms:</h3><p style=\"margin: 0px 0px 12px; font-size: 14px; font-family: Montserrat; line-height: 20px\">Company provides a number of internet-based services through its platform and shall include:</p><div class=\"terms-list1\"><ul style=\"margin: 0px 0px 1rem; padding: 0px 0px 0px 2rem\"><li style=\"font-size: 14px; font-family: Montserrat; line-height: 26px\">Posting User profile or listing for the purpose of sale/rental of property, and related property services etc.</li><li style=\"font-size: 14px; font-family: Montserrat; line-height: 26px\">Find a property through ace capital and its internet links.</li><li style=\"font-size: 14px; font-family: Montserrat; line-height: 26px\">Posting User profile or listing for the purpose of sale/rental of property, and related property services etc.</li><li style=\"font-size: 14px; font-family: Montserrat; line-height: 26px\">Post advertisements on ace capital.</li><li style=\"font-size: 14px; font-family: Montserrat; line-height: 26px\">Send advertisements and promotional messages through emails and messages.</li></ul></div></div><div class=\"col-12 th-line\" style=\"margin-top: var(--bs-gutter-y); padding-right: calc(var(--bs-gutter-x) * .5); padding-left: calc(var(--bs-gutter-x) * .5); flex: 0 0 auto; width: 1140px; max-width: 100%; color: rgb(33, 37, 41); font-family: Roboto, sans-serif; font-size: 14px; letter-spacing: 0.25px; background-color: rgb(255, 255, 255)\"><h3 style=\"margin: 30px 0px 16px; padding: 10px 0px; font-weight: 500; line-height: 25px; color: var(--bs-heading-color,inherit); font-size: 16px; font-family: Montserrat; letter-spacing: 0.009375em; background-color: rgb(230, 232, 236)\">Defined Terms:</h3><p style=\"margin: 0px 0px 12px; font-size: 14px; font-family: Montserrat; line-height: 20px\">Company provides a number of internet-based services through its platform and shall include:</p><div class=\"terms-list2\"><ul style=\"margin: 0px 0px 1rem; padding: 0px 0px 0px 2rem\"><li style=\"font-size: 14px; font-family: Montserrat; line-height: 26px\">Posting User profile or listing for the purpose of sale/rental of property, and related property services etc.</li><li style=\"font-size: 14px; font-family: Montserrat; line-height: 26px\">Find a property through ace capital and its internet links.</li><li style=\"font-size: 14px; font-family: Montserrat; line-height: 26px\">Posting User profile or listing for the purpose of sale/rental of property, and related property services etc.</li><li style=\"font-size: 14px; font-family: Montserrat; line-height: 26px\">Post advertisements on ace capital.</li><li style=\"font-size: 14px; font-family: Montserrat; line-height: 26px\">Send advertisements and promotional messages through emails and messages.</li></ul></div></div></div></div></div></div><br /></div>', '<div><div><div><div><div><div><div><div><div><div><div><div><div><div><p></p><div><div><div><div><div><div>\r\n<div style=\"text-align: center;\"><br /></div>\r\n<div>\r\n<div>\r\n<div>\r\n<div>\r\n<p><span style=\"background-color: rgb(255, 255, 255); color: rgb(33, 37, 41); font-family: Optima, sans-serif; font-size: 16px;\">Ace Capital is dedicated to finding the most suitable property based on the client\'s needs and expectations. Our real estate experts have years of experience and are committed to providing the finest service to our esteemed clients. We are here to guide you through the whole process and ensure that you make the best decisions possible at every stage of the process.</span></p>\r\n<div>\r\n<div style=\" font-family: Optima, sans-serif; color: rgb(33, 37, 41); font-size: 16px; background-color: rgb(255, 255, 255)\">\r\n<div style=\" font-family: Optima, sans-serif\">\r\n<div style=\" font-family: Optima, sans-serif\">\r\n<div style=\" font-family: Optima, sans-serif\">\r\n<div style=\" font-family: Optima, sans-serif\">\r\n<div style=\" font-family: Optima, sans-serif\">\r\n<div style=\" font-family: Optima, sans-serif\">\r\n<div style=\" font-family: Optima, sans-serif\">\r\n<div style=\" font-family: Optima, sans-serif\">\r\n<div style=\" font-family: Optima, sans-serif\">\r\n<div class=\"row\" style=\" font-family: Optima, sans-serif; --bs-gutter-x:1.5rem; --bs-gutter-y:0; display: flex; flex-wrap: wrap; margin-top: calc(var(--bs-gutter-y) * -1); margin-right: calc(var(--bs-gutter-x) * -0.5); margin-left: calc(var(--bs-gutter-x) * -0.5)\">\r\n<div class=\"col-md-12 col-lg-12\" style=\" font-family: Optima, sans-serif; flex: 0 0 auto; width: 1140px; max-width: 100%; padding-right: calc(var(--bs-gutter-x) * 0.5); padding-left: calc(var(--bs-gutter-x) * 0.5); margin-top: var(--bs-gutter-y)\">\r\n<h3 class=\"pp-heading\" style=\" font-family: &quot;Nunito Sans&quot;, sans-serif; font-weight: 600; line-height: 1.2; font-size: 17px; color: rgb(3, 129, 108); padding: 8px 0px\"></h3><h2></h2><h2><span style=\"font-size: 24px; color: rgb(0, 128, 0);\">Who we do?</span></h2>\r\n<div class=\"pp-content\" style=\" font-family: &quot;Nunito Sans&quot;, sans-serif; font-size: 16px; padding: 10px 0px\">\r\n<p style=\" font-family: Optima, sans-serif; margin-bottom: 1rem\">A top-rated real estate brokerage firm that specializes in helping affluent individuals find the perfect homes and maximize their ROI. With a strong hold on the secondary market and off plans, Ace Capital\'s ultimate goal is to help buyers and sellers find mutually beneficial investments, regardless of the technical details involved. Ace Capital has a reputation for providing superior service to its clients, and its team of experienced professionals is dedicated to helping you find the perfect home. Whether they are residential or commercial properties, Ace Capital is always looking to provide the best options for its clients. Our goal is to provide our customers with the most recent information about the real estate market so that they can make informed decisions about their investments.</p>\r\n</div>\r\n<h4 class=\"pp-heading\" style=\" font-family: &quot;Nunito Sans&quot;, sans-serif; font-weight: 600; line-height: 1.2; font-size: 17px; color: rgb(3, 129, 108); padding: 8px 0px\"></h4><h2><span style=\"text-decoration-line: underline; font-size: 24px; color: rgb(0, 128, 0);\">Services</span></h2>\r\n<div class=\"pp-content\" style=\" font-family: &quot;Nunito Sans&quot;, sans-serif; font-size: 16px; padding: 10px 0px\">\r\n<p style=\" font-family: Optima, sans-serif; margin-bottom: 1rem\">Ace Capital has a stronghold on the real estate market in Dubai, thanks to its vibrant and dynamic team of professional brokers. Due to the ethics and hard work of our team of experienced brokers, we have been able to grab potential clientele willing to invest in luxurious properties in Dubai\r\n\r\n<span style=\"color: rgb(33, 37, 41); font-family: Optima, sans-serif; font-size: 16px; background-color: rgb(255, 255, 255)\">Ace Capital has a stronghold on the real estate market in Dubai, thanks to its vibrant and dynamic team of professional brokers. Due to the ethics and hard work of our team of experienced brokers, we have been able to grab potential clientele willing to invest in luxurious properties in Dubai</span>\r\n.</p></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div>\r\n\r\n<h4 class=\"pp-heading\" style=\" background-color: rgb(255, 255, 255); font-family: &quot;Nunito Sans&quot;, sans-serif; font-weight: 600; line-height: 1.2; font-size: 17px; color: rgb(3, 129, 108); padding: 8px 0px\"></h4><h3></h3><h3></h3><h4><span style=\"text-decoration-line: underline; font-size: 18px; color: rgb(0, 128, 0);\">Off-plan:</span></h4><div class=\"pp-content\" style=\"color: rgb(33, 37, 41); font-size: 16px; background-color: rgb(255, 255, 255); font-family: &quot;Nunito Sans&quot;, sans-serif; padding: 10px 0px\"><p style=\"font-family: Optima, sans-serif; margin-bottom: 1rem\">We have a selection of off-plan properties that are ideal for investment purposes. These properties can either be used to settle-in in a few years or used to enjoy as an investment keeping in mind the increase in value over time.</p></div>\r\n\r\n\r\n<h4 class=\"pp-heading\" style=\" background-color: rgb(255, 255, 255); font-family: &quot;Nunito Sans&quot;, sans-serif; font-weight: 600; line-height: 1.2; font-size: 17px; color: rgb(3, 129, 108); padding: 8px 0px\"></h4><h3><span style=\"text-decoration-line: underline; color: rgb(0, 128, 0);\">Secondary Market:</span></h3><div class=\"pp-content\" style=\"color: rgb(33, 37, 41); font-size: 16px; background-color: rgb(255, 255, 255); font-family: &quot;Nunito Sans&quot;, sans-serif; padding: 10px 0px\"><p style=\"font-family: Optima, sans-serif; margin-bottom: 1rem\">We can help you find a luxurious property that is ready to move into. We have a wide range of magnificently built properties that are ready to be sold.</p></div>\r\n\r\n\r\n<h4 class=\"pp-heading\" style=\" background-color: rgb(255, 255, 255); font-family: &quot;Nunito Sans&quot;, sans-serif; font-weight: 600; line-height: 1.2; font-size: 17px; color: rgb(3, 129, 108); padding: 8px 0px\"></h4><h3><span style=\"text-decoration-line: underline; color: rgb(0, 128, 0);\">Renting/Leasing:</span></h3><div class=\"pp-content\" style=\"font-size: 16px; color: rgb(33, 37, 41); background-color: rgb(255, 255, 255); font-family: &quot;Nunito Sans&quot;, sans-serif; padding: 10px 0px\"><p style=\"font-family: Optima, sans-serif; margin-bottom: 1rem\">We are here to help individuals make the most of their investments. We have several options fitting different budgets. We offer quality properties and can help individuals find the right type of property depending on their needs, whether suitable for short-term or permanent residential use. We can also help renters find properties to lease. We can provide a list of potential tenants and facilitate the rental process.\r\n</p></div>\r\n<br /></div>\r\n\r\n<h4 class=\"pp-heading\" style=\" background-color: rgb(255, 255, 255); font-family: &quot;Nunito Sans&quot;, sans-serif; font-weight: 600; line-height: 1.2; font-size: 17px; color: rgb(3, 129, 108); padding: 8px 0px\"></h4><h3><span style=\"text-decoration-line: underline; color: rgb(0, 128, 0);\">Property Management:</span></h3><div class=\"pp-content\" style=\"font-size: 16px; color: rgb(33, 37, 41); background-color: rgb(255, 255, 255); font-family: &quot;Nunito Sans&quot;, sans-serif; padding: 10px 0px\"><p style=\"font-family: Optima, sans-serif; margin-bottom: 1rem\">Our mission is to supervise and manage real estate properties. This includes looking after all day-to-day operations for a property including rental income, tenant complaints, and more. The number of responsibilities we will have will depend on the terms of our contract with the landlord.</p></div>\r\n<br /></div>\r\n<p>\r\n\r\n</p><h4 class=\"pp-heading\" style=\" background-color: rgb(255, 255, 255); font-family: &quot;Nunito Sans&quot;, sans-serif; font-weight: 600; line-height: 1.2; font-size: 17px; color: rgb(3, 129, 108); padding: 8px 0px\"></h4><h3><span style=\"text-decoration-line: underline; color: rgb(0, 128, 0);\">Real Estate Advertisement/Marketing:</span></h3><div class=\"pp-content\" style=\"font-size: 16px; color: rgb(33, 37, 41); background-color: rgb(255, 255, 255); font-family: &quot;Nunito Sans&quot;, sans-serif; padding: 10px 0px\"><p style=\"font-family: Optima, sans-serif; margin-bottom: 1rem\">We can help you promote listings as well as generate buyer leads for your property. It is a great way to reach a wider audience more effectively and easily than ever before.</p></div></div></div></div></div></div></div></div></div></div>\r\n<link rel=\"File-List\r\n\" href=\"file:///C:/Users/ADMINI~1/AppData/Local/Temp/msohtmlclip1/01/clip_filelist.xml\" />\r\n<link rel=\"themeData\r\n\" href=\"file:///C:/Users/ADMINI~1/AppData/Local/Temp/msohtmlclip1/01/clip_themedata.thmx\" />\r\n<link rel=\"colorSchemeMapping\r\n\" href=\"file:///C:/Users/ADMINI~1/AppData/Local/Temp/msohtmlclip1/01/clip_colorschememapping.xml\" /><br /></div><br /></div><br /></div><br /></div><br /></div><br /></div><br /></div>', '2023-02-03 08:42:29', '2023-05-26 09:10:32');

-- --------------------------------------------------------

--
-- Table structure for table `product_tbl`
--

CREATE TABLE `product_tbl` (
  `id` int(10) NOT NULL,
  `userId` varchar(250) DEFAULT NULL,
  `name` varchar(250) NOT NULL,
  `description` longtext NOT NULL,
  `price` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('1','0') NOT NULL,
  `image` varchar(250) NOT NULL,
  `wishlist` enum('no','yes') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_tbl`
--

INSERT INTO `product_tbl` (`id`, `userId`, `name`, `description`, `price`, `created_at`, `updated_at`, `status`, `image`, `wishlist`) VALUES
(1, '1', 'Holiday Candle', 'There are many variations of passages of Lorem Ipsum avaable,majority have suffered alteration in some form, by injected humour, or rdomised words which don\'t look even slightly believable.', '500', '2023-06-05 10:02:21', '2023-06-12 07:07:17', '1', '20230605153211459481191.jpg', 'yes'),
(2, '1', 'Christmas Tree', 'There are many variations of passages of Lorem Ipsum avaable,majority have suffered alteration in some form, by injected humour, or rdomised words which don\'t look even slightly believable.', '450', '2023-06-05 10:09:23', '2023-06-12 07:06:56', '1', '2023060515395376138922.jpg', 'yes'),
(3, '2', 'Santa Claus Doll', 'There are many variations of passages of Lorem Ipsum avaable,majority have suffered alteration in some form, by injected humour, or rdomised words which don\'t look even slightly believable.', '450', '2023-06-05 10:10:11', '2023-06-12 06:51:42', '1', '20230605154019356286773.jpg', 'yes'),
(4, '2', 'Holiday Cap', 'There are many variations of passages of Lorem Ipsum avaable,majority have suffered alteration in some form, by injected humour, or rdomised words which don\'t look even slightly believable.', '150', '2023-06-05 10:11:14', '2023-06-12 06:51:36', '1', '2023060515418881219974.jpg', 'yes'),
(5, NULL, 'Holiday Doll', 'There are many variations of passages of Lorem Ipsum avaable,majority have suffered alteration in some form, by injected humour, or rdomised words which don\'t look even slightly believable.', '350', '2023-06-05 10:12:00', '2023-06-12 07:05:38', '1', '20230605154213302677685.jpg', 'no'),
(6, NULL, 'Holiday Candle', 'There are many variations of passages of Lorem Ipsum avaable,majority have suffered alteration in some form, by injected humour, or rdomised words which don\'t look even slightly believable.', '250', '2023-06-05 10:12:43', '2023-06-13 07:20:11', '1', '20230605154214287659826.jpg', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `project_class_tbl`
--

CREATE TABLE `project_class_tbl` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `branchname` varchar(250) NOT NULL,
  `bacthname` varchar(255) NOT NULL,
  `trainer_id` varchar(250) NOT NULL,
  `starttime` varchar(255) NOT NULL,
  `endtime` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `location` varchar(250) DEFAULT NULL,
  `regularrate` longtext NOT NULL,
  `advancepayment` varchar(255) NOT NULL,
  `gtreat` varchar(250) NOT NULL,
  `slots` varchar(250) NOT NULL,
  `classimg` varchar(255) DEFAULT NULL,
  `status` enum('1','0') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `page_title` longtext DEFAULT NULL,
  `page_description` longtext DEFAULT NULL,
  `page_schema` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project_class_tbl`
--

INSERT INTO `project_class_tbl` (`id`, `name`, `branchname`, `bacthname`, `trainer_id`, `starttime`, `endtime`, `description`, `location`, `regularrate`, `advancepayment`, `gtreat`, `slots`, `classimg`, `status`, `created_at`, `updated_at`, `page_title`, `page_description`, `page_schema`) VALUES
(6, 'Hip-Hop with B(12)', '2', '1', '10', '11:57', '09:51', '<div><div><div><div><div><div><div><div><p>Hello New</p><br /></div><br /></div><br /></div><br /></div><br /></div><br /></div><br /></div><br /></div>', '', '1000', '500', '5', '20', '20230418100293644841Group 16056 copy.png', '1', '2023-05-26 08:12:09', '2023-05-26 08:12:09', 'Hip-Hop with B(12+)', 'Hip-Hop with B(12+)', 'Hip-Hop with B(12+)'),
(10, 'Hip-Hop with B(12+)', '3', '2', '11', '00:31', '17:27', '<div><div><div><div><div><div><div><div><div><div><div><div><div><div><div><div><div><div><div><div><div><div><div><div><p>Hello this is just for testing purposes.</p><br /></div><br /></div><br /></div><br /></div><br /></div><br /></div><br /></div><br /></div><br /></div><br /></div><br /></div><br /></div><br /></div><br /></div><br /></div><br /></div><br /></div><br /></div><br /></div><br /></div><br /></div><br /></div><br /></div><br /></div>', '', '1000', '500', '5', '50', '2023041810022091473358Group 16057.png', '1', '2023-05-26 08:12:09', '2023-05-26 08:12:09', 'Hip-Hop with B(12+)', 'Hip-Hop with B(12+)', 'Hip-Hop with B(12+)'),
(12, 'Hip-Hop with Myka', '2', '3', '10', '15:28', '06:54', '<div><div><div><div><div><div><div><p>Hello New</p><br /></div><br /></div><br /></div><br /></div><br /></div><br /></div><br /></div>', NULL, '500', '300', '4', '50', '2023041809571391785296Group 16055 copy.png', '1', '2023-05-26 08:19:00', '2023-05-26 08:19:00', 'Hip-Hop with B(12+)', 'Hip-Hop with B(12+)', 'Hip-Hop with B(12+)'),
(16, 'Hip hop with menus', '8', '2', '12', '14:30', '16:30', '<p>Test&nbsp;&nbsp;&nbsp;&nbsp;</p>', NULL, '500', '200', '4', '50', '2023051512114800396252023041809571391785296Group 16055 copy.png', '1', '2023-05-26 08:12:07', '2023-05-26 08:12:07', 'vytrfjhou', 'cygfkjoupf', 'hoyofgpi8');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `access` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`, `access`, `created_at`, `updated_at`) VALUES
(9, 'Admin', '{\"p1\":true,\"p2\":true,\"p3\":true,\"p4\":true,\"b1\":true,\"b2\":true,\"b3\":true,\"b4\":true}', '2022-11-14 04:41:40', '2022-11-13 23:11:40'),
(10, 'Agent', '{\"p1\":true,\"p2\":true,\"p3\":true,\"p4\":true,\"b1\":false,\"b2\":false,\"b3\":false,\"b4\":false}', '2023-02-07 11:18:22', '2023-02-07 18:18:22'),
(11, 'Blogger', '{\"p1\":false,\"p2\":false,\"p3\":false,\"p4\":false,\"b1\":true,\"b2\":true,\"b3\":true,\"b4\":true}', '2022-12-20 05:21:43', '2022-12-20 10:21:43'),
(17, 'Hello', '{\"p1\":false,\"p2\":false,\"p3\":true,\"p4\":true,\"b1\":true,\"b2\":true,\"b3\":false,\"b4\":false}', '2022-12-22 08:20:46', '2022-12-22 08:20:46'),
(22, 'new', '{\"p1\":true,\"p2\":true,\"p3\":true,\"p4\":true,\"b1\":true,\"b2\":true,\"b3\":true,\"b4\":true}', '2022-12-22 06:46:55', '2022-12-22 06:46:55'),
(23, 'Blog/Agent', '{\"p1\":true,\"p2\":false,\"p3\":true,\"p4\":true,\"b1\":true,\"b2\":false,\"b3\":false,\"b4\":true}', '2023-01-02 07:09:08', '2023-01-02 12:09:08'),
(24, 'blogger', '{\"p1\":false,\"p2\":false,\"p3\":false,\"p4\":false,\"b1\":true,\"b2\":true,\"b3\":true,\"b4\":true}', '2023-02-15 04:54:50', '2023-02-15 11:54:50');

-- --------------------------------------------------------

--
-- Table structure for table `school_category_tbl`
--

CREATE TABLE `school_category_tbl` (
  `id` int(10) NOT NULL,
  `name` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `school_category_tbl`
--

INSERT INTO `school_category_tbl` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'Online School', '2023-05-08 06:22:56', '2023-05-08 06:22:56');

-- --------------------------------------------------------

--
-- Table structure for table `school_tbl`
--

CREATE TABLE `school_tbl` (
  `id` int(10) NOT NULL,
  `page_title` longtext NOT NULL,
  `page_description` longtext NOT NULL,
  `page_schema` longtext NOT NULL,
  `title` varchar(250) NOT NULL,
  `school_category` varchar(250) NOT NULL,
  `description` longtext NOT NULL,
  `trailer_video` varchar(250) NOT NULL,
  `image` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('1','0') NOT NULL,
  `price` varchar(250) NOT NULL,
  `type` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `school_tbl`
--

INSERT INTO `school_tbl` (`id`, `page_title`, `page_description`, `page_schema`, `title`, `school_category`, `description`, `trailer_video`, `image`, `created_at`, `updated_at`, `status`, `price`, `type`) VALUES
(8, 'fast x trailer', 'fast x trailer', 'fast x trailer', 'fast x trailer', '2', '<p>demo demo demom</p>', 'https://www.youtube.com/watch?v=eoOaKN4qCKw&ab_channel=TheFastSaga', '202305231338824734093Group 16111.png', '2023-05-23 08:08:03', '2023-05-23 08:08:03', '1', '3000', 'video_link'),
(9, 'Spiderman trailer', 'Spiderman trailer', 'Spiderman trailer', 'Spiderman trailer', '2', '<p>demo demo demo</p>', 'https://www.youtube.com/watch?v=F478PvRt74Y&ab_channel=TeaserPRO', '2023052313409604203Group 16110.png', '2023-05-23 08:10:59', '2023-05-23 08:10:59', '1', '3000', 'video_link'),
(10, 'Mission: Impossible', 'Mission: Impossible', 'Mission: Impossible', 'Mission: Impossible', '2', '<div><p>\r\n\r\n</p>\r\n<p>demo demo demo</p><br /></div>', 'https://www.youtube.com/watch?v=bkIWJxFJt_k&ab_channel=ParamountPicturesIndia', '2023052313451067906088Rectangle 2888.png', '2023-05-23 08:15:52', '2023-05-24 12:02:12', '1', '3000', 'video_link'),
(11, 'dummy video', 'dummy video', 'dummy video', 'dummy video', '2', '<p>dummy video&nbsp;dummy video&nbsp;dummy video&nbsp;dummy video<br /></p>', '2023052511291664698140SPIDER-MAN_ MILES MORALES - Teaser Trailer (2024) _ Andrew Garfield _ TeaserPRO\'s Concept Version.mp4', '202305251129237850183harry.png', '2023-05-25 05:59:18', '2023-05-25 05:59:18', '1', '650', 'Upload_video'),
(12, 'test', 'test', 'test', 'test', '2', '<div><p>Hello New</p><br /></div>', '202305251131651480857Untitled.mp4', '202305251131490937335Group889.png', '2023-05-25 06:01:43', '2023-05-25 06:05:19', '1', '885', 'Upload_video');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `siteTitle` varchar(255) DEFAULT NULL,
  `siteLogo` varchar(255) DEFAULT NULL,
  `currency` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `userId`, `siteTitle`, `siteLogo`, `currency`, `created_at`, `updated_at`) VALUES
(3, 1, 'Ace Capital', '2022111506101969619565deadpool-superhero-minimal-4k-ds-1366x768.jpg', 'INR', '2022-11-15 06:15:31', '2022-11-15 00:45:31');

-- --------------------------------------------------------

--
-- Table structure for table `student_tbl`
--

CREATE TABLE `student_tbl` (
  `id` int(10) NOT NULL,
  `parent_id` int(10) DEFAULT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(250) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `email` varchar(250) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `dob` varchar(250) NOT NULL,
  `gender` varchar(250) DEFAULT NULL,
  `password` varchar(250) NOT NULL,
  `image` varchar(250) NOT NULL,
  `address` varchar(250) NOT NULL,
  `token` varchar(250) DEFAULT NULL,
  `type` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_tbl`
--

INSERT INTO `student_tbl` (`id`, `parent_id`, `firstname`, `middlename`, `lastname`, `email`, `phone`, `status`, `dob`, `gender`, `password`, `image`, `address`, `token`, `type`, `created_at`, `updated_at`) VALUES
(23, NULL, 'test', 'test', 'test', 'harman7b@gmail.com', '9876542310', '1', '2023-05-20', 'Male', '123', '2023051712251555992149student.png', 'abc', '626b78676b643d684a6d676b636624696567', '1', '2023-05-17 06:55:24', '2023-05-26 07:15:57'),
(24, NULL, 'test1', 'test2', 'test3', 'test@gmail.com', 'test5', '1', 'test4', 'Male', '1234', '202305171510902190990Rectangle034.png', 'test6', '7e6f797e4a6d676b636624696567', '1', '2023-05-17 09:40:16', '2023-05-17 09:41:38'),
(25, NULL, 'test1', 'test2', 'test3', 'test@gmail.com', 'test5', '1', 'test4', 'Male', '1234', '202305171510333638515Rectangle034.png', 'test6', '7e6f797e4a6d676b636624696567', '1', '2023-05-17 09:40:17', '2023-05-17 09:41:38'),
(26, NULL, 'test1', 'test2', 'test3', 'test@gmail.com', 'test5', '1', 'test4', 'Male', '1234', '202305171510287477050Rectangle034.png', 'test6', '7e6f797e4a6d676b636624696567', '1', '2023-05-17 09:40:18', '2023-05-17 09:41:38'),
(27, NULL, 'test1', 'test2', 'test3', 'test@gmail.com', 'test5', '1', 'test4', 'Male', '1234', '202305171510764573292Rectangle034.png', 'test6', '7e6f797e4a6d676b636624696567', '1', '2023-05-17 09:40:19', '2023-05-17 09:41:38'),
(28, NULL, 'test1', 'test2', 'test3', 'test@gmail.com', 'test5', '1', 'test4', 'Male', '1234', '2023051715101570151862Rectangle034.png', 'test6', '7e6f797e4a6d676b636624696567', '1', '2023-05-17 09:40:20', '2023-05-17 09:41:38'),
(29, NULL, 'abc 2', 'a 2', 'a 2', 'abc@gmail.com', '9876543210', '1', '2023-05-15', 'Male', '123', '20230517172313134971682023042106041762949235Ellipse 21.png', 'xyz', '6b68694a6d676b636624696567', '1', '2023-05-17 11:53:12', '2023-05-17 11:59:41'),
(30, NULL, 'Simran', 'jeet', 'jeet', 'simran@yopmail.com', '9878114521', '1', '2000-05-09', 'Female', '654321', '202305180952384210304202304191156142224124Untitled design (10) 1.png', '52', '796367786b644a73657a676b636624696567', '1', '2023-05-18 04:22:31', '2023-05-23 06:12:42'),
(31, NULL, 'praveen', 'rai', 'rai', 'smartpraveenrai@gmail.com', '5655449103', '1', '1992-10-10', 'Male', 'Praveen@90', '202305181002276308871WhatsApp Image 2023-05-15 at 11.51.18 AM.jpeg', 'Panchkula', '79676b787e7a786b7c6f6f64786b634a6d676b636624696567', '1', '2023-05-18 04:31:57', '2023-05-18 04:32:20'),
(32, NULL, 'Sharan', 'jeet', 'Kaur', 'sharan@yopmail.com', '9781215241', '1', '1988-07-16', 'Male', '123456', '20230518103712775282002023041809571391785296Group 16055 copy.png', '43', NULL, '2', '2023-05-18 05:07:02', '2023-05-18 05:07:02'),
(33, NULL, 'Kunwar', 'Deep', 'Singh', 'kunwar@yopmail.com', '9781748571', '1', '2014-10-14', 'Male', '123456', '2023052313471528090191blank.pdf', '56', '617f647d6b784a73657a676b636624696567', '1', '2023-05-23 08:17:05', '2023-05-23 08:26:35'),
(34, NULL, 'gtest', 'gtest', 'gtest', 'gtest@gmail.com', '987564230', '1', '2023-05-18', 'Male', '123', '2023052515371739872329harry.png', 'abc', NULL, '1', '2023-05-25 10:07:09', '2023-05-25 10:07:09'),
(35, NULL, 'a', 'a', 'a', 'gte11st@gmail.com', '987', '1', '2023-05-24', 'Male', '123', '202305251538856302700Group 67.png', 'as', NULL, '1', '2023-05-25 10:08:53', '2023-05-25 10:08:53'),
(36, NULL, 'simran', 'yyyyy', 'kaur', 'harwinderkaur@gmail.com', '9876765456', '1', '2018-02-16', 'Female', '12345', '2023052609401969734769hand-drawing-cartoon-girl-cute-girl-drawing-for-profile-picture-png.png', 'h-no.6,ftygusha.', '626b787d63646e6f78616b7f784a6d676b636624696567', '1', '2023-05-25 11:37:04', '2023-05-26 04:28:42'),
(37, NULL, 'Praveen Test', 'Test', 'test', 'praveen.techiesinfo@gmail.com', '565549103', '1', '1992-10-10', 'Male', 'wavedemo', '202305251732712051908Blue Modern Business Proposal (8).jpg', 'Panchkula', '7a786b7c6f6f64247e6f6962636f7963646c654a6d676b636624696567', '1', '2023-05-25 12:02:31', '2023-05-25 12:03:01'),
(38, NULL, 'test', 'test', 'test', 'harman7b@gmail.com', '9876542310', '1', '2023-05-20', 'Male', '123', '202305261244672384385download.jfif', 'abc', '626b78676b643d684a6d676b636624696567', '1', '2023-05-26 07:14:33', '2023-05-26 07:15:57'),
(39, NULL, 'demo', 'demo', 'demo', 'harman9a@gmail.com', '9876543210', '1', '2023-05-18', 'demo', '123', '20230526124710404713369RAazpspK9T5NpplaSom.jfif', 'abc', NULL, '1', '2023-05-26 07:17:56', '2023-05-26 07:17:56'),
(40, NULL, 'Shilpa', 'Sharma', 'Sharma', 'shilpa@yopmail.com', '9781175242', '1', '2010-11-25', 'Female', '123456', '2023052909408041638952023041809571391785296Group 16055 copy.png', '625', '796263667a6b4a73657a676b636624696567', '1', '2023-05-29 04:10:20', '2023-05-29 04:11:44');

-- --------------------------------------------------------

--
-- Table structure for table `the_force_tbl`
--

CREATE TABLE `the_force_tbl` (
  `id` int(10) NOT NULL,
  `page_title` varchar(250) NOT NULL,
  `page_description` longtext NOT NULL,
  `page_schema` longtext NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `type` varchar(250) NOT NULL,
  `speciality` varchar(250) DEFAULT NULL,
  `image` varchar(250) DEFAULT NULL,
  `image1` varchar(250) DEFAULT NULL,
  `banner_image` varchar(250) NOT NULL,
  `description` longtext DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `multipleImage` varchar(250) DEFAULT NULL,
  `socialLinks` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `the_force_tbl`
--

INSERT INTO `the_force_tbl` (`id`, `page_title`, `page_description`, `page_schema`, `name`, `type`, `speciality`, `image`, `image1`, `banner_image`, `description`, `created_at`, `updated_at`, `multipleImage`, `socialLinks`) VALUES
(1, 'Passion for Dance', 'Passion for Dance', 'Passion for Dance', 'Maria Kim', 'founder', 'Passion for Dance', '2023051816211497329533image-width.png', '', '202305181621971402927Group 16060.png', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2023-05-18 10:22:28', '2023-05-26 09:11:21', '[\"\",\"five.png\",\"four.png\",\"Rectangle 2843.png\",\"Rectangle 2844.png\",\"Rectangle 2845.png\",\"Rectangle 2846.png\",\"Rectangle 2847.png\",\"Rectangle 2848.png\",\"three.png\",\"two.png\"]', '[{\"id\":1,\"icon\":\"fab fa-facebook\",\"text\":\"https://www.facebook.com/GForceOfficial/\"},{\"id\":2,\"icon\":\"fab fa-tiktok\",\"text\":\"https://www.tiktok.com\"},{\"id\":3,\"icon\":\"fab fa-twitter\",\"text\":\"https://twitter.com/gforce_official\"},{\"id\":4,\"icon\":\"fab fa-instagram\",\"text\":\"https://www.instagram.com/gforce_official/\"}]'),
(2, 'Performing Artist', 'Performing Artist', 'Performing Artist', 'Performing Artist', 'artist', '', '', '', '2023051816461876260354Group 16063.png', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2023-05-18 11:05:41', '2023-05-26 09:11:47', '[\"\",\"five.png\",\"four.png\",\"Rectangle 2843.png\",\"Rectangle 2844.png\",\"Rectangle 2845.png\",\"Rectangle 2846.png\",\"Rectangle 2847.png\",\"Rectangle 2848.png\",\"three.png\",\"two.png\"]', NULL),
(3, 'Runner Page', 'Runner Page', 'Runner Page', NULL, 'runner', NULL, '2023051817291152505110tg-2_3.169dacfddae5beef.png', '2023051817291316565637Rectangle_2857.6331f95b74347613.png', '202305181729702906553Group899.png', '', '2023-05-18 11:37:12', '2023-05-26 09:12:31', NULL, NULL),
(4, 'Choreographers/Teachers', 'Choreographers/Teachers', 'Choreographers/Teachers', 'Choreographers/Teachers', 'choreographers', NULL, NULL, NULL, '2023051916361450883931Group889.png', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2023-05-19 11:05:37', '2023-05-26 09:12:55', '[\"\",\"Rectangle_2857.6331f95b74347613.png\",\"tg-2_3.169dacfddae5beef.png\",\"Group899.png\",\"Group 16063.png\"]', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `trainer_tbl`
--

CREATE TABLE `trainer_tbl` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `speciality` varchar(255) NOT NULL,
  `branch_id` varchar(250) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `page_title` longtext DEFAULT NULL,
  `page_description` longtext DEFAULT NULL,
  `page_schema` longtext DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `ameneties` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trainer_tbl`
--

INSERT INTO `trainer_tbl` (`id`, `name`, `image`, `speciality`, `branch_id`, `status`, `page_title`, `page_description`, `page_schema`, `created_at`, `updated_at`, `ameneties`) VALUES
(1, 'TERRY SOTO', '2023060912058855664731.jpg', 'CEO', '8', '1', 'TERRY SOTO', 'TERRY SOTO', 'TERRY SOTO', '2023-05-15 09:48:59', '2023-06-09 06:35:41', '[{\"id\":1,\"icon\":\"fab fa-linkedin\",\"text\":\"www.linkedin.com\"}]'),
(2, 'MARIA LANE', '2023060912067958702752.jpg', 'MARKETER', '8', '1', 'MARIA LANE', 'MARIA LANE', 'MARIA LANE', '2023-05-15 06:39:55', '2023-06-09 06:39:03', '[{\"id\":1,\"icon\":\"fab fa-instagram\",\"text\":\"www.instagram.com\"}]'),
(3, 'JUSTIN EVANS', '2023060912073764306063.jpg', 'DEVELOPER', '2', '1', 'JUSTIN EVANS', 'JUSTIN EVANS', 'JUSTIN EVANS', '2023-06-09 06:37:38', '2023-06-09 06:37:38', '[{\"id\":1,\"icon\":\"fab fa-google-plus\",\"text\":\"gjg\"}]'),
(4, 'ROSE DIXON', '2023060912085563071044.jpg', 'DESIGNER', '3', '1', 'ROSE DIXON', 'ROSE DIXON', 'ROSE DIXON', '2023-06-09 06:38:31', '2023-06-09 06:38:31', '[{\"id\":1,\"icon\":\"fab fa-pinterest\",\"text\":\"fhfghfg\"}]');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `specialty` varchar(255) DEFAULT NULL,
  `designation` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `status` enum('1','0') DEFAULT NULL,
  `role` int(11) DEFAULT NULL,
  `location` longtext NOT NULL,
  `token` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `password`, `email`, `department`, `phone`, `specialty`, `designation`, `photo`, `status`, `role`, `location`, `token`, `created_at`, `updated_at`) VALUES
(1, 'Gforce', 'Gforce', 'e10adc3949ba59abbe56e057f20f883e', 'admin@admin.com', 'Admin', '9876543210', 'Admin', 'Admin', '20230522134414143507892023041311582076086788gforce.png', '1', 9, 'Dubai - United Arab Emirates', '64e1b8d34f425d19e1ee2ea7236d30281759450778', '2023-06-13 12:24:45', '2023-06-13 12:24:45'),
(12, 'Elias', 'Halawangi', 'e10adc3949ba59abbe56e057f20f883e', 'elias@acecapitalrealty.com', 'SALES', '052-4609117', 'OFF-PLAN SPECIALIST', 'SENIOR PROPERTY CONSULTANT', '202211141219981700953one.jpg', '1', 10, 'Dubai - United Arab Emirates', '', '2023-01-25 06:37:24', '2023-01-25 13:37:24'),
(13, 'Muhammad Loai', 'Marwan Mahroosa', 'e10adc3949ba59abbe56e057f20f883e', 'loai@acecapitalrealty.com', 'SALES', '052-3682779', 'BUSINESS BAY & OFF-PLAN SPECIALIST', 'SENIOR PROPERTY CONSULTANT', '2022111412211965063175one.jpg', '1', 10, 'Dubai - United Arab Emirates', '', '2023-02-02 04:42:53', '2023-02-02 11:42:53'),
(14, 'Wissam Abou', 'Rjeily', 'e10adc3949ba59abbe56e057f20f883e', 'wissam@acecapitalrealty.com', 'SALES', '052-4211485', 'OFF PLAN SPECIALIST', 'SENIOR PROPERTY CONSULTANT', '2022111412221932751917one.jpg', '1', 10, 'Dubai - United Arab Emirates', '', '2023-01-25 06:37:24', '2023-01-25 13:37:24'),
(15, 'Raissa', 'Lima', 'e10adc3949ba59abbe56e057f20f883e', 'raissa@acecapitalrealty.com', 'SALES', '052-3902219', 'DUBAI HILLS ESTATE', 'SENIOR PROPERTY CONSULTANT', '202211141223476706315one.jpg', '1', 10, 'Dubai - United Arab Emirates', '', '2023-01-25 06:37:24', '2023-01-25 13:37:24'),
(16, 'Yersaiyn Kharzanov', 'Kharzanov', 'e10adc3949ba59abbe56e057f20f883e', 'yersaiyn@acecapitalrealty.com', 'SALES', '052-2912985', 'MBR CITY & OFF-PLAN SPECIALIST', 'SENIOR SALES AGENT', '202211141224985571510one.jpg', '1', 10, 'Dubai - United Arab Emirates', '', '2023-01-25 06:37:24', '2023-01-25 13:37:24'),
(17, 'Alaa Khaled', 'Shwayyat', 'e10adc3949ba59abbe56e057f20f883e', 'alaa@acecapitalrealty.com', 'SALES', '052-3466495', 'OFF-PLAN SPECIALIST', 'SENIOR PROPERTY CONSULTANT', '202211141224998924671one.jpg', '1', 10, 'Dubai - United Arab Emirates', '', '2023-01-25 06:37:24', '2023-01-25 13:37:24'),
(27, 'Shilpa', 'Sharma', '5b1b68a9abf4d2cd155c81a9225fd158', 'shilpas@yopmail.com', 'Agent', '9781771170', 'Agent', 'Agent', '202302060529550236594vr.PNG', '1', 10, 'Dubai - United Arab Emirates', '', '2023-02-06 05:29:52', '2023-02-06 12:29:52'),
(28, 'Jitendra', 'Singh', 'e10adc3949ba59abbe56e057f20f883e', 'jitendra.techies@gmail.com', 'Engineering', '9876543210', 'Software Development', 'Software Developer', '2022122103341549503366newimg.jpg', '1', 10, 'Dubai - United Arab Emirates', '', '2023-02-07 11:18:01', '2023-02-07 18:18:01'),
(29, 'Harmanpreet', 'Singh', 'fcea920f7412b5da7be0cf42b8c93759', 'harman7b@gmail.com', 'IT', '+919876543210', 'demo', 'demo', '2022122106532084564312022112207501050365191HZDV-005-A.jpg', '1', 9, 'Dubai - United Arab Emirates', 'fc684e59667e5135ad4e93dbb2a2d2e31469109846', '2022-12-21 06:55:37', '2022-12-21 11:55:37'),
(30, 'Agent_Dubai_testing', 'Last', '0f9526a2dc3e8e6a28d71af5a5b6d108', 'agent@yopmail.com', 'real estate agents', '0919781771170', 'dubai UAE', 'agent', '2022122106561453820900IMG_20210516_193333.jpg', '1', 10, 'Dubai - United Arab Emirates', '', '2023-02-09 12:04:54', '2023-02-09 19:04:54'),
(31, 'hello', 'blogger/agent', 'e10adc3949ba59abbe56e057f20f883e', 'hello@yopmail.com', 'property linker', '9781771170', 'Dubai', 'agent', '2022122203221349973905IMG_20210516_193333.jpg', '1', 23, 'Dubai International Airport (DXB) - Dubai - United Arab Emirates', '', '2023-01-25 06:37:24', '2023-01-25 13:37:24'),
(32, 'Test User1', 'Sharma', 'e10adc3949ba59abbe56e057f20f883e', 'test@yopmail.com', 'Agent', '9781771170', 'Agent', 'Agent', '202212230136442462690jonas-kakaroto-KIPqvvTOC1s-unsplash.jpg', '1', 10, 'Dubai Hills Mall, Dubai Hills Estate - Al Khail Road - Dubai - United Arab Emirates', '', '2023-01-25 06:37:24', '2023-01-25 13:37:24'),
(33, 'test', 'tset', 'e10adc3949ba59abbe56e057f20f883e', 'test123456@gmail.com', 'Test', '9876543210', 'test', 'test', '202212230202542132440chocolate-orange-cake-cappuccino.jpg', '1', 10, 'Mumbai, Maharashtra, India', '', '2023-01-25 06:37:24', '2023-01-25 13:37:24'),
(34, 'Test_User_2', 'Singh', 'e10adc3949ba59abbe56e057f20f883e', 'testuser@yopmail.com', 'Agent', '9781556671', 'Agent', 'Agent', '202212230211423993715jonas-kakaroto-KIPqvvTOC1s-unsplash.jpg', '1', 10, 'Dubai Airport Terminal 2 Arrivals - Dubai - United Arab Emirates', '', '2023-01-25 06:37:24', '2023-01-25 13:37:24'),
(39, 'Ashwani', 'Luna', 'e10adc3949ba59abbe56e057f20f883e', 'ashwani.luna@gmail.com', 'Real Estate', '9781771170', 'Dubai', 'Agent', '2023022105331324136431vr.PNG', '1', 10, 'Dubai Hills Mall - Al Khail Road - Dubai - United Arab Emirates', '', '2023-02-21 12:33:38', '2023-02-21 12:33:38');

-- --------------------------------------------------------

--
-- Table structure for table `user_new_tbl`
--

CREATE TABLE `user_new_tbl` (
  `id` int(10) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `Cpassword` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `token` varchar(250) DEFAULT NULL,
  `otp` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_new_tbl`
--

INSERT INTO `user_new_tbl` (`id`, `name`, `email`, `password`, `Cpassword`, `created_at`, `updated_at`, `token`, `otp`) VALUES
(1, 'Avinash Singh', 'js@gmail.com', '54321', '12345', '2023-06-07 12:01:44', '2023-06-13 10:30:26', '60794a6d676b636624696567', '1410356358'),
(2, 'Ayush Singh', 'ayush@gmail.com', '12345', '12345', '2023-06-07 12:11:55', '2023-06-14 06:55:51', '6b737f79624a6d676b636624696567', NULL),
(3, 'Ayush Singh', 'ayush@gmail.com', '654321', '654321', '2023-06-07 12:11:55', '2023-06-08 09:34:37', '6b737f79624a6d676b636624696567', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist_tbl`
--

CREATE TABLE `wishlist_tbl` (
  `id` int(10) NOT NULL,
  `pro_id` varchar(250) NOT NULL,
  `userId` varchar(250) DEFAULT NULL,
  `name` varchar(250) NOT NULL,
  `price` varchar(250) NOT NULL,
  `image` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist_tbl`
--

INSERT INTO `wishlist_tbl` (`id`, `pro_id`, `userId`, `name`, `price`, `image`, `created_at`, `updated_at`) VALUES
(7, '4', '2', 'Holiday Cap', '150', '2023060515418881219974.jpg', '2023-06-12 06:51:36', '2023-06-12 06:51:36'),
(8, '3', '2', 'Santa Claus Doll', '450', '20230605154019356286773.jpg', '2023-06-12 06:51:42', '2023-06-12 06:51:42'),
(17, '2', '1', 'Christmas Tree', '450', '2023060515395376138922.jpg', '2023-06-12 07:06:56', '2023-06-12 07:06:56'),
(19, '1', '1', 'Holiday Candle', '500', '20230605153211459481191.jpg', '2023-06-12 07:07:17', '2023-06-12 07:07:17');

-- --------------------------------------------------------

--
-- Table structure for table `workshop_tbl`
--

CREATE TABLE `workshop_tbl` (
  `id` int(10) NOT NULL,
  `class_id` varchar(255) NOT NULL,
  `branch_id` varchar(255) NOT NULL,
  `trainer_id` varchar(250) NOT NULL,
  `title` varchar(255) NOT NULL,
  `workshopdates` varchar(255) NOT NULL,
  `starttime` varchar(255) NOT NULL,
  `endtime` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `short_description` longtext NOT NULL,
  `description` longtext NOT NULL,
  `price` varchar(255) NOT NULL,
  `paymenttitle` varchar(255) NOT NULL,
  `page_title` longtext DEFAULT NULL,
  `page_description` longtext DEFAULT NULL,
  `page_schema` longtext DEFAULT NULL,
  `status` enum('1','0') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `workshop_tbl`
--

INSERT INTO `workshop_tbl` (`id`, `class_id`, `branch_id`, `trainer_id`, `title`, `workshopdates`, `starttime`, `endtime`, `image`, `short_description`, `description`, `price`, `paymenttitle`, `page_title`, `page_description`, `page_schema`, `status`, `created_at`, `updated_at`) VALUES
(17, '6', '1', '9', 'Hip-Hop with Gelai', '[\"5\\/9\\/2023\",\" 5\\/10\\/2023\",\" 5\\/12\\/2023\"]', '01:11', '20:00', '202304181147352661742Rectangle 55.png', 'Hip-Hop with Gelai', '<div><div><div><div><div><div><div><div><div><div><div><div><div><div><div><p>Hip-Hop with Gelai</p></div></div></div></div></div></div></div></div></div></div></div><br /></div><br /></div><br /></div><br /></div>', '1000', 'Hip-Hop with Gelai', 'Hip-Hop with Gelai', 'Hip-Hop with Gelai', 'Hip-Hop with Gelai', '1', '2023-04-04 01:43:46', '2023-05-26 08:09:08'),
(18, '12', '3', '11', 'Hip-Hop with Jaja', '[\"04\\/04\\/2023\",\" 04\\/07\\/2023\",\" 04\\/15\\/2023\",\" 04\\/22\\/2023\"]', '05:12', '12:44', '202304181147352145247Rectangle 55 (2).png', 'Hip-Hop with Jaja', '<div><div><div><div><div><div><div><div><div><div><div><div><div><p>Hip-Hop with Jaja</p><br /></div><br /></div><br /></div><br /></div><br /></div><br /></div><br /></div><br /></div><br /></div><br /></div><br /></div><br /></div><br /></div>', '1000', 'Hip-Hop with Jaja', 'Hip-Hop with Jaja', 'Hip-Hop with Jaja', 'Hip-Hop with Jaja', '1', '2023-04-04 03:00:06', '2023-05-26 08:09:08'),
(19, '10', '2', '10', 'Hip-Hop with Myka', '[\"4\\/22\\/2023\",\" 4\\/27\\/2023\",\" 4\\/28\\/2023\",\" 4\\/29\\/2023\"]', '04:22', '06:54', '2023041811461362980621Rectangle 55 (1).png', 'Hip-Hop with Myka', '<div><div><div><div><div><div><div><p>Hip-Hop with Myka</p><br /></div><br /></div><br /></div><br /></div><br /></div><br /></div><br /></div>', '1000', 'Hip-Hop with Myka', 'Hip-Hop with Myka', 'Hip-Hop with Myka', 'Hip-Hop with Myka', '1', '2023-04-14 06:47:20', '2023-05-26 08:09:07'),
(21, '16', '8', '12', 'Hip hop with menus', '[\"5\\/19\\/2023\",\" 5\\/20\\/2023\"]', '17:20', '19:20', '2023051515261782386340workshop.png', 'Test', '<div>Hip hop with menu<br /></div>', '2000', 'Hip hop with menu', 'Hip hop with menu', 'Hip hop with menu', 'Hip hop with menu', '1', '2023-05-15 09:56:06', '2023-05-26 08:14:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `achivement_tbl`
--
ALTER TABLE `achivement_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogcategory`
--
ALTER TABLE `blogcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_tbl`
--
ALTER TABLE `booking_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carrer_tbl`
--
ALTER TABLE `carrer_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart_tbl`
--
ALTER TABLE `cart_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_tbl`
--
ALTER TABLE `contact_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customize`
--
ALTER TABLE `customize`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enroll_class_tbl`
--
ALTER TABLE `enroll_class_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forgetpass`
--
ALTER TABLE `forgetpass`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forgotpassword`
--
ALTER TABLE `forgotpassword`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobpositioncategory_tbl`
--
ALTER TABLE `jobpositioncategory_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobposition_tbl`
--
ALTER TABLE `jobposition_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletter_tbl`
--
ALTER TABLE `newsletter_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `online_school_tbl`
--
ALTER TABLE `online_school_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `open_class_tbl`
--
ALTER TABLE `open_class_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organization_calender`
--
ALTER TABLE `organization_calender`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_tbl_new`
--
ALTER TABLE `payment_tbl_new`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `privacy`
--
ALTER TABLE `privacy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_tbl`
--
ALTER TABLE `product_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_class_tbl`
--
ALTER TABLE `project_class_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_category_tbl`
--
ALTER TABLE `school_category_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_tbl`
--
ALTER TABLE `school_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_tbl`
--
ALTER TABLE `student_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `the_force_tbl`
--
ALTER TABLE `the_force_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trainer_tbl`
--
ALTER TABLE `trainer_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_new_tbl`
--
ALTER TABLE `user_new_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist_tbl`
--
ALTER TABLE `wishlist_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `workshop_tbl`
--
ALTER TABLE `workshop_tbl`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `achivement_tbl`
--
ALTER TABLE `achivement_tbl`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `blogcategory`
--
ALTER TABLE `blogcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `booking_tbl`
--
ALTER TABLE `booking_tbl`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `carrer_tbl`
--
ALTER TABLE `carrer_tbl`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart_tbl`
--
ALTER TABLE `cart_tbl`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `contact_tbl`
--
ALTER TABLE `contact_tbl`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `customize`
--
ALTER TABLE `customize`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `enroll_class_tbl`
--
ALTER TABLE `enroll_class_tbl`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `forgetpass`
--
ALTER TABLE `forgetpass`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `forgotpassword`
--
ALTER TABLE `forgotpassword`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `jobpositioncategory_tbl`
--
ALTER TABLE `jobpositioncategory_tbl`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `jobposition_tbl`
--
ALTER TABLE `jobposition_tbl`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `newsletter_tbl`
--
ALTER TABLE `newsletter_tbl`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `online_school_tbl`
--
ALTER TABLE `online_school_tbl`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `open_class_tbl`
--
ALTER TABLE `open_class_tbl`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `organization_calender`
--
ALTER TABLE `organization_calender`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment_tbl_new`
--
ALTER TABLE `payment_tbl_new`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `privacy`
--
ALTER TABLE `privacy`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_tbl`
--
ALTER TABLE `product_tbl`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `project_class_tbl`
--
ALTER TABLE `project_class_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `school_category_tbl`
--
ALTER TABLE `school_category_tbl`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `school_tbl`
--
ALTER TABLE `school_tbl`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `student_tbl`
--
ALTER TABLE `student_tbl`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `the_force_tbl`
--
ALTER TABLE `the_force_tbl`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `trainer_tbl`
--
ALTER TABLE `trainer_tbl`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `user_new_tbl`
--
ALTER TABLE `user_new_tbl`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `wishlist_tbl`
--
ALTER TABLE `wishlist_tbl`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `workshop_tbl`
--
ALTER TABLE `workshop_tbl`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
