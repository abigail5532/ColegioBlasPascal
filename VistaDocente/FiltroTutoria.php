<?php
include('../Includes/Connection.php');

if (isset($_GET['bimestre'])) {
    $bimestre = mysqli_real_escape_string($conexion, $_GET['bimestre']);
    $idaula = $_GET['idaula']; // Asegúrate de definir $idaula

    $idCounter = 1;
    $queryorden = mysqli_query($conexion, "SELECT b.alumno AS id_alumno, 
    b.bimestre, a.aula, b.promediogeneral, 
    a.nombres AS nombres_alumno, a.apellidos AS apellidos_alumno FROM boletanotas b 
    INNER JOIN alumnos a ON b.alumno = a.idalum
    WHERE a.aula = '$idaula' AND b.bimestre = '$bimestre'
    ORDER BY b.promediogeneral DESC LIMIT 5");

    if (!$queryorden) {
        die("Error en la consulta: " . mysqli_error($conexion));
    }

    while ($dataorden = mysqli_fetch_assoc($queryorden)) {
        echo "<tr>";
        echo "<td>" . $idCounter++ . "</td>";
        echo "<td>" . $dataorden['apellidos_alumno'] . ', ' . $dataorden['nombres_alumno'] . "</td>";
        echo "<td>" . $dataorden['promediogeneral'] . "</td>";
        echo "</tr>";
    }
}
?>
