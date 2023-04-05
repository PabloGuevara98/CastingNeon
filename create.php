<?php
	// Conexión a la base de datos
	include("funciones.php");
	$conn = conectar();

	// Verificar si se ha enviado el formulario
	if(isset($_POST['submit'])) {
		// Recuperar los datos del formulario
		$nombre = $_POST['nombre'];
		$correo = $_POST['correo'];
		$tipo = $_POST['tipo_usuario'];

		// Insertar los datos en la base de datos
		$query = "INSERT INTO usuarios(nombre, correo, tipo_usuario) VALUES('$nombre', '$correo', '$tipo')";
		$resultado = mysqli_query($conn, $query);

		// Redirigir al usuario de regreso a la página principal
		header("Location: index.php");
		exit;
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Agregar usuario</title>
	<link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
	<h1>Agregar usuario</h1>

	<!-- Formulario para agregar un nuevo usuario -->
	<form method="POST">
		<label for="nombre">Nombre:</label>
		<input type="text" id="nombre" name="nombre" required>

		<label for="correo">Correo electrónico:</label>
		<input type="email" id="correo" name="correo" required>

		<label for="tipo">Tipo de usuario:</label>
		<select id="tipo" name="tipo" required>
			<option value="">Seleccione el tipo de usuario</option>
			<option value="j">Jurado</option>
			<option value="p">Participante</option>
		</select>

		<input type="submit" name="submit" value="Agregar">
	</form>

	<!-- Enlace para regresar a la página principal -->
	<a href="index.php">Regresar</a>

	<!-- Cerrar conexión a la base de datos -->
	<?php mysqli_close($conn); ?>
</body>
</html>