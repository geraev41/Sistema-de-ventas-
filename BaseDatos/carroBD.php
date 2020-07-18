<?php    
    include_once ('conexion.php');
    include_once ('../Entidades/Carro.php');
    include_once ('productoBD.php');

    function buscar_carrito($id_user){
        $con = getConexion(); 
        $sql = "SELECT * FROM carro WHERE id_cliente = $id_user";
        $result = $con->query($sql);
        if($con->connect_errno){
            $con->close(); 
            return false; 
        }
        $a  = $result ? $result->fetch_all():false; 
        return $a;  
    }

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

    function insertar_producto_a_carrito($carro){
        $con = getConexion(); 
        $carro->id = intval($carro->id);
        $carro->id_producto = intval($carro->id_producto);
        $sql = "INSERT INTO asoc_producto_carro(id_carro, id_producto, cantidad) 
        VALUES ('$carro->id','$carro->id_producto','$carro->cantidad')";

        $result = $con->query($sql);
        if($con->connect_errno){
            $con->close(); 
            return false; 
        }
        return $result;
    }

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
    
    function eliminar_producto_d_carro($id_producto){
        $con = getConexion(); 
        $sql = "DELETE asoc_producto_carro WHERE id_producto = $id_producto";
        $result = $con->query($sql);
        if($con->connect_errno){
            $con->close(); 
            return fase; 
        }
        return $result;
    }

    function cargar_carro($carResult){
        $listPro = mostrar_productos_en_carrito(intval($carResult[2]));
        $c = new Carro(); 
        $c->id = $carResult[1]; 
        $c->cantidad= $carResult[3];
        $c->listaProductos = $listPro?$listPro:NULL; 
        return $c; 
        
    }
?>