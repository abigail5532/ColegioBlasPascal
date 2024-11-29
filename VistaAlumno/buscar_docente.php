<?php
include('../Includes/Connection.php');

if (isset($_GET['docente'])) {
    $docente = $_GET['docente'];

    // Consulta para buscar docentes activos por nombre o apellido
    $query = "
        SELECT iddoc, CONCAT(nombres, ' ', apellidos) AS nombre_completo
        FROM docentes
        WHERE (nombres LIKE '%$docente%' OR apellidos LIKE '%$docente%')
        AND estado = 'Activo'
    ";
    $result = mysqli_query($conexion, $query);

    $docentes = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $docentes[] = $row;
    }
    echo json_encode($docentes);

    mysqli_close($conexion);
}
?>

