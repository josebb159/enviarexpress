Create table categoria(
	id_categoria int AUTO_INCREMENT,  
	descripcion varchar(100),
	estatus varchar(1),
	fecha_registro TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
	fecha_actualizacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
	primary key(id_categoria)
)
