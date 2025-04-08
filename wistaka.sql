-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Apr 2025 pada 18.01
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wistaka`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `artikel`
--

CREATE TABLE `artikel` (
  `id_artikel` varchar(20) NOT NULL,
  `judul_artikel` varchar(50) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `thumbnail_artikel` varchar(255) NOT NULL,
  `teks` text NOT NULL,
  `waktu_terbit` date NOT NULL,
  `draft` enum('true','false') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `artikel`
--

INSERT INTO `artikel` (`id_artikel`, `judul_artikel`, `slug`, `thumbnail_artikel`, `teks`, `waktu_terbit`, `draft`) VALUES
('AR250407035253', 'hello worlda', 'hello-worlda', 'AR250407035253.jpeg', '<p>aaaaa</p>', '2025-04-07', 'false');

-- --------------------------------------------------------

--
-- Struktur dari tabel `galeri`
--

CREATE TABLE `galeri` (
  `id_galeri` varchar(20) NOT NULL,
  `wisata` varchar(20) NOT NULL,
  `galeri` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `galeri`
--

INSERT INTO `galeri` (`id_galeri`, `wisata`, `galeri`) VALUES
('GL67e65d51b0fe2', 'WS250328092621', '499bdf5e968ebac1f222aeaedc1b3b7e.png'),
('GL67e65d51b53fc', 'WS250328092621', '618ac49d8904ebd911c8a25070c24ba8.png'),
('GL67e65d51b8cee', 'WS250328092621', '4ee1358d2c8ffa9bf282ac982a69457f.png'),
('GL67e65d51bfe30', 'WS250328092621', '66d2f156baafe598ffd1c99b3f2980e8.png'),
('GL67e65d51c46ae', 'WS250328092621', '1bab988163fbfd2132b8fc981badc3fa.png'),
('GL67e65d51c7f51', 'WS250328092621', '654ce7f3d646bc85e90c0c9e60d59ff2.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `iklan`
--

CREATE TABLE `iklan` (
  `id_iklan` varchar(20) NOT NULL,
  `iklan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `iklan`
--

INSERT INTO `iklan` (`id_iklan`, `iklan`) VALUES
('IK250328113435', 'IK250328113435.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` varchar(20) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL,
  `thumbnail_kategori` varchar(255) NOT NULL,
  `ikon_kategori` varchar(255) NOT NULL,
  `unggulan` enum('true','false') NOT NULL,
  `background_unggulan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `thumbnail_kategori`, `ikon_kategori`, `unggulan`, `background_unggulan`) VALUES
('KT250328092535', 'Budaya', '2.png', '4.png', 'true', '4.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `wisata`
--

CREATE TABLE `wisata` (
  `id_wisata` varchar(20) NOT NULL,
  `kategori` varchar(20) NOT NULL,
  `thumbnail_wisata` varchar(255) NOT NULL,
  `nama_wisata` varchar(50) NOT NULL,
  `deskripsi_wisata` varchar(255) NOT NULL,
  `jam_buka` text NOT NULL,
  `harga_masuk` text NOT NULL,
  `parkir` text NOT NULL,
  `fasilitas` text NOT NULL,
  `map` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `publish` enum('true','false') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `wisata`
--

INSERT INTO `wisata` (`id_wisata`, `kategori`, `thumbnail_wisata`, `nama_wisata`, `deskripsi_wisata`, `jam_buka`, `harga_masuk`, `parkir`, `fasilitas`, `map`, `alamat`, `publish`) VALUES
('WS250328092621', 'KT250328092535', 'WS250328092621.jpeg', 'Keraton', '<p>Pusat kota kerajaan</p>', '<p>1</p>', '<p>1</p>', '<p>1</p>', '<p>1</p>', 'https://mbuh', 'Yogyakarta', 'true'),
('WS250407040945', 'KT250328092535', 'WS250407040945.jpeg', 'mbuh', '<p>a</p>', '<p>a</p>', '<p>a</p>', '<p>a</p>', '<p>a</p>', 'https://mbuh', 'a', 'true');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`id_artikel`);

--
-- Indeks untuk tabel `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id_galeri`);

--
-- Indeks untuk tabel `iklan`
--
ALTER TABLE `iklan`
  ADD PRIMARY KEY (`id_iklan`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `wisata`
--
ALTER TABLE `wisata`
  ADD PRIMARY KEY (`id_wisata`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
