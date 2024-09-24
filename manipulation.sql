-- Banco de dados: `projeto`

-- Despejando dados para a tabela `adicional`

INSERT INTO `adicional` (`codigo_adicional`, `nome_adicional`, `valor_adicional`) VALUES
(1, 'Batata frita', 4),
(2, 'Polenta', 3.99),
(3, 'Arroz Arbóreo', 8),
(4, 'Mix de Saladas', 6),
(5, 'Bife', 8),
(6, 'Feijão', 4.99),
(7, 'Peixe', 12),
(8, 'Ovo', 2.25),
(9, 'Frango', 8);

-- Despejando dados para a tabela `cardapio`

INSERT INTO `cardapio` (`codigo_cardapio`, `nome_cardapio`, `categoria`, `descricao`, `restaurante_codigo_restaurante`) VALUES
(1, 'Restaurante A', 'Pratos', 'Pratos para almoço e jantar', 2),
(2, 'Restaurante A', 'Lanches', 'Lanches para qualquer hora', 2),
(3, 'Restaurante B', 'Lanches', 'Lanches para qualquer hora', 13),
(4, 'Restaurante C Ltda', 'Café', 'Café, doces, lanches', 14),
(5, 'Restaurante D Ltda', 'Pratos', 'Pratos para almoço e jantar', 15),
(6, 'Restaurante E Ltda', 'Doces', 'Doces', 16),
(7, 'Restaurante F Ltda', 'Bebidas', 'Bebidas e vitaminas', 17),
(8, 'Bistrô da Vovó', 'Pratos', 'Pratos para almoço e jantar', 1);

-- Despejando dados para a tabela `cliente`

INSERT INTO `cliente` (`codigo_cliente`, `nome`, `cpf`, `email`, `telefone`, `data_nasc`, `data_criacao`, `end_pais`, `end_estado`, `end_cidade`, `end_bairro`, `end_logradouro`, `end_cep`) VALUES
(1, 'Paulo', '11111111111', 'puc@123', '4199871134', '0000-00-00', '0000-00-00', 'Brasil', 'Paraná', 'Curitiba', 'Centro', 'Alferes Polly', 81010110),
(2, 'giulia', '11111111111', 'giugiu@pucpr.edu.br', '41984556008', '2002-08-25', '2024-07-12', 'Brasil', 'Paraná', 'Curitiba', 'Centro', 'Avenida Visconde de Guarapuava', 80010100),
(3, 'joao', '22222222222', 'joao@pucpr.edu.br', '41984556009', '1998-05-14', '2024-07-12', 'Brasil', 'Paraná', 'Curitiba', 'Batel', 'Rua Carlos de Carvalho', 80430010),
(4, 'ana', '33333333333', 'ana@pucpr.edu.br', '41984556010', '2000-11-23', '2024-07-12', 'Brasil', 'Paraná', 'Curitiba', 'Alto da Glória', 'Rua Augusto Severo', 80045120),
(5, 'carlos', '44444444444', 'carlos@gmail.com', '41984556011', '1995-02-17', '2024-07-12', 'Brasil', 'Paraná', 'Curitiba', 'Juvevê', 'Rua Rocha Pombo', 80030120),
(6, 'maria', '55555555555', 'maria@icloud.com', '41984556012', '2001-09-30', '2024-07-12', 'Brasil', 'Paraná', 'Curitiba', 'Santa Felicidade', 'Avenida Manoel Ribas', 82020000),
(7, 'amor', '69696969696', 'amordaminhavida@gmail.com.br', '47991678394', '2009-08-30', '2020-05-31', 'Brasil', 'Santa Catarina', 'Balneario', 'Lidia Duarte', 'Joaquim Maria Simas', 82020000),
(8, 'Poney', '33333333333', 'pon123@pucpr.edu.br', '4198753089', '2002-09-21', '2024-01-23', 'Espanha', 'Barcelona', 'Barcelona', 'Las Ramblas', 'Rambla De Catalunya', 8007),
(9, 'Vladimir', '12345678901', 'vladimir@exemplo.com', '12 3456-7890', '0000-00-00', '0000-00-00', 'Marrocos', 'Taourirt', 'Oujda', 'Hay Al Qasam', 'Hay AL Alhy', 0),
(10, 'Fefe', '12345678901', 'fefe@cuticuti.com', '99 3456-7890', '0000-00-00', '2024-06-05', '', '', '', '', '', 0);

-- Despejando dados para a tabela `formapagamento`

INSERT INTO `formapagamento` (`codigo_pagamento`, `descricao`) VALUES
(1, 'Dinheiro'),
(2, 'Cartão de Crédito a Vista'),
(3, 'Cartão de Débito'),
(4, 'Pix'),
(5, 'Vale Refeição'),
(6, 'Cartão de Crédito Parcelado em ate 3x');

-- Despejando dados para a tabela `instituicao`

INSERT INTO `instituicao` (`codigo_instituicao`, `nome_fantasia`, `razao_social`, `cnpj`, `end_pais`, `end_estado`, `end_cidade`, `end_bairro`, `end_logradouro`, `end_cep`, `telefone`) VALUES
(1, 'PUC', 'Pontifícia Universidade Católica do Paraná', '75.103.192/0001-60', 'Brasil', 'Paraná', 'Curitiba', 'Prado Velho', 'Rua Imaculada Conceição', 80215, '(41) 3271-1555'),
(4, 'Instituição A', 'Instituição A Ltda', '11111111000191', 'Brasil', 'Paraná', 'Curitiba', 'Centro', 'Avenida Visconde de Guarapuava', 80010100, '41984556001'),
(5, 'Instituição B', 'Instituição B Ltda', '22222222000192', 'Brasil', 'Paraná', 'Curitiba', 'Batel', 'Rua Carlos de Carvalho', 80430010, '41984556002'),
(7, 'Instituição D', 'Instituição D Ltda', '44444444000194', 'Brasil', 'Paraná', 'Curitiba', 'Juvevê', 'Rua Rocha Pombo', 80030120, '41984556004'),
(8, 'Instituição E', 'Instituição E Ltda', '55555555000195', 'Brasil', 'Paraná', 'Curitiba', 'Santa Felicidade', 'Avenida Manoel Ribas', 82020000, '41984556005'),
(9, 'Instituição F', 'Instituição F Ltda', '66666666000191', 'Brasil', 'Paraná', 'Curitiba', 'Hauer', 'Rua Chile', 80220000, '41984556018'),
(10, 'Instituição C', 'Instituição C Ltda', '33333333000193', 'Brasil', 'Paraná', 'Curitiba', 'Alto da Glória', 'Rua Augusto Severo', 80045120, '41984556003');

-- Despejando dados para a tabela `itenspedido`

INSERT INTO `itenspedido` (`pedido_codigo_pedido`, `seq_pedido`, `produtos_codigo_produtos`, `quantidade`, `valor`, `observacao`, `adicional_codigo_adicional`) VALUES
(5, 1, 63, 2, 10.00, 'Sem açucar', NULL),
(5, 2, 64, 1, 25.00, '', 1),
(6, 1, 61, 1, 6.00, '', NULL),
(6, 2, 65, 1, 30.00, '', 3),
(10, 1, 66, 4, 4.00, '', NULL),
(10, 2, 67, 5, 18.00, '', 8),
(11, 1, 7, 4, 12.00, '', 1),
(11, 2, 8, 2, 2.00, '', 1);

-- Despejando dados para a tabela `notificacao`

INSERT INTO `notificacao` (`codigo_notificacao`, `tipo`, `mensagem`, `hora_entrega`, `pedido_codigo_pedido`, `cliente_codigo_cliente`, `restaurante_codigo_restaurante`) VALUES
(1, 'cliente', 'Seu pedido foi recebido com sucesso.', '12:30:00', 6, 4, NULL),
(2, 'restaurante', 'Novo pedido recebido do cliente 1002.', '12:35:00', 8, NULL, 1),
(3, 'cliente', 'Seu pedido está sendo preparado', '12:40:00', 7, 2, NULL),
(4, 'restaurante', 'Pedido 104 precisa ser entregue até 13:00.', '12:45:00', 9, NULL, 2),
(5, 'cliente', 'Seu pedido está pronto', '12:50:00', 10, 1, NULL),
(6, 'restaurante', 'Cliente 1006 deu feedback positivo.', '12:55:00', 5, NULL, 15);

-- Despejando dados para a tabela `ordempedido`

INSERT INTO `ordempedido` (`hora_pedido`, `hora_pronto_retirada`, `pedido_codigo_pedido`) VALUES
('12:35:00', '13:10:00', 5),
('17:30:00', '17:50:00', 10),
('14:00:00', '14:50:00', 6),
('19:40:00', '20:00:00', 7),
('21:00:00', '21:30:00', 8),
('08:30:00', '08:50:00', 9);

-- Despejando dados para a tabela `pedido`

INSERT INTO `pedido` (`codigo_pedido`, `valor_pedido`, `data_pedido`, `data_hora`, `tempoPreparo`, `status`, `cliente_codigo_cliente`, `FormaPagamento_codigo_pagamento`, `restaurante_codigo_restaurante`) VALUES
(5, 10.00, '2024-06-04', '12:35:00', '00:35:00', 'Entregue', 1, 3, 1),
(6, 15.00, '2024-06-04', '07:25:10', '00:05:00', 'Pronto para retirada', 2, 1, 2),
(7, 20.00, '2024-06-04', '11:30:17', '00:11:30', 'Entregue', 3, 2, 15),
(8, 25.00, '2024-06-04', '15:33:38', '00:02:00', 'Aguardando confirmação', 4, 3, 14),
(9, 30.00, '2024-06-04', '08:25:00', '00:00:45', 'Pronto para retirada', 5, 2, 2),
(10, 35.00, '2024-06-04', '19:41:08', '00:02:00', 'Entregue', 6, 6, 1),
(11, 50.00, '2024-06-05', '12:00:00', '00:40:40', 'Em preparo', 1, 4, 17),
(12, 35.00, '2024-06-05', '18:00:00', '00:40:00', 'Cancelado', 2, 1, 16);

-- Despejando dados para a tabela `perfil`

INSERT INTO `perfil` (`codigo_perfil`, `tipo_Acesso`) VALUES
(1, 'Ativo'),
(2, 'Inativo'),
(3, 'Dados Incompletos'),
(4, 'Em Análise'),
(5, 'Desativado'),
(6, 'Excluído');

-- Despejando dados para a tabela `produtos`

INSERT INTO `produtos` (`codigo_produtos`, `nome_produto`, `valor_produto`, `tempo_preparo`, `promocao`, `cardapio_codigo_cardapio`, `ingredientes`) VALUES
(1, 'Feijoada', 20.00, 180, 0.00, 1, 'Feijão;Paio;Costelinha Suína;'),
(2, 'Feijão Tropeiro', 25.00, 210, 0.00, 2, 'Feijão;Bacon;Ovos'),
(3, 'Salgado de Frango', 4.50, 10, 0.00, 3, 'Frango, Massa, Temperos'),
(4, 'Pastel de Carne', 5.00, 8, 0.00, 4, 'Carne, Massa, Cebola, Alho'),
(5, 'Coxinha de Frango', 4.00, 7, 0.00, 5, 'Frango, Massa, Catupiry'),
(6, 'Pão de Queijo', 3.00, 5, 0.00, 6, 'Queijo, Polvilho, Ovo, Óleo'),
(7, 'Empada de Palmito', 4.50, 12, 0.00, 7, 'Palmito, Massa, Azeitona'),
(8, 'Café', 3.49, 2, 0.00, 7, 'Açucar, Leite, Café'),
(60, 'Arroz com Batata', 14.99, 30, 0.00, 3, 'Arroz e Batata'),
(61, 'Coca Cola 350ml', 6.00, 0, 0.00, 8, 'Bebida'),
(62, 'Coca Cola 600', 8.00, 0, 0.00, 1, 'Bebida'),
(63, 'Suco de Laranja 500ml', 10.00, 10, 0.00, 4, 'Bebida'),
(64, 'Estrogonoff de Carne', 25.00, 30, 0.00, 4, 'Patinho em Cubos, Creme de Leite, Molho, Ketchup, Mostarda e Temperos'),
(65, 'Lasanha Bolonhesa', 30.00, 45, 0.00, 5, 'Massa, Bolonhesa, Temperos'),
(66, 'Água', 4.00, 0, 0.00, 6, 'Bebida'),
(67, 'Salada', 18.00, 15, 0.00, 2, 'Mix de Saladas'),
(68, 'Água com Gás', 4.00, 0, 0.00, 8, 'Bebida');

-- Despejando dados para a tabela `restaurante`

INSERT INTO `restaurante` (`codigo_restaurante`, `razao_social`, `nome_fantasia`, `cnpj`, `end_pais`, `end_estado`, `end_cidade`, `end_bairro`, `end_logradouro`, `end_cep`, `end_bloco`, `telefone`, `instituicao_codigo_instituicao`) VALUES
(1, 'Bistro da Vovó', 'Restaurante da Vovó', '11111111000191', 'Brasil', 'Paraná', 'Curitiba', 'Prado Velho', 'Rua Imacula Conceição', 87013, 'Bloco 5', '(41)3271-1555', 1),
(2, 'Restaurante A Ltda', 'Restaurante A', '66666666000196', 'Brasil', 'Paraná', 'Curitiba', 'Centro', 'Rua XV de Novembro', 80020100, 'Bloco A', '41984556013', 1),
(13, 'Restaurante B Ltda', 'Restaurante B', '77777777000197', 'Brasil', 'Paraná', 'Curitiba', 'Água Verde', 'Avenida República Argentina', 80620000, 'Bloco B', '41984556014', 1),
(14, 'Restaurante C Ltda', 'Restaurante C', '88888888000198', 'Brasil', 'Paraná', 'Curitiba', 'Cabral', 'Rua Anita Garibaldi', 80035010, 'Bloco C', '41984556015', 1),
(15, 'Restaurante D Ltda', 'Restaurante D', '99999999000199', 'Brasil', 'Paraná', 'Curitiba', 'Bigorrilho', 'Rua Martin Afonso', 80730050, 'Bloco D', '41984556016', 1),
(16, 'Restaurante E Ltda', 'Restaurante E', '10101010000100', 'Brasil', 'Paraná', 'Curitiba', 'Mercês', 'Rua Jacarezinho', 80510100, 'Bloco E', '41984556017', 1),
(17, 'Restaurante F Ltda', 'Restaurante F', '11111111000101', 'Brasil', 'Paraná', 'Curitiba', 'Hauer', 'Rua Chile', 80220000, 'Bloco F', '41984556018', 1);

-- Despejando dados para a tabela `usuario`

INSERT INTO `usuario` (`codigo_usuario`, `nome`, `login`, `senha`, `email`, `perfil_codigo_perfil`, `cliente_codigo_cliente`, `restaurante_codigo_restaurante`) VALUES
(2, 'Paulo', 'xxxxx', 'puc@123', 'email@puc', 1, 1, NULL),
(3, 'Poney', 'xxxx', 'puc@123', 'poney@pucpr.edu.br', 2, 8, NULL),
(10, 'Restaurante E', 'Erestaurante', 'melhorcomidaaqui', 'restaurante.E@example.com', 1, NULL, 16),
(11, 'Restaurante F', 'Erestaurante', 'fheuh1084+-', 'restaurante.F@example.com', 1, NULL, 17),
(12, 'Restaurante A', 'Erestaurante', ' fajfeo58!', 'restaurante.A@example.com', 1, NULL, 2),
(13, 'João', 'joaosilva', 'senha123', 'joao@pucpr.edu.br', 1, 3, NULL),
(14, 'Ana', 'anaoliveira', 'senha456', 'ana@pucpr.edu.br', 1, 4, NULL),
(15, 'Carlos', 'carlossantos', 'senha789', 'carlos@gmail.com', 1, 5, NULL),
(16, 'Maria', 'mariacosta', 'senha101', 'maria@icloud.com', 1, 6, NULL),
(17, 'Amor', 'amorCasteluciMuchalski', 'giuliaAmaPaulinho', 'amordaminhavida@gmail.com.br', 1, 7, NULL),
(18, 'Fernanda', 'fernandalima', 'senha303', 'fernanda.lima@example.com', 2, 2, NULL),
(19, 'Vladimir', 'vladi', 'mir', 'vladimir@exemplo.com', 1, 9, NULL),
(20, 'Fefe', 'fefezudo', 'soufeliz', 'fefe@cuticuti.com', 1, 10, NULL);

-- --------------------------------------------------------

-- UPDATE 1 Atualiza o nome, categoria, descrição de um cardapio

UPDATE cardapio
SET 
  nome_cardapio = 'Cardápio da Vovó',
  categoria = 'Doces',
  descricao = 'Doces Gostosinhos',
  codigo_restaurante = 1
WHERE codigo_cardapio = 1;

-- UPDATE 2 Atualiza o nome, login e senha do Usuario

UPDATE usuario
SET
    nome = 'Paulo César'
    login = 'paulocesar'
    senha = 'puc@12345'
WHERE codigo_usuario = 2;

-- UPDATE 3 Atuliza o status do pedido

UPDATE pedido
SET 
    status = 'Entregue'
WHERE codigo_pedido = 5;

-- UPDATE 4 Atualiza a forma de pagamento do pedido

UPDATE pedido
SET
    FormaPagamento_codigo_pagamento = '4'
WHERE codigo_pedido = 8;

-- UPDATE 5 Atualiza a qual pedido a notificao está se referindo

UPDATE notificacao
SET
    pedido_codigo_pedido = '7'
WHERE codigo_notificacao = 1;

-- DELETE 1 Deleta o CPF 22222222222

DELETE FROM cliente 
WHERE cpf = '22222222222';

-- DELETE 2  Deleta tudo relacionado ao cnpj 66666666000196

DELETE FROM restaurante 
WHERE cnpj = '66666666000196';

-- DELETE 3 Deleta tudo relacionado ao cnpj 3333333000193

DELETE FROM instituicao 
WHERE cnpj = '33333333000193';

-- DELETE 4 Deleta o produto da tabela produtos

DELETE FROM produtos
WHERE `produtos`.`codigo_produtos` = 60;

-- DELETE 5 Deleta registros com preços entre 10 e 20

DELETE FROM pedido
WHERE valor_pedido BETWEEN 10.00 AND 20.00;
