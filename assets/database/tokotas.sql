-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Jun 2024 pada 08.35
-- Versi server: 10.4.6-MariaDB
-- Versi PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tokotas`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `kd_barang` int(11) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `harga_barang` int(100) NOT NULL,
  `stok_barang` int(11) NOT NULL,
  `gambar_barang` varchar(255) NOT NULL,
  `kategori` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`kd_barang`, `nama_barang`, `harga_barang`, `stok_barang`, `gambar_barang`, `kategori`) VALUES
(1, 'Hush Puppies', 559300, 4, 'c8f4e5b59640da3a49183472a6a42aed.png', 'Wanita'),
(2, 'Converse', 459000, 6, '510372fd1920429d373a11ef6770b25a.png', 'Unisex');

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `invoice` varchar(100) NOT NULL,
  `total` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `hp` varchar(255) NOT NULL,
  `status` enum('waiting','paid','delivered','cancel') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`id`, `id_user`, `tanggal`, `invoice`, `total`, `nama`, `alamat`, `hp`, `status`, `created_at`) VALUES
(11, 2, '2024-06-21', '220240621080441', 1118600, 'Zaxmn', 'jalanjalan\r\njalan ajaja\r\n', '08939393939', 'paid', '2024-06-23 11:07:24'),
(13, 8, '2024-06-23', '820240623132905', 1577600, 'fadlur', 'jajajaja', '089459459845', 'paid', '2024-06-23 11:29:05'),
(14, 6, '2024-06-23', '620240623141202', 459000, 'anjay', 'ajajajaj', '094598439546', 'paid', '2024-06-23 12:12:02'),
(15, 12, '2024-06-24', '1220240624164643', 918000, 'asdasd', 'jajajaj', '09845878745', 'delivered', '2024-06-24 14:46:43'),
(19, 13, '2024-06-26', '1320240626053015', 1477300, 'Bahari Jaya Abadi', 'Jl. Bahari Jaya Abadi', '089887766554', 'waiting', '2024-06-26 03:30:15'),
(20, 13, '2024-06-26', '1320240626053357', 1018300, 'Bahari Jaya Abadi', 'Jl. Bahari Jaya Abadi', '089887766554', 'waiting', '2024-06-26 03:33:57');

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders_confirm`
--

CREATE TABLE `orders_confirm` (
  `id` int(11) NOT NULL,
  `id_orders` int(11) NOT NULL,
  `nama_rek` varchar(255) NOT NULL,
  `no_rek` varchar(50) NOT NULL,
  `nominal` int(255) NOT NULL,
  `note` varchar(255) NOT NULL,
  `gambar_bukti` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `orders_confirm`
--

INSERT INTO `orders_confirm` (`id`, `id_orders`, `nama_rek`, `no_rek`, `nominal`, `note`, `gambar_bukti`) VALUES
(2, 11, 'fadlur', '9384983459385', 20000000, 'asdsadsadd', '724169a97877f390e539ca30cd344965.jpg'),
(3, 13, 'fadlur', '9384983459385', 20000000, 'asdasdasd', '62dae8e83d303cef37f0d789697b19fe.png'),
(4, 14, 'anjay', '83837473833', 459000, 'anjay', 'df4ebb8a748d0ac9f3f4b5a5805672e7.png'),
(5, 15, 'fadlur', '08659645', 2000000, 'akjsdkajds', '75dcf94510bda551350b29bc09d5bcd4.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `id_orders` int(11) NOT NULL,
  `kd_barang` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `order_detail`
--

INSERT INTO `order_detail` (`id`, `id_orders`, `kd_barang`, `qty`, `subtotal`) VALUES
(6, 11, 1, 2, 1118600),
(9, 13, 1, 2, 1118600),
(10, 13, 2, 1, 459000),
(11, 14, 2, 1, 459000),
(12, 15, 2, 2, 918000),
(16, 19, 2, 2, 918000),
(17, 19, 1, 1, 559300),
(18, 20, 2, 1, 459000),
(19, 20, 1, 1, 559300);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(25) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','user') DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `profile_image` varchar(255) NOT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `token_expiration` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `email`, `profile_image`, `password_reset_token`, `token_expiration`) VALUES
(2, 'user', 'user123', 'user', '', '', NULL, NULL),
(3, 'seller', 'seller123', 'admin', '', '', NULL, NULL),
(5, 'fadlur', 'fadlur123', 'user', '', '', NULL, NULL),
(6, 'anjay', '$2y$10$QNkaWjOSeLlFSnE8Nlfsj.0fbjC.LRCgpaLcfAWt7NOKTIzBzRU0.', 'user', 'fadlur@gmail.com', 'bbfc279c8ebd1c6603ce715fe82fa0b7.png', NULL, NULL),
(7, 'ari123', '$2y$10$tl7v7F7YxCT6MkP0n6NMGu5L7N1Y3O./sKPhmRpxskOTdSDz37qPK', 'user', 'ari@gmail.com', '60f3a9a203714aba736d2cdd286d77a1.png', NULL, NULL),
(8, 'baru', '$2y$10$i.N2ylfpEPoJQjdlNxb5w.d0zUul3Aciwt5ifhnTwb/7doEEZ1Dem', 'user', 'baru@gmail.com', 'default.png', NULL, NULL),
(9, 'admin', '$2y$10$uj7l7qOtvbiQwDbnxkxkEuN7ZZiR9FYtO.5zcMatA9ERHVqSK0Xu2', 'admin', 'admin@gmail.com', 'c3d7d0764f3d4cd41ed98780fed53ec0.png', NULL, NULL),
(10, 'asd', '$2y$10$zO73B.o3.qWHeqApH8LGM.liwHvE8lXfUmfnWWggz.dhiIn8tt8Ry', 'admin', 'asd@gmail.com', 'default.png', NULL, NULL),
(11, 'Fadlur123', '$2y$10$UoGNIUfmehLkOCRUmlbsiO8cHAC50Z0SI6DX45FUKDHjCJ3FvvtI2', 'user', 'fadlurrahmanfaiq@gmail.com', 'default.png', 'KHic3FB5rqyfVvPRtXGZSbEa4ehwuD6078xJUgLI1OA2dCpNmT', '2024-06-24 17:45:52'),
(12, 'bedoel', '$2y$10$1h9m/97KvruYpLSVt22rN.77WkgvXIX0TudL1t1gjbYxSsvuyfkb.', 'user', 'soiyah1969@gmail.com', 'default.png', NULL, NULL),
(13, 'Bahari', '$2y$10$PCqfGMv8H3yFPsPnf7NGTO5tNt8Y/eFC8/ifV/KGtCYrIVmL322R6', 'user', 'bahari@gmail.com', 'default.png', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kd_barang`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `orders_confirm`
--
ALTER TABLE `orders_confirm`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `kd_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `orders_confirm`
--
ALTER TABLE `orders_confirm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
