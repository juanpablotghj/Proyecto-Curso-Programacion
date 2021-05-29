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
                        Creación de Empleado
                        <a href="<?= ROOT ?>modulos/empleados/empleados.php" class="btn btn-primary">Regresar</a>
                    </div>
                    <div class="card-body">
                        <form action="add.php" method="POST" name="forempleados">

                        <div id='mensaje'> </div>

                        <div class="form-group">
                                <label for="identificacion">Identificacion</label>
                                <input type="text" class="form-control" id="identificacion" name="identificacion" required>
                            </div>

                            <div class="form-group">
                                <label for="nombres">Nombres</label>
                                <input type="text" class="form-control" id="nombres" name="nombres" required>
                            </div>

                            <div class="form-group">
                                <label for="apellidos">Apellidos</label>
                                <input type="text" class="form-control" id="apellidos" name="apellidos" required>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" name="email" required>
                            </div>

                            <div class="form-group">
                                <label for="tipo">Tipo</label>
                                <select class="form-control" id="tipo" name="tipo">
                                    <option value=''>Seleccione un tipo</option>
                                    <?php 
                                        foreach($tipos as $tipo) {
                                            echo "<option value='".$tipo['id']."'>".$tipo['nombre']."</option>";
                                        }
                                    ?>  
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="sede">Sede</label>
                                <select class="form-control" id="sede" name="sede">
                                    <option value=''>Seleccione una sede</option>
                                    <?php 
                                        foreach($sedes as $sede) {
                                            echo "<option value='".$sede['id']."'>".$sede['nombre']."</option>";
                                        }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="ciudad">Paises</label>
                                <select class="form-control" id="pais" name="pais">
                                    <option value=''>Seleccione un Pais</option>
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
                                    <option value=''>Seleccione una Ciudad</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="salario">Salario</label>
                                <input type="text" class="form-control" id="salario" name="salario" required>
                            </div>
                            
                            <input type="button" class="btn btn-primary" onclick="ValidarEmpleados()" value='Crear'>
                        </form>     
                    </div>
                </div>
            </div>
        </div>
    <div>

    <script src="../../js/jquery.min.js" ></script>
    <script src="../../js/validaciones.js" ></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#pais").change(function(){
                $.get("get_ciudades.php","pais="+$("#pais").val(), function(data){
                    $("#ciudad").html(data);
                    console.log(data);
                });
            });
        });
    </script>
    <script src="../../bootstrap/js/bootstrap.bundle.min.js" ></script>
</body>
</html>