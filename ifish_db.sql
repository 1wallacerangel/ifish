-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 14-Dez-2022 às 02:34
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ifish_db`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `carrinho`
--

CREATE TABLE `carrinho` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `preco` varchar(100) NOT NULL,
  `quantidade` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `mensagem`
--

CREATE TABLE `mensagem` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefone` varchar(11) NOT NULL,
  `mensagem` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido`
--

CREATE TABLE `pedido` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `telefone` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `metodo` varchar(50) NOT NULL,
  `endereco` varchar(500) NOT NULL,
  `total_produto` varchar(1000) NOT NULL,
  `total_preco` varchar(100) NOT NULL,
  `data_pedido` varchar(50) NOT NULL,
  `status_pagamento` varchar(20) NOT NULL DEFAULT 'Pendente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `id` int(100) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `categoria` varchar(20) NOT NULL,
  `detalhe` varchar(500) NOT NULL,
  `preco` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`id`, `nome`, `categoria`, `detalhe`, `preco`, `image`) VALUES
(36, 'Caranguejo', 'crustáceos', '1kg', '60.00', 'Caranguejo-1kg-R$-60,00.jpg'),
(37, 'Camarão', 'crustáceos', '400g', '39.99', 'camarao-pre-cozido-descascado-sem-cabeca-400g-R$-39,99.jpg'),
(38, 'Polvo', 'moluscos', '200g', '29.99', 'tentaculos-polvo-200g-R$-29,99.jpg'),
(39, 'Viera', 'moluscos', '200g', '59.99', 'vieira-200g-R$-59,99.jpg'),
(40, 'Mexilhão', 'moluscos', '400g', '19.99', 'mexilhao-400g-R$-19,99.jpg'),
(41, 'Costela de Tambaqui', 'peixes', '500g', '29.99', 'costela-tambaqui-500g-R$-29,99.jpg'),
(42, 'Filé de Pirarucu', 'peixes', '500g', '34.99', 'file-de-pirarucu-500g-R$-34,99.jpg'),
(43, 'Filé de Mapara', 'peixes', '500g', '15.99', 'file-mapara-500g-R$-15,99.jpg'),
(46, 'Filé de Truta', 'peixes', '125g', '13.99', 'file-truta-125g-R$-13,99.jpg'),
(47, 'Kani-kama', 'peixes', '250g', '9.99', 'kani-kama-250g-R$-10.jpg'),
(48, 'Lombo de Bacalhau', 'peixes', '1kg', '109.99', 'lombos-bacalhau-1kg-R$-109,99.jpg'),
(49, 'Filé de Salmão', 'peixes', '500g', '49.99', 'pedacos-file-salmao-500g-R$49,99.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(100) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `senha`, `user_type`) VALUES
(1, 'Admin', 'admin@admin.com', '202cb962ac59075b964b07152d234b70', 'admin');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `carrinho`
--
ALTER TABLE `carrinho`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `mensagem`
--
ALTER TABLE `mensagem`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `carrinho`
--
ALTER TABLE `carrinho`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=334;

--
-- AUTO_INCREMENT de tabela `mensagem`
--
ALTER TABLE `mensagem`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de tabela `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
