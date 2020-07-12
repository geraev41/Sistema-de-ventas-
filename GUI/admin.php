
<?php

    session_start(); 
    if($_SESSION && !$_SESSION['user']) {
        header ('Location: /GUI/index.php?status=Inicio'); 
    }   
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.2/css/bulma.min.css"/>
    <link rel="stylesheet" href="../CSS/admin.css">
</head>
<body>
    <section class="section">
        <form method="POST" action="../logicaDatos/userDatos.php">
            <div class="container">
                <div class="columns">   
                    <div class="">
                       <div class="" style="width: 100%; border: red solid 1px;"> Sistema de ventas</div>
                       <input class="button is-outlined is-small is-danger is-rounded" value="Salir" name="btnLogout" style="margin-left: 50%;" type="submit">
                    <input class="button is-outlined is-small is-danger is-rounded" value="Guardar Categoria" name="btnGuardarCategoria" style="margin-left: 50%;" type="submit">
                    <side  class="menu">
                        <p class="menu-label">Categorias</p>
                   <?php
                    include ('../logicaDatos/categoriaDatos.php'); 
                    if(mostrar_categorias()!=NULL){
                        foreach(mostrar_categorias() as $cat){
                            echo 
                            "
                            <nav><ul class='menu-list' id='idUl'>
                                <li >
                                    <a > $cat->nombre 
                                        <a href='producto?id=$cat->id &&message=add'><img src='../Imagenes/add.png'></a>
                                        <a ><img src='../Imagenes/edit.png'></a>
                                        <a href='../logicaDatos/categoriaDatos?id=$cat->id'><img src='../Imagenes/delete2.png'></a>
                                        <ul class ='menu-list'>
                                            <li style='display:inline-block;'>
                                               <a  style='display: inline;'> Nombre Producto<a/>
                                               <a  style='display: inline;'> <img src='../Imagenes/edit.png'></a>
                                               <a  style='display: inline;'> <img src='../Imagenes/delete2.png'></a>
                                            </li>
                                       </ul>
                                    </a>
                                </li>
                            </ul></nav>
                            "; 
                        }
                    }else{
                        echo ("Sin registros!!"); 
                    }
                   ?> 
                    </side>
                    </div>
                </div>
            </div>
        </form>
    </section>    
</body>
</html>

<?php
    if(isset($_POST['btnAddCategory'])){
        echo("Hola"); 
    }
?>