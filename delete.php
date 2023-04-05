<?php
	// Conexión a la base de datos
	include("funciones.php");
	$conn = conectar();

	// Verificar si se ha enviado el formulario
	if(isset($_POST['submit'])) {
		// Recuperar el ID del usuario a eliminar
		$id = $_POST['id'];

		// Eliminar el usuario de la base de datos
		$query = "DELETE FROM usuarios WHERE id = $id";
		$resultado = mysqli_query($conn, $query);

		// Redirigir al usuario de regreso a la página principal
		header("Location: index.php");
		exit;
	}

	// Recuperar los datos del usuario a eliminar
	if(isset($_GET['id'])) {
		$id = $_GET['id'];
		$query = "SELECT * FROM usuarios WHERE id = $id";
		$resultado = mysqli_query($conn, $query);
		$usuario = mysqli_fetch_assoc($resultado);
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Eliminar usuario</title>
	<link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
	<h1>Eliminar usuario</h1>

	<!-- Formulario para eliminar un usuario existente -->
	<form method="POST">
		<p>¿Está seguro de que desea eliminar al usuario <?php echo $usuario['nombre']; ?>?</p>
		<input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
		<input type="submit" name="submit" value="Eliminar">
	</form>

	<!-- Enlace para regresar a la página principal -->
	<a href="index.php">Regresar</a>

	<!-- Cerrar conexión a la base de datos -->
	<?php mysqli_close($conn); ?>
</body>
</html>
