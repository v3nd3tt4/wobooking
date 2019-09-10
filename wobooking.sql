-- Adminer 4.7.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

CREATE TABLE `tb_file_upload` (
  `id_file_upload` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `nama_file` varchar(255) NOT NULL,
  PRIMARY KEY (`id_file_upload`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `tb_gedung` (
  `id_gedung` int(11) NOT NULL AUTO_INCREMENT,
  `nama_gedung` varchar(255) NOT NULL,
  `no_telp` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  PRIMARY KEY (`id_gedung`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `tb_gedung` (`id_gedung`, `nama_gedung`, `no_telp`, `gambar`, `alamat`) VALUES
(1,	'test aja',	'gsgs aja',	'201909092156091.png',	'test aja\r\n');

CREATE TABLE `tb_paket` (
  `id_paket` int(11) NOT NULL AUTO_INCREMENT,
  `nama_paket` varchar(255) NOT NULL,
  `harga_paket` varchar(255) NOT NULL,
  `tgl_ketersediaan` date NOT NULL,
  `status_paket` varchar(255) NOT NULL,
  `id_gedung` int(11) NOT NULL,
  PRIMARY KEY (`id_paket`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `tb_paket` (`id_paket`, `nama_paket`, `harga_paket`, `tgl_ketersediaan`, `status_paket`, `id_gedung`) VALUES
(1,	'test',	'50000',	'2019-09-09',	'test',	1),
(2,	'test paket 2',	'65000000',	'2019-09-27',	'test',	0),
(3,	'paket 3',	'658484',	'2019-09-20',	'haha',	1);

CREATE TABLE `tb_pesan_gedung` (
  `id_pesan` int(11) NOT NULL AUTO_INCREMENT,
  `id_paket` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `jam_sewa_awal` datetime NOT NULL,
  `jam_sewa_akhir` datetime NOT NULL,
  `tanggal_sewa` date NOT NULL,
  `id_transkasi` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id_pesan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `tb_transaksi` (
  `id_transaksi` int(11) NOT NULL AUTO_INCREMENT,
  `id_pesan_gedung` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_file_upload` int(11) NOT NULL,
  `type_transaksi` varchar(255) NOT NULL,
  `jumlah_bayar` varchar(255) NOT NULL,
  `tanggal_bayar` datetime NOT NULL,
  `status_bayar` varchar(255) NOT NULL,
  PRIMARY KEY (`id_transaksi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(255) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `tb_user` (`id_user`, `nama`, `email`, `no_hp`, `alamat`, `password`, `level`, `jenis_kelamin`) VALUES
(5,	'Okta Pilopa',	'pilopaokta@gmail.com',	'085768551713',	'JL. P. Antasari Sukarame\r\nJL. P. Antasari Sukarame',	'$2y$10$V34zHF2koSVFG.48eV9eVOLgaG2cS7r/mR25RXiBOT01q0vXzZ.Ra',	'admin',	'pria'),
(7,	'Okta Pilopa 2',	'pilopaokta@gmail.com',	'085768551713',	'JL. P. Antasari Sukarame\r\nJL. P. Antasari Sukarame',	'$2y$10$wnDg4RgNROBzEYKaOQHnT.r0EbkzFQ8TyvvdyOXrcTzNtWtrDW0Z.',	'admin',	'pria');

-- 2019-09-10 14:37:25
