<?php
session_start();
$id_user = $_SESSION['idUser'];
include('../Includes/Connection.php');
include_once "../Includes/Header.php";
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!--DATATABLE-->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="head-table m-0 font-weight-bold">Registro de Grados Académicos</h6>
        </div>
        <div class="card-body">
            <div class="filtro">
                <form>
                    <div class="form-group">
                        <select class="form-control" name="nivel" id="nivel" onchange="filtroNivel()">
                            <option selected disabled> -- Seleccionar nivel académico -- </option>
                            <?php
                            $querynivel = mysqli_query($conexion, "SELECT * FROM niveles");
                            while ($row = mysqli_fetch_assoc($querynivel)) {
                                echo "<option value='" . $row['idniv'] . "'>" . $row['nombre'] . "</option>";
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
                            <th>Nivel</th>
                            <th>Grado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div> 
</div>

<script>
    function filtroNivel() {
        var nivel = document.getElementById('nivel').value;
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'tblFiltro.php?nivel=' + nivel, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                document.getElementById('tblBlasPascal').getElementsByTagName('tbody')[0].innerHTML = xhr.responseText;
            }
        };
        xhr.send();
    }
</script>

<?php
require_once "../Includes/Footer.php";
?>
