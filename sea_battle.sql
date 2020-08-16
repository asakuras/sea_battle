-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1
-- 生成日期： 2020-08-16 14:48:27
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
  `fieldsize` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `battles`
--

INSERT INTO `battles` (`bid`, `user1`, `user2`, `time`, `winner`, `score`, `fieldsize`) VALUES
(1, 1, 2, 123, 1, 0, 0),
(2, 2, 3, 321, 2, 0, 0),
(3, 1, 2, 123213, 2, 0, 0),
(4, 2, 3, 321, 3, 0, 0),
(5, 1, 2, 123, 1, 0, 0),
(6, 1, 2, 2321, 2, 0, 0),
(7, 1, 2, 312, 2, 0, 0),
(8, 2, 1, 123, 2, 0, 0),
(9, 2, 4, 321, 4, 0, 0),
(10, 1, 3, 321, 3, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `chessboards`
--

CREATE TABLE `chessboards` (
  `cbid` int(20) NOT NULL,
  `userid` int(20) NOT NULL,
  `boardstring` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `games`
--

CREATE TABLE `games` (
  `gid` int(20) NOT NULL,
  `user1` int(20) NOT NULL,
  `user2` int(20) DEFAULT NULL,
  `ismatch` int(1) NOT NULL,
  `firstmove` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `steps`
--

CREATE TABLE `steps` (
  `sid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `x` int(11) NOT NULL,
  `y` int(11) NOT NULL,
  `islast` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(4, '123', '$2y$10$z3GYZP.zXhVMMUsS1knUK.56PP46L8cO.6gfTG55vVRVAmTCqBVNq', 'user');

--
-- 转储表的索引
--

--
-- 表的索引 `battles`
--
ALTER TABLE `battles`
  ADD PRIMARY KEY (`bid`);

--
-- 表的索引 `chessboards`
--
ALTER TABLE `chessboards`
  ADD PRIMARY KEY (`cbid`);

--
-- 表的索引 `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`gid`);

--
-- 表的索引 `steps`
--
ALTER TABLE `steps`
  ADD PRIMARY KEY (`sid`);

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
-- 使用表AUTO_INCREMENT `chessboards`
--
ALTER TABLE `chessboards`
  MODIFY `cbid` int(20) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `games`
--
ALTER TABLE `games`
  MODIFY `gid` int(20) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `steps`
--
ALTER TABLE `steps`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
