<?php
    session_start();
    include_once("../../config/DBConect.php");
    include_once("../../config/Config.php");

    $role = $_SESSION['sess_userrole'];

    if(!isset($_SESSION['sess_username'])){
        header("Location:  ".ROOT."index.php?mensaje=2");
    }else{
        if($role!="1"){
            session_destroy();
            header("Location:  ".ROOT."index.php?mensaje=4");
        }
    }

    $conexion = new Database;  
    $result = $conexion->DatosSedes();

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

    <?php include_once('../../perfiles/administrador/menu.php'); ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-8 col-xl-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        Listado de Sedes
                        <a href="<?= ROOT ?>modulos/sedes/addSede.php" class="btn btn-primary">Crear Sede</a>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <input type="text" class="form-control pull-right" style="width:30%" id="search" placeholder="Escriba para buscar...">
                        </div>

                        <?php 
                            $mensajes = array(
                                0=>"No se pudo realizar la acción, comunicate con el administrador",
                                1=>"Se elimino correctamente la sede",
                                2=>"Se creo correctamente la sede",
                                3=>"Se actualizo correctamente la sede"
                            );

                            $mensaje_id = isset($_GET['mensaje']) ? (int)$_GET['mensaje'] : 0;
                            $mensaje='';

                            if ($mensaje_id != '') {
                                $mensaje = $mensajes[$mensaje_id];
                                $clase = 'alert-success';
                            }

                            if ($mensaje!='') echo "<div class='alert $clase' role='alert'> $mensaje </div>";
                            
                        ?> 


                        <table id="mytable" class="table">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Herramientas</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                
                                    foreach($result as $row) {
                                        echo "<tr>
                                                <td>".$row['id']."</td>
                                                <td>".$row['nombre']."</td>
                                                <td>
                                                    <a href='editSede.php?id=".$row['id']."' class='btn btn-primary'>Modificar</a>
                                                    <a href='delete.php?id=".$row['id']."' class='btn btn-danger'>Eliminar</a>
                                                </td>
                                            </tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="../../js/javascript.js" ></script>
    <script src="../../js/buscar.js" ></script>
    <script src="../../bootstrap/js/bootstrap.bundle.min.js" ></script>
</body>
</html>