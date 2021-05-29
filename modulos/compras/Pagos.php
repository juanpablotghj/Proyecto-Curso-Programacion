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

    // redirect to home if cart is empty
    if($cart->total_items() <= 0){
        header("Location: index.php");
    }


    $conexion = new Database;  
    $result = $conexion->editarPerfil($_SESSION['sess_username']);

    $user_nombres = $user_apellidos = $user_username = "";
    foreach($result->fetchAll(PDO::FETCH_OBJ) as $r){
        $user_nombres = $r->nombres;
        $user_apellidos = $r->apellidos;
        $user_username = $r->username;
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
<body>

    <?php include_once('../../perfiles/gerentep/menu.php'); ?>
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center"> 
                <h2>Vista previa de la Compra</h2>
                <a href="listadoCompras.php" class="btn btn-primary">Listar Compras</a>
                <a href="index.php" class="btn btn-primary">Inicio</a>
                <a href="VerCompra.php" class="btn btn-primary">Ver Compra</a>
                <a href="Pagos.php" class="btn btn-primary">Comprar</a>
            </div>

            <div class="card-body">
                
                <div class="shipAddr">
                    <h5>Detalles del comprador</h5>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo $user_nombres.' '.$user_apellidos; ?></td>
                                <td><?php echo $user_username; ?></td>
                            </tr>
                        </tbody>
                    </table>
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
                        <tr><td colspan="4"><p>No hay articulos en tu compra......</p></td>
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
                    <a href="index.php" class="btn btn-warning"> Continuar Comprando</a>
                    <a href="AccionCompra.php?action=placeOrder" class="btn btn-success orderBtn">Realizar pedido </a>
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