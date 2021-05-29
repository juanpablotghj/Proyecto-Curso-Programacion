<?php

    include_once("DBConect.php");
    session_start();

	$username = $password = "";
	
	if(isset($_POST['email'])) $username = $_POST['email']; 
	if(isset($_POST['password'])) $password = $_POST['password'];
	
    $conexion = new Database;  
    $result = $conexion->DatosAutenticacion($username,$password);
    $cantidad = $result->rowCount();

    if($cantidad == 0){
		header('Location: ../index.php?mensaje=1');
	}else{
        $row = $result->fetch(PDO::FETCH_ASSOC);

		session_regenerate_id();
		$_SESSION['sess_user_id']  = $row['id'];
		$_SESSION['sess_username'] = $row['username'];
        $_SESSION['sess_userrole'] = $row['role'];
        $_SESSION['sess_usernom']  = $row['nombres'];
        $_SESSION['sess_userapel'] = $row['apellidos'];
		$_SESSION['sess_identificacion'] = $row['identificacion'];		
		session_write_close();


		if( $_SESSION['sess_userrole'] == "1"){
			header('Location: ../perfiles/administrador/home.php');
		}elseif( $_SESSION['sess_userrole'] == "2"){
			header('Location: ../perfiles/directors/home.php');
		}elseif( $_SESSION['sess_userrole'] == "3"){
			header('Location: ../perfiles/vendedores/home.php');
		}elseif( $_SESSION['sess_userrole'] == "4"){
			header('Location: ../perfiles/gerentep/home.php');
		}elseif( $_SESSION['sess_userrole'] == "5"){
			header('Location: ../perfiles/gerentev/home.php');
		}elseif( $_SESSION['sess_userrole'] == "6"){
			header('Location: ../perfiles/clientes/home.php');
		}else{
            header('Location: ../perfiles/errores/401.php');
		}
    }  


?>