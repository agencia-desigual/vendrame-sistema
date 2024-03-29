CREATE TABLE usuario (
   id_usuario INT NOT NULL AUTO_INCREMENT,
   nome VARCHAR(150) NOT NULL,
   cpf VARCHAR(50) NULL DEFAULT NULL,
   senha VARCHAR(100) NOT NULL,
   status BOOLEAN NOT NULL DEFAULT true,
   nivel ENUM('admin', 'vendedor') NOT NULL,
   cadastro TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,

   PRIMARY KEY (id_usuario)
);


CREATE TABLE token(
  id_token INT NOT NULL AUTO_INCREMENT,
  id_usuario INT NOT NULL,
  token TEXT NOT NULL,
  ip VARCHAR(100) NOT NULL,
  data_expira TIMESTAMP NOT NULL,
  data TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id_token),
  FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario)
);


CREATE TABLE historico(
  id_historico INT NOT NULL AUTO_INCREMENT,
  id_usuario INT NOT NULL,
  tabela VARCHAR(100) NULL DEFAULT NULL,
  chavePrimaria VARCHAR(100) NULL DEFAULT NULL,
  acao VARCHAR(150) NOT NULL,
  descricao TEXT NOT NULL,
  json TEXT NULL DEFAULT NULL,
  data TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id_historico)
);


CREATE TABLE marca(
  id_marca INT NOT NULL AUTO_INCREMENT,
  nome VARCHAR(150) NOT NULL,
  logo VARCHAR(150) NULL DEFAULT NULL,
  cadastro TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id_marca)
);


CREATE TABLE banner(
  id_banner INT NOT NULL AUTO_INCREMENT,
  imagem VARCHAR(150) NOT NULL,
  cadastro TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id_banner)
);


CREATE TABLE categoria(
  id_categoria INT NOT NULL AUTO_INCREMENT,
  id_categoria_pai INT NULL DEFAULT NULL,
  nome VARCHAR(100) NOT NULL,
  FOREIGN KEY (id_categoria_pai) REFERENCES categoria(id_categoria),
  PRIMARY KEY (id_categoria)
);


CREATE TABLE tipo(
  id_tipo INT NOT NULL AUTO_INCREMENT,
  id_marca INT NOT NULL,
  nome VARCHAR(100) NOT NULL,
  FOREIGN KEY (id_marca) REFERENCES marca(id_marca),
  PRIMARY KEY (id_tipo)
);


CREATE TABLE tratamento(
 id_tratamento INT NOT NULL AUTO_INCREMENT,
 nome VARCHAR(100) NOT NULL,
 PRIMARY KEY (id_tratamento)
);


CREATE TABLE indice(
   id_indice INT NOT NULL AUTO_INCREMENT,
   nome VARCHAR(100) NOT NULL,
   PRIMARY KEY (id_indice)
);


CREATE TABLE produto(
    id_produto INT NOT NULL AUTO_INCREMENT,
    id_categoria INT NOT NULL,
    id_tipo INT NULL DEFAULT NULL,
    id_tratamento INT NULL DEFAULT NULL,
    id_indice INT NULL DEFAULT NULL,
    id_marca INT NULL DEFAULT NULL,
    id_usuario INT NULL DEFAULT NULL, -- Id do usuário que adicionou o produto

    nome VARCHAR(150) NOT NULL,
    referencia VARCHAR(50) NULL DEFAULT NULL,
    descricao LONGBLOB NULL DEFAULT NULL,

    valorPago DOUBLE NOT NULL DEFAULT 0,
    valorVenda DOUBLE NULL DEFAULT NULL, -- Pode não ser informado
    descontoFornecedor DOUBLE NULL DEFAULT NULL,
    valorPromocao DOUBLE NOT NULL DEFAULT 0,

    lucro DOUBLE NULL DEFAULT NULL, -- Porcentagem de lucro
    desconto DOUBLE NULL DEFAULT NULL, -- Porcentagem de desconto

    prazoEntrega TEXT NULL DEFAULT NULL,

    esfMin DOUBLE NOT NULL DEFAULT 0,
    esfMax DOUBLE NOT NULL DEFAULT 0,
    cil DOUBLE NOT NULL DEFAULT 0,
    adicaoMin DOUBLE NOT NULL DEFAULT 0,
    adicaoMax DOUBLE NOT NULL DEFAULT 0,
    altura DOUBLE NOT NULL DEFAULT 0,

    status BOOLEAN NOT NULL DEFAULT true,
    cadastro TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY (id_produto),
    FOREIGN KEY (id_categoria) REFERENCES categoria(id_categoria),
    FOREIGN KEY (id_tratamento) REFERENCES tratamento(id_tratamento),
    FOREIGN KEY (id_indice) REFERENCES indice(id_indice),
    FOREIGN KEY (id_tipo) REFERENCES tipo(id_tipo),
    FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario),
    FOREIGN KEY (id_marca) REFERENCES marca(id_marca)
);


CREATE TABLE imagem(
   id_imagem INT NOT NULL AUTO_INCREMENT,
   id_produto INT NOT NULL,

   imagem VARCHAR(150) NOT NULL,
   principal BOOLEAN NOT NULL DEFAULT false,

   cadastro TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
   PRIMARY KEY (id_imagem),
   FOREIGN KEY (id_produto) REFERENCES produto(id_produto)
);

CREATE TABLE ficha_tecnica(
  id_ficha_tecnica INT NOT NULL AUTO_INCREMENT,
  id_produto INT NOT NULL,
  campo VARCHAR(100) NOT NULL,
  descricao TEXT NOT NULL,
  cadastro TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,

  PRIMARY KEY (id_ficha_tecnica),
  FOREIGN KEY (id_produto) REFERENCES produto(id_produto)
);


CREATE TABLE atributo(
  id_atributo INT NOT NULL AUTO_INCREMENT,
  nome VARCHAR(100) NOT NULL,
  descricao TEXT NULL DEFAULT NULL,
  imagem VARCHAR(150) NULL DEFAULT NULL,
  PRIMARY KEY (id_atributo)
);

CREATE TABLE atributo_produto(
  id_atributo_produto INT NOT NULL AUTO_INCREMENT,
  id_produto INT NOT NULL,
  id_atributo INT NOT NULL,
  PRIMARY KEY (id_atributo_produto),
  FOREIGN KEY (id_atributo) REFERENCES atributo(id_atributo),
  FOREIGN KEY (id_produto) REFERENCES produto(id_produto)

);

CREATE TABLE servico(
    id_servico INT NOT NULL AUTO_INCREMENT,
    id_marca INT NULL DEFAULT NULL,
    tipo ENUM('sevico','padronizacao') NOT NULL,
    nome  VARCHAR(100) NOT NULL,
    descricao TEXT NULL DEFAULT NULL,
    valor DOUBLE NOT NULL DEFAULT 0,
    status BOOLEAN NOT NULL DEFAULT true,
    PRIMARY KEY (id_servico)
);