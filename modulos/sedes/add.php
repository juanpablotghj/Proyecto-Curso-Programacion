<?php
    session_start();
    include_once("../../config/DBConect.php");
    include_once("../../config/Config.php");    

    if(isset($_POST['nombre']))      $nombre = $_POST['nombre']; 

    $conexion = new Database;  
    $result = $conexion->CrearSede($nombre);

    header("Location: ".ROOT."modulos/sedes/sedes.php?mensaje=".$result);

?>