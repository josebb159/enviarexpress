<!-- DataTables -->
<link href="../assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="../assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="../assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="../assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../assets/libs/twitter-bootstrap-wizard/prettify.css">
<link href="../assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css">
<div class="page-content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="page-title-box d-sm-flex align-items-center justify-content-between">
					<h4 class="mb-sm-0">Solicitud de pedido</h4>
					<div class="page-title-right">
						<ol class="breadcrumb m-0">
							<li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo NAME_CLIENT; ?></a></li>
							<li class="breadcrumb-item active">Solicitud de pedido</li>
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
					
                        <center>
                            <h1>código de orden: <b>#</b><b id="code"></b></h1>
                            
                        </center>
                        
                        <div id="progrss-wizard" class="twitter-bs-wizard">
                            <ul class="twitter-bs-wizard-nav nav-justified">
                                <li class="nav-item">
                                    <a href="#progress-seller-details" class="nav-link" data-toggle="tab">
                                        <span class="step-number">01</span>
                                        <span class="step-title">Datos del cliente</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#progress-company-document" class="nav-link" data-toggle="tab">
                                        <span class="step-number">02</span>
                                        <span class="step-title">Pedido</span>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="#progress-bank-detail" class="nav-link" data-toggle="tab">
                                        <span class="step-number">03</span>
                                        <span class="step-title">Pago</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#progress-confirm-detail" class="nav-link" data-toggle="tab">
                                        <span class="step-number">04</span>
                                        <span class="step-title">Confirmar orden</span>
                                    </a>
                                </li>
                            </ul>

                            <div id="bar" class="progress mt-4">
                                <div class="progress-bar bg-success progress-bar-striped progress-bar-animated"></div>
                            </div>
                            <div class="tab-content twitter-bs-wizard-tab-content">
                                <div class="tab-pane" id="progress-seller-details">
                                    <form>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label"
                                                        for="progress-basicpill-firstname-input">Nombre</label>
                                                    <input type="text" class="form-control"
                                                        id="nombre">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label"
                                                        for="progress-basicpill-lastname-input">Apellido</label>
                                                    <input type="text" class="form-control"
                                                        id="apellido">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label"
                                                        for="progress-basicpill-phoneno-input">Teléfono</label>
                                                    <input type="text" class="form-control"
                                                        id="telefono">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label"
                                                        for="progress-basicpill-email-input">Correo</label>
                                                    <input type="email" class="form-control"
                                                        id="correo">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <label class="form-label"
                                                        for="progress-basicpill-address-input">Dirección</label>
                                                    <textarea id="direccion" class="form-control"
                                                        rows="2"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane" id="progress-company-document">
                                    <div>
                                        <form>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="mb-12">
                                                        <table>
                                                            <tr>
                                                                <td>
                                                                Producto <br>    
                                                                <select style="width: 300px;" class="form-control select2" id="datos">
                                                            <option>Select</option>
                                                            <option value="CT">Connecticut</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                 Cantidad
                                                                 <input type="number"  id="cantidad" value="0" class="form-control">    </td>
                                                                <td>  <br><button type="button" class="btn btn-success waves-effect waves-light" onclick="registrar_producto()">Agregar</button></td>
                                                            </tr>
                                                        </table>
                                                   
                                                              <br>                                      
                                                  
                                                    <table class="table table-striped mb-0">
                                                        <thead>
                                                            <th>Producto</th>
                                                            
                                                            <th>Cantidad</th>
                                                            <th>Precio</th>
                                                            <th>Accion</th>
                                                        <thead>
                                                        <tbody id="datos_product">
                                                        </tbody>
                                                    </table>
                                                    </div>
                                                </div>

                                        
                                            </div>
                                         
                                          
                                        </form>
                                    </div>
                                </div>
                                <div class="tab-pane" id="progress-bank-detail">
                                    <div>
                                        <form>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label"
                                                            for="progress-basicpill-namecard-input">Tipo de pago</label>
                                                        <select name="" id="tipo_pago" class="form-control">
                                                            <option value="1">Tarjeta</option>
                                                            <option value="2">Efectivo</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label>Aplica descuento</label>
                                                        <input type="text" value="0" type="text" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="tab-pane" id="progress-confirm-detail">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-6">
                                            <div class="text-center">
                                                <div class="mb-4">
                                                    <i class="mdi mdi-check-circle-outline text-success display-4"></i>
                                                </div>
                                                <div>
                                                    <h5>Confirm Detail</h5>
                                                    <p class="text-muted">If several languages coalesce, the grammar of
                                                        the resulting</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <ul class="pager wizard twitter-bs-wizard-pager-link">
                                
                                <li class="next"><a href="javascript: void(0);">Siguiente</a></li>
                            </ul>
                        </div>





                    </div>
				</div>
			</div>
		</div>
	</div>
</div>





<div class="col-sm-6 col-md-4 col-xl-3">
                          

                                <!-- sample modal content -->
                                <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title mt-0" id="myModalLabel">Modificar categoria</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form class="needs-validation" id="form_2">
                                            <div class="modal-body">
                                            
                                            			<div class="row">
                                                              <div class="col-md-6">
                                                                  <div class="mb-6">
                                                                      <input type="hidden" value="" id="id_categoria">
                                                                      <label for="validationCustom01" class="form-label">Descripción</label>
                                                                      <input type="text" class="form-control" id="descripcion" placeholder="Categoria" value="" required>
                                                          
                                                                  </div>
                                                              </div>
                                                              
                                                        </div>

                                                
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Cerrar</button>
                                                <button type="submit" class="btn btn-primary waves-effect waves-light" >Guardar</button>
                                            </div>
                                            </form>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                            </div>




                            <div class="col-sm-6 col-md-4 col-xl-3">
     
                          <!-- sample modal content -->
                          <div id="modal_agregar" class="modal fade" tabindex="-1" role="dialog"
                              aria-labelledby="myModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <h5 class="modal-title mt-0" id="myModalLabel">Agregar Categoria</h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal"
                                              aria-label="Close"></button>
                                      </div>
                                      <form class="needs-validation" id="form_1">
                                      <div class="modal-body">
                                      
                                                          <div class="row">
                                                              <div class="col-md-6">
                                                                  <div class="mb-6">
                                                 
                                                                      <label for="validationCustom01" class="form-label">Descripcion</label>
                                                                      <input type="text" class="form-control" id="descripciongg"
                                                                          placeholder="Nombre del usuario" value="" required>
                                                          
                                                                  </div>
                                                              </div>
                                                             
                                                              </div>
       
                                      </div>
                                      <div class="modal-footer">
                                          <button type="button" class="btn btn-light waves-effect"
                                              data-bs-dismiss="modal">Cerrar</button>
                                          <button type="submit"
                                              class="btn btn-primary waves-effect waves-light" >Agregar</button>
                                      </div>
                                      </form>
                                  </div><!-- /.modal-content -->
                              </div><!-- /.modal-dialog -->
                          </div><!-- /.modal -->
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


<script src="../assets/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>

<script src="../assets/libs/twitter-bootstrap-wizard/prettify.js"></script>

<!-- form wizard init -->

<script src="../assets/libs/select2/js/select2.min.js"></script>

';
?>

<script>
    $(document).ready(function() {
      
    $('#basic-pills-wizard').bootstrapWizard({
        'tabClass': 'nav nav-pills nav-justified'
    });

    $('#progrss-wizard').bootstrapWizard({onTabShow: function(tab, navigation, index) {
        var $total = navigation.find('li').length;
        var $current = index+1;
        var $percent = ($current/$total) * 100;
       
        alert(index);
        $('#progrss-wizard').find('.progress-bar').css({width:$percent+'%'});
    }});

});

// Active tab pane on nav link

var triggerTabList = [].slice.call(document.querySelectorAll('.twitter-bs-wizard-nav .nav-link'))
triggerTabList.forEach(function (triggerEl) {
    var tabTrigger = new bootstrap.Tab(triggerEl)

    triggerEl.addEventListener('click', function (event) {
        event.preventDefault()
        tabTrigger.show()
    
    })
})
</script>



