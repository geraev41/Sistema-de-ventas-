<?php
    include_once ('conexion.php');
    
    function insertar_compra($c){
        $con = getConexion(); 
        $sql = "INSERT INTO compras () VALUES()";
        $result = $con->query($sql);
        if($con->connect_errno){
            $con->close(); 
            return false; 
        }
    }

?>