<?php
include('../Includes/Connection.php');

$iddoc = $_GET['iddoc'];
$fecha = $_GET['fecha'];

// Consulta para obtener horas disponibles para el docente en la fecha seleccionada
$query = "SELECT horai, horaf FROM horario WHERE iddocen = '$iddoc' AND dia = '$fecha' AND estado = 'Activo'";
$result = mysqli_query($conexion, $query);

$horas = [];
while ($row = mysqli_fetch_assoc($result)) {
    $horas[] = $row;
}

echo json_encode($horas);
?>

