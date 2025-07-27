-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Jul 2024 pada 15.47
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_rawat`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokter`
--

CREATE TABLE `dokter` (
  `id_dokter` varchar(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `spesialis` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `hp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `dokter`
--

INSERT INTO `dokter` (`id_dokter`, `nama`, `spesialis`, `alamat`, `hp`) VALUES
('D1', 'Dokter 1', 'Gigi', 'Jayapura', '081212345678'),
('D2', 'Dokter 2', 'Paru', 'Jogja', '085245671234'),
('D3', 'Winda Louw', 'Umum', 'Jalan Kesehatan', '081123456756'),
('D4', 'Luis', 'KIA', 'Jalan Sekarsuli', '081344324438'),
('D5', 'Agung', 'Mata', 'Jayapura', '082312345678');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pasien`
--

CREATE TABLE `pasien` (
  `id_pasien` varchar(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `umur` int(3) NOT NULL,
  `jenis_kelamin` varchar(25) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `hp` varchar(15) NOT NULL,
  `riwayat_medis` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pasien`
--

INSERT INTO `pasien` (`id_pasien`, `nama`, `umur`, `jenis_kelamin`, `alamat`, `hp`, `riwayat_medis`) VALUES
('P1', 'Paska ', 25, 'Laki-Laki', 'Jogja', '085912347654', 'Tidak Ada'),
('P2', 'Ali', 25, 'Laki-Laki', 'Jogja', '083412347654', 'Tidak Ada'),
('P3', 'Lia', 22, 'Perempuan', 'jalan damai', '082132445423', 'Tidak Ada'),
('P4', 'Rosiska', 23, 'Perempuan', 'Abepura', '0867891052', 'Tidak Ada'),
('P5', 'Dion', 34, 'Laki-Laki', 'Jalan kusumanegara', '08343567854', 'Tidak Ada');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rawat`
--

CREATE TABLE `rawat` (
  `id_rawat` int(11) NOT NULL,
  `id_pasien` varchar(11) DEFAULT NULL,
  `id_dokter` varchar(11) DEFAULT NULL,
  `diagnosis` varchar(100) NOT NULL,
  `obat` varchar(100) NOT NULL,
  `tgl_rawat` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `rawat`
--

INSERT INTO `rawat` (`id_rawat`, `id_pasien`, `id_dokter`, `diagnosis`, `obat`, `tgl_rawat`) VALUES
(5, 'P1', 'D1', 'Infeksi Gigi', 'Amoxicilin', '2024-07-06'),
(6, 'P1', 'D1', 'Glaukoma', 'Timolol (obat tetes mata)', '2023-06-07'),
(7, 'P2', 'D2', 'Asma', 'Salbutamol (inhaler)', '2024-05-06'),
(8, 'P3', 'D3', 'Demam berdarah dengue (DBD)', 'Parasetamol', '2024-01-09'),
(9, 'P4', 'D4', 'Anemia pada kehamilan', 'Suplemen zat besi ,Asam folat', '2024-02-19');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id_dokter`),
  ADD UNIQUE KEY `hp` (`hp`);

--
-- Indeks untuk tabel `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id_pasien`),
  ADD UNIQUE KEY `hp` (`hp`);

--
-- Indeks untuk tabel `rawat`
--
ALTER TABLE `rawat`
  ADD PRIMARY KEY (`id_rawat`),
  ADD KEY `id_pasien` (`id_pasien`),
  ADD KEY `id_dokter` (`id_dokter`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `rawat`
--
ALTER TABLE `rawat`
  MODIFY `id_rawat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `rawat`
--
ALTER TABLE `rawat`
  ADD CONSTRAINT `rawat_ibfk_1` FOREIGN KEY (`id_pasien`) REFERENCES `pasien` (`id_pasien`),
  ADD CONSTRAINT `rawat_ibfk_2` FOREIGN KEY (`id_dokter`) REFERENCES `dokter` (`id_dokter`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
