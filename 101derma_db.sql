-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2016 at 01:53 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `101derma_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `dr_appointments`
--

CREATE TABLE `dr_appointments` (
  `appointment_id` int(11) NOT NULL,
  `appointment_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `title` varchar(150) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `visit_id` int(11) NOT NULL DEFAULT '0',
  `appointment_reason` varchar(100) DEFAULT NULL,
  `clinic_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dr_appointments`
--

INSERT INTO `dr_appointments` (`appointment_id`, `appointment_date`, `end_date`, `start_time`, `end_time`, `title`, `patient_id`, `userid`, `status`, `visit_id`, `appointment_reason`, `clinic_id`) VALUES
(1, '2016-12-13', NULL, '21:35:00', '21:36:00', 'Miguel  Chan', 1, 2, 'Appointments', 0, 'papafisyal', NULL),
(2, '2016-12-13', NULL, '14:30:00', '15:00:00', 'Miguel  Chan', 1, 2, 'Appointments', 0, 'fisyal ba', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dr_appointment_log`
--

CREATE TABLE `dr_appointment_log` (
  `appointment_log_id` int(11) NOT NULL,
  `appointment_id` int(11) NOT NULL,
  `change_date_time` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `from_time` time NOT NULL,
  `to_time` time NOT NULL,
  `old_status` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `appointment_reason` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dr_bill`
--

CREATE TABLE `dr_bill` (
  `bill_id` int(11) NOT NULL,
  `bill_date` date NOT NULL,
  `bill_time` time DEFAULT NULL,
  `patient_id` int(11) NOT NULL,
  `visit_id` int(11) NOT NULL,
  `total_amount` decimal(10,0) NOT NULL,
  `due_amount` decimal(11,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dr_bill_detail`
--

CREATE TABLE `dr_bill_detail` (
  `bill_detail_id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `bill_id` int(11) NOT NULL,
  `particular` varchar(50) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `mrp` decimal(10,2) NOT NULL,
  `type` varchar(25) NOT NULL,
  `purchase_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dr_bill_payment_r`
--

CREATE TABLE `dr_bill_payment_r` (
  `bill_payment_id` int(11) NOT NULL,
  `bill_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `adjust_amount` decimal(11,0) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dr_clinic`
--

CREATE TABLE `dr_clinic` (
  `clinic_id` int(11) NOT NULL,
  `start_time` varchar(10) NOT NULL,
  `end_time` varchar(10) NOT NULL,
  `time_interval` decimal(11,2) NOT NULL DEFAULT '0.50',
  `clinic_name` varchar(50) DEFAULT NULL,
  `tag_line` varchar(100) DEFAULT NULL,
  `clinic_address` varchar(500) DEFAULT NULL,
  `landline` varchar(50) DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `facebook` varchar(50) DEFAULT NULL,
  `twitter` varchar(50) DEFAULT NULL,
  `google_plus` varchar(50) DEFAULT NULL,
  `next_followup_days` int(11) NOT NULL DEFAULT '15',
  `clinic_logo` varchar(255) DEFAULT NULL,
  `max_patient` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dr_clinic`
--

INSERT INTO `dr_clinic` (`clinic_id`, `start_time`, `end_time`, `time_interval`, `clinic_name`, `tag_line`, `clinic_address`, `landline`, `mobile`, `email`, `facebook`, `twitter`, `google_plus`, `next_followup_days`, `clinic_logo`, `max_patient`) VALUES
(1, '09:00 AM', '06:00 PM', '0.50', 'Derma101 Clinic Systems', 'Dermatology Clinic', '', '', '', '', NULL, NULL, NULL, 15, 'images/logo.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `dr_contacts`
--

CREATE TABLE `dr_contacts` (
  `contact_id` int(11) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) NOT NULL,
  `display_name` varchar(255) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `contact_image` varchar(255) NOT NULL DEFAULT 'images/Profile.png',
  `type` varchar(50) NOT NULL,
  `address_line_1` varchar(150) DEFAULT NULL,
  `address_line_2` varchar(150) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `postal_code` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dr_contacts`
--

INSERT INTO `dr_contacts` (`contact_id`, `first_name`, `middle_name`, `last_name`, `display_name`, `phone_number`, `email`, `contact_image`, `type`, `address_line_1`, `address_line_2`, `city`, `state`, `postal_code`, `country`) VALUES
(1, 'Miguel', '', 'Chan', 'Miguel', '123456789', 'franciscomiguelchan30@gmail.com', 'profile_picture/1.jpg', 'Home', 'asd', 'asd', 'asd', 'asd', '123', 'asd');

-- --------------------------------------------------------

--
-- Table structure for table `dr_contact_details`
--

CREATE TABLE `dr_contact_details` (
  `contact_detail_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `detail` varchar(150) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dr_data`
--

CREATE TABLE `dr_data` (
  `ck_data_id` int(11) NOT NULL,
  `ck_key` varchar(50) NOT NULL DEFAULT '',
  `ck_value` varchar(500) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dr_data`
--

INSERT INTO `dr_data` (`ck_data_id`, `ck_key`, `ck_value`) VALUES
(1, 'default_language', 'english'),
(2, 'default_timezone', 'Asia/Taipei'),
(3, 'default_timeformate', 'h:i A'),
(4, 'default_dateformate', 'd-m-Y'),
(5, 'working_days', '1,2,3,4,5');

-- --------------------------------------------------------

--
-- Table structure for table `dr_followup`
--

CREATE TABLE `dr_followup` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `followup_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dr_invoice`
--

CREATE TABLE `dr_invoice` (
  `invoice_id` int(11) NOT NULL,
  `static_prefix` varchar(10) NOT NULL,
  `left_pad` int(11) NOT NULL,
  `next_id` int(11) NOT NULL,
  `currency_symbol` varchar(10) NOT NULL,
  `currency_postfix` char(10) NOT NULL DEFAULT '/-'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dr_invoice`
--

INSERT INTO `dr_invoice` (`invoice_id`, `static_prefix`, `left_pad`, `next_id`, `currency_symbol`, `currency_postfix`) VALUES
(1, '', 3, 1, 'Rs.', '');

-- --------------------------------------------------------

--
-- Table structure for table `dr_menu_access`
--

CREATE TABLE `dr_menu_access` (
  `id` int(11) NOT NULL,
  `menu_name` varchar(50) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `allow` tinyint(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dr_menu_access`
--

INSERT INTO `dr_menu_access` (`id`, `menu_name`, `category_name`, `allow`) VALUES
(1, 'patients', 'Doctor', 1),
(2, 'all_patients', 'Doctor', 1),
(3, 'new_inquiry', 'Doctor', 1),
(4, 'appointments', 'Doctor', 1),
(5, 'reports', 'Doctor', 1),
(6, 'patients', 'Receptionist', 1),
(7, 'all_patients', 'Receptionist', 1),
(8, 'new_inquiry', 'Receptionist', 1),
(9, 'appointments', 'Receptionist', 1),
(10, 'appointment report', 'Doctor', 1),
(11, 'bill report', 'Doctor', 1);

-- --------------------------------------------------------

--
-- Table structure for table `dr_modules`
--

CREATE TABLE `dr_modules` (
  `module_id` int(11) NOT NULL,
  `module_name` varchar(50) NOT NULL,
  `module_display_name` varchar(50) NOT NULL,
  `module_description` varchar(150) NOT NULL,
  `module_status` int(1) NOT NULL,
  `module_version` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dr_navigation_menu`
--

CREATE TABLE `dr_navigation_menu` (
  `id` int(11) NOT NULL,
  `menu_name` varchar(250) DEFAULT NULL,
  `parent_name` varchar(250) NOT NULL,
  `menu_order` int(11) NOT NULL,
  `menu_url` varchar(500) DEFAULT NULL,
  `menu_icon` varchar(100) DEFAULT NULL,
  `menu_text` varchar(200) DEFAULT NULL,
  `required_module` varchar(25) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dr_navigation_menu`
--

INSERT INTO `dr_navigation_menu` (`id`, `menu_name`, `parent_name`, `menu_order`, `menu_url`, `menu_icon`, `menu_text`, `required_module`) VALUES
(1, 'patients', '', 200, 'patient/index', 'fa-users', 'Patients', ''),
(2, 'all_patients', 'patients', 0, 'patient/index', NULL, 'All Patients', NULL),
(4, 'appointments', '', 100, 'appointment/index', 'fa-calendar', 'Appointments', ''),
(5, 'reports', '', 400, '#', 'fa-line-chart', 'Reports', ''),
(6, 'administration', '', 500, '#', 'fa-cog', 'Administration', ''),
(8, 'appointment report', 'reports', 100, 'appointment/appointment_report', '', 'Appointment Report', ''),
(9, 'bill report', 'reports', 300, 'patient/bill_detail_report', '', 'Bill Detail Report', ''),
(10, 'clinic detail', 'administration', 100, 'settings/clinic', '', 'Clinic Detail', ''),
(11, 'invoice setting', 'administration', 200, 'settings/invoice', '', 'Invoice', ''),
(12, 'users', 'administration', 300, '#', '', 'Users', ''),
(13, 'setting', 'administration', 500, 'settings/change_settings', '', 'Setting', ''),
(14, 'payment', '', 300, 'payment/index', 'fa-money', 'Payments', ''),
(15, 'backup', 'administration', 600, 'settings/backup', NULL, 'Backup', NULL),
(16, 'new_patient', 'patients', 100, 'patient/insert/', NULL, 'Add Patient', NULL),
(17, 'working_days', 'administration', 200, 'settings/working_days', NULL, 'Working Days', NULL),
(18, 'all_users', 'users', 100, 'admin/users', NULL, 'All Users', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dr_patient`
--

CREATE TABLE `dr_patient` (
  `patient_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `patient_since` date NOT NULL,
  `display_id` varchar(12) DEFAULT NULL,
  `followup_date` date DEFAULT NULL,
  `reference_by` varchar(255) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `dob` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dr_patient`
--

INSERT INTO `dr_patient` (`patient_id`, `contact_id`, `patient_since`, `display_id`, `followup_date`, `reference_by`, `gender`, `dob`) VALUES
(1, 1, '2016-12-12', 'C00001', NULL, 'Doc', 'male', '2013-12-07');

-- --------------------------------------------------------

--
-- Table structure for table `dr_payment`
--

CREATE TABLE `dr_payment` (
  `payment_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `pay_date` date NOT NULL,
  `pay_mode` varchar(50) NOT NULL,
  `pay_amount` decimal(10,0) NOT NULL,
  `cheque_no` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dr_payment_transaction`
--

CREATE TABLE `dr_payment_transaction` (
  `transaction_id` int(11) NOT NULL,
  `bill_id` int(11) DEFAULT NULL,
  `patient_id` int(11) NOT NULL,
  `visit_id` int(11) NOT NULL,
  `amount` decimal(11,2) NOT NULL,
  `payment_type` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dr_receipt_template`
--

CREATE TABLE `dr_receipt_template` (
  `template_id` int(11) NOT NULL,
  `template` text NOT NULL,
  `is_default` int(1) NOT NULL,
  `template_name` varchar(25) NOT NULL,
  `type` varchar(15) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dr_receipt_template`
--

INSERT INTO `dr_receipt_template` (`template_id`, `template`, `is_default`, `template_name`, `type`) VALUES
(1, '<h1 style="text-align: center;">[clinic_name]</h1><h2 style="text-align: center;">[tag_line]</h2><p style="text-align: center;">[clinic_address]</p><p style="text-align: center;"><strong style="line-height: 1.42857143;">Landline : </strong><span style="line-height: 1.42857143;">[landline]</span> <strong style="line-height: 1.42857143;">Mobile : </strong><span style="line-height: 1.42857143;">[mobile]</span> <strong style="line-height: 1.42857143;">Email : </strong><span style="text-align: center;"> [email]</span></p><hr id="null" /><h3 style="text-align: center;"><u style="text-align: center;">RECEIPT</u></h3><p><span style="text-align: left;"><strong>Date : </strong>[bill_date] [bill_time]</span><span style="float: right;"><strong>Receipt Number :</strong> [bill_id]</span></p><p style="text-align: left;"><strong style="text-align: left;">Patient Name: </strong><span style="text-align: left;">[patient_name]<br /></span></p><hr id="null" style="text-align: left;" /><p>Received fees for Professional services and other charges of our:</p><p>&nbsp;</p><p>&nbsp;</p><table style="width: 100%; margin-top: 25px; margin-bottom: 25px; border-collapse: collapse; border: 1px solid black;"><thead><tr><td style="width: 400px; text-align: left; padding: 5px; border: 1px solid black;"><strong style="width: 400px; text-align: left;">Item</strong></td><td style="padding: 5px; border: 1px solid black;"><strong>Quantity</strong></td><td style="width: 100px; text-align: right; padding: 5px; border: 1px solid black;"><strong>M.R.P.</strong></td><td style="width: 100px; text-align: right; padding: 5px; border: 1px solid black;"><strong>Amount</strong></td></tr></thead><tbody><tr><td colspan="4">[col:particular|quantity|mrp|amount]</td></tr><tr><td style="padding: 5px; border: 1px solid black;" colspan="3">Previous Due</td><td style="text-align: right; padding: 5px; border: 1px solid black;"><strong>[previous_due]</strong></td></tr><tr><td style="padding: 5px; border: 1px solid black;" colspan="3">Discount</td><td style="text-align: right; padding: 5px; border: 1px solid black;"><strong>[discount]</strong></td></tr><tr><td style="padding: 5px; border: 1px solid black;" colspan="3">Total</td><td style="text-align: right; padding: 5px; border: 1px solid black;"><strong>[total]</strong></td></tr><tr><td style="padding: 5px; border: 1px solid black;" colspan="3">Paid Amount</td><td style="text-align: right; padding: 5px; border: 1px solid black;">[paid_amount]</td></tr></tbody></table><p>Received with Thanks,</p><p>For [clinic_name]</p><p>&nbsp;</p><p>&nbsp;</p><p>Signature</p>', 1, 'Main', 'bill');

-- --------------------------------------------------------

--
-- Table structure for table `dr_todos`
--

CREATE TABLE `dr_todos` (
  `id_num` int(11) NOT NULL,
  `userid` int(11) DEFAULT '0',
  `todo` varchar(250) DEFAULT NULL,
  `done` int(11) DEFAULT '0',
  `add_date` datetime DEFAULT NULL,
  `done_date` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dr_users`
--

CREATE TABLE `dr_users` (
  `userid` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(25) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(15) NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '1',
  `contact_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dr_users`
--

INSERT INTO `dr_users` (`userid`, `name`, `username`, `password`, `level`, `is_active`, `contact_id`) VALUES
(1, 'Administrator', 'admin', 'YWRtaW4=', 'Administrator', 1, NULL),
(2, 'Test Doctor', 'doctor', 'ZG9jdG9y', 'Doctor', 1, NULL),
(3, 'Test Receptionist', 'receptionist', 'cmVjZXB0aW9uaXN0', 'Receptionist', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dr_user_categories`
--

CREATE TABLE `dr_user_categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dr_user_categories`
--

INSERT INTO `dr_user_categories` (`id`, `category_name`) VALUES
(1, 'Administrator'),
(2, 'Doctor'),
(3, 'Receptionist');

-- --------------------------------------------------------

--
-- Table structure for table `dr_version`
--

CREATE TABLE `dr_version` (
  `id` int(11) NOT NULL,
  `current_version` varchar(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dr_version`
--

INSERT INTO `dr_version` (`id`, `current_version`) VALUES
(1, '0.3.8');

-- --------------------------------------------------------

--
-- Stand-in structure for view `dr_view_bill`
-- (See below for the actual view)
--
CREATE TABLE `dr_view_bill` (
`bill_id` int(11)
,`bill_date` date
,`visit_id` int(11)
,`doctor_name` varchar(255)
,`userid` int(11)
,`patient_id` int(11)
,`display_id` varchar(12)
,`first_name` varchar(50)
,`middle_name` varchar(50)
,`last_name` varchar(50)
,`total_amount` decimal(10,0)
,`due_amount` decimal(11,2)
,`pay_amount` decimal(33,0)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `dr_view_bill_detail_report`
-- (See below for the actual view)
--
CREATE TABLE `dr_view_bill_detail_report` (
`bill_id` int(11)
,`bill_date` date
,`visit_id` int(11)
,`particular` varchar(50)
,`amount` decimal(10,2)
,`userid` int(11)
,`patient_name` varchar(152)
,`display_id` varchar(12)
,`type` varchar(25)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `dr_view_contact_email`
-- (See below for the actual view)
--
CREATE TABLE `dr_view_contact_email` (
`contact_id` int(11)
,`email` varchar(150)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `dr_view_email`
-- (See below for the actual view)
--
CREATE TABLE `dr_view_email` (
`contact_id` int(11)
,`emails` text
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `dr_view_patient`
-- (See below for the actual view)
--
CREATE TABLE `dr_view_patient` (
`patient_id` int(11)
,`patient_since` date
,`display_id` varchar(12)
,`gender` varchar(10)
,`dob` date
,`reference_by` varchar(255)
,`followup_date` date
,`display_name` varchar(255)
,`contact_id` int(11)
,`first_name` varchar(50)
,`middle_name` varchar(50)
,`last_name` varchar(50)
,`phone_number` varchar(15)
,`email` varchar(150)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `dr_view_payment`
-- (See below for the actual view)
--
CREATE TABLE `dr_view_payment` (
`payment_id` int(11)
,`pay_date` date
,`pay_mode` varchar(50)
,`cheque_no` varchar(50)
,`pay_amount` decimal(10,0)
,`patient_id` int(11)
,`display_id` varchar(12)
,`first_name` varchar(50)
,`middle_name` varchar(50)
,`last_name` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `dr_view_report`
-- (See below for the actual view)
--
CREATE TABLE `dr_view_report` (
`appointment_id` int(11)
,`patient_id` int(11)
,`patient_name` varchar(152)
,`userid` int(11)
,`doctor_name` varchar(255)
,`appointment_date` date
,`appointment_time` time
,`waiting_in` time
,`waiting_out` time
,`waiting_duration` time
,`consultation_in` time
,`consultation_out` time
,`consultation_duration` time
,`collection_amount` decimal(10,0)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `dr_view_visit`
-- (See below for the actual view)
--
CREATE TABLE `dr_view_visit` (
`visit_id` int(11)
,`visit_date` varchar(60)
,`visit_time` varchar(50)
,`type` varchar(50)
,`notes` text
,`patient_notes` text
,`userid` int(11)
,`name` varchar(255)
,`patient_id` int(11)
,`bill_id` int(11)
,`total_amount` decimal(10,0)
,`due_amount` decimal(11,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `dr_view_visit_treatments`
-- (See below for the actual view)
--
CREATE TABLE `dr_view_visit_treatments` (
`visit_id` int(11)
,`particular` varchar(50)
,`type` varchar(25)
);

-- --------------------------------------------------------

--
-- Table structure for table `dr_visit`
--

CREATE TABLE `dr_visit` (
  `visit_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `notes` text NOT NULL,
  `type` varchar(50) NOT NULL,
  `visit_date` varchar(60) NOT NULL,
  `visit_time` varchar(50) DEFAULT NULL,
  `patient_notes` text,
  `appointment_reason` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dr_working_days`
--

CREATE TABLE `dr_working_days` (
  `uid` int(11) NOT NULL,
  `working_date` date NOT NULL,
  `working_status` varchar(15) NOT NULL,
  `working_reason` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure for view `dr_view_bill`
--
DROP TABLE IF EXISTS `dr_view_bill`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `dr_view_bill`  AS  select `bill`.`bill_id` AS `bill_id`,`bill`.`bill_date` AS `bill_date`,`bill`.`visit_id` AS `visit_id`,`users`.`name` AS `doctor_name`,`visit`.`userid` AS `userid`,`patient`.`patient_id` AS `patient_id`,`patient`.`display_id` AS `display_id`,`contacts`.`first_name` AS `first_name`,`contacts`.`middle_name` AS `middle_name`,`contacts`.`last_name` AS `last_name`,`bill`.`total_amount` AS `total_amount`,`bill`.`due_amount` AS `due_amount`,sum(`bill_payment_r`.`adjust_amount`) AS `pay_amount` from ((((((`dr_bill` `bill` join `dr_visit` `visit` on((`bill`.`visit_id` = `visit`.`visit_id`))) join `dr_users` `users` on((`visit`.`userid` = `users`.`userid`))) join `dr_patient` `patient` on((`bill`.`patient_id` = `patient`.`patient_id`))) join `dr_bill_payment_r` `bill_payment_r` on((`bill_payment_r`.`bill_id` = `bill`.`bill_id`))) join `dr_payment` `payment` on((`payment`.`payment_id` = `bill_payment_r`.`payment_id`))) join `dr_contacts` `contacts` on((`contacts`.`contact_id` = `patient`.`contact_id`))) group by `bill`.`bill_id`,`users`.`name`,`visit`.`userid`,`patient`.`patient_id` ;

-- --------------------------------------------------------

--
-- Structure for view `dr_view_bill_detail_report`
--
DROP TABLE IF EXISTS `dr_view_bill_detail_report`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `dr_view_bill_detail_report`  AS  select `bill`.`bill_id` AS `bill_id`,`bill`.`bill_date` AS `bill_date`,`bill`.`visit_id` AS `visit_id`,`bill_detail`.`particular` AS `particular`,`bill_detail`.`amount` AS `amount`,`visit`.`userid` AS `userid`,concat(`view_patient`.`first_name`,' ',`view_patient`.`middle_name`,' ',`view_patient`.`last_name`) AS `patient_name`,`view_patient`.`display_id` AS `display_id`,`bill_detail`.`type` AS `type` from (((`dr_bill` `bill` left join `dr_bill_detail` `bill_detail` on((`bill_detail`.`bill_id` = `bill`.`bill_id`))) left join `dr_visit` `visit` on((`visit`.`visit_id` = `bill`.`visit_id`))) left join `dr_view_patient` `view_patient` on((`view_patient`.`patient_id` = `bill`.`patient_id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `dr_view_contact_email`
--
DROP TABLE IF EXISTS `dr_view_contact_email`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `dr_view_contact_email`  AS  select `dr_contact_details`.`contact_id` AS `contact_id`,`dr_contact_details`.`detail` AS `email` from `dr_contact_details` where (`dr_contact_details`.`type` = 'email') ;

-- --------------------------------------------------------

--
-- Structure for view `dr_view_email`
--
DROP TABLE IF EXISTS `dr_view_email`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `dr_view_email`  AS  select `dr_contact_details`.`contact_id` AS `contact_id`,group_concat(`dr_contact_details`.`detail` separator ',') AS `emails` from `dr_contact_details` where (`dr_contact_details`.`type` = 'email') group by `dr_contact_details`.`contact_id` ;

-- --------------------------------------------------------

--
-- Structure for view `dr_view_patient`
--
DROP TABLE IF EXISTS `dr_view_patient`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `dr_view_patient`  AS  select `patient`.`patient_id` AS `patient_id`,`patient`.`patient_since` AS `patient_since`,`patient`.`display_id` AS `display_id`,`patient`.`gender` AS `gender`,`patient`.`dob` AS `dob`,`patient`.`reference_by` AS `reference_by`,`patient`.`followup_date` AS `followup_date`,`contacts`.`display_name` AS `display_name`,`contacts`.`contact_id` AS `contact_id`,`contacts`.`first_name` AS `first_name`,`contacts`.`middle_name` AS `middle_name`,`contacts`.`last_name` AS `last_name`,`contacts`.`phone_number` AS `phone_number`,`contacts`.`email` AS `email` from (`dr_patient` `patient` left join `dr_contacts` `contacts` on((`patient`.`contact_id` = `contacts`.`contact_id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `dr_view_payment`
--
DROP TABLE IF EXISTS `dr_view_payment`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `dr_view_payment`  AS  select distinct `payment`.`payment_id` AS `payment_id`,`payment`.`pay_date` AS `pay_date`,`payment`.`pay_mode` AS `pay_mode`,`payment`.`cheque_no` AS `cheque_no`,`payment`.`pay_amount` AS `pay_amount`,`patient`.`patient_id` AS `patient_id`,`patient`.`display_id` AS `display_id`,`contacts`.`first_name` AS `first_name`,`contacts`.`middle_name` AS `middle_name`,`contacts`.`last_name` AS `last_name` from ((`dr_payment` `payment` join `dr_patient` `patient` on((`patient`.`patient_id` = `payment`.`patient_id`))) join `dr_contacts` `contacts` on((`contacts`.`contact_id` = `patient`.`contact_id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `dr_view_report`
--
DROP TABLE IF EXISTS `dr_view_report`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `dr_view_report`  AS  select `appointment`.`appointment_id` AS `appointment_id`,`appointment`.`patient_id` AS `patient_id`,concat(ifnull(`view_patient`.`first_name`,''),' ',ifnull(`view_patient`.`middle_name`,''),' ',ifnull(`view_patient`.`last_name`,'')) AS `patient_name`,`appointment`.`userid` AS `userid`,`users`.`name` AS `doctor_name`,`appointment`.`appointment_date` AS `appointment_date`,min(`appointment`.`start_time`) AS `appointment_time`,max((case `appointment_log`.`status` when 'Waiting' then `appointment_log`.`from_time` end)) AS `waiting_in`,max((case `appointment_log`.`old_status` when 'Consultation' then timediff(`appointment_log`.`from_time`,`appointment_log`.`to_time`) end)) AS `waiting_out`,timediff(max((case `appointment_log`.`status` when 'Consultation' then `appointment_log`.`from_time` end)),max((case `appointment_log`.`status` when 'Waiting' then `appointment_log`.`from_time` end))) AS `waiting_duration`,max((case `appointment_log`.`status` when 'Consultation' then `appointment_log`.`from_time` end)) AS `consultation_in`,max((case `appointment_log`.`status` when 'Complete' then `appointment_log`.`from_time` end)) AS `consultation_out`,timediff(max((case `appointment_log`.`status` when 'Complete' then `appointment_log`.`from_time` end)),max((case `appointment_log`.`status` when 'Consultation' then `appointment_log`.`from_time` end))) AS `consultation_duration`,max(`bill`.`total_amount`) AS `collection_amount` from ((((`dr_appointments` `appointment` left join `dr_view_patient` `view_patient` on((`appointment`.`patient_id` = `view_patient`.`patient_id`))) left join `dr_bill` `bill` on((`appointment`.`visit_id` = `bill`.`visit_id`))) left join `dr_appointment_log` `appointment_log` on((`appointment`.`appointment_id` = `appointment_log`.`appointment_id`))) left join `dr_users` `users` on((`users`.`userid` = `appointment`.`userid`))) group by `appointment`.`appointment_id`,`patient_name` ;

-- --------------------------------------------------------

--
-- Structure for view `dr_view_visit`
--
DROP TABLE IF EXISTS `dr_view_visit`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `dr_view_visit`  AS  select `visit`.`visit_id` AS `visit_id`,`visit`.`visit_date` AS `visit_date`,`visit`.`visit_time` AS `visit_time`,`visit`.`type` AS `type`,`visit`.`notes` AS `notes`,`visit`.`patient_notes` AS `patient_notes`,`visit`.`userid` AS `userid`,`users`.`name` AS `name`,`visit`.`patient_id` AS `patient_id`,`bill`.`bill_id` AS `bill_id`,`bill`.`total_amount` AS `total_amount`,`bill`.`due_amount` AS `due_amount` from ((`dr_visit` `visit` join `dr_users` `users` on((`users`.`userid` = `visit`.`userid`))) join `dr_bill` `bill` on((`bill`.`visit_id` = `visit`.`visit_id`))) order by `visit`.`patient_id`,`visit`.`visit_date`,`visit`.`visit_time` ;

-- --------------------------------------------------------

--
-- Structure for view `dr_view_visit_treatments`
--
DROP TABLE IF EXISTS `dr_view_visit_treatments`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `dr_view_visit_treatments`  AS  select `visit`.`visit_id` AS `visit_id`,`bill_detail`.`particular` AS `particular`,`bill_detail`.`type` AS `type` from ((`dr_visit` `visit` left join `dr_bill` `bill` on((`bill`.`visit_id` = `visit`.`visit_id`))) left join `dr_bill_detail` `bill_detail` on((`bill_detail`.`bill_id` = `bill`.`bill_id`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dr_appointments`
--
ALTER TABLE `dr_appointments`
  ADD PRIMARY KEY (`appointment_id`);

--
-- Indexes for table `dr_appointment_log`
--
ALTER TABLE `dr_appointment_log`
  ADD PRIMARY KEY (`appointment_log_id`);

--
-- Indexes for table `dr_bill`
--
ALTER TABLE `dr_bill`
  ADD PRIMARY KEY (`bill_id`);

--
-- Indexes for table `dr_bill_detail`
--
ALTER TABLE `dr_bill_detail`
  ADD PRIMARY KEY (`bill_detail_id`);

--
-- Indexes for table `dr_bill_payment_r`
--
ALTER TABLE `dr_bill_payment_r`
  ADD PRIMARY KEY (`bill_payment_id`);

--
-- Indexes for table `dr_clinic`
--
ALTER TABLE `dr_clinic`
  ADD PRIMARY KEY (`clinic_id`);

--
-- Indexes for table `dr_contacts`
--
ALTER TABLE `dr_contacts`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `dr_contact_details`
--
ALTER TABLE `dr_contact_details`
  ADD PRIMARY KEY (`contact_detail_id`);

--
-- Indexes for table `dr_data`
--
ALTER TABLE `dr_data`
  ADD PRIMARY KEY (`ck_data_id`);

--
-- Indexes for table `dr_followup`
--
ALTER TABLE `dr_followup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dr_invoice`
--
ALTER TABLE `dr_invoice`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indexes for table `dr_menu_access`
--
ALTER TABLE `dr_menu_access`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dr_modules`
--
ALTER TABLE `dr_modules`
  ADD PRIMARY KEY (`module_id`),
  ADD UNIQUE KEY `module_name` (`module_name`);

--
-- Indexes for table `dr_navigation_menu`
--
ALTER TABLE `dr_navigation_menu`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menu_name` (`menu_name`);

--
-- Indexes for table `dr_patient`
--
ALTER TABLE `dr_patient`
  ADD PRIMARY KEY (`patient_id`);

--
-- Indexes for table `dr_payment`
--
ALTER TABLE `dr_payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `dr_payment_transaction`
--
ALTER TABLE `dr_payment_transaction`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `dr_receipt_template`
--
ALTER TABLE `dr_receipt_template`
  ADD PRIMARY KEY (`template_id`);

--
-- Indexes for table `dr_todos`
--
ALTER TABLE `dr_todos`
  ADD PRIMARY KEY (`id_num`);

--
-- Indexes for table `dr_users`
--
ALTER TABLE `dr_users`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `dr_user_categories`
--
ALTER TABLE `dr_user_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dr_version`
--
ALTER TABLE `dr_version`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dr_visit`
--
ALTER TABLE `dr_visit`
  ADD PRIMARY KEY (`visit_id`);

--
-- Indexes for table `dr_working_days`
--
ALTER TABLE `dr_working_days`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dr_appointments`
--
ALTER TABLE `dr_appointments`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `dr_appointment_log`
--
ALTER TABLE `dr_appointment_log`
  MODIFY `appointment_log_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `dr_bill`
--
ALTER TABLE `dr_bill`
  MODIFY `bill_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `dr_bill_detail`
--
ALTER TABLE `dr_bill_detail`
  MODIFY `bill_detail_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `dr_bill_payment_r`
--
ALTER TABLE `dr_bill_payment_r`
  MODIFY `bill_payment_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `dr_contacts`
--
ALTER TABLE `dr_contacts`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `dr_contact_details`
--
ALTER TABLE `dr_contact_details`
  MODIFY `contact_detail_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `dr_data`
--
ALTER TABLE `dr_data`
  MODIFY `ck_data_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `dr_followup`
--
ALTER TABLE `dr_followup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `dr_invoice`
--
ALTER TABLE `dr_invoice`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `dr_menu_access`
--
ALTER TABLE `dr_menu_access`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `dr_modules`
--
ALTER TABLE `dr_modules`
  MODIFY `module_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `dr_navigation_menu`
--
ALTER TABLE `dr_navigation_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `dr_patient`
--
ALTER TABLE `dr_patient`
  MODIFY `patient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `dr_payment`
--
ALTER TABLE `dr_payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `dr_payment_transaction`
--
ALTER TABLE `dr_payment_transaction`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `dr_receipt_template`
--
ALTER TABLE `dr_receipt_template`
  MODIFY `template_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `dr_todos`
--
ALTER TABLE `dr_todos`
  MODIFY `id_num` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `dr_users`
--
ALTER TABLE `dr_users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `dr_user_categories`
--
ALTER TABLE `dr_user_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `dr_version`
--
ALTER TABLE `dr_version`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `dr_visit`
--
ALTER TABLE `dr_visit`
  MODIFY `visit_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `dr_working_days`
--
ALTER TABLE `dr_working_days`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
