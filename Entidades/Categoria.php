

<?php

    class Categoria{
        public $id; 
        public $nombre; 
        public $listaProductos; 

        public function  ____construct($nombre, $listaProductos){
            $this->nombre = $nombre; 
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