-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30-Set-2020 às 03:38
-- Versão do servidor: 10.4.13-MariaDB
-- versão do PHP: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `boxhub`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `fila_p`
--

CREATE TABLE `fila_p` (
  `ID` int(11) NOT NULL,
  `Senha` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_categoria`
--

CREATE TABLE `tbl_categoria` (
  `id_categoria` int(11) NOT NULL,
  `categoria_c` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbl_categoria`
--

INSERT INTO `tbl_categoria` (`id_categoria`, `categoria_c`) VALUES
(1, 'cat1'),
(2, 'cat2'),
(3, 'cat3'),
(4, 'Anestesia');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_estoque`
--

CREATE TABLE `tbl_estoque` (
  `id_estoque` int(11) NOT NULL,
  `produto_e` varchar(120) DEFAULT NULL,
  `quantidade_e` varchar(100) DEFAULT NULL,
  `valor_un_e` varchar(100) DEFAULT NULL,
  `categoria_e` varchar(100) DEFAULT NULL,
  `marca_e` varchar(100) DEFAULT NULL,
  `unidade_e` varchar(100) DEFAULT NULL,
  `estoque_minimo_e` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbl_estoque`
--

INSERT INTO `tbl_estoque` (`id_estoque`, `produto_e`, `quantidade_e`, `valor_un_e`, `categoria_e`, `marca_e`, `unidade_e`, `estoque_minimo_e`) VALUES
(1, 'Agulha2222222', '12525', '', NULL, NULL, NULL, '300'),
(2, 'Seringa 10ML0000', '300', '', NULL, NULL, NULL, '50'),
(3, 'LUVAS PROC DD', '123', '3.2', NULL, NULL, NULL, '20'),
(9, 'AGULHA 25X7', '500', '24.50', NULL, NULL, NULL, '600'),
(10, 'AGULHA 25X8', '359', '20.00', 'cat2', 'Marca2', 'Uni2', NULL),
(11, 'LUVAS PROC PP', '200', '3.00', 'Anestesia', 'Marca3', 'Uni3', NULL),
(12, 'Propofol', '100', '3.2', 'Anestesia', 'Marca2', 'Uni1', NULL),
(13, 'Acepran 0,2%', '86', '5.00', 'Anestesia', 'Marca2', 'Uni1', NULL),
(14, 'Acepran 1%', '88', '20.50', 'Anestesia', 'Marca1', 'Uni3', NULL),
(15, 'Ácido Tranexâmico', '150', '', 'Anestesia', 'Marca2', 'Uni2', NULL),
(16, 'Adrenalina', '220', '', '', '', '', NULL),
(17, 'Agemoxi', '87', '', 'Anestesia', '', '', NULL),
(18, 'Água de Injeção', '200', '', 'Anestesia', '', '', NULL),
(19, 'Algivet', '19', '12.50', 'Anestesia', '', '', NULL),
(20, 'Ampicilina', '200', '', 'Anestesia', '', '', NULL),
(21, 'Amnofilina', '269', '', 'Anestesia', '', '', NULL),
(22, 'Antropina', '66', '', 'Anestesia', '', '', NULL),
(23, 'Cefalotina', '100', '', 'Anestesia', '', '', NULL),
(24, 'Cefalozina', '130', '', 'Anestesia', '', '', NULL),
(25, 'Cefitriaxona', '100', '', 'Anestesia', '', '', NULL),
(26, 'Cetamina', '100', '', 'Anestesia', '', '', NULL),
(27, 'Cloreto de potássio 10%', '100', '', 'Anestesia', '', '', NULL),
(28, 'Cloreto de sódio', '100', '', 'Anestesia', '', '', NULL),
(29, 'Dexametasona', '200', '', 'Anestesia', '', '', NULL),
(30, 'Diazepam', '100', '', 'Anestesia', '', '', NULL),
(31, 'Dobutamina', '100', '', 'Anestesia', '', '', NULL),
(32, 'reinaldo', '', '', '', '', '', NULL),
(33, 'produto teste 333', '100', '0.50', 'Anestesia', 'Marca2', 'Uni1', '30'),
(34, '', '0', '', NULL, NULL, NULL, ''),
(35, 'reinaldo teste', '500', '25.5', NULL, NULL, NULL, '100'),
(36, 'aaaa', '3423', '', NULL, NULL, NULL, '2342');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_fornecedores`
--

CREATE TABLE `tbl_fornecedores` (
  `id_fornecedor` int(11) NOT NULL,
  `nome_fornecedor` varchar(255) DEFAULT NULL,
  `contato_fornecedor` varchar(255) DEFAULT NULL,
  `email_fornecedor` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbl_fornecedores`
--

INSERT INTO `tbl_fornecedores` (`id_fornecedor`, `nome_fornecedor`, `contato_fornecedor`, `email_fornecedor`) VALUES
(6, 'reinaldo', '1231231', 'werwe@gmail.com'),
(7, 'pedro', '12312', 'rwerw@gmail.com11111111111'),
(8, 'Castro Comércio', '1231231', 'rwerw@gmail.com');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_items_compra`
--

CREATE TABLE `tbl_items_compra` (
  `id_item_compra` int(11) NOT NULL,
  `item_compra` int(11) DEFAULT NULL,
  `ordem_compra_id` int(11) DEFAULT NULL,
  `qtde_compra` int(11) DEFAULT NULL,
  `valor_un_c` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_itens_nf`
--

CREATE TABLE `tbl_itens_nf` (
  `id_itens` int(11) NOT NULL,
  `item_nf` int(11) DEFAULT NULL,
  `qtde_nf` varchar(100) DEFAULT NULL,
  `lote_e` varchar(100) DEFAULT NULL,
  `validade_prod_nf` date DEFAULT NULL,
  `id_nf` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_marca`
--

CREATE TABLE `tbl_marca` (
  `id_marca` int(11) NOT NULL,
  `marca_m` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbl_marca`
--

INSERT INTO `tbl_marca` (`id_marca`, `marca_m`) VALUES
(1, 'Marca1'),
(2, 'Marca2'),
(3, 'Marca3');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_nf`
--

CREATE TABLE `tbl_nf` (
  `id_nf` int(11) NOT NULL,
  `numero_nf` varchar(120) DEFAULT NULL,
  `data_emissao` date DEFAULT NULL,
  `data_lancamento` date DEFAULT NULL,
  `fornecedor` varchar(120) DEFAULT NULL,
  `valor_nf` varchar(100) DEFAULT NULL,
  `obs_nf` text DEFAULT NULL,
  `status_nf` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_ordem_compra`
--

CREATE TABLE `tbl_ordem_compra` (
  `id_ordem` int(11) NOT NULL,
  `nome_f` varchar(255) DEFAULT NULL,
  `data_c` timestamp NULL DEFAULT NULL,
  `id_fk_nf` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbl_ordem_compra`
--

INSERT INTO `tbl_ordem_compra` (`id_ordem`, `nome_f`, `data_c`, `id_fk_nf`) VALUES
(31, 'Castro Comércio', '2020-09-30 00:47:26', 10);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_prontuarios`
--

CREATE TABLE `tbl_prontuarios` (
  `id_p` int(11) NOT NULL,
  `prontuario_p` int(11) NOT NULL,
  `animal_p` varchar(50) DEFAULT NULL,
  `proprietario_p` varchar(50) NOT NULL,
  `documento_p` varchar(30) NOT NULL,
  `contato_p` varchar(50) DEFAULT NULL,
  `endereco_p` text DEFAULT NULL,
  `data_p` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_saida`
--

CREATE TABLE `tbl_saida` (
  `id_saida` int(11) NOT NULL,
  `item_s` int(11) DEFAULT NULL,
  `quantidade_s` varchar(100) DEFAULT NULL,
  `setor_s` varchar(100) DEFAULT NULL,
  `data_s` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `data_dia_s` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbl_saida`
--

INSERT INTO `tbl_saida` (`id_saida`, `item_s`, `quantidade_s`, `setor_s`, `data_s`, `data_dia_s`) VALUES
(1, 13, '2', 'Infecto', '2019-12-20 18:57:12', '2019-12-20'),
(2, 13, '5', 'Infecto', '2019-12-20 18:57:20', '2019-12-20'),
(3, 13, '6', 'Infecto', '2019-12-20 18:57:22', '2019-12-20'),
(4, 13, '2', 'Infecto', '2019-12-20 18:57:24', '2019-12-20'),
(5, 14, '2', 'Infecto', '2019-12-23 13:25:11', '2019-12-23'),
(6, 9, '3', 'Infecto', '2019-12-23 13:25:13', '2019-12-23'),
(7, 19, '10', 'Infecto', '2019-12-23 13:25:15', '2019-12-23'),
(8, 13, '30', 'Infecto', '2019-12-23 13:25:22', '2019-12-23'),
(9, 34, '', 'Ambulatório', '2020-09-24 23:15:33', '2020-09-24'),
(10, 14, '10', 'Centro-Cirúrgico', '2020-09-30 01:07:16', '2020-09-29'),
(11, 17, '20', 'Centro-Cirúrgico', '2020-09-30 01:07:19', '2020-09-29'),
(12, 9, '50', 'Centro-Cirúrgico', '2020-09-30 01:07:21', '2020-09-29');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_setores`
--

CREATE TABLE `tbl_setores` (
  `id_setor` int(11) NOT NULL,
  `setor_s` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbl_setores`
--

INSERT INTO `tbl_setores` (`id_setor`, `setor_s`) VALUES
(1, 'Infecto'),
(2, 'Centro-Cirúrgico'),
(3, 'Ambulatório'),
(4, 'Internação');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_solicitacoes`
--

CREATE TABLE `tbl_solicitacoes` (
  `id_req` int(11) NOT NULL,
  `item_req` varchar(200) DEFAULT NULL,
  `qtde_req` varchar(20) DEFAULT NULL,
  `setor_req` varchar(50) DEFAULT NULL,
  `data_req` timestamp NULL DEFAULT NULL,
  `solicitante_req` varchar(50) DEFAULT NULL,
  `status_req` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbl_solicitacoes`
--

INSERT INTO `tbl_solicitacoes` (`id_req`, `item_req`, `qtde_req`, `setor_req`, `data_req`, `solicitante_req`, `status_req`) VALUES
(21, '19', '12', 'Ambulatório-Canino', '2019-12-16 14:31:43', '027981', '1'),
(22, '9', '10', 'Centro-Cirúrgico', '2020-01-03 20:56:03', '027981', '0');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_un_medida`
--

CREATE TABLE `tbl_un_medida` (
  `id_medidas` int(11) NOT NULL,
  `un_medida` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbl_un_medida`
--

INSERT INTO `tbl_un_medida` (`id_medidas`, `un_medida`) VALUES
(1, 'Uni1'),
(3, 'Uni2'),
(4, 'Uni3');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_usuarios`
--

CREATE TABLE `tbl_usuarios` (
  `id_user` int(11) NOT NULL,
  `nome_user` varchar(50) DEFAULT NULL,
  `cod_user` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbl_usuarios`
--

INSERT INTO `tbl_usuarios` (`id_user`, `nome_user`, `cod_user`, `password`) VALUES
(1, 'farma.hvu', NULL, '123'),
(2, 'compras.hvu', NULL, '123'),
(3, 'tatiane_a.hvu', NULL, 'tatiane123');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tbl_categoria`
--
ALTER TABLE `tbl_categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Índices para tabela `tbl_estoque`
--
ALTER TABLE `tbl_estoque`
  ADD PRIMARY KEY (`id_estoque`);

--
-- Índices para tabela `tbl_fornecedores`
--
ALTER TABLE `tbl_fornecedores`
  ADD PRIMARY KEY (`id_fornecedor`);

--
-- Índices para tabela `tbl_items_compra`
--
ALTER TABLE `tbl_items_compra`
  ADD PRIMARY KEY (`id_item_compra`);

--
-- Índices para tabela `tbl_itens_nf`
--
ALTER TABLE `tbl_itens_nf`
  ADD PRIMARY KEY (`id_itens`),
  ADD KEY `tbl_itens_nf_fk0` (`item_nf`),
  ADD KEY `tbl_itens_nf_fk1` (`id_nf`);

--
-- Índices para tabela `tbl_marca`
--
ALTER TABLE `tbl_marca`
  ADD PRIMARY KEY (`id_marca`);

--
-- Índices para tabela `tbl_nf`
--
ALTER TABLE `tbl_nf`
  ADD PRIMARY KEY (`id_nf`);

--
-- Índices para tabela `tbl_ordem_compra`
--
ALTER TABLE `tbl_ordem_compra`
  ADD PRIMARY KEY (`id_ordem`);

--
-- Índices para tabela `tbl_saida`
--
ALTER TABLE `tbl_saida`
  ADD PRIMARY KEY (`id_saida`),
  ADD KEY `tbl_saida_fk0` (`item_s`);

--
-- Índices para tabela `tbl_setores`
--
ALTER TABLE `tbl_setores`
  ADD PRIMARY KEY (`id_setor`);

--
-- Índices para tabela `tbl_solicitacoes`
--
ALTER TABLE `tbl_solicitacoes`
  ADD PRIMARY KEY (`id_req`);

--
-- Índices para tabela `tbl_un_medida`
--
ALTER TABLE `tbl_un_medida`
  ADD PRIMARY KEY (`id_medidas`);

--
-- Índices para tabela `tbl_usuarios`
--
ALTER TABLE `tbl_usuarios`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tbl_categoria`
--
ALTER TABLE `tbl_categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `tbl_estoque`
--
ALTER TABLE `tbl_estoque`
  MODIFY `id_estoque` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de tabela `tbl_fornecedores`
--
ALTER TABLE `tbl_fornecedores`
  MODIFY `id_fornecedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `tbl_items_compra`
--
ALTER TABLE `tbl_items_compra`
  MODIFY `id_item_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `tbl_itens_nf`
--
ALTER TABLE `tbl_itens_nf`
  MODIFY `id_itens` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `tbl_marca`
--
ALTER TABLE `tbl_marca`
  MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `tbl_nf`
--
ALTER TABLE `tbl_nf`
  MODIFY `id_nf` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `tbl_ordem_compra`
--
ALTER TABLE `tbl_ordem_compra`
  MODIFY `id_ordem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de tabela `tbl_saida`
--
ALTER TABLE `tbl_saida`
  MODIFY `id_saida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `tbl_setores`
--
ALTER TABLE `tbl_setores`
  MODIFY `id_setor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `tbl_solicitacoes`
--
ALTER TABLE `tbl_solicitacoes`
  MODIFY `id_req` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `tbl_un_medida`
--
ALTER TABLE `tbl_un_medida`
  MODIFY `id_medidas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `tbl_usuarios`
--
ALTER TABLE `tbl_usuarios`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `tbl_itens_nf`
--
ALTER TABLE `tbl_itens_nf`
  ADD CONSTRAINT `tbl_itens_nf_fk0` FOREIGN KEY (`item_nf`) REFERENCES `tbl_estoque` (`id_estoque`),
  ADD CONSTRAINT `tbl_itens_nf_fk1` FOREIGN KEY (`id_nf`) REFERENCES `tbl_nf` (`id_nf`);

--
-- Limitadores para a tabela `tbl_saida`
--
ALTER TABLE `tbl_saida`
  ADD CONSTRAINT `tbl_saida_fk0` FOREIGN KEY (`item_s`) REFERENCES `tbl_estoque` (`id_estoque`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
