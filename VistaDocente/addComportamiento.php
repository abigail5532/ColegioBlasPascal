<?php
session_start();
$id_user = $_SESSION['idUser'];
include('../Includes/Connection.php');
include_once "Ajax/ajaxComportamiento.php";
$idaula= isset($_GET['idaula']) ? $_GET['idaula'] : '';
$idalum = isset($_GET['idalum']) ? $_GET['idalum'] : '';

include('../Includes/HeaderDoc.php');
?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="head-table m-0 font-weight-bold">Registro de Conducta</h6>
                </div>
                <div class="card-body" style="color: black;">
                    <form id="formConducta" method="post" class="">
                        <div class="form-group">
                            <input type="hidden" name="idcomp" id="idcomp" value="<?php echo $idcomp; ?>">
                            <input type="hidden" name="idalum" id="idalum" class="form-control" value="<?php echo $idalum; ?>">
                            <input type="hidden" name="yearacad" id="yearacad" value="<?php echo $yearacad; ?>">
                            <label class="col-form-label">Bimestre</label>
                            <select class="form-control" name="bimestre" id="bimestre" style="color: black;">
                                <option selected disabled> Seleccionar Bimestre </option>
                                <?php
                                $querybimestre = mysqli_query($conexion, "SELECT * FROM bimestres");
                                while ($row = mysqli_fetch_assoc($querybimestre)) {
                                    $selected = ($row['idbime'] == $bimestre) ? 'selected' : '';
                                    echo "<option value='" . $row['idbime'] . "' $selected>" . $row['nombre'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-form-label">Inasistencias <sub>(Just.)</sub></label>
                            <input type="number" class="form-control" name="inasistenciajust" id="inasistenciajust" value="<?php echo $inasistenciajust; ?>">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Inasistencias <sub>(Injust.)</sub></label>
                            <input type="number" class="form-control" name="inasistenciainjust" id="inasistenciainjust" value="<?php echo $inasistenciainjust; ?>">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Tardanzas <sub>(Just.)</sub></label>
                            <input type="number" class="form-control" name="tardanzajust" id="tardanzajust" value="<?php echo $tardanzainjust; ?>">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Tardanzas <sub>(Injust.)</sub></label>
                            <input type="number" class="form-control" name="tardanzainjust" id="tardanzainjust" value="<?php echo $tardanzainjust; ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-form-label">Puntualidad</label>
                            <input type="number" class="form-control" name="puntualidad" id="puntualidad" value="<?php echo $puntualidad; ?>">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Responsabilidad</label>
                            <input type="number" class="form-control" name="responsabilidad" id="responsabilidad" value="<?php echo $responsabilidad; ?>">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Aseo</label>
                            <input type="number" class="form-control" name="aseo" id="aseo" value="<?php echo $aseo; ?>">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Respeto</label>
                            <input type="number" class="form-control" name="respeto" id="respeto" value="<?php echo $respeto; ?>">
                        </div>
                    </div>
                </div>
                        <div class="modal-footer">
                            <a href="tblTutoriaAlumnos.php?idaula=<?php echo $idaula; ?>" class="btn" style="background-color: red; color: white;">Regresar </a>
                            <input type="submit" value="Guardar" class="btn" id="btnAccion" style="background-color: #71B600; color: white;">
                        </div>
                    </form> 
                </div>  
            </div> 
        </div>
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="head-table m-0 font-weight-bold">Registro de Conducta</h6>
                </div>
                <div class="card-body" style="color: black;">
                    <div class="table-responsive" style="color: black;">
                        <table class="table table-bordered" id="tblBlasPascal" width="100%" cellspacing="0" style="color: black;">
                            <thead>
                                <tr>
                                    <th>Bimestre</th>
                                    <th>Inasistencias</th>
                                    <th>Tardanzas</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php include('../Includes/Connection.php');
                                $query = mysqli_query($conexion, "SELECT c.inasistenciajust, c.inasistenciainjust, c.tardanzajust, c.tardanzainjust, 
                                c.puntualidad, c.respeto, c.responsabilidad, c.aseo, b.nombre AS bimestre, c.alumno
                                FROM comportamiento c
                                INNER JOIN bimestres b ON c.bimestre = b.idbime WHERE c.alumno = '$idalum'");
                                $result = mysqli_num_rows($query);
                                if ($result > 0) {
                                    while ($data = mysqli_fetch_assoc($query)) { ?>
                                <tr>
                                    <td><?php echo $data['bimestre']; ?></td>
                                    <td><?php echo $data['inasistenciajust'] . ' Just. ' . $data['inasistenciainjust'] . ' Injust. '; ?></td>
                                    <td><?php echo $data['tardanzajust'] . ' Just. ' . $data['tardanzainjust'] . ' Injust. '; ?></td>
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

<?php
include_once "../Includes/Footer.php";
?>
