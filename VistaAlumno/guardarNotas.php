<?php
require_once('../Includes/Connection.php');

$data = json_decode(file_get_contents('php://input'), true);

$iddoc = $data['iddoc'];
$idalum = $data['idalum'];
$idasig = $data['idasig'];
$bimestre = $data['bimestre'];
$ideva = $data['ideva'];
$nota = $data['nota'];

$query = "INSERT INTO evaluacionnotas (iddoc, idalumn, idasig, bimestre, evalua, nota) VALUES ('$iddoc', '$idalum', '$idasig', '$bimestre', '$ideva', '$nota')
          ON DUPLICATE KEY UPDATE nota='$nota'";

if (mysqli_query($conexion, $query)) {
    echo json_encode(array('success' => true));
} else {
    echo json_encode(array('success' => false, 'error' => mysqli_error($conexion)));
}
?>
