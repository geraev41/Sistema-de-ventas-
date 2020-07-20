
<?php
    include ('conexion.php'); 
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