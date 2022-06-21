-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2022 at 03:42 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_stok`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('fl0tfjl3h38kt3hdaasgiaadk2ff3og8', '::1', 1655500822, 0x5f5f63695f6c6173745f726567656e65726174657c693a313635353530303832323b5573657249447c733a313a2231223b557365727c733a31333a2241646d696e6973747261746f72223b6c6576656c7c733a353a2261646d696e223b666f746f7c733a31383a22666f746f313539363031373834372e706e67223b),
('ui0dbn12jb79l03frbt2j492kaql8ie4', '::1', 1655501147, 0x5f5f63695f6c6173745f726567656e65726174657c693a313635353530313134373b5573657249447c733a313a2231223b557365727c733a31333a2241646d696e6973747261746f72223b6c6576656c7c733a353a2261646d696e223b666f746f7c733a31383a22666f746f313539363031373834372e706e67223b),
('4ghv90fumdunqd10e3irq9lt80of5u24', '::1', 1655501469, 0x5f5f63695f6c6173745f726567656e65726174657c693a313635353530313436393b5573657249447c733a313a2231223b557365727c733a31333a2241646d696e6973747261746f72223b6c6576656c7c733a353a2261646d696e223b666f746f7c733a31383a22666f746f313539363031373834372e706e67223b),
('al93h7uivsqegpemn9hgtf7rv201dr0a', '::1', 1655501858, 0x5f5f63695f6c6173745f726567656e65726174657c693a313635353530313835383b5573657249447c733a313a2231223b557365727c733a31333a2241646d696e6973747261746f72223b6c6576656c7c733a353a2261646d696e223b666f746f7c733a31383a22666f746f313539363031373834372e706e67223b),
('a61rspfnj1fkafllmbmki5pv3on788f7', '::1', 1655502209, 0x5f5f63695f6c6173745f726567656e65726174657c693a313635353530323230393b5573657249447c733a313a2231223b557365727c733a31333a2241646d696e6973747261746f72223b6c6576656c7c733a353a2261646d696e223b666f746f7c733a31383a22666f746f313539363031373834372e706e67223b),
('4son33t6rq0571q45u50o77riu8u8krp', '::1', 1655502516, 0x5f5f63695f6c6173745f726567656e65726174657c693a313635353530323531363b5573657249447c733a313a2231223b557365727c733a31333a2241646d696e6973747261746f72223b6c6576656c7c733a353a2261646d696e223b666f746f7c733a31383a22666f746f313539363031373834372e706e67223b),
('kqavtmm3qg5qjdaa9fph52m6ujtn916c', '::1', 1655502843, 0x5f5f63695f6c6173745f726567656e65726174657c693a313635353530323834333b5573657249447c733a313a2231223b557365727c733a31333a2241646d696e6973747261746f72223b6c6576656c7c733a353a2261646d696e223b666f746f7c733a31383a22666f746f313539363031373834372e706e67223b),
('9d3edteeb17stksdnqjvqo3513k0gjea', '::1', 1655503195, 0x5f5f63695f6c6173745f726567656e65726174657c693a313635353530333139353b5573657249447c733a313a2231223b557365727c733a31333a2241646d696e6973747261746f72223b6c6576656c7c733a353a2261646d696e223b666f746f7c733a31383a22666f746f313539363031373834372e706e67223b),
('6n20c8le0mjkcnc0lhr92iuh09ft3kt7', '::1', 1655503605, 0x5f5f63695f6c6173745f726567656e65726174657c693a313635353530333630353b5573657249447c733a313a2231223b557365727c733a31333a2241646d696e6973747261746f72223b6c6576656c7c733a353a2261646d696e223b666f746f7c733a31383a22666f746f313539363031373834372e706e67223b636172745f636f6e74656e74737c613a333a7b733a31303a22636172745f746f74616c223b643a31323334353b733a31313a22746f74616c5f6974656d73223b643a313b733a33323a223035366530613336336337343936396133363333393765396466613830333262223b613a373a7b733a323a226964223b733a373a2238323933383334223b733a333a22717479223b643a313b733a353a227072696365223b643a31323334353b733a393a2269645f636162616e67223b733a303a22223b733a343a226e616d65223b733a393a226f6b6f6b6f6b6f3131223b733a353a22726f776964223b733a33323a223035366530613336336337343936396133363333393765396466613830333262223b733a383a22737562746f74616c223b643a31323334353b7d7d),
('oqanca96d9epa334bevhmcfuulk7sfko', '::1', 1655503933, 0x5f5f63695f6c6173745f726567656e65726174657c693a313635353530333933333b5573657249447c733a313a2231223b557365727c733a31333a2241646d696e6973747261746f72223b6c6576656c7c733a353a2261646d696e223b666f746f7c733a31383a22666f746f313539363031373834372e706e67223b636172745f636f6e74656e74737c613a333a7b733a31303a22636172745f746f74616c223b643a31323334353b733a31313a22746f74616c5f6974656d73223b643a313b733a33323a223035366530613336336337343936396133363333393765396466613830333262223b613a373a7b733a323a226964223b733a373a2238323933383334223b733a333a22717479223b643a313b733a353a227072696365223b643a31323334353b733a393a2269645f636162616e67223b733a313a2231223b733a343a226e616d65223b733a393a226f6b6f6b6f6b6f3131223b733a353a22726f776964223b733a33323a223035366530613336336337343936396133363333393765396466613830333262223b733a383a22737562746f74616c223b643a31323334353b7d7d),
('9nq8h4ovs7rf20ubm7q69dgaapri3hgp', '::1', 1655504261, 0x5f5f63695f6c6173745f726567656e65726174657c693a313635353530343236313b5573657249447c733a313a2231223b557365727c733a31333a2241646d696e6973747261746f72223b6c6576656c7c733a353a2261646d696e223b666f746f7c733a31383a22666f746f313539363031373834372e706e67223b636172745f636f6e74656e74737c613a333a7b733a31303a22636172745f746f74616c223b643a31323334353b733a31313a22746f74616c5f6974656d73223b643a313b733a33323a223035366530613336336337343936396133363333393765396466613830333262223b613a373a7b733a323a226964223b733a373a2238323933383334223b733a333a22717479223b643a313b733a353a227072696365223b643a31323334353b733a393a2269645f636162616e67223b733a313a2233223b733a343a226e616d65223b733a393a226f6b6f6b6f6b6f3131223b733a353a22726f776964223b733a33323a223035366530613336336337343936396133363333393765396466613830333262223b733a383a22737562746f74616c223b643a31323334353b7d7d),
('nqo1o9svd3e10hkjs8g6c7eaq7hidbc9', '::1', 1655505164, 0x5f5f63695f6c6173745f726567656e65726174657c693a313635353530353136343b5573657249447c733a313a2231223b557365727c733a31333a2241646d696e6973747261746f72223b6c6576656c7c733a353a2261646d696e223b666f746f7c733a31383a22666f746f313539363031373834372e706e67223b636172745f636f6e74656e74737c613a333a7b733a31303a22636172745f746f74616c223b643a31323334353b733a31313a22746f74616c5f6974656d73223b643a313b733a33323a223035366530613336336337343936396133363333393765396466613830333262223b613a373a7b733a323a226964223b733a373a2238323933383334223b733a333a22717479223b643a313b733a353a227072696365223b643a31323334353b733a393a2269645f636162616e67223b733a313a2232223b733a343a226e616d65223b733a393a226f6b6f6b6f6b6f3131223b733a353a22726f776964223b733a33323a223035366530613336336337343936396133363333393765396466613830333262223b733a383a22737562746f74616c223b643a31323334353b7d7d),
('s3o3m41ctvb0bpvig332ng0gl8jkfa0h', '::1', 1655505614, 0x5f5f63695f6c6173745f726567656e65726174657c693a313635353530353631343b5573657249447c733a313a2231223b557365727c733a31333a2241646d696e6973747261746f72223b6c6576656c7c733a353a2261646d696e223b666f746f7c733a31383a22666f746f313539363031373834372e706e67223b636172745f636f6e74656e74737c613a333a7b733a31303a22636172745f746f74616c223b643a31323334353b733a31313a22746f74616c5f6974656d73223b643a313b733a33323a223035366530613336336337343936396133363333393765396466613830333262223b613a373a7b733a323a226964223b733a373a2238323933383334223b733a333a22717479223b643a313b733a353a227072696365223b643a31323334353b733a393a2269645f636162616e67223b733a313a2232223b733a343a226e616d65223b733a393a226f6b6f6b6f6b6f3131223b733a353a22726f776964223b733a33323a223035366530613336336337343936396133363333393765396466613830333262223b733a383a22737562746f74616c223b643a31323334353b7d7d),
('gvds8os90m3et2p6t1s2mf7ltsknrmc3', '::1', 1655506091, 0x5f5f63695f6c6173745f726567656e65726174657c693a313635353530363039313b5573657249447c733a313a2231223b557365727c733a31333a2241646d696e6973747261746f72223b6c6576656c7c733a353a2261646d696e223b666f746f7c733a31383a22666f746f313539363031373834372e706e67223b636172745f636f6e74656e74737c613a333a7b733a31303a22636172745f746f74616c223b643a31323334353b733a31313a22746f74616c5f6974656d73223b643a313b733a33323a223035366530613336336337343936396133363333393765396466613830333262223b613a373a7b733a323a226964223b733a373a2238323933383334223b733a333a22717479223b643a313b733a353a227072696365223b643a31323334353b733a393a2269645f636162616e67223b733a313a2232223b733a343a226e616d65223b733a393a226f6b6f6b6f6b6f3131223b733a353a22726f776964223b733a33323a223035366530613336336337343936396133363333393765396466613830333262223b733a383a22737562746f74616c223b643a31323334353b7d7d),
('gpkd55n0kjni75h0ilfcvlcg448p59sq', '::1', 1655506630, 0x5f5f63695f6c6173745f726567656e65726174657c693a313635353530363633303b5573657249447c733a313a2231223b557365727c733a31333a2241646d696e6973747261746f72223b6c6576656c7c733a353a2261646d696e223b666f746f7c733a31383a22666f746f313539363031373834372e706e67223b),
('i1itt8iukpi1b34eggr9t6m1bksft1pq', '::1', 1655506980, 0x5f5f63695f6c6173745f726567656e65726174657c693a313635353530363938303b5573657249447c733a313a2231223b557365727c733a31333a2241646d696e6973747261746f72223b6c6576656c7c733a353a2261646d696e223b666f746f7c733a31383a22666f746f313539363031373834372e706e67223b),
('3ul6jkofb7ve2gu9h3217srojmigb7jm', '::1', 1655507385, 0x5f5f63695f6c6173745f726567656e65726174657c693a313635353530373338353b5573657249447c733a313a2231223b557365727c733a31333a2241646d696e6973747261746f72223b6c6576656c7c733a353a2261646d696e223b666f746f7c733a31383a22666f746f313539363031373834372e706e67223b636172745f636f6e74656e74737c613a333a7b733a31303a22636172745f746f74616c223b643a31323334353b733a31313a22746f74616c5f6974656d73223b643a313b733a33323a223035366530613336336337343936396133363333393765396466613830333262223b613a373a7b733a323a226964223b733a373a2238323933383334223b733a333a22717479223b643a313b733a353a227072696365223b643a31323334353b733a393a2269645f636162616e67223b733a313a2232223b733a343a226e616d65223b733a393a226f6b6f6b6f6b6f3131223b733a353a22726f776964223b733a33323a223035366530613336336337343936396133363333393765396466613830333262223b733a383a22737562746f74616c223b643a31323334353b7d7d),
('37kslqjvvjdu6ad1mmu0kh7vkud21apg', '::1', 1655507445, 0x5f5f63695f6c6173745f726567656e65726174657c693a313635353530373338353b5573657249447c733a313a2231223b557365727c733a31333a2241646d696e6973747261746f72223b6c6576656c7c733a353a2261646d696e223b666f746f7c733a31383a22666f746f313539363031373834372e706e67223b636172745f636f6e74656e74737c613a333a7b733a31303a22636172745f746f74616c223b643a313030303b733a31313a22746f74616c5f6974656d73223b643a313b733a33323a226236663636666234356266616561333465383232303761353364363463316337223b613a373a7b733a323a226964223b733a373a2238323933383335223b733a333a22717479223b643a313b733a353a227072696365223b643a313030303b733a393a2269645f636162616e67223b733a313a2231223b733a343a226e616d65223b733a343a2268616c6f223b733a353a22726f776964223b733a33323a226236663636666234356266616561333465383232303761353364363463316337223b733a383a22737562746f74616c223b643a313030303b7d7d),
('a13p4vk116vtg3d70p0ct4ug2lkcgcks', '::1', 1655748190, 0x5f5f63695f6c6173745f726567656e65726174657c693a313635353734383139303b5573657249447c733a313a2231223b557365727c733a31333a2241646d696e6973747261746f72223b6c6576656c7c733a353a2261646d696e223b666f746f7c733a31383a22666f746f313539363031373834372e706e67223b),
('dhbkhr52nsi37fbrsh17di4o6ulev0em', '::1', 1655748498, 0x5f5f63695f6c6173745f726567656e65726174657c693a313635353734383439383b5573657249447c733a313a2231223b557365727c733a31333a2241646d696e6973747261746f72223b6c6576656c7c733a353a2261646d696e223b666f746f7c733a31383a22666f746f313539363031373834372e706e67223b),
('g7fdm5e8bf39fgaemjh6ia2o5ostqqmd', '::1', 1655748812, 0x5f5f63695f6c6173745f726567656e65726174657c693a313635353734383831323b5573657249447c733a313a2231223b557365727c733a31333a2241646d696e6973747261746f72223b6c6576656c7c733a353a2261646d696e223b666f746f7c733a31383a22666f746f313539363031373834372e706e67223b636172745f636f6e74656e74737c613a333a7b733a31303a22636172745f746f74616c223b643a313030303b733a31313a22746f74616c5f6974656d73223b643a313b733a33323a226236663636666234356266616561333465383232303761353364363463316337223b613a363a7b733a323a226964223b733a373a2238323933383335223b733a333a22717479223b643a313b733a353a227072696365223b643a313030303b733a343a226e616d65223b733a343a2268616c6f223b733a353a22726f776964223b733a33323a226236663636666234356266616561333465383232303761353364363463316337223b733a383a22737562746f74616c223b643a313030303b7d7d),
('i6hj5oc4ln8u51okpq556vs0ekek6b4e', '::1', 1655749496, 0x5f5f63695f6c6173745f726567656e65726174657c693a313635353734393439363b5573657249447c733a313a2231223b557365727c733a31333a2241646d696e6973747261746f72223b6c6576656c7c733a353a2261646d696e223b666f746f7c733a31383a22666f746f313539363031373834372e706e67223b),
('ni17efkk5jjoh2ejkgce78b5ig0j9r3q', '::1', 1655751045, 0x5f5f63695f6c6173745f726567656e65726174657c693a313635353735313034353b5573657249447c733a313a2231223b557365727c733a31333a2241646d696e6973747261746f72223b6c6576656c7c733a353a2261646d696e223b666f746f7c733a31383a22666f746f313539363031373834372e706e67223b),
('cf77i3rarrgm0tq5fmir1oomnqesdnmi', '::1', 1655755342, 0x5f5f63695f6c6173745f726567656e65726174657c693a313635353735353334323b5573657249447c733a313a2231223b557365727c733a31333a2241646d696e6973747261746f72223b6c6576656c7c733a353a2261646d696e223b666f746f7c733a31383a22666f746f313539363031373834372e706e67223b),
('9jknklv0bnlfp8pcskuh7onlr7ddtn0b', '::1', 1655759271, 0x5f5f63695f6c6173745f726567656e65726174657c693a313635353735393237313b5573657249447c733a313a2231223b557365727c733a31333a2241646d696e6973747261746f72223b6c6576656c7c733a353a2261646d696e223b666f746f7c733a31383a22666f746f313539363031373834372e706e67223b),
('9or1ejgor2birk208vuqr97d5qtde1o1', '::1', 1655761385, 0x5f5f63695f6c6173745f726567656e65726174657c693a313635353736313338353b5573657249447c733a313a2231223b557365727c733a31333a2241646d696e6973747261746f72223b6c6576656c7c733a353a2261646d696e223b666f746f7c733a31383a22666f746f313539363031373834372e706e67223b),
('1vf7app4scf44rvidcp41h2n18o9g6dk', '::1', 1655761609, 0x5f5f63695f6c6173745f726567656e65726174657c693a313635353736313338353b5573657249447c733a313a2231223b557365727c733a31333a2241646d696e6973747261746f72223b6c6576656c7c733a353a2261646d696e223b666f746f7c733a31383a22666f746f313539363031373834372e706e67223b);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_barang`
--

CREATE TABLE `tbl_barang` (
  `kode_barang` int(20) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `item_no` varchar(255) NOT NULL,
  `size` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_barang`
--

INSERT INTO `tbl_barang` (`kode_barang`, `nama_barang`, `brand`, `item_no`, `size`) VALUES
(8293834, 'okokoko11', 'okokokok', 'ottitit-2', 'f321wd'),
(8293835, 'halo', 'haiq', '123hai', '423'),
(8293836, 'obat', 'panadol', 'p001', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_detail_pembelian`
--

CREATE TABLE `tbl_detail_pembelian` (
  `id_pembelian` varchar(20) NOT NULL,
  `id_barang` int(20) NOT NULL,
  `qty` smallint(6) NOT NULL,
  `harga` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_detail_pembelian`
--

INSERT INTO `tbl_detail_pembelian` (`id_pembelian`, `id_barang`, `qty`, `harga`) VALUES
('ID1652927987', 111, 6, 200000),
('ID1654707681', 8293834, 2, 1000),
('ID1655144860', 8293834, 1, 12345),
('ID1655144948', 8293834, 1, 12345),
('ID1655145041', 8293834, 3, 1000),
('ID1655145281', 8293835, 2, 12345),
('ID1655145361', 8293835, 2, 12345),
('ID1655145431', 8293834, 4, 1000),
('ID1655153050', 8293835, 2, 2000),
('ID1655154021', 8293834, 2, 12345),
('ID1655155335', 8293834, 2, 1000),
('ID1655155495', 8293835, 2, 2000),
('ID1655155537', 8293835, 1, 3000),
('ID1655155660', 8293835, 2, 5000),
('ID1655155847', 8293835, 2, 900),
('ID1655155979', 8293835, 2, 980),
('ID1655156161', 8293835, 2, 800),
('ID1654643339', 8293835, 2, 12345),
('ID1655320718', 8293834, 2, 1000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_detail_penjualan`
--

CREATE TABLE `tbl_detail_penjualan` (
  `id_penjualan` varchar(20) NOT NULL,
  `id_barang` int(20) NOT NULL,
  `qty` smallint(6) NOT NULL,
  `harga` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_detail_penjualan`
--

INSERT INTO `tbl_detail_penjualan` (`id_penjualan`, `id_barang`, `qty`, `harga`) VALUES
('ID1655507445', 8293835, 1, 1000),
('ID1655747921', 8293835, 1, 12345),
('ID1655747964', 8293835, 2, 12345),
('ID1655748454', 8293834, 1, 12345),
('ID1655749668', 8293835, 2, 1200);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lokasi`
--

CREATE TABLE `tbl_lokasi` (
  `id_cabang` int(11) NOT NULL,
  `nama_cabang` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_lokasi`
--

INSERT INTO `tbl_lokasi` (`id_cabang`, `nama_cabang`) VALUES
(1, 'Gudang'),
(2, 'jateng'),
(3, 'jatim');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pembelian`
--

CREATE TABLE `tbl_pembelian` (
  `id_pembelian` varchar(20) NOT NULL,
  `tgl_pembelian` date NOT NULL,
  `id_supplier` varchar(15) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_pembelian`
--

INSERT INTO `tbl_pembelian` (`id_pembelian`, `tgl_pembelian`, `id_supplier`, `id_user`) VALUES
('ID1654643339', '2022-06-08', 'ID1595997179', 1),
('ID1654707681', '2022-06-09', 'ID1595998788', 1),
('ID1655144860', '2022-06-14', 'ID1595997179', 1),
('ID1655144948', '2022-06-14', 'ID1595998788', 1),
('ID1655145041', '2022-06-14', 'ID1650248939', 1),
('ID1655145281', '2022-06-14', 'ID1595998788', 1),
('ID1655145361', '2022-06-14', 'ID1595998788', 1),
('ID1655145431', '2022-06-14', 'ID1595998788', 1),
('ID1655153050', '2022-06-14', 'ID1650248939', 1),
('ID1655154021', '2022-06-14', 'ID1650248939', 1),
('ID1655155335', '2022-06-14', 'ID1650248939', 1),
('ID1655155495', '2022-06-14', 'ID1595998788', 1),
('ID1655155537', '2022-06-14', 'ID1595998788', 1),
('ID1655155660', '2022-06-14', 'ID1650248939', 1),
('ID1655155847', '2022-06-14', 'ID1595997179', 1),
('ID1655155979', '2022-06-14', 'ID1595997179', 1),
('ID1655156161', '2022-06-14', 'ID1595998788', 1),
('ID1655320718', '2022-06-16', 'ID1595997179', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_penjualan`
--

CREATE TABLE `tbl_penjualan` (
  `id_penjualan` varchar(20) NOT NULL,
  `nama_pembeli` varchar(30) NOT NULL,
  `tgl_penjualan` date NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_cabang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_penjualan`
--

INSERT INTO `tbl_penjualan` (`id_penjualan`, `nama_pembeli`, `tgl_penjualan`, `id_user`, `id_cabang`) VALUES
('ID1655507445', 'asdasd', '2022-06-18', 1, 0),
('ID1655747921', 'asdsad', '2022-06-21', 1, 0),
('ID1655747964', 'asdasd', '2022-06-21', 1, 0),
('ID1655748454', 'aaaa', '2022-06-21', 1, 0),
('ID1655749668', 'okeee', '2022-06-21', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stok`
--

CREATE TABLE `tbl_stok` (
  `id_stok` varchar(20) NOT NULL,
  `id_barang` int(20) NOT NULL,
  `id_cabang` int(11) NOT NULL,
  `id_pembelian` varchar(20) NOT NULL,
  `id_penjualan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_stok`
--

INSERT INTO `tbl_stok` (`id_stok`, `id_barang`, `id_cabang`, `id_pembelian`, `id_penjualan`) VALUES
('3', 8293834, 2, 'ID1655154021', 0),
('4', 8293834, 3, 'ID1655155335', 0),
('6', 8293835, 1, 'ID1655155537', 0),
('ID1655155660', 8293835, 1, 'ID1655155660', 0),
('ID1655155979', 8293835, 1, 'ID1655155979', 0),
('ID1655156161', 8293835, 1, 'ID1655156161', 0),
('ID16553207181', 8293834, 1, 'ID1655320718', 0),
('ID16553207182', 8293834, 2, 'ID1655320718', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supplier`
--

CREATE TABLE `tbl_supplier` (
  `id_supplier` varchar(15) NOT NULL,
  `nama_supplier` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `telp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_supplier`
--

INSERT INTO `tbl_supplier` (`id_supplier`, `nama_supplier`, `alamat`, `telp`) VALUES
('ID1595997179', 'Aipel Computer', 'Ds. Manyar, Sidoarjo', '085731109556'),
('ID1595998788', 'Sarana Informasi Computer', 'Jl. Imam Bonjol No. 16 Nganjuk', '08392193833'),
('ID1650248939', 'tes', 'jl.asdasdjkasdjkdj', '081237812');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `hp` varchar(20) NOT NULL,
  `foto` varchar(50) NOT NULL DEFAULT 'default.jpg',
  `level` enum('admin','pegawai') NOT NULL,
  `active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `username`, `fullname`, `password`, `alamat`, `hp`, `foto`, `level`, `active`, `last_login`) VALUES
(1, 'admin', 'Administrator', '$2y$08$BO41OJFfhPPPzjKdWw2I6OyUElK1mkD43UVt1ss6J1xrVUExC1lRy', '', '', 'foto1596017847.png', 'admin', 'Y', '2022-06-17 06:53:29'),
(2, 'pegawai', 'Pegawaiaaa', '$2y$10$Cr0N4aR9eNJEXUeYojjfEuw9Xc.dkEZ2KUssx4csABybnTbjp.Gom', 'Jl. Semeru No.90', '085731109355', 'foto1596071469.png', 'pegawai', 'Y', '2022-06-17 06:54:04'),
(6, 'user2', 'Pegawai Kedua', '$2y$10$swIMV3E0b6nRrDXnyBgjO.tN7vMLNmYf6Zm76CG.TO7WH9sZU5LTm', 'Jl. Nanas No. 24, Pace - Nganjuk', '085731109355', 'foto1595054714.png', 'pegawai', 'Y', '2020-07-22 07:59:43'),
(7, 'tesaja', 'tes', '$2y$10$K0pC.tDRQc7LzPGT/Wt1UugdAkkqv94Fw9qmoUCEX335gjGTcVEAO', 'asdfghasdasdasda', '213123123123', 'default.jpg', 'pegawai', 'Y', '2022-06-15 23:12:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD PRIMARY KEY (`kode_barang`);

--
-- Indexes for table `tbl_lokasi`
--
ALTER TABLE `tbl_lokasi`
  ADD PRIMARY KEY (`id_cabang`);

--
-- Indexes for table `tbl_pembelian`
--
ALTER TABLE `tbl_pembelian`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indexes for table `tbl_penjualan`
--
ALTER TABLE `tbl_penjualan`
  ADD PRIMARY KEY (`id_penjualan`);

--
-- Indexes for table `tbl_stok`
--
ALTER TABLE `tbl_stok`
  ADD PRIMARY KEY (`id_stok`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_cabang` (`id_cabang`),
  ADD KEY `id_pembelian` (`id_pembelian`),
  ADD KEY `id_penjualan` (`id_penjualan`);

--
-- Indexes for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_barang`
--
ALTER TABLE `tbl_barang`
  MODIFY `kode_barang` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8293842;

--
-- AUTO_INCREMENT for table `tbl_lokasi`
--
ALTER TABLE `tbl_lokasi`
  MODIFY `id_cabang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
