-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Apr 2025 pada 05.56
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
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` varchar(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','owner') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `email`, `password`, `role`) VALUES
('AD250409063410', 'admin', 'admin@gmail.com', '$2y$10$H0uCkCyHFDBdne/.RVU05ucN4BipxjrSwEt.JkKixbpc3835/1N3u', 'owner');

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
('AR250410075858', 'Hello world', 'hello-world', 'AR250410075858.png', '<p>a</p>', '2025-04-10', 'false');

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
('GL67f9e1b150c06', 'WS250412054437', 'af5ee8dcf88abcc400d9289a5665281a.png');

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
('IK250410080114', 'IK250410080114.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` varchar(20) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `thumbnail_kategori` varchar(255) NOT NULL,
  `ikon_kategori` varchar(255) NOT NULL,
  `unggulan` enum('true','false') NOT NULL,
  `background_unggulan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `slug`, `thumbnail_kategori`, `ikon_kategori`, `unggulan`, `background_unggulan`) VALUES
('KT250412054413', 'Modern', 'modern', 'dkvpplgfinaldesign_for_blackbg.png', 'dkvpplgfinaldesign_for_blackbg.png', 'true', 'dkvpplgfinaldesign_for_blackbg.png'),
('KT250412055253', 'Budaya', 'budaya', '2.png', '2.png', 'true', '2.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `wisata`
--

CREATE TABLE `wisata` (
  `id_wisata` varchar(20) NOT NULL,
  `kategori` varchar(20) NOT NULL,
  `thumbnail_wisata` varchar(255) NOT NULL,
  `nama_wisata` varchar(50) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `deskripsi_wisata` varchar(255) NOT NULL,
  `jam_buka` text NOT NULL,
  `harga_masuk` text NOT NULL,
  `parkir` text NOT NULL,
  `fasilitas` text NOT NULL,
  `map` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `publish` enum('true','false') NOT NULL,
  `kontak` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `wisata`
--

INSERT INTO `wisata` (`id_wisata`, `kategori`, `thumbnail_wisata`, `nama_wisata`, `slug`, `deskripsi_wisata`, `jam_buka`, `harga_masuk`, `parkir`, `fasilitas`, `map`, `alamat`, `publish`, `kontak`) VALUES
('WS250412054437', 'KT250412054413', 'WS250412054437.png', 'Lorem Ipsum dolor sit amet', 'lorem-ipsum-dolor-sit-amet', '<p>a</p>', '<p>a</p>', '<p>a</p>', '<p>a</p>', '<p>a</p>', 'a', 'a', 'true', '1234567890'),
('WS250412055136', 'KT250412054413', 'WS250412055136.png', 'Lorem Ipsum dolor sit ameta', 'lorem-ipsum-dolor-sit-ameta', '<p>a</p>', '<p>a</p>', '<p>a</p>', '<p>a</p>', '<p>a</p>', 'a', 'a', 'true', '1234567890'),
('WS250412055317', 'KT250412055253', 'WS250412055317.jpeg', 'Lorem Ipsum dolor', 'lorem-ipsum-dolor', '<p>a</p>', '<p>a</p>', '<p>a</p>', '<p>a</p>', '<p>a</p>', 'a', 'a', 'true', '1234567890'),
('WS250412055455', 'KT250412055253', 'WS250412055455.png', 'Lorem Ipsum', 'lorem-ipsum', '<p>a</p>', '<p>a</p>', '<p>a</p>', '<p>a</p>', '<p>a</p>', 'a', 'a', 'true', '1234567890');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

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
