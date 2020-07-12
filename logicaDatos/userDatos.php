
<?php

    include_once ('../Util/Util.php'); 
    require_once ('../Entidades/User.php');
    require_once ('../BaseDatos/UserBD.php'); 
    include ('logout.php'); 
    

    controlar_action(); 

    function controlar_action(){
        if(isset($_POST['btnOk'])){
            validar_user(); 
        }elseif(isset($_POST['btnGuardar'])){
            guadar_user(); 
        }elseif(isset($_POST['btnGuardarCategoria'])){
            require ('categoriaDatos.php'); 
            guardar_categoria(); 
        }elseif(isset($_POST['btnCrearUser'])){
            header('Location: /GUI/signup.php?status=Registror&message=Crea tu cuenta!');
        }elseif(isset($_POST['btnLogout'])){
            destruir_session(); 
        }else{
            header('Location: /GUI/index.php?status=error&message=salio');
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
        $userBD = existe_user($user, true);
        if($userBD){
            session_start(); 
            $_SESSION['user'] = $userBD; 
            if($userBD->tipo == 'ad'){
                header('Location: /GUI/admin.php?status=Inicio sección&message=Admin');
            }

        }else{
            header ('Location: /GUI/index.php?status=error&message=datos inexistentes'); 
        }
    }

    function guadar_user(){
        //Atrapar datos 

        $user = new User(); 
        $user->nombre = "Gerardo";
        $user->cedula ="207970386";
        $user->correo ="gespinozav@est.utn.ac.cr";
        $user->telefono = 83517632; 
        $user->direcion = "Coopevega de Cutris"; 
        $user->username="geracliente";
        $user->password = "1234"; 
        $user->tipo = 'ad'; 
        if(existe_user($user,false)==null){
            if(insertar_user($user)){
                echo "se guardo"; 
            }
        }else{
            header('Location: /GUI/signup.php?status=Registro&message=Usuario ya existe!');
        }
    }


   
?>