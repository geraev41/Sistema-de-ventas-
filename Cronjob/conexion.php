<?php
    /**
     * Devuelve la conexion obtenida a la base datos
     */
    function getConexion(){
        $servidor ="localhost";
        $usuario = "root";
        $clave = "";
        $base_datos = "EShop";
        $conexion= mysqli_connect($servidor, $usuario, $clave, $base_datos);
        return $conexion; 
    }

?>