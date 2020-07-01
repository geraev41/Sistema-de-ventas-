
<?php
   require ('conexion.php'); 
   
   function existe_user($user){
        $conexion = getConexion(); 
        $sql = "SELECT * FROM users WHERE username = ".$user->username." and password = ".$user->password;
        if($conexion){
            $resultado = $conexion->query($sql);
            if(mysql_num_rows($resultado)>=1){
                $usuario = $resultado->fetch_all();
                return $usuario; 
            }else{
                return null; 
            }
           
        }else{
            throw new Exception ("Error de conexion a la base datos"); 
        }
        
    }
    

    function insertarUser($user){

    }



?>