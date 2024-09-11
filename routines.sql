--- TRIGGER

--- Trigger 1 que atualiza o valor total do pedido a medida que itens são inseridos
DROP TRIGGER IF EXISTS atualizar_valor_pedido;
DELIMITER $$
CREATE TRIGGER atualizar_valor_pedido
AFTER INSERT ON itenspedido
FOR EACH ROW
BEGIN
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
END $$

DELIMITER ;

--- Trigger 2 que insere uma notificação quando o status do pedido estiver como concluído (OK)
DROP TRIGGER IF EXISTS criar_notificacao_pedido_pronto;
DELIMITER $$
CREATE TRIGGER criar_notificacao_pedido_pronto
AFTER UPDATE ON pedido
FOR EACH ROW
BEGIN
    IF NEW.status = 'Pronto para retirada' AND OLD.status != 'Pronto para retirada' THEN
        -- Inserir uma nova notificação
        INSERT INTO notificacao (tipo, mensagem, hora_entrega, pedido_codigo_pedido, cliente_codigo_cliente)
        VALUES ('cliente', 'Seu pedido está pronto', CURRENT_TIMESTAMP(), NEW.codigo_pedido, NEW.cliente_codigo_cliente);
    END IF;
END $$

DELIMITER ;

--- Trigger 3 que atualiza o valor total do pedido quando um item é excluido
DROP TRIGGER IF EXISTS atualizar_valor_pedido_exc;
DELIMITER $$
CREATE TRIGGER atualizar_valor_pedido_exc
AFTER DELETE ON itenspedido
FOR EACH ROW
BEGIN
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
END $$

DELIMITER ;


--- FUNCTION

-- Função 1 para calcular o total do tempo de preparo
DROP FUNCTION IF EXISTS calcular_tempo_preparo_total;

DELIMITER $$
CREATE FUNCTION calcular_tempo_preparo_total(pedido_id INT) 
RETURNS FLOAT
BEGIN
    DECLARE total_tempo_preparo FLOAT;
    
    -- Calcular o total do tempo de preparo dos produtos dos itens do pedido
    SELECT SUM(p.tempo_preparo)
    INTO total_tempo_preparo
    FROM itenspedido ip
    JOIN produtos p ON ip.produtos_codigo_produtos = p.codigo_produtos
    WHERE ip.pedido_codigo_pedido = pedido_id;

    -- Retornar o tempo total de preparo
    RETURN total_tempo_preparo;
END $$

DELIMITER ;

--- Exemplo Função 1
SELECT calcular_tempo_preparo_total(5) AS tempo_preparo_total;

-- Função 2 para calcular o valor total dos pedidos de um cliente dentro de um período de datas
DROP FUNCTION IF EXISTS calcular_valor_pedidos_cliente;

DELIMITER $$
CREATE FUNCTION calcular_valor_pedidos_cliente(cliente_id INT, data_inicio DATE, data_fim DATE) 
RETURNS DECIMAL(10,2)
BEGIN
    DECLARE valor_total DECIMAL(10,2);
    
    -- Calcular o valor total dos pedidos do cliente no período especificado
    SELECT SUM(p.valor_pedido)
    INTO valor_total
    FROM pedido p
    WHERE p.cliente_codigo_cliente = cliente_id
      AND p.data_pedido BETWEEN data_inicio AND data_fim;

    -- Retornar o valor total dos pedidos
    RETURN valor_total;
END $$

DELIMITER ;

--- Exemplo Função 2
SELECT calcular_valor_pedidos_cliente(1, '2024-01-01', '2024-12-01') AS valor_total_pedidos;


-- Função 3 para calcular a quantidade de produtos pedidos em um intervalo de tempo
DROP FUNCTION IF EXISTS calcular_quantidade_produtos;

DELIMITER $$
CREATE FUNCTION calcular_quantidade_produtos(produto_id INT, data_inicio DATE, data_fim DATE) RETURNS INT
BEGIN
    DECLARE quantidade_total INT;
    
    -- Calcular a quantidade total de produtos pedidos no período especificado
    SELECT SUM(ip.quantidade)
    INTO quantidade_total
    FROM itenspedido ip
    JOIN pedido p ON ip.pedido_codigo_pedido = p.codigo_pedido
    WHERE ip.produtos_codigo_produtos = produto_id
	  AND p.data_pedido BETWEEN data_inicio AND data_fim;

    -- Retornar a quantidade total de produtos pedidos
    RETURN quantidade_total;
END $$

DELIMITER ;

--- Exemplo Função 3
SELECT calcular_quantidade_produtos(67, '2024-02-20', '2024-12-30') AS quantidade_vendida;


--- PROCEDURE

--- Procedure 1 para gerar relatório de vendas por cliente em um intervalo de datas
DROP PROCEDURE IF EXISTS gerar_relatorio_vendas_cliente;
DELIMITER $$

CREATE PROCEDURE gerar_relatorio_vendas_cliente(data_inicio DATE, data_fim DATE)
BEGIN
    -- Selecionar o total de vendas por cliente no período especificado
    SELECT 
        c.codigo_cliente AS cliente_id,
        c.nome AS cliente_nome,
        SUM(ip.quantidade * ip.valor) AS total_vendas,
        GROUP_CONCAT(CONCAT(ip.produtos_codigo_produtos, ' (Quantidade: ', ip.quantidade, ', Total: ', ip.quantidade * ip.valor, ')') SEPARATOR '; ') AS produtos_comprados
    FROM 
        pedido p
    JOIN 
        cliente c ON p.cliente_codigo_cliente = c.codigo_cliente
    JOIN 
        itenspedido ip ON p.codigo_pedido = ip.pedido_codigo_pedido
    WHERE 
        p.data_pedido BETWEEN data_inicio AND data_fim
    GROUP BY 
        c.codigo_cliente, c.nome
    ORDER BY 
        total_vendas DESC;
END $$

DELIMITER ;

--- Exemplo Procedure 1
CALL gerar_relatorio_vendas_cliente('2024-01-01', '2024-12-01');

--- Procedure 2 para buscar o total gasto por cliente
DROP PROCEDURE IF EXISTS buscar_total_gasto_cliente;
DELIMITER $$

CREATE PROCEDURE `buscar_total_gasto_cliente` (IN p_cliente_id INT)
BEGIN
  DECLARE total_gasto DECIMAL(10,2);

  SELECT SUM(valor_pedido) INTO total_gasto
  FROM pedido
  WHERE cliente_codigo_cliente = p_cliente_id;

  SELECT c.nome AS nome_cliente, total_gasto
  FROM cliente c
  INNER JOIN (
    SELECT cliente_codigo_cliente, SUM(valor_pedido) AS total_gasto
    FROM pedido
    GROUP BY cliente_codigo_cliente
  ) AS p ON c.codigo_cliente = p.cliente_codigo_cliente
  WHERE c.codigo_cliente = p_cliente_id;
END $$

DELIMITER ;

--- Exemplo Procedure 2
CALL buscar_total_gasto_cliente(1);


--- Procedure 3 para inserir um cliente e seu respectivo usuário
DROP PROCEDURE IF EXISTS inserir_cliente_usuario;
DELIMITER $$

CREATE PROCEDURE inserir_cliente_usuario(
    IN p_nome VARCHAR(100),
	IN p_cpf VARCHAR(11),
    IN p_email VARCHAR(100),
    IN p_telefone VARCHAR(15),
    IN p_username VARCHAR(50),
    IN p_senha VARCHAR(255)
)
BEGIN
    DECLARE cliente_id INT;
    
    -- Inserir um novo cliente
    INSERT INTO cliente (nome, cpf, email, telefone, data_criacao)
    VALUES (p_nome, p_cpf, p_email, p_telefone, CURRENT_DATE());
    
    -- Obter o ID do cliente recém-inserido
    SET cliente_id = LAST_INSERT_ID();
   
    -- Inserir o respectivo usuário para o cliente
    INSERT INTO usuario (nome, login, senha, email, perfil_codigo_perfil, cliente_codigo_cliente)
    VALUES (p_nome, p_username, p_senha, p_email, 1, cliente_id);
    
    -- Retornar o ID do cliente inserido
    SELECT cliente_id AS novo_cliente_id;
END $$

DELIMITER ;

--- Exemplo Procedure 3
CALL inserir_cliente_usuario('Nome do Cliente', '12345678901', 'email@exemplo.com', '12 3456-7890', 'nome_usuario', 'senha');