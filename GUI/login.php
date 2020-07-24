
<?php
    session_start();
    $a = isset($_SESSION['existe_user'])?$_SESSION['existe_user']:false; 
    if($_SESSION && ($a != 'is_same')){
        include_once ('../Util/Util.php');
        alert ("Es probable que haya iniciado una sección anteriormente,cierre sección para ingresar con nuevo usuario");
    }elseif($_SESSION){
        if($_SESSION && $_SESSION['user']){
            include_once ('../Entidades/User.php'); 
            $user = new User();
            $user = unserialize($_SESSION['user']);
            if($user->tipo == "cl"){
                header('Location: /GUI/principal.php?status=principal&message=Bienvenido');
            }elseif($user->tipo = "ad"){
                header('Location: /GUI/admin.php?status=Inicio sección&message=Admin');
            }
        }
    }
   

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sección</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.2/css/bulma.min.css"/>

</head>
<body> 
    <section class="section"> 
        <form method="POST" action="../logicaDatos/userDatos.php">
            <div class="container">
                <div class="columns">
                   <div class="column is-half
                        is-offset-one-quarter">
                        <p style="margin-left: 35%;">
                            <img class="is-rounded"src="/Imagenes/icon_user.png"  width="140px">
                        </p>
                        <div class="control has-icons-left">
                            <input class="input is-primary" type="text" placeholder="Nombre de usuario" name="txtUser"><br><br>
                            <span style ="background-image: url('../Imagenes/icon_username.png'); background-repeat: no-repeat; background-position: center;" class="icon is-small is-left">
                                <i lass="fas fa-envelope"></i>
                            </span> 
                        </div>

                        <div class="control has-icons-left">
                            <input  class="input is-primary"  type="password" placeholder="Contraseña" name="txtPass"><br><br>
                            <span style ="background-image: url('../Imagenes/icon_pass.png'); background-repeat: no-repeat; background-position: center;" class="icon is-small is-left">
                                <i lass="fas fa-envelope"></i>
                            </span>  
                        </div>
                       <div style="margin-left: 30%;"> 
                        <input class="button is-outlined is-small is-success " value="Crear Una cuenta" name="btnCrearUser" type="submit">
                        <input class="button is-outlined is-small is-danger " value="Iniciar Sección" name="btnOk" type="submit">
                      </div> 
                   </div>

                </div>
            </div>
        </form> 
    </section>
</body>
</html>