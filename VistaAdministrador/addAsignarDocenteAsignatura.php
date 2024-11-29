<?php
session_start();
$id_user = $_SESSION['idUser'];
include('../Includes/Connection.php');
include_once "Ajax/ajaxAsignarDocenteAsignatura.php";
include_once "../Includes/Header.php";
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="head-table m-0 font-weight-bold">Registro de Docentes a Aulas</h6>
        </div>
        <div class="card-body" style="color: black;">
            <form method="post">
                <div class="form-group">
                    <input type="hidden" name="idrelasig" id="idrelasig">
                    <label class="col-form-label">Seleccionar las asignaturas para el docente</label>
                    </br>
                    <?php
                    include ("../Includes/Connection.php");
                    $query = mysqli_query($conexion, "SELECT rel.idrelgrado, au.idaula, au.seccion,
                    n.nombre AS nivel, g.nombre AS grado, a.nombre AS asignatura FROM asignar_grado_asignatura rel
                    JOIN asignaturas a ON rel.asignatura = a.idasig JOIN aulas au ON rel.aula = au.idaula
                    JOIN grados g ON au.grado = g.idgrado JOIN niveles n ON g.nivel = n.idniv");
                    while ($row = mysqli_fetch_assoc($query)) { ?>
                    <div class="form-check form-check-inline m-4" style="padding-left: 5px;">
                        <input class="form-check-input" id="asignaturas" type="checkbox" name="asignaturas[]" value="<?php echo $row['idrelgrado']; ?>"
                        <?php
                        if(isset($datos[$row['idrelgrado']])){
                            echo "checked";
                        }
                        ?>>
                        <label class="form-check-label">
                        <?php echo $row['asignatura'] . ' || ' . $row['nivel'] . ' - ' . $row['grado'] . ' - ' . $row['seccion'];?>
                        </label>
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
