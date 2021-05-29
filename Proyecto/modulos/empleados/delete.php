<?php
    session_start();
    include_once("../../config/DBConect.php");
    include_once("../../config/Config.php");

    $id = $_GET['id'];

    $conexion = new Database;  
    $result = $conexion->EliminarEmpleado($id);

    header("Location: ".ROOT."modulos/empleados/empleados.php?mensaje=".$result);

?>