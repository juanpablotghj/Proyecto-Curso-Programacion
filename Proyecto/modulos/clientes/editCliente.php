<?php 
    include_once("../../config/DBConect.php");
    include_once("../../config/Config.php");

    session_start();
    $role = $_SESSION['sess_userrole'];

    if(!isset($_SESSION['sess_username'])){
        header("Location: ".ROOT."index.php?mensaje=2");
    }else{
        if($role!="3"){
            session_destroy();
            header("Location: ".ROOT."index.php?mensaje=4");
        }
    }

    $id = $_GET['id'];

    $conexion = new Database;  
    $result = $conexion->editCliente($id);

    $cli_id = $cli_nombres = $cli_apellidos = $cli_email = $cli_ciudad = $cli_identificacion = $cli_telefono = $cli_direccion = "";
    foreach($result->fetchAll(PDO::FETCH_OBJ) as $r){
        $cli_id = $r->id;
        $cli_nombres = $r->nombres;
        $cli_apellidos = $r->apellidos;
        $cli_email = $r->email;
        $cli_ciudad  = $r->ciudad;
        $cli_identificacion = $r->identificacion;
        $cli_telefono = $r->telefono;
        $cli_direccion = $r->direccion;
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

    <?php include_once('../../perfiles/vendedores/menu.php'); ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-8 col-xl-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        Modificar Cliente
                        <a href="<?= ROOT ?>modulos/clientes/clientes.php" class="btn btn-primary">Regresar</a>
                    </div>
                    <div class="card-body">
                        <form action="update.php" method="POST" name="forcliente">
                            <div class="form-group">
                                <label for="identificacion">Identificacion</label>
                                <input type="text" class="form-control" id="identificacion" name="identificacion" value="<?= $cli_identificacion ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="nombres">Nombres</label>
                                <input type="text" class="form-control" id="nombres" name="nombres" value="<?= $cli_nombres ?>" required>
                                <input type="hidden" class="form-control" id="id" name="id" value="<?= $cli_id ?>">
                            </div>

                            <div class="form-group">
                                <label for="apellidos">Apellidos</label>
                                <input type="text" class="form-control" id="apellidos" name="apellidos" value="<?= $cli_apellidos ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="email">email</label>
                                <input type="text" class="form-control" id="email" name="email" value="<?= $cli_email ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="telefono">Telefono</label>
                                <input type="text" class="form-control" id="telefono" name="telefono" value="<?= $cli_telefono ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="direccion">Direccion</label>
                                <input type="text" class="form-control" id="direccion" name="direccion" value="<?= $cli_direccion ?>" required>
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
                                            if($cli_ciudad==$ciudad['id']){
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