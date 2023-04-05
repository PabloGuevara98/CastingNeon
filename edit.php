<?php
	// Conexión a la base de datos
	include("funciones.php");
	$conn = conectar();

	// Verificar si se ha enviado el formulario
	if(isset($_POST['submit'])) {
		// Recuperar los datos del formulario
		$id = $_POST['id'];
		$nombre = $_POST['nombre'];
		$correo = $_POST['correo'];
		$tipo = $_POST['tipo'];

		// Actualizar los datos en la base de datos
		$query = "UPDATE usuarios SET nombre = '$nombre', correo = '$correo', tipo = '$tipo' WHERE id = $id";
		$resultado = mysqli_query($conn, $query);

		// Redirigir al usuario de regreso a la página principal
		header("Location: index.php");
		exit;
	}

	// Recuperar los datos del usuario a editar
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
	<title>Editar usuario</title>
	<link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
	<h1>Editar usuario</h1>

	<!-- Formulario para editar un usuario existente -->
	<form method="POST">
		<input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">

		<label for="nombre">Nombre:</label>
		<input type="text" id="nombre" name="nombre" value="<?php echo $usuario['nombre']; ?>" required>

		<label for="correo">Correo electrónico:</label>
		<input type="email" id="correo" name="correo" value="<?php echo $usuario['correo']; ?>" required>

		<label for="tipo">Tipo de usuario:</label>
		<select id="tipo" name="tipo" required>
			<option value="">Seleccione el tipo de usuario</option>
			<option value="j"<?php if($usuario['tipo'] == 'j') { echo ' selected'; } ?>>Jurado</option>
			<option value="p"<?php if($usuario['tipo'] == 'p') { echo ' selected'; } ?>>Participante</option>
		</select>

		<input type="submit" name="submit" value="Actualizar">
	</form>

	<!-- Enlace para regresar a la página principal -->
	<a href="index.php">Regresar</a>

	<!-- Cerrar conexión a la base de datos -->
	<?php mysqli_close($conn); ?>
</body>
</html>
