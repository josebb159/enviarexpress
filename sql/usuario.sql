Create table usuario(
	id_usuario int AUTO_INCREMENT,  
	nombre varchar(100),
	apellido varchar(100),
	usuario varchar(100),
	contrasena varchar(100),
	fecha_registro TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
	fecha_actualizacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
	primary key(id_usuario)
)
