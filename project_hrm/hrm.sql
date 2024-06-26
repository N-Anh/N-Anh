-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jun 24, 2024 at 04:49 PM
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
-- Database: `hrm`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank_accounts`
--

CREATE TABLE `bank_accounts` (
  `bank_account_id` int(11) NOT NULL,
  `bank_account_no` varchar(20) NOT NULL,
  `bank_name` varchar(50) NOT NULL,
  `branch` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bank_accounts`
--

INSERT INTO `bank_accounts` (`bank_account_id`, `bank_account_no`, `bank_name`, `branch`, `created_at`, `updated_at`) VALUES
(1, '1234567890', 'AgriBank', 'Hà Nội', '2024-06-06 15:04:04', '2024-06-07 02:45:44'),
(2, '9876543210', 'Vietcombank', 'Ha Noi', '2024-06-06 15:04:04', '2024-06-06 15:04:04'),
(3, '4567890123', 'Techcombank', 'Hà Nội', '2024-06-06 15:04:04', '2024-06-07 02:46:01');

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
-- Table structure for table `career_path`
--

CREATE TABLE `career_path` (
  `career_path_id` int(11) NOT NULL,
  `employee_id` varchar(50) NOT NULL,
  `position_id` int(11) NOT NULL,
  `date_start` datetime NOT NULL,
  `date_end` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contracts`
--

CREATE TABLE `contracts` (
  `id` int(11) NOT NULL,
  `contract_id` varchar(50) NOT NULL,
  `employee_id` varchar(50) NOT NULL,
  `contract_type_id` int(11) NOT NULL,
  `signing_date` date NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `contract_duration` varchar(50) NOT NULL,
  `employment_type_id` int(11) NOT NULL,
  `status` tinyint(1) DEFAULT 1,
  `gross_salary` decimal(10,2) NOT NULL,
  `insurance_salary` decimal(10,2) NOT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contracts`
--

INSERT INTO `contracts` (`id`, `contract_id`, `employee_id`, `contract_type_id`, `signing_date`, `date_start`, `date_end`, `contract_duration`, `employment_type_id`, `status`, `gross_salary`, `insurance_salary`, `file_path`, `note`, `created_at`, `updated_at`) VALUES
(13, 'HDL2024008', 'IT0001', 1, '2024-06-01', '2024-06-01', '2024-07-01', '1 tháng', 1, 1, 10.00, 10.00, 'file_1718080955_HDL2024008.png', NULL, '2024-06-10 21:42:35', '2024-06-20 00:43:37'),
(25, 'HDL2024011', 'IT0002', 1, '2022-12-12', '2022-12-12', '2023-12-12', '1 năm', 1, 1, 12000000.00, 12000000.00, '', NULL, '2024-06-12 08:51:09', '2024-06-12 15:55:20'),
(27, 'HDL2024012', 'IT0002', 1, '2023-12-12', '2023-12-12', '2024-06-21', '1 năm', 1, 1, 12000000.00, 12000000.00, NULL, NULL, '2024-06-12 08:55:00', '2024-06-21 09:45:24'),
(31, 'HDL20240013', 'HR0001', 1, '2024-06-24', '2024-06-24', '2024-08-01', '1 năm', 1, 1, 13000000.00, 13000000.00, '', NULL, '2024-06-23 20:54:27', '2024-06-23 21:22:04');

-- --------------------------------------------------------

--
-- Table structure for table `contract_type`
--

CREATE TABLE `contract_type` (
  `contract_type_id` int(11) NOT NULL,
  `contract_type_name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contract_type`
--

INSERT INTO `contract_type` (`contract_type_id`, `contract_type_name`, `created_at`, `updated_at`) VALUES
(1, 'Hợp đồng lao động xác định thời hạn', '2024-06-06 14:29:17', '2024-06-06 14:30:51'),
(2, 'Hợp đồng lao động không xác định thời hạn', '2024-06-06 14:29:17', '2024-06-06 14:30:51'),
(3, 'Hợp đồng thử việc', '2024-06-06 14:34:31', '2024-06-06 14:34:31');

-- --------------------------------------------------------

--
-- Table structure for table `degrees`
--

CREATE TABLE `degrees` (
  `degree_id` int(11) NOT NULL,
  `degree_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `degrees`
--

INSERT INTO `degrees` (`degree_id`, `degree_name`) VALUES
(1, 'Đại học'),
(2, 'Cao đẳng'),
(3, 'Trung cấp');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(50) NOT NULL,
  `location` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`department_id`, `department_name`, `location`, `phone`, `created_at`, `updated_at`) VALUES
(1, 'Phòng Phát triển phần mềm', 'Tầng 9', '0987654321', '2024-06-06 14:34:52', '2024-06-06 14:35:17'),
(2, 'Phòng Hành chính - Nhân sự', 'Tầng 9', '0456789012', '2024-06-06 14:34:52', '2024-06-06 14:35:17');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(50) NOT NULL,
  `employee_name` varchar(100) NOT NULL,
  `gender_id` int(11) NOT NULL,
  `nationallity_id` int(11) NOT NULL,
  `religion_id` int(11) NOT NULL,
  `degree_id` int(11) NOT NULL,
  `salary_scale_id` int(11) NOT NULL,
  `salary_level_id` int(11) NOT NULL,
  `bank_account_id` int(11) NOT NULL,
  `unem_insurance_id` varchar(30) NOT NULL,
  `health_insurance_id` varchar(30) NOT NULL,
  `social_insurance_id` varchar(30) NOT NULL,
  `temporaty_address` varchar(255) NOT NULL,
  `permanent_address` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `identification` varchar(20) NOT NULL,
  `date_of_issue` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `date_of_birth` date NOT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ethnic_group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `employee_id`, `employee_name`, `gender_id`, `nationallity_id`, `religion_id`, `degree_id`, `salary_scale_id`, `salary_level_id`, `bank_account_id`, `unem_insurance_id`, `health_insurance_id`, `social_insurance_id`, `temporaty_address`, `permanent_address`, `phone`, `identification`, `date_of_issue`, `email`, `date_of_birth`, `file_path`, `created_at`, `updated_at`, `ethnic_group_id`) VALUES
(1, 'IT0001', 'Trần Ngọc Minh', 1, 1, 1, 1, 1, 1, 1, '1234567891', 'DN0012345678901', '1234567891', '123 Đường Trần Hưng Đạo, Phường Cửa Nam, Quận Hoàn Kiếm, Hà Nội', '456 Đường Nguyễn Du, Phường Lê Đại Hành, Quận Hai Bà Trưng, Hà Nội', '0912345678', '001123456789', '2024-01-02', 'ngocanhdao468@gmail.com', '1990-01-01', NULL, '2024-06-07 02:53:40', '2024-06-21 01:42:17', 1),
(3, 'HR0001', 'Nguyễn Thị Mai', 2, 1, 1, 1, 1, 1, 2, '2345678912', 'DN0023456789012', '2345678912', '789 Đường Lê Duẩn, Phường Cát Linh, Quận Đống Đa, Hà Nội', '123 Đường Hàng Bài, Phường Hàng Bài, Quận Hoàn Kiếm, Hà Nội', '0913456789', '001234567890', '2024-02-02', 'nguyenthimai@gmail.com', '1995-04-25', NULL, '2024-06-07 02:59:28', '2024-06-07 03:11:05', 1),
(4, 'IT0002', 'Trần Thị Minh Anh', 2, 1, 1, 1, 1, 1, 2, '3456789123', 'DN0034567890123', '3456789123', '456 Đường Nguyễn Thái Học, Phường Điện Biên, Quận Ba Đình, Hà Nội', '456 Đường Nguyễn Thái Học, Phường Điện Biên, Quận Ba Đình, Hà Nội', '0914567890', '001345678901', '2024-05-02', 'tranminhanh@gmail.com', '1998-06-25', NULL, '2024-06-07 03:02:21', '2024-06-07 03:11:12', 1);

-- --------------------------------------------------------

--
-- Table structure for table `employment_type`
--

CREATE TABLE `employment_type` (
  `employment_type_id` int(11) NOT NULL,
  `employment_type_name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employment_type`
--

INSERT INTO `employment_type` (`employment_type_id`, `employment_type_name`, `created_at`, `updated_at`) VALUES
(1, 'Toàn thời gian', '2024-06-06 14:35:41', '2024-06-06 14:35:58'),
(2, 'Bán thời gian', '2024-06-06 14:35:41', '2024-06-06 14:35:58'),
(3, 'Làm việc từ xa', '2024-06-06 14:35:41', '2024-06-06 14:35:58'),
(4, 'Làm việc thời vụ', '2024-06-06 14:35:41', '2024-06-06 14:35:58');

-- --------------------------------------------------------

--
-- Table structure for table `ethnic_groups`
--

CREATE TABLE `ethnic_groups` (
  `ethnic_group_id` int(11) NOT NULL,
  `nationallity_id` int(11) NOT NULL,
  `ethnic_group_name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ethnic_groups`
--

INSERT INTO `ethnic_groups` (`ethnic_group_id`, `nationallity_id`, `ethnic_group_name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Dân tộc Kinh', '2024-06-07 03:10:21', '2024-06-07 03:10:21'),
(2, 1, 'Dân tộc Thái', '2024-06-07 03:10:29', '2024-06-07 03:10:29'),
(3, 1, 'Dân tộc Dao', '2024-06-07 03:10:46', '2024-06-07 03:10:46');

-- --------------------------------------------------------

--
-- Table structure for table `experiences`
--

CREATE TABLE `experiences` (
  `employee_id` varchar(50) NOT NULL,
  `company_name` varchar(250) DEFAULT NULL,
  `position` varchar(50) NOT NULL,
  `description` varchar(250) DEFAULT NULL,
  `level` varchar(50) DEFAULT NULL,
  `technology` varchar(250) NOT NULL,
  `time` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `experiences`
--

INSERT INTO `experiences` (`employee_id`, `company_name`, `position`, `description`, `level`, `technology`, `time`, `created_at`, `updated_at`) VALUES
('IT0001', 'ABC Tech', 'Junior Software Engineer', 'Tham gia vào nhóm phát triển phần mềm của dự án eCommerce sử dụng React và Django. Phát triển và bảo trì các tính năng của ứng dụng, thực hiện kiểm thử đơn vị và tích hợp. Làm việc trong môi trường Agile Scrum.', 'Junior', 'React, Django, Agile Scrum', '1 năm 6 tháng', '2024-06-07 03:21:30', '2024-06-07 03:21:30'),
('IT0002', 'HIJ Solutions', 'Software Testing Engineer', 'Thực hiện kiểm thử chức năng và hiệu suất cho ứng dụng web bằng JMeter và Postman. Phát triển kịch bản kiểm thử, thực hiện kiểm thử tích hợp và hệ thống, và tối ưu hóa hiệu suất ứng dụng.', 'Junior', ' JMeter, Postman', '1 năm', '2024-06-07 03:25:36', '2024-06-07 03:25:36');

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
-- Table structure for table `genders`
--

CREATE TABLE `genders` (
  `gender_id` int(11) NOT NULL,
  `gender_name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `genders`
--

INSERT INTO `genders` (`gender_id`, `gender_name`, `created_at`, `updated_at`) VALUES
(1, 'Nam', '2024-06-06 14:37:22', '2024-06-06 14:37:41'),
(2, 'Nữ', '2024-06-06 14:37:22', '2024-06-06 14:37:41'),
(3, 'Khác', '2024-06-06 14:37:22', '2024-06-06 14:37:41');

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
(4, '2024_06_13_144455_create_statuses_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `nationallitys`
--

CREATE TABLE `nationallitys` (
  `nationallity_id` int(11) NOT NULL,
  `nationallity_name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nationallitys`
--

INSERT INTO `nationallitys` (`nationallity_id`, `nationallity_name`, `created_at`, `updated_at`) VALUES
(1, 'Việt Nam', '2024-06-06 14:38:05', '2024-06-06 14:38:25'),
(2, 'Trung Quốc', '2024-06-06 14:40:43', '2024-06-06 14:40:43');

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
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `position_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `position_name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`position_id`, `department_id`, `position_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'Kỹ sư phần mềm', 'Thiết kế, phát triển và duy trì các ứng dụng phần mềm.', '2024-06-06 14:38:43', '2024-06-06 14:39:01'),
(2, 1, 'Quản lý dự án', 'Quản lý và điều phối các dự án kỹ thuật.', '2024-06-06 14:38:43', '2024-06-06 14:39:01'),
(3, 1, 'Kiểm thử phần mềm', 'Thực hiện kiểm thử để đảm bảo chất lượng sản phẩm phần mềm.', '2024-06-06 14:38:43', '2024-06-06 14:39:01'),
(4, 2, 'Nhân viên nhân sự', 'Quản lý tuyển dụng và các hoạt động nhân sự.', '2024-06-06 14:38:43', '2024-06-06 14:39:01'),
(5, 2, 'Nhân viên kế toán', 'Thực hiện các nhiệm vụ kế toán như nhập liệu, kiểm tra, báo cáo tài chính.', '2024-06-06 14:38:43', '2024-06-06 14:39:01'),
(6, 1, 'Comtor', 'Giao tiếp và dịch thuật giữa khách hàng và đội ngũ phát triển.', '2024-06-06 14:38:43', '2024-06-06 14:39:01'),
(7, 1, 'Tester', 'Thực hiện kiểm thử phần mềm để đảm bảo chất lượng.', '2024-06-06 14:38:43', '2024-06-06 14:39:01');

-- --------------------------------------------------------

--
-- Table structure for table `relationships`
--

CREATE TABLE `relationships` (
  `relationship_id` int(11) NOT NULL,
  `relationship_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `relationships`
--

INSERT INTO `relationships` (`relationship_id`, `relationship_name`, `created_at`, `updated_at`) VALUES
(1, 'Bố', '2024-06-06 14:52:52', '2024-06-06 14:52:52'),
(2, 'Mẹ', '2024-06-06 14:52:52', '2024-06-06 14:52:52'),
(3, 'Con', '2024-06-06 14:52:52', '2024-06-06 14:52:52');

-- --------------------------------------------------------

--
-- Table structure for table `relatives`
--

CREATE TABLE `relatives` (
  `relative_id` int(11) NOT NULL,
  `employee_id` varchar(50) NOT NULL,
  `relative_name` varchar(100) NOT NULL,
  `relationship_id` int(11) NOT NULL,
  `gender_id` int(11) NOT NULL,
  `date_of_birth` datetime NOT NULL,
  `address` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `religions`
--

CREATE TABLE `religions` (
  `religion_id` int(11) NOT NULL,
  `religion_name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `religions`
--

INSERT INTO `religions` (`religion_id`, `religion_name`, `created_at`, `updated_at`) VALUES
(1, 'Không', '2024-06-06 14:58:53', '2024-06-06 14:58:53'),
(2, 'Đạo Phật', '2024-06-06 14:58:53', '2024-06-06 14:58:53'),
(3, 'Đạo Thiên Chúa', '2024-06-06 14:58:53', '2024-06-06 14:58:53'),
(4, 'Hồi giáo', '2024-06-06 14:58:53', '2024-06-06 14:58:53'),
(5, 'Đạo Hindu', '2024-06-06 14:58:53', '2024-06-06 14:58:53'),
(6, 'Đạo Do Thái', '2024-06-06 14:58:53', '2024-06-06 14:58:53');

-- --------------------------------------------------------

--
-- Table structure for table `salary_level`
--

CREATE TABLE `salary_level` (
  `salary_level_id` int(11) NOT NULL,
  `level` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `salary_level`
--

INSERT INTO `salary_level` (`salary_level_id`, `level`, `created_at`, `updated_at`) VALUES
(1, 'Bậc 1', '2024-06-06 16:28:14', '2024-06-06 16:28:14');

-- --------------------------------------------------------

--
-- Table structure for table `salary_scale`
--

CREATE TABLE `salary_scale` (
  `salary_scale_id` int(11) NOT NULL,
  `scale` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `salary_scale`
--

INSERT INTO `salary_scale` (`salary_scale_id`, `scale`, `created_at`, `updated_at`) VALUES
(1, 'Nhân viên ', '2024-06-06 16:27:11', '2024-06-06 16:27:11');

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
('SZWW8ZWIYiSVATBSkzKw3lMsghCuKwjhbnohFuuN', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMzhLZkV6bDN2QXhGS0k4blFYT2cxM2N2c0d0ajV6SWoyVE5BclJycSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1719202948);

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE `statuses` (
  `status_id` int(10) UNSIGNED NOT NULL,
  `status_name` varchar(50) NOT NULL,
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
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  ADD PRIMARY KEY (`bank_account_id`);

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
-- Indexes for table `career_path`
--
ALTER TABLE `career_path`
  ADD PRIMARY KEY (`career_path_id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `position_id` (`position_id`);

--
-- Indexes for table `contracts`
--
ALTER TABLE `contracts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `contract_id` (`contract_id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `employment_id` (`employment_type_id`),
  ADD KEY `contract_type_id` (`contract_type_id`);

--
-- Indexes for table `contract_type`
--
ALTER TABLE `contract_type`
  ADD PRIMARY KEY (`contract_type_id`);

--
-- Indexes for table `degrees`
--
ALTER TABLE `degrees`
  ADD PRIMARY KEY (`degree_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employee_id` (`employee_id`),
  ADD KEY `gender_id` (`gender_id`),
  ADD KEY `nationallity_id` (`nationallity_id`),
  ADD KEY `religion_id` (`religion_id`),
  ADD KEY `degree_id` (`degree_id`),
  ADD KEY `salary_scale_id` (`salary_scale_id`),
  ADD KEY `salary_level_id` (`salary_level_id`),
  ADD KEY `bank_account_id` (`bank_account_id`),
  ADD KEY `fk_ethnic_group_id` (`ethnic_group_id`);

--
-- Indexes for table `employment_type`
--
ALTER TABLE `employment_type`
  ADD PRIMARY KEY (`employment_type_id`);

--
-- Indexes for table `ethnic_groups`
--
ALTER TABLE `ethnic_groups`
  ADD PRIMARY KEY (`ethnic_group_id`),
  ADD KEY `nationallity_id` (`nationallity_id`);

--
-- Indexes for table `experiences`
--
ALTER TABLE `experiences`
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `genders`
--
ALTER TABLE `genders`
  ADD PRIMARY KEY (`gender_id`);

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
-- Indexes for table `nationallitys`
--
ALTER TABLE `nationallitys`
  ADD PRIMARY KEY (`nationallity_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`position_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `relationships`
--
ALTER TABLE `relationships`
  ADD PRIMARY KEY (`relationship_id`);

--
-- Indexes for table `relatives`
--
ALTER TABLE `relatives`
  ADD PRIMARY KEY (`relative_id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `gender_id` (`gender_id`),
  ADD KEY `relationship_id` (`relationship_id`);

--
-- Indexes for table `religions`
--
ALTER TABLE `religions`
  ADD PRIMARY KEY (`religion_id`);

--
-- Indexes for table `salary_level`
--
ALTER TABLE `salary_level`
  ADD PRIMARY KEY (`salary_level_id`);

--
-- Indexes for table `salary_scale`
--
ALTER TABLE `salary_scale`
  ADD PRIMARY KEY (`salary_scale_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`status_id`);

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
-- AUTO_INCREMENT for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  MODIFY `bank_account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `career_path`
--
ALTER TABLE `career_path`
  MODIFY `career_path_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contracts`
--
ALTER TABLE `contracts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `contract_type`
--
ALTER TABLE `contract_type`
  MODIFY `contract_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `degrees`
--
ALTER TABLE `degrees`
  MODIFY `degree_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employment_type`
--
ALTER TABLE `employment_type`
  MODIFY `employment_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ethnic_groups`
--
ALTER TABLE `ethnic_groups`
  MODIFY `ethnic_group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `genders`
--
ALTER TABLE `genders`
  MODIFY `gender_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `nationallitys`
--
ALTER TABLE `nationallitys`
  MODIFY `nationallity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `position_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `relationships`
--
ALTER TABLE `relationships`
  MODIFY `relationship_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `relatives`
--
ALTER TABLE `relatives`
  MODIFY `relative_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `religions`
--
ALTER TABLE `religions`
  MODIFY `religion_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `salary_level`
--
ALTER TABLE `salary_level`
  MODIFY `salary_level_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `salary_scale`
--
ALTER TABLE `salary_scale`
  MODIFY `salary_scale_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `status_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `career_path`
--
ALTER TABLE `career_path`
  ADD CONSTRAINT `career_path_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`),
  ADD CONSTRAINT `career_path_ibfk_2` FOREIGN KEY (`position_id`) REFERENCES `positions` (`position_id`);

--
-- Constraints for table `contracts`
--
ALTER TABLE `contracts`
  ADD CONSTRAINT `contracts_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`),
  ADD CONSTRAINT `contracts_ibfk_2` FOREIGN KEY (`employment_type_id`) REFERENCES `employment_type` (`employment_type_id`),
  ADD CONSTRAINT `contracts_ibfk_3` FOREIGN KEY (`contract_type_id`) REFERENCES `contract_type` (`contract_type_id`);

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`gender_id`) REFERENCES `genders` (`gender_id`),
  ADD CONSTRAINT `employees_ibfk_2` FOREIGN KEY (`nationallity_id`) REFERENCES `nationallitys` (`nationallity_id`),
  ADD CONSTRAINT `employees_ibfk_3` FOREIGN KEY (`religion_id`) REFERENCES `religions` (`religion_id`),
  ADD CONSTRAINT `employees_ibfk_4` FOREIGN KEY (`degree_id`) REFERENCES `degrees` (`degree_id`),
  ADD CONSTRAINT `employees_ibfk_5` FOREIGN KEY (`salary_scale_id`) REFERENCES `salary_scale` (`salary_scale_id`),
  ADD CONSTRAINT `employees_ibfk_6` FOREIGN KEY (`salary_level_id`) REFERENCES `salary_level` (`salary_level_id`),
  ADD CONSTRAINT `employees_ibfk_7` FOREIGN KEY (`bank_account_id`) REFERENCES `bank_accounts` (`bank_account_id`),
  ADD CONSTRAINT `fk_ethnic_group_id` FOREIGN KEY (`ethnic_group_id`) REFERENCES `ethnic_groups` (`ethnic_group_id`);

--
-- Constraints for table `ethnic_groups`
--
ALTER TABLE `ethnic_groups`
  ADD CONSTRAINT `ethnic_groups_ibfk_1` FOREIGN KEY (`nationallity_id`) REFERENCES `nationallitys` (`nationallity_id`);

--
-- Constraints for table `experiences`
--
ALTER TABLE `experiences`
  ADD CONSTRAINT `experiences_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`);

--
-- Constraints for table `positions`
--
ALTER TABLE `positions`
  ADD CONSTRAINT `positions_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`department_id`);

--
-- Constraints for table `relatives`
--
ALTER TABLE `relatives`
  ADD CONSTRAINT `relatives_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`),
  ADD CONSTRAINT `relatives_ibfk_2` FOREIGN KEY (`gender_id`) REFERENCES `genders` (`gender_id`),
  ADD CONSTRAINT `relatives_ibfk_3` FOREIGN KEY (`relationship_id`) REFERENCES `relationships` (`relationship_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
