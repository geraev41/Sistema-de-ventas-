<?php    
    include_once ('conexion.php');
    include_once ('../Entidades/Carro.php');
    include_once ('productoBD.php');

    /**
     * $id_user usuario 
     * Busca un carrito del usuario
     */
    function buscar_carrito($id_user){
        $con = getConexion(); 
        $sql = "SELECT * FROM carro WHERE id_cliente = $id_user";
        $result = $con->query($sql);
        if($con->connect_errno){
            $con->close(); 
            return false; 
        }
      //  $a  = $result ? $result->fetch_all():false; 
       // return $a;  
       $carr = $result->fetch_all();
       foreach($carr as $c){
            return cargar_carro_buscado($c); 
       }
    }
    /**
     * $carro carro a guardar
     * Si el usuario no tiene un carro asociado, se le crea uno nuevo
     */
    function crear_carrito($carro){
        $con = getConexion(); 
        $sql = "INSERT INTO carro (id_cliente) VALUES('$carro->id_usuario')"; 
        $result = $con->query($sql);
        if($con->connect_errno){
            $con->close(); 
            return false; 
        }
      return buscar_carrito($carro->id_usuario);
    }

    /**
     * $carro el carro trae los datos del producto
     * inserta un producto junto al carro correspondiente
     */
    function insertar_producto_a_carrito($carro){
        $con = getConexion(); 
        $carro->id = intval($carro->id);
        $carro->id_producto = intval($carro->id_producto);
        $sql = "INSERT INTO asoc_producto_carro(id_carro, id_producto, cantidad, valor) 
        VALUES ('$carro->id','$carro->id_producto','$carro->cantidad','$carro->total')";

        $result = $con->query($sql);
        if($con->connect_errno){
            $con->close(); 
            return false; 
        }
        return $result;
    }

    /**
     * $id_carro id del carro a consultar
     * Muestra productos de un carrito en especifico
     */
    function mostrar_productos_carrito($id_carro){
        $con = getConexion();
        $sql = "SELECT * FROM asoc_producto_carro WHERE id_carro = $id_carro"; 
        $result = $con->query($sql); 
        if($con->connect_errno){
            $con->close(); 
            return false; 
        }
        $carritosDevolver = array(); 
        $carritos = $result->fetch_all();
        foreach($carritos as $c){
            array_push($carritosDevolver, cargar_carro($c)); 
        }  
        $con->close(); 
        return $carritosDevolver; 
    }
    
    /**
     * $id_producto id del producto
     * $id_carro id del carro 
     * obtiene las cantidades que reservo el usuario
     */
    function cargar_cantidades_d_carro($id_producto, $id_carro){
        $con = getConexion(); 
        $sql = "SELECT * FROM asoc_producto_carro WHERE id_carro = $id_carro AND id_producto = $id_producto";
        $result = $con->query($sql);
        if($con->connect_errno){
            $con->close(); 
            return fase; 
        }
        return $result->fetch_all();
    }
    /**
     * $carro a modificar
     * Modifica las cantidades que el usuario a editado
     */
    function editar_cantidades($carro){
        $con = getConexion(); 
        $sql ="UPDATE asoc_producto_carro  SET cantidad = '$carro->cantidad', valor = '$carro->total' 
        WHERE id_carro= $carro->id AND id_producto = $carro->id_producto"; 
         $result = $con->query($sql);
         if($con->connect_errno){
             $con->close(); 
             return false; 
         }
         return $result;
    }
    /**
     * $id_carro id del carro
     * $id_producto id del producto
     * elimina un producto del carro que esta asociado al usuario
     */
    function eliminar_producto_d_carro($id_carro, $id_producto){
        $con = getConexion(); 
        $sql = "DELETE FROM asoc_producto_carro WHERE id_carro = $id_carro AND id_producto = $id_producto";
        $result = $con->query($sql);
        if($con->connect_errno){
            $con->close(); 
            return false; 
        }
        return $result;
    }

    /**
     * $carResult obtenido de la base datos
     * Carga carro con todos los datos completos
     */
    function cargar_carro($carResult){
        $listPro = mostrar_productos_en_carrito(intval($carResult[2]));
        $c = new Carro(); 
        $c->id = $carResult[1]; 
        $c->cantidad= $carResult[3];
        $c->listaProductos = $listPro?$listPro:NULL; 
        return $c; 
    }
    /**
     * $carResult obtenido de la base datos
     * carga el carro con los datos que son unicamente necesarios
     */
    function cargar_carro_buscado($carResult){
        $c = new Carro(); 
        $c->id = $carResult[0]; 
        $c->id_usuario= $carResult[1];
        return $c; 
        
    }
?>