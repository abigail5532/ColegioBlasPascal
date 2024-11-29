<?php
include('../Includes/Connection.php');

if (isset($_GET['iddoc']) && isset($_GET['fecha'])) {
    $iddoc = $_GET['iddoc'];
    $fecha = $_GET['fecha'];

    // Consulta para buscar horas disponibles del docente en la fecha seleccionada
    $query = "
        SELECT horai, horaf
        FROM horario
        WHERE iddocen = $iddoc  AND dia = '$fecha' AND estado = 'Activo'
    ";
    $result = mysqli_query($conexion, $query);
    $horas = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $horas[] = $row;
    }

    echo json_encode($horas);
    mysqli_close($conexion);
}
?>
