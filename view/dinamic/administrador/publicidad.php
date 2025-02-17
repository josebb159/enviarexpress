<!-- view publicidad -->
<link href="../assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="../assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="../assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="../assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<?php
include '../model/publicidad.php';
$publicidad = new publicidad;
if(isset($_POST['id'])){
$publicidad ->modificar_publicidad($_POST);
}
$data = $publicidad ->buscar_publicidad();

?>
<div class="page-content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="page-title-box d-sm-flex align-items-center justify-content-between">
					<h4 class="mb-sm-0">Modulo de Publicidad</h4>
					
					<div class="page-title-right">
						<ol class="breadcrumb m-0">
							<li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo NAME_CLIENT; ?></a></li>
							<li class="breadcrumb-item active">Listado de publicidad</li>
						</ol>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Publicidad</h4>
					<form action="#" method="post" enctype="multipart/form-data">

					<div class="row">
					<div class="col-md-6">
						<div class="mb-6">
							<label for="validationCustom01" class="form-label">URL</label>
							<input type="hidden" name="id" value="1">
							<input type="text" class="form-control" name="url" id="url" placeholder="url" value="<?= $data[0]['url_public']; ?>" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="mb-6">
							<label for="validationCustom01" class="form-label">Imagen</label>
							<input type="file" class="form-control" name="img" id="img" placeholder="imagen" >
						</div>
					</div>
					<div class="col-md-6">
						<div class="mb-6">
							<label for="validationCustom01" class="form-label">Tiempo</label>
							<input type="text" class="form-control" name="tiempo" id="tiempo" placeholder="tiempo" value="<?= $data[0]['tiempo']; ?>" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="mb-6">
							<label for="validationCustom01" class="form-label">Click ingresados</label>
							<input type="text" class="form-control" name="click" id="click" placeholder="click" value="<?= $data[0]['click']; ?>" disabled required>
						</div>
					</div>
					
				</div>
				<div style="width: 300px; height: 300px; display: flex; justify-content: center; align-items: center;">
    <img src="../assets/upload/publicidad/<?= $data[0]['img']; ?>.jpg" alt="" style="max-width: 100%; max-height: 100%;">
</div>
				<button type="submit" class="btn btn-primary waves-effect waves-light" >Guardar</button>
					</form>	
				
				

				<br>
			
					
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="col-sm-6 col-md-4 col-xl-3">
	<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title mt-0" id="myModalLabel">Modificar publicidad</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form class="needs-validation" id="form_2">
					<input type="hidden" value="" id="id_publicidad">
					<div class="modal-body">
						<div class="row">
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">tiempo</label>
									<input type="text" class="form-control" id="tiempo" placeholder="tiempo" value="" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">img</label>
									<input type="text" class="form-control" id="img" placeholder="img" value="" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">url_public</label>
									<input type="text" class="form-control" id="url_public" placeholder="url_public" value="" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">click</label>
									<input type="text" class="form-control" id="click" placeholder="click" value="" required>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Cerrar</button>
						<button type="submit" class="btn btn-primary waves-effect waves-light" >Guardar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="col-sm-6 col-md-4 col-xl-3">
	<div id="modal_agregar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title mt-0" id="myModalLabel">Agregar publicidad</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form class="needs-validation" id="form_1">
					<div class="modal-body">
						<div class="row">
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">tiempo</label>
									<input type="text" class="form-control" id="tiempoagg" placeholder="tiempo" value="" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">img</label>
									<input type="text" class="form-control" id="imgagg" placeholder="img" value="" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">url_public</label>
									<input type="text" class="form-control" id="url_publicagg" placeholder="url_public" value="" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">click</label>
									<input type="text" class="form-control" id="clickagg" placeholder="click" value="" required>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Cerrar</button>
						<button type="submit" class="btn btn-primary waves-effect waves-light" >Guardar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php 
$aditionals_js='
<!-- Required datatable js -->
<script src="../assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="../assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="../assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="../assets/libs/jszip/jszip.min.js"></script>
<script src="../assets/libs/pdfmake/build/pdfmake.min.js"></script>
<script src="../assets/libs/pdfmake/build/vfs_fonts.js"></script>
<script src="../assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="../assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="../assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
<script src="../assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="../assets/libs/datatables.net-select/js/dataTables.select.min.js"></script>
<!-- Responsive examples -->
<script src="../assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="../assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
<!-- Datatable init js -->
<script src="../assets/js/pages/datatables.init.js"></script>
';
?>
