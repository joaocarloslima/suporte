-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 13-Jan-2020 às 13:58
-- Versão do servidor: 10.1.37-MariaDB
-- versão do PHP: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `suporte`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `chamados`
--

CREATE TABLE `chamados` (
  `id` int(11) NOT NULL,
  `problema` varchar(200) NOT NULL,
  `idLocal` int(11) NOT NULL,
  `idEquipamento` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `solucao` varchar(200) NULL,
  `avaliacao` int(11) NULL,
  `dataAbertura` datetime NOT NULL,
  `dataFechamento` datetime NULL,
  `prioridade` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `equipamentos`
--

CREATE TABLE `equipamentos` (
  `id` int(11) NOT NULL,
  `descricao` varchar(200) NOT NULL,
  `patrimonio` int(11) NOT NULL,
  `sigla` varchar(200) NOT NULL,
  `tipo` varchar(200) NOT NULL,
  `idLocal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `equipamentos`
--

INSERT INTO `equipamentos` (`id`, `descricao`, `patrimonio`, `sigla`, `tipo`, `idLocal`) VALUES
(3, 'Impressora HP Laserjet', 3124, 'HP001', 'Impressora', 8),
(4, 'Desktop Positivo', 8767, 'PC002', 'Desktop', 1),
(5, 'Notebook Lenovo D210', 65432, 'NT001', 'Notebook', 9);

-- --------------------------------------------------------

--
-- Estrutura da tabela `locais`
--

CREATE TABLE `locais` (
  `id` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `sigla` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `locais`
--

INSERT INTO `locais` (`id`, `nome`, `sigla`) VALUES
(1, 'Sala de Aula 01', 'S01'),
(8, 'LaboratÃ³rio de InformÃ¡tica 01', 'LAB01'),
(9, 'LaboratÃ³rio de InformÃ¡tica 02', 'LAB02'),
(18, 'lab 01', 'lab1'),
(19, 'lab 01', 'lab1'),
(20, 'lab 01', 'lab1'),
(21, 'lab 01', 'lab1'),
(22, 'lab 01', 'lab1'),
(23, 'lab 01', 'lab1'),
(24, 'lab 01', 'lab1'),
(25, 'lab 01', 'lab1'),
(26, 'lab 01', 'lab1'),
(27, 'lab 01', 'lab1'),
(28, 'lab 01', 'lab1'),
(29, 'lab 01', 'lab1'),
(30, 'lab 01', 'lab1'),
(31, 'lab 01', 'lab1'),
(32, 'lab 01', 'lab1'),
(33, '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `matricula` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `perfil` varchar(200) NOT NULL,
  `senha` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `matricula`, `nome`, `email`, `perfil`, `senha`) VALUES
(1, 42919, 'JoÃ£o Carlos Lima e Silva', 'joaocarlos@etecia.com.br', '1', '202cb962ac59075b964b07152d234b70'),
(2, 42501, 'Renata Borges', 'renata@etec.com', '0', '202cb962ac59075b964b07152d234b70'),
(4, 42101, 'Leandro Jr', 'junior@etec.com', '2', '202cb962ac59075b964b07152d234b70'),
(6, 1234, 'pedro', 'pedro@a.v', '0', '202cb962ac59075b964b07152d234b70');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chamados`
--
ALTER TABLE `chamados`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipamentos`
--
ALTER TABLE `equipamentos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locais`
--
ALTER TABLE `locais`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chamados`
--
ALTER TABLE `chamados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `equipamentos`
--
ALTER TABLE `equipamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `locais`
--
ALTER TABLE `locais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
