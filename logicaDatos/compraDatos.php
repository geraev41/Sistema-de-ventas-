

<?php
  //  include_once ('../BaseDatos/carroBD.php');
    include_once ('../BaseDatos/compraBD.php');
    include_once ('../Util/Util.php'); 
    include_once ('../Entidades/Compra.php'); 
 //   include_once ('../logicaDatos/carroDatos.php'); 


 var_dump("");


    function generar_compra($id_carro, $lisaProductos, $users){
        $listaCompras = convertir_to_compra($lisaProductos,$users);
        guardar_compras($listaCompras); 
        foreach($lisaProductos as $p){
            eliminar_producto_d_carro($id_carro, $p->id);
        }
    }

    function convertir_to_compra($listaProductos,$user){
    alert("Hola");
        $compras = array();
        foreach ($lisaProductos as $p) {
            $cantidades = datos_cantidades($p->id, $user->id); 
            $c = new Compra(); 
            $c->id_cliente = $user->id; 
            $c->nombre = $p->nombre;
            $c->imagen = $p->imagen;
          //  $fecha_compra;
            $c->cantidad = $cantidades[0][3];
            $c->descripcion =$p->descripcion;
            $c->precio = $p->precio;
            $c->total = $cantidades[0][4]; 
            array_push($compras,$c);
        }
        return $compras; 
    }

    function guardar_compras($lisaProductos, $user){
        foreach ($listaCompras as $c) {
             //   insertar_compra($c);
        }
    }

?>