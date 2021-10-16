-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2021 at 10:01 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_minyak`
--

-- --------------------------------------------------------

--
-- Table structure for table `alpha`
--

CREATE TABLE `alpha` (
  `id_alpha` int(10) NOT NULL,
  `alpha` decimal(20,1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alpha`
--

INSERT INTO `alpha` (`id_alpha`, `alpha`) VALUES
(1, '0.5');

-- --------------------------------------------------------

--
-- Table structure for table `coba`
--

CREATE TABLE `coba` (
  `hasil` decimal(20,6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coba`
--

INSERT INTO `coba` (`hasil`) VALUES
('60.000000'),
('57.620000'),
('61.490000');

-- --------------------------------------------------------

--
-- Table structure for table `data_minyak`
--

CREATE TABLE `data_minyak` (
  `id_data_minyak` int(10) NOT NULL,
  `tahun` year(4) DEFAULT NULL,
  `bulan` int(10) DEFAULT NULL,
  `jumlah_minyak` decimal(20,3) DEFAULT NULL,
  `t` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_minyak`
--

INSERT INTO `data_minyak` (`id_data_minyak`, `tahun`, `bulan`, `jumlah_minyak`, `t`) VALUES
(1, NULL, NULL, '5.000', 1);

--
-- Triggers `data_minyak`
--
DELIMITER $$
CREATE TRIGGER `ai_data_minyak` AFTER INSERT ON `data_minyak` FOR EACH ROW BEGIN
DECLARE alp decimal(2,2);
DECLARE hitung1_des int(10);
DECLARE hitung1_ses int(10);
DECLARE ses_data_beforedecimal decimal(20,6);
DECLARE ses_hasil_forecast decimal(20,6);
DECLARE ses_at_ft decimal(20,6);
DECLARE ses_abs_at_ft decimal(20,6);
DECLARE ses_at_ft2 decimal(20,6);
DECLARE ses_error decimal(20,6);
DECLARE ses_hasil_forecast_before decimal(20,6);
DECLARE id_minyak_before int(10);
DECLARE id_hitung_ses_before int(10);


DECLARE yaksen decimal(20,6);
DECLARE yaksensen decimal(20,6);
DECLARE a decimal(20,6);
DECLARE b decimal(20,6);
DECLARE hasil_forecast decimal(20,6);
DECLARE at_ft decimal(20,6);
DECLARE abs_at_ft_bagiat decimal(20,6);
DECLARE yaksen_before decimal(20,6);
DECLARE yaksensen_before decimal(20,6);
SELECT alpha INTO alp from alpha;
SELECT COUNT(id_hitung_des) INTO hitung1_des from hitung_des;

SELECT COUNT(id_hitung_ses) INTO hitung1_ses from hitung_ses;
IF hitung1_ses=0 THEN
INSERT INTO hitung_ses VALUES(null,new.id_data_minyak,null,null,null,null,null);


ELSEIF hitung1_ses=1 THEN
SELECT id_data_minyak into id_minyak_before from data_minyak GROUP BY id_data_minyak desc LIMIT 1;
SELECT jumlah_minyak into ses_data_beforedecimal FROM data_minyak where id_data_minyak=id_minyak_before-1;
SET ses_hasil_forecast= alp*ses_data_beforedecimal+(1-alp)*ses_data_beforedecimal;
set ses_at_ft=new.jumlah_minyak-ses_hasil_forecast;
set ses_abs_at_ft=ABS(ses_at_ft/new.jumlah_minyak);
set ses_at_ft2=ses_at_ft*ses_at_ft;
SET ses_error=new.jumlah_minyak-ses_hasil_forecast;
INSERT INTO hitung_ses VALUES(null,new.id_data_minyak,ses_hasil_forecast,ses_at_ft,ses_abs_at_ft,ses_at_ft2,ses_error);

ELSE
SELECT id_data_minyak into id_minyak_before from data_minyak GROUP BY id_data_minyak desc LIMIT 1;
SELECT jumlah_minyak into ses_data_beforedecimal FROM data_minyak where id_data_minyak=id_minyak_before-1;

SELECT y_aksen_ses into ses_hasil_forecast_before FROM hitung_ses GROUP by id_hitung_ses desc LIMIT 1;

SET ses_hasil_forecast= alp*ses_data_beforedecimal+(1-alp)*ses_hasil_forecast_before;
set ses_at_ft=new.jumlah_minyak-ses_hasil_forecast;
set ses_abs_at_ft=ABS(ses_at_ft/new.jumlah_minyak);
set ses_at_ft2=ses_at_ft*ses_at_ft;
SET ses_error=new.jumlah_minyak-ses_hasil_forecast;
INSERT INTO hitung_ses VALUES(null,new.id_data_minyak,ses_hasil_forecast,ses_at_ft,ses_abs_at_ft,ses_at_ft2,ses_error);
end if;

IF hitung1_des=0 THEN
INSERT INTO hitung_des VALUES(null,new.id_data_minyak,new.jumlah_minyak,new.jumlah_minyak,new.jumlah_minyak,null,null,null,null);

ELSE 
SELECT y_aksen_des into yaksen_before FROM data_minyak NATURAL JOIN hitung_des GROUP BY id_data_minyak DESC LIMIT 1;
SELECT y_dbl_aksen_des into yaksensen_before FROM data_minyak NATURAL JOIN hitung_des GROUP BY id_data_minyak DESC LIMIT 1;

#menghitung y aksen
set yaksen=alp*new.jumlah_minyak+(1-alp)*yaksen_before;
set yaksensen=alp*yaksen+(1-alp)*yaksensen_before;
set a=2*yaksen-yaksensen;
set b=alp/(1-alp)*(yaksen-yaksensen);
set hasil_forecast=a+b;
set at_ft=new.jumlah_minyak-hasil_forecast;
set abs_at_ft_bagiat=ABS(at_ft/new.jumlah_minyak);
INSERT into hitung_des VALUES(null,new.id_data_minyak,yaksen,yaksensen,a,b,hasil_forecast,at_ft,abs_at_ft_bagiat);
end if;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `bi_data_minyak` BEFORE INSERT ON `data_minyak` FOR EACH ROW BEGIN
DECLARE id_sebelumnya int(10);
DECLARE COUNT_id int(10);
SELECT id_data_minyak into id_sebelumnya from data_minyak GROUP by id_data_minyak DESC LIMIT 1;
SELECT COUNT(id_data_minyak) INTO COUNT_id from data_minyak;
if COUNT_id=0 THEN
set new.id_data_minyak=1;
set new.t=1;
ELSE
set new.id_data_minyak=id_sebelumnya+1;
set new.t=id_sebelumnya+1;
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `hitung_des`
--

CREATE TABLE `hitung_des` (
  `id_hitung_des` int(10) NOT NULL,
  `id_data_minyak` int(10) DEFAULT NULL,
  `y_aksen_des` double(50,3) DEFAULT NULL,
  `y_dbl_aksen_des` double(50,3) DEFAULT NULL,
  `a_des` double(50,3) DEFAULT NULL,
  `b_des` double(50,3) DEFAULT NULL,
  `hasil_forecast_des` double(50,3) DEFAULT NULL,
  `at_ft_des` double(50,3) DEFAULT NULL,
  `abs_at_ft_bagiat_des` double(50,3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hitung_des`
--

INSERT INTO `hitung_des` (`id_hitung_des`, `id_data_minyak`, `y_aksen_des`, `y_dbl_aksen_des`, `a_des`, `b_des`, `hasil_forecast_des`, `at_ft_des`, `abs_at_ft_bagiat_des`) VALUES
(1, 1, 5.000, 5.000, 5.000, NULL, NULL, NULL, NULL);

--
-- Triggers `hitung_des`
--
DELIMITER $$
CREATE TRIGGER `bi_hitung_des` BEFORE INSERT ON `hitung_des` FOR EACH ROW BEGIN
DECLARE id_sebelumnya int(10);
DECLARE COUNT_id int(10);
SELECT id_hitung_des into id_sebelumnya from hitung_des GROUP by id_hitung_des DESC LIMIT 1;
SELECT COUNT(id_hitung_des) INTO COUNT_id from hitung_des;
if COUNT_id=0 THEN
set new.id_hitung_des=1;
ELSE
set new.id_hitung_des=id_sebelumnya+1;
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `hitung_ses`
--

CREATE TABLE `hitung_ses` (
  `id_hitung_ses` int(10) NOT NULL,
  `id_data_minyak` int(10) DEFAULT NULL,
  `y_aksen_ses` decimal(20,3) DEFAULT NULL,
  `at_ft_ses` decimal(20,3) DEFAULT NULL,
  `abs_at_ft_ses` decimal(20,3) DEFAULT NULL,
  `at_ft2_ses` decimal(20,3) DEFAULT NULL,
  `error_ses` decimal(20,3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hitung_ses`
--

INSERT INTO `hitung_ses` (`id_hitung_ses`, `id_data_minyak`, `y_aksen_ses`, `at_ft_ses`, `abs_at_ft_ses`, `at_ft2_ses`, `error_ses`) VALUES
(1, 1, NULL, NULL, NULL, NULL, NULL);

--
-- Triggers `hitung_ses`
--
DELIMITER $$
CREATE TRIGGER `bi_hitung_ses` BEFORE INSERT ON `hitung_ses` FOR EACH ROW BEGIN
DECLARE id_sebelumnya int(10);
DECLARE COUNT_id int(10);
SELECT id_hitung_ses into id_sebelumnya from hitung_ses GROUP by id_hitung_ses DESC LIMIT 1;
SELECT COUNT(id_hitung_ses) INTO COUNT_id from hitung_ses;
if COUNT_id=0 THEN
set new.id_hitung_ses=1;
ELSE
set new.id_hitung_ses=id_sebelumnya+1;
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `m_user`
--

CREATE TABLE `m_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(128) DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_user`
--

INSERT INTO `m_user` (`id_user`, `username`, `password`) VALUES
(10, 'admin', '$2y$10$xyJzbC4Q8FMkI/8ivcCD0er5SBKlua3wU5qHaBkC.A55dj7qdbkYe'),
(11, 'user', '$2y$10$YaWZTCrispj1byY5VWzI3.Bzw.Hbxvz.SbbcXs9zt.XABmTqjjd36');

-- --------------------------------------------------------

--
-- Table structure for table `ramal_des`
--

CREATE TABLE `ramal_des` (
  `id_ramal_des` int(10) NOT NULL,
  `bulan_des` int(10) DEFAULT NULL,
  `tahun_des` year(4) DEFAULT NULL,
  `jumlah_minyak_des` decimal(20,3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ramal_des`
--

INSERT INTO `ramal_des` (`id_ramal_des`, `bulan_des`, `tahun_des`, `jumlah_minyak_des`) VALUES
(279, 1, 2017, '51.580'),
(280, 2, 2017, '53.668'),
(281, 3, 2017, '55.756'),
(282, 4, 2017, '57.844'),
(283, 5, 2017, '59.932'),
(284, 6, 2017, '62.020'),
(285, 7, 2017, '64.108'),
(286, 8, 2017, '66.196'),
(287, 9, 2017, '68.284'),
(288, 10, 2017, '70.372'),
(289, 11, 2017, '72.460'),
(290, 12, 2017, '74.548');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alpha`
--
ALTER TABLE `alpha`
  ADD PRIMARY KEY (`id_alpha`);

--
-- Indexes for table `data_minyak`
--
ALTER TABLE `data_minyak`
  ADD PRIMARY KEY (`id_data_minyak`);

--
-- Indexes for table `hitung_des`
--
ALTER TABLE `hitung_des`
  ADD PRIMARY KEY (`id_hitung_des`),
  ADD KEY `id_data_air` (`id_data_minyak`);

--
-- Indexes for table `hitung_ses`
--
ALTER TABLE `hitung_ses`
  ADD PRIMARY KEY (`id_hitung_ses`),
  ADD KEY `id_data_minyak` (`id_data_minyak`);

--
-- Indexes for table `m_user`
--
ALTER TABLE `m_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `ramal_des`
--
ALTER TABLE `ramal_des`
  ADD PRIMARY KEY (`id_ramal_des`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alpha`
--
ALTER TABLE `alpha`
  MODIFY `id_alpha` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `m_user`
--
ALTER TABLE `m_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `ramal_des`
--
ALTER TABLE `ramal_des`
  MODIFY `id_ramal_des` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=291;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hitung_des`
--
ALTER TABLE `hitung_des`
  ADD CONSTRAINT `hitung_des_ibfk_1` FOREIGN KEY (`id_data_minyak`) REFERENCES `data_minyak` (`id_data_minyak`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hitung_ses`
--
ALTER TABLE `hitung_ses`
  ADD CONSTRAINT `hitung_ses_ibfk_1` FOREIGN KEY (`id_data_minyak`) REFERENCES `data_minyak` (`id_data_minyak`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
