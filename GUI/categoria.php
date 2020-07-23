<?php
    session_start(); 
    if(isset($_GET['message'])){
        switch ($_GET['message']) {
            case 'edit':
                $_SESSION['id_categoria_editar'] = intval($_GET['id_editar_cate']); 
                break;
            default:
                unset($_SESSION['id_categoria_editar']);
                break;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categoria</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.2/css/bulma.min.css"/>
    <link   rel="stylesheet" href="../CSS/cantidad.css">
</head>
<body>
    <form action="categoria.php" method="POST">
    <section>
        <div class="container">
            <div class="columns">
                <div class="column is-half is-offset-one-quarter" id="idMain">
                <img style="margin-left:35%;" src="../Imagenes/category.png">
                   <?php
                        $btnName = "btnAddCategoria"; 
                        $btnValue ="Guardar";
                        if(isset($_SESSION['id_categoria_editar'])){
                            include_once ('../logicaDatos/categoriaDatos.php'); 
                            $cat = categoria_x_id($_SESSION['id_categoria_editar']); 
                            $btnName = "btnEditCategoria"; 
                            $btnValue ="Editar";
                        }   
                        $nombre = trim(isset($cat[0]->nombre)? ($cat[0]->nombre): "","");  

                   ?> 
                    <div class="column is-half is-offset-one-quarter">
                        <input type="text" value="<?php echo ("$nombre")?>" class="input is-primary" placeholder="Nombre categoria" name="txtCategoria"><br><br>
                        <input style="margin-left:10%;" type="submit" class="button is-info" name="btnCancelar" value="Volver">
                        <input  style="margin-left:10%;"type="submit" class="button is-success" name="<?php echo("$btnName")?>" value="<?php echo ("$btnValue");?>">

                    </div>
                </div>
            </div>
        </div>
    </section>
</form>
</body>
</html>

<?php
    include_once ('../logicaDatos/categoriaDatos.php'); 
    include_once ('../Util/Util.php'); 
    if(isset($_POST['btnAddCategoria'])){
        $cat = new Categoria();
        $cat->nombre = trim($_POST['txtCategoria']); 
        if(guardar_categoria($cat)){
            header('Location: /GUI/admin.php?status=Inicio sección&message=Se guardo con exitó una categoria!');
        }else{
            alert("No se puede guardar esta categoria, es probable que ya exista una con este nombre. Guardé una nueva");
        }
    }

    if(isset($_POST['btnEditCategoria'])){
        $cat = new Categoria();
        $cat->id = $_SESSION['id_categoria_editar']; 
        $cat->nombre = trim($_POST['txtCategoria']); 
        if(editar_categ($cat)){
            unset($_SESSION['id_categoria_editar']);
            header('Location: /GUI/admin.php?status=Inicio sección&message=Se edito con exitó una categoria!');
        }else{
            alert("No se puede editar esta categoria, es probable que ya exista una con este nombre. Utilice una nueva");
        }
    }

    if(isset($_POST['btnCancelar'])){
           header('Location: /GUI/admin.php?status=Vista administración'); 
    }


?>