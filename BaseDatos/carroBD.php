<?php    
    include_once ('conexion.php');
    include_once ('../Entidades/Carro.php');
    include_once ('productoBD.php');

    function buscar_carrito($id_user){
        $con = getConexion(); 
        $sql = "SELECT * FROM carro WHERE id_user = $id_user";
        $result = $con->query($sql);
        if($con->connect_errno){
            $con->close(); 
            return false; 
        }

        return $result;
    }

    function crear_carrito($carro){
        $con = getConexion(); 
        $sql = "INSERT INTO carro (id_usuario) VALUES('$carro->id_usuario')"; 
        $result = $con->query($sql);
        if($con->connect_errno){
            $con->close(); 
            return false; 
        }
        return $result;

    }

    function insertar_productos($carro){
        $con = getConexion(); 
        $sql = "INSERT INTO asoc_producto_carro(id_carro, id_producto) VALUES ('$carro->id_usuario','$carro->id_producto')";
        $result = $con->query($sql);
        if($con->connect_errno){
            $con->close(); 
            return false; 
        }
        return $result;
    }

    function eliminar_producto_d_carro($id_producto){
        $con = getConexion(); 
        $sql = "DELETE asoc_producto_carro WHERE id_producto = $id_producto";
        $result = $con->query($sql);
        if($con->connect_errno){
            $con->close(); 
            return false; 
        }
        return $result;
    }

    function cargarCarro($carResult){
        $listPro = mostrar_productos_en_carrito($c->id);
        $c = new Carro(); 
        $c->id = $carResult[0]; 
        $c->id_usuario = $carResult[1]; 
        $c->listaProductos = $listPro?$listPro:NULL; 
        return $c; 
        
    }
?>