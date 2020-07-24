<?php
    session_start(); 
    if(isset($_GET['id_producto'])){
        $_SESSION['id_cambiar_producto'] = $_GET['id_producto']; 
    }
?>

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
                    include_once ('../Util/Util.php'); 
                    include_once ('../logicaDatos/productoDatos.php'); 
                    include_once ('../logicaDatos/carroDatos.php'); 
                    include_once ('../Entidades/User.php'); 
                    include_once ('../Entidades/Carro.php'); 

                    $id_producto = intval($_SESSION['id_cambiar_producto']);
                    $user = new User(); 
                    $user = $_SESSION['user']; 
                    $user = unserialize($user); 
                    $p = mostrar_producto($id_producto);
                    $cantidades = datos_cantidades($p->id, $user->id); 
                    if(!isset($_SESSION['isFirst'])){
                        $_SESSION['isFirst'] = true; 
                        $_SESSION['cantidad'] = $cantidades[0][3]; 
                    }
                    $cant = $cantidades[0][3]; 
                    $valor = $cantidades[0][4]; 
                ?> 

                   <label>Producto <?php echo("$p->nombre");?></label><br>
                   <label>Cantidad disponible <?php echo("$p->stock");?></label><br>
                   <label>Precio por unidad <?php echo("$p->precio");?></label><br><br>
                   <input type="number" name="txtCantidad" min="1"  max="<?php echo("$p->stock");?>" value="<?php echo ("$cant"); ?>"><br><br>
                   <label>Costo (Sin guardar cambios) <?php echo("₡ $valor");?></label><br><br>
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
        calcular(true,$p,$id_producto,$user); 
        unset($_SESSION['isFirst']);
        unset($_SESSION['cantidad']);
        header('Location: /GUI/principal.php?status=principal&message=Bienvenido');
    }
 

    if(isset($_POST['btnGuardar'])){
        if(calcular(false,$p,$id_producto,$user)){
            unset($_SESSION['isFirst']);
            unset($_SESSION['cantidad']);
            header('Location: /GUI/principal.php?status=principal&message=Modificado');
        }
    }
    /**
     * $isEdit si es editar, obtiene la cantidad de la session, si no del POST
     * $id_producto id del producto
     * $user usuario en la sección
     */
    function calcular($isEdit,$p,$id_producto,$user){
        $cantidad = $isEdit?$_SESSION['cantidad']:$_POST['txtCantidad']; 
        $valor = $p->precio; 
        $id_producto = intval($_SESSION['id_cambiar_producto']);
        if(!empty($cantidad)){
            $total = $cantidad*$valor;
            $carro = new Carro(); 
            $carro->cantidad= $cantidad;
            $carro->total= $total;
            $carro->id_producto = $id_producto; 
            $carro->id_usuario= $user->id;
            return modificar_cantidades($carro); 
        }else{
            alert("No puede dejar vacío los datos");
        }
    }

?>
