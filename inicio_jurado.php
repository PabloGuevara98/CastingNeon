<?php
session_start();
include('config.php');

// Verificar si el usuario está logueado como jurado
if ($_SESSION['tipo_usuario'] != 'jurado') {
  header('Location: inicio_jurado.php');
}
// Realizar la consulta a la base de datos
$sql = "SELECT casts.id_cast, casts.fecha_cast, casts.hora_cast, casts.nombre_cast, 
               COUNT(inscripciones.id_cast) as num_participantes 
        FROM casts 
        LEFT JOIN inscripciones ON casts.id_cast = inscripciones.id_cast 
        GROUP BY casts.id_cast";

$resultado = mysqli_query($conexion, $sql);

// Mostrar los resultados en una tabla
echo "<table>";
echo "<tr><th>ID</th><th>Fecha</th><th>Hora</th><th>Nombre</th><th>Número de participantes</th><th>Participantes inscritos</th></tr>";
while ($fila = mysqli_fetch_array($resultado)) {
    echo "<tr>";
    echo "<td>" . $fila['id'] . "</td>";
    echo "<td>" . $fila['fecha'] . "</td>";
    echo "<td>" . $fila['hora'] . "</td>";
    echo "<td>" . $fila['nombre'] . "</td>";
    echo "<td>" . $fila['num_participantes'] . "</td>";

    // Mostrar los participantes inscritos en este cast
    echo "<td>";
    $sql_participantes = "SELECT usuarios.nombre FROM usuarios 
                          INNER JOIN inscripciones ON usuarios.id = inscripciones.usuario_id 
                          WHERE inscripciones.cast_id = " . $fila['id'];

    $resultado_participantes = mysqli_query($conexion, $sql_participantes);
    while ($fila_participantes = mysqli_fetch_array($resultado_participantes)) {
        echo $fila_participantes['nombre'] . "<br>";
    }
    echo "</td>";

    echo "</tr>";
}
echo "</table>";
?>