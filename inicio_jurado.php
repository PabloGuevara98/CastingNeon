<?php
session_start();
include('config.php');

// Verificar si el usuario está logueado como jurado
if ($_SESSION['tipo_usuario'] != 'jurado') {
  header('Location: index.php');
}

// Consulta para traer los datos de los castings y los participantes inscritos en cada cast
$sql = "SELECT c.*, GROUP_CONCAT(u.nombre SEPARATOR ', ') AS participantes FROM casts c
        LEFT JOIN inscripciones i ON i.id_cast = c.id
        LEFT JOIN usuarios u ON u.id = i.id_usuario
        GROUP BY c.id";

$resultado = mysqli_query($conexion, $sql);

?>

<!DOCTYPE html>
<html>
<head>
  <title>Inicio Jurado</title>
</head>
<body>
  <h1>Bienvenido, <?php echo $_SESSION['nombre_usuario']; ?></h1>

  <h2>Lista de Castings</h2>
  <ul>
    <?php while ($fila = mysqli_fetch_array($resultado)) { ?>
      <li>
        <h3><?php echo $fila['nombre']; ?></h3>
        <p><strong>Fecha:</strong> <?php echo $fila['fecha']; ?></p>
        <p><strong>Hora:</strong> <?php echo $fila['hora']; ?></p>
        <p><strong>Participantes:</strong> <?php echo $fila['participantes']; ?></p>
        <form method="post" action="inscribirse_cast.php">
          <input type="hidden" name="id_cast" value="<?php echo $fila['id']; ?>">
          <button type="submit">Inscribirse</button>
        </form>
      </li>
    <?php } ?>
  </ul>

</body>
</html>
