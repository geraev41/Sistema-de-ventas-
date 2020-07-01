<?php
    $msj = ""; 
    alert($_REQUEST['message']); 
    
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
                        <input class="input is-primary" type="text" placeholder="Nombre de usuario" name="txtUser"><br><br>
                        <input class="input is-primary"  type="password" placeholder="Contraseña" name="txtPass"><br><br>
                        <input class="button is-outlined is-medium is-danger is-rounded" value="Iniciar Sección" name="btnOk" style="margin-left: 50%;" type="submit">
                        <input class="button is-outlined is-medium  is-success is-rounded" value="Salir" name="btnSalir" style="margin-left: 30%;" type="submit">
                   </div>

                </div>
            </div>
        </form> 
    </section>
</body>
</html>