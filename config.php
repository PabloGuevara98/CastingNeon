<?php
// Establecer los datos de la conexión a la base de datos
$host = "localhost";
$user = "root";
$password = "";
$database = "bd_usuarios";

// Realizar la conexión a la base de datos
$conexion = mysqli_connect($host, $user, $password, $database);

// Verificar si hubo errores en la conexión
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>