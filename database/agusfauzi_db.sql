-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 08 Jun 2020 pada 19.21
-- Versi server: 10.1.37-MariaDB
-- Versi PHP: 7.0.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `beligo_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detailtransaksi`
--

CREATE TABLE `detailtransaksi` (
  `kd_pretransaksi` varchar(7) DEFAULT NULL,
  `kd_transaksi` varchar(7) DEFAULT NULL,
  `kd_barang` varchar(11) DEFAULT NULL,
  `jumlah` int(4) DEFAULT NULL,
  `sub_total` int(8) DEFAULT NULL,
  `nama_barang` varchar(40) DEFAULT NULL,
  `harga_barang` int(7) DEFAULT NULL,
  `jumlah_beli` int(4) DEFAULT NULL,
  `total_harga` int(8) DEFAULT NULL,
  `tanggal_beli` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `piutang_dagang`
--

CREATE TABLE `piutang_dagang` (
  `id_pelanggan` int(11) NOT NULL,
  `total_piutang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `piutang_dagang`
--

INSERT INTO `piutang_dagang` (`id_pelanggan`, `total_piutang`) VALUES
(1, 10700);

-- --------------------------------------------------------

--
-- Struktur dari tabel `table_barang`
--

CREATE TABLE `table_barang` (
  `kd_barang` varchar(7) NOT NULL,
  `nama_barang` varchar(40) NOT NULL,
  `kd_merek` varchar(7) NOT NULL,
  `kd_distributor` varchar(7) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `harga_barang` int(7) NOT NULL,
  `stok_barang` int(4) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `keterangan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `table_barang`
--

INSERT INTO `table_barang` (`kd_barang`, `nama_barang`, `kd_merek`, `kd_distributor`, `tanggal_masuk`, `harga_barang`, `stok_barang`, `gambar`, `keterangan`) VALUES
('BR001', 'Nutrisari', 'ME001', 'DS002', '2018-09-24', 1500, 38, '1537785469748.jpg', 'Tersedia'),
('BR002', 'Saus ABC', 'ME002', 'DS002', '2018-09-24', 500, 73, '1537761405396.jpg', 'Tersedia'),
('BR003', 'Indomie Goreng', 'ME003', 'DS002', '2018-09-24', 2500, 65, '1537764343384.jpeg', 'Tersedia'),
('BR004', 'Kecap', 'ME002', 'DS001', '2018-09-24', 500, 0, '1537788240156.png', 'Tersedia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `table_distributor`
--

CREATE TABLE `table_distributor` (
  `kd_distributor` varchar(7) NOT NULL,
  `nama_distributor` varchar(40) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_telp` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `table_distributor`
--

INSERT INTO `table_distributor` (`kd_distributor`, `nama_distributor`, `alamat`, `no_telp`) VALUES
('DS001', 'Cahyono', 'Tajur Bogor', '081288819999'),
('DS002', 'Susanti', 'Bogor', '083812991999');

-- --------------------------------------------------------

--
-- Struktur dari tabel `table_merek`
--

CREATE TABLE `table_merek` (
  `kd_merek` varchar(7) NOT NULL,
  `merek` varchar(30) NOT NULL,
  `foto_merek` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `table_merek`
--

INSERT INTO `table_merek` (`kd_merek`, `merek`, `foto_merek`) VALUES
('ME001', 'Nutrifood', '1537759572977.jpg'),
('ME002', 'ABC', '1537760002906.png'),
('ME003', 'Indofood', '1537761246445.jpg'),
('ME004', 'WEWE', '1539528847974.png'),
('ME005', 'Barrons', '1548945399328.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `table_pelanggan`
--

CREATE TABLE `table_pelanggan` (
  `id_pelanggan` int(100) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_telp` varchar(100) NOT NULL,
  `status` int(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `table_pelanggan`
--

INSERT INTO `table_pelanggan` (`id_pelanggan`, `nama_pelanggan`, `alamat`, `no_telp`, `status`) VALUES
(1, 'Samud Abdullah', 'Jl. Desa Purwawingangun No.41', '08977036016', 1),
(2, 'Udin', 'Karimun jawa', '08977036016', 1),
(3, 'Jana', 'Pramuka', '0833948434', 0),
(4, 'Ratu', 'Pramuka', '08766788765', 1),
(5, 'Rozak', 'Pramuka', '089227389234', 1),
(6, 'Murdiana', 'Jatinangor', '087667886587', 0),
(7, 'kasdiman', 'Jl. Candi Borobudur No.23 Yogyakarta', '0896656876', 0),
(8, 'Jahar', 'Jl. Raya Nasi padang', '0819239445', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `table_pretransaksi`
--

CREATE TABLE `table_pretransaksi` (
  `kd_pretransaksi` varchar(7) NOT NULL,
  `kd_transaksi` varchar(7) NOT NULL,
  `kd_barang` varchar(11) NOT NULL,
  `jumlah` int(4) NOT NULL,
  `sub_total` int(8) NOT NULL,
  `status` int(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `table_pretransaksi`
--

INSERT INTO `table_pretransaksi` (`kd_pretransaksi`, `kd_transaksi`, `kd_barang`, `jumlah`, `sub_total`, `status`) VALUES
('AN001', 'TR001', 'BR001', 2, 3000, 0),
('AN002', 'TR001', 'BR002', 6, 1500, 1),
('AN003', 'TR002', 'BR003', 2, 5000, 0),
('AN004', 'TR002', 'BR002', 2, 1000, 1),
('AN005', 'TR003', 'BR002', 2, 1000, 1),
('AN006', 'TR003', 'BR003', 2, 5000, 1),
('AN007', 'TR004', 'BR001', 9, 10500, 0),
('AN008', 'TR005', 'BR002', 5, 2500, 0),
('AN009', 'TR006', 'BR003', 1, 2500, 1),
('AN010', 'TR007', 'BR001', 1, 1500, 0),
('AN011', 'TR007', 'BR002', 12, 1000, 0);

--
-- Trigger `table_pretransaksi`
--
DELIMITER $$
CREATE TRIGGER `batal_beli` AFTER DELETE ON `table_pretransaksi` FOR EACH ROW UPDATE table_barang SET
stok_barang = stok_barang + OLD.jumlah
WHERE kd_barang = OLD.kd_barang
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `transaksi` AFTER INSERT ON `table_pretransaksi` FOR EACH ROW UPDATE table_barang SET
stok_barang = stok_barang - new.jumlah
WHERE kd_barang = new.kd_barang
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_beli` AFTER UPDATE ON `table_pretransaksi` FOR EACH ROW UPDATE table_barang SET
stok_barang = stok_barang + OLD.jumlah - NEW.jumlah
WHERE kd_barang = new.kd_barang
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `table_transaksi`
--

CREATE TABLE `table_transaksi` (
  `kd_transaksi` varchar(7) NOT NULL,
  `kd_user` varchar(7) NOT NULL,
  `jumlah_beli` int(4) NOT NULL,
  `total_harga` int(8) NOT NULL,
  `tanggal_beli` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `table_transaksi`
--

INSERT INTO `table_transaksi` (`kd_transaksi`, `kd_user`, `jumlah_beli`, `total_harga`, `tanggal_beli`) VALUES
('TR001', 'US003', 8, 4500, '2018-09-25'),
('TR002', 'US003', 4, 6000, '2018-09-25'),
('TR003', 'US003', 4, 6000, '2018-09-30'),
('TR004', 'US003', 9, 10500, '2019-03-16'),
('TR005', 'US003', 5, 2500, '2019-03-16'),
('TR006', 'US003', 1, 2500, '2020-06-06'),
('TR007', 'US003', 13, 2500, '2020-06-08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `table_user`
--

CREATE TABLE `table_user` (
  `kd_user` varchar(7) NOT NULL,
  `nama_user` varchar(20) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `foto_user` varchar(50) NOT NULL,
  `level` enum('Admin','Kasir','Manager') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `table_user`
--

INSERT INTO `table_user` (`kd_user`, `nama_user`, `username`, `password`, `foto_user`, `level`) VALUES
('US001', 'M. Bayu Pradana', 'manager', 'bWFuYWdlcjEyMw==', '1538303665653.png', 'Manager'),
('US002', 'Fajar Subeki', 'admin123', 'YWRtaW4xMjM=', '153777087384.png', 'Admin'),
('US003', 'Dinda Nur Insani', 'kasir123', 'a2FzaXIxMjM=', '1537840377928.png', 'Kasir');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `kd_pretransaksi` varchar(7) DEFAULT NULL,
  `kd_transaksi` varchar(7) DEFAULT NULL,
  `kd_barang` varchar(11) DEFAULT NULL,
  `jumlah` int(4) DEFAULT NULL,
  `sub_total` int(8) DEFAULT NULL,
  `nama_barang` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_terbaru`
--

CREATE TABLE `transaksi_terbaru` (
  `kd_transaksi` varchar(7) DEFAULT NULL,
  `kd_user` varchar(7) DEFAULT NULL,
  `jumlah_beli` int(4) DEFAULT NULL,
  `total_harga` int(8) DEFAULT NULL,
  `tanggal_beli` date DEFAULT NULL,
  `nama_user` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `piutang_dagang`
--
ALTER TABLE `piutang_dagang`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indeks untuk tabel `table_barang`
--
ALTER TABLE `table_barang`
  ADD PRIMARY KEY (`kd_barang`),
  ADD KEY `kd_distributor` (`kd_distributor`),
  ADD KEY `kd_merek` (`kd_merek`);

--
-- Indeks untuk tabel `table_distributor`
--
ALTER TABLE `table_distributor`
  ADD PRIMARY KEY (`kd_distributor`);

--
-- Indeks untuk tabel `table_merek`
--
ALTER TABLE `table_merek`
  ADD PRIMARY KEY (`kd_merek`);

--
-- Indeks untuk tabel `table_pelanggan`
--
ALTER TABLE `table_pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indeks untuk tabel `table_pretransaksi`
--
ALTER TABLE `table_pretransaksi`
  ADD PRIMARY KEY (`kd_pretransaksi`);

--
-- Indeks untuk tabel `table_transaksi`
--
ALTER TABLE `table_transaksi`
  ADD PRIMARY KEY (`kd_transaksi`),
  ADD KEY `kd_user` (`kd_user`);

--
-- Indeks untuk tabel `table_user`
--
ALTER TABLE `table_user`
  ADD PRIMARY KEY (`kd_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `table_pelanggan`
--
ALTER TABLE `table_pelanggan`
  MODIFY `id_pelanggan` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `table_transaksi`
--
ALTER TABLE `table_transaksi`
  ADD CONSTRAINT `table_transaksi_ibfk_1` FOREIGN KEY (`kd_user`) REFERENCES `table_user` (`kd_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
