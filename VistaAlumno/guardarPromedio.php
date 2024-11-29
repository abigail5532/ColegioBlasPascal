<?php
require_once('../Includes/Connection.php');

$data = json_decode(file_get_contents('php://input'), true);

$iddoc = $data['iddoc'];
$idalum = $data['idalum'];
$idasig = $data['idasig'];
$bimestre = $data['bimestre'];
$promedio = $data['promedio'];

$query = "INSERT INTO promedios (iddoc, idalumn, idasig, idbime, promedio) 
          VALUES ('$iddoc', '$idalum', '$idasig', '$bimestre', '$promedio');

if (mysqli_query($conexion, $query)) {
    echo json_encode(array('success' => true));
} else {
    echo json_encode(array('success' => false, 'error' => mysqli_error($conexion)));
}
?>
