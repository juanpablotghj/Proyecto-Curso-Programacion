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
    $result = $conexion->editMateriaPrima($id);

    $mat_id = $mat_codigo = $mat_codbarra = $mat_nombres = $mat_descripcion = $mat_costo = "";
    foreach($result->fetchAll(PDO::FETCH_OBJ) as $r){
        $mat_id         = $r->id;
        $mat_codigo     = $r->codigo;
        $mat_codbarra   = $r->codbarra;
        $mat_nombres    = $r->nombres;
        $mat_descripcion  = $r->descripcion;
        $mat_costo      = $r->costo;
    }

    
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
                        Modificar Materia Prima
                        <a href="<?= ROOT ?>modulos/materiasprimas/materiasprimas.php" class="btn btn-primary">Regresar</a>
                    </div>
                    <div class="card-body">
                        <form action="update.php" method="POST" name="formateriasprimas">
                            <div class="form-group">
                                <label for="codigo">Codigo</label>
                                <input type="text" class="form-control" id="codigo" name="codigo" value="<?= $mat_codigo ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="codbarra">Codigo de Barras</label>
                                <input type="text" class="form-control" id="codbarra" name="codbarra" value="<?= $mat_codbarra ?>" required>
                                <input type="hidden" class="form-control" id="id" name="id" value="<?= $mat_id ?>">
                            </div>

                            <div class="form-group">
                                <label for="nombres">Nombre</label>
                                <input type="text" class="form-control" id="nombres" name="nombres" value="<?= $mat_nombres ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="descripcion">Descripcion</label>
                                <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?= $mat_descripcion ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="costo">Costo</label>
                                <input type="text" class="form-control" id="costo" name="costo" value="<?= $mat_costo ?>" required>
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