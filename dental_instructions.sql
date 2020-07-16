-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2020 年 7 月 16 日 14:15
-- サーバのバージョン： 10.4.11-MariaDB
-- PHP のバージョン: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `dental_instructions`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `instructions_form`
--

CREATE TABLE `instructions_form` (
  `id` int(12) NOT NULL,
  `dentist_id` int(12) NOT NULL,
  `laboratory` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_date` date NOT NULL,
  `name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kana` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sex` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthday` date NOT NULL,
  `material` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `instructions_form`
--

INSERT INTO `instructions_form` (`id`, `dentist_id`, `laboratory`, `product`, `delivery_date`, `name`, `kana`, `sex`, `birthday`, `material`, `created_at`) VALUES
(1, 1, 'A', 'インレー', '2020-07-17', '佐々木', 'ササキ', '1', '2020-07-09', '3', '2020-07-16 13:52:38'),
(2, 1, 'A', 'インレー', '2020-07-09', '田中', 'タナカ', '0', '2020-07-02', '4', '2020-07-16 13:54:23'),
(3, 1, 'B', '全部床義歯', '2020-07-02', '佐藤', 'サトウ', '1', '2020-07-01', '3、5', '2020-07-16 13:54:53'),
(4, 1, 'B', '部分床義歯', '2020-07-09', '榊', 'サカキ', '0', '2020-07-09', '3、4', '2020-07-16 19:25:40'),
(5, 5, 'A', '全部床義歯', '2020-07-09', '田崎', 'タサキ', '1', '2020-07-08', '3、5', '2020-07-16 20:11:16');

-- --------------------------------------------------------

--
-- テーブルの構造 `users_table`
--

CREATE TABLE `users_table` (
  `id` int(12) NOT NULL,
  `name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kana` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sex` int(1) NOT NULL,
  `birthday` date NOT NULL,
  `username` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_dentist` int(1) NOT NULL,
  `is_technician` int(1) NOT NULL,
  `is_admin` int(1) NOT NULL,
  `is_deleted` int(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `users_table`
--

INSERT INTO `users_table` (`id`, `name`, `kana`, `sex`, `birthday`, `username`, `password`, `is_dentist`, `is_technician`, `is_admin`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, '佐藤', 'サトウ', 1, '2020-07-07', 'a@gmail', '123456', 1, 0, 0, 0, '2020-07-07 11:02:39', '2020-07-09 21:46:13'),
(2, '田中', 'タナカ', 0, '2020-07-01', 'b@gmail', '654321', 0, 1, 0, 0, '2020-07-07 11:05:49', '2020-07-11 13:34:59'),
(5, '鈴木', 'スズキ', 0, '2020-07-01', 'c@gmail', '123456', 1, 0, 0, 0, '2020-07-15 15:41:47', '2020-07-15 15:41:47'),
(6, '山下', 'ヤマシタ', 1, '2020-07-04', 'd@gmail', '123456', 1, 0, 0, 0, '2020-07-15 15:42:17', '2020-07-15 15:42:17'),
(7, '竹村', 'タケムラ', 1, '2020-07-03', 'e@gmail', '123456', 0, 1, 0, 0, '2020-07-15 15:42:51', '2020-07-15 15:42:51');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `instructions_form`
--
ALTER TABLE `instructions_form`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `users_table`
--
ALTER TABLE `users_table`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `instructions_form`
--
ALTER TABLE `instructions_form`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- テーブルのAUTO_INCREMENT `users_table`
--
ALTER TABLE `users_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
