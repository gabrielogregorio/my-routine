# Minha-Rotina
Programa para estudar implementações no PHP, por este motivo, não contém um README perfeitinho, por enquanto...

Versão beta disponível em: https://gabrielogregorio.com/projetos/minha-rotina/

# Dependências
1. composer require vlucas/phpdotenv

# Banco de dados
```sql
create DATABASE nome_database;
```

```sql
create table usuarios (
	id int primary key AUTO_INCREMENT,
	login varchar(100),
	senha varchar(60)
)
```

```sql
create table tarefas (
	id int PRIMARY KEY AUTO_INCREMENT,
	id_usuario int not null,
	nome varchar(150),
	marcada boolean,
	FOREIGN key (id_usuario) REFERENCES usuarios(id)
)
```
