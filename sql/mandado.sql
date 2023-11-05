Create table mandado(
	id_mandado int AUTO_INCREMENT,  
	descripcion varchar(100),
	telefono varchar(100),
	direccion varchar(100),
	latitude varchar(100),
	longitude varchar(100),
	fecha_registro TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
	fecha_actualizacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
	estado int,
	primary key(id_mandado)
)
