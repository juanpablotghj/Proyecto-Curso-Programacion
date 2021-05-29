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
                        Creación de Programacion
                        <a href="<?= ROOT ?>modulos/programaciones/programaciones.php" class="btn btn-primary">Regresar</a>
                    </div>
                    <div class="card-body">
                        <form action="add.php" method="POST" name="forprogramaciones">

                        <div id='mensaje'> </div>

                            <div class="form-group">
                                <label for="fechainicio">Fecha Inicial</label>
                                <input type="date" class="form-control" id="fechainicio" name="fechainicio" required>
                            </div>

                            <div class="form-group">
                                <label for="fechafinal">Fecha Final</label>
                                <input type="date" class="form-control" id="fechafinal" name="fechafinal" required>
                            </div>

                            <div class="form-group">
                                <label for="cantidad">Cantidad</label>
                                <input type="text" class="form-control" id="cantidad" name="cantidad" required>
                            </div>

                            <div class="form-group">
                                <label for="producto">Producto a Crear</label>
                                <select class="form-control" id="producto" name="producto">
                                    <option value=''>Seleccione un producto</option>
                                    <?php 
                                        foreach($productos as $producto) {
                                            echo "<option value='".$producto['id']."'>".$producto['nombres']."</option>";
                                        }
                                    ?>  
                                </select>
                            </div>
                            
                            <input type="button" class="btn btn-primary" onclick="ValidarProgramaciones()" value='Crear'>
                        </form>     
                    </div>
                </div>
            </div>
        </div>
    <div>

    <script src="../../js/javascript.js" ></script>
    <script src="../../js/validaciones.js" ></script>
    <script src="../../bootstrap/js/bootstrap.bundle.min.js" ></script>
</body>
</html>