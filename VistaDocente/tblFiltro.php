<?php
include('../Includes/Connection.php');

if (isset($_GET['alumno'])) {
    $alumno = $_GET['alumno'];
    $query = mysqli_query($conexion, "SELECT p.idpromedio, p.promedio, a.idalum, 
    p.idalumn, asig.nombre AS asignatura, ar.nombre AS areacurricular,
    b.nombre AS bimestre, ar.descripcion AS descripcion
    FROM promedios p 
    INNER JOIN asignaturas asig ON p.idasig = asig.idasig
    INNER JOIN area_curricular ar ON asig.areacurricular = ar.idarea
    INNER JOIN alumnos a ON p.idalumn = a.idalum
    INNER JOIN bimestres b ON p.idbime = b.idbime
    WHERE p.idalumn = $alumno ORDER BY ar.idarea ASC");

    $areas = [];
    while ($row = mysqli_fetch_assoc($query)) {
        $areas[$row['areacurricular']]['descripcion'] = $row['descripcion'];
        $areas[$row['areacurricular']]['asignaturas'][] = [
            'asignatura' => $row['asignatura'],
            'promedio' => $row['promedio']
        ];
    }

    foreach ($areas as $area => $data) {
        $rowspan = count($data['asignaturas']);
        echo "<tr>";
        echo "<td rowspan='" . $rowspan . "'>$area</td>";
        echo "<td rowspan='" . $rowspan . "'>" . $data['descripcion'] . "</td>";
        echo "<td>" . $data['asignaturas'][0]['asignatura'] . "</td>";
        echo "<td>" . $data['asignaturas'][0]['promedio'] . "</td>";
        echo "</tr>";

        for ($i = 1; $i < $rowspan; $i++) {
            echo "<tr>";
            echo "<td>" . $data['asignaturas'][$i]['asignatura'] . "</td>";
            echo "<td>" . $data['asignaturas'][$i]['promedio'] . "</td>";
            echo "</tr>";
        }
    }
}
?>
