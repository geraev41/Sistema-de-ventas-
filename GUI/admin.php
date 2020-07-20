<?php
    session_start(); 
    if(!$_SESSION && !$_SESSION['user']) {
        header ('Location: /GUI/index.php?status=Inicio'); 
    }   
    include_once ('../Util/Util.php');
    if(isset($_GET['message'])){ 
        switch ($_GET['message']) {
            case 'error prod':
                    alert ("No puede eliminar una categoria con productos asociados");
                break;
            case 'eliminó':
                alert ("Se elimino con exitó!");
                break;
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
    <title>Administrador</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.2/css/bulma.min.css"/>
    <link rel="stylesheet" href="../CSS/admin.css"/>

</head>
<body>
   <form action="admin.php" method="POST"> 
    <section>
            <div id="container">    
                <div id="divLeft">
                    <br><br>
                    <ul class="menu-list"> 
                    <li><a id="aList" href="#divCategorias">Categorias</a> </li>
                    <li><a id="aList" href="#divProductos" >Productos</a></li>
                    <li><a id="aList" href="#divClientes" >Clientes</a></li>
                    <ul>
                    <a href ="../logicaDatos/logout.php"id="idBtn" class="button is-outlined is-small is-danger">Cerrar Sección<a>
                </div>

                <div id="divRight">
                    <div id="divCategorias">
                        <table class="table">
                            <tr> 
                                <th>Nombre Categoria</th>
                                <th>Agregar Producto</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                            </tr>
                            <tbody> 
                                <?php
                                      include ('../logicaDatos/categoriaDatos.php'); 
                                      if(mostrar_categorias()!=NULL){
                                        foreach(mostrar_categorias() as $cat){
                                            echo 
                                            "
                                            <tr>
                                                <td>$cat->nombre</td>
                                                <td><a href='producto.php?id_receive=$cat->id&&message=add'>Agregar Producto</a></td>
                                                <td><a href='categoria.php?id_editar_cate=$cat->id&&message=edit'>Editar</a></td>
                                                <td><input  class='button is-outlined is-small is-danger is-rounded' onclick='eliminarCat($cat->id);'type='button' value='Eliminar'></td>
                                            </tr>
                                            "; 
                                        }
                                    }else{
                                        echo ("Sin registros!!"); 
                                    }
                                ?>
                            </tbody>                          
                        </table>     
                    <a href="categoria.php" style="margin-left:5%;" name="btnCategoriaNew" class="button is-outlined is-small is-danger ">Agregar Nueva Categoria</a><br><br>
                    </div>
                    <div id="divProductos">
                        <br>
                        <div class="field">
                            <div class="control">
                                <div class="select is-info ">
                                    <select name="select"  onchange="this.form.submit()">
                                        <option selected disabled>Selecione una categoria    </option>
                                            <?php
                                                $categorias = mostrar_categorias(); 
                                                if($categorias){
                                                    $txt = "";
                                                    foreach($categorias as $c){
                                                            $txt.= "<option value='$c->id'>$c->nombre </option>"; 
                                                    }
                                                    echo "$txt"; 
                                                }
                                            ?>

                                    </select>  
                                </div>
                            </div>
                        </div> 

                        <table class="table">
                            <tr> 
                                <th>Imagen</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Stock</th>
                                <th>Precio</th>
                                <th>Editar</th>
                                <th>Eliminar</th>

                            </tr>
                            <tbody>
                                <?php
                                include_once ('../Util/Util.php');
                                include_once ('../logicaDatos/productoDatos.php'); 

                                    if(isset($_POST['select'])){
                                    $productos =productos_x_cat(intval($_POST['select']));
                                    if($productos){
                                        $txt = ""; 
                                            foreach($productos as $p){
                                                $img = base64_encode($p->imagen); 
                                                $txt.= "
                                                    <tr>
                                                        <td><img src='data:/image/jpg;base64,$img'/></td>
                                                        <td>$p->nombre</td>
                                                        <td>$p->descripcion</td>
                                                        <td>$p->stock</td>
                                                        <td>$p->precio</td>
                                                        <td><a href='producto.php?id_receive=$p->id&&message=edit'>Editar <img src='../Imagenes/edit.png'></a></td>
                                                        <td><input  class='button is-outlined is-small is-danger is-rounded' onclick='eliminar($p->id);'type='button' value='Eliminar'></td>

                                                    </tr>
                                                ";
                                            }
                                            echo ($txt); 
                                    }
                                    }
                                ?>
                            </tbody>
                        </table> 
                    </div>
                    <div id="divClientes">
                        <table class ="table">
                            <tr> 
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Teléfono</th>
                                <th>Dirección</th>
                            </tr>
                            <tbody>
                                <?php
                                    include_once ('../logicaDatos/userDatos.php');
                                    $clientes = mostrar_usuarios(); 
                                    if($clientes){
                                        foreach($clientes as $c){
                                            echo"
                                                <tr>
                                                    <td>$c->nombre</td>
                                                    <td>$c->correo</td>
                                                    <td>$c->telefono</td>
                                                    <td>$c->direcion</td>
                                                </tr>
                                            ";
                                        }
                                        $cant = count($clientes);
                                        echo"<br> Total de clientes registrados $cant";
                                    }else{
                                        echo("Sin clientes registrados");
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
    </section>
    <script type="text/javascript">
        function eliminar(id){
            if(confirm("¿Realmente esta seguro de querer eliminar este producto?")){
                window.location.href= "../logicaDatos/productoDatos.php?id="+id; 
            }
        }

        function eliminarCat(id){
            if(confirm("¿Realmente esta seguro de querer eliminar esta categoria?")){
                window.location.href= "../logicaDatos/categoriaDatos.php?id="+id; 
            }
        }
    </script>
</form>
</body>
</html>

<?php
    if(isset($_POST['btnSalir'])){
        include_once ('../logicaDatos/logout.php'); 
        include_once ('../Util/Util.php'); 

        destruir_session(); 
    }

    
?>

