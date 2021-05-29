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

?>
<!DOCTYPE html>
<html lang="en">
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
                <h2>Ventas Clientes</h2>
                <a href="listadoVentas.php" class="btn btn-primary">Listar Ventas</a>
                <a href="index.php" class="btn btn-primary">Inicio</a>
                <a href="VerCompra.php" class="btn btn-primary">Ver Venta</a>
                <a href="Pagos.php" class="btn btn-primary">Vender</a>
            </div>

            <div class="card-body">
                <table class="table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Sub total</th>
                        <th>&nbsp;</th>
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
                                <td><?php echo '$'.$item["price"]; ?></td>
                                <td><?php echo $item["qty"]; ?></td>
                                <td><?php echo '$'.$item["subtotal"]; ?></td>
                                <td>
                                    <a href="AccionCompra.php?action=removeCartItem&id=<?php echo $item["rowid"]; ?>" class="btn btn-danger" onclick="return confirm('Confirma eliminar?')">X</a>
                                </td>
                    </tr>
                    <?php   } 
                        }else{ 
                    ?>
                            <tr><td colspan="5"><p>Tu venta esta vacia.....</p></td>
                    <?php 
                        } 
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td><a href="index.php" class="btn btn-warning"> Continuar Vendiendo</a></td>
                        <td colspan="2"></td>
                        <?php if($cart->total_items() > 0){ ?>
                            <td class="text-center"><strong>Total <?php echo '$'.$cart->total(); ?></strong></td>
                            <td><a href="Pagos.php" class="btn btn-success btn-block">Vender </a></td>
                        <?php } ?>
                    </tr>
                </tfoot>
                </table>
            
            </div>
        </div><!--Panek cierra-->
 
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="../../js/javascript.js" ></script>
    <script src="../../js/buscar.js" ></script>
    <script src="../../bootstrap/js/bootstrap.bundle.min.js" ></script>

</body>
</html>