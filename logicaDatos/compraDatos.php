

<?php
  //  include_once ('../BaseDatos/carroBD.php');
    include_once ('../BaseDatos/compraBD.php');
    include_once ('../Util/Util.php'); 
    include_once ('../Entidades/Compra.php'); 
    include_once ('../logicaDatos/carroDatos.php'); 




    function generar_compra($id_carro, $listaProductos, $users){
        $listaCompras = convertir_to_compra($listaProductos,$users);
        guardar_compras($listaCompras); 
        foreach($listaProductos as $p){
            $cantidadSelecionada = $p->stock;
            $cantidades = datos_cantidades($p->id, $users->id); 
            $cantidadDisponible =  $cantidadSelecionada- $cantidades[0][3]; 
            modificar_producto_stock($p->id,$cantidadDisponible);
            eliminar_producto_d_carro($id_carro, $p->id);
        }
        return true; 
    }

    function convertir_to_compra($listaProductos,$user){
        $compras = array();
        foreach ($listaProductos as $p) {
            $cantidades = datos_cantidades($p->id, $user->id); 
            $c = new Compra(); 
            $c->id_cliente = $user->id; 
            $c->nombre = $p->nombre;
            $c->imagen = convert_imagen($p->imagen);
            $c->fecha_compra = obtener_fecha();
            $c->cantidad = $cantidades[0][3];
            $c->descripcion =$p->descripcion;
            $c->precio = $p->precio;
            $c->costo = $cantidades[0][4]; 
            array_push($compras,$c);
        }
        return $compras; 
    }
    function convert_imagen($str_imagen){
        return addslashes($str_imagen); 
    }

    function obtener_fecha(){
        date_default_timezone_set("America/Costa_Rica"); 
        $fecha = Date("d-m-Y");
        $hora = Date(" h:i a");
        $fe = $fecha.$hora;
        return $fe;
    }

    function guardar_compras($listaCompras){
        foreach ($listaCompras as $c) {
            insertar_compra($c);
        }
    }

    function ver_compras($id_usuario){
        return mostrar_compras($id_usuario); 
    }

?>