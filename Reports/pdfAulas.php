<?php
include('../Includes/Connection.php');
require_once 'fpdf/fpdf.php';

$pdf = new FPDF('P', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetMargins(20, 20, 20);
$pdf->SetAutoPageBreak(true, 20);
$pdf->SetTitle("BlasPascal");
$pdf->SetFont('Arial', 'B', 16);

// Agregar logo
$imageX = 20;
$imageY = 5;
$imageWidth = 15;
$pdf->Image('../Imagenes/logoexp.png', $imageX, $imageY, $imageWidth);
$pdf->SetX($imageX + $imageWidth + 1);
$pdf->Cell(0, 7, "Consorcio Educativo Blas Pascal", 0, 1, 'L');
$pdf->Ln(5);

// Datos de la institución
$queryinstitucion = mysqli_query($conexion, "SELECT * FROM institucion");
if (mysqli_num_rows($queryinstitucion) > 0) {
    $row = mysqli_fetch_assoc($queryinstitucion);
    $nombre = utf8_decode($row['nombre']);
    $dre = utf8_decode($row['dre']);
    $ugel = utf8_decode($row['ugel']);
    $codmodular = utf8_decode($row['codmodular']);
}

// Datos del aula
if (isset($_GET['idaula'])) {
    $idaula = intval($_GET['idaula']);
}

$levelQuery = mysqli_query($conexion, "SELECT CONCAT(d.apellidos, ', ', d.nombres) AS tutor,
au.seccion, n.nombre AS nivel, g.nombre AS grado 
FROM aulas au 
INNER JOIN grados g ON au.grado = g.idgrado 
INNER JOIN niveles n ON g.nivel = n.idniv 
INNER JOIN docentes d ON au.tutor = d.iddoc 
WHERE au.idaula = $idaula");

if (mysqli_num_rows($levelQuery) > 0) {
    $levelData = mysqli_fetch_assoc($levelQuery);
    $tutor = utf8_decode($levelData['tutor']);
    $nivel = utf8_decode($levelData['nivel']);
    $grado = utf8_decode($levelData['grado']);
    $seccion = utf8_decode($levelData['seccion']);
    $tutor = utf8_decode($levelData['tutor']);
}

// Imprimir datos de la institución
$pdf->SetFillColor(228, 231, 224);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(42.5, 5, "DRE", 1, 0, 'C', true);
$pdf->Cell(42.5, 5, strtoupper($dre), 1, 0, 'C');
$pdf->Cell(42.5, 5, "UGEL", 1, 0, 'C', true);
$pdf->Cell(42.5, 5, $ugel, 1, 1, 'C');
$pdf->Cell(42.5, 5, "NIVEL", 1, 0, 'C', true);
$pdf->Cell(42.5, 5, strtoupper($nivel), 1, 0, 'C');
$pdf->Cell(42.5, 5, utf8_decode("CÓDIGO MODULAR I.E."), 1, 0, 'C', true);
$pdf->Cell(42.5, 5, $codmodular, 1, 1, 'C');
$pdf->Cell(42.5, 5, utf8_decode("GRADO / AÑO"), 1, 0, 'C', true);
$pdf->Cell(42.5, 5, strtoupper($grado), 1, 0, 'C');
$pdf->Cell(42.5, 5, utf8_decode("SECCIÓN"), 1, 0, 'C', true);
$pdf->Cell(42.5, 5, $seccion, 1, 1, 'C');
$pdf->Cell(42.5, 5, utf8_decode("TUTOR(A)"), 1, 0, 'C', true);
$pdf->Cell(127.5, 5, strtoupper(utf8_decode($tutor)), 1, 1, 'C');
$pdf->Ln(7);

// Consulta de alumnos
$query = mysqli_query($conexion, "SELECT 
al.idalum, CONCAT(al.apellidos, ', ', al.nombres) AS nombre_completo, au.seccion, n.nombre AS nivel, g.nombre AS grado 
FROM alumnos al 
INNER JOIN aulas au ON al.aula = au.idaula 
INNER JOIN grados g ON au.grado = g.idgrado 
INNER JOIN niveles n ON g.nivel = n.idniv 
WHERE al.aula = $idaula 
ORDER BY nombre_completo ASC");

// Encabezados de la tabla de alumnos
$pdf->SetFont('Arial', 'B', 8);
$pdf->SetFillColor(228, 231, 224);// Color de fondo
$pdf->SetTextColor(0, 0, 0); // Color del texto
$pdf->Cell(13, 7, utf8_decode('N°'), 1, 0, 'C', true);
$pdf->Cell(72, 7, 'NOMBRES Y APELLIDOS', 1, 0, 'C', true);
$pdf->Cell(85, 7, '', 1, 1, 'C', true);

// Rellenar la tabla con los datos de los alumnos
$pdf->SetFont('Arial', '', 8);
$idCounter = 1;
if (mysqli_num_rows($query) > 0) {
    while ($data = mysqli_fetch_assoc($query)) {
        $id = $idCounter++;
        $nombreCompleto = strtoupper(utf8_decode($data['nombre_completo']));
        $pdf->Cell(13, 5, $id, 1);
        $pdf->Cell(72, 5, $nombreCompleto, 1);
        $pdf->Cell(8.5, 5, '', 1);
        $pdf->Cell(8.5, 5, '', 1);
        $pdf->Cell(8.5, 5, '', 1);
        $pdf->Cell(8.5, 5, '', 1);
        $pdf->Cell(8.5, 5, '', 1);
        $pdf->Cell(8.5, 5, '', 1);
        $pdf->Cell(8.5, 5, '', 1);
        $pdf->Cell(8.5, 5, '', 1);
        $pdf->Cell(8.5, 5, '', 1);
        $pdf->Cell(8.5, 5, '', 1);
        $pdf->Ln();
    }
} else {
    $pdf->Cell(170, 10, utf8_decode('No se han registrado alumnos para el aula seleccionada.'), 1, 1, 'C');
}

$pdf->Output('D', "BlasPascal_{$nivel}{$grado}{$seccion}.pdf");
?>
