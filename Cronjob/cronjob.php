
<?php
    include ('conexion.php'); 
    /**
     * $cantidad recibida a consultar
     * consulta,verifica y devuelve los producto encontrados en la base de datos
     */
    function consultar_stock($cantidad){
        $con = getConexion(); 
        $sql = "SELECT * FROM producto WHERE stock <= $cantidad";
        $result = $con->query($sql);
        if($con->connect_errno){
            $con->close(); 
            return false; 
        }
       $productos = $result->fetch_all();
       return $productos; 
    }

?>