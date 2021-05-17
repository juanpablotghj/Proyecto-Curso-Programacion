<?php
    session_start();
    include_once("../../config/DBConect.php");
    include_once("../../config/Config.php");    

    if(isset($_POST['identificacion'])) $identificacion = $_POST['identificacion'];
    if(isset($_POST['nombres']))    $nombres = $_POST['nombres'];
    if(isset($_POST['apellidos']))  $apellidos = $_POST['apellidos'];
    if(isset($_POST['tipo']))       $tipo = $_POST['tipo']; 
    if(isset($_POST['email']))      $email = $_POST['email']; 
    if(isset($_POST['sede']))       $sede = $_POST['sede'];
    if(isset($_POST['ciudad']))     $ciudad = $_POST['ciudad'];

    $conexion = new Database;  
    $result = $conexion->CrearEmpleado($identificacion,$nombres,$apellidos,$tipo,$email,$sede,$ciudad);

    header("Location: ".ROOT."modulos/empleados/empleados.php?mensaje=".$result);

?>