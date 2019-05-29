-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2019 at 06:59 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `adcode_login`
--

-- --------------------------------------------------------

--
-- Table structure for table `config_application`
--

CREATE TABLE `config_application` (
  `fullname_aplikasi` varchar(128) DEFAULT NULL,
  `username_aplikasi` varchar(20) DEFAULT NULL,
  `icon_aplikasi` varchar(128) DEFAULT NULL,
  `url_database` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `config_application`
--

INSERT INTO `config_application` (`fullname_aplikasi`, `username_aplikasi`, `icon_aplikasi`, `url_database`) VALUES
('HELPDESK', 'LPK', 'logokominfo.png', 'http://localhost/phpmyadmin/tbl_change.php?db=adcode_login&table=config_application');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `fullname` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `fullname`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(5, 'admin', 'Afriadi S.Kom', 'avatar5.png', '$2y$10$VF.hcVkcJClVZ99rOeU/vOk5fYAVPs5pBTICG3nBkMfPnGDZVrhR.', 1, 1, 1552120289),
(6, 'member', 'doddy@gmail.com', 'profile.jpg', 'aa08769cdcb26674c6706093503ff0a3', 2, 1, 1552285263),
(11, 'Sandhika Galih', 'sandhikagalih@gmail.com', 'default.jpg', '$2y$10$0QYEK1pB2L.Rdo.ZQsJO5eeTSpdzT7PvHaEwsuEyGSs0J1Qf5BoSq', 2, 1, 1553151354);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id_access_menu` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id_access_menu`, `role_id`, `menu_id`) VALUES
(9, 1, 1),
(10, 1, 4),
(11, 1, 7),
(12, 1, 2),
(13, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_submenu`
--

CREATE TABLE `user_access_submenu` (
  `id_access_submenu` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `submenu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_access_submenu`
--

INSERT INTO `user_access_submenu` (`id_access_submenu`, `role_id`, `submenu_id`) VALUES
(1, 1, 1),
(3, 1, 2),
(4, 1, 3),
(6, 2, 3),
(7, 2, 4),
(8, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id_menu` int(11) NOT NULL,
  `judul_menu` varchar(128) NOT NULL,
  `url_menu` varchar(128) NOT NULL,
  `icon_menu` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id_menu`, `judul_menu`, `url_menu`, `icon_menu`, `is_active`) VALUES
(1, 'Dashboard', 'backend/dashboard', 'fa fa-dashboard', 1),
(2, 'My Profile', '', 'fa fa-user', 1),
(4, 'Menu Management', '', 'fa fa-folder', 1),
(7, 'Role', 'backend/role', 'fa fa-credit-card', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id_role` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id_role`, `role`) VALUES
(1, 'Administrator'),
(2, 'Member');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id_submenu` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `judul_submenu` varchar(128) CHARACTER SET utf8 NOT NULL,
  `url_submenu` varchar(128) CHARACTER SET utf8 NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id_submenu`, `menu_id`, `judul_submenu`, `url_submenu`, `is_active`) VALUES
(1, 4, 'Menu', 'hshdasjdh', 1),
(2, 4, 'Sub Menu', 'asdsad', 1),
(3, 2, 'Profile', 'user/profile', 1),
(4, 2, 'Change Password', 'user/changepassword', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE `user_token` (
  `id_token` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(128) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id_access_menu`),
  ADD KEY `menu_id` (`menu_id`),
  ADD KEY `role_menu` (`role_id`);

--
-- Indexes for table `user_access_submenu`
--
ALTER TABLE `user_access_submenu`
  ADD PRIMARY KEY (`id_access_submenu`),
  ADD KEY `role_submenu` (`role_id`),
  ADD KEY `submenu_id` (`submenu_id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id_submenu`),
  ADD KEY `menu_idsub` (`menu_id`);

--
-- Indexes for table `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id_access_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_access_submenu`
--
ALTER TABLE `user_access_submenu`
  MODIFY `id_access_submenu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id_submenu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id_token` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `role_id` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`id_role`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD CONSTRAINT `menu_id` FOREIGN KEY (`menu_id`) REFERENCES `user_menu` (`id_menu`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `role_menu` FOREIGN KEY (`role_id`) REFERENCES `user` (`role_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_access_submenu`
--
ALTER TABLE `user_access_submenu`
  ADD CONSTRAINT `role_submenu` FOREIGN KEY (`role_id`) REFERENCES `user` (`role_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `submenu_id` FOREIGN KEY (`submenu_id`) REFERENCES `user_sub_menu` (`id_submenu`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD CONSTRAINT `menu_idsub` FOREIGN KEY (`menu_id`) REFERENCES `user_menu` (`id_menu`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
