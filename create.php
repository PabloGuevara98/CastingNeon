<?php
	// Conexión a la base de datos
	include("funciones.php");
	$conn = conectar();

	// Verificar si se ha enviado el formulario
	if(isset($_POST['submit'])) {
		// Recuperar los datos del formulario
		$nombre = $_POST['nombre'];
		$apellido = $_POST['apellido'];
		$correo = $_POST['correo'];
		$tipo_usuario = $_POST['tipo_usuario'];
		$contrasena = $_POST['contrasena'];

		// Insertar los datos en la base de datos
		$query = "INSERT INTO usuarios(nombre,apellido, correo, tipo_usuario, contrasena) VALUES('$nombre', '$apellido','$correo', '$tipo_usuario','$contrasena')";
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

		<label for="apellido">Apellido:</label>
		<input type="text" id="apellido" name="apellido" required>

		<label for="correo">Correo electrónico:</label>
		<input type="email" id="correo" name="correo" required>

		<label for="tipo">Tipo de usuario:</label>
		<select id="tipo" name="tipo" required>
			<option value="">Seleccione el tipo de usuario</option>
			<option value="jurado">Jurado</option>
			<option value="participante">Participante</option>
		</select>
		<label for="contrasena">Contraseña temporal:</label>
		<input type="password" id="contrasena" name="contrasena" required>
		<input type="submit" name="submit" value="Agregar">
	</form>

	<!-- Enlace para regresar a la página principal -->
	<a href="index.php">Regresar</a>

	<!-- Cerrar conexión a la base de datos -->
	<?php mysqli_close($conn); ?>
</body>
</html>