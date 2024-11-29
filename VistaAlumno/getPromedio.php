<?php
require_once('../Includes/Connection.php');

$bimestre = $_GET['bimestre'];
$idalum = $_GET['idalum'];
$idasig = $_GET['idasig'];

// Ajustamos la consulta para reflejar correctamente la estructura de la tabla promedios
$queryPromedio = mysqli_query($conexion, "SELECT promedio 
                                          FROM promedios 
                                          WHERE idalumn = '$idalum' 
                                          AND idasig = '$idasig' 
                                          AND idbime = '$bimestre'");

if (!$queryPromedio) {
    echo json_encode(array('error' => 'Error en la consulta: ' . mysqli_error($conexion)));
    exit;
}

$promedioRow = mysqli_fetch_assoc($queryPromedio);
$promedio = $promedioRow ? $promedioRow['promedio'] : null;

echo json_encode(array('promedio' => $promedio));
?>
