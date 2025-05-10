CREATE TABLE mesas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    numero INT UNIQUE NOT NULL,
    qr_code VARCHAR(255) UNIQUE NOT NULL,
    status VARCHAR(20) NOT NULL CHECK (status IN ('disponível', 'ocupada', 'reservada')),
    descricao TEXT
    
);

CREATE TABLE clientes (
id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    telefone VARCHAR(20)

);


CREATE TABLE itens_cardapio (
id  INT AUTO_INCREMENT PRIMARY KEY,
nome VARCHAR(100) NOT NULL,
descricao TEXT,
preco DECIMAL(10,2) NOT NULL,
categoria VARCHAR (50),
ativo boolean not null

);

CREATE TABLE pedidos (
id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT NOT NULL,
    mesa_id INT,
    data_pedido DATETIME NOT NULL,
    status VARCHAR(30) NOT NULL,
    observacoes TEXT,
    FOREIGN KEY (cliente_id) REFERENCES clientes(id),
    FOREIGN KEY (mesa_id) REFERENCES mesas(id)
 );
 
 CREATE TABLE pedidos_itens (
 id INT AUTO_INCREMENT PRIMARY KEY,
    pedido_id INT NOT NULL,
    item_id INT NOT NULL,
    quantidade INT NOT NULL,
    preco_unitario DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (pedido_id) REFERENCES pedidos(id),
    FOREIGN KEY (item_id) REFERENCES itens_cardapio(id)
 ); 
 
 CREATE TABLE pagamento (
 id INT AUTO_INCREMENT PRIMARY KEY,
 pedido_id int,
 valor decimal(10,2) not null,
 metodo varchar(30) not null,
 status varchar(30) not null,
 data_pagamento datetime,
 FOREIGN KEY (pedido_id) REFERENCES pedidos(id)
 );
 
 
 
 