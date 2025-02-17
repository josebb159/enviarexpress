<!-- view comercios -->
<link href="../assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="../assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="../assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="../assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

	  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

	<style>
        #map {
            height: 400px;
            width: 100%;
        }
		.modal-dialog {
            max-width: 800px;
        }
		#map2 {
            height: 400px;
            width: 100%;
        }
		.modal-dialog {
            max-width: 800px;
        }


		#preview-image {
            max-width: 100px !important;
            max-height: 100px !important;
	
        }
		#image-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100px; /* Establece la altura deseada del contenedor */
            border: 1px solid #ccc; /* Para visualizar el contenedor */
        }

		#preview-image2 {
            max-width: 100px !important;
            max-height: 100px !important;
	
        }
    </style>
<div class="page-content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="page-title-box d-sm-flex align-items-center justify-content-between">
					<h4 class="mb-sm-0">Lista de comercios</h4>
					<div class="page-title-right">
						<ol class="breadcrumb m-0">
							<li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo NAME_CLIENT; ?></a></li>
							<li class="breadcrumb-item active">Listado de comercios</li>
						</ol>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Comercios</h4>
						<table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
							<thead>
								<th>ID</th>
								<th>Nombre</th>
								<th>Propietario</th>
								<th>Logo</th>
								<th>Dirección</th>
							
								<th>teléfono</th>
								<th>Descripción</th>
								<th>Estado</th>
								<th>Opciones</th>
							<thead>
							<tbody id="datos">
							</tbody>
						</table>
						<button type="button" onclick="renderizemap()"  class="btn btn-success waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#modal_agregar">Agregar comercios</button>
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
					<h5 class="modal-title mt-0" id="myModalLabel">Modificar comercio</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form class="needs-validation" id="form_2">
					<input type="hidden" value="" id="id_comercios">
					<div class="modal-body">
						<div class="row">
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">Nombre</label>
									<input type="text" class="form-control" id="nombre" placeholder="Nombre" value="" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">Logo</label>
									<input type="hidden" id="img">
									<input type="file" class="form-control" id="logo" placeholder="logo" value="" >
									<div id="image-container">
										<img id="preview-image" src="" alt="Vista previa de la imagen" />
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">Dirección</label>
									<input type="text" class="form-control" id="direccion" placeholder="direccion" value="" required>
								</div>
							</div>
							<div class="col-md-6"  >
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">Latitude</label>
									<input type="text" class="form-control" id="latitude" placeholder="Latitude" value="" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label" >Longitude</label>
									<input type="text" class="form-control" id="longitude" placeholder="Longitude" value="" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">Teléfono</label>
									<input type="text" class="form-control" id="telefono" placeholder="Teléfono" value="" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">Porcetaje adicional</label>
									<input type="number" class="form-control" id="porcentaje" placeholder="Porcentaje" value="" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">Descripción</label>
									<input type="text" class="form-control" id="descripcion" placeholder="Descripción" value="" required>
								</div>
							</div>
							<div class="col-md-6">
                                <div class="mb-6">
                                        <label for="validationCustom02" class="form-label">Categoria</label>
                                       
                                        <select name="" class="form-control" id="category2">
                                                    

                                        </select>
                                
                                    </div>
                                </div>
							
								<br><br><br><br>
								<div id="map2"></div>
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
					<h6 class="modal-title mt-0" id="myModalLabel">Agregar comercios</h6>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form class="needs-validation" id="form_1">
					<div class="modal-header">
						<h6 class="modal-title mt-0" id="myModalLabel">Datos usuario</h6>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">Nombre usuario</label>
									<input type="text" class="form-control" id="nombreusagg" placeholder="Nombre" value="" required>
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
									<label for="validationCustom01" class="form-label">Telèfono</label>
									<input type="text" class="form-control" id="telefonoagg" placeholder="Telèfono" value="" required>
								</div>
							</div>
						</div>
					</div>

					<hr>
					<div class="modal-header">
						<h6 class="modal-title mt-0" id="myModalLabel">Datos tienda</h6>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>

			
					<div class="modal-body">
						<div class="row">
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">Nombre</label>
									<input type="text" class="form-control" id="nombreagg" placeholder="Nombre" value="" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">Logo</label>
									<input type="file" class="form-control" id="logoagg" placeholder="Logo" value="" required>
								</div>
							</div>
							<div class="col-md-6" >
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">Dirección</label>
									<input type="text" class="form-control" id="direccionagg" placeholder="Dirección" value="" required>
								</div>
							</div>
							<div class="col-md-6" style="display:none">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">Latitude</label>
									<input type="text" class="form-control" id="latitudeagg" placeholder="Latitude" value="" required>
								</div>
							</div>
							<div class="col-md-6" style="display:none">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">longitude</label>
									<input type="text" class="form-control" id="longitudeagg" placeholder="longitude" value="" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">Teléfono</label>
									<input type="text" class="form-control" id="telefonoagg" placeholder="Teléfono" value="" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">Tipo de Pago</label>
									<select class="form-control" name="tipo_pagoagg" id="tipo_pagoagg">
										<option value="1">Tarifa fija</option>
										<option value="2">Porcentaje</option>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">Valor</label>
									<input type="number" class="form-control" id="porcentajeagg" placeholder="Valor" value="" required>
								</div>
							</div>
							<div class="col-md-12">
								<div class="mb-12">
									<label for="validationCustom01" class="form-label">Descripción</label>
									<input type="text" class="form-control" id="descripcionagg" placeholder="Descripción" value="" required>
								</div>
							</div>
							<div class="col-md-6">
                                <div class="mb-6">
                                        <label for="validationCustom02" class="form-label">Categoria</label>
                                       
                                        <select name="" class="form-control" id="categoryagg">
                                                    

                                        </select>
                                
                                    </div>
                                </div>
								<div class="col-md-6" style="display: none;">
                                <div class="mb-6">
                                        <label for="validationCustom02" class="form-label">Propietario</label>
                                       
                                        <select name="" class="form-control" id="propietaryagg">

                                        </select>
                                
                                    </div>
                                </div>
<br><br><br><br>
								<div id="map"></div>
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
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



<script>

function miFuncion() {
	setTimeout(function() {
    map.invalidateSize();
	map2.invalidateSize();
  }, 10);

  
        }






		var map2 = L.map('map2').setView([7.8939, -72.5079], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors',
            maxZoom: 18,
        }).addTo(map2);


		var marker2;
        map2.on('click', function(event) {
            if (marker2) {
                map2.removeLayer(marker2); // Elimina el marcador anterior, si existe
            }
            marker2 = L.marker(event.latlng).addTo(map2);
            document.getElementById('latitude').value = event.latlng.lat;
            document.getElementById('longitude').value = event.latlng.lng;
        });


	

function renderizemap(){
	setTimeout(miFuncion, 2000);

}


    function openModal(imageUrl) {
      var modalImage = document.getElementById("modalImage");
      modalImage.src = imageUrl;
      
      $('#imageModal').modal('show');
    }


        // Inicializar el mapa de Leaflet
        var map = L.map('map').setView([7.8939, -72.5079], 13); // Establece la ubicación inicial en Cúcuta, Colombia

        // Agrega la capa de mapa de Leaflet (puedes cambiar el proveedor de mapas si lo deseas)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors',
            maxZoom: 18,
        }).addTo(map);

        // Agrega un marcador en el mapa al hacer clic en una ubicación
        var marker;
        map.on('click', function(event) {
            if (marker) {
                map.removeLayer(marker); // Elimina el marcador anterior, si existe
            }
            marker = L.marker(event.latlng).addTo(map);
            document.getElementById('latitudeagg').value = event.latlng.lat;
            document.getElementById('longitudeagg').value = event.latlng.lng;
        });

        // Enviar el formulario y guardar la ubicación
        document.getElementById('locationForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Evita el envío del formulario

            var name = document.getElementById('name').value;
            var latitude = document.getElementById('latitudeagg').value;
            var longitude = document.getElementById('longitudeagg').value;

            // Aquí puedes realizar la lógica para guardar los datos en tu base de datos o hacer lo que necesites con ellos

            // Ejemplo de salida de los datos en la consola
            console.log('Nombre:', name);
            console.log('Latitud:', latitude);
            console.log('Longitud:', longitude);

            // Limpia los campos del formulario después de guardar los datos
            document.getElementById('name').value = '';
            document.getElementById('latitudeagg').value = '';
            document.getElementById('longitudeagg').value = '';

            // Cierra la modal
            $('#locationModal').modal('hide');
        });









    </script>

