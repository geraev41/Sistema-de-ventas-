<?php
  include_once ('../Util/Util.php'); 
  session_start();
  session_destroy();
  header('Location: /GUI/index.php');
?>
