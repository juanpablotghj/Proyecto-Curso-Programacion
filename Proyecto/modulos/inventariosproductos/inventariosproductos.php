<?php
    session_start();
    include_once("../../config/DBConect.php");
    include_once("../../config/Config.php");

    $role = $_SESSION['sess_userrole'];

    if(!isset($_SESSION['sess_username'])){
        header("Location:  ".ROOT."index.php?mensaje=2");
    }else{
        if($role!="4"){
            session_destroy();
            header("Location:  ".ROOT."index.php?mensaje=4");
        }
    }

    $conexion = new Database;  
    $inventariosproductos = $conexion->DatosProductos();

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


    <?php include_once('../../perfiles/gerentep/menu.php'); ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-8 col-xl-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <strong> Inventario de Productos </strong>
                    </div>
                    <div class="card-body">

                        <?php 
                            $mensajes = array(
                                0=>"No se pudo realizar la acción, comunicate con el administrador",
                                1=>"Se elimino correctamente el inventario",
                                2=>"Se creo correctamente el inventario",
                                3=>"Se actualizo correctamente el inventario"
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
                                    <th scope='col'>Codigo de Barras</th>
                                    <th scope='col'>Producto</th>
                                    <th scope='col'>Costo</th>
                                    <th scope='col'>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $ident = 0;

                                    foreach($inventariosproductos as $inventario) {

                                        echo " <tr>
                                                    <td>
                                                        <input type='text' class='form-control' id='codbarra$ident' name='codbarra$ident' size='40' value='".$inventario['codbarra']."'>
                                                        <input type='hidden' class='form-control' id='codigo$ident' name='codigo$ident' size='40' value='".$inventario['codigo']."'>
                                                    </td>
                                                    <td>
                                                        <input type='text' class='form-control' id='nombres$ident' name='nombres$ident' size='40' value='".$inventario['nombres']."'>
                                                    </td>
                                                    <td>
                                                        <input type='text' class='form-control' id='costo$ident' name='costo$ident' size='40' value='".$inventario['costo']."'>
                                                    </td>
                                                ";

                                        $inventario = $conexion->ConsultarInventarioProducto($inventario['codbarra']);
                                        $cantidadinventario = $inventario->rowCount();

                                        if($cantidadinventario==0){
                                            echo "  <td>
                                                        <input type='text' class='form-control' id='stock$ident' name='stock$ident' value=''>
                                                    </td>
                                                </tr> ";
                                        }else{
                                            foreach($inventario as $invent) {
                                                echo "  <td>
                                                            <input type='text' class='form-control' id='stock$ident' name='stock$ident' value='".$invent['stock']."'>
                                                        </td>
                                                    </tr>";
                                            }
                                        }

                                        $ident++;
                                    }
                                ?>

                                <input type='hidden' class='form-control' id='identificador' name='identificador' value='<?= $ident ?>'>
                            </tbody>
                        </table> 

                        <button type="submit" class="btn btn-primary">Guardar Inventario</button>
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