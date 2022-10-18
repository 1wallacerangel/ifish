-- phpMyAdmin SQL Dump
-- version 5.3.0-dev+20220715.346923e20a
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 19-Jul-2022 às 21:47
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `cadastro`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cad_comprador`
--

CREATE TABLE `cad_comprador` (
  `nome` varchar(120) NOT NULL,
  `sobrenome` varchar(120) NOT NULL,
  `data_nascimento` date NOT NULL,
  `email` varchar(120) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `id_comprador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cad_vendedor`
--

CREATE TABLE `cad_vendedor` (
  `nome` varchar(120) NOT NULL,
  `sobrenome` varchar(120) NOT NULL,
  `data_nascimento` date NOT NULL,
  `email` varchar(120) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `id_vendedor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cad_comprador`
--
ALTER TABLE `cad_comprador`
  ADD PRIMARY KEY (`id_comprador`);

--
-- Índices para tabela `cad_vendedor`
--
ALTER TABLE `cad_vendedor`
  ADD PRIMARY KEY (`id_vendedor`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cad_comprador`
--
ALTER TABLE `cad_comprador`
  MODIFY `id_comprador` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cad_vendedor`
--
ALTER TABLE `cad_vendedor`
  MODIFY `id_vendedor` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
