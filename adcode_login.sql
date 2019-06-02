-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2019 at 12:22 PM
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
  `username_aplikasi` varchar(20) NOT NULL,
  `fullname_aplikasi` varchar(128) DEFAULT NULL,
  `versi_aplikasi` varchar(5) DEFAULT NULL,
  `icon_aplikasi` varchar(128) DEFAULT NULL,
  `url_database` varchar(255) DEFAULT NULL,
  `hak_cipta` varchar(255) DEFAULT NULL,
  `url_hakcipta` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `config_application`
--

INSERT INTO `config_application` (`username_aplikasi`, `fullname_aplikasi`, `versi_aplikasi`, `icon_aplikasi`, `url_database`, `hak_cipta`, `url_hakcipta`) VALUES
('LPK', 'HELPDESK', '1.0', 'logokominfo.png', 'http://localhost/phpmyadmin/tbl_change.php?db=adcode_login&table=config_application', 'Dinas Komunikasi & Informatika Kabupaten Lima Puluh Kota', 'https://kominfo.limapuluhkotakab.go.id');

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
(5, 'admin', 'Afriadi S.Kom', 'avatar5.png', '$2y$10$5Qs9nJ5HGhl5MlGqWUUAFeeHuWRuwhTTarngwhsLplqXjfQr3rYIu', 1, 1, 1552120289),
(6, 'member', 'doddy@gmail.com', 'profile.jpg', '$2y$10$PhS90dH8xq3NVRdEcYc4Uu1PurFpSI9L65BAuyilYg9858SqdL1Eq', 2, 1, 1552285263),
(11, 'Sandhika Galih', 'sandhikagalih@gmail.com', 'default.jpg', '$2y$10$PhS90dH8xq3NVRdEcYc4Uu1PurFpSI9L65BAuyilYg9858SqdL1Eq', 6, 1, 1553151354);

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
(40, 1, 8),
(41, 1, 10),
(42, 1, 9);

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
(21, 1, 6),
(22, 1, 7),
(23, 1, 14),
(24, 1, 3),
(25, 1, 4),
(26, 1, 5),
(27, 1, 12);

-- --------------------------------------------------------

--
-- Table structure for table `user_master_menu`
--

CREATE TABLE `user_master_menu` (
  `id_master_menu` int(11) NOT NULL,
  `master_menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_master_menu`
--

INSERT INTO `user_master_menu` (`id_master_menu`, `master_menu`) VALUES
(1, 'Dashboard'),
(2, 'User'),
(3, 'Menu');

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id_menu` int(11) NOT NULL,
  `master_menu_id` int(11) NOT NULL,
  `judul_menu` varchar(128) NOT NULL,
  `url_menu` varchar(128) NOT NULL,
  `icon_menu` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id_menu`, `master_menu_id`, `judul_menu`, `url_menu`, `icon_menu`, `is_active`) VALUES
(8, 1, 'Dashboard', 'backend/dashboard', 'fa fa-dashboard', 1),
(9, 2, 'User Management', '', 'fa fa-user', 1),
(10, 3, 'Menu Management', '', 'fa fa-folder', 1);

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
(2, 'Member'),
(6, 'Pengguna');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id_submenu` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `judul_submenu` varchar(128) CHARACTER SET utf8 NOT NULL,
  `url_submenu` varchar(128) CHARACTER SET utf8 NOT NULL,
  `is_active_submenu` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id_submenu`, `menu_id`, `judul_submenu`, `url_submenu`, `is_active_submenu`) VALUES
(3, 9, 'Profile', 'backend/user/view-profile', 1),
(4, 9, 'Change Password', 'backend/user/view-changepassword', 1),
(5, 9, 'Role', 'backend/user/view-role', 1),
(6, 10, 'Master Menu', 'backend/menu/view-mastermenu', 1),
(7, 10, 'Menu', 'backend/menu/view-menu', 1),
(12, 9, 'User', 'backend/user/view-user', 1),
(14, 10, 'Sub Menu', 'backend/menu/view-submenu', 1);

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
-- Indexes for table `config_application`
--
ALTER TABLE `config_application`
  ADD PRIMARY KEY (`username_aplikasi`);

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
-- Indexes for table `user_master_menu`
--
ALTER TABLE `user_master_menu`
  ADD PRIMARY KEY (`id_master_menu`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id_menu`),
  ADD KEY `id_master` (`master_menu_id`);

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
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id_access_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `user_access_submenu`
--
ALTER TABLE `user_access_submenu`
  MODIFY `id_access_submenu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `user_master_menu`
--
ALTER TABLE `user_master_menu`
  MODIFY `id_master_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id_submenu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
  ADD CONSTRAINT `menu_id` FOREIGN KEY (`menu_id`) REFERENCES `user_menu` (`id_menu`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_menu` FOREIGN KEY (`role_id`) REFERENCES `user` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_access_submenu`
--
ALTER TABLE `user_access_submenu`
  ADD CONSTRAINT `role_submenu` FOREIGN KEY (`role_id`) REFERENCES `user` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `submenu_id` FOREIGN KEY (`submenu_id`) REFERENCES `user_sub_menu` (`id_submenu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD CONSTRAINT `id_master` FOREIGN KEY (`master_menu_id`) REFERENCES `user_master_menu` (`id_master_menu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD CONSTRAINT `menu_idsub` FOREIGN KEY (`menu_id`) REFERENCES `user_menu` (`id_menu`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
