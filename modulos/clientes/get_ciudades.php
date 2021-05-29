<?php
	include_once("../../config/DBConect.php");
    include_once("../../config/Config.php");

    session_start();
    $role = $_SESSION['sess_userrole'];

    if(!isset($_SESSION['sess_username'])){
        header("Location: ".ROOT."index.php?mensaje=2");
    }else{
        if($role!="3"){
            session_destroy();
            header("Location: ".ROOT."index.php?mensaje=4");
        }
    }

	$conexion = new Database;  
    $ciudades = $conexion->DatosCiudadesPais($_GET['pais']);
	$reg = $ciudades->rowCount();

	if($reg>0){
		print "<option value=''>Seleccione una Ciudad</option>";
		foreach($ciudades as $ciudad) {
			echo "<option value='".$ciudad['id']."'>".$ciudad['nombre']."</option>";
		}
	}else{
		print "<option value=''>-- NO HAY DATOS --</option>";
	}
?>