Create table producto(
	id_producto int AUTO_INCREMENT,  
	id_comercios int,
	nombre varchar(100),
	descripcion varchar(100),
	cantidad varchar(100),
	imagen varchar(100),
	fecha_registro TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
	fecha_actualizacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
	estado int,
	primary key(id_producto)
	,FOREIGN KEY(id_comercios) REFERENCES comercios(id_comercios)
)
