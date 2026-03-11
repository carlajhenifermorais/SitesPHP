-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 12/02/2026 às 04:14
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
-- Banco de dados: `mystore`
--

DELIMITER $$
--
-- Procedimentos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `gerar_vendas_2026_com_itens` ()   BEGIN
    DECLARE i INT DEFAULT 1;
    DECLARE total_itens INT;
    DECLARE j INT;
    DECLARE venda_id INT;
    DECLARE produto_aleatorio INT;
    DECLARE preco_prod DECIMAL(10,2);

    WHILE i <= 100 DO

        -- Criar venda
        INSERT INTO venda (cliente_id, usuario_id, data_venda)
        VALUES (
            FLOOR(1 + (RAND() * 10)), -- cliente 1 a 10
            FLOOR(1 + (RAND() * 3)),  -- usuario 1 a 3
            TIMESTAMP(
                DATE_ADD('2026-01-01', INTERVAL FLOOR(RAND() * 365) DAY),
                SEC_TO_TIME(FLOOR(RAND() * 86400))
            )
        );

        -- Capturar id da venda criada
        SET venda_id = LAST_INSERT_ID();

        -- Definir quantidade de itens (1 a 7)
        SET total_itens = FLOOR(1 + (RAND() * 7));

        SET j = 1;

        WHILE j <= total_itens DO

            -- Produto aleatório (1 a 15)
            SET produto_aleatorio = FLOOR(1 + (RAND() * 15));

            -- Buscar preço do produto
            SELECT preco INTO preco_prod
            FROM produto
            WHERE id = produto_aleatorio;

            -- Inserir item da venda
            INSERT INTO item_venda (venda_id, produto_id, quantidade, preco_unitario)
            VALUES (
                venda_id,
                produto_aleatorio,
                FLOOR(1 + (RAND() * 5)), -- quantidade 1 a 5
                preco_prod
            );

            SET j = j + 1;

        END WHILE;

        SET i = i + 1;

    END WHILE;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `categoria`
--

INSERT INTO `categoria` (`id`, `nome`, `descricao`) VALUES
(1, 'Eletrônicos', 'Produtos eletrônicos como celulares, notebooks, acessórios e periféricos'),
(2, 'Informática', 'Computadores, componentes, impressoras e suprimentos de TI'),
(3, 'Eletrodomésticos', 'Produtos para uso doméstico como micro-ondas, liquidificadores e geladeiras'),
(4, 'Móveis', 'Móveis residenciais e comerciais como mesas, cadeiras e armários'),
(5, 'Papelaria', 'Materiais escolares e de escritório como cadernos, canetas e agendas');

-- --------------------------------------------------------

--
-- Estrutura para tabela `categoria_produto`
--

CREATE TABLE `categoria_produto` (
  `id` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `categoria_produto`
--

INSERT INTO `categoria_produto` (`id`, `categoria_id`, `produto_id`) VALUES
(1, 1, 1),
(2, 1, 3),
(3, 2, 2),
(4, 2, 4),
(5, 2, 10),
(6, 2, 11),
(7, 3, 5),
(8, 3, 6),
(9, 3, 15),
(10, 4, 7),
(11, 4, 8),
(12, 4, 9),
(13, 5, 12),
(14, 5, 13),
(15, 5, 14);

-- --------------------------------------------------------

--
-- Estrutura para tabela `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `endereco` text NOT NULL,
  `cep` varchar(20) NOT NULL,
  `data_cadastro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cliente`
--

INSERT INTO `cliente` (`id`, `nome`, `cpf`, `email`, `telefone`, `endereco`, `cep`, `data_cadastro`) VALUES
(1, 'João Pedro Almeida', '123.456.789-01', 'jp.almeida87@terra.com.br', '(31) 98871-2345', 'Rua das Acácias, 145, Belo Horizonte - MG', '30130-110', '2026-02-12 03:11:50'),
(2, 'Mariana Costa Ribeiro', '234.567.890-12', 'mary.c.ribeiro@bol.com.br', '(31) 99123-4567', 'Av. Amazonas, 980, Contagem - MG', '32310-080', '2026-02-12 03:11:50'),
(3, 'Lucas Henrique Martins', '345.678.901-23', 'lucas.h.martins@live.com', '(31) 98456-7890', 'Rua Padre Eustáquio, 320, Belo Horizonte - MG', '30720-400', '2026-02-12 03:11:50'),
(4, 'Fernanda Oliveira Souza', '456.789.012-34', 'fe_souza22@gmail.com', '(31) 99745-1122', 'Rua do Ouro, 77, Sabará - MG', '34505-320', '2026-02-12 03:11:50'),
(5, 'Rafael Gomes Pereira', '567.890.123-45', 'rgpereira@uol.com.br', '(31) 98888-3344', 'Av. Cristiano Machado, 4500, Belo Horizonte - MG', '31160-900', '2026-02-12 03:11:50'),
(6, 'Camila Andrade Lima', '678.901.234-56', 'camila.andrade.lima@icloud.com', '(31) 99661-7788', 'Rua Tiradentes, 210, Betim - MG', '32600-120', '2026-02-12 03:11:50'),
(7, 'Bruno Carvalho Mendes', '789.012.345-67', 'bruno_cmendes@protonmail.com', '(31) 98321-9900', 'Av. João César de Oliveira, 1500, Contagem - MG', '32280-180', '2026-02-12 03:11:50'),
(8, 'Patrícia Fernandes Rocha', '890.123.456-78', 'paty.rocha1989@yahoo.com', '(31) 99234-5566', 'Rua Aimorés, 630, Belo Horizonte - MG', '30140-071', '2026-02-12 03:11:50'),
(9, 'Diego Santos Barbosa', '901.234.567-89', 'd.sbarbosa@outlook.com.br', '(31) 98111-2233', 'Rua São Paulo, 890, Belo Horizonte - MG', '30170-130', '2026-02-12 03:11:50'),
(10, 'Juliana Teixeira Moraes', '012.345.678-90', 'julianatm_93@me.com', '(31) 99567-8899', 'Av. Afonso Pena, 1200, Belo Horizonte - MG', '30130-003', '2026-02-12 03:11:50');

-- --------------------------------------------------------

--
-- Estrutura para tabela `item_venda`
--

CREATE TABLE `item_venda` (
  `id` int(11) NOT NULL,
  `venda_id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `preco_unitario` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `item_venda`
--

INSERT INTO `item_venda` (`id`, `venda_id`, `produto_id`, `quantidade`, `preco_unitario`) VALUES
(1, 1, 6, 3, 2899.00),
(2, 2, 15, 2, 189.90),
(3, 2, 11, 3, 79.90),
(4, 2, 15, 4, 189.90),
(5, 2, 10, 1, 350.00),
(6, 2, 6, 4, 2899.00),
(7, 2, 7, 5, 450.00),
(8, 2, 5, 4, 599.00),
(9, 3, 1, 2, 1199.90),
(10, 4, 13, 3, 2.50),
(11, 4, 2, 5, 3499.00),
(12, 4, 1, 3, 1199.90),
(13, 4, 9, 2, 650.00),
(14, 5, 5, 5, 599.00),
(15, 5, 9, 1, 650.00),
(16, 5, 15, 3, 189.90),
(17, 5, 10, 4, 350.00),
(18, 5, 9, 4, 650.00),
(19, 6, 8, 1, 899.90),
(20, 6, 10, 1, 350.00),
(21, 7, 9, 5, 650.00),
(22, 7, 6, 5, 2899.00),
(23, 8, 3, 5, 299.90),
(24, 8, 4, 1, 499.90),
(25, 8, 2, 1, 3499.00),
(26, 9, 8, 5, 899.90),
(27, 9, 2, 5, 3499.00),
(28, 9, 13, 4, 2.50),
(29, 9, 15, 4, 189.90),
(30, 10, 2, 5, 3499.00),
(31, 10, 2, 5, 3499.00),
(32, 10, 2, 5, 3499.00),
(33, 10, 12, 3, 29.90),
(34, 10, 5, 5, 599.00),
(35, 10, 5, 1, 599.00),
(36, 10, 3, 5, 299.90),
(37, 11, 10, 1, 350.00),
(38, 11, 1, 3, 1199.90),
(39, 11, 2, 1, 3499.00),
(40, 12, 13, 5, 2.50),
(41, 12, 4, 3, 499.90),
(42, 12, 11, 1, 79.90),
(43, 13, 10, 2, 350.00),
(44, 13, 2, 2, 3499.00),
(45, 14, 10, 1, 350.00),
(46, 14, 9, 3, 650.00),
(47, 14, 8, 2, 899.90),
(48, 14, 2, 3, 3499.00),
(49, 14, 15, 3, 189.90),
(50, 15, 2, 4, 3499.00),
(51, 15, 8, 2, 899.90),
(52, 16, 6, 5, 2899.00),
(53, 16, 13, 1, 2.50),
(54, 16, 14, 2, 49.90),
(55, 17, 5, 2, 599.00),
(56, 17, 5, 4, 599.00),
(57, 17, 1, 5, 1199.90),
(58, 17, 6, 1, 2899.00),
(59, 17, 13, 3, 2.50),
(60, 17, 3, 1, 299.90),
(61, 18, 5, 5, 599.00),
(62, 18, 3, 2, 299.90),
(63, 18, 12, 1, 29.90),
(64, 18, 2, 2, 3499.00),
(65, 18, 2, 4, 3499.00),
(66, 18, 4, 5, 499.90),
(67, 18, 4, 2, 499.90),
(68, 19, 9, 3, 650.00),
(69, 19, 1, 3, 1199.90),
(70, 19, 4, 5, 499.90),
(71, 19, 8, 5, 899.90),
(72, 19, 13, 4, 2.50),
(73, 19, 1, 1, 1199.90),
(74, 20, 5, 1, 599.00),
(75, 20, 11, 1, 79.90),
(76, 20, 10, 5, 350.00),
(77, 20, 3, 2, 299.90),
(78, 21, 15, 3, 189.90),
(79, 21, 14, 5, 49.90),
(80, 21, 9, 2, 650.00),
(81, 21, 14, 3, 49.90),
(82, 21, 15, 1, 189.90),
(83, 21, 12, 3, 29.90),
(84, 22, 13, 2, 2.50),
(85, 22, 7, 1, 450.00),
(86, 22, 8, 1, 899.90),
(87, 22, 12, 4, 29.90),
(88, 22, 5, 2, 599.00),
(89, 22, 6, 1, 2899.00),
(90, 22, 4, 1, 499.90),
(91, 23, 6, 2, 2899.00),
(92, 23, 7, 2, 450.00),
(93, 23, 8, 3, 899.90),
(94, 23, 8, 2, 899.90),
(95, 24, 5, 2, 599.00),
(96, 24, 4, 2, 499.90),
(97, 24, 4, 1, 499.90),
(98, 24, 6, 4, 2899.00),
(99, 25, 10, 3, 350.00),
(100, 25, 4, 4, 499.90),
(101, 25, 4, 5, 499.90),
(102, 25, 6, 3, 2899.00),
(103, 25, 6, 2, 2899.00),
(104, 25, 2, 4, 3499.00),
(105, 25, 7, 1, 450.00),
(106, 26, 9, 2, 650.00),
(107, 26, 3, 4, 299.90),
(108, 27, 10, 3, 350.00),
(109, 27, 13, 3, 2.50),
(110, 27, 6, 1, 2899.00),
(111, 27, 6, 4, 2899.00),
(112, 28, 6, 5, 2899.00),
(113, 28, 6, 1, 2899.00),
(114, 28, 3, 4, 299.90),
(115, 29, 10, 1, 350.00),
(116, 29, 4, 1, 499.90),
(117, 29, 6, 5, 2899.00),
(118, 30, 15, 4, 189.90),
(119, 31, 13, 2, 2.50),
(120, 31, 1, 1, 1199.90),
(121, 31, 8, 2, 899.90),
(122, 31, 13, 3, 2.50),
(123, 31, 11, 2, 79.90),
(124, 31, 3, 5, 299.90),
(125, 31, 1, 3, 1199.90),
(126, 32, 10, 4, 350.00),
(127, 32, 4, 1, 499.90),
(128, 32, 4, 4, 499.90),
(129, 32, 9, 5, 650.00),
(130, 33, 5, 4, 599.00),
(131, 33, 14, 2, 49.90),
(132, 33, 13, 2, 2.50),
(133, 33, 1, 2, 1199.90),
(134, 33, 1, 4, 1199.90),
(135, 33, 13, 2, 2.50),
(136, 33, 3, 5, 299.90),
(137, 34, 9, 5, 650.00),
(138, 35, 8, 5, 899.90),
(139, 35, 7, 1, 450.00),
(140, 36, 1, 1, 1199.90),
(141, 37, 15, 1, 189.90),
(142, 37, 2, 5, 3499.00),
(143, 37, 7, 2, 450.00),
(144, 37, 15, 1, 189.90),
(145, 38, 2, 5, 3499.00),
(146, 38, 1, 4, 1199.90),
(147, 38, 8, 2, 899.90),
(148, 38, 13, 2, 2.50),
(149, 38, 2, 4, 3499.00),
(150, 38, 12, 1, 29.90),
(151, 39, 7, 5, 450.00),
(152, 40, 4, 3, 499.90),
(153, 40, 5, 1, 599.00),
(154, 40, 14, 1, 49.90),
(155, 41, 7, 2, 450.00),
(156, 41, 1, 3, 1199.90),
(157, 41, 15, 3, 189.90),
(158, 42, 5, 4, 599.00),
(159, 42, 3, 1, 299.90),
(160, 43, 12, 3, 29.90),
(161, 43, 14, 1, 49.90),
(162, 43, 4, 3, 499.90),
(163, 43, 4, 2, 499.90),
(164, 43, 13, 2, 2.50),
(165, 43, 14, 4, 49.90),
(166, 44, 13, 3, 2.50),
(167, 44, 9, 3, 650.00),
(168, 44, 5, 4, 599.00),
(169, 44, 4, 3, 499.90),
(170, 44, 7, 5, 450.00),
(171, 45, 14, 5, 49.90),
(172, 45, 3, 5, 299.90),
(173, 45, 1, 2, 1199.90),
(174, 45, 9, 5, 650.00),
(175, 46, 15, 5, 189.90),
(176, 46, 4, 5, 499.90),
(177, 46, 5, 1, 599.00),
(178, 47, 6, 2, 2899.00),
(179, 47, 10, 1, 350.00),
(180, 47, 6, 4, 2899.00),
(181, 47, 8, 3, 899.90),
(182, 48, 7, 1, 450.00),
(183, 49, 2, 2, 3499.00),
(184, 49, 6, 5, 2899.00),
(185, 49, 2, 5, 3499.00),
(186, 49, 9, 5, 650.00),
(187, 49, 8, 1, 899.90),
(188, 50, 7, 4, 450.00),
(189, 50, 15, 4, 189.90),
(190, 50, 14, 2, 49.90),
(191, 50, 12, 5, 29.90),
(192, 50, 13, 4, 2.50),
(193, 50, 13, 2, 2.50),
(194, 50, 1, 2, 1199.90),
(195, 51, 14, 5, 49.90),
(196, 51, 5, 5, 599.00),
(197, 51, 15, 5, 189.90),
(198, 51, 1, 1, 1199.90),
(199, 51, 5, 2, 599.00),
(200, 52, 11, 5, 79.90),
(201, 52, 4, 3, 499.90),
(202, 52, 15, 2, 189.90),
(203, 52, 14, 2, 49.90),
(204, 52, 11, 3, 79.90),
(205, 52, 14, 4, 49.90),
(206, 52, 8, 3, 899.90),
(207, 53, 2, 4, 3499.00),
(208, 53, 2, 2, 3499.00),
(209, 53, 9, 5, 650.00),
(210, 54, 6, 1, 2899.00),
(211, 54, 7, 5, 450.00),
(212, 54, 1, 3, 1199.90),
(213, 54, 1, 1, 1199.90),
(214, 54, 13, 2, 2.50),
(215, 54, 14, 4, 49.90),
(216, 54, 8, 4, 899.90),
(217, 55, 14, 5, 49.90),
(218, 55, 3, 5, 299.90),
(219, 56, 4, 1, 499.90),
(220, 56, 4, 1, 499.90),
(221, 56, 8, 3, 899.90),
(222, 56, 12, 3, 29.90),
(223, 56, 13, 5, 2.50),
(224, 56, 7, 1, 450.00),
(225, 57, 1, 2, 1199.90),
(226, 57, 4, 2, 499.90),
(227, 57, 11, 4, 79.90),
(228, 58, 3, 2, 299.90),
(229, 58, 6, 4, 2899.00),
(230, 58, 5, 3, 599.00),
(231, 58, 13, 4, 2.50),
(232, 59, 3, 3, 299.90),
(233, 59, 5, 5, 599.00),
(234, 59, 6, 1, 2899.00),
(235, 60, 6, 5, 2899.00),
(236, 60, 11, 4, 79.90),
(237, 60, 6, 5, 2899.00),
(238, 60, 1, 3, 1199.90),
(239, 60, 9, 2, 650.00),
(240, 60, 6, 2, 2899.00),
(241, 60, 10, 1, 350.00),
(242, 61, 10, 3, 350.00),
(243, 61, 11, 1, 79.90),
(244, 62, 10, 4, 350.00),
(245, 63, 5, 3, 599.00),
(246, 63, 13, 3, 2.50),
(247, 63, 13, 4, 2.50),
(248, 64, 9, 1, 650.00),
(249, 64, 15, 3, 189.90),
(250, 64, 10, 4, 350.00),
(251, 64, 3, 5, 299.90),
(252, 65, 2, 1, 3499.00),
(253, 66, 2, 5, 3499.00),
(254, 66, 3, 1, 299.90),
(255, 66, 6, 3, 2899.00),
(256, 66, 15, 3, 189.90),
(257, 67, 10, 3, 350.00),
(258, 67, 10, 3, 350.00),
(259, 67, 14, 5, 49.90),
(260, 67, 10, 3, 350.00),
(261, 68, 2, 2, 3499.00),
(262, 68, 7, 1, 450.00),
(263, 68, 10, 4, 350.00),
(264, 68, 10, 1, 350.00),
(265, 68, 6, 3, 2899.00),
(266, 69, 13, 4, 2.50),
(267, 69, 13, 2, 2.50),
(268, 70, 6, 5, 2899.00),
(269, 70, 8, 4, 899.90),
(270, 70, 13, 2, 2.50),
(271, 71, 11, 2, 79.90),
(272, 71, 4, 3, 499.90),
(273, 71, 12, 1, 29.90),
(274, 71, 10, 3, 350.00),
(275, 71, 2, 4, 3499.00),
(276, 71, 3, 5, 299.90),
(277, 72, 13, 4, 2.50),
(278, 72, 5, 1, 599.00),
(279, 72, 10, 5, 350.00),
(280, 72, 7, 3, 450.00),
(281, 73, 12, 3, 29.90),
(282, 73, 4, 4, 499.90),
(283, 73, 6, 5, 2899.00),
(284, 73, 14, 2, 49.90),
(285, 73, 3, 5, 299.90),
(286, 73, 12, 1, 29.90),
(287, 74, 15, 5, 189.90),
(288, 74, 5, 5, 599.00),
(289, 74, 13, 3, 2.50),
(290, 74, 9, 3, 650.00),
(291, 74, 10, 5, 350.00),
(292, 75, 12, 4, 29.90),
(293, 75, 6, 4, 2899.00),
(294, 75, 3, 5, 299.90),
(295, 76, 13, 2, 2.50),
(296, 76, 4, 2, 499.90),
(297, 77, 7, 1, 450.00),
(298, 78, 8, 1, 899.90),
(299, 78, 12, 4, 29.90),
(300, 79, 11, 4, 79.90),
(301, 79, 4, 1, 499.90),
(302, 79, 15, 2, 189.90),
(303, 80, 8, 3, 899.90),
(304, 80, 14, 1, 49.90),
(305, 80, 6, 4, 2899.00),
(306, 80, 12, 3, 29.90),
(307, 80, 3, 3, 299.90),
(308, 81, 13, 2, 2.50),
(309, 82, 10, 5, 350.00),
(310, 82, 9, 2, 650.00),
(311, 82, 8, 4, 899.90),
(312, 82, 1, 5, 1199.90),
(313, 82, 12, 1, 29.90),
(314, 82, 13, 1, 2.50),
(315, 83, 11, 3, 79.90),
(316, 83, 12, 2, 29.90),
(317, 83, 13, 2, 2.50),
(318, 83, 2, 4, 3499.00),
(319, 83, 12, 5, 29.90),
(320, 84, 1, 3, 1199.90),
(321, 84, 11, 5, 79.90),
(322, 85, 12, 5, 29.90),
(323, 85, 8, 4, 899.90),
(324, 85, 10, 2, 350.00),
(325, 85, 3, 2, 299.90),
(326, 85, 9, 2, 650.00),
(327, 85, 12, 5, 29.90),
(328, 85, 2, 5, 3499.00),
(329, 86, 12, 1, 29.90),
(330, 86, 3, 4, 299.90),
(331, 86, 9, 1, 650.00),
(332, 86, 12, 3, 29.90),
(333, 87, 5, 5, 599.00),
(334, 87, 15, 5, 189.90),
(335, 87, 12, 5, 29.90),
(336, 87, 9, 5, 650.00),
(337, 88, 2, 2, 3499.00),
(338, 88, 11, 2, 79.90),
(339, 88, 3, 2, 299.90),
(340, 88, 10, 3, 350.00),
(341, 88, 13, 3, 2.50),
(342, 89, 13, 4, 2.50),
(343, 89, 2, 2, 3499.00),
(344, 90, 3, 1, 299.90),
(345, 90, 8, 2, 899.90),
(346, 90, 6, 4, 2899.00),
(347, 91, 12, 5, 29.90),
(348, 91, 10, 2, 350.00),
(349, 91, 5, 5, 599.00),
(350, 91, 5, 5, 599.00),
(351, 91, 13, 2, 2.50),
(352, 91, 2, 3, 3499.00),
(353, 91, 1, 4, 1199.90),
(354, 92, 10, 2, 350.00),
(355, 92, 8, 5, 899.90),
(356, 92, 7, 5, 450.00),
(357, 92, 15, 2, 189.90),
(358, 92, 11, 3, 79.90),
(359, 92, 6, 3, 2899.00),
(360, 92, 15, 3, 189.90),
(361, 93, 1, 4, 1199.90),
(362, 94, 1, 4, 1199.90),
(363, 94, 2, 4, 3499.00),
(364, 94, 5, 2, 599.00),
(365, 94, 4, 3, 499.90),
(366, 95, 2, 1, 3499.00),
(367, 95, 11, 1, 79.90),
(368, 95, 2, 2, 3499.00),
(369, 95, 2, 3, 3499.00),
(370, 95, 10, 3, 350.00),
(371, 95, 4, 5, 499.90),
(372, 96, 15, 2, 189.90),
(373, 96, 6, 1, 2899.00),
(374, 97, 13, 5, 2.50),
(375, 98, 11, 2, 79.90),
(376, 99, 15, 3, 189.90),
(377, 99, 6, 4, 2899.00),
(378, 99, 15, 5, 189.90),
(379, 99, 5, 1, 599.00),
(380, 100, 8, 1, 899.90),
(381, 100, 8, 3, 899.90);

-- --------------------------------------------------------

--
-- Estrutura para tabela `produto`
--

CREATE TABLE `produto` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` text NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `estoque` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `ativo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produto`
--

INSERT INTO `produto` (`id`, `nome`, `descricao`, `preco`, `estoque`, `categoria_id`, `ativo`) VALUES
(1, 'Smartphone Galaxy A15', 'Smartphone com 128GB de armazenamento interno, 4GB de memória RAM, processador Octa-Core, tela infinita de 6.5 polegadas HD+, câmera traseira tripla de alta resolução e bateria de longa duração de 5000mAh. Ideal para redes sociais, fotos e uso diário.', 1199.90, 25, 1, 1),
(2, 'Notebook Dell Inspiron 15', 'Notebook equipado com processador Intel Core i5 de última geração, 8GB de memória RAM expansível, SSD de 256GB para inicialização rápida, tela Full HD de 15.6 polegadas e sistema Windows 11. Indicado para estudos, trabalho e tarefas profissionais.', 3499.00, 10, 2, 1),
(3, 'Fone de Ouvido Bluetooth JBL', 'Fone de ouvido sem fio com tecnologia Bluetooth 5.0, cancelamento de ruído ativo, bateria com duração de até 20 horas e microfone embutido para chamadas. Design confortável e som de alta qualidade com graves intensos.', 299.90, 40, 1, 1),
(4, 'Impressora HP DeskJet 2774', 'Impressora multifuncional com funções de impressão, cópia e digitalização, conectividade Wi-Fi, compatível com aplicativo HP Smart e impressão direta pelo smartphone. Ideal para uso doméstico e pequenos escritórios.', 499.90, 15, 2, 1),
(5, 'Micro-ondas 20L Electrolux', 'Micro-ondas com capacidade de 20 litros, painel digital intuitivo, diversas receitas pré-programadas, função descongelar e potência ajustável. Design compacto e moderno para cozinhas residenciais.', 599.00, 12, 3, 1),
(6, 'Geladeira Brastemp 375L', 'Geladeira frost free com capacidade total de 375 litros, duas portas, controle eletrônico de temperatura, compartimentos especiais para frutas e legumes e sistema de economia de energia. Ideal para famílias de médio porte.', 2899.00, 5, 3, 1),
(7, 'Mesa de Escritório 120cm', 'Mesa para escritório produzida em MDF de alta resistência, acabamento em pintura UV, com 120cm de largura, espaço para computador e organização de materiais. Ideal para ambientes corporativos ou home office.', 450.00, 8, 4, 1),
(8, 'Cadeira Gamer Reclinável', 'Cadeira ergonômica com ajuste de altura, encosto reclinável até 180 graus, apoio para braços ajustável, base giratória com rodízios reforçados e revestimento em couro sintético. Proporciona conforto para longas horas de uso.', 899.90, 6, 4, 1),
(9, 'Armário Multiuso 2 Portas', 'Armário organizador com duas portas, prateleiras internas ajustáveis, fabricado em madeira MDF com acabamento resistente. Indicado para quartos, escritórios ou áreas de serviço.', 650.00, 9, 4, 1),
(10, 'Teclado Mecânico RGB', 'Teclado mecânico gamer com switches azuis de alta durabilidade, iluminação RGB personalizável, estrutura reforçada em metal e conexão USB plug and play. Ideal para jogos e digitação intensa.', 350.00, 20, 2, 1),
(11, 'Mouse Óptico Logitech', 'Mouse óptico com sensor de 1200 DPI, conexão USB, design anatômico ambidestro e alta precisão para uso diário em computadores e notebooks.', 79.90, 60, 2, 1),
(12, 'Caderno Universitário 200 folhas', 'Caderno universitário com 200 folhas pautadas, capa dura resistente, divisão para 10 matérias e encadernação espiral reforçada. Ideal para estudantes do ensino médio e superior.', 29.90, 100, 5, 1),
(13, 'Caneta Esferográfica Azul', 'Caneta esferográfica com tinta azul de secagem rápida, ponta média de 1.0mm, escrita macia e corpo transparente que permite visualizar o nível de tinta.', 2.50, 500, 5, 1),
(14, 'Agenda Executiva 2026', 'Agenda executiva anual 2026 com capa em couro sintético, visão diária das páginas, espaço para planejamento mensal, controle financeiro e contatos. Ideal para organização profissional.', 49.90, 35, 5, 1),
(15, 'Liquidificador Mondial 900W', 'Liquidificador com potência de 900W, 5 velocidades + função pulsar, copo de 2 litros resistente, lâminas em aço inox e base antiderrapante. Indicado para preparo de sucos, vitaminas e receitas variadas.', 189.90, 18, 3, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `ativo` tinyint(1) DEFAULT 1,
  `tipo` enum('admin','vendedor') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `senha`, `ativo`, `tipo`) VALUES
(1, 'Administrador Geral', 'admin@mystore.com', '0192023a7bbd73250516f069df18b500', 1, 'admin'),
(2, 'Carlos Silva', 'c.silv26@gmail.com', '39f6a1b795cd74acde2ecb5a42049ed6', 1, 'vendedor'),
(3, 'Mariana Souza', 'mari_sz_001@hotmail.com', '39f6a1b795cd74acde2ecb5a42049ed6', 1, 'vendedor');

-- --------------------------------------------------------

--
-- Estrutura para tabela `venda`
--

CREATE TABLE `venda` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `data_venda` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `venda`
--

INSERT INTO `venda` (`id`, `cliente_id`, `usuario_id`, `data_venda`) VALUES
(1, 5, 3, '2025-03-27 01:41:13'),
(2, 10, 3, '2025-09-13 22:03:59'),
(3, 5, 2, '2025-08-26 02:45:16'),
(4, 3, 2, '2025-06-22 02:53:59'),
(5, 5, 2, '2025-02-16 07:38:42'),
(6, 9, 1, '2025-12-18 22:35:52'),
(7, 4, 2, '2025-02-27 15:59:53'),
(8, 4, 1, '2025-07-04 07:08:28'),
(9, 5, 3, '2025-04-25 19:35:38'),
(10, 10, 2, '2025-08-31 21:38:16'),
(11, 10, 1, '2025-07-12 12:21:08'),
(12, 5, 3, '2025-12-02 03:39:08'),
(13, 2, 2, '2025-11-30 07:42:20'),
(14, 3, 2, '2025-01-02 01:30:36'),
(15, 6, 1, '2025-04-25 03:53:11'),
(16, 9, 1, '2025-12-25 04:14:13'),
(17, 7, 2, '2025-06-16 22:47:20'),
(18, 3, 3, '2025-07-15 05:35:22'),
(19, 5, 2, '2025-03-31 19:37:07'),
(20, 5, 3, '2025-08-06 18:30:22'),
(21, 9, 2, '2025-10-24 18:26:19'),
(22, 1, 2, '2025-02-25 23:49:10'),
(23, 5, 1, '2025-12-19 19:10:28'),
(24, 2, 3, '2025-01-03 10:00:34'),
(25, 8, 2, '2025-04-22 02:06:42'),
(26, 8, 2, '2025-12-09 22:15:53'),
(27, 9, 1, '2025-10-31 03:06:24'),
(28, 1, 2, '2025-04-29 04:20:39'),
(29, 2, 3, '2025-01-22 05:44:16'),
(30, 6, 3, '2025-09-06 22:52:04'),
(31, 4, 3, '2025-10-19 19:09:02'),
(32, 5, 2, '2025-07-17 03:50:23'),
(33, 5, 3, '2025-04-22 11:34:12'),
(34, 8, 1, '2025-04-17 07:21:00'),
(35, 7, 3, '2025-08-06 22:01:05'),
(36, 5, 3, '2025-06-22 05:19:06'),
(37, 10, 3, '2025-09-29 16:11:14'),
(38, 8, 2, '2025-04-06 20:28:20'),
(39, 9, 1, '2025-09-07 17:55:57'),
(40, 7, 1, '2025-09-03 04:27:00'),
(41, 2, 1, '2025-06-16 20:46:46'),
(42, 4, 2, '2025-10-30 11:23:38'),
(43, 7, 1, '2025-06-22 13:46:25'),
(44, 10, 2, '2025-08-20 19:44:52'),
(45, 4, 1, '2025-02-27 17:30:43'),
(46, 1, 1, '2025-10-22 16:10:22'),
(47, 8, 2, '2025-08-27 05:24:38'),
(48, 6, 2, '2025-07-29 16:06:57'),
(49, 3, 3, '2025-11-02 13:29:57'),
(50, 7, 1, '2025-03-16 10:07:35'),
(51, 1, 2, '2025-10-29 03:19:18'),
(52, 9, 1, '2025-07-05 00:00:10'),
(53, 4, 1, '2025-11-18 21:53:32'),
(54, 6, 1, '2025-06-04 13:38:21'),
(55, 7, 2, '2025-06-11 19:59:14'),
(56, 8, 1, '2025-04-21 15:53:38'),
(57, 5, 3, '2025-08-26 23:30:32'),
(58, 7, 1, '2025-03-27 03:42:59'),
(59, 6, 1, '2025-05-29 01:01:39'),
(60, 10, 1, '2025-10-04 13:36:17'),
(61, 8, 1, '2025-11-17 21:17:50'),
(62, 10, 2, '2025-01-27 19:03:01'),
(63, 9, 1, '2025-12-16 13:32:10'),
(64, 1, 1, '2025-02-02 11:35:42'),
(65, 1, 2, '2025-03-24 20:57:46'),
(66, 8, 1, '2025-01-20 06:07:17'),
(67, 9, 2, '2025-11-22 04:05:17'),
(68, 8, 3, '2025-09-26 21:40:57'),
(69, 6, 1, '2025-09-12 18:34:18'),
(70, 8, 3, '2025-08-31 04:26:51'),
(71, 8, 3, '2025-12-15 10:39:42'),
(72, 6, 1, '2025-04-09 23:37:38'),
(73, 7, 2, '2025-12-21 20:49:18'),
(74, 6, 1, '2025-01-05 20:35:51'),
(75, 3, 2, '2025-08-08 03:51:52'),
(76, 8, 2, '2025-06-09 05:34:00'),
(77, 8, 3, '2025-07-05 10:43:27'),
(78, 10, 2, '2025-11-18 21:13:13'),
(79, 10, 3, '2025-08-30 09:10:08'),
(80, 7, 2, '2025-09-26 02:26:50'),
(81, 9, 3, '2025-05-08 12:55:25'),
(82, 6, 3, '2025-03-08 04:28:48'),
(83, 8, 2, '2025-08-26 15:30:17'),
(84, 6, 3, '2025-10-21 10:43:11'),
(85, 10, 2, '2025-01-13 03:17:34'),
(86, 9, 3, '2025-12-12 19:19:57'),
(87, 3, 2, '2025-06-14 11:45:04'),
(88, 2, 3, '2025-10-17 12:46:12'),
(89, 10, 2, '2025-04-09 02:50:43'),
(90, 3, 1, '2025-08-28 13:55:53'),
(91, 3, 1, '2025-04-27 02:28:18'),
(92, 7, 1, '2025-02-22 19:07:49'),
(93, 1, 2, '2025-03-10 15:54:22'),
(94, 4, 2, '2025-04-16 14:18:29'),
(95, 6, 2, '2025-03-09 23:34:14'),
(96, 9, 2, '2025-11-19 02:05:39'),
(97, 6, 1, '2025-03-11 15:44:21'),
(98, 2, 3, '2025-12-17 07:28:50'),
(99, 9, 3, '2025-02-04 20:50:12'),
(100, 5, 3, '2025-02-26 06:05:07');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `categoria_produto`
--
ALTER TABLE `categoria_produto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produto_id` (`produto_id`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Índices de tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `item_venda`
--
ALTER TABLE `item_venda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `venda_id` (`venda_id`),
  ADD KEY `produto_id` (`produto_id`);

--
-- Índices de tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices de tabela `venda`
--
ALTER TABLE `venda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`cliente_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `categoria_produto`
--
ALTER TABLE `categoria_produto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `item_venda`
--
ALTER TABLE `item_venda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=382;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `venda`
--
ALTER TABLE `venda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `categoria_produto`
--
ALTER TABLE `categoria_produto`
  ADD CONSTRAINT `categoria_produto_ibfk_1` FOREIGN KEY (`produto_id`) REFERENCES `produto` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `categoria_produto_ibfk_2` FOREIGN KEY (`categoria_id`) REFERENCES `produto` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `item_venda`
--
ALTER TABLE `item_venda`
  ADD CONSTRAINT `item_venda_ibfk_1` FOREIGN KEY (`venda_id`) REFERENCES `venda` (`id`),
  ADD CONSTRAINT `item_venda_ibfk_2` FOREIGN KEY (`produto_id`) REFERENCES `produto` (`id`);

--
-- Restrições para tabelas `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `produto_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id`);

--
-- Restrições para tabelas `venda`
--
ALTER TABLE `venda`
  ADD CONSTRAINT `venda_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id`),
  ADD CONSTRAINT `venda_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
