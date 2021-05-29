<?php
    session_start();
    include_once("../../config/DBConect.php");
    include_once("../../config/Config.php");

    if(isset($_POST['nombre']))     $nombre = $_POST['nombre']; 
    if(isset($_POST['id']))         $id = $_POST['id']; 
    if(isset($_POST['pais']))       $pais = $_POST['pais']; 

    $conexion = new Database;  
    $result = $conexion->updateCiudad($nombre,$pais,$id);

    header("Location: ".ROOT."modulos/ciudades/ciudades.php?mensaje=".$result);

?>