<?php
if(isset($conect)){if($conect==1){}else{include 'db.php';$conect =1;}}else{include 'db.php';$conect =1;}
class orden {
	public $conexion;
	private $descripcion;
	private $cantidad;
	private $valor;


	public function __construct(){
		$this->conexion = new Conexion();
	}
 

	public function registrar_orden($id='204',$descripcion,$cantidad,$valor,$estado){
	$estado_defaul = 1;
	$sql = "INSERT INTO `orden`(`estado`,`descripcion`,`cantidad`,`valor`) VALUES (:estado,:descripcion,:cantidad,:valor)";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':estado' => $estado_defaul,':descripcion' => $descripcion,':cantidad' => $cantidad,':valor' => $valor));
	return 1;
	}
	public function registrar_orden_tienda($id='204',$descripcion,$cantidad,$valor, $tienda,$usuario,$img, $tipo_pago, $orden_external,$tiempo){
		$estado_defaul = 1;
		$userexternal="Y";
		$sql = "INSERT INTO `orden`(`estado`,`descripcion`,`valor`,`userexternal`,`id_tienda`,`img`,`id_user_external`, `metodo_pago`, `orden_external`, `tiempo`) VALUES (:estado,:descripcion,:valor,:userexternal, :id_tienda, :img, :id_user_external, :tipo_pago, :orden_external, :tiempo)";
		$reg = $this->conexion->prepare($sql);
		$reg->execute(array(
			':estado' => $estado_defaul,
			':descripcion' => $descripcion,
			':valor' => $valor,
			':userexternal' => $userexternal,
			':id_tienda' => $tienda,
			':img' => $img,
			':id_user_external' => $usuario,
			':tipo_pago' => $tipo_pago,
			':orden_external' => $orden_external,
			':tiempo' => $tiempo
		));
		return 1;
	}
	public function registrar_temporal_user($nombre, $telefono, $direccion){
		$sql = "INSERT INTO `temporaluser`(`nombre`,`telefono`,`direccion`) VALUES (:nombre,:telefono,:direccion)";
		$reg = $this->conexion->prepare($sql);
		$reg->execute(array(':nombre' => $nombre,':telefono' => $telefono,':direccion' => $direccion));
		return $this->conexion->lastInsertId();
	}
	
	public function buscar_orden_tienda($id_tienda){$sql = "SELECT *, (SELECT nombre FROM usuarios WHERE orden.id_cliente = usuarios.id) as nombre_cliente, (SELECT nombre FROM temporaluser WHERE orden.id_user_external = temporaluser.id) as nombre_cliente_tienda, (SELECT nombre FROM usuarios WHERE orden.id_domiciliario = usuarios.id) as nombre_repartidor FROM `orden` where id_tienda=". $id_tienda. ";";;
		$reg = $this->conexion->prepare($sql);
		$reg->execute();
		$consulta =$reg->fetchAll();
		if ($consulta) {
			return $consulta;
		}else{
			return 0;
		} }
		public function buscar_orden_tienda_general($id_tienda){$sql = "SELECT
    *,
    (
    SELECT
        nombre
    FROM
        usuarios
    WHERE
        orden.id_cliente = usuarios.id
) AS nombre_cliente,

    (
    SELECT
        latitude
    FROM
        comercios
    WHERE
        orden.id_tienda = comercios.id_user
) AS latitude_empre,

    (
    SELECT
        longitude
    FROM
        comercios
    WHERE
        orden.id_tienda = comercios.id_user
) AS longitude_empre,

   (SELECT
        nombre
    FROM
        comercios
    WHERE
        orden.id_tienda = comercios.id_user
) AS nombre_empre,

(
    SELECT
        nombre
    FROM
        temporaluser
    WHERE
        orden.id_user_external = temporaluser.id
) AS nombre_cliente_tienda,
(
    SELECT
        nombre
    FROM
        comercios
    WHERE
        orden.id_tienda = comercios.id_user
    LIMIT 1
) AS tienda,(
    SELECT
        telefono
    FROM
        temporaluser
    WHERE
        orden.id_user_external = temporaluser.id
) AS telefono,
(
    SELECT
        direccion
    FROM
        temporaluser
    WHERE
        orden.id_user_external = temporaluser.id
) AS direccion,
(
    SELECT
        nombre
    FROM
        usuarios
    WHERE
        orden.id_domiciliario = usuarios.id
) AS nombre_repartidor
FROM
    `orden`
WHERE
    userexternal = 'Y' and status_orden_envio = 1 ";

	if(!empty($id_tienda)){$sql .= " AND id_tienda = ". $id_tienda. " ";}
	

			$reg = $this->conexion->prepare($sql);
			$reg->execute();
			$consulta =$reg->fetchAll();
			if ($consulta) {
				return $consulta;
			}else{
				return 0;
			} }
			public function buscar_orden_tienda_general_asignados($id_tienda){$sql = "SELECT
				*,
				(
				SELECT
					nombre
				FROM
					usuarios
				WHERE
					orden.id_cliente = usuarios.id
			) AS nombre_cliente,
			
				(
				SELECT
					latitude
				FROM
					comercios
				WHERE
					orden.id_tienda = comercios.id_user
			) AS latitude_empre,
			
				(
				SELECT
					longitude
				FROM
					comercios
				WHERE
					orden.id_tienda = comercios.id_user
			) AS longitude_empre,
			
			   (SELECT
					nombre
				FROM
					comercios
				WHERE
					orden.id_tienda = comercios.id_user
			) AS nombre_empre,
			
			(
				SELECT
					nombre
				FROM
					temporaluser
				WHERE
					orden.id_user_external = temporaluser.id
			) AS nombre_cliente_tienda,
			(
				SELECT
					nombre
				FROM
					comercios
				WHERE
					orden.id_tienda = comercios.id_user
				LIMIT 1
			) AS tienda,(
				SELECT
					telefono
				FROM
					temporaluser
				WHERE
					orden.id_user_external = temporaluser.id
			) AS telefono,
			(
				SELECT
					direccion
				FROM
					temporaluser
				WHERE
					orden.id_user_external = temporaluser.id
			) AS direccion,
			(
				SELECT
					nombre
				FROM
					usuarios
				WHERE
					orden.id_domiciliario = usuarios.id
			) AS nombre_repartidor
			FROM
				`orden`
			WHERE
				userexternal = 'Y' and status_orden_envio = 2 ";
			
				if(!empty($id_tienda)){$sql .= " AND id_tienda = ". $id_tienda. " ";}
				
			
						$reg = $this->conexion->prepare($sql);
						$reg->execute();
						$consulta =$reg->fetchAll();
						if ($consulta) {
							return $consulta;
						}else{
							return 0;
						} }

		public function buscar_orden_tienda_general_culminado($id_tienda){$sql = "SELECT
			*,
			(
			SELECT
				nombre
			FROM
				usuarios
			WHERE
				orden.id_cliente = usuarios.id
		) AS nombre_cliente,
		
			(
			SELECT
				latitude
			FROM
				comercios
			WHERE
				orden.id_tienda = comercios.id_user
		) AS latitude_empre,
		
			(
			SELECT
				longitude
			FROM
				comercios
			WHERE
				orden.id_tienda = comercios.id_user
		) AS longitude_empre,
		
		   (SELECT
				nombre
			FROM
				comercios
			WHERE
				orden.id_tienda = comercios.id_user
		) AS nombre_empre,
		
		(
			SELECT
				nombre
			FROM
				temporaluser
			WHERE
				orden.id_user_external = temporaluser.id
		) AS nombre_cliente_tienda,
		(
			SELECT
				nombre
			FROM
				comercios
			WHERE
				orden.id_tienda = comercios.id_user
			LIMIT 1
		) AS tienda,(
			SELECT
				telefono
			FROM
				temporaluser
			WHERE
				orden.id_user_external = temporaluser.id
		) AS telefono,
		(
			SELECT
				direccion
			FROM
				temporaluser
			WHERE
				orden.id_user_external = temporaluser.id
		) AS direccion,
		(
			SELECT
				nombre
			FROM
				usuarios
			WHERE
				orden.id_domiciliario = usuarios.id
		) AS nombre_repartidor
		FROM
			`orden`
		WHERE
			userexternal = 'Y' and status_orden_envio = 3 ";
		
			if(!empty($id_tienda)){$sql .= " AND id_tienda = ". $id_tienda. " ";}
							
	
	$reg = $this->conexion->prepare($sql);
	$reg->execute();
	$consulta =$reg->fetchAll();
	if ($consulta) {
		return $consulta;
	}else{
		return 0;
	} }
	public function buscar_orden(){$sql = "SELECT *, (SELECT nombre FROM usuarios WHERE orden.id_cliente = usuarios.id) as nombre_cliente, (SELECT nombre FROM usuarios WHERE orden.id_domiciliario = usuarios.id) as nombre_repartidor FROM `orden`;";
	$reg = $this->conexion->prepare($sql);
	$reg->execute();
	$consulta =$reg->fetchAll();
	if ($consulta) {
		return $consulta;
	}else{
		return 0;
	} }
	public function cambiar_estado_orden($id, $estado){$sql = "UPDATE `orden` SET `estado`=:estado WHERE id_orden=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id, ':estado' => $estado));
	}
	public function enrutar($id, $id_domiciliario, $id_enrutador){
		$sql = "UPDATE `orden` SET id_domiciliario=:id_domiciliario, status_orden_envio=2 WHERE id_orden=:id";
		$reg = $this->conexion->prepare($sql);
		$reg->execute(array(':id' => $id, ':id_domiciliario' => $id_domiciliario));
	}
	public function eliminar_orden($id){$sql = "DELETE FROM `orden`  WHERE id_orden=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id));
	}
	public function modificar_orden($id, $estado,$descripcion,$cantidad,$valor){
	$sql = "UPDATE `orden` SET `estado`=:estado ,`descripcion`=:descripcion,`cantidad`=:cantidad,`valor`=:valor WHERE id_orden=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id, ':estado' => $estado,':descripcion' => $descripcion,':cantidad' => $cantidad,':valor' => $valor));
	}
	public function buscar_json_orden($id){$sql = "SELECT  * FROM rol where id=".$id."";
	$reg = $this->conexion->prepare($sql);
	$reg->execute();
	$results = $reg->fetchAll(PDO::FETCH_ASSOC);
	return json_encode($results);
	}
	public function buscar_domiciliarios_disponibles(){$sql = "SELECT id, nombre,id_rol
		FROM usuarios where id_rol=3;";

		$reg = $this->conexion->prepare($sql);
		$reg->execute();
			$consulta =$reg->fetchAll();
			if ($consulta) {
				return $consulta;
			}else{
				return 0;
			}
		}
	
	public function buscar_domiciliarios_disponibles_gps($id){$sql = "SELECT u.latitud, u.longitud, u.id, u.nombre, u.id_rol
			FROM usuarios u where u.id_rol=3 and u.id=".$id.";"; 

	
	
			$reg = $this->conexion->prepare($sql);
			$reg->execute();
			$results = $reg->fetchAll(PDO::FETCH_ASSOC);
			return json_encode($results);
	}
		
	public function rango() {
		// C�digo del m�todo aqu�
	}

	public function cantidad(){
		$sql = "SELECT  count(*) as cantidad FROM orden ";
		$reg = $this->conexion->prepare($sql);
		$reg->execute();
		$consulta =$reg->fetchAll();
		if ($consulta) {
			return $consulta;
		}else{
			return 0;
		} 
	}

}
?>