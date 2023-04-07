<?php
session_start();
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nombre = $_POST['nombre'];
  $contrasena = $_POST['contrasena'];

  $sql = "SELECT id, nombre, tipo_usuario FROM usuarios WHERE nombre = '$nombre' and contrasena = '$contrasena'";
  $resultado = mysqli_query($conexion, $sql);
  $fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC);
  $contador = mysqli_num_rows($resultado);

  if ($contador == 1) {
    $_SESSION['id'] = $fila['id'];
    $_SESSION['nombre'] = $fila['nombre'];
    $_SESSION['tipo_usuario'] = $fila['tipo_usuario'];

    // Redireccionar al usuario a la página correspondiente según su rol
    if ($_SESSION['tipo_usuario'] == 'participante') {
      header('Location: inicio_participante.php');
    } else if ($_SESSION['tipo_usuario'] == 'jurado') {
      header('Location: inicio_jurado.php');
    }
  } else {
    $error = "Nombre de usuario o contraseña incorrectos";
  }
}
?>

