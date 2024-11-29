<?php
session_start();
$id_user = $_SESSION['idUser'];
include('../Includes/Connection.php');
include_once "Ajax/ajaxHorarios.php";
include_once "../Includes/HeaderDoc.php";
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!--DATATABLE-->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="head-table m-0 font-weight-bold">Registro de Horarios</h6>
        </div>
    
        <div class="card-body">
            <a href="addHorarios.php" id="btnNuevo" class="btn btn-light" type="button" style="background-color:  #71B600; color: white;"><i class="fa-solid fa-circle-plus"></i> Agregar</a>
            </br>
            </br>
            
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active" id="presencial-tab" data-bs-toggle="tab" href="#presencial" role="tab" aria-controls="presencial" aria-selected="true"> Presenciales</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="virtual-tab" data-bs-toggle="tab" href="#virtual" role="tab" aria-controls="virtual" aria-selected="false">Virtuales</a>
                </li>
            </ul>
        </div>
            <div class="table-responsive" style="color: black;">
                <div class="tab-content" id="myTabContent">
                    <!-- Contenido de la pestaña Reuniones Presenciales -->
                    <div class="tab-pane fade show active" id="presencial" role="tabpanel" aria-labelledby="presencial-tab">
                        <table class="table table-bordered" id="tblPresencial" width="100%" cellspacing="0" style="color: black;">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Reunion</th>
                                    <th>Fecha</th>
                                    <th>Hora Inicial</th>
                                    <th>Hora Final</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query_presencial = mysqli_query($conexion, "SELECT * FROM horario WHERE iddocen = '$id_user' AND reunion = 'Presencial'");
                                $result_presencial = mysqli_num_rows($query_presencial);
                                if ($result_presencial > 0) {
                                    while ($data = mysqli_fetch_assoc($query_presencial)) { ?>
                                <tr>
                                    <td><?php echo $data['id']; ?></td>
                                    <td><?php echo $data['reunion']; ?></td>
                                    <td><?php echo $data['dia']; ?></td>
                                    <td><?php echo $data['horai']; ?></td>
                                    <td><?php echo $data['horaf']; ?></td>
                                    <td><?php echo $data['estado']; ?></td>
                                    <td>
                                        <a href="addHorarios.php?id=<?php echo $data['id']; ?>" class="btn btn-warning"><i class='fas fa-edit'></i></a>
                                        <form action="deleteHorario.php?id=<?php echo $data['id']; ?>" method="post" class="eliminarconfirmar d-inline">
                                            <button class="btn btn-danger" type="submit"><i class='fas fa-trash-alt'></i> </button>
                                        </form>
                                    </td>
                                </tr>
                                <?php }
                                } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- Contenido de la pestaña Reuniones Virtuales -->
                    <div class="tab-pane fade" id="virtual" role="tabpanel" aria-labelledby="virtual-tab">
                        <table class="table table-bordered" id="tblVirtual" width="100%" cellspacing="0" style="color: black;">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Reunion</th>
                                    <th>Fecha</th>
                                    <th>Hora Inicial</th>
                                    <th>Hora Final</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query_virtual = mysqli_query($conexion, "SELECT * FROM horario WHERE iddocen = '$id_user' AND reunion = 'Virtual'");
                                $result_virtual = mysqli_num_rows($query_virtual);
                                if ($result_virtual > 0) {
                                    while ($data = mysqli_fetch_assoc($query_virtual)) { ?>
                                <tr>
                                    <td><?php echo $data['id']; ?></td>
                                    <td><?php echo $data['reunion']; ?></td>
                                    <td><?php echo $data['dia']; ?></td>
                                    <td><?php echo $data['horai']; ?></td>
                                    <td><?php echo $data['horaf']; ?></td>
                                    <td><?php echo $data['estado']; ?></td>
                                    <td>
                                        <a href="addHorarios.php?id=<?php echo $data['id']; ?>" class="btn btn-warning"><i class='fas fa-edit'></i></a>
                                        <form action="deleteHorario.php?id=<?php echo $data['id']; ?>" method="post" class="eliminarconfirmar d-inline">
                                            <button class="btn btn-danger" type="submit"><i class='fas fa-trash-alt'></i> </button>
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
    </div>
</div>

<!-- /.End Page Content -->
<?php
require_once "../Includes/Footer.php";
?>

<!-- Script para manejar el cambio de pestañas -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const triggerTabList = document.querySelectorAll('.nav-tabs .nav-link');
    triggerTabList.forEach(triggerEl => {
        triggerEl.addEventListener('click', function(event) {
            event.preventDefault();
            const tabId = this.getAttribute('href').substring(1);
            const tabContent = document.getElementById(tabId);
            
            // Desactivar todas las pestañas y contenido
            document.querySelectorAll('.nav-tabs .nav-link').forEach(link => link.classList.remove('active'));
            document.querySelectorAll('.tab-content .tab-pane').forEach(pane => pane.classList.remove('show', 'active'));
            
            // Activar la pestaña y el contenido seleccionados
            this.classList.add('active');
            tabContent.classList.add('show', 'active');
        });
    });
});
</script>


