-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 18, 2025 at 04:23 PM
-- Server version: 10.11.10-MariaDB-cll-lve
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elitexhub_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `main_id` int(11) NOT NULL,
  `admin_id` varchar(20) NOT NULL,
  `username` varchar(40) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `actpart` varchar(20) NOT NULL DEFAULT '0',
  `password` varchar(256) NOT NULL,
  `token` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`main_id`, `admin_id`, `username`, `email`, `phone`, `actpart`, `password`, `token`) VALUES
(1, '2347837', 'admin', 'admin@admin.com', '+1 ', '0', '$2y$10$8DtxMYSMhx9oMZGtBFLgvOa47Jr8Z8.IWjqYYO0BiSEgyfmV83x46', '80d1779cf96cb6c26c6f211bf1cac606');

-- --------------------------------------------------------

--
-- Table structure for table `balances`
--

CREATE TABLE `balances` (
  `main_id` int(11) NOT NULL,
  `mem_id` varchar(20) NOT NULL,
  `balance` varchar(30) NOT NULL DEFAULT '0',
  `bonus` varchar(30) NOT NULL DEFAULT '0',
  `available` varchar(30) NOT NULL DEFAULT '0',
  `profit` varchar(30) NOT NULL DEFAULT '0',
  `demobalance` varchar(30) NOT NULL DEFAULT '0',
  `demoavailable` varchar(30) NOT NULL DEFAULT '10000',
  `pending` varchar(30) NOT NULL DEFAULT '0',
  `currdaypro` varchar(100) NOT NULL DEFAULT '0',
  `currdayloss` varchar(100) NOT NULL DEFAULT '0',
  `alldaygain` varchar(100) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `balances`
--

INSERT INTO `balances` (`main_id`, `mem_id`, `balance`, `bonus`, `available`, `profit`, `demobalance`, `demoavailable`, `pending`, `currdaypro`, `currdayloss`, `alldaygain`) VALUES
(1, '5755453', '100', '100', '100', '0', '0', '10000', '0', '200', '75', '125'),
(2, '7943703', '101700', '0', '101700', '0', '0', '10000', '0', '0', '0', '0'),
(3, '3828643', '0', '0', '0', '0', '0', '10000', '0', '0', '0', '0'),
(4, '0177883', '0', '0', '0', '0', '0', '10000', '0', '0', '0', '0'),
(5, '9865940', '12420', '20', '12300', '200', '0', '10000', '0', '2300', '600', '1700'),
(8, '7843521', '0', '0', '56555', '0', '0', '10000', '0', '0', '0', '0'),
(9, '0035304', '500', '0', '1000', '0', '0', '10000', '0', '0', '0', '0'),
(10, '1444515', '0', '0', '0', '0', '0', '10000', '0', '0', '0', '0'),
(11, '4991117', '1231', '0', '1000', '231', '0', '10000', '0', '0', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `comminvest`
--

CREATE TABLE `comminvest` (
  `main_id` int(11) NOT NULL,
  `transc_id` varchar(30) NOT NULL,
  `comm` varchar(50) NOT NULL,
  `amount` varchar(30) NOT NULL,
  `duration` varchar(50) DEFAULT NULL,
  `date_added` varchar(30) NOT NULL,
  `profit` varchar(30) DEFAULT '0',
  `mem_id` varchar(30) NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `country_code` varchar(2) NOT NULL DEFAULT '',
  `country_name` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `country_code`, `country_name`) VALUES
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
(49, 'CD', 'Democratic Republic of the Congo'),
(50, 'CG', 'Republic of Congo'),
(51, 'CK', 'Cook Islands'),
(52, 'CR', 'Costa Rica'),
(53, 'HR', 'Croatia (Hrvatska)'),
(54, 'CU', 'Cuba'),
(55, 'CY', 'Cyprus'),
(56, 'CZ', 'Czech Republic'),
(57, 'DK', 'Denmark'),
(58, 'DJ', 'Djibouti'),
(59, 'DM', 'Dominica'),
(60, 'DO', 'Dominican Republic'),
(61, 'TP', 'East Timor'),
(62, 'EC', 'Ecuador'),
(63, 'EG', 'Egypt'),
(64, 'SV', 'El Salvador'),
(65, 'GQ', 'Equatorial Guinea'),
(66, 'ER', 'Eritrea'),
(67, 'EE', 'Estonia'),
(68, 'ET', 'Ethiopia'),
(69, 'FK', 'Falkland Islands (Malvinas)'),
(70, 'FO', 'Faroe Islands'),
(71, 'FJ', 'Fiji'),
(72, 'FI', 'Finland'),
(73, 'FR', 'France'),
(74, 'FX', 'France, Metropolitan'),
(75, 'GF', 'French Guiana'),
(76, 'PF', 'French Polynesia'),
(77, 'TF', 'French Southern Territories'),
(78, 'GA', 'Gabon'),
(79, 'GM', 'Gambia'),
(80, 'GE', 'Georgia'),
(81, 'DE', 'Germany'),
(82, 'GH', 'Ghana'),
(83, 'GI', 'Gibraltar'),
(84, 'GK', 'Guernsey'),
(85, 'GR', 'Greece'),
(86, 'GL', 'Greenland'),
(87, 'GD', 'Grenada'),
(88, 'GP', 'Guadeloupe'),
(89, 'GU', 'Guam'),
(90, 'GT', 'Guatemala'),
(91, 'GN', 'Guinea'),
(92, 'GW', 'Guinea-Bissau'),
(93, 'GY', 'Guyana'),
(94, 'HT', 'Haiti'),
(95, 'HM', 'Heard and Mc Donald Islands'),
(96, 'HN', 'Honduras'),
(97, 'HK', 'Hong Kong'),
(98, 'HU', 'Hungary'),
(99, 'IS', 'Iceland'),
(100, 'IN', 'India'),
(101, 'IM', 'Isle of Man'),
(102, 'ID', 'Indonesia'),
(103, 'IR', 'Iran (Islamic Republic of)'),
(104, 'IQ', 'Iraq'),
(105, 'IE', 'Ireland'),
(106, 'IL', 'Israel'),
(107, 'IT', 'Italy'),
(108, 'CI', 'Ivory Coast'),
(109, 'JE', 'Jersey'),
(110, 'JM', 'Jamaica'),
(111, 'JP', 'Japan'),
(112, 'JO', 'Jordan'),
(113, 'KZ', 'Kazakhstan'),
(114, 'KE', 'Kenya'),
(115, 'KI', 'Kiribati'),
(116, 'KP', 'Korea, Democratic People\'s Republic of'),
(117, 'KR', 'Korea, Republic of'),
(118, 'XK', 'Kosovo'),
(119, 'KW', 'Kuwait'),
(120, 'KG', 'Kyrgyzstan'),
(121, 'LA', 'Lao People\'s Democratic Republic'),
(122, 'LV', 'Latvia'),
(123, 'LB', 'Lebanon'),
(124, 'LS', 'Lesotho'),
(125, 'LR', 'Liberia'),
(126, 'LY', 'Libyan Arab Jamahiriya'),
(127, 'LI', 'Liechtenstein'),
(128, 'LT', 'Lithuania'),
(129, 'LU', 'Luxembourg'),
(130, 'MO', 'Macau'),
(131, 'MK', 'North Macedonia'),
(132, 'MG', 'Madagascar'),
(133, 'MW', 'Malawi'),
(134, 'MY', 'Malaysia'),
(135, 'MV', 'Maldives'),
(136, 'ML', 'Mali'),
(137, 'MT', 'Malta'),
(138, 'MH', 'Marshall Islands'),
(139, 'MQ', 'Martinique'),
(140, 'MR', 'Mauritania'),
(141, 'MU', 'Mauritius'),
(142, 'TY', 'Mayotte'),
(143, 'MX', 'Mexico'),
(144, 'FM', 'Micronesia, Federated States of'),
(145, 'MD', 'Moldova, Republic of'),
(146, 'MC', 'Monaco'),
(147, 'MN', 'Mongolia'),
(148, 'ME', 'Montenegro'),
(149, 'MS', 'Montserrat'),
(150, 'MA', 'Morocco'),
(151, 'MZ', 'Mozambique'),
(152, 'MM', 'Myanmar'),
(153, 'NA', 'Namibia'),
(154, 'NR', 'Nauru'),
(155, 'NP', 'Nepal'),
(156, 'NL', 'Netherlands'),
(157, 'AN', 'Netherlands Antilles'),
(158, 'NC', 'New Caledonia'),
(159, 'NZ', 'New Zealand'),
(160, 'NI', 'Nicaragua'),
(161, 'NE', 'Niger'),
(162, 'NG', 'Nigeria'),
(163, 'NU', 'Niue'),
(164, 'NF', 'Norfolk Island'),
(165, 'MP', 'Northern Mariana Islands'),
(166, 'NO', 'Norway'),
(167, 'OM', 'Oman'),
(168, 'PK', 'Pakistan'),
(169, 'PW', 'Palau'),
(170, 'PS', 'Palestine'),
(171, 'PA', 'Panama'),
(172, 'PG', 'Papua New Guinea'),
(173, 'PY', 'Paraguay'),
(174, 'PE', 'Peru'),
(175, 'PH', 'Philippines'),
(176, 'PN', 'Pitcairn'),
(177, 'PL', 'Poland'),
(178, 'PT', 'Portugal'),
(179, 'PR', 'Puerto Rico'),
(180, 'QA', 'Qatar'),
(181, 'RE', 'Reunion'),
(182, 'RO', 'Romania'),
(183, 'RU', 'Russian Federation'),
(184, 'RW', 'Rwanda'),
(185, 'KN', 'Saint Kitts and Nevis'),
(186, 'LC', 'Saint Lucia'),
(187, 'VC', 'Saint Vincent and the Grenadines'),
(188, 'WS', 'Samoa'),
(189, 'SM', 'San Marino'),
(190, 'ST', 'Sao Tome and Principe'),
(191, 'SA', 'Saudi Arabia'),
(192, 'SN', 'Senegal'),
(193, 'RS', 'Serbia'),
(194, 'SC', 'Seychelles'),
(195, 'SL', 'Sierra Leone'),
(196, 'SG', 'Singapore'),
(197, 'SK', 'Slovakia'),
(198, 'SI', 'Slovenia'),
(199, 'SB', 'Solomon Islands'),
(200, 'SO', 'Somalia'),
(201, 'ZA', 'South Africa'),
(202, 'GS', 'South Georgia South Sandwich Islands'),
(203, 'SS', 'South Sudan'),
(204, 'ES', 'Spain'),
(205, 'LK', 'Sri Lanka'),
(206, 'SH', 'St. Helena'),
(207, 'PM', 'St. Pierre and Miquelon'),
(208, 'SD', 'Sudan'),
(209, 'SR', 'Suriname'),
(210, 'SJ', 'Svalbard and Jan Mayen Islands'),
(211, 'SZ', 'Swaziland'),
(212, 'SE', 'Sweden'),
(213, 'CH', 'Switzerland'),
(214, 'SY', 'Syrian Arab Republic'),
(215, 'TW', 'Taiwan'),
(216, 'TJ', 'Tajikistan'),
(217, 'TZ', 'Tanzania, United Republic of'),
(218, 'TH', 'Thailand'),
(219, 'TG', 'Togo'),
(220, 'TK', 'Tokelau'),
(221, 'TO', 'Tonga'),
(222, 'TT', 'Trinidad and Tobago'),
(223, 'TN', 'Tunisia'),
(224, 'TR', 'Turkey'),
(225, 'TM', 'Turkmenistan'),
(226, 'TC', 'Turks and Caicos Islands'),
(227, 'TV', 'Tuvalu'),
(228, 'UG', 'Uganda'),
(229, 'UA', 'Ukraine'),
(230, 'AE', 'United Arab Emirates'),
(231, 'GB', 'United Kingdom'),
(232, 'US', 'United States'),
(233, 'UM', 'United States minor outlying islands'),
(234, 'UY', 'Uruguay'),
(235, 'UZ', 'Uzbekistan'),
(236, 'VU', 'Vanuatu'),
(237, 'VA', 'Vatican City State'),
(238, 'VE', 'Venezuela'),
(239, 'VN', 'Vietnam'),
(240, 'VG', 'Virgin Islands (British)'),
(241, 'VI', 'Virgin Islands (U.S.)'),
(242, 'WF', 'Wallis and Futuna Islands'),
(243, 'EH', 'Western Sahara'),
(244, 'YE', 'Yemen'),
(245, 'ZM', 'Zambia'),
(246, 'ZW', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `crypto`
--

CREATE TABLE `crypto` (
  `id` int(11) NOT NULL,
  `main_id` bigint(20) NOT NULL,
  `crypto_name` varchar(100) NOT NULL,
  `date_added` varchar(30) NOT NULL,
  `wallet_addr` varchar(120) NOT NULL,
  `barcode` varchar(255) DEFAULT NULL,
  `is_bank` tinyint(1) DEFAULT 0,
  `bank_name` varchar(100) DEFAULT NULL,
  `account_number` varchar(50) DEFAULT NULL,
  `swift_code` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `crypto`
--

INSERT INTO `crypto` (`id`, `main_id`, `crypto_name`, `date_added`, `wallet_addr`, `barcode`, `is_bank`, `bank_name`, `account_number`, `swift_code`) VALUES
(1, 264475, 'BITCOIN (BTC)', '15 Mar, 2025 18:59:17', 'bc1qrzcvk9etdrvcs2t7783xh4y2rg5hyewkwelj4p', 'bitcoin(btc)_barcode.png', 0, NULL, NULL, NULL),
(3, 205332, 'USDT (ERC20)', '14 Mar, 2025 17:42:49', '0xD949Ceef9f9561E10Ff86907aB39caf6cdc0ed3B', 'usdt(erc20)_barcode.png', 0, NULL, NULL, NULL),
(4, 533825, 'XRP LEDGER ', '14 Mar, 2025 17:47:23', 'rhRxRUi2JXLq9UddHyX6XV8uPpC4LYhBNA', 'xrpledger_barcode.png', 0, NULL, NULL, NULL),
(5, 551984, 'LITECOIN (LTC)', '14 Mar, 2025 18:02:30', 'LQmbfZS5ZMJ78e29qgpwC1gaaL5dMRopAA', 'litecoin_barcode.png', 0, NULL, NULL, NULL),
(6, 487951, 'TRON (TRX)', '14 Mar, 2025 17:54:52', 'TMFpAkkZyuhokgmNf28zy275SaSjzVddmN', 'tron(trx)_barcode.png', 0, NULL, NULL, NULL),
(7, 741381, 'SOLANA (SOL)', '14 Mar, 2025 17:59:11', 'Hnng3jcxQ2sNZR7uATw9p4eh5SL2fhZMJuoMWtGT6hqB', 'solana(sol)_barcode.png', 0, NULL, NULL, NULL),
(8, 191659, 'DOGECOIN (DOGE)', '14 Mar, 2025 18:01:16', 'DTa6hFoZsBLmm1YXE5mv44x75xxtjhC6FE', 'dogecoin(doge)_barcode.png', 0, NULL, NULL, NULL),
(12, 823464, 'ETHEREUM (ETH)', '15 Mar, 2025 12:25:25', '0xD949Ceef9f9561E10Ff86907aB39caf6cdc0ed3B', 'ethereum(eth)_barcode.png', 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `deptransc`
--

CREATE TABLE `deptransc` (
  `main_id` int(11) NOT NULL,
  `transc_id` varchar(20) NOT NULL,
  `crypto_name` varchar(200) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `date_added` varchar(50) NOT NULL,
  `proof` varchar(256) DEFAULT NULL,
  `mem_id` varchar(60) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `deptransc`
--

INSERT INTO `deptransc` (`main_id`, `transc_id`, `crypto_name`, `amount`, `date_added`, `proof`, `mem_id`, `status`) VALUES
(1, '5928989', 'BITCOIN', '500', '14 Mar, 2025', NULL, '5755453', 1),
(2, '6516279', 'BITCOIN', '100', '14 Mar, 2025', NULL, '5755453', 1),
(3, '2248689', 'USDT (ERC20)', '100', '14 Mar, 2025', NULL, '5755453', 1),
(4, '4596338', 'BITCOIN (BTC)', '200', '15 Mar, 2025', NULL, '7943703', 1),
(5, '7618712', 'First National Bank', '6000', '15 Mar, 2025', NULL, '7943703', 1),
(6, '5171540', 'First National Bank', '100', '15 Mar, 2025', NULL, '5755453', 1),
(7, '8789229', 'Union bank', '15000', '15 Mar, 2025', NULL, '7943703', 1),
(8, '8468391', 'First National Bank', '15000', '15 Mar, 2025', NULL, '7943703', 1),
(9, '5443000', 'bank', '15000', '15 Mar, 2025', NULL, '7943703', 1),
(10, '3356593', 'bank', '15000', '15 Mar, 2025', NULL, '7943703', 1),
(11, '2416655', 'bank', '15000', '15 Mar, 2025', NULL, '7943703', 1),
(12, '9995682', 'bank', '10500', '15 Mar, 2025', '9995682.png', '7943703', 1),
(13, '2509740', 'bank', '1000', '15 Mar, 2025', NULL, '7943703', 1),
(14, '7243534', 'bank', '1000', '15 Mar, 2025', NULL, '7943703', 1),
(15, '1283053', 'crypto_BITCOIN (BTC)', '1000', '15 Mar, 2025', '1283053.png', '9865940', 1),
(16, '3785781', 'crypto_BITCOIN (BTC)', '50000', '15 Mar, 2025', NULL, '7843521', 1),
(17, '0145538', 'crypto_BITCOIN (BTC)', '500', '15 Mar, 2025', NULL, '0035304', 1),
(18, '7084021', 'crypto_BITCOIN (BTC)', '56555', '15 Mar, 2025', NULL, '7843521', 1),
(19, '9227453', 'crypto_USDT (ERC20)', '500', '15 Mar, 2025', NULL, '0035304', 1),
(20, '8723119', 'crypto_BITCOIN (BTC)', '1000', '15 Mar, 2025', NULL, '7943703', 1),
(21, '2129048', 'crypto_BITCOIN (BTC)', '1000', '15 Mar, 2025', NULL, '7943703', 1),
(22, '0657623', 'crypto_BITCOIN (BTC)', '1000', '15 Mar, 2025', NULL, '7943703', 1),
(23, '6165429', 'crypto_XRP LEDGER ', '1000', '15 Mar, 2025', NULL, '7943703', 1),
(24, '5462176', 'BITCOIN (BTC)', '1000', '15 Mar, 2025', NULL, '7943703', 1),
(25, '0792360', 'BITCOIN (BTC)', '100', '18 Mar, 2025', NULL, '9865940', 1),
(26, '6688538', 'USDT (ERC20)', '100', '18 Mar, 2025', NULL, '9865940', 1),
(27, '9449019', 'BITCOIN (BTC)', '1000', '18 Mar, 2025', NULL, '4991117', 1);

-- --------------------------------------------------------

--
-- Table structure for table `dtdbonus`
--

CREATE TABLE `dtdbonus` (
  `main_id` int(11) NOT NULL,
  `asset` varchar(100) NOT NULL,
  `amount` varchar(20) NOT NULL,
  `mem_id` varchar(20) NOT NULL,
  `date_added` varchar(30) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `dtdbonus`
--

INSERT INTO `dtdbonus` (`main_id`, `asset`, `amount`, `mem_id`, `date_added`, `status`) VALUES
(1, 'Bitcoin ', '20', '9865940', '15 Mar, 2025', '1');

-- --------------------------------------------------------

--
-- Table structure for table `earninghistory`
--

CREATE TABLE `earninghistory` (
  `main_id` int(11) NOT NULL,
  `outcome` varchar(30) NOT NULL,
  `amount` varchar(30) NOT NULL,
  `mem_id` varchar(30) NOT NULL,
  `tradeid` varchar(30) NOT NULL,
  `earndate` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `earninghistory`
--

INSERT INTO `earninghistory` (`main_id`, `outcome`, `amount`, `mem_id`, `tradeid`, `earndate`) VALUES
(1, 'Profit', '1200', '9865940', '2058453', '15 Mar, 2025'),
(2, 'Profit', '231', '4991117', '9350319', '18 Mar, 2025');

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `main_id` int(11) NOT NULL,
  `symbol` varchar(100) NOT NULL,
  `price` varchar(30) NOT NULL,
  `mem_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `main_id` int(11) NOT NULL,
  `mem_id` varchar(20) NOT NULL,
  `username` varchar(150) NOT NULL,
  `fullname` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `country` varchar(150) NOT NULL,
  `currency` varchar(20) NOT NULL,
  `password` varchar(256) NOT NULL,
  `showpass` varchar(100) NOT NULL,
  `token` varchar(100) NOT NULL,
  `regdate` varchar(40) NOT NULL,
  `account` varchar(20) NOT NULL DEFAULT 'live',
  `photo` varchar(256) DEFAULT NULL,
  `trader_status` varchar(20) DEFAULT '0',
  `trader` varchar(30) DEFAULT NULL,
  `lastaccess` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mynft`
--

CREATE TABLE `mynft` (
  `main_id` int(11) NOT NULL,
  `nftid` varchar(20) NOT NULL,
  `nftname` varchar(255) NOT NULL,
  `nftprice` varchar(30) NOT NULL,
  `nftaddr` varchar(100) NOT NULL,
  `nftfile` varchar(50) NOT NULL,
  `nftnetwork` varchar(40) NOT NULL,
  `gasfee` varchar(30) NOT NULL DEFAULT '0.00',
  `payment` varchar(20) NOT NULL DEFAULT '0',
  `buyer` varchar(50) DEFAULT NULL,
  `dateadded` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT '0',
  `mem_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mynft`
--

INSERT INTO `mynft` (`main_id`, `nftid`, `nftname`, `nftprice`, `nftaddr`, `nftfile`, `nftnetwork`, `gasfee`, `payment`, `buyer`, `dateadded`, `status`, `mem_id`) VALUES
(1, 'NFT940668', 'Big Ape', '5', '0xZ5cRwYUomvFFN3cWdXEmlSt3HG', 'big_apenft.png', 'erc-20', '0.00', '0', NULL, '15 Mar, 2025', '1', '7943703');

-- --------------------------------------------------------

--
-- Table structure for table `nfthistory`
--

CREATE TABLE `nfthistory` (
  `main_id` int(11) NOT NULL,
  `transc_id` varchar(20) NOT NULL,
  `nft_id` varchar(20) NOT NULL,
  `amount` varchar(30) NOT NULL,
  `method` varchar(30) NOT NULL,
  `proof` varchar(100) NOT NULL,
  `addeddate` varchar(40) NOT NULL,
  `mem_id` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `nfthistory`
--

INSERT INTO `nfthistory` (`main_id`, `transc_id`, `nft_id`, `amount`, `method`, `proof`, `addeddate`, `mem_id`, `status`) VALUES
(1, '7450340', 'NFT940668', '5', 'BITCOIN (BTC)', '7450340.jpg', '15 Mar, 2025', '0177883', '0'),
(2, '5121291', 'NFT940668', '5', 'BITCOIN (BTC)', '5121291.jpg', '15 Mar, 2025', '0177883', '0'),
(3, '9531702', 'NFT881399', '508', 'BITCOIN (BTC)', '9531702.jpg', '15 Mar, 2025', '0177883', '0'),
(4, '8586309', 'NFT940668', '5', 'BITCOIN (BTC)', '8586309.jpg', '16 Mar, 2025', '0177883', '0'),
(5, '3326584', 'NFT881399', '508', 'USDT (ERC20)', '3326584.png', '18 Mar, 2025', '7943703', '0');

-- --------------------------------------------------------

--
-- Table structure for table `nfts`
--

CREATE TABLE `nfts` (
  `main_id` int(11) NOT NULL,
  `nftid` varchar(60) NOT NULL,
  `nftname` varchar(256) NOT NULL,
  `nftimage` varchar(256) NOT NULL,
  `nftprice` varchar(100) NOT NULL,
  `nftaddr` varchar(256) DEFAULT NULL,
  `nfttype` varchar(60) NOT NULL,
  `nftdesc` text NOT NULL,
  `nftroi` text NOT NULL,
  `nftfile` varchar(256) DEFAULT NULL,
  `nftstandard` varchar(100) NOT NULL,
  `nftblockchain` varchar(200) NOT NULL,
  `nftstatus` varchar(30) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nfts`
--

INSERT INTO `nfts` (`main_id`, `nftid`, `nftname`, `nftimage`, `nftprice`, `nftaddr`, `nfttype`, `nftdesc`, `nftroi`, `nftfile`, `nftstandard`, `nftblockchain`, `nftstatus`) VALUES
(26, 'NFT881399', 'Bad Kitty', 'bad_kittynft.png', '508', '0x4830ff0id0mchc92b', 'image', 'Just a Baaad Kitty', '35685.24,56423.8,62504.61,70224.7,74495.73,76180.82,77272.95', 'nft881399file.png', '4k', 'ERC-20', '1');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `main_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `message` text NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT '0',
  `datetime` varchar(40) NOT NULL,
  `mem_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`main_id`, `title`, `message`, `status`, `datetime`, `mem_id`) VALUES
(1, 'DEPOSIT ', 'A deposit of 100$ was confirmed in your trading account ', '0', '14 Mar, 2025', '7943703'),
(2, 'Deposit ', 'Hello a deposit of 100$ has been confirmed ', '0', '14 Mar, 2025', '5755453'),
(3, 'Elitex Hub Notification Service ', 'We wish to inform you that a Credit transaction occurred on your account with us.\r\nThe details of this transaction are shown below:\r\n\r\nTransaction Notification\r\n\r\nDescription : Deposit\r\nAmount : 1000USD\r\nValue Date : 15/03/2025\r\nRemarks : SUCCESSFUL \r\nTime of Transaction : 03:20(UTC)\r\nAvailable Balance : 1000USD', '1', '15 Mar, 2025', '9865940'),
(4, 'Bonus received', 'You have just received a bonus on your account, click <a href=\'claimbonus\'>here</a> to open and claim', '0', '15 Mar, 2025', '9865940'),
(5, 'Elitexhub Transaction Notification ', 'Your account has been credited with 1000USD', '0', '18 Mar, 2025', '4991117');

-- --------------------------------------------------------

--
-- Table structure for table `referral`
--

CREATE TABLE `referral` (
  `main_id` int(11) NOT NULL,
  `mem_id` bigint(50) NOT NULL,
  `referrer` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `main_id` int(11) NOT NULL,
  `fullname` varchar(130) NOT NULL,
  `role` varchar(150) NOT NULL,
  `message` text NOT NULL,
  `photo` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `traders`
--

CREATE TABLE `traders` (
  `main_id` int(11) NOT NULL,
  `trader_id` varchar(20) NOT NULL,
  `t_name` varchar(256) NOT NULL,
  `t_followers` varchar(50) NOT NULL,
  `t_photo1` varchar(256) NOT NULL,
  `t_win_rate` varchar(100) NOT NULL,
  `t_profit_share` varchar(100) NOT NULL,
  `t_total_win` varchar(50) NOT NULL,
  `t_total_loss` varchar(50) NOT NULL,
  `t_minimum` varchar(20) NOT NULL DEFAULT '0',
  `stars` varchar(10) NOT NULL,
  `t_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `traders`
--

INSERT INTO `traders` (`main_id`, `trader_id`, `t_name`, `t_followers`, `t_photo1`, `t_win_rate`, `t_profit_share`, `t_total_win`, `t_total_loss`, `t_minimum`, `stars`, `t_status`) VALUES
(43, '2359606351794', 'Assaf Marciano', '25600', '2359606351794.jpg', '96.6', '10', '563', '74', '300', '5', '1'),
(44, '1489583562251', 'John Samuel', '2173', '1489583562251.png', '99.7', '10', '2044', '129', '1000', '5', '1'),
(45, '8190573812959', 'Thomas Lincoln ', '5673', '8190573812959.jpg', '97.9', '15', '324', '52', '1000', '5', '1');

-- --------------------------------------------------------

--
-- Table structure for table `trades`
--

CREATE TABLE `trades` (
  `main_id` int(11) NOT NULL,
  `tradeid` bigint(20) NOT NULL,
  `asset` varchar(50) NOT NULL,
  `market` varchar(20) NOT NULL,
  `small_name` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `duration` varchar(30) NOT NULL DEFAULT '10',
  `symbol` varchar(80) NOT NULL,
  `tradetime` varchar(50) NOT NULL,
  `closetime` varchar(50) DEFAULT NULL,
  `leverage` varchar(50) NOT NULL,
  `tradedate` varchar(50) NOT NULL,
  `tradetype` varchar(50) NOT NULL,
  `tradestatus` varchar(20) NOT NULL DEFAULT '1',
  `outcome` varchar(20) DEFAULT NULL,
  `oamount` varchar(50) DEFAULT NULL,
  `price` varchar(50) NOT NULL,
  `finalprice` varchar(50) DEFAULT NULL,
  `mem_id` varchar(50) NOT NULL,
  `account` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trades`
--

INSERT INTO `trades` (`main_id`, `tradeid`, `asset`, `market`, `small_name`, `amount`, `duration`, `symbol`, `tradetime`, `closetime`, `leverage`, `tradedate`, `tradetype`, `tradestatus`, `outcome`, `oamount`, `price`, `finalprice`, `mem_id`, `account`) VALUES
(1, 2058453, 'BTCUSD', 'crypto', 'Bitcoin', '567', '1 minute', 'COINBASE:BTCUSD', '12:48pm', '07:00pm', '5', '15 Mar, 2025', 'Buy', '0', 'Profit', '1200', '84408.63', '84,508', '9865940', 'available'),
(2, 9350319, 'BTCUSD', 'crypto', 'Bitcoin', '500', '30 minutes', 'COINBASE:BTCUSD', '09:17am', '07:00pm', '5', '18 Mar, 2025', 'Buy', '0', 'Profit', '231', '82369.27', '700', '4991117', 'available');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `main_id` int(11) NOT NULL,
  `transc_type` varchar(30) NOT NULL,
  `date_added` varchar(50) NOT NULL,
  `amount` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT '0',
  `mem_id` varchar(30) NOT NULL,
  `transc_id` varchar(40) NOT NULL,
  `account` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`main_id`, `transc_type`, `date_added`, `amount`, `status`, `mem_id`, `transc_id`, `account`) VALUES
(1, 'Deposit', '14 Mar, 2025', '500', '1', '5755453', '5928989', 'live'),
(2, 'Deposit', '14 Mar, 2025', '100', '1', '5755453', '6516279', 'live'),
(3, 'Deposit', '14 Mar, 2025', '100', '1', '5755453', '2248689', 'live'),
(4, 'Withdrawal', '14 Mar, 2025', '10000', '1', '5755453', '1085162', 'live'),
(5, 'Deposit', '15 Mar, 2025', '200', '1', '7943703', '4596338', 'live'),
(6, 'Deposit', '15 Mar, 2025', '6000', '1', '7943703', '7618712', 'live'),
(7, 'Deposit', '15 Mar, 2025', '100', '1', '5755453', '5171540', 'live'),
(8, 'Deposit', '15 Mar, 2025', '15000', '1', '7943703', '8789229', 'live'),
(9, 'Deposit', '15 Mar, 2025', '15000', '1', '7943703', '8468391', 'live'),
(10, 'Deposit', '15 Mar, 2025', '15000', '1', '7943703', '5443000', 'live'),
(11, 'Deposit', '15 Mar, 2025', '15000', '1', '7943703', '3356593', 'live'),
(12, 'Deposit', '15 Mar, 2025', '15000', '1', '7943703', '2416655', 'live'),
(13, 'Deposit', '15 Mar, 2025', '10500', '1', '7943703', '9995682', 'live'),
(14, 'Deposit', '15 Mar, 2025', '1000', '1', '7943703', '2509740', 'live'),
(15, 'Deposit', '15 Mar, 2025', '1000', '1', '7943703', '7243534', 'live'),
(16, 'Deposit', '15 Mar, 2025', '1000', '1', '9865940', '1283053', 'live'),
(17, 'Trade (Buy)', '15 Mar, 2025', '567', '1', '9865940', '2058453', 'live'),
(18, 'Deposit', '15 Mar, 2025', '50000', '1', '7843521', '3785781', 'live'),
(19, 'Deposit', '15 Mar, 2025', '500', '1', '0035304', '0145538', 'live'),
(20, 'Deposit', '15 Mar, 2025', '56555', '1', '7843521', '7084021', 'live'),
(21, 'Deposit', '15 Mar, 2025', '500', '1', '0035304', '9227453', 'live'),
(22, 'Deposit', '15 Mar, 2025', '1000', '1', '7943703', '8723119', 'live'),
(23, 'Deposit', '15 Mar, 2025', '1000', '1', '7943703', '2129048', 'live'),
(24, 'Deposit', '15 Mar, 2025', '1000', '1', '7943703', '0657623', 'live'),
(25, 'Deposit', '15 Mar, 2025', '1000', '1', '7943703', '6165429', 'live'),
(26, 'Deposit', '15 Mar, 2025', '1000', '1', '7943703', '5462176', 'live'),
(27, 'NFT Purchase', '15 Mar, 2025', '5', '0', '0177883', '7450340', 'live'),
(28, 'NFT Purchase', '15 Mar, 2025', '5', '0', '0177883', '5121291', 'live'),
(29, 'NFT Purchase', '15 Mar, 2025', '508', '0', '0177883', '9531702', 'live'),
(30, 'NFT Purchase', '16 Mar, 2025', '5', '0', '0177883', '8586309', 'live'),
(31, 'Deposit', '18 Mar, 2025', '100', '1', '9865940', '0792360', 'live'),
(32, 'Deposit', '18 Mar, 2025', '100', '1', '9865940', '6688538', 'live'),
(33, 'NFT Purchase', '18 Mar, 2025', '508', '0', '7943703', '3326584', 'live'),
(34, 'Deposit', '18 Mar, 2025', '1000', '1', '4991117', '9449019', 'live'),
(35, 'Trade (Buy)', '18 Mar, 2025', '500', '1', '4991117', '9350319', 'available');

-- --------------------------------------------------------

--
-- Table structure for table `userplans`
--

CREATE TABLE `userplans` (
  `main_id` int(11) NOT NULL,
  `userplan` varchar(30) NOT NULL DEFAULT 'basic',
  `mem_id` varchar(30) NOT NULL,
  `plandate` varchar(30) NOT NULL,
  `planduration` varchar(20) DEFAULT NULL,
  `planamount` varchar(20) NOT NULL DEFAULT '0',
  `status` varchar(30) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userplans`
--

INSERT INTO `userplans` (`main_id`, `userplan`, `mem_id`, `plandate`, `planduration`, `planamount`, `status`) VALUES
(1, 'silver', '5755453', '15 Mar, 2025', NULL, '11800', '0'),
(2, 'basic', '7943703', '14 Mar, 2025', NULL, '0', '0'),
(3, 'basic', '3828643', '14 Mar, 2025', NULL, '0', '0'),
(4, 'basic', '0177883', '15 Mar, 2025', NULL, '0', '0'),
(5, 'bronze', '9865940', '15 Mar, 2025', '1 week', '12000', '1'),
(8, 'silver', '7843521', '15 Mar, 2025', NULL, '50000', '0'),
(9, 'basic', '0035304', '15 Mar, 2025', NULL, '0', '0'),
(10, 'basic', '1444515', '18 Mar, 2025', NULL, '0', '0'),
(11, 'basic', '4991117', '18 Mar, 2025', NULL, '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `verifications`
--

CREATE TABLE `verifications` (
  `main_id` int(11) NOT NULL,
  `mem_id` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL DEFAULT '0',
  `identity` varchar(10) NOT NULL DEFAULT '0',
  `idtype` varchar(100) DEFAULT NULL,
  `frontpage` varchar(100) DEFAULT NULL,
  `backpage` varchar(100) DEFAULT NULL,
  `status` varchar(10) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `verifications`
--

INSERT INTO `verifications` (`main_id`, `mem_id`, `email`, `identity`, `idtype`, `frontpage`, `backpage`, `status`) VALUES
(1, '5755453', '1', '3', 'Identity Card (ID)', '5755453-frontpage-1085375456.png', '5755453-backpage-1858952447.png', '1'),
(2, '7943703', '0', '0', NULL, NULL, NULL, '1'),
(3, '3828643', '1', '1', 'Identity Card (ID)', '3828643-frontpage-746482721.png', '3828643-backpage-797439667.png', '1'),
(4, '0177883', '0', '0', NULL, NULL, NULL, '1'),
(5, '9865940', '1', '3', 'Identity Card (ID)', '9865940-frontpage-1656888548.png', '9865940-backpage-97582510.png', '1'),
(8, '7843521', '1', '3', 'Drivers Licence', '7843521-frontpage-590161317.jpeg', '7843521-backpage-1995472381.jpeg', '1'),
(9, '0035304', '0', '3', 'Identity Card (ID)', '0035304-frontpage-371308814.jpeg', '0035304-backpage-1270165902.jpeg', '1'),
(10, '1444515', '0', '1', 'Drivers Licence', '1444515-frontpage-241111674.webp', '1444515-backpage-827730571.webp', '1'),
(11, '4991117', '1', '3', 'Identity Card (ID)', '4991117-frontpage-365241003.jpeg', '4991117-backpage-2099390317.png', '1');

-- --------------------------------------------------------

--
-- Table structure for table `wittransc`
--

CREATE TABLE `wittransc` (
  `main_id` int(11) NOT NULL,
  `transc_id` varchar(20) NOT NULL,
  `wallet_addr` varchar(150) DEFAULT NULL,
  `method` varchar(200) NOT NULL,
  `account` varchar(60) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `date_added` varchar(50) NOT NULL,
  `mem_id` varchar(60) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `bank_name` varchar(100) DEFAULT NULL,
  `account_number` varchar(50) DEFAULT NULL,
  `swift_code` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `wittransc`
--

INSERT INTO `wittransc` (`main_id`, `transc_id`, `wallet_addr`, `method`, `account`, `amount`, `date_added`, `mem_id`, `status`, `bank_name`, `account_number`, `swift_code`) VALUES
(1, '1085162', 'Hnng3jcxQ2sNZR7uATw9p4eh5SL2fhZMJuoMWtGT6hqB', 'BITCOIN (BTC)', 'available', '10000', '14 Mar, 2025', '5755453', 1, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`main_id`);

--
-- Indexes for table `balances`
--
ALTER TABLE `balances`
  ADD PRIMARY KEY (`main_id`);

--
-- Indexes for table `comminvest`
--
ALTER TABLE `comminvest`
  ADD PRIMARY KEY (`main_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crypto`
--
ALTER TABLE `crypto`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deptransc`
--
ALTER TABLE `deptransc`
  ADD PRIMARY KEY (`main_id`);

--
-- Indexes for table `dtdbonus`
--
ALTER TABLE `dtdbonus`
  ADD PRIMARY KEY (`main_id`);

--
-- Indexes for table `earninghistory`
--
ALTER TABLE `earninghistory`
  ADD PRIMARY KEY (`main_id`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`main_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`main_id`);

--
-- Indexes for table `mynft`
--
ALTER TABLE `mynft`
  ADD PRIMARY KEY (`main_id`);

--
-- Indexes for table `nfthistory`
--
ALTER TABLE `nfthistory`
  ADD PRIMARY KEY (`main_id`);

--
-- Indexes for table `nfts`
--
ALTER TABLE `nfts`
  ADD PRIMARY KEY (`main_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`main_id`);

--
-- Indexes for table `referral`
--
ALTER TABLE `referral`
  ADD PRIMARY KEY (`main_id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`main_id`);

--
-- Indexes for table `traders`
--
ALTER TABLE `traders`
  ADD PRIMARY KEY (`main_id`);

--
-- Indexes for table `trades`
--
ALTER TABLE `trades`
  ADD PRIMARY KEY (`main_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`main_id`);

--
-- Indexes for table `userplans`
--
ALTER TABLE `userplans`
  ADD PRIMARY KEY (`main_id`);

--
-- Indexes for table `verifications`
--
ALTER TABLE `verifications`
  ADD PRIMARY KEY (`main_id`);

--
-- Indexes for table `wittransc`
--
ALTER TABLE `wittransc`
  ADD PRIMARY KEY (`main_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `main_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `balances`
--
ALTER TABLE `balances`
  MODIFY `main_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `comminvest`
--
ALTER TABLE `comminvest`
  MODIFY `main_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `crypto`
--
ALTER TABLE `crypto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `deptransc`
--
ALTER TABLE `deptransc`
  MODIFY `main_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `dtdbonus`
--
ALTER TABLE `dtdbonus`
  MODIFY `main_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `earninghistory`
--
ALTER TABLE `earninghistory`
  MODIFY `main_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `main_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `main_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `mynft`
--
ALTER TABLE `mynft`
  MODIFY `main_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `nfthistory`
--
ALTER TABLE `nfthistory`
  MODIFY `main_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `nfts`
--
ALTER TABLE `nfts`
  MODIFY `main_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `main_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `referral`
--
ALTER TABLE `referral`
  MODIFY `main_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `main_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3761377;

--
-- AUTO_INCREMENT for table `traders`
--
ALTER TABLE `traders`
  MODIFY `main_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `trades`
--
ALTER TABLE `trades`
  MODIFY `main_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `main_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `userplans`
--
ALTER TABLE `userplans`
  MODIFY `main_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `verifications`
--
ALTER TABLE `verifications`
  MODIFY `main_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `wittransc`
--
ALTER TABLE `wittransc`
  MODIFY `main_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
