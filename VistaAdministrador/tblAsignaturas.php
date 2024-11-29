<?php
session_start();
$id_user = $_SESSION['idUser'];
include('../Includes/Connection.php');
include_once "Ajax/ajaxAsignaturas.php";
include_once "../Includes/Header.php";
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!--DATATABLE-->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="head-table m-0 font-weight-bold">Registro de Asignaturas</h6>
        </div>
        <div class="card-body">
            <a href="addAsignaturas.php" id="btnNuevo" class="btn btn-light" type="button" style="background-color:  #71B600; color: white;"><i class="fa-solid fa-circle-plus"></i> Agregar</a>
            </br>
            </br> 
            <div class="table-responsive" style="color: black;">
                <table class="table table-bordered" id="tblBlasPascal" width="100%" cellspacing="0" style="color: black;">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Área Curricular</th>
                            <th>Asignatura</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php include('../Includes/Connection.php');
                        $query = mysqli_query($conexion, "SELECT a.idasig, a.nombre, a.estado, c.nombre AS areacurricular FROM asignaturas a
                        INNER JOIN area_curricular c ON a.areacurricular = c.idarea");
                        $result = mysqli_num_rows($query);
                        if ($result > 0) {
                            while ($data = mysqli_fetch_assoc($query)) { ?>
                        <tr>
                            <td><?php echo $data['idasig']; ?></td>
                            <td><?php echo $data['areacurricular']; ?></td>
                            <td><?php echo $data['nombre']; ?></td>
                            <td><?php echo $data['estado']; ?></td>
                            <td>
                                <a href="addEvaluacion.php?idasig=<?php echo $data['idasig']; ?>" class="btn" style="background-color: #3357FF; color: white;"><i class='fas fa-book'></i></a>
                                <a href="addAsignaturas.php?idasig=<?php echo $data['idasig']; ?>" class="btn" style="background-color: #71B600; color: white;"><i class='fas fa-edit'></i></a>
                                <form action="deleteAsignaturas.php?idasig=<?php echo $data['idasig']; ?>" method="post" class="eliminarconfirmar d-inline">
                                    <button class="btn" style="background-color: red; color: white;" type="submit"><i class='fas fa-trash-alt'></i> </button>
                                </form>
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
<!-- /.End Page Content -->
<?php
require_once "../Includes/Footer.php";
?>