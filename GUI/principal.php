<?php
    session_start(); 
   // var_dump("SECCION cLIENTES ".$_SESSION['user']);
    if($_SESSION && $_SESSION['user']){
        include_once ('../Entidades/User.php'); 
        $user = new User();
        $user= unserialize($_SESSION['user']);
        if($user->tipo != "cl"){
            header('Location: /GUI/index.php?status=Inicio');
        }
    }else{
        header('Location: /GUI/index.php?status=Inicio');
    } 

    
    unset($_SESSION['isFirst']);
    unset($_SESSION['cantidad']);
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
        <div id="divLeft"><br>
            <label> <?php 
                $user = new User(); 
                $user =$_SESSION['user'];
                $user =unserialize($user);  
                $nombre = $user->nombre;
                echo "    $nombre";?> </label>  
            <br>
            <ul class="menu-list"> 
                <li><a id="aList" href="#divProductos" >Productos</a></li> 
                <li><a id="aList" href="#divCarrito" >Mi carrito</a></li> 
                <li><a id="aList" href="#divCompras" >Mis compras</a></li>
            <ul>
            <input class="button is-outlined is-small is-danger is-rounded" type="submit" name="btnSalir" value="Cerrar Seción">
        </div>
        <div id="divRight">
            <div id="divProductos">
            <br> 
                <div class="field" style="margin-left:25%;">
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
                </div> 
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
                              
                                $listaCarro =  mostrar_productos_x_carro(intval($user->id));
                                $listaCostos = array(); 
                                if($listaCarro){
                                    $txt =""; 
                                foreach($listaCarro as $c){
                                    foreach($c->listaProductos as $p){
                                        $img = base64_encode($p->imagen); 
                                        $cantidades = datos_cantidades($p->id, $user->id); 
                                        $costo = $cantidades[0][4]; 
                                        array_push($listaCostos, $costo); 
                                        $txt.= "
                                            <tr>
                                                <td>$p->nombre</td>
                                                <td>$p->descripcion</td>
                                                <td><img src='data:/image/jpg;base64,$img'/></td>
                                                <td>$p->stock</td>
                                                <td>$p->precio</td>
                                                <td> $c->cantidad</td>
                                                <td> ₡$costo</td>
                                                <td><a href='../logicaDatos/carroDatos.php?id_car=$c->id&&id_pro=$p->id'>Descartar</a></td>
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
             <?php
                $total = 0;
                foreach($listaCostos as $costo){
                    $total+= $costo; 
                }
                if(!$listaCarro){
                    echo ("Sin registros!!<br>"); 
                }

             ?>
            <label>Total a pagar <?php echo("₡$total")?></label>
            <input style="left:4%;" name="btnPagar" class="button is-outlined is-small is-danger " value="Pagar" type="submit">
        </div>
        </div>
        <div id="divCompras">
            <h2>Sus compras realizadas</h2>
            <table class="table"  style="width:'500px';">
                <tr> 
                    <th>Imagen</th>
                    <th>Producto</th>
                    <th>Fecha de compra</th>
                    <th>Cantidad comprada</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Pagó</th>
                    <th>Quitar</th> 
                    <th>Ver orden</th> 

                </tr>
                <tbody>
                    <?php
                        include_once ('../logicaDatos/compraDatos.php');
                        $listaCompras = ver_compras($user->id); 
                        if($listaCompras){
                            $txt = "";
                            foreach ($listaCompras as $c) {
                                $img = base64_encode($c->imagen); 
                                $txt.= "
                                <tr>
                                    <td><img height='60px' width='50px'src='data:/image/jpg;base64,$img'/></td>
                                    <td>$c->nombre</td>
                                    <td>$c->fecha_compra</td>
                                    <td>$c->cantidad</td>
                                    <td>$c->descripcion</td>
                                    <td>₡$c->precio</td>
                                    <td>₡$c->costo</td>
                                    <td><a>Quitar</a></td>
                                    <td><a>Ver detalles</a></td>
                                </tr>
                                ";
                            }
                            echo ($txt); 
                        }
                    ?>
                </tbody>
            </table>    
        </div>
    </div>
</form> 
</section>
</body>
</html>

<?php
    include_once ('../Util/Util.php'); 
    
    if(isset($_POST['btnSalir'])){
        include_once ('../logicaDatos/logout.php'); 
        destruir_session(); 
    }
    if(isset($_POST['btnPagar'])){
        include_once ('../logicaDatos/compraDatos.php');
        if($listaCarro){
            $id_carro = $listaCarro[0]->id; 
            $listPr = array();
            foreach ($listaCarro as $c) {
                foreach ($c->listaProductos as $p){
                    array_push($listPr,$p);
                }
            }
            generar_compra($id_carro, $listPr,$user,$cantidades);
            alert ("Su compra se realizo correctamente");
            header('Location:'.$_SERVER['PHP_SELF']); 
        }else{
            alert ("Sin productos en el carrito para pagar");
        }
    }
?>

