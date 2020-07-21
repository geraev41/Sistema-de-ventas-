
<?php

    include_once ('../Util/Util.php'); 
    require_once ('../Entidades/User.php');
    require_once ('../BaseDatos/UserBD.php'); 

    controlar_action(); 

    function controlar_action(){
        if(isset($_POST['btnOk'])){
            validar_user(); 
        }elseif(isset($_POST['btnGuardarCategoria'])){
            require ('categoriaDatos.php'); 
            guardar_categoria(); 
        }elseif(isset($_POST['btnCrearUser'])){
            header('Location: /GUI/signup.php?status=Registror&message=Crea tu cuenta!&&new');
        }elseif(isset($_POST['btnLogout'])){
            destruir_session(); 
        }
    }


    function validar_user(){
        try{
        if(isset($_POST['btnOk'])){
            $username = $_POST['txtUser']; 
            $pass = $_POST['txtPass']; 
            $user = new User();
            $user->username = $username; 
            $user->password = $pass; 
            if(!empty($username) && !empty($pass)){
                validar_datos($user); 
            }else{
                 header ('Location: /GUI/index.php?status=error&message=datos vacíos'); 
            }
        }
    }catch(Exception $e){
         header('Location: /GUI/index.php?status=error&message=datos vacios');

    }
    }

    function validar_datos($user){
        $userBD = existe_user($user, true);
        if($userBD){
            if(existe_seccion()){
                session_start(); 
                $userSeccion = unserialize($_SESSION['user']); 
                if($userBD->id == $userSeccion->id){
                    $_SESSION['existe_user']='is_same'; 
                    header ('Location: /GUI/index.php?status=Usuario en sección'); 
                } 
                if($userBD->id != $userSeccion->id){
                    $_SESSION['existe_user']='is_diferrent'; 
                    header ('Location: /GUI/index.php?status=Sección iniciada o datos vacíos'); 
                } 
            }else{
               redirecionar_user($userBD);  
            }
        }else{
            header ('Location: /GUI/index.php?status=error&message=datos inexistentes'); 
        }
    }

   function redirecionar_user($userBD){
       $_SESSION['user'] = serialize($userBD); 
        if($userBD->tipo == 'ad'){
            header('Location: /GUI/admin.php?status=Inicio sección&message=Admin');
        }elseif($userBD->tipo=='cl'){
            header('Location: /GUI/principal.php?status=principal&message=Bienvenido');
        }
    }

    function existe_seccion(){
         session_start();
         $a = isset($_SESSION['user'])?true:false; 
         return $a;
     }

    function guardar_user($user){
        if(existe_user($user,false)==null){
            return insertar_user($user);
        }
        return false; 
    }

    function mostrar_usuarios(){
        return obtener_clientes(); 
    }
   
?>