<?php
session_start();
?>
<html>
  <head>
    <title>Problema</title>
  </head>
  <body>
    <?php
    echo "Nombre de usuario" . $_SESSION['user'];
    echo "La contraseña" . $_SESSION['password'];
    ?>
  </body>
</html>