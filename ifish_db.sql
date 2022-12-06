-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 05-Dez-2022 às 02:22
-- Versão do servidor: 10.4.25-MariaDB
-- versão do PHP: 8.1.10

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
  `preco` int(100) NOT NULL,
  `quantidade` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `carrinho`
--

INSERT INTO `carrinho` (`id`, `user_id`, `pid`, `nome`, `preco`, `quantidade`, `image`) VALUES
(236, 31, 23, 'Tomate', 13, 1, 'tomato.png'),
(237, 31, 19, 'Maça', 25, 1, 'apple.png');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `mensagem`
--

INSERT INTO `mensagem` (`id`, `user_id`, `nome`, `email`, `telefone`, `mensagem`) VALUES
(17, 7, 'Wallace Rangel', 'wallacerangelone2@gmail.com', '22998121122', 'wfweffwe');

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
  `total_preco` int(100) NOT NULL,
  `data_pedido` varchar(50) NOT NULL,
  `status_pagamento` varchar(20) NOT NULL DEFAULT 'Pendente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `pedido`
--

INSERT INTO `pedido` (`id`, `user_id`, `cpf`, `telefone`, `email`, `metodo`, `endereco`, `total_produto`, `total_preco`, `data_pedido`, `status_pagamento`) VALUES
(38, 7, '19798303717', 2147483647, 'wallacerangelone2@gmail.com', 'Dinheiro', 'Rua Recanto da saudade | 303 | Araruama | 28970000', ' Maça ( 1 )', 25, '03-12-2022 01:57', 'Realizado');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `id` int(100) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `categoria` varchar(20) NOT NULL,
  `detalhe` varchar(500) NOT NULL,
  `preco` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`id`, `nome`, `categoria`, `detalhe`, `preco`, `image`) VALUES
(18, 'Banana', 'crustáceos', 'Banana', 10, 'banana.png'),
(19, 'Maça', 'fruits', 'Maça', 25, 'apple.png'),
(20, 'Peixe', 'peixes', 'Peixe', 150, 'oily fishes.png'),
(21, 'Laranja', 'fruits', 'Laranja', 666, 'orange.png'),
(22, 'Uva', 'fruits', 'Uva', 50, 'green grapes.png'),
(23, 'Tomate', 'fruits', 'Tomate', 13, 'tomato.png');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `senha`, `user_type`) VALUES
(7, 'Wallace Rangel Gama da Silva', 'wallacerangelone2@gmail.com', '202cb962ac59075b964b07152d234b70', 'user'),
(8, 'Wallace Rangel Gama da Silva', 'wallacerangel@gmail.com', '202cb962ac59075b964b07152d234b70', 'admin');

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
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=256;

--
-- AUTO_INCREMENT de tabela `mensagem`
--
ALTER TABLE `mensagem`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
