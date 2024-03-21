-- phpMyAdmin SQL Dump
-- version 4.7.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 10-Out-2023 às 12:48
-- Versão do servidor: 5.6.34
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bdeventfinder`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbevento`
--

CREATE TABLE `tbevento` (
  `idEvento` int(11) NOT NULL,
  `descEvento` varchar(100) NOT NULL,
  `tipoEvento` varchar(50) NOT NULL,
  `fotoEvento` varchar(100) NOT NULL,
  `idadeMinima` varchar(100) NOT NULL,
  `precoCamarote` decimal(10,2) DEFAULT NULL,
  `precoPista` decimal(10,2) NOT NULL,
  `localEvento` varchar(100) NOT NULL,
  `dataEvento` date NOT NULL,
  `horaEvento` time NOT NULL,
  `horaAberturaEvento` time NOT NULL,
  `idOrganizador` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbevento`
--

INSERT INTO `tbevento` (`idEvento`, `descEvento`, `tipoEvento`, `fotoEvento`, `idadeMinima`, `precoCamarote`, `precoPista`, `localEvento`, `dataEvento`, `horaEvento`, `horaAberturaEvento`, `idOrganizador`) VALUES
(23, 'Show do KayBlack', 'Show', 'images/evento/21234_banner6.jpg', '18', '90.00', '40.00', 'MonarcaBAR', '2023-06-25', '15:00:00', '15:30:00', 10),
(30, 'CENA 2K23', 'SHOW', 'images/evento/CENA.jpg', '16', '200.00', '100.00', 'itaquerão', '2023-12-09', '12:00:00', '12:00:00', 10),
(31, 'Matue', 'Show', 'images/evento/MATUE.jpg', '14', '300.00', '60.00', 'Flor de lis', '2024-03-05', '21:00:00', '20:00:00', 10),
(32, 'Ryu, The Runner', 'SHOW', 'images/evento/RYU.jpg', '15', '120.00', '40.00', 'Piracicaba', '2024-08-25', '22:30:00', '21:00:00', 10),
(33, 'MC IG', 'Show', 'images/evento/MC IG.jpeg', '18', '150.00', '80.00', 'VILLA FEST', '2024-09-16', '23:00:00', '22:00:00', 10),
(34, 'MC Ryan SP', 'Show', 'images/evento/RYan.png', '18', '200.00', '60.00', 'SP', '2023-12-17', '21:00:00', '20:00:00', 10),
(35, 'Veigh', 'Show', 'images/evento/Veigh.png', '16', '130.00', '70.00', 'VIVA FESTIVAL', '2024-04-20', '20:00:00', '18:00:00', 10),
(36, 'MC Hariel', 'Show', 'images/evento/Hariel.jpg', '18', '230.00', '100.00', 'STAGE MUSIC CLUB', '2024-02-14', '22:00:00', '21:00:00', 10);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbingresso`
--

CREATE TABLE `tbingresso` (
  `idIngresso` int(11) NOT NULL,
  `idEvento` int(11) NOT NULL,
  `quantidadeCamarote` int(11) NOT NULL,
  `quantidadePista` int(11) NOT NULL,
  `valorCamarote` decimal(10,2) NOT NULL,
  `valorPista` decimal(10,2) NOT NULL,
  `valorTotal` decimal(10,2) NOT NULL,
  `dataCompra` date NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbingresso`
--

INSERT INTO `tbingresso` (`idIngresso`, `idEvento`, `quantidadeCamarote`, `quantidadePista`, `valorCamarote`, `valorPista`, `valorTotal`, `dataCompra`, `idUsuario`) VALUES
(72, 23, 1, 1, '90.00', '40.00', '130.00', '2023-06-10', 19),
(81, 23, 1, 1, '90.00', '40.00', '130.00', '2023-06-10', 19),
(82, 23, 1, 1, '90.00', '40.00', '130.00', '2023-10-06', 21),
(83, 23, 1, 1, '90.00', '40.00', '130.00', '2023-10-06', 21),
(85, 23, 42, 0, '90.00', '40.00', '130.00', '2023-10-06', 21),
(87, 23, 1, 1, '90.00', '40.00', '130.00', '2023-10-06', 22);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tborganizador`
--

CREATE TABLE `tborganizador` (
  `idOrganizador` int(11) NOT NULL,
  `nomeOrganizador` varchar(50) NOT NULL,
  `docOrganizador` varchar(14) NOT NULL,
  `dataNasc` date DEFAULT NULL,
  `sexoOrganizador` varchar(10) DEFAULT NULL,
  `celOrganizador` varchar(20) NOT NULL,
  `emailOrganizador` varchar(50) NOT NULL,
  `senhaOrganizador` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tborganizador`
--

INSERT INTO `tborganizador` (`idOrganizador`, `nomeOrganizador`, `docOrganizador`, `dataNasc`, `sexoOrganizador`, `celOrganizador`, `emailOrganizador`, `senhaOrganizador`) VALUES
(10, 'Monarca', '524.833.998-78', '2004-11-05', 'F', '(11) 94568-3429', 'monarca@gmail.com', '$2y$10$Aa2PfcMa0XYa653ZRhFmzerltlhlRQy4tySpwooogVTPJG0JxCuYa'),
(11, 'Ygor Brandão', '524.833.998-78', '2004-11-05', 'M', '(11) 99886-5129', 'ygorbrandaosilva@gmail.com', '$2y$10$olpDFlwiWvFF4dhuZFSREOg8DMI6/ICvdbRJmdbOiNXlExB28E3BW');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbparceiro`
--

CREATE TABLE `tbparceiro` (
  `idParceiro` int(11) NOT NULL,
  `nomeParceiro` varchar(50) NOT NULL,
  `cnpjParceiro` varchar(18) NOT NULL,
  `celParceiro` varchar(20) NOT NULL,
  `emailParceiro` varchar(50) NOT NULL,
  `senhaParceiro` varchar(255) NOT NULL,
  `logradouro` varchar(100) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `complemento` varchar(50) DEFAULT NULL,
  `bairro` varchar(50) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `cep` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbparceiro`
--

INSERT INTO `tbparceiro` (`idParceiro`, `nomeParceiro`, `cnpjParceiro`, `celParceiro`, `emailParceiro`, `senhaParceiro`, `logradouro`, `numero`, `complemento`, `bairro`, `cidade`, `estado`, `cep`) VALUES
(10, 'LPM Hotels', '123123', '123', '123@g', '$2y$10$aZM37PuMVwMWAx8wCPRDiu7hdReMChAYEXnE04V9k0.j/kPZHjgNm', 'Avenida Getúlio Vargas', '300', NULL, 'Calmon Viana', 'Poá', 'SP', '08560000'),
(11, 'Parceiro', '46.566.212/0001-31', '11998865129', 'parceiro@gmail.com', '$2y$10$pbgRTBCzLTpYFQmwi9mkt.I88kCiKyo/.QfGlzOlPNmAu/6FGng5m', 'Rua Jacareí', '52', NULL, 'Vila Santa Maria', 'Poá', 'SP', '08563610');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbusuario`
--

CREATE TABLE `tbusuario` (
  `idUsuario` int(11) NOT NULL,
  `nomeUsuario` varchar(50) NOT NULL,
  `cpfUsuario` varchar(14) NOT NULL,
  `dataNasc` date NOT NULL,
  `sexoUsuario` enum('M','F','Outro') NOT NULL,
  `celUsuario` varchar(20) NOT NULL,
  `emailUsuario` varchar(50) NOT NULL,
  `senhaUsuario` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbusuario`
--

INSERT INTO `tbusuario` (`idUsuario`, `nomeUsuario`, `cpfUsuario`, `dataNasc`, `sexoUsuario`, `celUsuario`, `emailUsuario`, `senhaUsuario`) VALUES
(19, 'Pablo Henrique', '55843748812', '2004-03-18', 'M', '(11) 94568-3429', 'ygorr@gmail.com', '$2y$10$NH9SltjEUgPwdUW/3iRviuZ67cRpO4fe.T.7cZYmgt7Gnog6FaPCC'),
(20, 'Ygor Brandão', '12307032843', '1967-01-21', 'F', '(11) 95404-3226', 'ygor@gmail.com', '$2y$10$OUzVlzsJlCs5btTcTQXLBuiq9Wd5ttd.rSCIo/DiA15UIX5Ybb1r6'),
(21, 'Usuario', '52483399878', '2004-11-05', 'M', '11998865129', 'usuario@gmail.com', '$2y$10$F5gG3pzGzSn.iyj1CEuuWudfSrDcEeLbDwUZaiFn28X9C6m4C2bGq'),
(22, 'Ygor', '524.833.998-78', '2004-11-05', 'M', '(11) 99886-5129', 'monarc@gmail.com', '$2y$10$9qe6VxZFN3SqvYoODpiz7e5kAwuLvcVw0EUjogSjJGmXDKLSJVo9i');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbevento`
--
ALTER TABLE `tbevento`
  ADD PRIMARY KEY (`idEvento`),
  ADD KEY `tbevento_ibfk_2` (`idOrganizador`);

--
-- Indexes for table `tbingresso`
--
ALTER TABLE `tbingresso`
  ADD PRIMARY KEY (`idIngresso`),
  ADD KEY `idEvento` (`idEvento`),
  ADD KEY `FK_Ingresso_Usuario` (`idUsuario`);

--
-- Indexes for table `tborganizador`
--
ALTER TABLE `tborganizador`
  ADD PRIMARY KEY (`idOrganizador`);

--
-- Indexes for table `tbparceiro`
--
ALTER TABLE `tbparceiro`
  ADD PRIMARY KEY (`idParceiro`);

--
-- Indexes for table `tbusuario`
--
ALTER TABLE `tbusuario`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbevento`
--
ALTER TABLE `tbevento`
  MODIFY `idEvento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tbingresso`
--
ALTER TABLE `tbingresso`
  MODIFY `idIngresso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `tborganizador`
--
ALTER TABLE `tborganizador`
  MODIFY `idOrganizador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbparceiro`
--
ALTER TABLE `tbparceiro`
  MODIFY `idParceiro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbusuario`
--
ALTER TABLE `tbusuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `tbevento`
--
ALTER TABLE `tbevento`
  ADD CONSTRAINT `tbevento_ibfk_2` FOREIGN KEY (`idOrganizador`) REFERENCES `tborganizador` (`idOrganizador`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `tbingresso`
--
ALTER TABLE `tbingresso`
  ADD CONSTRAINT `FK_Ingresso_Usuario` FOREIGN KEY (`idUsuario`) REFERENCES `tbusuario` (`idUsuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_tbIngresso_idEvento` FOREIGN KEY (`idEvento`) REFERENCES `tbevento` (`idEvento`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbingresso_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `tbusuario` (`idUsuario`),
  ADD CONSTRAINT `tbingresso_ibfk_3` FOREIGN KEY (`idEvento`) REFERENCES `tbevento` (`idEvento`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
