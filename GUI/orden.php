
<?php
    if(isset($_GET['id_compra'])){
        include_once ('../logicaDatos/compraDatos.php');
        $compra = traer_compra($_GET['id_compra']);
    }else{
        echo("No modifique el link, estos errores es por alteración de links");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orden de compra</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.2/css/bulma.min.css"/>
    <link rel="stylesheet" href="../CSS/orden.css"/>

</head>
<body>
    <section>
    <form action="orden.php" method="POST">    
        <div class="container">
            <div class="columns">
                <div class="column is-half is-offset-one-quarter" id="center">
                    <div id="id_head">
                        <img height='60px' width='50px' src="../Imagenes/show_info.png"><br>
                        <strong>Tienda Online de compras</strong><br><br>
                    </div>
                    <?php
                        $nombre = trim(isset($compra->nombre)? ($compra->nombre): "",""); 
                        $fecha = trim(isset($compra->fecha_compra)? ($compra->fecha_compra): "","");  
                        $cantidad = trim(isset($compra->cantidad)? ($compra->cantidad): "","");  
                        $precio = trim(isset($compra->precio)? ($compra->precio): "","");  
                        $costo = trim(isset($compra->costo)? ($compra->costo): "","");  
                        $descripcion = trim(isset($compra->descripcion)? ($compra->descripcion): "","");  


                    ?>

                    <div id="id_text"> 
                        <label >Producto comprado: <?php echo "$nombre";?></label><br><br>
                        <label >Fecha de Compra:   <?php echo "$fecha";?> </label><br><br>
                        <label >Cantidad comprada: <?php echo "$cantidad";?></label><br><br>
                        <label >Valor por uniddad: ₡<?php echo "$precio";?></label><br><br>
                        <label >Total a pagar:     ₡<?php echo "$costo";?></label><br><br>
                        <label >Descripción:       <?php echo "$descripcion";?></label><br><br>
                        <input style="margin-left:30%;" type="submit" class="button is-info" name="btnVolver" value="Volver">

                    </div>    
                </div>
            </div>
        </div>
    </form>
    </section>
</body>
</html>

<?php

    if(isset($_POST['btnVolver'])){
        header('Location: /GUI/principal.php?status=principal&message=Bienvenido');
    }
?>