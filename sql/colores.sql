Create table colores(
	id_colores int AUTO_INCREMENT,  
	nombre varchar(100),
	descripcion varchar(100),
	codigo varchar(100),
	fecha_registro TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
	fecha_actualizacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
	primary key(id_colores)
)
