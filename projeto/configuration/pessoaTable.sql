--script de criação da tabela do banco de dados
--decidi o deixar bem simples pois não há mais nenhuma tabela para ele se relacionar
create table Pessoa(
	ID serial,
	Nome varchar(42),
	email varchar(240),
	telefone varchar(20)
);