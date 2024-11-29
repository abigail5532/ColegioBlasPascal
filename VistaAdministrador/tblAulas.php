<?php
session_start();
$id_user = $_SESSION['idUser'];
include('../Includes/Connection.php');
$query = mysqli_query($conexion, "SELECT au.idaula, n.nombre AS nivel, 
g.nombre AS grado, au.seccion, CONCAT(d.apellidos, ' ', d.nombres) AS tutor
FROM aulas au 
INNER JOIN docentes d ON au.tutor = d.iddoc 
INNER JOIN grados g ON au.grado = g.idgrado 
INNER JOIN niveles n ON g.nivel = n.idniv");
include('../Includes/Header.php');
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!--DATATABLE-->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="head-table m-0 font-weight-bold">Registro de Aulas</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive" style="color: black;">
                <table class="table table-bordered" id="tblBlasPascal" width="100%" cellspacing="0" style="color: black;">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nivel</th>
                            <th>Grado y Sección</th>
                            <th>Tutor(a)</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while ($row = mysqli_fetch_assoc($query)) { ?>
                        <tr>
                            <td><?php echo $row['idaula']; ?></td>
                            <td><?php echo $row['nivel']; ?></td>
                            <td><?php echo $row['grado'] . ' ' . $row['seccion']; ?></td>
                            <td><?php echo $row['tutor']; ?></td>
                            <td>
                                <a href="HorarioAula.php?idaula=<?php echo $row['idaula']; ?>" class="btn" style="background-color: #A833FF; color: white;"><i class="fa-solid fa-calendar-days"></i></a>
                                <a href="addAsignarGradoAsignatura.php?idaula=<?php echo $row['idaula']; ?>" class="btn" style="background-color: #3357FF; color: white;"><i class="fa-solid fa-book"></i></a>
                                <a href="../Reports/ExcelAulas.php?idaula=<?php echo $row['idaula']; ?>" class="btn" style="background-color: #71B600; color: white;"><i class="fa-solid fa-file-excel"></i></a>
                                <a href="../Reports/pdfAulas.php?idaula=<?php echo $row['idaula']; ?>" class="btn" style="background-color: red; color: white;"><i class="fa-solid fa-file-pdf"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div> 

</div>
<!-- /.End Page Content -->
<?php
require_once "../Includes/Footer.php";
?>