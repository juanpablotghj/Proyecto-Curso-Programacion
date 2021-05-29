<?php 

    session_start();
    include_once("../../config/DBConect.php");
    include_once("../../config/Config.php");    

    $contador       = $_POST['identificador'];

    $conexion = new Database;  
    $eliminar = $conexion->EliminarInventarioMateria();

    for ($i=0; $i < $contador ; $i++) {  
        $codigo         = $_POST['codigo'.$i];
        $codbarra       = $_POST['codbarra'.$i];
        $nombres        = $_POST['nombres'.$i];
        $costo          = $_POST['costo'.$i]; 
        $stock          = $_POST['stock'.$i];

        $conexion = new Database;  
        $result = $conexion->CrearInventarioMateria($codigo,$codbarra,$stock);
    }

    header("Location: ".ROOT."modulos/inventariosmaterias/inventariosmaterias.php?mensaje=2");


?>