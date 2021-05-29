<?php
    session_start();
    include_once("../../config/DBConect.php");
    include_once("../../config/Config.php");

    if(isset($_POST['fechainicio'])) $fechainicio = $_POST['fechainicio'];
    if(isset($_POST['fechafinal']))  $fechafinal = $_POST['fechafinal'];
    if(isset($_POST['cantidad']))    $cantidad = $_POST['cantidad'];
    if(isset($_POST['producto']))    $producto = $_POST['producto']; 
    if(isset($_POST['id']))          $id = $_POST['id']; 
    
    $conexion = new Database;  
    $result = $conexion->updateProgramacion($id,$fechainicio,$fechafinal,$producto,$cantidad);

    header("Location: ".ROOT."modulos/programaciones/programaciones.php?mensaje=".$result);

?>