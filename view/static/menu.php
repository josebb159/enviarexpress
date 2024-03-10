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
                            <a href="home.php?view=usuarios_cliente" class=" waves-effect <?php if($valor=="usuarios"){ echo "active mm-active"; } ?>">
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
		 <a href="home.php?view=orden" class=" waves-effect <?php if($valor=="orden"){ echo "active mm-active"; } ?>">
			<i class="fas fa-fw fa-wrench"></i>
			<span>Orden</span>
		</a>
	</li>
	<li>
		 <a href="home.php?view=lista_orden" class=" waves-effect <?php if($valor=="lista_orden"){ echo "active mm-active"; } ?>">
			<i class="fas fa-fw fa-wrench"></i>
			<span>Lista Orden</span>
		</a>
	</li>
	<li>
		 <a href="home.php?view=mandado" class=" waves-effect <?php if($valor=="mandado"){ echo "active mm-active"; } ?>">
			<i class="fas fa-fw fa-wrench"></i>
			<span>Mandado</span>
		</a>
	</li>
	<li>
		 <a href="home.php?view=rol" class=" waves-effect <?php if($valor=="rol"){ echo "active mm-active"; } ?>">
			<i class="fas fa-fw fa-wrench"></i>
			<span>Rol</span>
		</a>
	</li>
	<li>
		 <a href="home.php?view=direccion" class=" waves-effect <?php if($valor=="direccion"){ echo "active mm-active"; } ?>">
			<i class="fas fa-fw fa-wrench"></i>
			<span>Direcciones</span>
		</a>
	</li>
	<li>
		 <a href="home.php?view=horario_atencion" class=" waves-effect <?php if($valor=="horario_atencion"){ echo "active mm-active"; } ?>">
			<i class="fas fa-fw fa-wrench"></i>
			<span>Horario atención</span>
		</a>
	</li>
	<li>
		 <a href="home.php?view=delivery" class=" waves-effect <?php if($valor=="delivery"){ echo "active mm-active"; } ?>">
			<i class="fas fa-fw fa-wrench"></i>
			<span>Delivery</span>
		</a>
	</li>
	<li>
		 <a href="home.php?view=jefe_zona" class=" waves-effect <?php if($valor=="jefe_zona"){ echo "active mm-active"; } ?>">
			<i class="fas fa-fw fa-wrench"></i>
			<span>Jefe de zona</span>
		</a>
	</li>
	<li>
		 <a href="home.php?view=notificacion_correo" class=" waves-effect <?php if($valor=="notificacion_correo"){ echo "active mm-active"; } ?>">
			<i class="fas fa-fw fa-wrench"></i>
			<span>Notificación correo</span>
		</a>
	</li>
	<li>
		 <a href="home.php?view=monedero" class=" waves-effect <?php if($valor=="monedero"){ echo "active mm-active"; } ?>">
			<i class="fas fa-fw fa-wrench"></i>
			<span>Monedero</span>
		</a>
	</li>
	<li>
		 <a href="home.php?view=logs_api" class=" waves-effect <?php if($valor=="logs_api"){ echo "active mm-active"; } ?>">
			<i class="fas fa-fw fa-wrench"></i>
			<span>Logs API</span>
		</a>
	</li>
<!--construir-->

                    </ul>
                </div>		
        
        