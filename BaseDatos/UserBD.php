
<?php
   require ('conexion.php'); 
   require_once ('../Entidades/User.php'); 
   
   function existe_user($user, $islogin){
        $conexion = getConexion(); 

        $sqlL = "SELECT * FROM users WHERE username = '$user->username' AND password = '$user->password'";
        $sqlSingup = "SELECT * FROM users WHERE username = '$user->username'"; 
        $sql = $islogin? $sqlL:$sqlSingup; 

        if($conexion){
            $resultado = $conexion->query($sql);
            if(mysqli_num_rows($resultado)>0){
                $usuarios = $resultado->fetch_all();
                foreach($usuarios as $u){
                    return obtener_usuario($u); 
                }
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

    function obtener_usuario($userResult){
        $u = new user(); 
        $u->id = $userResult[0]; 
        $u->nombre = $userResult[1]; 
        $u->cedula =$userResult[2]; 
        $u->correo = $userResult[3];
        $u->telefono =$userResult[4]; 
        $u->direcion = $userResult[5]; 
        $u->username = $userResult[6];
        $u->password= $userResult[7]; 
        $u->tipo = $userResult[8]; 
        return $u;
    }



?>