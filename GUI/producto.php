<?php
    if(isset($_GET['id'])){
        $mesa = $_GET['message'];
        $id_categoria = $_GET['id']; 
        switch ($mesa) {
            case 'add':
                # code...
                break;
            case 'edit':
            default:
                # code...
                break;
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.2/css/bulma.min.css"/>


</head>
<body>
    <section>
        <div class="container">
            <div class="columns">
                <div class ="column">
                    <input class="" placeholder="Nombre" name ="txtNombre" type="text"><br><br>
                    <input class="" placeholder="Descripción" name ="txtNombre" type="text"><br><br>
                    <input class="" placeholder="Imagen" name ="txtNombre" type="text"><br><br>
                    <input class="" placeholder="Stock" name ="txtNombre" type="text"><br><br>
                    <input class="" placeholder="Precio" name ="txtNombre" type="text"><br><br>
                    <input class="" placeholder="Cantidad" name ="txtNombre" type="text"><br><br>
                    <input class="" value="Cancelar" name="btnVolver" type="submit">
                    <input class="" value="Guardar" name="btnAddProducto" type="submit">
                </div>
            </div>
        </div>
    </section>
</body>
</html>