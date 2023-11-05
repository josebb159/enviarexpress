Create table mensaje(
	id_mensaje int AUTO_INCREMENT,  
	mensaje varchar(100),
	descripcion varchar(100),
	fecha_registro TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
	fecha_actualizacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
	estado int,
	primary key(id_mensaje)
)
