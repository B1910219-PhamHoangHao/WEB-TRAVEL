-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2022 at 07:18 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `travel`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `ad_id` int(11) NOT NULL,
  `ad_name` varchar(20) NOT NULL,
  `ad_email` varchar(20) NOT NULL,
  `ad_phone` varchar(11) NOT NULL,
  `ad_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`ad_id`, `ad_name`, `ad_email`, `ad_phone`, `ad_password`) VALUES
(1, 'admin', 'admin@gmail.com', '0327013791', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `tb_cart`
--

CREATE TABLE `tb_cart` (
  `c_id` int(11) NOT NULL,
  `c_productID` int(11) NOT NULL,
  `c_productName` varchar(255) NOT NULL,
  `c_productIMG` varchar(255) NOT NULL,
  `c_productPrice` varchar(255) NOT NULL,
  `c_productQuantity` int(11) NOT NULL,
  `c_sid` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_cart`
--

INSERT INTO `tb_cart` (`c_id`, `c_productID`, `c_productName`, `c_productIMG`, `c_productPrice`, `c_productQuantity`, `c_sid`) VALUES
(190, 24, 'Áo Mixi city', 'dbd781a279.jpg', '200000', 1, 'aqqnk3cplp8jmtmjl765shnhhe');

-- --------------------------------------------------------

--
-- Table structure for table `tb_comment`
--

CREATE TABLE `tb_comment` (
  `cmt_id` int(11) NOT NULL,
  `cmt_name` varchar(255) NOT NULL,
  `cmt_email` varchar(255) NOT NULL,
  `cmt_phone` varchar(255) NOT NULL,
  `cmt_comment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_comment`
--

INSERT INTO `tb_comment` (`cmt_id`, `cmt_name`, `cmt_email`, `cmt_phone`, `cmt_comment`) VALUES
(1, 'Phạm Hoàng Hảo', 'hao@gmail.com', '0949980877', ' Shop 10đ');

-- --------------------------------------------------------

--
-- Table structure for table `tb_customer`
--

CREATE TABLE `tb_customer` (
  `c_id` int(11) NOT NULL,
  `c_name` varchar(25) NOT NULL,
  `c_email` varchar(25) NOT NULL,
  `c_phone` varchar(11) NOT NULL,
  `c_address` varchar(255) NOT NULL,
  `c_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_customer`
--

INSERT INTO `tb_customer` (`c_id`, `c_name`, `c_email`, `c_phone`, `c_address`, `c_password`) VALUES
(1, 'haodb', 'hao@gmail.com', '0327013791', 'ĐH Cần Thơ', '25d55ad283aa400af464c76d713c07ad'),
(7, 'Hao', 'Hao111@gmail.com', '0987654321', 'Kien Giang', '202cb962ac59075b964b07152d234b70'),
(8, 'HaoHaoChuaCay', 'Hao111@gmail.com', '0987654321', 'ĐH Cần Thơ, 3/2 Ninh Kieu', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `tb_order`
--

CREATE TABLE `tb_order` (
  `o_id` int(11) NOT NULL,
  `o_productID` int(11) NOT NULL,
  `o_productName` varchar(255) NOT NULL,
  `o_customerID` int(11) NOT NULL,
  `o_customerName` varchar(255) NOT NULL,
  `o_date` date NOT NULL,
  `o_quantity` varchar(255) NOT NULL,
  `o_price` varchar(255) NOT NULL,
  `o_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_products`
--

CREATE TABLE `tb_products` (
  `p_id` int(11) NOT NULL,
  `p_name` varchar(255) NOT NULL,
  `p_code` varchar(255) NOT NULL,
  `p_img` varchar(255) NOT NULL,
  `p_price` varchar(255) NOT NULL,
  `p_desc` varchar(255) NOT NULL,
  `p_quantity` varchar(255) NOT NULL,
  `p_date` date NOT NULL,
  `p_soldout` int(11) NOT NULL,
  `p_remain` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_products`
--

INSERT INTO `tb_products` (`p_id`, `p_name`, `p_code`, `p_img`, `p_price`, `p_desc`, `p_quantity`, `p_date`, `p_soldout`, `p_remain`) VALUES
(1, 'Du lịch Quy Nhơn', 'TV01', '38f9edb5c0.jpg', '1000000', '<ul>\r\n<li class=\"_372d0\">Tắm biển tại thi&ecirc;n đường biển -&nbsp;<em>Biển Đảo Kỳ Co&nbsp;</em></li>\r\n<li>Viếng thăm&nbsp;<span><em>Tịnh X&aacute; Ngọc H&ograve;a -&nbsp;</em></span>nổi tiếng với tượng phật đ&ocirc;i Thế Quan &Acirc;m cao nhất Việt Nam.', '50', '2022-11-24', 0, 50),
(2, 'Du lịch Phú Quốc', 'TV02', '162e3ba388.jpg', '3200000', '<p><span><span><span style=\"text-decoration: underline;\">Dịch vụ sang chảnh, gi&aacute; đẹp đ&atilde; bao gồm:</span></span></span></p>\r\n<ul>\r\n<li><span><span>V&eacute; m&aacute;y bay khứ hồi HCM - Ph&uacute; Quốc - HCM</span></span></li>\r\n<li><span><span', '50', '2022-11-26', 0, 50),
(3, 'Du lịch Đà Nẵng', 'TV03', 'a20500d0bb.jpg', '4500000', '<ul>\r\n<li>Lạc bước giữa&nbsp;<span><em>phố cổ Hội An</em></span>&nbsp;lung linh về đ&ecirc;m.</li>\r\n<li>Kh&aacute;m ph&aacute;&nbsp;<span><em>Th&aacute;nh Địa La Vang</em></span>&nbsp;&ndash; ho&agrave;ng cung trong l&ograve;ng đất</li>\r\n<li>Thăm&nbsp;<sp', '20', '2022-11-28', 0, 20);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`ad_id`);

--
-- Indexes for table `tb_cart`
--
ALTER TABLE `tb_cart`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `tb_comment`
--
ALTER TABLE `tb_comment`
  ADD PRIMARY KEY (`cmt_id`);

--
-- Indexes for table `tb_customer`
--
ALTER TABLE `tb_customer`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `tb_order`
--
ALTER TABLE `tb_order`
  ADD PRIMARY KEY (`o_id`);

--
-- Indexes for table `tb_products`
--
ALTER TABLE `tb_products`
  ADD PRIMARY KEY (`p_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `ad_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_cart`
--
ALTER TABLE `tb_cart`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=197;

--
-- AUTO_INCREMENT for table `tb_comment`
--
ALTER TABLE `tb_comment`
  MODIFY `cmt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_customer`
--
ALTER TABLE `tb_customer`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_order`
--
ALTER TABLE `tb_order`
  MODIFY `o_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `tb_products`
--
ALTER TABLE `tb_products`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
