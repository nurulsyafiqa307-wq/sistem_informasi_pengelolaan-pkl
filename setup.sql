-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 18, 2026 at 04:34 AM
-- Server version: 8.0.30
-- PHP Version: 8.5.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jurnal_pkl`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-admin1@gmail.com|127.0.0.1', 'i:1;', 1789025530),
('laravel-cache-admin1@gmail.com|127.0.0.1:timer', 'i:1789025530;', 1789025530),
('laravel-cache-guru@gmai.com|127.0.0.1', 'i:1;', 1788494151),
('laravel-cache-guru@gmai.com|127.0.0.1:timer', 'i:1788494150;', 1788494150),
('laravel-cache-guru1@gmai.com|127.0.0.1', 'i:1;', 1788494137),
('laravel-cache-guru1@gmai.com|127.0.0.1:timer', 'i:1788494137;', 1788494137),
('laravel-cache-guru1@gmail.com|127.0.0.1', 'i:1;', 1788494168),
('laravel-cache-guru1@gmail.com|127.0.0.1:timer', 'i:1788494168;', 1788494168),
('laravel-cache-nurulsyafiqaramdan@gmail.com|127.0.0.1', 'i:3;', 1788360306),
('laravel-cache-nurulsyafiqaramdan@gmail.com|127.0.0.1:timer', 'i:1788360306;', 1788360306),
('laravel-cache-siswa@gmail.com|127.0.0.1', 'i:1;', 1788488515),
('laravel-cache-siswa@gmail.com|127.0.0.1:timer', 'i:1788488515;', 1788488515),
('laravel-cache-siswa2@gamil.com|127.0.0.1', 'i:1;', 1788309077),
('laravel-cache-siswa2@gamil.com|127.0.0.1:timer', 'i:1788309077;', 1788309077),
('laravel-cache-siswa2@gmaill.com|127.0.0.1', 'i:1;', 1788260348),
('laravel-cache-siswa2@gmaill.com|127.0.0.1:timer', 'i:1788260348;', 1788260348),
('laravel-cache-taniaa@gmail.com|127.0.0.1', 'i:1;', 1789086770),
('laravel-cache-taniaa@gmail.com|127.0.0.1:timer', 'i:1789086770;', 1789086770);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gurus`
--

CREATE TABLE `gurus` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gurus`
--

INSERT INTO `gurus` (`id`, `user_id`, `nip`, `nama`, `no_hp`, `created_at`, `updated_at`) VALUES
(7, 20, '23456', 'buk ranti', '3456789', '2026-09-03 21:03:08', '2026-09-07 20:49:53'),
(10, 33, '198703202011012002', 'Siti Rahma, S.Pd.', '0812-3456-7802', '2026-09-03 22:48:37', '2026-09-03 22:48:37'),
(11, 34, '198609102012031003', 'Budi Santoso, S.Pd., M.Pd.', '0812-3456-7803', '2026-09-03 22:49:21', '2026-09-03 22:49:21'),
(12, 35, '198802252013042004', 'Dewi Lestari, S.Pd.', '0812-3456-7804', '2026-09-03 22:50:16', '2026-09-03 22:50:16'),
(13, 36, '198410182009021005', 'Rudi Hartono, S.Pd.', '0812-3456-7805', '2026-09-03 22:54:29', '2026-09-03 22:54:29'),
(14, 37, '198905122014052006', 'Nur Aisyah, S.Pd.I.', '0812-3456-7806', '2026-09-03 22:55:52', '2026-09-03 22:55:52'),
(15, 38, '198707302011011007', 'Andi Saputra, S.Pd.', '0812-3456-7807', '2026-09-03 22:57:18', '2026-09-03 22:57:18'),
(16, 39, '198611082012032008', 'Lina Marlina, S.Pd.', '0812-3456-7815', '2026-09-03 22:58:20', '2026-09-03 22:58:20'),
(17, 40, '198903152015061009', 'Eko Prasetyo, S.Pd.', '0812-3456-7809', '2026-09-03 22:59:29', '2026-09-03 22:59:29'),
(18, 41, '198805202013042010', 'Rina Wulandari, S.Pd.', '0812-3456-7810', '2026-09-03 23:00:20', '2026-09-03 23:00:20'),
(19, 42, '198602112010011011', 'Dedi Kurniawan, S.Pd.', '081234567811', '2026-09-03 23:01:11', '2026-09-07 07:55:27'),
(21, 49, '874923667', 'Aaaa', '0878234673784', '2026-09-10 17:36:22', '2026-09-10 17:36:22'),
(22, 51, '07349325578', 'buk ranti', '083848117356', '2026-09-16 00:08:29', '2026-09-16 00:08:29');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jurnal_pkls`
--

CREATE TABLE `jurnal_pkls` (
  `id_jurnal` bigint UNSIGNED NOT NULL,
  `siswa_id` bigint UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `jam_masuk` time NOT NULL,
  `jam_pulang` time NOT NULL,
  `kegiatan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `kon` text COLLATE utf8mb4_unicode_ci,
  `solusi` text COLLATE utf8mb4_unicode_ci,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_jurnal` enum('Menunggu Review','Disetujui','Perlu Revisi') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Menunggu Review',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jurnal_pkls`
--

INSERT INTO `jurnal_pkls` (`id_jurnal`, `siswa_id`, `tanggal`, `jam_masuk`, `jam_pulang`, `kegiatan`, `kon`, `solusi`, `foto`, `status_jurnal`, `created_at`, `updated_at`) VALUES
(13, 9, '2026-09-04', '09:00:00', '05:00:00', 'Beli Gorengan', 'Minyak Habis', 'Beli Minyak', 'jurnal/BgTaGsIR2XndmewLjCvEL2isgbDvGWJacxpKL3l0.jpg', 'Menunggu Review', '2026-09-04 00:33:20', '2026-09-04 00:33:20'),
(14, 9, '2026-09-05', '09:00:00', '05:00:00', 'Bikin Kopi', 'Kopi Habis', 'Beli Kopi', 'jurnal/qHc2Z5LUqZN4SwBNCwVPfT8kRI3hD62JgyJzf5HK.png', 'Menunggu Review', '2026-09-04 00:34:08', '2026-09-04 00:34:08'),
(16, 9, '2026-10-01', '10:42:00', '13:41:00', 'cfvgbhjn', 'fcvgbhnj', 'ertvgbhjn', 'jurnal/kFJ1TYy35ccCPxY0gc4VcDG5Y92nfGCxAdp1lsWU.jpg', 'Disetujui', '2026-09-04 20:41:42', '2026-09-07 09:31:10'),
(18, 9, '2026-09-08', '14:23:00', '13:23:00', 'sedrtgyjikl', 'ertfgyhuj', '3s4rftgyhuji', NULL, 'Perlu Revisi', '2026-09-07 21:23:38', '2026-09-07 21:24:02'),
(19, 25, '2026-09-11', '08:37:00', '17:37:00', 'jdwkdf', 'djkqwjkd', 'jkfdjkwe', 'jurnal/pVoW9Cf7OU39UG71s5XGSyifZDjnTe0yI3pkopBX.jpg', 'Disetujui', '2026-09-10 17:38:14', '2026-09-10 17:39:21'),
(20, 9, '2026-09-16', '07:15:00', '15:30:00', 'mengimput data', 'jaringan', 'pakekk data pribadi', 'jurnal/E5yTkwgp5MgM8XTRwtai339YxMzbeCaLf9wEjeA0.jpg', 'Disetujui', '2026-09-16 00:14:08', '2026-09-16 00:19:57');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_08_06_020621_create_siswas_table', 1),
(5, '2026_08_06_020631_create_gurus_table', 1),
(6, '2026_08_06_020654_create_penilaians_table', 1),
(7, '2026_08_06_041553_add_role_to_users_table', 1),
(8, '2026_08_19_034343_create_tempat_pkls_table', 1),
(9, '2026_08_20_000000_create_pengajuan_pkls_table', 1),
(10, '2026_08_20_074500_fix_penilaians_columns_table', 1),
(11, '2026_08_21_000000_create_jurnal_pkls_table', 1),
(12, '2026_08_21_025900_add_role_to_users_table', 2),
(13, '2026_08_21_033245_add_google_columns_to_users_table', 2),
(14, '2026_08_27_024236_add_tempat_pkl_id_to_pengajuan_pkls_table', 3),
(15, '2026_08_27_025411_remove_old_columns_from_pengajuan_pkls_table', 4),
(16, '2026_08_28_054420_add_guru_pembimbing_id_to_siswas_table', 4),
(17, '2026_08_28_055857_add_status_and_tempat_pkl_to_siswas_table', 5),
(18, '2026_08_29_052622_create_roles_table', 6),
(19, '2026_08_29_052642_add_role_id_to_users_table', 6),
(20, '2026_08_29_052708_migrate_existing_roles_to_role_id', 6);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_pkls`
--

CREATE TABLE `pengajuan_pkls` (
  `id` bigint UNSIGNED NOT NULL,
  `siswa_id` bigint UNSIGNED NOT NULL,
  `tempat_pkl_id` bigint UNSIGNED NOT NULL,
  `tanggal_pengajuan` date NOT NULL,
  `status` enum('Menunggu Seleksi','Lolos','Tidak Lolos') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Menunggu Seleksi',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengajuan_pkls`
--

INSERT INTO `pengajuan_pkls` (`id`, `siswa_id`, `tempat_pkl_id`, `tanggal_pengajuan`, `status`, `created_at`, `updated_at`) VALUES
(22, 19, 13, '2026-09-10', 'Lolos', '2026-09-10 00:57:06', '2026-09-10 00:57:22'),
(23, 25, 11, '2026-09-11', 'Lolos', '2026-09-10 17:36:52', '2026-09-10 17:37:39'),
(24, 9, 11, '2026-09-16', 'Menunggu Seleksi', '2026-09-16 00:10:46', '2026-09-16 18:08:14');

-- --------------------------------------------------------

--
-- Table structure for table `penilaians`
--

CREATE TABLE `penilaians` (
  `id` bigint UNSIGNED NOT NULL,
  `siswa_id` bigint UNSIGNED NOT NULL,
  `disiplin` int NOT NULL,
  `komunikasi` int NOT NULL,
  `kerja_sama` int NOT NULL DEFAULT '0',
  `tanggung_jawab` int NOT NULL,
  `kerjasama` int NOT NULL,
  `keterampilan` int NOT NULL,
  `rata_rata` decimal(5,2) DEFAULT NULL,
  `catatan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penilaians`
--

INSERT INTO `penilaians` (`id`, `siswa_id`, `disiplin`, `komunikasi`, `kerja_sama`, `tanggung_jawab`, `kerjasama`, `keterampilan`, `rata_rata`, `catatan`, `created_at`, `updated_at`) VALUES
(12, 25, 69, 82, 0, 50, 60, 64, 65.00, 'perbaiki sikap', '2026-09-10 17:39:40', '2026-09-10 17:39:40'),
(14, 9, 90, 86, 0, 88, 89, 98, 90.20, 'tolong perbaiki sikap', '2026-09-16 00:21:29', '2026-09-16 00:21:29');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2026-08-28 22:27:24', '2026-08-28 22:27:24'),
(2, 'guru', '2026-08-28 22:27:24', '2026-08-28 22:27:24'),
(3, 'siswa', '2026-08-28 22:27:24', '2026-08-28 22:27:24');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('Foy8bZNucFJYEqm0lbKN9ZUdw07rAfiF5LfNhDjT', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.138.0 Chrome/148.0.7778.280 Electron/42.10.0 Safari/537.36', 'eyJfdG9rZW4iOiI0bXB2OHlIRlZhQmMzUHY5ZjR2enZrdjRTRHVDWnhDOXM2YkZJUmJjIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9sb2dpbiIsInJvdXRlIjoibG9naW4ifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', 1789698948),
('kvRdOmKKCxhvC9MsCkzfKRZ9jngxVUVA3g5LvzB6', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.138.0 Chrome/148.0.7778.280 Electron/42.10.0 Safari/537.36', 'eyJfdG9rZW4iOiJGeFlaVmxHWUN0MDlTZE9UZlZacEN4UGZ5NzVmZ1E1VGU5UlMydDd6IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9sb2dpbiIsInJvdXRlIjoibG9naW4ifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', 1789696885),
('RZZ9pKDXeO0KogtdhyBR3BEObfmKONAdN6DVKk2W', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0', 'eyJfdG9rZW4iOiJvSEZ6NmVsbkxoY3h2WE9zNU50TjFSRXRYR2JJTXg5cjdVbjFScG9ZIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL2FkbWluXC9kYXNoYm9hcmQiLCJyb3V0ZSI6ImFkbWluLmRhc2hib2FyZCJ9LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MX0=', 1789700009);

-- --------------------------------------------------------

--
-- Table structure for table `siswas`
--

CREATE TABLE `siswas` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `guru_pembimbing_id` bigint UNSIGNED DEFAULT NULL,
  `status_pkl` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempat_pkl` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jurusan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `siswas`
--

INSERT INTO `siswas` (`id`, `user_id`, `guru_pembimbing_id`, `status_pkl`, `tempat_pkl`, `nis`, `nama`, `kelas`, `jurusan`, `no_hp`, `created_at`, `updated_at`) VALUES
(9, 18, NULL, 'Selesai PKL', 'CV Digital Kreatif Nusantara', '123456', 'Nurul Syafiqa Ramadhan', 'XII PPLG 2', 'PPLG', '4567890', '2026-09-03 21:01:11', '2026-09-16 18:08:14'),
(11, 22, NULL, NULL, NULL, '2026001', 'Ahmad Rizky Pratama', 'XII RPL 2', 'RPL', '0812-0001-0001', '2026-09-03 22:28:04', '2026-09-03 22:28:04'),
(12, 23, NULL, NULL, NULL, '2026002', 'Siti Nurhaliza', 'XII TKJ 1', 'TKJ', '0812-0002-0002', '2026-09-03 22:31:34', '2026-09-03 22:31:34'),
(13, 24, NULL, NULL, NULL, '2026003', 'Muhammad Fajar Ramadhan', 'XII DKV 1', 'DKV', '0812-0003-0003', '2026-09-03 22:32:45', '2026-09-03 22:32:45'),
(15, 26, NULL, NULL, NULL, '2026005', 'Rizky Aditya Saputra', 'XII BC', 'BC', '0812-0005-0005', '2026-09-03 22:35:17', '2026-09-03 22:35:17'),
(16, 27, NULL, NULL, NULL, '2026006', 'Nurul Aisyah', 'XII TJKT 2', 'TJKT', '0812-0006-0006', '2026-09-03 22:36:51', '2026-09-03 22:36:51'),
(17, 28, NULL, NULL, NULL, '2026007', 'Dimas Arya Nugraha', 'XII DKV 1', 'BC', '0812-0007-0007', '2026-09-03 22:37:58', '2026-09-03 22:37:58'),
(18, 29, NULL, NULL, NULL, '2026008', 'Intan Permata Sari', 'XII TKJ 2', 'TJKT', '0812-0008-0008', '2026-09-03 22:38:55', '2026-09-03 22:38:55'),
(19, 30, 18, 'Lolos', 'CV Solusi Teknologi Mandiri', '2026009', 'Bagas Maulana Putra', 'XII DKV 2', 'DKV', '111234567890', '2026-09-03 22:39:45', '2026-09-10 00:57:22'),
(21, 43, 7, 'Sedang PKL', 'PT Telkom Indonesia', '1234564567', 'tania putri', 'XII BC', 'BC', '2345678904567', '2026-09-05 05:17:15', '2026-09-10 17:40:54'),
(22, 44, NULL, NULL, NULL, '23456789', 'zahra', 'XII RPL 2', 'RPL', '08734723482570', '2026-09-07 07:14:07', '2026-09-07 07:14:07'),
(25, 48, 21, 'Selesai PKL', 'CV Digital Kreatif Nusantara', '73824', 'a', 'XII.PPLG 2', 'PPLG', '08754683478198', '2026-09-10 17:35:24', '2026-09-10 17:39:40'),
(26, 50, NULL, NULL, NULL, '5379', 'Nurul Syafiqa', 'XII PPLG 2', 'PPLG', '083848117366', '2026-09-16 00:05:52', '2026-09-16 00:05:52');

-- --------------------------------------------------------

--
-- Table structure for table `tempat_pkls`
--

CREATE TABLE `tempat_pkls` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_perusahaan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bidang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kuota` int NOT NULL DEFAULT '0',
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tempat_pkls`
--

INSERT INTO `tempat_pkls` (`id`, `nama_perusahaan`, `bidang`, `alamat`, `no_hp`, `kuota`, `keterangan`, `created_at`, `updated_at`) VALUES
(3, 'pt abadi', 'it', 'jakarta', '2345678', 1, NULL, '2026-09-01 18:54:42', '2026-09-01 18:54:42'),
(4, 'pt 1', 'it', 'bandung', '2345678', 2, NULL, '2026-09-01 18:55:18', '2026-09-01 18:55:18'),
(5, 'PT Abdul Fajar Wesfi Abadi', 'Perikanan', 'JL Tan Malaka 67, Sialang', '082233832590', 100, 'Tidak menerima siswa kelas 1', '2026-09-01 19:11:44', '2026-09-01 19:11:44'),
(6, 'PT INTI', 'Teknologi & Telekomunikasi', 'Bandung', '0812-4000-1001', 73, NULL, '2026-09-03 23:05:52', '2026-09-03 23:05:52'),
(7, 'PT Telkom Indonesia', 'Telekomunikasi & Teknologi', 'Jl. Japati No. 1, Bandung', '022-4521404', 78, NULL, '2026-09-04 19:59:53', '2026-09-04 19:59:53'),
(8, 'PT Pos Indonesia', 'Logistik & Jasa', 'Jl. Cilaki No. 73, Bandung', '022-4205670', 16, NULL, '2026-09-04 20:00:36', '2026-09-04 20:00:36'),
(9, 'PT LEN Industri', 'Teknologi & Elektronika', 'Jl. Soekarno Hatta No. 442, Bandung', '022-5202682', 34, NULL, '2026-09-04 20:01:10', '2026-09-04 20:01:10'),
(10, 'PT Pindad', 'Manufaktur & Industri', 'Jl. Gatot Subroto No. 517, Bandung', '022-7312073', 54, NULL, '2026-09-04 20:01:43', '2026-09-04 20:01:43'),
(11, 'CV Digital Kreatif Nusantara', 'CV Digital Kreatif Nusantara', 'Jl. Buah Batu No. 150, Bandung', 'Jl. Buah Batu No. 150, Bandung', 33, NULL, '2026-09-04 20:02:19', '2026-09-04 20:02:19'),
(12, 'PT Mitra Komputer Indonesia', 'PT Mitra Komputer Indonesia', 'Jl. Amir Machmud No. 200, Cimahi', '0813-4567-8901', 34, NULL, '2026-09-04 20:02:47', '2026-09-04 20:02:47'),
(13, 'CV Solusi Teknologi Mandiri', 'Software & IT', 'Jl. Mayor Abdurahman No. 85, Sumedang', '0821-2345-6789', 35, NULL, '2026-09-04 20:03:19', '2026-09-04 20:03:19'),
(14, 'PT Media Kreatif Indonesia', 'Multimedia & Digital', 'Jl. Terusan Buah Batu No. 99, Bandung', '082234567890', 70, NULL, '2026-09-04 20:03:42', '2026-09-07 08:36:18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `google_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` bigint UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` enum('admin','guru','siswa') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'siswa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `google_id`, `avatar`, `email_verified_at`, `password`, `role_id`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'Administrator', 'admin@gmail.com', NULL, NULL, NULL, '$2y$12$bbxqd79tCttrxiV6cZ7DdufI1EpmWZbNSxeWmcrsqfNzNVJZ9erUq', 1, '1odum0X15BLPYHqmaTo6EFb8fwrTbGvStsOuzWpEEMkTiQbx5mKXJtHnKYAx', '2026-08-26 21:25:49', '2026-08-27 06:09:17', 'admin'),
(6, 'fika', 'admin1@gmail.com', NULL, NULL, NULL, '$2y$12$HJf/DF4axKsKBSInPR8EPeiW6lQi7cKcqndHAqIZXuvIGmkygFiy.', 1, NULL, '2026-09-01 05:54:29', '2026-09-01 05:54:29', 'siswa'),
(18, 'Nurul Syafiqa Ramadhan', 'fika@gmail.com', NULL, NULL, NULL, '$2y$12$9epnpwYVXaqqbCuI44VaPeNirrIn6zdoD5yPyvfv0ExMqjKdGWawe', 3, NULL, '2026-09-03 21:01:11', '2026-09-03 21:01:11', 'siswa'),
(20, 'Ranti Ermina Sari S.pd', 'guru@gmail.com', NULL, NULL, NULL, '$2y$12$4IpErJPtfvEqpQj6fbVBnetffsNzhhtkNG1Ou5vyPSrObiZVFo22q', 2, NULL, '2026-09-03 21:03:08', '2026-09-07 20:51:54', 'siswa'),
(22, 'Ahmad Rizky Pratama', 'Ahmad@gmail.com', NULL, NULL, NULL, '$2y$12$UHX9XW0jlbhxSefT1p1jnOwN.kCcgEg9zUWqgLeDrje4IZjiQOxoa', 3, NULL, '2026-09-03 22:28:04', '2026-09-03 22:28:04', 'siswa'),
(23, 'Siti Nurhaliza', 'siti@gmail.com', NULL, NULL, NULL, '$2y$12$I.BkmNbmom27CeSPKDFyZ.KK1dUScwMb6JCLxcoyEKPiQfXvLK4cS', 3, NULL, '2026-09-03 22:31:34', '2026-09-03 22:31:34', 'siswa'),
(24, 'Muhammad Fajar Ramadhan', 'Fajar@gmail.com', NULL, NULL, NULL, '$2y$12$JZNsruvcdf2bKmn3NBYCh.atMmUlO1Inpw6Hr4H8LlLWrOK58wRwO', 3, NULL, '2026-09-03 22:32:45', '2026-09-03 22:32:45', 'siswa'),
(26, 'Rizky Aditya Saputra', 'Rizky@gmail.com', NULL, NULL, NULL, '$2y$12$rqiVUnM3M1izi/D55.hu.uvGBYcLJ62q6zDCtG1FlAKOK.9lmmy5K', 3, NULL, '2026-09-03 22:35:17', '2026-09-03 22:35:17', 'siswa'),
(27, 'Nurul Aisyah', 'Nurul@gmail.com', NULL, NULL, NULL, '$2y$12$IJXDHPRwI7ZLvsdmvzrjMeoO9l/OSWKudQyqpa.mhUIIYx2XyxCJq', 3, NULL, '2026-09-03 22:36:51', '2026-09-03 22:36:51', 'siswa'),
(28, 'Dimas Arya Nugraha', 'Dimas@gmail.com', NULL, NULL, NULL, '$2y$12$rGtcvRaLfWFvVNlnsZi/g.kLqRWV3SQDw1dEofMdWndHz3Nm/yy7u', 3, NULL, '2026-09-03 22:37:58', '2026-09-03 22:37:58', 'siswa'),
(29, 'Intan Permata Sari', 'Intan@gmail.com', NULL, NULL, NULL, '$2y$12$TCM0URGjkLKC5ryYJsrAt.XvHFNRUnmmmN5UlFX7GNCWKHGDzQDvi', 3, NULL, '2026-09-03 22:38:55', '2026-09-03 22:38:55', 'siswa'),
(30, 'Bagas Maulana Putra', 'Bagass@gmail.com', NULL, NULL, NULL, '$2y$12$IPFk8nxu8B0qg4yxaPMPb.1wMdd5Zfi0LtrbOrvNdXocWpiN7F1YK', 3, NULL, '2026-09-03 22:39:45', '2026-09-07 07:11:22', 'siswa'),
(33, 'Siti Rahma, S.Pd.', 'rahma@gmail.com', NULL, NULL, NULL, '$2y$12$kbkCmnJNP32cbGK4pKHH1e3tSZ.aamDVQ6P7UAVXEIcYmq8COjFpy', 2, NULL, '2026-09-03 22:48:37', '2026-09-03 22:48:37', 'siswa'),
(34, 'Budi Santoso, S.Pd., M.Pd.', 'Santoso@gmail.com', NULL, NULL, NULL, '$2y$12$nFVD9dVj2yxz6q3FyW/l4ucbCxT4TtxpLPA0A5yf31/bLlj1QQdry', 2, NULL, '2026-09-03 22:49:21', '2026-09-03 22:49:21', 'siswa'),
(35, 'Dewi Lestari, S.Pd.', 'Lestari@gmail.com', NULL, NULL, NULL, '$2y$12$Sfg4ETw5ePQf.3QnLQWDQObG0KmcmwBczhibGCYV7c8OSc4wwc7q2', 2, NULL, '2026-09-03 22:50:16', '2026-09-03 22:50:16', 'siswa'),
(36, 'Rudi Hartono, S.Pd.', 'Hartono@gmail.com', NULL, NULL, NULL, '$2y$12$coNHAzZNdlm7PgFAPK2Y5e3ulxnOn7Snf27gmO6N.SOadIFIk2Mdm', 2, NULL, '2026-09-03 22:54:29', '2026-09-03 22:54:29', 'siswa'),
(37, 'Nur Aisyah, S.Pd.I.', 'Aisyah@gmail.com', NULL, NULL, NULL, '$2y$12$yc8538VhVEssQ4DfUfSM3.a5wfLA/WWnGzrd/rtOsTNJxn6xlyjva', 2, NULL, '2026-09-03 22:55:52', '2026-09-03 22:55:52', 'siswa'),
(38, 'Andi Saputra, S.Pd.', 'Saputra@gmail.com', NULL, NULL, NULL, '$2y$12$r8RuZqZLy5qFRnKFpAgIxOoZbzZnSeRtPKX8Tx1Y3GNrpglR92NnO', 2, NULL, '2026-09-03 22:57:18', '2026-09-03 22:57:18', 'siswa'),
(39, 'Lina Marlina, S.Pd.', 'Marlina@gmail.com', NULL, NULL, NULL, '$2y$12$USfkbN7w7sGSDnf1eD9./uDdjJrIuhZQj7V3FMXE0Az4kCnNi0t5S', 2, NULL, '2026-09-03 22:58:20', '2026-09-03 22:58:20', 'siswa'),
(40, 'Eko Prasetyo, S.Pd.', 'Prasetyo@gmail.com', NULL, NULL, NULL, '$2y$12$uFWWujBc2rs8jvo8GQGms.2b1cFva4cpYJLUM/mQPF1sbdBrlN7SS', 2, NULL, '2026-09-03 22:59:29', '2026-09-03 22:59:29', 'siswa'),
(41, 'Rina Wulandari, S.Pd.', 'Wulandari@gmail.com', NULL, NULL, NULL, '$2y$12$4Vn/bcANtWUD7xIZlR.18edPwXIY.CM0RZSmMz22GrvpNA7imgCFK', 2, NULL, '2026-09-03 23:00:20', '2026-09-03 23:00:20', 'siswa'),
(42, 'Dedi Kurniawan, S.Pd.', 'Kurniawan@gmail.com', NULL, NULL, NULL, '$2y$12$2L4vJOF/iOl73SIAqUzqGecSb6GJ/A82iXp.aHIa9FFYmVChEC/ci', 2, NULL, '2026-09-03 23:01:11', '2026-09-07 07:55:27', 'siswa'),
(43, 'tania putri', 'tania@gmail.com', NULL, NULL, NULL, '$2y$12$gaD5dCcSGzSUIhT00y9bD.Z5BpvLPJIr0KcRQpoxtrYN4EvMlHJbO', 3, NULL, '2026-09-05 05:17:15', '2026-09-07 07:10:08', 'siswa'),
(44, 'zahra', 'zahra@gmail.com', NULL, NULL, NULL, '$2y$12$6V3h9qv.wTtH.rVtQS7cDO78u7d6cHhQ4XpVgkp47BKgewVOFh/fu', 3, NULL, '2026-09-07 07:14:06', '2026-09-07 07:14:06', 'siswa'),
(48, 'a', 'a@gmail.com', NULL, NULL, NULL, '$2y$12$lK9dEQ7qlPuRjIyTsElqWuNImTxcLsxGewSjenDQizlhicl.mDnv6', 3, NULL, '2026-09-10 17:35:24', '2026-09-10 17:35:24', 'siswa'),
(49, 'Aaaa', 'aaa@gmail.com', NULL, NULL, NULL, '$2y$12$8rugLxPp7ykqyEDI.QB4x.UQS40K8.YWGzbHbmAwmiqWsKX7DdkcG', 2, NULL, '2026-09-10 17:36:22', '2026-09-10 17:36:22', 'siswa'),
(50, 'Nurul Syafiqa', 'ika@gmail.com', NULL, NULL, NULL, '$2y$12$cxE6Cq20Jpj4XIiMg/fBZuIfPEi4M3mgemuCVA1RfdBxezeupfrLS', 3, NULL, '2026-09-16 00:05:52', '2026-09-16 00:05:52', 'siswa'),
(51, 'buk ranti', 'bukranti@gmail.com', NULL, NULL, NULL, '$2y$12$AY/WrV9mwiAHlEKWdOENTuBm/TddxxNPtSjkMmaOk7JyT8WjjTE4u', 2, NULL, '2026-09-16 00:08:29', '2026-09-16 00:08:29', 'siswa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  ADD KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`);

--
-- Indexes for table `gurus`
--
ALTER TABLE `gurus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `gurus_nip_unique` (`nip`),
  ADD KEY `gurus_user_id_foreign` (`user_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jurnal_pkls`
--
ALTER TABLE `jurnal_pkls`
  ADD PRIMARY KEY (`id_jurnal`),
  ADD KEY `jurnal_pkls_siswa_id_foreign` (`siswa_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pengajuan_pkls`
--
ALTER TABLE `pengajuan_pkls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengajuan_pkls_siswa_id_foreign` (`siswa_id`),
  ADD KEY `pengajuan_pkls_tempat_pkl_id_foreign` (`tempat_pkl_id`);

--
-- Indexes for table `penilaians`
--
ALTER TABLE `penilaians`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penilaians_siswa_id_foreign` (`siswa_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `siswas`
--
ALTER TABLE `siswas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `siswas_nis_unique` (`nis`),
  ADD KEY `siswas_user_id_foreign` (`user_id`),
  ADD KEY `siswas_guru_pembimbing_id_foreign` (`guru_pembimbing_id`);

--
-- Indexes for table `tempat_pkls`
--
ALTER TABLE `tempat_pkls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gurus`
--
ALTER TABLE `gurus`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jurnal_pkls`
--
ALTER TABLE `jurnal_pkls`
  MODIFY `id_jurnal` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `pengajuan_pkls`
--
ALTER TABLE `pengajuan_pkls`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `penilaians`
--
ALTER TABLE `penilaians`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `siswas`
--
ALTER TABLE `siswas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tempat_pkls`
--
ALTER TABLE `tempat_pkls`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `gurus`
--
ALTER TABLE `gurus`
  ADD CONSTRAINT `gurus_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jurnal_pkls`
--
ALTER TABLE `jurnal_pkls`
  ADD CONSTRAINT `jurnal_pkls_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswas` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pengajuan_pkls`
--
ALTER TABLE `pengajuan_pkls`
  ADD CONSTRAINT `pengajuan_pkls_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pengajuan_pkls_tempat_pkl_id_foreign` FOREIGN KEY (`tempat_pkl_id`) REFERENCES `tempat_pkls` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `penilaians`
--
ALTER TABLE `penilaians`
  ADD CONSTRAINT `penilaians_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswas` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `siswas`
--
ALTER TABLE `siswas`
  ADD CONSTRAINT `siswas_guru_pembimbing_id_foreign` FOREIGN KEY (`guru_pembimbing_id`) REFERENCES `gurus` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `siswas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
