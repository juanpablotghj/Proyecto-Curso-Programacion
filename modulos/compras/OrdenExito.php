<?php
    if(!isset($_REQUEST['id'])){
        header("Location: index.php");
    }

    session_start();
    include_once("../../config/DBConect.php");
    include_once("../../config/Config.php");

    $role = $_SESSION['sess_userrole'];

    if(!isset($_SESSION['sess_username'])){
        header("Location:  ".ROOT."index.php?mensaje=2");
    }else{
        if($role!="4"){
            session_destroy();
            header("Location:  ".ROOT."index.php?mensaje=4");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    <meta charset="utf-8">
    <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../../css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
  <?php include_once('../../perfiles/gerentep/menu.php'); ?>

  <div class="container">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center"> 
          <h1>Estado de su Orden</h1>
          <a href="listadoCompras.php" class="btn btn-primary">Listar Compras</a>
          <a href="index.php" class="btn btn-primary">Inicio</a>
      </div>

        <div class="card-body">
          <div class="alert alert-success" role="alert">
            <p>Su compra ha sido enviado exitosamente. La ID de compra es #<?php echo $_GET['id']; ?></p>
          </div>
          
        </div>
    </div><!--Panek cierra-->
  </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="../../js/javascript.js" ></script>
    <script src="../../js/buscar.js" ></script>
    <script src="../../bootstrap/js/bootstrap.bundle.min.js" ></script>
</body>
</html>