<?php
session_start();
$id_user = $_SESSION['idUser'];
include('../Includes/Connection.php');
include_once "Ajax/ajaxEva.php";
include_once "../Includes/Header.php";

$idasig = isset($_GET['idasig']) ? intval($_GET['idasig']) : 0;
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
                        Registro de Evaluaciones
                    </h6>
                </div>
                <!-- Card Body -->
                <div class="card-body" style="color: black;">
                    <form id="formSecciones" method="post" action=" ">
                        <input type="hidden" name="idasig" value="<?php echo $idasig; ?>">
                        <div class="form-group">
                            <label class="col-form-label">Bimestre:</label>
                            <select class="form-control" name="bimestre" id="bimestre">
                                <option selected disabled> -- Seleccionar bimestre -- </option>
                                <?php
                                $query = mysqli_query($conexion, "SELECT idbime, nombre FROM bimestres");
                                while ($row = mysqli_fetch_assoc($query)) {
                                    echo "<option value='" . $row['idbime'] . "'>" . $row['nombre'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Evaluacion:</label>
                            <input type="text" class="form-control" name="evaluacion" id="evaluacion">
                        </div>
                        <div class="modal-footer">
                            <a href="tblAsignaturas.php" class="btn" style="background-color: red; color: white;">Cancelar</a>
                            <input type="submit" value="Guardar" class="btn" id="btnAccion" style="background-color: #71B600; color: white;">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Display Evaluations -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="head-table m-0 font-weight-bold">
                        Registro de Evaluaciones
                    </h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="filtro">
                        <form>
                            <div class="form-group">
                                <select class="form-control" name="bimestre" id="filtro_bimestre" onchange="filtrobimestre()">
                                    <option selected disabled> -- Seleccionar bimestre -- </option>
                                    <?php
                                    $querynivel = mysqli_query($conexion, "SELECT * FROM bimestres");
                                    while ($row = mysqli_fetch_assoc($querynivel)) {
                                        echo "<option value='" . $row['idbime'] . "'>" . $row['nombre'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive" style="color: black;">
                        <table class="table table-bordered" id="tblBlasPascal" width="100%" cellspacing="0" style="color: black;">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Bimestre</th>
                                    <th>Evaluacion</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data will be populated by AJAX -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function filtrobimestre() {
    var bimestre = document.getElementById('filtro_bimestre').value;
    var idasig = <?php echo $idasig; ?>;
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'tblFiltro2.php?bimestre=' + bimestre + '&idasig=' + idasig, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById('tblBlasPascal').getElementsByTagName('tbody')[0].innerHTML = xhr.responseText;
        }
    };
    xhr.send();
}

    function confirmarBorrado(ideva) {
        Swal.fire({
            title: '¿Está seguro de eliminar?',
            text: "Esta acción no se puede deshacer.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'deleteEva.php?ideva=' + ideva;
            }
        });
    }

    
</script>

<?php
include_once "../Includes/Footer.php";
?>




