

<?php
    include_once ('../BaseDatos/compraBD.php');
    include_once ('../Util/Util.php'); 
    include_once ('../Entidades/Compra.php'); 
    include_once ('../logicaDatos/carroDatos.php'); 

    /**
     * obtiene el id del url
     */
    if(isset($_GET['id_compra_delete'])){
       if(borrar_compra(intval($_GET['id_compra_delete']))){
            header('Location: /GUI/principal.php?status=compra eliminada');
        }
    }
    /**
     * $id de compra
     * quita una compra que el usuario ya no desea ver 
     */
    function borrar_compra($id){
        return eliminar_compra($id);
    }
    /**
     * $id_carro id del carro que tiene los productos a pagar
     * $listaProductos a pagar
     * $user quien va hacer el pago
     * convierte todos los productos a compras, guarda
     * luego modificca el stock con la cantidad que ahora queda disponible
     * elimina un producto del carro 
     */
    function generar_compra($id_carro, $listaProductos, $user){
        $listaCompras = convertir_to_compra($listaProductos,$user);
        guardar_compras($listaCompras); 
        foreach($listaProductos as $p){
            $cantidadSelecionada = $p->stock;
            $cantidades = datos_cantidades($p->id, $user->id); 
            $cantidadDisponible =  $cantidadSelecionada- $cantidades[0][3]; 
            $vendidos = $cantidades[0][3]+$p->vendidos; 
            modificar_producto_stock($p->id,$cantidadDisponible,$vendidos);
            eliminar_producto_d_carro($id_carro, $p->id);
        }
        return true; 
    }
    /**
     * $listaProductos a convertit en compras 
     * $user usuario de la compra y carro
     * $devuelve compras 
     */
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
    /**
     * $str_imagen ruta de la imagen
     * la convierte a bits
     */
    function convert_imagen($str_imagen){
        return addslashes($str_imagen); 
    }
    /**
     * devuelve la fecha actual en que realizo la compra, con la hora 
     */
    function obtener_fecha(){
        date_default_timezone_set("America/Costa_Rica"); 
        $fecha = Date("d-m-Y");
        $hora = Date(" h:i a");
        $fe = $fecha.$hora;
        return $fe;
    }
    /**
     * $listaCompras a guardar
     * guarda las compras
     */
    function guardar_compras($listaCompras){
        foreach ($listaCompras as $c) {
            insertar_compra($c);
        }
    }

    function ver_compras($id_usuario){
        return mostrar_compras($id_usuario); 
    }

    /**
     * $id_compra de la compra
     * obtiene una compra en especifico
     */
    function traer_compra($id_compra){
        return consultar_compra($id_compra)[0];
    }

?>