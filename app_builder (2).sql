-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2021 at 02:59 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `app_builder`
--

-- --------------------------------------------------------

--
-- Table structure for table `app`
--

CREATE TABLE `app` (
  `a_id` int(10) NOT NULL,
  `a_name` varchar(255) NOT NULL,
  `a_description` text NOT NULL,
  `a_user` int(10) NOT NULL,
  `a_date` int(50) NOT NULL,
  `a_time` varchar(250) NOT NULL,
  `a_key` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `app_flow`
--

CREATE TABLE `app_flow` (
  `af_id` int(10) NOT NULL,
  `af_group` int(10) NOT NULL,
  `af_sort` varchar(255) NOT NULL,
  `af_user` varchar(255) NOT NULL,
  `af_time` varchar(255) NOT NULL,
  `af_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `app_flow_group`
--

CREATE TABLE `app_flow_group` (
  `afg_id` int(10) NOT NULL,
  `afg_app` varchar(255) NOT NULL,
  `afg_name` varchar(255) NOT NULL,
  `afg_description` text NOT NULL,
  `afg_template` int(20) NOT NULL,
  `afg_time` varchar(255) NOT NULL,
  `afg_user` varchar(255) NOT NULL,
  `afg_status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `app_metadata`
--

CREATE TABLE `app_metadata` (
  `am_id` int(10) NOT NULL,
  `am_app` int(10) NOT NULL,
  `am_time` varchar(255) NOT NULL,
  `am_version` int(20) NOT NULL,
  `am_build` int(20) NOT NULL,
  `am_description` text NOT NULL,
  `am_user` varchar(255) NOT NULL,
  `am_key` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `app_navigate`
--

CREATE TABLE `app_navigate` (
  `an_id` int(10) NOT NULL,
  `an_name` varchar(255) NOT NULL,
  `an_time` varchar(255) NOT NULL,
  `an_user` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `app_navigate_page`
--

CREATE TABLE `app_navigate_page` (
  `anp_id` int(10) NOT NULL,
  `anp_navigate` int(10) NOT NULL,
  `anp_sort` varchar(255) NOT NULL,
  `anp_page` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `app_pages`
--

CREATE TABLE `app_pages` (
  `ap_id` int(10) NOT NULL,
  `ap_title` varchar(255) NOT NULL,
  `ap_type` int(10) NOT NULL,
  `ap_code` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `app_page_widget`
--

CREATE TABLE `app_page_widget` (
  `apw_id` int(10) NOT NULL,
  `apw_page` int(10) NOT NULL,
  `apw_widget` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `app_user`
--

CREATE TABLE `app_user` (
  `ap_id` int(10) NOT NULL,
  `ap_app` int(10) NOT NULL,
  `ap_user` int(10) NOT NULL,
  `ap_role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_id` int(11) NOT NULL,
  `u_name` varchar(255) NOT NULL,
  `u_password` varchar(255) NOT NULL,
  `u_email` varchar(255) NOT NULL,
  `u_phone` varchar(50) NOT NULL,
  `u_time` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `u_name`, `u_password`, `u_email`, `u_phone`, `u_time`) VALUES
(1, 'Kotori', '123456', 'ashjiahao1205@gmail.com', '011-60760587', 1632611115),
(2, 'Kotori', '123456', 'ashjiahao12052@gmail.com', '011-60760587', 1632611195),
(3, 'Kotori', '62a977a63265f17cf7b36ff56ff8f3b463758ad99224b5726c7ec5b263d07275', 'ashjiahao120523232@gmail.com', '011-60760587', 1632611273);

-- --------------------------------------------------------

--
-- Table structure for table `widget`
--

CREATE TABLE `widget` (
  `w_id` int(10) NOT NULL,
  `w_name` varchar(255) NOT NULL,
  `w_code` longtext NOT NULL,
  `w_user` varchar(255) NOT NULL,
  `w_type` varchar(250) NOT NULL,
  `w_category` varchar(250) NOT NULL,
  `w_time` varchar(255) NOT NULL,
  `w_image` varchar(255) NOT NULL,
  `w_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `widget`
--

INSERT INTO `widget` (`w_id`, `w_name`, `w_code`, `w_user`, `w_type`, `w_category`, `w_time`, `w_image`, `w_status`) VALUES
(1, 'coloumn', '<div class=\"row\">\r\n	<div class=\"col-12\">col 1</div>\r\n</div>', '', '', '', '10.15', '1 Coloumn.png', 1),
(2, 'Button', '<div class=\"col-12\"><button type=\"button\" class=\"btn btn-primary col-md-12\">Button</button></div>', '', '', '', '10.15', 'Button.png', 1),
(3, '3 Column', '<div class=\"row\"> 					\r\n	<div class=\"col-4\">col 1</div> 					\r\n	<div class=\"col-4\">col-2</div>\r\n	<div class=\"col-4\">col-3</div>	\r\n</div>', '', '', '', '10.15', '3 Column.png', 1),
(4, 'Checkbox', '<div class=\"form-check col-md-6\">\r\n  <input class=\"form-check-input\" type=\"checkbox\" value=\"\" id=\"flexCheckDefault\">\r\n  <label class=\"form-check-label\" for=\"flexCheckDefault\">\r\n    Default checkbox\r\n  </label>\r\n</div>', '', '', '', '10.15', 'Checkbox.png', 1),
(5, 'Countdown', '<div class=\"form-check col-md-6\">\r\n  <input class=\"form-check-input\" type=\"checkbox\" value=\"\" id=\"flexCheckDefault\">\r\n  <label class=\"form-check-label\" for=\"flexCheckDefault\">\r\n    Default checkbox\r\n  </label>\r\n</div>', '', '', '', '10.15', 'Countdown.png', 1),
(6, 'Custom code', '<div class=\"form-check col-md-6\">\r\n  <input class=\"form-check-input\" type=\"checkbox\" value=\"\" id=\"flexCheckDefault\">\r\n  <label class=\"form-check-label\" for=\"flexCheckDefault\">\r\n    Default checkbox\r\n  </label>\r\n</div>', '', '', '', '10.15', 'Custom code.png', 1),
(7, 'Custom Column', '<div class=\"form-check col-md-6\">\r\n  <input class=\"form-check-input\" type=\"checkbox\" value=\"\" id=\"flexCheckDefault\">\r\n  <label class=\"form-check-label\" for=\"flexCheckDefault\">\r\n    Default checkbox\r\n  </label>\r\n</div>', '', '', '', '10.15', 'Custom Column.png', 1),
(8, 'Form', '<div class=\"form-check col-md-6\">\r\n  <input class=\"form-check-input\" type=\"checkbox\" value=\"\" id=\"flexCheckDefault\">\r\n  <label class=\"form-check-label\" for=\"flexCheckDefault\">\r\n    Default checkbox\r\n  </label>\r\n</div>', '', '', '', '10.15', 'Form.png', 1),
(9, 'Image', '<div class=\"form-check col-md-6\">\r\n  <input class=\"form-check-input\" type=\"checkbox\" value=\"\" id=\"flexCheckDefault\">\r\n  <label class=\"form-check-label\" for=\"flexCheckDefault\">\r\n    Default checkbox\r\n  </label>\r\n</div>', '', '', '', '10.15', 'Image.png', 1),
(10, 'Input', '<div class=\"form-check col-md-6\">\r\n  <input class=\"form-check-input\" type=\"checkbox\" value=\"\" id=\"flexCheckDefault\">\r\n  <label class=\"form-check-label\" for=\"flexCheckDefault\">\r\n    Default checkbox\r\n  </label>\r\n</div>', '', '', '', '10.15', 'Input.png', 1),
(11, 'Label', '<div class=\"form-check col-md-6\">\r\n  <input class=\"form-check-input\" type=\"checkbox\" value=\"\" id=\"flexCheckDefault\">\r\n  <label class=\"form-check-label\" for=\"flexCheckDefault\">\r\n    Default checkbox\r\n  </label>\r\n</div>', '', '', '', '10.15', 'Label.png', 1),
(12, 'Link Block', '<div class=\"form-check col-md-6\">\r\n  <input class=\"form-check-input\" type=\"checkbox\" value=\"\" id=\"flexCheckDefault\">\r\n  <label class=\"form-check-label\" for=\"flexCheckDefault\">\r\n    Default checkbox\r\n  </label>\r\n</div>', '', '', '', '10.15', 'Link Block.png', 1),
(13, 'Link', '<div class=\"form-check col-md-6\">\r\n  <input class=\"form-check-input\" type=\"checkbox\" value=\"\" id=\"flexCheckDefault\">\r\n  <label class=\"form-check-label\" for=\"flexCheckDefault\">\r\n    Default checkbox\r\n  </label>\r\n</div>', '', '', '', '10.15', 'Link.png', 1),
(14, 'Map', '<div class=\"form-check col-md-6\">\r\n  <input class=\"form-check-input\" type=\"checkbox\" value=\"\" id=\"flexCheckDefault\">\r\n  <label class=\"form-check-label\" for=\"flexCheckDefault\">\r\n    Default checkbox\r\n  </label>\r\n</div>', '', '', '', '10.15', 'Map.png', 1),
(15, 'Navbar', '<div class=\"form-check col-md-6\">\r\n  <input class=\"form-check-input\" type=\"checkbox\" value=\"\" id=\"flexCheckDefault\">\r\n  <label class=\"form-check-label\" for=\"flexCheckDefault\">\r\n    Default checkbox\r\n  </label>\r\n</div>', '', '', '', '10.15', 'Navbar.png', 1),
(16, 'Quote', '<div class=\"form-check col-md-6\">\r\n  <input class=\"form-check-input\" type=\"checkbox\" value=\"\" id=\"flexCheckDefault\">\r\n  <label class=\"form-check-label\" for=\"flexCheckDefault\">\r\n    Default checkbox\r\n  </label>\r\n</div>', '', '', '', '10.15', 'Quote.png', 1),
(17, 'Record', '<div class=\"form-check col-md-6\">\r\n  <input class=\"form-check-input\" type=\"checkbox\" value=\"\" id=\"flexCheckDefault\">\r\n  <label class=\"form-check-label\" for=\"flexCheckDefault\">\r\n    Default checkbox\r\n  </label>\r\n</div>', '', '', '', '10.15', 'Record.png', 1),
(18, 'Select', '<div class=\"form-check col-md-6\">\r\n  <input class=\"form-check-input\" type=\"checkbox\" value=\"\" id=\"flexCheckDefault\">\r\n  <label class=\"form-check-label\" for=\"flexCheckDefault\">\r\n    Default checkbox\r\n  </label>\r\n</div>', '', '', '', '10.15', 'Select.png', 1),
(19, 'Slider', '<div class=\"form-check col-md-6\">\r\n  <input class=\"form-check-input\" type=\"checkbox\" value=\"\" id=\"flexCheckDefault\">\r\n  <label class=\"form-check-label\" for=\"flexCheckDefault\">\r\n    Default checkbox\r\n  </label>\r\n</div>', '', '', '', '10.15', 'Slider.png', 1),
(20, 'Tabs', '<div class=\"form-check col-md-6\">\r\n  <input class=\"form-check-input\" type=\"checkbox\" value=\"\" id=\"flexCheckDefault\">\r\n  <label class=\"form-check-label\" for=\"flexCheckDefault\">\r\n    Default checkbox\r\n  </label>\r\n</div>', '', '', '', '10.15', 'Tabs.png', 1),
(21, 'Text Box', '<div class=\"form-check col-md-6\">\r\n  <input class=\"form-check-input\" type=\"checkbox\" value=\"\" id=\"flexCheckDefault\">\r\n  <label class=\"form-check-label\" for=\"flexCheckDefault\">\r\n    Default checkbox\r\n  </label>\r\n</div>', '', '', '', '10.15', 'Text Box.png', 1),
(22, 'Text section', '<div class=\"form-check col-md-6\">\r\n  <input class=\"form-check-input\" type=\"checkbox\" value=\"\" id=\"flexCheckDefault\">\r\n  <label class=\"form-check-label\" for=\"flexCheckDefault\">\r\n    Default checkbox\r\n  </label>\r\n</div>', '', '', '', '10.15', 'Text section.png', 1),
(23, 'Text', '<div class=\"form-check col-md-6\">\r\n  <input class=\"form-check-input\" type=\"checkbox\" value=\"\" id=\"flexCheckDefault\">\r\n  <label class=\"form-check-label\" for=\"flexCheckDefault\">\r\n    Default checkbox\r\n  </label>\r\n</div>', '', '', '', '10.15', 'Text.png', 1),
(24, 'Tooltip', '<div class=\"form-check col-md-6\">\r\n  <input class=\"form-check-input\" type=\"checkbox\" value=\"\" id=\"flexCheckDefault\">\r\n  <label class=\"form-check-label\" for=\"flexCheckDefault\">\r\n    Default checkbox\r\n  </label>\r\n</div>', '', '', '', '10.15', 'Tooltip.png', 1),
(25, 'Typed', '<div class=\"form-check col-md-6\">\r\n  <input class=\"form-check-input\" type=\"checkbox\" value=\"\" id=\"flexCheckDefault\">\r\n  <label class=\"form-check-label\" for=\"flexCheckDefault\">\r\n    Default checkbox\r\n  </label>\r\n</div>', '', '', '', '10.15', 'Typed.png', 1),
(26, 'Video', '<div class=\"form-check col-md-6\">\r\n  <input class=\"form-check-input\" type=\"checkbox\" value=\"\" id=\"flexCheckDefault\">\r\n  <label class=\"form-check-label\" for=\"flexCheckDefault\">\r\n    Default checkbox\r\n  </label>\r\n</div>', '', '', '', '10.15', 'Video.png', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `app`
--
ALTER TABLE `app`
  ADD PRIMARY KEY (`a_id`);

--
-- Indexes for table `app_flow`
--
ALTER TABLE `app_flow`
  ADD PRIMARY KEY (`af_id`);

--
-- Indexes for table `app_flow_group`
--
ALTER TABLE `app_flow_group`
  ADD PRIMARY KEY (`afg_id`);

--
-- Indexes for table `app_metadata`
--
ALTER TABLE `app_metadata`
  ADD PRIMARY KEY (`am_id`);

--
-- Indexes for table `app_navigate`
--
ALTER TABLE `app_navigate`
  ADD PRIMARY KEY (`an_id`);

--
-- Indexes for table `app_navigate_page`
--
ALTER TABLE `app_navigate_page`
  ADD PRIMARY KEY (`anp_id`);

--
-- Indexes for table `app_pages`
--
ALTER TABLE `app_pages`
  ADD PRIMARY KEY (`ap_id`);

--
-- Indexes for table `app_page_widget`
--
ALTER TABLE `app_page_widget`
  ADD PRIMARY KEY (`apw_id`);

--
-- Indexes for table `app_user`
--
ALTER TABLE `app_user`
  ADD PRIMARY KEY (`ap_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`);

--
-- Indexes for table `widget`
--
ALTER TABLE `widget`
  ADD PRIMARY KEY (`w_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `app`
--
ALTER TABLE `app`
  MODIFY `a_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_flow`
--
ALTER TABLE `app_flow`
  MODIFY `af_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_flow_group`
--
ALTER TABLE `app_flow_group`
  MODIFY `afg_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_metadata`
--
ALTER TABLE `app_metadata`
  MODIFY `am_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_navigate`
--
ALTER TABLE `app_navigate`
  MODIFY `an_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_navigate_page`
--
ALTER TABLE `app_navigate_page`
  MODIFY `anp_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_pages`
--
ALTER TABLE `app_pages`
  MODIFY `ap_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_page_widget`
--
ALTER TABLE `app_page_widget`
  MODIFY `apw_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_user`
--
ALTER TABLE `app_user`
  MODIFY `ap_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `widget`
--
ALTER TABLE `widget`
  MODIFY `w_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
