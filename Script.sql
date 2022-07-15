create table facilitadores(
	id_facilitador int primary key auto_increment,
	ci varchar(30),
	nombres varchar(30),
	paterno varchar(30),
	materno varchar(30),
	genero char(1),
	celular varchar(20),
	correo varchar(80),
	constraint unik_correo unique(correo),
	constraint unik_ci unique(ci),
	constraint ck_genero check(genero in('F','M'))
)

insert into facilitadores values(null,'12341234','Edwin','Alanoca','Ramirez','M','67109724','azbitsa@gmai.com');
insert into facilitadores values(null,'12341234','Juan','Alanoca','Ramirez','M','67109724','juani@gmail.com');
drop table facilitadores 
select * from facilitadores 

create table cursos(
	id_curso int primary key auto_increment,
	nombre_curso varchar(100),
	precio decimal(7,2),
	id_facilitador int,
	constraint fk_cursos foreign key (id_facilitador) references facilitadores(id_facilitador)
)
select * from cursos
drop table cursos
insert into cursos values(null,'PROGRAMACION ORIENTADA A OBJETOS',100,1);
insert into cursos values(null,'DISEÑO GRAFICO',50,2);
insert into cursos values(null,'API REST',50,2);


create table participantes(
	id_participante int primary key auto_increment,
	ci varchar(30),
	nombres varchar(30),
	paterno varchar(30),
	materno varchar(30),
	genero char(1),
	telefono varchar(20),
	correo varchar(80) ,
	constraint unik_ci unique(ci),
	constraint unik_correo unique(correo),
	constraint ck_genero check(genero in('F','M'))
)

select * from participantes
drop table participantes 

insert into participantes values(null,'11111111','Lia','Alanoca','Ramirez','F','67109724','azbitsa@gmail.com');
insert into participantes values(null,'22222222','Ana','Alanoca','Ramirez','F','67109724','juani@gmail.com');

create table capacitaciones(
	id_capacitacion int primary key auto_increment,
	fecha_ini date,
	fecha_fin date,
	id_curso int,
	id_participante int,
	constraint fk_capacitaciones1 foreign key (id_curso) references cursos(id_curso),
	constraint fk_capacitaciones2 foreign key (id_participante) references participantes(id_participante)
)