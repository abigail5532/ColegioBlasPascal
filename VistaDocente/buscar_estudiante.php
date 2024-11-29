<?php
include('../Includes/Connection.php');

if (isset($_GET['alumno'])) {
    $alumno = $_GET['alumno'];


    // Consulta para buscar alumno activos por nombre o apellido
    $query = "
        SELECT idalum, CONCAT(nombres, ' ', apellidos) AS nombre_completo
        FROM alumnos
        WHERE (nombres LIKE '%$alumno%' OR apellidos LIKE '%$alumno%')
          AND estado = 'Activo'
    ";
    
    $result = mysqli_query($conexion, $query);
    $alumnos = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $alumnos[] = $row;
    }
    echo json_encode($alumnos);

    mysqli_close($conexion);
}
?>
