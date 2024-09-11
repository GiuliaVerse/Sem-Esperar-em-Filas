-- 1  Seleciona o usuario.
SELECT * FROM usuario

-- 2 Seleciona uma informacao do restaurante.
SELECT razao_social FROM restaurante

-- 3 Lista os itens do cardapio de um restaurante.
SELECT cardapio.nome_cardapio, produtos.nome_produto
FROM cardapio
inner join produtos on cardapio.codigo_cardapio = produtos.cardapio_codigo_cardapio
WHERE restaurante_codigo_restaurante = 2  

-- 4 Lista todos os produtos e valores de um restaurante.
SELECT cardapio.nome_cardapio, produtos.nome_produto, produtos.valor_produto
FROM produtos, cardapio
WHERE restaurante_codigo_restaurante = 2 AND cardapio.codigo_cardapio = produtos.cardapio_codigo_cardapio

-- 5 Lista o todos os produtos que tem o ingrediente Massa.
SELECT produtos.nome_produto, produtos.valor_produto, produtos.ingredientes
FROM produtos
WHERE produtos.ingredientes like "%Massa%"

-- 6 Listar todos os pedidos feitos por usuário específico em um determinado restaurante.
SELECT pedido.codigo_pedido, pedido.data_pedido, pedido.valor_pedido
FROM pedido
WHERE cliente_codigo_cliente = 1 AND restaurante_codigo_restaurante = 1

-- 7 Consulta os 5 itens mais vendidos no restaurante.
SELECT itenspedido.produtos_codigo_produtos, produtos.nome_produto, SUM(itenspedido.quantidade) AS quantidade 
FROM itenspedido
INNER JOIN pedido ON itenspedido.pedido_codigo_pedido = pedido.codigo_pedido
INNER JOIN produtos ON itenspedido.produtos_codigo_produtos = produtos.codigo_produtos
WHERE pedido.restaurante_codigo_restaurante = 1
GROUP BY itenspedido.produtos_codigo_produtos, produtos.nome_produto
ORDER BY quantidade DESC
LIMIT 5;

-- 8 Recuperar o histório de pedidos de um usuário em um determinado período.
SELECT pedido.codigo_pedido, pedido.data_pedido, pedido.valor_pedido
FROM pedido
WHERE cliente_codigo_cliente = 1 AND data_pedido between '2024-01-01' AND '2024-08-31'

-- 9 Recupera todos os produtos da tabela produtos que possuem um preço superior a R$20,00.
SELECT codigo_produtos, nome_produto, valor_produto, tempo_preparo, promocao, cardapio_codigo_cardapio, ingredientes
FROM produtos
WHERE valor_produto > 20.00;

-- 10 Consultas os usuarios que comecam com P.
SELECT codigo_usuario, nome, login, senha, email
FROM usuario
WHERE nome LIKE "P%";

-- 11  Lista todas as formas de pagamento.
SELECT descricao 
FROM formapagamento

-- 12	Recuperar todas as mensagens enviadas ao usuário.
SELECT mensagem 
FROM notificacao, pedido
WHERE notificacao.cliente_codigo_cliente = 1 
AND pedido.restaurante_codigo_restaurante = 1
AND notificacao.pedido_codigo_pedido = pedido.codigo_pedido

-- 13 Listar os 5 pedidos mais frequentes feitos por um usuário específico em um determinado restaurante.
SELECT itenspedido.produtos_codigo_produtos, produtos.nome_produto, SUM(itenspedido.quantidade) AS quantidade 
FROM itenspedido
INNER JOIN pedido ON itenspedido.pedido_codigo_pedido = pedido.codigo_pedido
INNER JOIN produtos ON itenspedido.produtos_codigo_produtos = produtos.codigo_produtos
WHERE pedido.restaurante_codigo_restaurante = 1 AND pedido.cliente_codigo_cliente = 1
GROUP BY itenspedido.produtos_codigo_produtos, produtos.nome_produto
ORDER BY quantidade DESC
LIMIT 5;

-- 14 Lista todos os pedidos entre duas datas.
SELECT pedido.codigo_pedido, pedido.data_pedido, pedido.valor_pedido, pedido.cliente_codigo_cliente, cliente.nome
FROM pedido
INNER JOIN cliente ON pedido.cliente_codigo_cliente = cliente.codigo_cliente
WHERE data_pedido between '2024-01-01' AND '2024-08-31'
ORDER BY cliente.nome  

-- 15 Consultas dos pedidos entre tal valores.
SELECT pedido.codigo_pedido, pedido.data_pedido, pedido.valor_pedido
FROM pedido
WHERE pedido.restaurante_codigo_restaurante = 1 AND pedido.valor_pedido BETWEEN 10.0 AND 100.0
ORDER BY pedido.valor_pedido

-- 16 Quantidade de cada produto vendido entre duas datas.
SELECT itenspedido.produtos_codigo_produtos, produtos.nome_produto, SUM(itenspedido.quantidade) AS quantidade 
FROM itenspedido
INNER JOIN pedido ON itenspedido.pedido_codigo_pedido = pedido.codigo_pedido
INNER JOIN produtos ON itenspedido.produtos_codigo_produtos = produtos.codigo_produtos
WHERE pedido.restaurante_codigo_restaurante = 1 AND data_pedido between '2024-01-01' AND '2024-09-31'
GROUP BY itenspedido.produtos_codigo_produtos, produtos.nome_produto
ORDER BY quantidade DESC

-- 17 Contar o número de clientes em cada cidade.

SELECT end_cidade, COUNT(*) AS total_clientes
FROM cliente
GROUP BY end_cidade;

-- 18 Você deseja calcular o valor médio dos pedidos para cada cliente.

SELECT cliente_codigo_cliente, AVG(valor_pedido) AS valor_medio_pedido
FROM pedido
GROUP BY cliente_codigo_cliente;

-- 19 Exibir os nomes dos clientes junto com os detalhes dos seus pedidos.

SELECT p.cliente_codigo_cliente, p.data_pedido, p.data_hora, p.valor_pedido, c.nome
FROM pedido AS p
INNER JOIN cliente AS c
ON p.cliente_codigo_cliente = c.codigo_cliente;

-- 20 Consulta que recupera informações de cada país.

SELECT
  c.end_pais,
  COUNT(*) AS total_clientes,
  COUNT(p.codigo_pedido) AS total_pedidos,
  AVG(p.valor_pedido) AS valor_medio_pedido
FROM cliente AS c
LEFT JOIN pedido AS p ON c.codigo_cliente = p.cliente_codigo_cliente
GROUP BY c.end_pais
ORDER BY c.end_pais;


-- VIEW 1 Seleciona os usuarios ativos.

CREATE VIEW view_usuarios_ativos AS
SELECT
  codigo_usuario,
  nome,
  login,
  email
FROM usuario
WHERE perfil_codigo_perfil = 1;

-- VIEW 2 Seleciona o cardapio e seu respectivo restaurante.

CREATE VIEW view_cardapios_restaurantes AS
SELECT
  r.razao_social,
  c.nome_cardapio
FROM restaurante r
JOIN cardapio c ON c.restaurante_codigo_restaurante = r.codigo_restaurante;

-- VIEW 3 Vê os produtos e a qual cardapio ele pertence.

CREATE VIEW view_produtos_cardapios AS
SELECT
  nome_produto,
  valor_produto,
  tempo_preparo,
  promocao,
  nome_cardapio
FROM produtos 
JOIN cardapio  ON cardapio_codigo_cardapio = codigo_cardapio;
