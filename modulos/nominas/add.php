<?php 

    session_start();
    include_once("../../config/DBConect.php");
    include_once("../../config/Config.php");    

    $contador       = $_POST['identificador'];
 
    for ($i=0; $i < $contador ; $i++) {  
        $id         = $_POST['id'.$i];
        $mes        = $_POST['mes'.$i];
        $comision   = $_POST['comision'.$i];
        $salario    = $_POST['salario'.$i]; 
        $totalpagar = $salario+$comision;

        $conexion = new Database;  
        $result = $conexion->PagarNomina($id,$mes,$comision,$salario,$totalpagar);
    }

    header("Location: ".ROOT."modulos/nominas/nominas.php?mensaje=2");


?>