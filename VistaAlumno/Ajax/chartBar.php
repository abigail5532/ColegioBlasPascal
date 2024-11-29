<?php
session_start();
include('../../Includes/Connection.php');
$id_user = $_SESSION['idUser'];
$bimestre = isset($_POST['bimestre']) ? $_POST['bimestre'] : null;

$queryStr = "SELECT pr.idpromedio, pr.promedio, asig.idasig, asig.nombre AS asignatura, 
    b.nombre AS nombre_bimestre, pr.idalumn, pr.idbime, au.seccion AS seccion
    FROM promedios pr 
    INNER JOIN asignaturas asig ON pr.idasig = asig.idasig 
    INNER JOIN bimestres b ON pr.idbime = b.idbime 
    INNER JOIN alumnos a ON pr.idalumn = a.idalum
    INNER JOIN aulas au ON a.aula = au.idaula
    WHERE pr.idalumn = '$id_user'";

if ($bimestre) {
    $queryStr .= " AND pr.idbime = '$bimestre'";
}

$queryStr .= " GROUP BY asig.idasig, asignatura";

$query = mysqli_query($conexion, $queryStr);

if (!$query) {
    echo json_encode(['error' => mysqli_error($conexion)]);
    die();
}

$arreglo = array();
while ($data = mysqli_fetch_assoc($query)) {
    $arreglo[] = $data;
}
echo json_encode($arreglo);
?>
