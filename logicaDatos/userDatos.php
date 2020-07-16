
<?php

    include_once ('../Util/Util.php'); 
    require_once ('../Entidades/User.php');
    require_once ('../BaseDatos/UserBD.php'); 
    include ('logout.php'); 
    

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
            session_start(); 
            $_SESSION['user'] = $userBD; 
            if($userBD->tipo == 'ad'){
                header('Location: /GUI/admin.php?status=Inicio sección&message=Admin');
            }elseif($userBD->tipo=='cl'){
                header('Location: /GUI/principal.php?status=principal&message=Bienvenido');
            }
        }else{
            header ('Location: /GUI/index.php?status=error&message=datos inexistentes'); 
        }
    }

    function guardar_user($user){
        if(existe_user($user,false)==null){
            return insertar_user($user);
        }
        return false; 
    }


   
?>