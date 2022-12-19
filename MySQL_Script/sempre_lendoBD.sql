create database sempre_lendo;

use sempre_lendo;

create table usuario(
	id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    usuario varchar(50),
    email varchar(50),
    senha varchar(50)
);

create table livro(
	id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    livro_nome varchar(50),
    genero varchar(50),
    editora varchar(50),
    status_livro varchar(50),
    comentario varchar(500),
    usuario_id int not null
);