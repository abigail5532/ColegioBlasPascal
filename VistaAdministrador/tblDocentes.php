<?php
session_start();
$id_user = $_SESSION['idUser'];
include('../Includes/Connection.php');
include_once "Ajax/ajaxDocentes.php";
include_once "../Includes/Header.php";
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!--DATATABLE-->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="head-table m-0 font-weight-bold">Registro de Docentes</h6>
        </div>
        <div class="card-body">
            <a href="addDocentes.php" id="btnNuevo" class="btn" type="button" style="background-color:  #71B600; color: white;"><i class="fa-solid fa-circle-plus"></i> Agregar</a>
            </br>
            </br> 
            <div class="table-responsive" style="color: black;">
                <table class="table table-bordered" id="tblBlasPascal" width="100%" cellspacing="0" style="color: black;">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Apellidos y Nombres</th>
                            <th>DNI</th>
                            <th>Teléfono</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php include('../Includes/Connection.php');
                        $query = mysqli_query($conexion, "SELECT * FROM docentes");
                        $result = mysqli_num_rows($query);
                        if ($result > 0) {
                            while ($row = mysqli_fetch_assoc($query)) { ?>
                        <tr>
                            <td><?php echo $row['iddoc']; ?></td>
                            <td><?php echo $row['apellidos'] . ', ' . $row['nombres']; ?></td>
                            <td><?php echo $row['dni']; ?></td>
                            <td><?php echo $row['telefono']; ?></td>
                            <td><?php echo $row['estado']; ?></td>
                            <td>
                                <a href="addAsignarDocenteAsignatura.php?iddoc=<?php echo $row['iddoc']; ?>" class="btn" style="background-color: #3357FF; color: white;"><i class='fas fa-book'></i></a>
                                <a href="addDocentes.php?iddoc=<?php echo $row['iddoc']; ?>" class="btn" style="background-color: #71B600; color: white;"><i class='fas fa-edit'></i></a>
                                <form action="deleteDocentes.php?iddoc=<?php echo $row['iddoc']; ?>" method="post" class="eliminarconfirmar d-inline">
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