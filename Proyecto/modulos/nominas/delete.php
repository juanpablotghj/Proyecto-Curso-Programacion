<?php
    session_start();
    include_once("../../config/DBConect.php");
    include_once("../../config/Config.php");

    $id = $_GET['id'];

    $conexion = new Database;  
    $result = $conexion->EliminarNomina($id);

    header("Location: ".ROOT."modulos/nominas/index.php?mensaje=".$result);

?>