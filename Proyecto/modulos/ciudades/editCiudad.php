<?php 
    include_once("../../config/DBConect.php");
    include_once("../../config/Config.php");

    session_start();
    $role = $_SESSION['sess_userrole'];

    if(!isset($_SESSION['sess_username'])){
        header("Location: ".ROOT."index.php?mensaje=2");
    }else{
        if($role!="1"){
            session_destroy();
            header("Location: ".ROOT."index.php?mensaje=4");
        }
    }

    $id = $_GET['id'];

    $conexion = new Database;  
    $result = $conexion->editCiudad($id);

    $ciu_id = $ciu_nombre = "";
    foreach($result->fetchAll(PDO::FETCH_OBJ) as $r){
        $ciu_id = $r->id;
        $ciu_nombre = $r->nombre;
        $ciu_pais = $r->pais;
    }


    $conexion = new Database;  
    $paises = $conexion->DatosPaises();
    
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

    <?php include_once('../../perfiles/administrador/menu.php'); ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-8 col-xl-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        Modificar Ciudad
                        <a href="<?= ROOT ?>modulos/ciudades/ciudades.php" class="btn btn-primary">Regresar</a>
                    </div>
                    <div class="card-body">
                        <form action="update.php" method="POST" name="forciudad">
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $ciu_nombre ?>" required>
                                <input type="hidden" class="form-control" id="id" name="id" value="<?= $ciu_id ?>">
                            </div>
                            <div class="form-group">
                                <label for="role">Rol</label>
                                <select class="form-control" id="pais" name="pais">
                                    <?php 
                                         $selected ='';
                                        foreach($paises as $pais) {
                                            if($ciu_pais==$pais['id']){
                                                $selected = 'selected';
                                            }else{
                                                $selected = '';
                                            }

                                            echo "<option value='".$pais['id']."'  $selected>".$pais['nombre']."</option>";
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