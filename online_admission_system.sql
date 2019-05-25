-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2019 at 05:44 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_admission_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'Admin', '4d813d28f0aaaa4e9da0fb6e55293607');

-- --------------------------------------------------------

--
-- Table structure for table `admission_notices`
--

CREATE TABLE `admission_notices` (
  `id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `session_name` varchar(20) NOT NULL,
  `session_year` year(4) NOT NULL,
  `notice_date` date NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admission_notices`
--

INSERT INTO `admission_notices` (`id`, `start_date`, `end_date`, `session_name`, `session_year`, `notice_date`, `status`) VALUES
(8, '2019-05-14', '2019-05-20', 'Summer', 2019, '2019-05-14', 1);

-- --------------------------------------------------------

--
-- Table structure for table `admit_card`
--

CREATE TABLE `admit_card` (
  `id` int(11) NOT NULL,
  `registration_id` int(11) NOT NULL,
  `student_hsc_roll` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `exam_date` date NOT NULL,
  `exam_time` time NOT NULL,
  `session_name` varchar(11) NOT NULL,
  `session_year` int(11) NOT NULL,
  `venue` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admit_card`
--

INSERT INTO `admit_card` (`id`, `registration_id`, `student_hsc_roll`, `program_id`, `exam_date`, `exam_time`, `session_name`, `session_year`, `venue`) VALUES
(10, 2, 232233, 13, '2019-05-20', '14:30:00', 'Summer', 2019, 'stamford');

-- --------------------------------------------------------

--
-- Table structure for table `applied_application`
--

CREATE TABLE `applied_application` (
  `registration_id` int(11) NOT NULL,
  `student_hsc_roll` int(11) NOT NULL,
  `program_id` varchar(11) NOT NULL,
  `registration_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `session_name` varchar(50) NOT NULL,
  `session_year` year(4) NOT NULL,
  `amount` int(11) NOT NULL,
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending',
  `archive` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `applied_application`
--

INSERT INTO `applied_application` (`registration_id`, `student_hsc_roll`, `program_id`, `registration_date`, `session_name`, `session_year`, `amount`, `payment_status`, `archive`) VALUES
(3, 232233, '7,8,9', '2019-05-14 11:02:20', 'Summer', 2019, 2200, 'pending', 0);

-- --------------------------------------------------------

--
-- Table structure for table `display_content`
--

CREATE TABLE `display_content` (
  `id` int(11) NOT NULL,
  `fb` varchar(100) NOT NULL,
  `twitter` varchar(100) NOT NULL,
  `linkedin` varchar(100) NOT NULL,
  `google_plus` varchar(200) NOT NULL,
  `youtube` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `display_content`
--

INSERT INTO `display_content` (`id`, `fb`, `twitter`, `linkedin`, `google_plus`, `youtube`, `address`, `email`, `mobile`) VALUES
(1, 'https://www.facebook.com/Stamford.versity/', 'twitter/stamford', 'linkedin/stamford', 'google.com', 'youtube.com', '52 Shiddeswari, Dhaka', 'stamford@mail.com', '1680079653');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `sender_name` varchar(100) NOT NULL,
  `sender_email` varchar(100) NOT NULL,
  `message` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `sender_name`, `sender_email`, `message`, `date`, `status`) VALUES
(10, 'Nadim', '404nadim@gmail.com', 'testing..', '2019-05-03 17:23:08', 1),
(11, 'Nadim', '404nadim@gmail.com', 'testing 2..', '2019-05-03 17:28:14', 1),
(12, 'Nasrullah Al Nadim', '404@gmail.com', 'test', '2019-05-05 08:54:23', 1),
(13, 'Nasrullah Al Nadim', '404@gmail.com', 'feedback', '2019-05-09 06:42:27', 1),
(14, 'Nasrullah Al Nadim', '404@gmail.com', 'Test', '2019-05-14 09:49:27', 1);

-- --------------------------------------------------------

--
-- Table structure for table `other_notice`
--

CREATE TABLE `other_notice` (
  `id` int(11) NOT NULL,
  `title` varchar(60) NOT NULL,
  `details` varchar(500) NOT NULL,
  `date` date NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `other_notice`
--

INSERT INTO `other_notice` (`id`, `title`, `details`, `date`, `status`) VALUES
(1, 'Test', 'Just testing', '2019-05-14', 1);

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `program_id` int(11) NOT NULL,
  `program_name` varchar(50) NOT NULL,
  `required_group` varchar(100) NOT NULL,
  `required_gpa` double NOT NULL,
  `registration_fee` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`program_id`, `program_name`, `required_group`, `required_gpa`, `registration_fee`) VALUES
(7, 'Architechture', 'Science', 3, 600),
(8, 'EEE', 'Science', 3, 600),
(9, 'CIVIL', 'Science', 3, 1000),
(13, 'English', 'Science,Business Studies', 2.5, 500),
(14, 'Pharmacy', 'Science', 3, 500),
(15, 'Journalism', 'Science', 4, 1000);

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE `result` (
  `id` int(11) NOT NULL,
  `hsc_roll` int(11) NOT NULL,
  `session` varchar(20) NOT NULL,
  `english` double NOT NULL,
  `math` double NOT NULL,
  `gk` double NOT NULL,
  `total` double NOT NULL,
  `position` int(11) DEFAULT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `result`
--

INSERT INTO `result` (`id`, `hsc_roll`, `session`, `english`, `math`, `gk`, `total`, `position`, `status`) VALUES
(57, 443322, 'Summer 2019', 7, 6, 5, 18, 1, 1),
(58, 232233, 'Summer 2019', 4, 5, 7, 16, 2, 1),
(59, 332211, 'Summer 2019', 5, 6, 5, 11, 0, 0),
(60, 776655, 'Summer 2019', 4, 3, 4, 10, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

CREATE TABLE `slides` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slides`
--

INSERT INTO `slides` (`id`, `title`, `image`) VALUES
(1, 'Shiddeswari Campus', 'shiddeswari.jpg'),
(2, 'Permanent Campus', 'Parmanent_Campus.jpg'),
(3, 'Dhanmondi Campus', 'dhanmondi.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `student_academic_info`
--

CREATE TABLE `student_academic_info` (
  `ssc_roll` int(11) NOT NULL,
  `ssc_registration` int(11) NOT NULL,
  `ssc_group` varchar(20) NOT NULL,
  `ssc_board` varchar(50) NOT NULL,
  `ssc_passing_year` int(11) NOT NULL,
  `ssc_gpa` double NOT NULL,
  `hsc_roll` int(11) NOT NULL,
  `hsc_registration` int(11) NOT NULL,
  `hsc_group` varchar(20) NOT NULL,
  `hsc_board` varchar(50) NOT NULL,
  `hsc_passing_year` int(11) NOT NULL,
  `hsc_gpa` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_academic_info`
--

INSERT INTO `student_academic_info` (`ssc_roll`, `ssc_registration`, `ssc_group`, `ssc_board`, `ssc_passing_year`, `ssc_gpa`, `hsc_roll`, `hsc_registration`, `hsc_group`, `hsc_board`, `hsc_passing_year`, `hsc_gpa`) VALUES
(101436, 489392, 'Science', 'Dhaka', 2011, 5, 112142, 666719, 'Science', 'Dhaka', 2013, 3.7),
(121212, 485263, 'Science', 'Dhaka', 2016, 5, 232233, 475263, 'Science', 'Dhaka', 2018, 5),
(123456, 489392, 'Science', 'Dhaka', 2019, 5, 654321, 666719, 'Business Studies', 'Dhaka', 2019, 3.7),
(556677, 489392, 'Science', 'Dhaka', 2019, 5, 776655, 666719, 'Science', 'Dhaka', 2019, 2.7);

-- --------------------------------------------------------

--
-- Table structure for table `student_login_info`
--

CREATE TABLE `student_login_info` (
  `ssc_roll` int(11) NOT NULL,
  `hsc_roll` int(11) NOT NULL,
  `first_name` varchar(200) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `registration_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_login_info`
--

INSERT INTO `student_login_info` (`ssc_roll`, `hsc_roll`, `first_name`, `last_name`, `email`, `image`, `password`, `registration_date`, `status`) VALUES
(101436, 112142, 'Nasrullah Al', 'Nadim', '404nadim@gmail.com', 'IMG_5682.jpg', '415cf04a3d4dac485d4f935baf6ce99e', '2019-02-12 09:36:35', 1),
(121212, 232233, 'Mr', 'abc', 'a@a.com', 'IMG_20170523_172919.jpg', '415cf04a3d4dac485d4f935baf6ce99e', '2019-01-31 18:00:00', 1),
(123456, 654321, 'Mr', 'Nadim', 'n@n.com', 'IMG_5682.jpg', '415cf04a3d4dac485d4f935baf6ce99e', '2019-05-13 10:44:08', 1),
(223344, 443322, 'MD', 'Xyz', 'xyz@g.com', 'IMG_5682.jpg', '415cf04a3d4dac485d4f935baf6ce99e', '2019-05-13 10:25:53', 1),
(556677, 776655, 'MD', 'Babu', 'b@b.com', '', '415cf04a3d4dac485d4f935baf6ce99e', '2019-05-13 12:33:11', 1),
(778899, 998877, 'Test', 'Name', 't@t.com', '', '4d813d28f0aaaa4e9da0fb6e55293607', '2019-05-14 15:59:26', 1);

-- --------------------------------------------------------

--
-- Table structure for table `student_personal_info`
--

CREATE TABLE `student_personal_info` (
  `ssc_roll` int(11) NOT NULL,
  `hsc_roll` int(11) NOT NULL,
  `date_of_birth` date NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `father_name` varchar(100) NOT NULL,
  `mother_name` varchar(100) NOT NULL,
  `parent_mobile` int(11) NOT NULL,
  `permanent_address` varchar(400) NOT NULL,
  `present_address` varchar(400) NOT NULL,
  `religion` varchar(20) NOT NULL,
  `marital_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_personal_info`
--

INSERT INTO `student_personal_info` (`ssc_roll`, `hsc_roll`, `date_of_birth`, `mobile`, `gender`, `father_name`, `mother_name`, `parent_mobile`, `permanent_address`, `present_address`, `religion`, `marital_status`) VALUES
(101436, 112142, '1995-08-29', '01974986858', 'Male', 'Nur Mohammad', 'Nargis Akter', 1680079653, 'Shahjahanpur, Dhaka \r\n \r\n \r\n \r\n \r\n \r\n', 'Shahjahanpur, Dhaka', 'Muslim', 'Unmarried'),
(121212, 232233, '2006-07-28', '01680079653', 'Male', 'Fsfsf', 'Fsaasfsa', 1974986858, ' dsfdsfsdfdsds\r\n \r\n \r\n', 'dfdfdsfsdfsd', 'Muslim', 'Unmarried'),
(223344, 443322, '1995-08-29', '01680079653', 'Male', 'Nur Mohammad', 'Nargis Akter', 1680079653, 'Shahjahanpur, Dhaka', 'Shahjahanpur, Dhaka', 'Muslim', 'Unmarried'),
(123456, 654321, '1995-08-29', '1680079653', 'Male', 'Nur Mohammad', 'Nargis Akter', 1680079653, 'Shahjahanpur, Dhaka \r\n \r\n', 'Shahjahanpur, Dhaka', 'Muslim', 'Unmarried'),
(556677, 776655, '1995-08-29', '1680079653', 'Male', 'Nur Mohammad', 'Nargis Akter', 1680079653, 'Shahjahanpur, Dhaka', 'Shahjahanpur, Dhaka', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee`
--

CREATE TABLE `tbl_employee` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `gender` varchar(10) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_employee`
--

INSERT INTO `tbl_employee` (`id`, `name`, `address`, `gender`, `designation`, `age`, `image`) VALUES
(1, 'Bruce Tom', '656 Edsel Road\r\nSherman Oaks, CA 91403', 'Male', 'Driver', 36, '1.jpg'),
(5, 'Clara Gilliam', '63 Woodridge Lane\r\nMemphis, TN 38138', 'Female', 'Programmer', 24, '2.jpg'),
(6, 'Barbra K. Hurley', '1241 Canis Heights Drive\r\nLos Angeles, CA 90017', 'Female', 'Service technician', 26, '3.jpg'),
(7, 'Antonio J. Forbes', '403 Snyder Avenue\r\nCharlotte, NC 28208', 'Male', 'Faller', 32, '4.jpg'),
(8, 'Charles D. Horst', '1636 Walnut Hill Drive\r\nCincinnati, OH 45202', 'Male', 'Financial investigator', 29, '5.jpg'),
(161, 'Glenda J. Stewart', '3482 Pursglove Court, Rossburg, OH 45362', 'Female', 'Cost consultant', 28, '8.jpg'),
(162, 'Jarrod D. Jones', '3827 Bingamon Road, Garfield Heights, OH 44125', 'Male', 'Manpower development advisor', 64, '9.jpg'),
(163, 'William C. Wright', '2653 Pyramid Valley Road, Cedar Rapids, IA 52404', 'Male', 'Political geographer', 33, '10.jpg'),
(174, 'Martha B. Tomlinson', '4005 Bird Spring Lane, Houston, TX 77002', 'Female', 'Systems programmer', 38, '7.jpg'),
(175, 'Ronald D. Colella', '1571 Bingamon Branch Road, Barrington, IL 60010', 'Male', 'Top executive', 32, '6.jpg'),
(177, 'Patricia L. Scott', '1584 Dennison Street\r\nModesto, CA 95354', 'Female', 'Urban and regional planner', 54, ''),
(178, 'Sara K. Ebert', '1197 Nelm Street\r\nMc Lean, VA 22102', 'Female', 'Billing machine operator', 50, ''),
(179, 'James K. Ridgway', '3462 Jody Road\r\nWayne, PA 19088', 'Female', 'Recreation leader', 41, ''),
(180, 'Stephen A. Crook', '448 Deercove Drive\r\nDallas, TX 75201', 'Male', 'Optical goods worker', 36, ''),
(181, 'Kimberly J. Ellis', '4905 Holt Street\r\nFort Lauderdale, FL 33301', 'Male', 'Dressing room attendant', 24, ''),
(182, 'Elizabeth N. Bradley', '1399 Randall Drive\r\nHonolulu, HI 96819', 'Female', ' Software quality assurance analyst', 25, ''),
(183, 'Steve John', '108, Vile Parle, CL', 'Male', 'Software Engineer', 29, ''),
(184, 'Marks Johnson', '021, Big street, NY', 'Male', 'Head of IT', 41, ''),
(185, 'Mak Pub', '1462 Juniper Drive\r\nBreckenridge, MI 48612', 'Male', 'Mental health counselor', 40, ''),
(186, 'Louis C. ', '1462 Juniper Drive\r\nBreckenridge, MI 48612', 'Male', 'Mental health counselor', 40, ''),
(187, 'Nasrullah ', 'Shahjahanpur, Dhaka', 'Male', 'student', 23, '');

-- --------------------------------------------------------

--
-- Table structure for table `terms_and_condition`
--

CREATE TABLE `terms_and_condition` (
  `id` int(11) NOT NULL,
  `hsc_year_difference` int(11) NOT NULL,
  `pass_mark` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `terms_and_condition`
--

INSERT INTO `terms_and_condition` (`id`, `hsc_year_difference`, `pass_mark`) VALUES
(1, 2, 11);

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id` int(11) NOT NULL,
  `programs` varchar(100) DEFAULT NULL,
  `required_group` varchar(100) DEFAULT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`id`, `programs`, `required_group`, `date`) VALUES
(10, NULL, NULL, '0000-00-00 00:00:00'),
(11, NULL, NULL, '0000-00-00 00:00:00'),
(12, '', 'Science', '0000-00-00 00:00:00'),
(13, '', 'Science,Business Studies', '0000-00-00 00:00:00'),
(14, '', 'Science,Business Studies', '0000-00-00 00:00:00'),
(15, '', 'Arts', '0000-00-00 00:00:00'),
(16, '', 'Business Studies', '2019-02-10 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admission_notices`
--
ALTER TABLE `admission_notices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admit_card`
--
ALTER TABLE `admit_card`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `applied_application`
--
ALTER TABLE `applied_application`
  ADD PRIMARY KEY (`registration_id`);

--
-- Indexes for table `display_content`
--
ALTER TABLE `display_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `other_notice`
--
ALTER TABLE `other_notice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`program_id`);

--
-- Indexes for table `result`
--
ALTER TABLE `result`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_academic_info`
--
ALTER TABLE `student_academic_info`
  ADD PRIMARY KEY (`hsc_roll`);

--
-- Indexes for table `student_login_info`
--
ALTER TABLE `student_login_info`
  ADD PRIMARY KEY (`ssc_roll`,`hsc_roll`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `student_personal_info`
--
ALTER TABLE `student_personal_info`
  ADD PRIMARY KEY (`hsc_roll`);

--
-- Indexes for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terms_and_condition`
--
ALTER TABLE `terms_and_condition`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admission_notices`
--
ALTER TABLE `admission_notices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `admit_card`
--
ALTER TABLE `admit_card`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `applied_application`
--
ALTER TABLE `applied_application`
  MODIFY `registration_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `other_notice`
--
ALTER TABLE `other_notice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `program_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `result`
--
ALTER TABLE `result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `slides`
--
ALTER TABLE `slides`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=188;

--
-- AUTO_INCREMENT for table `terms_and_condition`
--
ALTER TABLE `terms_and_condition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
