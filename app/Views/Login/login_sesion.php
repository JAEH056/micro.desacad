<?php
session_start();
$_SESSION['usuario'] = $_REQUEST['usuario'];
$_SESSION['password'] = $_REQUEST['password'];
?>
<html>

<head>
  <title>Problema</title>
</head>

<body>
  Se almacenaron dos variables de sesión.<br><br>
  <a href="url_to('\\' . Login::class .'::login')">Ir a la tercer página donde se recuperarán
    las variables de sesión</a>
</body>

</html>