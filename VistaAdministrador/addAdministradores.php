<?php
session_start();
$id_user = $_SESSION['idUser'];
include('../Includes/Connection.php');
include_once "Ajax/ajaxAdministradores.php";
include_once "../Includes/Header.php";
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="head-table m-0 font-weight-bold">Registro de Administradores</h6>
        </div>
        <div class="card-body" style="color: black;">
            <form id="formAdministradores" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="hidden" name="idadm" id="idadm" value="<?php echo $idadm; ?>">
                            <label class="col-form-label">Nombres:</label>
                            <input type="text" class="form-control" name="nombresadm" id="nombresadm" value="<?php echo $nombres; ?>">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Apellidos:</label>
                            <input type="text" class="form-control" name="apellidosadm" id="apellidosadm" value="<?php echo $apellidos; ?>">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">DNI:</label>
                            <input type="text" class="form-control" name="dniadm" id="dniadm" value="<?php echo $dni; ?>">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Teléfono:</label>
                            <input type="text" class="form-control" name="telefonoadm" id="telefonoadm" value="<?php echo $telefono; ?>">
                        </div>
                    </div>  
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-form-label">Contraseña:</label>
                            <input type="password" class="form-control" name="claveadm" id="claveadm">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Rol:</label>
                            <select class="form-control" name="roladm" id="roladm">
                                <option value="Coordinador" <?php echo ($estado == 'Coordinador') ? 'selected' : ''; ?>>Coordinador</option>
                                <option value="Administrador" <?php echo ($estado == 'Administrador') ? 'selected' : ''; ?>>Administrador</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Estado:</label>
                            <select class="form-control" name="estadoadm" id="estadoadm">
                                <option value="Activo" <?php echo ($estado == 'Activo') ? 'selected' : ''; ?>>Activo</option>
                                <option value="Inactivo" <?php echo ($estado == 'Inactivo') ? 'selected' : ''; ?>>Inactivo</option>
                            </select>
                        </div>
                    </div> 
                </div>
                <div class="modal-footer">
                    <a href="tblAdministradores.php" class="btn" style="background-color: red; color: white;">Cancelar</a>
                    <input type="submit" value="Guardar" class="btn" id="btnAccion" style="background-color: #71B600; color: white;">
                </div>
            </form>
        </div>
    </div>
</div>

<!-- /.End Page Content -->
<?php
require_once "../Includes/Footer.php";
?>