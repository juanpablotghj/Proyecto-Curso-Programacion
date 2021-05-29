<?php
    // initializ shopping cart class
    include 'La-compra.php';
    $cart = new Cart;

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

    // redirect to home if cart is empty
    if($cart->total_items() <= 0){
        header("Location: index.php");
    }


    $conexion = new Database;  
    $clientes = $conexion->DatosClientes();



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    <meta charset="utf-8">
    <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../../css/style.css" rel="stylesheet" type="text/css">
</head>
<body>

    <?php include_once('../../perfiles/gerentep/menu.php'); ?>
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center"> 
                <h2>Ventas Clientes</h2>
                <a href="listadoVentas.php" class="btn btn-primary">Listar Ventas</a>
                <a href="index.php" class="btn btn-primary">Inicio</a>
                <a href="VerCompra.php" class="btn btn-primary">Ver Venta</a>
                <a href="Pagos.php" class="btn btn-primary">Vender</a>
            </div>

            <div class="card-body">
                <form action="AccionCompra.php?action=placeOrder" method="POST">
                    <div class="shipAddr">
                        <div class="form-group">
                            <label for="clientes">Cliente</label>
                            <select class="form-control" id="clientes" name="clientes">
                                <option value=''>Seleccione un cliente</option>
                                <?php 
                                    foreach($clientes as $cliente) {
                                        echo "<option value='".$cliente['id']."'>".$cliente['nombre']."</option>";
                                    }
                                ?>  
                            </select>
                        </div>
                    </div>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Mateia Prima</th>
                                <th>Pricio</th>
                                <th>Cantidad</th>
                                <th>Sub total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if($cart->total_items() > 0){
                                //get cart items from session
                                $cartItems = $cart->contents();
                                foreach($cartItems as $item){
                            ?>
                            <tr>
                                <td><?php echo $item["name"]; ?></td>
                                <td><?php echo '$'.$item["price"].' USD'; ?></td>
                                <td><?php echo $item["qty"]; ?></td>
                                <td><?php echo '$'.$item["subtotal"].' USD'; ?></td>
                            </tr>
                            <?php } }else{ ?>
                            <tr><td colspan="4"><p>No hay articulos en tu venta......</p></td>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3"></td>
                                <?php if($cart->total_items() > 0){ ?>
                                <td class="text-center"><strong>Total <?php echo '$'.$cart->total(); ?></strong></td>
                                <?php } ?>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="footBtn">
                        <a href="index.php" class="btn btn-warning"> Continuar Vendiendo</a>
                        <input type="submit"  class="btn btn-success orderBtn" value="Realizar Venta ">
                    </div>

                                      

                </form>
            </div>
        </div><!--Panek cierra-->
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="../../js/javascript.js" ></script>
    <script src="../../js/buscar.js" ></script>
    <script src="../../bootstrap/js/bootstrap.bundle.min.js" ></script>
</body>
</html>