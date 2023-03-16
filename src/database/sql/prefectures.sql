-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- ホスト: db
-- 生成日時: 2023 年 3 月 15 日 09:06
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
-- テーブルの構造 `prefectures`
--

CREATE TABLE `prefectures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `region_id` int(10) UNSIGNED NOT NULL,
  `code` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `prefectures`
--

INSERT INTO `prefectures` (`id`, `region_id`, `code`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '北海道', NULL, NULL),
(2, 2, 2, '青森県', NULL, NULL),
(3, 2, 3, '岩手県', NULL, NULL),
(4, 2, 4, '宮城県', NULL, NULL),
(5, 2, 5, '秋田県', NULL, NULL),
(6, 2, 6, '山形県', NULL, NULL),
(7, 2, 7, '福島県', NULL, NULL),
(8, 3, 8, '茨城県', NULL, NULL),
(9, 3, 9, '栃木県', NULL, NULL),
(10, 3, 10, '群馬県', NULL, NULL),
(11, 3, 11, '埼玉県', NULL, NULL),
(12, 3, 12, '千葉県', NULL, NULL),
(13, 3, 13, '東京都', NULL, NULL),
(14, 3, 14, '神奈川県', NULL, NULL),
(15, 4, 15, '新潟県', NULL, NULL),
(16, 4, 16, '富山県', NULL, NULL),
(17, 4, 17, '石川県', NULL, NULL),
(18, 4, 18, '福井県', NULL, NULL),
(19, 4, 19, '山梨県', NULL, NULL),
(20, 4, 20, '長野県', NULL, NULL),
(21, 4, 21, '岐阜県', NULL, NULL),
(22, 4, 22, '静岡県', NULL, NULL),
(23, 4, 23, '愛知県', NULL, NULL),
(24, 5, 24, '三重県', NULL, NULL),
(25, 5, 25, '滋賀県', NULL, NULL),
(26, 5, 26, '京都府', NULL, NULL),
(27, 5, 27, '大阪府', NULL, NULL),
(28, 5, 28, '兵庫県', NULL, NULL),
(29, 5, 29, '奈良県', NULL, NULL),
(30, 5, 30, '和歌山県', NULL, NULL),
(31, 6, 31, '鳥取県', NULL, NULL),
(32, 6, 32, '島根県', NULL, NULL),
(33, 6, 33, '岡山県', NULL, NULL),
(34, 6, 34, '広島県', NULL, NULL),
(35, 6, 35, '山口県', NULL, NULL),
(36, 7, 36, '徳島県', NULL, NULL),
(37, 7, 37, '香川県', NULL, NULL),
(38, 7, 38, '愛媛県', NULL, NULL),
(39, 7, 39, '高知県', NULL, NULL),
(40, 8, 40, '福岡県', NULL, NULL),
(41, 8, 41, '佐賀県', NULL, NULL),
(42, 8, 42, '長崎県', NULL, NULL),
(43, 8, 43, '熊本県', NULL, NULL),
(44, 8, 44, '大分県', NULL, NULL),
(45, 8, 45, '宮崎県', NULL, NULL),
(46, 8, 46, '鹿児島県', NULL, NULL),
(47, 8, 47, '沖縄県', NULL, NULL);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `prefectures`
--
ALTER TABLE `prefectures`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `prefectures`
--
ALTER TABLE `prefectures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
