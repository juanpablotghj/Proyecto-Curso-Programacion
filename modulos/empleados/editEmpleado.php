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
    $result = $conexion->editEmpleados($id);

    $emp_id = $emp_nombres = $emp_apellidos = $emp_email = $emp_ciudad = $emp_identificacion = $tipo = $sede = "";
    foreach($result->fetchAll(PDO::FETCH_OBJ) as $r){
        $emp_id = $r->id;
        $emp_nombres = $r->nombres;
        $emp_apellidos = $r->apellidos;
        $emp_email = $r->email;
        $emp_ciudad  = $r->ciudad;
        $emp_identificacion = $r->identificacion;
        $emp_tipo = $r->tipo;
        $emp_sede = $r->sede;
    }


    $conexion = new Database;  
    $paises = $conexion->DatosPaises();

    $conexion = new Database;  
    $ciudades = $conexion->DatosCiudades();

    $conexion = new Database;  
    $sedes = $conexion->DatosSedes();

    $conexion = new Database;  
    $tipos = $conexion->DatosTipos();
    
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
                        Modificar Empleado
                        <a href="<?= ROOT ?>modulos/empleados/empleados.php" class="btn btn-primary">Regresar</a>
                    </div>
                    <div class="card-body">
                        <form action="update.php" method="POST" name="forrol">
                            <div class="form-group">
                                <label for="identificacion">Identificacion</label>
                                <input type="text" class="form-control" id="identificacion" name="identificacion" value="<?= $emp_identificacion ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="nombres">Nombres</label>
                                <input type="text" class="form-control" id="nombres" name="nombres" value="<?= $emp_nombres ?>" required>
                                <input type="hidden" class="form-control" id="id" name="id" value="<?= $emp_id ?>">
                            </div>

                            <div class="form-group">
                                <label for="apellidos">Apellidos</label>
                                <input type="text" class="form-control" id="apellidos" name="apellidos" value="<?= $emp_apellidos ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="email">email</label>
                                <input type="text" class="form-control" id="email" name="email" value="<?= $emp_email ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="tipo">Tipo</label>
                                <select class="form-control" id="tipo" name="tipo">
                                    <?php 
                                        $selected ='';
                                        foreach($tipos as $tipo) {
                                            if($emp_tipo==$tipo['id']){
                                                $selected = 'selected';
                                            }else{
                                                $selected = '';
                                            }

                                            echo "<option value='".$tipo['id']."'  $selected>".$tipo['nombre']."</option>";
                                        }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="sede">Sede</label>
                                <select class="form-control" id="sede" name="sede">
                                    <?php 
                                         $selected ='';
                                        foreach($sedes as $sede) {
                                            if($emp_sede==$sede['id']){
                                                $selected = 'selected';
                                            }else{
                                                $selected = '';
                                            }

                                            echo "<option value='".$sede['id']."'  $selected>".$sede['nombre']."</option>";
                                        }
                                    ?>
                                </select>
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
                                            if($emp_ciudad==$ciudad['id']){
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