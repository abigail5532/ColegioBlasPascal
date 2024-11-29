<?php
session_start();
include('../../Includes/Connection.php');
$id_user = $_SESSION['idUser'];
$asignatura = isset($_POST['asignatura']) ? $_POST['asignatura'] : null;

$queryEva = "SELECT
evno.evalua, evno.idalumn, evno.nota,
CONCAT(b.abrev, ' - ', ev.evaluacion) AS bimestre_evaluacion 
FROM evaluacionnotas evno
INNER JOIN evaluaciones ev ON evno.evalua = ev.ideva
INNER JOIN asignaturas asig ON ev.idasig = asig.idasig
INNER JOIN bimestres b ON ev.bimestre = b.idbime
WHERE evno.idalumn = '$id_user'";

if ($asignatura) {
    $queryEva .= " AND ev.idasig = '$asignatura'";
}

$queryEva .= " GROUP BY ev.ideva, bimestre_evaluacion";

$query = mysqli_query($conexion, $queryEva);

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
