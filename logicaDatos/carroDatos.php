<?php

    include_once ('../Entidades/Carro.php'); 
    include_once ('../BaseDatos/carroBD.php');
    
    
    function guardar_productos_en_carro($carro){
        insertar_en_carrito($carro);
    }



?>
