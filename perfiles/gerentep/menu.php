<nav class="navbar navbar-expand-lg navbar-light fixed-top bg-light">
    <a class="navbar-brand" href="#">
        <img src="<?= ROOT ?>img/logo.jpg" width="50px" height="50px" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Materia Prima
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="<?= ROOT ?>modulos/materiasprimas/materiasprimas.php">Materia Prima</a>
                    <a class="dropdown-item" href="<?= ROOT ?>modulos/inventariosmaterias/inventariosmaterias.php">Inventario</a>
                    <a class="dropdown-item" href="<?= ROOT ?>modulos/programaciones/programaciones.php">Programacion</a>
                    <a class="dropdown-item" href="<?= ROOT ?>modulos/compras/index.php">Compra</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Productos
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="<?= ROOT ?>modulos/productos/productos.php">Productos</a>
                    <a class="dropdown-item" href="<?= ROOT ?>modulos/inventariosproductos/inventariosproductos.php">Inventario</a>
                </div>
            </li>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo $_SESSION['sess_usernom'].' '.$_SESSION['sess_userapel'];?>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="<?= ROOT ?>modulos/usuarios/editar.php">Editar Perfil</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?= ROOT ?>config/logout.php">Cerrar sesión</a>
                </div>
            </li>
        </ul>
        
    </div>
</nav>