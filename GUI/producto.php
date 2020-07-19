<?php

ob_start(); 
    session_start();
    if(isset($_GET['id_receive'])){
        $mesa = $_GET['message'];
        switch ($mesa) {
            case 'add':
                unset($_SESSION['id_producto']); 
            $_SESSION['id_categoria'] =$_GET['id_receive'];
                # code...
                break;
            case 'edit':
            $_SESSION['id_producto'] =$_GET['id_receive'];
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
        <form method="post" action="producto.php" enctype="multipart/form-data">
            <div class="container">
                <div class="columns">
                    <div class ="column">
                       <?php 
                            include_once ('../logicaDatos/productoDatos.php');
                            $btnName = "btnAddProducto"; 
                            $btnValue ="Guardar";
                            if(isset($_SESSION['id_producto'])){
                                $p = mostrar_producto($_SESSION['id_producto']);
                                $btnName = "btnEditProducto"; 
                                $btnValue ="Editar";
                            }
                           // <?php if(isset($p->nombre)){echo "$p->nombre";}?
                           if(!isset($_SESSION['id_categoria'])){
                               $_SESSION['id_categoria'] = $p->id_categoria; 
                           }
                           $nombre = trim(isset($p->nombre)?($p->nombre):"",""); 
                           $descrip = trim(isset($p->descripcion)?($p->descripcion):"",""); 
                           $image = base64_encode(trim(isset($p->imagen)?($p->imagen):"","")); 
                           $stock = trim(isset($p->stock)?($p->stock):"",""); 
                           $precio = trim(isset($p->precio)?($p->precio):"","");
                           


                       ?> 
                        <input class="" placeholder="Nombre" name ="txtNombre" type="text" value="<?php echo ("$nombre")?>"><br><br>
                        <input class="" placeholder="Descripción" name ="txtDescrip" type="text" value="<?php echo ("$descrip")?>" ><br><br>
                        <input class="" placeholder="Imagen" name ="Image" type="file"><br><br>
                        <img height="600px" width="500px" src="data:/image/jpg;base64,<?php echo $image?>" >
                        <br><br>
                        <input class="" placeholder="Stock" name ="txtStock" type="text" value="<?php echo ("$stock")?>"><br><br>
                        <input class="" placeholder="Precio" name ="txtPrecio" type="text" value="<?php echo ("$precio")?>"><br><br>
                        <input class="" value="Regresar" name="btnVolver" type="submit">
                        <input class="" value="<?php echo("$btnValue")?>" name="<?php echo("$btnName")?>" type="submit">
                    </div>
                </div>
            </div>
        </form>
    </section>
</body>
</html>
<?php
    include_once ('../Util/Util.php');

    if(isset($_POST['btnVolver'])){
        header('Location: /GUI/admin.php?status=Inicio sección&message=Admin');
    }

    if(isset($_POST['btnAddProducto'])){
        get_datos(false); 
    }

    if(isset($_POST['btnEditProducto'])){
        get_datos(true);
    }

    function get_datos($isEdit){
        include_once ('../Entidades/Producto.php');
        $p = new Producto();
        $p->id_categoria = $_SESSION['id_categoria'];
        $p->nombre = $_POST['txtNombre'];
        $p->descripcion = $_POST['txtDescrip'];
        $p->imagen =  $_FILES['Image']['tmp_name']; 
        $p->stock = $_POST['txtStock'];
        $p->precio =$_POST['txtPrecio'];
        if(!$isEdit){
            validar_datos($p);
        }else{
            $p->id = $_SESSION['id_producto']; 
            editar_datos($p);
        }
    }

    function validar_datos($p){
        try {
            include_once ('../logicaDatos/productoDatos.php');
            if(guardar_producto($p)){

                alert("Se guardo con exitó el producto");
                header('Location: /GUI/admin.php?status=Inicio sección&message=Se guardo con exitó un producto!');
            }else{
             alert("Surgio un error, intente otra vez");
            }
        } catch (Exception $e) {
            alert($e->getMessage());
        }
    }

    function editar_datos($p){
        try {
            include_once ('../logicaDatos/productoDatos.php');
            if(editar_producto($p)){
                header('Location: /GUI/admin.php?status=Inicio sección&message=Se edito con exitó un producto!');
            }else{
             alert("Surgio un error, intente otra vez");
            }
        } catch (Exception $e) {
            alert($e->getMessage());
        }
    }

  

?>