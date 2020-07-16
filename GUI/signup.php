
<?php
    if(!isset($_GET['new'])){
        header ('Location: /GUI/index.php?status=Inicio sección'); 
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creando una cuenta</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.2/css/bulma.min.css"/>

</head>
<body>
    <section class="section">
        <form method="POST" action="signup.php">
            <div class="container">
                <div class="columns"> 
                    <div class="column">
                        <div class="column is-half
                is-offset-one-quarter">
                             <input REQUIRED class="input is-primary" type="text" placeholder="Nombre"  name="txtNombre"><br><br>
                             <input REQUIRED class="input is-primary" type="text" placeholder="Cedula"  name="txtCedula"><br><br>
                             <input REQUIRED  class="input is-primary" type="text" placeholder="Correo Eletronico"  name="txtCorreo"><br><br>
                             <input REQUIRED class="input is-primary" type="text" placeholder="Télefono"  name="txtTelefono"><br><br>
                             <input REQUIRED class="input is-primary" type="text" placeholder="Direcion"  name="txtDirecion"><br><br>
                             <input REQUIRED class="input is-primary" type="text" placeholder="Nombre de usuario"  name="txtUsername"><br><br>
                             <input REQUIRED class="input is-primary" type="password" placeholder="Contraseña"  name="txtPass"><br><br>
                             <input REQUIRED class="input is-primary" type="password" placeholder="Confirmar Contraseña"  name="txtRePass"><br><br>
                              <input REQUIRED class="button is-small is-danger is-rounded" value="Guardar" name="btnGuardar" style="margin-left: 50%;" type="submit">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section> 
</body>
</html>

<?php
    include_once ('../Entidades/User.php'); 
    include_once ('../Util/Util.php'); 
    require_once ('../logicaDatos/userDatos.php'); 

    if(isset($_POST['btnGuardar'])){
        obtener_datos(); 
    }


    function obtener_datos(){
        $user = new User(); 
        $user->nombre = $_POST['txtNombre'];
        $user->cedula = $_POST['txtCedula'];
        $user->correo = $_POST['txtCorreo']; 
        $user->telefono = $_POST['txtCorreo']; 
        $user->direcion = $_POST['txtDirecion']; 
        $user->username=$_POST['txtUsername'];
        $user->password = $_POST['txtPass']; 
        $user->tipo = 'cl';
        $repass = $_POST['txtRePass']; 
        if(confirmar_password($user->password, $repass)){
          if(guardar_user($user)){
             alert("Se guardaron sus datos exitosamente!");
             header('Location: /GUI/index.php?status=Inicio sección&message=Ingresa');
          }
          alert("Este nombre de usuario ya esta en uso, intente creando uno nuevo"); 
        }else{
            alert('La confirmación de contraseña es invalida, intente de nuevo'); 
        }
        
    }

    function confirmar_password($pass, $rePass){
        $isOkay = $pass==$rePass?true:false; 
        return $isOkay; 
    }
?>