<?php
include('../Includes/Connection.php');

if (isset($_GET['iddoc']) && isset($_GET['tipoReunion'])) {
    $iddoc = $_GET['iddoc'];
    $tipoReunion = $_GET['tipoReunion'];

    // Consulta para buscar fechas disponibles del docente según el tipo de reunión
    $query = "
        SELECT DISTINCT dia
        FROM horario
        WHERE iddocen = $iddoc AND reunion = '$tipoReunion' AND estado = 'Activo'
    ";
    $result = mysqli_query($conexion, $query);
    $fechas = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $fechas[] = $row['dia'];
    }

    echo json_encode($fechas);
    mysqli_close($conexion);
}
?>
