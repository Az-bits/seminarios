create table
    facilitadores(
        id_facilitador int primary key auto_increment,
        ci varchar(30),
        nombres varchar(30),
        paterno varchar(30),
        materno varchar(30),
        genero char(1),
        celular varchar(20),
        correo varchar(80),
        fecha_creacion date,
        fecha_modificacion date,
        constraint unik_correo unique(correo),
        constraint unik_ci unique(ci),
        constraint ck_genero check(genero in('F', 'M'))
    )

delimiter //

CREATE OR REPLACE TRIGGER t_facilitador before insert 
ON facilitadores FOR EACH ROW 
BEGIN 
	SET NEW.fecha_creacion = NOW();
END; 

// 

delimiter ;

delimiter //

CREATE OR REPLACE TRIGGER t_facilitador_up before UPDATE 
ON facilitadores FOR EACH ROW 
BEGIN 
	SET NEW.fecha_modificacion = NOW();
END; 

// 

delimiter ;

TRUNCATE TABLE FACILITADORES SET FOREIGN_KEY_CHECKS = 0;

SET FOREIGN_KEY_CHECKS = 1;

drop trigger t_facilitador SHOW TRIGGERS;

update FACILITADORES
set nombres = 'juan'
where ID_FACILITADOR = 1
insert into facilitadores
values
(
        null,
        '12341234',
        'Edwin',
        'Alanoca',
        'Ramirez',
        'M',
        '67109724',
        'azbitsa@gmai.com',
        NULL,
        NULL
    );

insert into facilitadores(ci,genero) values('1111111','F');

insert into facilitadores
values
(
        null,
        '12341234',
        'Juan',
        'Alanoca',
        'Ramirez',
        'M',
        '67109724',
        'juani@gmail.com'
    );

drop table facilitadores select * from facilitadores SELECT NOW();

--------------------------------------------------------------------------------------------------------------------------

TRUNCATE TABLE CURSOS drop table if exists cursos;

create table
    cursos(
        id_curso int primary key auto_increment,
        nombre_curso varchar(100),
        modalidad varchar(50),
        precio decimal(7, 2),
        id_facilitador int,
        fecha_creacion date,
        fecha_modificacion date,
        constraint fk_cursos foreign key (id_facilitador) references facilitadores(id_facilitador),
        constraint unik_nom unique(nombre_curso)
    );

delimiter //

CREATE OR REPLACE TRIGGER t_cursos_in before insert 
ON cursos FOR EACH ROW 
BEGIN 
	SET NEW.fecha_creacion = NOW();
END; 

// 

delimiter ;

delimiter //

CREATE OR REPLACE TRIGGER t_cursos_up before UPDATE 
ON cursos FOR EACH ROW 
BEGIN 
	SET NEW.fecha_modificacion = NOW();
END; 

// 

delimiter ;

show triggers select now() from dual;

select user(), CURRENT_user()
select *
from cursos
drop table cursos
insert into cursos
values
(
        null,
        'PROGRAMACION ORIENTADA A OBJETOS',
        100,
        1
    );

insert into cursos values(null,'DISEÑO GRAFICO',50,2);

insert into cursos values(null,'API REST',50,2);

--------------------------------------------------------------------------------------------------------------------------

drop table PARTICIPANTES
create table
    participantes(
        id_participante int primary key auto_increment,
        ci varchar(30),
        nombres varchar(30),
        paterno varchar(30),
        materno varchar(30),
        genero char(1),
        celular varchar(20),
        correo varchar(80),
        fecha_creacion date,
        fecha_modificacion date,
        constraint unik_ci unique(ci),
        constraint unik_correo unique(correo),
        constraint ck_genero check(genero in('F', 'M'))
    )

delimiter //

CREATE OR REPLACE TRIGGER t_participantes_in before 
insert ON participantes FOR EACH ROW 
BEGIN 
	SET NEW.fecha_creacion = NOW();
END; 

// 

delimiter ;

delimiter //

CREATE OR REPLACE TRIGGER t_participantes_up before 
UPDATE ON participantes FOR EACH ROW 
BEGIN 
	SET NEW.fecha_modificacion = NOW();
END; 

// 

delimiter ;

select *
from participantes
drop table participantes
show triggers
insert into participantes
values
(
        null,
        '11111111',
        'Lia',
        'Alanoca',
        'Ramirez',
        'F',
        '67109724',
        'azbitsa@gmail.com',
        '',
        ''
    );

insert into participantes
values
(
        null,
        '22222222',
        'Ana',
        'Alanoca',
        'Ramirez',
        'F',
        '67109724',
        'juani@gmail.com'
    );

create table
    mae_capacitaciones(
        id_mae_capacitacion int primary key auto_increment,
        fecha_ini date,
        fecha_fin date,
        id_curso int,
        constraint fk_capacitaciones1 foreign key (id_curso) references cursos(id_curso)
    )
insert into
    mae_capacitaciones
values
(
        null,
        '2022-07-18',
        '2022-07-20',
        23
    );

insert into mae_capacitaciones
values
(
        null,
        '2022-07-18',
        '2022-07-20',
        24
    );

insert into mae_capacitaciones
values
(
        null,
        '2022-07-28',
        '2022-08-20',
        26
    );

select *
from m
select *
from mae_capacitaciones
create table
    det_capacitaciones(
        id_det_capacitacion int primary key auto_increment,
        id_participante int,
        id_mae_capacitacion int,
        constraint fk_capacitaciones2 foreign key (id_participante) references participantes(id_participante),
        constraint fk_capacitaciones3 foreign key (id_mae_capacitacion) references mae_capacitaciones(id_mae_capacitacion)
    )
insert into
    det_capacitaciones
values(null, 12, 2);

insert into det_capacitaciones values(null,13,2);

insert into det_capacitaciones values(null,12,3);

insert into det_capacitaciones values(null,14,2);

insert into det_capacitaciones values(null,15,2);

insert into det_capacitaciones values(null,16,2);

insert into det_capacitaciones values(null,14,5);

select *
from det_capacitaciones
select *
from det_capacitaciones
drop table
    det_capacitaciones
SELECT now()
select
    m.id_mae_capacitacion,
    c.nombre_curso,
    fecha_ini,
    fecha_fin,
    count(nombre_curso)
from mae_capacitaciones m
    join det_capacitaciones d on m.id_mae_capacitacion = d.id_mae_capacitacion
    join cursos c on c.id_curso = m.id_curso
group by
    m.id_mae_capacitacion,
    c.nombre_curso