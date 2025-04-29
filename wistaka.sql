-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Apr 2025 pada 05.44
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

-- --------------------------------------------------------

--
-- Struktur dari tabel `event`
--

CREATE TABLE `event` (
  `id_event` varchar(20) NOT NULL,
  `nama_event` varchar(50) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `thumbnail_event` varchar(255) NOT NULL,
  `waktu_mulai` date NOT NULL,
  `waktu_selesai` date NOT NULL,
  `teks` text NOT NULL,
  `publish` enum('false','true') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `event`
--

INSERT INTO `event` (`id_event`, `nama_event`, `slug`, `thumbnail_event`, `waktu_mulai`, `waktu_selesai`, `teks`, `publish`) VALUES
('AR250429053422', 'nama event', 'nama-event', 'AR250429053422.png', '2025-04-28', '2025-05-01', 'a', 'false'),
('AR250429053517', 'nama event', 'nama-event', 'AR250429053517.png', '2025-04-28', '2025-05-01', '<p>a</p>', 'false');

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
('6810475e68f7a', 'WS250429052830', 'aa6294976739aa2d8c079c0185b44f82.png'),
('68104ab624763', 'WS250429054246', '49d0d252e13ceaff22dbab53dacfe205.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `iklan`
--

CREATE TABLE `iklan` (
  `id_iklan` varchar(20) NOT NULL,
  `iklan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
('KT250429052807', 'Modern', 'modern', 'selesai.png', 'selesai.png', 'false', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` varchar(20) NOT NULL,
  `login_oauth_uid` varchar(100) NOT NULL,
  `first_name` varchar(250) NOT NULL,
  `last_name` varchar(250) DEFAULT NULL,
  `email_address` varchar(250) NOT NULL,
  `profile_picture` varchar(250) NOT NULL,
  `created_at` datetime NOT NULL,
  `update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `login_oauth_uid`, `first_name`, `last_name`, `email_address`, `profile_picture`, `created_at`, `update_at`) VALUES
('US250423060344', '114800119881998925405', 'Faazamu', 'Barok', 'ahmadfaazamubaarok26@gmail.com', 'https://lh3.googleusercontent.com/a/ACg8ocLAoEW7adX4Kj6usdtTDC1_gOTIqE1m4U-qWtECqVKyvJ7xkP5x=s96-c', '2025-04-23 06:03:44', '2025-04-28 04:44:50'),
('US250428042551', '117796192336657668878', 'faazamuartwork', NULL, 'faazamuartwork@gmail.com', 'https://lh3.googleusercontent.com/a/ACg8ocJDXM2mOTcW6XcXwLcIfgElTXsIpgTfbar-JK5SCHdZOeb1=s96-c', '2025-04-28 04:25:51', '2025-04-29 05:42:13'),
('US250429045723', '110452005866958359241', 'Wistaka', NULL, 'wistakatrip@gmail.com', 'https://lh3.googleusercontent.com/a/ACg8ocLj439XwxkIt8RpwohPHRyIGIJf5sxfg9AJDtKJLZNw2kS-Xw=s96-c', '2025-04-29 04:57:23', '2025-04-29 05:41:52');

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
('WS250429052830', 'KT250429052807', 'WS250429052830.png', 'Nama Wisata', '', '<p>a</p>', '<p>a</p>', '<p>a</p>', '<p>a</p>', '<p>a</p>', 'a', 'a', 'false', 'faazamuartwork@gmail.com'),
('WS250429053455', 'KT250429052807', 'WS250429053455.png', 'Nama Wisata', 'nama-wisata', '<p>a</p>', '<p>a</p>', '<p>a</p>', '<p>a</p>', '<p>a</p>', 'a', 'a', 'true', '085869026062'),
('WS250429054246', 'KT250429052807', 'WS250429054246.png', 'Nama Wisata', '', '<p>a</p>', '<p>a</p>', '<p>a</p>', '<p>a</p>', '<p>a</p>', 'a', 'a', 'false', 'faazamuartwork@gmail.com');

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
-- Indeks untuk tabel `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id_event`);

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
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `wisata`
--
ALTER TABLE `wisata`
  ADD PRIMARY KEY (`id_wisata`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
