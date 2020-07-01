
<?php

    include_once ('../Util/Util.php'); 

    controlar_action(); 

    function controlar_action(){
        if(isset($_POST['btnOk'])){
            validar_user(); 
        }else{
            header('Location: /GUI/index.php?status=error&message=salio');
        }
    }


    function validar_user(){
        try{
        require_once ('../Entidades/User.php');
        if(isset($_POST['btnOk'])){
            $username = $_POST['txtUser']; 
            $pass = $_POST['txtPass']; 
            $user = new User();
            $user->username = $username; 
            $user->password = $pass; 
            validar_espacios($user); 
            if(!empty($username) && !empty($pass)){
                validar_datos($user); 
            }
        }
    }catch(Exception $e){
        alert($e->getMessage()); 
         header('Location: /GUI/index.php?status=error&message=datos vacios');

    }
    }

    function validar_espacios($user){
        if(empty($user->username)) {
        throw new Exception("Usuario no puede estar vacío");

        }
    }

    function validar_datos($user){
        require_once ('../BaseDatos/UserBD.php'); 
        $userBD = existe_user($user);
        if($userBD!=null){
            session_start(); 
            $_SESSION['user'] = $userBD; 
            if($userBD->tipo == 'ad'){
                header('Location: /GUI/admin.php?status=Inicio sección&message=Admin');

            }
        }
    }

    function guadar_user($user){

    }


   
?>