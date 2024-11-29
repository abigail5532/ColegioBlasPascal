
<?php
include('../../Includes/Connection.php');

$query = mysqli_query($conexion, "SELECT CONCAT(n.nombre, ' - ', g.nombre) AS nivel_grado, 
COUNT(*) AS cantidad FROM aulas au INNER JOIN grados g ON au.grado = g.idgrado
INNER JOIN niveles n ON g.nivel = n.idniv GROUP BY nivel_grado");

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