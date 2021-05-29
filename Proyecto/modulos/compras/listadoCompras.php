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
    $result = $conexion->ListadoOrden();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Document</title>
    <meta charset="utf-8">
    <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../../css/style.css" rel="stylesheet" type="text/css">
</head>
</head>
<body>

    <?php include_once('../../perfiles/gerentep/menu.php'); ?>

    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center"> 
                <h2>Materia Prima</h2>
                <a href="index.php" class="btn btn-primary">Inicio</a>
                <a href="VerCompra.php" class="btn btn-primary">Ver Compra</a>
                <a href="Pagos.php" class="btn btn-primary">Comprar</a>
            </div>

            <div class="card-body">
                <br>
                <a href="VerCarta.php" class="cart-link" title="Ver Carta"></a>
                    <div id="products" class="row">
                        <table id="mytable" class="table">
                            <thead>
                                <tr>
                                <th scope="col"># Compra</th>
                                <th scope="col">Nombre Usuario</th>
                                <th scope="col">Costo</th>
                                <th scope="col">Fecha Compra</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                
                                    foreach($result as $row) {
                                        echo "<tr>
                                                <td>".$row['id']."</td>
                                                <td>".$row['nombres']." ".$row['apellidos']."</td>
                                                <td>".$row['total_price']."</td>
                                                <td>".$row['created']."</td>
                                                <td >
                                                    <a class='btn btn-success' href='listadoDetalle.php?id=".$row['id']."'>Ver Detalle</a>    
                                                </td>
                                            </tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
            </div>
        </div><!--Panek cierra-->
        
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="../../js/javascript.js" ></script>
    <script src="../../js/buscar.js" ></script>
    <script src="../../bootstrap/js/bootstrap.bundle.min.js" ></script>
</body>
</html>