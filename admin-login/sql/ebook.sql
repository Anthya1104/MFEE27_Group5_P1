-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2022-07-10 20:47:36
-- 伺服器版本： 10.4.24-MariaDB
-- PHP 版本： 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫: `ebook`
--

-- --------------------------------------------------------

--
-- 資料表結構 `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL COMMENT '流水號',
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '名稱',
  `account` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '帳號',
  `password` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '密碼',
  `email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '信箱',
  `url` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '超連結',
  `introl` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '簡介',
  `tel` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '電話',
  `sign_time` datetime NOT NULL DEFAULT current_timestamp() COMMENT '註冊時間',
  `login_time` datetime NOT NULL COMMENT '登入時間',
  `status` int(11) NOT NULL COMMENT '0:未停權;1:已停權'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='管理員';

--
-- 傾印資料表的資料 `admin`
--

INSERT INTO `admin` (`id`, `title`, `account`, `password`, `email`, `url`, `introl`, `tel`, `sign_time`, `login_time`, `status`) VALUES
(1, '管理員233333333', 'admin', '202cb962ac59075b964b07152d234b70', 'admin@123.com', '', '', '', '2022-07-08 23:24:13', '2022-07-11 02:32:27', 0),
(2, '雄仔', 'user', '202cb962ac59075b964b07152d234b70', 'admin@123.com', '', '', '', '2022-07-08 23:24:13', '2022-07-11 02:32:27', 0);

-- --------------------------------------------------------

--
-- 資料表結構 `factory`
--

CREATE TABLE `factory` (
  `id` int(11) NOT NULL COMMENT '流水號',
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '名稱',
  `account` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '帳號',
  `password` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '密碼',
  `email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '信箱',
  `url` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '超連結',
  `address` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '地址',
  `tel` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '電話',
  `sign_time` datetime NOT NULL DEFAULT current_timestamp() COMMENT '註冊時間',
  `login_time` datetime NOT NULL COMMENT '登入時間',
  `status` int(11) NOT NULL COMMENT '0:未停權;1:已停權'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='廠商資料';

--
-- 傾印資料表的資料 `factory`
--

INSERT INTO `factory` (`id`, `title`, `account`, `password`, `email`, `url`, `address`, `tel`, `sign_time`, `login_time`, `status`) VALUES
(1, '時代雜誌', 'test', '202cb962ac59075b964b07152d234b70', 'jirg@yopmail.com', '', '台中市南區興大路145號', '06-68999999', '2022-06-30 21:30:38', '2022-07-09 14:26:28', 0),
(2, '美洲豹', 'test2', '202cb962ac59075b964b07152d234b70', '`123', '', '報的窩', '091234567', '2022-06-30 21:30:38', '2022-07-09 14:27:27', 0),
(3, '123', '123', '202cb962ac59075b964b07152d234b70', '123', '', '', '', '2022-07-09 14:32:01', '2022-07-09 14:32:08', 0),
(4, '456', '456', '250cf8b51c773f3f8dc8b4be867a9a02', '456', '', '地址456', '電話456', '2022-07-09 14:34:26', '2022-07-09 14:35:02', 0),
(6, '涵涵公司', 'judy', '202cb962ac59075b964b07152d234b70', '', '', '', '', '2022-07-09 14:38:43', '2022-07-09 14:38:51', 0),
(7, '家羽公司', 'user', '202cb962ac59075b964b07152d234b70', 'jjjj123@gmail.com', '', '興光路100號', '09123456', '2022-07-09 14:42:30', '2022-07-09 14:42:46', 0);

-- --------------------------------------------------------

--
-- 資料表結構 `member`
--

CREATE TABLE `member` (
  `id` int(11) NOT NULL COMMENT '流水號',
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '名稱',
  `username` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '暱稱',
  `account` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '帳號',
  `password` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '密碼',
  `email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '信箱',
  `url` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '超連結',
  `introl` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '簡介',
  `tel` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '電話',
  `sign_time` datetime NOT NULL DEFAULT current_timestamp() COMMENT '註冊時間',
  `login_time` datetime NOT NULL COMMENT '登入時間',
  `status` int(11) NOT NULL COMMENT '0:未停權;1:已停權',
  `address` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '地址',
  `birth` date DEFAULT NULL COMMENT '生日',
  `vip` int(11) NOT NULL DEFAULT 1 COMMENT '會員等級'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='會員資料';

--
-- 傾印資料表的資料 `member`
--

INSERT INTO `member` (`id`, `title`, `username`, `account`, `password`, `email`, `url`, `introl`, `tel`, `sign_time`, `login_time`, `status`, `address`, `birth`, `vip`) VALUES
(1, '小安', '安仔', 'test', '202cb962ac59075b964b07152d234b70', 'sss@mail.com', '', '涵涵廠商', '', '2022-06-30 21:30:38', '2022-07-11 02:16:03', 1, '', '2022-07-01', 1),
(4, '小黃', '黃仔', 'test2', '202cb962ac59075b964b07152d234b70', 'jirg@yopmail.com', '', '涵涵廠商', '06-68999999', '2022-06-30 21:30:38', '2022-07-09 01:15:02', 0, '', NULL, 1),
(6, '蕭鉛筆', '蕭鉛筆', '123', '202cb962ac59075b964b07152d234b70', '123', '', '', '', '2022-07-11 01:44:58', '0000-00-00 00:00:00', 0, '', '2022-04-07', 1),
(7, '蕭煌奇', '你是我的眼', '222', '202cb962ac59075b964b07152d234b70', '22222', '', '', '', '2022-07-11 01:45:53', '2022-07-11 01:46:55', 1, '', '2022-07-22', 1),
(8, '蕭敬騰233333', '野比大雄', '456', '250cf8b51c773f3f8dc8b4be867a9a02', 'jirg2@yopmail.com', '', '', '', '2022-07-11 01:48:19', '2022-07-11 01:49:00', 0, '', '2022-07-01', 2);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `factory`
--
ALTER TABLE `factory`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號', AUTO_INCREMENT=3;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `factory`
--
ALTER TABLE `factory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號', AUTO_INCREMENT=8;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號', AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
