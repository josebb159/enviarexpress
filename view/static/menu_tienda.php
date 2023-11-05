<!--- Sidemenu -->
<?php 

if(isset($_GET['view'])){
   $valor = $_GET['view'];

}else{
    $valor ="dashboard";
}



?>



<div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu list-unstyled" id="side-menu">
                        <li class="menu-title">Menu</li>

                       

                        <li>               
                            <a href="home.php?" class="waves-effect  <?php if($valor=="dashboard"){ echo "active mm-active"; } ?>">
                                <i class="ri-dashboard-line"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

             


	<li>
		 <a href="home.php?view=producto" class=" waves-effect <?php if($valor=="producto"){ echo "active mm-active"; } ?>">
			<i class="fa fa-cube"></i>
			<span>Producto</span>
		</a>
	</li>

	<li>
		 <a href="home.php?view=domiciliarios_asignados" class=" waves-effect <?php if($valor=="domiciliarios_asignados"){ echo "active mm-active"; } ?>">
			<i class="fa fa-cube"></i>
			<span>Domiciliarios asignados</span>
		</a>
	</li>
	

	<li>
		 <a href="home.php?view=miqr" class=" waves-effect <?php if($valor=="miqr"){ echo "active mm-active"; } ?>">
			<i class="fas fa-fw fa-wrench"></i>
			<span>Mi QR</span>
		</a>
	</li>

	<li>
		 <a href="home.php?view=orden" class=" waves-effect <?php if($valor=="orden"){ echo "active mm-active"; } ?>">
			<i class="fas fa-fw fa-wrench"></i>
			<span>Orden</span>
		</a>
	</li>

	<li>
		 <a href="home.php?view=horario_atencion" class=" waves-effect <?php if($valor=="horario_atencion"){ echo "active mm-active"; } ?>">
			<i class="fas fa-fw fa-wrench"></i>
			<span>Horario De Atencion</span>
		</a>
	</li>
<!--construir-->

                    </ul>
                </div>		
        
        