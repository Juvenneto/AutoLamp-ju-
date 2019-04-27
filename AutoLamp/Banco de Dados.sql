-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 25-Abr-2019 às 16:28
-- Versão do servidor: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `autolamp2`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `alarme`
--

CREATE TABLE `alarme` (
  `id` int(11) NOT NULL,
  `aula` varchar(15) NOT NULL,
  `hora_inicio` varchar(10) NOT NULL,
  `hora_fim` varchar(10) NOT NULL,
  `periodo` varchar(30) NOT NULL,
  `data_fim` date NOT NULL,
  `data_inicio` date NOT NULL,
  `dia` date NOT NULL,
  `sala_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `alarme`
--

INSERT INTO `alarme` (`id`, `aula`, `hora_inicio`, `hora_fim`, `periodo`, `data_fim`, `data_inicio`, `dia`, `sala_id`) VALUES
(86, 'geo001', '07:30', '11:30', 'Matutino', '2019-05-01', '2019-04-25', '2019-04-29', 1),
(87, 'geo001', '07:30', '11:30', 'Matutino', '2019-05-01', '2019-04-25', '2019-04-30', 1),
(88, 'geo001', '07:30', '11:30', 'Matutino', '2019-05-01', '2019-04-25', '2019-05-01', 1),
(89, 'geo001', '07:33', '11:43', 'Matutino', '2019-05-01', '2019-04-25', '2019-04-26', 1),
(90, 'geo001', '07:30', '11:30', 'Matutino', '2019-05-01', '2019-04-25', '2019-04-26', 1),
(91, 'geo001', '07:30', '11:30', 'Matutino', '2019-05-01', '2019-04-25', '2019-04-27', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `aula`
--

CREATE TABLE `aula` (
  `id` int(11) NOT NULL,
  `periodo` varchar(15) NOT NULL,
  `data_fim` datetime NOT NULL,
  `disciplina_id` varchar(11) NOT NULL,
  `data_inicio` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `aula`
--

INSERT INTO `aula` (`id`, `periodo`, `data_fim`, `disciplina_id`, `data_inicio`) VALUES
(1, 'Matutino', '2019-02-02 00:00:00', 'mat002', '20/04/2019');

-- --------------------------------------------------------

--
-- Estrutura da tabela `datas`
--

CREATE TABLE `datas` (
  `testedata1` date NOT NULL,
  `testedata2` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `datas`
--

INSERT INTO `datas` (`testedata1`, `testedata2`) VALUES
('2019-04-20', '24/04/2019');

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplina`
--

CREATE TABLE `disciplina` (
  `id` varchar(20) NOT NULL,
  `nome` varchar(30) CHARACTER SET utf8 NOT NULL,
  `carga_horaria` varchar(3) NOT NULL,
  `professor_id` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `disciplina`
--

INSERT INTO `disciplina` (`id`, `nome`, `carga_horaria`, `professor_id`) VALUES
('geo001', 'Geografia', '80', '8'),
('hist001', 'História', '80', '19'),
('mat002', 'Matemática', '80', '12'),
('POO1', 'POO1', '80', '9'),
('por002', 'Português', '80', '19');

-- --------------------------------------------------------

--
-- Estrutura da tabela `equipamento`
--

CREATE TABLE `equipamento` (
  `id` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `cod_porta` int(11) NOT NULL,
  `cod_equipamento` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `equipamento`
--

INSERT INTO `equipamento` (`id`, `nome`, `cod_porta`, `cod_equipamento`) VALUES
(3, 'Lampada frontal', 4, '4'),
(4, 'Data show', 2, '1'),
(5, 'Lampada Lateral', 3, '2'),
(6, 'Ventilador', 5, '4'),
(8, 'PC02', 6, '5'),
(10, 'PC03', 7, '3'),
(12, 'Ar condicionado', 8, '3'),
(14, 'Data show', 9, '5'),
(17, 'PC02', 10, '2'),
(19, 'Caixa de som', 11, '1'),
(20, 'Ar condicionado', 12, '1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `porta`
--

CREATE TABLE `porta` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `estado` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `porta`
--

INSERT INTO `porta` (`id`, `nome`, `estado`) VALUES
(2, '1', 'Ativo'),
(3, '2', 'Ativo'),
(4, '3', 'Ativo'),
(5, '5', 'Ativo'),
(6, '6', 'Ativo'),
(7, '7', 'Ativo'),
(8, '8', 'Ativo'),
(9, '9', 'Ativo'),
(10, '11', 'Ativo'),
(11, '12', 'Ativo'),
(12, '10', 'Inativo'),
(13, '4', 'Inativo'),
(14, '15', 'inAtivo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sala`
--

CREATE TABLE `sala` (
  `id` int(11) NOT NULL,
  `nome` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `sala`
--

INSERT INTO `sala` (`id`, `nome`) VALUES
(1, 'Sala001'),
(2, 'sala02'),
(3, 'sala05'),
(4, 'Sala03'),
(5, 'sala04');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario_adm`
--

CREATE TABLE `usuario_adm` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `num_identificacao` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario_adm`
--

INSERT INTO `usuario_adm` (`id`, `nome`, `num_identificacao`) VALUES
(1, 'paulo', 'adcd7048512e64b48da55b027577886ee5a36350'),
(3, 'Paulolima', '1234'),
(4, 'PAULO VITOR BEZERRA DE LIMA', '123'),
(5, 'MatemÃ¡tica', '0012'),
(6, 'lima', '091');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario_professor`
--

CREATE TABLE `usuario_professor` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) CHARACTER SET utf8 NOT NULL,
  `estado` varchar(50) NOT NULL,
  `num_mat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario_professor`
--

INSERT INTO `usuario_professor` (`id`, `nome`, `estado`, `num_mat`) VALUES
(8, 'PAULO VITOR BEZERRA DE LIMA', 'Ativo', '005'),
(9, 'PauloLima', 'Ativo', '0012'),
(10, 'paulo2', 'Ativo', '092'),
(12, 'Alice', 'Ativo', '0012'),
(34, 'pv', 'ativo', '001');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alarme`
--
ALTER TABLE `alarme`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aula`
--
ALTER TABLE `aula`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `disciplina`
--
ALTER TABLE `disciplina`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipamento`
--
ALTER TABLE `equipamento`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cod_porta_UNIQUE` (`cod_porta`),
  ADD KEY `fk_equipamento_porta1_idx` (`cod_porta`);

--
-- Indexes for table `porta`
--
ALTER TABLE `porta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sala`
--
ALTER TABLE `sala`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuario_adm`
--
ALTER TABLE `usuario_adm`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuario_professor`
--
ALTER TABLE `usuario_professor`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alarme`
--
ALTER TABLE `alarme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `aula`
--
ALTER TABLE `aula`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `equipamento`
--
ALTER TABLE `equipamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `porta`
--
ALTER TABLE `porta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `sala`
--
ALTER TABLE `sala`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `usuario_adm`
--
ALTER TABLE `usuario_adm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `usuario_professor`
--
ALTER TABLE `usuario_professor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `equipamento`
--
ALTER TABLE `equipamento`
  ADD CONSTRAINT `fk_equipamento_porta1` FOREIGN KEY (`cod_porta`) REFERENCES `porta` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
