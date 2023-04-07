<?php
session_start();

if (!isset($_SESSION['id'])) {
  header("location: index.php");
}

echo "¡Bienvenido, jurado " . $_SESSION['nombre_usuario'] . "!<br>";
echo "<a href='logout.php'>Cerrar sesión</a>";
?>