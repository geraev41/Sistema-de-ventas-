<?php

    class Carro{
        public $id;
        public $id_usuario; 
        public $id_producto; 
        public $cantidad;
        public $total; 
        public $listaProductos;

        public function  ____construct($id_usuario, $id_producto, $listaProductos){
            $this->id_usuario = $id_usuario; 
            $this->id_producto = $id_producto; 
            $this->listaProductos = $listaProductos;
        }

        public function ___get($propieda){
            if(property_exists($this, $propieda)){
                return $this->$propieda; 
            }
        }

        public function ___set($propieda, $valor){
            if(property_exists($this, $propieda)){
                $this->$propieda = $valor; 
            }
        }



    }

?>