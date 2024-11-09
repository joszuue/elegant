<?php
    require_once "beans/ProductosBean.php";//llamamos los recursos beans, para acceder a sus clases.
    require_once "beans/CategoriasBean.php";//llamamos los recursos beans, para acceder a sus clases.
    require_once "beans/OrdenBean.php";//llamamos los recursos beans, para acceder a sus clases.
    class ProducModel extends Model{
        public $conexion;
        function __construct(){
            parent::__construct();//accedemos al constructor de Model, para poder usar la bdd
        }

        function listaProductos(){
            $query = "SELECT * FROM productos p INNER JOIN categorias c ON p.idCategoria = c.idCategoria WHERE p.estado = :estado";
            $this->conexion = $this->con->conectar();//accedemos a la funcion conectar, y por ende su return, el cual recordara es la bdd
            $resultado = $this->conexion->prepare($query); //preparamos la consulta
            $resultado->bindValue(':estado', "Mostrar");
            $resultado->execute();//ejecutamos la consulta
            $array =array();
            while ($row = $resultado->fetch()) {//obtenemos los resultados de la consulta, aqui se convertiran en arreglos nativos de php que podemos recorrer y usar
                $produ = new ProductosBean();//instaciamos un nuevo producto;
                $produ->setIdProducto($row['idProducto']);//setiamos los valores de producto
                $produ->setIdCategoria($row['idCategoria']);
                $produ->setNombreCategoria($row['Nombre']);
                $produ->setNombre($row['nombre']);
                $produ->setDescripcion($row['descripcion']);
                $produ->setPrecio($row['precio']);
                $produ->setImagen($row['imagen']);
                $produ->setSexo($row['sexo']);
                $produ->setEstado($row[7]);
                $array[]= $produ;//cargamos el arreglo
            }
            $this->con->desconectar($this->conexion);//cerramos la conexion
            return $array;//retornamos el arreglo
        }

        function listaProductosOcultos(){
            $query = "SELECT * FROM productos p INNER JOIN categorias c ON p.idCategoria = c.idCategoria WHERE p.estado = :estado";
            $this->conexion = $this->con->conectar();//accedemos a la funcion conectar, y por ende su return, el cual recordara es la bdd
            $resultado = $this->conexion->prepare($query); //preparamos la consulta
            $resultado->bindValue(':estado', "Ocultar");
            $resultado->execute();//ejecutamos la consulta
            $array =array();
            while ($row = $resultado->fetch()) {//obtenemos los resultados de la consulta, aqui se convertiran en arreglos nativos de php que podemos recorrer y usar
                $produ = new ProductosBean();//instaciamos un nuevo producto;
                $produ->setIdProducto($row['idProducto']);//setiamos los valores de producto
                $produ->setIdCategoria($row['idCategoria']);
                $produ->setNombreCategoria($row['Nombre']);
                $produ->setNombre($row['nombre']);
                $produ->setDescripcion($row['descripcion']);
                $produ->setPrecio($row['precio']);
                $produ->setImagen($row['imagen']);
                $produ->setSexo($row['sexo']);
                $produ->setEstado($row[7]);
                $array[]= $produ;//cargamos el arreglo
            }
            $this->con->desconectar($this->conexion);//cerramos la conexion
            return $array;//retornamos el arreglo
        }

        function agregarProductos($nombre,$categoria,$descri,$precio, $imagen, $gender, $estado){
            $query = "INSERT INTO productos (idCategoria, nombre, descripcion,	precio, imagen, sexo, estado) VALUES(:idCate,:nombre,:descri,:precio,:imagen,:sexo,:estado)";
            $this->conexion = $this->con->conectar();
            $row = $this->conexion->prepare($query);
            $row->bindParam(':idCate', $categoria);
            $row->bindParam(':nombre', $nombre);//enviamos parametros a la consulta, esto evita inyecciones SQL
            
            $row->bindParam(':descri', $descri);
            $row->bindParam(':precio', $precio);
            $row->bindParam(':imagen', $imagen);
            $row->bindParam(':sexo', $gender);
            $row->bindParam(':estado', $estado);
            return $row->execute();//devolvera un booleano dependiendo si la consulta y conexion fue exitosa
        }

        function modificarProductos($nombre,$categoria,$descri,$precio, $gender, $estado, $id){
            $query = "UPDATE productos SET idCategoria=:idCate, nombre=:nombre, descripcion=:descri, precio=:precio, sexo=:sexo, estado=:estado WHERE idProducto =:id";
            $this->conexion = $this->con->conectar();
            $row = $this->conexion->prepare($query);
            $row->bindParam(':idCate', $categoria);
            $row->bindParam(':nombre', $nombre);//enviamos parametros a la consulta, esto evita inyecciones SQL
            $row->bindParam(':id', $id);
            $row->bindParam(':descri', $descri);
            $row->bindParam(':precio', $precio);
            $row->bindParam(':sexo', $gender);
            $row->bindValue(':estado', $estado);
            return $row->execute();//devolvera un booleano dependiendo si la consulta y conexion fue exitosa
        }

        
        function eliminarProducto($id){
            $query = "UPDATE productos SET estado=:estado WHERE idProducto = :id";
            $this->conexion = $this->con->conectar();
            $row = $this->conexion->prepare($query);
            $row->bindValue(':estado', "Eliminado");//enviamos parametros a la consulta, esto evita inyecciones SQL
            $row->bindParam(':id', $id);
            return $row->execute();//devolvera un booleano dependiendo si la consulta y conexion fue exitosa
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


        //PRODUCTOS PARA LA TIENDA
        //LISTA DE CATEGORIAS
        function listaCategoriasMenu(){
            $query = "SELECT categorias.idCategoria, categorias.nombre FROM categorias WHERE categorias.estado = :estado AND categorias.idCategoria IN 
            (SELECT DISTINCT idCategoria FROM productos WHERE estado = :esta)";
            $this->conexion = $this->con->conectar();//accedemos a la funcion conectar, y por ende su return, el cual recordara es la bdd
            $resultado = $this->conexion->prepare($query); //preparamos la consulta
            $resultado->bindValue(':estado', "Disponible");
            $resultado->bindValue(':esta', "Mostrar");
            $resultado->execute();//ejecutamos la consulta
            $array =array();
            while ($row = $resultado->fetch()) {//obtenemos los resultados de la consulta, aqui se convertiran en arreglos nativos de php que podemos recorrer y usar
                $cate = new CategoriasBean();//instaciamos un nuevo producto
                $cate->setIdCategoria($row['idCategoria']);//setiamos los valores de producto
                $cate->setNombre($row['nombre']);
                $array[]= $cate;//cargamos el arreglo
            }
            $this->con->desconectar($this->conexion);//cerramos la conexion
            return $array;//retornamos el arreglo
        }

        //SECCIÓN PARA EL INICIO
        function productosRand(){
            $query = "SELECT *FROM productos p INNER JOIN categorias c ON p.idCategoria = c.idCategoria WHERE p.estado = :estado ORDER BY RAND() LIMIT 3;";
            $this->conexion = $this->con->conectar();//accedemos a la funcion conectar, y por ende su return, el cual recordara es la bdd
            $resultado = $this->conexion->prepare($query); //preparamos la consulta
            $resultado->bindValue(':estado', "Mostrar");
            $resultado->execute();//ejecutamos la consulta
            $array =array();
            while ($row = $resultado->fetch()) {//obtenemos los resultados de la consulta, aqui se convertiran en arreglos nativos de php que podemos recorrer y usar
                $produ = new ProductosBean();//instaciamos un nuevo producto;
                $produ->setIdProducto($row['idProducto']);//setiamos los valores de producto
                $produ->setIdCategoria($row['idCategoria']);
                $produ->setNombreCategoria($row['Nombre']);
                $produ->setNombre($row['nombre']);
                $produ->setDescripcion($row['descripcion']);
                $produ->setPrecio($row['precio']);
                $produ->setImagen($row['imagen']);
                $produ->setSexo($row['sexo']);
                $produ->setEstado($row[7]);
                $array[]= $produ;//cargamos el arreglo
            }
            $this->con->desconectar($this->conexion);//cerramos la conexion
            return $array;//retornamos el arreglo
        }

        function productosCate(){
            $query = "SELECT sub.*, sub.nombre_categoria AS nombre_categoria FROM ( SELECT p.*, c.nombre AS nombre_categoria, ROW_NUMBER() OVER (PARTITION BY p.idCategoria ORDER BY RAND()) AS rn FROM productos p 
            INNER JOIN categorias c ON p.idCategoria = c.idCategoria WHERE p.estado = :estado ) AS sub WHERE sub.rn = 1;";
            $this->conexion = $this->con->conectar();//accedemos a la funcion conectar, y por ende su return, el cual recordara es la bdd
            $resultado = $this->conexion->prepare($query); //preparamos la consulta
            $resultado->bindValue(':estado', "Mostrar");
            $resultado->execute();//ejecutamos la consulta
            $array =array();
            while ($row = $resultado->fetch()) {//obtenemos los resultados de la consulta, aqui se convertiran en arreglos nativos de php que podemos recorrer y usar
                $produ = new ProductosBean();//instaciamos un nuevo producto;
                $produ->setIdProducto($row['idProducto']);//setiamos los valores de producto
                $produ->setIdCategoria($row['idCategoria']);
                $produ->setNombreCategoria($row['nombre_categoria']);
                $produ->setNombre($row['nombre']);
                $produ->setDescripcion($row['descripcion']);
                $produ->setPrecio($row['precio']);
                $produ->setImagen($row['imagen']);
                $produ->setSexo($row['sexo']);
                $produ->setEstado($row[7]);
                $array[]= $produ;//cargamos el arreglo
            }
            $this->con->desconectar($this->conexion);//cerramos la conexion
            return $array;//retornamos el arreglo
        }

        //SECCIÓN DE TODOS LOS PRODUCTOS
        function listaHombres(){
            $query = "SELECT * FROM productos p INNER JOIN categorias c ON p.idCategoria = c.idCategoria WHERE p.estado = :estado AND p.sexo <> :sexo";
            $this->conexion = $this->con->conectar();//accedemos a la funcion conectar, y por ende su return, el cual recordara es la bdd
            $resultado = $this->conexion->prepare($query); //preparamos la consulta
            $resultado->bindValue(':estado', "Mostrar");
            $resultado->bindValue(':sexo', "Mujer");
            $resultado->execute();//ejecutamos la consulta
            $array =array();
            while ($row = $resultado->fetch()) {//obtenemos los resultados de la consulta, aqui se convertiran en arreglos nativos de php que podemos recorrer y usar
                $produ = new ProductosBean();//instaciamos un nuevo producto;
                $produ->setIdProducto($row['idProducto']);//setiamos los valores de producto
                $produ->setIdCategoria($row['idCategoria']);
                $produ->setNombreCategoria($row['Nombre']);
                $produ->setNombre($row['nombre']);
                $produ->setDescripcion($row['descripcion']);
                $produ->setPrecio($row['precio']);
                $produ->setImagen($row['imagen']);
                $produ->setSexo($row['sexo']);
                $produ->setEstado($row[7]);
                $array[]= $produ;//cargamos el arreglo
            }
            $this->con->desconectar($this->conexion);//cerramos la conexion
            return $array;//retornamos el arreglo
        }

        function listaMujeres(){
            $query = "SELECT * FROM productos p INNER JOIN categorias c ON p.idCategoria = c.idCategoria WHERE p.estado = :estado AND p.sexo <> :sexo";
            $this->conexion = $this->con->conectar();//accedemos a la funcion conectar, y por ende su return, el cual recordara es la bdd
            $resultado = $this->conexion->prepare($query); //preparamos la consulta
            $resultado->bindValue(':estado', "Mostrar");
            $resultado->bindValue(':sexo', "Hombre");
            $resultado->execute();//ejecutamos la consulta
            $array =array();
            while ($row = $resultado->fetch()) {//obtenemos los resultados de la consulta, aqui se convertiran en arreglos nativos de php que podemos recorrer y usar
                $produ = new ProductosBean();//instaciamos un nuevo producto;
                $produ->setIdProducto($row['idProducto']);//setiamos los valores de producto
                $produ->setIdCategoria($row['idCategoria']);
                $produ->setNombreCategoria($row['Nombre']);
                $produ->setNombre($row['nombre']);
                $produ->setDescripcion($row['descripcion']);
                $produ->setPrecio($row['precio']);
                $produ->setImagen($row['imagen']);
                $produ->setSexo($row['sexo']);
                $produ->setEstado($row[7]);
                $array[]= $produ;//cargamos el arreglo
            }
            $this->con->desconectar($this->conexion);//cerramos la conexion
            return $array;//retornamos el arreglo
        }

        //SECCIÓN DE CATEGORIAS
        function listaHombresCate($id){
            $query = "SELECT * FROM productos p INNER JOIN categorias c ON p.idCategoria = c.idCategoria WHERE p.estado = :estado AND p.sexo <> :sexo AND p.idCategoria = :id";
            $this->conexion = $this->con->conectar();//accedemos a la funcion conectar, y por ende su return, el cual recordara es la bdd
            $resultado = $this->conexion->prepare($query); //preparamos la consulta
            $resultado->bindValue(':estado', "Mostrar");
            $resultado->bindValue(':sexo', "Mujer");
            $resultado->bindParam(':id', $id);
            $resultado->execute();//ejecutamos la consulta
            $array =array();
            while ($row = $resultado->fetch()) {//obtenemos los resultados de la consulta, aqui se convertiran en arreglos nativos de php que podemos recorrer y usar
                $produ = new ProductosBean();//instaciamos un nuevo producto;
                $produ->setIdProducto($row['idProducto']);//setiamos los valores de producto
                $produ->setIdCategoria($row['idCategoria']);
                $produ->setNombreCategoria($row['Nombre']);
                $produ->setNombre($row['nombre']);
                $produ->setDescripcion($row['descripcion']);
                $produ->setPrecio($row['precio']);
                $produ->setImagen($row['imagen']);
                $produ->setSexo($row['sexo']);
                $produ->setEstado($row[7]);
                $array[]= $produ;//cargamos el arreglo
            }
            $this->con->desconectar($this->conexion);//cerramos la conexion
            return $array;//retornamos el arreglo
        }

        function listaMujeresCate($id){
            $query = "SELECT * FROM productos p INNER JOIN categorias c ON p.idCategoria = c.idCategoria WHERE p.estado = :estado AND p.sexo <> :sexo AND p.idCategoria = :id";
            $this->conexion = $this->con->conectar();//accedemos a la funcion conectar, y por ende su return, el cual recordara es la bdd
            $resultado = $this->conexion->prepare($query); //preparamos la consulta
            $resultado->bindValue(':estado', "Mostrar");
            $resultado->bindValue(':sexo', "Hombre");
            $resultado->bindParam(':id', $id);
            $resultado->execute();//ejecutamos la consulta
            $array =array();
            while ($row = $resultado->fetch()) {//obtenemos los resultados de la consulta, aqui se convertiran en arreglos nativos de php que podemos recorrer y usar
                $produ = new ProductosBean();//instaciamos un nuevo producto;
                $produ->setIdProducto($row['idProducto']);//setiamos los valores de producto
                $produ->setIdCategoria($row['idCategoria']);
                $produ->setNombreCategoria($row['Nombre']);
                $produ->setNombre($row['nombre']);
                $produ->setDescripcion($row['descripcion']);
                $produ->setPrecio($row['precio']);
                $produ->setImagen($row['imagen']);
                $produ->setSexo($row['sexo']);
                $produ->setEstado($row[7]);
                $array[]= $produ;//cargamos el arreglo
            }
            $this->con->desconectar($this->conexion);//cerramos la conexion
            return $array;//retornamos el arreglo
        }

        //ELEMENTOS PARA AGREGAR AL CARRO DE COMPRAS
        function agregarCarro($codigo,$idProducto,$cantidad,$fecha, $total, $estado){
            $query = "INSERT INTO orden (codigo, idProducto, comentario, cantidad,fecha, total, estado) VALUES(:codigo, :idProducto, :comentario, :cantidad, :fecha, :total, :estado)";
            $this->conexion = $this->con->conectar();
            $row = $this->conexion->prepare($query);
            $row->bindParam(':codigo', $codigo);
            $row->bindParam(':idProducto', $idProducto);
            $row->bindValue(':comentario', "NULL");
            $row->bindParam(':cantidad', $cantidad);
            $row->bindParam(':fecha', $fecha);
            $row->bindParam(':total', $total);
            $row->bindParam(':estado', $estado);
            return $row->execute();//devolvera un booleano dependiendo si la consulta y conexion fue exitosa
        }

        function mostrarCarro($codigo){
            $query = "SELECT o.idOrden, o.codigo, o.idProducto, p.nombre AS nombre_producto, p.descripcion, p.precio, p.imagen, c.nombre AS nombre_categoria, 
            o.cantidad, o.fecha, o.total, o.comentario, o.estado FROM orden o JOIN productos p ON o.idProducto = p.idProducto JOIN categorias c ON p.idCategoria = c.idCategoria 
            WHERE o.estado = :estado AND o.codigo =:codigo";
            $this->conexion = $this->con->conectar();//accedemos a la funcion conectar, y por ende su return, el cual recordara es la bdd
            $resultado = $this->conexion->prepare($query); //preparamos la consulta
            $resultado->bindValue(':estado', "carrito");
            $resultado->bindParam(':codigo', $codigo);
            $resultado->execute();//ejecutamos la consulta
            $array =array();
            while ($row = $resultado->fetch()) {//obtenemos los resultados de la consulta, aqui se convertiran en arreglos nativos de php que podemos recorrer y usar
                $produ = new ProductosBean();//instaciamos un nuevo producto;
                $orden = new OrdenBean();
                $orden->setIdOrden($row[0]);
                $orden->setCodigo($row[1]);
                $orden->setIdProducto($row[2]);

                $produ->setNombre($row[3]);
                $produ->setDescripcion($row[4]);
                $produ->setImagen($row[6]);
                $produ->setNombreCategoria($row[7]);

                $orden->setCantidad($row[8]);
                $orden->setFecha($row[9]);
                $orden->setTotal($row[10]);
                $orden->setEstado($row[12]);
                $orden->setProducto($produ);

                $array[]= $orden;//cargamos el arreglo
            }
            $this->con->desconectar($this->conexion);//cerramos la conexion
            return $array;//retornamos el arreglo
        }

        function modificarCarro($codigo, $estado){
            $query = "UPDATE orden SET estado=:estado WHERE codigo =:codigo AND estado =:estadoo";
            $this->conexion = $this->con->conectar();
            $row = $this->conexion->prepare($query);
            $row->bindParam(':estadoo', $estado);
            $row->bindParam(':codigo', $codigo);
            $row->bindValue(':estado', "Pedido");
            return $row->execute();//devolvera un booleano dependiendo si la consulta y conexion fue exitosa
        }

        function eliminarCarro($id){
            $query = "DELETE FROM orden WHERE idOrden = :id";
            $this->conexion = $this->con->conectar();
            $row = $this->conexion->prepare($query);
            $row->bindParam(':id', $id);
            return $row->execute();//devolvera un booleano dependiendo si la consulta y conexion fue exitosa
        }

    }
?>