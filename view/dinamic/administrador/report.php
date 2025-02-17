<!-- view publicidad -->
<link href="../assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="../assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="../assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="../assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<?php
include '../model/publicidad.php';
$publicidad = new publicidad;


?>
<div class="page-content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="page-title-box d-sm-flex align-items-center justify-content-between">
					<h4 class="mb-sm-0">Modulo de Reportes</h4>
					
					<div class="page-title-right">
						<ol class="breadcrumb m-0">
							<li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo NAME_CLIENT; ?></a></li>
							<li class="breadcrumb-item active">Reportes</li>
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
				



                 

            <div class="col-xl-12">
                <div class="card">
               

                    <div class="card-body">
                        <!-- Nav tabs -->
                        <ul class="nav nav-pills nav-justified" role="tablist">
                            <li class="nav-item waves-effect waves-light">
                                <a class="nav-link active" data-bs-toggle="tab"
                                    href="#home-1" role="tab">
                                    <span class="d-block d-sm-none"><i
                                            class="fas fa-home"></i></span>
                                    <span class="d-none d-sm-block">Usuarios</span>
                                </a>
                            </li>
                            <li class="nav-item waves-effect waves-light">
                                <a class="nav-link" data-bs-toggle="tab"
                                    href="#profile-1" role="tab">
                                    <span class="d-block d-sm-none"><i
                                            class="far fa-user"></i></span>
                                    <span class="d-none d-sm-block">Domiciliarios</span>
                                </a>
                            </li>
                            <li class="nav-item waves-effect waves-light">
                                <a class="nav-link" data-bs-toggle="tab"
                                    href="#messages-1" role="tab">
                                    <span class="d-block d-sm-none"><i
                                            class="far fa-envelope"></i></span>
                                    <span class="d-none d-sm-block">Empresas</span>
                                </a>
                            </li>
                            <li class="nav-item waves-effect waves-light">
                                <a class="nav-link" data-bs-toggle="tab"
                                    href="#settings-1" role="tab">
                                    <span class="d-block d-sm-none"><i
                                            class="fas fa-cog"></i></span>
                                    <span class="d-none d-sm-block">Gastos</span>
                                </a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content p-3 text-muted">
                            <div class="tab-pane active" id="home-1"
                                role="tabpanel">
								<form action="../framework/tcpdf/pdf/controllerReport.php" method="post" target="_blank">
								<div class="row">
									<div class="col-md-6">
											<div class="mb-6">
												<label for="validationCustom01" class="form-label">Tipo de reporte</label>
												<select class="form-control" name="tipo_report" id="">
													<option value="1">General</option>
													<option value="2">Por Calificación</option>
													<option value="3">Por Gastos</option>
													<option value="4">Por Uso de servicio</option>
												</select>
											</div>
									</div>
									<div class="col-md-6">
											<div class="mb-6">
												<label for="validationCustom01" class="form-label">Nombre del usuario</label>
												<input type="hidden" class="form-control" name="report"  placeholder="report" value="usuario" >
												<input type="text" class="form-control" name="name"  placeholder="Nombre" value="" >
											</div>
									</div>
									<div class="col-md-6">
											<div class="mb-6">
												<label for="validationCustom01" class="form-label">Edad</label>
									
												<input type="number" class="form-control" name="name"  placeholder="Nombre" value="" >
											</div>
									</div>
									<div class="col-md-6">
											<div class="mb-6">
												<label for="validationCustom01" class="form-label">Sexo</label>
												<br>
												<input type="radio" class="form-check-input"  name="sexo" value="Masculino" />
												Masculino
												<input type="radio" class="form-check-input"  name="sexo" value="Femenino" />
												Femenino
												<input type="radio" class="form-check-input"  name="sexo" value="Otros" />
												Otros
											</div>
									</div>
									<div class="col-md-6">
											<div class="mb-6">
												<label for="validationCustom01" class="form-label">Fecha desde</label>
									
												<input type="date" class="form-control" name="desde" >
											</div>
									</div>
									<div class="col-md-6">
											<div class="mb-6">
												<label for="validationCustom01" class="form-label">Fecha hasta</label>
									
												<input type="date" class="form-control" name="hasta"  >
											</div>
									</div>
								</div>
								<br>
								<button type="submit" class="btn btn-primary waves-effect waves-light" >Generar</button>
								</form>	
                            </div>
                            <div class="tab-pane" id="profile-1"
                                role="tabpanel">
                                <form action="#" method="post" enctype="multipart/form-data">
								<div class="row">
									<div class="col-md-6">
											<div class="mb-6">
												<label for="validationCustom01" class="form-label">Tipo de reporte</label>
												<select class="form-control" name="tipo_report" id="">
													<option value="1">General</option>
													<option value="2">Por Calificación</option>
													<option value="3">Por Servicio</option>
													<option value="4">Por Tiempo</option>
												</select>
											</div>
									</div>
									<div class="col-md-6">
											<div class="mb-6">
												<label for="validationCustom01" class="form-label">Nombre del Domiciliario</label>
									
												<input type="text" class="form-control" name="name"  placeholder="Nombre" value="" >
											</div>
									</div>
									
									<div class="col-md-6">
											<div class="mb-6">
												<label for="validationCustom01" class="form-label">Sector</label>
									
												<select class="form-control" name="tipo_report" id="">
													<option value="1">General</option>
													<option value="2">Soacha</option>
						
												</select>
											</div>
									</div>
					
									<div class="col-md-6">
											<div class="mb-6">
												<label for="validationCustom01" class="form-label">Fecha desde</label>
									
												<input type="date" class="form-control" name="desde" >
											</div>
									</div>
									<div class="col-md-6">
											<div class="mb-6">
												<label for="validationCustom01" class="form-label">Fecha hasta</label>
									
												<input type="date" class="form-control" name="hasta"  >
											</div>
									</div>
								</div>
								<br>
								<button type="submit" class="btn btn-primary waves-effect waves-light" >Generar</button>
								</form>	
                            </div>
                            <div class="tab-pane" id="messages-1"
                                role="tabpanel">
								<form action="#" method="post" enctype="multipart/form-data">
								<div class="row">
									<div class="col-md-6">
											<div class="mb-6">
												<label for="validationCustom01" class="form-label">Tipo de reporte</label>
												<select class="form-control" name="tipo_report" id="">
													<option value="1">General</option>
													<option value="2">Por Calificación</option>
													<option value="3">Por ventas</option>
												</select>
											</div>
									</div>
									<div class="col-md-6">
											<div class="mb-6">
												<label for="validationCustom01" class="form-label">Nombre de la empres</label>
									
												<input type="text" class="form-control" name="name"  placeholder="Nombre" value="" >
											</div>
									</div>
									
									<div class="col-md-6">
											<div class="mb-6">
												<label for="validationCustom01" class="form-label">Categoria</label>
									
												<select class="form-control" name="tipo_report" id="">
													<option value="1">General</option>
													<option value="2">Electronica</option>
						
												</select>
											</div>
									</div>
					
									<div class="col-md-6">
											<div class="mb-6">
												<label for="validationCustom01" class="form-label">Fecha desde</label>
									
												<input type="date" class="form-control" name="desde" >
											</div>
									</div>
									<div class="col-md-6">
											<div class="mb-6">
												<label for="validationCustom01" class="form-label">Fecha hasta</label>
									
												<input type="date" class="form-control" name="hasta"  >
											</div>
									</div>
								</div>
								<br>
								<button type="submit" class="btn btn-primary waves-effect waves-light" >Generar</button>
								</form>	
                            </div>
                            <div class="tab-pane" id="settings-1"
                                role="tabpanel">
                                <form action="#" method="post" enctype="multipart/form-data">
								<div class="row">
									<div class="col-md-6">
											<div class="mb-6">
												<label for="validationCustom01" class="form-label">Tipo de reporte</label>
												<select class="form-control" name="tipo_report" id="">
													<option value="1">General</option>
													<option value="2">Por Ingreso Total</option>
												</select>
											</div>
									</div>
								
							
					
									<div class="col-md-6">
											<div class="mb-6">
												<label for="validationCustom01" class="form-label">Fecha desde</label>
									
												<input type="date" class="form-control" name="desde" >
											</div>
									</div>
									<div class="col-md-6">
											<div class="mb-6">
												<label for="validationCustom01" class="form-label">Fecha hasta</label>
									
												<input type="date" class="form-control" name="hasta"  >
											</div>
									</div>
								</div>
								<br>
								<button type="submit" class="btn btn-primary waves-effect waves-light" >Generar</button>
								</form>	
                            </div>
                        </div>
                    </div><!-- end card-body -->
                </div><!-- end card -->




		
				

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
