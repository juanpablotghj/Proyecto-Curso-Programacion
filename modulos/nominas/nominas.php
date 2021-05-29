<?php
    session_start();
    include_once("../../config/DBConect.php");
    include_once("../../config/Config.php");

    $role = $_SESSION['sess_userrole'];

    if(!isset($_SESSION['sess_username'])){
        header("Location:  ".ROOT."index.php?mensaje=2");
    }else{
        if($role!="5"){
            session_destroy();
            header("Location:  ".ROOT."index.php?mensaje=4");
        }
    }

    $conexion = new Database;  
    $empleados = $conexion->DatosEmpleados();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../../css/style.css" rel="stylesheet" type="text/css">
</head>
<body>


    <?php include_once('../../perfiles/gerentev/menu.php'); ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-8 col-xl-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <strong> Pago Comisiones y Nomina </strong>
                    </div>
                    <div class="card-body">

                        <?php 
                            $mensajes = array(
                                0=>"No se pudo realizar la acción, comunicate con el administrador",
                                1=>"Se elimino correctamente la nomina",
                                2=>"Se creo correctamente la nomina",
                                3=>"Se actualizo correctamente la nomina"
                            );

                            $mensaje_id = isset($_GET['mensaje']) ? (int)$_GET['mensaje'] : 0;
                            $mensaje='';

                            if ($mensaje_id != '') {
                                $mensaje = $mensajes[$mensaje_id];
                                $clase = 'alert-success';
                            }

                            if ($mensaje!='') echo "<div class='alert $clase' role='alert'> $mensaje </div>";
                            
                        ?> 

                    <form action='add.php' method='POST'>
                        <table class='table table-striped'>
                            <thead>
                                <tr>
                                    <th scope='col'>Empleado</th>
                                    <th scope='col'>Mes</th>
                                    <th scope='col'>Comision</th>
                                    <th scope='col'>Salario</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $ident = 0;

                                    foreach($empleados as $empleado) {

                                        echo " <tr>
                                                    <td nowrap>
                                                        ".$empleado['nombre']."
                                                        <input type='hidden' class='form-control' id='id$ident' name='id$ident' size='10' value='".$empleado['id']."'>
                                                    </td>
                                                    <td>
                                                        <div class='form-group'>
                                                            <select class='form-control' id='mes$ident' name='mes$ident'>
                                                                <option value='1'>Enero</option>
                                                                <option value='2'>Febrero</option>
                                                                <option value='3'>Marzo</option>
                                                                <option value='4'>Abril</option>
                                                                <option value='5'>Mayo</option>
                                                                <option value='6'>Junio</option>
                                                                <option value='7'>Julio</option>
                                                                <option value='8'>Agosto</option>
                                                                <option value='9'>Septiembre</option>
                                                                <option value='10'>Octubre</option>
                                                                <option value='11'>Noviembre</option>
                                                                <option value='12'>Diciembre</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <input type='text' class='form-control' id='comision$ident' name='comision$ident' size='20' value=''>
                                                    </td>
                                                    <td>
                                                        ".$empleado['salario']."
                                                        <input type='hidden' class='form-control' id='salario$ident' name='salario$ident' size='10' value='".$empleado['salario']."'>
                                                    </td>
                                                <tr>
                                                ";
                                        $ident++;
                                    }
                                ?>

                                <input type='hidden' class='form-control' id='identificador' name='identificador' value='<?= $ident ?>'>
                            </tbody>
                        </table> 

                        <button type="submit" class="btn btn-primary">Pagar Nomina</button>
                    </form> 


                    </div>
                </div>
            </div>
        </div>
    <div>

    <script src="../../js/javascript.js" ></script>
    <script src="../../bootstrap/js/bootstrap.bundle.min.js" ></script>
</body>
</html>