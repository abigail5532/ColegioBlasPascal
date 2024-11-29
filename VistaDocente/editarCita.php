<?php
session_start();
$id_user = $_SESSION['idUser'];
include('../Includes/Connection.php');
include_once "Ajax/actualizarCita.php";
include('../Includes/HeaderDoc.php');

// Obtener los datos de la cita para editar
$idcita = $_GET['id'];
$query = $conexion->prepare("SELECT * FROM cita WHERE idcita = ?");
$query->bind_param('i', $idcita);
$query->execute();
$result = $query->get_result();
$cita = $result->fetch_assoc();


?>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="head-table m-0 font-weight-bold">Editar reunión</h6>
        </div>
        <div class="card-body" style="color: black;">
            <form id="formEditarCita" method="POST" action="">
                <input type="hidden" name="idcita" value="<?php echo $cita['idcita']; ?>">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-form-label">Alumno</label>
                            <input type="text" class="form-control" value="<?php echo $cita['alumno']; ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Docente</label>
                            <input type="text" class="form-control" value="<?php echo $cita['docente']; ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Fecha</label>
                            <input type="text" class="form-control" value="<?php echo $cita['fecha']; ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Hora</label>
                            <input type="text" class="form-control" value="<?php echo $cita['horai'] . ' - ' . $cita['horaf']; ?>" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-form-label">Nombre del familiar</label>
                            <input type="text" class="form-control" value="<?php echo $cita['nomfamiliar']; ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Detalles</label>
                            <textarea class="form-control" rows="5" disabled><?php echo $cita['descripcion']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Enlace</label>
                            <input type="text" class="form-control" name="link" value="<?php echo $cita['link']; ?>">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Estado</label>
                            <select class="form-control" name="estado">
                                <option value="Reservado" <?php echo $cita['estado'] == 'Reservado' ? 'selected' : ''; ?>>Reservado</option>
                                <option value="Aceptado" <?php echo $cita['estado'] == 'Aceptado' ? 'selected' : ''; ?>>Aceptado</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="tblCitas.php" class="btn btn-danger">Cancelar</a>
                    <button type="submit" class="btn" style="background-color: #71B600; color: white;">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
include_once "../Includes/Footer.php";
?>

