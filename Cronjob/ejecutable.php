

<?php
    include ('cronjob.php');
    $cantidad = $argv[1]; 
    $productos = consultar_stock($cantidad);
        if($productos){
            $txt="";
            foreach ($productos as $p) {
                $id = $p[0];
                $nombre = $p[2]; 
                $cantidad = $p[5];
                $txt.= "\t -ID o Código del producto $id, nombre $nombre, cantidad existente $cantidad\n"; 
            }
           // echo ($txt); 
            enviar_mail($txt); 
        }else{
            echo ("No hay esta cantidad"); 
        }
        
        function enviar_mail($txt){
            $destino = "gera2espi1818@gmail.com";
            $asunto = "Información de stocks";
            $msj = "Estos productos se encuentra con una cantidad baja a la consultada\n\n ".$txt;
            $mail =mail($destino, $asunto, $msj);
            if($mail){
                echo "Se envío un correo con exitó";
            }else{
                echo "Surgio error";
            }
        }

    // xampp\php\php.exe C:\web1\sistemadeventas\Cronjob\ejecutable.php 2
?>