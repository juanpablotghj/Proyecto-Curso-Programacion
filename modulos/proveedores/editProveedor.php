<?php 
    include_once("../../config/DBConect.php");
    include_once("../../config/Config.php");

    session_start();
    $role = $_SESSION['sess_userrole'];

    if(!isset($_SESSION['sess_username'])){
        header("Location: ".ROOT."index.php?mensaje=2");
    }else{
        if($role!="2"){
            session_destroy();
            header("Location: ".ROOT."index.php?mensaje=4");
        }
    }

    $id = $_GET['id'];

    $conexion = new Database;  
    $result = $conexion->editProveedor($id);

    $prov_id = $prov_nombres = $prov_apellidos = $prov_email = $prov_ciudad = $prov_identificacion = "";
    foreach($result->fetchAll(PDO::FETCH_OBJ) as $r){
        $prov_id = $r->id;
        $prov_nombres = $r->nombres;
        $prov_apellidos = $r->apellidos;
        $prov_email = $r->email;
        $prov_ciudad  = $r->ciudad;
        $prov_identificacion = $r->identificacion;
    }


    $conexion = new Database;  
    $paises = $conexion->DatosPaises();

    $conexion = new Database;  
    $ciudades = $conexion->DatosCiudades();
    
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

    <?php include_once('../../perfiles/directors/menu.php'); ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-8 col-xl-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        Modificar Proveedor
                        <a href="<?= ROOT ?>modulos/proveedores/proveedores.php" class="btn btn-primary">Regresar</a>
                    </div>
                    <div class="card-body">
                        <form action="update.php" method="POST" name="forrol">
                            <div class="form-group">
                                <label for="identificacion">Identificacion</label>
                                <input type="text" class="form-control" id="identificacion" name="identificacion" value="<?= $prov_identificacion ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="nombres">Nombres</label>
                                <input type="text" class="form-control" id="nombres" name="nombres" value="<?= $prov_nombres ?>" required>
                                <input type="hidden" class="form-control" id="id" name="id" value="<?= $prov_id ?>">
                            </div>

                            <div class="form-group">
                                <label for="apellidos">Apellidos</label>
                                <input type="text" class="form-control" id="apellidos" name="apellidos" value="<?= $prov_apellidos ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="email">email</label>
                                <input type="text" class="form-control" id="email" name="email" value="<?= $prov_email ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="ciudad">Paises</label>
                                <select class="form-control" id="pais" name="pais">
                                    <?php 
                                        foreach($paises as $pais) {
                                            echo "<option value='".$pais['id']."'>".$pais['nombre']."</option>";
                                        }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="ciudad">Ciudad</label>
                                <select class="form-control" id="ciudad" name="ciudad">
                                    <?php 
                                         $selected ='';
                                        foreach($ciudades as $ciudad) {
                                            if($prov_ciudad==$ciudad['id']){
                                                $selected = 'selected';
                                            }else{
                                                $selected = '';
                                            }

                                            echo "<option value='".$ciudad['id']."'  $selected>".$ciudad['nombre']."</option>";
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