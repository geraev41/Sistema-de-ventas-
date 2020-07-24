<?php
    
    require_once ('../Entidades/Categoria.php'); 
    include_once ('productoBD.php'); 

    /**
     * $categoria categoria a guardar en la base datos
     * inserta una categoria a la base datos
     */
    function insertar_categoria($categoria){
        if(categoria_x_nombre($categoria, true)){
            $con = getConexion(); 
            $sql  = "INSERT INTO categoria(nombre) VALUES ('$categoria->nombre')"; 
            $result = $con->query($sql);
            if($con->connect_errno){
                $con->close(); 
                return false; 
            }
            $con->close(); 
            return $result; 
        }
        return false;
    }
    /**
     * $id id de la categoria
     * elimina la categoria de la base datos
     */
    function delete_categoria($id){
        include_once ('conexion.php');
        $con = getConexion(); 
        $sql = "DELETE FROM `categoria` WHERE id = $id"; 
        $result = $con->query($sql);
        if($con->connect_errno){
            $con->close(); 
            return false; 
        }
        $con->close(); 
        return $result; 
    }
    /**
     * obtiene todas las categorias disponibles
     */
    function get_categorias(){
        include_once ('conexion.php');
        $con = getConexion(); 
        $sql = "SELECT * FROM categoria"; 
        $result = $con->query($sql); 

        if($con->connect_errno){
            $con->close(); 
            return false; 
        }
        $get_categ = array(); 
        $categorias = $result->fetch_all();
        foreach($categorias as $c){
            array_push($get_categ, obtener_categoria($c)); 
        }  
        $con->close(); 
        return $get_categ; 
    }
    /**
     * $categoria categoria a busccar por nombre
     * $isSave true, si es para guardar o false si es solo para buscar
     * busca una categoria por mnombre, para no guardar con mismo nombre
     */
    function categoria_x_nombre($categoria, $isSave){
        $con = getConexion(); 
        $sqlNombre = "SELECT * FROM categoria WHERE nombre = '$categoria->nombre'"; 
        $sqlIdNombre = "SELECT * FROM categoria WHERE id != '$categoria->id' AND nombre = '$categoria->nombre'"; 
        $sql = $isSave ? $sqlNombre:$sqlIdNombre; 
        $result = $con->query($sql);
        if($con->connect_errno){
            $con->close(); 
            return false; 
        }
        $categorias = $result->fetch_all();
        if(count($categorias)>0){ 
            if(strtolower($categorias[0][1])===strtolower($categoria->nombre)){
                return false; 
            }
        }
        return true; 
    }

    /**
     * $categoria categoria a editar
     * edita una categoria en especifico
     */
    function editar_categoria($categoria){
        if(categoria_x_nombre($categoria, false)){
            include_once ('conexion.php');
            $con = getConexion(); 
            $sql = "UPDATE categoria SET nombre = '$categoria->nombre' WHERE id = '$categoria->id'"; 
            $result = $con->query($sql); 

            if($con->connect_errno){
                $con->close(); 
                return false; 
            }
            return $result; 
         }
    }

    /**
     * $id_categoria id de la categoria
     * muestra una categoria por el id 
     */
    function mostrar_categoria($id_categoria){
        include_once ('conexion.php');
        $con = getConexion(); 
        $sql = "SELECT * FROM categoria WHERE id = $id_categoria"; 

        $result = $con->query($sql); 

        if($con->connect_errno){
            $con->close(); 
            return false; 
        }
        $get_categ = array(); 
        $categorias = $result->fetch_all();
        foreach($categorias as $c){
            array_push($get_categ, obtener_categoria($c)); 
        }  
        $con->close(); 
        return $get_categ; 
    }

    /**
     * $catResult obtenido de la base datos
     * obtiene todos los datos de una categoria
     */
    function obtener_categoria($catResult){
        $listPro = mostrar_productos_x_categoria($catResult[0]); 
        $cat= new Categoria(); 
        $cat->id = $catResult[0]; 
        $cat->nombre = $catResult[1]; 
        $cat->listaProductos =$listPro ? $listPro:NULL; 
        return $cat; 
    }

?>