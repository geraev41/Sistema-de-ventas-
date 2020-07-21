
<?php
   require_once ('conexion.php'); 
   require_once ('../Entidades/User.php'); 
   
   /**
    * $user usuario a consultar
    * $islogin variable si es true es para login, si es false para sigunp
    * Busca todos los clientes en la base datos, que han sido registrados
    */
   function existe_user($user, $islogin){
        $conexion = getConexion(); 
        $sqlL = "SELECT * FROM users WHERE username = '$user->username' AND password = '$user->password'";
        $sqlSingup = "SELECT * FROM users WHERE username = '$user->username'"; 
        $sql = $islogin? $sqlL:$sqlSingup; 
        $resultado = $conexion->query($sql);

        if ($conexion->connect_errno) {
            $conexion->close();
            return false;
        }

        $usuarios = $resultado->fetch_all();
        $conexion->close(); 
        foreach($usuarios as $u){
            return obtener_usuario($u); 
        }
    }
    
    /**
    * Obtiene todos los usuarios de la base datos, por clientes
    */
    function obtener_clientes(){
        $conexion = getConexion(); 
        $sql = "SELECT * FROM users WHERE tipo = 'cl'"; 
        $resultado = $conexion->query($sql);
        if ($conexion->connect_errno) {
            $conexion->close();
            return false;
        }
        $lisUser= array();
        $usuarios = $resultado->fetch_all();
        foreach($usuarios as $u){
            array_push($lisUser, obtener_usuario($u)); 
        }
        return $lisUser; 
    }
    /**
     * $user usuario a guardar
     * Insertar un usuario en la base datos
     */
    function insertar_user($user){
        $conexion = getConexion(); 
        $sql = "INSERT INTO `users`(`nombre`, `cedula`, `correo`, `telefono`, `direcion`, `username`, `password`, `tipo`) 
        VALUES ('$user->nombre','$user->cedula','$user->correo','$user->telefono',
        '$user->direcion','$user->username','$user->password','$user->tipo')"; 
        var_dump ($sql); 
        $resultado = $conexion->query($sql); 
        if($conexion->connect_errno){
            $conexion->close();
            return false; 
        }
        $conexion->close(); 
        return $resultado; 
       
    }

    /**
     * $userResult array de usuario obtenido en la base datos
     * Obtiene los datos, y los convierte a objeto tipo usuario
     */
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