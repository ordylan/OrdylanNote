-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2023-08-08 15:34:36
-- 服务器版本： 5.7.37-log
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `on`
--

-- --------------------------------------------------------

--
-- 表的结构 `onlogs`
--

CREATE TABLE IF NOT EXISTS `onlogs` (
  `tips` text NOT NULL COMMENT '提示',
  `nameurl` text NOT NULL COMMENT '名字路径',
  `logtext` text NOT NULL COMMENT '日志文字',
  `time` text NOT NULL COMMENT '时间',
  `ip` text NOT NULL COMMENT 'ip'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='日志表';

--
-- 转存表中的数据 `onlogs`
--

INSERT INTO `onlogs` (`tips`, `nameurl`, `logtext`, `time`, `ip`) VALUES
('0', '0', 'First', '0', '0.0.0.0');

-- --------------------------------------------------------

--
-- 表的结构 `ordylannote`
--

CREATE TABLE IF NOT EXISTS `ordylannote` (
  `checkin` text NOT NULL COMMENT '签到',
  `boxnum` int(11) NOT NULL COMMENT '宝箱个数',
  `dailyview1` text NOT NULL COMMENT '看笔记任务1',
  `dailyview2` text NOT NULL COMMENT '看笔记任务2',
  `dailyview3` text NOT NULL COMMENT '看笔记任务3',
  `knowledgepoints` int(11) NOT NULL COMMENT '知识点个数',
  `RPON` int(11) NOT NULL COMMENT 'Remnant page of notes笔记残图个数',
  `test` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='笔记系统';

--
-- 转存表中的数据 `ordylannote`
--

INSERT INTO `ordylannote` (`checkin`, `boxnum`, `dailyview1`, `dailyview2`, `dailyview3`, `knowledgepoints`, `RPON`, `test`) VALUES
('', 0, '', '', '', 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `ordylannotecard`
--

CREATE TABLE IF NOT EXISTS `ordylannotecard` (
  `exam/yw` int(11) NOT NULL,
  `exam/sx` int(11) NOT NULL,
  `exam/yy` int(11) NOT NULL,
  `exam/wl` int(11) NOT NULL,
  `exam/hx` int(11) NOT NULL,
  `exam/zz` int(11) NOT NULL,
  `exam/ls` int(11) NOT NULL,
  `exam/sw` int(11) NOT NULL,
  `exam/dl` int(11) NOT NULL,
  `exam/all` int(11) NOT NULL,
  `test` int(11) NOT NULL COMMENT '没有用测试'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='笔记系统卡牌';

--
-- 转存表中的数据 `ordylannotecard`
--

INSERT INTO `ordylannotecard` (`exam/yw`, `exam/sx`, `exam/yy`, `exam/wl`, `exam/hx`, `exam/zz`, `exam/ls`, `exam/sw`, `exam/dl`, `exam/all`, `test`) VALUES
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `ordylannoterank`
--

CREATE TABLE IF NOT EXISTS `ordylannoterank` (
  `username` text NOT NULL COMMENT '用户名',
  `userimg` text NOT NULL COMMENT '图片',
  `kp` int(11) NOT NULL COMMENT '知识点',
  `pron` int(11) NOT NULL COMMENT '残图',
  `userid` int(11) NOT NULL COMMENT '!随机排行按的是这个,0是本人'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='趣味排行榜';

-- --------------------------------------------------------

--
-- 表的结构 `temptasks`
--

CREATE TABLE IF NOT EXISTS `temptasks` (
  `id` int(6) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `complete` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=1001 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `temptasks`
--

INSERT INTO `temptasks` (`id`, `name`, `subject`, `complete`, `created_at`) VALUES
(1000, '学习test', 'Subject', 0, '2023-08-08 07:28:03');

-- --------------------------------------------------------

--
-- 表的结构 `tempvideoviewtotal`
--

CREATE TABLE IF NOT EXISTS `tempvideoviewtotal` (
  `mode` int(11) NOT NULL COMMENT '0学习1中考',
  `subject` int(11) NOT NULL COMMENT '学科(参考tag)',
  `url` text NOT NULL COMMENT '文件路径',
  `info` text NOT NULL COMMENT '描述',
  `isfinish` int(11) NOT NULL COMMENT '是(1)否(0)完成',
  `id` int(11) NOT NULL COMMENT '暂时排序'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `WED`
--

CREATE TABLE IF NOT EXISTS `WED` (
  `id` int(11) NOT NULL COMMENT 'id',
  `s` int(11) NOT NULL COMMENT '学科',
  `u` text NOT NULL COMMENT '题目url',
  `i` text NOT NULL COMMENT '说明',
  `ai` text NOT NULL COMMENT '题目答案图',
  `a` text NOT NULL COMMENT '答案{AAA}分割',
  `d` text NOT NULL COMMENT '错题日期·',
  `r` int(11) NOT NULL COMMENT '是否回答过(不被抽)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='刷错题';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ordylannote`
--
ALTER TABLE `ordylannote`
  ADD PRIMARY KEY (`test`);

--
-- Indexes for table `ordylannotecard`
--
ALTER TABLE `ordylannotecard`
  ADD PRIMARY KEY (`test`);

--
-- Indexes for table `ordylannoterank`
--
ALTER TABLE `ordylannoterank`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `temptasks`
--
ALTER TABLE `temptasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tempvideoviewtotal`
--
ALTER TABLE `tempvideoviewtotal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `WED`
--
ALTER TABLE `WED`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `temptasks`
--
ALTER TABLE `temptasks`
  MODIFY `id` int(6) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1001;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
