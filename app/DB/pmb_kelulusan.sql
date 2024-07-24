-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 24 Jul 2024 pada 07.47
-- Versi server: 8.0.30
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pmb`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `pmb_kelulusan`
--

CREATE TABLE `pmb_kelulusan` (
  `id` int NOT NULL,
  `id_tagihan` int NOT NULL,
  `prodi_lulus` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `pmb_kelulusan`
--

INSERT INTO `pmb_kelulusan` (`id`, `id_tagihan`, `prodi_lulus`) VALUES
(7, 2077, 'Ilmu Komunikasi'),
(8, 2077, 'Akuntansi'),
(9, 2077, 'Akuntansi'),
(10, 2077, 'Akuntansi'),
(11, 2077, 'Akuntansi'),
(12, 2077, 'Akuntansi'),
(13, 2077, 'Akuntansi'),
(14, 2077, 'Akuntansi'),
(15, 2077, 'Akuntansi'),
(16, 2077, 'Akuntansi'),
(17, 2077, 'Akuntansi');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `pmb_kelulusan`
--
ALTER TABLE `pmb_kelulusan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `pmb_kelulusan`
--
ALTER TABLE `pmb_kelulusan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
