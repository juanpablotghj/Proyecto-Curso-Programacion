<?php
    class Database { 
        public $db;   // handle of the db connexion    
        private static $dns = "mysql:host=localhost;dbname=proyectocurso"; 
        private static $user = "root"; 
        private static $pass = "";     
        private static $instance;

        public function __construct ()  
        {        
            $this->db = new PDO(self::$dns,self::$user,self::$pass);       
        } 

        // Se crea la instancia de la clase Database.
        // Se instancia la clase para iniciarla y poder acceder a las propiedades.
        public static function getInstance()
        { 
            if(!isset(self::$instance)) 
            { 
                $object= __CLASS__; 
                self::$instance=new $object; 
            } 
            return self::$instance; 
        } 

       
        public function DatosAutenticacion($username,$password) { 
            $conexion = Database::getInstance(); 
            $sql="SELECT id,nombres,apellidos,username,role,identificacion from users where username=:username and password=:password"; 
            $result = $conexion->db->prepare($sql);     
            $params = array("username" => $username,"password" => md5($password)); 
            $result->execute($params); 
            return ($result); 
        } 

        public function Registrar($username,$password,$nombres,$apellidos,$identificacion) { 

            try {
                $conexion = Database::getInstance(); 
                $result = $conexion->db->prepare("INSERT INTO users (username,password,nombres,apellidos,identificacion) VALUES (:username, :password, :nombres, :apellidos, :identificacion)");
                $result->execute(
                                    array(
                                        ':username'=>$username, 
                                        ':password'=>$password, 
                                        ':nombres'=>$nombres, 
                                        ':apellidos'=>$apellidos, 
                                        ':identificacion'=>$identificacion
                                    )
                                );
                return "5";
            } catch(PDOException $e) {
                return "0";
            }
        } 


        public function ValidacionCorreo($username) { 
            $conexion = Database::getInstance(); 
            $sql="SELECT id,nombres,apellidos,username,role from users where username=:username"; 
            $result = $conexion->db->prepare($sql);     
            $params = array("username" => $username); 
            $result->execute($params); 
            return ($result); 
        } 

        public function DatosRoles() { 
            $conexion = Database::getInstance(); 
            $sql="SELECT id,nombre from roles"; 
            $result = $conexion->db->prepare($sql);    
            $result->execute(); 
            return $result; 
        } 

        public function EliminarRol($id){
            try{
                $conexion = Database::getInstance(); 
                $result = $conexion->db->prepare("DELETE FROM roles WHERE id=?");
                $result->execute(array($id));

                return "1";
            }catch (PDOException $e) {
                return "0";
            }
        }

        public function CrearRol($nombre) { 

            try {
                $conexion = Database::getInstance(); 
                $result = $conexion->db->prepare("INSERT INTO roles (nombre) VALUES (:nombre)");
                $result->execute(
                                    array(
                                        ':nombre'=>$nombre
                                    )
                                );
                return "2";
            } catch(PDOException $e) {
                return "0";
            }
        } 

        public function editRol($id) { 
            $conexion = Database::getInstance(); 
            $sql="SELECT id,nombre from roles where id=:id"; 
            $result = $conexion->db->prepare($sql);     
            $params = array("id" => $id); 
            $result->execute($params);
            return $result; 
        } 

        public function updateRol($nombre,$id) { 

            try {
                $conexion = Database::getInstance(); 
                $result = $conexion->db->prepare("UPDATE roles set nombre=:nombre where id=:id ");
                $result->execute(
                                    array(
                                        ':nombre'=>$nombre,
                                        ':id'=>$id
                                    )
                                );
                return "3";
            } catch(PDOException $e) {
                return "0";
            }
        } 

        public function DatosUsuarios() { 
            $conexion = Database::getInstance(); 
            $sql  ="SELECT users.id,users.nombres,users.apellidos,users.username,users.password,users.role,roles.nombre as role from users "; 
            $sql .="LEFT JOIN roles on (users.role=roles.id) ";
            $result = $conexion->db->prepare($sql);    
            $result->execute(); 
            return $result; 
        } 

        public function editUsuario($id) { 
            $conexion = Database::getInstance(); 
            $sql="SELECT id,nombres,apellidos,username,password,role,identificacion from users where id=:id"; 
            $result = $conexion->db->prepare($sql);     
            $params = array("id" => $id); 
            $result->execute($params);
            return $result; 
        } 

        public function updateUsuario($id,$nombres,$apellidos,$username,$role,$password,$identificacion) { 

            try {
                $conexion = Database::getInstance(); 
                $result = $conexion->db->prepare("UPDATE users set nombres=:nombres,apellidos=:apellidos,username=:username,role=:role,password=:password,identificacion=:identificacion where id=:id ");
                $result->execute(
                                    array(
                                        ':nombres'=>$nombres,
                                        ':apellidos'=>$apellidos,
                                        ':username'=>$username,
                                        ':role'=>$role,
                                        ':password'=>$password,
                                        ':identificacion'=>$identificacion,
                                        ':id'=>$id
                                    )
                                );
                return "3";
            } catch(PDOException $e) {
                return "0";
            }
        } 


        public function EliminarUsuario($id){
            try{
                $conexion = Database::getInstance(); 
                $result = $conexion->db->prepare("DELETE FROM users WHERE id=?");
                $result->execute(array($id));

                return "1";
            }catch (PDOException $e) {
                return "0";
            }
        }

        public function DatosSedes() { 
            $conexion = Database::getInstance(); 
            $sql="SELECT id,nombre from sedes"; 
            $result = $conexion->db->prepare($sql);    
            $result->execute(); 
            return $result; 
        } 

        public function EliminarSede($id){
            try{
                $conexion = Database::getInstance(); 
                $result = $conexion->db->prepare("DELETE FROM sedes WHERE id=?");
                $result->execute(array($id));

                return "1";
            }catch (PDOException $e) {
                return "0";
            }
        }

        public function CrearSede($nombre) { 

            try {
                $conexion = Database::getInstance(); 
                $result = $conexion->db->prepare("INSERT INTO sedes (nombre) VALUES (:nombre)");
                $result->execute(
                                    array(
                                        ':nombre'=>$nombre
                                    )
                                );
                return "2";
            } catch(PDOException $e) {
                return "0";
            }
        } 

        public function editSede($id) { 
            $conexion = Database::getInstance(); 
            $sql="SELECT id,nombre from sedes where id=:id"; 
            $result = $conexion->db->prepare($sql);     
            $params = array("id" => $id); 
            $result->execute($params);
            return $result; 
        } 

        public function updateSede($nombre,$id) { 

            try {
                $conexion = Database::getInstance(); 
                $result = $conexion->db->prepare("UPDATE sedes set nombre=:nombre where id=:id ");
                $result->execute(
                                    array(
                                        ':nombre'=>$nombre,
                                        ':id'=>$id
                                    )
                                );
                return "3";
            } catch(PDOException $e) {
                return "0";
            }
        } 

        public function DatosPaises() { 
            $conexion = Database::getInstance(); 
            $sql="SELECT id,nombre from paises"; 
            $result = $conexion->db->prepare($sql);    
            $result->execute(); 
            return $result; 
        } 

        public function EliminarPais($id){
            try{
                $conexion = Database::getInstance(); 
                $result = $conexion->db->prepare("DELETE FROM paises WHERE id=?");
                $result->execute(array($id));

                return "1";
            }catch (PDOException $e) {
                return "0";
            }
        }

        public function CrearPais($nombre) { 

            try {
                $conexion = Database::getInstance(); 
                $result = $conexion->db->prepare("INSERT INTO paises (nombre) VALUES (:nombre)");
                $result->execute(
                                    array(
                                        ':nombre'=>$nombre
                                    )
                                );
                return "2";
            } catch(PDOException $e) {
                return "0";
            }
        } 

        public function editPais($id) { 
            $conexion = Database::getInstance(); 
            $sql="SELECT id,nombre from paises where id=:id"; 
            $result = $conexion->db->prepare($sql);     
            $params = array("id" => $id); 
            $result->execute($params);
            return $result; 
        } 

        public function updatePais($nombre,$id) { 

            try {
                $conexion = Database::getInstance(); 
                $result = $conexion->db->prepare("UPDATE paises set nombre=:nombre where id=:id ");
                $result->execute(
                                    array(
                                        ':nombre'=>$nombre,
                                        ':id'=>$id
                                    )
                                );
                return "3";
            } catch(PDOException $e) {
                return "0";
            }
        }

        public function DatosCiudades() { 
            $conexion = Database::getInstance(); 
            $sql   ="SELECT c.id,c.nombre,p.nombre as pais from ciudades c "; 
            $sql  .="LEFT JOIN paises p on (c.pais=p.id) ";
            $result = $conexion->db->prepare($sql);    
            $result->execute(); 
            return $result; 
        } 

        public function DatosCiudadesPais($pais) { 
            $conexion = Database::getInstance(); 
            $sql="SELECT id,nombre,pais from ciudades where pais=:pais"; 
            $result = $conexion->db->prepare($sql);     
            $params = array("pais" => $pais); 
            $result->execute($params);
            return $result;
        } 

        public function EliminarCiudad($id){
            try{
                $conexion = Database::getInstance(); 
                $result = $conexion->db->prepare("DELETE FROM ciudades WHERE id=?");
                $result->execute(array($id));

                return "1";
            }catch (PDOException $e) {
                return "0";
            }
        }

        public function CrearCiudad($nombre,$pais) { 

            try {
                $conexion = Database::getInstance(); 
                $result = $conexion->db->prepare("INSERT INTO ciudades (nombre,pais) VALUES (:nombre,:pais)");
                $result->execute(
                                    array(
                                        ':nombre'=>$nombre,
                                        ':pais'=>$pais
                                    )
                                );
                return "2";
            } catch(PDOException $e) {
                return "0";
            }
        } 

        public function editCiudad($id) { 
            $conexion = Database::getInstance(); 
            $sql="SELECT id,nombre,pais from ciudades where id=:id"; 
            $result = $conexion->db->prepare($sql);     
            $params = array("id" => $id); 
            $result->execute($params);
            return $result; 
        } 

        public function updateCiudad($nombre,$pais,$id) { 

            try {
                $conexion = Database::getInstance(); 
                $result = $conexion->db->prepare("UPDATE ciudades set nombre=:nombre, pais=:pais where id=:id ");
                $result->execute(
                                    array(
                                        ':nombre'=>$nombre,
                                        ':pais'=>$pais,
                                        ':id'=>$id
                                    )
                                );
                return "3";
            } catch(PDOException $e) {
                return "0";
            }
        }

        public function DatosProveedores() { 
            $conexion = Database::getInstance(); 
            $sql   ="SELECT p.id,CONCAT(p.nombres, ' ',p.apellidos) as nombre,c.nombre as ciudad from proveedores p "; 
            $sql  .="LEFT JOIN ciudades c on (p.ciudad=c.id) ";
            $result = $conexion->db->prepare($sql);    
            $result->execute(); 
            return $result; 
        } 

        public function EliminarProveedor($id){
            try{
                $conexion = Database::getInstance(); 
                $result = $conexion->db->prepare("DELETE FROM proveedores WHERE id=?");
                $result->execute(array($id));

                return "1";
            }catch (PDOException $e) {
                return "0";
            }
        }

        public function CrearProveedor($email,$nombres,$apellidos,$identificacion,$ciudad) { 

            try {
                $conexion = Database::getInstance(); 
                $result = $conexion->db->prepare("INSERT INTO proveedores (email,nombres,apellidos,identificacion,ciudad) VALUES (:email,:nombres,:apellidos,:identificacion,:ciudad)");
                $result->execute(
                                    array(
                                        ':email' => $email,
                                        ':nombres' => $nombres,
                                        ':apellidos' => $apellidos,
                                        ':identificacion' => $identificacion,
                                        ':ciudad' => $ciudad
                                    )
                                );
                return "2";
            } catch(PDOException $e) {
                return "0";
            }
        } 



        public function editProveedor($id) { 
            $conexion = Database::getInstance(); 
            $sql="SELECT id,nombres,apellidos,email,ciudad,identificacion from proveedores where id=:id"; 
            $result = $conexion->db->prepare($sql);     
            $params = array("id" => $id); 
            $result->execute($params);
            return $result; 
        } 


        public function updateProveedor($id,$nombres,$apellidos,$email,$ciudad,$identificacion) { 

            try {
                $conexion = Database::getInstance(); 
                $result = $conexion->db->prepare("UPDATE proveedores set nombres=:nombres,apellidos=:apellidos,email=:email,ciudad=:ciudad,identificacion=:identificacion where id=:id ");
                $result->execute(
                                    array(
                                        ':nombres'=>$nombres,
                                        ':apellidos'=>$apellidos,
                                        ':email'=>$email,
                                        ':ciudad'=>$ciudad,
                                        ':identificacion'=>$identificacion,
                                        ':id'=>$id
                                    )
                                );
                return "3";
            } catch(PDOException $e) {
                return "0";
            }
        } 

        public function DatosTipos() { 
            $conexion = Database::getInstance(); 
            $sql="SELECT id,nombre from tipos"; 
            $result = $conexion->db->prepare($sql);    
            $result->execute(); 
            return $result; 
        } 

        public function DatosEmpleados() { 
            $conexion = Database::getInstance(); 
            $sql   ="SELECT e.id,CONCAT(e.nombres, ' ',e.apellidos) as nombre,c.nombre as ciudad,s.nombre as sede, t.nombre as tipo,salario from empleados e "; 
            $sql  .="LEFT JOIN sedes s on (e.sede=s.id) ";
            $sql  .="LEFT JOIN ciudades c on (e.ciudad=c.id) ";
            $sql  .="LEFT JOIN tipos t on (e.tipo=t.id) ";
            $result = $conexion->db->prepare($sql);    
            $result->execute(); 
            return $result; 
        } 

        public function EliminarEmpleado($id){
            try{
                $conexion = Database::getInstance(); 
                $result = $conexion->db->prepare("DELETE FROM empleados WHERE id=?");
                $result->execute(array($id));

                return "1";
            }catch (PDOException $e) {
                return "0";
            }
        }

        public function CrearEmpleado($identificacion,$nombres,$apellidos,$tipo,$email,$sede,$ciudad,$salario) { 

            try {
                $conexion = Database::getInstance(); 
                $result = $conexion->db->prepare("INSERT INTO empleados (email,nombres,apellidos,identificacion,ciudad,tipo,sede,salario) VALUES (:email,:nombres,:apellidos,:identificacion,:ciudad,:tipo,:sede,:salario)");
                $result->execute(
                                    array(
                                        ':email' => $email,
                                        ':nombres' => $nombres,
                                        ':apellidos' => $apellidos,
                                        ':identificacion' => $identificacion,
                                        ':ciudad' => $ciudad,
                                        ':tipo' => $tipo,
                                        ':sede' => $sede,
                                        ':salario' => $salario
                                    )
                                );
                return "2";
            } catch(PDOException $e) {
                return "0";
            }
        } 

        public function editEmpleados($id) { 
            $conexion = Database::getInstance(); 
            $sql="SELECT id,nombres,apellidos,email,ciudad,identificacion,tipo,sede,salario from empleados where id=:id"; 
            $result = $conexion->db->prepare($sql);     
            $params = array("id" => $id); 
            $result->execute($params);
            return $result; 
        } 

        public function updateEmpleado($id,$nombres,$apellidos,$email,$ciudad,$identificacion,$tipo,$sede,$salario) { 

            try {
                $conexion = Database::getInstance(); 
                $result = $conexion->db->prepare("UPDATE empleados set nombres=:nombres,apellidos=:apellidos,email=:email,ciudad=:ciudad,identificacion=:identificacion,tipo=:tipo,sede=:sede,salario=:salario where id=:id ");
                $result->execute(
                                    array(
                                        ':nombres'=>$nombres,
                                        ':apellidos'=>$apellidos,
                                        ':email'=>$email,
                                        ':ciudad'=>$ciudad,
                                        ':identificacion'=>$identificacion,
                                        ':tipo'=>$tipo,
                                        ':sede'=>$sede,
                                        ':salario'=>$salario,
                                        ':id'=>$id
                                    )
                                );
                return "3";
            } catch(PDOException $e) {
                return "0";
            }
        } 


        public function editarPerfil($username) { 
            $conexion = Database::getInstance(); 
            $sql="SELECT id,nombres,apellidos,username,password,role,identificacion from users where username=:username"; 
            $result = $conexion->db->prepare($sql);     
            $params = array("username" => $username); 
            $result->execute($params);
            return $result; 
        } 


        public function DatosClientes() { 
            $conexion = Database::getInstance(); 
            $sql   ="SELECT e.id,CONCAT(e.nombres, ' ',e.apellidos) as nombre,c.nombre as ciudad,direccion,telefono from clientes e "; 
            $sql  .="LEFT JOIN ciudades c on (e.ciudad=c.id) ";
            $result = $conexion->db->prepare($sql);    
            $result->execute(); 
            return $result; 
        } 

        public function EliminarCliente($id){
            try{
                $conexion = Database::getInstance(); 
                $result = $conexion->db->prepare("DELETE FROM clientes WHERE id=?");
                $result->execute(array($id));

                return "1";
            }catch (PDOException $e) {
                return "0";
            }
        }

        public function CrearCliente($identificacion,$nombres,$apellidos,$email,$telefono,$direccion,$ciudad) { 

            try {
                $conexion = Database::getInstance(); 
                $result = $conexion->db->prepare("INSERT INTO clientes (email,nombres,apellidos,identificacion,ciudad,telefono,direccion) VALUES (:email,:nombres,:apellidos,:identificacion,:ciudad,:telefono,:direccion)");
                $result->execute(
                                    array(
                                        ':email' => $email,
                                        ':nombres' => $nombres,
                                        ':apellidos' => $apellidos,
                                        ':identificacion' => $identificacion,
                                        ':ciudad' => $ciudad,
                                        ':telefono' => $telefono,
                                        ':direccion' => $direccion
                                    )
                                );
                return "2";
            } catch(PDOException $e) {
                return "0";
            }
        } 

        public function editCliente($id) { 
            $conexion = Database::getInstance(); 
            $sql="SELECT id,nombres,apellidos,email,ciudad,identificacion,telefono,direccion from clientes where id=:id"; 
            $result = $conexion->db->prepare($sql);     
            $params = array("id" => $id); 
            $result->execute($params);
            return $result; 
        } 


        public function updateCliente($id,$nombres,$apellidos,$email,$ciudad,$identificacion,$telefono,$direccion) { 

            try {
                $conexion = Database::getInstance(); 
                $result = $conexion->db->prepare("UPDATE clientes set nombres=:nombres,apellidos=:apellidos,email=:email,ciudad=:ciudad,identificacion=:identificacion,telefono=:telefono,direccion=:direccion where id=:id ");
                $result->execute(
                                    array(
                                        ':nombres'=>$nombres,
                                        ':apellidos'=>$apellidos,
                                        ':email'=>$email,
                                        ':ciudad'=>$ciudad,
                                        ':identificacion'=>$identificacion,
                                        ':telefono'=>$telefono,
                                        ':direccion'=>$direccion,
                                        ':id'=>$id
                                    )
                                );
                return "3";
            } catch(PDOException $e) {
                return "0";
            }
        }

        public function DatosProductos() { 
            $conexion = Database::getInstance(); 
            $sql   ="SELECT id,codigo,codbarra,nombres,descripcion,costo from productos"; 
            $result = $conexion->db->prepare($sql);    
            $result->execute(); 
            return $result; 
        } 

        public function EliminarProducto($id){
            try{
                $conexion = Database::getInstance(); 
                $result = $conexion->db->prepare("DELETE FROM productos WHERE id=?");
                $result->execute(array($id));

                return "1";
            }catch (PDOException $e) {
                return "0";
            }
        }

        public function CrearProducto($codigo,$codbarra,$nombres,$descripcion,$costo) { 

            try {
                $conexion = Database::getInstance(); 
                $result = $conexion->db->prepare("INSERT INTO productos (codigo,codbarra,nombres,descripcion,costo) VALUES (:codigo,:codbarra,:nombres,:descripcion,:costo)");
                $result->execute(
                                    array(
                                        ':codigo' => $codigo,
                                        ':codbarra' => $codbarra,
                                        ':nombres' => $nombres,
                                        ':descripcion' => $descripcion,
                                        ':costo' => $costo
                                    )
                                );
                return "2";
            } catch(PDOException $e) {
                return "0";
            }
        } 

        public function editProducto($id) { 
            $conexion = Database::getInstance(); 
            $sql="SELECT id,codigo,codbarra,nombres,descripcion,costo from productos where id=:id"; 
            $result = $conexion->db->prepare($sql);     
            $params = array("id" => $id); 
            $result->execute($params);
            return $result; 
        } 


        public function updateProducto($id,$codigo,$codbarra,$nombres,$descripcion,$costo) { 

            try {
                $conexion = Database::getInstance(); 
                $result = $conexion->db->prepare("UPDATE productos set codigo=:codigo,codbarra=:codbarra,nombres=:nombres,descripcion=:descripcion,costo=:costo where id=:id ");
                $result->execute(
                                    array(
                                        ':codigo'=>$codigo,
                                        ':codbarra'=>$codbarra,
                                        ':nombres'=>$nombres,
                                        ':descripcion'=>$descripcion,
                                        ':costo'=>$costo,
                                        ':id'=>$id
                                    )
                                );
                return "3";
            } catch(PDOException $e) {
                return "0";
            }
        }


        public function DatosMateriasPrimas() { 
            $conexion = Database::getInstance(); 
            $sql   ="SELECT id,codigo,codbarra,nombres,descripcion,costo from materiaprima"; 
            $result = $conexion->db->prepare($sql);    
            $result->execute(); 
            return $result; 
        } 

        public function EliminarMateriaPrima($id){
            try{
                $conexion = Database::getInstance(); 
                $result = $conexion->db->prepare("DELETE FROM materiaprima WHERE id=?");
                $result->execute(array($id));

                return "1";
            }catch (PDOException $e) {
                return "0";
            }
        }

        public function CrearMateriaPrima($codigo,$codbarra,$nombres,$descripcion,$costo) { 

            try {
                $conexion = Database::getInstance(); 
                $result = $conexion->db->prepare("INSERT INTO materiaprima (codigo,codbarra,nombres,descripcion,costo) VALUES (:codigo,:codbarra,:nombres,:descripcion,:costo)");
                $result->execute(
                                    array(
                                        ':codigo' => $codigo,
                                        ':codbarra' => $codbarra,
                                        ':nombres' => $nombres,
                                        ':descripcion' => $descripcion,
                                        ':costo' => $costo
                                    )
                                );
                return "2";
            } catch(PDOException $e) {
                return "0";
            }
        } 

        public function editMateriaPrima($id) { 
            $conexion = Database::getInstance(); 
            $sql="SELECT id,codigo,codbarra,nombres,descripcion,costo from materiaprima where id=:id"; 
            $result = $conexion->db->prepare($sql);     
            $params = array("id" => $id); 
            $result->execute($params);
            return $result; 
        } 


        public function updateMateriaPrima($id,$codigo,$codbarra,$nombres,$descripcion,$costo) { 

            try {
                $conexion = Database::getInstance(); 
                $result = $conexion->db->prepare("UPDATE materiaprima set codigo=:codigo,codbarra=:codbarra,nombres=:nombres,descripcion=:descripcion,costo=:costo where id=:id ");
                $result->execute(
                                    array(
                                        ':codigo'=>$codigo,
                                        ':codbarra'=>$codbarra,
                                        ':nombres'=>$nombres,
                                        ':descripcion'=>$descripcion,
                                        ':costo'=>$costo,
                                        ':id'=>$id
                                    )
                                );
                return "3";
            } catch(PDOException $e) {
                return "0";
            }
        }


        public function ConsultarInventarioProducto($codbarra) { 
            $conexion = Database::getInstance(); 
            $sql="SELECT id,codigo,codbarra,stock from inventariosproductos where codbarra=:codbarra"; 
            $result = $conexion->db->prepare($sql);     
            $params = array("codbarra" => $codbarra); 
            $result->execute($params);
            return $result; 
        } 

        public function EliminarInventarioProducto() { 
            try{
                $conexion = Database::getInstance(); 
                $result = $conexion->db->prepare("DELETE FROM inventariosproductos");
                $result->execute();

                return "1";
            }catch (PDOException $e) {
                return "0";
            }
        } 

        public function CrearInventarioProducto($codigo,$codbarra,$stock) { 

            try {
                $conexion = Database::getInstance(); 
                $result = $conexion->db->prepare("INSERT INTO inventariosproductos (codigo,codbarra,stock) VALUES (:codigo,:codbarra,:stock)");
                $result->execute(
                                    array(
                                        ':codigo'=>$codigo,
                                        ':codbarra'=>$codbarra,
                                        ':stock'=>$stock
                                    )
                                );
                return "3";
            } catch(PDOException $e) {
                return "0";
            }
        }


        public function ConsultarInventarioMateria($codbarra) { 
            $conexion = Database::getInstance(); 
            $sql="SELECT id,codigo,codbarra,stock from inventariosmaterias where codbarra=:codbarra"; 
            $result = $conexion->db->prepare($sql);     
            $params = array("codbarra" => $codbarra); 
            $result->execute($params);
            return $result; 
        } 

        public function EliminarInventarioMateria() { 
            try{
                $conexion = Database::getInstance(); 
                $result = $conexion->db->prepare("DELETE FROM inventariosmaterias");
                $result->execute();

                return "1";
            }catch (PDOException $e) {
                return "0";
            }
        } 

        public function CrearInventarioMateria($codigo,$codbarra,$stock) { 

            try {
                $conexion = Database::getInstance(); 
                $result = $conexion->db->prepare("INSERT INTO inventariosmaterias (codigo,codbarra,stock) VALUES (:codigo,:codbarra,:stock)");
                $result->execute(
                                    array(
                                        ':codigo'=>$codigo,
                                        ':codbarra'=>$codbarra,
                                        ':stock'=>$stock
                                    )
                                );
                return "3";
            } catch(PDOException $e) {
                return "0";
            }
        }

        public function ConsecutivoOrden() { 
            $conexion = Database::getInstance(); 
            $sql   ="SELECT CASE WHEN id is null then 1 else max(id)+1 end as id from orden"; 
            $result = $conexion->db->prepare($sql);    
            $result->execute(); 
            return $result; 
        } 

        public function CrearOrden($id,$users_id,$total_price,$created,$modified,$status) { 

            try {
                $conexion = Database::getInstance(); 
                $result = $conexion->db->prepare("INSERT INTO orden (id,users_id,total_price,created,modified,status) VALUES (:id,:users_id,:total_price,:created,:modified,:status)");
                $result->execute(
                                    array(
                                        ':id'=>$id,
                                        ':users_id'=>$users_id,
                                        ':total_price'=>$total_price,
                                        ':created'=>$created,
                                        ':modified'=>$modified,
                                        ':status'=>$status
                                    )
                                );
                return "1";
            } catch(PDOException $e) {
                return "";
            }
        }


        public function CrearDetOrden($order_id,$product_id,$quantity) { 

            try {
                $conexion = Database::getInstance(); 
                $result = $conexion->db->prepare("INSERT INTO orden_compra (order_id,product_id,quantity) VALUES (:order_id,:product_id,:quantity)");
                $result->execute(
                                    array(
                                        ':order_id'=>$order_id,
                                        ':product_id'=>$product_id,
                                        ':quantity'=>$quantity
                                    )
                                );
                return "1";
            } catch(PDOException $e) {
                return "";
            }
        }

        public function ListadoOrden() { 
            $conexion = Database::getInstance(); 
            $sql   ="SELECT o.id,u.nombres,u.apellidos,total_price,created,modified from orden o"; 
            $sql   .=" LEFT JOIN users u on (o.users_id=u.id)";
            $result = $conexion->db->prepare($sql);    
            $result->execute(); 
            return $result; 
        } 

        public function ListadoDetOrden($order_id) { 
            $conexion = Database::getInstance(); 
            $sql  ="SELECT order_id,p.nombres,quantity,p.costo from orden_compra o ";
            $sql .=" LEFT JOIN materiaprima p on (o.product_id=p.id) ";
            $sql .=" where order_id=:order_id"; 
            $result = $conexion->db->prepare($sql);     
            $params = array("order_id" => $order_id); 
            $result->execute($params);
            return $result;
        } 

        public function DatosProgramaciones() { 
            $conexion = Database::getInstance(); 
            $sql   ="SELECT p.id,fecha_inicio,fecha_fin,pr.nombres,cantidad from programacion p "; 
            $sql  .=" LEFT JOIN productos pr on (p.producto_id=pr.id) "; 
            $result = $conexion->db->prepare($sql);    
            $result->execute(); 
            return $result; 
        } 

        public function EliminarProgramacion($id){
            try{
                $conexion = Database::getInstance(); 
                $result = $conexion->db->prepare("DELETE FROM programacion WHERE id=?");
                $result->execute(array($id));

                return "1";
            }catch (PDOException $e) {
                return "0";
            }
        }

        public function CrearProgramacion($fecha_inicio,$fecha_fin,$producto_id,$cantidad) { 

            try {
                $conexion = Database::getInstance(); 
                $result = $conexion->db->prepare("INSERT INTO programacion (fecha_inicio,fecha_fin,producto_id,cantidad) VALUES (:fecha_inicio,:fecha_fin,:producto_id,:cantidad)");
                $result->execute(
                                    array(
                                        ':fecha_inicio' => $fecha_inicio,
                                        ':fecha_fin' => $fecha_fin,
                                        ':producto_id' => $producto_id,
                                        ':cantidad' => $cantidad
                                    )
                                );
                return "2";
            } catch(PDOException $e) {
                return "0";
            }
        } 

        public function editProgramacion($id) { 
            $conexion = Database::getInstance(); 
            $sql="SELECT id,fecha_inicio,fecha_fin,producto_id,cantidad from programacion where id=:id"; 
            $result = $conexion->db->prepare($sql);     
            $params = array("id" => $id); 
            $result->execute($params);
            return $result; 
        } 


        public function updateProgramacion($id,$fecha_inicio,$fecha_fin,$producto_id,$cantidad) { 

            try {
                $conexion = Database::getInstance(); 
                $result = $conexion->db->prepare("UPDATE programacion set fecha_inicio=:fecha_inicio,fecha_fin=:fecha_fin,producto_id=:producto_id,cantidad=:cantidad where id=:id ");
                $result->execute(
                                    array(
                                        ':fecha_inicio'=>$fecha_inicio,
                                        ':fecha_fin'=>$fecha_fin,
                                        ':producto_id'=>$producto_id,
                                        ':cantidad'=>$cantidad,
                                        ':id'=>$id
                                    )
                                );
                return "3";
            } catch(PDOException $e) {
                return "0";
            }
        }

        public function updateInvCompra($codbarra,$cantidad) { 

            try {
                $conexion = Database::getInstance(); 
                $result = $conexion->db->prepare("UPDATE inventariosmaterias set stock = stock+:cantidad where codbarra=:codbarra ");
                $result->execute(
                                    array(
                                        ':cantidad'=>$cantidad,
                                        ':codbarra'=>$codbarra
                                    )
                                );
                return "3";
            } catch(PDOException $e) {
                return "0";
            }
        }


        public function ConsecutivoVenta() { 
            $conexion = Database::getInstance(); 
            $sql   ="SELECT CASE WHEN id is null then 1 else max(id)+1 end as id from venta"; 
            $result = $conexion->db->prepare($sql);    
            $result->execute(); 
            return $result; 
        } 

        public function CrearVenta($id,$users_id,$cliente_id,$total_price,$created,$modified,$status) { 

            try {
                $conexion = Database::getInstance(); 
                $result = $conexion->db->prepare("INSERT INTO venta (id,users_id,cliente_id,total_price,created,modified,status) VALUES (:id,:users_id,:cliente_id,:total_price,:created,:modified,:status)");
                $result->execute(
                                    array(
                                        ':id'=>$id,
                                        ':users_id'=>$users_id,
                                        ':cliente_id'=>$cliente_id,
                                        ':total_price'=>$total_price,
                                        ':created'=>$created,
                                        ':modified'=>$modified,
                                        ':status'=>$status
                                    )
                                );
                return "1";
            } catch(PDOException $e) {
                return "";
            }
        }


        public function CrearDetVenta($order_id,$product_id,$quantity) { 

            try {
                $conexion = Database::getInstance(); 
                $result = $conexion->db->prepare("INSERT INTO venta_detalle (order_id,product_id,quantity) VALUES (:order_id,:product_id,:quantity)");
                $result->execute(
                                    array(
                                        ':order_id'=>$order_id,
                                        ':product_id'=>$product_id,
                                        ':quantity'=>$quantity
                                    )
                                );
                return "1";
            } catch(PDOException $e) {
                return "";
            }
        }

        public function updateInvVenta($codbarra,$cantidad) { 

            try {
                $conexion = Database::getInstance(); 
                $result = $conexion->db->prepare("UPDATE inventariosproductos set stock = stock-:cantidad where codbarra=:codbarra ");
                $result->execute(
                                    array(
                                        ':cantidad'=>$cantidad,
                                        ':codbarra'=>$codbarra
                                    )
                                );
                return "3";
            } catch(PDOException $e) {
                return "0";
            }
        }

        public function ListadoVenta() { 
            $conexion = Database::getInstance(); 
            $sql   ="SELECT o.id,u.nombres as usuario,u.apellidos as usuape,c.nombres,c.apellidos,u.apellidos,total_price,created,modified from venta o "; 
            $sql   .=" LEFT JOIN users u on (o.users_id=u.id)";
            $sql   .=" LEFT JOIN clientes c on (o.cliente_id=c.id)";
            $result = $conexion->db->prepare($sql);    
            $result->execute(); 
            return $result; 
        } 

        public function ListadoDetVenta($order_id) { 
            $conexion = Database::getInstance(); 
            $sql  ="SELECT order_id,p.nombres,quantity,p.costo from venta_detalle o ";
            $sql .=" LEFT JOIN productos p on (o.product_id=p.id) ";
            $sql .=" where order_id=:order_id"; 
            $result = $conexion->db->prepare($sql);     
            $params = array("order_id" => $order_id); 
            $result->execute($params);
            return $result;
        } 

        public function PagarNomina($empleado,$mes,$comision,$salario,$total) { 

            try {
                $conexion = Database::getInstance(); 
                $result = $conexion->db->prepare("INSERT INTO nomina (empleado,mes,comision,salario,total) VALUES (:empleado,:mes,:comision,:salario,:total)");
                $result->execute(
                                    array(
                                        ':empleado' => $empleado,
                                        ':mes' => $mes,
                                        ':comision' => $comision,
                                        ':salario' => $salario,
                                        ':total' => $total
                                    )
                                );
                return "2";
            } catch(PDOException $e) {
                return "0";
            }
        } 

        public function Nomina() { 
            $conexion = Database::getInstance(); 
            $sql   ="SELECT n.id,e.nombres,e.apellidos,comision,n.salario,total,CASE mes ";
            $sql  .="WHEN '1'        THEN 'ENERO' WHEN '2'        THEN 'FEBRERO' ";
            $sql  .="WHEN '3'        THEN 'MARZO' WHEN '4'        THEN 'ABRIL'  ";
            $sql  .="WHEN '5'        THEN 'MAYO'  WHEN '6'        THEN 'JUNIO'  ";
            $sql  .="WHEN '7'        THEN 'JULIO' WHEN '8'        THEN 'AGOSTO' ";
            $sql  .="WHEN '9'        THEN 'SEPTIEMBRE' WHEN '10'        THEN 'OCTUBRE' ";
            $sql  .="WHEN '11'        THEN 'NOVIEMBRE' ";
            $sql  .="ELSE 'DICIEMBRE' ";
            $sql  .="END as mes  from nomina n "; 
            $sql  .=" LEFT JOIN empleados e on (n.empleado=e.id)";
            $result = $conexion->db->prepare($sql);    
            $result->execute(); 
            return $result; 
        } 

        public function EliminarNomina($id){
            try{
                $conexion = Database::getInstance(); 
                $result = $conexion->db->prepare("DELETE FROM nomina WHERE id=?");
                $result->execute(array($id));

                return "1";
            }catch (PDOException $e) {
                return "0";
            }
        }






    }

    


?>