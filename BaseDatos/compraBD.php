<?php
    include_once ('conexion.php');
    include_once ('../Entidades/Compra.php');

    /**
     * $c compra a guardar
     * guarda una nueva compra 
     */
    function insertar_compra($c){
        $con = getConexion(); 
        $sql = "INSERT INTO compras(id_cliente, nombre, imagen, fecha_compra, cantidad, descripcion, precio, costo)
        VALUES('$c->id_cliente', '$c->nombre', '$c->imagen', '$c->fecha_compra', '$c->cantidad', '$c->descripcion', 
        '$c->precio', '$c->costo')";
        $result = $con->query($sql);
        if($con->connect_errno){
            $con->close(); 
            return false; 
        }
        return $result; 
    }
    /**
     * $id_usuario id del usuario que realizó la compra
     * obtiene todas las compras de un usuario
     */
    function mostrar_compras($id_usuario){
        $con = getConexion(); 
        $sql = "SELECT * FROM compras WHERE id_cliente = $id_usuario";
        $result = $con->query($sql);
        if($con->connect_errno){
            $con->close(); 
            return false; 
        }
        $comprasDevolver=array();
        $compras = $result->fetch_all();
        foreach ($compras as $compra) {
            array_push($comprasDevolver, cargar_compra($compra));
        }
        return $comprasDevolver; 
    }

    /**
     * $id_compra id de una compra
     * consulra una compra por id
     */
    function consultar_compra($id_compra){
        $con = getConexion(); 
        $sql = "SELECT * FROM compras WHERE id = $id_compra";
        $result = $con->query($sql);
        if($con->connect_errno){
            $con->close(); 
            return false; 
        }
        $comprasDevolver=array();
        $compras = $result->fetch_all();
        foreach ($compras as $compra) {
            array_push($comprasDevolver, cargar_compra($compra));
        }
        return $comprasDevolver; 
    }
    /**
     * $id de la compra
     * elimina una compra de la base datos
     */
    function eliminar_compra($id){
        $con = getConexion(); 
        $sql = "DELETE FROM compras WHERE id = $id";
        $result = $con->query($sql);
        if($con->connect_errno){
            $con->close(); 
            return false; 
        }
        return $result; 
    }
    
    /**
     * $compraResult obtenido de la base datos
     * carga una pregunta con todos los datos
     */
    function cargar_compra($compraResult){
        $c = new Compra();
        $c->id = $compraResult[0];
        $c->id_cliente = $compraResult[1];
        $c->nombre = $compraResult[2];
        $c->imagen = $compraResult[3];
        $c->fecha_compra = $compraResult[4];
        $c->cantidad = $compraResult[5];
        $c->descripcion= $compraResult[6];
        $c->precio= $compraResult[7];
        $c->costo= $compraResult[8];
        return $c;
    }

?>