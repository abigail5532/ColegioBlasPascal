<?php
session_start();
$id_user = $_SESSION['idUser'];
include('../Includes/Connection.php');
include_once "../Includes/HeaderDoc.php";
include_once "Ajax/ajaxComportamiento.php";
$idaula= isset($_GET['idaula']) ? $_GET['idaula'] : '';
$idalum= isset($_GET['idalum']) ? $_GET['idalum'] : '';
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!--DATATABLE-->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="head-table m-0 font-weight-bold">Registro de Alumnos</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive" style="color: black;">
                <table class="table table-bordered" id="tblFree" width="100%" cellspacing="0" style="color: black;">
                    <thead>
                        <tr>
                            <th>Apellidos y Nombres</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php include('../Includes/Connection.php');
                        $query = mysqli_query($conexion, "SELECT a.idalum,
                        n.nombre AS nivel, g.nombre AS grado, au.seccion, CONCAT(a.apellidos, ', ', a.nombres) AS nombre_alumno, au.idaula
                        FROM alumnos a
                        INNER JOIN aulas au ON a.aula = au.idaula
                        INNER JOIN grados g ON au.grado = g.idgrado
                        INNER JOIN niveles n ON g.nivel = n.idniv
                        WHERE a.aula = '$idaula' ORDER BY nombre_alumno ASC");
                        
                        while ($data = mysqli_fetch_assoc($query)) { ?>
                        <tr>
                            <td><?php echo $data['nombre_alumno'];?></td>
                            <td>
                                <a href="Retroalimentacion.php?idalum=<?php echo $data['idalum']; ?>&idaula=<?php echo $data['idaula']; ?>" class="btn" style="background-color: #71B600; color: white;">
                                    Retroalimentación <i class="fas fa-clipboard-list"></i>
                                </a>
                                <a href="addComportamiento.php?idalum=<?php echo $data['idalum']; ?>&idaula=<?php echo $data['idaula']; ?>" class="btn" style="background-color: #3357FF; color: white;">
                                    Comportamiento <i class="fas fa-people-roof"></i>
                                </a>
                                <a href="BoletaNotas.php?idalum=<?php echo $data['idalum']; ?>&idaula=<?php echo $data['idaula']; ?>" class="btn" style="background-color: #71B600; color: white;">
                                    <i class="fas fa-clipboard-list"></i>
                                </a>
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