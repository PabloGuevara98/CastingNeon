<?php
session_start();
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nombre = $_POST['nombre'];
  $contrasena = $_POST['contrasena'];

  $sql = "SELECT id, nombre FROM usuarios WHERE nombre = '$nombre' and contrasena = '$contrasena'";
  $resultado = mysqli_query($conexion, $sql);
  $fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC);
  $contador = mysqli_num_rows($resultado);

  if ($contador == 1) {
    $_SESSION['id'] = $fila['id'];
    $_SESSION['nombre'] = $fila['nombre'];
    header("location: index.php");
  } else {
    $error = "Nombre de usuario o contraseña incorrectos";
  }
}
?>
