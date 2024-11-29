<?php
session_start();
$id_user = $_SESSION['idUser'];
include('../Includes/Connection.php');
include('../Includes/HeaderAlum.php');




// Manejo de acciones de confirmar y cancelar
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['accion']) && isset($_POST['idcita'])) {
        $idcita = $_POST['idcita'];
        if ($_POST['accion'] === 'cancelar') {
            // Obtener los datos de la cita antes de cambiar el estado
            $query_get_cita = $conexion->prepare("SELECT fecha, horai, horaf, docente FROM cita WHERE idcita = ?");
            $query_get_cita->bind_param('i', $idcita);
            $query_get_cita->execute();
            $result_cita = $query_get_cita->get_result();
            $data_cita = $result_cita->fetch_assoc();

            // Actualizar el estado de la cita a 'Cancelado'
            $query_update_cita = $conexion->prepare("UPDATE cita SET estado = 'Cancelado' WHERE idcita = ?");
            $query_update_cita->bind_param('i', $idcita);
            if ($query_update_cita->execute()) {
                // Actualizar el estado del horario a 'Activo'
                $fecha = $data_cita['fecha'];
                $horai = $data_cita['horai'];
                $horaf = $data_cita['horaf'];
                $docente_id = $data_cita['docente'];

                $query_update_horario = $conexion->prepare("UPDATE horario SET estado = 'Activo' WHERE iddocen = ? AND dia = ? AND horai = ? AND horaf = ?");
                $query_update_horario->bind_param('isss', $docente_id, $fecha, $horai, $horaf);
                if ($query_update_horario->execute()) {
                    echo "<script>
                            document.addEventListener('DOMContentLoaded', function() {
                                Swal.fire({
                                    title: 'Éxito',
                                    text: 'Reunión cancelada correctamente',
                                    icon: 'success',
                                    confirmButtonText: 'Ok'
                                }).then(function() {
                                    window.location = 'tblReuniones.php';
                                });
                            });
                          </script>";
                } else {
                    echo "<script>alert('Error al actualizar el estado del horario: " . $conexion->error . "'); window.location.href = 'tblReuniones.php';</script>";
                }
            } else {
                echo "<script>alert('Error al cancelar la reunión'); window.location.href = 'tblReuniones.php';</script>";
            }
        }
    }
}
?>

?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!--DATATABLE-->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="head-table m-0 font-weight-bold">Registro de Reuniones</h6>
        </div>
        <div class="card-body">
            <a href="addReuniones.php" id="btnNuevo" class="btn btn-light" type="button" style="background-color: #71B600; color: white;">
                <i class="fa-solid fa-circle-plus"></i> Agregar
            </a>
            </br></br> 
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="presencial-tab" data-bs-toggle="tab" href="#presencial" role="tab" aria-controls="presencial" aria-selected="true">Reuniones Presenciales</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="virtual-tab" data-bs-toggle="tab" href="#virtual" role="tab" aria-controls="virtual" aria-selected="false">Reuniones Virtuales</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <!-- Reuniones Presenciales -->
                <div class="tab-pane fade show active" id="presencial" role="tabpanel" aria-labelledby="presencial-tab">
                    <div class="table-responsive" style="color: black;">
                        <table class="table table-bordered" id="tblPresencial" width="100%" cellspacing="0" style="color: black;">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Docente</th>
                                    <th>Reunion</th>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Familiar</th>
                                    <th>Descripción</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query_presencial = mysqli_query($conexion, "SELECT c.idcita, CONCAT(a.nombres, ' ', a.apellidos) AS docente_nombre, 
                                    c.reunion, c.fecha, c.horai, c.horaf, c.nomfamiliar, c.descripcion, c.estado 
                                    FROM cita AS c JOIN docentes AS a ON c.docente = a.iddoc WHERE c.alumno = '$id_user' AND c.reunion = 'Presencial'");
                                $result_presencial = mysqli_num_rows($query_presencial);
                                if ($result_presencial > 0) {
                                    while ($data = mysqli_fetch_assoc($query_presencial)) { ?>
                                    <tr>
                                        <td><?php echo $data['idcita']; ?></td>
                                        <td><?php echo $data['docente_nombre']; ?></td>
                                        <td><?php echo $data['reunion']; ?></td>
                                        <td><?php echo $data['fecha']; ?></td>
                                        <td><?php echo $data['horai']; ?> - <?php echo $data['horaf']; ?></td>
                                        <td><?php echo $data['nomfamiliar']; ?></td>
                                        <td><?php echo $data['descripcion']; ?></td>
                                        <td><?php echo $data['estado']; ?></td>
                                        <td>
                                            <button class="btn btn-danger" onclick="cancelarCita(<?php echo $data['idcita']; ?>)"><i class='fas fa-times'></i> Cancelar</button>
                                        </td>
                                    </tr>
                                <?php }
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Reuniones Virtuales -->
                <div class="tab-pane fade" id="virtual" role="tabpanel" aria-labelledby="virtual-tab">
                    <div class="table-responsive" style="color: black;">
                        <table class="table table-bordered" id="tblVirtual" width="100%" cellspacing="0" style="color: black;">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Docente</th>
                                    <th>Reunion</th>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Familiar</th>
                                    <th>Descripción</th>
                                    <th>Link</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query_virtual = mysqli_query($conexion, "SELECT c.idcita, CONCAT(a.nombres, ' ', a.apellidos) AS docente_nombre, 
                                    c.reunion, c.fecha, c.horai, c.horaf, c.nomfamiliar, c.descripcion, c.link, c.estado 
                                    FROM cita AS c JOIN docentes AS a ON c.docente = a.iddoc WHERE c.alumno = '$id_user' AND c.reunion = 'Virtual'");
                                $result_virtual = mysqli_num_rows($query_virtual);
                                if ($result_virtual > 0) {
                                    while ($data = mysqli_fetch_assoc($query_virtual)) { ?>
                                    <tr>
                                        <td><?php echo $data['idcita']; ?></td>
                                        <td><?php echo $data['docente_nombre']; ?></td>
                                        <td><?php echo $data['reunion']; ?></td>
                                        <td><?php echo $data['fecha']; ?></td>
                                        <td><?php echo $data['horai']; ?> - <?php echo $data['horaf']; ?></td>
                                        <td><?php echo $data['nomfamiliar']; ?></td>
                                        <td><?php echo $data['descripcion']; ?></td>
                                        <td><?php echo $data['link'] ? "<a href='{$data['link']}' target='_blank'>Zoom</a>" : ""; ?></td>
                                        <td><?php echo $data['estado']; ?></td>
                                        <td>
                                            <button class="btn btn-danger" onclick="cancelarCita(<?php echo $data['idcita']; ?>)"><i class='fas fa-times'></i> Cancelar</button>
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
<!-- Script para manejar el cambio de pestañas -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const triggerTabList = document.querySelectorAll('.nav-tabs .nav-link');
    triggerTabList.forEach(triggerEl => {
        const tabTrigger = new bootstrap.Tab(triggerEl);

        triggerEl.addEventListener('click', event => {
            event.preventDefault();
            tabTrigger.show();
        });
    });
});
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function cancelarCita(idcita) {
    Swal.fire({
        title: 'Cancelar Cita',
        text: "¿Estás seguro de que quieres cancelar esta cita?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sí, cancelar reunión',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            // Crear un formulario y enviarlo
            let form = document.createElement('form');
            form.method = 'POST';
            form.action = 'tblReuniones.php';
            let inputAccion = document.createElement('input');
            inputAccion.type = 'hidden';
            inputAccion.name = 'accion';
            inputAccion.value = 'cancelar';
            let inputId = document.createElement('input');
            inputId.type = 'hidden';
            inputId.name = 'idcita';
            inputId.value = idcita;
            form.appendChild(inputAccion);
            form.appendChild(inputId);
            document.body.appendChild(form);
            form.submit();
        }
    });
}
</script>
<?php
include_once "../Includes/Footer.php";
?>



