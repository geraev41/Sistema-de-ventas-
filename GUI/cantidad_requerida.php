

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cantidad</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.2/css/bulma.min.css"/>
   <link   rel="stylesheet" href="../CSS/cantidad.css">
</head>
<body>
   <form action="cantidad_requerida.php" method="POST"> 
    <section>
        <div class="container">
            <div class="columns">
               <div id="idCenter" class = "column is-half
                is-offset-one-quarter"><br><br>
                <div class = "column is-half
                is-offset-one-quarter">
                <?php
                    include_once ('../logicaDatos/productoDatos.php'); 
                    $p = mostrar_producto(intval($_GET['id_producto']));

                ?> 
                   <label>Producto <?php echo("$p->nombre");?></label><br>
                   <label>Cantidad disponible <?php echo("$p->stock");?></label><br>
                   <label>Precio por unidad <?php echo("$p->precio");?></label><br><br>
                    <input type="number" min="1"  max="<?php echo("$p->stock");?>" value="<?php echo "" ?>"><br><br>

                    <input class="button is-outlined is-small is-danger is-rounded" type="submit" value="Calcular costo" name="btnCalcular"><br><br>
                   <label>Costo<?php echo("Calcular");?></label><br><br>
                   <input class="button is-outlined is-small is-danger is-rounded"type="submit" value="Guardar Cambios" name="btnGuardar"><br><br>
                   <input class="button is-outlined is-small is-danger is-rounded" type="submit" value="Regresar" name="btnRegresar"><br><br>
                </div>

               </div>
            </div>
        </div>
    </section>
</form> 
</body>
</html>
<?php
    if(isset($_POST['btnRegresar'])){
        header('Location: /GUI/principal.php?status=principal&message=Bienvenido');
    }
?>
