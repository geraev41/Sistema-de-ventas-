<?php
    ob_start(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Principal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.2/css/bulma.min.css"/>
    <link rel="stylesheet" href="../CSS/principal.css"/>

</head>
<body>
    <section> 
        <form action="principal.php" method="POST">
    <div id="container">   
        <div id="divLeft">
            <br><br>
           <a href="#divProductos" class="button is-outlined is-small is-danger is-rounded">Productos</a> 
           <a href="#divCarrito" class="button is-outlined is-small is-danger is-rounded">Mi carrito</a> 
        </div>

        <div id="divRight">
            <div id="divProductos">
            <div class="field">
                <div class="control">
                    <div class="select is-info ">
                        <select name="select"  onchange="this.form.submit()">
                            <option selected disabled>Selecione una categoria</option>
                            <?php
                                include_once ('../logicaDatos/categoriaDatos.php'); 
                                $categorias = mostrar_categorias(); 
                                if($categorias){
                                    foreach($categorias as $c){
                                            $txt.= "<option value='$c->id'>$c->nombre </option>"; 
                                    }
                                    echo "$txt"; 
                                }
                           ?>
                         
                        </select>  
                    </div>
                </div>
            </div> <br><br>


             <table class="table">
                <tr> 
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Imagen</th>
                    <th>Stock</th>
                    <th>Precio</th>
                    <th>Aciones</th>

                   <th style='visibility: hidden;'>id</th>
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
                                        <td>$p->nombre</td>
                                        <td>$p->descripcion</td>
                                        <td><img src='data:/image/jpg;base64,$img'/></td>
                                        <td>$p->stock</td>
                                        <td>$p->precio</td>
                                        <td><a href='../logicaDatos/carroDatos.php?id=$p->id'><img height='20px' width='20px' src='../Imagenes/car.png'/>Añadir Carrito</a></td>
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
                
                <div id="divCarrito">
                <table class="table">
                <tr> 
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Imagen</th>
                    <th>Stock</th>
                    <th>Precio</th>
                    <th>cantidad</th>
                    <th>Costo</th>
                    <th>Eliminar</th>
                    <th>Confirmar Cambios</th>
                </tr>
                <tbody>
                <?php
                include_once ('../Util/Util.php');
                include_once ('../logicaDatos/carroDatos.php'); 
                include_once ('../Entidades/User.php'); 
                    session_start(); 
                    $user = new User(); 
                    $user = $_SESSION['user']; 

                    $listaCarro =  mostrar_productos_x_carro(intval($user->id));
                       
                    if($listaCarro){
                        $txt =""; 
                    foreach($listaCarro as $c){
                        foreach($c->listaProductos as $p){
                            $img = base64_encode($p->imagen); 
                            $txt.= "
                                <tr>
                                    <td>$p->nombre</td>
                                    <td>$p->descripcion</td>
                                    <td><img src='data:/image/jpg;base64,$img'/></td>
                                    <td>$p->stock</td>
                                    <td>$p->precio</td>
                                    <td> $c->cantidad</td>
                                    <td>Costo</td>
                                    <td><a>Descartar</a></td>
                                    <td><a href='cantidad_requerida.php?id_producto=$p->id'>Hacer cambios</a></td>
                                </tr>
                            ";
                        }
                    }
                    echo ($txt); 
                } 
                ?>
                </tbody>
             </table><br> 
            <label>Total a pagar <?php echo("2000");?></label>
             <input style="left:4%;" name="btnPagar" class="button is-outlined is-small is-danger " value="Pagar" type="submit">
                </div>
        </div>
    </div>
    </form> 
    </section>
</body>
</html>

<?php
    include_once ('../Util/Util.php'); 
    include_once ('../logicaDatos/carroDatos.php');
       

      // header('Location: /logicaDatos/carroDatos.php?cant='.$can.'&&id_pr='.$id);
?>

