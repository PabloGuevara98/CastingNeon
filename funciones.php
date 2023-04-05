<?php
	// Función para establecer conexión con la base de datos
	function conectar() {
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "bd_usuarios";

		$conn = mysqli_connect($servername, $username, $password, $dbname);

		if (!$conn) {
			die("Error al conectar a la base de datos: " . mysqli_connect_error());
		}

		return $conn;
	}

	// Función para crear un nuevo usuario
	function crear_usuario($nombre, $tipo) {
		$conn = conectar();

		$query = "INSERT INTO usuarios (nombre, tipo) VALUES ('$nombre', '$tipo')";
		$resultado = mysqli_query($conn, $query);

		mysqli_close($conn);

		return $resultado;
	}

	// Función para recuperar todos los usuarios de la base de datos
	function obtener_usuarios() {
		$conn = conectar();

		$query = "SELECT * FROM usuarios";
		$resultado = mysqli_query($conn, $query);

		mysqli_close($conn);

		return $resultado;
	}

	// Función para recuperar un usuario específico de la base de datos
	function obtener_usuario($id) {
		$conn = conectar();

		$query = "SELECT * FROM usuarios WHERE id = $id";
		$resultado = mysqli_query($conn, $query);
		$usuario = mysqli_fetch_assoc($resultado);

		mysqli_close($conn);

		return $usuario;
	}

	// Función para actualizar los datos de un usuario existente
	function actualizar_usuario($id, $nombre, $tipo) {
		$conn = conectar();

		$query = "UPDATE usuarios SET nombre = '$nombre', tipo = '$tipo' WHERE id = $id";
		$resultado = mysqli_query($conn, $query);

		mysqli_close($conn);

		return $resultado;
	}
    function get_tipo_usuario($tipo) {
        switch ($tipo) {
            case 'jurado':
                return 'Jurado';
            case 'participante':
                return 'Participante';
            default:
                return 'Desconocido';
        }
    }
?>