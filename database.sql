-- Database dump for starter project
CREATE DATABASE IF NOT EXISTS `db_keuangan` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `db_keuangan`;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `users` (`username`, `password`, `name`) VALUES
('admin', '$2y$10$Tc6jh6zpFgx3vsg3FVfrdO9xeJkBrOvDiqq.Wj/AcXfx1yLnhvSga', 'Administrator');

DROP TABLE IF EXISTS `transaksi`;
CREATE TABLE `transaksi` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `jenis` enum('masuk','keluar') NOT NULL
  `nominal` decimal(15,2) NOT NULL DEFAULT '0.00',
  `keterangan` text,
  PRIMARY KEY (`id`)
) ENGINE=I nnoDB DEFAULT CHARSET=utf8mb4;

-- Sample data
INSERT INTO `transaksi` (`tanggal`, `jenis`, `nominal`, `keterangan`) VALUES
('2025-07-01','masuk',1000000,'Setoran awal'),
('2025-07-05','keluar',250000,'Beli ATK'),
('2025-07-10','masuk',500000,'Pendapatan jasa');
