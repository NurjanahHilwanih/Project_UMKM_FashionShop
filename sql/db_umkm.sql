-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Jul 2022 pada 08.56
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_umkm`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis`
--

CREATE TABLE `jenis` (
  `id_jenis` int(11) NOT NULL,
  `nama_jenis` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jenis`
--

INSERT INTO `jenis` (`id_jenis`, `nama_jenis`) VALUES
(11, 'Baju Gamis Wanita'),
(12, 'Baju Koko Pria'),
(13, 'Baju Gamis Anak'),
(14, 'Baju Koko Anak'),
(15, 'Baju Piyama'),
(16, 'Celana Height waist'),
(17, 'Hijab Inner'),
(18, 'Outer'),
(19, 'Sepatu Sendal'),
(20, 'Height Heals');

-- --------------------------------------------------------

--
-- Struktur dari tabel `konsumen`
--

CREATE TABLE `konsumen` (
  `id_konsumen` int(11) NOT NULL,
  `nama_konsumen` varchar(20) NOT NULL,
  `alamat_konsumen` varchar(100) NOT NULL,
  `no_tlp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `konsumen`
--

INSERT INTO `konsumen` (`id_konsumen`, `nama_konsumen`, `alamat_konsumen`, `no_tlp`) VALUES
(1, 'Sahrul', 'Depok', '081319210953'),
(3, 'Laila', 'Jl.Saun Rt02/05, Krukut, Limo - Depok', '089652610956');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `produk_id` int(11) NOT NULL DEFAULT 0,
  `supplier_id` int(11) NOT NULL DEFAULT 0,
  `jumlah` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `harga` double(20,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `tanggal`, `produk_id`, `supplier_id`, `jumlah`, `user_id`, `harga`) VALUES
(1, '2022-07-07', 3, 3, 5, 1, NULL),
(2, '2022-07-07', 3, 3, 6, 1, NULL),
(3, '2022-07-07', 6, 3, 5, 1, NULL),
(4, '2022-07-07', 6, 1, 9, 1, NULL),
(5, '2022-07-08', 8, 3, 5, 1, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id_pemesanan` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `produk_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pemesanan`
--

INSERT INTO `pemesanan` (`id_pemesanan`, `tanggal`, `jumlah`, `user_id`, `produk_id`) VALUES
(1, '2022-06-01', 10, 1, 1),
(2, '2022-07-08', 3, 14, 6),
(3, '2022-07-08', 7, 14, 9),
(4, '2022-07-08', 8, 16, 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama` varchar(45) NOT NULL DEFAULT '',
  `stok` int(11) NOT NULL,
  `harga_beli` double(20,2) DEFAULT NULL,
  `harga_jual` double(20,2) DEFAULT NULL,
  `foto` text DEFAULT NULL,
  `jenis_id` int(11) NOT NULL,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `nama`, `stok`, `harga_beli`, `harga_jual`, `foto`, `jenis_id`, `deskripsi`) VALUES
(8, 'Outre Scraf', 20, 50000.00, 70000.00, '189f7ae9c4c5ce34ea771e0b48c5850c.jpg', 18, 'Size : All size fit to xxl'),
(9, 'Celana Height Watst', 5, 50000.00, 75000.00, 'a13beb25dca2e7d8ba23e3a90fd8fd80.jpg', 16, 'Size : All Size'),
(10, 'Hijab Inner Alawiyah', 25, 25000.00, 30000.00, 'fc21f400d126361574c03dbfd9183a8d.jpg', 17, 'Detail Bahan : adem');

-- --------------------------------------------------------

--
-- Struktur dari tabel `satuan`
--

CREATE TABLE `satuan` (
  `id_satuan` int(11) NOT NULL,
  `nama_satuan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `satuan`
--

INSERT INTO `satuan` (`id_satuan`, `nama_satuan`) VALUES
(9, 'Lusin'),
(10, 'Item');

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(11) NOT NULL,
  `nama` varchar(45) NOT NULL DEFAULT '',
  `kota` varchar(45) NOT NULL DEFAULT '',
  `no_tlp` char(14) NOT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `kontak` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama`, `kota`, `no_tlp`, `alamat`, `kontak`) VALUES
(1, 'Sahrul', 'Depok', '088888888', 'Jalan jalan aja dah', 'muhamadsahrul256@gmail.com'),
(3, 'Laila Amanda Fitria', 'Depok', '089652610956', 'Jl. Saun Rt 02/05, Krukut, Limo - Depok', 'laila@gmail.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `foto` text NOT NULL,
  `role` varchar(20) DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `email`, `no_telp`, `password`, `created_at`, `foto`, `role`, `status`, `last_login`) VALUES
(1, 'Adminisitrator', 'admin', 'admin@admin.com', '0855666677777', '$2y$10$wMgi9s3FEDEPEU6dEmbp8eAAEBUXIXUy3np3ND2Oih.MOY.q/Kpoy', '2020-06-06 12:07:50', '100a99c52257f3f16c1a04bbe6623496.png', 'admin', NULL, '2022-06-29 11:57:57'),
(14, 'admin', 'Admin2', 'admin@email.com', '08996666', '$2y$10$wMgi9s3FEDEPEU6dEmbp8eAAEBUXIXUy3np3ND2Oih.MOY.q/Kpoy', '0000-00-00 00:00:00', 'user.png', 'user', NULL, '2022-06-29 11:58:00'),
(15, 'Nurjanah Hilwanih', 'Nurjanah23', 'nurjana23@gmail.com', '089652789364', '$2y$10$LWAGW0tXIpGmXFmUIJDgROtuQ.l4NRbmdsblgMAO1WOnhODzypqfO', '0000-00-00 00:00:00', 'foto.png', 'admin', NULL, NULL),
(16, 'Ena Nuralizah', 'Enanuralizah90', 'halizahena90@gmail.com', '089562435791', '$2y$10$lzjDe8jpjM4uZOfhGt/Jl..Xd7SLiALAH9yAeOMWUoWk0F7bSnRoC', '0000-00-00 00:00:00', 'foto.png', 'user', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indeks untuk tabel `konsumen`
--
ALTER TABLE `konsumen`
  ADD PRIMARY KEY (`id_konsumen`);

--
-- Indeks untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indeks untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id_pemesanan`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `barang_ibfk_1` (`jenis_id`);

--
-- Indeks untuk tabel `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`id_satuan`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `jenis`
--
ALTER TABLE `jenis`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `konsumen`
--
ALTER TABLE `konsumen`
  MODIFY `id_konsumen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id_pemesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`jenis_id`) REFERENCES `jenis` (`id_jenis`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
