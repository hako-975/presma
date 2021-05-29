-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Bulan Mei 2021 pada 00.27
-- Versi server: 10.4.19-MariaDB
-- Versi PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `presma`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurusan`
--

CREATE TABLE `jurusan` (
  `id_jurusan` int(11) NOT NULL,
  `jurusan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jurusan`
--

INSERT INTO `jurusan` (`id_jurusan`, `jurusan`) VALUES
(1, 'Teknik Informatika'),
(15, 'Sastra Inggris'),
(18, 'Sastra Jepang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kandidat`
--

CREATE TABLE `kandidat` (
  `id_kandidat` int(11) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `visi` text NOT NULL,
  `misi` text NOT NULL,
  `foto_kandidat` text NOT NULL,
  `no_urut` int(11) NOT NULL,
  `id_periode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kandidat`
--

INSERT INTO `kandidat` (`id_kandidat`, `nim`, `nama`, `visi`, `misi`, `foto_kandidat`, `no_urut`, `id_periode`) VALUES
(7, '201011402125', 'Andri Firman Saputra', 'Menang', 'Menang123', 'haus_coding.png', 1, 2),
(8, '201011402124', 'Irgi', 'Kalah', 'Kalah123', 'images.jpg', 2, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `log`
--

CREATE TABLE `log` (
  `id_log` int(11) NOT NULL,
  `isi_log` text NOT NULL,
  `tgl_log` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `log`
--

INSERT INTO `log` (`id_log`, `isi_log`, `tgl_log`, `id_user`) VALUES
(1, 'Jurusan Sastra Mandarin berhasil ditambahkan', 1621733911, 1),
(2, 'Jurusan Sastra Latin berhasil ditambahkan', 1621734104, 1),
(3, 'Jurusan Sastra Latin berhasil ditambahkan', 1621734187, 1),
(4, 'Jurusan Sastra Indonesia berhasil ditambahkan', 1621734246, 1),
(5, 'Jurusan Sastra Indonesia berhasil dihapus', 1621734337, 1),
(6, 'Jurusan Sastra Jepang berhasil dihapus', 1621734340, 1),
(7, 'Jurusan Sastra Latin berhasil dihapus', 1621734343, 1),
(8, 'Jurusan Sastra Mandarin berhasil dihapus', 1621734346, 1),
(9, 'Jurusan Sastra Inggris berhasil diubah menjadi Sastra Indonesia', 1621734357, 1),
(10, 'Jurusan Sastra Inggris berhasil ditambahkan', 1621736627, 1),
(11, 'Jurusan Teknik Elektro berhasil ditambahkan', 1621736660, 1),
(12, 'Jurusan Sastra Indonesia berhasil diubah menjadi Sastra Indonesian', 1621736674, 1),
(13, 'Jurusan Sastra Indonesian berhasil diubah menjadi Sastra Indonesia', 1621736678, 1),
(14, 'Jurusan Sastra Indonesia berhasil dihapus', 1621736687, 1),
(15, 'Role Tesr12e berhasil ditambahkan', 1621737020, 1),
(16, 'Role Tesr12e berhasil diubah menjadi Wkwkwkwk Kwkwkwk', 1621737028, 1),
(17, 'Role Wkwkwkwk Kwkwkwk berhasil dihapus', 1621737031, 1),
(18, 'Role Tes123 berhasil ditambahkan', 1621737040, 1),
(19, 'Role Tes123 berhasil diubah menjadi 123tes', 1621737044, 1),
(20, 'Role 123tes berhasil dihapus', 1621737047, 1),
(21, 'Role administrator berhasil diubah menjadi Administrator', 1621737141, 1),
(22, 'Role mahasiswa berhasil diubah menjadi Mahasiswa', 1621737143, 1),
(23, 'Role operator berhasil diubah menjadi Operator', 1621737146, 1),
(24, 'Akses ditolak! Role Administrator tidak boleh dihapus', 1621737313, 1),
(25, 'Jurusan Sastra Inggriss berhasil ditambahkan', 1621739125, 1),
(26, 'Jurusan Sastra Inggriss berhasil dihapus', 1621739128, 1),
(27, 'Akses ditolak! Role Administrator tidak boleh dihapus', 1621821441, 1),
(28, 'Jurusan Teknik Elektro berhasil diubah menjadi Sastra Inggris', 1621823317, 1),
(29, 'Jurusan Sastra Inggris berhasil diubah menjadi Teknik Elektro', 1621823417, 1),
(30, 'Jurusan Teknik Elektro berhasil dihapus', 1621823501, 1),
(31, 'User Andri975 dengan jabatan Operator berhasil ditambahkan', 1621824110, 1),
(32, 'User Andri975 berhasil diubah menjadi Andri9752 dan jabatan Operator menjadi Operator', 1621824332, 1),
(33, 'User Andri9752 berhasil diubah menjadi andri975 dan jabatan Operator menjadi Operator', 1621824345, 1),
(34, 'User tes123 dengan jabatan Mahasiswa berhasil ditambahkan', 1621824448, 1),
(35, 'User tes123 berhasil diubah menjadi tes123s dan jabatan Mahasiswa menjadi Mahasiswa', 1621824456, 1),
(36, 'User tes123s dengan jabatan Mahasiswa berhasil dihapus', 1621824458, 1),
(37, 'Akses ditolak! Role Administrator tidak boleh dihapus', 1621824466, 1),
(38, 'User tes123 dengan jabatan Mahasiswa berhasil ditambahkan', 1621824724, 1),
(39, 'Jabatan Mahasiswa berhasil diubah menjadi Tamu', 1621871195, 1),
(40, 'Rombel Sastra Inggris -> 2222 berhasil ditambahkan', 1621872248, 1),
(41, 'Rombel  ->  berhasil dihapus', 1621872259, 1),
(42, 'Rombel Teknik Informatika -> 1 berhasil ditambahkan', 1621872334, 1),
(43, 'Rombel Teknik Informatika semester 1 berhasil diubah menjadi Sastra Inggris semester 1', 1621872687, 1),
(44, 'Rombel Teknik Informatika semester 2 berhasil ditambahkan', 1621872697, 1),
(45, 'Rombel  semester  berhasil dihapus', 1621872702, 1),
(46, 'Rombel Teknik Informatika semester 1 berhasil ditambahkan', 1621872751, 1),
(47, 'Rombel Teknik Informatika semester 1 berhasil dihapus', 1621872754, 1),
(48, 'Rombel Teknik Informatika semester 1 berhasil ditambahkan', 1621872989, 1),
(49, 'Rombel Sastra Inggris semester 2 berhasil ditambahkan', 1621873021, 1),
(50, 'Jurusan Sastra Jepang berhasil ditambahkan', 1621874323, 1),
(51, 'Rombel Sastra Inggris semester 1 berhasil diubah menjadi Sastra Jepang semester 1', 1621874392, 1),
(52, 'Rombel Sastra Inggris semester 2 berhasil dihapus', 1621874418, 1),
(53, 'Rombel Sastra Inggris semester 1 berhasil ditambahkan', 1621874425, 1),
(54, 'Rombel Sastra Jepang semester 1 sudah tersedia', 1621874763, 1),
(55, 'Rombel Teknik Informatika semester 1 sudah tersedia', 1621874775, 1),
(56, 'Rombel Sastra Inggris semester 1 sudah tersedia', 1621875063, 1),
(57, 'Periode 2021 - 2023 berhasil ditambahkan', 1621877377, 1),
(58, 'Periode 2021 - 2023 berhasil dihapus', 1621877380, 1),
(59, 'Periode 2021 - 2022 berhasil ditambahkan', 1621877383, 1),
(60, 'Periode 2021 - 2022 sudah tersedia', 1621877387, 1),
(61, 'Periode 2023 - 2024 berhasil ditambahkan', 1621877409, 1),
(62, 'Periode 2022 - 2023 berhasil ditambahkan', 1621877416, 1),
(63, 'Periode 2021 - 2021 berhasil ditambahkan', 1621877426, 1),
(64, 'Periode 2025 - 2026 berhasil ditambahkan', 1621877486, 1),
(65, 'Periode 2021 - 2022 sudah tersedia', 1621878041, 1),
(66, 'Periode 2021 - 2021 berhasil diubah menjadi 1998 - 1999 dengan status belum_selesai', 1621878049, 1),
(67, 'Periode 2021 - 2022 sudah tersedia', 1621878056, 1),
(68, 'Periode 1998 - 1999 sudah tersedia', 1621878318, 1),
(69, 'Periode 1998 - 1999 sudah tersedia', 1621878323, 1),
(70, 'Periode 1998 - 1999 berhasil diubah menjadi 1998 - 1999 dengan status Sudah Selesai', 1621878373, 1),
(71, 'Periode 2021 - 2022 sudah tersedia', 1621878380, 1),
(72, 'Periode 1998 - 1999 berhasil diubah menjadi 1998 - 1999 dengan status Belum Selesai', 1621878409, 1),
(73, 'Periode 1998 - 1999 berhasil dihapus', 1621878415, 1),
(74, 'Periode 2025 - 2026 berhasil dihapus', 1621878422, 1),
(75, 'Mahasiswa Andri Firman Saputra berhasil diubah menjadi Andri Firman Saputra', 1621881090, 1),
(76, 'Mahasiswa Andri Firman Saputra, 2002-01-29, Teknik Informatika, semester 1 berhasil diubah menjadi Andri Firman Saputr12, , Teknik Informatika, semester 1', 1621881499, 1),
(77, 'Mahasiswa Andri Firman Saputr12, 2002-01-29, Teknik Informatika, semester 1 berhasil diubah menjadi Andri Firman Saputra, , Teknik Informatika, semester 1', 1621881524, 1),
(78, 'Mahasiswa Andri Firman Saputra, 2002-01-29, Teknik Informatika, semester 1 berhasil diubah menjadi Andri Firman Saputra123, Teknik Informatika, semester 1', 1621881554, 1),
(79, 'Mahasiswa Andri Firman Saputra123, 2002-01-29, Teknik Informatika, semester 1 berhasil diubah menjadi Andri Firman Saputra, 2002-01-29, Teknik Informatika, semester 1', 1621881604, 1),
(80, 'Mahasiswa Andri Firman Saputra dengan NIM 201011402125 berhasil dihapus', 1621881644, 1),
(81, 'Mahasiswa Andri Firman Saputra berhasil ditambahkan', 1621881659, 1),
(82, 'Mahasiswa Andri Firman Saputra, 2002-01-29, Teknik Informatika, semester 1 berhasil diubah menjadi Andri Firman Saputra, 2002-01-29, Teknik Informatika, semester 1', 1621881860, 1),
(83, 'Mahasiswa Andri Firman Saputra berhasil ditambahkan', 1621881875, 1),
(84, 'nim 201011402123 sudah tersedia', 1621881883, 1),
(85, 'Mahasiswa Andri Firman Saputra, 2002-01-29, Sastra Inggris, semester 1 berhasil diubah menjadi Andri Firman Saputra, 2002-01-29, Sastra Inggris, semester 1', 1621881888, 1),
(86, 'Mahasiswa Andri Firman Saputra dengan NIM 201011402124 berhasil dihapus', 1621881933, 1),
(87, 'Mahasiswa Andri Firman Saputra, 2002-01-29, Teknik Informatika, semester 1 berhasil diubah menjadi Andri Firman Saputra, 2002-01-29, Teknik Informatika, semester 1', 1621881937, 1),
(88, 'Mahasiswa Andri Firman Saputra dengan NIM 201011402125 berhasil dihapus', 1621882099, 1),
(89, 'Mahasiswa 201011402125, Andri Firman Saputra, 2002-01-29, Sastra Jepang, semester 1 berhasil ditambahkan', 1621882113, 1),
(90, 'Mahasiswa 201011402125, Andri Firman Saputra, 2002-01-29, Sastra Jepang, semester 1 berhasil diubah menjadi 201011402125, Andri Firman Saputra, 2002-01-29, Teknik Informatika, semester 1', 1621882143, 1),
(91, 'Mahasiswa 201011402125, Andri Firman Saputra, 2002-01-29, Teknik Informatika, semester 1 berhasil dihapus', 1621882245, 1),
(92, 'Mahasiswa 201011402125, Andri Firman Saputra, 2002-01-29, Teknik Informatika, semester 1 berhasil ditambahkan', 1621882263, 1),
(93, 'Kandidat Andri Firman Saputra dengan NIM 201011402125 berhasil ditambahkan', 1621985974, 1),
(94, 'Kandidat 201011402125, Andri Firman Saputra berhasil dihapus', 1621986805, 1),
(95, 'Kandidat Andri Firman Saputra dengan NIM 201011402125 berhasil ditambahkan', 1621986853, 1),
(96, 'Kandidat 201011402125, Nama: Andri Firman Saputra, No. Urut:  berhasil diubah menjadi 201011402125, Nama: Andri Firman Saputra, No. Urut: 1', 1621989156, 1),
(97, 'Kandidat 201011402125, Nama: Andri Firman Saputra, No. Urut:  berhasil diubah menjadi 201011402125, Nama: Andri Firman Saputra, No. Urut: 1', 1621989170, 1),
(98, 'Kandidat 201011402125, Nama: Andri Firman Saputra, No. Urut:  berhasil diubah menjadi 201011402125, Nama: Andri Firman Saputra2, No. Urut: 1', 1621989175, 1),
(99, 'Kandidat 201011402125, Nama: Andri Firman Saputra2, No. Urut:  berhasil diubah menjadi 2010114021252, Nama: Andri Firman Saputra2, No. Urut: 1', 1621989179, 1),
(100, 'Kandidat 2010114021252, Nama: Andri Firman Saputra2, No. Urut:  berhasil diubah menjadi 201011402125, Nama: Andri Firman Saputra2, No. Urut: 2', 1621989187, 1),
(101, 'Kandidat Sasdas dengan NIM 202301320 berhasil ditambahkan', 1621989211, 1),
(102, 'Kandidat 202301320, Sasdas berhasil dihapus', 1621989219, 1),
(103, 'Kandidat 201011402125, Nama: Andri Firman Saputra2, No. Urut:  berhasil diubah menjadi 201011402125, Nama: Andri Firman Saputra, No. Urut: 1', 1621989242, 1),
(104, 'Kandidat 201011402125, Andri Firman Saputra berhasil dihapus', 1621989509, 1),
(105, 'Kandidat Asdads dengan NIM 2313 berhasil ditambahkan', 1621989630, 1),
(106, 'Rombel Sastra Inggris semester 1 sudah tersedia', 1621990116, 1),
(107, 'Rombel Sastra Jepang semester 1 sudah tersedia', 1621990124, 1),
(108, 'Kandidat 2313, Asdads berhasil dihapus', 1621990426, 1),
(109, 'Kandidat Andri Firman Saputra dengan NIM 201011402125 berhasil ditambahkan', 1621990440, 1),
(110, 'Kandidat 201011402125, Nama: Andri Firman Saputra, No. Urut:  berhasil diubah menjadi 201011402125, Nama: Andri Firman Saputra, No. Urut: 1', 1621990448, 1),
(111, 'Kandidat Sadas dengan NIM 21312 berhasil ditambahkan', 1621990653, 1),
(112, 'Kandidat 201011402125, Nama: Andri Firman Saputra, No. Urut:  berhasil diubah menjadi 201011402125, Nama: Andri Firman Saputra, No. Urut: 2', 1621990658, 1),
(113, 'Kandidat 201011402125, Nama: Andri Firman Saputra, No. Urut:  berhasil diubah menjadi 201011402125, Nama: Andri Firman Saputra, No. Urut: 1', 1621990665, 1),
(114, 'nim 201011402125 sudah tersedia', 1621990678, 1),
(115, 'Kandidat 201011402125, Andri Firman Saputra berhasil dihapus', 1621990713, 1),
(116, 'Kandidat 21312, Sadas berhasil dihapus', 1621990715, 1),
(117, 'Kandidat Andri Firman Saputra dengan NIM 201011402125 berhasil ditambahkan', 1621990741, 1),
(118, 'Kandidat Irgi dengan NIM 201011402124 berhasil ditambahkan', 1621990767, 1),
(119, 'No. Urut 1 sudah tersedia', 1621990928, 1),
(120, 'Kandidat 201011402125, Nama: Andri Firman Saputra, No. Urut:  berhasil diubah menjadi 201011402125, Nama: Andri Firman Saputra, No. Urut: 0', 1621990937, 1),
(121, 'Kandidat 201011402125, Nama: Andri Firman Saputra, No. Urut:  berhasil diubah menjadi 201011402125, Nama: Andri Firman Saputra, No. Urut: -1', 1621990942, 1),
(122, 'Kandidat 201011402125, Nama: Andri Firman Saputra, No. Urut:  berhasil diubah menjadi 201011402125, Nama: Andri Firman Saputra, No. Urut: 1', 1621991033, 1),
(123, 'User andri975 berhasil diubah menjadi andri975 dan jabatan Operator menjadi Tamu', 1621991585, 1),
(124, 'User andri975 berhasil diubah menjadi andri975 dan jabatan Tamu menjadi Operator', 1621991590, 1),
(125, 'Periode 2021 - 2022 berhasil diubah menjadi 2021 - 2022 dengan status Sudah Selesai', 1621991651, 1),
(126, 'Periode 2021 - 2022 berhasil diubah menjadi 2021 - 2022 dengan status Belum Selesai', 1621991655, 1),
(127, 'Mahasiswa 201011402125, Andri Firman Saputra, 2002-01-29, Teknik Informatika, semester 1 berhasil diubah menjadi 201011402125, Andri Firman Saputra123, 2002-01-29, Teknik Informatika, semester 1', 1621991665, 1),
(128, 'Mahasiswa 201011402125, Andri Firman Saputra123, 2002-01-29, Teknik Informatika, semester 1 berhasil diubah menjadi 201011402125, Andri Firman Saputra, 2002-01-29, Teknik Informatika, semester 1', 1621991670, 1),
(129, 'Mahasiswa 201011402125, Andri Firman Saputra, 2002-01-29, Teknik Informatika, semester 1 berhasil diubah menjadi , Andri Firman Saputra, 2002-01-29, Teknik Informatika, semester 1', 1621991698, 1),
(130, 'Mahasiswa , Andri Firman Saputra, 2002-01-29, Teknik Informatika, semester 1 berhasil diubah menjadi 201011402125, Andri Firman Saputra, 2002-01-29, Teknik Informatika, semester 1', 1621991724, 1),
(131, 'Kandidat 201011402125, Nama: Andri Firman Saputra, No. Urut:  berhasil diubah menjadi 201011402125, Nama: Andri Firman Saputra, No. Urut: 3', 1621991782, 1),
(132, 'Kandidat 201011402125, Nama: Andri Firman Saputra, No. Urut:  berhasil diubah menjadi 201011402125, Nama: Andri Firman Saputra, No. Urut: 1', 1621991787, 1),
(133, 'Mahasiswa 201020130120310, Irgi, 2002-08-28, Teknik Informatika, semester 1 berhasil ditambahkan', 1622063985, 1),
(134, 'Mahasiswa 23213123, Delia, 2001-01-29, Sastra Inggris, semester 1 berhasil ditambahkan', 1622064587, 1),
(135, 'Mahasiswa 20123821381, Andre, 2002-01-29, Sastra Jepang, semester 1 berhasil ditambahkan', 1622064761, 1),
(136, 'Vote  berhasil ditambahkan', 1622064899, 1),
(137, 'Vote  berhasil ditambahkan', 1622065083, 1),
(138, 'Vote  berhasil dihapus', 1622065146, 1),
(139, 'Vote  berhasil dihapus', 1622065156, 1),
(140, 'Vote  berhasil dihapus', 1622065182, 1),
(141, 'Vote  berhasil ditambahkan', 1622065205, 1),
(142, 'Vote  berhasil ditambahkan', 1622065211, 1),
(143, 'Vote Delia berhasil ditambahkan', 1622065279, 1),
(144, 'Data vote Delia berhasil dihapus', 1622065412, 1),
(145, 'Data vote Irgi berhasil dihapus', 1622065415, 1),
(146, 'Data vote Andri Firman Saputra berhasil dihapus', 1622065418, 1),
(147, 'Data vote Andri Firman Saputra berhasil ditambahkan', 1622065423, 1),
(148, 'Data vote Andre berhasil ditambahkan', 1622320840, 1),
(149, 'Data vote Andre berhasil dihapus', 1622320856, 1),
(150, 'Data vote 20123821381, Andre, 2021 - 2022 berhasil ditambahkan', 1622321152, 1),
(151, 'Data vote 20123821381, Andre, 2021 - 2022 berhasil dihapus', 1622321160, 1),
(152, 'Data vote 23213123, Delia, 2021 - 2022 berhasil ditambahkan', 1622321309, 1),
(153, 'Data vote 201020130120310, Irgi, 2023 - 2024 berhasil ditambahkan', 1622321352, 1),
(154, 'Data vote 23213123, Delia, 2021 - 2022 berhasil dihapus', 1622321677, 1),
(155, 'Data vote 23213123, Delia, 2021 - 2022 berhasil ditambahkan', 1622321684, 1),
(156, 'Data vote 20123821381, Andre, 2021 - 2022 berhasil ditambahkan', 1622321937, 1),
(157, 'Data vote 201020130120310, Irgi, 2021 - 2022 berhasil ditambahkan', 1622322988, 1),
(158, 'Periode 2024 - 2025 sudah tersedia', 1622323460, 1),
(159, 'Periode 2025 - 2026 sudah tersedia', 1622323915, 1),
(160, 'Periode 2026 - 2027 sudah tersedia', 1622323946, 1),
(161, 'Periode  berhasil ditambahkan', 1622326285, 1),
(162, 'Periode  berhasil ditambahkan', 1622326320, 1),
(163, 'User tamu dengan jabatan Tamu berhasil ditambahkan', 1622327107, 1),
(164, 'User tes123 dengan jabatan Tamu berhasil dihapus', 1622327112, 1),
(165, 'User andri975 dengan jabatan Operator berhasil dihapus', 1622327122, 1),
(166, 'User operator dengan jabatan Operator berhasil ditambahkan', 1622327135, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id_mahasiswa` int(11) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `id_rombel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`id_mahasiswa`, `nim`, `nama`, `tgl_lahir`, `id_rombel`) VALUES
(5, '201011402125', 'Andri Firman Saputra', '2002-01-29', 5),
(6, '201020130120310', 'Irgi', '2002-08-28', 5),
(7, '23213123', 'Delia', '2001-01-29', 7),
(8, '20123821381', 'Andre', '2002-01-29', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `periode`
--

CREATE TABLE `periode` (
  `id_periode` int(11) NOT NULL,
  `periode` varchar(20) NOT NULL,
  `status` enum('belum_selesai','sudah_selesai') DEFAULT 'belum_selesai'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `periode`
--

INSERT INTO `periode` (`id_periode`, `periode`, `status`) VALUES
(1, '2021 - 2022', 'belum_selesai'),
(2, '2022 - 2023', 'belum_selesai');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL,
  `role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`id_role`, `role`) VALUES
(1, 'Administrator'),
(2, 'Operator'),
(3, 'Tamu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rombel`
--

CREATE TABLE `rombel` (
  `id_rombel` int(11) NOT NULL,
  `semester` int(3) NOT NULL,
  `id_jurusan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `rombel`
--

INSERT INTO `rombel` (`id_rombel`, `semester`, `id_jurusan`) VALUES
(2, 1, 18),
(5, 1, 1),
(7, 1, 15);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `id_role`) VALUES
(1, 'admin', '$2y$10$WmVoIXr01fm5iPxeVJwUiewEM4XE2u7j7yV/mDQiYBjjNBMDzkro.', 1),
(5, 'tamu', '$2y$10$Xr9YoUXEZyhbdwXjGgOYz.HML2JedBaSNbCrqewcCTbXbz7vAvksm', 3),
(6, 'operator', '$2y$10$vtNg5aH.BfkCjHBk4iSOPeho1HluwV7VVXv9sKn8bgTJ0LbQPEZ.C', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `vote`
--

CREATE TABLE `vote` (
  `id_vote` int(11) NOT NULL,
  `vote` enum('belum','sudah') DEFAULT 'belum',
  `tgl_vote` int(11) DEFAULT NULL,
  `id_mahasiswa` int(11) NOT NULL,
  `id_kandidat` int(11) DEFAULT NULL,
  `id_periode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `vote`
--

INSERT INTO `vote` (`id_vote`, `vote`, `tgl_vote`, `id_mahasiswa`, `id_kandidat`, `id_periode`) VALUES
(1, 'belum', NULL, 5, NULL, 1),
(2, 'belum', NULL, 6, NULL, 1),
(3, 'belum', NULL, 8, NULL, 1),
(4, 'belum', NULL, 7, NULL, 1),
(5, 'belum', NULL, 5, NULL, 2),
(6, 'belum', NULL, 6, NULL, 2),
(7, 'belum', NULL, 8, NULL, 2),
(8, 'belum', NULL, 7, NULL, 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indeks untuk tabel `kandidat`
--
ALTER TABLE `kandidat`
  ADD PRIMARY KEY (`id_kandidat`),
  ADD KEY `id_periode` (`id_periode`);

--
-- Indeks untuk tabel `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id_mahasiswa`),
  ADD KEY `id_rombel` (`id_rombel`);

--
-- Indeks untuk tabel `periode`
--
ALTER TABLE `periode`
  ADD PRIMARY KEY (`id_periode`);

--
-- Indeks untuk tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indeks untuk tabel `rombel`
--
ALTER TABLE `rombel`
  ADD PRIMARY KEY (`id_rombel`),
  ADD KEY `id_jurusan` (`id_jurusan`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_role` (`id_role`);

--
-- Indeks untuk tabel `vote`
--
ALTER TABLE `vote`
  ADD PRIMARY KEY (`id_vote`),
  ADD KEY `id_mahasiswa` (`id_mahasiswa`),
  ADD KEY `id_kandidat` (`id_kandidat`),
  ADD KEY `id_periode` (`id_periode`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id_jurusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `kandidat`
--
ALTER TABLE `kandidat`
  MODIFY `id_kandidat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `log`
--
ALTER TABLE `log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;

--
-- AUTO_INCREMENT untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id_mahasiswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `periode`
--
ALTER TABLE `periode`
  MODIFY `id_periode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `rombel`
--
ALTER TABLE `rombel`
  MODIFY `id_rombel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `vote`
--
ALTER TABLE `vote`
  MODIFY `id_vote` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD CONSTRAINT `mahasiswa_ibfk_1` FOREIGN KEY (`id_rombel`) REFERENCES `rombel` (`id_rombel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `rombel`
--
ALTER TABLE `rombel`
  ADD CONSTRAINT `rombel_ibfk_1` FOREIGN KEY (`id_jurusan`) REFERENCES `jurusan` (`id_jurusan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `vote`
--
ALTER TABLE `vote`
  ADD CONSTRAINT `vote_ibfk_1` FOREIGN KEY (`id_periode`) REFERENCES `periode` (`id_periode`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vote_ibfk_2` FOREIGN KEY (`id_kandidat`) REFERENCES `kandidat` (`id_kandidat`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vote_ibfk_3` FOREIGN KEY (`id_mahasiswa`) REFERENCES `mahasiswa` (`id_mahasiswa`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
