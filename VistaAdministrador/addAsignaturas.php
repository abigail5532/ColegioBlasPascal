<?php
session_start();
$id_user = $_SESSION['idUser'];
include('../Includes/Connection.php');
include_once "Ajax/ajaxAsignaturas.php";
include_once "../Includes/Header.php";
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="head-table m-0 font-weight-bold">Registro de Asignatura</h6>
        </div>
        <div class="card-body" style="color: black;">
            <form id="formAsignaturas" method="post">
                <div class="form-group">
                    <label class="col-form-label">Área Curricular:</label>
                    <select class="form-control" name="areacurricularasig" id="areacurricularasig">
                        <option selected disabled> -- Seleccionar el área curricular -- </option>
                        <?php
                        $query = mysqli_query($conexion, "SELECT * FROM area_curricular");
                                while ($row = mysqli_fetch_assoc($query)) {
                                    $selected = ($row['idarea'] == $areacurricular) ? 'selected' : '';
                                    echo "<option value='" . $row['idarea'] . "' $selected>" . $row['nombre'] . "</option>";
                                }
                                ?>
                            </select>
                </div>
                <div class="form-group">
                    <input type="hidden" name="idasig" id="idasig" value="<?php echo $idasig; ?>">
                    <label class="col-form-label">Nombre:</label>
                    <input type="text" class="form-control" name="nombreasig" id="nombreasig" value="<?php echo $nombre; ?>">
                </div>
                <div class="form-group">
                    <label class="col-form-label">Estado:</label>
                    <select class="form-control" name="estadoasig" id="estadoasig">
                        <option value="Activo" <?php echo ($estado == 'Activo') ? 'selected' : ''; ?>>Activo</option>
                        <option value="Inactivo" <?php echo ($estado == 'Inactivo') ? 'selected' : ''; ?>>Inactivo</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <a href="tblAsignaturas.php" class="btn" style="background-color: red; color: white;">Cancelar </a>
                    <input type="submit" value="Guardar" class="btn" id="btnAccion" style="background-color: #71B600; color: white;">
                </div>
            </form>
        </div>
    </div>
</div>
<?php
include_once "../Includes/Footer.php";
?>