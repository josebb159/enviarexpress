Create table notificacion_correo(
	id_notificacion_correo int AUTO_INCREMENT,  
	correo varchar(100),
	accion varchar(100),
	nombre varchar(100),
	fecha_registro TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
	fecha_actualizacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
	estado int,
	primary key(id_notificacion_correo)
)
