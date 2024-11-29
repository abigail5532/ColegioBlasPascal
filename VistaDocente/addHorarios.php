<?php
session_start();
$id_user = $_SESSION['idUser'];
include('../Includes/Connection.php');
include_once "Ajax/ajaxHorarios.php";
include_once "../Includes/HeaderDoc.php";
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="head-table m-0 font-weight-bold">Registro de Horarios</h6>
        </div>
        <div class="card-body" style="color: black;">
            <form id="formHorarios" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <img src="../Imagenes/calendario.jpg" class="img-fluid rounded-start" alt="...">
                        </div>
                    </div>  
                    <div class="col-md-6">
                    <div class="form-group">
                    <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="docentehor" id="docentehor" value="<?php echo $_SESSION["idUser"];?>">
                            <label class="col-form-label">Reunion</label>
                            <select class="form-control" name="reunion" id="reunion">
                                <option value="Presencial" <?php echo ($reunion == 'Presencial') ? 'selected' : ''; ?>>Presencial</option>
                                <option value="Virtual" <?php echo ($reunion == 'Virtual') ? 'selected' : ''; ?>>Virtual</option>
                            </select>
                        </div>
                        <div class="form-group">
                            
                            <label class="col-form-label">Fecha Disponible</label>
                            <input type="date" class="form-control" name="fechahor" id="fechahor" value="<?php echo $dia; ?>">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Hora Inicial</label>
                            <div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true">
                                <input type="text" class="form-control" value="<?php echo $horai; ?>" placeholder="hh:mm" name="horainicialhor" id="horainicialhor">
                                <span class="input-group-text" style="border-bottom-left-radius: 0; border-top-left-radius: 0;"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Hora Final</label>
                            <div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true">
                                <input type="text" class="form-control" value="<?php echo $horaf; ?>" placeholder="hh:mm" name="horafinalhor" id="horafinalhor">
                                <span class="input-group-text" style="border-bottom-left-radius: 0; border-top-left-radius: 0;"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Estado</label>
                            <select class="form-control" name="estadohor" id="estadohor">
                                <option value="Activo" <?php echo ($estado == 'Activo') ? 'selected' : ''; ?>>Activo</option>
                                <option value="Inactivo" <?php echo ($estado == 'Inactivo') ? 'selected' : ''; ?>>Inactivo</option>
                            </select>
                        </div>
                    </div> 
                </div>
                <div class="modal-footer">
                    <a href="tblHorarios.php" class="btn btn-danger">Cancelar</a>
                    <input type="submit" value="Guardar" class="btn" id="btnAccion" style="background-color: #71B600; color: white;">
                </div>
            </form>
        </div>
    </div>
</div>

<!-- /.End Page Content -->
<?php
require_once "../Includes/FooterDoc.php";
?>