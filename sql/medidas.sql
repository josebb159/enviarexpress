Create table medidas(
	id_medidas int AUTO_INCREMENT,  
	nombre varchar(100),
	descripcion varchar(100),
	fecha_registro TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
	fecha_actualizacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
	primary key(id_medidas)
)
