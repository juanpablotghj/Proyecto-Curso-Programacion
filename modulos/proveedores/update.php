<?php
    session_start();
    include_once("../../config/DBConect.php");
    include_once("../../config/Config.php");

    if(isset($_POST['nombres']))        $nombres = $_POST['nombres']; 
    if(isset($_POST['id']))             $id = $_POST['id']; 
    if(isset($_POST['apellidos']))      $apellidos = $_POST['apellidos']; 
    if(isset($_POST['email']))          $email = $_POST['email']; 
    if(isset($_POST['ciudad']))         $ciudad = $_POST['ciudad']; 
    if(isset($_POST['identificacion'])) $identificacion = $_POST['identificacion']; 
    
    $conexion = new Database;  
    $result = $conexion->updateProveedor($id,$nombres,$apellidos,$email,$ciudad,$identificacion);

    header("Location: ".ROOT."modulos/proveedores/proveedores.php?mensaje=".$result);

?>