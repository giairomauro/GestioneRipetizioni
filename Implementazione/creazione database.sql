create database if not exists ripetizioni;

use ripetizioni;

create table if not exists tipo(
nome varchar(25) primary key
);

create table if not exists materia(
nome varchar(25),
argomento varchar(25),
primary key(nome, argomento)
);

create table if not exists utente(
id_utente int auto_increment primary key,
nome varchar(25) not null,
cognome varchar(25) not null,
telefono varchar(15) not null,
email varchar(30) not null,
password varchar(15) not null,
crediti int,
via varchar(30) not null,
CAP int not null,
citta varchar(25),

nome_tipo varchar(25),
foreign key (nome_tipo) references tipo(nome)
);

create table if not exists corso(
id_corso int auto_increment primary key,
data varchar(20) not null,
crediti int not null,
num_allievi int not null,

id_insegnante int,
nome_materia varchar(25),
argomento_materia varchar(25),
foreign key (id_insegnante) references utente(id_utente),
foreign key (nome_materia, argomento_materia) references materia(nome, argomento)
);