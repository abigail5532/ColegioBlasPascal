

<?php
session_start();
$id_user = $_SESSION['idUser'];
include('../Includes/Connection.php');
include_once "../Includes/HeaderDoc.php";

// Manejo de acciones de confirmar y cancelar
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['accion']) && isset($_POST['idcita'])) {
        $idcita = $_POST['idcita'];
        if ($_POST['accion'] === 'finalizar') {
            // Finalizar la cita de la base de datos
            $query = $conexion->prepare("UPDATE cita SET estado = 'Atendido' WHERE idcita = ?");
            $query->bind_param('i', $idcita);
            if ($query->execute()) {
                echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire({
                                title: 'Éxito',
                                text: 'Cita confirmada',
                                icon: 'success',
                                confirmButtonText: 'Ok'
                            }).then(function() {
                                window.location = 'tblCitas.php';
                            });
                        });
                      </script>";
            } else {
                echo "<script>alert('Error al cancelar la cita'); window.location.href = 'tblCitas.php';</script>";
            }
        } elseif ($_POST['accion'] === 'cancelar') {
            // Eliminar la cita de la base de datos
            $query = $conexion->prepare("UPDATE cita SET estado = 'Cancelado' WHERE idcita = ?");
            $query->bind_param('i', $idcita);
            if ($query->execute()) {
                echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire({
                                title: 'Éxito',
                                text: 'Cita cancelada correctamente',
                                icon: 'success',
                                confirmButtonText: 'Ok'
                            }).then(function() {
                                window.location = 'tblCitas.php';
                            });
                        });
                      </script>";
            } else {
                echo "<script>alert('Error al cancelar la cita'); window.location.href = 'tblCitas.php';</script>";
            }
        }
    }
}

?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!--DATATABLE-->
    <div class="card shadow mb-4 ">
    <div class="card-header py-3">
            <h6 class="head-table m-0 font-weight-bold">Registro de Reuniones</h6>
        </div>
        <div class="card-body">
            <a href="Cita.php" id="btnNuevo" class="btn btn-light" type="button" style="background-color:  #71B600; color: white;"><i class="fa-solid fa-circle-plus"></i> Agregar</a>
            <br><br> 
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active" id="presencial-tab" data-bs-toggle="tab" href="#presencial" role="tab" aria-controls="presencial" aria-selected="true">Reuniones Presenciales</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="virtual-tab" data-bs-toggle="tab" href="#virtual" role="tab" aria-controls="virtual" aria-selected="false">Reuniones Virtuales</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="table-responsive" style="color: black;">
                <div class="tab-content" id="myTabContent">
                    <!-- Contenido de la pestaña Reuniones Presenciales -->
                    <div class="tab-pane fade show active" id="presencial" role="tabpanel" aria-labelledby="presencial-tab">
                        <table class="table table-bordered" id="tblPresencial" width="100%" cellspacing="0" style="color: black;">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Alumno</th>
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
                                $query_presencial = mysqli_query($conexion, "SELECT c.idcita, CONCAT(a.nombres, ' ', a.apellidos) AS alumno_nombre, 
                                    c.reunion, c.fecha, c.horai, c.horaf, c.nomfamiliar, c.descripcion, c.link, c.estado FROM cita AS c
                                    JOIN alumnos AS a ON c.alumno = a.idalum WHERE c.docente = '$id_user' AND c.reunion = 'Presencial'");
                                $result_presencial = mysqli_num_rows($query_presencial);
                                if ($result_presencial > 0) {
                                    while ($data = mysqli_fetch_assoc($query_presencial)) { ?>
                                <tr>
                                    <td><?php echo $data['idcita']; ?></td>
                                    <td><?php echo $data['alumno_nombre']; ?></td>
                                    <td><?php echo $data['reunion']; ?></td>
                                    <td><?php echo $data['fecha']; ?></td>
                                    <td><?php echo $data['horai']; ?> - <?php echo $data['horaf']; ?></td>
                                    <td><?php echo $data['nomfamiliar']; ?></td>
                                    <td><?php echo $data['descripcion']; ?></td>
                                    <td><?php echo $data['estado']; ?></td>
                                    <td>
                                        <button class="btn btn-success" onclick="finalizarCita(<?php echo $data['idcita']; ?>)"><i class='fas fa-check'></i></button>
                                        <button class="btn btn-danger" onclick="cancelarCita(<?php echo $data['idcita']; ?>)"><i class='fas fa-times'></i></button>
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
                                    <th>Alumno</th>
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
                                $query_virtual = mysqli_query($conexion, "SELECT c.idcita, CONCAT(a.nombres, ' ', a.apellidos) AS alumno_nombre, 
                                    c.reunion, c.fecha, c.horai, c.horaf, c.nomfamiliar, c.descripcion, c.link, c.estado FROM cita AS c
                                    JOIN alumnos AS a ON c.alumno = a.idalum WHERE c.docente = '$id_user' AND c.reunion = 'Virtual'");
                                $result_virtual = mysqli_num_rows($query_virtual);
                                if ($result_virtual > 0) {
                                    while ($data = mysqli_fetch_assoc($query_virtual)) { ?>
                                <tr>
                                    <td><?php echo $data['idcita']; ?></td>
                                    <td><?php echo $data['alumno_nombre']; ?></td>
                                    <td><?php echo $data['reunion']; ?></td>
                                    <td><?php echo $data['fecha']; ?></td>
                                    <td><?php echo $data['horai']; ?> - <?php echo $data['horaf']; ?></td>
                                    <td><?php echo $data['nomfamiliar']; ?></td>
                                    <td><?php echo $data['descripcion']; ?></td>
                                    <td><?php echo $data['link'] ? "<a href='{$data['link']}' target='_blank'>Zoom</a>" : ""; ?></td>
                                    <td><?php echo $data['estado']; ?></td>
                                    <td>
                                        <button class="btn btn-success" onclick="finalizarCita(<?php echo $data['idcita']; ?>)"><i class='fas fa-check'></i></button>
                                        <button class="btn btn-danger" onclick="cancelarCita(<?php echo $data['idcita']; ?>)"><i class='fas fa-times'></i></button>
                                        <a href="editarCita.php?id=<?php echo $data['idcita']; ?>" class="btn btn-warning"><i class='fas fa-edit'></i></a>
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
function finalizarCita(idcita) {
    Swal.fire({
        title: 'Finalizar Reunión',
        text: "¿Atendiste la reunión?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sí',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            // Crear un formulario y enviarlo
            let form = document.createElement('form');
            form.method = 'POST';
            form.action = 'tblCitas.php';
            let inputAccion = document.createElement('input');
            inputAccion.type = 'hidden';
            inputAccion.name = 'accion';
            inputAccion.value = 'finalizar';
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

function cancelarCita(idcita) {
    Swal.fire({
        title: 'Cancelar Reunión',
        text: "¿Estás seguro de que quieres cancelar esta reunión?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sí, cancelar',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            // Crear un formulario y enviarlo
            let form = document.createElement('form');
            form.method = 'POST';
            form.action = 'tblCitas.php';
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
