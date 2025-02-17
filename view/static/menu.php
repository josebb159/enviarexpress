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
                            <a href="home.php?view=usuarios" class=" waves-effect <?php if($valor=="usuarios"){ echo "active mm-active"; } ?>">
                                <i class="ri-user-fill"></i>
                                <span>Usuarios sistema</span>
                            </a>
                        </li>
						<li>
                            <a href="home.php?view=usuarios_cliente" class=" waves-effect <?php if($valor=="usuarios_cliente"){ echo "active mm-active"; } ?>">
                                <i class="ri-user-fill"></i>
                                <span>Usuarios cliente</span>
                            </a>
                        </li>

         
        
       <!--   
	
    <li>
		 <a href="home.php?view=colores" class=" waves-effect <?php if($valor=="colores"){ echo "active mm-active"; } ?>">
			<i class="fa fa-square"></i>
			<span>colores</span>
		</a>
	</li>
	<li>
		 <a href="home.php?view=medidas" class=" waves-effect <?php if($valor=="medidas"){ echo "active mm-active"; } ?>">
			<i class="fa fa-window-minimize"></i>
			<span>medidas</span>
		</a>
	</li>
	
-->


	<li>
		 <a href="home.php?view=producto" class=" waves-effect <?php if($valor=="producto"){ echo "active mm-active"; } ?>">
			<i class="fa fa-cube"></i>
			<span>Producto</span>
		</a>
	</li>
	<li>
		 <a href="home.php?view=category" class=" waves-effect <?php if($valor=="category"){ echo "active mm-active"; } ?>">
			<i class="fa fa-tags"></i>
			<span>Categoria</span>
		</a>
	</li>
	<li>
		 <a href="home.php?view=comercios" class=" waves-effect <?php if($valor=="comercios"){ echo "active mm-active"; } ?>">
			<i class="fa fa-shopping-bag"></i>
			<span>Comercios</span>
		</a>
	</li>
	<li>
		 <a href="home.php?view=configuracion" class=" waves-effect <?php if($valor=="configuracion"){ echo "active mm-active"; } ?>">
			<i class="fa fa-cogs"></i>
			<span>Configuración</span>
		</a>
	</li>
	<li>
		 <a href="home.php?view=mensaje" class=" waves-effect <?php if($valor=="mensaje"){ echo "active mm-active"; } ?>">
			<i class="fa fa-paper-plane"></i>
			<span>Mensaje</span>
		</a>
	</li>

	<li>
    <a href="home.php?view=orden" class="waves-effect <?php if($valor=="orden"){ echo "active mm-active"; } ?>">
        <i class="fas fa-clipboard-list"></i>
        <span>Orden</span>
    </a>
</li>
<li>
    <a href="home.php?view=lista_orden" class="waves-effect <?php if($valor=="lista_orden"){ echo "active mm-active"; } ?>">
        <i class="fas fa-list"></i>
        <span>Lista Orden</span>
    </a>
</li>
<li>
    <a href="home.php?view=mandado" class="waves-effect <?php if($valor=="mandado"){ echo "active mm-active"; } ?>">
        <i class="fas fa-shopping-cart"></i>
        <span>Mandado</span>
    </a>
</li>
<li>
    <a href="home.php?view=rol" class="waves-effect <?php if($valor=="rol"){ echo "active mm-active"; } ?>">
        <i class="fas fa-user-tag"></i>
        <span>Rol</span>
    </a>
</li>
<li>
    <a href="home.php?view=direccion" class="waves-effect <?php if($valor=="direccion"){ echo "active mm-active"; } ?>">
        <i class="fas fa-map-marker-alt"></i>
        <span>Direcciones</span>
    </a>
</li>
<li>
    <a href="home.php?view=horario_atencion" class="waves-effect <?php if($valor=="horario_atencion"){ echo "active mm-active"; } ?>">
        <i class="fas fa-clock"></i>
        <span>Horario Atención</span>
    </a>
</li>
<li>
    <a href="home.php?view=delivery" class="waves-effect <?php if($valor=="delivery"){ echo "active mm-active"; } ?>">
        <i class="fas fa-truck"></i>
        <span>Delivery</span>
    </a>
</li>
<li>
    <a href="home.php?view=jefe_zona" class="waves-effect <?php if($valor=="jefe_zona"){ echo "active mm-active"; } ?>">
        <i class="fas fa-user-tie"></i>
        <span>Jefe de Zona</span>
    </a>
</li>
<li>
    <a href="home.php?view=notificacion_correo" class="waves-effect <?php if($valor=="notificacion_correo"){ echo "active mm-active"; } ?>">
        <i class="fas fa-envelope"></i>
        <span>Notificación Correo</span>
    </a>
</li>
<li>
    <a href="home.php?view=monedero" class="waves-effect <?php if($valor=="monedero"){ echo "active mm-active"; } ?>">
        <i class="fas fa-wallet"></i>
        <span>Monedero</span>
    </a>
</li>
<li>
    <a href="home.php?view=logs_api" class="waves-effect <?php if($valor=="logs_api"){ echo "active mm-active"; } ?>">
        <i class="fas fa-database"></i>
        <span>Logs API</span>
    </a>
</li>
<li>
    <a href="home.php?view=publicidad" class="waves-effect <?php if($valor=="publicidad"){ echo "active mm-active"; } ?>">
        <i class="fas fa-bullhorn"></i>
        <span>Publicidad</span>
    </a>
</li>

	<li>
            <a href="home.php?view=notificaciones" class="waves-effect <?php if($valor == 'notificaciones') { echo 'active mm-active'; } ?>">
                <i class="fas fa-fw fa-bell"></i>
                <span>Notificaciones</span>
            </a>
        </li>
	<li>
		 <a href="home.php?view=report" class=" waves-effect <?php if($valor=="report"){ echo "active mm-active"; } ?>">
			<i class="fas fa-fw fa-wrench"></i>
			<span>Reportes</span>
		</a>
	</li>
<!--construir-->

                    </ul>
                </div>		
        
        