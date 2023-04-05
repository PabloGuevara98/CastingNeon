<?php
include('config.php');
include('funciones.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>CRUD Usuarios</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<h1>CRUD Usuarios</h1>

	<table>
		<tr>
			<th>ID</th>
			<th>Nombre</th>
			<th>Apellido</th>
			<th>Tipo de usuario</th>
			<th>Acciones</th>
		</tr>

		<?php
		// Obtener todos los usuarios de la base de datos
		$usuarios = obtener_usuarios();

		// Iterar a través de los usuarios y mostrarlos en la tabla
		foreach ($usuarios as $fila) {
			echo "<tr>";
			echo "<td>".$fila['id']."</td>";
			echo "<td>".$fila['nombre']."</td>";
			echo "<td>".$fila['apellido']."</td>";
			echo "<td>".get_tipo_usuario($fila['tipo_usuario'])."</td>";
			echo "<td>";
			echo "<a href='edit.php?id=".$fila['id']."'>Editar</a> ";
			echo "<a href='delete.php?id=".$fila['id']."'>Eliminar</a>";
			echo "</td>";
			echo "</tr>";
		}
		?>
	</table>

	<h2>Agregar nuevo usuario</h2>

	<form method="post" action="create.php">
		<input type="submit" value="Agregar">
	</form>

</body>
</html>
