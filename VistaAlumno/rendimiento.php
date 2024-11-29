<?php
session_start();
$id_user = $_SESSION['idUser'];
include('../Includes/Connection.php');
include_once "../Includes/HeaderAlum.php";
$idaula= isset($_GET['idaula']) ? $_GET['idaula'] : '';
//Consulta de datos del aula
$queryaula = mysqli_query($conexion, "SELECT au.idaula AS idaula,
CONCAT(n.nombre, ' - ', g.nombre, ' ', au.seccion) AS aula_nombre,
au.yearacad, al.idalum
FROM alumnos al 
INNER JOIN aulas au ON al.aula = au.idaula 
INNER JOIN grados g ON au.grado = g.idgrado 
INNER JOIN niveles n ON g.nivel = n.idniv
WHERE al.idalum = '$id_user'");
if ($queryaula && mysqli_num_rows($queryaula) > 0) {
    $datoalumno = mysqli_fetch_assoc($queryaula);
    $idaula = $datoalumno['idaula'];
    $yearacad = $datoalumno['yearacad'];
    $aula_nombre = $datoalumno['aula_nombre'];
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Content Row -->
    <div class="row">
        <!-- Chart 1 -->
            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <!-- Card Header --> 
                    <div class="card-header py-3 d-flex flex-row justify-content-between">
                        <h6 class="head-table m-0 font-weight-bold">Progreso Académico por Bimestre - <?php echo $yearacad; ?></h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body" style="color: black;">
                        <div class="chart-area">
                            <canvas id="AreaChartAlumno"></canvas>
                        </div>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="tblBlasPascalFree" width="100%" cellspacing="0" style="color: black; font-size: 15px;">
                                <thead>
                                    <tr>
                                        <th>Bimestre</th>
                                        <th>Promedio</th>
                                        <th>Boleta de Notas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php include('../Includes/Connection.php');
                                    $queryPromedio = mysqli_query($conexion, "SELECT bi.idbime,
                                    b.alumno, bi.abrev AS nombre_bimestre_abrev, b.promediogeneral
                                    FROM boletanotas b 
                                    INNER JOIN alumnos a ON b.alumno = a.idalum
                                    INNER JOIN bimestres bi ON b.bimestre = bi.idbime
                                    WHERE b.alumno = '$id_user'");
                                    $result = mysqli_num_rows($queryPromedio);
                                    if ($result > 0) {
                                        while ($data = mysqli_fetch_assoc($queryPromedio)) { ?>
                                    <tr>
                                        <td><?php echo $data['nombre_bimestre_abrev']; ?></td>
                                        <td><?php echo $data['promediogeneral']; ?></td>
                                        <td>
                                            <a href="../Reports/BoletaNotas.php?idUser=<?php echo $id_user; ?>&idbime=<?php echo $data['idbime']; ?>&nombre_bimestre_abrev=<?php echo $data['nombre_bimestre_abrev']; ?>" 
                                            class="btn" type="button" style="background-color: red; color: white;">
                                                <i class="fas fa-file-pdf"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php }
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <!-- Chart 2 -->
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <!-- Card Header -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="head-table m-0 font-weight-bold">Promedios de cada Asignatura / <?php echo $aula_nombre; ?></h6></h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body" style="color: black;">
                        <div class="form-group">
                            <select class="form-control" name="bimestre" id="bimestre" onchange="filtroBimestres()" style="color: black;">
                                <?php
                                $query = mysqli_query($conexion, "SELECT pr.idbime, b.nombre AS nombre_bimestre,
                                GROUP_CONCAT(DISTINCT asig.nombre ORDER BY asig.nombre ASC) AS asignaturas
                                FROM promedios pr
                                INNER JOIN asignaturas asig ON pr.idasig = asig.idasig
                                INNER JOIN bimestres b ON pr.idbime = b.idbime
                                WHERE pr.idalumn = '$id_user' GROUP BY pr.idbime, b.nombre");
                                while ($row = mysqli_fetch_assoc($query)) {
                                    echo "<option value='". $row['idbime']. "'>". $row['nombre_bimestre']. "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="chart-area">
                            <canvas id="AreaBarAlumno"></canvas> 
                        </div>
                        <hr>
                        <div class="row" style="font-size: 15px;">
                            <div class="col text-center">
                                <span class="legend-color mr-1" style="background-color: #0000FF; display: inline-block;"></span> Aprobado
                            </div>
                            <div class="col text-center">
                                <span class="legend-color mr-1" style="background-color: #FFDC00; display: inline-block;"></span> En Proceso - Aprobado
                            </div>
                            <div class="col text-center">
                                <span class="legend-color mr-1" style="background-color: #FF0000; display: inline-block;"></span> Desaprobado
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card shadow mb-4">
                    <!-- Card Header -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="head-table m-0 font-weight-bold">Progreso Académico por Asignatura</h6></h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body" style="color: black;">
                        <div class="form-group">
                            <select class="form-control" name="asignatura" id="asignatura" onchange="filtroAsignaturas()" style="color: black;">
                                <?php
                                $query = mysqli_query($conexion, "SELECT
                                evno.evalua, evno.idalumn, evno.nota, asig.nombre, asig.idasig AS idid 
                                FROM evaluacionnotas evno
                                INNER JOIN evaluaciones ev ON evno.evalua = ev.ideva
                                INNER JOIN asignaturas asig ON ev.idasig = asig.idasig
                                INNER JOIN bimestres b ON ev.bimestre = b.idbime
                                WHERE evno.idalumn = '$id_user' GROUP BY ev.idasig, asig.nombre");
                                while ($rowasig = mysqli_fetch_assoc($query)) {
                                    echo "<option value='". $rowasig['idid']. "'>". $rowasig['nombre']. "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="chart-area">
                            <canvas id="AreaBarCalificacionesAsignaturas"></canvas> 
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>

<?php
require_once "../Includes/FooterAlum.php";
?>
