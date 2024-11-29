<?php
require_once 'fpdf/fpdf.php';

class PDF extends FPDF
{
    function NbLines($w, $txt)
    {
        $cw = &$this->CurrentFont['cw'];
        if ($w == 0)
            $w = $this->w - $this->rMargin - $this->x;
        $wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;
        $s = str_replace("\r", '', $txt);
        $nb = strlen($s);
        if ($nb > 0 and $s[$nb - 1] == "\n")
            $nb--;
        $sep = -1;
        $i = 0;
        $j = 0;
        $l = 0;
        $nl = 1;
        while ($i < $nb) {
            $c = $s[$i];
            if ($c == "\n") {
                $i++;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
                continue;
            }
            if ($c == ' ')
                $sep = $i;
            $l += $cw[$c];
            if ($l > $wmax) {
                if ($sep == -1) {
                    if ($i == $j)
                        $i++;
                } else
                    $i = $sep + 1;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
            } else
                $i++;
        }
        return $nl;
    }
}

include('../Includes/Connection.php');

// Crear instancia de la clase PDF
$pdf = new PDF('L', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetMargins(20, 20, 20);
$pdf->SetAutoPageBreak(true, 20);
$pdf->SetTitle("BlasPascal");
$pdf->SetFont('Arial', 'B', 16);

// Agregar logo
$imageX = 20;
$imageY = 5;
$imageWidth = 15;
$pdf->Image('../Imagenes/EscudoPeru.png', $imageX, $imageY, $imageWidth);
$pdf->SetX($imageX + $imageWidth + 1);
$pdf->Cell(0, 7, strtoupper("Informe de Progreso de las Competencias del Estudiante"), 0, 1, 'L');
$pdf->Ln(4);

// Obtener datos del alumno
if (isset($_GET['idUser'])) {
    $idUser = intval($_GET['idUser']);
}

// Obtener datos del bimestre
if (isset($_GET['idbime'])) {
    $idbime = intval($_GET['idbime']);
}


$queryalumno = mysqli_query($conexion, "SELECT a.idalum, g.nombre AS grado, 
n.nombre AS nivel, a.dni, CONCAT(a.apellidos, ' ', a.nombres) AS alumno,
au.seccion FROM alumnos a 
INNER JOIN aulas au ON a.aula = au.idaula
INNER JOIN grados g ON au.grado = g.idgrado
INNER JOIN niveles n ON g.nivel = n.idniv
WHERE idalum = $idUser");
if (mysqli_num_rows($queryalumno) > 0) {
    $level = mysqli_fetch_assoc($queryalumno);
    $nivel = utf8_decode($level['nivel']);
    $grado = utf8_decode($level['grado']);
    $seccion = utf8_decode($level['seccion']);
    $dni = utf8_decode($level['dni']);
    $alumno = utf8_decode($level['alumno']);
}

// Datos de la institución
$queryinst = mysqli_query($conexion, "SELECT * FROM institucion");
if (mysqli_num_rows($queryinst) > 0) {
    $row = mysqli_fetch_assoc($queryinst);
    $nombre = utf8_decode($row['nombre']);
    $dre = utf8_decode($row['dre']);
    $ugel = utf8_decode($row['ugel']);
    $codmodular = utf8_decode($row['codmodular']);
} else {
    die('No hay datos de la institución.');
}

// Agregar logo
$imageX = 225;
$imageY = 18;
$imageWidth = 40;
$pdf->Image('../Imagenes/logoexp.png', $imageX, $imageY, $imageWidth);
$pdf->SetX($imageX + $imageWidth + 1);
$pdf->Ln(3);

// Configuración de la tabla
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFillColor(228, 231, 224);
$pdf->SetTextColor(0, 0, 0);

// Primera fila de la tabla
$pdf->Cell(96, 7, utf8_decode("INSTITUCIÓN EDUCATIVA"), 1, 0, 'C', true);
$pdf->Cell(96, 7, strtoupper($nombre), 1, 1, 'C', true);

// Subsecuentes filas
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(48, 5, "DRE", 1, 0, 'C', true);
$pdf->Cell(48, 5, strtoupper($dre), 1, 0, 'C');
$pdf->Cell(48, 5, "UGEL", 1, 0, 'C', true);
$pdf->Cell(48, 5, $ugel, 1, 1, 'C');

$pdf->Cell(48, 5, "NIVEL", 1, 0, 'C', true);
$pdf->Cell(48, 5, strtoupper($nivel), 1, 0, 'C');
$pdf->Cell(48, 5, utf8_decode("CÓDIGO MODULAR I.E."), 1, 0, 'C', true);
$pdf->Cell(48, 5, $codmodular, 1, 1, 'C');

$pdf->Cell(48, 5, utf8_decode("GRADO / AÑO"), 1, 0, 'C', true);
$pdf->Cell(48, 5, strtoupper($grado), 1, 0, 'C');
$pdf->Cell(48, 5, utf8_decode("SECCIÓN"), 1, 0, 'C', true);
$pdf->Cell(48, 5, $seccion, 1, 1, 'C');

$pdf->Cell(48, 5, utf8_decode("DNI DEL EST."), 1, 0, 'C', true);
$pdf->Cell(48, 5, $dni, 1, 0, 'C');
$pdf->Cell(48, 5, "BIMESTRE", 1, 0, 'C', true);
$pdf->Cell(48, 5, $idbime, 1, 1, 'C');

$pdf->Cell(48, 5, "ALUMNO(A)", 1, 0, 'C', true);
$pdf->Cell(144, 5, strtoupper(utf8_decode($alumno)), 1, 1, 'C');

$pdf->Ln(7);

// Datos de los promedios
$query = mysqli_query($conexion, "SELECT p.idpromedio, p.promedio, a.idalum, 
asig.nombre AS asignatura, ar.nombre AS areacurricular,
b.nombre AS bimestre, ar.descripcion AS descripcion
FROM promedios p 
INNER JOIN asignaturas asig ON p.idasig = asig.idasig
INNER JOIN area_curricular ar ON asig.areacurricular = ar.idarea
INNER JOIN alumnos a ON p.idalumn = a.idalum
INNER JOIN bimestres b ON p.idbime = b.idbime
WHERE a.idalum = $idUser AND b.idbime = $idbime");

// Array
$areas = [];
if (mysqli_num_rows($query) > 0) {
    while ($data = mysqli_fetch_assoc($query)) {
        $area = strtoupper(utf8_decode($data['areacurricular']));
        $descripcion = utf8_decode($data['descripcion']);
        $asignatura = strtoupper(utf8_decode($data['asignatura']));
        $promedio = strtoupper(utf8_decode($data['promedio']));
        if (!isset($areas[$area])) {
            $areas[$area] = [];
        }
        $areas[$area][] = [
            'descripcion' => $descripcion,
            'asignatura' => $asignatura,
            'promedio' => $promedio
        ];
    }
}

// Encabezados de la tabla
$pdf->SetFont('Arial', 'B', 9);
$pdf->SetFillColor(228, 231, 224); // Color de fondo
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(42, 10, utf8_decode('ÁREA'), 1, 0, 'C', true);
$pdf->Cell(150, 10, utf8_decode('CRITERIOS DE EVALUACIÓN'), 1, 0, 'C', true);
$pdf->Cell(38, 10, 'ASIGNATURA', 1, 0, 'C', true);
$pdf->Cell(25, 10, 'PROMEDIO', 1, 1, 'C', true);

// Cuerpo de la tabla
$pdf->SetFont('Arial', '', 9);
$pdf->SetTextColor(0, 0, 0);

foreach ($areas as $area => $asignaturas) {
    $num_asignaturas = count($asignaturas);
    $pdf->Cell(42, 7 * $num_asignaturas, $area, 1);
    $pdf->Cell(150, 7 * $num_asignaturas, $asignaturas[0]['descripcion'], 1); // Descripción del área
    $first = true;
    foreach ($asignaturas as $asignatura) {
        if (!$first) {
            $pdf->Cell(42, 7, '', 0);
            $pdf->Cell(150, 7, '', 0);
        }
        $pdf->Cell(38, 7, $asignatura['asignatura'], 1);
        $pdf->Cell(25, 7, $asignatura['promedio'], 1);
        $pdf->Ln();
        $first = false;
    }
}
$pdf->Ln(10);
// Fin Datos de los promedios

// Datos de comportamiento
// COnsulta de la tabla comportamiento
$queryComportamiento = mysqli_query($conexion, "SELECT a.idalum, CONCAT(a.apellidos, ' ', a.nombres) AS nombres_alumno, 
b.abrev AS bimestre, co.alumno, co.inasistenciajust, co.inasistenciainjust, co.tardanzajust, 
co.tardanzainjust, co.puntualidad, co.respeto, co.responsabilidad, co.aseo, co.yearacad
FROM comportamiento co
INNER JOIN alumnos a ON co.alumno = a.idalum
INNER JOIN bimestres b ON co.bimestre = b.idbime
WHERE co.alumno = $idUser AND b.idbime = $idbime");

// Encabezados de la tabla
$pdf->SetFont('Arial', 'B', 9);
$pdf->SetFillColor(228, 231, 224);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(18, 14, utf8_decode('Bimestre'), 1, 0, 'C', true);
$pdf->Cell(40, 7, utf8_decode('Inasistencias'), 1, 0, 'C', true);
$pdf->Cell(40, 7, utf8_decode('Tardanzas'), 1, 0, 'C', true);
$pdf->Cell(18, 0, '', 0, 0, 'C', false);
$pdf->Cell(139, 7, strtoupper(utf8_decode('Comportamiento del Estudiante')), 1, 1, 'C', true);

$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(18, 0, '', 0, 0, 'C', false);
$pdf->Cell(20, 7, utf8_decode('Justificadas'), 1, 0, 'C', true);
$pdf->Cell(20, 7, utf8_decode('Injustificadas'), 1, 0, 'C', true);
$pdf->Cell(20, 7, utf8_decode('Justificadas'), 1, 0, 'C', true);
$pdf->Cell(20, 7, utf8_decode('Injustificadas'), 1, 0, 'C', true);
$pdf->Cell(18, 0, '', 0, 0, 'C', false);

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(19, 7, utf8_decode('Bimestre'), 1, 0, 'C', true);
$pdf->Cell(30, 7, utf8_decode('Puntualidad'), 1, 0, 'C', true);
$pdf->Cell(30, 7, utf8_decode('Respeto'), 1, 0, 'C', true);
$pdf->Cell(30, 7, utf8_decode('Responsabilidad'), 1, 0, 'C', true);
$pdf->Cell(30, 7, utf8_decode('Aseo'), 1, 1, 'C', true);

// Cuerpo de la tabla
$pdf->SetFont('Arial', '', 9);
$pdf->SetTextColor(0, 0, 0);
if (mysqli_num_rows($queryComportamiento) > 0) {
    while ($data = mysqli_fetch_assoc($queryComportamiento)) {
        $bimestre = $data['bimestre'];
        $inasistenciajust = $data['inasistenciajust'];
        $inasistenciainjust = $data['inasistenciainjust'];
        $tardanzajust = $data['tardanzajust'];
        $tardanzainjust = $data['tardanzainjust'];

        $bimestre = $data['bimestre'];
        $puntualidad = $data['puntualidad'];
        $respeto = $data['respeto'];
        $responsabilidad = $data['responsabilidad'];
        $aseo = $data['aseo'];

        $pdf->Cell(18, 7, $bimestre, 1, 0, 'C');
        $pdf->Cell(20, 7, $inasistenciajust, 1, 0, 'C');
        $pdf->Cell(20, 7, $inasistenciainjust, 1, 0, 'C');
        $pdf->Cell(20, 7, $tardanzajust, 1, 0, 'C');
        $pdf->Cell(20, 7, $tardanzainjust, 1, 0, 'C');
        $pdf->Cell(18, 7, '', 0, 0, 'C');

        $pdf->Cell(19, 7, $bimestre, 1, 0, 'C');
        $pdf->Cell(30, 7, $puntualidad, 1, 0, 'C');
        $pdf->Cell(30, 7, $respeto, 1, 0, 'C');
        $pdf->Cell(30, 7, $responsabilidad, 1, 0, 'C');
        $pdf->Cell(30, 7, $aseo, 1, 1, 'C');
        $pdf->Ln();
    }
} else {
    $pdf->Cell(255, 10, utf8_decode('No se encontraron promedios para el alumno (a).'), 1, 1, 'C');
}
$pdf->Ln(2);
// Fin Datos del comportamiento

//Consulta free
$queryExtra = mysqli_query($conexion, "
    SELECT lugar FROM (
        SELECT 
            b.alumno AS id_alumno, 
            b.promediogeneral, 
            @rownum := @rownum + 1 AS lugar 
        FROM boletanotas b
        INNER JOIN alumnos a ON b.alumno = a.idalum
        CROSS JOIN (SELECT @rownum := 0) r
        WHERE a.aula = '1' AND b.bimestre = '$idbime'
        ORDER BY b.promediogeneral DESC
    ) AS ranked_list
    WHERE id_alumno = '$idUser'
");

$lugar = '';

// Verificar si se obtuvo el lugar
if (mysqli_num_rows($queryExtra) > 0) {
    $rowExtra = mysqli_fetch_assoc($queryExtra);
    $lugar = $rowExtra['lugar'];
}

// Consulta de la tabla boletanotas
$queryBoletaNota = mysqli_query($conexion, "SELECT a.idalum, 
b.abrev AS bimestre, n.promedioarea, n.comportamiento,
n.promediogeneral, n.apreciacion, n.alumno
FROM boletanotas n
INNER JOIN alumnos a ON n.alumno = a.idalum
INNER JOIN bimestres b ON n.bimestre = b.idbime
WHERE n.alumno = $idUser AND b.idbime = $idbime
");

// Datos de promedio y orden de mérito
// Encabezados de la tabla
$pdf->SetFont('Arial', 'B', 9);
$pdf->SetFillColor(228, 231, 224);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(30, 10, strtoupper(utf8_decode('Bimestre')), 1, 0, 'C', true);
$pdf->Cell(56.25, 10, strtoupper(utf8_decode('Orden de Mérito')), 1, 0, 'C', true);
$pdf->Cell(56.25, 10, strtoupper(utf8_decode('Promedio de Áreas')), 1, 0, 'C', true);
$pdf->Cell(56.25, 10, strtoupper(utf8_decode('Promedio de Conducta')), 1, 0, 'C', true);
$pdf->Cell(56.25, 10, strtoupper(utf8_decode('Promedio General')), 1, 1, 'C', true);

// Cuerpo de la tabla
$pdf->SetFont('Arial', '', 9);
$pdf->SetTextColor(0, 0, 0);
if (mysqli_num_rows($queryBoletaNota) > 0) {
    while ($row = mysqli_fetch_assoc($queryBoletaNota)) {
        $bimestre = $row['bimestre'];
        $promedioarea = $row['promedioarea'];
        $comportamiento = $row['comportamiento'];
        $promediogeneral = $row['promediogeneral'];
        $pdf->Cell(30, 10, $bimestre, 1, 0, 'C');
        $pdf->Cell(56.25, 10, $lugar, 1, 0, 'C');
        $pdf->Cell(56.25, 10, $promedioarea, 1, 0, 'C');
        $pdf->Cell(56.25, 10, $comportamiento, 1, 0, 'C');
        $pdf->Cell(56.25, 10, $promediogeneral, 1, 1, 'C');
    }
} else {
    $pdf->Cell(255, 10, utf8_decode('No se encontraron detalles del promedio del alumno (a).'), 1, 1, 'C');
}
$pdf->Ln(8);

// Fin Datos de promedio y orden de mérito

mysqli_data_seek($queryBoletaNota, 0);

// Datos de apreciación del tutor(A)
// Encabezados de la tabla
$pdf->SetFont('Arial', 'B', 9);
$pdf->SetFillColor(228, 231, 224);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(30, 10, strtoupper(utf8_decode('Bimestre')), 1, 0, 'C', true);
$pdf->Cell(225, 10, strtoupper(utf8_decode('Apreciación del Tutor (a)')), 1, 1, 'C', true);

// Cuerpo de la tabla
$pdf->SetFont('Arial', '', 9);
$pdf->SetTextColor(0, 0, 0);
if (mysqli_num_rows($queryBoletaNota) > 0) {
    while ($row = mysqli_fetch_assoc($queryBoletaNota)) {
        $bimestre = $row['bimestre'];
        $apreciacion = $row['apreciacion'];
        $pdf->Cell(30, 10, $bimestre, 1, 0, 'C');
        $pdf->Cell(225, 10, utf8_decode($apreciacion), 1, 1, 'C');
    }
} else {
    $pdf->Cell(255, 10, utf8_decode('No se encontraron detalles del tutor (a) para el alumno (a).'), 1, 1, 'C');
}
// Fin Datos de apreciación del tutor(A)


// Nombre del documento
$alumno_filename = preg_replace('/[^A-Za-z0-9_\-]/', '_', strtoupper($alumno));
$pdf->Output('D', "BLASPASCAL_{$alumno_filename}.pdf");
?>
