create database vgs;
use vgs;

create table if not exists consoles(
id int(1) not null auto_increment,
nome varchar(50) not null,
fabricante varchar(50) not null,
primary key (id)
)ENGINE=InnoDB  DEFAULT CHARSET=latin1;

create table if not exists status(
id int(1) not null,
nome varchar(50) not null,
primary key(id)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

create table if not exists jogos ( 
    id int(1) not null auto_increment,
    nome varchar(50) not null,
	status  int(1) not null,
    console int not null,
    primary key (id),
	foreign key (status) references status(id),
    foreign key(console) references consoles(id)
    )ENGINE=InnoDB  DEFAULT CHARSET=latin1;

insert into status(id,nome)values
(1,'Jogando'),
(2,'Jogado'),
(3,'A Jogar');