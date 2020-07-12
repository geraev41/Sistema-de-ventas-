<?php
function destruir_session(){
  session_start();
  session_destroy();
  header('Location: /GUI/index.php');
}
?>
