<?php
session_start();
$id_user = $_SESSION['idUser'];
include('../Includes/Connection.php');
include_once "Ajax/ajaxAulas.php";
include_once "../Includes/Header.php";
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Content Row -->
    <div class="row">
        <!-- Agregar Sección -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header --> 
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="head-table m-0 font-weight-bold">
                        <span style="text-transform: uppercase; font-weight: 900;"><?php echo $nombre_nivel; ?> - <?php echo $nombre_grado; ?></span>
                    </h6>
                </div>
                <!-- Card Body -->
                <div class="card-body" style="color: black;">
                    <form id="formSecciones" method="post">
                        <div class="form-group">
                            <input type="hidden" name="idaula" id="idaula">
                            <label class="col-form-label">Año académico:</label>
                            <input type="text" class="form-control" name="yearacadaula" id="yearacadaula" value="<?php echo $yearacad; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Tutor(a):</label>
                            <select class="form-control" name="tutoraula" id="tutoraula">
                                <option selected disabled> -- Seleccionar docente-- </option>
                                <?php
                                $query = mysqli_query($conexion, "SELECT * FROM docentes");
                                while ($row = mysqli_fetch_assoc($query)) {
                                    $selected = ($row['iddoc'] == $aula) ? 'selected' : '';
                                    echo "<option value='" . $row['iddoc'] . "' $selected>" . $row['apellidos'] . ", " . $row['nombres'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Sección:</label>
                            <input type="text" class="form-control" name="seccionaula" id="seccionaula" value="<?php echo $seccion; ?>">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Aforo:</label>
                            <input type="number" class="form-control" name="aforoaula" id="aforoaula" value="<?php echo $aforo; ?>">
                        </div>
                        <div class="modal-footer">
                            <a href="tblGrados.php" class="btn" style="background-color: red; color: white;">Cancelar </a>
                            <input type="submit" value="Guardar" class="btn" id="btnAccion" style="background-color: #71B600; color: white;">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Sección por aula -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="head-table m-0 font-weight-bold">
                        Registro de Secciones
                    </h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="table-responsive" style="color: black;">
                        <table class="table table-bordered" id="tblBlasPascal" width="100%" cellspacing="0" style="color: black;">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Año Académico</th>
                                    <th>Sección</th>
                                    <th>Tutor(a)</th>
                                </tr>
                            </thead>
                            <tbody> 
                            <?php 
                            $queryaulas = mysqli_query($conexion, "SELECT au.idaula, au.yearacad, au.seccion, n.nombre AS nivel, 
                            g.nombre AS grado, d.nombres AS nombresdoc, d.apellidos AS apellidosdoc FROM aulas au 
                            INNER JOIN grados g ON au.grado = g.idgrado 
                            INNER JOIN niveles n ON g.nivel = n.idniv
                            INNER JOIN docentes d ON au.tutor = d.iddoc WHERE au.grado = $idgrado");
                            while ($row = mysqli_fetch_assoc($queryaulas)) { ?>
                                <tr>
                                    <td><?php echo $row['idaula']; ?></td>
                                    <td><?php echo $row['yearacad']; ?></td>
                                    <td><?php echo $row['seccion']; ?></td>
                                    <td><?php echo $row['apellidosdoc'] . ', ' . $row['nombresdoc']; ?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?php
include_once "../Includes/Footer.php";
?>
