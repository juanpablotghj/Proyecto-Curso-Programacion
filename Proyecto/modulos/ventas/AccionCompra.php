<?php
    date_default_timezone_set("America/Lima");
    // Iniciamos la clase de la carta
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

    $conexion = new Database; 

    

    if(isset($_REQUEST['action']) && !empty($_REQUEST['action'])){

        if($_REQUEST['action'] == 'addToCart' && !empty($_REQUEST['id'])){

            $productID = $_REQUEST['id'];

            $result = $conexion->editProducto($productID);

            foreach($result->fetchAll(PDO::FETCH_OBJ) as $r){

                $itemData = array(
                    'id' => $r->id,
                    'name' => $r->nombres,
                    'price' => $r->costo,
                    'qty' => 1
                );
            }

            $insertItem = $cart->insert($itemData);
            $redirectLoc = $insertItem?'VerCompra.php':'index.php';

            header("Location: ".$redirectLoc);
        }elseif($_REQUEST['action'] == 'updateCartItem' && !empty($_REQUEST['id'])){

            $itemData = array(
                'rowid' => $_REQUEST['id'],
                'qty' => $_REQUEST['qty']
            );

            $updateItem = $cart->update($itemData);
            echo $updateItem?'ok':'err';die;

        }elseif($_REQUEST['action'] == 'removeCartItem' && !empty($_REQUEST['id'])){

            $deleteItem = $cart->remove($_REQUEST['id']);
            header("Location: VerCompra.php");
            
        }elseif($_REQUEST['action'] == 'placeOrder' && $cart->total_items() > 0 && !empty($_SESSION['sess_user_id'])){
            
            $result = $conexion->ConsecutivoVenta();

            foreach($result as $row) {
                $consecutivo = $row['id'];
            }

            $users_id = $_SESSION['sess_user_id'];
            $total_price = $cart->total();
            $created = date("Y-m-d H:i:s");
            $modified = date("Y-m-d H:i:s");
            $status = 1;
            $clientes = $_REQUEST['clientes'];

            $insertOrder = $conexion->CrearVenta($consecutivo,$users_id,$clientes,$total_price,$created,$modified,$status);

            if($insertOrder){
                // get cart items
                $cartItems = $cart->contents();

                $mendet = "";

                foreach($cartItems as $item){
                    $product_id = $item['id'];
                    $quantity = $item['qty'];

                    $insertOrderItems = $conexion->CrearDetVenta($consecutivo,$product_id,$quantity);
                    $detmateria = $conexion->editProducto($product_id);

                    foreach($detmateria->fetchAll(PDO::FETCH_OBJ) as $r){
                        $codigobarras = $r->codbarra;
                    }

                    $actualizarinventario = $conexion->updateInvVenta($codigobarras,$quantity);
                    
                    $mendet +=  $insertOrderItems;

                }

                if($mendet){
                    $cart->destroy();
                    header("Location: OrdenExito.php?id=$consecutivo");
                }else{
                    header("Location: Pagos.php");
                }
            }else{
                header("Location: Pagos.php");
            }
        }else{
            header("Location: index.php");
        }
    }else{
        header("Location: index.php");
    }