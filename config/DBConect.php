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
            $sql   ="SELECT e.id,CONCAT(e.nombres, ' ',e.apellidos) as nombre,c.nombre as ciudad,s.nombre as sede, t.nombre as tipo from empleados e "; 
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

        public function CrearEmpleado($identificacion,$nombres,$apellidos,$tipo,$email,$sede,$ciudad) { 

            try {
                $conexion = Database::getInstance(); 
                $result = $conexion->db->prepare("INSERT INTO empleados (email,nombres,apellidos,identificacion,ciudad,tipo,sede) VALUES (:email,:nombres,:apellidos,:identificacion,:ciudad,:tipo,:sede)");
                $result->execute(
                                    array(
                                        ':email' => $email,
                                        ':nombres' => $nombres,
                                        ':apellidos' => $apellidos,
                                        ':identificacion' => $identificacion,
                                        ':ciudad' => $ciudad,
                                        ':tipo' => $tipo,
                                        ':sede' => $sede
                                    )
                                );
                return "2";
            } catch(PDOException $e) {
                return "0";
            }
        } 

        public function editEmpleados($id) { 
            $conexion = Database::getInstance(); 
            $sql="SELECT id,nombres,apellidos,email,ciudad,identificacion,tipo,sede from empleados where id=:id"; 
            $result = $conexion->db->prepare($sql);     
            $params = array("id" => $id); 
            $result->execute($params);
            return $result; 
        } 

        public function updateEmpleado($id,$nombres,$apellidos,$email,$ciudad,$identificacion,$tipo,$sede) { 

            try {
                $conexion = Database::getInstance(); 
                $result = $conexion->db->prepare("UPDATE empleados set nombres=:nombres,apellidos=:apellidos,email=:email,ciudad=:ciudad,identificacion=:identificacion,tipo=:tipo,sede=:sede where id=:id ");
                $result->execute(
                                    array(
                                        ':nombres'=>$nombres,
                                        ':apellidos'=>$apellidos,
                                        ':email'=>$email,
                                        ':ciudad'=>$ciudad,
                                        ':identificacion'=>$identificacion,
                                        ':tipo'=>$tipo,
                                        ':sede'=>$sede,
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


    }

    


?>