<?php
session_start();
$id_user = $_SESSION['idUser'];
include('../Includes/Connection.php');
include_once "Ajax/ajaxDocentes.php";
include_once "../Includes/Header.php";
?>


<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="head-table m-0 font-weight-bold">Registro de Docente</h6>
        </div>
        <div class="card-body" style="color: black;">
            <form id="formDocentes" method="POST">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="hidden" name="iddoc" id="iddoc" value="<?php echo $iddoc; ?>">
                            <label class="col-form-label">Nombres:</label>
                            <input type="text" class="form-control" name="nombresdoc" id="nombresdoc" value="<?php echo $nombres; ?>">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Apellidos:</label>
                            <input type="text" class="form-control" name="apellidosdoc" id="apellidosdoc" value="<?php echo $apellidos; ?>">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">DNI:</label>
                            <input type="text" class="form-control" name="dnidoc" id="dnidoc" value="<?php echo $dni; ?>">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Fec. Nacimiento:</label>
                            <input type="date" class="form-control" name="fecnacimientodoc" id="fecnacimientodoc" value="<?php echo $fecnacimiento; ?>">
                        </div>
                    </div>  
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-form-label">Dirección:</label>
                            <input type="text" class="form-control" name="direcciondoc" id="direcciondoc" value="<?php echo $direccion; ?>">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Nro. Telefónico:</label>
                            <input type="text" class="form-control" name="telefonodoc" id="telefonodoc" value="<?php echo $telefono; ?>">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Contraseña:</label>
                            <input type="password" class="form-control" name="clavedoc" id="clavedoc">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Estado:</label>
                            <select class="form-control" name="estadodoc" id="estadodoc">
                                <option value="Activo" <?php echo ($estado == 'Activo') ? 'selected' : ''; ?>>Activo</option>
                                <option value="Inactivo" <?php echo ($estado == 'Inactivo') ? 'selected' : ''; ?>>Inactivo</option>
                            </select>
                        </div>
                    </div> 
                </div>
                <div class="modal-footer">
                    <a href="tblDocentes.php" class="btn" style="background-color: red; color: white;">Cancelar </a>
                    <input type="submit" value="Guardar" class="btn" id="btnAccion" style="background-color: #71B600; color: white;">
                </div>
            </form>
        </div>
    </div>
</div>

<?php
include_once "../Includes/Footer.php";
?>