<!-- view orden -->
<link href="../assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="../assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="../assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="../assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

<style>
 #imagen {
            width: 150px;
            cursor: pointer;
            transition: transform 0.3s;
        }

        /* Fondo oscuro para la imagen ampliada */
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            justify-content: center;
            align-items: center;
			
            z-index: 1100; /* Más alto que el modal de Bootstrap */
        }

        /* Imagen ampliada */
        .overlay img {
            max-width: 90%;
            max-height: 90%;
            border-radius: 10px;
			margin: auto;
			position: relative;
			left: 30%;
			
		
        }
    </style>

<div class="page-content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="page-title-box d-sm-flex align-items-center justify-content-between">
					<h4 class="mb-sm-0">Lista de orden</h4>
					<div class="page-title-right">
						<ol class="breadcrumb m-0">
							<li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo NAME_CLIENT; ?></a></li>
							<li class="breadcrumb-item active">Listado de orden</li>
						</ol>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Orden</h4>
						<table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
							<thead>
								<th>ID</th>
								<th>Número de orden</th>
								<th>Descripción</th>
							
								<th>Valor</th>
								<th>Estado</th>
								<th>Cliente</th>
								<th>Repartidor</th>
								<th>Metodo de pago</th>
								<th>Activo</th>
								<th>Opciones</th>
							<thead>
							<tbody id="datos">
							</tbody>
						</table>
						<button type="button"  class="btn btn-success waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#modal_agregar">Agregar orden</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

   <!-- Contenedor de la imagen ampliada -->
   <div class="overlay" id="overlay" onclick="cerrarImagen()">
        <img id="imagenAmpliada" src="" alt="Imagen Ampliada">
    </div>

<!-- view modal
<div class="col-sm-6 col-md-4 col-xl-3">
	<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title mt-0" id="myModalLabel">Modificar orden</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				

				<form class="needs-validation" id="form_2">
					<input type="hidden" value="" id="id_orden">
					<div class="modal-body">
						<div class="row">
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">descripcion</label>
									<input type="text" class="form-control" id="descripcion" placeholder="descripcion" value="" required>
								</div>
							</div>
							<div class="col-md-6" style="display: none;">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">cantidad</label>
									<input type="text" class="form-control" id="cantidad" placeholder="cantidad" value="" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">valor</label>
									<input type="text" class="form-control" id="valor" placeholder="valor" value="" required>
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
 -->
<div class="col-sm-6 col-md-4 col-xl-3">
	<div id="modal_agregar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title mt-0" id="myModalLabel">Agregar orden</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
			
				<form class="needs-validation" id="form_1">
					<div class="modal-body">
					<div class="modal-header">
						<h6 class="modal-title mt-0" id="myModalLabel">Datos Cliente</h6>
					</div>
					<div class="row">
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">Nombre cliente</label>
									<input type="text" class="form-control" maxlength="50" id="clienteagg" placeholder="nombre" value="" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">Teléfono</label>
									<input type="text" class="form-control" id="telefonoagg" placeholder="teléfono" value="" required>
								</div>
							</div>
							<div class="col-md-12">
								<div class="mb-12">
									<label for="validationCustom01" class="form-label">Dirección</label>
									<textarea class="form-control" maxlength="256" name="direccionagg" id="direccionagg" cols="1" rows="1"></textarea>
								</div>
							</div>
					</div>
					<hr>
					<div class="modal-header">
						<h6 class="modal-title mt-0" id="myModalLabel">Datos de la compra</h6>
					</div>
				
						<div class="row">
						<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">Número de orden</label>
									<input type="text" class="form-control" maxlength="25" id="ordenagg" placeholder="Número de orden" value="" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">Tiempo de espera</label>
									<select class="form-control" id="tiempoagg">
										<option value="0">Seleccione</option>	
										<option value="5">5</option>
										<option value="10">10</option>
										<option value="15">15</option>
										<option value="20">20</option>
										<option value="25">25</option>
										<option value="30">30</option>
										<option value="35">35</option>
										<option value="40">40</option>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">Descripción</label>
									<input type="text" class="form-control" maxlength="50" id="descripcionagg" placeholder="descripcion" value="" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">Factura</label>
									<input type="file" name="imagenagg" id="imagenagg">
								</div>
							</div>
							<div class="col-md-6" style="display: none;">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">Cantidad</label>
									<input type="text" class="form-control" id="cantidadagg" placeholder="cantidad" value="1" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">Tipo de pago</label>
									<select class="form-control" name="tipo_pagoaagg" id="tipo_pagoaagg">
										<option value="Tarjeta">Tarjeta</option>
										<option value="Efectivo">Efectivo</option>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">Valor</label>
									<input type="number" class="form-control" id="valoragg" placeholder="valor" value="" required>
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
	<div id="modal_ver" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title mt-0" id="myModalLabel">Ver orden</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
			
				<form class="needs-validation" id="form_1">
					<div class="modal-body">
					<div class="modal-header">
						<h6 class="modal-title mt-0" id="myModalLabel">Datos Cliente</h6>
					</div>
					<div class="row">
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">Nombre cliente</label>
									<input type="text" class="form-control" maxlength="50" id="clientever" placeholder="nombre" value="" disabled>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">Teléfono</label>
									<input type="text" class="form-control" id="telefono" placeholder="teléfono" value=""  disabled>
								</div>
							</div>
							<div class="col-md-12">
								<div class="mb-12">
									<label for="validationCustom01" class="form-label">Dirección</label>
									<textarea class="form-control" maxlength="256" name="direccion" id="direccion" cols="1" rows="1" disabled></textarea>
								</div>
							</div>
					</div>
					<hr>
					<div class="modal-header">
						<h6 class="modal-title mt-0" id="myModalLabel">Datos de la compra</h6>
					</div>
				
						<div class="row">
						<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">Número de orden</label>
									<input type="text" class="form-control" maxlength="25" id="orden" placeholder="Número de orden" value="" disabled>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">Tiempo de espera</label>
									<select class="form-control" id="tiempo" disabled>
										<option value="0">Seleccione</option>	
										<option value="5">5</option>
										<option value="10">10</option>
										<option value="15">15</option>
										<option value="20">20</option>
										<option value="25">25</option>
										<option value="30">30</option>
										<option value="35">35</option>
										<option value="40">40</option>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">Descripción</label>
									<input type="text" class="form-control" maxlength="50" id="descripcion" placeholder="descripcion" value="" disabled>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">Factura</label>
									<img src="" alt="Imagen" onclick="ampliarImagen()" style="width: 200px; height: 200px;" id="imagen">
								</div>
							</div>
							<div class="col-md-6" style="display: none;">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">Cantidad</label>
									<input type="text" class="form-control" id="cantidad" placeholder="cantidad" value="1" disabled>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">Tipo de pago</label>
									<select class="form-control" name="tipo_pago" id="tipo_pago" disabled>
										<option value="Tarjeta">Tarjeta</option>
										<option value="Efectivo">Efectivo</option>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">Valor</label>
									<input type="number" class="form-control" id="valor" placeholder="valor" value="" required>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Cerrar</button>
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
