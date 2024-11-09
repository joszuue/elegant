<?php
    require_once "beans/CategoriasBean.php";//llamamos los recursos beans, para acceder a sus clases.
    class CateModel extends Model{
        public $conexion;
        function __construct(){
            parent::__construct();//accedemos al constructor de Model, para poder usar la bdd
        }

        function listaCategorias(){
            $query = "SELECT * FROM categorias WHERE estado = :estado";
            $this->conexion = $this->con->conectar();//accedemos a la funcion conectar, y por ende su return, el cual recordara es la bdd
            $resultado = $this->conexion->prepare($query); //preparamos la consulta
            $resultado->bindValue(':estado', "Disponible");
            $resultado->execute();//ejecutamos la consulta
            $array =array();
            while ($row = $resultado->fetch()) {//obtenemos los resultados de la consulta, aqui se convertiran en arreglos nativos de php que podemos recorrer y usar
                $cate = new CategoriasBean();//instaciamos un nuevo producto
                $cate->setIdCategoria($row['idCategoria']);//setiamos los valores de producto
                $cate->setNombre($row['Nombre']);
                $cate->setEstado($row['estado']);
                $array[]= $cate;//cargamos el arreglo
            }
            $this->con->desconectar($this->conexion);//cerramos la conexion
            return $array;//retornamos el arreglo
        }

        function agregarCategoria($nombre){
            $query = "INSERT INTO categorias (Nombre, estado) VALUES(:nombre, :estado)";
            $this->conexion = $this->con->conectar();
            $row = $this->conexion->prepare($query);
            $row->bindParam(':nombre', $nombre);//enviamos parametros a la consulta, esto evita inyecciones SQL
            $row->bindValue(':estado', "Disponible");
            return $row->execute();//devolvera un booleano dependiendo si la consulta y conexion fue exitosa
        }

        function modificarCategoria($nombre, $id){
            $query = "UPDATE categorias SET nombre=:nombre WHERE idCategoria = :id";
            $this->conexion = $this->con->conectar();
            $row = $this->conexion->prepare($query);
            $row->bindParam(':nombre', $nombre);//enviamos parametros a la consulta, esto evita inyecciones SQL
            $row->bindParam(':id', $id);
            return $row->execute();//devolvera un booleano dependiendo si la consulta y conexion fue exitosa
        }

        
        function eliminarCategoria($id){
            $query = "UPDATE categorias SET estado=:estado WHERE idCategoria = :id";
            $this->conexion = $this->con->conectar();
            $row = $this->conexion->prepare($query);
            $row->bindValue(':estado', "Eliminado");//enviamos parametros a la consulta, esto evita inyecciones SQL
            $row->bindParam(':id', $id);
            return $row->execute();//devolvera un booleano dependiendo si la consulta y conexion fue exitosa
        }

    }
?>