Create table configuracion(
	id_configuracion int AUTO_INCREMENT,  
	algo_radpio varchar(100),
	ar_km_adicional varchar(100),
	mejor_ir_con_tiempo varchar(100),
	mict_km_adicional varchar(100),
	viaja_en_carro varchar(100),
	vec_km_adicional varchar(100),
	whatsapp varchar(100),
	fecha_registro TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
	fecha_actualizacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
	estado int,
	primary key(id_configuracion)
)
