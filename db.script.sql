#--------------------------------- 
create table
    cursos(
        id_curso int primary key auto_increment,
        nombre_curso varchar(100),
        modalidad varchar(50),
        precio decimal(7, 2),
        objetivos varchar(255),
        fecha_creacion date,
        fecha_modificacion date,
        constraint unik_nom unique(nombre_curso)
    );

delimiter //

create or replace trigger t_cursos_in before insert 
on cursos for each row
begin 
	set new.fecha_creacion = now();
end; 

// 

delimiter ;

delimiter //

create or replace trigger t_cursos_up before update 
on cursos for each row
begin 
	set new.fecha_modificacion = now();
end;
// 

delimiter ;

create table 
	cursos_docentes(
		id_curso_docente int primary key,
		id_persona int,
		id_curso int,
		celular int,
		correo varchar(100),
		#constraint fk_cur_doc_1 foreign key (id_persona) references persona(id_persona),
		constraint fk_cur_doc_2 foreign key (id_curso) references cursos(id_curso),
		constraint unik_corr unique(correo)
 	);
create table 
	cursos_multimedia(
		id_curso_multimedia int primary key auto_increment,
		id_curso int,
		id_persona int,
		id_multimedia_publicaciones int,
		constraint fk_cur_mult_1 foreign key (id_curso) references cursos(id_curso),
		constraint fk_cur_mult_2 foreign key (id_multimedia_publicaciones) references multimedia(id_multimedia_publicaciones)
		#constraint fk_ins_cursos2 foreign key (id_persona) references persona(id_persona)
	);
create table
    inscripciones_cursos(
        id_inscripcion_curso int primary key auto_increment,
        fecha_ini date,
        fecha_fin date,
        celular int,
        correo varchar(100),
        id_curso int,
        id_persona int,
        fecha_creacion date,
        fecha_modificacion date,
        constraint fk_ins_cursos1 foreign key (id_curso) references cursos(id_curso),
        # constraint fk_ins_cursos2 foreign key (id_persona) references persona(id_persona),
        constraint unik_correo_cursos unique(correo)
    );

delimiter //

create or replace trigger t_ins_curso_in before insert 
on inscripciones_cursos for each row
begin 
	set new.fecha_creacion = now();
end; 

// 

delimiter ;

delimiter //

create or replace trigger t_ins_curso_up before update
on inscripciones_cursos for each row
begin 
	set new.fecha_modificacion = now();
end;
// 

delimiter ;

#---------------------------------------------------------------------------------------------------------------------------------------------------------------------------
create table
    multimedia(
        id_multimedia int primary key auto_increment,
        url varchar(300),
        extension varchar(20),
        fecha_registro date,
        tamaño varchar(20),
        fecha_creacion date,
        fecha_modificacion date,
    );
delimiter //

create or replace trigger t_multimedia_in before insert 
on multimedia for each row
begin 
	set new.fecha_creacion = now();
end; 

// 

delimiter ;

delimiter //

create or replace trigger t_multimedia_up before update 
on multimedia for each row
begin 
	set new.fecha_modificacion = now();
end;
// 

delimiter ;
   
create table
    tipo_publicacion(
        id_tipo_publicacion int primary key auto_increment,
        actividad varchar(255),
        reglamento varchar(255),
        normativa varchar(255) 	
    );

create table
    publicaciones(
        id_publicacion int primary key auto_increment,
        id_usuario int,
        detalle varchar(255),
        fecha_inicio date,
        fecha_fin date,
        id_tipo_publicacion int,
        fecha_creacion date,
        fecha_modificacion date,
        constraint fk_publicaciones_1 foreign key (id_tipo_publicacion) references tipo_publicacion(id_tipo_publicacion)
        #constraint fk_publicaciones_2 foreign key (id_usuario) references usuarios(id_usuario)
    );

create table
    multimedia_publicaciones(
        id_multimedia_publicaciones int primary key auto_increment,
        id_multimedia int,
        id_publicacion int,
        constraint fk_multimedia_public_1 foreign key(id_multimedia) references multimedia(id_multimedia),
        constraint fk_multimedia_public_2 foreign key(id_publicacion) references publicaciones(id_publicacion)
    );

#--------------------------------------------------------------------------------------------------------------------------------------------------------
create table
    defectos(
        id_defecto int primary key auto_increment,
        descripcion varchar(255),
        tipo_defecto varchar(50)
    );
create table
    formularios_mantenimientos(
        id_formulario_mantenimiento int primary key auto_increment,
        id_persona int,
        id_asignacion_administrativo int,
        equipo varchar(50),
        marca varchar(50),
        modelo varchar(50),
        cod_activo_fijo varchar(20),
        id_defecto int,
        estado varchar(20),
        fecha_creacion date,
        fecha_modificacion date,
        constraint fk_form_mant_1 foreign key(id_defecto) references defectos(id_defecto)
        #constraint fk_form_mant_2 foreign key(id_persona) references persona(id_persona),
        #constraint fk_form_mant_3 foreign key(id_asignacion_administrativo) references view_asignacion_administrativo (id_asignacion_administrativo)
    );

create table
    partes_equipo(
        id_parte_equipo int primary key auto_increment,
        parte_equipo varchar(50),
        marca varchar(50),
        modelo varchar(50)
    );

create table
    revisiones_realizadas(
        id_revision_realizada int primary key auto_increment,
        estado varchar(30),
        observacion varchar(255),
        id_formulario_mantenimiento int,
        id_parte_equipo int,
        fecha date,
        constraint fk_rev_real_1 foreign key(id_formulario_mantenimiento) references formularios_mantenimientos(id_formulario_mantenimiento),
        constraint fk_rev_real_2 foreign key(id_parte_equipo) references partes_equipo(id_parte_equipo)
    );

#----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
create table
    procedimientos_redes(
        id_procedimiento_redes int primary key auto_increment
    );
create table
    formulario_redes(
        id_formulario_redes int primary key auto_increment,
        id_persona int,
        id_asignacion_academico int,
        id_procedimiento_redes int,
        detalles varchar(100),
        fecha_creacion date,
        fecha_modificacion date,
        #constraint fk_form_redes_1 foreign key(id_persona) references persona(id_persona),
        #constraint fk_form_redes_2 foreign key(id_asignacion_academico) references view_asignacion_academico(id_asignacion_academico),
        constraint fk_form_redes_3 foreign key(id_procedimiento_redes) references procedimientos_redes(id_procedimiento_redes)
    );
create table 
	materiales_upea(
		id_material int primary key auto_increment
	);
create table
	materiales_usados(
		id_material_usado int primary key auto_increment,
		id_material int,
		cantidad int,
		id_formulario_redes int,
		fecha_uso date,
		constraint fk_mat_usad_1 foreign key(id_formulario_redes) references formulario_redes(id_formulario_redes),
		constraint fk_mat_usad_2 foreign key(id_material) references materiales_upea(id_material)
	);
	
#----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
create table 
	formulario_software(
		id_formulario_software int primary key auto_increment,
        id_persona int,
        id_asignacion_academico int,
        tipo_trabajo varchar(20),
        id_sistemas int,
        modulo varchar(25),
        observaciones varchar(255)
        #constraint fk_form_soft_1 foreign key(id_persona) references persona(id_persona),
        #constraint fk_form_soft_2 foreign key(id_asignacion_academico) references view_asignacion_academico(id_asignacion_academico),
        #constraint fk_form_soft_3 foreign key(id_sistemas) references sistemas(id_sistemas),
               
	);
#----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
create table 
	tipos_personal(
		id_tipo_personal int primary key auto_increment,
		tipo_personal varchar(50)
	);
create table 
	formulario_cuenta_usuario(
		id_formulario_cuenta_usuario int primary key auto_increment,
		id_persona int,
        id_asignacion_academico int,
        id_asignacion_documento int,
        id_sistema int,
        tipo_operacion varchar(20),
        celular int,
        correo varchar(100),
        observaciones varchar(255),
        id_tipo_personal int,
        constraint fk_cuent_usua_1 foreign key(id_tipo_personal) references tipos_personal(id_tipo_personal)
        #constraint fk_cuent_usua_2 foreign key(id_sistemas) references sistemas(id_sistemas),
        #constraint fk_cuent_usua_3 foreign key(id_persona) references persona(id_persona),
        #constraint fk_cuent_usua_4 foreign key(id_asignacion_academico) references view_asignacion_academico(id_asignacion_academico),
        #constraint fk_cuent_usua_5 foreign key(id_sistemas) references sistemas(id_sistemas),
	);
#----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
create table 
	reg_eliminados(
		id_reg_eliminado int primary key auto_increment,
		id_usuario int,
		detalles varchar(255),
		fecha_eliminacion date
	);


   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   