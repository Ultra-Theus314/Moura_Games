-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 15/08/2024 às 15:41
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `moura_games`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_clientes`
--

CREATE TABLE `tb_clientes` (
  `ID` int(11) NOT NULL,
  `USERNAME` varchar(50) NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `STATUS` enum('online','offline') DEFAULT 'offline',
  `CREATED _AT` timestamp NOT NULL DEFAULT current_timestamp(),
  `AVATAR` varchar(255) DEFAULT 'default-avatar.png',
  `PROFILE_PICTURE` varchar(255) DEFAULT 'default-avatar.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_clientes`
--

INSERT INTO `tb_clientes` (`ID`, `USERNAME`, `EMAIL`, `PASSWORD`, `STATUS`, `CREATED _AT`, `AVATAR`, `PROFILE_PICTURE`) VALUES
(12, 'moura', 'matheus.santos123moura@gmail.com', '$2y$10$3eXfJxM31.MxLViEhVmsienEG4aNrDzKMobPVGAJdu4AxenmQGYyi', 'offline', '2024-08-15 13:36:17', 'default-avatar.png', '1723728977-a873f3f357e4fe348fb8100ce31d62be.jpg'),
(13, 'Paz', 'paz@gmail.com', '$2y$10$6RSb6LQX5q1ZVuxAvHaSR.Z25t2bf97.QDBopnRbKLYkX0AWw4BZS', 'offline', '2024-08-15 13:38:10', 'default-avatar.png', 'img.jpg');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_produtos`
--

CREATE TABLE `tb_produtos` (
  `ID` int(10) NOT NULL,
  `PRODUTO` varchar(150) NOT NULL,
  `TIPO` char(50) NOT NULL,
  `PLATAFORMA` char(40) NOT NULL,
  `DESCRICAO` varchar(500) NOT NULL,
  `FOTO` char(150) NOT NULL,
  `VALOR` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_vendas`
--

CREATE TABLE `tb_vendas` (
  `ID` int(11) NOT NULL,
  `FK_ID_CLI` int(250) NOT NULL,
  `FK_ID_PROD` int(11) NOT NULL,
  `DATA` date NOT NULL,
  `COD_VENDA` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_vendas`
--

INSERT INTO `tb_vendas` (`ID`, `FK_ID_CLI`, `FK_ID_PROD`, `DATA`, `COD_VENDA`) VALUES
(1, 17, 1, '2024-08-01', 1),
(2, 20, 1, '2024-08-01', 2),
(3, 19, 1, '2024-08-01', 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `tb_clientes`
--
ALTER TABLE `tb_clientes`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `username` (`USERNAME`),
  ADD UNIQUE KEY `email` (`EMAIL`);

--
-- Índices de tabela `tb_produtos`
--
ALTER TABLE `tb_produtos`
  ADD PRIMARY KEY (`ID`);

--
-- Índices de tabela `tb_vendas`
--
ALTER TABLE `tb_vendas`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_ID_CLI` (`FK_ID_CLI`),
  ADD KEY `FK_ID_PROD` (`FK_ID_PROD`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_clientes`
--
ALTER TABLE `tb_clientes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `tb_produtos`
--
ALTER TABLE `tb_produtos`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de tabela `tb_vendas`
--
ALTER TABLE `tb_vendas`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
