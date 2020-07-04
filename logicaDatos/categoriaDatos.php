<?php

    require_once ('../Entidades/Categoria.php'); 
    require_once ('../BaseDatos/CategoriaBD.php'); 



    function guardar_categoria(){
        //atrapar datos 

        $categoria = new Categoria(); 

        $categoria->nombre ="Tecnologia"; 
        insertar_categoria($categoria);

    }

?>