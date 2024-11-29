<?php
include('../Includes/Connection.php');

if (isset($_GET['dni'])) {
    $dni = $_GET['dni'];

    // Consulta para buscar estudiante por DNI
    $query = "
        SELECT a.nombres, a.apellidos, au.idaula, au.seccion, n.nombre AS nivel, g.nombre AS grado, s.nombre AS seccion
        FROM alumnos a
        JOIN aulas au ON a.aula = au.idaula
        JOIN grados g ON au.grado = g.idgrado
        JOIN niveles n ON g.nivel = n.idniv
        WHERE a.dni = '$dni'
    ";
    $result = mysqli_query($conexion, $query);

    if (mysqli_num_rows($result) > 0) {
        $estudiante = mysqli_fetch_assoc($result);
        echo json_encode($estudiante);
    } else {
        echo json_encode([]);
    }

    mysqli_close($conexion);
}
?>
