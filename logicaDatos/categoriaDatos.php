<?php

    require_once ('../Entidades/Categoria.php'); 
    require_once ('../BaseDatos/CategoriaBD.php'); 


    delete();
    function delete(){
        if(isset($_GET['id'])){
            eliminar_categoria($_GET['id']); 
        }
    }

    function editar_categ($categoria){
        return editar_categoria($categoria); 
    }
        
    function guardar_categoria($categoria){
        return insertar_categoria($categoria); 
    }

    function mostrar_categorias(){
        if(get_categorias()){
            return get_categorias(); 
        }
    }

    function categoria_x_id($id){
        return mostrar_categoria($id);
    }

    function eliminar_categoria($id){
        if(mostrar_categoria($id)[0]->listaProductos==NULL){
           if(delete_categoria($id)){
              header('Location: /GUI/admin.php?status=Admin&message=eliminó');
            }
        }else{
            header('Location: /GUI/admin.php?status=Admin&message=error prod');
        }
    }

?>