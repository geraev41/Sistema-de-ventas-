
<?php
   require ('conexion.php'); 
   
   function existe_user($user){
        $conexion = getConexion(); 
        $sql = "SELECT * FROM users WHERE username = ".$user->username." and password = ".$user->password;
        if($conexion){
            $resultado = $conexion->query($sql);
            if(mysql_num_rows($resultado)>0){
                $usuario = $resultado->fetch_all();
                //No es usuario
                return $usuario; 
            }else{
                return null; 
            }
           
        }else{
            throw new Exception ("Error de conexion a la base datos"); 
        }
        
    }
    

    function insertar_user($user){
        $conexion = getConexion(); 
        $sql = "INSERT INTO `users`(`nombre`, `cedula`, `correo`, `telefono`, `direcion`, `username`, `password`, `tipo`) 
        VALUES ('$user->nombre','$user->cedula','$user->correo','$user->telefono',
        '$user->direcion','$user->username','$user->password','$user->tipo')"; 
        if($conexion){
            $resultado = mysqli_query($conexion, $sql);
            //return (mysql_num_rows($resultado)>0);
            
        }

    }



?>