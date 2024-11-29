<?php
session_start();
$id_user = $_SESSION['idUser'];
include('../Includes/Connection.php');
include_once "Ajax/ajaxAsignarGradoAsignatura.php";
include_once "../Includes/Header.php";
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <!-- Card Header -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="head-table m-0 font-weight-bold">Registro de Asignaturas por Grado</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <form method="post" style="color: black;">
                <div class="form-group">
                    <input type="hidden" name="idrelgrado" id="idrelgrado">
                    <label class="col-form-label">Seleccionar las asignaturas para dicho grado:</label>
                    </br>
                    <?php
                    include ("../Includes/Connection.php");
                    $query = mysqli_query($conexion, "SELECT * FROM asignaturas");
                    while ($row = mysqli_fetch_assoc($query)) { ?>
                    <div class="form-check form-check-inline m-4" style="padding-left: 5px;">
                        <input class="form-check-input" id="asignaturas" type="checkbox" name="asignaturas[]" value="<?php echo $row['idasig']; ?>"
                        <?php
                        if(isset($datos[$row['idasig']])){
                            echo "checked";
                        }
                        ?>>
                        <label class="form-check-label"><?php echo $row['nombre']; ?></label>
                    </div>
                    <?php } ?>
                </div>
                <div class="modal-footer">
                    <a href="tblDocentes.php" class="btn" style="background-color: red; color: white;">Cancelar</a>
                    <button class="btn"  style="background-color: #71B600; color: white;" type="submit">Modificar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
include_once "../Includes/Footer.php";
?>
