Create table orden(
	id_orden int AUTO_INCREMENT,  
	descripcion varchar(100),
	cantidad varchar(100),
	valor varchar(100),
	fecha_registro TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
	fecha_actualizacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
	estado int,
	primary key(id_orden)
)
