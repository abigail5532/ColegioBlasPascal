<?php
include('../../Includes/Connection.php');

$query = mysqli_query($conexion, "SELECT au.idaula, au.seccion, CONCAT(n.nombre, ' - ', g.nombre, ' - ', seccion) AS nivel_grado, 
COUNT(al.idalum) AS cantidad_alumnos FROM alumnos al INNER JOIN aulas au ON al.aula = au.idaula 
INNER JOIN grados g ON au.grado = g.idgrado INNER JOIN niveles n ON g.nivel = n.idniv
GROUP BY au.idaula, nivel_grado");

if (!$query) {
    echo json_encode(['error' => mysqli_error($conexion)]);
    die();
}

$arreglo = array();
while ($data = mysqli_fetch_array($query)) {
    $arreglo[] = $data;
}
echo json_encode($arreglo);
?>