<?php 
    include_once("../../config/DBConect.php");
    include_once("../../config/Config.php");

    session_start();
    $role = $_SESSION['sess_userrole'];
    $username = $_SESSION['sess_username'];

    if(!isset($username)){
        header("Location: ".ROOT."index.php?mensaje=2");
    }


    $conexion = new Database;  
    $result = $conexion->editarPerfil($username);

    $user_id = $user_nombres = $user_apellidos = $user_username = $user_rol = $user_password = "";
    foreach($result->fetchAll(PDO::FETCH_OBJ) as $r){
        $user_id = $r->id;
        $user_nombres = $r->nombres;
        $user_apellidos = $r->apellidos;
        $user_username = $r->username;
        $user_rol  = $r->role;
        $user_password = $r->password;
        $user_identificacion = $r->identificacion;
    }


    $conexion = new Database;  
    $roles = $conexion->DatosRoles();
    
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

    
    <?php 
        if($role == "1"){
			include_once('../../perfiles/administrador/menu.php'); 
		}elseif($role == "2"){
			include_once('../../perfiles/directors/menu.php'); 
		}elseif($role == "3"){
			include_once('../../perfiles/vendedores/menu.php'); 
		}elseif($role == "4"){
			include_once('../../perfiles/gerentep/menu.php'); 
		}elseif($role == "5"){
			include_once('../../perfiles/gerentev/menu.php'); 
		}elseif($role == "6"){
			include_once('../../perfiles/clientes/menu.php'); 
		}
    ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-8 col-xl-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        Modificar Usuario
                    </div>
                    <div class="card-body">
                        <form action="update.php" method="POST" name="forrol">
                            <div class="form-group">
                                <label for="identificacion">Identificacion</label>
                                <input type="text" class="form-control" id="identificacion" name="identificacion" value="<?= $user_identificacion ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="nombres">Nombres</label>
                                <input type="text" class="form-control" id="nombres" name="nombres" value="<?= $user_nombres ?>" required>
                                <input type="hidden" class="form-control" id="id" name="id" value="<?= $user_id ?>">
                            </div>

                            <div class="form-group">
                                <label for="apellidos">Apellidos</label>
                                <input type="text" class="form-control" id="apellidos" name="apellidos" value="<?= $user_apellidos ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" value="<?= $user_username ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" value="<?= $user_password ?>" readonly>
                                <input type="hidden" class="form-control" id="role" name="role" value="<?= $user_rol ?>">
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