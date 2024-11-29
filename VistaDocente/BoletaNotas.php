<?php
session_start();
$id_user = $_SESSION['idUser'];
include('../Includes/Connection.php');
include_once "../Includes/HeaderDoc.php";
$idalum= isset($_GET['idalum']) ? $_GET['idalum'] : '';
$idaula = '';
//Consulta de datos del aula
$queryaula = mysqli_query($conexion, "SELECT au.idaula AS idaula,
au.seccion AS seccion, CONCAT(al.apellidos, ' ', al.nombres) AS alumno,
au.yearacad, n.nombre AS nivel, g.nombre AS grado, au.idaula
FROM alumnos al 
INNER JOIN aulas au ON al.aula = au.idaula 
INNER JOIN grados g ON au.grado = g.idgrado 
INNER JOIN niveles n ON g.nivel = n.idniv 
INNER JOIN docentes d ON au.tutor = d.iddoc
WHERE al.idalum = '$idalum'");
if ($queryaula && mysqli_num_rows($queryaula) > 0) {
    $row = mysqli_fetch_assoc($queryaula);
    $idaula = $row['idaula'];
    $yearacad = $row['yearacad'];
    $nivel = $row['nivel'];
    $grado = $row['grado'];
    $seccion = $row['seccion'];
    $alumno = $row['alumno'];
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!--CALIFICACIONES-->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="head-table m-0 font-weight-bold">Calificaciones del Aula</h6>
        </div>
        <div class="card-body" style="color: black;">
            <div class="table-responsive">
                <table class="table table-bordered" id="tblBlasPascal" width="100%" cellspacing="0" style="color: black;">
                    <thead>
                        <tr>
                            <th>Área Curricular</th>
                            <th style="width: 500px; word-wrap: break-word; text-align: center;">Criterios de Evaluación</th>
                            <th>Asignaturas</th>
                            <th>Promedio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include('../Includes/Connection.php');

                        if (isset($_GET['idalum'])) {
                            $idalum = $_GET['idalum'];
                            $query = mysqli_query($conexion, "SELECT p.idpromedio, p.promedio, a.idalum, 
                            p.idalumn, asig.nombre AS asignatura, ar.nombre AS areacurricular,
                            b.nombre AS bimestre, ar.descripcion AS descripcion, a.aula
                            FROM promedios p 
                            INNER JOIN asignaturas asig ON p.idasig = asig.idasig
                            INNER JOIN area_curricular ar ON asig.areacurricular = ar.idarea
                            INNER JOIN alumnos a ON p.idalumn = a.idalum
                            INNER JOIN bimestres b ON p.idbime = b.idbime
                            WHERE p.idalumn = $idalum ORDER BY ar.idarea ASC");

                            $areas = [];
                            while ($row = mysqli_fetch_assoc($query)) {
                                $areas[$row['areacurricular']]['descripcion'] = $row['descripcion'];
                                $areas[$row['areacurricular']]['asignaturas'][] = [
                                    'asignatura' => $row['asignatura'],
                                    'promedio' => $row['promedio']
                                ];
                            }
                        
                            foreach ($areas as $area => $data) {
                                $rowspan = count($data['asignaturas']);
                                echo "<tr>";
                                echo "<td rowspan='" . $rowspan . "'>$area</td>";
                                echo "<td rowspan='" . $rowspan . "'>" . $data['descripcion'] . "</td>";
                                echo "<td>" . $data['asignaturas'][0]['asignatura'] . "</td>";
                                echo "<td>" . $data['asignaturas'][0]['promedio'] . "</td>";
                                echo "</tr>";

                                for ($i = 1; $i < $rowspan; $i++) {
                                    echo "<tr>";
                                    echo "<td>" . $data['asignaturas'][$i]['asignatura'] . "</td>";
                                    echo "<td>" . $data['asignaturas'][$i]['promedio'] . "</td>";
                                    echo "</tr>";
                                }
                            }
                        }
                        ?>
                    </tbody>
                </table>
                <div class="modal-footer">
                    <a href="tblTutoriaAlumnos.php?idaula=<?php echo $idaula; ?>" class="btn" style="background-color: red; color: white;"><i class="fas fa-sign-out-alt"></i> Regresar</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once "../Includes/FooterDoc.php";
?>