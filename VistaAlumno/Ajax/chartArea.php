<?php
session_start();
include('../../Includes/Connection.php');
$id_user = $_SESSION['idUser'];

$query = mysqli_query($conexion, "
    SELECT b.idbime, b.nombre AS nombre_bimestre, p.promediogeneral, p.alumno
    FROM boletanotas p
    INNER JOIN bimestres b ON p.bimestre = b.idbime 
    WHERE p.alumno = '$id_user'
    GROUP BY b.idbime, nombre_bimestre");

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
