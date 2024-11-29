<?php
session_start();
$id_user = $_SESSION['idUser'];
include('../Includes/Connection.php');
include_once "../Includes/HeaderDoc.php";
$idaula= isset($_GET['idaula']) ? $_GET['idaula'] : '';
//Consulta de datos del aula
$queryaula = mysqli_query($conexion, "SELECT
COUNT(al.idalum) AS total_alumnos, au.idaula AS idaula,
au.seccion AS seccion, CONCAT(d.apellidos, ' ', d.nombres) AS tutor,
CONCAT(al.apellidos, ' ', al.nombres) AS alumno,
au.yearacad, n.nombre AS nivel, g.nombre AS grado 
FROM alumnos al 
INNER JOIN aulas au ON al.aula = au.idaula 
INNER JOIN grados g ON au.grado = g.idgrado 
INNER JOIN niveles n ON g.nivel = n.idniv 
INNER JOIN docentes d ON au.tutor = d.iddoc
WHERE au.idaula = '$idaula'");
if ($queryaula && mysqli_num_rows($queryaula) > 0) {
    $row = mysqli_fetch_assoc($queryaula);
    $yearacad = $row['yearacad'];
    $nivel = $row['nivel'];
    $grado = $row['grado'];
    $seccion = $row['seccion'];
    $tutor = $row['tutor'];
    $total_alumnos = $row['total_alumnos'];
}
?>


<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <!--DATOS DEL AULA-->
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="head-table m-0 font-weight-bold">Datos del Aula</h6>
                </div>
                <div class="card-body" style="color: black;">
                    <div class="text-center">
                        <img class="img-fluid px-3 px-sm-4 mt-2 mb-2" style="width: 26rem;"
                            src="../Imagenes/podio.png" alt="...">
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h6>
                                <i class="fa-solid fa-paperclip" style="color: #71B600;"></i> <strong>Año Académico:</strong>
                                <span><?php echo $yearacad; ?></span>
                            </h6>
                            <h6>
                                <i class="fa-solid fa-paperclip" style="color: #71B600;"></i> <strong>Nivel Académico:</strong>
                                <span><?php echo $nivel; ?></span>
                            </h6>
                            <h6>
                                <i class="fa-solid fa-paperclip" style="color: #71B600;"></i> <strong>Grado y Sección:</strong>
                                <span><?php echo $grado; ?> <?php echo $seccion; ?></span>
                            </h6>
                        </div>
                        <div class="col-md-6">
                            <h6>
                                <i class="fa-solid fa-paperclip" style="color: #71B600;"></i> <strong>Tutor(a):</strong>
                                <span><?php echo $tutor; ?></span>
                            </h6>
                            <h6>
                                <i class="fa-solid fa-paperclip" style="color: #71B600;"></i> <strong>Cantidad de Alumnos:</strong>
                                <span><?php echo $total_alumnos; ?></span>
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--PODIO-->
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="head-table m-0 font-weight-bold">Tabla de Orden de Mérito</h6>
                </div>
                <div class="card-body" style="color: black;">
                    <div class="form-group">
                        <select class="form-control" name="bimestre" id="bimestre" style="color: black;" onchange="filtroBimestre()">
                            <option selected disabled> -- Seleccionar bimestre académico -- </option>
                            <?php
                            $querybimestre = mysqli_query($conexion, "SELECT a.aula, bn.bimestre,
                            b.nombre AS nombre_bimestre
                            FROM boletanotas bn
                            INNER JOIN alumnos a ON bn.alumno = a.idalum
                            INNER JOIN aulas au ON a.aula = au.idaula
                            INNER JOIN bimestres b ON bn.bimestre = b.idbime
                            WHERE a.aula = '$idaula' GROUP BY bn.bimestre ORDER BY bn.bimestre");
                            while ($databime = mysqli_fetch_assoc($querybimestre)) {
                                echo "<option value='". $databime['bimestre']. "'>". $databime['nombre_bimestre']. "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="table-responsive" style="color: black;">
                        <table class="table table-bordered"  id="tblBlasPascalFree" width="100%" cellspacing="0" style="color: black;">
                            <thead>
                                <tr>
                                    <th>Orden</th>
                                    <th>Alumnos</th>
                                    <th>Promedio</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="3">Selecciona un bimestre</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn" data-toggle="modal" data-target="#modalinfo" style="background-color: #A833FF; color: white;">
                            <i class="fas fa-chart-line"></i>
                        </a>
                        <a href="../Reports/pdfAulas.php?idaula=<?php echo $row['idaula']; ?>" class="btn" style="background-color: red; color: white;"><i class="fa-solid fa-file-pdf"></i></a>
                        <a href="../Reports/ExcelAulas.php?idaula=<?php echo $row['idaula']; ?>" class="btn" style="background-color: #71B600; color: white;"><i class="fa-solid fa-file-excel"></i></a>
                        <a href="tblTutoriaAlumnos.php?idaula=<?php echo $row['idaula']; ?>"  class="btn" style="background-color: #D3420A; color: white;"><i class="fas fa-school"></i></a>
                        <a href="tblAsignaturas.php" class="btn" style="background-color: #3357FF; color: white;"><i class="fas fa-sign-out-alt"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Begin Modal -->
<div class="modal fade modalcalendar" id="modalinfo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="staticBackdropLabel">
                    <strong>
                        <div id="aulaInfo" class="aula-info"></div>
                    </strong>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">    
                <div class="chart-area">
                    <canvas id="AreaChartAulaDocente"></canvas>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" style="background-color: #71B600; color: white;" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->


<script type="text/javascript">
  document.addEventListener('DOMContentLoaded', function () {
    var myModal = new bootstrap.Modal(document.getElementById('modalinfo'));
  });
</script>
<script>
    function filtroBimestre() {
        var bimestre = document.getElementById('bimestre').value;
        var idaula = "<?php echo $idaula; ?>"; // Asegúrate de que esta línea esté en el script
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'FiltroTutoria.php?bimestre=' + bimestre + '&idaula=' + idaula, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                document.getElementById('tblBlasPascalFree').getElementsByTagName('tbody')[0].innerHTML = xhr.responseText;
            }
        };
        xhr.send();
    }
</script>

<?php
require_once "../Includes/Footer.php";
?>