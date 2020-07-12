<?php

    require_once ('../Entidades/Categoria.php'); 
    require_once ('../BaseDatos/CategoriaBD.php'); 


    delete();
    function delete(){
        if(isset($_GET['id'])){
            eliminar_categoria($_GET['id']); 
        }
    }
        
    function guardar_categoria(){
        //atrapar datos 
        $categoria = new Categoria(); 

        $categoria->nombre ="Productos domesticos"; 
        if(insertar_categoria($categoria)){
            header('Location: /GUI/admin.php?status=Inicio sección&message=Se guardo con exitó una categoría!');
        }
    }

    function mostrar_categorias(){
        if(get_categorias()){
            return get_categorias(); 
        }
    }

    function eliminar_categoria($id){
        if(delete_categoria($id)){
            header('Location: /GUI/admin.php?status=Admin&message=Se eliminó la categoría con exitó');
        }
    }

?>