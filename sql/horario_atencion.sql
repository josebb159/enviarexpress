Create table horario_atencion(
	id_horario_atencion int AUTO_INCREMENT,  
	id_comercios int,
	lunes_am varchar(100),
	lunes_pm varchar(100),
	martes_am varchar(100),
	mertes_pm varchar(100),
	miercoles_am varchar(100),
	miercoles_pm varchar(100),
	jueves_am varchar(100),
	jueves_pm varchar(100),
	viernes_am varchar(100),
	viernes_pm varchar(100),
	sabado_am varchar(100),
	sabado_pm varchar(100),
	domingo_am varchar(100),
	domingo_pm varchar(100),
	fecha_registro TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
	fecha_actualizacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
	estado int,
	primary key(id_horario_atencion)
	,FOREIGN KEY(id_comercios) REFERENCES comercios(id_comercios)
)
