-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 02, 2018 at 02:20 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `isms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `acadamic_sessions`
--

CREATE TABLE `acadamic_sessions` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `first_term_start` date NOT NULL,
  `first_term_end` date NOT NULL,
  `second_term_start` date NOT NULL,
  `second_term_end` date NOT NULL,
  `third_term_start` date NOT NULL,
  `third_term_end` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acadamic_sessions`
--

INSERT INTO `acadamic_sessions` (`id`, `name`, `first_term_start`, `first_term_end`, `second_term_start`, `second_term_end`, `third_term_start`, `third_term_end`, `created_at`, `updated_at`) VALUES
(2, '', '2018-07-25', '2018-07-13', '2018-07-19', '2018-07-13', '2018-07-25', '2018-07-19', '2018-07-31 07:55:01', '0000-00-00 00:00:00'),
(3, '', '2018-07-03', '2018-07-09', '2018-07-11', '2018-07-17', '2018-07-28', '2018-07-20', '2018-07-31 08:10:38', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `assessment_categories`
--

CREATE TABLE `assessment_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `abbreviation` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assessment_categories`
--

INSERT INTO `assessment_categories` (`id`, `name`, `abbreviation`, `created_at`, `updated_at`) VALUES
(1, 'wasim', 'javed', '2018-08-02 04:57:11', '0000-00-00 00:00:00'),
(2, 'iam', 'here', '2018-08-02 04:52:56', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Access Bank Plc', '2018-07-31 11:47:07', '0000-00-00 00:00:00'),
(2, 'Citibank Nigeria Limited', '2018-07-31 11:47:07', '0000-00-00 00:00:00'),
(3, 'Diamond Bank Plc', '2018-07-31 11:47:24', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `bank_accounts`
--

CREATE TABLE `bank_accounts` (
  `id` int(11) NOT NULL,
  `bank_name` varchar(100) NOT NULL,
  `account_name` varchar(100) NOT NULL,
  `account_number` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank_accounts`
--

INSERT INTO `bank_accounts` (`id`, `bank_name`, `account_name`, `account_number`, `created_at`, `updated_at`) VALUES
(2, '2', 'citi bank', '1232323232', '2018-08-01 04:25:13', '0000-00-00 00:00:00'),
(8, '3', 'now', 'check', '2018-08-01 12:13:17', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `batches`
--

CREATE TABLE `batches` (
  `id` int(11) NOT NULL,
  `arm` varchar(100) NOT NULL,
  `course_id` int(11) NOT NULL,
  `session` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `batches`
--

INSERT INTO `batches` (`id`, `arm`, `course_id`, `session`, `created_at`, `updated_at`) VALUES
(1, 'MNIS', 1, '2018/2019', '2018-07-26 07:23:00', '0000-00-00 00:00:00'),
(2, 'MINIS', 2, '2018/2019', '2018-07-26 08:13:13', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `code` varchar(100) NOT NULL,
  `enable` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `name`, `code`, `enable`, `created_at`, `updated_at`) VALUES
(1, 'National certificate in Accoubtancy', 'NCA', 1, '2018-07-26 07:10:16', '0000-00-00 00:00:00'),
(2, 'National certificate in Secreterial Studies', 'NCSS', 1, '2018-07-26 07:10:16', '0000-00-00 00:00:00'),
(3, 'Certificate in Records and information management', 'CRIM', 1, '2018-07-26 07:10:43', '0000-00-00 00:00:00'),
(7, 'ddd', 'dfsdfsd', 1, '2018-07-30 11:27:11', '0000-00-00 00:00:00'),
(8, 'abbrevation', 'cvcv', 1, '2018-07-30 11:27:17', '0000-00-00 00:00:00'),
(9, 'sdfsdf', 'sdfsdf', 1, '2018-07-30 11:26:49', '0000-00-00 00:00:00'),
(10, 'dfsdf', 'sdfsdf', 0, '2018-07-30 11:23:31', '0000-00-00 00:00:00'),
(11, 'testtech', 'tecg', 1, '2018-07-31 06:56:38', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `countries_list`
--

CREATE TABLE `countries_list` (
  `id` int(11) NOT NULL,
  `country_code` varchar(2) NOT NULL DEFAULT '',
  `country_name` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries_list`
--

INSERT INTO `countries_list` (`id`, `country_code`, `country_name`) VALUES
(1, 'AF', 'Afghanistan'),
(2, 'AL', 'Albania'),
(3, 'DZ', 'Algeria'),
(4, 'DS', 'American Samoa'),
(5, 'AD', 'Andorra'),
(6, 'AO', 'Angola'),
(7, 'AI', 'Anguilla'),
(8, 'AQ', 'Antarctica'),
(9, 'AG', 'Antigua and Barbuda'),
(10, 'AR', 'Argentina'),
(11, 'AM', 'Armenia'),
(12, 'AW', 'Aruba'),
(13, 'AU', 'Australia'),
(14, 'AT', 'Austria'),
(15, 'AZ', 'Azerbaijan'),
(16, 'BS', 'Bahamas'),
(17, 'BH', 'Bahrain'),
(18, 'BD', 'Bangladesh'),
(19, 'BB', 'Barbados'),
(20, 'BY', 'Belarus'),
(21, 'BE', 'Belgium'),
(22, 'BZ', 'Belize'),
(23, 'BJ', 'Benin'),
(24, 'BM', 'Bermuda'),
(25, 'BT', 'Bhutan'),
(26, 'BO', 'Bolivia'),
(27, 'BA', 'Bosnia and Herzegovina'),
(28, 'BW', 'Botswana'),
(29, 'BV', 'Bouvet Island'),
(30, 'BR', 'Brazil'),
(31, 'IO', 'British Indian Ocean Territory'),
(32, 'BN', 'Brunei Darussalam'),
(33, 'BG', 'Bulgaria'),
(34, 'BF', 'Burkina Faso'),
(35, 'BI', 'Burundi'),
(36, 'KH', 'Cambodia'),
(37, 'CM', 'Cameroon'),
(38, 'CA', 'Canada'),
(39, 'CV', 'Cape Verde'),
(40, 'KY', 'Cayman Islands'),
(41, 'CF', 'Central African Republic'),
(42, 'TD', 'Chad'),
(43, 'CL', 'Chile'),
(44, 'CN', 'China'),
(45, 'CX', 'Christmas Island'),
(46, 'CC', 'Cocos (Keeling) Islands'),
(47, 'CO', 'Colombia'),
(48, 'KM', 'Comoros'),
(49, 'CG', 'Congo'),
(50, 'CK', 'Cook Islands'),
(51, 'CR', 'Costa Rica'),
(52, 'HR', 'Croatia (Hrvatska)'),
(53, 'CU', 'Cuba'),
(54, 'CY', 'Cyprus'),
(55, 'CZ', 'Czech Republic'),
(56, 'DK', 'Denmark'),
(57, 'DJ', 'Djibouti'),
(58, 'DM', 'Dominica'),
(59, 'DO', 'Dominican Republic'),
(60, 'TP', 'East Timor'),
(61, 'EC', 'Ecuador'),
(62, 'EG', 'Egypt'),
(63, 'SV', 'El Salvador'),
(64, 'GQ', 'Equatorial Guinea'),
(65, 'ER', 'Eritrea'),
(66, 'EE', 'Estonia'),
(67, 'ET', 'Ethiopia'),
(68, 'FK', 'Falkland Islands (Malvinas)'),
(69, 'FO', 'Faroe Islands'),
(70, 'FJ', 'Fiji'),
(71, 'FI', 'Finland'),
(72, 'FR', 'France'),
(73, 'FX', 'France, Metropolitan'),
(74, 'GF', 'French Guiana'),
(75, 'PF', 'French Polynesia'),
(76, 'TF', 'French Southern Territories'),
(77, 'GA', 'Gabon'),
(78, 'GM', 'Gambia'),
(79, 'GE', 'Georgia'),
(80, 'DE', 'Germany'),
(81, 'GH', 'Ghana'),
(82, 'GI', 'Gibraltar'),
(83, 'GK', 'Guernsey'),
(84, 'GR', 'Greece'),
(85, 'GL', 'Greenland'),
(86, 'GD', 'Grenada'),
(87, 'GP', 'Guadeloupe'),
(88, 'GU', 'Guam'),
(89, 'GT', 'Guatemala'),
(90, 'GN', 'Guinea'),
(91, 'GW', 'Guinea-Bissau'),
(92, 'GY', 'Guyana'),
(93, 'HT', 'Haiti'),
(94, 'HM', 'Heard and Mc Donald Islands'),
(95, 'HN', 'Honduras'),
(96, 'HK', 'Hong Kong'),
(97, 'HU', 'Hungary'),
(98, 'IS', 'Iceland'),
(99, 'IN', 'India'),
(100, 'IM', 'Isle of Man'),
(101, 'ID', 'Indonesia'),
(102, 'IR', 'Iran (Islamic Republic of)'),
(103, 'IQ', 'Iraq'),
(104, 'IE', 'Ireland'),
(105, 'IL', 'Israel'),
(106, 'IT', 'Italy'),
(107, 'CI', 'Ivory Coast'),
(108, 'JE', 'Jersey'),
(109, 'JM', 'Jamaica'),
(110, 'JP', 'Japan'),
(111, 'JO', 'Jordan'),
(112, 'KZ', 'Kazakhstan'),
(113, 'KE', 'Kenya'),
(114, 'KI', 'Kiribati'),
(115, 'KP', 'Korea, Democratic People\'s Republic of'),
(116, 'KR', 'Korea, Republic of'),
(117, 'XK', 'Kosovo'),
(118, 'KW', 'Kuwait'),
(119, 'KG', 'Kyrgyzstan'),
(120, 'LA', 'Lao People\'s Democratic Republic'),
(121, 'LV', 'Latvia'),
(122, 'LB', 'Lebanon'),
(123, 'LS', 'Lesotho'),
(124, 'LR', 'Liberia'),
(125, 'LY', 'Libyan Arab Jamahiriya'),
(126, 'LI', 'Liechtenstein'),
(127, 'LT', 'Lithuania'),
(128, 'LU', 'Luxembourg'),
(129, 'MO', 'Macau'),
(130, 'MK', 'Macedonia'),
(131, 'MG', 'Madagascar'),
(132, 'MW', 'Malawi'),
(133, 'MY', 'Malaysia'),
(134, 'MV', 'Maldives'),
(135, 'ML', 'Mali'),
(136, 'MT', 'Malta'),
(137, 'MH', 'Marshall Islands'),
(138, 'MQ', 'Martinique'),
(139, 'MR', 'Mauritania'),
(140, 'MU', 'Mauritius'),
(141, 'TY', 'Mayotte'),
(142, 'MX', 'Mexico'),
(143, 'FM', 'Micronesia, Federated States of'),
(144, 'MD', 'Moldova, Republic of'),
(145, 'MC', 'Monaco'),
(146, 'MN', 'Mongolia'),
(147, 'ME', 'Montenegro'),
(148, 'MS', 'Montserrat'),
(149, 'MA', 'Morocco'),
(150, 'MZ', 'Mozambique'),
(151, 'MM', 'Myanmar'),
(152, 'NA', 'Namibia'),
(153, 'NR', 'Nauru'),
(154, 'NP', 'Nepal'),
(155, 'NL', 'Netherlands'),
(156, 'AN', 'Netherlands Antilles'),
(157, 'NC', 'New Caledonia'),
(158, 'NZ', 'New Zealand'),
(159, 'NI', 'Nicaragua'),
(160, 'NE', 'Niger'),
(161, 'NG', 'Nigeria'),
(162, 'NU', 'Niue'),
(163, 'NF', 'Norfolk Island'),
(164, 'MP', 'Northern Mariana Islands'),
(165, 'NO', 'Norway'),
(166, 'OM', 'Oman'),
(167, 'PK', 'Pakistan'),
(168, 'PW', 'Palau'),
(169, 'PS', 'Palestine'),
(170, 'PA', 'Panama'),
(171, 'PG', 'Papua New Guinea'),
(172, 'PY', 'Paraguay'),
(173, 'PE', 'Peru'),
(174, 'PH', 'Philippines'),
(175, 'PN', 'Pitcairn'),
(176, 'PL', 'Poland'),
(177, 'PT', 'Portugal'),
(178, 'PR', 'Puerto Rico'),
(179, 'QA', 'Qatar'),
(180, 'RE', 'Reunion'),
(181, 'RO', 'Romania'),
(182, 'RU', 'Russian Federation'),
(183, 'RW', 'Rwanda'),
(184, 'KN', 'Saint Kitts and Nevis'),
(185, 'LC', 'Saint Lucia'),
(186, 'VC', 'Saint Vincent and the Grenadines'),
(187, 'WS', 'Samoa'),
(188, 'SM', 'San Marino'),
(189, 'ST', 'Sao Tome and Principe'),
(190, 'SA', 'Saudi Arabia'),
(191, 'SN', 'Senegal'),
(192, 'RS', 'Serbia'),
(193, 'SC', 'Seychelles'),
(194, 'SL', 'Sierra Leone'),
(195, 'SG', 'Singapore'),
(196, 'SK', 'Slovakia'),
(197, 'SI', 'Slovenia'),
(198, 'SB', 'Solomon Islands'),
(199, 'SO', 'Somalia'),
(200, 'ZA', 'South Africa'),
(201, 'GS', 'South Georgia South Sandwich Islands'),
(202, 'ES', 'Spain'),
(203, 'LK', 'Sri Lanka'),
(204, 'SH', 'St. Helena'),
(205, 'PM', 'St. Pierre and Miquelon'),
(206, 'SD', 'Sudan'),
(207, 'SR', 'Suriname'),
(208, 'SJ', 'Svalbard and Jan Mayen Islands'),
(209, 'SZ', 'Swaziland'),
(210, 'SE', 'Sweden'),
(211, 'CH', 'Switzerland'),
(212, 'SY', 'Syrian Arab Republic'),
(213, 'TW', 'Taiwan'),
(214, 'TJ', 'Tajikistan'),
(215, 'TZ', 'Tanzania, United Republic of'),
(216, 'TH', 'Thailand'),
(217, 'TG', 'Togo'),
(218, 'TK', 'Tokelau'),
(219, 'TO', 'Tonga'),
(220, 'TT', 'Trinidad and Tobago'),
(221, 'TN', 'Tunisia'),
(222, 'TR', 'Turkey'),
(223, 'TM', 'Turkmenistan'),
(224, 'TC', 'Turks and Caicos Islands'),
(225, 'TV', 'Tuvalu'),
(226, 'UG', 'Uganda'),
(227, 'UA', 'Ukraine'),
(228, 'AE', 'United Arab Emirates'),
(229, 'GB', 'United Kingdom'),
(230, 'US', 'United States'),
(231, 'UM', 'United States minor outlying islands'),
(232, 'UY', 'Uruguay'),
(233, 'UZ', 'Uzbekistan'),
(234, 'VU', 'Vanuatu'),
(235, 'VA', 'Vatican City State'),
(236, 'VE', 'Venezuela'),
(237, 'VN', 'Vietnam'),
(238, 'VG', 'Virgin Islands (British)'),
(239, 'VI', 'Virgin Islands (U.S.)'),
(240, 'WF', 'Wallis and Futuna Islands'),
(241, 'EH', 'Western Sahara'),
(242, 'YE', 'Yemen'),
(243, 'ZR', 'Zaire'),
(244, 'ZM', 'Zambia'),
(245, 'ZW', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `abbrevation` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `abbrevation`, `created_at`, `updated_at`) VALUES
(1, 'abbrevation', 'eee', '2018-07-30 06:23:10', '0000-00-00 00:00:00'),
(2, 'this is bull', 'shit', '2018-07-30 06:15:05', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `employee_id` int(11) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  `employee_no` varchar(100) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `date_of_join` date NOT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `religion` varchar(20) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `blood_group` varchar(5) DEFAULT NULL,
  `category` int(11) NOT NULL,
  `department` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `marital_status` varchar(10) NOT NULL,
  `qualification` varchar(20) NOT NULL,
  `genotype` varchar(5) DEFAULT NULL,
  `nationality` varchar(100) DEFAULT NULL,
  `state_of_origin` varchar(100) DEFAULT NULL,
  `lga_of_origin` varchar(100) DEFAULT NULL,
  `mobile_phone` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `address_line` text,
  `country` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `next_of_kin_name` varchar(100) NOT NULL,
  `next_of_kin_relation` varchar(100) NOT NULL,
  `next_of_kin_phone` varchar(100) NOT NULL,
  `next_of_kin_mobile` varchar(100) NOT NULL,
  `next_of_kin_address_line` text NOT NULL,
  `bank_name` varchar(100) NOT NULL,
  `account_name` varchar(100) NOT NULL,
  `account_number` varchar(100) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employee_id`, `surname`, `first_name`, `middle_name`, `title`, `employee_no`, `date_of_birth`, `date_of_join`, `gender`, `religion`, `photo`, `blood_group`, `category`, `department`, `position`, `marital_status`, `qualification`, `genotype`, `nationality`, `state_of_origin`, `lga_of_origin`, `mobile_phone`, `email`, `phone`, `address_line`, `country`, `state`, `city`, `next_of_kin_name`, `next_of_kin_relation`, `next_of_kin_phone`, `next_of_kin_mobile`, `next_of_kin_address_line`, `bank_name`, `account_name`, `account_number`, `created`, `updated`) VALUES
(1, 'Latif', 'Adnan', 'sdfsdf', '', '123456', '0000-00-00', '0000-00-00', 'male', '', NULL, '', 0, 0, 0, '', '', NULL, '', NULL, '', '', 'admin01@example.com', '', '', NULL, '', NULL, '', '', '', '', '', '', '', '', '2018-07-23 10:00:49', '2018-07-23 11:11:03'),
(2, 'new', 'employee', 'name', 'test', '6553322', '0000-00-00', '0000-00-00', 'female', 'islam', NULL, 'AB+', 1, 5, 3, 'married', 'NCE', NULL, '', NULL, 'punjab', '+9203314716890', 'admin@example.com', '033322222222', 'testting', NULL, 'punjab', NULL, 'test', '', 'test', 'test', 'test', '6', 'current', '123456789', '2018-07-23 10:49:43', '2018-07-24 05:48:25'),
(3, 'yousafrr', 'javed', 'wasim', 'test', '6553322', '0000-00-00', '0000-00-00', 'male', 'islam', NULL, 'AB-', 1, 6, 7, 'single', 'PROF', NULL, '', NULL, 'punjab', '+9203314716890', 'admin+1@example.com', '+92222222222222', 'xyz', NULL, 'punjab', NULL, 'test', 'test re', 'test mobile', 'test phone', 'test phone', '12', 'current', '11112323232323232', '2018-07-23 11:56:24', '2018-07-24 05:55:50'),
(4, 'now', 'check', 'this', '', '123456', '0000-00-00', '0000-00-00', '', '', NULL, '', 0, 0, 0, 'married', '', NULL, '', NULL, '', '', 'admin+2@example.com', '', '', NULL, '', NULL, '', '', '', '', '', '', '', '', '2018-07-24 05:07:57', '2018-07-24 05:56:01');

-- --------------------------------------------------------

--
-- Table structure for table `employee_categories`
--

CREATE TABLE `employee_categories` (
  `id` int(11) NOT NULL,
  `category` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_categories`
--

INSERT INTO `employee_categories` (`id`, `category`, `created_at`, `updated_at`) VALUES
(1, 'new employee category', '2018-07-30 05:47:56', '0000-00-00 00:00:00'),
(2, 'yyy', '2018-07-30 05:29:35', '0000-00-00 00:00:00'),
(3, 'hhhggguu', '2018-07-30 10:43:44', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `fees`
--

CREATE TABLE `fees` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fees`
--

INSERT INTO `fees` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(4, 'fee', 'type', '2018-07-31 12:24:20', '0000-00-00 00:00:00'),
(14, 'javed', 'wasim', '2018-08-01 11:39:40', '0000-00-00 00:00:00'),
(15, 'new', 'type', '2018-08-01 11:50:39', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `grade_scales`
--

CREATE TABLE `grade_scales` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grade_scales`
--

INSERT INTO `grade_scales` (`id`, `name`, `type`, `description`, `status`, `created_at`, `updated_at`) VALUES
(2, 'iam', 'behavioural', 'heresdfsdf', 'retire', '2018-08-02 11:07:30', '0000-00-00 00:00:00'),
(3, 'javed', 'cognitive', 'dfsdfsdfsd', 'retire', '2018-08-02 11:55:13', '0000-00-00 00:00:00'),
(6, 'new', 'behavioural', 'scale addedhhh', 'active', '2018-08-02 09:52:00', '0000-00-00 00:00:00'),
(7, 'now', 'behavioural', 'check', 'active', '2018-08-02 12:15:48', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `grade_scale_level`
--

CREATE TABLE `grade_scale_level` (
  `id` int(11) NOT NULL,
  `grade_scale_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `min_percentage` int(11) NOT NULL,
  `remarks` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grade_scale_level`
--

INSERT INTO `grade_scale_level` (`id`, `grade_scale_id`, `name`, `min_percentage`, `remarks`, `created_at`, `updated_at`) VALUES
(1, 2, 'A', 80, 'Excellent', '2018-08-02 07:20:52', '0000-00-00 00:00:00'),
(2, 2, 'B', 70, 'Very good', '2018-08-02 07:20:52', '0000-00-00 00:00:00'),
(5, 3, 'javed', 100, 'now remaks', '2018-08-02 10:28:38', '0000-00-00 00:00:00'),
(7, 6, 'iiui', 100, 'ooopopopo', '2018-08-02 10:33:34', '0000-00-00 00:00:00'),
(10, 3, 'wasim', 98, 'very good', '2018-08-02 10:50:22', '0000-00-00 00:00:00'),
(11, 7, 'sss', 56, '56 remarksddd', '2018-08-02 12:16:58', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `guardians`
--

CREATE TABLE `guardians` (
  `guardian_id` int(11) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `relation_with_student` varchar(100) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `mobile_phone` varchar(20) DEFAULT NULL,
  `address_line` int(11) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `state` varchar(100) NOT NULL,
  `city` varchar(100) DEFAULT NULL,
  `lga` int(100) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guardians`
--

INSERT INTO `guardians` (`guardian_id`, `surname`, `first_name`, `middle_name`, `relation_with_student`, `photo`, `title`, `email`, `gender`, `phone`, `mobile_phone`, `address_line`, `country`, `state`, `city`, `lga`, `created_by`, `created`, `updated`) VALUES
(1, 'Latif', 'Adnan', '', '', NULL, '', '', NULL, '', '', 0, '', '', '', 0, 0, '2018-07-19 08:50:31', '2018-07-19 08:50:31'),
(2, 'Rashid', 'Sohaib', '', '', NULL, '', '', NULL, '', '', 0, '', '', '', 0, 0, '2018-07-20 08:00:46', '2018-07-20 08:00:46'),
(3, 'Rashid', 'Sohaib', '', '', NULL, '', '', NULL, '', '', 0, '', '', '', 0, 0, '2018-07-20 09:18:44', '2018-07-20 09:18:44'),
(4, 'Latif', 'Adnan', '', '', NULL, '', '', NULL, '', '', 0, '', '', '', 0, 0, '2018-07-20 09:19:15', '2018-07-20 09:19:15'),
(5, 'Rashid', 'Sohaib', '', '', NULL, '', '', NULL, '', '', 0, '', '', '', 0, 0, '2018-07-20 09:21:39', '2018-07-20 09:21:39'),
(6, 'Latif', 'Adnan', 'name', 'test', NULL, 'test', '', NULL, '0331425222', '03314716555', 0, '', '', '', 0, 0, '2018-07-27 06:38:32', '2018-07-27 06:38:32'),
(7, 'Latif', 'Adnan', 'name', 'test', NULL, 'test', 'admin@example.com', NULL, '', '03314716555', 0, 'DZ', '', 'bwp', 0, 0, '2018-07-27 06:40:09', '2018-07-27 06:40:09'),
(8, 'now', 'Adnan', 'name', 'test', NULL, 'test', '', NULL, '', '', 0, '', '', '', 0, 0, '2018-07-27 06:47:27', '2018-07-27 06:47:27');

-- --------------------------------------------------------

--
-- Table structure for table `institutions`
--

CREATE TABLE `institutions` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `code` varchar(100) NOT NULL,
  `subdomain` varchar(100) NOT NULL,
  `slogan` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `website` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `logo` varchar(100) NOT NULL,
  `currency` varchar(10) NOT NULL,
  `country` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `institutions`
--

INSERT INTO `institutions` (`id`, `name`, `code`, `subdomain`, `slogan`, `email`, `website`, `phone`, `mobile`, `address`, `logo`, `currency`, `country`, `created_at`, `updated_at`) VALUES
(1, 'sdfsdf', 'sdfsdf', 'sdf', 'sdfsdf', 'admin@example.com', '', '', '', '', 'javed-5b6182a8d4e66.jpg', 'ugx', '', '2018-08-02 06:52:18', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `login_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(70) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `login_rights_group_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `creation_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`login_id`, `name`, `email`, `password`, `contact_no`, `last_login`, `login_rights_group_id`, `created_by`, `creation_time`, `status`) VALUES
(1, 'admin', 'admin@admin.com', '$2y$10$cNEEldLnfkCfj7GgziWjGu2C472JQ3fY6hCkhB5zO0pwAuOhqZk4e', '03001111111', '2018-07-31 10:00:56', 1, 1, '2018-07-10 06:31:57', 1);

-- --------------------------------------------------------

--
-- Table structure for table `login_rights_group`
--

CREATE TABLE `login_rights_group` (
  `login_rights_group_id` int(11) NOT NULL,
  `menu_group_id` int(11) NOT NULL,
  `other_rights_group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_rights_group`
--

INSERT INTO `login_rights_group` (`login_rights_group_id`, `menu_group_id`, `other_rights_group_id`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `menu_id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `menu_name` varchar(50) NOT NULL,
  `func_called` varchar(50) NOT NULL,
  `class` varchar(50) NOT NULL,
  `created_by` int(11) NOT NULL,
  `creation_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menu_id`, `parent_id`, `menu_name`, `func_called`, `class`, `created_by`, `creation_time`, `status`) VALUES
(1, NULL, 'Students', '#', 'fas fa-user-graduate', 1, '2018-07-14 11:21:12', 1),
(2, 1, 'Search', 'students', 'fa fa-search', 1, '2018-07-14 11:04:09', 1),
(3, 1, 'Add Student', 'add_student', 'fas fa-user-plus', 1, '2018-07-16 06:13:23', 1),
(4, NULL, 'Employess', '', 'fa fa-user-circle', 1, '2018-07-10 09:41:39', 1),
(5, 4, 'Search', 'employee', 'fa fa-search', 1, '2018-07-19 05:20:45', 1),
(6, 4, 'Add Employees', 'employee_add', 'fas fa-user-plus', 1, '2018-07-19 08:25:10', 1),
(7, NULL, 'Guardiens', 'guardians', 'fa fa-users', 1, '2018-07-19 08:51:53', 1),
(8, NULL, 'Attendance', '', 'fas fa-clipboard-list', 1, '2018-07-14 07:58:16', 1),
(9, 8, 'Register', 'register', 'fas fa-id-card-alt', 1, '2018-07-20 09:45:24', 1),
(10, 8, 'Reports', 'reports', 'fas fa-file-alt', 1, '2018-07-20 09:45:31', 1),
(11, NULL, 'Finance', '', 'fas fa-user-tie', 1, '2018-07-14 07:58:20', 1),
(12, 11, 'Master Transection', '', '', 1, '2018-07-10 09:43:27', 1),
(13, 11, 'Fees', '', '', 1, '2018-07-12 06:12:00', 1),
(14, 13, 'Fee Managment', '', '', 1, '2018-07-12 06:00:17', 1),
(15, 13, 'Fee Transection', '', '', 1, '2018-07-12 06:00:20', 1),
(16, 11, 'Income/Expense', '', '', 1, '2018-07-10 09:48:27', 1),
(17, 11, 'Wallet Transection', '', '', 1, '2018-07-10 09:48:31', 1),
(18, NULL, 'Subjects', '', 'fa fa-book', 1, '2018-07-30 11:01:08', 1),
(19, NULL, 'Batches', '', 'fa fa-users', 1, '2018-07-10 09:49:56', 1),
(20, NULL, 'Report Cards', '', 'fa fa-chart-line', 1, '2018-07-10 09:50:00', 1),
(21, NULL, 'SMS', '', 'fa fa-comment-alt', 1, '2018-07-10 09:50:03', 1),
(22, NULL, 'Events', '', 'fa fa-calendar-alt', 1, '2018-07-10 09:50:15', 1),
(23, 22, 'Calendar', '', '', 1, '2018-07-10 09:50:20', 1),
(24, 22, 'Events', '', '', 1, '2018-07-10 09:50:24', 1),
(25, NULL, 'Settings', '', 'fa fa-cogs', 1, '2018-07-10 09:50:31', 1),
(26, 25, 'Institution Details', 'institution_details', '', 1, '2018-07-30 10:55:54', 1),
(27, 25, 'Academic Sessions', 'academic_sessions', '', 1, '2018-07-30 12:02:08', 1),
(28, 25, 'Classes', 'classes', '', 1, '2018-07-30 07:16:59', 1),
(29, 25, 'Class sets', '', '', 1, '2018-07-10 09:51:59', 1),
(30, 25, 'Subject Names', 'subject_name', '', 1, '2018-07-30 10:56:12', 1),
(31, 25, 'Students', '', '', 1, '2018-07-10 09:52:20', 1),
(32, 31, 'Profile Fields', 'student_fields', '', 1, '2018-07-17 06:12:52', 1),
(33, 31, 'Student Categories', 'student_cat', '', 1, '2018-07-28 04:45:21', 1),
(34, 25, 'Employee', '', '', 1, '2018-07-10 09:52:44', 1),
(35, 34, 'Profile Fields', 'employee_profile_fields', '', 1, '2018-07-30 04:28:16', 1),
(36, 34, 'Categories', 'employee_cat', '', 1, '2018-07-30 04:28:30', 1),
(37, 34, 'Departments', 'employee_department', '', 1, '2018-07-30 04:28:39', 1),
(38, 34, 'Positions', 'emp_positions', '', 1, '2018-07-30 04:28:42', 1),
(39, 25, 'Finance', '', '', 1, '2018-07-10 09:53:43', 1),
(40, 39, 'Institution Bank Accounts', 'institution_bank_accounts', '', 1, '2018-07-31 05:27:55', 1),
(41, 39, 'Fee Types', 'fee_type', '', 1, '2018-07-31 09:42:28', 1),
(42, 39, 'Custom payment methods', 'custom_payment_method', '', 1, '2018-07-31 10:14:27', 1),
(43, 39, 'Transaction categories', 'transaction_categories', '', 1, '2018-07-31 10:53:38', 1),
(44, 25, 'GradeBook', '', '', 1, '2018-07-10 09:54:40', 1),
(45, 44, 'Grading Scales', 'grade_scales', '', 1, '2018-08-02 04:37:07', 1),
(46, 44, 'Assessment Categories', 'assessments', '', 1, '2018-08-01 09:52:37', 1),
(47, 44, 'Learning Domains', '', '', 1, '2018-07-10 09:54:53', 1),
(48, 25, 'Reports', '', '', 1, '2018-07-10 09:55:05', 1),
(49, 48, 'Report Card Templates', '', '', 1, '2018-07-10 09:55:10', 1),
(50, 48, 'Comment Bank', '', '', 1, '2018-07-10 09:55:15', 1),
(51, 25, 'General Settings', '', '', 1, '2018-07-10 09:55:29', 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu_group`
--

CREATE TABLE `menu_group` (
  `menu_group_id` int(11) NOT NULL,
  `menu_group_name` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL,
  `creation_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_group`
--

INSERT INTO `menu_group` (`menu_group_id`, `menu_group_name`, `created_by`, `creation_time`, `status`) VALUES
(1, 'Students', 1, '2018-07-10 07:29:24', 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu_group_detail`
--

CREATE TABLE `menu_group_detail` (
  `menu_group_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_group_detail`
--

INSERT INTO `menu_group_detail` (`menu_group_id`, `menu_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `other_rights`
--

CREATE TABLE `other_rights` (
  `other_rights_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `other_rights_name` varchar(50) NOT NULL,
  `func_called` varchar(100) NOT NULL,
  `class` varchar(50) NOT NULL,
  `created_by` int(11) NOT NULL,
  `creation_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `other_rights`
--

INSERT INTO `other_rights` (`other_rights_id`, `parent_id`, `other_rights_name`, `func_called`, `class`, `created_by`, `creation_time`, `status`) VALUES
(1, 1, 'search', '', '', 1, '2018-07-10 06:51:44', 1);

-- --------------------------------------------------------

--
-- Table structure for table `other_rights_group`
--

CREATE TABLE `other_rights_group` (
  `other_rights_group_id` int(11) NOT NULL,
  `other_rights_group_name` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL,
  `creation_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `other_rights_group`
--

INSERT INTO `other_rights_group` (`other_rights_group_id`, `other_rights_group_name`, `created_by`, `creation_time`, `status`) VALUES
(1, 'students', 1, '2018-07-10 06:52:12', 1);

-- --------------------------------------------------------

--
-- Table structure for table `other_rights_group_detail`
--

CREATE TABLE `other_rights_group_detail` (
  `other_rights_group_id` int(11) NOT NULL,
  `other_rights_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `other_rights_group_detail`
--

INSERT INTO `other_rights_group_detail` (`other_rights_group_id`, `other_rights_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `is_incoming` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `name`, `description`, `is_incoming`, `created_at`, `updated_at`) VALUES
(1, 'test', 'payment', 1, '2018-08-01 07:41:57', '0000-00-00 00:00:00'),
(5, 'check', 'checking payment', 0, '2018-08-02 04:54:12', '0000-00-00 00:00:00'),
(8, 'wee', 'we are heree', 1, '2018-08-02 05:58:16', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `abbrevation` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `name`, `abbrevation`, `created_at`, `updated_at`) VALUES
(1, 'ddd', 'ddddddyy', '2018-07-30 06:46:33', '0000-00-00 00:00:00'),
(2, 'dd', 'fdgdfgff', '2018-07-30 06:47:59', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `profile_fields`
--

CREATE TABLE `profile_fields` (
  `profile_field_id` int(11) NOT NULL,
  `profile_field_type` varchar(50) NOT NULL,
  `photo` tinyint(1) DEFAULT '0',
  `gender` tinyint(1) DEFAULT '0',
  `date_of_birth` tinyint(1) DEFAULT '0',
  `email` tinyint(1) DEFAULT '0',
  `mobile_phone` tinyint(1) DEFAULT '0',
  `phone` tinyint(1) DEFAULT '0',
  `address` tinyint(1) DEFAULT '0',
  `student_category` tinyint(1) DEFAULT '0',
  `religion` tinyint(1) DEFAULT '0',
  `nationality` tinyint(1) DEFAULT '0',
  `state_of_origin` tinyint(1) DEFAULT '0',
  `lga_of_origin` tinyint(1) DEFAULT '0',
  `blood_group` tinyint(1) DEFAULT '0',
  `genotype` tinyint(1) DEFAULT '0',
  `health_info` tinyint(1) DEFAULT '0',
  `guardian_info` tinyint(1) DEFAULT '0',
  `title` tinyint(1) DEFAULT '0',
  `guardian_info_section` tinyint(1) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profile_fields`
--

INSERT INTO `profile_fields` (`profile_field_id`, `profile_field_type`, `photo`, `gender`, `date_of_birth`, `email`, `mobile_phone`, `phone`, `address`, `student_category`, `religion`, `nationality`, `state_of_origin`, `lga_of_origin`, `blood_group`, `genotype`, `health_info`, `guardian_info`, `title`, `guardian_info_section`, `created`, `updated`) VALUES
(1, 'student', 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 1, '2018-07-19 05:08:27', '2018-07-27 07:55:04'),
(2, 'guardian', 0, 1, 0, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, '2018-07-19 05:01:50', '2018-07-24 06:12:36');

-- --------------------------------------------------------

--
-- Table structure for table `profile_group_detail`
--

CREATE TABLE `profile_group_detail` (
  `id` int(11) NOT NULL,
  `field_name` varchar(100) NOT NULL,
  `add_view` tinyint(1) NOT NULL,
  `list_view` tinyint(1) NOT NULL,
  `profile_setting_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profile_group_detail`
--

INSERT INTO `profile_group_detail` (`id`, `field_name`, `add_view`, `list_view`, `profile_setting_id`, `created_at`, `updated_at`) VALUES
(1, 'photo', 0, 1, 1, '2018-07-29 23:43:48', '0000-00-00 00:00:00'),
(2, 'gender', 0, 1, 1, '2018-07-30 01:22:18', '0000-00-00 00:00:00'),
(3, 'date_of_birth', 0, 1, 1, '2018-07-30 00:42:10', '0000-00-00 00:00:00'),
(4, 'email', 0, 1, 1, '2018-07-30 01:20:41', '0000-00-00 00:00:00'),
(5, 'mobile_phone', 0, 1, 1, '2018-07-30 01:20:41', '0000-00-00 00:00:00'),
(6, 'phone', 0, 1, 1, '2018-07-30 01:20:41', '0000-00-00 00:00:00'),
(7, 'address', 0, 1, 1, '2018-07-30 00:40:11', '0000-00-00 00:00:00'),
(8, 'student_category', 1, 1, 1, '2018-07-24 05:44:13', '0000-00-00 00:00:00'),
(9, 'religion', 0, 1, 1, '2018-07-30 01:20:41', '0000-00-00 00:00:00'),
(10, 'nationality', 0, 1, 1, '2018-07-30 01:20:41', '0000-00-00 00:00:00'),
(11, 'state_of_origin', 1, 1, 1, '2018-07-24 05:44:13', '0000-00-00 00:00:00'),
(12, 'lga_of_origin', 1, 1, 1, '2018-07-24 05:44:13', '0000-00-00 00:00:00'),
(13, 'blood_group', 0, 1, 1, '2018-07-30 01:20:41', '0000-00-00 00:00:00'),
(14, 'genotype', 1, 1, 1, '2018-07-24 05:44:13', '0000-00-00 00:00:00'),
(15, 'health_info', 1, 1, 1, '2018-07-24 05:44:13', '0000-00-00 00:00:00'),
(16, 'guardian_info', 0, 1, 1, '2018-07-29 23:43:48', '0000-00-00 00:00:00'),
(17, 'title', 0, 1, 1, '2018-07-29 23:43:48', '0000-00-00 00:00:00'),
(18, 'guardian_info_section', 1, 1, 1, '2018-07-24 05:44:14', '0000-00-00 00:00:00'),
(19, 'title', 0, 1, 3, '2018-07-30 01:23:38', '0000-00-00 00:00:00'),
(20, 'photo', 0, 1, 3, '2018-07-30 02:09:22', '0000-00-00 00:00:00'),
(21, 'date_of_join', 0, 1, 3, '2018-07-30 06:13:45', '0000-00-00 00:00:00'),
(22, 'gender', 1, 1, 3, '2018-07-30 02:09:22', '0000-00-00 00:00:00'),
(23, 'date_of_birth', 1, 1, 3, '2018-07-30 01:52:13', '0000-00-00 00:00:00'),
(24, 'email', 1, 1, 3, '2018-07-30 01:52:13', '0000-00-00 00:00:00'),
(25, 'mobile_phone', 1, 1, 3, '2018-07-30 01:51:32', '0000-00-00 00:00:00'),
(26, 'phone', 1, 1, 3, '2018-07-30 01:52:13', '0000-00-00 00:00:00'),
(27, 'address', 0, 1, 3, '2018-07-30 06:13:45', '0000-00-00 00:00:00'),
(28, 'employee_category', 0, 1, 3, '2018-07-30 06:13:45', '0000-00-00 00:00:00'),
(29, 'employee_position', 0, 1, 3, '2018-07-30 06:13:45', '0000-00-00 00:00:00'),
(30, 'employee_department', 0, 1, 3, '2018-07-30 06:13:45', '0000-00-00 00:00:00'),
(31, 'religion', 1, 1, 3, '2018-07-30 01:52:56', '0000-00-00 00:00:00'),
(32, 'nationality', 1, 1, 3, '2018-07-30 01:52:56', '0000-00-00 00:00:00'),
(33, 'blood_group', 1, 1, 3, '2018-07-30 01:52:56', '0000-00-00 00:00:00'),
(34, 'qualification', 1, 1, 3, '2018-07-30 01:52:56', '0000-00-00 00:00:00'),
(35, 'marital_status', 1, 1, 3, '2018-07-30 01:52:56', '0000-00-00 00:00:00'),
(36, 'bank_account_details', 1, 1, 3, '2018-07-30 01:44:48', '0000-00-00 00:00:00'),
(37, 'next_of_kin', 1, 1, 3, '2018-07-30 01:45:30', '0000-00-00 00:00:00'),
(38, 'next_of_kin_mobile', 1, 1, 3, '2018-07-30 01:45:30', '0000-00-00 00:00:00'),
(39, 'relation_next_of_kin', 1, 1, 3, '2018-07-30 01:45:30', '0000-00-00 00:00:00'),
(40, 'next_of_kin_phone', 1, 1, 3, '2018-07-30 01:52:56', '0000-00-00 00:00:00'),
(41, 'next_of_kin_address', 1, 1, 3, '2018-07-30 01:52:56', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `profile_settings`
--

CREATE TABLE `profile_settings` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profile_settings`
--

INSERT INTO `profile_settings` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'student', '2018-07-24 10:31:03', '0000-00-00 00:00:00'),
(2, 'teacher', '2018-07-24 10:31:03', '0000-00-00 00:00:00'),
(3, 'employee', '2018-07-30 05:00:20', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `guardian_id` int(11) DEFAULT NULL,
  `relation_with_student` varchar(100) DEFAULT NULL,
  `surname` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `admission_no` varchar(100) NOT NULL,
  `admission_date` date NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `religion` varchar(20) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `blood_group` varchar(5) DEFAULT NULL,
  `genotype` varchar(5) DEFAULT NULL,
  `nationality` varchar(100) DEFAULT NULL,
  `state_of_origin` varchar(100) DEFAULT NULL,
  `lga_of_origin` varchar(100) DEFAULT NULL,
  `batch_no` varchar(255) NOT NULL,
  `student_category` varchar(255) DEFAULT NULL,
  `mobile_phone` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `address_line` text,
  `country` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `guardian_id`, `relation_with_student`, `surname`, `first_name`, `last_name`, `admission_no`, `admission_date`, `date_of_birth`, `gender`, `religion`, `photo`, `blood_group`, `genotype`, `nationality`, `state_of_origin`, `lga_of_origin`, `batch_no`, `student_category`, `mobile_phone`, `email`, `phone`, `address_line`, `country`, `state`, `city`, `created`, `updated`) VALUES
(2, NULL, NULL, 'now iam', 'check', 'lastname', 'MCS-110', '2018-07-18', '0000-00-00', NULL, 'Islam', NULL, 'O+', 'SS', 'PK', 'punksb', '', 'MCS-2009-2012', 'category', '03314716555', 'admin@example.com', '0331425222', 'sdfsdffsdf', 'PK', 'punjab', 'bwp', '2018-07-16 08:25:34', '2018-07-23 06:20:42'),
(14, NULL, NULL, 'Rashid', 'Sohaib', '', 'BS-CS-110', '2018-07-31', '0000-00-00', NULL, '', NULL, '', '', '', '', '', 'MCS-2009-2011', '', '', '', '', '', '', '', '', '2018-07-16 08:47:40', '2018-07-16 08:47:40'),
(16, NULL, NULL, 'Latifddd', 'Adnan', 'sdfsdfsd', 'MCS-110', '2018-07-18', '0000-00-00', NULL, '', NULL, '', '', '', '', '', 'MCS-2009-2011', '', '', '', '', 'xyz', 'PK', 'punjab', 'bwp', '2018-07-20 06:47:29', '2018-07-23 06:01:54'),
(17, NULL, NULL, 'test nowdd', 'test', '', '1234', '2018-07-10', '2018-07-03', 'Female', 'Islam', NULL, 'O+', 'AA', 'PK', '', '', 'MCS-2009-2011', '', '', '', '', '', '', '', '', '2018-07-23 04:42:46', '2018-07-26 06:12:00'),
(18, NULL, NULL, 'test', 'Adnan', 'test', '12345', '2018-07-11', '2018-07-04', NULL, 'Islam', NULL, 'O+', '', '', '', '', 'MCS-2009-2011', '', '', '', '', '', '', '', '', '2018-07-23 04:46:47', '2018-07-23 04:46:47'),
(20, NULL, NULL, 'test ttt', 'test', '', '1234', '2018-07-18', '2018-07-06', NULL, 'Islam', NULL, '', '', '', '', '', 'MCS-2009-2011', '', '', '', '', '', '', '', '', '2018-07-23 05:00:23', '2018-07-23 05:14:20'),
(23, NULL, NULL, 'Latif', 'Adnan', 'dddd', 'MCS-110', '2018-07-05', '2018-07-05', NULL, '', NULL, '', '', '', '', '', 'MCS-2009-2011', '', '', '', '', '', '', '', '', '2018-07-23 05:07:30', '2018-07-23 06:07:11'),
(24, NULL, NULL, 'Latif', 'Adnan', 'fdsdfsdf', 'MCS-110', '2018-07-05', '2018-07-05', NULL, '', NULL, '', '', '', '', '', 'MCS-2009-2011', '', '', '', '', '', '', '', '', '2018-07-23 05:07:38', '2018-07-23 05:07:38'),
(25, NULL, NULL, 'Latif', 'Adnan', 'fdsdfsdf', 'MCS-110', '2018-07-05', '2018-07-05', NULL, '', NULL, '', '', '', '', '', 'MCS-2009-2011', '', '', '', '', '', '', '', '', '2018-07-23 05:08:06', '2018-07-23 05:08:06'),
(26, NULL, NULL, 'now', 'test', 'dddd', 'BS-CS-110', '2018-07-17', '2018-06-27', NULL, 'Islam', NULL, 'O+', 'SS', 'PK', 'punjab', '', 'MCS-2009-2011', '', '', 'admin@example.com', '', 'xyz', 'PK', 'punjab', 'bwp', '2018-07-23 05:13:13', '2018-07-23 06:06:04'),
(28, NULL, NULL, 'Latif', 'Adnan', 'lastname', 'MCS-110', '2018-07-19', '0000-00-00', NULL, '', NULL, '', '', '', '', '', 'MCS-2009-2012', '', '', '', '', '', '', '', '', '2018-07-23 06:26:25', '2018-07-23 06:26:25'),
(30, NULL, NULL, 'javed', 'wasim', 'anjum', 'MCS-110', '2018-07-04', '2018-07-18', 'male', 'Islam', NULL, 'O+', 'SS', 'PK', 'punjab', 'punjab', '2', 'category', '+923314716890', 'admin@example.com', '03325252123', 'abc', 'PK', 'punjab', 'bwp', '2018-07-23 06:36:10', '2018-07-26 10:32:40');

-- --------------------------------------------------------

--
-- Table structure for table `student_categories`
--

CREATE TABLE `student_categories` (
  `id` int(11) NOT NULL,
  `category` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_categories`
--

INSERT INTO `student_categories` (`id`, `category`, `created_at`, `updated_at`) VALUES
(2, 'new cate', '2018-07-28 06:31:37', '0000-00-00 00:00:00'),
(3, 'new cate', '2018-07-28 06:31:17', '0000-00-00 00:00:00'),
(4, 'ddd55', '2018-07-30 04:28:36', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `code` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `code`, `created_at`, `updated_at`) VALUES
(9, 'fgdfg', 'dfgdfg', '2018-07-30 12:23:08', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_categories`
--

CREATE TABLE `transaction_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_categories`
--

INSERT INTO `transaction_categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(4, 'tt', 'ttt', '2018-07-31 12:24:20', '0000-00-00 00:00:00'),
(5, 'new', 'trnasaction', '2018-07-31 12:25:31', '0000-00-00 00:00:00'),
(7, 'ddd', '  ggghy', '2018-08-01 11:53:12', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acadamic_sessions`
--
ALTER TABLE `acadamic_sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assessment_categories`
--
ALTER TABLE `assessment_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `batches`
--
ALTER TABLE `batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries_list`
--
ALTER TABLE `countries_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `employee_categories`
--
ALTER TABLE `employee_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fees`
--
ALTER TABLE `fees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grade_scales`
--
ALTER TABLE `grade_scales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grade_scale_level`
--
ALTER TABLE `grade_scale_level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guardians`
--
ALTER TABLE `guardians`
  ADD PRIMARY KEY (`guardian_id`);

--
-- Indexes for table `institutions`
--
ALTER TABLE `institutions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`login_id`);

--
-- Indexes for table `login_rights_group`
--
ALTER TABLE `login_rights_group`
  ADD PRIMARY KEY (`login_rights_group_id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `menu_group`
--
ALTER TABLE `menu_group`
  ADD PRIMARY KEY (`menu_group_id`);

--
-- Indexes for table `other_rights`
--
ALTER TABLE `other_rights`
  ADD PRIMARY KEY (`other_rights_id`);

--
-- Indexes for table `other_rights_group`
--
ALTER TABLE `other_rights_group`
  ADD PRIMARY KEY (`other_rights_group_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile_fields`
--
ALTER TABLE `profile_fields`
  ADD PRIMARY KEY (`profile_field_id`);

--
-- Indexes for table `profile_group_detail`
--
ALTER TABLE `profile_group_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile_settings`
--
ALTER TABLE `profile_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `student_categories`
--
ALTER TABLE `student_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_categories`
--
ALTER TABLE `transaction_categories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acadamic_sessions`
--
ALTER TABLE `acadamic_sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `assessment_categories`
--
ALTER TABLE `assessment_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `batches`
--
ALTER TABLE `batches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `countries_list`
--
ALTER TABLE `countries_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=246;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employee_categories`
--
ALTER TABLE `employee_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `fees`
--
ALTER TABLE `fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `grade_scales`
--
ALTER TABLE `grade_scales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `grade_scale_level`
--
ALTER TABLE `grade_scale_level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `guardians`
--
ALTER TABLE `guardians`
  MODIFY `guardian_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `institutions`
--
ALTER TABLE `institutions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `login_rights_group`
--
ALTER TABLE `login_rights_group`
  MODIFY `login_rights_group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `menu_group`
--
ALTER TABLE `menu_group`
  MODIFY `menu_group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `other_rights`
--
ALTER TABLE `other_rights`
  MODIFY `other_rights_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `other_rights_group`
--
ALTER TABLE `other_rights_group`
  MODIFY `other_rights_group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `profile_fields`
--
ALTER TABLE `profile_fields`
  MODIFY `profile_field_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `profile_group_detail`
--
ALTER TABLE `profile_group_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `profile_settings`
--
ALTER TABLE `profile_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `student_categories`
--
ALTER TABLE `student_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `transaction_categories`
--
ALTER TABLE `transaction_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
