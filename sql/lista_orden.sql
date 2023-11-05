Create table lista_orden(
	id_lista_orden int AUTO_INCREMENT,  
	id_producto int,
	cantidad varchar(100),
	valor_uni varchar(100),
	valor_total varchar(100),
	fecha_registro TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
	fecha_actualizacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
	estado int,
	primary key(id_lista_orden)
	,FOREIGN KEY(id_producto) REFERENCES producto(id_producto)
)
