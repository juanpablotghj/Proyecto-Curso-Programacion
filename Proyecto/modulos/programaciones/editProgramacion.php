<?php 
    include_once("../../config/DBConect.php");
    include_once("../../config/Config.php");

    session_start();
    $role = $_SESSION['sess_userrole'];

    if(!isset($_SESSION['sess_username'])){
        header("Location: ".ROOT."index.php?mensaje=2");
    }else{
        if($role!="4"){
            session_destroy();
            header("Location: ".ROOT."index.php?mensaje=4");
        }
    }

    $id = $_GET['id'];

    $conexion = new Database;  
    $result = $conexion->editProgramacion($id);

    $pro_id = $pro_inicio = $pro_fin = $pro_cantidad = $pro_producto = "";
    foreach($result->fetchAll(PDO::FETCH_OBJ) as $r){
        $pro_id = $r->id;
        $pro_inicio = $r->fecha_inicio;
        $pro_fin = $r->fecha_fin;
        $pro_cantidad = $r->producto_id;
        $pro_producto  = $r->cantidad;
    }

    $conexion = new Database;  
    $productos = $conexion->DatosProductos();
    
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
                        Modificar Programacion
                        <a href="<?= ROOT ?>modulos/programaciones/programaciones.php" class="btn btn-primary">Regresar</a>
                    </div>
                    <div class="card-body">
                        <form action="update.php" method="POST" name="forprogramaciones">
                            
                            <div class="form-group">
                                <label for="fechainicio">Fecha Inicio</label>
                                <input type="text" class="form-control" id="fechainicio" name="fechainicio" value="<?= $pro_inicio ?>" required>
                                <input type="hidden" class="form-control" id="id" name="id" value="<?= $pro_id ?>">
                            </div>

                            <div class="form-group">
                                <label for="fechafinal">Fecha Final</label>
                                <input type="text" class="form-control" id="fechafinal" name="fechafinal" value="<?= $pro_fin ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="cantidad">Cantidad</label>
                                <input type="text" class="form-control" id="cantidad" name="cantidad" value="<?= $pro_cantidad ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="producto">Producto</label>
                                <select class="form-control" id="producto" name="producto">
                                    <?php 
                                        $selected ='';
                                        foreach($productos as $producto) {
                                            if($pro_producto==$producto['id']){
                                                $selected = 'selected';
                                            }else{
                                                $selected = '';
                                            }

                                            echo "<option value='".$producto['id']."'  $selected>".$producto['nombres']."</option>";
                                        }
                                    ?>
                                </select>
                            </div>

                            
                            
                            <button type="submit" class="btn btn-primary">Actualizar</button>
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