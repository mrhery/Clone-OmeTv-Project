-- phpMyAdmin SQL Dump
-- version 4.6.6deb4+deb9u2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 16, 2021 at 06:31 PM
-- Server version: 5.6.51
-- PHP Version: 7.2.34-23+0~20210701.63+debian9~1.gbpd7cd48

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rancall`
--

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `c_id` int(11) NOT NULL,
  `c_content` text NOT NULL,
  `c_from` int(11) NOT NULL,
  `c_to` int(11) NOT NULL,
  `c_time` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`c_id`, `c_content`, `c_from`, `c_to`, `c_time`) VALUES
(1, 'YXNk', 2, 1, 1629164281),
(2, 'YXNkYXNk', 2, 1, 1629164706),
(3, 'aGVyeSByZXBseQ==', 1, 2, 1629166524),
(4, 'c2V3ZXJ3ZXI=', 2, 1, 1629166532),
(5, 'c29tZXRoaW5n', 1, 2, 1629166764),
(6, 'YXFzZGFzZGFzZA==', 2, 1, 1629166809),
(7, 'c29tZXRoaW5n', 1, 2, 1629166938),
(8, 'YXNkYXNk', 1, 2, 1629166941),
(9, 'd2Vyd2Vy', 1, 2, 1629166942),
(10, 'YXNkYXNk', 1, 2, 1629166943),
(11, 'd2Vyd2Vy', 1, 2, 1629166944);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_id` int(11) NOT NULL,
  `u_login` varchar(25) NOT NULL,
  `u_password` varchar(100) NOT NULL,
  `u_gender` int(11) NOT NULL,
  `u_for` int(11) NOT NULL,
  `u_peer` varchar(32) NOT NULL,
  `u_key` varchar(255) NOT NULL,
  `u_email` varchar(100) NOT NULL,
  `u_waiting` int(11) NOT NULL DEFAULT '1',
  `u_with` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `u_login`, `u_password`, `u_gender`, `u_for`, `u_peer`, `u_key`, `u_email`, `u_waiting`, `u_with`) VALUES
(1, 'hery', '43bf1c0b7a496f576b8b198c587fe0a11f87ca40488557651e8da25b187c9d13', 0, 0, 'IbAb2KRvnVTrPad2vbBkPDiK4Qydg630', 'USER_6116acec302d4', 'heryintelt@gmail.com', 0, 0),
(2, 'aiman', '43bf1c0b7a496f576b8b198c587fe0a11f87ca40488557651e8da25b187c9d13', 0, 1, 'SErycHivZ3iVSfsgvAD2Mbny1aLl9806', 'USER_6117d90de1b76', 'aimanmrc@gmail.com', 0, 0),
(3, 'sway', '171ea09f5766c1bf22a7adb53ffbed164f7d7ee7133e5342f1cdf31ea4cd3f6e', 0, 1, 'w0NW6AIVmBs1Ih3mmgkfITxrOObVO410', 'USER_611882096bad5', 'sway37007@gmail.com', 0, 0),
(4, 'Kotori', 'ccb9d541159b085a4fdd620d7001136b602bf3214ddaed88a243db91ecf7c446', 0, 0, 'ngXbpDGh7v3vsg3kn0yOkh4VTAzNJ721', 'USER_61188221b9d8a', 'ashjiahao1205@gmail.com', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
