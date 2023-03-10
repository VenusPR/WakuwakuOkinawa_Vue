-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- ホスト: db
-- 生成日時: 2023 年 3 月 10 日 08:26
-- サーバのバージョン： 10.5.18-MariaDB-1:10.5.18+maria~ubu2004-log
-- PHP のバージョン: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `wakuoki_db`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `places`
--

CREATE TABLE `places` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `places`
--

INSERT INTO `places` (`id`, `code`, `name`, `created_at`, `updated_at`) VALUES
(1, 472018, '那覇市', NULL, NULL),
(2, 472051, '宜野湾市', NULL, NULL),
(3, 472077, '石垣市', NULL, NULL),
(4, 472085, '浦添市', NULL, NULL),
(5, 472093, '名護市', NULL, NULL),
(6, 472107, '糸満市', NULL, NULL),
(7, 472115, '沖縄市', NULL, NULL),
(8, 472123, '豊見城市', NULL, NULL),
(9, 472131, 'うるま市', NULL, NULL),
(10, 472140, '宮古島市', NULL, NULL),
(11, 472158, '南城市', NULL, NULL),
(12, 473014, '国頭村', NULL, NULL),
(13, 473022, '大宜味村', NULL, NULL),
(14, 473031, '東村', NULL, NULL),
(15, 473065, '今帰仁村', NULL, NULL),
(16, 473081, '本部町', NULL, NULL),
(17, 473111, '恩納村', NULL, NULL),
(18, 473138, '宜野座村', NULL, NULL),
(19, 473146, '金武町', NULL, NULL),
(20, 473154, '伊江村', NULL, NULL),
(21, 473243, '読谷村', NULL, NULL),
(22, 473251, '嘉手納町', NULL, NULL),
(23, 473260, '北谷町', NULL, NULL),
(24, 473278, '北中城村', NULL, NULL),
(25, 473286, '中城村', NULL, NULL),
(26, 473294, '西原町', NULL, NULL),
(27, 473481, '与那原町', NULL, NULL),
(28, 473502, '南風原町', NULL, NULL),
(29, 473537, '渡嘉敷村', NULL, NULL),
(30, 473545, '座間味村', NULL, NULL),
(31, 473553, '粟国村', NULL, NULL),
(32, 473561, '渡名喜村', NULL, NULL),
(33, 473570, '南大東村', NULL, NULL),
(34, 473588, '北大東村', NULL, NULL),
(35, 473596, '伊平屋村', NULL, NULL),
(36, 473600, '伊是名村', NULL, NULL),
(37, 473618, '久米島町', NULL, NULL),
(38, 473626, '八重瀬町', NULL, NULL),
(39, 473758, '多良間村', NULL, NULL),
(40, 473812, '竹富町', NULL, NULL),
(41, 473821, '与那国町', NULL, NULL);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `places`
--
ALTER TABLE `places`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `places`
--
ALTER TABLE `places`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
