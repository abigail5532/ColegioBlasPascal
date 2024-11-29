<?php
session_start();
include('../../Includes/Connection.php');
$id_user = $_SESSION['idUser'];

$query = mysqli_query($conexion, "SELECT a.aula AS id_aula, au.seccion AS seccion,
CONCAT(ni.nombre, ' - ', g.nombre, ' ', au.seccion) AS aula_nombre,
b.nombre AS nombre_bimestre,
SUM(bn.promediogeneral) / (SELECT COUNT(*) FROM alumnos a2 WHERE a2.aula = a.aula) AS promedio_general_bimestre_por_alumno
FROM boletanotas bn
INNER JOIN alumnos a ON bn.alumno = a.idalum
INNER JOIN aulas au ON a.aula = au.idaula
INNER JOIN grados g ON au.grado = g.idgrado
INNER JOIN niveles ni ON g.nivel = ni.idniv
INNER JOIN bimestres b ON bn.bimestre = b.idbime
WHERE au.tutor = '$id_user'
GROUP BY a.aula, au.seccion, bn.bimestre, b.nombre
ORDER BY a.aula, bn.bimestre");

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

