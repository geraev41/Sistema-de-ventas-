
<?php

    class Producto{
        public $id; 
        public $id_categoria; 
        public $nombre; 
        public $descripcion; 
        public $imagen; 
        public $stock; 
        public $precio; 
        public $cantidad; 

        public function  ____construct($id_categoria, $nombre, $descripcion, $imagen, $stock, $precio, $cantidad){
            $this->id_categoria =$id_categoria; 
            $this->nombre =$nombre; 
            $this->descripcion =$descripcion;
            $this->imagen=$imagen;
            $this->stock =$stock; 
            $this->precio =$precio; 
            $this->cantidad =$cantidad; 
            
        }

    }

?>