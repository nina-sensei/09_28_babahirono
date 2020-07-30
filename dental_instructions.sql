-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2020 年 7 月 30 日 16:59
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
  `patient_name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `patient_kana` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `patient_sex` int(1) NOT NULL,
  `patient_birthday` date NOT NULL,
  `insurance` int(1) NOT NULL,
  `order_date` date NOT NULL,
  `delivery_date` date NOT NULL,
  `product` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `material` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `design` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `instructions_form`
--

INSERT INTO `instructions_form` (`id`, `dentist_id`, `laboratory`, `patient_name`, `patient_kana`, `patient_sex`, `patient_birthday`, `insurance`, `order_date`, `delivery_date`, `product`, `material`, `image`, `design`, `created_at`) VALUES
(6, 1, 'A', '小池', 'コイケ', 1, '2020-07-07', 0, '0000-00-00', '2020-07-31', 'インレー', '0', '../upload/2020072816382009c7cb03cd92ecadc641f7cb3e136842.png', '', '2020-07-28 23:38:20'),
(7, 1, 'A', '田代', 'タシロ', 0, '2020-07-02', 1, '0000-00-00', '2020-07-31', 'ブリッジ', '1', '../upload/202007301420129c06867d77f0a5e47af5099550f5254f.png', NULL, '2020-07-30 21:20:12'),
(8, 1, 'B', '田島', 'タジマ', 1, '2020-07-16', 1, '2020-07-30', '2020-08-08', 'ブリッジ', '4', '../upload/2020073014353230a30176f79c9fd1e9b58771fb8d4592.png', NULL, '2020-07-30 21:35:32'),
(9, 1, 'ABC', '川口', 'カワグチ', 0, '2020-07-23', 0, '2020-07-30', '2020-07-31', '部分床義歯', '3,4', '../upload/2020073016583518a869c52932ac83ee1ecac87bad15c5.png', NULL, '2020-07-30 23:58:35');

-- --------------------------------------------------------

--
-- テーブルの構造 `laboratory_table`
--

CREATE TABLE `laboratory_table` (
  `id` int(12) NOT NULL,
  `dentist_id` int(12) NOT NULL,
  `lab_name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lab_boss` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lab_address` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lab_mail` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_deleted` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `laboratory_table`
--

INSERT INTO `laboratory_table` (`id`, `dentist_id`, `lab_name`, `lab_boss`, `lab_address`, `lab_mail`, `created_at`, `updated_at`, `is_deleted`) VALUES
(1, 1, 'ABC', 'aaa', 'bbbbbb', 'ccccccc@gmail', '2020-07-30 22:54:31', '2020-07-30 22:54:31', 0),
(2, 1, 'def', 'ssss', 'ddddd', 'ggg@gmail', '2020-07-30 22:56:04', '2020-07-30 22:56:04', 0);

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
-- テーブルのインデックス `laboratory_table`
--
ALTER TABLE `laboratory_table`
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
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- テーブルのAUTO_INCREMENT `laboratory_table`
--
ALTER TABLE `laboratory_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- テーブルのAUTO_INCREMENT `users_table`
--
ALTER TABLE `users_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
