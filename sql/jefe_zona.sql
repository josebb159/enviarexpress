Create table jefe_zona(
	id_jefe_zona int AUTO_INCREMENT,  
	id_delivery int,
	nombre varchar(100),
	 sector varchar(100),
	fecha_registro TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
	fecha_actualizacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
	estado int,
	primary key(id_jefe_zona)
	,FOREIGN KEY(id_delivery) REFERENCES delivery(id_delivery)
)
