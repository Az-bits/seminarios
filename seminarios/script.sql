create table
    personas(
        id_persona int primary key auto_increment,
        ci varchar(30),
        nombres varchar(30),
        paterno varchar(30),
        materno varchar(30),
        genero char(1),
        celular varchar(20),
        correo varchar(80),
        direccion varchar(100),
        ocupacion varchar(80),
        fecha_creacion date,
        fecha_modificacion date
    );

create table
    cursos(
        id_curso int primary key auto_increment,
        nombre_curso varchar(100),
        modalidad varchar(50),
        precio decimal(7, 2),
        objetivo varchar(300),
        requisito varchar(300),
        contenido varchar(300),
        fecha_creacion date,
        fecha_modificacion date,
        constraint unik_nom unique(nombre_curso)
    );

create table
    multimedia(
        id_multimedia int primary key auto_increment,
        url varchar(300),
        extension varchar(20),
        fecha_registro date
    );

create table
    areas(
        id_area int primary key auto_increment,
        nombre_area varchar(100)
    );

create table
    campos(
        id_campo int primary key auto_increment,
        nombre_campo varchar(30)
    );

create table
    facilitadores(
        id_facilitador int primary key auto_increment,
        id_curso int,
        id_persona int,
        constraint fk_facilitadores_1 foreign key(id_curso) references cursos(id_curso),
        constraint fk_facilitadores_2 foreign key(id_persona) references personas(id_persona)
    );

create table
    form_persona(
        id_form_persona int primary key auto_increment,
        id_formulario int,
        id_persona int,
        constraint fk_form_persona_1 foreign key(id_formulario) references formularios(id_formulario),
        constraint fk_form_persona_2 foreign key(id_persona) references personas(id_persona)
    );

create table
    multimedia_form(
        id_multimedia_form int primary key auto_increment,
        id_multimedia int,
        id_formulario int,
        constraint fk_multimedia_form_1 foreign key(id_multimedia) references multimedia(id_multimedia),
        constraint fk_multimedia_form_2 foreign key(id_formulario) references formularios(id_formulario)
    );

create table
    servicios(
        id_servicio int primary key auto_increment,
        tipo_servicio varchar(100),
        id_campo int,
        constraint fk_servicios_1 foreign key(id_campo) references campos(id_campo)
    );

create table
    formularios(
        id_formulario int primary key auto_increment,
        asunto varchar(100),
        detalles varchar(300),
        id_curso int,
        id_area int,
        id_campo int,
        constraint fk_formularios_1 foreign key(id_curso) references cursos(id_curso),
        constraint fk_formularios_2 foreign key(id_area) references areas(id_area),
        constraint fk_formularios_3 foreign key(id_campo) references campos(id_campo)
    );