Create table category(
	id_category int AUTO_INCREMENT,  
	nombre varchar(100),
	descripcion varchar(100),
	img varchar(100),
	fecha_registro TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
	fecha_actualizacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
	estado int,
	primary key(id_category)
)
