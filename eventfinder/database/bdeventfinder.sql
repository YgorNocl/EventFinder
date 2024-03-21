-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 10-Jun-2023 às 22:31
-- Versão do servidor: 8.0.31
-- versão do PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bdeventfinder`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbevento`
--

DROP TABLE IF EXISTS `tbevento`;
CREATE TABLE IF NOT EXISTS `tbevento` (
  `idEvento` int NOT NULL AUTO_INCREMENT,
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
  `idOrganizador` int DEFAULT NULL,
  PRIMARY KEY (`idEvento`),
  KEY `tbevento_ibfk_2` (`idOrganizador`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbevento`
--

INSERT INTO `tbevento` (`idEvento`, `descEvento`, `tipoEvento`, `fotoEvento`, `idadeMinima`, `precoCamarote`, `precoPista`, `localEvento`, `dataEvento`, `horaEvento`, `horaAberturaEvento`, `idOrganizador`) VALUES
(23, 'Show do KayBlack', 'Show', 'images/evento/6463fefbd635b.jpg', '18', '90.00', '40.00', 'MonarcaBAR', '2023-06-25', '15:00:00', '15:30:00', 10),
(26, 'FanFARRA', 'Festival', 'images/evento/30b24c9a9ab6578206500cd951244f6f.png', '18', '190.00', '130.00', 'Parque Villa Lobos', '2023-06-24', '23:00:00', '23:30:00', 10),
(27, 'SuperTenda', 'Festival', 'images/evento/e87ebcb7c941f97bdf6270a4290401ab.jpg', '18', '170.00', '110.00', 'Itaquerão', '2023-09-19', '17:00:00', '17:30:00', 10),
(28, 'Show COLDPLAY', 'Show', 'images/evento/download (1).jpg', '18', '400.00', '250.00', 'Allianz Parque', '2023-11-20', '15:00:00', '15:30:00', 10);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbingresso`
--

DROP TABLE IF EXISTS `tbingresso`;
CREATE TABLE IF NOT EXISTS `tbingresso` (
  `idIngresso` int NOT NULL AUTO_INCREMENT,
  `idEvento` int NOT NULL,
  `quantidadeCamarote` int NOT NULL,
  `quantidadePista` int NOT NULL,
  `valorCamarote` decimal(10,2) NOT NULL,
  `valorPista` decimal(10,2) NOT NULL,
  `valorTotal` decimal(10,2) NOT NULL,
  `dataCompra` date NOT NULL,
  `idUsuario` int NOT NULL,
  PRIMARY KEY (`idIngresso`),
  KEY `idEvento` (`idEvento`),
  KEY `FK_Ingresso_Usuario` (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbingresso`
--

INSERT INTO `tbingresso` (`idIngresso`, `idEvento`, `quantidadeCamarote`, `quantidadePista`, `valorCamarote`, `valorPista`, `valorTotal`, `dataCompra`, `idUsuario`) VALUES
(72, 23, 1, 1, '90.00', '40.00', '130.00', '2023-06-10', 19),
(79, 26, 5, 7, '950.00', '910.00', '1860.00', '2023-06-10', 19),
(80, 27, 3, 5, '510.00', '550.00', '1060.00', '2023-06-10', 19),
(81, 23, 1, 1, '90.00', '40.00', '130.00', '2023-06-10', 19);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tborganizador`
--

DROP TABLE IF EXISTS `tborganizador`;
CREATE TABLE IF NOT EXISTS `tborganizador` (
  `idOrganizador` int NOT NULL AUTO_INCREMENT,
  `nomeOrganizador` varchar(50) NOT NULL,
  `docOrganizador` varchar(14) NOT NULL,
  `dataNasc` date DEFAULT NULL,
  `sexoOrganizador` varchar(10) DEFAULT NULL,
  `celOrganizador` varchar(20) NOT NULL,
  `emailOrganizador` varchar(50) NOT NULL,
  `senhaOrganizador` varchar(255) NOT NULL,
  PRIMARY KEY (`idOrganizador`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tborganizador`
--

INSERT INTO `tborganizador` (`idOrganizador`, `nomeOrganizador`, `docOrganizador`, `dataNasc`, `sexoOrganizador`, `celOrganizador`, `emailOrganizador`, `senhaOrganizador`) VALUES
(10, 'Monarca Bar', '62.914.911/000', '0000-00-00', 'Outro', '(11) 94568-3429', 'monarca@gmail.com', '$2y$10$Aa2PfcMa0XYa653ZRhFmzerltlhlRQy4tySpwooogVTPJG0JxCuYa');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbparceiro`
--

DROP TABLE IF EXISTS `tbparceiro`;
CREATE TABLE IF NOT EXISTS `tbparceiro` (
  `idParceiro` int NOT NULL AUTO_INCREMENT,
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
  `cep` varchar(9) NOT NULL,
  PRIMARY KEY (`idParceiro`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbparceiro`
--

INSERT INTO `tbparceiro` (`idParceiro`, `nomeParceiro`, `cnpjParceiro`, `celParceiro`, `emailParceiro`, `senhaParceiro`, `logradouro`, `numero`, `complemento`, `bairro`, `cidade`, `estado`, `cep`) VALUES
(10, 'LPM Hotels', '123123', '123', '123@g', '$2y$10$aZM37PuMVwMWAx8wCPRDiu7hdReMChAYEXnE04V9k0.j/kPZHjgNm', 'Avenida Getúlio Vargas', '300', NULL, 'Calmon Viana', 'Poá', 'SP', '08560000');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbusuario`
--

DROP TABLE IF EXISTS `tbusuario`;
CREATE TABLE IF NOT EXISTS `tbusuario` (
  `idUsuario` int NOT NULL AUTO_INCREMENT,
  `nomeUsuario` varchar(50) NOT NULL,
  `cpfUsuario` varchar(14) NOT NULL,
  `dataNasc` date NOT NULL,
  `sexoUsuario` enum('M','F','Outro') NOT NULL,
  `celUsuario` varchar(20) NOT NULL,
  `emailUsuario` varchar(50) NOT NULL,
  `senhaUsuario` varchar(255) NOT NULL,
  PRIMARY KEY (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbusuario`
--

INSERT INTO `tbusuario` (`idUsuario`, `nomeUsuario`, `cpfUsuario`, `dataNasc`, `sexoUsuario`, `celUsuario`, `emailUsuario`, `senhaUsuario`) VALUES
(19, 'Pablo Henrique', '55843748812', '2004-03-18', 'M', '(11) 94568-3429', 'ygorr@gmail.com', '$2y$10$NH9SltjEUgPwdUW/3iRviuZ67cRpO4fe.T.7cZYmgt7Gnog6FaPCC'),
(20, 'Ygor Brandão', '12307032843', '1967-01-21', 'F', '(11) 95404-3226', 'ygor@gmail.com', '$2y$10$OUzVlzsJlCs5btTcTQXLBuiq9Wd5ttd.rSCIo/DiA15UIX5Ybb1r6');

--
-- Restrições para despejos de tabelas
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
