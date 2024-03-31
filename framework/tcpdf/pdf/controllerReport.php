<?php
include '../../../model/report.php';


if(isset($_POST['report'])){
    $report =$_POST['report'];
}

if(isset($_POST['tipo_report'])){
    $typeRepor =$_POST['tipo_report'];
}

if(isset($_POST['name'])){
    $name =$_POST['name'];
}else{$name ="";}

if(isset($_POST['sexo'])){
    $sexo =$_POST['sexo'];
}else{$sexo ="";}

if(isset($_POST['edad'])){
    $edad =$_POST['edad'];
}else{$edad ="";}

if(isset($_POST['desde'])){
    $desde =$_POST['desde'];
}else{$desde ="";}

if(isset($_POST['hasta'])){
    $hasta =$_POST['hasta'];
}else{$hasta ="";}


if(isset($_POST['tipo_report'])){
    $typeRepor =$_POST['tipo_report'];
}


switch ($report) {
    case 'usuario':
      

        include 'usuario.php';

        break;
    case 'domicilio':
        include 'domiciliario.php';

        break;
    case 'empresa':
        include 'empresa.php';
        break;
    case 'gasto':
        include 'gasto.php';
        break;
    default:
        # code...
        break;
}


?>