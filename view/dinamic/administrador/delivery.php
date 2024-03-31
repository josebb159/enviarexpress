<!-- view delivery -->
<link href="../assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="../assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="../assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="../assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

<div class="page-content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="page-title-box d-sm-flex align-items-center justify-content-between">
					<h4 class="mb-sm-0">Lista de delivery</h4>
					<div class="page-title-right">
						<ol class="breadcrumb m-0">
							<li class="breadcrumb-item"><a href="javascript: void(0);">Enviar Express</a></li>
							<li class="breadcrumb-item active">Listado de delivery</li>
						</ol>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">delivery</h4>
						<table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
							<thead>
								<th>ID</th>
								<th>Nombre</th>
								<th>Cedula</th>
								<th>Foto Cedula</th>
								<th>Foto Licencia</th>
								<th>Foto Soat</th>
								<th>Foto Tecnomecanica</th>
								<th>Foto Tarjeta</th>
								<th>Propiedad</th>
								<th>Foto Facial</th>
								<th>Direccion</th>
								<th>Número</th>
								<th>Numero Emergencia</th>
								<th>Estado</th>
								<th>Opciones</th>
							<thead>
							<tbody id="datos">
							</tbody>
						</table>
						<button type="button"  class="btn btn-success waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#modal_agregar">Agregar delivery</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body">
          <img id="modalImage" src="" alt="Imagen Ampliada" class="img-fluid">
        </div>
      </div>
    </div>
  </div>


<div class="col-sm-6 col-md-4 col-xl-3">
	<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title mt-0" id="myModalLabel">Modificar delivery</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form class="needs-validation" id="form_2">
					<input type="hidden" value="" id="id_delivery">
					<div class="modal-body">
						<div class="row">
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">Nombre</label>
									<input type="text" class="form-control" id="nombre" placeholder="nombre" value="" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">Contraseña</label>
									<input type="text" class="form-control" id="contrasena" placeholder="contraseña" value="" required>
								</div>
							</div
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">Correo</label>
									<input type="text" class="form-control" id="correo" placeholder="correo" value="" required>
								</div>
							</div
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">Cédula</label>
									<input type="text" class="form-control" id="cedula" placeholder="cedula" value="" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">Foto Cédula</label>
									<input type="file" class="form-control" id="foto_cedula" placeholder="imagen" value="" required>
									
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">Foto Licencia</label>
									<input type="file" class="form-control" id="foto_licencia" placeholder="imagen" value="" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">Foto Soat</label>
									<input type="file" class="form-control" id="foto_soat" placeholder="imagen" value="" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">Foto Tecnomecanica</label>
									<input type="file" class="form-control" id="foto_tecnomecanica" placeholder="imagen" value="" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">Foto Tarjeta</label>
									<input type="file" class="form-control" id="foto_tarjeta" placeholder="imagen" value="" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">Propiedad</label>
									<input type="file" class="form-control" id="propiedad" placeholder="imagen" value="" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">Foto Facial</label>
									<input type="file" class="form-control" id="foto_facial" placeholder="imagen" value="" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">Dirección</label>
									<input type="text" class="form-control" id="direccion" placeholder="direccion" value="" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">Número</label>
									<input type="text" class="form-control" id="numero" placeholder="numero" value="" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">Número Emergencia</label>
									<input type="text" class="form-control" id="numero_emergencia" placeholder="numero_emergencia" value="" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">Usuario</label>
									<input type="text" class="form-control" id="id_usuario" placeholder="usuario" value="" required>
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
					<h5 class="modal-title mt-0" id="myModalLabel">Agregar delivery</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form class="needs-validation" id="form_1">
					<div class="modal-body">
						<div class="row">
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">Nombre</label>
									<input type="text" class="form-control" id="nombreagg" placeholder="nombre" value="" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">Correo</label>
									<input type="text" class="form-control" id="correoagg" placeholder="Correo" value="" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">Contraseña</label>
									<input type="text" class="form-control" id="contrasenaagg" placeholder="Contraseña" value="" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">Cédula</label>
									<input type="text" class="form-control" id="cedulaagg" placeholder="cedula" value="" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">Foto Cedula</label>
									<input type="file" class="form-control" id="foto_cedulaagg" placeholder="imagen" value="" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">Foto Licencia</label>
									<input type="file" class="form-control" id="foto_licenciaagg" placeholder="imagen" value="" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">Foto Soat</label>
									<input type="file" class="form-control" id="foto_soatagg" placeholder="imagen" value="" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">Foto Tecnomecanica</label>
									<input type="file" class="form-control" id="foto_tecnomecanicaagg" placeholder="imagen" value="" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">Foto Tarjeta</label>
									<input type="file" class="form-control" id="foto_tarjetaagg" placeholder="imagen" value="" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">Propiedad</label>
									<input type="file" class="form-control" id="propiedadagg" placeholder="imagen" value="" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">Foto Facial</label>
									<input type="file" class="form-control" id="foto_facialagg" placeholder="imagen" value="" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">Dirección</label>
									<input type="text" class="form-control" id="direccionagg" placeholder="direccion" value="" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">Número</label>
									<input type="text" class="form-control" id="numeroagg" placeholder="numero" value="" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">Número Emergencia</label>
									<input type="text" class="form-control" id="numero_emergenciaagg" placeholder="numero_emergencia" value="" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">Usuario</label>
									<input type="text" class="form-control" id="id_usuarioagg" placeholder="usuario" value="" required>
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

<script>
    function openModal(imageUrl) {
      var modalImage = document.getElementById("modalImage");
      modalImage.src = imageUrl;
      
      $('#imageModal').modal('show');
    }
  </script>

