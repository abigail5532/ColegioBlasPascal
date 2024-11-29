<?php
include('../Includes/Connection.php');
if (isset($_GET['idaula'])) {
    $idaula = intval($_GET['idaula']);
}

$levelQuery = mysqli_query($conexion, "SELECT au.seccion, n.nombre AS nivel, g.nombre AS grado
    FROM aulas au 
    INNER JOIN grados g ON au.grado = g.idgrado 
    INNER JOIN niveles n ON g.nivel = n.idniv 
    WHERE au.idaula = $idaula");

if (mysqli_num_rows($levelQuery) > 0) {
    $levelData = mysqli_fetch_assoc($levelQuery);
    $nivel = htmlspecialchars($levelData['nivel'], ENT_QUOTES, 'UTF-8');
    $grado = htmlspecialchars($levelData['grado'], ENT_QUOTES, 'UTF-8');
    $seccion = htmlspecialchars($levelData['seccion'], ENT_QUOTES, 'UTF-8');
}
$query = mysqli_query($conexion, "SELECT a.idalum, asig.nombre AS asignatura, 
n.nombre AS nivel, g.nombre AS grado, au.seccion, CONCAT(a.apellidos, ', ', a.nombres) AS nombre_alumno
FROM alumnos a
INNER JOIN aulas au ON a.aula = au.idaula
INNER JOIN grados g ON au.grado = g.idgrado
INNER JOIN niveles n ON g.nivel = n.idniv
INNER JOIN asignar_grado_asignatura relgrado ON au.idaula = relgrado.aula
INNER JOIN asignaturas asig ON relgrado.asignatura = asig.idasig
WHERE a.aula = '$idaula' AND asig.idasig = '$idasig' ORDER BY nombre_alumno ASC");


header('Content-Type: application/vnd.ms-excel; charset=utf-8');
header('Content-Disposition: attachment;filename="BlasPascal_' . $nivel . $grado . $seccion . '.xls"');
header('Cache-Control: max-age=0');
echo "\xEF\xBB\xBF";
?>

<?php
//Datos de la institución
$queryinstitucion = mysqli_query($conexion, "SELECT * FROM institucion");
if (mysqli_num_rows($queryinstitucion) > 0) {
$row = mysqli_fetch_assoc($queryinstitucion);
$nombre = utf8_decode($row['nombre']);
$dre = utf8_decode($row['dre']);
$ugel = utf8_decode($row['ugel']);
$codmodular = utf8_decode($row['codmodular']);
}
?>

<style>
    table {
        border-collapse: collapse; /* Asegura que los bordes se colapsen en uno solo */
    }
    td {
        padding: 10px;
    }
    .bordered {
        border: 1px solid black; /* Cambia el color y el grosor del borde según tu preferencia */
    }
</style>
<table style="font-weight: 700;">
    <tbody>
        <tr>
            <td colspan="5"></td>
        </tr>
        <tr>
            <td rowspan="4"></td>
            <td colspan="1" class="bordered" style="background-color: #cef98a;">INSTITUCIÓN EDUCATIVA</td>
            <td colspan="3" class="bordered" style="background-color: #cef98a;"><?php echo strtoupper($nombre); ?></td>
        </tr>
        <tr>
            <td class="bordered" style="background-color: #cef98a;">DRE</td>
            <td class="bordered"><?php echo $dre; ?></td>
            <td class="bordered" style="background-color: #cef98a;">UGEL</td>
            <td class="bordered"><?php echo $ugel; ?></td>
        </tr>
        <tr>
            <td class="bordered" style="background-color: #cef98a;">NIVEL</td>
            <td class="bordered"><?php echo $nivel ?></td>
            <td class="bordered" style="background-color: #cef98a;">CÓDIGO MODULAR I.E.</td>
            <td class="bordered"><?php echo $codmodular; ?></td>
        </tr>
        <tr>
            <td class="bordered" style="background-color: #cef98a;">GRADO / AÑO</td>
            <td class="bordered"><?php echo $grado ?></td>
            <td class="bordered" style="background-color: #cef98a;">SECCIÓN</td>
            <td class="bordered"><?php echo $seccion ?></td>
        </tr>
        <tr>
            <td class="bordered" style="background-color: #cef98a;">ASIGNATURA</td>
            <td class="bordered"><?php echo $asignatura ?></td>
            <td class="bordered" style="background-color: #cef98a;">SECCIÓN</td>
            <td class="bordered"><?php echo $seccion ?></td>
        </tr>
    </tbody>
</table>

<br>
<br>

<table border="1">
    <tr>
        <th style="background-color: #cef98a; font-weight: 700;">N°</th>
        <th style="background-color: #cef98a; font-weight: 700;">NOMBRES Y APELLIDOS</th>
        <th colspan="10"></th>
    </tr>
    <?php
    $idCounter = 1;

    if (mysqli_num_rows($query) > 0) {
        while ($data = mysqli_fetch_assoc($query)) {
            $id = $idCounter++;
            $nombreCompleto = strtoupper(htmlspecialchars($data['nombre_alumno'], ENT_QUOTES, 'UTF-8'));
            ?>
            <tr>
                <td><?php echo $id; ?></td>
                <td><?php echo $nombreCompleto; ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <?php
        }
    } else {
        echo '<tr><td colspan="12">No se han registrado alumnos para el aula seleccionada.</td></tr>';
    }
    ?>
</table>
