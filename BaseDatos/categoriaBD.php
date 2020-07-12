<?php
    
    require_once ('../Entidades/Categoria.php'); 

    function insertar_categoria($categoria){
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


    function obtener_categoria($catResult){
        $cat= new Categoria(); 
        $cat->id = $catResult[0]; 
        $cat->nombre = $catResult[1]; 
        return $cat; 
    }

?>