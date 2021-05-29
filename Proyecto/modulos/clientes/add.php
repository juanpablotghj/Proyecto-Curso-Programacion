<?php
    session_start();
    include_once("../../config/DBConect.php");
    include_once("../../config/Config.php");    

    if(isset($_POST['identificacion'])) $identificacion = $_POST['identificacion'];
    if(isset($_POST['nombres']))    $nombres = $_POST['nombres'];
    if(isset($_POST['apellidos']))  $apellidos = $_POST['apellidos'];
    if(isset($_POST['ciudad']))     $ciudad = $_POST['ciudad']; 
    if(isset($_POST['email']))      $email = $_POST['email']; 
    if(isset($_POST['telefono']))   $telefono = $_POST['telefono'];
    if(isset($_POST['direccion']))  $direccion = $_POST['direccion'];

    $conexion = new Database;  
    $result = $conexion->CrearCliente($identificacion,$nombres,$apellidos,$email,$telefono,$direccion,$ciudad);

    header("Location: ".ROOT."modulos/clientes/clientes.php?mensaje=".$result);

?>