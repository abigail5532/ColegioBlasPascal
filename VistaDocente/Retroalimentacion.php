<?php
session_start();
$id_user = $_SESSION['idUser'];
include('../Includes/Connection.php');
$idaula = isset($_GET['idaula']) ? $_GET['idaula'] : '';
$idalum = isset($_GET['idalum']) ? $_GET['idalum'] : '';
include('../Includes/HeaderDoc.php');
include_once "Ajax/ajaxRetroalimentacion.php";

?>
<!-- Resto del HTML y formulario -->

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="head-table m-0 font-weight-bold">Registro de Alumnos</h6>
        </div>
        <div class="card-body" style="color: black;">
                <div class="row">
                    <div class="col-xl-4 col-lg-5">
                        <div class="text-center">
                            <img class="img-fluid px-3 px-sm-4 mt-2 mb-2" style="width: 30rem;"
                                src="../Imagenes/podio.png" alt="...">
                        </div>
                    </div>  
                    <div class="col-xl-8 col-lg-7">
            <form id="formConducta" method="post" class="">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="idbol" id="idbol" value="<?php echo $idbol; ?>">
                                    <input type="hidden" name="idalum" id="idalum" class="form-control" value="<?php echo $idalum; ?>">
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
                                <div class="form-group">
                                    <label class="col-form-label">Promedio de Áreas</label>
                                    <input type="text" class="form-control" name="promedioarea" id="promedioarea" value="<?php echo $promedioarea; ?>">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Promedio de Conducta</label>
                                    <input type="text" class="form-control" name="comportamiento" id="comportamiento" value="<?php echo $comportamiento; ?>">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Promedio General</label>
                                    <input type="text" class="form-control" name="promediogeneral" id="promediogeneral" value="<?php echo $promediogeneral; ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-form-label">Promedio General Alfabético</label>
                                    <input type="text" class="form-control" name="promedioalfabetico" id="promedioalfabetico"value="<?php echo $promedioalfabetico; ?>">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Apreciacion:</label>
                                    <textarea class="form-control" name="apreciacion" id="apreciacion" rows="5" value="<?php echo $apreciacion; ?>"></textarea>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
                <div class="modal-footer">
                    <a href="tblTutoriaAlumnos.php?idaula=<?php echo $idaula; ?>" class="btn" style="background-color: red; color: white;">Cancelar </a>
                    <input type="submit" value="Guardar" class="btn" id="btnAccion" style="background-color: #71B600; color: white;">
                </div>
            </form>
        </div>
    </div>
</div>

<?php
include_once "../Includes/Footer.php";
?>
