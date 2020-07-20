<?php

    include_once ('../Entidades/Carro.php'); 
    include_once ('../Entidades/User.php'); 
    include_once ('../BaseDatos/carroBD.php');
    include_once ('../BaseDatos/productoBD.php');
    include_once ('../Util/Util.php'); 
    
    if(isset($_GET['id_car']) && isset($_GET['id_pro'])){
        $id_carro = intval($_GET['id_car']);
        $id_pro = intval($_GET['id_pro']);
        quitar_d_carrito($id_carro, $id_pro);
    }

    if(isset($_GET['id'])){
        session_start();
        $u = new User(); 
        $carro = new Carro(); 
        $u = unserialize($_SESSION['user']); 
        $carro->id_usuario = intval($u->id);
        $carro->id_producto = intval($_GET['id']); 
        guardar_producto_en_carro($carro); 
    }

    function guardar_producto_en_carro($carro){
        $carEncontrado = buscar_carrito($carro->id_usuario);
        $carro->cantidad = 1; 
        $p = get_producto($carro->id_producto);
        $carro->total = $carro->cantidad*$p->precio;
        if($carEncontrado){
            $carro->id = $carEncontrado->id;
             insertar_producto_a_carrito($carro);
             header('Location: /GUI/principal.php?status=principal&message=Producto agregado');
             return; 

        }
        $carro->id= intval(crear_carrito($carro)[0]->id);
        insertar_producto_a_carrito($carro); 
        header('Location: /GUI/principal.php?status=principal&message=Producto agregado');
        return; 

    }

    function mostrar_productos_x_carro($id_usuario){
        $carEncontrado = buscar_carrito($id_usuario);
        if(!$carEncontrado){
            return false; 
        }
        return mostrar_productos_carrito(intval($carEncontrado->id)); 
    }

   function datos_cantidades($id_producto, $id_usuario){
        $carEncontrado = buscar_carrito($id_usuario);
        if(!$carEncontrado){
             return false; 
        }
        return cargar_cantidades_d_carro($id_producto, intval($carEncontrado->id));
   }

   function modificar_cantidades($carro){
        $carEncontrado = buscar_carrito($carro->id_usuario);
        if(!$carEncontrado){
            return false; 
        }
        $carro->id = intval($carEncontrado->id); 
        return editar_cantidades($carro); 
   }

   function quitar_d_carrito($id_carro,$id_pro){
   if(eliminar_producto_d_carro($id_carro, $id_pro)){
        header('Location: /GUI/principal.php?status=principal&message=Descartado con exitó');
        return; 
   } 

}


?>
