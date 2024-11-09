<?php
    require_once "beans/UsuariosBean.php";//llamamos los recursos beans, para acceder a sus clases.
    class UsuModel extends Model{
        public $conexion;
        function __construct(){
            parent::__construct();//accedemos al constructor de Model, para poder usar la bdd
        }

        function listaUsuario(){
            $query = "SELECT * FROM usuarios WHERE estado = :estado AND rol <> 'superAdmin' AND rol <> 'User'";
            $this->conexion = $this->con->conectar();//accedemos a la funcion conectar, y por ende su return, el cual recordara es la bdd
            $resultado = $this->conexion->prepare($query); //preparamos la consulta
            $resultado->bindValue(':estado', "Activo");
            $resultado->execute();//ejecutamos la consulta
            $array =array();
            while ($row = $resultado->fetch()) {//obtenemos los resultados de la consulta, aqui se convertiran en arreglos nativos de php que podemos recorrer y usar
                $usu = new UsuariosBean();//instaciamos un nuevo producto
                $usu->setCodigo($row['codigo']);//setiamos los valores de producto
                $usu->setNombre1($row['nombre1']);
                $usu->setNombre2($row['nombre2']);
                $usu->setApellido1($row['apellido1']);
                $usu->setApellido2($row['apellido2']);
                $usu->setCorreo($row['correo']);
                $usu->setRol($row['rol']);
                $usu->setEstado($row['estado']);
                $array[]= $usu;//cargamos el arreglo
            }
            $this->con->desconectar($this->conexion);//cerramos la conexion
            return $array;//retornamos el arreglo
        }

        function agregarUsuario($codigo, $contraseña, $nombre1, $nombre2, $apellido1, $apellido2, $correo, $rol){
            $query = "INSERT INTO usuarios (codigo, contraseña, nombre1, nombre2, apellido1, apellido2, correo, rol, estado) VALUES(:codigo, :contra, :nombre1, :nombre2, :apellido1, :apellido2, :correo, :rol, :estado)";
            $this->conexion = $this->con->conectar();
            $row = $this->conexion->prepare($query);
            $row->bindParam(':codigo', $codigo); // Enviamos parametros a la consulta, esto evita inyecciones SQL
            $row->bindParam(':contra', $contraseña);
            $row->bindParam(':nombre1', $nombre1);
            $row->bindParam(':nombre2', $nombre2);
            $row->bindParam(':apellido1', $apellido1);
            $row->bindParam(':apellido2', $apellido2);
            $row->bindParam(':correo', $correo);
            $row->bindParam(':rol', $rol);
            $row->bindValue(':estado', "Activo");
            return $row->execute(); // Devolvera un booleano dependiendo si la consulta y conexion fue exitosa
        }

        function agregarUser($codigo, $contra, $nombre, $apellido, $correo, $rol){
            $query = "INSERT INTO usuarios (codigo, contraseña, nombre1, nombre2, apellido1, apellido2, correo, rol, estado) VALUES(:codigo, :contra, :nombre1, :nombre2, :apellido1, :apellido2, :correo, :rol, :estado)";
            $this->conexion = $this->con->conectar();
            $row = $this->conexion->prepare($query);
            
            $row->bindParam(':codigo', $codigo); // Enviamos parametros a la consulta, esto evita inyecciones SQL
            $row->bindParam(':contra', $contra);
            $row->bindParam(':nombre1', $nombre);
            $row->bindValue(':nombre2', "NULL");
            $row->bindParam(':apellido1', $apellido);
            $row->bindValue(':apellido2', "NULL");
            $row->bindParam(':correo', $correo);
            $row->bindParam(':rol', $rol);
            $row->bindValue(':estado', "Activo");
            return $row->execute(); // Devolvera un booleano dependiendo si la consulta y conexion fue exitosa
        }
        

        function modificarUsuario($codigo, $nombre1, $nombre2, $apellido1, $apellido2, $correo, $rol, $id) {
            $query = "UPDATE usuarios SET nombre1=:nombre1, nombre2=:nombre2, apellido1=:apellido1, apellido2=:apellido2, correo=:correo, rol=:rol, estado=:estado WHERE codigo=:codigo";
            $this->conexion = $this->con->conectar();
            $row = $this->conexion->prepare($query);
            $row->bindParam(':codigo', $codigo); // Enviamos parametros a la consulta, esto evita inyecciones SQL
            $row->bindParam(':nombre1', $nombre1);
            $row->bindParam(':nombre2', $nombre2);
            $row->bindParam(':apellido1', $apellido1);
            $row->bindParam(':apellido2', $apellido2);
            $row->bindParam(':correo', $correo);
            $row->bindParam(':rol', $rol);
            $row->bindValue(':estado', "Activo");
            return $row->execute(); // Devolvera un booleano dependiendo si la consulta y conexion fue exitosa
        }
        

        
        function eliminarUsuario($id){
            $query = "UPDATE usuarios SET estado=:estado WHERE codigo = :codigo";
            $this->conexion = $this->con->conectar();
            $row = $this->conexion->prepare($query);
            $row->bindValue(':estado', "Inactivo");//enviamos parametros a la consulta, esto evita inyecciones SQL
            $row->bindParam(':codigo', $id);
            return $row->execute();//devolvera un booleano dependiendo si la consulta y conexion fue exitosa
        }

        function validarCorreo($correo){
            $query = "SELECT COUNT(*) as count FROM usuarios WHERE estado = :estado AND correo = :correo";
            $this->conexion = $this->con->conectar();
            $resultado = $this->conexion->prepare($query);
            $resultado->bindValue(':estado', "Activo");
            $resultado->bindParam(':correo', $correo);
            $resultado->execute();
            $row = $resultado->fetch(PDO::FETCH_ASSOC);
            $this->con->desconectar($this->conexion);
            return ($row['count'] > 0); // Devuelve true si el correo está registrado, false si no lo está
        }
        

        function findUser($codigo, $contra){
            $query = "SELECT * FROM usuarios WHERE estado = :estado AND codigo = :codigo AND contraseña = :contra";
            $this->conexion = $this->con->conectar();//accedemos a la funcion conectar, y por ende su return, el cual recordara es la bdd
            $resultado = $this->conexion->prepare($query); //preparamos la consulta
            $resultado->bindValue(':estado', "Activo");
            $resultado->bindParam(':codigo', $codigo);
            $resultado->bindParam(':contra', $contra);
            $resultado->execute();//ejecutamos la consulta
            $usu = new UsuariosBean();//instaciamos un nuevo producto
            while ($row = $resultado->fetch()) {//obtenemos los resultados de la consulta, aqui se convertiran en arreglos nativos de php que podemos recorrer y usar
                
                $usu->setCodigo($row['codigo']);//setiamos los valores de producto
                $usu->setNombre1($row['nombre1']);
                $usu->setNombre2($row['nombre2']);
                $usu->setApellido1($row['apellido1']);
                $usu->setApellido2($row['apellido2']);
                $usu->setCorreo($row['correo']);
                $usu->setRol($row['rol']);
                $usu->setEstado($row['estado']);
            }
            $this->con->desconectar($this->conexion);//cerramos la conexion
            return $usu;//retornamos el arreglo
        }

        function findPass($codigo){
            $query = "SELECT * FROM usuarios WHERE estado = :estado AND codigo = :codigo";
            $this->conexion = $this->con->conectar();//accedemos a la funcion conectar, y por ende su return, el cual recordara es la bdd
            $resultado = $this->conexion->prepare($query); //preparamos la consulta
            $resultado->bindValue(':estado', "Activo");
            $resultado->bindParam(':codigo', $codigo);
            $resultado->execute();//ejecutamos la consulta
            $contra = " ";
            while ($row = $resultado->fetch()) {//obtenemos los resultados de la consulta, aqui se convertiran en arreglos nativos de php que podemos recorrer y usar
                $contra = $row['contraseña'];
            }
            $this->con->desconectar($this->conexion);//cerramos la conexion
            return $contra;//retornamos el arreglo
        }

        function findPassUser($correo){
            $query = "SELECT * FROM usuarios WHERE estado = :estado AND correo = :correo";
            $this->conexion = $this->con->conectar();//accedemos a la funcion conectar, y por ende su return, el cual recordara es la bdd
            $resultado = $this->conexion->prepare($query); //preparamos la consulta
            $resultado->bindValue(':estado', "Activo");
            $resultado->bindParam(':correo', $correo);
            $resultado->execute();//ejecutamos la consulta
            $contra = " ";
            while ($row = $resultado->fetch()) {//obtenemos los resultados de la consulta, aqui se convertiran en arreglos nativos de php que podemos recorrer y usar
                $contra = $row['contraseña'];
            }
            $this->con->desconectar($this->conexion);//cerramos la conexion
            return $contra;//retornamos el arreglo
        }

        function findUserMarket($correo, $contra){
            $query = "SELECT * FROM usuarios WHERE estado = :estado AND correo = :correo AND contraseña = :contra";
            $this->conexion = $this->con->conectar();//accedemos a la funcion conectar, y por ende su return, el cual recordara es la bdd
            $resultado = $this->conexion->prepare($query); //preparamos la consulta
            $resultado->bindValue(':estado', "Activo");
            $resultado->bindParam(':correo', $correo);
            $resultado->bindParam(':contra', $contra);
            $resultado->execute();//ejecutamos la consulta
            $usu = new UsuariosBean();//instaciamos un nuevo producto
            while ($row = $resultado->fetch()) {//obtenemos los resultados de la consulta, aqui se convertiran en arreglos nativos de php que podemos recorrer y usar
                $usu->setCodigo($row['codigo']);//setiamos los valores de producto
                $usu->setNombre1($row['nombre1']);
                $usu->setApellido1($row['apellido1']);
                $usu->setCorreo($row['correo']);
                $usu->setRol($row['rol']);
                $usu->setEstado($row['estado']);
            }
            $this->con->desconectar($this->conexion);//cerramos la conexion
            return $usu;//retornamos el arreglo
        }

    }
?>