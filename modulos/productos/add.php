<?php
    session_start();
    include_once("../../config/DBConect.php");
    include_once("../../config/Config.php");    

    if(isset($_POST['codigo']))         $codigo = $_POST['codigo'];
    if(isset($_POST['codbarra']))       $codbarra = $_POST['codbarra'];
    if(isset($_POST['nombres']))        $nombres = $_POST['nombres'];
    if(isset($_POST['descripcion']))    $descripcion = $_POST['descripcion']; 
    if(isset($_POST['costo']))          $costo = $_POST['costo'];

    $conexion = new Database;  
    $result = $conexion->CrearProducto($codigo,$codbarra,$nombres,$descripcion,$costo);

    header("Location: ".ROOT."modulos/productos/productos.php?mensaje=".$result);

?>