-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2020 at 07:24 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vendrame_sistema`
--

-- --------------------------------------------------------

--
-- Table structure for table `atributo`
--

CREATE TABLE `atributo` (
  `id_atributo` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` text,
  `imagem` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `atributo`
--

INSERT INTO `atributo` (`id_atributo`, `nome`, `descricao`, `imagem`) VALUES
(1, 'Proteção a olhos sensiveis', 'Atributo Teste', '2020-08-27-044424.svg'),
(2, 'Proteção Raios UV', 'Raios UV', '2020-09-09-104003.svg');

-- --------------------------------------------------------

--
-- Table structure for table `atributo_produto`
--

CREATE TABLE `atributo_produto` (
  `id_atributo_produto` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `id_atributo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `atributo_produto`
--

INSERT INTO `atributo_produto` (`id_atributo_produto`, `id_produto`, `id_atributo`) VALUES
(3, 2, 1),
(4, 3, 2),
(5, 4, 2),
(6, 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `id_categoria_pai` int(11) DEFAULT NULL,
  `id_marca` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nome`, `id_categoria_pai`, `id_marca`) VALUES
(1, 'L.P', NULL, 1),
(3, 'Bifocal', NULL, 1),
(4, 'Multifocal', NULL, 1),
(18, 'Classic', 1, 1),
(23, 'Precision Plus', NULL, 1),
(24, 'PhotoFusion', 23, 1),
(25, 'Precision Pure', NULL, 1),
(26, 'Precision Superb', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ficha_tecnica`
--

CREATE TABLE `ficha_tecnica` (
  `id_ficha_tecnica` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `campo` varchar(100) NOT NULL,
  `descricao` text NOT NULL,
  `cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ficha_tecnica`
--

INSERT INTO `ficha_tecnica` (`id_ficha_tecnica`, `id_produto`, `campo`, `descricao`, `cadastro`) VALUES
(2, 2, 'Modelo', 'Classic', '2020-09-09 12:51:28'),
(3, 2, 'Marca', 'Zeiss', '2020-09-09 12:51:40'),
(4, 3, 'Modelo', 'Nome do Modelo', '2020-09-09 13:40:39'),
(5, 3, 'Marca', 'Zeiss', '2020-09-09 13:40:55'),
(6, 5, 'Marca', 'Zeiss', '2020-09-09 13:50:21'),
(7, 5, 'Modelo', 'Classic', '2020-09-09 13:50:37');

-- --------------------------------------------------------

--
-- Table structure for table `historico`
--

CREATE TABLE `historico` (
  `id_historico` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `tabela` varchar(100) DEFAULT NULL,
  `chavePrimaria` varchar(100) DEFAULT NULL,
  `acao` varchar(150) NOT NULL,
  `descricao` text NOT NULL,
  `json` text,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `historico`
--

INSERT INTO `historico` (`id_historico`, `id_usuario`, `tabela`, `chavePrimaria`, `acao`, `descricao`, `json`, `data`) VALUES
(1, 1, NULL, NULL, 'login', 'Realizou login no sistema', NULL, '2020-08-25 14:43:33'),
(2, 1, NULL, NULL, 'login', 'Realizou login no sistema', NULL, '2020-08-27 14:30:32'),
(3, 1, NULL, NULL, 'login', 'Realizou login no sistema', NULL, '2020-08-27 14:50:54'),
(4, 1, NULL, NULL, 'login', 'Realizou login no sistema', NULL, '2020-08-27 14:51:20'),
(5, 1, NULL, NULL, 'login', 'Realizou login no sistema', NULL, '2020-08-28 14:33:49'),
(6, 1, NULL, NULL, 'login', 'Realizou login no sistema', NULL, '2020-08-28 20:28:41'),
(7, 1, NULL, NULL, 'login', 'Realizou login no sistema', NULL, '2020-08-31 11:59:29'),
(8, 1, NULL, NULL, 'login', 'Realizou login no sistema', NULL, '2020-08-31 12:20:08'),
(9, 1, NULL, NULL, 'login', 'Realizou login no sistema', NULL, '2020-08-31 12:20:09'),
(10, 1, NULL, NULL, 'login', 'Realizou login no sistema', NULL, '2020-08-31 12:22:37'),
(11, 1, NULL, NULL, 'login', 'Realizou login no sistema', NULL, '2020-09-01 21:04:48'),
(12, 1, NULL, NULL, 'login', 'Realizou login no sistema', NULL, '2020-09-02 18:35:50'),
(13, 1, NULL, NULL, 'login', 'Realizou login no sistema', NULL, '2020-09-03 11:41:47'),
(14, 1, NULL, NULL, 'login', 'Realizou login no sistema', NULL, '2020-09-03 19:32:31'),
(15, 1, 'imagem', '1', 'delete', 'Adicionou uma imagem ao produto Zeiss LP Classic 1.50 (#1)', '{\"id_imagem\":\"1\",\"id_produto\":\"2\",\"imagem\":\"thumb_2020-09-03-045135.png\",\"principal\":\"0\",\"cadastro\":\"2020-09-03 16:51:35\"}', '2020-09-03 19:51:35'),
(16, 1, 'imagem', '1', 'update', 'Alterou a capa do produto Zeiss LP Classic 1.50 (#1)', '', '2020-09-03 19:52:50'),
(17, 1, NULL, NULL, 'login', 'Realizou login no sistema', NULL, '2020-09-04 13:02:16'),
(18, 1, NULL, NULL, 'login', 'Realizou login no sistema', NULL, '2020-09-04 14:57:04'),
(19, 1, NULL, NULL, 'login', 'Realizou login no sistema', NULL, '2020-09-04 18:28:48'),
(20, 1, NULL, NULL, 'login', 'Realizou login no sistema', NULL, '2020-09-09 12:45:09'),
(21, 1, NULL, NULL, 'login', 'Realizou login no sistema', NULL, '2020-09-09 12:45:10');

-- --------------------------------------------------------

--
-- Table structure for table `imagem`
--

CREATE TABLE `imagem` (
  `id_imagem` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `imagem` varchar(150) NOT NULL,
  `principal` tinyint(1) NOT NULL DEFAULT '0',
  `cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `marca`
--

CREATE TABLE `marca` (
  `id_marca` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `logo` varchar(150) DEFAULT NULL,
  `cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `marca`
--

INSERT INTO `marca` (`id_marca`, `nome`, `logo`, `cadastro`) VALUES
(1, 'Zeiss', 'zeiss.jpg', '2020-08-25 17:32:12'),
(4, 'Guess', '2020-08-27-023750.png', '2020-08-27 17:37:50'),
(5, 'Oakley', '2020-08-27-023859.png', '2020-08-27 17:38:59'),
(6, 'Diesel', '2020-08-27-023929.png', '2020-08-27 17:39:29'),
(7, 'Fendi', '2020-08-27-023942.png', '2020-08-27 17:39:42'),
(8, 'Lacoste', '2020-08-27-024022.png', '2020-08-27 17:40:22'),
(9, 'Nike', '2020-08-27-024034.png', '2020-08-27 17:40:34'),
(10, 'Prada', '2020-08-27-024056.png', '2020-08-27 17:40:56'),
(11, 'Tom Ford', '2020-08-27-025928.png', '2020-08-27 17:41:14'),
(12, 'Ray Ban', '2020-08-27-025943.png', '2020-08-27 17:59:43');

-- --------------------------------------------------------

--
-- Table structure for table `produto`
--

CREATE TABLE `produto` (
  `id_produto` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_marca` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_tipo` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `referencia` varchar(50) DEFAULT NULL,
  `descricao` longblob,
  `valorPago` double NOT NULL DEFAULT '0',
  `valorVenda` double DEFAULT NULL,
  `lucro` double DEFAULT NULL,
  `desconto` double DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `produto`
--

INSERT INTO `produto` (`id_produto`, `id_categoria`, `id_marca`, `id_usuario`, `id_tipo`, `nome`, `referencia`, `descricao`, `valorPago`, `valorVenda`, `lucro`, `desconto`, `status`, `cadastro`) VALUES
(2, 18, 1, 1, 1, 'Zeiss LP Classic 1.50', '002', 0x3c703e566573746962756c756d20616e746520697073756d207072696d697320696e206661756369627573206f726369206c756374757320657420756c74726963657320706f737565726520637562696c69612063757261653b204d616563656e61732072757472756d20616e7465206a7573746f2c207669746165206d6178696d7573206f72636920656c656d656e74756d206e6f6e2e2044756973207072657469756d2073656d206575206f726e617265206d6f6c65737469652e204475697320637572737573206469616d206d61757269732c20656765737461732074696e636964756e74206c656f207661726975732065752e20536564207072657469756d2c2074656c6c757320612076656e566976616d7573206964206f726369206174206e756e6320737573636970697420656c656d656e74756d20616320636f6e6775652075726e612e203c2f703e3c703e4e616d20616c697175657420616c697175616d206f64696f20657520736f64616c65732e205175697371756520636f6e7365637465747572206575206e65717565206567657420626962656e64756d2e204675736365207669746165206f64696f206d617373612e20566573746962756c756d206d6175726973207475727069732c206c616f726565742076656c206469616d20612c20706f72746120616c6971756574206e6962682e204d616563656e617320636f6e64696d656e74756d2065726174207574206d657475732073616769747469732c20717569732066657567696174206578206d6178696d75732e2050686173656c6c757320736564207175616d20612065726f73206772617669646120656765737461732e3c62723e3c2f703e, 1000, 2000, 100, 7, 1, '2020-09-03 11:47:22'),
(3, 24, 1, 1, 0, 'Zeiss Precision Plus 1.5 PhotoFusion', '002', 0x3c703e4c6f72656d20697073756d20646f6c6f722073697420616d65742c20636f6e73656374657475722061646970697363696e6720656c69742e2053656420706c6163657261742066656c69732074656c6c75732c20657420756c7472696365732076656c69742064696374756d2075742e205072616573656e7420766976657272612c206c656f2076656c20636f6e67756520736f6c6c696369747564696e2c206e65717565206c656f20656c656966656e642061756775652c2061632072686f6e637573206c6f72656d206f72636920696e2075726e612e204e756c6c616d20646f6c6f72206c656f2c20706f7274612076656c2074656c6c7573206e65632c206d6178696d757320616c697175616d206d61757269732e20566573746962756c756d2074696e636964756e742073616769747469732075726e612c20657520706f7375657265206e6973692070656c6c656e7465737175652061632e204475697320706f72747469746f7220746f72746f722065752076756c7075746174652070686172657472612e2050686173656c6c75732073656d2065726f732c20616363756d73616e207365642064696374756d2065742c2068656e647265726974206e6f6e2072697375732e204d616563656e6173206174206572617420616320746f72746f7220626962656e64756d2074696e636964756e74206e6f6e206e6f6e206d692e205365642074656d7075732065737420657520636f6e677565206c75637475732e204d6f726269206d6178696d75732061206c6f72656d20717569732076756c7075746174652e204d6f726269206665726d656e74756d206e756e63207175697320616e74652068656e64726572697420756c7472696365732e20566976616d7573207175697320696d70657264696574206e6962682e20446f6e6563206c6163696e69612c206d6920757420756c74726963696573207665686963756c612c20646f6c6f72206e6962682074656d707573206d617373612c20766974616520657569736d6f6420646f6c6f722061756775652069642075726e612e20566573746962756c756d2069642076756c7075746174652061756775652c2061632070656c6c656e74657371756520646f6c6f722e3c2f703e, 2500, 3250, 30, 7, 1, '2020-09-09 13:37:58'),
(4, 23, 1, 1, 0, 'Zeiss Precision Plus 1.74', '005', 0x3c703e4c6f72656d20697073756d20646f6c6f722073697420616d65742c20636f6e73656374657475722061646970697363696e6720656c69742e204d61757269732070757275732074656c6c75732c2066696e696275732076656c206c6967756c61206e6f6e2c20657569736d6f64207072657469756d206c6f72656d2e2050656c6c656e74657371756520636f6e76616c6c6973206c6f626f727469732061726375206574206d6f6c6c69732e20566573746962756c756d206a7573746f206d617373612c2074656d70757320612075726e6120612c206c7563747573206566666963697475722065782e204e756c6c612070656c6c656e7465737175652065782065782e204d616563656e6173206e65717565206e6973692c206c616f7265657420696e206c656374757320696e2c20756c7472696365732066657567696174206d617373612e3c2f703e, 2300, 2875, 25, 5, 1, '2020-09-09 13:47:30'),
(5, 24, 1, 1, 0, 'Zeiss Precision Plus 1.74 PhotoFusion Polarizada', '009', 0x3c703e4c6f72656d20697073756d20646f6c6f722073697420616d65742c20636f6e73656374657475722061646970697363696e6720656c69742e204d61757269732070757275732074656c6c75732c2066696e696275732076656c206c6967756c61206e6f6e2c20657569736d6f64207072657469756d206c6f72656d2e2050656c6c656e74657371756520636f6e76616c6c6973206c6f626f727469732061726375206574206d6f6c6c69732e20566573746962756c756d206a7573746f206d617373612c2074656d70757320612075726e6120612c206c7563747573206566666963697475722065782e204e756c6c612070656c6c656e7465737175652065782065782e204d616563656e6173206e65717565206e6973692c206c616f7265657420696e206c656374757320696e2c20756c7472696365732066657567696174206d617373612e3c2f703e, 1890, 2551.5, 35, 7, 1, '2020-09-09 13:50:07');

-- --------------------------------------------------------

--
-- Table structure for table `tipo`
--

CREATE TABLE `tipo` (
  `id_tipo` int(11) NOT NULL,
  `id_tipo_pai` int(11) DEFAULT NULL,
  `id_marca` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tipo`
--

INSERT INTO `tipo` (`id_tipo`, `id_tipo_pai`, `id_marca`, `nome`) VALUES
(1, NULL, 1, '1.50'),
(3, NULL, 1, '1.74'),
(4, 3, 1, 'Polarizada');

-- --------------------------------------------------------

--
-- Table structure for table `token`
--

CREATE TABLE `token` (
  `id_token` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `token` text NOT NULL,
  `ip` varchar(100) NOT NULL,
  `data_expira` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `token`
--

INSERT INTO `token` (`id_token`, `id_usuario`, `token`, `ip`, `data_expira`, `data`) VALUES
(1, 1, '64666c6b662d666b6c6a736e2d373231333636352d64686a612d312d323032302d30382d32352031313a34333a333335663435323339353765633566302e3234323439323238', '::1', '2020-08-26 14:43:33', '2020-08-25 14:43:33'),
(2, 1, '64666c6b662d666b6c6a736e2d373231333636352d64686a612d312d323032302d30382d32372031313a33303a333235663437633338383032366136332e3331353133353839', '::1', '2020-08-28 14:30:32', '2020-08-27 14:30:32'),
(3, 1, '64666c6b662d666b6c6a736e2d373231333636352d64686a612d312d323032302d30382d32382031313a33333a343935663439313563643031613335312e3730313738313133', '::1', '2020-08-29 14:33:49', '2020-08-28 14:33:49'),
(4, 1, '64666c6b662d666b6c6a736e2d373231333636352d64686a612d312d323032302d30382d33312030383a35393a323835663463653632306631323139302e3136303933313737', '::1', '2020-09-01 11:59:28', '2020-08-31 11:59:28'),
(5, 1, '64666c6b662d666b6c6a736e2d373231333636352d64686a612d312d323032302d30392d30312031383a30343a343835663465623737303132353537352e3437333733313631', '::1', '2020-09-02 21:04:48', '2020-09-01 21:04:48'),
(6, 1, '64666c6b662d666b6c6a736e2d373231333636352d64686a612d312d323032302d30392d30332030383a34313a343735663530643637626536343530362e3731323831323432', '::1', '2020-09-04 11:41:47', '2020-09-03 11:41:47'),
(7, 1, '64666c6b662d666b6c6a736e2d373231333636352d64686a612d312d323032302d30392d30342031303a30323a313635663532336164386534323131302e3235393932393036', '::1', '2020-09-05 13:02:16', '2020-09-04 13:02:16'),
(8, 1, '64666c6b662d666b6c6a736e2d373231333636352d64686a612d312d323032302d30392d30392030393a34353a303935663538636535356536626364302e3533383331313638', '::1', '2020-09-10 12:45:09', '2020-09-09 12:45:09');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `cpf` varchar(50) DEFAULT NULL,
  `senha` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `nivel` enum('admin','vendedor') NOT NULL,
  `cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nome`, `cpf`, `senha`, `status`, `nivel`, `cadastro`) VALUES
(1, 'Igor Cacerez', '44268438807', '81dc9bdb52d04dc20036dbd8313ed055', 1, 'admin', '2020-08-25 14:20:09'),
(4, 'Teste', '12312312312', '202cb962ac59075b964b07152d234b70', 1, 'vendedor', '2020-08-27 14:31:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `atributo`
--
ALTER TABLE `atributo`
  ADD PRIMARY KEY (`id_atributo`);

--
-- Indexes for table `atributo_produto`
--
ALTER TABLE `atributo_produto`
  ADD PRIMARY KEY (`id_atributo_produto`),
  ADD KEY `id_atributo` (`id_atributo`),
  ADD KEY `id_produto` (`id_produto`);

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indexes for table `ficha_tecnica`
--
ALTER TABLE `ficha_tecnica`
  ADD PRIMARY KEY (`id_ficha_tecnica`),
  ADD KEY `id_produto` (`id_produto`);

--
-- Indexes for table `historico`
--
ALTER TABLE `historico`
  ADD PRIMARY KEY (`id_historico`);

--
-- Indexes for table `imagem`
--
ALTER TABLE `imagem`
  ADD PRIMARY KEY (`id_imagem`),
  ADD KEY `id_produto` (`id_produto`);

--
-- Indexes for table `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`id_marca`);

--
-- Indexes for table `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id_produto`),
  ADD KEY `id_categoria` (`id_categoria`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_marca` (`id_marca`);

--
-- Indexes for table `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`id_tipo`),
  ADD KEY `id_tipo_pai` (`id_tipo_pai`),
  ADD KEY `id_marca` (`id_marca`);

--
-- Indexes for table `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`id_token`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `atributo`
--
ALTER TABLE `atributo`
  MODIFY `id_atributo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `atributo_produto`
--
ALTER TABLE `atributo_produto`
  MODIFY `id_atributo_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `ficha_tecnica`
--
ALTER TABLE `ficha_tecnica`
  MODIFY `id_ficha_tecnica` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `historico`
--
ALTER TABLE `historico`
  MODIFY `id_historico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `imagem`
--
ALTER TABLE `imagem`
  MODIFY `id_imagem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `marca`
--
ALTER TABLE `marca`
  MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `produto`
--
ALTER TABLE `produto`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tipo`
--
ALTER TABLE `tipo`
  MODIFY `id_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `token`
--
ALTER TABLE `token`
  MODIFY `id_token` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `atributo_produto`
--
ALTER TABLE `atributo_produto`
  ADD CONSTRAINT `atributo_produto_ibfk_1` FOREIGN KEY (`id_atributo`) REFERENCES `atributo` (`id_atributo`),
  ADD CONSTRAINT `atributo_produto_ibfk_2` FOREIGN KEY (`id_produto`) REFERENCES `produto` (`id_produto`);

--
-- Constraints for table `ficha_tecnica`
--
ALTER TABLE `ficha_tecnica`
  ADD CONSTRAINT `ficha_tecnica_ibfk_1` FOREIGN KEY (`id_produto`) REFERENCES `produto` (`id_produto`);

--
-- Constraints for table `imagem`
--
ALTER TABLE `imagem`
  ADD CONSTRAINT `imagem_ibfk_1` FOREIGN KEY (`id_produto`) REFERENCES `produto` (`id_produto`);

--
-- Constraints for table `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `produto_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`),
  ADD CONSTRAINT `produto_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `produto_ibfk_3` FOREIGN KEY (`id_marca`) REFERENCES `marca` (`id_marca`);

--
-- Constraints for table `tipo`
--
ALTER TABLE `tipo`
  ADD CONSTRAINT `tipo_ibfk_1` FOREIGN KEY (`id_tipo_pai`) REFERENCES `tipo` (`id_tipo`),
  ADD CONSTRAINT `tipo_ibfk_2` FOREIGN KEY (`id_marca`) REFERENCES `marca` (`id_marca`);

--
-- Constraints for table `token`
--
ALTER TABLE `token`
  ADD CONSTRAINT `token_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
