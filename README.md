<div align="center">
	<img height="30" alt="Javascript" src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white">
	<img height="30" alt="Javascript" src="https://img.shields.io/badge/MySQL-00000F?style=for-the-badge&logo=mysql&logoColor=white">
	  <img height="30" alt="css3" src="https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white">
  <img height="30" alt="html5" src="https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white">
  <img height="30" alt="Javascript" src="https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black">

</div>

<h3 align="center">Programa de controle de rotina em PHP</h3>
<p align="center">
  Um programa de controle de rotina, onde através de um cadastro na plataforma é possível fazer o gerenciamento de tarefas que devem ser cumpridas durante um dia.
  <br>
	<a href="https://gabrielogregorio.com/projetos/minha-rotina/"><strong>Ver demonstrativo »</strong></a>
  <br>
	
</p>

<h3>Informações gerais</h3>

![GitHub estrelas](https://img.shields.io/github/stars/gabrielogregorio/Minha-Rotina)
![GitHub last commit](https://img.shields.io/github/last-commit/gabrielogregorio/Minha-Rotina?style=flat-square)
![GitHub contributors](https://img.shields.io/github/contributors/gabrielogregorio/Minha-Rotina)
![GitHub language count](https://img.shields.io/github/languages/count/gabrielogregorio/Minha-Rotina)
![GitHub repo size](https://img.shields.io/github/repo-size/gabrielogregorio/Minha-Rotina)

### Introdução        
Esse projeto se trata de um estudo de PHP, onde podemos criar uma conta através de e-mail e senha, e podemos então adicionar tarefas que deverão ser cumpridas durante a rotina, como caminhadas, checar e-mails ou assistir uma aula de Javascript por exemplo.

### Como iniciar    
Você precisará de ter o composer habilitado e executar o seguinte comando para instalar o PHPdotenv
```shell
composer require vlucas/phpdotenv
```

Agora crie e configure um arquivo ".env" com base no ".env.example" e forneça suas credenciais de conexão com um banco de dados mysql.

Agora crie o bando de dados e as tabela, alterando para os valores que você definir no seu ".env"
```sql
create DATABASE nome_database;

create table usuarios (
	id int primary key AUTO_INCREMENT,
	login varchar(100) unique,
	senha varchar(60)
)

create table tarefas (
	id int PRIMARY KEY AUTO_INCREMENT,
	id_usuario int not null,
	nome varchar(150),
	marcada boolean,
	FOREIGN key (id_usuario) REFERENCES usuarios(id)
)
```
Pronto, agora você só precisa executar o servidor apache.

### Capturas de tela
![Tela de login](images/img1.png)
![Tela de Itens](images/img2.png)
