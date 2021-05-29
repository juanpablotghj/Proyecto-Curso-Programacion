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
        if($role!="4"){
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
 
    <script>
        function updateCartItem(obj,id){
            $.get("cartAction.php", {action:"updateCartItem", id:id, qty:obj.value}, function(data){
                if(data == 'ok'){
                    location.reload();
                }else{
                    alert('Cart update failed, please try again.');
                }
            });
        }
    </script>
</head>
</head>
<body>

    <?php include_once('../../perfiles/gerentep/menu.php'); ?>  

    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center"> 
                <h2>Materia Prima</h2>
                <a href="listadoCompras.php" class="btn btn-primary">Listar Compras</a>
                <a href="index.php" class="btn btn-primary">Inicio</a>
                <a href="VerCompra.php" class="btn btn-primary">Ver Compra</a>
                <a href="Pagos.php" class="btn btn-primary">Comprar</a>
            </div>

            <div class="card-body">
                <h1>Carrito de compras</h1>
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
                            <tr><td colspan="5"><p>Tu compra esta vacia.....</p></td>
                    <?php 
                        } 
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td><a href="index.php" class="btn btn-warning"> Continuar Comprando</a></td>
                        <td colspan="2"></td>
                        <?php if($cart->total_items() > 0){ ?>
                            <td class="text-center"><strong>Total <?php echo '$'.$cart->total(); ?></strong></td>
                            <td><a href="Pagos.php" class="btn btn-success btn-block">Pagos </a></td>
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