
<?php
    include_once ('../Entidades/Producto.php'); 
    include_once ('../BaseDatos/productoBD.php');

    /**
     * Valida la llegada del id producto correctamente
     */
    if(isset($_GET['id'])){
        if(eliminar_producto($_GET['id'])){
          header('Location: /GUI/admin.php?status=Inicio sección&message=Se elimino con exitó un producto!');
        } 
    }   
    /**
     * Elimina producto
     */
    function eliminar_producto($id){
       return delete_producto($id);
    }
    /**
     * Guarda producto
     */
    function guardar_producto($p){
        is_datos_vacios($p); 
        $p->imagen = convert_image($p->imagen); 
        return insertar_producto($p);
    }
    /**
     * Muestra producto por id
     */
    function mostrar_producto($id){
        return get_producto($id); 
    }
    /**
     * Muestra producto por categoria
     */
    function productos_x_cat($id_categoria){
        return mostrar_productos_x_categoria($id_categoria);
    }
    /**
     *Edita producto
     */
    function editar_producto($p){
        is_datos_vacios($p); 
        $p->imagen = convert_image($p->imagen); 
        return modificar_producto($p); 
    }
    /**
     *Convierte url de la imagen obtenida a imagen en bits
     */
    function convert_image($str_imagen){
        return addslashes(file_get_contents($str_imagen)); 
    }
    /**
     *Validad que los datos no esten vacíos
     */
    function is_datos_vacios($p){
        if(empty($p->nombre)){
            throw new Exception("El nombre del producto no puede quedar vacío"); 
        }

        if(empty($p->descripcion)){
            throw new Exception("La descripcion no debe quedar vacía"); 
        }

       if(empty($p->imagen)){
            throw new Exception("Agregue una imagen a este producto"); 
        }

        if(empty($p->stock)){
            throw new Exception("El stock debe estar lleno"); 
        }

        if(empty($p->precio) || ($p->precio)<=0){
            throw new Exception("El precio debe ser mayor a 0 y no debe estar vacía"); 
        }
     
    }
?>