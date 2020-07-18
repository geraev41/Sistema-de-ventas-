<?php

    include_once ('../Entidades/Carro.php'); 
    include_once ('../Entidades/User.php'); 
    include_once ('../BaseDatos/carroBD.php');
    
    if(isset($_GET['id'])){
        session_start();
        $u = new User(); 
        $carro = new Carro(); 

        $u = $_SESSION['user']; 
        $carro->id_usuario = intval($u->id);
        $carro->id_producto = intval($_GET['id']); 
        guardar_producto_en_carro($carro); 
    }


    if(isset($_GET['cant'])){
        cambios(($_GET['cant']), intval($_GET['id_pr']));
    }

    function guardar_producto_en_carro($carro){
        $carEncontrado = buscar_carrito($carro->id_usuario);
        $carro->cantidad = 4; 
        if($carEncontrado){
            $carro->id = $carEncontrado[0];
             insertar_producto_a_carrito($carro);
             header('Location: /GUI/principal.php?status=principal&message=Producto agregado');
             return; 

        }
        $carro->id= intval(crear_carrito($carro)[0]);
        insertar_producto_a_carrito($carro); 
        header('Location: /GUI/principal.php?status=principal&message=Producto agregado');
        return; 

    }

    function mostrar_productos_x_carro($id_usuario){
        $carEncontrado = buscar_carrito($id_usuario);
        if(!$carEncontrado){
            return false; 
        }
        return mostrar_productos_carrito(intval($carEncontrado[0])); 
    }

    function cambios($cant, $id){
    }

?>
