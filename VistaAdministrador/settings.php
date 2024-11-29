<?php
session_start();
$id_user = $_SESSION['idUser'];
include('../Includes/Connection.php');
include_once "Ajax/ajaxInstitucion.php";
include_once "../Includes/Header.php";
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="head-table m-0 font-weight-bold">Datos de la Institución</h6>
        </div>
        <div class="card-body" style="color: black;">
        <div class="row">
            <div class="col-xl-4 col-lg-5 d-flex justify-content-center align-items-center flex-column">
                <img src="../Imagenes/blaspascal_logo.jpg" class="img-fluid" 
                style="max-width: 100%;
                    height: auto;
                    max-height: 370px;
                    border-radius: 100px;">
                <hr>
                
                <form id="formInstitucion" method="post" class="">
                    <input type="submit" value="Modificar" class="btn" style="background-color: #71B600; color: white;" id="btnAccion">
            </div>
            <div class="col-xl-8 col-lg-7">
                    <?php include('../Includes/Connection.php');
                    $query = mysqli_query($conexion, "SELECT * FROM institucion");
                    $result = mysqli_num_rows($query);
                    if ($result > 0) {
                        while ($data = mysqli_fetch_assoc($query)) { 
                    ?>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-form-label">Código modular:</label>
                                <input type="text" class="form-control" name="codmodularinst" id="codmodularinst"
                                value="<?php echo $data['codmodular']; ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-form-label">Ugel:</label>
                                <input type="text" class="form-control" name="ugelinst" id="ugelinst"
                                value="<?php echo $data['ugel']; ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-form-label">DRE:</label>
                                <input type="text" class="form-control" name="dreinst" id="dreinst"
                                value="<?php echo $data['dre']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="idinst" id="idinst" value="<?php echo $data['idinst']; ?>">
                        <label class="col-form-label">Nombre:</label>
                        <input type="text" class="form-control" name="nombreinst" id="nombreinst"
                        value="<?php echo $data['nombre']; ?>">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Correo electrónico:</label>
                        <input type="text" class="form-control" name="correoinst" id="correoinst"
                        value="<?php echo $data['correo']; ?>">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Ubicación:</label>
                        <input type="text" class="form-control" name="ubicacioninst" id="ubicacioninst"
                        value="<?php echo $data['ubicacion']; ?>">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label">Nro. telefónico:</label>
                                <input type="text" class="form-control" name="telefonoinst" id="telefonoinst"
                                value="<?php echo $data['telefono']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label">Horario:</label>
                                <input type="text" class="form-control" name="horarioinst" id="horarioinst"
                                value="<?php echo $data['horario']; ?>">
                            </div>
                        </div>
                    </div>
                    <?php }
                    } ?>
                </form>
            </div>
        </div>
        </div>
    </div>
</div>
<!-- /.End Page Content -->
<?php
require_once "../Includes/Footer.php";
?>