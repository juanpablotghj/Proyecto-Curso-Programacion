<?php
    session_start();
    include_once("../../config/DBConect.php");
    include_once("../../config/Config.php");    

    if(isset($_POST['fechainicio'])) $fechainicio = $_POST['fechainicio'];
    if(isset($_POST['fechafinal']))  $fechafinal = $_POST['fechafinal'];
    if(isset($_POST['cantidad']))    $cantidad = $_POST['cantidad'];
    if(isset($_POST['producto']))    $producto = $_POST['producto']; 

    $conexion = new Database;  
    $result = $conexion->CrearProgramacion($fechainicio,$fechafinal,$producto,$cantidad);

    header("Location: ".ROOT."modulos/programaciones/programaciones.php?mensaje=".$result);

?>