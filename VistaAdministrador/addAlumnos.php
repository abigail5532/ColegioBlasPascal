<?php
session_start();
$id_user = $_SESSION['idUser'];
include('../Includes/Connection.php');
include_once "Ajax/ajaxAlumnos.php";
include_once "../Includes/Header.php";
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="head-table m-0 font-weight-bold">Registro de Alumnos</h6>
        </div>
        <div class="card-body" style="color: black;">
            <form id="formAlumnos" method="post" action="">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="hidden" name="idalum" id="idalum" value="<?php echo $idalum; ?>">
                            <label class="col-form-label">Nombres:</label>
                            <input type="text" class="form-control" name="nombresalum" id="nombresalum" value="<?php echo $nombres; ?>">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Apellidos:</label>
                            <input type="text" class="form-control" name="apellidosalum" id="apellidosalum" value="<?php echo $apellidos; ?>">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">DNI:</label>
                            <input type="text" class="form-control" name="dnialum" id="dnialum" value="<?php echo $dni; ?>">
                        </div>
                    </div>  
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="col-form-label">Género:</label>
                            <select class="form-control" name="generoalum" id="generoalum">
                                <option value="F" <?php if($genero == 'F') echo 'selected'; ?>>Femenino</option> 
                                <option value="M" <?php if($genero == 'M') echo 'selected'; ?>>Masculino</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Fec. Nacimiento:</label>
                            <input type="date" class="form-control" name="fecnacimientoalum" id="fecnacimientoalum" value="<?php echo $fecnacimiento; ?>">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Dirección:</label>
                            <input type="text" class="form-control" name="direccionalum" id="direccionalum" value="<?php echo $direccion; ?>">
                        </div>
                    </div>  
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="col-form-label">Contraseña:</label>
                            <input type="password" class="form-control" name="clavealum" id="clavealum">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Aula:</label>
                            <select class="form-control" name="aulaalum" id="aulaalum">
                                <option selected disabled> -- Seleccionar nivel académico -- </option>
                                <?php
                                $query = mysqli_query($conexion, "SELECT au.idaula, au.seccion, n.nombre AS nivel, g.nombre AS grado FROM aulas au 
                                INNER JOIN grados g ON au.grado = g.idgrado INNER JOIN niveles n ON g.nivel = n.idniv");
                                while ($row = mysqli_fetch_assoc($query)) {
                                    $selected = ($row['idaula'] == $aula) ? 'selected' : '';
                                    echo "<option value='" . $row['idaula'] . "' $selected>" . $row['nivel'] . " - " . $row['grado'] . " - " . $row['seccion'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Estado:</label>
                            <select class="form-control" name="estadoalum" id="estadoalum">
                                <option value="Activo" <?php if($estado == 'Activo') echo 'selected'; ?>>Activo</option> 
                                <option value="Inactivo" <?php if($estado == 'Inactivo') echo 'selected'; ?>>Inactivo</option>
                            </select>
                        </div>
                    </div> 
                </div>
                <hr>
                <div style="text-align: center; margin-bottom: 10px;">
                    <span style="border-radius: 12px; padding: 7px; color: #71B600; font-weight: 800;">
                        DATOS DE LOS APODERADOS
                    </span>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="col-form-label">Nombres <sub>(Madre)</sub>:</label>
                            <input type="text" class="form-control" name="nombresma" id="nombresma" value="<?php echo $nombresma; ?>">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">DNI <sub>(Madre)</sub>:</label>
                            <input type="text" class="form-control" name="dnima" id="dnima" value="<?php echo $dnima; ?>">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Teléfono <sub>(Madre)</sub>:</label>
                            <input type="text" class="form-control" name="telefonoma" id="telefonoma" value="<?php echo $telefonoma; ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="col-form-label">Nombres <sub>(Padre)</sub>:</label>
                            <input type="text" class="form-control" name="nombrespa" id="nombrespa" value="<?php echo $nombrespa; ?>">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">DNI <sub>(Padre)</sub>:</label>
                            <input type="text" class="form-control" name="dnipa" id="dnipa" value="<?php echo $dnipa; ?>">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Teléfono <sub>(Padre)</sub>:</label>
                            <input type="text" class="form-control" name="telefonopa" id="telefonopa" value="<?php echo $telefonopa; ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="col-form-label">Nombres <sub>(Apoderado)</sub>:</label>
                            <input type="text" class="form-control" name="nombresapod" id="nombresapod" value="<?php echo $nombresapod; ?>">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">DNI <sub>(Apoderado)</sub>:</label>
                            <input type="text" class="form-control" name="dniapod" id="dniapod" value="<?php echo $dniapod; ?>">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Teléfono <sub>(Apoderado)</sub>:</label>
                            <input type="text" class="form-control" name="telefonoapod" id="telefonoapod" value="<?php echo $telefonoapod; ?>">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="tblAlumnos.php" class="btn" style="background-color: red; color: white;">Cancelar </a>
                    <input type="submit" value="Guardar" class="btn" id="btnAccion" style="background-color: #71B600; color: white;">
                </div>
            </form>
        </div>
    </div>
</div>

<?php
include_once "../Includes/Footer.php";
?>