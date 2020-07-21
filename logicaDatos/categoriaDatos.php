<?php

    require_once ('../Entidades/Categoria.php'); 
    require_once ('../BaseDatos/CategoriaBD.php'); 


    delete();
    /**
     * Valida la llegada del id correctamente
     */
    function delete(){
        if(isset($_GET['id'])){
            eliminar_categoria($_GET['id']); 
        }
    }
    /**
     * Edita una categoria
     */
    function editar_categ($categoria){
        return editar_categoria($categoria); 
    }
    /**
     * Guarda una categoria
     */
    function guardar_categoria($categoria){
        return insertar_categoria($categoria); 
    }
     /**
     * Muestra categorias
     */
    function mostrar_categorias(){
        if(get_categorias()){
            return get_categorias(); 
        }
    }

     /**
     * Muestra una categoria por id
     */
    function categoria_x_id($id){
        return mostrar_categoria($id);
    }
    /**
     * Elimina una categoria, y redireciona a la pagina original
     */
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