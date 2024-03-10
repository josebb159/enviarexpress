<?php

include '../model/logs.php';
if(isset($_POST['id'])){
	$id =  $_POST['id'];
}


if(isset($_POST['op'])){
	$op =  $_POST['op'];
}
switch ($op) {

	case 'buscar':
		$n_categoria  = new logs();
		$resultado = $n_categoria  -> buscar_logs();
		if($resultado==0){
			exit();
		}
		foreach ($resultado as $key) {
	
	
		?>
		<tr>
			<td><?= $key['id']; ?></td>
			<td><?= $key['method']; ?></td>
			<td><?= $key['data']; ?></td>
			<td><?= $key['fecha']; ?></td>
			
		
		</tr>
		<?php
		}
	break;
	
	default:
	break;
}
