-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2020 at 07:02 PM
-- Server version: 10.1.39-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stomotology`
--

-- --------------------------------------------------------

--
-- Table structure for table `ambulance_call`
--

CREATE TABLE `ambulance_call` (
  `id` int(11) NOT NULL,
  `patient_name` varchar(50) DEFAULT NULL,
  `contact_no` varchar(30) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `vehicle_no` varchar(20) DEFAULT NULL,
  `vehicle_model` varchar(20) DEFAULT NULL,
  `driver` varchar(100) NOT NULL,
  `amount` float(10,2) DEFAULT NULL,
  `date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `appointment_no` varchar(100) NOT NULL,
  `date` varchar(50) DEFAULT NULL,
  `patient_name` varchar(50) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mobileno` varchar(50) DEFAULT NULL,
  `doctor` varchar(50) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `appointment_status` varchar(11) DEFAULT NULL,
  `source` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bed`
--

CREATE TABLE `bed` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `bed_type_id` int(11) NOT NULL,
  `bed_group_id` int(100) NOT NULL,
  `is_active` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bed`
--

INSERT INTO `bed` (`id`, `name`, `bed_type_id`, `bed_group_id`, `is_active`) VALUES
(1, 'BED01', 1, 1, 'yes'),
(2, 'BED02', 2, 2, 'yes'),
(3, 'BED03', 2, 3, 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `bed_group`
--

CREATE TABLE `bed_group` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `floor` varchar(100) NOT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bed_group`
--

INSERT INTO `bed_group` (`id`, `name`, `description`, `floor`, `is_active`) VALUES
(1, 'Normal Group', 'This is the normal group of bed.', '1', 0),
(2, 'Emergency Group', 'Patients should be operated and examined immediately.', '2', 0),
(3, 'Other Group', 'No other description is added here.', '3', 0);

-- --------------------------------------------------------

--
-- Table structure for table `bed_type`
--

CREATE TABLE `bed_type` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bed_type`
--

INSERT INTO `bed_type` (`id`, `name`) VALUES
(1, 'Short Time'),
(2, 'Long Term'),
(3, 'Middle Term');

-- --------------------------------------------------------

--
-- Table structure for table `blood_bank_status`
--

CREATE TABLE `blood_bank_status` (
  `id` int(11) NOT NULL,
  `blood_group` varchar(3) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `ceated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blood_bank_status`
--

INSERT INTO `blood_bank_status` (`id`, `blood_group`, `status`, `ceated_at`, `updated_at`) VALUES
(1, 'A+', '10', '2018-08-18 11:40:07', '2018-08-18 11:40:07'),
(2, 'B+', '0', '2018-08-18 12:10:55', '2018-08-18 12:10:55'),
(3, 'A-', '0', '2018-08-18 12:11:24', '2018-08-18 12:11:24'),
(4, 'B-', '20', '2018-08-18 12:11:44', '2018-08-18 12:11:44'),
(5, 'O+', '0', '2018-08-18 12:12:06', '2018-08-18 12:12:06'),
(6, 'O-', '0', '2018-08-18 12:12:20', '2018-08-18 12:12:20'),
(7, 'AB+', '0', '2018-08-18 12:12:36', '2018-08-18 12:12:36'),
(8, 'AB-', '0', '2018-08-18 12:13:18', '2018-08-18 12:13:18');

-- --------------------------------------------------------

--
-- Table structure for table `blood_donor`
--

CREATE TABLE `blood_donor` (
  `id` int(11) NOT NULL,
  `donor_name` varchar(100) DEFAULT NULL,
  `age` varchar(11) DEFAULT NULL,
  `month` varchar(20) DEFAULT NULL,
  `blood_group` varchar(11) DEFAULT NULL,
  `gender` varchar(11) DEFAULT NULL,
  `father_name` varchar(100) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `contact_no` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blood_donor`
--

INSERT INTO `blood_donor` (`id`, `donor_name`, `age`, `month`, `blood_group`, `gender`, `father_name`, `address`, `contact_no`, `created_at`, `updated_at`) VALUES
(1, 'Rasikh', '12', '2', 'A+', '', 'sadff', 'skjdfhakjh', '898998', '2019-08-25 17:56:08', '2019-08-25 17:56:08');

-- --------------------------------------------------------

--
-- Table structure for table `blood_donor_cycle`
--

CREATE TABLE `blood_donor_cycle` (
  `id` int(11) NOT NULL,
  `blood_donor_id` int(11) NOT NULL,
  `institution` varchar(100) DEFAULT NULL,
  `lot` varchar(11) DEFAULT NULL,
  `bag_no` varchar(11) DEFAULT NULL,
  `quantity` varchar(11) DEFAULT NULL,
  `donate_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blood_issue`
--

CREATE TABLE `blood_issue` (
  `id` int(11) NOT NULL,
  `date_of_issue` datetime DEFAULT NULL,
  `recieve_to` varchar(50) DEFAULT NULL,
  `blood_group` varchar(50) DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `doctor` varchar(200) DEFAULT NULL,
  `institution` varchar(100) DEFAULT NULL,
  `technician` varchar(50) DEFAULT NULL,
  `amount` float(10,2) DEFAULT NULL,
  `donor_name` varchar(50) DEFAULT NULL,
  `lot` varchar(20) DEFAULT NULL,
  `bag_no` varchar(20) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blood_issue`
--

INSERT INTO `blood_issue` (`id`, `date_of_issue`, `recieve_to`, `blood_group`, `gender`, `doctor`, `institution`, `technician`, `amount`, `donor_name`, `lot`, `bag_no`, `remark`, `created_at`, `updated_at`) VALUES
(1, '2019-08-25 14:20:00', 'Rasikh', 'O+', 'Male', 'Dr.Matin', 'Kabul University', '', 4500.00, '', '', '', 'NO Other Description is added here.\r\n', '2019-08-25 09:50:45', '2019-08-25 09:50:45');

-- --------------------------------------------------------

--
-- Table structure for table `charges`
--

CREATE TABLE `charges` (
  `id` int(11) NOT NULL,
  `charge_type` varchar(200) NOT NULL,
  `charge_category` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `code` varchar(100) NOT NULL,
  `standard_charge` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `charges`
--

INSERT INTO `charges` (`id`, `charge_type`, `charge_category`, `description`, `code`, `standard_charge`, `date`, `status`) VALUES
(1, 'Procedures', 'Category1', '1b2696f508406a719b03bc9b971cd887', '100', '40004', '0000-00-00', ''),
(2, 'Investigations', 'Category', '', '5465464', '67', '0000-00-00', '');

-- --------------------------------------------------------

--
-- Table structure for table `charge_categories`
--

CREATE TABLE `charge_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `charge_type` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `charge_categories`
--

INSERT INTO `charge_categories` (`id`, `name`, `description`, `charge_type`) VALUES
(2, 'Category', 'kjno description for this category', 'Investigations'),
(3, 'Category3', 'category number three', 'Supplier');

-- --------------------------------------------------------

--
-- Table structure for table `children_medical`
--

CREATE TABLE `children_medical` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `children_medical`
--

INSERT INTO `children_medical` (`id`, `name`) VALUES
(1, 'Medical One'),
(2, 'Medical Two');

-- --------------------------------------------------------

--
-- Table structure for table `complaint`
--

CREATE TABLE `complaint` (
  `id` int(11) NOT NULL,
  `complaint_type` varchar(100) NOT NULL,
  `source` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `email` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `description` text NOT NULL,
  `action_taken` varchar(200) NOT NULL,
  `assigned` varchar(50) NOT NULL,
  `note` text NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `complaint_type`
--

CREATE TABLE `complaint_type` (
  `id` int(11) NOT NULL,
  `complaint_type` varchar(100) NOT NULL,
  `description` mediumtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `consultant_register`
--

CREATE TABLE `consultant_register` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `date` varchar(100) DEFAULT NULL,
  `ins_date` varchar(50) DEFAULT NULL,
  `instruction` varchar(200) NOT NULL,
  `cons_doctor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `consultant_register`
--

INSERT INTO `consultant_register` (`id`, `patient_id`, `date`, `ins_date`, `instruction`, `cons_doctor`) VALUES
(14, 110, '2019-11-06 11:46:00', '2019-11-06', 'sfddsfsfsfs', 3),
(15, 0, '2019-11-06 12:13:00', '2019-11-06', 'sdfsfsfsfsfs', 1),
(16, 0, '2019-11-10 09:55:00', '2019-11-10', 'dfsfsfsfsdfsfs', 4),
(17, 109, '2019-11-10 10:07:00', '2019-11-10', 'sdfsfsfs', 3),
(18, 109, '2019-11-10 10:11:00', '2019-11-10', 'sdfsfs', 4),
(19, 113, '2019-11-10 12:37:00', '2019-11-10', 'dfgd', 4),
(20, 116, '2019-11-19 13:35:00', '2019-11-19', 'sdfskjflk', 3),
(21, 131, '2019-11-29 12:20:00', '2019-11-29', 'Need operation', 1),
(22, 132, '2019-11-30 14:43:00', '2019-11-30', 'sdfsdfsdf', 1),
(23, 134, '2019-12-01 16:20:00', '2019-12-01', 'sdasdasd', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

CREATE TABLE `contents` (
  `id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `is_public` varchar(10) DEFAULT 'No',
  `class_id` int(11) DEFAULT NULL,
  `cls_sec_id` int(10) NOT NULL,
  `file` varchar(250) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `note` text,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contents`
--

INSERT INTO `contents` (`id`, `title`, `type`, `is_public`, `class_id`, `cls_sec_id`, `file`, `created_by`, `note`, `is_active`, `created_at`, `updated_at`, `date`) VALUES
(1, 'Patient Weekly Report', 'Patient', 'No', NULL, 0, 'uploads/hospial_content/material/1.jpg', 0, 'sdfsfs', 'no', '2019-08-25 01:03:23', '0000-00-00 00:00:00', '2019-08-08'),
(2, 'Patient Monthly Report', 'Patient', 'No', NULL, 0, 'uploads/hospial_content/material/2.jpg', 0, '', 'no', '2019-08-25 01:03:54', '0000-00-00 00:00:00', '2019-08-15');

-- --------------------------------------------------------

--
-- Table structure for table `content_for`
--

CREATE TABLE `content_for` (
  `id` int(11) NOT NULL,
  `role` varchar(50) DEFAULT NULL,
  `content_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `department_name` varchar(200) NOT NULL,
  `is_active` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `department_name`, `is_active`) VALUES
(1, 'Internal Medicine', 'yes'),
(2, 'OB/GYN', 'yes'),
(3, 'Pediatric & Malnutrition', 'yes'),
(5, 'General Surgery Department', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `diagnosis`
--

CREATE TABLE `diagnosis` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `report_type` varchar(200) NOT NULL,
  `document` varchar(200) NOT NULL,
  `description` varchar(400) NOT NULL,
  `report_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `diagnosis`
--

INSERT INTO `diagnosis` (`id`, `patient_id`, `report_type`, `document`, `description`, `report_date`) VALUES
(1, 10, 'Daily Report', 'uploads/patient_images/1.jpg', 'sdfsfs', '2019-08-13'),
(2, 5, 'sdafsadfa', 'uploads/patient_images/2.pdf', 'no thereisuhfdis', '2019-08-01'),
(3, 13, 'sdfsafsa', '', 'sadfsafsaf', '2019-08-28'),
(4, 11, 'safdasf', '', '', '2019-08-29'),
(5, 12, 'New Report Type', '', '', '2019-09-21'),
(6, 24, 'sfdsf', '', '', '2019-08-29'),
(7, 39, 'sdfasf', 'uploads/patient_images/7.jpg', 'dfsdfsd', '2019-09-12'),
(8, 46, 'sdfasfdas', '', '', '2019-09-06'),
(9, 2, 'Caugh', '', 'no any desc.......', '2019-11-06');

-- --------------------------------------------------------

--
-- Table structure for table `diognostic`
--

CREATE TABLE `diognostic` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `father_name` varchar(100) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `cbc` varchar(100) DEFAULT NULL,
  `hb` varchar(100) DEFAULT NULL,
  `mp` varchar(100) DEFAULT NULL,
  `esr` varchar(100) DEFAULT NULL,
  `ct` varchar(100) DEFAULT NULL,
  `bt` varchar(100) DEFAULT NULL,
  `fbs` varchar(100) DEFAULT NULL,
  `rbs` varchar(100) DEFAULT NULL,
  `chlostrol` varchar(100) DEFAULT NULL,
  `triglycarid` varchar(100) DEFAULT NULL,
  `t_bilirobin` varchar(100) DEFAULT NULL,
  `in_billirobin` varchar(100) DEFAULT NULL,
  `db_biliroin` varchar(100) DEFAULT NULL,
  `sgpt` varchar(100) DEFAULT NULL,
  `suct` varchar(100) DEFAULT NULL,
  `alc` varchar(100) DEFAULT NULL,
  `uric_asid` varchar(100) DEFAULT NULL,
  `croubin` varchar(100) DEFAULT NULL,
  `blood_group` varchar(100) DEFAULT NULL,
  `rh_factor` varchar(100) DEFAULT NULL,
  `rf` varchar(100) DEFAULT NULL,
  `aso` varchar(100) DEFAULT NULL,
  `hbs` varchar(100) DEFAULT NULL,
  `hcv` varchar(100) DEFAULT NULL,
  `hiv` varchar(100) DEFAULT NULL,
  `hav` varchar(100) DEFAULT NULL,
  `rtb_test` varchar(100) DEFAULT NULL,
  `widal_test` varchar(100) DEFAULT NULL,
  `typhaid` varchar(100) DEFAULT NULL,
  `ig_g` varchar(100) DEFAULT NULL,
  `ig_m` varchar(100) DEFAULT NULL,
  `breceluose` varchar(100) DEFAULT NULL,
  `am` varchar(100) DEFAULT NULL,
  `torch_profiletest` varchar(100) DEFAULT NULL,
  `toxo_plusma` varchar(100) DEFAULT NULL,
  `robila` varchar(100) DEFAULT NULL,
  `urine_dr` varchar(100) DEFAULT NULL,
  `pfoin_dr` varchar(100) DEFAULT NULL,
  `pfoin_urea` varchar(100) DEFAULT NULL,
  `prognancy_test` varchar(100) DEFAULT NULL,
  `protin_urea` varchar(100) DEFAULT NULL,
  `glocose_urea` varchar(100) DEFAULT NULL,
  `stool_dr` varchar(100) DEFAULT NULL,
  `stool_ex` varchar(100) DEFAULT NULL,
  `stool_hpylari` varchar(100) DEFAULT NULL,
  `note` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `diognostic`
--

INSERT INTO `diognostic` (`id`, `name`, `father_name`, `birthday`, `cbc`, `hb`, `mp`, `esr`, `ct`, `bt`, `fbs`, `rbs`, `chlostrol`, `triglycarid`, `t_bilirobin`, `in_billirobin`, `db_biliroin`, `sgpt`, `suct`, `alc`, `uric_asid`, `croubin`, `blood_group`, `rh_factor`, `rf`, `aso`, `hbs`, `hcv`, `hiv`, `hav`, `rtb_test`, `widal_test`, `typhaid`, `ig_g`, `ig_m`, `breceluose`, `am`, `torch_profiletest`, `toxo_plusma`, `robila`, `urine_dr`, `pfoin_dr`, `pfoin_urea`, `prognancy_test`, `protin_urea`, `glocose_urea`, `stool_dr`, `stool_ex`, `stool_hpylari`, `note`, `created_at`) VALUES
(1, 'ali', 'baba', '2019-07-10', 'kjlkj', 'lkjlkj', 'kljlk', 'lkjkj', '\';kpo', 'gjhn,', 'gkjh', 'm,', 'n,m', 'n,mn', 'm,n', 'm,n', ',m', 'n,m', 'n,', 'mn', ',mn,', 'n,m', 'n', 'm,n', 'm,n', ',n,', 'mnm,j', 'h', 'kjh', 'kjh', 'kjh', 'kjh', 'kjh', 'kjh', 'kjh', 'kjh', 'kj', 'h', 'kjh', 'kjh', 'kjh', 'kjh', 'kj', 'hkj', 'h', 'kjh', 'jkh', 'jkh', 'jkh', 'jkh', '2019-08-17 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `dispatch_receive`
--

CREATE TABLE `dispatch_receive` (
  `id` int(11) NOT NULL,
  `reference_no` varchar(50) NOT NULL,
  `to_title` varchar(100) NOT NULL,
  `address` varchar(500) NOT NULL,
  `note` varchar(500) NOT NULL,
  `from_title` varchar(200) NOT NULL,
  `date` varchar(20) NOT NULL,
  `image` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `email_config`
--

CREATE TABLE `email_config` (
  `id` int(11) UNSIGNED NOT NULL,
  `email_type` varchar(100) DEFAULT NULL,
  `smtp_server` varchar(100) DEFAULT NULL,
  `smtp_port` varchar(100) DEFAULT NULL,
  `smtp_username` varchar(100) DEFAULT NULL,
  `smtp_password` varchar(100) DEFAULT NULL,
  `ssl_tls` varchar(100) DEFAULT NULL,
  `is_active` varchar(10) NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `email_config`
--

INSERT INTO `email_config` (`id`, `email_type`, `smtp_server`, `smtp_port`, `smtp_username`, `smtp_password`, `ssl_tls`, `is_active`, `created_at`) VALUES
(2, 'sendmail', '', '', '', '', '', 'yes', '2019-01-24 12:36:18');

-- --------------------------------------------------------

--
-- Table structure for table `enquiry`
--

CREATE TABLE `enquiry` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `address` mediumtext NOT NULL,
  `reference` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `description` varchar(500) NOT NULL,
  `follow_up_date` date NOT NULL,
  `note` mediumtext NOT NULL,
  `source` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `assigned` varchar(100) NOT NULL,
  `class` int(11) NOT NULL,
  `no_of_child` varchar(11) DEFAULT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `enquiry_type`
--

CREATE TABLE `enquiry_type` (
  `id` int(11) NOT NULL,
  `enquiry_type` varchar(100) NOT NULL,
  `description` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `event_title` varchar(200) NOT NULL,
  `event_description` varchar(300) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `event_type` varchar(100) NOT NULL,
  `event_color` varchar(200) NOT NULL,
  `event_for` varchar(100) NOT NULL,
  `is_active` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event_title`, `event_description`, `start_date`, `end_date`, `event_type`, `event_color`, `event_for`, `is_active`) VALUES
(1, 'Meeting', '', '2019-08-25 00:00:00', '2019-08-25 00:00:00', 'task', '#000', '0', 'no'),
(2, 'ومی خصوصی همه Super Admin محافظت شده', 'عمومی خصوصی همه Super Admin محافظت شده', '2019-12-24 07:30:00', '2019-12-24 07:30:00', 'private', '#337ab7', '0', ''),
(3, 'kljsfdlkj', 'lkjlksdfjlk', '2020-01-21 06:00:00', '2020-01-21 06:00:00', 'private', '#337ab7', '0', ''),
(4, 'sldkfjsdlk f', 'lkj lkj f', '2020-01-22 07:30:00', '2020-01-22 07:30:00', 'private', '#337ab7', '0', '');

-- --------------------------------------------------------

--
-- Table structure for table `examination`
--

CREATE TABLE `examination` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `ultra_sound` varchar(80) DEFAULT NULL,
  `dressing` varchar(80) DEFAULT NULL,
  `ecg` varchar(80) DEFAULT NULL,
  `lab` varchar(80) DEFAULT NULL,
  `x_ray` varchar(80) DEFAULT NULL,
  `price` int(11) DEFAULT '0',
  `description` varchar(80) CHARACTER SET utf8 DEFAULT NULL,
  `person` varchar(80) CHARACTER SET utf8 DEFAULT NULL,
  `person_fname` varchar(80) CHARACTER SET utf8 DEFAULT NULL,
  `reciever` varchar(80) CHARACTER SET utf8 DEFAULT NULL,
  `date` date DEFAULT NULL,
  `examination_type` varchar(150) DEFAULT 'lab',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `examination`
--

INSERT INTO `examination` (`id`, `patient_id`, `ultra_sound`, `dressing`, `ecg`, `lab`, `x_ray`, `price`, `description`, `person`, `person_fname`, `reciever`, `date`, `examination_type`, `created_at`) VALUES
(1, 8, 'yes', 'yes', '', '', '', 200, 'لابراتوار', 'حسن', 'غلام رضا', 'شکیب', '2019-08-19', 'lab', '2019-08-18 16:31:34'),
(2, 7, 'yes', 'yse', 'yes', 'no', 'no', 100, 'لابراتوار', 'شکیب', 'غلام سخی', 'حسن', '2019-08-18', 'lab', '2019-08-19 04:14:37'),
(3, 8, 'lkj', 'kljlj', 'lkjl', 'ljl', 'lkj', 100, 'چک عمومی', 'حسن', 'غلام رضا', 'شکیب', '2019-08-21', 'ecg', '2019-08-21 02:17:51'),
(4, 11, 'sdfas', 'sadfas', 'sadfas', 'sadfas', 'asdfas', 332, 'sdfsa', 'sdfas', 'sadfasf', 'sadfas', '2019-08-08', 'asdfas', '2019-08-25 06:19:29'),
(5, 12, '', '', '', '', '', 0, '', '', '', '', '0000-00-00', '', '2019-08-25 14:53:08'),
(6, 12, 'Yes-Ultrasound Examination', 'sdfs', 'sdfs', 'sfsdf', 'sdfs', 454, 'fsdfa', 'asdfas', 'asdf', 'ssfsdsd', '2019-12-31', 'sdfds', '2019-08-25 15:10:05'),
(7, 12, 'Yes-Ultrasound Examination', 'Yes-Small Dressing', 'Yes-ECG Test', '', '', 0, '', '', '', '', '0000-00-00', '', '2019-08-25 15:16:39'),
(8, 7, 'Yes-Ultrasound Examination', 'Yes-Small Dressing', 'Yes-ECG Test', NULL, 'Middle X-Ray Test', 23, 'sfdsdf', 'sdfs', 'sdfds', 'sdfds', '2019-08-09', NULL, '2019-08-25 16:32:48'),
(9, 12, 'Yes-Ultrasound Examination', 'Select', 'Select', NULL, 'Select', 0, '', '', '', NULL, NULL, NULL, '2019-08-26 10:35:23'),
(10, 13, 'Yes-Ultrasound Examination', 'Yes-Small Dressing', 'Yes-ECG Test', NULL, 'Small X-Ray Test', 0, 'asdf', 'sadf', '344', NULL, NULL, NULL, '2019-08-26 10:43:04'),
(11, 13, 'Yes-Ultrasound Examination', 'Yes-Small Dressing', 'Yes-ECG Test', NULL, 'Small X-Ray Test', 0, 'asdf', 'sadf', '344', NULL, NULL, NULL, '2019-08-26 10:46:19'),
(12, 13, 'Yes-Ultrasound Examination', 'Yes-Small Dressing', 'Yes-ECG Test', NULL, 'Small X-Ray Test', 0, 'asdf', 'sadf', '344', NULL, NULL, NULL, '2019-08-26 10:46:55'),
(13, 9, 'Yes-Ultrasound Examination', 'Yes-Small Dressing', 'Yes-ECG Test', NULL, 'Small X-Ray Test', 0, '', '', '', NULL, NULL, NULL, '2019-08-26 10:50:14'),
(14, 9, 'Yes-Ultrasound Examination', 'Yes-Small Dressing', 'Yes-ECG Test', NULL, 'Small X-Ray Test', 0, '', '', '', NULL, NULL, NULL, '2019-08-26 10:51:36'),
(15, 9, 'Yes-Ultrasound Examination', 'Yes-Small Dressing', 'Yes-ECG Test', NULL, 'Small X-Ray Test', 0, '', '', '', NULL, NULL, NULL, '2019-08-26 10:52:45'),
(16, 13, 'Yes-Ultrasound Examination', 'Yes-Small Dressing', 'Yes-ECG Test', NULL, 'Select', 0, '', '', '', NULL, NULL, NULL, '2019-08-26 10:55:36'),
(17, 12, 'Yes-Ultrasound Examination', 'Yes-Middle Dressing', 'Yes-ECG Test', NULL, 'Select', 0, 'sadf', 'asdf', '3223', NULL, NULL, NULL, '2019-08-26 10:56:04'),
(18, 7, 'Yes-Ultrasound Examination', 'Select', 'Select', NULL, 'Select', 0, '', '', '', NULL, NULL, NULL, '2019-08-26 10:56:36'),
(19, 10, 'Yes-Ultrasound Examination', 'Yes-Small Dressing', 'Yes-ECG Test', NULL, 'Small X-Ray Test', 0, '', '', '', NULL, NULL, NULL, '2019-08-26 10:59:54'),
(20, 10, 'Yes-Ultrasound Examination', 'Yes-Small Dressing', 'Yes-ECG Test', NULL, 'Small X-Ray Test', 0, '', '', '', NULL, NULL, NULL, '2019-08-26 11:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `exp_head_id` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `invoice_no` varchar(200) NOT NULL,
  `date` date DEFAULT NULL,
  `amount` float(10,2) DEFAULT NULL,
  `documents` varchar(255) DEFAULT NULL,
  `note` text,
  `is_active` varchar(255) DEFAULT 'yes',
  `is_deleted` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `exp_head_id`, `name`, `invoice_no`, `date`, `amount`, `documents`, `note`, `is_active`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 2, 'Transportation Expense', '001', '2019-08-25', 5400.00, 'uploads/hospital_expense/1.jpg', 'NO extra information is added here. please feel free to let us about other docuements. ', 'yes', 'no', '2019-08-25 09:51:44', '0000-00-00 00:00:00'),
(2, 1, 'New Income in Augest', '021', '2019-09-01', 45000.00, NULL, 'fdsafas\r\n', 'yes', 'no', '2019-09-01 04:07:53', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `expense_head`
--

CREATE TABLE `expense_head` (
  `id` int(11) NOT NULL,
  `exp_category` varchar(50) DEFAULT NULL,
  `description` text,
  `is_active` varchar(255) DEFAULT 'yes',
  `is_deleted` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `expense_head`
--

INSERT INTO `expense_head` (`id`, `exp_category`, `description`, `is_active`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'Rasikh', 'No other description is added here.', 'yes', 'no', '2019-08-24 13:41:16', '0000-00-00 00:00:00'),
(2, 'Akbari', 'No other description is added here.', 'yes', 'no', '2019-08-24 13:41:31', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `floor`
--

CREATE TABLE `floor` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `floor`
--

INSERT INTO `floor` (`id`, `name`, `description`) VALUES
(1, 'First Floor', 'No Description is Added Here.\r\n'),
(2, 'Second Floor', 'No Description is added here.\r\n'),
(3, 'Third Floor', 'NO Other Description is added here.');

-- --------------------------------------------------------

--
-- Table structure for table `follow_up`
--

CREATE TABLE `follow_up` (
  `id` int(11) NOT NULL,
  `enquiry_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `next_date` date NOT NULL,
  `response` text NOT NULL,
  `note` text NOT NULL,
  `followup_by` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `front_cms_media_gallery`
--

CREATE TABLE `front_cms_media_gallery` (
  `id` int(11) NOT NULL,
  `image` varchar(300) DEFAULT NULL,
  `thumb_path` varchar(300) DEFAULT NULL,
  `dir_path` varchar(300) DEFAULT NULL,
  `img_name` varchar(300) DEFAULT NULL,
  `thumb_name` varchar(300) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `file_type` varchar(100) NOT NULL,
  `file_size` varchar(100) NOT NULL,
  `vid_url` mediumtext NOT NULL,
  `vid_title` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `front_cms_menus`
--

CREATE TABLE `front_cms_menus` (
  `id` int(11) NOT NULL,
  `menu` varchar(100) DEFAULT NULL,
  `slug` varchar(200) DEFAULT NULL,
  `description` mediumtext,
  `open_new_tab` int(10) NOT NULL DEFAULT '0',
  `ext_url` mediumtext NOT NULL,
  `ext_url_link` mediumtext NOT NULL,
  `publish` int(11) NOT NULL DEFAULT '0',
  `content_type` varchar(10) NOT NULL DEFAULT 'manual',
  `is_active` varchar(10) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `front_cms_menus`
--

INSERT INTO `front_cms_menus` (`id`, `menu`, `slug`, `description`, `open_new_tab`, `ext_url`, `ext_url_link`, `publish`, `content_type`, `is_active`, `created_at`) VALUES
(1, 'Main Menu', 'main-menu', 'Main menu', 0, '', '', 0, 'default', 'no', '2018-04-20 14:54:49'),
(2, 'Bottom Menu', 'bottom-menu', 'Bottom Menu', 0, '', '', 0, 'default', 'no', '2018-04-20 14:54:55');

-- --------------------------------------------------------

--
-- Table structure for table `front_cms_menu_items`
--

CREATE TABLE `front_cms_menu_items` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `menu` varchar(100) DEFAULT NULL,
  `page_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `ext_url` mediumtext,
  `open_new_tab` int(11) DEFAULT '0',
  `ext_url_link` mediumtext,
  `slug` varchar(200) DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `publish` int(11) NOT NULL DEFAULT '0',
  `description` mediumtext,
  `is_active` varchar(10) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `front_cms_menu_items`
--

INSERT INTO `front_cms_menu_items` (`id`, `menu_id`, `menu`, `page_id`, `parent_id`, `ext_url`, `open_new_tab`, `ext_url_link`, `slug`, `weight`, `publish`, `description`, `is_active`, `created_at`) VALUES
(16, 2, 'Home', 1, 0, NULL, NULL, NULL, 'home-1', NULL, 0, NULL, 'no', '2018-07-14 14:14:12'),
(23, 1, 'Appointment', 0, 0, '1', NULL, 'http://yourdomain/form/appointment', 'appointment', 2, 0, NULL, 'no', '2019-01-24 14:18:07'),
(26, 1, 'Home', 1, 0, NULL, NULL, NULL, 'home', NULL, 0, NULL, 'no', '2019-01-24 14:18:17'),
(27, 2, 'Appointment', 0, 0, '1', NULL, 'http://yourdomain/form/appointment', 'appointment-1', NULL, 0, NULL, 'no', '2019-01-24 21:50:11');

-- --------------------------------------------------------

--
-- Table structure for table `front_cms_pages`
--

CREATE TABLE `front_cms_pages` (
  `id` int(11) NOT NULL,
  `page_type` varchar(10) NOT NULL DEFAULT 'manual',
  `is_homepage` int(1) DEFAULT '0',
  `title` varchar(250) DEFAULT NULL,
  `url` varchar(250) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `slug` varchar(200) DEFAULT NULL,
  `meta_title` mediumtext,
  `meta_description` mediumtext,
  `meta_keyword` mediumtext,
  `feature_image` varchar(200) NOT NULL,
  `description` longtext,
  `publish_date` date NOT NULL,
  `publish` int(10) DEFAULT '0',
  `sidebar` int(10) DEFAULT '0',
  `is_active` varchar(10) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `front_cms_pages`
--

INSERT INTO `front_cms_pages` (`id`, `page_type`, `is_homepage`, `title`, `url`, `type`, `slug`, `meta_title`, `meta_description`, `meta_keyword`, `feature_image`, `description`, `publish_date`, `publish`, `sidebar`, `is_active`, `created_at`) VALUES
(1, 'default', 1, 'Home', 'page/home', 'page', 'home', '', '', '', '', '<p>Home page</p>', '0000-00-00', 1, 1, 'no', '2019-01-24 14:03:59'),
(2, 'default', 0, 'Complain', 'page/complain', 'page', 'complain', 'Complain form', '                                                                                                                                                                                    complain form                                                                                                                                                                                                                                ', 'complain form', '', '<div class=\"col-md-12 col-sm-12\">\r\n<h2 class=\"text-center\">&nbsp;</h2>\r\n\r\n<p class=\"text-center\">[form-builder:complain]</p>\r\n</div>', '0000-00-00', 1, 1, 'no', '2019-01-24 14:00:12'),
(54, 'default', 0, '404 page', 'page/404-page', 'page', '404-page', '', '                                ', '', '', '<html>\r\n<head>\r\n <title></title>\r\n</head>\r\n<body>\r\n<p>404 page found</p>\r\n</body>\r\n</html>', '0000-00-00', 0, NULL, 'no', '2018-05-18 14:46:04'),
(76, 'default', 0, 'Contact us', 'page/contact-us', 'page', 'contact-us', '', '', '', '', '<p>[form-builder:contact_us]</p>', '0000-00-00', 0, NULL, 'no', '2019-01-24 14:01:58');

-- --------------------------------------------------------

--
-- Table structure for table `front_cms_page_contents`
--

CREATE TABLE `front_cms_page_contents` (
  `id` int(11) NOT NULL,
  `page_id` int(11) DEFAULT NULL,
  `content_type` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `front_cms_programs`
--

CREATE TABLE `front_cms_programs` (
  `id` int(11) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `url` mediumtext,
  `title` varchar(200) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `event_start` date DEFAULT NULL,
  `event_end` date DEFAULT NULL,
  `event_venue` mediumtext,
  `description` mediumtext,
  `is_active` varchar(10) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `meta_title` mediumtext NOT NULL,
  `meta_description` mediumtext NOT NULL,
  `meta_keyword` mediumtext NOT NULL,
  `feature_image` mediumtext NOT NULL,
  `publish_date` date NOT NULL,
  `publish` varchar(10) DEFAULT '0',
  `sidebar` int(10) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `front_cms_program_photos`
--

CREATE TABLE `front_cms_program_photos` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `media_gallery_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `front_cms_settings`
--

CREATE TABLE `front_cms_settings` (
  `id` int(11) NOT NULL,
  `theme` varchar(50) DEFAULT NULL,
  `is_active_rtl` int(10) DEFAULT '0',
  `is_active_front_cms` int(11) DEFAULT '0',
  `is_active_sidebar` int(1) DEFAULT '0',
  `logo` varchar(200) DEFAULT NULL,
  `contact_us_email` varchar(100) DEFAULT NULL,
  `complain_form_email` varchar(100) DEFAULT NULL,
  `sidebar_options` mediumtext NOT NULL,
  `fb_url` varchar(200) NOT NULL,
  `twitter_url` varchar(200) NOT NULL,
  `youtube_url` varchar(200) NOT NULL,
  `google_plus` varchar(200) NOT NULL,
  `instagram_url` varchar(200) NOT NULL,
  `pinterest_url` varchar(200) NOT NULL,
  `linkedin_url` varchar(200) NOT NULL,
  `google_analytics` mediumtext,
  `footer_text` varchar(500) DEFAULT NULL,
  `fav_icon` varchar(250) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `front_cms_settings`
--

INSERT INTO `front_cms_settings` (`id`, `theme`, `is_active_rtl`, `is_active_front_cms`, `is_active_sidebar`, `logo`, `contact_us_email`, `complain_form_email`, `sidebar_options`, `fb_url`, `twitter_url`, `youtube_url`, `google_plus`, `instagram_url`, `pinterest_url`, `linkedin_url`, `google_analytics`, `footer_text`, `fav_icon`, `created_at`) VALUES
(1, 'darkgray', NULL, NULL, NULL, './uploads/hospital_content/logo/front_logo-5c43633b45eef9.94907504.png', '', '', '[\"news\",\"complain\"]', 'https://www.facebook.com/login', 'https://twitter.com/login?lang=en', 'https://www.youtube.com/account', 'https://plus.google.com/people', 'https://www.instagram.com/accounts/login/', 'https://in.pinterest.com/login/', 'https://www.linkedin.com/uas/login?_l=en', '', '© Shuhada Hospital 2019 All rights reserved', './uploads/hospital_content/logo/front_fav_icon-5c43633b4b6077.22626327.png', '2019-09-01 08:49:15');

-- --------------------------------------------------------

--
-- Table structure for table `general_calls`
--

CREATE TABLE `general_calls` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `contact` varchar(12) NOT NULL,
  `date` date NOT NULL,
  `description` varchar(500) NOT NULL,
  `follow_up_date` date NOT NULL,
  `call_dureation` varchar(50) NOT NULL,
  `note` mediumtext NOT NULL,
  `call_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `giving_births`
--

CREATE TABLE `giving_births` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `giving_births`
--

INSERT INTO `giving_births` (`id`, `name`) VALUES
(1, 'Operation One'),
(2, 'Operation Two');

-- --------------------------------------------------------

--
-- Table structure for table `income`
--

CREATE TABLE `income` (
  `id` int(11) NOT NULL,
  `inc_head_id` varchar(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `invoice_no` varchar(200) NOT NULL,
  `date` date DEFAULT NULL,
  `amount` float(10,2) DEFAULT NULL,
  `note` text,
  `project_line` varchar(164) DEFAULT NULL,
  `dr` varchar(164) DEFAULT NULL,
  `cr` varchar(164) DEFAULT NULL,
  `section` varchar(164) DEFAULT NULL,
  `donor` varchar(164) DEFAULT NULL,
  `area` varchar(164) DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'yes',
  `is_deleted` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `documents` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `income_head`
--

CREATE TABLE `income_head` (
  `id` int(255) NOT NULL,
  `income_category` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `is_active` varchar(255) NOT NULL DEFAULT 'yes',
  `is_deleted` varchar(255) NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `income_head`
--

INSERT INTO `income_head` (`id`, `income_category`, `description`, `is_active`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'Rasikh', 'This man acts as an income head. ', 'yes', 'no', '2019-08-24 13:42:05', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `ipd_billing`
--

CREATE TABLE `ipd_billing` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `other_charge` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `tax` int(11) NOT NULL,
  `gross_total` varchar(100) NOT NULL,
  `net_amount` float(10,2) NOT NULL,
  `total_amount` int(11) NOT NULL,
  `generated_by` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `round` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ipd_details`
--

CREATE TABLE `ipd_details` (
  `id` int(11) NOT NULL,
  `patient_name` varchar(100) DEFAULT NULL,
  `patient_fname` varchar(100) DEFAULT NULL,
  `age` varchar(20) DEFAULT NULL,
  `month` int(11) DEFAULT NULL,
  `day` int(11) DEFAULT NULL,
  `entry_date` date DEFAULT NULL,
  `type_disease` varchar(200) DEFAULT NULL,
  `recognition` text,
  `diagnostic` text,
  `patient_id` int(11) DEFAULT NULL,
  `height` varchar(5) DEFAULT NULL,
  `weight` varchar(5) DEFAULT NULL,
  `bp` varchar(20) DEFAULT NULL,
  `ipd_no` varchar(200) DEFAULT NULL,
  `room` varchar(100) DEFAULT NULL,
  `bed` varchar(100) DEFAULT NULL,
  `bed_group_id` varchar(10) DEFAULT NULL,
  `case_type` varchar(100) DEFAULT NULL,
  `casualty` varchar(100) DEFAULT NULL,
  `symptoms` varchar(200) DEFAULT NULL,
  `known_allergies` varchar(200) DEFAULT NULL,
  `refference` varchar(200) DEFAULT NULL,
  `cons_doctor` int(11) DEFAULT NULL,
  `amount` varchar(100) DEFAULT NULL,
  `tax` varchar(100) DEFAULT NULL,
  `payment_mode` varchar(100) DEFAULT NULL,
  `add_desc` varchar(164) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `is_entered` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `item_category_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `item_photo` varchar(225) DEFAULT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `item_store_id` int(11) DEFAULT NULL,
  `item_supplier_id` int(11) DEFAULT NULL,
  `quantity` int(100) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `item_category`
--

CREATE TABLE `item_category` (
  `id` int(255) NOT NULL,
  `item_category` varchar(255) NOT NULL,
  `is_active` varchar(255) NOT NULL DEFAULT 'yes',
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `item_category`
--

INSERT INTO `item_category` (`id`, `item_category`, `is_active`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Furnitures', 'yes', 'Chairs, Tables, Desks\r\n', '2019-08-15 04:24:13', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `item_issue`
--

CREATE TABLE `item_issue` (
  `id` int(11) NOT NULL,
  `issue_type` varchar(15) DEFAULT NULL,
  `issue_to` varchar(100) DEFAULT NULL,
  `issue_by` varchar(100) DEFAULT NULL,
  `issue_date` date DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `item_category_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `quantity` int(10) NOT NULL,
  `note` text NOT NULL,
  `is_returned` int(2) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_active` varchar(10) DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `item_stock`
--

CREATE TABLE `item_stock` (
  `id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `symbol` varchar(10) NOT NULL DEFAULT '+',
  `store_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `attachment` varchar(250) DEFAULT NULL,
  `description` text NOT NULL,
  `is_active` varchar(10) DEFAULT 'yes',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `item_store`
--

CREATE TABLE `item_store` (
  `id` int(255) NOT NULL,
  `item_store` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `item_supplier`
--

CREATE TABLE `item_supplier` (
  `id` int(255) NOT NULL,
  `item_supplier` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact_person_name` varchar(255) NOT NULL,
  `contact_person_phone` varchar(255) NOT NULL,
  `contact_person_email` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `lab`
--

CREATE TABLE `lab` (
  `id` int(11) NOT NULL,
  `lab_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lab`
--

INSERT INTO `lab` (`id`, `lab_name`) VALUES
(1, 'medical'),
(2, 'blood');

-- --------------------------------------------------------

--
-- Table structure for table `lab_config`
--

CREATE TABLE `lab_config` (
  `id` int(11) NOT NULL,
  `test_name` varchar(150) DEFAULT NULL,
  `result` mediumtext,
  `normal` varchar(100) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `unit` varchar(64) DEFAULT NULL,
  `appearance` varchar(64) DEFAULT NULL,
  `test_type` varchar(64) DEFAULT NULL,
  `test_section` varchar(256) DEFAULT NULL,
  `description` mediumtext,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `lab_config`
--

INSERT INTO `lab_config` (`id`, `test_name`, `result`, `normal`, `price`, `unit`, `appearance`, `test_type`, `test_section`, `description`, `created_at`, `updated_at`) VALUES
(6, 'پولارس', NULL, ' ', 800, '', '', 'Laboratory', 'Hematology', 'تن منستیب مسنت منت ', NULL, NULL),
(14, 'شیفو', NULL, '', 400, '', '', 'Laboratory', 'Hematology', 'sadfkjhklj', '2020-02-17', NULL),
(15, 'دیزاین', NULL, '', 500, '', '', 'Laboratory', 'Serology', 'سمن منستیب سمینبت منت ', '2020-02-17', NULL),
(16, 'پورسلین', NULL, NULL, 300, NULL, NULL, NULL, 'Hematology', 'kjhkjhkj\r\n', '2020-02-17', NULL),
(17, 'میتال', NULL, '', 200, '', '', 'laboratory', 'انتخاب', 'منت بمنسیت منت بمنسیت بمسنیتب سمنیبت سمنیتب ', '2020-02-17', NULL),
(18, 'سی سی پلیت ', NULL, NULL, 1500, NULL, NULL, 'laboratory', NULL, 'سیبس ', '2020-02-17', NULL),
(19, 'فول سیت', 'lksdjf ', 'kl', 2000, '8', '8', '8', '8', 'Full Set\r\n', '2020-02-17', NULL),
(20, 'زرقونیم', 'یسب', 'سیب', 5000, '3', '3', '34', '43', 'زرقونیم مبلغ پنج هزار افغانی', '2020-02-17', NULL),
(21, 'نیم سیت', 'یسبسبیسبس', 'سیبسی', 1000, '43', '343', '43', '43', 'نیم سیت مبلغ یک هزار افغانی', '2020-02-17', NULL),
(22, 'گولد', 'یسبسیبسبسبسبس', 'سیبسبس', 200, '23', '232', '23', '233', 'گولد مبلغ دو صد افغانی ', '2020-02-17', NULL),
(23, 'کیدکیم', 'بسیبیسبس', 'بسیبسب', 6000, '43', '343', '343', '234', 'کیدکیم مبلغ شش هزار افغانی', '2020-02-17', NULL),
(24, 'رتینر', 'سبسیبسی', 'سبیسیبیس', 500, '23', '3423', 'بسبس', 'سبیس', 'ریتینر مبلغ پنجصد افغانی', '2020-02-17', NULL),
(25, 'نایت گارد', 'sfsfs', 'sdfsfds', 500, '3232', '232', '232sfdfdsd', 'sdfsd', 'نایت گارد مبلغ 500 افغانی', '2020-02-17', NULL),
(26, 'پارسیل', 'fsfsfsf', 'sdfsf', 100, 'sfsfs', 'dsffdsfs', 'fsfsdfs', 'fsfs', '0-----00', '2020-12-14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lab_ecg`
--

CREATE TABLE `lab_ecg` (
  `id` int(11) NOT NULL,
  `patient_name` varchar(100) DEFAULT NULL,
  `patient_fname` varchar(100) DEFAULT NULL,
  `patient_id` int(11) DEFAULT '0',
  `unique_id` int(11) DEFAULT '0',
  `date` date DEFAULT NULL,
  `age` varchar(50) DEFAULT NULL,
  `address` text,
  `gender` varchar(10) DEFAULT 'male',
  `fees` int(11) DEFAULT NULL,
  `discount` int(11) NOT NULL,
  `operation_type` varchar(164) DEFAULT NULL,
  `test_name` varchar(164) DEFAULT NULL,
  `result_desc` text,
  `consultant_doctor` varchar(164) DEFAULT NULL,
  `refer_of` varchar(164) DEFAULT NULL,
  `updated` int(11) DEFAULT '0',
  `updated_at` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `round` int(11) NOT NULL,
  `lab_round` int(11) NOT NULL DEFAULT '0',
  `lab_time` int(11) NOT NULL,
  `exam_type` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `add_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lab_lab`
--

CREATE TABLE `lab_lab` (
  `id` int(11) NOT NULL,
  `patient_name` varchar(200) DEFAULT NULL,
  `patient_fname` varchar(200) DEFAULT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `unique_id` int(11) DEFAULT NULL,
  `age` varchar(100) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `address` mediumtext,
  `date` date DEFAULT NULL,
  `year` int(11) NOT NULL,
  `month` varchar(100) DEFAULT NULL,
  `day` int(11) NOT NULL,
  `operation_type` varchar(200) DEFAULT NULL,
  `test_name` varchar(164) DEFAULT NULL,
  `fees` int(11) DEFAULT NULL,
  `discount` int(11) NOT NULL,
  `result` mediumtext,
  `consultant_doctor` varchar(164) DEFAULT NULL,
  `refer_of` varchar(164) DEFAULT NULL,
  `duplicate` varchar(16) DEFAULT NULL,
  `result_desc` mediumtext,
  `created_at` datetime DEFAULT NULL,
  `updated_at` varchar(100) DEFAULT NULL,
  `updated` int(11) DEFAULT '0',
  `lab_id` int(11) NOT NULL,
  `round` int(11) DEFAULT '1',
  `lab_time` int(11) NOT NULL,
  `lab_round` int(11) NOT NULL DEFAULT '0',
  `add_description` mediumtext NOT NULL,
  `la` int(11) DEFAULT '0',
  `lb` int(11) DEFAULT '0',
  `lc` int(11) DEFAULT '0',
  `ld` int(11) DEFAULT '0',
  `le` int(11) DEFAULT '0',
  `lf` int(11) DEFAULT '0',
  `lg` int(11) DEFAULT '0',
  `lh` int(11) DEFAULT '0',
  `ra` int(11) DEFAULT '0',
  `rb` int(11) DEFAULT '0',
  `rc` int(11) DEFAULT '0',
  `rd` int(11) DEFAULT '0',
  `re` int(11) DEFAULT '0',
  `rf` int(11) DEFAULT '0',
  `rg` int(11) DEFAULT '0',
  `rh` int(11) DEFAULT '0',
  `rda` int(11) DEFAULT NULL,
  `rdb` int(11) DEFAULT NULL,
  `rdc` int(11) DEFAULT NULL,
  `rdd` int(11) DEFAULT NULL,
  `rde` int(11) DEFAULT NULL,
  `rdf` int(11) DEFAULT NULL,
  `rdg` int(11) DEFAULT NULL,
  `rdh` int(11) DEFAULT NULL,
  `lda` int(11) DEFAULT NULL,
  `ldb` int(11) DEFAULT NULL,
  `ldc` int(11) DEFAULT NULL,
  `ldd` int(11) DEFAULT NULL,
  `lde` int(11) DEFAULT NULL,
  `ldf` int(11) DEFAULT NULL,
  `ldg` int(11) DEFAULT NULL,
  `ldh` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `lab_lab`
--

INSERT INTO `lab_lab` (`id`, `patient_name`, `patient_fname`, `patient_id`, `unique_id`, `age`, `gender`, `address`, `date`, `year`, `month`, `day`, `operation_type`, `test_name`, `fees`, `discount`, `result`, `consultant_doctor`, `refer_of`, `duplicate`, `result_desc`, `created_at`, `updated_at`, `updated`, `lab_id`, `round`, `lab_time`, `lab_round`, `add_description`, `la`, `lb`, `lc`, `ld`, `le`, `lf`, `lg`, `lh`, `ra`, `rb`, `rc`, `rd`, `re`, `rf`, `rg`, `rh`, `rda`, `rdb`, `rdc`, `rdd`, `rde`, `rdf`, `rdg`, `rdh`, `lda`, `ldb`, `ldc`, `ldd`, `lde`, `ldf`, `ldg`, `ldh`) VALUES
(500, 'محمدمهدی', 'کاظمی', 51, 1002, '20', 'مذکر', NULL, '2020-12-15', 1399, 'ثور', 1, NULL, 'دیزاین', 500, 0, NULL, NULL, NULL, '1', NULL, '2020-12-15 04:12:40', NULL, 0, 0, 2, 1608048760, 5, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL),
(501, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-12-15', 1399, 'ثور', 1, NULL, 'پورسلین', 300, 0, NULL, NULL, NULL, '01', NULL, '2020-12-15 05:49:31', NULL, 0, 0, NULL, 1608054571, 1, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(502, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-12-15', 1399, 'ثور', 1, NULL, 'سی سی پلیت ', 1500, 0, NULL, NULL, NULL, '01', NULL, '2020-12-15 05:49:54', NULL, 0, 0, NULL, 1608054594, 1, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lab_ultra_sound`
--

CREATE TABLE `lab_ultra_sound` (
  `id` int(11) NOT NULL,
  `patient_name` varchar(150) DEFAULT NULL,
  `patient_fname` varchar(150) DEFAULT NULL,
  `address` text,
  `patient_id` int(11) DEFAULT NULL,
  `unique_id` int(11) DEFAULT '0',
  `date` date DEFAULT NULL,
  `gender` varchar(10) DEFAULT 'male',
  `age` varchar(50) DEFAULT NULL,
  `operation_type` varchar(100) DEFAULT NULL,
  `test_name` varchar(164) DEFAULT NULL,
  `fees` int(11) DEFAULT NULL,
  `discount` int(11) NOT NULL,
  `result` varchar(500) DEFAULT NULL,
  `result_desc` text,
  `duplicate` varchar(16) DEFAULT 'NO',
  `consultant_doctor` varchar(164) DEFAULT NULL,
  `refer_of` varchar(164) DEFAULT NULL,
  `updated` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` varchar(100) DEFAULT NULL,
  `sound_id` int(11) NOT NULL,
  `round` int(11) NOT NULL,
  `lab_round` int(11) NOT NULL DEFAULT '0',
  `lab_time` int(11) NOT NULL,
  `exam_type` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `add_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lab_xray`
--

CREATE TABLE `lab_xray` (
  `id` int(11) NOT NULL,
  `patient_name` varchar(100) DEFAULT NULL,
  `patient_fname` varchar(100) DEFAULT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `unique_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `age` varchar(8) DEFAULT NULL,
  `address` text,
  `operation_type` varchar(100) DEFAULT NULL,
  `test_name` varchar(164) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `fees` int(11) DEFAULT NULL,
  `discount` int(11) NOT NULL,
  `result` varchar(100) DEFAULT NULL,
  `result_desc` text,
  `x_ray_desc` varchar(164) DEFAULT NULL,
  `x_ray_size` double DEFAULT NULL,
  `loss` varchar(164) DEFAULT NULL,
  `consultant_doctor` varchar(255) DEFAULT NULL,
  `refer_of` varchar(164) DEFAULT NULL,
  `updated` int(11) DEFAULT '0',
  `duplicate` varchar(12) DEFAULT 'NO',
  `updated_at` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `round` int(11) NOT NULL,
  `lab_round` int(11) NOT NULL DEFAULT '0',
  `lab_time` int(11) NOT NULL,
  `exam_type` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `add_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(11) NOT NULL,
  `language` varchar(50) DEFAULT NULL,
  `short_code` varchar(100) NOT NULL,
  `is_deleted` varchar(10) NOT NULL DEFAULT 'yes',
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `language`, `short_code`, `is_deleted`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Azerbaijan', '', 'no', 'no', '2017-04-06 05:08:33', '0000-00-00 00:00:00'),
(2, 'Albanian', '', 'no', 'no', '2017-04-06 05:08:33', '0000-00-00 00:00:00'),
(4, 'English', 'en', 'no', 'no', '2018-12-01 10:08:15', '0000-00-00 00:00:00'),
(5, 'Arabic', '', 'no', 'no', '2017-04-06 05:08:33', '0000-00-00 00:00:00'),
(7, 'Afrikaans', '', 'no', 'no', '2017-04-06 05:08:33', '0000-00-00 00:00:00'),
(8, 'Basque', '', 'no', 'no', '2017-04-06 05:08:33', '0000-00-00 00:00:00'),
(11, 'Bengali', '', 'no', 'no', '2017-04-06 05:08:33', '0000-00-00 00:00:00'),
(13, 'Bosnian', '', 'no', 'no', '2017-04-06 05:08:33', '0000-00-00 00:00:00'),
(14, 'Welsh', '', 'no', 'no', '2017-04-06 05:08:33', '0000-00-00 00:00:00'),
(15, 'Hungarian', '', 'no', 'no', '2017-04-06 05:08:33', '0000-00-00 00:00:00'),
(16, 'Vietnamese', '', 'no', 'no', '2017-04-06 05:08:33', '0000-00-00 00:00:00'),
(17, 'Haitian (Creole)', '', 'no', 'no', '2017-04-06 05:08:33', '0000-00-00 00:00:00'),
(18, 'Galician', '', 'no', 'no', '2017-04-06 05:08:33', '0000-00-00 00:00:00'),
(19, 'Dutch', '', 'no', 'no', '2017-04-06 05:08:33', '0000-00-00 00:00:00'),
(21, 'Greek', '', 'no', 'no', '2017-04-06 05:08:33', '0000-00-00 00:00:00'),
(22, 'Georgian', '', 'no', 'no', '2017-04-06 05:08:33', '0000-00-00 00:00:00'),
(23, 'Gujarati', '', 'no', 'no', '2017-04-06 05:08:33', '0000-00-00 00:00:00'),
(24, 'Danish', '', 'no', 'no', '2017-04-06 05:08:33', '0000-00-00 00:00:00'),
(25, 'Hebrew', '', 'no', 'no', '2017-04-06 05:08:33', '0000-00-00 00:00:00'),
(26, 'Yiddish', '', 'no', 'no', '2017-04-06 05:08:33', '0000-00-00 00:00:00'),
(27, 'Indonesian', '', 'no', 'no', '2017-04-06 05:08:33', '0000-00-00 00:00:00'),
(28, 'Irish', '', 'no', 'no', '2017-04-06 05:08:33', '0000-00-00 00:00:00'),
(29, 'Italian', 'it', 'no', 'no', '2018-12-01 10:07:03', '0000-00-00 00:00:00'),
(30, 'Icelandic', '', 'no', 'no', '2017-04-06 05:08:33', '0000-00-00 00:00:00'),
(31, 'Spanish', 'es', 'no', 'no', '2018-12-01 10:09:37', '0000-00-00 00:00:00'),
(33, 'Kannada', '', 'no', 'no', '2017-04-06 05:08:33', '0000-00-00 00:00:00'),
(34, 'Catalan', '', 'no', 'no', '2017-04-06 05:08:33', '0000-00-00 00:00:00'),
(36, 'Chinese', '', 'no', 'no', '2017-04-06 05:08:33', '0000-00-00 00:00:00'),
(37, 'Korean', '', 'no', 'no', '2017-04-06 05:08:33', '0000-00-00 00:00:00'),
(38, 'Xhosa', '', 'no', 'no', '2017-04-06 05:08:33', '0000-00-00 00:00:00'),
(39, 'Latin', '', 'no', 'no', '2017-04-06 05:08:33', '0000-00-00 00:00:00'),
(40, 'Latvian', '', 'no', 'no', '2017-04-06 05:08:33', '0000-00-00 00:00:00'),
(41, 'Lithuanian', '', 'no', 'no', '2017-04-06 05:08:33', '0000-00-00 00:00:00'),
(43, 'Malagasy', '', 'no', 'no', '2017-04-06 05:08:33', '0000-00-00 00:00:00'),
(44, 'Malay', '', 'no', 'no', '2017-04-06 05:08:33', '0000-00-00 00:00:00'),
(45, 'Malayalam', '', 'no', 'no', '2017-04-06 05:08:33', '0000-00-00 00:00:00'),
(46, 'Maltese', '', 'no', 'no', '2017-04-06 05:08:33', '0000-00-00 00:00:00'),
(47, 'Macedonian', '', 'no', 'no', '2017-04-06 05:08:33', '0000-00-00 00:00:00'),
(48, 'Maori', '', 'no', 'no', '2017-04-06 05:08:33', '0000-00-00 00:00:00'),
(49, 'Marathi', '', 'no', 'no', '2017-04-06 05:08:33', '0000-00-00 00:00:00'),
(51, 'Mongolian', '', 'no', 'no', '2017-04-06 05:08:33', '0000-00-00 00:00:00'),
(52, 'German', '', 'no', 'no', '2017-04-06 05:08:33', '0000-00-00 00:00:00'),
(53, 'Nepali', '', 'no', 'no', '2017-04-06 05:08:33', '0000-00-00 00:00:00'),
(54, 'Norwegian', '', 'no', 'no', '2017-04-06 05:08:33', '0000-00-00 00:00:00'),
(55, 'Punjabi', '', 'no', 'no', '2017-04-06 05:08:33', '0000-00-00 00:00:00'),
(57, 'Persian', '', 'no', 'no', '2017-04-06 05:08:33', '0000-00-00 00:00:00'),
(59, 'Portuguese', '', 'no', 'no', '2017-04-06 05:08:33', '0000-00-00 00:00:00'),
(60, 'Romanian', '', 'no', 'no', '2017-04-06 05:08:33', '0000-00-00 00:00:00'),
(61, 'Russian', '', 'no', 'no', '2017-04-06 05:08:33', '0000-00-00 00:00:00'),
(62, 'Cebuano', '', 'no', 'no', '2017-04-06 05:08:33', '0000-00-00 00:00:00'),
(64, 'Sinhala', '', 'no', 'no', '2017-04-06 05:08:33', '0000-00-00 00:00:00'),
(65, 'Slovakian', '', 'no', 'no', '2017-04-06 05:08:33', '0000-00-00 00:00:00'),
(66, 'Slovenian', '', 'no', 'no', '2017-04-06 05:08:33', '0000-00-00 00:00:00'),
(67, 'Swahili', '', 'no', 'no', '2017-04-06 05:08:33', '0000-00-00 00:00:00'),
(68, 'Sundanese', '', 'no', 'no', '2017-04-06 05:08:33', '0000-00-00 00:00:00'),
(70, 'Thai', '', 'no', 'no', '2017-04-06 05:08:33', '0000-00-00 00:00:00'),
(71, 'Tagalog', '', 'no', 'no', '2017-04-06 05:08:33', '0000-00-00 00:00:00'),
(72, 'Tamil', '', 'no', 'no', '2017-04-06 05:08:33', '0000-00-00 00:00:00'),
(74, 'Telugu', '', 'no', 'no', '2017-04-06 05:08:33', '0000-00-00 00:00:00'),
(75, 'Turkish', '', 'no', 'no', '2017-04-06 05:08:33', '0000-00-00 00:00:00'),
(77, 'Uzbek', '', 'no', 'no', '2017-04-06 05:08:33', '0000-00-00 00:00:00'),
(79, 'Urdu', '', 'no', 'no', '2017-04-06 05:08:33', '0000-00-00 00:00:00'),
(80, 'Finnish', '', 'no', 'no', '2017-04-06 05:08:33', '0000-00-00 00:00:00'),
(81, 'French', 'fr', 'no', 'no', '2018-12-01 10:08:47', '0000-00-00 00:00:00'),
(82, 'Hindi', '', 'no', 'no', '2017-04-06 05:08:33', '0000-00-00 00:00:00'),
(84, 'Czech', '', 'no', 'no', '2017-04-06 05:08:33', '0000-00-00 00:00:00'),
(85, 'Swedish', '', 'no', 'no', '2017-04-06 05:08:33', '0000-00-00 00:00:00'),
(86, 'Scottish', '', 'no', 'no', '2017-04-06 05:08:33', '0000-00-00 00:00:00'),
(87, 'Estonian', '', 'no', 'no', '2017-04-06 05:08:33', '0000-00-00 00:00:00'),
(88, 'Esperanto', '', 'no', 'no', '2017-04-06 05:08:33', '0000-00-00 00:00:00'),
(89, 'Javanese', '', 'no', 'no', '2017-04-06 05:08:33', '0000-00-00 00:00:00'),
(90, 'Japanese', '', 'no', 'no', '2017-04-06 05:08:33', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `leave_types`
--

CREATE TABLE `leave_types` (
  `id` int(11) NOT NULL,
  `type` varchar(200) NOT NULL,
  `is_active` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `leave_types`
--

INSERT INTO `leave_types` (`id`, `type`, `is_active`) VALUES
(1, 'Holiday', 'yes'),
(2, 'Sick', 'yes'),
(3, 'Freedom', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `medical`
--

CREATE TABLE `medical` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medical`
--

INSERT INTO `medical` (`id`, `name`) VALUES
(1, 'Medical One'),
(2, 'Medical Two');

-- --------------------------------------------------------

--
-- Table structure for table `medicine_bad_stock`
--

CREATE TABLE `medicine_bad_stock` (
  `id` int(11) NOT NULL,
  `pharmacy_id` int(11) NOT NULL,
  `outward_date` date NOT NULL,
  `expiry_date` varchar(200) NOT NULL,
  `batch_no` varchar(200) NOT NULL,
  `quantity` varchar(200) NOT NULL,
  `note` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `medicine_batch_details`
--

CREATE TABLE `medicine_batch_details` (
  `id` int(11) NOT NULL,
  `pharmacy_id` int(100) NOT NULL,
  `inward_date` date NOT NULL,
  `expiry_date` varchar(100) DEFAULT NULL,
  `batch_no` varchar(100) NOT NULL,
  `packing_qty` varchar(100) NOT NULL,
  `purchase_rate_packing` varchar(100) NOT NULL,
  `quantity` varchar(200) NOT NULL,
  `mrp` varchar(11) DEFAULT NULL,
  `sale_rate` varchar(11) DEFAULT NULL,
  `amount` varchar(100) DEFAULT NULL,
  `available_quantity` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `medicine_category`
--

CREATE TABLE `medicine_category` (
  `id` int(11) NOT NULL,
  `medicine_category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `message` text,
  `send_mail` varchar(10) DEFAULT '0',
  `send_sms` varchar(10) DEFAULT '0',
  `is_group` varchar(10) DEFAULT '0',
  `is_individual` varchar(10) DEFAULT '0',
  `is_class` int(10) NOT NULL DEFAULT '0',
  `group_list` text,
  `user_list` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `notification_roles`
--

CREATE TABLE `notification_roles` (
  `id` int(11) NOT NULL,
  `send_notification_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `is_active` int(11) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `notification_setting`
--

CREATE TABLE `notification_setting` (
  `id` int(11) NOT NULL,
  `type` varchar(100) DEFAULT NULL,
  `is_mail` varchar(10) DEFAULT '0',
  `is_sms` varchar(10) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notification_setting`
--

INSERT INTO `notification_setting` (`id`, `type`, `is_mail`, `is_sms`, `created_at`) VALUES
(1, 'opd_patient_registration', '0', '0', '2019-01-24 12:35:36'),
(2, 'ipd_patient_registration', '0', '0', '2019-01-24 12:35:36'),
(3, 'patient_discharged', '0', '0', '2019-01-24 12:35:36'),
(4, 'patient_revisit', '0', '0', '2019-01-24 12:35:36'),
(5, 'login_credential', '1', '0', '2019-01-24 12:35:36'),
(6, 'appointment', '0', '0', '2019-01-24 12:35:36');

-- --------------------------------------------------------

--
-- Table structure for table `nursing_forcep`
--

CREATE TABLE `nursing_forcep` (
  `id` int(11) NOT NULL,
  `forcep_name` varchar(64) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `before_birth` varchar(164) DEFAULT NULL,
  `giving_birth` date DEFAULT NULL,
  `after_birth` varchar(162) DEFAULT NULL,
  `family_arrangement` varchar(256) DEFAULT NULL,
  `birth_leaving` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nursing_forcep`
--

INSERT INTO `nursing_forcep` (`id`, `forcep_name`, `date_of_birth`, `before_birth`, `giving_birth`, `after_birth`, `family_arrangement`, `birth_leaving`) VALUES
(0, 'sdfsaf', '2019-08-08', 'sadfasf', '0000-00-00', 'asdfsaf', '23', 'sdfsaf');

-- --------------------------------------------------------

--
-- Table structure for table `opd_details`
--

CREATE TABLE `opd_details` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `opd_no` varchar(100) DEFAULT NULL,
  `appointment_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `case_type` varchar(200) DEFAULT NULL,
  `casualty` varchar(200) DEFAULT NULL,
  `symptoms` varchar(200) DEFAULT NULL,
  `bp` varchar(200) DEFAULT NULL,
  `height` varchar(100) DEFAULT NULL,
  `weight` varchar(100) DEFAULT NULL,
  `known_allergies` varchar(200) DEFAULT NULL,
  `note_remark` varchar(225) DEFAULT NULL,
  `refference` varchar(100) DEFAULT NULL,
  `cons_doctor` int(11) DEFAULT NULL,
  `amount` varchar(200) DEFAULT NULL,
  `duplicate` int(11) DEFAULT NULL,
  `tax` varchar(200) DEFAULT NULL,
  `payment_mode` varchar(200) DEFAULT NULL,
  `header_note` varchar(200) DEFAULT NULL,
  `footer_note` varchar(200) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `therapies` text,
  `diagnoses` text,
  `hmis_nu` varchar(44) DEFAULT NULL,
  `round` int(11) NOT NULL DEFAULT '1',
  `lab_round` int(11) NOT NULL DEFAULT '0',
  `total_discount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `operation`
--

CREATE TABLE `operation` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `operation`
--

INSERT INTO `operation` (`id`, `name`) VALUES
(1, 'Operation one'),
(2, 'Operation Two');

-- --------------------------------------------------------

--
-- Table structure for table `operation_theatre`
--

CREATE TABLE `operation_theatre` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `customer_type` varchar(50) DEFAULT NULL,
  `charge_id` varchar(11) DEFAULT NULL,
  `operation_name` varchar(100) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `operation_type` varchar(100) DEFAULT NULL,
  `consultant_doctor` varchar(100) DEFAULT NULL,
  `ass_consultant_1` varchar(50) DEFAULT NULL,
  `ass_consultant_2` varchar(50) DEFAULT NULL,
  `anesthetist` varchar(50) DEFAULT NULL,
  `anaethesia_type` varchar(50) DEFAULT NULL,
  `ot_technician` varchar(100) DEFAULT NULL,
  `ot_assistant` varchar(100) DEFAULT NULL,
  `result` varchar(50) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `apply_charge` varchar(100) NOT NULL,
  `discount` double NOT NULL,
  `round` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `organisation`
--

CREATE TABLE `organisation` (
  `id` int(11) NOT NULL,
  `organisation_name` varchar(200) NOT NULL,
  `code` varchar(50) NOT NULL,
  `contact_no` varchar(200) NOT NULL,
  `address` varchar(300) NOT NULL,
  `contact_person_name` varchar(200) NOT NULL,
  `contact_person_phone` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `organisations_charges`
--

CREATE TABLE `organisations_charges` (
  `id` int(11) NOT NULL,
  `org_id` int(11) NOT NULL,
  `charge_type` varchar(50) NOT NULL,
  `charge_id` int(11) NOT NULL,
  `org_charge` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ot_consultant_register`
--

CREATE TABLE `ot_consultant_register` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `date` varchar(50) NOT NULL,
  `ins_date` date NOT NULL,
  `ins_time` time NOT NULL,
  `instruction` varchar(200) NOT NULL,
  `cons_doctor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pathology`
--

CREATE TABLE `pathology` (
  `id` int(11) NOT NULL,
  `test_name` varchar(100) DEFAULT NULL,
  `short_name` varchar(100) DEFAULT NULL,
  `test_type` varchar(100) DEFAULT NULL,
  `pathology_category_id` varchar(11) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `sub_category` varchar(50) NOT NULL,
  `report_days` varchar(50) NOT NULL,
  `method` varchar(50) NOT NULL,
  `charge_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pathology_category`
--

CREATE TABLE `pathology_category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pathology_report`
--

CREATE TABLE `pathology_report` (
  `id` int(11) NOT NULL,
  `pathology_id` int(11) NOT NULL,
  `patient_id` varchar(30) DEFAULT NULL,
  `customer_type` varchar(50) DEFAULT NULL,
  `patient_name` varchar(100) DEFAULT NULL,
  `consultant_doctor` varchar(10) NOT NULL,
  `reporting_date` date DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `pathology_report` varchar(255) DEFAULT NULL,
  `apply_charge` float(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` int(11) NOT NULL,
  `patient_unique_id` int(11) NOT NULL,
  `admission_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `patient_name` varchar(100) DEFAULT NULL,
  `age` varchar(10) DEFAULT NULL,
  `month` varchar(200) DEFAULT NULL,
  `day` int(64) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `mobileno` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `dob` varchar(100) DEFAULT NULL,
  `gender` varchar(100) DEFAULT NULL,
  `marital_status` varchar(100) DEFAULT NULL,
  `blood_group` varchar(200) DEFAULT NULL,
  `address` text,
  `province` varchar(50) DEFAULT NULL,
  `district` varchar(50) DEFAULT NULL,
  `guardian_name` varchar(100) DEFAULT NULL,
  `hmis_no` varchar(100) DEFAULT NULL,
  `guardian_address` text,
  `therapy` varchar(1020) DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `patient_type` varchar(200) DEFAULT NULL,
  `credit_limit` varchar(50) DEFAULT NULL,
  `organisation` varchar(100) DEFAULT NULL,
  `old_patient` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `opd` varchar(162) DEFAULT 'Internal Medicine',
  `disable_at` date DEFAULT NULL,
  `referred_of` varchar(126) DEFAULT 'Not Mentioned',
  `referred_to` varchar(164) DEFAULT 'Shuhada Hospital',
  `ex_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `note` varchar(200) DEFAULT NULL,
  `payment` int(11) DEFAULT '0',
  `test_type` varchar(164) DEFAULT NULL,
  `test_name` varchar(164) DEFAULT NULL,
  `test_price` double DEFAULT NULL,
  `test_desc` varchar(255) DEFAULT NULL,
  `type_disease` varchar(162) DEFAULT NULL,
  `recognition` varchar(256) DEFAULT NULL,
  `diagnostic` varchar(256) DEFAULT NULL,
  `add_description` varchar(255) DEFAULT NULL,
  `entry_date` varchar(164) DEFAULT NULL COMMENT 'IPD in Date',
  `is_warded` int(11) DEFAULT NULL,
  `is_examined` int(11) DEFAULT NULL,
  `is_printed` int(11) DEFAULT NULL,
  `is_revisit` int(11) DEFAULT NULL,
  `is_war` int(11) DEFAULT '0',
  `is_info` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `patient_charges`
--

CREATE TABLE `patient_charges` (
  `id` int(11) NOT NULL,
  `date` varchar(50) DEFAULT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `charge_id` int(11) DEFAULT NULL,
  `org_charge_id` int(11) DEFAULT NULL,
  `apply_charge` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `patient_income`
--

CREATE TABLE `patient_income` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `operation_type` varchar(100) DEFAULT NULL,
  `patient_name` varchar(100) DEFAULT NULL,
  `patient_fname` varchar(100) DEFAULT NULL,
  `fee` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `patient_nicu`
--

CREATE TABLE `patient_nicu` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `father_name` varchar(100) DEFAULT NULL,
  `address` text,
  `weight_at_ward` varchar(100) DEFAULT NULL,
  `net_weight` varchar(80) DEFAULT NULL,
  `date_awarded` date DEFAULT NULL,
  `age` varchar(20) DEFAULT NULL,
  `sex` varchar(20) DEFAULT NULL,
  `evidence_type` varchar(20) DEFAULT NULL,
  `source` varchar(100) DEFAULT NULL,
  `medical_problem` varchar(100) DEFAULT NULL,
  `diagnostic` varchar(100) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `date_exited` date DEFAULT NULL,
  `died` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `patient_nursing`
--

CREATE TABLE `patient_nursing` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `patient_unique_id` int(11) DEFAULT NULL,
  `indate` varchar(150) DEFAULT NULL,
  `diagnosis` varchar(150) DEFAULT NULL COMMENT 'tashkhis',
  `medication` varchar(150) DEFAULT NULL,
  `bed_time` varchar(150) DEFAULT NULL,
  `income_fees` int(11) DEFAULT NULL,
  `nursing_charge` varchar(150) DEFAULT NULL,
  `round` int(11) NOT NULL DEFAULT '1',
  `operation` varchar(150) DEFAULT NULL,
  `total_fees` int(11) DEFAULT '0',
  `discount` double NOT NULL,
  `died` varchar(150) DEFAULT NULL,
  `scaped` varchar(150) DEFAULT NULL,
  `throw_back` varchar(150) DEFAULT NULL,
  `refer` varchar(150) DEFAULT NULL,
  `night` int(11) DEFAULT NULL,
  `match_blood` varchar(150) DEFAULT NULL,
  `outdate` date DEFAULT NULL,
  `observation` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `patient_operation`
--

CREATE TABLE `patient_operation` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `op_type` int(11) DEFAULT NULL COMMENT '1 operation, 2 medical, 3 children medical, 4 giving_births',
  `op_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `patient_timeline`
--

CREATE TABLE `patient_timeline` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `timeline_date` date NOT NULL,
  `description` varchar(200) NOT NULL,
  `document` varchar(200) NOT NULL,
  `status` varchar(100) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `patient_timeline`
--

INSERT INTO `patient_timeline` (`id`, `patient_id`, `title`, `timeline_date`, `description`, `document`, `status`, `date`) VALUES
(1, 10, 'Duration', '2019-08-25', 'No other description is added here.', '', 'yes', '2019-08-25');

-- --------------------------------------------------------

--
-- Table structure for table `patient_ward`
--

CREATE TABLE `patient_ward` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `ward_duration` varchar(100) DEFAULT NULL,
  `exit_date` varchar(100) DEFAULT NULL,
  `entrance_fee` int(11) NOT NULL DEFAULT '0',
  `total_fees` int(11) DEFAULT '0',
  `night` varchar(100) DEFAULT NULL,
  `operation` varchar(100) DEFAULT NULL,
  `died` varchar(100) DEFAULT NULL,
  `escape` varchar(100) DEFAULT NULL,
  `leave` varchar(100) DEFAULT NULL,
  `reference` varchar(100) DEFAULT NULL,
  `blood_group` varchar(100) DEFAULT NULL,
  `birth` date DEFAULT NULL,
  `mi` varchar(100) DEFAULT NULL,
  `description` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `date` date DEFAULT NULL,
  `round` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `paid_amount` float(10,2) NOT NULL,
  `balance_amount` int(11) DEFAULT '0',
  `total_amount` int(11) DEFAULT '0',
  `payment_mode` varchar(100) DEFAULT 'Cash',
  `note` text,
  `date` date DEFAULT NULL,
  `document` varchar(255) DEFAULT NULL,
  `round` int(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `payment_settings`
--

CREATE TABLE `payment_settings` (
  `id` int(11) NOT NULL,
  `payment_type` varchar(200) NOT NULL,
  `api_username` varchar(200) DEFAULT NULL,
  `api_secret_key` varchar(200) NOT NULL,
  `salt` varchar(200) NOT NULL,
  `api_publishable_key` varchar(200) NOT NULL,
  `api_password` varchar(200) DEFAULT NULL,
  `api_signature` varchar(200) DEFAULT NULL,
  `api_email` varchar(200) DEFAULT NULL,
  `paypal_demo` varchar(100) NOT NULL,
  `account_no` varchar(200) NOT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `payslip_allowance`
--

CREATE TABLE `payslip_allowance` (
  `id` int(11) NOT NULL,
  `payslip_id` int(11) NOT NULL,
  `allowance_type` varchar(200) NOT NULL,
  `amount` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `cal_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payslip_allowance`
--

INSERT INTO `payslip_allowance` (`id`, `payslip_id`, `allowance_type`, `amount`, `staff_id`, `cal_type`) VALUES
(1, 1, 'First Time', 45000, 3, 'positive'),
(2, 1, 'First payment', 2000, 3, 'negative'),
(3, 1, 'Second Payment', 4000, 3, 'negative');

-- --------------------------------------------------------

--
-- Table structure for table `permission_category`
--

CREATE TABLE `permission_category` (
  `id` int(11) NOT NULL,
  `perm_group_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `short_code` varchar(100) DEFAULT NULL,
  `enable_view` int(11) DEFAULT '0',
  `enable_add` int(11) DEFAULT '0',
  `enable_edit` int(11) DEFAULT '0',
  `enable_delete` int(11) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `permission_category`
--

INSERT INTO `permission_category` (`id`, `perm_group_id`, `name`, `short_code`, `enable_view`, `enable_add`, `enable_edit`, `enable_delete`, `created_at`) VALUES
(1, 1, 'Student', 'student', 1, 1, 1, 1, '2018-06-22 15:47:11'),
(2, 1, 'Import Student', 'import_student', 1, 0, 0, 0, '2018-06-22 15:47:19'),
(3, 1, 'Student Categories', 'student_categories', 1, 1, 1, 1, '2018-06-22 15:47:36'),
(4, 1, 'Student Houses', 'student_houses', 1, 1, 1, 1, '2018-06-22 15:47:53'),
(5, 2, 'Collect Fees', 'collect_fees', 1, 1, 0, 1, '2018-06-22 15:51:03'),
(6, 2, 'Fees Carry Forward', 'fees_carry_forward', 1, 0, 0, 0, '2018-06-27 05:48:15'),
(7, 2, 'Fees Master', 'fees_master', 1, 1, 1, 1, '2018-06-27 05:48:57'),
(8, 2, 'Fees Group', 'fees_group', 1, 1, 1, 1, '2018-06-22 15:51:46'),
(9, 3, 'Income', 'income', 1, 1, 1, 1, '2018-06-22 15:53:21'),
(10, 3, 'Income Head', 'income_head', 1, 1, 1, 1, '2018-06-22 15:52:44'),
(11, 3, 'Search Income', 'search_income', 1, 0, 0, 0, '2018-06-22 15:53:00'),
(12, 4, 'Expense', 'expense', 1, 1, 1, 1, '2018-06-22 15:54:06'),
(13, 4, 'Expense Head', 'expense_head', 1, 1, 1, 1, '2018-06-22 15:53:47'),
(14, 4, 'Search Expense', 'search_expense', 1, 0, 0, 0, '2018-06-22 15:54:13'),
(15, 5, 'Student Attendance', 'student_attendance', 1, 1, 1, 0, '2018-06-22 15:54:49'),
(16, 5, 'Student Attendance Report', 'student_attendance_report', 1, 0, 0, 0, '2018-06-22 15:54:26'),
(17, 6, 'Exam', 'exam', 1, 1, 1, 1, '2018-06-22 15:56:02'),
(19, 6, 'Marks Register', 'marks_register', 1, 1, 1, 0, '2018-06-22 15:56:19'),
(20, 6, 'Marks Grade', 'marks_grade', 1, 1, 1, 1, '2018-06-22 15:55:25'),
(21, 7, 'Class Timetable', 'class_timetable', 1, 1, 1, 0, '2018-06-22 16:01:36'),
(22, 7, 'Assign Subject', 'assign_subject', 1, 1, 1, 1, '2018-06-22 16:01:57'),
(23, 7, 'Subject', 'subject', 1, 1, 1, 1, '2018-06-22 16:02:17'),
(24, 7, 'Class', 'class', 1, 1, 1, 1, '2018-06-22 16:02:35'),
(25, 7, 'Section', 'section', 1, 1, 1, 1, '2018-06-22 16:01:10'),
(26, 7, 'Promote Student', 'promote_student', 1, 0, 0, 0, '2018-06-22 16:02:47'),
(27, 8, 'Upload Content', 'upload_content', 1, 1, 0, 1, '2018-06-22 16:03:19'),
(28, 9, 'Books', 'books', 1, 1, 1, 1, '2018-06-22 16:04:04'),
(29, 9, 'Issue Return Student', 'issue_return', 1, 0, 0, 0, '2018-06-22 16:03:41'),
(30, 9, 'Add Staff Member', 'add_staff_member', 1, 0, 0, 0, '2018-07-02 17:07:00'),
(31, 10, 'Issue Item', 'issue_item', 1, 1, 0, 1, '2018-12-17 15:25:14'),
(32, 10, 'Item Stock', 'item_stock', 1, 1, 1, 1, '2018-06-22 16:05:17'),
(33, 10, 'Item', 'item', 1, 1, 1, 1, '2018-06-22 16:05:40'),
(34, 10, 'Store', 'store', 1, 1, 1, 1, '2018-06-22 16:06:02'),
(35, 10, 'Supplier', 'supplier', 1, 1, 1, 1, '2018-06-22 16:06:25'),
(37, 11, 'Routes', 'routes', 1, 1, 1, 1, '2018-06-22 16:09:17'),
(38, 11, 'Vehicle', 'vehicle', 1, 1, 1, 1, '2018-06-22 16:09:36'),
(39, 11, 'Assign Vehicle', 'assign_vehicle', 1, 1, 1, 1, '2018-06-27 10:09:20'),
(40, 12, 'Hostel', 'hostel', 1, 1, 1, 1, '2018-06-22 16:10:49'),
(41, 12, 'Room Type', 'room_type', 1, 1, 1, 1, '2018-06-22 16:10:27'),
(42, 12, 'Hostel Rooms', 'hostel_rooms', 1, 1, 1, 1, '2018-06-25 11:53:03'),
(43, 13, 'Notice Board', 'notice_board', 1, 1, 1, 1, '2018-06-22 16:11:17'),
(44, 13, 'Email / SMS', 'email_sms', 1, 0, 0, 0, '2018-06-22 16:10:54'),
(46, 13, 'Email / SMS Log', 'email_sms_log', 1, 0, 0, 0, '2018-06-22 16:11:23'),
(47, 1, 'Student Report', 'student_report', 1, 0, 0, 0, '2018-07-03 16:19:36'),
(48, 14, 'OPD Report', 'opd_report', 1, 0, 0, 0, '2018-12-18 14:29:18'),
(53, 15, 'Languages', 'languages', 0, 1, 0, 0, '2018-06-22 16:13:18'),
(54, 15, 'General Setting', 'general_setting', 1, 0, 1, 0, '2018-07-05 14:38:35'),
(56, 15, 'Notification Setting', 'notification_setting', 1, 0, 1, 0, '2018-07-05 14:38:41'),
(57, 15, 'SMS Setting', 'sms_setting', 1, 0, 1, 0, '2018-07-05 14:38:47'),
(58, 15, 'Email Setting', 'email_setting', 1, 0, 1, 0, '2018-07-05 14:38:51'),
(59, 15, 'Front CMS Setting', 'front_cms_setting', 1, 0, 1, 0, '2018-07-05 14:38:55'),
(60, 15, 'Payment Methods', 'payment_methods', 1, 0, 1, 0, '2018-07-05 14:38:59'),
(61, 16, 'Menus', 'menus', 1, 1, 0, 1, '2018-07-09 09:20:06'),
(62, 16, 'Media Manager', 'media_manager', 1, 1, 0, 1, '2018-07-09 09:20:26'),
(63, 16, 'Banner Images', 'banner_images', 1, 1, 0, 1, '2018-06-22 16:16:02'),
(64, 16, 'Pages', 'pages', 1, 1, 1, 1, '2018-06-22 16:16:21'),
(65, 16, 'Gallery', 'gallery', 1, 1, 1, 1, '2018-06-22 16:17:02'),
(66, 16, 'Event', 'event', 1, 1, 1, 1, '2018-06-22 16:17:20'),
(67, 16, 'News', 'notice', 1, 1, 1, 1, '2018-07-03 14:09:34'),
(68, 2, 'Fees Group Assign', 'fees_group_assign', 1, 0, 0, 0, '2018-06-22 15:50:42'),
(69, 2, 'Fees Type', 'fees_type', 1, 1, 1, 1, '2018-06-22 15:49:34'),
(70, 2, 'Fees Discount', 'fees_discount', 1, 1, 1, 1, '2018-06-22 15:50:10'),
(71, 2, 'Fees Discount Assign', 'fees_discount_assign', 1, 0, 0, 0, '2018-06-22 15:50:17'),
(72, 2, 'Fees Statement', 'fees_statement', 1, 0, 0, 0, '2018-06-22 15:48:56'),
(73, 2, 'Search Fees Payment', 'search_fees_payment', 1, 0, 0, 0, '2018-06-22 15:50:27'),
(74, 2, 'Search Due Fees', 'search_due_fees', 1, 0, 0, 0, '2018-06-22 15:50:35'),
(75, 2, 'Balance Fees Report', 'balance_fees_report', 1, 0, 0, 0, '2018-06-22 15:48:50'),
(76, 6, 'Exam Schedule', 'exam_schedule', 1, 1, 1, 0, '2018-06-22 15:55:40'),
(77, 7, 'Assign Class Teacher', 'assign_class_teacher', 1, 1, 1, 1, '2018-06-22 16:00:52'),
(80, 17, 'Visitor Book', 'visitor_book', 1, 1, 1, 1, '2018-06-22 16:18:58'),
(81, 17, 'Phone Call Log', 'phone_call_log', 1, 1, 1, 1, '2018-06-22 16:20:57'),
(82, 17, 'Postal Dispatch', 'postal_dispatch', 1, 1, 1, 1, '2018-06-22 16:20:21'),
(83, 17, 'Postal Receive', 'postal_receive', 1, 1, 1, 1, '2018-06-22 16:20:04'),
(84, 17, 'Complain', 'complain', 1, 1, 1, 1, '2018-12-19 14:41:37'),
(85, 17, 'Setup Front Office', 'setup_front_office', 1, 1, 1, 1, '2018-11-15 06:19:58'),
(86, 18, 'Staff', 'staff', 1, 1, 1, 1, '2018-06-22 16:23:31'),
(87, 18, 'Disable Staff', 'disable_staff', 1, 0, 0, 0, '2018-06-22 16:23:12'),
(88, 18, 'Staff Attendance', 'staff_attendance', 1, 1, 1, 0, '2018-06-22 16:23:10'),
(89, 18, 'Staff Attendance Report', 'staff_attendance_report', 1, 0, 0, 0, '2018-06-22 16:22:54'),
(90, 18, 'Staff Payroll', 'staff_payroll', 1, 1, 0, 1, '2018-06-22 16:22:51'),
(91, 18, 'Payroll Report', 'payroll_report', 1, 0, 0, 0, '2018-06-22 16:22:34'),
(93, 19, 'Homework', 'homework', 1, 1, 1, 1, '2018-06-22 16:23:50'),
(94, 19, 'Homework Evaluation', 'homework_evaluation', 1, 1, 0, 0, '2018-06-27 08:37:21'),
(95, 19, 'Homework Report', 'homework_report', 1, 0, 0, 0, '2018-06-22 16:23:54'),
(102, 21, 'Calendar To Do List', 'calendar_to_do_list', 1, 1, 1, 1, '2018-06-22 16:24:41'),
(104, 10, 'Item Category', 'item_category', 1, 1, 1, 1, '2018-06-22 16:04:33'),
(105, 1, 'Student Parent Login Details', 'student_parent_login_details', 1, 0, 0, 0, '2018-06-22 15:48:01'),
(107, 1, 'Disable Student', 'disable_student', 1, 0, 0, 0, '2018-06-25 11:51:34'),
(108, 18, ' Approve Leave Request', 'approve_leave_request', 1, 1, 1, 1, '2018-07-02 15:47:41'),
(109, 18, 'Apply Leave', 'apply_leave', 1, 1, 1, 1, '2018-06-26 09:23:32'),
(110, 18, 'Leave Types ', 'leave_types', 1, 1, 1, 1, '2018-07-02 15:47:56'),
(111, 18, 'Department', 'department', 1, 1, 1, 1, '2018-06-26 09:27:07'),
(112, 18, 'Designation', 'designation', 1, 1, 1, 1, '2018-06-26 09:27:07'),
(118, 22, 'Staff Role Count Widget', 'staff_role_count_widget', 1, 0, 0, 0, '2018-07-03 12:43:35'),
(119, 1, 'Guardian Report', 'guardian_report', 1, 0, 0, 0, '2018-07-03 14:12:29'),
(120, 1, 'Student History', 'student_history', 1, 0, 0, 0, '2018-07-03 14:12:29'),
(121, 1, 'Student Login Credential', 'student_login_credential', 1, 0, 0, 0, '2018-07-03 14:12:29'),
(122, 5, 'Attendance By Date', 'attendance_by_date', 1, 0, 0, 0, '2018-07-03 14:12:29'),
(123, 9, 'Add Student', 'add_student', 1, 0, 0, 0, '2018-07-03 14:12:29'),
(124, 11, 'Student Transport Report', 'student_transport_report', 1, 0, 0, 0, '2018-07-03 14:12:29'),
(125, 12, 'Student Hostel Report', 'student_hostel_report', 1, 0, 0, 0, '2018-07-03 14:12:29'),
(126, 15, 'User Status', 'user_status', 1, 0, 0, 0, '2018-07-03 14:12:29'),
(127, 18, 'Can See Other Users Profile', 'can_see_other_users_profile', 1, 0, 0, 0, '2018-07-03 14:12:29'),
(128, 1, 'Student Timeline', 'student_timeline', 0, 1, 0, 1, '2018-07-05 13:38:52'),
(129, 18, 'Staff Timeline', 'staff_timeline', 0, 1, 0, 1, '2018-07-05 13:38:52'),
(130, 15, 'Backup', 'backup', 1, 1, 0, 1, '2018-07-09 09:47:17'),
(131, 15, 'Restore', 'restore', 1, 0, 0, 0, '2018-07-09 09:47:17'),
(132, 23, 'OPD Patient', 'opd_patient', 1, 1, 1, 1, '2018-12-20 15:07:26'),
(133, 23, 'OLD Patients', 'old_patient', 1, 1, 1, 1, '2018-10-11 06:58:51'),
(134, 23, 'Prescription', 'prescription', 1, 1, 1, 1, '2018-10-11 06:58:26'),
(135, 23, 'Revisit', 'revisit', 1, 1, 1, 1, '2018-10-11 06:58:26'),
(136, 23, 'OPD Diagnosis', 'opd diagnosis', 1, 1, 1, 1, '2018-10-11 12:16:59'),
(137, 23, 'OPD Timeline', 'opd timeline', 1, 1, 1, 1, '2018-10-11 12:17:22'),
(138, 24, 'IPD Patients', 'ipd_patient', 1, 1, 1, 1, '2018-10-11 12:44:55'),
(139, 24, 'Discharged Patients', 'discharged patients', 1, 1, 1, 1, '2018-10-11 06:58:26'),
(140, 24, 'Consultant Register', 'consultant register', 1, 1, 1, 1, '2018-10-11 06:58:26'),
(141, 24, 'IPD Diagnosis', 'ipd diagnosis', 1, 1, 1, 1, '2018-10-11 12:19:18'),
(142, 24, 'IPD Timeline', 'ipd timeline', 1, 1, 1, 1, '2018-10-11 12:19:42'),
(143, 24, 'Charges', 'charges', 1, 1, 1, 1, '2018-10-11 06:58:26'),
(144, 24, 'Payment', 'payment', 1, 1, 1, 1, '2018-10-11 06:58:26'),
(145, 24, 'Bill', 'bill', 1, 1, 1, 1, '2018-10-11 06:58:26'),
(146, 25, 'Medicine', 'medicine', 1, 1, 1, 1, '2018-10-11 06:58:26'),
(147, 25, 'Add Medicine Stock', 'add_medicine_stock', 1, 1, 1, 1, '2018-12-21 16:19:20'),
(148, 25, 'Pharmacy Bill', 'pharmacy bill', 1, 1, 1, 1, '2018-10-11 06:58:26'),
(149, 26, 'Pathology Test', 'pathology test', 1, 1, 1, 1, '2018-12-22 14:16:42'),
(150, 26, 'Add patient & Test Report', 'add_patient_test_report', 1, 1, 1, 1, '2018-12-12 16:39:49'),
(152, 27, 'Radiology Test', 'radiology test', 1, 1, 1, 1, '2018-10-11 06:58:26'),
(153, 27, 'Add patient &  Test Report', 'add_patient_test_reprt', 1, 1, 1, 1, '2018-12-12 16:50:58'),
(155, 22, 'IPD Income Widget', 'ipd_income_widget', 1, 0, 0, 0, '2018-12-20 14:38:05'),
(156, 22, 'OPD Income Widget', 'opd_income_widget', 1, 0, 0, 0, '2018-12-20 14:38:15'),
(157, 22, 'Pharmacy Income Widget', 'pharmacy_income_widget', 1, 0, 0, 0, '2018-12-20 14:38:25'),
(158, 22, 'Pathology Income Widget', 'pathology_income_widget', 1, 0, 0, 0, '2018-12-20 14:38:37'),
(159, 22, 'Radiology Income Widget', 'radiology_income_widget', 1, 0, 0, 0, '2018-12-20 14:38:49'),
(160, 22, 'OT Income Widget', 'ot_income_widget', 1, 0, 0, 0, '2018-12-20 14:39:02'),
(161, 22, 'Blood Bank Income Widget', 'blood_bank_income_widget', 1, 0, 0, 0, '2018-12-20 14:39:13'),
(162, 22, 'Ambulance Income Widget', 'ambulance_income_widget', 1, 0, 0, 0, '2018-12-20 14:39:25'),
(163, 28, 'OT Patient', 'ot_patient', 1, 1, 1, 1, '2018-10-27 09:05:57'),
(164, 28, 'OT Consultant Instruction', 'ot_consultant_instruction', 1, 1, 1, 1, '2018-10-27 09:06:19'),
(165, 29, 'Ambulance Call', 'ambulance_call', 1, 1, 1, 1, '2018-10-27 09:07:51'),
(166, 29, 'Ambulance', 'ambulance', 1, 1, 1, 1, '2018-10-27 09:07:59'),
(167, 30, 'Blood Bank Status', 'blood_bank_status', 1, 1, 1, 1, '2018-10-27 09:50:09'),
(168, 30, 'Blood Issue', 'blood_issue', 1, 1, 1, 1, '2018-10-27 09:50:15'),
(169, 30, 'Blood Donor', 'blood_donor', 1, 1, 1, 1, '2018-10-27 09:50:19'),
(170, 25, 'Medicine Category', 'medicine_category', 1, 1, 1, 1, '2018-10-25 11:40:24'),
(171, 27, 'Radiology Category', 'radiology category', 1, 1, 1, 1, '2018-12-22 14:33:20'),
(173, 31, 'Organisation', 'organisation', 1, 1, 1, 1, '2018-10-25 11:40:24'),
(174, 31, 'Charges', 'tpa_charges', 1, 1, 1, 1, '2018-12-22 15:36:57'),
(175, 26, 'Pathology Category', 'pathology_category', 1, 1, 1, 1, '2018-10-25 11:40:24'),
(176, 32, 'Charges', 'hospital_charges', 1, 1, 1, 1, '2018-12-22 15:38:26'),
(178, 14, 'IPD Report', 'ipd_report', 1, 0, 0, 0, '2018-12-12 15:39:24'),
(179, 14, 'Pharmacy Bill Report', 'pharmacy_bill_report', 1, 0, 0, 0, '2018-12-12 15:39:24'),
(180, 14, 'Pathology Patient Report', 'pathology_patient_report', 1, 0, 0, 0, '2018-12-12 15:39:24'),
(181, 14, 'Radiology Patient Report', 'radiology_patient_report', 1, 0, 0, 0, '2018-12-12 15:39:24'),
(182, 14, 'O.T Report', 'ot_report', 1, 0, 0, 0, '2018-12-12 15:39:24'),
(183, 14, 'Blood Donor Report', 'blood_donor_report', 1, 0, 0, 0, '2018-12-12 15:39:24'),
(184, 14, 'Payroll Month Report', 'payroll_month_report', 1, 0, 0, 0, '2019-01-24 13:50:32'),
(185, 14, 'Payroll Report', 'payroll_report', 1, 0, 0, 0, '2019-01-24 13:50:27'),
(186, 14, 'Staff Attendane Report', 'staff_attendance_report', 1, 0, 0, 0, '2018-12-12 15:39:24'),
(187, 14, 'User Log', 'user_log', 1, 0, 0, 0, '2018-12-12 15:39:24'),
(188, 14, 'Patient Login Credential', 'patient_login_credential', 1, 0, 0, 0, '2018-12-12 15:39:24'),
(189, 14, 'Email / SMS Log', 'email_sms_log', 1, 0, 0, 0, '2018-12-12 15:39:24'),
(190, 22, 'Yearly Income & Expense Chart', 'yearly_income_expense_chart', 1, 0, 0, 0, '2018-12-12 15:52:05'),
(191, 22, 'Monthly Income & Expense Chart', 'monthly_income_expense_chart', 1, 0, 0, 0, '2018-12-12 15:55:14'),
(192, 23, 'OPD Prescription Print Header Footer ', 'opd_prescription_print_header_footer', 1, 1, 1, 1, '2018-12-12 16:01:07'),
(193, 24, 'Revert Generated Bill', 'revert_generated_bill', 1, 0, 0, 0, '2018-12-12 16:04:02'),
(194, 24, 'Calculate Bill', 'calculate_bill', 1, 0, 0, 0, '2018-12-12 16:05:30'),
(195, 24, 'Generate Bill & Discharge Patient', 'generate_bill_discharge_patient', 1, 0, 0, 0, '2018-12-21 14:56:00'),
(196, 24, 'Bed', 'bed', 1, 1, 1, 1, '2018-12-12 16:16:01'),
(197, 24, 'IPD Prescription Print Header Footer', 'ipd_prescription_print_header_footer', 1, 1, 1, 1, '2018-12-12 16:09:42'),
(198, 24, 'Bed Status', 'bed_status', 1, 0, 0, 0, '2018-12-12 16:09:42'),
(200, 25, 'Medicine Bad Stock', 'medicine_bad_stock', 1, 1, 0, 1, '2018-12-18 06:42:46'),
(201, 25, 'Pharmacy Bill print Header Footer', 'pharmacy_bill_print_header_footer', 1, 1, 1, 1, '2018-12-12 16:36:47'),
(202, 30, 'Donate Blood', 'donate_blood', 1, 1, 0, 1, '2018-12-12 16:47:10'),
(203, 32, 'Charge Category', 'charge_category', 1, 1, 1, 1, '2018-12-12 16:49:38'),
(204, 17, 'Appointment', 'appointment', 1, 1, 1, 1, '2018-12-18 17:22:53'),
(205, 17, 'Appointment Approve', 'appointment_approve', 1, 0, 0, 0, '2018-12-18 17:25:58');

-- --------------------------------------------------------

--
-- Table structure for table `permission_group`
--

CREATE TABLE `permission_group` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `short_code` varchar(100) NOT NULL,
  `is_active` int(11) DEFAULT '0',
  `system` int(11) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `permission_group`
--

INSERT INTO `permission_group` (`id`, `name`, `short_code`, `is_active`, `system`, `sort_order`, `created_at`) VALUES
(3, 'Income', 'income', 1, 0, 9, '2018-12-23 16:26:51'),
(4, 'Expense', 'expense', 1, 0, 10, '2018-12-18 10:20:47'),
(8, 'Download Center', 'download_center', 1, 0, 15, '2018-12-18 10:23:12'),
(10, 'Inventory', 'inventory', 0, 0, 16, '2019-12-25 05:43:55'),
(13, 'Messaging', 'communicate', 1, 0, 14, '2019-12-25 05:44:20'),
(14, 'Reports', 'reports', 1, 1, 19, '2018-12-18 10:24:41'),
(15, 'Setup Settings', 'system_settings', 1, 1, 18, '2019-01-24 13:52:23'),
(16, 'Front CMS', 'front_cms', 0, 0, 17, '2019-12-25 05:43:46'),
(17, 'Front Office', 'front_office', 0, 0, 12, '2019-12-25 05:44:28'),
(18, 'Human Resource', 'human_resource', 1, 1, 13, '2018-12-18 10:22:37'),
(21, 'Calendar To Do List', 'calendar_to_do_list', 1, 0, 21, '2018-12-18 10:16:34'),
(22, 'Dashboard and Widgets', 'dashboard_and_widgets', 1, 1, 20, '2018-12-18 10:24:51'),
(23, 'OPD', 'OPD', 1, 0, 1, '2018-12-18 09:53:08'),
(24, 'IPD', 'IPD', 1, 0, 2, '2018-12-18 09:53:13'),
(25, 'Pharmacy', 'pharmacy', 0, 0, 3, '2019-12-25 05:44:51'),
(26, 'Pathology', 'pathology', 1, 0, 4, '2018-12-18 10:02:56'),
(27, 'Radiology', 'radiology', 1, 0, 5, '2018-12-18 10:03:00'),
(28, 'Operation Theatre', 'operation_theatre', 0, 0, 6, '2019-12-25 05:44:45'),
(29, 'Ambulance', 'ambulance', 0, 0, 11, '2019-12-25 05:44:32'),
(30, 'Blood Bank', 'blood_bank', 0, 0, 7, '2019-12-25 05:44:42'),
(31, 'TPA Management', 'tpa_management', 0, 0, 8, '2019-12-25 05:44:39'),
(32, 'Hospital Charges', 'hospital_charges', 1, 1, 10, '2018-12-18 10:03:31');

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy`
--

CREATE TABLE `pharmacy` (
  `id` int(11) NOT NULL,
  `medicine_name` varchar(200) DEFAULT NULL,
  `medicine_category_id` varchar(50) NOT NULL,
  `medicine_image` varchar(200) NOT NULL,
  `medicine_company` varchar(100) DEFAULT NULL,
  `medicine_composition` varchar(100) DEFAULT NULL,
  `medicine_group` varchar(100) DEFAULT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `min_level` varchar(50) DEFAULT NULL,
  `reorder_level` varchar(50) DEFAULT NULL,
  `vat` varchar(50) DEFAULT NULL,
  `unit_packing` varchar(50) DEFAULT NULL,
  `supplier` varchar(50) DEFAULT NULL,
  `vat_ac` varchar(50) DEFAULT NULL,
  `note` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy_bill_basic`
--

CREATE TABLE `pharmacy_bill_basic` (
  `id` int(11) NOT NULL,
  `bill_no` varchar(50) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `patient_id` int(11) NOT NULL,
  `customer_name` varchar(50) DEFAULT NULL,
  `customer_type` varchar(50) DEFAULT NULL,
  `doctor_name` varchar(50) DEFAULT NULL,
  `opd_ipd_no` varchar(50) DEFAULT NULL,
  `total` varchar(100) DEFAULT NULL,
  `discount` varchar(100) NOT NULL,
  `tax` varchar(200) NOT NULL,
  `net_amount` float(10,2) NOT NULL,
  `note` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy_bill_detail`
--

CREATE TABLE `pharmacy_bill_detail` (
  `id` int(11) NOT NULL,
  `pharmacy_bill_basic_id` varchar(50) NOT NULL,
  `medicine_category_id` int(11) NOT NULL,
  `medicine_name` varchar(200) NOT NULL,
  `expire_date` varchar(100) NOT NULL,
  `batch_no` varchar(200) NOT NULL,
  `quantity` varchar(100) NOT NULL,
  `sale_price` varchar(200) NOT NULL,
  `amount` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

CREATE TABLE `prescription` (
  `id` int(11) NOT NULL,
  `opd_id` int(11) NOT NULL,
  `medicine` varchar(200) NOT NULL,
  `dosage` varchar(200) NOT NULL,
  `instruction` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prescription`
--

INSERT INTO `prescription` (`id`, `opd_id`, `medicine`, `dosage`, `instruction`) VALUES
(1, 16, 'sadfsafas', 'fasdfdsa', 'sdfdsafdas'),
(2, 16, 'asfsadfasdf', 'asdfasdf', 'asfdasdfsa'),
(3, 16, 'sfddsafdas', 'sdfsad', 'fasdfasdfas'),
(4, 33, 'sfsfsfs', 'fdsfs', 'sfds');

-- --------------------------------------------------------

--
-- Table structure for table `print_setting`
--

CREATE TABLE `print_setting` (
  `id` int(11) NOT NULL,
  `print_header` varchar(300) NOT NULL,
  `print_footer` varchar(200) NOT NULL,
  `setting_for` varchar(200) NOT NULL,
  `is_active` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `print_setting`
--

INSERT INTO `print_setting` (`id`, `print_header`, `print_footer`, `setting_for`, `is_active`) VALUES
(1, 'uploads/printing/1.jpg', '<p>ggdfgdsfgsd</p>', 'pharmacy', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `radio`
--

CREATE TABLE `radio` (
  `id` int(11) NOT NULL,
  `test_name` varchar(100) DEFAULT NULL,
  `short_name` varchar(100) DEFAULT NULL,
  `test_type` varchar(100) DEFAULT NULL,
  `radiology_category_id` varchar(11) NOT NULL,
  `sub_category` varchar(50) NOT NULL,
  `report_days` varchar(50) NOT NULL,
  `charge_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `radio`
--

INSERT INTO `radio` (`id`, `test_name`, `short_name`, `test_type`, `radiology_category_id`, `sub_category`, `report_days`, `charge_id`, `created_at`, `updated_at`) VALUES
(1, 'asfdsa', 'asdf', 'asdfas', '1', 'asdfas', '2', 1, '2019-08-27 08:54:53', '2019-08-27 08:54:53');

-- --------------------------------------------------------

--
-- Table structure for table `radiology_report`
--

CREATE TABLE `radiology_report` (
  `id` int(11) NOT NULL,
  `radiology_id` int(11) NOT NULL,
  `patient_id` varchar(11) DEFAULT NULL,
  `customer_type` varchar(50) DEFAULT NULL,
  `patient_name` varchar(100) DEFAULT NULL,
  `consultant_doctor` varchar(10) NOT NULL,
  `reporting_date` date DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `radiology_report` varchar(255) DEFAULT NULL,
  `apply_charge` float(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `read_notification`
--

CREATE TABLE `read_notification` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `parent_id` int(10) DEFAULT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `notification_id` int(11) DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `slug` varchar(150) DEFAULT NULL,
  `is_active` int(11) DEFAULT '0',
  `is_system` int(1) NOT NULL DEFAULT '0',
  `is_superadmin` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `is_active`, `is_system`, `is_superadmin`, `created_at`, `updated_at`) VALUES
(1, 'Admin', NULL, 0, 1, 0, '2018-12-25 11:49:43', '0000-00-00 00:00:00'),
(2, 'Accountant', NULL, 0, 1, 0, '2018-12-25 11:49:38', '0000-00-00 00:00:00'),
(3, 'Doctor', NULL, 0, 1, 0, '2018-07-21 10:37:36', '0000-00-00 00:00:00'),
(4, 'Head Nurse', NULL, 0, 1, 0, '2019-08-25 09:31:55', '0000-00-00 00:00:00'),
(5, 'Nurse', NULL, 0, 1, 0, '2019-08-25 09:32:01', '0000-00-00 00:00:00'),
(6, 'Laborant', NULL, 0, 1, 0, '2019-08-25 09:32:15', '0000-00-00 00:00:00'),
(7, 'Super Admin', NULL, 0, 1, 1, '2018-12-25 11:52:24', '0000-00-00 00:00:00'),
(8, 'Receptionist', NULL, 0, 1, 0, '2018-12-25 11:50:22', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `roles_permissions`
--

CREATE TABLE `roles_permissions` (
  `id` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `perm_cat_id` int(11) DEFAULT NULL,
  `can_view` int(11) DEFAULT NULL,
  `can_add` int(11) DEFAULT NULL,
  `can_edit` int(11) DEFAULT NULL,
  `can_delete` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles_permissions`
--

INSERT INTO `roles_permissions` (`id`, `role_id`, `perm_cat_id`, `can_view`, `can_add`, `can_edit`, `can_delete`, `created_at`) VALUES
(3, 1, 3, 1, 1, 1, 1, '2018-07-06 15:12:08'),
(4, 1, 4, 1, 1, 1, 1, '2018-07-06 15:13:01'),
(6, 1, 5, 1, 1, 0, 1, '2018-07-02 16:49:46'),
(8, 1, 7, 1, 1, 1, 1, '2018-07-06 15:13:29'),
(9, 1, 8, 1, 1, 1, 1, '2018-07-06 15:13:53'),
(10, 1, 17, 1, 1, 1, 1, '2018-07-06 15:18:56'),
(11, 1, 78, 1, 1, 1, 1, '2018-07-03 06:19:43'),
(13, 1, 69, 1, 1, 1, 1, '2018-07-06 15:14:15'),
(14, 1, 70, 1, 1, 1, 1, '2018-07-06 15:14:39'),
(23, 1, 12, 1, 1, 1, 1, '2018-07-06 15:15:38'),
(24, 1, 13, 1, 1, 1, 1, '2018-07-06 15:18:28'),
(26, 1, 15, 1, 1, 1, 0, '2018-07-02 16:54:21'),
(28, 1, 19, 1, 1, 1, 0, '2018-07-02 17:01:10'),
(29, 1, 20, 1, 1, 1, 1, '2018-07-06 15:19:50'),
(30, 1, 76, 1, 1, 1, 0, '2018-07-02 17:01:10'),
(31, 1, 21, 1, 1, 1, 0, '2018-07-02 17:01:38'),
(32, 1, 22, 1, 1, 1, 1, '2018-07-02 17:02:05'),
(33, 1, 23, 1, 1, 1, 1, '2018-07-06 15:20:17'),
(34, 1, 24, 1, 1, 1, 1, '2018-07-06 15:20:39'),
(35, 1, 25, 1, 1, 1, 1, '2018-07-06 15:22:35'),
(37, 1, 77, 1, 1, 1, 1, '2018-07-06 15:19:50'),
(43, 1, 32, 1, 1, 1, 1, '2018-07-06 15:52:05'),
(44, 1, 33, 1, 1, 1, 1, '2018-07-06 15:52:29'),
(45, 1, 34, 1, 1, 1, 1, '2018-07-06 15:53:59'),
(46, 1, 35, 1, 1, 1, 1, '2018-07-06 15:54:34'),
(47, 1, 104, 1, 1, 1, 1, '2018-07-06 15:53:08'),
(48, 1, 37, 1, 1, 1, 1, '2018-07-06 15:55:30'),
(49, 1, 38, 1, 1, 1, 1, '2018-07-09 10:45:27'),
(53, 1, 43, 1, 1, 1, 1, '2018-07-10 15:00:31'),
(58, 1, 52, 1, 1, 0, 1, '2018-07-09 08:49:43'),
(61, 1, 55, 1, 1, 1, 1, '2018-07-02 14:54:16'),
(67, 1, 61, 1, 1, 0, 1, '2018-07-09 11:29:19'),
(68, 1, 62, 1, 1, 0, 1, '2018-07-09 11:29:19'),
(69, 1, 63, 1, 1, 0, 1, '2018-07-09 09:21:38'),
(70, 1, 64, 1, 1, 1, 1, '2018-07-09 08:32:19'),
(71, 1, 65, 1, 1, 1, 1, '2018-07-09 08:41:21'),
(72, 1, 66, 1, 1, 1, 1, '2018-07-09 08:43:09'),
(73, 1, 67, 1, 1, 1, 1, '2018-07-09 08:44:47'),
(74, 1, 79, 1, 1, 0, 1, '2018-07-02 17:34:53'),
(75, 1, 80, 1, 1, 1, 1, '2018-07-06 15:11:23'),
(76, 1, 81, 1, 1, 1, 1, '2018-07-06 15:11:23'),
(78, 1, 83, 1, 1, 1, 1, '2018-07-06 15:11:23'),
(79, 1, 84, 1, 1, 1, 1, '2018-07-06 15:11:23'),
(80, 1, 85, 1, 1, 1, 1, '2018-07-12 05:46:00'),
(83, 1, 88, 1, 1, 1, 0, '2018-07-03 17:34:20'),
(87, 1, 92, 1, 1, 1, 1, '2018-06-26 09:03:43'),
(88, 1, 93, 1, 1, 1, 1, '2018-07-09 06:54:20'),
(94, 1, 82, 1, 1, 1, 1, '2018-07-06 15:11:23'),
(120, 1, 39, 1, 1, 1, 1, '2018-07-06 15:56:28'),
(140, 1, 110, 1, 1, 1, 1, '2018-07-06 15:25:08'),
(141, 1, 111, 1, 1, 1, 1, '2018-07-06 15:26:28'),
(142, 1, 112, 1, 1, 1, 1, '2018-07-06 15:26:28'),
(145, 1, 94, 1, 1, 0, 0, '2018-07-09 06:50:40'),
(147, 2, 43, 1, 1, 1, 1, '2018-06-30 13:16:24'),
(148, 2, 44, 1, 0, 0, 0, '2018-06-27 16:47:09'),
(149, 2, 46, 1, 0, 0, 0, '2018-06-28 05:56:41'),
(156, 1, 9, 1, 1, 1, 1, '2018-07-06 15:14:53'),
(157, 1, 10, 1, 1, 1, 1, '2018-07-06 15:15:12'),
(159, 1, 40, 1, 1, 1, 1, '2018-07-09 10:39:40'),
(160, 1, 41, 1, 1, 1, 1, '2018-07-06 15:57:09'),
(161, 1, 42, 1, 1, 1, 1, '2018-07-09 10:43:14'),
(169, 1, 27, 1, 1, 0, 1, '2018-07-02 17:06:58'),
(178, 1, 54, 1, 0, 1, 0, '2018-07-05 14:39:22'),
(179, 1, 56, 1, 0, 1, 0, '2018-07-05 14:39:22'),
(180, 1, 57, 1, 0, 1, 0, '2018-07-05 14:39:22'),
(181, 1, 58, 1, 0, 1, 0, '2018-07-05 14:39:22'),
(182, 1, 59, 1, 0, 1, 0, '2018-07-05 14:39:22'),
(183, 1, 60, 1, 0, 1, 0, '2018-07-05 14:39:22'),
(190, 1, 105, 1, 0, 0, 0, '2018-07-02 16:43:25'),
(193, 1, 6, 1, 0, 0, 0, '2018-07-02 16:49:46'),
(194, 1, 68, 1, 0, 0, 0, '2018-07-02 16:49:46'),
(196, 1, 72, 1, 0, 0, 0, '2018-07-02 16:49:46'),
(197, 1, 73, 1, 0, 0, 0, '2018-07-02 16:49:46'),
(198, 1, 74, 1, 0, 0, 0, '2018-07-02 16:49:46'),
(199, 1, 75, 1, 0, 0, 0, '2018-07-02 16:49:46'),
(201, 1, 14, 1, 0, 0, 0, '2018-07-02 16:52:03'),
(203, 1, 16, 1, 0, 0, 0, '2018-07-02 16:54:21'),
(204, 1, 26, 1, 0, 0, 0, '2018-07-02 17:02:05'),
(206, 1, 29, 1, 0, 0, 0, '2018-07-02 17:13:54'),
(207, 1, 30, 1, 0, 0, 0, '2018-07-02 17:13:54'),
(208, 1, 31, 1, 1, 0, 1, '2019-01-24 12:40:51'),
(215, 1, 50, 1, 0, 0, 0, '2018-07-02 17:34:53'),
(216, 1, 51, 1, 0, 0, 0, '2018-07-02 17:34:53'),
(222, 1, 1, 1, 1, 1, 1, '2018-07-10 15:00:31'),
(225, 1, 108, 1, 1, 1, 1, '2018-07-09 07:47:26'),
(227, 1, 91, 1, 0, 0, 0, '2018-07-03 07:19:27'),
(229, 1, 89, 1, 0, 0, 0, '2018-07-03 07:30:53'),
(230, 10, 53, 0, 1, 0, 0, '2018-07-03 09:22:55'),
(231, 10, 54, 0, 0, 1, 0, '2018-07-03 09:22:55'),
(232, 10, 55, 1, 1, 1, 1, '2018-07-03 09:28:42'),
(233, 10, 56, 0, 0, 1, 0, '2018-07-03 09:22:55'),
(235, 10, 58, 0, 0, 1, 0, '2018-07-03 09:22:55'),
(236, 10, 59, 0, 0, 1, 0, '2018-07-03 09:22:55'),
(239, 10, 1, 1, 1, 1, 1, '2018-07-03 09:46:43'),
(241, 10, 3, 1, 0, 0, 0, '2018-07-03 09:53:56'),
(242, 10, 2, 1, 0, 0, 0, '2018-07-03 09:54:39'),
(243, 10, 4, 1, 0, 1, 1, '2018-07-03 10:01:24'),
(245, 10, 107, 1, 0, 0, 0, '2018-07-03 10:06:41'),
(246, 10, 5, 1, 1, 0, 1, '2018-07-03 10:08:18'),
(247, 10, 7, 1, 1, 1, 1, '2018-07-03 10:12:07'),
(248, 10, 68, 1, 0, 0, 0, '2018-07-03 10:12:53'),
(249, 10, 69, 1, 1, 1, 1, '2018-07-03 10:19:46'),
(250, 10, 70, 1, 0, 0, 1, '2018-07-03 10:22:40'),
(251, 10, 72, 1, 0, 0, 0, '2018-07-03 10:26:46'),
(252, 10, 73, 1, 0, 0, 0, '2018-07-03 10:26:46'),
(253, 10, 74, 1, 0, 0, 0, '2018-07-03 10:28:34'),
(254, 10, 75, 1, 0, 0, 0, '2018-07-03 10:28:34'),
(255, 10, 9, 1, 1, 1, 1, '2018-07-03 10:32:22'),
(256, 10, 10, 1, 1, 1, 1, '2018-07-03 10:33:09'),
(257, 10, 11, 1, 0, 0, 0, '2018-07-03 10:33:09'),
(258, 10, 12, 1, 1, 1, 1, '2018-07-03 10:38:40'),
(259, 10, 13, 1, 1, 1, 1, '2018-07-03 10:38:40'),
(260, 10, 14, 1, 0, 0, 0, '2018-07-03 10:38:53'),
(261, 10, 15, 1, 1, 1, 0, '2018-07-03 10:41:28'),
(262, 10, 16, 1, 0, 0, 0, '2018-07-03 10:42:12'),
(263, 10, 17, 1, 1, 1, 1, '2018-07-03 10:44:30'),
(264, 10, 19, 1, 1, 1, 0, '2018-07-03 10:45:45'),
(265, 10, 20, 1, 1, 1, 1, '2018-07-03 10:48:51'),
(266, 10, 76, 1, 0, 0, 0, '2018-07-03 10:51:21'),
(267, 10, 21, 1, 1, 1, 0, '2018-07-03 10:52:45'),
(268, 10, 22, 1, 1, 1, 1, '2018-07-03 10:55:00'),
(269, 10, 23, 1, 1, 1, 1, '2018-07-03 10:57:16'),
(270, 10, 24, 1, 1, 1, 1, '2018-07-03 10:57:49'),
(271, 10, 25, 1, 1, 1, 1, '2018-07-03 10:57:49'),
(272, 10, 26, 1, 0, 0, 0, '2018-07-03 10:58:25'),
(273, 10, 77, 1, 1, 1, 1, '2018-07-03 10:59:57'),
(274, 10, 27, 1, 1, 0, 1, '2018-07-03 11:00:36'),
(275, 10, 28, 1, 1, 1, 1, '2018-07-03 11:03:09'),
(276, 10, 29, 1, 0, 0, 0, '2018-07-03 11:04:03'),
(277, 10, 30, 1, 0, 0, 0, '2018-07-03 11:04:03'),
(278, 10, 31, 1, 0, 0, 0, '2018-07-03 11:04:03'),
(279, 10, 32, 1, 1, 1, 1, '2018-07-03 11:05:42'),
(280, 10, 33, 1, 1, 1, 1, '2018-07-03 11:06:32'),
(281, 10, 34, 1, 1, 1, 1, '2018-07-03 11:08:03'),
(282, 10, 35, 1, 1, 1, 1, '2018-07-03 11:08:41'),
(283, 10, 104, 1, 1, 1, 1, '2018-07-03 11:10:43'),
(284, 10, 37, 1, 1, 1, 1, '2018-07-03 11:12:42'),
(285, 10, 38, 1, 1, 1, 1, '2018-07-03 11:13:56'),
(286, 10, 39, 1, 1, 1, 1, '2018-07-03 11:15:39'),
(287, 10, 40, 1, 1, 1, 1, '2018-07-03 11:17:22'),
(288, 10, 41, 1, 1, 1, 1, '2018-07-03 11:18:54'),
(289, 10, 42, 1, 1, 1, 1, '2018-07-03 11:19:31'),
(290, 10, 43, 1, 1, 1, 1, '2018-07-03 11:21:15'),
(291, 10, 44, 1, 0, 0, 0, '2018-07-03 11:22:06'),
(292, 10, 46, 1, 0, 0, 0, '2018-07-03 11:22:06'),
(293, 10, 50, 1, 0, 0, 0, '2018-07-03 11:22:59'),
(294, 10, 51, 1, 0, 0, 0, '2018-07-03 11:22:59'),
(295, 10, 60, 0, 0, 1, 0, '2018-07-03 11:25:05'),
(296, 10, 61, 1, 1, 1, 1, '2018-07-03 11:26:52'),
(297, 10, 62, 1, 1, 1, 1, '2018-07-03 11:28:53'),
(298, 10, 63, 1, 1, 0, 0, '2018-07-03 11:29:37'),
(299, 10, 64, 1, 1, 1, 1, '2018-07-03 11:30:27'),
(300, 10, 65, 1, 1, 1, 1, '2018-07-03 11:32:51'),
(301, 10, 66, 1, 1, 1, 1, '2018-07-03 11:32:51'),
(302, 10, 67, 1, 0, 0, 0, '2018-07-03 11:32:51'),
(303, 10, 78, 1, 1, 1, 1, '2018-07-04 09:40:04'),
(307, 1, 126, 1, 0, 0, 0, '2018-07-03 14:56:13'),
(310, 1, 119, 1, 0, 0, 0, '2018-07-03 15:45:00'),
(311, 1, 120, 1, 0, 0, 0, '2018-07-03 15:45:00'),
(312, 1, 107, 1, 0, 0, 0, '2018-07-03 15:45:12'),
(313, 1, 122, 1, 0, 0, 0, '2018-07-03 15:49:37'),
(315, 1, 123, 1, 0, 0, 0, '2018-07-03 15:57:03'),
(317, 1, 124, 1, 0, 0, 0, '2018-07-03 15:59:14'),
(320, 1, 47, 1, 0, 0, 0, '2018-07-03 16:31:12'),
(321, 1, 121, 1, 0, 0, 0, '2018-07-03 16:31:12'),
(322, 1, 109, 1, 1, 1, 1, '2018-07-03 16:40:54'),
(369, 1, 102, 1, 1, 1, 1, '2018-07-11 17:31:47'),
(372, 10, 79, 1, 1, 0, 0, '2018-07-04 09:40:04'),
(373, 10, 80, 1, 1, 1, 1, '2018-07-04 09:53:09'),
(374, 10, 81, 1, 1, 1, 1, '2018-07-04 09:53:50'),
(375, 10, 82, 1, 1, 1, 1, '2018-07-04 09:56:54'),
(376, 10, 83, 1, 1, 1, 1, '2018-07-04 09:57:55'),
(377, 10, 84, 1, 1, 1, 1, '2018-07-04 10:00:26'),
(378, 10, 85, 1, 1, 1, 1, '2018-07-04 10:02:54'),
(379, 10, 86, 1, 1, 1, 1, '2018-07-04 10:16:18'),
(380, 10, 87, 1, 0, 0, 0, '2018-07-04 10:19:49'),
(381, 10, 88, 1, 1, 1, 0, '2018-07-04 10:21:20'),
(382, 10, 89, 1, 0, 0, 0, '2018-07-04 10:21:51'),
(383, 10, 90, 1, 1, 0, 1, '2018-07-04 10:25:01'),
(384, 10, 91, 1, 0, 0, 0, '2018-07-04 10:25:01'),
(385, 10, 108, 1, 1, 1, 1, '2018-07-04 10:27:46'),
(386, 10, 109, 1, 1, 1, 1, '2018-07-04 10:28:26'),
(387, 10, 110, 1, 1, 1, 1, '2018-07-04 10:32:43'),
(388, 10, 111, 1, 1, 1, 1, '2018-07-04 10:33:21'),
(389, 10, 112, 1, 1, 1, 1, '2018-07-04 10:35:06'),
(390, 10, 127, 1, 0, 0, 0, '2018-07-04 10:35:06'),
(391, 10, 93, 1, 1, 1, 1, '2018-07-04 10:37:14'),
(392, 10, 94, 1, 1, 0, 0, '2018-07-04 10:38:02'),
(394, 10, 95, 1, 0, 0, 0, '2018-07-04 10:38:44'),
(395, 10, 102, 1, 1, 1, 1, '2018-07-04 10:41:02'),
(396, 10, 106, 1, 0, 0, 0, '2018-07-04 10:41:39'),
(397, 10, 113, 1, 0, 0, 0, '2018-07-04 10:42:37'),
(398, 10, 114, 1, 0, 0, 0, '2018-07-04 10:42:37'),
(399, 10, 115, 1, 0, 0, 0, '2018-07-04 10:48:45'),
(400, 10, 116, 1, 0, 0, 0, '2018-07-04 10:48:45'),
(401, 10, 117, 1, 0, 0, 0, '2018-07-04 10:49:43'),
(402, 10, 118, 1, 0, 0, 0, '2018-07-04 10:49:43'),
(411, 1, 2, 1, 0, 0, 0, '2018-07-04 13:46:10'),
(412, 1, 11, 1, 0, 0, 0, '2018-07-04 14:24:05'),
(416, 2, 3, 1, 1, 1, 1, '2018-07-10 12:17:12'),
(428, 2, 4, 1, 1, 1, 1, '2018-07-05 07:40:38'),
(432, 1, 128, 0, 1, 0, 1, '2018-07-05 13:39:50'),
(434, 1, 125, 1, 0, 0, 0, '2018-07-06 15:29:26'),
(435, 1, 96, 1, 1, 1, 1, '2018-07-09 06:33:54'),
(437, 1, 98, 1, 1, 1, 1, '2018-07-09 06:44:17'),
(444, 1, 99, 1, 0, 0, 0, '2018-07-06 17:11:22'),
(445, 1, 48, 1, 0, 0, 0, '2018-07-06 17:19:35'),
(446, 1, 49, 1, 0, 0, 0, '2018-07-06 17:19:35'),
(448, 1, 71, 1, 0, 0, 0, '2018-07-08 09:17:06'),
(453, 1, 106, 1, 0, 0, 0, '2018-07-09 06:17:33'),
(454, 1, 113, 1, 0, 0, 0, '2018-07-09 06:17:33'),
(455, 1, 114, 1, 0, 0, 0, '2018-07-09 06:17:33'),
(456, 1, 115, 1, 0, 0, 0, '2018-07-09 06:17:33'),
(457, 1, 116, 1, 0, 0, 0, '2018-07-09 06:17:33'),
(458, 1, 117, 1, 0, 0, 0, '2018-07-09 06:17:33'),
(459, 1, 118, 1, 0, 0, 0, '2018-07-09 06:17:33'),
(461, 1, 97, 1, 0, 0, 0, '2018-07-09 06:30:16'),
(462, 1, 95, 1, 0, 0, 0, '2018-07-09 06:48:41'),
(464, 1, 86, 1, 1, 1, 1, '2018-07-09 11:39:48'),
(466, 1, 129, 0, 1, 0, 1, '2018-07-09 07:09:30'),
(467, 1, 87, 1, 0, 0, 0, '2018-07-09 07:11:59'),
(468, 1, 90, 1, 1, 0, 1, '2018-07-09 07:22:50'),
(471, 1, 53, 0, 1, 0, 0, '2018-07-09 08:50:44'),
(474, 1, 130, 1, 1, 0, 1, '2018-07-09 16:26:36'),
(476, 1, 131, 1, 0, 0, 0, '2018-07-09 10:23:32'),
(477, 2, 1, 1, 1, 1, 1, '2018-07-11 12:26:27'),
(478, 2, 2, 1, 0, 0, 0, '2018-07-10 12:17:12'),
(479, 2, 47, 1, 0, 0, 0, '2018-07-10 12:17:12'),
(480, 2, 105, 1, 0, 0, 0, '2018-07-10 12:17:12'),
(482, 2, 119, 1, 0, 0, 0, '2018-07-10 12:17:12'),
(483, 2, 120, 1, 0, 0, 0, '2018-07-10 12:17:12'),
(485, 2, 15, 1, 1, 1, 0, '2018-07-10 12:17:12'),
(486, 2, 16, 1, 0, 0, 0, '2018-07-10 12:17:12'),
(487, 2, 122, 1, 0, 0, 0, '2018-07-10 12:17:12'),
(492, 2, 21, 1, 0, 0, 0, '2018-07-12 05:50:27'),
(493, 2, 22, 1, 0, 0, 0, '2018-07-12 05:50:27'),
(494, 2, 23, 1, 0, 0, 0, '2018-07-12 05:50:27'),
(495, 2, 24, 1, 0, 0, 0, '2018-07-12 05:50:27'),
(496, 2, 25, 1, 0, 0, 0, '2018-07-12 05:50:27'),
(498, 2, 77, 1, 0, 0, 0, '2018-07-12 05:50:27'),
(499, 2, 27, 1, 1, 0, 1, '2018-07-10 12:17:12'),
(502, 2, 93, 1, 1, 1, 1, '2018-07-10 12:17:12'),
(503, 2, 94, 1, 1, 0, 0, '2018-07-10 12:17:12'),
(504, 2, 95, 1, 0, 0, 0, '2018-07-10 12:17:12'),
(505, 3, 5, 1, 1, 0, 1, '2018-07-10 12:37:30'),
(506, 3, 6, 1, 0, 0, 0, '2018-07-10 12:37:30'),
(507, 3, 7, 1, 1, 1, 1, '2018-07-10 12:37:30'),
(508, 3, 8, 1, 1, 1, 1, '2018-07-10 12:37:30'),
(509, 3, 68, 1, 0, 0, 0, '2018-07-10 12:37:30'),
(510, 3, 69, 1, 1, 1, 1, '2018-07-10 12:37:30'),
(511, 3, 70, 1, 1, 1, 1, '2018-07-10 12:37:30'),
(512, 3, 71, 1, 0, 0, 0, '2018-07-10 12:37:30'),
(513, 3, 72, 1, 0, 0, 0, '2018-07-10 12:37:30'),
(514, 3, 73, 1, 0, 0, 0, '2018-07-10 12:37:30'),
(515, 3, 74, 1, 0, 0, 0, '2018-07-10 12:37:30'),
(517, 3, 75, 1, 0, 0, 0, '2018-07-10 12:40:38'),
(524, 3, 86, 1, 0, 0, 0, '2019-01-24 13:03:16'),
(531, 3, 109, 1, 1, 1, 1, '2018-12-19 16:33:55'),
(546, 3, 37, 1, 1, 1, 1, '2018-07-10 12:52:17'),
(547, 3, 38, 1, 1, 1, 1, '2018-07-10 12:52:17'),
(548, 3, 39, 1, 1, 1, 1, '2018-07-10 12:52:17'),
(549, 3, 124, 1, 0, 0, 0, '2018-07-10 12:52:17'),
(553, 6, 78, 1, 1, 1, 1, '2018-07-10 13:02:18'),
(554, 6, 79, 1, 1, 0, 1, '2018-07-10 13:02:18'),
(555, 6, 80, 1, 1, 1, 1, '2018-07-10 13:02:18'),
(556, 6, 81, 1, 1, 1, 1, '2018-07-10 13:02:18'),
(557, 6, 82, 1, 1, 1, 1, '2018-07-10 13:02:18'),
(558, 6, 83, 1, 1, 1, 1, '2018-07-10 13:02:18'),
(559, 6, 84, 1, 1, 1, 1, '2018-07-10 13:02:18'),
(560, 6, 85, 1, 1, 1, 1, '2018-07-10 13:02:18'),
(561, 6, 86, 1, 0, 0, 0, '2018-07-10 13:11:10'),
(574, 6, 43, 1, 1, 1, 1, '2018-07-10 13:05:33'),
(575, 6, 44, 1, 0, 0, 0, '2018-07-10 13:05:33'),
(576, 6, 46, 1, 0, 0, 0, '2018-07-10 13:05:33'),
(578, 6, 102, 1, 1, 1, 1, '2018-07-10 13:20:33'),
(579, 4, 28, 1, 1, 1, 1, '2018-07-10 13:23:54'),
(580, 4, 29, 1, 0, 0, 0, '2018-07-10 13:23:54'),
(581, 4, 30, 1, 0, 0, 0, '2018-07-10 13:23:54'),
(582, 4, 123, 1, 0, 0, 0, '2018-07-10 13:23:54'),
(583, 4, 86, 1, 0, 0, 0, '2018-07-10 13:24:13'),
(584, 4, 43, 1, 1, 1, 1, '2018-07-10 13:25:14'),
(585, 4, 44, 1, 0, 0, 0, '2018-07-10 13:25:14'),
(586, 4, 46, 1, 0, 0, 0, '2018-07-10 13:25:14'),
(588, 2, 102, 1, 1, 1, 1, '2018-07-12 05:47:45'),
(589, 2, 106, 1, 0, 0, 0, '2018-07-10 13:25:37'),
(590, 2, 117, 1, 0, 0, 0, '2018-07-10 13:25:37'),
(591, 3, 40, 1, 1, 1, 1, '2018-07-10 13:28:12'),
(592, 3, 41, 1, 1, 1, 1, '2018-07-10 13:28:12'),
(593, 3, 42, 1, 1, 1, 1, '2018-07-10 13:28:12'),
(594, 3, 125, 1, 0, 0, 0, '2018-07-10 13:28:12'),
(596, 3, 49, 1, 0, 0, 0, '2018-07-10 13:28:12'),
(598, 3, 106, 1, 0, 0, 0, '2018-07-10 13:28:12'),
(599, 3, 113, 1, 0, 0, 0, '2018-07-10 13:28:12'),
(600, 3, 114, 1, 0, 0, 0, '2018-07-10 13:28:12'),
(601, 3, 115, 1, 0, 0, 0, '2018-07-10 13:28:12'),
(602, 3, 116, 1, 0, 0, 0, '2018-07-10 13:28:12'),
(603, 3, 117, 1, 0, 0, 0, '2018-07-10 13:28:12'),
(609, 6, 117, 1, 0, 0, 0, '2018-07-10 13:30:48'),
(611, 2, 86, 1, 1, 1, 1, '2019-01-24 12:51:02'),
(612, 1, 44, 1, 0, 0, 0, '2018-07-10 15:00:31'),
(613, 1, 46, 1, 0, 0, 0, '2018-07-10 15:00:31'),
(616, 1, 127, 1, 0, 0, 0, '2018-07-11 08:22:46'),
(617, 2, 17, 1, 1, 1, 1, '2018-07-11 12:25:14'),
(618, 2, 19, 1, 1, 1, 0, '2018-07-11 12:25:14'),
(619, 2, 20, 1, 1, 1, 1, '2018-07-11 12:25:14'),
(620, 2, 76, 1, 1, 1, 0, '2018-07-11 12:25:14'),
(621, 2, 107, 1, 0, 0, 0, '2018-07-11 12:26:27'),
(622, 2, 121, 1, 0, 0, 0, '2018-07-11 12:26:27'),
(623, 2, 128, 0, 1, 0, 1, '2018-07-11 12:26:27'),
(625, 1, 28, 1, 1, 1, 1, '2018-07-11 14:57:18'),
(626, 6, 1, 1, 0, 0, 0, '2018-07-12 05:53:47'),
(627, 6, 21, 1, 0, 0, 0, '2018-07-12 05:53:47'),
(628, 6, 22, 1, 0, 0, 0, '2018-07-12 05:53:47'),
(629, 6, 23, 1, 0, 0, 0, '2018-07-12 05:53:47'),
(630, 6, 24, 1, 0, 0, 0, '2018-07-12 05:53:47'),
(631, 6, 25, 1, 0, 0, 0, '2018-07-12 05:53:47'),
(632, 6, 77, 1, 0, 0, 0, '2018-07-12 05:53:47'),
(633, 6, 106, 1, 0, 0, 0, '2018-07-12 05:53:47'),
(634, 4, 102, 1, 1, 1, 1, '2018-07-12 05:54:23'),
(635, 4, 106, 1, 0, 0, 0, '2018-07-12 05:54:23'),
(636, 4, 117, 1, 0, 0, 0, '2018-07-12 05:54:23'),
(637, 1, 132, 1, 1, 1, 1, '2018-10-11 12:53:43'),
(638, 1, 133, 1, 1, 1, 1, '2018-10-11 13:27:42'),
(639, 1, 134, 1, 1, 1, 1, '2018-10-11 11:16:33'),
(640, 1, 135, 1, 1, 1, 1, '2018-10-11 11:16:33'),
(641, 1, 136, 1, 1, 1, 1, '2018-10-11 11:16:33'),
(642, 1, 137, 1, 1, 1, 1, '2018-10-11 13:27:42'),
(643, 1, 138, 1, 1, 1, 1, '2018-11-23 08:11:36'),
(644, 1, 139, 1, 1, 1, 1, '2018-10-11 13:27:42'),
(645, 1, 140, 1, 1, 1, 1, '2018-10-13 05:58:05'),
(646, 1, 141, 1, 1, 1, 1, '2018-11-23 08:13:00'),
(647, 1, 142, 1, 1, 1, 1, '2018-11-23 08:13:00'),
(648, 1, 143, 1, 1, 1, 1, '2018-11-23 08:13:00'),
(649, 1, 144, 1, 1, 1, 1, '2018-11-23 08:13:00'),
(650, 1, 145, 1, 1, 1, 1, '2018-11-23 08:13:00'),
(651, 1, 149, 1, 1, 1, 1, '2018-10-30 13:24:55'),
(652, 1, 150, 1, 1, 1, 1, '2018-10-30 13:24:55'),
(653, 1, 151, 1, 1, 1, 1, '2018-10-30 13:24:55'),
(654, 1, 173, 1, 1, 1, 1, '2018-11-23 09:08:40'),
(656, 1, 176, 1, 1, 1, 1, '2018-11-03 12:37:26'),
(657, 1, 174, 1, 1, 1, 1, '2018-11-03 12:43:18'),
(658, 1, 155, 1, 0, 0, 0, '2018-11-23 08:29:28'),
(659, 1, 156, 1, 0, 0, 0, '2018-11-23 08:29:28'),
(660, 1, 157, 1, 0, 0, 0, '2018-11-23 08:29:28'),
(661, 1, 158, 1, 0, 0, 0, '2018-11-23 08:29:28'),
(662, 1, 159, 1, 0, 0, 0, '2018-11-23 08:29:28'),
(663, 1, 160, 1, 0, 0, 0, '2018-11-23 08:29:28'),
(664, 1, 161, 1, 0, 0, 0, '2018-11-23 08:29:28'),
(665, 1, 162, 1, 0, 0, 0, '2018-11-23 08:29:28'),
(666, 1, 172, 1, 0, 0, 0, '2018-11-23 08:29:28'),
(667, 1, 146, 1, 1, 1, 1, '2019-01-24 12:40:26'),
(668, 1, 147, 1, 1, 1, 1, '2019-01-24 12:40:26'),
(669, 1, 148, 1, 1, 1, 1, '2019-01-24 12:40:26'),
(670, 1, 170, 1, 1, 1, 1, '2019-01-24 12:40:26'),
(671, 1, 175, 1, 1, 1, 1, '2019-01-24 12:40:26'),
(672, 1, 152, 1, 1, 1, 1, '2019-01-24 12:40:26'),
(673, 1, 153, 1, 1, 1, 1, '2019-01-24 12:40:26'),
(674, 1, 154, 1, 0, 0, 0, '2018-11-23 08:29:28'),
(675, 1, 171, 1, 1, 1, 1, '2019-01-24 12:40:26'),
(676, 1, 163, 1, 1, 1, 1, '2019-01-24 12:40:26'),
(677, 1, 164, 1, 1, 1, 1, '2019-01-24 12:40:26'),
(678, 1, 165, 1, 1, 1, 1, '2019-01-24 12:40:26'),
(679, 1, 166, 1, 1, 1, 1, '2019-01-24 12:40:26'),
(680, 1, 167, 1, 1, 1, 1, '2019-01-24 12:40:26'),
(681, 1, 168, 1, 1, 1, 1, '2019-01-24 12:40:26'),
(682, 1, 169, 1, 1, 1, 1, '2019-01-24 12:40:26'),
(683, 2, 189, 1, 0, 0, 0, '2018-12-12 15:40:40'),
(695, 3, 138, 1, 1, 1, 1, '2018-12-21 14:19:27'),
(696, 3, 139, 1, 1, 1, 1, '2018-12-21 14:19:27'),
(707, 3, 43, 1, 1, 1, 1, '2019-01-24 13:08:17'),
(710, 3, 48, 1, 0, 0, 0, '2018-12-18 14:16:15'),
(711, 3, 178, 1, 0, 0, 0, '2018-12-18 14:30:20'),
(715, 3, 182, 1, 0, 0, 0, '2018-12-18 14:31:23'),
(740, 3, 204, 1, 1, 1, 1, '2018-12-19 15:33:48'),
(751, 3, 205, 1, 0, 0, 0, '2018-12-19 15:33:48'),
(752, 3, 27, 1, 1, 0, 1, '2019-01-24 13:08:17'),
(756, 3, 118, 1, 0, 0, 0, '2018-12-20 14:35:13'),
(757, 3, 155, 1, 0, 0, 0, '2018-12-20 14:42:12'),
(758, 3, 156, 1, 0, 0, 0, '2018-12-20 14:42:12'),
(762, 3, 160, 1, 0, 0, 0, '2018-12-20 14:42:12'),
(764, 3, 162, 1, 0, 0, 0, '2018-12-20 14:42:12'),
(767, 3, 190, 1, 0, 0, 0, '2018-12-20 14:48:58'),
(778, 3, 102, 1, 1, 1, 1, '2018-12-21 15:00:37'),
(779, 3, 132, 1, 1, 1, 1, '2018-12-22 16:43:56'),
(780, 3, 135, 1, 1, 1, 1, '2018-12-22 16:43:56'),
(781, 3, 136, 1, 1, 1, 1, '2018-12-22 16:43:56'),
(782, 3, 137, 1, 1, 1, 1, '2018-12-22 16:43:56'),
(785, 3, 134, 1, 1, 1, 1, '2018-12-22 16:43:56'),
(786, 3, 133, 1, 1, 1, 1, '2018-12-22 16:43:56'),
(787, 3, 140, 1, 1, 1, 1, '2018-12-21 14:26:05'),
(788, 3, 141, 1, 1, 1, 1, '2018-12-21 14:59:53'),
(789, 3, 142, 1, 1, 1, 1, '2018-12-21 14:59:53'),
(790, 3, 143, 1, 1, 1, 1, '2018-12-21 14:59:53'),
(791, 3, 144, 1, 1, 1, 1, '2018-12-21 14:59:53'),
(792, 3, 145, 1, 1, 1, 1, '2018-12-21 14:59:53'),
(799, 3, 194, 1, 0, 0, 0, '2018-12-21 14:43:10'),
(802, 3, 127, 1, 0, 0, 0, '2018-12-21 15:00:37'),
(805, 3, 198, 1, 0, 0, 0, '2018-12-21 15:36:07'),
(821, 3, 163, 1, 1, 1, 1, '2018-12-22 15:13:55'),
(822, 3, 164, 1, 1, 1, 1, '2018-12-22 15:13:55'),
(824, 3, 166, 1, 1, 1, 1, '2018-12-22 15:18:30'),
(825, 3, 167, 1, 0, 0, 0, '2019-01-24 13:03:16'),
(834, 1, 192, 1, 1, 1, 1, '2019-01-24 12:40:26'),
(835, 1, 193, 1, 0, 0, 0, '2019-01-24 12:40:26'),
(836, 1, 194, 1, 0, 0, 0, '2019-01-24 12:40:26'),
(837, 1, 195, 1, 0, 0, 0, '2019-01-24 12:40:26'),
(838, 1, 196, 1, 1, 1, 1, '2019-01-24 12:40:26'),
(839, 1, 197, 1, 1, 1, 1, '2019-01-24 12:40:26'),
(840, 1, 198, 1, 0, 0, 0, '2019-01-24 12:40:26'),
(841, 1, 200, 1, 1, 0, 1, '2019-01-24 12:40:26'),
(842, 1, 201, 1, 1, 1, 1, '2019-01-24 12:40:26'),
(843, 1, 202, 1, 1, 0, 1, '2019-01-24 12:40:26'),
(844, 1, 203, 1, 1, 1, 1, '2019-01-24 12:40:26'),
(845, 1, 204, 1, 1, 1, 1, '2019-01-24 12:40:26'),
(846, 1, 205, 1, 0, 0, 0, '2019-01-24 12:40:26'),
(847, 1, 178, 1, 0, 0, 0, '2019-01-24 12:40:51'),
(848, 1, 179, 1, 0, 0, 0, '2019-01-24 12:40:51'),
(849, 1, 180, 1, 0, 0, 0, '2019-01-24 12:40:51'),
(850, 1, 181, 1, 0, 0, 0, '2019-01-24 12:40:51'),
(851, 1, 182, 1, 0, 0, 0, '2019-01-24 12:40:51'),
(852, 1, 183, 1, 0, 0, 0, '2019-01-24 12:40:51'),
(853, 1, 184, 1, 0, 0, 0, '2019-01-24 12:40:51'),
(854, 1, 185, 1, 0, 0, 0, '2019-01-24 12:40:51'),
(855, 1, 186, 1, 0, 0, 0, '2019-01-24 12:40:51'),
(856, 1, 187, 1, 0, 0, 0, '2019-01-24 12:40:51'),
(857, 1, 188, 1, 0, 0, 0, '2019-01-24 12:40:51'),
(858, 1, 189, 1, 0, 0, 0, '2019-01-24 12:40:51'),
(859, 1, 190, 1, 0, 0, 0, '2019-01-24 12:40:51'),
(860, 1, 191, 1, 0, 0, 0, '2019-01-24 12:40:51'),
(861, 2, 132, 1, 1, 1, 0, '2019-01-24 12:51:02'),
(862, 2, 133, 1, 1, 1, 0, '2019-01-24 12:51:02'),
(863, 2, 135, 1, 1, 1, 0, '2019-01-24 12:51:02'),
(864, 2, 138, 1, 1, 1, 0, '2019-01-24 12:51:02'),
(865, 2, 139, 1, 1, 1, 0, '2019-01-24 12:51:02'),
(866, 2, 143, 1, 1, 1, 1, '2019-01-24 12:51:02'),
(867, 2, 144, 1, 1, 1, 1, '2019-01-24 12:51:02'),
(868, 2, 145, 1, 1, 1, 1, '2019-01-24 12:51:02'),
(869, 2, 193, 1, 0, 0, 0, '2019-01-24 12:51:02'),
(870, 2, 194, 1, 0, 0, 0, '2019-01-24 12:51:02'),
(871, 2, 195, 1, 0, 0, 0, '2019-01-24 12:51:02'),
(872, 2, 196, 1, 1, 1, 1, '2019-01-24 12:51:02'),
(873, 2, 198, 1, 0, 0, 0, '2019-01-24 12:51:02'),
(874, 2, 148, 1, 0, 0, 0, '2019-01-24 12:51:02'),
(875, 2, 149, 1, 0, 0, 0, '2019-01-24 12:51:02'),
(876, 2, 150, 1, 0, 0, 0, '2019-01-24 12:51:02'),
(877, 2, 152, 1, 0, 0, 0, '2019-01-24 12:51:02'),
(878, 2, 153, 1, 0, 0, 0, '2019-01-24 12:51:02'),
(879, 2, 163, 1, 1, 1, 0, '2019-01-24 12:51:02'),
(880, 2, 167, 1, 0, 0, 0, '2019-01-24 12:51:02'),
(881, 2, 168, 1, 0, 0, 0, '2019-01-24 12:51:02'),
(882, 2, 173, 1, 1, 1, 1, '2019-01-24 12:51:02'),
(883, 2, 174, 1, 1, 1, 1, '2019-01-24 12:51:02'),
(884, 2, 9, 1, 1, 1, 1, '2019-01-24 12:51:02'),
(885, 2, 10, 1, 1, 1, 1, '2019-01-24 12:51:02'),
(886, 2, 11, 1, 0, 0, 0, '2019-01-24 12:51:02'),
(887, 2, 176, 1, 1, 1, 1, '2019-01-24 12:51:02'),
(888, 2, 203, 1, 1, 1, 1, '2019-01-24 12:51:02'),
(889, 2, 12, 1, 1, 1, 1, '2019-01-24 12:51:02'),
(890, 2, 13, 1, 1, 1, 1, '2019-01-24 12:51:02'),
(891, 2, 14, 1, 0, 0, 0, '2019-01-24 12:51:02'),
(892, 2, 165, 1, 1, 1, 0, '2019-01-24 12:51:02'),
(893, 2, 166, 1, 0, 0, 0, '2019-01-24 12:51:02'),
(894, 2, 204, 1, 1, 1, 1, '2019-01-24 12:51:02'),
(895, 2, 205, 1, 0, 0, 0, '2019-01-24 12:51:02'),
(896, 2, 87, 1, 0, 0, 0, '2019-01-24 12:51:02'),
(897, 2, 88, 1, 1, 1, 0, '2019-01-24 12:51:02'),
(898, 2, 89, 1, 0, 0, 0, '2019-01-24 12:51:02'),
(899, 2, 90, 1, 1, 0, 1, '2019-01-24 12:51:02'),
(900, 2, 91, 1, 0, 0, 0, '2019-01-24 12:51:02'),
(901, 2, 108, 1, 1, 1, 1, '2019-01-24 12:51:02'),
(902, 2, 109, 1, 1, 1, 1, '2019-01-24 12:51:02'),
(903, 2, 110, 1, 1, 1, 1, '2019-01-24 12:51:02'),
(904, 2, 111, 1, 1, 1, 1, '2019-01-24 12:51:02'),
(905, 2, 112, 1, 1, 1, 1, '2019-01-24 12:51:02'),
(906, 2, 127, 1, 0, 0, 0, '2019-01-24 12:51:02'),
(907, 2, 129, 0, 1, 0, 1, '2019-01-24 12:51:02'),
(908, 2, 31, 1, 1, 0, 1, '2019-01-24 12:51:02'),
(909, 2, 32, 1, 1, 1, 1, '2019-01-24 12:51:02'),
(910, 2, 33, 1, 1, 1, 1, '2019-01-24 12:51:02'),
(911, 2, 34, 1, 1, 1, 1, '2019-01-24 12:51:02'),
(912, 2, 35, 1, 1, 1, 1, '2019-01-24 12:51:02'),
(913, 2, 104, 1, 1, 1, 1, '2019-01-24 12:51:02'),
(914, 2, 48, 1, 0, 0, 0, '2019-01-24 12:51:02'),
(915, 2, 178, 1, 0, 0, 0, '2019-01-24 12:51:02'),
(916, 2, 179, 1, 0, 0, 0, '2019-01-24 12:51:02'),
(917, 2, 180, 1, 0, 0, 0, '2019-01-24 12:51:02'),
(918, 2, 181, 1, 0, 0, 0, '2019-01-24 12:51:02'),
(919, 2, 182, 1, 0, 0, 0, '2019-01-24 12:51:02'),
(920, 2, 184, 1, 0, 0, 0, '2019-01-24 12:51:02'),
(921, 2, 185, 1, 0, 0, 0, '2019-01-24 12:51:02'),
(922, 2, 186, 1, 0, 0, 0, '2019-01-24 12:51:02'),
(923, 2, 188, 1, 0, 0, 0, '2019-01-24 12:51:02'),
(924, 2, 118, 1, 0, 0, 0, '2019-01-24 12:51:02'),
(925, 2, 155, 1, 0, 0, 0, '2019-01-24 12:51:02'),
(926, 2, 156, 1, 0, 0, 0, '2019-01-24 12:51:02'),
(927, 2, 157, 1, 0, 0, 0, '2019-01-24 12:51:02'),
(928, 2, 158, 1, 0, 0, 0, '2019-01-24 12:51:02'),
(929, 2, 159, 1, 0, 0, 0, '2019-01-24 12:51:02'),
(930, 2, 160, 1, 0, 0, 0, '2019-01-24 12:51:02'),
(931, 2, 161, 1, 0, 0, 0, '2019-01-24 12:51:02'),
(932, 2, 162, 1, 0, 0, 0, '2019-01-24 12:51:02'),
(933, 2, 190, 1, 0, 0, 0, '2019-01-24 12:51:02'),
(934, 2, 191, 1, 0, 0, 0, '2019-01-24 12:51:02'),
(935, 4, 146, 1, 1, 1, 1, '2019-01-24 13:05:35'),
(936, 4, 147, 1, 1, 1, 1, '2019-01-24 13:05:35'),
(937, 4, 148, 1, 1, 1, 1, '2019-01-24 13:05:35'),
(938, 4, 170, 1, 1, 1, 1, '2019-01-24 13:05:35'),
(939, 4, 200, 1, 1, 0, 1, '2019-01-24 13:05:35'),
(940, 4, 179, 1, 0, 0, 0, '2019-01-24 13:05:35'),
(941, 4, 118, 1, 0, 0, 0, '2019-01-24 13:05:35'),
(942, 4, 157, 1, 0, 0, 0, '2019-01-24 13:05:35'),
(943, 3, 44, 1, 0, 0, 0, '2019-01-24 13:08:17'),
(944, 3, 46, 1, 0, 0, 0, '2019-01-24 13:08:17'),
(945, 3, 189, 1, 0, 0, 0, '2019-01-24 13:08:17'),
(946, 3, 191, 1, 0, 0, 0, '2019-01-24 13:08:17'),
(947, 5, 149, 1, 1, 1, 1, '2019-01-24 13:10:53'),
(948, 5, 150, 1, 1, 1, 1, '2019-01-24 13:10:53'),
(949, 5, 175, 1, 1, 1, 1, '2019-01-24 13:10:53'),
(950, 5, 86, 1, 0, 0, 0, '2019-01-24 13:10:53'),
(951, 5, 43, 1, 1, 1, 1, '2019-01-24 13:10:53'),
(952, 5, 44, 1, 0, 0, 0, '2019-01-24 13:10:53'),
(953, 5, 46, 1, 0, 0, 0, '2019-01-24 13:10:53'),
(954, 5, 27, 1, 1, 0, 1, '2019-01-24 13:10:53'),
(955, 5, 180, 1, 0, 0, 0, '2019-01-24 13:10:53'),
(956, 5, 189, 1, 0, 0, 0, '2019-01-24 13:10:53'),
(957, 5, 158, 1, 0, 0, 0, '2019-01-24 13:10:53'),
(958, 5, 102, 1, 1, 1, 1, '2019-01-24 13:10:53'),
(959, 5, 109, 1, 1, 1, 1, '2019-01-24 13:11:21'),
(960, 4, 27, 1, 1, 0, 1, '2019-01-24 13:12:50'),
(961, 6, 152, 1, 1, 1, 1, '2019-01-24 13:15:38'),
(962, 6, 153, 1, 1, 1, 1, '2019-01-24 13:15:38'),
(963, 6, 171, 1, 1, 1, 1, '2019-01-24 13:15:38'),
(964, 6, 109, 1, 1, 1, 1, '2019-01-24 13:15:38'),
(965, 6, 27, 1, 1, 0, 1, '2019-01-24 13:15:38'),
(966, 6, 181, 1, 0, 0, 0, '2019-01-24 13:15:38'),
(967, 6, 189, 1, 0, 0, 0, '2019-01-24 13:15:38'),
(968, 6, 118, 1, 0, 0, 0, '2019-01-24 13:15:38'),
(969, 6, 158, 1, 0, 0, 0, '2019-01-24 13:15:38'),
(970, 8, 132, 1, 1, 1, 1, '2019-01-24 13:19:02'),
(971, 8, 133, 1, 1, 1, 1, '2019-01-24 13:19:02'),
(972, 8, 135, 1, 1, 1, 1, '2019-01-24 13:19:02'),
(973, 8, 138, 1, 0, 0, 0, '2019-01-24 13:19:02'),
(974, 8, 163, 1, 0, 0, 0, '2019-01-24 13:19:02'),
(975, 8, 78, 1, 1, 1, 1, '2019-01-24 13:19:02'),
(976, 8, 79, 1, 1, 0, 1, '2019-01-24 13:19:02'),
(977, 8, 80, 1, 1, 1, 1, '2019-01-24 13:19:02'),
(978, 8, 81, 1, 1, 1, 1, '2019-01-24 13:19:02'),
(979, 8, 82, 1, 1, 1, 1, '2019-01-24 13:19:02'),
(980, 8, 83, 1, 1, 1, 1, '2019-01-24 13:19:02'),
(981, 8, 84, 1, 1, 1, 1, '2019-01-24 13:19:02'),
(982, 8, 85, 1, 1, 1, 1, '2019-01-24 13:19:02'),
(983, 8, 204, 1, 1, 1, 1, '2019-01-24 13:19:02'),
(984, 8, 205, 1, 0, 0, 0, '2019-01-24 13:19:02'),
(985, 8, 86, 1, 0, 0, 0, '2019-01-24 13:19:02'),
(986, 8, 109, 1, 1, 1, 1, '2019-01-24 13:19:02'),
(987, 8, 43, 1, 1, 1, 1, '2019-01-24 13:19:02'),
(988, 8, 44, 1, 0, 0, 0, '2019-01-24 13:19:02'),
(989, 8, 46, 1, 0, 0, 0, '2019-01-24 13:19:02'),
(990, 8, 27, 1, 1, 0, 1, '2019-01-24 13:19:02'),
(991, 8, 188, 1, 0, 0, 0, '2019-01-24 13:19:02'),
(992, 8, 189, 1, 0, 0, 0, '2019-01-24 13:19:02'),
(993, 8, 118, 1, 0, 0, 0, '2019-01-24 13:19:02'),
(994, 8, 102, 1, 1, 1, 1, '2019-01-24 13:19:02'),
(995, 5, 132, 1, 0, 0, 0, '2019-09-01 08:52:13'),
(996, 5, 133, 1, 0, 0, 0, '2019-09-01 08:52:13'),
(997, 5, 134, 1, 0, 0, 0, '2019-09-01 08:52:13'),
(998, 5, 135, 1, 0, 0, 0, '2019-09-01 08:52:13'),
(999, 5, 136, 1, 0, 0, 0, '2019-09-01 08:52:13'),
(1000, 5, 137, 1, 0, 0, 0, '2019-09-01 08:52:13');

-- --------------------------------------------------------

--
-- Table structure for table `sch_settings`
--

CREATE TABLE `sch_settings` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `address` text,
  `lang_id` int(11) DEFAULT NULL,
  `dise_code` varchar(50) DEFAULT NULL,
  `date_format` varchar(50) NOT NULL,
  `time_format` varchar(20) DEFAULT '24-hour',
  `currency` varchar(50) NOT NULL,
  `currency_symbol` varchar(50) NOT NULL,
  `is_rtl` varchar(10) DEFAULT 'disabled',
  `timezone` varchar(30) DEFAULT 'UTC',
  `session_id` int(11) DEFAULT NULL,
  `start_month` varchar(40) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `mini_logo` varchar(200) NOT NULL,
  `theme` varchar(200) NOT NULL DEFAULT 'default.jpg',
  `credit_limit` varchar(255) DEFAULT NULL,
  `opd_record_month` varchar(50) DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `cron_secret_key` varchar(100) NOT NULL,
  `fee_due_days` int(3) DEFAULT '0',
  `class_teacher` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sch_settings`
--

INSERT INTO `sch_settings` (`id`, `name`, `email`, `phone`, `address`, `lang_id`, `dise_code`, `date_format`, `time_format`, `currency`, `currency_symbol`, `is_rtl`, `timezone`, `session_id`, `start_month`, `image`, `mini_logo`, `theme`, `credit_limit`, `opd_record_month`, `is_active`, `created_at`, `updated_at`, `cron_secret_key`, `fee_due_days`, `class_teacher`) VALUES
(0, 'لابراتوار دنسازی براردان شیرزاد', 'kh.rasikh542@gmail.com', '0700077100', 'شهرنو، کابل، افغانستان', 57, '100', 'm/d/Y', '12-hour', 'AFN', 'AFN', 'enabled', 'UTC', NULL, '', '0.png', '0mini_logo.png', 'default.jpg', '20000', '1', 'no', '2020-12-14 13:37:37', '0000-00-00 00:00:00', 'JzBrQwhNx7zqmyvb8ZRHCi9OE', 60, '');

-- --------------------------------------------------------

--
-- Table structure for table `send_notification`
--

CREATE TABLE `send_notification` (
  `id` int(11) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `publish_date` date DEFAULT NULL,
  `date` date DEFAULT NULL,
  `message` text,
  `visible_student` varchar(10) NOT NULL DEFAULT 'no',
  `visible_staff` varchar(10) NOT NULL DEFAULT 'no',
  `visible_parent` varchar(10) NOT NULL DEFAULT 'no',
  `created_by` varchar(60) DEFAULT NULL,
  `created_id` int(11) DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sms_config`
--

CREATE TABLE `sms_config` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `api_id` varchar(100) NOT NULL,
  `authkey` varchar(100) NOT NULL,
  `senderid` varchar(100) NOT NULL,
  `contact` text,
  `username` varchar(150) DEFAULT NULL,
  `url` varchar(150) DEFAULT NULL,
  `password` varchar(150) DEFAULT NULL,
  `is_active` varchar(255) DEFAULT 'disabled',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `source`
--

CREATE TABLE `source` (
  `id` int(11) NOT NULL,
  `source` varchar(100) NOT NULL,
  `description` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(200) NOT NULL,
  `department` varchar(100) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `qualification` varchar(200) NOT NULL,
  `work_exp` varchar(200) NOT NULL,
  `specialization` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `surname` varchar(200) NOT NULL,
  `father_name` varchar(200) NOT NULL,
  `mother_name` varchar(200) NOT NULL,
  `contact_no` varchar(200) NOT NULL,
  `emergency_contact_no` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `dob` date NOT NULL,
  `marital_status` varchar(100) NOT NULL,
  `date_of_joining` date NOT NULL,
  `date_of_leaving` date NOT NULL,
  `local_address` varchar(300) NOT NULL,
  `permanent_address` varchar(200) NOT NULL,
  `note` varchar(200) NOT NULL,
  `image` varchar(200) NOT NULL,
  `password` varchar(250) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `blood_group` varchar(100) NOT NULL,
  `account_title` varchar(200) NOT NULL,
  `bank_account_no` varchar(200) NOT NULL,
  `bank_name` varchar(200) NOT NULL,
  `ifsc_code` varchar(200) NOT NULL,
  `bank_branch` varchar(100) NOT NULL,
  `payscale` varchar(200) NOT NULL,
  `basic_salary` varchar(200) NOT NULL,
  `epf_no` varchar(200) NOT NULL,
  `contract_type` varchar(100) NOT NULL,
  `shift` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `facebook` varchar(200) NOT NULL,
  `twitter` varchar(200) NOT NULL,
  `linkedin` varchar(200) NOT NULL,
  `instagram` varchar(200) NOT NULL,
  `resume` varchar(200) NOT NULL,
  `joining_letter` varchar(200) NOT NULL,
  `resignation_letter` varchar(200) NOT NULL,
  `other_document_name` varchar(200) NOT NULL,
  `other_document_file` varchar(200) NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_active` int(11) NOT NULL,
  `verification_code` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `employee_id`, `department`, `designation`, `qualification`, `work_exp`, `specialization`, `name`, `surname`, `father_name`, `mother_name`, `contact_no`, `emergency_contact_no`, `email`, `dob`, `marital_status`, `date_of_joining`, `date_of_leaving`, `local_address`, `permanent_address`, `note`, `image`, `password`, `gender`, `blood_group`, `account_title`, `bank_account_no`, `bank_name`, `ifsc_code`, `bank_branch`, `payscale`, `basic_salary`, `epf_no`, `contract_type`, `shift`, `location`, `facebook`, `twitter`, `linkedin`, `instagram`, `resume`, `joining_letter`, `resignation_letter`, `other_document_name`, `other_document_file`, `user_id`, `is_active`, `verification_code`) VALUES
(0, '', '', '1', '', '', '', 'Super Admin', '', '', '', '', '', 'kh.rasikh542@gmail.com', '0000-00-00', '', '0000-00-00', '0000-00-00', '', '', '', '', '$2y$10$27G97K8RXoajKGFEKKCK7ewuGz0Lqb3VcTYhCvBX4Mg2s23h2/Ko.', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 1, ''),
(1, 'D0001', '1', '2', 'best', 'two year joldi', 'joldi', 'داکتر ایمل', 'شیرزاد', 'محمد صادق', '', '0777238579', '', 'emal@gmail.com', '1995-01-16', '', '2019-08-15', '2020-07-09', 'Barchi Kabul', 'Barchi Kabul', 'nothing', '1.JPG', '$2y$10$rvNJMeY8gqXADNvAoxgWQO.XRRqU6EGFC3Yr75IK/MD3P.9cGLRi.', 'Male', 'B+', 'Doctor Nabil', '29384298492', 'Azizi Bank', '982398', 'Jaghori', '', '25000', '', 'permanent', 'Full Time', 'Jaghori', 'facebook.com/nabil', 'www.twitter.com/nabil', '', '', 'resume1.png', 'joining_letter1.jpg', 'resignation_letter1.jpg', 'Other Document', 'otherdocument1.PNG', 0, 1, ''),
(2, 'r012', '1', '1', '', '', '', 'Jamal Ahmad', 'Azizi', 'Aziz Ahmad', '', '0777238679', '', 'jamal@gmail.com', '2019-08-18', 'تک', '2019-08-18', '2019-08-12', 'سرک دارالمان، کابل', '', '', '2.JPG', '$2y$10$sVK/m4bw529qiO91tTYQ2OWTfe9dBNJ06T45CTRa.kW1Fj2n.Was6', 'Male', 'O+', '', '', '', '', '', '', '15000', '02', 'permanent', 'full time', 'kabul', '', '', '', '', '', '', '', 'Other Document', '', 0, 1, ''),
(3, '003', '1', '1', '', '', '', 'جمال احمد', 'عزیزی', 'عزیز احمد', '', '07878787', '', 'azizi@gmail.com', '1990-02-06', '', '2019-07-30', '0000-00-00', '', '', '', '', '$2y$10$Qe.ly9caDmA5kqkVZX9/7uMauDyHyQxpmXT75sqMBBoJsGtIPj8SG', 'Male', 'A+', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Other Document', '', 0, 1, ''),
(4, 'D010', '1', '1', '', '', '', 'سید محبت', 'هاشمی', 'هاشمی زاده', '', '0747406182', '', 'hashemi@gmail.com', '1997-11-05', '', '2019-11-11', '0000-00-00', 'Omid-e-Sabz township, Darulaman, Kabul.', 'Omid-e-Sabz township, Darulaman, Kabul.', '', '4.jpg', '$2y$10$jOxHv/3VZDjM/42AIfaqOuEpguiJ6h/XyNndp6wmvKXDOIYwYG1IG', 'Male', 'A+', '', '', '', '', '', '', '45000', 'd1010', 'permanent', 'Full Time', 'Jaghori', '', '', '', '', 'resume4.docx', '', '', 'Other Document', '', 0, 1, ''),
(5, 'lab01', '3', '5', '', '', '', 'laborant', '', 'laborant', '', '07897987', '07897987', 'laborant@gmil.com', '2019-12-03', 'Single', '2019-12-16', '0000-00-00', '', '', '', '', '$2y$10$ekpEheW4fz.2M0jUViSKLurRoA/SoIoZQq8aNiQM3dlutxOX/l0v6', 'Male', 'O+', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `staff_attendance`
--

CREATE TABLE `staff_attendance` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `staff_id` int(11) NOT NULL,
  `staff_attendance_type_id` int(11) NOT NULL,
  `remark` varchar(200) NOT NULL,
  `is_active` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `staff_attendance`
--

INSERT INTO `staff_attendance` (`id`, `date`, `staff_id`, `staff_attendance_type_id`, `remark`, `is_active`, `created_at`, `updated_at`) VALUES
(1, '2019-08-31', 0, 1, '', 0, '0000-00-00 00:00:00', 0),
(2, '2019-08-31', 1, 4, '', 0, '0000-00-00 00:00:00', 0),
(3, '2019-08-31', 2, 3, '', 0, '0000-00-00 00:00:00', 0),
(4, '2019-08-31', 3, 1, '', 0, '0000-00-00 00:00:00', 0),
(5, '2019-11-10', 0, 3, 'sdfs', 0, '0000-00-00 00:00:00', 0),
(6, '2019-11-10', 1, 2, 'sfsfsf', 0, '0000-00-00 00:00:00', 0),
(7, '2019-11-10', 2, 4, 'fsdf', 0, '0000-00-00 00:00:00', 0),
(8, '2019-11-10', 3, 1, 'sdfs', 0, '0000-00-00 00:00:00', 0),
(9, '2019-11-10', 4, 1, 'sdfsf', 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `staff_attendance_type`
--

CREATE TABLE `staff_attendance_type` (
  `id` int(11) NOT NULL,
  `type` varchar(200) NOT NULL,
  `key_value` varchar(200) NOT NULL,
  `is_active` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `staff_attendance_type`
--

INSERT INTO `staff_attendance_type` (`id`, `type`, `key_value`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Present', '<b class=\"text text-success\">P</b>', 'yes', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Late', '<b class=\"text text-warning\">L</b>', 'yes', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Absent', '<b class=\"text text-danger\">A</b>', 'yes', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Half Day', '<b class=\"text text-warning\">F</b>', 'yes', '2018-05-07 01:56:16', '0000-00-00 00:00:00'),
(5, 'Holiday', 'H', 'yes', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `staff_designation`
--

CREATE TABLE `staff_designation` (
  `id` int(11) NOT NULL,
  `designation` varchar(200) NOT NULL,
  `is_active` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `staff_designation`
--

INSERT INTO `staff_designation` (`id`, `designation`, `is_active`) VALUES
(1, 'Internal Medical', 'yes'),
(2, 'Children', 'yes'),
(3, 'Giving Births', 'yes'),
(4, 'Operation', 'yes'),
(5, 'Other', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `staff_leave_details`
--

CREATE TABLE `staff_leave_details` (
  `id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `leave_type_id` int(11) NOT NULL,
  `alloted_leave` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `staff_leave_details`
--

INSERT INTO `staff_leave_details` (`id`, `staff_id`, `leave_type_id`, `alloted_leave`) VALUES
(1, 1, 1, '30'),
(2, 1, 2, '10'),
(3, 1, 3, '25'),
(4, 2, 1, ''),
(5, 2, 2, ''),
(6, 2, 3, ''),
(7, 3, 1, ''),
(8, 3, 2, ''),
(9, 3, 3, ''),
(10, 4, 1, '12'),
(11, 4, 2, '24'),
(12, 4, 3, '25'),
(13, 5, 1, ''),
(14, 5, 2, ''),
(15, 5, 3, '');

-- --------------------------------------------------------

--
-- Table structure for table `staff_leave_request`
--

CREATE TABLE `staff_leave_request` (
  `id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `leave_type_id` int(11) NOT NULL,
  `leave_from` date NOT NULL,
  `leave_to` date NOT NULL,
  `leave_days` int(11) NOT NULL,
  `employee_remark` varchar(200) NOT NULL,
  `admin_remark` varchar(200) NOT NULL,
  `status` varchar(100) NOT NULL,
  `applied_by` varchar(200) NOT NULL,
  `document_file` varchar(200) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `staff_payroll`
--

CREATE TABLE `staff_payroll` (
  `id` int(11) NOT NULL,
  `basic_salary` int(11) NOT NULL,
  `pay_scale` varchar(200) NOT NULL,
  `grade` varchar(50) NOT NULL,
  `is_active` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `staff_payslip`
--

CREATE TABLE `staff_payslip` (
  `id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `basic` int(11) NOT NULL,
  `total_allowance` int(11) NOT NULL,
  `total_deduction` int(11) NOT NULL,
  `leave_deduction` int(11) NOT NULL,
  `tax` varchar(200) NOT NULL,
  `net_salary` float(10,2) NOT NULL,
  `status` varchar(100) NOT NULL,
  `month` varchar(200) NOT NULL,
  `year` varchar(200) NOT NULL,
  `payment_mode` varchar(200) NOT NULL,
  `payment_date` date NOT NULL,
  `remark` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `staff_payslip`
--

INSERT INTO `staff_payslip` (`id`, `staff_id`, `basic`, `total_allowance`, `total_deduction`, `leave_deduction`, `tax`, `net_salary`, `status`, `month`, `year`, `payment_mode`, `payment_date`, `remark`) VALUES
(1, 3, 0, 45000, 6000, 0, '0', 39000.00, 'paid', 'July', '2019', 'Cash', '2019-08-27', 'This amount submitted to Dr.Zamin by Rasikh. ');

-- --------------------------------------------------------

--
-- Table structure for table `staff_roles`
--

CREATE TABLE `staff_roles` (
  `id` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `is_active` int(11) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `staff_roles`
--

INSERT INTO `staff_roles` (`id`, `role_id`, `staff_id`, `is_active`, `created_at`, `updated_at`) VALUES
(0, 7, 0, 0, '2019-08-01 06:13:39', '0000-00-00 00:00:00'),
(1, 3, 1, 0, '2019-08-15 04:29:30', '0000-00-00 00:00:00'),
(2, 8, 2, 0, '2019-08-18 09:21:49', '0000-00-00 00:00:00'),
(3, 3, 3, 0, '2019-08-25 16:49:48', '0000-00-00 00:00:00'),
(4, 3, 4, 0, '2019-11-10 09:46:45', '0000-00-00 00:00:00'),
(5, 6, 5, 0, '2019-12-03 09:28:03', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `staff_timeline`
--

CREATE TABLE `staff_timeline` (
  `id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `timeline_date` date NOT NULL,
  `description` varchar(300) NOT NULL,
  `document` varchar(200) NOT NULL,
  `status` varchar(200) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `staff_timeline`
--

INSERT INTO `staff_timeline` (`id`, `staff_id`, `title`, `timeline_date`, `description`, `document`, `status`, `date`) VALUES
(1, 4, 'sdfsfsfds', '2019-11-10', 'sdfsdfdsfs', '', 'yes', '2019-11-10');

-- --------------------------------------------------------

--
-- Table structure for table `test_type_report`
--

CREATE TABLE `test_type_report` (
  `id` int(11) NOT NULL,
  `radiology_id` int(11) NOT NULL,
  `type` varchar(100) DEFAULT NULL,
  `test_name` varchar(100) DEFAULT NULL,
  `reporting_date` date DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `test_report` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tpa_master`
--

CREATE TABLE `tpa_master` (
  `id` int(11) NOT NULL,
  `organisation` varchar(200) NOT NULL,
  `charge_id` int(11) NOT NULL,
  `organisation_charge` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--

CREATE TABLE `userlog` (
  `id` int(11) NOT NULL,
  `user` varchar(100) DEFAULT NULL,
  `role` varchar(100) DEFAULT NULL,
  `ipaddress` varchar(100) DEFAULT NULL,
  `user_agent` varchar(500) DEFAULT NULL,
  `login_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `userlog`
--

INSERT INTO `userlog` (`id`, `user`, `role`, `ipaddress`, `user_agent`, `login_datetime`) VALUES
(0, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Chrome 87.0.4280.88, Windows 10', '2020-12-11 15:54:55'),
(50, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Firefox 68.0, Windows 10', '2019-08-31 09:32:16'),
(51, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Chrome 76.0.3809.132, Windows 10', '2019-08-31 14:39:58'),
(52, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Chrome 76.0.3809.132, Windows 10', '2019-09-01 03:55:58'),
(53, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Chrome 76.0.3809.132, Windows 10', '2019-09-01 04:08:37'),
(54, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Firefox 68.0, Windows 10', '2019-09-01 07:22:06'),
(55, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Chrome 76.0.3809.132, Windows 10', '2019-09-01 09:23:45'),
(56, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Chrome 76.0.3809.132, Windows 10', '2019-09-02 16:14:07'),
(57, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Chrome 76.0.3809.132, Windows 10', '2019-09-03 07:02:27'),
(58, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Chrome 76.0.3809.132, Windows 10', '2019-09-04 09:07:05'),
(59, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Chrome 76.0.3809.132, Windows 10', '2019-09-13 16:08:19'),
(60, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Firefox 69.0, Windows 10', '2019-09-14 05:05:25'),
(61, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Chrome 76.0.3809.132, Windows 10', '2019-09-14 05:17:00'),
(62, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Chrome 76.0.3809.132, Windows 10', '2019-09-17 07:00:57'),
(63, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Chrome 76.0.3809.132, Windows 10', '2019-09-18 11:47:43'),
(64, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Chrome 76.0.3809.132, Windows 10', '2019-09-19 01:59:35'),
(65, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Chrome 76.0.3809.132, Windows 10', '2019-09-19 05:12:20'),
(66, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Chrome 76.0.3809.132, Windows 10', '2019-09-21 04:58:11'),
(67, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Chrome 76.0.3809.132, Windows 10', '2019-09-24 01:28:46'),
(68, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Chrome 76.0.3809.132, Windows 10', '2019-09-24 05:04:20'),
(69, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Chrome 77.0.3865.90, Windows 10', '2019-09-27 02:57:14'),
(70, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Chrome 77.0.3865.90, Windows 10', '2019-09-27 09:23:47'),
(71, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Chrome 77.0.3865.90, Windows 10', '2019-09-27 15:18:34'),
(72, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Chrome 77.0.3865.90, Windows 10', '2019-09-28 01:59:17'),
(73, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Chrome 77.0.3865.90, Windows 10', '2019-09-28 02:08:33'),
(74, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Firefox 69.0, Windows 10', '2019-09-28 06:14:11'),
(75, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Firefox 69.0, Windows 10', '2019-09-28 12:09:11'),
(76, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Firefox 69.0, Windows 10', '2019-09-28 19:07:00'),
(77, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Chrome 77.0.3865.90, Windows 10', '2019-09-29 01:46:45'),
(78, 'kh.rasikh542@gmail.com', 'Super Admin', '141.105.167.16', 'Chrome 77.0.3865.90, Windows 8.1', '2019-09-29 04:35:49'),
(79, 'kh.rasikh542@gmail.com', 'Super Admin', '117.104.224.97', 'Chrome 77.0.3865.90, Windows 10', '2019-09-29 09:40:47'),
(80, 'kh.rasikh542@gmail.com', 'Super Admin', '141.105.167.17', 'Chrome 77.0.3865.90, Windows 8.1', '2019-09-30 04:48:24'),
(81, 'kh.rasikh542@gmail.com', 'Super Admin', '141.105.167.24', 'Chrome 77.0.3865.90, Windows 8.1', '2019-09-30 08:15:30'),
(82, 'kh.rasikh542@gmail.com', 'Super Admin', '175.106.48.91', 'Chrome 77.0.3865.90, Windows 10', '2019-09-30 10:09:34'),
(83, 'kh.rasikh542@gmail.com', 'Super Admin', '141.105.167.16', 'Chrome 77.0.3865.90, Windows 8.1', '2019-09-30 17:23:49'),
(84, 'kh.rasikh542@gmail.com', 'Super Admin', '154.59.43.129', 'Chrome 77.0.3865.90, Windows 10', '2019-09-30 18:53:36'),
(85, 'kh.rasikh542@gmail.com', 'Super Admin', '103.23.36.254', 'Chrome 77.0.3865.90, Windows 7', '2019-10-12 07:47:53'),
(86, 'kh.rasikh542@gmail.com', 'Super Admin', '103.215.210.68', 'Chrome 77.0.3865.90, Windows 10', '2019-10-12 08:37:21'),
(87, 'kh.rasikh542@gmail.com', 'Super Admin', '103.215.210.68', 'Chrome 77.0.3865.90, Windows 10', '2019-10-12 11:48:23'),
(88, 'kh.rasikh542@gmail.com', 'Super Admin', '154.59.43.113', 'Chrome 77.0.3865.90, Windows 10', '2019-10-13 00:39:37'),
(89, 'kh.rasikh542@gmail.com', 'Super Admin', '103.215.210.68', 'Chrome 77.0.3865.90, Windows 10', '2019-10-13 05:47:52'),
(90, 'kh.rasikh542@gmail.com', 'Super Admin', '103.215.210.68', 'Chrome 77.0.3865.90, Windows 10', '2019-10-13 11:39:11'),
(91, 'kh.rasikh542@gmail.com', 'Super Admin', '175.106.53.35', 'Firefox 59.0, Windows 7', '2019-10-14 05:15:10'),
(92, 'Kh.rasikh542@gmail.com', 'Super Admin', '103.42.2.128', 'Chrome 77.0.3865.116, Android', '2019-10-15 18:50:28'),
(93, 'kh.rasikh542@gmail.com', 'Super Admin', '196.195.251.167', 'Spartan 12.10240, Windows 10', '2019-10-16 01:43:31'),
(94, 'kh.rasikh542@gmail.com', 'Super Admin', '196.195.251.167', 'Spartan 12.10240, Windows 10', '2019-10-16 01:44:21'),
(95, 'kh.rasikh542@gmail.com', 'Super Admin', '196.195.251.167', 'Spartan 12.10240, Windows 10', '2019-10-16 01:45:20'),
(96, 'kh.rasikh542@gmail.com', 'Super Admin', '196.195.251.167', 'Spartan 12.10240, Windows 10', '2019-10-16 01:46:22'),
(97, 'kh.rasikh542@gmail.com', 'Super Admin', '175.106.53.229', 'Chrome 77.0.3865.120, Windows 7', '2019-10-16 04:48:59'),
(98, 'kh.rasikh542@gmail.com', 'Super Admin', '103.18.162.135', 'Chrome 77.0.3865.90, Windows 10', '2019-10-16 10:53:34'),
(99, 'kh.rasikh542@gmail.com', 'Super Admin', '103.215.210.68', 'Chrome 77.0.3865.120, Windows 10', '2019-10-17 05:22:38'),
(100, 'kh.rasikh542@gmail.com', 'Super Admin', '103.215.210.68', 'Chrome 77.0.3865.120, Windows 10', '2019-10-17 11:14:14'),
(101, 'Kh.rasikh542@gmail.com', 'Super Admin', '103.42.3.220', 'Chrome 77.0.3865.116, Android', '2019-10-19 04:32:40'),
(102, 'kh.rasikh542@gmail.com', 'Super Admin', '104.236.195.147', 'Chrome 77.0.3865.120, Windows 8.1', '2019-10-19 04:57:29'),
(103, 'kh.rasikh542@gmail.com', 'Super Admin', '104.236.195.147', 'Chrome 77.0.3865.120, Windows 8.1', '2019-10-19 06:21:25'),
(104, 'Kh.rasikh542@gmail.com', 'Super Admin', '103.42.1.184', 'Chrome 77.0.3865.116, Android', '2019-10-19 07:32:58'),
(105, 'kh.rasikh542@gmail.com', 'Super Admin', '103.215.210.68', 'Chrome 77.0.3865.120, Windows 10', '2019-10-19 09:17:42'),
(106, 'kh.rasikh542@gmail.com', 'Super Admin', '103.215.210.68', 'Chrome 77.0.3865.120, Windows 7', '2019-10-19 10:07:50'),
(107, 'kh.rasikh542@gmail.com', 'Super Admin', '103.215.210.68', 'Chrome 77.0.3865.120, Windows 10', '2019-10-19 12:32:53'),
(108, 'kh.rasikh542@gmail.com', 'Super Admin', '103.215.210.68', 'Chrome 77.0.3865.120, Windows 7', '2019-10-19 13:03:51'),
(109, 'Kh.rasikh542@gmail.com', 'Super Admin', '103.42.1.55', 'Chrome 77.0.3865.116, Android', '2019-10-19 15:53:44'),
(110, 'kh.rasikh542@gmail.com', 'Super Admin', '154.59.43.234', 'Chrome 77.0.3865.120, Windows 10', '2019-10-19 18:46:56'),
(111, 'Kh.rasikh542@gmail.com', 'Super Admin', '103.42.2.39', 'Chrome 77.0.3865.116, Android', '2019-10-20 05:05:33'),
(112, 'kh.rasikh542@gmail.com', 'Super Admin', '175.106.48.31', 'Chrome 77.0.3865.120, Windows 7', '2019-10-20 05:11:19'),
(113, 'Kh.rasikh542@gmail.com', 'Super Admin', '103.42.2.201', 'Chrome 77.0.3865.116, Android', '2019-10-20 08:41:30'),
(114, 'kh.rasikh542@gmail.com', 'Super Admin', '162.243.246.160', 'Chrome 77.0.3865.120, Windows 8.1', '2019-10-20 08:43:14'),
(115, 'kh.rasikh542@gmail.com', 'Super Admin', '103.18.162.135', 'Chrome 77.0.3865.120, Windows 10', '2019-10-20 09:50:25'),
(116, 'kh.rasikh542@gmail.com', 'Super Admin', '175.106.50.142', 'Chrome 77.0.3865.120, Windows 7', '2019-10-21 03:53:39'),
(117, 'kh.rasikh542@gmail.com', 'Super Admin', '175.106.50.142', 'Firefox 69.0, Windows 7', '2019-10-21 04:47:19'),
(118, 'Kh.rasikh542@gmail.com', 'Super Admin', '103.42.1.248', 'Chrome 77.0.3865.116, Android', '2019-10-21 06:39:48'),
(119, 'kh.rasikh542@gmail.com', 'Super Admin', '103.215.210.68', 'Chrome 77.0.3865.120, Windows 10', '2019-10-21 09:26:21'),
(120, 'kh.rasikh542@gmail.com', 'Super Admin', '104.131.92.125', 'Chrome 77.0.3865.120, Windows 10', '2019-10-21 09:55:46'),
(121, 'kh.rasikh542@gmail.com', 'Super Admin', '154.59.43.149', 'Chrome 77.0.3865.120, Windows 10', '2019-10-22 02:02:15'),
(122, 'kh.rasikh542@gmail.com', 'Super Admin', '175.106.58.139', 'Firefox 69.0, Windows 7', '2019-10-22 04:32:28'),
(123, 'kh.rasikh542@gmail.com', 'Super Admin', '103.215.210.68', 'Chrome 77.0.3865.120, Windows 10', '2019-10-22 06:55:31'),
(124, 'kh.rasikh542@gmail.com', 'Super Admin', '103.215.210.68', 'Chrome 77.0.3865.120, Windows 10', '2019-10-22 09:33:50'),
(125, 'kh.rasikh542@gmail.com', 'Super Admin', '103.215.210.68', 'Chrome 77.0.3865.120, Windows 10', '2019-10-22 10:25:00'),
(126, 'Kh.rasikh542@gmail.com', 'Super Admin', '103.42.3.96', 'Chrome 77.0.3865.116, Android', '2019-10-22 14:53:26'),
(127, 'kh.rasikh542@gmail.com', 'Super Admin', '154.59.43.214', 'Chrome 77.0.3865.120, Windows 10', '2019-10-23 01:25:59'),
(128, 'kh.rasikh542@gmail.com', 'Super Admin', '103.215.210.68', 'Chrome 77.0.3865.120, Windows 10', '2019-10-23 04:30:27'),
(129, 'Kh.rasikh542@gmail.com', 'Super Admin', '103.42.3.49', 'Chrome 77.0.3865.116, Android', '2019-10-23 04:48:52'),
(130, 'kh.rasikh542@gmail.com', 'Super Admin', '107.170.186.79', 'Chrome 77.0.3865.120, Windows 10', '2019-10-23 05:09:53'),
(131, 'kh.rasikh542@gmail.com', 'Super Admin', '175.106.63.68', 'Firefox 69.0, Windows 7', '2019-10-23 05:20:16'),
(132, 'Kh.rasikh542@gmail.com', 'Super Admin', '103.42.2.98', 'Chrome 77.0.3865.116, Android', '2019-10-23 05:29:11'),
(133, 'kh.rasikh542@gmail.com', 'Super Admin', '175.106.53.40', 'Firefox 70.0, Windows 10', '2019-10-23 06:11:45'),
(134, 'kh.rasikh542@gmail.com', 'Super Admin', '175.106.59.92', 'Firefox 59.0, Windows 7', '2019-10-23 08:58:42'),
(135, 'kh.rasikh542@gmail.com', 'Super Admin', '117.104.230.64', 'Firefox 59.0, Windows 7', '2019-10-23 10:39:44'),
(136, 'kh.rasikh542@gmail.com', 'Super Admin', '154.59.43.139', 'Chrome 77.0.3865.120, Windows 10', '2019-10-24 01:58:13'),
(137, 'kh.rasikh542@gmail.com', 'Super Admin', '154.59.43.67', 'Chrome 77.0.3865.120, Windows 10', '2019-10-26 02:02:49'),
(138, 'kh.rasikh542@gmail.com', 'Super Admin', '103.215.210.68', 'Chrome 77.0.3865.120, Windows 10', '2019-10-26 09:24:19'),
(139, 'kh.rasikh542@gmail.com', 'Super Admin', '107.170.127.117', 'Chrome 77.0.3865.120, Windows 10', '2019-10-26 10:12:14'),
(140, 'kh.rasikh542@gmail.com', 'Super Admin', '104.236.70.228', 'Chrome 77.0.3865.120, Windows 8.1', '2019-10-26 12:49:36'),
(141, 'Kh.rasikh542@gmail.com', 'Super Admin', '103.42.1.71', 'Chrome 77.0.3865.116, Android', '2019-10-26 13:28:30'),
(142, 'kh.rasikh542@gmail.com', 'Super Admin', '104.236.74.212', 'Chrome 77.0.3865.120, Windows 10', '2019-10-27 04:47:18'),
(143, 'kh.rasikh542@gmail.com', 'Super Admin', '104.236.74.212', 'Chrome 77.0.3865.120, Windows 10', '2019-10-27 08:16:41'),
(144, 'kh.rasikh542@gmail.com', 'Super Admin', '175.106.53.34', 'Chrome 77.0.3865.120, Windows 10', '2019-10-27 09:46:00'),
(145, 'kh.rasikh542@gmail.com', 'Super Admin', '104.236.74.212', 'Chrome 77.0.3865.120, Windows 10', '2019-10-27 10:35:39'),
(146, 'kh.rasikh542@gmail.com', 'Super Admin', '107.170.145.187', 'Chrome 77.0.3865.120, Windows 10', '2019-10-29 09:27:57'),
(147, 'Kh.rasikh542@gmail.com', 'Super Admin', '103.42.1.233', 'Chrome 77.0.3865.116, Android', '2019-10-30 03:33:17'),
(148, 'kh.rasikh542@gmail.com', 'Super Admin', '103.215.210.68', 'Chrome 77.0.3865.120, Windows 10', '2019-10-30 06:23:21'),
(149, 'kh.rasikh542@gmail.com', 'Super Admin', '103.215.210.68', 'Chrome 77.0.3865.120, Windows 10', '2019-10-30 06:25:14'),
(150, 'kh.rasikh542@gmail.com', 'Super Admin', '103.215.210.68', 'Chrome 77.0.3865.120, Windows 10', '2019-10-30 06:33:35'),
(151, 'kh.rasikh542@gmail.com', 'Super Admin', '103.215.210.68', 'Firefox 69.0, Windows 10', '2019-10-30 06:42:05'),
(152, 'kh.rasikh542@gmail.com', 'Super Admin', '193.186.196.233', 'Chrome 77.0.3865.120, Windows 8.1', '2019-10-30 16:14:25'),
(153, 'Kh.rasikh542@gmail.com', 'Super Admin', '59.153.127.105', 'Chrome 77.0.3865.116, Android', '2019-10-31 00:30:22'),
(154, 'kh.rasikh542@gmail.com', 'Super Admin', '193.186.196.233', 'Chrome 77.0.3865.120, Windows 8.1', '2019-10-31 07:23:01'),
(155, 'kh.rasikh542@gmail.com', 'Super Admin', '103.215.210.68', 'Chrome 78.0.3904.70, Windows 10', '2019-11-03 10:14:18'),
(156, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Chrome 78.0.3904.70, Windows 10', '2019-11-04 09:40:28'),
(157, 'kh.rasikh542@gmail.com', 'Super Admin', '192.168.10.157', 'Chrome 78.0.3904.70, Windows 10', '2019-11-04 10:53:27'),
(158, 'kh.rasikh542@gmail.com', 'Super Admin', '192.168.10.230', 'Chrome 77.0.3865.120, Windows 10', '2019-11-04 10:53:42'),
(159, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Chrome 78.0.3904.70, Windows 10', '2019-11-05 10:04:16'),
(160, 'kh.rasikh542@gmail.com', 'Super Admin', '192.168.10.157', 'Chrome 78.0.3904.70, Windows 10', '2019-11-05 10:27:53'),
(161, 'kh.rasikh542@gmail.com', 'Super Admin', '192.168.10.230', 'Chrome 77.0.3865.120, Windows 10', '2019-11-05 10:29:47'),
(162, 'kh.rasikh542@gmail.com', 'Super Admin', '192.168.10.157', 'Firefox 70.0, Windows 10', '2019-11-06 11:21:58'),
(163, 'kh.rasikh542@gmail.com', 'Super Admin', '192.168.10.230', 'Chrome 77.0.3865.120, Windows 10', '2019-11-06 11:44:57'),
(164, 'kh.rasikh542@gmail.com', 'Super Admin', '192.168.10.157', 'Chrome 78.0.3904.87, Windows 10', '2019-11-07 08:55:12'),
(165, 'kh.rasikh542@gmail.com', 'Super Admin', '192.168.10.230', 'Chrome 78.0.3904.87, Windows 10', '2019-11-07 08:57:20'),
(166, 'kh.rasikh542@gmail.com', 'Super Admin', '192.168.10.157', 'Chrome 78.0.3904.87, Windows 10', '2019-11-07 09:14:22'),
(167, 'kh.rasikh542@gmail.com', 'Super Admin', '192.168.10.230', 'Chrome 78.0.3904.87, Windows 10', '2019-11-07 09:14:22'),
(168, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Chrome 78.0.3904.87, Windows 10', '2019-11-08 12:50:39'),
(169, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Chrome 78.0.3904.87, Windows 10', '2019-11-09 06:53:43'),
(170, 'kh.rasikh542@gmail.com', 'Super Admin', '192.168.10.157', 'Chrome 78.0.3904.87, Windows 10', '2019-11-09 07:02:09'),
(171, 'kh.rasikh542@gmail.com', 'Super Admin', '192.168.10.230', 'Chrome 78.0.3904.87, Windows 10', '2019-11-09 07:02:44'),
(172, 'kh.rasikh542@gmail.com', 'Super Admin', '192.168.10.157', 'Chrome 78.0.3904.97, Windows 10', '2019-11-10 09:20:21'),
(173, 'kh.rasikh542@gmail.com', 'Super Admin', '192.168.10.230', 'Chrome 78.0.3904.87, Windows 10', '2019-11-10 09:26:54'),
(174, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Chrome 77.0.3865.120, Windows 8.1', '2019-11-11 13:49:57'),
(175, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Chrome 77.0.3865.120, Windows 8.1', '2019-11-11 15:53:49'),
(176, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Chrome 78.0.3904.87, Windows 10', '2019-11-12 04:28:36'),
(177, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Chrome 78.0.3904.87, Windows 10', '2019-11-12 09:56:36'),
(178, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Chrome 78.0.3904.97, Windows 10', '2019-11-16 07:33:57'),
(179, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Chrome 78.0.3904.97, Windows 10', '2019-11-17 04:03:15'),
(180, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Chrome 78.0.3904.97, Windows 10', '2019-11-17 09:28:46'),
(181, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Chrome 78.0.3904.97, Windows 10', '2019-11-18 04:42:32'),
(182, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Chrome 78.0.3904.97, Windows 10', '2019-11-18 06:02:43'),
(183, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Chrome 78.0.3904.97, Windows 10', '2019-11-18 09:03:52'),
(184, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Chrome 78.0.3904.97, Windows 10', '2019-11-19 07:00:46'),
(185, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Chrome 78.0.3904.97, Windows 10', '2019-11-19 13:17:05'),
(186, 'kh.rasikh542@gmail.com', 'Super Admin', '103.42.2.77', 'Chrome 78.0.3904.108, Windows 10', '2019-11-20 05:39:12'),
(187, 'kh.rasikh542@gmail.com', 'Super Admin', '103.215.210.70', 'Chrome 78.0.3904.108, Windows 10', '2019-11-20 07:26:00'),
(188, 'kh.rasikh542@gmail.com', 'Super Admin', '104.131.188.187', 'Chrome 78.0.3904.97, Windows 10', '2019-11-20 08:28:21'),
(189, 'kh.rasikh542@gmail.com', 'Super Admin', '103.42.3.229', 'Chrome 78.0.3904.108, Windows 10', '2019-11-20 11:24:50'),
(190, 'kh.rasikh542@gmail.com', 'Super Admin', '104.236.205.233', 'Chrome 78.0.3904.97, Windows 10', '2019-11-21 04:00:28'),
(191, 'kh.rasikh542@gmail.com', 'Super Admin', '193.186.196.232', 'Chrome 78.0.3904.108, Windows 8.1', '2019-11-21 04:46:54'),
(192, 'kh.rasikh542@gmail.com', 'Super Admin', '193.186.196.232', 'Chrome 78.0.3904.108, Windows 8.1', '2019-11-21 10:23:27'),
(193, 'Kh.rasikh542@gmail.com', 'Super Admin', '103.42.2.74', 'Chrome 78.0.3904.96, Android', '2019-11-21 11:32:36'),
(194, 'Kh.rasikh542@gmail.com', 'Super Admin', '103.42.3.159', 'Chrome 78.0.3904.96, Android', '2019-11-22 08:20:53'),
(195, 'kh.rasikh542@gmail.com', 'Super Admin', '103.42.2.42', 'Chrome 78.0.3904.108, Windows 10', '2019-11-22 14:29:36'),
(196, 'Kh.rasikh542@gmail.com', 'Super Admin', '103.42.1.84', 'Chrome 78.0.3904.96, Android', '2019-11-23 05:33:02'),
(197, 'kh.rasikh542@gmail.com', 'Super Admin', '125.213.221.170', 'Chrome 78.0.3904.108, Windows 10', '2019-11-23 09:15:09'),
(198, 'kh.rasikh542@gmail.com', 'Super Admin', '107.170.127.117', 'Chrome 78.0.3904.97, Windows 10', '2019-11-24 05:15:35'),
(199, 'kh.rasikh542@gmail.com', 'Super Admin', '193.186.196.232', 'Chrome 78.0.3904.108, Windows 8.1', '2019-11-24 06:15:56'),
(200, 'Kh.rasikh542@gmail.com', 'Super Admin', '103.42.3.23', 'Chrome 78.0.3904.96, Android', '2019-11-24 06:37:12'),
(201, 'kh.rasikh542@gmail.com', 'Super Admin', '103.42.3.241', 'Chrome 78.0.3904.108, Windows 10', '2019-11-24 10:36:12'),
(202, 'kh.rasikh542@gmail.com', 'Super Admin', '193.186.196.232', 'Chrome 78.0.3904.108, Windows 8.1', '2019-11-24 11:47:56'),
(203, 'kh.rasikh542@gmail.com', 'Super Admin', '103.42.1.25', 'Chrome 78.0.3904.108, Windows 10', '2019-11-25 01:57:08'),
(204, 'kh.rasikh542@gmail.com', 'Super Admin', '104.131.188.187', 'Chrome 78.0.3904.108, Windows 10', '2019-11-25 04:10:21'),
(205, 'kh.rasikh542@gmail.com', 'Super Admin', '193.186.196.232', 'Chrome 78.0.3904.108, Windows 8.1', '2019-11-26 06:01:22'),
(206, 'kh.rasikh542@gmail.com', 'Super Admin', '104.236.213.230', 'Chrome 78.0.3904.108, Windows 10', '2019-11-26 08:35:17'),
(207, 'kh.rasikh542@gmail.com', 'Super Admin', '125.213.221.170', 'Chrome 78.0.3904.108, Windows 10', '2019-11-26 09:30:18'),
(208, 'kh.rasikh542@gmail.com', 'Super Admin', '104.131.188.187', 'Chrome 78.0.3904.108, Windows 10', '2019-11-26 14:40:14'),
(209, 'kh.rasikh542@gmail.com', 'Super Admin', '125.213.221.170', 'Chrome 78.0.3904.108, Windows 10', '2019-11-27 04:19:17'),
(210, 'kh.rasikh542@gmail.com', 'Super Admin', '103.42.1.132', 'Chrome 78.0.3904.108, Windows 10', '2019-11-27 04:29:48'),
(211, 'kh.rasikh542@gmail.com', 'Super Admin', '193.186.196.232', 'Chrome 78.0.3904.108, Windows 8.1', '2019-11-27 07:38:57'),
(212, 'kh.rasikh542@gmail.com', 'Super Admin', '125.213.221.170', 'Chrome 78.0.3904.108, Windows 10', '2019-11-27 10:05:26'),
(213, 'kh.rasikh542@gmail.com', 'Super Admin', '193.186.196.232', 'Chrome 78.0.3904.108, Windows 8.1', '2019-11-27 10:40:28'),
(214, 'kh.rasikh542@gmail.com', 'Super Admin', '193.186.196.232', 'Chrome 78.0.3904.108, Windows 8.1', '2019-11-29 10:35:42'),
(215, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Chrome 78.0.3904.97, Windows 8.1', '2019-11-30 13:14:43'),
(216, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Chrome 78.0.3904.97, Windows 8.1', '2019-12-01 13:15:00'),
(217, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Chrome 78.0.3904.97, Windows 8.1', '2019-12-02 12:53:08'),
(218, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Chrome 78.0.3904.108, Windows 10', '2019-12-03 09:01:12'),
(219, 'registrar@gmail.com', 'Receptionist', '::1', 'Firefox 70.0, Windows 10', '2019-12-03 09:23:10'),
(220, 'laborant@gmil.com', 'Laborant', '::1', 'Firefox 70.0, Windows 10', '2019-12-03 09:30:17'),
(221, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Chrome 79.0.3945.79, Windows 10', '2019-12-15 11:57:00'),
(222, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Chrome 79.0.3945.79, Windows 10', '2019-12-15 14:33:44'),
(223, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Chrome 79.0.3945.79, Windows 10', '2019-12-17 14:25:28'),
(224, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Chrome 79.0.3945.79, Windows 10', '2019-12-18 09:16:40'),
(225, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Chrome 79.0.3945.88, Windows 10', '2019-12-23 18:47:05'),
(226, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Chrome 79.0.3945.88, Windows 10', '2019-12-23 19:02:06'),
(227, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Chrome 79.0.3945.88, Windows 10', '2019-12-25 04:23:52'),
(228, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Chrome 79.0.3945.88, Windows 10', '2019-12-25 23:24:20'),
(229, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Chrome 79.0.3945.88, Windows 10', '2019-12-26 03:46:27'),
(230, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Chrome 79.0.3945.88, Windows 10', '2019-12-27 02:50:28'),
(231, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Chrome 79.0.3945.88, Windows 10', '2019-12-27 15:58:37'),
(232, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Chrome 79.0.3945.88, Windows 10', '2019-12-29 10:52:50'),
(233, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Chrome 79.0.3945.88, Windows 10', '2019-12-30 09:11:29'),
(234, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Firefox 71.0, Windows 10', '2019-12-31 02:47:02'),
(235, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Chrome 79.0.3945.117, Windows 10', '2020-01-15 14:20:43'),
(236, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Chrome 79.0.3945.117, Windows 10', '2020-01-16 17:09:49'),
(237, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Firefox 72.0, Windows 10', '2020-01-17 14:20:18'),
(238, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Firefox 72.0, Windows 10', '2020-01-18 13:04:26'),
(239, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Firefox 72.0, Windows 10', '2020-01-19 08:46:33'),
(240, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Firefox 72.0, Windows 10', '2020-01-23 16:30:27'),
(241, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Firefox 72.0, Windows 10', '2020-01-23 18:15:02'),
(242, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Firefox 72.0, Windows 10', '2020-01-24 17:05:02'),
(243, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Firefox 72.0, Windows 10', '2020-01-25 16:42:16'),
(244, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Firefox 72.0, Windows 10', '2020-01-26 04:53:47'),
(245, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Firefox 72.0, Windows 10', '2020-01-26 12:30:24'),
(246, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Firefox 72.0, Windows 10', '2020-01-26 12:31:06'),
(247, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Firefox 72.0, Windows 10', '2020-01-26 12:36:54'),
(248, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Firefox 72.0, Windows 10', '2020-01-26 12:38:38'),
(249, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Firefox 72.0, Windows 10', '2020-01-26 12:53:44'),
(250, 'azizi@gmail.com', 'Doctor', '::1', 'Firefox 72.0, Windows 10', '2020-01-26 12:55:11'),
(251, 'azizi@gmail.com', 'Doctor', '::1', 'Spartan 13.10586, Windows 10', '2020-01-26 12:43:41'),
(252, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Spartan 13.10586, Windows 10', '2020-01-26 12:54:12'),
(253, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-01-26 13:02:16'),
(254, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-01-26 13:02:49'),
(255, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-01-27 05:23:09'),
(256, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-01-27 12:37:00'),
(257, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-01-27 16:58:17'),
(258, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-01-27 19:45:34'),
(259, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-01-29 03:35:10'),
(260, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-01-29 03:53:59'),
(261, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-01-29 04:24:51'),
(262, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-01-29 04:27:05'),
(263, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-01-30 04:23:35'),
(264, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-02-01 16:36:00'),
(265, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-02-05 04:09:28'),
(266, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-02-05 18:34:42'),
(267, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-02-06 23:49:42'),
(268, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-02-06 23:56:29'),
(269, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-02-07 00:06:25'),
(270, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-02-07 00:07:28'),
(271, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-02-07 01:08:17'),
(272, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-02-11 01:55:47'),
(273, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-02-11 01:57:33'),
(274, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-02-16 20:20:10'),
(275, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-02-17 21:53:10'),
(276, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-02-17 23:42:22'),
(277, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-02-18 00:59:05'),
(278, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-02-18 01:08:24'),
(279, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-02-18 19:46:29'),
(280, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-02-18 20:14:33'),
(281, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-02-19 00:44:06'),
(282, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-02-19 17:05:51'),
(283, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-02-19 19:36:36'),
(284, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-02-20 00:33:35'),
(285, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-02-20 01:38:41'),
(286, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-02-21 00:38:16'),
(287, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-02-22 19:32:07'),
(288, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-02-23 22:51:20'),
(289, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-02-24 01:28:39'),
(290, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-02-26 21:43:05'),
(291, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-02-27 16:38:24'),
(292, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-02-27 23:31:27'),
(293, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-02-28 00:17:33'),
(294, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-02-29 16:44:25'),
(295, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-02-29 19:35:23'),
(296, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-03-01 00:44:30'),
(297, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-03-02 01:50:42'),
(298, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-03-02 16:49:15'),
(299, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-03-03 00:47:41'),
(300, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-03-03 23:49:24'),
(301, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-03-05 00:50:26'),
(302, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-03-06 00:42:02'),
(303, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-03-08 00:17:07'),
(304, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-03-09 00:53:51'),
(305, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-03-10 00:00:19'),
(306, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-03-10 22:50:49'),
(307, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-03-12 00:01:21'),
(308, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-03-12 19:31:26'),
(309, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-03-12 23:22:38'),
(310, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-03-15 17:30:05'),
(311, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-03-16 01:13:07'),
(312, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-03-17 01:01:42'),
(313, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-03-18 00:14:58'),
(314, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-03-19 01:19:09'),
(315, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-03-20 01:01:22'),
(316, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-03-22 21:53:33'),
(317, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-03-23 16:31:50'),
(318, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-03-23 23:49:25'),
(319, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-03-24 23:33:11'),
(320, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-03-25 23:59:26'),
(321, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-03-26 23:52:15'),
(322, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-03-28 19:13:01'),
(323, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-03-29 23:53:48'),
(324, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-03-31 00:05:52'),
(325, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-03-31 17:02:11'),
(326, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-04-01 00:11:38'),
(327, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-04-01 19:15:55'),
(328, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-04-05 23:52:48'),
(329, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-04-07 01:25:59'),
(330, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-04-09 00:36:02'),
(331, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-04-13 00:31:58'),
(332, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-04-15 22:38:35'),
(333, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-02-29 08:40:25'),
(334, 'azizi@gmail.com', 'Doctor', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-05-02 22:56:25'),
(335, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-02-20 02:54:05'),
(336, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-02-20 03:04:11'),
(337, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Chrome 79.0.3945.88, Windows 10', '2020-04-10 09:53:07'),
(338, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Chrome 87.0.4280.88, Windows 10', '2020-12-14 13:36:37'),
(339, 'kh.rasikh542@gmail.com', 'Super Admin', '::1', 'Chrome 87.0.4280.88, Windows 10', '2020-12-15 13:26:43');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_id` int(10) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `childs` text NOT NULL,
  `role` varchar(30) NOT NULL,
  `verification_code` varchar(200) NOT NULL,
  `is_active` varchar(255) DEFAULT 'yes',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `username`, `password`, `childs`, `role`, `verification_code`, `is_active`, `created_at`, `updated_at`) VALUES
(202, 51, 'pat51', '9alajn', '', 'patient', '', 'yes', '2020-12-15 13:28:55', '0000-00-00 00:00:00'),
(203, 52, 'pat52', 'd5c1ap', '', 'patient', '', 'yes', '2020-12-15 13:43:05', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` int(10) UNSIGNED NOT NULL,
  `vehicle_no` varchar(20) DEFAULT NULL,
  `vehicle_model` varchar(100) NOT NULL DEFAULT 'None',
  `manufacture_year` varchar(4) DEFAULT NULL,
  `vehicle_type` varchar(100) NOT NULL,
  `driver_name` varchar(50) DEFAULT NULL,
  `driver_licence` varchar(50) NOT NULL DEFAULT 'None',
  `driver_contact` varchar(20) DEFAULT NULL,
  `note` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `visitors_book`
--

CREATE TABLE `visitors_book` (
  `id` int(11) NOT NULL,
  `source` varchar(100) DEFAULT NULL,
  `purpose` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `contact` varchar(12) NOT NULL,
  `id_proof` varchar(50) NOT NULL,
  `no_of_pepple` int(11) NOT NULL,
  `date` date NOT NULL,
  `in_time` varchar(20) NOT NULL,
  `out_time` varchar(20) NOT NULL,
  `note` mediumtext NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `visitors_purpose`
--

CREATE TABLE `visitors_purpose` (
  `id` int(11) NOT NULL,
  `visitors_purpose` varchar(100) NOT NULL,
  `description` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ambulance_call`
--
ALTER TABLE `ambulance_call`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bed`
--
ALTER TABLE `bed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bed_group`
--
ALTER TABLE `bed_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bed_type`
--
ALTER TABLE `bed_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blood_bank_status`
--
ALTER TABLE `blood_bank_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blood_donor`
--
ALTER TABLE `blood_donor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blood_donor_cycle`
--
ALTER TABLE `blood_donor_cycle`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blood_issue`
--
ALTER TABLE `blood_issue`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `charges`
--
ALTER TABLE `charges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `charge_categories`
--
ALTER TABLE `charge_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `children_medical`
--
ALTER TABLE `children_medical`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complaint`
--
ALTER TABLE `complaint`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complaint_type`
--
ALTER TABLE `complaint_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `consultant_register`
--
ALTER TABLE `consultant_register`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contents`
--
ALTER TABLE `contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `content_for`
--
ALTER TABLE `content_for`
  ADD PRIMARY KEY (`id`),
  ADD KEY `content_id` (`content_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `diagnosis`
--
ALTER TABLE `diagnosis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `diognostic`
--
ALTER TABLE `diognostic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dispatch_receive`
--
ALTER TABLE `dispatch_receive`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_config`
--
ALTER TABLE `email_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enquiry`
--
ALTER TABLE `enquiry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enquiry_type`
--
ALTER TABLE `enquiry_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `examination`
--
ALTER TABLE `examination`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense_head`
--
ALTER TABLE `expense_head`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `floor`
--
ALTER TABLE `floor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `follow_up`
--
ALTER TABLE `follow_up`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `front_cms_media_gallery`
--
ALTER TABLE `front_cms_media_gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `front_cms_menus`
--
ALTER TABLE `front_cms_menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `front_cms_menu_items`
--
ALTER TABLE `front_cms_menu_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `front_cms_pages`
--
ALTER TABLE `front_cms_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `front_cms_page_contents`
--
ALTER TABLE `front_cms_page_contents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `page_id` (`page_id`);

--
-- Indexes for table `front_cms_programs`
--
ALTER TABLE `front_cms_programs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `front_cms_program_photos`
--
ALTER TABLE `front_cms_program_photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `program_id` (`program_id`);

--
-- Indexes for table `front_cms_settings`
--
ALTER TABLE `front_cms_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_calls`
--
ALTER TABLE `general_calls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `giving_births`
--
ALTER TABLE `giving_births`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `income`
--
ALTER TABLE `income`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `income_head`
--
ALTER TABLE `income_head`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ipd_billing`
--
ALTER TABLE `ipd_billing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ipd_details`
--
ALTER TABLE `ipd_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_category`
--
ALTER TABLE `item_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_issue`
--
ALTER TABLE `item_issue`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `item_category_id` (`item_category_id`);

--
-- Indexes for table `item_stock`
--
ALTER TABLE `item_stock`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `supplier_id` (`supplier_id`),
  ADD KEY `store_id` (`store_id`);

--
-- Indexes for table `item_store`
--
ALTER TABLE `item_store`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_supplier`
--
ALTER TABLE `item_supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lab`
--
ALTER TABLE `lab`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lab_config`
--
ALTER TABLE `lab_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lab_ecg`
--
ALTER TABLE `lab_ecg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lab_lab`
--
ALTER TABLE `lab_lab`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lab_ultra_sound`
--
ALTER TABLE `lab_ultra_sound`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lab_xray`
--
ALTER TABLE `lab_xray`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_types`
--
ALTER TABLE `leave_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `type` (`type`);

--
-- Indexes for table `medical`
--
ALTER TABLE `medical`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicine_bad_stock`
--
ALTER TABLE `medicine_bad_stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicine_batch_details`
--
ALTER TABLE `medicine_batch_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicine_category`
--
ALTER TABLE `medicine_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_roles`
--
ALTER TABLE `notification_roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `send_notification_id` (`send_notification_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `notification_setting`
--
ALTER TABLE `notification_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nursing_forcep`
--
ALTER TABLE `nursing_forcep`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `opd_details`
--
ALTER TABLE `opd_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `operation`
--
ALTER TABLE `operation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `operation_theatre`
--
ALTER TABLE `operation_theatre`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organisation`
--
ALTER TABLE `organisation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organisations_charges`
--
ALTER TABLE `organisations_charges`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `org_id` (`org_id`) USING BTREE,
  ADD KEY `charge_id` (`charge_id`) USING BTREE;

--
-- Indexes for table `ot_consultant_register`
--
ALTER TABLE `ot_consultant_register`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pathology`
--
ALTER TABLE `pathology`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pathology_category`
--
ALTER TABLE `pathology_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pathology_report`
--
ALTER TABLE `pathology_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_charges`
--
ALTER TABLE `patient_charges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_income`
--
ALTER TABLE `patient_income`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_nicu`
--
ALTER TABLE `patient_nicu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_nursing`
--
ALTER TABLE `patient_nursing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_operation`
--
ALTER TABLE `patient_operation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_timeline`
--
ALTER TABLE `patient_timeline`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_ward`
--
ALTER TABLE `patient_ward`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_settings`
--
ALTER TABLE `payment_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payslip_allowance`
--
ALTER TABLE `payslip_allowance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_category`
--
ALTER TABLE `permission_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_group`
--
ALTER TABLE `permission_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pharmacy`
--
ALTER TABLE `pharmacy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pharmacy_bill_basic`
--
ALTER TABLE `pharmacy_bill_basic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pharmacy_bill_detail`
--
ALTER TABLE `pharmacy_bill_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prescription`
--
ALTER TABLE `prescription`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `print_setting`
--
ALTER TABLE `print_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `radio`
--
ALTER TABLE `radio`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `radiology_report`
--
ALTER TABLE `radiology_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `read_notification`
--
ALTER TABLE `read_notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles_permissions`
--
ALTER TABLE `roles_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sch_settings`
--
ALTER TABLE `sch_settings`
  ADD KEY `lang_id` (`lang_id`),
  ADD KEY `session_id` (`session_id`);

--
-- Indexes for table `send_notification`
--
ALTER TABLE `send_notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_config`
--
ALTER TABLE `sms_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `source`
--
ALTER TABLE `source`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employee_id` (`employee_id`);

--
-- Indexes for table `staff_attendance`
--
ALTER TABLE `staff_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_attendance_type`
--
ALTER TABLE `staff_attendance_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_designation`
--
ALTER TABLE `staff_designation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_leave_details`
--
ALTER TABLE `staff_leave_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_leave_request`
--
ALTER TABLE `staff_leave_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_payroll`
--
ALTER TABLE `staff_payroll`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_payslip`
--
ALTER TABLE `staff_payslip`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_roles`
--
ALTER TABLE `staff_roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `staff_id` (`staff_id`);

--
-- Indexes for table `staff_timeline`
--
ALTER TABLE `staff_timeline`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test_type_report`
--
ALTER TABLE `test_type_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tpa_master`
--
ALTER TABLE `tpa_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userlog`
--
ALTER TABLE `userlog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visitors_book`
--
ALTER TABLE `visitors_book`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visitors_purpose`
--
ALTER TABLE `visitors_purpose`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ambulance_call`
--
ALTER TABLE `ambulance_call`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bed`
--
ALTER TABLE `bed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bed_group`
--
ALTER TABLE `bed_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bed_type`
--
ALTER TABLE `bed_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `blood_bank_status`
--
ALTER TABLE `blood_bank_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `blood_donor`
--
ALTER TABLE `blood_donor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blood_donor_cycle`
--
ALTER TABLE `blood_donor_cycle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blood_issue`
--
ALTER TABLE `blood_issue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `charges`
--
ALTER TABLE `charges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `charge_categories`
--
ALTER TABLE `charge_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `children_medical`
--
ALTER TABLE `children_medical`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `complaint`
--
ALTER TABLE `complaint`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `complaint_type`
--
ALTER TABLE `complaint_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `consultant_register`
--
ALTER TABLE `consultant_register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `contents`
--
ALTER TABLE `contents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `content_for`
--
ALTER TABLE `content_for`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `diagnosis`
--
ALTER TABLE `diagnosis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `diognostic`
--
ALTER TABLE `diognostic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dispatch_receive`
--
ALTER TABLE `dispatch_receive`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `email_config`
--
ALTER TABLE `email_config`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `enquiry`
--
ALTER TABLE `enquiry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `enquiry_type`
--
ALTER TABLE `enquiry_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `examination`
--
ALTER TABLE `examination`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `expense_head`
--
ALTER TABLE `expense_head`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `floor`
--
ALTER TABLE `floor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `follow_up`
--
ALTER TABLE `follow_up`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `front_cms_media_gallery`
--
ALTER TABLE `front_cms_media_gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `front_cms_menus`
--
ALTER TABLE `front_cms_menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `front_cms_menu_items`
--
ALTER TABLE `front_cms_menu_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `front_cms_pages`
--
ALTER TABLE `front_cms_pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `front_cms_page_contents`
--
ALTER TABLE `front_cms_page_contents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `front_cms_programs`
--
ALTER TABLE `front_cms_programs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `front_cms_program_photos`
--
ALTER TABLE `front_cms_program_photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `front_cms_settings`
--
ALTER TABLE `front_cms_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `general_calls`
--
ALTER TABLE `general_calls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `giving_births`
--
ALTER TABLE `giving_births`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `income`
--
ALTER TABLE `income`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `income_head`
--
ALTER TABLE `income_head`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ipd_billing`
--
ALTER TABLE `ipd_billing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ipd_details`
--
ALTER TABLE `ipd_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item_category`
--
ALTER TABLE `item_category`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `item_issue`
--
ALTER TABLE `item_issue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item_stock`
--
ALTER TABLE `item_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item_store`
--
ALTER TABLE `item_store`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item_supplier`
--
ALTER TABLE `item_supplier`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lab`
--
ALTER TABLE `lab`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `lab_config`
--
ALTER TABLE `lab_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `lab_ecg`
--
ALTER TABLE `lab_ecg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lab_lab`
--
ALTER TABLE `lab_lab`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=506;

--
-- AUTO_INCREMENT for table `lab_ultra_sound`
--
ALTER TABLE `lab_ultra_sound`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lab_xray`
--
ALTER TABLE `lab_xray`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `leave_types`
--
ALTER TABLE `leave_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `medical`
--
ALTER TABLE `medical`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `medicine_bad_stock`
--
ALTER TABLE `medicine_bad_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `medicine_batch_details`
--
ALTER TABLE `medicine_batch_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `medicine_category`
--
ALTER TABLE `medicine_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification_roles`
--
ALTER TABLE `notification_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification_setting`
--
ALTER TABLE `notification_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `opd_details`
--
ALTER TABLE `opd_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `operation`
--
ALTER TABLE `operation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `operation_theatre`
--
ALTER TABLE `operation_theatre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `organisation`
--
ALTER TABLE `organisation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `organisations_charges`
--
ALTER TABLE `organisations_charges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ot_consultant_register`
--
ALTER TABLE `ot_consultant_register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pathology`
--
ALTER TABLE `pathology`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pathology_category`
--
ALTER TABLE `pathology_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pathology_report`
--
ALTER TABLE `pathology_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `patient_charges`
--
ALTER TABLE `patient_charges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient_income`
--
ALTER TABLE `patient_income`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient_nicu`
--
ALTER TABLE `patient_nicu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient_nursing`
--
ALTER TABLE `patient_nursing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient_operation`
--
ALTER TABLE `patient_operation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `patient_timeline`
--
ALTER TABLE `patient_timeline`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `patient_ward`
--
ALTER TABLE `patient_ward`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_settings`
--
ALTER TABLE `payment_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payslip_allowance`
--
ALTER TABLE `payslip_allowance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `permission_category`
--
ALTER TABLE `permission_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;

--
-- AUTO_INCREMENT for table `permission_group`
--
ALTER TABLE `permission_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `pharmacy`
--
ALTER TABLE `pharmacy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pharmacy_bill_basic`
--
ALTER TABLE `pharmacy_bill_basic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pharmacy_bill_detail`
--
ALTER TABLE `pharmacy_bill_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prescription`
--
ALTER TABLE `prescription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `print_setting`
--
ALTER TABLE `print_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `radio`
--
ALTER TABLE `radio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `radiology_report`
--
ALTER TABLE `radiology_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `read_notification`
--
ALTER TABLE `read_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `roles_permissions`
--
ALTER TABLE `roles_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1001;

--
-- AUTO_INCREMENT for table `send_notification`
--
ALTER TABLE `send_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sms_config`
--
ALTER TABLE `sms_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `source`
--
ALTER TABLE `source`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `staff_attendance`
--
ALTER TABLE `staff_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `staff_attendance_type`
--
ALTER TABLE `staff_attendance_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `staff_designation`
--
ALTER TABLE `staff_designation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `staff_leave_details`
--
ALTER TABLE `staff_leave_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `staff_leave_request`
--
ALTER TABLE `staff_leave_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff_payroll`
--
ALTER TABLE `staff_payroll`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff_payslip`
--
ALTER TABLE `staff_payslip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `staff_roles`
--
ALTER TABLE `staff_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `staff_timeline`
--
ALTER TABLE `staff_timeline`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `test_type_report`
--
ALTER TABLE `test_type_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tpa_master`
--
ALTER TABLE `tpa_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userlog`
--
ALTER TABLE `userlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=340;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=204;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visitors_book`
--
ALTER TABLE `visitors_book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visitors_purpose`
--
ALTER TABLE `visitors_purpose`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `content_for`
--
ALTER TABLE `content_for`
  ADD CONSTRAINT `content_for_ibfk_1` FOREIGN KEY (`content_id`) REFERENCES `contents` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `content_for_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `front_cms_page_contents`
--
ALTER TABLE `front_cms_page_contents`
  ADD CONSTRAINT `front_cms_page_contents_ibfk_1` FOREIGN KEY (`page_id`) REFERENCES `front_cms_pages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `front_cms_program_photos`
--
ALTER TABLE `front_cms_program_photos`
  ADD CONSTRAINT `front_cms_program_photos_ibfk_1` FOREIGN KEY (`program_id`) REFERENCES `front_cms_programs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `item_issue`
--
ALTER TABLE `item_issue`
  ADD CONSTRAINT `item_issue_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `item_issue_ibfk_2` FOREIGN KEY (`item_category_id`) REFERENCES `item_category` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `item_stock`
--
ALTER TABLE `item_stock`
  ADD CONSTRAINT `item_stock_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `item_stock_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `item_supplier` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `item_stock_ibfk_3` FOREIGN KEY (`store_id`) REFERENCES `item_store` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notification_roles`
--
ALTER TABLE `notification_roles`
  ADD CONSTRAINT `notification_roles_ibfk_1` FOREIGN KEY (`send_notification_id`) REFERENCES `send_notification` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notification_roles_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
