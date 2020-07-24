
<?php

    include_once ('../Util/Util.php'); 
    require_once ('../Entidades/User.php');
    require_once ('../BaseDatos/UserBD.php'); 

    controlar_action(); 
    /**
     * Conrola las acciones recibidas de la interfaz de categoria, login, y signup
     */
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

    /**
     * Valida los datos user, que no esten vacíos
     */
    function validar_user(){
        $user = new User();
        $user->username = $_POST['txtUser']; 
        $user->password = $_POST['txtPass']; 
        if(!empty($user->username) && !empty($user->password)){
            validar_datos($user); 
        }else{
            header ('Location: /GUI/index.php?status=error&message=datos vacíos'); 
        }
    }

    /**
     * $user Ususario recibido
     * Valida que no este en la sección, o que sea nuevo
     */
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
                $_SESSION['user'] = serialize($userBD); 
               redirecionar_user($userBD);  
            }
        }else{
            header ('Location: /GUI/index.php?status=error&message=datos inexistentes'); 
        }
    }

   /**
    * $userBD usuario a guardar en sección
    * valida si es cliente o admin para ingresar a la interfaz indicada
    */ 
   function redirecionar_user($userBD){
        if($userBD->tipo == 'ad'){
            header('Location: /GUI/admin.php?status=Inicio sección&message=Admin');
        }elseif($userBD->tipo=='cl'){
            header('Location: /GUI/principal.php?status=principal&message=Bienvenido');
        }
    }
    /**
     * Busca una sección existente, devuelve true si hay alguien, false caso contrario
     */
    function existe_seccion(){
         session_start();
         $a = isset($_SESSION['user'])?true:false; 
         return $a;
    }

    /**
     * $user usuario a guardar
     * Guardar el usuario con las datos validados correctamente
     */
    function guardar_user($user){
        if(existe_user($user,false)==null){
            return insertar_user($user);
        }
        return false; 
    }
    /**
     * Obtiene todo los clientes registrados en el sistema
     */
    function mostrar_usuarios(){
        return obtener_clientes(); 
    }
   
?>