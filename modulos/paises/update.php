<?php
    session_start();
    include_once("../../config/DBConect.php");
    include_once("../../config/Config.php");

    if(isset($_POST['nombre']))     $nombre = $_POST['nombre']; 
    if(isset($_POST['id']))         $id = $_POST['id']; 

    $conexion = new Database;  
    $result = $conexion->updatePais($nombre,$id);

    header("Location: ".ROOT."modulos/paises/paises.php?mensaje=".$result);

?>