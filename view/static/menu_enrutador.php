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
		 <a href="home.php?view=delivery" class=" waves-effect <?php if($valor=="delivery"){ echo "active mm-active"; } ?>">
			<i class="fas fa-fw fa-wrench"></i>
			<span>Delivery</span>
		</a>
	</li>
    <li>
		 <a href="home.php?view=enrutar" class=" waves-effect <?php if($valor=="enrutar"){ echo "active mm-active"; } ?>">
			<i class="fas fa-fw fa-wrench"></i>
			<span>Enrutador</span>
		</a>
	</li>

    <li>
		 <a href="home.php?view=asginados" class=" waves-effect <?php if($valor=="asginados"){ echo "active mm-active"; } ?>">
			<i class="fas fa-fw fa-wrench"></i>
			<span>Delivery asignados</span>
		</a>
	</li>

    <li>
		 <a href="home.php?view=pedidos_culminados" class=" waves-effect <?php if($valor=="pedidos_culminados"){ echo "active mm-active"; } ?>">
			<i class="fas fa-fw fa-wrench"></i>
			<span>Pedidos culminados</span>
		</a>
	</li>


    <li>
		 <a href="home.php?view=comercio" class=" waves-effect <?php if($valor=="comercio"){ echo "active mm-active"; } ?>">
			<i class="fas fa-fw fa-wrench"></i>
			<span>Comercio</span>
		</a>
	</li>











<!--construir-->

                    </ul>
                </div>		
        
        