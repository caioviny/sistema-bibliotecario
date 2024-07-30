CREATE DATABASE IF NOT EXISTS Biblioteca;

USE Biblioteca;

CREATE TABLE IF NOT EXISTS livros (
  id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  titulo VARCHAR(100) NOT NULL,
  autor VARCHAR(100) NOT NULL,
  editora VARCHAR(100) DEFAULT NULL,
  ano INT(11) DEFAULT NULL,
  isbn VARCHAR(20) DEFAULT NULL,
  quantidade INT(11) NOT NULL,
  capa MEDIUMBLOB DEFAULT NULL,
  disponibilidade ENUM('Disponível', 'Indisponível') NOT NULL DEFAULT 'Disponível'
);

CREATE TABLE IF NOT EXISTS usuarios (
  id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  senha VARCHAR(255) NOT NULL,
  tipo VARCHAR(50) DEFAULT NULL,
  foto MEDIUMBLOB DEFAULT NULL,
  nome_foto VARCHAR(255) DEFAULT NULL,
  tipo_foto VARCHAR(50) DEFAULT NULL
);

CREATE TABLE IF NOT EXISTS emprestimo (
  id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  usuario_id INT(11) NOT NULL,
  livro_id INT(11) NOT NULL,
  data_emprestimo DATE NOT NULL,
  data_devolucao DATE DEFAULT NULL,
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
  FOREIGN KEY (livro_id) REFERENCES livros(id)
);

SELECT * FROM emprestimo;
SELECT * FROM usuarios;
SELECT * FROM livros;

DROP DATABASE Biblioteca;
DROP TABLE IF EXISTS usuarios;
DROP TABLE IF EXISTS emprestimo;

CREATE USER IF NOT EXISTS 'Admin'@'localhost' IDENTIFIED BY '12345';
GRANT SELECT, INSERT, UPDATE, DELETE ON biblioteca.* TO 'Admin'@'localhost';

DROP USER IF EXISTS 'Admin'@localhost;

SELECT * FROM livros WHERE id NOT IN (SELECT livro_id FROM emprestimo WHERE data_devolucao IS NULL);
SELECT * FROM emprestimo WHERE livro_id = 1;
