<?php
require_once('../Includes/Connection.php');

$bimestre = $_GET['bimestre'];
$idalum = $_GET['idalum'];
$idasig = $_GET['idasig'];

$query = mysqli_query($conexion, "SELECT e.ideva, e.evaluacion, e.porcentaje, en.nota 
                                  FROM evaluaciones e 
                                  LEFT JOIN evaluacionnotas en ON e.ideva = en.evalua AND en.idalumn = '$idalum'
                                  WHERE e.bimestre = '$bimestre' AND e.idasig = '$idasig'");

if (!$query) {
    echo json_encode(array('error' => 'Error en la consulta: ' . mysqli_error($conexion)));
    exit;
}

$evaluaciones = array();
while ($row = mysqli_fetch_assoc($query)) {
    $evaluaciones[] = array(
        'ideva' => $row['ideva'],
        'nombre' => $row['evaluacion'],
        'nota' => $row['nota'],
        'porcentaje' => $row['porcentaje']
    );
}

echo json_encode($evaluaciones);
?>
