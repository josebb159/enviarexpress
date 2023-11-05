Create table delivery(
	id_delivery int AUTO_INCREMENT,  
	id_usuario int,
	nombre varchar(100),
	cedula varchar(100),
	foto_cedula varchar(100),
	foto_licencia varchar(100),
	foto_soat varchar(100),
	foto_tecnomecanica varchar(100),
	foto_tarjeta varchar(100),
	propiedad varchar(100),
	foto_facial varchar(100),
	direccion varchar(100),
	numero varchar(100),
	numero_emergencia varchar(100),
	fecha_registro TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
	fecha_actualizacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
	estado int,
	primary key(id_delivery)
	,FOREIGN KEY(id_usuario) REFERENCES usuarios(id)
)
