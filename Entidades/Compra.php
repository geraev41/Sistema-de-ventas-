
<?php
    class Compra{
        public $id; 
        public $id_cliente;
        public $nombre;
        public $imagen;
        public $fecha_compra;
        public $cantidad;
        public $descripcion;
        public $precio;
        public $total;

        public function  ____construct($nombre, $descripcion, $imagen, $precio){
            $this->nombre =$nombre; 
            $this->descripcion =$descripcion;
            $this->imagen=$imagen;
            $this->precio =$precio; 
            
        }
    }

?>