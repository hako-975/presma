-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Jun 2021 pada 10.01
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
(2, 'Sastra Inggris'),
(3, 'Akuntansi'),
(4, 'Bisnis Manajemen');

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
(1, '201011402130', 'Salsabilla', 'Menjadi pelajar yang peduli terhadap pengembangan kualitas sumber daya manusia di bidang kerohanian, pengabdian masyarakat, pelajaran, dan perkembangan teknologi terkini.', 'Membentuk wadah belajar kelompok terpadu bagi siswa.\r\nMenyelenggarakan perlombaan yang mendidik.\r\nMenyelenggarakan kegiatan masa orientasi siswa yang jauh dari kesan pembodohan.\r\nAktif belajar di media sosial seperti Brainly, Edmodo, dan Quipper.\r\nIkut membantu penyelenggaran kegiatan hari besar keagamaan.', 'sample-1.png', 1, 1),
(2, '201011402131', 'Muhamad Rokhim Yuwono', 'Menjadi wadah bagi siswa untuk mengembangkan segala potensi yang ada sehingga terbentuk siwa yg cerdas, kreatif, dinamis,  berprestasi, berakhlak mulia dan menjaga nama baik sekolah menuju sekolah yang Unggul di tingkat nasional', 'Melaksanakan kegiatan yang dapat meningkatkan hubungan positif antar guru dan siswa\r\nMenciptkan kondisi lingkungan sekolah yang kondusif dalam belajar, untuk menghasilkan siswa yang berkompetensi dan mandiri\r\nMengaktifkan kelompok belajar dari masing-masing kelas\r\nMemaksimalkan peran siswa dalam menjaga kebersihan lingkungan\r\nMemajukan kualitas ekskul di sekolah agar banyak diminati siswa dan mampu mengukir prestasi diluar sekolah\r\nMengadakan kerjasama dengan sekolah lain dari sisi akademik, olah raga dan seni\r\nMembentuk karakter siswa yang unggul dari SQ. IQ, EQ\r\nMenjalin kerja sama dengan organisasi internal sekolah lainnya untuk memicu kreatifitas siswa\r\nAktif menyerap dan berbagi informasi tentang kondisi dunia pendidikan\r\nMenjadi jembatan siswa berprestasi untuk mendapatkan beasiswa', 'sample-2.png', 2, 1),
(3, '201011402132', 'Yunita', 'Menjadikan siswa lebih kreatif, inovatif, aktif, bertanggung jawab serta dilandasi  iman dan menjadikan organissasi sebagai sarana untuk menampung inspirasi dan aspirasi siswa  dalam berbagai kegiatan.', 'Meningkatkan keimanan dan ketaqwaan kepada Tuhan Yang Maha Esa, menegaskan berpakaian yang rapi dan sopan, menegaskan kembali pentingnya menjaga lingkungan, meminimalisir adanya anggapan bahwa adanya senior dan junior, menciptakan ekstrakurikuler yang menarik dan kreatif, melanjutkan program kerja organisasi sebelumnya yang belum terlaksana, menjadi siswa-siswi yang pintar, penuh tanggung jawab, berwibawa dan juga disiplin tinggi.', 'sample-3.png', 3, 1);

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
(1, 'User tamu dengan jabatan Tamu berhasil ditambahkan', 1622686590, 1),
(2, 'Jurusan Teknik Informatika berhasil ditambahkan', 1622686624, 1),
(3, 'Jurusan Sastra Inggris berhasil ditambahkan', 1622686630, 1),
(4, 'Jurusan Akuntansi berhasil ditambahkan', 1622686663, 1),
(5, 'Jurusan Bisnis Manajemen berhasil ditambahkan', 1622686681, 1),
(6, 'Rombel Teknik Informatika semester 1 berhasil ditambahkan', 1622686691, 1),
(7, 'Rombel Akuntansi semester 1 berhasil ditambahkan', 1622686695, 1),
(8, 'Rombel Bisnis Manajemen semester 1 berhasil ditambahkan', 1622686700, 1),
(9, 'Rombel Sastra Inggris semester 1 berhasil ditambahkan', 1622686704, 1),
(10, 'Periode 2021 - 2022 sudah tersedia', 1622686897, 1),
(11, 'Periode 2022 - 2023 sudah tersedia', 1622686920, 1),
(12, 'Isi Mahasiswa terlebih dahulu', 1622687062, 1),
(13, 'Mahasiswa 201011402125, Andri Firman Saputra, 2002-01-29, Teknik Informatika, semester 1 berhasil ditambahkan', 1622687088, 1),
(14, 'Periode 2021 - 2022 berhasil ditambahkan', 1622687099, 1),
(15, 'Periode 2021 - 2022 berhasil dihapus', 1622687121, 1),
(16, 'Mahasiswa 201011402126, Andre Farhan Saputra, 2002-01-29, Sastra Inggris, semester 1 berhasil ditambahkan', 1622687156, 1),
(17, 'Mahasiswa 201011402127, Muhammad Irgi Al-ghitraf, 2002-08-28, Akuntansi, semester 1 berhasil ditambahkan', 1622687180, 1),
(18, 'Mahasiswa 201011402128, Delia Romadhona, 2001-12-06, Akuntansi, semester 1 berhasil ditambahkan', 1622687235, 1),
(19, 'Mahasiswa 201011402127, Muhammad Irgi Al-ghitraf, 2002-08-28, Akuntansi, semester 1 berhasil diubah menjadi 201011402127, Muhammad Irgi Al-ghitraf, 2002-08-28, Bisnis Manajemen, semester 1', 1622687242, 1),
(20, 'Mahasiswa 201011402129, Cindy Apriliana Dewi, 2002-04-17, Akuntansi, semester 1 berhasil ditambahkan', 1622687283, 1),
(21, 'Periode 2021 - 2022 berhasil ditambahkan', 1622687301, 1),
(22, 'Kandidat Salsabilla dengan NIM 201011402130 berhasil ditambahkan', 1622687459, 1),
(23, 'Kandidat Muhamad Rokhim Yuwono dengan NIM 201011402131 berhasil ditambahkan', 1622687556, 1),
(24, 'Kandidat Yunita dengan NIM 201011402132 berhasil ditambahkan', 1622688140, 1),
(25, 'Kandidat 201011402132, Nama: Yunita, No. Urut:  berhasil diubah menjadi 201011402132, Nama: Yunita, No. Urut: 3', 1622688163, 1),
(26, 'Kandidat 201011402132, Nama: Yunita, No. Urut:  berhasil diubah menjadi 201011402132, Nama: Yunita, No. Urut: 3', 1622688259, 1),
(27, 'Kandidat 201011402132, Nama: Yunita, No. Urut:  berhasil diubah menjadi 201011402132, Nama: Yunita, No. Urut: 4', 1622688357, 1),
(28, 'Kandidat 201011402132, Nama: Yunita, No. Urut:  berhasil diubah menjadi 201011402132, Nama: Yunita, No. Urut: 3', 1622688368, 1),
(29, 'Kandidat 201011402132, Nama: Yunita, No. Urut:  berhasil diubah menjadi 201011402132, Nama: Yunita, No. Urut: 4', 1622688375, 1),
(30, 'Kandidat 201011402132, Nama: Yunita, No. Urut:  berhasil diubah menjadi 201011402132, Nama: Yunita, No. Urut: 3', 1622688445, 1),
(31, 'Kandidat 201011402132, Nama: Yunita, No. Urut:  berhasil diubah menjadi 201011402132, Nama: Yunita, No. Urut: 4', 1622688497, 1),
(32, 'Kandidat 201011402132, Nama: Yunita, No. Urut:  berhasil diubah menjadi 201011402132, Nama: Yunita, No. Urut: 3', 1622688618, 1);

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
(1, '201011402125', 'Andri Firman Saputra', '2002-01-29', 1),
(2, '201011402126', 'Andre Farhan Saputra', '2002-01-29', 4),
(3, '201011402127', 'Muhammad Irgi Al-ghitraf', '2002-08-28', 3),
(4, '201011402128', 'Delia Romadhona', '2001-12-06', 2),
(5, '201011402129', 'Cindy Apriliana Dewi', '2002-04-17', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `periode`
--

CREATE TABLE `periode` (
  `id_periode` int(11) NOT NULL,
  `periode` varchar(20) NOT NULL,
  `status` enum('belum_selesai','sudah_selesai') DEFAULT 'belum_selesai',
  `aktif` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `periode`
--

INSERT INTO `periode` (`id_periode`, `periode`, `status`, `aktif`) VALUES
(1, '2021 - 2022', 'belum_selesai', 1);

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
(1, 1, 1),
(2, 1, 3),
(3, 1, 4),
(4, 1, 2);

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
(1, 'admin', '$2y$10$zOZ8M4CnJs0yJ6WcM5UFbuv7uff8a.jpBQvbO62BT06iBwgMGz1Em', 1),
(2, 'operator', '$2y$10$vtNg5aH.BfkCjHBk4iSOPeho1HluwV7VVXv9sKn8bgTJ0LbQPEZ.C', 2),
(3, 'tamu', '$2y$10$4kiWR3npmWVCc1mR1W9tqeGq7V5J/8Lq/hM8l8MRrpY6/MRboOWP.', 3);

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
(1, 'belum', NULL, 1, NULL, 1),
(2, 'belum', NULL, 2, NULL, 1),
(3, 'belum', NULL, 3, NULL, 1),
(4, 'belum', NULL, 4, NULL, 1),
(5, 'belum', NULL, 5, NULL, 1);

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
  MODIFY `id_jurusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `kandidat`
--
ALTER TABLE `kandidat`
  MODIFY `id_kandidat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `log`
--
ALTER TABLE `log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id_mahasiswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `periode`
--
ALTER TABLE `periode`
  MODIFY `id_periode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `rombel`
--
ALTER TABLE `rombel`
  MODIFY `id_rombel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `vote`
--
ALTER TABLE `vote`
  MODIFY `id_vote` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `kandidat`
--
ALTER TABLE `kandidat`
  ADD CONSTRAINT `kandidat_ibfk_1` FOREIGN KEY (`id_periode`) REFERENCES `periode` (`id_periode`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `log_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

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
