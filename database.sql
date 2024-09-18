-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 06/06/2024 às 04:16
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
-- Banco de dados: `projeto`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `adicional`
--

CREATE TABLE `adicional` (
  `codigo_adicional` int(11) NOT NULL,
  `nome_adicional` varchar(30) DEFAULT NULL,
  `valor_adicional` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cardapio`
--

CREATE TABLE `cardapio` (
  `codigo_cardapio` int(11) NOT NULL,
  `nome_cardapio` varchar(255) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `descricao` text DEFAULT NULL,
  `restaurante_codigo_restaurante` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cliente`
--

CREATE TABLE `cliente` (
  `codigo_cliente` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `cpf` char(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `data_nasc` date NOT NULL,
  `data_criacao` date NOT NULL,
  `end_pais` varchar(45) NOT NULL,
  `end_estado` char(25) NOT NULL,
  `end_cidade` varchar(150) NOT NULL,
  `end_bairro` varchar(45) NOT NULL,
  `end_logradouro` varchar(45) NOT NULL,
  `end_cep` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `formapagamento`
--

CREATE TABLE `formapagamento` (
  `codigo_pagamento` int(11) NOT NULL,
  `descricao` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `instituicao`
--

CREATE TABLE `instituicao` (
  `codigo_instituicao` int(10) UNSIGNED NOT NULL,
  `nome_fantasia` varchar(100) NOT NULL,
  `razao_social` varchar(100) NOT NULL,
  `cnpj` char(18) NOT NULL,
  `end_pais` varchar(45) NOT NULL,
  `end_estado` char(25) NOT NULL,
  `end_cidade` varchar(150) NOT NULL,
  `end_bairro` varchar(45) NOT NULL,
  `end_logradouro` varchar(45) NOT NULL,
  `end_cep` int(11) NOT NULL,
  `telefone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `itenspedido`
--

CREATE TABLE `itenspedido` (
  `pedido_codigo_pedido` int(11) NOT NULL,
  `seq_pedido` int(11) NOT NULL,
  `produtos_codigo_produtos` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `observacao` varchar(255) DEFAULT NULL,
  `adicional_codigo_adicional` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Acionadores `itenspedido`
--
DELIMITER $$
CREATE TRIGGER `atualizar_valor_pedido` AFTER INSERT ON `itenspedido` FOR EACH ROW BEGIN
    DECLARE total_pedido DECIMAL(10,2);

    -- Calcular o novo valor total do pedido
    SELECT SUM(valor)
    INTO total_pedido
    FROM itenspedido
    WHERE pedido_codigo_pedido = NEW.pedido_codigo_pedido;

    -- Atualizar o valor do pedido na tabela pedido
    UPDATE pedido
    SET valor_pedido = total_pedido
    WHERE codigo_pedido = NEW.pedido_codigo_pedido;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `atualizar_valor_pedido_exc` AFTER DELETE ON `itenspedido` FOR EACH ROW BEGIN
    DECLARE total_pedido DECIMAL(10,2);

    -- Calcular o novo valor total do pedido
    SELECT SUM(valor)
    INTO total_pedido
    FROM itenspedido
    WHERE pedido_codigo_pedido = OLD.pedido_codigo_pedido;

    -- Atualizar o valor do pedido na tabela pedido
    UPDATE pedido
    SET valor_pedido = total_pedido
    WHERE codigo_pedido = OLD.pedido_codigo_pedido;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `notificacao`
--

CREATE TABLE `notificacao` (
  `codigo_notificacao` int(11) NOT NULL,
  `tipo` enum('cliente','restaurante') NOT NULL,
  `mensagem` text NOT NULL,
  `hora_entrega` time NOT NULL DEFAULT current_timestamp(),
  `pedido_codigo_pedido` int(11) NOT NULL,
  `cliente_codigo_cliente` int(11) DEFAULT NULL,
  `restaurante_codigo_restaurante` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `ordempedido`
--

CREATE TABLE `ordempedido` (
  `hora_pedido` time NOT NULL,
  `hora_pronto_retirada` time NOT NULL,
  `pedido_codigo_pedido` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedido`
--

CREATE TABLE `pedido` (
  `codigo_pedido` int(11) NOT NULL,
  `valor_pedido` decimal(10,2) NOT NULL,
  `data_pedido` date NOT NULL,
  `data_hora` time NOT NULL,
  `tempoPreparo` time DEFAULT NULL,
  `status` enum('Aguardando confirmação','Em preparo','Pronto para retirada','Entregue','Cancelado') NOT NULL,
  `cliente_codigo_cliente` int(11) NOT NULL,
  `FormaPagamento_codigo_pagamento` int(11) NOT NULL,
  `restaurante_codigo_restaurante` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Acionadores `pedido`
--
DELIMITER $$
CREATE TRIGGER `criar_notificacao_pedido_pronto` AFTER UPDATE ON `pedido` FOR EACH ROW BEGIN
    IF NEW.status = 'Pronto para retirada' AND OLD.status != 'Pronto para retirada' THEN
        -- Inserir uma nova notificação
        INSERT INTO notificacao (tipo, mensagem, hora_entrega, pedido_codigo_pedido, cliente_codigo_cliente)
        VALUES ('cliente', 'Seu pedido está pronto', CURRENT_TIMESTAMP(), NEW.codigo_pedido, NEW.cliente_codigo_cliente);
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `perfil`
--

CREATE TABLE `perfil` (
  `codigo_perfil` int(11) NOT NULL,
  `tipo_Acesso` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `codigo_produtos` int(11) NOT NULL,
  `nome_produto` varchar(145) NOT NULL,
  `valor_produto` decimal(10,2) UNSIGNED NOT NULL,
  `tempo_preparo` float UNSIGNED NOT NULL,
  `promocao` decimal(10,2) UNSIGNED NOT NULL,
  `cardapio_codigo_cardapio` int(11) NOT NULL,
  `ingredientes` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `restaurante`
--

CREATE TABLE `restaurante` (
  `codigo_restaurante` int(11) UNSIGNED NOT NULL,
  `razao_social` varchar(100) NOT NULL,
  `nome_fantasia` varchar(100) NOT NULL,
  `cnpj` char(14) NOT NULL,
  `end_pais` varchar(45) NOT NULL,
  `end_estado` char(25) NOT NULL,
  `end_cidade` varchar(150) NOT NULL,
  `end_bairro` varchar(45) NOT NULL,
  `end_logradouro` varchar(45) NOT NULL,
  `end_cep` int(11) NOT NULL,
  `end_bloco` varchar(45) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `instituicao_codigo_instituicao` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `codigo_usuario` int(11) NOT NULL,
  `nome` varchar(155) NOT NULL,
  `login` varchar(155) NOT NULL,
  `senha` varchar(80) NOT NULL,
  `email` varchar(60) NOT NULL,
  `perfil_codigo_perfil` int(11) NOT NULL,
  `cliente_codigo_cliente` int(11) DEFAULT NULL,
  `restaurante_codigo_restaurante` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura stand-in para view `view_cardapios_restaurantes`
-- (Veja abaixo para a visão atual)
--
CREATE TABLE `view_cardapios_restaurantes` (
`razao_social` varchar(100)
,`nome_cardapio` varchar(255)
);

-- --------------------------------------------------------

--
-- Estrutura stand-in para view `view_produtos_cardapios`
-- (Veja abaixo para a visão atual)
--
CREATE TABLE `view_produtos_cardapios` (
`nome_produto` varchar(145)
,`valor_produto` decimal(10,2) unsigned
,`tempo_preparo` float unsigned
,`promocao` decimal(10,2) unsigned
,`nome_cardapio` varchar(255)
);

-- --------------------------------------------------------

--
-- Estrutura stand-in para view `view_usuarios_ativos`
-- (Veja abaixo para a visão atual)
--
CREATE TABLE `view_usuarios_ativos` (
`codigo_usuario` int(11)
,`nome` varchar(155)
,`login` varchar(155)
,`email` varchar(60)
);

-- --------------------------------------------------------

--
-- Estrutura para view `view_cardapios_restaurantes`
--
DROP TABLE IF EXISTS `view_cardapios_restaurantes`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_cardapios_restaurantes`  AS SELECT `r`.`razao_social` AS `razao_social`, `c`.`nome_cardapio` AS `nome_cardapio` FROM (`restaurante` `r` join `cardapio` `c` on(`c`.`restaurante_codigo_restaurante` = `r`.`codigo_restaurante`)) ;

-- --------------------------------------------------------

--
-- Estrutura para view `view_produtos_cardapios`
--
DROP TABLE IF EXISTS `view_produtos_cardapios`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_produtos_cardapios`  AS SELECT `produtos`.`nome_produto` AS `nome_produto`, `produtos`.`valor_produto` AS `valor_produto`, `produtos`.`tempo_preparo` AS `tempo_preparo`, `produtos`.`promocao` AS `promocao`, `cardapio`.`nome_cardapio` AS `nome_cardapio` FROM (`produtos` join `cardapio` on(`produtos`.`cardapio_codigo_cardapio` = `cardapio`.`codigo_cardapio`)) ;

-- --------------------------------------------------------

--
-- Estrutura para view `view_usuarios_ativos`
--
DROP TABLE IF EXISTS `view_usuarios_ativos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_usuarios_ativos`  AS SELECT `usuario`.`codigo_usuario` AS `codigo_usuario`, `usuario`.`nome` AS `nome`, `usuario`.`login` AS `login`, `usuario`.`email` AS `email` FROM `usuario` WHERE `usuario`.`perfil_codigo_perfil` = 1 ;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `adicional`
--
ALTER TABLE `adicional`
  ADD PRIMARY KEY (`codigo_adicional`);

--
-- Índices de tabela `cardapio`
--
ALTER TABLE `cardapio`
  ADD PRIMARY KEY (`codigo_cardapio`),
  ADD KEY `fk_cardapio_restaurante` (`restaurante_codigo_restaurante`);

--
-- Índices de tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`codigo_cliente`);

--
-- Índices de tabela `formapagamento`
--
ALTER TABLE `formapagamento`
  ADD PRIMARY KEY (`codigo_pagamento`);

--
-- Índices de tabela `instituicao`
--
ALTER TABLE `instituicao`
  ADD PRIMARY KEY (`codigo_instituicao`);

--
-- Índices de tabela `itenspedido`
--
ALTER TABLE `itenspedido`
  ADD PRIMARY KEY (`pedido_codigo_pedido`,`seq_pedido`),
  ADD KEY `fk_itensPedido_produtos1_idx` (`produtos_codigo_produtos`),
  ADD KEY `fk_itensPedido_pedido1_idx` (`pedido_codigo_pedido`),
  ADD KEY `fk_itensPedido_adicional1_idx` (`adicional_codigo_adicional`);

--
-- Índices de tabela `notificacao`
--
ALTER TABLE `notificacao`
  ADD PRIMARY KEY (`codigo_notificacao`),
  ADD KEY `fk_notificacao_pedido1_idx` (`pedido_codigo_pedido`),
  ADD KEY `fk_notificacao_cliente1_idx` (`cliente_codigo_cliente`),
  ADD KEY `fk_notificacao_restaurante` (`restaurante_codigo_restaurante`);

--
-- Índices de tabela `ordempedido`
--
ALTER TABLE `ordempedido`
  ADD KEY `fk_ordemPedido_pedido1_idx` (`pedido_codigo_pedido`);

--
-- Índices de tabela `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`codigo_pedido`),
  ADD KEY `fk_pedido_cliente1_idx` (`cliente_codigo_cliente`),
  ADD KEY `fk_pedido_FormaPagamento1_idx` (`FormaPagamento_codigo_pagamento`),
  ADD KEY `fk_pedido_restaurante1` (`restaurante_codigo_restaurante`);

--
-- Índices de tabela `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`codigo_perfil`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`codigo_produtos`),
  ADD KEY `fk_produtos_cardapio1_idx` (`cardapio_codigo_cardapio`);

--
-- Índices de tabela `restaurante`
--
ALTER TABLE `restaurante`
  ADD PRIMARY KEY (`codigo_restaurante`),
  ADD KEY `fk_restaurante_instituicao1_idx` (`instituicao_codigo_instituicao`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`codigo_usuario`),
  ADD KEY `fk_usuario_perfil1_idx` (`perfil_codigo_perfil`),
  ADD KEY `fk_usuario_cliente1_idx` (`cliente_codigo_cliente`),
  ADD KEY `fk_usuario_restaurante1_idx` (`restaurante_codigo_restaurante`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `adicional`
--
ALTER TABLE `adicional`
  MODIFY `codigo_adicional` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cardapio`
--
ALTER TABLE `cardapio`
  MODIFY `codigo_cardapio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `codigo_cliente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `formapagamento`
--
ALTER TABLE `formapagamento`
  MODIFY `codigo_pagamento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `instituicao`
--
ALTER TABLE `instituicao`
  MODIFY `codigo_instituicao` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `notificacao`
--
ALTER TABLE `notificacao`
  MODIFY `codigo_notificacao` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pedido`
--
ALTER TABLE `pedido`
  MODIFY `codigo_pedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `perfil`
--
ALTER TABLE `perfil`
  MODIFY `codigo_perfil` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `codigo_produtos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `restaurante`
--
ALTER TABLE `restaurante`
  MODIFY `codigo_restaurante` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `codigo_usuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `cardapio`
--
ALTER TABLE `cardapio`
  ADD CONSTRAINT `fk_cardapio_restaurante` FOREIGN KEY (`restaurante_codigo_restaurante`) REFERENCES `restaurante` (`codigo_restaurante`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `itenspedido`
--
ALTER TABLE `itenspedido`
  ADD CONSTRAINT `fk_itensPedido_adicional1` FOREIGN KEY (`adicional_codigo_adicional`) REFERENCES `adicional` (`codigo_adicional`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_itensPedido_pedido1` FOREIGN KEY (`pedido_codigo_pedido`) REFERENCES `pedido` (`codigo_pedido`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_itensPedido_produtos1` FOREIGN KEY (`produtos_codigo_produtos`) REFERENCES `produtos` (`codigo_produtos`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `notificacao`
--
ALTER TABLE `notificacao`
  ADD CONSTRAINT `fk_notificacao_cliente1` FOREIGN KEY (`cliente_codigo_cliente`) REFERENCES `cliente` (`codigo_cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_notificacao_pedido1` FOREIGN KEY (`pedido_codigo_pedido`) REFERENCES `pedido` (`codigo_pedido`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_notificacao_restaurante` FOREIGN KEY (`restaurante_codigo_restaurante`) REFERENCES `restaurante` (`codigo_restaurante`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `ordempedido`
--
ALTER TABLE `ordempedido`
  ADD CONSTRAINT `fk_ordemPedido_pedido1` FOREIGN KEY (`pedido_codigo_pedido`) REFERENCES `pedido` (`codigo_pedido`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `fk_pedido_FormaPagamento1` FOREIGN KEY (`FormaPagamento_codigo_pagamento`) REFERENCES `formapagamento` (`codigo_pagamento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pedido_cliente1` FOREIGN KEY (`cliente_codigo_cliente`) REFERENCES `cliente` (`codigo_cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pedido_restaurante1` FOREIGN KEY (`restaurante_codigo_restaurante`) REFERENCES `restaurante` (`codigo_restaurante`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `fk_produtos_cardapio1` FOREIGN KEY (`cardapio_codigo_cardapio`) REFERENCES `cardapio` (`codigo_cardapio`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `restaurante`
--
ALTER TABLE `restaurante`
  ADD CONSTRAINT `fk_restaurante_instituicao1` FOREIGN KEY (`instituicao_codigo_instituicao`) REFERENCES `instituicao` (`codigo_instituicao`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_cliente1` FOREIGN KEY (`cliente_codigo_cliente`) REFERENCES `cliente` (`codigo_cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_perfil1` FOREIGN KEY (`perfil_codigo_perfil`) REFERENCES `perfil` (`codigo_perfil`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_restaurante1` FOREIGN KEY (`restaurante_codigo_restaurante`) REFERENCES `restaurante` (`codigo_restaurante`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
