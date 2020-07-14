
<?php

include_once ('../Entidades/User.php'); 

    session_start(); 
    if($_SESSION && $_SESSION['user']){
        $userO = new User();
        $userO = $_SESSION['user']; 
      if($userO->tipo=="ad"){
          header('Location: /GUI/admin.php?status=Inicio sección&message=Admin');
    }elseif($userO->tipo=="cl"){

    }else{
        header ('Location: /GUI/index.php?status=Inicio sección'); 
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
                        <p  style="margin-left: 35%;">
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
                        <input class="button is-outlined is-small is-success is-rounded" value="Salir" name="btnSalir" style="margin-left: 30%;" type="submit">
                        <input class="button is-outlined is-small is-danger is-rounded" value="Iniciar Sección" name="btnOk" style="margin-left: 50%;" type="submit">
                        <input class="button is-outlined is-small is-danger is-rounded" value="Crear Una cuenta" name="btnCrearUser" style="margin-left: 50%;" type="submit">


                   </div>

                </div>
            </div>
        </form> 
    </section>
</body>
</html>