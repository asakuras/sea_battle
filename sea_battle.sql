-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1
-- 生成日期： 2020-08-13 19:41:33
-- 服务器版本： 10.4.13-MariaDB
-- PHP 版本： 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `sea_battle`
--

-- --------------------------------------------------------

--
-- 表的结构 `battles`
--

CREATE TABLE `battles` (
  `bid` int(128) NOT NULL,
  `user1` int(128) NOT NULL,
  `user2` int(128) NOT NULL,
  `time` int(128) NOT NULL,
  `winner` int(128) NOT NULL,
  `score` int(100) NOT NULL,
  `field_size` int(10) NOT NULL DEFAULT 10
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `battles`
--

INSERT INTO `battles` (`bid`, `user1`, `user2`, `time`, `winner`, `score`, `field_size`) VALUES
(1, 1, 2, 123, 1, 33, 10),
(2, 2, 3, 321, 2, 20, 7),
(3, 1, 2, 123213, 2, 40, 10),
(4, 2, 3, 321, 3, 10, 7),
(5, 1, 2, 123, 1, 5, 7),
(6, 1, 2, 2321, 2, 34, 10),
(7, 1, 2, 312, 2, 28, 10),
(8, 2, 1, 123, 2, 13, 7),
(9, 2, 4, 321, 4, 55, 10),
(10, 1, 3, 321, 3, 63, 10);

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('tourist','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `users`
--

INSERT INTO `users` (`userid`, `username`, `password`, `role`) VALUES
(1, 'abc', '$2y$10$U/gFEpV9lEEzSra516ocIeS5ZdP/3tk1BXsbmuH6NivomzGhVIWyK', 'user'),
(2, 'aaaaa', '$2y$10$Zg.93UrhQU3LDVyPMQuAb.QTpK3nmQStrwF37dHCeKKMX4eXeEmZC', 'user'),
(3, '111', '$2y$10$ZmNUnsVxAXJ5Ok5m3NYoLeYGpe.nQUHXH/sBr0AdUCfyGlGIU3Aka', 'user'),
(4, '123', '$2y$10$z3GYZP.zXhVMMUsS1knUK.56PP46L8cO.6gfTG55vVRVAmTCqBVNq', 'user'),
(5, 'tourist10935', NULL, 'tourist'),
(6, 'tourist17436', NULL, 'tourist'),
(7, 'tourist25120', NULL, 'tourist'),
(8, 'tourist19518', NULL, 'tourist'),
(9, 'tourist28353', NULL, 'tourist'),
(10, 'tourist18512', NULL, 'tourist'),
(14, 'tourist18685', NULL, 'tourist'),
(15, 'tourist20420', NULL, 'tourist'),
(16, 'tourist17912', NULL, 'tourist'),
(18, 'tourist26816', NULL, 'tourist');

--
-- 转储表的索引
--

--
-- 表的索引 `battles`
--
ALTER TABLE `battles`
  ADD PRIMARY KEY (`bid`);

--
-- 表的索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `battles`
--
ALTER TABLE `battles`
  MODIFY `bid` int(128) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- 使用表AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
