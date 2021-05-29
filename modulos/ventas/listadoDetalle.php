<?php
    session_start();
    include_once("../../config/DBConect.php");
    include_once("../../config/Config.php");

    $role = $_SESSION['sess_userrole'];

    if(!isset($_SESSION['sess_username'])){
        header("Location:  ".ROOT."index.php?mensaje=2");
    }else{
        if($role!="3"){
            session_destroy();
            header("Location:  ".ROOT."index.php?mensaje=4");
        }
    }

    $orden_id = $_GET['id'];

    $conexion = new Database;  
    $result = $conexion->ListadoDetVenta($orden_id);

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

    <?php include_once('../../perfiles/vendedores/menu.php'); ?>

    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center"> 
                <h2>Detalle Compra # <?php echo $orden_id; ?> </h2>
                <a href="listadoVentas.php" class="btn btn-primary">Regresar </a>
            </div>

            <div class="card-body">
                <a href="VerCarta.php" class="cart-link" title="Ver Carta"></a>
                    <div id="products" class="row">
                        <table id="mytable" class="table">
                            <thead>
                                <tr>
                                <th scope="col">Materia Prima</th>
                                <th scope="col">Costo</th>
                                <th scope="col">Cantidad</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                
                                    foreach($result as $row) {
                                        echo "<tr>
                                                <td>".$row['nombres']."</td>
                                                <td>".$row['costo']."</td>
                                                <td>".$row['quantity']."</td>
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