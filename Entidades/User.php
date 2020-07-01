

<?php
    class User{

        public $id; 
        public $nombre; 
        public $cedula; 
        public $correo; 
        public $telefono; 
        public $direcion; 
        public $username; 
        public $password; 
        public $tipo; 

        public function  ____construct($nombre, $cedula, $correo, $telefono, $direcion, $username, $password){
            $this->nombre = $nombre;
            $this->cedula = $cedula;
            $this->correo = $correo;
            $this->telefono = $telefono;
            $this->direcion = $direcion;
            $this->username = $username;
            $this->password = $password;
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