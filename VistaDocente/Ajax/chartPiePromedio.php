
<?php
session_start();
include('../../Includes/Connection.php');
$id_user = $_SESSION['idUser'];
$query = mysqli_query($conexion, "SELECT pr.idasig, 
asig.nombre AS asignatura, au.seccion AS seccion,
COUNT(CASE WHEN pr.promedio < 12 THEN 1 END) AS cantidad_menor_12,
COUNT(CASE WHEN pr.promedio > 11 THEN 1 END) AS cantidad_mayor_11
FROM promedios pr 
INNER JOIN asignaturas asig ON pr.idasig = asig.idasig 
INNER JOIN bimestres b ON pr.idbime = b.idbime 
INNER JOIN alumnos a ON pr.idalumn = a.idalum
INNER JOIN aulas au ON a.aula = au.idaula
WHERE pr.iddoc = '$id_user'
GROUP BY pr.idasig, asig.nombre, au.seccion;");

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