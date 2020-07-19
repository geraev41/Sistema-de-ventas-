<?php

    include_once ('conexion.php');
    include_once ('../Entidades/Producto.php');
    function insertar_producto($p){
        $con = getConexion(); 
        $sql ="INSERT INTO producto(id_categoria, nombre, descripcion, imagen, stock, precio) 
        VALUES ('$p->id_categoria','$p->nombre','$p->descripcion','$p->imagen','$p->stock','$p->precio')";

        $result = $con->query($sql);
        if($con->connect_errno){
            $con-close();
            return false; 
        }
        $con->close(); 
        return $result; 
    }

    function modificar_producto($p){
        $con = getConexion(); 
        $sql ="UPDATE `producto` SET id_categoria='$p->id_categoria', nombre='$p->nombre', descripcion='$p->descripcion', 
        imagen= '$p->imagen', stock='$p->stock', precio='$p->precio' WHERE id =$p->id"; 
        $result = $con->query($sql);
        if($con->connect_errno){
            $con->close();
            return false; 
        }
        $con->close(); 
        return $result; 
    }

    function get_producto($id){
        $con = getConexion(); 
        $sql ="SELECT * FROM `producto`
         WHERE id = $id";
         //'id', 'id_categoria', 'nombre', 'descripcion', 'imagen', 'stock', 'precio', 'cantidad'
        $result = $con->query($sql);

        if($con->connect_errno){
            $con-close();
            return false; 
        }
        $producto = $result->fetch_all(); 
        foreach ($producto as $p) {
            return cargar_producto($p); 
        }
    }


    function mostrar_productos_x_categoria($id_categoria){
        $con = getConexion(); 
        $sql ="SELECT * FROM `producto` WHERE id_categoria = $id_categoria";
        $result = $con->query($sql);
        //'id', 'id_categoria', 'nombre', 'descripcion', 'imagen', 'stock', 'precio', 'cantidad' 
        if($con->connect_errno){
            $con-close();
            return false; 
        }
        $productos_cate= array(); 
        $productos = $result->fetch_all(); 
        foreach ($productos as $p) {
            array_push($productos_cate, cargar_producto($p)); 
        }
        return $productos_cate; 
    }

    function mostrar_productos_en_carrito($id_producto){
        $con = getConexion(); 
        $sql ="SELECT * FROM `producto` WHERE id = $id_producto";
        $result = $con->query($sql);
        if($con->connect_errno){
            $con-close();
            return false;
        }

        $producto_car = array(); 
        $car_pro  = $result->fetch_all(); 
        foreach($car_pro as $pr){
            array_push ($producto_car, cargar_producto($pr));
        }
        return $producto_car; 
    }

    function delete_producto($id){
        $con = getConexion(); 
        $sql ="DELETE FROM producto
         WHERE id = $id";
        $result = $con->query($sql);

        if($con->connect_errno){
            $con-close();
            return false; 
        }
        return $result; 
    }

    function cargar_producto($resultP){
        $p = new Producto(); 
        $p->id = $resultP[0]; 
        $p->id_categoria = $resultP[1]; 
        $p->nombre = $resultP[2]; 
        $p->descripcion = $resultP[3]; 
        $p->imagen= $resultP[4]; 
        $p->stock = $resultP[5]; 
        $p->precio = $resultP[6]; 
        return $p; 
    }


?>