<?php
    
    require ('conexion.php'); 

    function insertar_categoria($categoria){
        $con = getConexion(); 

        $sql  = "INSERT INTO categorias(nombre) VALUES ('$categoria->nombre')"; 


    }

?>